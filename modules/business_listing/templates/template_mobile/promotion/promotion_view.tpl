{include file="$deftpl/promotion/notify_msg.tpl"}

<form id="promotion_form{$promo_id}" name="promotion_form{$promo_id}" action="promotion.php?list_id={$promotion.list_id}" method="post"  enctype="multipart/form-data" data-ajax="false" onsubmit="return confirm('Are you sure to delete promotion?');">
<input type="hidden" id="id" style="width:50px;" name=" id" value="{$promotion.id}"/>
		<table class="job_detail_panal_table">
        <tr>
            <td class="detail_right_td">Title</td>
			<td class="detail_left_td">{$promotion.title}</td>
         </tr>
         <tr>
            <td class="detail_right_td">
				Promotion&nbsp;<small>(pdf)</small>
			</td>
			<td class="detail_left_td">
    			{if $promotion.pdf}
    		 	    <a href="pdf/{$promotion.pdf}" target="_blank">{$promotion.title}</a><br>
                {/if}
			</td>
         </tr>

         <tr>
            <td class="detail_right_td">Start Date</td>
			<td class="detail_left_td">
            {if $promotion.start_date}{$promotion.start_date|date_format:'%m/%d/%Y %I:%M %p'}{/if}
			</td>
         </tr>
         <tr>
            <td class="detail_right_td">End Date</td>
			<td class="detail_left_td">
            {if $promotion.end_date}{$promotion.end_date|date_format:'%m/%d/%Y %I:%M %p'}{/if}
			</td>
         </tr>
         <tr style="display:none;">
            <td class="detail_right_td">
                State-Metro Area
            </td>
			<td class="detail_left_td">
                {$promotion.states_name}-{$promotion.metro_area_name}
            </td>
         </tr>

         <tr>
            <td class="detail_right_td">Image</td>
			<td class="detail_left_td">
            {if $promotion.img_ext eq '0'}
					{$translations.promotion.use_list_img.lable}
			{else}
			    <img src="promotion_images/{$promotion.id}.{$promotion.img_ext}" alt="{$promotion.title}" width="30%" height="30%">
			{/if}
			</td>
         </tr>
         <tr>
            <td class="detail_right_td">Coupons (Quantity)</td>
			<td class="detail_left_td" colspan="2">
                {if $promotion.cupon_type  eq 'all_site'}
                	One Time Coupons ({$promotion.allowed_cupons})
                {elseif $promotion.cupon_type  eq 'recommendation'}
               		Coupons on  Recommendations ({$promotion.allowed_cupons})
                {elseif $promotion.cupon_type  eq 'survey'}
               		Survey Coupons ({$promotion.allowed_cupons})
                {elseif $promotion.cupon_type  eq 'reward'}
                	Rewards  ({$promotion.allowed_cupons})
                {else}
              		Regular Promotion
                {/if}
            </td>
         </tr>		 
		 <tr>
            <td class="detail_right_td">CODE </td>
			<td class="detail_left_td" colspan="2">
                {if $promotion.prom_code neq ''}
               		{$promotion.prom_code}
				{else}
					--	
                {/if}
            </td>
         </tr>
         <!--
		 <tr>
            <td class="detail_right_td">Discount </td>
			<td class="detail_left_td" colspan="2">
                {if $promotion.is_exclusive  eq 1}
               		"Exclusive"
				{else}
					"Non Exlusive"	
                {/if}
				Applied to 
				{if $promotion.disc_aply_type eq 'ORDER'}
               		"Complete Order"
				{elseif $promotion.disc_aply_type eq 'ITEM'}
					"Individual Items"
                {elseif $promotion.disc_aply_type eq 'FIXED'}
					"Fixed Amount For Condition Items"
				{elseif $promotion.disc_aply_type eq 'COND_DISC'}
                    "Disocunt For Condition Items"
                {/if}
				, Discount 
				{if $promotion.disc_amt gt 0}
               		"{$promotion.disc_amt}"
				{else}
					"0.00"	
                {/if}
				{if $promotion.disc_amt_type eq 'PERCENT'}
					%
				{else}
					$	
                {/if}
				<br>
				With Priority
				{if $promotion.priority gt 0}
               		"{$promotion.priority}"
				{else}
					--	
                {/if}								
            </td>
         </tr>
         -->
         <tr>
            <td class="detail_right_td">Comment</td>
			<td class="detail_left_td">
            {if $promotion.comments}{$promotion.comments}{/if}
            </td>
         </tr>
    </table> 
     <div class="biz_center">
      	<input type="hidden" value="{$is_view_promotion}" name="is_view_promotion" data-theme="a"/>
      	<input type="hidden" id="promotion_id" name="promotion_id" value="{$promo_id}"/>
      	<input type="submit"  name="delete" value="Delete" id="cmd_delete{$promo_id}" data-inline="true" data-icon="delete-item" data-theme="a"/>
     	 	<a href="#promotion_form" data-role="button" data-icon="edit" data-inline="true" data-theme="a">Update</a> 
     </div>
</form>
