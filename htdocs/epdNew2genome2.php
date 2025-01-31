<?php

# CAVE! The regex may have to be changed if the URLs format changes
function getUSLink($eurolink) {
    $US_link = preg_replace('/genome-euro/', 'genome', $eurolink);
    $US_link = preg_replace('/epd_(.*)_viewer/', 'epd_us_$1_viewer', $US_link);
    $US_link = preg_replace('/sessions\/(.+)\/euro/', 'sessions/$1/us', $US_link);
    $US_link = preg_replace('/epdHub\/viewers\/euro/', 'epdHub/viewers/us', $US_link);
    return $US_link;
}

include("getUcscLink.php");

# Get parameters:
if(php_sapi_name() == 'cli'){
  $db = $argv[1];
  $id = $argv[2];
} else{
  $db = $_GET['db'];
  $id = $_GET['id'];
}

# Set database specific variables:
if(preg_match("/hsNC/", $db)) {
  $database = 'human_nc_epdnew';
  $assembly = 'hg38';
  $commonName = 'human_nc';
  $dbOld = 'epdNew_hsNC';	# must be epdNew_<first column in 'epd.conf'>
  $_GET['db'] = 'human_nc';
  $specie = 'Homo_sapiens';
} else if (preg_match("/hg/",$db)){
  $database = 'human_epdnew';
  $assembly = 'hg38';
  $commonName = 'human';
  $dbOld = 'epdNew_hg';
  $_GET['db'] = 'human';
  $specie = 'Homo_sapiens';
} else if(preg_match("/rm/",$db)){
  $database = 'M_mulatta_epdnew';
  $assembly = 'rheMac8';
  $commonName = 'rhesus macaque';
  $dbOld = 'epdNew_rm';
  $_GET['db'] = 'M_mulatta';
  $specie = 'Macaca_mulatta';
} else if(preg_match("/mmNC/", $db)) { # CAVE! because of the regex, non-coding must come before the coding
  $database = 'mouse_nc_epdnew';
  $assembly = 'mm10';
  $commonName = 'mouse_nc';
  $dbOld = 'epdNew_mmNC';	# must be epdNew_<first column in 'epd.conf'>
  $_GET['db'] = 'mouse_nc';
  $specie = 'Mus_musculus';
} else if(preg_match("/mm/",$db)){
  $database = 'mouse_epdnew';
  $assembly = 'mm10';
  $commonName = 'mouse';
  $dbOld = 'epdNew_mm';
  $_GET['db'] = 'mouse';
  $specie = 'Mus_musculus';
} else if(preg_match("/rn/",$db)){
  $database = 'R_norvegicus_epdnew';
  $assembly = 'rn6';
  $commonName = 'rat';
  $dbOld = 'epdNew_rn';
  $_GET['db'] = 'R_norvegicus';
  $specie = 'Rattus_norvegicus';
} else if(preg_match("/cf/",$db)){
  $database = 'C_familiaris_epdnew';
  $assembly = 'canFam3';
  $commonName = 'dog';
  $dbOld = 'epdNew_cf';
  $_GET['db'] = 'C_familiaris';
  $specie = 'Canis_familiaris';
} else if(preg_match("/gg/",$db)){
  $database = 'G_gallus_epdnew';
  $assembly = 'galGal5';
  $commonName = 'chicken';
  $dbOld = 'epdNew_gg';
  $_GET['db'] = 'G_gallus';
  $specie = 'Gallus_gallus';
} else if(preg_match("/dm/",$db)){
  $database = 'drosophila_epdnew';
  $assembly = 'dm6';
  $commonName = 'drosophila';
  $dbOld = 'epdNew_dm';
  $_GET['db'] = 'drosophila';
  $specie = 'Drosophila_melanogaster';
} else if(preg_match("/dr/",$db)){
  $database = 'zebrafish_epdnew';
  $assembly = 'danRer7';
  $commonName = 'zebrafish';
  $dbOld = 'epdNew_dr';
  $_GET['db'] = 'zebrafish';
  $specie = 'Danio_rerio';
} else if(preg_match("/ce/",$db)){
  $database = 'worm_epdnew';
  $assembly = 'ce6';
  $commonName = 'worm';
  $dbOld = 'epdNew_ce';
  $_GET['db'] = 'worm';
  $specie = 'Caenorhabditis_elegans';
} else if(preg_match("/at/",$db)){
  $database = 'arabidopsis_epdnew';
  $assembly = 'araTha1';
  $commonName = 'arabidopsis';
  $dbOld = 'epdNew_at';
  $_GET['db'] = 'arabidopsis';
  $specie = 'Arabidopsis_thaliana';
} else if(preg_match("/sc/",$db)){
  $database = 'S_cerevisiae_epdnew';
  $assembly = 'sacCer3';
  $commonName = 'yeast';
  $dbOld = 'epdNew_sc';
  $_GET['db'] = 'S_cerevisiae';
  $specie = 'Saccharomyces_cerevisiae';
} else if(preg_match("/sp/",$db)){
  $database = 'S_pombe_epdnew';
  $assembly = 'spo2';
  $commonName = 'budding yeast';
  $dbOld = 'epdNew_sp';
  $_GET['db'] = 'S_pombe';
  $specie = 'Schizosaccharomyces_pombe';
} else if(preg_match("/zm/",$db)){
  $database = 'Z_mays_epdnew';
  $assembly = 'zm3';
  $commonName = 'corn';
  $dbOld = 'epdNew_zm';
  $_GET['db'] = 'Z_mays';
  $specie = 'Zea_mays';
} else if(preg_match("/am/",$db)){
  $database = 'A_mellifera_epdnew';
  $assembly = 'amel5';
  $commonName = 'Honey bee';
  $dbOld = 'epdNew_am';
  $_GET['db'] = 'A_mellifera';
  $specie = 'Apis_mellifera';
} else if(preg_match("/pf/",$db)) {
  $database = 'P_falciparum_epdnew';
  $assembly = 'pfa2';
  $commonName = 'Plasmodium falciparum';
  $dbOld = 'epdNew_pf';
  $_GET['db'] = 'P_falciparum';
  $specie = 'Plasmodium_falciparum';
}

