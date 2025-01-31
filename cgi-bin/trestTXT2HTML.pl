#!/usr/bin/env perl

# -tj
# converts a trest or a trgen record from text to HTML.
# links it to unigene if existing, or to the unigene contig,
# or to the nucleotide reference.

$ENV{'PATH'} .= ":/usr/molbio/perl";


$record = $ARGV[0];

if ($record =~ /[A-Z]{1,2}\d{4,6}[_|\.]\d+/)
{
    $fetchCommand = "/usr/molbio/perl/fetch trgen:$record";
    $db="TRGEN";
}

elsif ($record =~ /\w{1,2}\d+|\w{2}[_|\.]\d+[_|\.]\d+/)
{
    $fetchCommand = "/usr/molbio/perl/fetch trest:$record";
    $db="TREST";
}

printHTMLHeader();

open (RECORD, "$fetchCommand |") or &HTMLError ("Could not open $record.");

print ("<PRE>");

while (<RECORD>)
{
	if (/^ID   ([A-Z][a-z][^\s]+)/)
	{
	    $ug_contig=$1;
	    chomp;
	    print;
	    print " [<a href=\"/cgi-bin/miniepd/get_doc?db=ug_contig&format=text&entry=$ug_contig\">ug_contig</a>]\n";
	}
	elsif (/^AC   (\w{1,2}\d+)\;/)
	{
	    $ac=$1;
	    print "AC   <a href\=\"https://www.ebi.ac.uk/htbin/emblfetch\?$1\">$1</a>\;\n";
	}
	elsif ( /^OX   NCBI_TaxID\=(\d+)/)
	{
	    print "OX   NCBI_TaxID=\<a href\=\"https://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?id=$1\">$1<\/a>\n";
	}

	elsif ( /^DR   UNIGENE\; ([^\.]+)\.([^\.]+)/ )
	{
	    $os=$1;
	    $ug_ac=$2;
	    print "DR   UNIGENE\; \<a href\=\"https\:\/\/www\.ncbi\.nlm\.nih\.gov\/UniGene\/clust\.cgi\?ORG\=$os\&CID\=$ug_ac\"\>$os\.$ug_ac</a>\.\n";
	}
	elsif ( /^DR   EMBL\; ([^\;]+)\; ([^\;]+)(.*)/ )
	{
	    $sv=$1;
	    $em_id=$2;
	    $rest=$3;
	    if ($db =~ /TRGEN/)
	    {
		if ($em_id =~ /(\w+)_(\d+)/)
		{
		    print "DR   EMBL\; $sv\; <a href\=\"/cgi-bin/miniepd/get_doc?db=embl&format=text&entry=$1\[$2\]\">$em_id</a>$rest\n";
		}
		else
		{
		    print "DR   EMBL\; $sv\; <a href\=\"https://www.ebi.ac.uk/htbin/emblfetch\?$em_id\">$em_id</a>$rest\[ <a href\=\"http:\/\/www3\.ncbi\.nlm\.nih\.gov\/htbin-post\/Entrez\/query\?db\=n&form\=6&dopt\=g&uid\=$sv\"\>Original version from NCBI<\/a> \]\n";
		}
	    }
	    else
	    {
		print "DR   EMBL\; $sv\; <a href\=\"https://www.ebi.ac.uk/htbin/emblfetch\?$em_id\">$em_id</a>$rest\[ <a href\=\"http:\/\/www3\.ncbi\.nlm\.nih\.gov\/htbin-post\/Entrez\/query\?db\=n&form\=6&dopt\=g&uid\=$ac\"\>Original version from NCBI<\/a> \]\n";
	    }
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
    print "<HTML><HEAD><TITLE>$db</TITLE><HEAD><BODY bgcolor\=\"\#FFFFFF\">";
    print "<H2>$db</H2><HR>";
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
