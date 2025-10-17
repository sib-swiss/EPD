<?php
include("../header.php");
$assembly = "MorexV3";
$noncoding = False;
?>

<h1>hvEPDnew, the <i>Hordeum vulgare</i> (barley) curated promoter database</h1>

<div class="epd-spacer"></div>

<table class="epd-db">
    <tr>
    <td>
<!-- LEFT TABLE -->
<table class="epd-db2">
    <tr>
        <td>Version</td>
        <td><b>000</b></td>
    </tr>
    <tr>
        <td>Coverage</td>
        <td><span class="epd-rounded"><b><?php echo count(file("../ftp/epdnew/H_vulgare/current/Hv_EPDnew.sga"));?></b> promoters</span> <span class="epd-rounded"><b><?php $command='awk -F \'\t\' \'{split($6,name,"_"); print name[1]}\' ../ftp/epdnew/H_vulgare/current/Hv_EPDnew.sga | sort -u | wc -l'; passthru("$command");?></b>genes</span></td>
    </tr>
    <tr>
        <td>Genome assembly</td>
        <td>H. vulgare (Apr 2021 MorexV3)</td>
    </tr>
    <tr>
        <td>Gene annotation</td>
        <td>RefSeq, GenArk (Jun 2023)</td>
    </tr>
    <tr>
        <td>Based on data from</td>
        <td>Pavlu et al., 2023<br />
            </td>
    </tr>
    <tr>
        <td style='vertical-align: top;'>Documentation &amp; Viewer(s)</td>
        <td><a href="/miniepd/epdnew/documents/Hv_epdnew_000_pipeline.php<?php
        if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
    ?>">Promoter assembly pipeline description</a>
            <br />

            <a target="_blank" href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?genome=GCF_GCF_904849725.1&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_MorexV3_viewer.txt&position=chr2H:254243905-254247905"<?php rtrim(readfile("../ucsc/session_options.conf"));?>">EPD viewer</a>
            (<a href="H_vulgare_viewer.php<?php
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
                <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?genome=GCF_904849725.1&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_MorexV3_viewer.txt&position=chr2H:254243905-254247905<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">
                <img id="ucscexample" src="Hv_promoter_example.png" alt="Promoter example" width=300 title="Click to go to the EPD hub on UCSC" /></a>
                <div style="display: block; margin-top: 5px;">
                Promoter(s) shown above:
                <a href="/cgi-bin/miniepd/get_doc?db=hvEpdNew&format=genome&entry=LOC123426017_1">LOC123426017_1</a>.
                </div>
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
  centered about 30 bp upstream of the TSS, whereas the GGCCA motif
  occurs in a much wider area, with a maximal frequency at position
  -75. Based on these observations, a high-quality promoter collection
  is expected to show high peaks for both motifs. In addition, a narrow
  TATA box peak at -30 would indicate precise TSS mapping. This analysis
  has been performed using
  <a href="<?php echo $url_ssa; ?>/oprof.php">OProf</a>. EPD users are
  encouraged to repeat this analysis and to perform others in order to
  check the quality of the promoter list.
  </p>

  <!-- Organism-specific QC figures -->
  <?php include("Hv_QC.html"); ?>

<?php readfile("../footer.html"); ?>

</body>
</html>
