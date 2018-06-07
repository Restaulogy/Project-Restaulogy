<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
//include_once('header.php');

/*$pg_to_show = get_input('pg_to_show','login');
$post_message = get_input('post_message',"");
$post_type = get_input('post_type',"river");
$post_id = get_input('post_id',"");*/

require_once(dirname(dirname(__FILE__)).'/Facebook/HttpClients/FacebookHttpable.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/HttpClients/FacebookCurl.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/HttpClients/FacebookCurlHttpClient.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/Entities/AccessToken.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/Entities/SignedRequest.php');

require_once(dirname(dirname(__FILE__)).'/Facebook/FacebookSession.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/FacebookRedirectLoginHelper.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/FacebookRequest.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/FacebookResponse.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/FacebookSDKException.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/FacebookRequestException.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/FacebookOtherException.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/FacebookAuthorizationException.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/GraphObject.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/GraphSessionInfo.php');
require_once(dirname(dirname(__FILE__)).'/Facebook/GraphUser.php');

use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;

use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;
use Facebook\GraphUser;
 
// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication('689014577831141','e986f1b2c235535c3e88cd54bfebfd02');
 
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( 'http://restaulogy.com/test_restaurent_manager/user/fb_login_script.php' );
 
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
	print_r($ex);
} catch( Exception $ex ) {
  // When validation fails or other local issues
	print_r($ex);
}


 
// see if we have a session
if (isset($session)) {
	// save the session
  $_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
  $session = new FacebookSession( $session->getToken() );
	
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  
  // print data
  echo print_r($graphObject, 1);
	echo "<br> Name: ".$graphObject->getProperty('first_name').",".$graphObject->getProperty('last_name')." and Email: ".$graphObject->getProperty('email');
	
} else {
  // show login url
  echo '<a href="' . $helper->getLoginUrl(array('email','public_profile')). '">Login</a>';
}

print_r($_SESSION);
?>