#!/usr/bin/env perl

# handles EPD queries on /epd/epd_query_form.html

use CGI;
use CGI::Carp qw (fatalsToBrowser);
use MyCGI;
use IPC::Open2;
use Sys::Hostname;

if (hostname eq "ccg-serv01" || hostname =~ /epdnew/ ){
$bin="/usr/local/bin";
#$DB="/home/local/db"; # eventually generate local copy to increase speed?
$DB="/db";
$WWWTmpDir = '/var/tmp/daily';
}
elsif (hostname eq ""){
$bin="";
$DB="/db";
$WWWTmpDir = "/scratch/cluster/daily/www-ccg";
}

&printCGIHeader ();
&printHTMLHeader ();

$EPD = "$DB/epd/current/epd.dat $DB/epd/current/epd_bulk.dat";
$HELP = $DB."/miniepd/current/epd.usr";

# we try to open EPD

open ('EPD', "cat $EPD |") or
    HTMLError("Could not open $EPD for reading: $!\n");

# $debug = 0;	# guess what this might be used for...

# this hash maps the form <SELECT> options  into two-letter field codes

%help_hash = ('ID' => '\<\!--ID--\>',
	      'AccNumber' => '\<\!--AC--\>',
	      'Description' => '\<\!--DE--\>',
	      'Keywords' => '\<\!--KW--\>',
	      'Organism' => '\<\!--OS--\>',
              'Homology group' => '\<\!--HG--\>',
              'Alternative promoter' => '\<\!--AP--\>',
              'Sequence (pos. -49 to +10)' => '\<\!--SE--\>',
              'Taxonomy' => '\<\!--TX--\>',
	      'Authors' => '\<\!--RA--\>',
	      'Reference title' => '\<\!--RA--\>',
	      'Reference literature' => '\<\!--RA--\>',
              'CLEANEX ID or AC' => '\<\!--DR--\>',
	      'EMBL ID or AC' => '\<\!--DR--\>',
	      'FLYBASE ID' => '\<\!--DR--\>',
	      'MGI Accession ID' => '\<\!--DR--\>',
	      'OMIM number' => '\<\!--DR--\>',
	      'SWISS-PROT ID or AC' => '\<\!--DR--\>',
	      'TRANSFAC ID or AC' => '\<\!--DR--\>',
	      'RefSeq AC' => '\<\!--DR--\>',
	      'Unigene ID' => '\<\!--DR--\>',
              'Experiment Type Tag' => '\<\!--DO--\>',
	      'Promoter Type Tag' => '\<\!--TSS_assignment--\>',
              'Independent subset status (+ or -)' => '\<\!--HG--\>');



%code_hash = ('All Text' => '\n[A-Z]',
	      'ID' => '\nID',
	      'AccNumber' => '\nAC',
	      'Description' => '\nDE',
	      'Keywords' => '\nKW',
	      'Organism' => '\nOS',
              'Homology group' => '\nHG   Homology group ',
              'Alternative promoter' => '\nAP',
              'Sequence (pos. -49 to +10)' => '\nSE',
              'Taxonomy' => '\nTX',
              'Keywords' => '\nKW',
	      'Authors' => '\nRA',
	      'Reference title' => '\nRT',
	      'Reference literature' => '\nRL',
              'CLEANEX ID or AC' => '\nDR   CLEANEX',
	      'EMBL ID or AC' => '\nDR   EMBL',
	      'FLYBASE ID' => '\nDR   FLYBASE',
	      'MGI Accession ID' => '\nDR   MGD',
	      'OMIM number' => '\nDR   MIM',
	      'SWISS-PROT ID or AC' => '\nDR   SWISS-PROT',
	      'TRANSFAC ID or AC' => '\nDR   TRANSFAC',
	      'RefSeq AC' => '\nDR   RefSeq',
	      'UNIGENE ID' => '\nDR   UNIGENE',
              'Experiment Type Tag' => '\nDO        Experimental evidence: ',
	      'Promoter Type Tag' => '\nFP   [^\:]+\:[ |\+|\-]',
              'Independent subset status (+ or -)' => '\nFP   .{21}');



%ops_hash   = ('AND' => ' and ',
	      'OR' => ' or ',
	      'BUT NOT' => ' and not ');


################################################################
# get and check the query parameters

#$form = new CGI ();
$form = new MyCGI;

#	 array of query fields



# array of query strings

@q_strings = ($form->param ('query_str_1'),
	      $form->param ('query_str_2'),
	      $form->param ('query_str_3'),
	      $form->param ('query_str_4'));

