        {if $is_view_promotion_delete}
        	{include file="$deftpl/promotion/promotion_view_delete.tpl"}
		{else}

		{if $is_view_promotion eq 1}
		
             <div class="extra_info">View Or Delete Your Previous Promotions For Your Business.</div>
         
		    {assign var="promotion" value="$user_promotions[0]"}
            {assign var="promo_id" value="1"}
            {include file="$deftpl/promotion/promotion#show_view.tpl"}
         
	   {else}
        
	         <div class="extra_info">*Create Or View Your Promotions For Your Business.</div>


               {assign var="promotion" value="$user_promotions[0]"}
               {assign var="promo_id" value="1"}
               {if $user_promotions[1].id > 0}
                    {assign var="other_promo_uniqid" value=$user_promotions[1].id}
               {else}
                    {assign var="other_promo_uniqid" value=0}
               {/if}

               {*** Promotion Actual Part Start ***}
               {if $user_promotions[0].id}
                    {include file="$deftpl/promotion/promotion#1_view.tpl"}
                    {include file="$deftpl/promotion/promotion#1_form.tpl"}
               {else}
                    {include file="$deftpl/promotion/promotion#1_addform.tpl"}
               {/if}
               {*** Promotion Actual Part End ***}
				
	       {assign var="promotion" value="$user_promotions[1]"}
	       {assign var="promo_id" value="2"}
            {if $user_promotions[0].id > 0}
                    {assign var="other_promo_uniqid" value=$user_promotions[0].id}
            {else}
                    {assign var="other_promo_uniqid" value=0}
            {/if}
            
            {*** Promotion Actual Part Start ***}
            {if $user_promotions[1].id}
                    {include file="$deftpl/promotion/promotion#2_view.tpl"}
                    {include file="$deftpl/promotion/promotion#2_form.tpl"}
            {else}
                    {include file="$deftpl/promotion/promotion#2_addform.tpl"}
            {/if}
            {*** Promotion Actual Part End ***}

 	   {/if}
 	   {/if}
