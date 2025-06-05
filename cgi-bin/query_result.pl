#!/usr/bin/env perl

# query_result.pl - this script does whatever the user asks :-), but
# it is most useful when called from the HTML page generated from the
# EPD query engine (/epd/epd_query_form.html).


use CGI;
use CGI::Carp qw(fatalsToBrowser);
use MyCGI;
use IPC::Open2;
#use Sys::Hostname;

my $DB = '../htdocs/ftp';
my $epd2fasta = ' EPDtoFA';
my $epd2embl = ' FROMFPS';
$ENV{'SSA2DBC'} = '/usr/local/EPD_web.git/htdocs/ssa/data/SSA2DBC.def'; # code changed
my $WWWTmpDir = './wwwtmp';
my $R_cmd = 'R --no-save > /dev/null';

my $epd2HTML = "./epdTxt2HTML.pl";
my $fetch = "/usr/local/bin/fetch -c ../etc/fetch.conf";
my $grep = '/bin/grep';
my $epd2xml = './epd2xml.pl';
my $epd2ssa = './ssa_form.pl';
# fetch calls a lot of other scripts which reside here, test for virtual server installation???
$ENV{'PATH'} = "/usr/local/bin:".$ENV{'PATH'}.":/usr/molbio/perl";

################################################################
# Get and check parameters
#$query = new CGI;
my $query = new MyCGI;

@names = $query->param();
#        print ($query->header);
#       &printCGIHeader;
#        print ("<PRE>");
#        print "\$query $query\n\@names @names \n";
#        print ("</PRE>");
my $out_format = $query->param('out_format');
my $record="";

if ($out_format eq 'EMBL' or $out_format eq 'FASTA' or $out_format eq 'GC')
{
    if ($out_format eq 'GC')
    {
        $from = $query->param('gc_from');
        $to = $query->param('gc_to');
    }
    else
    {
        $from = $query->param('from');
        $to = $query->param('to');
    }
    if (($from<-9999)||($to>10000)||($to-$from>16000))
    #    if (($from<-9999)||($to>10000))
    {
        print ($query->header);
        #&printCGIHeader;
        print ("<PRE>");
        print "User input error : <br>Sorry, sequence download is limited to segments of 16kb between -9999 and 10000 bp relative to the transcription start site";
        print ("</PRE>");
        print ($query->end_html);
        exit (0);
    }
    if ($from>$to)
    {
        print ($query->header);
        #&printCGIHeader;
        print ("<PRE>");
        print "User input error : <br>The position of the 5'end (FROM=$from) has to be upstream of that of the 3'end (TO=$to)
        ";
        print ("</PRE>");
        print ($query->end_html);
        exit (0);
    }

    # parse current EPD file for title and to correct IDs and ACs in FROMFPS output
    local($/) = "\/\/";

    open (EPD,"$DB/epd/current/epd.dat");
    while (<EPD>)
    {
        if (/(TI   EPD[^\n]+)/){
            $titl = $1;
        }
        ($id) = /ID   (\S+)/;
        ($ac) = /AC   (EP[^\;]+)/;
        $new_id{$ac}=$id;
        $new_ac{$id}=$ac;
    }
    close (EPD);
    open (EPDB,"$DB/epd/current/epd_bulk.dat");
    while (<EPDB>)
    {
        if (/(TI   epd[^\n]+)/){
            #$titl = $1;
        }
        ($id) = /ID   (\S+)/;
        ($ac) = /AC   (EP[^\;]+)/;
        $new_id{$ac}=$id;
        $new_ac{$id}=$ac;
    }
    close (EPDB);
}


foreach $name (@names)
{
    if ($name =~ /^Entry_\d+$/)
    {
        push (@entries, $query->param($name));
    }
}
if (@entries ==  ()){
    print ($query->header);
    print ("<PRE>");
    print "User Input Error: Sorry, the list of selected entries is empty.";
    print ("</PRE>");
    print ($query->end_html);
    exit (0);
}

################################################################
# Perform Job

$tmp=$WWWTmpDir."/tmp_$$";

if ($out_format eq 'HTML')
{
    # print ("Content-type:text/html\n\n");
    print ($query->header);

    foreach $entry (@entries)
    {
        print ("<h2>$entry</h2>");
        print (`$epd2HTML $entry`);
    }
    print ($query->end_html);
}
elsif ($out_format eq 'text')
{
    print ($query->header('text/plain'));

    foreach $entry (@entries)
    {
        print (`$fetch epd:$entry`);
    }
}

