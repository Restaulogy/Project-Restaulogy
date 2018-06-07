{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_slack_users.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_slack_userslist}	<table class="biz_data_grid">		<tr>			<th class="{if $smarty.get.sort_on eq 'slkusr_phone'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=slkusr_phone&sort_by={$new_sort}">{$_lang.tbl_slack_users.label.slkusr_phone}</a></th>			<th class="{if $smarty.get.sort_on eq 'slkusr_webhook'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=slkusr_webhook&sort_by={$new_sort}">{$_lang.tbl_slack_users.label.slkusr_webhook}</a></th>			<th class="action_header">Action</th>		</tr>		{foreach from=$tbl_slack_userslist item=tbl_slack_usersitem}		<tr class="{cycle values="odd,even"}">			<td><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&slkusr_id={$tbl_slack_usersitem.slkusr_id}">{$tbl_slack_usersitem.slkusr_phone}</a></td>			<td>{$tbl_slack_usersitem.slkusr_webhook}</td>			<td><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&slkusr_id={$tbl_slack_usersitem.slkusr_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_slack_users({$tbl_slack_usersitem.slkusr_id});"></a>{if $tbl_slack_usersitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&slkusr_id={$tbl_slack_usersitem.slkusr_id}" class="deactiveIcon" title="{$_lang.tbl_slack_users.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&slkusr_id={$tbl_slack_usersitem.slkusr_id}" class="activeIcon" title="{$_lang.tbl_slack_users.ACTIVATE.BTN_LBL}"></a>{/if}</td>		</tr>	{/foreach}		<tfoot>			<tr>				<td colspan="5">					# {$result_found}&nbsp;&nbsp;&nbsp;{if $pagination neq ""}{$pagination}{/if}					<select onchange="changePage('{$navigationURL}',this.value,{$smarty.request.limit});">					{if $allPageCount gt 1}						{for $foo=1 to $allPageCount}							<option value="{$foo}" {if $foo eq $currentPage}selected="selected"{/if}>{$foo}</option>						{/for}					{else}						<option value="1" disabled="disabled">1</option>					{/if}					</select>				</td>			</tr>		</tfoot>	</table>{else}	<div class="error">{$_lang.tbl_slack_users.no_record_found}</div>{/if}<center><input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_slack_users.CREATE.BTN_LBL}"/></center></div>{include file="tbl_slack_users/js.tpl"}{include file="footer.tpl"}