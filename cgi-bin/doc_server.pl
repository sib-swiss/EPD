#!/usr/bin/env perl

# IF IT DOES NOT WORK, CHECK HERE FIRST!!!
$fetch = "/usr/local/bin/fetch";           # in case someone mv's the fetch script...
$ENV{'PATH'} .= ":/usr/molbio/perl";
use CGI;
use CGI::Carp qw (fatalsToBrowser);
use MyCGI;

if ($#ARGV == 0)
{
    # command line mode
    $record = $ARGV[0];
#    $format = "html";
    if ($record eq "")
    {
	&printCGIHeader();
	&HTMLError ("No AC or ID given.");
    }
}
else
{
    # CGI mode
#    $form = new CGI();
    $form = new MyCGI;
    # get input
    # get and check the args...
    $doc_type = $form->param('doc_type');
    $record = $form->param('entry');
    $html = $form->param('html');
}


# if the format is a variant of HTML, we call the existing script. (An
# independent EPD to HTML converter must anyway exist if we are to use
# the frames capability of the Java applet, so we might as well call
# it directly.)

if ($doc_type eq "epd/a")
  {
    $html = "content-type: text/html\n\n";
    $html .= "<HTML><HEAD><TITLE>EPD entry</TITLE><HEAD><BODY>";
    $html .= "<H2>EPD - Query Result</H2><HR>";
    $html .= `./epdTxt2HTML.pl $record`;
    print $html;
    $html = `./displayTFRecord.pl $record`;
    print $html;
    $html ="<HR>
    The SEView graphical sequence element viewer is described in:
    Junier T. and Bucher P., SEView: A java applet for browsing molecular sequence data.
    In Silico Biol. 1 (1998) 13-20. at the <b>URL:
    <a href=\"http://www.bioinfo.de/isb/1998/01/0003/\">
    http://www.bioinfo.de/isb/1998/01/0003/</a></b>.\n\n";

    print $html;

    print '</BODY></HTML>';
    exit (0);
  }
elsif ($doc_type eq "epd/h")
  {
    # html, but no java? call epdTxt2HTML directly
    $html = "content-type: text/html\n\n";
    $html .= "<HTML><HEAD><TITLE>EPD entry</TITLE><HEAD><BODY>";

    $html .= "<H2>EPD - Query Result</H2><HR>";
    $html .= `./epdTxt2HTML.pl $record`;
    print $html;
    print '</BODY></HTML>';
    exit (0);
  }
if ($doc_type eq "epd/t") {
   open (FETCH, "$fetch epd:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "exp/h")
  {
    $html = "content-type: text/html\n\n";
    $html .= "<HTML><HEAD><TITLE>EPDEX entry</TITLE><HEAD><BODY>";
    $html .= "<H2>Expression Database - Query Result</H2><HR>";
    $html .= `./epdexTxt2HTML.pl $record`;
    print $html;
    print '</BODY></HTML>';
    exit (0);
  }
if ($doc_type eq "exp/t") {
   open (FETCH, "$fetch cleanex:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "genex/h")
  {
    $html = "content-type: text/html\n\n";
    $html .= "<HTML><HEAD><TITLE>EPD entry</TITLE><HEAD><BODY>";
    $html .= "<H2>CleanEx - Query Result</H2><HR>";
    $html .= `./cleanexTxt2HTML.pl $record`;
    print $html;
    print '</BODY></HTML>';
    exit (0);
  }
if ($doc_type eq "genex/t") {
   ($dataset) = $record =~ /([A-Z0-9]+)/;
   open (FETCH, "$fetch genex:$dataset\_DOC genex:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "transfac/t") {
   open (FETCH, "$fetch transfac:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "embl/t") {
   open (FETCH, "$fetch embl:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
#elsif ($doc_type eq "embl/a") {
#   use SEView;
    # added 29 IX 97 for testing applet's EMBL version
#    open (FETCH, "$fetch embl:$record 2>&1 |") or
#	HTMLError("Could not start fetch: $!");
#    @lines = (<FETCH>);

    # print headers
#    printCGIHeader();
#    printHTMLHeader();

#    print ("<pre>");
#    print @lines;		# print record
#    extractEMBL (\@lines);
#    print ("</pre>");
#SEView::printAppletTag (500, 200, "http://www.isrec.isb-sib.ch/java/SEView");


#     $html ="<HR>
#    This SEView graphical sequence element viewer is described in:
#    Junier T. and Bucher P., SEView: A java applet for browsing molecular sequence data. In Silico Biol. 1 (1998) 13-20. at the <b>URL:
#    <a href=\"http://www.bioinfo.de/isb/1998/01/0003/\">
#    http://www.bioinfo.de/isb/1998/01/0003/</a></b>.\n\n";

#    print $html;

#    exit (0);
#}
#elsif ($doc_type eq "sv/a") {
#   use SEView;
    # added 29 IX 97 for testing applet's EMBL version
#    open (FETCH, "$fetch sv:$record 2>&1 |") or
#	HTMLError("Could not start fetch: $!");
#    @lines = (<FETCH>);

    # print headers
#    printCGIHeader();
#    printHTMLHeader();

#    print ("<pre>");
#    print @lines;		# print record
#    extractEMBL (\@lines);
#    print ("</pre>");
#    printAppletTag_dynamic (500, 200, "http://cmpteam4.unil.ch/~tjunier/java/classes");
#   printAppletTag_dynamic (500, 200, "http://pcisrec-d402b.unil.ch/~tjunier/java/classes");

#     $html ="<HR>
#    This SEView graphical sequence element viewer is described in:
#    Junier T. and Bucher P., SEView: A java applet for browsing molecular sequence data. In Silico Biol. 1 (1998) 13-20. at the <b>URL:
#    <a href=\"http://www.bioinfo.de/isb/1998/01/0003/\">
#    http://www.bioinfo.de/isb/1998/01/0003/</a></b>.\n\n";

#    print $html;

#    exit (0);
#}
elsif ($doc_type eq "sv/t") {
   open (FETCH, "$fetch sv:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "crc/t") {
   open (FETCH, "fetchCRC $record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "crc/f") {
   open (FETCH, "fetchCRC -f $record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "crc/a") {
   open (FETCH, "fetchCRC -a $record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "sp/t") {
   open (FETCH, "$fetch $record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "prf/h") {
   open (FETCH, "get_entry  /database/profile/pstpfm.prf /database/profile/pstpfm.idx $record | sed -f prf.sed |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "pfama_nat/h") {
   open (FETCH, "get_entry -l20 /data/Pfam/pfama_nat.prf  /data/Pfam/pfama_nat.idx $record | sed -f pfama_nat.sed |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "trest") {
   open (FETCH, "$fetch trest:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "trest/h")
  {
    # html, but no java? call trestTxt2HTML directly
    $html = "content-type: text/html\n\n";
    $html .= "<HTML><HEAD><TITLE>TREST entry</TITLE><HEAD><BODY>";
    #$html .= "<H2>Expression Database - Query Result</H2><HR>";
    $html .= `./trestTXT2HTML.pl $record`;
    print $html;
    print ("</BODY></HTML>");
    exit (0);
  }
elsif ($doc_type eq "rg") {
   open (FETCH, "$fetch rg:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "atl") {
   open (FETCH, "($fetch atlb:$record; echo \"//\"; $fetch atl:$record ) | /db/cdnalibs/atlb2hmtl.pl 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "trgen") {
   open (FETCH, "$fetch trgen:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
elsif ($doc_type eq "trembl" || $doc_type eq "trnew") {
   open (FETCH, "$fetch trembl:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
&printCGIHeader();
if ($html ne "off") { &printHTMLHeader();
print("<PRE>") }
while(<FETCH>) {
print;
}
if ($html ne "off") { print("</PRE>");
&printHTMLFooter() }
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
}

sub printHTMLFooter {
    print "</BODY></HTML>\n";
}

sub HTMLError {
    my ($msg) = @_;

    printHTMLHeader();
    print "Error: $msg";
    printHTMLFooter();
    die();
}

