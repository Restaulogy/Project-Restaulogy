<?phpinclude_once(dirname(dirname(__FILE__)).'/init.php');include_once('header.php');$active_page = 'tbl_crm';$crm_id= get_input('crm_id');$usr_id= get_input('usr_id');$objtbl_crm= new tbl_crm();$objtbl_staff= new tbl_staff();$action='UNSUBSCRIBE';if(is_not_empty($crm_id)){	//..get suer details  $user_details = $objtbl_crm->GetInfo($crm_id);	$smarty->assign('user_details', $user_details);		$rest_details=tbl_restaurent::GetInfo($user_details[CRM_RESTAURANT]);	//print_r($rest_details);	$smarty->assign('rest_details', $rest_details);		$isSuccess = $objtbl_crm->unsubscribe_from_crm($crm_id);		$isSuccess_1 =$objtbl_staff->unsubscribe_from_prom($user_details[CRM_CUST_ID],$user_details[CRM_RESTAURANT]);						if(is_not_empty($isSuccess)){		if(is_gt_zero_num($isSuccess)){						$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['tbl_crm'][$action]['SUCCESS_MSG'].'</div>';		}elseif($isSuccess == OPERATION_FAIL){			$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['tbl_crm'][$action]['FAILURE_MSG'].'</div>';		}elseif($isSuccess == OPERATION_DUPLICATE){			$_SESSION[SES_FLASH_MSG] = '<div class="info">'.$_lang['tbl_crm'][$action]['DUPLICATE_MSG'].'</div>';		}	}//..if		$unsubscribe=$isSuccess;	}else{	$unsubscribe=0;}			unset($objtbl_crm);	$template = 'tbl_crm_list/tbl_unsubscribe.tpl'; 		$smarty->assign('unsubscribe', $unsubscribe);	$smarty->assign('active_page',$active_page);include_once('footer.php');?>