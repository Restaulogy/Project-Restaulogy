{include file='header.tpl'}
<div class="wrapper">
 <h1>{$_lang.main.prom_stats.prom_stats_title}</h1>
 {include file='prom_stats_menu.tpl'} 
 
<div id="popupSearch" class="white_border" style="display:none;"> 
<form method="POST" action="{$website}/user/prom_stats.php?tab_sel={$smarty.request.tab_sel}" > 
<table class="listTable">
	<tr>
		<th colspan="3">Report</th>
	</tr>
	{if $smarty.request.tab_sel eq "restaurent"}
	<tr >
		<td colspan="3">
			<label>Reports</label>
			<select name="report_type" id="report_type" >
            <option value="bill_avg" {if $smarty.request.report_type eq 'bill_avg'}selected="selected"{/if}>Average Bill</option>
            <option value="bill_total" {if $smarty.request.report_type eq 'bill_total'}selected="selected"{/if}>Total Bill</option>
			<option value="guest_count" {if $smarty.request.report_type eq 'guest_count'}selected="selected"{/if}>Guest Count</option>		
			<option value="avg_bill_per_cust" {if $smarty.request.report_type eq 'avg_bill_per_cust'}selected="selected"{/if}>Average Bill Per Customer</option>	
			<!--<option value="revenue" {if $smarty.request.report_type eq 'revenue'}selected="selected"{/if}>Revenue amount</option>-->
			</select>
		</td>
	</tr>
		
	{elseif $smarty.request.tab_sel eq "promotion"}
 	<tr>
		<td colspan="3">
			<label>Reports</label>
			<select name="report_type" id="report_type" onclick="change_reports(this.value);">
				<option value="bill_avg" {if $smarty.request.report_type eq 'bill_avg'}selected="selected"{/if}>Average Bill Amount for promotion</option>
				<option value="bill_total" {if $smarty.request.report_type eq 'bill_total'}selected="selected"{/if}>Total Bill Amount for promotion</option>
				<option value="bill_avg_cust" {if $smarty.request.report_type eq 'bill_avg_cust'}selected="selected"{/if}>Average Bill Amount Per Customer</option>
				<option value="claimed" {if $smarty.request.report_type eq 'claimed'}selected="selected"{/if}>Total no. of promotions Redeemed</option>
				<option value="emailed" {if $smarty.request.report_type eq 'emailed'}selected="selected"{/if}>Total no. of promotion text/emails sent</option>
				<!--<option value="order_prom_discnt" {if $smarty.request.report_type eq 'order_prom_discnt'}selected="selected"{/if}>Discount</option>
                <option value="is_return_cust" {if $smarty.request.report_type eq 'is_return_cust'}selected="selected"{/if}>Returning Customer</option>-->
			</select>
		</td>
	</tr>

	<tr>
		<td> <label for='chk_promotion'><input type="radio" id='chk_promotion' name="third_dimension[]" value="promotion" {if $third_dimension eq "promotion"}checked="checked"{/if} />{$_lang.statistics.label.promotion}</label></td>
		<td colspan="2"> 
			<select name="search_promotion" id="search_promotion">
				<option value="">All Promotion</option>
				{foreach $lst_promotion as $promotion}
					<option value="{$promotion@key}" {if $smarty.request.search_promotion eq $promotion@key}selected="selected"{/if}>{$promotion}</option>
				{/foreach} 
			</select>
		</td>
	</tr>
	<tr class="biz_hidden">
		<td>
			<label for="chk_prom_return_cust"><input type="radio" class="rad_cls" name="third_dimension[]" id="chk_prom_return_cust" value="customer_name" {if $third_dimension eq "customer_name"}checked="checked"{/if}>{$_lang.statistics.label.return_cust}</label>
		</td>
		<td colspan="2"></td>
	</tr>
	
	    
	{/if}	
	
	<tr class="biz_hidden">
		<td colspan="3">
			<label>{$_lang.statistics.label.amount_type}</label>
			<select id="amount_type" name="amount_type" >
			  <option value="">Select Amount type</option>
			 	<option value="AVG" {if $smarty.request.amount_type eq "AVG" || $amount_type eq "AVG"}selected="selected"{/if}>Average Bill</option>
			  <option value="SUM" {if $smarty.request.amount_type eq "SUM"  || $amount_type eq "SUM"}selected="selected"{/if}>Total Bill</option>
			</select>
		</td>
	</tr>

	<tr id='div_date_row' {if ($smarty.request.tab_sel eq "promotion") && ($report_type eq "bill_avg" || $report_type eq "bill_total" )} style='display:none;' {/if}>
		<td colspan="3">
			<label>{$_lang.statistics.label.time_period}</label>
			<select id="time_period" name="time_period" onclick="change_period(this.value);">
			{if $smarty.request.tab_sel eq "promotion"}
		 		<option value="">Select</option>
		 	{/if}
			 {foreach $time_periods as $period}			 	
			 	<option value="{$period@key}" {if $time_period eq $period@key}selected="selected"{/if}>{$period}</option>
			 {/foreach} 
			</select>
		</td>
	</tr> 
	<tr class="block_date_range" {if $time_period eq '' || $time_period eq 'annually'}style="display: none"{/if}> 
 		<td><label>Start Date {$time_period}</label></td>
	 	<td>&nbsp;</td>
		<td><label>End Date</label></td>
 	</tr>
	<tr class="block_date_range" {if $time_period eq '' || $time_period eq 'annually'}style="display: none"{/if}> 
			<td><input type='text' id='start_date' value='{if $start_date}{$start_date|date_format:"%Y-%m-%d"}{else}{$last_month|date_format:"%Y-%m-%d"}{/if}' name='start_date'/></td>
			<td></td>
			<td><input type='text' id='end_date' value='{if $end_date}{$end_date|date_format:"%Y-%m-%d"}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}' name='end_date'/></td> 
		</tr>
		<tr class="block_date_range" {if $time_period eq '' || $time_period eq 'annually'}style="display: none"{/if}>
			<td><div class='error' id='start_date_err'></div></td>
			<td>&nbsp;</td>
			<td><div class='error' id='end_date_err'></div></td>
	</tr>
	
	{if $smarty.request.tab_sel neq "promotion"}
	<tr>
		 <td><label for="chk_dine_lunch"><input type="radio" class="rad_cls" name="third_dimension[]" id="chk_dine_lunch" value="lunch_dine" {if $third_dimension eq "lunch_dine"}checked="checked"{/if}>{$_lang.statistics.label.dine_type}</label></td>
		 <td colspan="2">
		 	<select id="dine_type" name="dine_type[]" multiple="multiple" data-native-menu="false">
                <option value="">All Dine type</option>
                <option value="BREAKFAST" {if $smarty.request.dine_type && in_array("BREAKFAST",$smarty.request.dine_type)}selected="selected"{/if}>Breakfast</option>
			 	<option value="LUNCH" {if $smarty.request.dine_type && in_array("LUNCH",$smarty.request.dine_type)}selected="selected"{/if}>Lunch</option>
			    <option value="DINNER"  {if $smarty.request.dine_type && in_array("DINNER",$smarty.request.dine_type)}selected="selected"{/if}>Dinner</option>
			</select>
		 </td>
	</tr>
	{/if}
	{if $smarty.request.tab_sel eq "restaurent" } 
	<tr>
		 <td><label for="chk_customer"><input type="radio" class="rad_cls" name="third_dimension[]" id="chk_customer" value="customer" {if $third_dimension eq "customer"}checked="checked"{/if}>{$_lang.statistics.label.customer}</label></td>
		 <td colspan="2">
		 	 <input type="text" id="search_customer" name="search_customer" value="{if $smarty.request.search_customer neq ''}{$smarty.request.search_customer}{else} All{/if}"/>
		 </td>
	</tr>
	<tr>
		 <td><label for="chk_table"><input type="radio" class="rad_cls" id='chk_table' name="third_dimension[]" value="table" {if $third_dimension eq "table"}checked="checked"{/if}>{$_lang.statistics.label.table}</label></td>
		 <td colspan="2">
	 		<select name="search_table"  name="search_table">
				<option value="">All Table</option>
				{foreach $tablelist as $table}
				<option value="{$table@key}" {if $smarty.request.search_table eq $table@key}selected="selected"{/if}>{$table}</option>
				{/foreach}
			</select>
		 </td>
	</tr>
	<tr class="biz_hidden">
		<td>
			<label for="chk_month"><input type="radio" class="rad_cls" name="third_dimension[]" id="chk_month" value="month" {if $third_dimension eq "month"}checked="checked"{/if}>{$_lang.statistics.label.month}</label>
		</td>
		<td colspan="2"></td>
	</tr>
	{/if}
	{if $smarty.request.tab_sel eq "server" } 
	<tr>
		<td>
			<label for='chk_serv_server'><input type="radio" class="rad_cls" id='chk_serv_server' name="third_dimension[]" value="serve_server" {if $third_dimension eq "serve_server"}checked="checked"{/if} />{$_lang.statistics.label.server}</label>
		</td>
		<td colspan="2">
			<select name="search_server"  name="search_server">
				<option value="">Select Server</option>
				{foreach $serverlist as $server}
				<option value="{$server@key}" {if $smarty.request.search_server eq $server@key}selected="selected"{/if}>{$server}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label for='chk_serv_table'><input type="radio" class="rad_cls" id='chk_serv_table' name="third_dimension[]" value="serve_table" {if $third_dimension eq "serve_table"}checked="checked"{/if} />{$_lang.statistics.label.table}</label> 
		</td>
		<td colspan="2">
    		 <select name="search_table"  name="search_table">
    			<option value="">All Table</option>
    			{foreach $tablelist as $table}
    			<option value="{$table@key}" {if $smarty.request.search_table eq $table@key}selected="selected"{/if}>{$table}</option>
    			{/foreach}
    		</select>
		</td>
	</tr>
    <tr >
		<td>
			<label for="chk_serv_month"><input type="radio" class="rad_cls" name="third_dimension[]" id="chk_serv_month" value="month" {if $third_dimension eq "month"}checked="checked"{/if}>{$_lang.statistics.label.month}</label>
		</td>
		<td colspan="2"></td>
	</tr>
 {/if} 
 	
	{if $smarty.request.tab_sel eq "restaurent" } 
	<!--
    <tr class="block_bill_report" {if $smarty.request.report_type eq 'bill' || $smarty.request.report_type eq ''}{else}style="display: none"{/if}>
		<td style="width:48%;">
	 	 <input type="text" id="search_customer" name="search_customer" value="{if $smarty.request.search_customer neq ''}{$smarty.request.search_customer}{else} All{/if}"/>
		</td>
		<td style="width:4%;">&nbsp;</td>
		<td style="width:48%;">
			
		</td> 
	</tr>
    -->
	 			
	{elseif $smarty.request.tab_sel eq "server"}
	<tr>
		<td colspan="3">
			<label>Reports</label>
			<select name="report_type" id="report_type" >
				<!--<option value="">Select Report</option>-->
				<option value="turn_over" {if $smarty.request.report_type eq 'turn_over'}selected="selected"{/if}>Turn-Over Report</option>
				<option value="delayed" {if $smarty.request.report_type eq 'delayed'}selected="selected"{/if}>Request/Order Dealyed Report</option> 
			</select>
		</td>
	</tr> 	
	    
	{/if}
