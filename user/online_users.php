<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$on_line_usr=$session->get_users_online();
if(is_not_empty($on_line_usr)){
		$str_usr_lst=GetMembersFromIDs(implode(',',$on_line_usr));
		if(is_not_empty($str_usr_lst))
			$usr_lst=explode(',',$str_usr_lst);
}

$smarty->assign('active_page','online_users');
$smarty->assign('online_users',$usr_lst);
$template = 'online_users.tpl';
include_once('footer.php');  
?>