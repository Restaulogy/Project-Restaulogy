{include file='header.tpl'}
<div class="wrapper" id="registerForm">
		<h1>{$_lang.join_now}</h1>
		
		<form method="POST" action="{$website}/user/register.php" id='frm_register' name='frm_register' onsubmit="return validateRegisterForm();">
		<!-- <input type="hidden" name="member_role_id" value="1"/> -->
			{if $error_msg} 
		 	<div class="field-row clearfix">
				 {$error_msg}
			</div> 
			{/if}

			<div class="field-row">
				<p><label>First Name* :</label></p>
				<p><input tabindex="1" type="text" id="fname" name="fname"/>
				<div id="fname_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Last Name* :</label></p>
				<p><input tabindex="2" type="text" id="lname" name="lname"/>
				<div id="lname_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			 
			<div class="field-row">
				<p><label>Email* :</label></p>
				<p><input tabindex="3" type="email" id="email" name="email"/>
				<div id="email_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row">
				<p><label>Password* :</label></p>
				<p><input tabindex="4" type="password" id="password" name="password"/>
				<div id="password_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row">
				<p><label>Confirm Password* :</label></p>
				<p><input tabindex="5" type="password" id="cpassword" name="cpassword"/>
				<div id="cpassword_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
              
			<div class="field-row">
				<p><label>Phone * :</label></p>
				<p><input type="text" id="phone" name="phone"/>
				<div id="phone_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			{if $smarty.request.isManager eq 1}
    			<input type="hidden" value="{$smarty.const.ROLE_MANAGER}"  name="member_role_id" id="member_role_id"/>
    			<input type="hidden" value="{$smarty.request.restaurant}"  name="restaurant" id="restaurant"/>
    			<input type="hidden" value="1"  name="isManager"/>
			{else}
    			<div >
       	            <p><label>Type* :</label></p>
    				<p>
                    <select name="member_role_id" id="member_role_id">
                        <option value="4" selected="selected">Customer</option>
                        <option value="1">Employee</option>
                    </select>
    				<div id="member_role_id_err" class="error"></div>
    				</p>
    			</div><!--/.field-row-->
    			<div >
       	            <p><label>Restaurant* :</label></p>
    				<p>
    			<!--
                <input type="text" name="restaurant" id="restaurant" value="1">
                -->
                    <select name="restaurant" id="restaurant">
                       {foreach $restaurant_list as $restaurant}
					       <option value="{$restaurant@key}">{$restaurant}</option>
					   {/foreach}
                    </select>
    				<div id="restaurant_err" class="error"></div>
    				</p>
    			</div><!--/.field-row-->
			{/if}
			
			<div class="field-row" style="display:none;">
				<p><label>Designation :</label></p>
				<p>
					<input type="text" id="designation" name="designation"/>
				  <div id="designation_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row" style="display:none;">
				<p><label>Description :</label></p>
				<p>
					<textarea id="description" name="description"></textarea>
				  <div id="description_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row" style="display:none;">
				<p><label>City :</label></p>
				<p>
				<input type="text" id="city" name="city"/>
				<div id="city_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row" style="display:none;">
				<p><label>Country :</label></p>
				<p><input type="text" id="country" name="country" value="US"/>
				<div id="country_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row" style="display:none;">
				<p><label>State :</label></p>
				<p>
					<select id="state" name="state" onchange="change_metro_area_by_state('state','metro');">
						<option value="">{$_lang.select_states}</option>
						{if $state_list}
						{foreach $state_list as $state}
							<option value="{$state@key}">{$state}</option>
						{/foreach}
						{/if}
					</select>
					<div id="state_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row" style="display:none;">
				<p><label>Metro Area :</label></p>
				<p>
					<select id="metro" name="metro">
						<option value="">{$_lang.select_metro_area}</option>
					</select>
					<div id="metro_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			 
			<div class="field-row" style="display:none;">
				<p><label>Address :</label></p>
				<p><textarea id="address" name="address"></textarea>
				<div id="address_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			
			<div class="field-row" style="display:none;">
				<p><label>Zip :</label></p>
				<p><input type="text" id="zip" name="zip"/>
				<div id="zip_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			

			<div class="field-row" style="display:none;">
				<p><label>fax :</label></p>
				<p><input type="text" id="fax" name="fax"/>
				<div id="fax_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row" style="display:none;">
				<p><label>website :</label></p>
				<p><input type="text" id="website" name="website"/>
				<div id="website_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row" >
				<p><label>
                Subscribe to SMS :
                <input type="checkbox" value="1" {if $smarty.post.sms_subscribed eq  1}checked='checked'{/if} id="sms_subscribed" name="sms_subscribed"/>
                </label>
				<div id="sms_subscribed_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="biz_hidden">
				<p><label>Verification Code* :</label></p>
				<p><img src="{$website}/modules/captcha/visual-captcha.php" width="200" height="60" alt="Visual CAPTCHA" /><br/>
		<input type="text" name="user_code" id="user_code" size="25" /><div id="user_code_err" class="error"></div></p>
				
			</div><!--/.field-row-->
			<div class="field-row"><p class='notice'>{$_lang.messages.mandatory_fields}</p></div>
			<div class="field-row clearfix">
				<center><input data-inline="true" data-icon="save" value="{$_lang.join_now}" name="join" type="submit"/> <input data-inline="true" data-icon="shut-down" value="Sign In" type="button" onclick="window.location.href='{$website}/user/login'"/></center>
				<!--<button type="button" onclick="validateRegisterForm();">Valid</button>-->
			</div><!--/.field-row-->
			
		</form><!--/#reservation-form-->
	</div><!--/.wrapper-->
	

