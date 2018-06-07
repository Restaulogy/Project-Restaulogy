<?php 

//...register to specific restaurant
function _upsert_phone_to_rest($phone,$password,$fname,$lname,$is_restaurant){
	$usrDetails=array();
	//..first check if user is registered with our system 	 			
	$_lg_rs = _check_LogMeIn($phone,$password,1,0,0,$is_restaurant);	
	if($_lg_rs['success']==4){
		//..Register to base restaurant as well with 'RN' flag ....	
		$_base_usr=array();
		$_lg_rs_1 = _check_LogMeIn($phone,$password,1,0,0,16);
		if($_lg_rs_1['success']==4){
			$email	= "exusr_"._get_lst_member_id()."@tst.com";
			$_reg_rs_2= registerME($email,'sample',0,$fname,$lname,$phone,1,0,0,1,16,0,NULL,'','RN');
			$_base_usr=$_reg_rs_2['user'];
		}else{
			$_base_usr=$_lg_rs_1['user'];
		}
		if(is_not_empty($_base_usr)){
			$fname=$_base_usr[STAFF_FNAME];
			$lname=$_base_usr[STAFF_LNAME];
		}
		//..Sign to particular restaurant		
		$email	= "exusr_"._get_lst_member_id()."@tst.com";	
		$_resp_reg= registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$is_restaurant,0,NULL,'','R');
		$_new_reg_usr = _check_LogMeIn($phone,$password,1,0,0,$is_restaurant);	
		$usrDetails= $_new_reg_usr['user'];	
		//..Send sms flag
		$my_prom_link_new_st= biz_get_tiny_url(ALL_REST_APP_PATH .'index.html#MyRewardPage');		
		$restaurant_info = tbl_restaurent::GetInfo($is_restaurant);
		$_free_offer=_getRestFreeRwd($is_restaurant);
		$_msg="Welcome to '".$restaurant_info[RESTAURENT_NAME]."'. rewards program! Click {$my_prom_link_new_st} to {$_free_offer}";
		//echo $_msg;
		$_succ=@send_sms_using_twilio(array($phone),$_msg);
	}else{
		$usrDetails=$_lg_rs['user'];
	}
	return $usrDetails;	
}

function _check_LogMeIn($username,$password,$table_id=1,$isCustomerLogin=0,$frm_chng_srv=0,$is_restaurant=1){
 global $_lang;
 
 $respose=array('success'=>0,'message'=>'','user'=>'');

if(is_gt_zero_num($is_restaurant)){
 if(is_not_empty($username) && is_not_empty($password)){			
		$password = generate_encrypted_password($password);
		$phone=_get_us_phone($username);		
		if(is_not_empty($phone)==FALSE){
			$phone=$username;
			$phone1=$username;
		}else{
			$phone1=_get_us_phone($username,1);
		}
		$a = mysql_query("SELECT `members`.`id`,`members`.`email`,`members`.`password`,`login_attempt`,`staff_restaurent`, `staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE (`email`='{$username}' OR `staff_phone`='{$phone}' OR `staff_phone`='{$phone1}') AND `staff_restaurent`='{$is_restaurant}';") or die(mysql_error());		
				
		$ac = mysql_num_rows($a);
		if($ac){
			$f = mysql_fetch_array($a); 
			if($isCustomerLogin || $frm_chng_srv){
				$res4 = mysql_query("SELECT `password` FROM `members` WHERE (`id`='".$f['id']."')");
				if($res4 && mysql_num_rows($res4)){
					$password = mysql_result($res4,0);
				}
			}
			
			$q = 'SELECT `members`.* FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$is_restaurant.' AND (`email`="'.$username.'"  OR `staff_phone`="'.$phone.'" OR `staff_phone`="'.$phone1.'") AND `password`="'.$password.'";';
			if(!($result_set = mysql_query($q))) die(mysql_error());
			$n2 = mysql_num_rows($result_set);
			if($n2){
				$f = mysql_fetch_array($result_set);
				$verified = $f['verified'];
				$banned = $f['banned'];
				$user_id = $f['id'];
				if($verified == 0){
					$respose['success']=2;
					$respose['message']=$_lang['email_not_verified'];
				}else{
					if($banned == 1){						
						$respose['success']=3;
						$respose['message']=$_lang['account_banned'];
					}else{						
						$date = date("d M Y");
						$updateMembers = mysql_query("UPDATE `members` SET `access`='{$date}', `login_attempt` = 0 WHERE `email`='{$username}'");
						$respose['success']=1;
						$respose['message']='Logged in successfully';
						$respose['user']=get_user($user_id);
					} 
				}
			}				 
		}else{
			$respose['success']=4;
			$respose['message']=$_lang['email_not_found'];
		}			 
	}  
 }else{
 		$respose['success'] = 5;
		$respose['message'] = 'Restaurant not provided';
 }
 return $respose; 
}

function _getRestFreeRwd($rest_id){
	$sql="SELECT `p`.`comments` 
		  FROM `biz_rewards` `r` 
		  INNER JOIN `pds_list_promotions` `p` ON 
		  `r`.`rwd_coupon_id`=`p`.`id` 
		  WHERE `rwd_buss_id`={$rest_id} AND `rwd_type`='point_based' AND `rwd_lr_type`='m' AND `rwd_is_one_time`=1";
		  //..`CONCAT(`r`.`rwd_cup_id`,':',`p`.`comments`) 
	$reslt=DB::ExecScalarQry($sql);
	return $reslt;
}

function _is_restaulogy_usr($phone){
	/*$sql="SELECT `staff_signup_flg`, 
			 (SELECT COUNT(`staff_id`)
			  FROM `tbl_staff`  
			  WHERE `staff_phone`='{$phone}') as `no_of_rest_reg`
		  FROM `tbl_staff`  
		  WHERE `staff_phone`='{$phone}' AND `staff_restaurent`=16";*/
	$sql="SELECT `staff_signup_flg`
		  FROM `tbl_staff`  
		  WHERE `staff_phone`='{$phone}' AND `staff_restaurent`=16";	  		  
	$reslt=DB::ExecScalarQry($sql);
	/*if(is_not_empty($reslt)){		
	}*/
	return $reslt;
}

function _get_bs_rest_usr($phone){
	$sql="SELECT *
		  FROM `tbl_staff`  
		  WHERE `staff_phone`='{$phone}' AND `staff_restaurent`=16";
	$reslt=DB::ExecQry($sql,1);

	return $reslt;
}

function _add_prom_to_usr_fav($user_id,$prom_id){
	if($user_id>0 && $prom_id>0){
		$result = mysql_query('Select `id` from `pds_list_favorites` where `list_id`='.$prom_id.' and `user_id` ='.$user_id.' and `ispromotion`=1');
		if ($result)
		{
	  		$count = mysql_num_rows($result);
		}
		if ($count == 0)
		{
		    $sql = 'insert into `pds_list_favorites`
			  		( `list_id`, `user_id`,`customer_name`, `created_date`, `ispromotion`)
					   values
					   ('.mysql_real_escape_string($prom_id).','.
					     mysql_real_escape_string($user_id).',\'\',
						 Now(),1)' ;							 
		    mysql_query($sql);
		 }
	}	
}

function get_userid_rest_by_group($_member_id){
	$_output=array('user_ids'=>'','rest_ids'=>'');
	$_usr_det=get_user($_member_id);
		
	//..first get the restaurants by group
	//..From restaurant id fetch group id
	$_rst_det=tbl_restaurent::GetInfo($_usr_det[STAFF_RESTAURENT]);
	$sql='SELECT GROUP_CONCAT(`'.RESTAURENT_ID.'`) 
					FROM `'.TBL_RESTAURENT.'` 
					WHERE `'.RESTAURENT_GROUP.'`='.$_rst_det[RESTAURENT_GROUP];
					
	$_output['rest_ids']=DB::ExecScalarQry($sql);
	
	//..get userids from the selecetd restaurant 
	$sql='SELECT GROUP_CONCAT(`id`) FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `'.STAFF_PHONE.'`="'.$_usr_det[STAFF_PHONE].'" AND `'.STAFF_RESTAURENT.'` IN ('.$_output['rest_ids'].') AND `members`.`banned`=0;';
	
	$_output['user_ids']=DB::ExecScalarQry($sql);	
	
	return $_output;
}

//..START..SAN ..07/02/2018
function get_user_for_all_rest($phone){
	$mem_wt_det=array();
	$member = array();	
	//..Phone checking	
	if(is_gt_zero_num($phone)){		
		$q = mysql_query('SELECT GROUP_CONCAT(`id`) FROM `members` 
INNER JOIN  `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id`
INNER JOIN `tbl_restaurent` ON `tbl_restaurent`.`restaurent_id`=`tbl_staff`.`staff_restaurent` WHERE `staff_phone`="'.$phone.'" AND `members`.`banned`=0 AND (`tbl_restaurent`.`restaurent_end_date` IS NULL OR `tbl_restaurent`.`restaurent_end_date` = 0 OR `tbl_restaurent`.`restaurent_end_date`>CURDATE());') or die(mysql_error());
	
		/*$q = mysql_query('SELECT GROUP_CONCAT(`id`) FROM `members` 
INNER JOIN  `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id`
INNER JOIN `tbl_restaurent` ON `tbl_restaurent`.`restaurent_id`=`tbl_staff`.`staff_restaurent` WHERE `staff_phone`="'.$phone.'" AND `members`.`banned`=0 AND ((`tbl_restaurent`.`restaurent_id`=16) OR (`tbl_restaurent`.`restaurent_end_date` IS NULL OR `tbl_restaurent`.`restaurent_end_date` = 0 OR `tbl_restaurent`.`restaurent_end_date`>CURDATE()))') or die(mysql_error());*/

		/*$q = mysql_query('SELECT GROUP_CONCAT(`id`) FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_phone`="'.$phone.'" AND `members`.`banned`=0;') or die(mysql_error());*/	
		$n = mysql_num_rows($q);	
		if($n){
			$member_id = @mysql_result($q,0);
			if(is_not_empty($member_id))
				$member = explode(',',$member_id);
			foreach($member as $_ech_mem_id){
				$mem_wt_det[$_ech_mem_id]=get_user($_ech_mem_id);
			}				
		}	
	}							
	return $mem_wt_det;	
}
//..END..SAN ..07/02/2018

//..Function to get deafult table from restaurant:
function _gt_deflt_table_by_rest($_rest_id){
	$sql="SELECT `".TABLE_ID."` FROM `".TBL_DINING_TABLE."` WHERE `".TABLE_RESTAURANT."`={$_rest_id} ORDER BY `".TABLE_ID."` ASC LIMIT 1;";
	$_rest_id=DB::ExecScalarQry($sql);
	return $_rest_id;
}

//..FUnction will check if user is phone there in db else create one and return the user deatails
function upsert_usr_by_phone($cust_phone){
	$usrDetails=array();
	//..check if email exists in members  
	//$UsrReturned=get_user_by_email($order_customer_name); get_user_by_phone_no
	$UsrReturned=get_user_by_phone_no($cust_phone); 

	if(is_not_empty($UsrReturned)){
		$usrDetails=$UsrReturned;
	}else{
		$new_use_email	= "exusr_"._get_lst_member_id()."@tst.com";
		$password='sample';
		$fname='guest';
		$lname='user';
		$is_reward=1;
		$reward_bal_visits=$reward_bal_points=0;
		$sms_subscribed=1;					
		$op=registerME($new_use_email,$password,$order_table_id,$fname,$lname,$cust_phone,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed);
		if($op==1){	
			$usrDetails=get_user_by_email($new_use_email); 
			//$order_customer_id=$UsrReturned['id'];
		}
	}
	return $usrDetails;	
}
//..Function will check if user is phone there in db else create one and return the user deatails
function upsert_usr_by_email($cust_email){
	$usrDetails=array();
	//..check if email exists in members  
	//$UsrReturned=get_user_by_email($order_customer_name); get_user_by_phone_no
	$UsrReturned=get_user_by_email($cust_email); 

	if(is_not_empty($UsrReturned)){
		$usrDetails=$UsrReturned;
	}else{
		$password='sample';
		$fname='guest';
		$lname='user';
		$is_reward=1;
		$reward_bal_visits=$reward_bal_points=0;
		$sms_subscribed=1;					
		$op=registerME($cust_email,$password,$order_table_id,$fname,$lname,'',$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed);
		if($op==1){	
			$usrDetails=get_user_by_email($cust_email);			
		}
	}
	return $usrDetails;	
}
function uset_nor_session(){
	$_SESSION['nor_tot_new_ord']=0;
	$_SESSION['nor_order_id']=0;
	$_SESSION['nor_table_id']=0;
	$_SESSION['nor_order_customer_name']='';
}

//..fetch active menu/dish images of the restaurant 
function get_rest_dsh_mnu_imgs($_restaurant){
	$_img_lst=array();
	//..fetch active dish images of the restaurant 
	$result = mysql_query("SELECT `".DISH_IMG."` FROM `".TBL_DISHES."` WHERE `".DISH_RESTAURENT."`={$_restaurant} AND `".DISH_IMG."`<> '' AND (".TBL_DISHES_DEACTIVE_DATE." is NULL OR ".TBL_DISHES_DEACTIVE_DATE." = 0 OR ".TBL_DISHES_DEACTIVE_DATE." > NOW( ));");
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	   $_img_lst[]=PATHROOT.'/uploads/dish/'.$row[0];  
	}	
	//..fecth active menu images of the restaurant
	$result = mysql_query("SELECT `".MENU_IMAGE."` FROM `".TBL_MENU."` WHERE `".MENU_RESTAURENT."`={$_restaurant} AND `".DISH_IMG."`<> '' AND (".TBL_MENU_DEACTIVE_DATE." is NULL OR ".TBL_MENU_DEACTIVE_DATE." = 0 OR ".TBL_MENU_DEACTIVE_DATE." > NOW( ));");
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	   $_img_lst[]=PATHROOT.'/uploads/menu/'.$row[0];  
	}
	return $_img_lst;	
}

//..destroys the customer reward session.
function _destroy_cust_reward_sess(){
	 unset($_SESSION[SES_REWARD]);
	 unset($_SESSION[IS_RWD_AUTH]);
	 unset($_SESSION['sel_reward_sess']);
	 unset($_SESSION[CUST_TBL_ID]);
	 unset($_SESSION[CUST_REQUEST_TYPE]);
}
//..send message for add points.
function _add_award_pt_sms($member_id,$_rest,$_award_pts=0){
	//From restaurant id fetch group id
	//$_rst_det=tbl_restaurent::GetInfo($_rest);
	//..Check what is current points
	$overall_stat=biz_rewards::getRewardUserStats($member_id,$_rest);
	//print_r($overall_stat);
	//..Check which is nearest prom
	$obj_biz_rewards=new biz_rewards();
	$lst_rewards=$obj_biz_rewards->readArray(array(RWD_BUSS_ID=>$_rest,"is_within_range"=>1,"isActive"=>1,"rwd_type"=>'point_based',SORT_BY=>'ASC',SORT_ON=>RWD_ID));
	$overall_stat=biz_rewards::getRewardUserStats($member_id,$_rest);
	$_pts_to_reach=array();
	$_is_it_point=0;
	
	foreach($lst_rewards as $_reward){
		//..Check if the reward is applicable for the member
		$rwd_id=$_reward[RWD_ID];
		//..fetch the reward record
		if($obj_biz_rewards->readObject(array("rwd_id"=>$rwd_id))){	
			//if(is_gt_zero_num($overall_stat['total_points'])){
				if($obj_biz_rewards->getrwd_lr_type()=='rm'){
					//..Recurring milestone	rm
					$not_used=intval(($overall_stat['total_points']-$obj_biz_rewards->getrwd_basic())/$obj_biz_rewards->getrwd_point_limit());						
					if(is_gt_zero_num($not_used)){							
						$not_used=($not_used-$overall_stat['redeem_points']);
						if(is_gt_zero_num($not_used)){
							$_is_it_point=1;
							$_pts_to_reach[$obj_biz_rewards->getrwd_coupon_id()]=abs($not_used);
							break;
						}
					}else{
						$not_used=abs(intval(($overall_stat['balance_points']-$obj_biz_rewards->getrwd_basic())));
						$_pts_to_reach[$obj_biz_rewards->getrwd_coupon_id()]=$not_used;
					}
					
				}elseif($obj_biz_rewards->getrwd_lr_type()=='b'){
						//..Basic type b LR type
						//..Still you can use=(balance - basis)/points
						$not_used=intval(($overall_stat['balance_points']-$obj_biz_rewards->getrwd_basic())/$obj_biz_rewards->getrwd_point_limit());
						if(is_gt_zero_num($not_used)){
							$_is_it_point=2;
							$_pts_to_reach[$obj_biz_rewards->getrwd_coupon_id()]=$not_used;
						}else{							
							$_pts_to_reach[$obj_biz_rewards->getrwd_coupon_id()]=abs(intval(($overall_stat['balance_points']-$obj_biz_rewards->getrwd_basic())-$obj_biz_rewards->getrwd_point_limit()));
						}						
				}elseif($obj_biz_rewards->getrwd_lr_type()=='m'){
					if(($obj_biz_rewards->getrwd_point_limit()==0) && ($obj_biz_rewards->getrwd_is_one_time()==1)){			
					}else{
						$not_used=intval(($overall_stat['total_points']-$obj_biz_rewards->getrwd_basic())/$obj_biz_rewards->getrwd_point_limit());
						if(is_gt_zero_num($not_used)){	
							//..except one time coupon						
							if(($obj_biz_rewards->getrwd_is_one_time()==1)  && (in_array($rwd_id,$overall_stat['redeemed_rewards_lst']))){
							}else{								 
								$_is_it_point=2;
								$_pts_to_reach[$obj_biz_rewards->getrwd_coupon_id()]=1;				
							}
						}else{
							$_pts_to_reach[$obj_biz_rewards->getrwd_coupon_id()]=abs(intval(($overall_stat['total_points']-$obj_biz_rewards->getrwd_basic())-$obj_biz_rewards->getrwd_point_limit()));
						}	
					}					
				}
			//}
	  }											
	}
	$_response='';
	//print_r($_pts_to_reach);
	if(is_not_empty($_pts_to_reach)){
		$_prom_specifics=_get_prom_specifics(key($_pts_to_reach));
		if($_is_it_point==1){
			$_response='You can redeem '.current($_pts_to_reach).' points based on offer "'.$_prom_specifics['title'].'"';	
		}elseif($_is_it_point==2){
			$_response='You can redeem an offer of "'.$_prom_specifics['title'].'"';		
		}else{
			asort($_pts_to_reach);
			$_response= 'You need '.current($_pts_to_reach).' more points to get offer of "'.$_prom_specifics['title'].'"';	
		}		
	}
	//print_r($_response);
	unset($obj_biz_rewards);
	//..get user details
	$_usr_det=get_user($member_id);
	//echo $_response;
	if(is_gt_zero_num($_award_pts)){
		$_response= "{$_award_pts} points are added to your account.". $_response;
		//..Change loyalty level..based on balance point
		tbl_loyalty_level::GetNewLevelByPoints($member_id,$overall_stat['balance_points']);
	}
	if(is_gt_zero_num($_award_pts) && is_not_empty($_response) && is_not_empty($_usr_det[STAFF_PHONE]) ){
		send_sms_using_twilio(array($_usr_det[STAFF_PHONE]),$_response);
	}	
	return $_response;
}

