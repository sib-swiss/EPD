function valForm()
{
	var x=document.getElementById("query").value;
        //var x=document.forms["form"].elements["query_str"].value;
	x.replace(/\s/g, "");
	if (x==null || !x.match(/\S/)) {
    		alert('Please provide a valid string.');
        	return false;
        } else if(x.match(/[<>\%\&]/)) {
		alert('Please avoid special characters like <, >, & or %.');
		return false;
	}
    	return true;
}
