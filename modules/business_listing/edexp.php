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

if ( !$vs_current_admin[login] ){
	//no admin logged in
	header("Location: $config[mainurl]/admin.php");
	exit;
}

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('edexp',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('edexp',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";
$exp_id = $_POST['exp_pd'];
$title = $_POST['title'];
$days = $_POST['days'];

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************

if ( isset($_POST['new']) )
{
	$page = 'add';
}
elseif ( isset($_POST['change']) )
{
	if ($exp_id == "")
	{
		$notice = $language->desc('edexp', $lang_set, 'error_exp');
	}
	if ($notice == "")
	{
		$page = 'change';
	}
}
elseif ( isset($_POST['delete']) )
{
	if ($exp_id == "")
	{
		$notice = $language->desc('edexp', $lang_set, 'error_exp');
	}
	if ($notice == "")
	{
		$page = 'confirm';
	}
}
elseif ( isset($_POST['add_exp']) )
{

 	if ($title == ""){
		$notice = $language->desc('edexp', $lang_set, 'error_title')."<br>";
		$page = 'add';
	}
	if ($days == ""){
		$notice = $language->desc('edexp', $lang_set, 'error_days');
		$page = 'add';
	}
	if ($notice == ""){
	//Add expiration
		mysql_query ("INSERT INTO $pds_exp (title, days) 
			VALUES ('$title', '$days');") or die(mysql_error());
		$insert_id = mysql_insert_id();
		$language->slave('exp_pd', $insert_id, $_POST['title']);
		buildVSlist();
		$notice .= $language->desc('edexp', $lang_set, 'exp_added');
	}

}
elseif ( isset($_POST['change_exp']) )
{
	$chg_exp = $_POST[chg_exp];
	if ($title == ""){
		$notice = $language->desc('edexp', $lang_set, 'error_title')."<br>";
	}
	if ($days == ""){
		$notice = $language->desc('edexp', $lang_set, 'error_days');
	}
	if ($notice == ""){
	//Change expiration
		mysql_query ("UPDATE $pds_exp SET 
			title='$title', 
			days='$days' 
				WHERE id='$chg_exp';") or die(mysql_error());
		$language->slave('exp_pd', $chg_exp, $title);
		buildVSlist();
		$notice .= $language->desc('edexp', $lang_set, 'exp_changed');
	}
}
elseif ( isset($_POST['delete_confirm']) )
{
	$del_exp = $_POST[del_exp];
	// Delete Selected expiration
	mysql_query ("DELETE FROM $pds_exp WHERE id='$del_exp';");
		
	//Deprecated in language table
	$language->put("exp_pd", $language->native, $del_exp, $title, $del_exp, "d");
	buildVSlist();
	$notice .= $language->desc('edexp', $lang_set, 'exp_deleted');
}

//***********************************************
// Assign local variables to template
//***********************************************

$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('show_page','edexp');
$tpl-> assign('page',$page);
$tpl-> assign('notice',$notice);
$tpl-> assign('exp_pd',$exp_id);


//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/edexp.tpl");

 function buildVSlist(){

	global $pds_exp;
	global $tpl;

$r = mysql_query("SELECT * FROM $pds_exp");
$rows = mysql_num_rows($r);
for ($x=0;$x<$rows;$x++){
	$f = mysql_fetch_assoc($r);
	$id = $f[id];
	$vs_expire_ct[$x] = $id;
	foreach($f as $key => $value){
		$vs_expire[$id][$key] = $value;
	}
}
mysql_free_result($r);

$tpl-> assign('vs_expire_ct',$vs_expire_ct);
$tpl-> assign('vs_expire',$vs_expire);

}

?>
