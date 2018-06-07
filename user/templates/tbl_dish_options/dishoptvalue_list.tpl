<form name="frm_tbl_dish_options_values" id="frm_tbl_dish_options_values" method="POST" action="{$website}/user/tbl_dish_options_values.php?dish_opt_val_option_id={$tbl_dish_optionsinfo.dish_opt_id}" >

{if $result_found gt 0 && $tbl_dish_options_valueslist}
	<table class="listTable">
		<tr><th class="bigListItem" colspan="2">"{$tbl_dish_optionsinfo.dish_opt_name}" - {$_lang.tbl_dish_options_values.title}</th>
		
		<!--<th class="actionListItem"></th>-->
			
		</tr>
		{foreach from=$tbl_dish_options_valueslist item=tbl_dish_options_valuesitem}
			<tr>
				<td style="width:2%;">
					<label for="sel_dish_options_values[{$tbl_dish_options_valuesitem.dish_opt_val_id}]" data-mini="true" style="width:23px;"><input type="checkbox" data-inline='true' data-mini='true' id="sel_dish_options_values[{$tbl_dish_options_valuesitem.dish_opt_val_id}]" name="sel_dish_options_values[{$tbl_dish_options_valuesitem.dish_opt_val_id}]" />&nbsp;</label>
	     	</td>
				<td class="valueItem"><a href="#" onclick="editOptionBox({$tbl_dish_options_valuesitem.dish_opt_val_id},'{$tbl_dish_options_valuesitem.dish_opt_val_value}')">{$tbl_dish_options_valuesitem.dish_opt_val_value}</a></td>
			</tr> 
	{/foreach}
	</table>
{else}
	<div class="error">{$_lang.tbl_dish_options_values.no_record_found}</div>
{/if}
{if $pagination}
	<center>{$pagination}</center>
{/if}
 
{html_input type="hidden" id="set_action" name="action" value=""}
{html_input type="hidden" name="is_from_option" value="1"}
</form>
<div class="biz_center">
{if $result_found gt 0 && $tbl_dish_options_valueslist}
		<input data-inline="true" data-icon="briefcase" type="button" id="sel_all_dish_options_values" name="sel_all_dish_options_values" value="{$_lang.main.toggle}" onclick="javascript:$('input[type=checkbox]').click();" /> 

		<input data-inline="true" data-icon="recycle-full" type="button" id="del_sel_all_tbl_dish_options_values" name="del_sel_all_tbl_dish_options_values" value="{$_lang.tbl_dish_options_values.DELETE.BTN_LBL}" onclick="deletetbl_dish_options_values();" />	
{/if}
		<input data-inline="true" data-icon="add-item"  type="button" onclick="newOptionBox();" value="{$_lang.tbl_dish_options_values.CREATE.BTN_LBL}"/> 
		<!--
        <input data-inline="true" data-icon="search" type="button" value="{$_lang.preview_lbl}" class="fright"  onclick="window.open('{$website}/user/tbl_dishes.php?mode={$smarty.const.MODE_VIEW}&dish_id={$smarty.session[$smarty.const.SES_DISH]}')"/>
        -->
</div>
