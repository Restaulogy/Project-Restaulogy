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
// Variable Set - Current User
//***********************************************

if ( isset($_SESSION['userid']) ){
	$r = mysql_query("SELECT * FROM $pds_user WHERE id='$_SESSION[userid]' and pass='$_SESSION[userpass]';");
	if ( mysql_num_rows($r) == 1){
		$vs_current_user = mysql_fetch_assoc($r);
		if ($_SESSION[userip] == $_SERVER['REMOTE_ADDR']){
			$tpl-> assign('vs_current_user',$vs_current_user);
		}elseif($_COOKIE['validate'] == md5($vs_current_user['login'])){
			$tpl-> assign('vs_current_user',$vs_current_user);
  /*	if ($vs_current_user == $_SESSION['guid']){
                $elgg_user_acct_type = getMeAcntType($_SESSION['guid']);
             }else{
               $elgg_user_acct_type  = "" ;
             }
              $tpl-> assign('elgg_user_acct_type',$elgg_user_acct_type); 
         */

             // $tpl-> assign('elgg_user_acct_type',"business");
              //$tpl-> assign('vs_user_limit', 1);
           //  $tpl-> assign('elgg_user_acct_type',chkIfUsrIsBiz());
           //   $tpl-> assign('vs_user_limit', chkuserlimit());
		}else{
			//stolen session
			unset($vs_current_user);
			unset($_SESSION['userid']);
		}
	}elseif ( mysql_num_rows($r) > 1 ){
		//duplicate users found
	}else{
		//user not found
	}
	mysql_free_result($r);
}

?>
