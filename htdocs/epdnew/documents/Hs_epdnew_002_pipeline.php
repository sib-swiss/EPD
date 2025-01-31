
<?php include("../../header.php"); ?>

<div style='font-size: 14px; text-align: justify; width:95%;'>
<p align="right"><font size=-1><a href='Hs_epdnew_002_pipeline.pdf'>Printer version</a></font></p>


<H1>TSS assembly pipeline for Hs_EPDnew_002</H1>
<P>
<h2>Introduction</h2>

This document provides a technical description
of the transcription start site assembly pipeline that was used to
   generate EPDnew version 002 for <i>Homo sapiens</i> genome
assembly hg19.
<p>

<h2>Source Data</h2>

<table border=1 cellpadding=5  width="100%">
<tr>
<td>Description</td>
<td>URLs</td>
</tr>

<tr>
<td>ENSEMBL69</td> <td>Source URL: <a
href="http://oct2012.archive.ensembl.org/">http://oct2012.archive.ensembl.org</a>
<br>MGA doc: <a
href="<?php echo $url_ccg; ?>/mga/hg19/ensembl69/ensembl69.html">
/mga/hg19/ensembl69/ensembl69.html</a> <br>MGA
data: <a
href="<?php echo $url_ftp; ?>/mga/hg19/ensembl69/Hum_ENSEMBL69.sga.gz">
<?php echo $url_ftp; ?>/mga/hg69/ensembl69/Hum_ENSEMBL69.sga.gz</a></td>
</td> </tr>

<tr>
<td>ENCODE data</td> <td>Source URL<a
href="http://hgdownload.cse.ucsc.edu/goldenPath/hg19/encodeDCC/wgEncodeRikenCage/">http://hgdownload.cse.ucsc.edu/goldenPath/hg19/encodeDCC/wgEncodeRikenCage/</a>
<br>MGA doc: <a
href="<?php echo $url_ccg; ?>/mga/hg19/encode/GSE34448/GSE34448.html">
/mga/hg19/encode/GSE34448/GSE34448.html</a> <br>MGA
data: <a
href="<?php echo $url_ftp; ?>/mga/hg19/encode/GSE34448/">
<?php echo $url_ftp; ?>/mga/hg19/encode/GSE34448/</a></td>
</td> </tr>

</table>

<h2>Assembly pipeline overview</h2>
<p>
<center>
<table border=1 cellpadding=10>
<col width="300">
<tr><td>
<img src="./epdnew_002_pipeline.jpg"  width="700">
</td></tr></table></center>
<p>
<h2>Description of procedures and intermediate data files</h2>

<h3>1. Biomart Download</h3>

Data was downloaded from <a
href="http://oct2012.archive.ensembl.org/biomart/martview/">
oct2012.archive.ensembl.org/biomart/martview/</a> selecting the
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
<li>Genes must be annotated [Associated Gene Name present]</li>
<li>Gene and transcripts status known</li>
</ol>

Gene names were taken from the field "Associated Gene Name". Since the
EPD format doesn't allow gene names longer than 18 characters,
we checked whether the names repsected this limitation.<br>

Transcripts with the same TSS position were merged under a common
ID. As a conseguence of this the total number of TSS in the list was
100276.

<h3>2. EMBL TSS collection</h3>

The ENSEMBL TSS collection is stored as a tab-deliminated text file
conforming to the SGA format under the name:

<ul>
<i>Hum_ENSEMBL69.sga</i>
</ul>

The six field contain the following kinds of information:

<ul>
<li>NCBI/RefSeq chromosome id</li>
<li>"TSS"</li>
<li>position</li>
<li>strand ("+" or "-")</li>
<li>"1"</li>
<li>TranscriptID..GeneName.</li>
</ul>
Note that the second and forth fields are invariant.

<h3>3. Data import from ENCODE CAGE</h3>

     Solexa Tag Data were downloaded from UCSC ftp-site (see link
     above).  The source files are in bam format. The complete list of
     files can be found <a
     href="<?php echo $url_ccg; ?>/mga/hg19/encode/GSE34448/GSE34448.html">
     here</a>.

Bam files were converted into bed files with bamToBed program. Files
were keps and analysed individually.

<h3>4. CAGE tags</h3>

The compressed version of these file are available from the MGA
archive (see above) under the GEO series ID GSE3444.


<H3>5. mRNA 5' tags peak calling</H3>


Peak calling for each individual CAGE data file has been carried out using <a
href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
on-line tool with the following parameters:

<ul>
<li>Window width = 200</li>
<li>Vicinity range = 200</li>
<li>Peak refine = N</li>
<li>Count cutoff = 9999999</li>
<li>Threshold = 10</li>
</ul>


<h3>6. TSS validation and shifting</h3>

Each sample in the collection (mRNA peaks and ENSEMBL TSS) was then processed
in a pipeline aiming at validating transcription start sites with
mRNA peaks. An ENSEMBL TSS was experimentally confirmed if a CAGE peak lied
in a window of 100 bp around it and if it had a maximum high of at least 10
tags. The validated TSS was then shifted
to the nearest base with the higher tag density.


<h3>7. ENSEMBL not-validated TSS</h3>

   The total number (summing up all samples) of non experimentally validated TSS was around 75000.

<h3>8. Promoter collection for each sample</h3>

   Each sample in the dataset was used to generate a separate promoter collection. These individual collections were used as input for an additional step in the analysis (Assembly pipeline part B). The aim of this step was to select the promoters that were validated by high number of samples thus increasing their reliability.

<h3>9. Merging of the data and second TSS selection</h3>

   The 145 promoter collections were merge into a unique file and further analysed. The promoter of a transcript was mantained in the list only if validated by at least two samples. This could potentially lead to TSS to be set on a broader region and not to single position. To avoid such inconsistency, for each transcript we selected the position that was validated by the larger number of samples as the true promoter.

<h3>10. Filtering</h3>

   Transcription Start Sites that mapped closed to other TSS that belonged to the same gene (200 bp window) were merged into a unique promoter following the same rule: the promoter that was validated by the higher number of samples was kept.

<h3>10. Final EPDnew collection</h3>

The 25988 experimentally validated promoter were stored in the EPDnew
database that can be downloaded from our ftp site. Scientist are
wellcome to use our other tools
<a href='<?php echo $url_ccg; ?>/chipseq/'>ChIP-Seq</a>
(for correlation analysis) and
<a href='<?php echo $url_ccg; ?>/ssa/'>SSA</a>
(for motifs analysis around promoters) to analyse EPDnew database.

<br><br>

</div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>





</body>
</html>

