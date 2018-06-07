<?php
include_once(dirname(dirname(__FILE__)).'/init.php');

$order_id = get_input('order_id',0);
//..Capture the input from the payment process
$ord_pmnt_split_amng 	= get_input('ord_pmnt_split_amng',0);
$payment_choice 			= get_input('payment_choice','');
$order_payment_id 		= get_input('order_payment_id',0);
$order_amt_i_pay			= get_input('order_amt_i_pay',0);
$order_tip 						= get_input('order_tip',0);
$order_takeout_email 	= get_input('order_takeout_email','');

$ord_pmnt_split_pay_for 	= get_input('ord_pmnt_split_pay_for',1);

$open_recpeipt 	= get_input('open_recpeipt',0);

//..this variable for the rewards points option only
if(is_gt_zero_num($_SESSION[SES_REWARD]['id']))
	$reward_sess_id=$_SESSION[SES_REWARD]['id'];
else
	$reward_sess_id=0;

//..local 
 //$isPayByCash 					= 1;
//..server
$isPayByCash 					= get_input('isPayByCash',0);
  
if(is_gt_zero_num($_SESSION['guid']) || is_gt_zero_num($_SESSION[SES_COOKIE_UID])){
  if(is_gt_zero_num($_SESSION['guid'])){
		$customer_id = $_SESSION['guid'];
		$customer_type = CUST_TYPE_LOGIN;
	}else{
		$customer_id = $_SESSION[SES_COOKIE_UID];
		$customer_type = CUST_TYPE_COOKIE;
	} 
}else{
	if(is_not_empty($_SESSION[SES_CUST_NM])){
		$customer_id =  checkNcreateUserCookieId($_SESSION[SES_CUST_NM]);
		if(is_gt_zero_num($customer_id)){ 
			$customer_type =  CUST_TYPE_COOKIE;
		}
	}
}  
 
//print_r($_REQUEST);exit;
$custom_var=$customer_id.'|'.$payment_choice.'|'.$ord_pmnt_split_amng.'|'.$order_payment_id.'|'.$customer_type.'|'.$order_tip.'|'.$isPayByCash.'|'.$ord_pmnt_split_pay_for.'|'.$reward_sess_id; 
if(is_gt_zero_num($order_tip)){
	$allorders = biz_explode(',',tbl_orders::getAllOrdersOfSessionByOrder($order_id));
	$order_count = count($allorders);
	$each_order_tip = $order_tip  / ($order_count * 1.00);
} 
 

 if (!isset($order_id)) {
 	echo "Please select order to check out";
	exit;
 }
 //..create orders object to fect order details
 $objtbl_orders=new tbl_orders();
 if(is_not_empty($order_takeout_email)){
 	 if($objtbl_orders->readObject(array(ORDER_ID=>$order_id))){
	 		$objtbl_orders->setorder_takeout_email($order_takeout_email);
			$objtbl_orders->insert();
	 }
 } 
 
 $tbl_ordersinfo= $objtbl_orders->GetInfo($order_id);
 
 require_once 'paypal.inc.php';
 $paypal['invoice']   = $order_id;
 
  // print_r($_REQUEST);exit; 
 //for local <---
 //$mc_gross = $order_amt_i_pay;

if(is_gt_zero_num($isPayByCash)){
	 $payment_status = 'COMPLETED';
	 $custom = $custom_var;
	 $mc_gross = $order_amt_i_pay;
	 $invoice = $order_id;
	 //$txn_id =  biz_zerofill(rand(1,999999),5);
	 //$txn_id = generate_encrypted_password(uniqid(rand(0,getrandmax()),true));
	 $txn_id = '--';
	 include(dirname(dirname(__FILE__)).'/paypal/local_devipn.php');	 
	 exit;
}
 
 //for local ---> 
 
 
if(is_not_empty($tbl_ordersinfo['order_details'])==FALSE){
 	echo "There are no items in the order";
	exit;
} 
?>

<center>
    <p>&nbsp;</p>
    <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="333333">
        <br> Connecting to Paypal site..... <br>
        <a <?php echo "href='{$CONFIG->wwwroot}/user/tbl_orders.php?mode=VIEW&order_id={$order_id}'";?>  onmouseover="this.style.color='#FF0000'" onmouseout="this.style.color='#000000'" style="font-family:Arial;font-size:15px;font-weight:bold;color:black;">Go back</b>
		</font>
  </p>
</center>
<form action="<?php echo $paypal['url']; ?>"  method="post" name="frmPaypal" id="frmPaypal">

        <input type="hidden" name="cmd" value="<?php echo $paypal['cmd']; ?>">
        <input type="hidden" name="business" value="<?php echo $paypal['business']; ?>">
        <input type="hidden" name="invoice" value="<?php echo $paypal['invoice']; ?>">
		
		<input type="hidden" name="item_name" value="Restaurent Order <?php echo $paypal['invoice']; ?>">		
		<input type="hidden" name="amount" value="<?php echo $order_amt_i_pay; ?>">	
		
		<!-- custom fields -->
		<?php if($payment_choice!='') { ?>	
		<input type="hidden" name="on0" value="Payment_choice">
		<input type="hidden" name="os0" value="<?php echo $payment_choice; ?>">	
		<?php } ?>
		<?php if(is_gt_zero_num($ord_pmnt_split_amng)) { ?>	
		<input type="hidden" name="on1" value="Payment_Split_Among">
		<input type="hidden" name="os1" value="<?php echo $ord_pmnt_split_amng; ?>">
		<?php } ?>
		<?php if(is_gt_zero_num($order_payment_id)) { ?>
		<input type="hidden" name="on2" value="order_payment_id">
		<input type="hidden" name="os2" value="<?php echo $order_payment_id; ?>">	
		<?php } ?>
		<input type="hidden" name="custom" maxlength="200" value='<?php echo $custom_var; ?>'>		

        <!--<input type="hidden" name="upload" value="1">-->
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="shipping" value="0">
        <input type="hidden" name="handling" value="0">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="image_url" value="">
        <input type="hidden" name="no_note" value="0">
        <input type="hidden" name="cn" value="Message to Seller">
        <input type="hidden" name="return" value="<?php echo $paypal['site_url'].$paypal['success_url']; ?>">
<input type="hidden" name="cancel_return" value="<?php echo $paypal['site_url'].$paypal['cancel_url']; ?>">
<input type="hidden" name="notify_url" value="<?php echo $paypal['site_url'].$paypal['notify_url']; ?>">
        <input type="hidden" name="rm" value="<?php echo $paypal['return_method']; ?>">
        <input type="hidden" name="lc" value="<?php echo $paypal['lc']; ?>">
        <input type="hidden" name="bn" value="<?php echo $paypal['bn']; ?>">
        <input type="hidden" name="cbt" value="Continue >>">
</form> 
<script language="JavaScript" type="text/javascript">
window.onload=function() {
	  window.document.frmPaypal.submit();
	//window.location.href="list_furniture.php";
	//parent.change_parent_url('http://www.devastationevent.com/arcade/admin');
}
</script>