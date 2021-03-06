<?php
 
  include_once(dirname(dirname(__FILE__)).'/init.php');
 //include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_list_promotions.class.php');
 //include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_redim_cupons.class.php'); 
 //include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/functions.php');
  include_once('header.php');
	
  $active_page = "usr_refer_friend";	
	
  $act_to_do=get_input('act_to_do','');
  $promoid=get_input('promoid','');
  $phone=get_input('phone','');
  
  $ref_by=get_input('ref_by',0);
  $friend_id=get_input('friend_id',0);
  $server_pin=get_input('server_pin','');  
  $_refer_frnd_id=get_input('_refer_frnd_id',0);  
  $_is_already_claimed=0;
  
  $_is_sms_sent=0;  
  $err=""; 
  
  //
  if(is_not_empty($promoid)){
  	//..Send sms to the user
  	$prom_details=_get_prom_specifics($promoid);  	
  	//print_r($prom_details);
  	//exit;
  	//$showing_promotion = get_promotion_info($promoid);
  }else{
  	$_SESSION[SES_FLASH_MSG]  ='<div class="error">Invalid Access</div>';	
 	biz_script_forward($website.'/user/dashboard.php');	
  }
   //..if user already logged in use his phone number
  if($sesslife==true){
  	 if(is_gt_zero_num($ref_by)){
	  	$phone=$_SESSION[SES_CUST_PHN];		  		
		$prom_link=biz_get_tiny_url($website."/user/usr_refer_friend.php?promoid=".$promoid."&ref_by=".$_SESSION['guid']);
		$sms_text_msg="Refer a friend promotion {$prom_link}";  		
		$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);
		//echo "AUTO- $sms_text_msg"; 
		$_SESSION[SES_FLASH_MSG]  ='<div class="success">Promotion texted successfully</div>';
		$_is_sms_sent=1;
	}
  }else{
  	 if($act_to_do=="CREATE_LOGIN"){
	  	if(is_not_empty($phone) && is_not_empty($promoid)){
	  		$user_details=upsert_usr_by_phone($phone);
	  		//LogMeIn($user_details['email'],$password,$table_id,1); 
	  		$prom_link=biz_get_tiny_url($website."/user/usr_refer_friend.php?promoid=".$promoid."&ref_by=".$user_details['id']);		  		
	  		//$prom_link=biz_get_tiny_url($website."/modules/business_listing/show.php?show_type=PR&lid=".$prom_details['list_id']."&promoid=".$promoid."&ref_by=".$user_details['id']);
	  		$sms_text_msg="Refer a friend promotion {$prom_link}";  		
	  		//echo "CREAT- $sms_text_msg";
	  		$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);
	  		$_SESSION[SES_FLASH_MSG]  ='<div class="success">Promotion texted successfully</div>';
	  		$_is_sms_sent=1;  		
	  	}
	  }  	
  }
  
  if((is_gt_zero_num($promoid)) && (is_gt_zero_num($ref_by))){
  	if($prom_details['isExpired']){
  		$_SESSION[SES_FLASH_MSG]  ='<div class="success">Promotion is expired.</div>';
  	}else{
		if(($act_to_do=="CREATE_CUST_LOGIN") && is_not_empty($server_pin) && (is_not_empty($phone))){
		  	
	  		$_SESSION[SES_RESTAURANT]=$prom_details['prm_restaurent'];
	  		$user_details=upsert_usr_by_phone($phone);
	  		//print_r($user_details);
	  		$friend_id=$user_details['id'];
	  		//..Check in the db if record present else add
	  		$objtbl_refer_friends= new tbl_refer_friends();
	  		if ($objtbl_refer_friends->isAlreadyThere($ref_by ,$friend_id ,$promoid ,'' ,'')){ 			
				$_SESSION[SES_FLASH_MSG]= "<div class='error'>".$_lang['tbl_refer_friends']['CREATE']['DUPLICATE_MSG']."</div>";
			}else{				
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
					 	$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['biz_rewards']['info_msg']['claim_success'].'</div>';
					} 
					//...Add reward points to sender loyalty program 
					$objbiz_checkins=new biz_checkins(); 
					$isSuccess = $objbiz_checkins->create($prom_details['prm_restaurent'], 0, $ref_by,0, $prom_details['prm_refer_frd_points'], date(DATE_FORMAT),0,$prom_details['prm_refer_frd_points'],"");
					unset($objbiz_checkins);		
					/*if($isSuccess){
						$_SESSION[SES_FLASH_MSG] = "<div class='info'>Reward Points Added Successfully.</div>";
						$_refer_frnd_id=0;
					}*/
				}else{
					$_SESSION[SES_FLASH_MSG] = "<div class='error'>".$_lang['biz_checkins'][ACTION_CREATE]['CD_DOES_NOT_MATCH']."</div>";
				}	
			}  		
	  		unset($objtbl_refer_friends);  			
		  	  	
	  }  
		
	}
  }
  
  
  
 //..pass the variable to the template     
 $smarty->assign('active_page',$active_page);
 $smarty->assign('phone',$phone);

 $smarty->assign('promoid',$promoid);
 $smarty->assign('_is_sms_sent',$_is_sms_sent);
 
 $smarty->assign('vPromotion',$prom_details);
 $smarty->assign('_refer_frnd_id',$_refer_frnd_id);
 $smarty->assign('ref_by',$ref_by);
 $smarty->assign('friend_id',$friend_id);
 
 $smarty->assign('_is_already_claimed',$_is_already_claimed);
 
 
 $template = 'refer_friend/usr_refer_friend.tpl';
  
 include('footer.php');  
?>