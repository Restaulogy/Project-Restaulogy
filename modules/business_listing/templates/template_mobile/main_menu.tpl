<div id="main_nav">
 	<!-- .nav -->
	<ul class="nav">
	    <li>
	        <a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=1&show_type=PR">{$translations.promotion.listing_title}</a>
	      <ul>
	        <li><a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=1&show_type=PR">{$translations.promotion.listing_title}</a></li>

	        <li><a href='{$vs_config.mainurl}/promotionslisting.php?listing_type=4&show_type=PR' >Promotions Posted By Connections</a></li>
	        <li><a href='{$vs_config.mainurl}/promotionslisting.php?listing_type=5&show_type=PR' >Promotions Posted By Group Members</a></li>
	      </ul>
	    </li>
        <li>
             {if $elgg_user_acct_type=="business" || $elgg_user_acct_type =="social/business organization"}
            <a href={$vs_config.mainurl}/user.php?show_type=PR>My Promotions</a>
            {else}
             <a href={$vs_config.mainurl}/intrested_in.php?show_type=PR>My Promotions</a>
			{/if}
			<ul>
			    {if $elgg_user_acct_type=="business" || $elgg_user_acct_type =="social/business organization"}
                <li><a href="{$vs_config.mainurl}/promotion.php?list_id={if $vs_user_profile_list_id}{$vs_user_profile_list_id}{else}0{/if}" target="_blank">Add/Edit Promotion</a></li>
				<li><a href={$vs_config.mainurl}/user.php?show_type=PR>Promotions Posted By Me</a></li>
				<li><a href={$vs_config.mainurl}/user.php?show_type=PR&history=1>Promotions History</a></li>

            {/if}
            <li><a href={$vs_config.mainurl}/listfavorite.php?show_type=PR>My Favorite Promotions</a></li>
            <li><a href={$vs_config.mainurl}/intrested_search.php>Promotions I&rsquo;m interested in</a></li>
             <li><a href={$vs_config.mainurl}/intrested_in.php?show_type=PR>Set Interested in Criteria</a></li>
			</ul>
		</li>
	<!--
        <li><a href={$vs_config.mainurl}/intrested_in.php?show_type=PR>Interested in</a>
            <ul>
                <li><a href={$vs_config.mainurl}/intrested_search.php>View Promotions</a></li>
                <li><a href={$vs_config.mainurl}/intrested_in.php?show_type=PR>Set Filter Criteria</a></li>
            </ul>
		</li>
    -->
		<li>
            <a href="{$vs_config.mainurl}/promotionslisting.php?listing_type=1&show_type=BL">Business Listing</a>
            <ul>
                <li><a  href="{$vs_config.mainurl}/promotionslisting.php?listing_type=1&show_type=BL">All Business Listing</a></li>
                <li><a href="{$vs_config.mainurl}/listfavorite.php?show_type=BL">My Favorite Businesses</a></li>

            </ul>
        </li>

        {if $elgg_user_acct_type=="business" || $elgg_user_acct_type =="social/business organization"}
        {if $vs_user_profile_list_id}
            <li><a href="{$vs_config.mainurl}/edlist.php?lid={$vs_user_profile_list_id}" target="_blank">Edit Listing</a></li>
        {else}
            <li><a href="{$vs_config.mainurl}/user.php?show_type=BL" target="_blank">Edit My Listing</a></li>
        {/if}


        {/if}

        <li><a href='{$elgg_main_url}pg/UniversalCalendar/index/promotion' target="_blank">Promotion Calendar</a></li>

        {if $vs_config.show_admin or $vs_current_admin.login != ""}
            <li><a href={$vs_config.mainurl}/admin.php>{lang->desc p1='sitemenu' p2=$lang_set p3='admin'}</a></li>
			<li><a href='{$vs_config.mainurl}/admin.php?act=out'>
             	(Admin log Out)
            	</a>
			</li>
		{/if}
		<!--
		<li class="right add_job">
			<a href="#" id="search_top_form_link" onclick="$('#search_top_form_box').slideDown();$('#search_top_form_link').hide();"><img src="templates/{$deftpl}/images/magnifier.png" border="0"/>Quick Search</a>
		</li>
		-->
	</ul>
	<!-- /.nav -->
</div>
