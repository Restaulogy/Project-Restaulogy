<?php 
  include("../init.php");
  
	/* Include required files as per the admin option of inbuilt captcha enabled or not. */
	if($inbuilt_captcha == 1)
	{
		include("../".MODS_DIRECTORY."/captcha/php-captcha.inc.php");
	}
	else
	{
		include("../".MODS_DIRECTORY."/recaptchalib.php");
	}
  
  include("header.php");
  $isAlreadyLoggedIn = 0;
  $title = $_lang['forgot_password'];
  
  if($sesslife == false)
  {  
	if(isset($_POST['forgot']))
	{
		$email = mysql_real_escape_string($_POST['email']);
		$objPhpCaptcha=new PhpCaptcha();
		
			if($email != "")
			{
				if($inbuilt_captcha == 1)
				{
					if($objPhpCaptcha->Validate($_POST['user_code'],true))
					{
						$is_captcha_true = true;
					}
					else
					{
						$is_captcha_true = false;
					}
				}
				else
				{
					$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
					if($resp->is_valid)
					{
						$is_captcha_true = true;
					}
					else
					{
						$is_captcha_true = false;
					}
				}
				
				if($is_captcha_true == true)
				{
						$q = mysql_query("SELECT * FROM `members` WHERE(email='{$email}')") or die(mysql_error());
						$n = mysql_num_rows($q);

							if($n)
							{
								$f = mysql_fetch_array($q);
								$uid = $f['id'];
								
								/* Generate a random reset key for generating a random password. */
								$reset_key = getGuid();
								$temp_time = time();
								$expires_at = $temp_time + 14400;//86400;
								
								$update_forgot = mysql_query("UPDATE `members` SET `pass_reset_key`='{$reset_key}', `expires_at`='{$expires_at}' WHERE(`id`={$uid})") or die(mysql_error());
								forgotpass_email($email, $reset_key);
								$err = "<div class=\"infobox\">".sprintf($_lang['password_reset_link'],$f['email'])."</div>";
								//am_showForgot();
							}
							else
							{
								$err = "<div class=\"errorbox\">{$_lang['email_not_found']}</div>";
								//am_showForgot();
							}
					}
					else
					{
						$err = "<div class=\"errorbox\">{$_lang['verification_error']}</div>";
						//am_showForgot();
					}
			}
			else
			{
				$err = "<div class=\"errorbox\">{$_lang['empty_fields']}</div>";
				//am_showForgot();
			}
			unset($objPhpCaptcha);
	}
	else
	{
		//am_showForgot();
	}
  }
  else
  {
    $isAlreadyLoggedIn = 1;
	//echo "<center><div class=\"errorbox\">{$_lang['active_session']}<br/><small>{$_lang['already_logged_in']}</small></div></center>";
  }
  $template = "forgotPassword.tpl";
  $breadcrumbs[] =  array('title'=>$_lang['forgot_password'],
  						'link'=>$website.'/user/forgot.php');
  /*$smarty->assing('user_code_img', "$website."/".MODS_DIRECTORY; ?>/captcha/visual-captcha.php");*/
  $smarty->assign('error_msg',$err);
  $smarty->assign('isAlreadyLoggedIn',$isAlreadyLoggedIn);
  

 include("footer.php");

/*?>
<img src="<?php echo $website."/".MODS_DIRECTORY; ?>/captcha/visual-captcha.php" width="200" height="60" alt="Visual CAPTCHA" />
<?php 
echo  $website."/".MODS_DIRECTORY."/captcha/visual-captcha.php";

exit; */?>