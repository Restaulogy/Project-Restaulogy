<?php

include_once(dirname(dirname(__FILE__)).'/init.php');

function writeToFile($Data)
{
    $File = "IPNResults.txt";
    $Handle = fopen($File, 'a');
    fwrite($Handle, $Data);
    fclose($Handle);
}
// this page only process a POST from paypal website
// so make sure that the one requesting this page comes
// from paypal. we can do this by checking the remote address
// the IP must begin with 66.135.197.
$IsValid=false;
writeToFile("::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::\n".date("l dS of F Y h:i:s A")."\n I AM AT STEP-1");

///.... START NEW CHNAGES

     // PayPal now provides a variable called test_ipn on sandbox IPN's for simple flagging of sandbox IPN vs. production IPN

    $sandbox = isset($_POST['test_ipn']) ? true : false;
    $ssl = $sandbox ? false : true;
    $ppHost = $sandbox ? 'www.sandbox.paypal.com' : 'www.paypal.com';

    // read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-validate';

    // Store each $_POST value in a NVP string: 1 string encoded and 1 string decoded
    $IPNDecoded = '';
    foreach ($_POST as $key => $value)
    {
        $value = urlencode(stripslashes($value));
        $req .= "&" . $key . "=" . $value;
        $IPNDecoded .= $key . " = " . urldecode($value) ."<br /><br />";
    }
writeToFile("::::::::::::::::Stored each POST value in a NVP string\n");
    // post back to PayPal system to validate using SSL or not based on flag set above.
    // post back to PayPal system to validate
    $header = '';
	//$header .= "POST /cgi-bin/webscr HTTP/1.1\r\n";
    $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Host: " . $ppHost . ":443\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	$header .= "Connection: Close\r\n\r\n";
    $fp = fsockopen ('ssl://'.$ppHost, 443, $errno, $errstr, 30);

    /*
if($ssl)
    {
        $header = '';
        $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Host: " . $ppHost . ":443\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        $fp = fsockopen ('ssl://' . $ppHost, 443, $errno, $errstr, 30);
        //$fp = fsockopen ($ppHost, 443, $errno, $errstr, 30);
    }
    else
    {
        $header = '';
        $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Host: " . $ppHost . ":80\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        //$fp = fsockopen ($ppHost, 80, $errno, $errstr, 30);
        $fp = fsockopen ('ssl://' . $ppHost, 443, $errno, $errstr, 30);
    }

*/
writeToFile("::::::::::::::::validate using SSL or not\n");

    if (!$fp)
    {
    	writeToFile(":::::::::::::::: fp not there \n");
        // HTTP Error validating data with PayPal.  Maybe email yourself here or just have the script try again.
    }
    else
    {
        //writeToFile(":::::::::::::::: fp there \n");
        //writeToFile("\n :::::::::::::::: POSTED VAL 	 :  ".var_dump($_POST)." \n");
        // Response from PayPal was good.  Now check to see if it returned verified or invalid.  Simply set $IsValud to true/false accordingly.
        writeToFile(":::::::::::::::: header :  $header \n");
        writeToFile(":::::::::::::::: req 	 :  $req \n");
        fputs ($fp, $header . $req);
  		writeToFile(":::::::::::::::: fp | (errno | errstr = $errno | $errstr) :  ".var_dump($fp)." \n");
        
        while(!feof($fp))
        {
            $res = fgets ($fp, 1024);
            //$res = stream_get_contents($fp,1024);
            if(strcmp ($res, "VERIFIED") == 0)
            $IsValid = true;
            elseif (strcmp ($res, "INVALID") == 0)
            $IsValid = false;
            //writeToFile(":::::::::::::::: NEW RES = $res \n");
        }
        fclose ($fp);
    }
    writeToFile(":::::::::::::::::::: check to see if it returned verified or invalid valide=$IsValid \n");

