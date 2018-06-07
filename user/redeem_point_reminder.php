<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');
//include_once('header.php');
//..Check member-wise balance points reminders
$result_found=0;
$arr_filter=array();
$arr_filter['exclude_banned']=1;
$arr_filter['is_reward']=1;
$arr_filter['search_balance_points']=1;
//..Get the list of 
$tbl_stafflist = tbl_staff::getRewardUserPointsDetails($arr_filter,$result_found,1);
/*echo $result_found;
print_r($tbl_stafflist);*/

if(is_not_empty($tbl_stafflist) && is_gt_zero_num($result_found)){
	foreach($tbl_stafflist as $_each_member){
		if(is_not_empty($_each_member['staff_phone'])){
			$restaurant_info = tbl_restaurent::GetInfo($_each_member[STAFF_RESTAURENT]);
			$_msg=$restaurant_info[RESTAURENT_NAME].': You have '.$_each_member['balance_points'].' points in our loyalty program.You can redeem earliest.';
			send_sms_using_twilio(array($_each_member['staff_phone']),$_msg);
		}
	}
}
?>