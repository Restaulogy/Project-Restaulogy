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
// Code for system and module setup
//*********************************************** 
require_once(dirname(dirname(dirname(dirname(__FILE__))))."/init.php");
//include_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php";

global $CONFIG,$SESSION,$BIZNETWORKING_SITE_NAME, $curr_user, $isMobile, $elgg_window_width, $elgg_window_height,$isFBConnected,$Global_member;

$BIZNETWORKING_SITE_NAME  = "Restaurant Manager";

$elgg_user_acct_type="individual";
$elgg_curr_user_name = "" ;
$elgg_curr_user_mail = "";
$elgg_chk_gold_user = 1;
$isMobile=1;

$elgg_main_url = WWWROOT;
$elgg_site_url = $elgg_main_url.'modules/business_listing/';
$elgg_small_icon_url = WWWROOT."images/graphics/icons/16X16/";
$elgg_graphics_url = WWWROOT."images/_graphics/";
$elgg_graphics_small_icon_url = WWWROOT."images/_graphics/icons/16X16/";

$elgg_is_admin_user = 0;//(isadminloggedin()? 1 : 0);

if((isset($_SESSION['guid'])) && ($_SESSION['guid']>0)){
    $curr_user = $_SESSION['guid'];	
	$elgg_user_acct_type = getMeAcntType($_SESSION['guid']);
	
	$myacnttype=getMeAcntType($_SESSION['guid']);
	if (($myacnttype=='business')||($myacnttype=='social/business organization'))	
		$my_lst_id=getMeMyBL();     
	$bl_user_id=checkIfUserInBL();	
	//echo "elgg_user_acct_type=$elgg_user_acct_type | my_lst_id=$my_lst_id |bl_user_id=$bl_user_id";
	$elgg_curr_user_name = $Global_member['full_name'];
	$elgg_curr_user_mail = $_SESSION['user'];	
	//$elgg_chk_gold_user = 1;
}else{
    $curr_user = 0;
}
  $isMobile  = 1;
  $elgg_window_height =  ELGG_MOBILE_HEIGHT;
  $elgg_window_width =  ELGG_MOBILE_WIDTH;
  $isFBConnected  = 0;  


// Configuration Settings
include ("configs/config.php");

// Database Connection Module
//include ("modules/connect.php");

// Classes
include ("classes/classes.php");

// Functions
include ("classes/functions.php");

//Class
include ("classes/cls_bus_working_hrs.php");

// Functions
include ("classes/elgg_entity.php");





//.. INITIALISATION
$elgg_remaining_itm_to_post = 0; //.. For subscription
$elgg_user_subscription_id = 0; //.. For subscription
$elgg_user_allow_to_post = 0;

$vs_user_limit = chkuserlimit($elgg_user_acct_type);
//..if current user is business user get his buisiness listing id
$vs_user_profile_list_id = getMeMyProfileListing();
//..get current users state and metro area
$vs_user_prof_loc=getCurUsrMetroArea();
//print_r($vs_user_prof_loc);

//Start Session
//session_start();

// Browsers Template
if ( ( (!empty($HTTP_COOKIE_VARS["template"])) and ($_POST["template"] != "") ) or ( (empty($HTTP_COOKIE_VARS["template"])) and ($_POST["template"] != "") ) ){
	setcookie ("template","",time()+(60*60*24*30),"","");
	setcookie ("template",$_POST["template"],time()+(60*60*24*30),"","");
	$config['deftpl'] = $_POST[template];
}

if ( (!empty($HTTP_COOKIE_VARS["template"])) and (!isset($_POST["template"])) ){
	$config['deftpl'] = $HTTP_COOKIE_VARS["template"];
}

// Browsers Language
if(  ( (!empty($HTTP_COOKIE_VARS["lang"])) and ($_POST["code_lang"] != "") ) or ( (empty($HTTP_COOKIE_VARS["lang"])) and ($_POST["code_lang"] != "") ) ){
	setcookie ("lang","",time()+(60*60*24*30),"","");
	setcookie ("lang",$_POST["code_lang"],time()+(60*60*24*30),"","");
	$lang_set = $_POST['code_lang'];
}

if ( (!empty($HTTP_COOKIE_VARS["lang"])) and (!isset($_POST["code_lang"])) ){
	$lang_set = $HTTP_COOKIE_VARS["lang"];
}

// Register Language
$language = new lang;

// Register Template
$tpl = new Smarty_PDS;

// Register Language Class to Template
$tpl-> register_object(lang,$language,null,false);
$tpl-> assign('lang_set',$lang_set);

