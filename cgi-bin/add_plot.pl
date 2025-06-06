#!/usr/bin/env perl

# adds lines of complete promoter collections to plot

use CGI;
use CGI::Carp qw (fatalsToBrowser);
use MyCGI;
use IPC::Open2;
#use Sys::Hostname;

$ENV{'SSA2DBC'} = "/usr/local/EPD_web.git/htdocs/ssa/data/SSA2DBC.def"; # code changed
my $R_cmd = 'R --no-save > /dev/null';
my $WWWTmpDir = './wwwtmp';

# get and check the query parameters

#$query = new CGI ();
$query = new MyCGI;

if ($query->param ('hsline')){
    @para = split("&",($query->param ('hsline')));
    $tmp=$para[0];
    $from=$para[1];
    $to=$para[2];
    $num=$para[3];
    $pfrom=10001+$from;
    $pto=9971+$to;
#print "$para[0]    $para[1]    $para[2]";

    open (GREP, "grep 'Hum' $WWWTmpDir/tmp_$tmp.src|")|| die "Can't open GREP: $!.";
    unless (<GREP>){
	print "sed 's/dev\.off\(\)/lines\(read\.table\(\"Hum_for_R\.out\",skip=1\) \$V1\[$pfrom:$pto\], read\.table\(\"Hum_for_R\.out\",skip=1\)\$V2\[$pfrom:$pto\], col=\"red\"\)/' < $tmp\.src > $tmp\.src \n";
	open (SED, "sed 's/dev\.off()/lines\(read\.table\(\\\"Hum_for_R\.out\\\",skip=1\) \$V1\[$pfrom:$pto\], read\.table\(\\\"Hum_for_R\.out\\\",skip=1\)\$V2\[$pfrom:$pto\], col=\\\"red\\\"\)/' < $WWWTmpDir/tmp_$tmp\.src > $WWWTmpDir/tmp_$tmp\.tem\.src |")|| die "Can't open SED: $!.";
	close (SED);
	system "echo \"dev.off()\" >>$WWWTmpDir/tmp_$tmp.tem.src";
#	system "mv $WWWTmpDir/tmp_$tmp.tem.src $WWWTmpDir/tmp_$tmp.src";
    }
    close (GREP);
}
else {           # remove human GC line; still bug in sed!
    @para = split("&",($query->param ('dmline')));
    $tmp=$para[0];
    $from=$para[1];
    $to=$para[2];
    $num=$para[3];
    $pfrom=10001+$from;
    $pto=9971+$to;

    open (GREP, "grep 'Hum' $WWWTmpDir/tmp_$tmp.src|")|| die "Can't open GREP: $!.";
    unless (<GREP>){
	print "sed 's/lines\(read\.table\(\\\"Hum_for_R\.out\\\",skip=1\) \$V1\[$pfrom:$pto\], read\.table\(\\\"Hum_for_R\.out\\\",skip=1\)\$V2\[$pfrom:$pto\], col=\\\"red\\\"\)//' < $WWWTmpDir/tmp_$tmp\.src > $WWWTmpDir/tmp_$tmp\.tem\.src ";
	open (SED, "sed 's/lines\(read\.table\(\\\"Hum_for_R\.out\\\",skip=1\) \$V1\[$pfrom:$pto\], read\.table\(\\\"Hum_for_R\.out\\\",skip=1\)\$V2\[$pfrom:$pto\], col=\\\"red\\\"\)//' < $WWWTmpDir/tmp_$tmp\.src > $WWWTmpDir/tmp_$tmp\.tem\.src |")|| die "Can't open SED: $!.";
	close (SED);
	system "mv $WWWTmpDir/tmp_$tmp.tem.src $WWWTmpDir/tmp_$tmp.src";
    }
    close (GREP);
}
if ($query->param ('dmline')){
    @para = split("&",($query->param ('dmline')));
    $tmp=$para[0];
    $from=$para[1];
    $to=$para[2];
    $pfrom=10001+$from;
    $pto=9971+$to;
#print "$para[0]    $para[1]    $para[2]";
    open (GREP, "grep 'Dros' $WWWTmpDir/tmp_$tmp.src|")|| die "Can't open GREP: $!.";
    unless (<GREP>){
	print "sed 's/dev\.off\(\)/lines\(read\.table\(\"Dros_for_R\.out\",skip=1\) \$V1\[$pfrom:$pto\], read\.table\(\"Dros_for_R\.out\",skip=1\)\$V2\[$pfrom:$pto\], col=\"red\"\)/' < $tmp\.src > $tmp\.src \n";
	open (SED, "sed 's/dev\.off\(\)/lines\(read\.table\(\\\"Dros_for_R\.out\\\",skip=1\) \$V1\[$pfrom:$pto\], read\.table\(\\\"Dros_for_R\.out\\\",skip=1\)\$V2\[$pfrom:$pto\], col=\\\"purple\\\"\)/' < $WWWTmpDir/tmp_$tmp\.src > $WWWTmpDir/tmp_$tmp\.tem\.src |")|| die "Can't open SED: $!.";
	close (SED);
	system "echo \"dev.off()\" >>$WWWTmpDir/tmp_$tmp.tem.src";
	system "mv $WWWTmpDir/tmp_$tmp.tem.src $WWWTmpDir/tmp_$tmp.src";
    }
    close (GREP);
}
else {            # remove droso GC linee; still bug in sed!
    @para = split("&",($query->param ('hsline')));
    $tmp=$para[0];
    $from=$para[1];
    $to=$para[2];
    $num=$para[3];
    $pfrom=10001+$from;
    $pto=9971+$to;

    open (GREP, "grep 'Hum' $WWWTmpDir/tmp_$tmp.src|")|| die "Can't open GREP: $!.";
    unless (<GREP>){
	open (SED, "sed 's/lines\(read\.table\(\\\"Dros_for_R\.out\\\",skip=1\) \$V1\[$pfrom:$pto\], read\.table\(\\\"Dros_for_R\.out\\\",skip=1\)\$V2\[$pfrom:$pto\], col=\\\"purple\\\"\)//' < $WWWTmpDir/tmp_$tmp\.src > $WWWTmpDir/tmp_$tmp\.tem\.src |")|| die "Can't open SED: $!.";
	close (SED);
	system "mv $WWWTmpDir/tmp_$tmp.tem.src $WWWTmpDir/tmp_$tmp.src";
    }
    close (GREP);
}

