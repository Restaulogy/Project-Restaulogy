<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');
//include_once('header.php');
//..Check member-wise balance points reminders
$result_found=0;
$arr_filter=array();
		
$arr_filter['exclude_banned']=1;
$arr_filter[STAFF_RESTAURENT]=10;//..atlnatis
$arr_filter['is_reward']=1;
$arr_filter['gt_than_id']=4707;//422

//..Get the list of 
$tbl_stafflist = tbl_staff::getRewardUserPointsDetails($arr_filter,$result_found,1);
echo $result_found;
/*print_r($tbl_stafflist);*/
//exit;

if(is_not_empty($tbl_stafflist) && is_gt_zero_num($result_found)){
	foreach($tbl_stafflist as $_each_member){
		if(is_not_empty($_each_member['staff_phone'])){
			$prom_link=biz_get_tiny_url($website."/user/short_cd_signup.php?rst=10&srt_cd_ph=".base64_encode($_each_member['staff_member_id']));
			$prom_link = biz_get_tiny_url($prom_link);
			$_unsub_lnk ='';
			$_act_crm_id=tbl_crm::get_crm_id_from_email($_each_member['staff_email']);
			if(is_gt_zero_num($_act_crm_id)){	
				$_unsub_lnk = ' Unsubscribe:'.biz_get_tiny_url("{$website}/user/tbl_crm_unsubscribe.php?crm_id={$_act_crm_id}");
			}			
			$_msg= "Redeem your FREE MOCKTAIL/COCKTAIL/DESSERT here {$prom_link}. As a member you will receive promotions from Atlantis.{$_unsub_lnk}";
			echo $_each_member['staff_phone']. "--{$_msg} <br>";
			//send_sms_using_twilio(array($_each_member['staff_phone']),$_msg);
			//sleep(10);
		}
	}
}
?>