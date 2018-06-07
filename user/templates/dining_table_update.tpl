{include file='header.tpl'}


<div class='wrapper'>
<h1>Table</h1>
{if $error_msg}
	{$error_msg}
	<br>
{/if} 
{if $dininginfo && $dininginfo.id gt 0} 
<div class="description" id="ViewDiningTable" style='display:{if $mode eq "update"}none{else}block{/if};'>
	<h4>{if $dininginfo.number neq ""}{$dininginfo.number}{else}--{/if}</h4>  
	<p>{if $dininginfo.description neq ""}{$dininginfo.description}{else}--{/if}</p> 
	<p><b>{$_lang.dining_tables.label.table_restaurant} </b><span>{if $dininginfo.restaurant neq ""}{$dininginfo.restaurant}{else}--{/if}</span>&nbsp<b>Posted </b><span>{if $dininginfo.friendly_start_date neq ""}{$dininginfo.friendly_start_date}{else}--{/if}</span></p> 
	
	<p>{if $dininginfo.qr_code_img neq ""}{$dininginfo.qr_code_img}{/if}</p> 
	<br> 
	<div class="field-row clearfix">
	 
<input  class="fleft"  type="button" value="Update" onclick="$('#ViewDiningTable').hide();$('#FrmDiningTable').show();"/>
<input  class="fright"  type="button" value="Delete" onclick="window.location.href='{$website}/user/dining_table.php?table_id={$dininginfo.id}&action=delete'"/>
	</div>	
</div>

<form id="FrmDiningTable" action="{$website}/user/dining_table.php" method="post" name="FrmDiningTable" onsubmit="return validateDiningTable();" style='display:{if $mode eq "update"}block{else}none{/if};'>
 

<div class="field-row">
<p><label for="table_number">{$_lang.dining_tables.label.table_number}</label></p>
<p><input name="table_number" id="table_number" maxlength="250" type="text" value="{$dininginfo.number}">
<div class="error" id='table_number_err'></div>
</p>

</div><!-- field-row -->

<div class="field-row">
<p><label for="table_description">{$_lang.dining_tables.label.table_description}</label></p>
<p><textarea name="table_description" id="table_description" cols="15" rows="10">{$dininginfo.description}</textarea>
<div class="error" id='table_description_err'></div></p> 
 
</div><!-- field-row -->

<div class="field-row" style="display:none">
<p><label for="table_restaurant">{$_lang.dining_tables.label.table_restaurant}</label></p>
<p> <input type="text" id="table_restaurant" name="table_restaurant" value="{$Global_member.restaurent}" />
<div class="error" id='table_restaurant_err'></div></p> 
</div><!-- field-row -->

<div class="field-row" style="display:none">
<p><label for="table_start_date">{$_lang.dining_tables.label.table_start_date}</label></p>
<p><input name="table_start_date" id="table_start_date" maxlength="" type="text" value="{$dininginfo.start_date}"/>
<div class="error" id='table_start_date_err'></div></p>
</div><!-- field-row -->

<div class="field-row"  style="display:none">
<p><label for="table_end_date">{$_lang.dining_tables.label.table_end_date}</label></p>
<p><input name="table_end_date" id="table_end_date" maxlength="" type="text" value="{$dininginfo.end_date}"/>
<div class="error" id='table_end_date_err'></div>
</p>
</div><!-- field-row -->

<div class="field-row clearfix">
<p>
<input type='hidden' name="action" value="update"/>
<input type='hidden' name="table_id" value="{$dininginfo.id}"/>
<input  class="fleft"  type="submit" value="Save"/>
<input  class="fright"  type="button" value="Cancel" onclick="$('#ViewDiningTable').show();$('#FrmDiningTable').hide();"/>
</p>
</div><!-- field-row --> 
</form>
{literal}
 <script type="text/javascript">
   function	validateDiningTable(){
   var isErr = true;
	$('#table_number_err').html("");
  	$('#table_description_err').html("");
	$('#table_restaurant_err').html(""); 
	/*$('#table_start_date_err').html("");
	$('#table_end_date_err').html("");   */
	
   if(IsNonEmpty(elemById("table_number").value) == false){
  	$('#table_number_err').html("First Name should not be empty.");
	isErr = false;
  }
   
  if(IsNonEmpty($("#table_description").val()) == false){
  	$('#table_description_err').html("Description should not be empty.");
	isErr = false;
  } 
  
  if(IsNonEmpty(elemById("table_restaurant").value) == false){
  	$('#table_restaurant_err').html("Please Select restaurant.");
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
 	<a href="{$website}/user/dining_tables.php">View All Tables</a> 
</p>
</div>
</div>
{include file='footer.tpl'}
