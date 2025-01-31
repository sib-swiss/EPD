#!/usr/bin/env perl
#use CGI::Carp qw(fatalsToBrowser);
use strict;


my %FORM;
my %chr_key;
my @seq;
my $start_pos;
my $end_pos;
my $g_id;
my $t_id;
my $g_symbol;
my $chr;
my $strand;
my $start;
my $stop;
my @fps_lines;
my @gene_symbols;
my $unique = int(rand(10000));
#my $link_file = "../htdocs/epdnew/biomart/mart_link.txt";
my $fps_temp = "wwwtmp/fps".$unique.".temp";
my $fps_tmp = "wwwtmp/epd_query".$unique.".fps";
my $sga_tmp = "wwwtmp/epd_query".$unique.".sga";
my $fa_tmp = "wwwtmp/epd_query".$unique.".fa";
my $fps_file;
my $database;
my @description;
my $description;
my $description_file;
my $tss_n = 1;
my $display = "none";
my $field;
my $field2;
my $count = 0;
my @page;
my $dat_file;

if ($ENV{'REQUEST_METHOD'} eq 'POST') {
    read(STDIN, my $buffer, $ENV{'CONTENT_LENGTH'});
    my @pairs = split(/&/, $buffer);
    foreach my $pair (@pairs) {
	(my $name, my $value) = split(/=/, $pair);
	#$value =~ tr/+/ /;
	$value =~ s/;//;
	$FORM{$name} = $value;
    }

    &printCGIHeader;

    if ($FORM{"query_db"} eq "ens"){
	$fps_file = "/local/ftp/epdnew/ENSEMBL/human/current/Hs_ENSEMBL.fps";
	$dat_file = "/local/ftp/epdnew/ENSEMBL/human/current/Hs_ENSEMBL.dat";
	$database = "ENSEMBL";
	$field = '$1';
	$field2 = '$1';
    }elsif ($FORM{"query_db"} eq "mm.ens"){
	$fps_file = "/local/ftp/epdnew/ENSEMBL/mouse/current/Mm_ENSEMBL.fps";
	$dat_file = "/local/ftp/epdnew/ENSEMBL/mouse/current/Mm_ENSEMBL.dat";
	$database = "ENSEMBL";
	$field = '$1';
	$field2 = '$1';
    }elsif ($FORM{"query_db"} eq "dm.ens"){
	$fps_file = "/local/ftp/epdnew/ENSEMBL/drosophila/current/Dm_ENSEMBL.fps";
	$dat_file = "/local/ftp/epdnew/ENSEMBL/drosophila/current/Dm_ENSEMBL.dat";
	$database = "ENSEMBL";
	$field = '$1';
	$field2 = '$1';
    }elsif ($FORM{"query_db"} eq "epdnew"){
	$fps_file = "./ftp/epdnew/human/current/Hs_EPDnew.fps";
	$dat_file = "./ftp/epdnew/human/current/Hs_EPDnew.dat";
	$database = "EPD New";
	$field = '$3';
	$field2 = '$2';
    }elsif ($FORM{"query_db"} eq "mm.epdnew"){
	$fps_file = "./ftp/epdnew/mouse/current/Mm_EPDnew.fps";
	$dat_file = "./ftp/epdnew/mouse/current/Mm_EPDnew.dat";
	$database = "EPD New";
	$field = '$3';
	$field2 = '$2';
    }elsif ($FORM{"query_db"} eq "dm.epdnew"){
        $fps_file = "./ftp/epdnew/drosophila/current/Dm_EPDnew.fps";
        $dat_file = "./ftp/epdnew/drosophila/current/Dm_EPDnew.dat";
        $database = "EPD New";
        $field = '$3';
        $field2 = '$2';
    }elsif ($FORM{"query_db"} eq "dr.epdnew"){
        $fps_file = "./ftp/epdnew/zebrafish/current/Dr_EPDnew.fps";
        $dat_file = "./ftp/epdnew/zebrafish/current/Dr_EPDnew.dat";
        $database = "EPD New";
        $field = '$3';
        $field2 = '$2';
    }elsif ($FORM{"query_db"} eq "epd"){
	$fps_file = "/local/ftp/epd/current/epd.fps";
	$dat_file = "/local/ftp/epd/current/epd.dat /local/ftp/epd/current/epd_bulk.dat";
	$database = "EPD New";
	$field = '$3';
	$field2 = '$2';
    }
#    $description_file = "../htdocs/epdnew/biomart/mart_gene_description_long.txt";

    open(FPSTMP, '>', $fps_temp);

    my @ensembl_ids_temp = split (/%0D%0A/, $FORM{"query_str"});
    my @ensembl_ids = uniq(@ensembl_ids_temp);
    my $hits = $#ensembl_ids + 1;
    if ($hits < 100){
	$display = "block";
    }
    if ($ensembl_ids[1] =~ m/ENSG([0-9])+/ || $ensembl_ids[1] =~ m/NP_([0-9])+/){
	$display = "none";
    }

    # If query id IDs do not print selection of hits:
    if ($FORM{"query_db"} eq "epd"){
	# this div is printed in the header
	#push(@page, "<div id='genes' >");
 	push(@page, "<FORM id='result' action=query_result.pl method=GET target='_blank'>");
    }else{
	#push(@page, "<div id='genes' >");
	push(@page, "<form id='result' action='./download_biomart.cgi' method='POST' target='_blank'>");
    }

    push(@page, "<table align=\"left\" style=\"width: 99%; font-size: 12px; font-family: Helvetica;\" border=\"0\">");
    push(@page, "<tr align=\"left\" style=\"background-color: #D7DFE2;\">");
    push(@page, "<td align=\"center\" style=\"max-width:10px;\"><input type='checkbox' name='checkall' checked='checked' onclick='checkedAll();'></td>");
    push(@page, "<td align=\"center\" style=\"max-width:50px;\"><b>Prom. ID</b></td>");
    push(@page, "<td align=\"center\"><b>Description</b>");
    push(@page, "<td align=\"center\"><b>TSS</b></td>");
    push(@page, "<td align=\"center\"></td>");
    push(@page, "<td align=\"center\"></td></tr>");

    foreach my $ensembl_id (@ensembl_ids){
	chomp $ensembl_id;
	my @fields = split('\+', $ensembl_id);
	$ensembl_id =~ s/\+/ /g;
	if ($ensembl_id ne ""){
	    my $command;
	    # build the query:
	    my $query = '$0 ~ "'.$fields[0].'"';
	    for (my $k = 1; $k < scalar(@fields); $k++){
		$query .= ' && $0 ~ "'.$fields[$k].'" ';
	    }
	    $command = "cat $dat_file | awk 'BEGIN{ IGNORECASE=1; RS=\"//\"; } $query { print \$0 }'";
#	    print $command;
	    my @output = `$command`;
	    my $id;
	    my @ids;
	    my %description;

	    foreach my $line (@output){
		chomp $line;
		if ($line =~ m/^ID/ && $FORM{"query_db"} =~ /epd/){
		    ($id) = $line =~ /^ID\s{3}([\S]+)/;
		    push(@ids, $id);
		    undef $description;
		}elsif ($line =~ m/^GN   Name=/ && $FORM{"query_db"} =~ /ens/){
		    ($id) = $line =~ /^GN   Name=([\S]+);/;
		    push(@ids, $id);
		    undef $description;
		    undef $description{$id};
		}elsif ($line =~ m/^OS/ && $FORM{"query_db"} eq 'epd'){
		    ($description) = $line =~ /^OS\s{3}(.+)\./;
		    $description{$id} .= " [".$description."]";
		}elsif ($line =~ m/^DE/){
		    ($description) = $line =~ /^DE\s{3}(.+)/;
		    $description{$id} .= " ".$description;
		}
	    }
	    my @uniq_ids = sort(uniq(@ids));

	    foreach my $uniq_id (@uniq_ids){
		# Grep the number of TSS
		$command = "awk \'\$2 == \"$uniq_id\" {print \$6}\' $fps_file | sort | uniq | wc -l";
		#$command = "grep -c \"Name=$uniq_id\" $dat_file";
		$tss_n = `$command`;


		if ($FORM{"query_db"} eq "epd"){
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"Entry_$count\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/query_result.pl?out_format=NICE&from=-499&to=100&Entry_0=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">1</td></tr>");
		    $count++;

		}elsif($FORM{"query_db"} eq "epdnew"){
		    $count++;
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_hg&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">1</td>");
		    push(@page, "<td align=\"center\" width='15'><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_hg&format=genome&entry=$uniq_id\" title='Text view'> <img border='0' bordercolor='black' src='/miniepd/icons/Text_small.png' alt='T' width='15' height='15'> </a> </td>");
# get the coordinates to be used in the GB link:
		    my $outputCoord = &get_coordinates($uniq_id, "epdnew");
		    (my $genome, my $chromosome , my $start) = split(/ /, $outputCoord);
		    $start -= 1000;
		    my $stop = $start + 2000;
		    push(@page, "<td align=\"center\" width='20'> ");
		    push(@page, "<a href =\"");
		    push(@page, "https://genome.ucsc.edu/cgi-bin/hgTracks?hgS_doOtherUser=submit&hgS_otherUserName=rdreos&hgS_otherUserSessionName=hg19_epdnew");
		    #push(@page, "&clade=mammal&org=Human");
		    #push(@page, "&db=hg18&position=$chromosome:$start-$stop");
		    push(@page, "&position=$chromosome:$start-$stop");
		    #push(@page, "&hgt.customText=https://epd.expasy.org/miniepd/ucsc/hg18.wig");
		    push(@page, "\" title='Genome Browser view'> <img border='0' bordercolor='black' src='/miniepd/icons/GB_small.png' width='20' height='15'> </></td></tr>");

		}elsif($FORM{"query_db"} eq "mm.epdnew"){
		    $count++;
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_mm&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">1</td>");
		    push(@page, "<td align=\"center\" width='15'><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_mm9&format=genome&entry=$uniq_id\" title='Text view'> <img border='0' bordercolor='black' src='/miniepd/icons/Text_small.png' alt='T' width='15' height='15'> </a> </td>");
# get the coordinates to be used in the GB link:
		    my $outputCoord = &get_coordinates($uniq_id, "mm.epdnew");
		    (my $genome, my $chromosome , my $start) = split(/ /, $outputCoord);
		    $start -= 1000;
		    my $stop = $start + 2000;
		    push(@page, "<td align=\"center\" width='20'> ");
		    push(@page, "<a href =\"");
		    push(@page, "https://genome.ucsc.edu/cgi-bin/hgTracks?");
		    push(@page, "&clade=mammal&org=Mouse");
		    push(@page, "&db=mm9&position=$chromosome:$start-$stop");
		    push(@page, "&hgt.customText=https://epd.expasy.org/miniepd/ucsc/mm9.wig");
		    push(@page, "\" title='Genome Browser view'> <img border='0' bordercolor='black' src='/miniepd/icons/GB_small.png' width='20' height='15'> </></td></tr>");

                }elsif($FORM{"query_db"} eq "dm.epdnew"){
                    $count++;
                    push(@page, "<tr align=\"left\" class='fetch'>");
                    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
                    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_dm&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
                    push(@page, "<td>$description{$uniq_id}</td>");
                    push(@page, "<td align=\"center\">1</td>");
		    push(@page, "<td align=\"center\" width='15'><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_dm&format=genome&entry=$uniq_id\" title='Text view'> <img border='0' bordercolor='black' src='/miniepd/icons/Text_small.png' alt='T' width='15' height='15'> </a> </td>");
# get the coordinates to be used in the GB link:
		    my $outputCoord = &get_coordinates($uniq_id, "dm.epdnew");
		    (my $genome, my $chromosome , my $start) = split(/ /, $outputCoord);
		    $start -= 1000;
		    my $stop = $start + 2000;
		    push(@page, "<td align=\"center\" width='20'> ");
		    push(@page, "<a href =\"");
		    push(@page, "https://genome.ucsc.edu/cgi-bin/hgTracks?");
		    push(@page, "&clade=insect&org=D.+melanogaster");
		    push(@page, "&db=dm3&position=$chromosome:$start-$stop");
		    push(@page, "&hgt.customText=https://epd.expasy.org/miniepd/ucsc/dm3_test.wig");
		    push(@page, "\" title='Genome Browser view'> <img border='0' bordercolor='black' src='/miniepd/icons/GB_small.png' width='20' height='15'> </></td></tr>");
                }elsif($FORM{"query_db"} eq "dr.epdnew"){
                    $count++;
                    push(@page, "<tr align=\"left\" class='fetch'>");
                    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
                    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_dr&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
                    push(@page, "<td>$description{$uniq_id}</td>");
                    push(@page, "<td align=\"center\">1</td>");
		    push(@page, "<td align=\"center\" width='15'><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_dr&format=genome&entry=$uniq_id\" title='Text view'> <img border='0' bordercolor='black' src='/miniepd/icons/Text_small.png' alt='T' width='15' height='15'> </a> </td>");
# get the coordinates to be used in the GB link:
		    my $outputCoord = &get_coordinates($uniq_id, "dr.epdnew");
		    (my $genome, my $chromosome , my $start) = split(/ /, $outputCoord);
		    $start -= 1000;
		    my $stop = $start + 2000;
		    push(@page, "<td align=\"center\" width='20'> ");
		    push(@page, "<a href =\"");
		    push(@page, "https://genome.ucsc.edu/cgi-bin/hgTracks?");
		    push(@page, "&clade=vertebrate&org=Zebrafish");
		    push(@page, "&db=danRer7&position=$chromosome:$start-$stop");
		    push(@page, "&hgt.customText=https://epd.expasy.org/miniepd/ucsc/danRer7.wig");
		    push(@page, "\" title='Genome Browser view'> <img border='0' bordercolor='black' src='/miniepd/icons/GB_small.png' width='20' height='15'> </></td></tr>");
		}elsif($FORM{"query_db"} eq "ens"){
		    $count++;
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=ensembl_hg&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">$tss_n</td></tr>");
		}elsif($FORM{"query_db"} eq "mm.ens"){
		    $count++;
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=ensembl_mm&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">$tss_n</td></tr>");
		}elsif($FORM{"query_db"} eq "dm.ens"){
		    $count++;
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=ensembl_dm&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">$tss_n</td></tr>");
		}
	    }
	}else{
	}
    }

    my $dat = $FORM{"query_db"};
    push(@page, "</table></div><br>");

    if ($FORM{"query_db"} eq "epd"){

	push(@page, "Download as:<br>");
	push(@page, "<input type=\"radio\" VALUE=text name=out_format> EPD entry (text only)</FONT><br>");
	push(@page, "<input type=\"radio\" VALUE=HTML name=out_format> EPD entry (html)</FONT><br>");
	push(@page, "<input type=\"radio\" VALUE=NICE name=out_format CHECKED> EPD entry (nice view)</FONT><br>");
	push(@page, "<input type=\"radio\" VALUE=XML name=out_format> EPD entry (xml)</FONT><br>");
	push(@page, "<input type=\"radio\" VALUE=EMBL name=out_format> Promoter sequence (EMBL format)<br>");
	push(@page, "<input type=\"radio\" VALUE=FASTA name=out_format> Promoter sequence (FASTA format)<br>");
	push(@page, "<b>from</b> &nbsp;<INPUT type=\"text\" name=\"from\" size=\"5\" value=\"-499\">");
	push(@page, "<b>to  </b> &nbsp;<INPUT type=\"text\" name=\"to\"   size=\"5\" value=\"100\">");
	push(@page, "bp relative to the TSS<br>");
    }else{
	push(@page, "Download as: <br>");
	push(@page, "<input type=\"radio\" name=\"format\" value=\"fps\" />FPS file format<br>");
	push(@page, "<input type=\"radio\" name=\"format\" value=\"sga\" />SGA file format<br>");
	push(@page, "<input type=\"radio\" name=\"format\" value=\"fasta\" checked=\"checked\" />FASTA file format ");
	push(@page, "<b>from</b> &nbsp;<INPUT type=\"text\" name=\"from\" size=\"5\" value=\"-499\">");
	push(@page, "<b>to  </b> &nbsp;<INPUT type=\"text\" name=\"to\"   size=\"5\" value=\"100\">");
	push(@page, "bp relative to the TSS<br>");
    }

    push(@page, "<input type=\"hidden\"/ name=\"database\" value=\"$dat\">");
    push(@page, "<input class='epdsubmit' type=\"submit\" value=\"Download\" >");
    push(@page, "</form>");



    if ($count == 0){
	print "<b>Sorry, no hit found.</b><br><br>Check the input IDs or alternatively extend the search to ENSEMBL database</table></div><br>";
    }else{
	foreach my $line (@page){
	    print "$line\n";
	}
    }
    close(FPSTMP);

    &printCGIFooter;
}

