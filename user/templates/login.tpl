<div class="wrapper" id='loginForm'>
		<div class="biz_center"><img src="{$website}/images/restaurant/1.png" style="height:100px;" /></div>
		<h1>{if ($smarty.session[$smarty.const.SES_RESTAURANT] gt 0 || $smarty.session[$smarty.const.SES_TABLE] gt 0)}{else}Restaulogy &nbsp; {/if}{$_lang.sign_in}</h1>
		<form method="POST" action="{$website}/user/process.php?r=reg" name="myForm" onsubmit="return validateLoginForm();">
		{if $error_msg} 
		 	<div class="field-row clearfix">
				<div class="error">{$error_msg}</div>
			</div> 
		{/if}
            
			<div class="field-row">
				<p><label>Email/Phone:</label></p>
				{if $smarty.session.is_demo_usr}
                    <div class='error'>For demo purpose phone number is prefilled</div>
                {/if}
				<p><input type="text" id="username" name="username" value="{if $smarty.request.pst_email}{$smarty.request.pst_email}{elseif $smarty.session.is_demo_usr}{$smarty.session.is_demo_usr}{/if}" placeholder="Email/Phone"><div id="loginemailerr" class="error"></div></p>
				
			</div><!--/.field-row-->
			{if $fin_dup_ph_email_lst}
             <p><label>Select Email:</label></p>
			 <select name="lst_dup_php_em" id="lst_dup_php_em">
               {foreach $fin_dup_ph_email_lst as $_ech_em}
			       <option value="{$_ech_em@key}">{$_ech_em}</option>
			   {/foreach}
             </select>
            {/if}
			
            {if ($smarty.session[$smarty.const.SES_TABLE] gt 0)}
                <input type="hidden" id="password" name="password" value="sample" />
            {else}
                 <div class="field-row">
    				<p><label>Password:</label></p>
    				<p><input type="password" id="password" name="password" placeholder="Password"><div id="loginpassworderr" class="error"></div></p>
    			</div><!--/.field-row-->
            {/if}
           
			
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
			
			
			
			<div class="field-row clearfix">
				<div class="biz_center">
                <input data-inline="true" data-icon="shut-down" name="login" tabindex="7" value="{$_lang.sign_in}" type="submit">
                {if $smarty.session[$smarty.const.SES_TABLE] gt 0}
                    <input data-inline="true" data-icon="male-user"  value="{$_lang.join_now}" type="button" onclick="window.location.href='{$website}/user/cust_login'" />
                {else}
                	<!--
                    <input data-inline="true" data-icon="male-user"  value="Customer Login" type="button" onclick="window.location.href='{$website}/user/dashboard'" />
                    
                    <input data-inline="true" data-icon="male-user"  value="{$_lang.join_now}" type="button" onclick="window.location.href='{$website}/user/register'" />
                    -->
                {/if}
                <br><br>
                {if ($smarty.session[$smarty.const.SES_TABLE] gt 0)}
				{else}
	    			<div class="field-row">
	    		 	    <p><label><a href="{$website}/user/forgot.php">{$_lang['forgot_password']}</a></label></p>
	    			</div>
	            {/if}
                </div>
			</div><!--/.field-row-->
		</form><!--/#reservation-form-->
		
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
    /*
  if(IsNonEmpty(elemById("username").value) == false){
  	$('#loginemailerr').html("Email should not be empty.");
	isErr = false;
  }else{
  	if(isEmail(elemById("username").value) == false){
	  	$('#loginemailerr').html("Email is not proper.");
		isErr = false;
  	}
  }
  */
  
  if(IsNonEmpty(elemById("username").value) == false){
      	$('#loginemailerr').html("Email/Phone should not be empty.");
    	isErr = false;
  }else{
        if(isEmail(elemById("username").value) == false){
            if(isPhoneNumber(elemById("username").value) == false){
                $('#loginemailerr').html("Email/Phone is not proper.");
    		    isErr = false;
            }
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
