<?php include("url_extern.php"); ?>

<h2>Promoter Selection and Analysis tools</h2>
<p>
  Various tools allow you to analyse promoters from EPD and/or to
  select subsets of promoters. In order to analyze the complete EPD
  promoter set, go directly to one of the analysis pages. If you
  prefer to first select a subset of promoters, go to one of the
  selection pages. From the output of the selection pages you can then
  directly navigate to one of the analyses pages, or you can continue
  with another selection page to refine your promoter selection.
</p>

  <table border=1 cellpadding=5 align=center>
    <tr>
      <td valign=top><b>Selection tools</b>
	<ul>
	  <li>
	    <a href="/miniepd/EPDnew_select.php">EPD
	    selection tool</a>: Promoter subset selection based on
	    EPD-supplied annotation.
	  </li>
	  <li><a
      href="<?php echo $url_chipseq; ?>/chip_cor.php?series=<?php if($noncoding) echo "epd-nc"; else echo "epdnew"; ?>&species=<?php echo "$assembly"; ?>&strand=oriented">
	  ChIP-Cor</a>: Promoter subset selection based on
	  experimental data or genome annotations residing in the MGA
	  repository. Example: select promoters that have more than
	  100 H3K4me3 ChIP-seq tags data between -100 and +100
	  relative to the TSS.
	  </li>
	  <li><a
	  href="<?php echo $url_ssa; ?>/findm.php?series=<?php if($noncoding) echo "epd-nc"; else echo "epdnew"; ?>&species=<?php echo "$assembly"; ?>">
	  FindM</a>: Promoter subset selection based on DNA motif
	  occurrences.  Example: select promoters that have (or do not have)
          a c-Myc binding site between -100 and +100 relative to
	  the TSS.
	  </li>
	</ul>
    </td>
    </tr>
    <tr>
      <td valign=top><b>Analysis tools</b>
	<ul>
	  <li>
	    <a
	    href="<?php echo $url_chipseq; ?>/chip_cor.php?series=<?php if($noncoding) echo "epd-nc"; else echo "epdnew"; ?>&species=<?php echo "$assembly"; ?>&strand=oriented">
	      ChIP-Cor
	    </a>
	    : Generation of an aggregation plot (feature
	    correlation plot) for a specific chromatin of genome
	    annotation features. Example: Distribution of nucleosomes
	    (MNase-seq tags) near promoters,
	    <i>
	      e.g.  from -1000 to +1000 relative to the TSS.
	    </i>
	  </li>
	  <li>
	    <a href="<?php echo $url_chipseq; ?>/chip_extract.php?series=<?php if($noncoding) echo "epd-nc"; else echo "epdnew"; ?>&species=<?php echo "$assembly"; ?>&strand=oriented">
	      ChIP-Extract </a>: Extraction of
	      specific chromatin features around each promoter in
	      table format. The output is a table with rows
	      representing each promoter and columns the feature
	      tag occurrence at a specific distance. Example:
	      Distribution of nucleosomes (MNase-seq tags) near
	      each promoter, <i>e.g.  from -1000 to +1000 relative
	      to the TSS</i>. Useful for downstream analysis in R,
	      for example to classify promoters according to
	      differences in feature distribution.
	  </li>
	  <li>
	    <a href="<?php echo $url_ssa; ?>/oprof.php?series=<?php if($noncoding) echo "epd-nc"; else echo "epdnew"; ?>&species=<?php echo "$assembly"; ?>">
	      OProf
	    </a>
	    : Generate a motif occurrence profile around
	    TSS positions. Example: Generate a plot showing the
	    occurrence frequency of TATA boxes between -100 to +100
	    relative to the TSS.
	  </li>
	  <li>
	    <a
		href="<?php echo $url_ssa; ?>/findm.php?series=<?php if($noncoding) echo "epd-nc"; else echo "epdnew"; ?>&species=<?php echo "$assembly"; ?>">
	      FindM
	    </a>
	    : Extract DNA motif positions near transcription start
	    sites.  Example: extract coordinates of CCAAT boxes
	    located between -150 and -50 relative to a TSS. The output
	    is a set of CCAAT-box positions that can be further analyzed
	    in the same way as a set of TSS positions.
	  </li>
	</ul>
      </td>
    </tr>
    <tr>
      <td>
      How-To Documentation: <a target="_blank"
      href="/miniepd/documents/oprof/oprofQuickGuide.php">
      OProf</a>, <a target="_blank"
      href="/miniepd/documents/findm/findmQuickGuide.php">
      FindM</a> and <a target="_blank"
      href="/miniepd/documents/chip-cor/chipcorQuickGuide.php">
      ChIP-Cor</a>.
      </td>
    </tr>
  </table>
