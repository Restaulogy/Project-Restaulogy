{**include file='header.tpl'**}
<div class='wrapper'>
 <h2>{$_lang.service_details.title}</h2>

<form id='frmservice_detail' name='frmservice_detail' action='{$website}/user/service_details.php' method="POST">
<input type="hidden" name="service_code" id="dtl_service_code" value="{$tbl_services_codeinfo.srvc_id}"/>
<input type="hidden" name="action" id="dtl_action" value=""/>
{if $service_detailinfo and $result_found gt 0}
	<table class='listTable'>
		<tr>
			<th class='bigListItem' colspan="2">{$_lang.service_details.title}</th>	
		</tr>
	{foreach from=$service_detailinfo item=service}
	 	<tr>
			<td style="width:2%;">
				<label for="sel_service_details[{$service.id}]" data-mini="true" style="width:23px;"><input type="checkbox" data-inline='true' data-mini='true' id="sel_service_details[{$service.id}]" name="sel_service_details[{$service.id}]" />&nbsp;</label>
            </td>
				
			<td class='bigListItem'><a href='#' onclick='updateService({$service.id},"{$service.name}","{$service.desc}",{$service.typeId});' title="{$service.name}">{$service.name|truncate:32}</a><small>{$service.desc|truncate:50}<br>Posted On {$service.friendly_start_date}</small></td>  
			<!--<td class='actionListItem'><a href='#' onclick='updateService({$service.id},"{$service.name}","{$service.desc}",{$service.typeId});' title="Edit Service" class='editIcon'></a><a href='#' onclick='deleteService({$service.id})' class='deleteIcon'  title="Delete Service" ></a></td>-->
		</tr>
	{/foreach}
	</table>
	{if $pagination}
	<center>
		{$pagination}
	</center>
	{/if} 
{else}
	<div class="error">No record found.</div>
{/if}
</form>
<center>
{if $service_detailinfo and $result_found gt 0}
<input data-inline="true" data-icon="briefcase" type="button" id="sel_all_services" name="sel_all_services" value="{$_lang.main.toggle}" onclick="javascript:$('#frmservice_detail input[type=checkbox]').click();" /> 
<input data-inline="true" data-icon="delete" type="button" id="del_sel_all_services" name="del_sel_all_services" value="{$_lang.tbl_table_type.DELETE.BTN_LBL}" onclick="deleteServiceOptions();" /> 
{/if}
	<input data-inline="true" data-icon="add-item" onclick='createService();'type="button" value="{$_lang.service_details.CREATE.BTN_LBL}" /> 
	</center>
<div data-role="popup" id="popupServiceDetail" data-dismissible="false" data-theme="a" data-overlay-theme="g" style="width:270px;">
<form id='frmServiceDetails' name='frmServiceDetails' action='{$website}/user/service_details.php' method="post" onsubmit="return validateServiceDetails();">
<div data-role="header" data-theme="a">
	 <h1 id='actionHeader'></h1> 
</div>
<div data-role="content" style="padding:5px;">
<div class="field-row">
<p><label for="srvc_dtl_name">{$_lang.service_details.label.srvc_dtl_name}</label></p>
<p><input name="srvc_dtl_name" id="srvc_dtl_name" value="{$smarty.post.srvc_dtl_name}"/>
<div class="error" id='srvc_dtl_name_err'></div></p>  
</div><!-- field-row --> 
<div class="field-row">
<p><label for="srvc_dtl_desc">{$_lang.service_details.label.srvc_dtl_desc}</label></p>
<p><textarea name="srvc_dtl_desc" id="srvc_dtl_desc" cols="15" rows="10">{$smarty.post.srvc_dtl_desc}</textarea>
<div class="error" id='srvc_dtl_desc_err'></div></p>  
</div><!-- field-row --> 
<div class="field-row">
<p><label>{$_lang.service_details.label.srvc_dtl_type}</label></p>
<p>
<table>
<tr><td><label><input type="radio" checked="checked" name="isCheckbox" value='1'>{$_lang.service_details.label.srvc_dtl_type_check}</label></td>
<td>&nbsp;</td>
<td><label><input type="radio" name="isCheckbox" value='0'>{$_lang.service_details.label.srvc_dtl_type_text}</label>
</td></tr>
</table> 
<div class="error" id='srvc_dtl_type_err'></div></p>  
</div><!-- field-row --> 
<div class='field-row clearfix'>
<input type='hidden' name='service_code' id='service_code' value='{$tbl_services_codeinfo.srvc_id}'/>
<input type='hidden' name='srvc_dtl_id' id='srvc_dtl_id' value="{$smarty.post.srvc_dtl_id}"/>
<input type='hidden' name='action' id='action' value=''/>
<center>
<input data-inline="true" data-icon="save" type="button" value='{$_lang.service_details.label.submit}' onclick="$('#frmServiceDetails').submit();" class='fleft'/>
 <input type='reset' onclick='cancelService();' data-inline="true" data-icon="delete" value='{$_lang.cancel_lbl}' /></center>
