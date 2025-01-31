<?php
include("../../header.php");

$assembly = "mm10";
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

<div style='font-size: 14px; text-align: justify; width:95%; min-width:700px;'>

  <h1>TSS assembly pipeline for MmNC_EPDnew_001</h1>

  <h2>Introduction</h2>

  This document provides a technical description of the transcription
  start site assembly pipeline that was used to generate EPDnewNC
  version 001 for <i><?php echo $organism ?></i>.
  <p></p>

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
      Ensembl97
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
    14704
    </td>
    <td class='document'>
<!-- awk '{split($6, a, /\.\./); print a[2]}' ensembl97_TSS.sga | sort -u | wc -l -->
    10184
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/29155950'>29155950</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='http://www.ensembl.org/biomart/martview/09728f6175b8296ea3f09ea7a75366be'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/mm10/ensembl/ensembl.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/mm10/ensembl/ensembl97_TSS.sga.gz'>
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
      965
    </td>
    <td class='document'>
      <!-- for FILE in $(ls *.sga | grep -v "allTissues"); do count=$(awk '{sum += $5} END {print sum}' $FILE); total=$((total+count)); done; echo "Total tag count is $total" | mailx ..@.. -->
      15,152,265,718
    </td>
    <td class='document'>
      <a href='https://www.ncbi.nlm.nih.gov/pubmed/24670764'>
      24670764</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://fantom.gsc.riken.jp/5/datafiles/reprocessed/mm10_latest/basic/'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/mm10/fantom5/fantom5.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/mm10/fantom5/'>
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
            <!-- pipeline is the same as for human non-coding -->
	    <img src="/miniepd/epdnew/documents/HsNC_epdnew_001_pipeline.png"  width="420">
	    </td>
	  </tr>
	</table>
    </center>
  </p>
  <h2>Description of procedures and intermediate data files</h2>

  <h3>1. Download of annotated promoters</h3>

  <p>
    Data was downloaded from <a
    href="http://www.ensembl.org/biomart/martview/09728f6175b8296ea3f09ea7a75366be" target="_blank">BioMart</a>. Genes were kept if the gene type was long
    intergenic non-coding RNA. All transcripts associated with any given
    gene were considered, but those with the same TSS position
    were merged under a common transcript ID. The resulting list
    contained 8685 TSSs covering 3496 genes.
  </p>

    <h3>2. Ensembl TSS collection</h3>

    <p>
      The Ensembl TSS collection is stored as a tab-delimited text file
      conforming to the SGA format. The six fields in the file contain the
      following information:
      <ol type="1">
	<li>NCBI/RefSeq chromosome id</li>
	<li>"TSS"</li>
	<li>position</li>
	<li>strand ("+" or "-")</li>
	<li>"1"</li>
	<li>Gene name.</li>
      </ol>
      Note that the second and fourth fields are invariant.
    </p>

    <h3>3. Download of TSS mapping data</h3>
    <p>
      TSS mapping data was downloaded from the FANTOM5 http site
      (see link above). The source files are in BAM format mapped on the
      mm10 genome assembly. The complete list of
      files can be found <a
      href="<?php echo $url_ccg; ?>/mga/mm10/fantom5/fantom5.html">
      here</a>. BAM files were converted into BED files
      with the bamToBed program. Files were kept and analyzed individually.
    </p>

    <h3>4. MGA archive</h3>

    <p>
      The compressed versions of these files are available from the
      MGA archive (see links above).
    </p>

    <h3>5. Peak calling</h3>

    Peak calling for each individual CAGE file was
    carried out using our <a
    href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
    online tool with the following parameters:

    <ul>
      <li>window width = 1</li>
      <li>vicinity range = 200</li>
      <li>peak refine = N</li>
      <li>count cutoff = 9999999</li>
      <li>threshold = 5</li>
    </ul>
    </p>

    <h3>6. Ensembl TSS validation by TSS mapping data</h3>

    <p>
      Each sample was processed in a pipeline aiming at validating
      TSSs with CAGE peaks. An Ensembl TSS was experimentally confirmed
      if a peak lied in a window of 50 bp around it. The validated TSS was then
      shifted to the nearest base with the higher tag density.
    </p>

    <h3>7. Sample-specific promoter collection</h3>

    <p>
      Each sample in the dataset was used to generate a separate
      promoter collection. The same promoter could be validated
      in multiple samples and could have different start sites in
      different samples. To avoid redundancy, the individual
      collections were used as input for an additional step in the
      analysis (see part B in the figure above).
    </p>

    <h3>8. Merging collections</h3>

    <p>
      All sample-specific promoter collections were merged into a unique
      file and further analyzed. A promoter was retained in the list only
      if validated by at least 3 samples.
      Promoters validated by multiple samples may have their start site
      set on a broader region rather than a single position. For
      each transcript, we thus selected the position validated by the
      largest number of samples as the "true" TSS.
    </p>

    <h3>9. Further TSS selection</h3>

    <p>
      We used our <a
      href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a> online
      tool as above but with a vicinity of 150 and a threshold of 1, in order
      to retain the single most expressed promoter in each promoter "cluster".
    </p>

    <h3>10. Filtering</h3>

    <p>
      We finally applied an additional filtering on relative expression,
      keeping only promoters whose expression represents at least 10&#37;
      of the associated gene's total expression. We also decided to limit
      the number of promoters per gene to 5.
    </p>

    <h3>11. Final EPDnewNC collection</h3>

    The 3077
<?php include("../../othertools.html"); ?>

    </div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>

