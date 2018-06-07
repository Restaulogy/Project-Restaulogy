<?php
//..include the paypal constaants and functions
include_once(dirname(dirname(__FILE__)).'/paypal.inc.php');

include_once("header.php");

$active_page = "tbl_ord_refund";

$err_ms='';

// Set request-specific fields.
$transactionID ='2E184202BY0131250';
//$transactionID ='1K247469KX525241F';

//$transactionID = urlencode('example_transaction_id');
$transactionID = urlencode($transactionID);
$refundType = urlencode('Partial');//'Full' or 'Partial'
$amount=2;												 // required if Partial.
$memo="sample test memo";				  // required if Partial.
$currencyID = urlencode('USD');	// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

// Add request-specific fields to the request string.
$nvpStr = "&TRANSACTIONID=$transactionID&REFUNDTYPE=$refundType&CURRENCYCODE=$currencyID";

if(isset($memo)) {
	$nvpStr .= "&NOTE=$memo";
}

if(strcasecmp($refundType, 'Partial') == 0) {
	if(!isset($amount)) {
		$err_msg.='Partial Refund Amount is not specified.';
	} else {
 		$nvpStr = $nvpStr."&AMT=$amount";
	}

	if(!isset($memo)) {
		$err_msg.='Partial Refund Memo is not specified.';
	}
}
//..if error is not there then proceed
if(is_not_empty($err_msg)){
		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = PPHttpPost('RefundTransaction', $nvpStr);

		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {

			if(is_gt_zero_num($transactionID)){
				//..Fetch the order paypal detail based on the transaction id
				$objtbl_ord_paypal_trans=new tbl_ord_paypal_trans();
				$paypal_record = $objtbl_ord_paypal_trans->readObject(array(PAYPAL_TXN_ID=>$transactionID));
				unset($objtbl_ord_paypal_trans);
				
				if(is_not_empty($paypal_record)){
					//..add on record to the our refund table
					$objtbl_ord_refund=new tbl_ord_refund();
					$isSuccess = $objtbl_ord_refund->create($paypal_record[PAYPAL_ID], $memo, $refund_amnt, '', '');
					unset($objtbl_ord_refund);		
				}		
			}	
			
			$err = "<div class='info'>Refund Completed Successfully</div>";			
			//exit('Refund Completed Successfully: '.print_r($httpParsedResponseAr, true));	
	}
}else{
	$msg .='RefundTransaction failed: ' . print_r($httpParsedResponseAr, true).'<br>'.$err_msg;
	$err = "<div class='error'>$msg</div>";
}
$template = "tbl_ord_refund/view.tpl";
$smarty->assign('active_page',$active_page);

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