<?php 
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
$fb_recomm_app = get_input("fb_recomm_app",0); 
$show_type = get_input("show_type","PR"); 
$user_id = get_input("user_id",0);


/********************************************************************
Checking For Busines Listing & Search Promotions
*********************************************************************/
 
if ($show_type == 'PR'){
        $ispromotion= 1;
        $promtionsql = " AND pds_list_promotions.end_date>=CURDATE() AND Find_in_set('".$vs_user_prof_loc['metroareaid']."', pds_list_promotions.metro_area) AND cupon_type LIKE 'none' ";
        $title_tag = "All Promotions";
		$bread_crumb[0] =  "All Promotions";
        $record_fetch_condition = " DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id";
}else{
    	$ispromotion= 0;
    	$promtionsql = " AND Find_in_set('".$vs_user_prof_loc['metroareaid']."', pds_list.metro_area)";
    	$title_tag = "All listing";
		$bread_crumb[0] =  "All listing";
		$record_fetch_condition = " DISTINCT pds_list.* ";
}

$btn_link[0] = "disabled";
$sql_for_history = "";
if ((isset($_REQUEST['listing_type'])) && (strlen($_REQUEST['listing_type'])>0)){
      	$listing_type=  $_REQUEST['listing_type'] ;
}else{
    	$listing_type= 'all';
}


$promotion_sql_filter = "";
$show_filter = ""; 
 
if($ispromotion == 1){
    $sql =  "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list_promotions  left outer join pds_list  on pds_list_promotions.list_id = pds_list.id inner join pds_list_favorites  on pds_list_promotions.id = pds_list_favorites.list_id WHERE pds_list_favorites.ispromotion = 1 and pds_list_promotions.end_date>=CURDATE() and pds_list_favorites.user_id=".$user_id." ORDER BY firm LIMIT $xlimit,$ylimit;";
    $promotion_sql_filter = " and pds_list_favorites.user_id=".$user_id;
    $bread_crumb[0] =  "My Saved Promotions";
}else{
    $sql =  "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list inner join pds_list_favorites on pds_list.id = pds_list_favorites.list_id WHERE pds_list_favorites.ispromotion = 0 and pds_list_favorites.user_id=".$user_id." ORDER BY firm LIMIT $xlimit,$ylimit;";
    $promotion_sql_filter = "";
    $bread_crumb[0] =  "My Favorite Businesses";
}
         	      	 
 //echo "sql=$sql<br>";exit;
//|die ("Test: ".$sql);
if (is_not_empty($sql)){

$r_list = mysql_query ("$sql;") or die(mysql_error());
$r1 = mysql_query("SELECT FOUND_ROWS() as total;");
$f1 = mysql_fetch_assoc($r1);
$result_found = $f1['total'];
$map_ids=array();

if(mysql_num_rows($r_list) > 0){
	//Search Results Found
   //include "sublist_promotion.php"; 
    $list=getMeListFromRecords($r_list, 0, $promotion_sql_filter,$map_ids);  
	} 
}  
	//...added for showing result on the map
    if(!empty($map_ids)){
       $map_ids=array_unique($map_ids);
       $tpl-> assign('map_ids',implode(",",$map_ids));
    }
  
    //SmartyPaginate::setURL("fav_promotionslisting.php?show_type=$show_type&user_id={$user_id}");  
	SmartyPaginate::setURL("fav_promotionslisting.php?user_id={$user_id}");  
	SmartyPaginate::setTotal($f1['total']);
	SmartyPaginate::assign($tpl);  

//***********************************************
// Assign local variables to template
//*********************************************** 
    $tpl-> assign('title_tag', $bread_crumb[0]);
    $tpl-> assign('bread_crumb', $bread_crumb);
    $tpl-> assign('btn_link',$btn_link);
    $tpl-> assign('list_count', count($list));
    $tpl-> assign('list',$list); 
    $tpl-> assign('show_page','promotionslisting');
    $tpl-> assign('ispromotion',$ispromotion); 
	$tpl-> assign('fav_promotion', 1);
	$tpl-> assign('user_id', $user_id);  
	$tpl-> assign("fb_recomm_app",$fb_recomm_app); 
//***********************************************
// Display Template
//***********************************************
  $tpl-> display("$config[deftpl]/fav_promotionlisting.tpl");
?>