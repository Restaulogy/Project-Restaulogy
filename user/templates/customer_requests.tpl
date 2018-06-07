{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.services_requests.customer_request.title}</h1>
{include file="customer_nav.tpl"}
   	{if $error_msg neq ""}
		{$error_msg}
		<br>
	{/if}
	<!--
	{if $dininginfo}
		<p>
		<h4>{$dininginfo.number}</h4>
		<small>{$dininginfo.description}</small>
		<br><br>
		</p>
	{/if}
	 
	-->		
	
	{if $requestcount gt 0}
	<!--
		<table class="listTable">
			<tr> 
				<th>Request</th>
				 
			</tr>
			
		{foreach from=$requestinfo item=request}
		 {if $request.id}
		 	<tr> 
			{if $request.current_status eq $smarty.const.SERVICE_STATUS_COMPLETD}
				<td style='background-color:{$smarty.const.CLR_WHITE};'>
			{else}
				<td style='background-color:{$request.current_status_color};'>
			{/if}
			
			<a href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}">{$request.service.name}</a><small>{$request.service.description} <br>{if $request.emp_id gt 0}served by <b>{$request.employee.full_name}</b>{/if}</small>
			<div class='fleft friendly_time'>{$request.friendly_created_on}</div>
			<div class='fright status_box'>
			&raquo;

			{if $request.current_status eq $smarty.const.SERVICE_STATUS_COMPLETD}
			
				{$_lang.services_requests.service_complete_msg}
			{else}
			  {$request.remain_stages[0].srvc_stg_name} 
			{/if}
			</div> 
				</td>
			</tr>
		 {/if}
			
		{/foreach} 
		</table>
		-->
		 
		<table class="biz_data_grid">
			<tr> 
				<th style="width:13px;" class="{if $smarty.get.sort_on eq 'srvc_reqst_status'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$pageurl}&sort_on=srvc_reqst_status&sort_by={$new_sort}">#</a></th>
				<th style="width:40px;" class="{if $smarty.get.sort_on eq 'srvc_reqst_table_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$pageurl}&sort_on=srvc_reqst_table_id&sort_by={$new_sort}">Table</a></th>
				 <th style="width:130px;" class="{if $smarty.get.sort_on eq 'srvc_reqst_srvc_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$pageurl}&sort_on=srvc_reqst_srvc_id&sort_by={$new_sort}">Service Request</a></th>
				 <!--<th style="width:80px;" class="{if $smarty.get.sort_on eq 'srvc_reqst_emp_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$pageurl}&sort_on=srvc_reqst_emp_id&sort_by={$new_sort}">Server</a></th>-->
				<th style="width:80px;">Status</th> 
				 <th style="width:50px;" class="{if $smarty.get.sort_on eq 'srvc_reqst_created_on'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$pageurl}&sort_on=srvc_reqst_created_on&sort_by={$new_sort}">Posted</a></th>
				  
				   
			</tr>
		<tbody>	
		{foreach from=$requestinfo item=request}
		 {if $request.id}
			 
			<tr class="{cycle values="odd,even"}" onclick='window.location.href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}";'>
				<td>
				   	<img src="{$request.current_status_icon}" height="12"/>
				  <!--  {if $request.current_status eq $smarty.const.SERVICE_STATUS_COMPLETD}
				   		{$_lang.services_requests.service_complete_msg}
					{else}
			  			{$request.remain_stages[0].srvc_stg_name} 
					{/if}-->
				</td>
				 <td>{$dininginfo.table_number}</td>
				 <td>{$request.service.name|truncate:20}</td>
				  <!--<td>{if $request.emp_id gt 0}{$request.employee.full_name}{else}--{/if}</td>-->
				   <td>{$request.last_stage.title}</td>
					<td>
						{$request.friendly_created_on|replace:" ago":""}
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
						<select onclick="changePage('{$pageurl}',this.value,{$smarty.request.limit});">
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
		 
		<br/>
	{else}
		<div class="error">{$_lang.services_requests.customer_request.no_record_msg}</div>
	{/if}
	<div class="field-row clearfix">
<center>
 <input type="button" onclick="window.location.href='{$website}/user/services_request.php?table_id={$table_id}'" value="{$_lang.services_requests.customer_request.request_btn}" data-icon="add-item" data-inline="true"/>
 <input type="button" onclick="window.location.href='{$website}/user/dashboard.php?table_id={$table_id}'" value="{$_lang.services_requests.customer_request.back_btn}" data-icon="delete" data-inline="true"/>
</center>
</div>

{include "legend.tpl"}

</div>
 
 
{include file="footercontent.tpl"}
{literal}
<script type="text/javascript">
 function attendRequest(request_id){
 	if(is_gt_zero_num(request_id)){
		elemById("request_id").value=request_id;
		elemById("frmAttendRequest").submit();
	}else{
		alert({/literal}"{$_lang.services_requests.non_empty_msg.request}"{literal})
	}
 }
 function completeRequest(request_id){
 	if(is_gt_zero_num(request_id)){
		elemById("comp_request_id").value=request_id;
		elemById("frmCompleteRequest").submit();
	}else{
		alert({/literal}"{$_lang.services_requests.non_empty_msg.request}"{literal})
	}
 }
 function changeRequestStage(request_id,stage_id){
 	if(is_gt_zero_num(request_id)){
		elemById("stage_request_id").value=request_id;
		elemById("stage_id").value=stage_id;
		alert(elemById("stage_request_id").value + " = " + elemById("stage_id").value);
		elemById("frmChangeRequestStage").submit();
	}else{
		alert({/literal}"{$_lang.services_requests.non_empty_msg.request}"{literal})
	}
 }
{/literal}
{if $ask_cust_name eq 1}
	 {literal} $(function(){ askCustName(); });{/literal}
{/if}
{literal} 
</script>
{/literal} 
</body></html>
