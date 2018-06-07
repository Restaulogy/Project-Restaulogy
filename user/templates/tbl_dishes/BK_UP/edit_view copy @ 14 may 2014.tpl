 <div class="listTable biz_no_border" style="background:transparent !important;" >
   <div class="biz_center">
	<a href="{$website}/uploads/dish/{$tbl_dishesinfo.dish_img}" target="_blank"><img  src="{$website}/uploads/dish/{$tbl_dishesinfo.dish_img}" style="width:250px;height:200px;"/></a> 
	<!--
    <div id="dish_img_view" style="font-size:12px;">		
	<input type="button" value="Edit" onclick="$('#dish_img_edit').show();$('#dish_img_view').hide();" data-icon="edit" data-inline="true" data-mini="true"/> 
	</div>
    -->
	
	<div id="dish_img_edit" style="text-align: left;">
  	     <input type="file" name="dish_img" id="dish_img" value="{$tbl_dishesinfo.dish_img}" onchange="$('#dish_img_btns').show();"/>
		<div class="info">{$_lang.tbl_dishes.image_size_info}</div>
		<div id="dish_img_err" class="error"></div>

        <div id="dish_img_btns" class='biz_center' style="display:none;">
        		<input type="button" onclick="validateImage();" value="save" data-icon="save" data-inline="true" data-mini="true"/>
        		<input type="button" value="cancel" onclick="$('#dish_img_btns').hide();" data-icon="delete" data-inline="true" data-mini="true"/>
        </div>
    </div>
  </div>
  
	<div class="clearfix"></div> 
	<b>Dish Name</b>:
	{assign var=editview_value value=$tbl_dishesinfo.dish_name}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_name}
	{assign var=editview_name value=dish_name}
	{include file="control/editview.tpl"} 
	<div class="clearfix"></div> 
	
	<b>Description</b>:	
	<small style="text-align:justify;">		
	{assign var=editview_value value=$tbl_dishesinfo.dish_notes}
	{assign var=editInline value=0}
	{assign var=editview_id value=dish_notes}
	{assign var=editview_name value=dish_notes}
	{include file="control/editview.tpl"} 
	</small> 
	
	<b>{$_lang.tbl_dishes.label.dish_food_wine_pair}</b>
	<small style="text-align:justify;">
	 {assign var=editview_value value=$tbl_dishesinfo.dish_food_wine_pair}
{assign var=editview_id value=dish_food_wine_pair}
{assign var=editview_name value=dish_food_wine_pair}
	{include file="control/editview.tpl"}
	

	</small>
	
	<div class="field-row">
		<label for="dish_food_wine_pair">{$_lang.tbl_dishes.label.dish_food_wine_pair}</label>
        <select id="dish_food_wine_pair" name="dish_food_wine_pair[]" multiple="multiple" data-native-menu="false" onchange="$('#dish_food_wine_pair_btns').show();" >
             <option value="" data-placeholder="true">Select dishes </option>
    		 {foreach $lst_dishes as $_eachdish}
    		 	<option value="{$_eachdish@key}" {if $tbl_dishesinfo.dish_food_wine_pair &&  in_array($_eachdish@key,$tbl_dishesinfo.dish_food_wine_pair)}selected="selected"{/if}>{$_eachdish}</option>
    		 {/foreach}
		 </select>
		 
        <div class="error" id="dish_food_wine_pair_err"></div>

		<div id="dish_food_wine_pair_btns" class='biz_center' style="display:none;">
    		<input type="submit" value="save" data-inline="true" data-mini="true" data-icon="save"/>
    		<input type="button" value="cancel" data-inline="true" data-mini="true" data-icon="delete" onclick="$('#dish_food_wine_pair_btns').hide();"/>
    	</div>
	</div>
	
	<div class="field-row">
		<label for="dish_attributes">{$_lang.tbl_dishes.label.dish_attributes}</label>

        <select id="dish_attributes" name="dish_attributes[]" multiple="multiple" data-native-menu="false" onchange="$('#dish_attributes_btns').show();" >
         <option value="" data-placeholder="true">Select one</option>
		 {foreach $lst_dish_attribs as $attrib}
		 	<option value="{$attrib@key}" {if $tbl_dishesinfo.dish_attributes &&  in_array($attrib@key,$tbl_dishesinfo.dish_attributes_arr) }selected="selected"{/if}>{$attrib}</option>
		 {/foreach}
		 </select>

		<div class="error" id="dish_attributes_err"></div>
		
		<div id="dish_attributes_btns" class='biz_center' style="display:none;">
    		<input type="submit" value="save" data-inline="true" data-mini="true" data-icon="save"/>
    		<input type="button" value="cancel" data-inline="true" data-mini="true" data-icon="delete" onclick="$('#dish_attributes_btns').hide();"/>
    	</div>
	</div>
	
</div> 

	<div class="clearfix"></div>

    <fieldset data-role="controlgroup" data-type="horizontal" style="width:100%px;border-bottom:solid white 1px;" >
	<legend>Choose a type:</legend>
     	<label for="dish_is_drink_1"><input type="radio" name="dish_is_drink" id="dish_is_drink_1" value="0" {if $tbl_dishesinfo.dish_is_drink eq 0}checked="checked"{/if} onclick='show_tab("dish");' />
     	{$_lang.tbl_dishes.regular_dish}</label>
        <label for="dish_is_drink_2"><input type="radio" name="dish_is_drink" id="dish_is_drink_2" value="1" {if $tbl_dishesinfo.dish_is_drink eq 1}checked="checked"{/if}  onclick='show_tab("wine");' />
     	{$_lang.tbl_dishes.wine}</label>
    </fieldset>
    
    <!-- REGULAR DISH -->
    <div id='reg_dish' {if $tbl_dishesinfo.dish_is_drink eq 1}style='display:none;'{/if}>
       {include file="tbl_dishes/edit_view_dish.tpl"}
    </div>
    <!-- REGULAR DISH END -->
    
    <!-- WINE DISH -->
    <div id='wine_dish' {if $tbl_dishesinfo.dish_is_drink eq 0}style='display:none;'{/if}>
       {include file="tbl_dishes/edit_view_wine.tpl"}
    </div>
    <!-- WINE DISH END -->
