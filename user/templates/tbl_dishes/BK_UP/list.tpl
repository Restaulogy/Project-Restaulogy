{if $tbl_dishesinfo.submenu} 
	<table class="biz_data_grid" style="margin-left: 5px;">
	 <tr>
	 	<th style="width:20%;">Menu</th>
	 	<th style="width:40%;">SubMenu</th>
		<th style="width:20%;">Price</th>
		<th style="width:20%;">Action</th>
	 </tr>
	{foreach $tbl_dishesinfo.submenu as $sbmnu}
	 <tr class="{cycle values='odd,even'}">
	 	<td style="width:20%;" onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_submenu={$sbmnu.sbmnu_dish_id}&mode=UPDATE&sbmnu_dish_id={$tbl_dishesinfo.dish_id}');">{$sbmnu.menu_name}</td> 
	 	<td style="width:40%;" onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_submenu={$sbmnu.sbmnu_dish_id}&mode=UPDATE&sbmnu_dish_id={$tbl_dishesinfo.dish_id}');">{$sbmnu.submnu_name}</td> 
		<td style="width:20%;" onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_submenu={$sbmnu.sbmnu_dish_id}&mode=UPDATE&sbmnu_dish_id={$tbl_dishesinfo.dish_id}');">{$sbmnu.sbmnu_dish_price}</td> 
		<td style="width:20%;vertical-align:top;">
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