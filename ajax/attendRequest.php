<?php

 include_once(dirname(dirname(__FILE__))."/init.php");
 
 
 
 $request_id = get_input("request_id",0);
 $emp_id = $Global_member['member_id'];
 $res = 0;
 if($Global_member['member_role_id'] == 1){
 	
	if(is_gt_zero_num($request_id) && is_gt_zero_num($emp_id)){
		$obj= new tbl_services_requests();
	    $res  = $obj->attendRequest($request_id,$emp_id);
		
	}
	
 }
 echo json_encode($res);


?>