<li>
    <!--onclick="window.open('show.php?lid={$list[itm].id}&amp;show_type=BL');" id="heading">-->
    <p>
      <table style='margin:0px;font-size:10px;width:100%;position:relative;'>
        <tr>
		    <td rowspan="3" style="width:35%;vertical-align:top !important;">
		    <a href="{$list[itm].buss_prof_link}?view=mobile" target="_blank"  rel="external">
            {if $list[itm].logo != ""}
			     <img src="logo/{$list[itm].logo}" style="width:100%;"/>
    		{else}
    		    <img src="templates/{$deftpl}/images/nologo.jpg" style="width:100%;"/>
    		{/if}
    		</a>
			</td>
			<td style="width:65%;vertical-align:top !important;">
                <a href="{$list[itm].buss_prof_link}?view=mobile" target="_blank"  rel="external"><b style='font-size:11px;'>{$list[itm].firm}</b>&nbsp;</a>
            </td>
        </tr>
        <tr>
            <td style="width:65%;vertical-align:top !important;">
				{$list[itm].states}-{$list[itm].metro_area_name}
			</td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align:top !important">
                {$list[itm].recommendation_display}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:100%;vertical-align:top !important;">
                <div class="addthis_toolbox addthis_default_style" style="display:inline-block;">
					<a href="http://www.addthis.com/bookmark.php"
					class="addthis_button_facebook"
					addthis:url="{$elgg_main_url}pg/business_listing/main/show_business/{$list[itm].id}"
					addthis:title="{$list[itm].firm}"
					addthis:description="{$list[itm].firm}">
					</a>
					<a href="http://www.addthis.com/bookmark.php"
					class="addthis_button_twitter"
					addthis:url="{$elgg_main_url}pg/business_listing/main/show_business/{$list[itm].id}"
					addthis:title="{$list[itm].firm}"
					addthis:description="{$list[itm].firm}">
					</a>
					<a href="http://www.addthis.com/bookmark.php"
					class="addthis_button_linkedin"
					addthis:url="{$elgg_main_url}pg/business_listing/main/show_business/{$list[itm].id}"
					addthis:title="{$list[itm].firm}"
					addthis:description="{$list[itm].firm}">
					</a>
				</div>
                {if $list[itm].dist neq 0}<a href="{$list[itm].map_link}" target="_blank"><img src="{$elgg_main_url}mod/custom_white_theme/graphics/icons/map_icon.jpg" height="14" />Dist: {$list[itm].dist} miles</a>{/if}

                {if $elgg_current_user}
                    {if $list[itm].favorites eq 0}
            			<a href="#" onclick='document.location.href="favorite.php?new=1&show_type=BL&lid={$list[itm].id}&uid={$vs_current_user.id}"'>
            				<img src='{$elgg_small_icon_url}bookmark_add.png'/>Add Business As Favorite
            			</a>
            		{else}
            			<a href="#" onclick='document.location.href="favorite.php?new=-1&show_type=BL&lid={$list[itm].id}&uid={$vs_current_user.id}"'>
            				<img src='{$elgg_small_icon_url}bookmark_remove.png'/>Remove Business From Favorite
            			</a>
            		{/if}
               {/if}
            </td>
        </tr>
    </table>
    </p>
</li>
