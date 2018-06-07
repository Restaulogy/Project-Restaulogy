<?php
include_once(dirname(dirname(__FILE__)).'/init.php');

$order_id=get_input('order_id',0); 
 
if($_POST['add2cart']){ 
 if(is_gt_zero_num($_POST['submenu_dish'])){
	  //..get the last sequence number from the order details	
	  $sequence=tbl_order_details::get_max_order_detail_id();

	  if(is_not_empty($_POST[SES_ORDER_SEQUENCE])){
	  	 $sequence = $_POST[SES_ORDER_SEQUENCE];  
	  }else{
	  	  //.. Get the incremental value of sequence.
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
	$_SESSION[SES_ORDER_UDP][$sequence][SES_SUB_MENU_DISH][$_POST['submenu_dish']] = $cart_array;  	
 }
 
 //..Add logic here to update the order deatils
 if(is_gt_zero_num($order_id)){
		//..delete previou order details if any
		@tbl_order_details::delete_ord_detls($order_id);
		foreach($_SESSION[SES_ORDER_UDP] as $key_ord=>$ord_seq_num){	
			if($key_ord !='order_info'){
			  foreach($ord_seq_num[SES_SUB_MENU_DISH] as $key_sbmndsh=>$val_sbmndsh){
				//..Insert into order details
				$objtbl_order_details= new tbl_order_details();
				$order_detail_id = $objtbl_order_details->create($order_id, $key_sbmndsh, $val_sbmndsh["qty"], $val_sbmndsh["price"]);
				if(is_gt_zero_num($order_detail_id) && is_not_empty($val_sbmndsh["dish_option_value_id"])){			  
					foreach($val_sbmndsh["dish_option_value_id"] as $key_optval=>$val_optval){				
						//..Insert into order details options if any
						$objtbl_order_details_options= new tbl_order_details_options();
						$order_dtl_option_id = $objtbl_order_details_options->create($order_detail_id, $key_optval, $val_optval["qty"], $val_optval["price"]);
					}		
				}			
			  } 	
			}			
		}
		$_SESSION["disp_msg"]= "Order updated successfully";
		unset($_SESSION[SES_ORDER_UDP]);	
		unset($_SESSION[SES_ORDER_SEQUENCE]);	
		echo "<script>location.href='{$website}/user/tbl_orders.php?order_id={$order_id}&mode=VIEW';</script>";	
	} 	 
}
 
if(is_not_empty($_REQUEST[SES_ORDER_SEQUENCE])){ 
 
	if(is_gt_zero_num($_REQUEST['updateDishOrder']) && is_gt_zero_num($_REQUEST['qty']) ){  
		 $_SESSION[SES_ORDER_UDP][$_REQUEST[SES_ORDER_SEQUENCE]][SES_SUB_MENU_DISH][$_REQUEST['updateDishOrder']]['qty'] = $_REQUEST['qty'] ; 
	}
	 
	if((is_gt_zero_num($_REQUEST['dish_opt_dish'])) && (is_gt_zero_num($_REQUEST['updateDishOption'])) && is_gt_zero_num($_REQUEST['qty'])){ 
		 $_SESSION[SES_ORDER_UDP][$_REQUEST[SES_ORDER_SEQUENCE]][SES_SUB_MENU_DISH][$_REQUEST['dish_opt_dish']][SES_DISH_OPTION_VALUE][$_REQUEST['updateDishOption']]['qty'] = $_REQUEST['qty'];		 
	}
	  
	if(is_gt_zero_num($_REQUEST['cancelDishOrder'])){  
		/* unset($_SESSION[SES_ORDER_UDP][$_REQUEST[SES_ORDER_SEQUENCE]][SES_SUB_MENU_DISH][$_REQUEST['cancelDishOrder']]); */
		unset($_SESSION[SES_ORDER_UDP][$_REQUEST[SES_ORDER_SEQUENCE]]);	 
	}
 
	if((is_gt_zero_num($_REQUEST['dish_opt_dish'])) && (is_gt_zero_num($_REQUEST['cancelDishOption']))){		 
		unset($_SESSION[SES_ORDER_UDP][$_REQUEST[SES_ORDER_SEQUENCE]][SES_SUB_MENU_DISH][$_REQUEST['dish_opt_dish']][SES_DISH_OPTION_VALUE][$_REQUEST['cancelDishOption']]); 
	} 
	
}
	$isEmpty = 0;
	if(empty($_SESSION[SES_ORDER_UDP])){
		unset($_SESSION[SES_ORDER_UDP]);	
		unset($_SESSION[SES_ORDER_SEQUENCE]);
		$isEmpty = 1;	
	}
 
if(is_gt_zero_num($_REQUEST[IS_AJAX])){
	echo json_encode(array('isSuccess'=>1,'isEmpty'=>$isEmpty));
}else{
	echo '<script>window.location.href="'.$_SERVER[HTTP_REFERER].'";</script>';
exit;
}	

?>