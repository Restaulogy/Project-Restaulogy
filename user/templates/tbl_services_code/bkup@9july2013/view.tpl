{include file="header.tpl"}

<div class="wrapper">
<h1>{$tbl_services_codeinfo.srvc_name}</h1>
{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmupdatetbl_services_code" id="frmupdatetbl_services_code" enctype="multipart/form-data" onsubmit="return validatetbl_services_code();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">
	 
	<input type="hidden" name="srvc_id" id="srvc_id" value="{$tbl_services_codeinfo.srvc_id}"/>
	<div class="error" id="srvc_id_err"></div>

	<label for="srvc_img">{$_lang.tbl_services_code.label.srvc_img}</label>
		{if $tbl_services_codeinfo.srvc_img neq ""}
			<img style="width:100%;" src="{$website}/uploads/services/{$tbl_services_codeinfo.srvc_img}" />
        {else}
            --
        {/if}	
		<input type="file" name="srvc_img" id="srvc_img" />
	<div class="error" id="srvc_img_err"></div>
	
	<label for="srvc_name">{$_lang.tbl_services_code.label.srvc_name}</label>
	<input type="text" name="srvc_name" id="srvc_name" value="{$tbl_services_codeinfo.srvc_name}"/>
	<div class="error" id="srvc_name_err"></div>
	
	<label for="srvc_cat_id">{$_lang.tbl_services_code.label.srvc_cat_id}</label>
	<select name="srvc_cat_id" id="srvc_cat_id">
		<option value="">Select Category</option>
		{foreach from=$service_categories item=service_category}
			<option value="{$service_category.srvc_cat_id}" {if $tbl_services_codeinfo.srvc_cat_id eq $service_category.srvc_cat_id}selected="selected"{/if}>{$service_category.srvc_cat_code}</option> 
		{/foreach}
	</select> 
	<div class="error" id="srvc_cat_id_err"></div>
	
	<label for="srvc_description">{$_lang.tbl_services_code.label.srvc_description}</label>
	<input type="text" name="srvc_description" id="srvc_description" value="{$tbl_services_codeinfo.srvc_description}"/>
	<div class="error" id="srvc_description_err"></div>
 
	
	<label class="biz_hidden"  for="srvc_by_restrnt_or_cust">{$_lang.tbl_services_code.label.srvc_by_restrnt_or_cust}</label> 
	<table class="biz_hidden">
		<tr><td> <label data-inline="true"><input name="srvc_by_restrnt_or_cust" type="radio" value="REST" {if $tbl_services_codeinfo.restrnt_or_cust =="CUST"}{else}checked="checked"{/if}/>{$_lang.services_code.label.srvc_by_restrnt}</label></td><td><label data-inline="true"> <input name="srvc_by_restrnt_or_cust" maxlength="" type="radio" value="CUST" {if $tbl_services_codeinfo.restrnt_or_cust =="CUST"}checked="checked"{else}{/if}/>{$_lang.services_code.label.srvc_by_cust}</label></td></tr>
	</table>
	
	<div class="error" id="srvc_by_restrnt_or_cust_err"></div>

<!--
	<label for="srvc_attend_time_limit">{$_lang.tbl_services_code.label.srvc_attend_time_limit}</label>
	<input type="text" maxlength="3" name="srvc_attend_time_limit" id="srvc_attend_time_limit" value="{$tbl_services_codeinfo.srvc_attend_time_limit}"/>
	<div class="error" id="srvc_attend_time_limit_err"></div>

	<label for="srvc_provide_time_limit">{$_lang.tbl_services_code.label.srvc_provide_time_limit}</label>
	<input type="text" maxlength="3" name="srvc_provide_time_limit" id="srvc_provide_time_limit" value="{$tbl_services_codeinfo.srvc_provide_time_limit}"/>
	<div class="error" id="srvc_provide_time_limit_err"></div>

    <label for="srvc_start_date">{$_lang.tbl_services_code.label.srvc_start_date}</label>
	<input type="text" name="srvc_start_date" id="srvc_start_date" value="{$tbl_services_codeinfo.srvc_start_date}"/>
	<div class="error" id="srvc_start_date_err"></div>

	<label for="srvc_end_date">{$_lang.tbl_services_code.label.srvc_end_date}</label>
	<input type="text" name="srvc_end_date" id="srvc_end_date" value="{$tbl_services_codeinfo.srvc_end_date}"/>
	<div class="error" id="srvc_end_date_err"></div>
--> 
	<input type="hidden" name="action" value="update"/> 
</form>

<div id="tbl_services_code_view" class="description"  style="{if $isUpdate eq 1}display:none;{/if}">
	<table class="listTable">
	<tr>
	<th class='fieldItem'>{$_lang.field_title}</th><th class='valueItem'>{$_lang.value_title}</th>
	</tr>
	
	<tr>
	<td class='fieldItem'>{$_lang.tbl_services_code.label.srvc_cat_id}:</td><td class='valueItem'>{$tbl_services_codeinfo.category.srvc_cat_code}</td>
	</tr>
	<tr>
	<td class='fieldItem'>{$_lang.tbl_services_code.label.srvc_img}:</td><td class='valueItem'>{if $tbl_services_codeinfo.srvc_img neq ""}
			<img style="width:100%;" src="{$website}/uploads/services/{$tbl_services_codeinfo.srvc_img}" />
        {else}
            --
        {/if}	
	</td>
	</tr>	
	<tr>
	<td class='fieldItem'>{$_lang.tbl_services_code.label.srvc_description}:</td><td class='valueItem'>{$tbl_services_codeinfo.srvc_description}</td>
	</tr>
	<tr>
	<td class='fieldItem'>{$_lang.tbl_services_code.label.srvc_by_restrnt_or_cust}:</td><td class='valueItem'>{if $tbl_services_codeinfo.srvc_by_restrnt_or_cust eq "CUST"}{$_lang.tbl_services_code.label.srvc_by_cust}{else}{$_lang.tbl_services_code.label.srvc_by_restrnt}{/if}</td>
	</tr><!--
	<tr>
	
	<td class='fieldItem'>{$_lang.tbl_services_code.label.srvc_attend_time_limit}:</td><td class='valueItem'>{$tbl_services_codeinfo.srvc_attend_time_limit}</td>
	</tr>
	<tr>
	<td class='fieldItem'>{$_lang.tbl_services_code.label.srvc_provide_time_limit}:</td><td class='valueItem'>{$tbl_services_codeinfo.srvc_provide_time_limit}</td></tr>
	<p>{$_lang.tbl_services_code.label.srvc_start_date}:<b>{$tbl_services_codeinfo.srvc_start_date}</b></p>
	<p>{$_lang.tbl_services_code.label.srvc_end_date}:<b>{$tbl_services_codeinfo.srvc_end_date}</b></p>
-->
	<tr>
	<td class='fieldItem'>{$_lang.tbl_services_code.label.isActive}:</td><td class='valueItem'>{if $tbl_services_codeinfo.isActive eq 1}{$_lang.tbl_services_code.label.isActive_yes}{else}{$_lang.tbl_services_code.label.isActive_no}{/if}
	</td>
	</tr> 
	</table>
 
	
</div>

<center>
{if $isUpdate eq 1}
<input data-inline="true"  data-icon="save"  type="button" onclick="$('#frmupdatetbl_services_code').submit();" value="{$_lang.save_lbl}"/>
{else}
	 <input type="button" value="{$_lang.tbl_service_stage.listing_title}" data-inline="true" data-icon="star" onclick="window.location.href='{$website}/user/tbl_service_stage.php?srvc_stg_service_id={$tbl_services_codeinfo.srvc_id}'"/>
    <input type="button" value="{$_lang.service_details.title}" data-icon="search" data-inline="true" onclick="window.location.href='{$website}/user/service_details.php?service_code={$tbl_services_codeinfo.srvc_id}'"/> 
{/if}
	<input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/>
   
</center>

{include file="tbl_services_code/js.tpl"}

</div>

<div class='field-row clearfix'></div>

{include file="footer.tpl"}
