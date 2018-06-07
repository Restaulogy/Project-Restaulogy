{include file="header.tpl"}
<div class="wrapper" id='loginForm'>
		<h1>Reward sign up</h1>
		<form method="POST" action="{$website}/user/cust_login.php" name="myForm" onsubmit="return validateLoginForm();">
		{if $error_msg} 
		 	<div class="field-row clearfix">
				<div class="error">{$error_msg}</div>
			</div> 
		{/if}

			<div class="field-row">
				<p><label>Phone * :</label></p>
				<p><input type="text" id="phone" name="phone" value="{$smarty.request.phone}"/>
				<div id="phone_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row">
				<p><label>Email  :</label></p>
				<p><input type="text" id="username"  name="username" value="{$smarty.request.username}"> <div id="loginemailerr" class="error"></div></p>

			</div><!--/.field-row-->
			
			<div class="biz_hidden" >
				<p><label>Password *:</label></p>
				<p><input type="password" id="password" value=""  name="password"><div id="loginpassworderr" class="error"></div></p>
				 
			</div><!--/.field-row--> 
			
			<div class="field-row">
				<p><label>Name *:</label></p>
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

			<div class="field-row" style="display:none;">
				<p><label>{$_lang.remember_me}</label></p> 
				<p> <input type="checkbox" name="autologin" value="1" />&nbsp;<small class="info">{$_lang.dont_use_public}</small></p>
				 
			</div><!--/.field-row-->
			
			<div class="biz_hidden" >
				<p><label>
                Subscribe :
                <input type="checkbox" value="1" {if $smarty.post.sms_subscribed eq  1}checked='checked'{/if} id="sms_subscribed" name="sms_subscribed"/>
                </label>
				<div id="sms_subscribed_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
						
			<div >
				<p><label>DOB :</label></p>
				<p>
				<table>
					<tr>
						<td>
							<input type="text" id="cust_dob_day" name="cust_dob_day" style="width:30px;" value="{$smarty.request.cust_dob_day}"/> 
						</td>
						<td>
							&nbsp; / &nbsp;
						</td>
						<td>
							<select id="cust_dob_mon" name="cust_dob_mon">	
								<option value="0">Month</option>							
								<option value="1">Jan</option>
								<option value="2">Feb</option>
								<option value="3">Mar</option>
								<option value="4">Apr</option>
								<option value="5">May</option>
								<option value="6">Jun</option>
								<option value="7">Jul</option>
								<option value="8">Aug</option>
								<option value="9">Sept</option>
								<option value="10">Oct</option>
								<option value="11">Nov</option>
								<option value="12">Dec</option>
							</select>							
						</td>
					</tr>
				</table>
				
				<div id="cust_dob_day_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div >
				<p><label>Anniversary Date :</label></p>
				<p><input type="date" id="cust_aniversary_dt" name="cust_aniversary_dt" value="{$smarty.request.cust_aniversary_dt}" style="width:150px;" />
				<div id="cust_aniversary_dt_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
						
			<div class="field-row" style="display:none;">
		 	<p><label><a href="{$website}/user/forgot.php">{$_lang['forgot_password']}</a></label></p> 
			</div> 
			
			<div>
				<p><label>
                {$_lang['biz_rewards']['agree_trans_prom']}
                <input type="checkbox" value="1" checked='checked' id="usr_aggrement" name="usr_aggrement"/>
                </label>
				<div id="usr_aggrement_err" class="error"></div>
				</p>
			</div><!--/.field-row-->
			
			<div class="field-row clearfix">
				<p>
				<input type='hidden' id='web_redt' name='web_redt' value='{$web_redt}' />
				<input data-inline="true" data-icon="save" name="login" tabindex="7" value="Sign Up" type="submit">
				{if $web_redt eq 1}
				{else}
                    <input type="button" data-icon="delete" data-inline="true" onclick="window.location.href='{$website}/user/login.php';" value="{$_lang.cancel_lbl}" />
                {/if}
               <!--
                <input type="button" data-icon="delete" data-inline="true" onclick="window.location.href='{$website}/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR'" value="{$_lang.cancel_lbl}" />
               -->
               
                </p>
			</div><!--/.field-row-->
		</form><!--/#reservation-form-->
		<div class="info"> Note: &nbsp * marked fields are mandatory.</div>
