
{include file="header.tpl"}
<div class="wrapper" id='loginForm'>
		<h1>{$title}</h1>
		<form method="POST" action="{$website}/user/changepassword.php" name="myForm" onsubmit="return validatechangepassword();">
		{if $error_msg} 
		 	<div class="field-row clearfix">
				 {$error_msg} 
			</div> 
		{/if}
		
			<div class="field-row">
				<p><label>Current Password:</label></p>
				<p><input tabindex="1"  type="password" id="current_password" name="current_password" autocomplete="off"/><div id="current_password_err" class="error"></div></p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>New Password:</label></p>
				<p><input tabindex="1" <input type="password" id="new_password" name="new_password" autocomplete="off"/><div id="new_password_err" class="error"></div></p>
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Confirm Password:</label></p>
				<p><input tabindex="1" <input type="password" id="cpassword" autocomplete="off"/><div id="cpassword_err" class="error"></div></p>
			</div><!--/.field-row-->
			 
			<div class="field-row clearfix">
				<center><input data-inline="true" data-icon="reload" name="changepassword" value="{$_lang['reset_password']}" type="submit"/><input data-inline="true" data-icon="delete" value="{$_lang.cancel_lbl}" type="button" onclick="window.location.href='{$website}/user/editprofile'"/></center>
			</div><!--/.field-row-->
		</form><!--/#reservation-form-->
	</div><!--/.wrapper-->
{literal}
<script type="text/javascript">
function validatechangepassword(){
  var isErr = true;
   	$('#current_password_err').html("");
	$('#cpassword_err').html("");
	$('#new_password_err').html("");
  if(IsNonEmpty(elemById("current_password").value) == false){
  	$('#current_password_err').html("Current Password should not be empty.");
	isErr = false;
  }
  
  
	
  if(IsNonEmpty(elemById("new_password").value) == false){
  	$('#new_password_err').html("Password should not be empty.");
	isErr = false;
  }else{
  	if(elemById("current_password").value == elemById("new_password").value){
        $('#new_password_err').html("Current & New password should not match.");
		isErr = false;
	}
  
  	if(elemById("cpassword").value != elemById("new_password").value){
        $('#cpassword_err').html("Password must match.");
		isErr = false;
	}
  }
  
  if(IsNonEmpty(elemById("cpassword").value) == false){
  	$('#cpassword_err').html("Confirm Password should not be empty.");
	isErr = false;
  }
  return isErr;
}
</script>
{/literal} 

{include file="footer.tpl"}

 
