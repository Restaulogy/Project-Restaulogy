<?php 

include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

 if($sesslife == true && ($Global_member['member_role_id'] == ROLE_ADMIN || $Global_member['member_role_id'] == ROLE_MANAGER || $Global_member['member_role_id'] == ROLE_OWNER || $Global_member['member_role_id'] == ROLE_DEV)){
 	 $template = 'rest_dashboard.tpl';
 }else{
 	$_SESSION['disp_msg'] = '<div class="error">'.$_lang['main']['not_allowed'].'</div>';
	$template = 'index.tpl';
}

$breadcrumbs = array( 
					 array(
					 	'link'=>$website.'/user/rest_dashboard.php',
						'title'=>$_lang['main']['rest_dashboard']) 
					); 

include_once('footer.php');  
?>