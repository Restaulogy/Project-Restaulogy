<?php

 include("../init.php");
 
 //..Clear the previous session if the 'adv_mng_lgn' set
  //..Clear the previous session if the 'adv_mng_lgn' set
 $adv_mng_lgn = get_input('adv_mng_lgn',0); 
 $_really_del_reqd=reallyForceDelete(1); 
 if(is_gt_zero_num($adv_mng_lgn)){ 	
 	if(is_gt_zero_num($_SESSION[SES_TABLE]) && ($sesslife == false)){ 		
 		$session->stop();
 		biz_script_forward($website.'/user/login.php');
 	}	
 	if($_really_del_reqd==1){
		LogMeOut($_really_del_reqd);
		biz_script_forward($website.'/user/login.php');
	}
 }
 
  /*
  //..redirect to previous page logic
  $prev_page=get_input('prev_page',$_SESSION['prev_page']);
  $action=get_input('action',$_SESSION['action']);
  $promotion_id =get_input(SES_PROMOTION,$_SESSION[SES_PROMOTION]);
  
  if(is_not_empty($prev_page)){
  	$_SESSION['prev_page'] = $prev_page;
  } 
  
  if(is_not_empty($action)){
  	$_SESSION['action'] = $action;
  } 
  if(is_not_empty($promotion_id)){
  	$_SESSION[SES_PROMOTION] = $promotion_id;
  }   
  
  switch(strtoupper($prev_page)) {
	case 'ORDER': 
	  	$url = $website.'/user/tbl_submenu_dishes.php?sbmnu_dish_id='.$_SESSION[SES_SUB_MENU_DISH].'&'.POPUP_WINDOW.'=NewOrder'; 
	   break;
	case 'PROMOTION':
	   switch(strtoupper($action)){
	   	 case 'CLAIM_COUPON' : 
		 	$url = $website.'/modules/business_listing/coupon.php?save=1&promotion_id='.$promotion_id.'&user_id='.$_SESSION['guid'].'&cust_login_redirect=1';
		 	break;
	   	 case 'SAVE_COUPON' : 
		 	$url = $website.'/modules/business_listing/favorite.php?new=1&show_type=PR&lid='.$promotion_id.'&uid='.$_SESSION['guid'].'&cust_login_redirect=1';
		 	break; 
		 default:
		 	$url = $website.'/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR';
			break;
	   }
	   break;
	case 'FEEDBACK':			
	   $url = $website.'/user/tbl_feedback.php';
	   break;
	   
	default:
		 	$url = $website.'/';
			break;
   }
   
    if(is_not_empty($_SESSION['prev_page']) && is_not_empty($url) ){
   		$_SESSION['prev_page_url'] = $url;
   }*/

