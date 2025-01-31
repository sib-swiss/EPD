<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("../../header.php"); ?>
<?php include("../../url_extern.php"); ?>



   <H1>OProf quick guide</H1>

   <p>
   This page is intended as a very quick guide to <a href="<?php echo $url_ssa; ?>/oprof.php" target="_blank">OProf</a>, one of the tools of the <a href="<?php echo $url_ssa; ?>/" target="_blank">Signal Search Analysis Server</a>. Comprehensive instructions can be found <a href="<?php echo $url_ssa; ?>/documents.php" target="_blank">here</a>.

   <h2>Overview</h2>
   <p>
   OProf is a tool that scans a set of DNA sequences aligned with respect to a functional site (e.g. a transcription start site) to determine the frequency of a motif in a region around the functional site. For example it can show the distribution of the TATA-box around promoters.

   <h2>How-to</h2>
   <h2>1. Select the input</h2>
   <p>
   <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/oprof/Oprof_quick_guide_1.jpg"></div>
  <p>
   Inputs can be one of the available data sets, a user provided FASTA file or a users' FPS file.

   <h2>2. Select the motif</h2>
   <p>
   <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/oprof/Oprof_quick_guide_2.jpg"></div>
  <p>
   A motif can be selected from the available libraries, a user provided Position Weight Matrix or a consensus sequence.

   <h2>3. Select additional parameters</h2>
   <p>
   <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/oprof/Oprof_quick_guide_3.jpg"></div>
  <p>
   <b>Sequence range</b>: is the range around the functional site that OProf scans for the motif<br>
   <b>Sliding Window</b>: is the window width and shift used by OProf when scanning for the motif

   <h2>4. Get the results</h2>
   <p>
											     <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/oprof/Oprof_quick_guide_4.jpg"></div>
  <p>
											    OProf shows the distribution of the motif around the functional site (in this example the TATA-box in EPDnew promoters, alligned by the TSS).







<!-- ######### Insert the footer #########-->
<?php readfile("../../footer.html"); ?>





</body>
</html>
