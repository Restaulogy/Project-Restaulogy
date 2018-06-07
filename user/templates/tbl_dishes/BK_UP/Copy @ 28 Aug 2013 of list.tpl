{if $tbl_dishesinfo.submenu} 
<form name="frm_tbl_submenu_dishes" id="frm_tbl_submenu_dishes"  method="POST" action="{$website}/user/tbl_submenu_dishes.php" >
	<table class="biz_data_grid" style="margin-left: 5px;">
	 <tr>
	 <!--	<th style="width:20%;">Price</th>-->
	 	<th style="width:20%;" colspan="2">Menu</th>
	 	<th style="width:40%;">SubMenu</th>		
		<!--<th style="width:20%;">Action</th>-->
	 </tr>
	{foreach $tbl_dishesinfo.submenu as $sbmnu}
	 <tr class="{cycle values='odd,even'}">
	  <td style="width:2%;">
			<label for="sel_sbmnu_dish[{$sbmnu.sbmnu_dish_id}]" data-mini="true" style="width:23px;"><input type="checkbox" data-inline='true' data-mini='true' id="sel_sbmnu_dish[{$sbmnu.sbmnu_dish_id}]" name="sel_sbmnu_dish[{$sbmnu.sbmnu_dish_id}]" />&nbsp;</label>
   	</td>	
	 	<td style="width:20%;" onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_submenu={$sbmnu.sbmnu_dish_submenu}&mode=UPDATE&sbmnu_dish_id={$tbl_dishesinfo.dish_id}');">{$sbmnu.menu_name}</td> 
	 	<td style="width:40%;" onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_submenu={$sbmnu.sbmnu_dish_submenu}&mode=UPDATE&sbmnu_dish_id={$sbmnu.sbmnu_dish_id}');">{$sbmnu.submnu_name}</td> 
		<!--<td style="width:20%;" onclick="window.open('{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_submenu={$sbmnu.sbmnu_dish_submenu}&mode=UPDATE&sbmnu_dish_id={$sbmnu.sbmnu_dish_id}');">{$sbmnu.sbmnu_dish_price}</td> 
		<td style="width:20%;vertical-align:top;">
		{if $sbmnu.isActive eq 1}
				<a href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$sbmnu.sbmnu_dish_id}&{$smarty.const.ACTION_TITLE}={$smarty.const.ACTION_DEACTIVATE}&dish_id={$tbl_dishesinfo.dish_id}&sbmnu_dish_submenu={$sbmnu.sbmnu_dish_submenu}" class="deactiveIcon"></a>
		{else}
			<a href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$sbmnu.sbmnu_dish_id}&{$smarty.const.ACTION_TITLE}={$smarty.const.ACTION_ACTIVATE}&dish_id={$tbl_dishesinfo.dish_id}&sbmnu_dish_submenu={$sbmnu.sbmnu_dish_submenu}" class="activeIcon"></a>
		{/if}  
		<a href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$sbmnu.sbmnu_dish_id}&{$smarty.const.ACTION_TITLE}={$smarty.const.ACTION_DELETE}&dish_id={$tbl_dishesinfo.dish_id}" class="deleteIcon"></a>
		</td>
		-->
	 </tr>
	{/foreach}
	</table>
<input type="hidden" id="mnusbmnu_action" name="action" value=""/>
<input type="hidden" id="sbmnu_dish_submenu" name="sbmnu_dish_submenu" value=""/>


<div class="biz_center">
<input data-inline="true" data-icon="briefcase" type="button" id="sel_all_sbmnu_dish" name="sel_all_sbmnu_dish" value="{$_lang.main.toggle}" onclick="javascript:$('input[type=checkbox]').click();" />
<input data-inline="true" data-icon="recycle-full" type="button"  value="{$_lang.tbl_dishes.DELETE.BTN_LBL}" onclick="actiontbl_submenu_dishes('{$smarty.const.ACTION_DELETE}');" />
<input data-inline="true" data-icon="inactive" type="button" value="{$_lang.tbl_dishes.DEACTIVATE.BTN_LBL}" onclick="actiontbl_submenu_dishes('{$smarty.const.ACTION_DEACTIVATE}');" />
<input data-inline="true" data-icon="active" type="button" value="{$_lang.tbl_dishes.ACTIVATE.BTN_LBL}" onclick="actiontbl_submenu_dishes('{$smarty.const.ACTION_ACTIVATE}');" />
</div>	

</form>	
{/if}