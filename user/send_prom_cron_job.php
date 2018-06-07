<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');

include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_list_promotions.class.php');

/*
$sql=  'SELECT 
						`r`.`prem_id`,`r`.`prem_promotion`,`r`.`prem_act_send_dt`,
						`m`.`email`,`p`.`prm_restaurent`
						FROM `'.tbl_prom_reminder.'` as `r`
						INNER JOIN `members` as `m` ON  
						`r`.`'.PREM_USER.'`=`m`.`id`
						INNER JOIN `pds_list_promotions` as `p` ON  
						`r`.`'.PREM_PROMOTION.'`=`p`.`id`
						;';
*/
$sql =  'SELECT 
						`r`.`prem_id`,`r`.`prem_promotion`,`r`.`prem_act_send_dt`,
						`r`.`prem_user` as `email`,`r`.`prem_phone` 
						,`p`.`prm_restaurent`
						FROM `'.tbl_prom_reminder.'` as `r`
						INNER JOIN `pds_list_promotions` as `p` ON  
						`r`.`'.PREM_PROMOTION.'`=`p`.`id`;';

//echo "sql=$sql";
												
$remind_list=DB::ExecQry($sql);
//echo date('Y-m-d');
//exit;
if(is_not_empty($remind_list)){
	$obj_prom=new pds_list_promotions();
	$obj_crm_prom_emails=new crm_prom_emails();
	
	foreach($remind_list as $_each_rec){
			//..if send date is today
			if(date('Y-m-d',strtotime($_each_rec['prem_act_send_dt']))==date('Y-m-d')){
					$crm_pm_id=0;
					
					if(is_not_empty($_each_rec['email'])){
							$crm_record=DB::ExecQry('SELECT '.CRM_ID.' FROM '.TBL_CRM.' WHERE '.CRM_CUST_EMAIL.'="'.$_each_rec['email'].'" AND `'.CRM_RESTAURANT.'`='.$_each_rec['prm_restaurent'],1);
							if(is_not_empty($crm_record)){		 		
								$crm_pm_id=$crm_record[CRM_ID];				
								$crm_pm_id=$obj_crm_prom_emails->create($crm_pm_id, $_each_rec['prem_promotion'], 0, '', '');								
						  } 
							try{							
								$tmp_rslt=$obj_prom->email_promtoion($_each_rec['prem_promotion'],1,array($_each_rec['email']),$crm_pm_id,'');						
							}catch (Exception $e) {
							   //echo 'Caught exception: ',  $e->getMessage(), "\n";
							}	
					}
					
					if(is_not_empty($_each_rec['prem_phone'])){
							$crm_record=DB::ExecQry('SELECT '.CRM_ID.' FROM '.TBL_CRM.' WHERE '.CRM_CUST_PHONE.'="'.$_each_rec['prem_phone'].'" AND `'.CRM_RESTAURANT.'`='.$_each_rec['prm_restaurent'],1);
							if(is_not_empty($crm_record)){		 		
								$crm_pm_id=$crm_record[CRM_ID];
								$crm_pm_id=$obj_crm_prom_emails->create($crm_pm_id, $_each_rec['prem_promotion'], 0, '', '');
						  } 
							try{							
								$tmp_rslt=$obj_prom->sms_promtoion($_each_rec['prem_promotion'],array($_each_rec['prem_phone']),$crm_pm_id,'');						
							}catch (Exception $e) {
							   //echo 'Caught exception: ',  $e->getMessage(), "\n";
							}	
					}
					
					//if($tmp_rslt){
						//..Update the record
						DB::ExecNonQry('UPDATE '.tbl_prom_reminder.' SET '.PREM_IS_SEND.'=1 WHERE '.PREM_ID.'='.$_each_rec['prem_id']);
					//}
			}
	}
	unset($obj_prom);
	unset($obj_crm_prom_emails);
}	
?>