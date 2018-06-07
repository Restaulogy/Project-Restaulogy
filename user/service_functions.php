<?php
//Here's a function that will filter a multi-demensional array. This filter will return only those items that match the $value given 
/*function _srv_filter_by_value($array, $index, $value){ 
    if(is_array($array) && count($array)>0)  
    { 
        foreach(array_keys($array) as $key){ 
            $temp[$key] = $array[$key][$index]; 
             
            if ($temp[$key] > $value){ 
                $newarray[$key] = $array[$key]; 
            } 
        } 
      } 
  return $newarray; 
} */

//..START..SAN ..07/02/2018
function _update_rest_base($phone,$flg="A"){
	//..update base rest record with 'DA/RA' flag by appending 'A' to [prev flg]
	$sql="SELECT `staff_signup_flg` FROM `tbl_staff` WHERE `staff_phone`='{$phone}' AND `staff_restaurent`=16";	 
	$_prev_flg=DB::ExecScalarQry($sql);
	if(is_not_empty($_prev_flg)){
		//..find the first character 'D' or 'R' from 'DN' or 'RN'
		if(strlen(trim($_prev_flg))==2){
			$_new_flg =substr($_prev_flg,0,1).$flg;
		}elseif(strlen(trim($_prev_flg))==1){
			$_new_flg =$_prev_flg.$flg;
		}else{
			$_new_flg ='R'.$flg;
		}		   
		$sql="UPDATE `tbl_staff` SET `staff_signup_flg`='{$_new_flg}' WHERE `staff_phone`='{$phone}' AND `staff_restaurent`=16";	 
		$reslt=DB::ExecNonQry($sql);
	}	
	/*$sql="SELECT `staff_signup_flg` FROM `tbl_staff` WHERE `staff_phone`='{$phone}' AND `staff_signup_flg`='D'";	 
	$reslt=DB::ExecScalarQry($sql);
	if(is_not_empty($reslt)){
		$sql="UPDATE `tbl_staff` SET `staff_signup_flg`='DR' WHERE `staff_phone`='{$phone}' AND `staff_restaurent`=16";	 
		$reslt=DB::ExecNonQry($sql);
	}*/
}
//..END..SAN ..07/02/2018

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
    
