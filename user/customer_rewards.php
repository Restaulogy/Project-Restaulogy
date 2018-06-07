<?php
	 
 include_once(dirname(dirname(__FILE__)).'/init.php');
 include_once('header.php');
 
 //====================== CONFIGURATION ======================
	/*$_RWD_CONFIG_TYPE='CUSTOMER'; //..'SERVER';
	if($_SESSION[SES_RESTAURANT]==4){
		//..for Fired Up Grill
		$_RWD_CONFIG_TYPE='SERVER';	
	}*/	
	$_RWD_CONFIG_TYPE=$_SESSION['rest_menu_opt_det'][RST_MNU_REWARD_CONF];
	//====================== CONFIGURATION ======================
//echo "_RWD_CONFIG_TYPE=$_RWD_CONFIG_TYPE";

 $_is_from_approve=0;
 $is_req = get_input('is_req',1); 
 //..For authenticating the customer
 $auth_email = get_input('auth_email',0);
 $auth_id = get_input('auth_id',0); 
 
 $action = get_input('action',''); 
 $act_app_rej = get_input('act_app_rej','');
 $server_validated = get_input('server_validated',0); 
 
 $_loy_cust_ord_amt = get_input('_loy_cust_ord_amt',0); 
 $sh_cust_pop=0;
 //$sh_cust_pop = get_input('sh_cust_pop',0);
 
 //print_r($_SESSION);
if($sesslife==true){
	if(isCustomer()){
		//if($Global_member['is_reward']==1){
		if($Global_member['staff_is_reward']==1){
			$auth_id = $Global_member['member_id'];					
			//..fetch latest updated data
			if(is_not_empty($_SESSION[SES_REWARD])==false){
				$_SESSION[SES_REWARD]=$rewrad_user=get_user($auth_id);
			} 								
		}
	}
	
	$sh_cust_pop_msg="";
	if(is_not_empty($_SESSION['prev_page'])){
		unset($_SESSION['prev_page']);		
		if(is_not_empty($_SESSION[SES_FLASH_MSG])){
				$sh_cust_pop_msg=$_SESSION[SES_FLASH_MSG];
				unset($_SESSION[SES_FLASH_MSG]);
		}else{
				$sh_cust_pop_msg="Welcome ".$Global_member['staff_full_name']."! ";
		}
		$sh_cust_pop=1;
	}
}else{
		//..Force them to login
		$_SESSION['prev_page']='reward';
		biz_script_forward($website.'/user/login.php');
}
 
 if(is_gt_zero_num($auth_id)){
 		$_SESSION[IS_RWD_AUTH]=$auth_id;
 }

 if(isCustomer()){
    $is_req=0;
 }

 //..Time to capture posted values
 if(is_gt_zero_num($_SESSION[SES_TABLE]))
 	$table_id =$_SESSION[SES_TABLE]; 
 else	
 	$table_id = get_input('table_id',$_SESSION[SES_TABLE]);
	
	$url= $website."/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR";
		
 if((isCustomer()) && (is_gt_zero_num($table_id)==false) ){
  $_SESSION['qr_sess_expired']=1;
 	$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang['main']['qrcode']['empty'].'</div>';	
 	biz_script_forward($website.'/user/dashboard.php');	
 } 

//print_r($_SESSION);
	
//==START ASK EMAIL CHECK CREATE SESSION
$reward_email = get_input('reward_email','');
if(is_not_empty($reward_email)){
	//..fetch the user from the email
	$rewrad_user=get_user_by_email($reward_email);
	if(is_not_empty($rewrad_user)){
		 $_SESSION[SES_REWARD]=$rewrad_user;
	}else{
		$_SESSION[SES_FLASH_MSG]  ='<div class="error">This email is not registered with reward program.</div>';
		biz_script_forward($url);
	}
}

if(is_not_empty($_SESSION[SES_CUST_NM])==FALSE && is_not_empty($_SESSION[SES_REWARD])){
	$_SESSION[SES_CUST_NM]=$_SESSION[SES_REWARD]['email'];
}
//==END ASK EMAIL CHECK CREATE SESSION

