{if $smarty.session[$smarty.const.SES_CART][$smarty.const.SES_SUB_MENU_DISH]} 
<form name="view_dish_pricing"  method="post" action="{$website}/user/add2cart.php">
<table class="biz_data_grid">
	<tr>
        <th style="width:15px;">{$_lang.main.cart.srno}</th>
        <th style="width:180px;">{$_lang.main.cart.item}</th>
		<th style="width:25px;text-align:center;">{$_lang.main.cart.qty}</th>
		<th style="width:45px;text-align:right;">{$_lang.main.cart.rate}</th>
		<th style="width:60px;text-align:right;">{$_lang.main.cart.total}</th>
	</tr>
	{assign var=grd_tot value=0}
	{assign var=tot value=0}
{foreach from=$smarty.session[$smarty.const.SES_CART][$smarty.const.SES_SUB_MENU_DISH]   key=kydish_cart item=dish_cart name=nmdish_cart}
		{assign var="tot" value=0} 
		{math assign="tot" equation="x * y" x=$dish_cart.price y=$dish_cart.qty}
	<tr class="sub_main">
        <td>{$smarty.foreach.nmdish_cart.index + 1}.</td>
		<td>{$dish_cart.title}</td>
		<td style="text-align:center;">
            <select name="submenu_dish_qty_{$kydish_cart}" id="submenu_dish_qty_{$kydish_cart}" style="width:50px;font-size:10px;">
				{for $i=1 to 10}
					<option value="{$i}" {if $dish_cart.qty eq $i}selected="selected"{/if}>{$i}</option>
				{/for}
		    </select>
        </td>
        <td style="text-align:right;">{$dish_cart.price}</td>
		<td style="text-align:right;font-weight:bold;">{$tot} {math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
		</td>
	</tr>
	{if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE]}
	{foreach from=$dish_cart[$smarty.const.SES_DISH_OPTION_VALUE] key=kyoptItm item=optItm name=nmoptItm}
    	{assign var="tot" value=0}
    	{math assign="tot" equation="x * y" x=$optItm.price y=$optItm.qty}
    	<tr class="{cycle values='odd,even'}">
            <td>&nbsp;</td>
    		<td>{$smarty.foreach.nmoptItm.index + 1}) {$optItm.title}</td>
    		<td style="text-align:center;">
                <select name="qty_{$kyoptItm}" id="qty_{$kyoptItm}" {if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE][{$kyoptItm}].qty  gt 0}{else}disabled="disabled"{/if} class="fright" style="width:50px;font-size:10px;">
        		{for $i=1 to 10}
        			<option value="{$i}" {if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE][{$kyoptItm}].qty eq $i}selected="selected"{/if}>{$i}</option>
        		{/for}
        		</select>
            </td>
            <td style="text-align:right;">{$optItm.price}</td>
    		<td style="text-align:right;font-weight:bold;">{$tot} {math assign="grd_tot" equation="x + y" x=$tot y=$grd_tot}
    		</td>
    	</tr>
	{/foreach}
	{/if} 
{/foreach}
 <tfoot>
	<tr>
		<td colspan="4" style="text-align:right;">Total</td>
		<td align="right" >{$grd_tot}</td>
	</tr>
</tfoot> 
</table>
</form>
{/if}
