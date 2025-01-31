<?php include("../header.php"); ?>

<h1>EPD viewer for <i>H. sapiens</i> (Feb 2009 GRCh37/hg19), version 006</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_hg19_viewer.txt&db=hg19<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>H. sapiens</i> is made of the tracks given in the table below.
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
        <td class="composite" colspan="12"><span class="composite">track subset: </span><i>Selected histone marks</i></td>
</tr>
<tr>
        <td class="tracknum subtrack">1</td>
        <td>H3K4me1</td>
        <td>centered H3K4me1 ChIP-seq tags<sup>a</sup></td>
        <td>20</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP000201" target="_blank">SRP000201</a>
        </td>
        <td>BED</td>
        <td>CD4+ T cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/barski07/barski07.html" target="_blank">barski07</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/17512414" target="_blank">17512414</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">2</td>
        <td>H3K4me3</td>
        <td>centered H3K4me3 ChIP-seq tags<sup>a</sup></td>
        <td>20</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP000201" target="_blank">SRP000201</a>
        </td>
        <td>BED</td>
        <td>CD4+ T cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/barski07/barski07.html" target="_blank">barski07</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/17512414" target="_blank">17512414</a></td>
</tr>
<tr>
        <td class="tracknum">3</td>
        <td>Pol2</td>
        <td>centered RNA Pol II ChIP-seq tags<sup>b</sup></td>
        <td>20</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP000201" target="_blank">SRP000201</a>
        </td>
        <td>BED</td>
        <td>CD4+ T cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/barski07/barski07.html" target="_blank">barski07</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/17512414" target="_blank">17512414</a></td>
</tr>
<tr class="largecomp">
        <td class="tracknum">4</td>
        <td>Roadmap Project</td>
        <td>centered ChIP-seq tags for 31 histone marks<sup>c</sup></td>
        <td>20 or 100<sup>d</sup></td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://ftp.ncbi.nlm.nih.gov/pub/geo/DATA/roadmapepigenomics/by_sample/" target="_blank">ftp.ncbi.n...</a>
        </td>
        <td>BED</td>
        <td><b>116 tissues</b></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/roadmap" target="_blank">roadmap</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/25693562" target="_blank">25693562</a></td>
</tr>
<tr>
        <td class="tracknum">5</td>
        <td>All CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE34448" target="_blank">GSE34448</a>
        </td>
        <td>BAM</td>
        <td>all cell lines merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/encode/GSE34448/GSE34448.html" target="_blank">GSE34448</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/22955620" target="_blank">22955620</a></td>
</tr>
<tr class="largecomp">
        <td class="tracknum">6</td>
        <td>ENCODE CAGE</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;/&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE34448" target="_blank">GSE34448</a>
        </td>
        <td>BAM</td>
        <td><b>31 cell lines<sup>e</sup></b></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/encode/GSE34448/GSE34448.html" target="_blank">GSE34448</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/22955620" target="_blank">22955620</a></td>
</tr>
<tr>
        <td class="tracknum">7</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE34448" target="_blank">GSE34448</a>
        </td>
        <td>BAM</td>
        <td>all cell lines merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/encode/GSE34448/GSE34448.html" target="_blank">GSE34448</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/22955620" target="_blank">22955620</a></td>
</tr>
<tr>
        <td class="tracknum">8</td>
        <td>All Fantom5 (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="http://fantom.gsc.riken.jp/5/datafiles/latest/basic/" target="_blank">fantom.gsc...</a>
        </td>
        <td>BAM</td>
        <td>all samples merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/fantom5/fantom5.html" target="_blank">fantom5</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24670764" target="_blank">24670764</a></td>
</tr>
<tr class="largecomp">
        <td class="tracknum">9</td>
        <td>Fantom5 CAGE</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;/&minus;</td>
        <td><a href="http://fantom.gsc.riken.jp/5/datafiles/latest/basic/" target="_blank">fantom.gsc...</a>
        </td>
        <td>BAM</td>
        <td><b>555 tissues<sup>f</sup></b></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/fantom5/fantom5.html" target="_blank">fantom5</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24670764" target="_blank">24670764</a></td>
</tr>
<tr>
        <td class="tracknum">10</td>
        <td>All Fantom5 (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="http://fantom.gsc.riken.jp/5/datafiles/latest/basic/" target="_blank">fantom.gsc...</a>
        </td>
        <td>BAM</td>
        <td>all samples merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/fantom5/fantom5.html" target="_blank">fantom5</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24670764" target="_blank">24670764</a></td>
</tr>
<tr>
        <td class="tracknum">11</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 006</td>
        <td>1<sup>g</sup></td>
        <td><span class="epd-small">n/a</span><sup>h</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/hg19/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>tags were centered by 73 bp (ends were shifted 73 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>b</sup>tags were centered by 40 bp<br /><sup>c</sup>tags were centered by 70 bp<br /><sup>d</sup>a 20-bp resolution was used for H3K4 methylations and for all acetylations<br /><sup>e</sup>cellular long poly-A(+) samples only<br /><sup>f</sup>biological and technical replicates were merged<br /><sup>g</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>h</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub". Tracks with green background are composite tracks composed of a large number of tissues, of which a specific panel may be selected in the genome browser using track configuration.</p>

<?php readfile("../footer.html"); ?>

</body>
</html>