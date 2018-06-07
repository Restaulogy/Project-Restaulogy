<div data-role="popup" id="popupUniqueCode" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
      <div data-role="header">
		<h1>{$_lang.biz_checkins.unique_code}</h1>
	  </div>
        <div style="background:orange;font-size:26px;font-weight:bold;margin-bottom:8px;text-align:center;">
            {$smarty.session[$smarty.const.SES_REWARD].unique_cd}
        </div>

       <small class="info">{$_lang.biz_checkins.extra_msg.server_show_code}</small>

       <div class='biz_center'>
        <input type="button" data-icon="delete" data-inline="true" onclick="$('#popupUniqueCode').popup('close');" value="{$_lang.cancel_lbl}"/>
        </div>
</div>
