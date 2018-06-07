<?php

  include_once(dirname(dirname(__FILE__))."/init.php");
  include("header.php");
  
  $service_code = get_input("service_code", 0); 
  if(($sesslife==true) && ($Global_member['member_role_id'] ==ROLE_MANAGER || $Global_member['member_role_id'] ==ROLE_ADMIN || $Global_member['member_role_id'] ==ROLE_OWNER)){
  	$obj = new tbl_services_code();
	$service_info = $obj->GetInfo($service_code);
  	unset($obj);
    $obj = new tbl_services_details();
   if(is_gt_zero_num($service_code)){
    $action = strtoupper(get_input("action",""));
	$srvc_dtl_id = get_input("srvc_dtl_id",0);
	$srvc_dtl_name = get_input("srvc_dtl_name","");
	$srvc_dtl_desc = get_input("srvc_dtl_desc");
	$isCheckbox = get_input("isCheckbox",0);
	$offset = get_input("offset",0);
	$limit = get_input("limit",5);
	$arr = array();
	 $isSuccess = "";
	 
	 //..get list of selected items
$sel_service_details= get_input("sel_service_details");
$lst_sel_ids='';
if(is_not_empty($sel_service_details)){	
	$lst_sel_ids=implode(',', array_keys($sel_service_details));
} 
 
	if($action){
	  switch($action){
	  	case "CREATE" : $isSuccess = $obj->create($service_code,$srvc_dtl_name,$srvc_dtl_desc,$isCheckbox);
					break;
		case "UPDATE" :   $isSuccess = $obj->update($srvc_dtl_id,$srvc_dtl_name,$srvc_dtl_desc,$isCheckbox);
					break;	
					
		case "DELETE" :  
		
		//$arr[SRVC_DTL_ID] = $srvc_dtl_id; 
		if(is_not_empty($lst_sel_ids)){
			$arr = array();
			$arr[SRVC_DTL_ID] = $lst_sel_ids; 
			$isSuccess = $obj->delete($arr);
		}else{
			$isSuccess = OPERATION_FAIL;
		}
		
		break;		
	  }
	}
	
	
	
	if(is_not_empty($isSuccess)){
//		echo " $isSuccess $action _lang['service_details']['{$action}']['SUCCESS_MSG']";
		if($isSuccess){
			$_SESSION['disp_msg'] .="<div class='infobox'>".$_lang['service_details'][$action]['SUCCESS_MSG']."</div>";
		}else{
			$_SESSION['disp_msg'] .="<div class='errorbox'>".$_lang['service_details'][$action]['FAILURE_MSG']."</div>";
		}
		 
	}  
		
		$arr = array();
		$arr[SRVC_DTL_SERVICE_CODE] = $service_code;
		$arr["offset"] = $offset;
		$arr["limit"] = $limit;
		$result_found = 0; 
		 
		$info = $obj->readArray($arr,$result_found,1);
		
		$smarty->assign('service_info',$service_info); 
		
		$breadcrumbs[] = array("link"=>$website."/user/pref_mng_cntrols.php", "title"=>$_lang['main']['navbar']['controls']);
	
		$breadcrumbs[] = array("link"=>$website."/user/tbl_services_code.php", "title"=>$_lang['tbl_services_code']['listing_title']); 
		if($service_info){
			$breadcrumbs[] = array("link"=>$website."/user/tbl_services_code.php?srvc_id=".$service_info['srvc_id']."&".MODE_TITLE."=".MODE_VIEW, "title"=>$service_info['srvc_name']); 
			$breadcrumbs[] = array("link"=>$website."/user/service_details.php?service_code=".$service_info['srvc_id']."&".MODE_TITLE."=".MODE_VIEW, "title"=>$_lang['service_details']['title']); 
		}
		 
		
		$smarty->assign('info',$info); 
		$smarty->assign('result_found',$result_found);
		$smarty->assign('pagination',biz_pagination(array("url"=>"{$website}/user/service_details.php?service_code={$service_code}","limit"=>$limit,"offset"=>$offset,"count"=>$result_found)));
   		
   }else{
   		$_SESSION['disp_msg'] .= "<div class='error'>{$_lang['service_details']['non_empty_msg']['srvc_dtl_code']}</div>"; 
   } 
  }else{
  	 $_SESSION['disp_msg'] .= "<div class='error'>{$_lang['messages']['non_authorized_user']}</div>"; 
  }
   $template  = "service_details.tpl";
  
	echo '<script type="text/javascript">window.location.href="'.$website.'/user/tbl_services_code.php?'.MODE_TITLE.'='.MODE_VIEW.'&srvc_id='.$service_code.'";</script>';
	exit;
	
  include("footer.php");  

?>