<div data-role="page" id="promotion_1_view">
		<div data-role="header">
		{if $promotion.isExpired eq 1}
   				 <!-- Do not Show anything -->
		{else}
            	<a href="#promotion_1_form" data-role="button">Edit</a>

		{/if}
			<h4>Promotion #1</h4>
			<a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=all&show_type=PR" data-role="button" data-icon="home" data-iconpos="notext"  rel="external"></a>
		</div>
	    <div data-role="content" style="overflow:hidden;">
		    {include file="$deftpl/promotion/promotion_view.tpl"}
        </div>
        <div data-role="footer">
			<center><a href="#promotion_2_{if $other_promo_uniqid}view{else}form{/if}" data-role="button">Go To Promotion #2</a></center>
		</div>
</div>
