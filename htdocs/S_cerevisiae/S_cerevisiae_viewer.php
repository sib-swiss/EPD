<?php include("../header.php"); ?>

<h1>EPD viewer for <i>S. cerevisiae</i> (Apr 2011 R64/sacCer3), version 002</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_sacCer3_viewer.txt&db=sacCer3<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>S. cerevisiae</i> is made of the tracks given in the table below.
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
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1263832" target="_blank">GSM1263832</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/sacCer3/park14/park14.html" target="_blank">park14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24413663" target="_blank">24413663</a></td>
</tr>
<tr>
        <td class="tracknum">2</td>
        <td>H3K4me3</td>
        <td>centered H3K4me3 ChIP-seq tags<sup>b</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE52339" target="_blank">GSE52339</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>all time points merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/sacCer3/kuang14/kuang14.html" target="_blank">kuang14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/25173176" target="_blank">25173176</a></td>
</tr>
<tr>
        <td class="tracknum">3</td>
        <td>H3K14ac</td>
        <td>centered H3K14ac ChIP-seq tags<sup>b</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE52339" target="_blank">GSE52339</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>all time points merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/sacCer3/kuang14/kuang14.html" target="_blank">kuang14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/25173176" target="_blank">25173176</a></td>
</tr>
<tr>
        <td class="tracknum">4</td>
        <td>CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1192567" target="_blank">GSM1192567</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1192569" target="_blank">GSM1192569</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1192571" target="_blank">GSM1192571</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/sacCer3/park14/park14.html" target="_blank">park14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24413663" target="_blank">24413663</a></td>
</tr>
<tr>
        <td class="tracknum">5</td>
        <td>CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1192567" target="_blank">GSM1192567</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1192569" target="_blank">GSM1192569</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1192571" target="_blank">GSM1192571</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/sacCer3/park14/park14.html" target="_blank">park14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24413663" target="_blank">24413663</a></td>
</tr>
<tr>
        <td class="tracknum">6</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 002</td>
        <td>1<sup>c</sup></td>
        <td><span class="epd-small">n/a</span><sup>d</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/sacCer3/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>tags were centered by 70 bp (ends were shifted 70 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>b</sup>tags were centered by 75 bp<br /><sup>c</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>d</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>
