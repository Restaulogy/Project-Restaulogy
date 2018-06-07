<?php

	/*
	+--------------------------------------------------------------------------
	|   Auth Manager - Content Protection & User Management (Open Source)
	+--------------------------------------------------------------------------
	|   by ScriptsApart
	|   (c) 2011 ScriptsApart
	|   http://www.scriptsapart.com/
	+--------------------------------------------------------------------------
	|   Web: http://www.scriptsapart.com/
	|   Email: support@scriptsapart.com
	|	Facebook: http://www.facebook.com/pages/Scripts-Apart/149933518360387
	|	Twitter: http://www.twitter.com/scriptsapart
	|	Blackberry PIN: 20F03848
	|	Phone Support: +91 9871084893
	+--------------------------------------------------------------------------
	|   > Open Source(100%)
	|   > First Version: 13th September 2010
	|	> Version 2.0: 8th February 2011
	+--------------------------------------------------------------------------
	*/

	/* Defining directories for easy changes in future. You can change the directory names
	below but make sure to change the folder names before changing these values or else the
	script will stop functioning. */ 
	define('USER_DIRECTORY', 'user');
	define('JS_DIRECTORY', 'js');
	define('MODS_DIRECTORY', 'modules');
	define('LANG_DIRECTORY', 'languages');
	define('STATIC_DIRECTORY', 'static');
	define('CLASS_DIRECTORY', 'class'); 
	//...Constant for emplyoee page refresh for pending request
	//.. here in sec it should multiply by 1000 so the Actucally sec will be SEC =  SEC * 1000;
	define("EMP_PG_REFRESH_SEC", 15000); 
 	
	/* Global settings for the website are fetched via this file. These settings are configurable
	from the admin panel. */
  
  $settings_query = mysql_query("SELECT * FROM `settings`");
	
	if(mysql_num_rows($settings_query))
	{
		$r = mysql_fetch_array($settings_query);
	}
	else
	{
		die("<br/><center><h1 style='font-size:20px;font-weight:100;font-family:arial;'><b>Auth Manager</b> does not seem to be installed. Please run Install wizard to install the product.</h1></center>");
	}
  
  $website = $r['website']; 
  
	if($website == "")
	{
		die("<br/><center><h1 style='font-size:20px;font-weight:100;font-family:arial;'><b>Auth Manager</b> does not seem to be installed. Please run Install wizard to install the product.</h1></center>");
	}
  
  //$webtitle = (empty($_SESSION[SES_RESTNT_NM]) ? $r['title'] : $_SESSION[SES_RESTNT_NM]);
	//echo $webtitle;
	//$webtitle = $r['title'];
  $description = $r['description'];
  $admin_email = $r['admin_email'];
  $keywords = $r['keywords'];
  $publickey = $r['recaptcha_public'];
  $privatekey = $r['recaptcha_private'];
  $analytics_enabled = $r['analytics_enabled'];
  $inbuilt_captcha = $r['inbuilt_captcha'];

	/* Fetch the analytics code only if it is enabled from the backend. */
	if($analytics_enabled == 1)
	{
		$analytics_code = $r['analytics_code'];
	}
	else
	{
		$analytics_code = NULL;
	}

  $user_verification = $r['user_verification'];
  $sending_email = $r['sending_email'];
  $grid_theme	= $r['grid_theme'];
	$order_tax	= $r['order_tax']; 
	$order_delay_time = $r['order_delay_time'];
	$order_confirm_time = $r['order_confirm_time'];
	  
	//for wait queue
	$isAllowNewQue = $r['isAllowNewQue'];
  $que_curr_day = $r['que_curr_day'];
  //for Online Order is activate
	$isAllowOnlineOrder = $r['isAllowOnlineOrder'];
	 
 	/* If no sending_email is specified then use the admin_email for sending the mail. */
	if($sending_email == "")
	{
		$sending_email = $admin_email;
	} 

?>