//==START START CUSTOMER SESSION FOR MANAGER ONLY WITHOUT REQUEST
$manager_cust_sess_id = get_input('manager_cust_sess_id',0);
// _add_award_pt_sms($manager_cust_sess_id,$_SESSION[SES_RESTAURANT],$_SESSION[SES_REWARD][STAFF_PHONE]);
/*if(($_RWD_CONFIG_TYPE=='RESTAURANT') && ($Global_member['member_role_id'] == ROLE_WAITER || $Global_member['member_role_id'] == ROLE_MANAGER || $Global_member['member_role_id'] == ROLE_ADMIN) && is_gt_zero_num($manager_cust_sess_id)){*/
if(($Global_member['member_role_id'] == ROLE_WAITER || $Global_member['member_role_id'] == ROLE_MANAGER || $Global_member['member_role_id'] == ROLE_ADMIN) && is_gt_zero_num($manager_cust_sess_id)){
			
			//..get the tmp_sess_details
			$_SESSION['sel_reward_sess']=0;
			$_SESSION[IS_RWD_AUTH]=$manager_cust_sess_id;
			$_SESSION[CUST_TBL_ID]=0;
			$_SESSION[CUST_REQUEST_TYPE]='ADD_POINT';
			$smarty->assign('cust_request_type','ADD_POINT');
			$smarty->assign('manager_cust_sess_id',$manager_cust_sess_id);
			
			//..fetch the user from the email
			$rewrad_user=get_user($manager_cust_sess_id,'');
				
			if(is_not_empty($rewrad_user)){
				 $_SESSION[SES_REWARD]=$rewrad_user;
				 $_SESSION[SES_REWARD]['cust_sess_id']=0;
				 $_SESSION[SES_REWARD]['cust_user_id']=$manager_cust_sess_id;
				 //$_SESSION[SES_FLASH_MSG] = '<div class="info">Approved successfully.</div>';
				 $is_req=0;
				 $server_validated = 1;
				 $_is_from_approve=1;				 
				 //$obj_temp_reward_sess->_update_status($sel_reward_sess,'APPROVED');			
			}	
			
}	
//==END START CUSTOMER SESSION FOR MANAGER ONLY WITHOUT REQUEST

//==START APPROVE_CUST_RWD_SESS..
$sel_reward_sess = get_input('sel_reward_sess','');

if(($_RWD_CONFIG_TYPE=='RESTAURANT') && ($Global_member['member_role_id'] == ROLE_WAITER || $Global_member['member_role_id'] == ROLE_MANAGER) && is_not_empty($act_app_rej) && is_not_empty($sel_reward_sess)){
		$obj_temp_reward_sess= new tbl_temp_reward_sess();
		//....CASE -I] APPROVE 
		if($act_app_rej=='approve_cust_rwd_sess'){
			//..get the tmp_sess_details
			$temp_reward_sess_detail=tbl_temp_reward_sess::GetInfo($sel_reward_sess);
			$_SESSION['sel_reward_sess']=$sel_reward_sess;
			$_SESSION[IS_RWD_AUTH]=$temp_reward_sess_detail[TMP_RWSE_USER_ID];
			$_SESSION[CUST_TBL_ID]=$temp_reward_sess_detail[TMP_RWSE_TABLE_ID];
			$_SESSION[CUST_REQUEST_TYPE]=$temp_reward_sess_detail[TMP_RWSE_REQUEST_TYPE];
			$smarty->assign('cust_request_type',$temp_reward_sess_detail[TMP_RWSE_REQUEST_TYPE]);
			//..fetch the user from the email
			$rewrad_user=get_user($temp_reward_sess_detail[TMP_RWSE_USER_ID]);
			if(is_not_empty($rewrad_user)){
				 $_SESSION[SES_REWARD]=$rewrad_user;
				 $_SESSION[SES_REWARD]['cust_sess_id']=$temp_reward_sess_detail[TMP_RWSE_TABLE_SESSION];
				 $_SESSION[SES_REWARD]['cust_user_id']=$temp_reward_sess_detail[TMP_RWSE_COOKIE_ID];
				 //$_SESSION[SES_FLASH_MSG] = '<div class="info">Approved successfully.</div>';
				 $is_req=0;
				 $server_validated = 1;
				 $_is_from_approve=1;				 
				 //$obj_temp_reward_sess->_update_status($sel_reward_sess,'APPROVED');			
			}			
		}elseif($act_app_rej=='reject_cust_rwd_sess'){
				 	//....CASE -I] REJECT 
				 $_SESSION[SES_FLASH_MSG] = '<div class="info">Rejected successfully.</div>';
				 $server_validated = 1;				 
				 $obj_temp_reward_sess->_update_status($sel_reward_sess,'REJECTED');
				 _destroy_cust_reward_sess();
		}	
		unset($obj_temp_reward_sess);
}	
//==END APPROVE_CUST_RWD_SESS


