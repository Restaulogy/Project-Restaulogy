{include file='header.tpl'}


<div class='wrapper'>
<h1>Service</h1>
{if $error_msg}
	{$error_msg}
	<br>
{/if} 
{if $serviceinfo && $serviceinfo.id gt 0} 
<div class="description" id="ViewServiceCode" style='display:{if $mode eq "update"}none{else}block{/if};'>
	<h4>{if $serviceinfo.name neq ""}{$serviceinfo.name}{else}--{/if}</h4>  
	<p>{if $serviceinfo.description neq ""}{$serviceinfo.description}{else}--{/if}</p> 
	<p><b>{$_lang.services_code.label.srvc_by_restrnt_or_cust} </b><span>{if $serviceinfo.by neq ""}{$serviceinfo.by}{else}--{/if}</span>&nbsp<b>Posted </b><span>{if $serviceinfo.friendly_start_date neq ""}{$serviceinfo.friendly_start_date}{else}--{/if}</span></p> 
	<br> 
	<div class="field-row clearfix">
	 
<input  class="fleft"  type="button" value="Update" onclick="$('#ViewServiceCode').hide();$('#FrmServiceCode').show();"/>
<input  class="fright"  type="button" value="Delete" onclick="window.location.href='{$website}/user/service_code.php?srvc_id={$serviceinfo.id}&action=delete'"/>
	</div>	
</div>

<form id="FrmServiceCode" action="{$website}/user/service_code.php" method="post" name="FrmServiceCode" onsubmit="return validateServiceCode();" style='display:{if $mode eq "update"}block{else}none{/if};'>
 

<div class="field-row">
<p><label for="srvc_name">{$_lang.services_code.label.srvc_name}</label></p>
<p><input name="srvc_name" id="srvc_name" maxlength="250" type="text" value="{$serviceinfo.name}">
<div class="error" id='srvc_name_err'></div>
</p>

</div><!-- field-row -->

<div class="field-row">
<p><label for="srvc_description">{$_lang.services_code.label.srvc_description}</label></p>
<p><textarea name="srvc_description" id="srvc_description" cols="15" rows="10">{$serviceinfo.description}</textarea>
<div class="error" id='srvc_description_err'></div></p> 
 
</div><!-- field-row -->

<div class="field-row">
<p><label for="srvc_by_restrnt_or_cust">{$_lang.services_code.label.srvc_by_restrnt_or_cust}</label></p>
<p><input name="srvc_by_restrnt_or_cust" maxlength="" type="radio" value="REST" {if $serviceinfo.restrnt_or_cust =="REST"}checked="checked"{/if}/>{$_lang.services_code.label.srvc_by_restrnt}&nbsp;<input name="srvc_by_restrnt_or_cust"  type="radio" value="CUST" {if $serviceinfo.restrnt_or_cust =="CUST"}checked="checked"{/if}/>{$_lang.services_code.label.srvc_by_cust}
 
<div class="error" id='srvc_by_restrnt_or_cust_err'></div></p> 
</div><!-- field-row -->

<div class="field-row" style="display:none">
<p><label for="srvc_start_date">{$_lang.services_code.label.srvc_start_date}</label></p>
<p><input name="srvc_start_date" id="srvc_start_date" maxlength="" type="text" value="{$serviceinfo.start_date}"/>
<div class="error" id='srvc_start_date_err'></div></p>
</div><!-- field-row -->

<div class="field-row"  style="display:none">
<p><label for="srvc_end_date">{$_lang.services_code.label.srvc_end_date}</label></p>
<p><input name="srvc_end_date" id="srvc_end_date" maxlength="" type="text" value="{$serviceinfo.end_date}"/>
<div class="error" id='srvc_end_date_err'></div>
</p>
</div><!-- field-row -->

<div class="field-row clearfix">
<p>
<input type='hidden' name="action" value="update"/>
<input type='hidden' name="srvc_id" value="{$serviceinfo.id}"/>
<input  class="fleft"  type="submit" value="Save"/>
<input  class="fright"  type="button" value="Cancel" onclick="$('#ViewServiceCode').show();$('#FrmServiceCode').hide();"/>
</p>
</div><!-- field-row --> 
</form>
{literal}
 <script type="text/javascript">
   function	validateServiceCode(){
   var isErr = true;
	$('#srvc_name_err').html("");
  	$('#srvc_description_err').html("");
	$('#srvc_by_restrnt_or_cust_err').html(""); 
	$('#srvc_start_date_err').html("");
	$('#srvc_end_date_err').html("");   
	
   if(IsNonEmpty(elemById("srvc_name").value) == false){
  	$('#srvc_name_err').html("First Name should not be empty.");
	isErr = false;
  }
   
  if(IsNonEmpty($("#srvc_description").val()) == false){
  	$('#address_err').html("Description should not be empty.");
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
<div class="field-row clearfix">
<p>
 	<a href="{$website}/user/service_codes.php">View All Services</a> 
</p>
</div>
</div>
{include file='footer.tpl'}
