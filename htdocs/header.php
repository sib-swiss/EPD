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
  <meta name="dcterms.rights" content="EPD copyright 2011">
  <meta name="keywords" content="Promoter,Eukaryotic,promoter database,promoter analysis">
  <meta name="description" content="EPD The Eukaryotic Promoter Database, knowledgebase and tools">
  <meta name="viewport" content="width=device-width,initial-scale=1,height=device-height">
  <link rel="stylesheet" href="/css_epd/sib-expasy.min-20240214.css" type="text/css" media="screen" />
  <link rel="shortcut icon" href="/img_epd/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="/css_epd/search.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="/css_epd/jquery-ui-1.13.2.min.css" />
  <link rel="stylesheet" href="/miniepd/stylesheets/epd-24022023.min.css" />
  <script src="/js_epd/jquery-3.6.3.min.js"></script>
  <script src="/js_epd/jquery-ui-1.13.2.min.js"></script>

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
    /* background-color: yellow; */
    }

    /* loading - the AJAX indicator */
    .ui-autocomplete-loading {
    background: url('/ajax-loader.gif') right center no-repeat;
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
    font-size: 14px;
    }

    /* IE 6 doesn't support max-height
    * we use height instead, but this forces the menu to always be this tall
    */
    * html .ui-autocomplete {
    height: 250px;
    }
  #bluesky a {
    position: absolute;
    display: inline;
    right: 60px;
    top: 77px;
    padding: 0;
    cursor: pointer;
    z-index: 99;
  }
  #mastodon a {
    position: absolute;
    display: inline;
    right: 35px;
    top: 77px;
    padding: 0;
    cursor: pointer;
    z-index: 99;
  }
  #xtwitter a {
    position: absolute;
    display: inline;
    right: 10px;
    top: 77px;
    padding: 0;
    cursor: pointer;
    z-index: 99;
  }
</style>

<!-- script>
  $(document).ready(function() {
      $(".newstable").shorten();
    });
</script -->

  <script src='/miniepd/scripts/raphael-2.1.0.min.js'></script>
  <script src='/miniepd/scripts/check_form-24022023.min.js'></script>
  <script src="/js_epd/jquery.easing-1.4.2.min.js"></script>
  <script src='/miniepd/scripts/epd.min.js'></script>

  <script src="/miniepd/scripts/showads-24022023.min.js"></script>

