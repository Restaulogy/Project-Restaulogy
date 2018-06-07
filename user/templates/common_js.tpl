{literal}
<script type="text/javascript">
 var website = "{/literal}{$website}{literal}";   
 
 function delete_confirm_msg(msg,url){
	if(confirm(msg)==true){
			window.location.href=url;
	}
 }
 
function ajaxian(info, callback) {  
    $.ajax({
						type     : info['method'] || "POST" ,
						url      : website +'/'+ (info['phpfolder'] || "ajax" ) +'/' + (info['phpfile'] || "custom_functions") + '.php'  , 
						data	 			: info,
						dataType : "json" || info['datatype'],
						async	 		: false,
						success  : function(response){  
          				callback(response);    
      },
					 error: function(objResponse){
						    //alert(objResponse.responseText);
								 //prompt("Response",objResponse.responseText);
						}
		});  
}   

 function postForm(dictionary, url, method, target) {
 	//..here dictionary = {}; eg {'var1':value1,'var2':value2} or dictionary[var1] = val1;dictionary[var2] = val2; 
    method = method || "post"; // post (set to default) or get 
    // Create the form object
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", url);
		if(target){
			form.setAttribute("target", target);
		}
 		
    // For each key-value pair
    for (key in dictionary) {
        //alert('key: ' + key + ', value:' + dictionary[key]); // debug
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden"); // 'hidden' is the less annoying html data control
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", dictionary[key]);
        form.appendChild(hiddenField); // append the newly created control to the form
    }
 
    document.body.appendChild(form); // inject the form object into the body section
    form.submit();
}
 
 function viewlaterNotication(){
    var info = {};
    info['action'] = 'viewlaterNotication';
    ajaxian(info,function(data){
       $('#popNotification').popup('close');
    });
 }
 
 function getPromConditions(promotion_id,cmbcondition,prm){
 	     
			objcmb = $('#'+cmbcondition);
 	  
		 if(promotion_id > 0){ 
		  	 
			var info = {};  
			info['action'] = "getPromotionConditions";
			info['var1'] = promotion_id;
			  
		 ajaxian(info, function(response){ 
	    if(response){
	   		objcmb.empty(); 
	   		objcmb.attr("disabled", false); 
	   		$('<option value="0">Select Condition</option>').appendTo(objcmb); 
						 for(i in response){
						   if(prm  == i){
						   	$('<option value="'+ i +'" selected="selected">'+ response[i] +'</option>').appendTo(objcmb); 
						   }else{
						   	$('<option value="'+ i +'">'+ response[i] +'</option>').appendTo(objcmb); 
						   } 
						  }
						}
    }); 
   }else{
			   objcmb.empty();
		   $('<option value="0">Select Condition</option>').appendTo(objcmb); 
	  }
			objcmb.selectmenu('refresh');
 }
 
 function getSubMenus(menu,cmbsubmnu,prm){
			objsubmnu = $('#'+cmbsubmnu);
 	  
		 if(menu > 0){  
				var info = {};  
				info['action'] = "getSubMenus";
				info['var1'] = menu;
				ajaxian(info,function(response){ 
					 if(response){
		   		objsubmnu.empty(); 
		     objsubmnu.attr("disabled", false);
						 $('<option value="">Select SubMenu</option>').appendTo(objsubmnu); 
								for(i in response){
								   if(prm  == i){
								   	$('<option value="'+ i +'" selected="selected">'+ response[i] +'</option>').appendTo(objsubmnu); 
								   }else{
								   	$('<option value="'+ i +'">'+ response[i] +'</option>').appendTo(objsubmnu); 
								   } 
									} 
						}
					}); 
    }else{
			   objsubmnu.empty();
		   $('<option value="">Select Submenu</option>').appendTo(objsubmnu); 
	  }
		objsubmnu.selectmenu('refresh');
 }  
 
 function getSubMenudishes(submenu,cmbsbmnudish_id,prm){
			objsubmnudish = $('#'+cmbsbmnudish_id);
 	  
		 if(submenu > 0){  
				var info = {};  
				info['action'] = "getSubMenudishes";
				info['var1'] = submenu;
				ajaxian(info,function(response){ 
					 if(response){
		   		objsubmnudish.empty(); 
		     objsubmnudish.attr("disabled", false);
						 $('<option value="0">Select Dish</option>').appendTo(objsubmnudish); 
								for(i in response){
								   if(prm  == i){
								   	$('<option value="'+ i +'" selected="selected">'+ response[i] +'</option>').appendTo(objsubmnudish); 
								   }else{
								   	$('<option value="'+ i +'">'+ response[i] +'</option>').appendTo(objsubmnudish); 
								   } 
									} 
						}
					}); 
    }else{
			   objsubmnudish.empty();
		   $('<option value="0">Select Dish</option>').appendTo(objsubmnudish); 
	  }
		objsubmnudish.selectmenu('refresh');
 } 
 
 function changePage(url,page_number,limit,url_seperator,offset_str){
    var currentOffset = 0;
	 
	if(is_gt_zero_num(page_number) && is_gt_zero_num(limit)){
		currentOffset = page_number * limit + 1;
	}
	
	if(url_seperator == ""){
		url_seperator  = "?";
	}
	
 	if(offset_str == ""){
		offset_str = "{/literal}{$smarty.const.OFFSET_TITLE}{literal}"; 
	}
	if(is_gt_zero_num(currentOffset)){
		window.location.href = url + url_seperator + offset_str + "=" + currentOffset ;
	}
	 return true;
	 
 }
 
 function change_state_by_country(cmbCountry_id,cmbState_id,prm){ 
 		var city = $('#'+cmbState_id);
		 
        if (document.getElementById(cmbCountry_id).value != ""){
			
       		city.empty();
        	city.attr("disabled", true);
			var info = {};
			info['action'] = "getStatesByCountry";
			info['var1'] = document.getElementById(cmbCountry_id).value;

			$.ajax({
	        type     : "POST",
	        url      : website + "/ajax/custom_functions.php" , 
			data	 : info,
	        dataType : "json",
			async	 : false,
	    	success  : function(response){ 
                  if(response){
                 	city.empty(); 
                 	city.attr("disabled", false); 
                 	$('<option value="0">{/literal}{$_lang.select_state}{literal}</option>').appendTo(city); 
					for(i in response){
					   if(prm  == i){
					   	$('<option value="'+ i +'" selected="selected">'+ response[i] +'</option>').appendTo(city); 
					   }else{
					   	$('<option value="'+ i +'">'+ response[i] +'</option>').appendTo(city); 
					   } 
					}
            	 	//city.selectmenu('refresh', true);
                  }
                },
			error: function(objResponse){
				//alert(objResponse.responseText);
			}
		}); 
            
       }else{
	   	   city.empty();
		   $('<option value="0">{/literal}{$_lang.select_city}{literal}</option>').appendTo(city); 
		   
	   } 
	   city.selectmenu('refresh', true);
	   return false;  
 } 
 
 function change_metro_area_by_state(cmbState_id,cmbMetroArea_id,prm){ 
 		var metro_area = $('#'+cmbMetroArea_id);
		 
        if (document.getElementById(cmbState_id).value != ""){
			
       		metro_area.empty();
        	metro_area.attr("disabled", true);
			var info = {};
			info['action'] = "getMetroByState";
			info['var1'] = document.getElementById(cmbState_id).value;

			$.ajax({
	        type     : "POST",
	        url      : website + "/ajax/custom_functions.php" , 
			data	 : info,
	        dataType : "json",
			async	 : false,
	    	success  : function(response){ 
                  if(response){
                 	metro_area.empty(); 
                 	metro_area.attr("disabled", false);
					 
                 	$('<option value="0">Select Metro Area</option>').appendTo(metro_area); 
					for(i in response){
					   if(prm  == i){
					   	$('<option value="'+ i +'" selected="selected">'+ response[i] +'</option>').appendTo(metro_area); 
					   }else{
					   	$('<option value="'+ i +'">'+ response[i] +'</option>').appendTo(metro_area); 
					   } 
					}  
            	 	//metro_area.selectmenu('refresh', true);
                  }
                },
			error: function(objResponse){
				//alert(objResponse.responseText);
			}
		}); 
            
       }else{
	   	   metro_area.empty();
		   $('<option value="0">Select Metro Area</option>').appendTo(metro_area); 
		   //metro_area.selectmenu('refresh', true);
	   } 
	   return false;  
 } 
 
 function change_city_by_state(cmbCountry_id,cmbState_id,cmbcity_id,prm){ 
 		var city = $('#'+cmbcity_id);
		 
        if (document.getElementById(cmbState_id).value != ""){
			
       		city.empty();
        	city.attr("disabled", true);
			var info = {};
			info['action'] = "getCities";
			info['var1'] = document.getElementById(cmbState_id).value;
			info['var2'] = document.getElementById(cmbCountry_id).value;

			$.ajax({
	        type     : "POST",
	        url      : website + "/ajax/custom_functions.php" , 
			data	 : info,
	        dataType : "json",
			async	 : false,
	    	success  : function(response){ 
                  if(response){
                 	city.empty(); 
                 	city.attr("disabled", false); 
                 	$('<option value="0">Select State</option>').appendTo(city); 
                 	for(i in response){
					   if(prm  == i){
					   	$('<option value="'+ i +'" selected="selected">'+ response[i] +'</option>').appendTo(city); 
					   }else{
					   	$('<option value="'+ i +'">'+ response[i] +'</option>').appendTo(city); 
					   } 
					}
            	 	//city.selectmenu('refresh', true);
                  }
                },
			error: function(objResponse){
				//alert(objResponse.responseText);
			}
		}); 
            
       }else{
	   	   city.empty();
		   $('<option value="0">{/literal}{$_lang.select_city}{literal}</option>').appendTo(city); 
		   
	   } 
	   city.selectmenu('refresh', true);
	   return false;  
 } 
 

  $(function(){ 
 //..for hiding the highlighters
 //setTimeout(function(){$( ".biz_highlight_success,.biz_highlight_error" ).fadeOut( "slow")},3000); 	 
	
 {/literal}  
 {if $popup_window neq ""}
 {literal}
	setTimeout(function(){$( "#popup{/literal}{$popup_window}{literal}" ).popup( "open")},1000); 
 {/literal}
 {/if}
 {if $sesslife || $smarty.session[$smarty.const.SES_COOKIE_UID]}
 {if $Global_member.member_role_id eq $smarty.const.ROLE_WAITER}
 {literal}
  /*
	setInterval(function(){ 
		$.ajax({
	        type     : "POST",
	        url      :website + "/ajax/fetchCustRequests.php" , 
	        dataType : "json",
	    	success  : function(data) {    
		 		if(data.isRequest == 1){
					 $("#popupPendingRequest").show();
				}
				if(data.isOrder == 1){
					 $("#popupEmpOrder").show();
				}
				//if(data.isStatus == 1){
				//	$("#popupCustStatus").show();
				//} 
			}
		});
	}, {/literal}{$EMP_PG_REFRESH_SEC}{literal}); 
	*/   

{/literal}
{/if}
{**if $Global_member.member_role_id eq $smarty.const.ROLE_MANAGER || $Global_member.member_role_id eq $smarty.const.ROLE_WAITER ***}
 {literal}

	setInterval(function(){ 
     var info = {};
     info['phpfile'] = 'fetchAlerts';
		 ajaxian( info, function(data) {
				var popAlert = $("#lnkalerts"); 
				
		 		if(data.isAlert > 0){ 
					if(data.isAlert == 1){
						strOp = 'There is ' + data.isAlert + ' new notification' ;
					}else{
						strOp = 'There are ' + data.isAlert + ' new notifications.' ;
					} 
				   
					$('#pop_notification_txt').html(strOp).trigger('create'); 
					$('#popNotification').popup('open');
					popAlert.buttonMarkup({ theme: "f" });
					popAlert.find('b').html(data.isAlert);
				}else{
				 	popAlert.buttonMarkup({ theme: "a" });
					popAlert.find('b').html('&nbsp;');	
				} 
				popAlert.trigger('create');
				 
			});
	}, {/literal}{$EMP_PG_REFRESH_SEC}{literal}); 
	
	/*setInterval(function(){ 
		$.ajax({
	        type     : "POST",
	        url      :website + "/ajax/custom_functions.php?action=orderChkForDelay" , 
	        dataType : "json",
	    	success  : function(data) {
					
				},error:function(objResponse){
					//alert(objResponse.responseText);
				}
		});
	}, {/literal}{$smarty.const.PG_ORD_REFRESH}{literal});   
	
	setInterval(function(){ 
		$.ajax({
	        type     : "POST",
	        url      :website + "/ajax/custom_functions.php?action=requestsChkForDelay" , 
	        dataType : "json",
	    	success  : function(data) {
					
				},error:function(objResponse){
					//alert(objResponse.responseText);
				}
		});
	}, {/literal}{$EMP_PG_REFRESH_SEC}{literal}); */  

{/literal}
{**/if**}
{literal}

}); 
{/literal}
{else}
{literal} 

}); 
function askCustName(){
	$('#popupAskCustName').popup('open');
	$('#ask_cust_name_err').html('');
	$('#ask_cust_name').html('');
}

