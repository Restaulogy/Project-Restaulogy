{if $tbl_ordersinfo.show_opt_bx eq 1 || $tbl_ordersinfo.can_pay_amt>0}

{literal}
<script type="text/javascript">		

function tipChange(value){
	if(IsNonEmpty(value)){
		$('#order_tip').val('');
		value = Number(value);
		if(value == -1){
			 $('#order_tip_holder').removeClass('biz_hidden').trigger('refresh'); 
		}else{
		  $('#order_tip_holder').addClass('biz_hidden').trigger('refresh'); 
			var tip = Number(value);
			$('#order_tip').val(tip.toFixed(2));
			$('#tip_holder').html('{/literal}{$smarty.session.curr_restant.restaurent_currency}{literal}' + tip.toFixed(2)).trigger('refresh');
			var total_bill= Number({/literal}{$tbl_ordersinfo.all_bill_amnt}{literal});
			total_bill = total_bill + tip; 
			$('#all_bill_holder').html('{/literal}{$smarty.session.curr_restant.restaurent_currency}{literal}' + total_bill.toFixed(2)).trigger('refresh');
		} 
	}else{
			var tip = Number($('#order_tip').val());
		$('#tip_holder').html('{/literal}{$smarty.session.curr_restant.restaurent_currency}{literal}' + tip.toFixed(2)).trigger('refresh');
			var total_bill= Number({/literal}{$tbl_ordersinfo.all_bill_amnt}{literal});
			total_bill = total_bill + tip;
			$('#all_bill_holder').html('{/literal}{$smarty.session.curr_restant.restaurent_currency}{literal}' + total_bill.toFixed(2)).trigger('refresh');
	}
	update_cur_pay_amt(document.getElementById('ord_pmnt_split_amng'),document.getElementById('ord_pmnt_split_pay_for').value);
}

function applyTipToAllOrders(order_id){
	var info = {};
	info['action'] = 'applyTipToAllOrders';
	info['var1']	 = order_id;
	info['var2']	 = $('#order_tip').val();
	ajaxian(info,function(res){});
}

function changeTipAmts(opt_sel){
     var bill_amt = 0.00;
     var strop = '';
     if(opt_sel=='split' || opt_sel=='single'){
     	bill_amt = {/literal}{$tbl_ordersinfo.all_bill_amnt}{literal};
     }else{
        bill_amt = {/literal}{$tbl_ordersinfo.curr_bill_amnt}{literal};
     }
     strop = strop + '<option value="0">Select value</option>';
	 {/literal}{foreach $tiplist as $tip}{literal}
	 tip_amt = {/literal}{$tip}{literal};
	 tip_val = (bill_amt * tip_amt)/100.00 ;{/literal}{$smarty.session.curr_restant.restaurent_currency}{literal}
	 strop = strop + '<option value="'+tip_val+'">' + tip_amt + '{/literal}{$_lang.percent_mark}{literal} ({/literal}{$smarty.session.curr_restant.restaurent_currency}{literal})' + tip_val.toFixed(2) + '</option>';
	 {/literal}{/foreach}{literal}
	
	 strop = strop + '<option value="-1">Select other</option>';
	 $('#tip_list').html(strop).selectmenu('refresh');
}

function tog_split_opt(opt_sel){
	changeTipAmts(opt_sel);
	 
	$('#box_split_amng').addClass('biz_hidden').trigger('refresh');
	if(opt_sel=='split' || opt_sel=='single'){
		document.getElementById('split_detail').style.display='block';
		if(opt_sel=='single'){
		 	$('#ord_pmnt_split_amng').val(1).attr('disabled',true).trigger('refresh');
		}else{ 
			$('#box_split_amng').removeClass('biz_hidden').trigger('refresh'); 
		 	$('#ord_pmnt_split_amng').attr('disabled',false).trigger('refresh');
		 	
		 	//$('#box_split_pay_for').removeClass('biz_hidden').trigger('refresh');
		 	$('#ord_pmnt_split_pay_for').attr('disabled',false).trigger('refresh');
		}
		if(opt_sel=='split'){
           update_cur_pay_amt(document.getElementById('ord_pmnt_split_amng'),document.getElementById('ord_pmnt_split_pay_for').value);
        }else{
            update_cur_pay_amt(document.getElementById('ord_pmnt_split_amng'));
        }
	}else{
		document.getElementById('split_detail').style.display='none';
	}
}
			
