{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_customers.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_customerslist}	<table class="listTable">		<tr><th class="bigListItem">{$_lang.tbl_customers.title}</th>		<th class="actionListItem"></th></tr>		{foreach from=$tbl_customerslist item=tbl_customersitem}			<tr>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&customer_id={$tbl_customersitem.customer_id}">{$tbl_customersitem.cutomer_name}</a></td>				<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&customer_id={$tbl_customersitem.customer_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_customers({$tbl_customersitem.customer_id});"></a>{if $tbl_customersitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&customer_id={$tbl_customersitem.customer_id}" class="deactiveIcon" title="{$_lang.tbl_customers.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&customer_id={$tbl_customersitem.customer_id}" class="activeIcon" title="{$_lang.tbl_customers.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_customers.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<input onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_customers.CREATE.BTN_LBL}"/></div>{include file="tbl_customers/js.tpl"}{include file="footer.tpl"}