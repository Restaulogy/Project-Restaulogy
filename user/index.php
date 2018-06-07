<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
include('header.php');
$title = $_lang['home'];
//$template = 'index.tpl'; 
//$smarty->assign('active_page','login');
$template = 'online_store.tpl';
$smarty->assign('active_page','online_store');
	
$restaurant = get_input('restaurant');
$is_prom = get_input('is_prom',0);
$url = $website.'/user/tbl_menu.php'; 
//echo "sdsadasd"; exit;
//..do processing for the posted variables	
//if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE])){ 
 if(is_gt_zero_num($restaurant)){
 	  $_SESSION[SES_RESTAURANT] =$restaurant;
	  $rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);		 
	  if(is_not_empty($rest_info)){
	    if((is_gt_zero_num($rest_info[RESTAURENT_IS_PAYPAL])) && (is_not_empty($rest_info[RESTAURENT_PAYPAL_EMAIL]))){
			$_SESSION[SES_PAYPAL_EMAIL] = $rest_info[RESTAURENT_PAYPAL_EMAIL];								
		  }	
			$_SESSION[SES_RESTNT_NM] =$rest_info[RESTAURENT_NAME];	
	  }
  	unset($rest_info);
		//..set online store
		
		if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE])==FALSE){ 
			$_SESSION[SES_ONLINE_STORE]= 1;			
		}
		if(is_gt_zero_num($is_prom)){ 
			 biz_script_forward($website.'/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR');	
		}else{
			 biz_script_forward($website.'/user/tbl_menu.php?online_store=1&menu_restaurent='.$restaurant);
		}
	  
 }else{ 
 
 	$restaurant_list =  tbl_restaurent::readArray(array('isActive'=>1),$result_found); 
	$smarty->assign('result_found',$result_found);
	$smarty->assign('restaurant_list',$restaurant_list);
	if($sesslife==true){		
		if($Global_member['member_role_id']!=ROLE_CUSTOMER && $Global_member['member_role_id']!=ROLE_DEV ){
			/*if($Global_member['member_role_id']==ROLE_ADMIN){
				$objtbl_admin_dashboard =  tbl_admin_dashboard::readArray(array(ADMDASH_FOR_ADMIN=>1),$result_found_re); 
			}else{
				$objtbl_admin_dashboard =  tbl_admin_dashboard::readArray(array(ADMDASH_FOR_MNGR=>1),$result_found_re); 
			}			
			$smarty->assign('tbl_admin_dashboard_list',$objtbl_admin_dashboard);*/
			//if($Global_member['member_role_id']==ROLE_MANAGER){		
				$alert_id= get_input('alert_id');
				$action = strtoupper(get_input(ACTION_TITLE));
				$objtbl_alerts=new tbl_alerts();
				if($action==ACTION_DELETE){
					$isSuccess = $objtbl_alerts->deactivate($alert_id);;
				}
				if(is_not_empty($isSuccess)){
					if(is_gt_zero_num($isSuccess)){
						$_SESSION[SES_FLASH_MSG] = "<div class='success'>".$_lang['tbl_alerts'][$action]['SUCCESS_MSG']."</div>";
					}elseif($isSuccess == OPERATION_FAIL){
						$_SESSION[SES_FLASH_MSG] = "<div class='error'>".$_lang['tbl_alerts'][$action]['FAILURE_MSG']."</div>";
					}elseif($isSuccess == OPERATION_DUPLICATE){
						$_SESSION[SES_FLASH_MSG] = "<div class='info'>".$_lang['tbl_alerts'][$action]['DUPLICATE_MSG']."</div>";
					}
				}//..if
				
				$mode = strtoupper(get_input(MODE_TITLE));
				$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
				$limit =  get_input(LIMIT_TITLE,10);
				$sort_on = get_input(SORT_ON,'alert_id');
				$sort_by=$new_sort='';
				biz_set_sorting_var($sort_by,$new_sort,'DESC');
				$result_found=0;
				$search_array = array(OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,'isActive'=>1,SORT_BY=>$sort_by,SORT_ON=>$sort_on,ALERT_PERSON=>-($Global_member['member_role_id']),ALERT_PERSON_TYPE=>CUST_TYPE_LOGIN,ALERT_RESTAURANT=>$_SESSION[SES_RESTAURANT]);				
				$tbl_alertslist = $objtbl_alerts->readArray($search_array,$result_found,1);
				$allpageCount = 0;
				$currentPage = 0;
				$smarty->assign('pagination',biz_pagination(array('url'=>$navigationURL,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset,'count'=>$result_found),$allpageCount,$currentPage));
				$smarty->assign('allpageCount',$allpageCount);
				$smarty->assign('currentPage',$currentPage);
				$smarty->assign('tbl_alertslist', $tbl_alertslist);
				$smarty->assign('result_found',$result_found);
				unset($objtbl_alerts);
			//}
			
			$template = 'index.tpl';
			$smarty->assign('active_page','index'); 	
		}			
	}else{
		//..check if the qrsession is there
		if(is_gt_zero_num($_SESSION[SES_TABLE])==FALSE){
				$_SESSION['qr_sess_expired']=1;
				$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['qrcode']['empty'].'</div>';					
		}
		biz_script_forward($website.'/user/dashboard.php');
	}  
		
 } 
 if($_SESSION['qr_sess_expired']){
 		unset($_SESSION['qr_sess_expired']);	
 } 
/*}else{ 
  $template = 'index.tpl';
}*/
 
/*$breadcrumbs = array(array('link'=>$website,'title'=>$_lang['main']['landing_page_title']));*/
include_once('footer.php');   
?>