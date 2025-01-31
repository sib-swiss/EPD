#!/usr/bin/env perl

$fps_file = shift || die("Privide an input fps");

open(FPS,'<', $fps_file);

my $start = 0;
my $gene = 0;

foreach $line (<FPS>){
    chomp $line;
    my @fps_fields = unpack('a5 a20 a5 a3 a18 a2 a11 a7', $line);
    if ($gene ne $fps_fields[1] || $start ne $fps_fields[6]){
	print "$line\n";
    }
    $gene = $fps_fields[1];
    $start = $fps_fields[6];
}

close(FPS);
