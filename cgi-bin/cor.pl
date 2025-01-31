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

    if (($FORM{"agi"} ne "") || $FORM{"cutoff"} ne ""){
	my $id = uc $FORM{'agi'};
	my $command = "/Home/rdreos/bin/extract_genes.pl $id $FORM{'corr'}";
	my @result = `$command`;
	print "<table>";
	foreach my $line (@result){
	    chomp $line;
	    if ($line =~ m/^ID:/){
		$line =~ s/ID: //;
		print "<tr><td>ID: </td><td><b>$line</b></td></tr>";
	    }elsif($line =~ m/^PR:/){
		$line =~ s/PR: //;
		print "<tr><td>Probeset:</td><td>$line</td></tr>";
	    }elsif($line =~ m/^MT:/){
		$line =~ s/MT: //;
		print "<tr><td>Probeset match to:</td><td>$line</td></tr>";
	    }elsif($line =~ m/^DE:/){
		$line =~ s/DE: //;
		print "<tr><td>Description:</td><td>$line</td></tr>";
		print "</table>";
		print "<br><br><b>It correlates to:<b><table border=\"1\">";
	    }elsif($line =~ m/^CO:/){
		$line =~ s/CO: //;
		my @corr = split('\t', $line);
		print "<tr><td>$corr[0]</td><td>$corr[1]</td><td>$corr[2]</td><td>$corr[3]</td></tr>";
	    }
	}
	#system("echo \"Someone search for $FORM{'agi'}\" | mail -s \"Arabidopsis query $FORM{'agi'}\" \"rene.dreos\@epfl.ch\"");
	print "</table>";
    }else{
	print "Please enter an AGI code or correlation cut-off value!";
    }



    &printCGIFooter;
}

sub printCGIHeader {
    print "Content-type: text/html\n\n";
    print "<html><head>";
    print "<title>Arabidopsis root correlation page</title>";
    print "<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\">";
    print "<meta http-equiv=\"Content-Style-Type\" content=\"text/css\">";
    print "<link rel=\"stylesheet\" href=\"/css_epd/sib-expasy.min-20240214.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">";
    print "<link rel=\"shortcut icon\" href=\"/img_epd/favicon.ico\" type=\"image/x-icon\">";
    print "<link rel=\"stylesheet\" type=\"text/css\" href=\"/css_epd/search.min.css\" />";
    print "</head>";
    print "<body>";
    print "<div style=\"border : solid 2px #38ACEC; margin:2%; padding:2%; \"> ";
	print "<h1 align=\"center\">Arabidopsis correlation query page</h1>";
    print "<br><br>";
}

sub printCGIFooter {
    print "</div></body></html>";
}

