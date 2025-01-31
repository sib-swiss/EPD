<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->

<?php include("../../header.php");

$assembly = "dm6";
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

<h1 class='document'>TSS assembly pipeline for Dm_EPDnew_005</h1>

<h2 class='document'>Introduction</h2>

<p class='document'>
  This document provides a technical description of the transcription
  start site assembly pipeline that was used to generate EPDnew
  version 005 for <i><?php echo $organism ?></i>.
</p>

<h2 class='document'>Source Data</h2>

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
      ENSEMBL86
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
      18409
    </td>
    <td class='document'>
      13660
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/19420058'>19420058</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='http://dec2013.archive.ensembl.org/index.html'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ccg; ?>/mga/dm6/ensembl/ensembl.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/dm6/ensembl/Dm_ENSEMBL86.sga.gz'>
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
      MachiBase
    </td>
    <td class='document'>
      OligoCap
    </td>
    <td class='document'>
      7
    </td>
    <td class='document'>
      24,984,353
    </td>
    <td class='document'>
      <a href='https://www.ncbi.nlm.nih.gov/pubmed/18842623'>
      18842623</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='http://machibase.gi.k.u-tokyo.ac.jp/'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/dm6/machibase/machibase.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/dm6/machibase/'>
      DATA</a>
    </td>
  </tr>

  <tr>
    <td class='document'>
      Hoskins et al., 2012
    </td>
    <td class='document'>
      CAGE
    </td>
    <td class='document'>
      1
    </td>
    <td class='document'>
      17,979,809
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/21177961'>
      21177961</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='http://genome.cshlp.org/content/21/2/182/suppl/DC1'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/dm6/hoskins11/hoskins11.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/dm6/hoskins11/embryo_cage.sga.gz'>
      DATA</a>
    </td>
  </tr>

  <tr>
    <td class='document'>
      modENCODE
    </td>
    <td class='document'>
      CAGE
    </td>
    <td class='document'>
      49
    </td>
    <td class='document'>
      596,317,845
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/24985915'>
      24985915</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/sra?term=SRP001602'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/dm6/encode/SRP001602/SRP001602.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/'>
      DATA</a>
    </td>
  </tr>

  <tr>
    <td class='document'>
      Ni et al., 2010
    </td>
    <td class='document'>
      CAGE
    </td>
    <td class='document'>
      2
    </td>
    <td class='document'>
      27,173,616
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/20495556'>
      20495556</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/sra?term=SRX018832'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/dm6/ni10/ni10.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/dm6/ni10/'>
      DATA</a>
    </td>
  </tr>

  <tr>
    <td class='document'>
      Schor et al., 2017
    </td>
    <td class='document'>
      CAGE
    </td>
    <td class='document'>
      316
    </td>
    <td class='document'>
      2,536,326,545
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/28191888'>
      28191888</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ebi.ac.uk/ena/data/view/PRJEB14165'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/dm6/schor17/schor17.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/dm6/schor17/'>
      DATA</a>
    </td>
  </tr>

</table>
</p>

<h2 class='document'>Assembly pipeline overview</h2>

<center>
  <table border=1 cellpadding=10>
    <tr>
      <td>
	<img src='/miniepd/epdnew/EPDnew_pipeline_overview.png' />
      </td>
    </tr>
  </table>
</center>

<h2 class='document'>Description of procedures and intermediate data files</h2>

<h3 class='document'>1. Biomart Download</h3>

<p class='document'>
  Data was downloaded from BioMart, selecting the following attributes:
</p>

<ol class='document'>
    <li>Ensembl Gene ID</li>
    <li>Ensembl Transcript ID</li>
    <li>Chromosome Name</li>
    <li>Strand</li>
    <li>Transcript Start (bp)</li>
    <li>Transcript End (bp)</li>
    <li>Gene Start (bp)</li>
    <li>Gene End (bp)</li>
    <li>Status (transcript) </li>
    <li>Status (gene) </li>
    <li>Associated Gene Name</li>
</ol>

<p class='document'>
  Then, transcripts have been filtered according to the following
  rules:
</p>

<ol class='document'>
    <li>Transcripts of protein coding genes only</li>
    <li>Transcript length &gt; 0 [Transcript Start different from Transcript
    End]</li>
    <li>Transcript lies on full chromosomes</li>
    <li>Gene must have a 5' UTR [Transcript Start different from Gene
    Start]</li>
    <li>Genes must be annotated [Associated Gene Name present]</li>
    <li>Genes' and transcripts' status known</li>
</ol>

<p class='document'>
  Gene names were taken from the field 'Associated Gene Name'. Since
  the EPD format does not allow gene names longer than 18 characters,
  we checked whether the names respected this limitation.
</p>
<p class='document'>
  Transcripts with the same TSS position were merged under a common
  ID. As a conseguence of this, from the 23850 transcripts originally
  present in the ENSEMBL database, 5953 were merged, leaving 17897
  uniquely mapped promoters in the input list.
</p>

<h3 class='document'>2. EMBL TSS collection</h3>

<p class='document'>
  The ENSEMBL TSS collection is stored as a tab-deliminated text file
  conforming to the SGA format under the name:
</p>

<ul class='document'>
  <li>Dm_ENSEMBL86.sga</li>
</ul>

