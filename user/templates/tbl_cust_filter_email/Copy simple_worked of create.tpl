{include file="header.tpl"}

<div class="wrapper">
<h1>{$_lang.tbl_cust_filter_email.create_title}</h1>

{if $error_msg}
	<center>{$error_msg}</center>
{/if}

<form name="frmcreatetbl_cust_filter_email" id="frmcreatetbl_cust_filter_email" onsubmit="return validatetbl_cust_filter_email();" method="POST" action="{$page_url}">
	<input type="hidden" name="cfe_id" id="cfe_id" value="0"/>
	<div style="display:none;" class="error" id="cfe_id_err"></div>

    <table >
        <tr>
            <td width='70%'>
                <div class="field-row">
            		<label for="cfe_filter">{$_lang.tbl_cust_filter_email.label.cfe_filter}</label>
                    <select name="cfe_filter" id="cfe_filter">
                    	{foreach $lst_cust_filters as $_cust_filt}
                		 	<option value="{$_cust_filt@key}" {if $smarty.post.cfe_filter && ($_cust_filt@key eq $smarty.post.cfe_filter) }selected="selected"{/if}>{$_cust_filt}</option>
                		 {/foreach}
                    </select>
            		<div class="error" id="cfe_filter_err"></div>
            	</div>
            </td>
            <td width='5%'>
                    &nbsp;
             </td>
            <td width='25%'>
                    <div class="field-row">
                		<label for="cfe_value">{$_lang.tbl_cust_filter_email.label.cfe_value}</label>
                		<input maxlength="11" id="cfe_value" type="text" value="{$smarty.post.cfe_value}" name="cfe_value"/>
                		<div class="error" id="cfe_value_err"></div>
                	</div>
             </td>
        </tr>
    </table>
	

	<div class="field-row">
		<label for="cfe_promotion">{$_lang.tbl_cust_filter_email.label.cfe_promotion}</label>
		<input maxlength="11" id="cfe_promotion" type="text" value="{$smarty.post.cfe_promotion}" name="cfe_promotion"/> 
		<div class="error" id="cfe_promotion_err"></div>
	</div>

	<div class="field-row">
		<label for="cfe_mesasge">{$_lang.tbl_cust_filter_email.label.cfe_mesasge}</label>
		<input maxlength="11" id="cfe_mesasge" type="text" value="{$smarty.post.cfe_mesasge}" name="cfe_mesasge"/> 
		<div class="error" id="cfe_mesasge_err"></div>
	</div>

	<div class="field-row">
		<label for="cfe_email_or_sms">{$_lang.tbl_cust_filter_email.label.cfe_email_or_sms}</label>
            <select name="cfe_email_or_sms" id="cfe_email_or_sms">
            		{foreach $lst_sms_email as $_sms_email}
            		 	<option value="{$_sms_email@key}" {if $smarty.post.cfe_email_or_sms && ($_sms_email@key eq $smarty.post.cfe_email_or_sms) }selected="selected"{/if}>{$_sms_email}</option>
            		{/foreach}
            </select>
		<div class="error" id="cfe_email_or_sms_err"></div>
	</div>
	
	<table >
        <tr>
            <td width='48%'>
                <div class="field-row">
            		<label for="cfe_period_start">{$_lang.tbl_cust_filter_email.label.cfe_period_start}</label>
            		<input  id="cfe_period_start" type="text" value="{$smarty.post.cfe_period_start}" name="cfe_period_start"/>
            		<div class="error" id="cfe_period_start_err"></div>
            	</div>
            </td>
            <td width='5%'>
                    &nbsp;
             </td>
            <td width='47%'>
                    <div class="field-row">
                		<label for="cfe_period_end">{$_lang.tbl_cust_filter_email.label.cfe_period_end}</label>
                		<input  id="cfe_period_end" type="text" value="{$smarty.post.cfe_period_end}" name="cfe_period_end"/>
                		<div class="error" id="cfe_period_end_err"></div>
                	</div>
             </td>
        </tr>
    </table>
	

	<div class="biz_hidden">
		<label for="cfe_restaurant">{$_lang.tbl_cust_filter_email.label.cfe_restaurant}</label>
		<input id="cfe_restaurant" type="text" value="{$smarty.session[$smatry.const.SES_RESTAURANT]}" name="cfe_restaurant"/>
		<div class="error" id="cfe_restaurant_err"></div>
	</div>

	<!--
	<div class="field-row">
		<label for="cfe_start_date">{$_lang.tbl_cust_filter_email.label.cfe_start_date}</label>
		<input  id="cfe_start_date" type="text" value="{$smarty.post.cfe_start_date}" name="cfe_start_date"/> 
		<div class="error" id="cfe_start_date_err"></div>
	</div>
	-->

	<!--
	<div class="field-row">
		<label for="cfe_end_date">{$_lang.tbl_cust_filter_email.label.cfe_end_date}</label>
		<input  id="cfe_end_date" type="text" value="{$smarty.post.cfe_end_date}" name="cfe_end_date"/> 
		<div class="error" id="cfe_end_date_err"></div>
	</div>
	-->

	<div class="biz_center">
    <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/><input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/>
    </div>
    
</form>
{include file="tbl_cust_filter_email/js.tpl"}

</div>

{include file="footer.tpl"}


