<?php

include_once(dirname(dirname(__FILE__)).'/init.php');
include('header.php');

$active_page = 'employee_requests';
 if($sesslife == true){ 
 $request_id = get_input('request_id',0);
 $new_stage_id = get_input('new_stage_id',0);
 $stage_id = get_input('stage_id',0);
 $offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
 $limit = get_input(LIMIT_TITLE,LIMIT_VALUE);
 $report = strtoupper(get_input('report','all'));
 $emp_id = get_input('emp_id',0);
 $table_id = get_input('table_id',0);
 $pst_table_id = get_input('pst_table_id',0);
 
 //..@1Aug2013#1 for customer filter
/* $flt_cust = get_input(FILTER_BY_CUST,''); */
 
 $keyword = get_input('keyword','');
/* $start_date = get_input('start_date','');
 $end_date = get_input('end_date','');*/ 
 //..Condition to show for only todays and yesterday bydefualt
 if($Global_member['member_role_id']==ROLE_ADMIN || $Global_member['member_role_id']==ROLE_OWNER){
 		$start_date = get_input('start_date',date('m/d/Y',strtotime("-1 day")));
 		$end_date = get_input('end_date',date('m/d/Y'));	
 }else{
 		$start_date = get_input('start_date','');
		$end_date = get_input('end_date','');
 }
 
 $expted_time = get_input('expted_time','');
 $actual_time = get_input('actual_time',''); 
 
 $table_status = get_input('table_status',0);
 $sess_id = get_input('sess_id',0);
 $service_staus = get_input('service_staus',1);// 1=Pending & 0=Completed rqst
 
 $search_text="";
 
 //..Rolewise security
if(($Global_member['rl_fn_request_live']==1) && ($Global_member['rl_fn_request_expired']==1)){
  //..Donot change the latestonly
}else{ 
  if($Global_member['rl_fn_request_live']==1){
		$service_staus = 1; 
  }elseif($Global_member['rl_fn_request_expired']==1){
		$service_staus = 0; 
  }else{  		
  		$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['not_allowed'].'</div>';
		biz_script_forward($website);		
  } 
}

//..Exception added for the manager to see past records
/*if(($Global_member['member_role_id']==ROLE_MANAGER)&&(is_not_empty($flt_cust))){
	$service_staus = 0;
}*/
 
 $sort_on = get_input(SORT_ON,'srvc_reqst_id');
 $sort_by=$new_sort='';
 biz_set_sorting_var($sort_by,$new_sort,"DESC");
 //$sort_by = "DESC";	 
 
 $employees = tbl_staff::GetActiveEmployees();
 $diningtables = tbl_dining_table::GetActiveDiningTables();
 $res = 0;
   
 $extra_url = '';
 //... Set the filter criteria
 $obj= new tbl_services_requests();
 
 $action = strtoupper(get_input('action',''));
 $isSuccess = '';
  //print_r($action);
	
  if($action=='CANCEL'){
  	if(is_gt_zero_num($request_id)){
	    $isSuccess = $obj->cancelRequest($request_id);		
 	}
  }
  
  if($action=='ATTEND'){
    if(is_gt_zero_num($request_id) && is_gt_zero_num($emp_id)){
        $isSuccess  = $obj->attendRequest($request_id,$emp_id);
 	}
  }

  if($action=='COMPLETE'){
   /* if(is_gt_zero_num($request_id) && is_gt_zero_num($emp_id)){*/
    if(is_gt_zero_num($request_id)){ 
        $isSuccess  = $obj->completeRequest($request_id,$emp_id);
 	}
  }
  
  if($action=='CHANGE_STAGE'){ 
    if(is_gt_zero_num($request_id) && is_gt_zero_num($stage_id)){ 
		$tmp_info = $obj->GetInfo($request_id);
		/*print_r($tmp_info);*/
		$cal_sec = 0; 
		if(strtotime($tmp_info[SRVC_REQST_CREATED_ON]) > 0){
		 $cal_sec = strtotime('now') - strtotime($tmp_info[SRVC_REQST_CREATED_ON]); 
		} 
		//echo STS_REQST_COMPLETED ."== {$stage_id}";
		$obj_srvc_rqst_stg = new tbl_service_request_stage();
		 
	if(is_gt_zero_num($new_stage_id)){
			$middle_statuses = tbl_table_status::getMiddleRequestStatuses($new_stage_id,$stage_id); 
			foreach($middle_statuses as $middle_status){
				 $obj_srvc_rqst_stg->delete(array(SRVC_REQ_STG_REQUEST_ID=>$request_id,SRVC_REQ_STG_SERVICE_STAGE_ID=>$middle_status));
			}
			$isSuccess =	$obj_srvc_rqst_stg->create($request_id,$new_stage_id,$cal_sec);	 
		}else{
			$isSuccess =	$obj_srvc_rqst_stg->create($request_id,$stage_id,$cal_sec);	
		} 	
		
		//..Check whether the request is picked 
		if($stage_id != STS_REQST_INITIATED){ 
			$obj->attendRequest($request_id,$_SESSION['guid']);
		}  
		
		//..for detecting final stage   
		if(STS_REQST_COMPLETED == $stage_id){
		 //$isSuccess = $obj->completeRequest($request_id,$_SESSION['guid']);
		  $obj->completeRequest($request_id,$_SESSION['guid']);
		}  
    unset($obj_srvc_rqst_stg);
		unset($tmp_info);
 	}
  }

/* if(is_not_empty($start_date) && is_not_empty($end_date) && ($service_staus==0)){
	//$todays_requests=0;
 }else{
 	$start_date=date("Y-m-d 00:00:00");
	$end_date=date("Y-m-d 23:59:00");
 }
 echo "$start_date,$end_date,$service_staus,$todays_requests";*/
  
 $search_array = array('report'=>$report,'offset'=>$offset,'limit'=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on,SES_RESTAURANT=>$_SESSION[SES_RESTAURANT]);
 
 //..status wise report
 
 if(is_gt_zero_num($table_status)){
  /* if(is_not_empty($start_date) && is_not_empty($end_date)){
  	$search_array ['created_on_start'] = $start_date;
  	$search_array ['created_on_end'] = $end_date;
	$extra_url .='&start_date='.$start_date.'&end_date='.$end_date;
  } 
   if(is_gt_zero_num($table_id)){
  	$search_array['srvc_reqst_table_id']= $table_id;
	$extra_url .='&table_id='.$table_id;
  } */
  $search_array['table_status']= 1;
	$smarty->assign('tb_sts_lnk_tab','request');
 } 
 	
  if(is_not_empty($service_staus)){ 	
  	$search_array['isPending']= $service_staus; 
		$search_array['todays_requests']= $service_staus;   
		$extra_url .='&service_staus='.$service_staus;
		//.. code for the showing the live request with complete request only for table_status
		if(is_gt_zero_num($table_status)){
			 $search_array['isPending']= $service_staus; 
			 $search_array['isPendingOnly'] = '';
		}else{
			$search_array['isPending']= '';
			$search_array['isPendingOnly'] = $service_staus;
		}
  }  
  
  if(is_not_empty($keyword)){ 	
  	$search_array['keyword']= $keyword; 
		$extra_url .='&keyword='.$keyword;
		$search_text .= 'keyword: '.$keyword.'|&nbsp;';
  }   
  //echo "$start_date,$end_date";
 //..date wise report
 if(is_not_empty($start_date) && is_not_empty($end_date)){
  	$search_array ['created_on_start'] = $start_date;
  	$search_array ['created_on_end'] = $end_date;
		$extra_url .='&start_date='.$start_date.'&end_date='.$end_date;
		$search_text .= 'Date range: '.$start_date.'-'.$end_date.'|&nbsp;';
  } 
  //..employee wise report
  if(is_gt_zero_num($emp_id)){
		$usr_detail=get_user($emp_id);
  	$search_array['srvc_reqst_emp_id']= $emp_id;
		$extra_url .='&emp_id='.$emp_id;
		$search_text .= 'Server: '.$usr_detail['full_name'].'|&nbsp;';
  }else{
  	if($Global_member['member_role_id']==1){
		$usr_detail=get_user($Global_member['member_id']);
		$search_array['srvc_reqst_emp_id']= $Global_member['member_id'];
		$extra_url .='&emp_id='.$Global_member['member_id'];
		$search_text .= 'Server: '.$usr_detail['full_name'].'|&nbsp;';
	} 
  }
  //..table wise report
   
  if(is_gt_zero_num($table_id)){
		$table_info=tbl_dining_table::GetInfo($table_id);
  	$search_array['srvc_reqst_table_id']= $table_id;
		$extra_url .='&table_id='.$table_id;
		$search_text .= 'Table: '.$table_info['table_number'].'|&nbsp;';
  }elseif(is_gt_zero_num($pst_table_id)){
		$table_info=tbl_dining_table::GetInfo($pst_table_id);
  	$search_array['srvc_reqst_table_id']= $pst_table_id;
		$extra_url .='&pst_table_id='.$pst_table_id;
		$search_text .= 'Table: '.$table_info['table_number'].'|&nbsp;';	
  }
  
  if(is_gt_zero_num($sess_id)){
  	$search_array['srvc_reqst_session_id']= $sess_id;
		$extra_url .='&sess_id='.$sess_id;
  }
	
	//..@1Aug2013#1 for customer filter
	/*if(in_array($Global_member['member_role_id'],array(ROLE_ADMIN,ROLE_MANAGER,ROLE_OWNER))){*/
/*	if($Global_member['member_role_id']==ROLE_MANAGER){
		if(is_not_empty($flt_cust)){
			$search_array['srvc_reqst_created_by']=$flt_cust;
			$extra_url .='&'.FILTER_BY_CUST.'='.$flt_cust;
			$smarty->assign('tb_sts_lnk_tab','request'); 
			$smarty->assign('flt_cust',$flt_cust); 
		}
	} */
	
  
  $search_array['isTemp'] = 0; 
 
 /* print_r($_REQUEST);  
  print_r($search_array);	*/
  //print_r($search_array);
  $results_count = 0;
	
  $requests = $obj->readArray($search_array,$results_count,1);
  $url = $website.'/user/employee_requests.php?table_status='.$table_status.'&report='.strtolower($report).$extra_url;	
	 
  $pagination  = biz_pagination(array(
									'offset_word' =>'offset', 
									'url'=>$url.'&'.SORT_ON.'='.$sort_on.'&'.SORT_BY.'='.$sort_by,
									'limit'=>$limit,
									'offset'=>$offset,
									'count'=>$results_count   
								)); 
 
 $info = array();
 $requestcount = 0;
 $report_data = '';
 $isChanged = 0; 
 $statuses =	tbl_statuses::getStatusPickerValues("'REQUEST'");
  
 foreach($requests as $request){
	 if(is_gt_zero_num($request['srvc_id'])){  
	 $lst_reqst_status = tbl_service_request_stage::getLastStatusOfRequst($request['id']); 
	  $arr = tbl_table_status::getRequest_Statuses($lst_reqst_status); 
	 $remain_stages	= $arr['remain_statuses'];
	 $used_stages		= $arr['used_statuses'];
	 $lastStage			= array_shift($arr['last_statuses']); 
 //print_r($remain_stages);exit; 
	  /*
	   $remain_stages = tbl_service_request_stage::GetRemainingStages($request['id'],$request['srvc_id']);
	 $allStage = tbl_service_stage::GetAllServieceStage($request['srvc_id']);
	 $stages = array();
	 $x = 0; 
	 if(is_not_empty($allStage)){ 
	  foreach($allStage as $stage){
	 	if(biz_arr_search($remain_stages,SRVC_STG_ID,$stage[SRVC_STG_ID])){
		
		}else{
			$stages[$x] = $stage;
			$x++;
		}
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
	 $empInfo = array();
	 if(is_gt_zero_num($request['emp_id'])){ 
	    $member = new members();
		$empInfo = $member->GetInfo($request['emp_id']);
	 }
	 if($report == 'keyword'){	    
	     if($report_data != $request[keyword]){
		 	 $report_data = $request[keyword];
			 $report_data_title = $request[keyword];
			 $isChanged = 1; 
		 }else{
		 	 $isChanged = 0; 
		 }  
	 }elseif($report == 'service_staus'){	    
	     if($report_data != $request[isPending]){
		 	 $report_data = $request[isPending];
			 if($service_staus ==1)			 
			 	$report_data_title = 'Live Requests';
			 else
			 	$report_data_title = 'Completed Requests';	
			 $isChanged = 1; 
		 }else{
		 	 $isChanged = 0; 
		 }  
	 }elseif($report == 'TABLE'){	    
	     if($dininginfo['id'] != $report_data){
		 	 $report_data = $dininginfo['id'];
			 $report_data_title = $dininginfo['number'];
			 $isChanged = 1; 
		 }else{
		 	 $isChanged = 0; 
		 } 
	 }elseif($report == 'DATE'){
	 	$date = date('Y-m-d',strtotime($request['created_on']));
	 	if($report_data != $date){
		 	 $report_data = $date;
			 $report_data_title = $date;
			 $isChanged = 1; 
		 }else{
		 	 $isChanged = 0; 
		 }  
	 }elseif($report == 'EMPLOYEE'){
	 	if($report_data != $request['emp_id']){
		 	 $report_data = $request['emp_id'];
			 $member = new members();
			 $member_info = $member->GetInfo($request['emp_id']);
			 unset($member);
			 $report_data_title = $member_info['full_name'];
			 $isChanged = 1; 
		 }else{
		 	 $isChanged = 0; 
		 }  
	 }
	 $info[$request['id']]= $request;
	
	 $info[$request['id']]['service'] = $serviceinfo;
	 $info[$request['id']]['table'] = $dininginfo;
	 $info[$request['id']]['employee'] = $empInfo;
	 $info[$request['id']]['remain_stages'] = $remain_stages; 
	 $info[$request['id']]['used_stages'] = $used_stages;
	 $info[$request['id']]['last_stage'] = $lastStage;
	  
	 if(is_gt_zero_num($isChanged)){ 
	 	 $info[$request['id']]['report_data'] = $report_data_title;
	 }
	 //print_r($info);
 	 include('request_stage.php');
	 $requestcount++;
	 }	 
}
    
	if(is_not_empty($isSuccess)){
     switch($isSuccess){
	 	case 0: $_SESSION[SES_FLASH_MSG]  .= "<div class=\"error\">".$_lang['services_requests']["{$action}"]['FAILURE_MSG']."</div>"; 
				break;
		case 1: $_SESSION[SES_FLASH_MSG] .= "<div class=\"success\">".$_lang['services_requests']["{$action}"]['SUCCESS_MSG']."</div>"; 
				break;
		case -1: $_SESSION[SES_FLASH_MSG] .= "<div class=\"info\">".$_lang['services_requests']["{$action}"]['ALREADY_MSG']."</div>"; 
				break;
	 }   
   } 
	
	//..Grid click link
	$gr_clk_navigationURL=modify_navigattion_url($url);	
	$smarty->assign('gr_clk_navigationURL',$gr_clk_navigationURL); 
   
	$smarty->assign('employees',$employees);
  $smarty->assign('diningtables',$diningtables);
  $smarty->assign('report',strtolower($report));
	$smarty->assign('new_sort',$new_sort);
	$smarty->assign('requestinfo',$info);
	$smarty->assign('requestcount',$requestcount);
	$smarty->assign('pagination',$pagination);
	$smarty->assign('table_id',$table_id);
	$smarty->assign('service_staus',$service_staus);
	$smarty->assign('emp_id',$emp_id);
	$smarty->assign('start_date',$start_date);
	$smarty->assign('end_date',$end_date);	
	$smarty->assign('page_url',$url);
	
	$smarty->assign('search_text',$search_text);
	$smarty->assign('keyword',$keyword);
	$smarty->assign('pst_table_id',$pst_table_id);
	
	
	if(is_gt_zero_num($table_status)){
		$breadcrumbs[0] =array(
   							'link'=>$website.'/user/tbl_table_status_link.php?latestOnly=1',
								'title'=>$_lang['tbl_table_status_link']['listing_title']);
		if(is_gt_zero_num($table_id)){
		$table_info = tbl_dining_table::GetInfo($table_id);
		$breadcrumbs[1] =array(
   							'link'=>$website.'/user/tbl_table_status_link.php?customer_session_id='.$sess_id.'&pst_table_id='.$table_id,
							'title'=>$table_info['number']
							);
			$smarty->assign('table_info',$table_info);
		}						
							
	}
	 
	$breadcrumbs[] =array(
					 	'link'=>$url,
						'title'=>$_lang['services_requests']['employee_request']['title']
					); 
	$smarty->assign('curr_service_staus',$service_staus);
	$template = 'employee_requests.tpl';
 	 
}else{
	$template = 'index.tpl';
}
	
include('footer.php');
?>