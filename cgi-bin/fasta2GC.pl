#!/usr/bin/env perl

# determine GC-content from set of sequences in fasta format -> R for graphics
# usage: fasta2CG.pl epd.seq start end window

use strict;

my $file=$ARGV[0];
my $start=$ARGV[1];
my $end=$ARGV[2];
my $win=$ARGV[3];
my ($i,$j,$seq_count);
my @CG;

my $diff=abs($end-$start);

$/ = ">" ;         # defines the entry delimiter.
open(FILE, "$file") or die (" cannot open $file: $!\n");
while(<FILE>){
    my ($head,$si);
    my @seq;
    my $N_count=0;
    if (/^>(\w+)/){
	$head=$1;
    }
    while(/([ACGTN]+)/g){
#	print "toto $1 \n";
	foreach $si(split//,$1){
	    push(@seq,$si);
# count Ns within sequence
	    if ($si eq 'N'){
		$N_count++;
	    }

	}
    }
# test if range supplied by user within sequence && require less than 10% Ns in sequence
    if (($diff<=scalar @seq)&&($N_count< $diff/10)){
	$seq_count++;
# count GC-content in sliding window
	for ($i=0;$i<=$diff-$win; $i++) {
	    my $GC_count=0;
	    for ($j=$i;$j<$i+$win;$j++){
#		print $seq[$j],"\t$j\t";
		if (($seq[$j] eq 'C')||($seq[$j] eq 'G')){
		    $GC_count++;
		}
	    }
	    $CG[$i]=$CG[$i]+($GC_count/$win);
#		print $CG[$i],"\t",$GC_count/$win,"\n";
	}
    }
}
# output

print ">CG-content of collection of $seq_count sequences in $file in range: $start to $end with window size $win\n";
for ($i=0;$i<=$diff-$win; $i++) {
    print $start+$i,"\t",$CG[$i]/$seq_count,"\n";
}

1;
