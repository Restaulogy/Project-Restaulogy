{if $tbl_ordersinfo.order_details}

<form name="frm_update_order" id="frm_update_order" action="{$website}/user/update_order.php" method="POST">
	
<input type="hidden" name="order_id" value="{$tbl_ordersinfo.order_id}"/>
<input type="hidden" name="order_table_id" value="{$tbl_ordersinfo.order_table_id}"/>
<input type="hidden" name="order_customer_name" value="{$tbl_ordersinfo.order_customer_name}"/>
<table class="biz_data_grid" style="width:99%;">
	<tr>
		<th>&nbsp;</th>
    <th style="width:2%;">{$_lang.main.cart.srno}</th>
    <th style="width:40%;">{$_lang.main.cart.item}</th>
		<th style="width:2%;text-align:center;">{$_lang.main.cart.qty}</th>
		<th style="width:20%;text-align:right;">{$_lang.main.cart.rate}</th>
		<th style="width:20%;text-align:right;">{$_lang.main.cart.total}</th>
		<th style="width:5%;"></th>
	</tr>
	{assign var=grd_tot value=0}
	{assign var=tot value=0}
{foreach from=$tbl_ordersinfo.order_details item=dish_cart name=nmdish_cart}
		{assign var="tot" value=0} 
		{math assign="tot" equation="x * y" x=$dish_cart.ord_dtl_price y=$dish_cart.ord_dtl_quantity}
		{assign var=sequence_num value=$dish_cart.ord_dtl_id}
		{assign var=kydish_cart value=$dish_cart.ord_dtl_sbmenu_dish_id}
		<tbody id="dish_holder_{$sequence_num}_{$kydish_cart}">
	<tr class="sub_main">
				<td><label for="sel_dish[{$dish_cart.ord_dtl_id}]"><input type="checkbox" data-mini="true" data-iconpos="notext" id="sel_dish[{$dish_cart.ord_dtl_id}]" name="sel_dish[{$dish_cart.ord_dtl_id}]"/></label></td>
        <td>{$smarty.foreach.nmdish_cart.index + 1}.</td>
		<!--<td onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$dish_cart.ord_dtl_sbmenu_dish_id}')">{$dish_cart.title}</td>-->
		<td onclick="window.location.href='{$website}/user/tbl_orders.php?order_id={$tbl_ordersinfo.order_id}&ord_live_only={$ord_live_only}&mode=VIEW&sbmnu_dish_id={$dish_cart.ord_dtl_sbmenu_dish_id}&order_popup=1&sequence_num={$dish_cart.ord_dtl_id}';">{$dish_cart.title}</td>
		
		<td style="text-align:center;">
		<div {if $dish_cart.ord_dtl_price && $dish_cart.ord_dtl_price gt 0}{else}class="biz_hidden"{/if}>
		<select data-mini="true" id="dish_qty_{$sequence_num}_{$kydish_cart}" name="dish_qty[{$sequence_num}]" onchange="ord_updateDishItem({$tbl_ordersinfo.order_id},{$kydish_cart},{$sequence_num},this.value);">
						{for $i=1 to 10}<option value="{$i}" {if $i eq $dish_cart.ord_dtl_quantity}selected="selected"{/if}>{$i}</option> {/for}
					</select> 
			</div>
				</td>
		        <td style="text-align:right;">{$dish_cart.ord_dtl_price|string_format:"%.2f"}<input type="hidden" value="{$dish_cart.ord_dtl_price}"  id="dish_price_{$sequence_num}_{$kydish_cart}" name="dish_price_{$sequence_num}_{$kydish_cart}"/></td>
				<td style="text-align:right;font-weight:bold;" id="dish_total_{$sequence_num}_{$kydish_cart}">{$tot|string_format:"%.2f"}</td>
				<td>
					
				<!--<b onclick="ord_cancelDishItem({$tbl_ordersinfo.order_id},{$kydish_cart},{$sequence_num});" class="deleteIcon"></b>-->
				{if $dish_cart.ord_dtl_discount eq 0}
				 
					<b onclick="openDiscountForm('SUBMENUDISH',{$dish_cart.ord_dtl_id});" class="{if $dish_cart.ord_dtl_price && $dish_cart.ord_dtl_price gt 0}statsIcon{else}biz_hidden{/if}"></b>
				{/if}					
				</td>
				{math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
	</tr>
	{if $dish_cart["opt_val_details"]}
    	{foreach from=$dish_cart["opt_val_details"] item=optItm key=optItmId name=nmoptItm}
        	{assign var="tot" value=0}
        	{math assign="tot" equation="x * y" x=$optItm.ord_det_opt_price y=$optItm.ord_det_opt_qty}
				 
        	<tr id="dish_opt_holder_{$sequence_num}_{$optItmId}" class='{cycle values="odd,even"}'>
           		
								<td><label for="sel_dish_opt[{$optItmId}]"><input type="checkbox" data-mini="true" data-iconpos="notext" id="sel_dish_opt[{$optItmId}]" name="sel_dish_opt[{$optItmId}]"/></label></td>
								<td>&nbsp;</td>
        		<td onclick="window.location.href='{$website}/user/tbl_orders.php?order_id={$tbl_ordersinfo.order_id}&ord_live_only={$ord_live_only}&mode=VIEW&sbmnu_dish_id={$dish_cart.ord_dtl_sbmenu_dish_id}&order_popup=1&sequence_num={$dish_cart.ord_dtl_id}';">{$smarty.foreach.nmoptItm.index + 1}) {$optItm.opt_value}</td>
        		<td style="text-align:center;">
							<div {if $optItm.ord_det_opt_price && $optItm.ord_det_opt_price gt 0}{else}class="biz_hidden"{/if}>
						 
								<select data-mini="true" id="dish_opt_qty_{$sequence_num}_{$optItmId}" name="dish_opt_qty[{$optItmId}]" onchange="ord_updateDishOption({$tbl_ordersinfo.order_id},{$optItmId},{$kydish_cart},{$sequence_num},this.value);"> {for $i=1 to 10}<option value="{$i}" {if $i eq $optItm.ord_det_opt_qty}selected="selected"{/if}>{$i}</option> {/for}
							</select>
							</div>
						</td>
                <td style="text-align:right;">{$optItm.ord_det_opt_price|string_format:"%.2f"}<input type="hidden"  id="dish_opt_price_{$sequence_num}_{$optItmId}" name="dish_opt_price_{$sequence_num}_{$optItmId}" value="{$optItm.ord_det_opt_price}"/></td>
        		<td style="text-align:right;font-weight:bold;" id="dish_opt_total_{$sequence_num}_{$optItmId}">{$tot|string_format:"%.2f"}
        		</td>
						<td>
							
						<!--<b onclick="ord_cancelDishOption({$tbl_ordersinfo.order_id},{$optItmId},{$kydish_cart},{$sequence_num});" class="deleteIcon"></b>-->
						{if $optItm.ord_det_opt_discount eq 0}
							<b onclick="openDiscountForm('DISHOPTIONS',{$optItm.ord_det_opt_id});" class="{if $optItm.ord_det_opt_price && $optItm.ord_det_opt_price gt 0}statsIcon{else}biz_hidden{/if}"></b>
						{/if}
						</td>
						{math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
        	</tr>
    	{/foreach}
					
	{/if} 
	</tbody>
{/foreach}

	<tr class="customers">
 		<td colspan="5" style="text-align:right;font-weight: bold;"> 
				{$_lang.tbl_orders.label.order_tax}<input type="hidden" id="order_tax_{$tbl_ordersinfo.order_id}" value="{$tbl_ordersinfo.order_tax}"/> 
        </td>
		<td style="text-align:right;font-weight: bold;" id="tax_amt_{$tbl_ordersinfo.order_id}">
         
				{if $sub_id gt 0} 
					 {$tbl_ordersinfo.sub_orders[$sub_id].sub_tax_amt|string_format:"%.2f"}
				{else}
					{$tbl_ordersinfo.tax_amt|string_format:"%.2f"}
				{/if} 
        </td>
        <td></td>
 </tr>
 <tr class="customers">  
 		<td colspan="5" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_promotion_disc}<input type="hidden" id="order_promdisc_applied_{$tbl_ordersinfo.order_id}" value="{$tbl_ordersinfo.promdisc_applied}"/></td>
		<td style="text-align:right;font-weight: bold;" id="tax_amt_{$tbl_ordersinfo.order_id}"> {$tbl_ordersinfo.promdisc_applied|string_format:"%.2f"}</td><td></td> 		
 </tr>
 <tr class="customers">
 		<td colspan="5" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_tip}{if $sub_id gt 0}<input type="hidden" id="order_tip_{$tbl_ordersinfo.order_id}" value="{$tbl_ordersinfo.sub_orders[$sub_id].sub_tip}"/>{else}<input type="hidden" id="order_tip_{$tbl_ordersinfo.order_id}" value="{$tbl_ordersinfo.order_tip}"/>{/if}</td>
		<td style="text-align:right;font-weight: bold;" id="tip_amt_{$tbl_ordersinfo.order_id}">{if $sub_id gt 0}{$tbl_ordersinfo.sub_orders[$sub_id].sub_tip}{else}{$tbl_ordersinfo.order_tip|string_format:"%.2f"}{/if}</td><td></td>
 </tr>
 <tfoot>
 {if $sub_id gt 0}
 	{math assign="grd_tot" equation="x + y - z" x=$grd_tot y=$tbl_ordersinfo.sub_orders[$sub_id].sub_tax_amt z=$tbl_ordersinfo.promdisc_applied}
 {else}
  {math assign="grd_tot" equation="x + y - z" x=$grd_tot y=$tbl_ordersinfo.tax_amt z=$tbl_ordersinfo.promdisc_applied}
 {/if}	
	
	<tr>
		<th colspan="5" style="text-align:right;">{$_lang.main.cart.total}</th>
		<th style="text-align:right;font-weight: bold;" id="grndTotal_{$tbl_ordersinfo.order_id}">{$grd_tot|string_format:"%.2f"}</th>
		<th></th>
	</tr>
 </tfoot>
