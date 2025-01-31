<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("header.php"); ?>

<table width="100%" frame="box">
  <tr style="background-color:#CEE3F6;">
    <td>
      <h1>EPDnew databases</h1>
    </td>
  </tr>

  <tr>
    <td>
      <B>EPDnew</B> is a set of species-specific databases of
      experimentally validated promoters. Currently, 15 organisms are supported:
      10 animals (<i>H. sapiens</i>, <i>M. mulatta</i>, <i>M. musculus</i>,
      <i>R. norvegicus</i>, <i>G. gallus</i>, <i>C. familiaris</i>, <i>D. melanogaster</i>,
      <i>A. mellifera</i>, <i>C. elegans</i> and <i>D. rerio</i>), 2
      plants (<i>A. thaliana</i> and <i>Z. mays</i>), 2 fungi
      (<i>S. cerevisiae</i> and <i>S. pombe</i>) and 1 invertebrate (<i>P. falciparum</i>).
      Evidence comes from TSS mapping data generated from high-throughput experiments such as CAGE
      and Oligocapping.
    </td>
  </tr>

  <tr>
    <td>
      The number of promoters for each organism is the following:
      <ul>
	<li>
	  Animals:
	  <ul>
	    <li>
	      <b><i>Homo sapiens</i></b>: <b> <?php echo
	      count(file("ftp/epdnew/human/current/Hs_EPDnew.fps"));?></b>
	      promoters,
	    </li>
	  <li>
	    <b><i>Macaca mulatta</i></b>: <b><?php echo
	    count(file("ftp/epdnew/M_mulatta/current/Rm_EPDnew.fps"));?></b>
	    promoters,
	  </li>
	  <li>
	    <b><i>Mus musculus</i></b>: <b><?php echo
	    count(file("ftp/epdnew/mouse/current/Mm_EPDnew.fps"));?></b>
	    promoters,
	  </li>
	  <li>
	    <b><i>Rattus norvegicus</i></b>: <b><?php echo
	    count(file("ftp/epdnew/R_norvegicus/current/Rn_EPDnew.fps"));?></b>
	    promoters,
	  </li>
	  <li>
	    <b><i>Gallus gallus</i></b>: <b><?php echo
	    count(file("ftp/epdnew/G_gallus/current/Gg_EPDnew.fps"));?></b>
	    promoters,
	  </li>
	  <li>
	    <b><i>Canis familiaris</i></b>: <b><?php echo
	    count(file("ftp/epdnew/C_familiaris/current/Cf_EPDnew.fps"));?></b>
	    promoters,
	  </li>
	  <li>
	    <b><i>Drosophila melanogaster</i></b>: <b><?php echo
	    count(file("ftp/epdnew/drosophila/current/Dm_EPDnew.fps"));?></b>
	    promoters,
	  </li>
	  <li>
	    <b><i>Apis mellifera</i></b>: <b><?php echo
	    count(file("ftp/epdnew/A_mellifera/current/Am_EPDnew.fps"));?></b>
	    promoters,
	  </li>
	  <li>
	    <b><i>Danio rerio</i></b>: <b><?php echo
	    count(file("ftp/epdnew/zebrafish/current/Dr_EPDnew.fps"));?></b>
	    promoters,
	  </li>
	  <li>
	    <b><i>Caenorhabditis elegans</i></b>: <b><?php echo
	    count(file("ftp/epdnew/worm/current/Ce_EPDnew.fps"));?></b>
	    promoters;
	  </li>
	  </ul>
	</li>
	<li>
	  Plants:
	  <ul>
	    <li>
	      <b><i>Arabidopsis thaliana</i></b>: <b><?php echo
	      count(file("ftp/epdnew/arabidopsis/current/At_EPDnew.fps"));?></b>
	      promoters;
	    </li>
	    <li>
	      <b><i>Zea mays</i></b>: <b><?php echo
	      count(file("ftp/epdnew/Z_mays/current/Zm_EPDnew.fps"));?></b>
	      promoters;
	    </li>
	  </ul>
	</li>
	<li>
	  Fungi:
	  <ul>
	    <li>
	      <b><i>Saccharomyces cerevisiae</i></b>: <b><?php echo
	      count(file("ftp/epdnew/S_cerevisiae/current/Sc_EPDnew.fps"));?></b>
	      promoters,
	    </li>
	    <li>
	      <b><i>Schizosaccharomyces pombe</i></b>: <b><?php echo
	      count(file("ftp/epdnew/S_pombe/current/Sp_EPDnew.fps"));?></b>
	      promoters.
	    </li>
	  </ul>
	</li>

	<li>
          Invertebrates:
          <ul>
            <li>
              <b><i>Plasmodium falciparum</i></b>: <b><?php echo
              count(file("ftp/epdnew/P_falciparum/current/Pf_EPDnew.fps"));?></b>
              promoters.
            </li>
          </ul>
        </li>
      </ul>
    </td>
  </tr>
