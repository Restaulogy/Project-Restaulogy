{include file='header.tpl'}<div class="wrapper"><h1>{$_lang.tbl_cust_filter_email.listing_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{if $result_found gt 0 && $tbl_cust_filter_emaillist}<form name="frm_tbl_cust_filter_email" id="frm_tbl_cust_filter_email"  method="POST" action="{$page_url}" >	<table class="listTable">		<tr>        <th style="width:2%;"></th>        <th >{$_lang.tbl_cust_filter_email.title}</th>        <th >{$_lang.tbl_cust_filter_email.label.cfe_promotion}</th>        </tr>		{foreach from=$tbl_cust_filter_emaillist item=tbl_cust_filter_emailitem}			<tr>                <td style="width:2%;">					<label for="sel_tbl_cust_filter{$tbl_server_pinitem.srv_pin_id}" data-mini="true" style="width:23px;" >					<input type="checkbox" data-inline='true' data-mini='true' id="sel_tbl_cust_filter{$tbl_cust_filter_emailitem.cfe_id}" name="sel_tbl_cust_filter[{$tbl_cust_filter_emailitem.cfe_id}]" />&nbsp;</label>				</td>				<td >                    <a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&cfe_id={$tbl_cust_filter_emailitem.cfe_id}">{$tbl_cust_filter_emailitem.cfe_filter_textual}</a>                </td>                <td >                    <a href="{$page_url}?mode={$smarty.const.MODE_UPDATE}&cfe_id={$tbl_cust_filter_emailitem.cfe_id}">{$tbl_cust_filter_emailitem.prom_title}</a>                </td>			</tr>	{/foreach}	</table>{html_input type="hidden" name="action"}</form>{else}	<div class="error">{$_lang.tbl_cust_filter_email.no_record_found}</div>{/if}{if $pagination}	<center>{$pagination}</center>{/if}<div class="biz_center">{if $result_found gt 0 && $tbl_cust_filter_emaillist}	{jqmbutton icon="briefcase" value="{$_lang.main.toggle}" onclick="javascript:$('input[type=checkbox]').click();"}	{jqmbutton type="delete" onclick="actiontbl_cust_filter_email('{$smarty.const.ACTION_DELETE}');"}	{* jqmbutton icon="inactive" value="{$_lang.tbl_cust_filter_email.DEACTIVATE.BTN_LBL}" onclick="actiontbl_server_pin('{$smarty.const.ACTION_DEACTIVATE}');"*}	{*jqmbutton icon="active" value="{$_lang.tbl_cust_filter_email.ACTIVATE.BTN_LBL}" onclick="actiontbl_server_pin('{$smarty.const.ACTION_ACTIVATE}');"*}{/if}<input data-icon="add-item" data-inline="true" onclick="window.location.href='{$page_url}?mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_cust_filter_email.CREATE.BTN_LBL}"/></div></div>{include file="tbl_cust_filter_email/js.tpl"}{include file="footer.tpl"}