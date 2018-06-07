{if ($tbl_ordersinfo.payment_options) && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR ) && ($sub_id eq 0)}

{* if $tbl_ordersinfo.trans_count gt 0 && $tbl_ordersinfo.translist *}
{if 0}
<h1>Paypal Transaction with Refund</h1>
	<table class="biz_data_grid">
		<tr>
			<th>{$_lang.tbl_ord_paypal_trans.label.paypal_txn_id}</th>
			<th>{$_lang.tbl_ord_paypal_trans.label.paypal_txn_amnt}</th>
			<!--<th>{$_lang.tbl_ord_paypal_trans.label.paypal_payment_id}</th>-->
			<th>{$_lang.tbl_ord_paypal_trans.label.paypal_refund_type}</th>
			<th>Refunded Amt</th>
			<th class="action_header">Status</th>		</tr>

		{foreach from=$tbl_ordersinfo.translist item=tbl_ord_paypal_transitem}
		<tr class="{cycle values="odd,even"}">
			<td><a href="#" onclick="openRefundList({$tbl_ord_paypal_transitem.paypal_id},'{$tbl_ord_paypal_transitem.paypal_refund_type}','{$tbl_ord_paypal_transitem.paypal_txn_id}',{$tbl_ord_paypal_transitem.paypal_txn_amnt});" title="{$tbl_ord_paypal_transitem.paypal_txn_id}">{$tbl_ord_paypal_transitem.paypal_txn_id|truncate:10}</a></td>
			<td>{$tbl_ord_paypal_transitem.paypal_txn_amnt}</td>
			<!--<td>{$tbl_ord_paypal_transitem.paypal_payment_id}</td>-->
			<td>{$tbl_ord_paypal_transitem.paypal_refund_type}</td>
			<td>{$tbl_ord_paypal_transitem.refunded_amt|string_format:"%.2f"}</td>
			<td>{if $tbl_ord_paypal_transitem.paypal_refund_complete eq 1}Refunded{else}{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR}{jqmbutton value="Refund" icon="reload" mini="true" onclick="openRefund({$tbl_ord_paypal_transitem.paypal_id},{$tbl_ord_paypal_transitem.paypal_txn_amnt},'{$tbl_ord_paypal_transitem.paypal_refund_type}',{$tbl_ord_paypal_transitem.refunded_amt},{$tbl_ord_paypal_transitem.paypal_refund_complete});"}{else}--{/if}{/if}</td>		</tr>
	{/foreach}

		<tfoot>
			<tr>
				<td colspan="8"># {$tbl_ordersinfo.trans_count}</td></tr>
		</tfoot>
	</table>
	
{include file="tbl_orders/refund.tpl"}
{else}
	<!--<div class="error">{$_lang.tbl_ord_paypal_trans.no_record_found}</div>-->
{/if}

{/if}
