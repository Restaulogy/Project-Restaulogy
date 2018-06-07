<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');


// Get the PHP helper library from twilio.com/docs/php/install
//require_once('/path/to/twilio-php/Services/Twilio.php'); // Loads the library
require_once('../modules/twilio/Services/Twilio.php'); 
// Loads the library  PATHROOT
	
// Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
$sid = TWILIO_ACCOUNTSID;//"AC0703d8383f6f5ecf6bcbcccedd8112b4";
$token = TWILIO_AUTHTOKEN ;//"a91d2e4d3929218e40d6e5eef9a0f561";

$client = new Services_Twilio($sid, $token);
 
// Loop over the list of smss and echo a property for each one
$rest_wise_report='<h1>SMS Received List</h1>';
$rest_wise_report .= '<br>					
				<table border="1" style="border:1px solid gray;border-collapse:collapse;">
				<tr>					
					<th bgcolor="orange">Date</th>					
					<th bgcolor="orange">From</th>					
					<th bgcolor="orange">Message</th>
				</tr>
				';
foreach ($client->account->sms_messages as $sms) {
		if($sms->from != '+13853557110'){
				$rest_wise_report .='<tr><td>'. $sms->date_sent. '</td><td>'.$sms->from.'</td><td>'.$sms->body.'</td></tr>';		
		}			
}
$rest_wise_report .= '</table>';

echo $rest_wise_report;	

/*
SELECT  
							 				`c`.`chkin_buss_id` ,`c`.`chkin_user_id` , 
											COUNT(`c`.`chkin_user_id`) AS `visits`,
											`m`.`email`, `s`.`staff_phone`,`c`.`chkin_date`
											FROM `biz_checkins` `c`
											INNER JOIN `members` `m`  ON
											`c`.`chkin_user_id`=`m`.`id`
											INNER JOIN `tbl_staff` `s`  ON
											`m`.`id`=`s`.`staff_member_id`											
											GROUP BY `chkin_user_id` 
											HAVING `chkin_buss_id`=4
											AND `chkin_user_id` >0 AND `visits` >=2
											AND (`c`.`chkin_date` >= '".date('Y-m-d 00:00:00',strtotime($search_from_dt))."' AND `c`.`chkin_date` <= '".date('Y-m-d 23:59:59',strtotime($search_to_dt))."')
											ORDER BY `chkin_user_id` ASC
											
SELECT  `c`.`chkin_buss_id` ,`c`.`chkin_user_id` ,
				 COUNT(`c`.`chkin_user_id` ) AS `visits` ,
				 SUM(`c`.`chkin_points`) AS  `points`,`m`.`email` ,  
				 `s`.`staff_phone`,`c`.`chkin_date` 
FROM  `biz_checkins`  `c` 
INNER JOIN `members` `m` ON  `c`.`chkin_user_id` =  `m`.`id` 
INNER JOIN `tbl_staff` `s` ON  `m`.`id`=`s`.`staff_member_id` 
GROUP BY `chkin_user_id` 
HAVING `chkin_buss_id`=4
AND `chkin_user_id` >0
AND (
`c`.`chkin_date` >= '2014-05-01 00:00:00'
AND  `c`.`chkin_date`<= '2014-09-31 23:59:59'
)
ORDER BY  `chkin_user_id` ASC 
LIMIT 0 , 30
											
											*/
?>