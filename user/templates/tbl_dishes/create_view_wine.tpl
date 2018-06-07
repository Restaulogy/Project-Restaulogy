<div class="field-row">
		<label for="dish_winery">{$_lang.tbl_dishes.label.dish_winery}</label>
		<input maxlength="250" id="dish_winery" type="text" value="{$smarty.post.dish_winery}" name="dish_winery"/>
		<div class="error" id="dish_winery_err"></div>
	</div>

	<div class="biz_hidden">
		<label for="dish_type_cat">{$_lang.tbl_dishes.label.dish_type_cat}</label>
		<input maxlength="6" id="dish_type_cat" type="text" value="{$smarty.post.dish_type_cat}" name="dish_type_cat" value="0"/>
		<div class="error" id="dish_type_cat_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_alcohol_percent">{$_lang.tbl_dishes.label.dish_alcohol_percent}</label>
		<input maxlength="5" id="dish_alcohol_percent" type="text" value="{$smarty.post.dish_alcohol_percent}" name="dish_alcohol_percent"/>
		<div class="error" id="dish_alcohol_percent_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_vintage">{$_lang.tbl_dishes.label.dish_vintage}</label>
		<select id="dish_vintage" name="dish_vintage" >
         <option value="0">Select one</option>
		 {foreach $vintage_list as $vintage}
		 	<option value="{$vintage@key}" {if $smarty.request.dish_vintage eq $vintage@key}selected="selected"{/if}>{$vintage}</option>
		 {/foreach}
		 </select>
		<div class="error" id="dish_vintage_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_varietal">{$_lang.tbl_dishes.label.dish_varietal}</label>
		<input maxlength="250" id="dish_varietal" type="text" value="{$smarty.post.dish_varietal}" name="dish_varietal"/>
		<div class="error" id="dish_varietal_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_region">{$_lang.tbl_dishes.label.dish_region}</label>
		<input maxlength="250" id="dish_region" type="text" value="{$smarty.post.dish_region}" name="dish_region"/>
		<div class="error" id="dish_region_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_country">{$_lang.tbl_dishes.label.dish_country}</label>
		<select id="dish_country" name="dish_country" >
         <option value="">Select one</option>
		 {foreach $country_list as $country}
		 	<option value="{$country@key}" {if $smarty.request.dish_country eq $country@key}selected="selected"{/if}>{$country}</option>
		 {/foreach}
		 </select>
		<div class="error" id="dish_country_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_bottle_price">{$_lang.tbl_dishes.label.dish_bottle_price}</label>
		<input id="dish_bottle_price" type="text" value="{$smarty.post.dish_bottle_price}" name="dish_bottle_price"/>
		<div class="error" id="dish_bottle_price_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_glass_price">{$_lang.tbl_dishes.label.dish_glass_price}</label>
		<input id="dish_glass_price" type="text" value="{$smarty.post.dish_glass_price}" name="dish_glass_price"/>
		<div class="error" id="dish_glass_price_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_winemaking">{$_lang.tbl_dishes.label.dish_winemaking}</label>
		<input maxlength="250" id="dish_winemaking" type="text" value="{$smarty.post.dish_winemaking}" name="dish_winemaking"/>
		<div class="error" id="dish_winemaking_err"></div>
	</div>

	<div class="field-row">
		<label for="dish_maturity">{$_lang.tbl_dishes.label.dish_maturity}</label>
		<input maxlength="25" id="dish_maturity" type="text" value="{$smarty.post.dish_maturity}" name="dish_maturity"/>
		<div class="error" id="dish_maturity_err"></div>
	</div>

    <!--
	<div class="field-row">
		<label for="dish_is_drink">{$_lang.tbl_dishes.label.dish_is_drink}</label>
		<input id="dish_is_drink" type="text" value="{$smarty.post.dish_is_drink}" name="dish_is_drink"/>
		<div class="error" id="dish_is_drink_err"></div>
	</div>
	-->
