{literal}<script type="text/javascript" src="{/literal}{$website}{literal}/js/chosen.jquery.js"></script><script type="text/javascript"> function cancel_emp_shifts(){	var info ={};	info['action'] = 'CANCEL_SHIFT'; 	info['emp_to_cancle_sft'] = $('#emp_to_cancle_sft').val();	if((info['emp_to_cancle_sft']) || (info['emp_to_cancle_sft']!='')){		if(confirm("{/literal}{$_lang.tbl_emp_shift_assignment.CANCEL.CONFIRM_MSG}{literal}")==true)			postForm(info,"{/literal}{$website}/user/tbl_table_shift_assignment.php{literal}");	}else{		alert("{/literal}{$_lang.tbl_emp_shift_assignment.CANCEL.EMP_REQD}{literal}");	} 	}function validDtRange(frmDtId,toDtId){   if(frmDtId){}else{		frmDtId = 'from_date';	}	if(toDtId){}else{		toDtId = 'to_date';	}	if($('#'+ toDtId).val() < $('#' + frmDtId).val()){		alert('End date should be greter than start date');		return false;	}	return true;}function popupCpyDt(dt){		//alert(window.innerWidth);		var vTop = (window.innerHeight - 200)/3;		var vLeft =(window.innerWidth - 270)/3;				$('#popupCopyDate').css('top',vTop).css('left',vLeft).css('height','200px').trigger('create');		$('#popupCopyDate').show();		 		//$('#popupCopyDate').popup('open');		$('#cpydtsrc').val(dt); 		getWeekRange();		$("#cpydttype1").click(); 		$("input[name=cpydttype]").checkboxradio( "refresh" ); }function validateCpy(){	var error = '';	var obj = $("input[name=cpydttype]:checked");	    		if (obj.val() == '2') {		 	if(($("#cpywkdsr option:selected").length > 0)==false){ 				error = error + 'Please Select at least one week \n'; 			}		}else	if (obj.val() == '1') {		 	if(IsNonEmpty($("#cpydtsingle").val())==false){				error = error + '{/literal}{$_lang.messages.validation.not_empty|sprintf:"Destination Date"}{literal}\n'; 			}else{				 if($("#cpydtsingle").val() == $('#cpydtsrc').val()){				  error = error + 'Both Date Should not be same\n'; 				 }else if(($("#cpydtsingle").val() < $('#cpydtsrc').val()) && ($("#cpydtsingle").val() == $('#cpydtsrc').val())){					error = error + '{/literal}{$_lang.messages.validation.gt_others_date|sprintf:"Destination Date":"Source date"}{literal}\n';  						 				 } 			}		}else{			var cmpdt = 0;			if(IsNonEmpty($("#cpydtfrm").val())){					cmpdt = 1;			}else{				error = error + '{/literal}{$_lang.messages.validation.not_empty|sprintf:"From Date"}{literal}\n';				cmpdt = 0;  			}			if(IsNonEmpty($("#cpydtto").val())){							cmpdt = 1;			}else{					error = error + '{/literal}{$_lang.messages.validation.not_empty|sprintf:"To Date"}{literal}\n';					cmpdt = 0; 			}			if(cmpdt == 1){				if($("#cpydtfrm").val() == $('#cpydtto').val() || $("#cpydtfrm").val() >  $("#cpydtto").val()){					error = error + '{/literal}{$_lang.messages.validation.gt_others_date|sprintf:"To date":"From date"}{literal}\n';				}							}		}	if(IsNonEmpty(error)){		alert(error);		return false;	}else{		return true;	}	}function copyDtFromSrc(){	if(validateCpy()){		var info ={};		info['action'] = 'COPY_EMP_SFT_BY_DT';		info['dsr_dtfrom'] = '';		 	info['dsr_dtto'] = '';			info['dsr_dt'] = '';		info['dsr_wk'] = '';		info['src_wk'] = '';		info['dsr_wkfrom'] = '';		info['dsr_wkto'] = '';				 if ($("input[name=cpydttype]:checked").val() == '2') {			info['src_wk'] = $('#cpywksrc').val();			info['dsr_wk'] = $('#cpywkdsr').val();			}else if ($("input[name=cpydttype]:checked").val() == '1') {						info['src_dt'] = $('#cpydtsrc').val();			info['dsr_dt'] = $('#cpydtsingle').val();			}else{						info['src_dt'] = $('#cpydtsrc').val();			info['dsr_dtfrom'] = $('#cpydtfrm').val();				info['dsr_dtto'] = $('#cpydtto').val();			}	/*for(x in info){		alert(x + ' = ' + info[x] );	}*/	 	 postForm(info,"{/literal}{$website}/user/tbl_emp_shift_assignment.php{literal}");	}}		function copy_emp_shift_by_date(src_dt,dsr_dt){  if(IsNonEmpty(src_dt) && IsNonEmpty(dsr_dt)){ 		var info ={};		info['action'] = 'COPY_EMP_SFT_BY_DT';		info['src_dt'] = src_dt;		info['dsr_dt'] = dsr_dt;		 postForm(info,"{/literal}{$website}/user/tbl_emp_shift_assignment.php{literal}");	} }function updateBulkEmployees(){	var info = {};	info['action'] = 'updateBulkEmployees';	if(is_gt_zero_num($('#emp_shift').val()) && IsNonEmpty($('#emp_date').val())){ 	info['var1'] = $('#emp_shift').val();	info['var2'] = $('#emp_date').val();	info['var3'] = $('#employees').val();  	 	 	$.ajax({     		    type     : "POST",		    url      : "{/literal}{$website}{literal}/ajax/custom_functions.php" ,		    data     : info,		    dataType : "json",				async	 : false,		    success  : function(data) {					if(data){						window.location.reload();					}else{						 alert('Error Occurred');					}									},			 error : function (objResponse){					  					 alert(objResponse.responseText);			}		 });  	}else{			alert('Error Occured');	}		} function popupemp_shift_assignment(sft_id,dt){ 	$('#popupemployeeshift').removeClass('biz_hidden'); 		$('#popupemployeeshift').css({				left: ($(window).width() - 250)/2,				top: $(window).height()/3  }).trigger('refresh'); 	$('#emp_shift').val(sft_id); 	$('#emp_date').val(dt); 	var info = {};	info['action'] = 'getShiftEmployeeByDate';	info['var1'] = sft_id;	info['var2'] = dt; 	var objEmp = $('#employees');  	$.ajax({     	    type     : "POST",	    url      : "{/literal}{$website}{literal}/ajax/custom_functions.php" ,	    data     : info,	    dataType : "json",			async	 : false,	    success  : function(data) {					var counter = 0;					var strOp = '<option>Choose Employee(s)</option>'; 					var sel_str = '';		 			 if(data){					 	  					  for(i in data){							sel_str = '';							if(data[i].isSelected){								sel_str = 'selected="selected"';							} 							strOp =  strOp + '<option value="'+ i +'" '+ sel_str +'>'+ data[i].name +'</option>';							counter++;						} 					 }  					 					 objEmp.html(strOp.toString()); 					 		 	},		error : function (objResponse){			 	objEmp.html('');			 alert(objResponse.responseText);		}	 }); 	 objEmp.selectmenu("refresh"); } function updateTablesToEmpShift(){	var info = {};	info['action'] = 'updateTablesToEmpShift';	 	if(is_gt_zero_num($('#emp_shift_id').val())){	info['var1'] = $('#emp_shift_id').val(); 	info['var2'] = $('#tables').val();  	 	 	$.ajax({     		    type     : "POST",		    url      : "{/literal}{$website}{literal}/ajax/custom_functions.php" ,		    data     : info,		    dataType : "json",				async	 : false,		    success  : function(data) {					if(data){						window.location.reload();					}else{						 alert('Error Occurred');					}									},			 error : function (objResponse){					  					 alert(objResponse.responseText);			}		 });  	}else{			alert('Error Occured');	} } function popuptbl_shift_assignment(emp_sft_id){	$('#popuptableshift').removeClass('biz_hidden'); 		$('#popuptableshift').css({				left: ($(window).width() - 250)/2,				top: $(window).height()/3  }).trigger('refresh');  	var info = {}; 	info['action'] = 'getTablesByEmpShift';	info['var1'] = emp_sft_id;   	$('#emp_shift_id').val(emp_sft_id); 	var objTbl = $('#tables');  	$.ajax({     	    type     : "POST",	    url      : "{/literal}{$website}{literal}/ajax/custom_functions.php" ,	    data     : info,	    dataType : "json",			async	 : false,	    success  : function(data) {					var counter = 0;					var strOp = '<option>Choose Table(s)</option>'; 					var sel_str = '';		 			 if(data){ 					  for(i in data){							sel_str = '';							dis_str = '';							if(data[i].isSelected){								sel_str = 'selected="selected"';							} 							if(data[i].isAlreadyAssigned){								dis_str = 'disabled="disabled"';							}							if((data[i].title != "") && (i > 0)){								strOp =  strOp + '<option value="'+ i +'" '+ sel_str + ' ' + dis_str +' >'+ data[i].title +'</option>';							} 							counter++;						} 					}   					 objTbl.html(strOp.toString());  		 	},		error : function (objResponse){			 	objTbl.html('');			 alert(objResponse.responseText);		}	 }); 	 objTbl.selectmenu('refresh'); }function deletemultiple_schedule(shifts,emp_id,date){	if(IsNonEmpty(shifts)){		if(confirm("{/literal}{$_lang.tbl_emp_shift_assignment.DELETE.CONFIRM_MSG}{literal}")==true){			var info = {action:'delMultiEmpShifts',var1:shifts,var2:emp_id,var3:date};			ajaxian(info,function(res){window.location.reload()}); 		}	}}function deletetbl_emp_shift_assignment(varId){	if(varId > 0){		if(confirm("{/literal}{$_lang.tbl_emp_shift_assignment.DELETE.CONFIRM_MSG}{literal}")==true){			window.location.href="{/literal}{$page_url}{literal}?action=delete&emp_sft_id="+varId;		}	}}function validatetbl_emp_shift_assignment(){	$("#emp_sft_id_err").html("");	$("#emp_sft_employee_err").html("");	$("#emp_sft_shift_err").html("");	$("#emp_sft_date_err").html("");	$("#emp_sft_tables_err").html("");	$("#emp_sft_start_date_err").html("");	$("#emp_sft_end_date_err").html("");	var isErr = true;	if(elemById("action").value=="update"){		if(IsNonEmpty(elemById("emp_sft_id").value)==false){			$("#emp_sft_id_err").html("{/literal}{$_lang.tbl_emp_shift_assignment.not_empty_msg.emp_sft_id}{literal}");			isErr = false;		}	}	if(IsNonEmpty(elemById("emp_sft_employee").value)==false){		$("#emp_sft_employee_err").html("{/literal}{$_lang.tbl_emp_shift_assignment.not_empty_msg.emp_sft_employee}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("emp_sft_shift").value)==false){		$("#emp_sft_shift_err").html("{/literal}{$_lang.tbl_emp_shift_assignment.not_empty_msg.emp_sft_shift}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("emp_sft_date").value)==false){		$("#emp_sft_date_err").html("{/literal}{$_lang.tbl_emp_shift_assignment.not_empty_msg.emp_sft_date}{literal}");		isErr = false;	}	if(IsNonEmpty(elemById("emp_sft_tables").value)==false){		$("#emp_sft_tables_err").html("{/literal}{$_lang.tbl_emp_shift_assignment.not_empty_msg.emp_sft_tables}{literal}");		isErr = false;	}/*	if(IsNonEmpty(elemById("emp_sft_start_date").value)==false){		$("#emp_sft_start_date_err").html("{/literal}{$_lang.tbl_emp_shift_assignment.not_empty_msg.emp_sft_start_date}{literal}");		isErr = false;	}*//*	if(IsNonEmpty(elemById("emp_sft_end_date").value)==false){		$("#emp_sft_end_date_err").html("{/literal}{$_lang.tbl_emp_shift_assignment.not_empty_msg.emp_sft_end_date}{literal}");		isErr = false;	}*/	if(isErr == false){		alert("{/literal}{$_lang.messages.revise_form}{literal}");	}	return isErr;}//..function function getWeekRange(){ 	var info = {};	info['action'] = 'getWeekRange';	info['var1'] = $('#cpydtsrc').val();    	var objWk = $('#cpywkdsr');  	$.ajax({     	    type     : "POST",	    url      : "{/literal}{$website}{literal}/ajax/custom_functions.php" ,	    data     : info,	    dataType : "json",			async	 : false,	    success  : function(data) {				 					var counter = 0;					var strOp = ''; 					var sel_str = '';					objWk.empty();		 			 if(data){ 					 strOp = '<option>Select Week(s)</option>';					  for(i in data){ 							sel_str = '';							/*if(data[i].isSelected){								sel_str = 'selected="selected"';							} */ 							if(counter == 0){								$('#lbl_cpywksrc').html('Week '+ i +'  ('+   data[i].start + '-' + data[i].end +')').trigger('refresh');								$('#cpywksrc').val(i);							}else{								strOp =  strOp + '<option value="'+ i +'"> Week '+ i +'  ('+   data[i].start + '-' + data[i].end +')</option>';							} 														counter++;						} 					}   					 objWk.html(strOp.toString()); 					 		 	},		error : function (objResponse){			  			 alert(objResponse.responseText);		}	 }); 	  objWk.selectmenu('refresh');	 //objWk.trigger('create'); } function validateCopySchedule(){ 	$('#dsr_from_err, #dsr_to_err, #single_date_err,#date_from_err,#date_to_err').html(''); 	var compare_date = 1; 	var val = src_day_diff = dsr_day_diff = 0;	var isErr = true;	if($('input[name=datefilter_type]:checked').val()){		val = parseInt($('input[name=datefilter_type]:checked').val());	} 		if(IsNonEmpty(elemById("dsr_from").value)==false){		$("#dsr_from_err").html("Please Select Start Date")		isErr = false;		compare_date = 0;	}    if(IsNonEmpty(elemById("dsr_to").value)==false){ 			$("#dsr_to_err").html("Please Select End Date")		isErr = false;		compare_date = 0;	}		if(compare_date == 1){		if(elemById("dsr_to").value < elemById("dsr_from").value){			$("#dsr_to_err").html("End Date Should Be greater than Start Date.");			isErr = false;		}	} 		 switch(val){		case  1  : 				 	if(IsNonEmpty(elemById("single_date").value)==false){						$("#single_date_err").html("Please Select Source Date")						isErr = false; 					}else{						if(elemById("dsr_from").value < elemById("single_date").value){							$("#dsr_from_err").html("Desired Date Should Be greater than Source Date.");							isErr = false;						} 					}					src_day_diff=days_between(elemById("dsr_from").value,elemById("dsr_to").value); 								break;		case 2 : 					if(IsNonEmpty(elemById("date_from").value)==false){						$("#date_from_err").html("Please Select Start Date")						isErr = false;						compare_date = 0;					} 				    if(IsNonEmpty(elemById("date_to").value)==false){ 							$("#date_to_err").html("Please Select End Date")						isErr = false;						compare_date = 0;					} 										if(compare_date == 1){												if(elemById("date_to").value < elemById("date_from").value){							$("#date_to_err").html("End Date Should Be greater than Start Date.");							isErr = false;						}else{																														if(elemById("dsr_from").value < elemById("date_to").value){													$("#dsr_from_err").html("Desired Date Should Be greater than Source Date.");													isErr = false;									 }  						} 					} 					src_day_diff=days_between(elemById("date_from").value,elemById("date_to").value);		break;		case 3 : 							src_day_diff = 7;								 							var arr = getWeekNumber(elemById('dsr_from').value);								var dsr_year = arr[0]; 							var dsr_wk = arr[1];  							d = new Date();							var curr_year = d.getFullYear(); 							if(curr_year > dsr_year){						 	$("#dsr_from_err").html("Desired Date Should Be greater than selected week.");						 }else{								if(elemById('week').value >= dsr_wk){							 if(curr_year >= dsr_year){									$("#dsr_from_err").html("Desired Date Should Be greater than selected week.");									 isErr = false;								}							}						}			break;		case 4 : 		 				var d = new Date(); 						var curr_year = d.getFullYear();						src_day_diff = new Date(d.getFullYear(), elemById('month').value, 0).getDate();						 d = new Date(elemById('dsr_from').value);						 var dsr_mnth = d.getMonth();						 var dsr_year = d.getFullYear(); 						 if(curr_year > dsr_year){						 	$("#dsr_from_err").html("Desired Date Should Be greater than selected month.");						 }else{						 	if(elemById('month').value > dsr_mnth){							 if(curr_year >= dsr_year){							 		$("#dsr_from_err").html("Desired Date Should Be greater than selected of month.");								 	isErr = false;							 }	 							}						 }							 		break; 	} 	 if(isErr){	 		dsr_day_diff=days_between(elemById("dsr_from").value,elemById("dsr_to").value);			var isErr = true;			var postfix = ''; 			var day_count = 0;			if(src_day_diff != dsr_day_diff){				if(src_day_diff > dsr_day_diff){					day_count = src_day_diff - dsr_day_diff;					postfix = day_count.toString() + ' more' ;					}else{					day_count = dsr_day_diff - src_day_diff;					postfix = day_count.toString() + ' less' ;					} 				if(day_count == 1){					postfix =  postfix + ' day';				}else{ 					postfix = postfix + ' days';				}								isErr = confirm("The number of days between the 2 schedules is mismtach And it will the difference of "+ postfix  +"  and would you want to continue with this difference?");			}	 }										   	return isErr;} function getSourceSchedule(){	var val=0, str='';	if($('input[name=datefilter_type]:checked').val()){		val = parseInt($('input[name=datefilter_type]:checked').val());	} 	str = '{/literal}{$website}{literal}/user/tbl_table_shift_assignment.php?'	switch(val){		case  1  : 				 	if(IsNonEmpty(elemById("single_date").value)==false){						$("#single_date_err").html("Please Select Source Date")						isErr = false; 					} 				 str = str + 'emp_sft_from_dt=' + elemById("single_date").value;								break;		case 2 : 					var compare_date = 1;					if(IsNonEmpty(elemById("date_from").value)==false){						$("#date_from_err").html("Please Select Start Date")						isErr = false;						compare_date = 0;					} 				    if(IsNonEmpty(elemById("date_to").value)==false){ 							$("#date_to_err").html("Please Select End Date")						isErr = false;						compare_date = 0;					} 										if(compare_date == 1){												if(elemById("date_to").value < elemById("date_from").value){							$("#date_to_err").html("End Date Should Be greater than Start Date.");							isErr = false;						}else{							 str = str + 'emp_sft_from_dt=' + elemById("date_from").value + '&emp_sft_to_dt='+elemById("date_to").value;				 						} 					} 					 		break;		case 3 :  							str = str + 'week=' + elemById("week").value;		break;		case 4 :  						str = str + 'month=' + elemById("month").value; 		break; 	} 		window.open(str);}function getDesireSchedule(){  if(IsNonEmpty(elemById("dsr_from").value)==false){		$("#dsr_from_err").html("Please Select Start Date")		isErr = false;		compare_date = 0;	}    if(IsNonEmpty(elemById("dsr_to").value)==false){ 			$("#dsr_to_err").html("Please Select End Date")		isErr = false;		compare_date = 0;	}		if(compare_date == 1){		if(elemById("dsr_to").value < elemById("dsr_from").value){			$("#dsr_to_err").html("End Date Should Be greater than Start Date.");			isErr = false;		}else{			window.open( '{/literal}{$website}{literal}/user/tbl_table_shift_assignment.php?from_date=' + elemById("dsr_from").value  + "&to_date=" + elemById("dsr_to").value);		}	} 	}$(function(){  //$('#employees').chosen({allow_single_deselect:true});	//$('#cpywkto').chosen({allow_single_deselect:true});	   $(".chzn-select").chosen({max_selected_options: 5,allow_single_deselect: true });	 	$(".myselect").chosen({max_selected_options: 5,allow_single_deselect: true });		//$("#emp_sft_date").scroller({ preset: 'date', dateFormat: 'yyyy-mm-dd', timeWheels: 'yyyymmdd', animate: 'pop'});	/*$("#emp_sft_date, #single_date,#date_from,#date_to,#dsr_from,#dsr_to, #emp_sft_from_dt, #emp_sft_to_dt, #from_date, #to_date, #cpydtfrm, #cpydtto, #cpydtsingle").scroller({ display:'bubble', preset: 'date', dateFormat: '{/literal}{$smarty.const.MOBISCROL_FORMAT}{literal}', timeWheels: 'yyyymmdd', animate: 'slidevertical'});*/	$("#emp_sft_date, #single_date,#date_from,#date_to,#dsr_from,#dsr_to, #emp_sft_from_dt, #emp_sft_to_dt, #from_date, #to_date, #cpydtfrm, #cpydtto, #cpydtsingle").scroller({ display:'bubble', preset: 'date', dateFormat: 'mm/dd/yyyy', timeWheels: 'yyyymmdd', animate: 'slidevertical'}); 	//$("#to_date").scroller({ preset: 'date', dateFormat: 'yyyy-mm-dd', timeWheels: 'yyyymmdd', animate: 'pop'}); 	$("input[name=datefilter_type]").change(function () {		$('#box_date_type1, #box_date_type2, #box_date_type3, #box_date_type4').addClass('biz_hidden');		 $('#box_date_type' + $(this).val() ).removeClass('biz_hidden').trigger('refresh');	}); 				$("input[name=cpydttype]").change(function () { 		 $('#box_cpydttype1').addClass('biz_hidden');		 $('#box_cpydttype2').addClass('biz_hidden');	 		$('#box_cpydttype3').addClass('biz_hidden'); 		 if ($("input[name='cpydttype']:checked").val() == '2') { 		 $('#popupCopyDate').css('height','200px').trigger('refresh');		 $('#box_cpydttype3').removeClass('biz_hidden');		  		 }else if ($("input[name='cpydttype']:checked").val() == '1') { 		 		$('#popupCopyDate').css('height','200px').trigger('refresh');		 	 $('#box_cpydttype1').removeClass('biz_hidden');  		 }else{		 	$('#popupCopyDate').css('height','225px').trigger('refresh');		 	 $('#box_cpydttype2').removeClass('biz_hidden');		 }	});			})</script>{/literal}