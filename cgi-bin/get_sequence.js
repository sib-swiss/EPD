//Browser Support Code
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
		      ajaxRequest = new ActiveXObject(\"Msxml2.XMLHTTP\");
		      } catch (e) {
		      try{
			ajaxRequest = new ActiveXObject(\"Microsoft.XMLHTTP\");
			} catch (e){
				// Something went wrong
				alert(\"Your browser do not support AJAX!\");
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
	var queryString = \"?database=\" + database + \"&gene_id=\" + gene_id + \"&from=\" + from + \"&to=\" + to;
	ajaxRequest.open(\"GET\", \"/cgi-bin/miniepd/get_sequence.php\" + queryString, true);
	ajaxRequest.send(null);

 }
