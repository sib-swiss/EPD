/************************************************************************************************************
Ajax chained select
Copyright (C) 2006  DTHMLGoodies.com, Alf Magne Kalleland

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

Dhtmlgoodies.com., hereby disclaims all copyright interest in this script
written by Alf Magne Kalleland.

Alf Magne Kalleland, 2006
Owner of DHTMLgoodies.com


************************************************************************************************************/
var ajax = new Array();

function getRefLiftoverMenu(sel)
{
	var species = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_liftover').options.length = 0;	// Empty LiftOver select box
	if(species.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getLiftOver.php?species='+species;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefLiftover(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createRefLiftover(index)
{
	var obj = document.getElementById('res_r_liftover');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getRefDataTypeMenu(sel)
{
	var species = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_datatype').options.length = 0;	// Empty Data Type select box
	if(species.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getDataType.php?species='+species;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefDataType(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function getRefDataTypePartMenu(sel)
{
	var species = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_datatype').options.length = 0;	// Empty Data Type select box
	if(species.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getDataType_part.php?species='+species;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefDataType(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createRefDataType(index)
{
	var obj = document.getElementById('res_r_datatype');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getTarDataTypeMenu(sel)
{
	var species = sel.options[sel.selectedIndex].value;
	document.getElementById('res_t_datatype').options.length = 0;	// Empty Data Type select box
	if(species.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getDataType.php?species='+species;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createTarDataType(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createTarDataType(index)
{
	var obj = document.getElementById('res_t_datatype');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getRefSeriesMenu(sel)
{
	var datatype = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_series').options.length = 0;	// Empty Series select box
	if(datatype.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getSeries.php?datatype='+datatype;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefSeries(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function getRefSeriesPartMenu(sel)
{
	var datatype = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_series').options.length = 0;	// Empty Series select box
	if(datatype.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getSeries_part.php?datatype='+datatype;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefSeries(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createRefSeries(index)
{
	var obj = document.getElementById('res_r_series');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getTarSeriesMenu(sel)
{
	var datatype = sel.options[sel.selectedIndex].value;
	document.getElementById('res_t_series').options.length = 0;	// Empty Series select box
	if(datatype.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getSeries.php?datatype='+datatype;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createTarSeries(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createTarSeries(index)
{
	var obj = document.getElementById('res_t_series');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getRefSampleMenu(sel)
{
	var series = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_sample').options.length = 0;	// Empty Sample select box
	if(series.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getSamples.php?series='+series;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefSamples(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function getRefSamplePartMenu(sel)
{
	var series = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_sample').options.length = 0;	// Empty Sample select box
	if(series.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getSamples_part.php?series='+series;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefSamples(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createRefSamples(index)
{
	var obj = document.getElementById('res_r_sample');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
        var sample = obj.options[0].text;
        var sample_type = /^\w/;
        var result = sample.match(sample_type);
        if (result == null) {
            document.getElementById('strand_both_ref').checked = true;
            document.getElementById('any_ref').style.color = 'red';
        } else {
            document.getElementById('any_ref').style.color = "#626262";
        }
}

function getTarSampleMenu(sel)
{
	var series = sel.options[sel.selectedIndex].value;
	document.getElementById('res_t_sample').options.length = 0;	// Empty Feature select box
	if(series.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getSamples.php?series='+series;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createTarSamples(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createTarSamples(index)
{
	var obj = document.getElementById('res_t_sample');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
        var sample = obj.options[0].text;
        var sample_type = /^\w/;
        var result = sample.match(sample_type);
        if (result == null) {
            document.getElementById('strand_both_tar').checked = true;
            document.getElementById('any_tar').style.color = 'red';
        } else {
            document.getElementById('any_tar').style.color = "#626262";
        }
}

function getDataTypeMenu(sel)
{
	var species = sel.options[sel.selectedIndex].value;
	document.getElementById('res_datatype').options.length = 0;	// Empty Data Type select box
	if(species.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getDataType.php?species='+species;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createDataType(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createDataType(index)
{
	var obj = document.getElementById('res_datatype');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getSeriesMenu(sel)
{
	var datatype = sel.options[sel.selectedIndex].value;
	document.getElementById('res_series').options.length = 0;	// Empty Series select box
	if(datatype.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getSeries.php?datatype='+datatype;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createSeries(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createSeries(index)
{
	var obj = document.getElementById('res_series');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getSampleMenu(sel)
{
	var series = sel.options[sel.selectedIndex].value;
	document.getElementById('res_sample').options.length = 0;	// Empty Sample select box
	if(series.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/chipseq/getSamples.php?series='+series;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createSamples(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createSamples(index)
{
	var obj = document.getElementById('res_sample');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
        //obj.style.color = 'red';
        //obj.style.fontStyle = 'italic';
        //obj.options[0].style.color = 'red';
        //obj.options[0].style.fontStyle = 'italic';
        //obj.options[obj.options.length-1].style.color = 'red';
        //obj.options[obj.options.length-1].style.fontStyle = 'italic';
        // Change Sample list to Italic if Sample is Unoriented - text starts with special character
        //for (var i = 0; i < obj.options.length; i++) {
        //    var sample = obj.options[i].text;
        //    var sample_type = /^\w/;
        //    var result = sample.match(sample_type);
        //    if (result == null) {
        //        obj.style.fontStyle = 'italic';
        //        obj.options[i].style.fontStyle = 'italic';
        //    } else {
        //        obj.options[i].style.fontStyle = 'normal';
        //    }
        //}
        var sample = obj.options[0].text;
        var sample_type = /^\w/;
        var result = sample.match(sample_type);
        if (result == null) {
            document.getElementById('strand_both').checked = true;
            document.getElementById('any').style.color = 'red';
        } else {
            document.getElementById('any').style.color = "#626262";
        }
}

function getMotifMenu(sel)
{
	var motif_db = sel.options[sel.selectedIndex].value;
	document.getElementById('motif').options.length = 0;	// Empty Sample select box
	if(motif_db.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = '/ssa/getMotifs.php?motif_db='+motif_db;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createMotifs(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createMotifs(index)
{
	var obj = document.getElementById('motif');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}
