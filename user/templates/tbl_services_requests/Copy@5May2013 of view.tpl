{include file="header.tpl"}



<div class="wrapper">
<h1>{$_lang.tbl_services_requests.title}</h1>
{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmupdatetbl_services_requests" id="frmupdatetbl_services_requests" onsubmit="return validatetbl_services_requests();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">
	<label for="srvc_reqst_id">{$_lang.tbl_services_requests.label.srvc_reqst_id}</label>
	<input type="text" name="srvc_reqst_id" id="srvc_reqst_id" value="{$tbl_services_requestsinfo.srvc_reqst_id}"/>
	<div class="error" id="srvc_reqst_id_err"></div>

	<label for="srvc_reqst_created_by">{$_lang.tbl_services_requests.label.srvc_reqst_created_by}</label>
	<input type="text" name="srvc_reqst_created_by" id="srvc_reqst_created_by" value="{$tbl_services_requestsinfo.srvc_reqst_created_by}"/>
	<div class="error" id="srvc_reqst_created_by_err"></div>

	<label for="srvc_reqst_srvc_id">{$_lang.tbl_services_requests.label.srvc_reqst_srvc_id}</label>
	<input type="text" name="srvc_reqst_srvc_id" id="srvc_reqst_srvc_id" value="{$tbl_services_requestsinfo.srvc_reqst_srvc_id}"/>
	<div class="error" id="srvc_reqst_srvc_id_err"></div>

	<label for="srvc_reqst_table_id">{$_lang.tbl_services_requests.label.srvc_reqst_table_id}</label>
	<input type="text" name="srvc_reqst_table_id" id="srvc_reqst_table_id" value="{$tbl_services_requestsinfo.srvc_reqst_table_id}"/>
	<div class="error" id="srvc_reqst_table_id_err"></div>

	<label for="srvc_reqst_emp_id">{$_lang.tbl_services_requests.label.srvc_reqst_emp_id}</label>
	<input type="text" name="srvc_reqst_emp_id" id="srvc_reqst_emp_id" value="{$tbl_services_requestsinfo.srvc_reqst_emp_id}"/>
	<div class="error" id="srvc_reqst_emp_id_err"></div>

	<label for="srvc_reqst_tbl_sft_assoc_id">{$_lang.tbl_services_requests.label.srvc_reqst_tbl_sft_assoc_id}</label>
	<input type="text" name="srvc_reqst_tbl_sft_assoc_id" id="srvc_reqst_tbl_sft_assoc_id" value="{$tbl_services_requestsinfo.srvc_reqst_tbl_sft_assoc_id}"/>
	<div class="error" id="srvc_reqst_tbl_sft_assoc_id_err"></div>

	<label for="srvc_reqst_cat_id">{$_lang.tbl_services_requests.label.srvc_reqst_cat_id}</label>
	<input type="text" name="srvc_reqst_cat_id" id="srvc_reqst_cat_id" value="{$tbl_services_requestsinfo.srvc_reqst_cat_id}"/>
	<div class="error" id="srvc_reqst_cat_id_err"></div>

	<label for="srvc_reqst_status">{$_lang.tbl_services_requests.label.srvc_reqst_status}</label>
	<input type="text" name="srvc_reqst_status" id="srvc_reqst_status" value="{$tbl_services_requestsinfo.srvc_reqst_status}"/>
	<div class="error" id="srvc_reqst_status_err"></div>

	<label for="srvc_reqst_created_on">{$_lang.tbl_services_requests.label.srvc_reqst_created_on}</label>
	<input type="text" name="srvc_reqst_created_on" id="srvc_reqst_created_on" value="{$tbl_services_requestsinfo.srvc_reqst_created_on}"/>
	<div class="error" id="srvc_reqst_created_on_err"></div>

	<label for="srvc_reqst_attended_on">{$_lang.tbl_services_requests.label.srvc_reqst_attended_on}</label>
	<input type="text" name="srvc_reqst_attended_on" id="srvc_reqst_attended_on" value="{$tbl_services_requestsinfo.srvc_reqst_attended_on}"/>
	<div class="error" id="srvc_reqst_attended_on_err"></div>

	<label for="srvc_reqst_completed_at">{$_lang.tbl_services_requests.label.srvc_reqst_completed_at}</label>
	<input type="text" name="srvc_reqst_completed_at" id="srvc_reqst_completed_at" value="{$tbl_services_requestsinfo.srvc_reqst_completed_at}"/>
	<div class="error" id="srvc_reqst_completed_at_err"></div>

	<input type="hidden" name="action" value="update"/> <input class="fleft" type="submit" value="{$_lang.save_lbl}"/> <input class="fright" type="reset" onclick="$('#tbl_services_requests_view').show();$('#frmupdatetbl_services_requests').hide();" value="{$_lang.cancel_lbl}"/>
</form>

<div id="tbl_services_requests_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">

	<table class="listTable">
		<tr><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>
		<!--<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_id}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_id}</td></tr>-->
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_created_by}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_created_by}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_srvc_id}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.service.name}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_table_id}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.table.table_number}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_emp_id}<i>:</i></td><td class="valueItem">{if $tbl_services_requestsinfo.employee.full_name}{$tbl_services_requestsinfo.employee.full_name}{else}--{/if}</td></tr>
		<!--<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_tbl_sft_assoc_id}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_tbl_sft_assoc_id}</td></tr>-->
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_special_note}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_special_note}</td></tr>
		<!--<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_add_quests}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_add_quests}</td></tr>-->
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_status}<i>:</i></td><td class="valueItem" style="background:{$tbl_services_requestsinfo.current_status_color}">{if $tbl_services_requestsinfo.current_status eq $smarty.const.SERVICE_STATUS_COMPLETD}{$_lang.services_requests.service_complete_msg}{else}{$tbl_services_requestsinfo.remain_stages[0].srvc_stg_name}{/if} </td></tr>
		
		<!--
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_status}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_status}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_created_on}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_created_on}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_attended_on}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_attended_on}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_completed_at}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_completed_at}</td></tr> -->
	</table>
 	 <!--
	<input class="fleft" type="button" value="{$_lang.tbl_services_requests.UPDATE.BTN_LBL}" onclick="$('#tbl_services_requests_view').hide();$('#frmupdatetbl_services_requests').show();"/>
	-->
	<input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="cancel" onclick="window.location.href='{$back_url}'"/>
</div>

{include file="tbl_services_requests/js.tpl"}

</div>

{include file="footer.tpl"}

