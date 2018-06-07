<?php 
 include_once(dirname(dirname(__FILE__))."/init.php");
 $res = 0;
 
 if($sesslife == true){
 	$obj = new tbl_employee_last_request();
	$res1 = $obj->chkEmplyoeeRequest($Global_member['member_id'],$lastPendingRequest); 
	$res2 = $obj->chkEmplyoeeOrder($Global_member['member_id'],$lastEmpOrder);
	$res3 = tbl_table_customer_session::isPendingCustomerForTables(); 
	unset($obj);
 }
 echo json_encode(array("isRequest"=>$res1,"isOrder"=>$res2,"isStatus"=>$res3)); 
?>