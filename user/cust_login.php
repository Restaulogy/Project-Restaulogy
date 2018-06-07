<?php
 
  include_once(dirname(dirname(__FILE__)).'/init.php');
  include_once('header.php');
	
	//..is coming from the restaulogy website
	$web_redt= get_input('web_redt',0);
  //..redirect to previous page logic
  //..prev_page== the page from it comes like order,promtion,feedback create
    //..the 'action' and 'promotion_id' is only meant for the promotions
  //$prev_page=get_input('prev_page',$_SESSION['prev_page']);
  $action=get_input('action',$_SESSION['action']);
	$_restaurant=$_SESSION[SES_RESTAURANT];
      
 //.. time to capture posted values
 if(is_gt_zero_num($_SESSION[SES_TABLE]))
 	$table_id =$_SESSION[SES_TABLE]; 
 else	
 	$table_id = get_input('table_id',$_SESSION[SES_TABLE]);
	
	//$url= $website."/user/tbl_menu.php";
	$url= $website."/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR";
  //echo "hello-". $_SESSION[SES_RESTAURANT];

 //..For already signed up members or logged in user but not signed for loyalty	
 if(($sesslife==true) && (isCustomer())){
 		//if($Global_member['is_reward']==0){
		if($Global_member['staff_is_reward']==1){
			members::update_member_is_reward($Global_member['member_id'],1);
			send_loyalty_sign_sccess_msg($Global_member['staff_full_name']);
			biz_script_forward("{$website}/user/login.php");
			//$_SESSION[SES_FLASH_MSG]  ='<div class="info">Successfully Registered.</div>';	
		}else{
			$_SESSION[SES_FLASH_MSG]  ='<div class="info">Already Registered.</div>';	
			biz_script_forward($url);
		}		
 } 
 
 //..Code to store the log of ones who have visited sign up page but not signed up
 if(($sesslife==false) && (isCustomer())){
  $sign_sess_id=session_id();
	$objtbl_open_signup_pg=new tbl_open_signup_pg();
 	$isSuccess = $objtbl_open_signup_pg->create($table_id, $sign_sess_id, '', '');
	unset($objtbl_open_signup_pg);
 }	
	
 if(isset($_POST['login'])){
	$username = get_sql_input('username');
	if(is_not_empty($username)==FALSE){
		$username	= "exusr_"._get_lst_member_id()."@tst.com";
	}
	//$password = "sample";//mysql_real_escape_string($_POST['password']);
	//$password = get_sql_input('password');
	$password = "sample";
				
	//..Logic here for separating the full name into fname & lname based on space
	$full_name = get_sql_input('full_name','');
	if(is_not_empty($full_name)){
			$_exp_names=explode(' ',$full_name);
			$_no_of_items=count($_exp_names);
			$fname = $_exp_names[0];
			if($_no_of_items>1){
				unset($_exp_names[0]);
				$lname = implode('',$_exp_names);
			}else{				
				$lname = '--';
			}		
			$_hi_name=$full_name;
	}else{
		  $fname = 'loyalty';
			$lname = 'member';
			$_hi_name=$username;
	}
	
	//$fname = get_sql_input('fname');
	//$lname = get_sql_input('lname');
	$phone = get_sql_input('phone');
	
	//..Get date from the day and month	
	$cust_dob_day = get_sql_input('cust_dob_day');
	$cust_dob_mon = get_sql_input('cust_dob_mon');
	if(is_not_empty($cust_dob_day) && is_gt_zero_num($cust_dob_mon)){
		$cust_dob= '2016-'.strval(sprintf('%02d', $cust_dob_mon)).'-'.strval(sprintf('%02d', $cust_dob_day));
	}else{
		$cust_dob=NULL;
	}
	$cust_aniversary_dt = get_sql_input('cust_aniversary_dt');	
		
			
	if(is_not_empty($phone))
		$phone=_get_us_phone_without1($phone);
	
	$sms_subscribed = get_sql_input("sms_subscribed",1);
	
	//..for Reward program only 
	$is_reward = 1;
	$reward_bal_visits = 0;
	$reward_bal_points = 0;
	
	if(isset($_POST['autologin'])){
		$autologin = mysql_real_escape_string($_POST['autologin']);
	}else{
		$autologin = 0;
	}

	if(($username != '') && ($password != '')){	
	  $_is_go_to_sign_in=0;
		//..Check if user alreday there
		$_usr_record=members::get_usr_its_rest_details($username,$_restaurant);
		if(is_not_empty($_usr_record['id'])){
			if($_usr_record['is_already_there']==0){
				//$smarty->assign('sec_rest_popup',$_usr_record['sub_rest_lst']);				
				$_is_go_to_sign_in=1;
			}
		}
		//echo "$username,$password,$table_id,$fname,$lname,$phone,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed";
		//echo "|| rest=".$_SESSION[SES_RESTAURANT];		
		//exit;
			$op=registerME($username,$password,$table_id,$fname,$lname,$phone,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed,0,0,$cust_dob,$cust_aniversary_dt);			
			if($op==1){
					//..code to send sms on new joining
					$_new_user_id=get_user_by_email($username);	
					_short_cd_sign_up($phone,$_new_user_id);
					//send_loyalty_sign_sccess_msg($phone);
					//..Exception redirection for the manager,admin
					if (($sesslife) &&(in_array($Global_member[MEMBER_ROLE_ID], array(ROLE_MANAGER,ROLE_ADMIN,ROLE_OWNER,ROLE_DEV)))){							
							biz_script_forward($website.'/user/customer_rewards.php?manager_cust_sess_id='.$_new_user_id['id']);
					}else{
							if($_is_go_to_sign_in==1){							
								//$_SESSION[SES_FLASH_MSG]='<div class="info">You are <b>already signed-up</b> with this service, when you joined the program at '.$_usr_record['sub_rest_lst'].' <br> Please sign in using the same account.If you have forgotten the password, you may reset it.</div>';													
								biz_script_forward("{$website}/user/login.php?pst_email={$username}");
							}else{
								if(is_gt_zero_num($web_redt)){
									
								}else{
									$prop=LogMeIn($username,$password,$table_id,1,0,$_restaurant);	
									if($prop)
										biz_script_forward($website.'/user/customer_rewards.php');	
								}									
							}		
					}
			 }		
				
  		//$_SESSION[SES_CUSTOMER_SESSION] = checkNcreateSession($table_id,$username,1);	
			//biz_script_forward($url);	 
  	}
	}
	

/* Include required files as per the admin option of inbuilt captcha enabled or not. */
  //if(!$sesslife){	   
	 $smarty->assign('web_redt',$web_redt);
	 $template = 'cust_login.tpl';
  //} 
  
  include('footer.php');  
?>