<div id="popup_bogoDetail" style="width: 99%;border:1px solid #f3f3f3;margin-left:5px;display:{if ($smarty.session[$smarty.const.SES_CONDITIONS].bogo|@count) >0}none{else}block{/if};">
<!--<div data-role="popup" data-overlay-theme="g" data-dismissible="false" id="popup_bogoDetail" style="width: 270px;">--> 
<form action="{$website}/user/prom_cond_addition.php" method="POST" onsubmit="return validateBogoDetail();"> 
	<div data-role="header">
		<h1>Purchase Item Required</h1>
	</div>
	<div data-role="content" style="padding: 5px;">
			<div class="field-row">
					<label>{$_lang.tbl_prom_cond_details.label.prcndtl_bogo_qty}</label>
                    <select name="bogo_qty" id="bogo_qty" >
            			{for $foo=1 to 10}
            			    <option value="{$foo}" >{$foo}</option>
            			{/for}
            			{for $foo=1 to 10}
            			    <option value="{$foo}+" >{$foo}+</option>
            			{/for}
            		</select>
                    <!--
                    <input maxlength="4" name="bogo_qty" id="bogo_qty" type="text" value=""/>
                    -->
					<div id="bogo_qty_err" class="error"></div>
			</div>
		 	<div class="field-row">
					<label>{$_lang.tbl_prom_cond_details.label.prcndtl_bogo_sbmnu}</label>
						<select id="bogo_submenu" name="bogo_submenu" onchange="getSubMenudishes(this.value,'bogo_dish');">
						<option value="0">Select Menu</option>
						{foreach from=$lst_sub_mnu item=submnu}
							<option value="{$submnu.submnu_id}">{$submnu.menu_name}=>{$submnu.submnu_name}</option>
						{/foreach}
					 </select>
						<div id="bogo_submenu_err" class="error"></div>
					</div> 
		 	<div class="field-row">
					<label>{$_lang.tbl_prom_cond_details.label.prcndtl_bogo_sbmnu_dish}</label>
					<select id="bogo_dish" name="bogo_dish">
						 <option value="0">Select Dish</option>
					 </select>
						<div id="bogo_dish_err" class="error"></div>
					</div>
	</div> 
	<div class="biz_center">
	<input type="hidden" name="bogo_action" value="{$smarty.const.ACTION_SAVE}" id="bogo_action"/>
	 <input type="hidden" name="bogo_submenu_title" value=""  id="bogo_submenu_title"/>
	  <input type="hidden" name="bogo_id" value=""  id="bogo_id"/>
		<input type="hidden" name="bogo_dish_title" value=""  id="bogo_dish_title"/> 
		{html_input type="hidden" name="isUpdate" value=$isUpdate} 
		 
		{html_input type="hidden" name="bogo_key"}
		{html_input type="hidden" name="prom_condition" value="{$prom_condition}"}
        {*html_input type="hidden" name="prmcon_promotion" value="{$smarty.session[$smarty.const.SES_PROMOTION]}"*}
        {html_input type="hidden" name="prmcon_promotion" value="{$prmcon_promotion}"}

		<input data-inline="true" data-icon="save" type="submit" value="{$_lang.save_lbl}"/> 
	  
		<input type="button" value="{$_lang.close_lbl}" onclick="$('#popup_bogoDetail').hide();" data-inline="true" data-icon="delete" />
	</div>
</form>
</div>
