#!/usr/bin/env perl

use strict;
use warnings;
use Getopt::Long;
use List::MoreUtils 'apply';

my $assembly;
my $promfile; # "promoter_ucsc.txt" from the EPD FTP
my $pid; # promoter ID
my $chr;
my $pos;
my $strand;
my $count;
my $header; # print header
my $bedgraph = "tmp_$$.bedgraph";

GetOptions('header' => \$header, 'promoter=s' => \$promfile, 'assembly=s' => \$assembly);
die("Usage is $0 -a <assembly> -p <promoter_ucsc.txt> < list of bigWig files to extract expression from") unless $promfile and $assembly;

# Read bigWig files
my @bw = <STDIN>;
chomp(@bw);

if($header) {
    # Print track names as column header for the matrix
    # (actual track names have in addition an index at the start)
    my @tracks = apply { s/.*\/(.+).bw$/$1/ } @bw;
    @tracks = map {"$_".$tracks[$_-1]} 1 .. @tracks;
    print "\tstrand\t".join("\t", @tracks)."\n";
}

if(open(my $fh, '<', $promfile)) {
    while(<$fh>) {
        chomp;
        my @F = split /\t/;
        if($F[1] ne $assembly) {
           next;
        }
        $pid = $F[0];
        $chr = $F[2];
        $strand = $F[3];
        $pos = $F[4];

        # For each promoter, extract expression from every bigWig file
        # that corresponds to the strand
        print "$pid\t$strand";
        foreach(@bw) {
            chomp;
            if(($strand eq "+" and $_ =~ m/plus.bw$/) ||
               ($strand eq "-" and $_ =~ m/minus.bw$/)) {
                # Perform extraction
                my $command = "bigWigToBedGraph -chrom=$chr -start=".($pos-100)." -end=".($pos+101)." $_ $bedgraph";
                # print STDERR "$command\n";
                system($command);
                $count = `awk '{sum += \$4} END {print sum}' $bedgraph`;
                chomp $count;
                # count can be empty (if bedgraph file empty)
                $count = 0 unless $count;
                print "\t$count";
            } else {
                # Print 0
                print "\t0";
            }
        }
        print "\n";
    }
    close $fh;
} else { die("Could not open file $promfile."); }

