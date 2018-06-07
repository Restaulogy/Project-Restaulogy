<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$active_page = 'tbl_emp_shift_assignment';
 
if($sesslife==true){
 
$emp_sft_id= get_input('emp_sft_id');
$emp_sft_employee= get_input('emp_sft_employee');
$emp_sft_shift= get_input('emp_sft_shift');
$emp_sft_date= get_input('emp_sft_date');
$emp_sft_tables= get_input('emp_sft_tables');
$emp_sft_start_date= get_input('emp_sft_start_date');
$emp_sft_end_date= get_input('emp_sft_end_date');
$src_dt= get_input('src_dt');
$dsr_dt= get_input('dsr_dt'); 
$src_wk= get_input('src_wk');
$dsr_wk= get_input('dsr_wk'); 
$dsr_dtfrom= get_input('dsr_dtfrom'); 
$dsr_dtto= get_input('dsr_dtto'); 
$dt = get_input('dt','now');
list($dflt_start_date, $dflt_end_date) = x_week_range(date('Y-m-d',strtotime($dt)));
$from_date= get_input('from_date',$dflt_start_date);
$to_date= get_input('to_date',$dflt_end_date);

$action = strtoupper(get_input(ACTION_TITLE));
$mode = strtoupper(get_input(MODE_TITLE));
$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);
$sort_on = get_input(SORT_ON,'emp_sft_id');
$sort_by=$new_sort='';
biz_set_sorting_var($sort_by,$new_sort);
$url = $website.'/user/tbl_emp_shift_assignment.php'; 
$navigationURL = $url.'?'.SORT_ON.'='.$sort_on.'&'.SORT_BY.'='.$sort_by;
$isSuccess = '';
$objtbl_emp_shift_assignment= new tbl_emp_shift_assignment();
 
/**#start of for copy date *********************/ 
	if(is_not_empty($dsr_dt)==false){ 
			if(is_not_empty($dsr_dtfrom) && is_not_empty($dsr_dtto)){
				$dsr_dt = array();
				$new_src = array();
				$dsr_dtfrom = strtotime($dsr_dtfrom); 
				$dsr_dtto = strtotime($dsr_dtto);
		/*print_r($info);*/
		$i = $dsr_dtfrom;
		$cnt = 0;
		while($i<=$dsr_dtto) {
			 $dsr_dt[$cnt] = date('Y-m-d', $i);
			 $new_src[$cnt]= $src_dt;
			 $i = strtotime('+1 day',$i); 
			 $cnt++;
		 } 
		 $src_dt = $new_src;	
		/* 
		 print_r($src_dt);
		 print_r($dsr_dt);
		 exit;
		 */
		}elseif(is_not_empty($dsr_wk) && is_not_empty($src_wk)){
			/*$dsr_dt = biz_getWeekdays($dsr_wk);	 
			$src_dt = biz_getWeekdays($src_wk);		 */
			$dsr_wk = biz_explode(',',$dsr_wk);
	 	/*print_r($dsr_wk);
		print_r($src_wk);*/
			$new_dsr_dts = array();
			foreach($dsr_wk as $wk_val){
				$new_dsr_dts[$wk_val] = biz_getWeekdays($wk_val);
			}			
			$new_src_dt = biz_getWeekdays($src_wk);
				$dsr_dt = array();
				$src_dt = array();
				$cnt = 0;
			 
			foreach($new_dsr_dts as $wkdayKey=>$wkdayVal){
				 foreach($wkdayVal as $dayKey=>$dayVal){
				 	//echo $dayKey.'<br>';
				 	$dsr_dt[$cnt] = $dayVal;
					$src_dt[$cnt] = $new_src_dt[$dayKey];
					$cnt++;
				 }
			}  
		}
		 	
 } 
/*#end of for copy date ********************/
if(is_not_empty($action)){
	switch($action){
		case 'COPY_EMP_SFT_BY_DT':		 
				$isSuccess = $objtbl_emp_shift_assignment->copy_emp_shft_byDay($src_dt,$dsr_dt,1);
				break;
				
		case ACTION_CREATE: 
			$isSuccess = $objtbl_emp_shift_assignment->create($emp_sft_employee, $emp_sft_shift, $emp_sft_date, $emp_sft_tables, $emp_sft_start_date, $emp_sft_end_date);
			break;
			
		case ACTION_UPDATE: 
			$isSuccess = $objtbl_emp_shift_assignment->update($emp_sft_id, $emp_sft_employee, $emp_sft_shift, $emp_sft_date, $emp_sft_tables, $emp_sft_start_date, $emp_sft_end_date);
			break;
			
		case ACTION_DELETE: 
			$isSuccess = $objtbl_emp_shift_assignment->delete(array(EMP_SFT_ID=>$emp_sft_id));
			break;
			
		case ACTION_ACTIVATE: 
			$isSuccess = $objtbl_emp_shift_assignment->activate($emp_sft_id);
			break;
			
		case ACTION_DEACTIVATE: 
			$isSuccess = $objtbl_emp_shift_assignment->deactivate($emp_sft_id);
			break;
	}//..switch
}//..if

