{literal}<script type="text/javascript">function actiontbl_cust_filter_email(action){	var varId = $("input:checked").length;	var isValid = 0;	if(varId > 0){	if(action != ""){		switch (action) {			case '{/literal}{$smarty.const.ACTION_DELETE}{literal}':			     if(confirm("{/literal}{$_lang.tbl_server_pin.DELETE.CONFIRM_MSG}{literal}")==true){					isValid = 1;				 }			break;			case '{/literal}{$smarty.const.ACTION_DEACTIVATE}{literal}':			         isValid = 1;			break;			case '{/literal}{$smarty.const.ACTION_ACTIVATE}{literal}':					isValid = 1;			break;		}		if(isValid){		 	$('#action').val(action);		    $('#frm_tbl_cust_filter_email').submit();		}	} }else{			alert("{/literal}{$_lang.main.select_ids.empty}{literal}"); }}function show_hide_preview(is_show){  if(is_show){     $('#email_body_content').html($('#sms_msg').val());     $('#popup_email_preview').popup('open');  }}function textCounter(field,field2,maxlimit){     var countfield = document.getElementById(field2);     if ( field.value.length > maxlimit ) {      field.value = field.value.substring( 0, maxlimit );      return false;     } else {      countfield.value = maxlimit - field.value.length;     }}function fill_prom_text(){        var txt_des = $('#sms_msg');        var txt_sms_text_msg = $('#sms_text_msg');        var txt_email_preview = $('#email_preview');        if (document.getElementById('prom_id').value >0 ){            txt_des.empty();        	//city.attr("disabled", true);			var info = {};			info['action'] = "getPromDetails";			info['var1'] = document.getElementById('prom_id').value;						if(elemById("tab_email").checked){                info['var2'] = 'email';            }else{                info['var2'] = 'sms';            }			$.ajax({	        type     : "POST",	        url      : website + "/ajax/custom_functions.php" ,			data	 : info,	        dataType : "json",			async	 : false,	    	success  : function(response){                  if(response){                    if(elemById("tab_email").checked){                        txt_des.html(response.comments);                        txt_email_preview.html(response.email_preview);                        txt_sms_text_msg.html('');                    }else{                        txt_des.html('');                        txt_sms_text_msg.html(response.sms_txt);                        txt_email_preview.html('');                        //textCounter(txt_sms_text_msg,'counter',125);                        $('#counter').val(125-response.sms_txt.length);                        $('#counter').trigger('create');                    }                  }                },			error: function(objResponse){				//alert(objResponse.responseText);			}		});		return false;       }else{         txt_des.html($('#rest_name').val());         txt_sms_text_msg.html($('#rest_name').val());         txt_email_preview.html($('#rest_name').val());         return true;       } }function open_prom_sel_dialogue(is_email_sms){    if(is_email_sms=='email'){        $('#hid_action').val('SEND_EMAIL');    }else{        $('#hid_action').val('SEND_SMS');    }    showSMS(is_email_sms);}function showhidexval(){    if($('#cfe_filter').val()=='birthday'){        $('#div_cfe_value').hide();    }else{        $('#div_cfe_value').show();    }}function showSMS(show){    if(show=='sms'){      $("#sms_part").show();      $("#email_part").hide();      $("#btn_previe_t").hide();    }else{      $("#sms_part").hide();      $("#email_part").show();      $("#btn_previe_t").show();    }}function validate_email_sms_form(){    var isErr = true;    $('#sms_text_msg_err').val('');    $('#prom_id_err').val('');    if(elemById("action").value=='SEND_SMS'){        if(IsNonEmpty(elemById("sms_text_msg").value)==false){            $("#sms_text_msg_err").html("{/literal}{$_lang.tbl_crm.not_empty_msg.sms_msg}{literal}");            isErr = false;        }    }else if(elemById("action").value=='SEND_EMAIL'){        if(IsNonEmpty(elemById("sms_msg").value)==false){            $("#sms_msg_err").html("{/literal}{$_lang.tbl_crm.not_empty_msg.sms_msg}{literal}");            isErr = false;        }    }else{         isErr = false;    }    return isErr;}function deletetbl_cust_filter_email(varId){	if(varId > 0){		if(confirm("{/literal}{$_lang.tbl_cust_filter_email.DELETE.CONFIRM_MSG}{literal}")==true){			window.location.href="{/literal}{$page_url}{literal}?action=delete&cfe_id="+varId;		}	}}function validatetbl_cust_filter_email(){	$("#cfe_id_err").html("");	$("#cfe_filter_err").html("");	$("#cfe_value_err").html("");	$("#cfe_promotion_err").html("");	$("#cfe_mesasge_err").html("");	$("#cfe_email_or_sms_err").html("");	$("#cfe_period_start_err").html("");	$("#cfe_period_end_err").html("");	$("#cfe_restaurant_err").html("");	$("#cfe_start_date_err").html("");	$("#cfe_end_date_err").html("");		$('#sms_msg_err').val('');	$('#sms_text_msg_err').val('');    $('#prom_id_err').val('');    	var isErr = true;	if(elemById("action").value=="update"){		if(IsNonEmpty(elemById("cfe_id").value)==false){			$("#cfe_id_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_id}{literal}");			isErr = false;		}	}	if(IsNonEmpty(elemById("cfe_filter").value)==false){		$("#cfe_filter_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_filter}{literal}");		isErr = false;	}else{        if(elemById("cfe_filter").value =='not_visited' || elemById("cfe_filter").value =='total_point' || elemById("cfe_filter").value =='visited'){        	if(IsNonEmpty(elemById("cfe_value").value)==false){        		$("#cfe_value_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_value}{literal}");        		isErr = false;        	}        	        	if(IsNumeric(elemById("cfe_value").value)==false){    			$("#cfe_value_err").html("{/literal}Only numeric allowed.{literal}");    			isErr = false;    		}    	}	}/*	if(IsNonEmpty(elemById("cfe_promotion").value)==false){		$("#cfe_promotion_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_promotion}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("cfe_mesasge").value)==false){		$("#cfe_mesasge_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_mesasge}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("cfe_email_or_sms").value)==false){		$("#cfe_email_or_sms_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_email_or_sms}{literal}");		isErr = false;	}    var compare_date = 0;	if(IsNonEmpty(elemById("cfe_period_start").value)==false){		$("#cfe_period_start_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_period_start}{literal}");		isErr = false;		compare_date = 0;	}	if(IsNonEmpty(elemById("cfe_period_end").value)==false){		$("#cfe_period_end_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_period_end}{literal}");		isErr = false;		compare_date = 0;	}else{		if(compareDate(elemById("cfe_period_start").value,elemById("cfe_period_end").value)== false){			$("#cfe_period_end_err").html("{/literal}{$_lang.messages.validation.gt_others_date|sprintf:$_lang.tbl_cust_filter_email.label.cfe_period_end:$_lang.tbl_cust_filter_email.label.cfe_period_start}{literal}");			isErr = false;			compare_date = 0;		}	} */	/*	if(IsNonEmpty(elemById("cfe_restaurant").value)==false){		$("#cfe_restaurant_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_restaurant}{literal}");		isErr = false;	}*/    if(IsNonEmpty(elemById("prom_id").value)==false){		$("#prom_id_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_mesasge}{literal}");		isErr = false;	}    	if(elemById("hid_action").value=='SEND_SMS'){        if(IsNonEmpty(elemById("sms_text_msg").value)==false){            $("#sms_text_msg_err").html("{/literal}{$_lang.tbl_crm.not_empty_msg.sms_msg}{literal}");            isErr = false;        }    }else if(elemById("hid_action").value=='SEND_EMAIL'){        if(IsNonEmpty(elemById("sms_msg").value)==false){            $("#sms_msg_err").html("{/literal}{$_lang.tbl_crm.not_empty_msg.sms_msg}{literal}");            isErr = false;        }    }else{         isErr = false;    }/*	if(IsNonEmpty(elemById("cfe_start_date").value)==false){		$("#cfe_start_date_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_start_date}{literal}");		isErr = false;	}*//*	if(IsNonEmpty(elemById("cfe_end_date").value)==false){		$("#cfe_end_date_err").html("{/literal}{$_lang.tbl_cust_filter_email.not_empty_msg.cfe_end_date}{literal}");		isErr = false;	}*/	if(isErr == false){		alert("{/literal}{$_lang.messages.revise_form}{literal}");	}	return isErr;}//..function</script>{/literal}