function update_cur_pay_amt(sel,ord_pmnt_split_pay_for){
    if(!ord_pmnt_split_pay_for)
        ord_pmnt_split_pay_for=1;
	//var divide_amng = document.getElementById('ord_pmnt_split_amng'); 
	if(sel.type == 'hidden'){
	 	var divide_amng =sel.value; 
	}else{
	 	var divide_amng =sel.options[sel.selectedIndex].value; 
	}
	  /*alert(divide_amng);*/
	var total_bill={/literal}{$tbl_ordersinfo.all_bill_amnt}{literal};
	var tip = Number($('#order_tip').val());
   /*alert($('#order_tip').val());*/
	if((tip > 0)==false){
	  tip = 0;
	} 
	/*alert(tip);  */
	total_bill = total_bill + Number(tip.toFixed(2));
  /*alert(total_bill);*/
	var final_amt=(eval(total_bill)/eval(divide_amng)).toFixed(2);
  /*alert(final_amt);*/
	//if(divide_amng > 0 && total_bill >1){
	if(final_amt > 0){
      if(ord_pmnt_split_pay_for>1 && divide_amng>0){
           final_amt=(final_amt*ord_pmnt_split_pay_for);
      } 
		document.getElementById('cur_pay_amt').innerHTML=('$'+final_amt);
	}
}	
			
function getCheckedRadio(radio_group) {
  for (var i = 0; i < radio_group.length; i++) {
      var button = radio_group[i];
      if (button.checked) {
          return button;
      }
  }
  return undefined;
}
			
function getAmountToPay(){				
	/*var checkedButton = getCheckedRadio(document.forms.pay_opt_select.elements.payment_choice);
	payment_choice=checkedButton.value;*/
	payment_choice=document.forms.pay_opt_select.elements.payment_choice.value;
	var sel = document.getElementById('ord_pmnt_split_amng');
	var divide_amng = 1;
	if(sel){
		if(sel.type == 'select-one'){
			 divide_amng =sel.options[sel.selectedIndex].value;
		}else{
			 divide_amng =sel.value;
		}
	}
	
	/*alert(divide_amng);*/
	var total_bill=0;
	var final_amt=0;
	if(payment_choice=='individual'){
		final_amt={/literal}{$tbl_ordersinfo.curr_bill_amnt}{literal};
	}else{
		total_bill={/literal}{$tbl_ordersinfo.all_bill_amnt}{literal};
		final_amt=(eval(total_bill)/eval(divide_amng)).toFixed(2);
        if(final_amt>0){
           var pay_for =document.getElementById('ord_pmnt_split_pay_for').value;
           if(pay_for>0){
               final_amt=final_amt*pay_for;
           }
        }
	}
	 /*alert(total_bill); 
	alert(final_amt);*/
	return final_amt;
}	

function enbl_confirmation_email(isDisable){
	 var obj = $('#box_confirmation_email');
	 
	 $('#order_takeout_email_err').html('').trigger('refresh');
	  $('#order_takeout_email').val('');
	 
	if ($('#check_confirmation_email').is(':checked')) {
		obj.removeClass('biz_hidden').trigger('refresh');
		 
	}else{
		obj.addClass('biz_hidden').trigger('refresh');
	}
	if(isDisable){
		if(obj.hasClass('biz_hidden')==false){
			obj.addClass('biz_hidden').trigger('refresh');
		} 
	}
}

function validateConfirmEmail(){
	var isValid = true;  
if ($('#check_confirmation_email').is(':checked')) { 
 		var email_val =	$('#order_takeout_email').val();
	
		if(IsNonEmpty(email_val)==false){
		$('#order_takeout_email_err').html('{/literal}{$_lang.messages.validation.not_empty|sprintf:"Email"}{literal}').trigger('refresh');	 
		isValid = false;
	}else{
		if(isEmail(email_val)==false){ 
			$('#order_takeout_email_err').html('{/literal}{$_lang.messages.validation.email}{literal}').trigger('refresh');	 
		isValid = false;
	 }
	}
}
	return isValid; 
}

function saveTakeOutEmail(order_id){
	
if ($('#check_confirmation_email').is(':checked')) { 
 var email_val =	$('#order_takeout_email').val();
 var isValid  = true;
if((order_id > 0)==false){
	$('#order_takeout_email_err').html('Order is not selected').trigger('refresh');	
	isValid = false;
}
if(IsNonEmpty(email_val)==false){
	$('#order_takeout_email_err').html('{/literal}{$_lang.messages.validation.not_empty|sprintf:"Email"}{literal}').trigger('refresh');	 
	isValid = false;
}else{
	if(isEmail(email_val)){ 
		$('#order_takeout_email_err').html('{/literal}{$_lang.messages.validation.email}{literal}').trigger('refresh');	 
	isValid = false;
 }
} 

	
if(isValid == true){
	var info = {};
	info['action']=	'saveTakeOutEmailForOrder';
	info['var1'] 	= order_id;
	info['var2'] 	= email_val;
	$.ajax({
	        type     : "POST",
	        url      : website + "/ajax/custom_functions.php" , 
						data	 : info,
	        dataType : "json",
						async	 : false,
	    	success  : function(response){ 
                  if(response){
                 	// window.location.reload();
					   			}  
                },
			error: function(objResponse){
				//alert(objResponse.responseText);
			}
		});
	} 
 } 
}

