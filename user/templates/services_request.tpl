{include file="header.tpl"}
<!--<div class="rightbox ui-btn-hover-e ui-btn-corner-all">{$dininginfo.number}</div> -->
<div class="wrapper">

<h1>{$_lang.services_requests.new_request}</h1>

{include file="customer_nav.tpl"}
{if $error_msg}
	{$error_msg}
{/if}

{if $dininginfo && $dininginfo.id gt 0} 	
	 <form id="FrmServiceRequest" action="{$website}/user/services_request.php" method="post" name="FrmServiceRequest" onsubmit="return validateServiceRequest();">	 
 
<!--<div class="field-row">
<p><label>{$_lang.services_requests.label.table}:</label></p>
 <h4>{$dininginfo.number}</h4>
</div>-->

<div class="field-row">
<p><label>{$_lang.services_requests.label.service}{$_lang.mandotory_mark}:</label></p>
<p> 
	<select name="service_id" id="service_id" onclick='getSubServices(this.value);'>
	<option value="">Please Select Table Service </option>
	{if $services}
	   {foreach from=$services key=id item=service}
		<option value="{$id}" {if $service_id eq $id}selected="selected"{/if}>{$service}</option>
	   {/foreach}
	{/if}
	</select>
</p>
{if $sub_services_count gt 0 && $sub_services}
<div class="field-row">
<!-- <p><label>{$_lang.services_requests.label.sub_service}:</label></p> -->
</div>
	{foreach from=$sub_services item=sub_service}
	<div class="field-row">
	 
	{if $sub_service.typeId eq 1}
		<p><label for="sub_srvc_{$sub_service.id}"><input type="checkbox" name='sub_srvc_{$sub_service.id}' value='1'/>{$sub_service.name}</label></p>
	{else}
		<p><label>{$sub_service.name}</label></p>
		<p><input type="text" name='sub_srvc_{$sub_service.id}' id='sub_srvc_{$sub_service.id}'/></p> 
	{/if}
	</div>
	{/foreach}
{/if}
<div class="error" id='service_err'></div>

{if 0 && $srvice_add_qustions_cnt gt 0 && $srvice_add_qustions}
	<div class="status_box" >
		<p><label>{$_lang.services_requests.label.srvc_reqst_prev_add_quests}:</label></p>		<div class="field-row" style="height:60px;overflow-y:auto;">
		{foreach from=$srvice_add_qustions item=each_qst}			 
			{if $each_qst.srvc_reqst_add_quests neq ""}
				<p><b style='font-weight: bold !important;font-style: normal;'>{$each_qst.srvc_reqst_add_quests}</b>...{$each_qst.friendly_created_on} by {$each_qst.srvc_reqst_created_by} </p>
				<hr>	
			{/if}				
		{/foreach}
		</div>
	</div>
{/if}

</div>

<div class="field-row">
	<p><label>{$_lang.services_requests.label.created_by}{$_lang.mandotory_mark}:</label></p>
	<p><input type="text" name="created_by" value="{$created_by}" id="created_by"/>
	<div class="error" id='created_by_err'></div>
	</p>
</div>
<div class="field-row" style="display:none;">
    <p><label>{$_lang.services_requests.label.srvc_reqst_add_quests}:</label>
    </p>
    <p><textarea type="text" name="srvc_reqst_add_quests" id="srvc_reqst_add_quests" >{$srvc_reqst_add_quests}</textarea>
    <div class="error" id='srvc_reqst_add_quests_err'></div>
    </p>
</div>

 <div class="field-row" >
    <p><label>{$_lang.services_requests.label.srvc_reqst_special_note}:&nbsp;&nbsp;<a href="#" onclick="hide_show_sp_note();"><img id="img_sp_note" src="{$website}/images/_graphics/hide.gif"></a></label></p>
    <p><textarea type="text" name="srvc_reqst_special_note" id="srvc_reqst_special_note" style="display: block;">{$srvc_reqst_special_note}</textarea>
    <div class="error" id='srvc_reqst_special_note_err'></div>
    </p>
</div>
<small class="notice">{$_lang.messages.mandatory_fields}</small><br />
<!--
    <div class="field-row clearfix">
    <p><label class="fleft">{$_lang.services_requests.label.or}&nbsp;&nbsp;</label><input class="fleft" type="button" onclick="createNewService();"  value="Create Service"/></p>
    </div>
-->

	<div class="field-row clearfix">
<center>
<input type='hidden' name="action" value="create"/>
<input type='hidden' name="table_id" id="table_id" value="{$dininginfo.id}"/>
<input data-inline="true" data-icon="save" type="submit" value="Send Request"/>
<input data-inline="true" data-icon="delete"  type="button" value="Cancel" onclick="window.location.href='{$website}/user/dashboard.php?table_id={$dininginfo.id}';"/>
</center>
</div><!-- field-row --> 

 
 	</form>
	
 {literal}
 <script type="text/javascript">
 
 function getSubServices(service_id){
  if((service_id > 0) && (service_id != {/literal}{$service_id}{literal})){
  	window.location.href = "{/literal}{$website}{literal}/user/services_request.php?table_id="+ elemById("table_id").value +"&service_id=" + service_id;	
  } 
 }
function validateServiceRequest(){
	var isErr = true;
	$('#service_err').html("");
	$('#created_by_err').html("");

	if(IsNonEmpty(elemById("service_id").value) == false){
		$('#service_err').html({/literal}"{$_lang.services_requests.non_empty_msg.service}"{literal});
		isErr = false;
	}
	
	 if(IsNonEmpty(elemById("created_by").value) == false){
		$('#created_by_err').html({/literal}"{$_lang.services_requests.non_empty_msg.created_by}"{literal});
		isErr = false;
	}  

	if(isErr == false){
		alert("Please Revise the form");
	} 
	return isErr;
}

function createNewService(){
   var vtable_id = elemById("table_id").value;
   var vcreated_by = elemById("created_by").value;
   window.location.href="service_code.php?mode=new&bycust=1&table_id=" + vtable_id + "&created_by=" + vcreated_by;
	 
}

function hide_show_sp_note(){
    var state = document.getElementById("srvc_reqst_special_note").style.display;
    if(state == 'block'){
        document.getElementById("srvc_reqst_special_note").style.display = 'none';
        document.getElementById("img_sp_note").src="{/literal}{$website}{literal}/images/_graphics/show.gif";
    }else{
        document.getElementById("srvc_reqst_special_note").style.display = 'block';
        document.getElementById("img_sp_note").src="{/literal}{$website}{literal}/images/_graphics/hide.gif";
    }
}

 </script>
{/literal}
{else}
	<div class="error">No record found.</div>
{/if}
</div>
{include file="footer.tpl"}
