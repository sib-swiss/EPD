#!/usr/bin/env perl

# Thomas Junier, Oct '96
# displayRecord.pl - CGI script

# This script used to print both the record and the Java
# RecordViewer. Now it is done differently, the script only prints the
# applet. The record itself can be displayed in a separate frame, for
# example.  Query string must be the ID of an EPD record, new format.

use lib '/home/tjunier/projects/SEView';
use SEView;
$ENV{'PATH'} .= ":/usr/molbio/perl";

$ID = shift or $ID = $ENV{'QUERY_STRING'} or  &HTMLError("query string is empty.");
# perform the lookup function

my ($fetchCommand) = "fetch epd:$ID";

open ('RECORD', "$fetchCommand |") or
    HTMLError ("Could not open database.");

my (@lines) = (<RECORD>);

# now, print HTML

printHTMLHeader();

my $param = SEView::extractEPD (\@lines);
SEView::printAppletTag (500, 200, "http://www.isrec.isb-sib.ch/java/SEView");

printHTMLFooter();

# HTML subroutines ------------------------------------------------

sub printHTMLHeader {

    print "<HTML><HEAD></HEAD><BODY BGCOLOR=#ADEAEA>\n";
}

sub printHTMLFooter {
    print "</BODY></HTML>\n";
}

sub HTMLError {
    my ($msg) = @_;

    printHTMLHeader();
    print "Error: $msg";
    printHTMLFooter();
}