function takeout_paypal(order_id,isPayByCash){
		if(isPayByCash){
			isPayByCash = isPayByCash;
		}else{
			isPayByCash = 0;
		}
	if(validateConfirmEmail()){ 
		var tmpAmnt=getAmountToPay();
		redirect_to_paypal(order_id,0,'individual',1,tmpAmnt,$('#check_confirmation_email').val(),isPayByCash);
	} 
}
			
	
        function redirect_to_paypal(order_id,order_payment_id,payment_choice,ord_pmnt_split_amng,order_amt_i_pay,takeout_email,isPayByCash,ord_pmnt_split_pay_for){
                if(!ord_pmnt_split_pay_for){
                     ord_pmnt_split_pay_for=1;
                }
                var pg_url='';
				
				if(isPayByCash){
					isPayByCash = isPayByCash;
				}else{
					isPayByCash = 0;
				}
				
				if(payment_choice=='' && ord_pmnt_split_amng==''){
					//var checkedButton = getCheckedRadio(document.forms.pay_opt_select.elements.payment_choice);
				  //payment_choice=checkedButton.value;
					payment_choice=document.forms.pay_opt_select.elements.payment_choice.value;
					var sel=document.getElementById('ord_pmnt_split_amng');
					var ord_pmnt_split_amng = sel.options[sel.selectedIndex].value;			
				}
				//alert(payment_choice);
				//.if  
				if(payment_choice.toUpperCase() == 'INDIVIDUAL' || payment_choice.toUpperCase() == 'SINGLE'){ 
					order_payment_id = 0;
				}else{
                   ord_pmnt_split_pay_for=document.getElementById('ord_pmnt_split_pay_for').value;
                }
				 //applyTipToAllOrders(order_id);
				
				var tip = Number($('#order_tip').val());
				/*alert(ord_pmnt_split_amng);*/
			 
				order_amt_i_pay = Number(order_amt_i_pay);
				 if(tip > 0){
					 if(ord_pmnt_split_amng > 0){
					 	  	order_amt_i_pay = order_amt_i_pay  + (tip/ord_pmnt_split_amng );
					 }else{ 
							order_amt_i_pay = order_amt_i_pay  + tip;
					 }
			  }else{
					tip = 0.00;	 
        }
                 
			  order_amt_i_pay  = order_amt_i_pay.toFixed(2);
			  /*if(order_payment_id > 0){
					if(ord_pmnt_split_pay_for>1){
            order_amt_i_pay=order_amt_i_pay*ord_pmnt_split_pay_for;
        	}
				}*/
			   
			  tip = tip.toFixed(2);
				pg_url='{/literal}{$website}{literal}/paypal/payment.php?order_id='+ order_id +'&order_payment_id='+ order_payment_id +'&payment_choice='+payment_choice+'&ord_pmnt_split_amng=' +ord_pmnt_split_amng +'&order_amt_i_pay='+order_amt_i_pay +'&order_tip='+tip + '&isPayByCash=' + isPayByCash+'&ord_pmnt_split_pay_for='+ord_pmnt_split_pay_for;
				if(IsNonEmpty(takeout_email)){
					pg_url= pg_url + '&order_takeout_email='+takeout_email
				}
				//  alert(pg_url);
				window.location.href=pg_url;
			}
		</script>
	{/literal}
 
<div data-role="popup" data-dismissible="false" data-overlay-theme="g" data-role="a1"  id='pay_mode_sel' style="width:270px;">
<div data-role="header">
	<h3><a href="#" onclick="$('#pay_mode_sel').popup('close');" data-icon="delete" style="display:inline;float: right;" data-role="button" data-iconpos="notext" data-inline="true"></a>Payment
	</h3>
