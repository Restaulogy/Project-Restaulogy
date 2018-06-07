{if ($tbl_services_requestsinfo.is_live) && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER  || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER)}
{assign var="sts_picker_r_onclick" value=""}	
{if $tbl_services_requestsinfo.remain_stages}
{foreach name="stages" from=$tbl_services_requestsinfo.remain_stages item=stage}
 {if $smarty.foreach.stages.index eq 0} 
	 {if $stage.clickable eq 1} 
			{assign var="sts_picker_r_onclick" value="changeRequestStage('{$tbl_services_requestsinfo.id}',{$stage.id});"}	
	 {else}
			{** Do nothing **}
	 {/if} 
 {else}
 		{** Do nothing **}
 {/if}
{/foreach}
{else}
	{** Do nothing **}
{/if}
			

{assign var="sts_picker_l_onclick" value=""}				 
{if $tbl_services_requestsinfo.used_stages}
{foreach name="stages" from=$tbl_services_requestsinfo.used_stages item=stage}
	{if $smarty.foreach.stages.index eq 0}
	 	{if $stage.clickable eq 1}
			{assign var="sts_picker_l_onclick" value="changeRequestStage('{$tbl_services_requestsinfo.id}',{$tbl_services_requestsinfo.last_stage.id});"}
		{else}
			{** Do nothing **}
		{/if}
	{else}
			{** Do nothing **}
	{/if}
{/foreach}
{else}
	{** Do nothing **}
{/if}
         

{if $tbl_services_requestsinfo.current_status neq $smarty.const.SERVICE_STATUS_CANCELLED}
		{***for status pikcer START***}
  {assign var=sts_picker_stage_id value=$tbl_services_requestsinfo.id}
	{assign var=sts_picker_l_extra value='style="height:26px !important;"'}
	{assign var=sts_picker_r_extra value='style="height:26px !important;"'}
	{assign var=sts_picker_text_extra value='style="color:#fff !important;"'}
	{assign var=sts_picker_stage value=$tbl_services_requestsinfo.last_stage.title}
	{include file="control/click_statuspicker.tpl"}
{***for status pikcer END***}
{/if}

{/if}