function _short_cd_sign_up($_phone,$_usr_det=array()){
	global $website;
	
	//..First add phone to loyalty if not done already
	if(is_not_empty($_usr_det)==FALSE)
		$_usr_det=upsert_usr_by_phone($_phone);	
	//print_r($_usr_det);
	//exit;
	
	//..START..SAN ..07/02/2018
	//...Add user to restaulogy base with 'DN' flag ..
	$email	= "exusr_"._get_lst_member_id()."@tst.com";
	$_reg_rs_2= registerME($email,'sample',0,$_usr_det[STAFF_FNAME],$_usr_det[STAFF_LNAME],$_phone,1,0,0,1,16,0,NULL,'','DN');
	//..END..SAN ..07/02/2018
	
	$restaurant_info = tbl_restaurent::GetInfo($_usr_det[STAFF_RESTAURENT]);
	try {
		$prom_link=biz_get_tiny_url($website."/user/short_cd_signup.php?rst=".$_usr_det[STAFF_RESTAURENT]."&srt_cd_ph=".base64_encode($_usr_det['id']));
		$prom_link = biz_get_tiny_url($prom_link);
		$_unsub_lnk ='';
		$_act_crm_id=tbl_crm::get_crm_id_from_email($_usr_det['email']);
		if(is_gt_zero_num($_act_crm_id)){	
			$_unsub_lnk = ' Unsubscribe:'.biz_get_tiny_url("{$website}/user/tbl_crm_unsubscribe.php?crm_id={$_act_crm_id}");
		}
		//..Current message
		//$_msg=" Congrats, as a member you receive promotions from '".$restaurant_info[RESTAURENT_NAME]."'. Free signup offer {$prom_link}. {$_unsub_lnk}";
		//..mod Message
		$my_prom_link_new_st= biz_get_tiny_url(ALL_REST_APP_PATH .'index.html#MyRewardPage');
		//$_msg=" Congrats, you are member of '".$restaurant_info[RESTAURENT_NAME]."'. Free signup offer {$prom_link}. Check promotion {$my_prom_link_new_st}";	
		$_free_offer=_getRestFreeRwd($_usr_det[STAFF_RESTAURENT]);
		$_msg="Welcome to '".$restaurant_info[RESTAURENT_NAME]."'. rewards program! Click {$my_prom_link_new_st} to {$_free_offer}";
				
		//$_msg=" Congrats, By joining you have opted to receive promotions from '".$restaurant_info[RESTAURENT_NAME]."'. Use {$prom_link} to check free signup offer. {$_unsub_lnk}";
		/*$_msg=" Congratulations, By joining you have opted to receive promotions and special offers from '".$restaurant_info[RESTAURENT_NAME]."'. Here is the link {$prom_link} to check free signup offer. {$_unsub_lnk}";*/
		//$_msg=" Congratulations on joining '".$restaurant_info[RESTAURENT_NAME]."' rewards program. By joining you have opted to receive promotions and special offers from '".$restaurant_info[RESTAURENT_NAME]."'. Here is the link {$prom_link} to check free signup offer. {$_unsub_lnk}";
		
		//$_msg=" Congratulations on joining '".$restaurant_info[RESTAURENT_NAME]."' rewards program. Click {$prom_link} to check free signup offer.";
		//echo "$_phone | $_msg";		
		$_succ=@send_sms_using_twilio(array($_phone),$_msg);
		
	}catch(Exception $e) {
	  // echo 'Caught exception: ',  $e->getMessage(), "\n";
	}	
}

