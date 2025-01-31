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
my $dat_file;
my $database;
my $description;
my $description_file;
my $tss_n;
my @gene_symbols2;
my $fetch_db;
my $assembly;
my $confFile = '../etc/epd.conf';

my %fps_files;
my %dat_files;
my %databases;
my %fetch_dbs;

my %names;

if ($ENV{'REQUEST_METHOD'} eq 'POST') {

    print "
<html>
<body>
<pre>
";

    print $FORM{"database"};
    read(STDIN, my $buffer, $ENV{'CONTENT_LENGTH'});
    my @pairs = split(/&/, $buffer);
    foreach my $pair (@pairs) {
	(my $name, my $value) = split(/=/, $pair);
	#$value =~ tr/+/ /;
	$value =~ s/;//;
	if ($name eq "gene_symbol"){
	    push(@gene_symbols2, $value);
	}
	else{
	    $FORM{$name} = $value;
	}
    }
    my $CONF;
    open($CONF, "<", $confFile) or die "Can't open < confFile: $!";
    while (my $row = <$CONF>) {
    	chomp $row;
    	my @param = split(/\t/, $row);
        if($param[0] =~ /^[a-z]{2}NC$/) {
            # Non-coding series: "HsNC_EPDnew.fps", "MmNC_EPDnew.fps", etc.
            $fps_files{$param[0]} = "../htdocs/ftp/epdnew/".$param[1]."/current/[A-Z][a-z]NC_EPDnew.fps";
            $dat_files{$param[0]} = "../htdocs/ftp/epdnew/".$param[1]."/current/[A-Z][a-z]NC_EPDnew.dat";
        } else {
            $fps_files{$param[0]} = "../htdocs/ftp/epdnew/".$param[1]."/current/[A-Z][a-z]_EPDnew.fps";
            $dat_files{$param[0]} = "../htdocs/ftp/epdnew/".$param[1]."/current/[A-Z][a-z]_EPDnew.dat";
        }
	my $command = "head -100 $dat_files{$param[0]} | grep 'DR   UCSC;' | head -1";
	my @DRline = `$command`;
	if ($DRline[0] =~ /DR   UCSC; ([^\s]+)/){
	    $fetch_dbs{$param[0]} = $1;
	}
	#print "$fps_files{$param[0]}\n$dat_files{$param[0]}\n$fetch_dbs{$param[0]}\n\n";
    }
    close($CONF);

    # if ($FORM{"database"} eq "ens"){
    # 	$fps_file = "../htdocs/ftp/epdnew/ENSEMBL/human/current/Hs_ENSEMBL.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/ENSEMBL/human/current/Hs_ENSEMBL.dat";
    # 	$database = "ENSEMBL";
    # }elsif ($FORM{"database"} eq "mm.ens"){
    # 	$fps_file = "../htdocs/ftp/epdnew/ENSEMBL/mouse/current/Mm_ENSEMBL.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/ENSEMBL/mouse/current/Mm_ENSEMBL.dat";
    # 	$database = "ENSEMBL";
    # }elsif ($FORM{"database"} eq "human.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/human/current/Hs_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/human/current/Hs_EPDnew.dat";
    # 	$database = "EPD New";
    # 	$fetch_db = "hg38";
    # }elsif ($FORM{"database"} eq "mouse.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/mouse/current/Mm_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/mouse/current/Mm_EPDnew.dat";
    # 	$database = "EPD New";
    # 	$fetch_db = "mm9";
    # }elsif ($FORM{"database"} eq "drosophila.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/drosophila/current/[A-Z][a-z]_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/drosophila/current/[A-Z][a-z]_EPDnew.dat";
    #     $database = "EPD New";
    # 	$fetch_db = "dm3";
    # }elsif ($FORM{"database"} eq "zebrafish.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/zebrafish/current/Dr_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/zebrafish/current/Dr_EPDnew.dat";
    #     $database = "EPD New";
    # 	$fetch_db = "danRer7";
    # }elsif ($FORM{"database"} eq "worm.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/worm/current/Ce_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/worm/current/Ce_EPDnew.dat";
    #     $database = "EPD New";
    # 	$fetch_db = "ce6";
    # }elsif ($FORM{"database"} eq "arabidopsis.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/arabidopsis/current/At_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/arabidopsis/current/At_EPDnew.dat";
    #     $database = "EPD New";
    # 	$fetch_db = "araTha1";
    # }elsif ($FORM{"database"} eq "S.cerevisiae.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/S_cerevisiae/current/Sc_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/S_cerevisiae/current/Sc_EPDnew.dat";
    #     $database = "EPD New";
    # 	$fetch_db = "sacCer3";
    # }elsif ($FORM{"database"} eq "S.pombe.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/S_pombe/current/Sp_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/S_pombe/current/Sp_EPDnew.dat";
    #     $database = "EPD New";
    # 	$fetch_db = "spo2";
    # }elsif ($FORM{"database"} eq "Z.mays.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/Z_mays/current/Zm_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/Z_mays/current/Zm_EPDnew.dat";
    #     $database = "EPD New";
    # 	$fetch_db = "zm3";
    # }elsif ($FORM{"database"} eq "A.mellifera.epdnew"){
    # 	$fps_file = "../htdocs/ftp/epdnew/A_mellifera/current/Am_EPDnew.fps";
    # 	$dat_file = "../htdocs/ftp/epdnew/A_mellifera/current/Am_EPDnew.dat";
    #     $database = "EPD New";
    # 	$fetch_db = "amel5";
    # }elsif ($FORM{"database"} eq "epd"){
    # 	$fps_file = "../htdocs/ftp/epd/current/epd.fps";
    # 	$dat_file = "../htdocs/ftp/epd/current/epd.dat";
    # 	$database = "EPD New";
    # 	$fetch_db = "epd";
    # }

    if ($FORM{"database"} eq "epd"){
 	$fps_file = "../htdocs/ftp/epd/current/epd.fps";
	$dat_file = "../htdocs/ftp/epd/current/epd.dat";

 	$database = "EPD New";
	$fetch_db = "epd";
    }else{
 	$fps_file = $fps_files{$FORM{"database"}};
	$dat_file = $dat_files{$FORM{"database"}};
 	$database = "EPD New";
	$fetch_db = $fetch_dbs{$FORM{"database"}};
    }

    # get the assembly:
    my $command = "awk '\$2 == \"UCSC;\" {print \$3; exit}' $dat_file";
    $assembly = `$command`;
    chomp $assembly;
    if ($assembly eq "hg18"){
	$fetch_db = "hs_nt";
    }else{
	$fetch_db = $assembly;
    }
    open(FPSTMP, '>', $fps_temp);

#     print "<br>";

    @gene_symbols = uniq(@gene_symbols2);

    foreach my $gene_symbol (@gene_symbols){
	chomp $gene_symbol;
	#print "$gene_symbol\n";
	#($t_id, $g_symbol) = split (/\|/, $gene_symbol);

	# Grep lines from fps file
	my $command = "awk \'\$2 == \"$gene_symbol\" {print \$0}\' $fps_file";
	#print "$FORM{'database'} $command\n";
	@fps_lines = `$command`;

	# Write the temporal fps:
	foreach my $line (@fps_lines){
	    chomp $line;
	    my @fps_fields = unpack('a5 a20 a5 a3 a18 a2 a11 a7', $line);
	    my $output = sprintf("%s%-20s%s%s%s%s%s%s", $fps_fields[0], $gene_symbol, $fps_fields[2], $fps_fields[3], $fps_fields[4], $fps_fields[5], $fps_fields[6], $fps_fields[7]);
	    print FPSTMP "$output\n";
	}
    }


# This part is used only by seq_download to get all the promoters:
    if ($FORM{"allHits"} eq "all"){
	my $command = "awk  \'{print \$0}\' $fps_file";
	@fps_lines = `$command`;
	# Write the temporal fps:
	foreach my $line (@fps_lines){
	    chomp $line;
	    print FPSTMP "$line\n";
	}
    }

    close(FPSTMP);


    system("./uniq.pl $fps_temp > $fps_tmp");

    if ($FORM{'format'} eq "fps"){
	open(FILE, '<', "$fps_tmp");
    }

    # Generate FASTA file:
    if ($FORM{'format'} eq "fasta"){
#	print "../cgi-bin/fps2fa.pl $fps_tmp $FORM{from} $FORM{to} $fetch_db > $fa_tmp\n";
	system("../cgi-bin/fps2fa.pl $fps_tmp $FORM{from} $FORM{to} $fetch_db > $fa_tmp");
#	print("../cgi-bin/fps2fa.pl $fps_tmp $FORM{from} $FORM{to} $fetch_db > $fa_tmp");
	open(FILE, '<', "$fa_tmp");
    }

     # Generate SGA tmp:
    if ($FORM{'format'} eq "sga"){
	system("fps2sga.pl -f TSS -s $assembly $fps_tmp | sort -s -k1,1 -k3,3n -k4,4 | compactsga > $sga_tmp");
	open(FILE, '<', "$sga_tmp");
    }

    # Print out the results:
    while (<FILE>){
	print;
    }

    close(FILE);

    print "
</pre>
</body>
</html>
";

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