</table>

<p>
</p>

<table width="100%" frame="box">
<tr style="background-color:#CEE3F6;">
  <td>
    <h1>Collection accessibility</h1>
  </td>
</tr>

<tr>
  <td>
    EPDnew databases are accessible in different ways:
    <ul>
    <li>using the input form in the header, searching
    for single gene symbol, gene
    description or ENSEMBL/RefSeq gene IDs,
    </li>
    <li>using the <a href="/miniepd/EPDnew_select.php">Select / Download
    tool</a> for searching multiple EPDnew IDs, ENSEMBL/RefSeq gene
    IDs and/or for selecting promoters based on their genomic context
    (core promoter elements, CpG island, expression, etc.) and
    downloading them in various formats (SGA, BED, sequences) or
    </li>
    <li>through an <a href="/ftp/">FTP website</a>
    for bulk downloads.
   </li></ul>
  </td>
</tr>
</table>

<p>
</p>

<table width="100%" frame="box">
<tr style="background-color:#CEE3F6;">
  <td>
    <h1>Viewer Page</h1>
  </td>
</tr>

<tr>
  <td>
    The viewer page contains information about a single entry in the
    database and provides various tools for the analysis of a promoter
    region. It is divided into several sections, each devoted to a
    single task.
  </td>
</tr>
<tr>
  <td>
    <div id='generalInformation'>
      <H2>General Information</H2>
      This section provides information for the entry:
      <ul>
	<li>
	  <b>Promoter ID</b>: internal EPDnew unique promoter ID. It
	  is composed of two parts separated by an underscore symbol
	  ('_'). In general, the first part is the gene symbol/ID
          associated with the promoter; the second part is a number
	  indicating the hierarchy of promoter usage for that
	  gene. For genes with multiple promoters, the "_1"
	  marks the promoter with the highest usage (primary promoter)
	  and is followed by all the others in decreasing order of
	  usage.
	</li>
	<li>
	  <b>Promoter type</b>: three types of promoters are
	  distinguished, reflecting the variety of transcription initiation
          patterns in Eukaryotes. They are based on the Dispersion Index
          (a statistic defined in <a href="https://dx.doi.org/10.1371/journal.pcbi.1005144" target='_blank'>Dreos et al., 2016</a> that is conceptually
	  similar to the standard deviation of the observed
	  initiation sites around the annotated TSS) and are defined as
	  follows:
	  <ul>
	    <li>
	      Single initiation site: dispersion index value between
	      0 and 3;
	    </li>
	    <li>
	      Multiple initiation sites: dispersion index value
	      between 3 and 10;
	    </li>
	    <li>
	      Initiation region: dispersion index value &gt; 10;
	    </li>
	  </ul>
	</li>
	<li>
	  <b>Organism</b>: scientific and common name of the organism
	</li>
	<li>
	  <b>Gene Symbol</b>: short unique symbol that identifies the
	  gene
	</li>
	<li>
	  <b>Description of the gene</b>: short description of the
	  gene
	</li>
	<li>
	  <b>Sequence</b>: short sequence segment corresponding to the
	  -49 to +10 region of the promoter. Transcribed and
	  untranscribed nucleotides are represented by upper and lower
	  case characters, respectively. This data is not meant to
	  provide sequence data but serves as a control string for
	  sequence extraction.
	</li>
	<li>
	  <b>Position in the genome</b>: a eukaryotic promoter is
	  defined as a DNA sequence around a transcription initiation
	  site. The position reference to the initiation site is
	  therefore the central part of a promoter entry. Its
	  assignment is based directly on experimental data. A
	  transcription initiation site may be reassigned upon
	  analysis of new data (new database version). Chromosomes are
	  defined by NCBI Reference Sequence (RefSeq) IDs.
	</li>
	<li>
	  <b>References</b>: references to external databases that
	  provide additional information on the Gene or Transcript.
          These are often species-specific.
	</li>
      </ul>
    </div>

    <div id='promoterImage'>
      <H2>Promoter Image</H2>

      This section provides visual information about the genomic
      context of a promoter. The image is derived from the UCSC
      Genome Browser and can be reproduced by loading the EPDnew hub.
      It is designed to help scientists judge the quality of the
      annotated promoter.
      <p>
	This is an example of a promoter image from the human promoter
	<a href="/cgi-bin/miniepd/get_doc?db=hgEpdNew&format=genome&entry=MAPK1_1">MAPK1_1</a>:
      </p>
      <img src="/miniepd/epdnew/gif/Homo_sapiens/MAPK1_1.png" alt="MAPK1_1" style="width:800px" />
      <p>
	The image is conceptually divided into three sections:
	<ul>
	  <li>
	    Experimental evidence of the promoter activity in the form
	    of histone modifications (H3K4me3 and H3K4me1), RNA polymerase
            II and RNA-seq of 5'-end mapping techniques (CAGE, GRO-cap,
	    etc). Care is taken to represent each track in an optional
	    fashion. For instance, different bin sizes are used to
	    convert different ChIP-seq datasets into wiggle files,
	    taking into account their variation in tag density in
	    promoter regions. To visualize the nucleosome architecture
	    of promoters, we exclusively selected ChIP-Seq data
	    generated with MNase digestion rather than sonication, as
	    only the former type of data achieves single-nucleosome
	    resolution. Importantly, the RNA-seq tracks are at single
	    base-pair resolution and display all experimental evidence
	    that has been used for defining the reference TSS position
	    (All CAGE tracks) and a selection of representative cell
	    types or tissues in a composite track.
	  </li>
	  <li>
	    Annotation tracks for Genes and EPDnew promoters. The
	    EPDnew track is a representation of the sequence provided
	    in the 'General Information' section. The narrow segment
	    represents the promoter section from base -49 to -1
	    whereas the thick section represents the region 0 to
	    10. The Gene track corresponds to the annotation used
	    during the <a
	    href='/miniepd/epdnew/documents/Hs_epdnew_006_pipeline.php'>
	    first step of making an EPDnew database</a>.
	  </li>
	  <li>
	    Sequence-derived tracks such as CpG islands, conserved
	    transcription factor binding sites and conservation
	    scores.
	  </li>
	</ul>
	Note that depending on the organism, some experimental and / or
	sequence-derived data might be missing.
      </p>

    </div>

    <div id='sequenceRetrievalTool'>
      <h2>Sequence Retrieval Tool</h2>
      The sequence retrieval tool allows the extraction of sequence of
      any length around the annotated promoter. To extract a sequence,
      simply select the sequence range (in base pair) and click 'GET
      SEQUENCE'. The option 'lower case upstream TSS' outputs
      lowercase letters in the upstream region to facilitate the
      identification of the TSS within the sequence (the first
      uppercase letter in the sequence represents the TSS).
    </div>

    <div id='searchMotifTool'>
      <H2>Search Motif Tool</H2>

      The search motif tool scans promoter regions with position
      weight matrices (PWM) of several transcription factors and core
      promoter elements to find putative binding sites. Once a PWM
      library and TF have been selected, it is possible to scan the
      region with that PWM. Hits are marked as red rectangles in the
      plot and exact positions relative to the TSS are reported below
      the plot. Motif libraries are from the <a target="_blank"
      href="<?php echo $url_pwmtools; ?>/pwmlib.html">JASPAR
      database</a> and the <a href='/miniepd/promoter_elements.php'>EPD
      Promoter Elements</a> and can be downloaded as text file <a
      href='<?php echo $url_ftp; ?>/pwmlib/' target='_blank'>here</a>. A
      description of the motifs and the conversion rules can be found
      in our <a href='<?php echo $url_pwmtools; ?>/pwmlib.html'
      target='_blank'>Motif Database homepage</a>. The scan is performed
      on-the-fly using the <a href='<?php echo $url_ssa; ?>/findm.php'>
      FindM</a> tool from the SSA toolkit.

    </div>

    <div id='expressionProfileTool'>
      <H2>Expression Profile Tool</H2>

      The expression profile tool shows the number of samples in which
      the promoter is active, its average expression level (number of
      tags in a 100-bp region centered on the TSS and normalized to 10M
      total tags) and a plot showing the distribution of
      sample-specific TSSs around the annotated TSS. Clicking on the
      histogram bars will show the number of samples that have the TSS
      located in that position (relative to the EPDnew annotated TSS)
      with their names and expression values.

    </div>

    <div id='externalResources'>
      <H2>External Resources</H2>

      Links to external genome browsers.

    </div>

  </td>
</tr>
</table>

<p>
</p>

<table width="100%" frame="box">
<tr style="background-color:#CEE3F6;">
  <td>
    <h1>References</h1>
  </td>
</tr>

<tr>
  <td>
    <a
    href="https://doi.org/10.1093/nar/gkw1069"
    target="_blank">The eukaryotic promoter database in its 30th year: focus on non-vertebrate organisms.</a> Dreos, R., Ambrosini,
    G., Groux, R., P&eacute;rier, R., Bucher, P. Nucleic Acids Res. (2017)
    45:D51-55; PUBMED&nbsp; <a
    href="https://www.ncbi.nlm.nih.gov/pubmed/27899657"
    target="_blank">27899657</a>
  </td>
</tr>
</table>

<!-- ######### Insert the footer #########-->
<?php readfile("footer.html"); ?>

</body>
</html>