//Check cronjob
$r_cron = mysql_query("SELECT * FROM $pds_cronjob WHERE TO_DAYS(last_run) < TO_DAYS(NOW()) OR last_run IS NULL;");
if(mysql_num_rows($r_cron) > 0){
	include("cronjob.php");
}
    //print_r($_SESSION);
    //echo "REF-".$_SERVER['HTTP_REFERER'];
    //..changes added by inforeshaODC TM 11-12-2010
    //..for auto login from elgg
    //..check particular elgg user from the uri and add it to session
    //$temp = explode("/", $_SERVER['HTTP_REFERER']);
    //$CurrentUserID=$temp[(count($temp))-1];
    $CurrentUserID=$Global_member['id']; //get_loggedin_userid();
	//echo "session-userid=".$_SESSION['userid'];
	//echo "| CurrentUserID=".$CurrentUserID;
	//print_r($_SESSION);
    
    if((isset($_SESSION)) && ($_SESSION['userid']>0) && ((isset($CurrentUserID))&&($_SESSION['userid'] == $CurrentUserID)))
    {
      //..session is alreday set and is correctly pointing to the user
     // echo "IM IN _SESSION['userid']=".$_SESSION['userid']." --CurrentUserID=$CurrentUserID";
      //exit;
    }
    else
    {
      //echo "IM OUT _SESSION['userid']=".$_SESSION['userid']." --CurrentUserID=$CurrentUserID";
      //exit;

      if($CurrentUserID >0)
      {
        $r_user = mysql_query("SELECT * FROM $pds_user WHERE id=$CurrentUserID");
    	$user_rows = mysql_num_rows($r_user);

    	if ($user_rows > 0){

            //..unset the session if still there
            if (isset($_SESSION['userid']))
                unset($_SESSION['userid']);
            if (isset($_SESSION['userpass']))
                unset($_SESSION['userpass']);
            if (isset($_SESSION['userip']))
                unset($_SESSION['userip']);
            setcookie("validate");

    		// User found so set session
    		$f_user = mysql_fetch_assoc($r_user);
    		$_SESSION['userid'] = $f_user['id'];
    		$_SESSION['userpass'] = $f_user['pass'];
    		$_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];
    		// Drop a cookie for secondary validation
    		setcookie("validate", md5($f_user['login']));
    		//header("Location: $config[mainurl]/user.php");
    		//exit;
    	} else{
    		// Bad login
    		$notice = $language->desc('user',$lang_set,'bad_login');
    		$tpl-> assign('show_login', true);
    	}
      }
    }



//***********************************************
// Site/Admin Menu
//***********************************************

// If admin logged in then show admin logout link 
if ( isset($_SESSION['admin_login']) ){
	$admin_out = "&nbsp;(<a href=admin.php?act=out>".$language->desc('adminmenu',$lang_set,'logout')."</a>)";
	//get unread messages
	$amsg = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM $pds_amailbox WHERE msg_read!='1';"));
	$amsgcount = $amsg[0];
	$tpl-> assign('amsgcount',$amsgcount);
}else{
	$admin_out = "";
}
// Assign $admin_out
$tpl-> assign('admin_out',$admin_out);

// If user logged in then show user logout link
if ( isset($_SESSION['userid']) ){
    $user_out = "&nbsp";
	//$user_out = "&nbsp;(<a href=user.php?act=out>".$language->desc('sitemenu',$lang_set,'logout')."</a>)";
}else{
	$user_out = "";
}
// Assign $user_out
//include ("categories.php");


//...get allowed to post or not
//...sangram..
@getMeUsrCurrStatus($elgg_user_acct_type,$elgg_user_allow_to_post,$elgg_user_subscription_id,$elgg_remaining_itm_to_post,$tpl);


//**** NEWLY ADDED at 31-dec-11 by inforesha.shridhar
// Translations
include ("classes/translations.php");
 
$tpl-> assign('user_out',$user_out);
$tpl-> assign('elgg_current_user', $curr_user);
$tpl-> assign('elgg_user_acct_type',$elgg_user_acct_type);
$tpl-> assign('elgg_chk_gold_user', $elgg_chk_gold_user);
$tpl-> assign('elgg_is_admin_user', $elgg_is_admin_user);
$tpl-> assign('elgg_main_url',$elgg_main_url);
$tpl-> assign('elgg_site_url',$elgg_site_url);
$tpl-> assign('elgg_small_icon_url',$elgg_small_icon_url);
$tpl-> assign('elgg_graphics_url',$elgg_graphics_url);
$tpl-> assign('elgg_graphics_small_icon_url',$elgg_graphics_small_icon_url);

$tpl-> assign('isMobile',$isMobile);

$tpl-> assign('facebk_app_id',facebk_app_id);
$tpl-> assign('isFBConnected',$isFBConnected);

$tpl-> assign('elgg_window_height',$elgg_window_height);
$tpl-> assign('elgg_window_width',$elgg_window_width);
$tpl-> assign('elgg_curr_user_name',$elgg_curr_user_name);
$tpl-> assign('elgg_curr_user_mail',$elgg_curr_user_mail);

$tpl-> assign('website',$website);
$tpl-> assign('webtitle',$webtitle);
$tpl-> assign('Global_member',$Global_member);
$tpl-> assign('sesslife',$sesslife);

$tpl-> assign('vs_user_limit',$vs_user_limit);
$tpl-> assign('vs_user_profile_list_id',$vs_user_profile_list_id);
$tpl-> assign('vs_user_prof_state_id',$vs_user_prof_loc['stateid']);
$tpl-> assign('vs_user_prof_metro_area',$vs_user_prof_loc['metroareaid']);
$tpl-> assign('vs_user_prof_country',$vs_user_prof_loc['countryid']);

$tpl-> assign('vs_user_prof_state_list',GetStatesByCountry($vs_user_prof_loc['countryid']));
$tpl-> assign('vs_user_prof_metro_area_list',GetMetroAreaByState($vs_user_prof_loc['stateid']));
$site_color['blue'] = ELGG_BLUE;
$site_color['green'] = ELGG_GREEN;
$site_color['orange'] = ELGG_ORANGE;
$tpl-> assign('site_color',$site_color);

?>