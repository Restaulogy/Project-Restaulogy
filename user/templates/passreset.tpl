
{include file="header.tpl"}
<div class="wrapper" id='loginForm'>
		<h1>{$title}</h1>
{if $error_msg eq ''}
		<form method="POST" action="{$website}/user/passreset.php" name="myForm" onsubmit="return validatechangepassword();">
	
			<div class="field-row">
				<p><label>New Password:</label></p>
				<p><input tabindex="1" <input type="password" id="new_password" name="new_password" autocomplete="off"/><div id="new_password_err" class="error"></div></p>
			</div><!--/.field-row-->
			
			<div class="field-row">
				<p><label>Confirm Password:</label></p>
				<p><input tabindex="1" <input type="password" id="cpassword" autocomplete="off"/><div id="cpassword_err" class="error"></div></p>
			</div><!--/.field-row-->

			<div class="field-row clearfix">
				<div class='biz_center'>
				
				<input name="k" value="{$k}" type="hidden"/>
				<input name="u" value="{$u}" type="hidden"/>

                <input data-inline="true" data-icon="reload" name="changepassword" value="{$_lang['reset_password']}" type="submit"/>
                <!-- <input data-inline="true" data-icon="delete" value="{$_lang.cancel_lbl}" type="button" onclick="window.location.href='{$website}/user/editprofile'"/>-->
                </div>
			</div><!--/.field-row-->
		</form><!--/#reservation-form-->
{else}
 	<div class="field-row clearfix">
		 {$error_msg}
	</div>
{/if}
	</div><!--/.wrapper-->
{literal}
<script type="text/javascript">
function validatechangepassword(){
  var isErr = true;
   	//$('#current_password_err').html("");
	$('#cpassword_err').html("");
	$('#new_password_err').html("");


  if(IsNonEmpty(elemById("new_password").value) == false){
  	$('#new_password_err').html("Password should not be empty.");
	isErr = false;
  }else{
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