exit (0);


################################################################
###------------------------SUBS------------------------------###
################################################################

sub get_coordinates {
    my $id = $_[0];
    my $dbn = $_[1];
    my $db;
    if ($dbn eq "epdnew"){
	$db = "epdNew_hg";
    }
    elsif ($dbn eq "mm.epdnew"){
	$db = "epdNew_mm";
    }
    elsif ($dbn eq "dm.epdnew"){
    $db = "epdNew_dm";
    }
    elsif ($dbn eq "dr.epdnew"){
    $db = "epdNew_dr";
    }
    my $command = "fetch -c ../etc/fetch.conf $db:$id | awk '\$2==\"UCSC;\"{print \$3,\$4,\$6}'";
#    print "$command";
    my $output = `$command`;
#    (my $genome, my $chromosome , my $start) = split(/ /, $output);
    return($output);
}

sub uniq {
    my %seen = ();
    my @r = ();
    foreach my $a (@_) {
        unless ($seen{$a}) {
            push @r, $a;
            $seen{$a} = 1;
        }
    }
    return @r;
}


sub revcompl {
    my %reverse = ("A", "T",
                   "T", "A",
                   "C", "G",
                   "G", "C");
    my $seq2;

    for (my $k = 0; $k < length($_[0]); $k++) {
        $seq2 = $reverse{substr($_[0], $k, 1)}.$seq2;
    }
    return($seq2);
}

