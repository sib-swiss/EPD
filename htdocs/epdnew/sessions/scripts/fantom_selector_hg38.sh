sed -n '1,585p'     promoter_ucsc.txt > part1.txt
sed -n '586,1170p'  promoter_ucsc.txt > part2.txt
sed -n '1171,1755p' promoter_ucsc.txt > part3.txt
sed -n '1756,$p'    promoter_ucsc.txt > part4.txt

ls /local/ccguser/epd_http/htdocs/bigWIG/hg38/fantom5/*.bw | grep -v 'all_' | ./make_expr_matrix.pl -a hg38 --header -p part1.txt > matrix1.txt 2>> log &
ls /local/ccguser/epd_http/htdocs/bigWIG/hg38/fantom5/*.bw | grep -v 'all_' | ./make_expr_matrix.pl -a hg38 -p part2.txt > matrix2.txt 2>> log &
ls /local/ccguser/epd_http/htdocs/bigWIG/hg38/fantom5/*.bw | grep -v 'all_' | ./make_expr_matrix.pl -a hg38 -p part3.txt > matrix3.txt 2>> log &
ls /local/ccguser/epd_http/htdocs/bigWIG/hg38/fantom5/*.bw | grep -v 'all_' | ./make_expr_matrix.pl -a hg38 -p part4.txt > matrix4.txt 2>> log &

cat matrix1.txt matrix2.txt matrix3.txt matrix4.txt | ./get_max_tracks.pl >> data/hg38_nc.dat
chmod 444 data/hg38_nc.dat

cat data/hg38.dat data/hg38_nc.dat > hg38.dat

../make_session_files.pl --tracknum 3 --both -s ../template.txt < ../hg38.dat
../make_session_files.pl --tracknum 3 --both -s ../template_us.txt < ../hg38.dat

