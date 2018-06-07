<?php
 include("../service_init.php");
  include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_list_promotions.class.php');
  include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/functions.php');
 include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_redim_cupons.class.php'); 

/*//..http base authentication
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
 $isCustomer=1;
 
if(is_not_empty($tag)){   

    // Response Array
    $_response = array("tag" => $tag, "success" => 0, "message" => '');
	$restaurant_id = get_input("restaurant_id",1);	  
	$_SESSION[SES_RESTAURANT]=$restaurant_id;	
	if(is_gt_zero_num($restaurant_id)){
		$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
		$_SESSION['curr_restant'] =$rest_info;
		unset($rest_info);
	}
    // Check for tag type
   if($tag=='prom_listing'){
   		$listing_type = get_input('listing_type','all'); 
   		$restaurant_id = get_input("is_restaurant",1);	  
		$_SESSION[SES_RESTAURANT]=$restaurant_id;	
		if(is_gt_zero_num($restaurant_id)){
			$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
			$_SESSION['curr_restant'] =$rest_info;
			unset($rest_info);
		}
		
   		if(is_gt_zero_num($restaurant_id)){
			$_tmp_rs=serv_get_all_prom($restaurant_id,$listing_type);
			if(mysql_num_rows($_tmp_rs['r_list']) > 0){
			   $list=getMeListFromRecords($_tmp_rs['r_list'],$_tmp_rs['ishistory'], $_tmp_rs['promotion_sql_filter'],$_tmp_rs['map_ids']);
	    	}    	
			$_response['prom_list']=$list;
	    	if(is_not_empty($list)){
	    		if(count($list)>0){
					$_response['message']='Promotion list fetch successful';
				}else{
					$_response['message']='No promotions found';
				}	
				$_response['success']= 1;
			}else{
				$_response['message']= 'No promotions found';
			}
		}else{
			$_response['success']	= 0;
			$_response['message']	= 'Please provide the restaurant before proceed.';
		}
		
   }elseif($tag=='search_prom'){
   	
   		$listing_type = get_input('listing_type','all'); 
   		$keyword = get_input('keyword','');
		
		if(is_gt_zero_num($restaurant_id)){
			$_tmp_rs=serv_get_all_prom($restaurant_id,$listing_type,$keyword,0);

			if(mysql_num_rows($_tmp_rs['r_list']) > 0){
			   $list=getMeListFromRecords($_tmp_rs['r_list'],$_tmp_rs['ishistory'], $_tmp_rs['promotion_sql_filter'],$_tmp_rs['map_ids']);
	    	}    	
			$_response['prom_list']=$list;
	    	if(is_not_empty($list)){
	    		if(count($list)>0){
					$_response['message']='Promotion list fetch successful';
				}else{
					$_response['message']='No promotions found';
				}	
				$_response['success']= 1;
			}else{
				$_response['message']= 'No promotions found';
			} 
		}else{
			$_response['success']	= 0;
			$_response['message']	= 'Please provide the restaurant before proceed.';
		}  		
		 		
   }elseif($tag == 'get_prom_det'){
   	
    	$prom_id=get_input('prom_id',0);
    	if(is_gt_zero_num($prom_id)){
			$promotionInfo 		  = get_promotion_info($prom_id);
			$_response['prom_det']= $promotionInfo;
			$_response['success'] = 1;
			$_response['message'] = 'Promotion detail fetched successfully';
		}else{
			$_response['message'] ='Please select promotion before proceed.';
		}		
	}elseif($tag == 'get_prom_cal_lnk') {
    	$prom_id=get_input('prom_id',0);
    	if(is_gt_zero_num($prom_id)){
			$promotionInfo 		  	  = get_promotion_info($prom_id);			
			$_response['get_prom_cal']['google_cal']=(is_not_empty($promotionInfo['google_cal']) ? $promotionInfo['google_cal'] : '--');
			$_response['get_prom_cal']['yahoo_cal']= (is_not_empty($promotionInfo['yahoo_cal']) ? $promotionInfo['yahoo_cal'] : '--');
			$_response['get_prom_cal']['window_live_cal']= (is_not_empty($promotionInfo['window_live_cal']) ? $promotionInfo['window_live_cal'] : '--');
			$_response['success'] 	  = 1;
			$_response['message'] 	  = 'Promotion calendar links fetched successfully';
		}else{
			$_response['message'] ='Please select promotion before proceed.';
		}	
	
	}elseif($tag == 'get_fb_share') {
    	$prom_id=get_input('prom_id',0);
    	if(is_gt_zero_num($prom_id)){
			$promotionInfo 		  = get_promotion_info($prom_id);
			//$_serv=WWWROOT;
			//$_serv="http://restaulogy.com/restaurant_in/";	
			  $_serv=ALL_REST_APP_PATH;
			//$prom_lnk 	= urlencode($_serv."modules/business_listing/show.php?show_type=PR&lid=".$promotionInfo['list_id']."&promoid=".$promotionInfo['id']);			
			$prom_lnk= urlencode(ALL_REST_APP_PATH .'index.html#promotionDetails?restaurent_id='.$promotionInfo['prm_restaurent'].'&promotion_id='.$promotionInfo['id']);			
			//echo ALL_REST_APP_PATH .'promotionDetails?promotion_id='.$promotionInfo['id'];
			//echo $prom_lnk;	
			//exit;
			//$prom_lnk= ALL_REST_APP_PATH .'promotionDetails?promotion_id='.$promotionInfo['id'];
			$prom_title = urlencode($promotionInfo['title']);
			$prom_desc 	= urlencode($promotionInfo['stripped_comments']);			
			if(($promotionInfo['img_ext']=='')||($promotionInfo['img_ext'] == '0')){
				$img_lnk = urlencode($promotionInfo['restaurant_logo']);
			}else{
				$img_lnk = urlencode(WWWROOT."modules/business_listing/promotion_images/".$prom_id.".".$promotionInfo['img_ext']); 
			}			
			//$img_lnk="http://restaulogy.com/restaurant_in/modules/business_listing/show.php?show_type=PR&lid=1&promoid=77";
			//$redirect_lnk="http://restaulogy.com/restaurant_in/modules/business_listing/promotionslisting.php?show_type=PR";
			//$redirect_uri= "http://restaulogy.com/restaurant_in/";
			//.. appid..689014577831141..165251524053779			
			$_response['fb_share_lnk']="https://www.facebook.com/dialog/feed?app_id=689014577831141&link={$prom_lnk}&picture={$img_lnk}&name={$prom_title}&description={$prom_desc}&redirect_uri=".urlencode($_serv);
			
			/*$_response['fb_share_lnk']="https://www.facebook.com/dialog/share_open_graph?action_type=og.shares&action_properties={'object':{'og:url':'".$prom_lnk."','og:title':'".$prom_title."','og:description':'".$prom_desc."','og:image':'".$img_lnk."'}}&app_id=689014577831141&display=popup&redirect_uri=".urlencode($_serv);*/	
			
					
			$_response['success'] = 1;
			$_response['message'] = 'Promotion share link fetched successfully';
		}else{
			$_response['message'] ='Please select promotion before proceed.';
		}		
	}elseif ($tag == 'email_friend') {	
    	$prom_id=get_input('prom_id',0);
		$email_from=get_input('email_from','');
		$email_to=get_input('email_to','');		
		
	 	if(is_gt_zero_num($prom_id)){	 		
			 //..START EMAIL PROMOTION
			 $obj_prom=new pds_list_promotions();
			 $refer_by=$email_from;			
			 $crm_pm_id=0;
			 $exp_emails=explode(',',$email_to);			 
			 //..Send::Email promotion		 
			 try {
			   $obj_prom=new pds_list_promotions();
			   $tmp_rslt=$obj_prom->email_promtoion($prom_id,1,$exp_emails,$crm_pm_id,$refer_by);
			   $_response['success']= 1;
			   $_response['message']='Promotion emailed successfully to your friends';
			   unset($obj_prom);
			 }catch(Exception $e) {
			   //echo 'Caught exception: ',  $e->getMessage(), "\n";
			   $_response['message']='Error in sending email';
			 }	
		}else{
			$_response['message']='Please select promotion before sending email.';
		}
        
    }elseif ($tag == 'upsert_reminder') {		
		//$save_remind = get_input("save_remind",0);
		$chk_remind = get_input("chk_remind",'');
		$promoid = get_input("promoid",0);
		$prem_user= get_input("prem_user",'');
		$prem_before= get_input("prem_before",0);
		$prem_after= get_input("prem_after",0);
		$prem_spc_date= get_input("prem_spc_date",NULL);
		$prem_act_send_dt= get_input("prem_act_send_dt",NULL);
		$prem_is_send= get_input("prem_is_send",0);
		$prem_start_date= get_input("prem_start_date",NULL);
		$prem_end_date= get_input("prem_end_date",NULL);	
		$prem_phone= get_input("prem_phone",'');

		if(is_not_empty($chk_remind) && is_not_empty($prem_user)){	
			$objtbl_prom_reminder=new tbl_prom_reminder();
			//..calculate the 'prem_act_send_dt'
			if((in_array('BEFORE',$chk_remind)) && (is_gt_zero_num($prem_before))){
				$prem_act_send_dt=date(DATE_FORMAT,strtotime("-{$prem_before} day",strtotime($showing_promotion['end_date'])));
				$prem_spc_date=NULL;
			}
			if((in_array('AFTER',$chk_remind))  && (is_gt_zero_num($prem_after))){
				$prem_act_send_dt=date(DATE_FORMAT,strtotime("+{$prem_after} day"));
				$prem_spc_date=NULL;
			}	
			if((in_array('ON_DATE',$chk_remind))  && (is_not_empty($prem_spc_date))){
				$prem_act_send_dt=date(DATE_FORMAT,strtotime($prem_spc_date));
			}
			//..Check weather it is insert or edit
			$_ass_remind=array();
			$_ass_remind= tbl_prom_reminder::readArray(array(PREM_PROMOTION=>$promoid,PREM_USER=>$prem_user));
			if(is_not_empty($_ass_remind)){
				$_ass_remind=array_shift($_ass_remind);
			}
			if(is_not_empty($_ass_remind)){
				//..Update
				$isSuccess = $objtbl_prom_reminder->update($_ass_remind[PREM_ID], $promoid, $prem_user, $prem_before, $prem_after, $prem_spc_date, $prem_act_send_dt, $prem_is_send, $prem_start_date, $prem_end_date,$prem_phone);
				$action='UPDATE';
			}else{
				//..Insert
				$isSuccess = $objtbl_prom_reminder->create($promoid, $prem_user, $prem_before, $prem_after, $prem_spc_date, $prem_act_send_dt, $prem_is_send, $prem_start_date, $prem_end_date,$prem_phone);		
				$action='CREATE';
			}
			if(is_not_empty($isSuccess)){
				if(is_gt_zero_num($isSuccess)){	
					$_response['success'] = 1;		
					$_response['message'] = $_lang['tbl_prom_reminder'][$action]['SUCCESS_MSG'];
				}elseif($isSuccess == OPERATION_FAIL){
					$_response['success'] = 0;		
					$_response['message'] = $_lang['tbl_prom_reminder'][$action]['FAILURE_MSG'];
				}elseif($isSuccess == OPERATION_DUPLICATE){
					$_response['success'] = -1;		
					$_response['message'] = $_lang['tbl_prom_reminder'][$action]['DUPLICATE_MSG'];
				}
			}//..if				
			unset($objtbl_prom_reminder);	
		 }else{
		 	$_response['success'] = 2;		
			$_response['message'] = 'Please provide email for reminder';
		 }   
		      
    }elseif($tag == 'get_reminder') {
    	    	
    	$promoid = get_input("promoid",0);
    	$prem_user= get_input("prem_user",'');    			
		$tbl_prom_reminderinfo= tbl_prom_reminder::readArray(array(PREM_PROMOTION=>$promoid,PREM_USER=>$prem_user));
		if(is_not_empty($tbl_prom_reminderinfo)){
			$tbl_prom_reminderinfo=array_shift($tbl_prom_reminderinfo);
			$_response['success']= 1;
			$_response['remind_info']	= $tbl_prom_reminderinfo;
			$_response['message']		= 'Reminder info fetched successfully';
		}else{
			$tbl_prom_reminderinfo=array();
			$_response['remind_info']	= array();
			$_response['message']		= 'No reminder found';
		}
		unset($tbl_prom_reminderinfo);
			
	}elseif($tag == 'friend_click_refer'){
		
		$promoid=get_input('promoid','');
		if(is_not_empty($promoid)){
		  	$prom_details=_get_prom_specifics($promoid);
		  	$_SESSION[SES_RESTAURANT]=$is_restaurant=$prom_details['prm_restaurent'];
		}
	    $phone=get_input('phone','');
	    $ref_by=get_input('ref_by',0);
	    $server_pin=get_input('server_pin','');  
	    $_is_already_claimed=0;
	    $fname = get_input("fname",'Guest');	
		$lname = get_input("lname",'User');
	  
		$email	= "exusr_"._get_lst_member_id()."@tst.com";			
		$password = 'sample' ;
		if((is_gt_zero_num($promoid)) && (is_not_empty($phone)) && is_not_empty($server_pin) && (is_gt_zero_num($ref_by))){
		  	if($prom_details['isExpired']){
		  		$_response['message']= "Promotion is expired.";
		  	}else{
		  		//..Upsert user
		  		//$user_details=upsert_usr_by_phone($phone);
		  		$_lg_rs = serv_LogMeIn($phone,$password,1,0,0,$is_restaurant);
	  			if($_lg_rs['success']==4){
					//..Not registered with us so go ahead and add it..		
					$_reg_rs=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$is_restaurant,0,NULL,'');
					$user_details=$_reg_rs['user'];
				}else{
					$user_details=$_lg_rs['user'];
				}
		  		//print_r($user_details);
		  		$friend_id=$user_details['id'];
		  		//..Check in the db if record present else add
		  		$objtbl_refer_friends= new tbl_refer_friends();
		  		if ($objtbl_refer_friends->isAlreadyThere($ref_by ,$friend_id ,$promoid ,'' ,'')){ 			
					$_response['message']= "Promotion already used.";
			   }else{	
					//..validate server pin			
					$rslt_fnd=validate_server_pin($server_pin);
					if(is_not_empty($rslt_fnd)){
						$_refer_frnd_id = $objtbl_refer_friends->create($ref_by, $friend_id, $promoid, '', '');
						//..Deactivate the refer friend list record.
					  	if(is_gt_zero_num($_refer_frnd_id)){
							$isSuccess = $objtbl_refer_friends->deactivate($_refer_frnd_id);
						}
						//..First get the reward id from the promotion
						$sql="SELECT `rwd_id` FROM `biz_rewards` WHERE `rwd_coupon_id`={$promoid}";
						$_reward=DB::ExecQry($sql,1);
						$claim_result=customer_claim_promotion($promoid,$friend_id,$phone,$_reward['rwd_id'],$friend_id,0,0);					
						if($claim_result>0){					 
						 	$_response['message']= "Promotion claimed successfully.";
						} 
						//...Add reward points to sender loyalty program 
						$objbiz_checkins=new biz_checkins(); 
						$isSuccess = $objbiz_checkins->create($prom_details['prm_restaurent'], 0, $ref_by,0, $prom_details['prm_refer_frd_points'], date(DATE_FORMAT),0,$prom_details['prm_refer_frd_points'],"");
						unset($objbiz_checkins);
						$_response['success']= 1;
						$_response['user']=$user_details;		
						
					}else{
						$_response['message']= "Server Pin does not match.";
					}	
				}  		
		  		unset($objtbl_refer_friends);			   				
			}
		 }else{
		 	$_response['message']  ="Please provide phone, promotion, refer and server pin before proceed";
		 }		
			
	}elseif($tag == 'sign_to_all_rests'){
		
  		$phone=get_input('phone','');
  		$is_restaurant = get_input("is_restaurant",1);			
		$fname = get_input("fname",'Guest');	
		$lname = get_input("lname",'User');
		$email = get_input("email",'');	
		if(is_not_empty($email)==FALSE){
			$email	= "exusr_"._get_lst_member_id()."@tst.com";
		}			
		$password = 'sample' ;				
  		if(is_not_empty($phone)){
  			$usrDetails=_all_rest_register($phone,$password,$fname,$lname,$is_restaurant);
  			$_response['user']= $usrDetails;
  			$_response['message']="User signed up to all restaurants";
	  	}else{
			$_response['message']  ="Please provide phone before proceed.";
		} 	
	
	}elseif($tag == 'new_refer_friend'){
				
		$promoid=get_input('promoid','');
  		$phone=get_input('phone','');
  		$is_restaurant = get_input("is_restaurant",1);	  
		//$_SESSION[SES_RESTAURANT]=$is_restaurant;
		//..for registration
		/*$is_refer = get_input("is_refer",0);
		$is_reward = get_input("is_reward",0);*/
		$action_to_take = get_input("action_to_take",'promotion');
		//{'promotion','refer_friend','reward'}
		
		$fname = get_input("fname",'Guest');	
		$lname = get_input("lname",'User');
		$email = get_input("email",'');	
		if(is_not_empty($email)==FALSE){
			$email	= "exusr_"._get_lst_member_id()."@tst.com";
		}			
		$password = 'sample' ;
				
  		if(is_not_empty($phone) && (is_not_empty($promoid) || ($action_to_take=='reward'))){
  			$usrDetails=_sign_to_spec_rest($phone,$password,$fname,$lname,$is_restaurant);
  			//..first check if user is registered with our system  			
  			/*$_lg_rs = serv_LogMeIn($phone,$password,1,0,0,$is_restaurant);
  			if($_lg_rs['success']==4){
  				//..get all active restaurants
  				$objtbl_restaurent= new tbl_restaurent();
  				$tbl_restaurentlist = $objtbl_restaurent->readArray(array('isActive'=>1),$result_found,1);
  				
  				foreach($tbl_restaurentlist as $_ech_restrnt){
  					//..loop through all resaturant
					if(is_not_empty($_ech_restrnt)){	
						$_SESSION[SES_RESTAURANT]=$_ech_restrnt[RESTAURENT_ID];							$email	= "exusr_"._get_lst_member_id()."@tst.com";
						
						$_resp_reg=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$_ech_restrnt[RESTAURENT_ID],0,NULL,'');
						if(($_ech_restrnt[RESTAURENT_ID]==$is_restaurant) && (is_not_empty($_resp_reg))){
							$_reg_rs=$_resp_reg;
						}
					}
				}
				unset($objtbl_restaurent);
				$usrDetails=$_reg_rs['user'];
				$_SESSION[SES_RESTAURANT]=$is_restaurant;
				$my_prom_link_new_st= biz_get_tiny_url(urlencode(ALL_REST_APP_PATH .'index.html#MyRewardPage'));
				$_msg=" Congrats, you are member of Restaulogy. Check Free signup offer {$my_prom_link_new_st}";
				echo $_msg;
				//$_succ=@send_sms_using_twilio(array($phone),$_msg);
				
				//..Not registered with us so go ahead and add it..		
				//$_reg_rs=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$is_restaurant,0,NULL,'');
				//..Also register that user to "Restaulogy Restaurant" 
				//..get restaurant details..
				
				//$rest_info_dtls = tbl_restaurent::GetInfo($is_restaurant);
				//$fname=get_elipsis($rest_info_dtls[RESTAURENT_NAME],20,'.');
				//$lname='RestApp';		
				//$_reg_rs_2=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,16,0,NULL,'');
			}else{
				$usrDetails=$_lg_rs['user'];
			}	  		
	  		*/
	  		
	  		if($action_to_take=='refer_friend'){
				//$prom_link=biz_get_tiny_url($website."/user/usr_refer_friend.php?promoid=".$promoid."&ref_by=".$usrDetails['id']);
				$prom_link= biz_get_tiny_url(urlencode(ALL_REST_APP_PATH .'index.html#referFriendLink?promotion_id='.$promoid.'&user_id='.$usrDetails['id']));
				$sms_text_msg="Refer a friend promotion {$prom_link}";
				$_response['success']= 1;				
	  			$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);
	  			$_response['message']="Promotion texted successfully";
			}elseif(is_not_empty($promoid)){			
				//$prom_link=biz_get_tiny_url($website."/user/usr_refer_friend.php?promoid=".$promoid);
				$prom_details=_get_prom_specifics($promoid); 
				if(is_not_empty($prom_details)){
/*					$prom_link=biz_get_tiny_url($website."/modules/business_listing/show.php?show_type=PR&lid=".$prom_details['list_id']."&promoid=".$promoid);	
					$sms_text_msg="Check promotion {$prom_link}";
	  				$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);*/	
	  				$_response['success']= 1;
	  				$_response['message']="user login/signed up successfully";
				}else{					
	  				$_response['message']="Promotion not found or expired"; 
				}				 
			}	  			  		
	  		//$prom_link=biz_get_tiny_url($website."/modules/business_listing/show.php?show_type=PR&lid=".$prom_details['list_id']."&promoid=".$promoid."&ref_by=".$user_details['id']);	  		 		
	  		//echo "CREAT- $sms_text_msg";
	  		
	  		//$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);
	  		//$_response['success']= 1;
	  		$_response['user']= $usrDetails;
	  	}else{
			$_response['message']  ="Please provide phone and promotion before proceed";
		} 
		 			
    }elseif($tag == 'refer_friend'){
				
		$promoid=get_input('promoid','');
  		$phone=get_input('phone','');	
  		$is_restaurant = get_input("is_restaurant",1);	  
		$_SESSION[SES_RESTAURANT]=$is_restaurant;
				
  		if(is_not_empty($phone) && is_not_empty($promoid)){
	  		$user_details=upsert_usr_by_phone($phone);
	  		//LogMeIn($user_details['email'],$password,$table_id,1); 
	  		$prom_link=biz_get_tiny_url($website."/user/usr_refer_friend.php?promoid=".$promoid."&ref_by=".$user_details['id']);		  		
	  		//$prom_link=biz_get_tiny_url($website."/modules/business_listing/show.php?show_type=PR&lid=".$prom_details['list_id']."&promoid=".$promoid."&ref_by=".$user_details['id']);
	  		$sms_text_msg="Refer a friend promotion {$prom_link}";  		
	  		//echo "CREAT- $sms_text_msg";
	  		$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);
	  		$_response['success']= 1;
	  		$_response['message']  ="Promotion texted successfully"; 
	  	}else{
			$_response['message']  ="Please provide phone and promotion before proceed";
		}  			
    
    }elseif($tag=='get_new_promotions'){				    	
				    	    
		$_res_lst=serv_get_new_prom_rest(); 
		if(is_not_empty($_res_lst)){
			foreach($_res_lst as $_ech_rst){
				$list=array();
				$rest_info = tbl_restaurent::GetInfo($_ech_rst);
			    $list['restaurant_info']=$rest_info; 
				$_tmp_rs=serv_get_all_prom($_ech_rst,'new_list','');
				if(mysql_num_rows($_tmp_rs['r_list']) > 0){
				   $list['promotions']=getMeListFromRecords($_tmp_rs['r_list'],$_tmp_rs['ishistory'], $_tmp_rs['promotion_sql_filter'],$_tmp_rs['map_ids']);
		    	}
		    	$_response['new_rest_promotions'][]=$list;
			}
		}else{					
		   $list['promotions']='No new promotions found.'; 
		}  	
		   	
	
	}elseif($tag == 'get_favorite_prom') {
    	
    	$user_id=get_input('user_id',0);
    	if(is_gt_zero_num($user_id)){
			
			if(is_gt_zero_num($restaurant_id)){
				$_tmp_rs=serv_get_all_prom($restaurant_id,'favorite',$user_id);
				if(mysql_num_rows($_tmp_rs['r_list']) > 0){
				   $list=getMeListFromRecords($_tmp_rs['r_list'],$_tmp_rs['ishistory'], $_tmp_rs['promotion_sql_filter'],$_tmp_rs['map_ids']);
		    	}    	
				$_response['prom_list']=$list;
		    	if(is_not_empty($list)){
		    		if(count($list)>0){
						$_response['message']='Favorite promotion list fetch successful';
					}else{
						$_response['message']='No favorite promotion found';
					}	
					$_response['success']= 1;
				}else{
					$_response['message']= 'No favorite promotions found';
				}
			}else{
				$_response['success']	= 0;
				$_response['message']	= 'Please provide the restaurant before proceed.';
			}			
			
		}else{
			$_response['success'] 	  = 0;
			$_response['message'] ='Please provide user id before proceed.';
		}
		 
	}elseif($tag=='get_my_favorites'){
		
		$phone=get_input('phone','');
		if(is_not_empty($phone)){
			$_res=get_user_for_all_rest($phone);
		}else{
			$_response['message']='Please provide phone number before proceed.';
		}		
    	if(is_not_empty($_res)){
    		foreach($_res as $user_id){
    			$list=array();		    	    
    			$_ech_rest_uid=array_shift($user_id);			
    			$_get_usr_det=get_user($_ech_rest_uid);    			
    			$rest_info = tbl_restaurent::GetInfo($_get_usr_det[STAFF_RESTAURENT]);
		    	$list['restaurant_info']=$rest_info;
		    	
		    	
    			$_tmp_rs=serv_get_all_prom($_get_usr_det[STAFF_RESTAURENT],'favorite','',$_ech_rest_uid);
				if(mysql_num_rows($_tmp_rs['r_list']) > 0){
				   $list['promotions']=getMeListFromRecords($_tmp_rs['r_list'],$_tmp_rs['ishistory'], $_tmp_rs['promotion_sql_filter'],$_tmp_rs['map_ids']);
		    	}else{
					//$_response['prom_list'][$_ech_rest_uid]['message']='No favourite promotions found.'; 
				   $list['promotions']='No favourite promotions found.'; 
				}   	
		    	
		    	$_response['all_rest_promotions'][]=$list; 
				/*$_response['prom_list'][$_ech_rest_uid]=$list; 
				$_response['prom_list'][$_ech_rest_uid]['restaurant_info']=$rest_info;*/
			}
    	}else{
			$_response['message']='Phone number is not registered in our system';
		}	
   		
	
	}elseif($tag == 'add_to_favorite_prom') {
			   
    	$user_id=get_input('user_id',0);
    	$prom_id=get_input('prom_id',0);
    	
    	if(is_gt_zero_num($user_id)){			
			if(is_gt_zero_num($prom_id)){
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
				    $_response['success']	= 1;
					$_response['message']	= 'Promotion added to favorite successfully.';
				 }else{
				 	$_response['success']	= 0;
					$_response['message']	= 'Promotion is already favorite promotion.';
				 }			
			}else{
				$_response['success']	= 0;
				$_response['message']	= 'Please provide the promotion before proceed.';
			}			
		}else{
			$_response['success'] 	  = 0;
			$_response['message'] ='Please provide user id before proceed.';
		} 
		
    }elseif($tag == 'AddRefBy'){
				
		$promoid=get_input('promoid','');
  		$phone=get_input('phone','');
  		$ReferredByName = get_input('ReferredBy','');
  		$is_restaurant = get_input("is_restaurant",1);	  
		//$_SESSION[SES_RESTAURANT]=$is_restaurant;
		//..for registration
		/*$is_refer = get_input("is_refer",0);
		$is_reward = get_input("is_reward",0);*/
		$action_to_take = get_input("action_to_take",'promotion');
		//{'promotion','refer_friend','reward'}
		
		$fname = get_input("fname",'Guest');	
		$lname = get_input("lname",'User');
		$email = get_input("email",'');	
		if(is_not_empty($email)==FALSE){
			$email	= "exusr_"._get_lst_member_id()."@tst.com";
		}			
		$password = 'sample' ;
				
  		if(is_not_empty($phone) && (is_not_empty($promoid) || ($action_to_take=='reward'))){
  			$usrDetails=_all_rest_register($phone,$password,$fname,$lname,$is_restaurant);
  			//..check if new_ref_ph..new refer promotion logic
  			if(is_not_empty($ReferredByName)){
				//..if already added there
				$objtbl_usr_refer_by= new tbl_usr_refer_by();
				$isSuccess = $objtbl_usr_refer_by->create($phone,$ReferredByName, '', '');
				unset($objtbl_usr_refer_by);
			}
  			//..first check if user is registered with our system  			
  			/*$_lg_rs = serv_LogMeIn($phone,$password,1,0,0,$is_restaurant);
  			if($_lg_rs['success']==4){
  				//..get all active restaurants
  				$objtbl_restaurent= new tbl_restaurent();
  				$tbl_restaurentlist = $objtbl_restaurent->readArray(array('isActive'=>1),$result_found,1);
  				
  				foreach($tbl_restaurentlist as $_ech_restrnt){
  					//..loop through all resaturant
					if(is_not_empty($_ech_restrnt)){	
						$_SESSION[SES_RESTAURANT]=$_ech_restrnt[RESTAURENT_ID];							$email	= "exusr_"._get_lst_member_id()."@tst.com";
						
						$_resp_reg=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$_ech_restrnt[RESTAURENT_ID],0,NULL,'');
						if(($_ech_restrnt[RESTAURENT_ID]==$is_restaurant) && (is_not_empty($_resp_reg))){
							$_reg_rs=$_resp_reg;
						}
					}
				}
				unset($objtbl_restaurent);
				$usrDetails=$_reg_rs['user'];
				$_SESSION[SES_RESTAURANT]=$is_restaurant;
				$my_prom_link_new_st= biz_get_tiny_url(urlencode(ALL_REST_APP_PATH .'index.html#MyRewardPage'));
				$_msg=" Congrats, you are member of Restaulogy. Check Free signup offer {$my_prom_link_new_st}";
				echo $_msg;
				//$_succ=@send_sms_using_twilio(array($phone),$_msg);
				
				//..Not registered with us so go ahead and add it..		
				//$_reg_rs=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$is_restaurant,0,NULL,'');
				//..Also register that user to "Restaulogy Restaurant" 
				//..get restaurant details..
				
				//$rest_info_dtls = tbl_restaurent::GetInfo($is_restaurant);
				//$fname=get_elipsis($rest_info_dtls[RESTAURENT_NAME],20,'.');
				//$lname='RestApp';		
				//$_reg_rs_2=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,16,0,NULL,'');		
				
			}else{
				$usrDetails=$_lg_rs['user'];
			}	  		
	  		*/
	  		
	  		if($action_to_take=='refer_friend'){
				//$prom_link=biz_get_tiny_url($website."/user/usr_refer_friend.php?promoid=".$promoid."&ref_by=".$usrDetails['id']);
				$prom_link= biz_get_tiny_url(urlencode(ALL_REST_APP_PATH .'index.html#referFriendLink?promotion_id='.$promoid.'&user_id='.$usrDetails['id']));
				$sms_text_msg="Refer a friend promotion {$prom_link}";
				$_response['success']= 1;				
	  			$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);
	  			$_response['message']="Promotion texted successfully";
			}elseif(is_not_empty($promoid)){			
				//$prom_link=biz_get_tiny_url($website."/user/usr_refer_friend.php?promoid=".$promoid);
				$prom_details=_get_prom_specifics($promoid); 
				if(is_not_empty($prom_details)){
/*					$prom_link=biz_get_tiny_url($website."/modules/business_listing/show.php?show_type=PR&lid=".$prom_details['list_id']."&promoid=".$promoid);	
					$sms_text_msg="Check promotion {$prom_link}";
	  				$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);*/	
	  				$_response['success']= 1;
	  				$_response['message']="user login/signed up successfully";
				}else{					
	  				$_response['message']="Promotion not found or expired"; 
				}				 
			}	  			  		
	  		//$prom_link=biz_get_tiny_url($website."/modules/business_listing/show.php?show_type=PR&lid=".$prom_details['list_id']."&promoid=".$promoid."&ref_by=".$user_details['id']);	  		 		
	  		//echo "CREAT- $sms_text_msg";
	  		

			/**Write code to add data in csv file.**/

			$flg=0;
			$file_name = './file/AddRefBy.csv';
			if (($handle = fopen($file_name, "r")) !== FALSE) {
			    while (($filedata = fgetcsv($handle, 0, ",")) !== FALSE) {
			    	if(in_array($phone,$filedata)) {
			    		$flg = 1;
			    	}
			    }
			    fclose($handle);
			}
			if($flg == 0) {
				$data = $phone.",".$ReferredByName;
				$csvfile = './file/AddRefBy.csv';
				$file = fopen($csvfile,"a");
				fputcsv($file,explode(',',$data));
				fclose($file);
			}

	  		//$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);
	  		//$_response['success']= 1;
	  		$_response['user']= $usrDetails;
	  	}else{
			$_response['message']  ="Please provide phone and promotion before proceed";
		} 
		 			
    }elseif($tag == 'remove_from_favorite_prom') {	 
      
    	$user_id=get_input('user_id',0);
    	$prom_id=get_input('prom_id',0);
    	
    	if(is_gt_zero_num($user_id)){			
			if(is_gt_zero_num($prom_id)){
				$result = mysql_query('Select `id` from `pds_list_favorites` where `list_id`='.$prom_id.' and `user_id` ='.$user_id.' and `ispromotion`=1');
		  		if ($result)
		  		{
			  		$count = mysql_num_rows($result);
		  		}
		  		if ($count == 0)
		  		{		  		    
				    $_response['success']	= 0;
					$_response['message']	= 'Promotion is not present as favorite promotion.';
				}else{
				 	$sql = 'DELETE from `pds_list_favorites` WHERE `list_id`='.$prom_id.' and `user_id` ='.$user_id.' and `ispromotion`=1;' ;							 
				    mysql_query($sql);
				 	$_response['success']	= 1;
					$_response['message']	= 'Promotion successfully removed from favorite list.';
				}			
			}else{
				$_response['success']	= 0;
				$_response['message']	= 'Please provide the promotion before proceed.';
			}			
		}else{
			$_response['success'] 	  = 0;
			$_response['message'] ='Please provide user id before proceed.';
		} 
    }else{
    	
		$_response["error"] 	= 1;
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