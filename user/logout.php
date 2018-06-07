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
 
  include("../init.php");
	//..different link if from restaulogy
	/*if(is_not_empty($_SESSION['curr_sess_p']) && ($_SESSION['curr_sess_p']=='restaulogy')){
			$redirection_url="{$website}/user/rest_login";
	}else{
			$redirection_url="{$website}/user/login";
	}*/
	$redirection_url="{$website}/user/login";
	
  //..Check if the qrcode session is there
	if(isCustomer() && is_gt_zero_num($_SESSION[SES_TABLE])){
		$redirection_url="{$website}/user/dashboard.php?table_id=".$_SESSION[SES_TABLE]."&frm_qrcd=1";
	}
  /* This is to stop the session before any headers are sent by the script. */
  if($sesslife == true)
  {
  	if(is_gt_zero_num($_SESSION['log_id'])){
		$obj = new hm_log();
		if($obj->readObject(array("log_id"=>$_SESSION['log_id']))){
			$obj->setlog_out_time(date("Y-m-d H:i:s"));
			$obj->insert();
		}
	}
	$session->stop(); 
		if(isset($_COOKIE['authuser']) && isset($_COOKIE['authpass']))
		{
			$time = time();
			setcookie("authuser", "", $time - 3600*24*10, "/");
			setcookie("authpass", "", $time - 3600*24*10, "/");
			setcookie("authrest", "", $time - 3600*24*10, "/");
		}	
  }
  else
  {
	echo "<meta http-equiv=\"Refresh\" Content=\"0;URL={$website}/user/login\" />";
  }
  /* Ends the session over here and then send the headers from below. */
  
  include("header.php");
  /*subheader($_lang['logout']);*/

 /* echo "<center><div id=\"loginmsg\"><img src=\"{$website}/images/working.gif\" /><br/>";
  echo "<p><b>{$_lang['please_wait']}</b></p></div></center>";
  echo "<meta http-equiv=\"Refresh\" Content=\"5;URL={$redirection_url}\" />";*/
	
	biz_script_forward("{$redirection_url}");
	
  include("footer.php");

?>