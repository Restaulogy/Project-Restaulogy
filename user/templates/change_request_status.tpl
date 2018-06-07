
<form id='frmAttendRequest' name='frmAttendRequest' method="POST" action="{$page_url}">
	<input type='hidden' name='request_id' id='request_id' value='0'/>
	<input type='hidden' name='action'  value='attend'/>
</form>

<form id='frmCompleteRequest' name='frmCompleteRequest' method="POST" action="{$page_url}">
	<input type='hidden' name='request_id' id='comp_request_id' value='0'/>
	<input type='hidden' name='action'  value='complete'/>
</form>

 

<form id='frmChangeRequestStage' name='frmChangeRequestStage' method="POST" action="{$page_url}">
	<input type='hidden' name='request_id' id='stage_request_id' value='0'/>
	<input type='hidden' name='stage_id' id='stage_id' value='0'/>
	<input type='hidden' name='new_stage_id' id='new_stage_id' value='0'/> 
	<input type='hidden' name='{$smarty.const.MODE_TITLE}' id='{$smarty.const.MODE_TITLE}' value='{$smarty.const.MODE_VIEW}'/>
	<input type='hidden' name='request_type' id='request_type' value='{$smarty.request.request_type}'/>
	<input type='hidden' name='table_id' id='table_id' value='{$smarty.request.table_id}'/>
	<input type='hidden' name='action'  value='change_stage'/>
</form>
{literal}
<script type="text/javascript">
 function attendRequest(request_id){
 	if(is_gt_zero_num(request_id)){
		elemById("request_id").value=request_id;
		elemById("frmAttendRequest").submit();
	}else{
		alert({/literal}"{$_lang.services_requests.non_empty_msg.request}"{literal})
	}
 }
 function completeRequest(request_id){
 	if(is_gt_zero_num(request_id)){
		elemById("comp_request_id").value=request_id;
		elemById("frmCompleteRequest").submit();
	}else{
		alert({/literal}"{$_lang.services_requests.non_empty_msg.request}"{literal})
	}
 }
 function changeRequestStage(request_id,stage_id,new_stage_id){
 	if(is_gt_zero_num(request_id)){
		elemById("stage_request_id").value=request_id;
		elemById("stage_id").value=stage_id;
		vstage = new_stage_id || 0; 
		if(is_gt_zero_num(vstage)){
			elemById("new_stage_id").value=vstage;
		}
		//alert(elemById("stage_request_id").value + " = " + elemById("stage_id").value);
		elemById("frmChangeRequestStage").submit();
	}else{
		alert({/literal}"{$_lang.services_requests.non_empty_msg.request}"{literal})
	}
 } 
</script>
{/literal} 
