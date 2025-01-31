<?php

$address = $_GET['address'];

foreach(array_keys($_GET) as $key){
  if ($key != 'address'){
    $params[$key] = $_GET[$key];
    $address = $address."&".$key."=".$_GET[$key];
  }
}


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
$fp = fopen('./logs/external_resources.log', 'a');
fwrite($fp, "$date\t$time\t$Users_IP_address\t$address\n");
fclose($fp);

#echo $address;
header("Location: $address");
#http_redirect($address, $params, false, HTTP_REDIRECT_PERM);

?>


