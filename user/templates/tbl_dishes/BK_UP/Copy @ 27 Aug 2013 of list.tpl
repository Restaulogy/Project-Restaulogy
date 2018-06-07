{include file="header.tpl"}

<div class="wrapper">
<h1>{$tbl_dishesinfo.dish_name}</h1>
{if $error_msg}
	<center>{$error_msg}</center>
{/if}
{if $tbl_dishesinfo.submenu} 
	<table class="listTable">
	 <tr>
	 	<th class="bigListItem" style="width:20%;">Menu</th>
	 	<th class="bigListItem" style="width:40%;">SubMenu</th>
		<th class="bigListItem" style="width:20%;">Price</th>
		<th class="bigListItem" style="width:20%;">Action</th>
	 </tr>
	{foreach $tbl_dishesinfo.submenu as $sbmnu}
	 <tr>
	 	<td class="bigListItem" style="width:20%;">{$sbmnu.menu_name}</td> 
	 	<td class="bigListItem" style="width:60%;">{$sbmnu.submnu_name}</td> 
		<td class="bigListItem"  style="width:20%;">{$sbmnu.sbmnu_dish_price}</td> 
		<td class="actionListItem" style="width:20%;vertical-align:top;">
		{if $sbmnu.isActive eq 1}
		<a href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$sbmnu.sbmnu_dish_id}&{$smarty.const.ACTION_TITLE}={$smarty.const.ACTION_DEACTIVATE}&dish_id={$tbl_dishesinfo.dish_id}&sbmnu_dish_submenu={$sbmnu.sbmnu_dish_submenu}" class="deactiveIcon"></a>
		{else}
		<a href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$sbmnu.sbmnu_dish_id}&{$smarty.const.ACTION_TITLE}={$smarty.const.ACTION_ACTIVATE}&dish_id={$tbl_dishesinfo.dish_id}&sbmnu_dish_submenu={$sbmnu.sbmnu_dish_submenu}" class="activeIcon"></a>
		{/if}  
		<a href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$sbmnu.sbmnu_dish_id}&{$smarty.const.ACTION_TITLE}={$smarty.const.ACTION_DELETE}&dish_id={$tbl_dishesinfo.dish_id}" class="deleteIcon"></a>
		</td>
	 </tr>
	{/foreach}
	</table>
{/if}
</div> 
{include file="footercontent.tpl"}
{include file="tbl_dishes/js.tpl"} 
</body></html>