{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_prom_conditions.title}</h1>{if $error_msg}	<div class="biz_center">{$error_msg}</div><!--/center-->{/if}{**include file="tbl_prom_conditions/tabs.tpl"**}<form name="frmupdatetbl_prom_conditions" id="frmupdatetbl_prom_conditions" onsubmit="return validatetbl_prom_conditions();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="prmcon_id" id="prmcon_id" value="{$tbl_prom_conditionsinfo.prmcon_id}"/>	<div style="display:none;" class="error" id="prmcon_id_err"></div>	<div class="field-row">		<label for="prmcon_promotion">{$_lang.tbl_prom_conditions.label.prmcon_promotion}</label>        <select name="prmcon_promotion" id="prmcon_promotion">            <option value="">Select Promotion</option>            {foreach $lst_promotion as $promotion}                <option value="{$promotion@key}" {if $tbl_prom_conditionsinfo.prmcon_promotion eq $promotion@key}selected="selected"{/if}>{$promotion}</option>            {/foreach}        </select>		<div class="error" id="prmcon_promotion_err"></div>	</div>	<div class="field-row">		<label for="prmcon_title">{$_lang.tbl_prom_conditions.label.prmcon_title}</label>		<input type="text" name="prmcon_title" id="prmcon_title" value="{$tbl_prom_conditionsinfo.prmcon_title}"/>		<div class="error" id="prmcon_title_err"></div>	</div>	<!--	<div class="field-row">		<label for="prmcon_start_date">{$_lang.tbl_prom_conditions.label.prmcon_start_date}</label>		<input type="text" name="prmcon_start_date" id="prmcon_start_date" value="{$tbl_prom_conditionsinfo.prmcon_start_date}"/>		<div class="error" id="prmcon_start_date_err"></div>	</div>	-->	<!--	<div class="field-row">		<label for="prmcon_end_date">{$_lang.tbl_prom_conditions.label.prmcon_end_date}</label>		<input type="text" name="prmcon_end_date" id="prmcon_end_date" value="{$tbl_prom_conditionsinfo.prmcon_end_date}"/>		<div class="error" id="prmcon_end_date_err"></div>	</div>	-->	<div class="biz_center"><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/> <input  data-inline="true" data-icon="save"  type="submit" value="{$_lang.save_lbl}"/> <input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></div><!--/center--></form><div id="tbl_prom_conditions_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">	<table class="listTable">		<tr><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>		<tr><td class="fieldItem">{$_lang.tbl_prom_conditions.label.prmcon_id}<i>:</i></td><td class="valueItem">{$tbl_prom_conditionsinfo.prmcon_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_prom_conditions.label.prmcon_promotion}<i>:</i></td><td class="valueItem">{$tbl_prom_conditionsinfo.prmcon_promotion}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_prom_conditions.label.prmcon_title}<i>:</i></td><td class="valueItem">{$tbl_prom_conditionsinfo.prmcon_title}</td></tr>	<!--		<tr><td class="fieldItem">{$_lang.tbl_prom_conditions.label.prmcon_start_date}<i>:</i></td><td class="valueItem">{$tbl_prom_conditionsinfo.prmcon_start_date}</td></tr>	-->	<!--		<tr><td class="fieldItem">{$_lang.tbl_prom_conditions.label.prmcon_end_date}<i>:</i></td><td class="valueItem">{$tbl_prom_conditionsinfo.prmcon_end_date}</td></tr>	-->	<tr><td class="fieldItem">{$_lang.tbl_prom_conditions.label.isActive}<i>:</i></td><td class="valueItem">{if $tbl_prom_conditionsinfo.isActive eq 1}{$_lang.tbl_prom_conditions.label.isActive_yes}{else}{$_lang.tbl_prom_conditions.label.isActive_no}{/if}</td></tr>	</table>	<div class="biz_center"><input data-inline="true" data-icon="edit" type="button" value="{$_lang.tbl_prom_conditions.UPDATE.BTN_LBL}" onclick="$('#tbl_prom_conditions_view').hide();$('#frmupdatetbl_prom_conditions').show();"/><input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></div><!--/center--></div>{include file="tbl_prom_conditions/js.tpl"}</div>{include file="footer.tpl"}