elsif ($out_format eq 'FASTA')
{
    open (FILE, ">$tmp");
    print FILE ("$titl\n");

    print ($query->header);
    print ("<pre>");

    # enable both IDs and ACs to be used as cgi parameters
    foreach $entry (@entries)
    {
        $tag{$entry}=1;
        $tag{$new_ac{$entry}}=1;
    }

    open(EPD,"grep -h -e '^FP  ' $DB/epd/current/epd.dat $DB/epd/current/epd_bulk.dat | ");
    while(<EPD>)
    {
        ($fp)=/^FP   [^\;]+\; (\d+)\./;
        $fp="EP".$fp;
        if ($tag{$fp})
        {
            print FILE ("$_");
        }
    }
    close(EPD);
    close (FILE);
    open (OUTFILE, "$epd2fasta -l$from -r$to < $tmp 2>/dev/null |");
    while (<OUTFILE>)
    {
        print;
    }
    close (OUTFILE);

    print ("</pre>");
    print ($query->end_html);
}
elsif ($out_format eq 'EMBL')
{
    print ($query->header);
    print "<pre>";
    open (FILE, ">$tmp");
    print FILE ("$titl\n");
    # enable both IDs and ACs to be used as cgi parameters
    foreach $entry (@entries)
    {
        $tag{$entry}=1;
        $tag{$new_ac{$entry}}=1;
    }
    open(EPD,"grep -h -e '^FP  ' $DB/epd/current/epd.dat $DB/epd/current/epd_bulk.dat | ");
    while(<EPD>)
    {
        ($fp)=/^FP   [^\;]+\; (\d+)\./;
        $fp="EP".$fp;
        if ($tag{$fp})
        {
            print FILE ("$_");
        }
    }
    close(EPD);
    close (FILE);

    # generate inp file for FROMFPS
    $inp=$WWWTmpDir."/inp_$$";
    #    open ('INP', "> $inp") or die ("cannot open $inp for writing: $!\n")/home/httpd/cgi-bin;
    open ('INP', "> $inp") or die ("cannot open $inp for writing: $!\n");
    print INP "$tmp\n$from\n$to\n\n\n\nE\n$tmp\n";
    close (INP);

    system "$epd2embl < $inp 2>/dev/null";

    local($/) = "\/\/";
    # reformat FROMFPS output in EMBL format
    open ('LIST', "$WWWTmpDir/tmp_$$.dat");
    while (<LIST>)
    {
        ($ac) = /AC   E(\d+)/;
        $new_ac="EP".$ac;
        s/(ID   )(\S+)(.*)/$1$new_id{$new_ac}$3/g;
        s/(AC   )([A-Z]+$ac)(.*)/$1$new_ac$3/g;
        print;
    }
    close (LIST);

    #    open (OUTFILE, " ./EPDtoEMBL.pl $from $to $tmp |");
    #    while (<OUTFILE>)
    #    {
    #        print;
    #    }
    #    close (OUTFILE);
    print "</pre>";
    print ($query->end_html);
}

