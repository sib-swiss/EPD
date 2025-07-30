<?php include("url_extern.php"); ?>
<?php

ini_set('display_errors', 'On');

function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


$destAssembly  = $_POST['dest_assembly'];
$origAssembly  = $_POST['orig_assembly'];
$bedFile       = $_POST['bed_file'];

if($destAssembly == ""){
  $destAssembly  = "Hg19";
  $origAssembly = "hg38";
  $bedFile = "wwwtmp/human_epdnew_drn8U.bed";
}

$ucscDestAssembly = strtolower($destAssembly);

// Write log file:
date_default_timezone_set("Europe/Rome");
function VisitorIP(){
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
  else $TheIp=$_SERVER['REMOTE_ADDR'];

  return trim($TheIp);
}
$Users_IP_address = VisitorIP();
$date = date('Y-m-d');
$time = date('H:i:s');
$fp = fopen('./logs/liftOver.log', 'a');
fwrite($fp, "$date\t$time\t$Users_IP_address\t$origAssembly -> $destAssembly\n");
fclose($fp);

$forward_host = array_key_exists('HTTP_X_FORWARDED_HOST', $_SERVER) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : '127.0.0.1';
$host_port = $forward_host === '127.0.0.1' ? '8081' : '';
$host_urls = explode(',', $forward_host);
$host_url = trim($host_urls[0]).$host_port;
$http = preg_match("/^https:/", $_SERVER['HTTP_ORIGIN']) ? 'https' : 'http';

# Generate files:
$liftoverBed = "wwwtmp/epdnew_".$origAssembly."To".$destAssembly."_".generateRandomString().".bed";
$liftoverSga = "wwwtmp/epdnew_".$origAssembly."To".$destAssembly."_".generateRandomString().".sga";
$liftoverFps = "wwwtmp/epdnew_".$origAssembly."To".$destAssembly."_".generateRandomString().".fps";
$liftoverUnmapped = "wwwtmp/epdnew_".$origAssembly."To".$destAssembly."_".generateRandomString().".unmapped";
# $chain = "/home/local/db/liftOver/".$origAssembly."/".$origAssembly."To".$destAssembly.".over.chain.gz";
$chain = "./liftOver/".$origAssembly."/".$origAssembly."To".$destAssembly.".over.chain.gz";

# liftOver oldFile map.chain newFile unMapped
shell_exec("export LD_LIBRARY_PATH=/lib64:/usr/lib64:/usr/lib64/mysql; liftOver $bedFile $chain $liftoverBed $liftoverUnmapped;");
#echo "liftOver $bedFile $chain $liftoverBed $liftoverUnmapped;";
#fwrite($fp, "liftOver $bedFile $chain $liftoverBed $liftoverUnmapped;");
#fclose($fp);
# shell_exec("bed2sga -a $ucscDestAssembly -f TSS $liftoverBed -x 4 > $liftoverSga;");
shell_exec("bed2sga -a $ucscDestAssembly -f TSS -x 4 $liftoverBed | sort -s -k1,1 -k3,3n -k4,4 > $liftoverSga;");
#echo "bed2sga -a $ucscDestAssembly -f TSS $liftoverBed > $liftoverSga;\n";
# shell_exec("sga2fps.pl -a $ucscDestAssembly $liftoverSga > $liftoverFps;");
shell_exec("sga2fps.pl -a $ucscDestAssembly $liftoverSga > $liftoverFps;");

if (filesize("$liftoverSga") > 0){
  $sgafileurl = "<a target='_blank' href='/miniepd/".$liftoverSga."'>SGA file</a>";
}else{
  $sgafileurl = "No SGA file";
}
if (filesize("$liftoverFps") > 0){
  $fpsfileurl = "<a target='_blank' href='/miniepd/".$liftoverFps."'>FPS file</a>";
}else{
  $fpsfileurl = "No FPS file";
}
if (filesize("$liftoverBed") > 0){
  $bedfileurl = "<a target='_blank' href='/miniepd/".$liftoverBed."'>BED file</a>";
}else{
  $bedfileurl = "No BED file";
}

# get the number of promoters that has been lifted over:
$pCount = 0;
$handle = fopen($liftoverBed, "r");
while(!feof($handle)){
  $line = fgets($handle);
  $pCount++;
}
fclose($handle);

# get the number of promoters that has NOT been lifted over:
$pNCount = 0;
$handle = fopen($liftoverUnmapped, "r");
while(!feof($handle)){
  $line = fgets($handle);
  $pNCount++;
}
fclose($handle);
$pNegCount = ($pNCount - 1)/2;

