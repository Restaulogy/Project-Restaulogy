    <div class="clearfix"></div>
	<b>{$_lang.tbl_dishes.label.dish_winery}</b>:
	{assign var=editview_value value=$tbl_dishesinfo.dish_winery}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_winery}
	{assign var=editview_name value=dish_winery}
	{include file="control/editview.tpl"}
	<div class="clearfix"></div>

	<b>{$_lang.tbl_dishes.label.dish_alcohol_percent}</b>:
	<small style="text-align:justify;">
	{assign var=editview_value value=$tbl_dishesinfo.dish_alcohol_percent}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_alcohol_percent}
	{assign var=editview_name value=dish_alcohol_percent}
	{include file="control/editview.tpl"}
	</small>

	<div class="field-row">
		<label for="dish_vintage">{$_lang.tbl_dishes.label.dish_vintage}</label>
		<select id="dish_vintage" name="dish_vintage" onchange="$('#dish_vintage_btns').show();" >
         <option value="0">Select one</option>
		 {foreach $vintage_list as $vintage}
		 	<option value="{$vintage@key}" {if $tbl_dishesinfo.dish_vintage eq $vintage@key}selected="selected"{/if}>{$vintage}</option>
		 {/foreach}
		 </select>
		<div class="error" id="dish_vintage_err"></div>
		<div id="dish_vintage_btns" class='biz_center' style="display:none;">
    		<input type="submit" value="save" data-inline="true" data-mini="true" data-icon="save"/>
    		<input type="button" value="cancel" data-inline="true" data-mini="true" data-icon="delete" onclick="$('#dish_vintage_btns').hide();"/>
    	</div>
	</div>
	
	<b>{$_lang.tbl_dishes.label.dish_varietal}</b>:
	<small style="text-align:justify;">
	{assign var=editview_value value=$tbl_dishesinfo.dish_varietal}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_varietal}
	{assign var=editview_name value=dish_varietal}
	{include file="control/editview.tpl"}
	</small>
	
	<b>{$_lang.tbl_dishes.label.dish_region}</b>:
	<small style="text-align:justify;">
	{assign var=editview_value value=$tbl_dishesinfo.dish_region}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_region}
	{assign var=editview_name value=dish_region}
	{include file="control/editview.tpl"}
	</small>
	
	<div class="field-row">
		<label for="dish_country">{$_lang.tbl_dishes.label.dish_country}</label>
		<select id="dish_country" name="dish_country" onchange="$('#dish_country_btns').show();" >
         <option value="">Select one</option>
		 {foreach $country_list as $country}
		 	<option value="{$country@key}" {if $tbl_dishesinfo.dish_country eq $country@key}selected="selected"{/if}>{$country}</option>
		 {/foreach}
		 </select>
		<div class="error" id="dish_country_err"></div>
		<div id="dish_country_btns" class='biz_center' style="display:none;">
    		<input type="submit" value="save" data-inline="true" data-mini="true" data-icon="save"/>
    		<input type="button" value="cancel" data-inline="true" data-mini="true" data-icon="delete" onclick="$('#dish_country_btns').hide();"/>
    	</div>
	</div>
	
	<b>{$_lang.tbl_dishes.label.dish_bottle_price}</b>:
	<small style="text-align:justify;">
	{assign var=editview_value value=$tbl_dishesinfo.dish_bottle_price}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_bottle_price}
	{assign var=editview_name value=dish_bottle_price}
	{include file="control/editview.tpl"}
	</small>
	
	<b>{$_lang.tbl_dishes.label.dish_glass_price}</b>:
	<small style="text-align:justify;">
	{assign var=editview_value value=$tbl_dishesinfo.dish_glass_price}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_glass_price}
	{assign var=editview_name value=dish_glass_price}
	{include file="control/editview.tpl"}
	</small>
	
	<b>{$_lang.tbl_dishes.label.dish_winemaking}</b>:
	<small style="text-align:justify;">
	{assign var=editview_value value=$tbl_dishesinfo.dish_winemaking}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_winemaking}
	{assign var=editview_name value=dish_winemaking}
	{include file="control/editview.tpl"}
	</small>
	
	<b>{$_lang.tbl_dishes.label.dish_maturity}</b>:
	<small style="text-align:justify;">
	{assign var=editview_value value=$tbl_dishesinfo.dish_maturity}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_maturity}
	{assign var=editview_name value=dish_maturity}
	{include file="control/editview.tpl"}
	</small>
	
	<br/>
