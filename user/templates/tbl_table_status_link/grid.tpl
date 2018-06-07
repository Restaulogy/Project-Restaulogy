{include file='header.tpl'}

<div class="wrapper">
<h1>
{if $tbl_details.table_number}
		 "{$tbl_details.table_number}" - Details 
{else}
	 {$_lang.tbl_table_status_link.listing_title} 
{/if}	
    <!-- 
	{if $latestOnly eq 1}
    	<center>{$_lang.tbl_table_status_link.listing_title}</center>
    {else}
        <center>{$tbl_details.table_number} <br>
        <small style="font-size:10px;">{$tbl_details.table_desciption|lower:true}</small>
        </center>
    {/if}
	-->
	{if $Global_member.rl_fn_request_live neq 1 && $Global_member.rl_fn_request_expired eq 1}
		<a href="#" style="float:right;" data-role="button" data-icon="search" data-iconpos="notext" onclick="$('#filter_tbl_status').toggle();"></a>
	{/if}

</h1>
{if $error_msg}
	<center>{$error_msg}</center>
{/if}

{include file="tbl_table_status_link/curr_tables_tabs.tpl"}

{if $Global_member.rl_fn_tablests_live eq 1 && $Global_member.rl_fn_tablests_expired eq 1 && $smarty.request.pst_table_id eq 0}
<div class="navTable navTable_border">
	{if $smarty.request.customer_session_id gt 0}{else}
	{if $latestOnly neq 1}<a href="#" style="float:right;" data-role="button" data-icon="search" data-iconpos="notext" onclick="$('#filter_tbl_status').toggle();"></a>{/if}
	{/if}
	
    <table class="navTable" style="width:250px;">
	<tr>
		{if $Global_member.rl_fn_tablests_live eq 1}
			<th>			
	            {if $latestOnly eq 1}
	                <b>{$_lang.live}</b>
	            {else}
	                <a href="{$website}/user/tbl_table_status_link.php?latestOnly=1">{$_lang.live}</a>
	            {/if}			
	        </th>
		{/if}
		{if $Global_member.rl_fn_tablests_expired eq 1}
	        <th>			
	            {if $latestOnly eq 0}
	                <b>{$_lang.expired}</b>
	            {else}
	                <a href="{$website}/user/tbl_table_status_link.php?latestOnly=0">{$_lang.expired}</a>
	            {/if}			
	        </th>
		{/if}
     </tr>
    </table>

</div> 

{/if}
 
{include file="control/search_criteria.tpl"}
{include file="tbl_table_status_link/search.tpl"}

