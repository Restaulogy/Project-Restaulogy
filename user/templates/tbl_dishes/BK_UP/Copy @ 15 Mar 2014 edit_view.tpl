 

<div class="listTable biz_no_border" style="background:transparent !important;" >
<div class="biz_center">
	<a href="{$website}/uploads/dish/{$tbl_dishesinfo.dish_img}" target="_blank"><img  src="{$website}/uploads/dish/{$tbl_dishesinfo.dish_img}" style="width:250px;height:200px;"/></a> 
	<!--<div id="dish_img_view" style="font-size:12px;">		
	<input type="button" value="Edit" onclick="$('#dish_img_edit').show();$('#dish_img_view').hide();" data-icon="edit" data-inline="true" data-mini="true"/> 
	</div> -->
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
</div> 

	<div class="clearfix"></div>
	 
 	<div data-role="collapsible-set" data-theme="a" data-content-theme="i" data-inset="true" data-iconpos="right" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u"> 
		<div data-role="collapsible" class="coll"> 
			 <h3><a class="splitButtonClicked editIcon" onclick="window.open('{$website}/user/tbl_dish_options.php?dish_opt_dish_id={$tbl_dishesinfo.dish_id}');"></a>&nbsp;&nbsp;Options/Side dish<div class="clearfix line_break"></div></h3><p>
			 {if $tbl_dishesinfo.dish_options}
			  <table class="biz_data_grid">  
				{foreach  $tbl_dishesinfo.dish_options as $dish_option}
			 	<tr><th>{$dish_option.dish_opt_name}&nbsp;{if $dish_option.dish_opt_type eq "checkbox"}(Choose multiple){else}{if $dish_option.dish_opt_type eq "dropdown"}(Choose One){/if}{/if}</th></tr>
				{assign var=dish_opt_values value=";"|explode:$dish_option.dish_opt_values}
				{foreach $dish_opt_values as $dish_value}
				<tr class="{cycle values="odd,even"}"><td class="no_hover">{$dish_value}</td></tr>
				{/foreach} 
			 	{/foreach}
			 </table>
			 {/if}
			 
			 </p>
		</div>  
		 
		<div data-role="collapsible" class="coll" id="clps_dish_ingrad_allergic_contents">
			 <h3><a class="splitButtonClicked editIcon" content_id="dish_ingrad_allergic_contents"></a>&nbsp;&nbsp;{$_lang.tbl_dishes.label.dish_ingrad_allergic_contents}</h3><p> 
			 {assign var=editview_value value=$tbl_dishesinfo.dish_ingrad_allergic_contents}
{assign var=editview_id value=dish_ingrad_allergic_contents}
{assign var=editview_name value=dish_ingrad_allergic_contents}
			{include file="control/editview.tpl"}
			 
			 </p>
		</div> 
		
		<div data-role="collapsible" class="coll" id="clps_dish_allergy">
			 <h3><a class="splitButtonClicked editIcon" content_id="dish_allergy"></a>&nbsp;&nbsp;{$_lang.tbl_dishes.label.dish_allergy}</h3><p>
			 {assign var=editview_value value=$tbl_dishesinfo.dish_allergy}
{assign var=editview_id value=dish_allergy}
{assign var=editview_name value=dish_allergy}
			{include file="control/editview.tpl"}

			 </p>
		</div>
		
        <div data-role="collapsible" class="coll" id="clps_dish_food_wine_pair">
			 <h3><a class="splitButtonClicked editIcon" content_id="dish_food_wine_pair"></a>&nbsp;&nbsp;{$_lang.tbl_dishes.label.dish_food_wine_pair}</h3><p>
			 {assign var=editview_value value=$tbl_dishesinfo.dish_food_wine_pair}
{assign var=editview_id value=dish_food_wine_pair}
{assign var=editview_name value=dish_food_wine_pair}
			{include file="control/editview.tpl"}

			 </p>
		</div>
					 
		<div data-role="collapsible" class="biz_hidden" id="clps_dish_nutri_cal_info" >
			 <h3><a class="splitButtonClicked editIcon" content_id="dish_nutri_cal_info"></a>&nbsp;&nbsp;{$_lang.tbl_dishes.label.dish_nutri_cal_info}</h3> 
			 <p>
			 {assign var=editview_value value=$tbl_dishesinfo.dish_nutri_cal_info}
{assign var=editview_id value=dish_nutri_cal_info}
{assign var=editview_name value=dish_nutri_cal_info}
			{include file="control/editview.tpl"} 
			 </p>
		</div>
		
		<div data-role="collapsible" class="coll" id="clps_dish_chef_notes"> 
			 <h3><a class="splitButtonClicked editIcon"  content_id="dish_chef_notes"></a>&nbsp;&nbsp;{$_lang.tbl_dishes.label.dish_chef_notes}</h3><p> 
			{assign var=editview_value value=$tbl_dishesinfo.dish_chef_notes}
			{assign var=editview_id value=dish_chef_notes}
			{assign var=editview_name value=dish_chef_notes}
			{include file="control/editview.tpl"}
			 </p>
		</div> 
		
		<div data-role="collapsible" class="coll" id="clps_dish_menu_submenu">
			 <h3><a class="splitButtonClicked editIcon" content_id="dish_menu_submenu"></a>&nbsp;&nbsp;Menu Submenu Listed</h3> 
			 <p>
			 	 {include file="tbl_dishes/list.tpl"}
			 </p>
		</div>
		 
	</div>
