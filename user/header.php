<?php
include_once(dirname(dirname(__FILE__)).'/'.CLASS_DIRECTORY.'/Smarty/libs/Smarty.class.php');
$template = 'index.tpl'; 
$smarty = new Smarty();  
$smarty->template_dir = dirname(__FILE__) . '/templates/';
$smarty->compile_dir =  dirname(__FILE__)  . '/templates_c/';
/*$smarty->config_dir = $config['root'] . 'configs/';
$smarty->cache_dir = $config['root'] . 'cache/';*/
$back_url = $website;  
$search_criteria = array();
if((is_not_empty($_SERVER['HTTP_REFERER'])) && ($_SERVER['HTTP_REFERER'] != curPageURL())){
	$back_url = $_SERVER['HTTP_REFERER'] ;
}  
$isOnlineOrder ='0';  
if(isCustomer()){
	$smarty->assign('isCustomer',1); 
  if(is_gt_zero_num($_SESSION[SES_TABLE])){
  	$smarty->assign('custTableInfo',tbl_dining_table::GetInfo($_SESSION[SES_TABLE]));
  } 
  if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE]) && $isAllowOnlineOrder) $isOnlineOrder ='1'; 
}
$smarty->assign('isOnlineOrder',$isOnlineOrder);

//..Change resaturant title based on the rest. selected
$webtitle = (empty($_SESSION[SES_RESTNT_NM]) ? $webtitle : $_SESSION[SES_RESTNT_NM]); 
$smarty->assign('webtitle', $webtitle);
$smarty->assign(POPUP_WINDOW, get_input(POPUP_WINDOW,''));

$smarty->assign('back_url', $back_url);
$smarty->assign('website', $website);
$smarty->assign('tpl_path', $website.'/user/templates/');
$smarty->assign('_lang', $_lang);

$smarty->assign('username', $username); 
$smarty->assign('description', $description);
$smarty->assign('keywords', $keywords); 
$smarty->assign('isMenuActive',1);
if(is_not_empty($Global_member)){
	$smarty->assign('Global_member', $Global_member); 
}
if(is_not_empty($emp_tables)){
	$smarty->assign('emp_tables', $emp_tables); 
}
 
 $smarty->assign('show_url', modify_url(array('f_mode'=>'view'), current_url())); 

 
 	$tmp_cust_sess_id = checkNcreateSession($_SESSION[SES_TABLE]);
 
 	if(isCustomer() && is_gt_zero_num($_SESSION[SES_TABLE]) &&  is_not_empty($_SESSION[SES_CUST_NM])){
		$tmpcust_id = getCustomerId($tmpcust_type);
		$tmporder_id = tbl_orders::getCustLastOrder($_SESSION[SES_CUST_NM],$_SESSION[SES_TABLE],'',$tmp_cust_sess_id);
		 //echo $tmporder_id,$tmpcust_id,$tmpcust_type;
		if(is_gt_zero_num($tmporder_id)){
			$tmporder_details = tbl_order_details::getOrderDishToRate($tmporder_id,$tmpcust_id,$tmpcust_type);
			$Enum_Overall_Rating = tbl_feedback::Enum_OverAll_Rating();
			$smarty->assign('customer_order',$tmporder_id);
			$smarty->assign('Enum_Overall_Rating',$Enum_Overall_Rating); 
			$smarty->assign('tmporder_details',$tmporder_details);
			unset($tmporder_details); 
		}
		
		unset($tmporder_id); 
		unset($tmpcust_id); 
		unset($tmpcust_type); 
	} 
	$smarty->assign('tmp_customer_session',$tmp_cust_sess_id); 
  unset($tmp_cust_sess_id);
 
 //..Logic to change the server
  if(($sesslife==true) && ($Global_member['member_role_id']== ROLE_WAITER)){
		$curr_shift_servers=GetShiftEmployees();
		//print_r($curr_shift_servers);
		$smarty->assign('curr_shift_waiters',$curr_shift_servers); 
	}  
 
 $breadcrumbs = array();
?>