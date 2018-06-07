<!-- =======END NUTRINTION===== -->
 {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_is_nutrition_text eq 0}
 
		{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details &&
            (
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_total_cal gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_cal_from_fat gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_total_fat gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_saturated_fat gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_trans_fat gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_cholestrol gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_sodium gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_total_carbohydrate gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_sugar gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_dietary_fiber gt 0 ||
            $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_protein gt 0
            )
         }
         
		<div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_nutri_cal_info}
             <div class="clearfix line_break"></div>
             </h3>
             <p>
			 {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details}
			   <table class="biz_data_grid" style="margin:0px 5px;">
                <tr>
                 <th colspan='2'> {$_lang.tbl_dishes.label.dish_nutri_cal_info} </th>
                </tr>
                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_total_cal}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_total_cal gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_total_cal}{else}--{/if}</td>
                </tr>
                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_cal_from_fat}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_cal_from_fat gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_cal_from_fat}{else}--{/if}</td>
                </tr>
                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_total_fat}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_total_fat gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_total_fat}{else}--{/if}</td>
                </tr>
                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_saturated_fat}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_saturated_fat gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_saturated_fat}{else}--{/if}</td>
                </tr>
                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_trans_fat}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_trans_fat gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_trans_fat}{else}--{/if}</td>
                </tr>
                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_cholestrol}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_cholestrol gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_cholestrol}{else}--{/if}</td>
                </tr>
                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_sodium}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_sodium gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_sodium}{else}--{/if}</td>
                </tr>

                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_total_carbohydrate}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_total_carbohydrate gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_total_carbohydrate}{else}--{/if}</td>
                </tr>
                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_sugar}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_sugar gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_sugar}{else}--{/if}</td>
                </tr>
                <tr class="{cycle values="odd,even"}">
                        <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_dietary_fiber}</td>
                        <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_dietary_fiber gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_dietary_fiber}{else}--{/if}</td>
                </tr>
                <tr class="{cycle values="odd,even"}">
                    <td class="no_hover">{$_lang.tbl_nutrition.label.nutr_protein}</td>
                    <td class="no_hover">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_protein gt 0}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.nutrition_details.nutr_protein}{else}--{/if}</td>
                </tr>
			 </table>
			 {/if}

			 </p>
		</div>
        {/if}
{else}
    {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_nutri_cal_info && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_nutri_cal_info neq ''}
    <div data-role="collapsible" >
		<h3>{$_lang.tbl_dishes.label.dish_nutri_cal_info}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_nutri_cal_info}</p>
	</div>
	{/if}
{/if}
        <!-- =======END NUTRINTION===== -->
