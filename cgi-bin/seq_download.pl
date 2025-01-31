#!/usr/bin/env perl

# IF IT DOES NOT WORK, CHECK HERE FIRST!!!
#$ENV{'PATH'} .= ":/usr/molbio/bin:/usr/molbio/perl";

# EPDtoFA apparently needs this one
#$ENV{'PATH'} .= ":/opt/ansic/bin";
# in order to maintain synchronization between EPD and EMBL, keep a frozen EMBL subset in epd-embl.dat
$ENV{'SSA2DBC'} = '/home/local/ssa/data/SSA2DBC.def';

use CGI;
use MyCGI;

#use CGI::Carp qw (fatalsToBrowser);

if ($#ARGV == 0) {
    # command line mode
#    $record = $ARGV[0];
#    $format = 'html';
} else {
    # CGI mode
#    use CGI::Lite;
#    $form = new CGI::Lite();
#    $form = new CGI();
    $form = new MyCGI;
    # get input
#    %val = $form->parse_form_data();
    $val{'all'} = $form->param('all');
    $val{'g1' } = $form->param('g1');
    $val{'g11'} = $form->param('g11');
    $val{'g12'} = $form->param('g12');
    $val{'g13'} = $form->param('g13');
    $val{'g2' } = $form->param('g2');
    $val{'g3' } = $form->param('g3');
    $val{'g31'} = $form->param('g31');
    $val{'g32'} = $form->param('g32');
    $val{'g33'} = $form->param('g33');
    $val{'g4' } = $form->param('g4');
    $val{'g5' } = $form->param('g5');
    $val{'g6' } = $form->param('g6');
    $val{'g61'} = $form->param('g61');
    $val{'g62'} = $form->param('g62');
    $val{'g63'} = $form->param('g63');
    $val{'zm' } = $form->param('zm');
    $val{'dm' } = $form->param('dm');
    $val{'xl' } = $form->param('xl');
    $val{'gg' } = $form->param('gg');
    $val{'mm' } = $form->param('mm');
    $val{'rn' } = $form->param('rn');
    $val{'bt' } = $form->param('bt');
    $val{'hs' } = $form->param('hs');
    $val{'ebv'} = $form->param('ebv');
    $val{'hsv'} = $form->param('hsv');
    $val{'buos'} = $form->param('buos');
    $val{'is'} = $form->param('is');
    $val{'format'} = $form->param('format');
}

my $epd     = '../htdocs/ftp/epd/current/epd.dat';
my $epdbulk = '../htdocs/ftp/epd/current/epd_bulk.dat';
#$egrep="/bin/egrep";
$from = $form->param('from');
$to   = $form->param('to');
if (($from<-9999)||($to>10000)||($to-$from>16000))
{
    &printCGIHeader;
    print ("<PRE>");
    print "User input error : <br>Sorry, sequence download is limited to segments of 16kb between -9999 and 10000 bp relative to the transcription start site";
    print ("</PRE>");
    exit (0);
}
if ($from>$to)
{
    &printCGIHeader;
    print ("<PRE>");
    print "User input error : <br>The position of the 5'end (FROM=$from) has to be upstream of that of the 3'end (TO=$to) ";
    print ("</PRE>");
    exit (0);
}
unless (($val{'all'} eq "on")||($val{'g1' } eq "on")||($val{'g11'} eq "on")||($val{'g12'} eq "on")||($val{'g13'} eq "on")||($val{'g2' } eq "on")||($val{'g3' } eq "on")||($val{'g31'} eq "on")||($val{'g32'} eq "on")||($val{'g33'} eq "on")||($val{'g4' } eq "on")||($val{'g5' } eq "on")||($val{'g6' } eq "on")||($val{'g61'} eq "on")||($val{'g62'} eq "on")||($val{'g63'} eq "on")||($val{'zm' } eq "on")||($val{'dm' } eq "on")||($val{'xl' } eq "on")||($val{'xl' } eq "on")||($val{'gg' } eq "on")||($val{'mm' } eq "on")||($val{'rn' } eq "on")||($val{'rn' } eq "on")||($val{'bt' } eq "on")||($val{'hs' } eq "on")||($val{'ebv'} eq "on")||($val{'hsv'} eq "on")||($val{'buos'} eq "on"))
{
    &printCGIHeader;
    print ("<PRE>");
    print "Error : please select at least one set ";
    print ("</PRE>");
    exit (0);
}

