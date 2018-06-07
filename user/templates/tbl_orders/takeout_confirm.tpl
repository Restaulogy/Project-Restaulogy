<div data-role="popup" id="popupConfirmOrder" data-dismissible="false" style="width: 270px;" data-overlay-theme="f">
			<div data-role="header">
				<h1>Confirm Order</h1>
			</div>
			<div data-role="content" style="padding: 5px;">
					<label>{$_lang.tbl_orders.label.order_takeout_time} (min.)</label>
					<input type="text" id="order_takeout_time" name="order_takeout_time" value=""/> 
					<div class="error" id="order_takeout_time_err"></div>
					<div class="biz_center">
					  <input type="hidden" id="takeout_order_id" value="{$tbl_ordersinfo.order_id}"/>
						<input data-inline="true" data-icon="check" type="button" onclick="confirmTakeOutOrder();" value="Confirm"/>
						<input type="button" data-inline="true" data-icon="delete" value="{$_lang.close_lbl}" onclick="$('#popupConfirmOrder').popup('close');"/>
					</div>
			</div> 
</div>

<div data-role="popup" id="popupConvertTakeOut" data-dismissible="false" style="width: 270px;" data-overlay-theme="f">
			<div data-role="header">
				<h1>Convert To Dine-in</h1>
			</div>
			<div data-role="content" style="padding: 5px;">
					<label>{$_lang.tbl_orders.label.order_table_id}</label>
					<select id="ord_table">
					{foreach $availtables as $availtbl}
						<option value="{$availtbl@key}">{$availtbl}</option>
					{/foreach}
					</select> 
					<div class="error" id="order_takeout_time_err"></div>
					<div class="biz_center"> 
						<input data-inline="true" data-icon="check" type="button" onclick="convertTakeOutOrderToDine({$tbl_ordersinfo.order_id},'{$tbl_ordersinfo.order_customer_name}');" value="Confirm"/>
						<input type="button" data-inline="true" data-icon="delete" value="{$_lang.close_lbl}" onclick="$('#popupConvertTakeOut').popup('close');"/>
					</div>
			</div> 
</div>


<div data-role="popup" id="popupAskToConvertTakeOut" data-dismissible="false" style="width: 270px;" data-overlay-theme="f">
			<div data-role="header">
				<h1>Ask For Dine-In Order</h1>
			</div>
			<div data-role="content" style="padding: 5px;">
					<label>{$_lang.tbl_orders.label.order_table_id}</label>
					<select id="ord_table">
					{foreach $availtables as $availtbl}
						<option value="{$availtbl@key}">{$availtbl}</option>
					{/foreach}
					</select> 
					<div class="error" id="order_takeout_time_err"></div>
					<div class="biz_center"> 
						<input data-inline="true" data-icon="check" type="button" onclick="convertTakeOutOrderToDine({$tbl_ordersinfo.order_id},'{$tbl_ordersinfo.order_customer_name}');" value="Confirm"/>
						<input type="button" data-inline="true" data-icon="delete" value="{$_lang.close_lbl}" onclick="$('#popupConvertTakeOut').popup('close');"/>
					</div>
			</div> 
</div>
 
