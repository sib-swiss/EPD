<?php

$query_str = $_POST['query_str'];
#echo "<input type='hidden'id='query_str' value='$query_str'>";
$db = $_POST['query_db'];
$_POST['ensembl'] = $query_str;

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
$fp = fopen('./logs/new_master_search.log', 'a');
fwrite($fp, "$date\t$time\t$Users_IP_address\t$db\t$query_str\n");
fclose($fp);

$address = "/cgi-bin/miniepd/fetch_biomart.cgi";
header("Location: $address");

$fps_file = "ftp/epd/current/epd.fps";
$dat_file = "ftp/epd/current/epd.dat ftp/epd/current/epd_bulk.dat";
$field = '$3';
$field2 = '$2';


?>

