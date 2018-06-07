{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_landing_page.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_landing_pagelist}	<table class="biz_data_grid">		<tr>			<th class="{if $smarty.get.sort_on eq 'lnd_pg_restaurant'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=lnd_pg_restaurant&sort_by={$new_sort}">{$_lang.tbl_landing_page.label.lnd_pg_restaurant}</a></th>			<th class="{if $smarty.get.sort_on eq 'lnd_pg_background'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=lnd_pg_background&sort_by={$new_sort}">{$_lang.tbl_landing_page.label.lnd_pg_background}</a></th>			<th class="{if $smarty.get.sort_on eq 'lnd_pg_menu'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=lnd_pg_menu&sort_by={$new_sort}">{$_lang.tbl_landing_page.label.lnd_pg_menu}</a></th>			<th class="{if $smarty.get.sort_on eq 'lnd_pg_promotion'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=lnd_pg_promotion&sort_by={$new_sort}">{$_lang.tbl_landing_page.label.lnd_pg_promotion}</a></th>			<th class="{if $smarty.get.sort_on eq 'lnd_pg_loyalty'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=lnd_pg_loyalty&sort_by={$new_sort}">{$_lang.tbl_landing_page.label.lnd_pg_loyalty}</a></th>			<th class="{if $smarty.get.sort_on eq 'lnd_pg_connect'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=lnd_pg_connect&sort_by={$new_sort}">{$_lang.tbl_landing_page.label.lnd_pg_connect}</a></th>			<th class="{if $smarty.get.sort_on eq 'lnd_pg_reviews'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=lnd_pg_reviews&sort_by={$new_sort}">{$_lang.tbl_landing_page.label.lnd_pg_reviews}</a></th>			<th class="{if $smarty.get.sort_on eq 'lnd_pg_service_req'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=lnd_pg_service_req&sort_by={$new_sort}">{$_lang.tbl_landing_page.label.lnd_pg_service_req}</a></th>			<th class="action_header">Action</th>		</tr>		{foreach from=$tbl_landing_pagelist item=tbl_landing_pageitem}		<tr class="{cycle values="odd,even"}">			<td><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&lnd_pg_id={$tbl_landing_pageitem.lnd_pg_id}">{$tbl_landing_pageitem.lnd_pg_restaurant}</a></td>			<td>{$tbl_landing_pageitem.lnd_pg_background}</td>			<td>{$tbl_landing_pageitem.lnd_pg_menu}</td>			<td>{$tbl_landing_pageitem.lnd_pg_promotion}</td>			<td>{$tbl_landing_pageitem.lnd_pg_loyalty}</td>			<td>{$tbl_landing_pageitem.lnd_pg_connect}</td>			<td>{$tbl_landing_pageitem.lnd_pg_reviews}</td>			<td>{$tbl_landing_pageitem.lnd_pg_service_req}</td>			<td><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&lnd_pg_id={$tbl_landing_pageitem.lnd_pg_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_landing_page({$tbl_landing_pageitem.lnd_pg_id});"></a>{if $tbl_landing_pageitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&lnd_pg_id={$tbl_landing_pageitem.lnd_pg_id}" class="deactiveIcon" title="{$_lang.tbl_landing_page.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&lnd_pg_id={$tbl_landing_pageitem.lnd_pg_id}" class="activeIcon" title="{$_lang.tbl_landing_page.ACTIVATE.BTN_LBL}"></a>{/if}</td>		</tr>	{/foreach}		<tfoot>			<tr>				<td colspan="11">					# {$result_found}&nbsp;&nbsp;&nbsp;{if $pagination neq ""}{$pagination}{/if}					<select onchange="changePage('{$navigationURL}',this.value,{$smarty.request.limit});">					{if $allPageCount gt 1}						{for $foo=1 to $allPageCount}							<option value="{$foo}" {if $foo eq $currentPage}selected="selected"{/if}>{$foo}</option>						{/for}					{else}						<option value="1" disabled="disabled">1</option>					{/if}					</select>				</td>			</tr>		</tfoot>	</table>{else}	<div class="error">{$_lang.tbl_landing_page.no_record_found}</div>{/if}<center><input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_landing_page.CREATE.BTN_LBL}"/></center></div>{include file="tbl_landing_page/js.tpl"}{include file="footer.tpl"}