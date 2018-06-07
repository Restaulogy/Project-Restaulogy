<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$customer_name  = get_input('customer_name');
$action  = strtoupper(get_input(ACTION_TITLE,''));


switch($action){
	 case ACTION_SAVE :
	 $_SESSION['']
	 break; 
}

$template='ask_cust_nm.tpl';
include_once('footer.php');
?>