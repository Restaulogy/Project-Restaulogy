
{literal}
<script type="text/javascript">

function fill_desc_from_dish(){
 		var txt_des = $('#sbmnu_dish_desc');

        if (document.getElementById('sbmnu_dish_dish').value != ""){

       		txt_des.empty();
        	//city.attr("disabled", true);
			var info = {};
			info['action'] = "getDishDetails";
			info['var1'] = document.getElementById('sbmnu_dish_dish').value;

			$.ajax({
	        type     : "POST",
	        url      : website + "/ajax/custom_functions.php" ,
			data	 : info,
	        dataType : "json",
			async	 : false,
	    	success  : function(response){
                  if(response){
                 	txt_des.html(response.dish_notes);
                 	if(response.dish_is_drink==1){
                      $('#div_submenu_price').hide();
                      $('#tmp_is_drink').val(1);
                    }else{
                      $('#div_submenu_price').show();
                      $('#tmp_is_drink').val(0);
                    }
            	 	//city.selectmenu('refresh', true);
                  }
                },
			error: function(objResponse){
				//alert(objResponse.responseText);
			}
		});

       }else{
	   	   //city.empty();
		   //$('<option value="0">{/literal}{$_lang.select_city}{literal}</option>').appendTo(city);
	   }
	   //city.selectmenu('refresh', true);
	   return false;
 }
 
function deletetbl_submenu_dishes(varId){
	if(varId > 0){
		if(confirm("{/literal}{$_lang.tbl_submenu_dishes.DELETE.CONFIRM_MSG}{literal}")==true){
			window.location.href="{/literal}{$page_url}{literal}?action=delete&sbmnu_dish_id="+varId;
		}
	}
}

function actiontbl_submenu_dishes(action){  
	var varId = $("input:checked").length;
	var isValid = 0;
	if(varId > 0){
	if(action != ""){
		switch (action) {
			case '{/literal}{$smarty.const.ACTION_DELETE}{literal}':
			if(confirm("{/literal}{$_lang.tbl_submenu_dishes.DELETE.CONFIRM_MSG}{literal}")==true){	
				isValid = 1;
			}  
			break;
			
			case '{/literal}{$smarty.const.ACTION_DEACTIVATE}{literal}':
			isValid = 1;
			break;
			
			case '{/literal}{$smarty.const.ACTION_ACTIVATE}{literal}':
			isValid = 1; 
			break; 
		}
		 
		  
		 if(isValid){
		 	$('#action').val(action);
		  $('#frm_tbl_submenu_dishes').submit();
		 }
			
	}
	}else{
			alert("{/literal}{$_lang.main.select_ids.empty}{literal}");
 	}
	
}

function validatetbl_submenu_dishes(){
	$("#sbmnu_dish_id_err").html("");
	$("#sbmnu_dish_submenu_err").html("");
	$("#sbmnu_dish_dish_err").html("");
	$("#sbmnu_dish_price_err").html("");
	$("#sbmnu_dish_display_order_err").html("");
	$("#sbmnu_dish_desc_err").html("");
	$("#sbmnu_dish_start_date_err").html("");
	$("#sbmnu_dish_end_date_err").html("");
	var isErr = true;
	if(elemById("action").value=="update"){
		if(IsNonEmpty(elemById("sbmnu_dish_id").value)==false){
			$("#sbmnu_dish_id_err").html("{/literal}{$_lang.tbl_submenu_dishes.not_empty_msg.sbmnu_dish_id}{literal}");
			isErr = false;
		}
	}
	if(IsNonEmpty(elemById("sbmnu_dish_submenu").value)==false){
		$("#sbmnu_dish_submenu_err").html("{/literal}{$_lang.tbl_submenu_dishes.not_empty_msg.sbmnu_dish_submenu}{literal}");
		isErr = false;
	}

	if(IsNonEmpty(elemById("sbmnu_dish_dish").value)==false){
		$("#sbmnu_dish_dish_err").html("{/literal}{$_lang.tbl_submenu_dishes.not_empty_msg.sbmnu_dish_dish}{literal}");
		isErr = false;
	}

	if(IsNonEmpty(elemById("sbmnu_dish_price").value)==false){
		$("#sbmnu_dish_price_err").html("{/literal}{$_lang.tbl_submenu_dishes.not_empty_msg.sbmnu_dish_price}{literal}");
		isErr = false;
	}
	
	if(IsNumeric(elemById("sbmnu_dish_price").value)==false){
		$("#sbmnu_dish_price_err").html("{/literal}{$_lang.tbl_submenu_dishes.input_err_msg.sbmnu_dish_price}{literal}");
		isErr = false;
	}
	
	/*if((elemById("tmp_is_drink").value)==0 && elemById("sbmnu_dish_price").value<=0){
		$("#sbmnu_dish_price_err").html("{/literal}{$_lang.tbl_submenu_dishes.input_err_msg.sbmnu_dish_price}{literal}");
		isErr = false;
	}*/


	if(IsNonEmpty(elemById("sbmnu_dish_display_order").value)==false){
		$("#sbmnu_dish_display_order_err").html("{/literal}{$_lang.tbl_submenu_dishes.not_empty_msg.sbmnu_dish_display_order}{literal}");
		isErr = false;
	}

/*	if(IsNonEmpty($("#sbmnu_dish_desc").val())==false){
		$("#sbmnu_dish_desc_err").html("{/literal}{$_lang.tbl_submenu_dishes.not_empty_msg.sbmnu_dish_desc}{literal}");
		isErr = false;
	}


	if(IsNonEmpty(elemById("sbmnu_dish_start_date").value)==false){
		$("#sbmnu_dish_start_date_err").html("{/literal}{$_lang.tbl_submenu_dishes.not_empty_msg.sbmnu_dish_start_date}{literal}");
		isErr = false;
	}
*/

/*
	if(IsNonEmpty(elemById("sbmnu_dish_end_date").value)==false){
		$("#sbmnu_dish_end_date_err").html("{/literal}{$_lang.tbl_submenu_dishes.not_empty_msg.sbmnu_dish_end_date}{literal}");
		isErr = false;
	}
*/

	if(isErr == false){
		alert("{/literal}{$_lang.messages.revise_form}{literal}");
	}
	return isErr;
}//..function
</script>
{/literal}
