<?php

  include_once(dirname(dirname(__FILE__))."/init.php");
  include("header.php"); 
  $request_id = get_input("request_id",0);
  $info = array();
  $res = mysql_query("SELECT * FROM elgg.metro_area");
 
  
  if(is_gt_zero_num($request_id)){
    $obj = new tbl_services_requests();
	$info = $obj->GetInfo($request_id); 
	unset($obj);
	
	$obj = new tbl_serv_request_details();
	$requst_details_count = 0;
	$requst_details = $obj->readArray(array(SRVC_REQST_REQUEST=>$request_id),$requst_details_count,1);
	unset($obj);   
	if(is_gt_zero_num($requst_details_count)){
		$obj = new tbl_services_details();
		$x=0;
		foreach($requst_details as $requst_detail){ 
		   
			$info['sub_service'][$x] = $obj->GetInfo($requst_detail['subcode_id']);
			$info['sub_service'][$x]['value'] = $requst_detail['subcode_value'];
			$x++; 
		}
		unset($obj);  
	}
	
	if(is_gt_zero_num($info['srvc_id'])){
		$obj = new tbl_services_code();
		$info['service'] = $obj->GetInfo($info['srvc_id']); 
		unset($obj); 
	}  
 	 
	if(is_gt_zero_num($info['table_id'])){
		$obj = new tbl_dining_table();
		$info['table'] = $obj->GetInfo($info['table_id']); 
		unset($obj); 
	}
	
	if(is_gt_zero_num($info['emp_id'])){
		$obj = new members();
		$info['employee'] = $obj->GetInfo($info['emp_id']);
		unset($obj); 
	}
	
    
 }else{
 	 $err= "<div class='errorbox'>{$_lang['services_requests']['view_request']['no_record_msg']}</div>";
 }	 
  
  
  
   $template= "view_request.tpl"; 
   $smarty->assign("request",$info); 
   $qr_code = 1;
   if($sesslife==true){
   	$qr_code = 0;
   }  
   $smarty->assign("qr_code",$qr_code);
   
  include("footer.php");  

?>