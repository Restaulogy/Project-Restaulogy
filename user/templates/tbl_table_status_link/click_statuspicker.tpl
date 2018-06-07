{assign var="curr_sts_val" value="0"}
{assign var="curr_sts_key" value="0"}
 
{if $tbl_sts_lnk_key[$tbl_table_status_linkitem.tbl_sts_lnk_table_id] < $sts_avail_key}
    {assign var="curr_sts_key" value="{$tbl_sts_lnk_key[$tbl_table_status_linkitem.tbl_sts_lnk_table_id]}"} 
		{assign var="curr_sts_val" value="{$tbl_table_status_linkitem.tbl_sts_lnk_status_id}"} 
{/if} 

 			

 			{assign var="sts_picker_r_onclick" value=""}			
			{assign var=first_index value=0}
		 
			{foreach from=$lst_table_status item=val key=kyval name=status} 
			  {if $kyval > $curr_sts_key} 
					 	{if $first_index neq 1}
						{if $val.clickable eq 1}
						 	{assign var="sts_picker_r_onclick" value="changeRequestStage({$tbl_table_status_linkitem.tbl_sts_lnk_table_id},'{$tbl_table_status_linkitem.tbl_sts_lnk_cust_id}',{$val.id},{if $tbl_table_status_linkitem.tbl_sts_lnk_emp_id gt 0}{$tbl_table_status_linkitem.tbl_sts_lnk_emp_id}{else}{if $smarty.session.guid gt 0}{$smarty.session.guid}{else}0{/if}0{/if},{$tbl_table_status_linkitem.tbl_sts_lnk_id},{$tbl_table_status_linkitem.tbl_sts_lnk_status_id});"}  
							{else}
								{** DO NOTHING **}
					{/if}
								{assign var=first_index value=1}
						 	 
						{else}
						 	{** DO NOTHING **}
						 {/if} 
					{/if}
			{/foreach} 
  
			{assign var="sts_picker_l_onclick" value=""}			
			{assign var=first_index value=0}
			 {foreach from=$reverse_lst_table_status item=val key=kyval name=status}
			 
			 	{if $kyval < $curr_sts_key}
				 
				 {if $first_index neq 1} 
				 {if $val.clickable eq 1}
				  	{assign var="sts_picker_l_onclick" value="changeRequestStage({$tbl_table_status_linkitem.tbl_sts_lnk_table_id},'{$tbl_table_status_linkitem.tbl_sts_lnk_cust_id}',{$val.id},{if $tbl_table_status_linkitem.tbl_sts_lnk_emp_id gt 0}{$tbl_table_status_linkitem.tbl_sts_lnk_emp_id}{else}{if $smarty.session.guid gt 0}{$smarty.session.guid}{else}0{/if}0{/if},{$tbl_table_status_linkitem.tbl_sts_lnk_id},{$tbl_table_status_linkitem.tbl_sts_lnk_status_id});"}
					{else}
					 		{** DO NOTHING **}
					{/if}
					{assign var=first_index value=1} 
				 {else}
				 	 {** DO NOTHING **}
				 {/if}  
				{/if}
			 {/foreach}   
			 
			 
{***for click status pikcer START***} 
	{assign var=sts_picker_stage_id value=$tbl_table_status_linkitem.tbl_sts_lnk_table_id} 
	{assign var=sts_picker_stage value=$tbl_table_status_linkitem.status.tbl_sts_name} 
  {include file="control/click_statuspicker.tpl"}
{***for click status pikcer END***}
