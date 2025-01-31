<?php
$db = $_GET['database'];
$string = $_GET['query_str'];

$string1 = "%$string%";


$confFile = fopen("../../etc/epd.conf", "r") or die("Unable to open configuration file!");
if ($confFile) {
  while (($line = fgets($confFile)) !== false) {
    // process the line read.
    $parts = preg_split('/\t+/', rtrim($line));
    //$dbId[$parts[1]] = $parts[0];
    $databases[$parts[0]] = $parts[1]."_epdnew";
    //$viewerDBs[$parts[1]] = $parts[0]."EpdNew";
    //$downloadDBs[$parts[1]] = str_replace('_','.',$databases[$parts[1]]);
    //echo "/$parts[0]-$parts[1]-$parts[2]- $downloadDBs[$parts[1]]/<br/>\n";
    //    echo "/$parts[0]-$parts[1]-$parts[2]/<br/>\n";
  }
  fclose($confFile);
} else {
  // error opening the file.
  die("Unable to open configuration file!");
}
#fclose($confFile);


/* if ($db == "human" or $db == "hg"){ */
/*   $database = "human_epdnew"; */
/* }else if ($db == "mouse" or $db == "mm"){ */
/*   $database = "mouse_epdnew"; */
/* }else if ($db == "drosophila" or $db == "dm"){ */
/*   $database = "drosophila_epdnew"; */
/* }else if ($db == "zebrafish" or $db == "dr"){ */
/*   $database = "zebrafish_epdnew"; */
/* }else if ($db == "worm" or $db == "ce"){ */
/*   $database = "worm_epdnew"; */
/* }else if ($db == "arabidopsis" or $db == "at"){ */
/*   $database = "arabidopsis_epdnew"; */
/* }else if ($db == "Z_mays" or $db == "zm"){ */
/*   $database = "Z_mays_epdnew"; */
/* }else if ($db == "S_cerevisiae" or $db == "sc"){ */
/*   $database = "S_cerevisiae_epdnew"; */
/* }else if ($db == "S_pombe" or $db == "sp"){ */
/*   $database = "S_pombe_epdnew"; */
/* }else if ($db == "A_mellifera" or $db == "am"){ */
/*   $database = "A_mellifera_epdnew"; */
/* } */


$db_con = mysqli_connect("127.0.0.1","ccgweb","ccgweb",$databases[$db]);

/* check connection */
if (!$db_con)
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if ($stmt = $db_con->prepare("SELECT COUNT( * ) FROM gene_description
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
	     )")) {

    /* bind parameters for markers */
  $stmt->bind_param("ssssss", $string1, $string1, $string1, $string1, $string1, $string1);

    /* execute query */
  $stmt->execute();

    /* bind result variables */
  $stmt->bind_result($count);

    /* fetch value */
  $promoter = 0;
  while ($stmt->fetch()) {
    $promoter = $count;
  }
  echo "$promoter promoters";
#  echo "$num_rows promoters";
    /* close statement */
  $stmt->close();
}

/* close connection */
$db_con->close();

?>

