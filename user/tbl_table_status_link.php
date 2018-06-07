<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');
$active_page = 'tbl_table_status_link';

//print_r(tbl_table_customer_session::getLiveSessTables(TRUE));
//..Only EMployee and Mangers are allowed to see this form
if(($sesslife==true) && (in_array($Global_member['member_role_id'], array(ROLE_MANAGER,ROLE_EXPEDITOR,ROLE_ADMIN,ROLE_OWNER,ROLE_WAITER)))){

if($Global_member['member_role_id']== ROLE_WAITER){
	$curr_emp_id = $Global_member['member_id'];
}else{
	$curr_emp_id='';
}

$tbl_sts_lnk_id= get_input('tbl_sts_lnk_id');
$tbl_sts_lnk_table_id= get_input('tbl_sts_lnk_table_id');
$tbl_sts_lnk_cust_id= get_input('tbl_sts_lnk_cust_id');
$tbl_sts_lnk_status_id= get_input('tbl_sts_lnk_status_id');
$tbl_sts_lnk_emp_id= get_input('tbl_sts_lnk_emp_id',$_SESSION['guid']);
$tbl_sts_lnk_session_id = get_input('tbl_sts_lnk_session_id',0);
$tbl_sts_lnk_party_size= get_input('tbl_sts_lnk_party_size',0);
$tbl_sts_lnk_start_time= get_input('tbl_sts_lnk_start_time');
$tbl_sts_lnk_end_time= get_input('tbl_sts_lnk_end_time');

//..variable for showing/hiding the notifications delete Button
$notify_id 			= get_input('notify_id',0);

//print_r($Global_member);
$latestOnly = get_input('latestOnly',0);

$tbl_reset_table= get_input('tbl_reset_table',0);

/*if(($Global_member['member_role_id']== ROLE_MANAGER) || ($Global_member['member_role_id']== ROLE_WAITER)){
	$latestOnly=1;
}else{
	$latestOnly=0;
}*/

//..Rolewise security
if(($Global_member['rl_fn_tablests_live']==1) && ($Global_member['rl_fn_tablests_expired']==1)){
  //..Donot change the latestonly
}else{ 
  if($Global_member['rl_fn_tablests_live']==1){
		$latestOnly = 1; 
  }elseif($Global_member['rl_fn_tablests_expired']==1){
		$latestOnly = 0; 
  }else{  		
  		$_SESSION['disp_msg'] = '<div class="error">'.$_lang['main']['not_allowed'].'</div>';
		biz_script_forward($website);		
  } 
}

$action = strtoupper(get_input(ACTION_TITLE));
$mode = strtoupper(get_input(MODE_TITLE));
$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);
if($latestOnly==1){
	$deflt_sort_order='tbl_sts_lnk_table_id';
}else{
	$deflt_sort_order='	tbl_sts_lnk_id';
}
$sort_on = get_input(SORT_ON,$deflt_sort_order);
$todays_requests = get_input('todays_requests',1);

//..Functionality for change status capture form fields
$pst_table_id = get_input('pst_table_id',0);
$pst_cust_id = get_input('pst_cust_id',0);
$pst_status_id = get_input('pst_status_id',0);
$pst_emp_id = get_input('pst_emp_id',$_SESSION['guid']);
$pst_last_status_link_id= get_input('pst_last_status_id',0);
$change_stage = strtoupper(get_input('change_stage',''));
$customer_session_id = get_input("customer_session_id",0);
$from_layout = get_input('from_layout',0);

//..functionlity for seaching the table stastus
$fts_server = get_input('fts_server','');
$fts_customer = get_input('fts_customer','');
$fts_keywords = get_input('fts_keywords','');
$fts_table = get_input('fts_table','');
//..condition to show for only todays and yesterday bydefualt
 $fts_start_date = get_input('fts_start_date',date('m/d/Y',strtotime("-1 day")));
 $fts_end_date = get_input('fts_end_date',date('m/d/Y'));
//echo "$fts_start_date ,$fts_end_date";

$sort_by=$new_sort='';

$sort_by = get_input(SORT_BY,'DESC');
biz_set_sorting_var($sort_by,$new_sort);
//echo "sort_by=$sort_by";
//$sort_by = get_input(SORT_BY,'DESC');
$url = $website.'/user/tbl_table_status_link.php?latestOnly='.$latestOnly;
$navigationURL = $url.'&'.SORT_ON.'='.$sort_on.'&'.SORT_BY.'='.$sort_by;

