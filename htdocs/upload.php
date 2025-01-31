<!DOCTYPE html>
<html lang='en'>

<?php /*  REMEMBER: master_search.php, epdNew2genome.php and
       *  fetch_biomart.cgi have their own header in the file and
       *  import left_menu.php. Change them as well!
       */
?>

<head>
  <meta charset="utf-8">
  <title>EPD The Eukaryotic Promoter Database</title>
  <meta name="dcterms.rights" content="EPD copyright 2011 SIB">
  <meta name="keywords" content="Promoter,Eukaryotic,promoter database,promoter analysis">
  <meta name="description" content="EPD The Eukaryotic Promoter Database, knowledgebase and tools">
  <meta name="viewport" content="width=device-width,initial-scale=1,height=device-height">
  <link rel="stylesheet" href="/css_epd/sib-expasy.min-20240214.css" type="text/css" media="screen" />
  <link rel="shortcut icon" href="/img_epd/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="/css_epd/search.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="/css_epd/jquery-ui-1.13.2.min.css" />
  <link rel="stylesheet" href="/miniepd/stylesheets/epd-24022023.min.css" />
  <link rel="canonical" href="https://epd.expasy.org/miniepd/">
</head>
<body onload='if (typeof check_url_parameters == "function") {check_url_parameters();}'>
<script type="text/javascript">

function check_url_parameters() {
    var params = document.location.search.substring(1).split("&");
    var file_link = "";
    for (var i = 0; i < params.length; i++) {
        var pair = params[i].split("=");
        if (pair[0] == "file_link") {
            file_link = unescape(pair[1]);        }
            document.getElementById("file").value = file_link;
    }
}
</script>

<h3>
Test</h3>

// <?php
// $file_link = "<script>var n=document.getElementById('file_link').val; document.write(n);</script>";
//?>
<p>
Upload: <?php echo $file_link; ?>
<p>
uery_string: <?php echo $_SERVER['QUERY_STRING']; ?>

</body>
</html>