function serv_get_usr_id_reward_dash($auth_id){
	//$auth_id=get_input('auth_id',0);    	
	if(is_gt_zero_num($auth_id)){
		$rewrad_user=get_user($auth_id);		
		//..1] get restaurant det
		$rest_info = tbl_restaurent::GetInfo($rewrad_user[STAFF_RESTAURENT]);
		$_final_reslt['restaurant_info']=$rest_info;
		$_final_reslt['claim_btn_lnk']= WWWROOT."user/short_cd_signup.php?rst=".$rewrad_user[STAFF_RESTAURENT]."&srt_cd_ph=". base64_encode($auth_id);
		//..2] user details
		$_final_reslt[SES_REWARD]=$rewrad_user;		
		//if(is_gt_zero_num($_SESSION[IS_RWD_AUTH])){
		//.. Now chk_all_rewards applicable for this user
		$rewards_avail=members::chk_all_rewards($rewrad_user['id']);
		if(is_not_empty($rewards_avail)){			
			$_final_reslt['rewards_avail']=$rewards_avail;	
			//..find out the next reward point
			$_can_claim=0;
			foreach($rewards_avail as $_ech){
				if(is_gt_zero_num($_ech['can_claim']))	{
				//if($_ech['can_claim']>0){
					$_can_claim=1;
					break;
				}
			}
			if(is_gt_zero_num($_can_claim))
				$_next_rwd_point = '';
			else
				$_next_rwd_point =_add_award_pt_sms($auth_id,$rewrad_user[STAFF_RESTAURENT],0);	
			
			$_final_reslt['next_reward_pt']=$_next_rwd_point;			
		}	
		$overall_stat=biz_rewards::getRewardUserStats($rewrad_user['id'],$rewrad_user[STAFF_RESTAURENT]);
		//..3] user Points
		$_final_reslt['overall_stat']=$overall_stat;	
		
		//..START Get all the redeem history of the customer
		$result_found=0;
		$sql=  'SELECT `p`.`title`,`c`.`rwd_points`,`c`.`redimed_date`
						FROM `pds_redim_cupons` as `c`
						INNER JOIN `'.BIZ_REWARDS.'` as `r` ON  
						`r`.`'.RWD_ID.'`=`c`.`rwd_deals_sel`
						INNER JOIN `pds_list_promotions` as `p` ON 
						`p`.`id` = `c`.`promotion_id`	
					  WHERE `c`.`rwd_usr_id`='.$rewrad_user['id'].' AND `r`.`'.RWD_BUSS_ID.'`='.$rewrad_user[STAFF_RESTAURENT];
		$redeem_hist=DB::ExecQry($sql);
		//..4] Redeem history
		$_final_reslt['redeem_hist']=$redeem_hist;
		$_final_reslt['result_found']=count($redeem_hist);
		
		//..Get award history of teh customer..
		$biz_checkinslist = biz_checkins::readArray(array(CHKIN_BUSS_ID=>$rewrad_user[STAFF_RESTAURENT],CHKIN_USER_ID=>$rewrad_user['id']),$result_found,1);
		//..5] Award history		
		$_final_reslt['biz_checkinslist']=$biz_checkinslist;	
		
		//..6] Email history
		$_act_crm_id=tbl_crm::get_crm_id_from_email($rewrad_user['email']);	 
		$_email_coupons =DB::ExecQry("SELECT `e`.*,`p`.* FROM `".CRM_PROM_EMAILS."` `e` 
	INNER JOIN `".pds_list_promotions."` `p` ON `e`.`".CRM_PR_ML_PROMOTION."`=`p`.`id` WHERE  `e`.`".CRM_PR_ML_USERID."`={$_act_crm_id} AND `p`.`end_date` >='".date(DATE_FORMAT)."' AND `e`.`flg_send`=0  AND (`e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` is NULL OR `e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` = 0 OR `e`.`".CRM_PROM_EMAILS_DEACTIVE_DATE."` > CURDATE( )) AND `p`.`prm_restaurent`=".$rewrad_user[STAFF_RESTAURENT]);	
		$_final_reslt['_email_coupons']=$_email_coupons;	
		$_final_reslt['success']=1;
		//}
	}else{
		$_final_reslt['message']='Please provide user id before proceed.';
	}
	return $_final_reslt;
}

function serv_get_new_prom_rest(){	
	$_resp=array();	
	$sql="SELECT GROUP_CONCAT(DISTINCT `prm_restaurent`) FROM `pds_list_promotions` WHERE `is_event`=0 AND `cupon_type`<>'reward' AND DATE(`pds_list_promotions`.`start_date`) > (NOW() - INTERVAL 4 MONTH) AND `pds_list_promotions`.`end_date`>= NOW() AND `cupon_type`<>'invitation' AND `cupon_type`<>'exclusive' ORDER BY `pds_list_promotions`.`id` DESC;";
	$reslt=DB::ExecScalarQry($sql);
	if(is_not_empty($reslt)){
		$_resp=explode(',',$reslt);
	}
	return $_resp;
}

function serv_get_all_prom($restaurant_id,$listing_type,$keyword='',$user_id=0){
		$ret_val=array();
		$show_type = 'PR';
		
		$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
		$limit 	=  get_input(LIMIT_TITLE,LIMIT_VALUE);
		$sort_on = get_input(SORT_ON,'pds_list_promotions.id'); 
		$sort_by = get_input(SORT_BY,'DESC');
		$_in_cur_time = date(DATE_FORMAT);
		if(is_not_empty($keyword)){
			$search_sql = " (pds_list_promotions.title LIKE '%$keyword%' OR pds_list_promotions.comments LIKE '%$keyword%' OR pds_list.firm LIKE '%$keyword%' OR pds_list.description LIKE '%$keyword%' )";
			$promtionsql = " AND `pds_list_promotions`.`prm_restaurent`={$restaurant_id} AND `pds_list_promotions`.`end_date`>=CURDATE() AND {$search_sql}";
		}else{
			//$promtionsql = " AND `pds_list_promotions`.`prm_restaurent`=".$restaurant_id." AND `pds_list_promotions`.`end_date`>='{$_in_cur_time}'";
			$promtionsql = " AND `pds_list_promotions`.`prm_restaurent`=".$restaurant_id." AND `pds_list_promotions`.`end_date`>='{$_in_cur_time}'";
		}   		
    	$title_tag = "Promotions";

    	$record_fetch_condition = " DISTINCT pds_list.id,state,level, pds_list_promotions.id as tmp_promo_id";
    	$sql_cmn = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND ";
    	
 		switch ($listing_type){   			
	    	case "all": 	   		
				  /*if($isCustomer){	
					$survey_cond=" AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";
				  }else{
					$survey_cond="";
				  }*/
				  $survey_cond=" AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";	  
				  $sql = "{$sql_cmn} `is_event`=0 AND `cupon_type`<>'reward' AND pds_list_promotions.start_date<='{$_in_cur_time}' {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm;";
		         $promotion_sql_filter = " {$promtionsql}";	        
			 break;	
			 
			 case "new_list":		
				  $survey_cond=" AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";	  
				  $sql = "{$sql_cmn} `is_event`=0 AND cupon_type='all_site' AND
				  DATE(`pds_list_promotions`.`start_date`) > (NOW() - INTERVAL 4 MONTH) {$promtionsql} {$survey_cond}  ORDER BY $sort_on $sort_by, firm;";
				  /*$sql = "{$sql_cmn} `is_event`=0 AND cupon_type='all_site' {$promtionsql} {$survey_cond}  ORDER BY $sort_on $sort_by, firm;";*/
		         $promotion_sql_filter = " {$promtionsql}";        
			 break;		
			
		     case "forthcoming": 	   			
				 if($isCustomer){	
				$survey_cond=" AND cupon_type<>'survey' AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";
				 }else{
					 $survey_cond="";
				 }		  
				 $sql = "{$sql_cmn} `is_event`=0 AND cupon_type<>'reward' AND pds_list_promotions.start_date>'{$_in_cur_time}' {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm;"; 		
		         $promotion_sql_filter = " {$promtionsql}";
				 break;
			
		     case "is_event": 
				if($isCustomer){	
				$survey_cond=" AND cupon_type<>'survey' AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";
				}else{
					$survey_cond="";
				}		  
				$sql = "{$sql_cmn} `is_event`=1 AND cupon_type<>'reward' AND pds_list_promotions.start_date<='{$_in_cur_time}' {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm;"; 			
		        $promotion_sql_filter = " {$promtionsql}";
			break;
			
			case "favorite":		    
                $sql =  "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list_promotions  left outer join pds_list  on pds_list_promotions.list_id = pds_list.id inner join pds_list_favorites  on pds_list_promotions.id = pds_list_favorites.list_id WHERE pds_list_favorites.ispromotion = 1 and pds_list_promotions.start_date<='{$_in_cur_time}' and pds_list_favorites.user_id={$user_id} ORDER BY {$sort_on} {$sort_by} ;";
                $promotion_sql_filter = " and pds_list_favorites.user_id=".$user_id;
                //$sql = "{$sql_cmn} `is_event`=1 AND cupon_type<>'reward' AND pds_list_promotions.start_date<='{$_in_cur_time}' {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm;"; 			
		        
                break;	
	  	 }	  	 
    	//echo $sql;
    	//exit;
    	 if (is_not_empty($sql)){
			$r_list = mysql_query ($sql) or die(mysql_error());
			$r1 = mysql_query('SELECT FOUND_ROWS() as total;');

			$f1 = mysql_fetch_assoc($r1);
			$result_found = $f1['total'];
			$map_ids=array();

			$ishistory = 0;
			if($listing_type == 'expired'){
				$ishistory = -1;	
			} 
		}
		$ret_val['r_list']		=$r_list;
		$ret_val['ishistory']	=$ishistory;
		$ret_val['map_ids']		=$map_ids;
		$ret_val['promotion_sql_filter']		= $promotion_sql_filter;
				
		return $ret_val;
	
}  

function serv_get_full_menu($menu_id,$restaurant_id,$_filt_ses=array()){
		
	$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
	$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);
	$sort_on = get_input(SORT_ON,'menu_display_order');
	$sort_by ='ASC';
	
	$objtbl_menu= new tbl_menu();
	//..Logic To show menu preview..get full menu details			
	$tbl_menu_full=array();
	
	$fetch_arr = array('isActive'=>1,OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on,MENU_RESTAURENT=>$restaurant_id);
	if(is_gt_zero_num($menu_id)){
		$fetch_arr[MENU_ID]=$menu_id;
	}
	$info = $objtbl_menu->readArray($fetch_arr,$result_found,1,1,1);				
	//..get first default mneu
	$first_mnu_index = 0;	 
	if(is_not_empty($info)){
		$first_mnu_index = array_keys($info);	
		if(is_gt_zero_num($first_mnu_index[0])){
			$first_mnu_index = $first_mnu_index[0];
		} 
	}
	if((is_gt_zero_num($menu_id)==FALSE)){
		if(is_not_empty($_filt_ses)){			
			$fetch_arr[MENU_ID]=$_filt_ses['menu'];
		}else{
			$menu_id=$first_mnu_index;
			$fetch_arr[MENU_ID]=$menu_id;
		}		
		$info = $objtbl_menu->readArray($fetch_arr,$result_found,1,1,1);
	}
								
	foreach($info as $mnu_value){
		//..Add sub menus to menus					
		if(is_not_empty($_filt_ses['sub_menu'])){
			$sub_mnus=tbl_sub_menu::readArray(array(SUBMNU_ID =>$_filt_ses['sub_menu'] ,SUBMNU_MENU=>$mnu_value[MENU_ID],'isActive'=>1));
		}else{
			$sub_mnus=tbl_sub_menu::readArray(array(SUBMNU_MENU=>$mnu_value[MENU_ID],'isActive'=>1));
		}		
		//..Each submenus add dishes
		$y  = 0;
		
		if(is_not_empty($sub_mnus)){
			foreach($sub_mnus as $sbmnu_value){
				//..Add dishes to sub menus				
				$sub_mnu_dishes[$y]=$sbmnu_value;
				$submenu_dish_count = 0;
				
				if(is_not_empty($_filt_ses['sub_menu_dish'])){
					$sub_mnu_dishes[$y]['dishes']=tbl_submenu_dishes::readArray(array(SBMNU_DISH_ID=>$_filt_ses['sub_menu_dish'],SBMNU_DISH_SUBMENU=>$sbmnu_value[SUBMNU_ID],'isActive'=>1),$submenu_dish_count,1,1);
				}else{
					$sub_mnu_dishes[$y]['dishes']=tbl_submenu_dishes::readArray(array(SBMNU_DISH_SUBMENU=>$sbmnu_value[SUBMNU_ID],'isActive'=>1),$submenu_dish_count,1,1);
				}		

				$sub_mnu_dishes[$y]['dishes_count'] = $submenu_dish_count;
				$y++;
			}	
		}
		$tbl_menu_full=$mnu_value;
		$tbl_menu_full['submenu']=$sub_mnu_dishes;	
		$x=$x+1;	
	}
	return $tbl_menu_full;
}

