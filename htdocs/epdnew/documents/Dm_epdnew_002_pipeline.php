<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("../../header.php"); ?>


<H1>TSS assembly pipeline for Dm_EPDnew_002</H1>

<h2>Introduction</h2>

<p>
  This document provides a technical description of the transcription
  start site assembly pipeline that was used to generate EPDnew
  version 002 for Drosophila melanogaster genome assembly dm3.
</p>

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
<a href="https://www.ncbi.nlm.nih.gov/pubmed/21177961">PMID: 21177961</a></td>
<td><br>Source URL: <a href="http://genome.cshlp.org/content/21/2/182/suppl/DC1">
http://genome.cshlp.org/content/21/2/182/suppl/DC1</a>
<br>MGA doc: <a href="<?php echo $url_ccg; ?>/mga/dm3/hoskins11/hoskins11.html">
/mga/dm3/hoskins11/hoskins11.html</a>
<br>MGA data: <a href="<?php echo $url_ftp; ?>/mga/dm3/hoskins11/embryo_cage.sga.gz">
<?php echo $url_ftp; ?>/mga/dm3/hoskins11/embryo_cage.sga.gz</a></td>
</td>
</tr>

<tr>
<td>CAGE data from modEncode.  <a
href="https://www.ncbi.nlm.nih.gov/pubmed/24985915">PMID:
24985915</a></td> <td>Source URL: <a
href="https://www.ncbi.nlm.nih.gov/sra?term=SRP001602">
https://www.ncbi.nlm.nih.gov/sra?term=SRP001602</a>
<!-- br>MGA doc: <a
href="<?php echo $url_ccg; ?>/mga/dm3/gan10/gan10.html">
/mga/dm3/gan10/gan10.html</a --> <br>MGA data: <a
href="<?php echo $url_ftp; ?>/mga/dm3/encode/SRP001602/">
<?php echo $url_ftp; ?>/mga/dm3/encode/SRP001602/</a></td>
</td> </tr>

</table>

<h2>Assembly pipeline overview</h2>
<p>
<center>
<table border=1 cellpadding=10><tr><td>
<img width="700" src="/miniepd/epdnew/epdnewGeneralPipeline.jpg">
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
<i>ensemblTss.sga</i>.
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

<h3>7. Data import from SRA</h3>

BAM files for the SRA serie SRP001602 were downloaded from <a
href="https://www.ncbi.nlm.nih.gov/sra?term=SRP001602">
SRA site</a> and converted into SGA file using in house software.

    <h3>8. TSS validation and shifting</h3>

    Each sample in the collection (mRNA peaks and ENSEMBL TSS) was then
    processed in a pipeline aiming at validating transcription start
    sites with mRNA peaks. An UCSC TSS was experimentally confirmed if
    a CAGE peak lied in a window of 500 bp around it and if it had a
    maximum high of at least 3 tags. The validated TSS was then
    shifted to the nearest base with the higher tag density.


    <h3>9. Promoter collection for each sample</h3>

    Each sample in the dataset was used to generate a separate
    promoter collection. Potentially, the same transcript could be
    validated by multiple samples and it could have different start
    sites in different samples. To avoid redundancy, the individual
    collections were used as input for an additional step in the
    analysis (Assembly pipeline part B).

    <h3>10. Merging collections and second TSS selection</h3>

    All promoter collections were merged into a unique file and
    further analysed. The promoter of a transcript was mantained in
    the list only if validated by at least two samples. Transcript
    validated by multiple samples could potentially have the TSS set
    on a broader region and not to single position. To avoid such
    inconsistency, for each transcript we selected the position that
    was validated by the larger number of samples as the true TSS.

    <h3>11. Filtering</h3>

    Transcription Start Sites that mapped closed to other TSS that
    belonged to the same gene (500 bp window) were merged into a
    unique promoter following the same rule: the promoter that was
    validated by the higher number of samples was kept.

<h3>12. EPDnew collection</h3>

The experimentally validated promoter were stored in the EPDnew
database that can be downloaded from our ftp site. Scientist are
wellcome to use our other tools
<a href='<?php echo $url_ccg; ?>/chipseq/'>ChIP-Seq</a>
(for correlation analysis) and
<a href='<?php echo $url_ccg; ?>/ssa/'>SSA</a>
(for motifs analysis around promoters) to analyse EPDnew database.

<br><br>


<!-- ######### Insert the footer #########-->
<?php readfile("../../footer.html"); ?>





</body>
</html>

