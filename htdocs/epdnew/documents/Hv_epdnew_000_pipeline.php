<?php
#include("../../header.php");
include("../../header.php");

$assembly = "MorexV3";
$datfile = fopen("../../mga/$assembly/$assembly.dat", "r");
while(!feof($datfile)) {
  $line = fgets($datfile);
  list($id, $name) = explode(": ", $line);
  if ($id == "Name"){
    list($organism, $v) = explode(" (", $name);
    $version = preg_replace('/\)/', '', $v);
  }
}
fclose($datfile);
?>

<div style='font-size: 14px; text-align: justify; width:95%;'>

<h1>TSS assembly pipeline for Hv_EPDnew_000</h1>

<h2>Introduction</h2>

This document provides a technical description
of the transcription start site assembly pipeline that was used to
generate the EPDnew version 000 for <i><?php echo $organism ?></i>.

<h2>Source Data</h2>

<p class='document'>
Gene annotation resource:

<table class='document'>
  <tr>
    <th class='document'>Name</th>
    <th class='document'>Genome Assembly</th>
    <th class='document'>Promoters</th>
    <th class='document'>Genes</th>
    <th class='document'>PMID</th>
    <th class='document' colspan='3'>Access data</th>
  </tr>
  <tr>
    <td class='document'>
      UCSC/RefSeq gene annotation
    </td>
    <td class='document'>
      <?php echo $version ?>
    </td>
    <td class='document'>
        21193
    </td>
    <td class='document'>
        20502
    </td>
    <td class='document'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/pubmed/37784172'>37784172</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href=' https://hgdownload.soe.ucsc.edu/hubs/GCF/904/849/725/GCF_904849725.1/bbi/GCF_904849725.1_MorexV3_pseudomolecules_assembly.ncbiRefSeq.bb'>SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank' href='<?php echo $url_ftp; ?>/mga/MorexV3/ucscJan22/ucscJan22.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a href='<?php echo $url_ftp; ?>/mga/MorexV3/ucscJan22/ucsc_transcriptStart_list.sga.gz'>
      DATA1</a>
      <a href='<?php echo $url_ftp; ?>/mga/MorexV3/ucscJan22/ucsc_CDSstart_list.sga.gz'>
      DATA2</a>
    </td>
  </tr>
</table>
</p>


<p class='document'>
Experimental data:
<table  class='document'>
  <tr>
    <th class='document'>Name</th>
    <th class='document'>Type</th>
    <th class='document'>Samples</th>
    <th class='document'>Tags</th>
    <th class='document'>PMID</th>
    <th class='document' colspan='3'>Access data</th>
  </tr>
  <tr>
    <td class='document'>
		pavlu23
    </td>
    <td class='document'>
		CAGE
    </td>
    <td class='document'>
		<!-- SAMPLE NUMBER -->
		3
    </td>
    <td class='document'>
		<!-- TOTAL TAGS -->
        151'754'815 
    <td class='document'>
      <a target='_blank' href='https://www.ncbi.nlm.nih.gov/pubmed/38173877'>
      38173877</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE227219'>
      SOURCE</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ccg; ?>/mga/MorexV3/pavlu23/pavlu23.html'>
      DOC</a>
    </td>
    <td class='document' width='40'>
      <a target='_blank'
      href='<?php echo $url_ftp; ?>/mga/MorexV3/pavlu23/'>
      DATA</a>
    </td>
  </tr>
</table>
</p>

<!--
<h2>Assembly pipeline overview</h2>

<div style="width:100%; text-align:center;">
<table border="1" cellpadding="10" style="display:inline-block;">
<tr><td>
<img style="max-width:700px;" src="/miniepd/epdnew/documents/Pf_epdnew_001_pipeline.png">
</td></tr>
</table>
</div>
-->

<h2>Description of procedures and intermediate data files</h2>

<h3>1. Genome Annototion Download</h3>

