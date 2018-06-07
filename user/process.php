<?php 
 include("../init.php");
 
 //..capture the table id
 if(isCustomer()){
 		$cust_current_table=$_SESSION[SES_TABLE];
 }
 //captur the previous page
 //..if logged in from the 
/*	if(is_not_empty($_SESSION['prev_page']) && ($_SESSION['prev_page']=='reward')){
			$prev_page='reward';			
	}*/
 
 //echo "table=".$_SESSION[SES_TABLE];
 //echo " || rest=".$_SESSION[SES_RESTAURANT];
 $restaurant = get_input("restaurant",$_SESSION[SES_RESTAURANT]);
 $lst_dup_php_em = get_input("lst_dup_php_em",'');
 
 //echo "|| restaurant=$restaurant";
 
 
	/* Include required files as per the admin option of inbuilt captcha enabled or not. */
	if($inbuilt_captcha == 1)
	{
		include("../".MODS_DIRECTORY."/captcha/php-captcha.inc.php");
	}
	else
	{
		include("../".MODS_DIRECTORY."/recaptchalib.php");
	}
 
 if(isset($_GET['r']))
 {
	$r = htmlspecialchars(trim($_GET['r']));
	/* Time to be used for setcookie function which for the remember me feature. */
	$time = time();
 }

	if($r == 'verify')
	{
		if(isset($_POST["login"]))
		{
			$username = mysql_real_escape_string($_POST["username"]);
			$password = mysql_real_escape_string($_POST["password"]);
			
			if(isset($_POST["autologin"]))
			{
				$autologin = mysql_real_escape_string($_POST["autologin"]);
			}
			else
			{
				$autologin = 0;
			}
			//...ADDED THIS FOR STORING THE COOKIE LOGIN..SANGRAM
   		$autologin = 1;
			
			if(($username != "") && ($password != ""))
			{
				/* Encypting the password using the same alogrithm. This is the only way
				in which we can match the user passwords. */
				
				$password = generate_encrypted_password($password);
				
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
						//$q = "SELECT * FROM `members` WHERE (email = '{$username}') and (password = '{$password}')";
						//echo "SELECT `members`.*,`staff_restaurent`,`staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE `email`='{$username}' and `password` = '{$password}' AND `staff_restaurent` = '.$restaurant.';";
						$a = mysql_query("SELECT `members`.*,`staff_restaurent`,`staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE `email`='{$username}' and `password` = '{$password}' AND `staff_restaurent` = '.$restaurant.';") or die(mysql_error());
						if(!($result_set = mysql_query($q))) die(mysql_error());
						$n2 = mysql_num_rows($result_set);
 						$id = mysql_result($result_set,"id");
						
							if(!$n2)
							{
								$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['id_pass_mismatch']}</div>";
								header("Location: {$website}/".USER_DIRECTORY."/login.php?r=verify");
							}
							else
							{
								$f = mysql_fetch_array($result_set);
								$verified = $f['verified'];
								$banned = $f['banned'];  
								$banned = isValidDate($f['staff_end_date']) ? $banned: 0;
						  		
								$member_id = $f['id'];
								$member_role_id = $f['member_role_id'];
								
								//..set the restaurant after login
								if(is_gt_zero_num($f['staff_restaurent'])){
									$_SESSION[SES_RESTAURANT]=$f['staff_restaurent'];
								}
			 					 
								 if($verified == 0)
								{
									$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['email_not_verified']}<br/><small><a href='{$website}/".USER_DIRECTORY."/resend.php'>{$_lang['resend_confirmation_link']}</a></small></div>";
									header("Location: {$website}/".USER_DIRECTORY."/login.php?r=verify");
								}
								else
								{
									if($banned == 1)
									{
										$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['account_banned']}<br/><small>{$_lang['contact_admin']}</small></div>";
										header("Location: {$website}/".USER_DIRECTORY."/login.php?r=verify");
									} 
									else 
									{
									 $objtbl_emp_sft = new tbl_emp_shift_assignment();	 
									 if($member_role_id == ROLE_WAITER){
										if($objtbl_emp_sft->checkEmployeeWithinShift($member_id)==OPERATION_FAIL){
											$_SESSION['error'] =  "<div class=\"errorbox\">".$_lang['emp_cannot_login_this_time']."</div>";
											header("Location: {$website}/".USER_DIRECTORY."/login.php?r=verify"); 
										}										
									 }
									 
									 if($member_role_id==ROLER_MANAGER || $member_role_id==ROLER_ADMIN){
										if($objtbl_emp_sft->checkEmployeeWithinShift(0,0)==OPERATION_FAIL){
											$_SESSION[SES_FLASH_MSG]="<div class=\"error\">".$_lang['schedule_unavailable']."</div>";
										}		
									 }
									 unset($objtbl_emp_sft);
									 
										if($autologin == 1)
										{
											setcookie("authuser", $username, $time + 3600*24*365);
											setcookie("authpass", $password, $time + 3600*24*365);
											setcookie("authrest", $restaurant, $time + 3600*24*365);
										}
										$_SESSION['error'] = NULL;
										$date = date("d M Y");
										/*$q = mysql_query("UPDATE `members` SET `access` = '{$date}' WHERE `email`='{$username}'");
										$up = mysql_query("UPDATE `members` SET `login_attempt`=0 WHERE `email`='{$username}' LIMIT 1") or die(mysql_error());*/			
										
										$q = mysql_query("UPDATE `members` SET `access` = '{$date}' WHERE `id`='{$member_id}'");
										$up = mysql_query("UPDATE `members` SET `login_attempt`=0 WHERE `id`='{$member_id}' LIMIT 1") or die(mysql_error());
												
										$_SESSION["user"] = $username;
										$_SESSION["pass"] = $password; 
										$_SESSION['authrest']=$restaurant;
										echo "<center><br/><br/><img src=\"{$website}/images/working.gif\" /></center>";
										if($member_role_id == ROLE_CUSTOMER){
											echo "<meta http-equiv=\"Refresh\" Content=\"5;URL={$website}/user/dashboard.php\" />";
										}else{
											echo "<meta http-equiv=\"Refresh\" Content=\"5;URL={$website}/\" />";
										}
									}
								}
							}
					}
					else
					{
						$_SESSION['error'] = "<div class=\"errorbox\">{$_lang['verification_error']}</div>";
						header("Location: {$website}/".USER_DIRECTORY."/login.php?r=verify");
					}
			}
			else
			{
				$_SESSION['error'] = "<div class=\"errorbox\">{$_lang['empty_fields']}</div>";
				header("Location: {$website}/".USER_DIRECTORY."/login.php?r=verify");
			}
		}
	} 
	elseif($r == 'reg') 
	{
	
	if(isset($_POST["login"]))  {
		
		$username = mysql_real_escape_string($_POST["username"]);
		$password = mysql_real_escape_string($_POST["password"]);		
		
		$_password=$password;//..store original pwd for diffnt betn employee & cust login		
		//$phone= str_replace(array('+', '-'), '', filter_var($username, FILTER_SANITIZE_NUMBER_INT));
		$phone=_get_us_phone($username);
		
		if(is_not_empty($phone)==FALSE){
			$phone=$username;
			$phone1=$username;
		}else{
			$phone1=_get_us_phone($username,1);
		}
		
		if(isset($_POST["autologin"]))
		{
			$autologin = mysql_real_escape_string($_POST["autologin"]);
		}
		else
		{
			$autologin = 0;
		}   
	//...ADDED THIS FOR STORING THE COOKIE LOGIN..SANGRAM
   		$autologin = 1;
			
			if(($username != "") && ($password != ""))
			{
				/* Encypting the password using the same alogrithm. This is the only way
				in which we can match the user passwords. */
				
				$password = generate_encrypted_password($password);
				//..Changes made since we need the session restaurant
				/*$a = mysql_query("SELECT `login_attempt` FROM `members` WHERE (`email`='{$username}')") or die(mysql_error());*/
				//echo "SELECT `members`.`id`,`login_attempt`,`staff_restaurent`, `staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE `email`='{$username}' AND `staff_restaurent`='{$restaurant}';";
				//exit;				
				
				if(is_not_empty($lst_dup_php_em)){
						$a = mysql_query("SELECT `members`.`id`,`members`.`email`,`members`.`password`,`login_attempt`,`staff_restaurent`, `staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE `email`='{$lst_dup_php_em}' AND `staff_restaurent`='{$restaurant}';") or die(mysql_error());	
				}else{											
						$a = mysql_query("SELECT `members`.`id`,`members`.`email`,`members`.`password`,`login_attempt`,`staff_restaurent`, `staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE (`email`='{$username}' OR `staff_phone`='{$phone}' OR `staff_phone`='{$phone1}') AND `staff_restaurent`='{$restaurant}';") or die(mysql_error());	
				}			
				
				$ac = mysql_num_rows($a);
				
				if($ac && $ac>1)
				{
					$_rows=array();
					$_SESSION['error'] =  "<div class=\"infobox\">There are {$ac} rewards account associated with this phone number.Please select your email address from the drop down list to get you to the right rewards account.</div>";
					header("Location: {$website}/".USER_DIRECTORY."/login.php?r=verify&pst_email={$phone}&ph_dupl=1&restaurant={$restaurant}");				
					
				}elseif($ac && $ac==1){
					$f = mysql_fetch_array($a);
					$m_id=$f['id'];
					$login_attempt = $f['login_attempt'];
					
					//..If it is the default 'sample' then store the password hash from the DB
					//echo "_password=$_password||password=$password||db_password=".$f['password'];
					if($_password=='sample'){
						$password=$f['password'];
					}					
					//exit;
					//..Set the restaurant after login
					//if((is_gt_zero_num($f['staff_restaurent'])) && (is_gt_zero_num($_SESSION[SES_RESTAURANT])==false)){
					//if(is_gt_zero_num($_SESSION[SES_RESTAURANT])==false){
						$_SESSION[SES_RESTAURANT]=$f['staff_restaurent'];
					//}
					  
					$banned = isValidDate($f['staff_end_date']) ? 1: 0; 
						
					if(is_gt_zero_num($banned)==FALSE){
						if($login_attempt > 4){
							$_SESSION['error'] = "<div class=\"errorbox\">{$_lang['attempts_exceeded']}</div>";
							header("Location: {$website}/".USER_DIRECTORY."/login.php?r=verify");
					}else{
								//$q = "SELECT * FROM `members` WHERE (`email`='{$username}') and (`password`='{$password}')";
								//$q = 'SELECT `members`.* FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$restaurant.' AND `email`="'.$username.'" and `password`="'.$password.'";';		
								$q = 'SELECT `members`.* FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$restaurant.' AND (`email`="'.$username.'"  OR `staff_phone`="'.$phone.'" OR `staff_phone`="'.$phone1.'") AND `password`="'.$password.'";';	
																				 							
								if(!($result_set = mysql_query($q))) die(mysql_error());
								$n2 = mysql_num_rows($result_set);
 
								if(!$n2)
								{
									$attempt = $login_attempt + 1;
									//$up = mysql_query("UPDATE `members` SET `login_attempt`={$attempt} WHERE `email`='{$username}' LIMIT 1") or die(mysql_error());$m_id
									$up = mysql_query("UPDATE `members` SET `login_attempt`={$attempt} WHERE `id`='{$m_id}' LIMIT 1") or die(mysql_error());
									//$up = mysql_query("UPDATE `members` SET `login_attempt`=0 WHERE `id`='{$member_id}' LIMIT 1") or die(mysql_error());
									$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['id_pass_mismatch']}</div>"; 
									header("Location: {$website}/".USER_DIRECTORY."/login.php?r=reg&pst_email={$username}");
								}
								else
								{
									$f = mysql_fetch_array($result_set);
									$verified = $f['verified'];
									$banned = $f['banned'];
									$member_id = $f['id'];
									$member_role_id = $f['member_role_id'];
									//echo "verified=$verified";
									//exit;
									$objtbl_emp_sft = new tbl_emp_shift_assignment();
			 					 	if($member_role_id == ROLE_WAITER){									 	
										if($objtbl_emp_sft->checkEmployeeWithinShift($member_id)==OPERATION_FAIL){
											$_SESSION['error'] =  "<div class=\"errorbox\">".$_lang['emp_cannot_login_this_time']."</div>";
										  biz_script_forward("{$website}/".USER_DIRECTORY."/login.php?r=reg&pst_email={$username}");  
										} 
										
										$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
											 
										/*
											 MAP LOCATION BASED LOGIN
											 if((is_not_empty($rest_info[RESTAURENT_LAT])) && (is_not_empty($rest_info[RESTAURENT_LNG])) && (is_not_empty($_SESSION['client_lat'])) && (is_not_empty($_SESSION['client_long']))){
											 	
												$dist = con_lat_long_to_dist($rest_info[RESTAURENT_LAT],$rest_info[RESTAURENT_LNG], $_SESSION['client_lat'],$_SESSION['client_long'],1); 
												//echo $dist; 
												 if($dist > 200){
												 	//$_SESSION['error'] =  "<div class=\"errorbox\">".$_lang['emp_not_within_distance']."</div>";
										  		//biz_script_forward("{$website}/".USER_DIRECTORY."/login.php?r=reg");
												 }   
											 } 
										*/ 
											 
									 }elseif($member_role_id == ROLE_MANAGER){
										if($objtbl_emp_sft->checkEmployeeWithinShift(0,0)==OPERATION_FAIL){
											$_SESSION[SES_FLASH_MSG]="<div class=\"error\">".$_lang['schedule_unavailable']."</div>";										
										}
									 }elseif($member_role_id == ROLE_CUSTOMER){
									 	if(is_gt_zero_num($_SESSION[SES_TABLE])==false){
											$_SESSION[SES_FLASH_MSG] =  "<div class=\"error\">Please scan the QR code & then login.</div>";
										biz_script_forward("{$website}/".USER_DIRECTORY."/dashboard.php");  
											
										}
									 }							 	
									unset($objtbl_emp_sft);
								//echo "|| $verified=$verified";
								
									if($verified == 0)
									{
										$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['email_not_verified']}<br/><small><a href='{$website}/".USER_DIRECTORY."/resend.php'>{$_lang['resend_confirmation_link']}</a></small></div>";
										header("Location: {$website}/".USER_DIRECTORY."/login.php?r=reg&pst_email={$username}");
									}
									else
									{
										if($banned == 1)
										{
											$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['account_banned']}<br/><small>{$_lang['contact_admin']}</small></div>";
											header("Location: {$website}/".USER_DIRECTORY."/login.php?r=reg&pst_email={$username}");
										}
										else
										{		
											$username=$f['email'];
																	
											if($autologin == 1)
											{
												setcookie("authuser", $username, $time + 3600*24*365, "/");
												setcookie("authpass", $password, $time + 3600*24*365, "/");
												setcookie("authrest", $restaurant, $time + 3600*24*365, "/");
												//setcookie('validate', md5($username));
											}
											//print_r($_COOKIE);
											$_SESSION['error'] = NULL;
											$date = date("d M Y");
											//$q = mysql_query("UPDATE `members` SET `access`='{$date}' WHERE `email`='{$username}'");
											$q = mysql_query("UPDATE `members` SET `access`='{$date}' WHERE `id`='{$member_id}'");
											
											$obj = new hm_log();
											if(is_not_empty($cust_current_table)){
												$log_id = $obj->create($username, date("Y-m-d h:i:s",$cust_current_table)); 
											}else{
												$log_id = $obj->create($username, date("Y-m-d h:i:s")); 	
											}
											
											unset($obj);
											//$up = mysql_query("UPDATE `members` SET `login_attempt` = 0 WHERE `email`='{$username}' LIMIT 1") or die(mysql_error());
											$up = mysql_query("UPDATE `members` SET `login_attempt` = 0 WHERE `id`='{$member_id}' LIMIT 1") or die(mysql_error());											
																						
											$_SESSION["user"] = $username;
											$_SESSION["pass"] = $password;
											$_SESSION['log_id'] = $log_id;	
											$_SESSION['authrest']=$restaurant;
											$_SESSION[SES_RESTAURANT] =$restaurant;
												
											if(is_gt_zero_num($cust_current_table))	{
												$_SESSION[SES_TABLE]=$cust_current_table;
											}								
											
											//..logic added for redirection
											$var_url =$website;
											if($member_role_id == ROLE_CUSTOMER){
												$var_url = $website.'/user/dashboard.php';
											}
											
											if(is_not_empty($_SESSION['curr_sess_p']) && ($_SESSION['curr_sess_p']=='restaulogy')){													
													biz_script_forward($website.'/user/rest_dashboard.php');	
											}
											
											//..if logged in from the 
											if(is_not_empty($_SESSION['prev_page']) && ($_SESSION['prev_page']=='reward')){
													//unset($_SESSION['prev_page']);
													biz_script_forward($website.'/user/customer_rewards.php');	
											}
if(is_not_empty($_SESSION['prev_page']) && is_not_empty($_SESSION['prev_page_url'])){

$var_url=$_SESSION['prev_page_url'];
unset($_SESSION['prev_page']);
unset($_SESSION['prev_page_url']);
if(is_not_empty($_SESSION['prev_fdbk_stored'])){
	//store the feedback posted
	$objtbl_feedback= new tbl_feedback();
	$isSuccess = $objtbl_feedback->create($_SESSION['prev_fdbk_stored']['post_id'], $_SESSION['prev_fdbk_stored']['post_title'], $_SESSION['prev_fdbk_stored']['post_type'], $_SESSION['guid'], $_SESSION['prev_fdbk_stored']['recomm_title'], $_SESSION['prev_fdbk_stored']['recomm_desc'], $_SESSION['prev_fdbk_stored']['recomm_rating'], $_SESSION['prev_fdbk_stored']['recomm_QOS_rating'], $_SESSION['prev_fdbk_stored']['recomm_QOF_rating'], $_SESSION['prev_fdbk_stored']['recomm_ambience_rating'], '', '');
	if(is_not_empty($isSuccess)){
	if(is_gt_zero_num($isSuccess)){
	$_SESSION["disp_msg"]= '<div class="info">'.$_lang['tbl_feedback'][ACTION_CREATE]['SUCCESS_MSG'].'</div>';
	}elseif($isSuccess == OPERATION_FAIL){
	$_SESSION["disp_msg"]= '<div class="error">'.$_lang['tbl_feedback'][ACTION_CREATE]['FAILURE_MSG'].'</div>';
	}elseif($isSuccess == OPERATION_DUPLICATE){
	$_SESSION["disp_msg"]= '<div class="error">'.$_lang['tbl_feedback'][ACTION_CREATE]['DUPLICATE_MSG'].'</div>';
	}
	}//..if
	unset($_SESSION['prev_fdbk_stored']);					
}
										unset($_SESSION[SES_PROMOTION]); 
														  	
											}
											echo '<center><br/><br/><img src="'.$website.'/images/working.gif"/></center>'; 
											echo '<meta http-equiv="Refresh" Content="5;URL='.$var_url.'" />';																	
										}
									}								 
							}
						}			 															
				  	}else{
							//$_SESSION['error'] = "<div class=\"errorbox\">Only Active Staff members are allowed to login</div>"; 
							$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['account_banned']}<br/><small>{$_lang['contact_admin']}</small></div>";
							header("Location: {$website}/".USER_DIRECTORY."/login.php?r=verify&pst_email={$username}&restaurant={$restaurant}");
						}
						
				}
				else
				{
					$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['email_not_found']}</div>";
					header("Location: {$website}/".USER_DIRECTORY."/login.php?r=reg&pst_email={$username}&restaurant={$restaurant}");
				}
			}
			else
			{
				$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['empty_fields']}</div>";
				header("Location: {$website}/".USER_DIRECTORY."/login.php?r=reg&pst_email={$username}&restaurant={$restaurant}");
			}
	} 
  }
  else
  {
	if($sesslife == false) 
	{
		/* Show the login box if the session is false. */
		header("Location: {$website}/".USER_DIRECTORY."/login.php");
    }
	else
	{
		/* Error message is shown if the user visits this page even after logging in. */
		header("Location: {$website}/".USER_DIRECTORY."/login.php");
	}

  }