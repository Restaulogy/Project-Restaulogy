<div data-role="popup" id="popup_mobile_validate" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
	<div data-role="header">
		<h1>Code Verification</h1>
	</div>
	<div style="display: none;">You need to verify the mobile by code confirmation.</div>
		
	<div class="field-row" id="blockConfirmationMsg" style="display: none;">
    	  <p style="color:#faf25a;text-align:justify;"><br/>Confirmation code is sent to your mobile, please use that for proceeding with redeem<br/></p> 
    </div>
    
    <div class="field-row" id="blockConfirmationCode" style="display: none;">
        <p><label for="confirmation_code">Confirmation Code </label></p>
        <p><input type="text" name="confirmation_code" id="confirmation_code" value=""/></p>
    </div>
    
	<div id="btnSendConfirmation" class="biz_center" style="display: none;">
		<input data-role="button" data-icon="mail" data-inline="true" data-theme="a" type="button" onclick="sendOrderConfirmationCode()" id="sub_send_confirmation" value="Send Confirmation" />
		<input type="hidden" id="confirmation_timestamp" value=""/>
	</div>
	
	<br>
	<div id="btnPlaceOrder" class="biz_center" >
		{if $sesslife && ($isCustomer gt 0 OR $smarty.session.curr_restant.restaurent_rwd_multiplier eq 1)}
			<div id='div_server_pin' >
				<div class='info'>{$_lang.biz_checkins.label.cust_promt_msg}</div>
				<label for='restaurant_pin'>{$_lang.biz_checkins.label.reward_code}</label>				
	            <input type='password' name='restaurant_pin' id='restaurant_pin' value='' />
	            <input type='hidden' name='am_i_cust' id='am_i_cust' value='1' />
	    		<div id="restaurant_pin_err" class="error"></div>
			</div>
		{else}
			<input type='hidden' name='am_i_cust' id='am_i_cust' value='0' />	
		{/if}
		<div id='div_reward_points'>
			<div id='lbl_rwd_pt'>Points to redeem </div>
			<input type="text" name="rwd_points" id="rwd_points" value="0" required="required" />
			<input type="hidden" name="tmp_allowed_pts" id="tmp_allowed_pts" value="0" />
		</div>
		
		<div >
			<label>{$_lang.biz_checkins.label.chkin_invoice} </label>
            <input type="text" id="rwd_invoice" name="rwd_invoice" value="{$smarty.request.rwd_invoice}" />
            <div class="error" id="rwd_invoice_err"></div>
		</div>		
	
		<br>
		<input data-role="button" data-icon="star" data-inline="true" data-theme="a" type="button" onclick="verifyConfirmationCode();" value="Redeem" />
	</div>
	<span class="info"> * Please use redeem at restaurant. Restaurant will enter the code.</span>
	<input type='hidden' name='mob_val_rwd_id' id='mob_val_rwd_id' value="" />
	<input type='hidden' name='mob_val_promotion' id='mob_val_promotion' value="" />
	<br><br>
	<div class="biz_center" >
		<input type="button" data-icon="delete" data-inline="true" onclick="$('#popup_mobile_validate').popup('close');" value="{$_lang.cancel_lbl}"/>
	</div>
	
</div>
