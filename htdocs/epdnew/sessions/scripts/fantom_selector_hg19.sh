awk 'BEGIN {FS=OFS="\t"} $2 == "hg19"' promoter_ucsc.txt > tmp.txt
mv tmp.txt promoter_ucsc.txt

sed -n '1,7400p'      promoter_ucsc.txt > part1.txt
sed -n '7401,14800p'  promoter_ucsc.txt > part2.txt
sed -n '14801,22200p' promoter_ucsc.txt > part3.txt
sed -n '22201,$p'     promoter_ucsc.txt > part4.txt

ls /local/ccguser/epd_http/htdocs/bigWIG/hg19/fantom5/*.bw | grep -v 'all_' | ./make_expr_matrix.pl -a hg19 --header -p part1.txt > matrix1.txt 2>> log &
ls /local/ccguser/epd_http/htdocs/bigWIG/hg19/fantom5/*.bw | grep -v 'all_' | ./make_expr_matrix.pl -a hg19 -p part2.txt > matrix2.txt 2>> log &
ls /local/ccguser/epd_http/htdocs/bigWIG/hg19/fantom5/*.bw | grep -v 'all_' | ./make_expr_matrix.pl -a hg19 -p part3.txt > matrix3.txt 2>> log &
ls /local/ccguser/epd_http/htdocs/bigWIG/hg19/fantom5/*.bw | grep -v 'all_' | ./make_expr_matrix.pl -a hg19 -p part4.txt > matrix4.txt 2>> log &

cat matrix1.txt matrix2.txt matrix3.txt matrix4.txt | ./get_max_tracks.pl > hg19.dat

../make_session_files.pl --tracknum 3 --both -s ../session_template.txt < ../hg19.dat
../make_session_files.pl --tracknum 3 --both -s ../session_template_us.txt < ../hg19.dat

