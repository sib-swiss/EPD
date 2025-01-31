#!/usr/bin/env perl
use strict;

my $usage = "

   fps2fa.pl <fpsfile> <from> <to> <db>

";
die $usage if (scalar (@ARGV) < 4);
my $input_file = $ARGV[0]; #shift or die $usage;
my $from = $ARGV[1]; #shift or die $usage;
my $to = $ARGV[2]; #shift or die $usage;
my $database = $ARGV[3]; #shift or die $usage;
my $start_pos;
my $end_pos;
my @seq;

open(FPS, $input_file) || die("Could not open $input_file");

foreach my $line (<FPS>){
    chomp $line;
    my @fps_fields = unpack('a5 a20 a5 a3 a18 a2 a11 a7', $line);
    my $t_id = $fps_fields[1];
    my $chromosome = $fps_fields[4];
    my $start = $fps_fields[6] + 1;
    my $strand = $fps_fields[5];
    $t_id =~ s/ //g;
    $chromosome =~ s/ //g;
    $chromosome =~ s/\.[0-9]([0-9])?//;
    $start =~ s/ //g;
    $strand =~ s/ //g;
    # Extract sequence:
    if ($strand eq "1+"){
	$start_pos = $start + $from;
	$end_pos = $start + $to;
	my $command = "fetch  -c ../etc/fetch.conf ".$database.":".$chromosome."[$start_pos..$end_pos]";
	###print "$command\n";
	my @fetch = `$command`;
	foreach my $result (@fetch){
	    if ($result =~ m/^[ATCG]+/){
		chomp $result;
		push(@seq, $result);
	    }
	}
    }else {
	$start_pos = $start - $to;
	$end_pos = $start - $from;
	my $command = "fetch -c ../etc/fetch.conf ".$database.":".$chromosome."[$start_pos..$end_pos]";
	###print "$command\n";
	my @fetch = `$command`;
	my $seq2;
	my $seq3;
	my $str_length;
	foreach my $result (@fetch){
	    if ($result =~ m/^[ATCG]+/){
		$seq2 = $result;
		chomp $seq2;
		$str_length = length ($seq2);
		$seq3 .= $seq2;
	    }
	}
	@seq = split(/(.{80})/, revcompl($seq3));
    }
    print ">$t_id|$chromosome $start_pos..$end_pos $strand\n";
    foreach my $line (@seq){
	# This if is needed because of the split (it create empty fields...)
	if ($line =~ m/^[ATCG]+/){
	    print "$line\n";
	}
    }
    $#seq = -1;
}

close(FPS);


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

