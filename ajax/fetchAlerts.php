<?php 
 include_once(dirname(dirname(__FILE__)).'/init.php');
 $res = 0; 
 if($sesslife == true){   
	if($Global_member['member_role_id'] == ROLE_CUSTOMER || $Global_member['member_role_id'] == ROLE_WAITER){
		$res = tbl_alerts::isNewAlert($Global_member['member_id']); 
	}else{
		$neg_role = -($Global_member['member_role_id']);
		$res = tbl_alerts::isNewAlert($neg_role); 
	} 
	
 }else{
 	if(is_gt_zero_num($_SESSION[SES_COOKIE_UID])){
		   
 			$res = tbl_alerts::isNewAlert($_SESSION[SES_COOKIE_UID],CUST_TYPE_COOKIE); 
	 }
 }
 
 tbl_alerts::sendDelayNotificationForPost();
 echo json_encode(array('isAlert'=>$res)); 
?>