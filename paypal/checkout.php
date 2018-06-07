<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php";
$curr_user = get_loggedin_userid();
require_once 'checkout-functions.php';

if (!($curr_user)){
    //echo "Please Login to view this page";
    $curr_user=0;
    //exit;
}

if (isset($_GET['event_id']) && (int)$_GET['event_id'] > 0)
    $event_id  = $_GET['event_id'];
else
    $event_id  = 0;

if (isset($_GET['is_pay_at_door']) && (int)$_GET['is_pay_at_door'] == 1){
   //... functionality for Pay At Door Ticket save
     $is_pay_at_door = 1;
     $orderID = 0;
   //.. STEP 1 :   Place An Order
     $orderID = saveOrder($event_id, $is_pay_at_door);

     if($orderID){
        //.. STEP 2 :   Save Fair RSVP
      $sql_stmt_for_rsvp = "INSERT INTO `rsvp` (`createdby`,`schedule_id`,`order_id`,`name`,`email`,`ticket_id`) values ";
	   $rsvp_persons_mail = array();
		 for ($i=1; $i<=$_POST['row_incrementor']; $i++){
			if ($i==1){
				$const_var_name = $_POST["rsvp_name1"];
				$const_var_email = $_POST["rsvp_email1"];
				$tmp_var_name = $const_var_name;
				$tmp_var_email= $const_var_email;
				$rsvp_persons_mail[] = $tmp_var_email;
   			}else{
               if((strlen(trim($_POST["rsvp_name$i"])))!=0){
                	$tmp_var_name = $_POST["rsvp_name$i"];
	  			}else{
                	$tmp_var_name = $const_var_name;
	 			}
	 			if((strlen(trim($_POST["rsvp_email$i"])))!=0){
                	$tmp_var_email = $_POST["rsvp_email$i"];
					$rsvp_persons_mail[] = $tmp_var_email;
	  			}else{
                	$tmp_var_email = $const_var_email;
	 			}
	 		}

		    $sql_stmt_for_rsvp .="($curr_user, $event_id, $orderID,
				'".mysql_real_escape_string($tmp_var_name)."',
				'".mysql_real_escape_string($tmp_var_email)."',
				".mysql_real_escape_string($_POST["rsvp_ticket_id$i"]).")";
			if ($i==$_POST['row_incrementor'])
		  		$sql_stmt_for_rsvp .=";";
			else
			    $sql_stmt_for_rsvp .=",";
		  }
		//echo $sql_stmt_for_rsvp;
		
		//print_r($rsvp_persons_mail);
	    @mysql_query($sql_stmt_for_rsvp);
	    @add_bulk_mail_to_new_rsvp($rsvp_persons_mail,$event_id);

	    //
	    echo "<center><b>Your Transacation is Successfull</b> <br><input type=\"button\" onclick=\"window.location.href='edit_event.php?id=$event_id';\" value=\"Close\"></center> ";
	 }else{
        echo "<center><b>Sorry! Problem During Placing an order.</b> <br><input type=\"button\" onclick=\"self.close();\" value=\"Close\"></center> ";
  	 }
   
     exit;
    
}else{
  //... functionality for paypal  Ticket save


if (isset($_GET['step']) && (int)$_GET['step'] > 0 && (int)$_GET['step'] <= 3) {
	$step = (int)$_GET['step'];

	$includeFile = '';
	if ($step == 1) {
		$includeFile = 'shippingAndPaymentInfo.php';
		$pageTitle   = 'Checkout - Step 1 of 2';
	} else if ($step == 2) {
		$includeFile = 'checkoutConfirmation.php';
		$pageTitle   = 'Checkout - Step 2 of 2';
	} else if ($step == 3) {
		$orderId     = saveOrder($event_id);
		
		$sql_stmt_for_rsvp = "INSERT INTO `temp_rsvp` (`createdby`,`schedule_id`,`order_id`,`name`,`email`,`ticket_id`) values ";
		 for ($i=1; $i<=$_POST['row_incrementor']; $i++){
			if ($i==1){
				$const_var_name = $_POST["rsvp_name1"];
				$const_var_email = $_POST["rsvp_email1"];
				$tmp_var_name = $const_var_name;
				$tmp_var_email= $const_var_email;
   			}else{
               if((strlen(trim($_POST["rsvp_name$i"])))!=0){
                	$tmp_var_name = $_POST["rsvp_name$i"];
	  			}else{
                	$tmp_var_name = $const_var_name;
	 			}
	 			if((strlen(trim($_POST["rsvp_email$i"])))!=0){
                	$tmp_var_email = $_POST["rsvp_email$i"];
	  			}else{
                	$tmp_var_email = $const_var_email;
	 			}
	 		}

		    $sql_stmt_for_rsvp .="($curr_user, $event_id, $orderId,
				'".mysql_real_escape_string($tmp_var_name)."',
				'".mysql_real_escape_string($tmp_var_email)."',
				".mysql_real_escape_string($_POST["rsvp_ticket_id$i"]).")";
			if ($i==$_POST['row_incrementor'])
		  		$sql_stmt_for_rsvp .=";";
			else
			    $sql_stmt_for_rsvp .=",";
		  }

	    @mysql_query($sql_stmt_for_rsvp);

		//$prodname    = getprodname($orderId);
		//$quantity    = getquantity($orderId);
		$my_paypal_id=get_my_paypal_id($event_id);
		//$orderAmount = 100;
		
  		$_SESSION['orderId'] = $orderId;

		//delete_temp_order_stock($orderId);
 		// our next action depends on the payment method
		// if the payment method is COD then show the 
		// success page but when paypal is selected
		// send the order details to paypal
	   $includeFile = 'payment.php';

	}
}

}/*End OF IF for "pay at door" && "Paypal save"*/
?>
<script language="JavaScript" type="text/javascript" src="checkout.js"></script>
<?php
require_once "$includeFile";
?>