{literal}
<script type="text/javascript">
function validateRegisterForm(){
	var isErr = true;
  	$('#fname_err').html("");
	$('#lname_err').html("");
	$('#email_err').html("");
	$('#password_err').html("");
	$('#cpassword_err').html(""); 
	$('#zip_err').html("");
	$('#address_err').html("");  
	$('#phone_err').html(""); 
	$('#restaurant_err').html(); 
	$('#fax_err').html("");
	$('#website_err').html("");
	$('#city_err').html("");
	$('#metro_area_err').html("");
	$('#state_err').html("");
	$('#country_err').html("");
	$('#user_code_err').html(""); 
   if(IsNonEmpty(elemById("fname").value) == false){
  	$('#fname_err').html("First Name should not be empty.");
	isErr = false;
  }
  if(IsNonEmpty(elemById("lname").value) == false){
  	$('#lname_err').html("Last Name should not be empty.");
	isErr = false;
  }
  
  
  if(IsNonEmpty(elemById("email").value) == false){
  	$('#email_err').html("Email should not be empty.");
	isErr = false;
  }else{
  	if(isEmail(elemById("email").value) == false){
	  	$('#email_err').html("Email is not proper.");
		isErr = false;
  	}
  }
  
  if(IsNonEmpty(elemById("zip").value)){
/*
  	$('#zip_err').html("Zip should not be empty.");
	isErr = false;
  }else{
*/
  	if(isUSZip(elemById("zip").value) == false){
	  	$('#zip_err').html("Zip is not proper.");
		isErr = false;
  	}
  }
  
  if(IsNonEmpty(elemById("phone").value) == false ){

	$('#phone_err').html("Phone should not be empty.");
	isErr = false;
  }else{

  	if(isPhoneNumber(elemById("phone").value) == false){
	  	$('#phone_err').html("Phone is not proper.");
		isErr = false;
  	}
  }
  
   if(IsNonEmpty(elemById("fax").value)){
   /*
$('#fax_err').html("Fax should not be empty.");
	isErr = false;
  }else{
*/
  	if(isPhoneNumber(elemById("fax").value) == false){
	  	$('#fax_err').html("Fax is not proper.");
		isErr = false;
  	}
  }
  
  if(is_gt_zero_num(elemById("restaurant").value) == false){
  	$('#restaurant_err').html("Please Select Restaurant.");
	isErr = false;
  }
  
  
  /*
if(IsNonEmpty($("#address").val()) == false){
  	$('#address_err').html("Address should not be empty.");
	isErr = false;
  }

   if(IsNonEmpty($("#description").val()) == false){
  	$('#description_err').html("Description should not be empty.");
	isErr = false;
  }

  if(IsNonEmpty($("#designation").val()) == false){
  	$('#designation_err').html("Designation should not be empty.");
	isErr = false;
  }

   if(IsNonEmpty($("#website").val()) == false){
  	$('#website_err').html("Website should not be empty.");
	isErr = false;
  }



 if(IsNonEmpty(elemById("city").value) == false){
  	$('#city_err').html("Please enter city");
	isErr = false;
  } 
  
  if(IsNonEmpty(elemById("state").value) == false){
  	$('#state_err').html("Please enter state");
	isErr = false;
  } 
  
 if(IsNonEmpty(elemById("country").value) == false){
  	$('#country_err').html("Please enter country");
	isErr = false;
  }
  
 if(IsNonEmpty(elemById("metro").value) == false){
  	$('#metro_err').html("Please enter metro");
	isErr = false;
  } 
 */
  if(IsNonEmpty(elemById("password").value) == false){
  	$('#password_err').html("Password should not be empty.");
	isErr = false;
  }else{
  	if(elemById("cpassword").value != elemById("password").value){			$('#cpassword_err').html("Password must match.");
		isErr = false;
	} 
  } 
  if(IsNonEmpty(elemById("cpassword").value) == false){
  	$('#cpassword_err').html("Confirm Password should not be empty.");
	isErr = false;
  }
  /*if(IsNonEmpty(elemById("user_code").value) == false){
  	$('#user_code_err').html("Verification code should not be empty.");
	isErr = false;
  }*/
   
  if(isErr == false){
    alert("Please Revise the form");
  }
	
  return isErr;
}
</script>
{/literal}
{include file='footer.tpl'}