// Buyer Information
$address_city = isset($_POST['address_city']) ? $_POST['address_city'] : '';
$address_country = isset($_POST['address_country']) ? $_POST['address_country'] : '';
$address_country_code = isset($_POST['address_country_code']) ? $_POST['address_country_code'] : '';
$address_name = isset($_POST['address_name']) ? $_POST['address_name'] : '';
$address_state = isset($_POST['address_state']) ? $_POST['address_state'] : '';
$address_status = isset($_POST['address_status']) ? $_POST['address_status'] : '';
$address_street = isset($_POST['address_street']) ? $_POST['address_street'] : '';
$address_zip = isset($_POST['address_zip']) ? $_POST['address_zip'] : '';
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$payer_business_name = isset($_POST['payer_business_name']) ? $_POST['payer_business_name'] : '';
$payer_email = isset($_POST['payer_email']) ? $_POST['payer_email'] : '';
$payer_id = isset($_POST['payer_id']) ? $_POST['payer_id'] : '';
$payer_status = isset($_POST['payer_status']) ? $_POST['payer_status'] : '';
$contact_phone = isset($_POST['contact_phone']) ? $_POST['contact_phone'] : '';
$residence_country = isset($_POST['residence_country']) ? $_POST['residence_country']:'';

writeToFile("::::::::::::::::after Buyer Information\n");
// Basic Information
$notify_version = isset($_POST['notify_version']) ? $_POST['notify_version'] : '';
$charset = isset($_POST['charset']) ? $_POST['charset'] : '';
$business = isset($_POST['business']) ? $_POST['business'] : '';
$item_name = isset($_POST['item_name']) ? $_POST['item_name'] : '';
$item_number = isset($_POST['item_number']) ? $_POST['item_number'] : '';
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
$receiver_email = isset($_POST['receiver_email']) ? $_POST['receiver_email'] : '';
$receiver_id = isset($_POST['receiver_id']) ? $_POST['receiver_id'] : '';

writeToFile("::::::::::::::::after Basic Information\n");
// Cart Items
$i = 1;
$cart_items = array();
while(isset($_POST['item_number' . $i]))
{
$item_number = isset($_POST['item_number' . $i]) ? $_POST['item_number' . $i] : '';
$item_name = isset($_POST['item_name' . $i]) ? $_POST['item_name' . $i] : '';
$quantity = isset($_POST['quantity' . $i]) ? $_POST['quantity' . $i] : '';
$custom = isset($_POST['custom' . $i]) ? $_POST['custom' . $i] : '';

$current_item = array(
'item_number' => $item_number,
'item_name' => $item_name,
'quantity' => $quantity,
'custom' => $custom
);

array_push($cart_items, $current_item);
$i++;
}

writeToFile("::::::::::::::::after Cart Items\n");
// Advanced and Custom Information
$custom = isset($_POST['custom']) ? $_POST['custom'] : '';
$invoice = isset($_POST['invoice']) ? $_POST['invoice'] : '';
//$invoice = "1-62-250309070328";
$memo = isset($_POST['memo']) ? $_POST['memo'] : '';

$option_name0 = isset($_POST['option_name0']) ? $_POST['option_name0'] : '';
$option_name1 = isset($_POST['option_name1']) ? $_POST['option_name1'] : '';
$option_name2 = isset($_POST['option_name2']) ? $_POST['option_name2'] : '';
$option_selection0 = isset($_POST['option_selection0']) ? $_POST['option_selection0'] : '';
$option_selection1 = isset($_POST['option_selection1']) ? $_POST['option_selection1'] : '';
$option_selection2 = isset($_POST['option_selection2']) ? $_POST['option_selection2'] : '';
$tax = isset($_POST['tax']) ? $_POST['tax'] : '';

// Website Payments Standard, Website Payments Pro, and Refund Information
$auth_id = isset($_POST['auth_id']) ? $_POST['auth_id'] : '';
$auth_exp = isset($_POST['auth_exp']) ? $_POST['auth_exp'] : '';
$auth_amount = isset($_POST['auth_amount']) ? $_POST['auth_amount'] : '';
$auth_status = isset($_POST['auth_status']) ? $_POST['auth_status'] : '';

// Fraud Management Filters
$i = 1;
$fraud_management_filters = array();
while(isset($_POST['fraud_management_filters_' . $i]))
{
$filter_name = isset($_POST['fraud_management_filter_' . $i]) ? $_POST['fraud_management_filter_' . $i] : '';

array_push($fraud_management_filters, $filter_name);
$i++;
}

writeToFile("::::::::::::::::after Fraud Management Filters\n");

