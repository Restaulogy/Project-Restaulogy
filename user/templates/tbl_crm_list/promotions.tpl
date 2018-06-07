<div id="popupPromotions" style="display:none;position:fixed;width:325px;z-index:900;top: 50%;left: 50%;margin-left:-120px;margin-top:-150px;border:1px solid #FF9600;" class='ui-body-a'>
    <div data-role="header" data-theme="a" class="ui-corner-top">
    <h1>Email/SMS Promotion</h1>
 	<a href="#" onclick="$('#popupPromotions').hide();" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">
    <div id='x_recipient' class="info"></div>

    <fieldset data-role="controlgroup" data-type="horizontal" style="width:100%px;border-bottom:solid white 1px;" >
	<!-- <legend>Choose a type:</legend> -->
     	<label for="tab_email"><input type="radio" name="tab_sms_email" id="tab_email" value="email" {if $tab_sms_email_text eq 'email'}checked="checked"{/if} checked="checked" onclick='open_prom_sel_dialogue("email");' />
     	Email Promotion</label>
        <label for="tab_sms"><input type="radio" name="tab_sms_email" id="tab_sms" value="sms" {if $tab_sms_email_text eq 'sms'}checked="checked"{/if} onclick='open_prom_sel_dialogue("sms");' />
     	SMS Promotion</label>
    </fieldset>
    
		 	<label for='promotions'>Select Promotion</label>
                <select name="prom_id" id="prom_id" onchange="fill_prom_text();">
                    <option value="">Select One</option>
        			{foreach $lst_promotion as $promotion}
        				<option value="{$promotion@key}" {if $prom_detail.id eq $promotion@key} selected='selected'{/if}>{$promotion}</option>
        			{/foreach}
        			<option value="0">All the current and forthcoming promotions</option>
        		</select>
				<div id="prom_id_err" class="error"></div>
				

				<label for='sms_msg'>Message</label>
				
                <div id='sms_part'>
                	{* jqmbutton icon="save" type="button" value="Add Promotions Link" name="ad_pr_lst_lnk" onclick="add_promotion_list_lnk('sms');" *}
                    <textarea type='text' name='sms_text_msg' id='sms_text_msg' onkeyup="textCounter(this,'counter',100);" style='height:120px;'></textarea>
                    Remaining characters (Max. 100):<input type="text" data-mini="true" data-inline="true" disabled  maxlength="3" size="3" value="100" id="counter" />
            		<div id="sms_text_msg_err" class="error"></div>
            		
            		<div class="biz_center">
            			{jqmbutton icon="star" type="button" value="Send SMS" name="send_sms" onclick="val_and_submit();"  }
            		</div>
        		</div>

				<div id='email_part' >
                    {* jqmbutton icon="save" type="button" value="Add Promotions Link" name="ad_pr_lst_lnk_em" onclick="add_promotion_list_lnk('email');" *}
    				<textarea type='text' name='sms_msg' id='sms_msg' style='height:120px;'></textarea>
            		<div id="sms_msg_err" class="error"></div>
        		
					{jqmbutton icon="star" type="button" value="Send" name="email_prom" onclick="val_and_submit();" }
					{jqmbutton id='email_prev' icon="search" type="button" value="Preview" name="email_prev" onclick="show_hide_preview(1);"}
				</div> 
				
				<div data-role="popup" id='popup_email_preview' style='width:300px;z-index:999990 !important;border:1px solid #FF9600 !important;' class='ui-body-a'>
				    <div data-role="header" data-theme="a" class="ui-corner-top">
                        <h6>Email Preview </h6>
                        <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
                    </div>
                    <div id='email_preview' data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;"></div>
               </div>
		</div>
</div>
