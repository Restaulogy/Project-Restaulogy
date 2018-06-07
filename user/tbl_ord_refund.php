<?php
//..include the paypal constaants and functions
include_once(dirname(dirname(__FILE__)).'/paypal/paypal.inc.php');

include_once('header.php');

$active_page = 'tbl_ord_refund';

$err_msg='';

// Set request-specific fields.
$trans_id 		= get_input('trans_id');
$refund_type 	= ucwords(strtolower(get_input('refund_type')));
$refund_amt 	= get_input('refund_amt',0);
$refund_note 	= get_input('refund_note'); // required if Partial.
//$transactionID ='1K247469KX525241F';
$isPayByCash  = get_input('isPayByCash',0);

if(is_gt_zero_num($trans_id)){
	$paypal_record 	= tbl_ord_paypal_trans::GetInfo($trans_id);  
	$transactionID 	= $paypal_record[PAYPAL_TXN_ID];
	if(is_not_empty($refund_type)==FALSE){
		$refund_type 		= ucwords(strtolower($paypal_record[PAYPAL_REFUND_TYPE]));
	}
	
}
  
//$transactionID = urlencode('example_transaction_id');
$transactionID 	= urlencode($transactionID);
$refundType 		= urlencode($refund_type);//'Full' or 'Partial'  
$currencyID 		= urlencode('USD');	// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

// Add request-specific fields to the request string.
$nvpStr = '&TRANSACTIONID='.$transactionID.'&REFUNDTYPE='.$refundType.'&CURRENCYCODE='.$currencyID; 
 //echo "<br> STRING PASSED--> ".$nvpStr.'<hr>';
if(isset($refund_note)) {
	$nvpStr .= '&NOTE='.$refund_note;
}

if(strcasecmp($refundType, 'PARTIAL') == 0) {
	if(!isset($refund_amt)) {
		$err_msg.='Partial Refund Amount is not specified.';
	} else {
 		$nvpStr = $nvpStr.'&AMT='.$refund_amt;
	}

	if(!isset($refund_note)) {
		$err_msg.='Partial Refund Memo is not specified.';
	}
} 
//..if error is not there then proceed
if(is_not_empty($err_msg)==FALSE){
		// Execute the API operation; see the PPHttpPost function above.
		if(is_gt_zero_num($isPayByCash)){
			 $httpParsedResponseAr = array('ACK'=>'SUCCESS');
		}else{
			 $httpParsedResponseAr = PPHttpPost('RefundTransaction', $nvpStr);
		}
	
		
		if('SUCCESS' == strtoupper($httpParsedResponseAr['ACK']) || 'SUCCESSWITHWARNING' == strtoupper($httpParsedResponseAr['ACK'])) {

			if(is_gt_zero_num($trans_id)){
				//..Fetch the order paypal detail based on the transaction id 
				
				if($paypal_record[PAYPAL_REFUND_TYPE] == 'NONE' || is_not_empty($paypal_record[PAYPAL_REFUND_TYPE]) == FALSE){ 
					$objtbl_ord_paypal_trans=new tbl_ord_paypal_trans();
				 $res = $objtbl_ord_paypal_trans->readObject(array(PAYPAL_ID=>$trans_id));  
						if($res){  
						 $objtbl_ord_paypal_trans->setpaypal_refund_type(strtoupper($refund_type));
						 $objtbl_ord_paypal_trans->insert();
						}
				}  
				unset($objtbl_ord_paypal_trans); 
				if(is_not_empty($paypal_record)){
					//..add on record to the our refund table
					$objtbl_ord_refund=new tbl_ord_refund();
					if(is_not_empty($httpParsedResponseAr[GROSSREFUNDAMT])){
						 if($refund_amt != urldecode($httpParsedResponseAr[GROSSREFUNDAMT])){
									$refund_amt = urldecode($httpParsedResponseAr[GROSSREFUNDAMT]);
						} 
					}
				 
					$isSuccess = $objtbl_ord_refund->create($paypal_record[PAYPAL_ID], $refund_note, $refund_amt);
					unset($objtbl_ord_refund);		
				}		
			}	
			//print_r($httpParsedResponseAr);
			$_SESSION[SES_FLASH_MSG] = '<div class="success">Refund Completed Successfully.</div>';			
			//exit('Refund Completed Successfully: '.print_r($httpParsedResponseAr, true));
		  biz_script_forward($_SERVER[HTTP_REFERER]);		
	}else{
		$msg .='RefundTransaction failed: ' . print_r($httpParsedResponseAr, true).'<br>'.$err_msg;
		$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$msg.'</div>';
		 print_r($_SESSION[SES_FLASH_MSG]);
		 
	}
	
}else{
	$msg .='RefundTransaction failed: ' . print_r($httpParsedResponseAr, true).'<br>'.$err_msg;
	$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$msg.'</div>';
	print_r($_SESSION[SES_FLASH_MSG]);
}
 //biz_script_forward($_SERVER[HTTP_REFERER]);
/*$template = "tbl_ord_refund/view.tpl";
$smarty->assign('active_page',$active_page);*/

/*
success response
Refund Completed Successfully: Array
(
    [REFUNDTRANSACTIONID] => 81285450X1034473S
    [FEEREFUNDAMT] => 0%2e33
    [GROSSREFUNDAMT] => 11%2e52
    [NETREFUNDAMT] => 11%2e19
    [CURRENCYCODE] => USD
    [TIMESTAMP] => 2013%2d11%2d08T06%3a42%3a47Z
    [CORRELATIONID] => 5c5093ccba39b
    [ACK] => Success
    [VERSION] => 51%2e0
    [BUILD] => 8334781
)
failure response
RefundTransaction failed: Array
(
    [TIMESTAMP] => 2013%2d11%2d08T06%3a52%3a01Z
    [CORRELATIONID] => 72f7b589bf201
    [ACK] => Failure
    [VERSION] => 51%2e0
    [BUILD] => 8334781
    [L_ERRORCODE0] => 10009
    [L_SHORTMESSAGE0] => Transaction%20refused
    [L_LONGMESSAGE0] => This%20transaction%20has%20already%20been%20fully%20refunded
    [L_SEVERITYCODE0] => Error
)
*/
?>