<!--
<div data-role="popup" id="popupAlrdyExt" data-dismissible="true" style="width:270px;border:5px solid #333;padding:5px;" data-overlay-theme="f">
       <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
      <div data-role="header">
	  <h1>Already signed up</h1>
	  </div>
	  <div class="content-primary">
		You are already signed-up with this service, when you joined the program at {$sec_rest_popup}.<br> Please sign in using same account.If you forgotten the password, you may reset it.
		<input data-inline="true" data-icon="save" value="Sign In" type="button" onclick="{$website}/user/login.php?pst_email={$username}">
      </div>
</div>
-->
		
	</div><!--/.wrapper-->
{literal}
<script type="text/javascript">

function chk_usr_already_there(){
          var isfound=0;
          if (document.getElementById('username').value != ""){
			var info = {};

			info['action'] = "chkUsrRestAlreadyExits";
			info['var1'] = document.getElementById('username').value;

			$.ajax({
	        type     : "POST",
	        url      : website + "/ajax/custom_functions.php" ,
			data	 : info,
	        dataType : "json",
			async	 : false,
	    	success  : function(response){
                  if(response){
                    
                   	if(response.is_already_there==0){
                      if(confirm('You are already signed-up with this service, when you joined the program at '+ response.sub_rest_lst +'.\r\n Please sign in using same account.If you forgotten the password, you may reset it.')==true){
                        isfound=0;
                      }else{
                        isfound=1;
                      }
                    }
                    alert('i am in ' + response.sub_rest_lst);
                    isfound=1;
                  }
                },
			error: function(objResponse){
				//alert(objResponse.responseText);
			}
		});

       }else{
		   //$('<option value="0">{/literal}{$_lang.select_city}{literal}</option>').appendTo(city);
	   }
	   //city.selectmenu('refresh', true);
	   return isfound;
}
 
function validateLoginForm(){
  var isErr = true;
   	$('#loginemailerr').html("");
	$('#loginpassworderr').html("");
	$('#phone_err').html("");
	$('#cust_dob_day_err').html("");
	 
    if(IsNonEmpty(elemById("username").value) == false){
      	//$('#loginemailerr').html("Email should not be empty.");
    	//isErr = false;
    }else{
      	if(isEmail(elemById("username").value) == false){
    	  	$('#loginemailerr').html("Email is not proper.");
    		isErr = false;
      	}
    }

  if(IsNonEmpty(elemById("password").value) == false){
  	//$('#loginpassworderr').html("Password should not be empty.");
	//isErr = false;
  }
  
  if(IsNonEmpty(elemById("full_name").value) == false){
  	$('#full_name_err').html("Name should not be empty.");
	isErr = false;
  }
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
  if(IsNonEmpty(elemById("phone").value) == false ){
	$('#phone_err').html("Phone should not be empty.");
	isErr = false;
  }else{
  	if(isPhoneNumber(elemById("phone").value) == false){
	  	$('#phone_err').html("Invalid Phone Number.Please Correct.");
		isErr = false;
  	}
  } 
  
  if((IsNonEmpty(elemById("cust_dob_day").value) == false) || (isInteger(elemById("cust_dob_day").value)==false)){
  	//$('#cust_dob_day_err').html("Date is mandatory.");
	//isErr = false;
  }else{    	  
  	  var dayfield = parseInt(elemById("cust_dob_day").value, 10);
	  var monthfield = parseInt(elemById("cust_dob_mon").value, 10);	    
  	  var dayobj = new Date(2016, monthfield-1, dayfield);
  	  if((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)){
  	  	$('#cust_dob_day_err').html("Invalid date.");
		isErr = false;
  	  }
  } 
  
  if(elemById("usr_aggrement").checked==false){
  		$('#usr_aggrement_err').html("You must agree this to sign up for the loyalty.");
		isErr = false;
  }
  
  if(isErr == false){
   		alert("Please Revise the form");
  }
  
  //if(chk_usr_already_there()==1){
  //      isErr = false;
  //}
  //isErr = false;
  return isErr;
}
</script>
{/literal}

{* if $sec_rest_popup neq ''}
    {literal}
    <script type="text/javascript">
    	 	$(function(){ $('#popupAlrdyExt').popup('open'); });
    </script>
    {/literal}
{/if *}

{include file="footer.tpl"}