//................................
function serv_LogMeIn($username,$password,$table_id=1,$isCustomerLogin=0,$frm_chng_srv=0,$is_restaurant=1){
 global $_lang;
 
 $respose=array('success'=>0,'message'=>'','user'=>'');
 
//echo "$username,$password,$table_id,$isCustomerLogin";
 //if((is_gt_zero_num($is_restaurant)) && (is_gt_zero_num($frm_chng_srv))){
if(is_gt_zero_num($is_restaurant)){
 //echo "$username,$password,$table_id -1";
 if(is_not_empty($username) && is_not_empty($password)){			
		$password = generate_encrypted_password($password);
		$phone=_get_us_phone($username);		
		if(is_not_empty($phone)==FALSE){
			$phone=$username;
			$phone1=$username;
		}else{
			$phone1=_get_us_phone($username,1);
		}
		$a = mysql_query("SELECT `members`.`id`,`members`.`email`,`members`.`password`,`login_attempt`,`staff_restaurent`, `staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE (`email`='{$username}' OR `staff_phone`='{$phone}' OR `staff_phone`='{$phone1}') AND `staff_restaurent`='{$is_restaurant}';") or die(mysql_error());
		/*$a = mysql_query("SELECT `members`.`id`,`login_attempt`,`staff_restaurent`, `staff_end_date` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE `email`='{$username}' AND `staff_restaurent`='{$is_restaurant}';") or die(mysql_error());*/
				
		$ac = mysql_num_rows($a);
		if($ac){
			$f = mysql_fetch_array($a); 
			if($isCustomerLogin || $frm_chng_srv){
				//$res4 = mysql_query("SELECT `password` FROM `members` WHERE (`email`='{$username}')");
				$res4 = mysql_query("SELECT `password` FROM `members` WHERE (`id`='".$f['id']."')");
				if($res4 && mysql_num_rows($res4)){
					$password = mysql_result($res4,0);
				}
			}
			/*$q = 'SELECT `members`.* FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$is_restaurant.' AND `email`="'.$username.'" and `password`="'.$password.'";';*/
			$q = 'SELECT `members`.* FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$is_restaurant.' AND (`email`="'.$username.'"  OR `staff_phone`="'.$phone.'" OR `staff_phone`="'.$phone1.'") AND `password`="'.$password.'";';
			
			if(!($result_set = mysql_query($q))) die(mysql_error());
			$n2 = mysql_num_rows($result_set);

			if($n2){
				$f = mysql_fetch_array($result_set);
				$verified = $f['verified'];
				$banned = $f['banned'];
				$user_id = $f['id'];
				//print_r($f);
				if($verified == 0){
					$respose['success']=2;
					$respose['message']=$_lang['email_not_verified'];
				}else{
					if($banned == 1){						
						$respose['success']=3;
						$respose['message']=$_lang['account_banned'];
					}else{						
						$date = date("d M Y");
						$updateMembers = mysql_query("UPDATE `members` SET `access`='{$date}', `login_attempt` = 0 WHERE `email`='{$username}'");
						/*
						if(is_gt_zero_num($_SESSION['log_id'])==false){
							$obj = new hm_log();
							$log_id = $obj->create($username, date("Y-m-d h:i:s"),$table_id); 
							unset($obj);
							//$_SESSION['log_id'] = $log_id;	
						}							 
						
						$_SESSION['user'] = $username;
						$_SESSION['pass'] = $password;
						$_SESSION['guid'] = $user_id; 
						$_SESSION['authrest'] = $is_restaurant;
						*/							
														
						$respose['success']=1;
						$respose['message']='Logged in successfully';
						$respose['user']=get_user($user_id);						
					} 
				}
			}				 
		}else{
			//$_SESSION['error'] =  '<div class="errorbox">'.$_lang['email_not_found'].'</div>';
			$respose['success']=4;
			$respose['message']=$_lang['email_not_found'];
		}			 
	} 
	//return false; 
 }else{
 		//$_SESSION[SES_FLASH_MSG]  ='<div class="info">Restaurant is not selected..</div>';
 		$respose['success'] = 5;
		$respose['message'] = 'Restaurant not provided';
 }
 return $respose; 
}

