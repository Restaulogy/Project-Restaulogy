{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_list_promotions.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_list_promotionslist}	<table class="listTable">		<tr><th class="bigListItem">{$_lang.tbl_list_promotions.title}</th>		<th class="actionListItem"></th></tr>		{foreach from=$tbl_list_promotionslist item=tbl_list_promotionsitem}			<tr>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&id={$tbl_list_promotionsitem.id}">{$tbl_list_promotionsitem.list_id}</a></td>				<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&id={$tbl_list_promotionsitem.id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_list_promotions({$tbl_list_promotionsitem.id});"></a>{if $tbl_list_promotionsitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&id={$tbl_list_promotionsitem.id}" class="deactiveIcon" title="{$_lang.tbl_list_promotions.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&id={$tbl_list_promotionsitem.id}" class="activeIcon" title="{$_lang.tbl_list_promotions.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_list_promotions.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<input onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_list_promotions.CREATE.BTN_LBL}"/></div>{include file="footercontent.tpl"}{include file="tbl_list_promotions/js.tpl"}	</body></html>