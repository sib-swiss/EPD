<?php include("../header.php"); ?>

<h1>EPD viewer for <i>D. rerio</i> (July 2010 Zv9/danRer7), version 001</h1>

<p>The <a href="https://genome-euro.ucsc.edu/cgi-bin/hgTracks?&hubUrl=https://epd.expasy.org/epd/ucsc/epdHub/epdHub.txt&hgS_doLoadUrl=submit&hgS_loadUrlName=https://epd.expasy.org/epd/ucsc/epdHub/epd_danRer7_viewer.txt&db=danRer7<?php rtrim(readfile("../ucsc/session_options.conf"));?>" target="_blank">EPD viewer</a> for <i>D. rerio</i> is made of the tracks given in the table below.
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
        <td>MNase (256-cell)</td>
        <td>centered MNase-seq tags<sup>a</sup></td>
        <td>25</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE44269" target="_blank">GSE44269</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>256-cell embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/zhang14/zhang14.html" target="_blank">zhang14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24285721" target="_blank">24285721</a></td>
</tr>
<tr>
        <td class="tracknum">2</td>
        <td>MNase (dome)</td>
        <td>centered MNase-seq tags<sup>a</sup></td>
        <td>25</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE44269" target="_blank">GSE44269</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>dome</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/zhang14/zhang14.html" target="_blank">zhang14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24285721" target="_blank">24285721</a></td>
</tr>
<tr>
        <td class="tracknum">3</td>
        <td>Dome H3K4me3</td>
        <td>centered H3K4me3 ChIP-seq tags<sup>b</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1081556" target="_blank">GSM1081556</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>dome</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/zhang14/zhang14.html" target="_blank">zhang14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24285721" target="_blank">24285721</a></td>
</tr>
<tr>
        <td class="tracknum">4</td>
        <td>Dome Pol2</td>
        <td>centered RNA Pol II ChIP-seq tags<sup>c</sup></td>
        <td>10</td>
        <td><span class="epd-small">n/a</span></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1081560" target="_blank">GSM1081560</a>, <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSM1081559" target="_blank">GSM1081559</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>dome</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/zhang14/zhang14.html" target="_blank">zhang14</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24285721" target="_blank">24285721</a></td>
</tr>
<tr>
        <td class="tracknum">5</td>
        <td>All CAGE (+)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP013950" target="_blank">SRP013950</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>all stages merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="composite" colspan="12"><span class="composite">track subset: </span><i>CAGE reads at various stages</i></td>
</tr>
<tr>
        <td class="tracknum subtrack">6</td>
        <td>(+) Unfert. Egg</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156307/" target="_blank">SRX156307</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>unfertilized egg</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">7</td>
        <td>(+) Fert. Egg</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156325/" target="_blank">SRX156325</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>fertilized egg</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">8</td>
        <td>(+) 64 Cell Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156334/" target="_blank">SRX156334</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>64-cell embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">9</td>
        <td>(+) 512 Cell Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156336/" target="_blank">SRX156336</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>512-cell embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">10</td>
        <td>(+) High Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156337/" target="_blank">SRX156337</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>high embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">11</td>
        <td>(+) Oblong Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156338/" target="_blank">SRX156338</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>oblong embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">12</td>
        <td>(+) Sphere Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156347/" target="_blank">SRX156347</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>sphere/dome embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">13</td>
        <td>(+) Dome 30 Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156349/" target="_blank">SRX156349</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>dome/30&#37; epiboly</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">14</td>
        <td>(+) Shield Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156350/" target="_blank">SRX156350</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>shield embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">15</td>
        <td>(+) 14 Somites Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156352/" target="_blank">SRX156352</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>14-somite embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">16</td>
        <td>(+) Prim-6 Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156355/" target="_blank">SRX156355</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>prim-6 embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">17</td>
        <td>(+) Prim-20 Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&plus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156356/" target="_blank">SRX156356</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>prim-20 embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">18</td>
        <td>(-) Unfert. Egg</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156307/" target="_blank">SRX156307</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>unfertilized egg</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">19</td>
        <td>(-) Fert. Egg</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156325/" target="_blank">SRX156325</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>fertilized egg</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">20</td>
        <td>(-) 64 Cell Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156334/" target="_blank">SRX156334</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>64-cell embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">21</td>
        <td>(-) 512 Cell Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156336/" target="_blank">SRX156336</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>512-cell embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">22</td>
        <td>(-) High Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156337/" target="_blank">SRX156337</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>high embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">23</td>
        <td>(-) Oblong Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156338/" target="_blank">SRX156338</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>oblong embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">24</td>
        <td>(-) Sphere Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156347/" target="_blank">SRX156347</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>sphere/dome embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">25</td>
        <td>(-) Dome 30 Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156349/" target="_blank">SRX156349</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>dome/30&#37; epiboly</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">26</td>
        <td>(-) Shield Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156350/" target="_blank">SRX156350</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>shield embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">27</td>
        <td>(-) 14 Somites Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156352/" target="_blank">SRX156352</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>14-somite embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">28</td>
        <td>(-) Prim-6 Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156355/" target="_blank">SRX156355</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>prim-6 embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum subtrack">29</td>
        <td>(-) Prim-20 Em.</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://www.ncbi.nlm.nih.gov/sra/SRX156356/" target="_blank">SRX156356</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>prim-20 embryo</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum">30</td>
        <td>All CAGE (-)</td>
        <td>5&prime; end of CAGE reads</td>
        <td>1</td>
        <td>&minus;</td>
        <td><a href="https://trace.ncbi.nlm.nih.gov/Traces/sra/?study=SRP013950" target="_blank">SRP013950</a>
        </td>
        <td>SRA</td>
        <td><span class="epd-small">n/a</span></td>
        <td>all stages merged</td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/nepal13/nepal13.html" target="_blank">nepal13</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/24002785" target="_blank">24002785</a></td>
</tr>
<tr>
        <td class="tracknum">31</td>
        <td>EPDnew promoters</td>
        <td>EPDnew promoters v. 001</td>
        <td>1<sup>d</sup></td>
        <td><span class="epd-small">n/a</span><sup>e</sup></td>
        <td><span class="epd-small">n/a</span>
        </td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td>
        <td><span class="epd-small">n/a</span></td><td><a href="<?php echo $url_ftp; ?>/mga/danRer7/epd/epd.html" target="_blank">epd</a></td>
        <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273" target="_blank">23193273</a></td>
</tr>
</tbody>
</table>

<footer><sup>a</sup>tags were centered by 75 bp (ends were shifted 75 bp downstream or upstream if on the &plus; or &minus; strand respectively)<br /><sup>b</sup>tags were centered by 80 bp<br /><sup>c</sup>tags were centered by 35 bp<br /><sup>d</sup>the thick part represents the TSS plus the 10 bp downstream while the thin part represents the 49 bp upstream of the TSS<br /><sup>e</sup>promoters on the &plus; and &minus; strands are combined in a single track, with promoter orientation defined by the position of the thick part relative to the thin part<br /></footer>

<p>These tracks are available at <a href="https://genome-euro.ucsc.edu/cgi-bin/hgHubConnect" target="_blank">UCSC</a> as a public hub named "EPD Viewer Hub".</p>

<?php readfile("../footer.html"); ?>

</body>
</html>