</table>
	<div class="biz_center">
		<input type="hidden" name="{$smarty.const.ACTION_TITLE}" value="{$smarty.const.ACTION_SEARCH}"/> 
		
		<input type="submit" data-inline="true" data-icon="check" value="Show"/>
		{if $smarty.request.tab_sel eq "restaurent"}
			<input type="button" onclick="de_sel_all_radio();" data-inline="true" data-icon="star" value="Clear Option"/>
		{/if}
		<input type="button" onclick="$('#popupSearch').hide();" data-inline="true" data-icon="delete" value="Close"/>
	</div> 
</form>  
</div>	
	<div class="line_break"></div>
	<h3>{$report_img.title}</h3>
	<div class="biz_center">
	 {if $report_img neq "" && $report_img.img_src neq ""}
 		 <img src="data:image/png;base64,{$report_img.img_src}" width="90%;"/>
	 {else}
		 <img src="{$website}/images/_graphics/no_record.png"/>
	 {/if}
	</div>
</div> 
{include file='footercontent.tpl'} 
{literal} 
<script type="text/javascript">
    function de_sel_all_radio(){
    	$('.rad_cls').prop('checked', false).checkboxradio("refresh");
    }
    
	function change_period(val){
		if(val == 'monthly' || val == 'date_range'){
			$('.block_date_range').show();
		}else{
			$('.block_date_range').hide();
		}
	} 
	
	function change_reports(val){
		if(val=='bill_avg' || val=='bill_total'){
			$('#div_date_row').hide();
		}else{
			$('#div_date_row').show();
		}
	} 
	$(function(){
		$('#start_date').scroller({preset:'date', dateFormat:'yy-mm-dd'});
		$('#end_date').scroller({preset:'date', dateFormat:'yy-mm-dd'});
	});
</script>
 
{/literal}
</body>
</html>
