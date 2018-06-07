<?php

 include("../service_init.php");
 include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_list_promotions.class.php');
 
/* //..http base authentication
if (!isset($_SERVER['PHP_AUTH_USER']) && !isset($_SERVER['PHP_AUTH_PW'])) {
	
	header("WWW-Authenticate: Basic realm=\"Please enter your username and password to proceed further\"");
	header("HTTP/1.0 401 Unauthorized");
	print "Oops! It require login to proceed further. Please enter your login detail\n";
	exit;
}else{
	if ($_SERVER['PHP_AUTH_USER'] == RAPI_ID && $_SERVER['PHP_AUTH_PW'] == RAPI_KEY) {
		//echo 'User validated';
		//exit;
	}else{		
		header("WWW-Authenticate: Basic realm=\"Please enter your username and password to proceed further\"");
		header("HTTP/1.0 401 Unauthorized");
		print "Oops! It require login to proceed further. Please enter your login detail\n";
		exit;
	}
}*/
		
 $tag= get_input("tag",'');  

if(is_not_empty($tag)){   

    // response Array
    $_response = array("tag" => $tag, "success" => 0, "message" => '');
    $restaurant_id = get_input("restaurant_id",1); 
	$_SESSION[SES_RESTAURANT]=$restaurant_id;
    $objtbl_rest_menu_opt = new tbl_rest_menu_opt();	
	$rest_menu_opt_det=$objtbl_rest_menu_opt->GetInfo(0,$_SESSION[SES_RESTAURANT]);
	$_SESSION['rest_menu_opt_det']=$rest_menu_opt_det;
	unset($objtbl_rest_menu_opt);
	$_RWD_CONFIG_TYPE=$_SESSION['rest_menu_opt_det'][RST_MNU_REWARD_CONF];
	$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);

    // check for tag type
    if ($tag == 'get_user_ids_by_phone') {	
    	$_user_ids=array();	
		// Request type is check Login
		$phone = get_input("phone",'');	
		if(is_not_empty($phone)){
			$_user_ids=get_user_for_all_rest($phone);
			if(is_not_empty($_user_ids)){
				$_response['success']= 1;
		 	 	$_response['user_ids']= $_user_ids;
		 	 	$_response['message'] = 'User id fetch successful.';
			}else{
				$_response['message'] = 'User not found in our system.';
			}			
		}else{
			$_response['message'] = 'Please provide the phone number to get user ids.';
		}
		
	}elseif($tag=="rest_rewards"){
 		$_restaurant = $restaurant_id;//get_input('restaurant','');

    	if(is_gt_zero_num($restaurant_id)){
			$result_found=0;
			$_final_lst=array();
			$biz_rewardslist = biz_rewards::readArray(array(RWD_BUSS_ID=>$restaurant_id,'is_within_range'=>1),$result_found,1);
			if(is_not_empty($biz_rewardslist)){
				foreach($biz_rewardslist as $val){
					$_final_lst[]=$val;
				}				
			}		
	 	 	$_response['success']= 1;
	 	 	$_response['reward_list']=$_final_lst;
	 	 	
	 	 	$_multyply_fat=tbl_loyalty_level::GetAwardMultiplier(0,$restaurant_id);
	 	 	$_response['multiply_factor']= round(1/$_multyply_fat).' Rs spending= 1 Pt';
	 	 	$_response['message'] = 'Reward list fetch successful.';		   	 	
		}else{
			$_response['message']='You must provide restaurant to fetch rewards.';
		}			
	}elseif($tag=="send_otp"){
		
    	$_phone = get_input('customer_phone','');
 		$_restaurant = $restaurant_id;//get_input('restaurant','');

    	if(is_gt_zero_num($_phone)){
			if(is_not_empty($_phone) && is_not_empty($_restaurant)){
		 		$response = tbl_order_confirmation_codes::createConfirmationCode($_phone,$_restaurant); 
		 	 	//$result =  array("timestamp"=>$response['timestamp']) ;
		 	 	$rest_info = tbl_restaurent::GetInfo($_restaurant);
		 	 	$_sms_msg_bdy = $rest_info['restaurent_name']." Loyalty Code: ".$response['code'];
		 	 	tbl_order_confirmation_codes::sendSMS($_phone,$_sms_msg_bdy); 
		 	 	$_response['success']= 1;
		 	 	$_response['timestamp']= $response['timestamp'];
		 	 	$_response['message'] = 'OTP send successfully';
		    }else{
				$_response['message']='You must provide restaurant to send OTP to.';
			}		 	
		}else{
			$_response['message']='You must provide phone number to send OTP.';
		}	
			
	}elseif($tag=="verify_otp"){
		
    	 $_phone = get_input('customer_phone','');
		 $_restaurant = $restaurant_id ;//get_input('restaurant','');
		 $_code = get_input('code','');
		 $_timestamp = get_input('timestamp','');		 
		 $cust_rest_pin = get_input('cust_rest_pin','');
		
    	 $_response['message']='';
		 $_response['verified']=0;
		 $_is_valid= 0;
		 $res = 0;
		 //..validate mobile code
		 if(is_not_empty($_phone) && is_not_empty($_restaurant) && is_not_empty($_code) && is_not_empty($_timestamp)){
		 		//..Step-1) First check if the code is five digit
		 		if(strlen($_code)==5){
		 			//..Step-2) Check exceptional 5 digit code for verification				 			
		 			if($_restaurant==16){ //..Rrestaulogy restaurant
						if($_code=='78468'){
							$_is_valid= 1;
						}
					}elseif($_restaurant==15){ //..Kabab Hut restaurant
						if($_code=='58621'){
							$_is_valid= 1;
						}
					}elseif($_restaurant==14){ //..Carrots N Celery restaurant
						if($_code=='58621'){
							$_is_valid= 1;
						}
					}elseif($_restaurant==12){ //..Chinese room restaurant
						if($_code=='53712'){
							$_is_valid= 1;
						}
					}elseif($_restaurant==11){ //..China grill restaurant
						if($_code=='42871'){
							$_is_valid= 1;
						}
					}elseif($_restaurant==10){ //..Atlantis restaurant
						if($_code=='54682'){
							$_is_valid= 1;
						}
					}elseif($_restaurant==9){ //..Zaika restaurant
						if($_code=='92753'){
							$_is_valid= 1;
						}
					}elseif($_restaurant==1){ //..Mainland china restaurant
						if($_code=='12345'){
							$_is_valid= 1;
						}
					}

					if($_is_valid==1){
						$_response['message']='Phone Code verified successfully';
						$res = 1;
					}else{
						$_response['message']='Invalid mobile verification code';
					}
					$_response['verified']=$_is_valid;
				}else{
					$res = tbl_order_confirmation_codes::verifyConfirmationCode($_phone,$_timestamp,$_code,$_restaurant); 				
			 		$_response['message']='Phone Code verified successfully'; 
			 		$_response['verified']=1;
				}  
		  } 	
	  if(is_gt_zero_num($res)){
	  		//..validaet Restaurant pin
	  		if(is_not_empty($cust_rest_pin)){
	  			$_serv_pin=validate_server_pin($cust_rest_pin);
			  	 	if(is_gt_zero_num($_serv_pin)) {
			  	 		$_response['message']='Successfully validated';
						$_response['verified']=1;
					}else{
						$_response['message']='Invalid Restaurant PIN';
						$_response['verified']=0;
					} 
	  		} 	 	
		  }else{
		  	 	$_response['message']='Invalid mobile verification code';
				$_response['verified']=0;
		  }	
		  $_response['success']= $_response['verified'];  	
			
	}elseif($tag=="get_loyalty_point_history"){
		
    	$auth_id				= get_input('auth_id',0);
    	$result_found=0;
    	$result_found=0;
		$arr_filter=array();
   		$arr_filter[SES_RESTAURANT]=$_SESSION[SES_RESTAURANT];		
		$arr_filter['is_reward']=1;		
		$arr_filter[SORT_BY]='DESC';
		$arr_filter[SORT_ON]='chkin_id';
		$search_from_dt= get_input("search_from_dt",'');
		$search_to_dt= get_input("search_to_dt",'');

		if(is_gt_zero_num($auth_id)){
			$usr_det=get_user($auth_id);//$_response['usr_det']= $usr_det;
			if($usr_det['member_role_id']!=ROLE_CUSTOMER){
				$objbiz_checkins=new biz_checkins();
				$biz_checkinslist = $objbiz_checkins->_get_award_redeem_history($arr_filter,$result_found,1);
				unset($objbiz_checkins);
				
				$arr_filter_his=array(FLG_SEND=>1,'prm_restaurent'=>$_SESSION[SES_RESTAURANT],SORT_BY=>'DESC',SORT_ON=>'crm_pr_ml_id');
				$objcrm_prom_emails=new crm_prom_emails();
				$crm_prom_emailslist = $objcrm_prom_emails->readArray($arr_filter_his,$result_found_his,1);
				unset($objcrm_prom_emails);
				
				$_response['success']= 1;
				$_response['message']='Loyalty points history fetched successfully';
				$_response['claim_history']= $crm_prom_emailslist;	
				$_response['points_history']= $biz_checkinslist;
			}else{
				$_response['message']='You must be admin/manager to view this apge';
			}			
		}else{
			$_response['message']='You must provide auth login to view this page';
		}
								 
	}elseif($tag=="filter_point_history"){
		
    	$auth_id				= get_input('auth_id',0);
    	$result_found=0;
    	$result_found=0;
		$arr_filter = array(SES_RESTAURANT=>$_SESSION[SES_RESTAURANT],SORT_BY=>'DESC',SORT_ON=>'chkin_id');
		
		$arr_filter_his=array(FLG_SEND=>1,'prm_restaurent'=>$_SESSION[SES_RESTAURANT],SORT_BY=>'DESC',SORT_ON=>'crm_pr_ml_id');	
		$search_from_dt= get_input("search_from_dt",'');
		$search_to_dt= get_input("search_to_dt",'');
		if(is_not_empty($search_from_dt) && is_not_empty($search_to_dt)){
			$arr_filter_his['search_from_dt']=$search_from_dt;
			$arr_filter_his['search_to_dt']=$search_to_dt;
			
			$arr_filter['search_from_dt']=$search_from_dt;
			$arr_filter['search_to_dt']=$search_to_dt;
		}

		if(is_gt_zero_num($auth_id)){
			$usr_det=get_user($auth_id);//$_response['usr_det']= $usr_det;
			if($usr_det['member_role_id']!=ROLE_CUSTOMER){
				$objbiz_checkins=new biz_checkins();
				$biz_checkinslist = $objbiz_checkins->_get_award_redeem_history($arr_filter,$result_found,1);
				unset($objbiz_checkins);
								
				$objcrm_prom_emails=new crm_prom_emails();
				$crm_prom_emailslist = $objcrm_prom_emails->readArray($arr_filter_his,$result_found_his,1);
				unset($objcrm_prom_emails);
				
				$_response['success']= 1;
				$_response['message']='Loyalty points history fetched successfully';
				$_response['claim_history']= $crm_prom_emailslist;	
				$_response['points_history']= $biz_checkinslist;
			}else{
				$_response['message']='You must be admin/manager to view this apge';
			}			
		}else{
			$_response['message']='You must provide auth login to view this page';
		}
								 
	}elseif($tag=="soft_delete_member"){
		
    	$lst_sel_ids	= get_input('lst_sel_ids','');
    	$auth_id	= get_input('auth_id',0);

    	if(is_gt_zero_num($auth_id)){
			$usr_det=get_user($auth_id);//$_response['usr_det']= $usr_det;
			if($usr_det['member_role_id']!=ROLE_CUSTOMER){
				if(is_not_empty($lst_sel_ids)){					
					$objtbl_staff=new tbl_staff();
					$isSuccess = $objtbl_staff->ban_user($lst_sel_ids);
					unset($objtbl_staff);
					$_response['success']= 1;
					$_response['message']='Loyalty members deleted successfully';						
				}else{
					$_response['message']='Please select member before delete';
				}		
			}else{
				$_response['message']='You must be admin/manager to view this apge';
			}			
		}else{
			$_response['message']='You must provide auth login to view this page';
		}	
			
	}elseif($tag=="get_loyalty_member_list"){
		
    	$auth_id				= get_input('auth_id',0);
    	$result_found=0;
		$arr_filter=array();
    	$arr_filter['exclude_banned']=1;
		$arr_filter[STAFF_RESTAURENT]=$_SESSION[SES_RESTAURANT];		
		$arr_filter['is_reward']=1;		
		$arr_filter[SORT_BY]='DESC';
		$arr_filter[SORT_ON]='crm_id';
		if(is_gt_zero_num($auth_id)){
			$usr_det=get_user($auth_id);//$_response['usr_det']= $usr_det;
			if($usr_det['member_role_id']!=ROLE_CUSTOMER){
				$tbl_stafflist = tbl_staff::getRewardUserPointsDetails($arr_filter,$result_found,1);
				$_response['success']= 1;
				$_response['message']='Loyalty member list fetched successfully';	
				$_response['member_list']= $tbl_stafflist;			
			}else{
				$_response['message']='You must be admin/manager to view this apge';
			}			
		}else{
			$_response['message']='You must provide auth login to view this page';
		}
								 
	}elseif($tag=="filter_loyalty_member"){
    	$auth_id				= get_input('auth_id',0);
    	$result_found=0;
		$arr_filter=array();
    	$arr_filter['exclude_banned']=1;
		$arr_filter[STAFF_RESTAURENT]=$_SESSION[SES_RESTAURANT];		
		$arr_filter['is_reward']=1;		
		$arr_filter[SORT_BY]='DESC';
		$arr_filter[SORT_ON]='crm_id';
		$search_fname= get_input("search_fname",'');
		$search_lname= get_input("search_lname",'');
		$search_email= get_input("search_email",'');
		$search_phone= get_input("search_phone",'');
		$search_total_points= get_input("search_total_points",'');
		$search_redeemed_points= get_input("search_redeemed_points",'');
		$search_balance_points= get_input("search_balance_points",'');
		$search_last_visit= get_input("search_last_visit",0);
		
		if(is_gt_zero_num($auth_id)){
			$usr_det=get_user($auth_id);//$_response['usr_det']= $usr_det;
			if($usr_det['member_role_id']!=ROLE_CUSTOMER){
				//..filter criteria
			if(is_not_empty($search_total_points)){
					$arr_filter['search_total_points']=$search_total_points;
					$arr_filter['search_total_points']=$search_total_points;
					$filt_text[]=$_lang['biz_rewards']['total_points'].">={$search_total_points}";
			}			
			if(is_not_empty($search_redeemed_points)){
					$arr_filter['search_redeemed_points']=$search_redeemed_points;
					$arr_filter['search_redeemed_points']=$search_redeemed_points;
					$filt_text[]=$_lang['biz_rewards']['redeemed_points'].">={$search_redeemed_points}";
			}
			if(is_not_empty($search_balance_points)){
					$arr_filter['search_balance_points']=$search_balance_points;
					$arr_filter['search_balance_points']=$search_balance_points;
					$filt_text[]=$_lang['biz_rewards']['balance_points'].">={$search_balance_points}";
			}			
			if(is_not_empty($search_fname)){
					$arr_filter['search_fname']=$search_fname;
					$arr_filter['search_fname']=$search_fname;
					$filt_text[]=$_lang['tbl_staff']['label']['staff_fname']." Like {$search_fname}";
			}			
			if(is_not_empty($search_lname)){
					$arr_filter['search_lname']=$search_lname;
					$arr_filter['search_lname']=$search_lname;
					$filt_text[]=$_lang['tbl_staff']['label']['staff_lname']." Like {$search_lname}";
			}			
			if(is_not_empty($search_email)){
					$arr_filter['search_email']=$search_email;
					$arr_filter['search_email']=$search_email;
					$filt_text[]=$_lang['tbl_staff']['label']['search_email']." Like {$search_email}";
			}			
			if(is_not_empty($search_phone)){
					$arr_filter['search_phone']=$search_phone;
					$arr_filter['search_phone']=$search_phone;
					$filt_text[]=$_lang['tbl_staff']['label']['staff_phone']." Like {$search_phone}";
			}			
			if(is_gt_zero_num($search_last_visit)){
					$arr_filter['search_last_visit']=$search_last_visit;
					$arr_filter['search_last_visit']=$search_last_visit;
					$filt_text[]=$_lang['biz_rewards']['last_visit']." >= {$search_last_visit}";
			}	
				
				
				$tbl_stafflist = tbl_staff::getRewardUserPointsDetails($arr_filter,$result_found,1);
				$_response['success']= 1;
				$_response['message']='Loyalty member list filtered successfully';	
				$_response['member_list']= $tbl_stafflist;			
			}else{
				$_response['message']='You must be admin/manager to view this apge';
			}			
		}else{
			$_response['message']='You must provide auth login to view this page';
		}	
							 
	}elseif($tag=="send_prom_bysms"){
		
			$_is_all_selected		= get_input('_is_all_selected','');
			$pst_menu_id			= get_input('pst_menu_id',0);
			$prom_id				= get_input('prom_id',0);
			$sms_msg				= get_input('sms_msg','');
			$sms_text_msg			= get_input('sms_text_msg','');
			$tab_sms_email			= get_input('tab_sms_email','email');
			$sel_tbl_staff			= get_input('sel_tbl_staff');			
			$lst_sel_ids			= explode(',', $sel_tbl_staff);
			
			if(is_not_empty($sms_msg)){
				$sms_msg=nl2br($sms_msg,false);
			}
			$arr_filter['exclude_banned']=1;
			$arr_filter[STAFF_RESTAURENT]=$_SESSION[SES_RESTAURANT];
			$arr_filter['is_reward']=1;			
			$arr_filter[SORT_BY]='DESC';
			$arr_filter[SORT_ON]='crm_id';
			$result_found=0;
				
			if(is_not_empty($sms_text_msg) && (is_not_empty($_is_all_selected) || is_not_empty($lst_sel_ids))){
				$obj_prom=new pds_list_promotions();
				$obj_crm_prom_emails=new crm_prom_emails();
				if(is_not_empty($_is_all_selected)){
					$tbl_stafflist = tbl_staff::getRewardUserPointsDetails($arr_filter,$result_found,1);
					$_arr_to_use=$tbl_stafflist;
				}elseif( is_not_empty($lst_sel_ids)){
					$_arr_to_use=$lst_sel_ids;
				}				
				//..Loop through each email 
				foreach($_arr_to_use as $_crm_id){
					//..capture the emails of the selected conatcts
					//..$subscriber_emails=get_crm_email_from_id($_crm_id);
					if(is_not_empty($_is_all_selected)){
						$_crm_id=$_crm_id['staff_id'];
					}
					//..capture the phone numbers of the selected conatcts
					//$phone_nos=get_crm_email_from_id($_crm_id,'phone');
					$_staff_rec=tbl_staff::GetInfo(0,$_crm_id);
				    $phone_nos=$_staff_rec[STAFF_PHONE];
					//..get actual crm
					$_act_crm_id=tbl_crm::get_crm_id_from_email($_staff_rec['staff_email']);

					if(is_not_empty($phone_nos)){
						 //..Now email the promotion to the above emails							
		 				 //$tmp_rslt=$obj_prom->sms_promtoion($prom_id,array($phone_nos),$_act_crm_id,$sms_text_msg);
						 //echo "{$_crm_id}-{$phone_nos}<br>";
						 if(is_gt_zero_num($_act_crm_id)){
							//..add record to the crm notify				
						  $_act_crm_id=$obj_crm_prom_emails->create($_act_crm_id, $prom_id,0, '', '');
						 }
						 if(is_gt_zero_num($prom_id)){
							 //..now email the promotion to the above emails	
							 //var_dump(array('prom_id' => $prom_id,'phones' =>$phone_nos,'_act_crm_id' =>$_act_crm_id,'sms_text_msg' =>$sms_text_msg));													
			 				 $tmp_rslt=$obj_prom->sms_promtoion($prom_id,array($phone_nos),$_act_crm_id,$sms_text_msg);		 
						 }else{
						 	 $isSuccess=@send_sms_using_twilio(array($phone_nos),$sms_text_msg);	
						 }							 
						 //$isSuccess=1;							 
						 $_response['success']= 1;
						 $_response['message']='Promotion smsed successfully';							 
					}else{							
						$_response['message']= $_lang["tbl_staff"]['SEND_SMS']["NO_PHONES"];
					}		
				}
				unset($obj_prom);
				unset($obj_crm_prom_emails);
				unset($_SESSION['_sel_crm_id_fr_email']);
				$_is_all_selected='';
			}
					
	}elseif($tag=="send_menu_bysms"){
			$_is_all_selected=get_input('_is_all_selected','');
			$pst_menu_id						= get_input('pst_menu_id',0);
			$menu_id						= get_input('menu_id');
			$sms_msg_mnu						= get_input('sms_msg_mnu','');
			$sms_text_msg_mnu				= get_input('sms_text_msg_mnu','');
			
			$sel_tbl_staff= get_input('sel_tbl_staff');
			$lst_sel_ids=explode(',', $sel_tbl_staff);
			
			$arr_filter['exclude_banned']=1;
			$arr_filter[STAFF_RESTAURENT]=$_SESSION[SES_RESTAURANT];
			$arr_filter['is_reward']=1;			
			$arr_filter[SORT_BY]='DESC';
			$arr_filter[SORT_ON]='crm_id';
			$result_found=0;
		
			if(is_not_empty($sms_msg_mnu)){
				$sms_msg_mnu=nl2br($sms_msg_mnu,false);
			}
			
			if((is_not_empty($menu_id)) && is_not_empty($sms_text_msg_mnu) && (is_not_empty($_is_all_selected) || is_not_empty($lst_sel_ids))){				
				if(is_not_empty($_is_all_selected)){
					$tbl_stafflist = tbl_staff::getRewardUserPointsDetails($arr_filter,$result_found,1);
					$_arr_to_use=$tbl_stafflist;
				}elseif( is_not_empty($lst_sel_ids)){
					$_arr_to_use=$lst_sel_ids;
				}
				
				//..Loop through each email 
				foreach($_arr_to_use as $_crm_id){
					//..capture the emails of the selected conatcts
					//..$subscriber_emails=get_crm_email_from_id($_crm_id);
					if(is_not_empty($_is_all_selected)){
						$_crm_id=$_crm_id['staff_id'];
					}
					//..capture the phone numbers of the selected conatcts
					//$phone_nos=get_crm_email_from_id($_crm_id,'phone');
					$_staff_rec=tbl_staff::GetInfo(0,$_crm_id);
				    $phone_nos=$_staff_rec[STAFF_PHONE];

					if(is_not_empty($phone_nos)){
						sms_menu_item($menu_id,array($phone_nos),0,$sms_text_msg_mnu);							 
						$_response['success']= 1;
						$_response['message']='Menu smsed successfully';			 
					}	
				}					
				unset($_SESSION['_sel_crm_id_fr_email']);
				$_is_all_selected='';
			}	
				
	}elseif($tag=="send_prom_byemail"){
					
			$_is_all_selected=get_input('_is_all_selected','');
			$pst_menu_id			= get_input('pst_menu_id',0);
			$prom_id				= get_input('prom_id',0);
			$sms_msg				= get_input('sms_msg','');
			$sms_text_msg			= get_input('sms_text_msg','');
			$tab_sms_email			= get_input('tab_sms_email','email');
			$sel_tbl_staff= get_input('sel_tbl_staff');
			$lst_sel_ids=explode(',', $sel_tbl_staff);
			
			if(is_not_empty($sms_msg)){
				$sms_msg=nl2br($sms_msg,false);
			}
			$arr_filter['exclude_banned']=1;
			$arr_filter[STAFF_RESTAURENT]=$_SESSION[SES_RESTAURANT];
			$arr_filter['is_reward']=1;			
			$arr_filter[SORT_BY]='DESC';
			$arr_filter[SORT_ON]='crm_id';
			$result_found=0;
			
			if((is_not_empty($_is_all_selected) || is_not_empty($lst_sel_ids)) && is_not_empty($sms_msg)){

					$obj_prom=new pds_list_promotions();
					$obj_crm_prom_emails=new crm_prom_emails();
					if( is_not_empty($_is_all_selected)){
						$tbl_stafflist = tbl_staff::getRewardUserPointsDetails($arr_filter,$result_found,1);
						$_arr_to_use=$tbl_stafflist;
					}elseif( is_not_empty($lst_sel_ids)){
						$_arr_to_use=$lst_sel_ids;
					}
					//..Loop through each email 
					foreach($_arr_to_use as $_crm_id){
						//..capture the emails of the selected conatcts
						//..$subscriber_emails=get_crm_email_from_id($_crm_id);
						if(is_not_empty($_is_all_selected)){
							$_crm_id=$_crm_id['staff_id'];
						}
						$_staff_rec=tbl_staff::GetInfo(0,$_crm_id);
					    $subscriber_emails=$_staff_rec['staff_email'];
						//..get actual crm
						$_act_crm_id=tbl_crm::get_crm_id_from_email($subscriber_emails);
						  
						if((is_not_empty($subscriber_emails)) && (_chk_if_usr_witout_email($subscriber_emails)==0)){
							//echo "{$_crm_id}-{$subscriber_emails}<br>";
  							//..Send::Email promotion		 
							try {
								 if(is_gt_zero_num($prom_id)){							 	 							 	 
									 if(is_gt_zero_num($_act_crm_id)){
									 		//..Add record to the crm notify				
							 	 	 		$_act_crm_id=$obj_crm_prom_emails->create($_act_crm_id, $prom_id,0, '', '');
									 }
									
									 //var_dump(array('prom_id' => $prom_id,'subscriber_emails' =>$subscriber_emails,'_act_crm_id' =>$_act_crm_id,'sms_msg' =>$sms_msg));								 
									 $isSuccess=$obj_prom->email_promtoion($prom_id,1,array($subscriber_emails),$_act_crm_id,'',$sms_msg);								   
								 }else{
								 		$isSuccess=send_mail_using_php('Message from '.$rest_info[RESTAURENT_NAME],$rest_info[RESTAURENT_EMAIL],$subscriber_emails,$sms_msg);
								 }							 	 
								 $_response['success']= 1;
								 $_response['message']='Promotion emailed successfully';							 
							}catch(Exception $e) {
							   //echo 'Caught exception: ', $e->getMessage(), "\n";
							}							
						}else{							
							$_response['message']=$_staff_rec['full_name'].' does not have email.';	
						}						
					}
					unset($obj_prom);
					unset($obj_crm_prom_emails);
					//unset($_SESSION['_sel_crm_id_fr_email']);		
					$_is_all_selected='';	
			}
					
	}elseif($tag=="send_menu_byemail"){
		
			$_is_all_selected=get_input('_is_all_selected','');
			$pst_menu_id						= get_input('pst_menu_id',0);
			$menu_id						= get_input('menu_id');
			$sms_msg_mnu						= get_input('sms_msg_mnu','');
			$sms_text_msg_mnu				= get_input('sms_text_msg_mnu','');
			
			$sel_tbl_staff= get_input('sel_tbl_staff');
			$lst_sel_ids=explode(',', $sel_tbl_staff);
			
			$arr_filter['exclude_banned']=1;
			$arr_filter[STAFF_RESTAURENT]=$_SESSION[SES_RESTAURANT];
			$arr_filter['is_reward']=1;			
			$arr_filter[SORT_BY]='DESC';
			$arr_filter[SORT_ON]='crm_id';
			$result_found=0;
		
			if(is_not_empty($sms_msg_mnu)){
				$sms_msg_mnu=nl2br($sms_msg_mnu,false);
			}
			
			if((is_not_empty($menu_id)) && is_not_empty($sms_text_msg_mnu) && (is_not_empty($_is_all_selected) || is_not_empty($lst_sel_ids))){				
				if(is_not_empty($_is_all_selected)){
					$tbl_stafflist = tbl_staff::getRewardUserPointsDetails($arr_filter,$result_found,1);
					$_arr_to_use=$tbl_stafflist;
				}elseif( is_not_empty($lst_sel_ids)){
					$_arr_to_use=$lst_sel_ids;
				}
				
				//..Loop through each email 
				foreach($_arr_to_use as $_crm_id){
					//..capture the emails of the selected conatcts
					//..$subscriber_emails=get_crm_email_from_id($_crm_id);
					if(is_not_empty($_is_all_selected)){
						$_crm_id=$_crm_id['staff_id'];
					}
					//..capture the phone numbers of the selected conatcts
					//$phone_nos=get_crm_email_from_id($_crm_id,'phone');
					$_staff_rec=tbl_staff::GetInfo(0,$_crm_id);
				    $phone_nos=$_staff_rec[STAFF_PHONE];

					if(is_not_empty($phone_nos)){
						sms_menu_item($menu_id,array($phone_nos),0,$sms_text_msg_mnu);						 
						$_response['success']= 1;
						$_response['message']='Menu emailed successfully';			 
					}	
				}					
				unset($_SESSION['_sel_crm_id_fr_email']);
				$_is_all_selected='';
			}	
				
	}elseif($tag=='get_loyalty_det'){
    	
    	$auth_id=get_input('auth_id',0);    	
    	if(is_gt_zero_num($auth_id)){
		$rewrad_user=get_user($auth_id);//$_USR_DET[SES_REWARD]=
		$_response[SES_REWARD]=$rewrad_user;
		//if(is_gt_zero_num($_SESSION[IS_RWD_AUTH])){
			//..Now chk_all_rewards applicable for this user
			$rewards_avail=members::chk_all_rewards($rewrad_user['id']);
			if(is_not_empty($rewards_avail)){
				$_response['rewards_avail']=$rewards_avail;										
			}	
			$overall_stat=biz_rewards::getRewardUserStats($rewrad_user['id']);
			$_response['overall_stat']=$overall_stat;	
			
			//..START Get all the redeem history of the customer
			$result_found=0;
			$sql=  'SELECT `p`.`title`,`c`.`rwd_points`,`c`.`redimed_date`
							FROM `pds_redim_cupons` as `c`
							INNER JOIN `'.BIZ_REWARDS.'` as `r` ON  
							`r`.`'.RWD_ID.'`=`c`.`rwd_deals_sel`
							INNER JOIN `pds_list_promotions` as `p` ON 
							`p`.`id` = `c`.`promotion_id`	
						  WHERE `c`.`rwd_usr_id`='.$rewrad_user['id'].' AND `r`.`'.RWD_BUSS_ID.'`='.$rewrad_user[STAFF_RESTAURENT];
			$redeem_hist=DB::ExecQry($sql);
			$_response['redeem_hist']=$redeem_hist;
			$_response['result_found']=count($redeem_hist);
			
			//..Get award history of teh customer..
			$biz_checkinslist = biz_checkins::readArray(array(CHKIN_BUSS_ID=>$rewrad_user[STAFF_RESTAURENT],CHKIN_USER_ID=>$rewrad_user['id']),$result_found,1);		
			$_response['biz_checkinslist']=$biz_checkinslist;	
			
			$_act_crm_id=tbl_crm::get_crm_id_from_email($rewrad_user['email']);	 
		$_email_coupons =DB::ExecQry("SELECT `e`.*,`p`.* FROM `".CRM_PROM_EMAILS."` `e` 
 INNER JOIN `".pds_list_promotions."` `p` ON `e`.`".CRM_PR_ML_PROMOTION."`=`p`.`id` WHERE  `e`.`".CRM_PR_ML_USERID."`={$_act_crm_id} AND `p`.`end_date` >='".date(DATE_FORMAT)."' AND `e`.`flg_send`=0  AND (`e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` is NULL OR `e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` = 0 OR `e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` > CURDATE( )) AND `p`.`prm_restaurent`=".$rewrad_user[STAFF_RESTAURENT]);	
 			$_response['_email_coupons']=$_email_coupons;	
 			$_response['success']=1;
			//}
		}else{
			$_response['message']='Please provide user id before proceed.';
		}
		
	}elseif($tag=='get_loyalty_det_new'){

		$phone=get_input('phone','');
		if(is_not_empty($phone)){
			$_res=get_user_for_all_rest($phone);
		}else{
			$_response['message']='Please provide phone number before proceed.';
		}	
    	if(is_not_empty($_res)){
    		foreach($_res as $_auth_id){
    			$_ech_rest_uid=array_shift($_auth_id);
				//$_response['rest_rewards'][$_auth_id]=serv_get_usr_id_reward_dash($_auth_id);
				$_response['rest_rewards'][]=serv_get_usr_id_reward_dash($_ech_rest_uid);
			}
    	}else{
			$_response['message']='Phone number is not registered in our system';
		}
    	//return $_response;   	
		
	}elseif ($tag == 'add_reward_pts'){
		
		$auth_id=get_input('auth_id',0); 
		$table_id=get_input('table_id',1);   	
		$chkin_id= get_input("chkin_id");
		$chkin_buss_id= get_input("chkin_buss_id");
		$chkin_rwd_id= get_input("chkin_rwd_id");
		$chkin_user_id= get_input("chkin_user_id");
		$chkin_session= get_input("chkin_session");
		$chkin_points= get_input("chkin_points",0);
		$chkin_amount= get_input("chkin_amount",0);
		$is_history= get_input("is_history",0);
		$chkin_edit_commnt= get_sql_input("chkin_edit_commnt",'');
		
		$chkin_invoice= get_sql_input("chkin_invoice",'');
		
		
    	if(is_gt_zero_num($auth_id)){
    		$_usr_dets=get_user($auth_id);
    		//==	START SERVER PIN VALIDATION
			//... START OPTION A] customer side option selected
			$cust_server_pin = get_input('cust_server_pin','');
			if(is_not_empty($cust_server_pin)){
				$rslt_fnd=validate_server_pin($cust_server_pin);
				if(is_gt_zero_num($rslt_fnd)){
					$server_validated = $rslt_fnd;
					$_response['server_validated'] = $server_validated;
					$_response['message']=  'Server pin validated successfully.';
					
					$objbiz_checkins= new biz_checkins();
					$isSuccess = $objbiz_checkins->create($_usr_dets[STAFF_RESTAURENT], 0, $auth_id,$table_id, $chkin_points, date(DATE_FORMAT),$server_validated,$chkin_amount,$chkin_edit_commnt,$chkin_invoice);
					if(is_gt_zero_num($isSuccess)){
						//..Send notification to the customer
						$_response['message'] = $_lang['biz_checkins']['CREATE']['SUCCESS_MSG'];
						$_response['success']=1;		
					}else{
						$_response['message'] = 'Problem in addding reward points';
					}
					unset($objbiz_checkins);
					
				}else{
					$_response['message']= $_lang['biz_checkins']['CREATE']['CD_DOES_NOT_MATCH'];
				}			
			}else{
				$_response['message']=  'Server pin is mandatory to proceed.';				
			}
		}else{
			$_response['message']='Please provide user id before proceed.';
		}
		
	}elseif ($tag == 'admin_add_reward_pts'){
		
		$auth_id=get_input('auth_id',0); 
		$admin_id=get_input('admin_id',0);
		$table_id=get_input('table_id',1);   	
		$chkin_id= get_input("chkin_id");
		$chkin_buss_id= get_input("chkin_buss_id");
		$chkin_rwd_id= get_input("chkin_rwd_id");
		$chkin_user_id= get_input("chkin_user_id");
		$chkin_session= get_input("chkin_session");
		$chkin_points= get_input("chkin_points",0);
		$chkin_amount= get_input("chkin_amount",0);
		$is_history= get_input("is_history",0);
		$chkin_edit_commnt= get_sql_input("chkin_edit_commnt",'');
		$chkin_invoice= get_sql_input("chkin_invoice",'');
		
    	if(is_gt_zero_num($auth_id) && is_not_empty($admin_id)){
    		$usr_det=get_user($admin_id);//$_response['usr_det']= $usr_det;
			if($usr_det['member_role_id']!=ROLE_CUSTOMER){
				$server_validated = 1;
				$objbiz_checkins= new biz_checkins();
				$isSuccess = $objbiz_checkins->create($usr_det[STAFF_RESTAURENT], 0, $auth_id,$table_id, $chkin_points, date(DATE_FORMAT),$server_validated,$chkin_amount,$chkin_edit_commnt,$chkin_invoice);
				if(is_gt_zero_num($isSuccess)){
					//..Send notification to the customer
					$_response['message'] = $_lang['biz_checkins']['CREATE']['SUCCESS_MSG'];
					$_response['success']=1;		
				}else{
					$_response['message'] = 'Problem in addding reward points';
				}
				unset($objbiz_checkins);	
			}else{
				$_response['message']='You must be admin/manager to view this apge';
			}
			
		}else{
			$_response['message']='Please provide member id  and the admin id before proceed.';
		}
		
	}elseif ($tag == 'redeem_prom') {
		$auth_id=get_input('auth_id',0); 
		$table_id=get_input('table_id',1);
		$promotion_id= get_input('promotion_id',0);
		$rwd_invoice = get_input('rwd_invoice','');
		$rwd_points = get_input('rwd_points',0);
		
		$rwd_id=get_input('rwd_id',0);
			
		if(is_gt_zero_num($auth_id) && is_gt_zero_num($table_id) && is_gt_zero_num($rwd_id) && is_gt_zero_num($promotion_id)){
			$_SESSION[SES_REWARD]=$rewrad_user=get_user($auth_id);
			$customer_name=$_SESSION[SES_REWARD]['email'];
    		//==	START SERVER PIN VALIDATION
			//... START OPTION A] customer side option selected
			$cust_server_pin = get_input('cust_server_pin','');
			if(is_not_empty($cust_server_pin)){
				$rslt_fnd=validate_server_pin($cust_server_pin);
				if(is_gt_zero_num($rslt_fnd)){
					$server_validated = $rslt_fnd;
					$_response['server_validated'] = $server_validated;
					$_response['message']=  'Server pin validated successfully.';
					
					$is_found=biz_rewards::chk_if_redeem_wthin_2_hrs($auth_id,$table_id);
					if(is_gt_zero_num($is_found)==false){	
					 								 				
						 $claim_result=customer_claim_promotion($promotion_id,$auth_id,$customer_name,$rwd_id,$auth_id,0,$server_validated,$rwd_points,$rwd_invoice);	
						 if($claim_result>0){							 
						 	$_response['message']= $_lang['biz_rewards']['info_msg']['claim_success'];
						 	$_response['success']=1;
						 }else{
					 		if($claim_result==-1){
								$_response['message']= 'You already redeemed it.';
							}else{
								$_response['message']= 'Problem during redeem promotion.';	
							}	 		
					 	 }
						 	 
					}else{
					 	$_response['message']=  $_lang['tbl_temp_reward_sess']['CREATE']['MAN_REDEEM_MSG'];
					}
					unset($objbiz_checkins);
					
				}else{
					$_response['message']= $_lang['biz_checkins']['CREATE']['CD_DOES_NOT_MATCH'];
				}			
			}else{
				$_response['message']=  'Server pin is mandatory to proceed.';				
			}
		}else{
			$_response['message']='Please provide user id, table id, reward id and promotion id before proceed.';
		}
		
	}elseif ($tag == 'login') {		
		// Request type is check Login
		$phone = get_input("email",'');
		$is_restaurant = get_input("is_restaurant",'');	
										
        $password = 'sample';
        $_response["input_email"]=$phone;
        $_response["table_id"]=$table_id;
        $_response["is_restaurant"]=$is_restaurant;
        // check for user
        //echo "(phone,password,table_id,isCustomerLogin,frm_chng_srv,is_restaurant)";
        //echo "$phone,$password,$table_id,$isCustomerLogin,$frm_chng_srv,$is_restaurant";
        $_SESSION[SES_RESTAURANT]=$is_restaurant;
        
        $_response = serv_LogMeIn($phone,$password,$table_id,$isCustomerLogin,$frm_chng_srv,$is_restaurant);
        //var_dump($_response);
        //exit;      
        
    }elseif($tag == 'register') {		
		// Request type is Register new user
		$fname = get_input("fname",'');	
		$lname = get_input("lname",'');
		$email = get_input("email",'');	
		if(is_not_empty($email)==FALSE){
			$email	= "exusr_"._get_lst_member_id()."@tst.com";
		}			
		$password = 'sample' ;//get_input("password",'');
		$phone = get_input("phone",'');	
		$table_id = get_input("table_id",1);
		$is_restaurant = get_input("is_restaurant",1);
		$is_reward=1;
		$reward_bal_visits=0;
		$reward_bal_points=0;
		$sms_subscribed=1;
		$_restaurant=1;
		$staff_facebook=NULL;
		$cust_aniversary_dt = get_sql_input('cust_aniversary_dt');
		//..Get date from the day and month	
		$cust_dob_day = get_sql_input('cust_dob_day');
		$cust_dob_mon = get_sql_input('cust_dob_mon');
		if(is_not_empty($cust_dob_day) && is_gt_zero_num($cust_dob_mon)){
			$cust_dob= '2016-'.strval(sprintf('%02d', $cust_dob_mon)).'-'.strval(sprintf('%02d', $cust_dob_day));
		}else{
			$cust_dob=NULL;
		}
		
		$_response=serv_registerME($email,$password,0,$fname,$lname,$phone,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed,$is_restaurant,0,$cust_dob,$cust_aniversary_dt);
		
		
    }elseif($tag == 'change_password'){
		  $email = get_input("email",'');
		  $newpassword = get_input("newpassword",'');	

		  //..Detect weather it is phone or EMAIL
			$emresult= filter_var($email, FILTER_SANITIZE_NUMBER_INT);	
			if(is_not_empty($emresult)){
				$fld_to_chk='phone';
			}else{
				$fld_to_chk='email';
			}

		  $hash = $db->hashSSHA($newpassword);
	      $encrypted_password = $hash["encrypted"]; // encrypted password
	      $salt = $hash["salt"];
		  $subject = "Change Password Notification";
          $message = "Hello User,\n\nYour Password is sucessfully changed.\n\nRegards,\nSimplifimed Team.";
          $from = "sangram@gmail.com";
          $headers = "From:" . $from;
		  if ($db->isUserExisted($email)) {
				$user = $db->forgotPassword($email, $encrypted_password, $salt);
				if ($user) {
			         $_response["success"] = 1;
			         if($fld_to_chk=='phone'){
					 	send_sms_using_twilio(array($email),$message);
					 }else{
					 	mail($email,$subject,$message,$headers);
					 }	
			         //mail($email,$subject,$message,$headers);
			         //echo json_encode($_response);
				}else {
					$_response["error"] = 1;
					//echo json_encode($_response);
				}
            // user is already existed - error response           
        }else {
            $_response["error"] = 2;
            $_response["error_msg"] = "User not exist";
            //echo json_encode($_response);
		}
	}elseif ($tag == 'forgot_password'){	
		// include db handler		   
	    $db = new DB_Functions();
		//$forgotpassword = $_POST['forgotpassword'];
		$forgotpassword = get_input("forgotpassword",'');
		//echo "forgotpassword=$forgotpassword";
		$msg='';
		$result=$db->forgotPassword($forgotpassword,$msg);
		if ($result==1) {
			$_response["success"] = 1;
			$_response["error_msg"] =$msg; 
		}elseif ($result==2) {
	        $_response["error"] = 2;
	        $_response["error_msg"] = "User not exist";
	        //echo json_encode($_response);
		}
	}else{
		$_response["error"] = 1;
        $_response["error_msg"] = "Invalid Request";
        //echo "Invalid Request";
    }
		
}else{
	$_response["error"] = 1;
    $_response["error_msg"] = "Access Denied";
    //echo "Access Denied";
}
if(IS_JSONP==1)				
	echo $_GET['callback'] . '(' . json_encode($_response). ')';
else
	echo json_encode($_response, JSON_PRETTY_PRINT);

?>