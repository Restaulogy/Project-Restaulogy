<form id="filter_for_qrcodescan" method="POST" action="{$website}/user/tbl_daily_report.php" onsubmit="return validDtRange('search_from_dt','search_to_dt');" style="display:none;">
	<table style="width: 100%;"  >

        <tr>
		<td style="padding: 5px;text-align:center;" colspan="3">
			<label><b class="panel_bg">SEARCH<b></label> <hr>
		</tr>

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
    	
    	{if $Global_member.member_role_id eq $smarty.const.ROLE_DEV}
        	<tr>
    		<td style="padding: 5px;" colspan="3">
    			<label>Restaurant</label>
                <select id="search_restaurant" name="search_restaurant" >
                 <option value="" data-placeholder="true">Select Restaurant</option>
        		 {foreach $lst_restants as $_rest}
        		 	<option value="{$_rest@key}" {if $search_restaurant && ($_rest@key eq $search_restaurant)}selected="selected"{/if}>{$_rest}</option>
        		 {/foreach}
        		 </select>
            </td>
    		</tr>
		{/if}

		<tr>
			<td class="biz_center line_break" colspan="3">
				<input data-inline="true" data-icon="search" type="submit" name="fts_search" value="{$_lang.search_lbl}"/>
				 <input data-inline="true" data-icon="delete" type="button" onclick="window.location.href='{$website}/user/tbl_daily_report.php';" value="{$_lang.cancel_lbl}"/>
			</td>
		</tr>
	</table> 
</form>