<p align=left>
The "RefSeq gene predictions from NCBI" track for the MorexV3_pseudomolecules_assembly Apr. 2021 
(<a href="https://www.ncbi.nlm.nih.gov/datasets/genome/GCF_904849725.1/">GCF_904849725.1</a>) 
was downloaded from UCSC, file:
<ul>
<a href="https://hgdownload.soe.ucsc.edu/hubs/GCF/904/849/725/GCF_904849725.1/bbi/GCF_904849725.1_MorexV3_pseudomolecules_assembly.ncbiRefSeq.bb">
GCF_904849725.1_MorexV3_pseudomolecules_assembly.ncbiRefSeq.bb</a>.

</p>
</ul>
<h3>2. UCSC/RefSeq TSS and codon start collection</h3>

TSS  positions and CDS stast positions of complete open reading frames were extracted from RefSeq
gene annotation and refrmatted into sga format    

<ul>
    <a href=https://epd.expasy.org/mga/MorexV3/ucscJan22/ucsc_transcriptStart_list.sga.gz">ucsc_transcriptStart_list.sga.gz</a>
<br><a href=https://epd.expasy.org/mga/MorexV3/ucscJan22/ucsc_CDSstart_list.sga.gz">ucsc_CDSstart_list.sga.gz</a>
</ul>

The six fields of these files contain the following information:

<ul>
<li>NCBI/RefSeq chromosome id</li>
<li>"TSS" or CDSstart</li>
<li>position</li>
<li>strand ("+" or "-")</li>
<li>"1"</li>
<li>RefSeqID..geneName</li>
</ul>
Note that the second and fifth field are invariant in both files.

<h3>3. Rawdata download and tag mapping to barley genome</h3>

Raw CAGE data were downloaded from
<a href="https://www.ncbi.nlm.nih.gov/sra">SRA</a> in FASTQ format, using SRX identifiers 
provided in GEO entry
<a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE227219">GSE227219</a>.
The sequence tags were subsequently mapped to the Barly MorexV3 genome using
<a href='https://bowtie-bio.sourceforge.net/bowtie2/'>Bowtie2</a> v1.2.2. SAM output files were 
reformatted to SGA format.

<h3>4. CAGE tag peak calling</h3>
<p>
All six CAGE samples were merged into a single file.
Candidate TSS were selected in two stages using the programs <i>chippeak</i> and <i>chipscore</i> from
<a href='http://chip-seq.sourceforge.net/'>ChIP-Seq</a> v. 1.5.5.
</p>
<p>
<i>chippeak</i> was used with the following options and parameters: 

<ul>
<li>window width = 1</li>
<li>vicinity range = 200</li>
<li>count cutoff = 9999999</li>
<li>threshold = 5</li>
</ul>

This selects candidate peak summit position, which have at least 5 CAGE tag mapped to it, 
and which constitute a maximum within a range of &pm;200 bp. 

This preliminary list, together with the CAGE tag input file, was subsequently processed
with <i>chipscore</i> in order to select peak summits which are covered by at least 50 tags 
within a surrounding range of &pm;50 bp.  
The peaks from step 1 were used as reference features for <i>chipscore</i> , and the merged CAGE tags from
all CAGE samples as target features. 

<h3>5. TSS validation and attribution to gene</h3>

Candidate TSS of annotated genes where then selected from the preliminary list obtained
in the previous step using proximity mapping: All peak summits were retained, which are located either 
<ul>
    between 50 bp upstream and 200 bp downstream from a RefSEQ annotated TSS
</ul>
or 
<ul>
    no more than 300 bp upstreamd of a RefSeq annotated CDS start site.
</ul>
These ranges were empirically determined by analyzing the input CAGE tag distributions
around RefSeq annotated TSS and CSD start sites.  

<h3>6. Final EPDnew collection</h3>

The 21193
<?php include("../../othertools.html"); ?>

</div>

<?php include("../../footer.html"); ?>

</body>
</html>
