{literal}<script type="text/javascript">function deletetbl_ord_paypal_trans(varId){	if(varId > 0){		if(confirm("{/literal}{$_lang.tbl_ord_paypal_trans.DELETE.CONFIRM_MSG}{literal}")==true){			window.location.href="{/literal}{$page_url}{literal}?action=delete&paypal_id="+varId;		}	}}function validatetbl_ord_paypal_trans(){	$("#paypal_id_err").html("");	$("#paypal_txn_id_err").html("");	$("#paypal_txn_amnt_err").html("");	$("#paypal_payment_id_err").html("");	$("#paypal_refund_type_err").html("");	$("#paypal_refund_complete_err").html("");	$("#paypal_start_date_err").html("");	$("#paypal_end_date_err").html("");	var isErr = true;	if(elemById("action").value=="update"){		if(IsNonEmpty(elemById("paypal_id").value)==false){			$("#paypal_id_err").html("{/literal}{$_lang.tbl_ord_paypal_trans.not_empty_msg.paypal_id}{literal}");			isErr = false;		}	}	if(IsNonEmpty(elemById("paypal_txn_id").value)==false){		$("#paypal_txn_id_err").html("{/literal}{$_lang.tbl_ord_paypal_trans.not_empty_msg.paypal_txn_id}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("paypal_txn_amnt").value)==false){		$("#paypal_txn_amnt_err").html("{/literal}{$_lang.tbl_ord_paypal_trans.not_empty_msg.paypal_txn_amnt}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("paypal_payment_id").value)==false){		$("#paypal_payment_id_err").html("{/literal}{$_lang.tbl_ord_paypal_trans.not_empty_msg.paypal_payment_id}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("paypal_refund_type").value)==false){		$("#paypal_refund_type_err").html("{/literal}{$_lang.tbl_ord_paypal_trans.not_empty_msg.paypal_refund_type}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("paypal_refund_complete").value)==false){		$("#paypal_refund_complete_err").html("{/literal}{$_lang.tbl_ord_paypal_trans.not_empty_msg.paypal_refund_complete}{literal}");		isErr = false;	}/*	if(IsNonEmpty(elemById("paypal_start_date").value)==false){		$("#paypal_start_date_err").html("{/literal}{$_lang.tbl_ord_paypal_trans.not_empty_msg.paypal_start_date}{literal}");		isErr = false;	}*//*	if(IsNonEmpty(elemById("paypal_end_date").value)==false){		$("#paypal_end_date_err").html("{/literal}{$_lang.tbl_ord_paypal_trans.not_empty_msg.paypal_end_date}{literal}");		isErr = false;	}*/	if(isErr == false){		alert("{/literal}{$_lang.messages.revise_form}{literal}");	}	return isErr;}//..function</script>{/literal}