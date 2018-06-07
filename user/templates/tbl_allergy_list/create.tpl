{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_allergy_list.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_allergy_list" id="frmcreatetbl_allergy_list" onsubmit="return validatetbl_allergy_list();" method="POST" action="{$page_url}">
	<input type="hidden" name="alergy_id" id="alergy_id" value="0"/>
	<div style="display:none;" class="error" id="alergy_id_err"></div>

	<div class="field-row">
		<label for="alergy_name">{$_lang.tbl_allergy_list.label.alergy_name}</label>
		<input maxlength="150" id="alergy_name" type="text" value="{$smarty.post.alergy_name}" name="alergy_name"/> 
		<div class="error" id="alergy_name_err"></div>
	</div>

	<div class="field-row">
		<label for="alergy_desc">{$_lang.tbl_allergy_list.label.alergy_desc}</label>
		<textarea name="alergy_desc"  id="alergy_desc">{$smarty.post.alergy_desc}</textarea>

		<div class="error" id="alergy_desc_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="alergy_start_date">{$_lang.tbl_allergy_list.label.alergy_start_date}</label>
		<input  id="alergy_start_date" type="text" value="{$smarty.post.alergy_start_date}" name="alergy_start_date"/> 
		<div class="error" id="alergy_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="alergy_end_date">{$_lang.tbl_allergy_list.label.alergy_end_date}</label>
		<input  id="alergy_end_date" type="text" value="{$smarty.post.alergy_end_date}" name="alergy_end_date"/> 
		<div class="error" id="alergy_end_date_err"></div>
	</div>
	-->

	<div class="biz_center">
    <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/>
    <input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/>
    <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/>
    </div>
</form>
{include file="tbl_allergy_list/js.tpl"}

</div>

{include file="footer.tpl"}


