#!/usr/bin/env perl
use strict;

$ENV{'PATH'}    .= ":/home/local/perl:/home/local/bin:/usr/local/bin";
$ENV{'SSA2DBC'} .= "/usr/local/EPD_web.git/htdocs/ssa/data/SSA2DBC.def"; # code changed

my $DATA = "/home/local/";
my $my_ssa2dbc = '/usr/local/EPD_web.git/htdocs/ssa/data/SSA2DBC.def'; # code changed

my $usage = "

fps2fa.pl <fpsfile> <from> <to> <db> <lc>

";
die $usage  if (scalar (@ARGV) < 4);
my $input_file = $ARGV[0]; #shift or die $usage;
my $from = $ARGV[1]; #shift or die $usage;
my $to = $ARGV[2]; #shift or die $usage;
my $database = $ARGV[3]; #shift or die $usage;
my $lowercase = $ARGV[4];
my $start_pos;
my $end_pos;
my @seq;


$input_file =~ s/.fps//;
$lowercase = 0  if $ARGV[4] eq '';

#print "$input_file\n";

# write input file for FROMFPS:
open(INP, ">$input_file.input");
print INP "$input_file.fps\n";
print INP "$from\n";
print INP "$to\n";
print INP "6\n";
print INP "30\n";
print INP "D\n";
print INP "F\n";
print INP "$input_file\n";
close(INP);

# run command
system("SSA2DBC=$my_ssa2dbc; export SSA2DBC; /usr/local/bin/FROMFPS < $input_file.input 2>/dev/null");

open(SEQ, "<$input_file.seq");
my %sequence;
my $seqname;
while ( my $line = <SEQ> ){
    chomp $line;
    if ($line =~ /^>/){
        #print "$line\n";
        $seqname = $line;
    }else{
        $sequence{$seqname} .= $line;
    }
}
close(SEQ);

my $endLc = length($sequence{$seqname});
#print $endLc;
$endLc = (-1 * $to) - 1 if $to >= 0;
my $sequence;

foreach my $seqname (keys %sequence){
    print "$seqname\n";
    if ($lowercase == 1){
        $sequence = $sequence{$seqname};
        my $nseq = lc( substr($sequence, 0, $endLc) );
        $nseq .= substr($sequence, $endLc);
        $sequence = $nseq;
    }else{
        $sequence = $sequence{$seqname};
    }
    my @pseq = unpack("(A60)*", $sequence);
    #    print "$sequence\n";
    print join("\n", @pseq);
    print "\n";
}

