<?php
	session_start();
	error_reporting(E_ALL^E_WARNING^E_NOTICE^E_DEPRECATED);
	ini_set('display_errors', 'On'); 

 	ini_set('allow_url_fopen', 1);
	ini_set('memory_limit', '256M');
	ini_set('session.gc_maxlifetime', '21600');
	
	/* Set the default timezone for the script. */
	date_default_timezone_set('Asia/Calcutta');
	// Prints something like: Monday 8th of August 2005 03:12:46 PM
	//echo date('l jS \of F Y h:i:s A');
	/**
	define('WWWROOT', 'http://'.$_SERVER['HTTP_HOST'].'/drestaurent_manager/');
	define('PATHROOT', $_SERVER['DOCUMENT_ROOT'].'/dev/restaurent_manager');	
	**/	
	define('WWWROOT', 'http://'.$_SERVER['HTTP_HOST'].'/restaurant_in/');
	define('PATHROOT', $_SERVER['DOCUMENT_ROOT'].'restaurant_in'); 
	//define('ALL_REST_APP_PATH','http://restaulogy.com/devRestTest/');
	define('ALL_REST_APP_PATH','http://localhost/restaulogy_app/');
	
	define('DFLT_CUSTOMER_EMAIL','sample@sample.com');
	define('DFLT_CUSTOMER_PASS','sample');
	
	//...Web service authentication
	define('RAPI_ID','WebAuthUsr');
	define('RAPI_KEY','W@B!uTh@2018');
	
	$CONFIG = new stdClass();
	$CONFIG->wwwroot = WWWROOT;
	$CONFIG->path = PATHROOT;
	$CONFIG->QR_CODE_LINK = WWWROOT.'user/dashboard.php?table_id=%d&frm_qrcd=1';	
	
	/* Database inclusion and initialization for the application. */
	include("user/database.php");

    if (!$link) {
	   //die('Could not connect: ' . mysql_error());
	   $link = mysql_connect(base64_decode(DB_SERVER), base64_decode(DB_USER), base64_decode(DB_PASSWORD));
	}		
	
	if(!mysql_select_db(base64_decode(DB_NAME))) die('<br/><center><h1 style="font-size:20px;font-weight:100;color:#333333;font-family:arial;"><b>Not able to connect to database.</b></h1></center>');
	
	//echo PATHROOT.'-'.DB_SERVER.'-'. DB_USER.'-'. DB_PASSWORD .'-'. DB_NAME;
	//exit;
	/* Configuration file which contains the application settings. */
	include('user/config.php');

	/* Classes which form the base of the application. Do not remove any of these. */
	include(USER_DIRECTORY.'/functions.php');
	include(USER_DIRECTORY.'/service_functions.php');
	//include(USER_DIRECTORY.'/session.inc.php');
	include(MODS_DIRECTORY.'/count_visitors_class.php');
	include(LANG_DIRECTORY.'/english.php');
	
	// print_r($_COOKIE); 
//..include all files from class folder
	$class_files = array();
	$class_files = glob(dirname(__FILE__).'/'.CLASS_DIRECTORY.'/*.php');
	sort($class_files,SORT_STRING);  
	 if(!empty($class_files) && is_array($class_files)){
		foreach($class_files as $class_file){
			include_once($class_file); 
		} 
	} 	
?>