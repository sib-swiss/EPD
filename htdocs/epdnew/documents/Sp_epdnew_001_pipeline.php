<?php
include("../../header.php");

$assembly = "spo2";
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


<H1>TSS assembly pipeline for Sp_EPDnew_001</H1>
<P>
<h2>Introduction</h2>

<p>
  This document provides a technical description of the transcription
  start site assembly pipeline that was used to generate EPDnew
  version 001 for <i><?php echo $organism ?></i>.
</p>

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
      5128
    </td>
    <td class='document'>
      5128
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/22121212'>22121212</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/genome/?term=Schizosaccharomyces+pombe'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/spo2/refseq/refseq.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/spo2/refseq/spo2TssFromRefSeq.sga.gz'>
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
     Li et al., 2015
    </td>
    <td class='document'>
      DeepCAGE
    </td>
    <td class='document'>
      1
    </td>
    <td class='document'>
      17,279,045
    </td>
    <td class='document'>
      <a href='https://www.ncbi.nlm.nih.gov/pubmed/25747261'>
	25747261
      </a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://ftp.sra.ebi.ac.uk/vol1/fastq/ERR706/ERR706688/ERR706688.fastq.gz'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/spo2/li15/li15.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/spo2/li15/'>
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
href="https://www.ncbi.nlm.nih.gov/genome/?term=Schizosaccharomyces+pombe">
NCBI RefSeq</a> database the 02-02-2015</ol>.

    Transcrips have been filtered for protein coding gene only, removing pseudogenes from the list.<br>

Gene names were taken from the field "Locus ID". Since the
EPD format doesn't allow gene names longer than 18 characters,
we checked whether the names repsected this limitation.<br>

A total number of 5128 promoters were selected.

<h3>2. SGD TSS collection</h3>

The RefSeq TSS collection is stored as a tab-deliminated text file
conforming to the SGA format under the name:

<ul>
<i>spo2TssFromRefSeq.sga</i>
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

Data was imported from ArrayExpress as FASTQ file format. Raw sequence
files were mapped to spo2 genome using Bowtie (trimming 1bp from the
5-end). The resulting BAM files were converted to SGA file format
using <a href="<?php echo $url_ccg; ?>/chipseq/chip_convert.php">ChIP-Convert</a>.<br>
A step-by-step guide on how to import, map and convert these samples
can be found <a href="/miniepd/S_pombe/li15.txt">here</a>

<H3>5. mRNA 5' tags peak calling</H3>

For each individual sample (3), peak calling for the merged file has been
carried out using <a href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
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

    The total number (summing up all samples) of non experimentally validated TSS was around 2000.

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