//..Modified Reg the user to all resturants..And update flag
//..START..SAN ..07/02/2018
function _all_rest_register($phone,$password,$fname,$lname,$is_restaurant){
	$usrDetails=array();
	$bs_usr=_get_bs_rest_usr($phone);
	if(is_not_empty($bs_usr)){
		$fname=$bs_usr[STAFF_FNAME];
		$lname=$bs_usr[STAFF_LNAME];
	}
	//..update signup flag 'A'
	_update_rest_base($phone,'A');
		
	//..get all active restaurants
	$objtbl_restaurent= new tbl_restaurent();
	$tbl_restaurentlist = $objtbl_restaurent->readArray(array('isActiveIncRestlgy'=>1),$result_found,1);		
	foreach($tbl_restaurentlist as $_ech_restrnt){
		//..loop through all resaturant
		if(is_not_empty($_ech_restrnt)){	
			$_SESSION[SES_RESTAURANT]=$_ech_restrnt[RESTAURENT_ID];				$email	= "exusr_"._get_lst_member_id()."@tst.com";
			$_resp_reg=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$_ech_restrnt[RESTAURENT_ID],0,NULL,'','R');
		}
	}
	unset($objtbl_restaurent);	
	$usrDetails=$_resp_reg['user'];
	$my_prom_link_new_st= biz_get_tiny_url(urlencode(ALL_REST_APP_PATH .'index.html#MyRewardPage'));
	$_msg="Welcome to Restaulogy family, your passport to great rewards! Click {$my_prom_link_new_st} to see the rewards you have just won.";
	$_succ=@send_sms_using_twilio(array($phone),$_msg);
	
	return $usrDetails;	
}
//..sign to specific restaurant
function _sign_to_spec_rest($phone,$password,$fname,$lname,$is_restaurant,$_from_shortcd=0){
	$usrDetails=array();
	//..first check if user is registered with our system  			
	$_lg_rs = serv_LogMeIn($phone,$password,1,0,0,$is_restaurant);	
	if($_lg_rs['success']==4){
		
		//..Register to base restaurant as well with 'RN' flag ....	
		$_base_usr=array();
		$_lg_rs_1 = serv_LogMeIn($phone,$password,1,0,0,16);
		if($_lg_rs_1['success']==4){
			$email	= "exusr_"._get_lst_member_id()."@tst.com";
			$_reg_rs_2= serv_registerME($email,'sample',0,$fname,$lname,$phone,1,0,0,1,16,0,NULL,'','RN');
			$_base_usr=$_reg_rs_2['user'];
		}else{
			$_base_usr=$_lg_rs_1['user'];
		}
		if(is_not_empty($_base_usr)){
			$fname=$_base_usr[STAFF_FNAME];
			$lname=$_base_usr[STAFF_LNAME];
		}
		
		//..Sign to particular restaurant
		$_SESSION[SES_RESTAURANT]=$is_restaurant;
		$email	= "exusr_"._get_lst_member_id()."@tst.com";	
		$_resp_reg= serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$is_restaurant,0,NULL,'','R');		
		
		$usrDetails= $_resp_reg['user'];
	
		//..Send sms flag
		$my_prom_link_new_st= biz_get_tiny_url(ALL_REST_APP_PATH .'index.html#MyRewardPage');
		/*$_msg="Welcome to Restaulogy family, your passport to great rewards! Click {$my_prom_link_new_st} to see the rewards you have just won.";*/
		$restaurant_info = tbl_restaurent::GetInfo($is_restaurant);
		$_free_offer=_getRestFreeRwd($is_restaurant);
		$_msg="Welcome to '".$restaurant_info[RESTAURENT_NAME]."'. rewards program! Click {$my_prom_link_new_st} to {$_free_offer}";
		//echo $_msg;
		if($_from_shortcd==0 && $is_restaurant>1)
			$_succ=@send_sms_using_twilio(array($phone),$_msg);
	}else{
		$usrDetails=$_lg_rs['user'];
	}
	return $usrDetails;	
}

