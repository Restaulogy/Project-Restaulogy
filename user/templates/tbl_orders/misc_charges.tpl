<div data-role="popup" data-dismissible="false" data-overlay-theme="f" data-theme="a1"  id='popupMiscCharges' style="width:270px;">
<div data-role="header">
	<h3><a href="#" onclick="$('#popupMiscCharges').popup('close');" data-icon="delete" style="display:inline;float: right;" data-role="button" data-iconpos="notext" data-inline="true"></a>Misc. Charges</h3>
</div>
<div data-role="content" style="padding:5px;">
		<div class="field-row">
			<label>{$_lang.tbl_orders.label.order_misc_charge}</label>
			{html_input name="order_misc_charge" value="{$tbl_ordersinfo.order_misc_charge}"}
			<div class="error" id="order_misc_charge_err"></div> 
		</div>
		<div class="field-row">
			<label>{$_lang.tbl_orders.label.order_misc_desc}</label>
			{if $tbl_ordersinfo.order_misc_desc eq ""}
				{assign var="isMiscDescFound" value=1}
			{else}
				{assign var="isMiscDescFound" value=0}
			{/if}
			<select id="misc_charge" onchange="changeMiscDescription(this.value);">
			 {foreach $_lang.tbl_orders.order_misc_desc_list as $misc_des}
				<option value="{$misc_des}" {if $misc_des eq $tbl_ordersinfo.order_misc_desc}{assign var="isMiscDescFound" value=1}selected="selected"{/if}>{$misc_des}</option> 
				{/foreach}
				<option value="">Select Other</option>
			</select>
			{html_input name="order_misc_desc" value="{$tbl_ordersinfo.order_misc_desc}" style="display:{if $isMiscDescFound eq 1}none{else}inline{/if};"}
			<div class="error" id="order_misc_desc_err"></div> 
		</div>
		
		<div class="biz_center">
			 {jqmbutton onclick="applyMiscCharges({$tbl_ordersinfo.order_id});" icon="save" value="Save"} 
		</div>	 
</div>
</div>

<div data-role="popup" data-dismissible="false" data-overlay-theme="f" data-theme="a1"  id='popupConfirmOnlineOrder' style="width:270px;">
<div data-role="header">
	<h3><a href="#" onclick="$('#popupConfirmOnlineOrder').popup('close');" data-icon="delete" style="display:inline;float: right;" data-role="button" data-iconpos="notext" data-inline="true"></a>Order Confirmation</h3>
</div>
<div data-role="content" style="padding:5px;">
		<div class="field-row">
			<label>Order Takeout Time</label>
			{html_input id="order_confirmation_takeout_time" name="order_confirmation_takeout_time" value="{$tbl_ordersinfo.order_takeout_time}"}
			<div class="error" id="order_confirmation_takeout_time_err"></div> 
		</div>  
		<div class="biz_center">
			 {jqmbutton onclick="applyOrderConfirmation({$tbl_ordersinfo.order_id});" icon="save" value="Confirm"} 
		</div>	 
</div>
</div>

