<?php
	include('../init.php');
	include('header.php');
	$active_page = 'paypal_result'; 
	$is_success = get_input('is_success',0);
	if(is_gt_zero_num($is_success)){
		$result = 'success';
	}else{
		$result = 'error';
	} 
	
	$smarty->assign('result',$result);
 
  $template = 'paypal_result.tpl';
  include('footer.php');
?>