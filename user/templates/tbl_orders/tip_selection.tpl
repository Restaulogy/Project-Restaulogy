<label>{$_lang.tbl_orders.label.tip_suggestion}</label>
{assign var="isSelected" value="0"}
<select name="tip_list" id="tip_list" onclick="tipChange(this.value);">
<option value="0">Select value</option>
{foreach $tiplist as $tip}
 {math assign=tip_val equation='(x * y)/100.00' x=$tbl_ordersinfo.curr_bill_amnt y=$tip}
 {if $smarty.request.order_tip gt 0}
 	{if  "{$tip_val|number_format:2:".":"."}" eq "{$smarty.request.order_tip}"}
 		  {assign var="isSelected" value=1}
	{else}
			{assign var="isSelected" value=-1}		 
 	{/if}
 {/if}
 
	<option value="{$tip_val}" {if $isSelected eq 1}selected="selected"{/if}>{$tip}{$_lang.percent_mark} ({$smarty.session.curr_restant.restaurent_currency}{$tip_val|number_format:2:".":"."})</option>
{/foreach}
<option value="-1" {if $isSelected eq -1}selected="selected"{/if}>Select other</option>
</select>
<div id="order_tip_holder" {if $isSelected eq -1}{else}class="biz_hidden"{/if}>
{html_input name="order_tip" value="{$smarty.request.order_tip}" onblur="tipChange();"} 
</div>
