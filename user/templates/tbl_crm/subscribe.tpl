<form method="POST" action="{$website}/user/tbl_crm.php" onsubmit="return validatetbl_crm();">  
			<label style="color:#555;">{$_lang.tbl_crm.label.crm_cust_email}</label>
			{if $sesslife}
				{html_input value="{$Global_member.email}" name="crm_cust_email" readonly="readonly"}
			{else}
				{html_input name="crm_cust_email"}
			{/if}
			<div id="crm_cust_email_err" class="error"></div>
		   
		 <label><input type="checkbox" id="crm_is_subsribed" name="crm_is_subsribed" value="1" data-inline="true"/>&nbsp;&nbsp;{$_lang.tbl_crm.info.crm_is_subsribed}</label> 
	 		<div class="biz_center">
				{html_input type="hidden" name="crm_id" value="0"}
				{html_input type="hidden" name="{$smarty.const.ACTION_TITLE}" value="{$smarty.const.ACTION_CREATE}"}
				{if $sesslife}
					{html_input type="hidden" name="crm_cust_id" value="{$Global_member.id}"}
					{html_input type="hidden" name="crm_cust_type" value="{$smarty.const.CUST_TYPE_LOGIN}"}
					{html_input type="hidden" name="crm_cust_phone" value="{$Global_member.staff_phone}"}
				{else}
					{html_input type="hidden" name="crm_cust_id" value="{$smarty.session[$smarty.const.SES_COOKIE_UID]}"}
					{html_input type="hidden" name="crm_cust_type" value="{$smarty.const.CUST_TYPE_COOKIE}"}
				{/if}
				{html_input type="hidden" name="order_id" value="{$tbl_ordersinfo.order_id}"} 
				{html_input type="hidden" name="payment_choice" value="{$payment_choice}"}
				{jqmbutton type="form_save"} 
			</div>
</form>

{include file="tbl_crm/js.tpl"}
