{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_order_promotions.title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmupdatetbl_order_promotions" id="frmupdatetbl_order_promotions" onsubmit="return validatetbl_order_promotions();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="ordprom_id" id="ordprom_id" value="{$tbl_order_promotionsinfo.ordprom_id}"/>	<div style="display:none;" class="error" id="ordprom_id_err"></div>	<div class="field-row">		<label for="ordprom_order">{$_lang.tbl_order_promotions.label.ordprom_order}</label>		<input type="text" name="ordprom_order" id="ordprom_order" value="{$tbl_order_promotionsinfo.ordprom_order}"/>		<div class="error" id="ordprom_order_err"></div>	</div>	<div class="field-row">		<label for="ordprom_order_sbmnu_dish">{$_lang.tbl_order_promotions.label.ordprom_order_sbmnu_dish}</label>		<input type="text" name="ordprom_order_sbmnu_dish" id="ordprom_order_sbmnu_dish" value="{$tbl_order_promotionsinfo.ordprom_order_sbmnu_dish}"/>		<div class="error" id="ordprom_order_sbmnu_dish_err"></div>	</div>	<div class="field-row">		<label for="ordprom_promotion">{$_lang.tbl_order_promotions.label.ordprom_promotion}</label>		<input type="text" name="ordprom_promotion" id="ordprom_promotion" value="{$tbl_order_promotionsinfo.ordprom_promotion}"/>		<div class="error" id="ordprom_promotion_err"></div>	</div>	<div class="field-row">		<label for="ordprom_discount">{$_lang.tbl_order_promotions.label.ordprom_discount}</label>		<input type="text" name="ordprom_discount" id="ordprom_discount" value="{$tbl_order_promotionsinfo.ordprom_discount}"/>		<div class="error" id="ordprom_discount_err"></div>	</div>	<!--	<div class="field-row">		<label for="ordprom_start_date">{$_lang.tbl_order_promotions.label.ordprom_start_date}</label>		<input type="text" name="ordprom_start_date" id="ordprom_start_date" value="{$tbl_order_promotionsinfo.ordprom_start_date}"/>		<div class="error" id="ordprom_start_date_err"></div>	</div>	-->	<!--	<div class="field-row">		<label for="ordprom_end_date">{$_lang.tbl_order_promotions.label.ordprom_end_date}</label>		<input type="text" name="ordprom_end_date" id="ordprom_end_date" value="{$tbl_order_promotionsinfo.ordprom_end_date}"/>		<div class="error" id="ordprom_end_date_err"></div>	</div>	-->	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/> <input  data-inline="true" data-icon="save"  type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" onclick="$('#tbl_order_promotions_view').show();$('#frmupdatetbl_order_promotions').hide();" value="{$_lang.cancel_lbl}"/></center></form><div id="tbl_order_promotions_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">	<table class="listTable">		<tr><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>		<tr><td class="fieldItem">{$_lang.tbl_order_promotions.label.ordprom_id}<i>:</i></td><td class="valueItem">{$tbl_order_promotionsinfo.ordprom_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_order_promotions.label.ordprom_order}<i>:</i></td><td class="valueItem">{$tbl_order_promotionsinfo.ordprom_order}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_order_promotions.label.ordprom_order_sbmnu_dish}<i>:</i></td><td class="valueItem">{$tbl_order_promotionsinfo.ordprom_order_sbmnu_dish}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_order_promotions.label.ordprom_promotion}<i>:</i></td><td class="valueItem">{$tbl_order_promotionsinfo.ordprom_promotion}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_order_promotions.label.ordprom_discount}<i>:</i></td><td class="valueItem">{$tbl_order_promotionsinfo.ordprom_discount}</td></tr>	<!--		<tr><td class="fieldItem">{$_lang.tbl_order_promotions.label.ordprom_start_date}<i>:</i></td><td class="valueItem">{$tbl_order_promotionsinfo.ordprom_start_date}</td></tr>	-->	<!--		<tr><td class="fieldItem">{$_lang.tbl_order_promotions.label.ordprom_end_date}<i>:</i></td><td class="valueItem">{$tbl_order_promotionsinfo.ordprom_end_date}</td></tr>	-->	<tr><td class="fieldItem">{$_lang.tbl_order_promotions.label.isActive}<i>:</i></td><td class="valueItem">{if $tbl_order_promotionsinfo.isActive eq 1}{$_lang.tbl_order_promotions.label.isActive_yes}{else}{$_lang.tbl_order_promotions.label.isActive_no}{/if}</td></tr>	</table>	<center><input data-inline="true" data-icon="edit" type="button" value="{$_lang.tbl_order_promotions.UPDATE.BTN_LBL}" onclick="$('#tbl_order_promotions_view').hide();$('#frmupdatetbl_order_promotions').show();"/><input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></center></div>{include file="tbl_order_promotions/js.tpl"}</div>{include file="footer.tpl"}