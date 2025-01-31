<?php
include("../../header.php");

$assembly = "araTha1";
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

  <H1>TSS assembly pipeline for At_EPDnew_004</H1>

  <h2>Introduction</h2>
  <p>
    This document provides a technical description of the
    transcription start site assembly pipeline that was used to
    generate EPDnew version 004 for <i><?php echo $organism ?></i>.
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
      TAIR10 Genes
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
      31615
    </td>
    <td class='document'>
      27149
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/26201819'>26201819</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='ftp://ftp.arabidopsis.org/home/tair/Genes/TAIR10_genome_release/TAIR10_gff3/TAIR10_GFF3_genes.gff'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/araTha1/tair/tair.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/araTha1/tair/arabidopsisTair10Genes.sga.gz'>
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
      Morton et al., 2014
    </td>
    <td class='document'>
      PEAT
    </td>
    <td class='document'>
      1
    </td>
    <td class='document'>
      22,578,668
    </td>
    <td class='document'>
      <a href='https://www.ncbi.nlm.nih.gov/pubmed/25035402'>
      25035402</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='http://megraw.cgrb.oregonstate.edu/suppmats/3PEAT/'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/araTha1/morton14/morton14.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/araTha1/morton14/'>
      DATA</a>
    </td>
  </tr>

  <tr>
    <td class='document'>
      Cumbie et al., 2015
    </td>
    <td class='document'>
      NanoCAGE-XL
    </td>
    <td class='document'>
      3
    </td>
    <td class='document'>
      226,177,104
    </td>
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/26268438'>
	26268438
      </a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/sra/?term=PRJNA270670'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a qtarget='_blank'
      href='<?php echo $url_ftp; ?>/mga/araTha1/cumbie15/cumbie15.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/araTha1/cumbie15/'>
      DATA</a>
    </td>
  </tr>

  <tr>
    <td class='document'>
      Tokizawa et al., 2017
    </td>
    <td class='document'>
      CAGE and OligoCap
    </td>
    <td class='document'>
      2
    </td>
    <td class='document'>
      178,605,048
    </td>
    <td class='document'>
      <a href='https://www.ncbi.nlm.nih.gov/pubmed/28214361'>
      28214361</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='http://trace.ddbj.nig.ac.jp/DRASearch/submission?acc=DRA004921'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/araTha1/tokizawa17/tokizawa17.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/araTha1/tokizawa17/'>
      DATA</a>
    </td>
  </tr>

  <tr>
    <td class='document'>
      Ushijima et al., 2017
    </td>
    <td class='document'>
      CAGE
    </td>
    <td class='document'>
      7
    </td>
    <td class='document'>
      552,864,502
    </td>
    <td class='document'>
      <a href='https://www.ncbi.nlm.nih.gov/pubmed/29129375'>
      29129375</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='http://trace.ddbj.nig.ac.jp/DRASearch/submission?acc=DRA005891'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/araTha1/ushijima17/ushijima17.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/araTha1/ushijima17/'>
      DATA</a>
    </td>
  </tr>

</table>
</p>

  <h2>Assembly pipeline overview</h2>
  <p>
    <center>
      <table border=1 cellpadding=10>
	<tr>
	  <td width="300">
	    <img width="700" src="/miniepd/epdnew/epdnewGeneralPipeline.jpg" />
	  </td>
	</tr>
      </table>
    </center>
  </p>

  <h2>Description of procedures and intermediate data files</h2>


  <h3>1. Download annotated TSS</h3>

  <p>
    Primary annotation data was downloaded from <a
    href="ftp://ftp.arabidopsis.org/home/tair/Genes/">
    TAIR</a> the 06-02-2015.
  </p>
  <p>
    Genes annotations downloaded from TAIR did not contain direct
    links to RefSeq ID. For this reason, RefSeq ID has been parsed
    from <a
    href="https://ftp.ncbi.nlm.nih.gov/refseq/release/plant/">NCBI
    RefSeq files</a>.
  </p>

  A total of 31615 promoters were selected.

  <h3>2. TAIR10 TSS collection</h3>

  <p>
    The TAIR10 TSS collection is stored as a tab-deliminated text file
    conforming to the SGA format under the name:
    <ul>
      <i>arabidopsisTair10Genes.sga</i>
    </ul>
    The six fields contain the following information:
    <ul>
      <li>NCBI/RefSeq chromosome id</li>
      <li>"TSS"</li>
      <li>position</li>
      <li>strand ("+" or "-")</li>
      <li>"1"</li>
      <li>TAIR ID</li>
    </ul>
    Note that the second and forth fields are invariant.
  </p>

  <h3>3. Import CAGE data</h3>

  <p>
    Data was imported from the lab web page or GEO in BAM or SRA file
    formats. Please refer to the "Source Data" table at the beginning
    of this document for the links to raw data archives. A detailed
    guide on how to import, map and convert these samples can be found
    in the corresponding "MGA doc" files.
  </p>

  <H3>5. mRNA 5' tags peak calling</H3>

  <p>
    For the 12 samples present, peak calling has been carried out using
    <a
    href="<?php echo $url_ccg; ?>/chipseq/chip_peak.php">ChIP-Peak</a>
    on-line tool with the following parameters:

    <ul>
      <li>Window width = 1</li>
      <li>Vicinity range = 200</li>
      <li>Peak refine = Y</li>
      <li>Count cutoff = 9999999</li>
      <li>Threshold = 5</li>
    </ul>
  </p>

  <h3>6. TSS validation and shifting</h3>

  <p>
    The 12 samples used were then individually processed in a pipeline
    aiming at validating transcription start sites with mRNA peaks. A
    TAIR10 TSS was experimentally confirmed if a CAGE peak lied in a
    window of 100 bp around it. The validated TSS was then shifted to
    the nearest base with the higher tag density.
  </p>

  <h3>7. Promoter collections</h3>

  <p>
    Each sample in the dataset was used to generate a separate
    promoter collection. Potentially, the same transcript could be
    validated by multiple samples and it could have different start
    sites in different samples. To avoid redundancy, the individual
    collections were used as input for an additional step in the
    analysis (Assembly pipeline part B).
  </p>

  <h3>8. Quality controls</h3>

  <p>
    Each promoter collection was then checked for the presence of core
    promoter elements (TATA-box and Inr) in the expected positions.
  </p>

  <h3>9. Merging sample-specific collections and further TSS
  selection</h3>

  <p>
    All sample-specific promoter collections were merged into a unique
    file and further analyzed. Transcripts validated by multiple
    samples could potentially have the TSS set on a broader region rather
    than a single position. To avoid such inconsistency, for each
    transcript we selected the position that was validated by the
    largest number of samples as the true TSS.
  </p>

  <h3>10. Filtering</h3>

  <p>
    TSSs that mapped close to other TSSs that
    belonged to the same gene (100-bp window) were merged into a
    unique promoter following the same rule: the promoter that was
    validated by the highest number of samples was kept.
  </p>

  <h3>11. Final EPDnew collection</h3>

    <p>The 22703
<?php include("../../othertools.html"); ?>
   </p></div>

<!-- ######### Insert the footer #########-->
<?php include("../../footer.html"); ?>
