{assign var="promo_img_src" value=""}
 {if !($user_promotion[pitm].img_ext)||($user_promotion[pitm].img_ext eq '0')}
    {if $list[itm].logo !=""}
         {assign var="promo_img_src" value=$promo_img_src|cat:"logo/"|cat:$list[itm].logo}
	{else}
         {assign var="promo_img_src" value=$promo_img_src|cat:"templates/"|cat:$deftpl|cat:"/images/nologo.jpg"}
    {/if}
{else}
    {assign var="promo_img_src" value=$promo_img_src|cat:"promotion_images/"|cat:$user_promotion[pitm].id|cat:"."|cat:$user_promotion[pitm].img_ext}
{/if}

    <li>
    <!--<a href="#promo_dialog{$user_promotion[pitm].id}" data-rel="dialog">-->

       
        <table style="font-size:12px;color:#fff;">
            <tr>
				<td rowspan="3" style="vertical-align:top !important;width:35%;">
                    <a href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}" target="_blank"  rel="external"><img src="{$promo_img_src}" style='width:100%;position:relative;'/></a>
				</td>
				 
                <td style="width:65%;vertical-align:top !important;padding-left:5px;">
                  <a href="show.php?show_type=PR&amp;lid={$list[itm].id}&amp;promoid={$user_promotion[pitm].id}" target="_blank"  rel="external">
                    <b style='font-size:11px;'>{$user_promotion[pitm].title}&nbsp;at&nbsp;{$list[itm].firm}</b>:&nbsp;
                  </a>
                </td>
            </tr>
            <tr>
                <td style="width:65%;vertical-align:top !important;padding-left:5px;">{$user_promotion[pitm].start_date|date_format:"%D"}&nbsp;-&nbsp;{$user_promotion[pitm].end_date|date_format:"%D"}</td>
            </tr>
            <tr>
                <td style="width:65%;vertical-align:top !important;padding-left:5px;">#Views :{$user_promotion[pitm].views_count}&nbsp;<b style="color:{$site_color.orange}">{if $user_promotion[pitm].cupon_type  eq 'all_site'}All Site {$_lang.lbl_coupon}{elseif $user_promotion[pitm].cupon_type  eq 'recommendation'}Recommendations {$_lang.lbl_coupon}{elseif $user_promotion[pitm].cupon_type  eq 'survey'}Survey {$_lang.lbl_coupon}{else}{/if}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="vertical-align:top !important">
                   {$list[itm].recommendation_display}
                   <div class="addthis_toolbox addthis_default_style" style="display:inline-block;" >
		<a href="http://www.addthis.com/bookmark.php"
		class="addthis_button_facebook"
		addthis:url="{$elgg_main_url}pg/business_listing/main/show_promotion/{$list[itm].id}/{$user_promotion[pitm].id}"
		addthis:title="{$user_promotion[pitm].title}"
		addthis:description="{$user_promotion[pitm].title}">
		</a>
		<a href="http://www.addthis.com/bookmark.php"
		class="addthis_button_twitter"
		addthis:url="{$elgg_main_url}pg/business_listing/main/show_promotion/{$list[itm].id}/{$user_promotion[pitm].id}"
		addthis:title="{$user_promotion[pitm].title}"
		addthis:description="{$user_promotion[pitm].title}">
		</a>
		<a href="http://www.addthis.com/bookmark.php"
		class="addthis_button_linkedin"
		addthis:url="{$elgg_main_url}pg/business_listing/main/show_promotion/{$list[itm].id}/{$user_promotion[pitm].id}"
		addthis:title="{$user_promotion[pitm].title}"
		addthis:description="{$user_promotion[pitm].title}">
		</a>
	</div>
 
             <a href="{$list[itm].map_link}" target="_blank">{if $list[itm].dist neq 0}<img src="{$elgg_main_url}mod/custom_white_theme/graphics/icons/map_icon.jpg" height="14" />Dist: {$list[itm].dist} miles{/if}</a>
           {if $elgg_current_user || 1}
	 		 
                
                    {if $user_promotion[pitm].is_promo_fav eq 0}
                			<a href="#" onclick='document.location.href="favorite.php?new=1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$vs_current_user.id}"'       style="display:inline-block;" ><img src='{$elgg_small_icon_url}bookmark_add.png'/>Save {$_lang.lbl_coupon}</a>
                	{else}
                			<a href="#" onclick='document.location.href="favorite.php?new=-1&show_type=PR&lid={$user_promotion[pitm].id}&uid={$vs_current_user.id}"'      style="display:inline-block;" ><img src='{$elgg_small_icon_url}bookmark_remove.png'/>Remove From Saved</a>
                	{/if}
                  {if $user_promotion[pitm].cupon_type neq 'none'}
				  
				 
                  {if $user_promotion[pitm].cupon_type neq 'reward'}
				 
                    {if $user_promotion[pitm].coupon.id gt 0}
                       {if $user_promotion[pitm].coupon.is_redimed eq 1}
                               Already Claimed
                       {else}
                        <!--  <a href="coupon.php?redim_id={$user_promotion[pitm].coupon.id}&user_redimed=1"><img src='{$elgg_small_icon_url}bookmark_remove.png'/>Claim Coupon</a> -->
                       {/if}
            		{else}
                         {if $user_promotion[pitm].cupon_type eq 'survey' && $user_promotion[pitm].is_surveyed neq 1}
                        		<a href="{$elgg_main_url}pg/nabopoll/main/?id_txtserch={$list[itm].userid}" target="_blank" title="Survey"><img src="{$elgg_small_icon_url}add.png" alt="Survey"/>To get {$_lang.lbl_coupon} please take survey by business.</a>
                    	 {elseif $user_promotion[pitm].cupon_type eq 'recommendation' && $user_promotion[pitm].is_recommended neq 1}
                         		<a href="#" onclick="PopupCenter('{$elgg_main_url}facebook/recommendation.php?isPopup=1&amp;type=1&amp;bizness_id={$list[itm].id}&amp;is_in_cupobiz=1&amp;biz_text={$list[itm].firm}','',425,350);" title="Recommend"><img src="{$elgg_small_icon_url}add.png" alt="Recommend"/>To get {$_lang.lbl_coupon} please recommend the business.</a>
                    	 {else}
                     			<a href="coupon.php?save=1&promotion_id={$user_promotion[pitm].id}&user_id={$elgg_current_user}"><img src='{$elgg_small_icon_url}bookmark_add.png'/>Claim {$_lang.lbl_coupon}</a>
                    	 {/if}
            	    {/if}
                  {/if}
                 {/if}
               
                   {if $listing_type eq 'post' || $listing_type eq 'reward'  || $elgg_is_admin_user eq 1}
				   
                   {if $vs_current_user.id eq $list[itm].userid || $elgg_is_admin_user eq 1}
                     |&nbsp;<a href='promotion.php?edit=1&id={$user_promotion[pitm].id}' target="_blank" >Edit</a>|&nbsp;<a href='promotion.php?renew=1&id={$user_promotion[pitm].id}' target="_blank" >Renew</a>
					  
                         {if $user_promotion[pitm].cupon_type neq 'none'}
                            |&nbsp;<a href='coupon_statistics.php?promotion_id={$user_promotion[pitm].id}' target="_blank">Statistics</a>
                         {/if}
                     {/if}
                  {/if}
             {/if}
                </td>
            </tr>
        </table>
         
    </li>
