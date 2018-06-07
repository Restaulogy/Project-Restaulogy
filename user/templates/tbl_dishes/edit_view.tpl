 <div class="listTable biz_no_border" style="background:transparent !important;" >
   <div class="biz_center">
	<a href="{$website}/uploads/dish/{$tbl_dishesinfo.dish_img}" target="_blank">
        {if $tbl_dishesinfo.dish_img neq ''}
            <img src="{$website}/uploads/dish/{$tbl_dishesinfo.dish_img}" style="width:250px;height:200px;"/>
        {else}
            {if $tbl_dishesinfo.dish_is_drink eq 0}
                <img width="250" height="200" src="{$website}/images/no_dish.png" />
            {else}
                <img width="250" height="200" src="{$website}/images/no_drink.jpg" />
            {/if}
        {/if}
    </a> 
    {if $tbl_dishesinfo.dish_img neq ''}
        <input type="button" value="Delete Image" onclick="document.location.href='{$website}/user/tbl_dishes.php?dish_id={$tbl_dishesinfo.dish_id}&del_dish_img=1';" data-icon="delete" data-inline="true" data-mini="true"/>
    {/if}
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
	<b>{$_lang.tbl_dishes.label.dish_name}</b>:
	{assign var=editview_value value=$tbl_dishesinfo.dish_name}
	{assign var=editInline value=1}
	{assign var=editview_id value=dish_name}
	{assign var=editview_name value=dish_name}
	{include file="control/editview.tpl"} 
	<div class="clearfix"></div> 
	
	<b>{$_lang.tbl_dishes.label.dish_notes}</b>:
	<small style="text-align:justify;">		
	{assign var=editview_value value=$tbl_dishesinfo.dish_notes}
	{assign var=editInline value=0}
	{assign var=editview_id value=dish_notes}
	{assign var=editview_name value=dish_notes}
	{include file="control/editview.tpl"} 
	</small> 
	
	<b>{$_lang.tbl_dishes.label.dish_pair_note}</b>:
	<small style="text-align:justify;">
	{assign var=editview_value value=$tbl_dishesinfo.dish_pair_note}
	{assign var=editInline value=0}
	{assign var=editview_id value=dish_pair_note}
	{assign var=editview_name value=dish_pair_note}
	{include file="control/editview.tpl"}
	</small>
	
    {include file="tbl_dishes/food_pairing_with_tabs.tpl"}

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
	
	<div class="field-row">
		<label for="dish_food_notes">{$_lang.tbl_dishes.label.dish_food_notes}</label>

        <select id="dish_food_notes" name="dish_food_notes[]" multiple="multiple" data-native-menu="false" onchange="$('#dish_food_notes_btns').show();" >
         <option value="" data-placeholder="true">Select Food Notes</option>
		 {foreach $lst_food_notes as $_note}
		 	<option value="{$_note@key}" {if $tbl_dishesinfo.dish_food_notes &&  in_array($_note@key,$tbl_dishesinfo.dish_food_notes_arr) }selected="selected"{/if}>{$_note}</option>
		 {/foreach}
		 </select>

		<div class="error" id="dish_food_notes_err"></div>
		
		<div id="dish_food_notes_btns" class='biz_center' style="display:none;">
    		<input type="submit" value="save" data-inline="true" data-mini="true" data-icon="save"/>
    		<input type="button" value="cancel" data-inline="true" data-mini="true" data-icon="delete" onclick="$('#dish_food_notes_btns').hide();"/>
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
       
       <!-- ==========START  NUTRITION========= -->
        <fieldset data-role="controlgroup" data-type="horizontal" style="width:100%px;border-bottom:solid white 1px;" >
    	<legend>Choose Nutrition Option:</legend>
         	<label for="dish_is_nutrition_text_1"><input type="radio" name="dish_is_nutrition_text" id="dish_is_nutrition_text_1" value="0" {if $tbl_dishesinfo.dish_is_nutrition_text eq 0}checked="checked"{/if}  onclick='show_nutri_tab("table");' />
         	{$_lang.tbl_dishes.nutri_table}</label>
            <label for="dish_is_nutrition_text_2"><input type="radio" name="dish_is_nutrition_text" id="dish_is_nutrition_text_2" value="1" {if $tbl_dishesinfo.dish_is_nutrition_text eq 1}checked="checked"{/if} onclick='show_nutri_tab("text");' />
         	{$_lang.tbl_dishes.nutri_text}</label>
        </fieldset>
        <!-- NUTRI TABLE -->
        <div id='nutri_table' {if $tbl_dishesinfo.dish_is_nutrition_text eq 1}style='display:none;'{/if}>
            {include file="tbl_dishes/nutrition_edit.tpl"}
        </div>
        <!-- NUTRI TABLE END -->

        <!-- TEXT TYPE -->
        <div id='nutri_text' {if $tbl_dishesinfo.dish_is_nutrition_text eq 0}style='display:none;'{/if}>
           <div class="field-row">
        		<label for="dish_nutri_cal_info">{$_lang.tbl_dishes.label.dish_nutri_cal_info}</label>
        		 {assign var=editview_value value=$tbl_dishesinfo.dish_nutri_cal_info}
                 {assign var=editview_id value=dish_nutri_cal_info}
                 {assign var=editview_name value=dish_nutri_cal_info}
			     {include file="control/editview.tpl"}
        		<div class="error" id="dish_nutri_cal_info_err"></div>
        	</div>
        </div>
        <!-- TEXT TYPE -->
        <!-- ==========END  NUTRITION========= -->
       
       
    </div>
    <!-- REGULAR DISH END -->
    
    <!-- WINE DISH -->
    <div id='wine_dish' {if $tbl_dishesinfo.dish_is_drink eq 0}style='display:none;'{/if}>
       {include file="tbl_dishes/edit_view_wine.tpl"}
    </div>
    <!-- WINE DISH END -->
