#!/usr/bin/env perl
use warnings;

# If there is an argument, get it and don't use the CGI style
if ($#ARGV == 0) {
    # command line mode
    $ID = shift;
} else {
    # CGI mode
    $ID = $ENV{'QUERY_STRING'};
}

&printHTMLHeader();

print <<"END";
<frameset ROWS="*,215">
<frame NAME="top"
SRC="http://cmpteam4.unil.ch/cgi-bin/epdTxt2HTML.pl?$ID"
MARGINHEIGHT=2 MARGINWIDTH=2 SCROLLING="yes">
<frame NAME="bottom" SRC="displayTFRecord.pl?$ID" MARGINHEIGHT=2
MARGINWIDTH=2 SCROLLING="no">
</frameset>
END


&printHTMLFooter();

# HTML subroutines

sub printHTMLHeader {
    print "Content-type: text/html\n\n";
    print "<html><head><title>Transfac-oriented RecordViewer</title><HEAD></HEAD>\n";
}

sub printHTMLFooter {
    print "</HTML>\n";
}

sub HTMLError {
    my ($msg) = @_;

    printHTMLHeader();
    print "Error: $msg";
    printHTMLFooter();
    die();
}
