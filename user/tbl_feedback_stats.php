<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$active_page = 'tbl_dishes';

if($sesslife==true){

//..functionlity for seaching the table stastus
$fts_graph_type = get_input('fts_graph_type',0);
$fts_is_restaurant = get_input('fts_is_restaurant',1);
$fts_server = get_input('fts_server','');
$fts_customer = get_input('fts_customer','');
$fts_menu = get_input('fts_menu','');
$fts_table = get_input('fts_table','');
//..condition to show for only todays and yesterday bydefualt
/*$fts_start_date = get_input('fts_start_date',date('m/d/Y',strtotime("-30 day")));
$fts_end_date = get_input('fts_end_date',date('m/d/Y'));*/
$fts_start_date= get_input("fts_start_date",date('m/01/Y'));
$fts_end_date= get_input("fts_end_date",date('m/t/Y'));

$time_period 	= get_input('time_period','monthly');
//$fts_start_date = get_input('fts_start_date');
//$fts_end_date = get_input('fts_end_date');

$action = strtoupper(get_input(ACTION_TITLE));
$mode = strtoupper(get_input(MODE_TITLE));
$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);
$sort_on = get_input(SORT_ON,'dish_id');
$is_preview = get_input('is_preview',0);

$sort_by=$new_sort='';
biz_set_sorting_var($sort_by,$new_sort);
//$url = $website.'/user/tbl_feedback_stats.php';
//$navigationURL = $url.'?'.SORT_ON.'='.$sort_on.'&'.SORT_BY.'='.$sort_by;
$url = $website.'/user/tbl_dishes.php';
$navigationURL = $website.'/user/tbl_feedback_stats.php?'.SORT_ON.'='.$sort_on.'&'.SORT_BY.'='.$sort_by;

$isSuccess = '';
//.. Unset the session stored value of the menu 
if($is_preview==0){ 
	 unset($_SESSION[SES_DISH]);
}


