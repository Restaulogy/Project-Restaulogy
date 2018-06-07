<div data-role="popup" id="popupPromEmailConfirm" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
	<div data-role="header">
		<h1>Redeem Promotion</h1>
	</div>

	<form name='frm_prom_filt_detail_1' id="frm_prom_filt_detail_1" method="POST" action="{$elgg_main_url}modules/business_listing/show.php?show_type=PR&lid={$showing_promotion.list_id}&promoid={$promoid}" onsubmit="return validatePromEmailConfirm();" autocomplete="off">
	<div data-role="content" style="padding:5px;">

        <div class="biz_hidden">
			<label>Email/Phone</label>
            <input type='text' name='email_phone' id='email_phone' value="1" />
            <div id="email_phone_err" class="error"></div>
		</div>
		
		<div >
			<label>Server Pin</label>
            <input type='password' name='reward_code' id='reward_code' value="" />
            <div id="reward_code_err" class="error"></div>
		</div>

		<input type='hidden' name='prom_crm_id' id='prom_crm_id' value="{$prom_crm_id}" />
		<input type='hidden' name='use_this_prom' id='use_this_prom' value="{$prom_crm_id}" />

		<div class='biz_center'>
            <input type="submit" data-icon="save" data-inline="true" value="Claim"/>
    		<input type="button" data-icon="delete" data-inline="true" onclick="$('#popupPromEmailConfirm').popup('close');" value="{$_lang.cancel_lbl}"/>
        </div>
	</div>
	</form>
</div>

{literal}
<script type="text/javascript">
    function validatePromEmailConfirm(){
      var isErr = true;
       	$('#email_phone_err').html("");
        /*
        if(IsNonEmpty(elemById("email_phone").value) == false){
          	$('#email_phone_err').html("Email/Phone should not be empty.");
        	isErr = false;
        }else{
            if(isEmail(elemById("email_phone").value) == false){
                if(isPhoneNumber(elemById("email_phone").value) == false){
                    $('#email_phone_err').html("Email/Phone is not proper.");
    		        isErr = false;
                }
            }
        }
        */
        if(IsNonEmpty(elemById("reward_code").value) == false){
          	$('#reward_code_err').html("Server pin should not be empty.");
        	isErr = false;
        }
        if(isErr == false){
      		alert("Please revise the form");
        }
        return isErr;
    }
</script>
{/literal}
