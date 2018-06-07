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

$fb_recomm_app = get_input("fb_recomm_app",0);

//***********************************************
// Assign Local Variables
//***********************************************
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('search',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('search',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";
$byconnections = 0;
$bygroupmem = 0;
include ("classes/inputfilter.php");
$filter = new inputFilter($allow_tags,$allow_attr);

$_GET = $filter->process($_GET);
foreach($_GET as $key=>$value){
	if( !get_magic_quotes_gpc() ){
		$_GET[$key] = addslashes($value);
	}
}

//***********************************************
// Result set paging
//***********************************************
include ("classes/SmartyPaginate.class.php");

SmartyPaginate::connect();
if($_REQUEST['nl']){
    $_GET['nl'] = $_REQUEST['nl'];
}

if ($_GET['nl'] == ""){
	SmartyPaginate::reset();
}

SmartyPaginate::setUrlVar('nl');
SmartyPaginate::setLimit($config[search_page]);
SmartyPaginate::setPrevText($language->desc("site_text",$lang_set,'previous'));
SmartyPaginate::setNextText($language->desc("site_text",$lang_set,'next'));
SmartyPaginate::setFirstText($language->desc("site_text",$lang_set,'first'));
SmartyPaginate::setLastText($language->desc("site_text",$lang_set,'last'));
$xlimit = SmartyPaginate::getCurrentIndex();
$ylimit = SmartyPaginate::getLimit();



//***********************************************
// Button Press Logic
//***********************************************

/***************************************
Checking For Busines Listing & Search Promotions
******************/

$smarty_url_string=""; 
if (isset($_REQUEST['sp'])){
	$ispromotion = 1;
	$smarty_url_string ="&sp";
}else{
    $ispromotion = 0;
    $smarty_url_string="&sb";
}
$ispromotion=1;
    $by_prom = 0;
if (isset($_REQUEST['by_prom'])){
    $smarty_url_string="&by_prom";
    $by_prom = 1;
}

if(is_gt_zero_num($fb_recomm_app)){
	$smarty_url_string .="&fb_recomm_app={$fb_recomm_app}";	
}

$sort_on = get_input(SORT_ON,"pds_list_promotions.id"); 
$sort_by=$new_sort="";
biz_set_sorting_var($sort_by,$new_sort);

$show_filter = "";
$filter_error = "";

$country = '';
$states = '';
$categories = '';
$metro_area = '';
$coupons_condition = " AND cupon_type LIKE 'none' " ;
 //print_r($_REQUEST);
if ((strlen(trim($_REQUEST['location']))) == 0)
{
	$location_sql = "";
}
elseif (isset($_REQUEST['location']))
{
    $location_sql = " And loc1 like '%".$_REQUEST['location']."%'" ;
    $show_filter = $show_filter. "| City Like ".$_REQUEST['location'];
    $smarty_url_string .= "&location=".$_REQUEST['location'];
}
	
if (isset($_REQUEST['country']))
{
    if(is_array($_REQUEST['country']))
    {
        $country = implode(',', $_REQUEST['country']);
    }
    else
    {
        $country = $_REQUEST['country'];
    }
    $smarty_url_string .= "&country=$country";
}

if (isset($_REQUEST['states']))
{
    if(is_array($_REQUEST['states']))
    {
        $states = implode(',', $_REQUEST['states']);
    }
    else
    {
        $states = $_REQUEST['states'];
    }
    $smarty_url_string .= "&states=$states";
}


if (isset($_REQUEST['metro_area']))
{
    if(is_array($_REQUEST['metro_area']))
    {
        $metro_area = implode(',', $_REQUEST['metro_area']);
    }
    else
    {
        $metro_area = $_REQUEST['metro_area'];
    }
    $smarty_url_string .= "&metro_area=$metro_area";
}

//..InforeshaODC change for the connection promotions
$connectionsql ="";
if (isset($_REQUEST['byconnections']))
{
    $byconnections = 1;
    $fr_lst=GetMyConnectionList();
    if (empty($fr_lst)){
        $connectionsql = ' AND (1=2)';
    }else{
        $connectionsql = ' AND (userid IN ('.implode(",",$fr_lst).'))';
    }
    $smarty_url_string .= "&byconnections=1&sp=1";
    $bread_crumb[0] = 'Promotions Posted By Connections';
}
//..InforeshaODC change for the group mem
$groupmemsql ="";
if (isset($_REQUEST['bygroupmem']))
{
    $bygroupmem = 1;
    if ((isset($groupid)) && ($groupid>0)){
        $smarty_url_string .= "&bygroupmem=1&sp=1&groupid=$groupid";
    }else{
        $smarty_url_string .= "&bygroupmem=1&sp=1";
    }
    $fr_lst=GetMyGroupMemList($groupid);
    if (empty($fr_lst)){
        $groupmemsql = ' AND (1=2)';
    }else{
        $groupmemsql = ' AND (userid IN ('.implode(",",$fr_lst).'))';
    }

    $bread_crumb[0] = 'Promotions Posted By Group Members';
}

$contrysql = "";
$statesql = "";
$categorysql = "";
$metro_areasql = "";

$show_country = "";
$show_state = "";
$show_metro_area = "";
$show_category = "";


if ($country)
{
    $country = explode(",", $country);
    $country_condition = '';
	foreach ($country as $country_item)
	{
	    $country_condition .= " Find_in_set('$country_item', pds_list.country) OR" ;
	    $show_country  =  getCountry_name($country_item).",";
	}
    if(biz_elgg_is_non_empty($show_country)){
       	//	$show_filter .="| Country like ".substr( $show_country,0,-1);
    }
	if (strlen(trim($country_condition)) != 0)
	{
        $country_condition = substr( $country_condition,0,-2);
	    $contrysql =  " And ($country_condition ) ";
	}
}
if ($states)
{

    $states = explode(",", $states);
    $states_condition = '';
	foreach ($states as $states_item)
	{
		if($ispromotion == 1){
            $states_condition .=   " Find_in_set('$states_item', pds_list_promotions.states) OR" ;
		}else{
        $states_condition .=   " Find_in_set('$states_item', pds_list.states_id) OR" ;
  		}
  		$show_state .= getState_name($states_item)." ,";
	}
	
	if(biz_elgg_is_non_empty($show_state)){
       $show_filter .="| States like ".substr( $show_state,0,-1);
    }

	if (strlen(trim($states_condition)) != 0)
	{
        $states_condition = substr( $states_condition,0,-2);
	    $statesql  =  " And ($states_condition ) ";
	}
}

if ($metro_area)
{

    $metro_area = explode(",", $metro_area);
    $metro_area_condition = '';
	foreach ($metro_area as $metro_area_item)
	{
  if($ispromotion == 1){
		  $metro_area_condition .=   " Find_in_set('$metro_area_item', pds_list_promotions.metro_area) OR" ;
  		}else{
		  $metro_area_condition .=   " Find_in_set('$metro_area_item', pds_list.metro_area) OR" ;
 	}
	$show_metroarea .= getMetroArea_name($metro_area_item)." ,";
	}

    if(biz_elgg_is_non_empty($show_metroarea)){
       $show_filter .="| Metro Area like ".substr( $show_metroarea,0,-1);
    }
	if (strlen(trim($metro_area_condition)) != 0)
	{
        $metro_area_condition = substr( $metro_area_condition,0,-2);
	    $metro_areasql  =  " And ($metro_area_condition ) ";
	}

}

if ((isset($_REQUEST['categories'])) && (strlen($_REQUEST['categories'])>0))
{

    $smarty_url_string .= "&categories=$categories";
    $categories = explode(":", $_REQUEST['categories']);
    $category_condition = '';
	foreach ($categories as $catgory_item)
	{
	     $category_condition .=   " Find_in_set('$catgory_item', pds_category.id) OR Find_in_set('$catgory_item', pds_category.p) OR" ;
	    $show_category .= get_categ_name_by_id($catgory_item).", ";
	}

	 if(biz_elgg_is_non_empty($show_category)){
       $show_filter .="| Category like ".substr($show_category,0,-2);
    }
	if (strlen(trim($category_condition)) != 0)
	{
        $category_condition = substr( $category_condition,0,-2);
	    $categorysql .=  " And ($category_condition ) ";
	}
}

if ((isset($_REQUEST['keywords'])) && (strlen($_REQUEST['keywords'])>0))
{

      $keywords=  $_REQUEST['keywords'] ;
      $show_filter .="| Keywords like $keywords ";
      if($ispromotion == 1){
        $keywords_sql .= "AND (pds_list_promotions.title LIKE '%".$keywords."%' OR pds_list_promotions.comments LIKE '%".$keywords."%') ";
      }else{
       $keywords_sql .= "AND (pds_list_promotions.title LIKE '%".$keywords."%' OR pds_list_promotions.comments LIKE '%".$keywords."%' OR pds_category.title like '%".$keywords."%') ";
      }

      $promotion_keywords_sql = " AND (pds_list_promotions.title LIKE '%".$keywords."%' OR pds_list_promotions.comments LIKE '%".$keywords."%')";
      $smarty_url_string .="&keywords=$keywords";
      
}

if ((isset($_REQUEST['business_title'])) && (strlen($_REQUEST['business_title'])>0))
{
      $business_title=  $_REQUEST['business_title'] ;
      $business_title_sql .= "AND firm LIKE '%".$business_title."%' ";
      $smarty_url_string .="&business_title=$business_title";
      $show_filter .="| Business Title = $business_title ";
}

$end_this_wk ='off';
if ($_REQUEST['end_this_wk'] == 'on'){
	//Limiting range
	$end_this_wk = ($_GET['end_this_wk']) ? $_GET['end_this_wk'] : $_POST['end_this_wk'];
    
    if($ispromotion == 1){
        $end_this_wk_url = " And YEARWEEK(pds_list_promotions.end_date) = YEARWEEK(CURRENT_DATE) " ;
        $show_filter = $show_filter. "| Ending This Week = On ";
        $smarty_url_string .= "&end_this_wk=on";
    }
}
if (is_not_empty($_REQUEST['cupon_type'])){
	//Limiting range
	$cupon_type= ($_REQUEST['cupon_type']) ? $_REQUEST['cupon_type'] : "none";
    if($ispromotion == 1){
        $coupons_condition = " AND cupon_type LIKE '$cupon_type' " ;
       // $show_filter = $show_filter. "| Promotion Type = ".(str_replace("_", " ", $cupon_type))." ";
        $smarty_url_string .= "&cupon_type={$cupon_type}";
    }
} 

if( ($_POST['limit_range'] == 'on' AND $_POST['search_range'] AND $_POST['search_zip']) OR ($_GET['lr'] == 'on') ){ 
	//Limiting range 
	$limit_range = ($_GET['lr']) ? $_GET['lr'] : $_POST['limit_range']; 
	$search_range = ($_GET['sr']) ? $_GET['sr'] : $_POST['search_range']; 
	$search_zip = ($_GET['sz']) ? $_GET['sz'] : $_POST['search_zip']; 
	
    $search_range = mysql_real_escape_string($search_range);
    $search_zip = mysql_real_escape_string($search_zip);
    

	if(is_numeric($search_range) &&  is_numeric($search_zip)){
		$qry_zip = zipsInRange($search_zip,$search_range);
		$zip_limit = " AND (";
		for($x=0;$x<count($qry_zip);$x++){
			$zip_tmp = $qry_zip[$x][zip];
			//$zip_limit .= "zip='$zip_tmp' ";
			$zip_limit .= "zip LIKE '$zip_tmp%'";
			$zip_name[$zip_tmp] = $qry_zip[$x]['loc_sec'].", ".$qry_zip[$x]['loc_prim'];
			$zip_distance[$zip_tmp] = $qry_zip[$x]['distance'];
			if ($x + 1 != count($qry_zip)){$zip_limit .= "OR ";}
		}
		$zip_limit .= ")";
		if(strtoupper($limit_range) == 'ON'){
	        $show_filter .= "| Search Location = On | Search zip Within $search_range miles | Zip like $search_zip";
	 	}
	}else{
		$filter_error .= "Search Range & Zip Must be Numeric.<br>";
 	}
}

if($_GET['sa'] == "site" OR $_POST['sa'] == "site"){
	//Site Search

	$search_key = ($_GET['sa']) ? str_replace(",+"," ",$_GET['sk']) : str_replace(",+"," ",$_POST['sk']);

 	$search_key = trim(mysql_real_escape_string(remove_splchar_from_string($search_key)));
	$search_key = str_replace(","," ",$search_key);
	$search_values = explode(" ",$search_key);
	$search_type = ($_GET['st']) ? $_GET['st'] : $_POST['st'];
	if($search_zip != ""){
		$page_url = "search.php?sa=site&sk=$search_key&st=$search_type&lr=on&sr=$search_range&sz=$search_zip".$smarty_url_string;  
	}else{
		$page_url = "search.php?sa=site&sk=$search_key&st=$search_type".$smarty_url_string;
		
	}
	SmartyPaginate::setURL($page_url);
	if ($ispromotion == 1){
        $firm = 'pds_list_promotions.title';
		$description = 'pds_list_promotions.comments';
 	}else{
		$firm = 'firm';
		$description = 'description';
  	}
  	if(biz_elgg_is_non_empty($search_key)){
        $show_filter = $show_filter. "| Keywords like $search_key ";
    }
   		//...$show_filter = $show_filter. "| Search Type = $search_type ";

	if(count($search_values) > 0){
		//Search Values Submitted
		$promotion_filter_search_sql      = "";
		for($x=0;$x<count($search_values);$x++){
        if ((strlen(trim($search_values[$x])))>0){
             if($search_type == 'all')
                $TMP_CONDITION = 'And';
             else
                $TMP_CONDITION = 'OR';

             if ($x == 0){
                   if($ispromotion==1){
                       $search_sql .= "(pds_list_promotions.title LIKE '%$search_values[$x]%' OR pds_list_promotions.comments LIKE '%$search_values[$x]%' OR pds_list.firm LIKE '%$search_values[$x]%' OR pds_list.description LIKE '%$search_values[$x]%' )";
											 //.OR pds_category.title like '%$search_values[$x]%'
                    }else{
                        $search_sql .= "(pds_list_promotions.title LIKE '%$search_values[$x]%' OR pds_list_promotions.comments LIKE '%$search_values[$x]%' OR pds_list.firm LIKE '%$search_values[$x]%' OR pds_list.description LIKE '%$search_values[$x]%' OR pds_category.title like '%$search_values[$x]%')";
                    }
                    /*
if($ispromotion==1){
                       $search_sql .= "($firm LIKE '%$search_values[$x]%' OR $description LIKE '%$search_values[$x]%')";
                    }else{
                        $search_sql .= "($firm LIKE '%$search_values[$x]%' OR $description LIKE '%$search_values[$x]%' OR pds_category.title like '%$search_values[$x]%')";
                    }

                    $csearch_sql .= "(title LIKE '%$search_values[$x]%') ";
                    $promotion_filter_search_sql .= "($firm LIKE '%$search_values[$x]%' OR $description LIKE '%$search_values[$x]%')";
                    */
					$csearch_sql .= "(title LIKE '%$search_values[$x]%') ";
                    $promotion_filter_search_sql .= "(pds_list_promotions.title LIKE '%$search_values[$x]%' OR pds_list_promotions.comments LIKE '%$search_values[$x]%' )";
				}else{
/*
                    $search_sql .= " $TMP_CONDITION ($firm LIKE '%$search_values[$x]%' OR $description LIKE '%$search_values[$x]%' OR pds_category.title like '%$search_values[$x]%')";
					$csearch_sql .= " $TMP_CONDITION (title LIKE '%$search_values[$x]%') ";
                    $promotion_filter_search_sql .= " $TMP_CONDITION ($firm LIKE '%$search_values[$x]%' OR $description LIKE '%$search_values[$x]%')";
*/
                    $search_sql .= " $TMP_CONDITION (pds_list_promotions.title LIKE '%$search_values[$x]%' OR pds_list_promotions.comments LIKE '%$search_values[$x]%' OR pds_list.firm LIKE '%$search_values[$x]%' OR pds_list.description LIKE '%$search_values[$x]%' )";
										//..OR pds_category.title like '%$search_values[$x]%'
					$csearch_sql .= " $TMP_CONDITION (title LIKE '%$search_values[$x]%') ";
                    $promotion_filter_search_sql .= " $TMP_CONDITION (pds_list_promotions.title LIKE '%$search_values[$x]%' OR pds_list_promotions.comments LIKE '%$search_values[$x]%')";
				}
		    }
		}

		 if ((strlen(trim($search_sql)))!=0){
            	$search_sql = "And ($search_sql)";
			}
        if ((strlen(trim($csearch_sql)))!=0){
            	$csearch_sql = "And ($csearch_sql)";
			}
		if ((strlen(trim($promotion_filter_search_sql)))!=0){
        	$promotion_filter_search_sql = "And ($promotion_filter_search_sql)";
		} 

	}else{
		//No Search Values Submitted
	}
}elseif($_GET['sa'] == "alpha" OR $_POST['sa'] == "alpha"){
	//Search ALpha
	if($_GET['sk'] != "" OR $_POST['sk'] != ""){
		$search_key = ($_GET['sk']) ? ($_GET['sk']) : ($_POST['sk']);
		$page_url = "search.php?sa=alpha&sk=$search_key".$smarty_url_string;
		SmartyPaginate::setURL($page_url);
		$search_key_uc = mysql_real_escape_string(remove_splchar_from_string(strtoupper($search_key)));
		$search_key_lc =  mysql_real_escape_string(remove_splchar_from_string(strtolower($search_key_uc)));
		$search_sql = "AND (firm LIKE '$search_key_uc%' OR firm LIKE '$search_key_lc%') ";
		$search_char =$search_key;
		$search_key = "";
	
		$search_alpha = true;
	}else{
		//No Alpha Submitted
	}
}
//***********************************************
// Show Search Results
//***********************************************

/*
if ($ispromotion == 1){
    $sql = "SELECT SQL_CALC_FOUND_ROWS Distinct pds_list.* FROM  pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id  WHERE state='apr' $search_sql $zip_limit ORDER BY premium DESC, firm LIMIT $xlimit,$ylimit;";
}else{
$sql = "SELECT SQL_CALC_FOUND_ROWS Distinct pds_list.* FROM $pds_list WHERE state='apr' $search_sql $zip_limit ORDER BY premium DESC, firm LIMIT $xlimit,$ylimit;";
}*/
$sql_cond = '';
if(is_gt_zero_num($_SESSION[SES_RESTAURANT])){
	$sql_cond = ' AND `prm_restaurent`='.$_SESSION[SES_RESTAURANT];
}
  
if($Global_member['member_role_id'] == ROLE_ADMIN){
	$sql_cond .= ' AND pds_list_promotions.end_date < CURDATE()';
	$isHistory = 1;
}else{
	$sql_cond .= ' AND pds_list_promotions.end_date>=CURDATE()';
	$isHistory = 0;
}

//..Get listing type.
if ((isset($_REQUEST['listing_type'])) && (strlen($_REQUEST['listing_type'])>0)){
    $listing_type	= $_REQUEST['listing_type'] ;
}else{
  	if((isset($Global_member['rl_fn_promotion_expired'])) && ($Global_member['rl_fn_promotion_expired'] == 1)){
			if($Global_member['member_role_id'] == ROLE_ADMIN){	
					$listing_type = 'expired';
			}else{
					$listing_type = 'all';
			}				
		}else{
				$listing_type = 'all';
		}			
}

if($listing_type == 'expired'){
	$ishistory = -1;	
	$promtionsql = " {$search_sql}";
}else{
	$promtionsql = " AND pds_list_promotions.`prm_restaurent`=".$_SESSION[SES_RESTAURANT]." AND pds_list_promotions.end_date>=CURDATE() {$search_sql}";
} 

$record_fetch_condition=" DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id";


switch ($listing_type){
	
	case "all": 
	    if ($ispromotion == 1){			
				$survey_cond="";	
				if(isCustomer()){	
			  	 $survey_cond=" AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";
			  }else{
					 $survey_cond="";
				}  
			  $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND `is_event`=0 AND cupon_type<>'reward' AND pds_list_promotions.start_date<=CURDATE() {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;"; 
			 		/*AND   pds_list_promotions.list_id = {$biz_id}*/
        $promotion_sql_filter = " $promtionsql";
        $bread_crumb[0] =  "Promotions";
		   
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list  inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' ORDER BY firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $bread_crumb[0] =  "All Businesses";
  		}
		break;	
		
		
	case "forthcoming": 
	    if ($ispromotion == 1){
			
			  if(isCustomer()){	
			  	 $survey_cond=" AND cupon_type<>'survey' AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";
			  }else{
					 $survey_cond="";
				}		  
			  $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND `is_event`=0 AND cupon_type<>'reward' AND pds_list_promotions.start_date>=CURDATE() {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;"; 
			 		/*AND   pds_list_promotions.list_id = {$biz_id}*/
        $promotion_sql_filter = " $promtionsql";
        $bread_crumb[0] =  "Promotions";
		   
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list  inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' ORDER BY firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $bread_crumb[0] =  "All Businesses";
  		}
		break;
		
	case "is_event": 
	    if ($ispromotion == 1){
			
			  if(isCustomer()){	
			  	 $survey_cond=" AND cupon_type<>'survey' AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";
			  }else{
					 $survey_cond="";
				}		  
			  $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND `is_event`=1 AND cupon_type<>'reward' AND pds_list_promotions.start_date<=CURDATE() {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;"; 
			 		/*AND   pds_list_promotions.list_id = {$biz_id}*/
        $promotion_sql_filter = " $promtionsql";
        $bread_crumb[0] =  "Promotions";
		   
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list  inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' ORDER BY firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $bread_crumb[0] =  "All Businesses";
  		}
		break;			
			
	case "expired":
		$sql = "SELECT SQL_CALC_FOUND_ROWS  DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id  FROM pds_list_promotions inner join pds_list   on pds_list_promotions.list_id = pds_list.id WHERE pds_list_promotions.prm_restaurent='".(is_gt_zero_num($_SESSION[SES_RESTAURANT])?$_SESSION[SES_RESTAURANT]:0)."' AND pds_list_promotions.end_date < CURDATE() {$promtionsql} ORDER BY {$sort_on} {$sort_by} LIMIT $xlimit,$ylimit;";

		$promotion_sql_filter = " AND pds_list_promotions.end_date < CURDATE() ";
			$bread_crumb[0] =  "Expired Promotions";
			break;	
			 
   case "reward":
			$sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND cupon_type='reward' $promtionsql ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;"; 
			//$ispromotion = 2;
				  $promotion_sql_filter = " $promtionsql";
          $bread_crumb[0] =  "Promotions";
            //$bread_crumb[0] =  "Coupons";
			break;
} 




if ($ispromotion == 1){
		/*AND   pds_list_promotions.list_id = {$biz_id}*/		
    /*$sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT pds_list.*, pds_list_promotions.id as tmp_promo_id FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE  state='apr' $sql_cond  $search_sql  $zip_limit $contrysql $statesql $categorysql $location_sql $connectionsql $groupmemsql $metro_areasql $keywords_sql $end_this_wk_url $coupons_condition ORDER BY {$sort_on} {$sort_by}, firm LIMIT $xlimit,$ylimit;";
     $promotion_filter_critera_sql = "$promotion_filter_search_sql $sql_cond  $statesql $metro_areasql $promotion_keywords_sql $end_this_wk_url";*/
}else{

    /*$sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT pds_list.* FROM $pds_list left outer join pds_list_promotions on pds_list.id = pds_list_promotions.list_id
inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category  on pds_category.id = pds_listcat.cat_id   WHERE state='apr' $sql_cond $search_sql $zip_limit $contrysql $statesql $categorysql $keywords_sql $location_sql $metro_areasql ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;";

    $promotion_filter_critera_sql = "$sql_cond";*/
} 
 //echo "sql=$sql<br>";
  //exit;
// die ("Test: ".$sql);
$r_list = mysql_query ("$sql;") or die(mysql_error());
$r1 = mysql_query("SELECT FOUND_ROWS() as total;");
$f1 = mysql_fetch_assoc($r1);
$result_found = $f1['total']; 
if(is_gt_zero_num($_REQUEST['isServicePage'])){

    include_once ("services/functions.php");
    
    SmartyPaginate::setTotal($f1['total']);
	SmartyPaginate::assign($tpl);
	$search_paginate = $tpl->get_template_vars('paginate');

     $list = array();
     $list['title'] = "Search";
     //$list['pagination'] = promotion_list_page_num_display($offset,$limit,$result_found,$listing_type,$show_type);
     $list['search_paginate'] = $search_paginate;
     $list['count'] = $result_found;
     $list['show_filter'] = $show_filter;
if(mysql_num_rows($r_list) > 0){
     //..added by Inforesha TM on 31 Oct 12 since it is not showing
     //..promotions by business name as keyword
     /*if((is_not_empty($promotion_filter_critera_sql)) && (biz_elgg_is_non_empty($search_key))){
        $promotion_filter_critera_sql= "";
     }*/
     $list['items'] =  getMeListFromRecords($r_list, $isHistory, $promotion_filter_critera_sql,$map_ids);
} 
  echo json_encode($list);
}else{ 
$map_ids=array();

if(mysql_num_rows($r_list) > 0){
	//Search Results Found
    //include "sublist_promotion.php";
    //..added by Inforesha TM on 31 Oct 12 since it is not showing
     //..promotions by business name as keyword
     /*if((is_not_empty($promotion_filter_critera_sql)) && (biz_elgg_is_non_empty($search_key))){
        $promotion_filter_critera_sql= "";
    }*/
		 
    //$list=getMeListFromRecords($r_list, $isHistory , $promotion_filter_critera_sql,$map_ids);
		$list=getMeListFromRecords($r_list, $ishistory, $promotion_sql_filter,$map_ids);

    //...added for showing result on the map
    if(!empty($map_ids)){
       $map_ids=array_unique($map_ids);
       $tpl-> assign('map_ids',implode(",",$map_ids));
    }
    //print_r($map_ids);
    //print_r($list);
	SmartyPaginate::setTotal($f1['total']);
	SmartyPaginate::assign($tpl);
          if( !empty($csearch_sql)){
          //$rc = mysql_query("SELECT * FROM $pds_category WHERE f_mt = '1' $csearch_sql ORDER BY title;");
          $rc = mysql_query("SELECT * FROM $pds_category WHERE f_mt = '1' $csearch_sql ORDER BY title;");
          for($x=0;$x<mysql_num_rows($rc);$x++){
             $clist[$x] = mysql_fetch_assoc($rc);
             //$clist[$x]['title'] = $language->desc('category',$lang_set,$clist[$x]['id']);
             if($config['rewrite']){
                $mod_id = $clist[$x]['id'];
                $mod_title = str_replace(' ','_',getCatPath($clist[$x]['id']));
                $mod_title = str_replace('/','-',$mod_title);
                $clist[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$clist[$x]['title']."</a>";
             }else{
                $clist[$x]['href'] = "<a href=\"index.php?cat=".$clist[$x]['id']."\">".$clist[$x]['title']."</a>";
             }
          }
       }

}else{
	//No Results Found
          if( !empty($csearch_sql) ){
          $rc = mysql_query("SELECT * FROM $pds_category WHERE f_mt = '1' $csearch_sql ORDER BY title;");
          for($x=0;$x<mysql_num_rows($rc);$x++){
             $clist[$x] = mysql_fetch_assoc($rc);
             //$clist[$x]['title'] = $language->desc('category',$lang_set,$clist[$x]['id']);
             if($config['rewrite']){
                $mod_id = $clist[$x]['id'];
                $mod_title = str_replace(' ','_',getCatPath($clist[$x]['id']));
                $mod_title = str_replace('/','-',$mod_title);
                $clist[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$clist[$x]['title']."</a>";
             }else{
                $clist[$x]['href'] = "<a href=\"index.php?cat=".$clist[$x]['id']."\">".$clist[$x]['title']."</a>";
             }
          }
       }
}

//***********************************************
// Assign local variables to template
//***********************************************
$src_country = (isset($_POST['country'])&&($_POST['country']!="")) ? $_POST['country'] :$vs_user_prof_country;

$src_states = isset($_POST['states'])&&($_POST['states']>0) ? $_POST['states'] : 0 ;

$tpl-> assign('current_states_list',GetStatesByCountry($src_country));
$tpl-> assign('current_metro_area_list',GetMetroAreaByState($src_states));

$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('list',$list);

/*print_r($list);
exit;*/
$tpl-> assign('clist',$clist);
$tpl-> assign ('search_char', $search_char);
$tpl-> assign('search_key',$search_key);
$tpl-> assign('search_type',$search_type);
$tpl-> assign('result_found',$result_found);
$tpl-> assign('search_alpha',$search_alpha);
$tpl-> assign('limit_range',$limit_range);
$tpl-> assign('search_range',$search_range);
$tpl-> assign('search_zip',$search_zip);
$tpl-> assign('zip_name',$zip_name);
$tpl-> assign('zip_distance',$zip_distance);
$tpl-> assign('ispromotion',$ispromotion);
/*$tpl-> assign('ispromotion',1);*/
$tpl-> assign('byconnections',$byconnections);
$tpl-> assign('bygroupmem',$bygroupmem);

$tpl-> assign('end_this_wk',$end_this_wk);
$tpl-> assign('cupon_type',$cupon_type);
$tpl-> assign('fb_recomm_app',$fb_recomm_app);
$tpl-> assign('page_url',$page_url);
$tpl-> assign('new_sort',$new_sort);
$tpl-> assign('listing_type', $listing_type);


//..needed for home link
if($ispromotion==1)
    $show_type="PR";
else
    $show_type="BL";
$tpl-> assign('show_type',$show_type);

$tpl-> assign('show_page','search');

if(biz_elgg_is_non_empty($show_filter)){

    $show_filter = substr($show_filter , 1, strlen($show_filter));
   if($by_prom != 1){
        $tpl-> assign('show_filter',$show_filter);
   }

}
if(biz_elgg_is_non_empty($filter_error)){
    $filter_error = substr($filter_error , 0, strlen($filter_error) - 4);
    $tpl-> assign('filter_error',$filter_error);
}
$breadcrumbs[] = array('link'=> $config['mainurl']."/promotionslisting.php?show_type=PR","title"=>"Promotions");
$breadcrumbs[] = array('link'=>$page_url,"title"=>"Search Results");

$tpl->assign('breadcrumbs',$breadcrumbs);
//***********************************************
// Display Template
//***********************************************
if(is_gt_zero_num($fb_recomm_app)){		
	$tpl-> display("$config[deftpl]/facebook_search_result.tpl");
}else{	
	$tpl-> display("$config[deftpl]/search_result.tpl");
	//$tpl-> display("$config[deftpl]/newpromotionlisting.tpl");
}
}
?>
