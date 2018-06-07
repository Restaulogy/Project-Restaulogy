<div id="div_add_this_{$user_promotion[pitm].id}" style="display:none;position:fixed;width:230px;z-index:100;top: 50%;left: 10%;margin-left:0px;margin-top:-150px;border:1px solid #FF9600;" class='ui-body-a'>
    <div data-role="header" data-theme="a" class="ui-corner-top">
		<h1>Share With</h1>
	</div>

    <div data-role="content" style="padding:5px;">
      <div class="addthis_toolbox addthis_default_style addthis_32x32_style" >
		<p>
		Thank you for sharing with facebook.<br><br>
		
		<a href="http://www.addthis.com/bookmark.php"
		class="addthis_button_facebook"
		addthis:url="{$elgg_site_url}show.php?show_type=PR&lid={$list[itm].id}&promoid={$user_promotion[pitm].id}"
        addthis:title="{$user_promotion[pitm].title|truncate:30}"
		addthis:description="{$user_promotion[pitm].title}" style='text-decoration:none;color:white !important;'> &nbsp;&nbsp;FACEBOOK
		</a>
		</a>
		<!--
		<a href="http://www.addthis.com/bookmark.php"
		class="addthis_button_twitter"
		addthis:url="{$elgg_site_url}show.php?show_type=PR&lid={$list[itm].id}&promoid={$user_promotion[pitm].id}"
		addthis:title="{$user_promotion[pitm].title|truncate:30}"
		addthis:description="{$user_promotion[pitm].title}">
		</a>
		<a href="http://www.addthis.com/bookmark.php"
		class="addthis_button_linkedin"
		addthis:url="{$elgg_site_url}show.php?show_type=PR&lid={$list[itm].id}&promoid={$user_promotion[pitm].id}"
        addthis:title="{$user_promotion[pitm].title|truncate:30}"
		addthis:description="{$user_promotion[pitm].title}">
		</a>
		-->
		</p>
    </div>
    <br>
	<div class="biz_center">
        <input type="button" data-icon="delete" data-inline="true" onclick="$('#div_add_this_{$user_promotion[pitm].id}').hide();" value="{$_lang.cancel_lbl}"/>
    </div>
   </div>

</div>
