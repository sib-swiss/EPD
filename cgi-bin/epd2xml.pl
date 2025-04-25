#!/usr/bin/env perl

 # converts an EPD record from text to XML.

$ENV{'PATH'} .= ":/usr/molbio/perl";

if ($#ARGV == 0) {
    # command-line style
    $record = $ARGV[0];
} else {
    # CGI-style
    $record = $ENV{'QUERY_STRING'};
}

$fetchCommand = "fetch -c ../etc/fetch.conf epd:$record";

$/ = "//\n";

find_exp();
find_journal();

open (RECORD, "$fetchCommand |") or &HTMLError ("Could not open $record.");

while (<RECORD>)
{


%abbv = (
"Annu. Rev. Biochem. " => "ARB",
"Annu. Rev. Physiol. " => "ARP",
"Biochem. Biophys. Res. Commun. " => "BBRC",
"Biochem. J. " => "BchJ",
"Biochemistry " => "Bch",
"Biochim. Biophys. Acta " => "BBA",
"Biochimie " => "Bchi",
"Biol. Chem. Hoppe-Seyler " => "BCHS",
"Biotechnology " => "Btech",
"Br. J. Rheumatol. Suppl. " => "BrJR",
"Brain Res. " => "BrainR",
"Cancer Res. " => "CanR",
"Cell " => "Cell",
"Cell Growth Differ. " => "CGD",
"Chromosoma " => "Chrom",
"Cold Spring Harb. Symp. Quant. Biol. " => "CSHS",
"Curr. Genet. " => "CurG",
"Curr. Top. Microbiol. Immunol. " => "CTMI",
"DNA " => "DNA",
"DNA Cell Biol. " => "DCB",
"Dev. Biol. " => "DevB",
"Diabetes " => "Diab",
"EMBO J. " => "EMBOJ",
"Eur. J. Biochem. " => "EJBc",
"Eur. J. Cell Biol. " => "EJCB",
"Evolution " => "Evo",
"Exp. Cell Res. " => "ECR",
"FEBS Lett. " => "FEBS",
"Gene " => "Gene",
"Genes Chromosomes Cancer " => "GChC",
"Genes Dev. " => "GDev",
"Genetics " => "Gnts",
"Genome Res. " => "GnmR",
"Genomics " => "Gnms",
"Hum. Genet. " => "HGEN",
"Immunol. Today " => "ImTo",
"Int. J. Cancer " => "IJCa",
"J. Biochem. " => "JBch",
"J. Biol. Chem. " => "JBC",
"J. Cell Biol. " => "JCB",
"J. Exp. Med. " => "JEM",
"J. Gen. Virol. " => "JGV",
"J. Immunol. " => "JI",
"J. Mol. Appl. Genet. " => "JMAG",
"J. Mol. Biol. " => "JMB",
"J. Mol. Endocrinol. " => "JMEnd",
"J. Mol. Evol. " => "JME",
"J. Neurosci. " => "JNeSc",
"J. Virol. " => "JVir",
"Meth. Enzymol. " => "MEnz",
"Mol. Biol. " => "MB",
"Mol. Biol. Evol. " => "MBE",
"Mol. Biol. Med. " => "MBM",
"Mol. Biol. Rep. " => "MBR",
"Mol. Cell. Biol. " => "MCB",
"Mol. Cell. Endocrinol. " => "MCEnd",
"Mol. Endocrinol. " => "MEnd",
"Mol. Gen. Genet. " => "MGG",
"Mol. Immunol. " => "MImm",
"Mol. Neurobiol. " => "MNeub",
"Mol. Plant Microbe Interact. " => "MPMI",
"Nature " => "Nat",
"Nucleic Acids Res. " => "NAR",
"Nucleic Acids Res. Suppl. " => "NAR",
"Oncogene " => "Oncg",
"Oncogene Res. " => "OncR",
"Plant J. " => "PlJ",
"Plant Mol. Biol. " => "PMB",
"Plant Sci. Lett. " => "PSL",
"Planta " => "Pla",
"Proc. Natl. Acad. Sci. U.S.A. " => "PNAS",
"Recent Prog. Horm. Res. " => "RPHR",
"Science " => "Sci",
"Somat. Cell Mol. Genet. " => "SCMG",
"Trends Genet. " => "TiG",
"Virology " => "Vir",
"Virus Res. " => "VirR",
);

$embl_refs = 0;
$refs ="";
$old_ref="";
@EMBL=();
@IF=();
@EPD=();
@NP=();
@TRANSFAC=();
@ME=();
@TX=();
@KW=();
@DE=();
@HG=();
@RL_specials=();
$AP="";
$AP_number="";
$AP_code="";
@SP_AC=();
@SP_ID=();
@RS_AC=();
@FB_AC=();
@FB_ID=();
@ENS_ID=();
$count=0;
   my @a = split /^/;

#First part put the lines in arrays

   foreach (@a)
   {

       if (/^ID   /)
       {
	   /^ID   (\S+_\S+)\s+([^;]+);\s([^;]+);\s([^\.]+)/;
	   $ID = $1;
	   $type = $2;
	   $site_type = $3;
	   $taxo = $4;
       }
       elsif (/^AC   /)
       {
	   /^AC   (EP\d{5});/;
	   $AC = $1;
       }
       elsif (/^DT   [^,]+, created/)
       {
	   /^DT   (\S{2})-(\S{3})-(\d{4})\s\(Rel\.\s(\d+)(.*)/;
	   $day_c = $1;
	   $month_c = $2;
	   $year_c = $3;
	   $creation = $4;
       }
       elsif (/^DT   [^,]+, Last/)
       {
	   /^DT   (\S{2})-(\S{3})-(\d{4})\s\(Rel\.\s(\d+)(.*)/;
	   $day_a = $1;
	   $month_a = $2;
	   $year_a = $3;
	   $annot = $4;
       }
       elsif (/^DE   /)
       {
	  s/(\DE   )(.*)\n/$2/;
	  push (@DE, $_);
       }
       elsif (/^OS   /)
       {
	   /^OS   (.*)/;
	   $OS = $1;
       }
       elsif (/^HG   /)
       {
	  s/(\HG   )(.*)\n/$2/;
	  push (@HG, $_);
       }
       elsif (/^AP   /)
       {
	   $AP=$_;
	   if ($AP =~ /none/)
	   {
	       $AP="";
	   }
	   else
	   {
	       /^AP   ([^\#]+)\#(\d) of (\d)\; (\d\' )?exon (\d)\; site (\d)(.*)\n/;
	       $AP_number=$2;
	       $AP_total=$3;
	       $AP_exon="$4exon $5";
	       $AP_site=$6;
	       $AP_major=$7;
	   }

       }
       elsif (/^NP   /)
       {
	  s/(NP   )([^\;]+|\w{4})(.*)(\.)\n/$3/m;
	  push (@NP, $_);
       }

       elsif (/^DR   EPD\;/)
       {
	  s/(DR   EPD\; )([^\.]+)(\.)\n/$2/m;
	  push (@EPD, $_);
       }

       elsif (/^DR   CLEANEX\; ([^\.]+)/)
       {
	   $CLEANEX_ID=$1;
       }
       elsif (/^DR   GENOME\; ([^\;]+)\; ([^\;]+)\; ([^\.]+)(\.)/)
       {
	   $GENOME_SV=$1;
	   $GENOME_AC=$2;
	   $GENOME_pos=$3;
       }
       elsif (/^DR   EMBL/)
       {
	  s/(DR   EMBL\; )([^\;]+\; )([^\.]+)(\.)\n/$2$3/m;
	  push (@EMBL, $_);
       }
       elsif (/^DR   SWISS-PROT/)
       {
	   /^DR   SWISS-PROT\; ([^\;]+)\; ([^\.]+)/;
	    push (@SP_AC, $1);
	    push (@SP_ID, $2);
       }
       elsif (/^DR   RefSeq/)
       {
	   /^DR   RefSeq\; ([^\.]+)/;
	    push (@RS_AC, $1);
       }
       elsif (/^DR   TRANSFAC/)
       {
	  s/(DR   TRANSFAC\; )([^\.]+)(\.)\n/$2/m;
	  push (@TRANSFAC, $_);
       }
       elsif (/^DR   MIM/)
       {
	   /^DR   MIM\; ([^\.]+)/;
	   $MIM_AC=$1;
       }
       elsif (/^DR   FLYBASE/)
       {
	   /^DR   FLYBASE\; ([^\;]+)\; ([^\.]+)/;
	    push (@FB_AC, $1);
	    push (@FB_ID, $2);
       }
       elsif (/^DR   MGD/)
       {
	   /^DR   MGD\; ([^\;]+)\; ([^\.]+)/;
	   $MGD_AC=$1;
	   $MGD_ID=$2;
       }
	elsif (/^DR   TRANSCRIPTOME; (\S+)\./){
	    $TROM=$1;
	}
	elsif (/^DR   ENSEMBL; (\S+)\./){
	    push (@ENS_ID, $1);
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
	  push (@ME, $_);
       }
       elsif (/^SE   /)
       {
	   /^SE   (.*)/;
	   $SE = $1;
       }
       elsif (/^FL/)
       {
	   $count=1;
	   /^FL\s+(.*)/;
	   $FL = $1;
       }
       elsif (/^IF   ([+\-]?\d+)\s+([ATCG])\s{4}([\d+|\s])\s+(\d+|none\.?)/)
       {
	   $_=~tr/\.//;
	   $if_line="$1|$2|$3|$4";
	   push (@IF, $if_line);
       }
       elsif (/^TX   /)
       {
	  s/(\TX   )(.*)\n/$2/;
	  push (@TX, $_);
       }
       elsif (/^KW   /)
       {
	  s/(KW   )(.*)\n/$2/;
	  push (@KW, $_);
       }

       if (/^FP   /)
       {
	   s/\n//;
	   $FP = $_;
       }
       elsif (/^DO\s+Expe/)
       {
	   /^DO\s+(.*)/;
	   $DO1 = $1;
       }
       elsif (/^DO\s+Expr/)
       {
	   /^DO\s+(.*)/;
	   $DO2 = $1;
       }
       elsif (/^RF   /)
       {
	   s/(RF\s+)(.*)\n/$2/;
	   $RF = $_;
       }
   }
#*********************BEGIN PRINTING******************#

print "\t\<Entry\>\n";

#*****************ID LINE******************#

print "\t\t\<ID_line Type=\"$type\" Site_type=\"$site_type\" Taxonomic_division=\"$taxo\"\>\n";
print"\t\t\t$ID\n";
print"\t\t\</ID_line\>\n";

#*****************AC LINE******************#

print "\t\t\<AC_line\>\n";
print "\t\t\t$AC\n";
print "\t\t\</AC_line\>\n";

#******************DT LINES******************#

print "\t\t\<DT_line\>\n";

#*****************FIRST DT LINE******************#
print "\t\t\t\<Creation_lines\>\n";
print "\t\t\t\t\t\<Day1\>\n";
print "\t\t\t\t\t\t$day_c\n";
print "\t\t\t\t\t\</Day1\>\n";
print "\t\t\t\t\t\<Month1\>\n";
print "\t\t\t\t\t\t$month_c\n";
print "\t\t\t\t\t\</Month1\>\n";
print "\t\t\t\t\t\<Year1\>\n";
print "\t\t\t\t\t\t$year_c\n";
print "\t\t\t\t\t\</Year1\>\n";
print "\t\t\t\t\<Creation\>\n";
print "\t\t\t\t\t$creation\n";
print "\t\t\t\t\</Creation\>\n";
print "\t\t\t\</Creation_lines\>\n";
#*****************SECOND DT LINE******************#
print "\t\t\t\<Annotation_lines\>\n";
print "\t\t\t\t\<Day2\>\n";
print "\t\t\t\t\t\t$day_a\n";
print "\t\t\t\t\t\</Day2\>\n";
print "\t\t\t\t\t\<Month2\>\n";
print "\t\t\t\t\t\t$month_a\n";
print "\t\t\t\t\t\</Month2\>\n";
print "\t\t\t\t\t\<Year2\>\n";
print "\t\t\t\t\t\t$year_a\n";
print "\t\t\t\t\t\</Year2\>\n";
print "\t\t\t\t\<Annotation\>\n";
print "\t\t\t\t\t$annot\n";
print "\t\t\t\t\</Annotation\>\n";
print "\t\t\t\</Annotation_lines\>\n";
print "\t\t\</DT_line\>\n";

#*****************DE LINES******************#

$de_refs = scalar(@DE);

   for ($i =0;$i<$de_refs;$i++)
{
      print "\t\t\<DE_line\>\n";
      print "\t\t\t\t$DE[$i]\n";
      print "\t\t\</DE_line\>\n";
}
@DE=();
$de_refs = 0;

#*****************OS LINE******************#

print "\t\t\<OS_line\>\n";
print "\t\t\t\t$OS\n";
print "\t\t\</OS_line\>\n";


#*****************Similarity LINES******************#

print "\t\t\<Similarity\>\n";

#*****************HG LINE******************#

print "\t\t\t\<HG_line\>\n";
if ($HG[0]  =~ /Homology group (\d+)\; (.*)/)
{
    $HG_number=$1;
    $HG_desc=$2;
    print "\t\t\t\t\<Homology\>\n";
    print "\t\t\t\t\t\<Homology_number\>\n";
    print "\t\t\t\t\t\t$HG_number\n";
    print "\t\t\t\t\t\</Homology_number\>\n";
    print "\t\t\t\t\t\<Homology_description\>\n";
    print "\t\t\t\t\t\t$HG_desc\n";
    print "\t\t\t\t\t\</Homology_description\>\n";
    if ($HG[1]  ne "")
    {
	print "\t\t\t\t\t\<Homology_description\>\n";
	print "\t\t\t\t\t\t$HG[1]\n";
	print "\t\t\t\t\t\</Homology_description\>\n";
    }
    print "\t\t\t\t\</Homology\>\n";
}
else
{
print  "\t\t\t\t\<No_similarity/\>\n";
}
print "\t\t\t\</HG_line\>\n";


#*****************AP LINES******************#


    print "\t\t\t\<AP_line\>\n";

    if ($AP ne "")
    {
	print "\t\t\t\t\<Alternative\>\n";
	print "\t\t\t\t\t\<Alternative_number\>\n";
	print "\t\t\t\t\t\t$AP_number\n";
	print "\t\t\t\t\t\</Alternative_number\>\n";
	print "\t\t\t\t\t\<Alternative_total\>\n";
	print "\t\t\t\t\t\t$AP_total\n";
	print "\t\t\t\t\t\</Alternative_total\>\n";
	print "\t\t\t\t\t\<Alternative_exon\>\n";
	print "\t\t\t\t\t\t$AP_exon\n";
	print "\t\t\t\t\t\</Alternative_exon\>\n";
	print "\t\t\t\t\t\<Alternative_site\>\n";
	print "\t\t\t\t\t\t$AP_site\n";
	print "\t\t\t\t\t\</Alternative_site\>\n";


	if ($AP_major =~ /major/)
	{
	    $AP_code="+";
	    print "\t\t\t\t\t\<Alternative_major\>\n";
	    print "\t\t\t\t\t\tmajor promoter\n";
	    print "\t\t\t\t\t\</Alternative_major\>\n";
	}
	else
	{
	    $AP_code=" ";
	}
	print "\t\t\t\t\</Alternative\>\n";
    }
    else
    {
	print  "\t\t\t\t\<No_similarity/\>\n";
    }
print "\t\t\t\</AP_line\>\n";



#*****************NP LINES******************#



$np_refs = scalar(@NP);

for ($i=0;$i<$np_refs;$i++)
{

    print "\t\t\t\<NP_line\>\n";
    if ($NP[$i] =~/EP/)
    {
	@np_fields=split /\; /,$NP[$i];
	$NP_number = $np_fields[1];
	$NP_id = $np_fields[2];
	$NP_pos= "$np_fields[3]\;\ $np_fields[4]";

	print "\t\t\t\t\<Neighbour\>\n";
	print "\t\t\t\t\t\<Neighbour_AC\>\n";
	print "\t\t\t\t\t\t$NP_number\n";
	print "\t\t\t\t\t\</Neighbour_AC\>\n";
	print "\t\t\t\t\t\<Neighbour_ID\>\n";
	print "\t\t\t\t\t\t$NP_id\n";
	print "\t\t\t\t\t\</Neighbour_ID\>\n";
	print "\t\t\t\t\t\<Neighbour_position\>\n";
	print "\t\t\t\t\t\t$NP_pos\n";
	print "\t\t\t\t\t\</Neighbour_position\>\n";
	print "\t\t\t\t\</Neighbour\>\n";
    }
    else
    {
	print  "\t\t\t\t\<No_similarity/\>\n";
    }

print "\t\t\t\</NP_line\>\n";

}
@NP=();
$np_refs=0;




#******************End of Similarity*****************


print "\t\t\</Similarity\>\n";



#*******************CROSS-LINKS LINES**********************

print "\t\t\<Cross-links\>\n";

#*****************EPD LINEs******************

if (@EPD ne "")

{

    $epd_refs = scalar(@EPD);

    for ($i=0;$i<$epd_refs;$i++)
    {
	@EPD_fields = split /\; / , $EPD[$i];
	$EP_AC = $EPD_fields[0];
        $EP_ID = $EPD_fields[1];
        $EP_type = $EPD_fields[2];
        $EP_pos = "$EPD_fields[3];$EPD_fields[4]";

        print "\t\t\t\<EPD_link\>\n";
        print "\t\t\t\t\<EPD_AC\>\n";
        print "\t\t\t\t\t$EP_AC\n";
        print "\t\t\t\t\</EPD_AC\>\n";
        print "\t\t\t\t\<EPD_ID\>\n";
        print "\t\t\t\t\t$EP_ID\n";
        print "\t\t\t\t\</EPD_ID\>\n";
        print "\t\t\t\t\<EPD_type\>\n";
        print "\t\t\t\t\t$EP_type\n";
        print "\t\t\t\t\</EPD_type\>\n";
	if ($EP_pos =~ /\[/)
	{
	    print "\t\t\t\t\<EPD_pos\>\n";
	    print "\t\t\t\t\t$EP_pos\n";
	    print "\t\t\t\t\</EPD_pos\>\n";
	}
	print "\t\t\t\</EPD_link\>\n";
    }
       @EPD=();
       $epd_refs = 0;
}
#*****************GENOME LINE******************


if ($GENOME_SV ne "")

{
    print "\t\t\t\<GENOME\>\n";
    print "\t\t\t\t\<GENOME_SV\>\n";
    print "\t\t\t\t\t$GENOME_SV\n";
    print "\t\t\t\t\</GENOME_SV\>\n";
    print "\t\t\t\t\<GENOME_AC\>\n";
    print "\t\t\t\t\t$GENOME_AC\n";
    print "\t\t\t\t\</GENOME_AC\>\n";
    print "\t\t\t\t\<GENOME_Position\>\n";
    print "\t\t\t\t\t$GENOME_pos\n";
    print "\t\t\t\t\</GENOME_Position\>\n";
    print "\t\t\t\</GENOME\>\n";
}

$GENOME_SV="";
$GENOME_AC="";
$GENOME_pos="";


#*****************CLEANEX LINE******************


if ($CLEANEX_ID ne "")

{
    print "\t\t\t\<CleanEx\>\n";
    print "\t\t\t\t\<CleanEx_ID\>\n";
    print "\t\t\t\t\t$CLEANEX_ID\n";
    print "\t\t\t\t\</CleanEx_ID\>\n";
    print "\t\t\t\</CleanEx\>\n";
}

$CLEANEX_AC="";
$CLEANEX_ID="";



#*****************EMBL LINES******************

	   $embl_refs = scalar(@EMBL);

	#*******First EMBL REF*********

	   @EM_first_fields = split /\; / , $EMBL[0];
	   $SV_first = $EM_first_fields[0];
	   $pos_first = $EM_first_fields[1];
	   print "\t\t\t\<EMBL_first\>\n";
	   print "\t\t\t\t\<EMBL_SV\>\n";
	   print "\t\t\t\t\t$SV_first\n";
	   print "\t\t\t\t\</EMBL_SV\>\n";
	   print "\t\t\t\t\<EMBL_Position\>\n";
	   print "\t\t\t\t\t$pos_first\n";
	   print "\t\t\t\t\</EMBL_Position\>\n";
           print "\t\t\t\</EMBL_first\>\n";

        #*******Other EMBL REFS**********

	   for ($i=1;$i<$embl_refs;$i++)
	   {
	   @EM_fields = split /\; / , $EMBL[$i];
	   $SV = $EM_fields[0];
	   $pos = $EM_fields[1];

	   print "\t\t\t\<EMBL\>\n";
	   print "\t\t\t\t\<EMBL_SV\>\n";
	   print "\t\t\t\t\t$SV\n";
	   print "\t\t\t\t\</EMBL_SV\>\n";
	   print "\t\t\t\t\<EMBL_Position\>\n";
	   print "\t\t\t\t\t$pos\n";
	   print "\t\t\t\t\</EMBL_Position\>\n";
	   print "\t\t\t\</EMBL\>\n";
           }
       @EMBL=();
       $embl_refs = 0;

#*****************SWISS-PROT LINE******************


if (@SP_AC ne "")
{
    $i=0;
    foreach (@SP_AC){

	print "\t\t\t\<SWISSPROT\>\n";
	print "\t\t\t\t\<SP_AC\>\n";
	print "\t\t\t\t\t$SP_AC[$i]\n";
	print "\t\t\t\t\</SP_AC\>\n";
	print "\t\t\t\t\<SP_ID\>\n";
	print "\t\t\t\t\t$SP_ID[$i]\n";
	print "\t\t\t\t\</SP_ID\>\n";
	print "\t\t\t\</SWISSPROT\>\n";
	$i++;
    }
}

@SP_AC=();
@SP_ID=();


#*****************TRANSFAC LINES******************


if (@TRANSFAC ne "")

{

    $tf_refs = scalar(@TRANSFAC);

    for ($i=0;$i<$tf_refs;$i++)
    {
	@tf_fields = split /\; / , $TRANSFAC[$i];
	$tf_AC = $tf_fields[0];
        $tf_ID = $tf_fields[1];
        $tf_type = $tf_fields[3];
        $tf_pos = $tf_fields[2];

        print "\t\t\t\<TRANSFAC\>\n";
        print "\t\t\t\t\<TF_AC\>\n";
        print "\t\t\t\t\t$tf_AC\n";
        print "\t\t\t\t\</TF_AC\>\n";
        print "\t\t\t\t\<TF_ID\>\n";
        print "\t\t\t\t\t$tf_ID\n";
        print "\t\t\t\t\</TF_ID\>\n";
        print "\t\t\t\t\<TF_Position\>\n";
        print "\t\t\t\t\t$tf_pos\n";
        print "\t\t\t\t\</TF_Position\>\n";
        print "\t\t\t\t\<TF_Type\>\n";
        print "\t\t\t\t\t$tf_type\n";
        print "\t\t\t\t\</TF_Type\>\n";

	print "\t\t\t\</TRANSFAC\>\n";
    }

}

 @TRANSFAC=();
 $tf_refs = 0;
#*****************FLYBASE LINE******************


   if (@FB_AC ne "")
   {
       $i=0;
       foreach (@FB_AC){

	   print "\t\t\t\<FLYBASE\>\n";
	   print "\t\t\t\t\<FB_AC\>\n";
	   print "\t\t\t\t\t$FB_AC[$i]\n";
	   print "\t\t\t\t\</FB_AC\>\n";
	   print "\t\t\t\t\<FB_ID\>\n";
	   print "\t\t\t\t\t$FB_ID[$i]\n";
	   print "\t\t\t\t\</FB_ID\>\n";
	   print "\t\t\t\</FLYBASE\>\n";
       }
   }

   @FB_AC=();
   @FB_ID=();


#*****************MGD LINE******************


   if ($MGD_AC ne "")

   {
       print "\t\t\t\<MGD\>\n";
       print "\t\t\t\t\<MGD_AC\>\n";
       print "\t\t\t\t\t$MGD_AC\n";
       print "\t\t\t\t\</MGD_AC\>\n";
       print "\t\t\t\t\<MGD_ID\>\n";
       print "\t\t\t\t\t$MGD_ID\n";
       print "\t\t\t\t\</MGD_ID\>\n";
       print "\t\t\t\</MGD\>\n";
   }

   $MGD_AC="";
   $MGD_ID="";

#*****************RefSeq LINE******************


   if (@RS_AC ne "")
   {
       foreach (@RS_AC){
	   print "\t\t\t\<RefSeq\>\n";
	   print "\t\t\t\t\<RefSeq_AC\>\n";
	   print "\t\t\t\t\t$_\n";
	   print "\t\t\t\t\</RefSeq_AC\>\n";
	   print "\t\t\t\</RefSeq\>\n";
       }
   }

   @RS_AC=();

#*****************MIM LINE******************


   if ($MIM_AC ne "")

   {
      print "\t\t\t\<MIM\>\n";
      print "\t\t\t\t\<MIM_AC\>\n";
      print "\t\t\t\t\t$MIM_AC\n";
      print "\t\t\t\t\</MIM_AC\>\n";
      print "\t\t\t\</MIM\>\n";
   }

   $MIM_AC="";
   $MIM_ID="";

#*****************ENSEMBL LINE******************


   if (@ENS_ID ne "")
   {
       foreach (@ENS_ID){
	   print "\t\t\t\<ENSEMBL\>\n";
	   print "\t\t\t\t\<ENSEMBL_ID\>\n";
	   print "\t\t\t\t\t$_\n";
	   print "\t\t\t\t\</ENSEMBL_ID\>\n";
	   print "\t\t\t\</ENSEMBL\>\n";
       }
   }

   @RS_AC=();

print "\t\t\</Cross-links\>\n";
#*****************REFERENCES LINES******************

   @one_ref=split /\s?RN   /, $refs;

   $refs_number=scalar(@one_ref);
   for ($i=1;$i<$refs_number;$i++)
   {
       print "\t\t\<References\>\n";
       print "\t\t\t\<RN_line\>\n";
       print "\t\t\t\t\[$i\]\n";
       print "\t\t\t\</RN_line\>\n";
       @ref_lines=split /\|/, $one_ref[$i];
       foreach $ref_line (@ref_lines)
       {

           if ($ref_line =~ /^RX   ([^\;]+; )([^\.]+)/)
           {
               print "\t\t\t\<RX_line\>\n";
               print "\t\t\t\t$2\n";
               print "\t\t\t\</RX_line\>\n";
           }
           elsif ($ref_line =~ /^RA   (.*)/)
           {
               print "\t\t\t\<RA_line\>\n";
               print "\t\t\t\t$1\n";
               print "\t\t\t\</RA_line\>\n";
           }
           elsif ($ref_line =~ /^RT   (.*)/)
           {
               print "\t\t\t\<RT_line\>\n";
               print "\t\t\t\t$1\n";
               print "\t\t\t\</RT_line\>\n";
           }
           elsif ($ref_line =~ /^RL   /)
	   {
	       if ($ref_line =~ /^RL   ([^\d]+)([^\:]+)\:([^\(]+)(\(\d+\))/)
	       {
		   print "\t\t\t\<RL_line\>\n";
		   print "\t\t\t\t\<Journal_name\>\n";
		   print "\t\t\t\t\t$1\n";
		   print "\t\t\t\t\</Journal_name\>\n";
		   print "\t\t\t\t\<Volume\>\n";
		   print "\t\t\t\t\t$2\n";
		   print "\t\t\t\t\</Volume\>\n";
		   print "\t\t\t\t\<Page_number\>\n";
		   print "\t\t\t\t\t$3\n";
		   print "\t\t\t\t\</Page_number\>\n";
		   print "\t\t\t\t\<Journal_issue\>\n";
		   print "\t\t\t\t\t$4\n";
		   print "\t\t\t\t\</Journal_issue\>\n";

		   print "\t\t\t\</RL_line\>\n";
		   @first_page=();
		   @first_page=split(/-/,$3);
		   $first_page=@first_page[0];
		   @volume=split(/\(/,$2);
		   $volume=@volume[0];
		   push(@Volume,$volume);
		   push(@First_page, $first_page);
		   push(@journal_name, $1);
	       }

	       else
	       {
		   if ($ref_line =~ /RL   (\(in\) Harris J.R.\(Ed.\))/)
		   {
		       $author=$1;
		       print "\t\t\t\<RL_line\>\n";
		       print "\t\t\t\t\<Journal_author\>\n";
		       print "\t\t\t\t\t$author\n";
		       print "\t\t\t\t\</Journal_author\>\n";
		   }
		   elsif ($ref_line =~ /RL   (BLOOD)([^:]+):(\d+)-([^\;]+)/)
		   {
		       $title="$1$2";
		       $first_page=$3;
		       $end_page=$4;
		       print "\t\t\t\t\<Journal_name\>\n";
		       print "\t\t\t\t\t$title\n";
		       print "\t\t\t\t\</Journal_name\>\n";
		       print "\t\t\t\t\<Page_number\>\n";
		       print "\t\t\t\t\t$first_page-$end_page\n";
		       print "\t\t\t\t\</Page_number\>\n";
		   }
		   elsif ($ref_line =~ /RL   (Plenum)([^\(]+)([^\.]+)/)
		   {
		       $editor="$1$2";
		       $issue=$3;
		       print "\t\t\t\t\<Journal_issue\>\n";
		       print "\t\t\t\t\t$issue\n";
		       print "\t\t\t\t\</Journal_issue\>\n";
		       print "\t\t\t\t\<Journal_editor\>\n";
		       print "\t\t\t\t\t$editor\n";
		       print "\t\t\t\t\</Journal_editor\>\n";

		   print "\t\t\t\</RL_line\>\n";
		   }

		}


	   }

       }
       print "\t\t\</References\>\n";
   }
   $old_ref="";
   @RL_specials=();
if ($editor ne "") { $refs_number=$refs_number-1};
$editor="";


#*****************ME LINES******************#

   $me_refs = scalar(@ME);

   for ($i =0;$i<$me_refs;$i++)
   {
      print "\t\t\<ME_line\>\n";
      print "\t\t\t$ME[$i]\n";
      print "\t\t\</ME_line\>\n";
   }
   @ME="";
   $me_refs = 0;

#*****************SE LINE******************#

   print "\t\t\<SE_line\>\n";
   print "\t\t\t$SE\n";
   print "\t\t\</SE_line\>\n";


#*****************IF LINES******************#

if ($count > 0)
{
    print "\t\t\<MGA\>\n";
    print "\t\t\t\<FL_line\>\n";
    print "\t\t\t\t$FL\n";
    print "\t\t\t\</FL_line\>\n";
    foreach $IF(@IF)
    {
	@fields=split/\|/,$IF;
	print "\t\t\t\<IF_line\>\n";
	print "\t\t\t\t\<POS\>\n";
	print "\t\t\t\t\t$fields[0]\n";
	print "\t\t\t\t\</POS\>\n";
	print "\t\t\t\t\<BASE\>\n";
	print "\t\t\t\t\t$fields[1]\n";
	print "\t\t\t\t\</BASE\>\n";
	if ($fields[2] =~/\d/)
	{
	    print "\t\t\t\t\<DBTSS\>\n";
	    print "\t\t\t\t\t$fields[2]\n";
	    print "\t\t\t\t\</DBTSS\>\n";
	}
	if ($fields[3] =~/\d/)
	{
	    print "\t\t\t\t\<MGC\>\n";
	    print "\t\t\t\t\t$fields[3]\n";
	    print "\t\t\t\t\</MGC\>\n";
	}
	print "\t\t\t\</IF_line\>\n";
    }
    print "\t\t\</MGA\>\n";
}
@IF="";



#*****************TX LINES******************#
print "\t\<Taxonomy\>\n";
   $tx_refs = scalar(@TX);

   for ($i =0;$i<$tx_refs;$i++)
   {

      print "\t\t\<TX_line\>\n";
      print "\t\t\t$TX[$i]\n";
      print "\t\t\</TX_line\>\n";
    }
    @TX="";
    $tx_refs = 0;

print "\t\</Taxonomy\>\n";
#*****************KW LINES******************#

   $kw_refs = scalar(@KW);

   for ($i =0;$i<$kw_refs;$i++)
   {
      print "\t\t\<KW_line\>\n";
      print "\t\t\t\t$KW[$i]\n";
      print "\t\t\</KW_line\>\n";
   }
   @KW=();
   $kw_refs = 0;


#*****************OLD FORMAT LINES******************#

   print "\t\t\<Old_format\>\n";


#*****************FP LINE******************#


   print "\t\t\t\<FP_line\>\n";
   print "\t\t\t\t";

   $name = (substr ($FP, 0, 25));
   @names=split (//,$name);
   foreach $names (@names)
   {
       if ($names eq"<")
       {
	   $names="&lt\;";
       }
       elsif ($names eq">")
       {
	   $names="&gt\;";
       }
       print "$names";
   }
   my $subset = (substr ($FP, 25, 2));

   if ($site_type =~ /single/)
   {
       $site="S";
   }
   elsif ($site_type =~ /multiple/)
   {
       $site="M";
   }
   elsif ($site_type =~ /region/)
   {
       $site="R";
   }
   #print "$name";
   print "$subset";
   print "$site";
#   printf"%2sEM\:";
#   print"$SV_first";
#   $EM_length=length($SV_first);
#   $strand_pos=$EM_length+33;
#   $strand_length=52-$strand_pos;
#   my $seq_type=(substr ($FP, $strand_pos, $strand_length));
#   print"$seq_type";
#   if ($pos_first =~ /\[-(\d+)/)
#   {
#       print "+";
#       $pos_dep=$1+1;
#   }
#   elsif ($pos_first =~ /\[(\d+)/)
#   {
#       print "-";
#       $pos_dep=$1;
#   }
#   $blank_length=10-length($pos_dep);
#   printf"%${blank_length}s$pos_dep\; ";
   if ($AC =~ /EP(\d+)/)
   {
       $AC_number=$1;
   }
   print"$AC_number\.";
   if ($HG_number =~ /\d+/)
   {
	if ($HG_number =~ /\d{3}/)
	{
	    $hom=$HG_number;
	}
	elsif ($HG_number =~ /\d{2}/)
	{
	    $hom="0$HG_number";
	}
	elsif ($HG_number =~ /\d/)
	{
	    $hom="00$HG_number";
	}
	print "$hom";
	if ($AP_number =~ /\d/)
	{
	    $ap_cat = (substr ($FP, 74, 5));
	    print "$ap_cat$AP_number\n";
	}
	else
	{
	    print"\n";
	}
    }
   else
   {
       if ($AP_number =~ /\d/)
       {
	   $ap_cat = (substr ($FP, 71, 8));
	   print "$ap_cat$AP_number\n";
       }
       else
       {
	   print"\n$FP\n";
       }
   }

print "\t\t\t\</FP_line\>\n";

$FP="";
$HG_number="";

#*****************DO1 LINE******************#


   print "\t\t\t\<DO1_line\>\n";
   print "\t\t\t\t$DO1\n";
   print "\t\t\t\</DO1_line\>\n";


#*****************DO2 LINE******************#


   print "\t\t\t\<DO2_line\>\n";
   print "\t\t\t\t$DO2\n";
   print "\t\t\t\</DO2_line\>\n";


#*****************RF LINE******************#

print "\t\t\t\<RF_line\>\n";
   for ($i=0; $i<$refs_number-1; $i++)
   {
       $rn=15*$i;
       $ref=substr($RF, $rn, 15),
       print "\t\t\t\t\<REFS_ABB\>\n";
       print "\t\t\t\t\t$abbv{\"$journal_name[$i]\"}$Volume[$i]:$First_page[$i]\n";
       print "\t\t\t\t\</REFS_ABB\>\n";
   }
   print "\t\t\t\</RF_line\>\n";
@Volume=();
@First_page=();
@journal_name=();
#************End of old format***********

print "\t\t\</Old_format\>\n";


#*************End of Entry*************

print "\t\t\<End_of_Entry/\>\n";

print "\t\</Entry\>\n";


}
close(RECORD);



#################Subroutines#################


sub find_exp {
    open ( EXP_LIST, "../htdocs/list_of_methods") || die " can't open list_of_methods: $!";

           while ( defined ($exp_abb = <EXP_LIST>)) {
               chomp ($exp_abb);
               $description= <EXP_LIST>;
               chomp ($description);
               $exp{$description} = $exp_abb;
           }
           close (EXP_LIST) || die " couldn't close list_of_methods: $!";
}


sub find_journal {
    open ( JOURNAL_LIST, "../htdocs/journal_abbs") || die " can't open journal_abbs: $!";

           while ( defined ($journal_na = <JOURNAL_LIST>)) {
               chomp ($journal_na);
               $journal_n="$journal_na ";
               $j_abb= <JOURNAL_LIST>;
               chomp ($j_abb);
               $journal{$journal_n} = $j_abb;
           }
           close (JOURNAL_LIST) || die " couldn't close journal_abbs: $!";
}
