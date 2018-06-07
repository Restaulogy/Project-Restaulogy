  
 
	 
	<div class="listTable" style="background:transparent !important;" >
		<img  src="{$website}/uploads/dish/{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_img}"  align="left" style="width:99%;margin:3px;"/><br><small style="text-align:justify;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_notes}</small>
	</div>
	<div class="clearfix"></div>
	 
 	<div data-role="collapsible-set" data-theme="i" data-content-theme="i" data-inset="true" data-iconpos="right" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
		<div data-role="collapsible"> 
			 <h3>{$_lang.tbl_dishes.label.dish_chef_notes}<div class="clearfix line_break"></div></h3><p>
			  
			 
			 {$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_chef_notes}</p>
		</div><!-- /collapsible -->
<div data-role="collapsible"> 
			 <h3>{$_lang.tbl_dishes.label.dish_ingrad_allergic_contents}<div class="clearfix line_break"></div></h3>
			 <p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_ingrad_allergic_contents}</p></div><!-- /collapsible -->
<div data-role="collapsible">
			 <h3>{$_lang.tbl_dishes.label.dish_nutri_cal_info}<div class="clearfix line_break"></div></h3><p style="min-height:60px;">{$tbl_submenu_dishesinfo.sbmnu_dish_detail.dish_nutri_cal_info}</p></div><!-- /collapsible -->
	<div data-role="collapsible">
			 <h3>Options/Side dish <div class="clearfix line_break"></div></h3>
			 <p>
	  {if $tbl_submenu_dishesinfo.optionsPrice}
	  <table class="listTable"> 
			<tr><th class="bigListItem">Options/Side dish</th>
			<!--<th class="actionListItem">{if $tbl_submenu_dishesinfo.sbmnu_dish_price gt 0}Extra Charges{else}Prices{/if}</th>-->
			</tr> 
 		{assign var=currOptId value=0}
		{foreach from=$tbl_submenu_dishesinfo.optionsPrice item=optItm}
			 
			{if $currOptId neq $optItm.dish_opt_id} 
				<tr> 
				 <th colspan="2">{$optItm.dish_opt_name}&nbsp;{if $optItm.dish_opt_type eq "checkbox"}(Choose multiple){else}{if $optItm.dish_opt_type eq "dropdown"}(Choose One){/if}{/if}</th>
				</tr>
				{assign var=currOptId value=$optItm.dish_opt_id}
			{/if} 
		 	<tr>
			   {if $optItm.dish_opt_type eq "text"}
			   <td class="bigListItem" colspan="2">{$optItm.dish_opt_val_value} </td>
			   {else}				<td class="bigListItem">
			 	 {$optItm.dish_opt_val_value} 
				</td> 
				<!--<td class="actionListItem" valign="top"> 
					{if $optItm.sbmdopt_pr_price && $optItm.sbmdopt_pr_price gt 0}${$optItm.sbmdopt_pr_price}{else}No Charge{/if} 
				</td>-->
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
 </div>
	   
