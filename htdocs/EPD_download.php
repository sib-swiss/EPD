<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("header.php"); ?>



<br><br>
<div style='font-size: 14px; text-align: justify; width:95%;'>
   Download the <b>complete promoter collection</b> for the following databases:
</div>
<br>
<table style='min-width:600px;'>
<tr class='border-bottom'>
<td style='min-width:300px;'><FORM action="/cgi-bin/miniepd/seq_download.pl" method="POST">
   Download <b>EPD</b> (<a href="#" onclick="toggle('panel');">refine selection</a>)
<div style='display:none;' id='panel'>
<UL><INPUT type=checkbox         name=all checked='checked' id='allpromoters'>All promoters (4809)
<UL><INPUT type=checkbox onclick="unchekall();"        name=g1 >Plant promoters (198)
<UL><INPUT type=checkbox onclick="unchekall();"        name=g11>Chromosomal genes (186)
<UL><INPUT type=checkbox onclick="unchekall();"        name=zm >Zea mays (maize) (21)</UL>
<INPUT type=checkbox onclick="unchekall();"        name=g12>Prokaryotic plasmid DNA (8)
<BR><INPUT type=checkbox onclick="unchekall();"        name=g13>Viral genes (4)</UL>
<INPUT type=checkbox onclick="unchekall();"        name=g2 >Nematode promoters (26)
<BR><INPUT type=checkbox onclick="unchekall();"        name=g3 >Arthropode promoters (2000)
<UL><INPUT type=checkbox onclick="unchekall();"        name=g31>Chromosomal genes (1991)
<UL><INPUT type=checkbox onclick="unchekall();"        name=dm >Drosophila melanogaster (fruit
fly) (1926)</UL>
<INPUT type=checkbox onclick="unchekall();"        name=g32>Transposable elements and retroviruses (5)
<BR><INPUT type=checkbox onclick="unchekall();"         name=g33>Viral genes (5)</UL>
<INPUT type=checkbox onclick="unchekall();"         name=g4 >Mollusc promoters (3)
<BR><INPUT type=checkbox onclick="unchekall();"         name=g5 >Echinoderm promoters (44)
<BR><INPUT type=checkbox onclick="unchekall();"         name=g6 >Vertebrate promoters (2540)
<UL><INPUT type=checkbox onclick="unchekall();"         name=g61>Chromosomal genes (2383)
<UL><INPUT type=checkbox onclick="unchekall();"         name=xl >Xenopus laevis (African clawed
frog) (28)
<BR><INPUT type=checkbox onclick="unchekall();"         name=gg >Gallus gallus (chicken) (72)
<BR><INPUT type=checkbox onclick="unchekall();"         name=mm >Mus musculus (mouse) (196)
<BR><INPUT type=checkbox onclick="unchekall();"         name=rn >Rattus norvegicus (rat) (119)
<BR><INPUT type=checkbox onclick="unchekall();"         name=bt >Bos taurus (cattle) (24)
<BR><INPUT type=checkbox onclick="unchekall();"         name=hs >Homo sapiens (man) (1871)&nbsp;</UL>
<INPUT type=checkbox onclick="unchekall();"         name=g62>Transposable elements and retroviruses (28)
<BR><INPUT type=checkbox onclick="unchekall();"         name=g63>Viral genes (129)
<UL><INPUT type=checkbox onclick="unchekall();"         name=ebv>EBV (Human Epstein-Barr virus) (23)
<BR><INPUT type=checkbox onclick="unchekall();"         name=hsv>HSV-1 (Human herpes simplex virus
type 1) (48)</UL>
</UL>
</UL>
Preliminary EPD entries:
<UL><INPUT type=checkbox onclick="unchekall();"         name=buos>Oryza sativa (rice) (13046)
</UL>
</UL>
<INPUT type=radio checked name=is value="-">All promoters&nbsp;
or&nbsp;<INPUT type=radio         name=is value="+">Representative set
of not closely related sequences&nbsp;&nbsp;
<br><font size="1">
Sequence download is limited to segments smaller than 16kb in the range between -9999 and 10000 bp relative to the transcription start site.
You may select several of the taxonomic subsets proposed below.
The sequence retrieval operation will be applied to the union of the
selected subsets. Checking the box
<i>"Representative sets of not closely related sequences"
</i>causes extraction of a subset of promoters
not sharing more than 50% sequence identity among each other.
This is useful for statistical analyses where
one wants to avoid bias by families of similar sequences.
If an EMBL sequence entry does not cover
the entire sequence range specified below, the returned
sequence will be padded with n's at the beginning or at the end.
This ensures that all extracted sequences will have the same length, with the transcription initiation
sites being located at the same internal positions.<br>
For download of the complete set of promoters, please use the <a href="https://epd.expasy.org/ftp/epd/views/">ftp site</a>.(files in FASTA format: [epd**.seq] or in EMBL format: [epd**.blk]) <br><br>
</font>
</div>
</td>
<td style='min-width:270px;'><b>from</b> <INPUT type="text" name="from" size="5" value="-499">
<b>to</b> <INPUT type="text" name="to"   size="5" value="100">
as</FONT><SELECT name=format>
<OPTION value="F">Fasta
<OPTION value="E">EMBL</SELECT>
</td><td><INPUT type="submit" class="epdsubmit" value="Download"></td></tr>
</table>



<!-- ######### Insert the footer #########-->
<?php readfile("footer.html"); ?>
