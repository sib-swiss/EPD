<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

# Get all the variable:
$unique      = generateRandomString();
$assembly    = $_GET['assembly'];
$promoter_id = $_GET['pid'];

if (!$assembly){
    $assembly = "hg19";
    $promoter_id = "POLD1_1";
}

# Get the database name:
$confFile = fopen('../etc/epd.conf', 'r')  or die('Unable to open configuration file!!');
if ($confFile) {
    while (($line = fgets($confFile)) !== false) {
        // process the line read.
        $parts = preg_split('/\t+/', rtrim($line));
        $database[$parts[1]] = $parts[1]."_epdnew";
    }
    fclose($confFile);
} else {
    // error opening the file.
    die("Unable to open configuration file!");
}
#fclose($confFile);

#print "$assembly $promoter_id $database";

# Connect to the database
$db_con = mysqli_connect("127.0.0.1","ccgweb","ccgweb",$database[$assembly]);
/* check connection */
if (!$db_con){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

# Get promoter coordinates / properties
$query = "SELECT expression, position, sample FROM promoter_expression WHERE id LIKE '$promoter_id' ORDER BY position, sample";
#echo "$query<br>";
if ($stmt = $db_con->prepare("$query")) {
    $stmt->execute();
    $stmt->bind_result($expression, $position, $sample);
    while ($stmt->fetch()) {
        if ( ! isset($count[$position])) {
            $count[$position] = 1;
        }else{
            $count[$position]++;
        }
        if (! isset($samples[$position]) ){
            $c = 1;
            $samples[$position] = "<table><tr><th></th><th>Sample Name</th><th>Expression</th><th>Position</th></tr><tr><td>$c</td><td width='500px'>$sample</td><td>$expression</td><td>$position</td></tr>";
        }else{
            $c++;
            $samples[$position] .= "<tr><td>$c</td><td>$sample</td><td>$expression</td><td>$position</td></tr>";
        }
    }
    $stmt->close();
}else{
    echo "There is something wrong in the first query!<br>";
}

$query = "SELECT number_of_samples, average_expression FROM promoter_average_expression WHERE id LIKE '$promoter_id'";
if ($stmt = $db_con->prepare("$query")) {
    $stmt->execute();
    $stmt->bind_result($nSamples, $averageExpression);
    $stmt->fetch();
    $stmt->close();
}else{
    echo "There is something wrong in the query to average expression table!<br>";
}

# close connection to database
$db_con->close();

# prepare variables:
foreach ($count as $pos => $value) {
    $namediv = "pos".str_replace("-","_",$pos);
    #  echo "$namediv";
    if ( ! isset($positions)) {
        $positions = $pos;
    }else{
        $positions .= " ".$pos;
    }
    if ( ! isset($counts)) {
        $counts = $value;
    }
    else{
        $counts .= " ".$value;
    }
    if (! isset($samplesDiv)){
        $samplesDiv = "<div id='$namediv' style='display:none;'>$value samples have a TSS at position $pos <p> $samples[$pos]</table></p></div>";
    }else{
        $samplesDiv .= " <div id='$namediv' style='display:none;'>$value samples have a TSS at position $pos <p> $samples[$pos]</table> </p></div>";
    }
}


echo json_encode(Array(
    'nSamples' => $nSamples,
    'averageExpression' => $averageExpression,
    'positions' => $positions,
    'counts' => $counts,
    'samples' => $samplesDiv
)
);



?>
