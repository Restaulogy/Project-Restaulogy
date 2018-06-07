{include file="header.tpl"}<div class="wrapper"><h1>{$tbl_statusesinfo.status_event}-{$tbl_statusesinfo.status_name}-{$_lang.tbl_notifications.title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmupdatetbl_notifications" id="frmupdatetbl_notifications" onsubmit="return validatetbl_notifications();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="notify_id" id="notify_id" value="{$tbl_notificationsinfo.notify_id}"/>	<div style="display:none;" class="error" id="notify_id_err"></div>	<div class="field-row">		<label for="notify_name">{$_lang.tbl_notifications.label.notify_name}</label>		<input type="text" name="notify_name" id="notify_name" value="{$tbl_notificationsinfo.notify_name}"/>		<div class="error" id="notify_name_err"></div>	</div>	<div class="field-row">		<label for="notify_message">{$_lang.tbl_notifications.label.notify_message}</label>		<input type="text" name="notify_message" id="notify_message" value="{$tbl_notificationsinfo.notify_message}"/>		<div class="error" id="notify_message_err"></div>	</div>	<div class="field-row biz_hidden">		<label for="notify_status">{$_lang.tbl_notifications.label.notify_status}</label>        <input id="notify_status" type="text" value="{$tbl_statusesinfo.status_id}" name="notify_status"/>		<div class="error" id="notify_status_err"></div>	</div>	<div class="field-row">		<label for="notify_to_role" class="select ui-select">{$_lang.tbl_notifications.label.notify_to_role}</label> 		<select id="notify_to_role"  name="notify_to_role[]">				<option value="" data-placeholder="true">Choose Role...</option>        {foreach $member_roles as $member_role}<option value="{$member_role@key}" {if $tbl_notificationsinfo.notify_to_role eq $member_role@key}selected="selected"{/if}>{$member_role.member_role_name}</option>{/foreach}		</select>		<div class="error" id="notify_to_role_err"></div>	</div>		<div class="field-row">		<label for="notify_to_role">{$_lang.tbl_notifications.label.notify_type}</label> 		<select name="notify_type" id="notify_type">		  {foreach $_lang.tbl_notifications.enum_notify_type as $ntype}			<option value="{$ntype@key}" {if $tbl_notificationsinfo.notify_type eq $ntype@key}selected='selected'{/if}>{$ntype}</option>			{/foreach} 		</select> 		<div class="error" id="notify_type_err"></div>	</div>	<div class="field-row biz_hidden">		<label for="notify_is_urgent">{$_lang.tbl_notifications.label.notify_is_urgent}</label>		<input id="notify_is_urgent" type="checkbox" value="1" name="notify_is_urgent" {if $tbl_notificationsinfo.notify_is_urgent}checked='checked'{/if}/>		<div class="error" id="notify_is_urgent_err"></div>	</div>	<div class="field-row">		<label for="notify_is_delayed">{$_lang.tbl_notifications.label.notify_is_delayed}</label>		<input id="notify_is_delayed" type="checkbox" value="1" name="notify_is_delayed" {if $tbl_notificationsinfo.notify_is_delayed}checked='checked'{/if}/>		<div class="error" id="notify_is_delayed_err"></div>	</div>	<div class="field-row biz_hidden">		<label for="notify_restaurent">{$_lang.tbl_notifications.label.notify_restaurent}</label>		<input type="text" name="notify_restaurent" id="notify_restaurent" value="{$tbl_notificationsinfo.notify_restaurent}"/>		<div class="error" id="notify_restaurent_err"></div>	</div>	<!--	<div class="field-row">		<label for="notify_start_date">{$_lang.tbl_notifications.label.notify_start_date}</label>		<input type="text" name="notify_start_date" id="notify_start_date" value="{$tbl_notificationsinfo.notify_start_date}"/>		<div class="error" id="notify_start_date_err"></div>	</div>	-->	<!--	<div class="field-row">		<label for="notify_end_date">{$_lang.tbl_notifications.label.notify_end_date}</label>		<input type="text" name="notify_end_date" id="notify_end_date" value="{$tbl_notificationsinfo.notify_end_date}"/>		<div class="error" id="notify_end_date_err"></div>	</div>	--> <div class="biz_center"> {if $tbl_statusesinfo.status_control eq 'MANUAL'}	{if $isUpdate eq 1}	{if $tbl_notificationsinfo.isActive eq 1}	 <input type="button" onclick="window.location.href='{$website}/user/tbl_notifications.php?action=deactivate&notify_id={$tbl_notificationsinfo.notify_id}';" data-inline="true" data-icon="check" value="{$_lang.tbl_notifications.DEACTIVATE.BTN_LBL}"/>	 {else}	 <input type="button" onclick="window.location.href='{$website}/user/tbl_notifications.php?action=activate&notify_id={$tbl_notificationsinfo.notify_id}';" data-inline="true" data-icon="check" value="{$_lang.tbl_notifications.ACTIVATE.BTN_LBL}"/>	 {/if}	{/if} {/if}    <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/>    <input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/>    <input type="button" data-inline="true"  value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/></div></form><div id="tbl_notifications_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">	<table class="listTable">		<tr><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_id}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_name}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_name}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_message}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_message}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_status}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_status}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_to_role}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_to_role}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_is_urgent}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_is_urgent}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_is_delayed}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_is_delayed}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_restaurent}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_restaurent}</td></tr>	<!--		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_start_date}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_start_date}</td></tr>	-->	<!--		<tr><td class="fieldItem">{$_lang.tbl_notifications.label.notify_end_date}<i>:</i></td><td class="valueItem">{$tbl_notificationsinfo.notify_end_date}</td></tr>	-->	<tr><td class="fieldItem">{$_lang.tbl_notifications.label.isActive}<i>:</i></td><td class="valueItem">{if $tbl_notificationsinfo.isActive eq 1}{$_lang.tbl_notifications.label.isActive_yes}{else}{$_lang.tbl_notifications.label.isActive_no}{/if}</td></tr>	</table>    <div class="biz_center">        <input data-inline="true" data-icon="edit" type="button" value="{$_lang.tbl_notifications.UPDATE.BTN_LBL}" onclick="$('#tbl_notifications_view').hide();$('#frmupdatetbl_notifications').show();"/>        <input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete" onclick="window.location.href='{$page_url}'"/>    </div></div>{include file="tbl_notifications/js.tpl"}</div>{include file="footer.tpl"}