function saveCustName(){
	$('#ask_cust_name_err').html('');
	if(IsNonEmpty($('#ask_cust_name').val())){
		var info = {};
		info['action'] = 'askCustomerName';
		info['var1'] = $('#ask_cust_name').val();
		
		$.ajax({
	        type     : "POST",
	        url      :website + "/ajax/custom_functions.php" ,
	        dataType : "json", 
					data		 : info,
					async		 : false,
	    		success  : function(data) {
						if(data==1){window.location.reload();}
					},error: function(objResponse){
					//	alert(objResponse.responseText);
					}  
		});
	}else{
		$('#ask_cust_name_err').html('{/literal}{$_lang.messages.validation.not_empty|sprintf:"customer name"}{literal}');
	}
}
/*
function askCustEmail(){
    $('#popupAskCustEmail').popup('open');
	$('#ask_cust_email_err').html('');
	$('#ask_cust_email').html('');
}

function saveCustEmail(){
	$('#ask_cust_email_err').html('');

	if(IsNonEmpty($('#ask_cust_email').val())){
        if(isEmail($('#ask_cust_email').val())==false){
            $('#ask_cust_email_err').html('{/literal}{$_lang.messages.validation.email}{literal}');
        }else{
            var info = {};
    		info['action'] = 'askCustomerEmail';
    		info['var1'] = $('#ask_cust_email').val();

    		$.ajax({
    	        type     : "POST",
    	        url      :website + "/ajax/custom_functions.php" ,
    	        dataType : "json",
    					data		 : info,
    					async		 : false,
    	    		success  : function(data) {
    						if(data==1){window.location.reload();}
    					},error: function(objResponse){
    					//	alert(objResponse.responseText);
    					}
    		});
        }
	}else{
		$('#ask_cust_email_err').html('{/literal}{$_lang.messages.validation.not_empty|sprintf:"customer email"}{literal}');
	}
}
*/
{/literal} 
 
{/if}
{literal} 

 

 
</script>
{/literal} 
