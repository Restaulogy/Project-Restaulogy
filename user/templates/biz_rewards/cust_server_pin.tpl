<div data-role="popup" id="cust_popupServerPin" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
	<div data-role="header">
		<h1>{$_lang.biz_checkins.label.reward_code}</h1>
	</div>
	<form name='frm_customer_rewards1' id="frm_customer_rewards1"  method="POST" action="{$website}/user/customer_rewards.php" onsubmit="return validate_cust_server_pin();" >
	<div data-role="content" style="padding:5px;">
		<div class='info'>{$_lang.biz_checkins.label.cust_promt_msg}</div>
        <div >
			<label for='cust_server_pin'>{$_lang.biz_checkins.label.reward_code}</label>
            <input type='password' name='cust_server_pin' id='cust_server_pin' value='' />
    		<div id="cust_server_pin_err" class="error"></div>
		</div>

		<input type='hidden' name='action' id='action' value="validate_server_pin" />
		
		<input type='hidden' name='redim' id='redim' value="1" />
		<input type='hidden' name='rwd_id' id='rwd_id' value="" />
		<input type='hidden' name='promotion' id='promotion' value="" />
		<input type='hidden' name='server_validated' id='server_validated' value="{$server_validated}" />
        <input type='hidden' name='manager_cust_sess_id' id='manager_cust_sess_id' value="{$manager_cust_sess_id}" />
		
		<div class='biz_center'>
        <input type="submit" data-icon="save" data-inline="true" value="{$_lang.save_lbl}"/>
		<input type="button" data-icon="delete" data-inline="true" onclick="$('#cust_popupServerPin').popup('close');" value="{$_lang.cancel_lbl}"/>
        </div>
	</div>
	</form>
</div>
