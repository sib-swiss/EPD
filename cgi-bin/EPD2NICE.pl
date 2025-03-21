#!/usr/bin/env perl

# converts an EPD record from text to NICE View.

# these environment variables are specified either in the apache config file /etc/httpd/conf/httpd.conf
#$R_BioC_INSTALL_PATH = "/mnt/common/R-BioC/install/Linux/x86_64/R-2.8.0";
#$ENV{'PATH'} .= ":$R_BioC_INSTALL_PATH/bin";
#$ENV{'LD_LIBRARY_PATH'} .= ":$R_BioC_INSTALL_PATH/lib64/R/lib:$R_BioC_INSTALL_PATH/lib64/R/library/RSPerl/libs";
#$ENV{'PERL5LIB'} .= ":$R_BioC_INSTALL_PATH/lib64/R/library/RSPerl/perl";
#$ENV{'R_HOME'} = "$R_BioC_INSTALL_PATH/lib64/R";

#use CGI::Carp qw(fatalsToBrowser);
use FindBin qw( $RealBin );
use lib $RealBin;
use links;   # URLs of database access sites; variables: (%URLs %BEDE %BEDU %BEDP %ENSEMBL %UCSC %PlantGDB %Gramene %taxID)
use IPC::Open2;
use Sys::Hostname;
#use CGI;

#use R;
#use RReferences;

#use Statistics::R;

##machine-depended
if (hostname =~ /ccg-serv/ || hostname =~ /epdnew/ ){
    #$bin="/mnt/local/bin";
    $DATA="/home/local";
    #$DB="/home/local/db"; # eventually create local copy of EPD ?
    #$DB="/db";
    $DB="/local/ftp";
    $epd2fasta = ' EPDtoFA';
    $epd2embl = ' FROMFPS';
    # path to frozen, synchronized EMBL subset used for sequence extraction, still required???
    $ENV{'SSA2DBC'} = "/usr/local/EPD_web.git/htdocs/ssa/data/SSA2DBC.def"; # code changed
    $WWWTmpDir = '/tmp';
    #  $LOGDir = '../htdocs/logs/';
}
elsif (hostname eq ""){
    #$bin="";
    $DATA="/scratch/frt";
    $DB="/db";
    $epd2fasta = ' /home/vital-it/gambrosi/ssa/linux/EPDtoFA';
    $epd2embl = ' /home/vital-it/gambrosi/ssa/linux/FROMFPS';
    $ENV{'SSA2DBC'} = "/usr/local/EPD_web.git/htdocs/ssa/data/SSA2DBC.def"; # code changed
    $WWWTmpDir = '/tmp';
}

my $fetchCommand = "/usr/local/bin/fetch -c ../etc/fetch.conf";




#&R::setDebug(0);
#&R::initR('--no-save','--silent');
#&R::library('RSPerl');

if ($#ARGV == 0) {
    # command-line style
    $record = $ARGV[0];
} else {
    # CGI-style
    $record = $ENV{'QUERY_STRING'};
}
if ($record =~/__/)
{
    @REC=split/__/,$record;
    #    $entry_number=scalar(@REC);
    foreach $REC(@REC)
    {
        if ($REC ne "")
        {
            $rec.="epd:".$REC." ";
        }
    }
}
else
{
    $rec="epd:".$record;
}
#$entry_number=0;

$j = $$;

$/ = "//\n";

#open(LOG, ">>$LOGDir/epd2nice.log") or die("Could not open epd2nice.log $rec: $!");
#$currentTime = localtime;
#print LOG "$currentTime\t$ENV{'REMOTE_ADDR'}\t$ENV{'HTTP_USER_AGENT'}\t$rec\n";
#close(LOG);

