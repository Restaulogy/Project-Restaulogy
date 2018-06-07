<table id="promotion_listing_right_side_button">
    <tr>
		<td>{if $user_promotion[pitm].cupon_type neq 'none'}
            {if $user_promotion[pitm].coupon.id gt 0}
                {if $user_promotion[pitm].coupon.is_redimed eq 1}
                       Already Redeemed
                {else}
                 <a href="coupon.php?redim_id={$user_promotion[pitm].cupon.id}&user_redimed=1"><img src='{$elgg_small_icon_url}bookmark_remove.png'/>Redeem {$_lang.lbl_coupon}</a>
                {/if}
    		{else}
              {$user_promotion[pitm].coupon.id}
                {if $user_promotion[pitm].cupon_type eq 'survey' && $user_promotion[pitm].is_surveyed neq 1}
                    <b style="color:{$site_color.orange}">To get {$_lang.lbl_coupon} please take survey by business.</b>
                {elseif $user_promotion[pitm].cupon_type eq 'recommendation' && $user_promotion[pitm].is_recommended neq 1}
                    <b style="color:{$site_color.orange}">To get {$_lang.lbl_coupon} please recommend the business.</b>
                {else}
                 <a href="coupon.php?save=1&promotion_id={$user_promotion[pitm].id}&user_id={$elgg_current_user}"><img src='{$elgg_small_icon_url}bookmark_add.png'/>Save {$_lang.lbl_coupon}</a>
                {/if}
    		{/if}

        {else}
    		{if $user_promotion[pitm].is_promo_fav eq 0}
    			<a href="#" onclick='document.location.href="favorite.php?new=1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$vs_current_user.id}"'>
    				<img src='{$elgg_small_icon_url}bookmark_add.png'/>
        Save Promotion
    			</a>
    		{else}
    			<a href="#" onclick='document.location.href="favorite.php?new=-1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$vs_current_user.id}"'>
    				<img src='{$elgg_small_icon_url}bookmark_remove.png'/>
        Remove From Saved
    			</a>
    		{/if}
     	{/if}
	    </td>
	</tr>
	<tr>
		<td>
		    <a href="#" onclick="window.open('contact.php?lid={$list[itm].id}');">
				<img src='{$elgg_small_icon_url}mail_new.png'/>
				{lang->desc p1='contact' p2=$lang_set p3='contact_link'}
			</a>
		</td>
	</tr>
	<tr>
		<td>
		    <a href="#" onclick="window.open('contact.php?lid={$list[itm].id}&act=refer');">
				<img src='{$elgg_small_icon_url}add_user.png'/>
				{lang->desc p1='contact' p2=$lang_set p3='refer_link'}
			</a>
		</td>
	</tr>
	<tr>
		<td>
		    <a href="#" onclick="window.open('sharewith.php?promotion_id={$list[itm].id}&promotion_title={$user_promotion[pitm].simple_title}');">
				<img src='{$elgg_small_icon_url}add_connection.png'/>
				Share This Promotion
			</a>
		</td>
	</tr>
</table>
