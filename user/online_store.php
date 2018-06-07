<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$_SESSION[SES_ONLINE_STORE] = 1; 
$restaurant = get_input('restaurant');
$url = $website.'/user/tbl_menu.php'; 
	
if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE])){ 
 if(is_gt_zero_num($restaurant)){
 	 $_SESSION[SES_RESTAURANT] =$restaurant;
	  $rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
		 
	  if(is_not_empty($rest_info)){
	    if((is_gt_zero_num($rest_info[RESTAURENT_IS_PAYPAL])) && (is_not_empty($rest_info[RESTAURENT_PAYPAL_EMAIL]))){
			$_SESSION[SES_PAYPAL_EMAIL] = $rest_info[RESTAURENT_PAYPAL_EMAIL];
		  } 
	  }
  	unset($rest_info);
		biz_script_forward($website.'/user/tbl_menu.php?online_store=1&menu_restaurant='.$restaurant);
 }else{ 
 	$restaurant_list =  tbl_restaurent::readArray(array('isActive'=>1),$result_found); 
	$smarty->assign('result_found',$result_found);
	$smarty->assign('restaurant_list',$restaurant_list);
 	$template = 'online_store.tpl';
 } 
}else{ 
  $template = 'index.tpl';
}
$smarty->assign('active_page','online_store');
include_once('footer.php');  
?>