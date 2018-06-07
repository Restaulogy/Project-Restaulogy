<?php
 include_once(dirname(dirname(__FILE__)).'/init.php');	
 $table_id = get_input('table_id',0);
 $action = get_input('action','');
 if(is_gt_zero_num($table_id)){
   if($action == 'cancel'){ 
   		echo json_encode(tbl_services_requests::cancellAllpendingRequestForTable($table_id));
   }else{
   			
		$requests = tbl_services_requests::getPendingRequestForTable($table_id);	 
	 
 $info = array();
 $requestcount = 0;
 foreach($requests as $request){ 
   if(is_gt_zero_num($request['srvc_id'])){ 
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
	 
	 include($CONFIG->path."/user/request_stage.php");
	  
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
 		
		echo json_encode(array_unique($info));	
   }
   
 }
?>