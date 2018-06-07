
<div style="{if ($active_page eq 'customer_rewards') || ($isCustomer gt 0)}display:none;{/if}" >

	<form name='frm_customer_rewards' id="frm_customer_rewards"  method="POST" action="{$website}/user/customer_rewards.php" onsubmit="return validate_fetch_cust_rwd_sess();" >
	<div data-role="content" style="padding:5px;">
	
        <div >
			<label for='sel_reward_sess'>{* $_lang.biz_checkins.label.reward_code *}</label>
			
   <table class="listTable">
		<tr>
		<th style="width:2%;"></th>
        <th class="bigListItem">Code</th>
        <th >Customer</th>
        <th >Email</th>
        <th >Table</th>
        <th >Request</th>
        <th >Status</th>
        </tr>
         {foreach from=$cust_temp_reward_sess key=tmp_rwse_id item=cust}
			<tr>
                <td style="width:2%;">
					<label for="sel_reward_sess{$biz_rewardsitem.rwd_id}" data-mini="true" style="width:23px;" >
                    <input type="radio" data-inline='true' data-mini='true' id="sel_reward_sess" name="sel_reward_sess" value='{$cust.tmp_rwse_id}' {if $smarty.session[$smarty.const.SES_REWARD].unique_cd eq $cust.tmp_rwse_unique_cd}checked="checked"{/if} />&nbsp;</label>
				</td>
                <td >
                    {$cust.tmp_rwse_unique_cd}
                </td>
                <td >
                    {$cust.staff_full_name}
				</td>
				<td >
                    {$cust.staff_email|wordwrap:15:"\n":true}
				</td>
				<td >
                    {$cust.staff_table}
				</td>
                <td >
                    {$cust.tmp_rwse_request_type}
				</td>
				<td >
                    {$cust.tmp_rwse_status}
				</td>
			</tr>
	   {/foreach}
	</table>

            <!--
            <select name='sel_reward_sess' id='sel_reward_sess'>
                <option value=''>Select CODE</option>
        		{foreach from=$cust_temp_reward_sess key=tmp_rwse_id item=cust}
        			<option value='{$cust.tmp_rwse_id}' {if $smarty.session[$smarty.const.SES_REWARD].unique_cd eq $cust.tmp_rwse_unique_cd}selected="selected"{/if}>{$cust.tmp_rwse_unique_cd}</option>
        		{/foreach}
            </select>
            -->
    		<div id="sel_reward_sess_err" class="error"></div>
		</div>

		<input type='hidden' name='act_app_rej' id='act_app_rej' value="" />

		<div class='biz_center'>
		{if $cust_temp_reward_sess}
        <input type="button" onclick="set_act_submit(1);" data-icon="save" data-inline="true" value="Reward/Redeem"/>
        <input type="button" onclick="set_act_submit(0);" data-icon="delete" data-inline="true" value="{$_lang.reject}"/>
        {/if}
		<!--
        <input type="button" data-icon="delete" data-inline="true" onclick="$('#popupServerPin').popup('close');" value="{$_lang.cancel_lbl}"/>
        -->
        </div>

	</div>
	</form>
</div>
