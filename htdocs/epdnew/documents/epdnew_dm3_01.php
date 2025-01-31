<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("../../header.php"); ?>

<div style='font-size: 14px; text-align: justify; width:95%;'>
<p align="right"><font size=-1><a href='Dm_epdnew_pipeline.pdf'>Printer version</a></font></p>


<H1>TSS assembly pipeline for Dm_EPDnew_001</H1>
<P>
<h2>Introduction</h2>

This document provides a technical description
of the transcription start site assembly pipeline that was used to
generate EPDnew version 001 for Drosophila melanogaster genome
assembly dm3.
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
<td>ENSEMBL64</td> <td>Source URL: <a
href="http://sep2011.archive.ensembl.org">http://sep2011.archive.ensembl.org</a>
<br>MGA doc: <a
href="<?php echo $url_ccg; ?>/mga/dm3/ensembl64/ensembl64.html">
/mga/dm3/ensembl64/ensembl64.html</a> <br>MGA
data: <a
href="<?php echo $url_ftp; ?>/mga/dm3/ensembl64/dm3_ENSEMBL64.sga.gz">
<?php echo $url_ftp; ?>/mga/dm3/ensembl64/dm3_ENSEMBL64.sga.gz</a></td>
</td> </tr>

<tr>
<td>MachiBase</td> <td>Source URL<a
href="http://machibase.gi.k.u-tokyo.ac.jp/">http://machibase.gi.k.u-tokyo.ac.jp/</a>
<br>MGA doc: <a
href="<?php echo $url_ccg; ?>/mga/dm3/machibase/machibase.html">
/mga/dm3/machibase/machibase.html</a> <br>MGA
data: <a
href="<?php echo $url_ftp; ?>/mga/dm3/machibase/all_oligocap.sga.gz">
<?php echo $url_ftp; ?>/mga/dm3/machibase/all_oligocap.sga.gz</a></td>
</td> </tr>

<tr>
<td>CAGE data from Hoskins et a. 2012.
<a href="http://www.ncbi.nlm.nih.gov/pubmed/21177961">PMID: 21177961</a></td>
<td><br>Source URL: <a href="http://genome.cshlp.org/content/21/2/182/suppl/DC1">
http://genome.cshlp.org/content/21/2/182/suppl/DC1</a>
<br>MGA doc: <a href="<?php echo $url_ccg; ?>/mga/dm3/hoskins11/hoskins11.html">
/mga/dm3/hoskins11/hoskins11.html</a>
<br>MGA data: <a href="<?php echo $url_ftp; ?>/mga/dm3/hoskins11/embryo_cage.sga.gz">
<?php echo $url_ftp; ?>/mga/dm3/hoskins11/embryo_cage.sga.gz</a></td>
</td>
</tr>

<tr>
<td>H3K4me3 in S2 cells from Gan et al. 2010.  <a
href="http://www.ncbi.nlm.nih.gov/pubmed/20398323">PMID:
20398323</a></td> <td>Source URL: <a
href="http://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM480156">
http://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM480156</a>
<br>MGA doc: <a
href="<?php echo $url_ccg; ?>/mga/dm3/gan10/gan10.html">
/mga/dm3/gan10/gan10.html</a> <br>MGA data: <a
href="<?php echo $url_ftp; ?>/mga/dm3/gan10/GSM480156_dm3-S2-H3K4me3.sga.gz">
<?php echo $url_ftp; ?>/mga/dm3/gan10/GSM480156_dm3-S2-H3K4me3.sga.gz</a></td>
</td> </tr>

</table>

<h2>Assembly pipeline overview</h2>
<p>
<center>
<table border=1 cellpadding=10><tr><td>
<img src="./tss_assembly_pipeline_dm3_1.jpg">
</td></tr></table></center>
<p>
<h2>Description of procedures and intermediate data files</h2>

<h3>1. Biomart Download</h3>

Data was downloaded from <a
href="http://sep2011.archive.ensembl.org/biomart/martview/">
sep2011.archive.ensembl.org/biomart/martview/</a> selecting the
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
a conseguence of this, from the 23850 transcrips originally present
  in the ENSEMBL database, 5953 were merged, leaving 17897 uniquely
