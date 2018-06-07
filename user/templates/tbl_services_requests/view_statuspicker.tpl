{if ($tbl_services_requestsinfo.is_live) && ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER)}
		{if $tbl_services_requestsinfo.current_status neq $smarty.const.SERVICE_STATUS_CANCELLED}
		{***for status pikcer START***}
  {assign var=sts_picker_stage_id value=$tbl_services_requestsinfo.id}
	{assign var=sts_picker_l_extra value='style="height:26px !important;"'}
	{assign var=sts_picker_r_extra value='style="height:26px !important;"'}
	{assign var=sts_picker_text_extra value='style="color:#fff !important;"'}
	{assign var=sts_picker_stage value=$tbl_services_requestsinfo.last_stage.title}
	{include file="control/statuspicker.tpl"}
{***for status pikcer END***}

		{/if}
 <div data-role="popup" id="popupMenu{$tbl_services_requestsinfo.id}" data-theme="a">
        <ul data-role="listview" data-inset="true" style="min-width:210px;" >
            <li data-role="divider" data-theme="a">Change Status</li>
			{if $tbl_services_requestsinfo.remain_stages}
			{foreach name="stages" from=$tbl_services_requestsinfo.remain_stages item=stage}
					 {if $smarty.foreach.stages.index eq 0}

							 {if $stage.clickable eq 1}
											<li><a href="#" style="color:#fff !important;" onclick="changeRequestStage('{$tbl_services_requestsinfo.id}',{$stage.id});">{$stage.title}</a></li>
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
<div data-role="popup" id="popupReverseMenu{$tbl_services_requestsinfo.id}" data-theme="a">
		<ul data-role="listview" data-inset="true" style="min-width:210px;" >
            <li data-role="divider" data-theme="a">Change Status</li>
			{if $tbl_services_requestsinfo.used_stages}
			{foreach name="stages" from=$tbl_services_requestsinfo.used_stages item=stage}
					 {if $smarty.foreach.stages.index eq 0}
					 {if $stage.clickable eq 1}
									<li><a href="#" style="color:#fff !important;" onclick="changeRequestStage('{$tbl_services_requestsinfo.id}',{$tbl_services_requestsinfo.last_stage.id});">{$stage.title}</a></li>
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
		{/if}
