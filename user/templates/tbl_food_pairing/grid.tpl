{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_food_pairing.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_food_pairinglist}	<table class="biz_data_grid">		<tr>			<th class="{if $smarty.get.sort_on eq 'food_pair_main_dish'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=food_pair_main_dish&sort_by={$new_sort}">{$_lang.tbl_food_pairing.label.food_pair_main_dish}</a></th>			<th class="{if $smarty.get.sort_on eq 'food_pair_paired_dish'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=food_pair_paired_dish&sort_by={$new_sort}">{$_lang.tbl_food_pairing.label.food_pair_paired_dish}</a></th>			<th class="action_header">Action</th>		</tr>		{foreach from=$tbl_food_pairinglist item=tbl_food_pairingitem}		<tr class="{cycle values="odd,even"}">			<td><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&food_pair_id={$tbl_food_pairingitem.food_pair_id}">{$tbl_food_pairingitem.food_pair_main_dish}</a></td>			<td>{$tbl_food_pairingitem.food_pair_paired_dish}</td>			<td><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&food_pair_id={$tbl_food_pairingitem.food_pair_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_food_pairing({$tbl_food_pairingitem.food_pair_id});"></a>{if $tbl_food_pairingitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&food_pair_id={$tbl_food_pairingitem.food_pair_id}" class="deactiveIcon" title="{$_lang.tbl_food_pairing.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&food_pair_id={$tbl_food_pairingitem.food_pair_id}" class="activeIcon" title="{$_lang.tbl_food_pairing.ACTIVATE.BTN_LBL}"></a>{/if}</td>		</tr>	{/foreach}		<tfoot>			<tr>				<td colspan="5">					# {$result_found}&nbsp;&nbsp;&nbsp;{if $pagination neq ""}{$pagination}{/if}					<select onchange="changePage('{$navigationURL}',this.value,{$smarty.request.limit});">					{if $allPageCount gt 1}						{for $foo=1 to $allPageCount}							<option value="{$foo}" {if $foo eq $currentPage}selected="selected"{/if}>{$foo}</option>						{/for}					{else}						<option value="1" disabled="disabled">1</option>					{/if}					</select>				</td>			</tr>		</tfoot>	</table>{else}	<div class="error">{$_lang.tbl_food_pairing.no_record_found}</div>{/if}<center><input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_food_pairing.CREATE.BTN_LBL}"/></center></div>{include file="tbl_food_pairing/js.tpl"}{include file="footer.tpl"}