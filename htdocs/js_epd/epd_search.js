function searchEPD(){
    database = 'epd';
    var wait = document.getElementById('loadingEPD');
    wait.style.display = 'block';
    var outdiv = document.getElementById('resultEPD');
    outdiv.style.display = 'none';
    var viewdiv = document.getElementById('viewEPD');
    viewdiv.style.display = 'none';
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
	    var ajaxDisplay = document.getElementById('resultEPD');
	    ajaxDisplay.innerHTML = ajaxRequest.responseText;
            wait.style.display = 'none';
            outdiv.style.display = 'block';
	    var pattern = /[1-9][0-9]* promoters/;
	    if (ajaxDisplay.innerHTML.match( pattern )){
		viewdiv.style.display = 'block';
	    }
	}
    }
    var query_str = document.getElementById('query_str').value;
    var string = "?database=" + database + "&query_str=" + query_str;
    ajaxRequest.open("GET", "/miniepd/searchDB.php" + string, true);
    ajaxRequest.send(null);
}

function searchEPDnew(db){
    var loadingDivName = 'loadingEPDnew_' + db;
    var resultDivName = 'resultEPDnew_' + db;
    var viewDivName = 'viewEPDnew_' + db;

    var wait = document.getElementById(loadingDivName);
    wait.style.display = 'block';
    var outdiv = document.getElementById(resultDivName);
    outdiv.style.display = 'none';
    var viewdiv = document.getElementById(viewDivName);
    viewdiv.style.display = 'none';
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
	    //var ajaxDisplay = document.getElementById(resultDivName);
	    outdiv.innerHTML = ajaxRequest.responseText;
            wait.style.display = 'none';
            outdiv.style.display = 'block';
	    var pattern = /[1-9][0-9]* promoters/;
	    if (outdiv.innerHTML.match( pattern )){
		viewdiv.style.display = 'block';
	    }
	}
    }
    var query_str = document.getElementById('query_str').value;
    var string = "?database=" + db + "&query_str=" + query_str;
    ajaxRequest.open("GET", "/miniepd/mysql/queryDB.php" + string, true);
    ajaxRequest.send(null);
}



function wait_result(){

    var wait = document.getElementById('wait-result');
    wait.style.display = 'none';

    var outdiv = document.getElementById('genes');
    outdiv.style.display = 'block';
}

