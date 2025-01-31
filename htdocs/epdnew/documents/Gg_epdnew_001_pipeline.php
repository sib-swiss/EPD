<?php
include("../../header.php");

$assembly = "galGal5";
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
  <!--p align="right"><font size=-1><a href='Hs_epdnew_002_pipeline.pdf'>Printer version</a></font></p -->


<H1>TSS assembly pipeline for Gg_EPDnew_001</H1>
<P>
<h2>Introduction</h2>

This document provides a technical description
of the transcription start site assembly pipeline that was used to
generate EPDnew version 001 for <i><?php echo $organism ?></i>.
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
      ENSEMBL91 genes
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
      16837
    </td>
    <td class='document'>
      16837
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/29155950'>29155950</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ensembl.org/biomart/martview/'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/galGal5/ensembl91/ensembl91.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/galGal5/ensembl91/galGal5_ENSEMBL91_TSS_all.sga.gz'>
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
      lizio17
    </td>
    <td class='document'>
      CAGE
    </td>
    <td class='document'>
      32
    </td>
    <td class='document'>
      507,012,687
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/28873399'>
      28873399</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://fantom.gsc.riken.jp/5/datafiles/latest/basic/'>
      SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/galGal5/lizio17/lizio17.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/galGal5/lizio17/'>
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
<img style='max-width:700px' src="/miniepd/epdnew/epdnewGeneralPipeline.jpg">
</td></tr></table></center>
<p>
<h2>Description of procedures and intermediate data files</h2>

<h3>1. UCSC Download</h3>

Data was downloaded from <a
href="https://genome.ucsc.edu/cgi-bin/hgTables?command=start">
UCSC table browser</a> in June 2018</ol>

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

If present, the UCSC TSS collection is stored as a tab-deliminated text file
conforming to the SGA format under the name (for chicken):

<ul>
<i>Gg_ucscTSS_galGal5.sga</i>
</ul>

The six field contain the following kinds of information:

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
FANTOM5 ftp site (see link above). Files were then converted into SGA
format using in-house software. There are a total number of 32 samples
in this collection. Individual SGA files can be downloaded
from our ftp website (link above).


<H3>5. mRNA 5' tags peak calling</H3>

For each individual sample (32), peak calling for the merged file has been
carried out using <a
href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
on-line tool with the following parameters:

<ul>
<li>Window width = 1</li>
<li>Vicinity range = 200</li>
<li>Peak refine = Y</li>
<li>Count cutoff = 9999999</li>
<li>Threshold = 5</li>
</ul>


<h3>6. TSS validation and shifting</h3>

Each sample in the collection (mRNA peaks and UCSC TSS) was then
separately processed in a pipeline aiming at validating transcription
start sites with mRNA peaks. A UCSC TSS was experimentally confirmed
if an mRNA peak lied in a window of 200 bp around it or it mapped in
the 5-UTR region. The validated TSS was then shifted to the nearest
base with the higher tag density.

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

    The 6127
<?php include("../../othertools.html"); ?>

    </div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>