//..sign the user to particular resaturants
/*function _sign_to_all_rest($phone,$password,$fname,$lname,$is_restaurant){
	$usrDetails=array();
	//..first check if user is registered with our system  			
	$_lg_rs = serv_LogMeIn($phone,$password,1,0,0,$is_restaurant);
	if($_lg_rs['success']==4){
		//..get all active restaurants
		$objtbl_restaurent= new tbl_restaurent();
		$tbl_restaurentlist = $objtbl_restaurent->readArray(array('isActiveIncRestlgy'=>1),$result_found,1);
		
		foreach($tbl_restaurentlist as $_ech_restrnt){
			//..loop through all resaturant
			if(is_not_empty($_ech_restrnt)){	
				$_SESSION[SES_RESTAURANT]=$_ech_restrnt[RESTAURENT_ID];						$email	= "exusr_"._get_lst_member_id()."@tst.com";	
				
				$_resp_reg=serv_registerME($email,$password,0,$fname,$lname,$phone,1,0,0,1,$_ech_restrnt[RESTAURENT_ID],0,NULL,'','R');
				if(($_ech_restrnt[RESTAURENT_ID]==$is_restaurant) && (is_not_empty($_resp_reg))){
					$_reg_rs=$_resp_reg;
				}
			}
		}
		unset($objtbl_restaurent);
		//..update signup flag
		_update_rest_base($phone);
		
		$usrDetails=$_reg_rs['user'];
		$_SESSION[SES_RESTAURANT]=$is_restaurant;
		$my_prom_link_new_st= biz_get_tiny_url(urlencode(ALL_REST_APP_PATH .'index.html#MyRewardPage'));
		$_msg="Welcome to Restaulogy family, your passport to great rewards! Click {$my_prom_link_new_st} to see the rewards you have just won";
		//echo $_msg;
		//$_succ=@send_sms_using_twilio(array($phone),$_msg);
	}else{
		$usrDetails=$_lg_rs['user'];
	}
	return $usrDetails;	
}*/
//..END..SAN ..07/02/2018
function serv_registerME($email='',$password='',$table_id=0,$fname="",$lname="",$phone="",$is_reward=1,$reward_bal_visits=0,$reward_bal_points=0,$sms_subscribed=1,$_restaurant=1,$staff_facebook=NULL,$cust_dob=NULL,$cust_aniversary_dt=NULL,$staff_signup_flg='R'){
	 global $_lang;
	 
	$respose=array('success'=>0,'message'=>'','user'=>'');
	
	$isAlreadyLoggedIn = 0;
	//echo "<br>[{$email}]one-";
	
	if(is_not_empty($phone)){
		$phone= _get_us_phone($phone,1);
		$phone1= _get_us_phone($phone);		
	}		
	//echo "<br>[{$email}]Second-";
	//$phone= str_replace(array('+', '-'), '', filter_var($phone, FILTER_SANITIZE_NUMBER_INT));
	
	/*if($_restaurant==0)
		$_restaurant=$_SESSION[SES_RESTAURANT];*/
		
	//echo "<br>[{$email}]third-";	
		
//if($sesslife == false) { 
	if(is_not_empty($email) && is_not_empty($password)){			
		if(isValidEmail($email)){	
			//$q = mysql_query("SELECT `id` FROM `members` WHERE (`email` = '{$email}')") or die(mysql_error());			
			//$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND `email`="'.$email.'";') or die(mysql_error());	
			//echo'SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`email`="'.$email.'" OR `staff_phone`="'.$phone.'");';
			//exit;
			//..If it is import without email then only check phone 
			//if(substr($email, 0, 6)=='exusr_'){
			//echo "<br>[{$email}]forth-";

			//if(_chk_if_usr_witout_email($_email)==1){
			if(substr($email, 0, 6)=='exusr_'){
				//..only phone checking
				//..Phone checking
				$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`staff_phone`="'.$phone.'" OR `staff_phone`="'.$phone1.'");') or die(mysql_error());				
			    $n = $n_ph =$n_em= mysql_num_rows($q);
			}else{			
				//..Email checking
				$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND `email`="'.$email.'";') or die(mysql_error());
				$n_em = mysql_num_rows($q);
				
				//..Phone checking
				$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`staff_phone`="'.$phone.'" OR `staff_phone`="'.$phone1.'");') or die(mysql_error());
				$n_ph = mysql_num_rows($q);
				
				$q = mysql_query('SELECT `id` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$_restaurant.' AND (`email`="'.$email.'" OR `staff_phone`="'.$phone.'" OR `staff_phone`="'.$phone1.'");') or die(mysql_error());	
				$n = mysql_num_rows($q);	
			}					
			$member_id = @mysql_result($q,0);

			//..Check unique phone validation
			$is_found=0;
			if(is_not_empty($phone)){				
				//$staff_record=tbl_staff::readArray(array('isActive'=>1,STAFF_PHONE=>$phone),$is_found,1);	
				//echo 'SELECT '.STAFF_MEMBER_ID.' FROM '.TBL_STAFF.' WHERE ('.TBL_STAFF_DEACTIVE_DATE.' is NULL OR '.TBL_STAFF_DEACTIVE_DATE.' = 0 OR '.TBL_STAFF_DEACTIVE_DATE.' > CURDATE( )) AND '.STAFF_PHONE.'='.$phone;	
				$staff_record=DB::ExecScalarQry('SELECT '.STAFF_MEMBER_ID.' FROM '.TBL_STAFF.' WHERE ('.TBL_STAFF_DEACTIVE_DATE.' is NULL OR '.TBL_STAFF_DEACTIVE_DATE.' = 0 OR '.TBL_STAFF_DEACTIVE_DATE.' > CURDATE( )) AND '.STAFF_PHONE.'="'.$phone.'" AND `staff_restaurent` = '.$_restaurant.'');
			}			
			 
			if(is_gt_zero_num($member_id)==FALSE && is_gt_zero_num($staff_record)){
					$member_id=$staff_record;
			}
			$hashed_password = generate_encrypted_password($password);				 
			//if(!$n && !$is_found){	
			if(!$n_em && !$is_found){
				//..new registration
				$key = getGuid();				
				$join = date("d M Y");
				
				$obj = new members();
				//$rest=(($_SESSION[SES_RESTAURANT]>0) ? $_SESSION[SES_RESTAURANT] : 1); 
				//echo "create($email,$hashed_password,$lname,$fname,$key,1,$join,ROLE_CUSTOMER,'',$phone,'','','','','','','','','','','',$rest,$is_reward,$reward_bal_visits,$reward_bal_points)<br>";
			    $w = $obj->create($email,$hashed_password,$lname,$fname,$key,1,$join,ROLE_CUSTOMER,'',$phone,'','','','','','','','','','','',$_restaurant,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed,$staff_facebook,$cust_dob,$cust_aniversary_dt,0,$staff_signup_flg);				 
					
				if($w){
					$respose['success']=1;
					$respose['message']='Registration successful';
					$respose['user']=get_user($w);	
					//..code to send sms on new joining
					//$_new_user_id=get_user_by_email($username);
					//_short_cd_sign_up($phone,$respose['user']);		
					return $respose;
				}else{
					//$err = "<div class=\"infobox\">{$_lang['unable_to_register']}<br/><small>{$_lang['try_again_later']}</small></div>";
					//$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang['unable_to_register'].'</div>';
					$respose['message']=$_lang['unable_to_register'];
				}
			}else{
				//..Already registered	
				$respose['success']=2;							
				if($n_ph>0){
					//$_SESSION[SES_FLASH_MSG]  ='<div class="info">This phone is already registered, please login or use another phone to sign up.</div>';
					$respose['message']='This phone is already registered, please login or use another phone to sign up.';					
				}else{					
					//$_SESSION[SES_FLASH_MSG]  ='<div class="info">This email is already registered, please login or use another email address to sign up.</div>';
					$respose['message']='This email is already registered, please login or use another email address to sign up.';
				}
				return $respose;
				//$_SESSION[SES_FLASH_MSG]  ='<div class="info">Email/Phone is already registered with us.</div>';
				/*if(is_gt_zero_num($is_reward)==false){
						return 1;
				}*/	
			}
		}else{		 
			//$err = "<div class=\"errorbox\">{$_lang['invalid_email']}</div>";
			//$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang['invalid_email'].'</div>';
			$respose['success']=3;
			$respose['message']=$_lang['invalid_email'];
		}	
				
	}else{
		//$err = "<div class=\"errorbox\">{$_lang['empty_fields']}</div>";
		//$_SESSION[SES_FLASH_MSG]  ='<div class="error">'.$_lang['empty_fields'].'</div>';
		$respose['success']=4;
		$respose['message']='Email/phone not provided';
	}

	return $respose;
	
}
?>