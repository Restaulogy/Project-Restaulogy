
{include file="header.tpl"}
<div class="wrapper" id='loginForm'>
		<h1>{$_lang.forgot_password}</h1>
		<form method="POST" action="{$website}/user/forgot.php" name="myForm" onsubmit="return validateforgotPassword();">
		{if $error_msg} 
		 	<div class="field-row clearfix">
				<div class="error">{$error_msg}</div>
			</div> 
		{/if}
		
			<div class="field-row">
				<p><label>Email:</label></p>
				<p><input tabindex="1" type="text" id="email"  name="email"> <div id="loginemailerr" class="error"></div></p>
				
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Verification Code:</label></p>
				<p><img src="{$website}/modules/captcha/visual-captcha.php" width="200" height="60" alt="Visual CAPTCHA" /><br/>
		<input type="text" name="user_code" id="user_code" size="25" /><div id="user_code_err" class="error"></div></p>
				
			</div><!--/.field-row-->
			 
			<div class="field-row clearfix">
				<center><input data-inline="true" name="forgot" data-icon="reload" value="Send Password" type="submit"> <input data-inline="true" data-icon="shut-down" value="Sign In" type="button" onclick="window.location.href='{$website}/user/login'"></center>
			</div><!--/.field-row-->
		</form><!--/#reservation-form-->
	</div><!--/.wrapper-->
{literal}
<script type="text/javascript">
function validateforgotPassword(){
  var isErr = true;
   	$('#loginemailerr').html("");
	$('#loginpassworderr').html("");
	 
  if(IsNonEmpty(elemById("email").value) == false){
  	$('#loginemailerr').html("Email should not be empty.");
	isErr = false;
  }else{
  	if(isEmail(elemById("email").value) == false){
	  	$('#loginemailerr').html("Email is not proper.");
		isErr = false;
  	}
  }
  
/*  if(IsNonEmpty(elemById("password").value) == false){
  	$('#loginpassworderr').html("Password should not be empty.");
	isErr = false;
  }
   if(isErr == false){
   		alert("Please Revise the form");
   }
	*/
  return isErr;
}
</script>
{/literal} 

{include file="footer.tpl"}

 
