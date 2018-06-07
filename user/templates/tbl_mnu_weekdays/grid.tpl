{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_mnu_weekdays.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_mnu_weekdayslist}	<table class="biz_data_grid">		<tr>			<th class="{if $smarty.get.sort_on eq 'mnu_wkdy_menu_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=mnu_wkdy_menu_id&sort_by={$new_sort}">{$_lang.tbl_mnu_weekdays.label.mnu_wkdy_menu_id}</a></th>			<th class="{if $smarty.get.sort_on eq 'mnu_wkdy_sunday'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=mnu_wkdy_sunday&sort_by={$new_sort}">{$_lang.tbl_mnu_weekdays.label.mnu_wkdy_sunday}</a></th>			<th class="{if $smarty.get.sort_on eq 'mnu_wkdy_monday'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=mnu_wkdy_monday&sort_by={$new_sort}">{$_lang.tbl_mnu_weekdays.label.mnu_wkdy_monday}</a></th>			<th class="{if $smarty.get.sort_on eq 'mnu_wkdy_tuesday'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=mnu_wkdy_tuesday&sort_by={$new_sort}">{$_lang.tbl_mnu_weekdays.label.mnu_wkdy_tuesday}</a></th>			<th class="{if $smarty.get.sort_on eq 'mnu_wkdy_wednesday'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=mnu_wkdy_wednesday&sort_by={$new_sort}">{$_lang.tbl_mnu_weekdays.label.mnu_wkdy_wednesday}</a></th>			<th class="{if $smarty.get.sort_on eq 'mnu_wkdy_thursday'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=mnu_wkdy_thursday&sort_by={$new_sort}">{$_lang.tbl_mnu_weekdays.label.mnu_wkdy_thursday}</a></th>			<th class="{if $smarty.get.sort_on eq 'mnu_wkdy_friday'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=mnu_wkdy_friday&sort_by={$new_sort}">{$_lang.tbl_mnu_weekdays.label.mnu_wkdy_friday}</a></th>			<th class="{if $smarty.get.sort_on eq 'mnu_wkdy_saturday'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=mnu_wkdy_saturday&sort_by={$new_sort}">{$_lang.tbl_mnu_weekdays.label.mnu_wkdy_saturday}</a></th>			<th class="action_header">Action</th>		</tr>		{foreach from=$tbl_mnu_weekdayslist item=tbl_mnu_weekdaysitem}		<tr class="{cycle values="odd,even"}">			<td><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&mnu_wkdy_id={$tbl_mnu_weekdaysitem.mnu_wkdy_id}">{$tbl_mnu_weekdaysitem.mnu_wkdy_menu_id}</a></td>			<td>{$tbl_mnu_weekdaysitem.mnu_wkdy_sunday}</td>			<td>{$tbl_mnu_weekdaysitem.mnu_wkdy_monday}</td>			<td>{$tbl_mnu_weekdaysitem.mnu_wkdy_tuesday}</td>			<td>{$tbl_mnu_weekdaysitem.mnu_wkdy_wednesday}</td>			<td>{$tbl_mnu_weekdaysitem.mnu_wkdy_thursday}</td>			<td>{$tbl_mnu_weekdaysitem.mnu_wkdy_friday}</td>			<td>{$tbl_mnu_weekdaysitem.mnu_wkdy_saturday}</td>			<td><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&mnu_wkdy_id={$tbl_mnu_weekdaysitem.mnu_wkdy_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_mnu_weekdays({$tbl_mnu_weekdaysitem.mnu_wkdy_id});"></a>{if $tbl_mnu_weekdaysitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&mnu_wkdy_id={$tbl_mnu_weekdaysitem.mnu_wkdy_id}" class="deactiveIcon" title="{$_lang.tbl_mnu_weekdays.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&mnu_wkdy_id={$tbl_mnu_weekdaysitem.mnu_wkdy_id}" class="activeIcon" title="{$_lang.tbl_mnu_weekdays.ACTIVATE.BTN_LBL}"></a>{/if}</td>		</tr>	{/foreach}		<tfoot>			<tr>				<td colspan="9">					# {$result_found}&nbsp;&nbsp;&nbsp;{if $pagination neq ""}{$pagination}{/if}					<select onchange="changePage('{$navigationURL}',this.value,{$smarty.request.limit});">					{if $allPageCount gt 1}						{for $foo=1 to $allPageCount}							<option value="{$foo}" {if $foo eq $currentPage}selected="selected"{/if}>{$foo}</option>						{/for}					{else}						<option value="1" disabled="disabled">1</option>					{/if}					</select>				</td>			</tr>		</tfoot>	</table>{else}	<div class="error">{$_lang.tbl_mnu_weekdays.no_record_found}</div>{/if}<input onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_mnu_weekdays.CREATE.BTN_LBL}"/></div>{include file="tbl_mnu_weekdays/js.tpl"}{include file="footer.tpl"}