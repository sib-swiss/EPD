<?php
include("../header.php");
$assembly = "dm6";
$noncoding = False;
?>

<h1>dmEPDnew, the <i>Drosophila melanogaster</i> (fruit fly) curated promoter database</h1>

<div class="epd-spacer"></div>

<table class="epd-db">
    <tr>
    <td>
<!-- LEFT TABLE -->
<table class="epd-db2">
    <tr>
        <td>Version</td>
        <td><b>005</b></td>
    </tr>
    <tr>
        <td>Coverage</td>
        <td><span class="epd-rounded"><b><?php echo count(file("../ftp/epdnew/D_melanogaster/current/Dm_EPDnew.sga"));?></b> promoters</span> <span class="epd-rounded"><b><?php $command='awk -F \'\t\' \'{split($6,name,"_"); print name[1]}\' ../ftp/epdnew/D_melanogaster/current/Dm_EPDnew.sga | sort -u | wc -l'; passthru("$command");?></b>genes</span></td>
    </tr>
    <tr>
        <td>Genome assembly</td>
        <td>D. melanogaster (Aug 2014 BDGP Rel6 + ISO1 MT/dm6)</td>
    </tr>
    <tr>
        <td>Gene annotation</td>
        <td>ENSEMBL 86 Genes</td>
    </tr>
    <tr>
        <td>Based on data from</td>
        <td>MachiBase<br />
            modENCODE<br />
            Hoskins et a. 2012<br />
            Ni et a. 2010<br />
            Schor et a. 2017<br />
            EPD (old)</td>
    </tr>
    <tr>
        <td style='vertical-align: top;'>Documentation &amp; Viewer(s)</td>
        <td><a href="/miniepd/epdnew/documents/Dm_epdnew_005_pipeline.php<?php
        if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
    ?>">Promoter assembly pipeline description</a>
            <br />
            <a target="_blank" href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_dm6_viewer.txt&db=dm6&position=chr3R%3A14722255-14726255<?php rtrim(readfile("../ucsc/session_options.conf"));?>">EPD viewer</a>
            (<a href="D_melanogaster_viewer.php<?php
                    if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
                ?>">track content</a>)
            <br />
            <a target="_blank"
href="http://flybase.org/jbrowse/?data=data%2Fjson%2Fdmel&loc=3R%3A18402685..18405065&tracks=Gene%2Cprotein_domains%2CcDNA%2Ctopoview_modencode_30devstages&highlight=
">FlyBase (dm6)</a></td>
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
                <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_dm6_viewer.txt&db=dm6&position=chr3R%3A14722255-14726255<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">
                <img id="ucscexample" src="Dm_promoter_example.png" alt="Promoter example" title="Click to go to the EPD hub on UCSC" /></a>
<div style="display: block; margin-top: 5px;">Promoter(s) shown above: <a href="/cgi-bin/miniepd/get_doc?db=dmEpdNew&format=genome&entry=kibra_1">kibra</a>.
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
  <?php include("Dm_QC.html"); ?>

<?php readfile("../footer.html"); ?>

</body>
</html>
