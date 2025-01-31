<?php
include("../header.php");
$assembly = "mm10";
$noncoding = False;
?>

<h1>mmEPDnew, the <i>Mus musculus</i> (mouse) curated promoter database</h1>

<div class="epd-spacer"></div>

<table class="epd-db">
    <tr>
    <td>
<!-- LEFT TABLE -->
<table class="epd-db2">
    <tr>
        <td>Version</td>
        <td><b>003</b></td>
    </tr>
    <tr>
        <td>Coverage</td>
        <td><span class="epd-rounded"><b><?php echo count(file("../ftp/epdnew/M_musculus/current/Mm_EPDnew.sga"));?></b> promoters</span> <span class="epd-rounded"><b><?php $command='awk -F \'\t\' \'{split($6,name,"_"); print name[1]}\' ../ftp/epdnew/M_musculus/current/Mm_EPDnew.sga | sort -u | wc -l'; passthru("$command");?></b>genes</span></td>
    </tr>
    <tr>
        <td>Genome assembly</td>
        <td>M. musculus (March 2012 GRCm38/mm10)</td>
    </tr>
    <tr>
        <td>Gene annotation</td>
        <td>UCSC known genes (Jun-2018)</td>
    </tr>
    <tr>
        <td>Based on data from</td>
        <td>FANTOM5 consortium<br />
            EPD (old)</td>
    </tr>
    <tr>
        <td style='vertical-align: top;'>Documentation &amp; Viewer(s)</td>
        <td><a href="/miniepd/epdnew/documents/Mm_epdnew_003_pipeline.php<?php
        if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
    ?>">Promoter assembly pipeline description</a>
            <br />
            <a target="_blank" href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_mm10_viewer.txt&db=mm10&position=chr12%3A57228424-57232424<?php rtrim(readfile("../ucsc/session_options.conf"));?>">EPD viewer</a>
            (<a href="M_musculus_viewer.php<?php
                    if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
                ?>">track content</a>)
            <br />
            <a target="_blank"
href="http://swissregulon.unibas.ch/jbrowse/JBrowse/?data=mm10_f5&tracks=DNA,genes,refseq_transcripts,promoters,tfbs&loc=chr12:57228424..57232424
">SwissRegulon (mm10)</a>
            <br />
            <a target="_blank"
href="http://fantom.gsc.riken.jp/zenbu/gLyphs/#config=qlHuP2o9KFFqPk1n7Mcui;loc=mm10::chr12:57228424..57232424+
">FANTOM5/ZENBU (mm10)</a>
            <br />
            <a target="_blank"
href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?db=mm10&hubUrl=http://reftss.clst.riken.jp/trackhub/hub.txt&ignoreCookie=1&position=chr12%3A57228423-57232423
">refTSS (mm10)</a></td>
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
                <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_mm10_viewer.txt&db=mm10&position=chr12%3A57228424-57232424<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">
                <img id="ucscexample" src="Mm_promoter_example.png" alt="Promoter example" title="Click to go to the EPD hub on UCSC" /></a>
<div style="display: block; margin-top: 5px;">Promoter(s) shown above: <a href="/cgi-bin/miniepd/get_doc?db=mmEpdNew&format=genome&entry=Prps1l3_1">Prps1l3</a>.
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
  <?php include("Mm_QC.html"); ?>

<?php readfile("../footer.html"); ?>

</body>
</html>
