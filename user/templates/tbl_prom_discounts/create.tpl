{include file="header.tpl"}

<div class="wrapper">
<!--<h1>"{$prom_detail.title}"- {$_lang.tbl_prom_discounts.create_title}</h1>-->

{if $error_msg}
	<center>{$error_msg}</center>
{/if}
{include file="tbl_prom_discounts/main_promions_tab.tpl"}
{include file="tbl_prom_discounts/prom_cond_disc_tab.tpl"}

<fieldset style="border: 1px solid #ccc;margin:5px;padding:5px;">
<form name="frmcreatetbl_prom_discounts" id="frmcreatetbl_prom_discounts" onsubmit="return validatetbl_prom_discounts();" method="POST" action="{$page_url}">
	<input type="hidden" name="prmdisc_id" id="prmdisc_id" value="0"/>
	<div style="display:none;" class="error" id="Array_err"></div>

	<div class="biz_hidden">
		<label for="prmdisc_promotion">{$_lang.tbl_prom_discounts.label.prmdisc_promotion}</label>
		<input name="prmdisc_promotion" id="prmdisc_promotion" value="{$prom_detail.id}"></input>
		<!--<select name="prmdisc_promotion" id="prmdisc_promotion" onchange="getPromConditions(this.value,'prmdisc_condition');"> 
			{foreach $lst_promotion as $promotion}
				<option value="{$promotion@key}" {if $prom_detail.id eq $promotion@key} selected='selected'{/if}>{$promotion}</option>
			{/foreach}
		</select>-->
		<div class="error" id="prmdisc_promotion_err"></div>
	</div>

	<div class="field-row biz_hidden">
		<label for="prmdisc_condition">{$_lang.tbl_prom_discounts.label.prmdisc_condition} &nbsp;&nbsp;<a data-role="button" data-icon='star' data-inline="true" href="#" onclick="window.location.href='{$website}/user/tbl_prom_conditions.php?prmcon_promotion={$prom_detail.id}';" target="_blank">Conditions </a></label>
		<label for="prmdisc_condition">{$_lang.tbl_prom_discounts.label.prmdisc_condition}</label>
		<input type="text" name="prmdisc_condition" id="prmdisc_condition" value="{$particular_condition}"></input>
		<!--
		<select id="prmdisc_condition" name="prmdisc_condition">
			<option>Select Condition</option>		
			{foreach $lst_coditions as $condition}
				<option value="{$condition.prmcon_id}">{$condition.prmcon_title}</option>
			{/foreach}
		</select> 	
		-->
		<div class="error" id="prmdisc_condition_err"></div>
	</div>

	<div class="field-row">
		<label for="prmdisc_bogo_qty">{$_lang.tbl_prom_discounts.label.prmdisc_bogo_qty}</label> 
		<select name="prmdisc_bogo_qty" id="prmdisc_bogo_qty">
			{for $foo=1 to 10}
			    <option value="{$foo}" {if $smarty.post.prmdisc_bogo_qty eq $foo}selected='selected'{/if}>{$foo}</option>
			{/for}
		</select>  
		<div class="error" id="prmdisc_bogo_qty_err"></div>
	</div>

	<div class="field-row">
		<label for="prmdisc_bogo_sbmnu">{$_lang.tbl_prom_discounts.label.prmdisc_bogo_sbmnu}</label> 
		<select name="prmdisc_bogo_sbmnu" id="prmdisc_bogo_sbmnu" onchange="getSubMenudishes(this.value,'prmdisc_bogo_sbmnu_dish');">
			<option value="0">Select Menu</option>
			{foreach from=$lst_sub_mnu item=submnu}
				<option value="{$submnu.submnu_id}">{$submnu.menu_name}=>{$submnu.submnu_name}</option>
			{/foreach}
		</select>		
		<div class="error" id="prmdisc_bogo_sbmnu_err"></div>
	</div>

	<div class="field-row">
		<label for="prmdisc_bogo_sbmnu_dish">{$_lang.tbl_prom_discounts.label.prmdisc_bogo_sbmnu_dish}</label>
		<select  id="prmdisc_bogo_sbmnu_dish" name="prmdisc_bogo_sbmnu_dish">
		<option value="0">Select Dish</option>
		</select> 
		
		<div class="error" id="prmdisc_bogo_sbmnu_dish_err"></div>
	</div>

	<div class="field-row">
		<label for="prmdisc_disc_amt">{$_lang.tbl_prom_discounts.label.prmdisc_disc_amt}</label>
		<table>
			<tr>
					<td class="biz_top_align bigListItem"><input maxlength="5" id="prmdisc_disc_amt" type="text" value="{$smarty.post.prmdisc_disc_amt}" name="prmdisc_disc_amt"/>
					</td>
					<td class="biz_top_align">&nbsp;&nbsp;in&nbsp;&nbsp;</td>
					<td class="biz_top_align">
						<select name="prmdisc_disc_amt_type" id="prmdisc_disc_amt_type"> 
					  {foreach $amount_types as $amount_type}
							<option value="{$amount_type@key}">{$amount_type}</option>
						{/foreach}
						</select> 
					</td>
			</tr>
		</table>
	
		<div class="error" id="prmdisc_disc_amt_err"></div>
	</div>
 

	<!--
	<div class="field-row">
		<label for="prmdisc_start_date">{$_lang.tbl_prom_discounts.label.prmdisc_start_date}</label>
		<input  id="prmdisc_start_date" type="text" value="{$smarty.post.prmdisc_start_date}" name="prmdisc_start_date"/> 
		<div class="error" id="prmdisc_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="prmdisc_end_date">{$_lang.tbl_prom_discounts.label.prmdisc_end_date}</label>
		<input  id="prmdisc_end_date" type="text" value="{$smarty.post.prmdisc_end_date}" name="prmdisc_end_date"/> 
		<div class="error" id="prmdisc_end_date_err"></div>
	</div>
	-->
	<center>
		
	<input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/>
		
	<input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> 
	<input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></center>
</form>
</fieldset>
{include file="tbl_prom_discounts/js.tpl"}

</div>

{include file="footer.tpl"}

