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

// include config, functions, common and header
include ("./include/config.php");

if ($db_library === 'adodb'){
	include('./include/adodb'.DADABIK_ADODB_VERSION.'/adodb.inc.php');
	
	// hack for oracle, all field names fetched in lower case
	if ($dbms_type === 'oci8po') {
		define('ADODB_ASSOC_CASE', 0); 
	} // end if
}
include ("./include/functions.php");
include ("./include/common_start.php");

$page_name = 'upgrade';

include ("./include/check_installation.php");
require ('./include/PasswordHash.php');
include ("./include/header.php");

// variables:

if (isset($_POST["upgrade"])){
	$upgrade = (int)$_POST["upgrade"];
} // end if
else{
	$upgrade = "";
} // end else

if ($upgrade === 1){

	$current_version = get_current_version();
	
	switch ($current_version){
		case '4.3':
		case '4.4 beta':
		case '4.4 alpha':
		case '4.4':
		case '4.4_pl1':
		
			create_locks_table();
			
			create_internal_table ($prefix_internal_table.'forms');
			
			if ($dbms_type === 'sqlite'){
				$sql = "DELETE FROM ".$quote.$table_list_name.$quote." WHERE name_table = 'sqlite_sequence'";
				
				$res = execute_db($sql, $conn);
			}
			
			$tables_ar = build_tables_names_array($exclude_not_allowed = 0, $exclude_not_installed = 1, $inlcude_users_table = 1);
			
			foreach ($tables_ar as $table_name_temp){
				$sql = "select * from ".$quote.$prefix_internal_table.$table_name_temp.$quote;
				
				$res = execute_db($sql, $conn);
		
				while($row = fetch_row_db($res)){

					$sql = "INSERT INTO ".$quote.$prefix_internal_table."forms".$quote." (".$quote."name_field".$quote.", ".$quote."label_field".$quote.", ".$quote."type_field".$quote.", ".$quote."content_field".$quote.", ".$quote."present_search_form_field".$quote.", ".$quote."present_results_search_field".$quote.", ".$quote."present_details_form_field".$quote.", ".$quote."present_insert_form_field".$quote.", ".$quote."present_ext_update_form_field".$quote.", ".$quote."required_field".$quote.", ".$quote."check_duplicated_insert_field".$quote.", ".$quote."other_choices_field".$quote.", ".$quote."select_options_field".$quote.", ".$quote."primary_key_field_field".$quote.", ".$quote."primary_key_table_field".$quote.", ".$quote."primary_key_db_field".$quote.", ".$quote."linked_fields_field".$quote.", ".$quote."linked_fields_order_by_field".$quote.", ".$quote."linked_fields_order_type_field".$quote.", ".$quote."select_type_field".$quote.", ".$quote."items_table_names_field".$quote.", ".$quote."items_table_fk_field_names_field".$quote.", ".$quote."prefix_field".$quote.", ".$quote."default_value_field".$quote.", ".$quote."width_field".$quote.", ".$quote."height_field".$quote.", ".$quote."maxlength_field".$quote.", ".$quote."hint_insert_field".$quote.", ".$quote."order_form_field".$quote.", ".$quote."separator_field".$quote.", ".$quote."table_name".$quote.") VALUES ('".escape($row['name_field'])."', '".escape($row['label_field'])."', '".escape($row['type_field'])."', '".escape($row['content_field'])."', '".escape($row['present_search_form_field'])."', '".escape($row['present_results_search_field'])."', '".escape($row['present_details_form_field'])."', '".escape($row['present_insert_form_field'])."', '".escape($row['present_ext_update_form_field'])."', '".escape($row['required_field'])."', '".escape($row['check_duplicated_insert_field'])."', '".escape($row['other_choices_field'])."', '".escape($row['select_options_field'])."', '".escape($row['primary_key_field_field'])."', '".escape($row['primary_key_table_field'])."', '".escape($row['primary_key_db_field'])."', '".escape($row['linked_fields_field'])."', '".escape($row['linked_fields_order_by_field'])."', '".escape($row['linked_fields_order_type_field'])."', '".escape($row['select_type_field'])."', '".escape($row['items_table_names_field'])."', '".escape($row['items_table_fk_field_names_field'])."', '".escape($row['prefix_field'])."', '".escape($row['default_value_field'])."', '".escape($row['width_field'])."', '".escape($row['height_field'])."', '".escape($row['maxlength_field'])."', '".escape($row['hint_insert_field'])."', '".escape($row['order_form_field'])."', '".escape($row['separator_field'])."', '".escape($table_name_temp)."')";
					
					$res_2 = execute_db($sql, $conn);
					
				}
					
				if ($dbms_type === 'sqlite' || $dbms_type === 'sqlite2'){
				
					drop_table_db($conn, $prefix_internal_table.$table_name_temp);
					
				}
				else{
					$data_dictionary = NewDataDictionary($conn);

					drop_table_db($conn, $data_dictionary, $prefix_internal_table.$table_name_temp);
				}
			}
		case '4.3':
		case '4.4 beta':
		case '4.4 alpha':
		case '4.4':
		case '4.4_pl1':
		case '4.5 beta':
		case '4.5':
			create_users_table();
			
			$link_popup = escape('\'pwd.php\',\'\',600,300');
			
			$sql = "UPDATE ".$quote.$prefix_internal_table."forms".$quote." SET label_field = 'Password (hash)', hint_insert_field = '<a href=\"javascript:void(generic_js_popup(".$link_popup."))\">crypter</a>' where table_name = '".$users_table_name."' AND name_field = 'password_user'";
			
			$res = execute_db($sql, $conn);
			
			if ($conn->Affected_Rows() !== 1){
				echo 'Error during labels change.';
				exit;
			}
			
			$date_time = date("Y-m-d H:i:s");
					
			if (isset($_POST['register']) && (int)$_POST['register'] === 1){
			
				$sql = "SELECT id_installation, code_installation FROM ".$quote.$prefix_internal_table.'installation_tab'.$quote;
				
				$res = execute_db($sql, $conn);
				
				$row = fetch_row_db($res);
				
				$id_installation = $row['id_installation'];
				$code_installation = $row['code_installation'];
					
				$upgrade_process_result = @file_get_contents('http://www.dadabik.org/process_upgrade.php?id_installation='.$id_installation.'&code_installation='.urlencode($code_installation).'&dbms_type='.$dbms_type.'&dadabik_version='.urlencode('4.5_pl1'));
					
				if ($upgrade_process_result === false){
					echo '<p>There are problems with the Internet connection, the on-line registration is not possible......</p>';
				} // end if
				else{
					echo '<p>On-line registration done......</p>';
				} // end else
			}
			
			manage_other_infos_installation('update', 'upgrade_version','4.5_pl1');
			manage_other_infos_installation('update', 'upgrade_time',time());
			manage_other_infos_installation('update', 'upgrade_dbms',$dbms_type);
			
			echo "<p>......DaDaBIK correctly upgraded!! You can now <a href=\"index.php\">start using it</a>.";
			break;
		
		case '4.5_pl1':
			echo '<p>This procedure provides an upgrade to version 4.5 pl1 but the version installed is already 4.5 pl1.</p>';
			break;
		default:
			echo '<p>Your current version is prior to 4.3 final, it is not possible to upgrade it using this procedure. You have to <a href="install.php">install</a> DaDaBIK from scratch.</p>';
			break;
	}
} // end if ($upgrade === 1)
else{

	$current_version = get_current_version();
	
	echo '<p>Your current DaDaBIK version is <b>'.$current_version.'</b>';
	
	switch ($current_version){
		case '4.3':
		case '4.4 beta':
		case '4.4 alpha':
		case '4.4':
		case '4.4_pl1':
		case '4.5 beta':
		case '4.5':
			echo '<p>This upgrade procedure allows you to upgrade DaDaBIK to version <b>4.5 pl1</b></p>';
			
			echo '<p>Before proceeding, you should have:<ul><li>Replaced all the old DaDaBIK files with the new ones (keep your upload folder if you want to save the uploaded files);</li><li>Updated your /include/config.php file using your old configuration settings.</li></ul>If you are here, you have probably already done the first point and at least part of the second one.</p>';
			
			echo '<p>The upgrade will not affect your DaDaBIK configuration and your data but, just in case, please create a backup of your database before upgrading.</p>';
			
			echo '<p>Please note that, if there are some locked records (DaDaBIK record locking feature), the records could be unlocked by this procedure before upgrading.</p>';
			
			echo '<p><font color="red">Please note that, since DaDaBIK changed the password encryption method starting from version 4.5 pl1, <b>this procedure will delete your existing users table '.$users_table_name.' and create a new one containing just the root user with the default password "letizia" so after the upgrade your application will be accessible via the DEFAULT PASSWORD</b></font></p>';
			
			echo '<p>The procedure will also change the label and the link to the password encryption tool for the password field of the users table.</p>';
			
			echo '<form action="upgrade.php" method="post">';
			echo '<input type="hidden" name="upgrade" value="1">';
	
			echo "<input type=\"checkbox\" name=\"register\" value=\"1\" checked> Communicate this upgrade to www.dadabik.org<br>Just the DBMS type (e.g. MySQL) and the DaDaBIK version (e.g. 4.4) will be transmitted, NO PERSONAL INFORMATION. This is usefult to keep track of the DaDaBIK installation upgrades worldwide.<br><br>";
			echo '<input type="submit" value="Click this button to upgrade DaDaBIK">';
			echo '</form>';
			break;
		case '4.5_pl1':
			echo '<p>This procedure provides an upgrade to version 4.5 pl1 but the version installed is already 4.5 pl1.</p>';
			break;
		default:
			echo '<p>Your current version is prior to 4.3 final, it is not possible to upgrade it using this procedure. You have to <a href="install.php">install</a> DaDaBIK from scratch.</p>';
			break;
	}
} // end else

// include footer
include ("./include/footer.php");
?>