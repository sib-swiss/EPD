<?php

function VisitorIP(){
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
  else $TheIp=$_SERVER['REMOTE_ADDR'];

  return trim($TheIp);
}
$Users_IP_address = VisitorIP();

$unique = rand(10000, 99999);

date_default_timezone_set('Europe/Zurich');
$date = date('Y-m-d');
$db = $_GET['database'];
$gene_id = $_GET['gene_id'];
$from = $_GET['from'];
$to = $_GET['to'];
$lc = $_GET['lc'];

if ($gene_id == ""){
   $gene_id = "MAPK10_1";
   $from = -60;
   $db = "epdNew_hg";
   $to = 10;
   $lc = 0;
}

// Define databases:
$confFile = fopen('../etc/epd.conf', 'r')  or die('Unable to open configuration file!');
if ($confFile) {
  while (($line = fgets($confFile)) !== false) {
    // process the line read.
    $parts = preg_split('/\t+/', rtrim($line));
    if ($parts[0] == "hg"){
      $dbId["epdNew_".$parts[0]] = "Hs";
    }else{
      $dbId["epdNew_".$parts[0]] = ucfirst($parts[0]);
    }
    $ftpDir["epdNew_".$parts[0]] = $parts[1];
    // $viewerDBs[$parts[1]] = $parts[0]."EpdNew";
    // $downloadDBs[$parts[1]] = str_replace('_','.',$databases[$parts[1]]);
    //echo "/$parts[0]-$parts[1]-$parts[2]- $downloadDBs[$parts[1]]/<br/>\n";
    //    echo "/$parts[0]-$parts[1]-$parts[2]/<br/>\n";
  }
  fclose($confFile);
} else {
  // error opening the file.
  die("Unable to open configuration file!");
}

$fps_file = "../htdocs/ftp/epdnew/$ftpDir[$db]/current/$dbId[$db]_EPDnew.fps";
$dat_file = "../htdocs/ftp/epdnew/$ftpDir[$db]/current/$dbId[$db]_EPDnew.dat";
$fps_temp = "wwwtmp/get_sequence".$unique.".fps";

// Get the assembly:
exec("awk '\$2 == \"UCSC;\" {print \$3; exit}' $dat_file", $assembly);
foreach ($assembly as $as){
  if ($as == "hg18"){
    $fetch_db = "hs_nt";
  }else{
    $fetch_db = $as;
  }
}

// write the data to a log file
$fp = fopen('./logs/get_sequence.log', 'a');
fwrite($fp, "$date\t$Users_IP_address\t$db\t$gene_id\t$from\t$to\t$lc\n");
fclose($fp);

//if ($from == 0){
//  $from = 1;
//}
//if ($to == 0){
//  $to = 1;
//}
if ($from >= $to){
  echo "Error in retriving sequence.<br>'From' value must be greater than 'to'";
}

// Run the command to get the result and print it
exec("awk 'BEGIN{a=\"xxx\"} \$2 == \"$gene_id\" {if (a != \$6) {a = \$6; print }}' $fps_file  > $fps_temp");
exec("PERL5LIB= ../cgi-bin/fps2fa.pl $fps_temp $from $to $fetch_db $lc", $sequence);

foreach ($sequence as $value) {
  echo "$value<br />\n";
}

?>

