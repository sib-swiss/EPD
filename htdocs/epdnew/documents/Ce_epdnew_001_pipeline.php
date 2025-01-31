<?php
include("../../header.php");

$assembly = "ce6";
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


<H1>TSS assembly pipeline for Ce_EPDnew_001</H1>
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
      UCSC Genes
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
      20531
    </td>
    <td class='document'>
      11786
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
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/ce6/ucsc/ucsc.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/ce6/ucsc/ucsc_promoter_list.sga.gz'>
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
      Kruesi et al., 2013
    </td>
    <td class='document'>
      GRO-cap
    </td>
    <td class='document'>
      9
    </td>
    <td class='document'>
      236,210,104
    </td>
    <td class='document'>
      <a href='https://www.ncbi.nlm.nih.gov/pubmed/23795297'>
	23795297
      </a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE43087'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/ce6/kruesi13/kruesi13.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/ce6/kruesi13/'>
      DATA</a>
    </td>
  </tr>
</table>
</p>

<!-- h2>Assembly pipeline overview</h2>
<p>
<center>
<table border=1 cellpadding=10>
<col width="300">
<tr><td>
<img width="700" src="/miniepd/epdnew/epdnewGeneralPipeline.jpg">
</td></tr></table></center>
<p>
<h2>Description of procedures and intermediate data files</h2 -->

<h3>1. Download annotated TSS</h3>

Data was downloaded from <a
href="https://genome.ucsc.edu/cgi-bin/hgTables?command=start">
UCSC table browser</a></ol>.

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

A total number of 20531 promoters were selected.

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
<li>gene name / ID</li>
</ul>
Note that the second and forth fields are invariant.

<h3>3. Import CAGE data</h3>

Data was imported from GEO as SRA file format. Raw sequence files were
mapped to ce6 genome using Bowtie. The resulting BAM files were
converted to SGA file format using <a
href="<?php echo $url_ccg; ?>/chipseq/chip_convert.php">ChIP-Convert</a>.<br>
A step-by-step guide on how to import, map and convert these samples
can be found <a href="kruesi13.txt">here</a>

<H3>4. Download annotated TSS file from eLIFE</H3>

The list of promoters published by Kruesi et al., was downloaded from
<a
href="https://doi.org/10.7554/eLife.00808.005">ELife</a>. XLS
file was converted to a tab delimited flat file using OpenOffice and
converted to a bed file using in-house scripts. (Note that one line in
the input data file contains up to 4 TSS coordinates)

<h3>5. LiftOver ce10 to ce6 and generate an SGA file</h3>

The Kruesi et al. promoter list was lifted over from ce10 to ce6 using
the <a href="https://genome.ucsc.edu/cgi-bin/hgLiftOver">liftOver</a>
tool from UCSC Genome Browser.<br> The resulting BED file was
converted to SGA using <a
href="<?php echo $url_ccg; ?>/chipseq/chip_convert.php">ChIP-Convert</a>.

<h3>6. Annote kruesi13 SGA file with GRO-cap counts</h3>

The published promoter collection was annotated using the GRO-cap raw
data. This step was done to get the total number of GRO-cap reads that
mapped at the annotated TSSs.

<h3>7. Select TSS with maximal GRO-cap</h3>

Promoters that belong to the same genes were merged if their distance
was shorter that 100 bp. The site with the higher tag count was then
selected as EPD promoter.

    </div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>

