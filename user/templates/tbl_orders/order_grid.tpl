{if $result_found gt 0 && $tbl_orderslist}<table class="biz_data_grid" style="width:98%;margin:2px;">		<tr>            <th class="{if $smarty.request.sort_on eq 'order_id'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=order_id&sort_by={$new_sort}">{$_lang.tbl_orders.label.order_id}</a></th>			{if $isCustomer neq 1}			<th class="{if $smarty.request.sort_on eq 'order_session_id'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=order_session_id&sort_by={$new_sort}">{$_lang.tbl_orders.label.order_session_id}</a></th>			{/if}			{if $smarty.request.table_id && $smarty.request.table_id gt 0}            {else}                <!--<th class="{if $smarty.request.sort_on eq 'dine_table'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=dine_table&sort_by={$new_sort}">{$_lang.tbl_orders.label.order_table_id}</a></th>                <th class="{if $smarty.request.sort_on eq 'server'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=server&sort_by={$new_sort}">{$_lang.tbl_orders.label.order_emp_id}</a></th>-->            {/if}						<th class="{if $smarty.request.sort_on eq 'order_customer_name'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=order_customer_name&sort_by={$new_sort}">{$_lang.tbl_orders.label.order_customer_name}</a></th>						<th class="{if $smarty.request.sort_on eq 'order_created_on'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=order_created_on&sort_by={$new_sort}">{$_lang.tbl_orders.label.order_created_on}</a></th>  	<!-- <th class="{if $smarty.request.sort_on eq 'order_completed_on'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=order_completed_on&sort_by={$new_sort}">{$_lang.tbl_orders.label.order_completed_on}</a></th> -->		 <th>status</th>		 <th>Amt</th>		 <th> Action</th>        </tr><!--onclick="location.href='{$page_url}&mode={$smarty.const.MODE_VIEW}&order_id={$tbl_ordersitem.order_id}&table_id={$smarty.request.table_id}&table_status={$smarty.request.table_status}&order_session_id={$smarty.request.order_session_id}';"--> 		{foreach from=$tbl_orderslist item=tbl_ordersitem} 		{cycle assign=cls values="odd,even"}		{assign var=orderlnk value="window.location.href='{$page_url}&mode={$smarty.const.MODE_VIEW}&order_id={$tbl_ordersitem.order_id}&table_id={$smarty.request.table_id}&table_status={$smarty.request.table_status}&order_session_id={$smarty.request.order_session_id}';"}				<tr class="{$cls} {if $tbl_ordersitem.customer_session.tbl_cust_sess_by_cust eq 1} customers{/if}">            <td onclick="{$orderlnk}">{$tbl_ordersitem.order_id}</td>		{if $isCustomer neq 1}			<td onclick="{$orderlnk}" align="center">{$tbl_ordersitem.order_session_id}</td>					{/if}				{if $smarty.request.table_id && $smarty.request.table_id gt 0}        {else}            <!--<td onclick="{$orderlnk}">{$tbl_ordersitem.dine_table}</td>-->			{* if $Global_member.member_role_id eq $smarty.const.ROLE_WAITER AND $tbl_ordersitem.order_emp_id==0}                <td onclick="{$orderlnk}">                    <input type="button" value="Assign" onclick="fill_sbform_assign_order({$tbl_ordersitem.order_id});"/>                </td>			{else}			     <td onclick="{$orderlnk}">{$tbl_ordersitem.server}</td>			{/if *}        {/if}						<!-- <td>{$tbl_ordersitem.order_customer_id}</td> -->			<td onclick="{$orderlnk}">{$tbl_ordersitem.order_customer_name|wordwrap:8:' ':true}            </td>			<td onclick="{$orderlnk}">{$tbl_ordersitem.order_created_on|date_format:$smarty.const.HTML5_DATETIME_FORMAT}</td>			<!-- <td>{$tbl_ordersitem.order_completed_on}</td> -->			<td>        {if ($tbl_ordersitem.isActive eq 1) && ($Global_member.member_id gt 0) && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq  $smarty.const.ROLE_WAITER || $Global_member.member_role_id eq $smarty.const.ROLE_OWNER) && ($tbl_ordersitem.order_status_id neq $smarty.const.TBL_STATUS_ORDER_CANCELLED) && ($tbl_ordersitem.order_online_status neq 1)} 			{include file="tbl_orders/new_statuspicker.tpl"}			{if $tbl_ordersitem.order_status_id eq $smarty.const.TBL_STATUS_ORDERED}			<br/><i style='font-family:Arial;color:red;'>(Not Confirmed)</i>{/if}		{else}            {$tbl_ordersitem.status}		{/if}			</td>		<td align="right" onclick="{$orderlnk}">{$tbl_ordersitem.gr_amt}</td> 		<td> {if ($tbl_ordersitem.order_status_id neq $smarty.const.TBL_STATUS_CHECK) && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR )}<input data-inline="true" data-icon="add-item" type="button" onclick="add_items_to_order({$tbl_ordersitem.order_id},{$tbl_ordersitem.order_table_id},'{$tbl_ordersitem.order_customer_name}');'" value="{$_lang.main.set_up_menu.add_items_to_order}"/>{/if} </td> 	</tr> 	{/foreach}  <tfoot>   <tr>				<td colspan="{if $smarty.request.table_id && $smarty.request.table_id gt 0}5{else}9{/if}"># {$result_found}&nbsp;&nbsp;{if $pagination neq ""}{$pagination}{/if}</td>            </tr>		</tfoot>	</table>{else}	<div class="error">{$_lang.tbl_orders.no_record_found}</div>{/if}