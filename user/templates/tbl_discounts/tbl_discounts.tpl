{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_discounts.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frm_tbl_discounts" id="frm_tbl_discounts"  method="POST" action="{$page_url}" >{if $result_found gt 0 && $tbl_discountslist}	<table class="listTable">		<tr><th class="bigListItem" colspan="2">{$_lang.tbl_discounts.title}</th>		</tr>		{foreach from=$tbl_discountslist item=tbl_discountsitem}			<tr>			<td style="width:2%;">				<label for="sel_discounts[{$tbl_discountsitem.discount_id}]" data-mini="true" style="width:23px;"><input type="checkbox" data-inline='true' data-mini='true' id="sel_discounts[{$tbl_discountsitem.discount_id}]" name="sel_discounts[{$tbl_discountsitem.discount_id}]" />&nbsp;</label>     		</td>						<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&discount_id={$tbl_discountsitem.discount_id}">{$tbl_discountsitem.discount_name} ({$tbl_discountsitem.discount_percent}{if $tbl_discountsitem.discount_type eq 'PERCENT'}%{else}${/if})</a></td>				<!--<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&discount_id={$tbl_discountsitem.discount_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_discounts({$tbl_discountsitem.discount_id});"></a>{if $tbl_discountsitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&discount_id={$tbl_discountsitem.discount_id}" class="deactiveIcon" title="{$_lang.tbl_discounts.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&discount_id={$tbl_discountsitem.discount_id}" class="activeIcon" title="{$_lang.tbl_discounts.ACTIVATE.BTN_LBL}"></a>{/if}</td>-->			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_discounts.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<input type="hidden" id="action" name="action" value=""/></form><center><input data-inline="true" data-icon="briefcase" type="button" id="sel_all_discounts" name="sel_all_discounts" value="{$_lang.main.toggle}" onclick="javascript:$('input[type=checkbox]').click();" /><input data-inline="true" data-icon="delete" type="button" id="del_sel_all_tbl_discounts" name="del_sel_all_tbl_discounts" value="{$_lang.tbl_discounts.DELETE.BTN_LBL}" onclick="deletetbl_discounts();" />	<input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_discounts.CREATE.BTN_LBL}"/></center></div>{include file="tbl_discounts/js.tpl"}{include file="footer.tpl"}