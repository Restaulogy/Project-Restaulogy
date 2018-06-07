<?PHP
/*
Online mail module for
phpDirectorySource ver 1.1
*/

//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('mailbox',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('mailbox',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

//Verifying admin logged in
if ( $_SESSION['admin_login'] ){
	$uid = $_SESSION['userid'];
}else{
	header("location:admin.php");
	exit;
}

//Verifying data
$mid = $_GET[mid];
if( !is_numeric($mid) ){
	die('There was a problem processing this request (message id not numeric)');
}

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************

//***********************************************
// Print mail page
//***********************************************
$rf = mysql_query ("SELECT * FROM $pds_amailbox WHERE id='$mid';");
$count_rf = mysql_num_rows($rf);
if ($count_rf > 0){
	$message = mysql_fetch_assoc($rf);
	mysql_query("UPDATE $pds_amailbox SET msg_read='1' WHERE id='$mid';");
	$message['body'] = stripslashes(nl2br($message['body']));
	$message['subject'] = stripslashes($message['subject']);
}

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('message',$message);
$tpl-> assign('show_page','empty');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/mailprint.tpl");

?>