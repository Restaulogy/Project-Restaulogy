<div data-role="popup" id="popupCheckIn" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
	<div data-role="header">
		<h1>{$_lang.biz_checkins.create_title}</h1>
	</div>
	<form name='frm_biz_checkins' id="frm_biz_checkins"  method="POST" action="{$website}/user/biz_checkins.php" onsubmit="return validatebiz_checkins();" >
	<div data-role="content" style="padding:5px;">
        <div>
			<label for='chkin_points'>{$_lang.biz_checkins.label.tmp_points}</label>
            <input type='text' name='chkin_points' id='chkin_points' value='' />
    		<div id="chkin_points_err" class="error"></div>
		</div>
		
		<div>
			<label for='chkin_edit_commnt'>{$_lang.biz_checkins.label.chkin_edit_commnt}</label>
            <input type='text' name='chkin_edit_commnt' id='chkin_edit_commnt' value='' />
    		<div id="chkin_edit_commnt_err" class="error"></div>
		</div>
		
		<div id="chkin_id_err" class="error"></div>

		<input type="hidden" id="action" name="action" value="{$smarty.const.ACTION_UPDATE}"/>
		<input type="hidden" id="search_from_dt" name="search_from_dt" value="{$search_from_dt}"/>
		<input type="hidden" id="search_to_dt" name="search_to_dt" value="{$search_to_dt}"/>

		<input type='hidden' name='chkin_id' id='chkin_id' value="0" />
		
		<div class='biz_center'>
            <input type="submit" data-icon="save" data-inline="true" value="{$_lang.save_lbl}"/>
    		<input type="button" data-icon="delete" data-inline="true" onclick="$('#popupCheckIn').popup('close');" value="{$_lang.cancel_lbl}"/>
        </div>
        
	</div>
	</form>
</div>
