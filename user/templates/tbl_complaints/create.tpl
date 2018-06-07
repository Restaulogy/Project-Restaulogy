{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_complaints.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

{include file="tbl_feedback/tabs.tpl"}

<form name="frmcreatetbl_complaints" id="frmcreatetbl_complaints" onsubmit="return validatetbl_complaints();" method="POST" action="{$page_url}">
	<input type="hidden" name="complnt_id" id="complnt_id" value="0"/>
	<div style="display:none;" class="error" id="Array_err"></div>

	<div class="biz_hidden">
		<label for="complnt_title">{$_lang.tbl_complaints.label.complnt_title}</label>
		<input maxlength="250" id="complnt_title" type="text" value="{$smarty.post.complnt_title}" name="complnt_title"/> 
		<div class="error" id="complnt_title_err"></div>
	</div>

	<div class="field-row">
		<label for="complnt_description">{$_lang.tbl_complaints.label.complnt_description}</label>
		<textarea name="complnt_description"  id="complnt_description">{$smarty.post.complnt_description}</textarea>

		<div class="error" id="complnt_description_err"></div>
	</div>

	<div class="biz_hidden">
		<label for="complnt_email">{$_lang.tbl_complaints.label.complnt_email}</label>
		<input maxlength="255" id="complnt_email" type="text" value="{if $Global_member.email}{$Global_member.email}{else}{$smarty.post.complnt_email}{/if}" name="complnt_email"/>
		<div class="error" id="complnt_email_err"></div>
	</div>

	<div class="field-row">
		<label for="complnt_phone">{$_lang.tbl_complaints.label.complnt_phone}</label>
		<input maxlength="15" id="complnt_phone" type="text" value="{if $Global_member.staff_phone}{$Global_member.staff_phone}{else}{$smarty.post.complnt_phone}{/if}" name="complnt_phone"/>
		<div class="error" id="complnt_phone_err"></div>
	</div>
    <div class="info">{$_custinfo_msg}</div>
    <br>
	<div class="biz_hidden">
		<label for="complnt_restaurant">{$_lang.tbl_complaints.label.complnt_restaurant}</label>
		<input maxlength="11" id="complnt_restaurant" type="text" value="{$smarty.session[$smarty.const.SES_RESTAURANT]}" name="complnt_restaurant"/>
		<div class="error" id="complnt_restaurant_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="complnt_start_date">{$_lang.tbl_complaints.label.complnt_start_date}</label>
		<input  id="complnt_start_date" type="text" value="{$smarty.post.complnt_start_date}" name="complnt_start_date"/> 
		<div class="error" id="complnt_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="complnt_end_date">{$_lang.tbl_complaints.label.complnt_end_date}</label>
		<input  id="complnt_end_date" type="text" value="{$smarty.post.complnt_end_date}" name="complnt_end_date"/> 
		<div class="error" id="complnt_end_date_err"></div>
	</div>
	-->

	<div class="biz_center">
    <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/>
    <input data-inline="true" data-icon="save" type="submit" value="{$_lang.tbl_complaints.CREATE.BTN_LBL}"/>
    <!-- <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/> -->
    </div>
</form>
{include file="tbl_complaints/js.tpl"}

</div>

{include file="ask_cust_nm.tpl"}

{include file="footercontent.tpl"}

{literal}
<script type="text/javascript">

{/literal}
{if $ask_cust_name eq 1}
	 {literal}
        $(function(){ askCustName(); });
	 {/literal}
{/if}
{literal}

</script>
{/literal}
</body></html>
