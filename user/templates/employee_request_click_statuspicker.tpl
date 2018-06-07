{assign var="sts_picker_r_onclick" value=""}	 
{if $request.remain_stages}
	{foreach name="stages" from=$request.remain_stages item=stage}
		{if $smarty.foreach.stages.index eq 0}
			{if $stage.clickable eq 1} 
					{assign var="sts_picker_r_onclick" value="changeRequestStage('{$request.id}',{$stage.id},0);"} 
			{else}
					{** Do Nothing **}
			{/if} 
		{else}
			 {** Do Nothing **}
		{/if}
	{/foreach}
{else}
	 	{** Do Nothing **}
{/if}
	 
{assign var="sts_picker_l_onclick" value=""}	 
{if $request.used_stages}
	{foreach name="stages" from=$request.used_stages item=stage}
		{if $smarty.foreach.stages.index eq 0}
			{if $stage.clickable eq 1}
					{assign var="sts_picker_l_onclick" value="changeRequestStage('{$request.id}',{$request.last_stage.id},{$stage.id});"} 
			{else}
				{** Do Nothing **}
			{/if}
		{else}
			{** Do Nothing **}
		{/if}
	{/foreach}
{else}
	{** Do Nothing **}
{/if}
        
{***for status pikcer START***}
{assign var=sts_picker_stage_id value=$request.id} 
{assign var=sts_picker_stage value=$request.last_stage.title}
{include file="control/click_statuspicker.tpl"} 
{***for status pikcer END***}