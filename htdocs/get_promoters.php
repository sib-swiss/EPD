<?php
include("url_extern.php");

function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

#print_r($_POST);

# new code added to support new motifs

$db            = $_POST['select_db'];
$tata          = $_POST['tata'];
$inrand        = $_POST['inrAND'];
$inr           = $_POST['inr'];
$ccaatand      = $_POST['ccaatAND'];
$ccaat         = $_POST['ccaat'];
$gcand         = $_POST['gcAND'];
$gc            = $_POST['gc'];
$yr            = $_POST['yr'];
$yrand         = $_POST['yrAND'];
$ypatch        = $_POST['ypatch'];
$ypatchand     = $_POST['ypatchAND'];
$ggccca        = $_POST['ggccca'];
$ggcccaand     = $_POST['ggcccaAND'];
$cpgand        = $_POST['cpgAND'];
$cpg           = $_POST['cpg'];
$dispersionand = $_POST['dispersionAND'];
$dispersion    = $_POST['dispersion'];
$eaverageand   = $_POST['eAverageAND'];
$eaverage      = $_POST['eAverage'];
$esamplesand   = $_POST['eSamplesAND'];
$esamples      = $_POST['eSamples'];
#$from          = $_POST['from'];
#$to            = $_POST['to'];
#$type          = $_POST['type'];
$action        = $_POST['action'];
$ids           = $_POST['ids'];
$idtype        = $_POST['idtype'];
$best          = $_POST['best'];


#while (list($key, $value) = each($_POST)) {
#    echo "Key: $key; Value: $value<br />\n";
#}

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
$fp = fopen('./logs/select_promoters.log', 'a');
fwrite($fp, "$date\t$time\t$Users_IP_address\t$db\n");
fclose($fp);

$forward_host = array_key_exists('HTTP_X_FORWARDED_HOST', $_SERVER) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : '127.0.0.1';
$host_port = $forward_host === '127.0.0.1' ? ':8081' : '';
$host_urls = explode(',', $forward_host);
$host_url = trim($host_urls[0]).$host_port;
$http = preg_match("/^https:/", $_SERVER['HTTP_ORIGIN']) ? 'https' : 'http';

$tataquery       = "";
$tataand         = "AND";
$wherequery      = "";
$inrquery        = "";
$ccaatquery      = "";
$gcquery         = "";
$yrquery         = "";
$dispersionquery = "";
$eaveragequery   = "";
$esamplesgequery = "";
$idquery         = "";
$selectbest      = "";

