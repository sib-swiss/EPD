<?php

function VisitorIP(){
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
  else $TheIp=$_SERVER['REMOTE_ADDR'];

  return trim($TheIp);
}

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
$unique           = generateRandomString();
$date             = date('Y-m-d');
$db               = $_GET['database'];
$motifLib         = $_GET['motif_lib'];
$gene_id          = $_GET['gene_id'];
$tf               = $_GET['tf'];
$wfrom            = $_GET['from'];
$wto              = $_GET['to'];
$Users_IP_address = VisitorIP();
$tf_name          = $_GET['tfname'];
$coEval           = $_GET['co'];

# write the data to a log file
$fp = fopen('./logs/plot_gene.log', 'a');
fwrite($fp, "$date\t$Users_IP_address\t$db\t$gene_id\t$motifLib\t$tf_name\t$coEval\t$wfrom\t$wto\n");
fclose($fp);

# Set-up temp files:
$fps_temp   = "./wwwtmp/plot_gene_".$unique.".temp";
$wmx_temp   = "./wwwtmp/plot_gene_".$unique.".wmx";
$oprof_temp = "./wwwtmp/plot_gene_".$unique.".out";
$tfbs_temp  = "./wwwtmp/plot_gene_".$unique.".txt";
$mat_temp   = "./wwwtmp/mat_".$unique.".txt";

# Set-up databases:
$confFile = fopen('../etc/epd.conf', 'r')  or die('Unable to open configuration file!');
if ($confFile) {
  while (($line = fgets($confFile)) !== false) {
    // process the line read.
    $parts = preg_split('/\t+/', rtrim($line));
    if ($parts[0] == "hg"){
      $dbId["epdNew_".$parts[0]] = "Hs";
    }else{
      $dbId["epdNew_".$parts[0]] = ucfirst($parts[0]);
    }
    $ftpDir["epdNew_".$parts[0]] = $parts[1];
    // $viewerDBs[$parts[1]] = $parts[0]."EpdNew";
    // $downloadDBs[$parts[1]] = str_replace('_','.',$databases[$parts[1]]);
    //echo "/$parts[0]-$parts[1]-$parts[2]- $downloadDBs[$parts[1]]/<br/>\n";
    //    echo "/$parts[0]-$parts[1]-$parts[2]/<br/>\n";
  }
  fclose($confFile);
} else {
  // error opening the file.
  die("Unable to open configuration file!");
}
#fclose($confFile);

$fps_file = "../htdocs/ftp/epdnew/$ftpDir[$db]/current/$dbId[$db]_EPDnew.fps";

# check the BG frequencies for the new organisms and add them here:
if ($db == "epdNew_hg"){
  $bg = "'0.29, 0.21, 0.21, 0.29'";
}elseif ($db == "epdNew_hsNC"){
  $bg = "'0.29, 0.21, 0.21, 0.29'";
}elseif ($db == "epdNew_mm"){
  $bg = "'0.29, 0.21, 0.21, 0.29'";
}elseif ($db == "epdNew_rn"){
  $bg = "'0.29, 0.21, 0.21, 0.29'";
}elseif ($db == "epdNew_cf"){
  $bg = "'0.29, 0.21, 0.21, 0.29'";
}elseif ($db == "epdNew_dm"){
  $bg = "'0.29, 0.21, 0.21, 0.29'";
}elseif ($db == "epdNew_dr"){
  $bg = "'0.32, 0.18, 0.18, 0.32'";
}elseif ($db == "epdNew_ce"){
  $bg = "'0.32, 0.18, 0.18, 0.32'";
}elseif ($db == "epdNew_at"){
  $bg = "'0.32, 0.18, 0.18, 0.32'";
}elseif ($db == "epdNew_zm"){
  $bg = "'0.27, 0.23, 0.23, 0.27'";
}elseif ($db == "epdNew_sc"){
  $bg = "'0.31, 0.19, 0.19, 0.31'";
}elseif ($db == "epdNew_sp"){
  $bg = "'0.32, 0.18, 0.18, 0.32'";
}elseif ($db == "epdNew_am"){
  $bg = "'0.32, 0.18, 0.18, 0.32'";
}elseif ($db == "epdNew_pf"){
  $bg = "'0.40, 0.10, 0.10, 0.40'";
}else{
  $bg = "'0.29, 0.21, 0.21, 0.29'";
}

