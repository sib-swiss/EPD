<?php
include("../../header.php");

$assembly = "hg38";
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
  <!--p align="right"><font size=-1><a href='Hs_epdnew_002_pipeline.pdf'>Printer version</a></font></p -->


  <h1>TSS assembly pipeline for HsNC_EPDnew_001</h1>

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
      HGNC
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
    8685
    </td>
    <td class='document'>
    3496
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/30304474'>30304474</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://biomart.genenames.org/martform/#!/default/HGNC?datasets=hgnc_gene_mart'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/hg38/hgnc/hgnc.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/hg38/hgnc/HGNC_TSS.sga.gz'>
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
      941
    </td>
    <td class='document'>
      18,244,201,540
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
      href='<?php echo $url_ccg; ?>/mga/hg19/fantom5/fantom5.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/hg19/fantom5/'>
      DATA</a>
    </td>
  </tr>

  <tr>
    <td class='document'>
      ENCODE
    </td>
    <td class='document'>
      CAGE
    </td>
    <td class='document'>
      145
    </td>
    <td class='document'>
      7,134,200,060
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/22955620'>
	22955620
      </a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='http://hgdownload.cse.ucsc.edu/goldenPath/hg19/encodeDCC/wgEncodeRikenCage/'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a qtarget='_blank'
      href='<?php echo $url_ccg; ?>/mga/hg19/encode/GSE34448/GSE34448.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/hg19/encode/GSE34448/'>
      DATA</a>
    </td>

  <tr>
    <td class='document'>
      ENCODE
    </td>
    <td class='document'>
      RAMPAGE
    </td>
    <td class='document'>
      225
    </td>
    <td class='document'>
      13,540,041,874
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/22936248'>
	22936248
      </a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.encodeproject.org/search/?type=Experiment&files.analysis_step_version.analysis_step.pipelines.title=RAMPAGE+or+CAGE+%28paired-end%29&assay_title=RAMPAGE'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/hg38/encode/rampage/rampage.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/hg38/encode/rampage/'>
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
	    <img src="/miniepd/epdnew/documents/HsNC_epdnew_001_pipeline.png"  width="420">
	    </td>
	  </tr>
	</table>
    </center>
  </p>
  <h2>Description of procedures and intermediate data files</h2>

  <h3>1. Download of annotated promoters</h3>

  <p>
    A list of non-coding RNA genes was downloaded from <a
    href="https://biomart.genenames.org/martform/#!/default/HGNC?datasets=hgnc_gene_mart" target="_blank">HGNC BioMart</a>. Genes were kept if the locus type was
    either antisense or long intergenic non-coding RNA. As we could not retrieve
    the coordinates directly from HGNC, we used Ensembl BioMart and the
    Ensembl Gene ID to get them wherever possible, and RefSeq otherwise.
    Genes which we could not get coordinates for were discarded. All
    transcripts associated with any given gene were considered, but those
    with the same TSS position were merged under a common transcript ID.
    The resulting list contained 8685 TSSs covering 3496 genes.
  </p>

    <h3>2. HGNC TSS collection</h3>

    <p>
      The HGNC TSS collection is stored as a tab-delimited text file
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
      TSS mapping data (CAGE and RAMPAGE) was downloaded from UCSC ftp site
      and FANTOM5 http site (see links above). The source files are in BAM
      format mapped on the hg19 genome assembly. Samples were lifted-over to
      the hg38 genome assembly using the liftOver tool. The complete list of
      files can be found <a
      href="<?php echo $url_ccg; ?>/mga/hg38/encode/GSE34448/GSE34448.html">
      here</a> for ENCODE (or <a
      href="<?php echo $url_ccg; ?>/mga/hg38/encode/rampage/rampage.html">
      here</a> for RAMPAGE) and <a
      href="<?php echo $url_ccg; ?>/mga/hg38/fantom5/fantom5.html">
      here</a> for FANTOM5. BAM files were converted into BED files
      with the bamToBed program. Files were kept and analyzed individually.
    </p>

    <h3>4. MGA archive</h3>

    <p>
      The compressed versions of these files are available from the
      MGA archive (see links above).
    </p>

    <h3>5. Peak calling</h3>

    Peak calling for each individual CAGE and RAMPAGE data file was
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

    <h3>6. HGNC TSS validation by TSS mapping data</h3>

    <p>
      Each sample was processed in a pipeline aiming at validating
      TSSs with CAGE/RAMPAGE peaks. An HGNC TSS was experimentally confirmed
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

    The 2339
<?php include("../../othertools.html"); ?>

    </div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>