</div>
<div data-role="content" style="padding:5px;">
 {if $tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_TAKE_OUT || $tbl_ordersinfo[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_DELIVERY}
 <form id='pay_opt_select' name='pay_opt_select' method="POST" action="{$page_url}" onsubmit="return validateConfirmEmail();">  
 	<table class="listTable">
	<tr><th colspan="2">Payment Details <I style='font-style:italic;'>&nbsp;&nbsp;(Status: {if $tbl_ordersinfo.payment_options.ord_pmnt_amnt_paid eq $tbl_ordersinfo.all_bill_amnt} Paid {else} Unpaid {/if})</I></th></tr>
	<tr>
		<td>{$_lang.tbl_orders.label.payment_bill}</td>
		<td><span style='font-weight:bold;'>${$tbl_ordersinfo.bill_amnt|number_format:2}</span></td> 
	</tr>
	<tr>
		<td>{$_lang.tbl_orders.label.payment_tax}</td>
		<td><span style='font-weight:bold;'>
		${$tbl_ordersinfo.tax_amnt|number_format:2}</span></td>
	</tr>
	<tr>
		<td>{$_lang.tbl_orders.label.order_misc_charge}</td>
		<td><span style='font-weight:bold;'>${$tbl_ordersinfo.order_misc_charge|number_format:2}</span> </td>
	</tr>
	<tr>
		<td>{$_lang.tbl_orders.label.order_promotion_disc}</td>
		<td><span style='font-weight:bold;'>${$tbl_ordersinfo.promdisc_applied|number_format:2}</span></td>
	</tr>
	{assign var="is_paid" value=0}
	{if $tbl_ordersinfo.order_status_id >= $smarty.const.TBL_STATUS_CHECK}
       {assign var="is_paid" value=1}
     {else} {if $tbl_ordersinfo.payment_options.ord_pmnt_amnt_paid eq $tbl_ordersinfo.all_bill_amnt}
     {assign var="is_paid" value=1}
    {/if}
    {/if}
	{if ($is_paid eq 0) && !($tbl_ordersinfo.payment_options.ord_pmnt_id) && ($tbl_ordersinfo.tip_amnt eq 0) && ($tbl_ordersinfo.can_pay_amt eq 1)}
		<tr>
		<td colspan="2">  
				{include file="tbl_orders/tip_selection.tpl"}
		</td>
	</tr> 
	{else}
		<tr>
		<td>{$_lang.tbl_orders.label.payment_tip}</td>
		<td><span style='font-weight:bold;'>${$tbl_ordersinfo.tip_amnt|number_format:2}</span></td>
	</tr> 
	{/if}
	{if $tbl_ordersinfo.payment_options gt 0}
	<tr>
		<td>Total Paid Amount</td>
		<td><span style='font-weight:bold;'>${$tbl_ordersinfo.payment_options.ord_pmnt_amnt_paid|number_format:2}</span> </td>
	</tr>
	{/if}
	
	<tr>
		<td>Amount You have to pay</td>
		<td><span style='font-weight:bold;' id="cur_pay_amt">${$tbl_ordersinfo.all_bill_amnt|number_format:2}</span> </td>
	</tr>  
	<tr>
		<td>{$_lang.tbl_orders.label.payment_total}</td>
		<td><span style='font-weight:bold;' id="all_bill_holder">${$tbl_ordersinfo.all_bill_amnt|number_format:2}</span></td>
	</tr>   
	</table> 
				 
		
	{if $tbl_ordersinfo.can_pay_amt eq 1}
	
		<label for="check_confirmation_email"><input type="checkbox" value="1" id="check_confirmation_email" name="check_confirmation_email" class="biz_hidden" onchange='enbl_confirmation_email();' />Send Confirmation Email</label>
	<div class="biz_hidden biz_center" id="box_confirmation_email"> 
		<input type="text" id="order_takeout_email"  name="order_takeout_email" />
	
	</div>
		<div class="error" id="order_takeout_email_err"></div>  
		
		<input type="hidden" name="payment_choice" id="payment_choice"  value="individual" />  
	 <input type="hidden" id='process_payment' name='process_payment' value='yes' />
	 <input type="hidden" id="ord_pmnt_split_amng" name="ord_pmnt_split_amng" value="1"/>
	 <input type="hidden" id="ord_pmnt_split_pay_for" name="ord_pmnt_split_pay_for" value="1"/>
	 <input type="hidden" id='order_id' name='order_id' value='{$tbl_ordersinfo.order_id}' />
	 <div class="biz_center">
	 {if (!($tbl_ordersinfo.payment_options) || (!($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash) || ($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash eq 0)))}
 		{if $smarty.session[$smarty.const.SES_PAYPAL_EMAIL] neq ""}
            <!-- onclick="takeout_paypal({$tbl_ordersinfo.order_id},0);" -->
			<a class="ui-disabled" href="#" onclick="alert('{$_lang.downtown_demo_payment_lnk}');" data-role="button" data-inline="true" data-icon="star" data-theme="b">{$_lang.main.check_out}</a> <br>
		{/if}
	{/if}
	
	{if (!($tbl_ordersinfo.payment_options) || (($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash) || ($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash eq 1)))}
	   {if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR }
	       <a href="#" onclick="takeout_paypal({$tbl_ordersinfo.order_id},1);" data-role="button" data-inline="true" data-icon="star" data-theme="b">{$_lang.main.pay_by_cash}</a>
	    {else}
            <a href="#" onclick="window.location.href='{$website}/user/services_request.php?table_id=1&service_id={$smarty.const.SERVICE_PAY_BY_CASH}';" data-role="button" data-inline="true" data-icon="star" data-theme="b" >{$_lang.main.pay_by_cash}</a>
    	{/if}
	{/if}
				{jqmbutton onclick="printReceipt({$tbl_ordersinfo.order_id},1);" icon="copy-item" value="Receipt"}	
	 </div>       
								
			{/if}
	</form>
 {else}
	{if $tbl_ordersinfo.payment_options.ord_pmnt_id}
	<table class="listTable">
	<tr><th colspan="2">Payment Details <I style='font-style:italic;'>&nbsp;&nbsp;(Status: {if $tbl_ordersinfo.order_status_id eq $smarty.const.TBL_STATUS_CHECK} Paid {else} Unpaid {/if})</I> </th></tr>
	
	<tr>
		<td>{$_lang.tbl_orders.label.payment_bill}</td>
		<td><span style='font-weight:bold;'>
		${$tbl_ordersinfo.bill_amnt|number_format:2}</span></td>
	</tr>
	<tr>
		<td>{$_lang.tbl_orders.label.payment_tax}</td>
		<td><span style='font-weight:bold;'>
		${$tbl_ordersinfo.tax_amnt|number_format:2}</span></td>
	</tr>
	<tr>
		<td>{$_lang.tbl_orders.label.order_misc_charge}</td>
		<td><span style='font-weight:bold;'>${$tbl_ordersinfo.order_misc_charge|number_format:2}</span> </td>
	</tr>
	<tr>
		<td>{$_lang.tbl_orders.label.order_promotion_disc}</td>
		<td><span style='font-weight:bold;'>
		${$tbl_ordersinfo.promdisc_applied|number_format:2}</span></td>
	</tr> 
	
	{if $tbl_ordersinfo.tip_amnt eq 0 && $tbl_ordersinfo.payment_options.ord_pmnt_option && (($tbl_ordersinfo.payment_options.ord_pmnt_id)==false)}
		<tr>
		<td colspan="2">  
				<label>{$_lang.tbl_orders.label.tip_suggestion}</label>
				<select name="tip_list" id="tip_list" onclick="tipChange(this.value);">
				<option value="0">Select value</option>
				{foreach $tiplist as $tip}
				 {math assign=tip_val equation='(x * y)/100.00' x=$tbl_ordersinfo.curr_bill_amnt y=$tip}
					<option value="{$tip_val}">{$tip}{$_lang.percent_mark} ({$_lang.currency_mark}{$tip_val|number_format:2:".":"."})</option>
				{/foreach}
				<option value="-1">Select other</option>
				</select>
				<div id="order_tip_holder" class="biz_hidden">
				{html_input name="order_tip" onblur="tipChange();"} 
				</div>
		</td>
	</tr>
	{else}
		<tr>
		<td>{$_lang.tbl_orders.label.payment_tip}</td>
		<td><span style='font-weight:bold;'>${$tbl_ordersinfo.tip_amnt|number_format:2}</span></td>
	</tr> 
	{/if}
	
	
	
	<tr>
		<td>{$_lang.tbl_orders.label.payment_total}</td>
		<td><span style='font-weight:bold;' id="all_bill_holder">
		${$tbl_ordersinfo.all_bill_amnt|number_format:2}</span></td>
	</tr>
	 
	<tr>
		 <td>{$_lang.tbl_orders.label.paid_by}</td> 
		<td><span style='font-weight:bold;'>{if $tbl_ordersinfo.bill_paid_by neq ''}{$tbl_ordersinfo.bill_paid_by}{else} -{/if}</span></td>
	</tr>			
	<tr>
		<td>Payment Method</td>			
		<td>{$tbl_ordersinfo.payment_options.ord_pmnt_option} PAYMENT</td>			
	</tr>
	{if $tbl_ordersinfo.payment_options.ord_pmnt_option eq "SPLIT"}
		<tr>
			<td>Divided Among:&nbsp;&nbsp;</td>
	    <td> <span style='font-weight:bold;'>{$tbl_ordersinfo.payment_options.ord_pmnt_split_amng}</span>
	    </td> 
		</tr>
        <!-- is_paid={$tbl_ordersinfo.is_all_paid} , can_pay_amt={$tbl_ordersinfo.can_pay_amt} ,paid_member_cnt={$tbl_ordersinfo.paid_member_cnt}  -->
		{if ($tbl_ordersinfo.is_all_paid eq 0) && ($tbl_ordersinfo.payment_options.ord_pmnt_id) && ($tbl_ordersinfo.can_pay_amt >0 )}
		  {math assign="remain_members" equation="x - y" x=$tbl_ordersinfo.payment_options.ord_pmnt_split_amng y=$tbl_ordersinfo.paid_member_cnt}
            <tr>
    		   <td>Pay for:&nbsp;&nbsp;</td>
    	       <td>
     	            <div id="box_split_pay_for" >
    					<select type="text" name="ord_pmnt_split_pay_for" id="ord_pmnt_split_pay_for" onchange="update_cur_pay_amt(document.getElementById('ord_pmnt_split_amng'),this.value);">
        				{for $var=1 to $remain_members}
        				  <option value="{$var}">{$var}</option>
        				{/for}
        				</select>
    				</div>
    	       </td>
    		</tr>
        {/if}
	{/if}	

        <tr>
			{if $tbl_ordersinfo.payment_options gt 0}
				<tr>
					<td>Total Paid Amount</td>
					<td><span style='font-weight:bold;'>${$tbl_ordersinfo.payment_options.ord_pmnt_amnt_paid|number_format:2}</span> </td>
				</tr>
			{/if}
		
			<td>Amount you have to pay:&nbsp;&nbsp;</td>
	    	<td> 
				<span style='font-weight:bold;' id="cur_pay_amt">				
				{if $tbl_ordersinfo.can_pay_amt >0}
					${$tbl_ordersinfo.can_pay_amt|number_format:2}
				{else}					
					{if $tbl_ordersinfo.payment_options.ord_pmnt_option eq "SPLIT"}
                        {if $tbl_ordersinfo.how_many_sec_paid >1}
                            {math assign="py_amnt" equation="x / y * z" x=$tbl_ordersinfo.all_bill_amnt y=$tbl_ordersinfo.payment_options.ord_pmnt_split_amng z=$tbl_ordersinfo.how_many_sec_paid}
                        {else}
                            {math assign="py_amnt" equation="x / y" x=$tbl_ordersinfo.all_bill_amnt y=$tbl_ordersinfo.payment_options.ord_pmnt_split_amng}
                        {/if}

					    Already paid : (${$py_amnt|number_format:2}).
					{else}
					 	--
					{/if}					
				{/if}			
				</span>
	    	</td> 
	   </tr> 				 
		 
	</table> 
	{if $tbl_ordersinfo.order_status_id neq $smarty.const.TBL_STATUS_CHECK} 
		<form id='pay_opt_select' name='pay_opt_select' method="POST" action="{$page_url}">
			<input type="hidden" id='process_payment' name='process_payment' value='yes' />
			<input type="hidden" id='order_id' name='order_id' value='{$tbl_ordersinfo.order_id}' />
  			<input type="hidden" name="order_payment_id" id="order_payment_id" value="{$tbl_ordersinfo.payment_options.ord_pmnt_id}"/>
			<input type="hidden" name="order_amt_i_pay" id="order_amt_i_pay" value="{$tbl_ordersinfo.can_pay_amt}"/> 
			 <input type="hidden" id="ord_pmnt_split_amng" name="ord_pmnt_split_amng" value="{$tbl_ordersinfo.payment_options.ord_pmnt_split_amng}"/> 
			 <input type="hidden" id="ord_pmnt_split_pay_for" name="ord_pmnt_split_pay_for" value="1" />
			 
			 <div class="biz_center">
	{if $tbl_ordersinfo.can_pay_amt gt 1}
		 {if (!($tbl_ordersinfo.payment_options) || (!($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash) || ($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash eq 0)))}
				{if $smarty.session[$smarty.const.SES_PAYPAL_EMAIL] neq ""}
                    <!-- onclick="redirect_to_paypal({$tbl_ordersinfo.order_id},{$tbl_ordersinfo.payment_options.ord_pmnt_id},'{$tbl_ordersinfo.payment_options.ord_pmnt_option}',{$tbl_ordersinfo.payment_options.ord_pmnt_split_amng},{$tbl_ordersinfo.can_pay_amt},'{$tbl_ordersinfo.order_takeout_email}',0);" -->
					<a class="ui-disabled" href="#" onclick="alert('{$_lang.downtown_demo_payment_lnk}');"  data-role="button" data-inline="true" data-icon="star" data-theme="b">{$_lang.main.check_out}</a><br>
			{/if} 
			{/if}

    		{if (!($tbl_ordersinfo.payment_options) || (($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash) || ($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash eq 1)))}
                {if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER}
                    <!-- onclick="redirect_to_paypal({$tbl_ordersinfo.order_id},{$tbl_ordersinfo.payment_options.ord_pmnt_id},'{$tbl_ordersinfo.payment_options.ord_pmnt_option}',{$tbl_ordersinfo.payment_options.ord_pmnt_split_amng},{$tbl_ordersinfo.can_pay_amt},'{$tbl_ordersinfo.order_takeout_email}',1);" -->
                    <!-- onclick="alert('{$_lang.downtown_demo_payment_lnk}');" -->
 					<a href="#" onclick="redirect_to_paypal({$tbl_ordersinfo.order_id},{$tbl_ordersinfo.payment_options.ord_pmnt_id},'{$tbl_ordersinfo.payment_options.ord_pmnt_option}',{$tbl_ordersinfo.payment_options.ord_pmnt_split_amng},{$tbl_ordersinfo.can_pay_amt},'{$tbl_ordersinfo.order_takeout_email}',1);" data-role="button" data-inline="true" data-icon="star" data-theme="b">{$_lang.main.pay_by_cash}</a>
    			{else}
                     <!-- onclick="window.location.href='{$website}/user/services_request.php?table_id=1&service_id={$smarty.const.SERVICE_PAY_BY_CASH}';" -->
                     <!-- onclick="alert('{$_lang.downtown_demo_payment_lnk}');" -->
                     <a href="#" onclick="window.location.href='{$website}/user/services_request.php?table_id=1&service_id={$smarty.const.SERVICE_PAY_BY_CASH}';"  data-role="button" data-inline="true" data-icon="star" data-theme="b" >{$_lang.main.pay_by_cash}</a>
    			{/if}
			{/if}
			{/if}	 
			{jqmbutton onclick="printReceipt({$tbl_ordersinfo.order_id},1);" icon="copy-item" value="Receipt"}	
			 </div>
				
		</form>
	{/if}
	{else}
		<form id='pay_opt_select' name='pay_opt_select' method="POST" action="{$page_url}"> 
			<div class="biz_hidden">	
				<label >Choose payment mode:</label>
				<select  name="payment_choice" id="payment_choice" onchange="tog_split_opt(this.value);">
						<option value="individual" {if $smarty.request.payment_choice eq 'individual'}selected="selected"{/if}>Individual</option>
						<option value="single" {if $smarty.request.payment_choice eq 'single'}selected="selected"{/if}>Single Payer</option>
						<option value="split" {if $smarty.request.payment_choice eq 'split'}selected="selected"{/if}>Split Order</option>
				</select>
			</div>	
				<div id="box_split_amng" {if $smarty.request.payment_choice eq 'split'}{else}class="biz_hidden"{/if}>
					<label>Divided among {$_lang.denote_mark}</label>
					<select type="text" name="ord_pmnt_split_amng" id="ord_pmnt_split_amng" onchange="update_cur_pay_amt(this,document.getElementById('ord_pmnt_split_pay_for').value);">
    				{for $var=1 to $tbl_ordersinfo.orders_count}
    				  <option value="{$var}" {if $tbl_ordersinfo.payment_options.ord_pmnt_split_amng and $tbl_ordersinfo.payment_options.ord_pmnt_split_amng eq $var} selected='selected'{/if}>{$var}</option>
    				{/for}
    				</select> 
				</div>


                <div id="box_split_pay_for" {if $smarty.request.payment_choice eq 'split'}{else}class="biz_hidden"{/if}>
                    <div id="box_split_pay_for" >
    					<label>Paying for {$_lang.denote_mark}</label>
    					<select type="text" name="ord_pmnt_split_pay_for" id="ord_pmnt_split_pay_for" onchange="update_cur_pay_amt(document.getElementById('ord_pmnt_split_amng'),this.value);">
        				{for $var=1 to $tbl_ordersinfo.orders_count}
        				  <option value="{$var}" >{$var}</option>
        				{/for}
        				</select>
    				</div>
				</div>
				
				{include file="tbl_orders/tip_selection.tpl"} 
			<div id='split_detail' style="display:{if $tbl_ordersinfo.payment_options.ord_pmnt_option eq 'SPLIT' OR $tbl_ordersinfo.can_pay_amt>1}block{else}none{/if};"> 
			<table class="listTable">
				<tr><th colspan="2">Payment Detail</th></tr>
				<tr>
						<td class="fieldItem bigListItem">{$_lang.tbl_orders.label.payment_bill}<i>{$_lang.denote_mark}</i></td>
						<td class="valueItem actionListItem">${$tbl_ordersinfo.bill_amnt|number_format:2}</td>
				</tr>
				<tr>
						<td class="fieldItem bigListItem">{$_lang.tbl_orders.label.payment_tax}<i>{$_lang.denote_mark}</i></td>
						<td class="valueItem actionListItem">${$tbl_ordersinfo.tax_amnt|number_format:2}</td>
				</tr>
				<tr>
            		<td class="fieldItem bigListItem">{$_lang.tbl_orders.label.order_promotion_disc}<i>{$_lang.denote_mark}</i></td>
            		<td class="valueItem actionListItem">
            		${$tbl_ordersinfo.promdisc_applied|number_format:2}</td>
            	</tr>
				<tr>
						<td class="fieldItem bigListItem">{$_lang.tbl_orders.label.order_misc_charge}<i>{$_lang.denote_mark}</i></td>
						<td class="valueItem actionListItem">${$tbl_ordersinfo.order_misc_charge|number_format:2}</td>
				</tr>
				<tr>
						<td class="fieldItem bigListItem">{$_lang.tbl_orders.label.payment_tip}<i>{$_lang.denote_mark}</i></td>
						<td class="valueItem actionListItem" id="tip_holder">$0.00</td>
				</tr>
				
				<tr>
						<td class="fieldItem bigListItem">{$_lang.tbl_orders.label.payment_total}<i>{$_lang.denote_mark}</i></td>
						<td class="valueItem actionListItem" id="all_bill_holder">${$tbl_ordersinfo.all_bill_amnt|number_format:2}</td>
				</tr> 
				<tr>
						<td class="fieldItem bigListItem">You have to pay <i>{$_lang.denote_mark}</i></td>
						<td class="valueItem actionListItem" id='cur_pay_amt' style='font-weight:bold;'>{if $tbl_ordersinfo.can_pay_amt > 1} ${$tbl_ordersinfo.can_pay_amt|number_format:2}{/if}</td>
				</tr>
			</table>
			</div>

			<div class="clearfix line_break"></div>
			<div class="biz_center">
			{if $tbl_ordersinfo.can_pay_amt eq 1}
				<input type="hidden" id='process_payment' name='process_payment' value='yes' />
				<input type="hidden" id='order_id' name='order_id' value='{$tbl_ordersinfo.order_id}' />  
				{if (!($tbl_ordersinfo.payment_options) || (!($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash) || ($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash eq 0)))}
					{if $smarty.session[$smarty.const.SES_PAYPAL_EMAIL] neq ""}
                        <!-- onclick="var tmpAmnt=getAmountToPay();redirect_to_paypal({$tbl_ordersinfo.order_id},0,'','',tmpAmnt);" -->
                        <!-- onclick="alert('{$_lang.downtown_demo_payment_lnk}');" -->
						<a class="ui-disabled" href="#" onclick="var tmpAmnt=getAmountToPay();redirect_to_paypal({$tbl_ordersinfo.order_id},0,'','',tmpAmnt);" data-role="button" data-inline="true" data-icon="star" data-theme="b">{$_lang.main.check_out}</a> <br>
				  {/if} 
				{/if}

				{if (!($tbl_ordersinfo.payment_options) || (($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash) || ($tbl_ordersinfo.payment_options.ord_pmnt_ispaybycash eq 1)))}
                    {if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER ||$Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR}
                        <!-- onclick="var tmpAmnt=getAmountToPay();redirect_to_paypal({$tbl_ordersinfo.order_id},0,'','',tmpAmnt,'',1);" -->
                        <!-- onclick="alert('{$_lang.downtown_demo_payment_lnk}');" -->
					   <a href="#" onclick="var tmpAmnt=getAmountToPay();redirect_to_paypal({$tbl_ordersinfo.order_id},0,'','',tmpAmnt,'',1);" data-role="button" data-inline="true" data-icon="star" data-theme="b">{$_lang.main.pay_by_cash}</a>
					{else}
                        <!-- onclick="window.location.href='{$website}/user/services_request.php?table_id=1&service_id={$smarty.const.SERVICE_PAY_BY_CASH}';" -->
                        <!-- onclick="alert('{$_lang.downtown_demo_payment_lnk}');" -->
					    <a href="#" onclick="window.location.href='{$website}/user/services_request.php?table_id=1&service_id={$smarty.const.SERVICE_PAY_BY_CASH}';" data-role="button" data-inline="true" data-icon="star" data-theme="b" >{$_lang.main.pay_by_cash}</a>
				    {/if}
				{/if}	
			{/if}
			{jqmbutton onclick="printReceipt({$tbl_ordersinfo.order_id},1);"  icon="copy-item" value="Receipt"}  
			</div> 
		</form>
	{/if}
 {/if}
	</div>
{/if}
	</div>
	
<div data-role="popup" data-dismissible="false" data-overlay-theme="f" data-theme="a1"  id='popupClaimPromotion' style="width:270px;">
<div data-role="header">
	<h3><a href="#" onclick="$('#popupClaimPromotion').popup('close');" data-icon="delete" style="display:inline;float: right;" data-role="button" data-iconpos="notext" data-inline="true"></a>Payment</h3>
</div>
<div data-role="content" style="padding:5px;">
		<label>Please wait ... we are in the process of applying promotions to your order</label><br/>
		<div class="biz_center">
			 {jqmbutton onclick="reqstClaimPromotion({$tbl_ordersinfo.order_table_id},'{$tbl_ordersinfo.order_customer_name}',{$tbl_ordersinfo.order_id});" value="Ok I will wait"}
			 {jqmbutton onclick="$('#popupClaimPromotion').popup('close');$('#pay_mode_sel').popup('open');" value="No Thanks"}	 
		</div>	 
</div>
</div>
