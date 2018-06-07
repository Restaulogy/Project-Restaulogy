<?php
include_once("../init.php");
 
//$_SESSION[SES_CONDITIONS] = $_REQUEST;

$bogo_key 						= get_input('bogo_key');
$bogo_dish 						= get_input('bogo_dish');
$bogo_submenu 				= get_input('bogo_submenu');
$bogo_qty 						= get_input('bogo_qty');
$bogo_action					= get_input('bogo_action');
$bogo_submenu_title 	= get_input('bogo_submenu_title');
$bogo_dish_title 			= get_input('bogo_dish_title');
$bogo_id							= get_input('bogo_id',0);
$prom_condition 			= get_input('prom_condition',0);
$isUpdate 						= get_input('isUpdate',0);

$prmcon_promotion = get_input('prmcon_promotion',$_SESSION[SES_PROMOTION]); 

if((is_gt_zero_num($_SESSION[SES_CONDITIONS]['sequence_num']))==FALSE){
	$_SESSION[SES_CONDITIONS]['sequence_num'] = 1;
} 

$objtbl_prom_cond_details = new tbl_prom_cond_details();

if(is_gt_zero_num($bogo_dish)){
	$bogo_type = 'BOGO_ITEM';
}else{
	$bogo_type = 'BOGO';
}
 
if(is_not_empty($bogo_action)){ 
 switch($bogo_action){
		case ACTION_SAVE 		: 
		    if(is_gt_zero_num($isUpdate)){
					if(is_gt_zero_num($bogo_id)){
						$isSuccess = $objtbl_prom_cond_details->update($bogo_id,$prom_condition,$bogo_type, $bogo_qty, $bogo_submenu, $bogo_dish, 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL,'',''); 
				 	}else{ 
					 $isSuccess = $objtbl_prom_cond_details->create($prom_condition,$bogo_type, $bogo_qty, $bogo_submenu, $bogo_dish, 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL,'',''); 
					}
				}else{
					$is_new_key = 0; 
					if(is_not_empty($bogo_key)){
					 $key =	$bogo_key; 
					}else{
					  $key =		$_SESSION[SES_CONDITIONS]['sequence_num'] + 1;
							$is_new_key =1; 
				 }
					//if(is_gt_zero_num($bogo_qty)){
					if(is_not_empty($bogo_qty)){
						$_SESSION[SES_CONDITIONS]['bogo'][$key]['submenu'] = $bogo_submenu;
						$_SESSION[SES_CONDITIONS]['bogo'][$key]['submenu_title'] = $bogo_submenu_title;
						
						$_SESSION[SES_CONDITIONS]['bogo'][$key]['dish'] = $bogo_dish;
						$_SESSION[SES_CONDITIONS]['bogo'][$key]['dish_title'] = $bogo_dish_title;
					  $_SESSION[SES_CONDITIONS]['bogo'][$key]['qty'] = $bogo_qty; 
						if($is_new_key){
							$_SESSION[SES_CONDITIONS]['sequence_num']=		$_SESSION[SES_CONDITIONS]['sequence_num'] + 1;
						}
					}
				}	
		break; 
		
		case 'IS_ALREADY_THERE' :
		 				 $isMatched = 0;
								if(($isUpdate == 0) && is_not_empty($_SESSION[SES_CONDITIONS]['bogo'])){
									 foreach($_SESSION[SES_CONDITIONS]['bogo'] as $_key=>$bogo_item){
									 if(is_gt_zero_num($bogo_dish)){ 
												if($bogo_item['dish'] == $bogo_dish){
													if(is_gt_zero_num($bogo_key) && ($_key == $bogo_key)){
												 	$isMatched = 1;break;
												 }else{
												 	$isMatched = 0;break;
												 }
														
										 	 }
										}
										if((is_gt_zero_num($isMatched)==false)&&(is_gt_zero_num($bogo_submenu))){
											if($bogo_item['submenu']==$bogo_submenu){
												 if(is_gt_zero_num($bogo_key) && ($_key == $bogo_key)){
												 	$isMatched = 0;break;
												 }else{
												 	$isMatched = 1;break;
												 }
												 
											}
										} 
								 }
								} 
								echo $isMatched;exit;
		break;
		
		case ACTION_DELETE :  
		 if(is_gt_zero_num($isUpdate)){
		 	if($bogo_id){
		   $isSuccess =  $objtbl_prom_cond_details->delete(array(PRCNDTL_ID=>$bogo_id));
		  }
		 }else{
		 if(isset($_SESSION[SES_CONDITIONS]['bogo'][$bogo_key])){
		   unset($_SESSION[SES_CONDITIONS]['bogo'][$bogo_key]);
		  }
		 } 
		 break;  
	} 
}
$action_str = ACTION_CREATE;
if($bogo_action == ACTION_SAVE){
	if(is_gt_zero_num($isUpdate)){
		$action_str = ACTION_UPDATE;
	}else{
		if(is_gt_zero_num($bogo_id)){
			$action_str = ACTION_UPDATE;
		} 
	}
}elseif($bogo_action == ACTION_DELETE){
		$action_str = ACTION_DELETE;
}  
		
$arr = biz_getLangMsgStrForDftlAct($retValue);
	 
if(is_not_empty($arr)){ 
	 if(is_not_empty($_lang[TBL_ORDERS]['tbl_prom_cond_details'][$action_str][$arr['msg']])){
	 	$_SESSION[SES_FLASH_MSG] = '<div class="'.$arr['class'].'">'.$_lang['tbl_prom_cond_details'][$action_str][$arr['msg']].'</div>';
	 }
} 
if(is_gt_zero_num($isUpdate)){ 
  biz_script_forward($website.'/user/tbl_prom_cond_details.php?promotion='.$prmcon_promotion.'&'.MODE_TITLE.'='.MODE_UPDATE.'&'.PRCNDTL_CONDITION.'='.$prom_condition);
}else{ 
	biz_script_forward($website.'/user/tbl_prom_cond_details.php?promotion='.$prmcon_promotion.'&'.MODE_TITLE.'='.MODE_CREATE);
}

  
	//unset($_SESSION[SES_CONDITIONS]['bogo']);
/*foreach($_REQUEST['prcndtl_bogo_qty'] as $key=>$val){
	$_SESSION[SES_CONDITIONS]['bogo'][$key]['qty'] = $val;
	$_SESSION[SES_CONDITIONS]['bogo'][$key]['submenu'] = $_REQUEST['prcndtl_bogo_sbmnu'][$key];
	$_SESSION[SES_CONDITIONS]['bogo'][$key]['submenu_dish'] = $_REQUEST['prcndtl_bogo_sbmnu_dish'][$key]; 
}*/			
//$_SESSION[SES_CONDITIONS]['bogo']['count'] = $key + 1; 
?>