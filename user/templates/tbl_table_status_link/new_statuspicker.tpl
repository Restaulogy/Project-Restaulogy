{assign var="curr_sts_val" value="0"}
{assign var="curr_sts_key" value="0"}
 
{if $tbl_sts_lnk_key[$tbl_table_status_linkitem.tbl_sts_lnk_table_id] < $sts_avail_key}
    {assign var="curr_sts_key" value="{$tbl_sts_lnk_key[$tbl_table_status_linkitem.tbl_sts_lnk_table_id]}"} 
	{assign var="curr_sts_val" value="{$tbl_table_status_linkitem.tbl_sts_lnk_status_id}"}
{/if}  

{***for status pikcer START***} 
	{assign var=sts_picker_stage_id value=$tbl_table_status_linkitem.tbl_sts_lnk_table_id} 
	{assign var=sts_picker_stage value=$tbl_table_status_linkitem.status.tbl_sts_name} 
  {include file="control/statuspicker.tpl"}
{***for status pikcer END***}
		  
 <div data-role="popup" id="popupMenu{$tbl_table_status_linkitem.tbl_sts_lnk_table_id}" data-theme="d" >
        <ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="divider" data-theme="a">Change Status</li>  
			{assign var=first_index value=0}
		 
			{foreach from=$lst_table_status item=val key=kyval name=status} 
			  {if $kyval > $curr_sts_key} 
					 	{if $first_index neq 1}
						{if $val.clickable eq 1}
						 	<li><a href="#" onclick="changeRequestStage({$tbl_table_status_linkitem.tbl_sts_lnk_table_id},'{$tbl_table_status_linkitem.tbl_sts_lnk_cust_id}',{$val.id},{if $tbl_table_status_linkitem.tbl_sts_lnk_emp_id gt 0}{$tbl_table_status_linkitem.tbl_sts_lnk_emp_id}{else}{if $smarty.session.guid gt 0}{$smarty.session.guid}{else}0{/if}0{/if},{$tbl_table_status_linkitem.tbl_sts_lnk_id},{$tbl_table_status_linkitem.tbl_sts_lnk_status_id});">{$val.title}</a></li>  
							{else}
						 <!--<li class="ui-disabled"><a href="#">{$val.title}</a></li>--> 
					{/if}
								{if $val.is_optional eq 0}
									{assign var=first_index value=1}
								{/if}
						 	 
						{else}
						 <!--<li class="ui-disabled"><a href="#" >{$val.title}</a></li>--> 
						 {/if} 
					{/if}
			{/foreach}
			 
        </ul>
		</div>
<div data-role="popup" id="popupReverseMenu{$tbl_table_status_linkitem.tbl_sts_lnk_table_id}"  data-theme="d" >
		<ul data-role="listview" data-inset="true" style="min-width:210px;">
            <li data-role="divider" data-theme="a">Change Status</li> 
			{assign var=first_index value=0}
			 {foreach from=$reverse_lst_table_status item=val key=kyval name=status}
			 	{if $kyval < $curr_sts_key}
				 {if $first_index neq 1} 
				 {if $val.clickable eq 1}
				 	<li><a href="#" onclick="changeRequestStage({$tbl_table_status_linkitem.tbl_sts_lnk_table_id},'{$tbl_table_status_linkitem.tbl_sts_lnk_cust_id}',{$val.id},{if $tbl_table_status_linkitem.tbl_sts_lnk_emp_id gt 0}{$tbl_table_status_linkitem.tbl_sts_lnk_emp_id}{else}{if $smarty.session.guid gt 0}{$smarty.session.guid}{else}0{/if}0{/if},{$tbl_table_status_linkitem.tbl_sts_lnk_id},{$tbl_table_status_linkitem.tbl_sts_lnk_status_id});">{$val.title}</a></li> 
					{else}
						 <!--<li class="ui-disabled"><a href="#">{$val.title}</a></li>--> 
					{/if}
					{if $val.is_optional eq 0}
						{assign var=first_index value=1}
					{/if}
				 {else}
				 	 <!--<li class="ui-disabled"><a href="#">{$val.title}</a></li> -->
				 {/if}  
				{/if}
			 {/foreach} 
        </ul>
</div>
