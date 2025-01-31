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

function getRefFeatureList(sel)
{
	var experiment = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_feature').options.length = 0;	// Empty Feature select box
	if(experiment.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getFeatures.php?experiment='+experiment;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefFeatures(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createRefFeatures(index)
{
	var obj = document.getElementById('res_r_feature');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getRefFeatureList_def(sel)
{
	var experiment = sel.options[sel.selectedIndex].value;
	var species = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_feature').options.length = 0;	// Empty Feature select box
	if(experiment.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getFeatures.php?experiment='+experiment;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefFeatures(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createRefFeatures_def(index)
{
	var obj = document.getElementById('res_r_feature');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getTarFeatureList(sel)
{
	var experiment = sel.options[sel.selectedIndex].value;
	document.getElementById('res_t_feature').options.length = 0;	// Empty Feature select box
	if(experiment.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getFeatures.php?experiment='+experiment;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createTarFeatures(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createTarFeatures(index)
{
	var obj = document.getElementById('res_t_feature');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getRefExperimentList(sel)
{
	var species = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_experiment').options.length = 0;	// Empty Feature select box
	if(species.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getExperiments.php?species='+species;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefExperiments(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createRefExperiments(index)
{
	var obj = document.getElementById('res_r_experiment');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getTarExperimentList(sel)
{
	var species = sel.options[sel.selectedIndex].value;
	document.getElementById('res_t_experiment').options.length = 0;	// Empty Feature select box
	if(species.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getExperiments.php?species='+species;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createTarExperiments(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createTarExperiments(index)
{
	var obj = document.getElementById('res_t_experiment');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getRefChromosomeList(sel)
{
	var experiment = sel.options[sel.selectedIndex].value;
	document.getElementById('res_r_chromosome').options.length = 0;	// Empty chromosome select box
	if(experiment.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getChromosomes.php?experiment='+experiment;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createRefChromosomes(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createRefChromosomes(index)
{
	var obj = document.getElementById('res_r_chromosome');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getTarChromosomeList(sel)
{
	var experiment = sel.options[sel.selectedIndex].value;
	document.getElementById('res_t_chromosome').options.length = 0;	// Empty chromosome select box
	if(experiment.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getChromosomes.php?experiment='+experiment;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createTarChromosomes(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createTarChromosomes(index)
{
	var obj = document.getElementById('res_t_chromosome');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getFeatureList(sel)
{
	var experiment = sel.options[sel.selectedIndex].value;
	document.getElementById('res_feature').options.length = 0;	// Empty Feature select box
	if(experiment.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getFeatures.php?experiment='+experiment;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createFeatures(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createFeatures(index)
{
	var obj = document.getElementById('res_feature');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getExperimentList(sel)
{
	var species = sel.options[sel.selectedIndex].value;
	document.getElementById('res_experiment').options.length = 0;	// Empty Feature select box
	if(species.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getExperiments.php?species='+species;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createExperiments(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createExperiments(index)
{
	var obj = document.getElementById('res_experiment');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}

function getChromosomeList(sel)
{
	var experiment = sel.options[sel.selectedIndex].value;
	document.getElementById('res_chromosome').options.length = 0;	// Empty chromosome select box
	if(experiment.length>0){
		var index = ajax.length;
		ajax[index] = new sack();

		ajax[index].requestFile = 'getChromosomes.php?experiment='+experiment;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createChromosomes(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}

function createChromosomes(index)
{
	var obj = document.getElementById('res_chromosome');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code
}
