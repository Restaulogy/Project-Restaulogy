<?php
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
include ("classes/inputfilter.php");

$filter = new inputFilter($allow_tags,$allow_attr);


//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

global $CONFIG;
 

function chkIfBusUsrProfListing($cur_user_id,$cur_lst_id){

    $myAcntType=getMeAcntType($cur_user_id);
    if (($myAcntType=="business")||($myAcntType=="social/business organization")){
        $query = "SELECT id FROM pds_list WHERE userid=$cur_user_id order by id asc";
        $result = mysql_query($query);
        if (!($result)) return 0;
        $my_lst_id=mysql_result($result, 0);

        if($my_lst_id==$cur_lst_id)
            return 1;
        else
            return 0;
    }
}

//..Function to update the elgg business profile for business user only
function updateElggBusinessProfile($cur_user_id,$cur_lst_id,$new_location,$new_description,$new_website,$new_user_state,$new_user_zip,$new_mobile,$new_phone,$new_briefdescription,$new_my_paypal_id,$new_buss_prod_services,$new_user_address,$new_user_fax,$new_user_country,$onlyProfileIcon=false){
    global $_FILES;
    //echo "hello there";
    //exit;
    $myAcntType=getMeAcntType($cur_user_id);
    if (($myAcntType=="business")||($myAcntType=="social/business organization")){
        $query = "SELECT id FROM pds_list WHERE userid=$cur_user_id order by id asc";
        $result = mysql_query($query);
        $my_lst_id=mysql_result($result, 0);
        
        //echo "my_lst_id=$my_lst_id";
        if($my_lst_id==$cur_lst_id){
            $user =get_user($cur_user_id);
            if ($user->canEdit()) {
                if ($onlyProfileIcon==false){
                    //..save user profile..
                    remove_metadata($user->guid, 'location');
            		create_metadata($user->guid, 'location', $new_location, 'text', $user->guid, 1);
            		remove_metadata($user->guid, 'description');
            		create_metadata($user->guid, 'description', $new_description, 'text', $user->guid, 1);
            		remove_metadata($user->guid, 'website');
            		create_metadata($user->guid, 'website', $new_website, 'text', $user->guid, 1);

                    if($new_user_country=="IN")
                        $new_user_country="India";
                    else
                        $new_user_country="United States";
                        
                    remove_metadata($user->guid, 'user_country');
            		create_metadata($user->guid, 'user_country', $new_user_country, 'text', $user->guid, 1);
            		
                    remove_metadata($user->guid, 'user_state');
            		create_metadata($user->guid, 'user_state', $new_user_state, 'text', $user->guid, 1);
            		
            		remove_metadata($user->guid, 'user_zip');
            		create_metadata($user->guid, 'user_zip', $new_user_zip, 'text', $user->guid, 1);
            		remove_metadata($user->guid, 'mobile');
            		create_metadata($user->guid, 'user_mobile', $new_mobile, 'text', $user->guid, 1);
            		remove_metadata($user->guid, 'phone');
            		create_metadata($user->guid, 'phone', $new_phone, 'text', $user->guid, 1);
            		remove_metadata($user->guid, 'my_paypal_id');
            		create_metadata($user->guid, 'my_paypal_id', $new_my_paypal_id, 'text', $user->guid, 1);
            		remove_metadata($user->guid, 'briefdescription');
            		create_metadata($user->guid, 'briefdescription', $new_briefdescription, 'text', $user->guid, 1);
            		
            		remove_metadata($user->guid, 'user_address');
            		create_metadata($user->guid, 'user_address', $new_user_address, 'text', $user->guid, 1);
            		
            		remove_metadata($user->guid, 'user_fax');
            		create_metadata($user->guid, 'user_fax', $new_user_fax, 'text', $user->guid, 1);
            		
            		remove_metadata($user->guid, 'user_buss_prod_services');
            		create_metadata($user->guid, 'user_buss_prod_services', $new_buss_prod_services, 'text', $user->guid, 1);

                    $user->save();
                }else{
                    //.`    save user profile icon..
                    //print_r($_FILES);
                    $topbar = get_resized_image_from_uploaded_file('logo',16,16, true);
            		$tiny = get_resized_image_from_uploaded_file('logo',25,25, true);
            		$small = get_resized_image_from_uploaded_file('logo',40,40, true);
            		$medium = get_resized_image_from_uploaded_file('logo',100,100, true);
            		$large = get_resized_image_from_uploaded_file('logo',200,200);
            		$master = get_resized_image_from_uploaded_file('logo',550,550);
                    //echo "I am out..$topbar,$tiny,$small,$medium,$large,$master";
            		if ($small !== false
            			&& $medium !== false
            			&& $large !== false
            			&& $tiny !== false) {
                        //echo "I am in..$topbar,$tiny,$small,$medium,$large,$master";
                        //exit;
            			$filehandler = new ElggFile();
            			$filehandler->owner_guid = $user->getGUID();
            			$filehandler->setFilename("profile/" . $user->username . "large.jpg");
            			$filehandler->open("write");
            			$filehandler->write($large);
            			$filehandler->close();
            			$filehandler->setFilename("profile/" . $user->username . "medium.jpg");
            			$filehandler->open("write");
            			$filehandler->write($medium);
            			$filehandler->close();
            			$filehandler->setFilename("profile/" . $user->username . "small.jpg");
            			$filehandler->open("write");
            			$filehandler->write($small);
            			$filehandler->close();
            			$filehandler->setFilename("profile/" . $user->username . "tiny.jpg");
            			$filehandler->open("write");
            			$filehandler->write($tiny);
            			$filehandler->close();
            			$filehandler->setFilename("profile/" . $user->username . "topbar.jpg");
            			$filehandler->open("write");
            			$filehandler->write($topbar);
            			$filehandler->close();
            			$filehandler->setFilename("profile/" . $user->username . "master.jpg");
            			$filehandler->open("write");
                        $filehandler->write($master);
            			$filehandler->close();

            			$user->icontime = time();

            			//system_message(elgg_echo("profile:icon:uploaded"));

            			trigger_elgg_event('profileiconupdate',$user->type,$user);

                        $to_whom_visible=get_user_acc_coll_multi_sel_name(array("Business Associates","Employee Of"));
            			//add to river
            			add_to_river('river/user/default/profileiconupdate','update',$user->guid,$user->guid,$to_whom_visible);
                    }
                }
            }
        }
    }
}