function send_loyalty_sign_sccess_msg($_phone){
	global $website;
		
	$restaurant_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
	try {
		/*$prom_link=biz_get_tiny_url($website."/user/customer_rewards.php");
		$prom_link = biz_get_tiny_url($prom_link);
		$prom_link = "<a href='{$prom_link}'> Link</a><br/>" ;
		
		$_msg=" Congratulations on joining '".$restaurant_info[RESTAURENT_NAME]."' rewards program. By joining you have opted to receive promotions and special offers from '".$restaurant_info[RESTAURENT_NAME]."'. Here is the {$prom_link} to check free signup offer. Please type STOP to stop receiving offers";	
		send_sms_using_twilio(array($_phone),$_msg);*/
		/*
		$subject="Successful registration";	
		$from=$restaurant_info[RESTAURENT_EMAIL];
		$to=$username;
		$email_body='Hi '.$_hi_name.',<br><br>
		You have been successfully registered to the loyalty reward.
		<br><br> 
		Thanks,<br>
		'.$restaurant_info[RESTAURENT_NAME];
		//$_SESSION[SES_FLASH_MSG]  ='<div class="info">Welcome to our Rewards Program. Please click on the Add Rewards button to add reward points for your visit and call the server/manager to authorize it.</div>';	
		$_SESSION[SES_FLASH_MSG]  ='<div class="info">Thank you for joining our loyalty program! </div>';	
						
		@send_mail_using_php($subject,$from,$to,$email_body,$restaurant_info[RESTAURENT_NAME]);*/
	}catch(Exception $e) {
	  // echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

//..Create a tiny url
function biz_get_tiny_url($url)  {  
	/*$ch = curl_init();  
	$timeout = 5;  
	curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
	$data = curl_exec($ch);  
	curl_close($ch);
	return $data;*/
	 
	 	
	/*$curl = curl_init(); 
	$timeout = 5;
    $post_data = array('format' => 'json',
                       'apikey' => 'D79795260ABA0899EDBD',
                       'provider' => '0_mk',
                       'url' => $lurl );
    $api_url = 'http://tiny-url.info/api/v1/create';
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,$timeout);
    $data = curl_exec($curl);
    curl_close($curl); 
    print_r($data);
	return $data['shorturl']; */
	
	//$longUrl = "http://www.xxxxxxx.com";
    $postData = array('longUrl' => $url);
    $jsonData = json_encode($postData);

    //4
    $curlObj = curl_init(); 
    curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyCDbC0K1G3XMBF3S7Vhj-LLlLlNyViStnk');
    curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curlObj, CURLOPT_HEADER, 0);
    curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    curl_setopt($curlObj, CURLOPT_POST, 1);
    curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

    //5
    $response = curl_exec($curlObj);
    $json = json_decode($response);
    //echo "<pre>";
    //print_r($json);exit;
    //6
    curl_close($curlObj);
    $_ret_url=$url; 
    if(is_not_empty($json->id)){
		$_ret_url=$json->id;
	}
    return $_ret_url;
}

	/* All the functions for the script are included in this file. Do not modify this file
	until you know very well what you are doing. */
 
function current_url() {
    return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
}

function send_mail_using_php($subject,$from,$to,$message,$restaurant_title='') {
	
	global $webtitle;
	global $website;
	global $sending_email;
	
	if(is_not_empty($restaurant_title)){
		$webtitle =  $restaurant_title;
	}

	//$subject = "Complaint/suggetsion from {$from} on {$webtitle}";
/*
	$headers = "From: ".$from. "\r\n";
	$headers .= "Reply-To: ".$from. "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
*/

$headers = "Reply-To: {$webtitle} <{$from}>\r\n";
$headers .= "Return-Path: {$webtitle} <{$from}>\r\n";
$headers .= "From: {$webtitle} <{$from}>\r\n";

$headers .= "Disposition-Notification-To: {$from}\r\n";
$headers .= "X-Confirm-Reading-To: {$from}\r\n";

$headers .= "Organization: Restaurant\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

/* $_lang for email templates */
/* Email template for the "New user welcome" function. */	
	try {
		//echo $content. "{$customer_email}- {$prom_link} -<hr>";
		//echo "$to // $subject // $message // $headers//'-f'.$from";
		//exit;
		$mailsent = mail($to, $subject, $message, $headers,'-f'.$from);
	}catch(Exception $e){
	  // echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	return $mailsent;
}

/**
* Send Email After Order confirmed
* @param string $email
* @param string $cust_name
* @param integer $time
* @return boolean
*/ 
function orderConfirmEmail($email,$cust_name,$time) {
	
	global $webtitle;
	global $website;
	global $sending_email;

	$subject =  $webtitle.' - Order Confirmation';
	// Always set content-type when sending HTML email
	$headers  = 'MIME-Version: 1.0 '.'\r\n';
	$headers .= 'Content-Type: text/html; charset=ISO-8859-1 '.'\r\n';
	
	$headers .= 'From: '.$sending_email. '\r\n';
	$headers .= 'Reply-To: '.$sending_email. '\r\n';
	
 	$content = 'Hi, '.$cust_name;
	$content .=' <br/><br/>Your order is confirmed. You can pick up order at '.date(PH_TIME_FORMAT,strtotime("+30 minutes")).'<br/><br/>'; 
	$content .='Thanks<br/>';
	$content .=$webtitle.' <br/><a href="'.$website.'">'.$website.'</a>';
	
	$mailsent = mail($email, $subject, $content, $headers);
 	return $mailsent;
}

function newuser_email($email,$restaurant_title='') {
	
	global $webtitle;
	global $website;
	global $sending_email;
	
	if(is_not_empty($restaurant_title)){
		$webtitle =  $restaurant_title;
	}

	$subject = "Welcome to {$webtitle}";
	$headers = "From: ".$sending_email. "\r\n";
	$headers .= "Reply-To: ".$sending_email. "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	/* $_lang for email templates */
	/* Email template for the "New user welcome" function. */

	$_lang['email_new_user_welcome'] = "Hi,<br/><br/>Welcome to {$webtitle}. We are really happy to have you in our network. We hope that you enjoy our services and be a part of our 
	network forever.<br/><br/>
	--<br/>
	Thanks<br/>
	{$webtitle} Staff<br/>
	<a href=\"{$website}/\">{$website}</a>";
	
	$mailsent = mail($email, $subject, $_lang['email_new_user_welcome'], $headers);

}

function verification_email($email, $key) {

	global $webtitle;
	global $website;
	global $sending_email;
	
	$subject = "Email verification - {$webtitle}";
	$headers = "From: ".$sending_email. "\r\n";
	$headers .= "Reply-To: ".$sending_email. "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	/* $_lang for email templates */
	/* Email template for the "User verification" function. */

	$_lang['email_user_verification'] = "Hi,<br/><br/>You recently signed up at {$webtitle}. Before 
	you can start using our services, you need to verify your email. You need to click 
	on the verification link in this email to verify your account. Once verified, you will 
	be able to use our services instantly.<br/><br/>
	Please find the verification link below:<br/>
	<a href=\"{$website}/".USER_DIRECTORY."/verify.php?k={$key}\">{$website}/".USER_DIRECTORY."/verify.php?k={$key}</a><br/><br/>
	Use the above link to verify your account and start using our services instantly. Hope to see 
	you soon.<br/><br/>
	--<br/>
	Thanks<br/>
	{$webtitle} Staff<br/>
	<a href=\"{$website}/\">{$website}</a>";
	
	$mailsent = mail($email, $subject, $_lang['email_user_verification'], $headers);

}

function forgotpass_email($email, $reset_key) {

	global $webtitle;
	global $website;
	global $sending_email;

	$subject = "Password reset link - {$webtitle}";
	$headers = "From: ".$sending_email. "\r\n";
	$headers .= "Reply-To: ".$sending_email. "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	/* $_lang for email templates */
	/* Email template for the "Forgot Password" function. */

	$_lang['email_forgot_password'] = "Hi,<br/><br/>You recently requested for a password reset for
	your account with email <i>{$email}</i> on <i>{$webtitle}</i>.<br/><br/>
	Please find below the link to reset your password:<br/>
	<a href=\"{$website}/".USER_DIRECTORY."/passreset.php?k={$reset_key}&u={$email}\">{$website}/".USER_DIRECTORY."/passreset.php?k={$reset_key}&u={$email}</a><br/><br/>
	Using the above link you can able to reset your password.<br/><br/>
	--<br/>
	Thanks<br/>
	{$webtitle} Staff<br/>
	<a href=\"{$website}/\">{$website}</a>";
	
	//echo $_lang['email_forgot_password'];
	
	$mailsent = mail($email, $subject, $_lang['email_forgot_password'], $headers);

}

function newpass_email($email, $new_password) {

	global $webtitle;
	global $website;
	global $sending_email;

	$subject = "New password for {$webtitle}";
	$headers = "From: ".$sending_email. "\r\n";
	$headers .= "Reply-To: ".$sending_email. "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	/* $_lang for email templates */
	/* Email template for the "New Password" function. */

	$_lang['email_new_password'] = "Hi,<br/><br/>Please find below your newly generated password
	accessing <i>{$webtitle}</i> services. The details are:<br/><br/>
	Email: {$email}<br/>
	Password: {$new_password}<br/><br/>
	Use the above mentioned password for accessing our services from this very moment. Contact support staff if you need any assistance.<br/><br/>
	--<br/>
	Thanks<br/>
	{$webtitle} Staff<br/>
	<a href=\"{$website}/\">{$website}</a>";
	
	$mailsent = mail($email, $subject, $_lang['email_new_password'], $headers);

}

function contact_admin_email($email, $subject, $message) {
	
	global $webtitle;
	global $website;
	global $admin_email;

	$subject = "Message via Contact Form - {$webtitle}";
	
	$headers = "From: ".$email. "\r\n";
	$headers .= "Reply-To:" .$email. "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$_lang['email_contact_admin'] = "Hi,<br/><br/>A message has been sent via {$webtitle} contact form using {$email} as email.<br/><br/>
	Please find the message below:<br/><br/>
	{$message}<br/><br/>
	--<br/>
	Thanks<br/>
	{$webtitle} Staff<br/>
	<a href=\"{$website}/\">{$website}</a>"; 
	$mailsent = mail($admin_email, $subject, $_lang['email_contact_admin'], $headers);

}

function isValidEmail($email) {
	return filter_var($email,FILTER_VALIDATE_EMAIL);
 //return preg_match('/^(\w+((-\w+)|(\w.\w+))*)\@(\w+((\.|-)\w+)*\.\w+$)/',$email);
}
function isValidPhone($email) {
	//return filter_var($email, FILTER_SANITIZE_NUMBER_INT);
    return preg_match('/^[789]\d{9}$/',$email);
}

function createRandomPassword() {
    
	$chars = 'abcdefghijkmnopqrstuvwxyz023456789';
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;

}

function am_showLogin() {

	global $website;
	global $webtitle;
	global $user_verification;
	global $_lang; ?>
	
	<center><form method="POST" action="<?php echo $website."/".USER_DIRECTORY; ?>/process.php?r=reg" name="myForm">
	<div class="logindiv">
	<div id="logindiv-header"><p><?php echo $webtitle; ?> <?php echo $_lang['login']; ?></p></div>
	<?php echo $_SESSION['error']; ?>
	<table>
	<tr><td class="first"><label><?php echo $_lang['email']; ?>: </label></td>
	<td><input type="text" name="username"></td></tr>
	<tr><td class="first"><label><?php echo $_lang['password']; ?>: </label></td>
	<td><input type="password" name="password"></td></tr>
	<tr><td class="first"><?php echo $_lang['remember_me']; ?></td>
	<td><input type="checkbox" name="autologin" value="1" />&nbsp;<small><?php echo $_lang['dont_use_public']; ?></small></td></tr>
	<tr><td></td>
	<td><div id="quickLinks"><p><a href="<?php echo $website."/".USER_DIRECTORY; ?>/forgot.php"><?php echo $_lang['forgot_password']; ?>?</a></p>
	
	<?php /* If user verification is disabled by admin then hide this resend verification
	link from the users. */
	if($user_verification == 1)
	{ ?>
	<p><a href="<?php echo $website."/".USER_DIRECTORY; ?>/resend.php"><?php echo $_lang['resend_confirmation']; ?></a></p>
	<?php } ?>
	
	</div></td></tr>
	<tr><td></td>
	<td><input type="submit" name="login" value="<?php echo $_lang['login']; ?>" class="button" /></td></tr>
	</table></div></form></center>

<?php }

function am_showSmallLogin() {

	global $_lang;
	global $website;
	global $user_verification;
	global $webtitle; ?>
	
	<form method="POST" action="<?php echo $website."/".USER_DIRECTORY; ?>/process.php?r=reg" name="myForm">
	<div class="logindiv" style="width:400px;">
	<div id="logindiv-header"><p><?php echo $webtitle; ?> <?php echo $_lang['login']; ?></p></div>
	<table>
	<tr><td class="first"><label><?php echo $_lang['email']; ?>: </label></td>
	<td><input type="text" name="username"></td></tr>
	<tr><td class="first"><label><?php echo $_lang['password']; ?>: </label></td>
	<td><input type="password" name="password"></td></tr>
	<tr><td class="first"><?php echo $_lang['remember_me']; ?></td>
	<td><input type="checkbox" name="autologin" value="1" />&nbsp;<small><?php echo $_lang['dont_use_public']; ?></small></td></tr>
	<tr><td></td>
	<td><div id="quickLinks"><p><a href="<?php echo $website."/".USER_DIRECTORY; ?>/forgot.php"><?php echo $_lang['forgot_password']; ?>?</a></p>
	
	<?php /* If user verification is disabled by admin then hide this resend verification
	link from the users. */
	if($user_verification == 1)
	{ ?>
	<p><a href="<?php echo $website."/".USER_DIRECTORY; ?>/resend.php"><?php echo $_lang['resend_confirmation']; ?></a></p>
	<?php } ?>
	
	</div></td></tr>
	<tr><td></td>
	<td><input type="submit" name="login" value="<?php echo $_lang['login']; ?>" class="button" /></td></tr>
	</table></div></form>

<?php }

function getGuid() {

	$strGuid = md5(uniqid(rand(), 1));
	
	return $strGuid;

}

/* Two salts are used to securely encrypt the password. Its encrypts the password in such a
way that decryption of the password is not possible. Moreover, a user password reset is used
in case the user forgets its password. There is no way to recover the password. It is advised 
that you should not change the salt once your site is live. */

define('SALT_ONE', 'some_random_123_collection_&$^%_of_stuff');
define('SALT_TWO', 'another_random_%*!_collection_ANbu_of_stuff');

function generate_encrypted_password($str) {

	$new_pword = '';

		 if(defined('SALT_ONE')):
			$new_pword .= md5(SALT_ONE);
		endif; 

		$new_pword .= md5($str);

		 if(defined('SALT_TWO')):
			$new_pword .= md5(SALT_TWO);
		endif; 

	return substr($new_pword, strlen($str), 40);

}

function am_showForgot() {
  
	global $_lang;
	global $website;
	global $publickey;
	global $inbuilt_captcha;
	global $webtitle;
	global $err; ?>
	
	<center><form method="POST" action="<?php echo $website."/".USER_DIRECTORY; ?>/forgot.php">
	<div class="logindiv">
	<div id="logindiv-header"><p><?php echo $_lang['reset_password']; ?></p></div>
	<?php echo $err; ?>
	<table>
	<tr><td class="first"><?php echo $_lang['email']; ?>:</td>
	<td><input type="text" name="email" id="email" size="25" /><br/><small><?php echo $_lang['enter_the_email']; ?></small></td></tr>
	<tr><td class="first"><?php echo $_lang['verify']; ?>:</td>
	
	<?php /* Use the captcha as per the admin choice. Two captcha options are included. One
	is the inbuilt captcha and other is using the reCAPTCHA online captcha service. */
	if($inbuilt_captcha != 1)
	{ ?>
		<td><?php echo recaptcha_get_html($publickey); ?></td>
	<?php }
	else
	{ ?>
		<td><img src="<?php echo $website."/".MODS_DIRECTORY; ?>/captcha/visual-captcha.php" width="200" height="60" alt="Visual CAPTCHA" /><br/>
		<input type="text" name="user_code" id="code" size="25" /></td>
	<?php } ?>

	</tr>
	<tr><td></td>
	<td><input type="submit" name="forgot" class="button" value="<?php echo $_lang['reset_password']; ?>" /></td></tr>
	<tr><td></td>
	<td><small><?php echo $_lang['already_on']; ?> <?php echo $webtitle; ?>? <a href="<?php echo $website."/".USER_DIRECTORY; ?>/login.php"><?php echo $_lang['login']; ?></a></small></td></tr>
	</table></div></form></center>

<?php 

}

function showcaptcha() {

	global $_lang;
	global $website;
	global $webtitle;
	global $inbuilt_captcha;
	global $publickey; ?>

	<center>
	<form method="POST" action="<?php echo $website."/".USER_DIRECTORY; ?>/process.php?r=verify" name="myForm">
	<div class="logindiv">
	<div id="logindiv-header"><p><?php echo $_lang['verify_login']; ?></p></div>
	<?php echo $_SESSION['error']; ?>
	<table>
	<tr><td class="first"><label><?php echo $_lang['email']; ?>: </label></td>
	<td><input type="text" name="username"></td></tr>
	<tr><td class="first"><label><?php echo $_lang['password']; ?>: </label></td>
	<td><input type="password" name="password"></td></tr>
	<tr><td class="first"><?php echo $_lang['remember_me']; ?></td>
	<td><input type="checkbox" name="autologin" value="1" />&nbsp;<small><?php echo $_lang['dont_use_public']; ?></small></td></tr>
	<tr><td class="first"><label><?php echo $_lang['verify']; ?>: </label></td>
	
	<?php /* Use the captcha as per the admin choice. Two captcha options are included. One
	is the inbuilt captcha and other is using the reCAPTCHA online captcha service. */
	if($inbuilt_captcha != 1)
	{ ?>
		<td><?php echo recaptcha_get_html($publickey); ?></td>
	<?php }
	else
	{ ?>
		<td><img src="<?php echo $website."/".MODS_DIRECTORY; ?>/captcha/visual-captcha.php" width="200" height="60" alt="Visual CAPTCHA" /><br/>
		<input type="text" name="user_code" id="code" size="25" /></td>
	<?php } ?>
	
	</tr>
	<tr><td></td>
	<td><input type="submit" name="login" class="button" value="<?php echo $_lang['login']; ?>" /></td></tr>
	<tr><td></td>
	<td><small><a href="<?php echo $website."/".USER_DIRECTORY; ?>/forgot.php"><?php echo $_lang['click_here']; ?></a> <?php echo $_lang['recover_your_password']; ?>.</small></td></tr>
	</table>
	</div></form>
	</center>
	
<?php 

} 


function am_showRegister() {

	global $_lang;
	global $website;
	global $publickey;
	global $inbuilt_captcha;
	global $webtitle;
	global $err;
	$obj = new hm_member_role();
 	$roles = $obj->GetMemberRoles();
	unset ($obj);
	$obj = new hm_tbl_md();
	$providers = $obj->GetProvider();
	unset ($obj);

	$obj = new hm_facility();
	$facilities = $obj->GetActiveFacilities();

    unset($obj);
	 
	 ?>
	<center><form method="POST" action="<?php echo $website."/".USER_DIRECTORY; ?>/register.php" id='frm_register' name='frm_register'>
	<div class="logindiv">
	<div id="logindiv-header"><p><?php echo $_lang['register_at']; ?> <?php echo $webtitle; ?></p></div>
	<?php echo $err; ?>
	<table>
	<tr><td class="first"><?php echo $_lang['email']; ?>:</td>
	<td><input type="text" name="email" id="email" maxlength="100" /><br/><small><?php echo $_lang['username_notice']; ?></small></td></tr>
	<tr><td class="first"><?php echo $_lang['password']; ?>:</td>
	<td><input type="password" name="pass" id="pass" maxlength="32" /><br/><label><input id="showpass" type="checkbox" /><small>Show password</small></label></td></tr>
	<tr><td class="first"><label><?php echo $_lang['fname']; ?>: </label></td>
	<td>
		<input type="text" name="fname" id="fname" maxlength="100"/> 
	</td> 
	</tr>
	<tr><td class="first"><label><?php echo $_lang['lname']; ?>: </label></td>
	<td>
		<input type="text" name="lname" id="lname" maxlength="100"/> 
	</td> 
	</tr>
	<tr>  
	 	<td class="first"><label><?php echo $_lang['zip']; ?> : </label></td>
			 <td>
		<input type="text" name="zip" id="zip" maxlength="10" /> 
	 	</td>
	</tr>
	
	<tr><td class="first"><label><?php echo $_lang['phone']; ?> : </label></td>
			 <td>
		<input type="text" name="phone" id="phone" maxlength="15"/> 
	</td> </tr> 
	
	<tr><td class="first"><label><?php echo $_lang['user_type']; ?>: </label></td>
	<td>
 
		<select name='member_role_id' id='member_role_id' onchange='change_user_type();'>
		<?php   
			foreach ($roles as $role){
				echo "<option value=\"{$role['id']}\">{$role['name']}</option>";
			} 
		?>	 
		</select>
	</td> 
	</tr>
	<tr class="staff_row" >
	 <td class="first"><label>Facility :</label></td>
	 <td >
		<select name='facilty' id='facilty'>
			<option value=''>Select facilty</option>
    		<?php
    			foreach ($facilities as $fcltyID => $fcltyVal){
    				echo "<option value=\"{$fcltyID}\">{$fcltyVal}</option>";
    			}
    		?>
		</select>
	</td>
	</tr>
	<tr class='provider_row' style='display:none;'>
	 <td class="first"><label>Providers :</label></td>
	<td> 
		<select name='parent[]' id='parent' onchange='change_user_type();' multiple="multiple">
			<option value=''>Select Provider</option>
		<?php 
	  
			foreach ($providers as $provider){
				echo "<option value=\"{$provider['id']}\">{$provider['name']}</option>";
			} 
		?>	 
		</select>
	</td>
	</tr>
	<tr class='patient_row' style='display:none;'>
	 <td class="first"><label><?php echo $_lang['dob']; ?>: </label></td>
	<td><input type="text" name="dob" id="dob" readonly="readonly"/></td>
	</tr>
	<tr class='patient_row' style='display:none;'>
	 	<td class="first"><label><?php echo $_lang['ss_no']; ?>: </label></td>
	<td><input type="text" name="ss_no" id="ss_no" maxlength="30"/> </td>
	</tr>
	<tr class='doctor_row'>
	  <td class="first"><label><?php echo $_lang['license']; ?>: </label></td>
	<td><input type="text" name="license" id="license" maxlength="30"/></td>
	</tr>
	<tr class='doctor_row'>
	 	<td class="first"><label><?php echo $_lang['license_expiry']; ?>: </label>
        </td>
	    <td><input type="text" name="license_expiry" id="license_expiry" readonly="readonly"/></td>
	</tr>
	
	<tr><td class='first'><?php echo $_lang['verify']; ?>:</td>
	
	<?php /* Use the captcha as per the admin choice. Two captcha options are included. One
	is the inbuilt captcha and other is using the reCAPTCHA online captcha service. */
	if($inbuilt_captcha != 1)
	{ ?>
		<td><?php echo recaptcha_get_html($publickey); ?></td>
	<?php }
	else
	{ ?>
		<td><img src="<?php echo $website."/".MODS_DIRECTORY; ?>/captcha/visual-captcha.php" width="200" height="60" alt="Visual CAPTCHA" /><br/>
		<input type="text" name="user_code" id="user_code" size="25" /></td>
	<?php } ?>

	</tr>
	<tr><td></td>
	<td><input type="submit" name="join" class="button" value="<?php echo $_lang['join_now']; ?>" />
	<input type="hidden" id="min_value" value="0"/>
	</td></tr>
	<tr><td></td>
	<td><small><?php echo $_lang['already_on']." ".$webtitle; ?>? <a href="<?php echo $website."/".USER_DIRECTORY; ?>/login.php"><?php echo $_lang['login']; ?></a></small></td></tr>
	</table></div></form></center>
	<script type="text/javascript">
	$(document).ready(function(){
 
 $('#frm_register').validate(
 {
  rules: {
    fname: { 
      required: true
    },
    lname: {  
      required: true
    },
    email: {
     required: true,
      email: true
    },
    pass: {
      minlength: 6,
      required: true
    },
	zip: {
	  USzip: true   
	  
    },
	'parent[]': { 
		roles : function () { return $('#min_value').val(); }
	},
	phone: {
	  phoneUS: true  
    },
	user_code : {
		required : true
	},
	dob : {
        birthdate : true
    },
    license_expiry: { 
      expiry_date : true
    }

  },
  messages: {
  	fname: { 
      required: '<br>Please Enter First Name'
    },
    lname: { 
      required: '<br>Please Enter Last Name'
    },
    email: {
     required: '<br>Please Enter Email',
      email: '<br>Please Enter Proper Email'
    },
    pass: { 
	  minlength : '<br>Password should contain at least 6 letters',
      required: '<br>Please Enter Password'
    },
	zip: {
	  USzip: '<br>Please Enter US Format Zip',     
    },
	'parent[]': {
		roles : '<br>Please Select at least one Provider',  
	},
	phone: { 
      phoneUS: '<br>Please Enter US Format Phone'    
    },
	user_code: {
		required : '<br>Please Enter captcha'
	},
    license_expiry: {
      expiry_date : '<br>Should be grater than todays date'
    }
  }
 });
}); // end document.ready
	</script>
<?php 

} /* Registration form display function ends over here. We can now include it any
  number of times in this page. */
  
  function am_showEdit_profile($username) {

	global $_lang;
	global $website;
	global $publickey;
	global $inbuilt_captcha;
	global $webtitle;
	global $err; 
	$member = new members(); 
	$info = $member->GetInfo(0,$username);
 
		if(!empty($info)) {
		extract($info); 
	?>
	
	<center><form method="POST" action="<?php echo $website."/".USER_DIRECTORY; ?>/editprofile.php" name='frm_edit_profile' id='frm_edit_profile'>
	<div class="logindiv">
	<div id="logindiv-header"><p><?php echo $_lang['edit_profile']; ?></p></div>
	<?php echo $err; ?>
	<table>
	<tr><td class="first"><label><?php echo $_lang['email']; ?>: </label></td>
	<td>
		 <?php echo $email;?>
	</td> 
	</tr>
	 
	 
	<tr><td class="first"><label><?php echo $_lang['fname']; ?>: </label></td>
	<td>
		<input type="text" name="fname" id="fname" maxlength="100" value="<?php echo $first_name;?>"/> 
	</td> 
	</tr>
	<tr><td class="first"><label><?php echo $_lang['lname']; ?>: </label></td>
	<td>
		<input type="text" name="lname" id="lname" maxlength="100" value="<?php echo $last_name;?>"/> 
	</td> 
	</tr>
	<tr>  
	 	<td class="first"><label><?php echo $_lang['zip']; ?>:</label></td>
			 <td>
		<input type="text" name="zip" id="zip" maxlength="10" value="<?php echo $zip;?>"/> 
	 	</td> 
	</tr>
	<tr>  
	 	<td class="first"><label><?php echo $_lang['phone']; ?>:</label></td>
		<td>
		<input type="text" name="phone" id="phone" maxlength="15" value="<?php echo $phone;?>"/> 
	</td> 
	</tr>  
	<?php
	 if ($member_role_id == 3){ 
	 ?>
	 	<tr class='patient_row'>
			 <td class="first"><label><?php echo $_lang['dob']; ?>:</label></td>
			<td><input type="text" name="dob" id="dob" readonly="readonly"/></td>
			</tr>
			<tr class='patient_row'>
			 	<td class="first"><label><?php echo $_lang['ss_no']; ?>: </label></td>
			<td><input type="text" name="ss_no" id="ss_no" maxlength="30" value="<?php echo $ss_no;?>"/> </td>
			</tr>
	 <?php
	 }else{  
	 	if($member_role_id == 2 && is_gt_zero_num($parent)){?>
			   <tr><td class="first">Provider:</td><td><?php echo $parent_name; ?></td></tr>	
			<?php } ?>
	 	 <tr class='doctor_row'>
			  <td class="first"><label><?php echo $_lang['license']; ?>: </label></td>
			<td><input type="text" name="license" id="license" maxlength="30" value="<?php echo $license;?>"/></td>
			</tr>
			<tr class='doctor_row'>
			 	<td class="first"><label><?php echo $_lang['license_expiry']; ?>: </label></td>
			<td><input type="text" name="license_expiry" id="license_expiry" value="<?php echo $license_expiry;?>" readonly="readonly"/></td>
		 	</tr>
             <tr class='doctor_row'>
			 	<td class="first"><label>Facilities: </label></td>
			     <td><div style='width:87%;display:inline-block;'><?php echo $facilities;?></div><input type="button" onclick='window.open("<?php echo WWWROOT;?>user/md_facility.php")' class="button" value="..." /></td>
		 	</tr>
	 <?php
	 	}
	?>  
	<tr><td></td>
	<td><input type="submit" name="editprofile" class="button" value="<?php echo $_lang['edit_profile']; ?>" /> <input type="reset" name="cancel" class="button" value="Cancel" />
	<input type="hidden" name='member_role_id' value='<?php echo $member_role_id; ?>'/>
	<input type="hidden" name='member_id' value='<?php echo $member_id;?>'/>
	</td></tr>  
	</table></div></form></center>
	<script type="text/javascript">
	$(document).ready(function(){
 
 $('#frm_edit_profile').validate(
 {
  rules: {
    fname: { 
      required: true
    },
    lname: {  
      required: true
    },
	zip: {
	  USzip: true  
    },
	phone: {
	  phoneUS: true   
    },
	<?php
	if ($member_role_id == 3){ 
	?>
	dob: {
	  required: true,
	  birthdate : true
    }
	<?php }else{ ?>
	license: {
	  required: true
    },
	license_expiry: {
	  expiry_date: true 
    }	
	<?php }
	?> 
	
  },
  messages: {
  	fname: { 
      required: '<br>Please Enter First Name'
    },
    lname: { 
      required: '<br>Please Enter Last Name'
    },
	zip: {
	  USzip: '<br>Please Enter US Format Zip'   
    },
	phone: { 
      phoneUS: '<br>Please Enter US Format Phone no.'    
    },
	<?php
		if ($member_role_id == 3){ 
	?>
	dob: {
	  required: '<br>Please Select DOB'    
    }
	<?php }else{ ?>
	license: {
	  required: '<br>Please Enter license no'     
    },
	license_expiry: { 
      expiry_date : '<br>Should be grater than todays date'
    }	
	<?php } ?> 
  }
 });
 	<?php
	 if($member_role_id == 3){ 
		echo '$( "#dob" ).datepicker( "setDate", "'.date('m/d/Y', strtotime($DOB)).'" );';
	 }else{
	 	echo '$( "#license_expiry" ).datepicker( "setDate", "'.date('m/d/Y', strtotime($license_expiry)).'" );';
	 }
	?>
	
}); // end document.ready
	</script>
<?php }else{
		echo "<i> Not Created Profile.</i>";
	}
  }
  
function am_showChangePassword() {
	global $website, $err;
?>
<div class="row">
<div class="span6">
<?php echo $err; ?>
<form class="form-horizontal" method="POST" action="<?php echo $website."/".USER_DIRECTORY; ?>/changepassword">
<fieldset>
	<div class="control-group">
		<label class="control-label" for="current_password"><?php echo _("Current Password"); ?></label>
		<div class="controls">
			<input type="password" class="input-xlarge" id="current_password" name="current_password" autocomplete="off">
			<span class="help-block">
				<small>
					(<?php echo _("Please enter your current password over here."); ?>)
				</small>
			</span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="new_password"><?php echo _("New Password"); ?></label>
		<div class="controls">
			<input type="password" class="input-xlarge" id="new_password" name="new_password" autocomplete="off">
			<span class="help-block">
				<label class="checkbox">
					<input type="checkbox" id="showpass"><small><?php echo _("Show Password"); ?></small>
				</label>
			</span>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary" name="changepassword" value="<?php echo _("Save Changes"); ?>">
		</div>
	</div>
</fieldset>
</form>
</div>

<div class="span5 offset1">
	<h4><?php echo _("Info"); ?></h4>
	<p><?php echo _("Once your password is changed successfully, you will be logged out of the website and will be required to sign in again with your new password."); ?></p>
</div><br/>
</div>

<?php
}

function cleanInput($input) {
	$search = array(
	'@<script[^>]*?>.*?</script>@si',   /* strip out javascript */
	'@<[\/\!]*?[^<>]*?>@si',            /* strip out HTML tags */
	'@<style[^>]*?>.*?</style>@siU',    /* strip style tags properly */
	'@<![\s\S]*?--[ \t\n\r]*>@'         /* strip multi-line comments */
	); 
	$output = preg_replace($search, '', $input);
	return $output;
} 

function admin_contact() {
	global $website, $_setting, $inbuilt_captcha, $err;
?>
<div class="page-header">
	<h1><?php echo _("Contact Us"); ?></h1>
</div>
<div class="row">
<div class="span6">
<?php echo $err; ?>
<form class="form-horizontal" method="POST" action="<?php echo $website."/".STATIC_DIRECTORY; ?>/contact">
<fieldset>
	<div class="control-group">
		<label class="control-label" for="email"><?php echo _("Email"); ?></label>
		<div class="controls">
			<input type="text" class="input-xlarge" id="email" name="email" autocomplete="off">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="message"><?php echo _("Message"); ?></label>
		<div class="controls">
			<textarea class="span4" id="message" name="message" rows="10"></textarea>
		</div>
	</div>
<?php
/*
use the captcha as per the admin choice. two captcha options are included. one is the inbuilt captcha and other is using the reCAPTCHA online captcha service.
*/
	echo "<div class=\"control-group\">
		<label class=\"control-label\" for=\"autologin\">"._("Are you Human?")."</label>
		<div class=\"controls\">";
			if($inbuilt_captcha != 1) {
				echo recaptcha_get_html($_setting['recaptcha_public']);
			} else {
				echo "<img src=\"{$website}/".MODS_DIRECTORY."/captcha/visual-captcha\" width=\"200\" height=\"60\" alt=\"Visual CAPTCHA\" /><br/><input type=\"text\" class=\"input-xlarge\" name=\"user_code\" id=\"code\" autocomplete=\"off\" />";
			}
		echo "</div>
	</div>";
?>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary" name="contact" value="<?php echo _("Send Message"); ?>">
		</div>
	</div>
</fieldset>
</form>
</div>

<div class="span3 offset3">
<h4><?php echo _("Reach Us"); ?></h4>
<p><?php echo _("You can also reach us via following means:"); ?></p>
<small><?php echo _("support@stitchapps.com")."<br/>"._("Mobile: +91 9871084893"); ?></small>
</div>
</div>

<?php
}

//..code by sangram 03-29-2013
//..following functions for connect to business listing

function checkIfUserInBL() {
	$userid=$_SESSION['guid'];
	$username = $_SESSION['user'];
	$useremail = $_SESSION['user'];

    //$md5password = md5($username);
	$md5password =$_SESSION['pass'];
    $query = 'SELECT id FROM pds_user WHERE id='.$userid;
	//$query = 'SELECT id FROM pds_user WHERE login='$username' AND pass='$md5password'';
	  $result = mysql_query($query);
		if($result){
			$num_rows = mysql_num_rows($result); 
	    if (!$num_rows) {
	        	mysql_query('INSERT INTO pds_user (id,login, pass, usermail, joindate) VALUES ('.$userid.',\''.$username.'\', \''.$md5password.'\', \''.$useremail.'\', now());');		
		}else{
	         mysql_query('UPDATE pds_user SET login=\''.$username.'\',pass=\''.$md5password.'\' WHERE id='.$userid);         
	    }
		}
    
    return $userid;
}


function getListingIDByUser($userid,&$num_rows = 0){
    $query = 'SELECT id FROM pds_list WHERE userid='.$userid.' order by id asc';
    $result = mysql_query($query); 
    $num_rows = mysql_num_rows($result);
    if ($num_rows > 0){
       $listing_id = mysql_result($result, 0);
    }  
    return $listing_id;
}
 
function getMeMyBL() {
	global $Global_member;
    $userid=$_SESSION['guid'];
	$username = $_SESSION['user'];
	$useremail = $_SESSION['user'];
   /*
    $query = "SELECT id FROM pds_list WHERE userid=$userid order by id asc";
    $result = mysql_query($query);
    $num_rows = mysql_num_rows($result);
   */
    $num_rows = 0;
    $tmp_my_lst_id = getListingIDByUser($userid,$num_rows);
    //...get the state and metro from profile
    $metro_profile='NULL';
    $state_profile='NULL';
    if ((isset($Global_member["staff_metro"]))&& ($Global_member["staff_metro"]!="")){
        $qry = "SELECT a.metro_id, s.id
                        FROM pds_states s
                        INNER JOIN metro_area a ON s.abbrev = a.metro_abv
                        WHERE a.metro_id=".$Global_member["staff_metro"];
                        //echo "qry=$qry <br>";
        $reslt = mysql_query($qry);
        if($reslt){
            $r_st_mt = mysql_fetch_assoc($reslt);
            if ($r_st_mt){
               $metro_profile=$r_st_mt['metro_id'];
               $state_profile=$r_st_mt['id'];
            }
        }
        mysql_free_result($reslt);
    }

    //echo "num rows=$num_rows//metro_area=$metro_area//username=$username//metro_profile=$metro_profile//state_profile=$state_profile//tmp_my_lst_id=$tmp_my_lst_id";
	//exit;

    $my_lst_id=0;
    
   if ($num_rows) {
        $my_lst_id= $tmp_my_lst_id;
	}else{
		$sql_ins = "INSERT INTO pds_list (userid, state, level, firm,description, email, premium, loc_sel, d_submit,country,metro_area,states_id) VALUES ($userid,'apr',1,'".mysql_real_escape_string($username)."','".mysql_real_escape_string($username)."','".mysql_real_escape_string($useremail)."',0,0,NOW(),'US',".mysql_real_escape_string($metro_profile).",".mysql_real_escape_string($state_profile).")";
         mysql_query($sql_ins);
        $my_lst_id=mysql_insert_id();

        /*mysql_query("INSERT INTO pds_liststats (list_id, page_views, sub_views ) VALUES ( $my_lst_id, 0, 0 )");
        mysql_query("INSERT INTO pds_list_access_level (list_id,fld_mail_add,fld_contact,fld_phone,fld_fax,fld_mobile,fld_email) VALUES ($my_lst_id,2,2,2,2,2,2)");
        mysql_query("INSERT INTO pds_listcat  ( list_id, cat_id ) VALUES ( $my_lst_id, 1)");*/
  }
	
	 $stats_rec_fnd=DB::ExecScalarQry('SELECT COUNT(`list_id`) as `stats_rec` FROM `pds_liststats` WHERE `list_id`='.$my_lst_id);
	 if(is_gt_zero_num($stats_rec_fnd)==false){
	 		mysql_query("INSERT INTO pds_liststats (list_id, page_views, sub_views ) VALUES ( $my_lst_id, 0, 0 )");
	 }
	 
	 $accs_stat_fnd=DB::ExecScalarQry('SELECT COUNT(`list_id`) as `accs_stat` FROM `pds_list_access_level` WHERE `list_id`='.$my_lst_id);
	 if(is_gt_zero_num($accs_stat_fnd)==false){
	 		mysql_query("INSERT INTO pds_list_access_level (list_id,fld_mail_add,fld_contact,fld_phone,fld_fax,fld_mobile,fld_email) VALUES ($my_lst_id,2,2,2,2,2,2)");
	 }
	 
	 $cat_rec_fnd=DB::ExecScalarQry('SELECT COUNT(`list_id`) as `cat_rec` FROM `pds_listcat` WHERE `list_id`='.$my_lst_id);
	 if(is_gt_zero_num($cat_rec_fnd)==false){
	 		mysql_query("INSERT INTO pds_listcat ( list_id, cat_id ) VALUES ( $my_lst_id, 1)");
	 }
	 		
    //echo "my_lst_id=$my_lst_id";
    return $my_lst_id;
}

function getMeAcntType(){
	global $Global_member;
	$buss_type="individual";
	
	if(isset($_SESSION['guid'])){
	//if(strtoupper($Global_member['member_role'])=="MANAGER")
		if(in_array($Global_member['member_role_id'],array(ROLE_ADMIN,ROLE_OWNER,ROLE_MANAGER,ROLE_EXPEDITOR,ROLE_SERVER)))		
			return "business";
	}
	return $buss_type;	
}

//..display phone numbers
function printPhoneNumbers($phone){
        if(is_not_empty($phone)){
            $phone = preg_replace("/[^0-9]/", "", $phone);
            if(strlen($phone) == 7)
            	return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
            elseif(strlen($phone) == 10)
            	return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
            else
            	return $phone;
        }else{
            return "";
        }
   }

function Biz_getIP()
{
    // here we check if the user is coming through a proxy
    // NOTE: Does not always work as proxies are not required
    //         to provide this information
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        //reg ex pattern
        $pattern = "/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/";
        // now we need to check for a valid format
        if(preg_match($pattern, $_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            //valid format so grab it
            $userIP = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        else
        {
            //invalid (proxy provided some bogus value
            //so just use REMOTE_ADDR and hope for the best
            $userIP = $_SERVER["REMOTE_ADDR"];
        }
    }
    //not coming through a proxy (or the proxy
    //didnt provide the original IP)
    else
    {
        //grab the IP
        $userIP = $_SERVER["REMOTE_ADDR"];
    }

    //return the IP address
    return $userIP;
}
  
function Biz_GetUsrLocation(){
    //global $CONFIG;
    
   // if(isset($_SESSION['client_country'])==false){
   	
        include_once PATHROOT ."/iplocation/ip2locationlite.class.php";

        $ipLite = new ip2location_lite;
        //$ipLite->setKey(iplocate_api_key);

        $user_ip = biz_getIP();

        $meta_tags = $ipLite->getCity($user_ip);

        if (!empty($meta_tags) && is_array($meta_tags)) {
            $_SESSION['client_city'] = $meta_tags['cityName'];
            $_SESSION['client_state'] = $meta_tags['regionName'];
            $_SESSION['client_country'] = $meta_tags['countryCode'];
            $_SESSION['client_lat'] = $meta_tags['latitude'];
            $_SESSION['client_long'] = $meta_tags['longitude'];
        }else{
             $_SESSION['client_city'] = "Phoenix";
             $_SESSION['client_state'] = "AZ";
             $_SESSION['client_country'] = "US";
             $_SESSION['client_lat'] = "33.4483771";
             $_SESSION['client_long'] = "-112.0740373";
        }


        //$meta_tags = @get_meta_tags('http://www.geobytes.com/IPLocator.htm?GetLocation&template=php3.txt&IPAddress=' . $user_ip);
        //or die('Error getting meta tags');
        //add it to session
/*
 		if($meta_tags){
            $_SESSION['client_city'] = "Phoenix";
            $_SESSION['client_state'] = "AZ";
            $_SESSION['client_country'] = "US";
            $_SESSION['client_lat'] = $meta_tags['latitude'];
            $_SESSION['client_long'] = $meta_tags['longitude'];
        }else{
            $_SESSION['client_city'] = $meta_tags['city'];
            $_SESSION['client_state'] = $meta_tags['regioncode'];
            $_SESSION['client_country'] = $meta_tags['fips104'];
            $_SESSION['client_lat'] = $meta_tags['latitude'];
            $_SESSION['client_long'] = $meta_tags['longitude'];
        }
*/
   // }
}

function get_user($id){
	$member = array();
	if(is_gt_zero_num($id)){
		$newObj = new members();
        $member = $newObj->GetInfo($id);
		unset($newObj);
	}		
	return $member; 
}

function get_user_by_email($email){
	$member = array();
	if(is_not_empty($email)){
		$newObj = new members();
    	$member = $newObj->GetInfo(0,$email);
		unset($newObj);
	} 
	return $member; 
}

function get_user_by_phone_no($phone){
	$member = array();
	$_restaurant=$_SESSION[SES_RESTAURANT];			
	//..Phone checking
	/*echo 'SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`staff_phone`="'.$phone.'");';
	exit;*/
	
	if(is_gt_zero_num($_restaurant)){
		$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`staff_phone`="'.$phone.'");') or die(mysql_error());		
		$n = mysql_num_rows($q);	
		if($n){
			$member_id = @mysql_result($q,0);
			$newObj = new members();
	    	$member = $newObj->GetInfo($member_id);
			unset($newObj);
		}	
	}							
	return $member;	
}

function get_loggedin_userid(){
    global $Global_member;
    return $Global_member['member_id'];
}
  
function getMeMyFanOfList($email){
    $fans = array();
    if(is_not_empty($email)){
       	/*
        Required Code
        */  
    }
    return $fans; 
} 

function biz_send_popup_notification($v1,$v2,$v3,$v4,$v5,$v6){
    return false;
}

function is_plugin_enabled($plugin){
    return false;
}

function isadminloggedin(){
 	global $admin_email;
	if(is_not_empty($_SESSION['user']) && ($_SESSION['user'] == $admin_email)){
		return true;
	} 
 return false;
}

//..Function will retun the if you want to delete the cookies
function reallyForceDelete($_manager_login=1){
	$_ret_val=0;
	if(is_gt_zero_num($_SESSION['member_role_id'])){
		if($_SESSION['member_role_id'] == ROLE_CUSTOMER){
			$_prev_customer=1;
		}else{
			$_prev_customer=0;
		}
	}
	if(isset($_prev_customer)){
		//..If current user is manager and previous customer
		if(($_manager_login==1) && ($_prev_customer==1)){
			$_ret_val=1;
		}elseif(($_manager_login==1) && ($_prev_customer==0)){
			//..don
		}elseif(($_manager_login==0) && ($_prev_customer==1)){
			
		}elseif(($_manager_login==0) && ($_prev_customer==0)){
			$_ret_val=1;
		}
	}
	return $_ret_val;
}

function LogMeOut($_del_cookies=1){
	global $sesslife,$session;
	//if($sesslife == true){
		//..detect previous session of the customer		
	  	if(is_gt_zero_num($_SESSION['log_id'])){
			$obj = new hm_log();
			if($obj->readObject(array("log_id"=>$_SESSION['log_id']))){
				$obj->setlog_out_time(date("Y-m-d H:i:s"));
				$obj->insert();
			}
		}
		$session->stop(); 
		if(isset($_COOKIE['authuser']) && isset($_COOKIE['authpass']) && ($_del_cookies==1)){
			$time = time();
			setcookie("authuser", "", $time - 3600*24*10, "/");
			setcookie("authpass", "", $time - 3600*24*10, "/");
			setcookie("authrest", "", $time - 3600*24*10, "/");
		}	
    //}
}
/**
* Get the user name and password from the user id
* and login into the system
* @param undefined $user_id
* 
*/
function get_user_auth($user_id){
	  $auth=array();
		//..Fetch username and password from user id
		$result = mysql_query("SELECT `email`,`password` FROM `members` WHERE id={$user_id}");
		if($result && mysql_num_rows($result)){
			while($row = mysql_fetch_assoc($result)) {
			   $auth['username'] = $row['email'];
			   $auth['password'] = $row['password'];			   
			}
		}
		unset($result);
		unset($row);
		//..first logut the current user
		//LogMeOut();
		//$sesslife = false;
		$result=false;
		//.log the use in to the system
		$result=LogMeIn($auth['username'],$auth['password'],0,1,1,$_SESSION[SES_RESTAURANT]);
		return $result;		
}

function LogMeIn($username,$password,$table_id,$isCustomerLogin = 0,$frm_chng_srv=0,$is_restaurant=0){
 global $sesslife;
 
 
 if(is_gt_zero_num($is_restaurant)==false){
 		$is_restaurant=$_SESSION[SES_RESTAURANT];
 }
 
//echo "$username,$password,$table_id,$isCustomerLogin";
 if((is_gt_zero_num($is_restaurant)) && (($sesslife==false) || is_gt_zero_num($frm_chng_srv))){
 //echo "$username,$password,$table_id -1";
 if(is_not_empty($username) && is_not_empty($password)){
		$autologin = 1;		
		$password = generate_encrypted_password($password);
		
		//$a = mysql_query("SELECT `login_attempt` FROM `members` WHERE(`email`='{$username}')") or die(mysql_error());
		$a = mysql_query("SELECT `members`.`id`,`login_attempt`,`staff_restaurent`, `staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE `email`='{$username}' AND `staff_restaurent`='{$is_restaurant}';") or die(mysql_error());	
		//echo "SELECT `members`.`id`,`login_attempt`,`staff_restaurent`, `staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE `email`='{$username}' AND `staff_restaurent`='{$is_restaurant}';";
		
		//echo "SELECT `members`.`id`,`login_attempt`,`staff_restaurent`, `staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE `email`='{$username}' AND `staff_restaurent`='{$is_restaurant}';";
		
		$ac = mysql_num_rows($a);
		if($ac){
			$f = mysql_fetch_array($a); 
			if($isCustomerLogin || $frm_chng_srv){
				//$res4 = mysql_query("SELECT `password` FROM `members` WHERE (`email`='{$username}')");
				$res4 = mysql_query("SELECT `password` FROM `members` WHERE (`id`='".$f['id']."')");
				if($res4 && mysql_num_rows($res4)){
					$password = mysql_result($res4,0);
				}
			} 
				
			//$q = "SELECT * FROM `members` WHERE (`email`='{$username}') and (`password`='{$password}')";
			$q = 'SELECT `members`.* FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$is_restaurant.' AND `email`="'.$username.'" and `password`="'.$password.'";';
			
			if(!($result_set = mysql_query($q))) die(mysql_error());
			$n2 = mysql_num_rows($result_set);

			if($n2){
				$f = mysql_fetch_array($result_set);
				$verified = $f['verified'];
				$banned = $f['banned'];
				$user_id = $f['id'];
				//print_r($f);
				if($verified == 0)
				{
					$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['email_not_verified']}<br/><small><a href='{$website}/".USER_DIRECTORY."/resend.php'>{$_lang['resend_confirmation_link']}</a></small></div>";
					//header("Location: {$website}/".USER_DIRECTORY."/login.php?r=reg");
				}
				else
				{
					if($banned == 1){
						$_SESSION['error'] =  "<div class=\"errorbox\">{$_lang['account_banned']}<br/><small>{$_lang['contact_admin']}</small></div>";
						//header("Location: {$website}/".USER_DIRECTORY."/login.php?r=reg");
					}else{
						if($autologin == 1){
							$time = time();
							setcookie("authuser", $username, $time + 3600*24*365, "/");
							setcookie("authpass", $password, $time + 3600*24*365, "/");
							setcookie("authrest", $is_restaurant, $time + 3600*24*365, "/");
						}
						$_SESSION['error'] = NULL;
						$date = date("d M Y");
						$updateMembers = mysql_query("UPDATE `members` SET `access`='{$date}', `login_attempt` = 0 WHERE `email`='{$username}'");
						//if($updateMembers){
							if(is_gt_zero_num($_SESSION['log_id'])==false){
								$obj = new hm_log();
								$log_id = $obj->create($username, date("Y-m-d h:i:s"),$table_id); 
								unset($obj);
								$_SESSION['log_id'] = $log_id;	
							}							 
							$_SESSION['user'] = $username;
							$_SESSION['pass'] = $password;
							$_SESSION['guid'] = $user_id; 
							$_SESSION['authrest'] = $is_restaurant;							
															
							return true;
						} 
					//}
				}
			}				 
		}else{
			$_SESSION['error'] =  '<div class="errorbox">'.$_lang['email_not_found'].'</div>';
		}			 
	} 
	return false; 
 }else{
 		$_SESSION[SES_FLASH_MSG]  ='<div class="info">Restaurant is not selected..</div>';
 }
}

function registerME($email='',$password='',$table_id=0,$fname="",$lname="",$phone="",$is_reward=0,$reward_bal_visits=0,$reward_bal_points=0,$sms_subscribed=0,$_restaurant=0,$staff_facebook=NULL,$cust_dob=NULL,$cust_aniversary_dt=NULL,$staff_signup_flg='D'){
global $sesslife;
	$isAlreadyLoggedIn = 0;
	//echo "<br>[{$email}]one-";
	
	if(is_not_empty($phone)){
		$phone1= _get_us_phone($phone,1);
		$phone= _get_us_phone($phone);		
	}		
	//echo "<br>[{$email}]Second-";
		//$phone= str_replace(array('+', '-'), '', filter_var($phone, FILTER_SANITIZE_NUMBER_INT));
	
	if($_restaurant==0)
		$_restaurant=$_SESSION[SES_RESTAURANT];
		
	//echo "<br>[{$email}]third-";	
		
//if($sesslife == false) { 
	if(is_not_empty($email) && is_not_empty($password)){			
		if(isValidEmail($email)){	
			//$q = mysql_query("SELECT `id` FROM `members` WHERE (`email` = '{$email}')") or die(mysql_error());			
			//$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND `email`="'.$email.'";') or die(mysql_error());	
			//echo'SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`email`="'.$email.'" OR `staff_phone`="'.$phone.'");';
			//exit;
			//..If it is import without email then only check phone 
			//if(substr($email, 0, 6)=='exusr_'){
			//echo "<br>[{$email}]forth-";

			//if(_chk_if_usr_witout_email($_email)==1){
			if(substr($email, 0, 6)=='exusr_'){
				//..only phone checking
				//..Phone checking
				$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`staff_phone`="'.$phone.'" OR `staff_phone`="'.$phone1.'");') or die(mysql_error());				
			  $n = $n_ph =$n_em= mysql_num_rows($q);
			}else{		
			
				//..Email checking
				$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND `email`="'.$email.'";') or die(mysql_error());
				$n_em = mysql_num_rows($q);
				
				//..Phone checking
				$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`staff_phone`="'.$phone.'" OR `staff_phone`="'.$phone1.'");') or die(mysql_error());
				$n_ph = mysql_num_rows($q);
				
				$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`email`="'.$email.'" OR `staff_phone`="'.$phone.'" OR `staff_phone`="'.$phone1.'");') or die(mysql_error());	
				$n = mysql_num_rows($q);	
			}					
			$member_id = @mysql_result($q,0);

			//..Check unique phone validation
			$is_found=0;
			if(is_not_empty($phone)){				
				//$staff_record=tbl_staff::readArray(array('isActive'=>1,STAFF_PHONE=>$phone),$is_found,1);	
				//echo 'SELECT '.STAFF_MEMBER_ID.' FROM '.TBL_STAFF.' WHERE ('.TBL_STAFF_DEACTIVE_DATE.' is NULL OR '.TBL_STAFF_DEACTIVE_DATE.' = 0 OR '.TBL_STAFF_DEACTIVE_DATE.' > CURDATE( )) AND '.STAFF_PHONE.'='.$phone;	
				$staff_record=DB::ExecScalarQry('SELECT '.STAFF_MEMBER_ID.' FROM '.TBL_STAFF.' WHERE ('.TBL_STAFF_DEACTIVE_DATE.' is NULL OR '.TBL_STAFF_DEACTIVE_DATE.' = 0 OR '.TBL_STAFF_DEACTIVE_DATE.' > CURDATE( )) AND '.STAFF_PHONE.'="'.$phone.'" AND `staff_restaurent` = '.$_restaurant.'');
			}			
			 
			if(is_gt_zero_num($member_id)==FALSE && is_gt_zero_num($staff_record)){
					$member_id=$staff_record;
			}
			$hashed_password = generate_encrypted_password($password);				 
			//if(!$n && !$is_found){	
			if(!$n_em && !$is_found){
				//..new registration
				$key = getGuid();				
				$join = date("d M Y");
				
				$obj = new members();
				//$rest=(($_SESSION[SES_RESTAURANT]>0) ? $_SESSION[SES_RESTAURANT] : 1); 
				//echo "create($email,$hashed_password,$lname,$fname,$key,1,$join,ROLE_CUSTOMER,'',$phone,'','','','','','','','','','','',$rest,$is_reward,$reward_bal_visits,$reward_bal_points)<br>";
			  $w = $obj->create($email,$hashed_password,$lname,$fname,$key,1,$join,ROLE_CUSTOMER,'',$phone,'','','','','','','','','','','',$_restaurant,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed,$staff_facebook,$cust_dob,$cust_aniversary_dt,0,$staff_signup_flg);						 
					
				if($w){
					//newuser_email($email);
					/*if(LogMeIn($email,$password,$table_id,1)){
						return 1;
					} */
					$_SESSION[SES_FLASH_MSG]  ='<div class="info">Successfully Registered.</div>';					
					return 1;
				}else{
					//$err = "<div class=\"infobox\">{$_lang['unable_to_register']}<br/><small>{$_lang['try_again_later']}</small></div>";
					$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang['unable_to_register'].'</div>';	
				}
			}else{
				//..Already registered
				/*
				if(LogMeIn($email,$password,$table_id,1)){	
					return 1;
				}				
				if(is_not_empty($hashed_password)){
					members::update_usr_password($member_id,$hashed_password);
				}				
				*/
				if(is_gt_zero_num($is_reward)){
					members::update_member_is_reward($member_id,1,$_restaurant);
				}
				//..if subscribed to 'sms' then add it to the crm table
				if(is_gt_zero_num($sms_subscribed)){
						members::update_member_sms_subscibe($member_id,1,$_restaurant);
						$objtbl_crm =new tbl_crm();
						$isSuccess = $objtbl_crm->create($member_id, $email, CUST_TYPE_LOGIN, $sms_subscribed, $phone);
						unset($objtbl_crm);
				}
				if($n_ph>0){
					$_SESSION[SES_FLASH_MSG]  ='<div class="info">This phone is already registered, please login or use another phone to sign up.</div>';
				}else{					
					$_SESSION[SES_FLASH_MSG]  ='<div class="info">This email is already registered, please login or use another email address to sign up.</div>';
				}
				//$_SESSION[SES_FLASH_MSG]  ='<div class="info">Email/Phone is already registered with us.</div>';	
				if(is_gt_zero_num($is_reward)==false){
						return 1;
				}	
			}
		}else{		 
			//$err = "<div class=\"errorbox\">{$_lang['invalid_email']}</div>";
			$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang['invalid_email'].'</div>';
		}			
	}
	else
	{
		//$err = "<div class=\"errorbox\">{$_lang['empty_fields']}</div>";
		$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang['empty_fields'].'</div>';
	}
