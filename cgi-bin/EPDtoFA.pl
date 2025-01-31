#!/usr/bin/env perl
#

$se="";
$first = $ARGV[0];
$second = $ARGV[1];
$first_pos = $ARGV[0]+499;
$second_pos = $ARGV[1]+499;
$file = $ARGV[2];
if (($first<-499)||($second>100))
{
    print "Error : please choose sequence segment between -499 and 100";
}
else
{
    $query_length=$second_pos-$first_pos+1;
    open('FPS', "$file");
    while (<FPS>)
    {
	$EP=substr($_,57,5);
	if ($epd ne "")
	{
	    $epd="$epd epdseq\:EP$EP";
	}
	else
	{
	    $epd="epdseq\:EP$EP";
	}
    }
    close(FPS);
    $/ = ">";
    open('FILE', "fetch $epd |");
    while (<FILE>)

    {
	if (/EP\d+/)
	{
	    @lines=split/\n/;
	    foreach $lines(@lines)
	    {
		s/>//g;
		if ($lines=~/^(EP[^\;]+\;)([^\n]+)/)
		{
		    $header=">$1 range $first to $second\n";
		}
		elsif ($lines=~/^[ATCGN]/)
		{
		    chomp($lines);

		    $se="$se$lines";
		}
	    }
	    $seq=substr($se,$first_pos,$query_length);
	    print "$header";
	    $header="";
	    $line_number=int($query_length/60);
	    for ($i=0;$i<$line_number;$i++)
	    {
		$j=$i*60;
		$seq_piece=(substr($seq,$j,60));
		print "$seq_piece\n";
	    }
	    $rest=($query_length)-($line_number*60);

	    if ($rest>0)
	    {
		$last_piece=(substr($seq,(($line_number*60)),$rest));
		print "$last_piece\n";
	    }

	    $se="";
	    $seq="";
	}
    }
}


