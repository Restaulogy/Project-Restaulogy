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
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('search',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('search',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

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
$search_keywords = "";
$smarty_url_string = "";

 if (isset($_REQUEST['show_type']))
 {
        $country = '';
        $states = '';
        $categories = '';
        //$smarty_url_string .= "mychoice_search=1";
        
        //..Added for type BL or PR
        if (isset($_REQUEST['show_type'])){
          $show_type=$_REQUEST['show_type'];
        }else{
          $show_type="BL";
        }
        $smarty_url_string .= "show_type=$show_type";
        //print_r($_REQUEST);
        //print_r($_REQUEST);
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

	  $contrysql = "";
      $statesql = "";
      $categorysql = "";

        if ($country != "")
        {


            $country = explode(",", $country);
            
            $country_condition = '';
            
			foreach ($country as $country_item)
		 		{
				     $country_condition .=   " Find_in_set('$country_item', l.country) OR" ;
     			}

     			if (strlen(trim($country_condition)) != 0)
                	{
                        $country_condition = substr( $country_condition,0,-2);
					    $contrysql =  " And ($country_condition ) ";
                	}
            //$conditions .= $search_condition. " Find_in_set('$categories', a.category_listing)" ;
        }



        if ($states != "")
        {

            $states = explode(",", $states);
            $states_condition = '';
			foreach ($states as $states_item)
		 		{
				     $states_condition .=   " Find_in_set('$states_item', l.states_id) OR" ;
     			}

     			if (strlen(trim($states_condition)) != 0)
                	{
                        $states_condition = substr( $states_condition,0,-2);
					     $statesql  =  " And ($states_condition ) ";
                	}



        }

       if (isset($_REQUEST['categories']))
        {


            //$conditions .= $search_condition. " Find_in_set (a.category_listing,		'".$categories ."')" ;
            $categories = explode(",", $_REQUEST['categories']);
            $category_condition = '';
			foreach ($categories as $catgory_item)
		 		{
				     $category_condition .=   " Find_in_set('$catgory_item', c.id) OR Find_in_set('$catgory_item', c.p) OR" ;
     			}

     			if (strlen(trim($category_condition)) != 0)
                	{
                        $category_condition = substr( $category_condition,0,-2);
					    $categorysql .=  " And ($category_condition ) ";
                	}
            //$conditions .= $search_condition. " Find_in_set('$categories', a.category_listing)" ;
        }

        //  $sql = "SELECT SQL_CALC_FOUND_ROWS l. * FROM  pds_listcat  lc left outer join pds_list l on lc.list_id = l.id LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr' $contrysql $statesql $categorysql LIMIT $xlimit,$ylimit;" ;

    if($show_type=="PR")
	{

		$sql = "SELECT  Distinct l.id    FROM pds_list_promotions p  inner join pds_listcat  lc on lc.list_id = p.list_id inner join pds_category  c on lc.cat_id = c.id  left outer join pds_list l on p.list_id = l.id LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr'
		$contrysql $statesql $categorysql";

		$r1 = mysql_query($sql);

        //$f1 = mysql_fetch_assoc($r1);
		$result_found = mysql_num_rows($r1);//$f1['total'];

		  $sql = "SELECT Distinct  l. * FROM pds_list_promotions p  inner join pds_listcat lc on p.list_id = lc.list_id inner join pds_category  c on lc.cat_id = c.id  left outer join pds_list l on p.list_id = l.id LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr'
$contrysql $statesql $categorysql LIMIT $xlimit,$ylimit;";
         $search_keywords = "Search By:- 'My Choice' Section Promotions" ;
         $tpl-> assign('ispromotion', 1);
    }
    else
    {

		$sql = "SELECT Distinct l.id   FROM  pds_listcat  lc left outer join pds_list l on lc.list_id = l.id inner join pds_category  c on lc.cat_id = c.id  LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr' $contrysql $statesql $categorysql";
		$r1 = mysql_query($sql);
        //$f1 = mysql_fetch_assoc($r1);
		$result_found = mysql_num_rows($r1);//$f1['total'];

         $sql = "SELECT Distinct  l. *   FROM  pds_listcat  lc left outer join pds_list l on lc.list_id = l.id inner join pds_category  c on lc.cat_id = c.id  LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr' $contrysql $statesql $categorysql LIMIT $xlimit,$ylimit;";
        $search_keywords = "Search By:- 'My Choice' Section Listing" ;
        $tpl-> assign('ispromotion', 0);
	}


 }
 else
 {
    $smarty_url_string .= "isother=1";
    if ((strlen(trim($_REQUEST['location']))) == 0)
	{
	//Site Search
	
		//$location_sql = " And ( loc1 like '%".$_REQUEST['location']."%' Or address1 like '%".$_REQUEST['location']."%')" ;
		$location_sql = "";

    }
elseif (isset($_REQUEST['location']))
    {
        	$location_sql = " And loc1 like '%".$_REQUEST['location']."%'" ;
        //	$location_sql = " And ( loc1 like '%".$_REQUEST['location']."%' Or address1 like '%".$_REQUEST['location']."%')" ;
         $search_keywords = $search_keywords. "| Location Like ".$_REQUEST['location'];
         $smarty_url_string .= "&location=".$_REQUEST['location'];

	}
/*if ($_REQUEST['rate'] == 0)
	{
        $rating_sql = "";
		$orderby_sql = "";
    }
else
     {
        $rating_sql = ", question".$_REQUEST['rate']." as vote_avg";
        $orderby_sql = " ORDER BY vote_avg ";

	 }
*/

if ((strlen(trim($_REQUEST['country']))) == 0)
 {
	 $country_sql = "";
 }
 else
 {
    $country_sql = " And l.country like '".$_REQUEST['country']."'";
    $search_keywords = $search_keywords. "| country = ".getCountry_name($_REQUEST['country']);
 $smarty_url_string .= "&country=".$_REQUEST['country'];

 }
if((strlen(trim($_REQUEST['states']))) == 0)
 {
	 $states_sql = "";
 }
 elseif (isset($_REQUEST['states']))
 {
    $states_sql = " And l.states_id = ".$_REQUEST['states'];
    $search_keywords = $search_keywords. "| states = ".getState_name($_REQUEST['states']);

 $smarty_url_string .= "&states=".$_REQUEST['states'];

 }
  if ($_REQUEST['rating'] == 0)
	{
        $rating_sql = "";

    }
else
     {

        $rating_sql = " and (v.question1+ v.question2+v.question3+v.question4+v.question5+v.question6+v.question7)>=".($_REQUEST['rating']*7)." ";
          $search_keywords = $search_keywords. "| Rating >= ".$_REQUEST['rating'];
 $smarty_url_string .= "&rating=".$_REQUEST['rating'];


	 }

 if ($_REQUEST['catid'] == 0)
	{
	$category_sql = "";


    }
else
    {
        $all_child_categories =  get_child_with_paraent($_REQUEST['catid']);
       	$category_sql = " And  c.id in ($all_child_categories)";
         $search_keywords = $search_keywords. "| Category= ".$language->desc('category',$lang_set,$_REQUEST['catid']);
         $smarty_url_string .= "&catid=".$_REQUEST['catid'];
	}


if(($_REQUEST['findby']) == 1 )
	{
	//Site Search

        $sql = "SELECT Distinct  l. * FROM pds_list_promotions p  inner join pds_listcat  lc on lc.list_id = p.list_id inner join pds_category  c on lc.cat_id = c.id  left outer join pds_list l on p.list_id = l.id LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr' $country_sql $states_sql  $category_sql $location_sql $rating_sql";

$r1 = mysql_query($sql);


$result_found = mysql_num_rows($r1);



		 $sql = "SELECT Distinct  l. * FROM pds_list_promotions p  inner join pds_listcat  lc on lc.list_id = p.list_id inner join pds_category  c on lc.cat_id = c.id  left outer join pds_list l on p.list_id = l.id LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr' $country_sql $states_sql  $category_sql $location_sql $rating_sql LIMIT $xlimit,$ylimit;";

        


  $search_keywords = "Search By:- Promotions".$search_keywords ;
  $smarty_url_string .= "&findby=1";
  $tpl-> assign('ispromotion', 1);
    }
else
     {

$sql = "SELECT  Distinct  l. *   FROM  pds_listcat  lc left outer join pds_list l on lc.list_id = l.id inner join pds_category  c on lc.cat_id = c.id  LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr' $country_sql $category_sql $location_sql
$rating_sql  $states_sql ";

$r1 = mysql_query($sql);


$result_found = mysql_num_rows($r1);

         $sql = "SELECT Distinct   l. *   FROM  pds_listcat  lc left outer join pds_list l on lc.list_id = l.id inner join pds_category  c on lc.cat_id = c.id  LEFT OUTER JOIN pds_votes v ON l.id = v.list_id  where state='apr' $country_sql $category_sql $location_sql
$rating_sql  $states_sql   LIMIT $xlimit,$ylimit; ";
 $search_keywords = "Search By:- Listing ".$search_keywords ;
 $smarty_url_string .= "&findby=0";
 $tpl-> assign('ispromotion', 0);
	 }
 }

//***********************************************
// Show Search Results
//***********************************************
//-------------------------------------------------//
if($smarty_url_string != ""){
		SmartyPaginate::setURL("searchPa.php?$smarty_url_string" );
	}else{
		SmartyPaginate::setURL("searchPa.php");
	}
//-------------------------------------------------//
//$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM $pds_list WHERE state='apr' $search_sql $zip_limit ORDER BY premium DESC, firm LIMIT $xlimit,$ylimit;";
//die ("Test: ".$sql);
//echo $sql;
$r_list = mysql_query ("$sql;") or die(mysql_error());

//$r1 = mysql_query("SELECT FOUND_ROWS() as total;");


if(mysql_num_rows($r_list) > 0){
	//Search Results Found
  //include "sublist_promotion.php" ;
    $list=getMeListFromRecords($r_list);
	SmartyPaginate::setTotal($result_found);
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

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('list',$list);
$tpl-> assign('clist',$clist);
 $tpl-> assign('search_keywords',$search_keywords);
 $tpl-> assign('result_found',$result_found);

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/search.tpl");

?>
