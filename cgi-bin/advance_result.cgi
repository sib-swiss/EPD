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
my $fps_temp = "wwwtmp/fps".$unique.".temp";
my $fps_tmp = "wwwtmp/epd_query".$unique.".fps";
my $sga_tmp = "wwwtmp/epd_query".$unique.".sga";
my $fa_tmp = "wwwtmp/epd_query".$unique.".fa";
my $stat_tmp = "wwwtmp/epd_stat".$unique.".txt";
my $fps_file;
my $database;
my @description;
my $description;
my $description_file;
my $tss_n = 1;
my $display;
my $stats;
my $field;
my $field2;
my $count = 0;
my @page;
my %mapped;
my @unmapped;
my $dat_file;

if ($ENV{'REQUEST_METHOD'} eq 'POST') {
    read(STDIN, my $buffer, $ENV{'CONTENT_LENGTH'});
    my @pairs = split(/&/, $buffer);
    foreach my $pair (@pairs) {
	(my $name, my $value) = split(/=/, $pair);
	$value =~ s/;//;
	$FORM{$name} = $value;
    }

    &printCGIHeader;

    if ($FORM{"database"} eq "ens"){
	$fps_file = "../htdocs/ftp/epdnew/ENSEMBL/human/current/Hs_ENSEMBL.fps";
	$dat_file = "../htdocs/ftp/epdnew/ENSEMBL/human/current/Hs_ENSEMBL.dat";
	$database = "ENSEMBL";
	$field = '$1';
	$field2 = '$1';
    }elsif ($FORM{"database"} eq "mm.ens"){
	$fps_file = "../htdocs/ftp/epdnew/ENSEMBL/mouse/current/Mm_ENSEMBL.fps";
	$dat_file = "../htdocs/ftp/epdnew/ENSEMBL/mouse/current/Mm_ENSEMBL.dat";
	$database = "ENSEMBL";
	$field = '$1';
	$field2 = '$1';
    }elsif ($FORM{"database"} eq "epdnew"){
	$fps_file = "../htdocs/ftp/epdnew/human/current/Hs_EPDnew.fps";
	$dat_file = "../htdocs/ftp/epdnew/human/current/Hs_EPDnew.dat";
	$database = "EPD New";
	$field = '$3';
	$field2 = '$2';
    }elsif ($FORM{"database"} eq "mm.epdnew"){
	$fps_file = "../htdocs/ftp/epdnew/mouse/current/Mm_EPDnew.fps";
	$dat_file = "../htdocs/ftp/epdnew/mouse/current/Mm_EPDnew.dat";
	$database = "EPD New";
	$field = '$3';
	$field2 = '$2';
    }elsif ($FORM{"database"} eq "epd"){
	$fps_file = "../htdocs/ftp/epd/current/epd.fps";
	$dat_file = "../htdocs/ftp/epd/current/epd.dat ../htdocs/ftp/epd/current/epd_bulk.dat";
	$database = "EPD New";
	$field = '$3';
	$field2 = '$2';
    }

    open(FPSTMP, '>', $fps_temp);

    my @query_ids_temp = split (/%0D%0A/, $FORM{query});
    my @query_ids = uniq(@query_ids_temp);
    my $hits = $#query_ids + 1;


    push(@page, "<form id='result' action='./download_biomart.cgi' method='POST' target='_blank'>");
    push(@page, "<div id=\"genes\" style=\"display: block; border : solid 1px \#CCCCCC; padding : 4px; width : 90\%; height: 40\%; overflow : auto; \"> ");
    push(@page, "<table align=\"left\" style=\"width: 100%; font-size: 12px; font-family: Helvetica;\" border=\"0\">");
    push(@page, "<tr align=\"left\" style=\"background-color: #D7DFE2;\">");
    push(@page, "<td align=\"center\" style=\"max-width:10px;\"><input type='checkbox' name='checkall' checked='checked' onclick='checkedAll();'></td>");
    push(@page, "<td align=\"center\" style=\"max-width:50px;\"><b>Prom. ID</b></td>");
    push(@page, "<td align=\"center\"><b>Description</b></td>");
    push(@page, "<td align=\"center\"><b>TSS</b></td></tr>");

    foreach my $query_id (@query_ids){

	chomp $query_id;
	if ($query_id ne ""){
	    my $command;
	    # build the query:

	    my $query = '$0 ~ "'.$query_id.'"';
	    if ($FORM{'nameid'} eq "eid"){
		$query = '$0 ~ /DR   Ensembl; '.$query_id.'\./';
	    }elsif ($FORM{'nameid'} eq "pid"){
		$query = '$0 ~ /DR   RefSeq; '.$query_id.'\./';
	    }elsif ($FORM{'nameid'} eq "gid"){
		$query = '$0 ~ /DR   Gene Symbol; '.$query_id.'\./';
	    }elsif ($FORM{'nameid'} eq "did"){
		$query = '$0 ~ "DE   [\S]*'.$query_id.'"';
	    }


	    $command = "cat $dat_file | awk 'BEGIN{ IGNORECASE=1; RS=\"//\"; } $query { print \$0 }'";
#	    print $command;
	    my @output = `$command`;
	    my $id;
	    my @ids;
	    my %description;

	    foreach my $line (@output){
		chomp $line;
		if ($line =~ m/^ID/ && $FORM{"database"} =~ /epd/){
		    ($id) = $line =~ /^ID\s{3}([\S]+)/;
		    push(@ids, $id);
		    undef $description;
		}elsif ($line =~ m/^GN   Name=/ && $FORM{"database"} eq 'ens'){
		    ($id) = $line =~ /^GN   Name=([\S]+);/;
		    push(@ids, $id);
		    undef $description;
		    undef $description{$id};
		}elsif ($line =~ m/^GN   Name=/ && $FORM{"database"} eq 'mm.ens'){
		    ($id) = $line =~ /^GN   Name=([\S]+);/;
		    push(@ids, $id);
		    undef $description;
		    undef $description{$id};
		}elsif ($line =~ m/^OS/ && $FORM{"database"} eq 'epd'){
		    ($description) = $line =~ /^OS\s{3}(.+)\./;
		    $description{$id} .= " [".$description."]";
		}elsif ($line =~ m/^DE/){
		    ($description) = $line =~ /^DE\s{3}(.+)/;
		    $description{$id} .= " ".$description;
		}
	    }
	    my @uniq_ids = sort(uniq(@ids));
            push(@unmapped, $query_id) if (scalar(@uniq_ids) < 1);

	    foreach my $uniq_id (@uniq_ids){
		# Grep the number of TSS
		$command = "awk \'\$2 == \"$uniq_id\" {print \$6}\' $fps_file | sort | uniq | wc -l";
		#$command = "grep -c \"Name=$uniq_id\" $dat_file";
		$tss_n = `$command`;

		$mapped{$uniq_id} = $query_id;
#                printf STAT "%-20s%+1s%s", $query_id, "->   ", "$uniq_id\n";

		if($FORM{"database"} eq "epdnew"){
		    $count++;
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_hg&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">1</td></tr>");
		}elsif($FORM{"database"} eq "mm.epdnew"){
		    $count++;
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=epdNew_mm&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">1</td></tr>");
		}elsif($FORM{"database"} eq "ens"){
		    $count++;
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=ensembl_hg&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">$tss_n</td></tr>");
		}elsif($FORM{"database"} eq "mm.ens"){
		    $count++;
		    push(@page, "<tr align=\"left\" class='fetch'>");
		    push(@page, "<td align=\"center\"><input type=\"checkbox\" name=\"gene_symbol\" value=\"$uniq_id\" checked=\"checked\" /></td>");
		    push(@page, "<td align=\"left\"><a href=\"/cgi-bin/miniepd/get_doc?db=ensembl_mm&format=genome&entry=$uniq_id\">$uniq_id</a></td>");
		    push(@page, "<td>$description{$uniq_id}</td>");
		    push(@page, "<td align=\"center\">$tss_n</td></tr>");
		}
	    }
	}else{
	}
    }

    my $dat = $FORM{"database"};
    push(@page, "</table></div><br>");
    push(@page, "<a href='../cgi-bin/download_file.cgi?ID=./$stat_tmp'>Search stats</a><br><br>");
    push(@page, "Download promoters as: <br>");
    push(@page, "<input type=\"radio\" name=\"format\" value=\"fps\" />FPS file format<br>");
    push(@page, "<input type=\"radio\" name=\"format\" value=\"sga\" />SGA file format<br>");
    push(@page, "<input type=\"radio\" name=\"format\" value=\"fasta\" checked=\"checked\" />FASTA file format ");
    push(@page, "<b>from</b> &nbsp;<INPUT type=\"text\" name=\"from\" size=\"5\" value=\"-499\">");
    push(@page, "<b>to  </b> &nbsp;<INPUT type=\"text\" name=\"to\"   size=\"5\" value=\"100\">");
    push(@page, "bp relative to the TSS<br>");
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


