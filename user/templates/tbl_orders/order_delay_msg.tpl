
<div id="popupDelayOrder" data-overlay-theme="f" data-role="popup" data-dismissible="false">
<div data-role="header">
<h1>Order Delay</h1>
</div>
<div data-role="content">

<form id="frmDelayOrder" name="frmDelayOrder" action="{$website}/user/tbl_orders.php" method="POST" onsubmit="return validatedelay_msg();">
   
	<label>Order Delay Message</label> 
	<textarea id='ord_delay_msg' name='ord_delay_msg'></textarea>
	<div class="error" id="ord_delay_msg_err"></div>
	 
   	<div class="clearfix line_break"></div>
	<!-- <input type="hidden" name="report" value="{$report}"/>-->
	<center>
	  
	 <input type="hidden" name="order_id" value="{$tbl_ordersinfo.order_id}"/>
	 <input type="hidden" name="order_delayed" value="1"/>
	 <input  data-inline="true" data-icon="check" data-iconpos="left"   value='{$_lang.main.kitchen.delay_order}' type='submit'/> 
	 <input type='button' data-role="button" data-inline="true" data-icon="delete" data-iconpos="left" value='Cancel' onclick="$('#popupDelayOrder').popup('close');"/></center>
</form>
</div>
</div>   

<div class="clearfix line_break"></div>
