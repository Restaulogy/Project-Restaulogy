<?phpinclude_once(dirname(dirname(__FILE__))."/init.php");include_once("header.php");$active_page = "tbl_wait_que_time_msgs";$est_time_gr = get_input("est_time_gr",$_SESSION[SES_EST_TIME_GR]);if(is_gt_zero_num($est_time_gr)){	$_SESSION[SES_EST_TIME_GR] = $est_time_gr;} if(($sesslife==true) || ($_SESSION['member_role_id'] == ROLE_MANAGER)){ $wtq_time_msg_id= get_input("wtq_time_msg_id");$wtq_time_msg_time= get_input("wtq_time_msg_time");$wtq_time_msg_text= get_input("wtq_time_msg_text");$wtq_time_msg_est_time= get_input("wtq_time_msg_est_time",$_SESSION[SES_EST_TIME_GR]);$wtq_time_start_date= get_input("wtq_time_start_date");$wtq_time_end_date= get_input("wtq_time_end_date");$action = strtoupper(get_input(ACTION_TITLE));$mode = strtoupper(get_input(MODE_TITLE));$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);$sort_on = get_input(SORT_ON,"wtq_time_msg_id");$sort_by=$new_sort="";biz_set_sorting_var($sort_by,$new_sort);$url = "{$website}/user/tbl_wait_que_time_msgs.php";$navigationURL = $url."?".SORT_ON."={$sort_on}&".SORT_BY."={$sort_by}";$isSuccess = "";//..get list of selected items$sel_wait_que_time_msgs= get_input('sel_wait_que_time_msgs');$sel_menu_ids='';if(is_not_empty($sel_wait_que_time_msgs)){		$sel_menu_ids=implode(',', array_keys($sel_wait_que_time_msgs));} //echo $sel_menu_ids;$objtbl_wait_que_time_msgs= new tbl_wait_que_time_msgs();if(is_not_empty($action)){	switch($action){		case ACTION_CREATE: 			$isSuccess = $objtbl_wait_que_time_msgs->create($wtq_time_msg_time, $wtq_time_msg_text, $wtq_time_msg_est_time, $wtq_time_start_date, $wtq_time_end_date);			break;		case ACTION_UPDATE: 			$isSuccess = $objtbl_wait_que_time_msgs->update($wtq_time_msg_id, $wtq_time_msg_time, $wtq_time_msg_text, $wtq_time_msg_est_time, $wtq_time_start_date, $wtq_time_end_date);			break;					case ACTION_DELETE: 		 if(is_not_empty($sel_menu_ids)){ 		 	 $isSuccess = $objtbl_wait_que_time_msgs->delete(array(WTQ_TIME_MSG_ID =>$sel_menu_ids));		 }else{		 	 $isSuccess = $objtbl_wait_que_time_msgs->delete(array(WTQ_TIME_MSG_ID =>$wtq_time_msg_id));		 }						break;					case ACTION_ACTIVATE:			if(is_not_empty($sel_menu_ids)){ 			 $isSuccess = $objtbl_wait_que_time_msgs->activate($sel_menu_ids);		 }else{		 	 $isSuccess = $objtbl_wait_que_time_msgs->activate($wtq_time_msg_id);		 }			 		 break;		 		case ACTION_DEACTIVATE: 			echo $sel_menu_ids;			if(is_not_empty($sel_menu_ids)){ 								$isSuccess = $objtbl_wait_que_time_msgs->deactivate($sel_menu_ids);		 }else{		 	 $isSuccess = $objtbl_wait_que_time_msgs->deactivate($wtq_time_msg_id);		 }  			break;										/*case ACTION_DELETE: 			$isSuccess = $objtbl_wait_que_time_msgs->delete(array(WTQ_TIME_MSG_ID=>$wtq_time_msg_id));			break;		case ACTION_ACTIVATE: 			$isSuccess = $objtbl_wait_que_time_msgs->activate($wtq_time_msg_id);			break;		case ACTION_DEACTIVATE: 			$isSuccess = $objtbl_wait_que_time_msgs->deactivate($wtq_time_msg_id);			break;*/	}//..switch}//..ifif(is_not_empty($isSuccess)){	if(is_gt_zero_num($isSuccess)){		$_SESSION[SES_FLASH_MSG] = "<div class='info'>".$_lang['tbl_wait_que_time_msgs'][$action]['SUCCESS_MSG']."</div>";	}elseif($isSuccess == OPERATION_FAIL){		$_SESSION[SES_FLASH_MSG] =  "<div class='error'>".$_lang['tbl_wait_que_time_msgs'][$action]['FAILURE_MSG']."</div>";	}elseif($isSuccess == OPERATION_DUPLICATE){		$_SESSION[SES_FLASH_MSG] =  "<div class='error'>".$_lang['tbl_wait_que_time_msgs'][$action]['DUPLICATE_MSG']."</div>";	}}//..if $search_arr = array(OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on); array("url"=>$navigationURL,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset); 		$breadcrumbs[] = array(  					'title'=>$_lang['main']['pref_mng_cntrls'],					'link'=>$website.'/user/pref_mng_cntrols.php'					);  $breadcrumbs[]= array(  					'title'=>$_lang['tbl_table_type']['listing_title'],					'link'=>$website.'/user/tbl_table_type.php'					);	 if(is_gt_zero_num($_SESSION[SES_TABLE_TYPE])){	 $table_type_info = tbl_table_type::GetInfo($_SESSION[SES_TABLE_TYPE]); 	if($table_type_info){			$breadcrumbs[]= array(  					'title'=>$table_type_info['tbl_type_name'],					'link'=>$website.'/user/tbl_table_type.php?tbl_type_id='.$table_type_info['tbl_type_id'].'&'.MODE_TITLE.'='.MODE_UPDATE					);		$smarty->assign('table_type_info',$table_type_info);	} }	if(is_gt_zero_num($wtq_time_msg_est_time)){	$search_arr[WTQ_TIME_MSG_EST_TIME]	=$wtq_time_msg_est_time;	$nav_arr[WTQ_TIME_MSG_EST_TIME]		=$wtq_time_msg_est_time;	$est_time_grinfo= tbl_wait_estimation_times::GetInfo($wtq_time_msg_est_time);	$breadcrumbs[] = array('title'=>$_lang['tbl_wait_estimation_times']['listing_title'],				'link'=>$website.'/user/tbl_wait_estimation_times.php');	if($est_time_grinfo){ 		$breadcrumbs[]= array(  					'title'=>$est_time_grinfo['table_type_info']['tbl_type_name'].' ('.$est_time_grinfo[WT_EST_TIME_PARTY_SIZE].')',					'link'=>$website.'/user/tbl_wait_estimation_times.php?'.WT_EST_TIME_ID.'='.$wtq_time_msg_est_time.'&'.MODE_TITLE.'='.MODE_UPDATE					);			$smarty->assign('est_time_grinfo',$est_time_grinfo);	}}	 	$result_found=0;	$tbl_wait_que_time_msgslist = $objtbl_wait_que_time_msgs->readArray($search_arr,$result_found,1);	$nav_arr["count"]=$result_found;	$allpageCount = 0;	$currentPage = 0;	$smarty->assign('pagination',biz_pagination($nav_arr,$allpageCount,$currentPage));	$smarty->assign('allpageCount',$allpageCount);	$smarty->assign('currentPage',$currentPage);	$smarty->assign('tbl_wait_que_time_msgslist', $tbl_wait_que_time_msgslist);	$smarty->assign('result_found',$result_found);	$template = "tbl_wait_que_time_msgs/grid.tpl"; 	/*$breadcrumbs[] = array('title'=>$_lang['main']['pref_mng_cntrls'],				'link'=>$website.'/user/pref_mng_cntrols');*/	$breadcrumbs[] = array('title'=>$_lang['tbl_wait_que_time_msgs']['listing_title'],				'link'=>$url);	if (is_not_empty($mode)){		if(($mode == MODE_VIEW || $mode==MODE_UPDATE) && is_gt_zero_num($wtq_time_msg_id)){			$tbl_wait_que_time_msgsinfo= $objtbl_wait_que_time_msgs->GetInfo($wtq_time_msg_id);  			if($tbl_wait_que_time_msgsinfo){				 				$breadcrumbs[] = array('title'=>$tbl_wait_que_time_msgsinfo['est_time_group']['table_type_info']['tbl_type_name']." (".$tbl_wait_que_time_msgsinfo['est_time_group']['wt_est_time_party_size'].")-".$tbl_wait_que_time_msgsinfo['wtq_time_msg_time']." min".getModeSubTitle($mode),				'link'=>$url.'?wtq_time_msg_id='.$tbl_wait_que_time_msgsinfo['wtq_time_msg_id'].'&'.MODE_TITLE.'='.$mode);							}						$smarty->assign('tbl_wait_que_time_msgsinfo',$tbl_wait_que_time_msgsinfo);			if($mode==MODE_UPDATE){				$smarty->assign("isUpdate",1);			}			$template = "tbl_wait_que_time_msgs/view.tpl";		}elseif($mode == MODE_CREATE){			$breadcrumbs[] = array('title'=>$_lang['tbl_wait_que_time_msgs']['create_title'],				'link'=>$url.'?'.MODE_TITLE.'='.MODE_CREATE);			$template = "tbl_wait_que_time_msgs/create.tpl";		}}		$smarty->assign('est_time_group', tbl_wait_estimation_times::readArray(array("isActive"=>1)));	/*print_r(tbl_wait_estimation_times::readArray(array("isActive"=>1)));*/	$smarty->assign('page_url', $url);	$smarty->assign('navigationURL',$navigationURL);	$smarty->assign('new_sort',$new_sort);	$smarty->assign('active_page',$active_page); }else{	$template="index.tpl";} include_once("footer.php");?>