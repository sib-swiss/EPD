jQuery(function() {
    if (/Safari/.test(navigator.userAgent) && !/Chrome/.test(navigator.userAgent)) {
        // console.log("Browser: " + navigator.userAgent);
        var version = navigator.userAgent.match(/Version\/(\d+)/);
        // console.log("Version: " + version[1]);
        if(version && parseInt(version[1]) < 10) location.replace("/EPDnew_select_old.php");
    } else {
        // console.log("Browser: " + navigator.userAgent);
        // var version = parseInt(navigator.appVersion.match(/^\d+/));
        // console.log("Version: " + version);
    }
    IDchanged();
});

function IDchanged() {
    var db = document.getElementById("select_db");
    var dbValue = db.options[db.selectedIndex].value;
    document.getElementById("idtype").options[1].disabled = false;
    document.getElementById("idtype").options[2].disabled = false;

    switch(dbValue) {
        case "human":
        case "human_nc":
        case "M_mulatta":
        case "C_familiaris":
        case "mouse":
        case "mouse_nc":
        case "G_gallus":
        case "R_norvegicus":
        case "zebrafish":
    	document.getElementById("idtype").options[1].textContent = "ENSEMBL GENE ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        addStandardMotifMenus();
        break;

        case "drosophila":
    	document.getElementById("idtype").options[1].textContent = "FlyBase ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        addStandardMotifMenus();
        break;

        case "A_mellifera":
    	document.getElementById("idtype").options[1].textContent = "Gene ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        addStandardMotifMenus();
        break;

        case "worm":
    	document.getElementById("idtype").options[1].textContent = "WormBase ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        addStandardMotifMenus();
        break;

        case "arabidopsis":
    	document.getElementById("idtype").options[1].textContent = "AGI ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        addStandardMotifMenus();
        break;

        case "Z_mays":
    	document.getElementById("idtype").options[1].textContent = "Gramene GENE ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        addStandardMotifMenus();
        break;

        case "S_cerevisiae":
    	document.getElementById("idtype").options[1].textContent = "sgdGene ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        addStandardMotifMenus();
        break;

        case "S_pombe":
    	document.getElementById("idtype").options[1].textContent = "PomBase ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        addStandardMotifMenus();
        break;

        case "P_falciparum":
        document.getElementById("idtype").options[1].textContent = "ENSEMBL GENE ID";
    	document.getElementById("idtype").options[2].textContent = "RefSeq";
        // No RefSeq identifiers for Plasmodium
        document.getElementById("idtype").options[2].disabled = true;
        addInrMotifMenu();
        break;

        default:
        document.getElementById("idtype").options[1].disabled = true;
        document.getElementById("idtype").options[2].disabled = true;
        addBlankMenuLine();
        break;
    }

    registerChangeEvents();
}

function registerChangeEvents() {
    jQuery('select.storable').change(function() {
        var selIndex = jQuery(this).prop('selectedIndex');
        sessionStorage.setItem(jQuery(this).prop('name'), selIndex);
    });
}

function removeMotifMenus() {
    var tbody = document.getElementById("tbody_motifs");
    while (tbody.firstChild) tbody.removeChild(tbody.firstChild);
    return tbody;
}

function addBlankMenuLine() {
    var tbody = removeMotifMenus();
    tbody.innerHTML = "<tr><td>&nbsp;</td></tr>";
}

function addInrMotifMenu() {
    var tbody = removeMotifMenus();

    // Add Inr-pfa motif menu
    var row = document.createElement("tr");
    var cell = document.createElement("td");
    cell.setAttribute("style", "vertical-align: middle; padding: 5px 5px 5px 20px");
    var select = document.createElement("select");
    select.setAttribute("class", "epddownload storable");
    select.setAttribute("name", "inr");
    select.setAttribute("style", "width: 64px");
    var options = new Array(3);
    for(var i = 0; i < 3; i++) options[i] = document.createElement("option");
    options[0].value = "all";options[0].textContent = "";
    options[0].setAttribute("selected", "selected");
    options[1].value = "with";options[1].textContent = "with"
    options[2].value = "without";options[2].textContent = "without";
    for(var i = 0; i < 3; i++) select.appendChild(options[i]);
    // Look whether a selection has been previously made
    if(sessionStorage.getItem('inr')) select.selectedIndex = sessionStorage.getItem('inr');
    cell.appendChild(select);
    var link = document.createElement("a");
    link.innerHTML = ' <a href="promoter_elements/inr-pfa.php" target="_blank">Inr-pfa motif</a>';
    cell.appendChild(link);
    row.appendChild(cell);
    tbody.appendChild(row);
}

