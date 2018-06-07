{include file="header.tpl"}<div class="wrapper"><h1>{$_lang.tbl_staff.cust_title}</h1>{if $error_msg}	<center>{$error_msg}</center>{/if}<form name="frmupdatetbl_staff" id="frmupdatetbl_staff" onsubmit="return validatetbl_staff();" method="POST" action="{$page_url}" style="{if $isUpdate eq 1}{else}display:none;{/if}">	<input type="hidden" name="staff_id" id="staff_id" value="{$tbl_staffinfo.staff_id}"/>	<div style="display:none;" class="error" id="staff_id_err"></div> 	{* html_input type="hidden" name="staff_email" value="{$tbl_staffinfo.staff_email}" *}	{html_input type="hidden" name="staff_password" value="{$tbl_staffinfo.staff_password}"}		<input type="hidden" name="staff_member_id" id="staff_member_id" value="{$tbl_staffinfo.staff_member_id}"/>	<div class="error" id="staff_member_id_err"></div>		<label for="staff_phone">{$_lang.tbl_staff.label.staff_phone}</label>	<input type="text" name="staff_phone" id="staff_phone" value="{$tbl_staffinfo.staff_phone}"/>	<div class="error" id="staff_phone_err"></div>		<label for="staff_email">{$_lang.tbl_staff.label.staff_email}</label>	<input type="text" name="staff_email" id="staff_email" value="{$tbl_staffinfo.staff_email}"/>	<div class="error" id="staff_email_err"></div>		<label for="staff_name">{$_lang.tbl_staff.label.staff_name}</label>	<input type="text" name="staff_name" id="staff_name" value="{$tbl_staffinfo.staff_fname} {$tbl_staffinfo.staff_lname}"/>	<div class="error" id="staff_name_err"></div>	<label for="staff_birth_date">{$_lang.tbl_staff.label.staff_birth_date} </label>	<input type="text" name="staff_birth_date" id="staff_birth_date" value="{$tbl_staffinfo.staff_birth_date|date_format:$smarty.const.HTML5_DAY_FORMAT}"/>	<div class="error" id="staff_birth_date_err"></div>		<label for="staff_address">{$_lang.tbl_staff.label.staff_address}</label>	<input type="text" name="staff_address" id="staff_address" value="{$tbl_staffinfo.staff_address}"/>	<div class="error" id="staff_address_err"></div> 	<label for="staff_zip">{$_lang.tbl_staff.label.staff_zip}</label>	<input type="text" name="staff_zip" id="staff_zip" value="{$tbl_staffinfo.staff_zip}"/>	<div class="error" id="staff_zip_err"></div>		<label for="staff_aniversary_dt">{$_lang.tbl_staff.label.staff_aniversary_dt} </label>	<input type="text" name="staff_aniversary_dt" id="staff_aniversary_dt" value="{$tbl_staffinfo.staff_aniversary_dt|date_format:$smarty.const.HTML5_DAY_FORMAT}"/>	<div class="error" id="staff_aniversary_dt_err"></div>				{if $Global_member.member_role_id eq $smarty.const.ROLE_OWNER OR $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_ADMIN OR $Global_member.member_role_id eq $smarty.const.ROLE_DEV}	<div class="field-row">		<label for="staff_loyalty_level">{$_lang.tbl_staff.label.staff_loyalty_level}</label>		<select id="staff_loyalty_level" name="staff_loyalty_level" >						{if $_lylty_levels_lst}				<option value="0">Select Level</option>			{foreach $_lylty_levels_lst as $_level}				<option value="{$_level@key}" {if $tbl_staffinfo.staff_loyalty_level eq $_level@key}selected="selected"{/if}>{$_level}</option>			{/foreach}			{/if}		</select>		<div class="error" id="staff_loyalty_level_err"></div>	</div>				<div class="biz_hidden" >		<label for="staff_role">{$_lang.tbl_staff.staff_role}</label>		<div >		<select name='staff_role' id='staff_role'>			<option value="">Select Role</option>			{if $act_roles}				{foreach from=$act_roles item=role}				 {if $role.member_role_id neq $smarty.const.ROLE_DEV}					<option value="{$role.member_role_id}" {if $tbl_staffinfo.staff_role eq $role.member_role_id}selected="selected"{/if}>{$role.member_role_name}</option>				{/if}				{/foreach}			{/if}		</select>		</div>		<div class="error" id="staff_role_err"></div>	</div>	{/if}		<input type="hidden" name="is_customer_upd" id="is_customer_upd" value="1"/>	<!--    <label for="staff_device_id">{$_lang.tbl_staff.label.staff_device_id}</label>	<input type="text" name="staff_device_id" id="staff_device_id" value="{$tbl_staffinfo.staff_device_id}"/>	<div class="error" id="staff_device_id_err"></div>	<label for="staff_gcm_reg_id">{$_lang.tbl_staff.label.staff_gcm_reg_id}</label>	<input type="text" name="staff_gcm_reg_id" id="staff_gcm_reg_id" value="{$tbl_staffinfo.staff_gcm_reg_id}"/>	<div class="error" id="staff_gcm_reg_id_err"></div>	<label for="staff_description">{$_lang.tbl_staff.label.staff_description}</label>	 <textarea name="staff_description" id="staff_description">{$tbl_staffinfo.staff_description}</textarea>	<div class="error" id="staff_description_err"></div>	<label for="staff_desigation">{$_lang.tbl_staff.label.staff_desigation}</label>	<input type="text" name="staff_desigation" id="staff_desigation" value="{$tbl_staffinfo.staff_desigation}"/>	<div class="error" id="staff_desigation_err"></div>    <label for="staff_start_date">{$_lang.tbl_staff.label.staff_start_date}</label>	<input type="text" name="staff_start_date" id="staff_start_date" value="{$tbl_staffinfo.staff_start_date}"/>	<div class="error" id="staff_start_date_err"></div>	<label for="staff_end_date">{$_lang.tbl_staff.label.staff_end_date}</label>	<input type="text" name="staff_end_date" id="staff_end_date" value="{$tbl_staffinfo.staff_end_date}"/>	<div class="error" id="staff_end_date_err"></div>	<label for="staff_restaurent">{$_lang.tbl_staff.label.staff_restaurent}</label>	<input type="text" name="staff_restaurent" id="staff_restaurent" value="{$tbl_staffinfo.staff_restaurent}"/>	<div class="error" id="staff_restaurent_err"></div>    -->	<input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/>    <!-- <input class="fright" type="reset" onclick="$('#tbl_staff_view').show();$('#frmupdatetbl_staff').hide();" value="{$_lang.cancel_lbl}"/> --></form><div id="tbl_staff_view" class="description" style="{if $isUpdate eq 1}display:none;{/if}">	<table class="listTable">		<tr class="biz_hidden"><th class="fieldItem">{$_lang.field_title}</th><th class="valueItem">{$_lang.value_title}</th></tr>		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_full_name}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_full_name}</td></tr> 		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_address}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_address}</td></tr> 		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_zip}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_zip}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_phone}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_phone}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_device_id}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_device_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_gcm_reg_id}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_gcm_reg_id}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_description}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_description}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_desigation}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_desigation}</td></tr>		<!--<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_start_date}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_start_date}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_end_date}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_end_date}</td></tr>		<tr><td class="fieldItem">{$_lang.tbl_staff.label.staff_restaurent}<i>:</i></td><td class="valueItem">{$tbl_staffinfo.staff_restaurent}</td></tr>-->	<tr><td class="fieldItem">{$_lang.tbl_staff.label.isActive}<i>:</i></td><td class="valueItem">{if $tbl_staffinfo.isActive eq 1}{$_lang.tbl_staff.label.isActive_yes}{else}{$_lang.tbl_staff.label.isActive_no}{/if}</td></tr>	</table>	<!--<input class="fleft" type="button" value="{$_lang.tbl_staff.UPDATE.BTN_LBL}" onclick="$('#tbl_staff_view').hide();$('#frmupdatetbl_staff').show();"/>--></div><div class="biz_center"><!--{if $tbl_staffinfo.isActive eq 1}	<input type="button" value="{$_lang.tbl_staff.DEACTIVATE.BTN_LBL}" onclick="location.href='{$page_url}?action=deactivate&staff_id={$tbl_staffinfo.staff_id}';" data-inline="true" data-icon="inactive" title="{$_lang.tbl_staff.DEACTIVATE.BTN_LBL}" />{else}	<input type="button" value="{$_lang.tbl_staff.ACTIVATE.BTN_LBL}" onclick="location.href='{$page_url}?action=activate&staff_id={$tbl_staffinfo.staff_id}';" data-inline="true" data-icon="active" title="{$_lang.tbl_staff.ACTIVATE.BTN_LBL}" />{/if}-->{if $isUpdate eq 1}<input data-inline="true" data-icon="save" type="button" onclick="$('#frmupdatetbl_staff').submit();" value="{$_lang.save_lbl}"/>{/if}{if $tbl_staffinfo.staff_is_crm_subscribed eq 1}	<a href="{$page_url}?action=unsubscribe&staff_id={$tbl_staffinfo.staff_id}&staff_member_id={$tbl_staffinfo.staff_member_id}" data-role="button" data-inline="true" data-icon="inactive" title="Unsubscribe">{$_lang.tbl_staff.UNSUBSCRIBE.BTN_LBL}</a>{else}	<a href="{$page_url}?action=subscribe&staff_id={$tbl_staffinfo.staff_id}&staff_member_id={$tbl_staffinfo.staff_member_id}" data-role="button" data-inline="true" data-icon="active" title="Subscribe">{$_lang.tbl_staff.SUBSCRIBE.BTN_LBL}</a>{/if}            <!--<input type="button" value="{$_lang.tbl_staff.BANN_USER.BTN_LBL}" data-inline="true" data-icon="delete" onclick="location.href='{$page_url}?action=BANN_USER&staff_member_id={$tbl_staffinfo.staff_member_id}';" />--><input type="button" value="{$_lang.cancel_lbl}" data-inline="true" data-icon="delete"  onclick="window.location.href='{$website}/user/rewrad_point_list.php'"/></div>{include file="tbl_staff/js.tpl"}{include file='footercontent.tpl'}{literal}    <script type="text/javascript">          $(function(){              $("#staff_birth_date").scroller({ display:'bubble', preset: 'date', dateFormat: 'mm/dd/yyyy', timeWheels: 'yyyymmdd', animate: 'slidevertical',startYear: ((new Date).getFullYear() - 40)});              $("#staff_aniversary_dt").scroller({ display:'bubble', preset: 'date', dateFormat: 'mm/dd/yyyy', timeWheels: 'yyyymmdd', animate: 'slidevertical',startYear: ((new Date).getFullYear() - 40)});           });    </script>{/literal}</body></html>