/* Include required files as per the admin option of inbuilt captcha enabled or not. */
	if($inbuilt_captcha == 1)
	{
		include("../".MODS_DIRECTORY."/captcha/php-captcha.inc.php");
	}
	else
	{
		include("../".MODS_DIRECTORY."/recaptchalib.php");
	}

 include("header.php");
 $title= $_lang['login'];
 $isAlreadyLoggedIn = 0;
 /*subheader($_lang['login']);*/
 
 $restaurant = get_input("restaurant",$_SESSION[SES_RESTAURANT]);
 
 //..for duplicate 
  $ph_dupl = get_input("ph_dupl",0);
	$pst_email = get_input("pst_email",'');
	if(is_not_empty($pst_email) && ($ph_dupl==1) ){
		//$pst_email=$phone= str_replace(array('+', '-'), '', filter_var($pst_email, FILTER_SANITIZE_NUMBER_INT));
		$phone1=_get_us_phone($pst_email,1);
		$pst_email=$phone=_get_us_phone($pst_email);
		//echo "SELECT `members`.`email` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE (`staff_phone`='{$phone}' AND `staff_phone`='{$phone1}') AND `staff_restaurent`='{$restaurant}';";
		$dup_ph_email_lst =DB::ExecQry("SELECT `members`.`email` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE (`staff_phone`='{$phone}' OR `staff_phone`='{$phone1}') AND `staff_restaurent`='{$restaurant}';");
		//echo "SELECT `members`.`email` FROM `members` INNER JOIN `tbl_staff` ON `members`.`id`=`tbl_staff`.`staff_member_id` WHERE (`staff_phone`='{$phone}') AND `staff_restaurent`='{$restaurant}';";
		//...loop and mask email
		foreach($dup_ph_email_lst as $val){
			$fin_dup_ph_email_lst[$val['email']]=mask_email($val['email'],'*');
		}		
		$smarty->assign('fin_dup_ph_email_lst',$fin_dup_ph_email_lst);
	}
  
	$prev_page=get_input('prev_page',$_SESSION['prev_page']);
  $action=get_input('action',$_SESSION['action']);
  $promotion_id =get_input(SES_PROMOTION,$_SESSION[SES_PROMOTION]);
  if(is_not_empty($prev_page)){
  	$_SESSION['prev_page'] = $prev_page;
  } 
  if(is_not_empty($action)){
  	$_SESSION['action'] = $action;
  } 
  if(is_not_empty($promotion_id)){
  	$_SESSION[SES_PROMOTION] = $promotion_id;
  }
       
  switch(strtoupper($prev_page)) {
  	case 'BOOKED_ORDER': 
	  	$url = $website.'/user/tbl_orders.php?booked=1'; 
	   break;
	case 'ORDER': 
		$url = $website.'/user/tbl_orders.php'; 
	  	//$url = $website.'/user/tbl_submenu_dishes.php?sbmnu_dish_id='.$_SESSION[SES_SUB_MENU_DISH].'&'.POPUP_WINDOW.'=NewOrder'; 
	   break;
	   
	case 'PROMOTION':
	   switch(strtoupper($action)){
	   	 case 'CLAIM_COUPON' : 
		 	$url = $website.'/modules/business_listing/coupon.php?save=1&promotion_id='.$promotion_id.'&user_id='.$_SESSION['guid'].'&cust_login_redirect=1';
		 	break;
	   	 case 'SAVE_COUPON' : 
		 	$url = $website.'/modules/business_listing/favorite.php?new=1&show_type=PR&lid='.$promotion_id.'&uid='.$_SESSION['guid'].'&cust_login_redirect=1';
		 	break; 
		 default:
		 	$url = $website.'/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR';
			break;
	   }
	   /*if(is_gt_zero_num($_SESSION[SES_PROMOTION])){
	   	$url = $website.'/modules/business_listing/show.php?listing_type=all&show_type=PR&promoid='.$_SESSION[SES_PROMOTION];
	   }else{ 
		$url = $website.'/modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR';
	   } */
	   break;
	case 'FEEDBACK':
	   //$url = $website.'/user/tbl_feedback.php?'.MODE_TITLE.'='.MODE_CREATE;
	   $url = $website.'/user/tbl_feedback.php';
	   break;
   }
   
 if(is_not_empty($_SESSION['prev_page']) && is_not_empty($url) ){
   		$_SESSION['prev_page_url'] = $url;
 }   
	
	if(isset($_GET['r']))
	{
		$r = htmlspecialchars(trim($_GET['r']));
	}
 
		if($r == 'verify')
		{
			if($sesslife == false) 
			{
				//showcaptcha();
			}
			else
			{
				$isAlreadyLoggedIn = 1;
				//echo "<center><div class=\"errorbox\">{$_lang['active_session']}<br/><small>{$_lang['already_logged_in']}</small></div></center>";
			}
		}
		elseif($r == 'reg')
		{
			if($sesslife == false)
			{
				$isAlreadyLoggedIn = 0;
				//am_showLogin();
			}
			else
			{
			 	$isAlreadyLoggedIn = 1;
				//echo "<center><div class=\"errorbox\">{$_lang['active_session']}<br/><small>{$_lang['already_logged_in']}</small></div></center>";
			}
		}
		else
		{
			if($sesslife == false) 
			{
				$isAlreadyLoggedIn = 0;
				/* Show the login box if the session is false. */
				//am_showLogin();
			}
			else
			{
				/* Error message is shown if the user visits this page even after logging in. */
				$isAlreadyLoggedIn = 1;
				//echo "<center><div class=\"errorbox\">{$_lang['active_session']}<br/><small>{$_lang['already_logged_in']}</small></div></center>";
			}

		}
  if(is_not_empty($_SESSION['error'])){
  	$err = $_SESSION['error'] ;
		unset($_SESSION['error']);
  }  
  
  /*$breadcrumbs[] =  array('title'=>$_lang['sign_in'],
  						'link'=>$website.'/user/login.php'); */
  
	$smarty->assign('restaurant_list',tbl_restaurent::GetFields(array("key_field"=>RESTAURENT_ID,"value_field"=>RESTAURENT_NAME,'isActive'=>1)));
	
  $smarty->assign('isAlreadyLoggedIn',$isAlreadyLoggedIn);
	unset($_SESSION['qr_sess_expired']);
  $smarty->assign('active_page','login');
	$smarty->assign('restaurant',$restaurant);
	if(is_gt_zero_num($restaurant)){
		$rest_info = tbl_restaurent::GetInfo($restaurant);
		$smarty->assign('restaurant_name',$rest_info[RESTAURENT_NAME]);
		unset($rest_info);
	}
	
  $template = "index.tpl";
  include("footer.php");

?>