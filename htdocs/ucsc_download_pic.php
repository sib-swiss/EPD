<?php

#$id = $_GET["id"];
#$chr = $_GET["chr"];
#$start = $_GET["start"];
#$stop = $_GET["stop"];

$id = $argv[1];
$chr = $argv[2];
$start = $argv[3];
$stop = $argv[4];

if (file_exists ("viewer/human/$id.png")){
  echo "Promoter $id already downloaded\n";
}else{
  echo "Downloading $id...\n";
  $range = $chr.":".$start."-".$stop;

  $url = "https://genome.ucsc.edu/cgi-bin/hgTracks?&clade=mammal&org=Human&db=hg19&position=$range&hgt.customText=/ucsc/hg19_test_4.wig&hubUrl=/ucsc/epdHub/epdTest5.txt";

  shell_exec("wget -p -q --limit-rate=100k --user-agent='' --directory-prefix=wwwtmp/$id '$url'");

  shell_exec("composite -gravity south wwwtmp/$id/genome.ucsc.edu/trash/hgt/hgt_genome_*.png wwwtmp/$id/genome.ucsc.edu/trash/hgtSide/side_genome_*.png viewer/human/$id.png; rm -R wwwtmp/$id");
}

?>
