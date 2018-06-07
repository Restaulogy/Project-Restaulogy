<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');

$_schd_dt= get_input("_schd_dt",date('Y-m-01'));

//..Loop through all active restaurants
$sql =  'SELECT `'.RESTAURENT_ID.'`,`'.RESTAURENT_NAME.'`
				 FROM `'.TBL_RESTAURENT.'`
				 WHERE `'.RESTAURENT_ID.'` IN (1,4,5,6);';												
$rest_list=DB::ExecQry($sql);

if(is_not_empty($rest_list)){
	foreach($rest_list as $_each_rest){
		  $message=get_intimation_email_content($_each_rest[RESTAURENT_ID]);
			$to=fetch_admin_manager_emails($_each_rest[RESTAURENT_ID]);
			//$to.=",inforesha.sangram@gmail.com";
			$subject="Intimation about the cron job schedule";
			$from="donotreply@restaulogy.com";
			$restaurant_title="THE RESTAURANT";
			if(is_not_empty($to) && is_not_empty($message)){
					//echo "$subject,<br>$from,<br>$to,<br>$message,<br>$restaurant_title";
					@send_mail_using_php($subject,$from,$to,$message,$restaurant_title);	
			}			
	}
}

function fetch_admin_manager_emails($_restaurant){
	$sql =  "SELECT GROUP_CONCAT(`".MEMBERS."`.`email`) 
					 FROM `".TBL_STAFF."` 
					 INNER JOIN `".MEMBERS."` ON `".STAFF_MEMBER_ID."`=`".MEMBERS."`.`id`
					 WHERE `".STAFF_RESTAURENT ."`={$_restaurant} AND `".MEMBER_ROLE_ID."` IN (2,3);";										
	$email_to_lst=DB::ExecScalarQry($sql);	
	return $email_to_lst;
}

function get_intimation_email_content($_restaurant){	
		global $_schd_dt;
		$email_content='';	
		$_filt_data='';
		$objtbl_cust_filter_email= new tbl_cust_filter_email();
		$tbl_cust_filter_emaillist = $objtbl_cust_filter_email->readArray(array('isActive'=>1,CFE_RESTAURANT=>$_restaurant),$result_found,1);
		if(is_not_empty($tbl_cust_filter_emaillist)){
				$_filt_data .= '<br>					
				<table border="1" style="border:1px solid gray;border-collapse:collapse;">			
				<tr>
					<th bgcolor="orange">Filter</th>					
					<th bgcolor="orange">Promotion</th>
				</tr>
				';
				foreach($tbl_cust_filter_emaillist as $_each_filt){
						$_filt_data .="<tr><td>". $_each_filt['cfe_filter_textual']. "</td><td> ".$_each_filt['prom_title'].'</td></tr>';
				}	
				$_filt_data .= '</table>';
		}
		if(is_not_empty($_filt_data)){
			$email_content="
				Dear sir,<br><br>
					Your following filters are scheduled on {$_schd_dt} ,<br>					
					{$_filt_data}<br>
					If you want to modify you can. <br><br>
				Thanks,<br>
				Restaurant Support.
			";
		}	
		unset($objtbl_cust_filter_email);
		return $email_content;
}	
?>