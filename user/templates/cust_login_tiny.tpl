{include file="header.tpl"}
<div class="wrapper" id='loginForm'>
		<h1>{if $is_email_friend==1}Email promotion{else}Subscribe{/if}</h1>
		<form method="POST" action="{$website}/user/cust_login_tiny.php" name="myForm" onsubmit="return validateLoginForm();">
		{if $error_msg} 
		 	<div class="field-row clearfix">
				<div class="error">{$error_msg}</div>
			</div> 
		{/if}
		
            <div class="{if $is_email_friend==1}biz_hidden{else}field-row{/if}">
				<p><label>Name :</label></p>
				<p><input type="text" id="full_name" name="full_name" value="{$smarty.request.full_name}"/>
				<div id="full_name_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
		
            <div class="biz_hidden">
				<p><label>First Name *:</label></p>
				<p><input  type="text" id="fname" name="fname" value="{$smarty.request.fname}"/>
				<div id="fname_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			<div class="biz_hidden">
				<p><label>Last Name *:</label></p>
				<p><input  type="text" id="lname" name="lname" value="{$smarty.request.lname}"/>
				<div id="lname_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
		
			<div class="field-row">
				<p><label>{if $is_email_friend==1}Friends {/if} Email * :</label></p>
				<p><input  type="text" id="username" name="username" value="{$smarty.request.username}"> {if $is_email_friend==1}<div class="info">For multiple emails separate with comma.</div>{/if}<div id="loginemailerr" class="error"></div></p>
				
			</div><!--/.field-row-->
			
			<div class="biz_hidden">
				<p><label>Verify Email * :</label></p>
				<p><input  type="text" id="verify_email"  name="verify_email" value="{$smarty.request.verify_email}"> <div id="verify_email_err" class="error"></div></p>

			</div><!--/.field-row-->
			
			<div id='div_phone_id' class="{if $is_email_friend==1}biz_hidden{else}field-row{/if}">
				<p><label> Phone  :</label></p>
				<p><input type="text" id="phone" name="phone"/>
				<div id="phone_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row" style="display:none;">
				<p><label>Password *:</label></p>
				<p><input type="password" id="password" value="sample"  name="password"><div id="loginpassworderr"  class="error"></div></p>
				 
			</div><!--/.field-row-->

            <div id='div_email_from' class="{if $is_email_friend eq 1}field-row{else}biz_hidden{/if}">
				<p><label>Your Email dfdsf* :</label></p>
				<p><input  type="text" id="email_from"  name="email_from" value="{if $smarty.session.user}{$smarty.session.user}{else}{$smarty.request.email_from}{/if}"> <div id="email_from_err" class="error"></div></p>

			</div><!--/.field-row-->
			
			<div class="field-row" style="display:none;">
				<p><label>{$_lang.remember_me}</label></p> 
				<p> <input type="checkbox" name="autologin" value="1" />&nbsp;<small class="info">{$_lang.dont_use_public}</small></p>
				 
			</div><!--/.field-row-->
			
			<div class="biz_hidden">
				<p><label>
                Subscribe to SMS :
                <input type="checkbox" value="1" id="sms_subscribed" name="sms_subscribed"/>
                </label>
				<div id="sms_subscribed_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row" style="display:none;">
		 	<p><label><a href="{$website}/user/forgot.php">{$_lang['forgot_password']}</a></label></p> 
			</div> 
			<div class="field-row clearfix">
				<p>
                <input data-icon="save" data-inline="true" name="login" tabindex="7" value="Submit" type="submit">
                <input type="button" data-icon="delete" data-inline="true" onclick="window.location.href='{$website}/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR'" value="{$_lang.cancel_lbl}"/>
                </p>
			</div><!--/.field-row-->
			<input type="hidden" id='prom_id' name='prom_id' value={$prom_id}>
			<input type="hidden" id='is_email_friend' name='is_email_friend' value={$is_email_friend}>

		</form><!--/#reservation-form-->
	</div><!--/.wrapper-->
{literal}
<script type="text/javascript">
function validateLoginForm(){
  var isErr = true;
   	$('#loginemailerr').html("");
	$('#loginpassworderr').html("");
	$('#phone_err').html("");
	$('#email_from_err').html("");
	
	 
    if(IsNonEmpty(elemById("username").value) == false){
      	$('#loginemailerr').html("Email should not be empty.");
    	isErr = false;
    }else{
        if(elemById("is_email_friend").value == 1){
            str_email=elemById("username").value;
            if (str_email.indexOf(",") >= 0){
                var arr_lst = str_email.split(',');
                var err_txt='';
                for (a in arr_lst ) {
                   if(isEmail(arr_lst[a]) == false){
                	  	err_txt= err_txt + arr_lst[a] + " email is not proper. \n";
                	  	$('#loginemailerr').html(err_txt);
                		isErr = false;
                  	}
                }
            }else{
                if(isEmail(elemById("username").value) == false){
            	  	$('#loginemailerr').html("Email is not proper.");
            		isErr = false;
              	}
            }
        }else{
            if(isEmail(elemById("username").value) == false){
        	  	$('#loginemailerr').html("Email is not proper.");
        		isErr = false;
          	}
        }
    }
    
    
    /*
    if(IsNonEmpty(elemById("verify_email").value) == false){
      	$('#verify_email_err').html("Verify Email should not be empty.");
    	isErr = false;
    }else{
      	if(isEmail(elemById("verify_email").value) == false){
    	  	$('#verify_email_err').html("Verify Email is not proper.");
    		isErr = false;
      	}
      	if(elemById("verify_email").value != elemById("username").value){
    	  	$('#verify_email_err').html("Email and Verify Email should match.");
    		isErr = false;
      	}
    }
    */
     if(elemById("is_email_friend").value == 1){
        if(IsNonEmpty(elemById("email_from").value) == false){
          	$('#email_from_err').html("Your Email should not be empty.");
        	isErr = false;
        }else{
          	if(isEmail(elemById("email_from").value) == false){
        	  	$('#email_from_err').html("Your Email is not proper.");
        		isErr = false;
          	}
        }
     }else{
       /*
          if(IsNonEmpty(elemById("fname").value) == false){
          	$('#fname_err').html("First name should not be empty.");
        	isErr = false;
          }
          if(IsNonEmpty(elemById("lname").value) == false){
          	$('#lname_err').html("Last name should not be empty.");
        	isErr = false;
          }
        */
     }
  /*
  if(IsNonEmpty(elemById("password").value) == false){
  	$('#loginpassworderr').html("Password should not be empty.");
	isErr = false;
  }
  alert("step2" + isErr);
  
  if(IsNonEmpty(elemById("fname").value) == false){
  	$('#fname_err').html("First name should not be empty.");
	isErr = false;
  } 
  if(IsNonEmpty(elemById("lname").value) == false){
  	$('#lname_err').html("Last name should not be empty.");
	isErr = false;
  } 
	*/
 // if(IsNonEmpty(elemById("phone").value) == false ){
//	$('#phone_err').html("Phone should not be empty.");
//	isErr = false;
  //}else{
    if(IsNonEmpty(elemById("phone").value)){
      	if(isPhoneNumber(elemById("phone").value) == false){
    	  	$('#phone_err').html("Phone is not proper.");
    		isErr = false;
      	}
  	}
  //}
  if(isErr == false){
   		alert("Please Revise the form");
  }
  return isErr;
}
</script>
{/literal}

{include file="footer.tpl"}
