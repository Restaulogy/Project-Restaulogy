<?phpinclude_once(dirname(dirname(__FILE__)).'/init.php');include_once(dirname(dirname(__FILE__))."/modules/business_listing/classes/pds_list_promotions.class.php");include_once('header.php');$_show_pop_up_frm=0;$active_page = 'tbl_prom_cond_details';$promotion = get_input('promotion',$_SESSION[SES_PROMOTION]); $prcndtl_condition = get_input('prcndtl_condition', $_SESSION[SES_PROM_COND]);  $action = strtoupper(get_input(ACTION_TITLE));$mode = strtoupper(get_input(MODE_TITLE));$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);if(is_gt_zero_num($promotion)==false){				$_SESSION[SES_FLASH_MSG] = '<div class="error">Please select/create the basic promotion first to view purchase items.</div>';		biz_script_forward($_SERVER['HTTP_REFERER']);}else{		if(is_gt_zero_num($_SESSION[SES_PROMOTION])==FALSE)			$_SESSION[SES_PROMOTION] = $promotion;	  }//print_r($_SESSION);/*if(is_gt_zero_num($prcndtl_condition)){	$_SESSION[SES_PROM_COND] = $prcndtl_condition;	$prom_cond_info  = tbl_prom_conditions::GetInfo($prcndtl_condition);	$mode = MODE_CREATE;	if(is_not_empty($prom_cond_info)){ 		$mode = MODE_UPDATE;	  if(is_gt_zero_num($promotion) == false){			$promotion  = $prom_cond_info[PRMCON_PROMOTION] ;		} 		unset($prom_cond_info);	}}*/if($sesslife == true && is_gt_zero_num($promotion)){$disc_amt= get_input('disc_amt',0);$disc_amt_type= get_input('disc_amt_type','VALUE');$prmcon_title= get_input('prmcon_title','-');$prcndtl_id= get_input('prcndtl_id');$prcndtl_cond_type= get_input('prcndtl_cond_type');$prcndtl_bogo_qty= get_input('prcndtl_bogo_qty');$prcndtl_bogo_sbmnu= get_input('prcndtl_bogo_sbmnu');$prcndtl_bogo_sbmnu_dish= get_input('prcndtl_bogo_sbmnu_dish',0);$prcndtl_bogo_id = get_input('prcndtl_bogo_id');$prcndtl_wkday_id = get_input('prcndtl_wkday_id');$prcndtl_daytime_id = get_input('prcndtl_daytime_id');$chk_cond_sel_opt= get_input('chk_cond_sel_opt');//..weekdays availability section$prcndtl_wkdy_avail=array();//..Default values for all days don't show'$prcndtl_wkdy_sunday=$prcndtl_wkdy_monday=$prcndtl_wkdy_tuesday=$prcndtl_wkdy_wednesday=$prcndtl_wkdy_thursday=$prcndtl_wkdy_friday=$prcndtl_wkdy_saturday='N';if(is_not_empty($_POST['prcndtl_wkdy_avail'])){	$prcndtl_wkdy_avail=$_POST['prcndtl_wkdy_avail']; 	//print_r($prcndtl_wkdy_avail);	//..Capture the posted values in to the variables	foreach($prcndtl_wkdy_avail as $val){		switch (strtoupper($val)) {			case 'SUN':			   $prcndtl_wkdy_sunday='Y';			   			   break;			case 'MON':			   $prcndtl_wkdy_monday='Y';			   break;			case 'TUE':			   $prcndtl_wkdy_tuesday='Y';			   break;			case 'WED':			   $prcndtl_wkdy_wednesday='Y';			   break;			case 'THU':			   $prcndtl_wkdy_thursday='Y';			   break;			case 'FRI':			   $prcndtl_wkdy_friday='Y';			   break;			case 'SAT':			   $prcndtl_wkdy_saturday='Y';			   break;		}	}}$prcndtl_wkdy_sunday= get_input('prcndtl_wkdy_sunday');$prcndtl_wkdy_monday= get_input('prcndtl_wkdy_monday');$prcndtl_wkdy_tuesday= get_input('prcndtl_wkdy_tuesday');$prcndtl_wkdy_wednesday= get_input('prcndtl_wkdy_wednesday');$prcndtl_wkdy_thursday= get_input('prcndtl_wkdy_thursday');$prcndtl_wkdy_friday= get_input('prcndtl_wkdy_friday');$prcndtl_wkdy_saturday= get_input('prcndtl_wkdy_saturday');$prcndtl_daytime_from= get_input('prcndtl_daytime_from');$prcndtl_daytime_to= get_input('prcndtl_daytime_to');$prcndtl_start_date= get_input('prcndtl_start_date');$prcndtl_end_date= get_input('prcndtl_end_date');$sort_on = get_input(SORT_ON,'prcndtl_id');$sort_by=$new_sort='';biz_set_sorting_var($sort_by,$new_sort);$url = $website.'/user/tbl_prom_cond_details.php?promotion='.$promotion;//$url = '{$website}/user/tbl_prom_discounts.php?promotion=$prmdisc_promotion';$navigationURL = $url.'?'.SORT_ON.'='.$sort_on.'&'.SORT_BY.'='.$sort_by;$isSuccess = '';$objtbl_prom_cond_details= new tbl_prom_cond_details();  //print_r($_SESSION[SES_CONDITIONS]);//..get list of selected items$sel_prom_cond_details= get_input('sel_prom_cond_details');$lst_sel_ids='';if(is_not_empty($sel_prom_cond_details)){		$lst_sel_ids=implode(',', array_keys($sel_prom_cond_details));} if(is_not_empty($action)){  	switch($action){ 		case ACTION_CREATE:  			//..Based on the condition type checkbox checked..			if(is_not_empty($prmcon_title)){				//..Insert record into the main conditions table				$objtbl_prom_conditions=new tbl_prom_conditions();					$bogo_id = $objtbl_prom_conditions->create($promotion, $prmcon_title,'', '');									if(is_not_empty($chk_cond_sel_opt)){ 					foreach($chk_cond_sel_opt as $val){						switch (strtoupper($val)){							case 'BOGO':							case 'BOGO_ITEM':			   							   if(is_gt_zero_num($bogo_id)){							   	//..insert record into the main conditions dtails table									 foreach($prcndtl_bogo_qty as $key=>$value){									 	 $isSuccess = $objtbl_prom_cond_details->create($bogo_id,$val, $prcndtl_bogo_qty[$key], $prcndtl_bogo_sbmnu[$key], $prcndtl_bogo_sbmnu_dish[$key], 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL,'','');																	 	 //..update the promotion deatils									 	 if($isSuccess>0){									 	 	if($disc_amt>0){												usr_update_promotion_by_field($promotion, 'disc_amt', $disc_amt,0);												usr_update_promotion_by_field($promotion, 'disc_amt_type', $disc_amt_type,1);											}										 												 }									 	 								 	 }																		   } 							   break;							/*case 'WKDAY':							  $isSuccess = $objtbl_prom_cond_details->create($bogo_id,$val, 0, 0, 0, 								if_null($prcndtl_wkdy_avail['sun'],'N'),								if_null($prcndtl_wkdy_avail['mon'],'N'),								if_null($prcndtl_wkdy_avail['tue'],'N'),								if_null($prcndtl_wkdy_avail['wed'],'N'),								if_null($prcndtl_wkdy_avail['thu'],'N'),								if_null($prcndtl_wkdy_avail['fri'],'N'),								if_null($prcndtl_wkdy_avail['sat'],'N'),								NULL, NULL,'','');								 unset($_SESSION[SES_CONDITIONS]);							   break;							case 'DAYTIME':							   $isSuccess = $objtbl_prom_cond_details->create($bogo_id,$val, 0, 0, 0, 'N', 'N', 'N', 'N', 'N', 'N', 'N', $prcndtl_daytime_from, $prcndtl_daytime_to,'','');							   break;	*/								}					}				}				}			/*$isSuccess = $objtbl_prom_cond_details->create($prcndtl_condition, $prcndtl_cond_type, $prcndtl_bogo_qty, $prcndtl_bogo_sbmnu, $prcndtl_bogo_sbmnu_dish, $prcndtl_wkdy_sunday, $prcndtl_wkdy_monday, $prcndtl_wkdy_tuesday, $prcndtl_wkdy_wednesday, $prcndtl_wkdy_thursday, $prcndtl_wkdy_friday, $prcndtl_wkdy_saturday, $prcndtl_daytime_from, $prcndtl_daytime_to, $prcndtl_start_date, $prcndtl_end_date);*/			unset($_SESSION[SES_CONDITIONS]);		  			break;		case ACTION_UPDATE: 		if(is_gt_zero_num($prcndtl_condition)){			 $const_cond_sel = array('BOGO','BOGO_ITEM','WKDAY','DAYTIME');			 $unchk_cond_sel_opt = array();			 			if(is_not_empty($chk_cond_sel_opt)){ 						######################################################			//procedure for deleting the unseleted items #START 				//step1..first find the unseleted items				foreach($const_cond_sel as $val){					if(in_array($val,$chk_cond_sel_opt)){ 					}else{						$unchk_cond_sel_opt[] = $val;					}				}				unset($val); 				//print_r($chk_cond_sel_opt);								//step2..delete the unselected items				foreach($unchk_cond_sel_opt as $val){					//tbl_prom_cond_details::delete(array(PRCNDTL_CONDITION=>$prcndtl_condition,PRCNDTL_COND_TYPE=>$val));				}  				unset($val);			//procedure for deleting the unseleted items #End			######################################################				 					foreach($chk_cond_sel_opt as $val){						 						 switch (strtoupper($val)){							case 'BOGO':							case 'BOGO_ITEM':			 							   	//..insert record into the main conditions dtails table  								 foreach($prcndtl_bogo_qty as $key=>$value){ 								 	 if(is_gt_zero_num($prcndtl_bogo_id[$key])){									 	$isSuccess = $objtbl_prom_cond_details->update($prcndtl_bogo_id[$key],$prcndtl_condition,$val, $prcndtl_bogo_qty[$key], $prcndtl_bogo_sbmnu[$key], $prcndtl_bogo_sbmnu_dish[$key], 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL,'',''); 									 }else{ 											$isSuccess = $objtbl_prom_cond_details->create($prcndtl_condition,$val, $prcndtl_bogo_qty[$key], $prcndtl_bogo_sbmnu[$key], $prcndtl_bogo_sbmnu_dish[$key], 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL,'','');									 } 									 if($isSuccess>0){								 	 	if($disc_amt>0){											usr_update_promotion_by_field($promotion, 'disc_amt', $disc_amt,0);											usr_update_promotion_by_field($promotion, 'disc_amt_type', $disc_amt_type,1);										}									 											 }								 }	 							   break;							/*case 'WKDAY':  						 if(is_gt_zero_num($prcndtl_wkday_id)){						 		$isSuccess = $objtbl_prom_cond_details->update($prcndtl_wkday_id,$prcndtl_condition,$val,0,0,0,								if_null($prcndtl_wkdy_avail['sun'],'N'),								if_null($prcndtl_wkdy_avail['mon'],'N'),								if_null($prcndtl_wkdy_avail['tue'],'N'),								if_null($prcndtl_wkdy_avail['wed'],'N'),								if_null($prcndtl_wkdy_avail['thu'],'N'),								if_null($prcndtl_wkdy_avail['fri'],'N'),								if_null($prcndtl_wkdy_avail['sat'],'N'),								NULL, NULL,'','');  						 }else{						 		$isSuccess = $objtbl_prom_cond_details->create($prcndtl_condition,$val,0,0,0,								if_null($prcndtl_wkdy_avail['sun'],'N'),								if_null($prcndtl_wkdy_avail['mon'],'N'),								if_null($prcndtl_wkdy_avail['tue'],'N'),								if_null($prcndtl_wkdy_avail['wed'],'N'),								if_null($prcndtl_wkdy_avail['thu'],'N'),								if_null($prcndtl_wkdy_avail['fri'],'N'),								if_null($prcndtl_wkdy_avail['sat'],'N'),								NULL, NULL,'','');  						 } 					 			break;							case 'DAYTIME':  							if(is_gt_zero_num($prcndtl_daytime_id)){						 		$isSuccess = $objtbl_prom_cond_details->update($prcndtl_daytime_id,$prcndtl_condition,$val, 0, 0, 0, 'N', 'N', 'N', 'N', 'N', 'N', 'N', $prcndtl_daytime_from, $prcndtl_daytime_to,'','');								}else{									$isSuccess = $objtbl_prom_cond_details->create($prcndtl_condition,$val, 0, 0, 0, 'N', 'N', 'N', 'N', 'N', 'N', 'N', $prcndtl_daytime_from, $prcndtl_daytime_to,'','');  								}							   							  break;		*/							}						 						 					}				}								 			}				/*$isSuccess = $objtbl_prom_cond_details->update($prcndtl_id, $prcndtl_condition, $prcndtl_cond_type, $prcndtl_bogo_qty, $prcndtl_bogo_sbmnu, $prcndtl_bogo_sbmnu_dish, $prcndtl_wkdy_sunday, $prcndtl_wkdy_monday, $prcndtl_wkdy_tuesday, $prcndtl_wkdy_wednesday, $prcndtl_wkdy_thursday, $prcndtl_wkdy_friday, $prcndtl_wkdy_saturday, $prcndtl_daytime_from, $prcndtl_daytime_to, $prcndtl_start_date, $prcndtl_end_date);*/			break;					case ACTION_DELETE: 			if(is_not_empty($lst_sel_ids)){					$isSuccess = $objtbl_prom_cond_details->delete(array(PRCNDTL_ID=>$lst_sel_ids));			}else{				$isSuccess = OPERATION_FAIL;			} 			break;		case ACTION_ACTIVATE: 			$isSuccess = $objtbl_prom_cond_details->activate($prcndtl_id);			break;		case ACTION_DEACTIVATE: 			$isSuccess = $objtbl_prom_cond_details->deactivate($prcndtl_id);			break;	}//..switch}//..ifif(is_not_empty($isSuccess)){	if(is_gt_zero_num($isSuccess)){		$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['tbl_prom_cond_details'][$action]['SUCCESS_MSG'].'</div>';	}elseif($isSuccess == OPERATION_FAIL){		$_SESSION[SES_FLASH_MSG] =  '<div class="error">'.$_lang['tbl_prom_cond_details'][$action]['FAILURE_MSG'].'</div>';	}elseif($isSuccess == OPERATION_DUPLICATE){		$_SESSION[SES_FLASH_MSG] =  '<div class="info">'.$_lang['tbl_prom_cond_details'][$action]['DUPLICATE_MSG'].'</div>';	}	biz_script_forward($website.'/user/tbl_prom_conditions.php?prmcon_promotion='.$promotion);}//..if 	$result_found=0;	$tbl_prom_cond_detailslist = $objtbl_prom_cond_details->readArray(array('prmcon_promotion'=>$promotion,OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on),$result_found,1); 	$allpageCount = 0;	$currentPage = 0;	$smarty->assign('pagination',biz_pagination(array("url"=>$navigationURL,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset,"count"=>$result_found),$allpageCount,$currentPage));	$smarty->assign('allpageCount',$allpageCount);	$smarty->assign('currentPage',$currentPage);	$smarty->assign('tbl_prom_cond_detailslist', $tbl_prom_cond_detailslist);	$smarty->assign('result_found',$result_found);	$template = "tbl_prom_cond_details/tbl_prom_cond_details.tpl";		$breadcrumbs[] = array('link'=>$website.'/modules/business_listing/promotionslisting.php?show_type=PR', 'title'=>$_lang['lbl_coupons']);	$prom_detail = pds_list_promotions::GetPromotionDetail($promotion);	//print_r($prom_detail);	if(is_not_empty($prom_detail)){		$breadcrumbs[] = array('link'=>$website.'/modules/business_listing/promotion.php?edit=1&id='.$promotion, 'title'=>$prom_detail['title']);	}		//$breadcrumbs[] = array('link'=>$website.'/user/tbl_prom_discounts.php?prmdisc_promotion='.$promotion, 'title'=>$_lang[TBL_PROM_DISCOUNTS]['title']);		//$breadcrumbs[] = array('link'=>$website.'/user/tbl_prom_conditions.php?prmcon_promotion='.$promotion, 'title'=>$_lang[TBL_PROM_CONDITIONS]['title']);  	if (is_not_empty($mode)){				if(($mode == MODE_VIEW || $mode==MODE_UPDATE) && is_gt_zero_num($prcndtl_condition)){			//$breadcrumbs[] = array('link'=>$website.'/user/tbl_prom_conditions.php?prmcon_promotion='.$promotion.'&prcndtl_condition='.$prcndtl_condition, 'title'=>'Update Condition'); 			$breadcrumbs[] = array('link'=>$website.'/user/tbl_prom_conditions.php?prmcon_promotion='.$promotion.'&prcndtl_condition='.$prcndtl_condition, 'title'=>'Condition'); 			$tbl_prom_cond_detailsinfo = array();			$tbl_prom_cond_detailsinfo['info']= tbl_prom_conditions::GetInfo($prcndtl_condition);			$list_prom_cond_details= tbl_prom_cond_details::readArray(array(PRCNDTL_CONDITION=>$prcndtl_condition));			 			$smarty->assign('prom_condition',$prcndtl_condition);			unset($_SESSION[SES_CONDITIONS]);			 $_SESSION[SES_CONDITIONS]['sequence_num'] = 0;			foreach($list_prom_cond_details as $cond){ 				if($cond[PRCNDTL_COND_TYPE] == 'BOGO' || $cond[PRCNDTL_COND_TYPE] == 'BOGO_ITEM'){					$arr = array();					$arr['submenu'] = $cond[PRCNDTL_BOGO_SBMNU];					$arr['submenu_title'] = $cond['submenu'];					$arr['dish'] = $cond[PRCNDTL_BOGO_SBMNU_DISH];					$arr['dish_title'] = $cond['submenu_dish'];					$arr['qty'] = $cond[PRCNDTL_BOGO_QTY];					$arr['id'] = $cond[PRCNDTL_ID];					$_SESSION[SES_CONDITIONS]['bogo'][$_SESSION[SES_CONDITIONS]['sequence_num']] =  $arr;					$_SESSION[SES_CONDITIONS]['sequence_num'] ++; 				}elseif($cond[PRCNDTL_COND_TYPE] == 'WKDAY'){					$tbl_prom_cond_detailsinfo['wkday'] = $cond;				}elseif($cond[PRCNDTL_COND_TYPE] == 'DAYTIME'){ 					$tbl_prom_cond_detailsinfo['daytime'] = $cond;				}			}			 //print_r($_SESSION[SES_CONDITIONS]);				 			unset($list_prom_cond_details);			 			// print_r($tbl_prom_cond_detailsinfo);			$smarty->assign('tbl_prom_cond_detailsinfo',$tbl_prom_cond_detailsinfo);			if($mode==MODE_UPDATE){				$smarty->assign('isUpdate',1);			}			$template = 'tbl_prom_cond_details/edit.tpl';		}elseif($mode == MODE_CREATE){			$template = 'tbl_prom_cond_details/create.tpl'; 			//$breadcrumbs[] = array('link'=>$website.'/user/tbl_prom_conditions.php?prmcon_promotion='.$promotion.'&prcndtl_condition='.$prcndtl_condition, 'title'=>'Create Condition');			$breadcrumbs[] = array('link'=>$website.'/user/tbl_prom_conditions.php?prmcon_promotion='.$promotion.'&prcndtl_condition='.$prcndtl_condition, 'title'=>'Condition');		}}	$smarty->assign('page_url', $url);	$smarty->assign('navigationURL',$navigationURL);	$smarty->assign('new_sort',$new_sort);	$smarty->assign('active_page',$active_page);	 	$smarty->assign('promotion',$promotion);	//..promotion deatils	//$prom_detail = pds_list_promotions::GetPromotionDetail($promotion);		$smarty->assign('prom_detail',$prom_detail);		$lst_sub_mnu = tbl_sub_menu::readArray(array('isActive'=>1,MENU_RESTAURENT=>$_SESSION[SES_RESTAURANT])); 	$smarty->assign('lst_sub_mnu',$lst_sub_mnu);}else{	if(is_gt_zero_num($promotion)==FALSE){		$_SESSION[SES_FLASH_MSG] =  '<div class="error">Please select the promotion to view conditions</div>';		$template='tbl_prom_cond_details/no-promotion.tpl';	}else{		$template='index.tpl';	}	}include_once('footer.php');?>