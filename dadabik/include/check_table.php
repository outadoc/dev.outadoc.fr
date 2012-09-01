<?php
/*
***********************************************************************************
DaDaBIK (DaDaBIK is a DataBase Interfaces Kreator) http://www.dadabik.org/
Copyright (C) 2001-2012  Eugenio Tacchini

This program is distributed "as is" and WITHOUT ANY WARRANTY, either expressed or implied, without even the implied warranties of merchantability or fitness for a particular purpose.

This program is distributed under the terms of the DaDaBIK license, which is included in this package (see dadabik_license.txt). At a glance, you can use this program and you can modifiy it to create a database application for you or for other people but you cannot redistribute the program files in any format. All the details, including examples, in dadabik_license.txt.

If you are unsure about what you are allowed to do with this license, feel free to contact eugenio.tacchini@gmail.com
***********************************************************************************
*/
?>
<?php
// installed and allowed tables
$tables_names_ar = build_tables_names_array();

if (count($tables_names_ar) == 0){ // no tables installed and allowed
	echo "<p><b>[04] Error:</b> it is impossible to run DaDaBIK, probably because you have decided to disable all the tables; go to the <a href=\"admin.php\">administration interface</a> and include some tables.";
	exit;
} // end
else{
	if (!isset($_GET["table_name"])){
		$table_name = $tables_names_ar[0];
	} // end if
	else{
		$table_name = $_GET["table_name"];
		if ( !in_array($table_name, $tables_names_ar) ) { // someone try to manage a not-allowed table by changing the url
			echo "<p><b>[05] Error:</b> you are attemping to manage a not allowed table.";
			exit;
		}
		/*
		if (!table_allowed($conn, $table_name)){ // someone try to manage a not-allowed table by changing the url
			exit;
		} // end if
		*/
	} // end else
	$enabled_features_ar = build_enabled_features_ar($table_name);

	$enable_insert = $enabled_features_ar["insert"];
	$enable_edit = $enabled_features_ar["edit"];
	$enable_delete = $enabled_features_ar["delete"];
	$enable_details = $enabled_features_ar["details"];

	$table_internal_name = $prefix_internal_table.$table_name;
} // end else
?>