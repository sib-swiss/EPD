<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->

<?php include("header.php"); ?>
<?php include("url_extern.php"); ?>

<form id='result' action="get_promoters.php" method="POST">
  <table style="width: 100%; border: 1px solid silver;">
    <tr style="background-color:#ccf2ff;">
      <td>
	<h1>Select / Download tool</h1>
      </td>
    </tr>

    <tr><td style="padding-top: 8px;">
      Use this tool to <b>select</b> promoters based
      on promoter name / ID, genomic context
      (such as presence of core promoter elements) or
      expression level. After selection, you can
      <b>download</b> them in various formats (e.g. FASTA, BED, etc.),
      <b>liftOver</b> them to a different assembly or use them
      to perform <b>further analysis</b> such
      as motif enrichment/search and chromatin status.
    </td></tr>

    <tr>
      <td style="vertical-align:middle">
	<p>
	  <b>Database</b>
        <select onchange="IDchanged()" id="select_db" name="select_db" class="epddownload">
            <optgroup label="EPDnew - Animals">
                <option value="human">H. sapiens</option>
                <option value="human_nc">H. sapiens non-coding</option>
                <option value="M_mulatta">M. mulatta</option>
                <option value="mouse">M. musculus</option>
                <option value="mouse_nc">M. musculus non-coding</option>
    	        <option value="R_norvegicus">R. norvegicus</option>
    	        <option value="C_familiaris">C. familiaris</option>
                <option value="G_gallus">G. gallus</option>
                <option value="drosophila">D. melanogaster</option>
                <option value="A_mellifera">A. mellifera</option>
                <option value="zebrafish">D. rerio</option>
                <option value="worm">C. elegans</option>
            </optgroup>
            <optgroup label="EPDnew - Plants">
    	        <option value="arabidopsis">A. thaliana</option>
        	    <option value="Z_mays">Z. mays</option>
        	    <option value="H_vulgare">H. vulgare</option>
	        </optgroup>
            <optgroup label="EPDnew - Fungi">
	            <option value="S_cerevisiae">S. cerevisiae</option>
	            <option value="S_pombe">S. pombe</option>
            </optgroup>
    	    <optgroup label="EPDnew - Invertebrates">
	            <option value="P_falciparum">P. falciparum</option>
	        </optgroup>
        </select>
    </p>
      </td>
    </tr>

    <tr><td>
        <b>Restrict the selection to the following IDs:</b>
    </td></tr>
    <tr><td style="vertical-align: middle; padding: 5px 5px 5px 20px;">
          <select title="Select ID type" id="idtype" name="idtype" class="epddownload" style="width:135px">
              <option value="epd" selected="selected">EPDnew ID</option>
              <option value="ensembl">ENSEMBL GENE ID</option>
              <option value="refseq">RefSeq ID</option>
              <!-- option value="symbol">Gene Symbol</option -->
          </select>
        </td></tr>

    <tr><td style="vertical-align:middle; padding: 5px 5px 5px 20px;">
        <textarea class="epd-input" name="ids" cols="32" rows="4" placeholder="Enter one ID per line"></textarea>
    </td></tr>

    <tr><td><p><b>Promoters with the following characteristics:</b></p></td></tr>

    <tbody id="tbody_motifs">
    <tr><td>&nbsp;</td></tr>
    </tbody>

    <tbody>
    <tr>
      <td style="vertical-align:middle; padding: 5px 5px 5px 20px;">
	<select  name="dispersionAND" class="epddownload" style="width: 54px;">
	  <option  value="AND" selected="selected">AND</option>
	  <option  value="OR">OR</option>
	</select>
	marked as
	<select  name="dispersion" class="epddownload" style="width: 68px">
	  <option  value="all" selected="selected"></option>
	  <option  value="single">single</option>
	  <option  value="region">region</option>
	  <option  value="multiple">multiple</option>
	</select>
      </td>
    </tr>

    <tr>
      <td style="vertical-align:middle; padding: 5px 5px 5px 20px;">
	<select  name="eAverageAND" class="epddownload" style="width: 54px;">
	  <option  value="AND" selected="selected">AND</option>
	  <option  value="OR">OR</option>
	</select>
	average expression of at least
	<INPUT type="text" name="eAverage" size="6" class="epddownload epd-input" />
	  tags
      </td>
    </tr>

    <tr>
      <td style="vertical-align:middle; padding: 5px 5px 5px 20px;">
	<select  name="eSamplesAND" class="epddownload" style="width: 54px;">
	  <option  value="AND" selected="selected">AND</option>
	  <option  value="OR">OR</option>
	</select>
	expressed in at least
	<INPUT type="text" name="eSamples" size="5" value="" class="epddownload epd-input" />
	samples
      </td>
    </tr>

    <tr><td><p><b>Additional options:</b></p></td></tr>

    <tr><td>
        <input type="checkbox" name="best" value="bestOnly" />
           Select only the most representative promoter for a gene
    </td></tr>
    </tbody>

    <tfoot>
    <tr>
      <td style="padding: 12px 20px">
    	  <button class="epdsubmit" type="submit" name="action" value="Select" style="padding: 2px 12px;">Select</button>
    	  <input type="hidden" name="database" id="database" value="epdnew" />
      </td>
    </tr>
    </tfoot>
  </table>
</form>

<p></p>

