#!/usr/bin/env perl

# converts an EPD record from XML to HTML.

$ENV{'PATH'} .= ":/usr/molbio/perl";

#if ($#ARGV == 0) {
    # command-line style
#    $record = $ARGV[0];
#} else {
    # CGI-style
#    $record = $ENV{'QUERY_STRING'};
#}


#$fetchCommand = "/home/vpraz/prog/fetch2 epdx:$record";


#open (RECORD, "$fetchCommand |") or &HTMLError ("Could not open $record.");


$/ = "</Entry>";
while (<>)
#while (<RECORD>)



{
    @fields=(split(/^\t\t<\//m));
    foreach $fields(@fields)
    {
	if ($fields =~/Type\=\"(\S+)\" Site_type\="(\S+)\" Taxonomic_division\=\"(\S+)\">\n\s+(\w+)/)
        {
            $epd_ID=$4;
        }
        if ($fields =~ /AC_line>\n\s+(\w+)/)
        {
            $epd_AC=$1;
        }
        if ($fields =~ /<Similarity>/)
        {
        @sim_fields=(split (/^\t\t\t<\//m,$fields));
        foreach (@sim_fields)
        {
        if (/<NP_line>/)
           {
               if (/No_similarity/)
               {
                   @NP=();
               }
               else
               {
                    /<Neighbour_AC>\n\s+(EP\d+)\n\s+<\/Neighbour_AC>\n\s+<Neighbour_ID>\n\s+(\S+)\n\s+<\/Neighbour_ID>\n\s+<Neighbour_position>\n\s+\[([^\;]+)\;([^\]])/;
                    push(@NP,$1);
                    $np_ID{$1}=$2;
                    $np_position{$1}=$3;
                    $np_direction{$1}=$4;
               }
             }
           }
        }
        if ($fields =~ /<Cross-links>/)
        {
        @cross_fields=(split (/^\t\t\t<\//m,$fields));
        foreach (@cross_fields)
            {
                if (/<EPD_link>/)
                {
                       /<EPD_AC>\n\s+(EP\d+)\n\s+<\/EPD_AC>\n\s+<EPD_ID>\n\s+(\S+)\n\s+<\/EPD_ID>\n\s+<EPD_type>\n\s+([^\n]+)\n\s+<\/EPD_type>\n\s+<EPD_pos>\n\s+\[([^\;]+)\;([^\]])/;
                      push (@epd, $1);
                      $epd_ID{$1}=$2;
                      $epd_position{$1}=$4;
                      $epd_direction{$1}=$5;
                }
                if (/<EMBL(_first)?>/)
                {
                       /<EMBL_SV>\n\s+([^\.]+)\.(\d{1,2})\n\s+<\/EMBL_SV>\n\s+<EMBL_ID>\n\s+(\S+)\n\s+<\/EMBL_ID>\n\s+<EMBL_Position>\n\s+\[([^\,]+)\s?\,([^\]]+)/;
                       $sv="$1\.$2";
                       push (@SV, $sv);
                       $AC{$sv}=$1;
                       $ID{$sv}=$3;
                       $position_start{$sv}=$4;
                       $position_stop{$sv}=$5;
                       $em_length1{$sv}=abs($4)+abs($5);
                 }
                if (/<TRANSFAC>/)
                {
                       /<TF_AC>\n\s+(\S+)\n\s+<\/TF_AC>\n\s+<TF_ID>\n\s+([^\n]+)\n\s+<\/TF_ID>\n\s+<TF_Position>\n\s+\[([^\,]+)\,([^\]]+)/;
                      push (@TF,$1);
                      $TF_ID{$1}=$2;
                      $TF_position_start{$1}=$3;
                      $TF_position_stop{$1}=$4;
                 }
             }
        }
    }
}
$em_number=scalar(@SV);

$height=350+($em_number*60);

open('TMP', "> wwwtmp/$epd_AC.svg");

print TMP ("<\!DOCTYPE svg PUBLIC \"-\/\/W3C\/\/DTD SVG 20001102\/\/EN\"   \"http\:\/\/www\.w3\.org\/TR\/2000\/CR-SVG-20001102\/DTD\/svg-20001102\.dtd\">\n<svg id\=\"body\" width\=\"21cm\" height\=\"".($height/100)."\"\nviewBox\=\"0 0 2100 $height\">\n");
$em=0;
$prom=1;
$np=0;
$rel_pos=1050;
print TMP ("<text  id\=\"prom$prom\" style\=\"font-family\:Verdana\; font-size\:15pt\; fill\:none\" x\=\"750\" y\=\"27\">EPD : $epd_AC   $epd_ID<\/text>\n");
foreach $epd(@epd)
{
    $prom++;
    print TMP ("<text  id\=\"prom$prom\" style\=\"font-family\:Verdana\; font-size\:15pt\; fill\:none\" x\=\"750\" y\=\"27\">ALTERNATIVE PROMOTER : $epd   $epd_ID{$epd}<\/text>\n");
}
foreach $NP(@NP)
{
    $np++;
    print TMP ("<text  id\=\"np$np\" style\=\"font-family\:Verdana\; font-size\:15pt\; fill\:none\" x\=\"750\" y\=\"27\">NEIGHBOURING PROMOTER : $NP   $np_ID{$NP}<\/text>\n");
}
foreach $SV(@SV)
{
    $em++;
    print TMP ("<text  id\=\"embl$em\" style\=\"font-family\:Verdana\; font-size\:15pt\; fill\:none\" x\=\"750\" y\=\"27\">EMBL : $AC{$SV}   $ID{$SV} \($em_length1{$SV} bp\)<\/text>\n");
}
$tf=0;
foreach $TF(@TF)
{
    $tf++;
    print TMP ("<text  id\=\"tf$tf\" style\=\"font-family\:Verdana\; font-size\:15pt\; fill\:none\" x\=\"750\" y\=\"27\">TRANSFAC : $TF   $TF_ID{$TF} \($TF_position_start{$TF}  $TF_position_stop{$TF}\)<\/text>\n");
}
print TMP ("<title>Band_3<\/title>\n<desc>\n\tEPD entry svg view<\/desc>\n");
$arrow_pos=$rel_pos+60;
$arrow_pos2=$rel_pos+40;
$em=0;
$prom=1;
$tf=0;
$np=0;
############makes the graphics##############


#TSS

print TMP ("<polyline points\=\"$rel_pos,170,$rel_pos,130,$arrow_pos,130,$arrow_pos2,125,$arrow_pos,130,$arrow_pos2,135\" stroke\=\"red\" fill\=\"none\" onmouseover\=\"reactionprom$prom(evt)\" onmouseout\=\"reactionprom$prom(evt)\"\/>\n");


$i=0;
for($i=0; $i<100; $i++)

{
    $j=$i+1;
    $x=(10*$i)+1050;
    $text_pos=$x-2;
    $right_text=(10*$i);
    print TMP ("<polyline points\=\"50,172,2100,172\" fill\=\"red\"\/>\n");
    print TMP ("<polyline points\=\"$x,170,$x,174\" fill\=\"red\"\/>\n");
    print TMP ("<text style\=\"font-family\:Courrier\; font-size\:3pt\" x\=\"$text_pos\" y\=\"178\">$right_text<\/text>\n");
    $x_left=1050-(10*$j);
    $text_left=-(10*$j);
    $text_pos_left=$x_left-4;
    print TMP ("<polyline points\=\"$x_left,170,$x_left,174\" fill\=\"red\"\/>\n");
    print TMP ("<text style\=\"font-family\:Courrier\; font-size\:3pt\" x\=\"$text_pos_left\" y\=\"178\">$text_left<\/text>\n");
}

#Alternative Promoters

foreach $epd(@epd)
{
    $prom++;
    if ($epd_position{$epd}>0)
    {
	if ($epd_direction{$epd} eq "+")
	{
	    $epd_pos=int($rel_pos+($epd_position{$epd}));
	    $arrow_pos=$epd_pos+60;
	    $arrow_pos2=$epd_pos+40;
	}
	else
	{
	    $epd_pos=int($rel_pos+($epd_position{$epd}));
	    $arrow_pos=$epd_pos-60;
	    $arrow_pos2=$epd_pos-40;
	}
    }
    else
    {
	if ($epd_direction{$epd} eq "+")
	{
	    $epd_pos=int($rel_pos-(abs($epd_position{$epd})));
	    $arrow_pos=$epd_pos+60;
	    $arrow_pos2=$epd_pos+40;
	}
	else
	{
	    $epd_pos=int($rel_pos-(abs($epd_position{$epd})));
	    $arrow_pos=$epd_pos-60;
	    $arrow_pos2=$epd_pos-40;
	}
    }
    print TMP ("<polyline id\=\"ap$prom\" points\=\"$epd_pos,170,$epd_pos,130,$arrow_pos,130,$arrow_pos2,125,$arrow_pos,130,$arrow_pos2,135\" stroke\=\"blue\" fill\=\"none\" visibility\=\"visible\" onmouseover\=\"reactionprom$prom(evt)\" onmouseout\=\"reactionprom$prom(evt)\"\/>\n");

}

#neighbours


foreach $NP(@NP)
{
    $np++;
    if ($np_position{$NP}>0)
    {
	if ($np_direction{$NP} eq "+")
	{
	    $np_pos=int($rel_pos+($np_position{$NP}));
	    $nparrow_pos=$np_pos+60;
	    $nparrow_pos2=$np_pos+40;
	}
	else
	{
	    $np_pos=int($rel_pos+($np_position{$NP}));
	    $nparrow_pos=$np_pos-60;
	    $nparrow_pos2=$np_pos-40;
	}
    }
    else
    {
	if ($np_direction{$NP} eq "+")
	{
	    $np_pos=int($rel_pos-(abs($np_position{$NP})));
	    $nparrow_pos=$np_pos+60;
	    $nparrow_pos2=$np_pos+40;
	}
	else
	{
	    $np_pos=int($rel_pos-(abs($np_position{$NP})));
	    $nparrow_pos=$np_pos-60;
	    $nparrow_pos2=$np_pos-40;
	}
    }
    print TMP ("<polyline points\=\"$np_pos,170,$np_pos,130,$nparrow_pos,130,$nparrow_pos2,125,$nparrow_pos,130,$nparrow_pos2,125\" stroke\=\"green\" fill\=\"none\" onmouseover\=\"reactionnp$np(evt)\" onmouseout\=\"reactionnp$np(evt)\"\/>\n");
}
#Other EMBLs

$y=130;
foreach $SV(@SV)
{
    $em++;
    if ($position_start{$SV}<0)
    {
	$em_start=1050-(abs$position_start{$SV});
	$em_stop=1049+(abs$position_stop{$SV});
    }
    else
    {
	$em_start=1050-(abs$position_stop{$SV});
	$em_stop=1050+(abs$position_start{$SV});
    }
    $width=$em_stop-$em_start;
    $arrow_begin=$y+50;
    $arrow_top=$y+45;
    $arrow_bottom=$y+55;
    $y=$y+60;

    if ($em_start < 50)
    {
	$em_start=50;
	$width=$em_stop-$em_start;
	print TMP ("<polyline points\=\"110,$arrow_begin,50,$arrow_begin,70,$arrow_top,50,$arrow_begin,70,$arrow_bottom\" stroke\=\"blue\" fill\=\"none\"\/>\n");
    }
    if ($em_stop > 2050)
    {
	$em_stop = 2050;
	$width=$em_stop-$em_start;
	print TMP ("<polyline points\=\"1990,$arrow_begin,2050,$arrow_begin,2030,$arrow_top,2050,$arrow_begin,2030,$arrow_bottom\" stroke\=\"blue\" fill\=\"none\"\/>\n");
    }
    print TMP ("<rect id\=\"embl1\" x\=\"$em_start\" y\=\"$y\" width\=\"$width\" height\=\"30\" fill\=\"\#eeeeff\" stroke\=\"red\" stroke-width\=\"1\" onmouseover\=\"reaction$em(evt)\" onmouseout\=\"reaction$em(evt)\"/>\n");
}


#Transfac entries#

foreach $TF(@TF)
{
    $tf++;
    if (($TF_position_start{$TF} < 0) && ($TF_position_stop{$TF} < 0))
    {
	if (abs($TF_position_start{$TF}) > abs($TF_position_stop{$TF}))
	{
	    $tf_start=$rel_pos-(abs($TF_position_start{$TF}));
	}
	else
	{
	    $tf_start=$rel_pos-(abs($TF_position_stop{$TF}));
	}
	$tf_length=abs((abs($TF_position_start{$TF})-abs($TF_position_stop{$TF})));
    }
    if (($TF_position_start{$TF} > 0) && ($TF_position_stop{$TF} > 0))
    {
	if (abs($TF_position_start{$TF}) < abs($TF_position_stop{$TF}))
	{
	    $tf_start=$rel_pos+(abs($TF_position_start{$TF}));
	}
	else
	{
	    $tf_start=$rel_pos+(abs($TF_position_stop{$TF}));
	}
	$tf_length=abs((abs($TF_position_start{$TF})-abs($TF_position_stop{$TF}))/2);
    }
    if (($TF_position_start{$TF} < 0) && ($TF_position_stop{$TF} > 0))
    {
	$tf_start=$rel_pos-(abs($TF_position_start{$TF}));
	$tf_length=abs((abs($TF_position_start{$TF})+abs($TF_position_stop{$TF})));
    }
    if (($TF_position_start{$TF} > 0) && ($TF_position_stop{$TF} < 0))
    {
	$tf_start=$rel_pos-(abs($TF_position_stop{$TF}/2));
	$tf_length=abs((abs($TF_position_start{$TF})+abs($TF_position_stop{$TF}))/2);
    }
    $int=$tf/2;
    if ($int =~ /\./)
    {
	print TMP ("<rect id\=\"tf$tf\" x\=\"$tf_start\" y\=\"90\" width\=\"$tf_length\" height\=\"30\" fill\=\"yellow\" stroke\=\"blue\" stroke-width\=\"1\" onmouseover\=\"reactiontf$tf(evt)\" onmouseout\=\"reactiontf$tf(evt)\"/>\n");
    }
    else
    {
	print TMP ("<rect id\=\"tf$tf\" x\=\"$tf_start\" y\=\"50\" width\=\"$tf_length\" height\=\"30\" fill\=\"yellow\" stroke\=\"blue\" stroke-width\=\"1\" onmouseover\=\"reactiontf$tf(evt)\" onmouseout\=\"reactiontf$tf(evt)\"/>\n");
    }
}
$em=0;
$prom=1;
$tf=0;
$np=0;
print TMP ("<script><\!\[CDATA\[\n");
print TMP ("function reactionprom$prom (evt)\n\{\nvar target \= evt\.getTarget\(\)\;\nvar svgdoc \= target\.getOwnerDocument\(\)\;\nvar svgobj \= svgdoc\.getElementById \(\'prom$prom\'\)\;\nvar svgstyle \= svgobj\.getStyle\(\)\;\nswitch \(evt\.getType\(\)+\'\'\)\n\{\ncase \'mouseover\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'blue\'\)\;\nbreak\;\ncase \'mouseout\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'none\'\)\;\nbreak\;\}\}\n");

foreach $epd(@epd)
{
    $prom++;
    print TMP ("function reactionprom$prom (evt)\n\{\nvar target \= evt\.getTarget\(\)\;\nvar svgdoc \= target\.getOwnerDocument\(\)\;\nvar svgobj \= svgdoc\.getElementById \(\'prom$prom\'\)\;\nvar svgstyle \= svgobj\.getStyle\(\)\;\nswitch \(evt\.getType\(\)+\'\'\)\n\{\ncase \'mouseover\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'blue\'\)\;\nbreak\;\ncase \'mouseout\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'none\'\)\;\nbreak\;\}\}\n");
}
foreach $NP(@NP)
{
    $np++;
    print TMP ("function reactionnp$np (evt)\n\{\nvar target \= evt\.getTarget\(\)\;\nvar svgdoc \= target\.getOwnerDocument\(\)\;\nvar svgobj \= svgdoc\.getElementById \(\'np$np\'\)\;\nvar svgstyle \= svgobj\.getStyle\(\)\;\nswitch \(evt\.getType\(\)+\'\'\)\n\{\ncase \'mouseover\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'blue\'\)\;\nbreak\;\ncase \'mouseout\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'none\'\)\;\nbreak\;\}\}\n");
}
foreach $SV(@SV)
{
    $em++;
    print TMP ("function reaction$em (evt)\n\{\nvar target \= evt\.getTarget\(\)\;\nvar svgdoc \= target\.getOwnerDocument\(\)\;\nvar svgobj \= svgdoc\.getElementById \(\'embl$em\'\)\;\nvar svgstyle \= svgobj\.getStyle\(\)\;\nswitch \(evt\.getType\(\)+\'\'\)\n\{\ncase \'mouseover\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'blue\'\)\;\nbreak\;\ncase \'mouseout\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'none\'\)\;\nbreak\;\}\}\n");
}

foreach $TF(@TF)
{
    $tf++;
    print TMP ("function reactiontf$tf (evt)\n\{\nvar target \= evt\.getTarget\(\)\;\nvar svgdoc \= target\.getOwnerDocument\(\)\;\nvar svgobj \= svgdoc\.getElementById \(\'tf$tf\'\)\;\nvar svgstyle \= svgobj\.getStyle\(\)\;\nswitch \(evt\.getType\(\)+\'\'\)\n\{\ncase \'mouseover\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'blue\'\)\;\nbreak\;\ncase \'mouseout\'\:\nsvgstyle\.setProperty \(\'fill\'\,\'none\'\)\;\nbreak\;\}\}\n");
}

print TMP ("\]\]><\/script>\n");
print TMP ("<\/svg>");
close (TMP);


#print "\<HTML\>\n\<BODY bgcolor\=white\>\n";
print "\<EMBED SRC\=\"\/epd\/wwwtmp\/$epd_AC\.svg\" WIDTH\=\"100%\" HEIGHT\=\"100%\"\>";
#print "\<\/BODY\>\n\<\/HTML\>";
