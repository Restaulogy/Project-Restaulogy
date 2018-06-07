<table class="listTable">
		<tr><th class="fieldItem">&nbsp;</th><th class="valueItem">{$_lang.tbl_orders.title|upper} # &nbsp; {$tbl_ordersinfo.order_id}{if $sub_id gt 0}/{$sub_id}{/if}</th></tr>

		<!--<tr><td class="fieldItem">{$_lang.tbl_orders.label.order_table_id}<i>:</i></td><td class="valueItem">{$tbl_ordersinfo.dine_table}</td></tr>

		<tr><td class="fieldItem">{$_lang.tbl_orders.label.order_emp_id}<i>:</i></td><td class="valueItem"> 
		{$tbl_ordersinfo.server} 
		</td></tr>

		 <tr><td class="fieldItem">{$_lang.tbl_orders.label.order_customer_id}<i>:</i></td><td class="valueItem">{$tbl_ordersinfo.order_customer_id}</td></tr> -->

		<tr><td class="fieldItem">{$_lang.tbl_orders.label.order_customer_name}<i>:</i></td><td class="valueItem">
 	{*if	$Global_member.member_role_id eq $smarty.const.ROLE_MANAGER*}
 	
		{if (($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR ) || (($smarty.const.IS_SERV_ALWD_NOTE eq 1) && ($Global_member.member_role_id eq $smarty.const.ROLE_WAITER))) }
		<a href="{$website}/user/tbl_orders.php?{$smarty.const.FILTER_BY_CUST}={$tbl_ordersinfo.order_customer_name}&{$smarty.const.ORDER_CUSTOMER_TYPE}={$tbl_ordersinfo.order_customer_type}&{$smarty.const.ORDER_CUSTOMER_ID}={$tbl_ordersinfo.order_customer_id}" target="_blank">{$tbl_ordersinfo.order_customer_name}</a>
		{else}
			{$tbl_ordersinfo.order_customer_name}
		{/if}
		</td></tr>
		{if $tbl_ordersinfo.order_note}
		<tr><td class="fieldItem">{$_lang.tbl_orders.label.order_note}<i>:</i></td><td class="valueItem">{if $tbl_ordersinfo.order_note}{$tbl_ordersinfo.order_note}{else}{$_lang.empty_text_mark}{/if}</td></tr>
		{/if}
		
		{* if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER ||  $Global_member.member_role_id eq $smarty.const.ROLE_OWNER *}
		 {if (($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR) || ($Global_member.member_role_id eq $smarty.const.ROLE_OWNER) || (($smarty.const.IS_SERV_ALWD_NOTE eq 1) && ($Global_member.member_role_id eq $smarty.const.ROLE_WAITER))) && ($tbl_ordersinfo.order_manager_note)}
		<tr><td class="fieldItem">{$_lang.tbl_orders.label.order_manager_note}<i>:</i></td><td class="valueItem">{if $tbl_ordersinfo.order_manager_note}{$tbl_ordersinfo.order_manager_note}{else}{$_lang.empty_text_mark}{/if}</td></tr> 
		{/if}
		
		<tr><td class="fieldItem">{$_lang.tbl_orders.label.order_created_on}<i>:</i></td><td class="valueItem">{if $sub_id gt 0}{$sub_order.sub_start_date|date_format:$smarty.const.HTML5_DATETIME_FORMAT}{else}{$tbl_ordersinfo.order_created_on|date_format:$smarty.const.HTML5_DATETIME_FORMAT}{/if}</td></tr>
		
		{if $tbl_ordersinfo.order_completed_on || $sub_order.sub_end_date}
		<tr><td class="fieldItem">{$_lang.tbl_orders.label.order_completed_on}<i>:</i></td><td class="valueItem">{if $sub_id gt 0}{$sub_order.sub_end_date|date_format:$smarty.const.HTML5_DATETIME_FORMAT}{else}{$tbl_ordersinfo.order_completed_on|date_format:$smarty.const.HTML5_DATETIME_FORMAT}{/if}</td></tr>
		{/if}
		
		<tr><td class="fieldItem">{$_lang.tbl_orders.label.order_status_id}<i>:</i></td><td class="valueItem">
		
  		{if $sub_id gt 0}
            {if ($tbl_ordersinfo.isActive eq 1) && ($Global_member.member_id gt 0) && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq  $smarty.const.ROLE_WAITER || $Global_member.member_role_id eq $smarty.const.ROLE_OWNER) && ($sub_order.sub_status_id neq $smarty.const.TBL_STATUS_ORDER_CANCELLED) && $tbl_ordersinfo.order_online_status neq 1}
                {assign var='tbl_ordersitem' value=$tbl_ordersinfo}
                <div style="font-size:11px;">
    			{include file="tbl_orders/new_suborder_statuspicker.tpl"}
    			</div>
              	{if $sub_order.sub_status_id eq $smarty.const.TBL_STATUS_ORDERED}
    			     <i style='font-family:Arial;color:red;'>(Not Confirmed)</i> -&nbsp;&nbsp;
                {/if}
            {/if}
            {$sub_order.status_name}

			{if $sub_order.sub_status_id  eq $smarty.const.TBL_STATUS_ORDER_CONFIRM && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER)}
				{if $sub_order.is_delayed eq 1}(Order delayed){/if}
			{/if}
		{else}
			{$tbl_ordersinfo.status}
			{if $tbl_ordersinfo.order_status_id  eq $smarty.const.TBL_STATUS_ORDER_CONFIRM && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER)}
				{if $tbl_ordersinfo.is_delayed eq 1}(Order delayed){/if}
			{/if}
		{/if}
        </td>
       </tr>

	<!-- <tr><td class="fieldItem">{$_lang.tbl_orders.label.isActive}<i>:</i></td><td class="valueItem">{if $tbl_ordersinfo.isActive eq 1}{$_lang.tbl_orders.label.isActive_yes}{else}{$_lang.tbl_orders.label.isActive_no}{/if}</td></tr>
	-->
	</table>