$isSuccess = '';
$objtbl_table_status_link= new tbl_table_status_link();
 
//..Functionality for change status
if($change_stage=='CHANGE_STAGE'){  
 
    /*if(is_gt_zero_num($pst_table_id) && is_gt_zero_num($pst_cust_id)&& is_gt_zero_num($pst_status_id) && is_gt_zero_num($pst_last_status_link_id)){*/
	//echo "status=>{$pst_status_id}&&lst_status_id=>{$pst_last_status_link_id}<hr>";
	if(is_gt_zero_num($pst_table_id) && is_gt_zero_num($pst_status_id) && is_gt_zero_num($pst_last_status_link_id)){
		 
	 	//..Get all statuses list
		//$all_statuses=tbl_table_status_link::GetAllTableStatusForCustomer($pst_table_id,$pst_cust_id,$todays_requests);				
		//..Get the last record status for same user
		//$last_status=tbl_table_status_link::GetLastTableStatusForCustomer($pst_table_id,$pst_cust_id,$todays_requests);
		
		//..check for duplicate record entry	
		/*if (in_array($pst_status_id, $all_statuses)){
			$isSuccess =OPERATION_DUPLICATE;
		}else{			
			//..Insert record into the table status link table
			$objtabletatuslink = new tbl_table_status_link();
	    	$objtabletatuslink->create($pst_table_id,$pst_cust_id,$pst_status_id,$pst_emp_id,Date(DATE_FORMAT),NULL);
			unset($objtabletatuslink);
			
			if(is_gt_zero_num($pst_last_status_link_id)){
				$objtabletatuslink = new tbl_table_status_link();
				$objtabletatuslink->update_table_status($pst_last_status_link_id);
				unset($objtabletatuslink);										
			}
			$isSuccess =1;			
		}	
		*/
		//..Insert record into the table status link table
		
		
		//...check if last stage is greater than current stage && not equal to TBL_STATUS_AVAILABLE  
		$objtabletatuslink = new tbl_table_status_link();
		$last_status_info = $objtabletatuslink->GetInfo($pst_last_status_link_id);
		/*
		echo $last_status_info['tbl_sts_lnk_status_id'];
		echo '--'.$pst_status_id.'<hr>';
		*/
		$last_status_key = tbl_statuses::getStatusPickerKeyByStatus($last_status_info['tbl_sts_lnk_status_id']);
		$pst_status_key = tbl_statuses::getStatusPickerKeyByStatus($pst_status_id);
		  
		if((is_not_empty($last_status_info)) && (TBL_STATUS_AVAILABLE != $last_status_info['tbl_sts_lnk_status_id']) && ($last_status_key > $pst_status_key)){
			 //print_r($pst_last_status_link_id);exit; 
			 $objtabletatuslink->delete(array(TBL_STS_LNK_ID=>$pst_last_status_link_id)); 
			 //echo $pst_status_id,$last_status_info[TBL_STS_LNK_STATUS_ID];
			 $middle_statuses = tbl_statuses::getTableMiddleStatuses($pst_status_id,$last_status_info[TBL_STS_LNK_STATUS_ID]);
			  $tbl_sts_lnk_session_id =  $last_status_info[TBL_STS_LNK_SESSION_ID];
			 
				if(is_gt_zero_num($tbl_sts_lnk_session_id)){ 
					foreach($middle_statuses as $middle_status){
						 	$objtabletatuslink->delete(array(TBL_STS_LNK_STATUS_ID=>$middle_status,TBL_STS_LNK_SESSION_ID=>$tbl_sts_lnk_session_id,TBL_STS_LNK_TABLE_ID=>$pst_table_id));  
				 	}
					 	$objtabletatuslink->create($pst_table_id,$pst_cust_id,$pst_status_id,$pst_emp_id,$tbl_sts_lnk_session_id,$tbl_sts_lnk_party_size);  
				} 
				 
		}else{ 	
		    
		    $tbl_sts_lnk_session_id = checkNcreateSession($pst_table_id,$pst_cust_id,0,1,$tbl_sts_lnk_party_size);
			 
			if(is_gt_zero_num($tbl_sts_lnk_session_id)){ 
				 	$objtabletatuslink->create($pst_table_id,$pst_cust_id,$pst_status_id,$pst_emp_id,$tbl_sts_lnk_session_id,$tbl_sts_lnk_party_size);  
			} 
			   
			if(is_gt_zero_num($pst_last_status_link_id)){ 
				$objtabletatuslink->update_table_status($pst_last_status_link_id); 	
			}
			unset($objtabletatuslink);		
		}
		/*unset($pst_status_id);
		unset($pst_last_status_link_id);*/
		
		//..Update the order table status for the table
		/*
		$objtbl_orders = new tbl_orders();
    $objtbl_orders->changeOrderstatus($pst_table_id,$pst_cust_id,$pst_emp_id,$status_id);
		unset($objtbl_orders);*/ 
		$_SESSION[SES_FLASH_MSG] = "<div class='success'>".$_lang['tbl_table_status_link']['UPDATE']['SUCCESS_MSG']."</div>" ;
		$url = (is_gt_zero_num($from_layout)) ? $website.'/user/dining_table_layout.php' :$website.'/user/tbl_table_status_link.php?latestOnly=1';  
			biz_script_forward($url); 
		/*echo "$pst_table_id,$pst_cust_id,$pst_status_id,$pst_emp_id,$pst_last_status_link_id";	*/
	}
}	

