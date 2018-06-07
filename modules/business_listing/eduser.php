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
include ("configs/vs_user.php");

if ( !$vs_current_admin[login] ){
	//no admin logged in
	header("Location: $config[mainurl]/admin.php");
	exit;
}

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('eduser',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('eduser',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************

$page = 'main';

if ($_GET[id] != ""){
	$user_id = $_GET[id];
	$page = 'change';

}elseif ( isset($_POST[change_user]) ){

	$login = $_POST[login];
	$usermail = $_POST[usermail];
	$user_id = $_POST[id];
	$login_old = $_POST[login_old];
	$usermail_old = $_POST[usermail_old];
	$pass = $_POST[pass];
	$password = md5($_POST[pass]);
	
	//Error Checking
	if($login != $login_old){
		$user_check = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_user WHERE login='$_POST[login]';") );
		if ($login == ""){
			$notice .= $language->desc('error_text',$lang_set,'error_user_empty')."<br>";
		}elseif ( strlen($login) < 4 ){
			$notice .= $language->desc('error_text',$lang_set,'error_user_short')."<br>";
		}elseif ($user_check[0]){
			$notice .= $language->desc('error_text',$lang_set,'error_user_used')."<br>";
			unset($_POST['login']);
		}else{
			$user_space = strpos($login, " ");
			$user_squote = strpos($login, "\'");
			$user_dquote = strpos($login, "\"");
			$user_comma = strpos($login, ",");
			if ( $user_space !== false ){
				$notice .= $language->desc('error_text',$lang_set,'error_user_spaces')."<br>";
			}
			if ( $user_squote !== false ){
				$notice .= $language->desc('error_text',$lang_set,'error_user_squotes')."<br>";
				$login = stripslashes($_POST['login']);
			}
			if ( $user_dquote !== false ){
				$notice .= $language->desc('error_text',$lang_set,'error_user_dquotes')."<br>";
				$login = stripslashes($_POST['login']);
			}
			if ( $user_comma !== false ){
				$notice .= $language->desc('error_text',$lang_set,'error_user_commas')."<br>";
			}
		}
	}
	if($usermail != $usermail_old){
		$email_check = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_user WHERE usermail='$_POST[usermail]';") );
		if ($usermail == ""){
			$notice .= $language->desc('error_text',$lang_set,'error_mail_empty')."<br>";
		}elseif ($email_check[0]){
			$notice .= $language->desc('error_text',$lang_set,'error_mail_used')."<br>";
		}
	}	
	if ($config['admin_chg_pw'] and $pass != ""){
		if ( strlen($pass) < 4 ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_short')."<br>";
			unset($pass);
		}else{
			$pass_space = strpos($pass, " ");
			$pass_squote = strpos($pass, "\'");
			$pass_dquote = strpos($pass, "\"");
			$pass_comma = strpos($pass, ",");
			if ( $pass_space !== false ){
				$notice .= $language->desc('error_text',$lang_set,'error_pass_spaces')."<br>";
				unset($pass);
			}
			if ( $pass_squote !== false ){
				$notice .= $language->desc('error_text',$lang_set,'error_pass_squotes')."<br>";
				unset($pass);
			}
			if ( $pass_dquote !== false ){
				$notice .= $language->desc('error_text',$lang_set,'error_pass_dquotes')."<br>";
				unset($pass);
			}
			if ( $pass_comma !== false ){
				$notice .= $language->desc('error_text',$lang_set,'error_pass_commas')."<br>";
				unset($pass);
			}
		}
	}
	if ($notice == ""){
		if($config['admin_chg_pw'] and $pass != ""){
			mysql_query("UPDATE $pds_user SET login='$login', usermail='$usermail', pass='$password' WHERE id='$_POST[id]';");
		}else{
			mysql_query("UPDATE $pds_user SET login='$login', usermail='$usermail' WHERE id='$_POST[id]';");
		}
		header("location: $config[mainurl]/eduser.php");
		exit;
	}else{
		$page = 'change';
	}
}elseif( isset($_POST[new_user]) ){
	$page = 'add';
}elseif( isset($_POST[add_user]) ){
	$login = $_POST[login];
	$usermail = $_POST[usermail];
	$pass = $_POST[pass];
	$password = md5($_POST[pass]);
	
	//Error Checking
	$user_check = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_user WHERE login='$_POST[login]';") );
	$email_check = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_user WHERE usermail='$_POST[usermail]';") );
	
	if ($login == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_user_empty')."<br>";
	}elseif ( strlen($login) < 4 ){
		$notice .= $language->desc('error_text',$lang_set,'error_user_short')."<br>";
	}elseif ($user_check[0]){
		$notice .= $language->desc('error_text',$lang_set,'error_user_used')."<br>";
		unset($_POST['login']);
	}else{
		$user_space = strpos($login, " ");
		$user_squote = strpos($login, "\'");
		$user_dquote = strpos($login, "\"");
		$user_comma = strpos($login, ",");
		if ( $user_space !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_user_spaces')."<br>";
		}
		if ( $user_squote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_user_squotes')."<br>";
			$login = stripslashes($_POST['login']);
		}
		if ( $user_dquote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_user_dquotes')."<br>";
			$login = stripslashes($_POST['login']);
		}
		if ( $user_comma !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_user_commas')."<br>";
		}
	}
	if ($pass == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_pass_empty')."<br>";
		unset($pass);
	}elseif ( strlen($pass) < 4 ){
		$notice .= $language->desc('error_text',$lang_set,'error_pass_short')."<br>";
		unset($pass);
	}else{
		$pass_space = strpos($pass, " ");
		$pass_squote = strpos($pass, "\'");
		$pass_dquote = strpos($pass, "\"");
		$pass_comma = strpos($pass, ",");
		if ( $pass_space !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_spaces')."<br>";
			unset($pass);
		}
		if ( $pass_squote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_squotes')."<br>";
			unset($pass);
		}
		if ( $pass_dquote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_dquotes')."<br>";
			unset($pass);
		}
		if ( $pass_comma !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_commas')."<br>";
			unset($pass);
		}
	}
	if ($usermail == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_mail_empty')."<br>";
	}elseif ($email_check[0]){
		$notice .= $language->desc('error_text',$lang_set,'error_mail_used')."<br>";
	}
	if ($notice == ""){
		mysql_query("INSERT INTO $pds_user (login, usermail, pass, joindate) VALUES ('$login', '$usermail', '$password', now() );") or die(mysql_error());
		header("location: $config[mainurl]/eduser.php");
		exit;
	}else{
		$page = 'add';
	}
}elseif( isset($_POST[delete_user]) ){
	mysql_query("DELETE FROM $pds_user WHERE id='$_POST[id]';");
	mysql_query("UPDATE $pds_list SET state='del' WHERE userid='$_POST[id]';");
	header("location: $config[mainurl]/eduser.php");
	exit;
}else{

	//***********************************************
	// Set up Paging
	//***********************************************
	
	include ("classes/SmartyPaginate.class.php");

	SmartyPaginate::connect();
	if ($_GET['next'] == "" or $_GET['id']!=""){
		SmartyPaginate::reset();
	}
	
	SmartyPaginate::setLimit($config[users_page]);
	SmartyPaginate::setPrevText($language->desc("site_text",$lang_set,'previous'));
	SmartyPaginate::setNextText($language->desc("site_text",$lang_set,'next'));
	SmartyPaginate::setFirstText($language->desc("site_text",$lang_set,'first'));
	SmartyPaginate::setLastText($language->desc("site_text",$lang_set,'last'));
	$xlimit = SmartyPaginate::getCurrentIndex();
	$ylimit = SmartyPaginate::getLimit();

	$r = mysql_query ("SELECT SQL_CALC_FOUND_ROWS id FROM $pds_user ORDER BY login LIMIT $xlimit,$ylimit;");
	
	$r1 = mysql_query("SELECT FOUND_ROWS() as total;");
	$f1 = mysql_fetch_assoc($r1);
	$r_rows = mysql_num_rows($r);
	for ($x=0;$x<$r_rows;$x++){
		$f = mysql_fetch_assoc($r);
		$user_list[$x][id] = $f[id];
		$list_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM $pds_list WHERE userid='$f[id]';"));
		$user_list[$x][listing_count] = $list_count[0];
	}
	SmartyPaginate::setTotal($f1['total']);
	SmartyPaginate::assign($tpl);
}

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('page',$page);
$tpl-> assign('notice',$notice);
$tpl-> assign('show_page','eduser');
$tpl-> assign('user_list',$user_list);
$tpl-> assign('user_listing',$user_listing);
$tpl-> assign('user_id',$user_id);

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/eduser.tpl");

?>