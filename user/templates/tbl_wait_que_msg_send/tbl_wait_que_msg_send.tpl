{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_wait_que_msg_send.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_wait_que_msg_sendlist}	<table class="listTable">		<tr><th class="bigListItem">{$_lang.tbl_wait_que_msg_send.title}</th>		<th class="actionListItem"></th></tr>		{foreach from=$tbl_wait_que_msg_sendlist item=tbl_wait_que_msg_senditem}			<tr>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_VIEW}&wtq_msg_send_id={$tbl_wait_que_msg_senditem.wtq_msg_send_id}">{$tbl_wait_que_msg_senditem.wtq_msg_send_msg_id}</a></td>				<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&wtq_msg_send_id={$tbl_wait_que_msg_senditem.wtq_msg_send_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_wait_que_msg_send({$tbl_wait_que_msg_senditem.wtq_msg_send_id});"></a>{if $tbl_wait_que_msg_senditem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&wtq_msg_send_id={$tbl_wait_que_msg_senditem.wtq_msg_send_id}" class="deactiveIcon" title="{$_lang.tbl_wait_que_msg_send.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&wtq_msg_send_id={$tbl_wait_que_msg_senditem.wtq_msg_send_id}" class="activeIcon" title="{$_lang.tbl_wait_que_msg_send.ACTIVATE.BTN_LBL}"></a>{/if}</td>			</tr>	{/foreach}	</table>{else}	<div class="error">{$_lang.tbl_wait_que_msg_send.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<center><input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_wait_que_msg_send.CREATE.BTN_LBL}"/></center></div>{include file="tbl_wait_que_msg_send/js.tpl"}{include file="footer.tpl"}