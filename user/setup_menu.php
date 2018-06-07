<?php 

include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

 if($sesslife == true){
 	 $template = 'setup_menu.tpl';
 }else{
	$template = 'index.tpl';
}

$breadcrumbs = array(array(
					 	'link'=>$url,
						'title'=>$_lang['main']['set_up_menu']['title'])
					); 

include_once('footer.php');
?>