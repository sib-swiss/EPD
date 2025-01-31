<?php
   $final_results = array();
$databases = array("human_epdnew","mouse_epdnew","zebrafish_epdnew","drosophila_epdnew","arabidopsis_epdnew","worm_epdnew");
foreach ($databases as &$db) {
  $db_con = mysqli_connect("127.0.0.1","ccgweb","ccgweb",$db);
  /* check connection */
  if (!$db_con)
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
  if ($stmt = $db_con->prepare("SELECT DISTINCT(gene_name) FROM gene_description ORDER BY gene_name")) {
    /* execute query */
    $stmt->execute();
    /* bind result variables */
    $stmt->bind_result($name);
    /* fetch value */
    while ($stmt->fetch()) {
      array_push($final_results, strtoupper($name));
    }
  }
  /* close connection */
  $db_con->close();
}
$results = array_unique($final_results);
print_r($results);
// convert the PHP array into JSON format, so it works with javascript
$json_array = json_encode($results);
?>

