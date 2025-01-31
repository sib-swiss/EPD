#!/usr/bin/env perl

# -tj
# converts an EPD record from text to HTML.

use FindBin qw( $RealBin );
use lib "$RealBin";
use links;   # URLs of database access sites; variables: (%URLs %BEDE %BEDU  %BEDP %ENSEMBL %UCSC %PlantGDB %taxID)

$ENV{'PATH'} .= ":/usr/molbio/perl";

if ($#ARGV == 0) {
    # command-line style
    $record = $ARGV[0];
} else {
    # CGI-style
    $record = $ENV{'QUERY_STRING'};
}

$fetchCommand = "fetch -c ../etc/fetch.conf epd:$record";

# printHTMLHeader();

open (RECORD, "$fetchCommand |") or &HTMLError ("Could not open $record.");

print ("<PRE>");

my ($orgID,$gID,$chro,$gpos);
while (<RECORD>)
{
    if ( /^ID   ([^_]+)(\_\S+)(.*)/ )
    {
	$orgID=$1;
	$gID=$1.$2;
	$ID=$1.$2.$3;
	print "ID   $ID\n";

    }
    elsif ( /^(DR   [MS]|DR   ENSE|DR   TRANSC)/ )
    {
	my ($database) = /^DR   ([^;]+)/;
	my ($URL) = $URLs{$database};

	s/^(..   [^;]+; )([^;.]+)/$1<a href="$URL$2">$2<\/a>/;

	print;
    }
    elsif ( /^(DR   FLYBASE; ([^;.]+))/ )
    {
        print "DR   FLYBASE\ <a href=\"$URLs{FLYBASE}start=",$gpos-500,";stop=",$gpos+500,";ref
=$chro\">$2<\/a>\.\n";
    }
elsif (/^RX   MEDLINE/)
{
    /^RX   MEDLINE;\s+(\d+)/;
    $ac=$1;
    my ($URL) = $URLs{MEDLINE};
    print "RX   MEDLINE\; <a href\=\"$URL$ac&dopt=Citation\">$ac<\/a>\.\n";
}
elsif (/^DR   (TRANSFAC)/ )
{
    s/^(..   [^;]+; )([^;.]+)/$1<a href="$URLs{TRANSFAC}$2">$2<\/a>/;
    print;
}
elsif (/^DR   RefSeq/)
{
    /^DR   RefSeq;\s+(\w+_\d+)/;
    $ac=$1;
    print "DR   RefSeq\; <a href\=\"$URLs{RefSeq}$ac\">$ac<\/a>";
    if ($orgID eq 'HS'){
	my ($URL) = $URLs{DBTSS};
	print " \[ <a href\=\"$URL$ac\">DBTSS<\/a> \]";
    }
    print "\.\n";
}
elsif (/^DR   GENOME/)
{
    /^DR   GENOME;\s+([^;]+)(.*)/;
     my $sv = $1;
     my $ac = $sv;
     my $suite = $2;
     $ac =~ s/\.\d+//;

# determine if link to NCBI Genome Map possible
    if ($taxID{$OS1}){
# determine latest BED file for this organism (to retrieve chromosome number!)
	open(BED, "ls -t ../htdocs/ftp/epd/BED|grep $assemb{$OS1} |") or warn ("error determining BED: $!\n");
        my $BED=<BED>;
	close(BED);
        my $nBED=(split(/\n/,$BED))[0];
	if ($nBED ne ''){
# grep BED file to determine position
	    open(POS, "grep \'\t$gID\t\' ../htdocs/ftp/epd/BED/$nBED |") or warn ("error opening grep: $!\n");
	    my $test=<POS>;
	    close(POS);
	    if ((split(/\n/,$test))[0]){
		if ((split(/\n/,$test))[0]=~ (/chr([0-9YXLRIV]+)\t(\d+)\t/)){
		    $chro=$1;
		    $gpos=$2;
		    print "DR   GENOME\; <a href\=http://www.ncbi.nlm.nih.gov/mapview/maps.cgi?taxid=",$taxID{$OS1},"&amp;CHR=$chro&amp;BEG=",$gpos-10000,"&amp;END=",$gpos+10000,"&amp;thmb=on\">$sv<\/a>$suite [";
		}
		else{
		    goto ALT;
		}
	    }
	    else{
		goto ALT;
	    }
	}
	else{
	    goto ALT;
	}
    }
    else{
ALT:	print "DR   GENOME\; <a href\=\"$URLs{GENOME}$sv\">$sv<\/a>$suite [";
    }
# determine if links to Genome Browsers possible
    if ($ENSEMBL{$OS1}){
	open(POS, "grep \'\t$gID\t\' ../htdocs/ftp/epd/BED/$BEDE{$OS1} |") or warn ("error opening grep: $!\n");
	my @test=<POS>;
	close(POS);
	if ($test[0]){
	    if ($test[0]=~ (/chr([0-9YXLRIV]+)\t(\d+)\t/)){
		$chro=$1;
		$gpos=$2;
		print " <a href\=\"",$ENSEMBL{$OS1},"?h=URL:ftp://ftp.epd.unil.ch/epd/BED/";
		    print $BEDE{$OS1};
		print ";chr=$chro&region=&start=",$gpos-200,"&end=",$gpos+200,"\">ENSEMBL<\/a>; ";
	    }
	}
    }
    if ($UCSC{$OS1}){
	open(POS, "grep \'\t$gID\t\' ../htdocs/ftp/epd/BED/$BEDU{$OS1} |") or warn ("error opening grep: $!\n");
	my @test=<POS>;
	close(POS);
	if ($test[0]){
	    if ($test[0]=~ (/chr([0-9YXLRIV]+)\t(\d+)\t/)){
		$chro=$1;
		$gpos=$2;
# old		print " <a href\=\"",$UCSC{$OS1},"?h=URL:ftp://ftp.epd.unil.ch/epd/BED/";
		print " <a href\=\"",$UCSC{$OS1},"&position=chr$chro:",$gpos-200,"-",$gpos+200,"&hgt.customText=ftp://ftp.epd.unil.ch/epd/BED/";
		    print $BEDU{$OS1};
# old		print ";chr=$chro&region=&start=",$gpos-200,"&end=",$gpos+200,"\">UCSC<\/a>; ";
		print "&ct_TSSinEPD=full\">UCSC<\/a>; ";
	    }
	}
    }
    if ($PlantGDB{$OS1}){
        open(POS, "grep \'\t$gID\t\' ../htdocs/ftp/epd/BED/$BEDP{$OS1} |") or warn ("error opening grep: $!\n");
        my $test=<POS>;
	close(POS);
        if ((split(/\n/,$test))[0]){
	    if ((split(/\n/,$test))[0]=~ (/chr([0-9YXLRIV]+)\t(\d+)\t/)){
		$chro=$1;
                $gpos=$2;
		print "<a href\=\"",$PlantGDB{$OS1},"&chr=$chro\&l_pos=",$gpos-200,"&r_pos=",$gpos+200,"\">PlantGDB Genome Browser<\/a>";
       	    }
        }
    }
    if ($OS1 eq 'Homo sapiens') {
## grep old BED file to determine position +/-200bp  # remove once HapMap updated to NCBI36
#		open(POS, "grep \'\t$gID\t\' ../htdocs/ftp/epd/BED/epd85_HS_NCBI35.BED |") or warn ("error opening epd85_HS_NCBI35.BED: $!\n");
#		my @test=<POS>;
#		close(POS);
#		if ($test[0]){
#		    my ($chro, $gpos);
#		    if ($test[0]=~ (/chr([0-9YXLR]+)\t(\d+)\t/)){
#			$chro=$1;
#			$gpos=$2;
#		    }
#		}
	my ($URL) = $URLs{HapMap};
	my $start=$gpos-200;
	my $stop=$gpos+200;
	$URL=~ s/name=xx/name=chr$chro:$start..$stop/;
	print "<a href\=$URL >HapMap<\/a> ";

    }
    print "]\n";
}

elsif (/^DR   UNIGENE/)
{
    /^DR   UNIGENE;\s+([^\.]+)\.(\d+)/;
    $org=$1;
    $ac=$2;

    print "DR   UNIGENE\; <a href\=\"http://www.ncbi.nlm.nih.gov/cgi-bin/UniGene/clust.cgi?ORG=$org&CID=$ac\">$org\.$ac<\/a>\.\n";
}

elsif (/^DR   EMBL/) {

   /^DR   EMBL;\s+([^;]+)(.*)/;
   my $sv = $1;
   my $ac = $sv;
   my $suite = $2;
   $ac =~ s/\.\d+//;
   print "DR   EMBL; $sv$suite [ <a href=\"",$URLs{EMBL},"$ac\">EMBL<\/a>; <a href=\"",$URLs{GenBank},"$sv\">GenBank<\/a>; <a href=\"",$URLs{DDBJ},"$ac\">DDBJ<\/a> ]\n";
}

elsif (/^(DR   EPD;|NP)/) {
    my ($database) = 'EPD';
	my ($URL) = $URLs{$database};

	s/^(..   [^;]+; )([^;.]+)/$1<a href="$URL$2">$2<\/a>/;

	print;
}

elsif ( /^DR   CLEANEX/) {
    my ($database) = /^[DR][RX]   ([^;]+)/;
    my ($URL) = $URLs{$database};

    s/^(..   [^;]+; )([^\.]+)/$1<a href="$URL$2">$2<\/a>/;

    print;

} elsif ( /^OS/ ) {
    # CI link taxonomy
    /^OS\s+([^\(|^\.]+)(.*)/;
    $OS1 = $1;
    my $rest = $2;
    $OS1 =~ s/\s+$//;
    my $beast = $OS1;
    $beast =~ s/ /+/g;
    my $url = $URLs{'TAXONOMY'}."$beast&lvl=0&srchmode=1";
    print "OS   <a href=\"$url\">$OS1<\/a> $rest\n";

} elsif (/^DR   TIGR; (\w+)/) {
    print "DR   TIGR; <a href=\"",$URLs{'TIGR'},$1,";type=Contig+Genes+Rice_Annotation+rice_flcdna+TIGR_rice_ta\">$1<\/a>\.\n";

} else {				   # this was not a DR line...
    print;
}
}

print("</PRE>");

# printHTMLFooter();

sub printHTMLHeader
  {
    # leave this to the calling script
    # print "Content-type: text/html\n\n";
    print "<HTML><HEAD><TITLE>Profile search results</TITLE><HEAD><BODY>";
    print "<H2>EPD - New Format</H2><HR>";
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
