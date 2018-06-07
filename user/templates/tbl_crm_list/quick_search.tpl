<div data-role="popup" id="quick_filter_for_rwards_lst" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
	<div data-role="header">
		<h1>{$_lang.biz_checkins.create_title}</h1>
	</div>

	<form id="quick_filter_for_rwards_lst" method="POST" action="{$website}/user/rewrad_point_list.php?rpt_to_show={$rpt_to_show}" onsubmit="return quick_validate_search_form();">
	<div data-role="content" style="padding:5px;">

        <div >
			<label>{$_lang.tbl_staff.label.staff_phone} </label>
            <input type="text" id="filt_search_phone" name="filt_search_phone" value="{$smarty.request.filt_search_phone}" />
            <div class="error" id="filt_search_phone_err"></div>
		</div>

		<div >

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
                    <input type='text' name='tmp_mulitplier' id='tmp_mulitplier' value='1' onchange="cal_rwd_points_by_multi();" autocomplete="off" />
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
                    <div id="chkin_amount_err" class="error"></div>
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
    		<div id='div_earlier_today' class="error">{$_lang.biz_checkins.pts_earlier_today}{$overall_stat.today_earlier_pts}</div>
		</div>

		<div class='biz_center'>
        <input type="submit" data-icon="save" data-inline="true" value="{$_lang.save_lbl}"/>
		<input type="button" data-icon="delete" data-inline="true" onclick="$('#quick_filter_for_rwards_lst').popup('close');" value="{$_lang.cancel_lbl}"/>
        </div>
	</div>
	</form>
</div>
