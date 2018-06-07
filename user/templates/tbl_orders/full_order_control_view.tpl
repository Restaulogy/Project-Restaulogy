<div class="biz_center"> 
{if $sesslife && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER) && $tbl_ordersinfo.order_online_status gt 0 } 


		{if $tbl_ordersinfo.order_status_id eq $smarty.const.TBL_STATUS_ORDER_CONFIRM } 	
				{jqmbutton onclick="makeOrderReady({$tbl_ordersinfo.order_id});" icon="add-item" value="Ready to pick up"}
		{/if}
		{if $tbl_ordersinfo.order_status_id eq $smarty.const.STS_ONLINE_ORDER_PLACED}
		 	 {jqmbutton onclick="$('#popupConfirmOnlineOrder').popup('open');" icon="add-item" value="Confirm Order"}
				
		{/if}
{/if}
 
{if $sesslife && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR )}
	 {if $tbl_ordersinfo.order_status_id eq $smarty.const.TBL_STATUS_ORDERED}
	 			<input type="button" data-icon="delete" data-inline="true" value="Cancel Order" onclick='changeOrderStatus({$tbl_ordersinfo.order_id},{$smarty.const.TBL_STATUS_ORDER_CANCELLED});'/> 
	 {/if}
	 {if $tbl_ordersinfo.order_status_id  eq $smarty.const.TBL_STATUS_ORDER_CANCELLED}
	 			<input type="button" data-icon="reload" data-inline="true" value="Restore Order" onclick='changeOrderStatus({$tbl_ordersinfo.order_id},{$smarty.const.TBL_STATUS_ORDERED});'/> 
	 {/if}
{/if}
 
{if $tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_TAKE_OUT && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR) && ($tbl_ordersinfo.order_status_id != $smarty.const.TBL_STATUS_CHECK )}
	 {*jqmbutton icon="sign-out" value="Convert To Dine in" onclick="$('#popupConvertTakeOut').popup('open');"*}
{/if}  

{*if  (( $tbl_ordersinfo.order_status_id >= $smarty.const.TBL_STATUS_ORDER_CONFIRM) || ($tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_TAKE_OUT ||$tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_DELIVERY ) || ($tbl_ordersinfo.order_status_id == $smarty.const.TBL_STATUS_CHECK ))}	
	{if $smarty.session[$smarty.const.SES_CUST_NM] neq "" || $Global_member.rl_fn_payment_process eq 1 }
	{if ($tbl_ordersinfo.show_opt_bx eq 1 || $tbl_ordersinfo.can_pay_amt>0) && !($tbl_ordersinfo.order_online_status gt 0 && $sesslife==FALSE ) }
	  	{if $tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_ORDER_CANCELLED}
		 	{jqmbutton  icon="light" onclick="openPaymentMode();" value="Payment"}
		{/if}
	{/if}	 
	{/if}
{/if*}

{if ($tbl_ordersinfo.order_status_id >= $smarty.const.TBL_STATUS_ORDER_PICKED) && ($tbl_ordersinfo.is_all_paid eq 1) && ($tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_DELIVERED) && ($tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_TAKE_OUT ||$tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_DELIVERY ) && ($Global_member.member_role_id eq $smarty.const.ROLE_OWNER || $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER)}
 <input type="button" data-icon="cart" data-inline="true" value="Delivered" onclick='changeOrderStatus({$tbl_ordersinfo.order_id},{$smarty.const.TBL_STATUS_DELIVERED});'/> 
{/if} 
	<!--<input data-role="button" data-icon="delete" data-inline="true" type="button" value="{$_lang.close_lbl}" onclick="javascript:{literal}if(window.opener){self.close();}else{window.location.href='{/literal}{$page_url}{literal}'}{/literal};"/>-->
    {if $notify_id >0}
        <input data-role="button" data-icon="delete" data-inline="true" type="button" value="{$_lang.tbl_alerts.DELETE.BTN_NOTIFY_LBL}" onclick="window.location.href='{$website}/user/tbl_alerts.php?action={$smarty.const.ACTION_DELETE}&alert_id={$notify_id}';"/>
    {/if}
	
	{if $tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_CHECK }
	  {if !($tbl_ordersinfo.order_online_status gt 0 && $sesslife==FALSE)}
	   {if !($sesslife && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER) && $tbl_ordersinfo.order_online_status eq 1 && $tbl_ordersinfo.order_status_id eq $smarty.const.STS_ONLINE_ORDER_PLACED)}
		<a data-role="button" data-icon="star" data-inline="true" type="button" onclick="window.location.href ='{$website}/paypal/payment.php?order_id={$tbl_ordersinfo.order_id}&order_payment_id=0&payment_choice=INDIVIDUAL&ord_pmnt_split_amng={$tbl_ordersinfo.payment_options.ord_pmnt_split_amng}&order_amt_i_pay={$tbl_ordersinfo.can_pay_amt}&order_tip=0&isPayByCash=1&ord_pmnt_split_pay_for=1';" target="_blank" >{$_lang.main.pay_by_cash}</a>
		{/if}	
		{/if}
	{/if}
	{if !($tbl_ordersinfo.order_online_status gt 0 && $sesslife==FALSE )}
 	{jqmbutton onclick="printReceipt({$tbl_ordersinfo.order_id});" icon="copy-item" value="Receipt"}
 	{/if}
 	
 	{*if $sesslife && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER) && $tbl_ordersinfo.order_customer_type eq 'LOGIN' and $tbl_ordersinfo.order_rewardpts_added eq 0}
 		<a data-role="button" data-icon="star" data-inline="true" type="button" onclick="window.open('{$website}/user/customer_rewards.php?manager_cust_sess_id={$tbl_ordersinfo.order_customer_id}&_loy_cust_ord_amt={$tbl_ordersinfo.curr_bill_amnt}');"  >{$_lang.biz_checkins.create_title}</a>
 	{/if *}

{if ($tbl_ordersinfo.order_is_tmp==1) && ($tbl_ordersinfo.isActive eq 1) && ($tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_ORDER_CANCELLED  || $tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_CHECK)}
	{jqmbutton onclick="goEditOrder({$tbl_ordersinfo.order_id});" icon="check" value="Edit"}
	{if ($tbl_ordersinfo.order_isclaimed_promotions==0)}
		{jqmbutton onclick="openPromotions({$tbl_ordersinfo.order_id},{$tbl_ordersinfo.order_customer_id});" icon="add-item" value="Add Promotions"}
	{/if} 
	<a data-role="button" data-icon="add-item" data-inline="true" type="button" onclick="switchToMainOrder({$tbl_ordersinfo.order_id});" class="ui-btn-active" >Submit Order</a>		
	{jqmbutton onclick="gocancelorder({$tbl_ordersinfo.order_id});" icon="delete" value="Cancel Order"}
{/if} 	
 	
{if ($tbl_ordersinfo.isActive eq 1) && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER)  && ($tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_ORDER_CANCELLED  || $tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_CHECK) && ($tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_AT_LOCATION)}
	{* jqmbutton onclick="openPromotions({$tbl_ordersinfo.order_id});" icon="add-item" value="Add Promotions" *}
	{if $tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_ORDERED }
	{jqmbutton onclick="$('#popupMiscCharges').popup('open');" icon="add-item" value="Misc. Charges"}
	{/if} 
{/if}	
	
</div> 
{include file="tbl_orders/promotions.tpl"}
{include file="tbl_orders/misc_charges.tpl"}