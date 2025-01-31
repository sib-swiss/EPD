<?php

include("url_extern.php");

$db = $_POST['query_db'];
$action = $_POST['action'];

date_default_timezone_set("Europe/Rome");

function VisitorIP(){
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
  else $TheIp=$_SERVER['REMOTE_ADDR'];

  return trim($TheIp);
}
$Users_IP_address = VisitorIP();
$unique = rand(10000, 99999);
$date = date('Y-m-d');
$time = date('H:i:s');

// write the data to a log file
$fp = fopen('./logs/EPDnew_analysis.log', 'a');
fwrite($fp, "$date\t$time\t$Users_IP_address\t$db\t$action\n");
fclose($fp);

$serie = "epdnew";

if ($db == "human"){
  $specie = "hg38";
}else if ($db == "human_nc"){
  $specie = "hg38";
  $serie = "epd-nc";
}else if ($db == "mouse_nc"){
  $specie = "mm10";
  $serie = "epd-nc";
}else if ($db == "mouse"){
  $specie = "mm9";
}else if ($db == "M_mulatta"){
  $specie = "rheMac8";
}else if ($db == "C_familiaris"){
  $specie = "canFam3";
}else if ($db == "R_norvegicus"){
  $specie = "rn6";
}else if ($db == "G_gallus"){
  $specie = "galGal5";
}else if ($db == "drosophila"){
  $specie = "dm6";
}else if ($db == "zebrafish"){
  $specie = "danRer7";
}else if ($db == "worm"){
  $specie = "ce6";
}else if ($db == "arabidopsis"){
  $specie = "araTha1";
}else if ($db == "Z_mays"){
  $specie = "zm3";
}else if ($db == "S_cerevisiae"){
  $specie = "sacCer3";
}else if ($db == "S_pombe"){
  $specie = "spo2";
}else if ($db == "A_mellifera"){
  $specie = "amel5";
}else if ($db == "P_falciparum"){
  $specie = "pfa2";
}

if ($action == 'toChipcor'){
  $address = "$url_chipseq/chip_cor.php?series=$serie&species=$specie&strand=oriented";
}else if ($action == 'toOprof'){
  $address = "$url_ssa/oprof.php?series=$serie&species=$specie";
}else if ($action == 'toFindm'){
  $address = "$url_ssa/findm.php?series=$serie&species=$specie";
}
echo "Address $address<br>";
header("Location: $address");

?>


