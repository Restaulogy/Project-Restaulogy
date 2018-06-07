{include file="header.tpl"}

<div class="wrapper">

{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER || $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN || $Global_member.member_role_id eq $smarty.const.ROLE_OWNER}
     {if $smarty.request.table_status gt 0}
     	{assign var=tmp_sess_id value=$smarty.request.order_session_id}
    	{assign var="tmp_table_number" value=$table_info.table_number}
    	{assign var="tmp_tbl_id" value=$smarty.request.table_id}
    	{assign var="tb_sts_lnk_tab" value='request'}

        {assign var="url_tbl_param" value= "?table_status=1&table_id={$smarty.request.table_id}"}
        <h1>"{$tmp_table_number}"-{$_lang.tbl_services_requests.title}</h1>
    	{*include file="tbl_table_status_link/curr_tables_tabs.tpl"*}
    	{include file="tbl_table_status_link/navbar.tpl"}
    {/if}
    {include file="tbl_services_requests/request_basic_tabs.tpl"}
{else}
    <h1>{$_lang.tbl_services_requests.title}</h1>
    {include file="customer_nav.tpl"}
{/if}
{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmupdatetbl_services_requests" id="frmupdatetbl_services_requests" onsubmit="return validatetbl_services_requests();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">
	<label for="srvc_reqst_id">{$_lang.tbl_services_requests.label.srvc_reqst_id}</label>
	<input type="text" name="srvc_reqst_id" id="srvc_reqst_id" value="{$tbl_services_requestsinfo.srvc_reqst_id}"/>
	<div class="error" id="srvc_reqst_id_err"></div>

	<label for="srvc_reqst_created_by">{$_lang.tbl_services_requests.label.srvc_reqst_created_by}</label>
	<input type="text" name="srvc_reqst_created_by" id="srvc_reqst_created_by" value="{$tbl_services_requestsinfo.srvc_reqst_created_by}"/>
	<div class="error" id="srvc_reqst_created_by_err"></div>

	<label for="srvc_reqst_srvc_id">{$_lang.tbl_services_requests.label.srvc_reqst_srvc_id}</label>
	<input type="text" name="srvc_reqst_srvc_id" id="srvc_reqst_srvc_id" value="{$tbl_services_requestsinfo.srvc_reqst_srvc_id}"/>
	<div class="error" id="srvc_reqst_srvc_id_err"></div>

	<label for="srvc_reqst_table_id">{$_lang.tbl_services_requests.label.srvc_reqst_table_id}</label>
	<input type="text" name="srvc_reqst_table_id" id="srvc_reqst_table_id" value="{$tbl_services_requestsinfo.srvc_reqst_table_id}"/>
	<div class="error" id="srvc_reqst_table_id_err"></div>

	<label for="srvc_reqst_emp_id">{$_lang.tbl_services_requests.label.srvc_reqst_emp_id}</label>
	<input type="text" name="srvc_reqst_emp_id" id="srvc_reqst_emp_id" value="{$tbl_services_requestsinfo.srvc_reqst_emp_id}"/>
	<div class="error" id="srvc_reqst_emp_id_err"></div>

	<label for="srvc_reqst_tbl_sft_assoc_id">{$_lang.tbl_services_requests.label.srvc_reqst_tbl_sft_assoc_id}</label>
	<input type="text" name="srvc_reqst_tbl_sft_assoc_id" id="srvc_reqst_tbl_sft_assoc_id" value="{$tbl_services_requestsinfo.srvc_reqst_tbl_sft_assoc_id}"/>
	<div class="error" id="srvc_reqst_tbl_sft_assoc_id_err"></div>

	<label for="srvc_reqst_cat_id">{$_lang.tbl_services_requests.label.srvc_reqst_cat_id}</label>
	<input type="text" name="srvc_reqst_cat_id" id="srvc_reqst_cat_id" value="{$tbl_services_requestsinfo.srvc_reqst_cat_id}"/>
	<div class="error" id="srvc_reqst_cat_id_err"></div>

	<label for="srvc_reqst_status">{$_lang.tbl_services_requests.label.srvc_reqst_status}</label>
	<input type="text" name="srvc_reqst_status" id="srvc_reqst_status" value="{$tbl_services_requestsinfo.srvc_reqst_status}"/>
	<div class="error" id="srvc_reqst_status_err"></div>

	<label for="srvc_reqst_created_on">{$_lang.tbl_services_requests.label.srvc_reqst_created_on}</label>
	<input type="text" name="srvc_reqst_created_on" id="srvc_reqst_created_on" value="{$tbl_services_requestsinfo.srvc_reqst_created_on}"/>
	<div class="error" id="srvc_reqst_created_on_err"></div>

	<label for="srvc_reqst_attended_on">{$_lang.tbl_services_requests.label.srvc_reqst_attended_on}</label>
	<input type="text" name="srvc_reqst_attended_on" id="srvc_reqst_attended_on" value="{$tbl_services_requestsinfo.srvc_reqst_attended_on}"/>
	<div class="error" id="srvc_reqst_attended_on_err"></div>

	<label for="srvc_reqst_completed_at">{$_lang.tbl_services_requests.label.srvc_reqst_completed_at}</label>
	<input type="text" name="srvc_reqst_completed_at" id="srvc_reqst_completed_at" value="{$tbl_services_requestsinfo.srvc_reqst_completed_at}"/>
	<div class="error" id="srvc_reqst_completed_at_err"></div>

	<input type="hidden" name="action" value="update"/>
    <input class="fleft" type="submit" value="{$_lang.save_lbl}"/>
    
		 
    <input class="fright" type="reset" onclick="$('#tbl_services_requests_view').show();$('#frmupdatetbl_services_requests').hide();" value="{$_lang.cancel_lbl}"/>

    
</form>

<div id="tbl_services_requests_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">

	<table class="listTable">
		<tr><th class="fieldItem" colspan="2"><center>{$tbl_services_requestsinfo.service.name|upper}<small>{$_lang.by_label}: <strong>{$tbl_services_requestsinfo.srvc_reqst_created_by}</strong></small></center></th></tr>
		<!--<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_id}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_id}</td></tr>-->
		<!--<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_created_by}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_created_by}</td></tr>-->
		<!--<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_srvc_id}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.service.name}</td></tr>-->
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_table_id}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.table.table_number}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_emp_id}<i>:</i></td><td class="valueItem">{if $tbl_services_requestsinfo.employee.full_name}{$tbl_services_requestsinfo.employee.full_name}{else}--{/if}</td></tr>
		
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_option}<i>:</i></td><td class="valueItem">{if $tbl_services_requestsinfo.srvc_dtl_opt}{$tbl_services_requestsinfo.srvc_dtl_opt}{else}--{/if}</td></tr>
		
		<!--<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_tbl_sft_assoc_id}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_tbl_sft_assoc_id}</td></tr>-->
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_special_note}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_special_note}</td></tr>
		<!--<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_add_quests}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_add_quests}</td></tr>-->
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_status}<i>:</i></td><td class="valueItem" style="background:{$tbl_services_requestsinfo.current_status_color}"><img src="{$tbl_services_requestsinfo.current_status_icon}" width="12"/> {if $tbl_services_requestsinfo.current_status eq $smarty.const.SERVICE_STATUS_COMPLETD}
		{$_lang.services_requests.service_complete_msg}
	{elseif $tbl_services_requestsinfo.current_status eq $smarty.const.SERVICE_STATUS_CANCELLED}	
		{$_lang.services_requests.service_cancelled_msg}
	{else}{$tbl_services_requestsinfo.last_stage.title}
	{/if}
		 {include file="tbl_services_requests/view_new_statuspicker.tpl"}
		</td></tr>
		{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER  || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER || $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN || $Global_member.member_role_id eq $smarty.const.ROLE_OWNER}
		<tr>
			<td class="fieldItem">{$_lang.tbl_services_requests.label.expted_time}</td>
			<td class="valueItem">{$tbl_services_requestsinfo.expted_time_min}</td>
		</tr>
		<tr>
			<td class="fieldItem">{$_lang.tbl_services_requests.label.actual_time}</td>
			<td class="valueItem">{$tbl_services_requestsinfo.actual_time_min}</td>
		</tr>
		<tr>
			<td class="fieldItem">{$_lang.tbl_services_requests.label.diff_time}</td>
			<td class="valueItem"> {$tbl_services_requestsinfo.diff_time_min}
			</td>
		</tr>
		{/if}
		
		
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_created_on}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_created_on|date_format:$smarty.const.HTML5_DATETIME_FORMAT}</td></tr>
		<!--
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_status}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_status}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_created_on}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_created_on}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_attended_on}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_attended_on}</td></tr>
		<tr><td class="fieldItem">{$_lang.tbl_services_requests.label.srvc_reqst_completed_at}<i>:</i></td><td class="valueItem">{$tbl_services_requestsinfo.srvc_reqst_completed_at}</td></tr> -->
	</table>
 	 <!--
	<input class="fleft" type="button" value="{$_lang.tbl_services_requests.UPDATE.BTN_LBL}" onclick="$('#tbl_services_requests_view').hide();$('#frmupdatetbl_services_requests').show();"/>
	-->
	<!--<input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$back_url}'"/>-->
	{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER || $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN || $Global_member.member_role_id eq $smarty.const.ROLE_OWNER}
	{if $tbl_services_requestsinfo.request_stages}
	<table class="biz_data_grid">
		<tr>
			<th>Stage</th>
			<th>Expected Time</th>
			<th>Actual Time</th>
			<th>Diff.</th>
		</tr>
		{foreach from=$tbl_services_requestsinfo.request_stages|@array_reverse item=reqst_stage}
			<tr class="{cycle values="odd,even"}">
					<td class="no_hover">{$reqst_stage.service_name}</td>
					<td class="no_hover">{$reqst_stage.expected_time_min}</td>
					<td class="no_hover">{$reqst_stage.actual_time_min}</td>
					<td class="no_hover">{$reqst_stage.diff_time_min}</td>
			</tr>
		{/foreach}
		
	</table>
	{/if}
 {/if}
	<center>
	
	<input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="recycle-full" onclick="canceltbl_services_requests({$tbl_services_requestsinfo.srvc_reqst_id});"/>
	<input type="button" value="{$_lang.close_lbl}" data-inline="true" data-icon="delete" onclick="self.close();"/>
	{if $notify_id >0}
        <input data-role="button" data-icon="delete" data-inline="true" type="button" value="{$_lang.tbl_alerts.DELETE.BTN_NOTIFY_LBL}" onclick="window.location.href='{$website}/user/tbl_alerts.php?action={$smarty.const.ACTION_DELETE}&alert_id={$notify_id}';"/>
    {/if}
	</center>
</div>



{include file="change_request_status.tpl"} 
{include file="tbl_services_requests/js.tpl"}

</div>

{include file="footer.tpl"}

