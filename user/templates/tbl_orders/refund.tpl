<div data-role="popup" id="popupRefund" data-theme="b" data-overlay-theme="g" data-dismissible="false" style="width: 270px;">	
 <div data-role="header">
 	<h1>Refund Transation</h1> 
</div>	
<div data-role="content" style="padding:5px;">
<form name="refundForm" action="{$website}/user/tbl_ord_refund.php" onsubmit="return validateRefundForm();">
	  <label>Refund Type</label>
		<select name="refund_type" id="refund_type" onclick="changeRefundType(this.value);"> 
				 <option value="FULL">Full</option>
			 	 <option value="PARTIAL">Partial</option>
		</select> 
		 
		<div id="partial_block" style="display:none;">
		<div class="field_row">
				<label>Refund Amount</label>
				<input type="text" name="refund_amt" id="refund_amt" value=""/>
				<div class="error" id="refund_amt_err"></div>
		</div>
		<div class="field_row">
				<label>Refund Note</label>
				<textarea type="text" name="refund_note" id="refund_note"></textarea>
				<div class="error" id="refund_note_err"></div>
		</div> 
		</div> 
		<div class="biz_center">
			{html_input type="hidden" name="trans_id"}
			{html_input type="hidden" name="trans_amt"}
			{html_input type="hidden" name="refunded_amt"} 
			{html_input type="hidden" name="isPayByCash" value="{$tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash}"}
		  {jqmbutton  type="submit" id='submit_refund' icon="reload" value="Refund Now"}	  
			{jqmbutton  type="cancel" onclick="$('#popupRefund').popup('close');"}
		</div> 
</form>  
</div>
</div>
<div data-role="popup" id="popupRefundList" data-theme="b" data-overlay-theme="g" data-dismissible="false" style="width: 270px;">	
 <div data-role="header">
 	<h1>Transactions</h1> 
</div>	
<div data-role="content" style="padding:5px;">
		<label>Paypal Id : <b id="trans_paypal_holder" style="color:rgb(139, 180, 63);"></b></label>
		<label>Amount : <b id="trans_amt_holder" style="color:rgb(139, 180, 63);"></b></label> 
		<label>Type : <b id="trans_type_holder"  style="color:rgb(139, 180, 63);"></b></label>  
		
		<h3>List of Refunds</h3>
		<div id="contentHolder"></div>
		<div class="biz_center"> 
			{jqmbutton  type="cancel" onclick="$('#popupRefundList').popup('close');"}
		</div> 
</div>
</div>

 
