{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_server_pin.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_server_pinlist}<form name="frm_tbl_server_pin" id="frm_tbl_server_pin"  method="POST" action="{$page_url}" >	<table class="listTable">		<tr>        <th style="width:2%;"></th>        <th class="bigListItem">{$_lang.tbl_server_pin.title}</th>        <th style="width:5%;">                {$_lang.main.status}		</th>        </tr>		{foreach from=$tbl_server_pinlist item=tbl_server_pinitem}			<tr>                <td style="width:2%;">					<label for="sel_tbl_server_pin{$tbl_server_pinitem.srv_pin_id}" data-mini="true" style="width:23px;" >                    <input type="checkbox" data-inline='true' data-mini='true' id="sel_tbl_server_pin{$tbl_server_pinitem.srv_pin_id}" name="sel_tbl_server_pin[{$tbl_server_pinitem.srv_pin_id}]" />&nbsp;</label>				</td>				<td class="bigListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&srv_pin_id={$tbl_server_pinitem.srv_pin_id}">{$tbl_server_pinitem.srv_pin_password}</a></td>				<td >                {if $tbl_server_pinitem.isActive eq 1}                  <a href="#" class="activeIcon" title="{$_lang.tbl_server_pin.ACTIVATE.BTN_LBL}"></a>                {else}                  <a href="#" class="deactiveIcon" title="{$_lang.tbl_server_pin.DEACTIVATE.BTN_LBL}"></a>                {/if}                </td>                <!--				<td class="actionListItem"><a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&srv_pin_id={$tbl_server_pinitem.srv_pin_id}" class="editIcon"></a><a class="deleteIcon" href="#" onclick="deletetbl_server_pin({$tbl_server_pinitem.srv_pin_id});"></a>{if $tbl_server_pinitem.isActive eq 1}<a href="{$page_url}?action={$smarty.const.ACTION_DEACTIVATE}&srv_pin_id={$tbl_server_pinitem.srv_pin_id}" class="deactiveIcon" title="{$_lang.tbl_server_pin.DEACTIVATE.BTN_LBL}"></a>{else}<a href="{$page_url}?action={$smarty.const.ACTION_ACTIVATE}&srv_pin_id={$tbl_server_pinitem.srv_pin_id}" class="activeIcon" title="{$_lang.tbl_server_pin.ACTIVATE.BTN_LBL}"></a>{/if}</td>				-->			</tr>	{/foreach}	</table>{html_input type="hidden" name="action"}</form>{else}	<div class="error">{$_lang.tbl_server_pin.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<div class="biz_center">{if $result_found gt 0 && $tbl_server_pinlist}	{jqmbutton icon="briefcase" value="{$_lang.main.toggle}" onclick="javascript:$('input[type=checkbox]').click();"}	{jqmbutton type="delete" onclick="actiontbl_server_pin('{$smarty.const.ACTION_DELETE}');"}	{jqmbutton icon="inactive" value="{$_lang.tbl_server_pin.DEACTIVATE.BTN_LBL}" onclick="actiontbl_server_pin('{$smarty.const.ACTION_DEACTIVATE}');"}	{jqmbutton icon="active" value="{$_lang.tbl_server_pin.ACTIVATE.BTN_LBL}" onclick="actiontbl_server_pin('{$smarty.const.ACTION_ACTIVATE}');"}{/if}	<input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_server_pin.CREATE.BTN_LBL}"/></div>{include file="tbl_server_pin/js.tpl"}{include file="footer.tpl"}