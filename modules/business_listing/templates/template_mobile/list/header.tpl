<div data-role="header" data-position="inline">
    <!--<a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=all&show_type={if $ispromotion}PR{else}BL{/if}" data-icon="home" data-iconpos="notext" rel="external" data-role="button"></a>  -->
        <h4 style="font-size:12px;">{$vs_current_listing.firm}
        {if $ispromotion}{$showing_promotion.title}{else}{$vs_current_listing.firm}{/if}
        </h4> 
		<a href="{$elgg_site_url}promotionslisting.php?listing_type=all&show_type=PR" data-icon="home" data-iconpos="notext" rel="external" data-role="button">Close</a> 
</div>

{if $show_msgs AND $show_msgs eq 'sucessful'}
    <div class="approved">
       Successfully voted for this listing
    </div>
{/if}
{if $show_msgs AND $show_msgs eq 'duplicate'}
    <div class="fail">
        Alreday voted for this listing
    </div>
{/if}



