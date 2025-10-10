<?php include("../header.php"); ?>

<h1>EPD viewer for <i>H. vulgare</i> (Apr 2021 GCF_904849725.1/MorexV3), version 000</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?genome=GCF_GCF_904849725.1&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_MorexV3_viewer.txt&position=chr2H:254243905-254247905<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>S. pombe</i> is made of the tracks given in the table below. The genome sequence track is provided by the EPD team (sequence was downloaded <a target="_blank" href="https://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/945/GCF_000002945.1_ASM294v2/">here</a>).
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
        <td>EPDnew</td>
        <td>Barley promoters from EPDnew version 000<sup>a</sup></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span><sup>c</sup></td>
        <td><span class="epd-small">n/a</span><sup>b</sup></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="<?php echo $url_ftp; ?>/mga/pfa2/epd/epd.html" target="_blank">epd</a></td>
        <td><span class="epd-small">n/a</span></td>
</tr>
<tr>
        <td class="tracknum">2</td>
        <td>pavlu23_tcs</td>
        <td>TSS clusters from Pavlu et al. 2023</td>
        <td>1<sup>c</sup></td>
        <td><span class="epd-small">n/a</span><sup>d</sup></td>
        <td><a href="https://doi.org/10.1016/j.csbj.2023.12.003" target="_blank">Pavlu et al. 2023</a> Suppl. data file S1</td>
        <td>BED-like</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="<?php echo $url_ftp; ?>/mga/MorexV3/pavlu23/pavlu23.html" target="_blank">pavlu23</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/38173877" target="_blank">38173877</a></td>
</tr>
<tr>
        <td class="tracknum">3</td>
        <td>All CAGE (+)</td>
        <td>Barley embryo all CAGE(+)</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE227219" target="_blank">GSE227219</a></td>
        <td>FASTQ</td>
        <td>all samples merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="<?php echo $url_ftp; ?>/mga/MorexV3/pavlu23/pavlu23.html" target="_blank">pavlu23</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/38173877" target="_blank">38173877</a></td>
</tr>
<tr>
        <td class="tracknum">4</td>
        <td>All CAGE (-)</td>
        <td>Barley embryo all CAGE(-)</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE227219" target="_blank">GSE227219</a></td>
        <td>FASTQ</td>
        <td>all samples merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        </td><td><a href="<?php echo $url_ftp; ?>/mga/MorexV3/pavlu23/pavlu23.html" target="_blank">pavlu23</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/38173877" target="_blank">38173877</a></td>
</tr>
<tr class="largecomp">
        <td class="tracknum">5</td>
        <td>pavlu_2023_CAGE</td>
        <td>Barley embryo CAGE</td>
        <td>1</td>
        <td>&plus;/&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE227219" target="_blank">GSE227219</a></td>
        <td>FASTQ</td>
        <td>embryo</td>
        <td><b>3 stages</b></td>
        <td><span class="epd-small">n/a</span></td>
        </td><td><a href="<?php echo $url_ftp; ?>/mga/MorexV3/pavlu23/pavlu23.html" target="_blank">pavlu23</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/38173877" target="_blank">38173877</a></td>
</tr>
<tr class="largecomp">
        <td class="tracknum">6</td>
        <td>pavlu_2023_MNase</td>
        <td>Barley embryo ChIP-seq_Mnas</td>
        <td>10,25,50<sup>e</sup></td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE227219" target="_blank">GSE227219</a>
        </td>
        <td>FASTQ</td>
        <td>embryo</td>
        <td><b>3 stages</b></td>
        <td><span class="epd-small">n/a</span></td>
        </td><td><a href="<?php echo $url_ftp; ?>/mga/MorexV3/pavlu23/pavlu23.html" target="_blank">pavlu23</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/38173877" target="_blank">38173877</a></td>
</tr>

</tbody>
</table>
<footer><sup>a</sup>
the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS

<br /><sup>b</sup>
promoters on the &plus; and &minus; strands are combined in a single track,
with promoter orientation defined by the position of the thick part relative to the thin part

<br><sup>c</sup> the thick part (1 bp) represents the summit position indicated in the TSS cluster list.
The thin part indicates the region cluster region as defined by the start and end position in the BED file

<br /><sup>d</sup> promoters on the &plus; and &minus; strands are combined in a single track

<br /><sup>e</sup> 10 for all merged and merged H3k4me3 samples, 25 for individual H3K4me3 and merged H3K9ac,H3k27me3 sammples;
50 for individal H3K9ac,H3k27me3 sammples

</footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>
