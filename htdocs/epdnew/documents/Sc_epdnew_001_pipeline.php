<?php include("../../header.php"); ?>

<div style='font-size: 14px; text-align: justify; width:95%;'>
  <!--p align="right"><font size=-1><a href='Hs_epdnew_002_pipeline.pdf'>Printer version</a></font></p -->


<H1>TSS assembly pipeline for Sc_EPDnew_001</H1>
<P>
<h2>Introduction</h2>

This document provides a technical description
of the transcription start site assembly pipeline that was used to
generate EPDnew version 001 for <i>S. cerevisiae</i> genome
assembly sacCer3.
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
<td>SGD genes</td> <td>Source URL: <a
href="https://genome.ucsc.edu/cgi-bin/hgTables?command=start">https://genome.ucsc.edu/cgi-bin/hgTables?command=start</a>
<br>MGA
data: <a
href="<?php echo $url_ftp; ?>/mga/sacCer3/sgd/sgdGenes.sga.gz">
<?php echo $url_ftp; ?>/mga/sacCer3/sgd/sgdGenes.sga.gz</a></td>
</td> </tr>

<tr>
<td>Park14</td> <td>Source URL: <a
href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE49026">GEO series GSE49026</a>
<br>MGA doc: <a
href="<?php echo $url_ftp; ?>/mga/sacCer3/park14/park14.html">
<?php echo $url_ftp; ?>/mga/sacCer3/park14/park14.html </a> <br>MGA
data: <a
href="<?php echo $url_ftp; ?>/mga/sacCer3/park14/">
<?php echo $url_ftp; ?>/mga/sacCer3/park14/</a></td>
</td> </tr>

</table>

<h2>Assembly pipeline overview</h2>
<p>
<center>
<table border=1 cellpadding=10>
<col width="300">
<tr><td>
<img width="700" src="/miniepd/epdnew/epdnewGeneralPipeline.jpg">
</td></tr></table></center>
<p>
<h2>Description of procedures and intermediate data files</h2>

<h3>1. Download annotated TSS</h3>

Data was downloaded from <a
href="https://genome.ucsc.edu/cgi-bin/hgTables?command=start">
UCSC table browser</a> the 02-02-2015</ol>.

Transcrips have been filtered according to the following rules:

<ol>
<li>Transcripts of protein coding genes only</li>
<li>Transcript lies on full chromosomes</li>
<li>Genes must be annotated [Associated Gene Name present]</li>
<li>Gene and transcripts status known</li>
</ol>

Gene names were taken from the field "Associated Gene Name". Since the
EPD format doesn't allow gene names longer than 18 characters,
we checked whether the names repsected this limitation.<br>

A total number of 6692 promoters were selected.

<h3>2. SGD TSS collection</h3>

The SGD TSS collection is stored as a tab-deliminated text file
conforming to the SGA format under the name:

<ul>
<i>sgdGenes.sga</i>
</ul>

The six field contain the following kinds of information:

<ul>
<li>NCBI/RefSeq chromosome id</li>
<li>"TSS"</li>
<li>position</li>
<li>strand ("+" or "-")</li>
<li>"1"</li>
<li>gene name</li>
</ul>
Note that the second and forth fields are invariant.

<h3>3. Import CAGE data</h3>

Data was imported from GEO as SRA file format. Raw sequence files were
mapped to sacCer3 genome using Bowtie. The resulting BAM files were converted to SGA file format using <a href="<?php echo $url_ccg; ?>/chipseq/chip_convert.php">ChIP-Convert</a>.<br>
A step-by-step guide on how to import, map and convert these samples can be found <a href="park14Pipeline.txt">here</a>

<H3>5. mRNA 5' tags peak calling</H3>

For each individual sample (3), peak calling for the merged file has been
carried out using <a
href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
on-line tool with the following parameters:

<ul>
<li>Window width = 200</li>
<li>Vicinity range = 200</li>
<li>Peak refine = Y</li>
<li>Count cutoff = 9999999</li>
<li>Threshold = 5</li>
</ul>


<h3>6. TSS validation and shifting</h3>

Each sample in the collection (mRNA peaks and UCSC TSS) was then
separately processed in a pipeline aiming at validating transcription
start sites with mRNA peaks. A UCSC TSS was experimentally confirmed
if an mRNA peak lied in a window of 500 bp around it. The validated
TSS was then shifted to the nearest base with the higher tag
density.

    <h3>7. UCSC not-validated TSS</h3>

    The total number (summing up all samples) of non experimentally validated TSS was around 3000.

    <h3>8. Promoter collection for each sample</h3>

    Each sample in the dataset was used to generate a separate
    promoter collection. Potentially, the same transcript could be
    validated by multiple samples and it could have different start
    sites in different samples. To avoid redundancy, the individual
    collections were used as input for an additional step in the
    analysis (Assembly pipeline part B).

    <h3>9. Merging collections and second TSS selection</h3>

    The 3 promoter collections were merged into a unique file and
    further analysed. Transcript
    validated by multiple samples could potentially have the TSS set
    on a broader region and not to single position. To avoid such
    inconsistency, for each transcript we selected the position that
    was validated by the larger number of samples as the true TSS.

    <h3>10. Filtering</h3>

    Transcription Start Sites that mapped closed to other TSS that
    belonged to the same gene (500 bp window) were merged into a
    unique promoter following the same rule: the promoter that was
    validated by the higher number of samples was kept.

    <h3>10. Final EPDnew collection</h3>

    The 4300 experimentally validated promoter were stored in the
    EPDnew database that can be downloaded from our ftp
    site. Scientist are wellcome to use our other tools <a
    href='<?php echo $url_ccg; ?>/chipseq/'>ChIP-Seq</a> (for
    correlation analysis) and <a
    href='<?php echo $url_ccg; ?>/ssa/'>SSA</a> (for motifs analysis
    around promoters) to analyse EPDnew database.

    <br><br>

    </div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>

