<?php
/*
	@! AuthManager v3.0
	@@ User authentication and management web application
-----------------------------------------------------------------------------	
	** author: StitchApps
	** website: http://www.stitchapps.com
	** email: support@stitchapps.com
	** phone support: +91 9871084893
-----------------------------------------------------------------------------
	@@package: am_authmanager3.0
*/
include("../init.php");
include("../".USER_DIRECTORY."/header.php");

$js = "";
$title = $_lang['update_profile'];
$breadcrumbs[] = array('title'=>$title,'link'=>$website.'/user/editprofile.php');
if($sesslife == true) {
	
	$member_role_id = get_sql_input('member_role_id');
	$fname = get_sql_input('fname');
	$lname = get_sql_input('lname');
	$phone = get_sql_input('phone');
	$address = get_sql_input('address');
	$zip = get_sql_input('zip');
	$designation = get_sql_input('designation');
	$description = get_sql_input('description');
	$device_id = get_sql_input('device_id');
	$gcm_reg_id = get_sql_input('gcm_reg_id');  
	$city = get_sql_input("city");
	$metro = get_sql_input("metro");
	$state = get_sql_input("state");
	$country = get_sql_input("country","IN");
	$fax = get_sql_input("fax");
	$web_site = get_sql_input("website");	
	$sms_subscribed = get_sql_input("sms_subscribed",0);
	
	//$restaurant = get_sql_input("restaurant");	
	$restaurant=$_SESSION[SES_RESTAURANT];
	
	
	if(isset($_POST["editprofile"])) {
	
	  
	$member_id = get_sql_input('member_id', $Global_member['member_id']);
	 
	 $validate = true;
	 if(!(is_gt_zero_num($member_id))){
	 	$validate = false;
		$err = "Please, User is not selectd.<br>"; 
	 }
	 if(!(is_not_empty($fname))){
	 	$validate = false;
		$err = "Please, Enter First Name.<br>"; 
	 }
	 if(!(is_not_empty($lname))){
	 	$validate = false;
		$err = "Please, Enter Last Name.<br>"; 
	 }
	 
	 if(!(is_gt_zero_num($member_role_id))){
	 	$validate = false;
		$err = "Please User type is not selectd.<br>"; 
	 }
	 
	 
	
	 if ($validate){
    $is_success = 0; 
	 	$obj = new tbl_staff();
		//$is_success = $obj->update($member_id, $address, $lname, $fname, $zip, $phone,$designation,$device_id,$gcm_reg_id, $description,);					
 		$is_success = $obj->update($member_id, $address, $lname, $fname,$city,$state,$metro,$country,$zip, $phone,$fax,$web_site,$device_id,$gcm_reg_id, $description,$designation,$restaurant);
	 	unset($obj);
		//..update the sms subscription
		members::update_member_sms_subscibe($member_id,$sms_subscribed);
		if(is_gt_zero_num($is_success)){
		  $_SESSION[SES_FLASH_MSG] = "<div class=\"success\">Your profile has been updated successfully</div>";	
		}
	 }else{
	 	$_SESSION[SES_FLASH_MSG] = "<div class=\"error\">$err</div>";	
	 } 
		
	}

	/*
	displaying the user info edit profile page.
	*/
	//am_showEdit_profile($_SESSION['user']);
	$member = new members(); 
	$userinfo = $member->GetInfo(0,$_SESSION['user']);
	
	
 	/*print_r($userinfo);*/
	$smarty->assign('state_list',getStates($country));
	if(is_gt_zero_num($userinfo['staff_state'])){
		$userinfo['state_name'] = getStateNameById($userinfo['staff_state']);
		$userinfo['metro_name'] = getMetroNameById($userinfo['staff_metro']);
		$smarty->assign('metro_list',getMetroByState($userinfo['staff_state']));
	}
  
 	$smarty->assign("userinfo",$userinfo); 
	$smarty->assign('active_page','edit_profile');
	$template = "editprofile.tpl"; 
	//edit_profile();
} else {
    $template = "index.tpl"; 
	//echo "<meta http-equiv=\"refresh\" content=\"0;url={$website}/".USER_DIRECTORY."/login\" />";
}

include("footer.php");
?>