
<table style="font-size:10px;">
    <tr>
		<td>
		{if $user_promotion[pitm].recommendation.count gt 0}
			{$user_promotion[pitm].recommendation.count} people recommended this.&nbsp;<a href='{$elgg_main_url}facebook/recommendation_list.php?post_type=Promotions&post_id={$user_promotion[pitm].id}&post_title={$user_promotion[pitm].title}' target="_blank">view details</a>
	 	{else}
			<!--No Recommendation for this post.-->
		{/if}
		</td>
	</tr>
	{if $user_promotion[pitm].recommendation.count gt 0}
        {assign var=rcmd_friends value=$user_promotion[pitm].recommendation.friends}
    		{if $rcmd_friends}
 	<tr>
		<td>
			<b>Recomedation by your connections :</b><br/>
			{foreach from=$rcmd_friends item=rcmd_friend}
				&nbsp;<a style="clear" href="{$rcmd_friend.url}" target="_blank"><img src="{$rcmd_friend.icon}" height="" width="15"/>{$rcmd_friend.name}</a>
			{/foreach}
		</td>
	</tr>
        {/if}
	{/if}
	<tr>
		<td>
        {if $elgg_current_user}
    		{if $user_promotion[pitm].recommendation.self_recommendation}
            	You Already Recommended.
                {if $user_promotion[pitm].recommendation.user.thanks_count gt 0}
                        {$user_promotion[pitm].recommendation.user.thanks_count} thanks received.
                {/if}
            {else}
             <a href="{$elgg_main_url}facebook/recommendation.php?isPopup=1&type=2&bizness_id={$user_promotion[pitm].id}&is_in_cupobiz=1&biz_text={$user_promotion[pitm].title}" target="_blank" title="Recommend"><img src="{$elgg_small_icon_url}add.png" alt="Recommend"/> Recommend Now</a>

            {/if}
        {/if}
	    </td>
	</tr>
</table>