<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@id": "https://epd.expasy.org/epd/",
    "@type": "DataCatalog",
    "description": "The Eukaryotic Promoter Database (EPD) is a set of species-specific databases of experimentally validated promoters",
    "keywords": "next-generation sequencing, genome annotation, promoter",
    "name": "EPDnew - Eukaryotic Promoter Database",
    "url": "https://epd.expasy.org/",
    "isAccessibleForFree" : true,
    "license": {
      "@type": "CreativeWork",
      "name": "Attribution 4.0 International (CC BY 4.0)",
      "url": "https://creativecommons.org/licenses/by/4.0/"
    },
    "citation": [
      {
        "@id": "https://doi.org/10.1093/nar/gkz1014",
        "@type": "ScholarlyArticle",
        "headline": "EPD in 2020: enhanced data visualization and extension to ncRNA promoters",
        "author": [
          {"@type": "Person", "givenName": "Patrick",  "familyName": "Meylan",    "identifier": "https://orcid.org/0000-0001-8244-7065"},
          {"@type": "Person", "givenName": "René",    "familyName": "Dreos",     "identifier": "https://orcid.org/0000-0002-0816-7775"},
          {"@type": "Person", "givenName": "Giovanna", "familyName": "Ambrosini", "identifier": "https://orcid.org/0000-0003-1294-6541"},
          {"@type": "Person", "givenName": "Romain",   "familyName": "Groux",     "identifier": "https://orcid.org/0000-0001-9907-7451"},
          {"@type": "Person", "givenName": "Philipp",  "familyName": "Bucher",    "identifier": "https://orcid.org/0000-0003-4824-885X"}
        ],
        "datePublished": "2019-11-04"
      }
    ],
    "hasPart" : [
        {
          "@type": "Dataset",
          "name": "H. sapiens",
          "description": "hsEPDnew, the Homo sapiens (human) curated promoter database.",
          "url": "https://epd.expasy.org/epd/human/human_database.php?db=human",
          "isAccessibleForFree" : true,
          "isBasedOn": [
          {
            "@type": "CreativeWork",
            "name": "Riken/ENCODE CAGE data downloaded from UCSC."
          },
          {
            "@type": "CreativeWork",
            "name": "FANTOM5 data."
          },
          {
            "@type": "CreativeWork",
            "name": "Rampage data."
          },
          {
            "@type": "CreativeWork",
            "name": "EPD."
          }
          ],
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "H. sapiens non-coding",
          "description": "hsEPDnewNC, the Homo sapiens (human) curated non-coding promoter database.",
          "url": "https://epd.expasy.org/epd/human_nc/human_nc_database.php?db=human_nc",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "M. mulatta",
          "description": "rmEPDnew, the Macaca mulatta (rhesus macaque) curated promoter database.",
          "url": "https://epd.expasy.org/epd/M_mulatta/M_mulatta_database.php?db=M_mulatta",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "M. musculus",
          "description": "mmEPDnew, the Mus musculus (mouse) curated promoter database.",
          "url": "https://epd.expasy.org/epd/mouse/mouse_database.php?db=mouse",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "M. musculus non-coding",
          "description": "mmEPDnewNC, the Mus musculus (mouse) curated non-coding promoter database.",
          "url": "https://epd.expasy.org/epd/mouse_nc/mouse_nc_database.php?db=mouse_nc",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "R. norvegicus",
          "description": "rnEPDnew, the Rattus Norvegicus (rat) curated promoter database.",
          "url": "https://epd.expasy.org/epd/R_norvegicus/R_norvegicus_database.php?db=R_norvegicus",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "C. familiaris",
          "description": "cfEPDnew, the Canis familiaris (dog) curated promoter database.",
          "url": "https://epd.expasy.org/epd/C_familiaris/C_familiaris_database.php?db=C_familiaris",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "G. gallus",
          "description": "ggEPDnew, the Gallus gallus (chicken) curated promoter database.",
          "url": "https://epd.expasy.org/epd/G_gallus/G_gallus_database.php?db=G_gallus",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "D. melanogaster",
          "description": "dmEPDnew, the Drosophila melanogaster (fruit fly) curated promoter database.",
          "url": "https://epd.expasy.org/epd/drosophila/drosophila_database.php?db=drosophila",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "A. mellifera",
          "description": "amEPDnew, the Apis mellifera (honey bee) curated promoter database.",
          "url": "https://epd.expasy.org/epd/A_mellifera/A_mellifera_database.php?db=A_mellifera",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "D. rerio",
          "description": "drEPDnew, the Danio rerio (zebrafish) curated promoter database.",
          "url": "https://epd.expasy.org/epd/zebrafish/zebrafish_database.php?db=zebrafish",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "C. elegans",
          "description": "ceEPDnew, the Caenorhabditis elegans curated promoter database.",
          "url": "https://epd.expasy.org/epd/worm/worm_database.php?db=worm",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "A. thaliana",
          "description": "atEPDnew, the Arabidopsis thaliana (thale cress) curated promoter database.",
          "url": "https://epd.expasy.org/epd/arabidopsis/arabidopsis_database.php?db=arabidopsis",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "Z. mays",
          "description": "zmEPDnew, the Zea mays (corn) curated promoter database.",
          "url": "https://epd.expasy.org/epd/Z_mays/Z_mays_database.php?db=Z_mays",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "H_vulgare",
          "description": "hvEPDnew, the Hordeum vulgare (barley) curated promoter database.",
          "url": "https://epd.expasy.org/epd/H_vulgare/H_vulgare_database.php?db=H_vulgare",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "S. cerevisiae",
          "description": "scEPDnew, the Saccharomyces cerevisiae (baking yeast) curated promoter database.",
          "url": "https://epd.expasy.org/epd/S_cerevisiae/S_cerevisiae_database.php?db=S_cerevisiae",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "S. pombe",
          "description": "spEPDnew, the Schizosaccharomyces pombe (fission yeast) curated promoter database.",
          "url": "https://epd.expasy.org/epd/S_pombe/S_pombe_database.php?db=S_pombe",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        },
        {
          "@type": "Dataset",
          "name": "P. falciparum",
          "description": "pfEPDnew, the Plasmodium falciparum 3D7 curated promoter database.",
          "url": "https://epd.expasy.org/epd/P_falciparum/P_falciparum_database.php?db=P_falciparum",
          "isAccessibleForFree" : true,
          "license": {
            "@type": "CreativeWork",
            "name": "Attribution 4.0 International (CC BY 4.0)",
            "url": "https://creativecommons.org/licenses/by/4.0/"
          },
          "creator": [
            {
              "@type": "Person",
              "name": "The EPD team"
            }
          ],
        }
    ]
}
</script>
</head>
<body>

