<div id="div_add_this" style="display:none;position:fixed;width:200px;z-index:100;top:50%;left: 10%;margin-left:0px;margin-top:-150px;border:1px solid #FF9600;" class='ui-body-a'>
    <div data-role="header" data-theme="a" class="ui-corner-top">
		<h1>Share With</h1>
	</div>

    <div data-role="content" style="padding:5px;">
        <div class="addthis_toolbox addthis_default_style addthis_32x32_style" data-theme="a" data-overlay-theme="a" >

		<p>
		Thank you for sharing with facebook.<br><br>
		<!--
        <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
        <small style='font-size:11px !important;font-weight:bold !important;'><b>Share :</b></small>
        <br><br>
        -->
		
		<a href="http://www.addthis.com/bookmark.php"
		class="addthis_button_facebook"
		addthis:url="{$elgg_site_url}show.php?show_type=PR&lid={$vs_current_listing.id}&promoid={$vPromotion.id}"
        addthis:title="{$vPromotion.title|truncate:30}"
		addthis:description="{$vPromotion.title}" style='text-decoration:none;'> &nbsp;&nbsp;FACEBOOK
		</a>
		<!--
		<a href="http://www.addthis.com/bookmark.php"
		class="addthis_button_twitter"
		addthis:url="{$elgg_site_url}show.php?show_type=PR&lid={$vs_current_listing.id}&promoid={$vPromotion.id}"
		addthis:title="{$vPromotion.title|truncate:30}"
		addthis:description="{$vPromotion.title}">
		</a>
		<a href="http://www.addthis.com/bookmark.php"
		class="addthis_button_linkedin"
		addthis:url="{$elgg_site_url}show.php?show_type=PR&lid={$vs_current_listing.id}&promoid={$vPromotion.id}"
        addthis:title="{$vPromotion.title|truncate:30}"
		addthis:description="{$vPromotion.title}">
		</a>
		-->
		</p>
	</div>
    <br>
    	<div class="biz_center">
            <input type="button" data-icon="delete" data-inline="true" onclick="$('#div_add_this').hide();" value="{$_lang.cancel_lbl}"/>
        </div>
    </div>

</div>
