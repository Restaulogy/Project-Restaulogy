{literal}<script type="text/javascript">function deletetbl_services_code(varId){	if(varId > 0){		if(confirm("{/literal}{$_lang.tbl_services_code.DELETE.CONFIRM_MSG}{literal}")==true){			window.location.href="{/literal}{$page_url}{literal}?action=delete&srvc_id="+varId;		}	}}function validatetbl_services_code(){	$("#srvc_id_err").html("");	$("#srvc_name_err").html("");	$("#srvc_description_err").html("");	/*$("#srvc_by_restrnt_or_cust").html("");*/	$("#srvc_attend_time_limit_err").html("");	$("#srvc_provide_time_limit_err").html("");	 	var isErr = true; 	if(IsNonEmpty(elemById("srvc_id").value)==false){		$("#srvc_id_err").html("{/literal}{$_lang.tbl_services_code.not_empty_msg.srvc_id}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("srvc_name").value)==false){		$("#srvc_name_err").html("{/literal}{$_lang.tbl_services_code.not_empty_msg.srvc_name}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("srvc_description").value)==false){		$("#srvc_description_err").html("{/literal}{$_lang.tbl_services_code.not_empty_msg.srvc_description}{literal}");		isErr = false;	}	/*if(IsNonEmpty(elemById("srvc_by_restrnt_or_cust").value)==false){		$("#srvc_by_restrnt_or_cust_err").html("{/literal}{$_lang.tbl_services_code.not_empty_msg.srvc_by_restrnt_or_cust}{literal}");		isErr = false;	}*/	if(IsNonEmpty(elemById("srvc_attend_time_limit").value)==false){		$("#srvc_attend_time_limit_err").html("{/literal}{$_lang.tbl_services_code.not_empty_msg.srvc_attend_time_limit}{literal}");		isErr = false;	}else{		if(isInt(elemById("srvc_attend_time_limit").value)==false){		 	$("#srvc_attend_time_limit_err").html("{/literal}{$_lang.messages.validation.isInt}{literal}");		 	isErr = false;		 }else{		 	 if(((elemById("srvc_attend_time_limit").value >= 2)&& (elemById("srvc_attend_time_limit").value <= 100))==false){			 $("#srvc_attend_time_limit_err").html("{/literal}{$_lang.messages.validation.range|sprintf:2:100}{literal}"); 			 isErr = false;			 }		 }	}	if(IsNonEmpty(elemById("srvc_provide_time_limit").value)==false){		$("#srvc_provide_time_limit_err").html("{/literal}{$_lang.tbl_services_code.not_empty_msg.srvc_provide_time_limit}{literal}");		isErr = false;	}else{		if(isInt(elemById("srvc_provide_time_limit").value)==false){		 	$("#srvc_provide_time_limit_err").html("{/literal}{$_lang.messages.validation.isInt}{literal}");		 	isErr = false;		 }else{		 	 if(((elemById("srvc_provide_time_limit").value >= 2)&& (elemById("srvc_provide_time_limit").value <= 100))==false){			 $("#srvc_provide_time_limit_err").html("{/literal}{$_lang.messages.validation.range|sprintf:2:100}{literal}"); 			 isErr = false;			 }		 }	}	/*if(IsNonEmpty(elemById("srvc_start_date").value)==false){		$("#srvc_start_date_err").html("{/literal}{$_lang.tbl_services_code.not_empty_msg.srvc_start_date}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("srvc_end_date").value)==false){		$("#srvc_end_date_err").html("{/literal}{$_lang.tbl_services_code.not_empty_msg.srvc_end_date}{literal}");		isErr = false;	}*/	if(isErr == false){		alert("{/literal}{$_lang.messages.revise_form}{literal}");	}	return isErr;}//..function</script>{/literal}