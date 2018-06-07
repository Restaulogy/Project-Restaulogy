<?php 
  include("../init.php");
  include("header.php");
  $title = $_lang['password_generation'];
	$k = get_input('k');
	$u = get_input('u');
	$new_password = get_input('new_password','');
	$err='';
  
  if($sesslife == false)
  {
	if(is_not_empty($k))
	{
		$key = mysql_real_escape_string($k);
			if($key != "")
			{
				if(is_not_empty($u))
				{
					$key_user = mysql_real_escape_string($u);
						if($key_user != "")
						{
							$check = mysql_query("SELECT * FROM `members` WHERE(`email`='{$key_user}') AND (`pass_reset_key`='{$key}')") or die(mysql_error());
								if(mysql_num_rows($check))
								{
									$pass_fetch = mysql_fetch_array($check);
									$expiry_time = $pass_fetch['expires_at'];
									$key_uid = $pass_fetch['id'];
									$time_now = time();
										if($expiry_time < $time_now)
										{
											$err = "<div class=\"errorbox\">{$_lang['time_expired']}<br/><small>{$_lang['generate_link']}</small></div>";
										}
										else
										{
											//$new_password = createRandomPassword();
											if(is_not_empty($new_password)){
												$encrypt_password = generate_encrypted_password($new_password);
												$reset_query = mysql_query("UPDATE `members` SET `password`='{$encrypt_password}', `pass_reset_key`=NULL, `expires_at`=NULL WHERE(`id`={$key_uid})") or die(mysql_error());
												//$err = "<div class=\"infobox\">Successfully changed the password.<a href='{$website}/".USER_DIRECTORY."/login'>Click here to Login</a></div>";	
												$_SESSION[SES_FLASH_MSG]  ='<div class="info">Successfully changed the password.</div>';
												if(is_gt_zero_num($_SESSION[SES_TABLE]))
 														$table_id = $_SESSION[SES_TABLE];
												else	
														$table_id =	0;
														
												$_restaurant = $_SESSION[SES_RESTAURANT];		
														
												$prop=LogMeIn($key_user,$new_password,$table_id,1,0,$_restaurant);
												
												if(is_gt_zero_num($_SESSION[SES_TABLE]))
													biz_script_forward($website.'/user/dashboard.php');
												else
													biz_script_forward($website.'/user/index.php');
											}									
											//newpass_email($key_user, $new_password);
											//$err = "<div class=\"infobox\">{$_lang['new_password_sent']}<br/><small>{$_lang['contact_admin']}</small></div>";
										}
								}
								else
								{
									$err = "<div class=\"errorbox\">{$_lang['reset_not_found']}<br/><small>{$_lang['generate_link']}</small></div>";
									$is_error=1;
								}
						}
						else
						{
							$err = "<div class=\"errorbox\">{$_lang['invalid_link']}<br/><small>{$_lang['contact_admin']}</small></div>";
							$is_error=1;
						}
				}
				else
				{
					$err = "<div class=\"errorbox\">{$_lang['invalid_link']}<br/><small>{$_lang['contact_admin']}</small></div>";
				}
			}
			else
			{
				$err = "<div class=\"errorbox\">{$_lang['invalid_link']}<br/><small>{$_lang['contact_admin']}</small></div>";
			}
	}
	else
	{
		$err = "<div class=\"errorbox\">{$_lang['invalid_link']}<br/><small>{$_lang['contact_admin']}</small></div>";
	}
  }else{
	$err = "<div class=\"errorbox\">{$_lang['active_session']}<br/><small>{$_lang['already_logged_in']}</small></div>";
	$is_error=1;
  }
 $smarty->assign('error_msg',$err);

 $smarty->assign('isAlreadyLoggedIn',$isAlreadyLoggedIn);	
 $smarty->assign('k',$k);
 $smarty->assign('u',$u);
 
 $template = "passreset.tpl";  
 include("footer.php");

?>