{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_alerts.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_alertslist}	<table class="listTable">		<tr><th class="bigListItem">{$_lang.tbl_alerts.title}</th>		<th class="actionListItem"></th></tr>		{foreach from=$tbl_alertslist item=tbl_alertsitem}			<tr>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&alert_id={$tbl_alertsitem.alert_id}">{$tbl_alertsitem.alert_table_id}</a></td>				<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&alert_id={$tbl_alertsitem.alert_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_alerts({$tbl_alertsitem.alert_id});"></a>{if $tbl_alertsitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&alert_id={$tbl_alertsitem.alert_id}" class="deactiveIcon" title="{$_lang.tbl_alerts.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&alert_id={$tbl_alertsitem.alert_id}" class="activeIcon" title="{$_lang.tbl_alerts.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_alerts.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<input onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_alerts.CREATE.BTN_LBL}"/></div>{include file="tbl_alerts/js.tpl"}{include file="footer.tpl"}