if(is_not_empty($action)){
	switch($action){
		case ACTION_CREATE: 
			//$isSuccess = $objtbl_table_status_link->create($tbl_sts_lnk_table_id, $tbl_sts_lnk_cust_id, $tbl_sts_lnk_status_id, $tbl_sts_lnk_emp_id, $tbl_sts_lnk_start_time, $tbl_sts_lnk_end_time); 
			$tbl_sts_lnk_session_id = checkNcreateSession($tbl_sts_lnk_table_id, $tbl_sts_lnk_cust_id,0,1,$tbl_sts_lnk_party_size);
			
			 /*$isSuccess = */ $objtbl_table_status_link->create($tbl_sts_lnk_table_id, $tbl_sts_lnk_cust_id, $tbl_sts_lnk_status_id,$Global_member['member_id'],$tbl_sts_lnk_session_id,$tbl_sts_lnk_party_size);
			 
			break;
		case ACTION_UPDATE: 
			$isSuccess = $objtbl_table_status_link->update($tbl_sts_lnk_id, $tbl_sts_lnk_table_id, $tbl_sts_lnk_cust_id, $tbl_sts_lnk_status_id, $tbl_sts_lnk_emp_id,$tbl_sts_lnk_session_id,  $tbl_sts_lnk_party_size);
			break;
		case ACTION_DELETE: 
			$isSuccess = $objtbl_table_status_link->delete(array(TBL_STS_LNK_ID=>$tbl_sts_lnk_id));
			break;
		case ACTION_ACTIVATE: 
			$isSuccess = $objtbl_table_status_link->activate($tbl_sts_lnk_id);
			break;
		case ACTION_DEACTIVATE: 
			$isSuccess = $objtbl_table_status_link->deactivate($tbl_sts_lnk_id);
			break;
		case ACTION_RESET: 
			if(is_gt_zero_num($tbl_reset_table)){
				$isSuccess = $objtbl_table_status_link->mkDayEndForspecificTable($tbl_reset_table);
			}else{
				$isSuccess = $objtbl_table_status_link->mkDayEndForAllTables();
			}
			
			break;
	}//..Switch
}//..if

	if(is_not_empty($isSuccess)){
			if(is_gt_zero_num($isSuccess)){
				$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['tbl_table_status_link'][$action]['SUCCESS_MSG'].'</div>';
			}elseif($isSuccess == OPERATION_FAIL){
				$_SESSION[SES_FLASH_MSG] =  '<div class="error">'.$_lang['tbl_table_status_link'][$action]['FAILURE_MSG'].'</div>';
			}elseif($isSuccess == OPERATION_DUPLICATE){
				$_SESSION[SES_FLASH_MSG] = '<div class="info">'.$_lang['tbl_table_status_link'][$action]['DUPLICATE_MSG'].'</div>';
			}
	}//..if

	$result_found=0;
	
	$search_arr = array();
	$search_arr[SES_RESTAURANT] = $_SESSION[SES_RESTAURANT];
	
	//	print_r($search_arr);
	//	exit;
	//	array(TBL_STS_LNK_EMP_ID=>$curr_emp_id,
	
	if($latestOnly==1){
		//..Show all records..fetched only latested ..top record only
		if(($pst_table_id>0) && ($customer_session_id > 0)){			
			//..Show only last records..means all records		   
			//$tbl_table_status_linklist = $objtbl_table_status_link->readArray(array(TBL_STS_LNK_TABLE_ID=>$pst_table_id,TBL_STS_LNK_CUST_ID=>$pst_cust_id,'todays_requests'=>$todays_requests,OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on,'latestOnly'=>$latestOnly,"isCurrentCustomerSession"=>$customer_session_id),$result_found,1,1);
			$search_arr['latestOnly'] = $latestOnly;
			$search_arr['isCurrentCustomerSession']= $customer_session_id;			
		
			$tbl_table_status_linklist = $objtbl_table_status_link->readArray($search_arr,$result_found,1,1);
			
			$obj = new tbl_dining_table();
			$tbl_details = $obj->GetInfo($pst_table_id);	
			//$tbl_details['lastOrderId'] = tbl_orders::getCustLastOrder($pst_cust_id,$pst_table_id);	
			//..needs to change code here
			$tbl_details['lastOrderId'] = tbl_orders::getCustSessionLastOrder($customer_session_id);
			
			//$tbl_details['lastOrderId'] = tbl_orders::getCustSessionLastOrder($customer_session_id);	
			/*print_r($tbl_details);  */
			unset($obj);
			$smarty->assign('tbl_details',$tbl_details);		
		}else{
			$search_arr = array();
			$search_arr[OFFSET_TITLE]  = $offset;
			$search_arr[LIMIT_TITLE]  = $limit;
			$search_arr[SORT_BY]  = $sort_by;
			$search_arr[SORT_ON]  = $sort_on;
			$search_arr['latestOnly'] = $latestOnly;
			$tbl_table_status_linklist = $objtbl_table_status_link->readArray($search_arr,$result_found,1);
		}			
	}else{
		if(($pst_table_id>0) && ($customer_session_id > 0)){	
			//..Show only last records..means all records
		   
			//$tbl_table_status_linklist = $objtbl_table_status_link->readArray(array(TBL_STS_LNK_TABLE_ID=>$pst_table_id,TBL_STS_LNK_CUST_ID=>$pst_cust_id,OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on,'latestOnly'=>$latestOnly,"isCurrentCustomerSession"=>$customer_session_id,"pst_cust_id"=>$pst_cust_id),$result_found,1,1);		
			$search_arr = array();
			$search_arr['latestOnly'] = $latestOnly;
	   
			$tbl_table_status_linklist = $objtbl_table_status_link->readArray($search_arr,$result_found,1,1);
			$obj = new tbl_dining_table();
			$tbl_details = $obj->GetInfo($pst_table_id);
			$tbl_details['lastOrderId'] = tbl_orders::getCustSessionLastOrder($customer_session_id);	
			/* print_r($tbl_details); */
			unset($obj);
			$smarty->assign('tbl_details',$tbl_details);		
		}else{
			$search_arr = array();
	
	if(is_not_empty($fts_customer)){
		$search_arr['customer_name'] = $fts_customer;
		$navigationURL .='&fts_customer='.$fts_customer;
		$search_criteria[] = 'customer like \''.$fts_customer.'\'';
	}
	
	if(is_not_empty($fts_server)){
		//$search_arr['server_name'] = $fts_server;
		$search_arr['server_id'] = $fts_server;
		$navigationURL .='&fts_server='.$fts_server;
		$search_criteria[] = 'server like \''.$fts_server.'\'';
	}
	
	if(is_not_empty($fts_keywords)){
		$search_arr['keywords'] = $fts_keywords;
		$navigationURL .='&fts_keywords='.$fts_keywords;
		$search_criteria[] = 'keywords like \''.$fts_keywords.'\'';
	}
	
	if(is_not_empty($fts_table)){
		$search_arr[TBL_STS_LNK_TABLE_ID] = $fts_table;
		$tmp_tbl_info =  tbl_dining_table::GetInfo($fts_table);
		$navigationURL .='&fts_table='.$fts_table;
	  $search_criteria[] = 'Table like \''.$tmp_tbl_info[TABLE_NUMBER].'\'';
		unset($tmp_tbl_info);
	}
	
	//..Date wise filter
  if(is_not_empty($fts_start_date) && is_not_empty($fts_end_date)){ 
  	//$search_arr['fts_start_date']=date(DATE_FORMAT,strtotime($fts_start_date));
  	//$search_arr['fts_end_date']=date(DATE_FORMAT,strtotime($fts_end_date));
		$search_arr['fts_start_date']=$fts_start_date;
  	$search_arr['fts_end_date']=$fts_end_date;  
		$navigationURL .='&fts_start_date='.$fts_start_date.'&fts_end_date='.$fts_end_date;
		$search_criteria[]='Date range: '.$fts_start_date.'-'.$fts_end_date.'|&nbsp;';
  } 
	
	$search_arr[OFFSET_TITLE] = $offset;
	$search_arr[LIMIT_TITLE]= $limit;
	$search_arr[SORT_BY]= $sort_by;
	$search_arr[SORT_ON]=$sort_on;
	$search_arr['latestOnly']=$latestOnly;	
	
   

	$tbl_table_status_linklist = $objtbl_table_status_link->readArray($search_arr,$result_found,1);		
			/*$err .= '<div class="error">Please select table to view the details</div>';*/
		}	
	}	
	$search_text =  biz_implode(FILTER_SEP,$search_criteria);
	$info  = array();
	$count = 0;  
	if(is_not_empty($tbl_table_status_linklist)){ 
	if($Global_member['member_role_id']== ROLE_WAITER) {
		$emp_avial_tbl_lst=GetEmpTables($Global_member['member_id']);
		if(is_not_empty($emp_avial_tbl_lst)==false){
			$tbl_table_status_linklist=array();//no tables available
		}
	}
	
	foreach($tbl_table_status_linklist as $link){	
	 	//..Table only those tables which customer is assigned
		if(($Global_member['member_role_id']== ROLE_WAITER) && (in_array($link['tbl_sts_lnk_table_id'], $emp_avial_tbl_lst)==FALSE)){			
				continue;
		}
		
		$info[$link['tbl_sts_lnk_id']] = $link;
		$info[$link['tbl_sts_lnk_id']]['customer_session'] = tbl_table_customer_session::GetInfo($link['tbl_sts_lnk_session_id']);
		/*  
		If we need request for particular table
			$obj_srvc_req= new tbl_services_requests();
			$srvc_count = 0;
			$search_array['srvc_reqst_table_id']= $table_id;
			$search_array ['created_on_start'] = $lastTableStatus.customer_session.tbl_cust_sess_end_date;
  		$search_array ['created_on_end'] = $lastTableStatus.customer_session.tbl_cust_sess_end_date;
  		$srvc_requests = $obj_srvc_req->readArray(array(),$srvc_count,1);
		*/
		 $info[$link['tbl_sts_lnk_id']]['status'] =  tbl_table_status::GetInfo($link['tbl_sts_lnk_status_id']);
		
		$info[$link['tbl_sts_lnk_id']]['table'] =  tbl_dining_table::GetInfo($link['tbl_sts_lnk_table_id']);
		
		$member = new members(); 
		$info[$link['tbl_sts_lnk_id']]['employee'] =  $member->GetInfo($link['tbl_sts_lnk_emp_id']);
		//$info[$link['tbl_sts_lnk_id']]['customer'] =  $member->GetInfo($link['tbl_sts_lnk_cust_id']);
		//..logic to fetch status time in current status 
		$info[$link['tbl_sts_lnk_id']]['elapsed_time'] = 0;
		/*echo $info[$link['tbl_sts_lnk_id']]['status']['tbl_sts_name']."=>".$link['tbl_sts_lnk_end_time']."=>".strtotime($link['tbl_sts_lnk_end_time'])."<hr>";*/
		if(strtotime($link['tbl_sts_lnk_end_time']) > 0){
			$info[$link['tbl_sts_lnk_id']]['elapsed_time'] =  strtotime($link['tbl_sts_lnk_end_time']) - strtotime($link['tbl_sts_lnk_start_time']);
		}else{
			$info[$link['tbl_sts_lnk_id']]['elapsed_time'] = strtotime("now") - strtotime($link['tbl_sts_lnk_start_time']);
		}		
		$hrs = 0;
		$hrs = floor($info[$link['tbl_sts_lnk_id']]['elapsed_time']/3600);
		
		$info[$link['tbl_sts_lnk_id']]['elapsed_time'] =  biz_zerofill($hrs,2).gmdate(":i:s",$info[$link['tbl_sts_lnk_id']]['elapsed_time']);
		//echo date(DATE_FORMAT);
		//..Logic to fetch the customer arrive time		 
		//$cust_arr_time=tbl_table_status_link::GetTableCustArrive($link[TBL_STS_LNK_TABLE_ID]);
		$cust_arr_time = $info[$link['tbl_sts_lnk_id']]['customer_session'][TBL_CUST_SESS_START_DATE];
		if (is_null($cust_arr_time)){			
			$info[$link['tbl_sts_lnk_id']]['arrive_time']=0;
		}else{
			$hrs = 0;
			$hrs = floor((strtotime("now") - strtotime($cust_arr_time))/3600);
			$info[$link['tbl_sts_lnk_id']]['arrive_time'] = biz_zerofill($hrs,2).gmdate(":i:s",(strtotime("now") - strtotime($cust_arr_time)));					
		}		 
		/*
		print_r($info[$link['tbl_sts_lnk_id']]['customer_session']);
		*/
		unset($member);  
		$count++;  
	 }
   }
		
  /// print_r($info);
	
	$allpageCount = 0;
	$currentPage = 0;
	$smarty->assign('pagination',biz_pagination(array('url'=>$navigationURL,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset,'count'=>$result_found),$allpageCount,$currentPage));  
	$smarty->assign('allpageCount',$allpageCount);
	$smarty->assign('currentPage',$currentPage);
	$smarty->assign('info',$info);
	$smarty->assign('error_msg',$err);
	$smarty->assign('notify_id',$notify_id);
	 
	//..Get all list of dining tables
	//$lst_tables = tbl_dining_table::GetFields(array('key_field' => 'table_id','value_field' => 'table_number','isActive'=>1)); 
	$all_tables = tbl_dining_table::GetFields(array('key_field' => 'table_id','value_field' => 'table_number','isActive'=>1)); 	
	$curr_shift = tbl_shift::getCurrentShift();
 
	$active_tables = tbl_emp_shift_assignment::getTablesForShiftDate($curr_shift,date(DAY_FORMAT));
	
	$active_tables_arr = explode(',',$active_tables);
 //print_r($active_tables_arr);
  	$lst_tables = array();
	foreach($all_tables as $tbl_key=>$tbl_number){
		$lst_tables[$tbl_key]['id'] = $tbl_key;
		$lst_tables[$tbl_key]['title'] = $tbl_number;
		$lst_tables[$tbl_key]['isActive'] = 0;
		if(in_array($tbl_key,$active_tables_arr)){
			$lst_tables[$tbl_key]['isActive'] = 1;
		} 
	} 
	$smarty->assign('lst_tables', $lst_tables);	
	
	//..Get all list of customers
	/*$lst_customers = GetLoggedInUsers();	
	$smarty->assign('lst_customers', $lst_customers);*/	
	
	//..for each table check what are avialable statuses
	//$lst_table_status = tbl_table_status::GetFields(array('key_field' => 'tbl_sts_id','value_field' => 'tbl_sts_name','isActive'=>1));	 
	 $lst_table_status = tbl_statuses::getStatusPickerValues();
 //print_r($lst_table_status);  
	 
	$smarty->assign('lst_table_status', $lst_table_status);
	$reverse_lst_table_status =array();
	if(is_not_empty($lst_table_status)){
		$reverse_lst_table_status = array_reverse($lst_table_status,true);
	}	
	$smarty->assign('reverse_lst_table_status', $reverse_lst_table_status);	
	//..Get the sub menu dish list only for search		
	$tbl_submenu_disheslist = tbl_submenu_dishes::getAllSubMnuDishes();	 
 
	 