$mc_gross = isset($_POST['mc_gross']) ? $_POST['mc_gross'] : '';
//$mc_gross ="65.00";
$mc_handling = isset($_POST['mc_handling']) ? $_POST['mc_handling'] : '';
$mc_shipping = isset($_POST['mc_shipping']) ? $_POST['mc_shipping'] : '';
$mc_fee = isset($_POST['mc_fee']) ? $_POST['mc_fee'] : '';
$num_cart_items = isset($_POST['num_cart_items']) ? $_POST['num_cart_items'] : '';
$parent_txn_id = isset($_POST['parent_txn_id']) ? $_POST['parent_txn_id'] : '';
$payment_date = isset($_POST['payment_date']) ? $_POST['payment_date'] : '';
$payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';
$payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';
$pending_reason = isset($_POST['pending_reason']) ? $_POST['pending_reason'] : '';
$protection_eligibility  = isset($_POST['protection_eligibility']) ?
$_POST['protection_eligibility'] : '';
$reason_code = isset($_POST['reason_code']) ? $_POST['reason_code'] : '';
$remaining_settle = isset($_POST['remaining_settle']) ? $_POST['remaining_settle'] : '';
$shipping_method = isset($_POST['shipping_method']) ? $_POST['shipping_method'] : '';
$shipping = isset($_POST['shipping']) ? $_POST['shipping'] : '';
$tax = isset($_POST['tax']) ? $_POST['tax'] : '';
$transaction_entity = isset($_POST['transaction_entity']) ? $_POST['transaction_entity'] : '';
$txn_id = isset($_POST['txn_id']) ? $_POST['txn_id'] : '';
$txn_type = isset($_POST['txn_type']) ? $_POST['txn_type'] : '';

// Currency and Currency Exchange Information
$exchange_rate = isset($_POST['exchange_rate']) ? $_POST['exchange_rate'] : '';
$mc_currency = isset($_POST['mc_currency']) ? $_POST['mc_currency'] : '';
$settle_amount = isset($_POST['settle_amount']) ? $_POST['settle_amount'] : '';
$settle_currency = isset($_POST['settle_currency']) ? $_POST['settle_currency'] : '';

// Auction Variables
$auction_buyer_id = isset($_POST['auction_buyer_id']) ? $_POST['auction_buyer_id'] : '';
$auction_closing_date = isset($_POST['auction_closing_date']) ? $_POST['auction_closing_date'] : '';
$auction_multi_item = isset($_POST['auction_multi_item']) ? $_POST['auction_multi_item'] : '';
$for_auction = isset($_POST['for_auction']) ? $_POST['for_auction'] : '';

// Mass Payments
$i = 1;
$mass_payments = array();
while(isset($_POST['masspay_txn_id_' . $i]))
{
$masspay_txn_id = isset($_POST['masspay_txn_id_' . $i]) ? $_POST['masspay_txn_id_' . $i] : '';
$mc_currency = isset($_POST['mc_currency_' . $i]) ? $_POST['mc_currency_' . $i] : '';
$mc_fee = isset($_POST['mc_fee_' . $i]) ? $_POST['mc_fee_' . $i] : '';
$mc_gross = isset($_POST['mc_gross_' . $i]) ? $_POST['mc_gross_' . $i] : '';
$receiver_email = isset($_POST['receiver_email_' . $i]) ? $_POST['receiver_email_' . $i] : '';
$status = isset($_POST['status_' . $i]) ? $_POST['status_' . $i] : '';
$unique_id = isset($_POST['unique_id_' . $i]) ? $_POST['unique_id_' . $i] : '';

$current_payment_data_set = array(
'masspay_txn_id' => $masspay_txn_id,
'mc_currency' => $mc_currency,
'mc_fee' => $mc_fee,
'mc_gross' => $mc_gross,
'receiver_email' => $receiver_email,
'status' => $status,
'unique_id' => $unique_id
);

array_push($mass_payments, $current_payment_data_set);
$i++;
}

writeToFile('::::::::::::::::after Mass Payments\n');

