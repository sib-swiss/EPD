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


<br><br>
<h1>FUNDING</h1>
<h2>We gratefully acknowledge the following sources of support: </h2>
<ul>
    <li>SIB Swiss Institute of Bioinformatics, Service and Infrastructure grants for EPD (2012-2024)</li>
    <li>SIB Swiss Institute of Bioinformatics, Service and Infrastructure grants for EPD and the gene expression database CleanEx (2000-2011)</li>
    <li>Swiss National Science Foundation grant 3100-054782 "Maintenance and extension of the Eukaryotic Promotor Database EPD" (1998-2002)</li>
</ul>
EPD was developed at the different places in the world: The Weizmann Institute of Science (Israel), Stanford University (USA), the Swiss Institute for Experimental Cancer Research ISREC and the &Eacute;cole Polytechnique F&eacute;d&eacute;rale de Lausanne (EPFL). We are grateful for the indirect support provided by these institutions.


<!-- ######### Insert the footer #########-->
<?php readfile("footer.html"); ?>

</body>
</html>
