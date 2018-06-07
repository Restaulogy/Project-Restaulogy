 
{assign var="curr_sts_val" value=$tbl_ordersitem.order_status_id} 
{***for status pikcer START***} 
	{assign var=sts_picker_stage_id value=$tbl_ordersitem.order_id} 
	{assign var=sts_picker_stage  value=$tbl_ordersitem.status}
	 
  {include file="control/statuspicker.tpl"}
{***for status pikcer END***}
			 
 <div data-role="popup" id="popupMenu{$tbl_ordersitem.order_id}" data-theme="d" >
	<ul data-role="listview" data-inset="true" style="min-width:210px;">
        <li data-role="divider" data-theme="a">Change Status</li>
				
	 
	{assign var=first_index value=0}
 
	{foreach from=$tbl_ordersitem.remain_order_statuses item=val key=kyval name=status}
	 {if $val.visible eq 1} 
	 {if $first_index neq 1} 

				 	<li><a href="#" {if ($tbl_ordersitem[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_TAKE_OUT || $tbl_ordersitem[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_DELIVERY) && $tbl_ordersitem.order_status_id eq $smarty.const.TBL_STATUS_ORDERED &&  $val.id eq $smarty.const.TBL_STATUS_ORDER_CONFIRM && $tbl_ordersitem.order_takeout_time eq 0}data-rel="back" onclick='setTimeout("openConfirmTakeout()",500);$("#takeout_order_id").val({$tbl_ordersitem.order_id});'{else}onclick="changeOrderStatus({$tbl_ordersitem.order_id},{$val.id});"{/if}>{$val.title}</a></li>  
					{assign var=first_index value=1} 
	 {else}
				 	<li class="ui-disabled"><a href="#">{$val.title}</a></li>
    {/if} 
	{/if} 
	{/foreach}
	 
	</ul>
</div> 

<div data-role="popup" id="popupReverseMenu{$tbl_ordersitem.order_id}"  data-theme="d" >
		<ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="divider" data-theme="a">Change Status </li> 
			{assign var=first_index value=0}
			 {foreach from=$tbl_ordersitem.reverse_order_statuses item=val key=kyval name=xstatus} 
			   {if $val.visible eq 1} 
					{if $first_index neq 1} 
				 
				 	<li><a href="#" onclick="changeOrderStatus({$tbl_ordersitem.order_id},{$val.id});">{$val.title}</a></li> 
					{assign var=first_index value=1}
				 {else}
				 	<li class="ui-disabled"><a href="#">{$val.title}</a></li>
				 {/if} 
				 {/if}
			 {/foreach} 
        </ul>
</div>
