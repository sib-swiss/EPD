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
	if (/^FP   /)
	{
	    $EP=substr($_,57,5);
	    if ($epd ne "")
	    {
		$epd="$epd epdblk\:EP$EP";
	    }
	    else
	    {
		$epd="epdblk\:EP$EP";
	    }
	}
    }
    close(FPS);
    open('FILE', "fetch $epd |");
    while (<FILE>)

    {
	if (/^[IXAC]/)
	{
	    print;
	}
	elsif (/^DE   ([^\;]+\;)/)
	{
	    print "DE   $1 range $first to  $second\n";
	}
	elsif (/^   (.*)/)
	{
	    chomp;
	    s/ //mg;
	    $se="$se$_";
	}
	elsif (/^\/\//)
	{
	    $seq=substr($se,$first_pos,$query_length);
	    $A_count=0;
	    $T_count=0;
	    $C_count=0;
	    $G_count=0;
	    $other_count=0;
	    $total=0;
	    @SEQ=split//,$seq;
	    foreach $SEQ (@SEQ)
	    {
		if ($SEQ eq "a")
		{
		    $A_count++;
		}
		elsif ($SEQ eq "t")
		{
		    $T_count++;
		}
		elsif ($SEQ eq "c")
		{
                $C_count++;
            }
		elsif ($SEQ eq "g")
		{
		    $G_count++;
		}
		else
		{
		    $other_count++;
		}
	    }
	    $total=$A_count+$C_count+$G_count+$T_count+$other_count;
	    print "SQ   Sequence $total BP; $A_count A; $C_count C; $G_count G; $T_count T; $other_count other\;\n";
	    $line_number=int($total/60);
	    for ($i=0;$i<$line_number;$i++)
	    {
		$j=$i*60;
		$seq_piece=(substr($seq,$j,60));
		print "    ";
		for ($slice=0;$slice<6;$slice++)
		{
		    $sub_seq=(substr($seq_piece,($slice*10),10));
		    print " $sub_seq";
		}
		print "\n";
	    }
	    $rest=$total-($line_number*60);
	    $last_piece=(substr($seq,($line_number*60),$rest));
	    if ($rest>0)
	    {
		$last_line_count=int($rest/10);
		$last_rest=$rest-($last_line_count*10);
		$last_line_piece=(substr($last_piece,($last_line_count*10),$last_rest));
		print "    ";
		for ($last_slice=0;$last_slice<$last_line_count;$last_slice++)
		{
		    $last_sub_seq=(substr($last_piece,($last_slice*10),10));
		    print " $last_sub_seq";
		}
		if ($last_rest > 0)
		{
		    print " $last_line_piece\n";
		}
		else
		{
		    print "\n";
		}
	    }
	    print "\/\/\n";
	    $seq="";
	    $se="";
	}
    }
}


