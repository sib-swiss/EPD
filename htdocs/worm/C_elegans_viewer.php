<?php include("../header.php"); ?>

<h1>EPD viewer for <i>C. elegans</i> (May 2008 WS190/ce6), version 001</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_ce6_viewer.txt&db=ce6<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>C. elegans</i> is made of the tracks given in the table below.
Note that when strand is n/a, it means that signal applies to both strands.
</p>

<table class="epd-viewer">
<thead>
    <tr>
        <th><!-- Track number --></th>
        <th>UCSC track name</th>
        <th>Track description</th>
        <th>Track resolution [bp]</th>
        <th>Strand</th>
        <th>Original dataset</th>
        <th>Raw format</th>
        <th>Tissue</th>
        <th>Stage/Time point</th>
        <th>Condition</th>
        <th>MGA series name</th>
        <th>PMID</th>
    </tr>
</thead>

<tbody>
<tr>
        <td class="tracknum">1</td>
        <td>Nucleosomes</td>
        <td>centered MNase-seq tags<sup>a</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE20136" target="_blank">GSE20136</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>all stages merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/ce6/ercan11/ercan11.html" target="_blank">ercan11</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/21177966" target="_blank">21177966</a></td>
</tr>
<tr>
        <td class="composite" colspan="12"><span class="composite">track subset: </span><i>Nucleosomes at various stages</i></td>
</tr>
<tr>
        <td class="tracknum subtrack">2</td>
        <td>Nucleosomes (MS)</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM514735" target="_blank">GSM514735</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>mixed stage embryos</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/ce6/ercan11/ercan11.html" target="_blank">ercan11</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/21177966" target="_blank">21177966</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">3</td>
        <td>Nucleosomes (GL)</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM514736" target="_blank">GSM514736</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>young germline-less adults</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/ce6/ercan11/ercan11.html" target="_blank">ercan11</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/21177966" target="_blank">21177966</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">4</td>
        <td>Nucleosomes (GC)</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM590213" target="_blank">GSM590213</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>young germline-containing adults</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/ce6/ercan11/ercan11.html" target="_blank">ercan11</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/21177966" target="_blank">21177966</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">5</td>
        <td>Nucleosomes (L3)</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM590214" target="_blank">GSM590214</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>L3 stage XO hermaphrodites</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/ce6/ercan11/ercan11.html" target="_blank">ercan11</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/21177966" target="_blank">21177966</a></td>
</tr>
<tr>
        <td class="tracknum">6</td>
        <td>H3K4me3</td>
        <td>centered H3K4me3 ChIP-seq tags<sup>b</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1208361" target="_blank">GSM1208361</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1208362" target="_blank">GSM1208362</a>
        </td>
        <td>SRA</td>
        <td>whole embryo</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/ce6/chen14/chen14.html" target="_blank">chen14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24653213" target="_blank">24653213</a></td>
</tr>
<tr>
        <td class="tracknum">7</td>
        <td>GRO-cap (+)</td>
        <td>5&prime; end of GRO-cap reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE43087" target="_blank">GSE43087</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/ce6/kruesi13/kruesi13.html" target="_blank">kruesi13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23795297" target="_blank">23795297</a></td>
</tr>
<tr>
        <td class="tracknum">8</td>
        <td>GRO-cap (-)</td>
        <td>5&prime; end of GRO-cap reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE43087" target="_blank">GSE43087</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/ce6/kruesi13/kruesi13.html" target="_blank">kruesi13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23795297" target="_blank">23795297</a></td>
</tr>
<tr>
        <td class="tracknum">9</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 001</td>
        <td>1<sup>c</sup></td>
        <td><span class="epd-small">n/a</span><sup>d</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/ce6/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>tags were centered by 73 bp (ends were shifted 73 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>b</sup>tags were centered by 80 bp<br /><sup>c</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>d</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>