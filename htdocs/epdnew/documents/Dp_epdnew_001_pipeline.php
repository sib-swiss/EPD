<?php
#include("../../header.php");
include("../../header.php"); # relative to what is this? - TJ

$assembly = "dpu2";
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

<h1>TSS assembly pipeline for Dp_EPDnew_001</h1>

<h2>Introduction</h2>

This document provides a technical description
of the transcription start site assembly pipeline that was used to
generate the EPDnew version 001 for <i><?php echo $organism ?></i>.

<h2>Source Data</h2>

<strong>UPDATE!</strong>

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
      ye17 genes
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
	<!-- could be computed like in 'D_pulex_database.php^ - TJ -->
        8548
    </td>
    <td class='document'>
	<!-- ditto -->
        8374
    </td>
	<!-- I'll need details from PB here -->
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/23193273'>23193273</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href=''>N/A</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ccg; ?>/mga/dpu2/ye17/ye17.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ccg; ?>/mga/dpu2/ye17/Daphnia_trx_start_sites.sga'>
      DATA
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
		raborn16
    </td>
    <td class='document'>
		CAGE
    </td>
    <td class='document'>
		<!-- SAMPLE NUMBER -->
		6
    </td>
    <td class='document'>
		<!-- TOTAL TAGS -->
	<?php $command='awk -F \'\t\' \'{sum += $5} END {print sum}\' /local<?php echo $url_ftp; ?>/mga/dpu2/raborn16/*_merged.sga'; echo number_format(intval(exec("$command")));?>
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/27585846'>
      27585846</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='http://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE80141'>
      SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ccg; ?>/mga/dpu2/raborn16/raborn16.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/dpu2/raborn16/'>
      DATA</a>
    </td>
</table>
</p>

<h2>Assembly pipeline overview</h2>

<div style="width:100%; text-align:center;">
<table border="1" cellpadding="10" style="display:inline-block;">
<tr><td>
<!-- <img style="max-width:700px;" src="/miniepd/epdnew/documents/Pf_epdnew_001_pipeline.png"> -->
<img width="500" height="600" src="./Dp_epdnew_001_pipeline.png">
</td></tr>
</table>
</div>
	      <!-- style="max-width:700px;"  -->

<h2>Description of procedures and intermediate data files</h2>

<h3>1. TSS Download</h3>

<b>This is not in the code - check!</b>
The source of the input data is not mentioned in the code (not very
surprisingly) - thus, I'm not sure where TSS data for <i>D. pulex</i> data was
downloaded from.</br>

<p>
Data was downloaded from <a href="">
(INSERT URL)</a> in (INSERT MONTH). Only transcripts from protein-coding genes
have been selected.  8374 genes were retained after this filtering. Transcripts
with the same TSS position were then merged under a common ID, yielding 8548
uniquely mapped promoters in the TSS collection.
</p>

<p>The TSS collection is stored as a tab-delimited text file
conforming to the SGA format under the name:

<ul>
<!-- <i>Pf_ensembl40_tss_pfa2.sga</i> -->
<tt>Daphnia_trx_start_sites.sga</tt>
</ul>

The six fields contain the following information:

<ul>
<li>NCBI scaffold id</li>
<li>"TSS"</li>
<li>position</li>
<li>strand ("+" or "-")</li>
<li>"1"</li>
<li>Transcript number</li>
</ul>
Note that the second and fourth fields are invariant.  </p>

<h3>2. CAGE Data Download</h3>

(fill in where/how CAGE data was sourced)

<h3>3. CAGE tag peak calling</h3>

A first selection of strong promoters was done using <a href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>, using the following parameters:
<ul>
<li>window width = 1</li>
<li>vicinity range = 200 </li>
<li>refine peak positions = Y</li>
<li>count cutoff = 9999999</li>
<li>threshold = 5</li>
</ul>

<h3>4. TSS Validation</h3>

Transcription start sites were validated using an in-house script
(<tt>validate_ensembl_dp.pl</tt>). The positive and negative strands were validated separately.

<h3>5. Compaction of SGA</h3>

The promoters on the plus and minus strands were compacted into a single SGA
file.

<h3>6. Optimising TSSs</h3>

Transcription start sites were optimised using the in-house script
(<tt>promoterOptimisation.pl</tt>).

<h3>7. Merging TSSs</h3>

Finally, transcription start sites that lie close together were merged using the
in-house script (<tt>merge_promoters.pl</tt>).

<h3>10. Final EPDnew collection</h3>

The 5597
<?php include("../../othertools.html"); ?>

</div>

<?php include("../../footer.html"); ?>

</body>
</html>
