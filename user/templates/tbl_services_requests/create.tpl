{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_services_requests.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_services_requests" id="frmcreatetbl_services_requests" onsubmit="return validatetbl_services_requests();" method="POST" action="{$page_url}">
	<input type="hidden" name="srvc_reqst_id" id="srvc_reqst_id" value="0"/>
	<div style="display:none;" class="error" id="srvc_reqst_id_err"></div>

	<label for="srvc_reqst_created_by">{$_lang.tbl_services_requests.label.srvc_reqst_created_by}</label>
	<input type="text" name="srvc_reqst_created_by" id="srvc_reqst_created_by" value="{$smarty.post.srvc_reqst_created_by}"/>
	<div class="error" id="srvc_reqst_created_by_err"></div>

	<label for="srvc_reqst_srvc_id">{$_lang.tbl_services_requests.label.srvc_reqst_srvc_id}</label>
	<input type="text" name="srvc_reqst_srvc_id" id="srvc_reqst_srvc_id" value="{$smarty.post.srvc_reqst_srvc_id}"/>
	<div class="error" id="srvc_reqst_srvc_id_err"></div>

	<label for="srvc_reqst_table_id">{$_lang.tbl_services_requests.label.srvc_reqst_table_id}</label>
	<input type="text" name="srvc_reqst_table_id" id="srvc_reqst_table_id" value="{$smarty.post.srvc_reqst_table_id}"/>
	<div class="error" id="srvc_reqst_table_id_err"></div>

	<label for="srvc_reqst_emp_id">{$_lang.tbl_services_requests.label.srvc_reqst_emp_id}</label>
	<input type="text" name="srvc_reqst_emp_id" id="srvc_reqst_emp_id" value="{$smarty.post.srvc_reqst_emp_id}"/>
	<div class="error" id="srvc_reqst_emp_id_err"></div>

	<label for="srvc_reqst_tbl_sft_assoc_id">{$_lang.tbl_services_requests.label.srvc_reqst_tbl_sft_assoc_id}</label>
	<input type="text" name="srvc_reqst_tbl_sft_assoc_id" id="srvc_reqst_tbl_sft_assoc_id" value="{$smarty.post.srvc_reqst_tbl_sft_assoc_id}"/>
	<div class="error" id="srvc_reqst_tbl_sft_assoc_id_err"></div>

	<label for="srvc_reqst_cat_id">{$_lang.tbl_services_requests.label.srvc_reqst_cat_id}</label>
	<input type="text" name="srvc_reqst_cat_id" id="srvc_reqst_cat_id" value="{$smarty.post.srvc_reqst_cat_id}"/>
	<div class="error" id="srvc_reqst_cat_id_err"></div>

	<label for="srvc_reqst_status">{$_lang.tbl_services_requests.label.srvc_reqst_status}</label>
	<input type="text" name="srvc_reqst_status" id="srvc_reqst_status" value="{$smarty.post.srvc_reqst_status}"/>
	<div class="error" id="srvc_reqst_status_err"></div>

	<label for="srvc_reqst_created_on">{$_lang.tbl_services_requests.label.srvc_reqst_created_on}</label>
	<input type="text" name="srvc_reqst_created_on" id="srvc_reqst_created_on" value="{$smarty.post.srvc_reqst_created_on}"/>
	<div class="error" id="srvc_reqst_created_on_err"></div>

	<label for="srvc_reqst_attended_on">{$_lang.tbl_services_requests.label.srvc_reqst_attended_on}</label>
	<input type="text" name="srvc_reqst_attended_on" id="srvc_reqst_attended_on" value="{$smarty.post.srvc_reqst_attended_on}"/>
	<div class="error" id="srvc_reqst_attended_on_err"></div>

	<label for="srvc_reqst_completed_at">{$_lang.tbl_services_requests.label.srvc_reqst_completed_at}</label>
	<input type="text" name="srvc_reqst_completed_at" id="srvc_reqst_completed_at" value="{$smarty.post.srvc_reqst_completed_at}"/>
	<div class="error" id="srvc_reqst_completed_at_err"></div>

	<input type="hidden" name="action" value="create"/><input class="fleft" type="submit" value="{$_lang.save_lbl}"/> <input  class="fright" type="reset" value="{$_lang.cancel_lbl}"/>
</form>
 

{include file="tbl_services_requests/js.tpl"}

</div>

{include file="footer.tpl"}