### Print some Statistics:
    open(STAT, '>', $stat_tmp);
    print STAT "### EPD Search Statistics ###\n\n";
    print STAT "     Database : ";
    print STAT "Hs_EPDnew\n" if ($FORM{"database"} eq "epdnew");
    print STAT "Mm_EPDnew\n" if ($FORM{"database"} eq "mm.epdnew");
    print STAT "Hs_ENSEMBL\n" if ($FORM{"database"} eq "ens");
    print STAT "Mm_ENSEMBL\n" if ($FORM{"database"} eq "mm.ens");
    print STAT "   Search key : ";
    print STAT "ENSEMBL GENE ID\n" if ($FORM{'nameid'} eq "eid");
    print STAT "RefSeq DNA ID\n" if ($FORM{'nameid'} eq "pid");
    print STAT "HGNC Gene Symbol\n" if ($FORM{'nameid'} eq "gid");
    print STAT "Gene Description\n" if ($FORM{'nameid'} eq "did");
    print STAT "Hits searched : ".scalar(@query_ids)."\n";
    print STAT "      # found : ".keys(%mapped)."\n";
    print STAT "  # not found : ".scalar(@unmapped)."\n";


    print STAT "\n\n______________________________________\n\nHits found:\n\n";
    printf STAT "%-20s", "<QueryID>";
    printf STAT "%+1s", "->   ";
    printf STAT "%s", "<DatabaseID>\n";

    foreach my $key (keys %mapped){
    	printf STAT "%-20s%+1s%s", $mapped{$key}, "->   ", "$key\n";
    }
    print STAT "\n\n______________________________________\n\nHits NOT found:\n\n";
    foreach my $uhit (@unmapped){
	print STAT "$uhit\n";
    }
    close(STAT);

    &printCGIFooter;
}

exit (0);




################################################################
###------------------------SUBS------------------------------###
################################################################
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
#    print "Content-type: text/html\n\n";
#    print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
    open(HTMLHEADER, '<', "../htdocs/left_menu_fetch_biomart.php");
#    open(HTMLHEADER, '<', "../htdocs/header.php");
    my @html = <HTMLHEADER>;
    print "@html";
}

sub printCGIFooter {
    open(HTMLFOOTER, '<', "../htdocs/footer.html");
    my @html = <HTMLFOOTER>;
    print "@html";
    print "</body></html>";
}

