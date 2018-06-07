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
 
  include_once(dirname(dirname(__FILE__)).'/init.php');
	
	//..These added since we need functions from the buss_list
   include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_list_promotions.class.php');
 
  include_once('header.php');
  //..redirect to previous page logic
  //..prev_page== the page from it comes like order,promtion,feedback create
    //..the 'action' and 'promotion_id' is only meant for the promotions
  //$prev_page=get_input('prev_page',$_SESSION['prev_page']);
  $action=get_input('action',$_SESSION['action']);
	$prom_id=get_input('prom_id',0);
	$verify_email=get_input('verify_email','');
	
	$email_from=get_input('email_from','');
	//$email_to=get_input('email_to','');
	$is_email_friend=get_input('is_email_friend',0);
      
 //.. time to capture posted values
 if(is_gt_zero_num($_SESSION[SES_TABLE]))
 	$table_id =$_SESSION[SES_TABLE]; 
 else	
 	$table_id = get_input('table_id',$_SESSION[SES_TABLE]);
	
	//$url= $website."/user/tbl_menu.php";
	$url= $website."/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR";
	
 if(isset($_POST['login'])){
	$username = get_sql_input('username');
	$password = "sample";//mysql_real_escape_string($_POST['password']);
	
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
		  $fname = 'subscriber';
			$lname = '--';
			$_hi_name=$email_from;
	}
	//echo "$fname=$fname|$lname=$lname|$_hi_name=$_hi_name";
	//$fname = get_sql_input('fname','subscriber');
	//$lname = get_sql_input('lname','--');
	$phone = get_sql_input('phone');
	//..for subscription only 
	if($prom_id==0){
		$sms_subscribed = 1;
	}else{
		$sms_subscribed = 0;
	}	
	//$sms_subscribed = 0;//get_sql_input("sms_subscribed",1);
	
	//..for Reward program only 
	$is_reward = 0;
	$reward_bal_visits = 0;
	$reward_bal_points = 0;
	$refer_by='';
	
	if(isset($_POST['autologin'])){
		$autologin = mysql_real_escape_string($_POST['autologin']);
	}else{
		$autologin = 0;
	}

	if(($username != '') && ($password != '')){			 
		 //Add it to crm users	
		 //$op=registerME($username,$password,$table_id,$fname,$lname,$phone,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed);
		 			
	  if(is_gt_zero_num($prom_id)){
			 //..START EMAIL PROMOTION			 
			 if(is_gt_zero_num($is_email_friend)){
			 		$refer_by=$email_from;
			 }else{
			 		$_SESSION[SES_CUST_NM]=$username;
			 }	
			 $crm_pm_id=0;
			 $exp_emails=explode(',',$username);		 	
			 //..Fetch crm id	and one record to crm
			 //$crm_record=DB::ExecQry('SELECT '.CRM_ID.' FROM '.TBL_CRM.' WHERE '.CRM_CUST_EMAIL.'="'.$username.'"',1);
			/* $crm_record=DB::ExecQry('SELECT '.CRM_ID.' FROM '.TBL_CRM.' WHERE '.CRM_CUST_EMAIL.'="'.$username.'" AND `'.CRM_RESTAURANT.'`='.$_SESSION[SES_RESTAURANT],1);
			 $crm_pm_id=0;*/	

			 //..Add one record to crm notify table
			/* if(is_not_empty($crm_record)){		 		
				$crm_pm_id=$crm_record[CRM_ID];				
			 } */

			//..Send::Email promotion		 
			 try {
			   $obj_prom=new pds_list_promotions();
			 	 $tmp_rslt=$obj_prom->email_promtoion($prom_id,1,$exp_emails,$crm_pm_id,$refer_by);
			 }catch(Exception $e) {
			   //echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
			 //..Send::SMS promotion
			 try {		   
				 //$sub_phone=array("+1".str_replace("-", "", trim($phone)));
				 //$tmp_rslt=$obj_prom->sms_promtoion($prom_id,$sub_phone,$crm_pm_id);
			 }catch(Exception $e) {
			   //echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
			 unset($obj_prom);	
			 
			 /*	 
			 //..Add one record to crm notify table
			 if(is_not_empty($crm_record)){
			 		$obj_crm_prom_emails=new crm_prom_emails();				
					$tmp_rslt=$obj_crm_prom_emails->create($crm_record[CRM_ID],$prom_id,0,'','');
					unset($obj_crm_prom_emails);
			 }
			 unset($crm_record);*/
			 //..END EMAIL PROMOTION
			 $_SESSION[SES_FLASH_MSG] =  '<div class="info">Successfully emailed to your friend.</div>';
			 if(is_gt_zero_num($is_email_friend)){
			 		biz_script_forward($url);
			 }
		 }else{
		 			$op=registerME($username,$password,$table_id,$fname,$lname,$phone,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed);
		 			//..START Only subscription
		 			$_SESSION[SES_FLASH_MSG] =  '<div class="info">Subscribed successfully.</div>';
					$restaurant_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
					try {
						$subject="Successfully subscribed";	
						$from=$restaurant_info[RESTAURENT_EMAIL];
						$to=$username;
						$email_body='Hi '.$_hi_name.',<br><br>
						You have been successfully subscribed to the promotions.
						<br><br> 
						Thanks,<br>
						'.$restaurant_info[RESTAURENT_NAME];
											
						@send_mail_using_php($subject,$from,$to,$email_body,$restaurant_info[RESTAURENT_NAME]);
					}catch(Exception $e) {
					  // echo 'Caught exception: ',  $e->getMessage(), "\n";
					}
					//..END Only subscription
		}			 	
		 biz_script_forward($url);	
	}	
}
/* Include required files as per the admin option of inbuilt captcha enabled or not. */
  //if(!$sesslife){	   
	 $smarty->assign('prom_id',$prom_id);
	 $smarty->assign('is_email_friend',$is_email_friend);
	 
	 $template = 'cust_login_tiny.tpl';
	 
  //} 
  
  include('footer.php');  
	
	/*
	if(is_gt_zero_num(is_email_friend)){
			 //..START IS_EMAIL_FRIEND
			  $_SESSION[SES_FLASH_MSG] =  '<div class="info">Emailed successfully to friend.</div>';
				$restaurant_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
				try {
					$subject="Recommend promotion to friend";	
					$from=$email_from;
					$to=$username;
					$email_body='Hi,<br><br>
					You have been successfully registered to the promotions.
					<br> 
					Thanks,
					'.$restaurant_info[RESTAURENT_NAME];
										
					@send_mail_using_php($subject,$from,$to,$email_body,$restaurant_info[RESTAURENT_NAME]);
				}catch(Exception $e) {
				  // echo 'Caught exception: ',  $e->getMessage(), "\n";
				}	
			 //..END IS_EMAIL_FRIEND
		 }	 	
	*/
?>