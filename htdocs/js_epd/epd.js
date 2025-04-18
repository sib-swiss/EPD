function chgFormAction( )
{
    var selectBox = document.getElementById("db");
    var actionName = selectBox.options[selectBox.selectedIndex].value;
    if( actionName == "all" ) {
        document.searchDB.action = "/miniepd/master_search.php";
    }
    else if( actionName == "epd" ) {
        document.searchDB.action = "/miniepd/master_search.php";
    }
    else {
        document.searchDB.action = "/miniepd/search_EPDnew.php";
    }
}

function toggle_class(cls) {
    var els = document.getElementsByClassName(cls);
    for(var i=0; i<els.length; ++i){
	var s = els[i].style;
	s.display = s.display==='none' ? 'block' : 'none';
    };
}

function selectShowDiv(element){
    if(element.value == "fasta"){
	document.getElementById('param').style.display = "inline";
    }else{
	document.getElementById('param').style.display = "none";
    }
}

function toggle(id) {
	var state = document.getElementById(id).style.display;
	if (state == 'block') {
        	document.getElementById(id).style.display = 'none';
        } else {
                document.getElementById(id).style.display = 'block';
        }
}

function unchekall() {
	var all = document.getElementById('allpromoters');
	all.checked = false;
}


var checked = false;
function checkedAll (result) {
    var aa= document.getElementById('result');
    if (checked == false)
    {
        checked = true
    }
    else
    {
        checked = false
    }
    for (var i =0; i < aa.elements.length; i++)
    {
	aa.elements[i].checked = checked;
    }
}

function getSequence(){

    var wait = document.getElementById('loading');
    wait.style.display = 'block';

    var outdiv = document.getElementById('ajaxDiv');
    outdiv.style.display = 'none';

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
		alert("Your browser do not support AJAX!");
		return false;
	    }

	}
    }
    // Create a function that will receive data sent from the server
    ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
	    var ajaxDisplay = document.getElementById('ajaxDiv');
	    ajaxDisplay.innerHTML = ajaxRequest.responseText;
            wait.style.display = 'none';
            outdiv.style.display = 'block';
	}
    }
    var gene_id = document.getElementById('gene_id').value;
    var database = document.getElementById('database').value;
    var from = document.getElementById('from').value;
    var to = document.getElementById('to').value;
    var inputLc = document.getElementById('lc');
    if(inputLc.checked){
	var lc = inputLc.value;
    }else{
	var lc = 0;
    }
    var queryString = "?database=" + database + "&gene_id=" + gene_id + "&from=" + from + "&to=" + to + "&lc=" + lc;
    ajaxRequest.open("GET", "/cgi-bin/miniepd/get_sequence.php" + queryString, true);
    ajaxRequest.send(null);
}

function getUCSCpicture(){

    var wait = document.getElementById('loadingUcsc');
    wait.style.display = 'block';

    var outdiv = document.getElementById('ucscpicture');
    outdiv.style.display = 'none';

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
    // Create a function that will receive data sent from the server
    ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
	    var ajaxDisplay = document.getElementById('ucscpicture');
	    ajaxDisplay.innerHTML = ajaxRequest.responseText;
            wait.style.display = 'none';
            outdiv.style.display = 'inline';
	    var pattern = /[1-9][0-9]* promoters/;
	    if (ajaxDisplay.innerHTML.match( pattern )){
		viewdiv.style.display = 'block';
	    }
	}
    }
    var pid = document.getElementById('pid').getAttribute('value');
    var chr = document.getElementById('chr').getAttribute('value');
    var specie = document.getElementById('specie').getAttribute('value');
    var pos = document.getElementById('pos').getAttribute('value');
    var assembly = document.getElementById('assembly').getAttribute('value');
    var queryString = "?organism=" + specie + "&pid=" + pid + "&chr=" + chr + "&pos=" + pos + "&assembly=" + assembly;
    ajaxRequest.open("GET", "/miniepd/getUcscPicture.php" + queryString, true);
    ajaxRequest.send(null);

}

// This function makes the menu for the search motif tool in the
// viewer page:

function makeMenu(){

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
    		alert("Your browser do not support AJAX!");
    		return false;
    	    }
    	}
    }

    var library = document.getElementById("motifLibrary");
    var chosenLib = library.options[library.selectedIndex].value;
//    alert(chosenLib);

    // empty the motif option menu
    var select = document.getElementById("p_tf");
    var length = select.options.length;
    var i;
    for (i = length-1; i >= 0; i--) {
	select.remove(i);
    }

    //var libType = document.getElementById("libType");
    //var secondRegE = /promoter/;
    //var whichLib = chosenLib.search(secondRegE);
    //alert(whichLib);
    //if (whichLib == 0){
    //   libType.innerHTML = "from <a href='/miniepd/promoter_elements.php'>EPD Promoter elements</a>";
    //}

    // refill it with the return from the php
    ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
	    var text = this.responseText;
	    //alert(text);
	    var motif = text.split("\n");
	    motif.forEach(function(entry){
		var value = entry.split(" ");
		//alert(value[0]);
		var option = document.createElement("option");
		option.text = value[1];
		option.value = value[0];
		select.appendChild(option);
	    }, this);
	    // get rid of the undefined option
	    for (var i = 0; i < select.options.length; i++) {
		if (select.options[i].text == "undefined") {
		    select.remove(i);
		    i--;
		}
	    }
	}
    };
    var queryString = "?lib=" + chosenLib;
    ajaxRequest.open("GET", "/miniepd/searchMotifBuildMenu.php"+ queryString, true);
    ajaxRequest.send(null);

}

