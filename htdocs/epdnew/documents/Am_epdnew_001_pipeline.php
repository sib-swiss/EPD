<?php
include("../../header.php");

$assembly = "amel5";
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


<H1>TSS assembly pipeline for Am_EPDnew_001</H1>
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
      RefSeq Genes
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
      17735
    </td>
    <td class='document'>
      10727
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/22121212'>22121212</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/assembly/GCF_000002195.4'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/amel5/refseq/refseq.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/amel5/refseq/amel5TssFromRefSeq.sga.gz'>
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
      Khamis et al., 2015
    </td>
    <td class='document'>
      CAGEscan
    </td>
    <td class='document'>
      16
    </td>
    <td class='document'>
      70,802,351
    </td>
    <td class='document'>
      <a href='https://www.ncbi.nlm.nih.gov/pubmed/26073445'>
	26073445
      </a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE64315'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/amel5/khamis15/khamis15.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/amel5/khamis15/'>
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
<img width="700" src="/miniepd/epdnew/epdnewGeneralPipeline.jpg">
</td></tr></table></center>
<p>
<h2>Description of procedures and intermediate data files</h2>

<h3>1. Download annotated TSS</h3>

Data was downloaded from <a
href="https://www.ncbi.nlm.nih.gov/assembly/GCF_000002195.4">
RefSeq</a> the 20-07-2016</ol>.

Transcripts have been filtered according to the following rules:

<ol>
<li>Transcripts of protein coding genes only</li>
<li>Transcripts have a non-empty description field</li>
</ol>

Gene names were taken from the field "Locus ID". Since the
EPD format does not allow gene names longer than 18 characters,
we checked whether the names respected this limitation.<br>

A total number of 17735 promoters were selected.

<h3>2. RefSeq TSS collection</h3>

The RefSeq TSS collection is stored as a tab-deliminated text file
conforming to the SGA format under the name:

<ul>
<i>amel5TssFromRefSeq.sga</i>
</ul>

The six fields contain the following information:

<ul>
<li>NCBI/RefSeq chromosome id</li>
<li>"TSS"</li>
<li>position</li>
<li>strand ("+" or "-")</li>
<li>"1"</li>
<li>Locus ID</li>
</ul>
Note that the second and forth fields are invariant.

<h3>3. Import CAGE data</h3>

Data was imported from GEO as SRA file format. Raw sequence files were
mapped to amel_4.5 genome using Bowtie. The resulting BAM files were
converted to SGA file format using <a href="<?php echo $url_ccg; ?>/chipseq/chip_convert.php">ChIP-Convert</a>.<br>

<H3>5. mRNA 5' tags peak calling</H3>

For each individual sample (16), peak calling for the merged file has been
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

Each sample in the collection (mRNA peaks and RefSeq TSS) was then
separately processed in a pipeline aiming at validating transcription
start sites with mRNA peaks. A RefSeq TSS was experimentally confirmed
if an mRNA peak lied in a window of 300 bp around it. The validated
TSS was then shifted to the nearest base with the higher tag
density.

    <h3>7. RefSeq not-validated TSS</h3>

    The total number (summing up all samples) of non experimentally validated TSS was around 10000.

    <h3>8. Promoter collection for each sample</h3>

    Each sample in the dataset was used to generate a separate
    promoter collection. Potentially, the same transcript could be
    validated by multiple samples and it could have different start
    sites in different samples. To avoid redundancy, the individual
    collections were used as input for an additional step in the
    analysis (Assembly pipeline part B).

    <h3>9. Merging collections and second TSS selection</h3>

    The 16 promoter collections were merged into a unique file and
    further analysed. Transcripts validated by multiple samples could
    potentially have the TSS set on a broader region and not to
    single position. To avoid such inconsistency, for each transcript
    we selected the position that was validated by the larger number
    of samples as the true TSS.<br />
    Different TSSs that belong to the same gene were classified according
    to their global expression level. The primary TSS of a gene (marked with an '_1' at the end of the ID) always has the highest expression level, followed by all the others
    in decreasing order of expression (marked with '_2', '_3', etc.).

    <h3>10. Filtering</h3>

    TSSs that mapped closed to other TSSs belonging to the same gene
    (500-bp window) were merged into a unique promoter following the same rule:
    the promoter that was validated by the highest number of samples was kept.

    <h3>10. Final EPDnew collection</h3>

    The 6493
<?php include("../../othertools.html"); ?>
    </div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>