//==START CUST POST DEMANDS..can be add visit/rdeem
$cust_demand = get_input('cust_demand',0);
if(($_RWD_CONFIG_TYPE=='RESTAURANT') && (isCustomer()) && is_gt_zero_num($cust_demand) && is_not_empty($_SESSION[SES_REWARD]['unique_cd'])){
$_SESSION[SES_REWARD]['cust_sess_id']=0;	
	//..add to temporary table if not added previously
	if($cust_demand==1){
		$tmp_rwse_request_type='ADD_POINT';
	}elseif($cust_demand==2){
		$tmp_rwse_request_type='REDEEM';		
	}		
	
	//..Check if the returned customer record is last 2 hours
	$is_found=tbl_temp_reward_sess::chk_if_record_wthin_2_hrs($_SESSION[SES_REWARD]['id'],$table_id,$tmp_rwse_request_type);
		
	if(is_gt_zero_num($is_found)==false){ 
									 
	$objtbl_temp_reward_sess= new tbl_temp_reward_sess();
	$isSuccess = $objtbl_temp_reward_sess->create($_SESSION[SES_REWARD]['id'], $table_id, $_SESSION[SES_REWARD]['cust_sess_id'], $_SESSION[SES_REWARD]['unique_cd'], 'PENDING', $_SESSION[SES_REWARD]['cust_user_id'],'','',$tmp_rwse_request_type);
	if(is_not_empty($isSuccess)){
				//..notification to admin
				if($cust_demand==1){
					biz_send_alert($table_id,$_SESSION[SES_CUST_NM],0,sprintf($_lang[TBL_ALERTS]['manager']['RWD_ADD_VISIT'],$table_id,$_SESSION[SES_REWARD]['unique_cd']),ALERT_FOR_MANGER,REWARD_CUST);	
				}elseif($cust_demand==2){
					biz_send_alert($table_id,$_SESSION[SES_CUST_NM],0,sprintf($_lang[TBL_ALERTS]['manager']['RWD_CLAIM_REDEEM'],$table_id,$_SESSION[SES_REWARD]['unique_cd']),ALERT_FOR_MANGER,REWARD_CUST);		
				}				 
		//..notification to server
				if(is_gt_zero_num($table_id)){
				 	$order_emp_id= GetDfltTblEmployee($table_id); 
				} 
				biz_send_alert($table_id,$_SESSION[SES_CUST_NM],0,sprintf($_lang[TBL_ALERTS]['customer']['RWD_ADD_VISIT'],$table_id),$order_emp_id,REWARD_CUST);				
				//$_SESSION[SES_FLASH_MSG] =  '<div class="info">'.$_lang[TBL_ALERTS]['customer']['RWD_ADD_VISIT'].'</div>';
	}
	//..User flash message
	if(is_not_empty($isSuccess)){
		if(is_gt_zero_num($isSuccess)){
			$_SESSION[SES_FLASH_MSG]= "<div class='info'>".$_lang['tbl_temp_reward_sess']['CREATE']['SUCCESS_MSG']."</div>";
		}elseif($isSuccess == OPERATION_FAIL){
			$_SESSION[SES_FLASH_MSG]= "<div class='error'>".$_lang['tbl_temp_reward_sess']['CREATE']['FAILURE_MSG']."</div>";			
		}elseif($isSuccess == OPERATION_DUPLICATE){
			//$_SESSION[SES_FLASH_MSG]= "<div class='error'>".$_lang['tbl_temp_reward_sess']['CREATE']['DUPLICATE_MSG']."</div>";
			$_SESSION[SES_FLASH_MSG]= "<div class='info'>".$_lang['tbl_temp_reward_sess']['CREATE']['SUCCESS_MSG']."</div>";
		}
	}
	unset($objtbl_temp_reward_sess);
	
	}else{
			$_SESSION[SES_FLASH_MSG]= "<div class='error'>".$_lang['tbl_temp_reward_sess']['CREATE']['DUPLICATE_MSG']."</div>";
	}
	
}	
//==END CUST POST DEMANDS..can be add visit/rdeem

//==START SERVER PIN VALIDATION
$server_pin = get_input('server_pin',''); 
$server_code = get_input('server_code',0);

