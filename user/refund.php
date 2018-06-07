<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
include('header.php');
$title = $_lang['home'];
//$template = 'index.tpl'; 
//$smarty->assign('active_page','login');
$template = 'online_store.tpl';
$smarty->assign('active_page','online_store');
	
$restaurant = get_input('restaurant');
$url = $website.'/user/tbl_menu.php'; 

//..do processing for the posted variables	
//if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE])){ 
 if(is_gt_zero_num($restaurant)){
 	  $_SESSION[SES_RESTAURANT] =$restaurant;
	  $rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);		 
	  if(is_not_empty($rest_info)){
	    if((is_gt_zero_num($rest_info[RESTAURENT_IS_PAYPAL])) && (is_not_empty($rest_info[RESTAURENT_PAYPAL_EMAIL]))){
			$_SESSION[SES_PAYPAL_EMAIL] = $rest_info[RESTAURENT_PAYPAL_EMAIL];								
		  }	
			$_SESSION[SES_RESTNT_NM] =$rest_info[RESTAURENT_NAME];	
	  }
  	unset($rest_info);		
		biz_script_forward($website.'/user/tbl_menu.php?online_store=1&menu_restaurent='.$restaurant);
 }else{ 
 	$restaurant_list =  tbl_restaurent::readArray(array('isActive'=>1),$result_found); 
	$smarty->assign('result_found',$result_found);
	$smarty->assign('restaurant_list',$restaurant_list);
	if($sesslife==true){
		if($Global_member['member_role_id']!=ROLE_CUSTOMER){
			$template = 'index.tpl';
			$smarty->assign('active_page','index'); 	
		}			
	} 	
 } 
 if($_SESSION['qr_sess_expired']){
 		unset($_SESSION['qr_sess_expired']);	
 } 
/*}else{ 
  $template = 'index.tpl';
}*/
 
/*$breadcrumbs = array(array('link'=>$website,'title'=>$_lang['main']['landing_page_title']));*/
include_once('footer.php');   
?>