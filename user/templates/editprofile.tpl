{include file='header.tpl'}

{if $userinfo &&  $userinfo.member_id gt 0}
<div class="wrapper description" id="profile">
			
	<h1>My Profile</h1>
	<table class="listTable">
		<!--<tr><th class="fieldItem">{$_lang.field_title}</th>
			<th class="valueItem">{$_lang.value_title}</th>
		</tr> -->
		 
	<tr><td class="fieldItem">Name</td><td class="valueItem">{if $userinfo.full_name neq ""}{$userinfo.full_name}{else}--{/if}</td></tr>
	<tr><td class="fieldItem">Email</td><td class="valueItem">{if $userinfo.email neq ""}{$userinfo.email}{else}--{/if}</td></tr>
	<tr><td class="fieldItem">Designation</td><td class="valueItem">{if $userinfo.staff_desigation neq ""}{$userinfo.staff_desigation}{else}--{/if}</td></tr>
	<tr><td class="fieldItem">Description</td><td class="valueItem">{if $userinfo.staff_description neq ""}{$userinfo.staff_description}{else}--{/if}</td></tr> 
	<tr><td class="fieldItem">Address</td><td class="valueItem">{if $userinfo.address neq ""}{$userinfo.address}{else}--{/if}</td></tr>
	<tr><td class="fieldItem">City</td><td class="valueItem">{if $userinfo.staff_city neq ""}{$userinfo.staff_city}{else}--{/if}</td></tr>
	<tr><td class="fieldItem">State</td><td class="valueItem">{if $userinfo.state_name neq ""}{$userinfo.state_name}{else}--{/if}</td></tr>
	<tr><td class="fieldItem">Metro Area</td><td class="valueItem">{if $userinfo.metro_name neq ""}{$userinfo.metro_name}{else}--{/if}</td></tr>
	 
	<tr><td class="fieldItem">Country</td><td class="valueItem">{if $userinfo.staff_country neq ""}{$userinfo.staff_country}{else}--{/if}</td></tr>
	<tr><td class="fieldItem">Zip</td><td class="valueItem">{if $userinfo.staff_zip neq ""}{$userinfo.staff_zip}{else}--{/if}</td></tr> 
	<tr><td class="fieldItem">Phone</td><td class="valueItem">{if $userinfo.staff_phone neq ""}{$userinfo.staff_phone}{else}--{/if}</td></tr> 
	<tr><td class="fieldItem">Fax</td><td class="valueItem">{if $userinfo.staff_fax neq ""}{$userinfo.staff_fax}{else}--{/if}</td></tr>
	<tr><td class="fieldItem">Website</td><td class="valueItem">{if $userinfo.staff_website neq ""}{$userinfo.staff_website}{else}--{/if}</td></tr>
	<tr><td class="fieldItem">Subscribe to SMS</td><td class="valueItem">{if $userinfo.sms_subscribed eq 1} yes {else} no{/if}</td></tr>
	 
	<tr><td class="fieldItem">Password</td><td class="valueItem"><a href="{$website}/user/changepassword.php">Change Password</a></td></tr>

	<tr><td class="fieldItem">Joined At</td><td class="valueItem">{$userinfo.join}</td></tr>
	
</table>
		<div class="field-row clearfix"> 
		<center> <input data-inline="true" data-icon="edit" value="{$_lang.update_lbl}" onclick="$('#profile').hide();$('#updateForm').show();" type="button"/> </center>
		</div><!--/.field-row-->
</div>


