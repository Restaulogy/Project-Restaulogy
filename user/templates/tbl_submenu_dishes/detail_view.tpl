<h1>
{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.attrib_details}
    {foreach $tbl_submenu_dishesinfo.sbmnu_dish_detail.attrib_details as $attribs}
        {if $attribs.dish_attrib_img neq ''}
            <img style="width:20px;height:20px;" src="{$website}{$smarty.const.DISH_ATTRIB_IMG_UPLOAD_PATH}{$attribs.dish_attrib_img}" />
        {/if}
    {/foreach}
{/if}

{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_name}&nbsp;<b style="inline-block;color:#284;">{if $tbl_submenu_dishesinfo.sbmnu_dish_price gt 0}({$smarty.session.curr_restant.restaurent_currency}{$tbl_submenu_dishesinfo.sbmnu_dish_price}){/if} {if $dishrating}<a href="#" onclick="$('#popupFavList').popup('open');"><img src="{$website}/images/rating/{$dishrating}.gif" /></a>{/if}
</b>
</h1>
<div class="listTable biz_no_border" style="background:transparent !important;" >
		<div class="biz_center">
            {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_img && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_img neq ''}
                <img src="{$website}/uploads/dish/{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_img}" style="width:250px;height:200px;"/>
            {else}
                {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_is_drink eq 0}
                    <img width="250" height="200" src="{$website}/images/no_dish.png" />
                {else}
                    <img width="250" height="200" src="{$website}/images/no_drink.jpg" />
                {/if}
            {/if}
        </div>
        <div class="clearfix line_break"></div>
        <div id="less_des" style="text-align:justify;font-size:12px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_notes|truncate:180:'...<a href="#" onclick=\'$("#popupDesc").popup("open");$("#more_des").toggle();\'>more</a>'}
        </div>
</div>
	<div data-role="popup" id="popupDesc" data-dismissible="false" data-theme="a1" data-overlay-theme="g" style="width:270px;">
		<div data-role="header"><h3>Description</h3></div>
		
		<div data-role="content">
		<div class="description" style="height:150px;overflow-y: auto;padding:5px 7px;"><p>{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_notes}</p> 
		</div>
			
		<div class="biz_center">
            <input data-inline="true" data-mini="true" data-icon="delete" type="button" onclick="$('#popupDesc').popup('close');" value="{$_lang.close_lbl}"></div>
		</div> 
			
		</div>

	<div class="clearfix"></div>	 
 		<div data-role="collapsible-set" data-theme="a" data-content-theme="i" data-inset="true" data-iconpos="right" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
		
	{if $tbl_submenu_dishesinfo.optionsPrice}
		<div data-role="collapsible" class="coll">
			 <h3>Options/Side Dish <div class="clearfix line_break"></div></h3>
			 <p>
	  {if $tbl_submenu_dishesinfo.optionsPrice}
	   <table class="biz_data_grid" style="margin:0px 5px;"> 
			<!--<tr><th class="bigListItem" colspan="2">Options/Side Dish</th>
			<th class="actionListItem">{if $tbl_submenu_dishesinfo.sbmnu_dish_price gt 0}Extra Charges{else}Prices{/if}</th>
			</tr> -->
 		{assign var=currOptId value=0}
		{foreach from=$tbl_submenu_dishesinfo.optionsPrice item=optItm}
			 
			{if $currOptId neq $optItm.dish_opt_id} 
				<tr> 
				 <th colspan="2">{$optItm.dish_opt_name}&nbsp;{if $optItm.dish_opt_type eq "checkbox"}(Choose multiple){else}{if $optItm.dish_opt_type eq "dropdown"}(Choose One){/if}{/if}</th>
				</tr>
				{assign var=currOptId value=$optItm.dish_opt_id}
			{/if} 
		 	<tr class="{cycle values="odd,even"}">
			   {if $optItm.dish_opt_type eq "text"}
			   <td class="bigListItem no_hover" colspan="2">
			   {$optItm.dish_opt_val_value} 
			   </td>
			   {else}				
			   <td class="bigListItem no_hover">
			 	 {$optItm.dish_opt_val_value} 
			 	</td> 
				 <td class="actionListItem no_hover" valign="top"> 
					{if $optItm.sbmdopt_pr_price && $optItm.sbmdopt_pr_price gt 0}{$optItm.sbmdopt_pr_price}{else}No Charge{/if} 
				</td> 
				{/if}
			</tr> 
		{/foreach}
	</table>
	{else}
		<br/>
		<div class="errorbox">There are no options available for this menu</div>
		<br/>
	{/if}
	</p>  
	</div>
{/if}

	{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_ingrad_allergic_contents && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_ingrad_allergic_contents neq ''}
		<div data-role="collapsible" class="coll"> 
			 <h3>{$_lang.tbl_dishes.label.dish_ingrad_allergic_contents}<div class="clearfix line_break"></div></h3>
			 <p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_ingrad_allergic_contents}</p></div><!-- /collapsible -->
	{/if}
	
	{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_allergy && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_allergy neq ''}
		<div data-role="collapsible" class="coll">
			 <h3>{$_lang.tbl_dishes.label.dish_allergy}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">
             {if $tbl_submenu_dishesinfo.sbmnu_dish_detail}
                {foreach $tbl_submenu_dishesinfo.sbmnu_dish_detail.allergy_details as $alergy}
                   {$alergy.alergy_name}<br>
                {/foreach}
             {/if}
             </p></div><!-- /collapsible -->
	{/if}
	
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
	
    {* if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_nutri_cal_info && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_nutri_cal_info neq ''}
    	<div data-role="collapsible" class="biz_hidden">
			 <h3>{$_lang.tbl_dishes.label.dish_nutri_cal_info}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_nutri_cal_info}</p></div><!-- /collapsible -->
	{/if *}
	
	{include file="tbl_submenu_dishes/nutrition_view.tpl"}
	
	{if $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_chef_notes && $tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_chef_notes neq ''}
		<div data-role="collapsible" class="coll"> 
			 <h3>{$_lang.tbl_dishes.label.dish_chef_notes}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_chef_notes}</p>
		</div><!-- /collapsible -->
	{/if}
 </div>
 
 {if $tbl_submenu_dishesinfo.sbmnu_dish_detail.food_notes_details}
        <div class="info">
            {$_lang.tbl_food_notes.title}:<br>
        {foreach $tbl_submenu_dishesinfo.sbmnu_dish_detail.food_notes_details as $_food_note}
            {if $_food_note.fdnote_number neq ''}
                {$_food_note.fdnote_number}:{$_food_note.fdnote_desc}<br>
            {/if}
        {/foreach}
        </div>
    {/if}
