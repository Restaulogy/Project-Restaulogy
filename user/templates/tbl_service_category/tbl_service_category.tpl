{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_service_category.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_service_categorylist}	<table class="listTable">		<tr><th class="bigListItem">{$_lang.tbl_service_category.title}</th>		<th class="actionListItem"></th></tr>		{foreach from=$tbl_service_categorylist item=tbl_service_categoryitem}			<tr>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&srvc_cat_id={$tbl_service_categoryitem.srvc_cat_id}">{$tbl_service_categoryitem.srvc_cat_code}</a></td>				<td class="actionListItem">				<a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&srvc_cat_id={$tbl_service_categoryitem.srvc_cat_id}" class="detailIcon"></a>				<a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&srvc_cat_id={$tbl_service_categoryitem.srvc_cat_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_service_category({$tbl_service_categoryitem.srvc_cat_id});"></a>				{if $tbl_service_categoryitem.isActive eq 1}				<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&srvc_cat_id={$tbl_service_categoryitem.srvc_cat_id}" class="deactiveIcon" title="{$_lang.tbl_service_category.DEACTIVATE.BTN_LBL}"></a>				{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&srvc_cat_id={$tbl_service_categoryitem.srvc_cat_id}" class="activeIcon" title="{$_lang.tbl_service_category.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_service_category.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<center><input data-inline="true" data-icon="add-item" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_service_category.CREATE.BTN_LBL}"/><input data-inline="true" data-icon="back" onclick="window.location.href='{$website}/user/tbl_services_code.php';" type="button" value="{$_lang.tbl_services_code.listing_title}" /></center></div>{include file="tbl_service_category/js.tpl"}{include file="footer.tpl"}