# Set up matrix files:
if ($motifLib == "jasparCoreVertebrates"){
  $pwmFile = "../htdocs/pwmlib/JASPAR_CORE_2018_vert_matrix_logodds.mat";
}else if ($motifLib == "jasparCorePlants"){
  $pwmFile = "../htdocs/pwmlib/JASPAR_CORE_2018_plants_matrix_logodds.mat";
}else if ($motifLib == "jasparCoreInsects"){
  $pwmFile = "../htdocs/pwmlib/JASPAR_CORE_2018_insects_matrix_logodds.mat";
}else if ($motifLib == "uniprobeWorm"){
  $pwmFile = "../htdocs/pwmlib/uniprobe_worm_matrix_logodds.mat";
}else if ($motifLib == "swissRegulonYeast"){
  $pwmFile = "../htdocs/pwmlib/SwissRegulon_s_cer_matrix_logodds.mat";
}

# Run the external command to find the TFBS:
exec("awk '\$2 == \"$gene_id\" {print \$0}' $fps_file | uniq > $fps_temp");
$tssPos = shell_exec("awk 'BEGIN  { FIELDWIDTHS = \"5 20 27 1 10 8\" }{print \$5}' $fps_temp");
$tssStrand = shell_exec("awk 'BEGIN  { FIELDWIDTHS = \"5 20 27 1 10 8\" }{print \$4}' $fps_temp");
$tssPos = str_replace('\n', '', $tssPos);
$tssStrand = str_replace('\n', '', $tssStrand);


# Set-up WMX files:
if ($motifLib == "promoter"){
    if ($tf == "tata"){
        $tf_file = "../htdocs/pwmlib/TATA-box.wmx";
    }elseif ($tf == "gcbox"){
        $tf_file = "../htdocs/pwmlib/GC-box.wmx";
    }elseif ($tf == "ccaatbox"){
        $tf_file = "../htdocs/pwmlib/CCAAT-box.wmx";
    }elseif ($tf == "initiator"){
        $tf_file = "../htdocs/pwmlib/Initiator.wmx";
    }elseif ($tf == "splice-sites"){
        $tf_file = "../htdocs/pwmlib/Splice-sites.wmx";
    }
    $command='awk \'BEGIN{print ">log-odds matrix TATA-box"}$1 == "WM"{print $3*100, $4*100, $5*100, $6*100}\' '.$tf_file.' > '.$mat_temp;
    exec($command);
    $command = 'matrix_prob -e '.$coEval.' -b '.$bg.' '.$mat_temp.' 2> /dev/null | grep -o "[0-9]*.[0-9]*%" | sed -e "s@%@@"';
    $tf_cutoff = shell_exec($command);
    $tf_cutoff = str_replace("\n", '', $tf_cutoff);
}else{
    $tf_file = "./wwwtmp/wmxMat_".$unique.".wmx";
    exec("awk 'BEGIN{RS=\">\";}\$0 ~ \"$tf\"{print \">\"\$0}' $pwmFile > $mat_temp");
    $command = 'matrix_prob -e '.$coEval.' -b '.$bg.' '.$mat_temp.' 2> /dev/null | grep -o "[0-9]*.[0-9]*%" | sed -e "s@%@@"';
    #$command1 = 'CO="97.2%";';
    #print "$command\n";
    $tf_cutoff = shell_exec($command);
    $tf_cutoff = str_replace("\n", '', $tf_cutoff);
    #print "cut off = [ $tf_cutoff ]";
    # I have to change this line since this is a new version of PHP [delete &, here and on other lines where it happen]:
    #exec("grep -o \"w= [0-9]*\" $mat_temp | sed 's/w= //'", &$tf_length);
    exec("grep -o \"w= [0-9]*\" $mat_temp | sed 's/w= //'", $tf_length);
    $command2 = ' awk -v "co='.$tf_cutoff.'" -v \'l='.$tf_length[0].'\' \'function ceil(valor){return(valor == int(valor)) ? valor : int(valor) + 1} BEGIN{pos=ceil(l/2)-l; printf "%-5s%-65sFP\n", "TI", "'.$tf_name.'"; print "XX"; printf "%-6s%s\n", "CO", co; print "XX";} $1 !~ ">" {if ($0 != ""){printf "WM %6s%s \n", pos, $0; pos++}} END {print "//"}\' '.$mat_temp.' > '.$tf_file;
    #print "$command2\n<br>";
    exec($command2);
}

