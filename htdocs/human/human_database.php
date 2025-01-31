<?php
include("../header.php");
$assembly = "hg38";
$noncoding = False;
?>

<h1>hsEPDnew, the <i>Homo sapiens</i> (human) curated promoter database</h1>

<div class="epd-spacer"></div>

<table class="epd-db">
    <tr>
    <td>
<!-- LEFT TABLE -->
<table class="epd-db2">
    <tr>
        <td>Version</td>
        <td><b>006</b></td>
    </tr>
    <tr>
        <td>Coverage</td>
        <td><span class="epd-rounded"><b><?php echo count(file("../ftp/epdnew/H_sapiens/current/Hs_EPDnew.sga"));?></b> promoters</span> <span class="epd-rounded"><b><?php $command='awk -F \'\t\' \'{split($6,name,"_"); print name[1]}\' ../ftp/epdnew/H_sapiens/current/Hs_EPDnew.sga | sort -u | wc -l'; passthru("$command");?></b>genes</span></td>
    </tr>
    <tr>
        <td>Genome assembly</td>
        <td>H. sapiens (Dec 2013 GRCh38/hg38)</td>
    </tr>
    <tr>
        <td>Gene annotation</td>
        <td>Gencode (v28)</td>
    </tr>
    <tr>
        <td>Based on data from</td>
        <td>Riken/ENCODE CAGE data downloaded from UCSC<br />
            FANTOM5 data<br />
            Rampage data<br />
            EPD (old)</td>
    </tr>
    <tr>
        <td style='vertical-align: top;'>Documentation &amp; Viewer(s)</td>
        <td><a href="/miniepd/epdnew/documents/Hs_epdnew_006_pipeline.php<?php
        if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
    ?>">Promoter assembly pipeline description</a>
            <br />
            <a target="_blank" href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_hg38_viewer.txt&db=hg38&position=chr16%3A85797694-85801694<?php rtrim(readfile("../ucsc/session_options.conf"));?>">EPD viewer - hg38</a>
            (<a href="H_sapiens_viewer.php<?php
                    if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
                ?>">track content</a>)
            <br />
            <a target="_blank" href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_hg19_viewer.txt&db=hg19&position=chr16%3A85830894-85834894">EPD viewer - hg19</a>
            (<a href="H_sapiens_viewer_hg19.php<?php
                    if(isset($_GET['db'])) { echo "?db={$_GET['db']}"; }
                ?>">track content</a>)
            <br />
            <a target="_blank"
href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/viewers/euro/GM12878_hg19_viewer.txt&db=hg19&position=chr16%3A85830894-85834894&ignoreCookie=1">GM12878 viewer (hg19)</a>
            <br />
            <a target="_blank"
href="http://fantom.gsc.riken.jp/zenbu/gLyphs/#config=338Jp369HlMrduGQJmN3-B;loc=hg38::chr16:85797694..85801694
">FANTOM5/ZENBU (hg38)</a>
            <br />
            <a target="_blank"
href="https://dbtss.hgc.jp/#kero:chr16:85797694-85801694
">DBTSS/KERO (hg38)</a>
            <br />
            <a target="_blank"
href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?db=hg38&hubUrl=http://reftss.clst.riken.jp/trackhub/hub.txt&ignoreCookie=1&position=chr16%3A85797693-85801693
">refTSS (hg38)</a>
            <br />
            <a target="_blank"
href="http://swissregulon.unibas.ch/jbrowse/JBrowse/?data=hg19&tracks=DNA,genes,refseq_transcripts,promoters,tfbs&loc=chr16:85831150..85835150
">SwissRegulon (hg19)</a></td>
<!-- href="http://swissregulon.unibas.ch/jbrowse/JBrowse/?data=hg19_f5&loc=chr16:85831150..85835150 -->
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
                <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_hg38_viewer.txt&db=hg38&position=chr16%3A85797694-85801694<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">
                <img id="ucscexample" src="Hs_promoter_example.png" alt="Promoter example" title="Click to go to the EPD hub on UCSC" /></a>
<div style="display: block; margin-top: 5px;">Promoters shown above: <a href="/cgi-bin/miniepd/get_doc?db=hgEpdNew&format=genome&entry=EMC8_1">EMC8</a> and
<a href="/cgi-bin/miniepd/get_doc?db=hgEpdNew&format=genome&entry=COX4I1_1">COX4I1</a>.
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
  <?php include("Hs_QC.html"); ?>

<?php readfile("../footer.html"); ?>

</body>
</html>
