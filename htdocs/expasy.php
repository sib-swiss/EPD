<?php
$type = strtolower($_GET['type']);
$query = $_GET['query'];

$string1 = "%$query%";

if ($type == "text"){
  $lquery = "SELECT gene_description.id, gene_description.gene_name, gene_description.description  FROM gene_description
       LEFT JOIN (promoter_sequence, promoter_ensembl, cross_references)
       ON (
	  promoter_sequence.id=gene_description.id AND
	  promoter_ensembl.id=gene_description.id AND
	  promoter_ensembl.ensembl_id=cross_references.ensembl_id
	  )
       WHERE (
	     LOWER(gene_description.id) LIKE LOWER( ? ) OR
             LOWER(gene_description.description) LIKE LOWER( ? ) OR
             LOWER(gene_description.gene_name) LIKE LOWER( ? )
	     )";
}else if ($type == "ensemblid"){
  $lquery = "SELECT gene_description.id, gene_description.gene_name, gene_description.description  FROM gene_description
       LEFT JOIN (promoter_sequence, promoter_ensembl, cross_references)
       ON (
	  promoter_sequence.id=gene_description.id AND
	  promoter_ensembl.id=gene_description.id AND
	  promoter_ensembl.ensembl_id=cross_references.ensembl_id
	  )
       WHERE (
	     LOWER(promoter_ensembl.ensembl_id) LIKE LOWER( ? )
	     )";
}else if ($type == "refseq"){
  $lquery = "SELECT gene_description.id, gene_description.gene_name, gene_description.description  FROM gene_description
       LEFT JOIN (promoter_sequence, promoter_ensembl, cross_references)
       ON (
	  promoter_sequence.id=gene_description.id AND
	  promoter_ensembl.id=gene_description.id AND
	  promoter_ensembl.ensembl_id=cross_references.ensembl_id
	  )
       WHERE (
	     LOWER(cross_references.refseq_id) LIKE LOWER( ? )
	     )";
    }else{
  $error = 1;
}

# loop through databases:
$promoter = 0;

# Get the DB names from config file
$confFile = fopen('../etc/epd.conf', 'r')  or $error = 3;
if ($confFile) {
  while (($line = fgets($confFile)) !== false) {
    // process the line read.
    $parts = preg_split('/\t+/', rtrim($line));
    $databases[] = $parts[1]."_epdnew";
  }
  fclose($confFile);
} else {
  // error opening the file.
  die("Unable to open configuration file!");
}
#fclose($confFile);


#foreach (array("human_epdnew","mouse_epdnew","drosophila_epdnew","zebrafish_epdnew","worm_epdnew","arabidopsis_epdnew","S_cerevisiae_epdnew","S_pombe_epdnew","Z_mays_epdnew") as $db){
foreach ($databases as $db){

  $db_con = mysqli_connect("127.0.0.1","ccgweb","ccgweb",$db);
  $sprom[$db] = 0;

  /* check connection */
  if (!$db_con)
    {
      $error = 2;
    }


  if ($stmt = $db_con->prepare($lquery)) {
    /* echo "$lquery <br><br> test\n"; */

    /* bind parameters for markers */
    if ($type == "text"){
      $stmt->bind_param("sss", $string1, $string1, $string1);
    }else{
      $stmt->bind_param("s", $query);
    }

    /* execute query */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($id, $name, $description);

    /* fetch value */
    while ($stmt->fetch()) {
      $promoter++;
      $sprom[$db]++;
    }
    /* close statement */
    $stmt->close();
  }

  /* close connection */
  $db_con->close();
}
unset($db);

if ($error == 1){
  echo "<?xml version='1.0'?>
<ExpasyResult>
  <count>-1</count>
  <url>Unsupported type request</url>
</ExpasyResult>";
}else if ($error == 2){
  echo "<?xml version='1.0'?>
<ExpasyResult>
  <count>-1</count>
  <url>Unable to connect to MySQL server</url>
</ExpasyResult>";

}else if ($error == 3){
  echo "<?xml version='1.0'?>
<ExpasyResult>
  <count>-1</count>
  <url>Unable to find configuration file</url>
</ExpasyResult>";

}else{
  echo "<?xml version='1.0'?>
<ExpasyResult>
  <count>$promoter</count>
  <url>https://epd.expasy.org/miniepd/master_search.php?query=$query</url>
  <description>$promoter promoters found in EPDnew that match '$query'</description>
</ExpasyResult>";
}

?>

