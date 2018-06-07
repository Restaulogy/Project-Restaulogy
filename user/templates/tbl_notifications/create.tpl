{include file="header.tpl"}

<div class="wrapper">
<h1>{$tbl_statusesinfo.status_event}-{$tbl_statusesinfo.status_name}-{$_lang.tbl_notifications.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_notifications" id="frmcreatetbl_notifications" onsubmit="return validatetbl_notifications();" method="POST" action="{$page_url}">
	<input type="hidden" name="notify_id" id="notify_id" value="0"/>
	<div style="display:none;" class="error" id="notify_id_err"></div>

	<div class="field-row">
		<label for="notify_name">{$_lang.tbl_notifications.label.notify_name}</label>
		<input maxlength="250" id="notify_name" type="text" value="{$smarty.post.notify_name}" name="notify_name"/> 
		<div class="error" id="notify_name_err"></div>
	</div>

 	<div class="field-row">
		<label for="notify_message">{$_lang.tbl_notifications.label.notify_message}</label>
		<textarea name="notify_message"  id="notify_message">{$smarty.post.notify_message}</textarea>

		<div class="error" id="notify_message_err"></div>
	</div>

	<div class="field-row biz_hidden">
		<label for="notify_status">{$_lang.tbl_notifications.label.notify_status}</label>
		<input id="notify_status" type="text" value="{$tbl_statusesinfo.status_id}" name="notify_status"/>
		<div class="error" id="notify_status_err"></div>
	</div>

	<div class="field-row">
		<label for="notify_to_role" class="select ui-select">{$_lang.tbl_notifications.label.notify_to_role}</label> 
        <select id="notify_to_role"  name="notify_to_role[]" multiple="multiple" data-native-menu="false"> 
 				<option value="" data-placeholder="true">Choose Role...</option>
        {foreach $member_roles as $member_role}<option value="{$member_role@key}" {if $smarty.post.notify_to_role eq $member_role@key}selected="selected"{/if}>{$member_role.member_role_name}</option>{/foreach}
		</select>
		<div class="error" id="notify_to_role_err"></div>
		<div class="info" >{$_lang.tbl_notifications.role_extra_info}</div>
		
	</div>
	
	<div class="field-row">
		<label for="notify_to_role">{$_lang.tbl_notifications.label.notify_type}</label>
		<select name="notify_type" id="notify_type"> 
		  {foreach $_lang.tbl_notifications.enum_notify_type as $ntype}
				<option value="{$ntype@key}" {if $smarty.request.notify_type eq $ntype@key}selected='selected'{/if}>{$ntype}</option>
			{/foreach}   
		</select> 
		<div class="error" id="notify_type_err"></div>
	</div>

	<div class="field-row biz_hidden">
		<label for="notify_is_urgent">{$_lang.tbl_notifications.label.notify_is_urgent}</label>
		<input id="notify_is_urgent" type="checkbox" value="1" name="notify_is_urgent" {if $smarty.post.notify_is_urgent}checked='checked'{/if}/>
		<div class="error" id="notify_is_urgent_err"></div>
	</div>

	<div class="field-row">
		<label for="notify_is_delayed">{$_lang.tbl_notifications.label.notify_is_delayed}</label>
		<input id="notify_is_delayed" type="checkbox" value="1" name="notify_is_delayed" {if $smarty.post.notify_is_delayed}checked='checked'{/if}/>
		<div class="error" id="notify_is_delayed_err"></div>
	</div>

	<div class="field-row biz_hidden">
		<label for="notify_restaurent">{$_lang.tbl_notifications.label.notify_restaurent}</label>
		<input maxlength="11" id="notify_restaurent" type="text" value="{$smarty.post.notify_restaurent}" name="notify_restaurent"/>
		<div class="error" id="notify_restaurent_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="notify_start_date">{$_lang.tbl_notifications.label.notify_start_date}</label>
		<input  id="notify_start_date" type="text" value="{$smarty.post.notify_start_date}" name="notify_start_date"/>
		<div class="error" id="notify_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="notify_end_date">{$_lang.tbl_notifications.label.notify_end_date}</label>
		<input  id="notify_end_date" type="text" value="{$smarty.post.notify_end_date}" name="notify_end_date"/>
		<div class="error" id="notify_end_date_err"></div>
	</div>
	-->

	<center><input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></center>
</form>
{include file="tbl_notifications/js.tpl"}

</div>

{include file="footer.tpl"}

