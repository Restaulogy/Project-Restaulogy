{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_prom_conditions.create_title}</h1>

{if $error_msg}
	<div class="biz_center">{$error_msg}</div><!--/center-->
{/if}

<form name="frmcreatetbl_prom_conditions" id="frmcreatetbl_prom_conditions" onsubmit="return validatetbl_prom_conditions();" method="POST" action="{$page_url}">
	<input type="hidden" name="Array" id="Array" value="0"/>
	<div style="display:none;" class="error" id="Array_err"></div>

	<div class="field-row">
		<label for="prmcon_promotion">{$_lang.tbl_prom_conditions.label.prmcon_promotion}</label>
        <select name="prmcon_promotion" id="prmcon_promotion">
            <option value="">Select Promotion</option>
            {foreach $lst_promotion as $promotion}
                <option value="{$promotion@key}" {if $smarty.request.prmcon_promotion eq $promotion@key}selected="selected"{/if}>{$promotion}</option>
            {/foreach}
        </select>
		<div class="error" id="prmcon_promotion_err"></div>
	</div>

	<div class="field-row">
		<label for="prmcon_title">{$_lang.tbl_prom_conditions.label.prmcon_title}</label>
		<textarea name="prmcon_title"  id="prmcon_title">{$smarty.post.prmcon_title}</textarea>

		<div class="error" id="prmcon_title_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="prmcon_start_date">{$_lang.tbl_prom_conditions.label.prmcon_start_date}</label>
		<input  id="prmcon_start_date" type="text" value="{$smarty.post.prmcon_start_date}" name="prmcon_start_date"/> 
		<div class="error" id="prmcon_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="prmcon_end_date">{$_lang.tbl_prom_conditions.label.prmcon_end_date}</label>
		<input  id="prmcon_end_date" type="text" value="{$smarty.post.prmcon_end_date}" name="prmcon_end_date"/> 
		<div class="error" id="prmcon_end_date_err"></div>
	</div>
	-->

	<div class="biz_center"><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></div><!--/center-->
</form>
{include file="tbl_prom_conditions/js.tpl"}

</div>

{include file="footer.tpl"}


