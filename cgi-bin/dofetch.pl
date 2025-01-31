#!/usr/bin/env perl

use warnings;
#use CGI::Lite;

#$cgi = new CGI::Lite();
#%val = $cgi->parse_form_data();

# IF IT DOES NOT WORK, CHECK HERE FIRST!!!
$fetch = "/usr/molbio/perl/fetch";           # in case someone mv's the fetch script...
$ENV{'PATH'} .= ":/usr/molbio/perl";
# get and check the args...
#HTMLError ("No ID or AC given...") if ($val{'IDorAC'} eq "");

# call fetch
open (FETCH, "$fetch embl:R00001 2>&1 |") or
    HTMLError("Could not start fetch: $!");

# now output HTML.
printHTMLHeader();
print("<PRE>");

while(<FETCH>) {
    print;
}

print("</PRE>");
printHTMLFooter();

# HTML subroutines ---------------------------------------
sub printHTMLHeader {
    print "Content-type: text/html\n\n";
    print "<HTML><HEAD></HEAD>\n";
    print "<H1 ALIGN=CENTER>Record Viewer</H1><HR>\n";
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
