{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_cust_filter_email.title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmupdatetbl_cust_filter_email" id="frmupdatetbl_cust_filter_email" onsubmit="return validatetbl_cust_filter_email();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="cfe_id" id="cfe_id" value="{$tbl_cust_filter_emailinfo.cfe_id}"/>	<div style="display:none;" class="error" id="cfe_id_err"></div>	<div class="field-row">		<label for="cfe_filter">{$_lang.tbl_cust_filter_email.label.cfe_filter}</label>		<input type="text" name="cfe_filter" id="cfe_filter" value="{$tbl_cust_filter_emailinfo.cfe_filter}"/>		<div class="error" id="cfe_filter_err"></div>	</div>	<div class="field-row">		<label for="cfe_value">{$_lang.tbl_cust_filter_email.label.cfe_value}</label>		<input type="text" name="cfe_value" id="cfe_value" value="{$tbl_cust_filter_emailinfo.cfe_value}"/>		<div class="error" id="cfe_value_err"></div>	</div>	<div class="field-row">		<label for="cfe_promotion">{$_lang.tbl_cust_filter_email.label.cfe_promotion}</label>		<input type="text" name="cfe_promotion" id="cfe_promotion" value="{$tbl_cust_filter_emailinfo.cfe_promotion}"/>		<div class="error" id="cfe_promotion_err"></div>	</div>	<div class="field-row">		<label for="cfe_mesasge">{$_lang.tbl_cust_filter_email.label.cfe_mesasge}</label>		<input type="text" name="cfe_mesasge" id="cfe_mesasge" value="{$tbl_cust_filter_emailinfo.cfe_mesasge}"/>		<div class="error" id="cfe_mesasge_err"></div>	</div>	<div class="field-row">		<label for="cfe_email_or_sms">{$_lang.tbl_cust_filter_email.label.cfe_email_or_sms}</label>		<input type="text" name="cfe_email_or_sms" id="cfe_email_or_sms" value="{$tbl_cust_filter_emailinfo.cfe_email_or_sms}"/>		<div class="error" id="cfe_email_or_sms_err"></div>	</div>	<div class="field-row">		<label for="cfe_period_start">{$_lang.tbl_cust_filter_email.label.cfe_period_start}</label>		<input type="text" name="cfe_period_start" id="cfe_period_start" value="{$tbl_cust_filter_emailinfo.cfe_period_start}"/>		<div class="error" id="cfe_period_start_err"></div>	</div>	<div class="field-row">		<label for="cfe_period_end">{$_lang.tbl_cust_filter_email.label.cfe_period_end}</label>		<input type="text" name="cfe_period_end" id="cfe_period_end" value="{$tbl_cust_filter_emailinfo.cfe_period_end}"/>		<div class="error" id="cfe_period_end_err"></div>	</div>	<div class="field-row">		<label for="cfe_restaurant">{$_lang.tbl_cust_filter_email.label.cfe_restaurant}</label>		<input type="text" name="cfe_restaurant" id="cfe_restaurant" value="{$tbl_cust_filter_emailinfo.cfe_restaurant}"/>		<div class="error" id="cfe_restaurant_err"></div>	</div>	<!--	<div class="field-row">		<label for="cfe_start_date">{$_lang.tbl_cust_filter_email.label.cfe_start_date}</label>		<input type="text" name="cfe_start_date" id="cfe_start_date" value="{$tbl_cust_filter_emailinfo.cfe_start_date}"/>		<div class="error" id="cfe_start_date_err"></div>	</div>	-->	<!--	<div class="field-row">		<label for="cfe_end_date">{$_lang.tbl_cust_filter_email.label.cfe_end_date}</label>		<input type="text" name="cfe_end_date" id="cfe_end_date" value="{$tbl_cust_filter_emailinfo.cfe_end_date}"/>		<div class="error" id="cfe_end_date_err"></div>	</div>	-->	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/> <input  data-inline="true" data-icon="save"  type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" onclick="$('#tbl_cust_filter_email_view').show();$('#frmupdatetbl_cust_filter_email').hide();" value="{$_lang.cancel_lbl}"/></center></form><div id="tbl_cust_filter_email_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">	<table class="listTable">		<tr><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_id}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_filter}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_filter}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_value}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_value}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_promotion}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_promotion}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_mesasge}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_mesasge}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_email_or_sms}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_email_or_sms}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_period_start}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_period_start}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_period_end}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_period_end}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_restaurant}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_restaurant}</td></tr>	<!--		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_start_date}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_start_date}</td></tr>	-->	<!--		<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.cfe_end_date}<i>:</i></td><td class="valueItem">{$tbl_cust_filter_emailinfo.cfe_end_date}</td></tr>	-->	<tr><td class="fieldItem">{$_lang.tbl_cust_filter_email.label.isActive}<i>:</i></td><td class="valueItem">{if $tbl_cust_filter_emailinfo.isActive eq 1}{$_lang.tbl_cust_filter_email.label.isActive_yes}{else}{$_lang.tbl_cust_filter_email.label.isActive_no}{/if}</td></tr>	</table>	<center><input data-inline="true" data-icon="edit" type="button" value="{$_lang.tbl_cust_filter_email.UPDATE.BTN_LBL}" onclick="$('#tbl_cust_filter_email_view').hide();$('#frmupdatetbl_cust_filter_email').show();"/><input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></center></div>{include file="tbl_cust_filter_email/js.tpl"}</div>{include file="footer.tpl"}