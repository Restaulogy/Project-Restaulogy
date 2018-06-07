{include file="header.tpl"}

<div class="wrapper">
<h1>
{if $smarty.request.table_status gt 0 && $table_info.table_number neq ""}
 	"{$table_info.table_number}" - {$_lang.services_requests.employee_request.title} 
{else if $flt_cust neq ""}
	 "{$flt_cust}" - {$_lang.services_requests.employee_request.title} 
{else}
	{$_lang.services_requests.employee_request.title}
{/if}

{if $Global_member.rl_fn_request_live neq 1 && $Global_member.rl_fn_request_expired eq 1}
		<a href="#"  onclick="$('#popupSearch').toggle();" onclick="$('#popupSearch').toggle();" data-role="button" data-inline="true" data-iconpos="notext" data-icon="search" data-theme="b" style="float:right;">Search</a>
{/if}
</h1>

{if $smarty.request.table_id > 0 && $smarty.request.sess_id > 0 && $smarty.request.table_status > 0 }
	{include file="tbl_table_status_link/curr_tables_tabs.tpl"}
{/if}

{if $search_text neq ''}
	<div style="width:99%;padding:5px;border-bottom:1px dotted #ccc;font-style: italic;"><span class="info">Search results &laquo; </span><span class="notice">{$search_text}</span><span class="info">&raquo;</span></div><br>
{/if}

{if $error_msg neq ""}
	{$error_msg}
	<br>
{/if}

{if $smarty.request.table_status gt 0}
		{assign var="tmp_sess_id" value=$smarty.request.sess_id}
		{assign var="tmp_table_number" value=$tbl_details.number}
		{assign var="tmp_tbl_id" value=$smarty.request.table_id}
		{include file="tbl_table_status_link/navbar.tpl"}
{else if $flt_cust neq ""}
	{include file="filter_customer_navbar.tpl"}
{/if}

{include file="tbl_services_requests/request_basic_tabs.tpl"}
	 
{if $Global_member.rl_fn_request_live eq 1 && $Global_member.rl_fn_request_expired}	
	<div class="navTable navTable_border">
	{if $service_staus neq 1}
			<a href="#"  onclick="$('#popupSearch').toggle();"  onclick="$('#popupSearch').toggle();" data-role="button" data-inline="true" data-iconpos="notext" data-icon="search"  data-theme="b" style="float:right;">Search</a>
	{/if}
	<table class="navTable" style="width:250px;display:inline;">
		<tr>  
			{if $Global_member.rl_fn_request_live eq 1}
			<th>{if $service_staus eq 1}<b>Live Requests</b>{else}<a href='{$website}/user/employee_requests.php?service_staus=1&table_status={$smarty.request.table_status}&sess_id={$smarty.request.sess_id}&table_id={$smarty.request.table_id}'>Live Requests</a>{/if}</th>
			{/if}
			{if $Global_member.rl_fn_request_expired eq 1}
			<th>{if $service_staus neq 1}<b>Completed Requests</b>{else}<a href='{$website}/user/employee_requests.php?sess_id={$smarty.request.sess_id}&service_staus=0&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}'>Completed Requests</a>{/if}</th>
			{/if}
		</tr>		
	</table>
	</div>
{/if}   

