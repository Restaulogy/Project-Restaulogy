{include file="header.tpl"}<div class="wrapper"><h1>{$tbl_dining_tableinfo.table_number}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}{include file="tbl_dining_table/tabs.tpl"}<form name="frmupdatetbl_dining_table" id="frmupdatetbl_dining_table" onsubmit="return validatetbl_dining_table();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="table_id" id="table_id" value="{$tbl_dining_tableinfo.table_id}"/>	<div style="display:none;" class="error" id="table_id_err"></div>	<label for="table_number">{$_lang.tbl_dining_table.label.table_number}</label>	<input type="text" name="table_number" id="table_number" value="{$tbl_dining_tableinfo.table_number}"/>	<div class="error" id="table_number_err"></div>		<div class="field-row">	<label>{$_lang.tbl_dining_table.label.table_qr_code_link}</label>   {$tbl_dining_tableinfo.table_qr_code_img} 	</div> 	 	<label for="table_seating_capacity">{$_lang.tbl_dining_table.label.table_seating_capacity}</label>	<input type="text" name="table_seating_capacity" id="table_seating_capacity" value="{$tbl_dining_tableinfo.table_seating_capacity}"/>	<div class="error" id="table_seating_capacity_err"></div>	<label for="table_type">{$_lang.tbl_dining_table.label.table_type}</label>	 	<select name="table_type" id="table_type">		 <option value="">Select Type</option>		 {foreach from=$table_types item=table_type}		 	<option value="{$table_type.tbl_type_id}" {if $tbl_dining_tableinfo.table_type eq $table_type.tbl_type_id}selected="selected"{/if}>{$table_type.tbl_type_name}</option>		 {/foreach}	</select>	<div class="error" id="table_type_err"></div>	<label for="table_desciption">{$_lang.tbl_dining_table.label.table_desciption}</label>	<input type="text" name="table_desciption" id="table_desciption" value="{$tbl_dining_tableinfo.table_desciption}"/>	<div class="error" id="table_desciption_err"></div>	<input type="hidden" name="table_restaurant" id="table_restaurant" value="{if $tbl_dining_tableinfo.table_restaurant}{$tbl_dining_tableinfo.table_restaurant}{else}{$smarty.session[$smarty.const.SES_RESTAURANT]}{/if}"/>	    <!--	<div class="error" id="table_restaurant_err"></div>	<label for="table_qr_code_link">{$_lang.tbl_dining_table.label.table_qr_code_link}</label>	<input type="text" name="table_qr_code_link" id="table_qr_code_link" value="{$tbl_dining_tableinfo.table_qr_code_link}"/>	<div class="error" id="table_qr_code_link_err"></div>	<label for="table_start_date">{$_lang.tbl_dining_table.label.table_start_date}</label>	<input type="text" name="table_start_date" id="table_start_date" value="{$tbl_dining_tableinfo.table_start_date}"/>	<div class="error" id="table_start_date_err"></div>	<label for="table_end_date">{$_lang.tbl_dining_table.label.table_end_date}</label>	<input type="text" name="table_end_date" id="table_end_date" value="{$tbl_dining_tableinfo.table_end_date}"/>	<div class="error" id="table_end_date_err"></div>-->	<input type="hidden" id="action" name="action" value="update"/>  <!--<input class="fright" type="reset" onclick="$('#tbl_dining_table_view').show();$('#frmupdatetbl_dining_table').hide();" value="{$_lang.cancel_lbl}"/>--></form><div id="tbl_dining_table_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}"><table class="listTable"><!--<tr class="biz_hidden">    <th class="fieldItem">{$_lang.field_title}</th>    <th class="valueItem">{$_lang.value_title}</th><tr>--><!--<tr>    <td class="fieldItem">{$_lang.tbl_dining_table.label.table_number}<i>:</i></td>    <td class="valueItem">{$tbl_dining_tableinfo.table_number} </td></tr></tr>--><tr>    <td class="fieldItem">{$_lang.tbl_dining_table.label.table_seating_capacity}<i>:</i></td>    <td class="valueItem">{$tbl_dining_tableinfo.table_seating_capacity} persons.</td></tr></tr><tr>    <td class="fieldItem">{$_lang.tbl_dining_table.label.table_type}<i>:</i></td>    <td class="valueItem">{if $tbl_dining_tableinfo.table_type_details} {$tbl_dining_tableinfo.table_type_details.tbl_type_name}{/if}</td></tr> <tr>    <td class="fieldItem">{$_lang.tbl_dining_table.label.table_desciption}<i>:</i></td>    <td class="valueItem">{$tbl_dining_tableinfo.table_desciption}</td></tr> <tr>    <td class="fieldItem">{$_lang.tbl_dining_table.label.table_qr_code_link}<i>:</i></td>    <td class="valueItem">{$tbl_dining_tableinfo.table_qr_code_img}</td></tr> <tr>    <td class="fieldItem">{$_lang.tbl_dining_table.label.isActive}<i>:</i></td>    <td class="valueItem">{if $tbl_dining_tableinfo.isActive eq 1}{$_lang.tbl_dining_table.label.isActive_yes}{else}{$_lang.tbl_dining_table.label.isActive_no}{/if}</td></tr></tr></table>	<!--    <p>{$_lang.tbl_dining_table.label.table_id}:<b>{$tbl_dining_tableinfo.table_id}</b></p>	<p>:<b></b></p>	<p>:<b></b></p>	<p>:<b></b></p>	<p>:<b></b></p>	<p>{$_lang.tbl_dining_table.label.table_restaurant}:<b>{$tbl_dining_tableinfo.table_restaurant}</b></p>    <p>{$_lang.tbl_dining_table.label.table_start_date}:<b>{$tbl_dining_tableinfo.table_start_date}</b></p>	<p>{$_lang.tbl_dining_table.label.table_end_date}:<b>{$tbl_dining_tableinfo.table_end_date}</b></p>	<p>{$_lang.tbl_dining_table.label.isActive}:<b></b></p> -->	<!--<input class="fleft" type="button" value="{$_lang.tbl_dining_table.UPDATE.BTN_LBL}" onclick="$('#tbl_dining_table_view').hide();$('#frmupdatetbl_dining_table').show();"/>--></div><center>{if $tbl_dining_tableinfo.isActive eq 1}	<input type="button" value="{$_lang.tbl_dining_table.DEACTIVATE.BTN_LBL}" onclick="location.href='{$page_url}?action=deactivate&table_id={$tbl_dining_tableinfo.table_id}';" data-inline="true" data-icon="check" title="{$_lang.tbl_dining_table.DEACTIVATE.BTN_LBL}" />{else}	<input type="button" value="{$_lang.tbl_dining_table.ACTIVATE.BTN_LBL}" onclick="location.href='{$page_url}?action=activate&table_id={$tbl_dining_tableinfo.table_id}';" data-inline="true" data-icon="check" title="{$_lang.tbl_dining_table.ACTIVATE.BTN_LBL}" />{/if}{if $isUpdate eq 1}<input type="button" value="{$_lang.save_lbl}" data-inline="true" data-icon="save" onclick="$('#frmupdatetbl_dining_table').submit();"/>{/if}	<input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></center>{include file="tbl_dining_table/js.tpl"}</div>{include file="footer.tpl"}