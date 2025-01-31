#!/usr/bin/env perl

# handles EPD queries on /epd/index.html

use CGI;
use CGI::Carp qw (fatalsToBrowser);
use MyCGI;
#$form = new CGI ();
$form = new MyCGI;
&printCGIHeader ();
&printHTMLHeader ();
$db = $form->param ('database');
if ($db =~ /epd/)
{
    $epd = "/db/epd/current/epd.dat /db/epd/current/epd_bulk.dat";
    $db_name="EPD";
}

# we try to open the corresponding database

open ('EPD', "cat $epd |") or
    HTMLError ("Could not open $epd for reading: $!\n");

# $debug = 0;	# guess what this might be used for...

# this hash maps the form <SELECT> options  into two-letter field codes


################################################################
# get and check the query parameters



#	 array of query fields

$q_string = $form->param ('query_str');
# array of operators


# check for non-emptiness

if ($q_string eq "")  {
    HTMLError ("Please provide one query string");
}

#-------------------------------------------------------------
# DO QUERY
#-------------------------------------------------------------

@matches = ();	# will hold refs to arrays of matching IDs

# define entry delimiter:
if ($db =~ /epd/)
{
    $/ = "\n//";
}

$condition =  "/$q_string/i";


# edit query loop first then execute (to avoid eval within a loop)



if ($db =~ /epd/)
{
    $search  = " while (<EPD>)";
    $search .= " { (\$id) = /ID   (\\S+)/;";
    $search .= " if ($condition) { push \@matches , (\$id); }";
    $search .= " }";
}

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

print <<"TopPart";
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
    <title>$db_name Query Results</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <link rel="stylesheet" href="/css_epd/sib-expasy.min-20240214.css" type="text/css" media="screen" charset="utf-8">

<link rel="shortcut icon" href="/img_epd/favicon.ico" type="image/x-icon">
</head>

TopPart

$HEADER = "../htdocs/header.php";
open (HEADER) or die "Can't open the file!";
print <HEADER>;
close (HEADER);


# beginning of the query table

# Print resuln number
print "<p><b><font size=+1>Results: ";
print ((scalar (@matches) || "Sorry, no") .
       (@matches > 1 ? " entries" : " entry") .
       " found");
print "</font></b>";

# print the form
if ($db =~ /epd/)
{
print <<"ListHeader";

<H3>
  View selected as:</FONT></H3>
  <FORM action=query_result.pl method=GET>
  <INPUT type="radio" VALUE=text name=out_format> EPD entry (text only)</FONT><BR>
  <INPUT type="radio" VALUE=HTML name=out_format> EPD entry (html)</FONT><BR>
  <INPUT type="radio" VALUE=NICE name=out_format CHECKED> EPD entry (nice view)</FONT><BR>
  <INPUT type="radio" VALUE=XML name=out_format> EPD entry (xml)</FONT><BR>
  <INPUT type="radio" VALUE=EMBL name=out_format> Promoter sequence (EMBL format)<BR>
  <INPUT type="radio" VALUE=FASTA name=out_format> Promoter sequence (FASTA format)<BR>
  &nbsp;&nbsp; (for sequences only:) from position&nbsp;<INPUT type="text" name="from" size="5" value="-499">
                                    to&nbsp;<INPUT type="text" name="to"   size="5" value="100">
<H3>

Select entries</FONT></H3>

ListHeader
}

$entry_number=scalar(@matches);

if ($entry_number != 0){
    for($i=0; $i<$entry_number; $i++){
	print ("<input type=checkbox name=Entry_$i value=$matches[$i]>&nbsp;");
	print "<A href=\"/cgi-bin/miniepd/query_result.pl?out_format=NICE&from=-499&to=100&Entry_0=$matches[$i]\">$matches[$i]";
# Extract Species:
#	open (SPC, "fetch -c ../etc/fetch.conf epd:$matches[$i] |");
#	while (<SPC>) {
#	    $_ =~ s/\s+/ /g;
#	    my @descr = split(' ', $_);
#	    if ($descr[0] == 'DE'){
#		print ("$descr[1] $descr[2]");
#	    }
#	}
#	close (DESCRSPC);
	print "</a><br>";
    }
}else{
    print "No match found.<br>";
}

# bottom part (link to the page's top)

print <<"Bottom";
<br>
<INPUT type="submit" value="Submit"><INPUT type="reset" value="Clear">
</FONT>

Bottom


################################################################
# parting time

&printHTMLFooter ();
close ('EPD');
#open (FILE, ">wwwtmp/query_list.txt") || die('could not open file');
#print FILE "$condition\n";
#print FILE "------------ end of query ------\n";
#close(FILE);

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
      $FOOTER = "../htdocs/footer.html";
      open (FOOTER) or die "Can't open the file!";
      print <FOOTER>;
      close (FOOTER);

      print "</BODY></HTML>\n";
  }

sub HTMLError
  {
    my ($msg) = @_;

    printHTMLHeader ();
    print "Error: $msg";
    printHTMLFooter ();
    exit (1);
  }

sub showInput
  {
    print ("<PRE>");
    print ("Input data received:\n\n");

    print ("match = " . $form->param ('match') . "\n");
    print ("case_sensitive = " . $form->param ('case_sensitive') . "\n");
    print ("regexp = " . $form->param ('regexp') . "\n");
    print ("</PRE>");
  }

sub printResult
  {
    printHTMLHeader ();
    printHTMLFooter ();
  }