//... START OPTION A] customer side option selected
$cust_server_pin = get_input('cust_server_pin','');
//$server_validated = 0; 
//..Make this available for the server/manager as well.
 if($sesslife  && isCustomer() && ($action=='validate_server_pin') && is_not_empty($cust_server_pin)){
 //if($sesslife  && ($action=='validate_server_pin') && is_not_empty($cust_server_pin)){
	$rslt_fnd=validate_server_pin($cust_server_pin);
	if(is_gt_zero_num($rslt_fnd)){
			$server_validated = $rslt_fnd;
			//echo "server_validated=$server_validated";
			
			$smarty->assign('server_validated',$server_validated);
			$_SESSION[SES_FLASH_MSG] =  '<div class="info">Server pin validated successfully.</div>';
	}else{
			$_SESSION[SES_FLASH_MSG]= "<div class='error'>".$_lang['biz_checkins']['CREATE']['CD_DOES_NOT_MATCH']."</div>";
	}			
}
//... END OPTION A] customer side option selected


//... START OPTION B] server side option selected
if(($_RWD_CONFIG_TYPE=='RESTAURANT') && $sesslife && ($Global_member['member_role_id'] == ROLE_WAITER || $Global_member['member_role_id'] == ROLE_MANAGER) && ($action=='validate_server_pin') && is_not_empty($server_pin) && (is_not_empty($server_code))){
		
		$rslt_fnd=validate_server_pin($server_pin);
		if(is_gt_zero_num($rslt_fnd)){
				$server_validated = $rslt_fnd; 
				$smarty->assign('server_validated',$server_validated);
				//..check server code and get the reward user 
				$server_code=explode('-',$server_code);

				if(is_not_empty($server_code) && count($server_code)>2){
						$auth_id=intval($server_code[(count($server_code)-1)]);
						$cust_sess_id=intval($server_code[(count($server_code)-2)]);
						$cust_user_id=intval($server_code[(count($server_code)-3)]);
						
						//..store the reward session now
						if(is_gt_zero_num($auth_id)){
						 		$_SESSION[IS_RWD_AUTH]=$auth_id;
								//..fetch the user from the email
								$rewrad_user=get_user($auth_id);
								if(is_not_empty($rewrad_user)){
									 $_SESSION[SES_REWARD]=$rewrad_user;
									 $_SESSION[SES_REWARD]['cust_sess_id']=$cust_sess_id;
									 $_SESSION[SES_REWARD]['cust_user_id']=$cust_user_id;
									 $_SESSION[SES_FLASH_MSG] =  '<div class="info">Server pin and code validated successfully.</div>';
								}else{
									$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang['biz_rewards']['info_msg']['cust_code_invalid'].'</div>';
								}
						}
				}else{
							$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang['biz_rewards']['info_msg']['cust_code_invalid'].'</div>';
				}				
		}else{
				$_SESSION[SES_FLASH_MSG]= "<div class='error'>".$_lang['biz_checkins']['CREATE']['CD_DOES_NOT_MATCH']."</div>";
		}			
}
//... END OPTION B] server side option selected

//==END SERVER PIN VALIDATION

//==START REDEEM LOGIC
$redim = get_input('redim',0);
$rwd_id = get_input('rwd_id',0);
$promotion_id = get_input('promotion',0);
$rwd_points = get_input('rwd_points',0);
$rwd_invoice = get_input('rwd_invoice','');
//echo "server_validated=$server_validated";