function addStandardMotifMenus() {
    var tbody = removeMotifMenus();

    // Add TATA box menu
    var row = document.createElement("tr");
    var cell = document.createElement("td");
    cell.setAttribute("style", "vertical-align: middle; padding: 5px 5px 5px 20px");
    var select = document.createElement("select");
    select.setAttribute("class", "epddownload storable");
    select.setAttribute("name", "tata");
    select.setAttribute("style", "width: 64px");
    var options = new Array(3);
    for(var i = 0; i < 3; i++) options[i] = document.createElement("option");
    options[0].value = "all";options[0].textContent = "";
    options[0].setAttribute("selected", "selected");
    options[1].value = "with";options[1].textContent = "with";
    options[2].value = "without";options[2].textContent = "without";
    for(var i = 0; i < 3; i++) select.appendChild(options[i]);
    // Look whether a selection has been previously made
    if(sessionStorage.getItem('tata')) select.selectedIndex = sessionStorage.getItem('tata');
    cell.appendChild(select);
    cell.appendChild(document.createTextNode(" TATA box"));
    row.appendChild(cell);
    tbody.appendChild(row);

    // Add Initiator menu
    row = row.cloneNode(true);
    cell = row.firstChild;
    var select2 = cell.firstChild;
    select2.name = "inr";
    if(sessionStorage.getItem('inr')) select2.selectedIndex = sessionStorage.getItem('inr');
    var select1 = document.createElement("select");
    select1.setAttribute("class", "epddownload storable");
    select1.setAttribute("name", "inrAND");
    select1.setAttribute("style", "width: 48px;");
    option = document.createElement("option");
    option.setAttribute("selected", "selected");
    option.value = "AND"; option.textContent = "AND";
    select1.appendChild(option);
    option = document.createElement("option");
    option.value = "OR"; option.textContent = "OR";
    select1.appendChild(option);
    if(sessionStorage.getItem('inrAND')) select1.selectedIndex = sessionStorage.getItem('inrAND');
    cell.insertBefore(select1, select2);
    cell.insertBefore(document.createTextNode(" "), select2);
    cell.lastChild.textContent = " Initiator motif";
    tbody.appendChild(row);

    // Add CCAAT box menu
    row = row.cloneNode(true);
    cell = row.firstChild;
    select1 = cell.firstChild;
    select2 = cell.lastChild.previousElementSibling;
    select1.name = "ccaatAND";
    if(sessionStorage.getItem('ccaatAND')) select1.selectedIndex = sessionStorage.getItem('ccaatAND');
    select2.name = "ccaat";
    if(sessionStorage.getItem('ccaat')) select2.selectedIndex = sessionStorage.getItem('ccaat');
    cell.lastChild.textContent = " CCAAT box";
    tbody.appendChild(row);

    // Add GC box menu
    row = row.cloneNode(true);
    cell = row.firstChild;
    select1 = cell.firstChild;
    select2 = cell.lastChild.previousElementSibling;
    select1.name = "gcAND";
    if(sessionStorage.getItem('gcAND')) select1.selectedIndex = sessionStorage.getItem('gcAND');
    select2.name = "gc";
    if(sessionStorage.getItem('gc')) select2.selectedIndex = sessionStorage.getItem('gc');
    cell.lastChild.textContent = " GC box";
    tbody.appendChild(row);

    // Shift TATA menu to the right to make it aligned with the other menus
    select.setAttribute("style", "margin-left: 51px; width: 64px;");
}