{if $smarty.request.pst_table_id gt 0}
 {include file="tbl_table_status_link/lastRecord.tpl"}
{else}
{if $result_found gt 0 && $info}
 
	<table class="biz_data_grid">
		<tr>  
			<th class="{if $biz_sort_on eq 'tbl_sts_lnk_table_id'}active_{if $biz_sort_by eq 'DESC'}desc{else}asc{/if}{/if}" style="width:10%;"><a href="{$gr_clk_navigationURL}&sort_on=tbl_sts_lnk_table_id&sort_by={$new_sort}">{$_lang.tbl_table_status_link.label.tbl_sts_lnk_table_id}</a></th>
			<th class="{if $biz_sort_on eq 'tbl_sts_lnk_cust_id'}active_{if $biz_sort_by eq 'DESC'}desc{else}asc{/if}{/if}" style="width:10%;"><a href="{$gr_clk_navigationURL}&sort_on=tbl_sts_lnk_cust_id&sort_by={$new_sort}" style="width:10% !important;">{$_lang.tbl_table_status_link.label.tbl_sts_lnk_cust_id|wordwrap:5:' ':true}</a></th>
			<th class="{if $biz_sort_on eq 'tbl_sts_lnk_emp_id'}active_{if $biz_sort_by eq 'DESC'}desc{else}asc{/if}{/if}" style="width:10% !important;"><a href="{$gr_clk_navigationURL}&sort_on=tbl_sts_lnk_emp_id&sort_by={$new_sort}">{$_lang.tbl_table_status_link.label.tbl_sts_lnk_emp_id|wordwrap:6:' ':true}</a></th>
			<th class="{if $biz_sort_on eq 'tbl_sts_lnk_status_id'}active_{if $biz_sort_by eq 'DESC'}desc{else}asc{/if}{/if}" style="width:10% !important;"><a href="{$gr_clk_navigationURL}&sort_on=tbl_sts_lnk_status_id&sort_by={$new_sort}">{$_lang.tbl_table_status_link.label.tbl_sts_lnk_status_id}</a></th>
 {if 0}
			<th class="{if $biz_sort_on eq 'tbl_sts_lnk_start_time'}active_{if $biz_sort_by eq 'DESC'}desc{else}asc{/if}{/if}" style="width:10% !important;"><a href="{$gr_clk_navigationURL}&sort_on=tbl_sts_lnk_start_time&sort_by={$new_sort}">{$_lang.tbl_table_status_link.label.tbl_sts_lnk_start_time}</a></th>
            <th class="{if $biz_sort_on eq 'tbl_sts_lnk_end_time'}active_{if $biz_sort_by eq 'DESC'}desc{else}asc{/if}{/if}" style="width:10% !important;"><a href="{$gr_clk_navigationURL}&sort_on=tbl_sts_lnk_end_time&sort_by={$new_sort}">{$_lang.tbl_table_status_link.label.tbl_sts_lnk_end_time}</a></th>
 {/if}
            <!--
			<th class="{if $biz_sort_on eq 'tbl_sts_lnk_status_id'}active_{if $biz_sort_by eq 'DESC'}desc{else}asc{/if}{/if}" style="width:10% !important;"><a href="{$website}/user/tbl_table_status_link.php?latestOnly={$latestOnly}&todays_requests={$todays_requests}&sort_on=tbl_sts_lnk_status_id&sort_by={$new_sort}">{$_lang.tbl_table_status_link.time_cust_arrived}</a></th>
			-->
			<th style="width:10% !important;">{$_lang.tbl_table_status_link.time_cust_arrived}</th>
			 {if $latestOnly eq 1}
			   <th >
			   	<a href="#">Current Status</a>
			   </th>
                <!--
                <th >
			   	<a href="#">Update Status</a>
			   </th>
			   -->
			 {/if}
		</tr>

		{foreach from=$info item=tbl_table_status_linkitem}
		
		{assign var=is_available value=0}
		{if $tbl_table_status_linkitem.tbl_sts_lnk_status_id eq $smarty.const.TBL_STATUS_AVAILABLE && $latestOnly eq 1}
			{assign var=is_available value=1}
		{/if}
		<tr class="{cycle values="odd,even"}{if $tbl_table_status_linkitem.customer_session.tbl_cust_sess_by_cust eq 1} customers{/if}" >
			<!--<td>{$tbl_table_status_linkitem.tbl_sts_lnk_id}</td>-->
   
 		<td {if $is_available neq 1}onclick='window.location.href="{$website}/user/tbl_table_status_link.php?latestOnly={$latestOnly}&customer_session_id={$tbl_table_status_linkitem.tbl_sts_lnk_session_id}&pst_table_id={$tbl_table_status_linkitem.tbl_sts_lnk_table_id}"'{/if}>{$tbl_table_status_linkitem.table.table_number}</td>
 		
   	    <td {if $is_available neq 1}onclick='window.location.href="{$website}/user/tbl_table_status_link.php?latestOnly={$latestOnly}&customer_session_id={$tbl_table_status_linkitem.tbl_sts_lnk_session_id}&pst_table_id={$tbl_table_status_linkitem.tbl_sts_lnk_table_id}"'{/if}>{if $is_available eq 1}--{else}{if $tbl_table_status_linkitem.tbl_sts_lnk_cust_id neq ""}{$tbl_table_status_linkitem.tbl_sts_lnk_cust_id}{else}{if $tbl_table_status_linkitem.customer_session.tbl_cust_sess_customer}{$tbl_table_status_linkitem.customer_session.tbl_cust_sess_customer|wordwrap:6:"\n":true}{else}Guest{/if}{/if}{/if}</td>
		<td {if $is_available neq 1}onclick='window.location.href="{$website}/user/tbl_table_status_link.php?latestOnly={$latestOnly}&customer_session_id={$tbl_table_status_linkitem.tbl_sts_lnk_session_id}&pst_table_id={$tbl_table_status_linkitem.tbl_sts_lnk_table_id}"'{/if}>{if $is_available eq 1}--{else}{$tbl_table_status_linkitem.employee.full_name|wordwrap:6:"\n":true}{/if}</td>

        <td {if $is_available neq 1}onclick='window.location.href="{$website}/user/tbl_table_status_link.php?latestOnly={$latestOnly}&customer_session_id={$tbl_table_status_linkitem.tbl_sts_lnk_session_id}&pst_table_id={$tbl_table_status_linkitem.tbl_sts_lnk_table_id}"'{/if}>{$tbl_table_status_linkitem.status.tbl_sts_name} ({$tbl_table_status_linkitem.elapsed_time|date_format:$smarty.const.HTML5_TIME_FORMAT})
			</td>
 {if 0}
			<td >{if $is_available eq 1}--{else}{$tbl_table_status_linkitem.tbl_sts_lnk_start_time|date_format:$smarty.const.HTML5_TIME_FORMAT}{/if}</td>
			<td >{if $is_available eq 1}--{else}{$tbl_table_status_linkitem.tbl_sts_lnk_end_time|date_format:$smarty.const.HTML5_TIME_FORMAT}{/if}</td>
 {/if}
            <td >{if $is_available eq 1}--{else}{$tbl_table_status_linkitem.arrive_time|date_format:$smarty.const.HTML5_TIME_FORMAT}{/if} 
			</td>
 {if $latestOnly eq 1}
            <td>                
				{include file="tbl_table_status_link/new_statuspicker.tpl"}
				<!--
                <select onchange="changeRequestStage({$tbl_table_status_linkitem.tbl_sts_lnk_table_id},{$tbl_table_status_linkitem.tbl_sts_lnk_cust_id},this.value,{$tbl_table_status_linkitem.tbl_sts_lnk_emp_id},{$tbl_table_status_linkitem.tbl_sts_lnk_status_id});">
                    <option value="">Change Status</option>
                    {assign var="curr_sts_flg" value="0"}
                    {assign var="curr_sts_val" value="0"}
                    {if $tbl_table_status_linkitem.tbl_sts_lnk_status_id < 7}
                        {assign var="curr_sts_val" value="{$tbl_table_status_linkitem.tbl_sts_lnk_status_id}"}
                    {/if}
                    
					{foreach $lst_table_status as $val}
                        {if $val@key > $curr_sts_val and $curr_sts_flg eq 0}
                            <option value="{$val@key}">{$val}</option>
                            {assign var="curr_sts_flg" value="1"}
                        {else}
                            <option value="{$val@key}" disabled="disabled">{$val}</option>
                        {/if}
				    {/foreach}
				</select>
				-->
			</td>
			<!--
			<td>
                <input data-role="button" data-inline="true" data-icon="reload" onclick="resetthisTable({$tbl_table_status_linkitem.tbl_sts_lnk_table_id});" type="button" value="{$_lang.tbl_table_status_link.RESET.SINGLE_TBL_BTN_LBL}"/>
			</td>
			-->
    {/if}
		</tr>
	{/foreach}

		<tfoot>
			<tr>
				<td colspan="7">
					# {$result_found}&nbsp;&nbsp;&nbsp;{if $pagination neq ""}{$pagination}{/if}
					<!--<select onchange="changePage('{$navigationURL}',this.value,{$smarty.request.limit});">
					{if $allPageCount gt 1}
						{for $foo=1 to $allPageCount}
							<option value="{$foo}" {if $foo eq $currentPage}selected="selected"{/if}>{$foo}</option>
						{/for}
					{else}
						<option value="1" disabled="disabled">1</option>
					{/if}
					</select>-->
				</td>
            </tr>
		</tfoot>
	</table>
{else}  
	{if $latestOnly eq 1}
	<div class="error">Please assign tables to the employees first. For assigning tables please <a href="{$website}/user/tbl_emp_shift_assignment.php">click here</a>.</div>
	{else}
	<div class="error">{$_lang.tbl_table_status_link.no_record_found} </div>
	{/if}
	
	
{/if}
{/if}
<form id='frmChangeRequestStage' name='frmChangeRequestStage' method="post" action='{$website}/user/tbl_table_status_link.php'>
    <input type='hidden' name='pst_table_id' id='pst_table_id' value='0'/>
	<input type='hidden' name='pst_cust_id' id='pst_cust_id' value='0'/>
	<input type='hidden' name='pst_status_id' id='pst_status_id' value='0'/>
	<input type='hidden' name='pst_emp_id' id='pst_emp_id' value='{if $smarty.session.guid gt 0}{$smarty.session.guid}{else}0{/if}'/>
	<input type='hidden' name='pst_last_status_id' id='pst_last_status_id' value='0'/>
	<input type='hidden' name='change_stage' value='change_stage'/>
