<?php
ini_set('max_execution_time', 0);

include("../init.php");
include("header.php");

//$ETHOR_STORE=$_SESSION['curr_restant'][RESTAURENT_ETHOR_STORE];
 

$action= get_input('action','');
$is_allowed_import=1;
//..If ethor store id is present then only carry out the import
/*if(is_not_empty($_SESSION['curr_restant'][RESTAURENT_ETHOR_STORE])){
	if($action=='import'){*/
		$obj_ethor_api=new ethor_api();	
		//$menu_list=$obj_ethor_api->_import_menu();
		$menu_list=$obj_ethor_api->_fetch_menu();
		//print_r($menu_list);

		$_SESSION[SES_FLASH_MSG] = '<div class="success">Import successful</div>';
	//}	
	//echo $menu_list;
/*}else{
	//echo "Restaurant is not recognized as ethore store";
	$_SESSION[SES_FLASH_MSG] = '<div class="error">Restaurant is not recognized as ethore store</div>';
	$is_allowed_import=0;
}*/
$breadcrumbs[] = array(
					 	'link'=>$website.'/user/pref_mng_cntrols.php',
						'title'=>$_lang['main']['pref_mng_cntrls']);
$breadcrumbs[] = array(
						'link'=>$website.'/user/ethor_menu.php',
						'title'=>$_lang['main']['ethor']['import']); 
						
$template='ethor_import.tpl';

$smarty->assign('menu_list',$menu_list);
$smarty->assign('is_allowed_import',$is_allowed_import);
												
include("footer.php");
?>