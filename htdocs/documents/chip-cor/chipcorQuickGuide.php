<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("../../header.php"); ?>
<?php include("../../url_extern.php"); ?>



   <H1>ChIP-Cor quick guide</H1>

   <p>
   This page is intended as a very quick guide to <a href="<?php echo $url_chipseq; ?>/chip_cor.php" target="_blank">ChIP-Cor</a>, one of the tools of the <a href="<?php echo $url_chipseq; ?>/" target="_blank">ChIP-Seq analysis tools</a>. Comprehensive instructions can be found <a href="<?php echo $url_chipseq; ?>/tutorials.php" target="_blank">here</a>.

   <h2>Overview</h2>
   <p>
   ChIP-Cor is a tool that correlate two features (called Reference and Target) and calculate the density distribution of the Target feature around the Reference feature. For example, it can be used to visualize the distribution of the histone marks H3K4me3 (Target feature) around promoters (Reference feature).

   <h2>How-to</h2>
   <h2>1. Select the Reference Feature</h2>
   <p>
   <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/chip-cor/ChIP-Cor_quick_guide_1.jpg"></div>
  <p>
   Input can be one of the available data sets or a user provided file in several formats. In this example we selected <b>human transcription start sites (TSS) from EPDnew</b>.

   <h2>2. Adjust Reference parameters</h2>
   <p>
   <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/chip-cor/ChIP-Cor_quick_guide_2.jpg"></div>
  <p>
   Possible parameters are: Strand, Centering and Repeat Masker. Here, TSS are oriented feature (the region before them is the promoter, whereas after is the gene body).

   <h2>3. Select Target Feature</h2>
   <p>
   <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/chip-cor/ChIP-Cor_quick_guide_3.jpg"></div>
  <p>
   As for the Reference, input can be one of the available data sets or a user provided file in several formats. In this example we selected <b>the histone variants H3K4me3</b>.

   <h2>4. Adjust Target parameters</h2>
   <p>
   <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/chip-cor/ChIP-Cor_quick_guide_4.jpg"></div>
  <p>
   Possible parameters are: Strand, Centering and Repeat Masker. Here, we select any strand and we centering of half a nucleosome (70 bp).

   <h2>5. Adjust additional parameters</h2>
   <p>
   <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/chip-cor/ChIP-Cor_quick_guide_5.jpg"></div>
  <p>
   Possible parameters are: Range of the Region, Window widht and count cut-off.

   <h2>6. Get the results</h2>
   <p>
   <div style='text-align: center;'><img style='border: 2px solid;' src="/miniepd/documents/chip-cor/ChIP-Cor_quick_guide_6.jpg"></div>
  <p>
   ChIP-Cor plots the distribution of the Target feature around the Reference feature.









<!-- ######### Insert the footer #########-->
<?php readfile("../../footer.html"); ?>





</body>
</html>
