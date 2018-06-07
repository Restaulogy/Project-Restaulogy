<?php 

	//unset($_SESSION);	
	//exit;

	/* Error reporting for the application. Set it to error_reporting(E_ALL) for debugging. */	
	//error_reporting(E_ALL^E_NOTICE^E_STRICT^E_DEPRECATED); //
	//error_reporting(E_ALL ^E_NOTICE^ E_DEPRECATED);
	//error_reporting(E_ALL^E_STRICT^E_WARNING^E_NOTICE^E_DEPRECATED);
	error_reporting(E_ALL^E_NOTICE^E_STRICT^E_DEPRECATED);
	ini_set('display_errors', 'Off'); 
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
	define('PATHROOT', $_SERVER['DOCUMENT_ROOT'].'/restaurant_in');
	define('ALL_REST_APP_PATH','http://restaulogy.com/devRestTest/'); 
	
	define('DFLT_CUSTOMER_EMAIL','sample@sample.com');
	define('DFLT_CUSTOMER_PASS','sample');
	
	$CONFIG = new stdClass();
	$CONFIG->wwwroot = WWWROOT;
	$CONFIG->path = PATHROOT;
	$CONFIG->QR_CODE_LINK = WWWROOT.'user/dashboard.php?table_id=%d&frm_qrcd=1';
	
	if(!isset($_SESSION['guid'])) $_SESSION['guid'] = 0;
	if(!isset($_SESSION['userid'])) $_SESSION['userid'] = 0;
	//if(!isset($_SESSION[SES_RESTAURANT])) $_SESSION[SES_RESTAURANT] = 1; 
	if(!isset($_SESSION[SES_PAYPAL_EMAIL])) $_SESSION[SES_PAYPAL_EMAIL] = "";
	if(!isset($_SESSION[SES_TABLE])) $_SESSION[SES_TABLE] = 0;

	/* Database inclusion and initialization for the application. */
	include("user/database.php");
   
    if (!$link) {
	   //die('Could not connect: ' . mysql_error());
	   $link = mysql_connect(base64_decode(DB_SERVER), base64_decode(DB_USER), base64_decode(DB_PASSWORD));
	}	

	if(!mysql_select_db(base64_decode(DB_NAME))) die('<br/><center><h1 style="font-size:20px;font-weight:100;color:#333333;font-family:arial;"><b>Not able to connect to database.</b></h1></center>');
	
	/* Configuration file which contains the application settings. */
	include('user/config.php');

	/* Start sessions for the application. User sessions are stored in database rather than session files for enhanced security. */
	include(MODS_DIRECTORY.'/class.dbsession.php');	
	
/*
 if(isset($_REQUEST['frm_qrcd']) && $_REQUEST['frm_qrcd']>0){
 		$frm_qrcd =$_REQUEST['frm_qrcd'];
 }else{
 		$frm_qrcd =0;
 }
 print_r($_SESSION);
	//$frm_qrcd = get_input('frm_qrcd',0);
	if(($sesslife==FALSE) && ($frm_qrcd==0) && ($_SESSION[SES_TABLE]==0)){
		$_isdestroy=true;
	}else{
		$_isdestroy=false;
	}
	echo "_isdestroy=$_isdestroy";*/
	//exit;
	//$session = new dbsession(SES_EXP_TIME_SEC);
	 //print_r($_SESSION);
	$session = new dbsession();
	//echo "======";
	 //print_r($_SESSION);
	/*if($_isdestroy==true){
		$session->stop();
		unset($_SESSION);
	}
	print_r($_SESSION);*/
	//echo "TIME=".SES_EXP_TIME_SEC;	
	
	//echo 'session.gc_maxlifetime = ' . ini_get('session.gc_maxlifetime') . "\n";
	
	/* Classes which form the base of the application. Do not remove any of these. */
	include(USER_DIRECTORY.'/functions.php');
	include(USER_DIRECTORY.'/session.inc.php');
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
	
