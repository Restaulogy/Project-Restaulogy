<div data-role="popup" id="popupAskCustName" data-dismissible="false"  style="width:270px;border:5px solid #333;" data-overlay-theme="f">
	<div data-role="header"> 
		<h1>Customer Name</h1>
	</div>
	<div data-role="content" style="padding:5px;">
		<input type="text" value="" id="ask_cust_name"/>
		<div class="error" id="ask_cust_name_err"></div>
		<center><input type="button" data-icon="save" data-inline="true" onclick="saveCustName();" value="{$_lang.save_lbl}"/>
		<input type="button" data-icon="delete" data-inline="true" onclick="$('#popupAskCustName').popup('close');" value="{$_lang.cancel_lbl}"/></center>
	</div>
</div> 