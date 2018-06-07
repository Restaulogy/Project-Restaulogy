<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');

include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_list_promotions.class.php');

//..Date range
//$search_from_dt= get_input("search_from_dt",date('Y-m-01'));
//$search_to_dt= get_input("search_to_dt",date('Y-m-t'));

//..Get last month data only for fetching records.
$search_from_dt= date('Y-m-d', strtotime('first day of last month'));
$search_to_dt= date('Y-m-d', strtotime('last day of last month'));

//..Fetch all the filters
$result_found=0;
$objtbl_cust_filter_email=new tbl_cust_filter_email();
/*$tbl_cust_filter_emaillist = $objtbl_cust_filter_email->readArray(array('isInExpiryRange'=>1,'search_from_dt'=>$search_from_dt,'search_to_dt'=>$search_to_dt,'isActive'=>1),$result_found,1);*/
$tbl_cust_filter_emaillist = $objtbl_cust_filter_email->readArray(array('isActive'=>1),$result_found,1);
/*print_r($tbl_cust_filter_emaillist);
exit;*/
if(is_not_empty($tbl_cust_filter_emaillist)){
	
	foreach($tbl_cust_filter_emaillist as $_each_rec){
			//..Update the promotion with new start and end date
			$_prom_det=DB::ExecQry('SELECT `start_date`,`end_date` FROM '.PDS_LIST_PROMOTIONS.' WHERE id='.$_each_rec[CFE_PROMOTION],1);
	
			/*DB::ExecNonQry('UPDATE `'.PDS_LIST_PROMOTIONS.'` SET `start_date`="'.Date('Y-m-01 00:00:00').'",`end_date`="'.date(date('Y-m').'-d 00:00:00',strtotime($_prom_det['end_date'])).'" WHERE `id`='.$_each_rec[CFE_PROMOTION]);*/
			
		/*	echo 'UPDATE `'.PDS_LIST_PROMOTIONS.'` SET `start_date`="'.Date('Y-m-01 00:00:00').'",`end_date`="'.date(date('Y-m').'-d 00:00:00',strtotime($_prom_det['end_date'])).'" WHERE `id`='.$_each_rec[CFE_PROMOTION];			*/
			/*
			DB::ExecNonQry('UPDATE `'.PDS_LIST_PROMOTIONS.'` SET `start_date`="'.Date('Y-m-01 00:00:00',strtotime($search_from_dt)).'",`end_date`="'.date(date('Y-m',strtotime($search_from_dt)).'-d 00:00:00',strtotime($_prom_det['end_date'])).'" WHERE `id`='.$_each_rec[CFE_PROMOTION]);
			*/
				
			//================================================
			//== 1] Not visited in last X no. of days ========	
			//================================================
			if($_each_rec[CFE_FILTER]=='not_visited')	{
					if(is_gt_zero_num($_each_rec[CFE_VALUE]) && (strtotime($_prom_det['end_date']>=time()))){
							$qry = "
						SELECT `".TBL_STAFF."`.`staff_phone`,`".TBL_STAFF."`.`staff_is_reward`,
						`".MEMBERS."`.`id`,`".MEMBERS."`.`email`,`".TBL_STAFF."`.`staff_restaurent`,
						IFNULL(
								GREATEST((
										SELECT MAX(`chkin_date`) FROM `".BIZ_CHECKINS."` 
												 WHERE `".CHKIN_USER_ID."`=`".STAFF_MEMBER_ID."` AND `".CHKIN_BUSS_ID."`=".$_each_rec[CFE_RESTAURANT]." ), 
		     						IFNULL((
							        SELECT MAX(`created_date`) FROM `pds_redim_cupons` as `c`
												 LEFT OUTER JOIN `".BIZ_REWARDS."` as `r` ON  
												 `r`.`".RWD_ID."`=`c`.`rwd_deals_sel`						
												 WHERE `c`.`rwd_usr_id`=`".STAFF_MEMBER_ID."` AND `r`.`".RWD_BUSS_ID."`=".$_each_rec[CFE_RESTAURANT]."), 0)) 
						,`staff_start_date`) as `last_visit`				
						FROM `".TBL_STAFF."` 
						INNER JOIN `".MEMBERS."` ON 
						`".TBL_STAFF."`.`".STAFF_MEMBER_ID."`=`".MEMBERS."`.`id` 
						HAVING
						`last_visit` >=".$_each_rec[CFE_VALUE]." AND `staff_is_reward`=1 AND `staff_restaurent`=".$_each_rec[CFE_RESTAURANT];
						//echo "qry=$qry <br><br>";
						//exit;
						$_lst_points = DB::ExecQry($qry);
						if(is_not_empty($_lst_points)){
							foreach($_lst_points as $_point){
						 			//..send email to thsese members
						 			_add_prom_to_usr_fav($_point['id'],$_each_rec[CFE_PROMOTION]);
									/*@send_email_now($_each_rec[CFE_PROMOTION],$_point['email'],$_point['staff_phone'],$_each_rec[CFE_RESTAURANT],$_each_rec[CFE_EMAIL_OR_SMS],$_point['id'],$_each_rec[CFE_REWARD],$_each_rec[CFE_MESASGE]);*/
								}
						}		
						unset($_lst_points);
					}					
			}		
			
			//================================================
			//== 2] Has more than X no. of total points; =====	
			//================================================
			if($_each_rec[CFE_FILTER]=='total_point')	{
					if(is_gt_zero_num($_each_rec[CFE_VALUE]))	{
							 $qry = "SELECT  
							 				`c`.`chkin_buss_id` ,`c`.`chkin_user_id` , 
											SUM(`chkin_points`) as `his_points`,
											`m`.`email`, `s`.`staff_phone`,`c`.`chkin_date`
											FROM `biz_checkins` `c`
											INNER JOIN `members` `m`  ON
											`c`.`chkin_user_id`=`m`.`id`
											INNER JOIN `tbl_staff` `s`  ON
											`m`.`id`=`s`.`staff_member_id`											
											GROUP BY `chkin_user_id` 
											HAVING `chkin_buss_id`=".$_each_rec[CFE_RESTAURANT]."
											AND `chkin_user_id` >0 AND `his_points` >=".$_each_rec[CFE_VALUE]."
											AND (`c`.`chkin_date` >= '".date('Y-m-d 00:00:00',strtotime($search_from_dt))."' AND `c`.`chkin_date` <= '".date('Y-m-d 23:59:59',strtotime($search_to_dt))."')
											ORDER BY `chkin_user_id` ASC";
							 //echo "qry=$qry <br><br>";
							 //exit;				
							 $_lst_points = DB::ExecQry($qry);
							
							 if($_lst_points){
	 								foreach($_lst_points as $_point){
							 			//..send email to thsese members
										@send_email_now($_each_rec[CFE_PROMOTION],$_point['email'],$_point['staff_phone'],$_each_rec[CFE_RESTAURANT],$_each_rec[CFE_EMAIL_OR_SMS],$_point['chkin_user_id'],$_each_rec[CFE_REWARD],$_each_rec[CFE_MESASGE]);
									}
							 }		
							 unset($_lst_points);					 
					}					
			}	
			
			//================================================
			//== 3] Has visited more than X no. of times in the last X days/months/weeks; 
			//================================================
			if($_each_rec[CFE_FILTER]=='visited')	{
					if(is_gt_zero_num($_each_rec[CFE_VALUE]))	{
							 $qry = "SELECT  
							 				`c`.`chkin_buss_id` ,`c`.`chkin_user_id` , 
											COUNT(`c`.`chkin_user_id`) AS `visits`,
											`m`.`email`, `s`.`staff_phone`,`c`.`chkin_date`
											FROM `biz_checkins` `c`
											INNER JOIN `members` `m`  ON
											`c`.`chkin_user_id`=`m`.`id`
											INNER JOIN `tbl_staff` `s`  ON
											`m`.`id`=`s`.`staff_member_id`											
											GROUP BY `chkin_user_id` 
											HAVING `chkin_buss_id`=".$_each_rec[CFE_RESTAURANT]."
											AND `chkin_user_id` >0 AND `visits` >=".$_each_rec[CFE_VALUE]."
											AND (`c`.`chkin_date` >= '".date('Y-m-d 00:00:00',strtotime($search_from_dt))."' AND `c`.`chkin_date` <= '".date('Y-m-d 23:59:59',strtotime($search_to_dt))."')
											ORDER BY `chkin_user_id` ASC";
							 echo "qry=$qry <br><br>";
							 exit;
							 $_lst_points = DB::ExecQry($qry);
							 if($_lst_points){
	 								foreach($_lst_points as $_point){
							 			//..send email to thsese members
										@send_email_now($_each_rec[CFE_PROMOTION],$_point['email'],$_point['staff_phone'],$_each_rec[CFE_RESTAURANT],$_each_rec[CFE_EMAIL_OR_SMS],$_point['chkin_user_id'],$_each_rec[CFE_REWARD],$_each_rec[CFE_MESASGE]);
									}
							 }		
							 unset($_lst_points);					 
					}					
			}		
																									
			//================================================
			//== 4] Birthdays ================================	
			//================================================
			if($_each_rec[CFE_FILTER]=='birthday')	{
					//if(is_gt_zero_num($_each_rec[CFE_VALUE]))	{
							$qry = "
						SELECT `".TBL_STAFF."`.`staff_phone`,`".TBL_STAFF."`.`staff_is_reward`,
						`".MEMBERS."`.`id`,`".MEMBERS."`.`email`,`".TBL_STAFF."`.`staff_restaurent`,
							 `".TBL_STAFF."`.`staff_birth_date`				
						FROM `".TBL_STAFF."` 
						INNER JOIN `".MEMBERS."` ON 
						`".TBL_STAFF."`.`".STAFF_MEMBER_ID."`=`".MEMBERS."`.`id` 
						HAVING
						DATE_FORMAT(`staff_birth_date`,'%m') = DATE_FORMAT(NOW(),'%m') AND `staff_is_reward`=1 AND `staff_restaurent`=".$_each_rec[CFE_RESTAURANT];
						//..DATE_FORMAT(`staff_birth_date`,'%m-%d') = DATE_FORMAT({$search_from_dt},'%m-%d')
						//echo "qry=$qry <br><br>";
						//exit;
						$_lst_points = DB::ExecQry($qry);
						if($_lst_points){
							foreach($_lst_points as $_point){
						 			//..send email to thsese members
									@send_email_now($_each_rec[CFE_PROMOTION],$_point['email'],$_point['staff_phone'],$_each_rec[CFE_RESTAURANT],$_each_rec[CFE_EMAIL_OR_SMS],$_point['id'],$_each_rec[CFE_REWARD],$_each_rec[CFE_MESASGE]);
								}
						}		
						unset($_lst_points);
					//}					
			}
	}

}	


