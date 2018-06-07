<div id="popupMenus" style="display:none;position:fixed;width:325px;z-index:900;top: 50%;left: 50%;margin-left:-120px;margin-top:-150px;border:1px solid #FF9600;" class='ui-body-a'>
    <div data-role="header" data-theme="a" class="ui-corner-top">
    <h1>Email/SMS Menu Items</h1>
 	<a href="#" onclick="$('#popupMenus').hide();" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">
    <div id='x_recipient' class="info"></div>

    <fieldset data-role="controlgroup" data-type="horizontal" style="width:100%px;border-bottom:solid white 1px;" >
	<!-- <legend>Choose a type:</legend> -->
     	<label for="tab_email"><input type="radio" name="tab_sms_email" id="tab_email" value="email" {if $tab_sms_email_text eq 'email'}checked="checked"{/if} checked="checked" onclick='open_prom_sel_dialogue("email","menus");' />
     	Email Menu</label>
        <label for="tab_sms"><input type="radio" name="tab_sms_email" id="tab_sms" value="sms" {if $tab_sms_email_text eq 'sms'}checked="checked"{/if} onclick='open_prom_sel_dialogue("sms","menus");' />
     	SMS Menu</label>
    </fieldset>
    
		 	<label for='menus'>Select Menu Items</label>
		 		<!--<input type="button" data-role="button" data-inline="true" data-mini="true" id="sh_prev" name="sh_prev" value="View" onclick="fill_menu_text();" />-->
                <select id="menu_id" name="menu_id[]" multiple="multiple" data-native-menu="false" onchange="fill_menu_text();"  >
                    <option value="">Select Menu </option>        			
        			{foreach from=$lst_menu key=sub_mnu_dish_id item=sub_mnu_dish}
						<option value='{$sub_mnu_dish_id}' {if $sub_mnu_dish_id eq $pst_menu_id }selected="selected"{/if}>{$sub_mnu_dish}</option>
					{/foreach}         			
        		</select>
				<div id="menu_id_err" class="error"></div>				

				<label for='sms_msg_mnu'>Message</label>
				
                <div id='sms_part_mnu'>                	
                    <textarea type='text' name='sms_text_msg_mnu' id='sms_text_msg_mnu' onkeyup="textCounter(this,'counter_mnu',100);" style='height:120px;'>{if $pst_sms_txt}{$pst_sms_txt}{/if}</textarea>
                    Remaining characters (Max. 100):<input type="text" data-mini="true" data-inline="true" disabled  maxlength="3" size="3" value="100" id="counter_mnu" />
            		<div id="sms_text_msg_mnu_err" class="error"></div>
            		
            		<div class="biz_center">
            			{jqmbutton icon="star" type="button" value="Send SMS" name="send_sms_mnu" onclick="val_and_submit('menus');"  }
            		</div>
        		</div>

				<div id='email_part_mnu' >                   
    				<textarea type='text' name='sms_msg_mnu' id='sms_msg_mnu' style='height:120px;'>{if $pst_msg}{$pst_msg}{/if}</textarea>
            		<div id="sms_msg_mnu_err" class="error"></div>
        		
					{jqmbutton icon="star" type="button" value="Send" name="email_prom_mnu" onclick="val_and_submit('menus');" }
					{jqmbutton id='email_prev' icon="search" type="button" value="Preview" name="email_prev_mnu" onclick="show_hide_preview(1,'menus');"}
				</div> 
				
				<div data-role="popup" id='popup_email_preview_mnu' style='width:300px;z-index:999990 !important;border:1px solid #FF9600 !important;' class='ui-body-a'>
				    <div data-role="header" data-theme="a" class="ui-corner-top">
                        <h6>Email Preview </h6>
                        <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
                    </div>
                    <div id='email_preview_mnu' data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">{if $pst_preview}{$pst_preview}{/if}</div>
               </div>
		</div>
</div>