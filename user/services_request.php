<?php

include_once(dirname(dirname(__FILE__)).'/init.php');
include('header.php');

if(is_gt_zero_num($_SESSION[SES_TABLE]))
	$pst_table_id =$_SESSION[SES_TABLE]; 
else	
	$pst_table_id = get_input('table_id',$_SESSION[SES_TABLE]);

$active_page='services_request';
  
$srvc_reqst_id= get_sql_input('srvc_reqst_id');
$srvc_reqst_created_by= get_sql_input('created_by','');
$srvc_reqst_srvc_id= get_sql_input('service_id');
$srvc_reqst_table_id= $pst_table_id;//get_sql_input('table_id');
$srvc_reqst_emp_id= get_sql_input('srvc_reqst_emp_id');
$srvc_reqst_tbl_sft_assoc_id= get_sql_input('srvc_reqst_tbl_sft_assoc_id');
/*$srvc_reqst_cat_id= get_input('srvc_reqst_cat_id');*/
$srvc_reqst_status= get_sql_input('srvc_reqst_status');
$srvc_reqst_special_note= get_sql_input('srvc_reqst_special_note');
$srvc_reqst_add_quests= get_sql_input('srvc_reqst_add_quests');

$srvc_reqst_created_on= get_sql_input('srvc_reqst_created_on');
$srvc_reqst_attended_on= get_sql_input('srvc_reqst_attended_on');
$srvc_reqst_completed_at= get_sql_input('srvc_reqst_completed_at');
$action = strtoupper(get_sql_input(ACTION_TITLE));
$mode = strtoupper(get_sql_input(MODE_TITLE));
$offset = get_sql_input(OFFSET_TITLE,OFFSET_VALUE);
$limit =  get_sql_input(LIMIT_TITLE,LIMIT_VALUE);
$url = $website.'/user/tbl_services_requests.php';
    
$mode = get_sql_input('mode'); 
$action = strtoupper(get_sql_input('action'));
$success = strtoupper(get_sql_input('success'));
//$pst_table_id = get_sql_input('table_id',0);
if(is_not_empty($srvc_reqst_created_by))
	$created_by = $srvc_reqst_created_by;
if(is_not_empty($_SESSION["cust_nm"]))
	$created_by = $_SESSION["cust_nm"];	
	
$srvc_reqst_emp_id = (is_gt_zero_num($srvc_reqst_emp_id)?$srvc_reqst_emp_id:GetDfltTblEmployee($srvc_reqst_table_id));
		
