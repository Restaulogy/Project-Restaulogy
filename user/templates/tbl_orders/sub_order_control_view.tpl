<div class="biz_center">

{if $sub_order.sub_status_id eq $smarty.const.TBL_STATUS_ORDERED}
   <!--
    {*if $sesslife && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER)*}
        <input type="button" data-icon="check" data-inline="true" value="Confirm Order"  {if ($tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_TAKE_OUT ||$tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_DELIVERY )}onclick='$("#popupConfirmOrder").popup("open");'{else}onclick='changeSubOrderStatus({$sub_id},{$smarty.const.TBL_STATUS_ORDER_CONFIRM},{$tbl_ordersinfo.order_id});'{/if}/>
	{*/if*}
   -->
{else} 
    {if $Global_member.member_role_id eq $smarty.const.ROLE_KITCHEN || $Global_member.member_role_id eq $smarty.const.ROLE_BAR}

		{if $sub_order.sub_status_id eq $smarty.const.TBL_STATUS_ORDER_CONFIRM ||  $sub_order.sub_status_id eq $smarty.const.TBL_STATUS_ORDER_DELAYED}
		 	<button onclick="changeSubOrderStatus({$sub_id},{$smarty.const.TBL_STATUS_ORDER_PICKED},{$tbl_ordersinfo.order_id});" data-icon="briefcase" data-inline="true">{$_lang.main.kitchen.pick_order}</button>    
		{/if}
		<button onclick="$('#popupKitchenSendmsg').popup('open');" data-icon="chat" data-inline="true">{$_lang.main.kitchen.send_message}</button>
			
		{include file="tbl_orders/order_delay_msg.tpl"}	
		{include file="tbl_orders/kitchen_send_msg.tpl"}	
	{/if}
{/if}	
   

<!--	<input data-role="button" data-icon="delete" data-inline="true" type="button" value="{$_lang.close_lbl}" class="fright"  onclick="javascript:{literal}if(window.opener){self.close();}else{window.location.href='{/literal}{$page_url}{literal}'}{/literal};"/>--> 
	{if $notify_id >0}
        <input data-role="button" data-icon="delete" data-inline="true" type="button" value="{$_lang.tbl_alerts.DELETE.BTN_NOTIFY_LBL}" onclick="window.location.href='{$website}/user/tbl_alerts.php?action={$smarty.const.ACTION_DELETE}&alert_id={$notify_id}';"/>
    {/if}
{if $tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_ORDER_CANCELLED} 
 	{*jqmbutton onclick="printReceipt({$tbl_ordersinfo.order_id});" icon="copy-item" value="Receipt"*} 

	{if $isAllSubOrderConfirmed gt 0}
		{*jqmbutton onclick="window.location.href='{$website}/user/tbl_orders.php?order_id={$tbl_ordersinfo.order_id}&{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}&is_pay_now=1';" value="Payment" icon="light"*}
	{else}
		{*jqmbutton onclick="alert('Please, First confirm all sub-orders.');" value="Payment" icon="light"*}
	{/if}
{/if}	 
	{jqmbutton onclick="window.location.href='{$website}/user/tbl_orders.php?order_id={$tbl_ordersinfo.order_id}&{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}';" value="Complete Order" icon="full-screen"}
</div> 
