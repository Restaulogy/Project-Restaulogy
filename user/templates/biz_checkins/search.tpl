<form style="display: none;" id="filter_for_checkin" method="POST" action="{$website}/user/biz_checkins.php?server_validated={$server_validated}&rpt_to_show={$rpt_to_show}" onsubmit="return validDtRange('search_from_dt','search_to_dt');">
	<table style="width: 100%;"  class="biz_box white_border">
        <tr>
		<td style="padding: 5px;text-align:center;" colspan="3">
			<label><b class="panel_bg">SEARCH<b></label> <hr>
		</td>	
		</tr>

        <tr>
    		<td><label>Start Date</label></td>
    		<td>&nbsp;</td>
    		<td><label>End Date</label></td>
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
				<input data-inline="true" data-icon="delete" type="button" onclick="window.location.href='{$website}/user/biz_checkins.php?server_validated={$server_validated}&rpt_to_show={$rpt_to_show}';" value="{$_lang.cancel_lbl}"/>
			</td>
		</tr>
	</table> 
	<br><br>
</form>
