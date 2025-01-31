#!/usr/bin/env perl

# converts an EPDEX record from txt to NICE view.

$ENV{'PATH'} .= ":/usr/molbio/perl";

if ($#ARGV == 0)
{
    # command-line style
    $record = $ARGV[0];
}
else
{
    # CGI-style
    $record = $ENV{'QUERY_STRING'};
}
open('DATE',"grep 'Current release is based on Unigene database available' ../../cleanex/current/CleanEx_manual.html| ");
while (<DATE>)
{
    ($date)=/available on ([^\.]+)/;
}
close(DATE);

$fetchCommand = "fetch epdex:$record";

#printHTMLHeader();

open (RECORD, "$fetchCommand |") or &HTMLError ("Could not open $record.");
# print "<center><h1>EPD\:$record<\/h1><\/center>\n";


%EXT_URLs = (
	     'PEROU1' => "http://genome-www.stanford.edu/cgi-bin/sbcmp/search?correlate=",
	     'NCI60' => "http://genome-www.stanford.edu/cgi-bin/nci60/search?correlate=",
	     #'LYMPHOMA1' => "http://llmpp.nih.gov/cgi-bin/lymphoma/search?correlate=",
	     #'SERUM1' => "http://128.218.121.63:591/serum/FMPro?-db=ratios1.FP3&-format=search_resultsa.htm&anyaccession=",
	     'RefSeq' => "http://www.ncbi.nlm.nih.gov:80/entrez/viewer.fcgi?cmd=Retrieve&db=Nucleotide&list_uids=",
	     );
%original_URLs = (
		  'PEROU1' => "http://genome-www.stanford.edu/sbcmp/",
		  'NCI60' => "http://genome-www.stanford.edu/nci60/index.shtml",
		  'LYMPHOMA1' => "http://llmpp.nih.gov/lymphoma/",
		  'SERUM1' => "http://genome-www.stanford.edu/serum/",
		  'ROSETTA' => "http://www.rii.com/publications/2002/vantveer.html",
		  'AFFY001' => "http://microarray.cnmcresearch.org/cancer_human.htm",
		  );


extract_dataset_list();


foreach $DATA(@DATA)
{

    $count{$DATA}=0;
}

$/ = "\/\/\n";

while (<RECORD>)
#while (<>)



{
    @fields=(split(/\n/m));
    $length=scalar(@fields);
    if ($length < 2)
    {
	$entry=0;
    }
    else
    {
	$entry=1;

    foreach $fields(@fields)
    {
	if ($fields =~/ID    (HS)_(\S+)\s+([0-9|X]{1,2})?(.+)?\.$/)
        {
	    $ID="$1_$2";
	    $ORG=$1;
	    $GENE=$2;
	    $chrom=$3;
	    $LOC="$3$4";
        }
        if ($fields =~ /DE    (.*)/)
        {
	    push (@DE, $1);
	}
	if ($fields =~/ON    (.+)\.$/)
        {
	    $ON=$1;
        }
	if ($fields =~ /RNA   EMBL\; ([^\.]+)(\.\d+)\; ([^\.]+)/)
	{
	    $RNA_SV="$1$2";
	    push (@RNA, $RNA_SV);
	    $RNA_ID{$RNA_SV}=$3;
	    $RNA_AC{$RNA_SV}=$1;
	}
	if ($fields =~/DR    LocusLink\; (\d+)/)
        {
	    $LocusLink=$1;
        }
	if ($fields =~/DR    Unigene\; ([^\.]+)\.(\d+)/)
        {
	    $Unigene="$1\.$2";
	    $ug_sp{$Unigene}=$1;
	    $ug_nr{$Unigene}=$2;
        }
	if ($fields =~/DR    MIM\; (\d+)/)
        {
	    $MIM=$1;
        }
	if ($fields =~/DR    Genew\; HGNC\:(\d+)\; ([^\.]+)/)
        {
	    $HGNC=$1;
	    $HUGO=$2;
        }
	if ($fields =~ /DR    RefSeq\; (NM_\d+)/)
	{
	    $RS=$1;
	    push (@RefSeq, $RS);
	}
	if ($fields =~ /DR    SWISSPROT\; ([^\;]+)\; ([^\.]+)/)
	{
	    $SP_AC=$1;
	    push (@SP, $SP_AC);
	    $SP_ID{$SP_AC}=$2;
	}
	if ($fields =~ /DR    EPD\; ([^\;]+)\; ([^\.]+)/)
	{
	    $EPD_AC=$1;
	    push (@EPD, $EPD_AC);
	    $EPD_ID{$EPD_AC}=$2;	}
	if ($fields =~ /EXP   ([^\;]+)\; ([^\;]+)\; ([^\.]+)/)
	{
	    $EXP_AC=$2;
	    push (@EXP, $EXP_AC);
	    $EXP_TYPE{$EXP_AC}=$1;
	    $EXP_CLONE{$EXP_AC}=(split(/_/,$2))[1];
	    $EXP_TRG{$EXP_AC}=$3;
	    if ($EXP_TRG{$EXP_AC} !~/NM_\d+/)
	    {
		$EXP_URL{$EXP_AC}="http://www.cleanex.isb-sib.ch/cgi-bin/get_doc?db=cleanex_trg&format=nice&entry=";
		$new_trg{$EXP_AC}=$EXP_TRG{$EXP_AC};
	    }
	    else
	    {
		$EXP_URL{$EXP_AC}="http://www.ncbi.nlm.nih.gov:80/entrez/viewer.fcgi?cmd=Retrieve&db=Nucleotide&list_uids=";
		$new_trg{$EXP_AC}="($EXP_TRG{$EXP_AC})";
	    }
	}
    }
    }
}


foreach $EXP(@EXP)
{
    foreach $DATA(@DATA)
    {
	$exp_code{$DATA}="no";
	if ($EXP_TYPE{$EXP} eq $DATA)
	{
	    $count{$DATA}++;
	}
    }
}
$DE="@DE";
$DE=~tr/ /_/;
print"<html><body bgcolor\=\"\#FFFFFF\">\n";
if ($entry == 0)
{
    print "<h2><center>Sorry, no EPDEX entry for this gene.</h2><hr><br> For a new search on EPDEX, go to <a href=\"/miniepd/epdex_query_form.html\">epdex_query_form.html</a></center>";
}
else
{
print"<head><title>EPDEX : $ID</title>\n<\/head>\n";
print"<center>\n\t<h1>EPDEX : $ID</h1>\n</center>\n";
print"<div align=\"center\"><b>[<a href=\"\#general\">General</a>]\n[<a href=\"\#RNA\">RNA sequences</a>]\n[<a href=\"\#x-ref\">Cross-references</a>]\n[<a href=\"\#exp\">Expression data</a>]</b></div><br />\n";


print"<table cellpadding\=\"0\" cellspacing\=\"0\" bgcolor\=\"\#66CC66\" width\=\"100\%\">\n\t<tr>\n\t\t<td bgcolor\=\"\#66CC66\">\n\t\t\t<table cellpadding\=\"0\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td><font color\=\"\#FFFFFF\"><a name=\"general\"></a><b>General information about the entry<\/b><\/font>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td bgcolor\=\"\#66CC66\">\n\t\t\t<table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";

print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\" nowrap\=\"nowrap\"  width=\"20%\">Entry name\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\" width\=\"100\%\"><b>$ID<\/b>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";
print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Locus\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\"><a href\=\"http://www.ncbi.nlm.nih.gov/mapview/maps.cgi?ORG=hum&CHR=$chrom&MAP0=loc&MAP1=gene&VERBOSE=ON&SIZE=20&QUERY=$GENE\">$LOC<\/a>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";
print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td valign\=\"top\"bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Description of the gene\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">@DE\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";
if ($ON ne "none")
{
    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Old gene names\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">$ON\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n";
}
print "\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n";

print "<tr><td bgcolor\=\"\#66CC66\"><table cellpadding\=\"0\"><tr><td><font color\=\"\#FFFFFF\"><a name=\"x-ref\"></a><b>Cross-references<\/b><\/font><\/td><\/tr><\/table><\/td><\/tr>\n<tr><td bgcolor\=\"\#66CC66\"><table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";
if ($LocusLink ne "")
{
print"<tr bgcolor\=\"\#FFFFCC\"><td valign\=\"top\">LocusLink<\/td>\n<td><a href\=\"http://www.ncbi.nlm.nih.gov/LocusLink/LocRpt.cgi?l=$LocusLink\">$LocusLink<\/a><\/td><\/tr>\n";
}
if ($Unigene ne "")
{
print"<tr bgcolor\=\"\#FFFFCC\"><td valign\=\"top\">Unigene<\/td>\n<td><a href\=\"http://www.ncbi.nlm.nih.gov/UniGene/clust.cgi?ORG=$ug_sp{$Unigene}&CID=$ug_nr{$Unigene}\">$Unigene<\/a><\/td><\/tr>\n";
}
if ($MIM ne "")
{
print"<tr bgcolor\=\"\#FFFFCC\"><td valign\=\"top\">MIM<\/td>\n<td><a href\=\"http://www.ncbi.nlm.nih.gov/entrez/dispomim.cgi?id=$MIM\">$MIM<\/a><\/td><\/tr>\n";
}
if ($HGNC ne "")
{
print"<tr bgcolor\=\"\#FFFFCC\"><td valign\=\"top\">Genew<\/td>\n<td><a href\=\"http://www.gene.ucl.ac.uk/nomenclature/data/get_data.php?hgnc_id=$HGNC\">HGNC\:$HGNC\; $HUGO<\/a><\/td><\/tr>\n";
print "<tr bgcolor\=\"\#FFFFCC\"><td valign\=\"top\">GeneCards<\/td>\n<td><a href\=\"http://bioinfo.weizmann.ac.il/cards-bin/carddisp?$HUGO\">$HUGO<\/a><\/td><\/tr>\n";
print "<tr bgcolor\=\"\#FFFFCC\"><td valign\=\"top\">Ensembl<\/td>\n<td><a href\=\"http://www.ensembl.org/Homo_sapiens/geneview?gene=$GENE\">$GENE<\/a><\/td><\/tr>\n";
}
if (@RefSeq ne "")
{
    foreach $RefSeq(@RefSeq)
    {
	print"<tr bgcolor\=\"\#FFFFCC\"><td valign\=\"top\">RefSeq<\/td>\n<td><a href\=\"http://www.ncbi.nlm.nih.gov:80/entrez/viewer.fcgi?cmd=Retrieve&db=Nucleotide&list_uids=$RefSeq\">$RefSeq<\/a><\/td><\/tr>\n";
    }
}
if (@SP ne "")
{
    foreach $SP(@SP)
    {
	print"<tr bgcolor\=\"\#FFFFCC\"><td valign\=\"top\">SWISSPROT<\/td>\n<td><a href\=\"https://www.expasy.org/cgi-bin/sprot-search-ac?$SP\">$SP<\/a>\; $SP_ID{$SP}<\/td><\/tr>\n";
    }
}
if (@EPD ne "")
{
    foreach $EPD(@EPD)
    {
	print"<tr bgcolor\=\"\#FFFFCC\"><td valign\=\"top\">EPD<\/td>\n<td><a href\=\"/cgi-bin/miniepd/get_doc?db=epd&format=html&entry=$EPD\">$EPD<\/a>\; $EPD_ID{$EPD}<\/td><\/tr>\n";
    }
}
print "\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n";
if (@EXP ne "")
{
    print"\n\t<tr>\n\t\t<td bgcolor\=\"\#66CC66\">\n\t\t\t<table cellpadding\=\"0\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td><font color\=\"\#FFFFFF\"><a name=\"exp\"></a><b>Expression Data References<\/b><\/font>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td>\n\t\t\t<table cellpadding\=\"1\" cellspacing\=\"1\" border\=\"0\" width\=\"100\%\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\">Dataset's Name\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\">Target ID\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\">Expression Data\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";
    foreach $DATA(@DATA)
    {
	if ($count{$DATA} > 0)
	{
	    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td valign\=\"top\" rowspan\=\"$count{$DATA}\" bgcolor\=\"\#FFFFCC\"><a href\=\"http://www.cleanex.isb-sib.ch/cgi-bin/get_doc?db=cleanex_ref&format=nice&entry\=$code{$DATA}\_DOC\">$DATA<\/a>";
	    if ($original_URLs{$DATA} ne "")
	    {
		print " (<a href\=\"$original_URLs{$DATA}\">Original web site<\/a>)";
	    }


	    if ($count{$DATA} > 1)
	    {
		print "<FORM METHOD=\"POST\" ACTION=\"http://www.cleanex.isb-sib.ch/cgi-bin/exp_query_result.pl\">\n";
		print "<INPUT TYPE=\"HIDDEN\" NAME=\"experiment\" VALUE=\"$code{$DATA}\">";
		print "<INPUT TYPE=\"HIDDEN\" NAME=\"gene\" VALUE=\"$GENE\">";
		print "<INPUT TYPE=\"HIDDEN\" NAME=\"desc\" VALUE=\"$DE\">";
		print "<INPUT TYPE=\"HIDDEN\" NAME=\"org\" VALUE=\"$ORG\">";

		print "<INPUT type=\"submit\" value=\"View all $DATA experiments\">\n<\/FORM>\n";
	    }
	    print "\n\t\t\t\t\t<\/td>";
	    foreach $EXP(@EXP)
	    {
		if ($EXP_TYPE{$EXP} eq $DATA)
		{
		    if ($exp_code{$DATA} eq "yes")
		    {
			print"\n\t\t\t\t<tr>\n\t\t\t\t\t<td valign\=top bgcolor\=\"\#FFFFCC\"><a href\=\"$EXP_URL{$EXP}$EXP_TRG{$EXP}\">$new_trg{$EXP}<\/a>\n\t\t\t\t\t\<\/td>\n\t\t\t\t\t\<td valign\=top bgcolor\=\"\#FFFFCC\">$EXP  [<a href\=\"http://www.cleanex.isb-sib.ch/cgi-bin/get_doc?db=cleanex_ref&format=text&entry=$EXP\">Entry \(text\)<\/a>";
		    }
		    else
		    {
			print"\n\t\t\t\t\t<td valign\=top bgcolor\=\"\#FFFFCC\"><a href\=\"$EXP_URL{$EXP}$EXP_TRG{$EXP}\">$new_trg{$EXP}<\/a>\n\t\t\t\t\t\<\/td>\n\t\t\t\t\t\<td valign\=top bgcolor\=\"\#FFFFCC\">$EXP  [<a href\=\"http://www.cleanex.isb-sib.ch/cgi-bin/get_doc?db=cleanex_ref&format=text&entry=$EXP\">Entry \(text\)<\/a>";
			$exp_code{$DATA}="yes";
		    }
		    if ($EXT_URLs{$EXP_TYPE{$EXP}} ne "")
		    {
			if ($DATA eq "SERUM1")
			{
			    print " \/ <a href=\"$EXT_URLs{$EXP_TYPE{$EXP}}$EXP_TRG{$EXP}&-find\=\">Original viewer</a>";
			}
			else
			{
			    print " \/ <a href=\"$EXT_URLs{$EXP_TYPE{$EXP}}$EXP_CLONE{$EXP}\">Original viewer</a>";
			}
		    }
		    #else
		    #{
			print" \/ <a href=\"http://www.cleanex.isb-sib.ch/cgi-bin/get_doc?db=cleanex_ref&format=html&entry=$EXP\" >Local viewer</a>]\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n";
		    #}
		}
	    }
	}
    }
    print "\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>";
    if (@RNA ne "")
{
    $rna_number=scalar(@RNA);
    print"\n\t<tr>\n\t\t<td bgcolor\=\"\#66CC66\">\n\t\t\t<table cellpadding\=\"0\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td><font color\=\"\#FFFFFF\"><a name=\"RNA\"></a><b>RNA sequences according to Unigene available on $date<\/b><\/font>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td>\n\t\t\t<table cellpadding\=\"1\" cellspacing\=\"1\" border\=\"0\" width\=\"100\%\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td valign\=\"center\" rowspan\=\"$rna_number\" bgcolor\=\"\#FFFFCC\" width=\"20%\">EMBL\n\t\t\t\t\t<\/td>";
    foreach $RNA(@RNA)
    {
	    print"\n\t\t\t\t\t<td width=\"100%\" bgcolor\=\"\#FFFFCC\">$RNA\; $RNA_ID{$RNA}\. [<a href\=\"http\:\/\/www\.ebi\.ac\.uk\/htbin\/emblfetch\?$RNA_AC{$RNA}\">EMBL<\/a> \/ <a href=\"http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?db=Nucleotide&cmd=Search&term=$RNA_AC{$RNA}&doptcmdl=GenBank\">GenBank</a> \/ <a href=\"http://getentry.ddbj.nig.ac.jp/cgi-bin/get_entry.pl?$RNA_AC{$RNA}\" >DDBJ</a>]\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n";
    }
    print "\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>";

}
}

print "\n<\/table><\/td>\n<\/tr>\n";
print "\n<\/td>\n<\/tr>\n";
print "<\/table><\/td><\/tr>";
print "<\/table>";#<\/body><\/html>";
}

sub printHTMLHeader
  {
    print "<HTML><HEAD><TITLE>EPDEX-$record</TITLE></HEAD><BODY bgcolor\=\"FFFFFF\">";
    print "<H2>EPDEX - NICE Format</H2><HR>";
}

sub extract_dataset_list {
    open('DATASET',"/db/CleanEx/Refs/flatdata/dataset_list.txt");
    while (<DATASET>)
    {
	chomp;
	@fields=split/ /,$_;
	$dataset=$fields[1];
	$code{$dataset}=$fields[0];
	push(@DATA,$dataset);
    }
    close (DATASET);
}



