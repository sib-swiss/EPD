<?php
if (!$_GET['query']){
    return;
}

$txt_file = file_get_contents('newsTable.tsv');
$rows     = explode("\n", $txt_file);
$service  = $_GET['query'];
$filtered_rows = preg_grep("/(\t$service\t|\t$service,|,$service\t|,$service,|ALL)/", $rows);
rsort($filtered_rows);
## One news per line
## Fields separated by tab:
## YYYY-MM-DD\tSERVICE\thtml text
foreach($filtered_rows as $row => $data){
    $fields = explode("\t", $data);
    if (empty($fields[0])){
        continue;
    }

    $hideshow = preg_replace("/<\/strong>/", "</strong> &nbsp; [<span id='newsshow' onclick='jQuery(\"#lastnewsid\").show();jQuery(\"#newshide\").show();jQuery(\"#newsshow\").hide();'>show</span><span id='newshide' onclick='jQuery(\"#lastnewsid\").hide();jQuery(\"#newsshow\").show();jQuery(\"#newshide\").hide();'>hide</span>]", $fields[2]);
    $lastnewsid = preg_replace("/divnews'/", "divnews' id='lastnewsid'", $hideshow);
    echo "<tr><td style='width:95px'>", $fields[0];
    echo "</td><td>", $lastnewsid;
    echo "</td></tr>\n";
    break;
}
?>
