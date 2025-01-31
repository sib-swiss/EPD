<?php

$final_results = array();
$cleanresults = array();

if (isset($_GET['query'])){
    $query = $_GET['query'];
}else{
    $query = 'MAPK1';
}
$string1 = "$query%";

if (isset($_GET['database'])){
    $db = $_GET['database'];
} else {
    $db = "all";
}

$confFile = fopen('../etc/epd.conf', 'r')  or die('Unable to open configuration file!');
if ($confFile) {
    while (($line = fgets($confFile)) !== false) {
        // process the line read.
        $parts = preg_split('/\t+/', rtrim($line));
        $dbs[] = $parts[1]."_epdnew";
    }
    fclose($confFile);
} else {
    // error opening the file.
    die("Unable to open configuration file!");
}
#fclose($confFile);


if ($db == "all"){
    #$databases = array("human_epdnew","mouse_epdnew","zebrafish_epdnew","drosophila_epdnew","arabidopsis_epdnew","worm_epdnew","S_cerevisiae_epdnew","S_pombe_epdnew","Z_mays_epdnew","A_mellifera_epdnew");
    $databases = $dbs;
} else {
    $databases = array($db."_epdnew");
}

#print count($databases);
#print $string1;

foreach ($databases as &$dtb) {
    $db_con = mysqli_connect("127.0.0.1","ccgweb","ccgweb",$dtb);
    /* check connection */
    if (!$db_con)
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    if ($stmt = $db_con->prepare("SELECT DISTINCT(gene_name) FROM gene_description WHERE LOWER(gene_name) LIKE LOWER( ? ) ORDER BY gene_name;")) {
        $stmt->bind_param("s", $string1);
        /* execute query */
        $stmt->execute();
        /* bind result variables */
        $stmt->bind_result($name);
        /* fetch value */
        while ($stmt->fetch()) {
            $badcharacters = array("'");
            $cleanName = str_replace($badcharacters, "", $name);
            array_push($final_results, strtoupper($cleanName));
        }
    }
    /* close connection */
    $db_con->close();
}
$results = array_unique($final_results);
sort($results);

// convert the PHP array into JSON format, so it works with javascript
// $json_array = json_encode($results);
print json_encode($results);
?>
