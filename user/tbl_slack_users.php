<?phpinclude_once(dirname(dirname(__FILE__))."/init.php");include_once("header.php");$active_page = "tbl_slack_users";/*if($sesslife==true){*/$slkusr_id= get_input("slkusr_id");$slkusr_phone= get_input("slkusr_phone");$slkusr_webhook= get_input("slkusr_webhook");$slkusr_start_date= get_input("slkusr_start_date");$slkusr_end_date= get_input("slkusr_end_date");$action = strtoupper(get_input(ACTION_TITLE));$mode = strtoupper(get_input(MODE_TITLE));$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);$sort_on = get_input(SORT_ON,"slkusr_id");$sort_by=$new_sort="";biz_set_sorting_var($sort_by,$new_sort);$url = "{$website}/user/tbl_slack_users.php";$navigationURL = $url."?".SORT_ON."={$sort_on}&".SORT_BY."={$sort_by}";$isSuccess = "";$objtbl_slack_users= new tbl_slack_users();if(is_not_empty($action)){	switch($action){		case ACTION_CREATE: 			$isSuccess = $objtbl_slack_users->create($slkusr_phone, $slkusr_webhook, $slkusr_start_date, $slkusr_end_date);			break;		case ACTION_UPDATE: 			$isSuccess = $objtbl_slack_users->update($slkusr_id, $slkusr_phone, $slkusr_webhook, $slkusr_start_date, $slkusr_end_date);			break;		case ACTION_DELETE: 			$isSuccess = $objtbl_slack_users->delete(array(SLKUSR_ID=>$slkusr_id));			break;		case ACTION_ACTIVATE: 			$isSuccess = $objtbl_slack_users->activate($slkusr_id);			break;		case ACTION_DEACTIVATE: 			$isSuccess = $objtbl_slack_users->deactivate($slkusr_id);			break;	}//..switch}//..ifif(is_not_empty($isSuccess)){	if(is_gt_zero_num($isSuccess)){		$err .= "<div class='info'>".$_lang['tbl_slack_users'][$action]['SUCCESS_MSG']."</div>";	}elseif($isSuccess == OPERATION_FAIL){		$err .= "<div class='error'>".$_lang['tbl_slack_users'][$action]['FAILURE_MSG']."</div>";	}elseif($isSuccess == OPERATION_DUPLICATE){		$err .= "<div class='error'>".$_lang['tbl_slack_users'][$action]['DUPLICATE_MSG']."</div>";	}}//..if	$result_found=0;	$tbl_slack_userslist = $objtbl_slack_users->readArray(array(OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on),$result_found,1);	$allpageCount = 0;	$currentPage = 0;	$smarty->assign('pagination',biz_pagination(array("url"=>$navigationURL,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset,"count"=>$result_found),$allpageCount,$currentPage));	$smarty->assign('allpageCount',$allpageCount);	$smarty->assign('currentPage',$currentPage);	$smarty->assign('tbl_slack_userslist', $tbl_slack_userslist);	$smarty->assign('result_found',$result_found);	//$template = "tbl_slack_users/tbl_slack_users.tpl";grid	$template = "tbl_slack_users/grid.tpl";	if (is_not_empty($mode)){		if(($mode == MODE_VIEW || $mode==MODE_UPDATE) && is_gt_zero_num($slkusr_id)){			$tbl_slack_usersinfo= $objtbl_slack_users->GetInfo($slkusr_id);			$smarty->assign('tbl_slack_usersinfo',$tbl_slack_usersinfo);			if($mode==MODE_UPDATE){				$smarty->assign("isUpdate",1);			}			$template = "tbl_slack_users/view.tpl";		}elseif($mode == MODE_CREATE){			$template = "tbl_slack_users/create.tpl";					}}	$smarty->assign('page_url', $url);	$smarty->assign('navigationURL',$navigationURL);	$smarty->assign('new_sort',$new_sort);	$smarty->assign('active_page',$active_page);/*}else{	$template="index.tpl";}*/include_once("footer.php");?>