<?php

include_once(dirname(dirname(__FILE__))."/init.php");
include("header.php");
 
 //$table_id = get_input("table_id",0);
 if(is_gt_zero_num($_SESSION[SES_TABLE]))
 	$table_id =$_SESSION[SES_TABLE]; 
 else	
 	$table_id = get_input("table_id",$_SESSION[SES_TABLE]); 
	
 $offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
 $limit = get_input(LIMIT_TITLE,LIMIT_VALUE);
 
 $sort_on = get_input(SORT_ON,"srvc_reqst_table_id");
 $sort_by=$new_sort="";
 biz_set_sorting_var($sort_by,$new_sort);	
 
 
 //if($sesslife == true || (is_gt_zero_num($table_id) == false)){
 if(($Global_member['member_role_id'] == ROLE_MANAGER)){
  $obj = new tbl_dining_table();
  $dininginfo = $obj->GetInfo($table_id);	
  unset($obj);
  $obj = new tbl_services_requests(); 

  $results_count = 0;
  $requests = $obj->readArray(array(OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on),$results_count,1);
	/*
   $requests = $obj->readArray(array("todays_requests"=>"1","isPending"=>1,SRVC_REQST_TABLE_ID=>$table_id,OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on),$results_count,1);
	*/
 	 
  $url = "{$website}/user/customer_requests.php?table_id={$table_id}";
  $pagination  = biz_pagination(array( 
									"offset_word" =>"offset", 
									"url"=>$url."&".SORT_ON."=$sort_on&".SORT_BY."=$sort_by",
									"limit"=>$limit,
									"offset"=>$offset,
									"count"=>$results_count   
								));   
 
 $info = array();
 $requestcount = 0;
 foreach($requests as $request){
  
   if(is_gt_zero_num($request['srvc_id'])){ 
	 $remain_stages = tbl_service_request_stage::GetRemainingStages($request['id'],$request['srvc_id']);
	 if(is_gt_zero_num($request['emp_id'])){
	 	$member = new members();
	 	$memberinfo = $member->GetInfo($request['emp_id']);
		unset($member);
	 }
	 $service = new tbl_services_code();
	 $serviceinfo = $service->GetInfo($request['srvc_id']);
 	 $info[$request['id']]= $request;
	 $info[$request['id']]['service'] = $serviceinfo;
	 $info[$request['id']]['employee'] = $memberinfo;
	 $info[$request['id']]['remain_stages'] = $remain_stages;
	 include("request_stage.php");
	 /*$current_status_color = CLR_WHITE;
	 if(is_not_empty($remain_stages)){
	 	$info[$request['id']]['current_status'] = SERVICE_STATUS_IN_PROCESS;
	 	//.. Check first item from the list
	 		$current_stage = $remain_stages[0]; 
			$cal_sec = 0; 
		if(strtotime($request[SRVC_REQST_CREATED_ON]) > 0){
		 $cal_sec = strtotime("now") - strtotime($request[SRVC_REQST_CREATED_ON]); 
		}
		//..if current stage 
		
		if($current_stage[SRVC_STG_SORT_ORDER] == 2){ 
			if($current_stage[SRVC_STG_THRESH_HOLD_TIME] < $cal_sec){ 
				$current_status_color = CLR_RED;
			}else{
				$current_status_color = CLR_GREEN;
			}
		}else{
			if($current_stage[SRVC_STG_THRESH_HOLD_TIME] < $cal_sec){ 
				$current_status_color = CLR_RED;
			}else{
				$current_status_color = CLR_YELLOW;
			}
		}		 
			
	 }else{
	 	 $info[$request['id']]['current_status'] = SERVICE_STATUS_COMPLETD;
		 $current_status_color = CLR_WHITE;
	 }
	
	 $info[$request['id']]['current_status_color'] = $current_status_color; */
	 $requestcount++;
  }
 }    
	$smarty->assign("requestinfo",$info);
	$smarty->assign("table_id",$table_id);
	$smarty->assign("requestcount",$requestcount);
	$smarty->assign("pagination",$pagination);
	$smarty->assign("dininginfo",$dininginfo);
	$smarty->assign("new_sort",$new_sort);
	$smarty->assign("pageurl",$url);
 	$template = "customer_requests.tpl";	
 }else{	
    $template = "index.tpl";
} 
	
include("footer.php");
?>