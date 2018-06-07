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
if ( !$vs_current_admin['login'] ){
	//no admin logged in
	header("Location: $config[mainurl]/admin.php");
	exit;
}

set_time_limit(0);

$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('import',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('import',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";


if ($_POST['delim'] != ""){
	$delim = $_POST['delim'];
}else{
	$delim = ",";
}


//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************
if(isset($_POST['btn_import'])){
	$import_type = $_POST['import_type'];
	if($_POST['import_file'] != ""){
		$import_file = $_POST['import_file'];
		$file_check = $config['root'].$_POST['import_file'];
		if ( !is_readable($file_check) ){
			$notice .= $language->desc('import',$lang_set,'error_bad_file')."<br>";
		}
	}else{
		$notice .= $language->desc('import',$lang_set,'error_no_file')."<br>";
	}
	$import_action = $_POST['import_action'];
	//Listing order
	$user_num = $_POST['order_user'];
	$firm_num = $_POST['order_firm'];
	$addr_num = $_POST['order_addr'];
	$zipcode_num = $_POST['order_zipcode'];
	$loc_num = $_POST['order_locsel'];
	$loc1_num = $_POST['order_loc1'];
	$desc_num = $_POST['order_desc'];
	$contact_num = $_POST['order_contact'];
	$phone_num = $_POST['order_phone'];
	$fax_num = $_POST['order_fax'];
	$mobile_num = $_POST['order_mobile'];
	$email_num = $_POST['order_email'];
	$web_num = $_POST['order_web'];
	$state_num = $_POST['order_state'];
	$level_num = $_POST['order_level'];
	$xtra1_num = $_POST['order_xtra1'];
	$xtra2_num = $_POST['order_xtra2'];
	$xtra3_num = $_POST['order_xtra3'];
	$xtra4_num = $_POST['order_xtra4'];
	$xtra5_num = $_POST['order_xtra5'];
	$xtra6_num = $_POST['order_xtra6'];
	$prem_num = $_POST['order_prem'];
	$cat_num = $_POST['order_cat'];
	
	//Zipcode order
	$zip_num = $_POST['order_zip'];
	$prim_num = $_POST['order_loc_prim'];
	$sec_num = $_POST['order_loc_sec'];
	$lat_num = $_POST['order_lat'];
	$lon_num = $_POST['order_lon'];

	//Listing order index
	$user_num2 = $_POST['order_user'] - 1;
	$firm_num2 = $_POST['order_firm'] - 1;
	$addr_num2 = $_POST['order_addr'] - 1;
	$zipcode_num2 = $_POST['order_zipcode'] - 1;
	$loc_num2 = $_POST['order_locsel'] - 1;
	$loc1_num2 = $_POST['order_loc1'] - 1;
	$desc_num2 = $_POST['order_desc'] - 1;
	$contact_num2 = $_POST['order_contact'] - 1;
	$phone_num2 = $_POST['order_phone'] - 1;
	$fax_num2 = $_POST['order_fax'] - 1;
	$mobile_num2 = $_POST['order_mobile'] - 1;
	$email_num2 = $_POST['order_email'] - 1;
	$web_num2 = $_POST['order_web'] - 1;
	$state_num2 = $_POST['order_state'] - 1;
	$level_num2 = $_POST['order_level'] - 1;
	$xtra1_num2 = $_POST['order_xtra1'] - 1;
	$xtra2_num2 = $_POST['order_xtra2'] - 1;
	$xtra3_num2 = $_POST['order_xtra3'] - 1;
	$xtra4_num2 = $_POST['order_xtra4'] - 1;
	$xtra5_num2 = $_POST['order_xtra5'] - 1;
	$xtra6_num2 = $_POST['order_xtra6'] - 1;
	$prem_num2 = $_POST['order_prem'] - 1;
	$cat_num2 = $_POST['order_cat'] - 1;
	
	//Zipcode order index
	$zip_num2 = $_POST['order_zip'] - 1;
	$prim_num2 = $_POST['order_loc_prim'] - 1;
	$sec_num2 = $_POST['order_loc_sec'] - 1;
	$lat_num2 = $_POST['order_lat'] - 1;
	$lon_num2 = $_POST['order_lon'] - 1;
}
//***********************************************
// Import Logic
//***********************************************

if($import_type == "list"){
	//Importing listings
	if(!$user_num OR !$firm_num){
		$notice .= $language->desc('import',$lang_set,'error_bad_order')."<br>";
	}
	if ($notice == ""){
		//No errors start processing
		if($import_action == "new"){
			//Drop original table and create a new one
			mysql_query("TRUNCATE $pds_listcat");
			mysql_query("TRUNCATE $pds_list;");
			mysql_query("TRUNCATE $pds_liststats;");
			$notice .= $language->desc('import',$lang_set,'empty_table')."<br>";
		}
		$count = 0;
		$handle = fopen($file_check,"r");
		while (($data = fgetcsv($handle, 1000, $delim)) !== false) {
			$count = $count + 1;
			$user = $data[$user_num2];
			$firm = $data[$firm_num2];
			$addr = ($addr_num > 0) ? $data[$addr_num2] : '';
			$zipcode = $data[$zipcode_num2];
			$loc = ($loc_num > 0) ? $data[$loc_num2] : '';
			$loc1 = ($loc1_num > 0) ? $data[$loc1_num2] : '';
			$desc = ($desc_num > 0) ? $data[$desc_num2] : '';
			$contact = ($contact_num > 0) ? $data[$contact_num2] : '';
			$phone = ($phone_num > 0) ? $data[$phone_num2] : '';
			$fax = ($fax_num > 0) ? $data[$fax_num2] : '';
			$mobile = ($mobile_num > 0) ? $data[$mobile_num2] : '';
			$email = ($email_num > 0) ? $data[$email_num2] : '';
			$web = ($web_num > 0) ? $data[$web_num2] : '';
			$state = ($state_num > 0) ? $data[$state_num2] : '';
			$level = ($level_num > 0) ? $data[$leve1_num2] : '';
			$xtra1 = ($xtra1_num > 0) ? $data[$xtra1_num2] : '';
			$xtra2 = ($xtra2_num > 0) ? $data[$xtra2_num2] : '';
			$xtra3 = ($xtra3_num > 0) ? $data[$xtra3_num2] : '';
			$xtra4 = ($xtra4_num > 0) ? $data[$xtra4_num2] : '';
			$xtra5 = ($xtra5_num > 0) ? $data[$xtra5_num2] : '';
			$xtra6 = ($xtra6_num > 0) ? $data[$xtra6_num2] : '';
			$prem = ($prem_num > 0) ? $data[$prem_num2] : '';
			$cat = ($cat_num > 0) ? explode(":",$data[$cat_num2]) : '';
			
			if($state == ""){$state='sub';}
			if($level == ""){$level=$config['free_level'];}
			
			//Add Record
			mysql_query("INSERT INTO $pds_list (userid, firm, address1, zip, loc_sel, loc1, description, contact, phone, fax, mobile, email, website, state, level, xtra_1, xtra_2, xtra_3, xtra_4, xtra_5, xtra_6, premium) 
				VALUES ('$user', '$firm', '$addr', '$zipcode', '$loc', '$loc1', '$desc', '$contact', '$phone', '$fax', '$mobile', '$email', '$web', '$state', '$level', '$xtra1', '$xtra2', '$xtra3', '$xtra4', '$xtra5', '$xtra6', '$prem');") or die(mysql_error());
			$insert_id = mysql_insert_id();
			
			//Add stats
			mysql_query("INSERT INTO $pds_liststats (list_id) VALUES ($insert_id)");

			//Add categories
			if( is_array($cat) ){
				for($x=0;$x<count($cat);$x++){
					$cat_id = $cat[$x];
					mysql_query("INSERT INTO $pds_listcat (list_id, cat_id) VALUES ('$insert_id', '$cat_id');");
					if($state == "apr"){
						TurnCatOn($cat_id);
					}
				}
			}
		}
		if($count > 0){
			$notice .= $language->desc('import',$lang_set,'data_done')."<br>";
		}else{
			$notice .= $language->desc('import',$lang_set,'error_no_data')."<br>";
		}
	}	
}elseif($import_type == "zip"){
	//Importing zipcode list
	if(!$zip_num OR !$prim_num OR !$lat_num OR !$lon_num){
		$notice .= $language->desc('import',$lang_set,'error_bad_order')."<br>";
	}
	if ($pds_locrelate == ""){
		$notice .= $language->desc('import',$lang_set,'error_no_table')."<br>";
	}
	if ($notice == ""){
		//No errors start processing
		if($import_action == "new"){
			//Drop original table and create a new one
			mysql_query("TRUNCATE $pds_locrelate;");
			$notice .= $language->desc('import',$lang_set,'empty_table')."<br>";
		}
		$count = 0;
		$handle = fopen($file_check,"r");
		while (($data = fgetcsv($handle, 1000, $delim)) !== false) {
			$count = $count + 1;
			$zip = $data[$zip_num2];
			$loc_prim = ucwords( strtolower($data[$prim_num2]) );
			$loc_sec = ($sec_num > 0) ? ucwords( strtolower($data[$sec_num2]) ) : '';
			$lat = $data[$lat_num2];
			$lon = $data[$lon_num2];
			//Check for existing record
			if($import_action == "update"){
				$f_check = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM $pds_locrelate WHERE zip='$zip';"));
				if($f_check[0] > 0){
					//Record exists... so update it
					mysql_query("UPDATE $pds_locrelate SET loc_prim='$loc_prim', loc_sec='$loc_sec', lat='$lat', lon='$lon' WHERE zip='$zip';");
				}else{
					//Record does not exist... so add it
					mysql_query("INSERT INTO $pds_locrelate VALUES ('$zip', '$loc_prim', '$loc_sec', '$lat', '$lon');") or die(mysql_error());
				}
			}else{
				//Add record
				mysql_query("INSERT INTO $pds_locrelate VALUES ('$zip', '$loc_prim', '$loc_sec', '$lat', '$lon');") or die(mysql_error());
			}
		}
		if($count > 0){
			$notice .= $language->desc('import',$lang_set,'data_done')."<br>";
		}else{
			$notice .= $language->desc('import',$lang_set,'error_no_data')."<br>";
		}
	}
}

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('notice',$notice);
$tpl-> assign('show_page','import');
$tpl-> assign('zip_num',$zip_num);
$tpl-> assign('sec_num',$sec_num);
$tpl-> assign('prim_num',$prim_num);
$tpl-> assign('lat_num',$lat_num);
$tpl-> assign('lon_num',$lon_num);
$tpl-> assign('import_type',$import_type);
$tpl-> assign('import_action',$import_action);
$tpl-> assign('import_file',$import_file);
$tpl-> assign('delim',$delim);
$tpl-> assign('user_num',$user_num);
$tpl-> assign('firm_num',$firm_num);
$tpl-> assign('addr_num',$addr_num);
$tpl-> assign('zipcode_num',$zipcode_num);
$tpl-> assign('loc_num',$loc_num);
$tpl-> assign('loc1_num',$loc1_num);
$tpl-> assign('desc_num',$desc_num);
$tpl-> assign('contact_num',$contact_num);
$tpl-> assign('phone_num',$phone_num);
$tpl-> assign('fax_num',$fax_num);
$tpl-> assign('mobile_num',$mobile_num);
$tpl-> assign('state_num',$state_num);
$tpl-> assign('level_num',$level_num);
$tpl-> assign('email_num',$email_num);
$tpl-> assign('web_num',$web_num);
$tpl-> assign('xtra1_num',$xtra1_num);
$tpl-> assign('xtra2_num',$xtra2_num);
$tpl-> assign('xtra3_num',$xtra3_num);
$tpl-> assign('xtra4_num',$xtra4_num);
$tpl-> assign('xtra5_num',$xtra5_num);
$tpl-> assign('xtra6_num',$xtra6_num);
$tpl-> assign('prem_num',$prem_num);
$tpl-> assign('cat_num',$cat_num);

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/import.tpl");

?>