//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('edlist',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('edlist',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";
$tpl-> assign('isdelete', '0');
$tpl-> assign('operation', '');

//***********************************************
// Assign Local Variables
//***********************************************
//code for settings tab selection

if (( isset($_GET['seltab']) ) && ($_GET['seltab']>0))
{
  $seltab=$_GET['seltab'];
}else{
  $seltab=0;
}
$tpl-> assign('seltab', $seltab);

if (( isset($_GET['lid']) ) && ($_GET['lid']>0))
{
    //..for restiing the default values..
    if (( isset($_GET['reset_default']) ) && ($_GET['reset_default'] == 1))
	{
        $vs_current_listing['access_levels']=get_def_access_buss_flds();
        setProfileSettings($vs_current_listing[id],$vs_current_listing['access_levels']['fld_mail_add'],$vs_current_listing['access_levels']['fld_contact'],$vs_current_listing['access_levels']['fld_phone'],$vs_current_listing['access_levels']['fld_fax'],$vs_current_listing['access_levels']['fld_mobile'],$vs_current_listing['access_levels']['fld_email']);
        $tpl-> assign('operation', elgg_echo("profile:reset"));
    }

    //...delete Listing
    if (( isset($_GET['delete']) ) && ($_GET['delete'] == 1))
	{
        /*********************
        For pds_listcat
        **********************/
		$result = mysql_query("Select * from pds_listcat where list_id=".$_GET['lid']);
	   //	echo "pds_list_Cat=".mysql_num_rows($result);
		if (mysql_num_rows($result) > 0)
		{
	        mysql_query("Delete from pds_listcat where list_id=".$_GET['lid'])or die(mysql_error());
	 	}
	    mysql_free_result($result);
        /*********************
        For pds_liststats
        **********************/
		$result = mysql_query("Select * from pds_liststats where list_id=".$_GET['lid']);
       // echo "pds_liststats=".mysql_num_rows($result);
		if (mysql_num_rows($result) > 0)
		{
	        mysql_query("Delete from pds_liststats where list_id=".$_GET['lid'])or die(mysql_error());
	 	}
	    mysql_free_result($result);
        /*********************
        For pds_list_favorites
        **********************/

		$result = mysql_query("Select * from pds_list_favorites where list_id=".$_GET['lid']);
	//	echo "pds_list_favorites=".mysql_num_rows($result);
		if (mysql_num_rows($result) > 0)
		{
	        mysql_query("Delete from pds_list_favorites where ispromotion=0 and  list_id=".$_GET['lid'])or die(mysql_error());
		}
	    mysql_free_result($result);
        /*********************
        For pds_list_promotions
        **********************/
		
		$result = mysql_query("Select * from pds_list_promotions where list_id=".$_GET['lid']);
		//echo "pds_list_promotions=".mysql_num_rows($result);
		if (mysql_num_rows($result) > 0)
		{
	        mysql_query("Delete from pds_list_promotions where list_id=".$_GET['lid'])or die(mysql_error());
	 	}
	    mysql_free_result($result);
        /*********************
        For pds_listcat
        **********************/
		$sql= "Delete from $pds_list where id=".$_GET['lid'];
		//echo $sql;

	mysql_query($sql);
	$tpl-> assign('operation', 'Delete is Succesfull');
	$tpl-> assign('isdelete', '1');
	}
}


