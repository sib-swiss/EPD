<?php include("url_extern.php"); ?>

<div id='sib_top'><a name='TOP'></a></div>
<div id='sib_container'>

<style>
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

      <a href='/miniepd/' id='epd_logo_new' ><span>Eukaryotic Promoter Database</span></a>
      </div>

      <div  id = 'sib_title'>
        <!--<h1><a href='/'>The Eukaryotic Promoter Database</a></h1>
        < h2>Current Release 105</h2 -->
      </div>
   </div>

<div id='sib_body'>
   <div id="sib_left_menu">
   <ul class='sib_menu' id='category_expanding_menu'>

   <li class='menu_title' id="menu_vg"><a href="/miniepd/EPDnew_database.php">Access EPDnew</a></li>

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
   <li class='epd_submenu'><a href="<?php echo $url_ftp; ?>/epdnew/">FTP site</a></li>

   </ul>
</li>


   <li class='menu_title' id="menu_vg"><a href="/miniepd/EPD_database.php">Access EPD</a></li>
   <li style = 'display: block'>
   <ul class='epd_submenu'>
   <li class='epd_submenu'><a href="/miniepd/promoter_elements.php">Promoter elements</a></li>
   <!-- li class='epd_submenu'><a href="http://srs.ebi.ac.uk/srs6bin/cgi-bin/wgetz?-page+LibInfo+-lib+EPD">SRS access to EPD</a></li -->
   <li class='epd_submenu'><a href="/miniepd/EPD_download.php">Select / Download</a></li>
   <li class='epd_submenu'><a href="<?php echo $url_ftp; ?>ftp/epd/">FTP site</a></li>
   </ul>
</li>

   <li class='menu_title' id="menu_vg"><a href="<?php echo $url_mga; ?>/">Access MGA Database</a></li>
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

</div>



<div id="sib_content">
<br>
   <div id='sib_search'>

      <form name="searchDB" method="GET" <?php
	if (isset($_GET['db'])){
	  if ($_GET['db'] == "all" ){
	    echo 'action="/miniepd/master_search.php" ';
	  }else if ($_GET['db'] == "epd" ){
	    echo 'action="/cgi-bin/miniepd/fetch_biomart.cgi" ';
	    #echo 'action="/search_EPD.php" ';
	  }else{
	    echo 'action="/miniepd/search_EPDnew.php" ';
	  }
	}else{
	  echo 'action="/miniepd/master_search.php" ';
	}

      ?> onSubmit="return valForm()" >
      <div id="epdheader" align="center" valign="top" style="line-height: 25px; height: 25px;">
	<table>
	  <tr>
	    <td align="center">
	      <input id="query" name="query" class="epdquery" size=50 style="border-style:solid; border-color:#CCCCCC; height:21px;  border-width:1px;">
	      </td>
	      <td align="center"> in </td>
	      <td align="center">
		<select id="db" name="db" class="epdquery" onchange="chgFormAction();" style="border-style:solid; border-color:#CCCCCC; height:21px;  border-width:1px;">
		<?php
		  #Add the database menu
		  include("menu.php");
		?>
		</select>
	      </td>
	      <td align="center">
   <input type=submit value="Search" class="epdsubmit">
   </td></tr></table>
   </div>
</form>
</div>


<div style='min-height:870px'>
<!-- div style='color: red; font-family:"Courier New"; padding-bottom: 10px;'>
  Due to maintenance activity, EPD Website might not be fully
  operational. Please <script>eval(unescape('%66%75%6E%63%74%69%6F%6E%20%73%65%62%5F%74%72%61%6E%73%70%6F%73%65%32%31%32%33%28%68%29%20%7B%76%61%72%20%73%3D%27%61%6D%6C%69%6F%74%61%3A%6B%73%65%2D%64%70%67%40%6F%6F%6C%67%67%65%6F%72%70%75%2E%73%6F%63%6D%27%3B%76%61%72%20%72%3D%27%27%3B%66%6F%72%28%76%61%72%20%69%3D%30%3B%69%3C%73%2E%6C%65%6E%67%74%68%3B%69%2B%2B%2C%69%2B%2B%29%7B%72%3D%72%2B%73%2E%73%75%62%73%74%72%69%6E%67%28%69%2B%31%2C%69%2B%32%29%2B%73%2E%73%75%62%73%74%72%69%6E%67%28%69%2C%69%2B%31%29%7D%68%2E%68%72%65%66%3D%72%3B%7D%64%6F%63%75%6D%65%6E%74%2E%77%72%69%74%65%28%27%3C%61%20%68%72%65%66%3D%22%23%22%20%6F%6E%4D%6F%75%73%65%4F%76%65%72%3D%22%6A%61%76%61%73%63%72%69%70%74%3A%73%65%62%5F%74%72%61%6E%73%70%6F%73%65%32%31%32%33%28%74%68%69%73%29%22%20%6F%6E%46%6F%63%75%73%3D%22%6A%61%76%61%73%63%72%69%70%74%3A%73%65%62%5F%74%72%61%6E%73%70%6F%73%65%32%31%32%33%28%74%68%69%73%29%22%3E%43%6F%6E%74%61%63%74%20%55%73%3C%2F%61%3E%27%29%3B'));</script><noscript>ask-epd [AT] googlegroups.com</noscript> in case of bugs.
</div -->

<div id="help"></div>

<script>
  if( window.canRunAds === undefined ){
  // adblocker detected, show fallback
  var helpDiv = document.getElementById("help");
  helpDiv.innerHTML = "<b>You have an AdBlocker active.</b> That is fine, but please deactivate it. We do not show ads but use Google Analytics to know how many scientists use EPD and are granted money accordingly. So if you want to support EPD and continue using it, pease deactivate your AdBlocker.";
  helpDiv.style.border = "thin solid red";
  helpDiv.style.padding = "3px 3px 3px 3px";
  }
</script>
