<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("header.php"); ?>

<h1>EPDnew analysis tools</h1>

   Here you can investigate EPDnew promoters for their chromatin
   status or motif enrichment/distribution using our tools. If you
   want to restrict your analysis to a subset of promoters, please use
   the <a href="EPDnew_select.php">promoter selection tool</a> page.

<p>
  <div>
    <form id='result' action="send_promoters_to_ccg.php" method="POST" target="_blank">
      <table>
	<tr style="background-color: #9df;">
	  <td style="padding: 4px 12px; vertical-align:middle">
	    Analyze promoters of
	    <select name="query_db" class="epddownload">
	      <optgroup label="EPDnew - Animals">
		<option value="human" selected="selected">H. sapiens</option>
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
	      </optgroup>
	      <optgroup label="EPDnew - Fungi">
		<option value="S_cerevisiae">S. cerevisiae</option>
		<option value="S_pombe">S. pombe</option>
	      </optgroup>
	      <optgroup label="EPDnew - Invertebrates">
		<option value="P_falciparum">P. falciparum</option>
	      </optgroup>
	    </select>
	  </td>
	</tr>

	<tr style='background-color:#cef;'>
	  <td style="text-align: center; padding-top: 6px; padding-bottom: 2px;">
	    <button class='epdsubmit' type="submit" name="action" value="toOprof" title="Motif Distribution using OProf" style="padding: 4px 12px;">Motif Distribution</button>
	  </td>
	</tr>

	<tr style='background-color: #cef;'>
	  <td style="text-align: center; padding: 4px 0;">
	    <button class='epdsubmit' type="submit" name="action" value="toFindm" title="Motif Extraction using FindM" style="padding: 4px 12px;">Motif Extraction</button>
	  </td>
	</tr>

	<tr style='background-color: #cef;'>
	  <td style="text-align: center; padding-top: 2px; padding-bottom: 6px;">
	    <button class='epdsubmit' type="submit" name="action" value="toChipcor" title="Chromatin Marks using ChIP-Cor" style="padding: 4px 12px;">Chromatin Marks</button>
	  </td>
	</tr>
      </table>
    </form>
  </div>
<br>


   <h2>Help</h2>
   We provide quick guides to <a target="_blank" href="documents/oprof/oprofQuickGuide.php">OProf</a>, <a target="_blank" href="documents/findm/findmQuickGuide.php">FindM</a> and <a target="_blank" href="documents/chip-cor/chipcorQuickGuide.php">ChIP-Cor</a>.

<p>
<p>
<br>

<!-- ######### Insert the footer #########-->
<?php readfile("footer.html"); ?>
