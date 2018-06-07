<div data-role="page" id="promotion_2_form">
	<div data-role="header">
    {if $other_promo_uniqid}
          <a href="#promotion_2_view" data-role="button">View</a>
    {/if}
			<h4>Promotion #2</h4>
			<a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=all&show_type=PR" data-role="button" data-icon="home" data-iconpos="notext"  rel="external"></a>
	</div>
    <div data-role="content" style="overflow:hidden;">
 	    {include file="$deftpl/promotion/promotion_form.tpl"}
    </div>
    <div data-role="footer">
		<center><a href="#promotion_1_{if $other_promo_uniqid}view{else}form{/if}" data-role="button">Go To Promotion #1</a></center>
	</div>
</div>
