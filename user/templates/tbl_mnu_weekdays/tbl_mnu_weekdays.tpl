{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_mnu_weekdays.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_mnu_weekdayslist}	<table class="listTable">		<tr><th class="bigListItem">{$_lang.tbl_mnu_weekdays.title}</th>		<th class="actionListItem"></th></tr>		{foreach from=$tbl_mnu_weekdayslist item=tbl_mnu_weekdaysitem}			<tr>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&mnu_wkdy_id={$tbl_mnu_weekdaysitem.mnu_wkdy_id}">{$tbl_mnu_weekdaysitem.mnu_wkdy_menu_id}</a></td>				<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&mnu_wkdy_id={$tbl_mnu_weekdaysitem.mnu_wkdy_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_mnu_weekdays({$tbl_mnu_weekdaysitem.mnu_wkdy_id});"></a>{if $tbl_mnu_weekdaysitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&mnu_wkdy_id={$tbl_mnu_weekdaysitem.mnu_wkdy_id}" class="deactiveIcon" title="{$_lang.tbl_mnu_weekdays.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&mnu_wkdy_id={$tbl_mnu_weekdaysitem.mnu_wkdy_id}" class="activeIcon" title="{$_lang.tbl_mnu_weekdays.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_mnu_weekdays.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<input onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_mnu_weekdays.CREATE.BTN_LBL}"/></div>{include file="tbl_mnu_weekdays/js.tpl"}{include file="footer.tpl"}