# array of operators

@q_ops = ("",
	  $ops_hash{$form->param ('query_operator_2')},
	  $ops_hash{$form->param ('query_operator_3')},
	  $ops_hash{$form->param ('query_operator_4')});


if ($form->param ('epd_query')         eq "HELP")
{
    local $/ = "\<\!--SECTION--\>";
    @q_fields = ($form->param ('query_field_1'),
 	     $form->param ('query_field_2'),
 	     $form->param ('query_field_3'),
 	     $form->param ('query_field_4'));
    open ('HELP', "< $HELP") or
    HTMLError ("Could not open $HELP for reading: $!\n");
    $ref="";
    $preprint="";

    # define entry delimiter:
    print_top();
    print"<CENTER>\n<B><H3><FONT COLOR=\"\#993399\" SIZE=+3>\nEPD Database: Help Page</FONT></H3></B>The information below is extracted from the EPD <a href=\"/miniepd/current/usrman.html\">User Manual</a></center>\n<HR SIZE=2 WIDTH=\"70%\">\n<H3>Help topics :</H3>\n";
    while (<HELP>)
    {
	foreach $q_fields(@q_fields)
	{

	    s/(\n[\d\.]+)//;
	    if ($q_fields ne "All Text")
	    {
		if (/$help_hash{$q_fields}/)
		{
		    $print{$q_fields}.=$_;
		}
	    }
	}
    }
    close (HELP);
print "<OL>\n";
foreach $q_fields(@q_fields)
    {
	if ($q_fields ne "All Text")
	{
	    print "<LI>$print{$q_fields}<\/LI><BR>\n";
	}
    }
    print "<\/OL>\n<\/BODY><\/HTML>";

}
#-------------------------------------------------------------
# DO QUERY
#-------------------------------------------------------------
else
{
# check for non-emptiness

if (    $q_strings[ 0 ] eq "" and $q_strings[ 1 ] eq ""
    and $q_strings[ 2 ] eq "" and $q_strings[ 3 ] eq "")  {
    HTMLError ("Please provide at least one query string");
}

@q_fields = ($code_hash{$form->param ('query_field_1')},
 	     $code_hash{$form->param ('query_field_2')},
 	     $code_hash{$form->param ('query_field_3')},
 	     $code_hash{$form->param ('query_field_4')});

# regexp, case-sensitive ?

if ($form->param ('regexp')         eq "yes") {$re = "y"}
if ($form->param ('case_sensitive') ne "yes") {$cs = "i"}


@matches = ();	# will hold refs to arrays of matching IDs

# define entry delimiter:

$/ = "\n//";

# compose query condition:

for ($i=0;$i < scalar (@q_strings);$i++){
    $q_strings[$i] =~s/\+/\\\+/;
    if (@q_fields[$i] =~ /\Q\nFP   .{21}\E/){ #  exception for 'Independent subset status'
	if ($q_strings[$i]  eq '+'){
	    $q_strings[$i] = "\+";
	}
    }
    elsif ($re ne "y"){         # quote unless selected regular expression
	$q_string[$i] = quotemeta ($q_string[$i]);
    }
#print_top();
#print $form->param ('query_field_1'),"|",$form->param ('query_str_1'),"|",@q_fields[$i],"|$i|@q_strings<br>";
#exit;
}

if (@q_strings[0] eq "") {
        $condition = "1"
    } else {
	if (@q_fields[0] =~ /DO     /)
	{
	    $condition =  "/@q_fields[0]\(.+\,\)?@q_strings[0]\[^\\d\]/$cs";
	}
	elsif (@q_fields[0] =~ /FP   /)
	{
	    $condition =  "/@q_fields[0]@q_strings[0]/$cs";
	}
	elsif (@q_fields[0] =~ /HG   /)
	{
	    $condition =  "/@q_fields[0]@q_strings[0];/$cs";
	}
	else
	{
	    $condition =  "/@q_fields[0].+@q_strings[0]/$cs";
	}
    }

for ($i = 1; $i < 4; $i++) { # 1 intentional
    if (@q_strings[$i] ne "")
    {
	if (@q_fields[$i] =~ /DO     /)
	{
	    $condition =  "(" . $condition . ") @q_ops[$i] (/@q_fields[$i]\(.+\,\)?@q_strings[$i]\[^\\d\]/$cs)";
	}
	elsif (@q_fields[$i] =~ /FP   /)
	{
	    $condition = "(" . $condition . ") @q_ops[$i] (/@q_fields[$i]@q_strings[$i]/$cs)";
	}
	elsif (@q_fields[$i] =~ /HG   /)
	{
	    $condition =  "(" . $condition .") @q_ops[$i] (/@q_fields[$i]@q_strings[$i];/$cs)";
	}
	else
	{
	    $condition = "(" . $condition . ") @q_ops[$i] (/@q_fields[$i].+@q_strings[$i]/$cs)";
	}
    }
}

# edit query loop first then execute (to avoid eval within a loop)

$search  = " while (<EPD>)";
$search .= " { (\$id) = /\nID   (\\S+)/;(\$ac\{\$id\}) = /\nAC   (EP\[\^\\;\]+)/;(\$desc\{\$id\}) = /\nDE  (.*)/;";
$search .= " if ($condition) { push \@matches , (\$id); }";
$search .= " }";

eval $search;

# a few debugging statements
#
# print "<pre>";
# foreach $match (@matches) {
#    print "$match\n";
# }
# print "$condition\n";
# print "$search\n";
# print "<pre>";
print_top();
print"<center><A NAME=\"top\"></A><B><FONT COLOR=\"\#993399\"><FONT SIZE=+3>\nEPD Database: Query Results</FONT></FONT></center>\n<hr size=2 width=\"70%\">\n<H3><FONT SIZE=+2>Query:</FONT></font></H3>\n";
print <<"TableHeader";
<TABLE BORDER CELLPADDING=3 COLS=3 WIDTH="80%" NOSAVE >
<TR>
<TH class="sib_header_red" style='font-size: 16px'>&nbsp<TH class="sib_header_red" style='font-size: 16px'><B>Fields</FONT></B><TH class="sib_header_red" style='font-size: 16px'><B>Search strings</FONT></B>
<TT>
TableHeader

# conditionally print table rows (only for nonempty queries)

print ("<TR><TD>&nbsp;" .
    "<TD>" . $form->param('query_field_1') . "<TD>" . $form->param('query_str_1'))
    unless $q_strings[ 0 ] eq "";
print ("<TR><TD>" . $form->param('query_operator_2') .
    "<TD>" . $form->param('query_field_2') . "<TD>" . $form->param('query_str_2'))
    unless $q_strings[ 1 ] eq "";
print ("<TR><TD>" . $form->param('query_operator_3') .
    "<TD>" . $form->param('query_field_3') . "<TD>" . $form->param('query_str_3'))
    unless $q_strings[ 2 ] eq "";
print ("<TR><TD>" . $form->param('query_operator_4') .
    "<TD>" . $form->param('query_field_4') . "<TD>" . $form->param('query_str_4'))
    unless $q_strings[ 3 ] eq "";
print ("</TR></TABLE>");


print "<P style='font-size: 14px'><B>Perl expression used:</FONT></B> ";
print "<tt>$condition</tt>";
print "<P style='font-size: 14px'><B>Results:</FONT></B> ";
print ((scalar (@matches) || "Sorry, no") .
       (@matches > 1 ? " entries" : " entry") .
       " found.<BR></b><p style='font-size: 12px'>Sequence and entry download is limited to ~400 entries!<BR> for large sequence sets, please use the <A href=\"/miniepd/seq_download.html\">sequence download page</a> ");

# print the form

print <<"ListHeader";
<FORM action=query_result.pl method=POST>
<HR>
<H3><table cellpadding=5 cellspacing=0 border=1 width=100%>
  <tr><th class="sib_header_red" colspan=3 style='font-size: 16px'><font color="#ffffff"><b>Select one of the following options</b></th></tr>
  <tr>
   <th class="sib_header_red" style='font-size: 16px'><font color="#ffffff">Entry format</font></th> <th class="sib_header_red" style='font-size: 16px'><font color="#ffffff">Promoter Sequence format</font></th> <th class="sib_header_red" style='font-size: 16px'><font color="#ffffff">Sequence Analysis</font></font></th>
  </tr>
  <tr bgcolor="#F2F2F2">
      <td valign=top>
      <TABLE CELLPADDING=0 CELLSPACING=5 BORDER=0 WIDTH=100%>
        <TR>
	  <TD>
	  <INPUT type="radio" VALUE=text name=out_format CHECKED>TEXT
	  </TD>
	</TR>
	<TR>
	  <TD>
	  <INPUT type="radio" VALUE=HTML name=out_format>HTML
	  </TD>
	</TR>
	<TR>
	  <TD>
	  <INPUT type="radio" VALUE=NICE name=out_format> NICE view
	  </TD>
	</TR>
	<TR>
	  <TD>
	  <INPUT type="radio" VALUE=XML name=out_format> XML (download)
	  </TD>
	</TR>
      </TABLE>
      </td>
      <td valign=top>
      <TABLE CELLPADDING=0 CELLSPACING=5 BORDER=0 WIDTH=100%>
	<TR>
	  <TD>
	 <INPUT type="radio" VALUE=EMBL name=out_format>EMBL
	  </TD>
	</TR>
	<TR>
	  <TD>
	 <INPUT type="radio" VALUE=FASTA name=out_format>FASTA
	  </TD>
	</TR>
	<TR>
	   <TD>
	   &nbsp;&nbsp;&nbsp;from position&nbsp;<INPUT type="text" name="from" size="5" value="-499">
                                    to&nbsp;<INPUT type="text" name="to"   size="5" value="100">
	   </TD>
	  </TR>
      </TABLE>
    </td>
    <td valign=top>
      <TABLE CELLPADDING=0 CELLSPACING=5 BORDER=0 WIDTH=100%>
        <TR>
	  <TD>
	     <INPUT type="radio" VALUE=SSA_cpr name=out_format><!A HREF="https://epd.expasy.org/ssa/cpr.html"><i>Generation of a Constraint Profile</i></A>
	</TR>
	<TR>
	  <TD>
	    <INPUT type="radio" VALUE=SSA_slist name=out_format><!A HREF="https://epd.expasy.org/ssa/slist.html"><i>Generation of a Signal List</i></A>
	  </TD>
	</TR>
        <TR>
          <TD>
	     <INPUT type="radio" VALUE=SSA_oprof name=out_format><!A HREF="https://epd.expasy.org/ssa/oprof.html"><i>Generation of a Signal Occurrence Profile</i></A>
	  </TD>
	</TR>
        <TR>
          <TD>
	     <INPUT type="radio" VALUE=SSA_findm name=out_format><!A HREF="https://epd.expasy.org/ssa/findm.html"><i>Find Motifs around the Transcription Start Sites</i></A>
	  </TD>
	</TR>
	<TR>
	  <TD>
	   <INPUT type="radio" VALUE=GC name=out_format> GC-content plot<BR>
	   &nbsp;&nbsp;&nbsp;from position&nbsp;<INPUT type="text" name="gc_from" size="5" value="-499">
                                    to&nbsp;<INPUT type="text" name="gc_to"   size="5" value="100">
	  </TD>
	</TR>
      </TABLE>
    </TD>
</TR>
</TABLE>


<H3>
Select entries</FONT></H3>
<P>
<INPUT type="submit" value="Submit"><P>

ListHeader

    $entry_number=scalar(@matches);

$i = 0;
print ("<input type=checkbox name=Entry_0 value=$ac{$matches[0]} CHECKED>&nbsp;");
print "<A href=\"get_doc?db=epd&format=nice&entry=$matches[0]\">$matches[0]</a> \:$desc{$matches[0]}";
print ("\n<br>");
for($i=1;$i<$entry_number;$i++)
{
    print ("<input type=checkbox name=Entry_$i value=$ac{$matches[$i]} >&nbsp;");
    print "<A href=\"get_doc?db=epd&format=nice&entry=$matches[$i]\">$matches[$i]</a> \:$desc{$matches[$i]}";
    print ("\n<br>");
}

# bottom part (link to the page's top)
print <<"Bottom";
<P>
<INPUT type="submit" value="Submit"><!--INPUT type="reset" value="Clear"-->
</FONT>
<HR>
Bottom

}
#-------------------------------------------------------
# OUTPUT Section
#-------------------------------------------------------