</form>
{literal}

<script type="text/javascript">

 function changeRequestStage(pst_table_id,pst_cust_id,pst_status_id,pst_emp_id,pst_last_status_link_id,curr_status_id){ 
  
	if((pst_table_id>0) && (pst_status_id>0)){
		     
	 if((curr_status_id == {/literal}{$smarty.const.TBL_STATUS_AVAILABLE}{literal}) && (pst_status_id == {/literal}{$smarty.const.TBL_STATUS_OCCUPIED}{literal})){
 
		  window.location.href = '{/literal}{$website}{literal}/user/tbl_table_status_link.php?latestOnly={/literal}{$latestOnly}{literal}&mode=NEW&tbl_sts_lnk_table_id=' + pst_table_id ;		
	}else{
		 
		$("#pst_table_id").val(pst_table_id);
    $("#pst_cust_id").val(pst_cust_id);
    $("#pst_status_id").val(pst_status_id);
		if(pst_emp_id > 0){
			$("#pst_emp_id").val(pst_emp_id);
		}
        
    $("#pst_last_status_id").val(pst_last_status_link_id);
		if(pst_status_id == "{/literal}{$smarty.const.TBL_STATUS_AVAILABLE}{literal}"){		 
			tablesPendingReqst("frmChangeRequestStage",pst_table_id); 
		}else if(pst_status_id == "{/literal}{$smarty.const.TBL_STATUS_ORDER_CONFIRM}{literal}"){  
			checkforconfirmOrder(pst_table_id); 
		}else if(pst_status_id == "{/literal}{$smarty.const.TBL_STATUS_CHECK}{literal}"){  
			checkforUnPaidOrders (pst_table_id); 
		}else{
			//$("#frmChangeRequestStage").submit();
			document.getElementById("frmChangeRequestStage").submit();
		}    
	}      
	}else{
		alert({/literal}"{$_lang.tbl_table_status_link.non_empty_msg.tbl_sts_lnk_status_id}"{literal})
	} 
 }
