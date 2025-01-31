<?php
$db = $_GET['database'];
$query = $_GET['query_str'];


if ($db == "ensembl_hg"){
  $dat_file = "ftp/epdnew/ENSEMBL/human/current/Hs_ENSEMBL.dat";
 }elseif ($db == "ensembl_mm"){
   $dat_file = "ftp/epdnew/ENSEMBL/mouse/current/Mm_ENSEMBL.dat";
 }elseif ($db == "ensembl_dm"){
   $dat_file = "ftp/epdnew/ENSEMBL/drosophila/current/Dm_ENSEMBL.dat";
 }elseif ($db == "epdNew_hg"){
  $dat_file = "ftp/epdnew/human/current/Hs_EPDnew.dat";
 }elseif ($db == "epdNew_mm"){
  $dat_file = "ftp/epdnew/mouse/current/Mm_EPDnew.dat";
 }elseif ($db == "epd"){
  $dat_file = "ftp/epd/current/epd.dat ftp/epd/current/epd_bulk.dat";
 }elseif ($db == "epdNew_dm"){
  $dat_file = "ftp/epdnew/drosophila/current/Dm_EPDnew.dat";
 }elseif ($db == "epdNew_dr"){
  $dat_file = "ftp/epdnew/zebrafish/current/Dr_EPDnew.dat";
 }elseif ($db == "epdNew_ce"){
  $dat_file = "ftp/epdnew/worm/current/Ce_EPDnew.dat";
 }elseif ($db == "all"){
  $dat_file = "ftp/epdnew/human/current/Hs_EPDnew.dat ftp/epdnew/mouse/current/Mm_EPDnew.dat ftp/epd/current/epd.dat ftp/epd/current/epd_bulk.dat ftp/epdnew/drosophila/current/Dm_EPDnew.dat ftp/epdnew/zebrafish/current/Dr_EPDnew.dat ftp/epdnew/worm/current/Ce_EPDnew.dat";
 }

//$query_str = '$0 ~ "'.$query.'"';
$fields = explode(' ', $query);
$query_str = '$0 ~ "'.$fields[0].'"';
foreach ($fields as $field){
  $query_str .= ' && $0 ~ "'.$field.'" ';
 }

//echo "cat $dat_file | awk 'BEGIN{IGNORECASE=1; RS=\"//\"; count=0} $query_str { count++ } END {print count}'";

echo exec("cat $dat_file | awk 'BEGIN{IGNORECASE=1; RS=\"//\"; count=0} $query_str { count++ } END {print count}'");
echo " promoters\n";
?>