</table> 
	<input type="hidden" name="action" id="item_edit_action"/>
</form>

{/if}

{literal}
<script type="text/javascript">

function openDiscountForm(itm_type,itm_id){
	$('#itm_type_for_disc').val(itm_type);
	$('#itm_to_apply_disc').val(itm_id);
	$('#popup_lst_discounts').popup('open');
}

function applydiscount(){
	var info ={};
	info['pst_apply_discount'] = 1;
	info['pst_ord_detail_id'] = $('#itm_to_apply_disc').val();
	info['pst_itm_type_for_disc'] = $('#itm_type_for_disc').val();	
	info['pst_ord_detail_discount'] = $('#lst_discounts').val();		//alert(info['pst_ord_detail_id'] + ' = '+ info['pst_itm_type_for_disc'] + ' = '+ info['pst_ord_detail_discount']);
	if((info['pst_ord_detail_id']>0) && (info['pst_ord_detail_discount']>0) && (info['pst_itm_type_for_disc']!='')){
		postForm(info,"{/literal}{$website}{literal}/user/tbl_orders.php?order_id={/literal}{$tbl_ordersinfo.order_id}{literal}&mode=view");
	}else{
		alert("{/literal}{$_lang.tbl_discounts.not_empty_msg.dicount_item_empty}{literal}");
	} 	
}

