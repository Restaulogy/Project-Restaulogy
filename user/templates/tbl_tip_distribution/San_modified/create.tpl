{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_tip_distribution.create_title}</h1>

{if $error_msg}
	<div class="biz_center">{$error_msg}</div>
{/if}

{include file="tbl_tip/tabs.tpl"}

<form name="frmcreatetbl_tip_distribution" id="frmcreatetbl_tip_distribution" onsubmit="return validatetbl_tip_distribution();" method="POST" action="{$page_url}">
	<input type="hidden" name="tip_dis_id" id="tip_dis_id" value="0"/>
	<div style="display:none;" class="error" id="tip_dis_id_err"></div>
<fieldset style="border: 1px solid #ccc;margin:5px;padding:5px;">
  <legend style='font-weight:bold;'>{$_lang.tbl_tip_distribution.step_1}</legend>
  
    <table style="width: 100%;">
		<tr>
			<td style="width:48%;"><label for="tip_dis_period_from">{$_lang.tbl_tip_distribution.label.tip_dis_period_from}</label></td>
			<td style="width:4%;">&nbsp;</td>
			<td style="width:48%;"><label for="tip_dis_period_to">{$_lang.tbl_tip_distribution.label.tip_dis_period_to}</label></td>
		</tr>
		<tr>
			<td style="width:48%;"><input  id="tip_dis_period_from" type="text" value="{$smarty.post.tip_dis_period_from}" name="tip_dis_period_from" readonly="readonly"/> </td>
			<td style="width:4%;">&nbsp;</td>
			<td style="width:48%;"><input  id="tip_dis_period_to" type="text" value="{$smarty.post.tip_dis_period_to}" name="tip_dis_period_to" readonly="readonly"/></td>
		</tr>
		<tr>
			<td style="width:48%;"><div class="error" id="tip_dis_period_from_err"></div></td>
			<td style="width:4%;">&nbsp;</td>
			<td style="width:48%;"><div class="error" id="tip_dis_period_to_err"></div></td>
		</tr>
	</table>
	
	<div class="field-row">
		<label for="tip_dis_total_amnt">{$_lang.tbl_tip_distribution.label.tip_dis_total_amnt}</label>
		<input maxlength="7" id="tip_dis_total_amnt" type="text" value="{$smarty.post.tip_dis_total_amnt}" name="tip_dis_total_amnt" readonly="readonly"/>
		<div class="error" id="tip_dis_total_amnt_err"></div>
	</div>
	
	<div class="biz_center">
		{jqmbutton value="Calculate" icon="calculator" onclick="cal_tip_amt();"}
		{jqmbutton value="Detail" icon="bar-chart" onclick="show_distrution();"}
	</div>


</fieldset>
  <br>

  <fieldset style="border: 1px solid #ccc;margin:5px;padding:5px;">
  <legend style='font-weight:bold;'>{$_lang.tbl_tip_distribution.step_2}</legend>
	<div class="field-row">
		<label for="tip_dis_name">{$_lang.tbl_tip_distribution.label.tip_dis_name}</label>
		<input maxlength="250" id="tip_dis_name" type="text" value="{$smarty.post.tip_dis_name}" name="tip_dis_name"/> 
		<div class="error" id="tip_dis_name_err"></div>
	</div>

	<div class="field-row">
		<label for="tip_dis_type">{$_lang.tbl_tip_distribution.label.tip_dis_type}</label>
		 
<select name="tip_dis_type" id="tip_dis_type" onclick="change_distrution(this.value);"> 
	{foreach $disttypelist as $disttype}
		<option value="{$disttype@key}" {if $smarty.request.tip_dis_type eq $disttype@key}selected="selected"{/if}>{$disttype}</option>
	{/foreach}
</select> 
		<div class="error" id="tip_dis_type_err"></div>
	</div>

	<div class="field-row" id="shared_among_id" style="display: none;">
		<label for="tip_dis_shared_among">{$_lang.tbl_tip_distribution.label.tip_dis_shared_among}</label>
		<select name="tip_dis_shared_among[]" id="tip_dis_shared_among" multiple="multiple" data-native-menu="false"> 
				<option value="">Select Employee</option>
			{foreach $employeelist as $employee}
				<option value="{$employee@key}">{$employee}</option>
			{/foreach}
		</select>
		<!--<textarea name="tip_dis_shared_among"  id="tip_dis_shared_among">{$smarty.post.tip_dis_shared_among}</textarea>--> 

		<div class="error" id="tip_dis_shared_among_err"></div>
	</div>

	

	<!--
	<div class="field-row">
		<label for="tip_dis_start_date">{$_lang.tbl_tip_distribution.label.tip_dis_start_date}</label>
		<input  id="tip_dis_start_date" type="text" value="{$smarty.post.tip_dis_start_date}" name="tip_dis_start_date"/> 
		<div class="error" id="tip_dis_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="tip_dis_end_date">{$_lang.tbl_tip_distribution.label.tip_dis_end_date}</label>
		<input  id="tip_dis_end_date" type="text" value="{$smarty.post.tip_dis_end_date}" name="tip_dis_end_date"/> 
		<div class="error" id="tip_dis_end_date_err"></div>
	</div>
	-->
</fieldset>
	<div class="biz_center"><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/>
		 
		{jqmbutton type="form_save"} 
		<input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/>
	</div>
</form>


</div>

{include file="footercontent.tpl"}
{include file="tbl_tip_distribution/js.tpl"}
</body></html>
