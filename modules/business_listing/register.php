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
include ("classes/inputfilter.php");
$filter = new inputFilter($allow_tags,$allow_attr);
include ("classes/email_message.php");
$mail = new email_message_class;
$html_mail = new Smarty;
$text_mail = new Smarty;

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
//Skip registration if user is logged in
//***********************************************
if ( $vs_current_user[id] != "" ){
	$page=2;
}


//***********************************************
// Process Payment Returns
//***********************************************
if (isset($_POST['txn_id'])){
	//Paypal is sending information
	include("ipn_paypal.php");
	if ($pay_success){
		// Upgrade Account
		$c_year = date ("Y");
		$c_month = date ("n");
		$c_day = date ("j");
		$exp_days = $c_day+$vs_level[$item_number][exp_days];
		$d_expire = date("Y-m-d", mktime(0,0,0,$c_month,$exp_days,$c_year));
		$r_level = mysql_query("SELECT premium FROM $pds_level WHERE level='$item_number'");
		$f_level = mysql_fetch_assoc($r_level);
		mysql_query("UPDATE $pds_list SET level='$item_number', premium='$f_level[premium]', d_upgrade=now(), d_expire='$d_expire' WHERE id='$listing_id';");
	}else{
		// Payment Error - notice set in ipn
	}
	$page = 4;
}

//***********************************************
// Assign Local Variables
//***********************************************
if ( $_POST['categories'] != "" ){
	$cat_array = explode(":", $_POST['categories']);
}

if ( count($_POST['loc']) > 0 ){
	$loc_sel = end($_POST['loc']);
}

// hard coded for Free at 10 dec;
$_POST['mem_level'] = 1;
//Filter posted data
/* edited at 30nov 2010

$_POST = $filter->process($_POST);
foreach($_POST as $key => $value){
	if ( get_magic_quotes_gpc() AND is_string($value)){
		$_POST[$key] = stripslashes($value);
	}
}
*/
$login = (isset($_POST['login'])) ? $_POST['login'] : $vs_current_user['login'];
$usermail = (isset($_POST['usermail'])) ? $_POST['usermail'] : $vs_current_user['usermail'];
$pass = $_POST['pass'];
$vpass = $_POST['vpass'];
$mem_level =  (isset($_POST['mem_level'])) ? $_POST['mem_level'] : $vs_current_listing['level'];
$firm = (isset($_POST['firm'])) ? $_POST['firm'] : $vs_current_listing['firm'];
$description = (isset($_POST['description'])) ? $_POST['description'] : $vs_current_listing['description'];
$website = (isset($_POST['website'])) ? $_POST['website'] : $vs_current_listing['website'];
$addr1 = (isset($_POST['addr1'])) ? $_POST['addr1'] : $vs_current_listing['address1'];
$loc1 = (isset($_POST['loc1'])) ? $_POST['loc1'] : $vs_current_listing['loc1'];
$country = (isset($_POST['country'])) ? $_POST['country'] : $vs_current_listing['country'];
$states = (isset($_POST['states'])) ? $_POST['states'] : $vs_current_listing['states_id'];

$zip = (isset($_POST['zip'])) ? $_POST['zip'] : $vs_current_listing['zip'];
$contact = (isset($_POST['contact'])) ? $_POST['contact'] : $vs_current_listing['contact'];
$phone = (isset($_POST['phone'])) ? $_POST['phone'] : $vs_current_listing['phone'];
$fax = (isset($_POST['fax'])) ? $_POST['fax'] : $vs_current_listing['fax'];
$mobile = (isset($_POST['mobile'])) ? $_POST['mobile'] : $vs_current_listing['mobile'];
$listmail = (isset($_POST['listmail'])) ? $_POST['listmail'] : $vs_current_listing['email'];
$xtra_1 = (isset($_POST['xtra_1'])) ? $_POST['xtra_1'] : $vs_current_listing['xtra_1'];
$xtra_2 = (isset($_POST['xtra_2'])) ? $_POST['xtra_2'] : $vs_current_listing['xtra_2'];
$xtra_3 = (isset($_POST['xtra_3'])) ? $_POST['xtra_3'] : $vs_current_listing['xtra_3'];
$xtra_4 = (isset($_POST['xtra_4'])) ? $_POST['xtra_4'] : $vs_current_listing['xtra_4'];
$xtra_5 = (isset($_POST['xtra_5'])) ? $_POST['xtra_5'] : $vs_current_listing['xtra_5'];
$xtra_6 = (isset($_POST['xtra_6'])) ? $_POST['xtra_6'] : $vs_current_listing['xtra_6'];

