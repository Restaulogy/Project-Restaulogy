<?php
//..display the popup messages
if(is_not_empty($_SESSION['disp_msg'])){
	$smarty->assign('disp_msg', $_SESSION['disp_msg']);
	unset($_SESSION['disp_msg']);
}

$smarty->assign('EMP_PG_REFRESH_SEC',EMP_PG_REFRESH_SEC); 
$smarty->assign('active_page',$active_page);
$smarty->assign('error_msg',$err);
$smarty->assign('sesslife', $sesslife); 
$smarty->assign('breadcrumbs',$breadcrumbs); 
$smarty->assign('search_text',$search_text);

$smarty->assign('biz_sort_on', $sort_on);
$smarty->assign('biz_sort_by', $sort_by); 

$smarty->display($template); 
?>