//..function for sending email with crm notification
function send_email_now($prom_id,$email,$phone,$restaurant,$_is_email_ph,$_user_id,$_reward,$_message){
			
			$crm_pm_id=0;
			$obj_prom=new pds_list_promotions();
			$obj_crm_prom_emails=new crm_prom_emails();
			//$_filt_lnk=array('user'=>$_user_id,'reward'=>$_reward);			
			
			if(is_not_empty($email) && $_is_email_ph=='email'){
					$crm_record=DB::ExecQry('SELECT '.CRM_ID.' FROM '.TBL_CRM.' WHERE '.CRM_CUST_EMAIL.'="'.$email.'" AND `'.CRM_RESTAURANT.'`='.$restaurant,1);
					if(is_not_empty($crm_record)){		 		
						$crm_pm_id=$crm_record[CRM_ID];
						$crm_pm_id=$obj_crm_prom_emails->create($crm_pm_id, $prom_id, 0, '', '');		
				  } 
					$_filt_lnk=array('user'=>$crm_pm_id,'reward'=>1);
					try{
						$tmp_rslt=$obj_prom->email_promtoion($prom_id,1,array($email),$crm_pm_id,'',$_message,$_filt_lnk);
					}catch (Exception $e) {
					   //echo 'Caught exception: ',$e->getMessage(),"\n";
					}	
			}
			
			if(is_not_empty($phone) && $_is_email_ph=='sms'){
					$crm_record=DB::ExecQry('SELECT '.CRM_ID.' FROM '.TBL_CRM.' WHERE '.CRM_CUST_PHONE.'="'.$phone.'" AND `'.CRM_RESTAURANT.'`='.$restaurant,1);
					if(is_not_empty($crm_record)){		 		
						$crm_pm_id=$crm_record[CRM_ID];	
						$crm_pm_id=$obj_crm_prom_emails->create($crm_pm_id, $prom_id, 0, '', '');		
				  } 
					$_filt_lnk=array('user'=>$crm_pm_id,'reward'=>1);
					try{							
						$tmp_rslt=$obj_prom->sms_promtoion($prom_id,array($phone),$crm_pm_id,$_message,$_filt_lnk);
					}catch (Exception $e) {
					   //echo 'Caught exception: ',$e->getMessage(),"\n";
					}	
			}	
			unset($obj_prom);
			unset($obj_crm_prom_emails);
}

