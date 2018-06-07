
<div id="popupSearch" class="white_border" style="display:none;">
<h1 class="panel_bg">Search</h1>
<form id="frmSearchEmpRequests" name="frmSearchEmpRequests" action="{$page_url}" method="POST" style="padding:0px 5px;" onsubmit="return comparedate();">  
    <table class="full_width"> 
		<tr>
			<td colspan="3">
				Menu Item : &nbsp;
				<select name='keyword' id='keyword'>
					<option value=''>Select Menu Item</option>
					{foreach from=$tbl_submenu_disheslist key=sub_mnu_dish_id item=sub_mnu_dish}
						<option value='{$sub_mnu_dish_id}' {if $sub_mnu_dish_id eq $keyword || $smarty.request.keyword eq $sub_mnu_dish_id}selected="selected"{/if}>{$sub_mnu_dish}</option>
					{/foreach} 
				</select> 
				
			</td>
		</tr>
		
		<tr>
			<td colspan="3">
				Customer : &nbsp; <input type="text" id='cust_name' placeholder="Customer Name" name='cust_name' value='{if $cust_name}{$cust_name}{elseif $smarty.post.cust_name}{$smarty.post.cust_name}{/if}'/>
			</td>
		</tr>
		
		<tr>
			<td colspan="3">
				Select Amount Range: &nbsp;
				<select name='srch_bill_ammt' id='srch_bill_ammt'>
					<option value=''>Select Amount Range</option>
					<option value='1' {if $srch_bill_ammt eq 1 || $smarty.request.srch_bill_ammt eq 1}selected="selected"{/if}>$0-$20</option>
					<option value='2' {if $srch_bill_ammt eq 2 || $smarty.request.srch_bill_ammt eq 2}selected="selected"{/if}>$20-$40</option>
					<option value='3' {if $srch_bill_ammt eq 3 || $smarty.request.srch_bill_ammt eq 3}selected="selected"{/if}>$40-$60</option>
					<option value='4' {if $srch_bill_ammt eq 4 || $smarty.request.srch_bill_ammt eq 4}selected="selected"{/if}>$60-$80</option>
					<option value='5' {if $srch_bill_ammt eq 5 || $smarty.request.srch_bill_ammt eq 5}selected="selected"{/if}>$80-$100</option>
					<option value='6' {if $srch_bill_ammt eq 5 || $smarty.request.srch_bill_ammt eq 5}selected="selected"{/if}>$100-$1000 </option>					 
				</select>  
			</td>
		</tr>
		<tr>
			<td colspan="3">
				Select Date Range : &nbsp; 
			</td>
		</tr>
		<tr>
			<td style="width:48%;"><input type="text" id='start_date' placeholder="Start Date" name='start_date' value='{if $start_date}{$start_date}{elseif $smarty.post.start_date}{$smarty.post.start_date}{/if}'/></td>
			<td style="width:4%;">&nbsp;</td>
			<td style="width:48%;"><input type='text' placeholder="End Date"  id='end_date' name='end_date' value='{if $end_date}{$end_date}{elseif $smarty.post.end_date}{$smarty.post.end_date}{/if}'/> </td> 
		</tr>
		<tr>
			<td class="error" id="start_date_err"></td>
			<td></td>
			<td class="error" id="end_date_err"></td>
		</tr>
    </table> 
	Select Table : &nbsp; 
	<select name='srch_table_id' id='srch_table_id'>
		<option value=''>Select Table</option>
		{foreach from=$diningtables key=dining_id item=dining}
			<option value='{$dining_id}' {if $srch_table_id eq $dining_id || $smarty.request.table_id eq $dining_id}selected="selected"{/if}>{$dining}</option>
		{/foreach} 
	</select>  
	Select Employee : &nbsp;  
	<select name='emp_id' id='emp_id'>
		<option value=''>Select Employee</option>
		{foreach from=$employees key=employee_id item=employee}
			<option value='{$employee_id}' {if $employee_id eq $emp_id || $smarty.request.emp_id eq $employee_id}selected="selected"{/if}>{$employee}</option>
		{/foreach} 
	</select> 
	 
   	<div class="clearfix line_break"></div>
	<!-- <input type="hidden" name="report" value="{$report}"/>-->
	<center>
	 <input type="hidden" name="table_status" value="{$smarty.request.table_status}"/>
	 <input data-role="button" data-inline="true" data-icon="search" data-iconpos="left"   value='Search' type='submit'/> 
	 <input type='button' data-role="button" data-inline="true" data-icon="delete" data-iconpos="left" value='Cancel' onclick="window.location.href='{$page_url}';"/> </center>
</form>
</div>   

    <div class="clearfix line_break"></div>
