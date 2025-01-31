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


  <H1>TSS assembly pipeline for Hs_EPDnew_006</H1>

  <h2>Introduction</h2>

  This document provides a technical description of the transcription
  start site assembly pipeline that was used to generate EPDnew
  version 006 for <i><?php echo $organism ?></i>.
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
      Gencode
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
      35320
    </td>
    <td class='document'>
      17056
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/27250503'>27250503</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://genome.ucsc.edu/cgi-bin/hgTables?command=start'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/hg38/gencode/gencode.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/hg38/gencode/gencode.v24.ucsc.hg38.sga.gz'>
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
      <a qtarget='_blank'
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
	    <img src="/miniepd/epdnew/documents/Hs_epdnew_006_pipeline.jpg"  width="700">
	    </td>
	  </tr>
	</table>
    </center>
  </p>
  <h2>Description of procedures and intermediate data files</h2>

  <h3>1. Download of annotated promoters</h3>

  <p>
    Data for the latest reference Human GENCODE release (v28) was
    downloaded from <a
    href="https://ftp.ebi.ac.uk/pub/databases/gencode/Gencode_human/release_28/gencode.v28.annotation.gff3.gz"
    target="_blank">EBI FTP website</a>. Transcrips were kept if they
    belong to a protein coding genes (flag 'gene_type' =
    'protein_coding') and the <a
    href="https://www.gencodegenes.org/pages/data_format.html"
    target="_blank">transcript support level</a> equal to 1 (all
    splice junctions of the transcript are supported by at least one
    non-suspect mRNA, this is the most stringent level).<br />

    Gene names were taken from the field "gene_name". Since
    the EPD format doesn't allow gene names longer than 18 characters,
    we checked whether the names repsected this limitation.<br />

    Transcripts with the same TSS position were merged under a common
    transcript ID. As a consequence, the total number of TSS in the
    list was 35320 covering 17056 protein coding genes.
  </p>

    <h3>2. Gencode TSS collection</h3>

    <p>
      The Gencode TSS collection is stored as a tab-deliminated text
      file conforming to the SGA format.  The six fields in the file
      contain the following kinds of information:

      <ol type="1">
	<li>NCBI/RefSeq chromosome id</li>
	<li>"ENSEMBL"</li>
	<li>position</li>
	<li>strand ("+" or "-")</li>
	<li>"1"</li>
	<li>TranscriptID..GeneName.</li>
      </ol>
      Note that the second and forth fields are invariant.
    </p>

    <h3>3 Import Single-end sequencing data: CAGE</h3>
    <p>
      CAGE Tag Data were downloaded from UCSC ftp-site and FANTOM5
      http-site (see links above).  The source files are in bam format
      mapped on hg19 genome assembly. Samples were lifted-over to hg38
      genome assembly using the liftOver tool. The complete list of
      files can be found <a
      href="<?php echo $url_ccg; ?>/mga/hg38/encode/GSE34448/GSE34448.html">
      here for ENCODE</a> and <a
      href="<?php echo $url_ccg; ?>/mga/hg38/fantom5/fantom5.html">
      here for FANTOM5</a>. Bam files were converted into bed files
      with bamToBed program. Files were kept and analysed
      individually.<br />
    </p>

    <h3>4. CAGE mapping data</h3>

    <p>
      The compressed versions of these files are available from the
      MGA archive (see links above).
    </p>

    <H3>5. CAGE peak calling</H3>

    Peak calling for each individual CAGE and RAMPAGE data file has
    been carried out using <a
    href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
    on-line tool with the following parameters:

    <ul>
      <li>Window width = 1</li>
      <li>Vicinity range = 200</li>
      <li>Peak refine = N</li>
      <li>Count cutoff = 9999999</li>
      <li>Threshold = 5</li>
    </ul>


    <h3>6. RAMPAGE data analysis</h3>

    <p>
      RAMPAGE is a TSS mapping technique that uses paired-end
      sequencing to uniquely assign a 5'-end tag (first read in the
      pair) to an annotated gene using the 3'-end tag (the second read
      in the pair). This gives high confidence when assigning TSS to
      genes when they map outside gene boudaries (potentially very far
      from them). The new nature of the data required a specific
      analysis and a modification in the general EPDnew validation
      pipeline. As for CAGE data, each RAMPAGE sample was analysed
      separately and merged together only at the end to generate a
      RAMPAGE-specific promoter collection. The new analysis is
      chararacterised for the following steps: (1) Data import and
      annotation; (2) Peak calling (3) Peak selection and (4) Quality
      control. Each step will be brefely described.
    </p>
    <p>
      <b>Data import and annotation</b><br />

      Data was downloaded from the ENCODE web-site as BAM files mapped
      on GRCh38/hg38 genome assembly and converted into SGA format
      using the following procedure:

      <ol type="1">
	<li>Keep reads that have a good mapping score (5th field in
	the bed file = 255)</li>
	<li>Split the reads in a pair in to two files and keep the
	read ID</li>
	<li>Annotate the second read file if they map inside a gene
	exon and have the same orientation</li>
	<li>Annotate the first read file using the read ID</li>
	<li>Discard reads if not annotated</li>
      </ol>
    </p>

    <p>
      <b>Peak calling</b><br />

      Peak calling was carried out as described for CAGE data. Since
      RAMPAGE tags were already annotated to a specific gene, RAMPAGE
      peaks retained the gene annotation given to the tags that
      composed them.
    </p>

    <p>
      <b>Peak selection</b><br />

      Annotated RAMPAGE peaks were selected if they map outside the
      gene boudaries they belong to.
    </p>

    <p>
      <b>Quality Control</b><br />

      Each sample-specific peak collection (225 TSS collections) was
      quality checked using the usual EPD QC parameters: density
      distribution of known Core Preomoter Elements (CPEs) around
      putative TSS. For this analysis we used two well known CPEs, the
      <a href='/miniepd/promoter_elements/tata_old.php'>TATA-box</a> and <a
      href='/miniepd/promoter_elements/init.php'>Initiator (Inr)</a> that are
      found at position -29 and 0 relative to the TSS and mesured
      their frequencies in each of the 225 RAMPAGE-derived TSS
      collections. Sample specific TATA-box and Initiator frequencies
      are summarised in the following figure:
      <p>
	<center>
	  <table border=1 cellpadding=10>
	    <tr><td>
	      <img src="/miniepd/epdnew/documents/rampageQC.png"  width="700" />
	    </td>
	    </tr>
	  </table>
	</center>
      </p>
      Overall RAMPAGE-derived TSS collections are of poor quality
      compared to CAGE-derived TSS collections (compare this figure
      with the QC controls done on CAGE data in the figure under
      'Quality controls of sample-specific promoter
      collections'). Both TATA-box and Initiator frequencies are on
      average half of expected values. For this reason, RAMPAGE data
      was not used to directly generate a new EPDnew TSS collection
      but only to identify novel start sites that need to be validated
      by CAGE. To do so, samples specific RAMPAGE TSS were merged
      togheter and <b>added to Gencode TSS
      collection</b>. Gencode+RAMPAGE TSS validation was then carried
      out using CAGE data.
    </p>

    <h3>7. Gencode+RAMPAGE TSS validation dy CAGE data</h3>

    <p>
      Each sample in the collection (CAGE peaks and Gencode+RAMPAGE
      TSS) was then processed in a pipeline aiming at validating
      transcription start sites with CAGE peaks. A Gencode+RAMPAGE TSS
      was experimentally confirmed if a CAGE peak lied in a window of
      200 bp around it or if mapped in the 5'UTR region of an
      annotated gene and if it had a maximum high of at least 5 tags
      (50 tags for peaks in the 5'UTR). The validated TSS was then
      shifted to the nearest base with the higher tag
      density. Secondary promoters for genes with multiple TSSs were
      discarded if their expression level was below 10% of the
      strongher gene-specific initiation site or below 10 tags.
    </p>

    <h3>8. Promoter collection for each sample</h3>

    <p>
      Each sample in the dataset was used to generate a separate
      promoter collection. Potentially, the same transcript could be
      validated by multiple samples and it could have different start
      sites in different samples. To avoid redundancy, the individual
      collections were used as input for an additional step in the
      analysis (Assembly pipeline part B).
    </p>

    <h3>9. Quality controls of sample-specific promoter
    collections</h3>

    <p>
      The quality of promoter collections derived from each sample was
      tested to exclude low quality samples from the final
      collection. To achive this, each promoter collection was scored
      according to the distribution of the <a
      href='/miniepd/promoter_elements/tata_old.php'>TATA-box</a> and <a
      href='/miniepd/promoter_elements/init.php'>Inr</a> motif in the expected
      position (-29bp from the TSS and at the TSS
      respectively). Samples with very low motif frequencies (Inr
      frequency < 10% and TATA-box < 5%) were discarded (3 samples in
      total) from further analyses. The figure below shows the
      distribution of TATA-box and Inr in all sample-specific promoter
      collections:
      <p>
	<center>
	  <table border=1 cellpadding=10>
	    <tr><td>
	      <img src="/miniepd/epdnew/documents/samplesQC.png"  width="700" />
	    </td>
	    </tr>
	  </table>
	</center>
      </p>
    </p>

    <h3>10. Merging collections and further TSS selection</h3>

    <p>
      The good-quality promoter collections were merged into a unique
      file and further analysed. The promoter of a transcript was
      mantained in the list only if validated by at least 3
      samples. We chosed this Cut-off value since it ensured a good
      increase in Inr and TATA-box friquency without affecting too
      much the total number of validated genes:
      <p>
	<center>
	  <table border=1 cellpadding=10>
	    <tr><td>
	      <img src="/miniepd/epdnew/documents/COselection.png" />
	    </td>
	    </tr>
	  </table>
	</center>
      </p>
      Transcript validated by multiple
      samples could potentially have the TSS set on a broader region
      and not to single position. To avoid such inconsistency, for
      each transcript we selected the position that was validated by
      the larger number of samples as the true TSS.
    </p>

    <h3>11. Filtering</h3>

    Transcription Start Sites that mapped closed to other TSS that
    belonged to the same gene (100 bp window) were merged into a
    unique promoter following the same rule: the promoter that was
    validated by the higher number of samples was kept.

    <h3>12. Final EPDnew collection</h3>

    The 29598
<?php include("../../othertools.html"); ?>

    </div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>

