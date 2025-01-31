#!/usr/bin/env perl

# handles EPD queries on /epd/epd_query_form.html

use CGI;
use CGI::Carp qw (fatalsToBrowser);
use MyCGI;

&printCGIHeader ();
&printHTMLHeader ();

$EPD = "/db/epd/current/epd.dat";

# we try to open EPD

open ('EPD', "< $EPD") or
    HTMLError ("Could not open $EPD for reading: $!\n");

# $debug = 0;	# guess what this might be used for...

# this hash maps the form <SELECT> options  into two-letter field codes

%code_hash = ('All Text' => '\n[A-Z]',
	      'ID' => '\nID',
	      'AccNumber' => '\nAC',
	      'Description' => '\nDE',
	      'Keywords' => '\nKW',
	      'Organism' => '\nOS',
              'Homology group' => '\nHG',
              'Sequence' => '\nSE',
              'Taxonomy' => '\nTX',
              'Keywords (limited)' => '\nKW',
	      'Authors' => '=\nRA',
	      'Reference title' => '\nRT',
	      'Reference literature' => '\nRL',
	      'EMBL ID or AC' => '\nDR   EMBL',
	      'FLYBASE ID' => '\nDR   FLYBASE',
	      'MGI Accession ID' => '\nDR   MGD',
	      'OMIM number' => '\nDR   MIM',
	      'SWISS-PROT ID' => '\nDR   SWISS-PROT',
	      'TRANSFAC ID' => '\nDR   TRANSFAC');


%ops_hash   = ('AND' => ' and ',
	      'OR' => ' or ',
	      'BUT NOT' => ' and not ');


################################################################
# get and check the query parameters

#$form = new CGI ();
$form = new MyCGI;

#	 array of query fields

@q_fields = ($code_hash{$form->param ('query_field_1')},
 	     $code_hash{$form->param ('query_field_2')},
 	     $code_hash{$form->param ('query_field_3')},
 	     $code_hash{$form->param ('query_field_4')});

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

# check for non-emptiness

if (    $q_strings[ 0 ] eq "" and $q_strings[ 1 ] eq ""
    and $q_strings[ 2 ] eq "" and $q_strings[ 3 ] eq "")  {
    HTMLError ("Please provide at least one query string");
}

# regexp, case-sensitive ?

if ($form->param ('regexp')         eq "yes") {$re = "y"}
if ($form->param ('case_sensitive') ne "yes") {$cs = "i"}

#-------------------------------------------------------------
# DO QUERY
#-------------------------------------------------------------

@matches = ();	# will hold refs to arrays of matching IDs

# define entry delimiter:

$/ = "\n//";

# compose query condition:

if ($re ne "y") {
    foreach $q_string (@q_strings) {
        $q_string = quotemeta ($q_string);
    }
}

if (@q_strings[0] eq "") {
        $condition = "1"
    } else {
        $condition =  "/@q_fields[0].*@q_strings[0]/$cs"
}

for ($i = 1; $i < 4; $i++) { # 1 intentional
    if (@q_strings[$i] ne "") {
        $condition = "(" . $condition . ") @q_ops[$i] /@q_fields[$i].*@q_strings[$i]/$cs";
    }
}

# edit query loop first then execute (to avoid eval within a loop)

$search  = " while (<EPD>)";
$search .= " { (\$id) = /\nID   (\\S+)/;";
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

#-------------------------------------------------------
# OUTPUT Section
#-------------------------------------------------------

# showInput ();

# top of the page

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
         <img src = '/icons/EPD_rabbit_03.png' alt = 'EPD' height = '75' >
      </div>

      <div  id = 'sib_title'>
        <h1><a name="top"></a>EPD Query Results</h1>
      </div>

   </div>

<!-- END OF HEADER -->
<!-- ********************************************************************************************** -->
<div id='sib_body'>

<h1 align=center><A NAME="top"></A><B><FONT COLOR="#993399"><FONT SIZE=+4>
EPD Database: Query Results</FONT></FONT></H1>
<hr size=2 width="70%">


<H3><FONT SIZE=+3>Query:</FONT></font></H3>
TopPart

# beginning of the query table

print <<"TableHeader";
<TABLE BORDER CELLPADDING=3 COLS=3 WIDTH="70%" NOSAVE >
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


print "<p style='font-size: 14px'><b>Perl expression used:</font></b> ";
print "<tt>$condition</tt>";
print "<p style='font-size: 14px'><b>Result:</b></font></b> ";
print ((scalar (@matches) || "Sorry, no") .
       (@matches > 1 ? " entries" : " entry") .
       " found.");

# print the form

print <<"ListHeader";

<HR>
<H3>
  Choose output format:</FONT></H3>
  <FORM action=query_result.pl method=GET>
  <INPUT type="radio" VALUE=text name=out_format CHECKED> EPD entry (text only)</FONT><BR>
  <INPUT type="radio" VALUE=HTML name=out_format> EPD entry (html)</FONT><BR>
  <INPUT type="radio" VALUE=EMBL name=out_format> Promoter sequence (EMBL format)<BR>
  <INPUT type="radio" VALUE=FASTA name=out_format> Promoter sequence (FASTA format)<BR>
  &nbsp;&nbsp; (for sequences only:) from position&nbsp;<INPUT type="text" name="from" size="5" value="-499">
                                    to&nbsp;<INPUT type="text" name="to"   size="5" value="100">
<H3>
Select entries</FONT></H3>

ListHeader

$i = 0;
foreach (@matches)
  {
    print ("<input type=checkbox name=Entry_$i value=$_>&nbsp;");
    print "<A href=\"/cgi-bin/miniepd/doc_server.pl?doc_type=epd/h&entry=$_\">$_</a>";
    print ("\n<br>");
    $i++;
  }

# bottom part (link to the page's top)

print <<"Bottom";
<P>
<INPUT type="submit" value="Submit"><INPUT type="reset" value="Clear">
</FONT>
<HR>
Bottom


################################################################
# parting time

&printHTMLFooter ();
close ('EPD');
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


960939609396093960939609396093960939609396093960939609396093
