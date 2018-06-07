<?php 
ini_set('max_execution_time', 0);
include_once(dirname(dirname(__FILE__)).'/init.php');

//...1] Script to send message to restaulogy users..
/*
$sql=  'SELECT DISTINCT `staff_phone`, `staff_id`,`staff_member_id`,`staff_lname`, `staff_fname`, COUNT(`staff_phone`) as `cntInstRec` FROM `tbl_staff` GROUP BY `staff_phone` HAVING `cntInstRec`>6';*/
/*$sql=  'SELECT DISTINCT `staff_phone`, `staff_id`,`staff_member_id`,`staff_lname`, `staff_fname` FROM `tbl_staff` WHERE `staff_restaurent`=16 AND `staff_signup_flg`="R"';
$new_usr=DB::ExecQry($sql);
$_cnt=0;
//..Link to be sent
$prom_link=biz_get_tiny_url(ALL_REST_APP_PATH."index.html#MyRewardPage");
$new_prom_link=biz_get_tiny_url(ALL_REST_APP_PATH."index.html#NewRewardPage");

foreach($new_usr as $_ech_usr){
	if(is_not_empty($_ech_usr[STAFF_PHONE]) && (isValidPhone($_ech_usr[STAFF_PHONE]))){
		$sms_text_msg= date('M')." promotions are up! Click {$new_prom_link} to see newly added promotions <br>";	
		$sms_text_msg= "While we are adding restaurants @ Restaulogy. Have you redeemed your rewards? Click {$prom_link} to check out all your rewards"; 	
		echo $sms_text_msg;
		//..Logic to sleep for 2 sec after every 50 sms
		/*if($_cnt>=50){
			sleep(2);
		}
		//$isSuccess=@send_sms_using_twilio(array($_ech_usr[STAFF_PHONE]),$sms_text_msg);
		//$_cnt=$_cnt+1;
	}
}
*/

//...2] Script to send message to specific restaurant users..
$_rest_id=17;
$sql=  'SELECT DISTINCT `s`.`staff_phone` 
	FROM `members` `m` INNER JOIN `tbl_staff` `s` ON
	`m`.`id` = `s`.`staff_member_id`
	WHERE `staff_restaurent`='.$_rest_id.' AND `m`.`member_role_id`='.ROLE_CUSTOMER;

$new_usr=DB::ExecQry($sql);
$_cnt=0;
//..link to be sent
//$prom_link=biz_get_tiny_url(ALL_REST_APP_PATH."index.html#MyRewardPage");
$new_prom_link=biz_get_tiny_url(ALL_REST_APP_PATH."index.html#NewPromotionPage");
$sms_text_msg="Love is in the air… and we’d like to share it with our very special Valentine’s Day offer - {$new_prom_link}";	

foreach($new_usr as $_ech_usr){
	if(is_not_empty($_ech_usr[STAFF_PHONE]) && (isValidPhone($_ech_usr[STAFF_PHONE]))){
		/*$sms_text_msg="$_cnt ] Check promotion {$prom_link}<br>";		
		echo $sms_text_msg;
		//..Logic to sleep for 2 sec after every 50 sms
		if($_cnt>=50){
			//sleep(2);
		}*/
		$isSuccess=@send_sms_using_twilio(array($_ech_usr[STAFF_PHONE]),$sms_text_msg);
		$_cnt=$_cnt+1;
	}
}
echo "Message sent to {$_cnt} phones";
			
?>