<?phpinclude_once(dirname(dirname(__FILE__))."/init.php");include_once("header.php");$member_role_id= get_input("member_role_id");$member_role_name= get_input("member_role_name");$member_role_start_date= get_input("member_role_start_date",date(DATE_FORMAT));$member_role_end_date= get_input("member_role_end_date");$action = strtoupper(get_input("action"));$mode = strtoupper(get_input("mode"));$offset = get_input("offset",0);$limit =  get_input("limit",10);$url = "{$website}/user/member_role.php";$isSuccess = "";$objmember_role= new member_role();if(is_not_empty($action)){	switch($action){		case "CREATE": 			$isSuccess = $objmember_role->create($member_role_name, $member_role_start_date, $member_role_end_date);			break;		case "UPDATE": 			$isSuccess = $objmember_role->update($member_role_id, $member_role_name, $member_role_start_date, $member_role_end_date);			break;		case "DELETE": 			$isSuccess = $objmember_role->delete(array(MEMBER_ROLE_ID=>$member_role_id));			break;		case "ACTIVATE": 			$isSuccess = $objmember_role->activate($member_role_id);			break;		case "DEACTIVATE": 			$isSuccess = $objmember_role->deactivate($member_role_id);			break;	}//..switch}//..ifif(is_not_empty($isSuccess)){	if(is_gt_zero_num($isSuccess)){		echo "<div class='info'>{$_lang['member_role']['".$action."']['SUCCESS_MSG']}</div>";	}else{		echo "<div class='error'>{$_lang['member_role']['".$action."']['FAILURE_MSG']}</div>";	}}//..if	$result_found=0;	$member_rolelist = $objmember_role->readArray(array("offset"=>$offset,"limit"=>$limit),$result_found,1);	$smarty->assign('pagination',biz_pagination(array("url"=>$url,"limit"=>$limit,"offset"=>$offset,"count"=>$result_found)));	$smarty->assign('member_rolelist', $member_rolelist);	$smarty->assign('result_found',$result_found);	$template = "member_role.tpl";		$breadcrumbs[] = array(					 	'link'=>$website.'/user/pref_mng_cntrols.php',						'title'=>$_lang['main']['pref_mng_cntrls']);	$breadcrumbs[] = array(					 	'link'=>$url,						'title'=>$_lang['member_role']['listing_title']);	if (is_not_empty($mode)){		if(($mode == "VIEW" || $mode=="UPDATE") && is_gt_zero_num($member_role_id)){			$member_roleinfo= $objmember_role->GetInfo($member_role_id);			$smarty->assign('member_roleinfo',$member_roleinfo);			if($mode=="UPDATE"){				$smarty->assign("isUpdate",1);			}			$template = "view_member_role.tpl";		}elseif($mode == "NEW"){			$template = "create_member_role.tpl";					}}	$smarty->assign('page_url', $url);include_once("footer.php");?>