$tmp="wwwtmp/tmp_$$";
open ('TMP', "> $tmp") or die ("cannot open $tmp for writing: $!\n");
if ($val{'all'} eq "on") { open ('LIST', "grep -n '^FP' $epd  2>&1|"); print TMP (<LIST>);}
if ($val{'g1' } eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    1\./,/:.    2\./p'       | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g11'} eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    1\.1\./,/:.    1\.2\./p' | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g12'} eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    1\.2\./,/:.    1\.3\./p' | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g13'} eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    1\.3\./,/:.    2\./p'    | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g2' } eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    2\./,/:.    3\./p'       | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g3' } eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    3\./,/:.    4\./p'       | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g31'} eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    3\.1\./,/:.    3\.2\./p' | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g32'} eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    3\.2\./,/:.    3\.3\./p' | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g33'} eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    3\.3\./,/:.    4\./p'    | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g4' } eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    4\./,/:.    5\./p'       | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g5' } eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    5\./,/:.    6\./p'       | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g6' } eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    6\./,/:YZ/p'             | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g61'} eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    6\.1\./,/:.    6\.2\./p' | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g62'} eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    6\.2\./,/:.    6\.3\./p' | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'g63'} eq "on") { open ('LIST', "egrep -n '(^FP|^[*] )' $epd | sed -n '/:.    6\.3\./,/:YZ/p'          | grep ':FP' 2>&1|"); print TMP (<LIST>);}
if ($val{'zm' } eq "on") { open ('LIST', "grep -n '^FP   Zm'       $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'dm' } eq "on") { open ('LIST', "grep -n '^FP   Dm[^a-z]' $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'xl' } eq "on") { open ('LIST', "grep -n '^FP   Xl'       $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'gg' } eq "on") { open ('LIST', "grep -n '^FP   Gg'       $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'mm' } eq "on") { open ('LIST', "grep -n '^FP   Mm'       $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'rn' } eq "on") { open ('LIST', "grep -n '^FP   Rn'       $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'bt' } eq "on") { open ('LIST', "grep -n '^FP   Bt'       $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'hs' } eq "on") { open ('LIST', "grep -n '^FP   Hs'       $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'ebv'} eq "on") { open ('LIST', "grep -n '^FP   EBV'      $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'hsv'} eq "on") { open ('LIST', "grep -n '^FP   HSV-1'    $epd  2>&1|" ); print TMP (<LIST>); }
if ($val{'buos'} eq "on") { open ('LIST', "grep -n '^FP   Os'      $epdbulk  2>&1|" ); print TMP (<LIST>); }
close (TMP);

# parse current EPD files for title and to correct IDs and ACs in FROMFPS output
    $/ = "\/\/";

    open (EPD, $epd);
    while (<EPD>){
        if (/(TI   EPD[^\n]+)/){
            $titl = $1;
        }
        ($id) = /ID   (\S+)/;
        ($ac) = /AC   (EP[^\;]+)/;
        $new_id{$ac}=$id;
    }
    close (EPD);
    open (EPDB, $epdbulk);
    while (<EPDB>){
#        if (/(TI   epd[^\n]+)/){
#            $titl = $1;
#        }
        ($id) = /ID   (\S+)/;
        ($ac) = /AC   (EP[^\;]+)/;
        $new_id{$ac}=$id;
    }
    close (EPDB);

$fps="wwwtmp/fps_$$";
open ('FPS', "> $fps") or die ("cannot open $fps for writing: $!\n");
#/home/httpd/cgi-bin;
if ($val{'is'} eq "+" ){
    open ('LIST', "sort -t: +0 -1 -n -u $tmp | sed 's=^.*:FP=FP=' | grep ':+' 2>&1|");
}
else  {
    open ('LIST', "sort -t: +0 -1 -n -u $tmp | sed 's=^.*:FP=FP=' 2>&1|");
}
print FPS ("$titl\n");
#while (<LIST>)
#{
#    print FPS ("$_");
#    print FPS ("\/\/\n");
#}
print FPS (<LIST>);
close (FPS);


$seq="wwwtmp/seq_$$";

if ($val{'format'} eq "F")
{
#    if ($from =~ /\-(\d+)/){
#        $F_from=$1;
#    }

# use EPDtoFA for FASTA format output

    system "EPDtoFA -l$from -r$to < $fps > $seq 2> wwwtmp/errors";
#    open (OUTFILE, "> $seq");
#    open (SEQ, "EPDtoFA -l$from -r$to < $fps |");
#    while (<SEQ>)
#    {
#        print OUTFILE;
#    }
#    close (SEQ);
#    close (OUTFILE);


## extracts from fps file a hash table with EPD independent subset status corresponding to each AC.
#    $/ = "\/\/";
#    open (EPD, $epd);
#    while (<EPD>)
#    {
#       ($sig,$ac) = /FP.{24,24}([\-\+]).{30,30}(\d{5,5})/;
#       $ffp{$ac}="(".$sig.")";
#    }

#    open ('LIST', "./EPDtoFA.pl $from $to $fps |");
#    open ('LIST', "wwwtmp/tmp_$$.seq");
#    while (<LIST>)
#    {
#       s/EP0(\d{5,5})(.*)/EP$1 $ffp{$1}$2/g;
#       s/range\s+(\-?\d+)\s+to\s+(\-?\d+)/range $1 to $2/g;
#       print SEQ;
#    }
#    close (LIST);
}

if ($val{'format'} eq "E")
{
# generate inp file for FROMFPS
    $inp="wwwtmp/inp_$$";
    open ('INP', "> $inp") or die ("cannot open $inp for writing: $!\n");
#/home/httpd/cgi-bin;
    print INP "$fps\n$from\n$to\n\n\n\n$val{'format'}\nwwwtmp/tmp_$$\n";
    close (INP);

    system "FROMFPS < $inp 2>/dev/null";

# reformat FROMFPS ouput in EMBL format
    open ('SEQ', "> $seq") or die ("cannot open $seq for writing: $!\n");
    open ('LIST', "wwwtmp/tmp_$$.dat");
    while (<LIST>){
        ($ac) = /AC   E(\d+)/;
        $new_ac="EP".$ac;
        s/(ID   )(\S+)(.*)/$1$new_id{$new_ac}$3/g;
        s/(AC   )([A-Z]+$ac)(.*)/$1$new_ac$3/g;
#        s/(AC   )([^\;]+)(.*)/$1$new_ac$3/g;
        print SEQ;
    }
    close (SEQ);
    close (LIST);
}

# output of results in html page
open ('OUT', "< $seq");
&printCGIHeader;
print ("<PRE>");
print (<OUT>);
print ("</PRE>");
close (OUT);

exit (0);

# subroutines ---------------------------------------------

sub spout {
    my ($recordref) = shift();
    foreach (@$recordref) {
       print;
    }
}


# HTML subroutines ---------------------------------------

sub printCGIHeader {
    print "Content-type: text/html\n\n";
}


sub printHTMLHeader {
    print "<HTML><HEAD></HEAD>\n";
    print "<BODY>\n";
#   print "<H1 ALIGN=CENTER>Record Viewer</H1><HR>\n";
}

sub printHTMLFooter {
    print "</BODY></HTML>\n";
}

sub HTMLError {
    my ($msg) = shift();

    printHTMLHeader();
    print "Error: $msg";
    printHTMLFooter();
    die();
}

