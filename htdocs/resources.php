<?php
include("header.php");
include("url_extern.php")
?>


<br><br>
<table cellpadding=1 cellspacing=2 border=0 width="80%">
<tr>
<td align="right">
<a name="note"></a>
<font size=-1>
   <A href="<?php echo $url_chipseq; ?>/">ChIP-Seq</A>:</td><td><font size=-1>The ChIP-Seq Web Server provides access to a set of useful tools performing common ChIP-Seq data analysis tasks, including positional correlation analysis, peak detection, and genome partitioning into signal-rich and signal-poor regions. Users can analyse their own data by uploading mapped sequence tags in various formats, including BED and BAM. The server also provides access to hundreds of publicly available data sets such as ChIP-seq data, RNA-seq data (i.e. CAGE), DNA-methylation data, sequence annotations (promoters, polyA-sites, etc.), and sequence-derived features (CpG, phastCons scores). </td></tr></font>
<tr>
<td align="right">
<a name="note"></a>
<font size=-1>
   <A href="<?php echo $url_madap; ?>/">MADAP</A>:</td><td><font size=-1>Clustering tool for the interpretation of one-dimensional genome annotation data</td></tr></font>
<tr>
<td align="right">
<font size=-1>
   <A href="<?php echo $url_ssa; ?>/">SSA</A>:</td><td><font size=-1>The Signal Search Analysis Server</td></tr></font>
<tr>
<td align="right">
<font size=-1>
   <A href="<?php echo $url_tagger; ?>/tagscan.html">TagScan</A>:</td><td><font size=-1>Fast sequence tag mapping</td></tr></font>
<tr>
<td align="right">
<font size=-1>
   <A href="<?php echo $url_tromer; ?>/"> TROMER Database</A>:</td><td><font size=-1>Transcriptome analyser documenting all transcribed elements</td></tr></font>
<!-- <tr> -->
<!-- <td align="right"> -->
<!-- <font size=-1> -->
<!--    <A href="http://cleanex.vital-it.ch/">CleanEx</A>:</td><td><font size=-1>A database which provides access to public gene expression data via unique approved gene symbols.</td></tr></font> -->
<tr>
<td align="right">
<font size=-1>
   <A href="https://myhits.sib.swiss/">myHITS</A>:</td><td><font size=-1>A database and web tools devoted to protein domains</td></tr></font>
<!--tr>
<td align="right">
<font size=-1>
   <A href="http://www.ch.embnet.org/">EMBnet</A>:</td><td><font size=-1>Swiss node of the EMBnet Group</td></tr></font>
</font-->
</table>

<!-- ######### Insert the footer #########-->
<?php readfile("footer.html"); ?>

</body>
</html>