# showInput ();

# top of the page

sub print_top{

print <<"TopPart";
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
    <TITLE>EPD query results</TITLE></HEAD>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <link rel="stylesheet" href="/css_epd/sib-expasy.min-20240214.css" type="text/css" media="screen" charset="utf-8">

    <link rel="shortcut icon" href="/img_epd/favicon.ico" type="image/x-icon">
</head>
<body>
<div id='sib_top'><a name='TOP'></a></div>
<div id='sib_container'>
  <div id='sib_header_medium'>
     <div id='sib_other_logo'>
       <img src = '/img_epd/EPD_rabbit_03.png' alt = 'EPD' height = '75' >
     </div>

     <div  id = 'sib_title'>
       <h1><a name="top"></a>EPD Query Results</h1>
     </div>

   </div>

<!-- END OF HEADER -->
<!-- ********************************************************************************************** -->
<div id='sib_body'>

TopPart
}
# beginning of the query table



################################################################
# parting time

&printHTMLFooter ();
close ('EPD');
#open (FILE, ">>query_list.txt") || die('could not open file');
open (FILE, ">>$WWWTmpDir/query_list_$$") || die("Could not open file $WWWTmpDir/query_list_$$: $!");
print FILE "$condition\n";
print FILE "------------ end of query ------\n";
close(FILE);

