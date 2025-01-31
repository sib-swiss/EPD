sed -n '1,769p'     promoter_ucsc.txt > part1.txt
sed -n '770,1538p'  promoter_ucsc.txt > part2.txt
sed -n '1539,2307p' promoter_ucsc.txt > part3.txt
sed -n '2308,$p'    promoter_ucsc.txt > part4.txt

ls /local/ccguser/epd_http/htdocs/bigWIG/mm10/fantom5/*.bw | ./make_expr_matrix.pl -a mm10 --header -p part1.txt > matrix1.txt 2>> log &
ls /local/ccguser/epd_http/htdocs/bigWIG/mm10/fantom5/*.bw | ./make_expr_matrix.pl -a mm10 -p part2.txt > matrix2.txt 2>> log &
ls /local/ccguser/epd_http/htdocs/bigWIG/mm10/fantom5/*.bw | ./make_expr_matrix.pl -a mm10 -p part3.txt > matrix3.txt 2>> log &
ls /local/ccguser/epd_http/htdocs/bigWIG/mm10/fantom5/*.bw | ./make_expr_matrix.pl -a mm10 -p part4.txt > matrix4.txt 2>> log &

cat matrix1.txt matrix2.txt matrix3.txt matrix4.txt | ./get_max_tracks.pl > data/mm10_nc.dat
chmod 444 data/mm10_nc.dat

../make_session_files.pl --tracknum 3 --both -s ../template.txt < ../mm10.dat
../make_session_files.pl --tracknum 3 --both -s ../template_us.txt < ../mm10.dat