// get the parameters:
$confFile = fopen('../etc/epd.conf', 'r')  or die('Unable to open configuration file!');
if ($confFile) {
    while (($line = fgets($confFile)) !== false) {
        // process the line read.
        $parts = preg_split('/\t+/', rtrim($line));
        $dbId[$parts[1]] = $parts[0];
        $databases[$parts[1]] = $parts[1]."_epdnew";
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

# get the UCSC assembly name from the data file:
$assembly = shell_exec("awk '$1==\"DR\" && $2==\"UCSC;\"{print $3; exit}' ftp/epdnew/$db/current/*_EPDnew.dat");
$assembly = str_replace("\n", '', $assembly);
#echo "Assenbly assembly: $assembly<br>";
if($assembly == "GCF_904849725.1") {$assembly = "MorexV3";}


/* if ($db == "human"){ */
/*   $database = "human_epdnew"; */
/*   $assembly = "hg38"; */
/* }else if ($db == "mouse"){ */
/*   $database = "mouse_epdnew"; */
/*   $assembly = "mm10"; */
/* }else if ($db == "R_norvegicus"){ */
/*   $database = "R_norvegicus_epdnew"; */
/*   $assembly = "rn6"; */
/* }else if ($db == "drosophila"){ */
/*   $database = "drosophila_epdnew"; */
/*   $assembly = "dm6"; */
/* }else if ($db == "zebrafish"){ */
/*   $database = "zebrafish_epdnew"; */
/*   $assembly = "danRer7"; */
/* }else if ($db == "worm"){ */
/*   $database = "worm_epdnew"; */
/*   $assembly = "ce6"; */
/* }else if ($db == "arabidopsis"){ */
/*   $database = "arabidopsis_epdnew"; */
/*   $assembly = "araTha1"; */
/* }else if ($db == "Z_mays"){ */
/*   $database = "Z_mays_epdnew"; */
/*   $assembly = "zm3"; */
/* }else if ($db == "S_cerevisiae"){ */
/*   $database = "S_cerevisiae_epdnew"; */
/*   $assembly = "sacCer3"; */
/* }else if ($db == "S_pombe"){ */
/*   $database = "S_pombe_epdnew"; */
/*   $assembly = "spo2"; */
/* }else if ($db == "A_mellifera"){ */
/*   $database = "A_mellifera_epdnew"; */
/*   $assembly = "amel5"; */
/* } */


#if ($database == 'human'){
#  $assembly = "hg38";
$where = 0;

# ID selection:
$refselect = 'promoter_ensembl.ensembl_id';
if ($ids != ''){
    $where++;
    # 1. split ids
    $id = explode("\n", $ids);
    # remove spaces:
    $id = array_filter(array_map('trim', $id));
    foreach ($id as $nid){
        $allid .= ", '$nid'";
    }
    $allid = ltrim($allid, ', ');
    # 2. get the id type (there are not many)
    if ($idtype == 'epd'){
        $qfield = 'promoter_coordinate.id IN';
    }else if($idtype == 'ensembl'){
        $qfield = 'promoter_ensembl.ensembl_id IN';
    }else if($idtype == 'refseq'){
        $qfield = 'cross_references.refseq_id IN';
        $refselect = 'cross_references.refseq_id';
    }
    # 3. make the query
    $idquery = "$qfield ($allid)";
}


# TATA-box
if ($where == 0){
    $tataand = '';
}
if ($tata == 'with'){
    $tataquery = $tataand.' promoter_motif.tata LIKE "1"';
    #    echo("$tataquery\n");
    $where++;
}else if ($tata == 'without'){
    $tataquery = $tataand.' promoter_motif.tata LIKE "0"';
    $where++;
}else{
    #  $tataquery = 'promoter_motif.tata LIKE "%"';
    $tataquery = '';
    #  $where++;
}

# Inr
if ($where == 0){
    $inrand = '';
}
if ($inr == 'with'){
    $inrquery = $inrand.' promoter_motif.inr LIKE "1"';
    $where++;
}else if ($inr == 'without'){
    $inrquery = $inrand.' promoter_motif.inr LIKE "0"';
    $where++;
}else{
    $inrquery = '';
    #  $where = 1;
}

# CCAAT-box
if ($where == 0){
    $ccaatand = '';
}
if ($ccaat == 'with'){
    $ccaatquery = $ccaatand.' promoter_motif.ccaat LIKE "1"';
    $where++;
}else if ($ccaat == 'without'){
    $ccaatquery = $ccaatand.' promoter_motif.ccaat LIKE "0"';
    $where++;
}else{
    $ccaatquery = '';
    #  $where = 1;
}

# GC-box
if ($where == 0){
    $gcand = '';
}
if ($gc == 'with'){
    $gcquery = $gcand.' promoter_motif.gc LIKE "1"';
    $where++;
}else if ($gc == 'without'){
    $gcquery = $gcand.' promoter_motif.gc LIKE "0"';
    $where++;
}else{
    $gcquery = '';
    #  $where = 1;
}

# new code added to support new motifs

# YR Initiator
if ($where == 0){
    $yrand = '';
}
if ($yr == 'with'){
    $yrquery = $yrand.' promoter_motif.yr LIKE "1"';
    $where++;
}else if ($yr == 'without'){
    $yrquery = $yrand.' promoter_motif.yr LIKE "0"';
    $where++;
}else{
    $yrquery = '';
    #  $where = 1;
}

# Y-patch
if ($where == 0){
    $ypatchand = '';
}
if ($ypatch == 'with'){
    $ypatchquery = $ypatchand.' promoter_motif.ypatch LIKE "1"';
    $where++;
}else if ($ypatch == 'without'){
    $ypatchquery = $ypatchand.' promoter_motif.ypatch LIKE "0"';
    $where++;
}else{
    $ypatchquery = '';
    #  $where = 1;
}

# GGCCCA motif

if ($where == 0){
    $ggcccaand = '';
}
if ($ggccca == 'with'){
    $ggcccaquery = $ggcccaand.' promoter_motif.ggccca LIKE "1"';
    $where++;
}else if ($ggccca == 'without'){
    $ggcccaquery = $ggcccaand.' promoter_motif.ggccca LIKE "0"';
    $where++;
}else{
    $ggcccaquery = '';
    #  $where = 1;
}


# Dispersion
if ($where == 0){
    $dispersionand = '';
}
if ($dispersion != 'all'){
    $dispersionquery = $dispersionand." promoter_coordinate.type LIKE '$dispersion'";
    $where++;
}else{
    $dispersionquery = "";
    #  $where++;
}

# Expression average
if ($where == 0){
    $eaverageand = '';
}
if ($eaverage != ''){
    $eaveragequery = $eaverageand." promoter_average_expression.average_expression >= '$eaverage'";
    $where++;
}else{
    $eaveragequery = "";
    #  $where = 1;
}

# Expression samples
if ($where == 0){
    $esamplesand = '';
}
if ($esamples != ''){
    $esamplesquery = $esamplesand." promoter_average_expression.number_of_samples >= '$esamples'";
    $where++;
}else{
    $esamplesquery = "";
    #  $where = 1;
}

if ($where > 0){
    $wherequery = "WHERE";
}

$query = "SELECT promoter_coordinate.id, promoter_coordinate.chromosome, promoter_coordinate.position, promoter_coordinate.strand, $refselect
FROM
promoter_coordinate
LEFT JOIN promoter_motif
ON promoter_coordinate.id = promoter_motif.id
LEFT JOIN promoter_average_expression
ON promoter_coordinate.id = promoter_average_expression.id
LEFT JOIN promoter_ensembl
ON promoter_coordinate.id = promoter_ensembl.id
LEFT JOIN cross_references
ON promoter_ensembl.ensembl_id = cross_references.ensembl_id

$wherequery $idquery $tataquery $inrquery $ccaatquery $gcquery $yrquery $ypatchquery $ggcccaquery$dispersionquery $esamplesquery $eaveragequery";

# new code added to support new motifs (see above)

# echo "$query;<br>\n";

# Connect to the database
$db_con = mysqli_connect("127.0.0.1","ccgweb","ccgweb",$databases[$db]);
/* check connection */
if (!$db_con){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($stmt = $db_con->prepare("$query")) {

    $stmt->execute();
    $stmt->bind_result($pid, $pchr, $ppos, $pstrand, $ref);

    $sgafile = $databases[$db]."_".generateRandomString().".sga";
    $logfile = $databases[$db]."_".generateRandomString().".txt";
    $pnumber = 0;
    $content = "";
    $logcontent = "";
    while ($stmt->fetch()) {
        $content    .= "$pchr\tTSS\t$ppos\t$pstrand\t1\t$pid\n";
        $logcontent .= "$ref\t$pid\n";
        #echo "$pchr\tTSS\t$ppos\t$pstrand\t1\t$pid<br>\n";
        $pnumber++;
    }
    #  echo "This query got $pnumber promoters. <br>\n";
    $stmt->close();

    $outfile    = "wwwtmp/$sgafile";
    file_put_contents($outfile, $content);
    $outlogfile = "wwwtmp/$logfile";
    file_put_contents($outlogfile, $logcontent);

    # Select only best promoters:
    if ($best == 'bestOnly'){
        $selectbest = '| awk \'$6 ~ "_1$"\'';
        # get rid of the multiple ID in the log file
        shell_exec("sed -i '/_[^1]$/d' wwwtmp/$logfile;");
    }

    # Generate files:
    $tmpfile = "wwwtmp/tmp".generateRandomString().".sga";
    shell_exec("sort -k1,1 -k3,3n -k4,4 wwwtmp/$sgafile $selectbest > $tmpfile; mv $tmpfile wwwtmp/$sgafile;");
    $pnumber = shell_exec("wc -l wwwtmp/$sgafile | awk '{print \$1}';");
    $fpsfilename = $databases[$db]."_".generateRandomString().".fps";
    $fpsfile = "wwwtmp/".$fpsfilename;
    shell_exec("sga2fps.pl --db ./ -a $assembly wwwtmp/$sgafile > $fpsfile;");
#    shell_exec("sga2fps.pl --db ./ -s $assembly wwwtmp/$sgafile > $fpsfile;"); # changed PB
    $bedfile = "wwwtmp/".$databases[$db]."_".generateRandomString().".bed";
    shell_exec("sga2bed --db ./ -H -l 1 -X 6:4 wwwtmp/$sgafile > $bedfile;");
#    shell_exec("sga2bed -i   ./ -r -l 1 -e 6:4 wwwtmp/$sgafile > $bedfile;"); # changed PB

    $sgafileurl = "<a target='_blank' href='/miniepd/wwwtmp/".$sgafile."'>SGA file</a>";
    $logfileurl = "<a target='_blank' href='/miniepd/wwwtmp/".$logfile."'>Log file</a>";
    $fpsfileurl = "<a target='_blank' href='/miniepd/".$fpsfile."'>FPS file</a>";
    $bedfileurl = "<a target='_blank' href='/miniepd/".$bedfile."'>BED file</a>";

    if ($action == "Select"){
        include("header.php");

        #    echo "here are the ID: $idtype $ids $db $best<br>";

        echo "<table width=100% border=0 cellpadding=5 cellspacing=0>\n
            <tr><td valign=top rowspan=1 width=50%>\n
            <table width=100% border=0 cellpadding=5 cellspacing=0>\n
            <tr>\n
            <td  valign=top width=100% bgcolor=\"#798E8A\" colspan=2 style='color: #ffffff'><b><center>Database:</center></b>
            </td>
            </tr>\n";
        echo "<tr><td valign=top width=35% bgcolor=\"#DDE6E5\">";
        echo "<b>&nbsp;&nbsp;&nbsp;Database: </b>";
        echo "</td><td style=\"align: left;\" width=65% bgcolor=\"#DDE6E5\">".$databases[$db].'</td></tr>';
        echo "<tr><td width=35% bgcolor=\"#DDE6E5\">";
        echo "<b>&nbsp;&nbsp;&nbsp;Assembly: </b>";
        echo "</td><td style=\"align: left;\" width=65% bgcolor=\"#DDE6E5\"> $assembly </td></tr>";
        echo "</table></td>
            <td valign=top rowspan=1 width=50%>
            <table width=100% border=0 cellpadding=5 cellspacing=0>
            <tr>
            <td colspan='2' align=center width=100% bgcolor=\"#336699\" style='color: #ffffff'><b>Selection Parameters</b>
            </td>
            </tr>
            <tr>";
        # new code added to support new motifs
        if($assembly == "MorexV3") {
        echo "<tr bgcolor='#C0E0FF'><td width='50%'><b>TATA-box:</b></td><td> $tata </td></tr>
            <tr bgcolor='#C0E0FF'><td width='50%'><b>YR Initiator:</b></td><td> $yr </td></tr>
            <tr bgcolor='#C0E0FF'><td width='50%'><b>Y-patch:</b></td><td> $ypatch </td></tr>
            <tr bgcolor='#C0E0FF'><td width='50%'><b>GGCCCA motif:</b></td><td> $ggccca </td></tr>";
        } else {
        echo "<tr bgcolor='#C0E0FF'><td width='50%'><b>TATA-box:</b></td><td> $tata </td></tr>
            <tr bgcolor='#C0E0FF'><td width='50%'><b>Initiator:</b></td><td> $inr </td></tr>
            <tr bgcolor='#C0E0FF'><td width='50%'><b>CCAAT-box:</b></td><td> $ccaat </td></tr>
            <tr bgcolor='#C0E0FF'><td width='50%'><b>GC-box:</b></td><td> $gc </td></tr>";
        }
        echo "<tr bgcolor='#C0E0FF'><td width='50%'><b>Marked as:</b></td><td> $dispersion </td></tr>
            <tr bgcolor='#C0E0FF'><td width='50%'><b>Average expression:</b></td><td> $eaverage </td></tr>
            <tr bgcolor='#C0E0FF'><td width='50%'><b>Expressed in:</b></td><td> $esamples </td></tr>

            </table>

            </td>
            </table>";

        # File download:

        echo "<hr size='1' color='lightgray'>\n";
        echo "<table align='center' style='width: 100%; text-align: left;' border='0' cellpadding='2' cellspacing='2'>\n";
        echo "<tr align='left' >\n";
        echo "<td style='align: left;' width='25%' bgcolor='#C0E0FF'><font color='black'><b> Results</b>: $pnumber promoters selected</font></td>\n";
        echo "<td width='10%' bgcolor='#DDE6E5'><center>$sgafileurl</center></td>\n";
        echo "<td width='10%' bgcolor='#728FCE'><center>$fpsfileurl</center></td>\n";
        echo "<td width='10%' bgcolor='#C8C8C8'><center>$bedfileurl</center></td>\n";
        if ($ids != '' & $idtype != 'epd'){
            echo "<td width='10%' bgcolor=''><center>$logfileurl</center></td>\n";
        }
        echo "</tr>\n";
        echo "</table>\n";
        echo "<hr size='1' color='lightgray'>\n";

        # Liftover options:
        if ($assembly == "hg38" | $assembly == "mm10" | $assembly == "ce6" | $assembly == "danRer7" | $assembly == "dm6" | $assembly == "sacCer3"){
            echo "<FORM action='EPDnew_liftover.php' enctype='multipart/form-data' method='post' name='myform'>\n";
            echo "<table align='center' style='width: 80%; text-align: left;' border='0' cellpadding='2' cellspacing='2'>\n";
            echo "<tr align='left' >\n";
            echo "<td style='align: left; font-size: 13px; color: #ffffff' width='15%' bgcolor='#798E8A' nowrap><center><b> LiftOver options </b></center></td>\n";
            echo "<td width='40%' bgcolor='#DDE6E5'><center><select id='dest_assembly' name='dest_assembly' style='font-size: 11px; width: 250px'>\n";

            if ($assembly == "hg38"){
                echo "<option selected value='Hg19'>hg19 (Dec 2007 GRCh37)</option>\n";
            #   echo "<option value='Hg18'>hg18 (March 2006)</option>\n";
            #   hg38ToHg18.over.chain.gz not available from UCSC
            }
            if ($assembly == "mm10"){
                echo "<option selected value='Mm9'>mm9 (Dec 2011)</option> \n";
            #   echo "<option value='Mm8'>mm8 (February 2006)</option> \n";
            }
            if ($assembly == "ce6"){
                echo "<option selected value='Ce10'>ce10 (Feb. 2013, WBcel235)</option> \n";
                echo "<option value='Ce11'>ce11 (Oct. 2010, WS220)</option> \n";
            }
            if ($assembly == "danRer7"){
                echo "<option selected value='DanRer10'>danRer10 (Sep. 2014, GRCz10)</option> \n";
                echo "<option value='DanRer6'>danRer6 (Dec. 2008, Zv8)</option> \n";
            }
            if ($assembly == "dm6"){
                echo "<option selected value='Dm3'>dm3 (Apr 2006 BDGP R5)</option> \n";
                #echo "<option value='Dm2'>dm2 (Apr. 2004)</option> \n";
            }
            if ($assembly == "sacCer3"){
                echo "<option value='SacCer1'>sacCer1 (Oct. 2003)</option> \n";
                echo "<option selected value='SacCer2'>sacCer2 (June 2008, SDG)</option> \n";
            }
            # suppressed "</optgroup>", which is useless
            echo "</select></center></td>\n";
            echo " <input type='hidden' name='orig_assembly'  value='$assembly'>\n";
            echo " <input type='hidden' name='bed_file'  value='$bedfile'>\n";
            echo " <td bgcolor='#DDE6E5'><center>\n";
            echo " <BUTTON TYPE='submit' style='margin-left: -8px;'>Submit</BUTTON>\n";
            echo " </center>\n";
            echo " </td></tr></table>\n";
            echo "</FORM>\n";
            echo "<hr size='1' color='lightgray'>\n";
        }

        # Sequence extraction
        echo "<table width=100% border=0 cellpadding=5 cellspacing=0>\n
            <tr><td valign=top width=50%>\n";
                echo "<table align=left width=100% border=1 cellpadding=5 cellspacing=0 bordercolor=#FFFFFF>
                    <tr>
                    <td align=center width='400px' bgcolor='#336699' style='font-size: 14px; color: #ffffff; height:25px'><b>Sequence Extraction Tool (FASTA format)</b>
                    </td></tr>
                    <tr>
                    <td style='height:25px' width=100% bgcolor='#DDE6E5'>
                    <form action='EPDnew_seqextract.php' method=post name='myform' target='_blank'>\n
                    From: <input type='text' name='from' value='-499' id='from' size='10' maxlength='10'>
                    To: <input type='text' name='to' value='100' id='to' size='10' maxlength='10'>
                    <input type='hidden' name='fpsfilename' value='$fpsfile'>
                    <input type='hidden' name='assembly' value='$assembly'>
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
                    </td><td><a style='text-decoration: none' href='https://epd.expasy.org/ssa/oprof.php?fps_url=$http://$host_url/miniepd/wwwtmp/$fpsfilename&species=$assembly' title='FindM' target='_blank'> <BUTTON TYPE='button'>OProf</BUTTON></a> &nbsp; <a target='_blank' href='documents/oprof/oprofQuickGuide.php'><img src='/img_epd/Help-icon.png' alt='OProf Help' height='18' width='18'></a></td></tr>
                    <tr style='height:25px;' bgcolor='#DDE6E5'>
                    <td>
                    <center><font color=black>Motif Discovery</font></center>
                    </td><td><a style='text-decoration: none' href='https://epd.expasy.org/ssa/findm.php?fps_url=$http://$host_url/miniepd/wwwtmp/$fpsfilename&species=$assembly' title='FindM' target='_blank'> <BUTTON TYPE='button'>FindM</BUTTON></a> &nbsp; <a target='_blank' href='documents/findm/findmQuickGuide.php'><img src='/img_epd/Help-icon.png' alt='FindM Help' height='18' width='18'></a></td></tr>
                    <tr style='height:25px;' bgcolor='#DDE6E5'>
                    <td>
                    <center><font color=black>Chromatin analysis</font></center>
                    </td><td><a style='text-decoration: none' href='https://epd.expasy.org/chipseq/chip_cor.php?bed_link=$http://$host_url/miniepd/wwwtmp/$sgafile&species=$assembly&strand=oriented' title='Chip-Cor' target='_blank'> <BUTTON TYPE='button'>ChIP-Cor</BUTTON></a> &nbsp; <a target='_blank' href='documents/chip-cor/chipcorQuickGuide.php'><img src='/img_epd/Help-icon.png' alt='ChIP-Cor Help' height='18' width='18'></a></td></tr>


                    </table>";

                if(preg_match("/127\.0\.0\.1/", $host_url)) {
                    echo "<table>\n";
                    echo "<tr><td colspan='3'><p><font color=red>Instructions for using the downstream analysis buttons from a local web server (the direct navigation buttons won't work!):</font>\n";
                    echo "<ul><li>Download the FPS (OProf and FindM) or SGA (ChIP-Cor) files to your local computer using the above download links.\n";
                    echo "<li>Press the navigation button of your choice to open the input form of the corresponding <a href=https://epd.expasy.org/ssa/>SSA</a> or <a href=https://epd.expasy.org/chipseq/>ChIP-Seq</a> application.</li>\n";
                    echo "<li>On the left side of the form, under <b>Upload custom Data</b>, press the <b>\"Browse...\"</b> button, in order to upload the downloaded FPS or SGA file to the respective server.</li></td>\n";
                    echo "</tr>\n";
                    echo "</table>\n";
                }

                echo "</tr>\n";
                echo "</table>\n";

                include("footer.html");

    }else if ($action == "toOprof"){
        $fpsfile = $databases[$db]."_".generateRandomString().".fps";
       shell_exec("sga2fps.pl --db ./ -a $assembly wwwtmp/$sgafile > wwwtmp/$fpsfile;");
#        shell_exec("sga2fps.pl --db ./ -s $assembly wwwtmp/$sgafile > wwwtmp/$fpsfile;"); # changed PB
        header( "Location: https://epd.expasy.org/ssa/oprof.php?fps_url=$http://$host_url/miniepd/wwwtmp/$fpsfilename&species=$assembly" ) ;
    }else if ($action == "toFindm"){
        $fpsfile = $databases[$db]."_".generateRandomString().".fps";
       shell_exec("sga2fps.pl --db ./ -a $assembly wwwtmp/$sgafile > wwwtmp/$fpsfile;");
#        shell_exec("sga2fps.pl --db ./ -s $assembly wwwtmp/$sgafile > wwwtmp/$fpsfile;"); # changed PB
        header( "Location: https://epd.expasy.org/ssa/findm.php?fps_url=$http://$host_url/miniepd/wwwtmp/$fpsfilename&species=$assembly" ) ;
    }else if ($action == "toChipcor"){
        $fpsfile = $databases[$db]."_".generateRandomString().".fps";
        header( "Location: https://epd.expasy.org/chipseq/chip_cor.php?bed_link=$http://$host_url/miniepd/wwwtmp/$sgafile&species=$assembly&strand=oriented" ) ;
    }
}else{
    echo "There is an error in the query!\n";
}
$db_con->close();


?>

