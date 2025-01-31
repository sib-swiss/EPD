#!/usr/bin/env perl

$old_value = 0;

foreach $line (<>){
    if ($line =~ m/ \# s/){
	exit;
    }
    chomp $line;
    ($pos) = $line =~ m/^\s+([-]?\d+)/;
    ($value) = $line =~ m/^\s+[-]?\d+[.]?[\d]?\s+(\d+)/;
    if ($value > 20 && $old_value <= 20){
	$old_value = $value;
	$new_pos = $pos + 900;
	print "$new_pos ";
    }elsif ($value <= 20 && $old_value > 20){
	$new_pos = 900 - $new_pos + $pos;
	print "$new_pos $old_value\n";
	$old_value = $value;
    }
}
