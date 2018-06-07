<?php
include_once(dirname(dirname(__FILE__))."/init.php");

if($sesslife==false){
	echo "<script>location.href='{$website}/user/login.php';</script>";
}
 

 
if(($Global_member['member_role_id'] == ROLE_WAITER)|| ($Global_member['member_role_id'] == ROLE_MANAGER)){
	//$order_customer_id=0;
	$order_emp_id= $Global_member['member_id'];
	$order_table_id= get_input("order_table_id");	
}

$order_id= get_input("order_id");
$order_customer_name= get_sql_input("order_customer_name");
		
if(is_not_empty($order_customer_name)==false)
	if(is_not_empty($_SESSION["cust_nm"]))	
		$order_customer_name = $_SESSION["cust_nm"];
		
$order_note =get_sql_input("order_note","");
$order_action = strtoupper(get_input("action"));
$order_status_id= TBL_STATUS_ORDERED;
$order_created_on= date(DATE_FORMAT);
$order_completed_on= NULL; 
 //..First check if order id there exists
if(is_not_empty($order_id)){	
if($order_action == 'DELETE'){
	//..recive the order detail for delete
	$ord_sel_dish = get_input('sel_dish');
	//..recive the order detail options for delete
	$ord_sel_dishopt = get_input('sel_dish_opt');
	$isSuccess = 0;
	
	//.STEP - 1: Delete the option of the order details 
	
	//.. recieved order detail options are array and not empty then delete
	if(is_array($ord_sel_dishopt) && is_not_empty($ord_sel_dishopt)){
		$del_order_dishopt = ''; //..init
		$del_order_dishopt = biz_implode(',',array_keys($ord_sel_dishopt));
		if(is_not_empty($del_order_dishopt)){
		 $isSuccess =	tbl_order_details_options::delete(array(ORD_DET_OPT_ID=>$del_order_dishopt));
		}
	}
  
	//.STEP - 2: Now Delete the order details 
	
	//.. recieved order detail  are array and not empty then delete them
	if(is_array($ord_sel_dish) && is_not_empty($ord_sel_dish)){
		$del_order_dish = ''; //init
		$del_order_dish = biz_implode(',',array_keys($ord_sel_dish));
		if(is_not_empty($del_order_dish)){
			tbl_order_details_options::delete(array(ORD_DET_OPT_ORDER_DETAIL=>$del_order_dish));
		  $isSuccess =	tbl_order_details::delete(array(ORD_DTL_ID=>$del_order_dish));
		 							
		}
	}
	
	 
	$arr = biz_getLangMsgStrForDftlAct($isSuccess);
	if(is_not_empty($_lang[TBL_ORDER_DETAILS]['DELETE'][$arr['msg']])){
		$_SESSION["disp_msg"] = '<div class="'.$arr['class'].'">'. $_lang[TBL_ORDER_DETAILS]['DELETE'][$arr['msg']].'</div>';
	}
	
	//..now clear the session
	/*if(is_not_empty($_SESSION[SES_ORDER_UDP]))
		unset($_SESSION[SES_ORDER_UDP]);
	  */ 

}elseif($order_action == 'UPDATE'){ 
	
	$upd_ord_dtl_qty = get_input('dish_qty');
	$upd_ord_dtlopt_qty = get_input('dish_opt_qty');
	$isSuccess = 0;
	if(is_array($upd_ord_dtl_qty) && is_not_empty($upd_ord_dtl_qty)){
		$objord_dtl = new tbl_order_details();
		foreach($upd_ord_dtl_qty as $ord_dtl_id => $ord_dtl_qty){
			if(is_gt_zero_num($ord_dtl_id)){
				if($objord_dtl->readObject(array(ORD_DTL_ID=>$ord_dtl_id))){
					$objord_dtl->setord_dtl_quantity($ord_dtl_qty);
					$objord_dtl->insert();
					$isSuccess = 1;
				} 
			} 
		}
		unset($objord_dtl);
	}
	
	if(is_array($upd_ord_dtlopt_qty) && is_not_empty($upd_ord_dtlopt_qty)){
		$objord_dtl_opt = new tbl_order_details_options();
		foreach($upd_ord_dtlopt_qty as $ord_dtlopt_id => $ord_dtlopt_qty){
			if(is_gt_zero_num($ord_dtlopt_id)){
				if($objord_dtl_opt->readObject(array(ORD_DET_OPT_ID=>$ord_dtlopt_id))){
					$objord_dtl_opt->setord_det_opt_qty($ord_dtlopt_qty);
					$objord_dtl_opt->insert(); 
					$isSuccess = 1;
				} 
			} 
		}
		unset($objord_dtl);
	}
	 
	$arr = biz_getLangMsgStrForDftlAct($isSuccess);
	if(is_not_empty($_lang[TBL_ORDERS]['UPDATE'][$arr['msg']])){
		$_SESSION["disp_msg"] = '<div class="'.$arr['class'].'">'. $_lang[TBL_ORDERS]['UPDATE'][$arr['msg']].'</div>';
	}
	
	 
	 
	
}else{
	/* disabled @3Aug2013
	
	//..Update the order details first
	$objtbl_orders= new tbl_orders();
	if($objtbl_orders->readObject(array(ORDER_ID =>$order_id))){
		//..Store the customer session if needed	
		//$cust_sess_id =$objtbl_orders->getorder_session_id();
		$objtbl_orders->setorder_customer_name($order_customer_name);
		$objtbl_orders->setorder_note($order_note);
		$objtbl_orders->insert();				
     }	
	 unset($objtbl_orders);		
			
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
		$_SESSION["disp_msg"]= "Order successfully updated";
		unset($_SESSION[SES_ORDER_UDP]);	
		unset($_SESSION[SES_ORDER_SEQUENCE]);	
	 
		
	}*/
 } 		
}else{
	$_SESSION["disp_msg"]= $_lang['tbl_orders']['non_empty_msg']['order_id'];	
}

 if(stripos($_SERVER['PHP_SELF'],$_SERVER['HTTP_REFERER'])){
			echo "<script>location.href='{$website}/user/tbl_orders.php';</script>";	
		}else{
			echo "<script>location.href='".$_SERVER['HTTP_REFERER']."';</script>";	
}
?>