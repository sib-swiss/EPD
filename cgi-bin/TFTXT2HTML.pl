#!/usr/bin/env perl

# -tj
# converts a local Transfac record from text to HTML.

$ENV{'PATH'} .= ":/usr/molbio/perl";


$record = $ARGV[0];

$fetchCommand = "/usr/molbio/perl/fetch transfac:$record";

printHTMLHeader();

open (RECORD, "$fetchCommand |") or &HTMLError ("Could not open $record.");

print ("<PRE>");

while (<RECORD>)
{
	if (/^(BF|BS|MX)  ([^\;]+)(.*)/)
	{
	    print "$1  <a href=\"/cgi-bin/miniepd/get_doc?db=transfac&format=html&entry=$2\">$2</a>$3\n";
	}
	elsif (/^DR  EMBL\: ([^\;]+)(.*)/)
	{
	    $ac=$1;
	    print "DR  EMBL\: <a href\=\"https://www.ebi.ac.uk/htbin/emblfetch\?$1\">$1</a>$2\n";
	}

	elsif ( /^DR  EPD\: ([^\;]+)(.*)/ )
	{

	    print "DR  EPD\: \<a href\=\"/cgi-bin/miniepd/get_doc?db=epd&format=html&entry=$1\">$1</a>$2\n";
	}
	elsif ( /^DR  SwissProt\: ([^\;]+)(.*)/ )
	{

	    print "DR  SwissProt\: \<a href\=\"https://www.expasy.org/cgi-bin/niceprot.pl?$1\">$1</a>$2\n";
	}
	elsif ( /^DR  PIR\: ([^\;]+)(.*)/ )
	{

	    print "DR  PIR\: \<a href\=\"http://pir.georgetown.edu/cgi-bin/iproclass/iproclass?choice=entry&id=$1\">$1</a>$2\n";
	}
	elsif (/RX  MEDLINE\; ([^\.]+)/)
	{
	    print "RX  MEDLINE\; \<a href\=\"http://www3.ncbi.nlm.nih.gov/htbin-post/Entrez/query?db=m&form=6&dopt=r&uid=$1\"\>$1\<\/a\>\.\n";
	}
	else
	{				   # this was not a DR line...
	    print;
	}
}

print("</PRE>");

	printHTMLFooter();

sub printHTMLHeader
{
    print "<HTML><HEAD><TITLE>TRANSFAC</TITLE><HEAD><BODY bgcolor\=\"\#FFFFFF\">";
    print "<H2>TRANSFAC, version 6.3</H2><HR>";
}

sub printHTMLFooter
{
    print "</BODY></HTML>";
}

sub HTMLError
{
    my ($msg) = @_;
    printHTMLHeader();
    print "Error: $msg";
    printHTMLFooter();
    die();
}
