{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_emp_shift_assignment.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}
{include file="tbl_emp_shift_assignment/tabs.tpl"}

<form name="frmcreatetbl_emp_shift_assignment" id="frmcreatetbl_emp_shift_assignment" onsubmit="return validatetbl_emp_shift_assignment();" method="POST" action="{$page_url}">
	<input type="hidden" name="Array" id="Array" value="0"/>
	<div style="display:none;" class="error" id="Array_err"></div>

	<div class="field-row">
		<label for="emp_sft_employee">{$_lang.tbl_emp_shift_assignment.label.emp_sft_employee}</label>
		<input maxlength="11" id="emp_sft_employee" type="text" value="{$smarty.post.emp_sft_employee}" name="emp_sft_employee"/> 
		<div class="error" id="emp_sft_employee_err"></div>
	</div>

	<div class="field-row">
		<label for="emp_sft_shift">{$_lang.tbl_emp_shift_assignment.label.emp_sft_shift}</label>
		<input maxlength="11" id="emp_sft_shift" type="text" value="{$smarty.post.emp_sft_shift}" name="emp_sft_shift"/> 
		<div class="error" id="emp_sft_shift_err"></div>
	</div>

	<div class="field-row">
		<label for="emp_sft_date">{$_lang.tbl_emp_shift_assignment.label.emp_sft_date}</label>
		<input  id="emp_sft_date" type="text" value="{$smarty.post.emp_sft_date}" name="emp_sft_date"/> 
		<div class="error" id="emp_sft_date_err"></div>
	</div>

	<div class="field-row">
		<label for="emp_sft_tables">{$_lang.tbl_emp_shift_assignment.label.emp_sft_tables}</label>
		<textarea name="emp_sft_tables  id="emp_sft_tables">{$smarty.post.emp_sft_tables}</textarea> 

		<div class="error" id="emp_sft_tables_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="emp_sft_start_date">{$_lang.tbl_emp_shift_assignment.label.emp_sft_start_date}</label>
		<input  id="emp_sft_start_date" type="text" value="{$smarty.post.emp_sft_start_date}" name="emp_sft_start_date"/> 
		<div class="error" id="emp_sft_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="emp_sft_end_date">{$_lang.tbl_emp_shift_assignment.label.emp_sft_end_date}</label>
		<input  id="emp_sft_end_date" type="text" value="{$smarty.post.emp_sft_end_date}" name="emp_sft_end_date"/> 
		<div class="error" id="emp_sft_end_date_err"></div>
	</div>
	-->

	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></center>
</form>
{include file="tbl_emp_shift_assignment/js.tpl"}

</div>

{include file="footer.tpl"}

