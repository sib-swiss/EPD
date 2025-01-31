<?php include("../header.php"); ?>

<h1>EPD viewer for <i>G. gallus</i> (Dec 2015 Gallus_gallus-5.0/galGal5), version 001</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_galGal5_viewer.txt&db=galGal5<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>G. gallus</i> is made of the tracks given in the table below.
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
        <td>H3K4me3</td>
        <td>centered H3K4me3 ChIP-seq tags<sup>a</sup></td>
        <td>25</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE86414" target="_blank">GSE86414</a>
        </td>
        <td>SRA</td>
        <td>primary remiges</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/galGal5/li17/li17.html" target="_blank">li17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/28106042" target="_blank">28106042</a></td>
</tr>
<tr>
        <td class="tracknum">2</td>
        <td>All CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td>FANTOM5
        </td>
        <td>FASTQ</td>
        <td>all adult tissues merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/galGal5/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/28873399" target="_blank">28873399</a></td>
</tr>
<tr>
        <td class="tracknum">3</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td>FANTOM5
        </td>
        <td>FASTQ</td>
        <td>all adult tissues merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/galGal5/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/28873399" target="_blank">28873399</a></td>
</tr>
<tr>
        <td class="tracknum">4</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 001</td>
        <td>1<sup>b</sup></td>
        <td><span class="epd-small">n/a</span><sup>c</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/galGal5/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>tags were centered by 70 bp (ends were shifted 70 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>b</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>c</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>