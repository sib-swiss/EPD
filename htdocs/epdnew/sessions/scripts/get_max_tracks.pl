#!/usr/bin/env perl

# Prints for each promoter the 20 tracks where expression is highest

# Usage: pipe in the expression matrix as produced my make_expr_matrix.pl

use strict;
use warnings;

my $TRACK_NUM = 20;
my @tracks; # array of track names
my @minus_indices; # indices of minus strand tracks in @tracks
my @plus_indices; # indices of plus strand tracks in @tracks

while(<>) {
    chomp;
    my @fields = split /\t/;
    if($. == 1) {
        # First two tokens are not useful (empty + "strand")
        splice @fields, 0, 2;
        @tracks = @fields;
        map { ($tracks[$_] =~ m/plus$/) ? push @plus_indices, $_ : push @minus_indices, $_ } 0 .. $#tracks;
        next;
    }

    # First field is promoter ID, second = strand, following = expression values
    my($pid, $strand) = splice @fields, 0, 2;
    print "$pid\t";

    my @max_indices = sort { $fields[$b] <=> $fields[$a] } ($strand eq "+" ? @plus_indices : @minus_indices);
    print join("\t", map { $tracks[$_] } @max_indices[0 .. ($TRACK_NUM-1)] )."\n";
}