exit (0);


################################################################
# HTML subroutines

# Yes, I know, the CGI module has all the needed methods for much of
# this and more, but I wrote these before I was aware of the fact. And
# since it works, it's going to stay that way. :-)

sub printCGIHeader
  {
    print "Content-type: text/html\n\n";
  }


sub printHTMLHeader
  {

  }

sub printHTMLFooter
  {
    print "</font></div> <!-- sib_body --></font>
<div id='sib_last_update'>Last update 11 Oct. 2010</div>
<div id='sib_footer'>
  <div id='sib_footer_content'>
    <a href='./funders.php'>Funders</a>
    | <a href='./privacy-notice.php'>Privacy Notice</a>
    | <script>eval(unescape('%66%75%6E%63%74%69%6F%6E%20%73%65%62%5F%74%72%61%6E%73%70%6F%73%65%32%31%32%33%28%68%29%20%7B%76%61%72%20%73%3D%27%61%6D%6C%69%6F%74%61%3A%6B%73%65%2D%64%70%67%40%6F%6F%6C%67%67%65%6F%72%70%75%2E%73%6F%63%6D%27%3B%76%61%72%20%72%3D%27%27%3B%66%6F%72%28%76%61%72%20%69%3D%30%3B%69%3C%73%2E%6C%65%6E%67%74%68%3B%69%2B%2B%2C%69%2B%2B%29%7B%72%3D%72%2B%73%2E%73%75%62%73%74%72%69%6E%67%28%69%2B%31%2C%69%2B%32%29%2B%73%2E%73%75%62%73%74%72%69%6E%67%28%69%2C%69%2B%31%29%7D%68%2E%68%72%65%66%3D%72%3B%7D%64%6F%63%75%6D%65%6E%74%2E%77%72%69%74%65%28%27%3C%61%20%68%72%65%66%3D%22%23%22%20%6F%6E%4D%6F%75%73%65%4F%76%65%72%3D%22%6A%61%76%61%73%63%72%69%70%74%3A%73%65%62%5F%74%72%61%6E%73%70%6F%73%65%32%31%32%33%28%74%68%69%73%29%22%20%6F%6E%46%6F%63%75%73%3D%22%6A%61%76%61%73%63%72%69%70%74%3A%73%65%62%5F%74%72%61%6E%73%70%6F%73%65%32%31%32%33%28%74%68%69%73%29%22%3E%43%6F%6E%74%61%63%74%20%55%73%3C%2F%61%3E%27%29%3B'));</script><noscript>ask-epd [AT] googlegroups.com</noscript>

    <div id='sib_footer_right'>
      <a href='#TOP' id='sib_footer_gototop'>
        <span style='padding-left: 10px'>Back to the Top</span>
      </a>
    </div>
  </div>
</div>
</BODY></HTML>\n";
  }

sub HTMLError
  {
    my ($msg) = @_;

    printHTMLHeader ();
    print "Error: $msg";
    printHTMLFooter ();
    exit (1);
  }

sub printConstructionWarning
  {
    print ("<CENTER>&nbsp;This page is under construction,\n");
    print ("you can use the ISREC-TRADAT Database Entry Server at the address:\n");
    print ("/miniepd/doc_server.html\n");
    print ("</FONT></FONT></CENTER>\n");
    print ("<HR>\n");
  }

sub showInput
  {
    print ("<PRE>");
    print ("Input data received:\n\n");

    print ("Fields: " . join (", ", @q_fields) . "\n");
    print ("Strings: " . join (", ", @q_strings) . "\n");


    print ("query_operator_3 = $query_operator_3\n");
    print ("query_operator_2 = $query_operator_2\n");
    print ("query_operator_4 = $query_operator_4\n");

    print ("match = " . $form->param ('match') . "\n");
    print ("case_sensitive = " . $form->param ('case_sensitive') . "\n");
    print ("regexp = " . $form->param ('regexp') . "\n");
    print ("</PRE>");
  }

sub printResult
  {
    printHTMLHeader ();
    print join (', ', @result);
    printHTMLFooter ();
  }

