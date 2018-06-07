 {assign var="curr_sts_val" value=$tbl_ordersitem.order_status_id} 
  
	{assign var="sts_picker_r_onclick" value=""}			  
	{assign var=first_index value=0} 
	{foreach from=$tbl_ordersitem.remain_order_statuses item=val key=kyval name=status}
	 {if $val.visible eq 1} 
	 {if $first_index neq 1} 
	  {if ($tbl_ordersitem[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_TAKE_OUT || $tbl_ordersitem[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_DELIVERY) && $tbl_ordersitem.order_status_id eq $smarty.const.TBL_STATUS_ORDERED &&  $val.id eq $smarty.const.TBL_STATUS_ORDER_CONFIRM && $tbl_ordersitem.order_takeout_time eq 0}
			  {assign var="sts_picker_r_extra" value='data-rel="back"'}
				{assign var="sts_picker_r_onclick" value="setTimeout('openConfirmTakeout()',500);$('#takeout_order_id').val({$tbl_ordersitem.order_id});"}
			{else}
				{assign var="sts_picker_r_onclick" value="changeOrderStatus({$tbl_ordersitem.order_id},{$val.id});"} 
		{/if} 
		   		{** DO NOTHING **} 
					{assign var=first_index value=1} 
	 {else}
				 	{** DO NOTHING **}
    {/if} 
	{/if} 
	{/foreach}
	 
	 		{assign var="sts_picker_l_onclick" value=""}	
			{assign var=first_index value=0}
			 {foreach from=$tbl_ordersitem.reverse_order_statuses item=val key=kyval name=xstatus} 
			   {if $val.visible eq 1} 
					{if $first_index neq 1} 
				 			{assign var="sts_picker_l_onclick" value="changeOrderStatus({$tbl_ordersitem.order_id},{$val.id});"}	
				  
					{assign var=first_index value=1}
				 {else}
				 	 	{** DO NOTHING **}
				 {/if} 
				 {/if}
			 {/foreach} 
         

{***for status pikcer START***} 
	{assign var=sts_picker_stage_id value=$tbl_ordersitem.order_id} 
	{assign var=sts_picker_stage  value=$tbl_ordersitem.status}
	 
  {include file="control/click_statuspicker.tpl"}
{***for status pikcer END***}
			 
