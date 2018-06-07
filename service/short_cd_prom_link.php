<?php 

include("../service_init.php");
include_once('header.php');
//..Get input
$phone= get_input('Who','7588266377');//,'7588266377'
$prom_code= get_input('What','MNLNDWED');//,'1234567890'
//..required for upsert
$fname = get_input("fname",'Guest');	
$lname = get_input("lname",'User');
$email = get_input("email",'');	
$password = 'sample' ;

if(is_not_empty($email)==FALSE){
	$email	= "exusr_"._get_lst_member_id()."@tst.com";
}
		
//..Based on code decide which restaurant it belongs
if(is_not_empty($prom_code)){
	$prom_details=_get_prom_using_code($prom_code); 
	if(is_not_empty($prom_details)){
		$is_restaurant=$prom_details['prm_restaurent'];
		$_SESSION[SES_RESTAURANT]=$is_restaurant;
		//..Upsert user
		//..first check if user is registered with our system  			
		/*$_lg_rs = serv_LogMeIn($phone,$password,1,0,0,$is_restaurant);
		if($_lg_rs['success']==4){
			//..Not registered with us so go ahead and add it..		
			/*$_reg_rs=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$is_restaurant,0,NULL,'');
			//..Also register that user to "Restaulogy Restaurant" 
			//..get restaurant details..
			$rest_info_dtls = tbl_restaurent::GetInfo($is_restaurant);
			$fname=get_elipsis($rest_info_dtls[RESTAURENT_NAME],20,'.');
			unset($rest_info_dtls);
			$lname='RestApp';		
			$_reg_rs_2=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,16,0,NULL,'');	
			//$usrDetails=_sign_to_all_rest($phone,$password,$fname,$lname,$is_restaurant);
		}*/
		$usrDetails=_sign_to_all_rest($phone,$password,$fname,$lname,$is_restaurant);
		//..send promotion link
		$prom_link=biz_get_tiny_url(urlencode(ALL_REST_APP_PATH.'index.html#promotionDetails?restaurent_id='.$prom_details['prm_restaurent'].'&promotion_id='.$prom_details['id']));
		//$prom_link=biz_get_tiny_url(ALL_REST_APP_PATH."index.html#promotionDetails?promotion_id=".$prom_details['id']);
		//$prom_link=biz_get_tiny_url($website."/modules/business_listing/show.php?show_type=PR&lid=".$prom_details['list_id']."&promoid=".$prom_details['id']);
		$sms_text_msg="Check promotion {$prom_link}";
		echo $sms_text_msg;
		//$isSuccess=@send_sms_using_twilio(array($phone),$sms_text_msg);	
		/*
		$_response['success']= 1;
		$_response['message']="user login/signed up successfully";
		*/
	}else{
		echo 'Promotion not available.';						
		//$isSuccess=@send_sms_using_twilio(array($phone),'Promotion not available.'); 
	}
}
			
?>