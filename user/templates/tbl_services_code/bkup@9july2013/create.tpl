{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_services_code.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_services_code" id="frmcreatetbl_services_code" enctype="multipart/form-data" onsubmit="return validatetbl_services_code();" method="POST" action="{$page_url}">
	<input type="hidden" name="srvc_id" id="srvc_id" value="0"/>
	<div style="display:none;" class="error" id="srvc_id_err"></div>
	
	<label for="srvc_img">{$_lang.tbl_services_code.label.srvc_img}</label>
	<input type="file" name="srvc_img" id="srvc_img" value="{$smarty.post.srvc_img}"/>
	<div class="error" id="srvc_img_err"></div>
	
	<label for="srvc_name">{$_lang.tbl_services_code.label.srvc_name}</label>
	<input type="text" name="srvc_name" id="srvc_name" value="{$smarty.post.srvc_name}"/>
	<div class="error" id="srvc_name_err"></div>
	
	<label for="srvc_cat_id">{$_lang.tbl_services_code.label.srvc_cat_id}</label>
	<select name="srvc_cat_id" id="srvc_cat_id">
		<option value="">Select Category</option>
		{foreach from=$service_categories item=service_category}
			<option value="{$service_category.srvc_cat_id}" {if $smarty.post.srvc_cat_id eq $service_category.srvc_cat_id}selected="selected"{/if}>{$service_category.srvc_cat_code}</option> 
		{/foreach}
	</select> 
	<div class="error" id="srvc_cat_id_err"></div>
	
	
	<label for="srvc_description">{$_lang.tbl_services_code.label.srvc_description}</label>
	<input type="text" name="srvc_description" id="srvc_description" value="{$smarty.post.srvc_description}"/>
	<div class="error" id="srvc_description_err"></div>
	

	<label  class="biz_hidden" for="srvc_by_restrnt_or_cust">{$_lang.tbl_services_code.label.srvc_by_restrnt_or_cust}</label> 
	<table class="biz_hidden">
		<tr><td> <label data-inline="true"><input name="srvc_by_restrnt_or_cust" type="radio" value="REST" {if $bycust eq 1}{else}checked="checked"{/if}/>{$_lang.services_code.label.srvc_by_restrnt}</label></td><td><label data-inline="true"> <input name="srvc_by_restrnt_or_cust" maxlength="" type="radio" value="CUST" {if $bycust eq 1}checked="checked"{else}{/if}/>{$_lang.services_code.label.srvc_by_cust}</label></td></tr>
	</table>
	    
	<div class="error" id="srvc_by_restrnt_or_cust_err"></div>
<!--
	<label for="srvc_attend_time_limit">{$_lang.tbl_services_code.label.srvc_attend_time_limit}</label>
	<input type="text" name="srvc_attend_time_limit" id="srvc_attend_time_limit" value="{$smarty.post.srvc_attend_time_limit}"/>
	<div class="error" id="srvc_attend_time_limit_err"></div>
	<label for="srvc_provide_time_limit">{$_lang.tbl_services_code.label.srvc_provide_time_limit}</label>
	<input type="text" name="srvc_provide_time_limit" id="srvc_provide_time_limit" value="{$smarty.post.srvc_provide_time_limit}"/>
	<div class="error" id="srvc_provide_time_limit_err"></div>
    <label for="srvc_start_date">{$_lang.tbl_services_code.label.srvc_start_date}</label>
	<input type="text" name="srvc_start_date" id="srvc_start_date" value="{$smarty.post.srvc_start_date}"/>
	<div class="error" id="srvc_start_date_err"></div>

	<label for="srvc_end_date">{$_lang.tbl_services_code.label.srvc_end_date}</label>
	<input type="text" name="srvc_end_date" id="srvc_end_date" value="{$smarty.post.srvc_end_date}"/>
	<div class="error" id="srvc_end_date_err"></div>
    -->
    <center>
	<input type="hidden" name="action" value="create"/><input type="submit" data-inline="true" data-icon="save" value="{$_lang.save_lbl}"/> <input   data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></center>
	
	 
</form>
    {include file="tbl_services_code/js.tpl"}

</div>

{include file="footer.tpl"}
