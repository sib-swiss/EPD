#!/usr/bin/env perl
#use CGI::Carp qw(fatalsToBrowser);
use strict;

my %FORM;


if ($ENV{'REQUEST_METHOD'} eq 'POST') {
    read(STDIN, my $buffer, $ENV{'CONTENT_LENGTH'});
    my @pairs = split(/&/, $buffer);
    foreach my $pair (@pairs) {
	(my $name, my $value) = split(/=/, $pair);
	#$value =~ tr/+/ /;
	$value =~ s/;//;
	$FORM{$name} = $value;
    }

    &printCGIHeader;










&printCGIFooter;
}

sub printCGIHeader {
    print "Content-type: text/html\n\n";
print "<head>";
    print "<title>Arabidopsis root correlation page</title>";
    print "<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\">";
    print "<meta http-equiv=\"Content-Style-Type\" content=\"text/css\">";
    print "<link rel=\"stylesheet\" href=\"/css_epd/sib-expasy.min-20240214.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">";
    print "<link rel=\"shortcut icon\" href=\"/img_epd/favicon.ico\" type=\"image/x-icon\">";
    print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/css_epd/search.min.css\" />";
print "</head>";
print "<body>";
print "<div style=\"border : solid 2px #38ACEC; margin:2%; padding:2%; height:90%\" >";
print "<h1 align=\"center\">Arabidopsis correlation query page</h1>";
print "<br><br>";
}

sub printCGIFooter {
print "</div></body></html>";
}

