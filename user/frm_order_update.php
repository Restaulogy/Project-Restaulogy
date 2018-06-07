<?php 

include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');

$order_id= get_input('order_id');
$objtbl_orders=new tbl_orders();

if(is_gt_zero_num($order_id)){
	$tbl_ordersinfo= $objtbl_orders->GetInfo($order_id);
	//..Get/create the cust and order session
	$cust_sess_id = checkNcreateSession($tbl_ordersinfo['order_table_id'], $tbl_ordersinfo['order_customer_name']);
	$CustSessionLastOrder = tbl_orders::getCustSessionLastOrder($cust_sess_id,$tbl_ordersinfo['order_customer_name']);
	$smarty->assign('CustSessionLastOrder',$CustSessionLastOrder);

	//..Add order details to session first time Only ..			
	if(is_not_empty($tbl_ordersinfo['order_details'])){
		$ord_detail=$tbl_ordersinfo['order_details'];			 
		
		if(is_not_empty($_SESSION[SES_ORDER_UDP]['order_info']['order_id']) && ($_SESSION[SES_ORDER_UDP]['order_info']['order_id']==$tbl_ordersinfo['order_id'])){
		  
		}else{
		 
		if($tbl_ordersinfo['order_status_id'] != TBL_STATUS_CHECK){
			unset($_SESSION[SES_ORDER_UDP]);
			$ord_info = array();
			$ord_info['order_id']=$tbl_ordersinfo['order_id'];
			$ord_info['order_customer_name']=$tbl_ordersinfo['order_customer_name'];
			$ord_info['order_table_id']=$tbl_ordersinfo['order_table_id'];
			$ord_info['order_note']=$tbl_ordersinfo['order_note'];
			$_SESSION[SES_ORDER_UDP]['order_info']=$ord_info;
			unset($ord_info);
			foreach($ord_detail as $kydish_cart=>$dish_cart){
			  	$info = array();
				$info['title']=$dish_cart['title'];
				$info['qty']=$dish_cart['ord_dtl_quantity'];
				$info['price']=$dish_cart['ord_dtl_price'];
				$_SESSION[SES_ORDER_UDP][$kydish_cart][SES_SUB_MENU_DISH][$dish_cart[ord_dtl_sbmenu_dish_id]] = $info;
				unset($info);
				$dish_info = array();
				//print_r($dish_cart['opt_val_details']);
				if(is_not_empty($dish_cart['opt_val_details'])){
					foreach($dish_cart['opt_val_details'] as $key_sbmndsh=>$val_sbmndsh){			
						/* $dish_info[$key_sbmndsh] = $val_sbmndsh;*/		 
						$dish_info[$val_sbmndsh['ord_det_opt_optionvalue']]['type']= $val_sbmndsh['opt_type'];
						$dish_info[$val_sbmndsh['ord_det_opt_optionvalue']]['qty']= $val_sbmndsh['ord_det_opt_qty'];
						$dish_info[$val_sbmndsh['ord_det_opt_optionvalue']]['price']= $val_sbmndsh['ord_det_opt_price'];
						$dish_info[$val_sbmndsh['ord_det_opt_optionvalue']]['title']=$val_sbmndsh['opt_value'];												
					}
					$_SESSION[SES_ORDER_UDP][$kydish_cart][SES_SUB_MENU_DISH][$dish_cart[ord_dtl_sbmenu_dish_id]][SES_DISH_OPTION_VALUE]= $dish_info;		
				}						
				unset($dish_info);	
			}
		   }											
		}
	}	
}
/*print_r($_SESSION[SES_ORDER_UDP]);*/ 
$smarty->assign('tbl_ordersinfo',$tbl_ordersinfo);
$template = 'tbl_orders/view.tpl';

include_once('footer.php');  
?>