<div id="popupSearch" class="white_border" style="display:none;">
	<h1 class="panel_bg">Search</h1>
	<form id="frmSearchEmpRequests" name="frmSearchEmpRequests" action="{$website}/user/employee_requests.php" method="POST" style="padding:0px 5px;" onsubmit="return comparedate();">
	    <table class="full_width">
		<tr>
			<td colspan="3" >				
			<input type='text' placeholder="Keyword" id='keyword' name='keyword' value='{if $keyword}{$keyword}{elseif $smarty.post.keyword}{$smarty.post.keyword}{/if}'/> 
			</td>
		</tr> 
		<tr>
			<td style="width:48%;"><input type="text" id='start_date' placeholder="Start Date" name='start_date' value='{if $start_date}{$start_date}{elseif $smarty.post.start_date}{$smarty.post.start_date}{/if}'/></td>
			<td style="width:4%;">&nbsp;</td>
			<td style="width:48%;"><input type='text'  placeholder="End Date"  id='end_date' name='end_date' value='{if $end_date}{$end_date}{elseif $smarty.post.end_date}{$smarty.post.end_date}{/if}'/></td> 
		</tr>
		<tr>
			<td class="error" id="start_date_err"></td>
			<td></td>
			<td class="error" id="end_date_err"></td>
		</tr>
   		</table> 
	   
		<select name='pst_table_id' id='pst_table_id'>
			<option value=''>Select Table</option>
		{foreach from=$diningtables key=dining_id item=dining}
			<option value='{$dining_id}' {if $pst_table_id eq $dining_id || $smarty.post.pst_table_id eq $dining_id}selected="selected"{/if}>{$dining}</option>
		{/foreach} 
		</select>   
	    
 		<select name='emp_id' id='emp_id'> 
			<option value=''>Select Employee</option>
		{foreach from=$employees key=employee_id item=employee}
			<option value='{$employee_id}' {if $employee_id eq $emp_id || $smarty.post.emp_id eq $employee_id}selected="selected"{/if}>{$employee}</option>
		{/foreach} 
		</select>  
		 
	   
	   <div class="clearfix line_break"></div> 
	<!-- <input type="hidden" name="report" value="{$report}"/>-->
	 <input type="hidden" name="service_staus" value="{$service_staus}"/>
	  <input type="hidden" name="table_status" value="{$smarty.request.table_status}"/>
	 <center> 
	 <input data-role="button"data-inline="true" data-icon="search" data-iconpos="left"  value='Search' type='submit' class='fleft'/> <input type='button' data-role="button" data-inline="true" data-icon="delete" data-iconpos="left" value='Cancel'  onclick="resetForm();"/>  
	  
	 </center>
	</form>
	</div>   
	
	
    <div class="clearfix line_break"></div>
	
	
	{if $requestcount gt 0}
		<!--<table class="listTable">
			<tr> 
				<th>Request</th> 
			</tr>
		{foreach from=$requestinfo item=request}
			{if $request.report_data}
			<tr> 
				<td class="header">{$request.report_data}</td> 
			</tr>	
			{/if} 
			<tr>
				<td style='background-color:{$request.current_status_color};'>
				<b>{$request.table.number}</b>&nbsp;:&nbsp;<a href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}" >{$request.service.name}</a><small>{$request.service.description}<br>By <b>{$request.created_by}</b>
				
				{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR }
				
				 Waiter : <b>{if $request.emp_id gt 0}{$request.employee.full_name}{else}--{/if}</b> 
				{/if}
				<br/>
				<div class="fleft friendly_time">{$request.friendly_created_on} </div>
				<div class='fright status_box'>
			&raquo;
			{if $request.current_status eq $smarty.const.SERVICE_STATUS_COMPLETD}
			
				{$_lang.services_requests.service_complete_msg}
			{else}
			  {$request.remain_stages[0].srvc_stg_name} 
			{/if}
			</div>
				 </small>
				</td>
			</tr> 
		{/foreach}
		</table>
		{if $pagination neq ""}{$pagination}{/if}-->
		
		<table class="biz_data_grid">
			<tr>
            {if $smarty.request.table_id && $smarty.request.table_id gt 0}
            {else}
                <th style="width:10%;" class="{if $smarty.get.sort_on eq 'srvc_reqst_table_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=srvc_reqst_table_id&sort_by={$new_sort}">Table</a></th>
                 <th style="width:20%;" class="{if $smarty.get.sort_on eq 'srvc_reqst_emp_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=srvc_reqst_emp_id&sort_by={$new_sort}">Server</a></th>
            {/if}
                 <th style="width:{if $service_staus neq 1}40{else}20{/if}%;" class="{if $smarty.get.sort_on eq 'srvc_reqst_srvc_id'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=srvc_reqst_srvc_id&sort_by={$new_sort}">Service Request</a></th>
                 <th style="width:{if $service_staus eq 1}40{else}20{/if}%;" class="{if $smarty.get.sort_on eq 'srvc_reqst_status'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=srvc_reqst_status&sort_by={$new_sort}">Status</a></th>
				 
				 <th style="width:10%;" class="{if $smarty.get.sort_on eq 'srvc_reqst_created_on'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$gr_clk_navigationURL}&sort_on=srvc_reqst_created_on&sort_by={$new_sort}">Posted</a></th>
				 <!--<th style="width:10%;" class="{if $smarty.get.sort_on eq 'expted_time'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=expted_time&sort_by={$new_sort}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}">Exptd. time</a></th>

                <th style="width:10%;" class="{if $smarty.get.sort_on eq 'actual_time'}active_{if $smarty.get.sort_by eq 'DESC'}desc{else}asc{/if}{/if}"><a href="{$page_url}&sort_on=actual_time&sort_by={$new_sort}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}">Act. time</a></th>-->
				   
			</tr>
		<tbody>	
		{foreach from=$requestinfo item=request}
		 {if $request.id} 
		 {cycle assign=cls values="odd,even"}
		 {if $request.srvc_reqst_session_id eq 0 && $request.srvc_reqst_status neq $smarty.const.SERVICE_STATUS_CANCELLED} {**assign var=cls value=errorrow**} {/if}
	 
			<tr class="{$cls}" >
            {if $smarty.request.table_id && $smarty.request.table_id gt 0}
            {else}
                 <td onclick='window.location.href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&request_type=employee";'>{$request.table.number}</td>
				 <td onclick='window.location.href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&request_type=employee";'>{if $request.emp_id gt 0}{$request.employee.full_name|wordwrap:5:' ':true}{else}--{/if}</td>
            {/if}

				 <td onclick='window.location.href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&request_type=employee";'>{$request.service.name|truncate:20|wordwrap:5:' ':true}
                 {if $request.isActive eq 1}
                    <span class="biz_highlight_success">new</span>
                 {/if}
                 </td>
         <td {if $service_staus neq 1}onclick='window.location.href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&request_type=employee";'{/if}>
				 <img src="{$request.current_status_icon}" height="12"/> 
						
						
				   <!--
                    {if $request.current_status eq $smarty.const.SERVICE_STATUS_COMPLETD}
				   		{$_lang.services_requests.service_complete_msg}
					{else}
			  			{$request.remain_stages[0].srvc_stg_name}
					{/if}
                   -->
					{if $curr_service_staus eq 1}
						{include file="employee_request_new_statuspicker.tpl"}
					{else}
					{$request.last_stage.title}
					{/if}
				</td>
				
				<td {if $service_staus neq 1}onclick='window.location.href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&request_type=employee";'{/if}>
					{$request.friendly_created_on|replace:" ago":""}
					{if $request.srvc_reqst_session_id eq 0 && $request.srvc_reqst_status neq $smarty.const.SERVICE_STATUS_CANCELLED} 
						<br /><a class="deleteIcon" href="#" onclick="canceltbl_services_requests({$request.srvc_reqst_id})"></a>
					{/if}					
				</td>
				
				<!--
				 onclick='location.href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&request_type=employee";'
				
				<td style="text-align:center;" onclick='location.href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&request_type=employee";'>{$request.expted_time}</td>
				<td style="text-align:center;" onclick='location.href="{$website}/user/tbl_services_requests.php?mode=view&srvc_reqst_id={$request.srvc_reqst_id}&table_status={$smarty.request.table_status}&table_id={$smarty.request.table_id}&request_type=employee";'>{$request.actual_time}</td>
                -->
                
			 </tr>
		 {/if}
		{/foreach} 
		</tbody>
			<tfoot>
				<tr>
					<td colspan="{if $smarty.request.table_id && $smarty.request.table_id gt 0}2{else}4{/if}"># {$requestcount}&nbsp;&nbsp;&nbsp;
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
		<div class="error">{$_lang.services_requests.employee_request.no_record_msg}</div>
	{/if}
	
	{include "legend.tpl"}