function ord_calculateOrder(order_id){
 var opt_val_id ="", optid = "", grTotal = 0,promDisc=0, taxAmt=0, netTotal = 0, isDishItem = 0;
 
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
		 
			  netTotal = netTotal + ord_CalOrderPrice(itemId,seq_num,isDishItem);
				 
	  	}//..if  
	}//..if select one
 }//..for 
 
  taxAmt = netTotal * ($('#order_tax_' + order_id ).val()/100.00);
 
  grTotal = netTotal + taxAmt;
  $('#tax_amt_' + order_id).html(taxAmt.toFixed(2)).trigger("refresh");
  $("#grndTotal_" + order_id).html(grTotal.toFixed(2)).trigger("refresh");
 
}


function ord_CalOrderPrice(itemId,seq_num,isDishItem){
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

function ord_updateDishItem(order_id,dish_id,sequence,qty){ 
	ord_calculateOrder(order_id);
}

function ord_cancelDishItem(order_id,dish_id,sequence){ 
  ord_calculateOrder(order_id);
}

function ord_cancelDishOption(order_id,option_id,dish_id,sequence){ 
  ord_calculateOrder(order_id);
} 

function ord_updateDishOption(order_id,option_id,dish_id,sequence,qty){ 
	ord_calculateOrder(order_id);
}

 

function ord_deleteSelectedItems(){
		var sel_length = 0, all_dish_len = 0, sel_dish_len = 0;
		
	 $('input:checkbox').each(function () {
       if($(this).attr('name').indexOf('sel_dish[') > -1){
			 	all_dish_len++;
			 	 if(this.checked){
				 	sel_dish_len++;
				 }
			 }
			 if(this.checked){
			 	sel_length++; 
			 }
   });
	  
	//var sel_length = $("input:checked").length;
 
	if(sel_length > 0){ 
	if(sel_dish_len < all_dish_len){
		if(confirm("{/literal}{$_lang.main.select_ids.confirm_delete}{literal}")==true){	
			 $('#item_edit_action').val("{/literal}{$smarty.const.ACTION_DELETE}{literal}");
			$('#frm_update_order').submit(); 
		}
	}else{
		alert("Order must have at least one dish.");
	}
	}else{
		alert("{/literal}{$_lang.main.select_ids.empty}{literal}");
	} 
}
	
</script>
{/literal}

{if $sbmnu_dish_id > 0}
 {literal}
    <script type="text/javascript">
	   setTimeout(function(){$("#popupNewOrder").popup("open")},1000);
	</script>
 {/literal}
{/if}
