<?php

include_once(dirname(dirname(__FILE__)).'/init.php');
include('header.php');
 $active_page = 'customer_request';
 //$pst_table_id = get_input('table_id',0);
 if(is_gt_zero_num($_SESSION[SES_TABLE]))
 	$pst_table_id =$_SESSION[SES_TABLE]; 
 else	
 	$pst_table_id = get_input('table_id',$_SESSION[SES_TABLE]); 
	
	/*$cust_sess_id = checkNcreateSession($pst_table_id,$_SESSION['cust_nm']);*/
	
 $offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
 $limit = get_input(LIMIT_TITLE,LIMIT_VALUE);
 
 $sort_on = get_input(SORT_ON,'srvc_reqst_id');
 $sort_by=$new_sort='';
 biz_set_sorting_var($sort_by,$new_sort,'DESC');
 $sort_url = SORT_ON.'='.$sort_on.'&'.SORT_BY.'='.$sort_by;
 
 $active_page='customer_request';
 
 
 //if($sesslife == true || (is_gt_zero_num($pst_table_id) == false)){
/* if(($Global_member['member_role_id'] == ROLE_CUSTOMER) && (is_gt_zero_num($pst_table_id))){*/
  $obj = new tbl_dining_table();
  $dininginfo = $obj->GetInfo($pst_table_id);	
  unset($obj);
  $obj = new tbl_services_requests(); 
	
 	$results_count = 0;
 	/*$requests = $obj->readArray(array(OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on),$results_count,1);
	'isTemp'=>0,
	*/
	$search_on = 0;
	
	//$search_array = array('todays_requests'=>1,'isPendingIncCancelled'=>1,SRVC_REQST_TABLE_ID=>$pst_table_id,OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on,SES_RESTAURANT=>$_SESSION[SES_RESTAURANT]);
 
	$search_array = array('todays_requests'=>1,'isPendingOnly'=>1,SRVC_REQST_TABLE_ID=>$pst_table_id,OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on,SES_RESTAURANT=>$_SESSION[SES_RESTAURANT]);
	
	$cust_sess_id = tbl_table_customer_session::GetCurrentActiveCustSession($pst_table_id);
		
	if(is_gt_zero_num($cust_sess_id)){
			$search_array[SRVC_REQST_SESSION_ID] = $cust_sess_id;
	}else{
		//$requests = array();
	}
	
	if($sesslife){
		$search_on = 1;
		 if(is_not_empty($_SESSION[SES_CUST_NM])){
			$search_array[SRVC_REQST_CREATED_BY] = $_SESSION[SES_CUST_NM];
		} 
	}else{
		 
		if(is_not_empty($_SESSION[SES_CUST_NM])){
			$search_array[SRVC_REQST_CREATED_BY] = $_SESSION[SES_CUST_NM];
			$search_on = 1;
		} 
	}
		
	$requests = array();
	
	if(is_gt_zero_num($search_on)){
		$requests = $obj->readArray($search_array,$results_count,1);
	}
	//print_r($search_array);
	
	$allpageCount = 0;
	$currentPage = 0;
 	 
   $url = $website.'/user/customer_requests.php?table_id='.$pst_table_id;
  $pagination  = biz_pagination(array( 
									'offset_word' =>'offset', 
									'url'=>$url.'&'.$sort_url,
									'limit'=>$limit,
									'offset'=>$offset,
									'count'=>$results_count   
								),$allPageCount,$currentPage);   
 
 $info = array();
 $requestcount = 0;
 foreach($requests as $request){
  
   if(is_gt_zero_num($request['srvc_id'])){ 
	  
	 $lst_reqst_status = tbl_service_request_stage::getLastStatusOfRequst($request['id']);
	  
	  $arr = tbl_table_status::getRequest_Statuses($lst_reqst_status);
	  
	 $remain_stages	= $arr['remain_statuses'];
	 $used_stages		= $arr['used_statuses'];
	 $lastStage			= array_shift($arr['last_statuses']); 
	 
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
	 $info[$request['id']]['used_stages'] = $used_stages;
	 $info[$request['id']]['last_stage'] = $lastStage;
	 
	 include('request_stage.php');
	 /*$current_status_color = CLR_WHITE;
	 if(is_not_empty($remain_stages)){
	 	$info[$request['id']]['current_status'] = SERVICE_STATUS_IN_PROCESS;
	 	//.. Check first item from the list
	 		$current_stage = $remain_stages[0]; 
			$cal_sec = 0; 
		if(strtotime($request[SRVC_REQST_CREATED_ON]) > 0){
		 $cal_sec = strtotime('now') - strtotime($request[SRVC_REQST_CREATED_ON]); 
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
 
 if(is_not_empty($_SESSION[SES_CUST_NM])==FALSE){
 		$smarty->assign('ask_cust_name',1);
 }
 
	$smarty->assign('requestinfo',$info);
	$smarty->assign('table_id',$pst_table_id);
	$smarty->assign('requestcount',$requestcount);
	$smarty->assign('pagination',$pagination);
	$smarty->assign('dininginfo',$dininginfo);
	$smarty->assign('new_sort',$new_sort);
	$smarty->assign('pageurl',$url); 
	$smarty->assign('allPageCount',$allPageCount); 
	$smarty->assign('currentPage',$currentPage);
	$smarty->assign('active_page',$active_page); 
	$breadcrumbs = array(/*array(
   							'link'=>$website.'/user/dashboard.php',
							'title'=>$_lang['main']['customer_nav_menu']['dashboard']),*/
						 array(
						 	'link'=>$url,
							'title'=>$_lang['services_requests']['customer_request']['title'])); 
 	$template = 'customer_requests.tpl';	
/* }else{	
    $template = 'index.tpl';
} */
	
include_once('footer.php'); 
?>