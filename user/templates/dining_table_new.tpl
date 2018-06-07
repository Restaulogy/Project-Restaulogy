{include file='header.tpl'}
<div class='wrapper'>

<form id="FormName" action="{$website}/user/dining_table.php" method="post" name="FormName" onsubmit="return validateDiningTable();">
<h1>Add New Table</h1> 

<div class="field-row">
<p><label for="table_number">{$_lang.dining_tables.label.table_number}</label></p>
<p><input name="table_number" id="table_number" maxlength="250" type="text" value="{$smarty.post.table_number}">
<div class="error" id='table_number_err'></div>
</p>

</div><!-- field-row -->

<div class="field-row">
<p><label for="table_description">{$_lang.dining_tables.label.table_description}</label></p>
<p><textarea name="table_description" id="table_description" cols="15" rows="10">{$smarty.post.table_description}</textarea>
<div class="error" id='table_description_err'></div></p> 
 
</div><!-- field-row -->

<div class="field-row" style="display:none">
<p><label for="table_restaurant">{$_lang.dining_tables.label.table_restaurant}</label></p>
<p> <input type="text" id="table_restaurant" name="table_restaurant" value="{$Global_member.restaurent}" />
<div class="error" id='table_restaurant_err'></div></p> 
</div><!-- field-row -->

<!--
<div class="field-row">
<p><label for="table_start_date">{$_lang.dining_tables.label.table_start_date}</label></p>
<p><input name="table_start_date" maxlength="" type="text" value="{$smarty.post.table_start_date}"/>
<div class="error" id='table_start_date_err'></div></p>
</div><!-- field-row -->
<!--
<div class="field-row">
<p><label for="table_end_date">{$_lang.dining_tables.label.table_end_date}</label></p>
<p><input name="table_end_date" maxlength="" type="text" value="{$smarty.post.table_end_date}"/>
<div class="error" id='table_end_date_err'></div>
</p>
</div><!-- field-row -->

<div class="field-row clearfix">
<p>
<input type='hidden' name="action" value="create"/>
<input  class="fleft"  type="submit" value="Add"/>
 
<input  class="fright"  type="reset"  value="Cancel"/>
</p>
</div><!-- field-row --> 
</form>
</div>
{literal}
 <script type="text/javascript">
   function	validateDiningTable(){
   var isErr = true;
	$('#table_number_err').html("");
  	$('#table_description_err').html("");
	$('#table_restaurant_err').html(""); 
	/*$('#table_start_date_err').html("");
	$('#table_end_date_err').html("");   
	*/
   if(IsNonEmpty(elemById("table_number").value) == false){
  	$('#table_number_err').html("Table Number should not be empty.");
	isErr = false;
  }
   
  
  if(IsNonEmpty($("#table_description").val()) == false){
  	$('#table_description_err').html("Description should not be empty.");
	isErr = false;
  } 
   
    if(IsNonEmpty(elemById("table_restaurant").value) == false){
  	$('#table_restaurant_err').html("Please, Select restaurant.");
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
