<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');
//..Get input
$csm_phone= get_input('From');//,'7588266377'
$csm_short_cd_no= get_input('Body');//,'1234567890'
//..After redirection post
$_rst= get_input('rst',0);
$srt_cd_ph = get_input('srt_cd_ph','');
//..Each restaurant has different short code no, map restaurant
/*if($csm_short_cd_no=='1234567890'){
	$_restaurant=1;	
}*/
//..Based on code decide which restaurant it belongs
/*if(is_not_empty($csm_short_cd_no)){
	if($csm_short_cd_no=='31694'){ //..Zaika chai pani
		$_restaurant=21;
	}elseif($csm_short_cd_no=='31695'){ //..Zaika Kharadi
		$_restaurant=20;
	}elseif($csm_short_cd_no=='70125'){ //..zodiac
		$_restaurant=19;
	}elseif($csm_short_cd_no=='83145'){ //..Nostradamus Lounge & Bar
		$_restaurant=18;
	}elseif($csm_short_cd_no=='21484'){ //..Rajendra Pavbhaji & Juice Bar restaurant
		$_restaurant=17;
	}elseif($csm_short_cd_no=='78468'){ //..Rrestaulogy restaurant
		$_restaurant=16;
	}elseif($csm_short_cd_no=='58620'){ //..Kabab Hut restaurant		
		$_restaurant=15;
	}elseif($csm_short_cd_no=='58621'){ //..Carrots N Celery restaurant	
		$_restaurant=14;
	}elseif($csm_short_cd_no=='53712'){ //..Chinese room restaurant		
		$_restaurant=12;
	}elseif($csm_short_cd_no=='42871'){ //..China grill restaurant		
		$_restaurant=11;
	}elseif($csm_short_cd_no=='54682'){ //..Atlantis restaurant		
		$_restaurant=10;
	}elseif($csm_short_cd_no=='92753'){ //..Zaika restaurant		
		$_restaurant=9;
	}elseif($csm_short_cd_no=='12345'){ //..Kabab Hut restaurant		
		$_restaurant=1;
	}
}*/

if(is_gt_zero_num($_rst)){
	$_restaurant=$_rst;
}

//http://localhost/restaurant_in/user/short_cd_signup.php?rst=1&srt_cd_ph=NzU4ODI2NjM3Nw==
//http://restaulogy.com/dev_restaurant_in/user/short_cd_signup.php?rst=9&srt_cd_ph=MTgy
//..Now set the restaurant
$rest_info = tbl_restaurent::GetInfo($_restaurant);
$_SESSION[SES_RESTAURANT] = $_restaurant;
$_SESSION[SES_RESTNT_NM] =$rest_info[RESTAURENT_NAME];
//..Get and set default table ID
$pst_table_id =_gt_deflt_table_by_rest($_restaurant);
$_SESSION[SES_TABLE] =$pst_table_id;

//echo "csm_phone=$csm_phone| _restaurant=$_restaurant |_SESSION[SES_RESTAURANT]=".$_SESSION[SES_RESTAURANT];
//print_r($_SESSION);

//exit;
//..Process to send sms for customer for joining with redirection link
if(is_not_empty($csm_phone)){
	_short_cd_sign_up($csm_phone);
}	

if( is_gt_zero_num($_rst)){	//is_not_empty($srt_cd_ph)
	//..decode the phone 
	//$srt_cd_ph=base64_decode($srt_cd_ph);
	//..If already logged in ..log him out.
	if($sesslife==true){
		LogMeOut(1);
		biz_script_forward($website."/user/short_cd_signup.php?rst={$_rst}&srt_cd_ph=".$srt_cd_ph);
		exit;
	}
	//..First add phone to loyalty if not done already
	//$_usr_det=get_user($srt_cd_ph);		

	//..Set user QR code cookie
	checkNcreateUserCookieId_QRCODE();
	//redirect to login
	biz_script_forward($website.'/user/user_loyalty.php?filphone='.$srt_cd_ph);
	exit;
	//..Log in the user and redirect to loyalty screen
	//$prop=LogMeIn($_usr_det['email'],'sample',$_SESSION[SES_TABLE],1,0,$_SESSION[SES_RESTAURANT]);	
	//$_SESSION[SES_FLASH_MSG]='Show this page at the restaurant to redeem the coupon';
	//biz_script_forward($website.'/user/customer_rewards.php');
		
}
?>