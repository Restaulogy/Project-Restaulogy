<div id="popNotification" data-role="popup" data-dismissible="false" data-overlay-theme="f" data-theme="a1" style='border:1px solid #FF9600;' >
	<div data-role="header">
		<h2>Notification</h2>
	</div>
	<div data-role="content">
		<span id="pop_notification_txt"></span>
		<br/><br/>
		<center>
			<input type="button" data-inline="true" data-icon="check" value="View" onclick="window.location.href='{$website}/user/tbl_alerts.php';"/>
			 <input type="button" data-inline="true" data-icon="delete" value="{$_lang.cancel_lbl}" onclick="viewlaterNotication();"/>
		</center>
	</div>
</div>
