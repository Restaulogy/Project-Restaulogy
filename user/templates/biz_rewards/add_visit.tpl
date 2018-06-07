<form name='frm_biz_checkins' id="frm_biz_checkins"  method="POST" action="{$website}/user/biz_checkins.php" onsubmit="return validatebiz_checkins();" autocomplete="off">
<div>
		<h1>{$_lang.biz_checkins.create_title}</h1>
<table class="listTable" >
	<!--<tr>
    <th class="bigListItem"> </th>
	<th class="actionListItem"></th>
    </tr>-->
	<tr>
		<td class="bigListItem">

	        <table class="listTable">
            <tr>
                <td width='30%' style="text-align:left;vertical-align:top !important;">
                    Amount($)
               </td>
               <td width='9%' style="text-align:center;vertical-align:top !important;">

               </td>
               <td width='10%' style="text-align:left;vertical-align:top !important;">
                    Mulitplier
               </td>
               <td width='9%' style="text-align:center;vertical-align:top !important;">

               </td>
               <td width='30%' style="text-align:left;vertical-align:top !important;">
                    Reward points
               </td>
            </tr>
            <tr>
               <td width='30%' style="text-align:left;vertical-align:top !important;">
                    <input type='text' name='chkin_amount' id='chkin_amount' value="{if $_loy_cust_ord_amt gt 0}{$_loy_cust_ord_amt}{/if}" onchange="cal_rwd_points_by_multi();" autocomplete="off" />
                    <div id="chkin_amount_err" class="error"></div>
               </td>
               <td width='9%' style="color:red !important;text-align:center;vertical-align:middle !important;">
                &nbsp;&nbsp;x
               </td>
               <td width='10%' style="text-align:left;vertical-align:top !important;">
                    <input type='text' name='tmp_mulitplier' id='tmp_mulitplier' value="{$smarty.session[$smarty.const.SES_REWARD].staff_award_multiplier}" onchange="cal_rwd_points_by_multi();" autocomplete="off" />
                    <div id="tmp_mulitplier_err" class="error"></div>
               </td>
               <td width='9%' style="color:red !important;text-align:center;vertical-align:middle !important;">
                &nbsp;&nbsp;=
               </td>
               <td width='30%' style="text-align:left;vertical-align:top !important;">
                    <input readOnly="readOnly" type='text' name='chkin_points' id='chkin_points'  value="{if $_loy_cust_ord_amt gt 0}{$_loy_cust_ord_amt}{/if}" autocomplete="off" />
                    <div id="chkin_points_err" class="error"></div>
               </td>
            </tr>            
            </table>
                                    
         	<table class="listTable">
        		<tr>
        			<td width='35%' style="text-align:left;vertical-align:top !important;">
                		{$_lang.biz_checkins.label.chkin_invoice} 
	               </td>
	               <td width='10%' style="text-align:center;vertical-align:top !important;">

           		   </td>
	               <td width='55%' style="text-align:left;vertical-align:top !important;">
						{if $_RWD_CONFIG_TYPE eq 'CUSTOMER' AND ($isCustomer gt 0 OR $smarty.session.curr_restant.restaurent_rwd_multiplier eq 1)}{$_lang.biz_checkins.label.reward_code}{/if}
	               </td>
        		</tr>
        		<tr>
        			<td width='50%' style="text-align:left;vertical-align:top !important;">
                		<input type="text" id="chkin_invoice" name="chkin_invoice" value="{$smarty.request.chkin_invoice}" />
            			<div class="error" id="chkin_invoice_err"></div>
	               </td>
	               <td width='10%' style="text-align:center;vertical-align:top !important;">

           		   </td>
	               <td width='50%' style="text-align:left;vertical-align:top !important;">
	               		 <div {if $_RWD_CONFIG_TYPE eq 'CUSTOMER' AND ($isCustomer gt 0 OR $smarty.session.curr_restant.restaurent_rwd_multiplier eq 1)}{else}class="biz_hidden"{/if}>
							<input type='password' name='reward_code' id='reward_code' value="{if $_RWD_CONFIG_TYPE eq 'CUSTOMER' AND ($isCustomer gt 0 OR $smarty.session.curr_restant.restaurent_rwd_multiplier eq 1)}{else}1{/if}" />
				            <input type='hidden' name='manager_cust_sess_id' id='manager_cust_sess_id' value="{$manager_cust_sess_id}" />
				    		<div id="reward_code_err" class="error"></div>
				    	</div>	
	               </td>
        		</tr>
        	</table>	            
		</td>			
		<td class="actionListItem">
		
            {if $overall_stat.today_earlier_pts gt 0}
                <div>
            		<div class="error">{$_lang.biz_checkins.pts_earlier_today}{$overall_stat.today_earlier_pts}</div>
        		</div>
        		<br>
            {/if}
    		 <div {if $_RWD_CONFIG_TYPE eq 'CUSTOMER' AND ($isCustomer gt 0 OR $smarty.session.curr_restant.restaurent_rwd_multiplier eq 1)}{else}class="biz_hidden"{/if}>
    		 	<div class='info'><small>{$_lang.biz_checkins.label.cust_promt_msg}</small></div>
        	</div>	
		<input type='hidden' name='action' id='action' value="{$smarty.const.ACTION_CREATE}" />
		<input type='hidden' name='is_req' id='is_req' value="0" />
		<input type='hidden' name='server_validated' id='server_validated' value="{$server_validated}" />
		
		<div class='biz_center'>
	        <input type="submit" data-icon="save" data-inline="true" value="Add Points"/>
			<!--<input type="button" data-icon="delete" data-inline="true" onclick="$('#popupAddVisit').popup('close');" value="{$_lang.cancel_lbl}"/>-->
        </div>
	   </td>	
	</tr>			
</table>
</div>
</form>