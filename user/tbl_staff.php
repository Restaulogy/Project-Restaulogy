<?phpinclude_once(dirname(dirname(__FILE__)).'/init.php');include_once('header.php');//print_r($_REQUEST); if($sesslife==true){ $staff_id						= get_input('staff_id');$staff_member_id		= get_input('staff_member_id');$staff_address			= get_sql_input('staff_address');$is_customer_upd			= get_sql_input('is_customer_upd',0);$staff_name			= get_sql_input('staff_name','');if(is_not_empty($staff_name)){		$_exp_names=explode(' ',$staff_name);		$_no_of_items=count($_exp_names);		$staff_fname = $_exp_names[0];		if($_no_of_items>1){			unset($_exp_names[0]);			$staff_lname = implode('',$_exp_names);		}else{							$staff_lname = '--';		}}//$staff_lname				= get_sql_input('staff_lname');//$staff_fname				= get_sql_input('staff_fname');$staff_zip					= get_sql_input('staff_zip');$staff_phone				= get_sql_input('staff_phone');$staff_device_id		= get_input('staff_device_id');$staff_gcm_reg_id		= get_input('staff_gcm_reg_id');$staff_description	= get_sql_input('staff_description');$staff_desigation		= get_sql_input('staff_desigation');$staff_start_date		= get_input('staff_start_date');$staff_end_date			= get_input('staff_end_date');$staff_restaurent		= get_input('staff_restaurent',$_SESSION[SES_RESTAURANT]);$staff_role				= get_input('staff_role');$staff_city				= get_input('staff_city'); $staff_state			= get_input('staff_state'); $staff_metro			= get_input('staff_metro'); $staff_country			= get_input('staff_country');$staff_fax				= get_input('staff_fax');$staff_website			= get_sql_input('staff_website');  $staff_email			= get_sql_input('staff_email'); $staff_password			= get_sql_input('staff_password',''); $staff_birth_date		= get_sql_input('staff_birth_date','');$staff_aniversary_dt = get_sql_input('staff_aniversary_dt','');	$staff_loyalty_level	= get_input('staff_loyalty_level',0);$action = strtoupper(get_input(ACTION_TITLE));$mode = strtoupper(get_input(MODE_TITLE));$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);$url = $website.'/user/tbl_staff.php';//..get list of selected items$sel_tbl_staff= get_input('sel_tbl_staff');$lst_sel_ids='';if(is_not_empty($sel_tbl_staff)){		$lst_sel_ids=implode(',', array_keys($sel_tbl_staff));}$isSuccess = '';$objtbl_staff= new tbl_staff();$obj = new members();$staff_key  =   getGuid();$staff_join = date("d M Y");$staff_varified = 1;if(is_not_empty($action)){	switch($action){		case ACTION_CREATE: 			$staff_password = generate_encrypted_password($staff_password);			$isSuccess = $obj->create($staff_email,$staff_password,$staff_lname, $staff_fname,$staff_key, $staff_varified,$staff_join,$staff_role,$staff_zip,$staff_phone,$staff_address,$staff_desigation,$staff_device_id, $staff_gcm_reg_id, $staff_description,$staff_city,$staff_metro,$staff_state,$staff_country,$staff_fax, $staff_website,$_SESSION[SES_RESTAURANT],0,0,0,0,NULL,NULL,NULL,NULL);			//$isSuccess =  $obj->create($staff_email,$staff_password,$staff_lname, $staff_fname,$staff_key, $staff_varified,$staff_join,$staff_role,$staff_zip,$staff_phone,$staff_address,$staff_desigation,$staff_device_id, $staff_gcm_reg_id, $staff_description,'','','','',$staff_fax,'',$_SESSION[SES_RESTAURANT]);								//$isSuccess = $objtbl_staff->create($staff_member_id, $staff_address, $staff_lname, $staff_fname, $staff_zip, $staff_phone, $staff_device_id, $staff_gcm_reg_id, $staff_description, $staff_desigation, $staff_start_date, $staff_end_date, $staff_restaurent);			break;		case ACTION_UPDATE: 			/*$isSuccess = $objtbl_staff->update($staff_member_id, $staff_address, $staff_lname, $staff_fname, $staff_zip, $staff_phone, $staff_device_id, $staff_gcm_reg_id, $staff_description, $staff_desigation,$staff_start_date, $staff_end_date, $staff_restaurent);*/			$isSuccess = $objtbl_staff->update($staff_member_id, $staff_address, $staff_lname, $staff_fname, $staff_city, $staff_state, $staff_metro, $staff_country, $staff_zip, $staff_phone, $staff_fax, $staff_website, $staff_device_id, $staff_gcm_reg_id, $staff_description, $staff_desigation, $staff_restaurent,0,0,0,$staff_birth_date,$staff_aniversary_dt,$staff_loyalty_level);						//..update staff role			if(is_gt_zero_num($staff_role)){				members::update_member_role($staff_member_id,$staff_role);			}			//....update password			if(is_not_empty($staff_password)){				$staff_password = generate_encrypted_password($staff_password);				members::update_usr_password($staff_member_id,$staff_password);			}			//....update email			if(is_not_empty($staff_email)){				members::update_usr_email($staff_member_id,$staff_email);			}			break;					case 'BANN_USER': 			if(is_not_empty($staff_member_id)){				$isSuccess = $objtbl_staff->ban_user($staff_member_id);			}else{				$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['select_ids']['empty'].'</div>';			}						break;					case 'UNBANN_USER': 			if(is_not_empty($staff_member_id)){				$isSuccess = $objtbl_staff->unban_user($staff_member_id);			}else{				$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['select_ids']['empty'].'</div>';			}						break;							case ACTION_DELETE: 			if(is_not_empty($lst_sel_ids)){				$isSuccess = $objtbl_staff->delete(array(STAFF_ID=>$lst_sel_ids));			}else{				$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['select_ids']['empty'].'</div>';			}						break;							case 'SUBSCRIBE':			if(is_not_empty($staff_member_id)){				$isSuccess =tbl_crm::user_subanunsubscribe($staff_member_id,1,$_SESSION[SES_RESTAURANT]);			}else{				$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['select_ids']['empty'].'</div>';			}			$mode=MODE_UPDATE;			break;					case 'UNSUBSCRIBE':			if(is_not_empty($staff_member_id)){				$isSuccess =tbl_crm::user_subanunsubscribe($staff_member_id,0,$_SESSION[SES_RESTAURANT]);			}else{				$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['select_ids']['empty'].'</div>';			}			$mode=MODE_UPDATE;			break;						case ACTION_ACTIVATE: 			if(is_not_empty($lst_sel_ids)){				$isSuccess = $objtbl_staff->activate($lst_sel_ids);			}else{								$isSuccess = $objtbl_staff->activate($staff_id);			}									break;					case ACTION_DEACTIVATE:						//..On deactivate check if he is assigned any SHIFT				if(is_not_empty($lst_sel_ids)){				$lst_mem=explode(",",$lst_sel_ids);				foreach($lst_mem as $_member){					 $stf_rec=tbl_staff::GetInfo(0, $_member);					 $emp_lst=tbl_emp_shift_assignment::readArray(array(EMP_SFT_EMPLOYEE=>$stf_rec['member_id'],'isActiveSchedule'=>1));					 if(count($emp_lst)>0){						//@alertToManager(0,$Global_member['email'],$staff_id,EMP_DEACTIVE_SHIFT);						$_SESSION[SES_FLASH_MSG] =  '<div class="info">'.$_lang['tbl_alerts']['manager']['EMP_DEACTIVE_SHIFT'].'</div>';					 }else{					 		 $isSuccess = $objtbl_staff->deactivate($_member);					 }				}			}else{				$stf_rec=tbl_staff::GetInfo(0, $staff_id);				$emp_lst=tbl_emp_shift_assignment::readArray(array(EMP_SFT_EMPLOYEE=>$stf_rec['member_id'],'isActiveSchedule'=>1));				if(count($emp_lst)>0){					//@alertToManager(0,$Global_member['email'],$staff_id,EMP_DEACTIVE_SHIFT);						$_SESSION[SES_FLASH_MSG] =  '<div class="info">'.$_lang['tbl_alerts']['manager']['EMP_DEACTIVE_SHIFT'].'</div>';				}else{					$isSuccess = $objtbl_staff->deactivate($staff_id);								}				}				  					break;	}//..switch}//..ifif(is_not_empty($isSuccess)){	if(is_gt_zero_num($isSuccess)){		$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang["tbl_staff"][$action]["SUCCESS_MSG"].'</div>';		if(($action==ACTION_UPDATE) && is_gt_zero_num($is_customer_upd)){			//..Redirect to page showing the reward member lookup with			biz_script_forward("{$website}/user/rewrad_point_list.php?rpt_to_show=");		}	}elseif($isSuccess == OPERATION_FAIL){		$_SESSION[SES_FLASH_MSG] =  '<div class="error">'.$_lang["tbl_staff"][$action]["FAILURE_MSG"].'</div>';	}elseif($isSuccess == OPERATION_DUPLICATE){		$_SESSION[SES_FLASH_MSG] =  '<div class="info">'.$_lang["tbl_staff"][$action]["DUPLICATE_MSG"].'</div>';	}}//..if	$result_found=0;	$tbl_stafflist = $objtbl_staff->readArray(array('only_employee'=>1,OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,STAFF_RESTAURENT=>$_SESSION[SES_RESTAURANT]),$result_found,1); 	$smarty->assign('pagination',biz_pagination(array('url'=>$url,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset,'count'=>$result_found))); 	$smarty->assign('tbl_stafflist', $tbl_stafflist);	$smarty->assign('result_found',$result_found);	$template = 'tbl_staff/tbl_staff.tpl';	$breadcrumbs[] = array('link'=>$website.'/user/pref_mng_cntrols.php', 'title'=>$_lang['main']['navbar']['controls']);	$breadcrumbs[] = array('link'=>$url, 'title'=>$_lang['tbl_staff']['listing_title']);	if (is_not_empty($mode)){		if(($mode == MODE_VIEW || $mode==MODE_UPDATE) && is_gt_zero_num($staff_id)){			$tbl_staffinfo= $objtbl_staff->GetInfo(0,$staff_id);			 			if($tbl_staffinfo){				$breadcrumbs[] = array('link'=>$url.'?'.MODE_TITLE.'='.$mode.'&staff_id='.$tbl_staffinfo['staff_id'], 'title'=>$tbl_staffinfo['staff_full_name'].getModeSubTitle($mode));			}			$smarty->assign('tbl_staffinfo',$tbl_staffinfo);			if($mode==MODE_UPDATE){				$smarty->assign('isUpdate',1);			}			if($tbl_staffinfo['staff_role']==ROLE_CUSTOMER){				$template = 'tbl_staff/cust_view.tpl';				unset($breadcrumbs);				$breadcrumbs[] = array(						'link'=>$website.'/user/customer_rewards.php', 						'title'=>$_lang['biz_rewards']['title']);					 			$breadcrumbs[] = array(					 	'link'=>$website.'/user/rewrad_point_list.php',						'title'=>$_lang['biz_rewards']['rwd_points_lst']);								}else{				$template = 'tbl_staff/view.tpl';			}			} 		//..blocked functionality		elseif($mode == MODE_CREATE){			$template = 'tbl_staff/create.tpl';		} }		$act_roles=member_role::readArray(array('isActive'=>1,'no_developer'=>1)); 	//..get the lst of the groups	$_lylty_levels_lst=tbl_loyalty_level::GetFields(array('isActive'=>1,'key_field'=>LOYLEV_ID,'value_field'=>LOYLEV_LEVEL,LOYLEV_RESTAURANT=>$_SESSION[SES_RESTAURANT]));		$smarty->assign('_lylty_levels_lst',$_lylty_levels_lst);	$smarty->assign('act_roles',$act_roles);	$smarty->assign('page_url', $url); }else{	$template='index.tpl';}  include_once('footer.php'); ?>