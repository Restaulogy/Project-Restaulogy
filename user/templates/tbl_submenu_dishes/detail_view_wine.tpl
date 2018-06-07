<h1>
{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.attrib_details}
    {foreach $tbl_submenu_dishesinfo.sbmnu_dish_detail.attrib_details as $attribs}
        {if $attribs.dish_attrib_img neq ''}
            <img style="width:20px;height:20px;" src="{$website}{$smarty.const.DISH_ATTRIB_IMG_UPLOAD_PATH}{$attribs.dish_attrib_img}" />
        {/if}
    {/foreach}
{/if}
    {$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_name}&nbsp;<b style="inline-block;color:#284;">{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_glass_price gt 0}({$smarty.session.curr_restant.restaurent_currency}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_glass_price}){/if} {if $dishrating}<a href="#" onclick="$('#popupFavList').popup('open');"><img src="{$website}/images/rating/{$dishrating}.gif" /></a>{/if}
    </b>
</h1>

<div class="listTable biz_no_border" style="background:transparent !important;" >
    <table>
        <tr>
             <td width="60%">
                {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_img && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_img neq ''}
                 <img src="{$website}/uploads/dish/{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_img}" style="width:200px;margin:3px;height:200px;"/>
                {else}
                     {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_is_drink eq 0}
                        <img width="250" height="200" src="{$website}/images/no_dish.png" />
                    {else}
                        <img width="250" height="200" src="{$website}/images/no_drink.jpg" />
                    {/if}
                {/if}
             </td>
             <td width="40%">
                 {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_vintage && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_vintage neq '' && $tbl_dishesinfo.dish_vintage gt 1970}
                  <b>{$_lang.tbl_dishes.label.dish_vintage}</b> - {$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_vintage}
                  {/if}
                  <br>
                  {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_varietal && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_varietal neq ''}
                  <b>{$_lang.tbl_dishes.label.dish_varietal}</b> - {$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_varietal}
                  {/if}
             </td>
        </tr>
        {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.one_line_info && $tbl_submenu_dishesinfo.sbmnu_dish_detail.one_line_info neq ''}
        <tr>
            <td colspan='2'>
                {$tbl_submenu_dishesinfo.sbmnu_dish_detail.one_line_info}
                {*
                    {$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_winery} - {$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_region} - {$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_country}
                *}
            </td>
        </tr>
        {/if}

        {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_alcohol_percent && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_alcohol_percent > 0}
            <tr>
                <td colspan='2'>
                    <b>{$_lang.tbl_dishes.label.dish_alcohol_percent}</b> -{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_alcohol_percent}
                </td>
            </tr>
        {/if}
        {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_bottle_price && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_bottle_price gt 0}
        <tr>
            <td colspan='2'>
                <b>{$_lang.tbl_dishes.label.dish_bottle_price}</b> :{$smarty.session.curr_restant.restaurent_currency}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_bottle_price}
            </td>
        </tr>
        {/if}
        
        {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_glass_price && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_glass_price gt 0}
        <tr>
            <td colspan='2'>
                <b>{$_lang.tbl_dishes.label.dish_glass_price}</b> :{$smarty.session.curr_restant.restaurent_currency}{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_glass_price}
            </td>
        </tr>
        {/if}
        
    </table>
</div>

	<div class="clearfix"></div>

	<div data-role="collapsible-set" data-theme="a" data-content-theme="i" data-inset="true" data-iconpos="right" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_notes && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_notes neq ''}
		<div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_notes}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_notes}</p>
        </div><!-- /collapsible -->
{/if}
{*if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_food_wine_pair && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_food_wine_pair neq ''}
        <div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_food_wine_pair}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">
             {include file="tbl_submenu_dishes/dish_pairing.tpl"}
             </p>
        </div><!-- /collapsible -->
{/if*}

	{if ($tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_food_wine_pair && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_food_wine_pair neq '') || ($tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_pair_note && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_pair_note neq '') }
		<div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_food_wine_pair}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">
    <strong>{$_lang.tbl_dishes.label.dish_pair_note}</strong> <br>
             {if ($tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_pair_note && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_pair_note neq '')}
                {$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_pair_note}
             {else}
                    --
             {/if}

             {if ($tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_food_wine_pair && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_food_wine_pair neq '')}
                <p style="margin-top:-18px !important;">
                {include file="tbl_submenu_dishes/dish_pairing.tpl"}
                </p>
             {/if}

             </p></div><!-- /collapsible -->
	{/if}

	</div>