if(is_not_empty($isSuccess)){
	if(is_gt_zero_num($isSuccess)){
		$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['tbl_emp_shift_assignment'][$action]['SUCCESS_MSG'].'</div>';
	}elseif($isSuccess == OPERATION_FAIL){
		$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['tbl_emp_shift_assignment'][$action]['FAILURE_MSG'].'</div>';
	}elseif($isSuccess == OPERATION_DUPLICATE){
		$_SESSION[SES_FLASH_MSG] = '<div class="info">'.$_lang['tbl_emp_shift_assignment'][$action]['DUPLICATE_MSG'].'</div>';
	}
}//..if


	$result_found=0;
	$tbl_emp_shift_assignmentlist = $objtbl_emp_shift_assignment->readArray(array(OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on,SES_RESTAURANT=>$_SESSION[SES_RESTAURANT]),$result_found,1);
	

	$allpageCount = 0;
	$currentPage = 0;
	$smarty->assign('pagination',biz_pagination(array("url"=>$navigationURL,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset,"count"=>$result_found),$allpageCount,$currentPage));
	$smarty->assign('allpageCount',$allpageCount);
	$smarty->assign('currentPage',$currentPage);
	$smarty->assign('tbl_emp_shift_assignmentlist', $tbl_emp_shift_assignmentlist);
	$smarty->assign('result_found',$result_found);
	$template = 'tbl_emp_shift_assignment/tbl_emp_shift_assignment.tpl';

	if (is_not_empty($mode)){
		if(($mode == MODE_VIEW || $mode==MODE_UPDATE) && is_gt_zero_num($emp_sft_id)){
			$tbl_emp_shift_assignmentinfo= $objtbl_emp_shift_assignment->GetInfo($emp_sft_id);
			$smarty->assign('tbl_emp_shift_assignmentinfo',$tbl_emp_shift_assignmentinfo);
			if($mode==MODE_UPDATE){
				$smarty->assign('isUpdate',1);
			}
			$template = 'tbl_emp_shift_assignment/view.tpl'; 
		}elseif($mode == MODE_CREATE){
			$template = 'tbl_emp_shift_assignment/create.tpl';
 		} 
}

 
	$template = 'tbl_emp_shift_assignment/shift_assign.tpl';
	/*$breadcrumbs[] = array(
				 	'link'=>$website.'/user/pref_mng_cntrols.php',
					'title'=>$_lang['main']['pref_mng_cntrls']);
	$breadcrumbs[] = array(
				 	'link'=>$website.'/user/tbl_shift.php',
					'title'=>$_lang['tbl_table_shift_assignment']['short_title']);
 	$breadcrumbs[] = array(
				 	'link'=>$website.'/user/tbl_emp_shift_assignment.php',
					'title'=>$_lang['tbl_emp_shift_assignment']['listing_title']);*/
					
	$daywise_rpt = tbl_shift_weekdays::getdayWiseShifts(date($from_date),date($to_date)); 
	$smarty->assign('tablelist', tbl_dining_table::GetActiveDiningTables());
	//$smarty->assign('employeelist',GetShiftEmployees());
 	$smarty->assign('shiftlist',tbl_shift::readArray(array(SHIFT_RESTAURENT=>$_SESSION[SES_RESTAURANT],'isActive'=>1)));
	 $smarty->assign('curr_shift',tbl_shift::getCurrentShift());
	$smarty->assign('daywise_rpt',$daywise_rpt);
	$smarty->assign('from_date',$from_date);
	$smarty->assign('to_date',$to_date);
	$smarty->assign('page_url', $url);
	$smarty->assign('navigationURL',$navigationURL);
	$smarty->assign('new_sort',$new_sort);
	$smarty->assign('active_page',$active_page); 
}else{
	$template='index.tpl';
} 
include_once('footer.php');
?>