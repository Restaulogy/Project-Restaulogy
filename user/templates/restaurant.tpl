{include file='header.tpl'}


<div class='wrapper'>
<h1>{$_lang.restaurant.title}</h1>
{if $error_msg}
	{$error_msg}
	<br>
{/if} 
{if $restaurantinfo && $restaurantinfo.id gt 0} 
<div class="description" id="ViewRestaurant" style='display:{if $mode eq "update"}none{else}block{/if};'>
	<h4>{if $restaurantinfo.name neq ""}{$restaurantinfo.name}{else}--{/if}</h4>  
	<p>{if $restaurantinfo.address neq ""}{$restaurantinfo.address}{else}--{/if}</p>
	<p><b>in</b> {if $restaurantinfo.city_state neq ""}{$restaurantinfo.city_state}{else}--{/if}</p>
 
	<p><b>{$_lang.restaurant.label.phone_nos}&nbsp;:&nbsp;</b> {if $restaurantinfo.phone_nos neq ""}{$restaurantinfo.phone_nos}{else}--{/if}</p>  
	 
	 
	<p><b>{$_lang.restaurant.label.owner} </b><span>{if $restaurantinfo.owner_name neq ""}{$restaurantinfo.owner_name}{else}--{/if}</span>&nbsp<b>Posted </b><span>{if $restaurantinfo.friendly_start_date neq ""}{$restaurantinfo.friendly_start_date}{else}--{/if}</span></p> 
	<br> 
	<div class="field-row clearfix">
	 
	<input  class="fleft"  type="button" value="Update" onclick="$('#ViewRestaurant').hide();$('#FrmRestaurant').show();"/>
 
	</div>	
</div>

<form id="FrmRestaurant" action="{$website}/user/restaurant.php" method="post" name="FrmRestaurant" onsubmit="return validateRestaurant();" style='display:{if $mode eq "update"}block{else}none{/if};'>
 

<div class="field-row">
<p><label for="restaurent_name">{$_lang.restaurant.label.name}</label></p>
<p><input name="restaurent_name" id="restaurent_name" maxlength="250" type="text" value="{$restaurantinfo.name}">
<div class="error" id='restaurent_name_err'></div>
</p>
</div><!-- field-row -->

<div class="field-row" style="display:none">
<p><label for="restaurent_owner">{$_lang.restaurant.label.owner}</label></p>
<p><input name="restaurent_owner" id="restaurent_owner" maxlength="250" type="text" value="{$restaurantinfo.owner}">
<div class="error" id='restaurent_owner_err'></div>
</p>
</div><!-- field-row -->



<div class="field-row">
<p><label for="restaurent_address">{$_lang.restaurant.label.address}</label></p>
<p><textarea name="restaurent_address" id="restaurent_address" cols="15" rows="10">{$restaurantinfo.address}</textarea>
<div class="error" id='restaurent_address_err'></div></p> 
 
</div><!-- field-row --> 

<div class="field-row">
<p><label for="restaurent_country">{$_lang.restaurant.label.country}</label></p>
<p><input name="restaurent_country" id="restaurent_country" maxlength="250" type="text" value="{$restaurantinfo.country}">
<div class="error" id='restaurent_country_err'></div>
</p>
</div><!-- field-row -->
<div class="field-row">
<p><label for="restaurent_state">{$_lang.restaurant.label.state}</label></p>
<p><input name="restaurent_state" id="restaurent_state" maxlength="250" type="text" value="{$restaurantinfo.state}">
<div class="error" id='restaurent_state_err'></div>
</p>
</div><!-- field-row -->
<div class="field-row">
<p><label for="restaurent_city">{$_lang.restaurant.label.city}</label></p>
<p><input name="restaurent_city" id="restaurent_city" maxlength="250" type="text" value="{$restaurantinfo.city}">
<div class="error" id='restaurent_city_err'></div>
</p>
</div><!-- field-row -->
 
