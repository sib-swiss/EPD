<?php

include("header.php");

echo "<h1>News archives</h1>";
echo "<p>News from the EPD database and the other tools (<a href='https://epd.expasy.org/chipseq/'>ChIP-Seq</a>, <a href='https://epd.expasy.org/ssa/'>SSA</a>, <a href='https://bchub.epfl.ch'>BCHub</a>, <a href='https://epd.expasy.org/pwmtools/'>PWMTools</a>) and database (<a href='https://epd.expasy.org/chipseq/data/html/res_data.php'>MGA</a>) maintained by the <a href='https://www.sib.swiss/philipp-bucher-group'>CCG group</a>.</p>";

# Print out the news table
$txt_file = file_get_contents('newsTable.tsv');
$rows     = explode("\n", $txt_file);
rsort($rows);
## One news per line
## Fields separated by tab:
## YYYY-MM-DD\tSERVICE\thtml text
echo "<table id='news_table' style='font-size:14px;font-family:Helvetica;width:99%'>\n";
foreach($rows as $row => $data){
    $fields = explode("\t", $data);
    if (empty($fields[0])){
        continue;
    }
    echo "<tr><td style='width:95px'>", $fields[0];
    echo "</td><td>", $fields[1];
    echo "</td><td>", $fields[2];
    echo "</td></tr>\n";
}
echo "</table><br><br><br><br><br>\n";


######### Insert the footer #########
readfile("footer.html");

?>