if ( isset($_POST['submit_flag']) ){
	//Listing values being posted from the form
 if ( $_POST['categories'] != "" ){
		$cat_array = explode(":", $_POST['categories']);
	}
	if ( count($_POST['loc']) > 0 ){
		$loc_sel = end($_POST['loc']);
	}

 	$firm = $_POST['firm'];
	$description = $_POST['description'];
	$website = $_POST['website'];
	$addr1 = $_POST['addr1'];
	$loc1 = $_POST['loc1'];
	$metro_area=$_POST['metro_area'];
	$country = $_POST['country'];
	$states = $_POST['states'];
	//echo " states=$states |";
	$zip = $_POST['zip'];
	$contact = $_POST['contact'];
	$phone = $_POST['phone'];
	$fax = $_POST['fax'];
	$mobile = $_POST['mobile'];
	$listmail = $_POST['listmail'];
	$premium = $_POST['premium'];
	$my_paypal_id = $_POST['my_paypal_id'];
	$xtra_1 = $_POST['xtra_1'];
	$xtra_2 = $_POST['xtra_2'];
	$xtra_3 = $_POST['xtra_3'];
	$xtra_4 = $_POST['xtra_4'];
	if($xtra_4==0 && $states>0)
        $xtra_4=$states;
	$xtra_5 = $_POST['xtra_5'];
	$xtra_6 = $_POST['xtra_6'];
	//...access field seetings..
	$fld_mail_add = $_POST['fld_mail_add'];
	$fld_contact = $_POST['fld_contact'];
	$fld_phone = $_POST['fld_phone'];
	$fld_fax = $_POST['fld_fax'];
	$fld_mobile = $_POST['fld_mobile'];
	$fld_email = $_POST['fld_email'];
}else{

	//Listing values filled from listing variable set
	$r_cat = mysql_query("SELECT cat_id FROM $pds_listcat WHERE list_id='$vs_current_listing[id]';");
	for($x=0;$x<mysql_num_rows($r_cat);$x++){
		$f_cat = mysql_fetch_assoc($r_cat);
		$cat_array[$x] = $f_cat['cat_id'];
		$cat_str = implode(":", $cat_array);
	}

    //$r_description = mysql_query("SELECT description FROM $pds_list WHERE list_id='$vs_current_listing[id]'");
 	//	$f_description = mysql_fetch_assoc($r_description);
	//	print_r($f_description);

	mysql_free_result($r_cat);
	$firm = $vs_current_listing['firm'];
	$description = $vs_current_listing['description'];
	$website = $vs_current_listing['website'];
	$addr1 = $vs_current_listing['address1'];
	$loc1 = $vs_current_listing['loc1'];
	$metro_area=$vs_current_listing['metro_area'];
	$country = $vs_current_listing['country'];
	$states = $vs_current_listing['states_id'];
	$zip = $vs_current_listing['zip'];
	$contact = $vs_current_listing['contact'];
	$phone = $vs_current_listing['phone'];
	$fax = $vs_current_listing['fax'];
	$mobile = $vs_current_listing['mobile'];
	$listmail = $vs_current_listing['email'];
	$premium = $vs_current_listing['premium'];
	$my_paypal_id = $vs_current_listing['my_paypal_id'];
	$xtra_1 = $vs_current_listing['xtra_1'];
	$xtra_2 = $vs_current_listing['xtra_2'];
	$xtra_3 = $vs_current_listing['xtra_3'];
	$xtra_4 = $vs_current_listing['xtra_4'];
	if($xtra_4==0 && $states>0)
        $xtra_4=$states;
 //echo "xtra_4=$xtra_4 || {$vs_current_listing['xtra_4']} || states=$states  ";
	$xtra_5 = $vs_current_listing['xtra_5'];
	$xtra_6 = $vs_current_listing['xtra_6'];
	
	//...access field seetings..
	$fld_mail_add = $vs_current_listing['access_levels']['fld_mail_add'];
	$fld_contact = $vs_current_listing['access_levels']['fld_contact'];
	$fld_phone = $vs_current_listing['access_levels']['fld_phone'];
	$fld_fax = $vs_current_listing['access_levels']['fld_fax'];
	$fld_mobile = $vs_current_listing['access_levels']['fld_mobile'];
	$fld_email = $vs_current_listing['access_levels']['fld_email'];
}
$listing_level = $vs_current_listing['level'];

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************


