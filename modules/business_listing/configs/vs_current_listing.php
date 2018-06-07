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
// Variable Set - Current Listing
//***********************************************

if ($list_id != ""){
	$l_id = $list_id;
}elseif ($_GET[lid] != ""){
	$l_id = $_GET[lid];
}elseif ($_POST[lid] != ""){
	$l_id = $_POST[lid];
}elseif ($_SESSION[listid] != ""){
	$l_id = $_SESSION[listid];
}

if ($l_id AND is_numeric($l_id)){
	$r = mysql_query("SELECT * FROM $pds_list l INNER JOIN $pds_liststats ls ON l.id=ls.list_id WHERE l.id='$l_id';") or die( mysql_error() );
	if (mysql_num_rows($r) > 0){
        $vs_current_listing = mysql_fetch_assoc($r);
        $vs_current_listing = new_stripslashes_deep($vs_current_listing);
		$vs_current_listing['mod_firm'] = str_replace(' ','_',$vs_current_listing['firm']);
		$vs_current_listing['mod_firm'] = str_replace('/','-',$vs_current_listing['mod_firm']);
		$r_catlist = mysql_query("SELECT c.* FROM $pds_listcat lc INNER JOIN $pds_category c ON lc.cat_id=c.id WHERE lc.list_id='$l_id';");

		for($x=0;$x<mysql_num_rows($r_catlist);$x++){
			$f_catlist = mysql_fetch_assoc($r_catlist);

			$vs_catpath[$x]['path'] = getCatPath($f_catlist['id']);
			$vs_catpath[$x]['id'] = $f_catlist['id'];
			$vs_catpath[$x]['mod_title'] = str_replace(' ','_',$vs_catpath[$x]['path']);
			$vs_catpath[$x]['mod_title'] = str_replace('/','-',$vs_catpath[$x]['mod_title']);
		}
		//..changes made by sangram for guest user
        if ((isset($vs_current_listing[userid])) && ($vs_current_listing[userid]>0)){
            $r_mail = mysql_query("SELECT usermail FROM $pds_user WHERE id='$vs_current_listing[userid]';");
    		$f_mail = mysql_fetch_assoc($r_mail);
    		$vs_current_listing['usermail'] = $f_mail['usermail'];
        }else{
            $vs_current_listing['usermail'] = "";
        }
		
		$vs_current_listing['address'] = str_replace("\n","<br>",$vs_current_listing[address1]);
		$add_r = mysql_query("SELECT * FROM $pds_locsel WHERE id='$vs_current_listing[loc_sel]';");
		$add_f = mysql_fetch_assoc($add_r);
		$vs_loc_sel[0] = $add_f['id'];
		$i = 0;
		while ($add_f[p] != ""){
			mysql_free_result($add_r);
			$i ++;
			$add_r = mysql_query("SELECT * FROM $pds_locsel WHERE id='$add_f[p]';");
			$add_f = mysql_fetch_assoc($add_r);
			$vs_loc_sel[$i] = $add_f['id'];
		}
		$vs_loc_sel = array_reverse($vs_loc_sel);
		mysql_free_result($add_r);
		mysql_free_result($r);
		$check_file = "list".$vs_current_listing['level'].".tpl";
		if (is_readable("templates/$config[deftpl]/list/$check_file")){
			$vs_current_listing[main_file] = $check_file;
		}else{
			$vs_current_listing[main_file] = "list0.tpl";
		}
		$check_file = $l_id.".".$vs_current_listing['logo_ext'];
		if ($vs_current_listing['logo_ext'] != "" AND is_readable("logo/$check_file"))       {
			$vs_current_listing['logo'] = "$config[mainurl]/logo/$check_file?".rand();
		}
		
		$vs_current_listing['state_name'] = getState_name($vs_current_listing['states_id']);
		$vs_current_listing['xtra_4_name'] = getState_ABVR($vs_current_listing['xtra_4']);

        //... get Distance
        $my_curr_lat=$_SESSION['client_lat'];
        $my_curr_long=$_SESSION['client_long'];
          $dist =0;
       if (isset($vs_current_listing['xtra_2']) && isset($vs_current_listing['xtra_3']) && ($vs_current_listing['xtra_2']!='') && ($vs_current_listing['xtra_3']!='')){
                $dist=con_lat_long_to_dist($vs_current_listing['xtra_2'],$vs_current_listing['xtra_3'],$my_curr_lat,$my_curr_long);

       }
    $list_recommendation = array();
	//$biz_rec = new biz_recommendation();
	//$list_recommendation=$biz_rec->GetAllRecmdForPost($_SESSION['guid'],$l_id,"BUSINESS");
	$list_recommendation=array();
	$vs_current_listing['recommendation_display'] = "";
	//$vs_current_listing['recommendation_display'] = $biz_rec->display($_SESSION['guid'],$l_id,"BUSINESS",$vs_current_listing['firm'],$l_id,1);
    	

        $vs_current_listing['dist'] = $dist;

        $vs_current_listing['map_link'] = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($vs_current_listing['address1'])."+".$vs_current_listing['loc1'])."+".$vs_current_listing['zip'];

		//..this field added for showing the business profile
         //$vs_current_listing['buss_prof_link']=get_entity($vs_current_listing['userid'])->getURL();
		 $vs_current_listing['buss_prof_link']="";
        //..get biz hours
        $obj_conf_bus_hrs=new bus_working_hrs();
        //$vs_current_listing['biz_wrk_hrs']=$obj_conf_bus_hrs->getclsMebizHrs(array('bus_id'=> $vs_current_listing[id]),$vs_current_listing['address1'],$vs_current_listing['loc1'],$vs_current_listing['xtra_4_name'],$vs_current_listing['zip']);
		$vs_current_listing['biz_wrk_hrs']=$obj_conf_bus_hrs->getclsMebizHrs(array('bus_id'=> $vs_current_listing[id]),$vs_current_listing['address1'],$vs_current_listing['loc1'],$vs_current_listing['xtra_4_name'],$vs_current_listing['zip']);
        
        //..get Recommended by user
        $vs_current_listing['is_recommended'] = 0;
        $vs_current_listing['is_surveyed'] = 0;
       /* if(in_array($vs_current_listing['id'], explode(",",listOf_Biz_rcmd_by_user($_SESSION['guid'])))){
           $vs_current_listing['is_recommended'] = 1;
        }
        if(in_array($vs_current_listing, explode(",",listOf_Biz_survey_by_user($_SESSION['guid'])))){
          $vs_current_listing['is_surveyed'] = 1;
         }*/
        

        $result =  mysql_query("SELECT * FROM pds_list_promotions WHERE list_id='$vs_current_listing[id]' AND end_date>=CURDATE()") or die(mysql_error());
        for($x=0;$x<mysql_num_rows($result);$x++){
           $user_promotion[$x]=mysql_fetch_assoc($result);
           $this_pdf = $user_promotion[$x]['pdf'];
           $user_promotion[$x]['title'] = string_replace_for_sql($user_promotion[$x]['title']);
           $user_promotion[$x]['comments'] = stripslashes($user_promotion[$x]['comments']);
              $pdf_tmp_name = explode('_',  $this_pdf, -1);
              $pdf_name ="";
              foreach($pdf_tmp_name as $value)
              {
            	$pdf_name .= $value."_";
              }
             $user_promotion[$x]['pdf_name'] = substr_replace($pdf_name,"",-1);
             if (($user_promotion[$x]['metro_area']) && ($user_promotion[$x]['metro_area']>0))
                $user_promotion[$x]['metro_area_name'] = getMetroArea_name($user_promotion[$x]['metro_area']);
             else
                $user_promotion[$x]['metro_area_name'] ="";
                
              if (($user_promotion[$x]['states']) && ($user_promotion[$x]['states']>0))
                $user_promotion[$x]['states_name'] = getState_name($user_promotion[$x]['states']);
             else
                $user_promotion[$x]['state_name'] ="";

             if (file_exists($config[root]."pdf/".$user_promotion[$x]['pdf'])) {
							   $user_promotion[$x]['pdf_size']= round((filesize($config[root]."pdf/".$user_promotion[$x]['pdf'])/1024),2);
							} else {
							   $user_promotion[$x]['pdf_size']= 0;
							}
             
        }

       //...access level changes by inforeshaoDC TM
       $r_access = mysql_query("SELECT fld_mail_add,fld_contact,fld_phone,fld_fax,fld_mobile,fld_email FROM pds_list_access_level WHERE list_id=$l_id;") or die( mysql_error());
       $vs_current_listing['access_levels']=get_def_access_buss_flds();

	   if (mysql_num_rows($r_access) > 0){
            $row=mysql_fetch_assoc($r_access);
            $vs_current_listing['access_levels']['fld_mail_add'] = $row['fld_mail_add'];
            $vs_current_listing['access_levels']['fld_contact'] = $row['fld_contact'];
            $vs_current_listing['access_levels']['fld_phone'] = $row['fld_phone'];
            $vs_current_listing['access_levels']['fld_fax'] = $row['fld_fax'];
            $vs_current_listing['access_levels']['fld_mobile'] = $row['fld_mobile'];
            $vs_current_listing['access_levels']['fld_email'] = $row['fld_email'];
       }else{
            $vs_current_listing['access_levels']=get_def_access_buss_flds();
       } 
	   

       //...to show/not show on detail form view
       $vs_current_listing['show_field_on_form']['fld_mail_add']=get_access_fld_allowed_bl($l_id,"fld_mail_add");
       $vs_current_listing['show_field_on_form']['fld_contact']=get_access_fld_allowed_bl($l_id,"fld_contact");
       $vs_current_listing['show_field_on_form']['fld_phone']=get_access_fld_allowed_bl($l_id,"fld_phone");
       $vs_current_listing['show_field_on_form']['fld_fax']=get_access_fld_allowed_bl($l_id,"fld_fax");
       $vs_current_listing['show_field_on_form']['fld_mobile']=get_access_fld_allowed_bl($l_id,"fld_mobile");
       $vs_current_listing['show_field_on_form']['fld_email']=get_access_fld_allowed_bl($l_id,"fld_email"); 
	   
	  /* $vs_current_listing['show_field_on_form']['fld_mail_add']=2;
       $vs_current_listing['show_field_on_form']['fld_contact']=2;
       $vs_current_listing['show_field_on_form']['fld_phone']=2;
       $vs_current_listing['show_field_on_form']['fld_fax']=2;
       $vs_current_listing['show_field_on_form']['fld_mobile']=2;
       $vs_current_listing['show_field_on_form']['fld_email']=2;*/
       
       //..format phone numbers here only
       $vs_current_listing['phone']= is_not_empty($vs_current_listing['phone']) ? printPhoneNumbers($vs_current_listing['phone']) : "";
       $vs_current_listing['mobile']= is_not_empty($vs_current_listing['mobile']) ? printPhoneNumbers($vs_current_listing['mobile']) : "";
       $vs_current_listing['fax']= is_not_empty($vs_current_listing['fax']) ? printPhoneNumbers($vs_current_listing['fax']) : "";
       
       //...Business hour changes by inforeshaoDC TM
       $obj_conf_bus_hrs=new bus_working_hrs();
       $vs_current_listing['business_hours']=$obj_conf_bus_hrs->retArr(array('bus_id'=> $l_id));
	   //$vs_current_listing['business_hours']="";

       $tpl-> assign('user_promotion',$user_promotion);

/// Created For Listing    ================================================
/// Created For Promotions ================================================
  /** previous code for list of the promotions
    while ($row = mysql_fetch_assoc($result))
    {
        $list_promotions[] = array('id' => $row['id'], 'title' => $row['title'], 'pdf_1' => $row['pdf_1'], 'pdf_2' => $row['pdf_2'],'comment' => $row['comment']  );
    }

  $pdf_name = explode('_', $row['pdf_1'], -1);
  $pdf_name1 ="";
  foreach($pdf_name as $value)
  {
	$pdf_name1 .= $value."_";
  }
  $pdf_name1 = substr_replace($pdf_name1,"",-1);

 $pdf_size1= round((filesize($config[root]."pdf/".$row['pdf_1'])/1024),2);
 $pdf_name = explode('_', $row['pdf_2'], -1);
 $pdf_name2 ="";
 foreach($pdf_name as $value)
  {
	$pdf_name2.= $value."_";
  }
    $pdf_name2 = substr_replace($pdf_name2,"",-1);
    $pdf_size2= round((filesize($config[root]."pdf/".$row['pdf_2'])/1024),2);

    $tpl-> assign('id' , $row['id']);
    $tpl-> assign('list_id',$row['list_id']);
    $tpl-> assign('title',$row['title']);
    $tpl-> assign('pdf_1',$row['pdf_1']);
    $tpl-> assign('pdf_1_name', $pdf_name1);
    $tpl-> assign('pdf_1_size', $pdf_size1);
    $tpl-> assign('pdf_2',$row['pdf_2']);
    $tpl-> assign('pdf_2_name', $pdf_name2);
    $tpl-> assign('pdf_2_size', $pdf_size2);
    $tpl-> assign('comment',stripslashes($row['comment']));
*/
    	$tpl-> assign('vs_current_listing',$vs_current_listing);
		$tpl-> assign('vs_loc_sel',$vs_loc_sel);
		$tpl-> assign('vs_catpath',$vs_catpath);
	}else{
		//echo "Error! Unable to get listing data (vs_current_listing.php)";
	}
}
?>