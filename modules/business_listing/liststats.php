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
// Include Modules
//***********************************************
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('liststats',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('liststats',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Verify User
//***********************************************
if ( $vs_current_user[id] == $vs_current_listing[userid] ){
	// This is the user
	
}else{
	//This is not the user
	header("location:user.php");
	exit;
}

//***********************************************
// Button Press Logic
//***********************************************

//***********************************************
// Code
//***********************************************

$r_stat = mysql_query("SELECT * FROM $pds_liststats WHERE list_id='$vs_current_listing[id]'") or die(mysql_error());
if(mysql_num_rows($r_stat) > 0){
	$list_stat = mysql_fetch_assoc($r_stat);
}else{
	$list_stat[sub_views] = 0;
	$list_stat[page_views] = 0;
}

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('list_stat',$list_stat);
$tpl-> assign('show_page','liststats');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/liststats.tpl");

?>