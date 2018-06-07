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

include ("classes/email_message.php");
$mail = new email_message_class;
$html_mail = new Smarty;
$text_mail = new Smarty;

//Check listings
$r_exp = mysql_query("SELECT *, TO_DAYS(d_expire) as expires, TO_DAYS(NOW()) as now FROM $pds_list WHERE state='apr';");
for ($xc=0;$xc<mysql_num_rows($r_exp);$xc++){
	$f_exp = mysql_fetch_assoc($r_exp);
	$now = $f_exp[now];
	$expire = $f_exp[expires];
	if( $expire == $now AND $f_exp['level'] != $config['free_level'] ){
		//Downgrade Listing to Free Level
		mysql_query("UPDATE $pds_list SET level='$config[free_level]', d_expire=NULL WHERE id='$f_exp[id]';");
		if($notify['user_downgrade']){
			$list_id = $f_exp[id];
			include("configs/vs_current_listing.php");
			//Send Notification Message
			$mail-> ResetMessage();
			unset($alternative_parts);
			$subject = "Listing Downgraded";
			$html_mail-> assign('subject', $subject);
			$html_mail-> assign('vs_current_listing', $vs_current_listing);
			$html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
			$text_mail-> assign('subject', $subject);
			$text_mail-> assign('vs_current_listing', $vs_current_listing);
			$text_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("To",$vs_current_listing['usermail'],$vs_current_listing['usermail']);
			$mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;
	
			if( $text_mail-> template_exists($template="mail/list_downgraded_text.tpl") ){
				//Set up Text Message to notify admin of new listing
				$text_message=$text_mail-> fetch("mail/list_downgraded_text.tpl");
				$mail->CreateQuotedPrintableTextPart($mail->WrapText($text_message),"",$text_part);
				$alternative_parts[0] = $text_part;
			}
			if( $html_mail-> template_exists($template="mail/list_downgraded_html.tpl") ){
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/list_downgraded_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();
			unset($list_id);
		}
	}
}
mysql_free_result($r_exp);

mysql_query("UPDATE $pds_cronjob SET last_run=NOW();");
?>
