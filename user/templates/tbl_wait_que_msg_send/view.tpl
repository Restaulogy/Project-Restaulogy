{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_wait_que_msg_send.title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmupdatetbl_wait_que_msg_send" id="frmupdatetbl_wait_que_msg_send" onsubmit="return validatetbl_wait_que_msg_send();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="wtq_msg_send_id" id="wtq_msg_send_id" value="{$tbl_wait_que_msg_sendinfo.wtq_msg_send_id}"/>	<div style="display:none;" class="error" id="wtq_msg_send_id_err"></div>	<div class="field-row">		<label for="wtq_msg_send_msg_id">{$_lang.tbl_wait_que_msg_send.label.wtq_msg_send_msg_id}</label>		<input type="text" name="wtq_msg_send_msg_id" id="wtq_msg_send_msg_id" value="{$tbl_wait_que_msg_sendinfo.wtq_msg_send_msg_id}"/>		<div class="error" id="wtq_msg_send_msg_id_err"></div>	</div>	<div class="field-row">		<label for="wtq_msg_send_que_id">{$_lang.tbl_wait_que_msg_send.label.wtq_msg_send_que_id}</label>		<input type="text" name="wtq_msg_send_que_id" id="wtq_msg_send_que_id" value="{$tbl_wait_que_msg_sendinfo.wtq_msg_send_que_id}"/>		<div class="error" id="wtq_msg_send_que_id_err"></div>	</div>	<!--	<div class="field-row">		<label for="wtq_msg_start_date">{$_lang.tbl_wait_que_msg_send.label.wtq_msg_start_date}</label>		<input type="text" name="wtq_msg_start_date" id="wtq_msg_start_date" value="{$tbl_wait_que_msg_sendinfo.wtq_msg_start_date}"/>		<div class="error" id="wtq_msg_start_date_err"></div>	</div>	-->	<!--	<div class="field-row">		<label for="wtq_msg_send_end_date">{$_lang.tbl_wait_que_msg_send.label.wtq_msg_send_end_date}</label>		<input type="text" name="wtq_msg_send_end_date" id="wtq_msg_send_end_date" value="{$tbl_wait_que_msg_sendinfo.wtq_msg_send_end_date}"/>		<div class="error" id="wtq_msg_send_end_date_err"></div>	</div>	-->	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/> <input  data-inline="true" data-icon="save"  type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" onclick="$('#tbl_wait_que_msg_send_view').show();$('#frmupdatetbl_wait_que_msg_send').hide();" value="{$_lang.cancel_lbl}"/></center></form><div id="tbl_wait_que_msg_send_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">	<table class="listTable">		<tr><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>		<tr><td class="fieldItem">{$_lang.tbl_wait_que_msg_send.label.wtq_msg_send_id}<i>:</i></td><td class="valueItem">{$tbl_wait_que_msg_sendinfo.wtq_msg_send_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_wait_que_msg_send.label.wtq_msg_send_msg_id}<i>:</i></td><td class="valueItem">{$tbl_wait_que_msg_sendinfo.wtq_msg_send_msg_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_wait_que_msg_send.label.wtq_msg_send_que_id}<i>:</i></td><td class="valueItem">{$tbl_wait_que_msg_sendinfo.wtq_msg_send_que_id}</td></tr>	<!--		<tr><td class="fieldItem">{$_lang.tbl_wait_que_msg_send.label.wtq_msg_start_date}<i>:</i></td><td class="valueItem">{$tbl_wait_que_msg_sendinfo.wtq_msg_start_date}</td></tr>	-->	<!--		<tr><td class="fieldItem">{$_lang.tbl_wait_que_msg_send.label.wtq_msg_send_end_date}<i>:</i></td><td class="valueItem">{$tbl_wait_que_msg_sendinfo.wtq_msg_send_end_date}</td></tr>	-->	<tr><td class="fieldItem">{$_lang.tbl_wait_que_msg_send.label.isActive}<i>:</i></td><td class="valueItem">{if $tbl_wait_que_msg_sendinfo.isActive eq 1}{$_lang.tbl_wait_que_msg_send.label.isActive_yes}{else}{$_lang.tbl_wait_que_msg_send.label.isActive_no}{/if}</td></tr>	</table>	<center><input data-inline="true" data-icon="edit" type="button" value="{$_lang.tbl_wait_que_msg_send.UPDATE.BTN_LBL}" onclick="$('#tbl_wait_que_msg_send_view').hide();$('#frmupdatetbl_wait_que_msg_send').show();"/><input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></center></div>{include file="tbl_wait_que_msg_send/js.tpl"}</div>{include file="footer.tpl"}