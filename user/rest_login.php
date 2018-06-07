<?php

 include("../init.php");
 
 $_SESSION['curr_sess_p']='restaulogy';
 
 //..redirect to previous page logic
  /*$prev_page=get_input('prev_page',$_SESSION['prev_page']);
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
  }  
  
  /*$breadcrumbs[] =  array('title'=>$_lang['sign_in'],
  						'link'=>$website.'/user/login.php'); */
  
	$smarty->assign('restaurant_list',tbl_restaurent::GetFields(array("key_field"=>RESTAURENT_ID,"value_field"=>RESTAURENT_NAME,'isActive'=>1)));
	
  $smarty->assign('isAlreadyLoggedIn',$isAlreadyLoggedIn);
	unset($_SESSION['qr_sess_expired']);
  $smarty->assign('active_page','login');
	$smarty->assign('restaurant',$restaurant);
	
  $template = "index.tpl";
  include("footer.php");

?>