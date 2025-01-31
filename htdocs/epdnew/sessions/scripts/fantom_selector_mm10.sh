sed -n '1,4200p' promoter_ucsc.txt > part1.txt
sed -n '4201,8400p' promoter_ucsc.txt > part2.txt
sed -n '8401,12600p' promoter_ucsc.txt > part3.txt
sed -n '12601,16800p' promoter_ucsc.txt > part4.txt
sed -n '16801,21000p' promoter_ucsc.txt > part5.txt
sed -n '21001,$p' promoter_ucsc.txt > part6.txt

# There are 2 files with ':' in /data/pmeylan/bwtmp/Mouse_fibroblast_cell_line:_CRL_1658_NIH3T3.* that pose a problem for processing by Perl
ls /data/pmeylan/bwtmp/*.bw | ./make_expr_matrix.pl -a mm10 --header -p part1.txt > matrix1.txt 2>> log &
ls /data/pmeylan/bwtmp/*.bw | ./make_expr_matrix.pl -a mm10 -p part2.txt > matrix2.txt 2>> log &
ls /data/pmeylan/bwtmp/*.bw | ./make_expr_matrix.pl -a mm10 -p part3.txt > matrix3.txt 2>> log &
ls /data/pmeylan/bwtmp/*.bw | ./make_expr_matrix.pl -a mm10 -p part4.txt > matrix4.txt 2>> log &
ls /data/pmeylan/bwtmp/*.bw | ./make_expr_matrix.pl -a mm10 -p part5.txt > matrix5.txt 2>> log &
ls /data/pmeylan/bwtmp/*.bw | ./make_expr_matrix.pl -a mm10 -p part6.txt > matrix6.txt 2>> log &

cat matrix1.txt matrix2.txt matrix3.txt matrix4.txt matrix5.txt matrix6.txt | ./get_max_tracks.pl > mm10.dat

# Euro mirror
./make_session_files.pl --tracknum 5 -s epd_mm10_viewer.txt < mm10.dat
# cd to target directory and move the files
for F in /home/pameylan/home.vital-it/bin/viewer*.txt; do mv $F .; done

# US server
./make_session_files.pl --tracknum 5 -s epd_us_mm10_viewer.txt < mm10.dat
# cd to target directory and move the files
for F in /home/pameylan/home.vital-it/bin/viewer*.txt; do mv $F .; done

