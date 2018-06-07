{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_discounts.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_discounts" id="frmcreatetbl_discounts" onsubmit="return validatetbl_discounts();" method="POST" action="{$page_url}">
	<input type="hidden" name="Array" id="Array" value="0"/>
	<div style="display:none;" class="error" id="Array_err"></div>

	<div class="field-row">
		<label for="discount_name">{$_lang.tbl_discounts.label.discount_name}</label>
		<input maxlength="255" id="discount_name" type="text" value="{$smarty.post.discount_name}" name="discount_name"/> 
		<div class="error" id="discount_name_err"></div>
	</div>

	<div class="field-row">
		<label for="discount_desc">{$_lang.tbl_discounts.label.discount_desc}</label>
		<textarea name="discount_desc"  id="discount_desc">{$smarty.post.discount_desc}</textarea> 

		<div class="error" id="discount_desc_err"></div>
	</div>

	<div class="field-row">
		<label for="discount_percent">{$_lang.tbl_discounts.label.discount_percent}</label>		
		<table>
			<tr>
					<td class="biz_top_align bigListItem">
						<input maxlength="6" id="discount_percent" type="text" value="{$smarty.post.discount_percent}" name="discount_percent"/>
					</td>
					<td class="biz_top_align">&nbsp;&nbsp;in&nbsp;&nbsp;</td>
					<td class="biz_top_align">
						<select name="discount_type" id="discount_type"> 
					  {foreach $amount_types as $amount_type}
							<option value="{$amount_type@key}">{$amount_type}</option>
						{/foreach}
						</select> 
					</td>
			</tr>
		</table>		 
		<div class="error" id="discount_percent_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="discount_start_date">{$_lang.tbl_discounts.label.discount_start_date}</label>
		<input  id="discount_start_date" type="text" value="{$smarty.post.discount_start_date}" name="discount_start_date"/> 
		<div class="error" id="discount_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="discount_end_date">{$_lang.tbl_discounts.label.discount_end_date}</label>
		<input  id="discount_end_date" type="text" value="{$smarty.post.discount_end_date}" name="discount_end_date"/> 
		<div class="error" id="discount_end_date_err"></div>
	</div>
	-->

	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></center>
</form>
{include file="tbl_discounts/js.tpl"}

</div>

{include file="footer.tpl"}

