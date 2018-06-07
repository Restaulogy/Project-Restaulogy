
<div class="listTable biz_no_border" style="background:transparent !important;" > 
		<div class="biz_center">
		{if $tbl_dishesinfo.dish_img && $tbl_dishesinfo.dish_img neq ''}
            <img src="{$website}/uploads/dish/{$tbl_dishesinfo.dish_img}" style="width:250px;height:200px;"/>
        {else}
            {if $tbl_dishesinfo.dish_is_drink eq 0}
                <img width="250" height="200" src="{$website}/images/no_dish.png" />
            {else}
                <img width="250" height="200" src="{$website}/images/no_drink.jpg" />
            {/if}
        {/if}
        </div>
        <div class="clearfix line_break"></div>
        <div id="less_des" style="text-align:justify;font-size:12px;">{$tbl_dishesinfo.dish_notes|truncate:180:'...<a href="#" onclick=\'$("#popupDesc").popup("open");$("#more_des").toggle();\'>more</a>'}</div>
</div>
	<div data-role="popup" id="popupDesc" data-dismissible="false" data-theme="a1" data-overlay-theme="g" style="width:270px;">
		<div data-role="header"><h3>Description</h3></div>
		
		<div data-role="content">
    		<div class="description" style="height:150px;overflow-y: auto;padding:5px 7px;"><p>{$tbl_dishesinfo.dish_notes}</p>
    		</div>

    		<div class="biz_center"><input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="$('#popupDesc').popup('close');" value="{$_lang.close_lbl}"></div>
		</div> 
	</div>

	<div class="clearfix"></div>
	 
 		<div data-role="collapsible-set" data-theme="a" data-content-theme="i" data-inset="true" data-iconpos="right" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u"> 
 		{if $tbl_dishesinfo.dish_options}
		<div data-role="collapsible" class="coll"> 
			 <h3>Options/Side dish<div class="clearfix line_break"></div></h3><p>
			 {if $tbl_dishesinfo.dish_options}
			   <table class="biz_data_grid" style="margin:0px 5px;"> 
				 
				{foreach $tbl_dishesinfo.dish_options as $dish_option}
			 	<tr>
                 <th> {$dish_option.dish_opt_name}&nbsp;{if $dish_option.dish_opt_type eq "checkbox"}(Choose multiple){else}{if $dish_option.dish_opt_type eq "dropdown"}(Choose One){/if}{/if} </th>
                 </tr> 
				{assign var=dish_opt_values value=";"|explode:$dish_option.dish_opt_values}	 
				{foreach $dish_opt_values as $dish_value}
    				<tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$dish_value}</td>
                    </tr>
				{/foreach} 
			 	{/foreach}
			 </table>
			 {/if} 
			 </p>
		</div>
        {/if}
        {if $tbl_dishesinfo.dish_ingrad_allergic_contents && $tbl_dishesinfo.dish_ingrad_allergic_contents neq ''}
		<div data-role="collapsible" class="coll"> 
			 <h3>{$_lang.tbl_dishes.label.dish_ingrad_allergic_contents}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_dishesinfo.dish_ingrad_allergic_contents}</p>
		</div>
        {/if}
        
        {if $tbl_dishesinfo.dish_allergy && $tbl_dishesinfo.dish_allergy neq ''}
        <div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_allergy}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">
			 {if $tbl_dishesinfo.allergy_details}
                {foreach $tbl_dishesinfo.allergy_details as $alergy}
                   {$alergy.alergy_name}<br>
                {/foreach}
             {/if}
            </p>
		</div>
		{/if}

        {if (($tbl_dishesinfo.dish_pair_note && $tbl_dishesinfo.dish_pair_note neq '')||($tbl_dishesinfo.dish_food_wine_pair && $tbl_dishesinfo.dish_food_wine_pair neq ''))}
		<div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_food_wine_pair}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">
                <strong style='color:black;'>{$_lang.tbl_dishes.label.dish_pair_note}</strong> <br>
                {if $tbl_dishesinfo.dish_pair_note && $tbl_dishesinfo.dish_pair_note neq ''}
                  {$tbl_dishesinfo.dish_pair_note}
                {else}
                    --
                {/if}
                {if $tbl_dishesinfo.dish_food_wine_pair && $tbl_dishesinfo.dish_food_wine_pair neq ''}
                 <p style="margin-top:-16px !important;">
                  {include file="tbl_dishes/dish_pairing.tpl"}
                 </p>
                {/if}
             </p>
		</div>
		{/if}

		{include file="tbl_dishes/nutrition_view.tpl"}

        {if $tbl_dishesinfo.dish_chef_notes && $tbl_dishesinfo.dish_chef_notes neq ''}
        <div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_chef_notes}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_dishesinfo.dish_chef_notes}</p>
		</div> 
		{/if}
	</div> 
