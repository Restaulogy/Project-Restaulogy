<?php 

include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

 if($sesslife == true && ($Global_member['member_role_id'] == ROLE_ADMIN) || $Global_member['member_role_id'] == ROLE_OWNER || $Global_member['member_role_id'] == ROLE_DEV){
 	 $template = 'pref_mng_cntrols.tpl';
 }elseif($sesslife == true && ($Global_member['member_role_id'] == ROLE_MANAGER)){
 	 //$template = 'pref_mng_cntrols_manager.tpl';
 	 $template = 'pref_mng_cntrols.tpl';
 }else{
 	$_SESSION['disp_msg'] = '<div class="error">'.$_lang['main']['not_allowed'].'</div>';
	$template = 'index.tpl';
}

$breadcrumbs = array( 
					 array(
					 	'link'=>$website.'/user/pref_mng_cntrols.php',
						'title'=>$_lang['main']['pref_mng_cntrls']) 
					); 

include_once('footer.php');  
?>