//..This included in the headers now
// include_once(dirname(__FILE__)."/".CLASS_DIRECTORY."/Smarty/libs/Smarty.class.php");
	$Global_member   = array();
	$lastPendingRequest= 0; //.. Last Pending Request variable 
	$lastEmpOrder= 0;  		//.. Last Employee Order variable
	$emp_tables = array(); 
	if(is_not_empty($_SESSION['user'])){
		unset($_SESSION[SES_ONLINE_STORE]);
		//..Check if the sess log id record has logout time gt that now
		/*
		$obj = new hm_log();
	if($obj->readObject(array("log_id"=>$_SESSION['log_id']))){
			$my_log_out_time=$obj->getlog_out_time();
			if($my_log_out_time >= date(DATE_FORMAT)){
				echo "<script>window.location.href='".WWWROOT."user/logout'</script>";
				exit;
			}
		}
		*/		
   	$newObj = new members();
    $Global_member = $newObj->GetInfo(0,$_SESSION['user']);
		//.. set the variables required by the promotions module
		$_SESSION['guid'] = $Global_member['member_id'];
		$_SESSION['userid']	=  $Global_member['member_id'];
		if(is_gt_zero_num($Global_member['staff_restaurent'])){
	
			$_SESSION[SES_RESTAURANT] = $Global_member['staff_restaurent'];
	//if($Global_member['member_role_id']!= ROLE_CUSTOMER){
			/*$_SESSION[SES_RESTAURANT] = $Global_member['staff_restaurent'];*/
			// $_SESSION[SES_RESTAURANT] = 1;
			$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
		  if(is_not_empty($rest_info)){
		    if((is_gt_zero_num($rest_info[RESTAURENT_IS_PAYPAL])) && (is_not_empty($rest_info[RESTAURENT_PAYPAL_EMAIL]))){
					$_SESSION[SES_PAYPAL_EMAIL] = $rest_info[RESTAURENT_PAYPAL_EMAIL];
				} 
				$_SESSION[SES_RESTNT_NM] =$rest_info[RESTAURENT_NAME];	
				$_SESSION['curr_restant'] =$rest_info;
		  }
  		unset($rest_info);		
		}
		$_SESSION['userpass']	= $_SESSION['pass'];
		$_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['member_role_id'] = $Global_member['member_role_id'];
		
		/* Get all logged in customers ..this logic added for fetching all logged in user which employee serving tables */
		//if(($Global_member['member_role_id'] == ROLE_WAITER) && (is_not_empty($_SESSION[SES_CART]))){
		if($Global_member['member_role_id'] == ROLE_WAITER){			
			//$logged_users=GetLoggedInUsers($Global_member['member_id']);
			$emp_tables=GetEmpTables($Global_member['member_id'],1);			
		}
		if($Global_member['member_role_id'] == ROLE_MANAGER){			
			$emp_tables = tbl_dining_table::GetFields(array('key_field' => 'table_id','value_field' => 'table_number','isActive'=>1));		
		}
		
		
		if($Global_member['member_role_id'] == ROLE_CUSTOMER){		
			$_SESSION[SES_CUST_NM]=$Global_member['email'];
			//$_SESSION[SES_CUST_PHN]= str_replace(['+', '-'], '', filter_var($Global_member['staff_phone'], FILTER_SANITIZE_NUMBER_INT));	
			$_SESSION[SES_CUST_PHN]= filter_var($Global_member['staff_phone'], FILTER_SANITIZE_NUMBER_INT);	
			//...Check if the table session is cleaning and if customer is logged in then log the user out of the system
			//chk_if_tbl_sess_is_cleaning();		
		}
		
		//print_r($emp_tables);		 
		// Drop a cookie for secondary validation
		setcookie('validate', md5($_SESSION['user']));
    unset($newObj);
    
    	if($Global_member['member_role_id']==ROLE_ADMIN){
			$objtbl_admin_dashboard =  tbl_admin_dashboard::readArray(array(ADMDASH_FOR_ADMIN=>1),$result_found_re); 
		}else{
			$objtbl_admin_dashboard =  tbl_admin_dashboard::readArray(array(ADMDASH_FOR_MNGR=>1),$result_found_re); 
		}	
		$_SESSION['tbl_admin_dashboard_list']= $objtbl_admin_dashboard;
		
    }else{
		
			//..wihtout logged in users check 
			if(is_gt_zero_num($_SESSION[SES_RESTAURANT])){
				$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
			  $_SESSION[SES_RESTNT_NM] =$rest_info[RESTAURENT_NAME];
				$_SESSION['curr_restant'] =$rest_info;		 
  			 unset($rest_info); 
			}else{
				 //.. if the qr session is there ..customer
				 if($_SESSION[SES_TABLE]){
				  $tbl_info = tbl_dining_table::GetInfo($_SESSION[SES_TABLE]);
				  $_SESSION[SES_RESTAURANT] = $tbl_info['table_restaurant'];	
				  $rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
			    $_SESSION[SES_RESTNT_NM] =$rest_info[RESTAURENT_NAME];		 
  			  unset($rest_info); 						
				}		
		  }		
	}	
	//...following code added to fetc the restaurant menu configuration options
 	if(is_gt_zero_num($_SESSION[SES_RESTAURANT])){
				if((is_not_empty($_SESSION['rest_menu_opt_det'])==FALSE) || ($_SESSION['rest_menu_opt_det']!=$_SESSION[SES_RESTAURANT])){
						//..get the role wise functionality
						$objtbl_rest_menu_opt = new tbl_rest_menu_opt();	
						$rest_menu_opt_det=$objtbl_rest_menu_opt->GetInfo(0,$_SESSION[SES_RESTAURANT]);
						$_SESSION['rest_menu_opt_det']=$rest_menu_opt_det;
						unset($objtbl_rest_menu_opt);	
				}				
	}else{
		if($Global_member['member_role_id'] == ROLE_DEV){
				$rest_menu_opt_det=tbl_rest_menu_opt::dev_all_mnu_GetInfo();
				$_SESSION['rest_menu_opt_det']=$rest_menu_opt_det;
				unset($objtbl_rest_menu_opt);
		}
	}
	//print_r($_SESSION['rest_menu_opt_det']);
	
	if(($Global_member['member_role_id'] == ROLE_WAITER) ){
	  //tbl_services_requests::getLastPendingRequest(); 
 	  //tbl_orders::getLastEmpOrder($emp_tables);
	}	
	
	//..Temp..add location
	if(is_not_empty($_SESSION['client_lat'])==false){
		 $_SESSION['client_city'] = "Phoenix";
		 $_SESSION['client_state'] = "AZ";
		 $_SESSION['client_country'] = "US";
		 $_SESSION['client_lat'] = "33.4483771";
		 $_SESSION['client_long'] = "-112.0740373";
	}
  
	//$visitor = new Count_visitors;
	//$visitor->delay = 1; /* how often (in hours) a visitor is registered in the database (default = 1 hour) */
	//$visitor->insert_new_visit(); /* That's all, the validation is with this method, too. */
	  
	/* Initialize the error engine for the login process only. Other pages use their internal error engine. */
	if(!isset($_SESSION['error'])){
		$_SESSION['error'] = NULL;
	}	
	//print_r($_SESSION);
	
?>