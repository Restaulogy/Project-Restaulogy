<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$active_page = 'table_layout';

if($sesslife==true){
	
	$tables = tbl_dining_table::readArray(array(TABLE_RESTAURANT=>$_SESSION[SES_RESTAURANT]));  
	$gridtable= array();
	$divtables= array();
	foreach($tables as $table){
		if(($table['table_pos_x'] == -1) && ($table['table_pos_y'] == -1)){
			$divtables[$table['table_id']] = $table;
		}else{
			$gridtable[$table['table_pos_x'].'_'.$table['table_pos_y']] = $table; 
			//echo $table['table_pos_x'].'_'.$table['table_pos_y'];
		} 
	}  
	//print_r($gridtable);
	//print_r($divtables);
	$smarty->assign('gridtable', $gridtable);
	$smarty->assign('divtables', $divtables);
	$smarty->assign('page_url', $url);
	$smarty->assign('navigationURL',$navigationURL);
	$smarty->assign('new_sort',$new_sort);
	$smarty->assign('active_page',$active_page);
	$template='tbl_table_layout/table_layout.tpl';
	
	$breadcrumbs[] = array(
					 	'link'=>$website.'/user/pref_mng_cntrols.php',
						'title'=>$_lang['main']['pref_mng_cntrls']);
	$breadcrumbs[] = array(
					 	'link'=>$url,
						'title'=>$_lang['tbl_dining_table']['listing_title']); 

}else{
	$template='index.tpl';
} 

include_once('footer.php');
?>