</div>
</div>
</form>  
</div>
</div>
{literal}
<script type='text/javascript'>
function clearService(){
	elemById("srvc_dtl_id").value ="";
	elemById("srvc_dtl_name").value ="";  
  	$('#srvc_dtl_desc').val("");
    $("input[name='isCheckbox'][value='1']").attr("checked", "checked");
}
function cancelService(){
	clearService();
	$('#popupServiceDetail').popup('close');
	$('#newService').show();
}
function createService(){ 

	$('#popupServiceDetail').popup('open');
	$('#newService').hide();
	clearService();
	$('#action').val("create");
	$('#actionHeader').html("{/literal}{$_lang.service_details.CREATE.header}{literal}").trigger('create'); 
} 
function updateService(id,name,desc,type){
	$('#popupServiceDetail').popup('open');
	$('#newService').hide();
  elemById("srvc_dtl_id").value =id;
  elemById("srvc_dtl_name").value =name;  
  $('#srvc_dtl_desc').val(desc);
  $('#action').val("update");
  $('#actionHeader').html("{/literal}{$_lang.service_details.UPDATE.header}{literal}").trigger('create'); 
   $("input[name='isCheckbox'][value='"+ type +"']").attr("checked", "checked");
   
}

function deleteServiceOptions(){
 var varId = $("#frmservice_detail input:checked").length;
	if(varId > 0){
		if(confirm("{/literal}{$_lang.tbl_table_type.DELETE.CONFIRM_MSG}{literal}")==true){	
			$('#dtl_action').val("{/literal}{$smarty.const.ACTION_DELETE}{literal}");
			$('#frmservice_detail').submit();
		}
	}else{
		alert("{/literal}{$_lang.main.select_ids.empty}{literal}");
	}
}
 
function validateServiceDetails(){
   var isErr = true;
	$('#srvc_dtl_name_err').html("");
  	$('#srvc_dtl_desc_err').html("");
	$('#srvc_dtl_type_err').html(""); 
	
   if(IsNonEmpty(elemById("srvc_dtl_name").value) == false){
 
  	$('#srvc_dtl_name_err').html("{/literal}{$_lang.service_details.not_empty_msg.srvc_dtl_name}{literal}");
	isErr = false;
  }
  
   if(IsNonEmpty($('#srvc_dtl_desc').val()) == false){
 
  	$('#srvc_dtl_desc_err').html("{/literal}{$_lang.service_details.not_empty_msg.srvc_dtl_desc}{literal}");
	isErr = false;
  }
  
   if(IsNonEmpty(elemRadioCheckedValue("isCheckbox")) == false){ 
  	$('#srvc_dtl_type_err').html("{/literal}{$_lang.service_details.not_empty_msg.srvc_dtl_type}{literal}");
	isErr = false;
  }
  if($('#action').val()=='UPDATE'){
 
	  if(IsNonEmpty(elemById("srvc_dtl_id").value) == false){
	  	$('#srvc_dtl_id_err').html("{/literal}{$_lang.service_details.non_empty_msg.id}{literal}");
		isErr = false;
	  }
  } 
  
   if(isErr == false){
   	 alert("{/literal}{$_lang.messages.revise_form}{literal}");
   }
	
  return isErr; 
}
</script>
{/literal}

{**include file='footer.tpl'**}
