<div data-role="popup" id="popupPromFiltVal" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
	<div data-role="header">
		<h1>Redeem Promotion</h1>
	</div>

	<form name='frm_prom_filt_detail' id="frm_prom_filt_detail" method="POST" action="{$elgg_main_url}modules/business_listing/show.php?show_type=PR&lid={$showing_promotion.list_id}&promoid={$promoid}" onsubmit="return validatePromFilt();" autocomplete="off">
	<div data-role="content" style="padding:5px;">

        <div >
			<label>Email</label>
            <input type='text' name='email_val' id='email_val' value="" />
            <div id="email_val_err" class="error"></div>
            <!--
            <input type='hidden' name='confirm_email_val' id='confirm_email_val' value="{$prom_filt_email}" />
            <input type='hidden' name='confirm_phone_val' id='confirm_phone_val' value="{$prom_filt_phone}" />
            -->
		</div>
		
		<div >
			<label>Server Pin</label>
            <input type='password' name='reward_code_1' id='reward_code_1' value="" />
            <div id="reward_code_1_err" class="error"></div>
		</div>

		<input type='hidden' name='prom_filt_rwd' id='prom_filt_rwd' value="{$prom_filt_rwd}" />
		<input type='hidden' name='prom_filt_usr' id='prom_filt_usr' value="{$prom_filt_usr}" />
		<input type='hidden' name='_redeem' id='_redeem' value="1" />

		<div class='biz_center'>
            <input type="submit" data-icon="save" data-inline="true" value="Claim"/>
    		<input type="button" data-icon="delete" data-inline="true" onclick="$('#popupPromFiltVal').popup('close');" value="{$_lang.cancel_lbl}"/>
        </div>
	</div>
	</form>
</div>

{literal}
<script type="text/javascript">
    function validatePromFilt(){
      var isErr = true;
       	$('#email_val_err').html("");

        if(IsNonEmpty(elemById("email_val").value) == false){
          	$('#email_val_err').html("Email/Phone should not be empty.");
        	isErr = false;
        }else{
            if(isEmail(elemById("email_val").value) == false){
                if(isPhoneNumber(elemById("email_val").value) == false){
                    $('#email_val_err').html("Email/Phone is not proper.");
        		    isErr = false;
                }
          	}
        }
        
        if(IsNonEmpty(elemById("reward_code_1").value) == false){
          	$('#reward_code_1_err').html("Server pin should not be empty.");
        	isErr = false;
        }
        
        if(isErr == false){
      		alert("Please revise the form");
        }
        return isErr;
    }
</script>
{/literal}
