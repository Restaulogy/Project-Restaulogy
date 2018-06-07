<div data-role="popup" id="popupCart"  data-dismissible="false" style="width:250px;" data-overlay-theme="i" data-theme="a">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h6>{$_lang.main.cart.order_item}</h6>
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">

		{if $smarty.session[$smarty.const.SES_CART]}  
		<form id="frm_place_order" name="frm_place_order" action="{$website}/user/place_order.php?is_preview=1" method="POST" onsubmit="return validateOrder();">
		<table class="biz_data_grid" style="width:99%;">
			<tr>
		        <th style="width:2%;">{$_lang.main.cart.srno}</th>
		        <th style="width:30%;">{$_lang.main.cart.item}</th>
				<th style="width:10%;text-align:center;">{$_lang.main.cart.qty}</th>
				<th style="width:20%;text-align:right;">{$_lang.main.cart.rate}</th>
				<th style="width:20%;text-align:right;">{$_lang.main.cart.total}</th>
				<th style="width:15%;"></th>
			</tr>
			{assign var=grd_tot value=0}
			{assign var=tot value=0}
		{foreach from=$smarty.session[$smarty.const.SES_CART] key=sequence_num item=ord_sequence}
        {if $sequence_num eq 0 OR $sequence_num neq "order_info"}
		{foreach from=$ord_sequence[$smarty.const.SES_SUB_MENU_DISH] key=kydish_cart item=dish_cart name=nmdish_cart}
			{assign var="tot" value=0} 
			{if $dish_cart.qty} 
				{assign var=dishcart_qty value=$dish_cart.qty}
			{else}
				{assign var=dishcart_qty value=0}
			{/if}
			{math assign="tot" equation="x * y" x=$dish_cart.price y=$dishcart_qty}
		 <tbody id="dish_holder_{$sequence_num}_{$kydish_cart}">
			<tr class="sub_main">
		        <td>{$sequence_num + 1}.</td>
				<td><a href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$kydish_cart}&sequence_num={$sequence_num}">{$dish_cart.title}</a></td>
				<td style="text-align:center;"> 
				<div {if $dish_cart.price && $dish_cart.price gt 0}{else}class="biz_hidden"{/if}> 
					<select data-mini="true" id="dish_qty_{$sequence_num}_{$kydish_cart}" name="dish_qty_{$sequence_num}_{$kydish_cart}" onchange="updateDishItem({$kydish_cart},{$sequence_num},this.value);">
						{for $i=1 to 10}<option value="{$i}" {if $i eq $dish_cart.qty}selected="selected"{/if}>{$i}</option> {/for}
					</select> 
				</div>
				</td>
		        <td style="text-align:right;">{$dish_cart.price|string_format:"%.2f"}<input type="hidden" value="{$dish_cart.price}"  id="dish_price_{$sequence_num}_{$kydish_cart}" name="dish_price_{$sequence_num}_{$kydish_cart}"/></td>
				<td style="text-align:right;font-weight:bold;" id="dish_total_{$sequence_num}_{$kydish_cart}">{$tot|string_format:"%.2f"} {math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
				</td>
				<td><b onclick="cancelDishItem({$kydish_cart},{$sequence_num});" class="deleteIcon"></b></td>
			</tr>
			{if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE]}
			{foreach from=$dish_cart[$smarty.const.SES_DISH_OPTION_VALUE] key=optItmId item=optItm  name=nmoptItm}
				
		    	{assign var="tot" value=0}
					{if $optItm.qty} 
						{assign var=optitm_qty value=$optItm.qty}
					{else}
						{assign var=optitm_qty value=0}
					{/if}
		    	{math assign="tot" equation="x * y" x=$optItm.price y=$optitm_qty}
		    	<tr id="dish_opt_holder_{$sequence_num}_{$optItmId}"  class="{cycle values='odd,even'}">
		            <td>&nbsp;</td>
		    		<td>{$smarty.foreach.nmoptItm.index + 1}) {$optItm.title}</td>
		    		<td style="text-align:center;">
						<div {if $optItm.price && $optItm.price gt 0}{else}class="biz_hidden"{/if}> 
							<select data-mini="true" id="dish_opt_qty_{$sequence_num}_{$optItmId}" name="dish_opt_qty_{$sequence_num}_{$optItmId}" onchange="updateDishOption({$optItmId},{$kydish_cart},{$sequence_num},this.value);">
						{for $i=1 to 10}<option value="{$i}" {if $i eq $optItm.qty}selected="selected"{/if}>{$i}</option> {/for}
							</select>
						</div>
						</td>
		            <td style="text-align:right;">{$optItm.price} <input type="hidden"  id="dish_opt_price_{$sequence_num}_{$optItmId}" name="dish_opt_price_{$sequence_num}_{$optItmId}" value="{$optItm.price}"/></td>
		    		<td style="text-align:right;font-weight:bold;" id="dish_opt_total_{$sequence_num}_{$optItmId}">{$tot|string_format:"%.2f"} {math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
		    		</td>
					<td><b onclick="cancelDishOption({$optItmId},{$kydish_cart},{$sequence_num});" class="deleteIcon"></b></td>
		    	</tr>
			{/foreach}
			{/if} 
			</tbody>
		{/foreach}
		{/if}
	  {/foreach}
		 <tfoot>
			<tr>
				<td colspan="4" style="text-align:right;">{$_lang.main.cart.total}</td>
				<td align="center" colspan="2" id="grndTotal">{$grd_tot|string_format:"%.2f"}</td>
			</tr>
		 </tfoot>
		</table>
    <div class="field-row" id="blockCustomerPhone">
        <p><label for="order_customer_name">Customer (Phone) </label></p>
        <p>
          <input type="text" name="order_customer_name" id="order_customer_name" value="{$smarty.session[$smarty.const.SES_OTP].staff_phone}" {if $smarty.session[$smarty.const.SES_OTP].staff_phone gt 0  || ($sesslife && $isCustomer)} readonly="readonly"{/if}/>           
        </p>
    </div>
    {if $isOnlineOrder eq '1'}
    <div class="field-row" id="blockConfirmationMsg" style="display: none;">
    	  <p style="color:#faf25a;text-align:justify;"><br/>Confirmation code is sent to your mobile, please use that for proceeding with place order<br/><br/></p> 
    </div>
    <div class="field-row" id="blockConfirmationCode" style="display: none;">
        <p><label for="confirmation_code">Confirmation Code </label></p>
        <p><input type="text" name="confirmation_code" id="confirmation_code" value=""/></p>
    </div>
    
    {/if}
    <div style="display:{if ($smarty.session.nor_table_id && $smarty.session.nor_table_id >0) || ($isCustomer && $isOnlineOrder eq '1')}none{else}block{/if};" >
        <p><label for="order_guest">No. Of Guests </label></p>
        <p><input data-inline="true" type='text' name='order_guest' id='order_guest' value='1' autocomplete="off" /></p>
    </div>
     {* if ( $smarty.session[$smarty.const.SES_ONLINE_STORE] neq 1) && ($smarty.session[$smarty.const.SES_TABLE]) && $isCustomer }
      <div class="field-row">
          <p><label for="reward_email">Reward Email</label>
          </p>
          <p>
            <input type="text" name="reward_email" id="reward_email" value="{$smarty.session.reward.email}" {if $smarty.session[$smarty.const.SES_REWARD].email && $isCustomer} readonly="readonly"{/if}/>
              <small style="font-size:11px;">	If you have not already signed for the reward program.Please signup here <a href="{$website}/user/cust_login" style="float:right;"  data-inline="true" data-role="button" data-theme='a' data-icon="sign-in" data-iconpos="notext">{$_lang.sign_up}</a>
              </small>
          </p>
      </div>
      {/if *}
		<!--
		( $smarty.session[$smarty.const.SES_ONLINE_STORE] eq 1 AND $smarty.session.cust_nm eq '')
		-->						
		{if $smarty.session.member_role_id eq $smarty.const.ROLE_WAITER OR $smarty.session.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR OR $smarty.session.member_role_id eq $smarty.const.ROLE_ADMIN OR $smarty.session.member_role_id eq $smarty.const.ROLE_OWNER OR ( $smarty.session[$smarty.const.SES_ONLINE_STORE] eq 1)}
		
						<div class="field-row" style="{if $isOnlineOrder eq '1'}display: none;{/if}">
							<p><label for="order_type">Select Order Type</label></p>
							<p>
									<select name="order_type" id="order_type" onchange="changeTables(this.value);">
										{if $smarty.session[$smarty.const.SES_ONLINE_STORE] neq 1}
										<option value="{$smarty.const.ORDER_TYPE_AT_LOCATION}">{$smarty.const.ORDER_TYPE_AT_LOCATION}</option>
										{/if}
										<option value="{$smarty.const.ORDER_TYPE_TAKE_OUT}" {if $smarty.session[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_TAKE_OUT}selected="selected"{/if}>{$smarty.const.ORDER_TYPE_TAKE_OUT}</option>
										<option value="{$smarty.const.ORDER_TYPE_DELIVERY}" {if $smarty.session[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_DELIVERY}selected="selected"{/if}>{$smarty.const.ORDER_TYPE_DELIVERY}</option>
										<option value="{$smarty.const.ORDER_TYPE_ONLINE_DINE}" {if $smarty.session[$smarty.const.ORDER_TYPE] eq $smarty.const.ORDER_TYPE_ONLINE_DINE}selected="selected"{/if}>{$smarty.const.ORDER_TYPE_ONLINE_DINE}</option>										
									</select>
							</p>
						</div>
						<!--
						<div id="div_tk_out_delivery" class="field-row" style="display:{if $isCustomer && $smarty.session[$smarty.const.SES_ONLINE_STORE] eq 1}block{else}none{/if};">
						-->
						 <div id="div_tk_out_delivery" class="field-row" style="display:{if $isCustomer && $smarty.session[$smarty.const.SES_ONLINE_STORE] eq 1 && $isOnlineOrder eq '0'}block{else}none{/if};">
              <p><label for="tk_out_delivery">Delivery/pick-up time (Min.)</label></p>
              <p>
								<select type="text" name="tk_out_delivery" id="tk_out_delivery" >
								<option value="0">Choose</option>	
								{for $foo=5 to 60 step 5}
								    <option value="{$foo}" {if $smarty.session[$smarty.const.ORDER_TAKEOUT_TIME] eq $foo}selected="selected"{/if}>{$foo}</option>
								{/for}
								</select>
							</p>	
						</div>
			 			
					{if $smarty.session[$smarty.const.SES_ONLINE_STORE] neq 1}			 
		     		<div class="field-row">
                <p><label for="order_table_id">Select Table </label></p>
                <p>
                  <select name="order_table_id" id="order_table_id" {if $smarty.session[$smarty.const.SES_CART].order_info.order_id gt 0} {/if}>
									<option value="0" >Select One</option>
                 {if $emp_tables}
            			{foreach $emp_tables as $value}
            				{if $smarty.session[$smarty.const.SES_CART].order_info.order_id gt 0}
                    			<option value="{$value@key}" {if $smarty.session.nor_table_id eq "{$value@key}"} selected='selected'{else}disabled="disabled"{/if}>{$value}</option>
		                    {else}
		                        <option value="{$value@key}" {if $smarty.session.nor_table_id eq "{$value@key}"} selected='selected'{/if}>{$value}</option>
		                    {/if} 		                    
            			{/foreach}
            	 {/if}
            	   </select>
                </p>
		         </div>
		      {/if}
		{/if} 
              <div class="field-row" id="order_note_row">
                  <p><label for="order_note">{$_lang.services_requests.label.srvc_reqst_special_note}:&nbsp;&nbsp;<a href="#" onclick="hide_show_sp_note();"><img id="img_order_note" src="{$website}/images/_graphics/show.gif"></a></label></p>
                  <p><textarea style="display:none;" type="text" name="order_note" id="order_note">{$smarty.session[{$smarty.const.SES_CART}].order_info.order_note}</textarea>
                  <div class="error" id='order_note_err'></div>
                  </p>
              </div>
										
							<div class="field-row" style="display:{if ($Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR)||(($smarty.const.IS_SERV_ALWD_NOTE eq 1) && ($Global_member.member_role_id eq $smarty.const.ROLE_WAITER))}block{else}none{/if};">
                  <p><label for="order_manager_note">{$_lang.tbl_orders.label.order_manager_note}:&nbsp;&nbsp;<a href="#" onclick="hide_show_sp_note('order_manager_note');"><img id="img_order_note" src="{$website}/images/_graphics/show.gif"></a></label></p>
                  <p><textarea style="display:none;" type="text" name="order_manager_note" id="order_manager_note">{$smarty.session[{$smarty.const.SES_CART}].order_info.order_manager_note}</textarea>
                  <div class="error" id='order_note_err'></div>
                  </p>
              </div> 
			<input type="hidden" value="0" id="is_pay_now" name="is_pay_now" />
			<input type="hidden" value="0" id="add_proms" name="add_proms" />
			
			{if $tmp_customer_session gt 0 || $smarty.session[$smarty.const.SES_TABLE] gt 0}
				<div class="biz_center">
					<input data-role="button" data-inline="true" data-theme="a" type="button" onclick="$('#is_pay_now').val(0);$('#frm_place_order').submit();" value="{$_lang.main.cart.place_order}" />
				</div>
			{else}
				<div id="btnPlaceOrder" class="biz_center">
					<input data-role="button" data-icon="cart" data-inline="true" data-theme="a" type="button" onclick="add_prom_click(1)" id="sub_place_order" value="Add Promotions" />
					<input data-role="button" data-icon="check" data-inline="true" data-theme="a" type="button" onclick="add_prom_click(0)" id="sub_place_order" value="{$_lang.main.cart.place_order}" />
				</div>			
		    {/if} 
		</form>
		{else}
			<div class="error">{$_lang.main.cart.empty}</div>
		{/if}
	</div>
</div>

 

{literal}
 
 <script type="text/javascript">
 
 function place_order(){
  order_type = elemById('order_type').value;
	if(order_type == "{/literal}{$smarty.const.ORDER_TYPE_AT_LOCATION}{literal}"){	
		$('#is_pay_now').val(0);
		$('#frm_place_order').submit();
 	}else{
		$('#btnPlaceOrder').hide();
		$('#btnPayNowLater').show();
	}
 } 

function add_prom_click(add_proms){
	if(add_proms==1){
		$('#add_proms').val(1);		
	}else{
		$('#add_proms').val(0);
	}	
	$('#frm_place_order').submit();  
 } 
 
 
function changeTables(order_type){
	
	if(order_type=="{/literal}{$smarty.const.ORDER_TYPE_AT_LOCATION}{literal}"){	
		$('#btnPlaceOrder').show();
		$('#btnPayNowLater').hide();
		var isSel=0;  
		$("#order_table_id > option").each(function() {
			
			 if(this.value == 0){
			 		$(this).attr('disabled','disabled'); 
					$(this).removeAttr('selected');  
			 }else{  
			 		$(this).removeAttr('disabled') ; 
					if(isSel==0){
						$(this).attr('selected','selected');
						isSel=1;
					} 
			 }  
		}); 
		$("#div_tk_out_delivery").hide();
		$("#tk_out_delivery").val('').selectmenu('refresh');
	}else{
		{/literal}
		{if $smarty.session[$smarty.const.SES_ONLINE_STORE] neq 1}{literal}
		$("#order_table_id > option").each(function() {
			 if(this.value == 0){
			 	$(this).removeAttr('disabled') ;
				$(this).attr('selected','selected');  
			 }else{
			 	$(this).attr('disabled','disabled'); 
				$(this).removeAttr('selected'); 
			 } 
		});
		{/literal}{/if}{literal}
		$("#div_tk_out_delivery").show();
	}
	 
	var cnt = 0;
	/*$("#order_table_id > option").each(function() { 
		if($(this).attr('disabled')!='disabled'){ 
			if(this.text != ""){
				if(cnt==0){
					$(this).attr('selected','selected');
				} 
				cnt++;
			}  
		} 
	});*/
	$('#order_table_id').selectmenu('refresh'); 
} 

function hide_show_sp_note(txt_id){
	  if(txt_id){}else{txt_id = "order_note"};
    var state = document.getElementById(txt_id).style.display;
    if (state == 'block') {
        document.getElementById(txt_id).style.display = 'none';
        document.getElementById("img_" + txt_id).src="{/literal}{$website}{literal}/images/_graphics/show.gif";
    }else{
        document.getElementById(txt_id).style.display = 'block';
        document.getElementById("img_" + txt_id).src="{/literal}{$website}{literal}/images/_graphics/hide.gif";
    }
}

function validateOrder(){
   var errStr = "";
   var order_type = elemById('order_type').value;
  // if(document.getElementById("order_customer_name").value == ""){
   if(order_type=="{/literal}{$smarty.const.ORDER_TYPE_AT_LOCATION}{literal}"){		
	   if(elemById("order_table_id").value == 0){
	      	errStr  = errStr + "Please select Table. \n"; 
	   }
   }	
   if(IsNonEmpty(elemById("order_guest").value) == false){
      	errStr  = errStr + "Please provide no. of guest. \n"; 
   }else{
      	if(IsNumeric(elemById("order_guest").value) == false){
    	  	errStr  = errStr + "Guest Number Must Be Number. \n";
      	}
   }	 
	 
  /*
  if(IsNonEmpty(elemById("order_customer_name").value) == false){
      	errStr  = errStr + "Please provide Customer Phone. \n"; 
   }else{
      	if(isPhoneNumber(elemById("order_customer_name").value) == false){
    	  	errStr  = errStr + "Phone number is not proper. \n";
      	}
   }
  
   if((elemById('reward_email')) && (IsNonEmpty(elemById('reward_email').value)) ){
      if(isEmail(document.getElementById("reward_email").value)==false){
				errStr  = errStr + "{/literal}{$_lang.messages.validation.email}{literal} \n";
			}  
   } */
	 
  {/literal}
     {if $smarty.session.member_role_id eq $smarty.const.ROLE_WAITER OR $smarty.session.member_role_id eq $smarty.const.ROLE_MANAGER OR $Global_member.member_role_id eq $smarty.const.ROLE_EXPEDITOR OR $smarty.session.member_role_id eq $smarty.const.ROLE_ADMIN OR $smarty.session.member_role_id eq $smarty.const.ROLE_OWNER OR ( $smarty.session[$smarty.const.SES_ONLINE_STORE] eq 1) && $isOnlineOrder eq '0'}
     {literal} 
	 if(elemById('order_type').value != "{/literal}{$smarty.const.ORDER_TYPE_AT_LOCATION}{literal}"){
	 	 if(is_gt_zero_num(elemById('tk_out_delivery').value)==false){
		 	errStr  = errStr + "Please Select Delivery/pick-up time. \n";  
		 }
	 }	
	 {/literal}{/if}{literal}
	 
	 {/literal}
	 {if $smarty.session[$smarty.const.SES_ONLINE_STORE] eq 1} 
	 {literal}
	 /*$('#order_takeout_email').html("");
	 if(IsNonEmpty(elemById('order_takeout_email').value)){
	 	if(isEmail(elemById('order_takeout_email').value)==false){
			 errStr  = errStr + "Please provide proper Email. \n"; 
		}
	 }*/
	 {/literal}
	 {/if} 
	 {literal}
	 if(errStr != ""){
	 	alert(errStr);
		return false;
	 }
   return true;
}

function calculateOrder(){
 var opt_val_id ="", optid = "", grTotal = 0, isDishItem = 0;
 var elem = document.getElementById('frm_place_order').elements;
 
  
 for(var i = 0; i < elem.length; i++){
 if(elem[i].type == "select-one"){ 
	    strOptionId = elem[i].id;  
		isDishItem = 0; 
 	 	if(strOptionId.indexOf("dish_opt_qty_") > -1){
			isDishItem = 1;
			strOptions = strOptionId.replace("dish_opt_qty_",""); 
		}else{
			isDishItem = 0;
			strOptions = strOptionId.replace("dish_qty_",""); 
		}  
		strOptions = strOptions.split("_");
		seq_num = strOptions[0];
		itemId = strOptions[1]; 
	  	if(itemId > 0 && isInt(seq_num)){
			  grTotal = grTotal + CalOrderPrice(itemId,seq_num,isDishItem);
	  	}//..if  
	}//..if select one
 }//..for 
  $("#grndTotal").html(grTotal.toFixed(2)).trigger("refresh");
  
}

function CalOrderPrice(itemId,seq_num,isDishItem){
 	var total = 0;
	if(itemId > 0 && isInt(seq_num)){
	 if(isDishItem){
	    
	 	total = $('#dish_opt_qty_' + seq_num + "_" + itemId).val() * $('#dish_opt_price_' + seq_num + "_" + itemId).val(); 
		$('#dish_opt_total_' + seq_num + "_" + itemId).html(total.toFixed(2)).trigger("refresh");
	 }else{
	 	total = $('#dish_qty_' + seq_num + "_" + itemId).val() * $('#dish_price_' + seq_num + "_" + itemId).val() ; 
		 
		$('#dish_total_' + seq_num + "_" + itemId).html(total.toFixed(2)).trigger("refresh");
	 } 
	}
	return total;
}

function updateDishItem(dish_id,sequence,qty){
  	if((dish_id>0) && (sequence > -1) && (qty > 0)){ 
  		info = {};
		info['updateDishOrder'] = dish_id;
		info['sequence_num'] = sequence;
		info['qty'] = qty;
		info["{/literal}{$smarty.const.IS_AJAX}{literal}"]  = 1;
		$.ajax({     
            type     : "POST",
            url      : "{/literal}{$website}{literal}/user/add2cart.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) {
                if(data){  
                }
            },
            error: function( objRequest ){
                     alert("Error occured" + objRequest.responseText);
            }
      }); 
	} 
	calculateOrder();
}

function cancelDishItem(dish_id,sequence){
  if((dish_id>0) && (sequence > -1)){ 
 	if(confirm("Are you sure to delete?")){  
		info = {};
		info['cancelDishOrder'] = dish_id;
		info['sequence_num'] = sequence;
		info["{/literal}{$smarty.const.IS_AJAX}{literal}"]  = 1;
		$.ajax({     
            type     : "POST",
            url      : "{/literal}{$website}{literal}/user/add2cart.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) {
                if(data.isSuccess){
 					$("#dish_holder_"+sequence+ "_" + dish_id).html("").trigger('create');
					if(data.isEmpty){
						/*$('#frm_place_order').html("<div class=\"error\">{/literal}{$_lang.main.cart.empty}{literal}</div>");*/
						alert("{/literal}{$_lang.main.cart.empty}{literal}");
						window.location.reload();
					}
                }
            },
            error: function( objRequest ){
                     alert("Error occured" + objRequest.responseText);
            }
      });
		
	}
  }	
  calculateOrder();
}

function cancelDishOption(option_id,dish_id,sequence){
  if((option_id > 0) && (dish_id >0) && (sequence > -1)){ 
 	if(confirm("Are you sure to delete?")){ 
		info = {};
		info['cancelDishOption'] = option_id;
		info['dish_opt_dish'] = dish_id;
		info['sequence_num'] = sequence;
		info["{/literal}{$smarty.const.IS_AJAX}{literal}"]  = 1;
		$.ajax({     
            type     : "POST",
            url      : "{/literal}{$website}{literal}/user/add2cart.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) {
                if(data.isSuccess){
 					$("#dish_opt_holder_"+sequence+ "_" + option_id).html("").trigger('create');
					if(data.isEmpty){
						$('#frm_place_order').html("<div class=\"error\">{/literal}{$_lang.main.cart.empty}{literal}</div>");
					}
                }
            },
            error: function( objRequest ){
                     alert("Error occured" + objRequest.responseText);
            }
      }); 
	}
  }
  calculateOrder();
} 

 
/*
function sendOrderConfirmationCode(){ 
 var customerName = $('#order_customer_name').val();
 var isValid = true;
 	 if(IsNonEmpty(customerName) == false){
      	alert("Please provide Customer Phone.");
      	isValid =false; 
   }else{
      	if(isPhoneNumber(elemById("order_customer_name").value) == false){
    	  	alert("Phone number is not proper.");
      		isValid =false; 
      	}
   }
 if(isValid){ 
		info = {};
		info['customer_phone'] = $('#order_customer_name').val();  
		info['restaurant']  = '1';  
		info['action']  = 'SEND';
		$.ajax({     
            type     : "POST",
            url      : "{/literal}{$website}{literal}/ajax/orderConfirmationCode.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) {
            	  
	 								
                if(data){
                	 $('#popupOnlineOrderMsg').hide();
                	 $('#confirmation_timestamp').val(data.timestamp);
                	 $('#btnSendConfirmation,#blockCustomerPhone,#order_note_row').hide();
									 $('#btnPlaceOrder,#blockConfirmationCode,#blockConfirmationMsg').show();	 
                }
            },
            error: function( objRequest ){
            	alert("Error occured" + objRequest.responseText);
            }
      });  
  }  
} 

function verifyConfirmationCode(){ 
 var confirmCode = $('#confirmation_code').val();
 var isValid = true;
 if(IsNonEmpty(confirmCode) == false){
    	alert("Please provide Confirmation Code.");
    	isValid =false; 
 } 
 if(isValid){
		info = {};
		info['customer_phone'] = $('#order_customer_name').val();  
		info['restaurant']  = '1';  
		info['code']  = confirmCode;  
		info['timestamp']  = $('#confirmation_timestamp').val(); 
		info['action']  = 'ORD_VERIFY';
		$.ajax({     
            type     : "POST",
            url      : "{/literal}{$website}{literal}/ajax/orderConfirmationCode.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) { 
                if(data){ 
                	  $('#frm_place_order').submit();  
                }else{									    	
                	alert("Please provide Valid Confirmation Code.");  
                }
            },
            error: function( objRequest ){
            	alert("Error occured" + objRequest.responseText);
            }
      });
   }   
}*/ 

function updateDishOption(option_id,dish_id,sequence,qty){
  	if((option_id > 0) && (dish_id >0) && (sequence > -1) && (qty > 0)){  
		info = {};
		info['updateDishOption'] = option_id;
		info['dish_opt_dish'] = dish_id;
		info['sequence_num'] = sequence;
		info['qty'] = qty;
		info["{/literal}{$smarty.const.IS_AJAX}{literal}"]  = 1;
		$.ajax({     
            type     : "POST",
            url      : "{/literal}{$website}{literal}/user/add2cart.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) {
                if(data){ 
                }
            },
            error: function( objRequest ){
            	alert("Error occured" + objRequest.responseText);
            }
      }); 
	} 
	calculateOrder();
} 
 </script>
{/literal}
