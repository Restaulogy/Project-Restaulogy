{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_services_code.title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmcreatetbl_services_code" id="frmcreatetbl_services_code" onsubmit="return validatetbl_services_code();" method="POST" action="{$page_url}">	<input type="hidden" name="srvc_id" id="srvc_id" value="0"/>	<div style="display:none;" class="error" id="srvc_id_err"></div>	<label for="srvc_name">{$_lang.tbl_services_code.label.srvc_name}</label>	<input type="text" name="srvc_name" id="srvc_name" value="{$smarty.post.srvc_name}"/>	<div class="error" id="srvc_name_err"></div>	<label for="srvc_description">{$_lang.tbl_services_code.label.srvc_description}</label>	<input type="text" name="srvc_description" id="srvc_description" value="{$smarty.post.srvc_description}"/>	<div class="error" id="srvc_description_err"></div>	<label for="srvc_by_restrnt_or_cust">{$_lang.tbl_services_code.label.srvc_by_restrnt_or_cust}</label> 	<input name="srvc_by_restrnt_or_cust" type="radio" value="REST" {if $bycust eq 1}{else}checked="checked"{/if}/>{$_lang.services_code.label.srvc_by_restrnt}&nbsp;<input name="srvc_by_restrnt_or_cust" maxlength="" type="radio" value="CUST" {if $bycust eq 1}checked="checked"{else}{/if}/>{$_lang.services_code.label.srvc_by_cust} 	<div class="error" id="srvc_by_restrnt_or_cust_err"></div>	<label for="srvc_attend_time_limit">{$_lang.tbl_services_code.label.srvc_attend_time_limit}</label>	<input type="text" name="srvc_attend_time_limit" id="srvc_attend_time_limit" value="{$smarty.post.srvc_attend_time_limit}"/>	<div class="error" id="srvc_attend_time_limit_err"></div>	<label for="srvc_provide_time_limit">{$_lang.tbl_services_code.label.srvc_provide_time_limit}</label>	<input type="text" name="srvc_provide_time_limit" id="srvc_provide_time_limit" value="{$smarty.post.srvc_provide_time_limit}"/>	<div class="error" id="srvc_provide_time_limit_err"></div>	<!--<label for="srvc_start_date">{$_lang.tbl_services_code.label.srvc_start_date}</label>	<input type="text" name="srvc_start_date" id="srvc_start_date" value="{$smarty.post.srvc_start_date}"/>	<div class="error" id="srvc_start_date_err"></div>	<label for="srvc_end_date">{$_lang.tbl_services_code.label.srvc_end_date}</label>	<input type="text" name="srvc_end_date" id="srvc_end_date" value="{$smarty.post.srvc_end_date}"/>	<div class="error" id="srvc_end_date_err"></div>-->	<input type="hidden" name="action" value="create"/><input class="fleft" type="submit" value="{$_lang.save_lbl}"/> <input  class="fright" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></form>{include file="js_tbl_services_code.tpl"}</div>{include file="footer.tpl"}