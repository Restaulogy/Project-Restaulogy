<div data-role="popup" id="popupMenuSubMenu" data-theme="a" data-overlay-theme="g" data-dismissible="false" style="width: 270px;">
	<div data-role="header">
		<h1>Menu</h1>
	</div>
	<div data-role="content" style="padding:5px">
<form  action="{$website}/user/tbl_submenu_dishes.php" onsubmit="return validDishMnuSubMnu();">
		<div class="field-row">
				<label>Menu</label>
				<select name="sbmnu_dish_menu" id="sbmnu_dish_menu" onclick="getSubMenus(this.value,'submenu');">
				<option value="0">Select Menu</option>
				{foreach $menulist as $menu}
				<option value="{$menu@key}">{$menu}</option>
				{/foreach}	
				</select>
				<div class="error" id="menu_err"></div> 
		</div>
		<div class="field-row">
				<label>Sub-Menu</label>
				<select name="sbmnu_dish_submenu" id="sbmnu_dish_submenu"> 
				<option value="0">Select Sub-Menu</option>
				</select>
				<div class="error" id="submenu_err"></div> 
		</div>
		<div class="field-row">
			<table>
				<tr>
					<td><label>Price</label></td>
					<td>&nbsp;</td>
					<td><label>Display_order</label></td>
				</tr>
			</table>
				
				{html_input  name="sbmnu_dish_price" value=""} 
				<div class="error" id="price_err"></div> 
		</div>
		{html_input type="hidden" name="sbmnu_dish_id" value="0"}
		{html_input type="hidden" name="dish" value="{$tbl_dishesinfo.dish_id}"}  
		{html_input type="hidden" name="action" id="saveaction" value="{$smarty.const.ACTION_CREATE}"}
		<br />
		<div class="biz_center"> 
		 {jqmbutton theme="a" type="form_save"}
		 {jqmbutton theme="a" type="close" onclick="$('#popupMenuSubMenu').popup('close');"}
		</div>
	</form>	 
	</div> 
 
</div>