$service_id = get_sql_input('service_id',0);

  if(is_gt_zero_num($pst_table_id)){
 
 	$obj = new tbl_services_code();
	$services = $obj->GetActiveServices();
	$servicelist = $obj->readArray(array('isActive'=>1));
	$smarty->assign('servicelist',$servicelist);
	//print_r($servicelist); 
	unset($obj);
	 
	$obj = new tbl_dining_table();
	$dininginfo = $obj->GetInfo($pst_table_id);
	unset($obj); 
    
	$smarty->assign('dininginfo',$dininginfo);
    $smarty->assign('services',$services);
	
 $sub_services = array();
 $sub_services_count = 0;
 
 $srvc_add_qust=array();
 $srvc_add_qust_cnt=array();
 
  if($service_id){
	$obj = new tbl_services_details();
	$arr[SRVC_DTL_SERVICE_CODE] = $service_id;  
	$sub_services = $obj->readArray($arr,$sub_services_count,1);
	unset($obj); 	
	//..also fetch service additional questions for that service	
	$clsobj_srvc_cd = new tbl_services_requests();
	$srvc_add_qust = $clsobj_srvc_cd->readArray(array(SRVC_REQST_SRVC_ID=>$service_id,SRVC_REQST_ADD_QUESTS=>''),$srvc_add_qust_cnt,1);		
	unset($clsobj_srvc_cd); 
  }
	
  if(is_not_empty($action)){
    $obj = new tbl_services_requests();
    $validForm = true;
	$err = '';	
	//..Capture the service deatils selected options values 
 	$checked_sub_srvc = array();
	foreach($_POST as $key=>$val){  
		if(strpos($key,'sub_srvc_')===false){ 
		}else{
		 	$key = str_ireplace('sub_srvc_','',$key);
			if(is_gt_zero_num($key)){
				$checked_sub_srvc[$key] = $val;
			} 
		}  
	}
	//print_r($checked_sub_srvc);
	
	if(is_gt_zero_num($service_id)==false){
		$err .= '<p class="error">Please, Enter Number.</p>';
		$validForm = false;
	}
	/*if(is_not_empty($created_by)==false){
		$err .= '<p class="error">Please, Enter your name.</p>';
		$validForm = false;
	}*/
	  
	$isSuccess = 0;  
	if($validForm == true){
	 $err = '';
	
 	 if($action == 'CREATE'){  
		/*$request_id = $obj->create($service_id,$pst_table_id,$created_by,$checked_sub_srvc); */
		//..store the customer name in session for further processing
		if($sesslife==FALSE){
			$_SESSION[SES_CUST_NM]=$srvc_reqst_created_by;	
			$_SESSION[SES_COOKIE_UID] = checkNcreateUserCookieId($_SESSION[SES_CUST_NM]);
			$cust_id = $_SESSION[SES_COOKIE_UID];
			$cust_type = CUST_TYPE_COOKIE;
		}else{
			$cust_id = $_SESSION['guid'];
			$cust_type = CUST_TYPE_LOGIN;
		}	
		 
		$_SESSION[SES_CUSTOMER_SESSION] = checkNcreateSession($srvc_reqst_table_id,$srvc_reqst_created_by,1);
		
			
		$isSuccess = $obj->create($srvc_reqst_created_by, $srvc_reqst_srvc_id, $srvc_reqst_table_id, $_SESSION[SES_CUSTOMER_SESSION],$srvc_reqst_emp_id, $srvc_reqst_tbl_sft_assoc_id, $srvc_reqst_status,$srvc_reqst_special_note,$srvc_reqst_add_quests, $srvc_reqst_created_on, $srvc_reqst_attended_on, $srvc_reqst_completed_at,$cust_id,$cust_type);
		
		//..Save into the request service details table 
		if(is_not_empty($checked_sub_srvc)){
			tbl_serv_request_details::createBulkServices($isSuccess,$checked_sub_srvc);
		}
		
		if($isSuccess){ 		
            //..Add one record into the service request stage table
    		//..First find default value for stage
    		/*$obj_srvc_stg = new tbl_service_stage();
    	  $dflt_srvc_stg = $obj_srvc_stg->GetDefaultStage($srvc_reqst_srvc_id);*/
				$dflt_srvc_stg = tbl_statuses::_getDefaultStatus("'REQUEST'",'REQUEST');
	 	 	//..check default stage is there then set default stage to requstt 
        if($dflt_srvc_stg>0){
           //..Add one record into the service request stage table
             $obj_srvc_rqst_stg = new tbl_service_request_stage();
             $obj_srvc_rqst_stg->create($isSuccess,$dflt_srvc_stg ,0);
        }else{
						//..else	
						$obj->completeRequest($isSuccess,GetDfltTblEmployee($pst_table_id));	
			}
            //..logic for Pending Request alerts
			$lastPendingRequest = $isSuccess;
			/* echo "<script>window.location.href='{$website}/user/services_request.php?table_id=$pst_table_id&success=create'</script>";*/
			//$err .= '<div class="success">'.$_lang['services_requests'][$action]['SUCCESS_MSG'].'</div>';
			if(is_gt_zero_num($_SESSION[SES_CUSTOMER_SESSION])== false){
				//$err .= '<div class="error">'.$_lang[TBL_ALERTS]['customer'][TEMP_REQUEST].'</div>';
				/*@alertToManager($srvc_reqst_table_id,$srvc_reqst_created_by,$isSuccess,sprintf(ALERT_TMP_REQST, $srvc_reqst_table_id));
				//..change@17Aug2013#1 <---
				//..notification to server
				biz_send_alert($srvc_reqst_table_id,$srvc_reqst_created_by,$isSuccess,sprintf($_lang[TBL_ALERTS]['manager'][ALERT_TMP_REQST], $srvc_reqst_table_id),$srvc_reqst_emp_id,ALERT_TMP_REQST);	*/		
				//..Notifications based on teh statuses @26 Oct 2013 
				biz_send_status_notifications($srvc_reqst_table_id,$srvc_reqst_created_by,$isSuccess,STS_REQST_WO_SESSION,$srvc_reqst_emp_id);
				
				//..change@17Aug2013#1 --->
			}else{
				//$err .= '<div class="infobox">'.$_lang['services_requests'][$action]['SUCCESS_MSG'].'</div>';
				//..change@17Aug2013#1 <---
				//@alertToManager($srvc_reqst_table_id,$srvc_reqst_created_by,$isSuccess,ALERT_PNDG_REQST);	
				
				//..Notifications based on teh statuses @26 Oct 2013 
				biz_send_status_notifications($srvc_reqst_table_id,$srvc_reqst_created_by,$isSuccess,STS_REQST_INITIATED,$srvc_reqst_emp_id);
				
				/*//..notification to manager
				biz_send_alert($srvc_reqst_table_id,$srvc_reqst_created_by,$isSuccess,$_lang[TBL_ALERTS]['manager'][ALERT_PNDG_REQST],ALERT_FOR_MANGER,ALERT_TMP_REQST);
				//..notification to server
				biz_send_alert($srvc_reqst_table_id,$srvc_reqst_created_by,$isSuccess,$_lang[TBL_ALERTS]['manager'][ALERT_PNDG_REQST],$srvc_reqst_emp_id,ALERT_TMP_REQST);*/
				//..change@17Aug2013#1 --->
			}
			if($srvc_reqst_emp_id==0){
				//@alertToManager($srvc_reqst_table_id,$srvc_reqst_created_by,$isSuccess,sprintf(REQST_TBL_WITHOUT_SERVER, $srvc_reqst_table_id));
				//..Notifications based on teh statuses @26 Oct 2013 
				biz_send_status_notifications($srvc_reqst_table_id,$srvc_reqst_created_by,$isSuccess,STS_REQST_WO_SERVER,$srvc_reqst_emp_id);				
			}
			//..Here need to redirect to dashboard page
		 //$_SESSION['disp_msg']=$err;
			biz_script_forward($website.'/user/dashboard.php?table_id='.$pst_table_id);
		}else{
			$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['services_requests'][$action]['FAILURE_MSG'].'</div>';
		}
	}		
	}else{ 
		 $_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['messages']['revise_form'].'</div>';
	} 
  }   
 }

   $template= 'services_request.tpl'; 
   $smarty->assign('sub_services_count',$sub_services_count);
   $smarty->assign('sub_services',$sub_services);
   $smarty->assign('srvice_add_qustions_cnt',$srvc_add_qust_cnt);
   $smarty->assign('srvice_add_qustions',$srvc_add_qust); 
   $smarty->assign('service_id',$service_id);
   $smarty->assign('table_id',$pst_table_id);
   $smarty->assign('created_by',$created_by);
   $smarty->assign('qr_code',1);
   $smarty->assign('mode',$mode);
   $smarty->assign('active_page',$active_page);
   
   if(is_gt_zero_num($pst_table_id)){
   		$brd_url="{$website}/user/services_request.php?table_id=$pst_table_id";
   }else{
   		$brd_url=$url;
   }
   $breadcrumbs = array(/* array(
   							'link'=>$website.'/user/dashboard.php',
							'title'=>$_lang['main']['customer_nav_menu']['dashboard']),*/
						 array(
						 	'link'=>$brd_url,
							'title'=>$_lang['services_requests']['new_request'])
				); 
   include('footer.php');  

?>