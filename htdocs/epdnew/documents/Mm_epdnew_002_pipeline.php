<?php
include("../../header.php");

$assembly = "mm9";
$datfile = fopen("/home/local/db/mga/$assembly/$assembly.dat", "r");
while(!feof($datfile)) {
  $line = fgets($datfile);
  list($id, $name) = explode(": ", $line);
  if ($id == "Name"){
    list($organism, $v) = explode(" (", $name);
    $version = preg_replace('/\)/', '', $v);
  }
}
fclose($datfile);

?>

<div style='font-size: 14px; text-align: justify; width:95%;'>
  <!--p align="right"><font size=-1><a href='Hs_epdnew_002_pipeline.pdf'>Printer version</a></font></p -->


<H1>TSS assembly pipeline for Mm_EPDnew_002</H1>
<P>
<h2>Introduction</h2>

This document provides a technical description
of the transcription start site assembly pipeline that was used to
generate EPDnew version 002 for <i><?php echo $organism ?></i>.
<p>

<h2>Source Data</h2>

<p class='document'>
Promoter collection:

<table class='document'>
  <tr>
    <th class='document'>Name</th>
    <th class='document'>Genome Assembly</th>
    <th class='document'>Promoters</th>
    <th class='document'>Genes</th>
    <th class='document'>PMID</th>
    <th class='document' colspan='3'>Access data</th>
  </tr>
  <tr>
    <td class='document'>
      UCSC Known Genes
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
      25221
    </td>
    <td class='document'>
      19378
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/26590259'>26590259</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://genome.ucsc.edu/cgi-bin/hgTables?command=start'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/mm9/ucsc/ucsc.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/mm9/ucsc/ucsc_promoter_list.sga.gz'>
      DATA</a>
    </td>
  </tr>
</table>
</p>


<p class='document'>
Experimental data:
<table  class='document'>
  <tr>
    <th class='document'>Name</th>
    <th class='document'>Type</th>
    <th class='document'>Samples</th>
    <th class='document'>Tags</th>
    <th class='document'>PMID</th>
    <th class='document' colspan='3'>Access data</th>
  </tr>
  <tr>
    <td class='document'>
      FANTOM5
    </td>
    <td class='document'>
      CAGE
    </td>
    <td class='document'>
      340
    </td>
    <td class='document'>
      7,089,874,024
    </td>
    <td class='document'>
      <a href='https://www.ncbi.nlm.nih.gov/pubmed/24670764'>
      24670764</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://fantom.gsc.riken.jp/5/datafiles/latest/basic/'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/mm9/fantom5/fantom5.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/mm9/fantom5/'>
      DATA</a>
    </td>
  </tr>

  <tr>
    <td class='document'>
      DBTSS7
    </td>
    <td class='document'>
      CAGE
    </td>
    <td class='document'>
      1
    </td>
    <td class='document'>
      19,840,450
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/19910371'>
	19910371
      </a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='ftp://ftp.hgc.jp/pub/hgc/db/dbtss/dbtss_ver7'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a qtarget='_blank'
      href='<?php echo $url_ccg; ?>/mga/mm9/dbtss7/dbtss7.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/mm9/dbtss7/dbtss7.sga.gz'>
      DATA</a>
    </td>
  </tr>
</table>
</p>

<h2>Assembly pipeline overview</h2>
<p>
<center>
<table border=1 cellpadding=10>
<col width="300">
<tr><td>
<img style=' max-width: 700px;' src="/miniepd/epdnew/epdnewGeneralPipeline.jpg">
</td></tr></table></center>
<p>
<h2>Description of procedures and intermediate data files</h2>

<h3>1. UCSC Download</h3>

Data was downloaded from <a
href="https://genome.ucsc.edu/cgi-bin/hgTables?command=start">
UCSC table browser</a> the 15th of MAy 2014</ol>

Then, transcrips have been filtered according to the following rules:

<ol>
<li>Transcripts of protein coding genes only</li>
<li>Transcript lies on full chromosomes</li>
<li>Genes must be annotated [Associated Gene Name present]</li>
<li>Gene and transcripts status known</li>
</ol>

Gene names were taken from the field "Associated Gene Name". Since the
EPD format doesn't allow gene names longer than 18 characters,
we checked whether the names repsected this limitation.<br>

Transcripts with the same TSS position were merged under a common
ID. As a conseguence of this and of the filters, from the 55420
transcrips originally present in the UCSC database, ~30000 were
merged, leaving 67440 uniquely mapped promoters in the input list.

<h3>2. UCSC TSS collection</h3>

The UCSC TSS collection is stored as a tab-deliminated text file
conforming to the SGA format under the name:

<ul>
<i>ucsc_promoter_list.sga</i>
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

<h3>3. Data import from DBTSS7</h3>

     Solexa Tag Data were downloaded from DBTSS ftp-site (see link above).
     The source files are the following:

<ul>
<li>3t3_data.tab.gz: Mouse 3T3 Solexa tag mapping data;</li>
</ul>

According to the readme file included in the ftp archive, the 5' end
tags were mapped to the mouse genome mm9. The source format is a
non-standard tab-delimited format that has been converted to SGA via
an ad hoc perl script. All tissues have been merged into a single
file.

<h3>3. Data import from FANTOM5</h3>

BAM files for high quality CAGE samples (hCAGE) were downloaded from FANTOM5 ftp-site (see link above).
FIles were then converted into SGA format using in-house software. There are a total number of 339 samples in this collection. Individual SGA files can be downloaded from our ftp website (link above).


<H3>5. mRNA 5' tags peak calling</H3>

For each individual sample (340), peak calling for the merged file has been
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

    The 340 promoter collections were merged into a unique file and
    further analysed. The promoter of a transcript was mantained in
    the list only if validated by at least two samples. Transcript
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

    The 21201 experimentally validated promoter were stored in the
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

