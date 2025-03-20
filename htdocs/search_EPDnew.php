<?php

$query_str = $_POST['query_str'];
$db = $_POST['query_db'];
if (empty($query_str)){
  $query_str = $_GET['query'];
  $db = $_GET['db'];
}

/* echo "<input type='hidden'id='query_str' value='$query_str'>"; */


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

# Get the database:
$db = $_POST['query_db'];
$str = $_POST['query_str'];
if (empty($str)){
  $str = $_GET['query'];
  $db = $_GET['db'];
}

#echo "$db $str<br>";
# Replace 'space' character with '%' (wild-card in mysql)
$string = str_replace(' ', '%', $str);
$string1 = "%".$string."%";
$string2 = "%".$string;
$string3 = $string."%";

#print ($string);

$confFile = fopen('../etc/epd.conf', 'r')  or die('Unable to open configuration file!');
if ($confFile) {
  while (($line = fgets($confFile)) !== false) {
    // process the line read.
    $parts = preg_split('/\t+/', rtrim($line));
    $dbId[$parts[1]] = $parts[0];
    $databases[$parts[1]] = $parts[1]."_epdnew";
    $viewerDBs[$parts[1]] = $parts[0]."EpdNew";
    $downloadDBs[$parts[1]] = str_replace('_','.',$databases[$parts[1]]);
    //echo "/$parts[0]-$parts[1]-$parts[2]- $downloadDBs[$parts[1]]/<br/>\n";
    //    echo "/$parts[0]-$parts[1]-$parts[2]/<br/>\n";
  }
  fclose($confFile);
} else {
  // error opening the file.
  die("Unable to open configuration file!");
}
#fclose($confFile);


$db_con = mysqli_connect("127.0.0.1","ccgweb","ccgweb",$databases[$db]);

  /* check connection */
