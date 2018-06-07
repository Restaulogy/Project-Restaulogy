<?php

include_once(dirname(dirname(__FILE__)).'/init.php');
$_loy_cust_id=0;
$_loy_cust_ord_amt=0;

function writeToFile($Data)
{
    $File = "IPNResults.txt";
    $Handle = fopen($File, 'a');
    fwrite($Handle, $Data);
    fclose($Handle);
}
				
if((is_not_empty($txn_id)) && (strtoupper($payment_status)=='COMPLETED')){

  $err='';		
	$paypal_payment_id=0;
  //..Update the order status to check paid
  if(is_gt_zero_num($invoice)){
	writeToFile("\n i am in invoice =$invoice,......");
	$my_custom_fields=explode('|',$custom);
	if(is_not_empty($my_custom_fields)){
		$created_by						=	$my_custom_fields[0];
		$payment_choice				=	$my_custom_fields[1];		
		$ord_pmnt_split_amng	=	$my_custom_fields[2];
		$order_payment_id			=	$my_custom_fields[3];
		$order_pmnt_user_type	=	$my_custom_fields[4];
		$order_tip 						=	$my_custom_fields[5];
		$ord_pmnt_ispaybycash = $my_custom_fields[6];
		
		$ord_pmnt_split_pay_for	=	$my_custom_fields[7];		
		
	}
/*	echo $mc_gross;exit;*/
	$order_amt_i_pay=$mc_gross;
	$order_id=$invoice;
		
	writeToFile("\n Paypal response (created_by,order_id,order_amt_i_pay,payment_choice,order_payment_id,ord_pmnt_split_amng) =($created_by,$order_id,$order_amt_i_pay,$payment_choice,$order_payment_id,$ord_pmnt_split_amng)");
	
	//..Please Update Table Status 
	$objtbl_orders = new tbl_orders();
	$tbl_ordersinfo= $objtbl_orders->GetInfo($order_id);
	
	writeToFile("\n order =".$tbl_ordersinfo['order_id']." \n order_restaurant =".$tbl_ordersinfo['order_restaurant']."\n ");
//..logic for the payment processing
	//echo "$process_payment,$payment_choice,$ord_pmnt_split_amng";
	//writeToFile("\n ...".$tbl_ordersinfo['order_table_id']."\n order =".tbl_table_customer_session::GetCurrentActiveCustSession(1));
	//$tbl_cust_sess_id = tbl_table_customer_session::GetCurrentActiveCustSession($tbl_ordersinfo['order_table_id']);
	$tbl_cust_sess_id =  $tbl_ordersinfo['order_session_id'];
	$tb_sess_ords= $objtbl_orders->getOrdGrAmtBySession($tbl_cust_sess_id,0,$tbl_ordersinfo['order_restaurant']);
	
   //writeToFile("\n order_info=".var_dump($tbl_ordersinfo)."\n sess_id=".$tbl_cust_sess_id."\n sess order =".var_dump($tb_sess_ords).",......");
	 
	//..if order_payment_id is created 
	if(is_gt_zero_num($order_payment_id)){
		$paypal_payment_id=$order_payment_id;
		//..amount you are paying should not be 0	
		if(is_gt_zero_num($order_amt_i_pay)){ 
		$objtbl_order_payment=new tbl_order_payment();
		 	$resl=$objtbl_order_payment->updateOrderPayment($order_payment_id,$created_by, $order_amt_i_pay,$tbl_cust_sess_id,$order_id,$order_pmnt_user_type,$tbl_ordersinfo['order_restaurant'],$ord_pmnt_split_pay_for);
			unset($objtbl_order_payment);
			if($resl){
				//$_SESSION['disp_msg']='Payment sucessfull';
				$err .= '<div class="info">Payment sucessfull</div>'; 
				unset($objtbl_table_status_link);
			}			
		}		
	}else{ 
	
	 //..first time devide the tip in all orders
	 //echo $order_id,$order_tip; 
	 if(strtoupper($payment_choice)=='INDIVIDUAL'){
	 	  $objtbl_orders->applyOrderTipToAllOrders($order_id,$order_tip,1);
	 	
	 }else{
	 	 $objtbl_orders->applyOrderTipToAllOrders($order_id,$order_tip);
	 }	
	 
	//..if order payment is not created	
		if($tbl_ordersinfo['order_status_id']!=TBL_STATUS_CHECK){
		
			$objtbl_order_payment=new tbl_order_payment();
			$objtbl_table_status_link=new tbl_table_status_link();
			//..order payment for indidual
			if(strtoupper($payment_choice)=='INDIVIDUAL'){
				$ord_pmnt_order=$order_id;
				 //..Get the table session orders
        		if(is_gt_zero_num($tbl_cust_sess_id)){
							$tb_sess_ords= $objtbl_orders->getOrdGrAmtBySession($tbl_cust_sess_id,0,$tbl_ordersinfo['order_restaurant']);
						}else{
							$tb_sess_ords= $objtbl_orders->getOrdGrAmtBySession($tbl_cust_sess_id,$order_id,$tbl_ordersinfo['order_restaurant']);
						} 	
				
				//$ord_amnt=$tb_sess_ords['gr_amt']; //..Order amount
				$ord_pmnt_bill_amnt=$tb_sess_ords['orders'][$order_id]; //..pay same 
				  //..Update the order status to check paid
		        $objtbl_orders->update_ord_sts($order_id,TBL_STATUS_CHECK);   
		        
		        //.. rewrad point
		        $_loy_cust_ord_amt= $ord_pmnt_bill_amnt;
		        $_loy_cust_id= $tbl_ordersinfo[ORDER_CUSTOMER_ID];
				//add_reward_points_on_order($tbl_ordersinfo[ORDER_RESTAURANT],$tbl_ordersinfo[ORDER_CUSTOMER_ID],$tbl_ordersinfo[ORDER_TABLE_ID],$ord_pmnt_bill_amnt,$tbl_ordersinfo[ORDER_REWARD_MULTIPLIER]);   
        
		        //..Create the payment order record
		        //$isSuccess = $objtbl_order_payment->create($tbl_cust_sess_id, $order_id, $ord_amnt, $created_by, $payment_choice, $ord_pmnt_split_amng, $created_by, $ord_pmnt_bill_amnt, Date(DATE_FOMAT), NULL,$order_pmnt_user_type,$order_pmnt_user_type);
						$isSuccess = $objtbl_order_payment->create($tbl_cust_sess_id, $order_id, $ord_pmnt_bill_amnt, $created_by, $payment_choice, $ord_pmnt_split_amng, $created_by, $ord_pmnt_bill_amnt, Date(DATE_FOMAT), NULL,$order_pmnt_user_type,$order_pmnt_user_type,$ord_pmnt_ispaybycash);
						
						//..capture the order payment id for paypal transaction
						if(is_gt_zero_num($isSuccess))
							$paypal_payment_id=$isSuccess;
						
						if(is_gt_zero_num($tbl_cust_sess_id)){
							$tb_sess_ords= $objtbl_orders->getOrdGrAmtBySession($tbl_cust_sess_id,0,$tbl_ordersinfo['order_restaurant']);
				}	
							

                //..Check if all orders are paid ..and settable stataus to check-paid
				if(is_gt_zero_num($tb_sess_ords['is_all_paid'])){
          $isSuccess = $objtbl_table_status_link->create($tbl_ordersinfo['order_table_id'], $tbl_ordersinfo['order_customer_name'], TBL_STATUS_CHECK, $tbl_ordersinfo['order_emp_id'],$tbl_cust_sess_id, date(DATE_FORMAT), NULL);
        if ($isSuccess){
				        //..Alert manager about the check paid
					//alertToManager($tbl_ordersinfo['order_table_id'],$tbl_ordersinfo['order_customer_name'],$order_id,ALERT_CHK_OUT);
					biz_send_alert($tbl_ordersinfo['order_table_id'],$tbl_ordersinfo['order_customer_name'],$order_id,$_lang[TBL_ALERTS]['manager'][ALERT_CHK_OUT],ALERT_FOR_MANGER,ALERT_ORDER);
					//..alert to server 
					biz_send_alert($tbl_ordersinfo['order_table_id'],$tbl_ordersinfo['order_customer_name'],$order_id,$_lang[TBL_ALERTS]['manager'][ALERT_CHK_OUT],$tbl_ordersinfo['order_emp_id'],ALERT_ORDER);	
				}      
        
				} 
				//..individual bkt complete
			}elseif(strtoupper($payment_choice)=='SINGLE'){
				 writeToFile("\n I am in single.. ");
          //..Get the table session orders
          $tb_sess_ords= tbl_orders::getOrdGrAmtBySession($tbl_cust_sess_id,0,$tbl_ordersinfo['order_restaurant']);	 
					
					writeToFile("\n 2. I am in single.. ");
          //..fetch the order ids from above
					if(is_not_empty($tb_sess_ords['orders'])){
						 $ord_keys=array_filter(array_keys($tb_sess_ords['orders']));
					}
         
				if(is_not_empty($ord_keys)){
					$ord_pmnt_order=implode(",",$ord_keys);
				}
				$ord_amnt=$tb_sess_ords['gr_amt']; //..order amount
				$ord_pmnt_bill_amnt=$ord_amnt; //..pay amount
				
				writeToFile("\n tbl_cust_sess_id={$tbl_cust_sess_id} order_restaurant=".$tbl_ordersinfo['order_restaurant']."-- orders=".$tb_sess_ords['orders']." ord_pmnt_order= {$ord_pmnt_order}, ord_amnt={$ord_amnt}, ord_pmnt_bill_amnt={$ord_pmnt_bill_amnt} \n ");
				//..create the payment order record
				$isSuccess = $objtbl_order_payment->create($tbl_cust_sess_id, $ord_pmnt_order, $ord_amnt, $created_by, $payment_choice, 1, $created_by, $ord_pmnt_bill_amnt, Date(DATE_FOMAT), NULL,$order_pmnt_user_type,$order_pmnt_user_type,$ord_pmnt_ispaybycash);	
				//..capture the order payment id for paypal transaction
				if(is_gt_zero_num($isSuccess))
							$paypal_payment_id=$isSuccess;			
				//..update all the orders from table session status to check paid
				$isSuccess = tbl_orders::updateAllTblSessOrdChkPaid($tbl_cust_sess_id,$tbl_ordersinfo['order_restaurant']);
				 //.. rewrad point
				$_loy_cust_ord_amt= $ord_pmnt_bill_amnt;
		        $_loy_cust_id= $tbl_ordersinfo[ORDER_CUSTOMER_ID];
				//add_reward_points_on_order($tbl_ordersinfo[ORDER_RESTAURANT],$tbl_ordersinfo[ORDER_CUSTOMER_ID],$tbl_ordersinfo[ORDER_TABLE_ID],$ord_pmnt_bill_amnt,$tbl_ordersinfo[ORDER_REWARD_MULTIPLIER]);  
				
				//..Set table stataus to check-paid
				$isSuccess = $objtbl_table_status_link->create($tbl_ordersinfo['order_table_id'], $tbl_ordersinfo['order_customer_name'], TBL_STATUS_CHECK, $tbl_ordersinfo['order_emp_id'],$tbl_cust_sess_id, date(DATE_FORMAT), NULL);               
                //..alert manager about the check paid
				//alertToManager($tbl_ordersinfo['order_table_id'],$tbl_ordersinfo['order_customer_name'],$order_id,ALERT_CHK_OUT);
				biz_send_alert($tbl_ordersinfo['order_table_id'],$tbl_ordersinfo['order_customer_name'],$order_id,$_lang[TBL_ALERTS]['manager'][ALERT_CHK_OUT],ALERT_FOR_MANGER,ALERT_ORDER);
				//..alert to server 
				biz_send_alert($tbl_ordersinfo['order_table_id'],$tbl_ordersinfo['order_customer_name'],$order_id,$_lang[TBL_ALERTS]['manager'][ALERT_CHK_OUT],$tbl_ordersinfo['order_emp_id'],ALERT_ORDER);
				
				//..single bkt. complete
			}else{			
				 
				writeToFile("\n in else.. ");
          //..get the table session orders
          $tb_sess_ords=tbl_orders::getOrdGrAmtBySession($tbl_cust_sess_id,0,$tbl_ordersinfo['order_restaurant']);
          //..fetch the order ids from above
          $ord_keys=array_filter(array_keys($tb_sess_ords['orders']));					
								
				if(is_not_empty($ord_keys)){
					$ord_pmnt_order=implode(',',$ord_keys);
				}
				$ord_amnt=$tb_sess_ords['gr_amt'];  //..order amount
				$ord_pmnt_bill_amnt=($tb_sess_ords['gr_amt']/$ord_pmnt_split_amng);
				
				writeToFile("\n 3.tbl_cust_sess_id={$tbl_cust_sess_id} order_restaurant=".$tbl_ordersinfo['order_restaurant']."-- orders=".$tb_sess_ords['orders']." ord_pmnt_order= {$ord_pmnt_order}, ord_amnt={$ord_amnt}, ord_pmnt_bill_amnt={$ord_pmnt_bill_amnt} \n ");
				//..pay amount
				
				//..create the payment order record	
				//..For split pay for other people logic
				$ord_paid_by=$created_by;		
				if($ord_pmnt_split_pay_for>1){
					$tmp_created_by=array();
					for ($i = 0; $i < $ord_pmnt_split_pay_for; $i++) {
					   $tmp_created_by[]=$created_by;
					}
					if(is_not_empty($tmp_created_by)){
						$ord_paid_by=implode(',',$tmp_created_by);
					}	
					$ord_pmnt_bill_amnt=($ord_pmnt_bill_amnt*$ord_pmnt_split_pay_for);	
				}
			  
				$isSuccess = $objtbl_order_payment->create($tbl_cust_sess_id, $ord_pmnt_order, $ord_amnt, $created_by, $payment_choice, $ord_pmnt_split_amng, $ord_paid_by, $ord_pmnt_bill_amnt, date(DATE_FORMAT), NULL,$order_pmnt_user_type,$order_pmnt_user_type,$ord_pmnt_ispaybycash);
				
				
				//..capture the order payment id for paypal transaction
				if(is_gt_zero_num($isSuccess)) 
				$paypal_payment_id=$isSuccess;	
				
				//..on all paid make order paid
				if($ord_amnt == $ord_pmnt_bill_amnt){
						$isSuccess = tbl_orders::updateAllTblSessOrdChkPaid($tbl_cust_sess_id,$tbl_ordersinfo['order_restaurant']); 
				//..Set table stataus to check-paid
				$isSuccess = $objtbl_table_status_link->create($tbl_ordersinfo['order_table_id'], $tbl_ordersinfo['order_customer_name'], TBL_STATUS_CHECK, $tbl_ordersinfo['order_emp_id'],$tbl_cust_sess_id, date(DATE_FORMAT), NULL); 
				}			 
                //..alert manager about the check paid
				//alertToManager($tbl_ordersinfo['order_table_id'],$tbl_ordersinfo['order_customer_name'],$order_id,ALERT_CHK_OUT);
				biz_send_alert($tbl_ordersinfo['order_table_id'],$tbl_ordersinfo['order_customer_name'],$order_id,$_lang[TBL_ALERTS]['manager'][ALERT_CHK_OUT],ALERT_FOR_MANGER,ALERT_ORDER);
				//..alert to server 
				biz_send_alert($tbl_ordersinfo['order_table_id'],$tbl_ordersinfo['order_customer_name'],$order_id,$_lang[TBL_ALERTS]['manager'][ALERT_CHK_OUT],$tbl_ordersinfo['order_emp_id'],ALERT_ORDER);
				//...split complete. 
			}
			//print_r($tb_sess_ords);
			//print_r($ord_keys);
			//echo("$tbl_cust_sess_id, $ord_pmnt_order, $ord_pmnt_bill_amnt, ".$created_by.", $payment_choice, $ord_pmnt_split_amng,".$created_by.", $ord_pmnt_bill_amnt, date(DATE_FOMAT), NULL");			
			//$_SESSION['disp_msg']='Payment sucessfull';
			$err .= '<div class="info">Payment sucessfull</div>'; 
		}else{
			//$_SESSION['disp_msg']='Payment for this order is already done';
			$err .= '<div class="info">Payment for this order is already done</div>'; 
		}
		
		
		unset($objtbl_table_status_link);
		unset($objtbl_order_payment);
	 }
	 
	 //..logic to add record to paypal transaction table
		if(is_gt_zero_num($paypal_payment_id)){
			//..Add one record to paypal transaction table 
			$objtbl_ord_paypal_trans=new tbl_ord_paypal_trans();
			$isSuccess = $objtbl_ord_paypal_trans->create($txn_id, $mc_gross,$paypal_payment_id,'NONE', 0, '', '');
			
			//..check if reward session is there.
			if(is_not_empty($tbl_cust_sess_id) && is_not_empty($_SESSION[SES_REWARD])){
				members::update_reward_bal_points($_SESSION[SES_REWARD]['id'],$mc_gross);					
			}
				
			unset($objtbl_ord_paypal_trans);
		}
		
	  writeToFile("\n Transaction Is Sucessfull......$err");
	}			
}else{
	exit;
} 
	//..START..SAN ..13/02/2018
	//..logic to add order to payment
	add_reward_points_on_order($tbl_ordersinfo);
	//..START..SAN ..13/02/2018
	
	$_SESSION[SES_FLASH_MSG]= '<div class="info">Payment sucessfull</div>'; 
	biz_script_forward($website.'/user/tbl_orders.php?order_id='.$order_id.'&'.MODE_TITLE.'='.MODE_VIEW);	
	/*if(is_gt_zero_num($_loy_cust_ord_amt) && is_gt_zero_num($_loy_cust_id)){
		biz_script_forward($website.'/user/customer_rewards.php?manager_cust_sess_id='.$_loy_cust_id.'&_loy_cust_ord_amt='.$_loy_cust_ord_amt);
		//if(is_gt_zero_num($open_recpeipt)){
		//	biz_script_forward($website.'/user/order_receipt.php?order_id='.$order_id.'&order_tip=0&payment_choice="+payment_choice'.strtoupper($payment_choice));
		//}		
	}else{
		biz_script_forward($website.'/user/tbl_orders.php?order_id='.$order_id.'&'.MODE_TITLE.'='.MODE_VIEW);	
	}*/	
?>