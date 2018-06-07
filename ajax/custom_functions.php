<?php
 include_once (dirname(dirname(__FILE__))).'/init.php'; 
 include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_list_promotions.class.php');
 include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_redim_cupons.class.php'); 
 include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/functions.php');
 //ini_set('display_errors',1);
 $action = get_input('action','');
 $var1 = get_input('var1','');
 $var2 = get_input('var2','');
 $var3 = get_input('var3','');
 $var4 = get_input('var4','');
 $var5 = get_input('var5',''); 
 $retValue = '';
 switch ($action){
 
 	/*case 'getStateAbbrev' : 
		$retValue = biz_get_state_abbrev_by_id($var1);
		break; 
	case 'getBizIdByGoogleRef' : 
		$tmp_biz = new biz_tmp_business();
		$retValue = $tmp_biz->getBizID($var1);
		unset($tmp);
		break; 
	case 'getRcmdPrintMsgBeforeSave' :  
		$tmp_biz = new biz_recommendation();
		$retValue = $tmp_biz->getRcmdPrintMsgBeforeSave($var1,$var2,$var3,$var4,$var5);
		unset($tmp);
		break; 
	case 'getCategories' : 
		$retValue = service_getCategories($var1,$var2);
		 
		//$retValue = fn_getCategories($var1, $var2, $var3, $var4);
		break;
	 */ 
	case 'addChkValToSess':
		 if(is_not_empty($var1)){
		 		if($var2){				  
					$_SESSION['_sel_crm_id_fr_email'][]=$var1;
				}else{
					$key = array_search($var1,$_SESSION['_sel_crm_id_fr_email']);
					unset($_SESSION['_sel_crm_id_fr_email'][$key]);
				}
		 		$_SESSION['_sel_crm_id_fr_email']=array_unique($_SESSION['_sel_crm_id_fr_email']);
		 }
	 	 $retValue = count($_SESSION['_sel_crm_id_fr_email']);
		break;	
		
	case 'fetchRestarantList':
		$retValue =array();
		if(is_not_empty($var1)){			
				$sql='SELECT COUNT(`'.DISH_ID.'`) as `fnd` FROM `'.TBL_RESTAURENT.'` WHERE `'.RESTAURENT_NAME.'` LIKE "%'.trim($var1).'%";';
				$retValue=DB::ExecQry($sql,0);
		}
		$retValue = json_encode($retValue);
		break;	
		
	case 'chkUsrRestAlreadyExits':
		$retValue =array();
		
		if(is_not_empty($var1)){
			//..check if the email already there for other restaurant
			$retValue=members::get_usr_its_rest_details($var1,$_SESSION[SES_RESTAURANT]);
			print_r($retValue);
			
		}	 
	  $retValue = json_encode($retValue);
		break;		
		 
	case 'chkDishAlreadyExits':
		$retValue =array();
		$retValue['op']=0;
		if(is_not_empty($var1)){
			if(is_gt_zero_num($var2)){
				$sql='SELECT COUNT(`'.DISH_ID.'`) as `fnd` FROM `'.TBL_DISHES.'` WHERE `'.DISH_ID.'` != '.$var2.' AND `'.DISH_RESTAURENT.'` = '.$_SESSION[SES_RESTAURANT].' AND `'.DISH_NAME.'` = "'.trim($var1).'";';
			}else{
				$sql='SELECT COUNT(`'.DISH_ID.'`) as `fnd` FROM `'.TBL_DISHES.'` WHERE `'.DISH_RESTAURENT.'` = '.$_SESSION[SES_RESTAURANT].' AND `'.DISH_NAME.'` = "'.trim($var1).'";';
			}
			$is_fnd=DB::ExecScalarQry($sql,0);	
			$retValue['op']=$is_fnd;			
			unset($objtbl_dishes);
		}	 
	  $retValue = json_encode($retValue);
		break;
		
	 
	case 'getPromDetails': 
	  $retValue = array();
		if(is_not_empty($var1)){
			$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
			$dish_det=DB::ExecQry('SELECT * FROM `'.PDS_LIST_PROMOTIONS.'` WHERE `id`='.$var1,1);		if(is_not_empty($dish_det)){
				$retValue['comments'] = $dish_det['comments'];
				$obj_pds_list_promotions=new pds_list_promotions();
	
				if($var2 == 'email'){
					if(is_not_empty($var3))
						$var3=nl2br($var3);
					$retValue['email_preview'] = $obj_pds_list_promotions->email_preview_promtoion($var3);	
				}else{
					//$retValue['sms_txt_preview'] = $rest_info[RESTAURENT_NAME].'-'.get_elipsis($dish_det['title'],80,'..').'-'.biz_get_tiny_url($website."/modules/business_listing/show.php?show_type=PR&lid=".$dish_det['list_id']."&promoid=".$var1);
					
					$retValue['sms_txt'] = $rest_info[RESTAURENT_NAME].'-'.get_elipsis($dish_det['title'],80,'..').'-'.' Offer Valid From '.date("m/d/y",strtotime($dish_det['start_date'])).'-'.date("m/d/y",strtotime($dish_det['end_date']));	
										
					//$retValue['email_preview'] = $obj_pds_list_promotions->email_preview_promtoion($var1,$retValue['sms_txt_preview']);	
				}				
			}			
			unset($obj_pds_list_promotions);	
		}	 
	  $retValue = json_encode($retValue);
		break;
		
	case 'getMenuItemDetails': 
	    $retValue = array();
		if(is_not_empty($var1)){
			
			$menu_id=$var1;
			$eml_cntnts="";
			$sms_cnts="";
			if((count($menu_id)==1)){
				$dish_det=tbl_submenu_dishes::GetInfo(reset($menu_id));
				$eml_cntnts=nl2br($dish_det["sbmnu_dish_dish_details"][DISH_NOTES]);
				$strOp = '<h1 align="center">'.$dish_det["sbmnu_dish_dish_details"][DISH_NAME].'</h1>'.RET;				
				$_rest_under_consider=$dish_det["sbmnu_dish_dish_details"][DISH_RESTAURENT];
				$prom_link=biz_get_tiny_url($website."/user/tbl_submenu_dishes.php?sbmnu_dish_id=".$dish_det["sbmnu_dish_dish_details"][DISH_ID]."&is_preview=1");
				$sms_cnts .= "<a href='{$prom_link}'>".$dish_det["sbmnu_dish_dish_details"][DISH_NAME]."</a><br/>" ; 
			}else{
				foreach($menu_id as $_each_mnu){
					$dish_det=tbl_submenu_dishes::GetInfo($_each_mnu);
					$prom_link = biz_get_tiny_url($website."/user/tbl_submenu_dishes.php?sbmnu_dish_id=".$_each_mnu."&is_preview=1");
					$eml_cntnts .= "<a href='{$prom_link}'>".$dish_det["sbmnu_dish_dish_details"][DISH_NAME]."</a><br/>" ; 
					$sms_cnts .= "<a href='{$prom_link}'>".$dish_det["sbmnu_dish_dish_details"][DISH_NAME]."</a><br/>" ; 
				}
				$strOp = '<h1 align="center">New Menu Items</h1>'.RET;
				$_rest_under_consider=$_SESSION[SES_RESTAURANT];
			}
			$rest_info = tbl_restaurent::GetInfo($_rest_under_consider);
			$retValue['comments'] =$eml_cntnts;
			
			if($var2 == 'email'){
				if(is_not_empty($var3))
					$var3=nl2br($var3);
				$retValue['email_preview'] = email_preview_menu($var1,$var3);	
			}else{
				$retValue['sms_txt'] = $rest_info[RESTAURENT_NAME].'-'.$sms_cnts;						
			}			
		}	 
	  	$retValue = json_encode($retValue);
	 break;	
		 
	case 'getDishDetails': 
	 $retValue = array();
		if(is_not_empty($var1)){
			$dish_det=tbl_dishes::GetInfo($var1);			
			$retValue[DISH_NOTES] = $dish_det[DISH_NOTES];
			$retValue[DISH_IS_DRINK] = $dish_det[DISH_IS_DRINK];
		}	 
	  $retValue = json_encode($retValue);
		break;
		
	case 'markAsNowLater':	
		$retValue = array();
		if(is_not_empty($var1)){
			$objtbl_alerts=new tbl_alerts();
			$retValue = $objtbl_alerts->markAsNowLater($var1);
			unset($objtbl_alerts);
		}	 
	  $retValue = json_encode($retValue);
		break;
		 
	case 'viewlaterNotication':
		$retValue =	tbl_alerts::viewAlerts(); 
		break;
	 
	case 'getTableEmployees':
	  $retValue = array();
	  if(is_not_empty($var1)){
	  	$retValue = GetTblEmployees($var1);
	  }
	   $retValue = json_encode($retValue); 
	  break;
	
	case 'getTblShiftEmployees':
	  $retValue = array();
		$curr_shift = tbl_shift::getCurrentShift();
	  $records = tbl_emp_shift_assignment::readArray(array(EMP_SFT_SHIFT=>$curr_shift,EMP_SFT_DATE=>date(DAY_FORMAT),SES_RESTAURANT=>$_SESSION[SES_RESTAURANT]));
	
		$employees = array();
	  foreach($records as $key=>$record){
			$employees[$record[EMP_SFT_EMPLOYEE]]['id']=  $record[EMP_SFT_EMPLOYEE];
			$employees[$record[EMP_SFT_EMPLOYEE]]['title']=  $record['employee_name'];
			if(is_not_empty($record['tables_arr']) && is_array($record['tables_arr'])){
				$employees[$record[EMP_SFT_EMPLOYEE]]['isDefault']=  0;
				if(in_array($var1,$record['tables_arr'])){
					$employees[$record[EMP_SFT_EMPLOYEE]]['isDefault']=  1;
				}
			} 
		}
		//print_r($employees);
		unset($records);
	  $retValue = json_encode($employees); 
	  break;
	
	case 'getAllLang' :
		$retValue = $_lang; 
		if($var1 == 'isAjax'){
		 	 $retValue = json_encode($retValue); 
		} 
		break;	
	case 'getMetroByState' :
		$retValue = array();
	  if(is_not_empty($var1)){
	  	$retValue = getmetroByState($var1);
	  }
	   $retValue = json_encode($retValue); 
	  break;
	case 'getCities' :
		$retValue = array();
	  if(is_not_empty($var1)){
	  	$retValue = getcities($var1);
	  }   
	  
	   $retValue = json_encode($retValue); 
	  break;
	case 'getTableSeatingCapcity':
		$retValue=0;
		$info = tbl_dining_table::GetInfo($var1);
		if(is_not_empty($info)){
		   if($info['isActive']){
		   	$retValue = $info['table_seating_capacity'];
		   } 
		}
		break;
	 
	case 'getSubServices':
		$retValue = ''; 
		$obj = new tbl_services_details();
		$arr[SRVC_DTL_SERVICE_CODE] = $var1;  
		$retValue = json_encode($obj->readArray($arr));		
		unset($obj);		
		break;
	case 'updateBulkEmployees':
		$retValue = ''; 
		$shift = $var1;
		$date = date('Y-m-d',strtotime($var2));
		
		if(is_array($var3)){
			$employee = implode(',',$var3);
		}else{
			$employee = $var3;
		}
		 
		$retValue = tbl_emp_shift_assignment::updateBulkEmployees($shift,$date,$employee);
		if($retValue == 1){
			$_SESSION[SES_FLASH_MSG] = '<div class="success">Shift Employees updated successfully.</div>';
		}else{
			$_SESSION[SES_FLASH_MSG] = '<div class="error">Problem during operation.</div>';
		}		 
		break;
		
	case 'getShiftEmployeeByDate':
		$retValue = ''; 
		$var2 = date('Y-m-d',strtotime($var2));
		$arr = array(EMP_SFT_SHIFT=>$var1,EMP_SFT_DATE=>$var2,SES_RESTAURANT=>$_SESSION[SES_RESTAURANT]);
		$res = 0; 
		$info = tbl_emp_shift_assignment::readArray($arr,$res,1);
		$activestaff = tbl_staff::GetActiveEmployees(); 
		 
		$employees = array();
		foreach($info as $key=>$val){ 
			$selected[]= $val[EMP_SFT_EMPLOYEE];   
		}
		if(is_not_empty($activestaff)){
			foreach($activestaff as $key=>$val){
				$employees[$key]['name'] = $val;
				$employees[$key]['isSelected'] = 0;
			 		if(is_not_empty($selected)){
						if(in_array($key,$selected)){
							$employees[$key]['isSelected'] = 1;
						}
					}  
			}  
		}
		
		$retValue = json_encode($employees);
		break;
		case 'getTablesByEmpShift':
		$retValue = '';    
		$info = tbl_emp_shift_assignment::GetInfo($var1);
		$assigned_tables = array(); 
 		if($info){
			$assigned_tables = tbl_emp_shift_assignment::getTablesForShiftDate($info[EMP_SFT_SHIFT],$info[EMP_SFT_DATE]);
			$assigned_tables = biz_explode(',',$assigned_tables);
		}
		 
		$sel_table = array();
		if(is_not_empty($info['emp_sft_tables'])){
			$sel_table = biz_explode(',',$info['emp_sft_tables']);
		}
		 
		$tables = tbl_dining_table::GetActiveDiningTables();
		 
		$emp_tables = array();
		if($tables){
			foreach($tables as $key=>$val){
				$emp_tables[$key]['title']= $val;
				$emp_tables[$key]['isSelected']=0;
				$emp_tables[$key]['isAlreadyAssigned']=0;
				 
				if(in_array($key,$sel_table)){
					$emp_tables[$key]['isSelected']=1;
				}elseif(in_array($key,$assigned_tables)){
					$emp_tables[$key]['isAlreadyAssigned']=1;
				} 
			}
		}
		
		$retValue = json_encode($emp_tables);
		break;
	case 'updateTablesToEmpShift':
	$retValue = 0; 
		if(is_array($var2)){
			$tables = biz_implode(',',$var2);
		}else{
			$tables = $var2;
		} 
	/*	 
	$obj = new tbl_emp_shift_assignment();
	if($obj->readObject(array(EMP_SFT_ID=>$var1))){
 
		$obj->setemp_sft_tables($tables);
		$obj->insert();*/
		$retValue = tbl_emp_shift_table::bulk_insert($var1,$tables); 
		if($retValue == 1){
			$_SESSION[SES_FLASH_MSG] = '<div class="success">Shift Tables updated successfully.</div>';
		}elseif($retValue == OPERATION_DUPLICATE){
			$_SESSION[SES_FLASH_MSG] = '<div class="info">Table is already assigned.</div>'; 
		}else{
			 $_SESSION[SES_FLASH_MSG] = '<div class="error">Problem during operation.</div>';
		}
		
	/*}*/
	break;  
	
	case 'getWeekRange': 
	 $retValue = json_encode( biz_week_range($var1));
	 break;
	  
	case 'getSessSrvcReqst':
		$retValue = array(); 
		$requests = tbl_services_requests::readArray(array('srvc_reqst_session_id'=>$var1,SES_RESTAURANT=>$_SESSION[SES_RESTAURANT])); 
		foreach($requests as $key=>$request){
			 $remain_stages = tbl_service_request_stage::GetRemainingStages($request['id'],$request['srvc_id']);
	 $allStage = tbl_service_stage::GetAllServieceStage($request['srvc_id']);
	 $stages = array();
	 $x = 0; 
	 if(is_not_empty($allStage)){ 
	  foreach($allStage as $stage){
	 	if(biz_arr_search($remain_stages,SRVC_STG_ID,$stage[SRVC_STG_ID])){
		
		}else{
			$stages[$x] = $stage;
			$x++;
		}
	 }
	} 
	 
	 $stages = array_reverse($stages);
	 
	 $lastStage = array();
	 $used_stages = array();
	 $y = 0;
	 if(is_gt_zero_num($x)){  
		for($i=0;$i<$x;$i++){
			if($i == 0){
				$lastStage = $stages[0];
			}else{
				$used_stages[$y] = $stages[$i];
				$y++;
			}
		}
		
	  
	 }
	  
	 $retValue[$request['id']]= $request;
	 $retValue[$request['id']]['last_stage'] = $lastStage;  
	 
		}
	 
		$retValue = json_encode($retValue);
		break;
		
	case 'getSessOrders':
		$retValue = array();
		 
		$info = tbl_orders::readArray(array('order_session_id'=>$var1,ORDER_RESTAURANT=>$_SESSION[SES_RESTAURANT])); 
		foreach($info as $order){
			$retValue[$order['order_id']] = tbl_orders::GetInfo($order['order_id']);
	  } 	
		
		$retValue = json_encode($retValue);
		break;
		
		case 'changeOrderStatus':
		$obj = new tbl_orders();
		$retValue= $obj->update_ord_sts($var1,$var2);
		unset($obj); 
		$arr = biz_getLangMsgStrForDftlAct($retValue);
	  if($retValue==2){
			
		}else{
			if(is_not_empty($arr)){ 
			 if(is_not_empty($_lang[TBL_ORDERS]['CHANGE_STATUS'][$arr['msg']])){
			 	$_SESSION[SES_FLASH_MSG] = '<div class="'.$arr['class'].'">'.$_lang[TBL_ORDERS]['CHANGE_STATUS'][$arr['msg']].'</div>';
			 }
		 }
		} 
		break;
		case 'changeSubOrderStatus':
		$obj = new  tbl_sub_orders();
		$retValue= $obj->update_status($var1,$var2);
		unset($obj); 
		$arr = biz_getLangMsgStrForDftlAct($retValue);
	  if($retValue==2){
			
		}else{
			if(is_not_empty($arr)){ 
			 if(is_not_empty($_lang[TBL_ORDERS]['CHANGE_STATUS'][$arr['msg']])){
			 	$_SESSION[SES_FLASH_MSG] = '<div class="'.$arr['class'].'">'.$_lang[TBL_ORDERS]['CHANGE_STATUS'][$arr['msg']].'</div>';
			 }
		 }
		} 
		break;
		
		case 'askCustomerName':
		$retValue = 0; 
		if(is_not_empty($var1)){
			$_SESSION[SES_CUST_NM] = $var1;
			if($sesslife == false){
				$_SESSION[SES_COOKIE_UID] =  checkNcreateUserCookieId($_SESSION[SES_CUST_NM]);
			} 
			$retValue = 1;
		}  
		break;
		
		case 'askCustomerEmail':
		$retValue = 0; 
		if(is_not_empty($var1)){
			$rewrad_user=get_user_by_email($var1);
			if(is_not_empty($rewrad_user)){
				 $_SESSION[SES_REWARD]=$rewrad_user;
				 if(is_not_empty($_SESSION[SES_CUST_NM])==FALSE){
				 	$_SESSION[SES_CUST_NM]=$_SESSION[SES_REWARD]['email'];
				 }
			}else{
				$_SESSION[SES_FLASH_MSG]  ='<div class="error">This email is not registered with reward program.</div>';
			}
			$retValue = 1;
		}  
		break;
		
	case 'orderChkForDelay': 
	  $retValue = tbl_sub_orders::mkDelaySubOrders();
	  tbl_sub_orders::mkConfirmDelaySubOrders();
		/*
		//Commented COde @ 1Nov2013ByInforesha.ShriDhar
		$retValue = tbl_orders::mkDelayOrders();
		//..check for ordered itme not confirmed
		 tbl_orders::mkConfirmDelayOrders();
		//..check also for take out orders.
		//tbl_orders::mkTkOutOrderReady();
		*/
	break;
	
	case 'requestsChkForDelay':
		$retValue = tbl_services_requests::mkDelayRequests();
	break;
	
	
	case 'getorderInfo':
		 $tb_sess_ords=tbl_orders::GetInfo($var1); 
		 //print_r($tb_sess_ords);
	break;
	
	case 'chkDishMnuSubMnu' :
		$retValue = 0;
		//echo $var1,$var2,$var3;exit;
		if(is_not_empty($var3)==false){
			$var3=0;
		}
	  $retValue =  	tbl_submenu_dishes::isSubMenuDish($var1,$var2,$var3);	
		 
		break;
	case 'chkAllSubOrderConfirmed':
	 $retValue = tbl_sub_orders::chkAllSubOrderConfirmed($var1);
	 break;
	case 'getSubMenus': 
	  $filt_arr = array('key_field'=>SUBMNU_ID,'value_field'=>SUBMNU_NAME,'filter_field'=>SUBMNU_MENU,'filter_value'=>$var1);
		 
		$retValue = json_encode(tbl_sub_menu::GetFields($filt_arr)); 
	break;
	
	case 'add2CustFavorites':
		 $post_id = $var1;
		 $post_type=$var2;
		 $desc = $var3;
		 $user = $_SESSION['guid']; 
		 $obj = new tbl_cust_favorites();
	 
		 $retValue = $obj->create($post_id,$user,$desc,$post_type);  
		 
		$arr = biz_getLangMsgStrForDftlAct($retValue);
		 
		 if(is_not_empty($arr)){ 
				 if(is_not_empty($_lang[TBL_CUST_FAVORITES]['CREATE'][$arr['msg']])){
				 	$_SESSION[SES_FLASH_MSG] = '<div class="'.$arr['class'].'">'.$_lang[TBL_CUST_FAVORITES]['CREATE'][$arr['msg']].'</div>'; 
				 } 	
		 }
		 
		 
			
		 break;
	case 'removeCustFavorites':
		$retValue =  tbl_cust_favorites::delete(array(CUST_FAV_ID=>$var1));
		$arr = biz_getLangMsgStrForDftlAct($retValue);
	 
		if(is_not_empty($arr)){ 
			 if(is_not_empty($_lang[TBL_CUST_FAVORITES]['DELETE'][$arr['msg']])){
			 	$_SESSION[SES_FLASH_MSG] = '<div class="'.$arr['class'].'">'.$_lang[TBL_CUST_FAVORITES]['DELETE'][$arr['msg']].'</div>';
			 }
		 } 
		
	break;
	
	case 'getNonConfirmedOrders': 
		$retValue = tbl_orders::getNonConfirmedOrders($var1,$var2); 
		/*print_r($retValue);*/
		$retValue = json_encode($retValue);
	break;
	case 'getUnPaidOrders': 
		$retValue = tbl_orders::getNonPaidOrders($var1);
		$retValue = json_encode($retValue);
	break;
	
	case 'confirmTakeOutOrder':
	//..here var1 : order_id; var2: takeout time;
		$retValue = tbl_orders::confirmTakeOutOrder($var1,$var2,$var3);
		$arr = biz_getLangMsgStrForDftlAct($retValue);
	 
		if(is_not_empty($arr)){ 
			 if(is_not_empty($_lang[TBL_ORDERS]['CHANGE_STATUS'][$arr['msg']])){
			 	$_SESSION[SES_FLASH_MSG] = '<div class="'.$arr['class'].'">'.$_lang[TBL_ORDERS]['CHANGE_STATUS'][$arr['msg']].'</div>';
			 }
		 }
	 break;

	 case 'saveTakeOutEmailForOrder':
	 $retValue = 0;
		 $obj = new tbl_orders();
		 //..here var1 : order_id; var2: email;
		 if(isValidEmail($var2)){
		 	if($obj->readObject(array(ORDER_ID=>$var1))){
		 		$obj->setorder_takeout_email($var2);
				$obj->insert();
				//$_SESSION[SES_FLASH_MSG] = '<div class="success">Email Saved Successfully.</div>';
				$retValue = 1;
		 	}else{
				$_SESSION[SES_FLASH_MSG] = '<div class="error">Order is not exists.</div>';
			}
		 }else{
		 		$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['invalid_email'].'</div>';
		 } 
		 unset($obj);
	 break;
	 
	case 'getSubMenudishes':
		$retValue = json_encode(tbl_submenu_dishes::getAllSubMnuDishes($var1)); 
	break; 
	
	case 'getPromotionConditions':
	$search_array = array(PRMCON_PROMOTION=>$var1);
	$field_arr = array('key_field'=>PRMCON_ID,'value_field'=>PRMCON_TITLE,'isActive'=>1,'filters'=>$search_array);
		$retValue = json_encode(tbl_prom_conditions::GetFields($field_arr)); 
	break;
	
	case 'delMultiEmpShifts':
	$arr = tbl_emp_shift_assignment::readArray(array(EMP_SFT_DATE=>$var3,EMP_SFT_EMPLOYEE=>$var2));
	 
	if(is_not_empty($arr)){
		$emp_sft_list = biz_explode(',',$var1);
		$emp_sft_count = count($arr);
		$count =0;
		foreach($emp_sft_list as $emp_sft_id){
			 
			if(array_key_exists($emp_sft_id,$arr)){
					$count++;
			} 
		}
		 
		if($count == $emp_sft_count){
			 $retValue =  tbl_emp_shift_assignment::delete(array(EMP_SFT_ID=>$var1)); 
		}else{
			 $retValue =  tbl_emp_shift_table::delete(array(EMP_SFT_TBL_EMPLOYEESHIFT=>$var1)); 
		} 
		/*$retValue =  tbl_emp_shift_assignment::delete(array(EMP_SFT_ID=>$var1));*/
		if($retValue){
		 $_SESSION[SES_FLASH_MSG] = '<div class="success">Deleted Successfully.</div>';
		}else{
			$_SESSION[SES_FLASH_MSG] = '<div class="error">Deleted Successfully.</div>';
		}
	}
	
	
	break;
	case 'rateSubMenuDish':
		 
	break;
	
	case 'rateSubMenuDishItem':
	break;
	
	case 'applyTipToAllOrders':
	$retValue =  tbl_orders::applyOrderTipToAllOrders($var1,$var2);
	break; 
	
	case 'cal_tip_amt':
	 $var1 = date(DATE_FORMAT,strtotime($var1));
	 $var2 = date(DATE_FORMAT,strtotime($var2));
	 //$var3 = date(DATE_FORMAT,strtotime($var3));
	 //$var4 = date(DATE_FORMAT,strtotime($var3));
	 $employees = '';
	 $output='';
	 //echo "$var1,$var2,$var3,$var4,$var5";
	 //print_r($var4);
	 //exit;
	 //$tip_amt =  tbl_tip_distribution::cal_tip_amt($var1,$var2,$employees);cal_empwise_tip_amt
	 $tip_amt =  tbl_tip_distribution::cal_empwise_tip_amt($var1,$var2,$var3,$var4,$var5,$employees,$output);
	 //print_r(array('tip_amt'=>$tip_amt,'employees'=>$employees,'output'=>$output));
	 //exit;
	 $retValue = json_encode(array('tip_amt'=>$tip_amt,'employees'=>$employees,'output'=>$output));		
	break; 
	
	case 'applyPromotionToOrder':			
			$_SESSION[SES_FLASH_MSG] = applyPromotionToOrder($var1);
			$retValue = 1;
	break;	
	/*
	case "getFBFriends":
		$retValue = service_getFBFriends();
		break;
	*/	
  case 'deleteDish_opt_price'	: 
   $res =	tbl_sbmnu_dish_opt_price::delete(array(SBMDOPT_PR_ID=>$var1));
	 if($res){
	 	$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang[TBL_SBMNU_DISH_OPT_PRICE][ACTION_DELETE]['SUCCESS_MSG'].'</div>';
	 }else{
	 	$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang[TBL_SBMNU_DISH_OPT_PRICE][ACTION_DELETE]['FAILURE_MSG'].'</div>';
	 }
	 $retValue = 1;
	 break;
	 
	 case 'convertTakeOutOrderToDine': 
	 $retValue =	tbl_orders::cnvTkoutOrderToDine($var1,$var2,$var3);
	 if($retValue){
	 	$_SESSION[SES_FLASH_MSG] = '<div class="success">Order successfully converted to Dine-In.</div>';
	 }else{
		$_SESSION[SES_FLASH_MSG] = '<div class="error">Problem During  converting orders.</div>';
	 } 
	 break;
	 
	 //..for wait queue <--
	 case 'getEstimationTimeMaxLimit':
		$retValue=0;
		$info = tbl_wait_estimation_times::GetInfo($var1);
		if(is_not_empty($info)){
		   if($info['isActive']){
		   	$retValue = $info[WT_EST_TIME_VALUE];
		   } 
		}
		break; 
	case 'calculate_est_time' :
		$retValue=0;
		$retValue = tbl_wait_queue::calculate_est_time($var1,$var2,$var3); 
		break;
	case 'set_sess_est_time' :
		$_SESSION[SES_EST_TIME] = $var1;
		$retValue=$_SESSION[SES_EST_TIME];
		break;
	case 'set_exp_time':
		$retValue = 0;
		$obj = new tbl_wait_queue();
		if($obj->readObject(array(WT_QUE_ID=>$var1))){
			$diff = $var2 - $obj->getwt_que_exp_time();
			$obj->setwt_que_exp_time($var2);
			$obj->insert();
			tbl_alerts::delete(array(ALERT_POST_ID=>$var1,ALERT_TO_CUST=>1));
			tbl_wait_queue::generateFutureMsg($var1);  
			$retValue = 1; 
		}
		unset($obj); 
		break;
	case 'getQueCompletedExpTime':
		$retValue = '';
		$retValue = tbl_wait_queue::getQueCompletedExpTime();
		$retValue = json_encode($retValue); 
		break;
	case 'getQueInfo':
	 $retValue = '';
	 $retValue = tbl_wait_queue::GetInfo($var1); 
	 $retValue = json_encode($retValue); 	
		break;
	case 'changeAllowQueue' :
		$res = mysql_query('UPDATE `settings` SET `isAllowNewQue`='.$var1);
		if($res){
			$retValue = 1 ;
		} 
		break;
	case 'applyCoupon':
		$cupons = new pds_redim_cupons();
		$retValue = $cupons->redimCupon($var1,1,1,$var2,$var3);
		unset($cupons);
		if($retValue){
			$_SESSION[SES_FLASH_MSG]  ='<div class="success">Successfully Applied '.$_lang['lbl_coupon'].'.</div>';
		}else{
			$_SESSION[SES_FLASH_MSG]  ='<div class="error">Problem during confirming '.$_lang['lbl_coupon'].'.</div>';
		}
	break;
	
	case 'reqstClaimPromotion': 
	 $obj = new tbl_alerts();
	 if($obj->readObject(array(ALERT_POST_TYPE=>ALERT_CUPON_REQST,ALERT_TABLE_ID=>$var1,ALERT_POST_ID=>$var3))){
	 		$_SESSION[SES_FLASH_MSG]  ='<div class="error">You Already Requested For Claim Promotion</div>';
	 }else{
	 		biz_send_alert($var1,$var2,$var3,$_lang[TBL_ALERTS]['manager'][ALERT_CUPON_REQST],ALERT_FOR_MANGER,ALERT_CUPON_REQST,CUST_TYPE_LOGIN,NULL,NULL,STS_PROM_REQST);
			$_SESSION[SES_FLASH_MSG]  ='<div class="success">Claiming For Promotion requested Successfully.</div>';
	 } 
		
		$retValue = 1;
	break;
	
	case 'confirmClaimCoupon':
		$objorder = new tbl_orders();
		if($objorder->readObject(array(ORDER_ID=>$var1))){ 
				$objorder->setorder_isclaimed_promotions(1);
			  $objorder->insert(); 
				biz_send_alert($objorder->getorder_table_id(),$objorder->getorder_customer_name(),$objorder->getorder_id(),$_lang[TBL_ALERTS]['customer'][ALERT_CNF_CUPON],$objorder->getorder_customer_id(),CONFIRM_COUPON,$objorder->getorder_customer_type()); 
				//..Notifications based on the statuses @26 Oct 2013 
				//biz_send_status_notifications($objorder->getorder_table_id(),$objorder->getorder_customer_name(),$objorder->getorder_id(),STS_P,$objorder->getorder_emp_id(),$objorder->getorder_customer_id(),$objorder->getorder_customer_type());
				$retValue = 1;
		}
		unset($objorder);
		if($retValue){
			$_SESSION[SES_FLASH_MSG]  ='<div class="success">Successfully Confimred.</div>';
		}else{
			$_SESSION[SES_FLASH_MSG]  ='<div class="error">Problem during.</div>';
		}
	break;
	
	case 'getAllStatusByEvent':	
	$retValue = tbl_statuses::readArray(array(STATUS_EVENT=>"{$var1}"),$result_found,1);	 
	$visible_list = tbl_statuses::_getStatusSortList($var2,$retValue,1);
	//..Remove last node since we don't allow them to add status after end
	if(is_not_empty($visible_list)){
		$visible_list = array_reverse($visible_list);
		$cnt=0;
		foreach($visible_list as $list){
			  if($cnt==0){ 
				}else{  
					$lst_drpdwn_status[]= $list; 
				}
				$cnt++;
		} 
		if(is_not_empty($lst_drpdwn_status)){
			$lst_drpdwn_status = array_reverse($lst_drpdwn_status);
			$retValue = $lst_drpdwn_status;
		}	  
	}else{
		$retValue =array();
	}	 
	$retValue = json_encode($retValue);
	break;
	
	case 'getNextOfSelNode':
		$retValue=array();
		//..get current node info
		$curr_node=tbl_statuses::GetInfo($var1);
		//..get next node info
		$next_node=tbl_statuses::GetInfo($curr_node[STATUS_NEXT]);
		//print_r($next_node);
		if(is_not_empty($next_node) && ($next_node[STATUS_HIDDEN] == 0)){
				$retValue = $next_node;
		}
		$retValue = json_encode($retValue);
	break;
	
	case 'getPrevMustOfSelNode':
		$retValue=array();
		//..get current node info
		$curr_node_info = tbl_statuses::GetInfo($var1); 
		$new_node= tbl_statuses::_getPrevMandatoryStatus($var1,$curr_node_info[STATUS_EVENT]);
		 
		$retValue = tbl_statuses::GetInfo($new_node);
		$retValue = json_encode($retValue);
	break;
	
	case 'getRefundList':
	//biz_unset($list);
	//biz_unset($result_found); 
	$list = tbl_ord_refund::readArray(array(REFUND_PAYPAL_TXN_ID=>$var1),$result_found);
	$retValue = json_encode(array('list'=>$list,'count'=>$result_found));
	break;	
	
	case 'getAvailPromForOrder':
		$retValue = json_encode(getAvailPromForOrder($var1,$var2));	 
	break;
	
	case 'applyMiscCharges' : 
		 $objorder = new tbl_orders();
		 $retValue = 0;
		if($objorder->readObject(array(ORDER_ID=>$var1))){
				$objorder->setorder_misc_charge($var2);
				$objorder->setorder_misc_desc($var3);
			  $objorder->insert(); 
				$retValue = 1;
		}
		unset($objorder);
		if($retValue){
			$_SESSION[SES_FLASH_MSG]  ='<div class="success">'.$_lang[TBL_ORDERS]['UPDATE']['SUCCESS_MSG'].'</div>';
		}else{
			$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang[TBL_ORDERS]['UPDATE']['FAILURE_MSG'].'</div>';
		}   
	break;
	
	case 'getUsrLocation' : 
	Biz_GetUsrLocation();
	$retValue = 1;
	break;
	
	case 'getStatusNotifier':
	$retValue = json_encode(tbl_notifications::getNotifyingRole($var1));
	break;
	
	/*
	case 'getAllStatusByEvent':	
	$tbl_statuseslist = tbl_statuses::readArray(array(STATUS_EVENT=>"{$var1}"),$result_found,1);
	 $tmp = $tbl_statuseslist;
	 $listData = array(); 
		//$curritm = array_shift($tmp);
		//.find the item where the previous_node_status is zero.
		//and assign it to the the $curritm
		foreach($tmp as $itm){
			if($itm[STATUS_PREV] == 0){
				$curritm = $itm;
				break;
			}
		}
		unset($tmp); 
		if($curritm){
			
		}else{
			$tmp = $tbl_statuseslist;
			$curritm = array_shift($tmp);
		}
		  
				$current = $curritm[STATUS_ID];
						
        while($current != NULL)
        {
					 if(is_not_empty($tbl_statuseslist[$current])){
					 	$listData[$current] = $tbl_statuseslist[$current];
            $current = $tbl_statuseslist[$current][STATUS_NEXT]; 
					 }else{
					 	break;
					 }
        } 
   // $tbl_statuseslist = $listData;  
		$visible_list = $hid_list = array();
		$cnt = 0;
		$listData = array_reverse($listData);
		foreach($listData as $key=>$val){
		 	
			if($val[STATUS_HIDDEN]==0){
				if($cnt==0){ 
				}else{ 
						if(($var1 == 'ORDER') && ($val[STATUS_ID]==STS_TBL_DINING || $val[STATUS_ID]==STS_TBL_DESERT)){ 
			 			}else{ 
							$visible_list[] = $val;
						}
				}
				$cnt++;
			}
		}
		
		   
   $retValue = array_reverse($visible_list);    
	//echo "{$var1}";
	$retValue = json_encode($retValue);
	break;
	*/
	
	case 'save_layout_position'  :
	$obj = new tbl_dining_table();
	$retValue = $obj->save_layout_position($var1,$var2,$var3); 
	unset($obj);
	break;
	
	case 'getTableDetail':
	 $retValue = tbl_table_customer_session::GetInfo($var2);
	 $emp_info = tbl_table_status_link::GetTableEmployee($var1);
	 $retValue['employee_name'] = $emp_info;
	 $retValue['cust_arrive'] = tbl_table_status_link::GetTableCustArrive($var1);
	 $retValue = json_encode($retValue); 
	break; 
	
	case 'makeOrderReady' :
			
	   $obj = new tbl_orders();
	   $res = $obj->mkTkOutOrderReady($var1);
	   tbl_order_confirmation_codes::sendSMS($var2,'Your order is ready.');
			unset($obj);
			if(is_gt_zero_num($res)){
					$_SESSION[SES_FLASH_MSG] = '<div class="success">Successfully Picked.</div>';		
			}else{
					$_SESSION[SES_FLASH_MSG] = '<div class="error">Problem During Picked.</div>';
			}
			$retValue = json_encode($res); 
	break;  
	
	
	 
	
	//..for wait queue -->
}
echo $retValue;
?>