$unmappedfileurl = "<a target='_blank' href='/miniepd/".$liftoverUnmapped."'>$pNegCount not mapped</a>";

# Print out the page:
include("header.php");

# File download:

echo "<hr size='1' color='lightgray'>\n";
echo "<table align='center' style='width: 100%; text-align: left;' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<tr align='left' >\n";
echo "<td style='align: left;' width='25%' bgcolor='#C0E0FF'><font color='black'><b> LiftOver</b>: $pCount promoters ($unmappedfileurl)</font></td>\n";
echo "<td width='10%' bgcolor='#DDE6E5'><center>$sgafileurl</center></td>\n";
echo "<td width='10%' bgcolor='#728FCE'><center>$fpsfileurl</center></td>\n";
echo "<td width='10%' bgcolor='#C8C8C8'><center>$bedfileurl</center></td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "<hr size='1' color='lightgray'>\n";

if (filesize("$liftoverSga") > 0){
  echo "<table width=100% border=0 cellpadding=5 cellspacing=0>\n
         <tr><td valign=top width=50%>\n";
  echo "<table align=left width=100% border=1 cellpadding=5 cellspacing=0 bordercolor=#FFFFFF>
            <tr><td align=center width='400px' bgcolor='#336699' style='font-size: 14px; color: #ffffff; height:25px'><b>Sequence Extraction Tool (FASTA format)</b></td></tr>
            <tr><td style='height:25px' width=100% bgcolor='#DDE6E5'>
             <form action='EPDnew_seqextract.php' method=post name='myform' target='_blank'>\n
         From: <input type='text' name='from' value='-499' id='from' size='10' maxlength='10'>
         To: <input type='text' name='to' value='100' id='to' size='10' maxlength='10'>
             <input type='hidden' name='fpsfilename' value='$liftoverFps'>
             <input type='hidden' name='assembly' value='$ucscDestAssembly'>
            </td></tr>
            <tr><td align=center width='100%' bgcolor='#E1EAFF' style='font-size: 14px; color: #ffffff; height:25px'><input type='submit' value='Submit'></form></td><tr>
            </table>\n";
  echo "</td><td valign=top width=50%>";

# Downstream analysis:
  echo "<table align=left width=100% border=1 cellpadding=5 cellspacing=0 bordercolor=#FFFFFF>
             <tr>
              <td colspan='2' align=center width='100%' bgcolor='#336699' style='font-size: 14px; color: #ffffff; height:25px'><b>Downstream Analysis</b>
             </td></tr>
             <tr style='height:25px;' bgcolor='#DDE6E5'>
             <td>
             <center><font color=black>Motif Enrichment</font></center>
             </td><td><a style='text-decoration: none' href='$url_ssa/oprof.php?fps_url=$http://$host_url/miniepd/$liftoverFps&species=$ucscDestAssembly' title='Oprof' target='_blank'> <BUTTON TYPE='button'>OProf</BUTTON></a> &nbsp; <a target='_blank' href='/miniepd/documents/oprof/oprofQuickGuide.php'><img src='/img_epd/Help-icon.png' alt='OProf Help' height='18' width='18'></a></td></tr>
             <tr style='height:25px;' bgcolor='#DDE6E5'>
             <td>
             <center><font color=black>Motif Discovery</font></center>
             </td><td><a style='text-decoration: none' href='$url_ssa/findm.php?fps_url=$http://$host_url/miniepd/$liftoverFps&species=$ucscDestAssembly' title='FindM' target='_blank'> <BUTTON TYPE='button'>FindM</BUTTON></a> &nbsp; <a target='_blank' href='/miniepd/documents/findm/findmQuickGuide.php'><img src='/img_epd/Help-icon.png' alt='FindM Help' height='18' width='18'></a></td></tr>
             <tr style='height:25px;' bgcolor='#DDE6E5'>
             <td>
             <center><font color=black>Chromatin analysis</font></center>
             </td><td><a style='text-decoration: none' href='$url_chipseq/chip_cor.php?bed_link=$http://$host_url/miniepd/$liftoverSga&species=$ucscDestAssembly' title='Chip-Cor' target='_blank'> <BUTTON TYPE='button'>ChIP-Cor</BUTTON></a> &nbsp; <a target='_blank' href='/miniepd/documents/chip-cor/chipcorQuickGuide.php'><img src='/img_epd/Help-icon.png' alt='ChIP-Cor Help' height='18' width='18'></a></td></tr>


             </table>";
  echo "</tr>\n";
  echo "</table>\n";
}


include("footer.html");

?>

