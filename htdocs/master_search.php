<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
  <head>
    <title>EPD The Eukaryotic Promoter Database</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <link rel="stylesheet" href="/css_epd/sib-expasy.min-20240214.css" type="text/css" media="screen" charset="utf-8" />
    <link rel="shortcut icon" href="/img_epd/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/css_epd/search.min.css" />

    <link rel="stylesheet" href="/css_epd/jquery-ui-1.13.2.min.css" />
    <script src="/js_epd/jquery-3.6.3.min.js"></script>
    <script src="/js_epd/jquery-ui-1.13.2.min.js"></script>
    <script src="/miniepd/scripts/check_form-24022023.min.js"></script>
    <script language='javascript' type='text/javascript' src='/js_epd/epd.min.js'></script>


  <script>
    // This function is to get the autocomplete:
    ( function($) {
      $(document).ready(function() {

      // Custom autocomplete instance (bold-text on matches).
        $.widget( "app.autocomplete", $.ui.autocomplete, {
          // Which class get's applied to matched text in the menu items.
          options: {
              highlightClass: "bold-text"
          },
          _renderItem: function( ul, item ) {
            // Replace the matched text with a custom span. This
            // span uses the class found in the "highlightClass" option.
            var re = new RegExp( "(" + this.term + ")", "gi" ),
                cls = this.options.highlightClass,
                template = "<span class='" + cls + "'>$1</span>",
                label = item.label.replace( re, template ),
                $li = $( "<li/>" ).appendTo( ul );
            // Create and return the custom menu item content.
            $( "<a/>" ).html( label )
                       .appendTo( $li );
            return $li;
	  }
        });

        $( "#query" ).autocomplete({
          source: function(request, response) {
  	    $.getJSON(
	    "/miniepd/getIdFromDatabase.php",
	    {
	    database : $('#query_db').val(),
	    query : request.term
            },
	    response);
	  },
          minLength: 2,
        } );
      });
    } ) ( jQuery );

  </script>

  <style>
    /* highlight results */
    .bold-text {
    font-weight: bold;
//    background-color: yellow;
    }

    /* loading - the AJAX indicator */
    .ui-autocomplete-loading {
    background: white url('ajax-loader.gif') right center no-repeat;
    }

    /* scroll results */
    .ui-autocomplete {
    max-height: 250px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
    /* add padding for vertical scrollbar */
    padding-right: 5px;
    }

    .ui-autocomplete li {
    font-size: 16px;
    }

    /* IE 6 doesn't support max-height
    * we use height instead, but this forces the menu to always be this tall
    */
    * html .ui-autocomplete {
    height: 250px;
    }
  </style>

<script src="/miniepd/scripts/showads-24022023.min.js"></script>

<script language='javascript' type='text/javascript' src='/miniepd/scripts/epd_search-10032023.min.js'></script>
</head>

<!-- Include the header of the page. It must be followed by the footer.html at the end of the page -->
<!-- ********************************************************************************************* -->

<?php

    $query_str = $_POST['query_str'];
    $db        = $_POST['db'];
if (empty($query_str)){
  $query_str = $_GET['query'];
}
if (empty($db)){
  $db = $_GET['db'];
}

date_default_timezone_set("Europe/Rome");

function VisitorIP(){
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
  else $TheIp=$_SERVER['REMOTE_ADDR'];

  return trim($TheIp);
}
$Users_IP_address = VisitorIP();
$unique = rand(10000, 99999);
$date = date('Y-m-d');
$time = date('H:i:s');

// write the data to a log file
//$fp = fopen('./logs/new_master_search.log', 'a');
//fwrite($fp, "$date\t$time\t$Users_IP_address\tAll\t$query_str\n");
//fclose($fp);

$confFile = fopen('../etc/epd.conf', 'r')  or die('Unable to open configuration file!');
if ($confFile) {
  while (($line = fgets($confFile)) !== false) {
    // process the line read.
    $parts = preg_split('/\t+/', rtrim($line));
    $dbNames[$parts[0]] = $parts[1];
    $scNames[$parts[0]] = $parts[2];
    //    echo "/$parts[0]-$parts[1]-$parts[2]/<br/>\n";
  }
  fclose($confFile);
} else {
  // error opening the file.
  die("Unable to open configuration file!");
}
#fclose($confFile);


echo "<body onload=\"searchEPD(); ";
foreach($dbNames as $id => $dbName) {
  echo "searchEPDnew('$id'); ";
}
echo "\">\n";


include("left_menu.php");

echo "<input type='hidden' id='query_str' value='$query_str' />";
echo "<br /><div id='epdresult'>\n";
echo "  <table align='left' style='font-size: 12px; font-family: Helvetica; width : 500px;' border='0'>\n";
echo "    <tr align='left' style='height : 50px;'>\n";
echo "    <td align='left' colspan='2'><b>Experimentally validated promoters:</b></td><td></td></tr>\n";

if($db == "all") {
foreach($dbNames as $id => $dbName) {
  echo "\n";
  echo "    <tr class='border-bottom-dotted'>\n";
  echo "    <td align='left'>EPDnew - <b><i>$scNames[$id]</i></b></td>\n";
  echo "    <td align='left'>\n";
  echo "      <div style='display:block; ' id='loadingEPDnew_$id'>\n";
  echo "      <p><img src='/img_epd/indicator2.gif' /> </p> </div>\n";
  echo "      <b><div id='resultEPDnew_$id'  style='display:none;'></div></b>\n";
  echo "    </td><td>\n";
  echo "      <div id='viewEPDnew_$id' style='display:none;'>\n";
  echo "      <form action='search_EPDnew.php' method='GET'>\n";
  echo "      <input type='hidden' id='query' name='query' value='$query_str' />\n";
  echo "      <input type='hidden' id='db' name='db' value='$dbName' />\n";
  echo "      <input type='submit' value='View' class='epdsubmit' /></form>\n";
  echo "     </div>\n";
  echo "   </td></tr>\n";
}
}
?>

<tr class='border-bottom-dotted'>
  <td align='left' style='width : 150px;'>EPD</td>
      <td align='left' style='width : 150px;'>
	<div style='display:block; ' id='loadingEPD'>
	<p><img src='/img_epd/indicator2.gif' /> </p> </div>
	<b><div id='resultEPD'  style='display:none;'></div></b>
	<td style='width : 100px;'>
	  <div id='viewEPD' style='display:none;'>
	  <?php
	    echo "<form action='/cgi-bin/miniepd/fetch_biomart.cgi' method='POST'>";
	    echo "<input type='hidden' id='query_str' name='query_str' value='$query_str' />";
	    echo "<input type='hidden' id='query_db' name='query_db' value='epd' />";
	    echo "<input type='submit' value='View' class='epdsubmit' /></form>";
	  ?>
	  </div>
	</td></tr>

</table></div>


<?php readfile("footer.html");?>
</body>
</html>
