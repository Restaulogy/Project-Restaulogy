<form style="display: none;" id="filter_for_qrcodescan" method="POST" action="{$website}/user/tbl_qrcode_log.php" onsubmit="return validDtRange('search_from_dt','search_to_dt');">
	<table style="width: 100%;"  class="biz_box white_border">
        <tr>
		<td style="padding: 5px;text-align:center;" colspan="3">
			<label><b class="panel_bg">SEARCH<b></label> <hr>
		</tr>
<!--
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>Restaurant</label>
            <select id="search_restaurant" name="search_restaurant" >
             <option value="" data-placeholder="true">Select Restaurant</option>
    		 {foreach $lst_restants as $_rest}
    		 	<option value="{$_rest@key}" {if $search_restaurant && ($_rest@key eq $search_restaurant)  }selected="selected"{/if}>{$_rest}</option>
    		 {/foreach}
    		 </select>
        </td>
		</tr>
-->
        <tr>
    		<td>Start Date</td>
    		<td>&nbsp;</td>
    		<td>End Date</td>
    	</tr>
    	<tr class="no_border">
    		<td>
    			<input type="text" id="search_from_dt" name="search_from_dt" value="{$search_from_dt|date_format:$smarty.const.HTML5_DAY_FORMAT}" placeholder=" From" readonly="readonly"/>
    		</td>
    		<td >&nbsp;</td>
    		<td>
    			<input type="text" id="search_to_dt" name="search_to_dt" value="{$search_to_dt|date_format:$smarty.const.HTML5_DAY_FORMAT}" placeholder=" To" readonly="readonly"/>
    		</td>
    	</tr>
		
		<tr> 
		<td style="padding: 5px;" colspan="3">
			<label>Table</label>
            <select id="search_table" name="search_table" >
             <option value="" data-placeholder="true">Select Table</option>
    		 {foreach $lst_tables as $_table}
    		 	<option value="{$_table@key}" {if $search_table && ($_table@key eq $search_table)}selected="selected"{/if}>{$_table}</option>
    		 {/foreach}
    		 </select>
        </td>
		</tr>
		
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>Group By</label>
            <select id="search_groupby" name="search_groupby" >
             <option value="" data-placeholder="true">Select One</option>
    		 <option value="day" {if 'day' eq $search_groupby}selected="selected"{/if}>Day</option>
    		 <option value="week" {if 'week' eq $search_groupby}selected="selected"{/if}>Week</option>
    		 <option value="month" {if 'month' eq $search_groupby}selected="selected"{/if}>Month</option>
    		 </select>
        </td>
		</tr>

		<tr>
			<td class="biz_center line_break" colspan="3">
				<input data-inline="true" data-icon="search" type="submit" name="fts_search" value="{$_lang.search_lbl}"/>
				<input data-inline="true" data-icon="delete" type="button" onclick="window.location.href='{$website}/user/tbl_qrcode_log.php';" value="{$_lang.cancel_lbl}"/>
			</td>
		</tr>
	</table> 
	<br><br>
</form>
