<div data-role="popup" id="popup_lst_discounts" data-theme="b" data-overlay-theme="g" data-dismissible="false">	
 <div data-role="header">
 	<h1>Apply Discount</h1> 
</div>	
<div data-role="content" style="padding:5px;">
		<select name="lst_discounts" id="lst_discounts" >
			{if $discount_lst}
				{foreach $discount_lst as $discnt}
					<option value="{$discnt.discount_id}">{$discnt.discount_name}-{$discnt.discount_percent}{if $discnt.discount_type eq 'PERCENT'}%{else}${/if}</option>
				{/foreach}
			{/if}  
		</select> 
		<br />
		<div style="text-align:center !important;">
			<input id="itm_type_for_disc" name="itm_type_for_disc" type="hidden" value="" />
			<input id="itm_to_apply_disc" name="itm_to_apply_disc" type="hidden" value="" />
			<input data-inline="true" onclick='applydiscount();' type="button" value="{$_lang.tbl_discounts.label.apply}" data-icon="save"/>
				
			<input type="button" data-role="button" data-inline="true" data-icon="delete" onclick="$('#popup_lst_discounts').popup('close');" value="{$_lang.close_lbl}" />
		</div>
	
</div>
</div>