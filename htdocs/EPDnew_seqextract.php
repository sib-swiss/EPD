<?php

function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


$fps      = $_POST['fpsfilename'];
$from     = $_POST['from'];
$to       = $_POST['to'];
$assembly = $_POST['assembly'];
$fetch_db  = $assembly;
$fastaname = $assembly."_".generateRandomString().".fa";

shell_exec("../cgi-bin/fps2fa.pl $fps $from $to $fetch_db > wwwtmp/$fastaname");

header("Location: wwwtmp/$fastaname");

?>
