<?php 
//include_once(dirname(dirname(__FILE__)).'/init.php');
include("../service_init.php");
include_once('header.php');
//..Get input
$phone_o= get_input('who','');//,'7588266377'
$prom_code= get_input('what','');//,'REST DOKK'
//..required for upsert
$fname = get_input("fname",'Guest');	
$lname = get_input("lname",'User');
$email = get_input("email",'');	
$password = 'sample' ;

function __writeToFile($Data){
    $File = "ShortCodeLog.txt";
    $Handle = fopen($File, 'a');
    fwrite($Handle, $Data);
    fclose($Handle);
}

if(strlen($phone_o)==12){
	$phone=substr($phone_o,2);
}else{
	$phone=$phone_o;
}

if(is_not_empty($email)==FALSE){
	$email	= "exusr_"._get_lst_member_id()."@tst.com";
}		
//..Based on code decide which restaurant it belongs
if(is_not_empty($prom_code)){
	$parse_code=substr($prom_code, 5); //..parse DOKK from 'REST DOKK'   
 	$prom_details=_get_prom_using_code($parse_code); 
	
	if(is_not_empty($prom_details)){  
		$is_restaurant=$prom_details['prm_restaurent'];
		$restaurant_info = tbl_restaurent::GetInfo($is_restaurant);
		if(is_gt_zero_num($is_restaurant)){
			$_usr_detls=_sign_to_spec_rest($phone,$password,$fname,$lname,$is_restaurant,1);
			
			if(is_not_empty($_usr_detls)){
				$my_prom_link_new_st= biz_get_tiny_url($website ."/user/short_cd_signup.php?rst={$is_restaurant}&srt_cd_ph=".$phone);
				//$my_prom_link_new_st= biz_get_tiny_url($website ."/user/short_cd_signup.php?rst={$is_restaurant}&srt_cd_ph=".base64_encode($_usr_detls['id']));
				$_free_offer=_getRestFreeRwd($is_restaurant);
				$_msg="Welcome to '".$restaurant_info[RESTAURENT_NAME]."' rewards program! Click {$my_prom_link_new_st} to {$_free_offer}";	
				//echo $_msg;
				$_succ=@send_sms_using_twilio(array($phone),$_msg);				
			}
		}					
	}
}	
__writeToFile(" [".date('Y-m-d H:i')."] [ {$phone} || {$prom_code} || {$parse_code} || {$is_restaurant} ]".PHP_EOL);		
?>