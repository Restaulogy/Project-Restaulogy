<?php

 
  include("../init.php");

  $redirection_url="{$website}/user/login";

  /* This is to stop the session before any headers are sent by the script. */
/*  if($sesslife == true)
  {*/
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
 /* }
  else
  {*/
	echo "<meta http-equiv=\"Refresh\" Content=\"0;URL={$website}/user/login\" />";
  /*}*/
  /* Ends the session over here and then send the headers from below. */
  
  include("header.php");
  /*subheader($_lang['logout']);*/

 /* echo "<center><div id=\"loginmsg\"><img src=\"{$website}/images/working.gif\" /><br/>";
  echo "<p><b>{$_lang['please_wait']}</b></p></div></center>";
  echo "<meta http-equiv=\"Refresh\" Content=\"5;URL={$redirection_url}\" />";*/
	
  biz_script_forward("{$redirection_url}");
	
  include("footer.php");

?>