<div class="field-row">
<p><label for="restaurent_zip">{$_lang.restaurant.label.zip}</label></p>
<p><input name="restaurent_zip" id="restaurent_zip" maxlength="250" type="text" value="{$restaurantinfo.zip}">
<div class="error" id='restaurent_zip_err'></div>
</p>
</div><!-- field-row -->
<div class="field-row">
<p><label for="restaurent_phone_1">{$_lang.restaurant.label.phone_1}</label></p>
<p><input name="restaurent_phone_1" id="restaurent_phone_1" maxlength="250" type="text" value="{$restaurantinfo.phone_1}">
<div class="error" id='restaurent_phone_1_err'></div>
</p>
</div><!-- field-row -->
<div class="field-row">
<p><label for="restaurent_phone_2">{$_lang.restaurant.label.phone_2}</label></p>
<p><input name="restaurent_phone_2" id="restaurent_phone_2" maxlength="250" type="text" value="{$restaurantinfo.phone_2}">
<div class="error" id='restaurent_phone_2_err'></div>
</p>
</div><!-- field-row -->
<div class="field-row" style="display:none">
<p><label for="restaurent_start_date">{$_lang.restaurant.label.start_date}</label></p>
<p><input name="restaurent_start_date" id="restaurent_start_date" maxlength="" type="text" value="{$restaurantinfo.start_date}"/>
<div class="error" id='restaurent_start_date_err'></div></p>
</div><!-- field-row -->

<div class="field-row"  style="display:none">
<p><label for="restaurent_end_date">{$_lang.restaurant.label.end_date}</label></p>
<p><input name="restaurent_end_date" id="restaurent_end_date" maxlength="" type="text" value="{$restaurantinfo.end_date}"/>
<div class="error" id='restaurent_end_date_err'></div>
</p>
</div><!-- field-row -->

<div class="field-row clearfix">
<p>
<input type='hidden' name="action" value="update"/>
<input type='hidden' name="restaurent_id" value="{$restaurantinfo.id}"/>
<input  class="fleft"  type="submit" value="Save"/>
<input  class="fright"  type="button" value="Cancel" onclick="$('#ViewRestaurant').show();$('#FrmRestaurant').hide();"/>
</p>
</div><!-- field-row --> 
</form>
{literal}
 <script type="text/javascript">
   function	validateRestaurant(){
   var isErr = true;
	$('#restaurent_name_err').html("");
	$('#restaurent_owner_err').html("");
	$('#restaurent_city_err').html("");
	$('#restaurent_zip_err').html("");
	$('#restaurent_state_err').html("");
	$('#restaurent_country_err').html("");
  	$('#restaurent_address_err').html(""); 
	$('#restaurent_phone_1_err').html("");
	$('#restaurent_phone_2_err').html("");  
	$('#restaurent_start_date_err').html("");
	$('#restaurent_end_date_err').html("");   
	
   if(IsNonEmpty(elemById("restaurent_name").value) == false){
  	$('#restaurent_name_err').html({/literal}"{$_lang.restaurant.non_empty_msg.name}"{literal});
	isErr = false;
  }
  if(IsNonEmpty(elemById("restaurent_owner").value) == false){
  	$('#restaurent_owner_err').html({/literal}"{$_lang.restaurant.non_empty_msg.owner}"{literal});
	isErr = false;
  }
  if(IsNonEmpty(elemById("restaurent_city").value) == false){
  	$('#restaurent_city_err').html({/literal}"{$_lang.restaurant.non_empty_msg.city}"{literal});
	isErr = false;
  }
  if(IsNonEmpty(elemById("restaurent_state").value) == false){
  	$('#restaurent_state_err').html({/literal}"{$_lang.restaurant.non_empty_msg.state}"{literal});
	isErr = false;
  }
  
  if(IsNonEmpty(elemById("restaurent_country").value) == false){
  	$('#restaurent_country_err').html({/literal}"{$_lang.restaurant.non_empty_msg.country}"{literal});
	isErr = false;
  }
  
  if(IsNonEmpty(elemById("restaurent_zip").value) == false){
  	$('#restaurent_zip_err').html({/literal}"{$_lang.restaurant.non_empty_msg.zip}"{literal});
	isErr = false;
  }
  
  if(IsNonEmpty(elemById("restaurent_phone_1").value) == false){
  	$('#restaurent_phone_1_err').html({/literal}"{$_lang.restaurant.non_empty_msg.phone_1}"{literal});
	isErr = false;
  }
  
   if(IsNonEmpty(elemById("restaurent_phone_2").value) == false){
  	$('#restaurent_phone_2_err').html({/literal}"{$_lang.restaurant.non_empty_msg.phone_2}"{literal});
	isErr = false;
  } 
  if(IsNonEmpty($("#restaurent_address").val()) == false){
  	$('#restaurent_address_err').html({/literal}"{$_lang.restaurant.non_empty_msg.address}"{literal});
	isErr = false;
  } 
   
   if(isErr == false){
   		alert("Please Revise the form");
   }
	
  return isErr;
   }
 </script>
{/literal}
{else}
	<div class="error">No record found</div>
{/if} 
  
</div>
{include file='footer.tpl'}
