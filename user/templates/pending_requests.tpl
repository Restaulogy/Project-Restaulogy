{include file="header.tpl"}
<meta http-equiv="refresh" content="15"/>
<div class="wrapper">
<h1>{$_lang.services_requests.pending_request.title}</h1>
 
	{if $error_msg neq ""}
		{$error_msg}<br>
	{/if}
	
	{if $requestcount gt 0}
	<!--
		<table class="listTable">
			<tr> 
				<th>Request</th> 
			</tr>
		{foreach from=$requestinfo item=request}
		 {if $request.id}
		 	<tr>  
			<td style='background-color:{$request.current_status_color};'>
			<b>{$request.table.number}</b>&nbsp;:&nbsp;<a href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}">{$request.service.name}</a><small>{$request.service.description}<br>By <b>{$request.created_by}</b></small> 
			<div class='fleft friendly_time'>{$request.friendly_created_on}</div>
			  
			 
			 {if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER}
			 <div class='fright status_box'>
			&raquo;
			{if $request.current_status eq $smarty.const.SERVICE_STATUS_COMPLETD}
			
				{$_lang.services_requests.service_complete_msg}
			{else}
			  {$request.remain_stages[0].srvc_stg_name} 
			{/if}
			</div>
			 	
			 {else} 
					<select onchange="changeRequestStage('{$request.id}',this.value);">
					<option value="">Change Status</option>
					{foreach name="stages" from=$request.remain_stages item=stage}
					 {if $smarty.foreach.stages.index eq 0}
					 	<option value="{$stage.srvc_stg_id}">{$stage.srvc_stg_name}</option>	
					 {else}
					 	<option value="{$stage.srvc_stg_id}" disabled="disabled">{$stage.srvc_stg_name}</option>
					 {/if}
						
					{/foreach}
				</select>
				{/if}
			
				</td>
			</tr>
		 {/if}
			
		{/foreach}
		
	 	
		</table>
		{if $pagination neq ""}{$pagination}{/if}
	-->
	
 	<table class="biz_data_grid">
			<tr> 
				<th style="width:10px;" class="{if $smarty.get.sort_on eq 'srvc_reqst_status'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=srvc_reqst_status&sort_by={$new_sort}">#</a></th>
				<th style="width:10%;" class="{if $smarty.get.sort_on eq 'srvc_reqst_table_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=srvc_reqst_table_id&sort_by={$new_sort}">Table</a></th>
				 <th style="width:35%;" class="{if $smarty.get.sort_on eq 'srvc_reqst_srvc_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=srvc_reqst_srvc_id&sort_by={$new_sort}">Service Request</a></th>
				 <th style="width:10%;" class="{if $smarty.get.sort_on eq 'srvc_reqst_created_on'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}?sort_on=srvc_reqst_created_on&sort_by={$new_sort}">Posted</a></th> 
				 <th style="width:45%;" class="{if $smarty.get.sort_on eq 'srvc_reqst_emp_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="#">Update Status</a></th>
				  
				   
			</tr>
		<tbody>	
		{foreach from=$requestinfo key=request_id item=request}
		 {if $request_id}
			 
			<tr class="{cycle values="odd,even"}">
				<td>
				   	<img src="{$request.current_status_icon}" height="12"/>
				  <!--  {if $request.current_status eq $smarty.const.SERVICE_STATUS_COMPLETD}
				   		{$_lang.services_requests.service_complete_msg}
					{else}
			  			{$request.remain_stages[0].srvc_stg_name} 
					{/if}-->
				</td>
				<td  onclick='window.open("{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}");'>{$request.table.number}</td>
				<td onclick='window.open("{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}");'>{$request.service.name|truncate:20}</td> 
				<td  onclick='window.open("{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}");'>{$request.friendly_created_on|replace:" ago":""}</td>
				<td> 

{***for status pikcer START***} 			 
  {assign var=sts_picker_stage_id value=$request.id} 
	{assign var=sts_picker_stage value=$request.last_stage.title} 
	{include file="control/statuspicker.tpl"} 
{***for status pikcer END***} 	
			  
 <div data-role="popup" id="popupMenu{$request_id}" data-theme="a"> 
        
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
<div data-role="popup" id="popupReverseMenu{$request_id}" data-theme="a"> 
		<ul data-role="listview" data-inset="true" style="min-width:210px;" >
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
				<!--<select data-mini="true" onchange="changeRequestStage('{$request.id}',this.value);">
					<option value="">Change Status</option>
					{foreach name="stages" from=$request.remain_stages item=stage}
					 {if $smarty.foreach.stages.index eq 0}
					 	<option value="{$stage.srvc_stg_id}">{$stage.srvc_stg_name}</option>	
					 {else}
					 	<option value="{$stage.srvc_stg_id}" disabled="disabled">{$stage.srvc_stg_name}</option>
					 {/if}
					{/foreach}
				</select>-->
				</td>
			 </tr>
		 {/if}
		{/foreach} 
		</tbody>
			<tfoot>
				<tr>
					<td colspan="4"># {$requestcount}&nbsp;&nbsp;&nbsp; 
					 
						{if $pagination neq ""}{$pagination}{/if}
					</td>
					<td>
						<select onclick="changePage('{$page_url}',this.value,{$smarty.request.limit});">
						{if $allPageCount gt 1}
						{for $foo=1 to $allPageCount}
						    <option value="{$foo}" {if $foo eq $currentPage}selected="selected"{/if}>{$foo}</option>
						{/for}
						{else}
						 	<option value="{$foo}" disabled="disabled">1</option> 
						{/if}
						</select> 
					</td>
				</tr>
			</tfoot>	 
		</table>
		
	{else}
		<div class="error">{$_lang.services_requests.pending_request.no_record_msg}</div>
	{/if}
</div>
{include file="change_request_status.tpl"} 
{include file="footer.tpl"} 