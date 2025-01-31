<?php
include("../../header.php");

$assembly = "rheMac8";
$datfile = fopen("../../mga/$assembly/$assembly.dat", "r");
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

<h1>TSS assembly pipeline for Rm_EPDnew_001</h1>

<h2>Introduction</h2>

This document provides a technical description
of the transcription start site assembly pipeline that was used to
generate the EPDnew version 001 for <i><?php echo $organism ?></i>.

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
      ENSEMBL92 genes
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
        36903
    </td>
    <td class='document'>
       20593
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/29092050'>29092050</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ensembl.org/biomart/martview/'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/rheMac8/ensembl/ensembl.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/rheMac8/ensembl/Rm_ensembl92_tss_rheMac8.sga.gz'>
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
		francescatto17
    </td>
    <td class='document'>
		CAGE
    </td>
    <td class='document'>
		<!-- SAMPLE NUMBER -->
		15
    </td>
    <td class='document'>
		<!-- TOTAL TAGS -->
		217,883,048
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/29087374'>
      29087374</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://fantom.gsc.riken.jp/5/datafiles/latest/basic/macaque.tissue.hCAGE/'>
      SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/rheMac8/francescatto17/francescatto17.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/rheMac8/francescatto17/'>
      DATA</a>
    </td>
  </tr>
</table>
</p>

<h2>Assembly pipeline overview</h2>

<div style="width:100%; text-align:center;">
<table border="1" cellpadding="10" style="display:inline-block;">
<tr><td>
<img style="max-width:700px;" src="/miniepd/epdnew/epdnewGeneralPipeline.jpg">
</td></tr>
</table>
</div>

<h2>Description of procedures and intermediate data files</h2>

<h3>1. Ensembl Download</h3>

Data was downloaded from <a
href="http://apr2018.archive.ensembl.org/biomart/martview/">
ENSEMBL</a> in July 2018.
Transcripts have been filtered according to the following rules:

<ol>
<li>Transcripts of protein coding genes only</li>
<li>Transcripts on full chromosomes</li>
<li>Genes must be annotated [Gene Name present]</li>
<li>Genes' and transcripts' status known</li>
</ol>

Gene names were taken from the field "Gene Name". Since the
EPD format does not allow gene names longer than 18 characters, we
checked whether the names respected this limitation. Transcripts
with the same TSS position were merged under a common ID, leaving 36903
uniquely mapped promoters in the input list, from a total of 44758
transcripts originally present in the Ensembl database.

<h3>2. Ensembl TSS collection</h3>

The Ensembl TSS collection is stored as a tab-deliminated text file
conforming to the SGA format under the name:

<ul>
<i>Rm_ensembl92_tss_rheMac8.sga</i>
</ul>

The six fields contain the following information:

<ul>
<li>NCBI/RefSeq chromosome id</li>
<li>"TSS"</li>
<li>position</li>
<li>strand ("+" or "-")</li>
<li>"1"</li>
<li>ENSEMBLGeneID .. geneName</li>
</ul>
Note that the second and forth fields are invariant.

<h3>3. Data import from FANTOM5</h3>

BAM files for high quality CAGE samples (hCAGE) were downloaded from
FANTOM5 ftp site (link above).  Files were then converted into SGA
format using in-house software. There are a total number of 15
samples in this collection. Individual SGA files can be downloaded
from our ftp website (link above).


<H3>5. mRNA 5' tags peak calling</H3>

For each individual sample, peak calling for the merged file has been
carried out using <a href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
on-line tool with the following parameters:

<ul>
<li>window width = 1</li>
<li>vicinity range = 200</li>
<li>peak refine = Y</li>
<li>count cutoff = 9999999</li>
<li>threshold = 5</li>
</ul>


<h3>6. TSS validation and shifting</h3>

Each sample in the collection (mRNA peaks and Ensembl TSS) was then
separately processed in a pipeline aiming at validating transcription
start sites with mRNA peaks. An Ensembl TSS was experimentally confirmed
if an mRNA peak lied in a window of 200 bp around it or if it mapped in
the 5' UTR region. The validated TSS was then shifted to the nearest
base with the highest tag density.

<h3>8. Promoter collection for each sample</h3>

    Each sample in the dataset was used to generate a separate
    promoter collection. Potentially, the same transcript could be
    validated by multiple samples and it could have different start
    sites in different samples. To avoid redundancy, the individual
    collections were used as input for an additional step in the
    analysis (assembly pipeline part B).

    <h3>9. Merging collections and second TSS selection</h3>

    The 15 promoter collections were merged into a unique file and
    further analyzed. The promoter of a transcript was kept in
    the list only if validated by at least two samples. Transcripts
    validated by multiple samples could potentially have the TSS set
    on a broader region rather than a single position. To avoid such
    inconsistency, we selected for each transcript the position that
    was validated by the largest number of samples as the true TSS.

    <h3>10. Filtering</h3>

    TSSs that mapped close to other TSSs that belonged to the same gene
    (500 bp window) were merged into a unique promoter following the same rule:
    the promoter that was validated by the highest number of samples was kept.

    <h3>10. Final EPDnew collection</h3>

    The 9575
<?php include("../../othertools.html"); ?>
    </div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>

