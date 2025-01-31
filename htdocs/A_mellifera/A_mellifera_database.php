<?php
include("../header.php");
$assembly = "amel5";
$noncoding = False;
?>

<h1>amEPDnew, the <i>Apis mellifera</i> (honey bee) curated promoter database</h1>

<div class="epd-spacer"></div>

<table class="epd-db">
    <tr>
    <td>
<!-- LEFT TABLE -->
<table class="epd-db2">
    <tr>
        <td>Version</td>
        <td><b>001</b></td>
    </tr>
    <tr>
        <td>Coverage</td>
        <td><span class="epd-rounded"><b><?php echo count(file("../ftp/epdnew/A_mellifera/current/Am_EPDnew.sga"));?></b> promoters</span> <span class="epd-rounded"><b><?php $command='awk -F \'\t\' \'{split($6,name,"_"); print name[1]}\' ../ftp/epdnew/A_mellifera/current/Am_EPDnew.sga | sort -u | wc -l'; passthru("$command");?></b>genes</span></td>
    </tr>
    <tr>
        <td>Genome assembly</td>
        <td>A. mellifera (Apr 2011 Amel_4.5/amel5)</td>
    </tr>
    <tr>
        <td>Gene annotation</td>
        <td>RefSeq</td>
    </tr>
    <tr>
        <td>Based on data from</td>
        <td>Khamis et al., 2015<br />
            EPD (old)</td>
    </tr>
    <tr>
        <td valign=top>Documentation &amp; Viewer(s)</td>
        <td><a href="/miniepd/epdnew/documents/Am_epdnew_001_pipeline.php<?php
        if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
    ?>">Promoter assembly pipeline description</a>
            <br />
            <a target="_blank" href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_amel5_viewer.txt&genome=amel5&position=chrLG5%3A11855740-11859740<?php rtrim(readfile("../ucsc/session_options.conf"));?>">EPD viewer</a>
            (<a href="A_mellifera_viewer.php<?php
                    if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
                ?>">track content</a>)</td>
    </tr>
</table>
<!-- End of left table -->
</td>
<td>
<!-- RIGHT TABLE -->
        <table class="epd-db3">
            <tr>
            <td>
                <!-- UCSC PICTURE -->
                <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_amel5_viewer.txt&genome=amel5&position=chrLG5%3A11855740-11859740<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">
                <img id="ucscexample" src="Am_promoter_example.png" alt="Promoter example" title="Click to go to the EPD hub on UCSC" /></a>
            </td>
        </tr>
    </table>
<!-- End of right table -->
</td>
</tr>
</table>

<?php include("../database_tools.php"); ?>

<h2>Database quality control</h2>

<h3>Core promoter elements' enrichment</h3>
<p>
  Core promoter element analysis is performed in order to investigate
  the quality of the promoter collection. It leverages the preferential
  occurrence of certain DNA motifs at characteristic distances from the
  TSS. For instance, TATA boxes occur in a narrow region
  centered about 28 bp upstream of the TSS, whereas the CCAAT box
  occurs in a much wider area, with a maximal frequency at position
  -80. Based on these observations, a high-quality promoter collection
  is expected to show high peaks for both motifs. In addition, a narrow
  TATA box peak at -28 would indicate precise TSS mapping. This analysis
  has been performed using
  <a href="<?php echo $url_ssa; ?>/oprof.php">OProf</a>. EPD users are
  encouraged to repeat this analysis and to perform others in order to
  check the quality of the promoter list.
  </p>

  <!-- Organism-specific QC figures -->
  <?php include("Am_QC.html"); ?>

<?php readfile("../footer.html"); ?>

</body>
</html>
