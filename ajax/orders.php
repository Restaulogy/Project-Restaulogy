<?php 
 include_once (dirname(dirname(__FILE__))).'/init.php'; 
  
 $action = get_input('action','');
 $var1 = get_input('var1','');
 $var2 = get_input('var2','');
 $var3 = get_input('var3','');
 $var4 = get_input('var4','');
 $var5 = get_input('var5',''); 
 
switch($action){
	case 'fillOrderDetail': 
	$order_id = $var1;
$tbl_ordersinfo=  tbl_orders::GetInfo($order_id);
unset($_SESSION[SES_ORDER_UDP]);

$cust_sess_id = checkNcreateSession($tbl_ordersinfo['order_table_id'], $tbl_ordersinfo['order_customer_name']);
			//..needs to change code here
$CustSessionLastOrder = tbl_orders::getCustSessionLastOrder($cust_sess_id);
$_SESSION[CUST_LAST_ORDER]=$CustSessionLastOrder;

$ord_detail=$tbl_ordersinfo['order_details'];		
 
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
	$tbl_ordersinfo['coupon'] = getClaimedCouponForOrder($order_id);

			//$payment_options=tbl_order_payment::readArray(array(ORD_PMNT_TABLE_SESS=>$cust_sess_id,ORD_PMNT_ORDER=>$order_id));
			$payment_options=tbl_order_payment::readArray(array(ORD_PMNT_TABLE_SESS=>$cust_sess_id));
			//..get the payment options from the tbl_order_payment
            if(is_not_empty($payment_options)){
                $payment_options =array_shift($payment_options);
                $tbl_ordersinfo['payment_options'] =$payment_options;
            }

			//..Show the payment options form or not
			//..Show Amount to pay 
			$show_opt_bx=0;
			$can_pay_amt=0;	
			$am_i_in_chk_paid=0;		
			//..Get the table session orders
     		$tb_sess_ords=tbl_orders::getOrdGrAmtBySession($cust_sess_id);			
   			//$tbl_ordersinfo['all_bill_amnt']=$tb_sess_ords['total']; 
				$tbl_ordersinfo['bill_amnt']=$tb_sess_ords['total'];
				$tbl_ordersinfo['tax_amnt']=$tb_sess_ords['tax_amt'];
				$tbl_ordersinfo['all_bill_amnt']=$tb_sess_ords['gr_amt'];
				$tbl_ordersinfo['curr_bill_amnt']=$tb_sess_ords['orders'][$order_id]; 
				$tbl_ordersinfo['orders_count']= count($tb_sess_ords['orders']);	
			
			if(is_not_empty($payment_options)){
                //$payment_options =array_shift($payment_options);
				//..Check if i am in the list of amount paid
				if(is_not_empty($payment_options["ord_pmnt_paid_by"])){
					$lst_paid_by=explode(',',$payment_options["ord_pmnt_paid_by"]);
					if(in_array($Global_member['member_id'],$lst_paid_by)){
						$am_i_in_chk_paid=1;
					}
				}					
				if($Global_member['member_role_id']!=ROLE_CUSTOMER){
					$show_opt_bx=1;
				}else{
			//..If created by same user then only show
			//..$payment_options["ord_pmnt_created_by"]=$Global_member['member_id']
					if($am_i_in_chk_paid==1){
						$show_opt_bx=1;
					}	
				}
				if($payment_options["ord_pmnt_option"]=='INDIVIDUAL'){
					if($tbl_ordersinfo['order_status_id']!=TBL_STATUS_CHECK){
						if($am_i_in_chk_paid==0){
							$can_pay_amt=$tb_sess_ords['orders'][$order_id];
						}						
					}
				}else{
                    //echo floatval($payment_options["ord_pmnt_bill_amnt"])."/".floatval($payment_options["ord_pmnt_split_amng"]);
					if(floatval($payment_options['ord_pmnt_bill_amnt']) > floatval($payment_options['ord_pmnt_split_amng'])){                       
              			if($am_i_in_chk_paid==0){
							if($payment_options["ord_pmnt_option"]=='SINGLE'){
								//$can_pay_amt=$payment_options["ord_pmnt_bill_amnt"];
								$can_pay_amt=0;
								$show_opt_bx=1;
							}else{
                                //echo $payment_options["ord_pmnt_bill_amnt"]."/".$payment_options["ord_pmnt_split_amng"];
								$can_pay_amt=(floatval($payment_options["ord_pmnt_bill_amnt"])/floatval($payment_options["ord_pmnt_split_amng"]));
							}
						}								
					}					
				}
				$tbl_ordersinfo['bill_paid_by']=GetMembersFromIDs($payment_options["ord_pmnt_paid_by"]);			
			}else{  
			 		$show_opt_bx=1;
					$can_pay_amt=1;  
			}			
			$tbl_cust_sess_id = tbl_table_customer_session::GetCurrentActiveCustSession($tbl_ordersinfo['order_table_id']);
			 //..if only the current ssession not match the order session then disable the values at any case
			if($tbl_ordersinfo[ORDER_SESSION_ID]!=$tbl_cust_sess_id){ 
			 		$show_opt_bx=0;
					$can_pay_amt=0; 
			}			 
			$tbl_ordersinfo['show_opt_bx']=$show_opt_bx;
			$tbl_ordersinfo['can_pay_amt']=$can_pay_amt;
			$tbl_ordersinfo['am_i_in_chk_paid']=$am_i_in_chk_paid;	
		  
	$retValue = json_encode($tbl_ordersinfo); 
	
	
  break;
} 

echo $retValue;


?>