<div data-role="popup" id="popupAddVisit" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
	<div data-role="header">
		<h1>{$_lang.biz_checkins.create_title}</h1>
	</div>
	
	<form name='frm_biz_checkins' id="frm_biz_checkins" method="POST" action="{$website}/user/biz_checkins.php" onsubmit="return validatebiz_checkins();" autocomplete="off">
	<div data-role="content" style="padding:5px;">

        <div class="biz_hidden">
			<label for='reward_code'>{$_lang.biz_checkins.label.reward_code}</label>
            <input type='password' name='reward_code' id='reward_code' value='1' />
    		<div id="reward_code_err" class="error"></div>
		</div>
		
		<div >
			<!--
            <label for='chkin_points'>{$_lang.biz_checkins.label.chkin_points}</label>
            -->
            <table class="biz_data_grid">
            <tr>
                <th width='30%' style="text-align:left;vertical-align:top !important;">
                    Amount($)
               </td>
               <th width='9%' style="text-align:left;vertical-align:top !important;">

               </th>
               <th width='10%' style="text-align:left;vertical-align:top !important;">
                    Mulitplier
               </td>
               <th width='9%' style="text-align:left;vertical-align:top !important;">

               </th>
               <th width='30%' style="text-align:left;vertical-align:top !important;">
                    Reward points
               </th>
            </tr>
            <tr>
               <td width='30%' style="text-align:left;vertical-align:top !important;">
                    <input type='text' name='chkin_amount' id='chkin_amount' value='' onchange="cal_rwd_points_by_multi();" autocomplete="off" />
               </td>
               <td width='9%' style="color:red !important;text-align:left;vertical-align:middle !important;">
                &nbsp;&nbsp;x
               </td>
               <td width='10%' style="text-align:left;vertical-align:top !important;">
                    <input type='text' name='tmp_mulitplier' id='tmp_mulitplier' value='{$smarty.session.curr_restant.restaurent_rwd_multiplier}' onchange="cal_rwd_points_by_multi();" autocomplete="off" />
               </td>
               <td width='9%' style="color:red !important;text-align:left;vertical-align:middle !important;">
                &nbsp;&nbsp;=
               </td>
               <td width='30%' style="text-align:left;vertical-align:top !important;">
                    <input readOnly="readOnly" type='text' name='chkin_points' id='chkin_points' value='' autocomplete="off" />
               </td>
            </tr>
            <tr>
                <td width='30%' style="text-align:left;vertical-align:top !important;">
                    <div id="tmp_points_err" class="error"></div>
               </td>
               <td width='9%' style="text-align:left;vertical-align:top !important;">

               </td>
               <td width='10%' style="text-align:left;vertical-align:top !important;">
                    <div id="tmp_mulitplier_err" class="error"></div>
               </td>
               <td width='9%' style="text-align:left;vertical-align:top !important;">

               </td>
               <td width='30%' style="text-align:left;vertical-align:top !important;">
                    <div id="chkin_points_err" class="error"></div>
               </td>
            </tr>
            </table>
             <div >
				<label>{$_lang.biz_checkins.label.chkin_invoice} </label>
	            <input type="text" id="chkin_invoice" name="chkin_invoice" value="{$smarty.request.chkin_invoice}" />
	            <div class="error" id="chkin_invoice_err"></div>
			</div>
		
    		<div id='div_earlier_today' class="error">{$_lang.biz_checkins.pts_earlier_today}{$overall_stat.today_earlier_pts}</div>
		</div>
        		
		<input type='hidden' name='action' id='action' value="{$smarty.const.ACTION_CREATE}" />
		
		<input type='hidden' name='cust_id' id='cust_id' value="0" />
		
		<div class='biz_center'>
        <input type="submit" data-icon="save" data-inline="true" value="{$_lang.save_lbl}"/>
		<input type="button" data-icon="delete" data-inline="true" onclick="$('#popupAddVisit').popup('close');" value="{$_lang.cancel_lbl}"/>
        </div>
	</div>
	</form>
</div>