/*
QUERIES 
qry= SELECT `tbl_staff`.`staff_phone`,`tbl_staff`.`staff_is_reward`, `members`.`id`,`members`.`email`,`tbl_staff`.`staff_restaurent`, IFNULL( GREATEST(( SELECT MAX(`chkin_date`) FROM `biz_checkins` WHERE `chkin_user_id`=`staff_member_id` AND `chkin_buss_id`=1 ), IFNULL(( SELECT MAX(`created_date`) FROM `pds_redim_cupons` as `c` LEFT OUTER JOIN `biz_rewards` as `r` ON `r`.`rwd_id`=`c`.`rwd_deals_sel`	WHERE `c`.`rwd_usr_id`=`staff_member_id` AND `r`.`rwd_buss_id`=1), 0)) ,`staff_start_date`) as `last_visit`	FROM `tbl_staff` INNER JOIN `members` ON `tbl_staff`.`staff_member_id`=`members`.`id` HAVING `last_visit` >=20 AND `staff_is_reward`=1 AND `staff_restaurent`=1 

qry=SELECT `c`.`chkin_buss_id` ,`c`.`chkin_user_id` , SUM(`chkin_points`) as `his_points`, `m`.`email`, `s`.`staff_phone`,`c`.`chkin_date` FROM `biz_checkins` `c` INNER JOIN `members` `m` ON `c`.`chkin_user_id`=`m`.`id` INNER JOIN `tbl_staff` `s` ON `m`.`id`=`s`.`staff_member_id`	GROUP BY `chkin_user_id` HAVING `chkin_buss_id`=1 AND `chkin_user_id` >0 AND `his_points` >=200 AND (`c`.`chkin_date` >= '2014-08-01 00:00:00' AND `c`.`chkin_date` <= '2014-08-31 23:59:59') ORDER BY `chkin_user_id` ASC 

qry=SELECT `c`.`chkin_buss_id` ,`c`.`chkin_user_id` , COUNT(`c`.`chkin_user_id`) AS `visits`, `m`.`email`, `s`.`staff_phone`,`c`.`chkin_date` FROM `biz_checkins` `c` INNER JOIN `members` `m` ON `c`.`chkin_user_id`=`m`.`id` INNER JOIN `tbl_staff` `s` ON `m`.`id`=`s`.`staff_member_id`	GROUP BY `chkin_user_id` HAVING `chkin_buss_id`=1 AND `chkin_user_id` >0 AND `visits` >=3 AND (`c`.`chkin_date` >= '2014-08-01 00:00:00' AND `c`.`chkin_date` <= '2014-08-31 23:59:59') ORDER BY `chkin_user_id` ASC 

qry= SELECT `tbl_staff`.`staff_phone`,`tbl_staff`.`staff_is_reward`, `members`.`id`,`members`.`email`,`tbl_staff`.`staff_restaurent`, `tbl_staff`.`staff_birth_date`	FROM `tbl_staff` INNER JOIN `members` ON `tbl_staff`.`staff_member_id`=`members`.`id` HAVING DATE_FORMAT(`staff_birth_date`,'%m') = DATE_FORMAT(NOW(),'%m') AND `staff_is_reward`=1 AND `staff_restaurent`=1 
*/
?>