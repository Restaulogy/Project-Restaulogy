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
	
	include("../../init.php");
	require('php-captcha.inc.php');
	$aFonts = array('fonts/AHGBold.ttf', 'fonts/Vera.ttf', 'fonts/VeraBd.ttf', 'fonts/VeraBI.ttf', 'fonts/VeraMoIt.ttf');
	$oVisualCaptcha = new PhpCaptcha($aFonts, 200, 60);
	$oVisualCaptcha->Create();

?>