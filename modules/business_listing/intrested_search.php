<?PHP

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
$ispromotion = 1;
 $promotion_filter_critera_sql = "";
if((isset($vs_current_user[id])) && ($vs_current_user[id]>0)){
  $sql_array = array();
  $sql_array = @get_intrested_in_sql_array($vs_current_user[id],$xlimit,$ylimit);

  $sql = "" ;
  $promotion_filter_critera_sql ="";
  if (!empty($sql_array)){
     $sql = $sql_array['sql'];
     $promotion_filter_critera_sql = $sql_array['promotion_sql'];

  }

  

}
// echo "sql=$sql<br>";
//die ("Test: ".$sql);
if (is_not_empty($sql)){
$r_list = mysql_query ("$sql;") or die(mysql_error());
$r1 = mysql_query("SELECT FOUND_ROWS() as total;");
$f1 = mysql_fetch_assoc($r1);
$result_found = $f1['total'];

if(mysql_num_rows($r_list) > 0){
	//Search Results Found
  //include "sublist_promotion.php" ;
    $list=getMeListFromRecords($r_list, 0, $promotion_filter_critera_sql);
	SmartyPaginate::setTotal($f1['total']);
	SmartyPaginate::assign($tpl);
          if( !empty($csearch_sql) ){
          $rc = mysql_query("SELECT * FROM $pds_category WHERE f_mt = '1' $csearch_sql ORDER BY title;");
          for($x=0;$x<mysql_num_rows($rc);$x++){
             $clist[$x] = mysql_fetch_assoc($rc);
             $clist[$x]['title'] = $language->desc('category',$lang_set,$clist[$x]['id']);
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
             $clist[$x]['title'] = $language->desc('category',$lang_set,$clist[$x]['id']);
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
}
//***********************************************
// Assign local variables to template
//***********************************************
$src_states = isset($_POST['states'])&&($_POST['states']>0) ? $_POST['states'] : 0 ;
$tpl-> assign('current_metro_area_list',GetMetroAreaByState($src_states));
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('list',$list);
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
$tpl-> assign('byconnections',$byconnections);
$tpl-> assign('bygroupmem',$bygroupmem);

$tpl-> assign('show_page','search');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/search.tpl");

?>
