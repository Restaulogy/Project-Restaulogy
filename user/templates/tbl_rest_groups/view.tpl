{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_rest_groups.title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmupdatetbl_rest_groups" id="frmupdatetbl_rest_groups" onsubmit="return validatetbl_rest_groups();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="rstgrp_id" id="rstgrp_id" value="{$tbl_rest_groupsinfo.rstgrp_id}"/>	<div style="display:none;" class="error" id="rstgrp_id_err"></div>	<div class="field-row">		<label for="rstgrp_group">{$_lang.tbl_rest_groups.label.rstgrp_group}</label>		<input type="text" name="rstgrp_group" id="rstgrp_group" value="{$tbl_rest_groupsinfo.rstgrp_group}"/>		<div class="error" id="rstgrp_group_err"></div>	</div>	<div class="field-row">		<label for="rstgrp_desc">{$_lang.tbl_rest_groups.label.rstgrp_desc}</label>		<input type="text" name="rstgrp_desc" id="rstgrp_desc" value="{$tbl_rest_groupsinfo.rstgrp_desc}"/>		<div class="error" id="rstgrp_desc_err"></div>	</div>	<!--	<div class="field-row">		<label for="rstgrp_start_date">{$_lang.tbl_rest_groups.label.rstgrp_start_date}</label>		<input type="text" name="rstgrp_start_date" id="rstgrp_start_date" value="{$tbl_rest_groupsinfo.rstgrp_start_date}"/>		<div class="error" id="rstgrp_start_date_err"></div>	</div>	-->	<!--	<div class="field-row">		<label for="rstgrp_end_date">{$_lang.tbl_rest_groups.label.rstgrp_end_date}</label>		<input type="text" name="rstgrp_end_date" id="rstgrp_end_date" value="{$tbl_rest_groupsinfo.rstgrp_end_date}"/>		<div class="error" id="rstgrp_end_date_err"></div>	</div>	-->	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/> <input  data-inline="true" data-icon="save"  type="submit" value="{$_lang.save_lbl}"/> <input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></center></form><div id="tbl_rest_groups_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">	<table class="listTable">		<tr><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>		<tr><td class="fieldItem">{$_lang.tbl_rest_groups.label.rstgrp_id}<i>:</i></td><td class="valueItem">{$tbl_rest_groupsinfo.rstgrp_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_rest_groups.label.rstgrp_group}<i>:</i></td><td class="valueItem">{$tbl_rest_groupsinfo.rstgrp_group}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_rest_groups.label.rstgrp_desc}<i>:</i></td><td class="valueItem">{$tbl_rest_groupsinfo.rstgrp_desc}</td></tr>	<!--		<tr><td class="fieldItem">{$_lang.tbl_rest_groups.label.rstgrp_start_date}<i>:</i></td><td class="valueItem">{$tbl_rest_groupsinfo.rstgrp_start_date}</td></tr>	-->	<!--		<tr><td class="fieldItem">{$_lang.tbl_rest_groups.label.rstgrp_end_date}<i>:</i></td><td class="valueItem">{$tbl_rest_groupsinfo.rstgrp_end_date}</td></tr>	-->	<tr><td class="fieldItem">{$_lang.tbl_rest_groups.label.isActive}<i>:</i></td><td class="valueItem">{if $tbl_rest_groupsinfo.isActive eq 1}{$_lang.tbl_rest_groups.label.isActive_yes}{else}{$_lang.tbl_rest_groups.label.isActive_no}{/if}</td></tr>	</table>	<center><input data-inline="true" data-icon="edit" type="button" value="{$_lang.tbl_rest_groups.UPDATE.BTN_LBL}" onclick="$('#tbl_rest_groups_view').hide();$('#frmupdatetbl_rest_groups').show();"/><input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></center></div>{include file="tbl_rest_groups/js.tpl"}</div>{include file="footer.tpl"}