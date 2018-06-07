<?php
/*
	@! AuthManager v3.0
	@@ User authentication and management web application
-----------------------------------------------------------------------------	
	** author: StitchApps
	** website: http://www.stitchapps.com
	** email: support@stitchapps.com
	** phone support: +91 9871084893
-----------------------------------------------------------------------------
	@@package: am_authmanager3.0
*/
include("../init.php");
include("header.php");

/* extra js file to be included for the show password option (jquery). */
$js = "<script type=\"text/javascript\" src=\"{$website}/".JS_DIRECTORY."/jquery.showpassword.js\"></script>
<script type=\"text/javascript\">
$(function() {
	$('#new_password').showPassword('#showpass');
});
</script>";

$title = "Change Password";
$breadcrumbs[] = array('title'=>$_lang['update_profile'],'link'=>$website.'/user/editprofile.php');
$breadcrumbs[] = array('title'=>$title,'link'=>$website.'/user/changepassword.php');
if($sesslife == true) { 
	if(isset($_POST["changepassword"])) {
		$current_password = cleanInput($_POST["current_password"]);
		$new_password = cleanInput($_POST["new_password"]);

		if(!empty($current_password) && !empty($new_password)) {
			/* changing the current password to the encrypted format. */
			$current_password = generate_encrypted_password($current_password);
			$new_password = generate_encrypted_password($new_password);
				if($current_password == $userpass) {
						/*if(is_gt_zero_num($_SESSION[SES_TABLE]))
							$table_id = $_SESSION[SES_TABLE];
						else	
								$table_id =	0;
								
						$_restaurant = $_SESSION[SES_RESTAURANT];
						$_usr=$_SESSION['user'];*/
						
				    $obj = new members();
						$confirm_do = $obj->changePassword($current_password,$new_password,$_SESSION['user']);
					if(is_gt_zero_num($confirm_do)) {
						 
						//$err = "<div class=\"infobox\">Successfully changed the password.<a href='{$website}/".USER_DIRECTORY."/logout'>Click here to Logout</a></div>";		
						$err = "<div class=\"infobox\">Successfully changed the password.</div>";												
						//print_r($_SESSION);
						$time = time();
						setcookie("authpass", $new_password, $time + 3600*24*10, "/");
						/*LogMeOut();
								
						$prop=LogMeIn($_usr,$new_password,$table_id,1,0,$_restaurant);
						
						if(is_gt_zero_num($table_id))
							biz_script_forward($website.'/user/dashboard.php');
						else
							biz_script_forward($website.'/user/index.php');			*/										
													
					} else {
						$err = "<div class=\"errorbox\"><strong>"._("Unable to process.")."</strong><br/>"._("We are unable to process your request at this time. Please try again later.")."</div>";
					}
				} else {
					$err = "<div class=\"errorbox\"><strong>"._("Password mismatch.")."</strong><br/>"._("Your current password does not match with the one stored with us.")."</div>";
				}
		} else {
			$err = "<div class=\"errorbox\"><strong>"._("Empty Fields.")."</strong><br/>"._("Please fill in all the fields.")."</div>";
		}
	}

	//am_showChangePassword();
	$smarty->assign('title',$title);
	$template = "changePassword.tpl";
} else {
	//echo "<meta http-equiv=\"refresh\" content=\"0;url={$website}/".USER_DIRECTORY."/login\" />";
	$template = "index.tpl";
} 
 
include("footer.php");
?>