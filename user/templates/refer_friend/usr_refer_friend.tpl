{include file="header.tpl"}
<div class="wrapper" id='loginForm'>
		<h1>Refer a friend</h1>		
		
		{if $_is_sms_sent eq 1} 
			<b>You need to follow these steps for getting award points.</b><br><br>
		 	<p>
		 		<table class="listTable">
					<tr>
						<th> STEP-A] </th>
					</tr>
					<tr>
						<td class="">  You will receive a sms with link to promotion. </td>
					</tr>
					<tr>
						<th> STEP-B] </th>
					</tr>
					<tr>
						<td>  You have to forward the sms to your friends.  </td>
					</tr>
					<tr>
						<th> STEP-C] </th>
					</tr>
					<tr>
						<td>  Your friend will redeem the promotion.  </td>
					</tr>
					<tr>
						<th> STEP-D] </th>
					</tr>
					<tr>
						<td>  You will be rewarded with the points. </td>
					</tr>
			 </table>
		 	</p> 
	   {elseif $ref_by gt 0 && $_refer_frnd_id eq 0}
		   <form method="POST" action="{$website}/user/usr_refer_friend.php" name="mycustForm" onsubmit="return validateLoginForm();">
			
			    <b class="info">Please provide your phone and server pin to claim promotion</b><br><br>
				<div class="field-row">
					<p><label>Phone * :</label></p>
					<p><input type="text" id="phone" name="phone" value="{$phone}"/>
					<div id="phone_err" class="error"></div>
					</p>
				</div><!--/.field-row-->
				
				<div class="field-row">
					<p><label>Server pin * :</label></p>
					<p><input type="password" id="server_pin" name="server_pin" value="{$smarty.request.server_pin}"/>
					<div id="server_pin_err" class="error"></div>
					</p>
				</div><!--/.field-row-->
							
				<div class="field-row clearfix">
					<p>
					<input type="hidden" name="promoid" value="{$promoid}" />
					<input type="hidden" name="ref_by" value="{$ref_by}" />
					<input type="hidden" name="promoid" value="{$promoid}" />
					
					<input type="hidden" name="act_to_do" value="CREATE_CUST_LOGIN" />
					<input data-inline="true" data-icon="save" name="custlogin" tabindex="7" value="Submit" type="submit">	
	                </p>
				</div><!--/.field-row-->			
				
			</form><!--/#reservation-form-->	
	   {elseif $ref_by eq 0}
		<form method="POST" action="{$website}/user/usr_refer_friend.php" name="myForm" onsubmit="return validateLoginForm();">
		
		    <b>Please provide your phone to proceed</b><br><br>
			<div class="field-row">
				<p><label>Phone * :</label></p>
				<p><input type="text" id="phone" name="phone" value="{$smarty.request.phone}"/>
				<div id="phone_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
						
			<div class="field-row clearfix">
				<p>
				<input type="hidden" name="promoid" value="{$promoid}" />
				<input type="hidden" name="act_to_do" value="CREATE_LOGIN" />
				<input data-inline="true" data-icon="save" name="login" tabindex="7" value="Submit" type="submit">	
                </p>
			</div><!--/.field-row-->			
			
		</form><!--/#reservation-form-->
		<!--<div class="info"> Note: &nbsp * marked fields are mandatory.</div>-->
		{/if}
		<br><br>	
		
		{include file="refer_friend/viewpromotions_display.tpl"}		
	
</div><!--/.wrapper-->
{literal}
<script type="text/javascript">

	function validatePin(){
	  var isErr = true;
	  $('#server_pin_err').html("");
		 
	  if(IsNonEmpty(elemById("server_pin").value) == false ){
		$('#server_pin_err').html("Server pin should not be empty.");
		isErr = false;
	  }
	  
	  if(isErr == false){
	   		alert("Please Revise the form");
	  }  	  
	  return isErr;
	}
	
	function validateLoginForm(){
	  var isErr = true;
	  $('#phone_err').html("");
	  $('#server_pin_err').html("");
		 
	  if(IsNonEmpty(elemById("phone").value) == false ){
		$('#phone_err').html("Phone should not be empty.");
		isErr = false;
	  }else{
	  	if(isPhoneNumber(elemById("phone").value) == false){
		  	$('#phone_err').html("Invalid Phone Number.Please Correct.");
			isErr = false;
	  	}
	  }	   
		 
	  if(IsNonEmpty(elemById("server_pin").value) == false ){
		$('#server_pin_err').html("Server pin should not be empty.");
		isErr = false;
	  }
	  
	  if(isErr == false){
	   		alert("Please Revise the form");
	  }  	  
	  return isErr;
	}

</script>
{/literal}

{include file="footer.tpl"}