/*}else{
	$err = 0;	
}*/
return 0;
	
}

function biz_view($view,$vars=array(), $type="default") {
	global $CONFIG;  
	 
	if(is_not_empty($view)){
		ob_start();
		require($CONFIG->path."/views/{$type}/{$view}.php"); 
		return ob_get_clean();  
	}  
	return "";                                  
}
  
//..Function to get the lat long of the user from the device
function Biz_getlatlang($str_address='', $isMobile=false){
    $arLatLng=array();
    
    //..google api key 
    /*if ((isset($_SESSION['mobile'])) && ($_SESSION['mobile']==1)){
        $isMobile = 1;
    }*/

    $str_address=mysql_real_escape_string(strip_tags(trim($str_address)));
     $str_address=htmlentities(urlencode($str_address));

    if($isMobile)
        $geocode=url_get_contents("https://maps.google.com/maps/api/geocode/json?address=$str_address&sensor=true&key=AIzaSyCgrQ0ca_XoAX1JOt2WWvxghkjbmSZYKMU");
    else
        $geocode=url_get_contents("https://maps.google.com/maps/api/geocode/json?address=$str_address&sensor=false&key=AIzaSyCgrQ0ca_XoAX1JOt2WWvxghkjbmSZYKMU");
    //echo "http://maps.google.com/maps/api/geocode/json?address=$str_address&sensor=true";
    //$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address=rajlaxminagar,+deokarpanand,+kolhapur,+Maharashtra,+India&sensor=false');		
	//$geocode = url_get_contents($Url); 
    $output = json_decode($geocode);
		 
 	//echo "https://maps.google.com/maps/api/geocode/json?address=$str_address&key=AIzaSyCgrQ0ca_XoAX1JOt2WWvxghkjbmSZYKMU";
 	
    $arLatLng["lat"] = $output->results[0]->geometry->location->lat;
    $arLatLng["long"] = $output->results[0]->geometry->location->lng;

    //echo "lat=$lat | long=$long |";
    return $arLatLng;
}

	function url_get_contents($Url) { 
	    if (!function_exists('curl_init')){ 
	        die('CURL is not installed!');
	    }
	    $ch = curl_init(); 
	    curl_setopt($ch, CURLOPT_URL, $Url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			
	    $output = curl_exec($ch); 
			//echo $output;exit;
	    curl_close($ch); 
	    return $output;
	}
	//..Get the list of logged in users
	//..for employee get only tables belongs to him based on the tableshift assgnmt
	function GetLoggedInUsers($ck_employee=0){
		$cust_list=array();
		$table_id="";	
		if(is_gt_zero_num($ck_employee)){
			$table_id=GetEmpTables($ck_employee);
			if(is_not_empty($table_id))
				$table_id=" AND `log_tbl_id` IN ({$table_id})";
		}
		$sql="SELECT DISTINCT m.id,log_id,CONCAT(staff_lname,' ',staff_fname) full_name  FROM `hm_log` lg INNER JOIN `members` m ON lg.log_member_id=m.id INNER JOIN `tbl_staff` st ON lg.log_member_id=st.staff_member_id WHERE DATE(`log_in_time`)=CURDATE() AND `log_out_time`=0 AND member_role_id=4 {$table_id}";		
		$result = mysql_query($sql);

		if (($result)&&(mysql_num_rows($result)> 0)) {	
			while ($row = mysql_fetch_assoc($result)) {				
			   $cust_list[$row["log_id"]]= $row["full_name"];
			}
		} 
		return $cust_list;
	}
	
	/*//...function to get the tables employee will look after based on shift
	function GetEmpTables($emp_id){	
		$sql="SELECT DISTINCT `tbl_sft_table_id`,`table_number` FROM 
		`tbl_table_shift_assignment` INNER JOIN
		`tbl_dining_table` ON
		`tbl_sft_table_id`=`table_id` 
		WHERE `tbl_sft_emp_id`={$emp_id} AND 
		(`tbl_sft_period_from`<= '".date(DATE_FORMAT)."' AND 
		 `tbl_sft_period_to` >= '".date(DATE_FORMAT)."') AND 
		(`tb_sft_terminated_on` is NULL OR `tb_sft_terminated_on` = 0 OR `tb_sft_terminated_on` > CURDATE()) AND 
		`tbl_sft_shift_id` IN (
			SELECT `shift_id` FROM `tbl_shift` WHERE 
			`shift_start_time`<= '".date("H:i:s")."' AND 
			`shift_end_time` >= '".date("H:i:s")."' AND 
			(`shift_terminated_on` is NULL OR `shift_terminated_on` = 0 OR `shift_terminated_on` > CURDATE())
		)"; 
		$tbl_lst=array();
		$result = mysql_query($sql);
		if (($result)&&(mysql_num_rows($result)> 0)){	
		   while ($row = mysql_fetch_assoc($result)) {
			   $tbl_lst[$row["tbl_sft_table_id"]]= $row["table_number"];		  
			}
		}
		return $tbl_lst;
	}*/	
	
	//...function to shifttableid based on customer
	function GetEmpShiftID($emp_id,$cust_log_id){				
		$sql="SELECT `tbl_sft_id` FROM `tbl_table_shift_assignment`
		WHERE `tbl_sft_emp_id`={$emp_id} AND
		`tbl_sft_table_id` =(SELECT `table_id` FROM `hm_log` WHERE log_id={$cust_log_id}) AND 
		(`tbl_sft_period_from`<= '".date(DATE_FORMAT)."' AND 
		 `tbl_sft_period_to` >= '".date(DATE_FORMAT)."') AND 
		(`tb_sft_terminated_on` is NULL OR `tb_sft_terminated_on` = 0 OR `tb_sft_terminated_on` > CURDATE()) AND 
		`tbl_sft_shift_id` IN (
			SELECT `shift_id` FROM `tbl_shift` WHERE 
			`shift_start_time`<= '".date("H:i:s")."' AND 
			`shift_end_time` >= '".date("H:i:s")."' AND 
			(`shift_terminated_on` is NULL OR `shift_terminated_on` = 0 OR `shift_terminated_on` > CURDATE())
		)"; 
		//echo $sql;
		//$tbl_lst=array();
		$result = mysql_query($sql);
		if (($result)&&(mysql_num_rows($result)> 0)){	
		   return mysql_result($result,0); 
		}
		return 0;	
	}
	
	
/*	function GetTblEmployees($tbl_id){	
		$sql="SELECT DISTINCT `tbl_sft_emp_id`, CONCAT(`staff_fname`,' ', `staff_lname`) as `full_name` FROM 
		`tbl_table_shift_assignment` INNER JOIN
		`tbl_staff` ON
		`tbl_sft_emp_id`=`staff_member_id` 
		WHERE `tbl_sft_table_id`={$tbl_id} AND 
		(`tbl_sft_period_from`<= '".date(DATE_FORMAT)."' AND 
		 `tbl_sft_period_to` >= '".date(DATE_FORMAT)."') AND 
		(`tb_sft_terminated_on` is NULL OR `tb_sft_terminated_on` = 0 OR `tb_sft_terminated_on` > CURDATE()) AND 
		`tbl_sft_shift_id` IN (
			SELECT `shift_id` FROM `tbl_shift` WHERE 
			`shift_start_time`<= '".date("H:i:s")."' AND 
			`shift_end_time` >= '".date("H:i:s")."' AND 
			(`shift_terminated_on` is NULL OR `shift_terminated_on` = 0 OR `shift_terminated_on` > CURDATE())
		)";  
		$tbl_lst=array();
		$result = mysql_query($sql);
		if (($result)&&(mysql_num_rows($result)> 0)){	
		   while ($row = mysql_fetch_assoc($result)) {
			   $tbl_lst[$row["tbl_sft_emp_id"]]= $row["full_name"];		  
			}
		}
		return $tbl_lst;
	}	*/
	
	//..get all shift employees
	function GetShiftEmployees(){	
		$output=array();
		$emp_lst=array();
		//..Get the live shift based on the current time
		$live_shift=GetLiveShift();
		$live_shift_id=implode(',', array_keys($live_shift));
		//..Fetch the employees from that table,shift and particular date	
		$rslt_fnd=0;	 
		$emp_lst = tbl_emp_shift_assignment::readArray(array(EMP_SFT_SHIFT=>$live_shift_id,EMP_SFT_DATE=>date('Y-m-d')),$rslt_fnd,1,1); 
		foreach($emp_lst as $emp){			
			$output[$emp["emp_sft_employee"]]= $emp["employee_name"];
		}		
		return $output;		
	}
	 
	
	function GetTblEmployees($tbl_id){	
		$output=array();
		$emp_lst=array();
		//..Get the live shift based on the current time
		$live_shift=GetLiveShift();
		$live_shift_id=implode(',', array_keys($live_shift));
		//..Fetch the employees from that table,shift and particular date	
		$rslt_fnd=0;	 
		$emp_lst = tbl_emp_shift_assignment::readArray(array(EMP_SFT_SHIFT=>$live_shift_id,EMP_SFT_DATE=>date('Y-m-d'),EMP_SFT_TABLES=>$tbl_id),$rslt_fnd,1,1);   
		foreach($emp_lst as $emp){			
			$output[$emp["emp_sft_employee"]]= $emp["employee_name"];
		}		
		return $output;		
	}
	
	//...Function to get the tables employee will look after based on shift
	function GetEmpTables($emp_id,$islist=0){	
		$output=array();
		$tbl_lst=array();
		$tmp=array();
		//..Get the live shift based on the current time
		$live_shift=GetLiveShift();
		$live_shift_id=implode(',', array_keys($live_shift));
		//..Fetch the tables from empshiftassignment 
		$rslt_fnd=0;
		$tbl_lst=tbl_emp_shift_assignment::readArray(array(EMP_SFT_SHIFT=>$live_shift_id,EMP_SFT_DATE=>date('Y-m-d'),EMP_SFT_EMPLOYEE=>$emp_id,SES_RESTAURANT=>$_SESSION[SES_RESTAURANT]),$rslt_fnd,1,1);
		 
		foreach($tbl_lst as $tbl){	 
			if(is_not_empty($tbl[EMP_SFT_TABLES])){ 
					$tmp= biz_explode(",",$tbl[EMP_SFT_TABLES]); 
				$output = array_merge($output, $tmp);
			}			
		}
		if(is_not_empty($output)){
			$output=array_unique($output);
			if(is_gt_zero_num($islist)){
				$output = GetTableListByEmployee($output);
			}
		} 
		return $output;		
	}
	
	
	function GetTableListByEmployee($table_arr){
		$arr = array();
		if(is_not_empty($table_arr)){
			$res = mysql_query('SELECT '.TABLE_ID.','.TABLE_NUMBER.' FROM '.TBL_DINING_TABLE.' WHERE '.TABLE_ID.' IN ('.biz_implode(',',$table_arr).')');
			if($res && is_gt_zero_num(mysql_num_rows($res))){
				
				while($row = mysql_fetch_assoc($res)){
					$arr[$row[TABLE_ID]] = $row[TABLE_NUMBER];
				}
			}
		}
		return $arr; 
	}
	
	
	 
	
	
	/* Function to get the current Live shift */
	function GetLiveShift(){
		$rslt_fnd=0;
		$shift_lst=array();
		$output=array();
		$shift_lst=tbl_shift::readArray(array('isActive'=>1,SHIFT_RESTAURENT=>$_SESSION[SES_RESTAURANT]),$rslt_fnd,1,1,date('Y-m-d'),1);	
		$cnt=0;	
		foreach($shift_lst as $shift){
			//..This is added for safety if more than one result found take first one
			if($cnt==0){
				$output[$shift['shift_id']]= $shift['shift_name'];
				$cnt++;
			}			
		}
		return $output; 		
	}	
	
	function GetDfltTblEmployee($tbl_id){
		$lst = array();
		$lst = GetTblEmployees($tbl_id); 
		if(is_not_empty($lst)){
		   return key($lst);
		}else{
			return 0;
		} 
	}	
	
	  
	
function GetCustomerIDFromLog($log_id){
	$sql="SELECT m.id FROM `hm_log` lg INNER JOIN `members` m ON lg.log_member_id=m.id WHERE `log_id`={$log_id}";
	
	$result = mysql_query($sql);
	if (($result)&&(mysql_num_rows($result)> 0)) {	
	   return mysql_result($result,0);
	}
	return 0;		
}	
	
	
function get_access_fld_allowed_bl($list_id, $field_name){
	return 2;
}

function get_def_access_buss_flds(){
  $arr = array();
   $arr['fld_mail_add']=2;
   $arr['fld_contact']=2;
   $arr['fld_phone']=2;
   $arr['fld_fax']=2;
   $arr['fld_mobile']=2;
   $arr['fld_email']=2;
return $arr;
} 

function getClaimedCouponsForOrder($order_id){
  $info = array();
  $info['count'] = 0;
  if(is_gt_zero_num($order_id)){  
   $res =	mysql_query('SELECT `pds_redim_cupons`.`id`,`pds_redim_cupons`.`promotion_id`, `title`, `biz_redimed` FROM `pds_redim_cupons` INNER JOIN `pds_list_promotions` ON `pds_list_promotions`.`id` = `pds_redim_cupons`.`promotion_id` WHERE `order_id` ='.$order_id);
   if($res && is_gt_zero_num(mysql_num_rows($res))){ 
      $info['count'] = mysql_num_rows($res);
      while($row=mysql_fetch_assoc($res)){
        $info['list'][$row['id']] = $row;
      }
   }
  } 
  return $info;
}

function checkNcreateSession($table_id,$cust_id = "",$by_cust=0,$isReset=0,$party_size=0){
  $cust_sess_id = 0;
 if(is_gt_zero_num($table_id)){
  //------//
  //..Get The Current Customer Session
 /* if(is_gt_zero_num($_SESSION[SES_CUSTOMER_SESSION])){
  	//.. this condition only applicable for the customer.
		  
  	$cust_sess_id = $_SESSION[SES_CUSTOMER_SESSION];
  }else{ 
	//..get the current active customer session 
 	$cust_sess_id = tbl_table_customer_session::GetCurrentActiveCustSession($table_id); 
  }	 
	*/
	$cust_sess_id = tbl_table_customer_session::GetCurrentActiveCustSession($table_id); 
 
  //-----------------------------------------------------------------------//
  //..Check wheter active customer session is there 
  //  echo $cust_sess_id; 
	if(is_gt_zero_num($cust_sess_id)){
	
		$create_customer_session = 0;
		$cust_sess_info = tbl_table_customer_session::GetInfo($cust_sess_id);
		 
		//..check whether the session is Active or not
		if(is_gt_zero_num($cust_sess_info["isActive"])){
		
			//..check whether customer_session_email is not empty
			if(is_not_empty($cust_sess_info['tbl_cust_sess_customer'])){
			  //..check wheather customer name is equal to session_customer_name
			  /*if($cust_id == $cust_sess_info['tbl_cust_sess_customer']){
			  	//..do nothing  
			  }else{
			  	 //$create_customer_session = 1;
			  } */
			}else{
				//..check whether prm cust_id is_not_empty
				if(is_not_empty($cust_id) && $cust_id == 0){
					//..update the customer email
					$obj = new tbl_table_customer_session();
					if($obj->readObject(array(TBL_CUST_SESS_ID=>$cust_sess_id))){
						$obj->settbl_cust_sess_customer($cust_id);
						$obj->insert();
					}
					unset($obj);	 
				}
			} 	
		}else{ 
			//..if not active then create session
			if(in_array($_SESSION['member_role_id'],array(ROLE_OWNER,ROLE_MANAGER,ROLE_EXPEDITOR,ROLE_EXPEDITOR,ROLE_WAITER))){
				$isReset = 1;
			} 
			$create_customer_session = 1; 
		} 
	}else{
		$create_customer_session = 1;
	}//..cust_sess_id 
  //-----------------------------------------------------------------------//
  //..create customer new session 
	if((is_gt_zero_num($isReset)) && (is_gt_zero_num($create_customer_session))){ 
	//..create the customer_session 
		$objTblCustSess = new tbl_table_customer_session();
		$cust_sess_id = $objTblCustSess->create($table_id,$cust_id,$by_cust,$party_size);
		unset($objTblCustSess);
	  
		if(is_gt_zero_num($cust_sess_id)){
		//..update the table status to occupied
			$obj = new tbl_table_status_link();
			$obj->create($table_id,$cust_id,TBL_STATUS_OCCUPIED,GetDfltTblEmployee($table_id),$cust_sess_id,date(DATE_FORMAT),NULL); 
			unset($obj);	
		}  
	}//..End create customer new session  
  
  }//.. table_id > 0	
  
	if(isCustomer()){
	 if(is_gt_zero_num($cust_sess_id)){
		$_SESSION[SES_CUSTOMER_SESSION] = $cust_sess_id;
	 } 
	}
	
	  
	return $cust_sess_id;  	
}//..end of checkNcreateSession
/*
function checkNcreateSession($table_id,$cust_id = "",$by_cust=0){
  $cust_sess_id = 0;
 if(is_gt_zero_num($table_id)){
  //-----------------------------------------------------------------------//
  //..Get The Current Customer Session
  if(is_gt_zero_num($_SESSION[SES_CUSTOMER_SESSION])){
  	//.. this condition only applicable for the customer.
  	$cust_sess_id = $_SESSION[SES_CUSTOMER_SESSION];
  }else{ 
	//..get the current active customer session 
 	$cust_sess_id = tbl_table_customer_session::GetCurrentActiveCustSession($table_id); 
  }	 
  //-----------------------------------------------------------------------//
  //..check wheter active customer session is there 
   //echo $cust_sess_id; 
	if(is_gt_zero_num($cust_sess_id)){
	
		$create_customer_session = 0;
		$cust_sess_info = tbl_table_customer_session::GetInfo($cust_sess_id);
		
		//..check whether customer_session_email is not empty
		if(is_not_empty($cust_sess_info['tbl_cust_sess_customer'])){
		  //..check wheter customer name is equal to session_customer_name
		  if($cust_id == $cust_sess_info['tbl_cust_sess_customer']){
		  	//..do nothing  
		  }else{
		  	 $create_customer_session = 1;
		  } 
		}else{
			//..check whether prm cust_id is_not_empty
			if(is_not_empty($cust_id) && $cust_id == 0){
				//..update the customer email
				$obj = new tbl_table_customer_session();
				if($obj->readObject(array(TBL_CUST_SESS_ID=>$cust_sess_id))){
					$obj->settbl_cust_sess_customer($cust_id);
					$obj->insert();
				}
				unset($obj);	 
			}
		}
		 
	}else{
		$create_customer_session = 1;
	}//..cust_sess_id 
  //-----------------------------------------------------------------------//
  //..create customer new session 
	if(is_gt_zero_num($create_customer_session)){ 
	//..create the customer_session	
		$obj = new tbl_table_customer_session();
		$cust_sess_id = $obj->create($table_id,$cust_id,$by_cust);
		unset($obj); 
		if(is_gt_zero_num($cust_sess_id)){
		//..update the table status to occupied
			$obj = new tbl_table_status_link();
			$obj->create($table_id,$cust_id,TBL_STATUS_OCCUPIED,GetDfltTblEmployee($table_id),$cust_sess_id,date(DATE_FORMAT),NULL); 
			unset($obj);	
		}  
	}//..End create customer new session  
  
  }//.. table_id > 0	
   
	return $cust_sess_id;  	
}//..end of checkNcreateSession
*/
 
 
/**
*  Send Notification by status 
* @param integer $table_id
* @param string  $cust_mail
* @param integer $post_id
* @param integer $status_id
* @param integer $emp_id
* @param integer $cust_id
* @param string  $cust_type
* @param integer $isSubOrder
* @param integer $isDelay
* @return boolean
*/  
function biz_send_status_notifications($table_id,$cust_mail,$post_id,$status_id,$emp_id=0,$cust_id=0,$cust_type=CUST_TYPE_LOGIN,$isSubOrder=0,$isDelay=0){
	//..fetch active notifications from the status
	global $Global_member;
	$notification_list = tbl_notifications::readArray(array(NOTIFY_STATUS=>$status_id,'isActive'=>1,NOTIFY_IS_DELAYED=>$isDelay));
	$table_number  = '';
	if(is_gt_zero_num($table_id)){
    $tblinfo      = tbl_dining_table::GetInfo($table_id);
    $table_number = $tblinfo[TABLE_NUMBER];
 }
	//print_r($notification_list);
	//..Loop through each notification 
	//..based on role send notification
	$msg = '';

  foreach ($notification_list as $notification){
   $send_flash_msg = 0;
   $msg = sprintf($notification[NOTIFY_MESSAGE],$table_number);
   if($notification[NOTIFY_TYPE]=='MESSAGE'||$notification[NOTIFY_TYPE]=='MESSAGE_WITH_ALERT'){
     $send_flash_msg = 1;
   }
	  $isSendAlert = 1;
	// echo 'step-1'.$send_flash_msg.'<br/>';
     $alert_person = 0;
     $alert_person_type = CUST_TYPE_LOGIN;
    if($notification[NOTIFY_TO_ROLE]== ROLE_WAITER){
      $alert_person = $emp_id;
      if($send_flash_msg){
        $send_flash_msg =  (($Global_member['member_role_id'] == ROLE_WAITER)?1:0);
      }
      //biz_send_alert($table_id,$cust_mail,$post_id,$msg, $emp_id,$notification[STATUS_EVENT],'',$notification[NOTIFY_TYPE]);
    }elseif($notification[NOTIFY_TO_ROLE]== ROLE_CUSTOMER){
      $alert_person =  $cust_id;
      $alert_person_type = (is_not_empty($cust_type) ? $cust_type : CUST_TYPE_LOGIN);
      if($send_flash_msg){
        $send_flash_msg =  ((isCustomer())?1:0);
      }
      //biz_send_alert($table_id,$cust_mail,$post_id,$msg,$cust_id,$notification[STATUS_EVENT],$cust_type,$notification[NOTIFY_TYPE]);
    }else{
      //..for kitchen admin owner manager take negative of the role to notify.

      if(is_gt_zero_num($isSubOrder) && ($notification[NOTIFY_TO_ROLE] == ROLE_KITCHEN || $notification[NOTIFY_TO_ROLE] == ROLE_BAR)){
        $sub_order_info =   tbl_sub_orders::GetInfo($post_id);
        if($notification[NOTIFY_TO_ROLE] != $sub_order_info[SUB_ROUTE]){
          $isSendAlert = 0;
        }
      }
      $alert_person = -($notification[NOTIFY_TO_ROLE]);
      
      if($send_flash_msg){
        $send_flash_msg =  (($Global_member['member_role_id'] == $notification[NOTIFY_TO_ROLE])?1:0);
      }

      //biz_send_alert($table_id,$cust_mail,$post_id,$msg,$alert_role,$notification[STATUS_EVENT],'',$notification[NOTIFY_TYPE]);
    }
		//echo 'step-2'.$send_flash_msg.'<br/>';exit;
		
		if(($notification[STATUS_EVENT] == 'ORDER') && (is_gt_zero_num($isSubOrder))){
			$notification[STATUS_EVENT] = 'SUB_ORDER';
		}
		
    if(is_gt_zero_num($isSendAlert)){
      biz_send_alert($table_id,$cust_mail,$post_id,$msg,$alert_person,$notification[STATUS_EVENT],$alert_person_type,$notification[NOTIFY_TYPE],$send_flash_msg,$notification[NOTIFY_STATUS],$notification[NOTIFY_ID],$notification[NOTIFY_IS_URGENT]);
    }

 }
 unset($notification_list);
 return true;
} 

/**
*  Send Notification
* @param integer $table_id
* @param string $cust_mail
* @param integer $post_id
* @param string $msg
* @param integer $person
* @param string $post_type
* @param string $person_type
* @param string $notify_type
* @param integer $send_flash_msg
* @param integer $status
* @param integer $notify
* @param integer $is_urgent
* @return boolean
*/  
function biz_send_alert($table_id,$cust_mail,$post_id,$msg,$person=0,$post_type=ALERT_MISC,$person_type=CUST_TYPE_LOGIN,$notify_type='',$send_flash_msg=0,$status=0,$notify=0,$is_urgent=0){
	$isViewed = 0;
  if(is_not_empty($notify_type)){
     if($notify_type=='ALERT' || $notify_type=='MESSAGE_WITH_ALERT'){
        $obj = new tbl_alerts();
        $isViewed = 0;
        if($notify_type=='MESSAGE_WITH_ALERT'){
         // $isViewed = 1;
        }
        $obj->create($table_id,$cust_mail,$post_type,$post_id,$msg,$person,$person_type,$isViewed,$status,$notify);
	      unset($obj);
     } 
     if(is_gt_zero_num($send_flash_msg)){
		 	$_SESSION[SES_FLASH_MSG] = '<div class="info">'.$msg.'</div>'; 
     }

  }else{
   	$obj = new tbl_alerts();
	   $obj->create($table_id,$cust_mail,$post_type,$post_id,$msg,$person,$person_type,$isViewed,$status,$notify,$is_urgent);
	 unset($obj);
  }

	return true;
}

/**
* Send Notification to the manager by 
* @param integer $table_id
* @param string $cust_mail
* @param integer $post_id
* @param integer $post_type
* @return boolean
*/  
function alertToManager($table_id,$cust_mail,$post_id,$post_type=ALERT_TMP_ORDER){
	 global $_lang;
	//..Please Right 
	$obj = new tbl_alerts(); 
	$obj->create($table_id,$cust_mail,$post_type,$post_id,$_lang[TBL_ALERTS]['manager'][$post_type]);
	unset($obj);
	return true;
}
//...Check if the table session is cleaning and if customer is logged in
//...log the user out of the system
function chk_if_tbl_sess_is_cleaning(){
	global $Global_member,$sesslife,$_lang,$website; 
 /* 
if(is_gt_zero_num($_SESSION[SES_TABLE])){
	$sts_id=tbl_table_status_link::GetLastTableStatus($_SESSION[SES_TABLE]);
	$lveSess =tbl_table_customer_session::GetCurrentActiveCustSession($_SESSION[SES_TABLE]);
}
	//..non logged in customers also needs to rescan the qrcode to get new table session
	if(((is_gt_zero_num($_SESSION[SES_CUSTOMER_SESSION]))&&  ($sesslife == false) && ($_SESSION[SES_CUSTOMER_SESSION]!=$lveSess)) || ((is_gt_zero_num($sts_id)) && ($sts_id >= TBL_STATUS_CLEANING))){		
		echo "<center><div id=\"loginmsg\"><img src=\"{$website}/images/working.gif\" /><br/>";
	    echo "<p><b>{$_lang['please_wait']}</b></p></div></center>";
	    echo "<meta http-equiv=\"Refresh\" Content=\"5;URL={$website}/user/dashboard.php?table_id=".$_SESSION[SES_TABLE]."\" />";
		unset($_SESSION[SES_TABLE]);
		exit;		
	} */
	
	if((is_gt_zero_num($_SESSION[SES_TABLE])) && ($sesslife == true) && ($Global_member['member_role_id'] == ROLE_CUSTOMER)){
		 $sts_id=tbl_table_status_link::GetLastTableStatus($_SESSION[SES_TABLE]);
		$lveSess=tbl_table_customer_session::GetCurrentActiveCustSession($_SESSION[SES_TABLE]); 
		//echo $_SESSION[SES_TABLE]." | $lveSess| $sesslife |".$Global_member['member_role_id']."|".$_SESSION[SES_CUSTOMER_SESSION];
		if(((is_gt_zero_num($_SESSION[SES_CUSTOMER_SESSION])) && ($_SESSION[SES_CUSTOMER_SESSION]!=$lveSess)) || ((is_gt_zero_num($sts_id)) && ($sts_id == TBL_STATUS_CLEANING))){
				$tbl_id=$_SESSION[SES_TABLE];
				LogMeOut();
				echo '<div class="biz_center"><div id="loginmsg"><img src="'.$website.'/images/working.gif" /><br/><p><b>'.$_lang['please_wait'].'</b></p></div></div><script>window.location.href="'.$website.'/user/dashboard.php?table_id='.$tbl_id.'&frm_qrcd=1";</script><meta http-equiv="Refresh" Content="5;URL='.$website.'/user/dashboard.php?table_id='.$tbl_id.'&frm_qrcd=1;" />';
				exit;
		} 		
	}	
}

function isCustomer($logged_in=0){
	global $sesslife;
	$result = false;
	if($logged_in == 1){
		if($sesslife && $_SESSION['member_role_id'] == ROLE_CUSTOMER){
			$result = true;
		}
	}else{
		if($sesslife){
			if($_SESSION['member_role_id'] == ROLE_CUSTOMER){
				$result = true;
			}
		}else{ 
			if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE]) || is_gt_zero_num($_SESSION[SES_TABLE])){
				$result = true;
			}
		} 
	}
	return $result;
}