<div class="wrapper" id="updateForm" style="display:none;">
		<h1>Edit Profile</h1>

		<form method="POST" action="{$website}/user/editprofile.php" id='frm_register' name='frm_register' onsubmit="return validateEditProfile();">
			{if $error_msg} 
		 	<div class="field-row clearfix">
				<div class="error">{$error_msg}</div>
			</div> 
			{/if}
			<div class="field-row">
				<p><label>Email:</label> {$userinfo.email} </p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>First Name:</label></p>
				<p><input tabindex="1" type="text" id="fname" name="fname" value="{$userinfo.first_name}"/>
				<div id="fname_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Last Name:</label></p>
				<p><input tabindex="2" type="text" id="lname" name="lname" value="{$userinfo.last_name}"/>
				<div id="lname_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Designation  :</label></p>
				<p>
					<input type="text" id="designation" name="designation" value="{$userinfo.staff_desigation}"/>
				  <div id="designation_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Description :</label></p>
				<p>
					<textarea id="description" name="description">{$userinfo.staff_description}</textarea>
				  <div id="description_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>City* :</label></p>
				<p>
				<input type="text" id="city" name="city" value="{$userinfo.staff_city}"/>
				<div id="city_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row" style="display:none;">
				<p><label>Country * :</label></p>
				<p><input type="text" id="country" name="country" value="{$userinfo.staff_country}"/>
				<div id="country_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>State * :</label></p>
				<p>
					<select id="state" name="state" onchange="change_metro_area_by_state('state','metro',{$userinfo.staff_metro});">
						<option value="">{$_lang.select_states}</option>
						{if $state_list}
						{foreach $state_list as $state}
							<option value="{$state@key}" {if $userinfo.staff_state eq $state@key}selected="selected"{/if}>{$state}</option>
						{/foreach}
						{/if}
					</select>
					<div id="state_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Metro Area * :</label></p>
				<p>
					<select id="metro" name="metro">
						<option value="">{$_lang.select_metro_area}</option>
						{if $metro_list}
						{foreach $metro_list as $metro}
							<option value="{$metro@key}" {if $userinfo.staff_metro eq $metro@key}selected="selected"{/if}>{$metro}</option>
						{/foreach}
						{/if}
					</select>
					<div id="metro_err" class="error"></div>
				</p>
			</div><!--/.field-row--> 
			
			<div class="field-row">
				<p><label>Zip *:</label></p>
				<p><input tabindex="3" type="text" id="zip" name="zip" value="{$userinfo.zip}"/>
				<div id="zip_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Phone *:</label></p>
				<p><input tabindex="3" value="{$userinfo.phone}" type="text" id="phone" name="phone"/>
				<div id="phone_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Address:</label></p>
				<p><textarea id="address" name="address">{$userinfo.address}</textarea>
				<div id="address_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row">
				<p><label>fax :</label></p>
				<p><input type="text" id="fax" name="fax" value="{$userinfo.staff_fax}"/>
				<div id="fax_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row" >
				<p><label>
                Subscribe to SMS :
                <input type="checkbox" value="1" {if $userinfo.sms_subscribed eq  1}checked='checked'{/if} id="sms_subscribed" name="sms_subscribed"/>
                </label>
				<div id="sms_subscribed_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row">
				<p><label>website :</label></p>
				<p><input type="text" id="website" name="website" value="{$userinfo.staff_website}"/>
				<div id="website_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="field-row clearfix">
                <input type="hidden" name='member_role_id' value="{$userinfo.member_role_id}"/>
	           <input type="hidden" name='member_id'  value="{$userinfo.member_id}"/>
				<p align="center"><input data-inline="true" data-icon="save" tabindex="7" value="{$_lang.save_lbl}" name="editprofile" type="submit"/> <input  data-inline="true" data-icon="delete"  value="{$_lang.cancel_lbl}" type="reset" onclick="$('#profile').show();$('#updateForm').hide();"/></p>
			</div><!--/.field-row-->
		</form><!--/#reservation-form-->
	</div><!--/.wrapper-->
{literal}
<script type="text/javascript">
function validateEditProfile(){
	var isErr = true;
	$('#fname_err').html("");
  	$('#fname_err').html("");
	$('#lname_err').html("");
	$('#email_err').html("");
	$('#zip_err').html("");
	
	$('#state_err').html("");
	$('#metro_err').html("");
	$('#city_err').html("");
	
	$('#address_err').html("");  
	$('#phone_err').html(""); 
	$('#fax_err').html(""); 
	$('#website_err').html(""); 
	
   if(IsNonEmpty(elemById("fname").value) == false){
  	$('#fname_err').html("First Name should not be empty.");
	isErr = false;
  }
  if(IsNonEmpty(elemById("lname").value) == false){
  	$('#lname_err').html("Last Name should not be empty.");
	isErr = false;
  }

    if(IsNonEmpty(elemById("city").value) == false){
      	$('#city_err').html("City should not be empty.");
    	isErr = false;
    }
    
    if(IsNonEmpty(elemById("state").value) == false){
      	$('#state_err').html("State should not be empty.");
    	isErr = false;
    }
    
    if(IsNonEmpty(elemById("metro").value) == false){
      	$('#metro_err').html("Metro should not be empty.");
    	isErr = false;
    }
  
 /* if(IsNonEmpty(elemById("email").value) == false){
  	$('#email_err').html("Email should not be empty.");
	isErr = false;
  }else{
  	if(isEmail(elemById("email").value) == false){
	  	$('#email_err').html("Email is not proper.");
		isErr = false;
  	}
  }*/
  
  if(IsNonEmpty(elemById("website").value) == false){
  	/*$('#website_err').html("website should not be empty.");
	isErr = false;*/
  }else{
	if(isUrl(elemById("website").value) == false){
	  	$('#website_err').html("{/literal}{$_lang.messages.validation.isUrl}{literal}");
		isErr = false;
  	}
  }
  
  if(IsNonEmpty(elemById("zip").value) == false){
  	$('#zip_err').html("Zip should not be empty.");
	isErr = false;
  }else{
  	if(isUSZip(elemById("zip").value) == false){
	  	$('#zip_err').html("{/literal}{$_lang.messages.validation.isUSZip}{literal}");
		isErr = false;
  	}
  }
  
  if(IsNonEmpty(elemById("phone").value) == false){
  	$('#phone_err').html("Phone should not be empty.");
	isErr = false;
  }else{
  	if(isPhoneNumber(elemById("phone").value) == false){
	  	$('#phone_err').html("Phone is not proper.");
		isErr = false;
  	}
  }
  
  if(IsNonEmpty(elemById("fax").value) == false){
  	/*$('#fax_err').html("fax should not be empty.");
	isErr = false;*/
  }else{
  	if(isPhoneNumber(elemById("fax").value) == false){
	  	$('#fax_err').html("fax is not proper.");
		isErr = false;
  	}
  }
  
  
  if(IsNonEmpty($("#address").val()) == false){
  	$('#address_err').html("Address should not be empty.");
	isErr = false;
  } 
  
 /* if(IsNonEmpty(elemById("password").value) == false){
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
  }*/
   
   if(isErr == false){
   		alert("Please Revise the form");
   }
	
  return isErr;
}
</script>
{/literal}
{else}
<div class="wrapper">
	<div class="field-row clearfix"> 
     <p class="error">NO USER SELECTED</p> 
	</div>
</div>
	
{/if}
{include file='footer.tpl'}