<p class='document'>
  The six fields contain the following information:
</p>

<ul class='document'>
    <li>NCBI/RefSeq chromosome id</li>
    <li>"TSS"</li>
    <li>position</li>
    <li>strand ("+" or "-")</li>
    <li>"1"</li>
    <li>gene name.</li>
</ul>

<p class='document'>
  Note that the second and forth fields are invariant.
</p>

<h3 class='document'>3. Data import</h3>

<h4 class='document'>Machibase</h4>
<p class='document'>
  MachiBase data were generated with the oligo-capping technology. The
  source data were downloaded from:
</p>
<ul class='document'>
    <li><a href='http://download.utgenome.org/pub/machibase/tssExp.tar.gz'>
    http://download.utgenome.org/pub/machibase/tssExp.tar.gz</a></li>
</ul>
<p class='document'>
  According to the readme file included in the tar archive, the 5' end
  tags were mapped to the Drosophila genome using BLAT as alignment
  tool allowing for up to three mismatches.
</p>

<h4 class='document'>Genome Research</h4>
<p class='document'>
  Mapped sequence tags were extracted from Supplementary Data File 1
  available from Genome Research at:
</p>
<ul class='document'>
  <li><a href='http://genome.cshlp.org/content/21/2/182/suppl/DC1'>
  http://genome.cshlp.org/content/21/2/182/suppl/DC1</a></li>
</ul>
<p class='document'>
  The downloaded source file is in SAM format and has been generated
  with the tag mapping program StatMap as described in the article
  cyted above. We extracted all tags with mapping quality scores
  greater than or equal to 30.
</p>

<h4 class='document'>SRA</h4>

<p class='document'>
  BAM files for the SRA serie SRP001602 and SRX018832 were downloaded
  from SRA site and converted into SGA file using in-house software.
</p>

<h4 class='document'>ArrayExpress</h4>

<p class='document'>
  FASTQ files for the ArrayExpress serie E-MTAB-4787 were downloaded
  from ENA site and mapped to the genome with bowtie. File convertion
  into SGA format was performed using standard software. A ditailed
  description of the procedures involved can be found in the <a
  href='<?php echo $url_ccg; ?>/mga/dm6/schor17/schor17.html'>
  documentation</a>.
</p>

<h3 class='document'>4. oligocap and CAGE tags</h3>

<p class='document'>
  The compressed version of these files is available from the MGA
  archive (see above) under the names:
<ul class='document'>
    <li>all_oligocap.sga.gz</li>
    <li>embryo_cage.sga.gz</li>
  </ul>
</p>

<h3 class='document'>5. Peak calling</h3>
<p class='document'>
    Peak calling for each individual oligocap and CAGE data file has
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
</p>

<h3 class='document'>6. TSS validation and shifting</h3>

<p class='document'>
  Each sample in the collection (mRNA peaks and ENSEMBL TSS) was then
  processed in a pipeline aiming at validating transcription start
  sites with mRNA peaks. An Ensembl TSS was experimentally confirmed if
  a CAGE peak lied in a window of 200 bp around it and if it had a
  maximum high of at least 3 tags. The validated TSS was then
  shifted to the nearest base with the highest tag density.
</p>

<h3 class='document'>7. Promoter collection for each sample</h3>

<p class='document'>
  Each sample in the dataset was used to generate a separate
  promoter collection. Potentially, the same transcript could be
  validated by multiple samples and it could have different start
  sites in different samples. To avoid redundancy, the individual
  collections were used as input for an additional step in the
  analysis (part B in the assembly pipeline overview).
</p>

<p class='document'>
  The quality of each sample-specific promoter colection was based on
  the density distribution of known core promoter elements at
  the expected positions. A <a
  href='/miniepd/promoter_elements/tata_old.php'>
  TATA-box</a> score was evaluated as the density distribution of the
  lement at position -29 from the TSS and an <a
  href='/miniepd/promoter_elements/init.php'>
  Initiator</a> score as the density disribution at the TSS. Samples
  with very low scores (outliers) were discarded from the pool.
</p>

<h3 class='document'>8. Merging collections</h3>

<p class='document'>
  All promoter collections were merged into a unique file and further
  analyzed with the exception of samples from Schore et al.,
  2017. Since the promoter of a transcript was maintained in the list
  only if validated by at least two samples and since the position
  validated by the largest number of samples was selected as EPDnew promoter,
  there would have been an inbalance in TSS selection given the large number
  of samples in Schore et al. (2017) coming from only 3 developmental
  stages. For this reason, in order to reduce the inpact of these
  developmental stages in TSS selection, we first generated developmental
  stage-specific TSS collections and merged these with the remaining samples
  from the other sources.

<h3 class='document'>9. Second TSS selection</h3>

<p class='document'>
A further selection was applied to choose the promoter position validated by
the largest number of samples.
</p>

<h3>10. Filtering</h3>

<p class='document'>
  TSSs that mapped close to other TSSs belonging to the same gene (200-bp window)
  were merged into a unique promoter following the same rule: the promoter that was
  validated by the highest number of samples was retained.
</p>

<h3 class='document'>11. EPDnew collection</h3>

The 16972
<?php include("../../othertools.html"); ?>

<!-- ######### Insert the footer #########-->
<?php readfile("../../footer.html"); ?>

