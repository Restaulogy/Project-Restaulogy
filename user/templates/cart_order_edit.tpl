<div data-role="popup" id="popupCart" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="max-width:300px;" class="ui-corner-all">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h6>{$_lang.tbl_orders.label.order_id|upper} - &nbsp; {$smarty.session[{$smarty.const.SES_ORDER_UDP}].order_info.order_id}</h6>
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">
		{if $smarty.session[$smarty.const.SES_ORDER_UDP]}
		<form id="frm_update_order" name="frm_update_order" action="{$website}/user/update_order.php?is_preview=1" method="POST" onsubmit="return validateOrder();"> 
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
     {foreach from=$smarty.session[$smarty.const.SES_ORDER_UDP] key=sequence_num item=ord_sequence}
        {if $sequence_num neq "order_info"}
		{foreach from=$ord_sequence[$smarty.const.SES_SUB_MENU_DISH] key=kydish_cart item=dish_cart name=nmdish_cart}
				{assign var="tot" value=0} 
				{math assign="tot" equation="x * y" x=$dish_cart.price y=$dish_cart.qty}
		 <tbody id="dish_holder_{$sequence_num}_{$kydish_cart}">
			<tr class="sub_main">
		        <td>{$sequence_num + 1}.</td>
				<td><a href="{$website}/user/tbl_submenu_dishes.php?is_preview=1&sbmnu_dish_id={$kydish_cart}&sequence_num={$sequence_num}">{$dish_cart.title}</a></td>
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
				<td><b onclick="cancelDishItem({$kydish_cart},{$sequence_num});" class="deleteIcon"></b><b class="editIcon" onclick="{literal}postForm({{/literal}'{$smarty.const.POPUP_WINDOW}'{literal}:'NewOrder'},'{/literal}{$website}/user/tbl_submenu_dishes.php?is_preview=1&sbmnu_dish_id={$kydish_cart}&sequence_num={$sequence_num}{literal}'){/literal};"></b></td>
			</tr>
			{if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE]}
			{foreach from=$dish_cart[$smarty.const.SES_DISH_OPTION_VALUE] key=optItmId item=optItm  name=nmoptItm}
				
		    	{assign var="tot" value=0}
		    	{math assign="tot" equation="x * y" x=$optItm.price y=$optItm.qty}
		    	<tr id="dish_opt_holder_{$sequence_num}_{$optItmId}"  class="{cycle values='odd,even'}">
		            <td>&nbsp;</td>
		    		<td>{$smarty.foreach.nmoptItm.index + 1}) {$optItm.title}</td>
		    		<td style="text-align:center;"><select data-mini="true" id="dish_opt_qty_{$sequence_num}_{$optItmId}" name="dish_opt_qty_{$sequence_num}_{$optItmId}" onchange="updateDishOption({$optItmId},{$kydish_cart},{$sequence_num},this.value);">
						{for $i=1 to 10}<option value="{$i}" {if $i eq $optItm.qty}selected="selected"{/if}>{$i}</option> {/for}
					</select>  </td>
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
				<td align="right" colspan="2" id="grndTotal">{$grd_tot|string_format:"%.2f"}</td>
			</tr>
		 </tfoot>
		</table>

		            <div class="field-row">
		                <p><label for="order_customer_id">Customer Email</label>
		                </p>
		                <p>
		                  <input type="text" name="order_customer_name" id="order_customer_name" value="{$smarty.session[{$smarty.const.SES_ORDER_UDP}].order_info.order_customer_name}"/>
		                </p>
		            </div>
		       
		{if $smarty.session.member_role_id eq $smarty.const.ROLE_WAITER OR $smarty.session.member_role_id eq $smarty.const.ROLE_MANAGER }
		     		 <div class="field-row">
		                <p><label for="order_table_id">Select Table</label>
		                </p>
		                <p>
		                  <select name="order_table_id" id="order_table_id">
		                    {if $emp_tables}
		            			{foreach $emp_tables as $value}
		            				<option value="{$value@key}" {if $smarty.session[$smarty.const.SES_ORDER_UDP].order_info.order_table_id eq "{$value@key}"} selected='selected'{/if} >{$value}</option>
		            			{/foreach}
		            		{/if}
		            	   </select>
		                </p>
		            </div>
		      
		{/if} 
		                <div class="field-row">
		                    <p><label>{$_lang.services_requests.label.srvc_reqst_special_note}:&nbsp;&nbsp;<a href="#" onclick="hide_show_sp_note();"><img id="frm_img_sp_note" src="{$website}/images/_graphics/show.gif"></a></label></p>
		                    <p><textarea style="display:none;" type="text" name="order_note" id="frm_order_note">{$smarty.session[{$smarty.const.SES_ORDER_UDP}].order_info.order_note}</textarea>
		                    <div class="error" id='order_note_err'></div>
		                    </p>
		                </div>
            <input type="hidden" name="order_id" id="order_id" value="{$smarty.session[{$smarty.const.SES_ORDER_UDP}].order_info.order_id}"/>
			<center><input data-role="button" data-inline="true" data-theme="a" type="submit" id="sub_place_order" value="{$_lang.main.order.update_title}" /></center>
		</form>
		{else}
			<div class="error">{$_lang.main.cart.empty}</div>
		{/if}
	</div>
</div>
{literal}
 <script type="text/javascript">
function hide_show_sp_note(){
    var state = document.getElementById("frm_order_note").style.display;
    if (state == 'block') {
        document.getElementById("frm_order_note").style.display = 'none';
        document.getElementById("frm_img_sp_note").src="{/literal}{$website}{literal}/images/_graphics/show.gif";
    }else{
        document.getElementById("frm_order_note").style.display = 'block';
        document.getElementById("frm_img_sp_note").src="{/literal}{$website}{literal}/images/_graphics/hide.gif";
    }
}

function validateOrder(){
   if(document.getElementById("order_customer_name").value == ""){
      alert("Please provide customer name");
      return false;
   }
   return true;
}

function calculateOrder(){
 var opt_val_id ="", optid = "", grTotal = 0, isDishItem = 0;
 var elem = document.getElementById('frm_update_order').elements;
 
  
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
            url      : "{/literal}{$website}{literal}/user/add2orderupdate.php",
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
            url      : "{/literal}{$website}{literal}/user/add2orderupdate.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) {
                if(data.isSuccess){
 					$("#dish_holder_"+sequence+ "_" + dish_id).html("").trigger('create');
					if(data.isEmpty){
						/*$('#frm_update_order').html("<div class=\"error\">{/literal}{$_lang.main.cart.empty}{literal}</div>");*/
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
            url      : "{/literal}{$website}{literal}/user/add2orderupdate.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) {
                if(data.isSuccess){
 					$("#dish_opt_holder_"+sequence+ "_" + option_id).html("").trigger('create');
					if(data.isEmpty){
						$('#frm_update_order').html("<div class=\"error\">{/literal}{$_lang.main.cart.empty}{literal}</div>");
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
            url      : "{/literal}{$website}{literal}/user/add2orderupdate.php",
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

