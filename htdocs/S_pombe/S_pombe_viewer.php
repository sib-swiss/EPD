<?php include("../header.php"); ?>

<h1>EPD viewer for <i>S. pombe</i> (Aug 2015 ASM294v2/spo2), version 002</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_spo2_viewer.txt&genome=spo2<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>S. pombe</i> is made of the tracks given in the table below. The genome sequence track is provided by the EPD team (sequence was downloaded <a target="_blank" href="https://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/945/GCF_000002945.1_ASM294v2/">here</a>).
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
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP028538" target="_blank">SRP028538</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td>wild-type</td><td><a href="<?php echo $url_ftp; ?>/mga/spo2/degennaro13/degennaro13.html" target="_blank">degennaro13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24100010" target="_blank">24100010</a></td>
</tr>
<tr>
        <td class="tracknum">2</td>
        <td>H3K4me3 (WT)</td>
        <td>centered H3K4me3 ChIP-seq tags<sup>b</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1201989" target="_blank">GSM1201989</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td>wild-type</td><td><a href="<?php echo $url_ftp; ?>/mga/spo2/degennaro13/degennaro13.html" target="_blank">degennaro13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24100010" target="_blank">24100010</a></td>
</tr>
<tr>
        <td class="tracknum">3</td>
        <td>All CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ebi.ac.uk/arrayexpress/experiments/E-MTAB-3188/" target="_blank">E-MTAB-3188</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE110976" target="_blank">GSE110976</a>
        </td>
        <td>FASTQ</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td>wild-type</td><td><a href="<?php echo $url_ftp; ?>/mga/spo2/li15/li15.html" target="_blank">li15</a>, <a href="<?php echo $url_ftp; ?>/mga/spo2/thodberg18/thodberg18.html" target="_blank">thodberg18</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/25747261" target="_blank">25747261</a></td>
</tr>
<tr>
        <td class="tracknum">4</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ebi.ac.uk/arrayexpress/experiments/E-MTAB-3188/" target="_blank">E-MTAB-3188</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE110976" target="_blank">GSE110976</a>
        </td>
        <td>FASTQ</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td>wild-type</td><td><a href="<?php echo $url_ftp; ?>/mga/spo2/li15/li15.html" target="_blank">li15</a>, <a href="<?php echo $url_ftp; ?>/mga/spo2/thodberg18/thodberg18.html" target="_blank">thodberg18</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/25747261" target="_blank">25747261</a></td>
</tr>
<tr>
        <td class="tracknum">5</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 002</td>
        <td>1<sup>c</sup></td>
        <td><span class="epd-small">n/a</span><sup>d</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/spo2/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
<tr>
        <td class="tracknum">6</td>
        <td>RefSeq genes</td>
        <td>RefSeq gene annotation</td>
        <td>1</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/945/GCF_000002945.1_ASM294v2/GCF_000002945.1_ASM294v2_genomic.gff.gz" target="_blank">ftp.ncbi.n...</a>
        </td>
        <td>GFF</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/22121212" target="_blank">22121212</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>the midpoint between paired-end fragments was calculated<br /><sup>b</sup>tags were centered by 50 bp (ends were shifted 50 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>c</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>d</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>