# regenerate plot in R
open(RSRC,"| $R_cmd") or die("cannot execute \"R\"");
print RSRC "source(\"$WWWTmpDir/tmp_$tmp.src\")\n";
close(RSRC);

$val=$tmp."&".$from."&".$to."&".$num;
print ($query->header);
print ("<pre>");
print "<B><FONT SIZE=+2>CG-content of selection of $num promoter sequences </FONT><br><FONT SIZE=+1> in range: $from to $to (window size=30) </FONT></B><br>";
print "\t\t\t\t<tr>\n\t<td align=center nowrap\=\"nowrap\"><a href=\"/miniepd/wwwtmp/tmp_$tmp.png\"><IMG SRC=\"/miniepd/wwwtmp/tmp_$tmp.png\"><\/a><\/td>\n\t\t\t\t<\/tr>";

print "<H3>  Add line(s) to plot:";
print "  <FORM action=add_plot.pl method=GET>";
print "  <INPUT type=\"checkbox\" VALUE=$val name=hsline";
if ($query->param ('hsline')){
    print " CHECKED";
}
print "> complete collection of 1871 <font color\=\"\#ff0000\">human promoters </FONT><BR>";
print "  <INPUT type=\"checkbox\" VALUE=$val name=dmline";
if ($query->param ('dmline')){
    print " CHECKED";
}
print "> complete collection of 1926 <font color\=\"\#a020f0\">Drosophila promoters </FONT></H3><BR>";
print " <INPUT type=\"submit\" value=\"Submit\"><INPUT type=\"reset\" value=\"Clear\"> ";
print ("</pre>");
print ($query->end_html);

1;