if ( isset($_POST['list_reg']) ){
	//Listing submitted

	// Listing level specific variables
	if ($config['auto_update'] AND $vs_current_listing['state'] == 'apr'){
		$state = "apr";
	}else{
		$state = "upd";
	}

	//Error checking
	

	if (count($cat_array) == 0 ){
		$notice .= $language->desc('error_text',$lang_set,'error_no_cat')."<br>";
	}else{
        /*
  		if((count($cat_array))>3){
            $notice .="You Cannot Select More Than 3 Categories";
		}else
        */
        if((count($cat_array))==0){
            $notice .="Please Select At least One Main Category & One Sub-Category.";
		}else{
/*
            $categroy_error = validate_category_listing(implode(",",$cat_array));
			if ((strlen(trim($categroy_error))) ==0){

   			}else{
                $notice .= $categroy_error;
	  		}
*/
  		}
 	}
	if ($firm == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_firm')."<br>";
	}
	if ($vs_level[$listing_level][description] and $required[description] and $description == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_desc')."<br>";
	}
	if ($vs_level[$listing_level][website] and $required[website] and $website == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_web')."<br>";
	}
	if ($vs_level[$listing_level][addr1] and $required[address] and $addr1 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_addr')."<br>";
	}
	/*
	if ($vs_level[$listing_level][loc1] and $required[loc1] and $loc1 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_loc1')."<br>";
	}
	*/
	if ($vs_level[$listing_level][zip] and $required[zip] and $zip == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_zip')."<br>";
	}
	if ($vs_level[$listing_level][contact] and $required[contact] and $contact == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_cont')."<br>";
	}
	if ($vs_level[$listing_level][phone] and $required[phone] and $phone == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_phone')."<br>";
	}
	if ($vs_level[$listing_level][fax] and $required[fax] and $fax == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_fax')."<br>";
	}
	if ($vs_level[$listing_level][mobile] and $required[mobile] and $mobile == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_mob')."<br>";
	}
	
	if ($vs_level[$listing_level]['listmail'] and $required['listmail']){
		if($listmail == ""){
			$notice .= $language->desc('error_text',$lang_set,'error_no_mail')."<br>";
		}elseif(!checkEmail($listmail)){
			$notice .= $language->desc('error_text',$lang_set,'error_mail_bad')."<br>";
		}
	}

/*
	if($my_paypal_id == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_mail')."<br>";
	}elseif(!checkEmail($my_paypal_id)){
		$notice .= $language->desc('error_text',$lang_set,'error_mail_bad')."<br>";
	}
*/
	if ($vs_level[$listing_level][xtra_1] and $required[xtra_1] and $xtra_1 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra1')."<br>";
	}
	if ($vs_level[$listing_level][xtra_2] and $required[xtra_2] and $xtra_2 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra2')."<br>";
	}
	if ($vs_level[$listing_level][xtra_3] and $required[xtra_3] and $xtra_3 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra3')."<br>";
	}
	if ($vs_level[$listing_level][xtra_4] and $required[xtra_4] and $xtra_4 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra4')."<br>";
	}
	if ($vs_level[$listing_level][xtra_5] and $required[xtra_5] and $xtra_5 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra5')."<br>";
	}
	if ($vs_level[$listing_level][xtra_6] and $required[xtra_6] and $xtra_6 == ""){
		$notice .= $language->desc('error_text',$lang_set,'error_no_xtra6')."<br>";
	}

	if ($notice == ""){
	//echo "dddddddddd";
		//No errors - Update Listing
		foreach($_POST as $key => $value){
			if (is_string($value)){
				$post_save[$key] = ($value);
				$_POST[$key] = mysql_real_escape_string($value);
			}
		}
		$firm = $_POST['firm'];
		$description = $_POST['description'];
		$website = $_POST['website'];
		$addr1 = $_POST['addr1'];
		$loc1 = $_POST['loc1'];
		$metro_area = $_POST['metro_area'];
	//	metro_area
		$country = $_POST['country'];
		$states = isset($_POST['states'])&&($_POST['states']>0) ? $_POST['states'] : 0;
		$zip = $_POST['zip'];
		$contact = $_POST['contact'];
		$phone = $_POST['phone'];
		$fax = $_POST['fax'];
		$mobile = $_POST['mobile'];
		$listmail = $_POST['listmail'];
		$premium = $_POST['premium'];
		$my_paypal_id = $_POST['my_paypal_id'];
		
		$xtra_1 = $_POST['xtra_1'];
		//..we are using for getting longitude and latitude
        if($addr1!=""){
           $addr1_tmp=str_replace("\r\n"," ",$addr1);
           $fulladdr="{$addr1_tmp},{$loc1},".getState_ABVR($xtra_4).",".getCountry_name($country). ",{$zip}";
        }else
           $fulladdr="{$loc1},".getState_ABVR($xtra_4).",".getCountry_name($country). ",{$zip}";
           
        //$fulladdr=getMetroArea_name($metro_area).",".getState_name($states).",".getCountry_name($country);
        //echo $fulladdr;
        $arLatLng=Biz_getlatlang($fulladdr);
        //print_r($arLatLng);
        
        if (!empty($arLatLng)){
            $xtra_2 = $arLatLng['lat'];
		    $xtra_3 = $arLatLng['long'];
        }else{
            $fulladdr= $fulladdr="{$loc1},".getState_ABVR($xtra_4).",".getCountry_name($country). ",{$zip}";
            $arLatLng=Biz_getlatlang($fulladdr);
            $xtra_2 = $arLatLng['lat'];
		    $xtra_3 = $arLatLng['long'];
        }
		//$xtra_2 = $_POST['xtra_2'];
		//$xtra_3 = $_POST['xtra_3'];
		$xtra_4 = isset($_POST['xtra_4'])&&($_POST['xtra_4']>0) ? $_POST['xtra_4'] : 0;
        if($xtra_4==0 && $states>0)
            $xtra_4=$states;
        $xtra_5 = $_POST['xtra_5'];
		$xtra_6 = $_POST['xtra_6'];
		$strsql ="UPDATE $pds_list SET
			state='$state', 
			firm='$firm', 
			address1='$addr1', 
			loc1='$loc1', 
			loc_sel='$loc_sel',
			metro_area=$metro_area,
			country='$country',
			states_id = $states,
			zip='$zip', 
			contact='$contact', 
			phone='$phone', 
			fax='$fax', 
			mobile='$mobile', 
			description='$description', 
			website='$website', 
			email='$listmail', 
			my_paypal_id='$my_paypal_id',
			premium='$premium', 
			d_update=now(), 
			xtra_1='$xtra_1', 
			xtra_2='$xtra_2', 
			xtra_3='$xtra_3', 
			xtra_4='$xtra_4', 
			xtra_5='$xtra_5', 
			xtra_6='$xtra_6' 
			WHERE id='$vs_current_listing[id]';";
			// echo "        $strsql";

			$res = mysql_query($strsql);
            if($res){
             // get My Fans
              /*
               $acct_type = getMeAcntType($_SESSION['user']->guid) ;
               if($acct_type == "business" || $acct_type="social/business organization" ){
                $get_user_list = getMeMyFanOfList($_SESSION['user']->guid);
               }
                 foreach ( $get_user_list as  $value){
                    echo     $get_user_list['guid'];
                 }
             */
             	$listing_link = $CONFIG->wwwroot."pg/business_listing/main/$vs_current_listing[id]/".$_SESSION['guid'];
             	
             	//...save into field access level
                setProfileSettings($vs_current_listing[id],$fld_mail_add,$fld_contact,$fld_phone,$fld_fax,$fld_mobile,$fld_email);
              /*
$r_access = mysql_query("SELECT fld_mail_add,fld_contact,fld_phone,fld_fax,fld_mobile,fld_email FROM pds_list_access_level WHERE list_id=".$vs_current_listing[id]) or die( mysql_error());
	            if (mysql_num_rows($r_access) > 0){
                    //If record found then update the record
                    $rslt= mysql_query("UPDATE pds_list_access_level SET fld_mail_add=$fld_mail_add,fld_contact=$fld_contact,fld_phone=$fld_phone,fld_fax=$fld_fax,fld_mobile=$fld_mobile,fld_email=$fld_email WHERE list_id=".$vs_current_listing[id]);
             	}else{
                    //else insert into db new record
                    $rslt= mysql_query("INSERT INTO pds_list_access_level (list_id,fld_mail_add,fld_contact,fld_phone,fld_fax,fld_mobile,fld_email) VALUES (".$vs_current_listing[id].",$fld_mail_add,$fld_contact,$fld_phone,$fld_fax,$fld_mobile,$fld_email)") ;
                }
                mysql_free_result($r_access);
*/
                // mysql_free_result($rslt);
                // Add me to river
				/***
				* CODE UPDATED BY inforesha.shridhar@04012013
                add_to_river('river/user/default/profileupdate','update',$_SESSION['user']->guid,$_SESSION['user']->guid);
				***/
                //system_message(elgg_echo("profile:saved"));
                /*
                //$body=get_user($_SESSION['user']->guid)->name." updated the business listing titled <a href=\"$listing_link\">$firm</a>";
                $performed_on = get_entity($_SESSION['guid']);
                $body="<a href=\"{$performed_on->getURL()}\">{$performed_on->name}</a>  updated business profile";

                $post = new ElggObject();
    			$post->subtype = 'riverpost';
    			$post->owner_guid = get_loggedin_userid();
    			$post->access_id = 1;
    			$post->description = $body;
    			$save = $post->save();

    			if ($save) {
    				//add_to_river('river/object/riverpost/create','create',$_SESSION['user']->guid,$post->guid);
    				add_to_river('river/user/default/profileupdate','update',$_SESSION['user']->guid,$_SESSION['user']->guid);
                    system_message(elgg_echo("profile:saved"));
    			} else {
    				register_error(elgg_echo("updation failed"));
    			}
                */
            }

		//remove old categories
		mysql_query("DELETE FROM $pds_listcat WHERE list_id='$vs_current_listing[id]';");
	
		//update categories
		$cat_rows = count($cat_array);
		for ($x=0;$x<$cat_rows;$x++){
			$cat_id = $cat_array[$x];
			mysql_query ("INSERT INTO $pds_listcat (list_id, cat_id) VALUES('$vs_current_listing[id]','$cat_id');");

			//turn on category listing flag
			if($state == 'apr'){
				//turn on category listing flag
				TurnCatOn($cat_id);
			}else{
				TurnCatOff($cat_id);
			}
		}
		
		//display saved values in form
		$firm = $post_save['firm'];
		$description = $post_save['description'];
		$website = $post_save['website'];
		$addr1 = $post_save['addr1'];
		$loc1 = $post_save['loc1'];
		$metro_area = $post_save['metro_area'];
		$country = $post_save['country'];
		
		$states = $post_save['states'];
		$zip = $post_save['zip'];
		$contact = $post_save['contact'];
		$phone = $post_save['phone'];
		$fax = $post_save['fax'];
		$mobile = $post_save['mobile'];
		$listmail = $post_save['listmail'];
		$my_paypal_id = $post_save['my_paypal_id'];
		$premium = $post_save['premium'];
		$xtra_1 = $post_save['xtra_1'];
		$xtra_2 = $post_save['xtra_2'];
		$xtra_3 = $post_save['xtra_3'];
		$xtra_4 = $post_save['xtra_4'];
		if($xtra_4==0 && $states>0)
            $xtra_4=$states;
		$xtra_5 = $post_save['xtra_5'];
		$xtra_6 = $post_save['xtra_6'];
		$tpl-> assign('operation', 'Your changes have been saved');
		
		//Changes update elgg profile as well
       //..check if i am the busines user and this is my first business listing
		/***
		* CODE UPDATED BY inforesha.shridhar@04012013
       @updateElggBusinessProfile($vs_current_user[id],$vs_current_listing[id],getMetroArea_name($metro_area),$description,$website,getState_name($states),$zip,$mobile,$phone,$addr1,$my_paypal_id,$xtra_1,$addr1,$fax,$country);
	   
	   ***/
       
       //...Insert/Update business working hours
       
        
        if(($_POST['sun_start']=="Closed") || ($_POST['sun_end']=="Closed")){
            $_POST['sun_start']="Closed";
            $_POST['sun_end']="Closed";
        }
        if(($_POST['mon_start']=="Closed") || ($_POST['mon_end']=="Closed")){
            $_POST['mon_start']="Closed";
            $_POST['mon_end']="Closed";
        }
        if(($_POST['tues_start']=="Closed") || ($_POST['tues_end']=="Closed")){
            $_POST['tues_start']="Closed";
            $_POST['tues_end']="Closed";
        }
        if(($_POST['wed_start']=="Closed") || ($_POST['wed_end']=="Closed")){
            $_POST['wed_start']="Closed";
            $_POST['wed_end']="Closed";
        }
        if(($_POST['thurs_start']=="Closed") || ($_POST['thurs_end']=="Closed")){
            $_POST['thurs_start']="Closed";
            $_POST['thurs_end']="Closed";
        }
        if(($_POST['fri_start']=="Closed") || ($_POST['fri_end']=="Closed")){
            $_POST['fri_start']="Closed";
            $_POST['fri_end']="Closed";
        }
        if(($_POST['sat_start']=="Closed") || ($_POST['sat_end']=="Closed")){
            $_POST['sat_start']="Closed";
            $_POST['sat_end']="Closed";
        }
        $obj_bus_hrs=new bus_working_hrs();
		if($obj_bus_hrs->readObject(array("bus_id"=>$vs_current_listing[id]))){ 
			//..Do Nothing 
		}else{
			$obj_bus_hrs->setpk_id("");	
			$obj_bus_hrs->setbus_id($vs_current_listing[id]);	
		} 
        $obj_bus_hrs->setsun_start($_POST['sun_start']);
    	$obj_bus_hrs->setsun_end($_POST['sun_end']);
    	$obj_bus_hrs->setmon_start($_POST['mon_start']);
    	$obj_bus_hrs->setmon_end($_POST['mon_end']);
    	$obj_bus_hrs->settues_start($_POST['tues_start']);
    	$obj_bus_hrs->settues_end($_POST['tues_end']);
    	$obj_bus_hrs->setwed_start($_POST['wed_start']);
    	$obj_bus_hrs->setwed_end($_POST['wed_end']);
    	$obj_bus_hrs->setthurs_start($_POST['thurs_start']);
    	$obj_bus_hrs->setthurs_end($_POST['thurs_end']);
    	$obj_bus_hrs->setfri_start($_POST['fri_start']);
    	$obj_bus_hrs->setfri_end($_POST['fri_end']);
    	$obj_bus_hrs->setsat_start($_POST['sat_start']);
    	$obj_bus_hrs->setsat_end($_POST['sat_end']);
    	$obj_bus_hrs->insert();
       
        /*
        $myAcntType=getMeAcntType($vs_current_user[id]);

        if (($myAcntType=="business")||($myAcntType=="social/business organization")){
            $query = "SELECT id FROM pds_list WHERE userid=".$vs_current_user[id]." order by id asc";
            $result = mysql_query($query);
            $my_lst_id=mysql_result($result, 0);
            //echo "my_lst_id=$my_lst_id";
            if($my_lst_id==$vs_current_listing[id]){
                @updateElggBusinessProfile($vs_current_user[id],$loc1,$description,$website,getState_name($states),$zip,$mobile,$phone,$addr1);
            }
        }
		*/
		// for editing listing address
		$qry = 'Select id from weekSchedule where promotion_ass_id in (select id from pds_list_promotions where list_id ='.$vs_current_listing[id].')';
		$check_event = mysql_query($qry);
		if($check_event){
			$res = mysql_fetch_assoc($check_event);
	        if ($res){
	            foreach($res as $value)
	            {
	               $sql = "Update weekSchedule Set
	                        is_bus_reg = 'p'  ,
	                        location='".mysql_real_escape_string($country)."',
	                        city='".mysql_real_escape_string($loc1)."',
	                        state='".getState_name($states)."',
	                        address='".mysql_real_escape_string($addr1)."',
	                        zip=".mysql_real_escape_string($zip)."
	            		    where id =".$value;

	            		    mysql_query($sql) or die(mysql_error());
	            }
	        }
		}
        
        system_message("Profile Updated successfully");
        echo "<script type='text/javascript'>window.location.href =\"{$CONFIG->wwwroot}modules/business_listing/edlist.php?lid={$vs_current_listing[id]}\";</script>";
	}
}elseif ( isset($_POST['add_cat']) ){
	//Adding Category to list
	$cat_id = $_POST[cat][current(array_flip($_POST['add_cat']))];
	if ( @in_array($cat_id, $cat_array) ){
		// Duplicate Category Selected

		
	}else{
		//Add Category to the list
		$cat_array[] = $cat_id;
		$cat_str = implode(":", $cat_array);
	}
}elseif ( isset($_POST['rem_cat']) ){
	//Remove Category from list
	$cat_id = $_POST[cat][current(array_flip($_POST['rem_cat']))];
	array_splice($cat_array, array_search($cat_id, $cat_array), 1);
	if (count($cat_array) == 0){
		unset($cat_str);
	}else{
		$cat_str = implode(":",$cat_array);
	}
}elseif ( isset($_POST['rem_cat_list']) ){
	//Remove Category from list
	array_splice($cat_array, $_POST[cat_list], 1);
	if (count($cat_array) == 0){
		unset($cat_str);
	}else{
		$cat_str = implode(":",$cat_array);
	}

}elseif ( isset($_POST['btn_logo']) ){
	//Logo being uploaded
      $error_types = array(
	1=>'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
	'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
	'The uploaded file was only partially uploaded.',
	'No file was uploaded.',
	6=>'Missing a temporary folder.',
	'Failed to write file to disk.',
	'A PHP extension stopped the file upload.'
	);
	  
	
	$filesize = $_FILES["logo"]["size"]/1024;

	if ($_FILES["logo"]["error"] > 0){

		   $notice = $error_types[$_FILES['logo']['error']];

    }elseif( $filesize > 1500){
             $notice = "<BR>Please, Upload Image File Less Than 1.5 MB<BR>";
	}else{
        $file_info = getimagesize($_FILES['logo']['tmp_name']);
        
        switch ($file_info[2]){
	case 1:
		$file_ext = "gif";
		break;
	case 2:
		$file_ext = "jpg";
		break;
	case 3:
		$file_ext = "png";
		break;
	case 4:
		$file_ext = "swf";
		break;
	default:
		$file_ext = "";
	}
	$image_file = "$config[root]/logo/$_GET[lid].$file_ext";

    if($elgg_is_admin_user){
      $tmp_user_id =   getBizOwnerId($vs_current_listing[id]);
    }else{
      $tmp_user_id = $vs_current_user[id];
    }
	//...update the business user profile icon as well
    @updateElggBusinessProfile($tmp_user_id,$vs_current_listing[id],'','','','','','','','','','','','','',true);

	if(move_uploaded_file($_FILES['logo']['tmp_name'], $image_file)){
		//Image Uploaded
		if( ($file_info[0] > $config['logo_w'] OR $file_info[1] > $config['logo_h']) AND function_exists("imagecreate") ){
			//Resize Image
			include_once("classes/resizeimage.inc.php");
			$rimg=new RESIZEIMAGE($image_file);
			$rimg->resize_limitwh($config['logo_w'],$config['logo_h'],$image_file);
			$rimg->close();
			$list_logo = "$config[mainurl]/logo/$_GET[lid].$file_ext?".rand();
		}
		mysql_query("UPDATE $pds_list SET logo_ext='$file_ext' WHERE id='$vs_current_listing[id]';");
		$vs_current_listing['logo'] = "$config[mainurl]/logo/$_GET[lid].$file_ext?".rand();
		$tpl-> assign('operation', 'Your Logo is uploaded');
		$tpl-> assign('vs_current_listing',$vs_current_listing);
		
		system_message("Business Logo uploaded successfully");
        echo "<script type='text/javascript'>top.location.href =\"{$CONFIG->wwwroot}pg/profile/{$_SESSION['username']}\";</script>";

	}
}
	

}elseif ( isset($_POST['submit_flag']) ){
	//Nothing Pressed - Processing Cascades
}

