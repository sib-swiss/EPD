
<!-- Include the header of the page. It must be followed by the
     footer.html at the end of the page --> <!--
     *********************************************************************************************
     -->

<?php

     include("../header.php");

echo "<h1>Usage statistics for some EPD-related tools</h1>\n";

######################################################################
echo "<h2>Search tool</h2>\n";

$old_path = getcwd();
chdir('/home/local/ccguser/epd_http/htdocs/');
$command = "awk 'BEGIN{while( (getline < \"stats/months\") >0){ml[\$1]=\$2}}{split(\$1, date, \"-\"); day[date[1]\"-\"date[2]\"-01\"]++}END{for (d in day){split(d, m, \"-\"); print d, (day[d]/ml[m[2]])*30}}' logs/new_master_search.log | sort -k1,1 > wwwtmp/newMasterSearchStats";
#echo "$command";
shell_exec($command);
shell_exec('R --no-save < stats/newMasterSearch.R');

echo '<img src="../wwwtmp/newMasterSearch.png"> ';

######################################################################
echo "<h2>Promoter viewer</h2>\n";

$old_path = getcwd();
chdir('/home/local/ccguser/epd_http/htdocs/');
$command = "awk 'BEGIN{while( (getline < \"stats/months\") >0){ml[\$1]=\$2}}{split(\$1, date, \"-\"); day[date[1]\"-\"date[2]\"-01\"]++}END{for (d in day){split(d, m, \"-\"); print d, (day[d]/ml[m[2]])*30}}' logs/epdNew2genome.log | sort -k1,1 > wwwtmp/epdNew2genomeStats";
#echo "$command";
shell_exec($command);
shell_exec('R --no-save < stats/epdNew2genome.R');

echo '<img src="../wwwtmp/epdNew2genome.png"> ';


######################################################################
echo "<h2>Sequence retrieval tool</h2>\n";

$command = "awk '{split(\$1, date, \"-\"); day[date[1]\"-\"date[2]\"-01\"]++}END{for (d in day){print d, day[d]}}' logs/get_sequence.log | sort -k1,1 > wwwtmp/getSequenceStats";
shell_exec($command);
shell_exec('R --no-save < stats/getSequenceStats.R');

echo '<img src="../wwwtmp/getSequence.png"> ';

######################################################################
echo "<h2>Select / Download tool</h2>\n";

$command = "awk '{split(\$1, date, \"-\"); day[date[1]\"-\"date[2]\"-01\"]++}END{for (d in day){print d, day[d]}}' logs/select_promoters.log | sort -k1,1 > wwwtmp/selectPromotersStats";
shell_exec($command);
shell_exec('R --no-save < stats/selectPromotrsStats.R');

echo '<img src="../wwwtmp/selectPromoters.png"> ';

######################################################################
echo "<h2>Plot Gene tool</h2>\n";

$command = "awk '{split(\$1, date, \"-\"); day[date[1]\"-\"date[2]\"-01\"]++}END{for (d in day){print d, day[d]}}' logs/plot_gene.log | sort -k1,1 > wwwtmp/plotGeneStats";
shell_exec($command);
shell_exec('R --no-save < stats/plotGene.R');

echo '<img src="../wwwtmp/plotGene.png"> ';


######################################################################
echo "<h2>LiftOver Tool</h2>\n";

$old_path = getcwd();
$command = 'awk \'{split($1, date, "-"); day[date[1]"-"date[2]"-01"]++}END{for (d in day){print d, day[d]}}\' logs/liftOver.log | sort -k1,1 > wwwtmp/liftOverStats';
shell_exec($command);
shell_exec('R --no-save < stats/liftOver.R');

echo '<img src="../wwwtmp/liftOver.png"> ';


chdir($old_path);




######### Insert the footer #########

readfile("../footer.html");





echo "</body>\n";
echo "</html>";

?>
