<?php

include("getUcscLink.php");
# function getUcscLink($organism, $chr, $begin, $end, $assembly) {
#     $clade = '';
#      # Boolean indicating if there is a WIG file specification associated
#     # $wig = FALSE;
#     # $wigstr = ''; # WIG file URL component
#     # $wigversion = ''; # For some assemblies several versions exist
#     $dbVarName = 'db'; # whether to use "db" or "genome" in the URL
#
#     switch($assembly) {
#         case "pfa2":
#         case "amel5":
#         case "spo2":
#         case "zm3":
#         case "araTha1":
#             $dbVarName = 'genome';
#             break;
#
#         case "hg38":
#         case "rheMac8":
#         case "canFam3":
#         case "rn6":
#         case "mm10":
#             # $wig = TRUE;
#             $clade = 'mammal';
#             break;
#
#         case "danRer7":
#         case "galGal5":
#             # $wig = TRUE;
#             $clade = 'vertebrate';
#             break;
#
#         case "hg19":
#             # $wig = TRUE;
#             # $wigversion = '_003';
#             $clade = 'mammal';
#             break;
#
#         case "hg18":
#             # $wig = TRUE;
#             # $wigversion = '_002';
#             $clade = 'mammal';
#             break;
#
#         case "dm6":
#             # $wig = TRUE;
#             $clade = 'insect';
#             break;
#
#         case "ce6":
#             # $wig = TRUE;
#             $clade = 'nematode';
#             break;
#
#         case "sacCer3":
#             $clade = 'other';
#             break;
#
#         default:
#             # Unknown assembly - should never happen
#             return '';
#     }
#
#     # Definition of URL components ############################################
#     $sessionOptions = rtrim(file_get_contents("./ucsc/session_opt_imgdownload.conf"));
#     $rootlink = 'https://genome-euro.ucsc.edu/cgi-bin/hgRenderTracks?&hubUrl=https://epd.expasy.org/miniepd/ucsc/epdHub/epdHub.txt';
#     $sessionstr = '&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/miniepd/ucsc/epdHub/epd_'.$assembly.'_viewer.txt&'.$dbVarName.'='.$assembly;
#     $positionstr = '&position='.$chr.':'.$begin.'-'.$end;
#     if($clade) {
#         $clade = '&clade='.$clade;
#     }
#     # if($wig) {
#     #     $wigstr = '&hgt.customText=https://epd.expasy.org/miniepd/ucsc/'.$assembly.$wigversion.'.wig';
#     # }
#     ###########################################################################
#
#     # $link = $rootlink.$sessionstr.$clade.$wigstr.$positionstr.$sessionOptions;
#     $link = $rootlink.$sessionstr.$clade.$positionstr.$sessionOptions;
#     return($link);
# }

# Get the parameters:
$organism = $_GET["organism"];
$chr = $_GET["chr"];
$position = $_GET["pos"];
$pid = $_GET["pid"]; # promoter ID
$assembly = $_GET["assembly"];
$ucscMirror = 'genome-euro.ucsc.edu';

$outputFile = "epdnew/gif/$organism/$pid.png";

#if(preg_match("/Ara/", $organism) || preg_match("/Zea/", $organism) || preg_match("/pombe/", $organism) || preg_match("/mellifera/", $organism) ){
#    $ucscMirror = 'genome-euro.ucsc.edu';
# }

if(!file_exists($outputFile)) {
    # Download image if not already done
    $start = $position - 1000;
    $stop = $position + 1000;
    # $rdir = generateRandomString(5);
    # $tmpDir = "wwwtmp/$rdir";

    # argument TRUE is to get a link to an image rather than to the browser
    $ucscUrl = getUcscLink($organism, $chr, $start, $stop, $assembly, TRUE);
    exec("curl '$ucscUrl' > $outputFile");
}

if(file_exists($outputFile)) {
    echo "<img style='background-color: #FFFFFF; padding: 4px; border: 0px solid gray;' src='/miniepd/$outputFile'>";
}

# function generateRandomString($length = 5) {
#   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
#   $randomString = '';
#   for ($i = 0; $i < $length; $i++) {
#     $randomString .= $characters[rand(0, strlen($characters) - 1)];
#   }
#   return $randomString;
# }

?>