# extract entry $rec from epd database using fetch
open (RECORD, "$fetchCommand $rec|") or die("Could not open $fetchCommand $rec: $!");
while (<RECORD>)
{
    $embl_refs = 0;
    $refs ="";
    $old_ref="";
    @EMBL=();
    @IF=();
    @EPD=();
    $TRANSCR="";
    @ENS=();
    $SPT="";
    @NP=();
    $CLEANEX="";
    @TRANSFAC=();
    @RS_AC=();
    $ME="";
    @TX=();
    @KW=();
    @DE=();
    @HG=();
    $AP="";
    $count=0;
    @IF = ();
    @SP=();
    #    $subset=2;
    my @a = split /^/;
    @FL=();
    #$entry_number++;
    my ($chro, $gpos);

    #First part put the lines in arrays

    foreach (@a)
    {

        if (/^ID   /)
        {
            /^ID   ([^\_]+)(\_\S+\_?\S?)\s+([^;]+);\s([^;]+);\s([^\.]+)/;
            $orgID=$1;
            $ID = $1.$2;
            $job=$j."_".$ID;
            $type = $3;
            $site_type = $4;
            $taxo = $5;
        }
        elsif (/^AC   /)
        {
            /^AC   (EP\d{5});/;
            $AC = $1;
        }
        elsif (/^DT   [^,]+, created/)
        {
            /^DT   (\S{2}-\S{3}-\d{4})\s\((Rel\.\s\d+)(.*)/;
            $date_c = $1;
            $rel_c = $2;
        }
        elsif (/^DT   [^,]+, Last/)
        {
            /^DT   (\S{2}-\S{3}-\d{4})\s\((Rel\.\s\d+)(.*)/;
            $date_a = $1;
            $rel_a = $2;
        }
        elsif (/^DE   /)
        {
            s/(\DE   )(.*)\n/$2/;
            push (@DE, $_);
        }
        elsif (/^OS   /)
        {
            if (/^OS   (.+) (\([^\)]+\))\.$/)
            {
                #/^OS   (.+) (\([^\.]+)/;
                $OS1 = $1;
                $OS2 = $2;
            }
            elsif  (/^OS   ([^\.]+)\.$/)
            {
                $OS1 = $1;
                $OS2 = "";
            }

        }
        elsif (/^HG   /)
        {
            s/(\HG   )(.*)\n/$2/;
            push (@HG, $_);
        }
        elsif (/^AP   (.*)/)
        {
            $AP=$1;
        }
        elsif (/^NP   /)
        {
            if (/^NP   (Neighbouring Promoter\; )([^\;]+)\; (.*)/)
            {
                $np=$3;
                $NP_AC{$np}=$2;
            }
            else
            {
                $np="none";
            }
            push (@NP, $np);
        }

        elsif (/^DR   EPD\; ([^\;]+)\; ([^\;]+)\; ([^\.]+)/)
        {
            push (@EPD, $1);
            $epd_id{$1}=$2;
            $epd_desc{$1}=$3;
        }

        elsif (/^DR   CLEANEX\; ([^\.]+)/)
        {
            $CLEANEX=$1;
        }
        elsif (/^DR   EMBL\; ([^\;]+)\; ([^\.]+)/)
        {
            push (@EMBL, $1);
            $embl_pos{$1}=$2;
        }
        elsif (/^DR   GENOME\; ([^\;]+)\; ([^\;]+)\; ([^\.]+)/)
        {
            $GE_SV=$1;
            $GE_AC=$2;
            $GE_POS=$3;
        }
        elsif (/^DR   SWISS-PROT/)
        {
            /^DR   SWISS-PROT\; ([^\;]+)\; ([^\.]+)/;
            push (@SP,$1);
            $SP_ID{$1}=$2;
        }
        elsif (/^DR   RefSeq/)
        {
            /^DR   RefSeq\; ([^\.]+)/;
            push (@RS_AC,$1);
        }
        elsif (/^DR   TRANSCRIPTOME\; ([^\.]+)/)
        {
            $TRANSCR=$1;
        }
        elsif (/^DR   ENSEMBL\; ([^\.]+)/)
        {
            push(@ENS,$1);
        }
        elsif (/^DR   TRANSFAC\; ([^\;]+)\; ([^\;]+)\; ([^\.]+)/)
        {
            push (@TRANSFAC, $1);
            $TF_ID{$1}=$2;
            $TF_desc{$1}=$3;
        }
        elsif (/^DR   MIM/)
        {
            /^DR   MIM\; ([^\.]+)/;
            $MIM_AC=$1;
        }
        elsif (/^DR   SPTREMBL\; ([^\.]+)/)
        {
            $SPT=$1;
        }
        elsif (/^DR   FLYBASE/)
        {
            /^DR   FLYBASE\; ([^\;]+)\; ([^\.]+)/;
            $FB_AC=$1;
            $FB_ID=$2;
        }
        elsif (/^DR   MGD/)
        {
            /^DR   MGD\; ([^\;]+)\; ([^\.]+)/;
            $MGD_AC=$1;
            $MGD_ID=$2;
        }

        elsif (/R[NXATL]   /)

        {
            s/(R[NXATL]   )(.*)(\n)/$1$2/m;
            $refs="$old_ref|$_";
            $old_ref=$refs;
        }

        elsif (/^ME   /)
        {
            s/(\s?ME   )(.*)\n/$2/;
            $ME=$ME." ".$_;
        }
        elsif (/^SE   /)
        {
            /^SE   (.*)/;
            $SE1 = substr($1,0,49);
            $SE2 = substr($1,49,11);
        }
        elsif (/^FL   \s+(.+)/)
        {
            @FL=split(/\s+/,$1);
            $count=scalar(@FL);
            # $FL=$1;
            # $count=1;
            # if (/BDGP/){
            #     subset=1;
            # }
        }
        elsif (/^IF   ([\+\-\s]\d+)\s+[ACGTN]\s{4}(\d*)\s*(\d*)\s*(\d*)\s*(\d*)/)
        {
            $pos=$1;
            $first_set=$2;
            $second_set=$3;
            $third_set=$4;
            $fourth_set=$5;
            open(DAT, ">> $WWWTmpDir/$AC\_epd_nice$job.dat")  or die "cannot write to $WWWTmpDir/$AC\_epd_nice$job.dat: $!\n";
            print DAT"$pos\t$first_set\t$second_set\t$third_set\t$fourth_set\n";
            close(DAT);
        }

        elsif (/^TX   /)
        {
            s/(TX   )(.*)\n/$2/;
            push (@TX, $_);
        }
        elsif (/^KW   /)
        {
            s/(KW   )(.*)\n/$2/;
            push (@KW, $_);
        }
        elsif (/^DO\s+Expr/)
        {
            /^DO\s+(.*)/;
            $DO2 = $1;
        }
    }
    $np_number=scalar(@NP);
    #*********************BEGIN PRINTING******************#


    print"<ul><li><a name=\"$ID\"></a> <big> <b> <a href\=\"/cgi-bin/miniepd/get_doc?db=epd&amp;format=html&amp;entry=$ID\">$ID</a>:  </b> </big>";
    print"[<a href=\"\#general$ID\">General</a>]\n[<a href=\"\#x-ref$ID\">Cross-references</a>]\n[<a href=\"\#prom$ID\">Promoter_specific info</a>]\n[<a href=\"\#ends$ID\">5'Ends distribution</a>]</li></ul>";


    #*****************ID LINE (& Co...)******************#

    print"<table cellpadding\=\"0\" cellspacing\=\"0\" bgcolor\=\"\#66CC66\" width\=\"100\%\">\n\t<tr>\n\t\t<td bgcolor\=\"\#66CC66\">\n\t\t\t<table cellpadding\=\"0\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td><font color\=\"\#FFFFFF\"><a name=\"general$ID\"></a><b>General information about the entry<\/b><\/font>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td bgcolor\=\"\#66CC66\">\n\t\t\t<table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\" nowrap\=\"nowrap\"  width=\"20%\">Entry name\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\" width\=\"100\%\"><b>$ID<\/b>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";
    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Entry type\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">$type\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";
    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Promoter type\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">$site_type\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";

    #*****************AC LINE******************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\" nowrap\=\"nowrap\"  width=\"20%\">Accession number\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\" width\=\"100\%\"><b>$AC<\/b>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";



    #*****************DE LINE******************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td valign\=\"top\"bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Description of the gene\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">@DE\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";

    #******************DT LINES******************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td valign\=\"top\"bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Creation date\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">$date_c ($rel_c)\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td valign\=\"top\"bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Last annotation\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">$date_a ($rel_a)\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";

    #*****************OS LINE******************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Taxonomic division\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">$taxo\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td valign\=\"top\"bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Organism\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\"><a href=\"$URLs{TAXONOMY}$OS1\">$OS1<\/a> $OS2\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";

    #*****************KW LINES******************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Keywords\n\t\t\t\t\t<\/td>\n";

    print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">@KW\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";

    print"\n\t\t\t<\/table>\t\t<\/td>\n\t<\/tr>\n";


    ##*****************Similarity LINES******************#

    print"\t<tr>\t\t<td bgcolor\=\"\#66CC66\">\t\t\t<table cellpadding\=\"0\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td><font color\=\"\#FFFFFF\"><a name=\"sim\"></a><b>Similarities with other entries<\/b><\/font>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td bgcolor\=\"\#66CC66\">\n\t\t\t<table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";

    ##*****************HG LINE******************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Homology group\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">@HG\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";

    ##*****************AP LINES******************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Alternative promoter\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">$AP\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";

    ##*****************NP LINES******************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td rowspan=$np_number bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20%\">Neighbouring promoter(s)\n\t\t\t\t\t<\/td>\n";
    foreach $NP(@NP)
    {
        if ($NP ne "none")
        {
            print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\"><a href=\"$URLs{EPD}$NP_AC{$NP}\">$NP_AC{$NP}<\/a>\; $NP\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";
        }
        else
        {
            print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\">none.\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";
        }
    }

    print"\n\t\t\t<\/table>\t\t<\/td>\n\t<\/tr>\n";

    ##*****************Cross-ref LINES******************#

    print"\t<tr>\t\t<td bgcolor\=\"\#66CC66\">\t\t\t<table cellpadding\=\"0\">\n\t\t\t\t
    <tr>\n\t\t\t\t\t<td><font color\=\"\#FFFFFF\"><a name=\"x-ref$ID\"></a><b>Cross References<\/b><\/font>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td bgcolor\=\"\#66CC66\">\n\t\t\t<table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";

    #*****************GENOME LINE******************


    if ($GE_SV ne ""){
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">GENOME\n\t\t\t\t\t<\/td>\n";

        # determine if link to NCBI Genome Map possible
        if ($taxID{$OS1}){
            # determine latest BED file for this organism
            open(BED, "ls -t ../htdocs/ftp/epd/BED | grep $assemb{$OS1} |") or warn ("error determining BED: $!\n");
            #print "ls -t ../htdocs/ftp/epd/BED | grep $assemb{$OS1} |";
            my $BED=<BED>;
            close(BED);
            my $nBED=(split(/\n/,$BED))[0];
            #print "my bed = $nBED";
            if ($nBED ne ''){
                # grep BED file to determine position
                open(POS, "grep \$\'\t$ID\t\' ../htdocs/ftp/epd/BED/$nBED |") or warn ("error opening grep: $!\n");
                #print "grep \$\'\t$ID\t\' ../htdocs/ftp/epd/BED/$nBED |";
                my $test=<POS>;
                close(POS);
                if ((split(/\n/,$test))[0]){
                    if ((split(/\n/,$test))[0]=~ (/chr([0-9YXLRIV]+)\t(\d+)\t/)){
                        $chro=$1;
                        $gpos=$2;
                        print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" wrap=\"nowrap\" width=\"fixed\"><a href\=\"https://www.ncbi.nlm.nih.gov/mapview/maps.cgi?taxid=",$taxID{$OS1},"&amp;CHR=$chro&amp;BEG=",$gpos-10000,"&amp;END=",$gpos+10000,"&amp;thmb=on\">$GE_SV<\/a>\n\t\t\t\t\t<\/td>\n<td bgcolor\=\"\#FFFFCC\" wrap=\"nowrap\">$GE_POS\n<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" wrap=\"nowrap\">";
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
            ALT:	    print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\"><a href=\"$URLs{GENOME}$GE_SV\">$GE_SV<\/a>\n\t\t\t\t\t<\/td>\n<td bgcolor\=\"\#FFFFCC\">$GE_POS\n<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\">";
        }
        # determine if links to Genome Browsers possible
        if ($ENSEMBL{$OS1}){
            open(POS, "grep \$\'\t$ID\t\' ../htdocs/ftp/epd/BED/$BEDE{$OS1} |") or warn ("error opening grep: $!\n");
            #print "grep \$\'\t$ID\t\' ../htdocs/ftp/epd/BED/$BEDE{$OS1}";
            my $test=<POS>;
            close(POS);
            if ((split(/\n/,$test))[0]){
                if ((split(/\n/,$test))[0]=~ (/chr([0-9YXLRIV]+)\t(\d+)\t/)){
                    $chro=$1;
                    $gpos=$2;
                    print "ENSEMBL <a href\=\"",$ENSEMBL{$OS1},"?h=URL:https://epd.expasy.org/ftp/epd/BED/";
                    print $BEDE{$OS1};
                    print ";chr=$chro&amp;region=&amp;start=",$gpos-200,"&amp;end=",$gpos+200,"\">ContigView<\/a>\n ";
                }
            }
        }
        if ($UCSC{$OS1}){
            open(POS, "grep \$\'\t$ID\t\' ../htdocs/ftp/epd/BED/$BEDU{$OS1} |") or warn ("error opening grep: $!\n");
            my $test=<POS>;
            close(POS);
            if ((split(/\n/,$test))[0]){
                if ((split(/\n/,$test))[0]=~ (/chr([0-9YXLRIV]+)\t(\d+)\t/)){
                    $chro=$1;
                    $gpos=$2;
                    print "<br>UCSC <a href\=\"",$UCSC{$OS1},"&position=chr$chro:",$gpos-200,"-",$gpos+200,"&amp;hgt.customText=https://epd.expasy.org/ftp/epd/BED/";
                    print $BEDU{$OS1};
                    print "&ct_TSSinEPD=full\">Genome Browser<\/a>\n ";
                }
            }
        }
        if ($PlantGDB{$OS1}){
            open(POS, "grep \$\'\t$ID\t\' ../htdocs/ftp/epd/BED/$BEDP{$OS1} |") or warn ("error opening grep: $!\n");
            my $test=<POS>;
            close(POS);
            if ((split(/\n/,$test))[0]){
                if ((split(/\n/,$test))[0]=~ (/chr([0-9YXLRIV]+)\t(\d+)\t/)){
                    $chro=$1;
                    $gpos=$2;
                    print "<a href\=\"",$PlantGDB{$OS1},"&chr=$chro\&l_pos=",$gpos-200,"&r_pos=",$gpos+200,"\">PlantGDB<\/a>  <a href\=\"",$Gramene{$OS1},"chr=$chro\&vc_start=",$gpos-200,"&vc_end=",$gpos+200,"\">Gramene<\/a>";
                }
            }
        }





        if ($OS1 eq 'Homo sapiens') {
            ## grep old BED file to determine position +/-200bp  # remove once HapMap updated to NCBI36
            # open(POS, "grep \$\'\t$ID\t\' ../htdocs/ftp/epd/BED/$BEDP{$OS1} |") or warn ("error opening epd85_HS_NCBI35.BED: $!\n");
            # my $test=<POS>;
            # close(POS);
            # my ($chro, $gpos);
            # if ((split(/\n/,$test))[0]){
            #    if ((split(/\n/,$test))[0]=~ (/chr([0-9YXLR]+)\t(\d+)\t/)){
            #        $chro=$1;
            #        $gpos=$2;
            #    }
            # }
            my ($URL) = $URLs{HapMap};
            my $start=$gpos-200;
            my $stop=$gpos+200;
            $URL=~ s/name=xx/name=chr$chro:$start..$stop/;
            print "<br><a href\=\"$URL \">HapMap<\/a> ";

        }
        print "\n\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n";
    }

    $GE_AC="";
    $GE_SV="";
    $GE_POS="";


    ##*****************EPD Refs******************#

    $epd_number=scalar(@EPD);
    if ($EPD[0] ne "")
    {
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td rowspan=$epd_number bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">EPD\n\t\t\t\t\t<\/td>\n";
        foreach $EPD(@EPD)
        {
            print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\"><a href=\"$URLs{EPD}$EPD\">$EPD<\/a>\n\t\t\t\t\t<\/td>\n<td bgcolor\=\"\#FFFFCC\">$epd_id{$EPD}\n\t\t\t\t\t<\/td>\n<td bgcolor\=\"\#FFFFCC\">$epd_desc{$EPD}\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n";
        }
        $epd_number=0;
    }

    #*****************CLEANEX LINE******************

    if ($CLEANEX ne "")
    {
        print "\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">CLEANEX\n\t\t\t\t\t<\/td>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" width\=\"100\%\" colspan=3><a href=\"$URLs{CLEANEX}$CLEANEX\">$CLEANEX<\/a>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>";
    }

    #*****************EMBL LINES******************

    $embl_refs = scalar(@EMBL);

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td rowspan=$embl_refs bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">DNA References\n\t\t\t\t\t<\/td>\n";
    foreach $EMBL(@EMBL)
    {
        $ac=(split/\./,$EMBL)[0];
        print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\" width=\"30\%\">$EMBL \n\t\t\t\t\t<\/td>\n
        <td bgcolor\=\"\#FFFFCC\">$embl_pos{$EMBL}\n\t\t\t\t\t<\/td>\n
        <td bgcolor\=\"\#FFFFCC\">
        <a href='https://www.ebi.ac.uk/ena/data/view/$ac'>ENA<\/a>
        <a href=\"$URLs{GenBank}$EMBL\">GenBank<\/a>
        <a href=\"$URLs{DDBJ}$ac\">DDBJ<\/a>
        <\/td> \n\t\t\t\t<\/tr>\n";
    }

    $embl_refs = 0;

    #*****************Swiss-Prot Refs******************#

    $sp_number=scalar(@SP);
    if ($SP[0] ne "")
    {
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td rowspan=$sp_number bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">SWISSPROT\n\t\t\t\t\t<\/td>\n";
        foreach $SP(@SP)
        {
            print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\"><a href=\"$URLs{'SWISS-PROT'}$SP\">$SP<\/a>\n\t\t\t\t\t<\/td>\n<td colspan=2 bgcolor\=\"\#FFFFCC\">$SP_ID{$SP}\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n";
        }
        $sp_number=0;
    }

    #*****************TRANSFAC LINES******************

    if ($TRANSFAC[0] ne "")
    {
        $tf_refs = scalar(@TRANSFAC);
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td rowspan=$tf_refs bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">TRANSFAC\n\t\t\t\t\t<\/td>\n";
        foreach $TRANSFAC(@TRANSFAC)
        {
            print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\"><a href=\"$URLs{TRANSFAC}$TRANSFAC\">$TRANSFAC<\/a>\n\t\t\t\t\t<\/td>\n<td bgcolor\=\"\#FFFFCC\">$TF_ID{$TRANSFAC}\n\t\t\t\t\t<\/td>\n<td bgcolor\=\"\#FFFFCC\">$TF_desc{$TRANSFAC}\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n";
        }
    }
    $tf_refs = 0;
    @TRANSFAC=();


    #*****************RefSeq LINE******************

    if ($RS_AC[0] ne "")
    {
        $tf_refs = scalar(@RS_AC);
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td rowspan=$tf_refs bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">REFSEQ\n\t\t\t\t\t<\/td>\n";
        foreach $RS_AC(@RS_AC)
        {
            print "\t\t\t\t\t<td colspan=3 bgcolor\=\"\#FFFFCC\"><a href=\"$URLs{RefSeq}$RS_AC\">$RS_AC<\/a>\n";
            if ($orgID eq 'HS'){
                my ($URL) = $URLs{DBTSS};
                print " \[ <a href\=\"$URL$RS_AC\">DBTSS<\/a> \]";
            }
            print "<\/td>\n\t\t\t\t<\/tr>\n";
        }
    }
    $tf_refs = 0;
    @RS_AC=();

    #*****************TRANSCRIPTOME LINE******************

    if ($TRANSCR ne "")
    {
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">TRANSCRIPTOME\n\t\t\t\t\t<\/td>\n";
        print "\t\t\t\t\t<td  colspan=3 bgcolor\=\"\#FFFFCC\"><a href=\"$URLs{TRANSCRIPTOME}$TRANSCR\">$TRANSCR<\/a>\n<\/td>\n\t\t\t\t<\/tr>\n";
    }

    $TRANSCR="";

    #*****************FLYBASE LINE******************


    if ($FB_AC ne "")

    {
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">FLYBASE\n\t\t\t\t\t<\/td>\n";
        print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\"><a href=\"$URLs{FLYBASE}start=",$gpos-500,";stop=",$gpos+500,";ref=$chro \">$FB_AC<\/a>\n\t\t\t\t\t<\/td>\n<td  colspan=2 bgcolor\=\"\#FFFFCC\">$FB_ID\n<\/td>\n\t\t\t\t<\/tr>\n";
    }

    $FB_AC="";
    $FB_ID="";

    #*****************MGD LINE******************


    if ($MGD_AC ne "")

    {
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">MGD\n\t\t\t\t\t<\/td>\n";
        print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\"><a href=\"$URLs{MGD}$MGD_AC\">$MGD_AC<\/a>\n\t\t\t\t\t<\/td>\n<td  colspan=2 bgcolor\=\"\#FFFFCC\">$MGD_ID\n<\/td>\n\t\t\t\t<\/tr>\n";
    }

    $MGD_AC="";
    $MGD_ID="";

    #*****************MIM LINE******************


    if ($MIM_AC ne "")

    {
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\">MIM\n\t\t\t\t\t<\/td>\n";
        print "\t\t\t\t\t<td  colspan=3 bgcolor\=\"\#FFFFCC\"><a href=\"$URLs{MIM}$MIM_AC\">$MIM_AC<\/a>\n<\/td>\n\t\t\t\t<\/tr>\n";
    }

    $MIM_AC="";


    print"\n\t\t\t<\/table>\t\t<\/td>\n\t<\/tr>\n";

    ##*****************REFERENCE LINES******************#

    print"\t<tr>\t\t<td bgcolor\=\"\#66CC66\">\t\t\t<table cellpadding\=\"0\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td><font color\=\"\#FFFFFF\"><a name=\"sim\"></a><b>References<\/b><\/font>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td bgcolor\=\"\#FFE87C\">\n\t\t\t<table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";


    @one_ref=split /\s?RN   /, $refs;

    $refs_number=scalar(@one_ref);
    for ($i=1;$i<$refs_number;$i++)
    {
        @ref_lines=split /\|/, $one_ref[$i];
        foreach $ref_line (@ref_lines)
        {
            if ($ref_line =~ /^RX   ([^\;]+; )([^\.]+)/)
            {
                $medline=$2;
            }
            elsif ($ref_line =~ /^RA   (.*)/)
            {
                $ra=$1;
                $ra=~s/\;//;
                push(@RA,$ra);
            }
            elsif ($ref_line =~ /^RT   (.*)/)
            {
                $rt=$1;
                $rt=~s/\;|\n//;
                push(@RT,$rt);
            }
            elsif ($ref_line =~ /^RL   (.*)/)
            {
                $RL=$1;
            }
        }
        print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\" valign=center>\[$i\]\n\t\t\t\t\t<\/td>\n";
        print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\">MEDLINE=<a href=\"$URLs{MEDLINE}$medline\">$medline<\/a><br>@RA<br>@RT<br>\n$RL<\/td>\n\t\t\t\t<\/tr>\n";
        @RA=();
        @RT=();
        $RL="";
        $medline="";
    }
    $old_ref="";


    print"\n\t\t\t<\/table>\t\t<\/td>\n\t<\/tr>\n";

    #****Promoter-specific information*****#

    print"\t<tr>\t\t<td bgcolor\=\"\#66CC66\">\t\t\t<table cellpadding\=\"0\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td><font color\=\"\#FFFFFF\"><a name=\"prom$ID\"></a><b>Promoter-specific information<\/b><\/font>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td bgcolor\=\"\#66CC66\">\n\t\t\t<table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";
    #************SE line*************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#CCFF66\" nowrap\=\"nowrap\"  width=\"20\%\" valign=center>Sequence\n\t\t\t\t\t<\/td>\n";

    print "\t\t\t\t\t<td bgcolor\=\"\#CCFF66\"><tt>$SE1<b>$SE2<\/b><\/tt><\/td>\n\t\t\t\t<\/tr>\n";

    #*****************ME LINES******************#

    @METH=split/\. /,$ME;
    $me_refs = scalar(@METH);

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td rowspan=$me_refs bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\" valign=center>Method(s)\n\t\t\t\t\t<\/td>\n";

    foreach $METH(@METH)
    {
        print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\">$METH<\/td>\n\t\t\t\t<\/tr>\n";
    }
    $ME="";
    @METH=();
    $me_refs = 0;



    #*****************TX LINES******************#
    $tx_refs = scalar(@TX);

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td rowspan=$tx_refs bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\" valign=center>Taxonomy\n\t\t\t\t\t<\/td>\n";
    foreach $TX(@TX)
    {
        print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\">$TX<\/td>\n\t\t\t\t<\/tr>\n";
    }
    $tx_refs = 0;
    @TX=();

    #*****************DO2 LINE******************#

    print "\n\t\t\t\t<tr>\n\t\t\t\t\t<td rowspan=$tx_refs bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"  width=\"20\%\" valign=center>Supplementary information\n\t\t\t\t\t<\/td>\n";

    print "\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\">$DO2<\/td>\n\t\t\t\t<\/tr>\n";

    #*****************IF LINES******************#

    #    if ($count > 0)
    #    {

    print"\n\t\t\t<\/table>\t\t<\/td>\n\t<\/tr>\n";
    print"\t<tr>\t\t<td bgcolor\=\"\#66CC66\">\t\t\t<table cellpadding\=\"0\">\n\t\t\t\t<tr>\n\t\t\t\t\t<td><font color\=\"\#FFFFFF\"><a name=\"ends$ID\"></a><b>5-prime end distribution<\/b><\/font>\n\t\t\t\t\t<\/td>\n\t\t\t\t<\/tr>\n\t\t\t<\/table>\n\t\t<\/td>\n\t<\/tr>\n\t<tr>\n\t\t<td bgcolor\=\"\#FFE87C\">\n\t\t\t<table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";

    if ($count > 0)
    {

        open(SEQ, "fetch -c ../etc/fetch.conf -w 101 epdseq:$AC\[450..550\] |"); #or print R1 "cannot open epdseq fetch: $!\n";
        while(<SEQ>){
            ($seq)=(/([ACGTN]{101})/);
        }
        close(SEQ);
        $FL = join("\"\,\"", @FL);

        open(my $RFILE, '>', "$WWWTmpDir/epd_nice$job.R");
        print {$RFILE} "bitmap(\"$WWWTmpDir/epd_nice$job.png\",type=\"png16\",width=9,height=6,res=80)
f <- as.matrix(read.table(\"$WWWTmpDir\/$AC\_epd_nice$job.dat\", fill=TRUE, sep = \"\\t\"))
f[is.na(f)] <- 0;
farb <- c(\"black\",\"red\",\"turquoise\",\"blueviolet\",\"seagreen3\");
meth <- c(\"Met\",\"$FL\");
num <- NULL;
for(i in 2:length(f[2,])){if(sum(as.matrix(f[,i]))!=0){num <- c(num,i)}};
par(lab=c(10,5,7));
ymax <- max(max(f[,2]/sum(f[,2])),max(f[,3]/sum(f[,3])),max(f[,4]/sum(f[,4])),max(f[,5]/sum(f[,5])), na.rm=TRUE);
plot(f[,1]-0.45+((2*1-1)/length(num)*0.45),f[,num[1]]/sum(f[,num[1]]),type=\"h\",lwd=4/length(num), xlim=c(-50,+50), ylim=c(0, ymax+0.03), cex.axis=1.2, xlab=\"Position of 5ends of transcripts\",ylab=\"fraction of transcripts\", col=farb[1]);
text(-45,ymax,labels=meth[num[1]],cex=1.2, col=farb[1]);
text(-35,ymax,labels=sum(f[,num[1]]),cex=1.2, col=farb[1]);
text(-25,ymax,labels=\"transcripts\",cex=1.2, col=farb[1]);
text(20,ymax,labels=\"promoter type: $site_type\",cex=1.2, col=farb[1]);
if (length(num)>1){for (i in 2:length(num)){text(-45,ymax-i*0.02,labels=meth[num[i]],cex=1.2, col=farb[i]);text(-35,ymax-i*0.02,labels=sum(f[,num[i]]),cex=1.2, col=farb[i]);text(-25,ymax-i*0.02,labels=\"transcripts\",cex=1.2, col=farb[i]);lines(f[,1]-0.45+((2*i-1)/length(num)*0.45),f[,num[i]]/sum(f[,num[i]]),type=\"h\",lwd=4/length(num), col=farb[i])}};
for (i in (-50):50){axis(1, at =i , labels = strsplit(\"$seq\", split=character(0))[[1]][i+51], line=-1,font =2, cex=1.2, tick = FALSE, col.axis=(strsplit(\"$seq\", split=character(0))[[1]][i+51]==\"T\")*2+(strsplit(\"$seq\", split=character(0))[[1]][i+51]==\"A\")*3+(strsplit(\"$seq\", split=character(0))[[1]][i+51]==\"C\")*4+(strsplit(\"$seq\", split=character(0))[[1]][i+51]==\"G\")*1)};
dev.off();
q()";
        close($RFILE);
        system("R --vanilla --quiet --slave --file=$WWWTmpDir/epd_nice$job.R >/dev/null");

        print "\t\t\t\t<tr>\n\t\t\t\t\t<td align=center bgcolor\=\"\#FFFFCC\" nowrap\=\"nowrap\"><a href=\"/miniepd/wwwtmp/epd_nice$job.png\"><IMG SRC=\"/miniepd/wwwtmp/epd_nice$job.png\"><\/a><\/td>\n\t\t\t\t<\/tr>";
    } else {
        print "\t\t\t\t<tr>\n\t\t\t\t\t<td bgcolor\=\"\#FFFFCC\"> No 5\' end distribution available<\/td>";
    }
    print "\n<\/table><\/td>\n<\/tr>\n";
    print "\n<\/td>\n<\/tr>\n";
    print "<\/table><\/td><\/tr><br><br>";

}

close(RECORD);

1;
