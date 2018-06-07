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
  include("header.php");
  
  /* Show this page only if the user verification is enabled by the admin. Otherwise, show
  the page not found error. */
  if($user_verification == 1)
  {
	subheader($_lang['email_verification']);
  }
  else
  {
	subheader($_lang['global_error']);
  }
  
if($user_verification == 1)
{
  if($sesslife == false)
  {
	if(isset($_GET['k']))
	{
		$key = mysql_real_escape_string($_GET['k']);
			if($key != "")
			{
				$q = mysql_query("SELECT * FROM `members` WHERE(`key`='{$key}') ORDER BY `id` DESC LIMIT 1") or die(mysql_error());
				$n = mysql_num_rows($q);
					if($n)
					{
						$f = mysql_fetch_array($q);
						$verify = $f['verified'];
							if($verify == 0)
							{
								$update = mysql_query("UPDATE `members` SET `verified`=1 WHERE(`key`='{$key}') LIMIT 1") or die(mysql_error());
								echo "<div class=\"infobox\">{$_lang['email_verified']}<br/><small><a href=\"{$website}/user/login.php\">{$_lang['click_here']}</a> {$_lang['to_login']}</small></div>";
							}
							else
							{
								echo "<div class=\"errorbox\">{$_lang['account_active']}<br/><small><a href=\"{$website}/user/login.php\">{$_lang['click_here']}</a> {$_lang['to_login']}</small></div>";
							}
					}
					else
					{
						echo "<div class=\"errorbox\">{$_lang['verification_invalid']}<br/><small>{$_lang['contact_admin']}</div>";
					}
			}
			else
			{
				echo "<div class=\"errorbox\">{$_lang['invalid_link']}<br/><small>{$_lang['contact_admin']}</small></div>";
			}
	}
	else
	{
		echo "<div class=\"errorbox\">{$_lang['invalid_link']}<br/><small>{$_lang['contact_admin']}</small></div>";
	} 
  }
  else
  {
	echo "<div class=\"errorbox\">{$_lang['active_session']}<br/><small>{$_lang['already_logged_in']}</small></div>";
  }
}
else
{
	echo "<div class=\"errorbox\">{$_lang['invalid_link']}<br/><small>{$_lang['contact_admin']}</small></div>";
}

include("footer.php");

?>