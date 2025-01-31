#!/usr/bin/env perl

use strict;
use warnings;
use Getopt::Long;

# Usage: pipe in the file produced by get_max_tracks.pl

my $sessionfile; # template session file (!RESET TRACK SELECTION IF REQUIRED!)
my $rootname = "viewer_"; # root of session file name
my $tracknum = 5; # number of max. expressed tracks to activate in session file
my $both; # should both strands be displayed? (default: no)
my $insertion; # first imgOrd to assign to the max. expr. track

GetOptions('session=s' => \$sessionfile, 'tracknum=s' => \$tracknum, 'root=s' => \$rootname, 'both' => \$both, 'insertion=i' => \$insertion);
die("Usage is $0 -s <sessionfile> < file produced by 'get_max_tracks.pl'\n") unless $sessionfile;

# How much to shift imgOrd for tracks that come after the max. expr. tracks?
my $imgOrdShift = $tracknum * ($both ? 2 : 1);

open(FILE, "<", $sessionfile) or die("$sessionfile could not be opened.");
my @sessionlines = <FILE>;
close(FILE);


# For each promoter
while(<>) {
    chomp;
    my @fields = split /\t/;
    my $pid = splice @fields, 0, 1;
    @fields = @fields[ 0 .. ($tracknum-1) ];
    my @sessioncopy = @sessionlines;
    my $currentImgOrd = $insertion;
    foreach my $line (@sessioncopy) {
        if($line =~ /imgOrd (\d+)/) {
            if($1 >= $insertion and $1 < $insertion + $imgOrdShift) {
                my $newImgOrd = $1 + $imgOrdShift;
                $line =~ s/imgOrd \d+/imgOrd $newImgOrd/;
            }
        }
    }

    # For each track to be modified
    foreach my $track (@fields) {
        my $pattern;
        if($both) {
            $track =~ s/\.(plus|minus)$//;
            $track =~ s/^\d+//;
            # Track num is different for plus and minus strands!
            $pattern = qr/(hub_.*${track}.(plus|minus)_sel) \d/;
        } else {
            # The '.' in $track will actually be matched against a '_'
            $pattern = qr/(hub_.*_${track}_sel) \d/;
        }
        # print STDERR "$pattern\n";
        # Search the whole session file
        if($insertion) {
            foreach my $line (@sessioncopy) {
                if($line =~ /$pattern/) {
                    $line =~ s/$pattern/$1 1/;
                    my $imgOrd_line = $line;
                    $imgOrd_line =~ s/_sel (0|1)/_imgOrd $currentImgOrd/;
                    $line .= "$imgOrd_line";
                    $currentImgOrd += 1;
                }
            }
        } else {
            foreach my $line (@sessioncopy) {
                $line =~ s/$pattern/$1 1/;
                # if($line =~ s/$pattern/$1 1/) {
                    # print STDERR "replaced: $line\n";
                # }
            }
        }
    }

    # Write new session file
    my $filename = "${rootname}${pid}.txt";
#   open(SESSIONFILE, ">", $filename) or die("$filename could not created or written to.");
    print join("", @sessioncopy);
#   close(SESSIONFILE);

    # if($. == 2) {
        # last;
    # }
}
