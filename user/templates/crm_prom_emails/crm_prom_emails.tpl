{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.crm_prom_emails.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $crm_prom_emailslist}	<table class="listTable">		<tr><th class="bigListItem">{$_lang.crm_prom_emails.title}</th>		<th class="actionListItem"></th></tr>		{foreach from=$crm_prom_emailslist item=crm_prom_emailsitem}			<tr>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&crm_pr_ml_id={$crm_prom_emailsitem.crm_pr_ml_id}">{$crm_prom_emailsitem.crm_pr_ml_userid}</a></td>				<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&crm_pr_ml_id={$crm_prom_emailsitem.crm_pr_ml_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletecrm_prom_emails({$crm_prom_emailsitem.crm_pr_ml_id});"></a>{if $crm_prom_emailsitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&crm_pr_ml_id={$crm_prom_emailsitem.crm_pr_ml_id}" class="deactiveIcon" title="{$_lang.crm_prom_emails.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&crm_pr_ml_id={$crm_prom_emailsitem.crm_pr_ml_id}" class="activeIcon" title="{$_lang.crm_prom_emails.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.crm_prom_emails.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<center><input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.crm_prom_emails.CREATE.BTN_LBL}"/></center></div>{include file="crm_prom_emails/js.tpl"}{include file="footer.tpl"}