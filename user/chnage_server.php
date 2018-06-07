<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$chng_serv_id= get_input('chng_serv_id',0);

if(is_gt_zero_num($chng_serv_id)){
	$result=get_user_auth($chng_serv_id);
	if($result){
		biz_script_forward($website.'/user/tbl_alerts.php');
	}
}else{
	$_SESSION[SES_FLASH_MSG]='<div class="success">Please select the server to change.</div>';
}
$smarty->assign('active_page','index');
$template = 'index.tpl';
include_once('footer.php');  
?>