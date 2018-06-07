{if $tbl_ordersinfo.order_details}
<table class="biz_data_grid" style="width:99%;">
	<tr>
        <th style="width:2%;">{$_lang.main.cart.srno}</th>
        <th style="width:50%;">{$_lang.main.cart.item}</th>
		<th style="width:2%;text-align:center;">{$_lang.main.cart.qty}</th>
		<th style="width:23%;text-align:right;">{$_lang.main.cart.rate}</th>
		<th style="width:23%;text-align:right;">{$_lang.main.cart.total}</th>
	</tr>
	{assign var=grd_tot value=0}
	{assign var=tot value=0}
{foreach $tbl_ordersinfo.order_details key=kydish_cart item=dish_cart name=nmdish_cart}
		{assign var="tot" value=0} 
		{math assign="tot" equation="x * y" x=$dish_cart.ord_dtl_price y=$dish_cart.ord_dtl_quantity}
	<tr class="sub_main" onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$dish_cart.ord_dtl_sbmenu_dish_id}')">
	
        <td>{$smarty.foreach.nmdish_cart.index + 1}.</td>
		<td>{$dish_cart.title}</td>
		<td style="text-align:center;">{$dish_cart.ord_dtl_quantity}</td>
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
        		<td style="text-align:center;">{$optItm.ord_det_opt_qty}</td>
                <td style="text-align:right;">{$optItm.ord_det_opt_price|string_format:"%.2f"}</td>
        		<td style="text-align:right;font-weight:bold;">{$tot|string_format:"%.2f"} {math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
        		</td>
        	</tr>
    	{/foreach}
	{/if} 
{/foreach}
	<tr class="customers">
 		<td colspan="4" style="text-align:right;font-weight: bold;">  Tax Amount </td>
		<td style="text-align:right;font-weight: bold;"> {$tbl_ordersinfo.tax_amt|string_format:"%.2f"} </td>
 </tr>
 <tfoot>
 
  {math assign="grd_tot" equation="x + y" x=$grd_tot y=$tbl_ordersinfo.tax_amt}
	<tr>
		<td colspan="4" style="text-align:right;">{$_lang.main.cart.total|string_format:"%.2f"}</td>
		<td align="right" >{$grd_tot|string_format:"%.2f"}</td>
	</tr>
 </tfoot>
</table>
{/if}