// Recurring Payments Information
$initial_payment_status = isset($_POST['initial_payment_status']) ? $_POST['initial_payment_status'] : '';
$initial_payment_txn_id = isset($_POST['initial_payment_txn_id']) ? $_POST['initial_payment_txn_id'] : '';
$recurring_payment_id = isset($_POST['recurring_payment_id']) ? $_POST['recurring_payment_id'] : '';
$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
$product_type = isset($_POST['product_type']) ? $_POST['product_type'] : '';
$period_type = isset($_POST['period_type']) ? $_POST['period_type'] : '';
$payment_cycle = isset($_POST['payment_cycle']) ? $_POST['payment_cycle'] : '';
$outstanding_balance = isset($_POST['outstanding_balance']) ? $_POST['outstanding_balance'] : '';
$amount_per_cycle = isset($_POST['amount_per_cycle']) ? $_POST['amount_per_cycle'] : '';
$initial_payment_amount = isset($_POST['initial_payment_amount']) ? $_POST['initial_payment_amount'] : '';
$profile_status = isset($_POST['profile_status']) ? $_POST['profile_status'] : '';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '';
$time_created = isset($_POST['time_created']) ? $_POST['time_created'] : '';
$next_payment_date = isset($_POST['next_payment_date']) ? $_POST['next_payment_date'] : '';

// Subscription Variables
$subscr_date = isset($_POST['subscr_date']) ? $_POST['subscr_date'] : '';
$subscr_effective = isset($_POST['subscr_effective']) ? $_POST['subscr_effective'] : '';
$period1 = isset($_POST['period1']) ? $_POST['period1'] : '';
$period2 = isset($_POST['period2']) ? $_POST['period2'] : '';
$period3 = isset($_POST['period3']) ? $_POST['period3'] : '';
$amount1 = isset($_POST['amount1']) ? $_POST['amount1'] : '';
$amount2 = isset($_POST['amount2']) ? $_POST['amount2'] : '';
$amount3 = isset($_POST['amount3']) ? $_POST['amount3'] : '';
$mc_amount1 = isset($_POST['mc_amount1']) ? $_POST['mc_amount1'] : '';
$mc_amount2 = isset($_POST['mc_amount2']) ? $_POST['mc_amount2'] : '';
$mc_amount3 = isset($_POST['mc_amount3']) ? $_POST['mc_amount3'] : '';
$mc_currency = isset($_POST['mc_currency']) ? $_POST['mc_currency'] : '';
$recurring = isset($_POST['recurring']) ? $_POST['recurring'] : '';
$reattempt = isset($_POST['reattempt']) ? $_POST['reattempt'] : '';
$retry_at = isset($_POST['retry_at']) ? $_POST['retry_at'] : '';
$recur_times = isset($_POST['recur_times']) ? $_POST['recur_times'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$subscr_id = isset($_POST['subscr_id']) ? $_POST['subscr_id'] : '';

// Dispute Notification Variables
$case_id = isset($_POST['case_id']) ? $_POST['case_id'] : '';
$case_type = isset($_POST['case_type']) ? $_POST['case_type'] : '';
$case_creation_date = isset($_POST['case_creation_date']) ? $_POST['case_creation_date']:'';


writeToFile("::::::::::::::::after Dispute Notification Variables\n");

//......END NEW CHNAGES..

//writeToFile("\n I AM AFTER -strpos(".$_SERVER['REMOTE_ADDR']);
//require_once './paypal.inc.php';

// repost the variables we get to paypal site
// for validation purpose
//$result = fsockPost($paypal['url'], $_POST);
if(isset($_POST))
{
  $AllPostedValues="";
  foreach ($_POST as $key => $val)
  {
         $AllPostedValues=$AllPostedValues." $key => $val \n";
  }
}
writeToFile("\n I AM AFTER -fsockPost(".$paypal['url'].", $AllPostedValues )");
//check the ipn result received back from paypal
//if (eregi("VERIFIED", $result)) {
     writeToFile("\n I AM AFTER -VERIFIED...\n invoice=$invoice\n gross=$mc_gross \n item_number=$item_number \n item_name=$item_name \n quantity=$quantity \n custom=$custom \n txn_id=$txn_id \n payment_status=$payment_status");
//	$IsValid=true;

//...Checking the paypal status since paypal is not returing verfied status							
				
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
		$ord_pmnt_split_pay_for= $my_custom_fields[7];
		$reward_sess_id				= $my_custom_fields[8];
	}
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
				
				//..create the payment order record
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
			//if(is_not_empty($tbl_cust_sess_id) && is_not_empty($_SESSION[SES_REWARD])){
			if(is_not_empty($tbl_cust_sess_id) && is_gt_zero_num($reward_sess_id)){			
				members::update_reward_bal_points($reward_sess_id,$mc_gross);				
			}
			unset($objtbl_ord_paypal_trans);
		}
		
	  writeToFile("\n Transaction Is Sucessfull......$err");
	}			
}else{
	exit;
}   
?>