$objtbl_dishes= new tbl_dishes();

	$result_found=0;
	
	$search_arr = array();
	$search_arr[OFFSET_TITLE]  = $offset;
	$search_arr[LIMIT_TITLE]  = $limit;
	$search_arr[SORT_BY]  = $sort_by;
	$search_arr[SORT_ON]  = $sort_on;
	$search_arr[FDBK_RESTAURENT]  = $_SESSION[SES_RESTAURANT];
	if(is_gt_zero_num($fts_is_restaurant)==false){
		$search_arr['isActive']  = 1;
		$search_criteria[] = 'Dish Rating:';
	}else{
		$search_criteria[] = 'Restaurant Rating:';
	}		
	
	if(is_not_empty($fts_menu)){
		$search_arr[DISH_ID] = $fts_menu;
		$tmp_mnuitem_info =  tbl_dishes::GetInfo($fts_menu);
		$navigationURL .='&fts_menu='.$fts_menu;
	  $search_criteria[] = 'Menu Item like \''.$tmp_mnuitem_info[DISH_NAME].'\'';
		unset($tmp_mnuitem_info);
	}
	
	if(is_not_empty($fts_table)){
		$search_arr[RECOMM_TABLE] = $fts_table;
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

/*	if(is_gt_zero_num($fts_is_restaurant)){
		$sql="SELECT f.*,AVG(`f`.`recomm_rating`) `star_rating`  
					FROM `tbl_feedback` as `f` 				
					WHERE
					`post_type`='Business' {$qry} 
					GROUP BY `post_id` 
					ORDER BY `star_rating` DESC";
		$tbl_disheslist = DB::ExecQry($sql);
	}else{
		$tbl_disheslist = $objtbl_dishes->readArray_fdk($search_arr,$result_found,1,$fts_is_restaurant);
	}	
	*/
	$tbl_disheslist = $objtbl_dishes->readArray_fdk($search_arr,$result_found,1,$fts_is_restaurant);
	
	if(is_gt_zero_num($fts_is_restaurant)){
		$report_img =	$objtbl_dishes->rpt_show_graph($time_period,$_SESSION[SES_RESTAURANT],$fts_start_date,$fts_end_date,$fts_table,0,$fts_graph_type);
		$smarty->assign('report_img',$report_img);
		
		$report_img_overall =	$objtbl_dishes->rpt_show_graph($time_period,$_SESSION[SES_RESTAURANT],$fts_start_date,$fts_end_date,$fts_table,1,$fts_graph_type);
		$smarty->assign('report_img_overall',$report_img_overall);
	}
	//print_r($tbl_disheslist);
	
	$allpageCount = 0;
	$currentPage = 0;
	$smarty->assign('pagination',biz_pagination(array('url'=>$navigationURL,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset,'count'=>$result_found),$allpageCount,$currentPage));
	$smarty->assign('allpageCount',$allpageCount);
	$smarty->assign('currentPage',$currentPage);
	$smarty->assign('tbl_disheslist', $tbl_disheslist);
	$smarty->assign('result_found',$result_found);
	$template = 'tbl_feedback/tbl_dishes.tpl';
	$breadcrumbs[] = array(
					 	'link'=>$website.'/user/pref_mng_cntrols.php',
						'title'=>$_lang['main']['pref_mng_cntrls']);
	$breadcrumbs [] =   array(
						 	'link'=>$website.'/user/tbl_feedback_stats.php',
							'title'=>$_lang['tbl_feedback']['listing_title']);

	if (is_not_empty($mode)){
		if(($mode == MODE_VIEW || $mode==MODE_UPDATE || $mode=='LIST') && is_gt_zero_num($dish_id)){
			/*$tbl_dishesinfo= $objtbl_dishes->GetInfo($dish_id); 
			if(is_not_empty($tbl_dishesinfo)){
			$breadcrumbs[] =  array(
						 	'link'=>$url.'?'.MODE_TITLE.'='.MODE_VIEW.'&'.DISH_ID.'='.$dish_id,
							'title'=>$tbl_dishesinfo['dish_name'].getModeSubTitle($mode));
				$tbl_dishesinfo['dish_options'] = tbl_dish_options::readArray(array(DISH_OPT_DISH_ID=>$dish_id));
				//print_r($tbl_dishesinfo['dish_options']);
			
				$tbl_dishesinfo['submenu'] = tbl_submenu_dishes::readArray(array(SBMNU_DISH_DISH=>$dish_id));	
				//print_r($tbl_dishesinfo['submenu']); 
				$menulist = tbl_menu::GetFields(array('key_field'=>MENU_ID,'value_field'=>MENU_NAME));
				$smarty->assign('menulist',$menulist);
				$smarty->assign('tbl_dishesinfo',$tbl_dishesinfo);
				//print_r($tbl_dishesinfo);
			}			 
			if($mode==MODE_UPDATE){
				$smarty->assign('isUpdate',1);
			}			
			if($mode=='LIST'){
				$template = 'tbl_dishes/list.tpl';
			}else{
				$template = 'tbl_dishes/view.tpl';	
			}*/
		}elseif($mode == MODE_CREATE){
			$template = 'tbl_dishes/create.tpl';
		}
}

	$tbl_lst=tbl_dining_table::GetFields(array("key_field"=>TABLE_ID,"value_field"=>TABLE_NUMBER,"isActive"=>1));
	
	//..Get the sub menu dish list only for search		
	$tbl_submenu_disheslist = tbl_submenu_dishes::getAllSubMnuDishes();	
	$smarty->assign('submenu_disheslist',$tbl_submenu_disheslist); 
	
 	$smarty->assign('tables',$tbl_lst);
	
	$smarty->assign('page_url', $url);
	$smarty->assign('navigationURL',$navigationURL);
	$smarty->assign('new_sort',$new_sort);	
	$smarty->assign('active_page',$active_page);	
	$search_text=implode(',',$search_criteria);
	$smarty->assign('search_text',$search_text);
	$smarty->assign('fts_is_restaurant',$fts_is_restaurant);
	$smarty->assign('time_periods', statistics::getTimeFeedbackPeriods()); 
	$smarty->assign('time_period', $time_period);	
	
	$smarty->assign('fts_start_date',$fts_start_date);
	$smarty->assign('fts_end_date',$fts_end_date);
	$smarty->assign('fts_graph_type',$fts_graph_type);	
	 

}else{
	$template='index.tpl';
}

include_once('footer.php');

?>