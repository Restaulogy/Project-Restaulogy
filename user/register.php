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
  $breadcrumbs[] =  array('title'=>$_lang['join_now'],
  						'link'=>$website.'/user/register.php'); 
  $isAlreadyLoggedIn = 0;
  /* extra JS file to be included for the show password option (jquery). */
  $js = "<script type=\"text/javascript\" src=\"{$website}/".JS_DIRECTORY."/jquery.showpassword.js\"></script>
  <script type=\"text/javascript\">
  $(function() {
  $('#pass').showPassword('#showpass');
  });
  </script>";
  //subheader($_lang['register'], NULL, $js);
	$email = get_sql_input("email","");
	$password = get_sql_input("password","");
	$member_role_id = get_sql_input("member_role_id",4);
	$fname = get_sql_input("fname","");
	$lname = get_sql_input("lname","");
	$zip = get_sql_input("zip","");
	$phone = get_sql_input("phone","");
	$address = get_sql_input('address',"");
	$designation = get_sql_input("designation","");
	$device_id = get_sql_input("device_id","");
	$gcm_id = get_sql_input("gcm_id","");
	$description = get_sql_input("description",""); 
	$city = get_sql_input("city","");
	$metro = get_sql_input("metro","");
	$state = get_sql_input("state","");
	$country = get_sql_input("country","US");
	$fax = get_sql_input("fax","");
	$website = get_sql_input("website","");	
	$restaurant = get_input("restaurant",$_SESSION[SES_RESTAURANT]);	
	$isManager = get_input("isManager",0);
	
	$is_reward = get_sql_input("is_reward",0);
	$reward_bal_visits = get_sql_input("reward_bal_visits",0);
	$reward_bal_points = get_sql_input("reward_bal_points",0);
	
	$sms_subscribed = get_sql_input("sms_subscribed",0);

 
/*if($sesslife == false) {*/
/* This is to ensure that the user session is false. If it is true, throw an error. */
  if(isset($_POST['join']))
  {
	/* Input sanitization class to filter the user input and show errors if they contain 
	malicious entry. */ 
 
		/* If email and password are not empty. If they are show an error and display the form. */  
		if(is_not_empty($email) && is_not_empty($password) && is_not_empty($lname) && is_not_empty($fname))
		{
	  
				 /*if($inbuilt_captcha == 1){
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
				} */
				$is_captcha_true=true;
				 
				if($is_captcha_true == true)
				{
				
					if(isValidEmail($email))
					{
						//$q = mysql_query("SELECT * FROM `members` WHERE (email = '{$email}')") or die(mysql_error());
						$q = mysql_query('SELECT `id` FROM `'.MEMBERS.'` INNER JOIN `'.TBL_STAFF.'` ON `'.MEMBERS.'`.`id` = `'.TBL_STAFF.'`.`staff_member_id` WHERE `staff_restaurent` = '.$restaurant.' AND `email`="'.$email.'";') or die(mysql_error());	
						$n = mysql_num_rows($q);
						
						//..check unique phone validation
						$is_found=0;
						if(is_not_empty($phone)){				
							tbl_staff::readArray(array('isActive'=>1,STAFF_PHONE=>$phone),$is_found,1);
						}	 
						 
						if(!$n && !$is_found)
						{							
							/* getGuid() function generates a random unique 32 character unique key. */
							$key = getGuid();
								if($user_verification == 1)
								{
									$verified = 0;
								}
								else
								{
									$verified = 1;
								}
							
							$join = date("d M Y");
							
							/* Here the user password gets encrypted using a secure algorithm. */
							$password = generate_encrypted_password($password);
  
  /*echo "$email, $password, $lname, $fname, $key, $verified, $join,  $member_role_id, $zip, $phone,$address";*/
							/*$w = mysql_query("INSERT INTO `members` (`password` ,`email` ,`key` ,`verified` ,`join`)VALUES ('{$password}', '{$email}', '{$key}', {$verified}, '{$join}')") or die(mysql_error());*/
						$obj = new members();
						$w = $obj->create($email,$password,$lname,$fname,$key,$verified,$join,$member_role_id,$zip,$phone,$address,$designation,$device_id,$gcm_id,$description,$city,$metro,$state,$country,$fax,$website,$restaurant,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed);						 
							 $restaurant_info = tbl_restaurent::GetInfo($restaurant);							 
							 	
								if($w)
								{
									if($user_verification == 1)
									{
										verification_email($email, $key);
										$err = '<div class="infobox">'.sprintf($_lang['registration_success'],$restaurant_info[RESTAURENT_NAME]).'<br/><small>'.$_lang['verify_your_email'].'</small></div>';
									}
									else
									{
										newuser_email($email,$restaurant_info[RESTAURENT_NAME]);
										//$err = "<div class=\"infobox\">{$_lang['registration_success']}<br/><small>{$_lang['start_now']}</small></div>";
										$err = '<div class="infobox">'.sprintf($_lang['registration_success'],$restaurant_info[RESTAURENT_NAME]).'<br/><small>'.$_lang['verify_your_email'].'</small></div>';
									}
									//am_showRegister();
								
								//..for assing the new manager to the restaurant.	
								if($isManager){
									$restObj = new tbl_restaurent();
									if($restObj->readObject(array(RESTAURENT_ID=>$restaurant))){
										$restObj->setrestaurent_owner($w);
										$restObj->insert();					
									}
									unset($restObj);
								 }
								}
								else
								{
									$err = "<div class=\"infobox\">{$_lang['unable_to_register']}<br/><small>{$_lang['try_again_later']}</small></div>";
									//am_showRegister();
								}
						}
						else
						{
							if($n){
								$err = "<div class=\"errorbox\">{$_lang['email_exists']}<br/><small><a href='{$website}/user/resend.php'>{$_lang['resend_confirmation_link']}</a></small></div>";
							}elseif($is_found){
								$err = "<div class=\"errorbox\">{$_lang['phone_exists']}<br/><small><a href='{$website}/user/resend.php'>{$_lang['resend_confirmation_link']}</a></small></div>";
							}							
							//am_showRegister();
						}
					}
					else
					{
					 
						$err = "<div class=\"errorbox\">{$_lang['invalid_email']}</div>";
						//am_showRegister();
					}
				}
				else
				{
					$err = "<div class=\"errorbox\">{$_lang['verification_error']}</div>";
					//am_showRegister();
				}
		}
		else
		{
			$err = "<div class=\"errorbox\">{$_lang['empty_fields']}</div>";
			//am_showRegister();
		}
  }
  else
  {
	//am_showRegister();
	
  } 
  	$smarty->assign('state_list',getStates($country));
	$smarty->assign('restaurant_list',tbl_restaurent::GetFields(array("key_field"=>RESTAURENT_ID,"value_field"=>RESTAURENT_NAME,'isActive'=>1)));
    $template = "register.tpl";
/*}
else
{
	$isAlreadyLoggedIn = 1;
	//echo "<center><div class='errorbox'>{$_lang['active_session']}<br/><small>{$_lang['already_logged_in']}</small></div></center>";
	$template = "index.tpl";
}*/
  
	
  $smarty->assign('isAlreadyLoggedIn',$isAlreadyLoggedIn);
  

  include("footer.php");

?>