{include file='header.tpl'}
<div class='wrapper'>

<form id="FormName" action="{$website}/user/service_code.php" method="post" name="FormName" onsubmit="return validateServiceCode();">
<h1>Add New Service</h1> 

<div class="field-row">
<p><label for="srvc_name">{$_lang.services_code.label.srvc_name}</label></p>
<p><input name="srvc_name" id="srvc_name" maxlength="250" type="text" value="{$smarty.post.srvc_name}">
<div class="error" id='srvc_name_err'></div>
</p>

</div><!-- field-row -->

<div class="field-row">
<p><label for="srvc_description">{$_lang.services_code.label.srvc_description}</label></p>
<p><textarea name="srvc_description" id="srvc_description" cols="15" rows="10">{$smarty.post.srvc_description}</textarea>
<div class="error" id='srvc_description_err'></div></p> 
 
</div><!-- field-row -->

<div class="field-row" {if $bycust eq 1} style="display:none;"{/if}>
<p><label for="srvc_by_restrnt_or_cust">{$_lang.services_code.label.srvc_by_restrnt_or_cust}</label></p>
<p><input name="srvc_by_restrnt_or_cust" type="radio" value="REST" {if $bycust eq 1}{else}checked="checked"{/if}/>{$_lang.services_code.label.srvc_by_restrnt}&nbsp;<input name="srvc_by_restrnt_or_cust" maxlength="" type="radio" value="CUST" {if $bycust eq 1}checked="checked"{else}{/if}/>{$_lang.services_code.label.srvc_by_cust} 
<div class="error" id='srvc_by_restrnt_or_cust_err'></div></p> 
</div><!-- field-row -->
<!--
<div class="field-row">
<p><label for="srvc_start_date">{$_lang.services_code.label.srvc_start_date}</label></p>
<p><input name="srvc_start_date" maxlength="" type="text" value="{$smarty.post.srvc_start_date}"/>
<div class="error" id='srvc_start_date_err'></div></p>
</div><!-- field-row -->
<!--
<div class="field-row">
<p><label for="srvc_end_date">{$_lang.services_code.label.srvc_end_date}</label></p>
<p><input name="srvc_end_date" maxlength="" type="text" value="{$smarty.post.srvc_end_date}"/>
<div class="error" id='srvc_end_date_err'></div>
</p>
</div><!-- field-row -->

<div class="field-row clearfix">
<p>
<input type='hidden' name="bycust" value="{$bycust}"/> 
<input type='hidden' name="table_id" value="{$table_id}"/>
<input type='hidden' name="created_by" value="{$created_by}"/>
 
<input type='hidden' name="action" value="create"/>
<input  class="fleft"  type="submit" value="Add"/>
 
{if $bycust eq 1}
	<input  class="fright"  type="button" onclick="window.location.href='{$website}/user/services_request.php?table_id={$table_id}&created_by={$created_by}'"  value="Cancel"/>
{else}
	<input  class="fright"  type="reset"  value="Cancel"/>
{/if}
	
</p>
</div><!-- field-row --> 
</form>
</div>
{literal}
 <script type="text/javascript">
   function	validateServiceCode(){
   var isErr = true;
	$('#srvc_name_err').html("");
  	$('#srvc_description_err').html("");
	$('#srvc_by_restrnt_or_cust_err').html(""); 
	/*$('#srvc_start_date_err').html("");
	$('#srvc_end_date_err').html("");   
	*/
   if(IsNonEmpty(elemById("srvc_name").value) == false){
  	$('#srvc_name_err').html("First Name should not be empty.");
	isErr = false;
  }
   
  
  if(IsNonEmpty($("#srvc_description").val()) == false){
  	$('#srvc_description_err').html("Description should not be empty.");
	isErr = false;
  } 
   
   if(isErr == false){
   		alert("Please Revise the form");
   }
	
  return isErr;
   }
 </script>
{/literal}

{include file='footer.tpl'}
