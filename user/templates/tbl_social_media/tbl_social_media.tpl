{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_social_media.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_social_medialist}	<table class="listTable">		<tr><th class="bigListItem">{$_lang.tbl_social_media.title}</th>		<th class="actionListItem"></th></tr>		{foreach from=$tbl_social_medialist item=tbl_social_mediaitem}			<tr>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&social_id={$tbl_social_mediaitem.social_id}">{$tbl_social_mediaitem.social_restarant}</a></td>				<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&social_id={$tbl_social_mediaitem.social_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_social_media({$tbl_social_mediaitem.social_id});"></a>{if $tbl_social_mediaitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&social_id={$tbl_social_mediaitem.social_id}" class="deactiveIcon" title="{$_lang.tbl_social_media.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&social_id={$tbl_social_mediaitem.social_id}" class="activeIcon" title="{$_lang.tbl_social_media.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_social_media.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<center><input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_social_media.CREATE.BTN_LBL}"/></center></div>{include file="tbl_social_media/js.tpl"}{include file="footer.tpl"}