if (!$db_con)
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if ($stmt = $db_con->prepare("SELECT gene_description.id, gene_description.gene_name, gene_description.description  FROM gene_description
       LEFT JOIN (promoter_sequence, promoter_ensembl, cross_references)
       ON (
	  promoter_sequence.id=gene_description.id AND
	  promoter_ensembl.id=gene_description.id AND
	  promoter_ensembl.ensembl_id=cross_references.ensembl_id
	  )
       WHERE (
	     LOWER(gene_description.id) LIKE LOWER( ? ) OR
             LOWER(gene_description.description) LIKE LOWER( ? ) OR
             LOWER(gene_description.gene_name) LIKE LOWER( ? ) OR
             LOWER(promoter_sequence.sequence) LIKE LOWER( ? ) OR
	     LOWER(promoter_ensembl.ensembl_id) LIKE LOWER( ? ) OR
	     LOWER(cross_references.refseq_id) LIKE LOWER( ? )
	     )
	     ORDER BY CASE WHEN LOWER(gene_description.id) LIKE LOWER( ? ) THEN 1 WHEN LOWER(gene_description.gene_name) LIKE LOWER( ? ) THEN 2 WHEN LOWER(gene_description.gene_name) LIKE LOWER( ? ) THEN 3 WHEN LOWER(gene_description.gene_name) LIKE LOWER( ? ) THEN 4 WHEN LOWER(gene_description.gene_name) LIKE LOWER( ? ) THEN 5 WHEN LOWER(gene_description.gene_name) LIKE LOWER( ? ) THEN 6 WHEN LOWER(gene_description.description) LIKE LOWER( ? ) THEN 7 ELSE 8 END;")) {

    /* bind parameters for markers */
  $stmt->bind_param("sssssssssssss", $string1, $string1, $string1, $string1, $string1, $string1, $string, $string, $string3, $string2, $string1, $string3, $string);

  /* execute query */
  $stmt->execute();

  /* bind result variables */
  $stmt->bind_result($id, $name, $description);

  /* result container */
  $result = "";
  $c = 0;

  /* fetch value */
  while ($stmt->fetch()) {
    $link = "/cgi-bin/miniepd/get_doc?db=$viewerDBs[$db]&format=genome&entry=$id";

    $result .= "<tr align='left' class='fetch' style='border-bottom: 1px solid lightgray'>\n";
    $result .= "<td align='center' style='width:10px;'><input type='checkbox' name='gene_symbol' value='$id' onclick=\"showMe('downloadopt');\"/></td>\n";
    $result .= "<td align='left' style='min-width:100px;'><a href='$link'>$id</a></td>\n";
    $result .= "<td style='min-width:100px;'>$name</td>\n";
    $result .= "<td style='width:500px;'>$description</td>\n";
    $linkT   = "/cgi-bin/miniepd/get_doc?db=$viewerDBs[$db]&format=text&entry=$id";
    $result .= "<td align='center' width='15'><a href='$linkT'> <img border='0' bordercolor='black' src='/img_epd/Text_small.png' alt='T' width='15' height='15'> </a> </td><td></td></tr>\n";
    $c++;
  }

  /* close statement */
  $stmt->close();
}


$db_con->close();


/* print out the page (if there is */
/* only one result go directly to the viewer): */
if ($c == 1){
  echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>";
  echo "<html lang='en'>";
  echo "<head>";
  echo "<script>window.location = \"$link\";</script>";
  echo "</head>";
  echo "</html>";
}else if ($c == 0){
  include("header.php");
  echo "<h3>Sorry, no hit found</h3>";
}else{
  include("header.php");

  echo "<input type='hidden' id='query_str' value='$query_str'>";
  echo "<p>";
  echo "<form id='result' action='/cgi-bin/miniepd/download_sequences.cgi' method='POST' target='_blank'>";
  echo "<table align='left' style='width: 99%; font-size: 12px; font-family: Helvetica;' border='0'>";
  echo "<tr align='left' style='border-bottom: 2px solid lightgray; height:40px;'>";
  echo "<td align='center' style='width:10px;'><input type='checkbox' name='checkall' onclick=\"checkedAll(); showMe('downloadopt')\"></td>";
  echo "<td colspan='5'>";
  echo "<div style='display:block' id='selectall'>";
  echo "Select one or more promoters to download them.";
  echo "</div>";

  echo "<div style='display:none' id='downloadopt'>";
  echo "<table>";
  echo "<tr>";
  echo "<td>";
  echo "Download as:";
  echo "</td>";
  echo "<td>";
  echo "<select id='type' name='format' class='epddownload' onchange='selectShowDiv(this)' style='border-style:solid; border-color:#CCCCCC; height:21px;  border-width:1px; width:70px;'>";
  echo "<option value='fasta' select='selected'>FASTA</option>";
  echo "<option value='sga'>SGA</option>";
  echo "<option value='fps'>FPS</option>";
  echo "</select>";
  echo "</td>";
  echo "<td style='min-width:200px;'>";
  echo "<div id='param' style='display:inline;'>";
  echo "from <INPUT type='text' name='from' size='5' value='-499' class='epddownload'> ";
  echo "to <INPUT type='text' name='to'   size='5' value='100' class='epddownload'>";
  echo "</div>";
  echo "</td>";
  echo "<td>";
  echo "<input class='epdsubmit' type='submit' value='Download'>";
  echo "<input type='hidden' name='database' id='database' value='$dbId[$db]'>";
  echo "</td>";
  echo "</tr>";
  echo "</table>";
  echo "</div></td></tr>";
  echo "</table><br>";

  echo "<div id='genes'>";
  echo "<table align='left' style='width: 99%; font-size: 12px; font-family: Helvetica;' border='0'>";
  echo "<tr align='left' style='border-bottom: 2px solid lightgray; height:30px;'>";
  echo "<td style='width:10px;'></td>";
  echo "<td><b>Promoter ID</b></td>";
  echo "<td><b>Gene Name</b></td>";
  echo "<td><b>Description</b></td>";
  echo "<td></td>";
  echo "<td></td>";
  echo "</tr>";
  /* Print the result lines */
  echo "$result";
  echo "</table></div>";
  echo "</form>";
}

?>

<!-- ######### Insert the footer #########-->
<?php readfile("footer.html"); ?>


