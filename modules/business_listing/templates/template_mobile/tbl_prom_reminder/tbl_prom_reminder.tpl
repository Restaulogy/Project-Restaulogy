{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_prom_reminder.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_prom_reminderlist}	<table class="listTable">		<tr><th class="bigListItem">{$_lang.tbl_prom_reminder.title}</th>		<th class="actionListItem"></th></tr>		{foreach from=$tbl_prom_reminderlist item=tbl_prom_reminderitem}			<tr>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&prem_id={$tbl_prom_reminderitem.prem_id}">{$tbl_prom_reminderitem.prem_promotion}</a></td>				<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&prem_id={$tbl_prom_reminderitem.prem_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_prom_reminder({$tbl_prom_reminderitem.prem_id});"></a>{if $tbl_prom_reminderitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&prem_id={$tbl_prom_reminderitem.prem_id}" class="deactiveIcon" title="{$_lang.tbl_prom_reminder.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&prem_id={$tbl_prom_reminderitem.prem_id}" class="activeIcon" title="{$_lang.tbl_prom_reminder.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_prom_reminder.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<center><input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_prom_reminder.CREATE.BTN_LBL}"/></center></div>{include file="tbl_prom_reminder/js.tpl"}{include file="footer.tpl"}