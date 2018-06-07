<form style="display: none;" id="filter_for_crm_prom_emails" method="POST" action="{$website}/user/crm_prom_emails.php" onsubmit="return validDtRange('search_from_dt','search_to_dt');">
	<table style="width: 100%;" class="biz_box white_border">
        <tr>
		<td style="padding: 5px;text-align:center;" colspan="3">
			<label><b class="panel_bg">SEARCH<b></label> <hr>
		</tr>
		
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>Promotion</label>
            <select id="search_prom" name="search_prom" >
             <option value="" data-placeholder="true">Select Promotion</option>
    		 {foreach $lst_promotion as $_prom}
    		 	<option value="{$_prom@key}" {if $search_prom && ($_prom@key eq $search_prom)}selected="selected"{/if}>{$_prom}</option>
    		 {/foreach}
    		 </select>
        </td>
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

		<tr>
			<td class="biz_center line_break" colspan="3">
				<input data-inline="true" data-icon="search" type="submit" name="fts_search" value="{$_lang.search_lbl}"/>
				<input data-inline="true" data-icon="delete" type="button" onclick="window.location.href='{$website}/user/crm_prom_emails.php';" value="{$_lang.cancel_lbl}"/>
			</td>
		</tr>
	</table> 
	<br><br>
</form>
