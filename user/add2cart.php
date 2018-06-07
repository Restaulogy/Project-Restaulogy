<?php
include_once(dirname(dirname(__FILE__)).'/init.php');

 
if($_POST['add2cart']){ 
 if(is_gt_zero_num($_POST['submenu_dish'])){
  $sequence =0;
  if(is_not_empty($_POST[SES_ORDER_SEQUENCE])){
  	 $sequence = $_POST[SES_ORDER_SEQUENCE];  
  }else{
  	  //.. get the incrementtal value of sequence.
   	  if(isset($_SESSION[SES_ORDER_SEQUENCE])){
	  	$_SESSION[SES_ORDER_SEQUENCE]++;
  	 	$sequence =  $_SESSION[SES_ORDER_SEQUENCE]; 
	  }else{
	  	  $_SESSION[SES_ORDER_SEQUENCE] = $sequence; 
	  } 
  }	
 	 
 	$cart_array = array();
	$cart_array['isOrdered'] = 1; 
	$cart_array['title'] = $_POST['submenu_dish_title'];
	$cart_array['price'] = $_POST['submenu_dish_price'];
	$cart_array['qty'] = $_POST['submenu_dish_qty'];    
	foreach($_POST as $key=>$val){ 
		$dish_opt_val_id =0; 
		 if(strstr($key, 'check_')){  
		 	$dish_opt_val_id =$val;// str_ireplace('check_','',$key);
			$cart_array[SES_DISH_OPTION_VALUE][$dish_opt_val_id]['type'] = 'checkbox';
		}elseif(strstr($key,'radio_')){  
			$dish_opt_val_id =$val;
			$cart_array[SES_DISH_OPTION_VALUE][$dish_opt_val_id]['type'] = 'radio'; 
		} 
		
		if(is_gt_zero_num($dish_opt_val_id)){
			$cart_array[SES_DISH_OPTION_VALUE][$dish_opt_val_id]['qty'] = $_POST['qty_'.$dish_opt_val_id];
			$cart_array[SES_DISH_OPTION_VALUE][$dish_opt_val_id]['price'] =$_POST['price_'.$dish_opt_val_id];
			$cart_array[SES_DISH_OPTION_VALUE][$dish_opt_val_id]['title'] =$_POST['title_'.$dish_opt_val_id];
		}
	} 
	$_SESSION[SES_CART][$sequence][SES_SUB_MENU_DISH][$_POST['submenu_dish']] = $cart_array;  	
 }
 	 
}
 
if(is_not_empty($_REQUEST[SES_ORDER_SEQUENCE])){ 
	
	if(is_gt_zero_num($_REQUEST['updateDishOrder']) && is_gt_zero_num($_REQUEST['qty']) ){  
		 $_SESSION[SES_CART][$_REQUEST[SES_ORDER_SEQUENCE]][SES_SUB_MENU_DISH][$_REQUEST['updateDishOrder']]['qty'] = $_REQUEST['qty'] ; 
	}
	 
	if((is_gt_zero_num($_REQUEST['dish_opt_dish'])) && (is_gt_zero_num($_REQUEST['updateDishOption'])) && is_gt_zero_num($_REQUEST['qty'])){  
 
		 $_SESSION[SES_CART][$_REQUEST[SES_ORDER_SEQUENCE]][SES_SUB_MENU_DISH][$_REQUEST['dish_opt_dish']][SES_DISH_OPTION_VALUE][$_REQUEST['updateDishOption']]['qty'] = $_REQUEST['qty']; 
		 
	}  
	if(is_gt_zero_num($_REQUEST['cancelDishOrder'])){  
		/*unset($_SESSION[SES_CART][$_REQUEST[SES_ORDER_SEQUENCE]][SES_SUB_MENU_DISH][$_REQUEST['cancelDishOrder']]); */
		unset($_SESSION[SES_CART][$_REQUEST[SES_ORDER_SEQUENCE]]);
		 
	}
	if((is_gt_zero_num($_REQUEST['dish_opt_dish'])) && (is_gt_zero_num($_REQUEST['cancelDishOption']))){  
		unset($_SESSION[SES_CART][$_REQUEST[SES_ORDER_SEQUENCE]][SES_SUB_MENU_DISH][$_REQUEST['dish_opt_dish']][SES_DISH_OPTION_VALUE][$_REQUEST['cancelDishOption']]); 
	} 
}
	$isEmpty = 0;
	if(empty($_SESSION[SES_CART])){
		 unset($_SESSION[SES_CART]);	
		 unset($_SESSION[SES_ORDER_SEQUENCE]);
		 $isEmpty = 1;	
	}
 
if(is_gt_zero_num($_REQUEST[IS_AJAX])){
	echo json_encode(array('isSuccess'=>1,'isEmpty'=>$isEmpty));
}else{
	//echo '<script>window.location.href="'.$_SERVER[HTTP_REFERER].'";</script>';
	echo '<script>window.location.href="'.WWWROOT.'user/tbl_menu.php?is_preview=1";</script>';
	
exit;
}	

?>