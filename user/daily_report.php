<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');

//..get current/todays date
$curr_dt = get_input('curr_dt',date('Y-m-d'));
//$curr_dt=date('Y-m-d');

//..Fetch only three restaurants
$sql =  'SELECT `'.RESTAURENT_ID.'`,`'.RESTAURENT_NAME.'`
				 FROM `'.TBL_RESTAURENT.'`
				 WHERE `'.RESTAURENT_ID.'` IN (1,4,5,6);';												
$rest_list=DB::ExecQry($sql);

if(is_not_empty($rest_list)){
	$report_data='<h2 style="color:orange;background:gray;"> '.$curr_dt.'</h2>';
	foreach($rest_list as $_each_rec){
		//$report_data .=tbl_qrcode_log::get_daily_report($_each_rec[RESTAURENT_ID],$_each_rec[RESTAURENT_NAME],$curr_dt,$curr_dt);
		$report_data .=tbl_qrcode_log::get_daily_report($_each_rec[RESTAURENT_ID],$_each_rec[RESTAURENT_NAME],'2014-07-01','2014-08-28');
		$report_data .= '<hr>';
	}
	unset($rest_list);
	
	//echo $report_data;
	//..Send mail to msharu
	if(is_not_empty($report_data)){		
		$subject='Daily report of the restaurant';
		$from='donotreply@restaulogy.com';
		$to='msharu@gmail.com,reshmaglobiz@gmail.com';
		//$to='inforesha.sangram@gmail.com';
		$restaurant_title='The Restaurant';
		send_mail_using_php($subject,$from,$to,$report_data,$restaurant_title);
	}

}	
?>