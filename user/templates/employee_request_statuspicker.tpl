{***for status pikcer START***} 	
			 
		  {assign var=sts_picker_stage_id value=$request.id} 
			{assign var=sts_picker_stage value=$request.last_stage.title} 
			{include file="control/statuspicker.tpl"} 
		{***for status pikcer END***} 	
<div data-role="popup" id="popupMenu{$request.id}"  data-theme="d" >
	<ul data-role="listview" data-inset="true" style="min-width:210px;"> 
            <li data-role="divider" data-theme="a">Change Status</li> 
			{if $request.remain_stages}
			{foreach name="stages" from=$request.remain_stages item=stage}
					 {if $smarty.foreach.stages.index eq 0}
					  {if $stage.clickable eq 1}
					 	<li><a href="#" style="color:#fff !important;" onclick="changeRequestStage('{$request.id}',{$stage.id});">{$stage.title}</a></li>	
					 {else}
							<li class="ui-disabled"><a href="#">{$stage.title}</a></li>
						{/if}
					 	
					 {else}
					 		<li class="ui-disabled"><a href="#">{$stage.title}</a></li>
					 {/if}
			{/foreach}
			{else}
				<li>No Stage to select</li>
			{/if}
			
        </ul>
		</div>
<div data-role="popup" id="popupReverseMenu{$request.id}" data-theme="d">
	<ul data-role="listview" data-inset="true" style="min-width:210px;"> 
            <li data-role="divider" data-theme="a">Change Status</li> 
			{if $request.used_stages}
			{foreach name="stages" from=$request.used_stages item=stage}
					 {if $smarty.foreach.stages.index eq 0}
					  {if $stage.clickable eq 1}
									<li><a href="#" style="color:#fff !important;" onclick="changeRequestStage('{$request.id}',{$request.last_stage.id});">{$stage.title}</a></li>
						{else}
							<li class="ui-disabled"><a href="#">{$stage.title}</a></li>
						{/if}
					 	
					 {else}
					 		<li class="ui-disabled"><a href="#">{$stage.title}</a></li>
					 {/if}
					{/foreach}
			{else}
				<li>No Stage to select</li>
			{/if}
        </ul>
</div>
