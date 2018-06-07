<div class="wrapper" id='loginForm'>
		<h1>{$_lang.sign_in}</h1>
		<form method="POST" action="{$website}/user/process.php?r=reg" name="myForm" onsubmit="return validateLoginForm();">
		{if $error_msg} 
		 	<div class="field-row clearfix">
				<div class="error">{$error_msg}</div>
			</div> 
		{/if}
		
			<div class="field-row">
				<p><label>Email:</label></p>
				<p><input type="text" id="username" name="username" value="{$smarty.request.pst_email}"> <div id="loginemailerr" class="error"></div></p>
				
			</div><!--/.field-row-->
			<div class="field-row">
				<p><label>Password:</label></p>
				<p><input type="password" id="password" name="password"><div id="loginpassworderr" class="error"></div></p>
				 
			</div><!--/.field-row-->
			{if ($restaurant gt 0 && $smarty.session[$smarty.const.SES_TABLE] gt 0)}
                <input type="hidden" name="restaurant" id="restaurant" value="{$restaurant}" />&nbsp;
            {elseif ($smarty.session[$smarty.const.SES_RESTAURANT] gt 0 && $smarty.session[$smarty.const.SES_TABLE] gt 0) }
                <input type="hidden" name="restaurant" id="restaurant" value="{$smarty.session[$smarty.const.SES_RESTAURANT]}" />&nbsp;
    		{else}
                <div class="field-row">
       	            <p><label>Restaurant :</label></p>
    				<p>
    				<input type="hidden" name="restaurant" id="restaurant" value="{$restaurant}" /><br>
                    <ul id="suggestions" data-filter="true" data-filter-reveal="true" data-role="listview" data-inset="true" data-input="#search_rest" data-theme="a" data-filter-placeholder="Search Restaurant" data-theme="a">
                       {foreach $restaurant_list as $restaurant}
                         <li><a href="#" onclick="update_rest({$restaurant@key},'{$restaurant}');">{$restaurant}</a></li>
    				   {/foreach}
                    </ul>
    				
                    <!--
                    <select name="restaurant" id="restaurant">
                       {foreach $restaurant_list as $restaurant}
    				       <option value="{$restaurant@key}">{$restaurant}</option>
    				   {/foreach}
                    </select>
                    -->
    				<div id="restaurant_err" class="error"></div>
    				</p>
        		</div><!--/.field-row-->
    		{/if}
			<div class="biz_hidden">
				<p><label>{$_lang.remember_me}</label></p> 
				<p> <input type="checkbox" name="autologin" value="1" />&nbsp;<small class="info">{$_lang.dont_use_public}</small></p>
				 
			</div><!--/.field-row-->
			<div class="field-row">
		 	<p><label><a href="{$website}/user/forgot.php">{$_lang['forgot_password']}</a></label></p> 
			</div> 
			<div class="field-row clearfix">
				<div class="biz_center">
                <input data-inline="true" data-icon="shut-down" name="login" tabindex="7" value="{$_lang.sign_in}" type="submit">
                {if $smarty.session[$smarty.const.SES_TABLE] gt 0}
                    <input data-inline="true" data-icon="male-user"  value="{$_lang.join_now}" type="button" onclick="window.location.href='{$website}/user/cust_login'">
                {else}
                    <input data-inline="true" data-icon="male-user"  value="{$_lang.join_now}" type="button" onclick="window.location.href='{$website}/user/register'">
                {/if}
                </div>
			</div><!--/.field-row-->
		</form><!--/#reservation-form-->
        
        {if ($smarty.session[$smarty.const.SES_RESTAURANT] gt 0 && $smarty.session[$smarty.const.SES_TABLE] gt 0) }
            <h4> OR </h4><br>
            <h2> Login Using Facebook </h2>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=689014577831141&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false" data-scope="email,public_profile"></div>
        {/if}
        
		
	</div><!--/.wrapper-->
	
{include file="footercontent.tpl"}

{literal}
<script type="text/javascript">
$(function(){

    $("input[data-type='search']").change(function() {
      //alert( "Handler for .change() called." + $(this).val());
      if($(this).val()==""){
        $("#restaurant").val('');
      }
    });
    
 {/literal}
    {if $restaurant_name neq ''}
 {literal}
        $("input[data-type='search']").val("{/literal}{$restaurant_name}{literal}");
 {/literal}
    {/if}
 {literal}
 
 $(":input").each(function (i) { $(this).attr('tabindex', i + 1); });
    
});


function update_rest(rest_id,rest_name){
    if(rest_id > 0){
        $("#restaurant").val(rest_id);
        $("input[data-type='search']").val(rest_name);
        //$("#suggestions").listview().hide();
        //$("input[data-type='search']").bind('keyup', groupSelectHandler);
    }
}

var groupSelectHandler = function () {
    $(".suggestions").listview().show();
    $(".suggestions").listview("refresh");
    $("input[data-type='search']").unbind('keyup', groupSelectHandler);
}

function validateLoginForm(){
  var isErr = true;
   	$('#loginemailerr').html("");
	$('#loginpassworderr').html("");
	 
  if(IsNonEmpty(elemById("username").value) == false){
  	$('#loginemailerr').html("Email should not be empty.");
	isErr = false;
  }else{
  	if(isEmail(elemById("username").value) == false){
	  	$('#loginemailerr').html("Email is not proper.");
		isErr = false;
  	}
  }
  
  if(IsNonEmpty(elemById("password").value) == false){
  	$('#loginpassworderr').html("Password should not be empty.");
	isErr = false;
  }
  if(IsNonEmpty(elemById("restaurant").value) == false){
  	$('#restaurant_err').html("Restaurant must be selected.");
	isErr = false;
  }
   if(isErr == false){
   		alert("Please Revise the form");
   }
	
  return isErr;
}
</script>
{/literal}
</body></html>
