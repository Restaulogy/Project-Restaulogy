{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.crm_prom_emails.title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmupdatecrm_prom_emails" id="frmupdatecrm_prom_emails" onsubmit="return validatecrm_prom_emails();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="crm_pr_ml_id" id="crm_pr_ml_id" value="{$crm_prom_emailsinfo.crm_pr_ml_id}"/>	<div style="display:none;" class="error" id="crm_pr_ml_id_err"></div>	<div class="field-row">		<label for="crm_pr_ml_userid">{$_lang.crm_prom_emails.label.crm_pr_ml_userid}</label>		<input type="text" name="crm_pr_ml_userid" id="crm_pr_ml_userid" value="{$crm_prom_emailsinfo.crm_pr_ml_userid}"/>		<div class="error" id="crm_pr_ml_userid_err"></div>	</div>	<div class="field-row">		<label for="crm_pr_ml_promotion">{$_lang.crm_prom_emails.label.crm_pr_ml_promotion}</label>		<input type="text" name="crm_pr_ml_promotion" id="crm_pr_ml_promotion" value="{$crm_prom_emailsinfo.crm_pr_ml_promotion}"/>		<div class="error" id="crm_pr_ml_promotion_err"></div>	</div>	<div class="field-row">		<label for="flg_send">{$_lang.crm_prom_emails.label.flg_send}</label>		<input type="text" name="flg_send" id="flg_send" value="{$crm_prom_emailsinfo.flg_send}"/>		<div class="error" id="flg_send_err"></div>	</div>	<div class="field-row">		<label for="start_date">{$_lang.crm_prom_emails.label.start_date}</label>		<input type="text" name="start_date" id="start_date" value="{$crm_prom_emailsinfo.start_date}"/>		<div class="error" id="start_date_err"></div>	</div>	<div class="field-row">		<label for="end_date">{$_lang.crm_prom_emails.label.end_date}</label>		<input type="text" name="end_date" id="end_date" value="{$crm_prom_emailsinfo.end_date}"/>		<div class="error" id="end_date_err"></div>	</div>	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/> <input  data-inline="true" data-icon="save"  type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" onclick="$('#crm_prom_emails_view').show();$('#frmupdatecrm_prom_emails').hide();" value="{$_lang.cancel_lbl}"/></center></form><div id="crm_prom_emails_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">	<table class="listTable">		<tr><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>		<tr><td class="fieldItem">{$_lang.crm_prom_emails.label.crm_pr_ml_id}<i>:</i></td><td class="valueItem">{$crm_prom_emailsinfo.crm_pr_ml_id}</td></tr>		<tr><td class="fieldItem">{$_lang.crm_prom_emails.label.crm_pr_ml_userid}<i>:</i></td><td class="valueItem">{$crm_prom_emailsinfo.crm_pr_ml_userid}</td></tr>		<tr><td class="fieldItem">{$_lang.crm_prom_emails.label.crm_pr_ml_promotion}<i>:</i></td><td class="valueItem">{$crm_prom_emailsinfo.crm_pr_ml_promotion}</td></tr>		<tr><td class="fieldItem">{$_lang.crm_prom_emails.label.flg_send}<i>:</i></td><td class="valueItem">{$crm_prom_emailsinfo.flg_send}</td></tr>		<tr><td class="fieldItem">{$_lang.crm_prom_emails.label.start_date}<i>:</i></td><td class="valueItem">{$crm_prom_emailsinfo.start_date}</td></tr>		<tr><td class="fieldItem">{$_lang.crm_prom_emails.label.end_date}<i>:</i></td><td class="valueItem">{$crm_prom_emailsinfo.end_date}</td></tr>	<tr><td class="fieldItem">{$_lang.crm_prom_emails.label.isActive}<i>:</i></td><td class="valueItem">{if $crm_prom_emailsinfo.isActive eq 1}{$_lang.crm_prom_emails.label.isActive_yes}{else}{$_lang.crm_prom_emails.label.isActive_no}{/if}</td></tr>	</table>	<center><input data-inline="true" data-icon="edit" type="button" value="{$_lang.crm_prom_emails.UPDATE.BTN_LBL}" onclick="$('#crm_prom_emails_view').hide();$('#frmupdatecrm_prom_emails').show();"/><input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></center></div>{include file="crm_prom_emails/js.tpl"}</div>{include file="footer.tpl"}