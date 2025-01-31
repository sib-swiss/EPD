<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php readfile("../../header.php"); ?>

<div style='font-size: 14px; text-align: justify; width:95%;'>
<p align="right"><font size=-1><a href='Mm_epdnew_pipeline.pdf'>Printer version</a></font></p>


<H1>TSS assembly pipeline for Mm_EPDnew_001</H1>
<P>
<h2>Introduction</h2>

This document provides a technical description
of the transcription start site assembly pipeline that was used to
generate EPDnew version 001 for <i>Mus musculus</i> genome
assembly mm9.
<p>

<h2>Source Data</h2>

<table border=1 cellpadding=5  width="100%">
<col width="100">
<col width="100">
<tr>
<td>Description</td>
<td>URLs</td>
</tr>

<tr>
<td>ENSEMBL65</td> <td>Source URL: <a
href="http://dec2011.archive.ensembl.org/">http://dec2011.archive.ensembl.org</a>
<br>MGA
data: <a
href="/ftp/epdnew/ENSEMBL/mouse/ENSEMBL65/Mm_ENSEMBL65.sga">
/ftp/epdnew/ENSEMBL/mouse/ENSEMBL65/Mm_ENSEMBL65.sga</a></td>
</td> </tr>

<tr>
<td>DBTSS7</td> <td>Source URL<a
href="ftp://ftp.hgc.jp/pub/hgc/db/dbtss/dbtss_ver7">ftp://ftp.hgc.jp/pub/hgc/db/dbtss/dbtss_ver7</a>
<br>MGA doc: <a
href="<?php echo $url_ccg; ?>/mga/mm9/dbtss7/dbtss7.html">
/mga/hg18/dbtss7/dbtss7.html </a> <br>MGA
data: <a
href="<?php echo $url_ftp; ?>/mga/mm9/dbtss7/dbtss7.sga.gz">
<?php echo $url_ftp; ?>/mga/hg18/dbtss7/dbtss7.sga.gz</a></td>
</td> </tr>

</table>

<h2>Assembly pipeline overview</h2>
<p>
<center>
<table border=1 cellpadding=10>
<col width="300">
<tr><td>
<img src="./epdnew_flowchart_small.jpeg">
</td></tr></table></center>
<p>
<h2>Description of procedures and intermediate data files</h2>

<h3>1. Biomart Download</h3>

Data was downloaded from <a
href="http://dec2011.archive.ensembl.org/biomart/martview/">
dec2011.archive.ensembl.org/biomart/martview/</a> selecting the
following attributes:<br><br>

<ol>
<li>Ensembl Gene ID</li>
<li>Ensembl Transcript ID</li>
<li>Chromosome Name</li>
<li>Strand</li>
<li>Transcript Start (bp)</li>
<li>Transcript End (bp)</li>
<li>Gene Start (bp)</li>
<li>Gene End (bp)</li>
<li>Status (transcript) </li>
<li>Status (gene) </li>
<li>Associated Gene Name</li>
</ol>

Then, transcrips have been filtered according to the following rules:

<ol>
<li>Transcripts of protein coding genes only</li>
<li>Transcript length > 0 [Transcript Start different from Transcript
    End]</li>
<li>Transcript lies on full chromosomes</li>
<li>Gene must have a 5' UTR [Transcript Start different from Gene
    Start]</li>
<li>Genes must be annotated [Associated Gene Name present]</li>
<li>Gene and transcripts status known</li>
</ol>

Gene names were taken from the field "Associated Gene Name". Since the
EPD format doesn't allow gene names longer than 18 characters,
we checked whether the names repsected this limitation.<br>

Transcripts with the same TSS position were merged under a common ID. As
a conseguence of this, from the 95884 transcrips originally present
  in the ENSEMBL database, ~30000 were merged, leaving 67440 uniquely
mapped promoters in the input list.

<h3>2. EMBL TSS collection</h3>

The ENSEMBL TSS collection is stored as a tab-deliminated text file
conforming to the SGA format under the name:

<ul>
<i>Mm_ENSEMBL65.sga</i>
</ul>

The six field contain the following kinds of information:

<ul>
<li>NCBI/RefSeq chromosome id</li>
<li>"TSS"</li>
<li>position</li>
<li>strand ("+" or "-")</li>
<li>"1"</li>
<li>gene name.</li>
</ul>
Note that the second and forth fields are invariant.

<h3>3. Data import from DBTSS7</h3>

     Solexa Tag Data were downloaded from DBTSS ftp-site (see link above).
     The source files are the following:

<ul>
<li>3t3_data.tab.gz: Mouse 3T3 Solexa tag mapping data;</li>
</ul>

According to the readme file included in the ftp archive, the 5' end
tags were mapped to the Human genome hg18. The source format is a
non-standard tab-delimited format that has been converted to SGA via
an ad hoc perl script. All tissues have been merged into a single file.

<h3>4. CAGE tags</h3>

The compressed version of this file is available from the MGA
archive (see above) under the name:

<ul>
<i>dbtss7.sga.gz</i>.
</ul>


<H3>5. mRNA 5' tags peak calling</H3>

Peak calling for the merged file has been carried out using <a
href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
on-line tool with the following parameters:

<ul>
<li>Window width = 100</li>
<li>Vicinity range = 200</li>
<li>Peak refine = Y</li>
<li>Count cutoff = 9999999</li>
<li>Threshold = 10</li>
</ul>

The sga file containing the list of peaks can be downloaded
<a href='Mm_allRNAdata_peaks.sga.gz'>here</a>.

<h3>6. TSS validation and shifting</h3>

The source data (mRNA peaks and ENSEMBL TSS) was then processed
in a pipeline aiming at validating transcription start sites with
mRNA peaks. An ENSEMBL TSS was experimentally confirmed if an mRNA peak lied in a
window of 100 bp around it. The validated TSS was then shifted
to the nearest base with the higher tag density. After this step, the
total number of validated promoters was 9773.

<p>The list of validated and shifted promoters can be downloaded
<a href='/ftp/epdnew/mouse/001/Mm_EPDnew_001_mm9.sga'>here</a>.

<h3>7. ENSEMBL not-validated TSS</h3>

The total number of non mRNA validated TSS was 57667.

<h3>8. EPDnew collection</h3>

The 9773 experimentally validated promoter were stored in the EPDnew
database that can be downloaded from our ftp site. Scientist are
wellcome to use our other tools
<a href='<?php echo $url_ccg; ?>/chipseq/'>ChIP-Seq</a>
(for correlation analysis) and
<a href='<?php echo $url_ccg; ?>/ssa/'>SSA</a>
(for motifs analysis around promoters) to analyse EPDnew database.

<br><br>

</div>

<!-- ######### Insert the footer #########-->
<?php readfile("../../footer.html"); ?>





</body>
</html>
