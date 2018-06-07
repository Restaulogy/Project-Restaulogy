<h3>{$_lang.tbl_sbmnu_dish_opt_price.listing_title}</h3>
	{if $tbl_submenu_dishesinfo.optionsPrice}
	
	<table class="biz_data_grid"> 
			<!--<tr><th class="bigListItem">{$_lang.tbl_sbmnu_dish_opt_price.listing_title}</th>
			<th class="actionListItem"></th>
			</tr> -->
 		{assign var=currOptId value=0} 
		{assign var=isFromSubmenu value=-1}
		{foreach from=$tbl_submenu_dishesinfo.optionsPrice item=optItm}
		{if $isFromSubmenu neq $optItm.isFromSubmenu}
			<tr>
				<th class="bigListItem" colspan="2">{if $optItm.isFromSubmenu eq 1}Submenu Dish Options{else}Dish Options{/if}</th>
			</tr>
			{assign var=isFromSubmenu value=$optItm.isFromSubmenu}
		{/if}
			 
			{if $currOptId neq $optItm.dish_opt_id} 
				<tr> 
				 <th colspan="2">{$optItm.dish_opt_name}</th>
				</tr>
				{assign var=currOptId value=$optItm.dish_opt_id}
			{/if} 
			
			
		 	<tr class="{cycle values="odd,even"}">
				 
				<td class="bigListItem no_hover"">
					<div class="fleft">{$optItm.dish_opt_val_value}</div>
					 
					<input class="fright {if $optItm.dish_opt_type eq "text"}biz_hidden{/if}" id="price_{$optItm.dish_opt_val_id}"  value="{if $optItm.sbmdopt_pr_price}{$optItm.sbmdopt_pr_price}{else}0.00{/if}" style="color:#000;width:75px;text-align: right;"/>
					
					<input type="hidden" id="price_id_{$optItm.dish_opt_val_id}" value="{if $optItm.sbmdopt_pr_id}{$optItm.sbmdopt_pr_id}{else}0{/if}">  
				</td> 
				<td class="actionListItem no_hover"> 
				{if $optItm.dish_opt_type eq "text"}
					{if $optItm.sbmdopt_pr_id}
							<a href="#" class="deleteIcon" onclick="deleteDish_opt_price({$optItm.sbmdopt_pr_id});"></a>
					{else}
							<a href="#" class="saveIcon" onclick="updateDish_opt_price({$optItm.dish_opt_val_id});"></a>
					{/if}
				{else}
					<a href="#" class="saveIcon" onclick="updateDish_opt_price({$optItm.dish_opt_val_id});"></a>
					<a href="#" class="renewIcon" onclick="updateDish_opt_price({$optItm.dish_opt_val_id},1);"></a>
					{if $optItm.sbmdopt_pr_id gt 0}
						<a href="#" class="deleteIcon" onclick="deleteDish_opt_price({$optItm.sbmdopt_pr_id});"></a>
				 	{/if}
				 {/if}
				</td>
			</tr>  
		{/foreach}
	</table> 
	 {else}
	 <br /><br />
	 <div class="error">{$_lang.tbl_dish_options.no_record_found}</div> 
	{/if}
 
