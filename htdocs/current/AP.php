<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->
<?php include("../header.php"); ?>

<div id="genes" style="width : 90%; height:600px;; overflow:auto;">

<?php readfile("/db/epd/current/AP.html"); ?>

</div>
<!-- ######### Insert the footer #########-->
<?php readfile("../footer.html"); ?>