sub printCGIHeader {
   print "Content-type: text/html\n\n
   <!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
	\"http://www.w3.org/TR/html4/loose.dtd\">
<html lang='en'>
<head>
   <title>EPD The Eukaryotic Promoter Database</title>
   <meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\">
   <meta http-equiv=\"Content-Style-Type\" content=\"text/css\">
   <link rel=\"stylesheet\" href=\"/css_epd/sib-expasy.min-20240214.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
   <link rel=\"shortcut icon\" href=\"/img_epd/favicon.ico\" type=\"image/x-icon\">
   <link rel=\"stylesheet\" type=\"text/css\" href=\"/css_epd/search.min.css\" />
   <script language='javascript' type='text/javascript' src='/miniepd/scripts/epd_search-10032023.min.js'></script>
</head>
<body onload=\"wait_result();\">\n\n";
   open(HTMLHEADER, '<', "../htdocs/left_menu_fetch_biomart.php");
#    open(HTMLHEADER, '<', "../htdocs/header.html");
    my @html = <HTMLHEADER>;
    #print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
    print "@html";
    # Print result div:
    print "<div id='genes' >";
    #print "<div id='wait-result'></div>";
}

sub printCGIFooter {
    open(HTMLFOOTER, '<', "../htdocs/footer.html");
    my @html = <HTMLFOOTER>;
    print "@html";
    print "

</body>
</html>
";
}