<table style="width: 100%; border: 1px solid silver;">
  <tr style="background-color:#ccf2ff;">
    <td>
      <h1>How to use it</h1>
    </td>
  </tr>
  <tr>
    <td>
      <p>
	This tool allows the selection of all or a subset of promoters
	from an EPDnew database. Selection can be restricted based on
	Promoter or Gene IDs, genomic context or other
	characteristics. Multiple criteria can be used at the same
	time, for example providing a set of Gene IDs and restricting the
	selection to promoters that contain a TATA box. Here is a
	description of the criteria used by each selection method.
      </p>
      <p>
	<b>Selection by ID:</b><br /> write one ID per line without
	the use of any symbols (',', ';', '|', etc.) to separate IDs.
        In the output page, promoters are always annotated using EPDnew
	IDs. To facilitate the conversion between user-provided IDs
	and EPDnew IDs, the output page provides a log file with the
	conversion table. Note that multiple promoters can be
	associated with one ID. Users can restrict the selection to only
	one promoter per gene by activating the check box, which will
	select the most representative promoter (see 'Additional
	Options'). IDs can be of the following types (some of them are
	species-specific):
	<ul>
	  <li>
	    <b>EPDnew ID:</b> promoter ID used here (MAPK1_1, TP53_1,
	    TBP_1, etc). It is available for all databases.
	  </li>
	  <li>
	    <b>ENSEMBL GENE ID:</b> gene ID from the Ensembl
	    database (ENSG00000002016, ENSG00000003509,
	    ENSG00000003989).
	  </li>
	  <li>
	    <b>RefSeq ID:</b> transcript ID from the RefSeq database
	    (NM_032974, NM_002355, NM_001013836).
	  </li>
	  <li>
	    <b>FlyBase ID:</b> ID from FlyBase annotation
	    (FBgn0025740, FBgn0039897, FBgn0039904)
	  </li>
	  <li>
	    <b>WormBase ID:</b> ID from WormBase annotation
	    (WBGene00022279, WBGene00022037, WBGene00022368)
	  </li>
	  <li>
	    <b>AGI ID:</b> Arabidopsis Gene ID (AT1G01010)
	  </li>
	  <li>
	    <b>Gramene GENE ID:</b> Gramene Gene ID (GRMZM2G330436,
	    GRMZM2G440537, GRMZM2G008710)
	  </li>
	  <li>
	    <b>sgdGene ID:</b> Saccharomyces Genome Database Gene ID
	    (YAL061W, YAL024C, YAL001C)
	  </li>
	  <li>
	    <b>PomBase ID:</b> S. pombe Genome Database Gene ID
	    (SPCP20C8.02c, SPCC330.04c, SPCC1235.07)
	  </li>

	</ul>
      </p>

      <p>
	<b>Selection by precomputed characteristics:</b><br />
	<ul>
	  <li>
	    <b>TATA box</b>: a promoter is <i>with</i> a <a
	    href="/miniepd/promoter_elements.php">TATA box</a>
	    if the motif is found at position &minus;28 (&plusmn; 3
	    bp) from the TSS (evaluated using <a
	    href="<?php echo $url_ssa; ?>/findm.php">FindM</a>).
	  </li>
	  <li>
	    <b>Initiator</b>: a promoter is <i>with</i> an <a
	    href="/miniepd/promoter_elements/init.php">Initiator
	    motif</a> if it is found at position 0 from the
	    TSS (evaluated using <a
	    href="<?php echo $url_ssa; ?>/findm.php">FindM</a>).
	  </li>
	  <li>
	    <b>CCAAT box</b>: a promoter is <i>with</i> a <a
	    href="/miniepd/promoter_elements/ccaat.php">CCAAT
	    motif</a> if it is found in the region &minus;200 to
	    &minus;50 from the TSS (evaluated using <a
	    href="<?php echo $url_ssa; ?>/findm.php">FindM</a>).
	  </li>
	  <li>
	    <b>GC box</b>: a promoter is <i>with</i> a <a
	    href="/miniepd/promoter_elements/gc.php">GC
	    motif</a> if it is found in the region &minus;200 to
	    &minus;50 from the TSS (evaluated
	    using <a
	    href="<?php echo $url_ssa; ?>/findm.php">FindM</a>).
	  </li>
	  <!-- li>
	    <b>CpG</b>: at the moment this selection criteria is not
	    active.
	  </li -->
	  <li>
	    <b>Average Expression</b>: for each sample used in
	    generating an EPDnew collection, promoter expression is
	    calculated as the number of tags matching the region
	    from &minus;250 to &plus;250 bp relative to the TSS. Each sample
            is normalized to a total tag count of 10 M.
	  </li>
	  <li>
	    <b>Expression call</b>: a promoter is expressed in sample
	    X if the number of tags that map at the TSS is higher than
	    3.
	  </li>
	</ul>
      </p>
      <p>
	<b>Additional Options:</b><br /> Users can restrict the
	selection only to the most representative promoter for a
	gene. In this case only one promoter will be associated with a
	gene, the one that has been validated by the
	largest number of samples or, if inconclusive, the one located
        most upstream. Note that for some organisms, the <i>samples might not
	be representative of the normal growth conditions</i> and be
	restricted to specific tissues, growth conditions or
	developmental stages. This may have an impact on the selection
        of the most representative promoter (not general but specific to the
	conditions used during the experiment).
      </p>

      <p>
          <b>Note:</b> Depending on the organism selected, some motifs may
          not be available for filtering (e.g. <i>P. falciparum</i>).
      </p>
    </td>
  </tr>
</table>

<?php readfile("footer.html"); ?>

<script src="/miniepd/scripts/epd_select-251010.min.js">
</script>

</body>
</html>
