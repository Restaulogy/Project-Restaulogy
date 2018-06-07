{include file='header.tpl'}

<div class="wrapper">

	<h1>User Loyalty Program</h1>

	<form name='frm_biz_checkins' id="frm_biz_checkins" method="POST" action="{$website}/user/user_loyalty.php" onsubmit="return qck_validatebiz_checkins();" autocomplete="off">
		<div data-role="content" style="padding:5px;">
	        <div class="field-row">
				<label>{$_lang.tbl_staff.label.staff_phone} </label>
	            <input type="text" id="filt_search_phone" name="filt_search_phone" value="{$smarty.request.filphone}" />
	            <div class="error" id="filt_search_phone_err"></div>
			</div>
			
			<div class='biz_center'>		
		        <input id="sb_btn" type="submit" data-icon="save" data-inline="true" value="Look-up"/>	        
				<input type="button" data-icon="delete" data-inline="true" onclick="location.href='{$website}/user/index.php'"  value="{$_lang.cancel_lbl}"/>
	        </div>
		</div>
	</form>
	
</div>

{literal}
<script type="text/javascript">
	function qck_validatebiz_checkins(){
		$("#filt_search_phone_err").html("");
		var isErr = true;
		if(IsNonEmpty(elemById("filt_search_phone").value)==false){
	        $("#filt_search_phone_err").html("{/literal}{$_lang.tbl_staff.not_empty_msg.staff_phone}{literal}");
	        isErr = false;
	    }else{
	      	if(isPhoneNumber(elemById("filt_search_phone").value) == false){
	    	  	$('#filt_search_phone_err').html("Invalid Phone.");
	    		isErr = false;
	      	}
	    }
	    return isErr;
	}
</script>
{/literal}

{include file="footer.tpl"}