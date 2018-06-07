{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_loyalty_level.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_loyalty_level" id="frmcreatetbl_loyalty_level" onsubmit="return validatetbl_loyalty_level();" method="POST" action="{$page_url}">
	<input type="hidden" name="loylev_id" id="loylev_id" value="0"/>
	<div style="display:none;" class="error" id="loylev_id_err"></div>

	<div class="field-row">
		<label for="loylev_level">{$_lang.tbl_loyalty_level.label.loylev_level}</label>
		<input maxlength="155" id="loylev_level" type="text" value="{$smarty.post.loylev_level}" name="loylev_level"/> 
		<div class="error" id="loylev_level_err"></div>
	</div>

	<div class="field-row">
		<label for="loylev_desc">{$_lang.tbl_loyalty_level.label.loylev_desc}</label>
		<textarea name="loylev_desc" id="loylev_desc">{$smarty.post.loylev_desc}</textarea> 

		<div class="error" id="loylev_desc_err"></div>
	</div>

	<div class="biz_hidden">
		<label for="loylev_restaurant">{$_lang.tbl_loyalty_level.label.loylev_restaurant}</label>
		<input maxlength="11" id="loylev_restaurant" type="text" value="{$smarty.session[$smarty.const.SES_RESTAURANT]}" name="loylev_restaurant"/> 
		<div class="error" id="loylev_restaurant_err"></div>
	</div>

	<div class="field-row">
		<label for="loylev_min_pt">{$_lang.tbl_loyalty_level.label.loylev_min_pt}</label>
		<input maxlength="11" id="loylev_min_pt" type="text" value="{$smarty.post.loylev_min_pt}" name="loylev_min_pt"/> 
		<div class="error" id="loylev_min_pt_err"></div>
	</div>

	<div class="field-row">
		<label for="loylev_max_pt">{$_lang.tbl_loyalty_level.label.loylev_max_pt}</label>
		<input maxlength="11" id="loylev_max_pt" type="text" value="{$smarty.post.loylev_max_pt}" name="loylev_max_pt"/> 
		<div class="error" id="loylev_max_pt_err"></div>
	</div>

	<div class="field-row">
		<label for="loylev_seq">{$_lang.tbl_loyalty_level.label.loylev_seq}</label>
		<input maxlength="4" id="loylev_seq" type="text" value="{$smarty.post.loylev_seq}" name="loylev_seq"/> 
		<div class="error" id="loylev_seq_err"></div>
	</div>

	<div class="field-row">
		<label for="loylev_multiply_factor">{$_lang.tbl_loyalty_level.label.loylev_multiply_factor}</label>
		<input maxlength="10,2" id="loylev_multiply_factor" type="text" value="{$smarty.post.loylev_multiply_factor}" name="loylev_multiply_factor"/> 
		<div class="error" id="loylev_multiply_factor_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="loylev_start_date">{$_lang.tbl_loyalty_level.label.loylev_start_date}</label>
		<input  id="loylev_start_date" type="text" value="{$smarty.post.loylev_start_date}" name="loylev_start_date"/> 
		<div class="error" id="loylev_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="loylev_end_date">{$_lang.tbl_loyalty_level.label.loylev_end_date}</label>
		<input  id="loylev_end_date" type="text" value="{$smarty.post.loylev_end_date}" name="loylev_end_date"/> 
		<div class="error" id="loylev_end_date_err"></div>
	</div>
	-->

	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="button" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></center>
</form>
{include file="tbl_loyalty_level/js.tpl"}

</div>

{include file="footer.tpl"}