</div>
 
{include file="change_request_status.tpl"} 
{include file="footercontent.tpl"}
{literal}
    <script>
	
	function canceltbl_services_requests(varId){
		if(varId > 0){
			if(confirm("{/literal}{$_lang.services_requests.CANCEL.CONFIRM_MSG}{literal}")==true){ 
				window.location.href="{/literal}{$website}{literal}/user/employee_requests.php?action=CANCEL&request_id="+varId;
			}
		}
	}

	function comparedate(){
		var isErr = true;
		$(".error").html("");
	if(IsNonEmpty(elemById("start_date").value)==false && IsNonEmpty(elemById("end_date").value)==false){ 
		var isErr = true;
	}else{
		if(IsNonEmpty(elemById("start_date").value)==false){ 
			 $("#start_date_err").html("{/literal}{$_lang.messages.validation.not_empty|sprintf:'Start Date'}{literal}");
			isErr = false;  
		} 

		if(IsNonEmpty(elemById("end_date").value)==false){
			 $("#end_date_err").html("{/literal}{$_lang.messages.validation.not_empty|sprintf:'End Date'}{literal}");
			isErr = false;  
		}else{
			if(new Date(elemById("end_date").value).getTime()  < new Date(elemById("start_date").value).getTime()){
				$("#end_date_err").html("{/literal}{$_lang.messages.validation.gt_others_date|sprintf:'End Date':'Start Date'}{literal}");
				isErr = false;
			}
		}
	}	 
		if(isErr == false){
			alert("{/literal}{$_lang.messages.revise_form}{literal}");
		}
		return isErr;		
	}
	
	function resetForm(){
         $('#emp_id').val("");
         $('#pst_table_id').val("");
         $('#start_date').val("");
         $('#end_date').val("");
		 $('#keyword').val("");
         $('#frmSearchEmpRequests').submit();
    }
	
    $(function(){
    	$("#start_date").scroller({ preset: 'date',dateFormat : '{/literal}{$smarty.const.MOBISCROL_FORMAT}{literal}',  animate: 'pop'});
    	$("#end_date").scroller({ preset: 'date',dateFormat : '{/literal}{$smarty.const.MOBISCROL_FORMAT}{literal}',  animate: 'pop'});
    })
    </script>
{/literal}
</body></html>
