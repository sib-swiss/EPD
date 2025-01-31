#!/usr/bin/env perl

# Updates priority setting in TXT files used to configure UCSC tracks (typically "trackDb.txt")

use strict;
use warnings;

my $i = 1;
foreach (<>) {
    chomp;
    if(/^priority/) {
        print "priority $i\n";
        $i++;
    } else {
        print "$_\n";
    }
}