</script>
{/literal}

    {if $notify_id >0}
        <input data-role="button" data-icon="delete" data-inline="true" type="button" value="{$_lang.tbl_alerts.DELETE.BTN_NOTIFY_LBL}" onclick="window.location.href='{$website}/user/tbl_alerts.php?action={$smarty.const.ACTION_DELETE}&alert_id={$notify_id}';"/>
    {/if}

{if $tbl_details.table_id gt 0}
{else} 
	{if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR OR $Global_member.member_role_id eq $smarty.const.ROLE_OWNER}
    <center>
	<input data-role="button" data-inline="true" data-icon="add-item" onclick="window.location.href='{$page_url}&mode={$smarty.const.MODE_CREATE}'" type="button" value="{$_lang.tbl_table_status_link.CREATE.BTN_LBL}"/>
	{if $result_found gt 0 && $info}
	<input data-role="button" data-inline="true" data-icon="reload" onclick="resetAllTables();" type="button" value="{$_lang.tbl_table_status_link.RESET.BTN_LBL}"/>
	{/if}
	</center>
	{/if}
{/if}
</div>

<input type="hidden" id="tbl_sts_lnk_table_id" value="0"/>
{include file="footercontent.tpl"}
{include file="tbl_table_status_link/js.tpl"}

{literal}
	<script type="text/javascript">
		$(function(){
			$("#fts_start_date").scroller({ preset: 'date',dateFormat : '{/literal}{$smarty.const.MOBISCROL_FORMAT}{literal}',  animate: 'pop'});
			$("#fts_end_date").scroller({ preset: 'date',dateFormat : '{/literal}{$smarty.const.MOBISCROL_FORMAT}{literal}',  animate: 'pop'});
		})
	</script>
{/literal}
	
</body></html> 
