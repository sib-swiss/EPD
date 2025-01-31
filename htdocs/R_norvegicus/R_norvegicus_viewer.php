<?php include("../header.php"); ?>

<h1>EPD viewer for <i>R. norvegicus</i> (Jul 2014 Rnor_6.0/rn6), version 001</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_rn6_viewer.txt&db=rn6<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>R. norvegicus</i> is made of the tracks given in the table below.
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
        <td>All CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>all tissues merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="composite" colspan="12"><span class="composite">track subset: </span><i>Selected FANTOM CAGE samples</i></td>
</tr>
<tr>
        <td class="tracknum subtrack">2</td>
        <td>(+) AortSmMuscDiff</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>aortic smooth muscle cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td>differentiated</td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">3</td>
        <td>(+) AortSmoothMusc</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>aortic smooth muscle cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td>undifferentiated</td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">4</td>
        <td>(+) Hepatocytes</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>hepatocytes</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">5</td>
        <td>(+) MesencStmCells</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>mesenchymal stem cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">6</td>
        <td>(+) Universal RNA</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>universal RNA</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">7</td>
        <td>(-) AorticSmMuscDiff</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>aortic smooth muscle cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td>differentiated</td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">8</td>
        <td>(-) AortSmMuscle</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>aortic smooth muscle cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td>undifferentiated</td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">9</td>
        <td>(-) Hepatocytes</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>hepatocytes</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">10</td>
        <td>(-) MesencStmCells</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>mesenchymal stem cells</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">11</td>
        <td>(-) Universal RNA</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>universal RNA</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum">12</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td>FANTOM5
        </td>
        <td>BAM</td>
        <td>all tissues merged</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/lizio17/lizio17.html" target="_blank">lizio17</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/29182598" target="_blank">29182598</a></td>
</tr>
<tr>
        <td class="tracknum">13</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 001</td>
        <td>1<sup>a</sup></td>
        <td><span class="epd-small">n/a</span><sup>b</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/rn6/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>b</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>