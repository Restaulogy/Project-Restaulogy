<?phpinclude_once(dirname(dirname(__FILE__))."/init.php");include_once("header.php");$shift_id= get_input("shift_id");$shift_name= get_input("shift_name");$shift_restaurent = get_input(SHIFT_RESTAURENT,$_SESSION[SES_RESTAURANT]);$shift_start_time= get_input("shift_start_time");$shift_end_time= get_input("shift_end_time");$shift_created_on=get_input("shift_created_on");$shift_terminated_on=get_input("shift_terminated_on");//$shift_created_on= date("H:i:s", strtotime(get_input("shift_created_on")));//$shift_terminated_on= date("H:i:s", strtotime(get_input("shift_terminated_on")));$action = strtoupper(get_input(ACTION_TITLE));$mode = strtoupper(get_input(MODE_TITLE));$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);$url = "{$website}/user/tbl_shift.php";//..get list of selected items$sel_tbl_shift= get_input("sel_tbl_shift");$lst_sel_ids='';if(is_not_empty($sel_tbl_shift)){		$lst_sel_ids=implode(',', array_keys($sel_tbl_shift));}else{	$lst_sel_ids = $shift_id;}$sft_wkdy_avail=array();//..default values for all days don't show'$sft_wkdy_sunday=$sft_wkdy_monday=$sft_wkdy_tuesday=$sft_wkdy_wednesday=$sft_wkdy_thursday=$sft_wkdy_friday=$sft_wkdy_saturday='N';if(is_not_empty($_POST['sft_wkdy_avail'])){	$sft_wkdy_avail=$_POST['sft_wkdy_avail']; 	//print_r($sft_wkdy_avail);	//..capture the posted values in to the variables	foreach($sft_wkdy_avail as $val){		switch (strtoupper($val)) {			case 'SUN':			   $sft_wkdy_sunday='Y';			   			   break;			case 'MON':			   $sft_wkdy_monday='Y';			   break;			case 'TUE':			   $sft_wkdy_tuesday='Y';			   break;			case 'WED':			   $sft_wkdy_wednesday='Y';			   break;			case 'THU':			   $sft_wkdy_thursday='Y';			   break;			case 'FRI':			   $sft_wkdy_friday='Y';			   break;			case 'SAT':			   $sft_wkdy_saturday='Y';			   break;		}	}}$isSuccess = "";$objtbl_shift= new tbl_shift();$objtbl_shift_weekdays= new tbl_shift_weekdays();if(is_not_empty($action)){ 	switch($action){		case "CREATE": 			$isSuccess = $objtbl_shift->create($shift_name, $shift_start_time, $shift_end_time,$shift_restaurent,$shift_created_on,$shift_terminated_on);			if($isSuccess>0)				$isSuccess =$objtbl_shift_weekdays->create($isSuccess ,$sft_wkdy_sunday ,$sft_wkdy_monday ,$sft_wkdy_tuesday ,$sft_wkdy_wednesday ,$sft_wkdy_thursday ,$sft_wkdy_friday ,$sft_wkdy_saturday);						break;		case "UPDATE": 				$isSuccess = $objtbl_shift->update($shift_id, $shift_name, $shift_start_time, $shift_end_time,$shift_restaurent, $shift_created_on,$shift_terminated_on);			//..First check if the weekday's record is associated with this shift 			$cor_weekDay_rec=$objtbl_shift_weekdays->GetShiftInfo($shift_id);			if(is_gt_zero_num($isSuccess)){				if(is_not_empty($cor_weekDay_rec)){				//..record found update It					$isSuccess =$objtbl_shift_weekdays->update($cor_weekDay_rec["sft_wkdy_id"], $shift_id, $sft_wkdy_sunday, $sft_wkdy_monday, $sft_wkdy_tuesday, $sft_wkdy_wednesday, $sft_wkdy_thursday, $sft_wkdy_friday, $sft_wkdy_saturday);				}else{				//..no record found insert into db					$isSuccess =$objtbl_shift_weekdays->create($shift_id ,$sft_wkdy_sunday ,$sft_wkdy_monday ,$sft_wkdy_tuesday ,$sft_wkdy_wednesday ,$sft_wkdy_thursday ,$sft_wkdy_friday ,$sft_wkdy_saturday);				}			}						break;		case ACTION_DELETE: 			/*if(is_not_empty($lst_sel_ids)){				$isSuccess = $objtbl_shift->delete(array(SHIFT_ID=>$lst_sel_ids));			}else{				$err .="<div class='error'>".$_lang['main']['select_ids']['empty']."</div>";			}	*/					break;			/*case "DELETE": 			$isSuccess = $objtbl_shift->delete(array(SHIFT_ID=>$shift_id));			break;*/		case "ACTIVATE": 			//$isSuccess = $objtbl_shift->activate($shift_id);			if(is_not_empty($lst_sel_ids)){				//$isSuccess = $objtbl_shift->delete(array(SHIFT_ID=>$lst_sel_ids));				$isSuccess = $objtbl_shift->activate($lst_sel_ids);			}else{				$err .="<div class='error'>".$_lang['main']['select_ids']['empty']."</div>";			}					break;		case "DEACTIVATE": 			//$isSuccess = $objtbl_shift->deactivate($shift_id);			//$action = ACTION_DELETE;			if(is_not_empty($lst_sel_ids)){				//$isSuccess = $objtbl_shift->delete(array(SHIFT_ID=>$lst_sel_ids));				$isSuccess = $objtbl_shift->deactivate($lst_sel_ids);			}else{				$err .="<div class='error'>".$_lang['main']['select_ids']['empty']."</div>";			}					break;	}//..switch}//..if if(is_not_empty($isSuccess)){	if(is_gt_zero_num($isSuccess)){		$_SESSION[SES_FLASH_MSG] = "<div class='success'>".$_lang['tbl_shift'][$action]['SUCCESS_MSG']."</div>";	}elseif($isSuccess == OPERATION_FAIL){		$_SESSION[SES_FLASH_MSG] = "<div class='error'>".$_lang['tbl_shift'][$action]['FAILURE_MSG']."</div>";	}elseif($isSuccess == OPERATION_DUPLICATE){		$_SESSION[SES_FLASH_MSG] = "<div class='info'>".$_lang['tbl_shift'][$action]['DUPLICATE_MSG']."</div>";	}}//..if	$result_found=0;	$tbl_shiftlist = $objtbl_shift->readArray(array(OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SHIFT_RESTAURENT=>$_SESSION[SES_RESTAURANT]),$result_found,1);//print_r($tbl_shiftlist);	$smarty->assign('pagination',biz_pagination(array("url"=>$url,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset,"count"=>$result_found)));	$smarty->assign('tbl_shiftlist', $tbl_shiftlist);	$smarty->assign('result_found',$result_found);	$template = "tbl_shift/tbl_shift.tpl";	$breadcrumbs[] = array(				 	'link'=>$website.'/user/pref_mng_cntrols.php',					'title'=>$_lang['main']['pref_mng_cntrls']); 	$breadcrumbs[] = array(				 	'link'=>$website.'/user/tbl_shift.php',					'title'=>$_lang['tbl_table_shift_assignment']['short_title']);					 	$breadcrumbs[] =array(				 	'link'=>$url,					'title'=>$_lang['tbl_shift']['listing_title']); 	if (is_not_empty($mode)){		if(($mode == "VIEW" || $mode=="UPDATE") && is_gt_zero_num($shift_id)){			$tbl_shiftinfo= $objtbl_shift->GetInfo($shift_id);			if($tbl_shiftinfo){				$breadcrumbs[] =array(				 	'link'=>$url.'?'.MODE_TITLE.'='.$mode.'&shift_id='.$$tbl_shiftinfo['shift_id'] ,					'title'=>$tbl_shiftinfo['shift_name'].getModeSubTitle($mode)); 			}			$smarty->assign('tbl_shiftinfo',$tbl_shiftinfo);			if($mode=="UPDATE"){								$smarty->assign("isUpdate",1);			}			$template = "tbl_shift/view.tpl";		}elseif($mode == "NEW"){			$breadcrumbs[] =array(				 	'link'=>$url.'?'.MODE_TITLE.'='.$mode,					'title'=>$_lang['tbl_shift']['create_title']); 			$template = "tbl_shift/create.tpl";		}	}		//print_r($tbl_shiftinfo);		$smarty->assign('page_url', $url);	include_once("footer.php");?>