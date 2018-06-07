<?php
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
include ("classes/inputfilter.php");
$filter = new inputFilter($allow_tags,$allow_attr);
include_once ("classes/email_message.php");
$mail = new email_message_class;
$html_mail = new Smarty;
$text_mail = new Smarty;

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************

$service_msg = "";

$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('contact',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('contact',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";



//Filter posted data
$_POST = $filter->process($_POST);
$lid = 0;
if ((isset($_REQUEST['lid'])) && ($_REQUEST['lid'] > 0) )
{
	$lid = $_REQUEST['lid'];
}
else
{
    $lid = $vs_current_listing[id];
}

if ((isset($_REQUEST['promoid'])) && ((strlen(trim($_REQUEST['promoid'])))>0)){
	$promoid = $_REQUEST['promoid'];

 	$tpl-> assign('promoid',$promoid);
    $tpl-> assign('showing_promotion', get_promotion_info($promoid));

}else{

}

$refer_link = $CONFIG->wwwroot."pg/business_listing/main/".$lid."/".$_SESSION['guid'];

$bus_user_id=0;
//	echo $refer_link;
if($lid != 0)
{
    $sql = "SELECT l.id AS lid, firm, email, usermail, userid
            FROM  pds_user  u
            INNER JOIN pds_list l ON u.id = l.userid
            where l.id =$lid";
    $result = mysql_query($sql);
    $vs_my_list = mysql_fetch_assoc($result);
    mysql_free_result($result);
    $bus_user_id=$vs_my_list["userid"];
    $biz_title = $vs_my_list["firm"];
    

    if (($_GET[act] == "admin") OR ($_POST[act] == "admin")){
		//message being sent to admin
		$tpl-> assign('show_page','contact_admin');
		if(isset($_POST['subject'])&& ((strlen(trim($_POST['subject']))) !=0)){
	    $mail_subject = $_POST['subject'];
    }else{
    	$mail_subject = "Contact Message";
    }
	
	
	$mail_to = $config['admin_email'];
	$template_text = "contact_admin_text.tpl";
	$template_html = "contact_admin_html.tpl";
	$action = "admin";
}elseif ($_GET[act] == "refer" OR $_POST[act] == "refer"){


	//referal message being sent
	$tpl-> assign('show_page','contact_refer');
	if($vs_my_list['email']){
		//Listing has an email addy
		$mail_to = $vs_my_list['email'];
	}elseif($vs_my_list['usermail'] != ""){
		//User has an email addy
		$mail_to = $vs_my_list['usermail'];
	}else{
		//Nowhere to send message

	}

    $inv_usr=get_user_by_email($_REQUEST['refer_to']);
		if(is_array($inv_usr))
			$inv_usr = array_shift($inv_usr);

		if($inv_usr){
			$type = 'business_listing';
	        $subtype = 'recommendation_of_listing';
	        $poster_id = $_SESSION['guid'];
	        $receiver_id = $inv_usr['guid'];
	        $view_link = $ref_url;
	        $message = "has recommended Business listing <a href='$refer_link'>$biz_title</a> to you";
	       	biz_send_popup_notification($type, $subtype, $poster_id, $receiver_id, $view_link, $message);
		}

 
 if(isset($_REQUEST['subject'])&& ((strlen(trim($_REQUEST['subject']))) !=0)){
    $mail_subject = $_POST['subject'];
 }else{
     $mail_subject = "Recommendation for Listing";
 }
	$mail_to = $_REQUEST['refer_to'];
	$template_text = "contact_refer_text.tpl";
	$template_html = "contact_refer_html.tpl";
	$refer_by =   $_REQUEST['from_title'];
	$action = "refer";

//	$refer_link = "$config[mainurl]/show.php?lid=$lid";
 

	$text_mail-> assign('refer_link',$refer_link);
	$text_mail-> assign('refer_firm',$vs_my_list['firm']);
	$text_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
	$html_mail-> assign('refer_link',$refer_link);
	$html_mail-> assign('refer_firm',$vs_my_list['firm']);
	$html_mail-> assign('refer_by',$refer_by);
	$html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);

	$bread_crumb[0] = 'Refer To Freind';

}else{
	$sql = "select email,userid from pds_list where id=$lid";
	$res = mysql_query($sql);
	$curr_listing = mysql_fetch_assoc($res);
	mysql_free_result($res);
	$bus_user_id=$curr_listing["userid"];
	
	$html_mail-> assign("biz_name", get_user($curr_listing['userid'])->name);
	$html_mail-> assign("sender_name", get_user($vs_current_user)->name);
	
	$owner_mail = get_user($curr_listing['userid'])->email;
	if($curr_listing ['email']){
		//Listing has an email addy
		$mail_to = $curr_listing['email'];
	}elseif( $owner_mail != ""){
		//User has an email addy
		$mail_to = $owner_mail;
	}else{
  		//Nowhere to send message
	}
	$tpl-> assign('show_page','contact_firm');
	$mail_subject = "Message from a visitor";
	$template_text = "contact_firm_text.tpl";
	$template_html = "contact_firm_html.tpl";
	$action = "firm";
	}
	
	
	if(isset($_REQUEST['btn_send'])){

	$subject = mysql_real_escape_string($_REQUEST['subject']);
	$message = mysql_real_escape_string($_REQUEST['message']);
	$from = mysql_real_escape_string($_REQUEST['from']);
	$refer_to = mysql_real_escape_string($_REQUEST['refer_to']);

	if($_POST['from_title'] != ""){
		$from_title = mysql_real_escape_string($_REQUEST['from_title']);
		if($action == 'firm'){
			//Add message to tables
			$sql1 = "INSERT INTO $pds_mailbox (member_id,listing_id,surfer_id,surfer_from,email,subject,body,date_sent)
				VALUES('".$vs_my_list['userid']."','".$vs_my_list['lid']."','$_SESSION[userid]','$from_title','$from','$subject','$message',NOW());";
            mysql_query($sql1) or die(mysql_error());
			$inid = mysql_insert_id();
			$sql2 = "INSERT INTO $pds_amailbox (member_id,listing_id,surfer_id,surfer_from,email,subject,body,date_sent,mid) VALUES('".$vs_my_list['userid']."','".$vs_my_list['lid']."','$_SESSION[userid]','$from_title','$from','$subject','$message',NOW(),'$inid');";

             mysql_query($sql2) or die(mysql_error());
            $_REQUEST['from'] = $config['admin_email'];
			$_REQUEST['from_title'] = $config['admin_email'];
		}
	}else{
		$from_title = $from;
	}
    $subject = stripslashes($subject);
	$message = stripslashes($message);
	$from = stripslashes($from);
	$refer_to = stripslashes($refer_to);
	$from_title = stripslashes($from_title);


	//Error Checking
	if ($subject == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_subject')."<br>";
		$service_msg .= $language->desc('error_text',$lang_set,'error_no_subject')."<br>";
	}
	if ($message == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_message')."<br>";
		$service_msg .= $language->desc('error_text',$lang_set,'error_no_message')."<br>";
	}
	if ($from == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_from')."<br>";
		$service_msg .= $language->desc('error_text',$lang_set,'error_no_from')."<br>";
	}
	if (!checkEmail($from)){
		$notice .= $language->desc('error_text',$lang_set,'error_bad_from')."<br>";
		$service_msg .= $language->desc('error_text',$lang_set,'error_bad_from')."<br>";
	}
	if ($action == "refer"){
		if($refer_to == ""){
			$notice .= $language->desc('error_text',$lang_set,'error_no_refer')."<br>";
			$service_msg .= $language->desc('error_text',$lang_set,'error_no_refer')."<br>";
		}elseif(!checkEmail($refer_to)){
			$notice .= $language->desc('error_text',$lang_set,'error_bad_refer')."<br>";
			$service_msg .= $language->desc('error_text',$lang_set,'error_bad_refer')."<br>";
		}
	}

	if($notice == ""){
		//No errors - Send Message
		$from_title = $_REQUEST['from_title'];
		$text_mail-> assign("subject",$subject);
		$text_mail-> assign('message',$message);

		$html_mail-> assign("subject",htmlentities($subject));
		$html_mail-> assign("message",htmlentities($message));

		$mail-> SetEncodedEmailHeader("From",$_REQUEST['from'],$_REQUEST['from_title']);
		$mail-> SetEncodedEmailHeader("Reply-To",$_REQUEST['from'],$_REQUEST['from_title']);
		$mail-> SetEncodedEmailHeader("To",$mail_to,$mail_to);
		$mail-> SetEncodedHeader("Subject",$mail_subject);
		$mail-> cache_body = false;

		if( $text_mail-> template_exists($template="mail/$template_text") ){
			//Set up Text Message to notify admin of new listing
			$text_message=$text_mail-> fetch("mail/$template_text");
			$mail->CreateQuotedPrintableTextPart($mail->WrapText($text_message),"",$text_part);
			$alternative_parts[0] = $text_part;
		}
		if( $html_mail-> template_exists($template="mail/$template_html") ){
			//Set up HTML Message to notify admin of new listing
			$html_message=$html_mail-> fetch("mail/$template_html");
			$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
			$count_parts = count($alternative_parts);
			$alternative_parts[$count_parts] = $html_part;
		}

		$mail-> AddAlternativeMultipart($alternative_parts);
		//..Changes made by InforeshaODC TM 03-03-2011
		//Also why is it showing the Mailbox for the business there; if there is a message for the business it should go to the standard email account;
		///Just send the elgg mails instead of this
		if (($action != "refer") && ($bus_user_id>0)){
            $result = messages_send($subject,$message,$bus_user_id,0,0);
        }else{
            $mail-> Send();
        }

		$sent_flag = true;
	}
    if($sent_flag){
      $service_msg .= "<div class='approved'>Succefully mailed.</div>'";
    }else{
      $service_msg .= "<div class='fail'>Deilivery Of Mail Failed.</div>'";
      $notice       = "<div class='fail'>Deilivery Of Mail Failed</div>'";
    }
}
}else{
    $service_msg .= "<div class='fail'>Please, Select the business.</div>'";
	$notice = "<div class='fail'>Please, Select the business.</div>'";
}
if(is_gt_zero_num($_REQUEST['isServicePage'])){
    echo json_encode($service_msg);
}else{

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************


//***********************************************
// Contact Form
//***********************************************

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('notice',$notice);
$tpl-> assign('action',$action);
$tpl-> assign('subject',$subject);
$tpl-> assign('message',$message);

$tpl-> assign('from',(empty($from) ? get_user($_SESSION["guid"])->email : $from));
$tpl-> assign('from_title',(empty($from_title) ? get_user($_SESSION["guid"])->name : $from_title));

$tpl-> assign('refer_to',$refer_to);
$tpl-> assign('mail_to',$mail_to);
$tpl-> assign('sent_flag',$sent_flag);
$tpl-> assign('mybackbutton',$_SERVER['HTTP_REFERER']);
$tpl-> assign('isMobileContact', 1);
//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/contact.tpl");
 }
?>
