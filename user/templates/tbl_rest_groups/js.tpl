{literal}<script type="text/javascript">function deletetbl_rest_groups(varId){	if(varId > 0){		if(confirm("{/literal}{$_lang.tbl_rest_groups.DELETE.CONFIRM_MSG}{literal}")==true){			window.location.href="{/literal}{$page_url}{literal}?action=delete&rstgrp_id="+varId;		}	}}function validatetbl_rest_groups(){	$("#rstgrp_id_err").html("");	$("#rstgrp_group_err").html("");	$("#rstgrp_desc_err").html("");	$("#rstgrp_start_date_err").html("");	$("#rstgrp_end_date_err").html("");	var isErr = true;	if(elemById("action").value=="update"){		if(IsNonEmpty(elemById("rstgrp_id").value)==false){			$("#rstgrp_id_err").html("{/literal}{$_lang.tbl_rest_groups.not_empty_msg.rstgrp_id}{literal}");			isErr = false;		}	}	if(IsNonEmpty(elemById("rstgrp_group").value)==false){		$("#rstgrp_group_err").html("{/literal}{$_lang.tbl_rest_groups.not_empty_msg.rstgrp_group}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("rstgrp_desc").value)==false){		$("#rstgrp_desc_err").html("{/literal}{$_lang.tbl_rest_groups.not_empty_msg.rstgrp_desc}{literal}");		isErr = false;	}/*	if(IsNonEmpty(elemById("rstgrp_start_date").value)==false){		$("#rstgrp_start_date_err").html("{/literal}{$_lang.tbl_rest_groups.not_empty_msg.rstgrp_start_date}{literal}");		isErr = false;	}*//*	if(IsNonEmpty(elemById("rstgrp_end_date").value)==false){		$("#rstgrp_end_date_err").html("{/literal}{$_lang.tbl_rest_groups.not_empty_msg.rstgrp_end_date}{literal}");		isErr = false;	}*/	if(isErr == false){		alert("{/literal}{$_lang.messages.revise_form}{literal}");	}	return isErr;}//..function</script>{/literal}