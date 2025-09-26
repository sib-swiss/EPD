<?php
#include("../../header.php");
include("../../header.php");

$assembly = "pfa2";
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

<h1>TSS assembly pipeline for Pf_EPDnew_001</h1>

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
      EnsemblProtists40 genes
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
        5286
    </td>
    <td class='document'>
        4994
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/29092050'>29092050</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://protists.ensembl.org/biomart/martview/fd9600dc05f81ecf9a2f9ce39d620b5e'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/pfa2/ensembl40/ensembl40.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/pfa2/ensembl40/Pf_ensembl40_tss_pfa2.sga.gz'>
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
		adjalley16
    </td>
    <td class='document'>
		CAGE
    </td>
    <td class='document'>
		<!-- SAMPLE NUMBER -->
		12
    </td>
    <td class='document'>
        <!-- TOTAL TAGS -->
        40,054,976
	<!-- <?php $command='awk -F \'\t\' \'{sum += $5} END {print sum}\' /local<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/GSE68982_allSamples.sga'; echo number_format(intval(exec("$command")));?> -->
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/26947071'>
      26947071</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://ftp.ncbi.nlm.nih.gov/geo/samples/GSM1689nnn/GSM1689659/'>
      SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/pfa2/adjalley16/adjalley16.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/'>
      DATA</a>
    </td>
  </tr>
</table>
</p>

<h2>Assembly pipeline overview</h2>

<div style="width:100%; text-align:center;">
<table border="1" cellpadding="10" style="display:inline-block;">
<tr><td>
<img style="max-width:700px;" src="/miniepd/epdnew/documents/Pf_epdnew_001_pipeline.png">
</td></tr>
</table>
</div>

<h2>Description of procedures and intermediate data files</h2>

<h3>1. ENSEMBL Download</h3>

Data was downloaded from <a href="https://jul2018-protists.ensembl.org/biomart/martview/">
EnsemblProtists release 40</a> in October 2018. Only transcrips from protein
coding genes have been selected.

<p>
5362 of 5693 genes originally present in the ENSEMBL database were
retained after this filtering. Transcripts with the same TSS position
were then merged under a common ID, yielding 5286 uniquely mapped
promoters in the TSS collection.
</p>

<h3>2. ENSEMBL TSS collection</h3>

The ENSEMBL TSS collection is stored as a tab-delimited text file
conforming to the SGA format under the name:

<ul>
<i>Pf_ensembl40_tss_pfa2.sga</i>
</ul>

The six fields contain the following information:

<ul>
<li>NCBI/RefSeq chromosome id</li>
<li>"TSS"</li>
<li>position</li>
<li>strand ("+" or "-")</li>
<li>"1"</li>
<li>ENSEMBLGeneID..geneName</li>
</ul>
Note that the second and fourth fields are invariant.

<h3>3. Data import from FTP at GEO</h3>

BEDGRAPH files for the 12 CAGE samples were downloaded from NCBI GEO ftp site
(see link above). Files were then converted into SGA format using in-house software.
Individual SGA files can be downloaded from our ftp website (see link above).

<h3>4. CAGE tag peak calling</h3>

A first selection of strong promoters was done based on a merged file containing
tags from all time points and replicates, using the <a href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>,
and <a href="<?php echo $url_ccg; ?>/chipseq/chip_cor.php">ChIP-Cor</a> online tools.

ChIP-Peak was used with the following parameters:
<ul>
<li>window width = 1</li>
<li>vicinity range = 150</li>
<li>refine peak positions = Y</li>
<li>count cutoff = 9999999</li>
<li>threshold = 10</li>
</ul>

The peaks were used as reference features in ChIP-Cor, and all CAGE tags from
a merged file as target features. The 10000 promoters most expressed were then
selected based on the total tags in a 150-bp centered window.

<h3>5. TSS validation and shifting</h3>

Each of the TSSs in the ENSEMBL collection was then validated and shifted
if at least one peak from the previous step was found between 1000 bp upstream
and the TSS position. This yielded a preliminary collection of 4015 promoters.

<h3>6. CAGE tag peak calling (second round)</h3>

A second selection was done using ChIP-Peak on merged files of the duplicates from each
time point, with the same parameters as above but a lower threshold. After merging,
peaks too close from one another were removed using ChIP-Peak with the same parameters
as above but a threshold of 0. TSSs with &lt; 50 tags in a 150-bp centered window were
excluded.

<h3>7. TSS validation and shifting (second round)</h3>

Unmatched ENSEMBL TSSs from step 5 were validated and shifted as above using
the peaks obtained in step 6, yielding 1580 promoters, which were added
to the preliminary collection.

<h3>8. Addition of differentially expressed promoters</h3>

Low-coverage TSSs from step 6 (&lt; 50 tags) that had at least 30 tags within
75 bp around the TSS and that showed differential expression across time points
(defined as more than 50&#37; of tags at a single time point) were validated against
ENSEMBL TSSs as above, yielding 134 additional promoters.

<h3>9. Filtering by relative expression</h3>

For genes with several potential promoters, we filtered out those
representing &lt; 5&#37; of the tags from all promoters associated with the
corresponding gene.

<h3>10. Final EPDnew collection</h3>

The 5597
<?php include("../../othertools.html"); ?>

</div>

<?php include("../../footer.html"); ?>

</body>
</html>
