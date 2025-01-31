<?php include("../header.php"); ?>

<h1>EPD viewer for <i>P. falciparum</i> (Apr 2016 ASM276v2/pfa2), version 001</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_pfa2_viewer.txt&genome=pfa2<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>P. falciparum</i> is made of the tracks given in the table below. The genome sequence track is provided by the EPD team (sequence was downloaded <a target="_blank" href="https://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/002/765/GCF_000002765.4_ASM276v2/">here</a>).
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
        <td>All MNase</td>
        <td>centered MNase-seq tags<sup>a</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE66185" target="_blank">GSE66185</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>all time points merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/kensche16/kensche16.html" target="_blank">kensche16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26578577" target="_blank">26578577</a></td>
</tr>
<tr>
        <td class="composite" colspan="12"><span class="composite">track subset: </span><i>MNase tags at various time points</i></td>
</tr>
<tr>
        <td class="tracknum subtrack">2</td>
        <td>MNase at 5h</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1616484" target="_blank">GSM1616484</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-5 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/kensche16/kensche16.html" target="_blank">kensche16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26578577" target="_blank">26578577</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">3</td>
        <td>MNase at 10h</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1616485" target="_blank">GSM1616485</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-10 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/kensche16/kensche16.html" target="_blank">kensche16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26578577" target="_blank">26578577</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">4</td>
        <td>MNase at 15h</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1616486" target="_blank">GSM1616486</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-15 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/kensche16/kensche16.html" target="_blank">kensche16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26578577" target="_blank">26578577</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">5</td>
        <td>MNase at 20h</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1616487" target="_blank">GSM1616487</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-20 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/kensche16/kensche16.html" target="_blank">kensche16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26578577" target="_blank">26578577</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">6</td>
        <td>MNase at 25h</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1616488" target="_blank">GSM1616488</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-25 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/kensche16/kensche16.html" target="_blank">kensche16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26578577" target="_blank">26578577</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">7</td>
        <td>MNase at 30h</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1616489" target="_blank">GSM1616489</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-30 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/kensche16/kensche16.html" target="_blank">kensche16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26578577" target="_blank">26578577</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">8</td>
        <td>MNase at 35h</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1616490" target="_blank">GSM1616490</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-35 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/kensche16/kensche16.html" target="_blank">kensche16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26578577" target="_blank">26578577</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">9</td>
        <td>MNase at 40h</td>
        <td>centered MNase-seq tags</td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1616491" target="_blank">GSM1616491</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1616492" target="_blank">GSM1616492</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-40 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/kensche16/kensche16.html" target="_blank">kensche16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26578577" target="_blank">26578577</a></td>
</tr>
<tr>
        <td class="tracknum">10</td>
        <td>All CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE68982" target="_blank">GSE68982</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>all time points merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum">11</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE68982" target="_blank">GSE68982</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>all time points merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="composite" colspan="12"><span class="composite">track subset: </span><i>CAGE tags at various time points</i></td>
</tr>
<tr>
        <td class="tracknum subtrack">12</td>
        <td>CAGE at 2h (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689659" target="_blank">GSM1689659</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689665" target="_blank">GSM1689665</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-2 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">13</td>
        <td>CAGE at 10h (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689660" target="_blank">GSM1689660</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689666" target="_blank">GSM1689666</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-10 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">14</td>
        <td>CAGE at 18h (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689661" target="_blank">GSM1689661</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689667" target="_blank">GSM1689667</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-18 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">15</td>
        <td>CAGE at 26h (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689662" target="_blank">GSM1689662</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689668" target="_blank">GSM1689668</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-26 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">16</td>
        <td>CAGE at 34h (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689663" target="_blank">GSM1689663</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689669" target="_blank">GSM1689669</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-34 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">17</td>
        <td>CAGE at 42h (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689664" target="_blank">GSM1689664</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689670" target="_blank">GSM1689670</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-42 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">18</td>
        <td>CAGE at 2h (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689659" target="_blank">GSM1689659</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689665" target="_blank">GSM1689665</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-2 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">19</td>
        <td>CAGE at 10h (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689660" target="_blank">GSM1689660</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689666" target="_blank">GSM1689666</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-10 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">20</td>
        <td>CAGE at 18h (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689661" target="_blank">GSM1689661</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689667" target="_blank">GSM1689667</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-18 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">21</td>
        <td>CAGE at 26h (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689662" target="_blank">GSM1689662</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689668" target="_blank">GSM1689668</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-26 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">22</td>
        <td>CAGE at 34h (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689663" target="_blank">GSM1689663</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689669" target="_blank">GSM1689669</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-34 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">23</td>
        <td>CAGE at 42h (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689664" target="_blank">GSM1689664</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1689670" target="_blank">GSM1689670</a>
        </td>
        <td>BEDGRAPH</td>
        <td><span class="epd-small">n/a</span></td>
        <td>IDC-42 h</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/adjalley16/adjalley16.html" target="_blank">adjalley16</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/26947071" target="_blank">26947071</a></td>
</tr>
<tr>
        <td class="tracknum">24</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 001</td>
        <td>1<sup>b</sup></td>
        <td><span class="epd-small">n/a</span><sup>c</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/pfa2/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
<tr>
        <td class="tracknum">25</td>
        <td>GC content (&#37;)</td>
        <td>GC content in a 20-bp window</td>
        <td>5<sup>d</sup></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><span class="epd-small">n/a</span></td><td><span class="epd-small">n/a</span></td><tr>
        <td class="tracknum">26</td>
        <td>RefSeq genes</td>
        <td>RefSeq gene annotation</td>
        <td>1</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://ftp.ncbi.nlm.nih.gov//genomes/all/GCF/000/002/765/GCF_000002765.4_ASM276v2/GCF_000002765.4_ASM276v2_genomic.gff.gz" target="_blank">ftp.ncbi.n...</a>
        </td>
        <td>GFF</td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/22121212" target="_blank">22121212</a></td>
</tr>
</tbody>
</table>

<footer><i>IDC</i>, intraerythrocytic developmental cycle<br /><sup>a</sup>the midpoint between paired-end fragments was calculated<br /><sup>b</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>c</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /><sup>d</sup>GC content is computed every 5 bp with a 20-bp window<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>