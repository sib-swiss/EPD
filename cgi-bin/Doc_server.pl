#!/usr/bin/env perl

# IF IT DOES NOT WORK, CHECK HERE FIRST!!!
$fetch = "/usr/molbio/perl/fetch";           # in case someone mv's the fetch script...
$ENV{'PATH'} .= ":/usr/molbio/perl";

if ($#ARGV == 0) {
    # command line mode
    $record = $ARGV[0];
    $format = "html";
} else {
    # CGI mode
    use CGI::Lite;
    $form = new CGI::Lite();
    # get input
    %val = $form->parse_form_data();
    # get and check the args...
    $doc_type = $val{'doc_type'};
    $record = $val{'entry'};
}

if ($record eq "") {
    &printCGIHeader();
    &HTMLError ("No AC or ID given.");
}

# if the format is a variant of HTML, we call the existing script. (An
# independent EPD to HTML converter must anyway exist if we are to use
# the frames capability of the Java applet, so we might as well call
# it directly.)

if ($doc_type eq "epd/a") {
    # java: delegate everything to TFFrames.cgi
    $html = `/home/httpd/cgi-bin/TFframes.pl $record`;
    print $html;
    exit (0);
}
elsif ($doc_type eq "epd/h") {
    # html, but no java? call epdTxt2HTML directly
    $html = `/home/httpd/cgi-bin/epdTxt2HTML.pl $record`;
    print $html;
    exit (0);
}

if ($doc_type eq "epd/t") {
   open (FETCH, "$fetch epd:$record 2>&1 |") or
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
elsif ($doc_type eq "nid/t") {
   open (FETCH, "$fetch ni:$record 2>&1 |") or
   HTMLError("Could not start fetch: $!");
}
&printCGIHeader();
print("<PRE>");
while(<FETCH>) {
print;
}

printHTMLFooter();
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
    print "<H1 ALIGN=CENTER>Record Viewer</H1><HR>\n";
}

sub printHTMLFooter {
#    print "</BODY></HTML>\n";
}

sub HTMLError {
    my ($msg) = @_;

    printHTMLHeader();
    print "Error: $msg";
    printHTMLFooter();
    die();
}
