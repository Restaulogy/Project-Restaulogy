 
{assign var="curr_sts_val" value=$sub_order.sub_status_id} 
{assign var="sts_picker_l_onclick" value=""}	  
{assign var=first_index value=0} 
{foreach from=$sub_order.remain_order_statuses item=val key=kyval name=status}
  {if $val.visible eq 1}
	 {if $first_index neq 1}
    	{if $val.clickable eq 1}
			 		{if ($tbl_ordersitem[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_TAKE_OUT || $tbl_ordersitem[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_DELIVERY) && $tbl_ordersitem.order_status_id eq $smarty.const.TBL_STATUS_ORDERED &&  $val.id eq $smarty.const.TBL_STATUS_ORDER_CONFIRM && $tbl_ordersitem.order_takeout_time eq 0}
							{assign var="sts_picker_l_extra" value='data-rel="back"'}
							{assign var="sts_picker_r_onclick"	value="setTimeout('openConfirmTakeout()',500);$('#takeout_order_id').val({$tbl_ordersitem.order_id});"}
					{else}
						 {assign var="sts_picker_r_onclick"	value="changeSubOrderStatus({$sub_order.sub_id},{$val.id},{$tbl_ordersitem.order_id});"} 			
          {/if}
			 {assign var=first_index value=1}
			{/if}  
   {/if}
{/if}
{/foreach}
	  

{assign var="sts_picker_l_onclick" value=""}	 
{assign var=first_index value=0}
{foreach from=$sub_order.reverse_order_statuses item=val key=kyval name=xstatus} 
 {if $val.visible eq 1} 
		{if $first_index neq 1} 
		    {if $val.clickable eq 1}
						{assign var="sts_picker_l_onclick" value="changeSubOrderStatus({$sub_order.sub_id},{$val.id},{$tbl_ordersitem.order_id});"}
		 	  {/if}
				{assign var=first_index value=1}
 		{else}
 	 			{** DO NOTHING **}
 		{/if} 
 {/if}
{/foreach} 
         

{***for status pikcer START***} 
	{assign var=sts_picker_stage_id value=$sub_order.sub_id} 
	{assign var=sts_picker_stage  value=$sub_order.status_name}
	 
  {include file="control/click_statuspicker.tpl"}
{***for status pikcer END***}