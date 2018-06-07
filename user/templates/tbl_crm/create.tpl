{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_crm.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_crm" id="frmcreatetbl_crm" onsubmit="return validatetbl_crm();" method="POST" action="{$website}/user/tbl_crm_list.php">
	<input type="hidden" name="crm_id" id="crm_id" value="0"/>
	<div style="display:none;" class="error" id="Array_err"></div>

	<div class="field-row">
		<label for="crm_cust_nm">{$_lang.tbl_crm.label.crm_cust_id}</label>
		<input maxlength="50" id="crm_cust_nm" type="text" value="{$smarty.post.crm_cust_nm}" name="crm_cust_nm" value="0" />
		<div class="error" id="crm_cust_nm_err"></div>
	</div>

	<div class="field-row">
		<label for="crm_cust_email">{$_lang.tbl_crm.label.crm_cust_email}</label>
		<input maxlength="250" id="crm_cust_email" type="text" value="{$smarty.post.crm_cust_email}" name="crm_cust_email"/> 
		<div class="error" id="crm_cust_email_err"></div>
	</div>
	
	<div class="field-row">
		<label for="crm_cust_phone">{$_lang.tbl_crm.label.crm_cust_phone}</label>
		<input maxlength="250" id="crm_cust_phone" type="text" value="{$smarty.post.crm_cust_email}" name="crm_cust_phone"/>
		<div class="error" id="crm_cust_phone_err"></div>
	</div>

	<div class="biz_hidden">
		<label for="crm_cust_type">{$_lang.tbl_crm.label.crm_cust_type}</label>
        <input name="crm_cust_type" id="crm_cust_type" value="SMS_REG" />
		<div class="error" id="crm_cust_type_err"></div>
	</div>

	<div class="biz_hidden">
		<label for="crm_is_subsribed">{$_lang.tbl_crm.label.crm_is_subsribed}</label>
		<input maxlength="1" id="crm_is_subsribed" type="text" value="1" name="crm_is_subsribed"/>
		<div class="error" id="crm_is_subsribed_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="crm_start_date">{$_lang.tbl_crm.label.crm_start_date}</label>
		<input  id="crm_start_date" type="text" value="{$smarty.post.crm_start_date}" name="crm_start_date"/> 
		<div class="error" id="crm_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="crm_end_date">{$_lang.tbl_crm.label.crm_end_date}</label>
		<input  id="crm_end_date" type="text" value="{$smarty.post.crm_end_date}" name="crm_end_date"/> 
		<div class="error" id="crm_end_date_err"></div>
	</div>
	-->

	<center>
    <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/>
    <input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/>
    <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/>
    </center>
</form>
{include file="tbl_crm/js.tpl"}

</div>

{include file="footer.tpl"}


