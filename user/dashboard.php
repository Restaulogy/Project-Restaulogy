<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$frm_qrcd = get_input('frm_qrcd',0);
$is_demo_usr = get_input('is_demo_usr',0);
$frm_scnd_rdrt = get_input('frm_scnd_rdrt',0);

 //..If new QRCode start the new table session
 $pst_table_id= get_input('table_id',0);
 if(is_gt_zero_num($pst_table_id)){
	$_SESSION[SES_TABLE] =$pst_table_id;
 }else{
	$pst_table_id = $_SESSION[SES_TABLE];
 }
 if(is_gt_zero_num($frm_qrcd)){ 		
 	unset($_SESSION['qr_sess_expired']);	
	checkNcreateUserCookieId_QRCODE();		
 	//..Now in this case the customer should be logged out if he is,
	//..If previous cookie rest and current rest not matching then delete previous all cookies as well
	$tbl_info = tbl_dining_table::GetInfo($pst_table_id);
	if((is_gt_zero_num($tbl_info['table_restaurant'])) && (isset($_COOKIE['authrest'])) && ($_COOKIE['authrest']!=$tbl_info['table_restaurant'])){
		LogMeOut(1);
 	}else{
		$_really_del_reqd=reallyForceDelete(0);
		LogMeOut($_really_del_reqd);
	}
	biz_script_forward($website.'/user/dashboard.php?table_id='.$pst_table_id.'&is_demo_usr='.$is_demo_usr.'&frm_scnd_rdrt=1');
 }
 
 add_demo_usr_to_see($is_demo_usr);
 
if(is_gt_zero_num($pst_table_id) || is_gt_zero_num($_SESSION[SES_TABLE])){

  //..Check the user is logged in or
  $_SESSION[SES_TABLE] = $pst_table_id;
  $tbl_info = tbl_dining_table::GetInfo($pst_table_id);
  $_SESSION[SES_RESTAURANT] = $tbl_info['table_restaurant'];
  $rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
	$_SESSION[SES_RESTNT_NM] =$rest_info[RESTAURENT_NAME];
  if(is_not_empty($rest_info)){
    if((is_gt_zero_num($rest_info[RESTAURENT_IS_PAYPAL])) && (is_not_empty($rest_info[RESTAURENT_PAYPAL_EMAIL]))){
		$_SESSION[SES_PAYPAL_EMAIL] = $rest_info[RESTAURENT_PAYPAL_EMAIL];
	} 
  } 
  $smarty->assign('table_id',$pst_table_id); 
	 
  add_demo_usr_to_see($is_demo_usr);
   
  if(is_gt_zero_num($frm_scnd_rdrt)){
    	biz_script_forward($website.'/user/dashboard.php?table_id='.$pst_table_id.'&is_demo_usr=0');
  }	 

  unset($_SESSION['qr_sess_expired']);
  $template = 'dashboard.tpl';
	
  unset($rest_info);
  unset($tbl_info);
	
}else{
  $_SESSION[SES_TABLE] = 0; 
  $template = 'index.tpl';
}
//..get the theme selected
if(is_gt_zero_num($_SESSION[SES_RESTAURANT])){
	$tbl_landing_pageinfo=tbl_landing_page::GetInfo(0,$_SESSION[SES_RESTAURANT]);
	$smarty->assign('tbl_landing_pageinfo',$tbl_landing_pageinfo);
}

$smarty->assign('active_page','dashboard');
include_once('footer.php');  
?>