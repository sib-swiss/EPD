  <option id="all" value="all" <?php
    if (isset($_GET['db'])){
      if ($_GET['db'] == "all" ) echo 'selected="selected" ';}
  ?> > All databases</option>
  <optgroup label="EPDnew - Animals">
    <option id="human" value="human" <?php
      if (isset($_POST['query_db'])){
	if ($_POST['query_db'] == "human") echo 'selected="selected" ';
      }
   if (isset($_GET['db'])){
     if ($_GET['db'] == "human") echo 'selected="selected" '; }
    ?> >H. sapiens</option>
  <option id="human_nc" value="human_nc" <?php
      if (isset($_POST['query_db'])){
        if ($_POST['query_db'] == "human_nc") echo 'selected="selected" ';
      }
   if (isset($_GET['db'])){
     if ($_GET['db'] == "human_nc") echo 'selected="selected" '; }
    ?> >H. sapiens non-coding</option>
    <option id="M_mulatta" value="M_mulatta" <?php
      if (isset($_POST['query_db'])){
	if ($_POST['query_db'] == "M_mulatta") echo 'selected="selected" ';
      }
      if (isset($_GET['db'])){
	if ($_GET['db'] == "M_mulatta") echo 'selected="selected" ';
    } ?> >M. mulatta</option>
    <option id="mouse" value="mouse" <?php
      if (isset($_POST['query_db'])){
	if ($_POST['query_db'] == "mouse") echo 'selected="selected" ';
      }
      if (isset($_GET['db'])){
	if ($_GET['db'] == "mouse") echo 'selected="selected" ';
    } ?> >M. musculus</option>
    <option id="mouse_nc" value="mouse_nc" <?php
      if (isset($_POST['query_db'])){
	if ($_POST['query_db'] == "mouse_nc") echo 'selected="selected" ';
      }
      if (isset($_GET['db'])){
	if ($_GET['db'] == "mouse_nc") echo 'selected="selected" ';
    } ?> >M. musculus non-coding</option>
    <option id="R_norvegicus" value="R_norvegicus" <?php
	if (isset($_POST['query_db'])){
	  if ($_POST['query_db'] == "R_norvegicus") echo 'selected="selected" ';
	}
	if (isset($_GET['db'])){
	  if ($_GET['db'] == "R_norvegicus") echo 'selected="selected" ';
    } ?> >R. norvegicus</option>
    <option id="C_familiaris" value="C_familiaris" <?php
	if (isset($_POST['query_db'])){
	  if ($_POST['query_db'] == "C_familiaris") echo 'selected="selected" ';
	}
	if (isset($_GET['db'])){
	  if ($_GET['db'] == "C_familiaris") echo 'selected="selected" ';
    } ?> >C. familiaris</option>
    <option id="G_gallus" value="G_gallus" <?php
	if (isset($_POST['query_db'])){
	  if ($_POST['query_db'] == "G_gallus") echo 'selected="selected" ';
	}
	if (isset($_GET['db'])){
	  if ($_GET['db'] == "G_gallus") echo 'selected="selected" ';
    } ?> >G. gallus</option>
    <option id="drosophila" value="drosophila" <?php
	  if (isset($_POST['query_db'])){
	    if ($_POST['query_db'] == "drosophila") echo 'selected="selected" ';
	  }
	  if (isset($_GET['db'])){
	    if ($_GET['db'] == "drosophila") echo 'selected="selected" ';
    } ?> >D. melanogaster</option>
    <option id="A_mellifera" value="A_mellifera" <?php
	    if (isset($_POST['query_db'])){
	      if ($_POST['query_db'] == "A_mellifera") echo 'selected="selected" ';
	    }
	    if (isset($_GET['db'])){
	      if ($_GET['db'] == "A_mellifera") echo 'selected="selected" ';
    } ?> >A. mellifera</option>
    <option id="zebrafish" value="zebrafish" <?php
	      if (isset($_POST['query_db'])){
		if ($_POST['query_db'] == "zebrafish") echo 'selected="selected" ';
	      }
	      if (isset($_GET['db'])){
		if ($_GET['db'] == "zebrafish") echo 'selected="selected" ';
    }?> >D. rerio</option>
    <option id="worm" value="worm" <?php
		if (isset($_POST['query_db'])){
		  if ($_POST['query_db'] == "worm") echo 'selected="selected" ';
		}
		if (isset($_GET['db'])){
		  if ($_GET['db'] == "worm") echo 'selected="selected" ';
    } ?> >C. elegans</option>
  </optgroup>
  <optgroup label="EPDnew - Plants">
    <option id="arabidopsis" value="arabidopsis" <?php
		  if (isset($_POST['query_db'])){
		    if ($_POST['query_db'] == "arabidopsis") echo 'selected="selected" ';
		  }
		  if (isset($_GET['db'])){
		    if ($_GET['db'] == "arabidopsis") echo 'selected="selected" ';
    } ?> >A. thaliana</option>
    <option id="Z_mays" value="Z_mays" <?php
		    if (isset($_POST['query_db'])){
		      if ($_POST['query_db'] == "Z_mays") echo 'selected="selected" ';
		    }
		    if (isset($_GET['db'])){
		      if ($_GET['db'] == "Z_mays") echo 'selected="selected" ';
    }?> >Z. mays</option>
    <option id="H_vulgare" value="H_vulgare" <?php
		    if (isset($_POST['query_db'])){
		      if ($_POST['query_db'] == "H_vulgare") echo 'selected="selected" ';
		    }
		    if (isset($_GET['db'])){
		      if ($_GET['db'] == "H_vulgare") echo 'selected="selected" ';
    }?> >H. vulgare</option>
  </optgroup>
  <optgroup label="EPDnew - Fungi">
    <option id="S_cerevisiae" value="S_cerevisiae" <?php
		      if (isset($_POST['query_db'])){
			if ($_POST['query_db'] == "S_cerevisiae") echo 'selected="selected" ';
		      }
		      if (isset($_GET['db'])){
			if ($_GET['db'] == "S_cerevisiae") echo 'selected="selected" ';
    } ?> >S. cerevisiae</option>
    <option id="S_pombe" value="S_pombe" <?php
			if (isset($_POST['query_db'])){
			  if ($_POST['query_db'] == "S_pombe") echo 'selected="selected" ';
			}
			if (isset($_GET['db'])){
			  if ($_GET['db'] == "S_pombe") echo 'selected="selected" ';
    } ?> >S. pombe</option>
  </optgroup>
	<optgroup label="EPDnew - Invertebrates">
		<option id="P_falciparum" value="P_falciparum" <?php
			if (isset($_POST['query_db'])) {
				if ($_POST['query_db'] == "P_falciparum") echo 'selected="selected" ';
			}
			if (isset($_GET['db'])) {
				if ($_GET['db'] == "P_falciparum") echo 'selected="selected" ';
			} ?> >P. falciparum</option>
	</optgroup>
  <option id="epd" value="epd" <?php
			  if (isset($_POST['query_db'])){
			    if ($_POST['query_db'] == "epd") echo 'selected="selected" ';
  } ?> >EPD</option>

