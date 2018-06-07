<?PHP
/*
Copyright (c) 2005-2008, Wagon Trader (an Oregon USA business)
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, 
are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, 
this list of conditions and the following disclaimer. 

Redistributions in binary form must reproduce the above copyright notice, 
this list of conditions and the following disclaimer in the documentation 
and/or other materials provided with the distribution.

All pages generated from the use of phpDirectorySource must contain the statement
"Powered by: phpDirectorySource" with an active link to http://www.phpdirectorysource.com,
unless a waiver is granted by the copyright holder.

Neither the name of Wagon Trader nor the names of its contributors may be used to endorse 
or promote products derived from this software without specific prior written permission. 

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS 
OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY 
AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER 
IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT 
OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");
include ("classes/email_message.php");
$mail = new email_message_class;
$html_mail = new Smarty;
$text_mail = new Smarty;

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
// Process Payment Returns
//***********************************************

if ($_SERVER['HTTP_REFERER'] != $_SERVER['PHP_SELF'])
  {
		$prev_page = $_SERVER['HTTP_REFERER'];
  }
$c_year = date ("Y");
$c_month = date ("n");
$c_day = date ("j");
$current_stamp = mktime(0,0,0,$c_month,$c_day,$c_year);

if (isset($_POST['txn_id'])){
	//Paypal is sending information
	include("ipn_paypal.php");
	if ($pay_success){
		// Upgrade Account
		$rc = mysql_query("SELECT level, d_expire FROM $pds_list WHERE id='$listing_id';");
		$fc = mysql_fetch_assoc($rc);

		if($fc[d_expire] == ""){
			$new_days = $c_day + ($vs_level[$item_number][expire]*$vs_level[$item_number][exp_days]);
			$pay_exp = date("Y-m-d",mktime(0,0,0,$c_month,$new_days,$c_year));
		}else{
			list($year, $month, $day) = explode("-", $fc[d_expire]);
			$expire_stamp = mktime(0,0,0,$month,$day,$year);
			$days_left = floor(($expire_stamp - $current_stamp) / ( 60 * 60 * 24 ));
			$value_left = round($vs_level[$fc[level]][cpd] * $days_left,2);
			if($vs_level[$item_number][level] == $item_number){
				// Same level as listing
				$pay_cost = $vs_level[$item_number][cost];
				$new_days = ($vs_level[$item_number][exp_days]*$vs_level[$item_number][expire]) + $days_left;
		
			}elseif($vs_level[$item_number][exp_days] == $vs_level[$fc[level]][exp_days]){
				// Same expiration period
				$pay_cost = $vs_level[$item_number][cost] - $value_left;
				if ($pay_cost > 0){
					$new_days = ($vs_level[$level_id][exp_days]*$vs_level[$level_id][expire]);
				}else{
					@$new_days = $days_left + (abs($pay_cost)/$vs_level[$level_id][cpd]);
				}
			
			}else{
				// Different expiration period
				$pay_cost = $vs_level[$item_number][cost] - $value_left;
				if ($pay_cost > 0){
					$new_days = $vs_level[$item_number][exp_days] * $vs_level[$item_number][expire];
				}else{
					@$new_days = $vs_level[$item_number][exp_days] + (abs($pay_cost)/$vs_level[$item_number][cpd]);
				}
			}
			$new_stamp = $current_stamp + ($new_days * (60 * 60 * 24));
			$pay_exp = date("Y-m-d",$new_stamp);
		}
		$r_level = mysql_query("SELECT premium FROM $pds_level WHERE level='$item_number'");
		$f_level = mysql_fetch_assoc($r_level);
		mysql_query("UPDATE $pds_list SET level='$item_number', premium='$f_level[premium]', d_upgrade=now(), d_expire='$pay_exp' WHERE id='$listing_id';");
		$notice = $language->desc('upgrade',$lang_set,'list_upgraded');
		$tpl-> assign('show_final', true);

	}else{
		// Payment Error - notice set in ipn
	}
	$list_id = $listing_id;
	include("configs/vs_current_listing.php");
}

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('upgrade',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('upgrade',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************
if(isset($_POST['btn_change'])){
	//Changing without cost
	mysql_query("UPDATE $pds_list SET level='$_POST[new_level]', d_upgrade=now(), d_expire='$_POST[new_exp]' WHERE id='$l_id';");
	include("configs/vs_current_listing.php");
	$notice = $language->desc('upgrade',$lang_set,'list_changed');
	$tpl-> assign('show_final', true);

}elseif(isset($_POST['btn_billing'])){
	//Member requesting billing
	$listing_level = $vs_current_listing['level'];
	$request_level = $_POST['request_level'];
	$amount = $_POST['amount'];
	
	$text_mail-> assign("subject",$subject);
	$text_mail-> assign('firm',$vs_current_listing['firm']);
	$text_mail-> assign('address',$vs_current_listing['address1']);
	$text_mail-> assign('contact',$vs_current_listing['contact']);
	$text_mail-> assign('phone',$vs_current_listing['phone']);
	$text_mail-> assign('fax',$vs_current_listing['fax']);
	$text_mail-> assign('mobile',$vs_current_listing['mobile']);
	$text_mail-> assign('description',$vs_current_listing['description']);
	$text_mail-> assign('website',$vs_current_listing['website']);
	$text_mail-> assign('listmail',$vs_current_listing['email']);
	$text_mail-> assign('request_level',$vs_level[$request_level]['title']);
	$text_mail-> assign('current_level',$vs_level[$listing_level]['title']);
	$text_mail-> assign('cost',$vs_level[$request_level]['cost']);
	$text_mail-> assign('amount',$amount);
    $text_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);

	$html_mail-> assign("subject",$subject);
	$html_mail-> assign('firm',$vs_current_listing['firm']);
	$html_mail-> assign('address',$vs_current_listing['address']);
	$html_mail-> assign('contact',$vs_current_listing['contact']);
	$html_mail-> assign('phone',$vs_current_listing['phone']);
	$html_mail-> assign('fax',$vs_current_listing['fax']);
	$html_mail-> assign('mobile',$vs_current_listing['mobile']);
	$html_mail-> assign('description',$vs_current_listing['description']);
	$html_mail-> assign('website',$vs_current_listing['website']);
	$html_mail-> assign('listmail',$vs_current_listing['email']);
	$html_mail-> assign('request_level',$vs_level[$request_level]['title']);
	$html_mail-> assign('current_level',$vs_level[$listing_level]['title']);
	$html_mail-> assign('cost',$vs_level[$request_level]['cost']);
	$html_mail-> assign('amount',$amount);
    $html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
    
	$subject = "Upgrade Billing Request";

	$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
	$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
	$mail-> SetMultipleEncodedEmailHeader("To", array($vs_current_user['usermail'] => $vs_current_user['usermail'], $config['admin_email'] => $config['admin_name']));
	$mail-> SetEncodedHeader("Subject",$subject);
	$mail-> cache_body = false;

	if( $text_mail-> template_exists($template="mail/billing_request_text.tpl") ){
		//Set up Text Message for billing request
		$text_message=$text_mail-> fetch("mail/billing_request_text.tpl");
		$mail->CreateQuotedPrintableTextPart($mail->WrapText($text_message),"",$text_part);
		$alternative_parts[0] = $text_part;
	}
	if( $html_mail-> template_exists($template="mail/billing_request_html.tpl") ){
		//Set up HTML Message for billing request
		$html_message=$html_mail-> fetch("mail/billing_request_html.tpl");
		$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
		$count_parts = count($alternative_parts);
		$alternative_parts[$count_parts] = $html_part;
	}

	$mail-> AddAlternativeMultipart($alternative_parts);
	$mail-> Send();
	$notice = $language->desc('upgrade',$lang_set,'bill_sent');
	$tpl-> assign('show_final', true);
}
//***********************************************
// Upgrade membership level
//***********************************************

if ( $vs_current_user[id] == $vs_current_listing[userid] OR $vs_current_admin){
	// This is the user or admin
	
}else{
	//This is not the user
	header("location:user.php");
	exit;
}

if($vs_current_listing[d_expire] != ""){
	list($year, $month, $day) = explode("-", $vs_current_listing[d_expire]);
	$expire_stamp = mktime(0,0,0,$month,$day,$year);
	$days_left = floor(($expire_stamp - $current_stamp) / ( 60 * 60 * 24 ));
	$value_left = round($vs_level[$vs_current_listing[level]][cpd] * $days_left,2);
}else{
	$no_exp = true;
	$days_left = $language->desc('upgrade',$lang_set,'never_expire');
	$value_left = 0;
}

for($x=0;$x<count($vs_level_ct);$x++){
	$level_id = $vs_level_ct[$x];
	if ($no_exp){
		$vs_level[$level_id][new_cost] = $vs_level[$level_id][cost];
		$new_days = $c_day + ($vs_level[$level_id][expire]*$vs_level[$level_id][exp_days]);
		$vs_level[$level_id][new_exp] = date("Y-m-d",mktime(0,0,0,$c_month,$new_days,$c_year));
	}else{
		if($vs_level[$level_id][level] == $vs_current_listing[level]){
			// Same level as listing
			$vs_level[$level_id][action] = 'same_level';
			$new_cost = $vs_level[$level_id][cost];
			$new_days = ($vs_level[$level_id][exp_days]*$vs_level[$level_id][expire]) + $days_left;
		
		}elseif($vs_level[$level_id][exp_days] == $vs_level[$vs_current_listing[level]][exp_days]){
			// Same expiration period
			$vs_level[$level_id][action] = 'same_exp';
			$new_cost = $vs_level[$level_id][cost] - $value_left;
			if ($new_cost > 0){
				$new_days = ($vs_level[$level_id][exp_days]*$vs_level[$level_id][expire]);
			}else{
				@$new_days = $days_left + (abs($new_cost)/$vs_level[$level_id][cpd]);
				$new_cost = 0;
			}
			
		}else{
			// Different expiration period
			$vs_level[$level_id][action] = 'dif_exp';
			$new_cost = $vs_level[$level_id][cost] - $value_left;
			if ($new_cost > 0){
				$new_days = $vs_level[$level_id][exp_days] * $vs_level[$level_id][expire];
			}else{
				@$new_days = $vs_level[$level_id][exp_days] + (abs($new_cost)/$vs_level[$level_id][cpd]);
				$new_cost = 0;
			}
		}
		$vs_level[$level_id][new_cost] = number_format($new_cost,2);
		//$vs_level[$level_id][new_exp] = date("Y-m-d",mktime(0,0,0,$c_month,$new_days,$c_year));
		$new_stamp = $current_stamp + ($new_days * (60 * 60 * 24));
		$vs_level[$level_id][new_exp] = date("Y-m-d",$new_stamp);
	}
}

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('days_left',$days_left);
$tpl-> assign('value_left',$value_left);
$tpl-> assign('vs_level',$vs_level);
$tpl-> assign('notice',$notice);
$tpl-> assign('prev_page',$prev_page);
$tpl-> assign('show_page','upgrade');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/upgrade.tpl");

?>
