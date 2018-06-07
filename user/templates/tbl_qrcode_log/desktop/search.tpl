<form id="filter_for_qrcodescan" method="POST" action="{$website}/user/tbl_qrcode_log.php?rpt_to_show={$rpt_to_show}" onsubmit="return validDtRange('search_from_dt','search_to_dt');">
	<table style="width: 100%;padding:0px !important;">
    	<tr class="no_border">
            <td>Start Date</td>
    		<td>
    			<input type="date" id="search_from_dt" name="search_from_dt" value="{$search_from_dt}" placeholder=" From" />
    		</td>
    		<td >&nbsp;</td>
    		<td>End Date</td>
    		<td>
    			<input type="date" id="search_to_dt" name="search_to_dt" value="{$search_to_dt}" placeholder=" To" />
    		</td>
    		<td>
    			<input data-inline="true" data-icon="search" type="submit" name="fts_search" value="{$_lang.search_lbl}"/>
    		</td>
    	</tr>
		
		<tr> 
		<td class="biz_hidden" colspan="6">
			<label>Table</label>
            <select id="search_table" name="search_table" >
             <option value="" data-placeholder="true">Select Table</option>
    		 {foreach $lst_tables as $_table}
    		 	<option value="{$_table@key}" {if $search_table && ($_table@key eq $search_table)}selected="selected"{/if}>{$_table}</option>
    		 {/foreach}
    		 </select>
        </td>
		</tr>

    {if $rpt_to_show neq 'promotions'}
        <tr>
		<td >
			<label>Group By</label>
        </td>
        <td >
            <select id="search_groupby" name="search_groupby" >
        		 <option value="day" {if 'day' eq $search_groupby}selected="selected"{/if}>Day</option>
        		 <option value="week" {if 'week' eq $search_groupby}selected="selected"{/if}>Week</option>
        		 <option value="month" {if 'month' eq $search_groupby}selected="selected"{/if}>Month</option>
        		 <option value="year" {if 'year' eq $search_groupby}selected="selected"{/if}>Year</option>
    		</select>
        </td>
        <td colspan="4">
			&nbsp;
        </td>
		</tr>
    {/if}


	</table> 
</form>
