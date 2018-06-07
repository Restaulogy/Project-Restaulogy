<div data-role="popup" id="popupNewOrder" data-theme="a" data-dismissible="false" style="max-width:300px;" class="ui-corner-all">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h6>{$_lang.main.order.title}</h6>
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">
	<form  id="view_dish_pricing" name="view_dish_pricing"  method="post" action="{$website}/user/add2orderupdate.php" onsubmit="return validAddToCart();">
	<div style="max-height:300px;overflow-y:auto;"> 
	 <table class="biz_data_grid"> 
			<tr><th class="bigListItem">Item</th>
			<th class="actionListItem">Prices</th>
			</tr> 
			{if $tbl_submenu_dishesinfo.sbmnu_dish_price gt 0}
			<tr> 
				 <td class="bigListItem">
				 <table style="width:100%;vertical-align:middle;">
					<tr>
						<td class="no_border" style="width:70%;vertical-align:middle;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_name}	
						</td>				
					 
						<td class="no_border" style="width:5%;">&nbsp;</td>
						<td class="no_border" style="width:20%;vertical-align:middle;">
						<select data-mini="true" id="submenu_dish_qty" name="submenu_dish_qty" onchange="calculate();">  
							{for $i=1 to 10}
								<option value="{$i}" {if $dish_cart.qty eq $i}selected="selected"{/if}>{$i}</option>
							{/for}
						</select>
						 
						<input type="hidden" name="submenu_dish_price" id="submenu_dish_price" value="{$tbl_submenu_dishesinfo.sbmnu_dish_price}"/> 							
						</td>
						<td class="no_border" style="width:5%;">&nbsp;</td> 
					</tr>
				</table> 	 
				 </td>
				 <td class="actionListItem itemPrice" style="vertical-align:middle;">${$tbl_submenu_dishesinfo.sbmnu_dish_price}</td>
			</tr>
			{else}
				<input type="hidden" name="submenu_dish_qty" value="0"/>
				<input type="hidden" name="submenu_dish_price" value="0"/>  
			{/if}
 		{assign var=currOptId value=0}
		{foreach from=$tbl_submenu_dishesinfo.optionsPrice item=optItm}
			 
			{if $currOptId neq $optItm.dish_opt_id} 
				<tr> 
				 <th colspan="2">{$optItm.dish_opt_name}</th>
				</tr>
				{assign var=currOptId value=$optItm.dish_opt_id}
			{/if} 
		 	<tr class="odd">
			   {if $optItm.dish_opt_type eq "text"}
			   <td class="bigListItem" colspan="2">{$optItm.dish_opt_val_value}</td>
			   {else}
				<td class="bigListItem" style="width:80%;vertical-align: middle !important;"> 
			 	<table style="width:100%;">
					<tr>
						<td class="no_border" style="width:70%;vertical-align: middle !important;"> 
						{if $optItm.dish_opt_type eq "checkbox"} 
				  
					{if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE][{$optItm.dish_opt_val_id}].qty gt 0}{/if}  
					<label for="check_{$optItm.dish_opt_val_id}">
					<input data-mini="true"  type="{$smarty.const.INPUT_CHECKBOX}" name="check_{$optItm.dish_opt_val_id}" value="{$optItm.dish_opt_val_id}" id="option_value_{$optItm.dish_opt_val_id}" onclick="enableQuantity(this.id);" onchange="enableQuantity(this.id);" {if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE][{$optItm.dish_opt_val_id}].qty  gt 0}checked="checked"{/if}/>  
				 {elseif $optItm.dish_opt_type eq "dropdown"}
				 	<label for="radio_{$optItm.dish_opt_val_id}">
				 	<input type="{$smarty.const.INPUT_DROPDOWN}" name="radio_{$optItm.dish_opt_id}" value="{$optItm.dish_opt_val_id}" data-mini="true" id="option_value_{$optItm.dish_opt_val_id}" onclick="enableQuantity(this.id);" {if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE][{$optItm.dish_opt_val_id}].qty  gt 0}checked="checked"{/if}/>  
				 {/if}
				 	{$optItm.dish_opt_val_value}</label>
						</td>
						<td class="no_border" style="width:5%;">&nbsp;</td>
						<td class="no_border" style="width:20%;vertical-align:top;">
						<div {if $optItm.sbmdopt_pr_price && $optItm.sbmdopt_pr_price gt 0}{else}class="biz_hidden"{/if}>
							<select name="qty_{$optItm.dish_opt_val_id}" id="qty_{$optItm.dish_opt_val_id}" {if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE][{$optItm.dish_opt_val_id}].qty  gt 0}{else}disabled="disabled"{/if} onchange="calculate();" data-mini="true"> 
					{for $i=1 to 10}
						<option value="{$i}" {if $optItm.sbmdopt_pr_price && $optItm.sbmdopt_pr_price gt 0}{if $dish_cart[$smarty.const.SES_DISH_OPTION_VALUE][{$optItm.dish_opt_val_id}].qty  eq $i}selected="selected"{/if}{else}{if $i eq 1}selected="selected"{/if}{/if}>{$i}</option> 
					{/for}
					</select>
						</div>
							
						</td>
						<td class="no_border" style="width:5%;">&nbsp;</td> 
					</tr>
				</table> 
				</td> 
				<td class="actionListItem itemPrice" style="width:20%;vertical-align: middle !important;"> 
					{if $optItm.sbmdopt_pr_price && $optItm.sbmdopt_pr_price gt 0}${$optItm.sbmdopt_pr_price}{else}No Charge{/if}
					<input id="price_{$optItm.dish_opt_val_id}" name="price_{$optItm.dish_opt_val_id}" id="price_{$optItm.dish_opt_val_id}" type="hidden" value="{if $optItm.sbmdopt_pr_price && $optItm.sbmdopt_pr_price gt 0}{$optItm.sbmdopt_pr_price}{else}0.00{/if}"/>
					<input id="title_{$optItm.dish_opt_val_id}" name="title_{$optItm.dish_opt_val_id}" type="hidden" value="{$optItm.dish_opt_val_value}"/>
				</td>
				{/if}
			</tr> 
		{/foreach} 
			 
	</table>
	</div>		
	  
    		<ul data-role="listview" style="display:block;margin:5px;">
				<li data-role="list-divider">{$_lang.main.cart.total}<span class="ui-li-count itemPrice" id="txt_grtotal">{if $tbl_submenu_dishesinfo.sbmnu_dish_price gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_price}{else}0{/if}</span></li>
			</ul> 
			
		<div class="field-row clearfix"> 
			 	<div class="error" id="add2cart_err"></div>
    		<input type="hidden" name="submenu_dish" value="{$tbl_submenu_dishesinfo.sbmnu_dish_id}"/>  
			<input type="hidden" name="{$smarty.const.SES_ORDER_SEQUENCE}" value="{$sequence_num}"/> 
    		<input name="submenu_dish_title" type="hidden" value="{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_name}"/>
    		<input type="submit"  class="fleft"  value="{if $dish_cart.isOrdered}{$_lang.UPDATE_TO_CART}{else}{$_lang.ADD_TO_CART}{/if}" name="add2cart"/>
    		{if $dish_cart.isOrdered}
    			<input  type="button" class="fright" onclick="cancelDishOrder({$tbl_submenu_dishesinfo.sbmnu_dish_id});" value="{$_lang.REMOVE_FROM_CART}"/>
    		{/if}
    	</div>
	  
	</form>
	</div>
</div>