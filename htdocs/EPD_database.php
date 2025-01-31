<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("header.php"); ?>


<H1>EPD database</H1>

<p>
The Eukaryotic Promoter Database</B> is an annotated non-redundant collection of eukaryotic POL II promoters,
for which the transcription start site has been determined experimentally. Access to promoter sequences is provided
by pointers to positions in nucleotide sequence entries. The annotation part of an entry includes description of the
initiation site mapping data, cross-references to other databases, and bibliographic references. EPD is structured in
a way that facilitates dynamic extraction of biologically meaningful promoter subsets for comparative sequence analysis.
This database contains <b><?php system("grep -c '^ID' ftp/epd/current/epd.dat");?> promoters from several species</b>.
<br>
<p>
Current version is based on <b>EMBL 128</b>.
<p>
<H2>Collection accessibility</H2>
EPD database is accessible in different ways: (1) using the input form in the header, searching for single gene symbol, gene description or ENSEMBL / RefSeq gene IDs; (2) using the <a href="/miniepd/EPD_download.php">download page</a> for selecting specie-specific promoters and downloading them in various formats or (4) through an <a href="/ftp/">ftp website</a> for bulk download of the whole database in various formats (SGA, BED, ...).<br>

<p>
<H2>Reference</H2>
  A detailed description of the principles governing EPD can be found here:
<br>
<p>
 <a href="https://nar.oxfordjournals.org/content/41/D1/D157.full">EPD and EPDnew, high-quality promoter resources in the next-generation sequencing era.</a> Dreos, R., Ambrosini, G., P&eacute;rier, R., Bucher, P. Nucleic Acids Res. (2013) 41(Database issue):D157-64; PUBMED&nbsp; <a href="https://www.ncbi.nlm.nih.gov/pubmed/23193273">23193273</a>


<!-- ######### Insert the footer #########-->
<?php readfile("footer.html"); ?>



</body>
</html>
