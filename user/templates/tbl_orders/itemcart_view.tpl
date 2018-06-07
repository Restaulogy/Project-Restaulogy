{if $tbl_ordersinfo.order_details}

<table class="biz_data_grid" style="width:99%;">
	<tr>
        <th style="width:2%;">{$_lang.main.cart.srno}</th>
        <th style="width:40%;">{$_lang.main.cart.item}</th>
		<th style="width:2%;text-align:center;">{$_lang.main.cart.qty}</th>
		<th style="width:20%;text-align:right;">{$_lang.main.cart.rate}</th>
		<th style="width:20%;text-align:right;">{$_lang.main.cart.total}</th>
	</tr>
	{assign var=grd_tot value=0}
	{assign var=tot value=0}
{foreach $tbl_ordersinfo.order_details key=kydish_cart item=dish_cart name=nmdish_cart}
		{assign var="tot" value=0} 
		{math assign="tot" equation="x * y" x=$dish_cart.ord_dtl_price y=$dish_cart.ord_dtl_quantity}
	<tr class="sub_main" onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$dish_cart.ord_dtl_sbmenu_dish_id}')">
	
        <td>{$smarty.foreach.nmdish_cart.index + 1}.</td>
		<td>{$dish_cart.title}</td>
		<td style="text-align:center;">
		<div {if $dish_cart.ord_dtl_price && $dish_cart.ord_dtl_price gt 0}{else}class="biz_hidden"{/if}>
		{$dish_cart.ord_dtl_quantity}
	 </div>
	 </td>
        <td style="text-align:right;">{$dish_cart.ord_dtl_price|string_format:"%.2f"}</td>
		<td style="text-align:right;font-weight:bold;">{$tot|string_format:"%.2f"} {math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
		</td>
	</tr>
	{if $dish_cart["opt_val_details"]}
    	{foreach from=$dish_cart["opt_val_details"] item=optItm name=nmoptItm}
        	{assign var="tot" value=0}
        	{math assign="tot" equation="x * y" x=$optItm.ord_det_opt_price y=$optItm.ord_det_opt_qty}
        	<tr class="{cycle values='odd,even'}">
                <td>&nbsp;</td>
        		<td>{$smarty.foreach.nmoptItm.index + 1}) {$optItm.opt_value}</td>
        		<td style="text-align:center;">
							<div {if $optItm.ord_det_opt_price && $optItm.ord_det_opt_price gt 0}{else}class="biz_hidden"{/if}> 
								{$optItm.ord_det_opt_qty}
							</div> 
						</td>
                <td style="text-align:right;">{$optItm.ord_det_opt_price|string_format:"%.2f"}</td>
        		<td style="text-align:right;font-weight:bold;">{$tot|string_format:"%.2f"} {math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
        		</td>
        	</tr>
    	{/foreach}
	{/if} 
{/foreach}
	<tr class="customers">
 		<td colspan="4" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_tax}</td>
		<td style="text-align:right;font-weight: bold;">{if $sub_id gt 0}{$tbl_ordersinfo.sub_orders[$sub_id].sub_tax_amt|string_format:"%.2f"}{else}{$tbl_ordersinfo.tax_amt|string_format:"%.2f"}{/if}  </td>
 </tr>
 <tr class="customers">
 		<td colspan="3">{$tbl_ordersinfo.order_misc_desc}</td>
 		<td style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_misc_charge}</td>
		<td style="text-align:right;font-weight: bold;">
		{if $sub_id gt 0}{$tbl_ordersinfo.sub_orders[$sub_id].sub_misc_charge|string_format:"%.2f"}{else}{$tbl_ordersinfo.order_misc_charge|string_format:"%.2f"}{/if} 
		</td>
 </tr>
 <tr class="customers">
 		<td colspan="4" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_promotion_disc}(-)</td>
		<td style="text-align:right;font-weight: bold;"> {if $sub_id gt 0}{$tbl_ordersinfo.sub_orders[$sub_id].sub_prom_disc|string_format:"%.2f"}{else}{$tbl_ordersinfo.promdisc_applied|string_format:"%.2f"}{/if} </td>
 </tr>
 <tr class="customers">
 		<td colspan="4" style="text-align:right;font-weight: bold;">{$_lang.tbl_orders.label.order_tip}</td>
		<td style="text-align:right;font-weight: bold;"> {if $sub_id gt 0}{$tbl_ordersinfo.sub_orders[$sub_id].sub_tip|string_format:"%.2f"}{else}{$tbl_ordersinfo.order_tip|string_format:"%.2f"}{/if} </td>
 </tr>
 <tfoot> 
  {if $sub_id gt 0}
		{math assign="grd_tot" equation="x + y + z + u -w" x=$grd_tot y=$tbl_ordersinfo.sub_orders[$sub_id].sub_tax_amt z=$tbl_ordersinfo.sub_orders[$sub_id].sub_tip u=$tbl_ordersinfo.sub_orders[$sub_id].sub_misc_charge v=$tbl_ordersinfo.sub_orders[$sub_id].sub_tip w=$tbl_ordersinfo.sub_orders[$sub_id].sub_prom_disc}
 
	{else}
		{math assign="grd_tot" equation="x + y + z + u -w" x=$grd_tot y=$tbl_ordersinfo.tax_amt u=$tbl_ordersinfo.order_misc_charge  z=$tbl_ordersinfo.order_tip  w=$tbl_ordersinfo.promdisc_applied}
	{/if}
   
	<tr>
		<th colspan="4" style="text-align:right;font-weight:bold;font-size:14px;">{$_lang.main.cart.total}</th>
		<th style="text-align:right;font-weight: bold;font-size:14px;">{$grd_tot|string_format:"%.2f"}</th>
	</tr>
 </tfoot>
</table>
{/if}
