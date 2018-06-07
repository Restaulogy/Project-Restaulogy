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


        <select id="dish_allergy" name="dish_allergy[]" multiple="multiple" data-native-menu="false" onchange="$('#dish_allergy_btns').show();"  data-theme="a">
         <option value="" data-placeholder="true">Select From List</option>
		 {foreach $lst_allergies as $alergy}
		 	<option value="{$alergy@key}" {if $tbl_dishesinfo.dish_allergy &&  in_array($alergy@key,$tbl_dishesinfo.dish_allergy_arr) }selected="selected"{/if}>{$alergy}</option>
		 {/foreach}
		 </select>

		<div class="error" id="dish_allergy_err"></div>

		<div id="dish_allergy_btns" class='biz_center' style="display:none;">
    		<input type="submit" value="save" data-inline="true" data-mini="true" data-icon="save" data-theme="a"/>
    		<input type="button" value="cancel" data-inline="true" data-mini="true" data-icon="delete" data-theme="a" onclick="$('#dish_allergy_btns').hide();"/>
    	</div>

			 </p>
		</div>

<!-- shifted on top
		<div data-role="collapsible" class="biz_hidden" id="clps_dish_nutri_cal_info" >
			 <h3><a class="splitButtonClicked editIcon" content_id="dish_nutri_cal_info"></a>&nbsp;&nbsp;{$_lang.tbl_dishes.label.dish_nutri_cal_info}</h3>
			 <p>
			 {assign var=editview_value value=$tbl_dishesinfo.dish_nutri_cal_info}
{assign var=editview_id value=dish_nutri_cal_info}
{assign var=editview_name value=dish_nutri_cal_info}
			{include file="control/editview.tpl"}
			 </p>
		</div>
-->

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
