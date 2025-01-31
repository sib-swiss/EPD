<?php include("../header.php"); ?>

<h1>EPD viewer for <i>D. melanogaster</i> (Aug 2014 BDGP Rel6 + ISO1 MT/dm6), version 005</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_dm6_viewer.txt&db=dm6<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>D. melanogaster</i> is made of the tracks given in the table below.
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
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM480156" target="_blank">GSM480156</a>
        </td>
        <td>BED</td>
        <td>S2 cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/gan10/gan10.html" target="_blank">gan10</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/20398323" target="_blank">20398323</a></td>
</tr>
<tr>
        <td class="tracknum">2</td>
        <td>Pol2</td>
        <td>centered RNA Pol II ChIP-seq tags<sup>b</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM480159" target="_blank">GSM480159</a>
        </td>
        <td>BED</td>
        <td>S2 cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/gan10/gan10.html" target="_blank">gan10</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/20398323" target="_blank">20398323</a></td>
</tr>
<tr>
        <td class="tracknum">3</td>
        <td>All CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP001602" target="_blank">SRP001602</a>
        </td>
        <td>SRA</td>
        <td>all tissues merged</td>
        <td>all stages merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="composite" colspan="12"><span class="composite">track subset: </span><i>Selected modENCODE CAGE samples</i></td>
</tr>
<tr>
        <td class="tracknum subtrack">4</td>
        <td>(+) Digestive System</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX142925/" target="_blank">SRX142925</a>, <a href="https://www.ncbi.nlm.nih.gov/sra/SRX142927/" target="_blank">SRX142927</a>
        </td>
        <td>SRA</td>
        <td>digestive system</td>
        <td>adult</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">5</td>
        <td>(+) Embryo</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP001602" target="_blank">SRP001602</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>mixed embryos</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">6</td>
        <td>(+) Head</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP001602" target="_blank">SRP001602</a>
        </td>
        <td>SRA</td>
        <td>head</td>
        <td>adult</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">7</td>
        <td>(+) Larvae</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP001602" target="_blank">SRP001602</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>mixed larvae</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">8</td>
        <td>(+) Ovaries</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX142920/" target="_blank">SRX142920</a>, <a href="https://www.ncbi.nlm.nih.gov/sra/SRX142928/" target="_blank">SRX142928</a>
        </td>
        <td>SRA</td>
        <td>ovaries</td>
        <td>adult</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">9</td>
        <td>(+) Pupae</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX142945/" target="_blank">SRX142945</a>, <a href="https://www.ncbi.nlm.nih.gov/sra/SRX142955/" target="_blank">SRX142955</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>mixed pupae</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">10</td>
        <td>(+) Testes</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX142924/" target="_blank">SRX142924</a>
        </td>
        <td>SRA</td>
        <td>testes</td>
        <td>adult</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">11</td>
        <td>(-) Digestive System</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX142925/" target="_blank">SRX142925</a>, <a href="https://www.ncbi.nlm.nih.gov/sra/SRX142927/" target="_blank">SRX142927</a>
        </td>
        <td>SRA</td>
        <td>digestive system</td>
        <td>adult</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">12</td>
        <td>(-) Embryo</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP001602" target="_blank">SRP001602</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>mixed embryos</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">13</td>
        <td>(-) Head</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP001602" target="_blank">SRP001602</a>
        </td>
        <td>SRA</td>
        <td>head</td>
        <td>adult</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">14</td>
        <td>(-) Larvae</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP001602" target="_blank">SRP001602</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>mixed larvae</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">15</td>
        <td>(-) Ovaries</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX142920/" target="_blank">SRX142920</a>, <a href="https://www.ncbi.nlm.nih.gov/sra/SRX142928/" target="_blank">SRX142928</a>
        </td>
        <td>SRA</td>
        <td>ovaries</td>
        <td>adult</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">16</td>
        <td>(-) Pupae</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX142945/" target="_blank">SRX142945</a>, <a href="https://www.ncbi.nlm.nih.gov/sra/SRX142955/" target="_blank">SRX142955</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>mixed pupae</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">17</td>
        <td>(-) Testes</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX142924/" target="_blank">SRX142924</a>
        </td>
        <td>SRA</td>
        <td>testes</td>
        <td>adult</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum">18</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP001602" target="_blank">SRP001602</a>
        </td>
        <td>SRA</td>
        <td>all tissues merged</td>
        <td>all stages merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/encode/SRP001602/SRP001602.html" target="_blank">SRP001602</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24985915" target="_blank">24985915</a></td>
</tr>
<tr>
        <td class="tracknum">19</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 005</td>
        <td>1<sup>c</sup></td>
        <td><span class="epd-small">n/a</span><sup>d</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/dm6/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>tags were centered by 60 bp (ends were shifted 60 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>b</sup>tags were centered by 40 bp<br /><sup>c</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>d</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>