elsif ($out_format eq 'GC')
{
    open (FILE, ">$tmp.fps");
    print FILE ("$titl\n");
    foreach $entry (@entries)
    {
        $tag{$entry}=1;
    }

    open(EPD,"grep -h -e '^FP  ' $DB/epd/current/epd.dat $DB/epd/current/epd_bulk.dat | ");
    while(<EPD>)
    {
        ($fp)=/^FP   [^\;]+\; (\d+)\./;
        $fp="EP".$fp;
        if ($tag{$fp})
        {
            print FILE ("$_");
        }
    }
    close(EPD);
    close (FILE);

    # download selected sequences / range in FASTA format into wwwtmp
    system "$epd2fasta -l$from -r$to < $tmp.fps > $tmp.seq";

    # calculate GC-content
    system "./fasta2GC.pl $tmp.seq $from $to 30 > $tmp.for_R.out";

    # number of promoter sequences used for $tmp.for_R.out (with less than 10% Ns!)
    my $num;
    open (NUM, "grep '^>CG-content of collection' $tmp.for_R.out|");
    while (<NUM>){
        ($num)=/CG-content of collection of (\d+) sequences/;
    }
    close (NUM);

    if ($num>0){
        # generate plot in R

        open (R1,">$tmp.src");
        print R1 "bitmap(\"$tmp.png\",type=\"png16\",width=9,height=6,res=80)\n";
        print R1 "plot(read.table(\"$tmp.for_R.out\",skip=1), type='l', main=\"CG-content\", ylim=c(0,0.8), ylab=\"fraction\", xlab=\"position relative to TSS\")\n";
        print R1 "lines($from:$to,rep(0.5,length($from:$to)), col=\"green\")\n";
        print R1 "abline(v=0,col=4,lty=2)\n";
        print R1 "dev.off()\n";
        close(R1);

        open(RSRC,"| $R_cmd") or die("cannot execute \"R\"");
        print RSRC "source(\"$tmp.src\")\n";
        close(RSRC);

        # output page that allows addition of complete human or drosophila sets
        $val=$$."&".$from."&".$to."&".$num;
        print ($query->header);
        print ("<pre>");
        print "<B><FONT SIZE=+2>CG-content of selection of $num promoter sequences </FONT><br><FONT SIZE=+1> in range: $from to $to (window size=30) </FONT></B><br>";
        print "\t\t\t\t<tr>\n\t<td align=center nowrap\=\"nowrap\"><a href=\"wwwtmp/tmp_$$.png\"><IMG SRC=\"wwwtmp/tmp_$$.png\"><\/a><\/td>\n\t\t\t\t<\/tr>";
        # /home/local/epd/wwwtmp/tmp_7397.png
        # http://epd-test.unil.ch//tmp/www-sib/tmp_7397.png
        #                         wwwtmp/tmp_7619.png
        print "<H3>  Add line(s) to plot:";
        print "  <FORM action=add_plot.pl method=GET>";
        print "  <INPUT type=\"checkbox\" VALUE=$val name=hsline> complete collection of 1871 human promoters </FONT><BR>";
        print "  <INPUT type=\"checkbox\" VALUE=$val name=dmline> complete collection of 1926 Drosophila promoters </FONT></H3><BR>";
        print " <INPUT type=\"submit\" value=\"Submit\"><INPUT type=\"reset\" value=\"Clear\"> ";
        print ("</pre>");
        print ($query->end_html);
    }
    else{
        print ($query->header);
        print ("<pre><B><FONT SIZE=+2><br>An error occured:</FONT></B></pre><br>");
        print ("<body>");
        print "<B><FONT SIZE=+1 align=\"center\"  mode=\"wrap\"><br>Sorry, all of your selected promoter sequences in the range $from to $to contain more than 10% of ambiguous bases ('N'), thus a calculation of the CG-content is not meaningful!<br>Please go back and make a new selection of sequences! </FONT></B><br>";
        print ("</body>");
        print ($query->end_html);
    }
}
elsif ($out_format eq 'NICE'){
    print ($query->header);
    print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'
    'http://www.w3.org/TR/html4/loose.dtd'>
    <html lang='en'>
    <head>
    <title>EPD Nice View</title>
    <meta http-equiv='Content-type' content='text/html; charset=utf-8'>
    <meta http-equiv='Content-Style-Type' content='text/css'>
    <link rel='stylesheet' href='/css_epd/sib-expasy.min-20240214.css' type='text/css' media='screen' charset='utf-8'>

    <link rel='shortcut icon' href='/img_epd/favicon.ico' type='image/x-icon'>
    </head>
    ";

    my $header = '../htdocs/left_menu_fetch_biomart.php';
    open(my $HEADER, '<', "$header")  or die "Can't open the [$header] file!";
    print <$HEADER>;
    close $HEADER;

    if (scalar(@entries) > 1){
        print "<div align=\"center\"><strong>";
    }
    foreach $entry(@entries){
        if (scalar(@entries) > 1){
            print "[<a href=\"\#$entry\">$entry</a>]\n";
        }
        $record .= $entry.'__';
    }
    if (scalar(@entries) > 1){
        print "</strong></div><br />\n";
    }

    print (`./EPD2NICE.pl $record`);

    my $footer = '../htdocs/footer.html';
    open(my $FOOTER, '<', "$footer")  or die "Can't open the [$footer] file!";
    print <$FOOTER>;
    close $FOOTER;
    print ($query->end_html);
}
elsif ($out_format eq 'JAVA')
{
    print ($query->header);

    foreach $entry (@entries){
        print ("<h2>$entry</h2><HR>");
        print("<font size\=-2\ width=100%><br>The SEView graphical sequence element viewer is described in: Junier T. and Bucher P., SEView: A java applet for browsing molecular sequence data. <br>In Silico Biol. 1 (1998) 13-20. at the <b>URL: <a href=\"http://www.bioinfo.de/isb/1998/01/0003/\"> http://www.bioinfo.de/isb/1998/01/0003/</a></b>.<\/font\>\n<p>\n");
        $html = `./displayTFRecord.pl $entry`;
        $html .= `./epdTxt2HTML.pl $entry`;
        print $html;
    }
    print ($query->end_html);
}
elsif ($out_format eq 'XML')
{
    my @host_urls = split(/,/, $ENV{'HTTP_X_FORWARDED_SERVER'});
    my $host_url = $host_urls[0];
    $host_url =~ s{^\s+}{};
    $host_url =~ s{\s+$}{};
    my $http = $ENV{'HTTP_REFERER'} || 'http'; # $ENV{'HTTPS'} does not look to exist, to use this trick
    $http =~ s{:.+$}{};
    $tmpfile="wwwtmp/tmp\_$$\.xml";
    print ($query->header);
    open(TMP,">$tmpfile");
    print TMP ("\<\?xml version=\"1.0\" standalone=\"no\"\?\>\n");
    print TMP ("\<\?xml-stylesheet type=\"text/xsl\" href=\"$http://$host_url/miniepd/epd.xsl\"\?\>\n");
    print TMP ("\<\!DOCTYPE epd SYSTEM \"$http://$host_url/miniepd/epd.dtd\"\>\n");
    print TMP ("\<epd xmlns=\'$http://$host_url/miniepd/'\>\n");

    foreach $entry (@entries)
    {
        open(XML,"$epd2xml $entry |");
        while(<XML>)
        {
            print TMP ("$_");
        }
        close(XML);
        #print (`$epd2xml $entry `);
    }
    print TMP"\</epd\>";
    close(TMP);
    system("gzip -c $tmpfile > $tmpfile\.gz");
    print "<hmtl><body>The selected EPD entries in xml format are ready for download <a href=\"$http://$host_url/miniepd/$tmpfile\.gz\">HERE</a><p><u>The xml file contains the following EPD Entries <\/u>:<p>";
    foreach $entry(@entries)
    {
        print "$entry<br>\n";
    }
    print "
    </body></html>\n";
}
elsif ($out_format eq 'SVG')
{
    print ($query->header);

    foreach $entry (@entries)
    {
        print ("<h2>$entry</h2>");
        print (`fetch epd:$entry | ./epd2xml.pl| ./xml2svg.pl`);
    }
    print ($query->end_html);
}
elsif ($out_format =~ /SSA\_(.*)/)
{
    $program=$1;
    open (FILE, ">$tmp.fps");
    print FILE ("TI   CUSTOM                  Custom set from EPD entries              EP\n");
    foreach $entry (@entries)
    {
        $tag{$entry}=1;
    }
    open(EPD,"grep -h -e '^FP   ' $DB/epd/current/epd.dat $DB/epd/current/epd_bulk.dat | ");
    while(<EPD>)
    {
        ($fp)=/^FP   [^\;]+\; (\d+)\./;
        $fp="EP".$fp;
        if ($tag{$fp})
        {
            print FILE ("$_");
        }
    }
    close(EPD);
    close(FILE);

    print ($query->header);
    open(QUERY,"/home/local/ccgweb/htdocs/ssa/$program\.html");
    while (<QUERY>)
    {
        if(/(.?Transcription initiation sites.*)/)
        {
            print "$1\n\<INPUT TYPE=\"HIDDEN\" NAME=\"custom_set\" VALUE=\"$tmp.fps\">\n\<option\>$3\n";
        }
        elsif (/^(.+)(\<option selected\>)(EPD non-redundant promoter set.*)/)
        {
            print "$1$2Selected set of EPD entries\<\/option\>\n";
        }
        else
        {
            print;
        }
    }
}


