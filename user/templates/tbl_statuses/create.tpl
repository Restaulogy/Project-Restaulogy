{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_statuses.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

{include file="tbl_statuses/tabs.tpl"}

<form name="frmcreatetbl_statuses" id="frmcreatetbl_statuses" onsubmit="return validatetbl_statuses();" method="POST" action="{$page_url}">
	<input type="hidden" name="status_id" id="status_id" value="0"/>
	<div style="display:none;" class="error" id="status_id_err"></div>

	<div class="field-row">
		<label for="status_name">{$_lang.tbl_statuses.label.status_name}</label>
		<input maxlength="250" id="status_name" type="text" value="{$smarty.post.status_name}" name="status_name"/> 
		<div class="error" id="status_name_err"></div>
	</div>

	<div class="field-row">
		<label for="status_desc">{$_lang.tbl_statuses.label.status_desc}</label>
		<textarea name="status_desc"  id="status_desc">{$smarty.post.status_desc}</textarea>  
		<div class="error" id="status_desc_err"></div>
	</div>

	<div class="field-row">
		<label for="status_event">{$_lang.tbl_statuses.label.status_event}</label> 
		<select name="status_event" id="status_event" onclick="getAllStatusByEvent(this.value);"> 
			<option value="REQUEST" {if $status_event eq 'REQUEST'}selected="selected"{/if}>REQUEST</option>
			<option value="ORDER" {if $status_event eq 'ORDER'}selected="selected"{/if}>ORDER</option>
			<option value="TABLE" {if $status_event eq 'TABLE'}selected="selected"{/if}>TABLE</option>
			<option value="PROMOTION" {if $status_event eq 'PROMOTION'}selected="selected"{/if}>PROMOTION</option>
			<!-- <option value="PAYMENT" {if $status_event eq 'PAYMENT'}selected="selected"{/if}>PAYMENT</option>  -->
		</select> 
		<div class="error" id="status_event_err"></div>
	</div>

	<div class="field-row {if $Global_member.member_role_id neq $smarty.const.ROLE_DEV}biz_hidden{/if}">
 		<label for="status_control">{$_lang.tbl_statuses.label.status_control}</label>		 
		<select name="status_control" id="status_control"> 
			<option value="AUTO" disabled="disabled">AUTOMATIC</option>
			<option value="MANUAL" selected="selected">MANUALLY</option>
		</select>  
		<div class="error" id="status_control_err"></div>
</div>

	<div class="field-row">
		<label for="status_prev">{$_lang.tbl_statuses.label.status_prev}</label>
		<Select name="status_prev" id="status_prev" onchange="populate_next(this.value);">
		<option value="">Select Previous Status</option>
        {foreach $lst_drpdwn_status as $_status}
              <option value="{$_status.status_id}" {if $tbl_statusesinfo.status_prev eq $_status.status_id} selected='selected' {/if}>After {$_status.status_name}</option>
        {/foreach}
        </select>
		<div class="error" id="status_prev_err"></div>
	</div>
	
	<div class="field-row">
		<label for="tmp_status_next">{$_lang.tbl_statuses.label.status_next}</label>
		<div id='div_tmp_status_next' style='font-weight:bold;font-style:Italic;'> Select previous status</div>
	</div>
  
	<div class="field-row">
		<label for="status_next_must">{$_lang.tbl_statuses.label.status_next_must}</label>
		<Select name="status_next_must" id="status_next_must" onchange="populate_prev_must(this.value);">
		<option value="">Select Next Mandatory Status</option>
        {foreach $mandatory_list as $_status}
              <option value="{$_status.status_id}" {if $tbl_statusesinfo.status_next_must eq $_status.status_id} selected='selected' {/if}>{$_status.status_name}</option>
        {/foreach}
        </select>
		<div class="error" id="status_next_must_err"></div>
	</div>
	
  <div class="field-row">
		<label for="tmp_status_prev_must">{$_lang.tbl_statuses.label.status_prev_must}</label>
		<div id='div_tmp_status_prev_must' style='font-weight:bold;font-style:Italic;'> Select Next Mandatory status</div>
	</div> 
				 
	<div class="field-row biz_hidden">
		<label for="status_next">{$_lang.tbl_statuses.label.status_next}</label>
		<input maxlength="11" id="status_next" type="text" value="{$smarty.post.status_next}" name="status_next"/>
		<div class="error" id="status_next_err"></div>
	</div>

	<div class="field-row">
		<label for="status_exp_time">{$_lang.tbl_statuses.label.status_exp_time}</label>
		<input maxlength="4" id="status_exp_time" type="text" value="{$smarty.post.status_exp_time}" name="status_exp_time"/> 
		<div class="error" id="status_exp_time_err"></div>
	</div>

	<div class="field-row biz_hidden">
		<label for="status_color">{$_lang.tbl_statuses.label.status_color}</label>
		<input maxlength="6" id="status_color" type="text" value="{$smarty.post.status_color}" name="status_color"/> 
		<div class="error" id="status_color_err"></div>
	</div>
	
	 <div class="field-row">
        	<label for="status_trigger" class="select ui-select">{$_lang.tbl_statuses.label.status_trigger}</label>
            <select id="status_trigger"  name="status_trigger[]" multiple="multiple" data-native-menu="false">
 				<option value="" data-placeholder="true">Choose Role...</option>
            {foreach $member_roles as $member_role}
              <option value="{$member_role.member_role_id}">{$member_role.member_role_name}</option>
            {/foreach}
        </select>
		<div class="error" id="status_trigger_err"></div>
	</div>

	<div class="field-row {if $Global_member.member_role_id neq $smarty.const.ROLE_DEV} biz_hidden {/if}">
		<label for="status_hidden">{$_lang.tbl_statuses.label.status_hidden}</label>
        <Select id="status_hidden" name="status_hidden" >
            <option value="0" {if $smarty.post.status_hidden eq 1}selected="selected"{/if}>ADMIN</option>
            <option value="1" {if $smarty.post.status_hidden eq 1}selected="selected"{/if}>SYSTEM</option>
        </select>
		<!-- <input type="checkbox" id="status_hidden" name="status_hidden" value="1" {if $smarty.post.status_hidden eq 1}checked="checked"{/if}/> -->
		<div class="error" id="status_hidden_err"></div>
	</div>
	
	<div class="field-row">
		<label for="status_is_optional">
		<input type="checkbox" name="status_is_optional" value="1" id="status_is_optional" {if $smarty.post.status_is_optional eq 1}checked="checked"{/if}/>{$_lang.tbl_statuses.label.status_is_optional}
		</label> 
		<div class="error" id="status_is_optional_err"></div>
	</div>	

	<div class="field-row biz_hidden">
		<label for="status_restaurant">{$_lang.tbl_statuses.label.status_restaurant}</label>
		<input maxlength="11" id="status_restaurant" type="text" value="{$smarty.session[$smarty.const.SES_RESTAURANT]}" name="status_restaurant"/>  
		<div class="error" id="status_restaurant_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="status_start_date">{$_lang.tbl_statuses.label.status_start_date}</label>
		<input  id="status_start_date" type="text" value="{$smarty.post.status_start_date}" name="status_start_date"/> 
		<div class="error" id="status_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="status_end_date">{$_lang.tbl_statuses.label.status_end_date}</label>
		<input  id="status_end_date" type="text" value="{$smarty.post.status_end_date}" name="status_end_date"/> 
		<div class="error" id="status_end_date_err"></div>
	</div>
	-->

	<div class="info">{$_lang.tbl_statuses.info.status_control}</div>
	<div class="biz_center">
    <input type="hidden" id="status_notifier" value="" />
    <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/></div>
</form>
{include file="tbl_statuses/js.tpl"}

</div>

{include file="footer.tpl"}