if ((($_RWD_CONFIG_TYPE=='RESTAURANT') && (is_gt_zero_num($_SESSION[IS_RWD_AUTH]))) || 
(($_RWD_CONFIG_TYPE=='CUSTOMER') && ($server_validated>0))){
	//echo "I AM IN NOW.. [$redim,$rwd_id,$promotion_id]";

		if(is_gt_zero_num($redim) && is_gt_zero_num($rwd_id) && is_gt_zero_num($promotion_id)){
			//echo "NNN.1";
	 //..STEP-1] Claim the coupon	
			 if(is_not_empty($_SESSION[SES_CUST_NM])){
			 		$customer_name=$_SESSION[SES_CUST_NM];
			 }else{
			 		$customer_name=$_SESSION[SES_REWARD]['email'];
			 }
			 $user_id=$_SESSION[SES_REWARD]['cust_user_id'];	 
			 /*if(is_not_empty($customer_name)){
				if(is_gt_zero_num($_SESSION[SES_COOKIE_UID])){
					$user_id = $_SESSION[SES_COOKIE_UID];					
				}else{
					$user_id = checkNcreateUserCookieId($customer_name);
					$_SESSION[SES_COOKIE_UID] = $user_id;
				}				
			 }*/	
			 
			 $is_found=biz_rewards::chk_if_redeem_wthin_2_hrs($_SESSION[SES_REWARD]['id'],$_SESSION[CUST_TBL_ID]);
			 //$is_found=0;
			 if(is_gt_zero_num($is_found)==false){	
						 				
					 $claim_result=customer_claim_promotion($promotion_id,$_SESSION[SES_REWARD]['id'],$customer_name,$rwd_id,$_SESSION[SES_REWARD]['id'],$_SESSION[SES_REWARD]['cust_sess_id'],$server_validated,$rwd_points,$rwd_invoice);	
					 if($claim_result>0){
					 	
					 //..sms for Claim succcessfull
					 if(is_gt_zero_num($_SESSION[SES_REWARD][STAFF_PHONE])){
					 	$_prom_specifics=_get_prom_specifics($promotion_id);
					 	$_msg="Reward-".$_prom_specifics['title']." redeemed successfully";
					 	send_sms_using_twilio(array($_SESSION[SES_REWARD][STAFF_PHONE]),$_msg);
					 	biz_send_alert($table_id,$_SESSION[SES_REWARD][STAFF_PHONE],0,sprintf($_lang[TBL_ALERTS]['manager']['RWD_CLAIM_REDEEM_COMP'],$table_id,$_SESSION[SES_REWARD]['id']),ALERT_FOR_MANGER,REWARD_CUST);		
					 }				 
					 
					 $_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['biz_rewards']['info_msg']['claim_success'].'</div>';
					 if(is_gt_zero_num($_SESSION['sel_reward_sess'])){
					 		//...Change status to update
						 	$obj_temp_reward_sess= new tbl_temp_reward_sess();
							$obj_temp_reward_sess->_update_status($_SESSION['sel_reward_sess'],'APPROVED');
							unset($obj_temp_reward_sess);								
							 
							//..send notification to the customer
							if($_RWD_CONFIG_TYPE=='RESTAURANT'){
									biz_send_alert($_SESSION[CUST_TBL_ID],$_SESSION[SES_CUST_NM],0,$_lang['biz_checkins']['CREATE']['CUST_REDEEM_SUCCESS_MSG'],$_SESSION[SES_REWARD]['id'],REWARD_CUST);
							}
					 	}	
						if($_RWD_CONFIG_TYPE=='RESTAURANT'){
								_destroy_cust_reward_sess();
								biz_script_forward($website.'/user/biz_checkins.php');
						}else{
								if(isCustomer()){
									biz_script_forward($website.'/user/customer_rewards.php');
								}else{
									biz_script_forward($website.'/user/customer_rewards.php?manager_cust_sess_id='.$manager_cust_sess_id);
								}
						}							
						//biz_send_alert($_SESSION[CUST_TBL_ID],$_SESSION[SES_CUST_NM],0,sprintf($_lang[TBL_ALERTS]['manager']['RWD_CLAIM_REDEEM_COMP'],$_SESSION[CUST_TBL_ID],$_SESSION[SES_REWARD]['unique_cd']),ALERT_FOR_MANGER,REWARD_CUST);
						//..STEP-2] update the reward use visit balance minus the visit bal					
					 }else{
					 		if($claim_result==-1){
								$_SESSION[SES_FLASH_MSG]  = '<div class="success">You already redeemed it.</div>';
							}else{
								$_SESSION[SES_FLASH_MSG] = '<div class="error">Problem during redeem promotion.</div>';	
							}	 		
				 	 }
			 }else{
			 		$_SESSION[SES_FLASH_MSG]= "<div class='error'>".$_lang['tbl_temp_reward_sess']['CREATE']['MAN_REDEEM_MSG']."</div>";
			 }	 	 	 
		}			
}
//==END REDEEM LOGIC

	//..Fetch all rewards with applicable/redeem button
 	if(is_not_empty($_SESSION[SES_REWARD])){
 		//..fetch latest updated data
 		$rewrad_user=get_user($_SESSION[SES_REWARD]['id']);
		//print_r($rewrad_user);
		if(is_gt_zero_num($_SESSION[IS_RWD_AUTH])){
			//..Now chk_all_rewards applicable for this user
			$rewards_avail=members::chk_all_rewards($rewrad_user['id']);			
			
			if(is_not_empty($rewards_avail)){
				$smarty->assign('rewards_avail',$rewards_avail);										
			}			
		}
		$smarty->assign('rewrad_user',$rewrad_user);
				
		//.. START fetch user stat
		$overall_stat=biz_rewards::getRewardUserStats($rewrad_user['id'],$_SESSION[SES_RESTAURANT]);
		
		$smarty->assign('overall_stat',$overall_stat);
		//.. END fetch user stat
		
		//..START genearte the UNIQUE CODE
		if(isCustomer() && is_not_empty($_SESSION[SES_REWARD]['unique_cd'])==false){
		//if(isCustomer() ){
			 if(is_not_empty($_SESSION[SES_CUST_NM])){
			 		$customer_name=$_SESSION[SES_CUST_NM];
			 }else{
			 		$customer_name=$_SESSION[SES_REWARD]['email'];
			 }

			 if(is_not_empty($customer_name)){
				if(is_gt_zero_num($_SESSION[SES_COOKIE_UID])){
					$cust_user_id = $_SESSION[SES_COOKIE_UID];					
				}else{
					$cust_user_id = checkNcreateUserCookieId($customer_name);
					$_SESSION[SES_COOKIE_UID] = $cust_user_id;
				}				
			 }
			 $cust_sess_id = checkNcreateSession($_SESSION[SES_TABLE],$customer_name);
			 if(is_gt_zero_num($cust_sess_id)==FALSE){
			 		$cust_sess_id=0;
			 }
			
			 //$unique_cd=genearte_auto_cde(3)."-".trim($cust_user_id)."-".trim($cust_sess_id)."-".trim($_SESSION[SES_REWARD]['id']);
			 $unique_cd=genearte_auto_cde(5);
			 $_SESSION[SES_REWARD]['unique_cd']=trim($unique_cd);
			 if(is_gt_zero_num($cust_sess_id))
			 		$_SESSION[SES_REWARD]['cust_sess_id']=$cust_sess_id;
			 else	
			 		$_SESSION[SES_REWARD]['cust_sess_id']=0;	
			 $_SESSION[SES_REWARD]['cust_user_id']=$cust_user_id;
			 
		}	
		//..END genearte the UNIQUE CODE	
	
	
		//..START Get all the redeem history of the customer
		$result_found=0;
		$sql=  'SELECT `p`.`title`,`c`.`rwd_points`,`c`.`redimed_date`,`c`.`rwd_invoice`
						FROM `pds_redim_cupons` as `c`
						INNER JOIN `'.BIZ_REWARDS.'` as `r` ON  
						`r`.`'.RWD_ID.'`=`c`.`rwd_deals_sel`
						INNER JOIN `pds_list_promotions` as `p` ON 
						`p`.`id` = `c`.`promotion_id`	
					  WHERE `c`.`rwd_usr_id`='.$rewrad_user['id'].' AND `r`.`'.RWD_BUSS_ID.'`='.$_SESSION[SES_RESTAURANT].' ORDER BY `c`.`id` DESC;';
		//echo $sql;
		$redeem_hist=DB::ExecQry($sql);
		$smarty->assign('redeem_hist',$redeem_hist);	
		$smarty->assign('result_found',count($redeem_hist));
		//..END Get all the redeem history of the customer
		
		//..Get award history of teh customer..
		$biz_checkinslist = biz_checkins::readArray(array(CHKIN_BUSS_ID=>$_SESSION[SES_RESTAURANT],CHKIN_USER_ID=>$_SESSION[SES_REWARD]['id'],SORT_BY=>'DESC',SORT_ON=>CHKIN_ID),$result_found,1);		
		$smarty->assign('biz_checkinslist', $biz_checkinslist);
		
		//..Fetch attached users email coupon
 if(is_not_empty($_SESSION[SES_REWARD])){
 		//print_r($_SESSION[SES_REWARD]);
		
 		$_act_crm_id=tbl_crm::get_crm_id_from_email($_SESSION[SES_REWARD]['email']);
		/*echo "SELECT `e`.*,`p`.* FROM `".CRM_PROM_EMAILS."` `e` 
	 INNER JOIN `".pds_list_promotions."` `p` ON `e`.`".CRM_PR_ML_PROMOTION."`=`p`.`id` WHERE  `e`.`".CRM_PR_ML_USERID."`={$_act_crm_id} AND `p`.`end_date` >='".date(DATE_FORMAT)."'  AND (`e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` is NULL OR `e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` = 0 OR `e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` > CURDATE( )) AND `p`.`prm_restaurent`=".$_SESSION[SES_RESTAURANT];
	 
	 */
	 
 		$_email_coupons =DB::ExecQry("SELECT `e`.*,`p`.* FROM `".CRM_PROM_EMAILS."` `e` 
	 INNER JOIN `pds_list_promotions` `p` ON `e`.`".CRM_PR_ML_PROMOTION."`=`p`.`id` WHERE  `e`.`".CRM_PR_ML_USERID."`={$_act_crm_id} AND `p`.`end_date` >='".date(DATE_FORMAT)."' AND `e`.`flg_send`=0  AND (`e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` is NULL OR `e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` = 0 OR `e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` > CURDATE( )) AND `p`.`prm_restaurent`=".$_SESSION[SES_RESTAURANT]);	
	 //print_r($_email_coupons);
	  //INNER JOIN `".TBL_CRM."` `c` ON `c`.`".CRM_CUST_ID."`=`e`.`".CRM_PR_ML_USERID."`
	  $smarty->assign('_email_coupons', $_email_coupons);		
 } 
	
	}	
	$smarty->assign('_RWD_CONFIG_TYPE',$_RWD_CONFIG_TYPE);	
	$smarty->assign('active_page',$active_page);
	
	//..check if from the 
	$smarty->assign('_is_from_approve',$_is_from_approve);		
	
	if(($_RWD_CONFIG_TYPE=='RESTAURANT') && ($Global_member['member_role_id'] == ROLE_WAITER || $Global_member['member_role_id'] == ROLE_MANAGER)){
			$cust_temp_reward_sess = tbl_temp_reward_sess::readArray(array(TMP_RWSE_STATUS=>'PENDING',TABLE_RESTAURANT=>$_SESSION[SES_RESTAURANT],'todays_only'=>1),$result_found,1);
			$smarty->assign('cust_temp_reward_sess',$cust_temp_reward_sess);
	}
/* Include required files as per the admin option of inbuilt captcha enabled or not. */
  //if(!$sesslife){	   
	$template = "biz_rewards/customer_rewards.tpl";
	
	$breadcrumbs[] = array('link'=>$website.'/user/customer_rewards.php', 'title'=>$_lang['biz_rewards']['title']);

 if($is_req==1){
 		$active_page = 'customer_requests';
 }else{
 		$active_page = 'customer_rewards';
 } 	   

  //..popup message for the customer 
$smarty->assign('sh_cust_pop',$sh_cust_pop);
$smarty->assign('sh_cust_pop_msg',$sh_cust_pop_msg);	

$smarty->assign('_loy_cust_ord_amt',$_loy_cust_ord_amt);
	
  include('footer.php'); 
	

//==START SEND AUTHENTICATE EMAIL LOGIC
/*if(is_gt_zero_num($auth_email) && ($auth_id==0)){
		$customer_email=$_SESSION[SES_REWARD]['email'];
		$auth_link="<a href='{$website}/user/customer_rewards.php?auth_id=1'>Authenticate Me</a>";
		//..Finally send the email with the above content
		$restaurant_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
		$subject = "Authenticate reward session of {$customer_email} on ".$restaurant_info[RESTAURENT_NAME];
		$email_body=sprintf($_lang['biz_rewards']['info_msg']['redeem_email_msg'],$auth_link,$_SESSION[RESTAURENT_NAME]);	
		$_SESSION[SES_FLASH_MSG]  = '<div class="success">'.$_lang['biz_rewards']['info_msg']['auth_lnk_emailed'].'.</div>';		
		try {
			//echo $subject,$restaurant_info[RESTAURENT_EMAIL],$customer_email,$email_body,$restaurant_info[RESTAURENT_NAME];			
			@send_mail_using_php($subject,$restaurant_info[RESTAURENT_EMAIL],$customer_email,$email_body,$restaurant_info[RESTAURENT_NAME]);
		}catch(Exception $e) {
		  // echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
}	*/
//==END SEND AUTHENTICATE EMAIL LOGIC

?>