/**
* Get Customer Id (Only For Customer User)
* @param string byRef $customer_type
* @return $customer_id
*/ 
function getCustomerId(&$customer_type){
	$customer_id = 0;
	if(isCustomer()){
		if(is_gt_zero_num($_SESSION['guid']) || is_not_empty($_SESSION[SES_CUST_NM])){
				if(is_gt_zero_num($_SESSION['guid'])){
					$customer_id = $_SESSION['guid'];
					$customer_type = CUST_TYPE_LOGIN;
				}else{
					/*
					$customer_id = checkNcreateUserCookieId($_SESSION[SES_CUST_NM]);
					$customer_type = CUST_TYPE_COOKIE;
					*/
					if(is_gt_zero_num($_SESSION[SES_COOKIE_UID])){ 
				 		$customer_id = $_SESSION[SES_COOKIE_UID];
						$customer_type = CUST_TYPE_COOKIE;
				  }else{
						if(is_not_empty($_SESSION[SES_CUST_NM])){
						 $customer_id = checkNcreateUserCookieId($_SESSION[SES_CUST_NM]);
						 $customer_type = CUST_TYPE_COOKIE;
						} 
					} 
				}
     }
	}
	return $customer_id;
}

function getModeSubTitle($mode,$isForServer=0){
	$title = "";
	if(is_not_empty($mode)){ 
		 if(($_SESSION['member_role_id'] == ROLE_MANAGER) || ($_SESSION['member_role_id'] == ROLE_EXPEDITOR) || (($_SESSION['member_role_id'] == ROLE_WAITER) && ($isForServer))){
		 	$title = ' <small>'.$mode.'</small>';
		 }  
	}
	return $title;
}
//..get the members from the id list ('12,45,66') returns (Sample Sample,John Doe)
function GetMembersFromIDs($member_ids,$member_types=''){	
	$rtOp='';
	
	if(is_not_empty($member_types)){
		$member_id_arr = biz_explode(',',$member_ids);
		$member_type_arr = biz_explode(',',$member_types);
		$login_member = array();
		$cookie_member = array();
		foreach($member_id_arr as $key=>$val){
			  if(is_not_empty($member_type_arr[$key]) && (CUST_TYPE_COOKIE == $member_type_arr[$key])){
					$cookie_member[] = $val;
				}else{
					$login_member[] = $val;
				}
		}
		$login_member_ids = biz_implode(',',$login_member);
		$login_members_title = array();
		$cookie_members_title = array();
		 
		if(is_not_empty($login_member_ids)){
			$sql='SELECT GROUP_CONCAT(`full_name`) as `mem_lst`  
		FROM (SELECT CONCAT(`staff_fname`,\' \',`staff_lname`)as `full_name` 
		  FROM `tbl_staff` WHERE `staff_member_id` IN ('.$login_member_ids.')
		  ) q';   
			$res1 = mysql_query($sql);
			if($res1) $login_members_title = biz_explode(',',mysql_result($res1,0)); 
		}
		  
		$cookie_member_ids = biz_implode(',',$cookie_member); 
		if(is_not_empty($cookie_member_ids)){
			$sql="SELECT GROUP_CONCAT(`devck_customer`) FROM `tbl_device_cookies` WHERE `devck_id` IN ({$cookie_member_ids})";  
			//echo $sql;
			$res2 = mysql_query($sql);
			if($res2) $cookie_members_title = biz_explode(',',mysql_result($res2,0));  
		}
		
		$rtOp = biz_implode(',',array_merge($login_members_title,$cookie_members_title));
		
	}else{
		$sql="SELECT GROUP_CONCAT(`full_name`) as `mem_lst`  
	FROM (SELECT CONCAT(`staff_fname`,' ',`staff_lname`)as `full_name` 
		  FROM `tbl_staff` WHERE `staff_member_id` IN ({$member_ids})
		  ) q";  
	//echo $sql;
	$result = mysql_query($sql);
	if($result)
		$rtOp = mysql_result($result,0); 
	}
	 
	return $rtOp;
}	

function get_members_email_from_id($member_ids,$deflt_fld="email"){
	$rtOp=array();
	if(is_not_empty($member_ids)){
		$sql="SELECT `email`,`staff_phone`,
					CONCAT(staff_fname,' ', staff_lname) `employee_name`
					FROM `members` 
					INNER JOIN `tbl_staff` ON
					`members`.`id`=`tbl_staff`.`staff_member_id`
					WHERE `tbl_staff`.`staff_id` IN ({$member_ids})";  
		//echo $sql;
		$result = mysql_query($sql);
		if($result){
			while ($row = mysql_fetch_assoc($result)) {
				 if($deflt_fld=="email"){
				 		$rtOp[] = $row['email'];
				 }else{
				 		if(is_not_empty($row['staff_phone'])){
							$prop_phone="+1".str_replace("-", "", trim($row['staff_phone']));
							$rtOp["{$prop_phone}"] = $row['employee_name'];
						}
				 }			   			  
			}
		}
	}
	return $rtOp;	
}

function get_crm_email_from_id($member_ids,$deflt_fld="email"){
	$rtOp=array();
	if(is_not_empty($member_ids)){
		$sql="SELECT *, 
						case ".CRM_CUST_TYPE." 
						WHEN '".CUST_TYPE_LOGIN."' THEN  (SELECT CONCAT(`staff_fname`,' ',`staff_lname`) FROM ".TBL_STAFF." WHERE `staff_member_id` = ".CRM_CUST_ID." AND `staff_restaurent`=".$_SESSION[SES_RESTAURANT].") 
						WHEN '".CUST_TYPE_COOKIE."' THEN (SELECT `devck_customer` FROM `tbl_device_cookies` WHERE `devck_id` = ".CRM_CUST_ID.") 
						WHEN '".CUST_TYPE_SMS_REG."' THEN '--'
						END `customer_name`							
						FROM `".TBL_CRM."`
						WHERE `".CRM_ID."` IN ({$member_ids})"; 
 
		//echo $sql;
		$result = mysql_query($sql);
		if($result){
			while ($row = mysql_fetch_assoc($result)) {
				 if($deflt_fld=="email"){
				 		$rtOp[] = $row[CRM_CUST_EMAIL];
				 }else{
				 		if(is_not_empty($row[CRM_CUST_PHONE])){
							//$prop_phone="+1".str_replace("-", "", trim($row[CRM_CUST_PHONE]));
							//$rtOp["{$prop_phone}"] = $row['customer_name'];
							$prop_phone=str_replace("-", "", trim($row[CRM_CUST_PHONE]));
							$rtOp[] = $prop_phone;							
						}
				 }			   			  
			}
		}
	}
	return $rtOp;	
}


 
 //..get the week start and end date based on the date passed
 function x_week_range($date) {
    $ts = strtotime($date);
    $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    return array(date('Y-m-d', $start),
                 date('Y-m-d', strtotime('next saturday', $start)));
}
 
 /**
 * redirecting to the given url
 * @param string $url
 * @param boolean $isNewWindow
 */ 
 function biz_script_forward($url,$isNewWindow=FALSE){
 	if(is_not_empty($url)){
		if($isNewWindow){
			echo '<script>window.open("'.$url.'");</script>';
		}else{
			echo '<script>window.location.href="'.$url.'"</script>';
			exit;
		} 
	} 
 }
 
 /**
 * Return array of language`s Message string and message class for the default actions
 * @param integer $result
 * @return array
 */
 function biz_getLangMsgStrForDftlAct($result){
 	$array = array('class'=>'info','msg'=>''); 
 
	if(is_not_empty($result)){ 
		 if($result >= OPERATION_SUCCESS){
		 		$array['msg'] 	= 'SUCCESS_MSG';
				$array['class'] = 'success';
		 }elseif($result==OPERATION_FAIL){
		 		$array['msg'] 	= 'FAILURE_MSG';
				$array['class'] = 'error'; 
		 }elseif($result==OPERATION_DUPLICATE){
		 	$array['msg'] 	= 'DUPLICATE_MSG';
			$array['class'] = 'info'; 
		 } 
	 }  
	 return $array; 
 } 
 
 /**
 * For the customer it will check for the device cookie or if not found it will create new and return the current device cookie.
 * @param integer $by_manager
 * @return string 
 */
 function checkNcreateCustCookie($by_manager=0){
 	
 	$cust_cookie = '';
	//..check if customer
	if(isCustomer() || is_gt_zero_num($by_manager)){ 
	
		if(is_not_empty($_COOKIE[SES_DEVICE_COOKIE]) || is_not_empty($_SESSION[SES_DEVICE_COOKIE])){
		
			 if(is_not_empty($_COOKIE[SES_DEVICE_COOKIE])){
			 	$cust_cookie = $_COOKIE[SES_DEVICE_COOKIE]; 
				//..set the same variable for session also. 
				$_SESSION[SES_DEVICE_COOKIE] = $cust_cookie;
			 }else{
			 	$cust_cookie = $_SESSION[SES_DEVICE_COOKIE];
				//..set the cookie alive for  15 years.
				 //setcookie(SES_DEVICE_COOKIE,$cust_cookie,time() + (86400 * 365 * 15), '/restaurent_manager/', ''); 
				 setcookie(SES_DEVICE_COOKIE,$cust_cookie,time() + (86400 * 365 * 15), '');
			 }
		}else{
				$cust_cookie = generate_encrypted_password(uniqid(rand(0,getrandmax()),true));
				 
				//..set the cookie alive for  15 years.
				 //setcookie(SES_DEVICE_COOKIE,$cust_cookie,time() + (86400 * 365 * 15),'/restaurent_manager/', ''); 
				 setcookie(SES_DEVICE_COOKIE,$cust_cookie,time() + (86400 * 365 * 15), '');
				//..set the same variable for session also. 
				$_SESSION[SES_DEVICE_COOKIE] = $cust_cookie;
				
		} 
		
		//..empty the session for the Manager
		if(is_gt_zero_num($by_manager)){
			unset($_SESSION[SES_DEVICE_COOKIE]);
		}
		
	} 
	return $cust_cookie;
 }
  
	/**
	* It will check for the user cookie by the name or will create new and return the user cookie.
	* @param string $cust_name
	* @param integer $by_manager
	* @return integer
	*/ 
  function checkNcreateUserCookieId($cust_name,$by_manager=0){
		$uidbycookie = 0;
		
		if((isCustomer() || is_gt_zero_num($by_manager)) && is_not_empty($cust_name)){
		 
			//..get the customer cookie
			$cust_cookie = checkNcreateCustCookie($by_manager);
			$obj = new tbl_device_cookies();
			if($obj->readObject(array(DEVCK_COOKIE=>$cust_cookie,DEVCK_CUSTOMER=>$cust_name))){
				$uidbycookie = $obj->getdevck_id();
			}else{
				$uidbycookie = $obj->create($cust_cookie,$cust_name);
			} 
		}
		return $uidbycookie; 
	}
	
	function GetAmountTypes(){
		return array('PERCENT'=>'%','VALUE'=>'Rs');
	}
	
	/**
	* It will check for the user cookie by the name or will create new and return the user cookie.
	* @param string $cust_name
	* @param integer $by_manager
	* @return integer
	*/
  function checkNcreateUserCookieId_QRCODE($cust_name='guest_user',$by_manager=0){
		$uidbycookie = 0;

		if((isCustomer() || is_gt_zero_num($by_manager)) && is_not_empty($cust_name)){
      $_SESSION[SES_CUST_NM] = $cust_name;
			//..get the customer cookie
			$cust_cookie = checkNcreateCustCookie($by_manager);
			$obj = new tbl_device_cookies();
			$objqrcode_log = new tbl_qrcode_log();
			
			if($obj->readObject(array(DEVCK_COOKIE=>$cust_cookie,DEVCK_CUSTOMER=>$cust_name))){
				$uidbycookie = $obj->getdevck_id();
				//..Check if the returned customer record is last 2 hours
				//..else add one record to the log table
				$is_found=DB::ExecScalarQry('SELECT `'.QRLOG_ID.'` FROM `'.TBL_QRCODE_LOG.'` WHERE  `'.QRLOG_MEMBER_ID.'`='.$uidbycookie.' AND `'.QRLOG_IN_TIME.'` > SUBDATE("'.date(DATE_FORMAT).'", INTERVAL 2 HOUR);');
				if(is_gt_zero_num($is_found)==false){
           		$isSuccess = $objqrcode_log->create($uidbycookie, $_SESSION[SES_TABLE], Date(DATE_FORMAT), Date(DATE_FORMAT));
        }
			}else{
				$uidbycookie = $obj->create($cust_cookie,$cust_name);
				//...Here we need to insert one record to the
				//...qrcode scan history
				$isSuccess = $objqrcode_log->create($uidbycookie, $_SESSION[SES_TABLE], Date(DATE_FORMAT), Date(DATE_FORMAT));
			}
			
			unset($objqrcode_log);
		}
		return $uidbycookie;
	}


	/**
	* Return the Condition for the query whether the current table field is in the restaurant.
	* @param string $table_field
	* @param integer [optional] $restaurant_id default 0
	* @return string
  */
	
	function chkTableInRestaurant($table_field,$restaurant_id = 0){
		 $restaurant_id = is_gt_zero_num($restaurant_id)?$restaurant_id:$_SESSION[SES_RESTAURANT];
		 return  $table_field.' in (SELECT `table_id` FROM `tbl_dining_table` WHERE `table_restaurant` = '.$restaurant_id.')';
	}
	
	/**
	* Return the Condition for the query whether the current shift field is in the restaurant.
	* @param undefined $shift_field
	* @param undefined $restaurant_id
	* @return string
  */ 
		function chkShiftInRestaurant($shift_field,$restaurant_id = 0){
		 $restaurant_id = is_gt_zero_num($restaurant_id)?$restaurant_id:$_SESSION[SES_RESTAURANT];
		 return  $shift_field.' in (SELECT `shift_id` FROM `tbl_shift` WHERE `shift_restaurent` = '.$restaurant_id.')';
	} 
	
	
	/**
	* Return the Condition for the query whether the current shift field is in the restaurant.
	* @param undefined $shift_field
	* @param undefined $restaurant_id
	* @return string
  */ 
		function chkPromotionInRestaurant($promotion_field,$restaurant_id = 0){
		 $restaurant_id = is_gt_zero_num($restaurant_id)?$restaurant_id:$_SESSION[SES_RESTAURANT];
		 return  $promotion_field.' in (SELECT `id` FROM `pds_list_promotions` WHERE `prm_restaurent` = '.$restaurant_id.')';
	} 
	

/**
* Check allowed Flag to add the order manger note/customer name link
facility
*/
	function chk_preferance_allwd(){
		global $Global_member;
		if(((IS_SERV_ALWD_NOTE==1) && ($Global_member['member_role_id']==ROLE_WAITER))||($Global_member['member_role_id']==ROLE_MANAGER)||($Global_member['member_role_id']==ROLE_EXPEDITOR))
			return 1;
			return 0;
	} 
	 

 function callNotificationByStatus($status_id){
   //tbl_notifications::readArray(array(NOTIFY_STATUS=>$status_id));
 }
 
 function send_sms_for_india($phone_nos,$msg,$return_url=''){
 	
 	if(is_not_empty($return_url)==FALSE){
		$return_url= WWWROOT.'/user/rewrad_point_list.php';
	}
		foreach ($phone_nos as $number) {
			$number = str_replace(array('+','-'), '', filter_var($number, FILTER_SANITIZE_NUMBER_INT));	
			$data = array(
				 'user' => "inforesha",
				 'password' => "1nf0resha",
				 'msisdn' => "91{$number}",
				 'sid' => "INFORS",
				 'msg' => $msg,
				 'fl' => "0",
				 'gwid' => "2",
			);
			
			list($header, $content) = smsLanePostRequest(
				 "http://www.smslane.com//vendorsms/pushsms.aspx", // the url to post to
				 $return_url, // its your url
				 $data
			);
			print_r($header);
			print_r($content);
	
    }
	  
		return 1;
	
 }
 //..function to send message to slack by checking
 function send_slack_msg($phone,$msg){
 	//global $tbl_slack_users_active_condition;
 	//...Logic to send message to slack user	  	
  	$chk_slack_url=DB::ExecScalarQry('SELECT `slkusr_webhook` FROM `tbl_slack_users` WHERE `slkusr_phone`="'.$phone.'" AND (`slkusr_end_date` is NULL OR `slkusr_end_date` = 0 OR `slkusr_end_date` > CURDATE( ))');
  	
  	if(is_not_empty($chk_slack_url)){
	  // Make your message
	  $message = array('payload' => json_encode(array('text' => $msg)));
	  try {
		  // Use curl to send your message
		  $c = curl_init($chk_slack_url);
		  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($c, CURLOPT_POST, true);
		  curl_setopt($c, CURLOPT_POSTFIELDS, $message);
		  $_ts_rs=curl_exec($c);
		  curl_close($c);
	  } catch (Exception $e) {
		  
	  }
	  return 1;
	}
	return 0;
 }
 
 function send_sms_using_twilio($phone_nos,$msg,$return_url=''){
 	// Get the PHP helper library from twilio.com/docs/php/install
	//  require_once('../modules/twilio/Services/Twilio.php'); 
	// Loads the library  PATHROOT
	
	// Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    //$AccountSid = TWILIO_ACCOUNTSID;//"AC0703d8383f6f5ecf6bcbcccedd8112b4";
    //$AuthToken = TWILIO_AUTHTOKEN ;//"a91d2e4d3929218e40d6e5eef9a0f561";
 
    // Step 3: instantiate a new Twilio Rest Client
    //$client = new Services_Twilio($AccountSid, $AuthToken);
 
    // Step 4: make an array of people we know, to send them a message. 
    // Feel free to change/add your own phone number and name here.
    /* $people = array(
        "+14158675309" => "Curious George",
        "+14158675310" => "Boots",
        "+14158675311" => "Virgil",
    );*/
 	if(is_not_empty($return_url)==FALSE){
		$return_url= WWWROOT.'/user/rewrad_point_list.php';
	}
    // Step 5: Loop over all our friends. $number is a phone number above, and 
    // $name is the name next to it
    //foreach ($phone_nos as $number => $name) {
    	/*$data = array(
				 'user' => "inforesha",
				 'password' => "1nf0resha",
				 'msisdn' => "91{$number}",
				 'sid' => "WEBSMS",
				 'msg' => $msg,
				 'fl' => "0",
			);*/
		foreach ($phone_nos as $number) {
			$number = str_replace(array('+','-'), '', filter_var($number, FILTER_SANITIZE_NUMBER_INT));	
			//..check if it is in slack
			$_is_slack_usr=send_slack_msg($number,$msg);
			//echo 'sss='.$_is_slack_usr;
			//exit;
			if($_is_slack_usr==0){		
				$data = array(
					 'user' => "inforesha",
					 'password' => "1nf0resha",
					 'msisdn' => "91{$number}",
					 'sid' => "INFORS",
					 'msg' => $msg,
					 'fl' => "0",
					 'gwid' => "2",
				);				
				list($header, $content) = smsLanePostRequest(
					 "http://www.smslane.com//vendorsms/pushsms.aspx", // the url to post to
					 $return_url, // its your url
					 $data
				);
			}
			
		/*
		//..Extract only numbers  
		$number = str_replace(array('+','-'), '', filter_var($number, FILTER_SANITIZE_NUMBER_INT));			
        $sms = $client->account->messages->sendMessage( 
        // Step 6: Change the 'From' number below to be a valid Twilio number 
        // that you've purchased, or the (deprecated) Sandbox number 
            TWILIO_PHONE,  
            // The number we are sending to - Any phone number
            $number, 
            // The sms body"Hey $name, $msg"
			$msg
        ); */
        // Display a confirmation message on the screen
        //echo "Sent message to $name";
    }
	  	  	
	  	
	return 1;
		
	// Your Account Sid and Auth Token from twilio.com/user/account
	//$sid = "AC5ef8732a3c49700934481addd5ce1659"; 
	//$token = "{{ auth_token }}"; 
/*	$sid = 'AC3e909e0f3dabffa0c4f818fa160dd161'; 
	$token = '8cd4e23735397d044d78b4f8c563f5a9'; 
	$client = new Services_Twilio($sid, $token);	
	$client->account->messages->sendMessage($phone_nos, $msg, "http://www.example.com/hearts.png");*/
	 
	//$client->account->messages->sendMessage("+14158141829", "+15558675309", "Jenny please?! I love you <3", "http://www.example.com/hearts.png");
 }
 
 //..function to add reward point after order placed
 function add_reward_points_on_order($tbl_ordersinfo){
 	//..Calulate the multiplication factor 	
 	$_rest_multiplier=0.1;
	if(($tbl_ordersinfo[ORDER_CUSTOMER_ID]>0)){
		$_cust_detls=get_user($tbl_ordersinfo[ORDER_CUSTOMER_ID]);
		//print_r($_cust_detls);
		if(is_not_empty($_cust_detls) && (is_not_empty($_cust_detls['staff_award_multiplier']))){
			$_rest_multiplier=$_cust_detls['staff_award_multiplier'];
		}
		unset($_cust_detls);			
	}		
 	$objbiz_checkins=new biz_checkins();
 	$chkin_points=($tbl_ordersinfo['gr_amt']*$_rest_multiplier);	
 	//echo "chkin_points=$chkin_points || _rest_multiplier =$_rest_multiplier"; 	
 	$isSuccess = $objbiz_checkins->create($tbl_ordersinfo[ORDER_RESTAURANT],0, $tbl_ordersinfo[ORDER_CUSTOMER_ID],$tbl_ordersinfo[ORDER_TABLE_ID], $chkin_points, date(DATE_FORMAT),1,$tbl_ordersinfo['gr_amt'],'');
 	unset($objbiz_checkins);
 }
 
 function send_sms_using_mvayo(){
 	$ch = curl_init();
	$user="inforesha.sangram@gmail.com:1nf0resha";
	$receipientno="7588266377"; 
	$senderID="TEST SMS"; 
	$msgtxt="this is test message , test"; 
	curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
	$buffer = curl_exec($ch);
	if(empty ($buffer))
	{ echo " buffer is empty "; }
	else
	{ echo $buffer; } 
	curl_close($ch);
 	
 }
 function send_sms_using_smslane(){ 	 
		$data = array(
		 'user' => "inforesha",
		 'password' => "1nf0resha",
		 'msisdn' => "917588266377",
		 'sid' => "WebSMS",
		 'msg' => "Test Message from SMSLane",
		 'fl' => "0",
		);
		list($header, $content) = smsLanePostRequest(
		 "http://www.smslane.com//vendorsms/pushsms.aspx", // the url to post to
		 "http://localhost/restaurant_in/user/rewrad_point_list.php", // its your url
		 $data
		);
		echo $content;  	
 }
 
 function smsLanePostRequest($url, $referer, $_data) {
		 // convert variables array to string:
		 $data = array();
		 while(list($n,$v) = each($_data)){
		 $data[] = "$n=$v";
		 }
		 $data = implode('&', $data);
		 // format --> test1=a&test2=b etc.
		 // parse the given URL
		 $url = parse_url($url);
		 if ($url['scheme'] != 'http') {
		 die('Only HTTP request are supported !');
		 }
		 // extract host and path:
		 $host = $url['host'];
		 $path = $url['path'];
		 // open a socket connection on port 80
		 $fp = fsockopen($host, 80);
		 // send the request headers:
		 fputs($fp, "POST $path HTTP/1.1\r\n");
		 fputs($fp, "Host: $host\r\n");
		 fputs($fp, "Referer: $referer\r\n");
		 fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
		 fputs($fp, "Content-length: ". strlen($data) ."\r\n");
		 fputs($fp, "Connection: close\r\n\r\n");
		 fputs($fp, $data);
		 $result = '';
		 while(!feof($fp)) {
		 // receive the results of the request
		 $result .= fgets($fp, 128);
		 }
		 // close the socket connection:
		 fclose($fp);
		 // split the result header from the content
		 $result = explode("\r\n\r\n", $result, 2);
		 $header = isset($result[0]) ? $result[0] : '';
		 $content = isset($result[1]) ? $result[1] : '';
		 // return as array:
		 return array($header, $content);
}

/*function sms_using_sms_hub(){
	$sender_id='abc';           // sender id
	$mob_no = '917588266377';   //123, 456 being recepients number
	$user	='inforesha';
	$pwd	='1nf0resha';          //your account password
	$msg	='hi%20everyone';      //your message
	$str = trim(str_replace(‘ ‘, ‘%20', $msg));
	// to replace the space in message with  ‘%20'
	$url='http://login.smsgatewayhub.com/smsapi/pushsms.aspx?user='.$user.'&pwd='.$pwd.'&to='.$mob_no.'&sid='.$sender_id.'&msg='.$str.'&fl=0&gwid=2';
	// create a new cURL resource
	$ch = curl_init();
	// set URL and other appropriate options
	curl_setopt($ch, CURLOPT_URL,$url);
	// grab URL and pass it to the browser
	curl_exec($ch);
	// close cURL resource, and free up system resources
	curl_close($ch);
}*/

function usr_update_promotion_by_field($id, $field_name, $field_value, $field_is_string = 0 ){

	if($field_is_string == 1){
        $field_value = "'".mysql_real_escape_string ($field_value)."'";
    }else{
        $field_value = "".mysql_real_escape_string ($field_value)."";
	}
	$strsql = "UPDATE `pds_list_promotions`
			   SET `$field_name` = $field_value
			   WHERE `id` = $id";

	@mysql_query($strsql);

}

?>