cd S_pombe
cp S_pombe_database.php S_pombe_database_old.php
cp S_pombe_viewer.php S_pombe_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a spo2 > S_pombe_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a spo2 Sp_viewer_table.txt > S_pombe_viewer.php
cd ..

cd drosophila
cp drosophila_database.php drosophila_database_old.php
cp drosophila_viewer.php drosophila_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a dm6 > drosophila_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a dm6 Dm_viewer_table.txt > drosophila_viewer.php
cd ..

cd G_gallus
cp G_gallus_database.php G_gallus_database_old.php
cp G_gallus_viewer.php G_gallus_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a galGal5 > G_gallus_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a galGal5 Gg_viewer_table.txt > G_gallus_viewer.php
cd ..

cd S_cerevisiae
cp S_cerevisiae_database.php S_cerevisiae_database_old.php
cp S_cerevisiae_viewer.php S_cerevisiae_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a sacCer3 > S_cerevisiae_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a sacCer3 Sc_viewer_table.txt > S_cerevisiae_viewer.php
cd ..

cd mouse
cp mouse_database.php mouse_database_old.php
cp mouse_viewer.php mouse_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a mm10 > mouse_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a mm10 Mm_viewer_table.txt > mouse_viewer.php
cd ..

cd P_falciparum
cp P_falciparum_database.php P_falciparum_database_old.php
cp P_falciparum_viewer.php P_falciparum_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a pfa2 > P_falciparum_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a pfa2 Pf_viewer_table.txt > P_falciparum_viewer.php
cd ..

cd human
cp human_database.php human_database_old.php
cp human_viewer.php human_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a hg38 > human_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a hg38 Hg_viewer_table.txt > human_viewer.php
cd ..

cd worm
cp worm_database.php worm_database_old.php
cp worm_viewer.php worm_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a ce6 > worm_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a ce6 Ce_viewer_table.txt > worm_viewer.php
cd ..

cd A_mellifera
cp A_mellifera_database.php A_mellifera_database_old.php
cp A_mellifera_viewer.php A_mellifera_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a amel5 > A_mellifera_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a amel5 Am_viewer_table.txt > A_mellifera_viewer.php
cd ..

cd human_nc
cp human_nc_database.php human_nc_database_old.php
cp human_nc_viewer.php human_nc_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -n -a hg38 > human_nc_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a hg38 HsNC_viewer_table.txt > human_nc_viewer.php
cd ..

cd arabidopsis
cp arabidopsis_database.php arabidopsis_database_old.php
cp arabidopsis_viewer.php arabidopsis_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a araTha1 > arabidopsis_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a araTha1 At_viewer_table.txt > arabidopsis_viewer.php
cd ..

cd Z_mays
cp Z_mays_database.php Z_mays_database_old.php
cp Z_mays_viewer.php Z_mays_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a zm3 > Z_mays_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a zm3 Zm_viewer_table.txt > Z_mays_viewer.php
cd ..

cd M_mulatta
cp M_mulatta_database.php M_mulatta_database_old.php
cp M_mulatta_viewer.php M_mulatta_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a rheMac8 > M_mulatta_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a rheMac8 Rm_viewer_table.txt > M_mulatta_viewer.php
cd ..

cd R_norvegicus
cp R_norvegicus_database.php R_norvegicus_database_old.php
cp R_norvegicus_viewer.php R_norvegicus_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a rn6 > R_norvegicus_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a rn6 Rn_viewer_table.txt > R_norvegicus_viewer.php
cd ..

cd C_familiaris
cp C_familiaris_database.php C_familiaris_database_old.php
cp C_familiaris_viewer.php C_familiaris_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a canFam3 > C_familiaris_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a canFam3 Cf_viewer_table.txt > C_familiaris_viewer.php
cd ..

cd zebrafish
cp zebrafish_database.php zebrafish_database_old.php
cp zebrafish_viewer.php zebrafish_viewer_old.php
/home/pameylan/home.vital-it/bin/make_database_template.pl -a danRer7 > zebrafish_database.php
/home/pameylan/home.vital-it/bin/make_viewer_page.pl -a danRer7 Dr_viewer_table.txt > zebrafish_viewer.php
cd ..

