<form style="display: none;" id="filter_tbl_feedback" method="POST" action="{$website}/user/tbl_feedback_stats.php" onsubmit="return comparedate();">
	<table style="width: 100%;"  class="biz_box white_border">

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
    			<label>{$_lang.statistics.label.time_period}</label>
    			<select id="time_period" name="time_period" onclick="change_period(this.value);">
    			 {foreach $time_periods as $period}
    			 	<option value="{$period@key}" {if $smarty.request.time_period eq $period@key}selected="selected"{/if}>{$period}</option>
    			 {/foreach}
    			</select>
    		</td>
    	</tr>
		
		<tr>
			<td colspan="3">
				<label>Select Date Range : &nbsp;</label>
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

        <tr >
			<td colspan="3">
			<label>Menu Item </label>
				<select name='fts_menu' id='fts_menu'>
					<option value=''>Select Menu Item</option>
					{foreach from=$submenu_disheslist key=sub_mnu_dish_id item=sub_mnu_dish}
						<option value='{$sub_mnu_dish_id}' {if $smarty.request.keyword eq $sub_mnu_dish_id}selected="selected"{/if}>{$sub_mnu_dish}</option>
					{/foreach}
				</select>
			</td>
		</tr>
		
		<tr>
			<td style="padding: 5px;" colspan="3">
			<label>Rating type</label>
			 <select name="fts_is_restaurant" id="fts_is_restaurant">
			 <option value="0" {if $fts_is_restaurant eq 0}selected="selected"{/if}>Dish Rating</option>
			 <option value="1" {if $fts_is_restaurant eq 1}selected="selected"{/if}>Restaurant Rating</option>
			 </select>
			</td>
		</tr>
		
		<tr>
			<td style="padding: 5px;" colspan="3">
			<label>Chart Type</label>
			 <select name="fts_graph_type" id="fts_graph_type">
			 <option value="0" {if $fts_graph_type eq 0}selected="selected"{/if}>Bar Plot</option>
			 <option value="1" {if $fts_graph_type eq 1}selected="selected"{/if}>Line Plot</option>
			 </select>
			</td>
		</tr>

		<tr>
			<td class="biz_center line_break" colspan="3">
				<input data-inline="true" data-icon="search"  type="submit" name="fts_search"  value="{$_lang.search_lbl}"/>
				<input data-inline="true" data-icon="delete" type="button" onclick="window.location.href='{$website}/user/tbl_feedback_stats.php';" value="{$_lang.cancel_lbl}"/>
			</td>
		</tr>
		

	</table> 
	<br><br>
</form>
