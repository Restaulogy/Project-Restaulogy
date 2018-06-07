<form style="display: none;" id="filter_tbl_status" method="POST" action="{$website}/user/tbl_table_status_link.php?latestOnly=0" onsubmit="return comparedate();">
	<table style="width: 100%;"  class="biz_box white_border">
		<tr> 
		<td style="padding: 5px;" colspan="3">
			<label>Server</label>
			<!--
            <input type="text" name="fts_server" id="fts_server" placeholder="server" value="{$smarty.request.fts_server}"/>
            -->
            <select name='fts_server' id='fts_server'>
			<option value=''>Select Employee</option>
		{foreach from=$employees key=employee_id item=employee}
			<option value='{$employee_id}' {if $employee_id eq $fts_server || $smarty.post.fts_server eq $employee_id}selected="selected"{/if}>{$employee}</option>
		{/foreach}
		</select>
        </td>
		</tr>
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>Customer</label>
			<input type="text" name="fts_customer" id="fts_customer" placeholder="Customer" value="{$smarty.request.fts_customer}"/></td>
		</tr>
		<tr>
			<td style="padding: 5px;" colspan="3">
			<label>Keywords</label>
			<input type="text" name="fts_keywords" id="fts_keywords" placeholder="Promotion, Menu Dishes" value="{$smarty.request.fts_keywords}"/>
			</td>
		</tr>
		
		<tr>
			<td style="padding: 5px;" colspan="3">
			<label>Table</label>
			 <select name="fts_table" id="fts_table">
			 <option value="">Select Table</option>
			  {foreach $tables as $val}
			 		<option value="{$val@key}" {if $val@key eq $smarty.request.fts_table}selected="selected"{/if}>{$val}</option>
				{/foreach}
			 </select>
			</td>
		</tr>
		
		<tr>
			<td colspan="3">
				Select Date Range : &nbsp; 
			</td>
		</tr>
		<tr>
			<td style="width:48%;"><input type="text" id='fts_start_date' placeholder="Start Date" name='fts_start_date' value='{if $fts_start_date}{$fts_start_date}{elseif $smarty.post.fts_start_date}{$smarty.post.fts_start_date}{/if}'/></td>
			<td style="width:4%;">&nbsp;</td>
			<td style="width:48%;"><input type='text' placeholder="End Date"  id='fts_end_date' name='fts_end_date' value='{if $fts_end_date}{$fts_end_date}{elseif $smarty.post.fts_end_date}{$smarty.post.fts_end_date}{/if}'/> </td> 
		</tr>
		<tr>
			<td class="error" id="fts_start_date_err"></td>
			<td></td>
			<td class="error" id="fts_end_date_err"></td>
		</tr>
		 
		<tr style="display:none;" >
			<td colspan="3">
			<label>Menu Item </label> 
				<select name='menu' id='menu'>
					<option value=''>Select Menu Item</option>
					{foreach from=$submenu_disheslist key=sub_mnu_dish_id item=sub_mnu_dish}
						<option value='{$sub_mnu_dish_id}' {if $sub_mnu_dish_id eq $emp_id || $smarty.request.keyword eq $sub_mnu_dish_id}selected="selected"{/if}>{$sub_mnu_dish}</option>
					{/foreach} 
				</select> 
			</td>
		</tr>    
		<tr>
			<td class="biz_center line_break" colspan="3">
				<input data-inline="true" data-icon="search"  type="submit" name="fts_search"  value="{$_lang.search_lbl}"/>
				<input data-inline="true" data-icon="delete" type="button" onclick="window.location.href='{$website}/user/tbl_table_status_link.php?latestOnly=0';" value="{$_lang.cancel_lbl}"/>
			</td>
		</tr>
	</table> 
	<br><br>
</form>
