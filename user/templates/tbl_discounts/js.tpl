{literal}<script type="text/javascript">function deletetbl_discounts(){ 	var varId = $("input:checked").length;	if(varId > 0){		if(confirm("{/literal}{$_lang.tbl_discounts.DELETE.CONFIRM_MSG}{literal}")==true){				$('#action').val("{/literal}{$smarty.const.ACTION_DELETE}{literal}");			$('#frm_tbl_discounts').submit();		}	}else{		alert("{/literal}{$_lang.main.select_ids.empty}{literal}");	}}function validatetbl_discounts(){	$("#discount_id_err").html("");	$("#discount_name_err").html("");	$("#discount_desc_err").html("");	$("#discount_percent_err").html("");	$("#discount_start_date_err").html("");	$("#discount_end_date_err").html("");	var isErr = true;	if(elemById("action").value=="update"){		if(IsNonEmpty(elemById("discount_id").value)==false){			$("#discount_id_err").html("{/literal}{$_lang.tbl_discounts.not_empty_msg.discount_id}{literal}");			isErr = false;		}	}	if(IsNonEmpty(elemById("discount_name").value)==false){		$("#discount_name_err").html("{/literal}{$_lang.tbl_discounts.not_empty_msg.discount_name}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("discount_desc").value)==false){		$("#discount_desc_err").html("{/literal}{$_lang.tbl_discounts.not_empty_msg.discount_desc}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("discount_percent").value)==false){		$("#discount_percent_err").html("{/literal}{$_lang.tbl_discounts.not_empty_msg.discount_percent}{literal}");		isErr = false;	}else{		if(isFloat(elemById("discount_percent").value)==false){			$("#discount_percent_err").html("{/literal}{$_lang.tbl_discounts.not_valid_msg.discount_percent}{literal}");			isErr = false;		}	}		/*	if(IsNonEmpty(elemById("discount_start_date").value)==false){		$("#discount_start_date_err").html("{/literal}{$_lang.tbl_discounts.not_empty_msg.discount_start_date}{literal}");		isErr = false;	}*//*	if(IsNonEmpty(elemById("discount_end_date").value)==false){		$("#discount_end_date_err").html("{/literal}{$_lang.tbl_discounts.not_empty_msg.discount_end_date}{literal}");		isErr = false;	}*/	if(isErr == false){		alert("{/literal}{$_lang.messages.revise_form}{literal}");	}	return isErr;}//..function</script>{/literal}