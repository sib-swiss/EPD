#!/usr/bin/env perl

# converts an EPD record from XML to HTML.

#$ENV{'PATH'} .= ":/usr/molbio/perl";

#if ($#ARGV == 0) {
    # command-line style
    $record = $ARGV[0];
#} else {
    # CGI-style
#    $record = $ENV{'QUERY_STRING'};
#}


#$fetchCommand = "/home/vpraz/prog/fetch2 epdx:$record";

#printHTMLHeader();

#open (RECORD, "$fetchCommand |") or &HTMLError ("Could not open $record.");
# print "<center><h1>EPD\:$record<\/h1><\/center>\n";

print"<table cellpadding\=\"0\" cellspacing\=\"0\" bgcolor\=\"\#FFE87C\" width\=\"100\%\">\n<tr>\n<td bgcolor\=\"\#F88017\">\n<table cellpadding\=\"0\"><tr><td><font color\=\"\#FFFFFF\"><b>General information about the entry<\/b><\/font><\/td><\/tr><\/table>\n<\/td>\n<\/tr>\n<tr>\n<td bgcolor\=\"\#CACAB9\">\n<table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";
$/ = "</Entry>";
while (<>)
#while (<RECORD>)



{
    @fields=(split(/^\t\t<\//m));
    foreach $fields(@fields)
    {
	if ($fields =~/Type\=\"(\S+)\" Site_type\="(\S+)\" Taxonomic_division\=\"(\S+)\">\n\s+(\w+)/)
        {
            print "<tr><td bgcolor\=\"\#FBB917\" nowrap\=\"nowrap\">Entry name<\/td>\n<td bgcolor\=\"\#FBB917\" width\=\"100\%\"><b>$4<\/b><\/td>\n<\/tr>\n";
            print "<tr><td bgcolor\=\"\#FFF8C6\" nowrap\=\"nowrap\">Site type<\/td>\n<td bgcolor\=\"\#FFF8C6\" width\=\"100\%\">$2<\/td>\n<\/tr>\n";
            print "<tr><td bgcolor\=\"\#FFF8C6\" nowrap\=\"nowrap\">Entry Type<\/td>\n<td bgcolor\=\"\#FFF8C6\" width\=\"100\%\">$1<\/td>\n<\/tr>\n";
            print "<tr><td bgcolor\=\"\#FFF8C6\" nowrap\=\"nowrap\">Taxonomic division<\/td>\n<td bgcolor\=\"\#FFF8C6\" width\=\"100\%\">$3<\/td>\n<\/tr>\n";
        }
        if ($fields =~ /AC_line>\n\s+(\w+)/)
        {
            print "<tr><td bgcolor\=\"\#FBB917\" nowrap\=\"nowrap\">Accession Number<\/td>\n<td bgcolor\=\"\#FBB917\" width\=\"100\%\"><b>$1<\/b><\/td>\n<\/tr>\n";
        }


        if ($fields =~ /Day1>\n\s+([0-9|\?]+)/)
        {
            $day1=$1;
        }
        if ($fields =~ /Month1>\n\s+([A-Z]+)/)
        {
        $month1=$1;
        }
        if ($fields =~ /Year1>\n\s+([0-9]+)/)
        {
        $year1=$1;
        }
        if ($fields =~ /Creation>\n\s+([0-9]+)/)
        {
        $creation=$1;
        print "<tr><td bgcolor\=\"\#FFF8C6\" nowrap\=\"nowrap\">Entered in EPD on the<\/td>\n<td bgcolor\=\"\#FFF8C6\" width\=\"100\%\">$day1 $month1 $year1\, release $creation<\/td>\n<\/tr>\n";
        }
        if ($fields =~ /Day2>\n\s+([0-9|\?]+)/)
        {
        $day2=$1;
        }
        if ($fields =~ /Month2>\n\s+([A-Z]+)/)
        {
        $month2=$1;
        }
        if ($fields =~ /Year2>\n\s+([0-9]+)/)
        {
        $year2=$1;
        }
        if ($fields =~ /Annotation>\n\s+([0-9]+)/)
        {
        $annot=$1;
        print "<tr><td bgcolor\=\"\#FFF8C6\" nowrap\=\"nowrap\">Annotations were last modified on the<\/td>\n<td bgcolor\=\"\#FFF8C6\" width\=\"100\%\">$day2 $month2 $year2\, release $annot<\/td>\n<\/tr>\n";
        }
        if ($fields =~ /<DE_line>\n\s+([^\n]+)/)
        {
        print "<tr><td valign\=\"top\"bgcolor\=\"\#FFF8C6\" nowrap\=\"nowrap\">Description of the promoter<\/td>\n<td bgcolor\=\"\#FFF8C6\" width\=\"100\%\">$1<\/td>\n<\/tr>\n";
        }
        if ($fields =~ /<OS_line>\n\s+([^\(]+)(.*)/)
        {
        $specie=$1;
        chop ($specie);
        $tax=" $2";
        print "<tr><td valign\=\"top\"bgcolor\=\"\#FFF8C6\">From<\/td>\n<td bgcolor\=\"\#FFF8C6\" width\=\"100\%\"><a href\=\"http:\/\/www\.ncbi\.nlm\.nih\.gov\/htbin-post\/Taxonomy\/wgetorg\?name\=$specie\&srchmode\=1\">$specie<\/a>$tax<\/td>\n<\/tr>\n";
        }
        if ($fields =~ /<Similarity>/)
        {
        print "<tr>\n<td bgcolor\=\"\#F88017\" colspan\=\"2\">\n<table cellpadding\=\"0\"><tr><td><font color\=\"\#FFFFFF\"><b>Related EPD entries<\/b><\/font><\/td><\/tr>\n<\/table>\n<\/td>\n<\/tr>\n";
        @sim_fields=(split (/^\t\t\t<\//m,$fields));
        foreach (@sim_fields)
        {
           if (/<HG_line>/)
           {
               print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">Homology group<\/td>\n";

               if (/No_similarity/)
               {
                    print "<td>No homologous promoter<\/td><\/tr>\n";
               }
               else
               {
                    /<Homology_number>\n\s+(\d+)\n\s+<\/Homology_number>\n\s+<Homology_description>\n\s+(.*)/;
                    print "<td>Homology group $1\; $2<\/td><\/tr>\n";
               }
           }
           if (/<AP_line>/)
           {
               print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">Alternative promoter<\/td>\n";
               if (/No_similarity/)
               {
                    print "<td>No alternative promoter<\/td><\/tr>\n";
               }
               else
               {
                    /<Alternative_number>\n\s+(\d+)\n\s+<\/Alternative_number>\n\s+<Alternative_total>\n\s+(\d+)\n\s+<\/Alternative_total>\n\s+<Alternative_exon>\n\s+(\d+)\n\s+<\/Alternative_exon>\n\s+<Alternative_site>\n\s+(\d+)/;
                    print "<td>Alternative promoter number $1 of $2\; exon $3\; site $4<\/td><\/tr>\n";
               }
           }
           if (/<NP_line>/)
           {
               print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">Neighbouring promoter<\/td>\n";
               if (/No_similarity/)
               {
                    print "<td>No neighbouring promoter<\/td><\/tr>\n";
               }
               else
               {
                    /<Neighbour_AC>\n\s+(EP\d+)\n\s+<\/Neighbour_AC>\n\s+<Neighbour_ID>\n\s+(\S+)\n\s+<\/Neighbour_ID>\n\s+<Neighbour_position>\n\s+(.*)/;
                    print "<td><a href\=\"\/cgi-bin\/epd\/get_doc\?db\=epd\&format\=html\&entry\=$1\">$1<\/a>\; $2\; $3<\/td><\/tr>\n";
               }
           }
        }
        print"<\/table><\/td><\/tr>\n";

        }
        if ($fields =~ /<Cross-links>/)
        {
        @cross_fields=(split (/^\t\t\t<\//m,$fields));
        foreach (@cross_fields)
            {
                if (/<EPD_link>/)
                {
                       /<EPD_AC>\n\s+(EP\d+)\n\s+<\/EPD_AC>\n\s+<EPD_ID>\n\s+(\S+)\n\s+<\/EPD_ID>\n\s+<EPD_type>\n\s+([^\n]+)\n\s+<\/EPD_type>\n\s+<EPD_pos>\n\s+(.*)/;
                      push (@epd, $1);
                      $epd_ID{$1}=$2;
                      $epd_type{$1}=$3;
                      $epd_position{$1}=$4;
                }
                if (/<EPDEX_link>/)
                {
                       /<EPDEX_AC>\n\s+(EX\d+)\n\s+<\/EPDEX_AC>\n\s+<EPDEX_ID>\n\s+(\S+)/;
                      $EPDEX_AC=$1;
                      $EPDEX_ID=$2;
                }

                if (/<EMBL(_first)?>/)
                {
                       /<EMBL_SV>\n\s+([^\.]+)\.(\d{1,2})\n\s+<\/EMBL_SV>\n\s+<EMBL_ID>\n\s+(\S+)\n\s+<\/EMBL_ID>\n\s+<EMBL_Position>\n\s+([^\n]+)/;
                       $sv="$1\.$2";
                       push (@SV, $sv);
                       $AC{$sv}=$1;
                       $ID{$sv}=$3;
                       $position{$sv}=$4;
                 }
                if (/<SWISSPROT>/)
                {
                       /<SP_AC>\n\s+(\S+)\n\s+<\/SP_AC>\n\s+<SP_ID>\n\s+(\S+)/;
                      push (@swiss, $1);
                      $swiss_ID{$1}=$2;
                }
                if (/<TRANSFAC>/)
                {
                       /<TF_AC>\n\s+(\S+)\n\s+<\/TF_AC>\n\s+<TF_ID>\n\s+([^\n]+)\n\s+<\/TF_ID>\n\s+<TF_Position>\n\s+([^\n]+)\n\s+<\/TF_Position>\n\s+<TF_Type>\n\s+(.*)/;
                      push (@TF, $1);
                      $TF_ID{$1}=$2;
                      $TF_position{$1}=$3;
                      $TF_type{$1}=$4;
                }
                if (/<MIM>/)
                {
                       /<MIM_AC>\n\s+(\d+)\n\s+/;
                      $MIM_AC=$1;
                }
                if (/<MGD>/)
                {
                       /<MGD_AC>\n\s+(MGI\:\d+)\n\s+<\/MGD_AC>\n\s+<MGD_ID>\n\s+(\S+)/;
                      $MGD_AC=$1;
                      $MGD_ID=$2;
                }
                if (/<FLYBASE>/)
                {
                       /<FB_AC>\n\s+(\S+)\n\s+<\/FB_AC>\n\s+<FB_ID>\n\s+(.*)/;
                      $FB_AC=$1;
                      $FB_ID=$2;
                }
             }
        }
        if ($fields =~ /<References>/)
        {
            @Author="";
            @Title="";
        @refs_fields=(split (/^\t\t\t<\//m,$fields));
        foreach (@refs_fields)
            {
                if (/<RN_line>/)
                {
                    /<RN_line>\n\s+(.*)/;
                    $num=$1;
                    push(@number,$num);

                }
                if (/<RX_line>/)
                {
                    /<RX_line>\n\s+(\d+)/;
                    $med_number{$num}=$1;
                }
                if (/<RA_line>/)
                {
                    /<RA_line>\n\s+(.*)/;
                    push(@Author,$1);
                }
                if (/<RT_line>/)
                {
                    /<RT_line>\n\s+(.*)/;
                    push(@Title,$1);
                }
                if (/<RL_line>/)
                {
                    /<RL_line>\n\s+<Journal_name>\n\s+([^\n]+)\n\s+<\/Journal_name>\n\s+<Volume>\n\s+(\d+)\n\s+<\/Volume>\n\s+<Page_number>\n\s+([^\n]+)\n\s+<\/Page_number>\n\s+<Journal_issue>(.*)/;
                    $j_name{$num}=$1;
                    $volume{$num}=$2;
                    $pages{$num}=$3;
                    $issue{$num}=$4;
                }
            }
        }
        $author_length=scalar(@Author);
        if ($author_length ==1)
           {
               $AU="$Author[0]";
           }
        if ($author_length ==2)
           {
               $AU="$Author[0] $Author[1]";
           }
        if ($author_length ==3)
           {
               $AU="$Author[0] $Author[1] $Author[2]";
           }
        $AUTHOR{$num}=$AU;

        $title_length=scalar(@Title);
        if ($title_length ==1)
           {
               $TI="$Title[0]";
           }
        if ($title_length ==2)
           {
               $TI="$Title[0] $Title[1]";
           }
        if ($title_length ==3)
           {
               $TI="$Title[0] $Title[1] $Title[2]";
           }
        $TITLE{$num}=$TI;
        $methods="";
        if ($fields =~ /<ME_line>\n\s+(.*)/)
        {
            $methods=$1;
            push (@ME,$methods);
        }
        if ($fields =~ /<SE_line>/)
        {
            /<SE_line>\n\s+([^ATCG]+)(.*)/;
            $up_seq=$1;
            $down_seq=$2;
        }
        if ($fields =~ /<TX_line>\n\s+(\S+) (.*)/)
        {
            push(@tax_number,$1);
            $tax_def{$1}=$2;
        }
        if ($fields =~ /<KW_line>\n\s+(.*)/)
        {
            push(@KW,$1);
        }
        if ($fields =~ /<DO2_line>\n\s+(.*)/)
        {
            $comment=$1;
        }
    }
}
 print "<tr><td bgcolor\=\"\#F88017\"><table cellpadding\=\"0\"><tr><td><font color\=\"\#FFFFFF\"><b>Cross-references<\/b><\/font><\/td><\/tr><\/table><\/td><\/tr>\n<tr><td bgcolor\=\"\#CACAB9\"><table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";
$epd_length=scalar(@epd);
if ($epd_length > 0)
{
    print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">EPD (internal reference)<\/td>\n<td><table cellspacing\=\"0\" cellpadding\=\"0\">";

    foreach $epd (@epd)
    {
	print"<tr><td><a href\=\"http\:\/\/\/cgi-bin\/epd\/get_doc\?db\=epd\&format\=html\&entry\=$epd\">$epd<\/a>\; $epd_ID{$epd}\; $epd_type{$epd}\; $epd_position{$epd}<\/td><\/tr>\n";
    }
    print "\n<\/table><\/td>\n<\/tr>\n";
}
if ($EPDEX_ID ne "")
{
print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">EPDEX<\/td>\n<td><a href\=\"\/cgi-bin\/epd\/get_doc\?db\=cleanex\&format\=html\&entry=HS_$EPDEX_ID\">HS_$EPDEX_ID<\/a>\; $EPDEX_AC<\/td><\/tr>\n";
}
print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">EMBL<\/td>\n<td><table cellspacing\=\"0\" cellpadding\=\"0\">";

    foreach $SV(@SV)
    {
       print "<tr><td><a href\=\"http\:\/\/www\.ebi\.ac\.uk\/htbin\/emblfetch\?$AC{$SV}\">$SV<\/a>\; $ID{$SV}\; $position{$SV}<\/td><\/tr>\n";
print "\n<\/td>\n<\/tr>\n";
    }
print "<\/table><\/td><\/tr>\n";
$sp_length=scalar(@swiss);
if ($sp_length > 0)
{
    print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">SWISSPROT<\/td>\n<td><table cellspacing\=\"0\" cellpadding\=\"0\">";

    foreach $swiss (@swiss)
    {
	print"<tr><td><a href\=\"http\:\/\/www\.expasy\.ch\/cgi-bin\/sprot-search-ac\?$swiss\">$swiss<\/a>\; $swiss_ID{$swiss}<\/td><\/tr>\n";
	print "\n<\/td>\n<\/tr>\n";
    }
    print "<\/table><\/td><\/tr>\n";
}
$tf_length = scalar(@TF);
if ($tf_length > 0)
{
    print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">TRANSFAC<\/td>\n<td><table cellspacing\=\"0\" cellpadding\=\"0\">";

    foreach $TF (@TF)
    {
	print"<tr><td><a href\=\"http\:\/\/transfac\.gbf\.de\/cgi-bin\/qt\/getEntry\.pl\?$TF\">$TF<\/a>\; $TF_ID{$TF}\; $TF_position{$TF}\; $TF_type{$TF}<\/td><\/tr>\n";
	print "\n<\/td>\n<\/tr>\n";
    }
    print "<\/table><\/td><\/tr>\n";
}
if ($MIM_AC ne "")
{
print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">OMIM<\/td>\n<td><a href\=\"http\:\/\/www3\.ncbi\.nlm\.nih\.gov\/htbin-post\/Omim\/dispmim\?$MIM_AC\">$MIM_AC<\/a><\/td><\/tr>\n";
}
if ($MGD_AC ne "")
{
print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">MGD<\/td>\n<td><a href\=\"http\:\/\/www\.informatics\.jax\.org\/searches\/accession_report\.cgi\?id\=$MGD_AC\">$MGD_AC<\/a>\; $MGD_ID<\/td><\/tr>\n";
}
if ($FB_AC ne "")
{
print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">FLYBASE<\/td>\n<td><a href\=\"http\:\/\/fly\.ebi\.ac\.uk\:7081\/\.bin\/fbidq\.html\?$FB_AC\">$FB_AC<\/a>\; $FB_ID<\/td><\/tr>\n";
}
print "<\/table><\/td><\/tr>\n";
 print "<tr><td bgcolor\=\"\#F88017\"><table cellpadding\=\"0\"><tr><td><font color\=\"\#FFFFFF\"><b>References<\/b><\/font><\/td><\/tr><\/table><\/td><\/tr>\n<tr><td bgcolor\=\"\#CACAB9\"><table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";


foreach $number(@number)
{
 print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">$number<\/td>\n<td>MEDLINE\=<a href\=\"http\:\/\/www3\.ncbi\.nlm\.nih\.gov\/htbin-post\/Entrez\/query\?db\=m\&form\=6\&dopt\=r\&uid\=$med_number{$number}\">$med_number{$number}<\/a><br>$AUTHOR{$number}<br>$TITLE{$number}<br>$j_name{$number}  $volume{$number}\:$pages{$number}$issue{$number}<\/td><\/tr>\n";
}
print "<\/table><\/td><\/tr>\n";

 print "<tr><td bgcolor\=\"\#F88017\"><table cellpadding\=\"0\"><tr><td><font color\=\"\#FFFFFF\"><b>Sequence and methods used<\/b><\/font><\/td><\/tr><\/table><\/td><\/tr>\n<tr><td bgcolor\=\"\#CACAB9\"><table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";

 print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">METHODS<\/td>\n<td><table cellspacing\=\"0\" cellpadding\=\"0\">";

    foreach $ME (@ME)
    {
	print"<tr><td>$ME<\/td><\/tr>\n";
    }
    print "\n<\/table><\/td>\n<\/tr>\n";
print "<tr><td bgcolor\=\"\#FBB917\" nowrap\=\"nowrap\">SEQUENCE<\/td>\n<td bgcolor\=\"\#FBB917\" width\=\"100\%\"><center><tt>$up_seq<b>$down_seq<\/tt><\/center><\/b><\/td>\n<\/tr>\n";
    print "\n<\/table><\/td>\n<\/tr>\n";
 print "<tr><td bgcolor\=\"\#F88017\"><table cellpadding\=\"0\"><tr><td><font color\=\"\#FFFFFF\"><b>Promoter taxonomy<\/b><\/font><\/td><\/tr><\/table><\/td><\/tr>\n<tr><td bgcolor\=\"\#CACAB9\"><table border\=\"0\" width\=\"100\%\" cellpadding\=\"1\" cellspacing\=\"1\">\n";
foreach $tax_number (@tax_number)
{
    print"<tr bgcolor\=\"\#FFF8C6\"><td valign\=\"top\">$tax_number<\/td>\n<td>$tax_def{$tax_number}<\/td><\/tr>\n";
}
print "\n<\/td>\n<\/tr>\n";

    print "\n<\/table><\/td>\n<\/tr>\n";
 print "<tr><td bgcolor\=\"\#F88017\"><table cellpadding\=\"0\"><tr><td><font color\=\"\#FFFFFF\"><b>Keywords<\/b><\/font><\/td><\/tr><\/table><\/td><\/tr>\n<tr><td bgcolor\=\"\#CACAB9\"><table border\=\"0\" width\=\"100\%\" cellpadding\=\"2\" cellspacing\=\"1\">\n<tr bgcolor\=\"\#FFF8C6\"><td>";
foreach $KW (@KW)
{
    print"$KW ";
}
print"<\/td><\/tr>\n";
print "\n<\/table><\/td>\n<\/tr>\n";
print "\n<\/td>\n<\/tr>\n";
 print "<tr><td bgcolor\=\"\#F88017\"><table cellpadding\=\"0\"><tr><td><font color\=\"\#FFFFFF\"><b>Comments<\/b><\/font><\/td><\/tr><\/table><\/td><\/tr>\n<tr><td bgcolor\=\"\#CACAB9\"><table border\=\"0\" width\=\"100\%\" cellpadding\=\"2\" cellspacing\=\"1\">\n<tr bgcolor\=\"\#FFF8C6\"><td>$comment<\/td><\/tr>\n";
print "\n<\/table><\/td>\n<\/tr>\n";
print "\n<\/td>\n<\/tr>\n";
print "<\/table><\/td><\/tr>";
print "<\/table>";#<\/body><\/html>";


sub printHTMLHeader
  {
    print "<HTML><HEAD><TITLE>EPD-$record</TITLE></HEAD><BODY bgcolor\=\"FFFFFF\">";
    print "<H2>EPD - New Format</H2><HR>";
}


