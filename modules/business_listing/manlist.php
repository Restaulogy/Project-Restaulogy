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

if ( !$vs_current_admin[login] ){
	//no admin logged in
	header("Location: $config[mainurl]/admin.php");
	exit;
}

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('manlist',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('manlist',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

$s_id = $_POST[s_id];
$s_firm = $_POST[s_firm];
$s_user = $_POST['s_user'];
$s_state = $_POST['liststate'];
$s_level = $_POST['mem_level'];

$ssel_prop['select_prompt'] = $language->desc('manlist',$lang_set,'any_state');
$ssel_prop['blank_prompt'] = $language->desc('manlist',$lang_set,'any_state');

$sel_prop['select_prompt'] = $language->desc('manlist',$lang_set,'any_level');
$sel_prop['blank_prompt'] = $language->desc('manlist',$lang_set,'any_level');

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************
if(isset($_POST[btn_approve])){
	//Approve Listing
	mysql_query("UPDATE $pds_list SET state='apr', d_review=now() WHERE id='$_POST[id]';");
	$r_cat = mysql_query("SELECT * FROM $pds_listcat WHERE list_id='$_POST[id]';");
	for($x=0;$x<mysql_num_rows($r_cat);$x++){
		$f_cat = mysql_fetch_assoc($r_cat);
		TurnCatOn($f_cat['cat_id']);
	}

	$r_list = mysql_query("SELECT * FROM $pds_list WHERE id='$_POST[id]';");
	$f_list = mysql_fetch_assoc($r_list);

	if ($f_list['email'] == ""){ 
		$r_user = mysql_query("SELECT usermail FROM $pds_user WHERE id='$s_user'"); 
		$f_user = mysql_fetch_assoc($r_user); 
		$to_mail = $f_user['usermail']; 
	}else{ 
		$to_mail = $f_list['email']; 
	} 

	if($notify['user_approved']){
		//Send Notification Message
		$subject = "Listing Approved";
		$text_mail-> assign("subject",$subject);
		$text_mail-> assign('firm',$f_list['firm']);
		$text_mail-> assign('address',$f_list['address1']);
		$text_mail-> assign('contact',$f_list['contact']);
		$text_mail-> assign('phone',$f_list['phone']);
		$text_mail-> assign('fax',$f_list['fax']);
		$text_mail-> assign('mobile',$f_list['mobile']);
		$text_mail-> assign('description',$f_list['description']);
		$text_mail-> assign('listmail',$f_list['email']);
		$text_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
	
		$html_mail-> assign("subject",htmlentities($subject));
		$html_mail-> assign("firm",htmlentities($f_list['firm']));
		$html_mail-> assign("address",htmlentities($f_list['address']));
		$html_mail-> assign("contact",htmlentities($f_list['contact']));
		$html_mail-> assign("phone",htmlentities($f_list['phone']));
		$html_mail-> assign("fax",htmlentities($f_list['fax']));
		$html_mail-> assign("mobile",htmlentities($f_list['mobile']));
		$html_mail-> assign("description",htmlentities($f_list['description']));
		$html_mail-> assign("listmail",htmlentities($f_list['email']));
		$html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);
	
		$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
		$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
		$mail-> SetEncodedEmailHeader("To",$to_mail,$to_mail);
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
}elseif(isset($_POST[btn_level])){	
	//Change membership level
	$c_year = date ("Y");
	$c_month = date ("n");
	$c_day = date ("j");
	$exp_days = $c_day+($vs_level[$_POST[level]][expire]*$vs_level[$_POST[level]][exp_days]);
	$d_expire = date("Y-m-d", mktime(0,0,0,$c_month,$exp_days,$c_year));
	$r_level = mysql_query("SELECT premium FROM $pds_level WHERE level='$_POST[level]'");
	$f_level = mysql_fetch_assoc($r_level);
	mysql_query("UPDATE $pds_list SET level='$_POST[level]', d_upgrade=now(), d_expire='$d_expire', premium='$f_level[premium]' WHERE id='$_POST[id]';");
}elseif(isset($_POST[btn_disapprove])){	
	//Disapprove Listing
	mysql_query("UPDATE $pds_list SET state='del' WHERE id='$_POST[id]';");
	$r_cat = mysql_query("SELECT * FROM $pds_listcat WHERE list_id='$_POST[id]';");
	for($x=0;$x<mysql_num_rows($r_cat);$x++){
		$f_cat = mysql_fetch_assoc($r_cat);
		TurnCatOff($f_cat['cat_id']);
	}
}elseif(isset($_POST[btn_remove])){	
	//Remove Deleted Listing
	mysql_query("DELETE FROM $pds_list WHERE id='$_POST[id]';");
	mysql_query("DELETE FROM $pds_listcat WHERE list_id='$_POST[id]';");
}elseif(isset($_POST[btn_edit])){
	//Edit Listing
	$_SESSION[lid] = $_POST[id];
	header("location:edlist.php?lid=$_POST[id]");
	exit;
}

//***********************************************
// Member Selection Lists
//***********************************************
$r_user = mysql_query("SELECT * FROM $pds_user ORDER BY login;");
if(mysql_num_rows($r_user)){
	$user_sel = '<select name=s_user>';
	$user_sel .= '<option value="0">'.$language->desc('manlist',$lang_set,'any_user');
	for($x=0;$x<mysql_num_rows($r_user);$x++){
		$f_user = mysql_fetch_assoc($r_user);
		if($s_user == $f_user[id]){
			$user_sel .= '<option value="'.$f_user[id].'" selected>'.$f_user['login'];
		}else{
			$user_sel .= '<option value="'.$f_user[id].'">'.$f_user['login'];
		}
	}
	$user_sel .= '</select>';
}

//***********************************************
// Listings
//***********************************************

if($s_user){
	$sql = "WHERE userid='$s_user' ";
}
if($s_state != ''){
	if($sql == ''){
		$sql = "WHERE state='$s_state' ";
	}else{
		$sql .= "AND state='$s_state' ";
	}
}
if($s_level != ''){
	if($sql == ''){
		$sql = "WHERE level='$s_level' ";
	}else{
		$sql .= "AND level='$s_level' ";
	}
}
if($s_firm != ''){
	if($sql == ''){
		$sql = "WHERE firm LIKE '%$s_firm%' ";
	}else{
		$sql .= "AND firm LIKE '%$s_firm%' ";
	}
}
if($s_id != ''){
	$sql = "WHERE id='$s_id' ";
}
if($sql != ''){
	$r_list = mysql_query("SELECT id, firm FROM $pds_list $sql");
	if(mysql_num_rows($r_list) > 0){
		$list_sel = "<select name=list_sel>\n";
		for($x=0;$x<mysql_num_rows($r_list);$x++){
			$f_list = mysql_fetch_assoc($r_list);
			if($x == 0){$list_id = $f_list[id];}
			if($f_list[id] == $_POST[list_sel]){
				$list_sel .= "<option value=$f_list[id] selected>$f_list[firm]</option>\n";
				$list_id = $f_list[id];
			}else{
				$list_sel .= "<option value=$f_list[id]>$f_list[firm]</option>\n";
			}
		}
		$list_sel .= "</select>\n";
	}else{
		$list_sel = "";
	}
}
include ("configs/vs_current_listing.php");

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('list_sel',$list_sel);
$tpl-> assign('user_sel',$user_sel);
$tpl-> assign('show_state',$show_state);
$tpl-> assign('ssel_prop',$ssel_prop);
$tpl-> assign('sel_prop',$sel_prop);
$tpl-> assign('s_id',$s_id);
$tpl-> assign('s_firm',$s_firm);
$tpl-> assign('show_page','manlist');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/manlist.tpl");

?>
