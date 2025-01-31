<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("../header.php"); ?>




   <H1>EPDnew human database statistics</H1>

   <p>
   This page gives further information on the human EPDnew database. A detailed description on how this release was generated can be found <a href="/miniepd/epdnew/documents/Hs_epdnew_003_pipeline.php">here</a>.

   <h2>Gene and transcript coverage</h2>
   <p>
   Total number of validated <b>genes</b>: <b><?php
$command='awk -F \'\t\' \'{split($6,name,"_"); print name[1]}\' ../ftp/epdnew/human/current/Hs_EPDnew.sga | sort -u | wc -l';
passthru("$command");
?> </b><br>
   Total number of validated <b>transcripts</b>: <b><?php echo count(file("../ftp/epdnew/human/current/Hs_EPDnew.sga"));?></b><br>


  <h2>Core promoter elemnts enrichment</h2>
  <p>
  Core promoter element analysis is performed in order to investigate the quality of the promoter collection.  It exploits the fact that certain DNA motifs preferentially occur at characteristic distances from a TSS. For instance, the TATA-box occurs in a narrow region centered about 28 bp upstream of the TSS whereas the CCAAT-box occurs in a much wider area with a peak frequency at position -80. Based on these observations, we would expect a high-quality promoter collection to show high peaks for both sequence motifs. In addition, a narrow TATA-box peak at -28 would indicate precise TSS mapping. This analysis has been performed using <a href="<?php echo $url_ssa; ?>/oprof.php">OProf</a>. Readers are encouraged to repeat this anlysis and perform others in order to check for the quality of the promoter list.
  <p>
  <a href="/miniepd/promoter_elements/tata_old.php"><b>TATA-box</b></a>: this core promoter element is normally found 28 bp upstream the transcription start site. The following plot shows that EPDnew promoter collection has a more focused TATA-box distribution compared to ENSEMBL annotation suggesting a precise TSS mapping in EPDnew.
  <div style='text-align: center;'><img src="/miniepd/human/human_TATA-box.jpg"></div>
  <p>
  <a href="/miniepd/promoter_elements/init.php"><b>Initiator</b></a>: it is found at the TSS and shows a great enrichment in EPDnew compared to ENSEMBL promoter collection.
  <div style='text-align: center;'><img src="/miniepd/human/human_inr.jpg"></div>
  <p>
  <a href="/miniepd/promoter_elements/ccaat.php"><b>CCAAT-box</b></a>: is found more up-stream of the TSS compared to the other core promoter elements. EPDnew shows an enrichment in this elements as well.
  <div style='text-align: center;'><img src="/miniepd/human/human_ccaat.jpg"></div>
  <p>
  <a href="/miniepd/promoter_elements/gc.php"><b>GC-box</b></a>: as in the other cases, EPDnew shows an enrichment in this element compared to ENSEMBL collection.
  <div style='text-align: center;'><img src="/miniepd/human/human_gc.jpg"></div>






<!-- ######### Insert the footer #########-->
<?php readfile("../footer.html"); ?>





</body>
</html>
