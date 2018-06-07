<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php'); 

$frm_qrcd = get_input('frm_qrcd',0);
$cust_name = get_input('cust_name','');  
if(is_not_empty($cust_name)){
	$_SESSION[SES_CUST_NM]=$cust_name; 
}


	 
 //..QRcode redirection
 //..If new QRCode start the new table session
 if (is_gt_zero_num($frm_qrcd)){
 	//..clear the customer session 
	 
	$_SESSION[SES_QR] =$frm_qrcd; 
	 
	biz_script_forward($website.'/user/wait_dashboard.php'); 
 }else{  
		if(is_gt_zero_num($_SESSION[SES_QR])==FALSE)
			$smarty->assign('qr_sess_expired',1);
 }
 
 
//..check whether QR Code
if(is_gt_zero_num($isAllowNewQue)){
	if(is_gt_zero_num($_SESSION[SES_QR])){ 
  //..Check the user is logged in or 
  	$smarty->assign('page_url', $website.'/user/wait_dashboard.php');
    if(is_not_empty($_SESSION[SES_CUST_NM])){
		$ask_cust_name = 0;
	}else{ 
		$ask_cust_name = 1;	
	}
 
  $smarty->assign('ask_cust_name',$ask_cust_name);
  $template = 'wait_dashboard.tpl';   
 }else{ 
  $_SESSION['0'] = $frm_qrcd;
  $template = 'index.tpl';
 }
}else{
  $template = 'not_allowed.tpl'; 	
}

$smarty->assign('active_page','dashboard');
include_once('footer.php');  
?>