// This function display the download button on the search_EPDnew page
// if at least one promoter is selected:

function showMe (box) {

    var chboxs = document.getElementsByName("gene_symbol");
    var vis = "none";
    var vis2 = "block";
    for(var i=0; i < chboxs.length; i++) {
        if(chboxs[i].checked){
	    vis = "block";
	    vis2 = "none";
            break;
        }
    }
    document.getElementById(box).style.display = vis;
    document.getElementById('selectall').style.display = vis2;
}

// This functions are used to make the drop-down menu for ChIP-Seq
// courses:
jQuery.noConflict();
jQuery(document).ready(function(){

        //Remove outline from links
        jQuery(".hl-item-link").click(function(){
                jQuery(this).blur();
        });

        //When mouse rolls over
        jQuery(".hl-item").mouseover(function(){
                jQuery(this).stop().animate({height:'275px'},{queue:false, duration:600, easing: 'easeOutBounce'})
                //jQuery(this).stop().animate({height:'275px'},{queue:false, duration:600, easing: 'easeOutBounce'})
        });

        //When mouse is removed
        jQuery(".hl-item").mouseout(function(){
                jQuery(this).stop().animate({height:'50px'},{queue:false, duration:600, easing: 'easeOutBounce'})
                //jQuery(this).stop().animate({height:'30px'},{queue:false, duration:600, easing: 'easeOutBounce'})
        });
});


// This function is used in Select / Download tools to change the
// select options on the "idtype" when selecting a database

function setIdType() {
    var db = document.getElementById("select_db");
    var dbValue = db.options[db.selectedIndex].value;

    document.getElementById("idtype").options[1].disabled = false;
    document.getElementById("idtype").options[2].disabled = false;
    document.getElementsByName("tata")[0].disabled = false;
    document.getElementsByName("inrAND")[0].disabled = false;
    document.getElementsByName("ccaatAND")[0].disabled = false;
    document.getElementsByName("ccaat")[0].disabled = false;
    document.getElementsByName("gcAND")[0].disabled = false;
    document.getElementsByName("gc")[0].disabled = false;

    switch(dbValue) {
        case "human":
        case "human_nc":
        case "mouse_nc":
        case "M_mulatta":
        case "C_familiaris":
        case "mouse":
        case "G_gallus":
        case "R_norvegicus":
        case "zebrafish":
    	document.getElementById("idtype").options[1].textContent = "ENSEMBL GENE ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        break;

        case "drosophila":
    	document.getElementById("idtype").options[1].textContent = "FlyBase ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        break;

        case "A_mellifera":
    	document.getElementById("idtype").options[1].textContent = "Gene ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        break;

        case "worm":
    	document.getElementById("idtype").options[1].textContent = "WormBase ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        break;

        case "arabidopsis":
    	document.getElementById("idtype").options[1].textContent = "AGI ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        break;

        case "Z_mays":
    	document.getElementById("idtype").options[1].textContent = "Gramene GENE ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        break;

        case "S_cerevisiae":
    	document.getElementById("idtype").options[1].textContent = "sgdGene ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        break;

        case "S_pombe":
    	document.getElementById("idtype").options[1].textContent = "PomBase ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        break;

        case "P_falciparum":
        document.getElementById("idtype").options[1].textContent = "ENSEMBL GENE ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        // No RefSeq identifiers for Plasmodium and only Inr-pfa motif
        document.getElementById("idtype").options[2].disabled = true;
        document.getElementsByName("tata")[0].selectedIndex = 0;
        document.getElementsByName("tata")[0].disabled = true;
        document.getElementsByName("inrAND")[0].selectedIndex = 0;
        document.getElementsByName("inrAND")[0].disabled = true;
        document.getElementsByName("ccaatAND")[0].selectedIndex = 0;
        document.getElementsByName("ccaatAND")[0].disabled = true;
        document.getElementsByName("ccaat")[0].selectedIndex = 0;
        document.getElementsByName("ccaat")[0].disabled = true;
        document.getElementsByName("gcAND")[0].selectedIndex = 0;
        document.getElementsByName("gcAND")[0].disabled = true;
        document.getElementsByName("gc")[0].selectedIndex = 0;
        document.getElementsByName("gc")[0].disabled = true;
        break;

        default:
        document.getElementById("idtype").options[1].disabled = true;
        document.getElementById("idtype").options[2].disabled = true;
        break;
    }
}