//***********************************************
// Edit Listing
//***********************************************

/*print_r($vs_current_listing);
echo "{$vs_current_user[id]} == {$vs_current_listing[userid]} OR {$vs_current_admin} OR {$elgg_is_admin_user}"; exit;*/
if ( $vs_current_user[id] == $vs_current_listing[userid] OR $vs_current_admin OR $elgg_is_admin_user){
	// This is the user or admin
	
}else{
	//This is not the user
	header("location:user.php");
	exit;
}

//Develop category select boxes
if ( isset($_POST[cat]) ){
	$cat_level = count($_POST[cat])+1;
}else{
	$cat_level = 1;
}
$cat_select = "
	<table width=90%>
	 <tr>";
for ($i=1;$i<=$cat_level;$i++){
	$cat_select .= "
	  <td width=30% align=left valign=top style='border:none;'>
	   <select name=cat[$i] size=10 style=width:$config[cat_sel_w] onChange=submit()>";
	if ($i == 1){
		$r = mysql_query ("SELECT * FROM $pds_category WHERE p IS NULL or p='0' ORDER BY title;");
	}else{
		$r = mysql_query ("SELECT * FROM $pds_category WHERE p='$cat_rel' ORDER BY title;");
	}
	$rows_r = mysql_num_rows($r);
	for ($x=0;$x<$rows_r;$x++){
		$f = mysql_fetch_assoc($r);
		if ($f[id] == $_POST[cat][$i]){
			$cat_select .= "<option value=$f[id] selected>".$language->desc('category', $lang_set, $f[id])."</option>";
			$cat_rel = $f[id];
		}else{
			$cat_select .= "<option value=$f[id]>".$language->desc('category', $lang_set, $f[id])."</option>";
		}
	}
	mysql_free_result($r);
	if ( isset($_POST[cat][$i]) ){
		$oldcat = $_POST[cat][$i];
	}else{
		$oldcat = $f[id];
	}
	$cat_select .= "
	   </select>";
	if ($config['add_any_cat'] and isset($_POST[cat][$i]) and $oldcat == $cat_rel ) {
		if (@!in_array($cat_rel, $cat_array) ){
			$cat_select .= "<br>
	   <input type=submit name=add_cat[$i] value=\"".$language->desc('edlist', $lang_set, 'btn_add_cat')."\">";
		}else{
			$cat_select .= "<br>
	   <input type=submit name=rem_cat[$i] value=\"".$language->desc('edlist', $lang_set, 'btn_rem_cat')."\">";
		}
	}
	$cat_select .= "
	   <input type=hidden name=oldcat[$i] value=$oldcat>";
	$child_count = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_category WHERE p='$cat_rel';") );
	if (!$child_count[0] or $oldcat != $cat_rel){
		if (!$config['add_any_cat'] and isset($_POST[cat][$i]) and $oldcat == $cat_rel ){
			$cat_select .= "<br>
	   <input type=submit name=add_cat[$i] value=\"".$language->desc('edlist', $lang_set, 'btn_add_cat')."\">";
		}
		$cat_select .= "
	  </td>";
		if ($i % $config['cat_col'] == 0){$cat_select .= "";}
		break;
	}
	$cat_select .= "
	  </td>";
	if ($i % $config['cat_col'] == 0){$cat_select .= "";}
}
$cat_select .= "</tr>
	</table>";

