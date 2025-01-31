<?php include("../header.php"); ?>

<h1>EPD viewer for <i>Z. mays</i> (Oct 2013 B73 RefGen_v3/zm3), version 001</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_zm3_viewer.txt&genome=zm3<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>Z. mays</i> is made of the tracks given in the table below. The genome sequence track is provided by the EPD team (sequence was downloaded <a target="_blank" href="https://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/005/005/GCF_000005005.1_B73_RefGen_v3/">here</a>).
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
        <td>Shoot H3K4me3</td>
        <td>centered H3K4me3 ChIP-seq tags<sup>a</sup></td>
        <td>25</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM381695" target="_blank">GSM381695</a>
        </td>
        <td>SRA</td>
        <td>shoot</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/zm3/wang09/wang09.html" target="_blank">wang09</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/19376930" target="_blank">19376930</a></td>
</tr>
<tr>
        <td class="tracknum">2</td>
        <td>All CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE70251" target="_blank">GSE70251</a>
        </td>
        <td>SRA</td>
        <td>root and shoot merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td>B73 and Mo17 lines merged</td><td><a href="<?php echo $url_ftp; ?>/mga/zm3/guerra15/guerra15.html" target="_blank">guerra15</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26628745" target="_blank">26628745</a></td>
</tr>
<tr>
        <td class="tracknum">3</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE70251" target="_blank">GSE70251</a>
        </td>
        <td>SRA</td>
        <td>root and shoot merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td>B73 and Mo17 lines merged</td><td><a href="<?php echo $url_ftp; ?>/mga/zm3/guerra15/guerra15.html" target="_blank">guerra15</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26628745" target="_blank">26628745</a></td>
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
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/zm3/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
<tr>
        <td class="tracknum">5</td>
        <td>RefSeq genes</td>
        <td>RefSeq gene annotation</td>
        <td>1</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/005/005/GCF_000005005.1_B73_RefGen_v3/GCF_000005005.1_B73_RefGen_v3_genomic.gff.gz" target="_blank">ftp.ncbi.n...</a>
        </td>
        <td>GFF</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/22121212" target="_blank">22121212</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>tags were centered by 50 bp (ends were shifted 50 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>b</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>c</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>