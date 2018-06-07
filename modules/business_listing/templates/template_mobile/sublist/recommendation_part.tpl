<table style="font-size:10px;">
    <tr>
		<td>
		{if $list[itm].recommendation.count gt 0}
			{$list[itm].recommendation.count} people recommended this.<a href='{$elgg_main_url}facebook/recommendation_list.php?post_type=Business&post_id={$list[itm].id}&post_title={$list[itm].firm}' target="_blank">view details</a>
	 	{else}
			<!--No Recommendation for this post.-->
		{/if}
		</td>
	</tr>
	{if $list[itm].recommendation.count gt 0}
        {assign var=rcmd_friends value=$list[itm].recommendation.friends}
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
    		{if $list[itm].recommendation.self_recommendation}
            	You Already Recommended.
                {if $list[itm].recommendation.user.thanks_count gt 0}
                        {$list[itm].recommendation.user.thanks_count} thanks received.
                {/if}
            {else}
            	<a href="{$elgg_main_url}facebook/recommendation.php?isPopup=1&type=1&bizness_id={$list[itm].id}&is_in_cupobiz=1&biz_text={$list[itm].firm}" target="_blank" title="Recommend" ><img src="{$elgg_small_icon_url}add.png" alt="Recommend"/> Recommend Now</a>
            {/if}
        {/if}
	    </td>
	</tr>
</table>