mapped promoters in the input list.

<h3>2. EMBL TSS collection</h3>

The ENSEMBL TSS collection is stored as a tab-deliminated text file
conforming to the SGA format under the name:

<ul>
<i>filename</i>.
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

<h3>3. Data import from MachiBase</h3>

MachiBase data were generated with the oligo-capping technology. The
source data were downloaded from:

<ul>
<a href="http://download.utgenome.org/pub/machibase/tssExp.tar.gz">
http://download.utgenome.org/pub/machibase/tssExp.tar.gz</a>
</ul>

According to the readme file included in the tar archive, the 5' end
tags were mapped to the Drosophila genome using BLAT as alignment tool
allowing for up to three mismatches.

<h3>4. oligocap tags</h3>

The compressed version of this file is available from the MGA
archive (see above) under the name:

<ul>
<i>all_oligocap.sga.gz</i>.
</ul>


<h3>5. Data import from Genome Research</h3>

Mapped sequence tags were extracted from Supplementary Data File 1
available from Genome Research at:
</p><ul>
<a href="http://genome.cshlp.org/content/21/2/182/suppl/DC1">
http://genome.cshlp.org/content/21/2/182/suppl/DC1</a>
</ul>
<p>
The downloaded source file is in SAM format and has been generated
with the tag mapping program StatMap as described in the article cyted
above. We extracted all tags with mapping quality scores greater or
equal to 30.

<H3>6. CAGE tags</h3>

The compressed version of this file is available from our ftp site
(see above link) with the name:

<ul>
<i>embryo_cage.sga.gz</i>
</ul>

<h3>7. Data import from GEO</h3>

BED files for the GEO serie GSE19325 were downloaded from <a
href="https://ftp.ncbi.nih.gov/pub/geo/DATA/supplementary/series/GSE19325/GSE19325_RAW.tar">
GEO ftp site</a> and converted into SGA file using in house software.

<h3>8. H3K4me3 tags</H3>

The compressed version of this file is available from our ftp site
(see above link) with the name:

<ul>
<i>GSM480156_dm3-S2-H3K4me3.sga.gz</i>
</ul>

<H3>9. mRNA 5' tags peak calling</H3>

CAGE tags and oligocap tags have been merged into a unique file with
the following command:

<ul>
sort -m -s -k1,1 -k3,3n -k4,4 embryo_cage.sga all_oligocap.sga &gt; all_data.sga
</ul>

Peak calling for the merged file has been carried out using <a
href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
on-line tool with the following parameters:

<ul>
<li>Window width = 100</li>
<li>Vicinity range = 200</li>
<li>Peak refine = Y</li>
<li>Count cutoff = 9999999</li>
<li>Threshold = 8</li>
</ul>

The sga file containing the list of peaks can be downloaded
<a href='Dm_allRNAdata_peaks.sga'>here</a>.

<h3>11. TSS validation and shifting</h3>

The source data (mRNA peaks and ENSEMBL TSS) was then processed
in a pipeline aiming at validating transcription start sites with
mRNA peaks. An ENSEMBL TSS was experimentally confirmed if an mRNA peak lied in a
window of 100 bp around it. The validated TSS was then shifted
to the nearest base with the higher tag density. After this step, the
total number of validated promoters was 10389.

<p>The list of validated and shifted promoters can be downloaded
<a href='Dm_shifted_promoters.sga'>here</a>.

<h3>12. ENSEMBL not-validated TSS</h3>

The total number of non mRNA validated TSS was 7508. These
promoters were not discarded but were the subject of the following
validation step.

<h3>13. H3K4me3 signature validation</h3>

H3K4me3 histone mark was used as a marker for promoter validation. The
7508 promoters that were not validated by mRNA signature were scored
according to the presence of H3K4me3 histon mark near the TSS. This
procedure recover more than 2000 promoters bringing the total number
of validated promoters to 12435.

<h3>15. EPDnew collection</h3>

The 12435 experimentally validated promoter were stored in the EPDnew
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
