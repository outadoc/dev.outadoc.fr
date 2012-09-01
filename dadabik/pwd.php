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
include('./include/config.php');

if ($db_library === 'adodb'){
	include('./include/adodb'.DADABIK_ADODB_VERSION.'/adodb.inc.php');
	
	// hack for oracle, all field names fetched in lower case
	if ($dbms_type === 'oci8po') {
		define('ADODB_ASSOC_CASE', 0); 
	} // end if
}

include ("./include/languages/".$language.".php");
require ('./include/PasswordHash.php');
?>
<html>
	<head>
	<title></title>
	<link rel="stylesheet" href="./css/styles_screen.css" type ="text/css" media="screen">
	<script>
	function register_pwd(pwd){
		opener.document.forms['contacts_form'].elements['<?php echo $users_table_password_field; ?>'].value = document.forms['encrypter'].elements['encrypted'].value;
		self.close();
	}
	</script>
	<body>
<?php
echo "<table class=\"main_table\" cellpadding=\"5\"><tr><td valign=\"top\"><b>Password crypter</b></td></tr><tr><td valign=\"top\">";
echo $login_messages_ar['pwd_explain_text'];
echo "<form action=\"pwd.php\" name=\"pwd_gen\" method=\"POST\">";
echo "<input type=\"text\" name=\"pwd\" value=\"";
if (isset($_POST['pwd'])) {
	echo $_POST['pwd'];
} // end if
echo "\" size=\"40\"><br>";
echo "<input type=\"submit\" name=\"\" value=\"".$login_messages_ar['pwd_encrypt_button_text']."\">";
echo "</form>";
if(isset($_POST['pwd'])){
	//$encrypted = md5($_POST['pwd']);
	
	if (strlen($_POST['pwd']) > 72){
		echo 'Error';
		exit();
	} 
	$t_hasher = new PasswordHash(8, $generate_portable_password_hash);
	$encrypted = $_POST['pwd'];
	$encrypted = $t_hasher->HashPassword($encrypted);
	if (strlen($encrypted) < 20){
		echo 'Error';
		exit();
	}
	echo $login_messages_ar['pwd_explain_text_2'];
	echo "<form name=\"encrypter\">";
	echo "<input type=\"text\" name=\"encrypted\" value=\"$encrypted\" size=\"40\"><br>";
	echo "<input type=\"button\" name=\"encrypt-it\" value=\"".$login_messages_ar['pwd_register_button_text']."\" onclick=register_pwd('".$encrypted."')>";
	echo "</form>";
	//echo $login_messages_ar['pwd_suggest_email_sending']." ( <a href=\"mailto:?subject=password&body=".$_POST['pwd']."\">".$login_messages_ar['pwd_send_link_text']."</a> )";
}
echo "</td></tr></table>";
?>
	</body>
	</head>
</html>