$newdb = $_GET['db'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<?php
  echo "    <title>EPD - $id viewer</title>\n";
?>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <link rel="stylesheet" href="/css_epd/sib-expasy.min-20240214.css" type="text/css" media="screen" charset="utf-8" />
    <link rel="shortcut icon" href="/img_epd/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/css_epd/search.min.css" />

    <link rel="stylesheet" href="/css_epd/jquery-ui-1.13.2.min.css" />
    <link rel="stylesheet" href="/miniepd/stylesheets/epd-24022023.min.css" />

    <script src="/js_epd/jquery-3.6.3.min.js"></script>
    <script src="/js_epd/jquery-ui-1.13.2.min.js"></script>
    <script src="/miniepd/scripts/raphael-2.1.0.min.js"></script>
    <script src="/miniepd/scripts/check_form-24022023.min.js"></script>

  <script>

    jQuery.noConflict();

    function openUCSC(link, ga_category) {
        window.open(link, '_blank');
    }

    // Tab implementation
    function openSectionTab(evt, section) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("epd-tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("epd-tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      // Show the current tab, and add an "active" class to the button
      // that opened the tab
      document.getElementById(section).style.display = "block";
      evt.currentTarget.className += " active";
    }

    // Get the expression profile
    function getMaxOfArray(numArray) {
      return Math.max.apply(null, numArray);
    }

    function isArray(what) {
      return Object.prototype.toString.call(what) === '[object Array]';
    }

    function plotExpression(results, lenghtArea){
      var attr = {
        fill: "#000000",
	stroke: "#000000",
	"stroke-width": 2,
	"stroke-linejoin": "round"
      };
      var expDiv = document.getElementById('expressionDiv');
      var loadDiv = document.getElementById('expressionLoadingDiv');
      var expCanvas = document.getElementById('expressionCanvas');
      var expSamples = document.getElementById('expressionSamples');
      var promoterId = document.getElementById('pid').getAttribute('value');
      var splitResults = JSON.parse(results);

      expSamples.innerHTML = splitResults['samples'];
      //console.log(results);
      expDiv.innerHTML = "<p> " + promoterId + " is expressed in <b>" + splitResults['nSamples'] + " samples</b> with an <b>average expression of " + splitResults['averageExpression'] + " tags</b> per 10M. </p> <p>The TSSs distribution around the EPDnew annotated start site (click on the histogram bars to explore samples):</p>";
      expDiv.style.display = 'block';
      loadDiv.style.display = 'none';

      var posStr = splitResults['positions'];
      var countsStr = splitResults['counts'];

      var positions;
      var counts;
      var mCounts;

      if(posStr === parseInt(posStr)){
        splitResults['positions'] = posStr + " " + posStr;
        splitResults['counts'] = countsStr + " " + countsStr;
      }
      positions = splitResults['positions'].split(" ");
      counts = splitResults['counts'].split(" ");
      mCounts = getMaxOfArray(counts);
      expCanvas.style.display = 'block';
      expCanvas.innerHTML = '';
      //console.error(expCanvas);
      // plot expression profile
      //var lenghtArea = 400;
      var window = 200;
      var windowFrom = -100;
      var ratio = lenghtArea / window;
      var heightArea = 220;
      var plotStep = 10;
      var firstLinePosition = 0;
      var paper = new Raphael(expCanvas, lenghtArea, heightArea);
      var genomeStr = "M0,200 L"+lenghtArea+",200";
      var genome = paper.path(genomeStr);
      genome.attr({fill: '#000000'});

      // Draw vertica lines at defined intervals
      var s_pos = lenghtArea - firstLinePosition - 1;
      var real_pos = window;
      while (s_pos >= 0){
        var ms = paper.rect(s_pos, 200, 1, 5);
	ms.attr({fill: '#000000'}).toBack();
	var r_pos = real_pos + windowFrom;
	var text = paper.text(s_pos, heightArea - 5, r_pos).attr({fill: '#000000'});
	s_pos = s_pos - (plotStep * ratio);
	real_pos = real_pos - plotStep;
      }


      // draw counts:
      posLen = positions.length;
//      console.log(positions);
      var histogram = {};
      for (i = 0; i < posLen; i++) {
        var x1 = ( (Number(positions[i])+100) * ratio );
	var y1 = 198 - ((counts[i] * 190)+10)/mCounts;
//	console.log(y1);
	var hist = "M" + x1 + ",198 L" + x1 + "," + y1;
	//console.error(x1, positions[i]);
	var name = positions[i].replace("-", "_");
	eval("histogram.pos" + name + "=paper.path(hist).attr(attr);");
	var current = null;
	for (var position in histogram) {
	  histogram[position].color = Raphael.getColor();
	  (function (st, position) {
	  st[0].style.cursor = "pointer";
	  st[0].onclick = function () {
	    //current && histogram[current].animate({fill: "#333", stroke: "#333"}, 500) && (document.getElementById(current).style.display = "");
	    current && histogram[current].animate({stroke: "#000000"}, 500) && (document.getElementById(current).style.display = "none");
	    //histogram.animate({stroke: "#FF0000"}, 500);
	    st.animate({fill: st.color, stroke: "#FF0000"}, 100);
	    //console.log(position);
	    st.toFront();
	    paper.safari();
	    document.getElementById(position).style.display = "block";
	    current = position;
	  };
	})(histogram[position], position);
	}
      }
    }

    function expressionProfile(lenghtArea){
      //alert("function expressionProfile");
      var expCanvas = document.getElementById('expressionCanvas');
      expCanvas.style.display = 'none';
      var expDiv = document.getElementById('expressionDiv');
      expDiv.style.display = 'none';
      var loadDiv = document.getElementById('expressionLoadingDiv');
      loadDiv.style.display = 'block';

      var ajaxRequest;  // The variable that makes Ajax possible!
      try{
      // Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
	} catch (e){
	// Internet Explorer Browsers
	try{
	  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	  } catch (e) {
	    try{
	      ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	    } catch (e){
	      // Something went wrong
	      alert("Your browser does not support AJAX!");
	      return false;
	    }
	  }
        }
      ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
	  plotExpression(ajaxRequest.responseText, 600);
	}
      }
      var promoterId = document.getElementById('pid').getAttribute('value');
      //var print_pid = 'Promoter ID: ' + promoterId;
      //alert(print_pid);
      //var assembly = document.getElementById('assembly').getAttribute('value');
      var assembly = document.getElementById('did').getAttribute('value');
      var queryString = "?assembly=" + assembly + "&pid=" + promoterId;
      //console.error(queryString);
      //var print_query = 'Query str: ' + queryString;
      //alert(print_query);
      ajaxRequest.open("GET", "/cgi-bin/miniepd/expressionProfile.php" + queryString, true);
      ajaxRequest.send(null);
    }


    // This function is to get the autocomplete:
    ( function($) {

    $(document).ready(function() {

    // Initialize Tab
    $( "#General.epd-tabcontent" ).show();
    $( ".epd-tab button:first-child" ).addClass("active");

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
	    database : $('#db').val(),
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

  <script>
    function plotGene(){
    var wait = document.getElementById('loading_gene');
    wait.style.display = 'block';
    var outdiv = document.getElementById('plotGene');
    outdiv.style.display = 'none';
    var canvas = document.getElementById('canvas');
    canvas.style.display = 'none';
    var ajaxRequest;
    try{
	// Opera 8.0+, Firefox, Safari
	ajaxRequest = new XMLHttpRequest();
    } catch (e){
	// Internet Explorer Browsers
	try{
	    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
	    try{
		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	    } catch (e){
		// Something went wrong
		alert("Your browser does not support AJAX!");
		return false;
	    }

	}
    }
    // Set parameters:
    var fromSelect = document.getElementById('plotFrom');
    var windowFrom = parseInt(fromSelect.options[fromSelect.selectedIndex].value);
    var toSelect = document.getElementById('plotTo');
    var windowTo = parseInt(toSelect.options[toSelect.selectedIndex].value);
    var window = windowTo - windowFrom;
    var lenghtArea = 800;
    var heightArea = 100;
    var plotStep = 100;
    var firstLinePosition = 0;
    var ratio = lenghtArea / window;
    if ( window > 1100 & window <= 3000){
	plotStep = 200;
    } else if ( window > 3000 ){
	plotStep = 500;
    }
    if (windowTo == 100){
	firstLinePosition = windowTo * ratio;
	window = window - 100;
    }
    // Create a function that will receive data sent from the server
    ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
	    var ajaxDisplay = document.getElementById('plotGene');
	    document.getElementById('canvas').innerHTML = '';
	    ajaxDisplay.innerHTML = ajaxRequest.responseText;
	    wait.style.display = 'none';
	    outdiv.style.display = 'block';
	    canvas.style.display = 'block';
	    // Start plotting:
	    var paper = new Raphael(document.getElementById('canvas'), lenghtArea, heightArea);
	    // Draw central black line:
	    var str1 = "M 0 49 l ";
	    var genomeStr = str1.concat(lenghtArea, " 0 l 0 2 l -", lenghtArea, " 0 z");
	    //var genome = paper.path("M 0 49 l 800 0 l 0 2 l -800 0 z");
	    var genome = paper.path(genomeStr);
	    genome.attr({fill: '#000000'});
	    // Draw TSS arrow
	    str1 = "M ";
	    var tssStr = str1.concat(lenghtArea - (windowTo * ratio), " 50 l 0 -10 l 20 0 l -5 -5 l 0 10 l 5 -5 l -20 0 z");
	    //var tss = paper.path("M 720 50 l 0 -10 l 20 0 l -5 -5 l 0 10 l 5 -5 l -20 0 z");
	    var tss = paper.path(tssStr);
	    tss.attr({fill: '#000000'});
	    // Draw vertica lines at defined intervals
	    var s_pos = lenghtArea - firstLinePosition;
	    var real_pos = window;
	    while (s_pos >= 0){
		var ms = paper.rect(s_pos, 0, 1, heightArea);
		ms.attr({opacity: 0.1, fill: '#F0F0F0'}).toBack();
		var r_pos = real_pos + windowFrom;
		var text = paper.text(s_pos, heightArea - 5, r_pos);
		text.attr({fill: '#C0C0C0'});
		s_pos = s_pos - (plotStep * ratio);
		real_pos = real_pos - plotStep;
	    }

	    // Draw gene:
	    str1 = "M ";
	    var geneStr = str1.concat(lenghtArea - (windowTo * ratio), " 40 l ", windowTo * ratio, " 0 l 0 20 l -", windowTo * ratio, " 0 z");
	    // var gene = paper.path("M 720 40 l 80 0 l 0 20 l -80 0 z");
	    var gene = paper.path(geneStr);
	    gene.attr({opacity: 0.2, fill: 'blue', stroke: 'none'});

	    // Draw TFBS:
	    var from_long = document.getElementById('p_from').innerHTML;
	    var to_long = document.getElementById('p_to').innerHTML;
	    var level_long = document.getElementById('p_level').innerHTML;
	    var from = from_long.split("_");
	    var to = to_long.split("_");
	    var level = level_long.split("_");
	    // reset the variables:
	    document.getElementById('pgene').remove();

	    var myRegExp = /_/;
	    var matchPos1 = from_long.search(myRegExp);

	    var tf;
	    if(matchPos1 != -1){
		var x;
		for (x in from){
		    tf = paper.rect(from[x] * ratio, 45, to[x] * ratio, 10);
		    tf.attr({opacity: 1, fill: '#FF0000'});
		}
	    } else{
		tf = paper.rect(from[0] * ratio, 45, to[0] * ratio, 10);
		tf.attr({opacity: 1, fill: '#FF0000'});
	    }
	}
    } //END ajaxRequest.onreadystatechange function

    var library = document.getElementById("motifLibrary");
    var chosenLib = library.options[library.selectedIndex].value;
    var gene_id = document.getElementById('p_gene_id').value;
    var database = document.getElementById('p_database').value;
    //var tf = document.getElementById('p_tf').value;
    var coOpt = document.getElementById("motifCutoff");
    var co = coOpt.options[coOpt.selectedIndex].value;
    var tfNames = document.getElementById("p_tf");
    var tf = tfNames.options[tfNames.selectedIndex].value;
    var tfName = tfNames.options[tfNames.selectedIndex].text;
    var myRegE = /--/;
    var checkLib = chosenLib.search(myRegE);
    if(checkLib != 0){
       var queryString = "?database=" + database + "&gene_id=" + gene_id + "&tf=" + tf + "&from=" + windowFrom  + "&to=" + windowTo + "&motif_lib=" + chosenLib + "&tfname=" + tfName + "&co=" + co;
       ajaxRequest.open("GET", "/cgi-bin/miniepd/plot_gene.php" + queryString, true);
       ajaxRequest.send(null);
    } else{
    alert("Please Select a library and a motif");
    wait.style.display = 'none';
    }
}

  </script>

<script src="/miniepd/scripts/showads-24022023.min.js"></script>
<script language='javascript' type='text/javascript' src='/miniepd/scripts/epd.min.js'></script>
</head>

<body onload="getUCSCpicture(); expressionProfile(600); ">

<?php
#print "$db";

include("left_menu.php");
#include("header.php");

# Connect to the database
$db_con = mysqli_connect("127.0.0.1","ccgweb","ccgweb",$database);
  /* check connection */
if (!$db_con){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

# Get promoter coordinates / properties
$query = "SELECT promoter_coordinate.chromosome, promoter_coordinate.position, promoter_coordinate.strand, promoter_coordinate.organism, promoter_coordinate.type, gene_description.gene_name, gene_description.description, promoter_sequence.sequence FROM promoter_coordinate LEFT JOIN (gene_description, promoter_sequence) ON (promoter_coordinate.id = gene_description.ID AND promoter_coordinate.id = promoter_sequence.id) WHERE promoter_coordinate.id LIKE '$id'";
#echo "$query<br>";
if ($stmt = $db_con->prepare("$query")) {
  $stmt->execute();
  $stmt->bind_result($chromosome, $position, $strand, $organism, $type, $genename, $description, $sequence);
  $stmt->fetch();
  $stmt->close();
} else{
  echo "<span style='color: red;'>Error in the first query!</span><br />";
}
#print "$db";

# Get UCSC start and stop positions:
$begin = $position - 2000;
$end   = $position + 2000;
$query = "SELECT chromosome FROM promoter_ucsc WHERE id LIKE '$id' AND assembly LIKE '$assembly'";
if ($stmt = $db_con->prepare("$query")) {
  $stmt->execute();
  $stmt->bind_result($ucscChr);
  $stmt->fetch();
  $stmt->close();
} else{
  echo "<span style='color: red;'>Error in the UCSC query!</span><br />";
}

#print "$db";

# $link = getUcscLink($organism, $ucscChr, $begin, $end, $assembly, FALSE);

######################################################################
?>

<!--<div style='color: red; font-family:"Courier New"; padding-bottom: 10px;'>
Due to maintenance activity, EPD Website may not be fully operational.
We apologize for the inconvenience and thank you for your understanding.</div>
-->

<!-- Section tabs: first one shown by default -->
<div class="epd-tab">
    <button class="epd-tablinks" onclick="openSectionTab(event, 'General')">General Information</button>
<!--    <button class="epd-tablinks" onclick="openSectionTab(event, 'Snapshot')">Browser Snapshot</button>-->
    <button class="epd-tablinks" onclick="openSectionTab(event, 'Viewers')">Viewers</button>
    <button class="epd-tablinks" onclick="openSectionTab(event, 'Sequence')">Sequence Retrieval</button>
    <button class="epd-tablinks" onclick="openSectionTab(event, 'Motif')">Motif Search</button>
    <button class="epd-tablinks" onclick="openSectionTab(event, 'Expression')">Expression Profile</button>
</div>

<?php
######################################################################
# Print General Info:

echo "<div id='General' class='epd-tabcontent'>\n";
echo "<table width='100%'>\n";
echo "<tr align='left'><td width='150px'>Promoter ID:</td><td><b>$id</b></td></tr>\n";
echo "<tr align='left'><td>Promoter type:</td><td>$type</td></tr>\n";
echo "<tr align='left'><td>Organism:</td><td>$organism</td></tr>\n";
echo "<tr align='left'><td>Gene Symbol:</td><td>$genename</td></tr>\n";
echo "<tr align='left'><td>Description of the gene:</td><td>$description</td></tr>\n";
echo "<tr align='left'><td>Sequence:</td><td>$sequence</td></tr>\n";
echo "<tr align='left'><td>Position in the genome:</td><td>Chromosome [$chromosome]; Strand [$strand]; Position [$position]</td></tr>\n";

# Get ENSEMBL ID
$query = "SELECT ensembl_id FROM promoter_ensembl WHERE id LIKE '$id'";
if ($stmt = $db_con->prepare("$query")) {
  $stmt->execute();
  $stmt->bind_result($ensembl);
  while ($stmt->fetch()) {
    if (preg_match("/at/",$db)){
      print "<tr align='left'><td>TAIR:</td>\n";
      print "<td><a href =\"";
      print "https://www.arabidopsis.org/servlets/Search?type=general&search_action=detail&method=1&show_obsolete=F&name=";
      print "$ensembl";
      print "&sub_type=gene&SEARCH_EXACT=4&SEARCH_CONTAINS=1\" target='_blank'>$ensembl</a></td></tr>";

    } else if (preg_match("/zm/",$db)){
      print "<tr align='left'><td>GRAMENE:</td>\n";
      print "<td><a href =\"";
      print "http://ensembl.gramene.org/Zea_mays/Gene/Summary?g=";
      print "$ensembl";
      print "\" target='_blank'>$ensembl</a></td></tr>";

    } else if (preg_match("/am/",$db)){
      print "<tr align='left'><td>BEEBASE:</td>\n";
      print "<td><a href =\"";
      print "http://metazoa.ensembl.org/Apis_mellifera/Gene/Summary?db=core;g=";
      print "$ensembl";
      print "\" target='_blank'>$ensembl</a></td></tr>";

    } else if (preg_match("/sp/",$db)){
      print "<tr align='left'><td>Pombase:</td>\n";
      print "<td><a href =\"";
      print "http://www.pombase.org/spombe/result/";
      print "$ensembl";
      print "\" target='_blank'>$ensembl</a></td></tr>";
      print "";
    } else if (preg_match("/ce/",$db)){
      print "<tr align='left'><td>WormBase:</td>\n";
      print "<td><a href =\"";
      print "http://www.wormbase.org/species/c_elegans/gene/";
      print "$ensembl";
      print "\" target='_blank'>$ensembl</a></td></tr>";
      print "";
    } else if (preg_match("/dm/",$db)){
      print "<tr align='left'><td>FlyBase:</td>\n";
      print "<td><a href ='";
      print "http://flybase.org/reports/";
      print "$ensembl";
      print ".html' target='_blank'>$ensembl</a></td></tr>";
      print "";
    } else if (preg_match("/pf/",$db)){
      print "<tr align='left'><td>Ensembl:</td>\n";
      print "<td><a href =\"";
      print "https://protists.ensembl.org/$specie/Gene/Summary?g=";
      print "$ensembl";
      print "\" target='_blank'>$ensembl</a></td></tr>";
    } else {
      print "<tr align='left'><td>Ensembl:</td>\n";
      print "<td><a href =\"";
      print "https://www.ensembl.org/$specie/Gene/Summary?g=";
      print "$ensembl";
      print "\" target='_blank'>$ensembl</a></td></tr>";
    }

  }
  $stmt->close();
} else{
  echo "<span style='color: red;'>Error in the Ensembl query!</span><br />";
}

# Get RefSeq ID
if (preg_match("/at/",$db)){
  $query = "SELECT refseq_id FROM cross_references WHERE gene_name LIKE '$ensembl'";
} else{
  $query = "SELECT refseq_id FROM cross_references WHERE gene_name LIKE '$genename'";
}
if ($stmt = $db_con->prepare("$query")) {
  $stmt->execute();
  $stmt->bind_result($refseq);
  while ($stmt->fetch()) {
    # ! can happen several times, e.g. for non-coding mouse release
    if($refseq === '') {  continue; }
    # get rid of version number in some refSeq:
    $rseq = preg_replace('/\.[0-9]+$/', '', $refseq);
    print "<tr align='left'><td>RefSeq:</td>\n";
    print "<td><a href =\"";
    print "http://www.ncbi.nlm.nih.gov/nuccore/";
    print "$refseq";
    print "\" target='_blank'>$rseq</a></td></tr>";
  }
  $stmt->close();
} else{
  echo "<span style='color: red;'>Error in the RefSeq query!</span><br />";
}

# NCBI Gene link:
if ($refseq != ""){
  $ncbi_con = mysqli_connect("127.0.0.1","ccgweb","ccgweb","ncbiGene");
  $query = "SELECT geneId FROM refseqToGene WHERE refseqId LIKE '$rseq'";
  if ($stmt = $ncbi_con->prepare("$query")) {
    $stmt->execute();
    $stmt->bind_result($geneId);
    while ($stmt->fetch()) {
      print "<tr align='left'><td>NCBI Gene:</td>\n";
      print "<td><a href =\"";
      print 'http://www.ncbi.nlm.nih.gov/gene/'.$geneId;
      print "\" target='_blank'>$genename</a></td></tr>";
    }
  }
  $ncbi_con->close();
}

# GeneCards link:
if (preg_match("/hg/",$db)){
  print "<tr align='left'><td>GeneCards:</td>\n";
  print "<td><a href =\"";
  print "https://www.genecards.org/cgi-bin/carddisp.pl?gene=";
  print "$genename";
  print "\" target='_blank'>$genename</a></td></tr>";
}

# echo "</table></div>\n";
echo "</table><br />\n";

######################################################################
# Print Promoter Viewer:

if ( preg_match("/Homo/",$specie) || preg_match("/Mac/",$specie) || preg_match("/Mus/",$specie) || preg_match("/Rat/",$specie)  || preg_match("/Canis/",$specie) || preg_match("/Gal/",$specie) || preg_match("/Drosophila/",$specie) || preg_match("/Danio/",$specie) || preg_match("/Cae/",$specie) || preg_match("/Sac/",$specie) || preg_match("/Ara/",$specie) || preg_match("/Zea/",$specie) || preg_match("/pombe/",$specie) || preg_match("/mellifera/",$specie) || preg_match("/falciparum/", $specie) ){
  $query = "SELECT assembly, chromosome, prsition FROM promoter_ucsc WHERE id LIKE '$id' AND assembly LIKE '$assembly'";
  if ($stmt = $db_con->prepare("$query")) {
    $stmt->execute();
    $stmt->bind_result($ucscAssembly, $ucscChr, $ucscPos);
    while ($stmt->fetch()) {
      $ucscBegin = $ucscPos - 2000;
      $ucscEnd = $ucscPos + 2000;
    }
    $stmt->close();
  } else{
    echo "<span style='color: red;'>Error in the UCSC query in external resources! </span><br />";
  }

#  echo "<div id='Snapshot' class='epd-tabcontent'>\n";

  # UCSC link for the "Promoter image" section
  $link = getUcscLink($organism, $ucscChr, $ucscBegin, $ucscEnd, $ucscAssembly, FALSE);
  echo "  <div style='display:none; width: 800px;' id='loadingUcsc'>\n";
  echo "  <p><img src='/img_epd/ajax-loader.gif' /> </p> </div>\n";
  echo "  <div id='pid' style='display:none;' value='$id'></div>\n";
  echo "  <div id='strand' style='display:none;' value='$strand'></div>\n";
  echo "  <div id='chr' style='display:none;' value='$ucscChr'></div>\n";
  echo "  <div id='specie' style='display:none;' value='$specie'></div>\n";
  echo "  <div id='pos' style='display:none;' value='$ucscPos'></div>\n";
  echo "  <div id='assembly' style='display:none;' value='$assembly'></div>\n";
  echo "  <div id='did' style='display:none;' value='$newdb'></div>\n";

  echo "  <div><a title='Go to the EPD Hub at UCSC' id='ucscpicture'
  style='display:none;' href ='";
  echo $link;
  echo "' target='_blank'></a></div>\n";
#  echo "</td></tr>\n";

}

#echo "</table>\n";
echo "</div>\n";

######################################################################
# Print the Viewers' section

echo "<div id='Viewers' class='epd-tabcontent'>\n";
$select_viewer_help_displayed = false;
if($db === 'hg' or $db === 'hsNC') {

    echo "<table style='max-width: 100%; border: 0px solid gray'>\n";

    $query = "SELECT assembly, chromosome, prsition FROM promoter_ucsc WHERE id LIKE '$id'";
    if ($stmt = $db_con->prepare("$query")) {
        $stmt->execute();
        $stmt->bind_result($ucscAssembly, $ucscChr, $ucscPos);
        while ($stmt->fetch()) {
            $ucscBegin = $ucscPos - 2000;
            $ucscEnd = $ucscPos + 2000;
            echo "<tr class='epd-viewer'>\n";
            echo "<td class='epd-assembly'>$ucscAssembly</td>\n";

            $ucsc_link = getUcscLink($organism, $ucscChr, $ucscBegin, $ucscEnd, $ucscAssembly, FALSE);
            $us_link = getUSLink($ucsc_link);
            $ucsc_specific_link;
            $us_specific_link;

            $ucsc_gm12878_link;
            $us_gm12878_link;
            if($ucscAssembly === 'hg19') {
                $ucsc_gm12878_link = getGM12878UcscLink($id, $ucscChr, $ucscBegin, $ucscEnd, $ucscAssembly);
                $us_gm12878_link = getUSLink($ucsc_gm12878_link);
            }

            # Viewers on the US server
            echo "<td style='max-width: 420px;'>\n";
            echo "<b>UCSC (US server)</b>:<br />";
            echo "<a href='$us_link' onclick='openUCSC(\"$us_link\", \"ucsc\");return false;'>Generic EPD viewer</a> ($ucscChr:$ucscBegin-$ucscEnd)";
            $ucsc_specific_link = getSpecificUcscLink($id, $ucscChr, $ucscBegin, $ucscEnd, $ucscAssembly);
            $us_specific_link = getUSLink($ucsc_specific_link);
            if($us_specific_link) { # should always be true
                echo "<br /><a href =\"$us_specific_link\" onclick='openUCSC(\"$us_specific_link\", \"ucsc-specific\");return false;'>Selective viewer</a>\n";
                if(! $select_viewer_help_displayed) {
                    $select_viewer_help_displayed = true;
                    echo " (shows the 3 Fantom5 tracks with the highest expression of <b>$id</b>)\n";
                }
            }

            if($ucscAssembly === 'hg19') {
                echo "<br /><a href =\"$us_gm12878_link\" onclick='openUCSC(\"$us_gm12878_link\", \"ucsc\");return false;'>GM12878 viewer</a>\n";
            }
            echo "</td>\n";

            # Viewers on the European mirror
            echo "<td style='max-width: 420px;'>\n";
            echo "<b>UCSC (European mirror)</b>:<br />\n";
            echo "<a href='$ucsc_link' onclick='openUCSC(\"$us_link\", \"ucsc\");return false;'>Generic EPD viewer</a> ($ucscChr:$ucscBegin-$ucscEnd)\n";
            if($ucsc_specific_link) { # should always be true
                echo "<br /><a href =\"$ucsc_specific_link\" onclick='openUCSC(\"$ucsc_specific_link\", \"ucsc-specific\");return false;'>Selective viewer</a>\n";
                if(! $select_viewer_help_displayed) {
                    $select_viewer_help_displayed = true;
                    echo " showing the 3 Fantom5 tracks with the highest expression of <b>$id</b>\n";
                }
            }

            if($ucscAssembly === 'hg19') {
                echo "<br /><a href =\"$ucsc_gm12878_link\" onclick='openUCSC(\"$ucsc_gm12878_link\", \"ucsc\");return false;'>GM12878 viewer</a>\n";
            }
            echo "</td>\n";
            echo "</tr>\n";
        }
    }

    # FANTOM 5 link
    echo "<tr>\n";
    echo "<td class='epd-assembly'>hg38</td>";
    echo "<td><a href =\"";
    echo "http://fantom.gsc.riken.jp/zenbu/gLyphs/#config=338Jp369HlMrduGQJmN3-B;loc=hg38::\n";
    echo "$ucscChr:$begin..$end+";
    echo "\" target='_blank'><b>FANTOM5</b></a></td></tr>\n";

# Species other than human ##################################################
} else {

    echo "<table width='100%'>\n";
    echo "<tr align='left' style='background-color:#CEE3F6;'>\n";
    echo "<td align='left' colspan='2'><h2>Other viewers</h2></td>\n";
    echo "<td align='right'><a href='/EPDnew_database.php#externalResources'>[Help]</a></td></tr>\n";

    # UCSC browser link for the "Other viewers" section
    $query = "SELECT assembly, chromosome, prsition FROM promoter_ucsc WHERE id LIKE '$id'";
    if ($stmt = $db_con->prepare("$query")) {
      $stmt->execute();
      $stmt->bind_result($ucscAssembly, $ucscChr, $ucscPos);
      while ($stmt->fetch()) {
        $ucscBegin = $ucscPos - 2000;
        $ucscEnd = $ucscPos + 2000;
        echo "<tr style='text-align: left;'><td style='width: 150px;'>EPD view at UCSC ($ucscAssembly):</td>\n";

        # UCSC links
        $ucsc_link = getUcscLink($organism, $ucscChr, $ucscBegin, $ucscEnd, $ucscAssembly, FALSE);
        $us_link = getUSLink($ucsc_link);
        echo "<td style='width:300px;'><a href =\"$us_link\" onclick='openUCSC(\"$us_link\", \"ucsc\");return false;'>$ucscChr:$ucscBegin-$ucscEnd</a>";
        echo "&nbsp;&nbsp;(<a href =\"$ucsc_link\" onclick='openUCSC(\"$ucsc_link\", \"ucsc\");return false;'>European mirror</a>)</td>\n";

        # Add a link to a viewer with the 3 tracks where promoter is most expressed
        # are displayed by default, using precomputed session files
        # Only available for hg38 and mm10
        if($ucscAssembly === "mm10") {
            $ucsc_specific_link = getSpecificUcscLink($id, $ucscChr, $ucscBegin, $ucscEnd, $ucscAssembly);
            $us_specific_link = getUSLink($ucsc_specific_link);
            if($ucsc_specific_link) { # should always be true
                echo "<td><a href =\"$us_specific_link\" onclick='openUCSC(\"$us_specific_link\", \"ucsc-specific\");return false;'>Selective viewer</a> showing the 3 Fantom5 tracks with the highest expression of <b>$id</b>&nbsp;&nbsp;(<a href =\"$ucsc_specific_link\" onclick='openUCSC(\"$ucsc_specific_link\", \"ucsc-specific\");return false;'>European mirror</a>)</td>\n";
            }
        }
        echo "</tr>\n";
      }
      $stmt->close();
    } else{
      echo "<span style='color: red;'>Error in the UCSC query in external resources!</span><br />";
    }
}

if (preg_match("/Mus/",$organism)){
   print "<tr align='left'><td>SwissRegulon:</td>\n";
   print "<td><a href =\"";
   print "http://www.swissregulon.unibas.ch/jbrowse/JBrowse/?data=mm9\n";
   print "&loc=$ucscChr:$begin..$end&tracks=DNA,refseq_transcripts,tfbs,TSC,TSS,promoters";
   print "\" target='_blank'>$ucscChr:$begin-$end</a></td></tr>\n";
 }

# FANTOM 5 link
if (preg_match("/Mus/",$organism)){
    print "<tr align='left'><td>FANTOM5:</td>\n";
    print "<td><a href =\"";
    print "http://fantom.gsc.riken.jp/zenbu/gLyphs/#config=qlHuP2o9KFFqPk1n7Mcui;loc=mm10::\n";
    print "$ucscChr:$begin..$end+";
    print "\" target='_blank'>$ucscChr:$begin-$end</a></td></tr>\n";
}

echo "</table>\n";
echo "</div>\n";

######################################################################
# Retrieve sequence:

echo "<div id='Sequence' class='epd-tabcontent'>\n";
echo "<table width='100%'>\n";
echo "<tr align='left'><td align='left' colspan='2'>\n";
echo "<form name='myForm'>\n";
echo "<input type='hidden' id='gene_id' value='$id'>\n";
echo "<input type='hidden' id='database' value='$dbOld'>\n";
echo "<table><tr><td style='padding: 0px;'>\n";
echo "Get sequence $id <b>from</b> <input type='text' size='6' id='from' value='-499'/> <b>to</b> <input type='text' size='6' id='to' value='100' />  bp relative to TSS  \n";
echo "</td><td rowspan='2'>";
echo "<input type='button' onclick=\"getSequence();\" value='Get sequence'  class='epdsubmitsmall' />\n";
echo "</td></tr><tr><td style='padding: 0px;'>\n";
echo "<input type='checkbox' id='lc' value='1'>lower case upstream TSS\n";
echo "</td></tr></table>\n";
echo "</form>\n";
echo "</td></tr>\n";
echo "<tr align='left'><td align='left' colspan='2'>\n";
echo "<div style='display:none;' id='loading'>\n";
echo "<p><img src='/img_epd/ajax-loader.gif' /> </p> </div>\n";
echo "<font face='Courier New'><div id='ajaxDiv' style='display:none;'></div></font>\n";
echo "</td></tr>\n";
echo "</table></div>\n";

######################################################################
# Search for motif:
echo "<div id='Motif' class='epd-tabcontent'>\n";
echo "<table width='100%'>\n";
echo "<tr align='left'><td align='left'>\n";
echo "<form name='plotgene'>\n";
echo "<input type='hidden' id='p_gene_id' value='$id'>\n";
echo "<input type='hidden' id='p_database' value='$dbOld'>\n";
$u_agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($u_agent, 'Chrome') || strpos($u_agent, 'Safari')) {
    echo "Library: <select onchange='makeMenu()' id='motifLibrary' class='epdquery' style='width:210px;'>\n";
} else {
    echo "Library: <select onclick='makeMenu()' id='motifLibrary' class='epdquery' style='width:210px;'>\n";
}
echo "<option disabled selected> -- Select Motif Library -- </option>\n";
if ( preg_match("/Homo/",$specie) || preg_match("/Mac/",$specie) || preg_match("/Rat/",$specie) || preg_match("/Mus/",$specie) || preg_match("/Gal/",$specie) || preg_match("/Canis/",$specie) || preg_match("/Danio/",$specie) ){
  echo "<option value='jasparCoreVertebrates'>Transcription Factor Motifs (JASPAR CORE 2018 vertebrates)</option>\n";
} else if ( preg_match("/Drosophila/",$specie) || preg_match("/mellifera/",$specie) ){
  echo "<option value='jasparCoreInsects'>Transcription Factor Motifs (JASPAR CORE 2018 Insects)</option>\n";
} else if ( preg_match("/Ara/",$specie) || preg_match("/Zea/",$specie) ){
  echo "<option value='jasparCorePlants'>Transcription Factor Motifs (JASPAR CORE 2018 Plants)</option>\n";
} else if ( preg_match("/Cae/",$specie) ){
  echo "<option value='uniprobeWorm'>Transcription Factor Motifs (UniPROBE Worm)</option>\n";
} else if (  preg_match("/Sac/",$specie) || preg_match("/pombe/",$specie) ){
  echo "<option value='swissRegulonYeast'>Transcription Factor Motifs (SwissRegulon Yeast)</option>\n";
}
echo "<option value='promoter'>Promoter Motifs</option>\n";
echo "</select>\n";
echo "Motif: <select id='p_tf'  class='epdquery' style='width:200px;'>\n";
echo "<option disabled selected> -- Select Motif -- </option>\n";
echo "</select></td><td><div id='libType'></div></td></tr>\n";
echo "<tr><td>From: <select id='plotFrom'  class='epdquery' style='width:60px;'>\n";
echo "<optgroup>\n";
echo "<option value='-1000'>-1000</option>\n";
echo "<option value='-2000'>-2000</option>\n";
echo "<option value='-5000'>-5000</option>\n";
echo "</optgroup>\n";
echo "</select>\n";
echo "To: <select id='plotTo'  class='epdquery' style='width:60px;'>\n";
echo "<optgroup>\n";
echo "<option value='100'>100</option>\n";
echo "<option value='1000'>1000</option>\n";
echo "</optgroup>\n";
echo "</select>  bp relative to TSS ";
echo "and a cut-off (p-value) of: <select id='motifCutoff'  class='epdquery' style='width:80px;'>\n";
echo "<option value='0.01'>0.01</option>\n";
echo "<option value='0.001' selected>0.001</option>\n";
echo "<option value='0.0001'>0.0001</option>\n";
echo "<option value='0.00001'>0.00001</option>\n";
echo "</select>\n";
echo "<input type='button' onclick='plotGene()' value='Search'  class='epdsubmitsmall' />\n";
echo "</form>\n";
echo "</td></tr>\n";
echo "<tr align='left' style='height:200px;'><td style=' vertical-align: text-top;' colspan='2'>\n";
echo "<div style='display:none;' id='loading_gene'>\n";
echo "<p><img src='/img_epd/ajax-loader.gif' /> </p> </div>\n";
echo "<div id='canvas' style='display:none; width:800px; background-color:#fff; border: 1px solid #aaa; overflow-x: auto;'></div>\n";
echo "<FONT FACE='Courier New'><div id='plotGene'  style='display:none;'></div></FONT>\n";
echo "</td></tr>\n";

echo "</table></div>\n";

######################################################################
# Expression profiles:

echo "<div id='Expression' class='epd-tabcontent'>\n";
echo "<div id='expressionDiv'></div>";
echo "<div id='expressionCanvas' style='display:none; width:600px; background-color:#fff; border: 1px solid #aaa; overflow-x: auto;'></div>\n";
echo "<p><div id='expressionSamples' style='overflow:auto; max-height:300px'></div></p>\n";
echo "<div style='display:block;' id='expressionLoadingDiv'>\n";
echo "<p><img src='/img_epd/ajax-loader.gif' /></p></div>\n";
#echo "</tr>\n";
#echo "</table>\n";
echo "</div>\n";

$db_con->close();

readfile("./footer.html");

?>
