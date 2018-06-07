{assign var=header_title value="Receipt"}
{include file="dialog_header.tpl"}
<link href="receipt.css" type="text/css"/>
<link rel="stylesheet" href="{$website}/css/receipt.css" />
<div class="wrapper">
<div class="biz_center" style="font-family:Arial;font-size:12px;font-weight: bold;">{$webtitle} - Receipt</div> 
{if $all_ses_ord_dtl.order_details}
<table class="print_receipt" id="popupReceipt" style="width:99%;">
 {if $all_ses_ord_dtl.customer_session}
	<tr>
		<td style="text-align:left;">{$tbl_ordersinfo.dine_table}</td>
		<td style="text-align:center;">{$tbl_ordersinfo.order_session_id}</td>
		<td style="text-align:right;">#Gst {$all_ses_ord_dtl.customer_session.tbl_cust_sess_party_size}</td>
	</tr>
 {/if} 
	<tr>
		<td colspan="3" class="no_hover biz_center">{$tbl_ordersinfo.order_created_on|date_format:$smarty.const.HTML5_DATETIME_FORMAT}</td>
	</tr>
	<!--<tr>
		<th style="width:2%;text-align:center;">{$_lang.main.cart.qty}</th>
    <th style="width:40%;">{$_lang.main.cart.item}</th>  
		<th style="width:20%;text-align:right;">{$_lang.main.cart.total}</th>
	</tr>-->
	{assign var=grd_tot value=0}
	{assign var=tot value=0}
{foreach $all_ses_ord_dtl.order_details as $ord_dtl}
 
<tr>
		<th colspan="3" style="text-align: center !important;">{$all_ses_ord_dtl.amounts.customers[$ord_dtl@key]}</th>
</tr>
{assign var='sub_tot' value=0}
{foreach from=$ord_dtl key=kydish_cart item=dish_cart name=nmdish_cart}

		{math assign="tot" equation="x * y" x=$dish_cart.ord_dtl_price y=$dish_cart.ord_dtl_quantity}
	<tr class="sub_main"> 
		<td style="text-align:center;" class="no_hover"> 
		{if $dish_cart.ord_dtl_price && $dish_cart.ord_dtl_price gt 0}{$dish_cart.ord_dtl_quantity}{/if}</td>
		<td class="no_hover">{$dish_cart.title}</td>  
		<td class="no_hover" style="text-align:right;font-weight:bold;">{$tot|string_format:"%.2f"} 
			  {math assign="sub_tot" equation="x + y" x=$tot y=$sub_tot}
			
		</td>
	</tr>
	{if $dish_cart["opt_val_details"]}
    	{foreach from=$dish_cart["opt_val_details"] item=optItm name=nmoptItm}
        	{assign var="tot" value=0}
        	{math assign="tot" equation="x * y" x=$optItm.ord_det_opt_price y=$optItm.ord_det_opt_qty}
					
        	<tr class="{cycle values='odd,even'}">
						<td class="no_hover biz_center" >
						{if $optItm.ord_det_opt_price && $optItm.ord_det_opt_price gt 0}{$optItm.ord_det_opt_qty}{/if}</td>
        		<td class="no_hover">&nbsp;&nbsp;{$optItm.opt_value}</td> 
        		<td class="no_hover" style="text-align:right;font-weight:bold;">{$tot|string_format:"%.2f"} {math assign="sub_tot" equation="x + y" x=$tot y=$sub_tot}								
        		</td>
        	</tr>
    	{/foreach}
					
	{/if}

{/foreach}
    	<tr class="customers">
							<td class="no_hover" colspan="2" style="text-align:right;font-weight: bold;">SubTotal</td>
		<td class="no_hover" style="text-align:right;font-weight: bold;">{$sub_tot|string_format:"%.2f"} 
		{math assign="grd_tot" equation="x + y" x=$sub_tot y=$grd_tot}</td>
					</tr>
						
{/foreach}
	<tr class="customers">
 		<td class="no_hover" colspan="2" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_tax}</td>
		<td class="no_hover" style="text-align:right;font-weight: bold;"> {$all_ses_ord_dtl.amounts.tax_amt|string_format:"%.2f"} </td>
	</tr>
	
	<tr class="customers">
 		<td class="no_hover" colspan="2" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_promotion_disc}</td>
		<td class="no_hover" style="text-align:right;font-weight: bold;"> {$all_ses_ord_dtl.amounts.prom_discnt_amt|string_format:"%.2f"} </td>
	</tr>
	
	<tr class="customers"> 
		<td colspan="2" class="no_hover" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_tip}</td>
		<td class="no_hover" style="text-align:right;font-weight: bold;"> {$all_ses_ord_dtl.amounts.tip_amt|string_format:"%.2f"} </td>
 </tr>
 <tr class="customers"> 
		<td colspan="2" class="no_hover" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_misc_charge}</td>
		<td class="no_hover" style="text-align:right;font-weight: bold;"> {$all_ses_ord_dtl.amounts.misc_charge|string_format:"%.2f"} </td>
 </tr>
 <tfoot>
   {math assign="grd_tot" equation="x + y + z + u - w " x=$grd_tot y=$all_ses_ord_dtl.amounts.tax_amt z=$all_ses_ord_dtl.amounts.tip_amt|string_format:"%.2f" u=$all_ses_ord_dtl.amounts.misc_charge w=$all_ses_ord_dtl.amounts.prom_discnt_amt|string_format:"%.2f"}
	<tr>
		<th colspan="2" style="text-align:right;">{$_lang.main.cart.total}</th>
		<th style="text-align:right;font-weight: bold;">{$grd_tot|string_format:"%.2f"}
		</th>
	</tr>
 </tfoot>
</table>
 <div class="error"> <span style="color:black;">Reward Link: </span> {$tbl_ordersinfo.ord_reward_pts_lnk} <br></div>
{/if} 
	<div class="biz_center no-print">  
		
		{jqmbutton value="Print" icon="search" onclick="window.print();"}
	 {if $smarty.request.is_new_window eq 1}
	 		<a data-inline="true" data-icon="delete" data-role="button" href="#" onclick="self.close();">Close</a>
	 {else}	
		<a data-inline="true" data-icon="delete" data-role="button" href="{$website}/user/tbl_orders.php?order_id={$smarty.request.order_id}&{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}">Close</a>
		{/if} 	
		{if $isCustomer}
										<br>OR</br>
		<form>
			<label><input type="checkbox" value="1" data-inline="true"  onchange="$('#order_receipt_by_mail').toggle();" />&nbsp;&nbsp;Send by email</label>
		</form>
		{/if}
		
	</div>	 
</div>
{if $isCustomer}
<br/>
<div id="order_receipt_by_mail" class="no-print" style="display: none;">
 	{include file="tbl_crm/subscribe.tpl"}
</div>  
{/if}
<form id="frmOrderReceipt" action="{$website}/user/tbl_orders.php?{$smarty.const.MODE_TITLE}={$smarty.const.MODE_VIEW}&order_id={$tbl_ordersinfo.order_id}" method="post"> 
	{html_input type="hidden" name="is_pay_now" value="{$is_pay_now}"}
	{html_input type="hidden" name="order_tip" value="{$smarty.request.order_tip}"}
	{html_input type="hidden" name="payment_choice" value="{$smarty.request.payment_choice}"}
</form>
{include file="dialog_footer.tpl"}
