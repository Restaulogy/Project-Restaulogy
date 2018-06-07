<div data-role="popup" id="popupAskCustEmail" data-dismissible="false"  style="width:270px;border:5px solid #333;" data-overlay-theme="f">
	<div data-role="header"> 
		<h1>Reward Email</h1>
	</div>
	<div data-role="content" style="padding:5px;">
		<input type="text" value="" id="ask_cust_email"/>
		<div class="error" id="ask_cust_email_err"></div>
		<center><input type="button" data-icon="save" data-inline="true" onclick="saveCustEmail();" value="{$_lang.save_lbl}"/>
		<input type="button" data-icon="delete" data-inline="true" onclick="$('#popupAskCustEmail').popup('close');location.href='{$website}/user/dashboard.php'" value="{$_lang.cancel_lbl}"/></center>
	</div>
</div> 
