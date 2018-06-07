<div id="popupAddToCAL" style="display:none;position:fixed;width:300px;z-index:100;top: 50%;left: 10%;margin-left:-30px;margin-top:-150px;border:1px solid #FF9600;" class='ui-body-a'>
    <div data-role="header" data-theme="a" class="ui-corner-top">
		<h1>Add To Calendar</h1>
	</div>

<div data-role="content" style="padding:5px;">
    <ul data-role="listview" data-inset="true" style="min-width:210px;" >
		    <!-- <li data-role="divider" data-theme="d2">Choose an action</li> -->
			<li><a href="{$showing_promotion.google_cal}" target="_balnk">Google Calendar</a></li>
			<li><a href="{$showing_promotion.yahoo_cal}" target="_balnk">Yahoo Calendar</a></li>
			<li><a href="{$showing_promotion.window_live_cal}" target="_balnk">Windows Live Calendar</a></li>
	</ul>
						
	<div class="biz_center">
    <input type="button" data-icon="delete" data-inline="true" onclick="$('#popupAddToCAL').hide();" value="{$_lang.cancel_lbl}"/>
    </div>
</div>

</div>
