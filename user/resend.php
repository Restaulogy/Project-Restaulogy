<?php
  
	/*
	+--------------------------------------------------------------------------
	|   Auth Manager - Content Protection & User Management (Open Source)
	+--------------------------------------------------------------------------
	|   by ScriptsApart
	|   (c) 2011 ScriptsApart
	|   http://www.scriptsapart.com/
	+--------------------------------------------------------------------------
	|   Web: http://www.scriptsapart.com/
	|   Email: support@scriptsapart.com
	|	Facebook: http://www.facebook.com/pages/Scripts-Apart/149933518360387
	|	Twitter: http://www.twitter.com/scriptsapart
	|	Blackberry PIN: 20F03848
	|	Phone Support: +91 9871084893
	+--------------------------------------------------------------------------
	|   > Open Source(100%)
	|   > First Version: 13th September 2010
	|	> Version 2.0: 8th February 2011
	+--------------------------------------------------------------------------
	*/  
 
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
  
  /* Show this page only if the user verification is enabled by the admin. Otherwise, show
  the page not found error. */
  if($user_verification == 1)
  {
	subheader($_lang['resend_confirmation']);
  }
  else
  {
	subheader($_lang['global_error']);
  }
  
if($user_verification == 1)
{
  if($sesslife == false)
  { 
	if(isset($_POST['resend']))
	{
		$email = mysql_real_escape_string($_POST['email']);
			if($email != "")
			{
					if($inbuilt_captcha == 1)
				{
					if(PhpCaptcha::Validate($_POST['user_code']))
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
					$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
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
								$verified = $f['verified'];
								$key = $f['key'];
									
									if($verified == 0)
									{
										if($key == "")
										{
											/* getGuid() function generates a random unique 32 character unique key. */
											$key = getGuid();
											$q = mysql_query("UPDATE `members` SET `key`='{$key}' WHERE `id`={$uid} LIMIT 1") or die(mysql_error());
											verification_email($email, $key);
											$err = "<div class=\"infobox\">{$_lang['confirmation_email_sent']}</div>";
											am_showResend();
										}
										else
										{
											verification_email($email, $key);
											$err = "<div class=\"infobox\">{$_lang['confirmation_email_sent']}</div>";
											am_showResend();
										}
									}
									else
									{
										$err = "<div class=\"infobox\">{$_lang['account_active']}</div>";
										am_showResend();
									}
							}
							else
							{
								$err = "<div class=\"errorbox\">{$_lang['email_not_found']}</div>";
								am_showResend();
							}
					}
					else
					{
						$err = "<div class=\"errorbox\">{$_lang['verification_error']}</div>";
						am_showResend();
					}
			}
			else
			{
				$err = "<div class=\"errorbox\">{$_lang['empty_fields']}</div>";
				am_showResend();
			}
	}
	else
	{
		am_showResend();
	}
  } 
  else
  {
	echo "<center><div class=\"errorbox\">{$_lang['active_session']}<br/><small>{$_lang['already_logged_in']}</small></div></center>";
  }
}
else
{
	echo "<div class=\"errorbox\">{$_lang['invalid_link']}<br/><small>{$_lang['contact_admin']}</small></div>";
}

include("footer.php");

?>