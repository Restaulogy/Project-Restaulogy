<div class="listTable" style="background:transparent !important;" >
		<img  src="{$website}/uploads/dish/{$tbl_dishesinfo.dish_img}"  align="left" style="width:99%;margin:3px;"/><br><small style="text-align:justify;">{$tbl_dishesinfo.dish_notes}</small>
	</div> 

	<div class="clearfix"></div>
	 
 	<div data-role="collapsible-set" data-theme="h" data-content-theme="f" data-inset="true" data-iconpos="right" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
		<div data-role="collapsible"> 
			 <h3>{$_lang.tbl_dishes.label.dish_chef_notes}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_dishesinfo.dish_chef_notes}</p>
		</div> 
		<div data-role="collapsible"> 
			 <h3>{$_lang.tbl_dishes.label.dish_ingrad_allergic_contents}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_dishesinfo.dish_ingrad_allergic_contents}</p>
		</div> 
		<div data-role="collapsible"> 
			 <h3>{$_lang.tbl_dishes.label.dish_nutri_cal_info}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_dishesinfo.dish_nutri_cal_info}</p>
		</div>
		
		<div data-role="collapsible"> 
			 <h3>Options/Side dish<div class="clearfix line_break"></div></h3><p>
			 {if $tbl_dishesinfo.dish_options}
			  <table class="listTable"> 
				<tr><th class="bigListItem">Options/Side dish</th></tr>
				{foreach  $tbl_dishesinfo.dish_options as $dish_option}
			 	<tr><th>{$dish_option.dish_opt_name}&nbsp;{if $dish_option.dish_opt_type eq "checkbox"}(Choose multiple){else}{if $dish_option.dish_opt_type eq "dropdown"}(Choose One){/if}{/if}</th></tr> 
				{assign var=dish_opt_values value=";"|explode:$dish_option.dish_opt_values}	 
				{foreach $dish_opt_values as $dish_value}
				<tr><td>{$dish_value}</td></tr>
				{/foreach} 
			 	{/foreach}
			 </table>
			 {/if}
			 
			 </p>
		</div>  
		 
	</div> 