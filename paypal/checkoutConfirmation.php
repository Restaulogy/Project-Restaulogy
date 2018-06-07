<?php

$curr_user = get_loggedin_userid();



 /******New Functionality*******/

 if((isset($_POST["pay_at_door"])) && ($_POST["pay_at_door"] == 1)){
     $is_pay_at_door = 1;
	 $prefix = "PAD_";
	 $event_id = $_POST["{$prefix}tc_event_id"];
     $form_action = "checkout.php?is_pay_at_door=1&event_id=$event_id";
 }else{
     $is_pay_at_door = 0;
     $prefix = "PP_";
     $event_id = $_POST["{$prefix}tc_event_id"];
     $form_action = "checkout.php?step=3&event_id=$event_id";
 }

if($event_id > 0){
 
 $all_tickets = get_all_ticket_id($event_id);
 foreach($all_tickets as $ticket_id){
    $QTY[$ticket_id] = get_tickets_avaliable_qty($ticket_id);
 }
$is_all_ok = true;

?>

 <script language="JavaScript" type="text/javascript">
 var sec = 00; // set the seconds
 var min = 15; // set the minutes

function countDown() {
sec--;
if (sec == -01) {
sec = 59;
min = min - 1; }
else {
min = min; }

if (sec<=9) { sec = "0" + sec; }

time = (min<=9 ? "0" + min : min) + " min and " + sec + " sec ";

if (document.getElementById) { document.getElementById('theTime').innerHTML = time; }

SD=window.setTimeout("countDown();", 1000);
if (min == '00' && sec == '00') { sec = "00"; window.location.href='edit_event.php?id=<?php echo $event_id?>'; }
}
window.onload = countDown;
// -->
</script>

<?php
if($isMobile){
?>

    <link href="css/shop.css" rel="stylesheet" type="text/css">

	<script src="form_validations.js" type="text/javascript" language="javascript"></script>
	
	<link rel="stylesheet" type="text/css" href="css/screen.css" />

	<!-- for Mobile Start -->
    <link href="<?php echo $CONFIG->wwwroot;?>vendors/jquerymobile/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $CONFIG->wwwroot;?>vendors/jquerymobile/jquery.mobile-extra-icon.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $CONFIG->wwwroot;?>vendors/jquerymobile/jquery-1.6.4.min.js"></script>
<script src="<?php echo $CONFIG->wwwroot;?>vendors/jquerymobile/jquery.mobile.min.js"></script>

<script src="<?php echo $CONFIG->wwwroot;?>vendors/jquery/simple_validator.js"></script>

<?php
}else{
?>
    <link href="css/shop.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<script src="form_validations.js" type="text/javascript" language="javascript"></script>
<?php
}
?>
<!-- This goes into the BODY of the file -->

<?php
if($isMobile){
?>
<div data-role="page">
    <div data-role="header">
		<h1>Confirm Order</h1>
	</div>
    <div data-role="content">
		<small>
			Please complete registration within 15:00 minutes. After 15:00 minutes, the reservation we&rsquo;re holding will be released to others.
		</small>
		<br/><br/>
		<b>Remaining Time:</b> <span id="theTime" class="timeClass"></span>
		<br><br>
		<form action="<?php echo $form_action; ?>" method="post" name="frmCheckout" id="frmCheckout" onsubmit="return validate_rsvp_mail();" data-ajax="false">
    <?php
        $finalOP="";
        $total=0;

        if((strlen(trim($_POST["{$prefix}selitems"])))>0){
           if((strpos($_POST["{$prefix}selitems"],","))===false){
               $selitems= $_POST["{$prefix}selitems"];
           }else{
              $selitems= explode(",", $_POST["{$prefix}selitems"]);
           }

           if (is_array($selitems)){
    		 // Do Nothing
           }else{
                $selitems = array ($selitems);
           }

           $finalOP .="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\" class=\"infoTable\" style=\"margin:0px;\">";
           $finalOP .="<tr>
            <th colspan=\"5\" align=\"center\">Ticket Information</th>
           </tr>";
           $finalOP .="<tr class=\"label\">
            <td  valign=\"top\">Item</td>
            <td align=\"right\" valign=\"top\" style=\"width:30px !important;\">Unit Price($)</td>
            <td align=\"right\" valign=\"top\">Discount(%)</td>
            <td align=\"right\" valign=\"top\">Total($)</td>

            <td align=\"right\" valign=\"top\">Unsold</td>
            </tr>";
            $item_in_cart=0;
               foreach ($selitems as $i) {

                $REMAINING_QTY = $QTY[$_POST["{$prefix}item_id_$i"]]-$_POST["{$prefix}item_qty_$i"];
    			if($REMAINING_QTY >=0){
    				$is_ok = true;
    				$str_background = "background:white;";
       			}else{
                	$is_ok = false;
                	$is_all_ok = false;
                	$str_background = "background:pink;";
    			}

				$itmprice =  $_POST["{$prefix}item_price_$i"] - ($_POST["{$prefix}item_discount_$i"]/100*$_POST["{$prefix}item_price_$i"]);

                $subTotal =  round(($itmprice * $_POST["{$prefix}item_qty_$i"]), 2);
                $total=$total+$subTotal;
                if($subTotal>0){

                $finalOP .="<tr class=\"content\" >
                <td class=\"content\">".$_POST["{$prefix}item_qty_$i"]." X <em style='color:#777;'>".$_POST["{$prefix}item_name_$i"]."</em></td>
                <td class=\"content\" align=\"right\">".$_POST["{$prefix}item_price_$i"]."</td>
                <td class=\"content\" align=\"right\">".$_POST["{$prefix}item_discount_$i"]."</td>
                <td class=\"content\" align=\"right\">$subTotal</td>
                <td align=\"right\" style='$str_background'>
                 $REMAINING_QTY
                 <input type=\"hidden\" id=\"item_qty_$item_in_cart\"  name=\"item_qty_$item_in_cart\" value=\"".$_POST["{$prefix}item_qty_$i"]."\">
            <input type=\"hidden\" id=\"item_price_$item_in_cart\"  name=\"item_price_$item_in_cart\" value=\"".$_POST["{$prefix}item_price_$i"]."\">
            <input type=\"hidden\" id=\"item_name_$item_in_cart\"  name=\"item_name_$item_in_cart\" value=\"".$_POST["{$prefix}item_name_$i"]."\">
            <input type=\"hidden\" id=\"item_id_$item_in_cart\" name=\"item_id_$item_in_cart\" value=\"".$_POST["{$prefix}item_id_$i"]."\">
            <input type=\"hidden\" id=\"item_discount_$item_in_cart\" name=\"item_discount_$item_in_cart\" value=\"".$_POST["{$prefix}item_discount_$i"]."\">
               	</td>
            </tr>

            ";
                 $item_in_cart=$item_in_cart+1;
             }

            if($is_ok){
                update_stock($event_id,$_POST["{$prefix}item_id_$i"],$_POST["{$prefix}item_qty_$i"], "wip");
			}else{
			     $finalOP .=	"<tr>
				</tr>";
   		   }

           }


		  $tmp_ticket_output = "
		<table  class='job_detail_panal_table' style=\"font-size:10px !important;\">
			<tr>
			    <th colspan=\"4\"><small>RSVP Informarion</small></th>
			</tr>
		";
		$sel_user = get_user($curr_user);
		//...Changes made by sangram for guest user
       //...take first email and name only ..it should be mandatory
       if(!(isset($_SESSION["guid"]))) {
            //..check weather guest user in session details..if he is coming from
            if(isset($_SESSION['guest_usr_email'])){
                $log_usr_state=ucwords($_SESSION['guest_usr_state']) ;
                $log_usr_metro=ucwords($_SESSION['guest_usr_metro']);
                $log_usr_phone="";
                $log_usr_zip="";
                $curr_user=0;
            }
       }else{
            $user=get_entity($curr_user);
            $log_usr_name=ucwords($user->name);;
            $log_usr_state=ucwords($user->user_state);
            $log_usr_metro=ucwords($user->location);
            $log_usr_phone=ucwords($user->phone);
            $log_usr_zip=ucwords($user->zip);
       }
		$row_incrementor = 0;
		foreach ($selitems as $i){
			if ($_POST["{$prefix}item_qty_$i"]>0){
                $tmp_ticket_output.= "
				<tr>
					<td colspan='4' style='color:#17a;'><b>".$_POST["{$prefix}item_name_$i"]."</b></td>
				</tr>";

			for ($j=1; $j<=$_POST["{$prefix}item_qty_$i"]; $j++){
				$row_no = $row_incrementor+$j;
				if($row_no==1){
                    $tmpname =(isset($sel_user->name)? $sel_user->name : "");
                 //..check weather guest user in session details..if he is coming from
					 if ((!(isset($_SESSION["guid"])))&& (isset($_SESSION['guest_usr_email']))) {
                       $tmpemail=$_SESSION['guest_usr_email'];
                   }else{
                       $tmpemail=(isset($sel_user->email)? $sel_user->email : "");
                   }
			    }else{
                    $tmpname ="";
                    $tmpemail = "";
	  		    }

                $tmp_ticket_output.= "
				<tr>
				    <td style=\"width:30px;\" class='detail_right_td'>$j)</td>
					<td style=\"width:30px;\" class='detail_right_td'>#$row_no</td>
					<td style=\"width:70px;\" class='detail_right_td'>Name<font color='red'>".(($row_no==1) ? "*" : "")."</font></td>
					<td style=\"width:100px;\" class='detail_left_td'>
					    <input type='hidden' name='rsvp_ticket_id{$row_no}' value='".$_POST["{$prefix}item_id_$i"]."' >
					    <input type='hidden' name='rsvp_ticket_no{$row_no}' value='$j'>
						<input type='text' id='rsvp_name{$row_no}' name='rsvp_name{$row_no}' value='{$tmpname}' />
					</td>
				</tr>
				<tr>
                    <td colspan='2'></td>
					<td  class='detail_right_td'>Email<font color='red'>".(($row_no==1) ? "*" : "")."</font></td>
					<td  class='detail_left_td'>
						<input type='text' value='{$tmpemail}' id='rsvp_email{$row_no}' name='rsvp_email{$row_no}' />
					</td>
				</tr>
				";
   			}
   			$row_incrementor = $row_incrementor + $j - 1 ;
   			}
  		}
         $tmp_ticket_output.= "
				<tr>
					<td colspan='4'>
                    <font color='red'>*</font><small style='color:red;font-weight:normal;'>Name & Email Are mandotory for RSVP</small>
					</td>
				</tr>
				</table>
				";

        $finalOP .="<tr class=\"content_total\" >
            <td colspan=\"3\" align=\"right\">Total</td>
            <td class=\"content_total\" align=\"right\">$total</td>
            <td class=\"content_total\"></td>
        </tr>";
    $finalOP .="
    </table>
    <br>
    <center>
    <div>
        $tmp_ticket_output
	</div>
    </center>

    <input type=\"hidden\" id=\"selitems\" name=\"selitems\" value=\"$item_in_cart\">
    <input type=\"hidden\" id=\"row_incrementor\" name=\"row_incrementor\" value=\"$row_incrementor\">
   <br>";

        }else{
          echo "<b>There are no items selected to order.</b>";
        }
      echo $finalOP;
    ?>


		<center>
        <input name="btnBack" type="button" id="btnBack" value="&lt;&lt; Modify Order"    onClick="window.location.href='edit_event.php?id=<?php echo $event_id?>&subtab=3';"  data-inline="true" data-theme="a">
	<?php
	if($is_all_ok){
		echo '
        <input name="btnConfirm" type="submit" id="btnConfirm" value="Confirm Order &gt;&gt;" data-inline="true" data-theme="a">';
 	}else{
	echo	"<br><br>
	 	<span style='font-family:Verdana;font-size:10px;color:red;text-transform: capitalize;'>*As There are no items in the stock you cannot proceed with checkout.</span>
	 	 <br>
		";
  	}
	?>
    </center>
</form>
</td>
</tr>

</table>
		
	</div>
    <div data-role="footer">
		<h4></h4>
	</div>
</div>


    


<?php
}else{
?>

<table class="exampletbl">
	<tr>
	<td id="gradient_header">
	<b><center>Confirm Order</center></b>
	</td>
	</tr>
    <tr>
        <td>
			<small>
			Please complete registration within 15:00 minutes. After 15:00 minutes, the reservation we&rsquo;re holding will be released to others.
			</small>
		</td>
    </tr>
    <tr>
        <td>
            <table width="100%">
                <tr><td width="100%" align="center"><b>Remaining Time:</b> <span id="theTime" class="timeClass"></span></td></tr>
            </table>
        </td>
    </tr>
	<tr>
	<td>

<br>
<?php


?>
<form action="<?php echo $form_action; ?>" method="post" name="frmCheckout" id="frmCheckout">
    <?php
        $finalOP="";
        $total=0;

        if((strlen(trim($_POST["{$prefix}selitems"])))>0){
           if((strpos($_POST["{$prefix}selitems"],","))===false){
               $selitems= $_POST["{$prefix}selitems"];
           }else{
              $selitems= explode(",", $_POST["{$prefix}selitems"]);
           }

           if (is_array($selitems)){
    		 // Do Nothing
           }else{
                $selitems = array ($selitems);
           }

           $finalOP .="<table width=\"550\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\" class=\"infoTable\">";
           $finalOP .="<tr>
            <th colspan=\"5\" align=\"center\">Ticket Information</th>
           </tr>";
           $finalOP .="<tr class=\"label\">
            <td >Item</td>
            <td align=\"right\">Unit Price($)</td>
            <td align=\"right\">Discount(%)</td>
            <td align=\"right\">Total($)</td>

            <td align=\"right\">Unsold</td>
            </tr>";
            $item_in_cart=0;
               foreach ($selitems as $i) {

                $REMAINING_QTY = $QTY[$_POST["{$prefix}item_id_$i"]]-$_POST["{$prefix}item_qty_$i"];
    			if($REMAINING_QTY >=0){
    				$is_ok = true;
    				$str_background = "background:white;";
       			}else{
                	$is_ok = false;
                	$is_all_ok = false;
                	$str_background = "background:pink;";
    			}

				$itmprice =  $_POST["{$prefix}item_price_$i"] - ($_POST["{$prefix}item_discount_$i"]/100*$_POST["{$prefix}item_price_$i"]);

                $subTotal =  round(($itmprice * $_POST["{$prefix}item_qty_$i"]), 2);
                $total=$total+$subTotal;
                if($subTotal>0){

                $finalOP .="<tr class=\"content\" >
                <td class=\"content\">".$_POST["{$prefix}item_qty_$i"]." X <em style='color:#777;'>".$_POST["{$prefix}item_name_$i"]."</em></td>
                <td class=\"content\" align=\"right\">".$_POST["{$prefix}item_price_$i"]."</td>
                <td class=\"content\" align=\"right\">".$_POST["{$prefix}item_discount_$i"]."</td>
                <td class=\"content\" align=\"right\">$subTotal</td>
                <td align=\"right\" style='$str_background'>
                 $REMAINING_QTY
                 <input type=\"hidden\" id=\"item_qty_$item_in_cart\"  name=\"item_qty_$item_in_cart\" value=\"".$_POST["{$prefix}item_qty_$i"]."\">
            <input type=\"hidden\" id=\"item_price_$item_in_cart\"  name=\"item_price_$item_in_cart\" value=\"".$_POST["{$prefix}item_price_$i"]."\">
            <input type=\"hidden\" id=\"item_name_$item_in_cart\"  name=\"item_name_$item_in_cart\" value=\"".$_POST["{$prefix}item_name_$i"]."\">
            <input type=\"hidden\" id=\"item_id_$item_in_cart\" name=\"item_id_$item_in_cart\" value=\"".$_POST["{$prefix}item_id_$i"]."\">
            <input type=\"hidden\" id=\"item_discount_$item_in_cart\" name=\"item_discount_$item_in_cart\" value=\"".$_POST["{$prefix}item_discount_$i"]."\">
               	</td>
            </tr>

            ";
                 $item_in_cart=$item_in_cart+1;
             }

            if($is_ok){
                update_stock($event_id,$_POST["{$prefix}item_id_$i"],$_POST["{$prefix}item_qty_$i"], "wip");
			}else{
			     $finalOP .=	"<tr>
				</tr>";
   		   }

           }


		  $tmp_ticket_output = "
		<table style='width:500px;background:#efefef;' class='exampletbl'>
			<tr>
			    <th id='gradient_footer' colspan='4'><b style='color:#fc6300;font-weight:bold;font-size:12px;'>RSVP Informarion</b></th>
			</tr>
		";
		$sel_user = get_user($curr_user);
		//...Changes made by sangram for guest user
       //...take first email and name only ..it should be mandatory
       if(!(isset($_SESSION["guid"]))) {
            //..check weather guest user in session details..if he is coming from
            if(isset($_SESSION['guest_usr_email'])){
                $log_usr_state=ucwords($_SESSION['guest_usr_state']) ;
                $log_usr_metro=ucwords($_SESSION['guest_usr_metro']);
                $log_usr_phone="";
                $log_usr_zip="";
                $curr_user=0;
            }
       }else{
            $user=get_entity($curr_user);
            $log_usr_name=ucwords($user->name);;
            $log_usr_state=ucwords($user->user_state);
            $log_usr_metro=ucwords($user->location);
            $log_usr_phone=ucwords($user->phone);
            $log_usr_zip=ucwords($user->zip);
       }
		$row_incrementor = 0;
		foreach ($selitems as $i){
			if ($_POST["{$prefix}item_qty_$i"]>0){
                $tmp_ticket_output.= "
				<tr>
					<td colspan='4' style='color:#17a;'><b>".$_POST["{$prefix}item_name_$i"]."</b></td>
				</tr>";

			for ($j=1; $j<=$_POST["{$prefix}item_qty_$i"]; $j++){
				$row_no = $row_incrementor+$j;
				if($row_no==1){
                    $tmpname =(isset($sel_user->name)? $sel_user->name : "");
                 //..check weather guest user in session details..if he is coming from
					 if ((!(isset($_SESSION["guid"])))&& (isset($_SESSION['guest_usr_email']))) {
                       $tmpemail=$_SESSION['guest_usr_email'];
                   }else{
                       $tmpemail=(isset($sel_user->email)? $sel_user->email : "");
                   }
			    }else{
                    $tmpname ="";
                    $tmpemail = "";
	  		    }

                $tmp_ticket_output.= "
				<tr>
				    <td style='width:50px;text-align:right;'>$j)</td>
					<td style='width:60px;text-align:right;'>#$row_no</td>
					<td style='width:75px;'>Name<font color='red'>".(($row_no==1) ? "*" : "")."</font></td>
					<td style='width:325px;'>
					    <input type='hidden' name='rsvp_ticket_id{$row_no}' value='".$_POST["{$prefix}item_id_$i"]."' >
					    <input type='hidden' name='rsvp_ticket_no{$row_no}' value='$j'>
						<input type='text' name='rsvp_name{$row_no}' value='{$tmpname}' style='width:300px;'/>
					</td>
				</tr>
				<tr>
                    <td style='width:110px;' colspan='2'></td>
					<td style='width:75px;'>Email<font color='red'>".(($row_no==1) ? "*" : "")."</font></td>
					<td style='width:325px;'>
						<input type='text' value='{$tmpemail}' name='rsvp_email{$row_no}' style='width:300px;'/>
					</td>
				</tr>
				";
   			}
   			$row_incrementor = $row_incrementor + $j - 1 ;
   			}
  		}
         $tmp_ticket_output.= "
				<tr>
					<td colspan='4' id='gradient_header'>
                    <font color='red'>*</font><small style='color:red;font-weight:normal;'>Name & Email Are mandotory for RSVP</small>
					</td>
				</tr>
				</table>
				";

        $finalOP .="<tr class=\"content_total\" >
            <td colspan=\"3\" align=\"right\">Total</td>
            <td class=\"content_total\" align=\"right\">$total</td>
            <td class=\"content_total\"></td>
        </tr>";
    $finalOP .="
    </table>
    <br>
    <center>
    <div style='width:550px;height:300px;overflow-y:scroll;'>
        $tmp_ticket_output
	</div>
    </center>

    <input type=\"hidden\" id=\"selitems\" name=\"selitems\" value=\"$item_in_cart\">
    <input type=\"hidden\" id=\"row_incrementor\" name=\"row_incrementor\" value=\"$row_incrementor\">
   <br>";

        }else{
          echo "<b>There are no items selected to order.</b>";
        }
      echo $finalOP;
    ?>


		<center>
        <input name="btnBack" type="button" id="btnBack" value="&lt;&lt; Modify Order"  class="orange_button" onClick="window.location.href='edit_event.php?id=<?php echo $event_id?>&subtab=3';" >
	<?php
	if($is_all_ok){
  echo '&nbsp;&nbsp;
        <input class="orange_button" name="btnConfirm" type="submit" onClick="return validate_rsvp_mail();" id="btnConfirm" value="Confirm Order &gt;&gt;" >';
 	}else{
	echo	"<br><br>
	 	<span style='font-family:Verdana;font-size:10px;color:red;text-transform: capitalize;'>*As There are no items in the stock you cannot proceed with checkout.</span>
	 	 <br>
		";
  	}
	?>
    </center>
</form>
</td>
</tr>
<tr>
	<td id="gradient_footer">
	</td>
</tr>
</table>

<?php
}
?>

<script type='text/javascript'>
	function validate_rsvp_mail(){


	 	var rows = document.getElementById('row_incrementor').value;

		var errors = "";
		for(i=1; i<=rows; i++){
			var val_rsvp_name = trim(document.getElementById('rsvp_name'+i).value);
			var val_rsvp_email = trim(document.getElementById('rsvp_email'+i).value);
			if(i==1)
			    var error = check_mail_name_for_rsvp(val_rsvp_name,val_rsvp_email);
			else
			    var error = check_mail_name_for_rsvp(val_rsvp_name,val_rsvp_email,1);

			if (error.length == 0){
   			}else{
				errors = errors + "\n For Ticket #"+i+" :\n" + error;
	  		}
  		}
		if (errors.length == 0){
				return true;
  		}else{
			alert(errors);
			return false;
		}
	 }
</script>

<?php
}
?>
