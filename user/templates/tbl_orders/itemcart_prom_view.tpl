{if $tbl_ordersinfo.applied_proms_details}
<div id='dv_lst_prom_app_detls' style="display: none;">

<table class="biz_data_grid" style="width:99%;">
	<tr>
        <th style="width:5%;">{$_lang.main.cart.srno}</th>
        <th style="width:30%;">{$_lang.main.cart.item}</th>
		<th style="width:30%;">Applied Promotion</th>
		<th style="width:5%;text-align:center;">{$_lang.main.cart.qty}</th>
		<th style="width:15%;text-align:right;">{$_lang.main.cart.rate}</th>
		<th style="width:15%;text-align:right;">{$_lang.main.cart.prom_discount}</th>
	</tr>
	{assign var=grd_tot value=0}
	{assign var=tot value=0}
{foreach $tbl_ordersinfo.applied_proms_details key=kydish_cart item=dish_cart name=nmdish_cart}
		{assign var="tot" value=$dish_cart.ordprom_discount_amt}
		{* math assign="tot" equation="x * y" x=$dish_cart.ord_dtl_price y=$dish_cart.ord_dtl_quantity *}
	<tr class="sub_main" onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$dish_cart.ord_dtl_sbmenu_dish_id}')">
	
        <td>{$smarty.foreach.nmdish_cart.index + 1}.</td>
		<td>{$dish_cart.title} </td>
		<td>{$dish_cart.prom_title}</td>
		<td style="text-align:center;">
    		<div {if $dish_cart.ord_dtl_price && $dish_cart.ord_dtl_price gt 0}{else}class="biz_hidden"{/if}>
    		{$dish_cart.ord_dtl_quantity}
    	 </div>
	   </td>
       <td style="text-align:right;">{$dish_cart.ord_dtl_price|string_format:"%.2f"}</td>
		<td style="text-align:right;font-weight:bold;">{$tot|string_format:"%.2f"} {math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
		</td>
	</tr>
	{/foreach}

 <tfoot> 
	<tr>
		<th colspan="5" style="text-align:right;">{$_lang.main.cart.total}</th>
		<th style="text-align:right;font-weight: bold;">{$grd_tot|string_format:"%.2f"}</th>
	</tr>
 </tfoot>
</table>

</div>
{/if}