if($config['use_loc_sel']){
	//Develop location selects
	$i = 1;
	while ( $end == false ){
		if ($i == 1){
			$loc_title = $language->desc('loc_level', $lang_set, $config['prim_loc_level']);
		}else{
			$loc_title = $language->desc('loc_level', $lang_set, $loc_level);
		}
		$show_location .= "
	  <tr>
	   <td width=50% valign=top align=right bgcolor=#EEEEEE>
		<font style=\"color:#3366CC; font-size:12pt; font-weight:normal; background-color:#EEEEEE;\">
		 $loc_title:&nbsp;&nbsp;&nbsp;
		</font>
	   </td>
	   <td width=50% align=left valign=left bgcolor=#EEEEEE style='border:none;'>
		<select name=loc[$i] size=1 onChange=submit()>";
		if ($i == 1){
			$r = mysql_query ("SELECT * FROM $pds_locsel WHERE p IS NULL or p='0' ORDER BY title;");
		}else{
			$r = mysql_query ("SELECT * FROM $pds_locsel WHERE p='$loc_rel' ORDER BY title;");
		}
		if ($_POST[loc][$i] == ""){
			$_POST[loc][$i] = $vs_loc_sel[$i-1];
		}
		$rows_r = mysql_num_rows($r);
		for ($x=0;$x<$rows_r;$x++){
			$f = mysql_fetch_assoc($r);
			if ($x == 0){$loc_rel = $f[id];$loc_level = $f[level];}
			if ($f[id] == $_POST[loc][$i]){
				$show_location .= "<option value=$f[id] selected>".$language->desc('location', $lang_set, $f[id])."</option>";
				$loc_rel = $f[id];
				$loc_level = $f[level];
			}else{
				$show_location .= "<option value=$f[id]>".$language->desc('location', $lang_set, $f[id])."</option>";
			}
		}
		mysql_free_result($r);
		$child_count = mysql_fetch_array( mysql_query("SELECT COUNT(*) FROM $pds_locsel WHERE p='$loc_rel';") );
		if ($child_count[0]){
			$i ++;
		}else{
			$end = true;
		}
		$show_location .= "
	   </td>
	  </tr>
		";
	}
}

