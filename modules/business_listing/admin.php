<?PHP
/*
Copyright (c) 2005-2008, Wagon Trader (an Oregon USA business)
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, 
are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, 
this list of conditions and the following disclaimer. 

Redistributions in binary form must reproduce the above copyright notice, 
this list of conditions and the following disclaimer in the documentation 
and/or other materials provided with the distribution.

All pages generated from the use of phpDirectorySource must contain the statement
"Powered by: phpDirectorySource" with an active link to http://www.phpdirectorysource.com,
unless a waiver is granted by the copyright holder.

Neither the name of Wagon Trader nor the names of its contributors may be used to endorse 
or promote products derived from this software without specific prior written permission. 

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS 
OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY 
AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER 
IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT 
OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");
include ("configs/vs_site_stats.php");

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('admin',$lang_set,'title');
$bread_crumb[0] = $language->desc('admin',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Log Out
//***********************************************
if ($_GET['act'] == "out"){
	unset($_SESSION['admin_login']);
	header("Location: $config[mainurl]/");
	exit;
}

//***********************************************
// Button Press Logic
//***********************************************

if ( isset($_POST['login_btn']) ){
	//admin logging in
	if (get_magic_quotes_gpc()) { 
		$_POST['login'] = stripslashes($_POST['login']); 
	} 
	if (!is_numeric($_POST['login'])) { 
		$_POST['login'] = mysql_real_escape_string($_POST['login']); 
	} 
	$pass_md5 = md5($_POST['pass']);
	$r_admin = mysql_query ("SELECT * FROM $pds_admin WHERE login='$_POST[login]' and pass='$pass_md5';") or die(mysql_error());
	$admin_rows = mysql_num_rows($r_admin);
	if ($admin_rows > 0){
		$f_admin = mysql_fetch_assoc($r_admin);
		//admin found so set session
	
		$_SESSION['admin_login'] = $f_admin['login'];
		$_SESSION['admin_pass'] = $f_admin['pass'];
		$_SESSION['admin_ip'] = $_SERVER['REMOTE_ADDR'];
		header("Location: $config[mainurl]/admin.php");
		exit;
	}else{
		//admin not found back to login
		$notice = $language->desc('admin',$lang_set,'bad_login');
	}
}elseif($_GET['act'] == 'cpw'){
	$tpl-> assign('change_pass', true);

}elseif( isset($_POST['btn_change_pw']) ){
	//admin changing password
	$c_pass = md5($_POST['c_pass']);
	$pass = $_POST['new_pass'];
	$pass_md5 = md5($pass);
	$vpass = $_POST['v_pass'];

	//Error Checking
	if ($c_pass != $_SESSION['admin_pass']){
		$notice .= $language->desc('error_text',$lang_set,'error_bad_cpass')."<br>";
		unset($pass);
		unset($vpass);
	}elseif ($pass == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_pass_empty')."<br>";
		unset($pass);
		unset($vpass);
	}elseif ( strlen($pass) < 4 ){
		$notice .= $language->desc('error_text',$lang_set,'error_pass_short')."<br>";
		unset($pass);
		unset($vpass);
	}else{
		$pass_space = strpos($pass, " ");
		$pass_squote = strpos($pass, "\'");
		$pass_dquote = strpos($pass, "\"");
		$pass_comma = strpos($pass, ",");
		if ( $pass_space !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_spaces')."<br>";
			unset($pass);
			unset($vpass);
		}
		if ( $pass_squote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_squotes')."<br>";
			unset($pass);
			unset($vpass);
		}
		if ( $pass_dquote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_dquotes')."<br>";
			unset($pass);
			unset($vpass);
		}
		if ( $pass_comma !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_commas')."<br>";
			unset($pass);
			unset($vpass);
		}
		if ( $pass != $vpass){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_mismatch')."<br>";
			unset($vpass);
		}
	}
	if($notice == ""){
		//No errors so change password
		mysql_query("UPDATE $pds_admin SET pass='$pass_md5' WHERE login='$_SESSION[admin_login]';");
		$_SESSION['admin_pass'] = $pass_md5;
		$notice .= $language->desc('admin',$lang_set,'pass_changed');
	}else{
		$tpl-> assign('change_pass', true);
	}
}

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('notice',$notice);
$tpl-> assign('show_page','admin');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/admin.tpl");

?>