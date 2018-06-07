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
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('edlevel',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('edlevel',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

$mem_level = $_POST['mem_level'];
$title = $_POST['title'];
$cost = $_POST['cost'];
$expire = $_POST['expire'];
$expire_period = $_POST['exp_pd'];
$description = $_POST['description'];
$website = $_POST['website'];
$address = $_POST['address'];
$loc1 = $_POST['loc1'];
$zip = $_POST['zip'];
$contact = $_POST['contact'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$mobile = $_POST['mobile'];
$listmail = $_POST['listmail'];
$premium = $_POST['premium'];
$cats = $_POST['cats'];
$logo = $_POST['logo'];
$xtra_1 = ( isset($_POST['xtra_1']) ) ? $_POST['xtra_1'] : 0;
$xtra_2 = ( isset($_POST['xtra_2']) ) ? $_POST['xtra_2'] : 0;
$xtra_3 = ( isset($_POST['xtra_3']) ) ? $_POST['xtra_3'] : 0;
$xtra_4 = ( isset($_POST['xtra_4']) ) ? $_POST['xtra_4'] : 0;
$xtra_5 = ( isset($_POST['xtra_5']) ) ? $_POST['xtra_5'] : 0;
$xtra_6 = ( isset($_POST['xtra_6']) ) ? $_POST['xtra_6'] : 0;
$custom_1 = ( isset($_POST['custom_1']) ) ? $_POST['custom_1'] : 0;
$custom_2 = ( isset($_POST['custom_2']) ) ? $_POST['custom_2'] : 0;
$custom_3 = ( isset($_POST['custom_3']) ) ? $_POST['custom_3'] : 0;
$custom_4 = ( isset($_POST['custom_4']) ) ? $_POST['custom_4'] : 0;
$custom_5 = ( isset($_POST['custom_5']) ) ? $_POST['custom_5'] : 0;
$custom_6 = ( isset($_POST['custom_6']) ) ? $_POST['custom_6'] : 0;

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************

if ( !$vs_current_admin[login] ){
	//no admin logged in
	header("Location: $config[mainurl]/admin.php");
	exit;
}

if ( isset($_POST['new']) ){
	$mem_level = 0;
	$page = 'add';
}elseif ( isset($_POST['change']) ){
	if ($mem_level == ""){
		$notice = $language->desc('edlevel', $lang_set, 'error_level');
	}
	if ($notice == ""){
		$prop_sel_exp = array('value'=>$vs_level[$mem_level][expire_period]);
		$page = 'change';
	}
}elseif ( isset($_POST['delete']) ){
	if ($mem_level == ""){
		$notice = $language->desc('edlevel', $lang_set, 'error_level');
	}
	if ($notice == ""){
		$page = 'confirm';
	}
}elseif ( isset($_POST['add_level']) ){
	//Add level
	if ($title == ""){
		$notice = $language->desc('edlevel', $lang_set, 'error_title');
		$page = 'add';
	}
	if ($notice == ""){
		//No Errors
		mysql_query ("INSERT INTO $pds_level (title, cost, expire, expire_period, description, website, addr1, loc1, zip, contact, phone, fax, mobile, listmail, cats, logo, premium, xtra_1, xtra_2, xtra_3, xtra_4, xtra_5, xtra_6, custom_1, custom_2, custom_3, custom_4, custom_5, custom_6) 
			VALUES ('$title', '$cost', '$expire', '$expire_period', '$description', '$website', '$address', '$loc1', '$zip', '$contact', '$phone', '$fax', '$mobile', '$listmail', '$cats', '$logo', '$premium', '$xtra_1', '$xtra_2', '$xtra_3', '$xtra_4', '$xtra_5', '$xtra_6', '$custom_1', '$custom_2', '$custom_3', '$custom_4', '$custom_5', '$custom_6');") or die(mysql_error());
		$insert_id = mysql_insert_id();
		$language->slave('mem_level', $insert_id, $_POST['title']);
		buildVSlist();
		$notice .= $language->desc('edlevel', $lang_set, 'level_added');
	}

}elseif ( isset($_POST['change_level']) ){
	// Change Record
	$chg_level = $_POST[chg_level];
	if ($title == ""){
		$notice .= $language->desc('edlevel', $lang_set, 'error_title');
	}
	if ($notice == ""){
		//No Errors
		mysql_query ("UPDATE $pds_level SET 
			title='$title', 
			cost='$cost', 
			expire='$expire', 
			expire_period='$expire_period', 
			description='$description', 
			website='$website', 
			addr1='$address', 
			loc1='$loc1', 
			zip='$zip', 
			contact='$contact', 
			phone='$phone', 
			fax='$fax', 
			mobile='$mobile', 
			listmail='$listmail', 
			cats='$cats', 
			logo='$logo', 
			premium='$premium', 
			xtra_1='$xtra_1', 
			xtra_2='$xtra_2', 
			xtra_3='$xtra_3', 
			xtra_4='$xtra_4', 
			xtra_5='$xtra_5', 
			xtra_6='$xtra_6',
			custom_1='$custom_1',
			custom_2='$custom_2',
			custom_3='$custom_3',
			custom_4='$custom_4',
			custom_5='$custom_5',
			custom_6='$custom_6'
				WHERE level='$chg_level';") or die(mysql_error());
		$language->slave('level', $chg_level, $title);

		//Rebuild variable set
		buildVSlist();

		$notice .= $language->desc('edlevel', $lang_set, 'level_changed');
	}

}elseif ( isset($_POST['delete_confirm']) ){
	// Delete Selected level
	$del_level = $_POST[del_level];
	mysql_query ("DELETE FROM $pds_level WHERE level='$del_level';");
		
	//Deprecated in language table
	$language->put("mem_level", $language->native, $del_level, $title, $del_level, "d");

	//Rebuild variable set
	buildVSlist();
	
	$notice .= $language->desc('edlevel', $lang_set, 'level_deleted');
}

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('page',$page);
$tpl-> assign('notice',$notice);
$tpl-> assign('show_page','edlevel');
$tpl-> assign('prop_sel_exp',$prop_sel_exp);
$tpl-> assign('level_id',$mem_level);

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/edlevel.tpl");

function buildVSlist(){

	global $pds_level;
	global $pds_exp;
	global $tpl;

	$r = mysql_query("SELECT * FROM $pds_level") or die( mysql_error() );
	$rows = mysql_num_rows($r);
	for ($x=0;$x<$rows;$x++){
		$f = mysql_fetch_assoc($r);
		$ra = mysql_query("SELECT * FROM $pds_exp WHERE id='$f[expire_period]';");
		$fa = mysql_fetch_assoc($ra);
		$id = $f[level];
		$vs_level_ct[$x] = $id;
		$vs_level[$id][exp_title] = $fa[title];
		$vs_level[$id][exp_days] = $fa[days];
		foreach($f as $key => $value){
			$vs_level[$id][$key] = $value;
		}
		mysql_free_result($ra);
	}
	mysql_free_result($r);
	
	$tpl-> assign('vs_level',$vs_level);
	$tpl-> assign('vs_level_ct',$vs_level_ct);

}
?>