//***********************************************
// Assign local variables to template
//***********************************************
//Initialize category list
unset ($cat_list);
if ( count($cat_array) > 0 ){
	for ($x=0;$x<count($cat_array);$x++){
		$cat_list[$x][number] = $x;
		$cat_list[$x][id]= $cat_array[$x];
		$cat_list[$x][catpath] = getCatPath($cat_array[$x]);
	}
	$cats_left = $vs_level[$listing_level][cats]-count($cat_array);
	$cat_str = implode(":", $cat_array);
}else{
	$cats_left = $vs_level[$listing_level][cats];
}
//print_r($cat_array);
//print_r($cat_list);


$tpl-> assign('page',$page);
$tpl-> assign('notice',$notice);
$tpl-> assign('login',$login);
$tpl-> assign('usermail',$usermail);
$tpl-> assign('pass',$pass);
$tpl-> assign('vpass',$vpass);
$tpl-> assign('listing_level',$listing_level);
$tpl-> assign('firm',$firm);
$tpl-> assign('description', $description);
$tpl-> assign('website',$website);
$tpl-> assign('addr1',$addr1);
$tpl-> assign('loc1',$loc1);
$tpl-> assign('metro_area',$metro_area);
$tpl-> assign('country',$country);
$tpl-> assign('states',$states);

