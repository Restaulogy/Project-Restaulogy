<?php

include_once(dirname(dirname(__FILE__))."/init.php");
include("header.php");
 

/* if(($sesslife == true) && ($Global_member['member_role_id'] == 1)){ */
 if($sesslife == true){ 
 $request_id = get_input("request_id",0);
 $stage_id = get_input("stage_id",0);
 $offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
 $limit = get_input(LIMIT_TITLE,LIMIT_VALUE); 
 $emp_id = $Global_member['member_id']; 
 
 $sort_on = get_input(SORT_ON,"srvc_reqst_table_id");
 $sort_by=$new_sort="";
 biz_set_sorting_var($sort_by,$new_sort);
 $sort_url = SORT_ON."={$sort_on}&".SORT_BY."={$sort_by}";
  
  $res = 0;

  $obj = new tbl_employee_last_request();
  $res = $obj->chkEmplyoeeRequest($emp_id,$lastPendingRequest);
  unset($obj);	

  $obj= new tbl_services_requests();
  $action = strtoupper(get_input("action",""));
  $isSuccess = "";
  
  
  if($action=="ATTEND"){
    if(is_gt_zero_num($request_id) && is_gt_zero_num($emp_id)){
        $isSuccess  = $obj->attendRequest($request_id,$emp_id);
 	}
  }

  if($action=="COMPLETE"){
   
    if(is_gt_zero_num($request_id) && is_gt_zero_num($emp_id)){
        $isSuccess  = $obj->completeRequest($request_id,$emp_id);
 	}
  }
  
  if($action=="CHANGE_STAGE"){
  
    if(is_gt_zero_num($request_id) && is_gt_zero_num($stage_id)){ 
		$tmp_info = $obj->GetInfo($request_id);
		$cal_sec = 0; 
		if(strtotime($tmp_info[SRVC_REQST_CREATED_ON]) > 0){
		 $cal_sec = strtotime("now") - strtotime($tmp_info[SRVC_REQST_CREATED_ON]); 
		} 
		$obj_srvc_rqst_stg = new tbl_service_request_stage(); 
 
    	$isSuccess = $obj_srvc_rqst_stg->create($request_id,$stage_id ,$cal_sec);	
		
		//..Check whether the order is picked
		$service_stage_info = tbl_service_stage::GetInfo($stage_id);
		if($service_stage_info['srvc_stg_sort_order'] != ORDER_INITIATED){
			//$isSuccess = $obj->attendRequest($request_id,$emp_id);
			$obj->attendRequest($request_id,$emp_id);	
		} 
		unset($service_stage_info);
		
		//..for detecting final stage  
		if(tbl_service_stage::GetLastServiceStage($tmp_info['srvc_id']) == $stage_id){
			//$isSuccess = $obj->completeRequest($request_id,$emp_id);
			$obj->completeRequest($request_id,$emp_id);
		} 
		
        unset($obj_srvc_rqst_stg);
		unset($tmp_info);
 	}
  }

 $results_count = 0;
 //$requests = $obj->readArray(array("todays_requests"=>"1","isPending"=>1,"offset"=>$offset,"limit"=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on),$results_count,1);
 $requests = $obj->readArray(array('todays_requests'=>'1','isPendingOnly'=>1,'offset'=>$offset,'limit'=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on),$results_count,1);
 	/*$newRequests = array();
 foreach($requests as $key=>$request){
 	$newRequests[$key] = $request;
	$req_comp_stages = tbl_service_request_stage::readArray(array(SRVC_REQ_STG_REQUEST_ID=>$request['srvc_reqst_id']));
	
 	$service_stages =  tbl_service_stage::readArray(array(SRVC_STG_SERVICE_ID=>$request['srvc_reqst_srvc_id']));
	$remaining_stages = 
	foreach($service_stages as $service_stage){
		if(biz_arr_search($req_comp_stages,SRVC_REQ_STG_REQUEST_ID,$service_stage[SRVC_STG_ID])){
			$remaining_stages[$service_stage[SRVC_STG_ID]] = 
		}
		
	} 
 }*/
  
  $url = "{$website}/user/pending_requests.php";
  $pagination  = biz_pagination(array( 
									"offset_word" =>"offset", 
									"url"=>$url."?".$sort_url,
									"limit"=>$limit,
									"offset"=>$offset,
									"count"=>$results_count   
								),$allpageCount,$currentPage);
   
 
 $info = array();
 $requestcount = 0;
 foreach($requests as $request){
  
   if(is_gt_zero_num($request['srvc_id'])){ 
	 $lst_reqst_status = tbl_service_request_stage::getLastStatusOfRequst($request['id']);
	  
	  $arr = tbl_table_status::getRequest_Statuses($lst_reqst_status);
	  
	 $remain_stages	= $arr['remain_statuses'];
	 $used_stages		= $arr['used_statuses'];
	 $lastStage			= array_shift($arr['last_statuses']); 
	 
	 /*
	 $remain_stages = tbl_service_request_stage::GetRemainingStages($request['id'],$request['srvc_id']);
	 $allStage = tbl_service_stage::GetAllServieceStage($request['srvc_id']);
	 $stages = array();
	 $x = 0; 
	  foreach($allStage as $stage){
	 	if(biz_arr_search($remain_stages,SRVC_STG_ID,$stage[SRVC_STG_ID])){
		
		}else{
			$stages[$x] = $stage;
			$x++;
		}
	 }
	
	 $stages = array_reverse($stages);
	 
	 $lastStage = array();
	 $used_stages = array();
	 $y = 0;
	 if(is_gt_zero_num($x)){  
		for($i=0;$i<$x;$i++){
			if($i == 0){
				$lastStage = $stages[0];
			}else{
				$used_stages[$y] = $stages[$i];
				$y++;
			}
		}   
	 }
		 
	 
	 */
	 $service = new tbl_services_code();
	 
	 $serviceinfo = $service->GetInfo($request['srvc_id']);
		
	 $dining = new tbl_dining_table();
	 $dininginfo = $dining->GetInfo($request['table_id']);
 	 $info[$request['id']]= $request;
	 $info[$request['id']]['service'] = $serviceinfo;
	 $info[$request['id']]['table'] = $dininginfo;
	 $info[$request['id']]['remain_stages'] = $remain_stages;
	 $info[$request['id']]['used_stages'] = $used_stages;
	 $info[$request['id']]['last_stage'] = $lastStage;
	 
	 include("request_stage.php");
	 
	 /*$current_status_color = "white";
	 if(is_not_empty($remain_stages)){
	 	//.. Check first item from the list
	 		$current_stage = $remain_stages[0];
			$cal_sec = 0; 
		if(strtotime($request[SRVC_REQST_CREATED_ON]) > 0){
		 $cal_sec = strtotime("now") - strtotime($request[SRVC_REQST_CREATED_ON]); 
		}
		//echo $current_stage[SRVC_STG_THRESH_HOLD_TIME]."=".$cal_sec."<hr>";
		 
		if($current_stage[SRVC_STG_THRESH_HOLD_TIME] < $cal_sec){ 
			$current_status_color = "red";
		}else{
			$current_status_color = "yellow";
		} 
		 
			
	 }else{
	 	 $info[$request['id']]['current_status'] = SERVICE_STATUS_COMPLETED;
		 $current_status_color = "green";
	 }
	
		$info[$request['id']]['current_status_color'] = $current_status_color;*/
	 
	 
	 //..Service request in process (yellow) - The server should attend the table within the time limit specified for attending the table otherwise the color changes from green to red
	 if(strtotime($request['srvc_reqst_attended_on']) == 0){
	 	$time_to_attend = intval ( date('i', strtotime($request['srvc_reqst_created_on'])));
	 }else{
	 	$time_to_attend= intval ( date('i', strtotime($request['srvc_reqst_attended_on'])-strtotime($request['srvc_reqst_created_on'])));
	 } 
	  
	 if($time_to_attend > $serviceinfo["srvc_attend_time_limit"]){
          $info[$request['id']]['attend_within_time']=1;
     }else{
          $info[$request['id']]['attend_within_time']=0;
     }
     //..Service request completed (again back to white)- The server should complete the request in the time limit specified in service is provided field otherwise it gets escalated from yellow to red
	 
	 if(strtotime($request['srvc_reqst_completed_on']) == 0){
	 	$time_to_attend = intval ( date('i', strtotime($request['srvc_reqst_created_on'])));
	 }else{
	 	$time_to_attend= intval ( date('i', strtotime($request['srvc_reqst_completed_on'])-strtotime($request['srvc_reqst_created_on'])));
	 }
	  
	  if(($time_to_completed>0) && (date('i', $time_to_completed)<=$serviceinfo["srvc_provide_time_limit"])){
          $info[$request['id']]['completed_within_time']=1;
     }else{
          $info[$request['id']]['completed_within_time']=0;
     }
	 
	 $requestcount++;
  }
 } 
    
   if(is_not_empty($isSuccess)){
    
     switch($isSuccess){
	 	case 0: $err  = "<div class='errorbox'>".$_lang['services_requests']["{$action}"]['FAILURE_MSG']."</div>"; 
				break;
		case 1: $err = "<div class='infobox'>".$_lang['services_requests']["{$action}"]['SUCCESS_MSG']."</div>"; 
				break;
		case -1: $err = "<div class='errorbox'>".$_lang['services_requests']["{$action}"]['ALREADY_MSG']."</div>"; 
				break;
	 }  
   	 
   } 
	$smarty->assign("requestinfo",$info);
	$smarty->assign("requestcount",$requestcount);
	$smarty->assign("pagination",$pagination);
	$smarty->assign("page_url",$url); 
	$smarty->assign("new_sort",$new_sort);
	$smarty->assign("allpageCount",$allpageCount);
	$smarty->assign("currentPage",$currentPage);
	$smarty->assign("page_title",$_lang['services_requests']['pending_request']['title']);
 	$template = "pending_requests.tpl";
}else{
	$template = "index.tpl";
}
	
include("footer.php");
?>