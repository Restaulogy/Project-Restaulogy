<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$active_page= get_input('active_page','table_layout');

//$active_page = 'table_layout';

if($sesslife==true){
	$filter_params=array('latestOnly'=>1);
	//..based on the role show the tables assigned to him
	if($Global_member['member_role_id']== ROLE_WAITER){
		$emp_avial_tbl_lst=GetEmpTables($Global_member['member_id']);
		if(is_not_empty($emp_avial_tbl_lst)==false){
			$tables=array();//no tables available
		}else{
			$serv_tables=implode(',',$emp_avial_tbl_lst);
			$tables = tbl_dining_table::readArray(array(TABLE_ID=>$serv_tables,TABLE_RESTAURANT=>$_SESSION[SES_RESTAURANT]));
			$filter_params[TBL_STS_LNK_TABLE_ID]=$serv_tables;			
		}
	}else{
		$tables = tbl_dining_table::readArray(array(TABLE_RESTAURANT=>$_SESSION[SES_RESTAURANT])); 
	}		
	//$tables = tbl_dining_table::readArray(array(TABLE_RESTAURANT=>$_SESSION[SES_RESTAURANT])); 
	$availtables = tbl_table_customer_session::getLiveSessTables(TRUE);
	//..get the table statuslink data
	$result_found=0;
	$objtbl_table_status_link=new tbl_table_status_link();
	$tbl_table_status_linklist = $objtbl_table_status_link->readArray($filter_params,$result_found,1);
	
	//...Code for the status picker
	//...START STATUS PICKER
	//..STATUS PICKER ADDITION
	if(is_not_empty($tbl_table_status_linklist)){ 		
		$info=array();
		foreach($tbl_table_status_linklist as $link){		
			$info[$link['tbl_sts_lnk_id']] = $link;
			//$info[$link['tbl_sts_lnk_id']]['customer_session'] = tbl_table_customer_session::GetInfo($link['tbl_sts_lnk_session_id']);	
			 $info[$link['tbl_sts_lnk_id']]['status'] =  tbl_table_status::GetInfo($link['tbl_sts_lnk_status_id']);		
			//$info[$link['tbl_sts_lnk_id']]['table'] =  tbl_dining_table::GetInfo($link['tbl_sts_lnk_table_id']);		
		 }		 
  }
	if(is_not_empty($info)){
			 	$tbl_table_status_linklist=$info;
	}
	//..END STATUS PICKER ADDITION
	$lst_table_status = tbl_statuses::getStatusPickerValues();
	$smarty->assign('lst_table_status', $lst_table_status);
	$reverse_lst_table_status =array();
	if(is_not_empty($lst_table_status)){
		$reverse_lst_table_status = array_reverse($lst_table_status,true);
	}	
	$smarty->assign('reverse_lst_table_status', $reverse_lst_table_status);	 
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
	//...END STATUS PICKER
	
	//print_r($sts_avail_key);	
 
	$gridtable= array();
	$divtables= array();
	foreach($tables as $table){
		
		if(($table['table_pos_x'] == -1) && ($table['table_pos_y'] == -1)){
			$divtables[$table['table_id']] = $table;
		}else{  
				 //$img_src[] = table_layout::display($,$person,$text)	;
//			 $img_str = file_get_contents($website.'/ajax/getImageSrc.php?var1='.$table['table_seating_capacity'].'&var2=2&var3=dddd',true);
//			die($img_str);  
				/*$tbl_layouts[$table['table_id']] = table_layout::display($table['table_seating_capacity'],0,$table['table_number'],'tbl_layout_'.$table['table_id']);*/ 
				$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']] = $table; 
				if(is_not_empty($availtables[$table['table_id']])){
				  
					$tbl_layouts[$table['table_id']] = table_layout::display($table['table_seating_capacity'],$availtables[$table['table_id']]['tbl_cust_sess_party_size'],$table['table_number'],'tbl_layout_'.$table['table_id']);
					$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']]['notifications'] =  tbl_alerts::isNewAlert_tabletypebased($table['table_id']) ;
					
					/*
					$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']]['general'] =  tbl_alerts::isNewAlert_tabletypebased($table['table_id'],ALERT_FILTER_GENERAL) ;
					$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']]['request'] =  tbl_alerts::isNewAlert_tabletypebased($table['table_id'],ALERT_FILTER_REQUEST); 
					$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']]['order'] =  tbl_alerts::isNewAlert_tabletypebased($table['table_id'],ALERT_FILTER_ORDER); 
					$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']]['promotion'] =  tbl_alerts::isNewAlert_tabletypebased($table['table_id'],ALERT_FILTER_PROMOTION);
					*/
					  
					$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']]['customer_session']= $availtables[$table['table_id']]['tbl_cust_sess_id'];  
				} 
				$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']]['image'] = $img_str;
				
				if(is_not_empty($tbl_table_status_linklist)){
					 $fnd_item=biz_mult_arr_searchForId($tbl_table_status_linklist,TBL_STS_LNK_TABLE_ID,$table['table_id']);
					 if(is_not_empty($fnd_item)){
					 		$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']]['tbl_status_lnk']=$tbl_table_status_linklist[$fnd_item];		
					 }			 		 
				}
		} 
	}  
	//print_r($gridtable);
	
	$smarty->assign('tbl_layouts',$tbl_layouts);
	$smarty->assign('gridtable', $gridtable);
	$smarty->assign('divtables', $divtables);
	$smarty->assign('page_url', $url);
	$smarty->assign('navigationURL',$navigationURL);
	$smarty->assign('new_sort',$new_sort);
	$smarty->assign('active_page',$active_page);
	$smarty->assign('curr_pg_nm','table_layout');
	//$template='dining_table_layout.tpl';
	$template='tbl_table_layout/dining_table_layout.tpl';
	
	$breadcrumbs[] = array(
					 	'link'=>$website.'/user/dining_table_layout.php',
						'title'=>$_lang['tbl_dining_table']['layout']); 
}else{
	$template='index.tpl';
} 

include_once('footer.php');
?>