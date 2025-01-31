<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->

<?php include("../../header.php");

$assembly = "dm3";
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


<h1 class='document'>TSS assembly pipeline for Dm_EPDnew_003</h1>

<h2 class='document'>Introduction</h2>

<p class='document'>
  This document provides a technical description of the transcription
  start site assembly pipeline that was used to generate EPDnew
  version 003 for <i><?php echo $organism ?></i>.
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
      ENSEMBL70
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
      <a target='_blank' href='<?php echo $url_ccg; ?>/mga/dm3/ensembl/ensembl.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/dm3/ensembl/Dm_ENSEMBL70.sga.gz'>
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
      href='<?php echo $url_ccg; ?>/mga/dm3/machibase/machibase.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/dm3/machibase/'>
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
      <a qtarget='_blank'
      href='<?php echo $url_ccg; ?>/mga/dm3/hoskins11/hoskins11.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/dm3/hoskins11/embryo_cage.sga.gz'>
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
      href=''>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/dm3/encode/SRP001602/'>
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
      href='<?php echo $url_ccg; ?>/mga/dm3/ni10/ni10.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/dm3/ni10/'>
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
	<img width='700' src='/miniepd/epdnew/epdnewGeneralPipeline.jpg' />
      </td>
    </tr>
  </table>
</center>

<h2 class='document'>Description of procedures and intermediate data files</h2>

<h3 class='document'>1. Biomart Download</h3>

<p class='document'>
  Data was downloaded from BioMart selecting the following attributes:
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
  Then, transcrips have been filtered according to the following
  rules:
</p>

<ol class='document'>
    <li>Transcripts of protein coding genes only</li>
    <li>Transcript length > 0 [Transcript Start different from Transcript
    End]</li>
    <li>Transcript lies on full chromosomes</li>
    <li>Gene must have a 5' UTR [Transcript Start different from Gene
    Start]</li>
    <li>Genes must be annotated [Associated Gene Name present]</li>
    <li>Gene and transcripts status known</li>
</ol>

<p class='document'>
  Gene names were taken from the field 'Associated Gene Name'. Since
  the EPD format doesn't allow gene names longer than 18 characters,
  we checked whether the names repsected this limitation.
</p>
<p class='document'>
  Transcripts with the same TSS position were merged under a common
  ID. As a conseguence of this, from the 23850 transcrips originally
  present in the ENSEMBL database, 5953 were merged, leaving 17897
  uniquely mapped promoters in the input list.
</p>

<h3 class='document'>2. EMBL TSS collection</h3>

<p class='document'>
  The ENSEMBL TSS collection is stored as a tab-deliminated text file
  conforming to the SGA format under the name:
</p>

<ul class='document'>
  <li>Dm_ENSEMBL70.sga</li>
</ul>

<p class='document'>
  The six field contain the following kinds of information:
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

<h3 class='document'>3. Data import from MachiBase</h3>

<p class='document'>
  MachiBase data were generated with the oligo-capping technology. The
  source data were downloaded from:
</p>
<ul class='document'>
    <a href='http://download.utgenome.org/pub/machibase/tssExp.tar.gz'>
    http://download.utgenome.org/pub/machibase/tssExp.tar.gz</a>
</ul>
<p class='document'>
  According to the readme file included in the tar archive, the 5' end
  tags were mapped to the Drosophila genome using BLAT as alignment
  tool allowing for up to three mismatches.
</p>

<h3 class='document'>4. oligocap tags</h3>

<p class='document'>
  The compressed version of this file is available from the MGA
  archive (see above) under the name:
</p>
<ul class='document'>
  <i>all_oligocap.sga.gz</i>.
</ul>

<h3 class='document'>5. Data import from Genome Research</h3>

<p class='document'>
  Mapped sequence tags were extracted from Supplementary Data File 1
  available from Genome Research at:
</p>
<ul class='document'>
  <a href='http://genome.cshlp.org/content/21/2/182/suppl/DC1'>
  http://genome.cshlp.org/content/21/2/182/suppl/DC1</a>
</ul>
<p class='document'>
  The downloaded source file is in SAM format and has been generated
  with the tag mapping program StatMap as described in the article
  cyted above. We extracted all tags with mapping quality scores
  greater or equal to 30.
</p>

<h3 class='document'>6. CAGE tags</h3>

<p class='document'>
  The compressed version of this file is available from our ftp site
  (see above link) with the name:

  <ul>
    <i>embryo_cage.sga.gz</i>
  </ul>
</p>

<h3 class='document'>7. Data import from SRA</h3>

<p class='document'>
  BAM files for the SRA serie SRP001602 and SRX018832 were downloaded
  from SRA site and converted into SGA file using in house software.
</p>

<h3 class='document'>8. TSS validation and shifting</h3>

<p class='document'>
  Each sample in the collection (mRNA peaks and ENSEMBL TSS) was then
  processed in a pipeline aiming at validating transcription start
  sites with mRNA peaks. An Ensembl TSS was experimentally confirmed if
  a CAGE peak lied in a window of 200 bp around it and if it had a
  maximum high of at least 3 tags. The validated TSS was then
  shifted to the nearest base with the higher tag density.
</p>

<h3 class='document'>9. Promoter collection for each sample</h3>

<p class='document'>
  Each sample in the dataset was used to generate a separate
  promoter collection. Potentially, the same transcript could be
  validated by multiple samples and it could have different start
  sites in different samples. To avoid redundancy, the individual
  collections were used as input for an additional step in the
  analysis (Assembly pipeline part B).
</p>

<h3 class='document'>10. Merging collections and second TSS selection</h3>

<p class='document'>
  All promoter collections were merged into a unique file and
  further analysed. The promoter of a transcript was mantained in
  the list only if validated by at least two samples. Transcript
  validated by multiple samples could potentially have the TSS set
  on a broader region and not to single position. To avoid such
  inconsistency, for each transcript we selected the position that
  was validated by the larger number of samples as the true TSS.
</p>

<h3>11. Filtering</h3>

<p class='document'>
  Transcription Start Sites that mapped closed to other TSS that
  belonged to the same gene (200 bp window) were merged into a
  unique promoter following the same rule: the promoter that was
  validated by the higher number of samples was kept.
</p>

<h3 class='document'>12. EPDnew collection</h3>

<p class='document'>
  The experimentally validated promoter were stored in the EPDnew
  database that can be downloaded from our ftp site. Scientist are
  wellcome to use our other tools
  <a href='<?php echo $url_ccg; ?>/chipseq/'>ChIP-Seq</a>
  (for correlation analysis) and
  <a href='<?php echo $url_ccg; ?>/ssa/'>SSA</a>
  (for motifs analysis around promoters) to analyse EPDnew database.
</p>


<!-- ######### Insert the footer #########-->
<?php readfile("../../footer.html"); ?>





</body>
</html>