$tpl-> assign('states_name',getState_name($states));
$tpl-> assign('xtra_4_states',getState_name($xtra_4));

$tpl-> assign('metro_area_name',getMetroArea_name($metro_area));
$tpl-> assign('country_name',getCountry_name($country));

$tpl-> assign('current_states_list',GetStatesByCountry($country));
$tpl-> assign('current_metro_area_list',GetMetroAreaByState($states));
$tpl-> assign('zip',$zip);
$tpl-> assign('contact',$contact);
$tpl-> assign('phone',$phone);
$tpl-> assign('fax',$fax);
$tpl-> assign('mobile',$mobile);
$tpl-> assign('listmail',$listmail);
$tpl-> assign('premium',$premium);
$tpl-> assign('my_paypal_id',$my_paypal_id);
$tpl-> assign('xtra_1',$xtra_1);
$tpl-> assign('xtra_2',$xtra_2);
$tpl-> assign('xtra_3',$xtra_3);

$tpl-> assign('xtra_4',$xtra_4);
$tpl-> assign('xtra_5',$xtra_5);
$tpl-> assign('xtra_6',$xtra_6);

//...access field settings
$tpl->assign('fld_mail_add',biz_view('input/access', array('internalname' => 'fld_mail_add', 'value' => $fld_mail_add)));
$tpl->assign('fld_contact',biz_view('input/access', array('internalname' => 'fld_contact', 'value' => $fld_contact)));
$tpl->assign('fld_phone',biz_view('input/access', array('internalname' => 'fld_phone', 'value' => biz_view)));
$tpl->assign('fld_fax',biz_view('input/access', array('internalname' => 'fld_fax', 'value' => $fld_fax)));
$tpl->assign('fld_mobile',biz_view('input/access', array('internalname' => 'fld_mobile', 'value' => $fld_mobile)));
$tpl->assign('fld_email',biz_view('input/access', array('internalname' => 'fld_email', 'value' => $fld_email)));

$tpl-> assign('cat_str',$cat_str);
$tpl-> assign('cat_list',$cat_list);
$tpl-> assign('list_category',get_category_listing_values($cat_str));
$tpl-> assign('cats_left',$cats_left);
$tpl-> assign('cat_select',$cat_select);
$tpl-> assign('show_location',$show_location);
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('list_logo',$list_logo);
$tpl-> assign('show_page','edlist');
 

$chk_bus_profile = chkIfBusUsrProfListing($vs_current_user[id],$vs_current_listing[id]);
$tpl-> assign('isThisBusProfile',chkIfBusUsrProfListing($vs_current_user[id],$vs_current_listing[id]));
if(is_gt_zero_num($chk_bus_profile)){
 /*$lnk = get_user($vs_current_user[id])->getURL();*/
 	$lnk = "";
if(is_not_empty($lnk)){
  $tpl-> assign('profile_link', $lnk);
}
}
 
//***********************************************
// Display Template
//*********************************************** 
$tpl-> display("$config[deftpl]/edlist.tpl");

?>
