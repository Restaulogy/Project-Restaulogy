{if $result_found gt 0 && $sub_order_found gt 0 && $tbl_orderslist}<table class="biz_data_grid" style="width:98%;margin:2px;">		<tr>            <th class="{if $smarty.request.sort_on eq 'order_id'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=order_id&sort_by={$new_sort}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&order_session_id={$smarty.request.order_session_id}">{$_lang.tbl_orders.label.order_id}</a></th>{if $flt_cust_prefs eq ''}            <th class="">SubID</th>	   {if $ord_live_only neq 1} 			<th class="{if $smarty.request.sort_on eq 'order_session_id'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=order_session_id&sort_by={$new_sort}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&order_session_id={$smarty.request.order_session_id}">{$_lang.tbl_orders.label.order_session_id}</a></th>        {/if}        		{if $smarty.request.table_id && $smarty.request.table_id gt 0}        {else}            <!--<th class="{if $smarty.request.sort_on eq 'dine_table'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=dine_table&sort_by={$new_sort}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&order_session_id={$smarty.request.order_session_id}">{$_lang.tbl_orders.label.order_table_id}</a></th>			<th class="{if $smarty.request.sort_on eq 'server'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=server&sort_by={$new_sort}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&order_session_id={$smarty.request.order_session_id}">{$_lang.tbl_orders.label.order_emp_id}</a></th>-->        {/if}						<th class="{if $smarty.request.sort_on eq 'order_customer_name'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=order_customer_name&sort_by={$new_sort}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&order_session_id={$smarty.request.order_session_id}">{$_lang.tbl_orders.label.order_customer_name}</a></th>						{if $ord_live_only neq 1} 			<th class="{if $smarty.request.sort_on eq 'order_created_on'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=order_created_on&sort_by={$new_sort}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&order_session_id={$smarty.request.order_session_id}">{$_lang.tbl_orders.label.order_created_on}</a></th>{/if}  	<!-- <th class="{if $smarty.request.sort_on eq 'order_completed_on'}active_{if $smarty.request.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=order_completed_on&sort_by={$new_sort}">{$_lang.tbl_orders.label.order_completed_on}</a></th> -->		 <th>status</th>		 <th style='text-align:right !important; '>Amt.</th>		 <th>&nbsp; </th>{elseif $flt_cust_prefs eq 1}         <th>{$_lang.main.order.preferences}</th>         <th>{$_lang.main.order.manager_note}</th>{/if} <!-- end if for the preferences only-->        </tr><!--onclick="location.href='{$page_url}&mode={$smarty.const.MODE_VIEW}&order_id={$tbl_ordersitem.order_id}&table_id={$smarty.request.table_id}&table_status={$smarty.request.table_status}&order_session_id={$smarty.request.order_session_id}';"--> 		{foreach from=$tbl_orderslist item=tbl_ordersitem} 		{assign var="new_row" value=1}		{assign var=orderlnk value="window.location.href='{$page_url}&mode={$smarty.const.MODE_VIEW}&order_id={$tbl_ordersitem.order_id}&table_id={$smarty.request.table_id}&table_status={$smarty.request.table_status}&order_session_id={$smarty.request.order_session_id}';"}		<tr class="sub_main {if $new_row eq 1}seperator{/if}">            <td onclick="{$orderlnk}">{$tbl_ordersitem.order_id}</td>			<td onclick="{$orderlnk}">&nbsp;</td>					{if $smarty.request.table_id && $smarty.request.table_id gt 0}        {else}            <!--<td onclick="{$orderlnk}">{$tbl_ordersitem.dine_table}</td>-->			{* if $Global_member.member_role_id eq $smarty.const.ROLE_WAITER AND $tbl_ordersitem.order_emp_id==0}                <td onclick="{$orderlnk}">                    <input type="button" value="Assign" onclick="fill_sbform_assign_order({$tbl_ordersitem.order_id});"/>                </td>			{else}			     <td onclick="{$orderlnk}">{$tbl_ordersitem.server}</td>			{/if *}        {/if}		 			<td onclick="{$orderlnk}">{$tbl_ordersitem.order_customer_name|wordwrap:8:' ':true}        {if $tbl_ordersitem.isActive eq 1}                    <span class="biz_highlight_success">new</span>                 {/if}            </td>			<td>              {if ($Global_member.id gt 0) && (($tbl_ordersitem.order_status_id eq $smarty.const.TBL_STATUS_ORDER_CANCELLED) || ($tbl_ordersitem.order_status_id eq $smarty.const.TBL_STATUS_CHECK))}		          {$tbl_ordersitem.status}		      {else}                    In Process		      {/if}            </td>			<td align="right" onclick="{$orderlnk}">{$tbl_ordersitem.gr_amt}</td> 			<td> {if ($tbl_ordersitem.order_status_id neq $smarty.const.TBL_STATUS_CHECK) && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR )} <input data-inline="true" data-mini="true" data-icon="add-item" type="button" onclick="add_items_to_order({$tbl_ordersitem.order_id},{$tbl_ordersitem.order_table_id},'{$tbl_ordersitem.order_customer_name}');" value="{$_lang.main.set_up_menu.add_items_to_order}"/> {/if} </td> 	</tr> 		{foreach from=$tbl_ordersitem.sub_orders item=sub_order}		{cycle assign=cls values="odd,even"}		{assign var=sub_orderlnk value="window.location.href='{$page_url}&mode={$smarty.const.MODE_VIEW}&order_id={$tbl_ordersitem.order_id}&table_id={$smarty.request.table_id}&table_status={$smarty.request.table_status}&order_session_id={$smarty.request.order_session_id}&sub_id={$sub_order.sub_id}';"}				<tr class="{$cls} {if $tbl_ordersitem.customer_session.tbl_cust_sess_by_cust eq 1} customers{/if}">            <td onclick="{$sub_orderlnk}">{* $tbl_ordersitem.order_id *}</td>            <td onclick="{$sub_orderlnk}">{$sub_order.sub_id}</td>  {if $flt_cust_prefs eq ''}            {if $ord_live_only neq 1}			<td onclick="{$sub_orderlnk}" align="center">{$tbl_ordersitem.order_session_id}</td>			{/if}        {if $smarty.request.table_id && $smarty.request.table_id gt 0}        {else}            <!--<td onclick="{$sub_orderlnk}">{* $tbl_ordersitem.dine_table *}</td>-->			{*if $Global_member.member_role_id eq $smarty.const.ROLE_WAITER AND $tbl_ordersitem.order_emp_id==0}                <td onclick="{$sub_orderlnk}">                    <input type="button" value="Assign" onclick="fill_sbform_assign_order({$tbl_ordersitem.order_id});"/>                </td>			{else}			     <td onclick="{$sub_orderlnk}">{*$tbl_ordersitem.server}</td>			{/if *}        {/if}        			<!-- <td>{$tbl_ordersitem.order_customer_id}</td> -->			<td onclick="{$sub_orderlnk}">{*$tbl_ordersitem.order_customer_name|wordwrap:8:' ':true*}</td>			{if $ord_live_only neq 1} 			<td onclick="{$sub_orderlnk}">{* $tbl_ordersitem.order_created_on|date_format:$smarty.const.HTML5_DATETIME_FORMAT *}</td>			{/if}			<!-- <td>{$tbl_ordersitem.order_completed_on}</td> -->			<td>			  			{if ($tbl_ordersitem.isActive eq 1) && ($Global_member.member_id gt 0) && ($tbl_ordersitem.order_status_id neq $smarty.const.TBL_STATUS_ORDER_CANCELLED)}			{$sub_order.status_name}			{*include file="tbl_orders/new_suborder_statuspicker.tpl"*}			{if $sub_order.sub_status_id eq $smarty.const.TBL_STATUS_ORDERED}			     <br/><i style='font-family:Arial;color:red;'>(Not Confirmed)</i>            {/if}		{else}		{$tbl_ordersitem.status}		{/if}			</td>		<td align="right" onclick="{$sub_orderlnk}">{$sub_order.sub_gross_amt|string_format:"%.2f"}</td>		<td>&nbsp;</td>{elseif $flt_cust_prefs eq 1}         <td>{$tbl_ordersitem.order_note}</td>         <td>{$tbl_ordersitem.order_manager_note}</td>{/if} <!-- end if for the preferences only--> 	</tr> 	{assign var="new_row" value=0}	{/foreach}	{/foreach}  <tfoot>   <tr>				<td colspan="{if $smarty.request.table_id && $smarty.request.table_id gt 0}5{else}9{/if}">			# {$sub_order_found}&nbsp;&nbsp;&nbsp;{if $pagination neq ""}{$pagination}{/if}				</td>            </tr>		</tfoot>	</table>{else}	<div class="error">{$_lang.tbl_orders.no_record_found}</div>{/if}