<?php include("url_extern.php"); ?>

  <div id='sib_top'><a id='TOP'></a></div>
  <div id='sib_container'>

<div id="bluesky">
  <a href="https://bsky.app/profile/EPD.mstdn.science.ap.brid.gy"><img src="/img_epd/Bluesky_Logo.png" alt="Bluesky logo" width="23" height="20" style="vertical-align:middle"></a>
</div>
<div id="mastodon">
  <a href="https://mstdn.science/@EPD"><img src="/img_epd/Mastodon-Logo.png" alt="Mastodon logo" width="23" height="23" style="vertical-align:middle"></a>
</div>
<div id="xtwitter">
  <a href="https://twitter.com/EPD_SIB"><img src="/img_epd/twitter_X_logo.png" alt="Twitter logo" width="21" height="20" style="vertical-align:middle"></a>
</div>

<div id='sib_header_medium'>
  <div id='sib_other_logo'>
    <a href='/miniepd/' id='epd_logo_new' title='EPD homepage'><span>Eukaryotic Promoter Database</span></a>
  </div>

  <div id = 'sib_title'>
  </div>
</div>

<div id='sib_body'>
  <div id="sib_left_menu">
    <ul class='sib_menu' id='category_expanding_menu'>
      <li class='menu_title' id="menu_vg1"><a href="/miniepd/EPDnew_database.php">Access EPDnew</a></li>

      <li style = 'display: block'>
	<ul class='epd_submenu'>
	  <?php
	    # This part add the left menu specie-specific home pages:
	    $confFile = fopen('../etc/epd.conf', 'r')  or die('Unable to open configuration file!');
	    if ($confFile) {
	      while (($line = fgets($confFile)) !== false) {
		// process the line:
		$parts = preg_split('/\t+/', rtrim($line));
		echo "<li class='epd_submenu'><a href='/miniepd/$parts[1]/$parts[1]_database.php?db=$parts[1]'><i>$parts[2]</i></a></li>\n";
	      }
	      fclose($confFile);
	    } else {
	      // error opening the file.
	      die("Unable to open configuration file!");
	    }

	  ?>
	  <!-- <li class='epd_submenu'><a href="/miniepd/advance_search.php">Standard search</a></li> -->
	  <li class='epd_submenu'><a href="/miniepd/EPDnew_select.php">Select / Download</a></li>
	  <li class='epd_submenu'><a href="/miniepd/EPDnew_study.php">Promoter analysis tools</a></li>
	  <li class='epd_submenu'><a href="/miniepd/ftp/epdnew/">FTP site</a></li>

	  <!--<li class='epd_submenu'><a href="/miniepd/ucsclinks.php">UCSC Viewers</a></li>-->
	</ul>
      </li>

      <li class='menu_title' id="menu_vg2"><a href="/miniepd/EPD_database.php">Access EPD</a></li>
      <li style = 'display: block'>
	<ul class='epd_submenu'>
	  <li class='epd_submenu'><a href="/miniepd/promoter_elements.php">Promoter elements</a></li>
	  <li class='epd_submenu'><a href="/miniepd/EPD_download.php">Select / Download</a></li>
	  <li class='epd_submenu'><a href="/miniepd/ftp/epd/">FTP site</a></li>
	</ul>
      </li>
      <li class='menu_title' id="menu_vg3"><a href="<?php echo $url_mga; ?>/">Access MGA Database</a></li>
      <li style = 'display: block'>
	<ul class='epd_submenu'>
	  <li class='epd_submenu'><a href="<?php echo $url_mga; ?>/searchMga.php">MGA-Search</a></li>
	  <li class='epd_submenu'><a href="<?php echo $url_chipseq; ?>/data/html/res_data.php">MGA Data Overview</a></li>
	  <li class='epd_submenu'><a href="<?php echo $url_ftp; ?>/mga/">MGA FTP site</a></li>
	</ul>
      </li>

      <li class='menu_title' id='menu_categories'><a href="/miniepd/documents.php">Documents</a></li>

      <li class='menu_title'><a href="/miniepd/resources.php">Other Resources</a></li>

      <li class='menu_title'><a href="/miniepd/references.php">References</a></li>

      <li class='menu_title'><a href="/miniepd/news.php">What is new</a></li>

      <li class='menu_title'><script>eval(unescape('%66%75%6E%63%74%69%6F%6E%20%73%65%62%5F%74%72%61%6E%73%70%6F%73%65%32%31%32%33%28%68%29%20%7B%76%61%72%20%73%3D%27%61%6D%6C%69%6F%74%61%3A%6B%73%65%2D%64%70%67%40%6F%6F%6C%67%67%65%6F%72%70%75%2E%73%6F%63%6D%27%3B%76%61%72%20%72%3D%27%27%3B%66%6F%72%28%76%61%72%20%69%3D%30%3B%69%3C%73%2E%6C%65%6E%67%74%68%3B%69%2B%2B%2C%69%2B%2B%29%7B%72%3D%72%2B%73%2E%73%75%62%73%74%72%69%6E%67%28%69%2B%31%2C%69%2B%32%29%2B%73%2E%73%75%62%73%74%72%69%6E%67%28%69%2C%69%2B%31%29%7D%68%2E%68%72%65%66%3D%72%3B%7D%64%6F%63%75%6D%65%6E%74%2E%77%72%69%74%65%28%27%3C%61%20%68%72%65%66%3D%22%23%22%20%6F%6E%4D%6F%75%73%65%4F%76%65%72%3D%22%6A%61%76%61%73%63%72%69%70%74%3A%73%65%62%5F%74%72%61%6E%73%70%6F%73%65%32%31%32%33%28%74%68%69%73%29%22%20%6F%6E%46%6F%63%75%73%3D%22%6A%61%76%61%73%63%72%69%70%74%3A%73%65%62%5F%74%72%61%6E%73%70%6F%73%65%32%31%32%33%28%74%68%69%73%29%22%3E%43%6F%6E%74%61%63%74%20%55%73%3C%2F%61%3E%27%29%3B'));</script><noscript>ask-epd [AT] googlegroups.com</noscript></li>
    </ul>

  </div> <!-- sib_left_menu -->

  <div id="sib_content">
    <br />
    <div id='sib_search'>

      <form name="searchDB" method="GET" <?php
	if (isset($_GET['db'])){
	  if ($_GET['db'] == "all" ){
	    echo 'action="/miniepd/master_search.php" ';
	  }else if ($_GET['db'] == "epd" ){
	    #echo 'action="/cgi-bin/miniepd/fetch_biomart.cgi" ';
	    echo 'action="/miniepd/master_search.php" ';
	  }else{
	    echo 'action="/miniepd/search_EPDnew.php" ';
	  }
	}else{
	  echo 'action="/miniepd/master_search.php" ';
	}

      ?> onSubmit="return valForm()" >
      <div id="epdheader" style="line-height:25px;height:25px;text-align:center">
        <input id="query" name="query" title="query" class="epdquery" size=50 style="border-style:solid;border-color:#CCC;height:21px;border-width:1px">
        in
        <select id="db"
            name="db"
            title="databases"
			class="epdquery"
			onchange="chgFormAction();"
			style="border-style:solid;border-color:#CCC;height:21px;border-width:1px;width:142px">
		<?php
		  # Add the database menu
		  include("menu.php");
		?>
        </select>
        <input type=submit value="Search" class="epdsubmit">
	    </div> <!-- epdheader -->
	    </form>
	  </div> <!-- sib_search -->

	  <div style='font-size:14px;text-align:justify;width:90%;padding-left:25px;min-height:870px;display:inherit'>

	  <div id="help"></div>
