<div id="popupSendSMS"  style="display:none;position:fixed;width:270px;z-index:9900;top: 50%;left: 50%;margin-left:-120px;margin-top:-150px;border:1px solid #FF9600;" class='ui-body-a'>
    <div data-role="header" data-theme="a" class="ui-corner-top">
    <h6> Send SMS </h6>
 	<a href="#" onclick="$('#popupSendSMS').hide();" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">
 	    <label for='sms_msg'>Message</label>
        <input type='text' name='sms_msg' id='sms_msg' value='' />
		<div id="sms_msg_err" class="error"></div>

		<div class="biz_center">
			{jqmbutton icon="star" type="submit" value="Send SMS" name="send_sms" }
		</div> 
	</div>
</div>
