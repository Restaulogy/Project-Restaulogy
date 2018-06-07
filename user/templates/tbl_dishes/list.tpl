
<!-- <form>   -->
{if $tbl_dishesinfo.submenu} 
	<table class="biz_data_grid" style="margin-left: 5px;">
	 <tr>
	  <th style="width:10px;"></th>
	 	<th style="width:20%;">Menu</th>
	 	<th style="width:40%;">SubMenu</th>
		<th style="width:20%;">Price</th>
		<th style="width:20%;">Action</th>
	 </tr>
	{assign var="cnt" value=0}
	{foreach $tbl_dishesinfo.submenu as $sbmnu}
	 
	 <tr class="{cycle values='odd,even'}">
	 	
		<td class="no_hover" style="width:10px;">
			<label for="sbmnudish[]"><input data-theme="a" data-mini="true" type="radio" name="sbmnudish[]" id="sbmnudish_{$sbmnu.sbmnu_dish_id}" value="{$sbmnu.sbmnu_dish_id}" {if $cnt eq 0}checked="checked"{/if}/>&nbsp;</label> 
		</td>
	 
	 	<td class="no_hover" style="width:20%;">
		  
		<a href="#" onclick="window.open('{$website}/user/tbl_menu.php?menu_id={$sbmnu.menu_id}&mode=UPDATE');">{$sbmnu.menu_name}</a></td> 
	 	<td class="no_hover" style="width:40%;"><a href="#" onclick="window.open('{$website}/user/tbl_sub_menu.php?submnu_id={$sbmnu.sbmnu_dish_submenu}&submnu_menu={$sbmnu.menu_id}&mode=UPDATE');">{$sbmnu.submnu_name}</a></td> 
		<td class="no_hover" style="width:20%;">{$sbmnu.sbmnu_dish_price}</td> 
		<td class="no_hover" style="width:20%;vertical-align:top;">
	 {html_input type="hidden" name="menu_{$sbmnu.sbmnu_dish_id}" id="menu_{$sbmnu.sbmnu_dish_id}" value="{$sbmnu.menu_id}"}
	 {html_input type="hidden" name="submenu_{$sbmnu.sbmnu_dish_id}" id="submenu_{$sbmnu.sbmnu_dish_id}" value="{$sbmnu.sbmnu_dish_submenu}"}
	 {html_input type="hidden" id="price_{$sbmnu.sbmnu_dish_id}" name="price_{$sbmnu.sbmnu_dish_id}" value="{$sbmnu.sbmnu_dish_price}"}
	 {html_input type="hidden" id="order_{$sbmnu.sbmnu_dish_id}" name="order_{$sbmnu.sbmnu_dish_id}" value="{$sbmnu.sbmnu_dish_display_order}"} 
	 <textarea class="biz_hidden" name="desc_{$sbmnu.sbmnu_dish_id}" id="desc_{$sbmnu.sbmnu_dish_id}">
	 	{$sbmnu.sbmnu_dish_desc}
	 </textarea>
	  
		 
		{if $sbmnu.isActive eq 1}
				<a href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$sbmnu.sbmnu_dish_id}&{$smarty.const.ACTION_TITLE}={$smarty.const.ACTION_DEACTIVATE}&dish_id={$tbl_dishesinfo.dish_id}&sbmnu_dish_submenu={$sbmnu.sbmnu_dish_submenu}&is_redirection=tbl_dishes" class="activeIcon"></a>
		{else}
			<a href="{$website}/user/tbl_submenu_dishes.php?sbmnu_dish_id={$sbmnu.sbmnu_dish_id}&{$smarty.const.ACTION_TITLE}={$smarty.const.ACTION_ACTIVATE}&dish_id={$tbl_dishesinfo.dish_id}&sbmnu_dish_submenu={$sbmnu.sbmnu_dish_submenu}&is_redirection=tbl_dishes" class="deactiveIcon"></a>
		{/if}  
		
		</td>
	 </tr>
	 {math assign=cnt equation="x+1" x=$cnt}
	{/foreach}
	</table>
{/if}

<!--</form> -->
<div class="biz_center">
	 
	{jqmbutton icon="edit" value="{$_lang.update_lbl}" onclick="fillsubmenu_dishes();" theme="a"}
	{jqmbutton type="delete" onclick="deleteSubMnuDish({$tbl_dishesinfo.dish_id});" theme="a"}
	{jqmbutton onclick="$('#popupAddSubMenu').popup('open');" value="Add Menu-Submenu" icon="add-item" theme="a"}
</div>
 
