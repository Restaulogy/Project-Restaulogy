<form style="display: none;" id="filter_for_rwards_lst" method="POST" action="{$website}/user/rewrad_point_list.php?rpt_to_show={$rpt_to_show}" onsubmit="return validate_search_form();">
	<table style="width: 100%;"  class="biz_box white_border">
        <tr>
		<td style="padding: 5px;text-align:center;" colspan="3">
			<label><b class="panel_bg">SEARCH<b></label> <hr>
		</tr>
		
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>{$_lang.tbl_staff.label.staff_fname}  </label>
            <input type="text" id="search_fname" name="search_fname" value="{$smarty.request.search_fname}" />
            <div class="error" id="search_fname_err"></div>
        </td>
		</tr>
		
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>{$_lang.tbl_staff.label.staff_lname} </label>
            <input type="text" id="search_lname" name="search_lname" value="{$smarty.request.search_lname}" />
            <div class="error" id="search_lname_err"></div>
        </td>
		</tr>
		
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>{$_lang.tbl_staff.label.staff_email} </label>
            <input type="text" id="search_email" name="search_email" value="{$smarty.request.search_email}" />
            <div class="error" id="search_email_err"></div>
        </td>
		</tr>
		
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>{$_lang.tbl_staff.label.staff_phone} </label>
            <input type="text" id="search_phone" name="search_phone" value="{$smarty.request.search_phone}" />
            <div class="error" id="search_phone_err"></div>
        </td>
		</tr>
		
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>{$_lang.biz_rewards.total_points} >= </label>
            <input type="text" id="search_total_points" name="search_total_points" value="{$smarty.request.search_total_points}" />
            <div class="error" id="search_total_points_err"></div>
        </td>
		</tr>
		
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>{$_lang.biz_rewards.redeemed_points} >= </label>
            <input type="text" id="search_redeemed_points" name="search_redeemed_points" value="{$smarty.request.search_redeemed_points}" />
            <div class="error" id="search_redeemed_points_err"></div>
        </td>
		</tr>
		
		<tr>
		<td style="display:none;padding: 5px;" colspan="3">
			<label>{$_lang.biz_rewards.balance_points} >= </label>
            <input type="text" id="search_balance_points" name="search_balance_points" value=""  value="{$smarty.request.search_balance_points}"/>
            <div class="error" id="search_balance_points_err"></div>
        </td>
		</tr>
		
		<tr>
		<td style="padding: 5px;" colspan="3">
			<label>{$_lang.biz_rewards.last_visit} >= </label>
            <select id="search_last_visit" name="search_last_visit" value="">
                {for $foo=0 to 60}
	                <option value="{$foo}" {if $smarty.post.search_last_visit eq $foo} selected="selected" {/if}> {$foo} </option>
	            {/for}
            </slect>
            <div class="error" id="search_last_visit_err"></div>
        </td>
		</tr>

		<tr>
			<td class="biz_center line_break" colspan="3">
				<input data-inline="true" data-icon="search" type="submit" name="fts_search" value="{$_lang.search_lbl}"/>
				<input data-inline="true" data-icon="delete" type="button" onclick="window.location.href='{$website}/user/rewrad_point_list.php';" value="{$_lang.cancel_lbl}"/>
			</td>
		</tr>
	</table> 
	<br><br>
</form>
