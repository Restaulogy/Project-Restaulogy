<div data-role="popup" id="popupAskCustName" data-dismissible="false" style="width: 270px;padding:5px;">
	<div data-role="header"> 
		<h1>Customer Name</h1>
	</div>
	<div data-role="content">
		<input type="text" value="" id="ask_cust_name"/>
		<div class="error" id="ask_cust_name_err"></div>
		<center><input type="button" data-icon="save" data-inline="true" onclick="saveCustName();" value="{$_lang.save_lbl}"/>
		<input type="button" data-icon="delete" data-inline="true" onclick="$('#popupAskCustName').popup('close');" value="{$_lang.cancel_lbl}"/></center>
	</div>
</div> 
{literal}
<script type="text/javascript">
 function askCustName(){
	$('#popupAskCustName').popup('open');
	$('#ask_cust_name_err').html('');
	$('#ask_cust_name').html('');
 }
function saveCustName(){
	$('#ask_cust_name_err').html('');
	if(IsNonEmpty($('#ask_cust_name').val())){
		var info = {};
		info['action'] = 'askCustomerName';
		info['var1'] = $('#ask_cust_name').val();
		
		$.ajax({
	        type     : "POST",
	        url      :"{/literal}{$elgg_main_url}{literal}ajax/custom_functions.php" , 
					data		 : info,
					async		 : false,
	        dataType : "json",
	    		success  : function(data) {
						 window.location.reload();
					},error: function(objResponse){
						//alert(objResponse.responseText);
					} 
			
	});
	}else{
		$('#ask_cust_name_err').html('{/literal}{$_lang.messages.validation.not_empty|sprintf:"customer name"}{literal}');
	}
} 
</script>
{/literal}