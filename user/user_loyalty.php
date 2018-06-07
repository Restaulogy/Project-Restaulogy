<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
include('header.php');

$filt_search_phone=get_input('filt_search_phone','');

if($sesslife==true){		
	//..if phone provided
	if(is_not_empty($filt_search_phone)){
		//..upsert user and get details
		$_usr_det=_upsert_phone_to_rest($filt_search_phone,'sample','Guest','User',$_SESSION[SES_RESTAURANT]);	
		if($_usr_det['id']>1){			
			//..Redirect to page showing the reward member lookup with
			biz_script_forward("{$website}/user/customer_rewards.php?manager_cust_sess_id=".$_usr_det['id']);
			exit;
		}		
	}					
}else{
	//..check if the qrsession is there
	if(is_gt_zero_num($_SESSION[SES_TABLE])==FALSE){
		$_SESSION['qr_sess_expired']=1;
		$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['qrcode']['empty'].'</div>';		
		biz_script_forward($website.'/user/dashboard.php');			
	}else{
		//..if phone provided
		if(is_not_empty($filt_search_phone) && is_gt_zero_num($_SESSION[SES_RESTAURANT])){
			//..upsert user and get details
			$_usr_det=_upsert_phone_to_rest($filt_search_phone,'sample','Guest','User',$_SESSION[SES_RESTAURANT]);	
			if($_usr_det['id']>1){			
				//..Log in the user and redirect to loyalty screen
				$prop=LogMeIn($_usr_det['email'],'sample',$_SESSION[SES_TABLE],1,0,$_SESSION[SES_RESTAURANT]);	
				$_SESSION[SES_FLASH_MSG]='Show this page at the restaurant to redeem the coupon';
				biz_script_forward($website.'/user/customer_rewards.php');	
				exit;
			}		
		}		
	}	
}  
$template = 'user_loyalty.tpl';
$smarty->assign('active_page','user_loyalty');	 

include_once('footer.php');   
?>