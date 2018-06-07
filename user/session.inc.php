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
   //print_r($_SESSION);
	 //unset($_SESSION);
	 
   $username = "";
   $sesslife = false;
	 //print_r($_COOKIE);
	 //exit;
	 
   if(isset($_COOKIE['authuser']) && isset($_COOKIE['authpass']) && isset($_COOKIE['authrest'])){
	  $username = $_COOKIE['authuser'];
	  $password = $_COOKIE['authpass'];
		$restaurant = $_COOKIE['authrest'];
	  //$q = "SELECT * FROM `members` WHERE (`email`='{$username}') AND (`password`='{$password}')";
		$q = 'SELECT `members`.* FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$restaurant.' AND `email`="'.$username.'" and `password`="'.$password.'";';
		//echo '1=='.$q;
		//exit;
		if(!($result_set = mysql_query($q))) die(mysql_error());
		$n1 = mysql_num_rows($result_set);
      
		if(!$n1)
		{
			$session->stop();
			$sesslife = false;
      $Global_member = array();
		}
		else
		{			
			$sesslife = true;
			$r = mysql_fetch_array($result_set);
			$userid = $r['id'];
			$userpass = $r['password'];
			$username = $r['email'];
			//..If session user is not set
			if(isset($_SESSION['user'])==false){
				$_SESSION['user']=$username;
	  		$_SESSION['pass']=$userpass;
				$_SESSION['authrest']=$restaurant;
			}
		}
  
	 //}elseif(isset($_SESSION['user'])){
	}elseif(isset($_SESSION['user']) && isset($_SESSION['authrest'])){
	
		//if(isset($_SESSION['user']) && isset($_SESSION['authrest'])){
    $sesslife = true;
	  $username = $_SESSION['user'];
	  $password = $_SESSION['pass'];
		$restaurant = $_SESSION['authrest'];

    //  $q = "SELECT * FROM `members` WHERE (`email`='{$username}') AND (`password`='{$password}')";
		$q = 'SELECT `members`.* FROM `members` INNER JOIN `tbl_staff` ON `members`.`id` = `tbl_staff`.`staff_member_id` WHERE `staff_restaurent` = '.$restaurant.' AND `email`="'.$username.'" and `password`="'.$password.'";';
		// echo '2=='. $q;
	  // exit;
		if(!($result_set = mysql_query($q))) die(mysql_error());
		$n1 = mysql_num_rows($result_set);
      
		if(!$n1){
			$session->stop();
			$sesslife = false;
		}else{
			$r = mysql_fetch_array($result_set);
			$userid =   $r['id'];
			$userpass = $r['password'];
			$username = $r['email']; 
		}
   }else{
		$sesslife = false;
		$userid = 0;
   }

?>