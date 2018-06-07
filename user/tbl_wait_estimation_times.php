<?phpinclude_once(dirname(dirname(__FILE__)).'/init.php');include_once('header.php');$active_page = 'tbl_wait_estimation_times';$vtable_type = get_input('table_type',$_SESSION[SES_TABLE_TYPE]);if(is_gt_zero_num($vtable_type)){	$_SESSION[SES_TABLE_TYPE] = $vtable_type;}$_SESSION[SES_EST_TIME_GR] = 0; if($sesslife==true && $_SESSION['member_role_id'] == ROLE_ADMIN){ $wt_est_time_id= get_input('wt_est_time_id');$wt_est_time_party_size= get_input('wt_est_time_party_size');$wt_est_time_table_type= get_input('wt_est_time_table_type',$_SESSION[SES_TABLE_TYPE]);$wt_est_time_value= get_input('wt_est_time_value');$wt_est_time_start_date= get_input('wt_est_time_start_date');$wt_est_time_end_date= get_input('wt_est_time_end_date');$action = strtoupper(get_input(ACTION_TITLE));$mode = strtoupper(get_input(MODE_TITLE));$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);$sort_on = get_input(SORT_ON,'wt_est_time_id');$sort_by=$new_sort='';biz_set_sorting_var($sort_by,$new_sort);$url = $website.'/user/tbl_wait_estimation_times.php';$navigationURL = $url.'?'.SORT_ON.'='.$sort_on.'&'.SORT_BY.'='.$sort_by;$isSuccess = '';//..get list of selected items$sel_wait_estimation_times= get_input('sel_wait_estimation_times');$sel_menu_ids='';if(is_not_empty($sel_wait_estimation_times)){		$sel_menu_ids=implode(',', array_keys($sel_wait_estimation_times));} $objtbl_wait_estimation_times= new tbl_wait_estimation_times();if(is_not_empty($action)){	switch($action){		case ACTION_CREATE: 			$isSuccess = $objtbl_wait_estimation_times->create($wt_est_time_party_size, $wt_est_time_table_type, $wt_est_time_value, $wt_est_time_start_date, $wt_est_time_end_date);			break;		case ACTION_UPDATE: 			$isSuccess = $objtbl_wait_estimation_times->update($wt_est_time_id, $wt_est_time_party_size, $wt_est_time_table_type, $wt_est_time_value, $wt_est_time_start_date, $wt_est_time_end_date);			break;					case ACTION_DELETE: 		 if(is_not_empty($sel_menu_ids)){ 		 	 $isSuccess = $objtbl_wait_estimation_times->delete(array(WT_EST_TIME_ID =>$sel_menu_ids));		 }else{		 	 $isSuccess = $objtbl_wait_estimation_times->delete(array(WT_EST_TIME_ID =>$wt_est_time_id));		 }						break;					case ACTION_ACTIVATE:			if(is_not_empty($sel_menu_ids)){ 			 $isSuccess = $objtbl_wait_estimation_times->activate($sel_menu_ids);		 }else{		 	 $isSuccess = $objtbl_wait_estimation_times->activate($wt_est_time_id);		 }			 		 break;		 		case ACTION_DEACTIVATE: 			if(is_not_empty($sel_menu_ids)){ 				$isSuccess = $objtbl_wait_estimation_times->deactivate($sel_menu_ids);		 }else{		 	 $isSuccess = $objtbl_wait_estimation_times->deactivate($wt_est_time_id);		 }  			break;						/*case ACTION_DELETE: 			$isSuccess = $objtbl_wait_estimation_times->delete(array(WT_EST_TIME_ID=>$wt_est_time_id));			break;		case ACTION_ACTIVATE: 			$isSuccess = $objtbl_wait_estimation_times->activate($wt_est_time_id);			break;		case ACTION_DEACTIVATE: 			$isSuccess = $objtbl_wait_estimation_times->deactivate($wt_est_time_id);			break;*/	}//..switch}//..ifif(is_not_empty($isSuccess)){	if(is_gt_zero_num($isSuccess)){		$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['tbl_wait_estimation_times'][$action]['SUCCESS_MSG'].'</div>';	}elseif($isSuccess == OPERATION_FAIL){		$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['tbl_wait_estimation_times'][$action]['FAILURE_MSG'].'</div>';	}elseif($isSuccess == OPERATION_DUPLICATE){		$_SESSION[SES_FLASH_MSG] = '<div class="info">'.$_lang['tbl_wait_estimation_times'][$action]['DUPLICATE_MSG'].'</div>';	}}//..if   $search_arr = array(OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on) ;  $nav_arr = array('url'=>$navigationURL,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset);  $breadcrumbs[] = array(  					'title'=>$_lang['main']['pref_mng_cntrls'],					'link'=>$website.'/user/pref_mng_cntrols.php'					);  $breadcrumbs[]= array(  					'title'=>$_lang['tbl_table_type']['listing_title'],					'link'=>$website.'/user/tbl_table_type.php'					);if(is_gt_zero_num($wt_est_time_table_type)){	$search_arr[WT_EST_TIME_TABLE_TYPE] = $wt_est_time_table_type;	$nav_arr[WT_EST_TIME_TABLE_TYPE] = $wt_est_time_table_type;	$table_type_info = tbl_table_type::Getinfo($wt_est_time_table_type);		if($table_type_info){		$breadcrumbs[]= array(  					'title'=>$table_type_info['tbl_type_name'],					'link'=>$website.'/user/tbl_table_type.php?'.MODE_TITLE.'='.MODE_VIEW					);		$smarty->assign('table_type_info',$table_type_info);	} }	$result_found=0;	$tbl_wait_estimation_timeslist = $objtbl_wait_estimation_times->readArray($search_arr,$result_found,1);	$nav_arr['count']=$result_found;	$allpageCount = 0;	$currentPage = 0;	$smarty->assign('pagination',biz_pagination($nav_arr,$allpageCount,$currentPage));	$smarty->assign('allpageCount',$allpageCount);	$smarty->assign('currentPage',$currentPage);	$smarty->assign('tbl_wait_estimation_timeslist', $tbl_wait_estimation_timeslist);	$smarty->assign('result_found',$result_found);	$template = 'tbl_wait_estimation_times/grid.tpl'; 	$breadcrumbs[] = array('title'=>$_lang['tbl_wait_estimation_times']['listing_title'],				'link'=>$url);	if (is_not_empty($mode)){		if(($mode == MODE_VIEW || $mode==MODE_UPDATE) && is_gt_zero_num($wt_est_time_id)){			$tbl_wait_estimation_timesinfo= $objtbl_wait_estimation_times->GetInfo($wt_est_time_id); 			if($tbl_wait_estimation_timesinfo){ 				$breadcrumbs[] = array('title'=>$tbl_wait_estimation_timesinfo['table_type_info']['tbl_type_name'].' ('.$tbl_wait_estimation_timesinfo['wt_est_time_party_size'].')'.getModeSubTitle($mode),				'link'=>$url.'?wt_est_time_id='.$tbl_wait_que_time_msgsinfo['wt_est_time_id'].'&'.MODE_TITLE.'='.MODE_UPDATE);			} 			$smarty->assign('tbl_wait_estimation_timesinfo',$tbl_wait_estimation_timesinfo);			if($mode==MODE_UPDATE){				$smarty->assign('isUpdate',1);			}			$template = 'tbl_wait_estimation_times/view.tpl'; 		}elseif($mode == MODE_CREATE){			$breadcrumbs[] = array('title'=>$_lang['tbl_wait_estimation_times']['create_title'],				'link'=>$url.'?'.MODE_TITLE.'='.MODE_CREATE);			$template = 'tbl_wait_estimation_times/create.tpl'; 		}} //print_r($tbl_wait_estimation_timesinfo);	$smarty->assign('table_types', tbl_table_type::GetFields(array('key_field'=>TBL_TYPE_ID, 'value_field'=>TBL_TYPE_NAME,'isActive'=>1)));	$smarty->assign('page_url', $url);	$smarty->assign('navigationURL',$navigationURL);	$smarty->assign('new_sort',$new_sort);	$smarty->assign('active_page',$active_page); }else{ 	$template='index.tpl';}  include_once('footer.php'); ?>