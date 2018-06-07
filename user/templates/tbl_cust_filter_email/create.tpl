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
                    <select name="cfe_filter" id="cfe_filter" onchange="showhidexval()">
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
                <div id='div_cfe_value' class="field-row">
            		<label for="cfe_value">{$_lang.tbl_cust_filter_email.label.cfe_value}</label>
            		<input maxlength="11" id="cfe_value" type="text" value="{$smarty.post.cfe_value}" name="cfe_value"/>
            		<div class="error" id="cfe_value_err"></div>
            	</div>
             </td>
        </tr>
    </table>
	

	<fieldset data-role="controlgroup" data-type="horizontal" style="width:100%px;border-bottom:solid white 1px;" >
	    <!-- <legend>Choose a type:</legend> -->
     	<label for="tab_email"><input type="radio" name="tab_sms_email" id="tab_email" value="email" {if $tab_sms_email_text eq 'email'}checked="checked"{/if} checked="checked" onclick='open_prom_sel_dialogue("email");' />
     	Email Promotion</label>
        <label for="tab_sms"><input type="radio" name="tab_sms_email" id="tab_sms" value="sms" {if $tab_sms_email_text eq 'sms'}checked="checked"{/if} onclick='open_prom_sel_dialogue("sms");' />
     	SMS Promotion</label>
    </fieldset>

        <table>
            <tr>
                <td width="60%">
                <label for='promotions'>Select Promotion</label>
                    <select name="prom_id" id="prom_id" onchange="fill_prom_text();" >
                        <option value="">Select One</option>
            			{foreach $lst_promotion as $promotion}
            				<option value="{$promotion@key}" {if $prom_detail.id eq $promotion@key} selected='selected'{/if}>{$promotion}</option>
            			{/foreach}
            		</select>
            		<div id="prom_id_err" class="error"></div>
                </td>
                <td width="40%">
                    <label for='promotions'>&nbsp;</label>
                    <input data-inline="true" data-icon="star" type="button" onclick="window.location.href='{$website}/modules/business_listing/promotion.php?list_id={$smarty.session[$smarty.const.SES_RESTAURANT]}&new=1';" value="Add New Promotion"/>
                </td>
            </tr>
        </table>
        

        
		<label for='sms_msg'>Message</label>
        <div id='sms_part'>
            <textarea type='text' name='sms_text_msg' id='sms_text_msg' onkeyup="textCounter(this,'counter',125);" style='height:120px;'></textarea>
            Remaining characters (Max. 125):<input type="text" data-mini="true" data-inline="true" disabled  maxlength="3" size="3" value="125" id="counter" />
    		<div id="sms_text_msg_err" class="error"></div>
            <!--
        		<div class="biz_center">
        			{jqmbutton icon="star" type="submit" value="Send SMS" name="send_sms" }
        		</div>
    		-->
		</div>

		<div id='email_part' class="biz_center">
			<textarea type='text' name='sms_msg' id='sms_msg' style='height:120px;'></textarea>
    		<div id="sms_msg_err" class="error"></div>
		</div>
				
				
	<table >
        <tr>
            <td width='48%'>
                <div class="biz_hidden">
            		<label for="cfe_period_start">{$_lang.tbl_cust_filter_email.label.cfe_period_start}</label>
            		<input  id="cfe_period_start" type="text" value="{$smarty.post.cfe_period_start}" name="cfe_period_start"/>
            		<div class="error" id="cfe_period_start_err"></div>
            	</div>
            </td>
            <td width='5%'>
                    &nbsp;
            </td>
            <td width='47%'>
                    <div class="biz_hidden">
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
        <input type='hidden' name='rest_name' id='rest_name' value="{$smarty.session[$smarty.const.RESTAURENT_NAME]}"/>
        <input type="hidden" id="hid_action" name="hid_action" value=""/>
        <input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_CREATE}"/>
        <input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/>
        
        <span id="btn_previe_t">
            <input  data-inline="true" data-icon="search" type="button" value="Preview" onclick="show_hide_preview(1);"}/>
        </span>

        <input data-inline="true" data-icon="delete" type="reset" value="{$_lang.cancel_lbl}" onclick="window.location.href='{$page_url}'"/>
    </div>
    
</form>

{include file="tbl_cust_filter_email/template_preview.tpl"}
               
{include file="tbl_cust_filter_email/js.tpl"}

</div>
{include file='footercontent.tpl'}

{literal}
    <script type="text/javascript">
          $(function(){
              open_prom_sel_dialogue("{/literal}{$tab_sms_email}{literal}");
              //$("#cfe_period_start, #cfe_period_end").scroller({ display:'bubble', preset: 'date', dateFormat: 'mm/dd/yyyy', timeWheels: 'yyyymmdd', animate: 'slidevertical'});
          });
    </script>
{/literal}

</body></html>

