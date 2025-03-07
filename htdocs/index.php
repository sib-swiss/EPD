<?php include("header.php"); ?>

<!-- News statement at the top of the page -->
<div class="news" style="border-style:solid; border-width:1px; border-color:darkgrey; padding:5px">
<table style="width:100%">
<tr>
<td style="font-size:14px; vertical-align:text-top" colspan="2">
   <a href="/miniepd/news.php">See all news</a>
</td>
</tr>
<?php
    echo file_get_contents("http://localhost:8081/miniepd/lastnews.php?query=EPD");
?>
</table>
</div>

<p>
This resource allows the access to several databases of experimentally
validated promoters: EPD and EPDnew databases. They differ by the
validation technique used and the coverage. EPD is a collection of
eukaryotic promoters derived from published articles. Instead, the
EPDnew databases (HT-EPD) are the result of merging EPD promoters
with in-house analysis of promoter-specific high-throughput data for
selected organisms only. This process gives EPDnew <a target="_blank" rel="noopener" href="https://doi.org/10.1093/nar/gks1233">high
precision and high coverage</a>.
</p>
<p style="margin-top:1cm">
<table>
  <tr>
    <td>
      </td>
      <td>
      <td rowspan="4" style='padding-bottom:20px; padding-left:10px'>
      <a
      href="/miniepd/EPDnew_database.php"><strong>EPDnew</strong></a>
      is a collection of databases of experimentally validated promoters
      for selected model organisms.
      Evidence comes from TSS-mapping from high-throughput
      experiments such as CAGE and Oligocapping. The resulting
      databases are the following:
  <ul>
  <li>Animals:
    <ul>
  <li><b><i>Homo sapiens</i></b>: <b> <?php echo
      count(file("ftp/epdnew/human/current/Hs_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Macaca mulatta</i></b>: <b><?php echo
      count(file("ftp/epdnew/M_mulatta/current/Rm_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Mus musculus</i></b>: <b><?php echo
      count(file("ftp/epdnew/mouse/current/Mm_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Rattus norvegicus</i></b>: <b><?php echo
      count(file("ftp/epdnew/R_norvegicus/current/Rn_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Gallus gallus</i></b>: <b><?php echo
      count(file("ftp/epdnew/G_gallus/current/Gg_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Canis familiaris</i></b>: <b><?php echo
      count(file("ftp/epdnew/C_familiaris/current/Cf_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Drosophila melanogaster</i></b>: <b><?php echo
      count(file("ftp/epdnew/drosophila/current/Dm_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Apis mellifera</i></b>: <b><?php echo
      count(file("ftp/epdnew/A_mellifera/current/Am_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Danio rerio</i></b>: <b><?php echo
      count(file("ftp/epdnew/zebrafish/current/Dr_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Caenorhabditis elegans</i></b>: <b><?php echo
      count(file("ftp/epdnew/worm/current/Ce_EPDnew.fps"));?></b>
      promoters;</li>
    </ul>
  </li>
  <li>Plants:
    <ul>
    <li><b><i>Arabidopsis thaliana</i></b>: <b><?php echo
      count(file("ftp/epdnew/arabidopsis/current/At_EPDnew.fps"));?></b>
      promoters;</li>
    <li><b><i>Zea mays</i></b>: <b><?php echo
      count(file("ftp/epdnew/Z_mays/current/Zm_EPDnew.fps"));?></b>
      promoters;</li>
    </ul>
  </li>
  <li>Fungi:
    <ul>
    <li><b><i>Saccharomyces cerevisiae</i></b>: <b><?php echo
      count(file("ftp/epdnew/S_cerevisiae/current/Sc_EPDnew.fps"));?></b>
      promoters,</li>
  <li><b><i>Schizosaccharomyces pombe</i></b>: <b><?php echo
      count(file("ftp/epdnew/S_pombe/current/Sp_EPDnew.fps"));?></b>
      promoters;</li>
    </ul>
  </li>
  <li>Invertebrates:
    <ul>
    <li><b><i>Plasmodium falciparum</i></b>: <b><?php echo
      count(file("ftp/epdnew/P_falciparum/current/Pf_EPDnew.fps"));?></b>
      promoters.</li>
    </ul>
  </li>
  </ul>
  </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td></td>
    <td></td>
  </tr>
    <tr style='border-bottom:2pt solid black;padding-bottom:20px'>
    <td style='padding-bottom:20px'></td>
    <td style='padding-bottom:20px'></td>
  </tr>
  <tr>
    <td colspan="3" style="padding-top:20px;padding-left:10px;padding-right:10px"><strong>The
    Eukaryotic Promoter Database</strong> is an annotated non-redundant
    collection of eukaryotic POL II promoters, for which the
    transcription start site has been determined
    experimentally. Access to promoter sequences is provided by
    pointers to positions in nucleotide sequence entries. The
    annotation part of an entry includes description of the initiation
    site mapping data, cross-references to other databases, and
    bibliographic references. EPD is structured in a way that
    facilitates dynamic extraction of biologically meaningful promoter
    subsets for comparative sequence analysis.  This database contains
    <b><?php system("grep -c '^ID' ftp/epd/current/epd.dat");?>
    promoters from several species</b>.</td>
  </tr>

</table>

<div style='border-style:solid;border-width:1px;border-color:darkgrey;padding:3px;margin-top:0.5cm' >

    Latest research from us that uses EPD:<br><br>

    <a target='_blank' rel="noopener"
    href='https://doi.org/10.1371/journal.pcbi.1009256'>
    Computational identification and experimental characterization of
    preferred downstream positions in human core promoters.</a>
    Dreos R, Sloutskin A, Malachi N, Ideses D, Bucher P, Juven-Gershon T.
    PLoS Comput Biol. 2021 Aug 12;17(8):e1009256.
    doi: 10.1371/journal.pcbi.1009256; PMID: <a
    href='https://www.ncbi.nlm.nih.gov/pubmed/34383743'
    target='_blank' rel="noopener">34383743</a>
    <br><br>
    <a target='_blank' rel="noopener"
    href='https://dx.doi.org/10.1371/journal.pcbi.1005144'>Influence
    of Rotational Nucleosome Positioning on Transcription Start Site
    Selection in Animal Promoters.</a> Dreos, R., Ambrosini, G.,
    Bucher, P. PLOS Comp Biol (2016) doi:
    10.1371/journal.pcbi.1005144; PMID: <a
    href='https://www.ncbi.nlm.nih.gov/pubmed/27716823'
    target='_blank' rel="noopener">27716823</a>
  </div>

<p>Please cite us using the following references:</p>

<p>EPDnew database description:<br />
   <a target='_blank' rel="noopener"
   href='https://doi.org/10.1093/nar/gkz1014'>
   EPD in 2020: enhanced data visualization and extension to ncRNA promoters.</a>
   Meylan P, Dreos R, Ambrosini G, Groux R, Bucher P.
   Nucleic Acids Res. 2020 Jan 8;48(D1):D65-D69.
   doi: 10.1093/nar/gkz1014; PMID:
   <a href='https://www.ncbi.nlm.nih.gov/pubmed/31680159' target='_blank' rel="noopener">31680159</a>.
</p>
<p>Promoters analysis tools:<br />
<a target='_blank' rel="noopener" href='https://doi.org/10.1093/nar/gku1111'>The Eukaryotic Promoter Database: expansion of EPDnew and new promoter analysis tools.</a> Dreos, R., Ambrosini, G., P&eacute;rier, R., Bucher, P. Nucleic Acids Res. (2014) doi: 10.1093/nar/gku1111; PMID: <a href='https://www.ncbi.nlm.nih.gov/pubmed/25378343' target='_blank' rel="noopener">25378343</a>
</p>


<!-- ######### Insert the footer #########-->
<?php readfile("footer.html"); ?>

</body>
</html>
