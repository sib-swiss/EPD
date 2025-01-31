<?php include("../header.php"); ?>

<h1>EPD viewer for <i>A. thaliana</i> (Feb 2011 TAIR10/araTha1), version 004</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_araTha1_viewer.txt&genome=araTha1<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>A. thaliana</i> is made of the tracks given in the table below. The genome sequence track is provided by the EPD team (sequence was downloaded <a target="_blank" href="https://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/001/735/GCF_000001735.3_TAIR10/">here</a>).
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
        <td>20</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1216733" target="_blank">GSM1216733</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>seedling</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/araTha1/li14/li14.html" target="_blank">li14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24606212" target="_blank">24606212</a></td>
</tr>
<tr>
        <td class="tracknum">2</td>
        <td>GFP H3K4me3</td>
        <td>centered H3K4me3 ChIP-seq<sup>b</sup></td>
        <td>20</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM2302418" target="_blank">GSM2302418</a>
        </td>
        <td>SRA</td>
        <td>root</td>
        <td><span class="epd-small">n/a</span></td>
        <td>GFP</td><td><a href="<?php echo $url_ftp; ?>/mga/araTha1/deLucas16/deLucas16.html" target="_blank">deLucas16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/27650334" target="_blank">27650334</a></td>
</tr>
<tr>
        <td class="tracknum">3</td>
        <td>All CAGE (+)</td>
        <td>5&prime; end of PEAT reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="http://megraw.cgrb.oregonstate.edu/suppmats/3PEAT/" target="_blank">megraw.cgr...</a>
        </td>
        <td>BAM</td>
        <td>root</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/araTha1/morton14/morton14.html" target="_blank">morton14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/25035402" target="_blank">25035402</a></td>
</tr>
<tr>
        <td class="tracknum">4</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of PEAT reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="http://megraw.cgrb.oregonstate.edu/suppmats/3PEAT/" target="_blank">megraw.cgr...</a>
        </td>
        <td>BAM</td>
        <td>root</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/araTha1/morton14/morton14.html" target="_blank">morton14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/25035402" target="_blank">25035402</a></td>
</tr>
<tr>
        <td class="tracknum">5</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 004</td>
        <td>1<sup>c</sup></td>
        <td><span class="epd-small">n/a</span><sup>d</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/araTha1/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
<tr>
        <td class="tracknum">6</td>
        <td>RefSeq genes</td>
        <td>RefSeq gene annotation</td>
        <td>1</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="http://www.arabidopsis.org/download_files/Genes/TAIR10_genome_release/TAIR10_gff3/TAIR10_GFF3_genes.gff" target="_blank">arabidopsi...</a>
        </td>
        <td>GFF</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/22121212" target="_blank">22121212</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>tags were centered by 73 bp (ends were shifted 73 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>b</sup>tags were centered by 60 bp<br /><sup>c</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>d</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>