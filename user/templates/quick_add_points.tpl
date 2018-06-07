<div data-role="popup" id="quick_filter_for_rwards_lst" data-dismissible="false" style="width:270px;border:5px solid #333;" data-overlay-theme="a">
	<div data-role="header">
		<h1>{$_lang.biz_checkins.create_title}</h1>
	</div>

	<form name='frm_biz_checkins' id="frm_biz_checkins" method="POST" action="{$website}/user/biz_checkins.php" onsubmit="return qck_validatebiz_checkins();" autocomplete="off">
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
                    Amount(Rs)
               </th>
               <th width='9%' style="text-align:left;vertical-align:top !important;">

               </th>
               <th width='10%' style="text-align:left;vertical-align:top !important;">
                    Mulitplier
               </th>
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
                    <input type='text' name='tmp_mulitplier' id='tmp_mulitplier' value="{$Global_member.staff_award_multiplier}" onchange="cal_rwd_points_by_multi();" autocomplete="off" />
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
            
            <div >
				<label>{$_lang.biz_checkins.label.chkin_invoice} </label>
	            <input type="text" id="chkin_invoice" name="chkin_invoice" value="{$smarty.request.chkin_invoice}" />
	            <div class="error" id="chkin_invoice_err"></div>
			</div>
		
    		<div id='div_earlier_today' class="biz_hidden">{$_lang.biz_checkins.pts_earlier_today}{$overall_stat.today_earlier_pts}</div>
		</div>
		
		<div class='biz_center'>		
        <input id="sb_btn" type="submit" data-icon="save" data-inline="true" value="Look-up"/>
        <input type="button" onclick="btn_check_redeem_click()" data-icon="male-user" data-inline="true" value="Check/Redeem"/>
        <!--<input data-inline="true" data-icon="male-user" type="button" value="Join Now" onclick="location.href='{$website}/user/cust_login.php'" />-->
		<input type="button" data-icon="delete" data-inline="true" onclick="$('#quick_filter_for_rwards_lst').popup('close');" value="{$_lang.cancel_lbl}"/>
        </div>
	</div>
	</form>
</div>

{literal}
<script type="text/javascript">

function btn_check_redeem_click(){
  $('#chkin_amount').val('');
  $('#chkin_points').val('');
  $('#frm_biz_checkins').submit();  
}

function cal_rwd_points_by_multi(){
  var tmp_pt=$('#chkin_amount').val();
  var tmp_multi=$('#tmp_mulitplier').val();
  if(IsNonEmpty(tmp_pt)==true && IsNonEmpty(tmp_multi)==true){
        $('#chkin_points').val((tmp_pt * tmp_multi).toFixed(0));
        $('#sb_btn').prev('span').find('span.ui-btn-text').text("Add Points");
  }else{
        $('#chkin_points').val('');
        $('#sb_btn').prev('span').find('span.ui-btn-text').text("Look-up");
  }
}

function qck_validatebiz_checkins(){
	$("#reward_code_err").html("");
	$("#chkin_points_err").html("");

	$("#chkin_amount_err").html("");
	$("#tmp_mulitplier_err").html("");

	$("#filt_search_phone_err").html("");

	var isErr = true;

	if(IsNonEmpty(elemById("filt_search_phone").value)==false){
        $("#filt_search_phone_err").html("{/literal}{$_lang.tbl_staff.not_empty_msg.staff_phone}{literal}");
        isErr = false;
    }else{
      	if(isPhoneNumber(elemById("filt_search_phone").value) == false){
    	  	$('#filt_search_phone_err').html("Phone is not proper.");
    		isErr = false;
      	}
    }

/*
    if(IsNonEmpty(elemById("reward_code").value)==false){
		$("#reward_code_err").html("{/literal}{$_lang.biz_checkins.not_empty_msg.reward_code}{literal}");
		isErr = false;
	}
*/

    if((IsNonEmpty(elemById("chkin_amount").value)) || (IsNonEmpty(elemById("chkin_points").value))) {
        if(IsNonEmpty(elemById("chkin_amount").value)==false){
    		$("#chkin_amount_err").html("{/literal}{$_lang.biz_checkins.not_empty_msg.tmp_points}{literal}");
    		isErr = false;
    	}

    	if(IsNonEmpty(elemById("tmp_mulitplier").value)==false){
    		$("#tmp_mulitplier_err").html("{/literal}{$_lang.biz_checkins.not_empty_msg.tmp_mulitplier}{literal}");
    		isErr = false;
    	}

    	if(IsNumeric(elemById("chkin_amount").value)==false){
    		$("#tmp_points_err").html("{/literal}{$_lang.biz_checkins.input_err_msg.tmp_points}{literal}");
    		isErr = false;
    	}

    	if(IsNumeric(elemById("tmp_mulitplier").value)==false){
    		$("#tmp_mulitplier_err").html("{/literal}{$_lang.biz_checkins.input_err_msg.tmp_mulitplier}{literal}");
    		isErr = false;
    	}

    	if(IsNonEmpty(elemById("chkin_points").value)==false){
    		$("#chkin_points_err").html("{/literal}{$_lang.biz_checkins.not_empty_msg.chkin_points}{literal}");
    		isErr = false;
    	}

    	if(IsNumeric(elemById("chkin_points").value)==false){
    		$("#chkin_points_err").html("{/literal}{$_lang.biz_checkins.input_err_msg.chkin_points}{literal}");
    		isErr = false;
    	}

    }
	
	if(isErr == false){
		alert("{/literal}{$_lang.messages.revise_form}{literal}");
	}
	return isErr;
}//..function

</script>
{/literal}