/* print_r($lst_table_status);
	 echo '<hr>';
	 print_r($reverse_lst_table_status);  */
	$smarty->assign('tbl_table_status_linklist', $tbl_table_status_linklist); 
	$tbl_sts_lnk_key = array(); 
	$sts_avail_key=$tbl_sts_lnk_key='';
	if(is_not_empty($lst_table_status)){
		foreach($lst_table_status as $key_sts=>$itm_tbl_sts){
			 foreach($tbl_table_status_linklist as $tbl_sts_lnk){
			 	if($tbl_sts_lnk[TBL_STS_LNK_STATUS_ID]==$itm_tbl_sts['id']){
					$tbl_sts_lnk_key[$tbl_sts_lnk[TBL_STS_LNK_TABLE_ID]] = 			$key_sts;  	
				} 
			}
			if(TBL_STATUS_AVAILABLE == $itm_tbl_sts['id']){
				 $sts_avail_key = $key_sts;
			}
		}
	}	  
	$smarty->assign('sts_avail_key',$sts_avail_key);
	$smarty->assign('tbl_sts_lnk_key',$tbl_sts_lnk_key);
	$smarty->assign('result_found',$result_found);
	$template = 'tbl_table_status_link/grid.tpl';
	$breadcrumbs[] = array(
					 	'link'=>$website.'/user/tbl_table_status_link.php?latestOnly=1',
						'title'=>$_lang['tbl_table_status_link']['listing_title']); 
	if($tbl_details){
		$breadcrumbs[] = array(
					 	'link'=>$website.'/user/tbl_table_status_link.php?customer_session_id='.$customer_session_id.'&pst_table_id='.$tbl_details['id'],
						'title'=>$tbl_details['number']);	
	} 
	if (is_not_empty($mode)){
		if(($mode == MODE_VIEW || $mode==MODE_UPDATE) && is_gt_zero_num($tbl_sts_lnk_id)){
			$tbl_table_status_linkinfo= $objtbl_table_status_link->GetInfo($tbl_sts_lnk_id);		 
			$tbl_table_status_linkinfo['status']= tbl_table_status::GetInfo($tbl_table_status_linkinfo['tbl_sts_lnk_status_id']);
			$member = new members();
			$tbl_table_status_linkinfo['employee']= $member->GetInfo($tbl_table_status_linkinfo['tbl_sts_lnk_emp_id']);
			unset($member);  
			$smarty->assign('tbl_table_status_linkinfo',$tbl_table_status_linkinfo);
			if($mode==MODE_UPDATE){
				$smarty->assign('isUpdate',1);
			}
			$template = 'tbl_table_status_link/view.tpl';

		}elseif($mode == MODE_CREATE){ 
			$breadcrumbs[] = array(
					 	'link'=>$url.'&'.MODE_TITLE.'='.$mode,
						'title'=>$_lang['tbl_table_status_link']['create_title']); 
			$template = 'tbl_table_status_link/create.tpl';
		}
	}
	
  $tbl_lst=tbl_dining_table::GetFields(array("key_field"=>TABLE_ID,"value_field"=>TABLE_NUMBER,"isActive"=>1));
 	$smarty->assign('tables',$tbl_lst);

	//..Grid click link
	$gr_clk_navigationURL=modify_navigattion_url($navigationURL);	
	$smarty->assign('gr_clk_navigationURL',$gr_clk_navigationURL);
	
	$smarty->assign('new_sort', $new_sort);	
	$smarty->assign('page_url', $url);
	$smarty->assign('pg_self_url', $_SERVER['PHP_SELF']);
	$smarty->assign('navigationURL',$navigationURL);
	$smarty->assign('latestOnly',$latestOnly);
	$smarty->assign('todays_requests',$todays_requests); 
	$smarty->assign('submenu_disheslist',$tbl_submenu_disheslist); 	
	
	$smarty->assign('fts_start_date',$fts_start_date);
	$smarty->assign('fts_end_date',$fts_end_date); 
	
	$employees = tbl_staff::GetActiveEmployees();
	$smarty->assign('employees', $employees); 
	$smarty->assign('fts_server',$fts_server);
	
	//print_r($info);
		 
}else{
	$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['not_allowed'].'</div>';
	$template='index.tpl';
}

include_once('footer.php');
?>