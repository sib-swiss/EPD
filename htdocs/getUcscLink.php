<?php

function getLink($chr, $begin, $end, $assembly, $render, $sessionstr) {
    $clade = '';
    # Boolean indicating if there is a WIG file specification associated
    # $wig = FALSE;
    # $wigstr = ''; # WIG file URL component
    # $wigversion = ''; # For some assemblies several versions exist
    $dbVarName = 'db'; # whether to use "db" or "genome" in the URL

    # render must be TRUE if target of returned link is an image

    switch($assembly) {
        case "pfa2":
        case "amel5":
        case "spo2":
        case "zm3":
        case "araTha1":
            $dbVarName = 'genome';
            break;

        case "hg38":
        case "rheMac8":
        case "canFam3":
        case "rn6":
        case "mm10":
            # $wig = TRUE;
            $clade = 'mammal';
            break;

        case "danRer7":
        case "galGal5":
            # $wig = TRUE;
            $clade = 'vertebrate';
            break;

        case "hg19":
            # $wig = TRUE;
            # $wigversion = '_003';
            $clade = 'mammal';
            break;

        case "hg18":
            # $wig = TRUE;
            # $wigversion = '_002';
            $clade = 'mammal';
            break;

        case "dm6":
            # $wig = TRUE;
            $clade = 'insect';
            break;

        case "ce6":
            # $wig = TRUE;
            $clade = 'nematode';
            break;

        case "sacCer3":
            $clade = 'other';
            break;

        default:
            # Unknown assembly - should never happen
            return '';
    }

    # Definition of URL components ############################################
    if($render) {
        $sessionOptions = rtrim(file_get_contents("../htdocs/ucsc/session_opt_imgdownload.conf"));
        $rootlink = 'https://genome-euro.ucsc.edu/cgi-bin/hgRenderTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt';
    } else {
        $sessionOptions = rtrim(file_get_contents("../htdocs/ucsc/session_options.conf"));
        $rootlink = 'https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt';
    }
    $sessionstr = "$sessionstr&$dbVarName=$assembly";
    $positionstr = '&position='.$chr.':'.$begin.'-'.$end;
    if($clade) {
        $clade = '&clade='.$clade;
    }
    $link = $rootlink.$sessionstr.$clade.$positionstr.$sessionOptions;
    return($link);
}

function getSpecificUcscLink($pid, $chr, $begin, $end, $assembly) {
    $forward_host = array_key_exists('HTTP_X_FORWARDED_HOST', $_SERVER) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : '127.0.0.1';
    $host_urls = explode(',', $forward_host);
    $host_url = trim($host_urls[0]);
    $referer = array_key_exists('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : 'http';
    $http = preg_match("/^https:/", $referer) ? 'https' : 'http'; # HTTP_ORIGIN looks to be unreachable here, because in a function call???
#   $file = "viewer_$pid.txt";
    # Session file must exist for both US server and European mirror
    # for the links to appear in the interface
#   if(file_exists("epdnew/sessions/$assembly/euro/$file") && file_exists("epdnew/sessions/$assembly/us/$file")) {
    if(file_exists("wwwtmp/$assembly"."_$pid"."_specific_viewer.txt") && file_exists("wwwtmp/$assembly"."_$pid"."_specific_viewer_us.txt")) {
#       $sessionstr = '&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/miniepd/epdnew/sessions/'.$assembly.'/euro/'.$file;
        $sessionstr = "&hgS_doLoadUrl=submit&hgS_loadUrlName=$http://$host_url/miniepd/wwwtmp/$assembly"."_$pid"."_specific_viewer.txt"; # new code
        return getLink($chr, $begin, $end, $assembly, FALSE, $sessionstr);
    } else {
        date_default_timezone_set('Europe/Zurich');
        $log = date("d-M-Y H:i:s").': promoter = '.$pid.'; file not found = '.$file.PHP_EOL;
        file_put_contents("logs/sessionlink.log", $log, FILE_APPEND);
        return NULL;
    }
}

function getGM12878UcscLink($pid, $chr, $begin, $end, $assembly) {
    $sessionstr = '&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/viewers/euro/GM12878_viewer.txt';
    return getLink($chr, $begin, $end, $assembly, FALSE, $sessionstr);
}

function getUcscLink($organism, $chr, $begin, $end, $assembly, $render) {
    $sessionstr = '&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_'.$assembly.'_viewer.txt';
    return getLink($chr, $begin, $end, $assembly, $render, $sessionstr);
}

?>