# Write the FINDM input file
exec("echo '\n$fps_temp' > $wmx_temp");
exec("echo ' $wfrom' >> $wmx_temp");
exec("echo ' $wto' >> $wmx_temp");
exec("echo '@' >> $wmx_temp");
exec("cat $tf_file >> $wmx_temp");
#exec("grep -c '^WM' $tf_file", &$tf_length);
exec("grep -c '^WM' $tf_file", $tf_length);
exec("echo '$tf_cutoff' >> $wmx_temp"); # this is the cut-off value that in this case is in the wmx file
$tf_l = $tf_length[0] * 2;
if ($motifLib == "promoter"){
  exec("echo 'U' >> $wmx_temp");
}else{
  exec("echo 'B' >> $wmx_temp");
}
exec("echo 'M' >> $wmx_temp");
#exec("echo ' 1' >> $wmx_temp");
#exec("echo 'B' >> $wmx_temp");

# Run FINDM:
exec("export SSA2DBC=/usr/local/EPD_web.git/htdocs/ssa/data/SSA2DBC.def; FINDM < $wmx_temp > $oprof_temp 2> /dev/null"); # code changed
exec("awk 'BEGIN  { FIELDWIDTHS = \"5 20 27 1 10 8\" } \$1~\"^FP\" {print \$5}' $oprof_temp", $matches);

# This set the first stripe on the TSS:
$i = 0;
$uniqueMatches = array_unique($matches);
asort($uniqueMatches);
print "<p>$tf_name [p-value = $coEval]: ";
foreach ($uniqueMatches as $match){
  $i++;
  $match = str_replace('\n', '', $match);
#  $test = preg_match('/+/', $tssStrand);
#  print "$tssStrand $test";
  if (preg_match("/\+/", $tssStrand) > 0){
    $start = $match - $tssPos;
  } else {
    $start = $tssPos - $match;
  }
  if ($i == 1){
    $to_text = $tf_length[0];
    $level_text = 100;
    $from_text = $start - $wfrom;
    $end = $start + $to_text;
#    print "<p></p>$tf_name found at: $start [p-value = $coEval]<br />";
    print "$start";
  }else{
    $to_text .= "_". $tf_length[0];
    $level_text .= "_". 100;
    $from_text .= "_". ($start - $wfrom);
    $end = $start + $to_text;
#    print "$tf_name found at: $start [p-value = $coEval]<br />";
    print ", $start";
  }
}
#print "$gene_id $db $tf $wmx_temp $tssStrand $motifLib";

if ($i == 0){
  print "no hit found.<br>";
  print "<div id='pgene'>";
  print "<div id='p_from'></div>";
  print "<div id='p_to'></div>";
  print "<div id='p_level'></div>";
  print "</div>";
 }else{
  print "<div id='pgene'>";
  print "<div id='p_from'>$from_text</div>";
  print "<div id='p_to'>$to_text</div>";
  print "<div id='p_level'>$level_text</div>";
  print "</div>";
 }
print "</p>";

?>
