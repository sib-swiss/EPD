<?php include("../header.php"); ?>

<h1>EPD viewer for <i>M. musculus</i> (March 2012 GRCm38/mm10), version 003</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_mm10_viewer.txt&db=mm10<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>M. musculus</i> is made of the tracks given in the table below.
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
        <td class="composite" colspan="12"><span class="composite">track subset: </span><i>Nucleosomes</i></td>
</tr>
<tr>
        <td class="tracknum subtrack">1</td>
        <td>Liver nucleosomes</td>
        <td>centered MNase tags<sup>a</sup></td>
        <td>20</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1425447" target="_blank">GSM1425447</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1425448" target="_blank">GSM1425448</a>
        </td>
        <td>SRA</td>
        <td>liver</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm9/west14/west14.html" target="_blank">west14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/ 25158628" target="_blank"> 25158628</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">2</td>
        <td>ESC nucleosomes</td>
        <td>centered MNase tags<sup>a</sup></td>
        <td>20</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1425441" target="_blank">GSM1425441</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1425442" target="_blank">GSM1425442</a>
        </td>
        <td>SRA</td>
        <td>embryonic stem cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm9/west14/west14.html" target="_blank">west14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/ 25158628" target="_blank"> 25158628</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">3</td>
        <td>iPSC nucleosomes</td>
        <td>centered MNase tags<sup>a</sup></td>
        <td>20</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1425443" target="_blank">GSM1425443</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1425444" target="_blank">GSM1425444</a>
        </td>
        <td>SRA</td>
        <td>induced pluripotent stem cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm9/west14/west14.html" target="_blank">west14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/ 25158628" target="_blank"> 25158628</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">4</td>
        <td>TTF nucleosomes</td>
        <td>centered MNase tags<sup>a</sup></td>
        <td>20</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1425445" target="_blank">GSM1425445</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1425446" target="_blank">GSM1425446</a>
        </td>
        <td>SRA</td>
        <td>tail-tip fibroblasts</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm9/west14/west14.html" target="_blank">west14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/ 25158628" target="_blank"> 25158628</a></td>
</tr>
<tr>
        <td class="composite" colspan="12"><span class="composite">track subset: </span><i>Selected Histone Marks</i></td>
</tr>
<tr>
        <td class="tracknum subtrack">5</td>
        <td>Myoblasts H3K4me1</td>
        <td>centered H3K4me1 ChIP-seq tags<sup>b</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM721288" target="_blank">GSM721288</a>
        </td>
        <td>TXT</td>
        <td>myoblasts</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm10/asp11/asp11.html" target="_blank">asp11</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/21551099" target="_blank">21551099</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">6</td>
        <td>Myoblasts H3K4me3</td>
        <td>centered H3K4me3 ChIP-seq tags<sup>b</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM721292" target="_blank">GSM721292</a>
        </td>
        <td>TXT</td>
        <td>myoblasts</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm10/asp11/asp11.html" target="_blank">asp11</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/21551099" target="_blank">21551099</a></td>
</tr>
<tr>
        <td class="tracknum">7</td>
        <td>Myoblasts Pol2</td>
        <td>centered RNA Pol II ChIP-seq tags<sup>c</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM721286" target="_blank">GSM721286</a>
        </td>
        <td>TXT</td>
        <td>myoblasts</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm10/asp11/asp11.html" target="_blank">asp11</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/21551099" target="_blank">21551099</a></td>
</tr>
<tr>
        <td class="tracknum">8</td>
        <td>All CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>all adult tissues merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm10/fantom5/fantom5.html" target="_blank">fantom5</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24670764" target="_blank">24670764</a></td>
</tr>
<tr class="largecomp">
        <td class="tracknum">9</td>
        <td>Fantom5 CAGE</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;/&minus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td><b> 508 tissues<sup>d</sup></b></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm10/fantom5/fantom5.html" target="_blank">fantom5</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24670764" target="_blank">24670764</a></td>
</tr>
<tr>
        <td class="tracknum">10</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>all adult tissues merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm10/fantom5/fantom5.html" target="_blank">fantom5</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24670764" target="_blank">24670764</a></td>
</tr>
<tr>
        <td class="tracknum">11</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 003</td>
        <td>1<sup>e</sup></td>
        <td><span class="epd-small">n/a</span><sup>f</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm10/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
<tr>
        <td class="tracknum">12</td>
        <td>EPDnewNC promoters</td>
        <td>EPDnewNC promoters v. 001</td>
        <td>1<sup>e</sup></td>
        <td><span class="epd-small">n/a</span><sup>f</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/mm10/epd-nc/epd-nc.html" target="_blank">epd-nc</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>the midpoint between paired-end fragments was used <br /><sup>b</sup>tags were centered by 75 bp (ends were shifted 75 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>c</sup>tags were centered by 50 bp<br /><sup>d</sup>biological and technical replicates were merged<br /><sup>e</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>f</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub". Tracks with green background are composite tracks composed of a large number of tissues, of which a specific panel may be selected in the genome browser using track configuration.</p>

<?php readfile("../footer.html"); ?>

</body>
</html>