$listing_level = $_POST['listing_level'];
$premium = $vs_level[$listing_level]['premium'];
$title_tag = "Add New Business Listing" ;//$language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('register',$lang_set,'title_tag');
$bread_crumb[0] ="Add New Business Listing" ;//$language->desc('register',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************
if ( isset($_POST['user_reg']) ){
	//New user registration submitted

	//Error Checking
	$user_check = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_user WHERE login='$_POST[login]';") );
	$email_check = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_user WHERE usermail='$_POST[usermail]';") );

	if ($login == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_user_empty')."<br>";
	}elseif ( strlen($login) < 4 ){
		$notice .= $language->desc('error_text',$lang_set,'error_user_short')."<br>";
	}elseif ($user_check[0]){
		$notice .= $language->desc('error_text',$lang_set,'error_user_used')."<br>";
		unset($_POST['login']);
	}else{
		$user_space = strpos($login, " ");
		$user_squote = strpos($login, "\'");
		$user_dquote = strpos($login, "\"");
		$user_comma = strpos($login, ",");
		if ( $user_space !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_user_spaces')."<br>";
		}
		if ( $user_squote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_user_squotes')."<br>";
			$login = stripslashes($_POST['login']);
		}
		if ( $user_dquote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_user_dquotes')."<br>";
			$login = stripslashes($_POST['login']);
		}
		if ( $user_comma !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_user_commas')."<br>";
		}
	}
	if ($pass == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_pass_empty')."<br>";
		unset($pass);
		unset($vpass);
	}elseif ( strlen($pass) < 4 ){
		$notice .= $language->desc('error_text',$lang_set,'error_pass_short')."<br>";
		unset($pass);
		unset($vpass);
	}else{
		$pass_space = strpos($pass, " ");
		$pass_squote = strpos($pass, "\'");
		$pass_dquote = strpos($pass, "\"");
		$pass_comma = strpos($pass, ",");
		if ( $pass_space !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_spaces')."<br>";
			unset($pass);
			unset($vpass);
		}
		if ( $pass_squote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_squotes')."<br>";
			unset($pass);
			unset($vpass);
		}
		if ( $pass_dquote !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_dquotes')."<br>";
			unset($pass);
			unset($vpass);
		}
		if ( $pass_comma !== false ){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_commas')."<br>";
			unset($pass);
			unset($vpass);
		}
		if ( $pass != $vpass){
			$notice .= $language->desc('error_text',$lang_set,'error_pass_mismatch')."<br>";
			unset($pass);
			unset($vpass);
		}
	}
	if ($usermail == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_mail_empty')."<br>";
	}elseif ($email_check[0]){
		$notice .= $language->desc('error_text',$lang_set,'error_mail_used')."<br>";
	}elseif (!checkEmail($usermail)){
		$notice .= $language->desc('error_text',$lang_set,'error_mail_bad')."<br>";
	}
	if (!$_POST['agree_term']){
		$notice .= $language->desc('error_text',$lang_set,'error_no_agree')."<br>";
	}

	//No Errors Posted - so add the user record
	if ($notice == ""){
		$pass_md5 = md5($pass);
		mysql_query ("INSERT INTO $pds_user (login, pass, usermail, joindate) VALUES ('$login', '$pass_md5', '$usermail', now() );");
		$user_id = mysql_insert_id();

		//Set the session variables
		$_SESSION['userid'] = $user_id;
		$_SESSION['userpass'] = $pass_md5;
		$_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];

		//Assign user specific template variables
		$tpl-> assign('user_login',$login);
		$tpl-> assign('user_pass',$pass);
		$tpl-> assign('user_usermail',$usermail);

		if($notify['admin_user']){
			//Send Notification Message
			$subject = "New User Registration Submitted";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;

			if( $text_mail-> template_exists($template="mail/new_user_notify_text.tpl") ){
				//Set up Text Message to notify admin of new user
				$text_mail-> assign("subject",$subject);
				$text_mail-> assign('user_login',$login);
				$text_mail-> assign('user_usermail',$usermail);
				$text_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
				$text_message=$text_mail-> fetch("mail/new_user_notify_text.tpl");
				$mail->CreateQuotedPrintableTextPart($mail->WrapText($text_message),"",$text_part);
				$alternative_parts[0] = $text_part;
			}
			if( $html_mail-> template_exists($template="mail/new_user_notify_html.tpl") ){
				//Set up HTML Message to notify admin of new user
				$html_mail-> assign("subject",htmlentities($subject));
				$html_mail-> assign('user_login',$login);
				$html_mail-> assign('user_usermail',$usermail);
                $html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
				$html_message=$html_mail-> fetch("mail/new_user_notify_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$alternative_parts[1] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();
		}

		//Go on to select membership level
		$page = 1;
	}

}elseif ( isset($_POST['level_submit']) ){
	//Membership level submitted

	//Error checking
	if ($_POST['mem_level'] == ""){
		$notice = $language->desc('error_text',$lang_set,'error_sel_level');
		$page = 1;
	}else{
		// No error so set listing level and move on
		$listing_level = $_POST[mem_level];
		$page = 2;
	}
}elseif ( isset($_POST['list_reg']) ){
	//New listing submitted

	// Listing level specific variables
	if($config['auto_approve']){
		$state = "apr";
	}else{
		$state = "sub";
	}

	//Error checking
	if ( !count($cat_array) ){
		$notice .= $language->desc('error_text',$lang_set,'error_no_cat')."<br>";
	}
	if ($firm == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_firm')."<br>";
	}
	if ($vs_level[$listing_level]['description'] and $required['description'] and $description == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_desc')."<br>";
	}
	if ($vs_level[$listing_level]['website'] and $required['website'] and $website == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_web')."<br>";
	}
	if ($vs_level[$listing_level]['addr1'] and $required['address'] and $addr1 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_addr')."<br>";
	}
	if ($vs_level[$listing_level]['loc1'] and $required['loc1'] and $loc1 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_loc1')."<br>";
	}
	if ($vs_level[$listing_level]['zip'] and $required['zip'] and $zip == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_zip')."<br>";
	}
	if ($vs_level[$listing_level]['contact'] and $required['contact'] and $contact == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_cont')."<br>";
	}
	if ($vs_level[$listing_level]['phone'] and $required['phone'] and $phone == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_phone')."<br>";
	}
	if ($vs_level[$listing_level]['fax'] and $required['fax'] and $fax == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_fax')."<br>";
	}
	if ($vs_level[$listing_level]['mobile'] and $required['mobile'] and $mobile == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_mob')."<br>";
	}
	if ($vs_level[$listing_level]['listmail'] and $required['listmail']){
		if($listmail == ""){
			$notice .= $language->desc('error_text',$lang_set,'error_no_mail')."<br>";
		}elseif(!checkEmail($listmail)){
			$notice .= $language->desc('error_text',$lang_set,'error_mail_bad')."<br>";
		}
	}elseif($listmail != "" and !checkEmail($listmail)){
		$notice .= $language->desc('error_text',$lang_set,'error_mail_bad')."<br>";
	}
	if ($vs_level[$listing_level]['xtra_1'] and $required['xtra_1'] and $xtra_1 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra1')."<br>";
	}
	if ($vs_level[$listing_level]['xtra_2'] and $required['xtra_2'] and $xtra_2 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra2')."<br>";
	}
	if ($vs_level[$listing_level]['xtra_3'] and $required['xtra_3'] and $xtra_3 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra3')."<br>";
	}
	if ($vs_level[$listing_level]['xtra_4'] and $required['xtra_4'] and $xtra_4 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra4')."<br>";
	}
	if ($vs_level[$listing_level]['xtra_5'] and $required['xtra_5'] and $xtra_5 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra5')."<br>";
	}
	if ($vs_level[$listing_level]['xtra_6'] and $required['xtra_6'] and $xtra_6 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra6')."<br>";
	}


	if ($notice == ""){
		//No errors - submit listing
		foreach($_POST as $key => $value){
			if (is_string($value)){
				$post_save[$key] = ($value);
				$_POST[$key] = mysql_real_escape_string($value);
			}
		}
		$firm = $_POST['firm'];
		$description = $_POST['description'];
		$website = $_POST['website'];
		$addr1 = $_POST['addr1'];
		$loc1 = $_POST['loc1'];
		$metro_area=$_POST['metro_area'];
		$country = $_POST['country'];
		$states = empty($_POST['states']) ? 0 : $_POST['states'] ;

		$zip = $_POST['zip'];
		$contact = $_POST['contact'];
		$phone = $_POST['phone'];
		$fax = $_POST['fax'];
		$mobile = $_POST['mobile'];
		$listmail = $_POST['listmail'];
		$premium = $_POST['premium'];
		$xtra_1 = $_POST['xtra_1'];
		$xtra_2 = $_POST['xtra_2'];
		$xtra_3 = $_POST['xtra_3'];
		$xtra_4 = $_POST['xtra_4'];
		$xtra_5 = $_POST['xtra_5'];
		$xtra_6 = $_POST['xtra_6'];
		/*
		echo "INSERT INTO $pds_list (userid, state, level, firm, address1, loc1, loc_sel, zip, contact, phone, fax, mobile, description, website, email, premium, d_submit, xtra_1, xtra_2, xtra_3, xtra_4, xtra_5, xtra_6)
					VALUES ('$vs_current_user[id]', '$state', '$config[free_level]', '$firm', '$addr1', '$loc1', '$loc_sel', '$zip', '$contact', '$phone', '$fax', '$mobile', '$description', '$website', '$listmail', '$premium', now(), '$xtra_1', '$xtra_2', '$xtra_3', '$xtra_4', '$xtra_5', '$xtra_6');"
				//	exit;
				*/
  $strsql= "INSERT INTO $pds_list (userid, state, level, firm, address1, loc1, loc_sel, metro_area, country, states_id, zip, contact, phone, fax, mobile, description, website, email, premium, d_submit, xtra_1, xtra_2, xtra_3, xtra_4, xtra_5, xtra_6)
					VALUES ('$vs_current_user[id]', '$state', '$config[free_level]', '$firm', '$addr1', '$loc1', '$loc_sel', $metro_area , '$country', $states, '$zip', '$contact', '$phone', '$fax', '$mobile', '$description', '$website', '$listmail', '$premium', now(), '$xtra_1', '$xtra_2', '$xtra_3', '$xtra_4', '$xtra_5', '$xtra_6');" ;
 // echo $strsql;
		mysql_query ($strsql) or die(mysql_error());
		$insert_id = mysql_insert_id();
		$_SESSION['listid'] = $insert_id;

if ( (isset($_POST['logo'])))
{
	echo "logo";
}

if ( (isset($_FILES["logo"])) && ($insert_id > 0))
{
	//Logo being uploaded

if ($_FILES["logo"]["error"] > 0)
    {
     echo "Return Code: " ;
    }
  else
  {



	$file_info = getimagesize($_FILES['logo']['tmp_name']);

	switch ($file_info[2]){
	case 1:
		$file_ext = "gif";
		break;
	case 2:
		$file_ext = "jpg";
		break;
	case 3:
		$file_ext = "png";
		break;
	case 4:
		$file_ext = "swf";
		break;
	default:
		$file_ext = "";
	}
	$image_file = "$config[root]/logo/$insert_id.$file_ext";
	if(move_uploaded_file($_FILES['logo']['tmp_name'], $image_file))
		{
			//Image Uploaded
			if( ($file_info[0] > $config['logo_w'] OR $file_info[1] > $config['logo_h']) AND function_exists("imagecreate") )
			{
				//Resize Image
				include_once("classes/resizeimage.inc.php");
				$rimg=new RESIZEIMAGE($image_file);
				$rimg->resize_limitwh($config['logo_w'],$config['logo_h'],$image_file);
				$rimg->close();
				$list_logo = "$config[mainurl]/logo/$insert_id.$file_ext?".rand();
			}

			$sql ="UPDATE $pds_list SET logo_ext='$file_ext' WHERE id=".$insert_id;

			mysql_query($sql);
				$vs_current_listing['logo'] = "$config[mainurl]/logo/$insert_id.$file_ext?".rand();
		}
	}

}

		//Listing Statistics
		mysql_query("INSERT INTO $pds_liststats (list_id, page_views, sub_views) VALUES ('$insert_id',0,0)");

		//add categories
		$cat_rows = count($cat_array);

		for ($x=0;$x<$cat_rows;$x++){
			$cat_id = $cat_array[$x];
			mysql_query ("INSERT INTO $pds_listcat (list_id, cat_id) VALUES ('$insert_id', '$cat_id');");

			if($state == 'apr'){
				//turn on category listing flag
				TurnCatOn($cat_id);
			}
		}

        $sel_user = get_user($_SESSION['guid']);
       	$listing_link = $CONFIG->wwwroot."pg/business_listing/main/$insert_id/".$_SESSION['guid'];

        $body=get_user($_SESSION['user']->guid)->name." Added New business listing titled <a href=\"$listing_link\">".$post_save['firm']."</a>";

        $post = new ElggObject();
		$post->subtype = 'riverpost';
		$post->owner_guid = get_loggedin_userid();
		$post->access_id = 1;
		$post->description = $body;
		$save = $post->save();

		if ($save) {
			add_to_river('river/object/riverpost/create','create',$_SESSION['user']->guid,$post->guid);
			system_message(elgg_echo("New Listing Added Successfully"));
		} else {
			register_error(elgg_echo("New Listing addition failed"));
		}




		$text_mail-> assign("subject",$subject);
		$text_mail-> assign("bizname",$sel_user->name);
		$text_mail-> assign('firm',$post_save['firm']);
		$text_mail-> assign('address',$post_save['addr1']);
		$text_mail-> assign('contact',$post_save['contact']);
		$text_mail-> assign('phone',$post_save['phone']);
		$text_mail-> assign('fax',$post_save['fax']);
		$text_mail-> assign('mobile',$post_save['mobile']);
		$text_mail-> assign('description',$post_save['description']);
		$text_mail-> assign('website',$post_save['website']);
		$text_mail-> assign('listmail',$post_save['listmail']);
		$text_mail-> assign("listing_link",$listing_link);
        $text_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);

		$html_mail-> assign("subject",htmlentities($subject));
        $html_mail-> assign("bizname",$sel_user->name);
		$html_mail-> assign("firm",htmlentities($post_save['firm']));
		$html_mail-> assign("address",htmlentities($post_save['addr1']));
		$html_mail-> assign("contact",htmlentities($post_save['contact']));
		$html_mail-> assign("phone",htmlentities($post_save['phone']));
		$html_mail-> assign("fax",htmlentities($post_save['fax']));
		$html_mail-> assign("mobile",htmlentities($post_save['mobile']));
		$html_mail-> assign("description",strip_tags($post_save['description']));
		$html_mail-> assign("website",htmlentities($post_save['website']));
		$html_mail-> assign("listmail",htmlentities($post_save['listmail']));
		$html_mail-> assign("listing_link",$listing_link);
        $html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);


		if($notify['admin_list']){
			//Send Notification Message
			$subject = "New Listing Submitted";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;

			if( $text_mail-> template_exists($template="mail/new_list_notify_text.tpl") ){
				//Set up Text Message to notify admin of new listing
				$text_message=$text_mail-> fetch("mail/new_list_notify_text.tpl");
				$mail->CreateQuotedPrintableTextPart($mail->WrapText($text_message),"",$text_part);
				$alternative_parts[0] = $text_part;
			}
			if( $html_mail-> template_exists($template="mail/new_list_notify_html.tpl") ){
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/new_list_notify_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();
		}

		if($notify['user_submit'] and !$config['auto_approve']){
			//Send Notification Message
			$mail-> ResetMessage();
 		unset($alternative_parts);
			$subject = "Listing Submitted";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("To",$vs_current_user['usermail'],$vs_current_user['usermail']);
			$mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;

			if( $text_mail-> template_exists($template="mail/list_submit_text.tpl") ){
				//Set up Text Message to notify admin of new listing
				$text_message=$text_mail-> fetch("mail/list_submit_text.tpl");
				$mail->CreateQuotedPrintableTextPart($mail->WrapText($text_message),"",$text_part);
				$alternative_parts[0] = $text_part;
			}
			if( $html_mail-> template_exists($template="mail/list_submit_html.tpl") ){
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/list_submit_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();
		}

		if($notify['user_approved'] and $config['auto_approve']){
			//Send Notification Message
			$mail-> ResetMessage();
			unset($alternative_parts);
			$subject = "Listing Approved";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("To",$vs_current_user['usermail'],$vs_current_user['usermail']);
			$mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;

			if( $text_mail-> template_exists($template="mail/list_approved_text.tpl") ){
				//Set up Text Message to notify admin of new listing
				$text_message=$text_mail-> fetch("mail/list_approved_text.tpl");
				$mail->CreateQuotedPrintableTextPart($mail->WrapText($text_message),"",$text_part);
				$alternative_parts[0] = $text_part;
			}
			if( $html_mail-> template_exists($template="mail/list_approved_html.tpl") ){
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/list_approved_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();
		}
		
		// send mail to fan of business
		
		//Send Notification Message   to fan of business
		 $acct_type = getMeAcntType($_SESSION['user']->guid) ;
         if($acct_type == "business" || $acct_type="social/business organization" ){

          $get_user_list = getMeMyFanOfList($_SESSION['user']->guid);

          if (is_null($get_user_list)) {
              //
          }else{
            $mail-> ResetMessage();
			unset($alternative_parts);
			$subject = "Addition of New Listing";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			//$mail-> SetEncodedEmailHeader("To",$vs_current_user['usermail'],$vs_current_user['usermail']);
            // $mail-> SetEncodedEmailHeader("To","shridharpatil47@yahoo.in","shridharpatil47@yahoo.in");
             $indexarray = 0;
            foreach ( $get_user_list as  $value){
                    $sel_user = get_user($value['guid']);

                if ($indexarray == 0){
                    $mail-> SetEncodedEmailHeader("To",$sel_user->email,$sel_user->email);
                }else{
                    $mail-> SetEncodedEmailHeader("Bcc",$sel_user->email,$sel_user->email);
                 }
                $indexarray++;
                }
            $mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;


			if( $html_mail-> template_exists($template="mail/toFan_listing_added_html.tpl") ){
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/toFan_listing_added_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();

          }

		}
		//
		//echo get_intrested_people_for_listing($insert_id);
		$get_intr_ppl =get_intrested_people_for_listing($insert_id);

            if (is_null($get_intr_ppl)) {
              //
          }else{


            $mail-> ResetMessage();
			unset($alternative_parts);
			$subject = "New Listing Matching Your Criteria";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			//$mail-> SetEncodedEmailHeader("To",$vs_current_user['usermail'],$vs_current_user['usermail']);
            // $mail-> SetEncodedEmailHeader("To","shridharpatil47@yahoo.in","shridharpatil47@yahoo.in");
             $indexarray = 0;
            foreach ( $get_intr_ppl as  $value){
                    $sel_user = get_user($value['guid']);

                if ($indexarray == 0){
                    $mail-> SetEncodedEmailHeader("To",$sel_user->email,$sel_user->email);
                }else{
                    $mail-> SetEncodedEmailHeader("Bcc",$sel_user->email,$sel_user->email);
                 }
                $indexarray++;
                }
            $mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;


			if( $html_mail-> template_exists($template="mail/toIntrested_listing_adding_html.tpl") ){
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/toIntrested_listing_adding_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();
         }



		if ($vs_level[$listing_level]['cost'] > 0){
			$page = 3;
		}else{
			mysql_query("UPDATE $pds_list SET level='$listing_level' WHERE id='$_SESSION[listid]';");
			$page = 4;
		}
	}else{
		$page = 2;
	}
}elseif ( isset($_POST['add_cat']) ){
	//Adding Category to list
	$cat_id = $_POST[cat][current(array_flip($_POST['add_cat']))];
	if ( @in_array($cat_id, $cat_array) ){
		// Duplicate Category Selected

	}else{
		//Add Category to the list
		$cat_array[] = $cat_id;
		$cat_str = implode(":", $cat_array);
	}
	$page = 2;
}elseif ( isset($_POST['rem_cat']) ){
	//Remove Category from list
	$cat_id = $_POST[cat][current(array_flip($_POST['rem_cat']))];
	array_splice($cat_array, array_search($cat_id, $cat_array), 1);
	$cat_str = implode(":",$cat_array);
	$page = 2;
}elseif ( isset($_POST['rem_cat_list']) ){
	//Remove Category from list
	array_splice($cat_array, $_POST[cat_list], 1);
	$cat_str = implode(":",$cat_array);
	$page = 2;

}elseif ( isset($_POST['btn_billing']) ){
	//User requesting billing
	$text_mail-> assign("subject",$subject);
	$text_mail-> assign('firm',$firm);
	$text_mail-> assign('address',$addr1);
	$text_mail-> assign('contact',$contact);
	$text_mail-> assign('phone',$phone);
	$text_mail-> assign('fax',$fax);
	$text_mail-> assign('mobile',$mobile);
	$text_mail-> assign('description',$description);
	$text_mail-> assign('website',$website);
	$text_mail-> assign('listmail',$listmail);
	$text_mail-> assign('request_level',$vs_level[$listing_level]['title']);
	$text_mail-> assign('current_level',$vs_level[$config['free_level']]['title']);
	$text_mail-> assign('cost',$vs_level[$listing_level]['cost']);
	$text_mail-> assign('amount',$vs_level[$listing_level]['cost']);
    $text_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
    
	$html_mail-> assign("subject",htmlentities($subject));
	$html_mail-> assign("firm",htmlentities($firm));
	$html_mail-> assign("address",htmlentities($addr1));
	$html_mail-> assign("contact",htmlentities($contact));
	$html_mail-> assign("phone",htmlentities($phone));
	$html_mail-> assign("fax",htmlentities($fax));
	$html_mail-> assign("mobile",htmlentities($mobile));
	$html_mail-> assign("description",htmlentities($description));
	$html_mail-> assign("website",htmlentities($website));
	$html_mail-> assign("listmail",htmlentities($listmail));
	$html_mail-> assign('request_level',$vs_level[$listing_level]['title']);
	$html_mail-> assign('current_level',$vs_level[$config['free_level']]['title']);
	$html_mail-> assign('cost',$vs_level[$listing_level]['cost']);
	$html_mail-> assign('amount',$vs_level[$listing_level]['cost']);
    $html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
	$subject = "Billing Request Details";

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

	mysql_query("UPDATE $pds_list SET level='$config[free_level]' WHERE id='$_SESSION[listid]';");
	$page = 4;

}elseif ( isset($_POST['submit_flag']) ){
	//Nothing Pressed - Processing Cascades
	$page = 2;
}

//***********************************************
//Process Page Displays
//***********************************************

if ($page == 0){
	//New user registration page

}elseif ($page == 1){
	//Select membership level page

}elseif ($page == 2){
	//Listing details page

	//Develop category select boxes
	if ( isset($_POST[cat]) ){
		$cat_level = count($_POST[cat])+1;
	}else{
		$cat_level = 1;
	}
	$cat_select = "
	    <table width=90% >
	     <tr>";
	for ($i=1;$i<=$cat_level;$i++){
		$cat_select .= "
		  <td width=50% align=left valign=top style='border:none;'>
		   <select name=cat[$i] size=10 style=width:$config[cat_sel_w] onChange=submit()>";
		if ($i == 1){
			$r = mysql_query ("SELECT * FROM $pds_category WHERE p IS NULL or p='0' ORDER BY title;");
		}else{
			$r = mysql_query ("SELECT * FROM $pds_category WHERE p='$cat_rel' ORDER BY title;");
		}
		$rows_r = mysql_num_rows($r);
		for ($x=0;$x<$rows_r;$x++){
			$f = mysql_fetch_assoc($r);
			if ($f[id] == $_POST[cat][$i]){
				$cat_select .= "<option value=$f[id] selected>".$language->desc('category', $lang_set, $f[id])."</option>";
				$cat_rel = $f[id];
			}else{
				$cat_select .= "<option value=$f[id]>".$language->desc('category', $lang_set, $f[id])."</option>";
			}
		}
		mysql_free_result($r);
		if ( isset($_POST[cat][$i]) ){
			$oldcat = $_POST[cat][$i];
		}else{
			$oldcat = $f[id];
		}
		$cat_select .= "
		   </select>";
		if ($config['add_any_cat'] and isset($_POST[cat][$i]) and $oldcat == $cat_rel ) {
			if (@!in_array($cat_rel, $cat_array) ){
				$cat_select .= "<br>
		   <input type=submit name=add_cat[$i] value=\"".$language->desc('register', $lang_set, 'btn_add_cat')."\">";
			}else{
				$cat_select .= "<br>
		   <input type=submit name=rem_cat[$i] value=\"".$language->desc('register', $lang_set, 'btn_rem_cat')."\">";
			}
		}
		$cat_select .= "<br>
		   <input type=hidden name=oldcat[$i] value=$oldcat>";
		$child_count = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_category WHERE p='$cat_rel';") );
		if (!$child_count[0] or $oldcat != $cat_rel){
			if (!$config['add_any_cat'] and isset($_POST[cat][$i]) and $oldcat == $cat_rel ){
				$cat_select .= "<br>
		   <input type=submit name=add_cat[$i] value=\"".$language->desc('register', $lang_set, 'btn_add_cat')."\">";
			}
			$cat_select .= "
		  </td>";
			if ($i % $config['cat_col'] == 0){$cat_select .= " ";}
			break;
		}
		$cat_select .= "
		  </td>";
		if ($i % $config['cat_col'] == 0){$cat_select .= " ";}
	}
	$cat_select .= "
	</tr>
	    </table>
	     ";

	if($config['use_loc_sel']){
		//Develop location selects
		$i = 1;
		while ( $end == false ){
			if ($i == 1){
				$loc_title = $language->desc('loc_level', $lang_set, $config['prim_loc_level']);
			}else{
				$loc_title = $language->desc('loc_level', $lang_set, $loc_level);
			}
			$show_location .= "
		  <tr>
		   <td width=50% valign=top align=right bgcolor=#EEEEEE style='border:none;'>
			<font style=\"color:#3366CC; font-size:12pt; font-weight:normal; background-color:#EEEEEE;\">
			 $loc_title:&nbsp;&nbsp;&nbsp;
			</font>
		   </td>
		   <td width=50% align=left valign=left bgcolor=#EEEEEE style='border:none;'>
			<select name=loc[$i] size=1 onChange=submit()>";
			if ($i == 1){
				$r = mysql_query ("SELECT * FROM $pds_locsel WHERE p IS NULL or p='0' ORDER BY title;");
			}else{
				$r = mysql_query ("SELECT * FROM $pds_locsel WHERE p='$loc_rel' ORDER BY title;");
			}
			$rows_r = mysql_num_rows($r);
			for ($x=0;$x<$rows_r;$x++){
				$f = mysql_fetch_assoc($r);
				if ($x == 0){$loc_rel = $f[id];$loc_level = $f[level];}
				if ($f[id] == $_POST[loc][$i]){
					$show_location .= "<option value=$f[id] selected>".$language->desc('location', $lang_set, $f[id])."</option>";
					$loc_rel = $f[id];
					$loc_level = $f[level];
				}else{
					$show_location .= "<option value=$f[id]>".$language->desc('location', $lang_set, $f[id])."</option>";
				}
			}
			mysql_free_result($r);
			$child_count = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_locsel WHERE p='$loc_rel';") );
			if ($child_count[0]){
				$i ++;
			}else{
				$end = true;
			}
			$show_location .= "
		   </td>
		  </tr>
			";
		}
	}
}elseif ($page == 3){
	//Make payment page
	include ("configs/vs_current_listing.php");

}elseif ($page == 4){
	//Registration Complete
	unset($_SESSION['listid']);

}else{
	//We should never be here

}

//***********************************************
// Assign local variables to template
//***********************************************

//Initialize category list
if ( count($cat_array) > 0 ){
	unset ($cat_list);
	for ($x=0;$x<count($cat_array);$x++){
		$cat_list[$x][number] = $x;
		$cat_list[$x][catpath] = getCatPath($cat_array[$x]);
	}
	$cats_left = $vs_level[$listing_level][cats]-count($cat_array);
	$cat_str = implode(":", $cat_array);
}else{
	$cats_left = $vs_level[$listing_level][cats];
}

//$notice =explode("\r\n", $notice) ;
//print_r($notice);

$tpl-> assign('agree_term',$_POST[agree_term]);
$tpl-> assign('page',$page);
$tpl-> assign('notice',$notice);
$tpl-> assign('login',$login);
$tpl-> assign('usermail',$usermail);
$tpl-> assign('pass',$pass);
$tpl-> assign('vpass',$vpass);
$tpl-> assign('listing_level',$listing_level);
$tpl-> assign('firm',$firm);
$tpl-> assign('description',$description);
$tpl-> assign('website',$website);
$tpl-> assign('addr1',$addr1);
$tpl-> assign('loc1',$loc1);
$tpl-> assign('zip',$zip);
$tpl-> assign('contact',$contact);
$tpl-> assign('phone',$phone);
$tpl-> assign('fax',$fax);
$tpl-> assign('mobile',$mobile);
$tpl-> assign('listmail',$listmail);
$tpl-> assign('xtra_1',$xtra_1);
$tpl-> assign('xtra_2',$xtra_2);
$tpl-> assign('xtra_3',$xtra_3);
$tpl-> assign('xtra_4',$xtra_4);
$tpl-> assign('xtra_5',$xtra_5);
$tpl-> assign('xtra_6',$xtra_6);
$tpl-> assign('cat_str',$cat_str);
$tpl-> assign('cat_list',$cat_list);
$tpl-> assign('cats_left',$cats_left);
$tpl-> assign('cat_select',$cat_select);
$tpl-> assign('show_location',$show_location);
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('show_page','register');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/register.tpl");

?>
