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

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = "Business Posted By Me";//$language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('user',$lang_set,'title_tag');
$bread_crumb[0] =  'Business Posted By Me' ;//$language->desc('user',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

//***********************************************
// Logging Out
//***********************************************

if ($_GET['act'] == "out"){
	unset($_SESSION['userid']);
	header("Location: $config[mainurl]/");
	exit;
}

if (isset($_GET['show_type']) && ($_GET['show_type'] =="PR") ){
    if (isset($_GET['history']) && ($_GET['history'] ==1) ){
    $ishistory = 1;
    $title_tag =  'Promotions History';
    $bread_crumb[0] =  'Promotions History';
    $ispromotion = 1;
    }else{
        $title_tag =  'Promotions Posted By Me';
        $bread_crumb[0] =  'Promotions Posted By Me';
        $ispromotion = 1;
        $ishistory = 0;
    }


}else{
   $title_tag =  'Business Posted By Me';
  $bread_crumb[0] =  'Business Posted By Me';
  $ispromotion = 0;
}


    
if ( $vs_current_user[id] != "" ){
	if($_GET['act'] == 'cpw'){
		$tpl-> assign('change_pass', true);
	}else{
		if (isset($_POST['btn_change_pw'])){
			//User is changing password
			$c_pass = md5($_POST['c_pass']);
			$pass = $_POST['new_pass'];
			$pass_md5 = md5($pass);
			$vpass = $_POST['v_pass'];
	
			//Error Checking
			if ($c_pass != $vs_current_user['pass']){
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
				mysql_query("UPDATE $pds_user SET pass='$pass_md5' WHERE id='$vs_current_user[id]';");
				$notice .= $language->desc('user',$lang_set,'pass_changed');
				$_SESSION['userpass'] = $pass_md5;
			}else{
				$tpl-> assign('change_pass', true);
			}
		}
		//***********************************************
		// Listings
		//***********************************************


   if ($ispromotion == 1){
 	$result_sql = "SELECT Distinct l.*  FROM pds_list_promotions p inner join pds_list l on p.list_id = l.id  WHERE l.userid='$_SESSION[userid]'  ORDER BY firm;";
   }else{
       $result_sql = "SELECT Distinct l.*  FROM   pds_list l  WHERE userid='$_SESSION[userid]'  ORDER BY firm;";
   }


      $r_list = mysql_query ($result_sql);
      
    //include "sublist_promotion.php" ;
      $list=getMeListFromRecords($r_list, $ishistory);

		$tpl-> assign('list',$list);
		//get unread messages
	 	$msg = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM $pds_mailbox WHERE msg_read!='1';"));
		$msgcount = $msg[0];
		$tpl-> assign('msgcount',$msgcount);
	}
}elseif ( isset($_POST['login_btn']) ){
	// User is logging in
	if (get_magic_quotes_gpc()) { 
		$_POST['login'] = stripslashes($_POST['login']); 
	} 
	if (!is_numeric($_POST['login'])) { 
		$_POST['login'] = mysql_real_escape_string($_POST['login']); 
	} 
	$pass_md5 = md5($_POST['pass']);
	$r_user = mysql_query ("SELECT * FROM $pds_user WHERE (login='$_POST[login]' OR usermail='$_POST[login]') and pass='$pass_md5';");
	$user_rows = mysql_num_rows($r_user);
	if ($user_rows > 0){
		// User found so set session
		$f_user = mysql_fetch_assoc($r_user);
		$_SESSION['userid'] = $f_user['id'];
		$_SESSION['userpass'] = $f_user['pass'];
		$_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];
		// Drop a cookie for secondary validation
		setcookie("validate", md5($f_user['login']));
		header("Location: $config[mainurl]/user.php");
		exit;
	}else{
		// Bad login
		$notice = $language->desc('user',$lang_set,'bad_login');
		$tpl-> assign('show_login', true);
		
	}
		
}elseif ( isset($_POST['pass_reset']) ){
	//User is requesting a new password
	$login = $_POST['login'];
	if ($login != ""){
		$r_user = mysql_query ("SELECT * FROM $pds_user WHERE login='$login';");
		$user_rows = mysql_num_rows($r_user);
		if($user_rows == 1){
			//User exists... so reset password and e-mail it
			$f_user = mysql_fetch_assoc($r_user);
			$new_pass = "pass".rand();
			$new_md5 = md5($new_pass);
			mysql_query("UPDATE $pds_user SET pass='$new_md5' WHERE login='$login';");
			include_once ("classes/email_message.php");
			$mail = new email_message_class;
			$html_mail = new Smarty;
			$text_mail = new Smarty;
			
			$subject = "Password Reset";
			
			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("To",$f_user['usermail'],$f_user['usermail']);
			$mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;
	
			if( $text_mail-> template_exists($template="mail/reset_pass_text.tpl") ){
				//Set up Text Message to notify admin of new user
				$text_mail-> assign("subject",$subject);
				$text_mail-> assign('user_login',$login);
				$text_mail-> assign('user_usermail',$usermail);
				$text_mail-> assign('user_pass',$new_pass);
				$text_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
				$text_message=$text_mail-> fetch("mail/reset_pass_text.tpl");
				$mail->CreateQuotedPrintableTextPart($mail->WrapText($text_message),"",$text_part);
				$alternative_parts[0] = $text_part;
			}
			if( $html_mail-> template_exists($template="mail/reset_pass_html.tpl") ){
				//Set up HTML Message to notify admin of new user
				$html_mail-> assign("subject",htmlentities($subject));
				$html_mail-> assign('user_login',$login);
				$html_mail-> assign('user_usermail',$usermail);
				$html_mail-> assign('user_pass',$new_pass);
				$html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
				$html_message=$html_mail-> fetch("mail/reset_pass_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$alternative_parts[1] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();

			$notice = $language->desc('user',$lang_set,'reset_mail_sent');
			$tpl-> assign('show_login', true);
		}elseif($user_rows > 0){
			//Duplicate logins
			
		}else{
			//User does not exist
			$notice = $language->desc('user',$lang_set,'reset_bad_user');
			$tpl-> assign('show_login', true);
		}
	}else{
		//No Login Name
		$notice = $language->desc('user',$lang_set,'reset_no_user');
		$tpl-> assign('show_login', true);
	}
}else{

	$tpl-> assign('show_login', true);

}

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('notice',$notice);
$tpl-> assign('isUser',1);
$tpl-> assign('ispromotion',$ispromotion);
$tpl-> assign('ishistory',$ishistory);

$tpl-> assign('show_page','user');


//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/user.tpl");

?>
