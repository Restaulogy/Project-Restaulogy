
<div id="popupKitchenSendmsg" data-overlay-theme="f" data-role="popup" data-dismissible="false">
<div data-role="header">
<h1>Send Message</h1>
</div>
<div data-role="content">

<form id="frmKitchenSendmsg" name="frmKitchenSendmsg" action="{$website}/user/tbl_orders.php" method="POST"  onsubmit="return validatesend_msg();">
   
	{$_lang.main.kitchen.send_message} {$_lang.main.to} : &nbsp;  
	<select name='msg_to' id='msg_to'>
		<option value='server' selected="selected">Server</option>
		<option value='manager'>Manager</option>		
	</select> 
	
	<textarea id='kitchen_messsage' name='kitchen_messsage' ></textarea>
	<div class="error" id="kitchen_messsage_err"></div>
	 
   	<div class="clearfix line_break"></div>
	<!-- <input type="hidden" name="report" value="{$report}"/>-->
	<center>
	 <input type="hidden" name="kitchen_send" value="1"/>
	 <input type="hidden" name="order_id" value="{$tbl_ordersinfo.order_id}"/>
	 <input type="hidden" name="sub_id" value="{$sub_id}"/>
	 <input  data-inline="true" data-icon="search" data-iconpos="left"   value='{$_lang.main.kitchen.send_message}' type='submit'/> 
	 <input type='button' data-role="button" data-inline="true" data-icon="delete" data-iconpos="left" value='Cancel' onclick="$('#kitchen_messsage_err').html('');$('#popupKitchenSendmsg').popup('close');"/></center>
</form>
</div>
</div>   

<div class="clearfix line_break"></div>