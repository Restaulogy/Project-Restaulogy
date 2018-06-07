<div data-role="header">

	<a href="#" onclick="window.top.location='{if $profile_link}{$profile_link}{else}{$vs_config.mainurl}/promotionslisting.php?listing_type=all&show_type=PR{/if}';" data-role="button" data-icon="home"  data-iconpos="notext" rel="external"></a>
	<h4>Business Profile</h4>
</div>
<div style="margin-left:50px;" class="extra_info">*Update your business profile </div>
{if $notice != ""}
    	<div class="fail">
        	{$notice}
        </div>
	{/if}
{if $operation != ""}
    	<div class="approved">
        	{$operation}
        </div>
{/if}

