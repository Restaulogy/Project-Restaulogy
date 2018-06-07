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
ini_set("output_buffering","1");
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************

//***********************************************
// Result set paging
//***********************************************
include ("classes/SmartyPaginate.class.php");

SmartyPaginate::connect('cat');
SmartyPaginate::connect('list');
if (!$_GET['nc']){
	SmartyPaginate::reset('cat');
}
if (!$_GET['nl']){
	SmartyPaginate::reset('list');
}

if((isset($_REQUEST['sp'])) && ($_REQUEST['sp']==1)){
	$ispromotion = 1;
	$smarty_url_string="&sp=1";
}else{
    $ispromotion = 0;
    $smarty_url_string="&sp=0";
}

SmartyPaginate::setUrlVar('nc','cat');
SmartyPaginate::setUrlVar('nl','list');
SmartyPaginate::setLimit($config[cats_page],'cat');
SmartyPaginate::setLimit($config[lists_page],'list');
SmartyPaginate::setPrevText($language->desc("site_text",$lang_set,'previous'),'cat');
SmartyPaginate::setPrevText($language->desc("site_text",$lang_set,'previous'),'list');
SmartyPaginate::setNextText($language->desc("site_text",$lang_set,'next'),'cat');
SmartyPaginate::setNextText($language->desc("site_text",$lang_set,'next'),'list');
SmartyPaginate::setFirstText($language->desc("site_text",$lang_set,'first'),'cat');
SmartyPaginate::setFirstText($language->desc("site_text",$lang_set,'first'),'list');
SmartyPaginate::setLastText($language->desc("site_text",$lang_set,'last'),'cat');
SmartyPaginate::setLastText($language->desc("site_text",$lang_set,'last'),'list');
$xlimit = SmartyPaginate::getCurrentIndex('cat');
$ylimit = SmartyPaginate::getLimit('cat');
$xalimit = SmartyPaginate::getCurrentIndex('list');
$yalimit = SmartyPaginate::getLimit('list');

// Category List
if ($_GET['cat']){
	$r = mysql_query ("SELECT SQL_CALC_FOUND_ROWS * FROM $pds_category WHERE p='$_GET[cat]' ORDER BY title LIMIT $xlimit,$ylimit;") or die("Error getting sub categories: ".mysql_error());
	$main_cat=0;

	SmartyPaginate::setURL("index.php?cat=$_GET[cat]",'cat');
/*
}elseif ($_GET['ca'] == 'alpha'){
   $ck = $_GET['ck'];
   SmartyPaginate::setURL("index.php?ca=alpha&ck=$ck");
   $ck_uc = strtoupper($ck);
   $ck_lc = strtolower($ck_uc);
   $r = mysql_query ("SELECT SQL_CALC_FOUND_ROWS * FROM $pds_category WHERE title LIKE '$ck_uc%' OR title LIKE '$ck_lc%' ORDER BY title LIMIT $xlimit,$ylimit;") or die("Error getting alpha categories: ".mysql_error());
*/
}else{
	//$r = mysql_query ("SELECT SQL_CALC_FOUND_ROWS * FROM $pds_category WHERE p IS NULL ORDER BY title LIMIT $xlimit,$ylimit;") or die("Error getting main categories: ".mysql_error());
	$r = mysql_query ("SELECT SQL_CALC_FOUND_ROWS * FROM $pds_category WHERE p=0 ORDER BY title LIMIT $xlimit,$ylimit;") or die("Error getting main categories: ".mysql_error());
	$main_cat=1;
}
$r1 = mysql_query("SELECT FOUND_ROWS() as total;");
$f1 = mysql_fetch_assoc($r1);
$r_rows = mysql_num_rows($r);
for ($x=0;$x<$r_rows;$x++){
	$f = mysql_fetch_array($r);
	$categories[$x]['id'] = $f['id'];
	$categories[$x]['title'] = $f['title'];
	//$categories[$x]['title'] = $language->desc('category',$lang_set,$f['id']);
	//$listcount = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM $pds_listcat WHERE cat_id='$f[id]'"));

$all_child_categories = (get_child_with_paraent($f['id']));
if ((strlen(trim($all_child_categories))) != 0){
    $all_child_categories = " And lc.cat_id in($all_child_categories)";
}else{
$all_child_categories = "";
}

		 //$all_child_categories =  substr(get_child_categories($f[id]),0,-1);
//        $all_child_categories = " AND (lc.cat_id in ($all_child_categories) OR  lc.cat_id in (Select id from pds_category where p in ($all_child_categories)) )";

	$sql_qry = "SELECT COUNT( DISTINCT l.id ) FROM
				$pds_listcat lc INNER JOIN $pds_list l
				ON lc.list_id = l.id WHERE
		   		l.state='apr' $all_child_categories";

	$listcount = mysql_fetch_array(mysql_query($sql_qry));
    $categories[$x]['listcount'] = $listcount[0];

	//echo ($categories[$x]['title'])    ;
	/*
	if ($f[f_mt] != "" OR !$config['disable_empty_cat']){
		if($config['rewrite']){
			$mod_id = $categories[$x]['id'];
			$mod_title = str_replace(' ','_',getCatPath($f['id']));
			$mod_title = str_replace('/','-',$mod_title);
			$categories[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$categories[$x]['title']."</a>";
		}else{
			$categories[$x]['href'] = "<a href=\"index.php?cat=".$categories[$x]['id']."\">".$categories[$x]['title']."</a>";
		}
	}else{
		$categories[$x]['href'] = $categories[$x]['title'];
	}
	*/
	  if ($f[f_mt] != "" OR !$config['disable_empty_cat']){
     // $r_sub = mysql_query("SELECT * FROM $pds_category WHERE p='$f[id]' AND f_mt='1' ORDER BY title LIMIT 0,5;");
      $r_sub = mysql_query("SELECT * FROM $pds_category WHERE p='$f[id]' ORDER BY title;");
      $rs_rows = mysql_num_rows($r_sub);
      if($config['rewrite']){
         $mod_id = $categories[$x]['id'];
         $mod_title = str_replace(' ','_',getCatPath($f['id']));

         $categories[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$categories[$x]['title']."</a>";
         if ($rs_rows){
            for ($y=0;$y<$rs_rows;$y++){
               $f_sub = mysql_fetch_assoc($r_sub);
               $mod_sid = $f_sub['id'];
               $mod_stitle = str_replace(' ','_',getCatPath($f_sub['id']));
               if ($y != 0 or $y != $rs_rows-1){
                  $categories[$x]['sub'] .= " | ";
               }
               $categories[$x]['sub'] .= "<a href=\"./$mod_stitle-$mod_sid-0.html\">".$f_sub['title']."</a>";
            }
         }else{
            $categories[$x]['sub'] = "&nbsp;";
         }
      }else{
           $categories[$x]['href'] = "<a onclick=\"location.href='index.php?cat=".$categories[$x]['id']."{$smarty_url_string}'\" href=\"#\">".$categories[$x]['title']."</a>";

         if ($rs_rows){
            for ($y=0;$y<$rs_rows;$y++){
               $f_sub = mysql_fetch_assoc($r_sub);
               /*if ($y != 0 or $y != $rs_rows-1){
                  $categories[$x]['sub'] .= " | ";
               }
               */
               $categories[$x]['sub'] .= "<a href=\"index.php?cat=".$f_sub['id']."{$smarty_url_string}\">".$f_sub['title']."</a>&nbsp;|";
            }
         }else{
            $categories[$x]['sub'] = "&nbsp;";
         }
      }
   }else{
      $categories[$x]['href'] = $categories[$x]['title'];
      $categories[$x]['sub'] = "&nbsp;";
   }
$categories[$x]['sub'] = substr_replace($categories[$x]['sub'],"",-1);

}

$tpl-> assign('main_cat', $main_cat);
$tpl-> assign('categories',$categories);
SmartyPaginate::setTotal($f1['total'],'cat');
SmartyPaginate::assign($tpl,'paginate_cat','cat');

//***********************************************
// Button Press Logic
//***********************************************

if ($_GET['cat']){

//***********************************************
// Process Categories and Listings
//***********************************************

	// Get the selected category information
	$r_cat = mysql_query ("SELECT * FROM $pds_category WHERE id='$_GET[cat]';") or die(mysql_error());
	// and read into associated array $f_cat
	$f_cat = mysql_fetch_assoc ($r_cat);
	// Assign $cat_title
	$cat_title = $language->desc('category', $lang_sel,  $f_cat['id']);
	$tpl-> assign('cat_title',$cat_title);
	if($config['rewrite']){
		$mod_cat_title = str_replace(' ','_',getCatPath($_GET['cat']));
		$mod_cat_title = str_replace('/','-',$mod_cat_title);
		$tpl-> assign('mod_cat_title',$mod_cat_title);
	}

	// Check for category content header
	$file_check = "templates/$config[deftpl]/t_inc/$f_cat[id]_contenthead.tpl";
	// If there is category content header information
	if (file_exists($file_check)){
		// Assign $cat_head_file
		$tpl-> assign('cat_head_file',"$config[deftpl]/t_inc/$f_cat[id]_contenthead.tpl");
		// Assign $cat_head
		$tpl-> assign('cat_head',$language->desc('cat_content', $lang_set, 'cat'.$f_cat[id].'h'));
	}else{
		// No category content header information found
		$tpl-> assign('cat_head_file',"");
	}

	// Check for category content footer
	$file_check = "templates/$config[deftpl]/t_inc/$f_cat[id]_contentfoot.tpl";
	// If there is category content footer information
	if (file_exists($file_check)){
		// Assign $cat_foot_file
		$tpl-> assign('cat_foot_file',"$config[deftpl]/t_inc/$f_cat[id]_contentfoot.tpl");
		// Assign $cat_foot
		$tpl-> assign('cat_foot',$language->desc('cat_content', $lang_set, 'cat'.$f_cat[id].'f'));
	}else{
		// No category content footer information found
		$tpl-> assign('cat_foot_file',"");
	}

	//***********************************************
	// Title Tag
	//***********************************************
	$title_tag = $language->desc('site_text',$lang_set,'main_title');
	$title_tag .= " | ".$cat_title;
	$mod_title = str_replace(' ','_',getCatPath($f_cat[id]));
	$mod_title = str_replace('/','-',$mod_title);

	//***********************************************
	// Breadcrumb Link
	//***********************************************

	/*$title[] = $language->desc("category",$lang_set,$f_cat[id]);*/
    $title[] = $f_cat[title];
	$cid[] = $f_cat[id];
	$parent = $f_cat[p];
	while ($parent == true){
		$rbc = mysql_query ("SELECT * FROM $pds_category WHERE id='$parent';");
		$fbc = mysql_fetch_assoc($rbc);
  		/*$title[] = $language->desc("category",$lang_set,$fbc[id]);*/
  		$title[] = $fbc[title];
		$cid[] = $fbc[id];
		$parent = $fbc[p];
		$catid = $fbc[id];
		mysql_free_result($rbc);
	}
	$title = array_reverse($title);
	$cid = array_reverse($cid);
	for ($x=0;$x< count($title);$x++){
		$bread_crumb[$x] = $title[$x];
		if ($x == count($title) - 1){
			// Disabled Button
			$btn_link[$x] = "disabled";
		}else{
			// Linked Button
			if($config['rewrite']){
				$mod_title = str_replace(' ','_',$title[$x]);
				$mod_title = str_replace('/','-',$mod_title);
				$btn_link[$x] = "onClick=\"document.location.href='./$mod_title-".$cid[$x]."-0.html'\"";
			}else{
				$btn_link[$x] = "onClick=\"document.location.href='./index.php?cat=".$cid[$x]."{$smarty_url_string}'\"";
			}
		}
	}
	$tpl-> assign('show_page','index_sub');

	//***********************************************
	// Listings
	//***********************************************

	/*
	$r_list = mysql_query ("SELECT SQL_CALC_FOUND_ROWS * FROM $pds_listcat lc INNER JOIN $pds_list l ON lc.list_id=l.id WHERE cat_id='$_GET[cat]' AND state='apr' ORDER BY l.premium DESC, l.firm LIMIT $xalimit,$yalimit;");
	*/
	if ($_GET['cat']>0){
        $all_child_categories = (get_child_with_paraent($_GET['cat']));
if ((strlen(trim($all_child_categories))) != 0){
    $all_child_categories = " And pds_category.id in($all_child_categories)";
}else{
$all_child_categories = "";
}

 }

 if ($ispromotion == 1){
    $sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT pds_list.*, pds_list_promotions.id as tmp_promo_id FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE pds_list_promotions.end_date>=CURDATE() AND state='apr' $all_child_categories ORDER BY  pds_list.firm LIMIT $xalimit,$yalimit;";
  }else{
    $sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT pds_list.* FROM $pds_list left outer join pds_list_promotions on pds_list.id = pds_list_promotions.list_id
inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category   on pds_category.id = pds_listcat.cat_id WHERE state='apr' ORDER BY pds_list.firm LIMIT $xalimit,$yalimit;";
 }
    //echo "sql=$sql";
    //exit;
    $r_list = mysql_query($sql);
 /*
    $r_list = mysql_query ("SELECT SQL_CALC_FOUND_ROWS Distinct l.*
	FROM $pds_listcat lc INNER JOIN $pds_list l ON lc.list_id=l.id
	inner join pds_category c  on lc.cat_id = c.id
	WHERE  state='apr' $all_child_categories
	ORDER BY l.premium DESC, l.firm LIMIT $xalimit,$yalimit;");
*/

	SmartyPaginate::setURL("index.php?cat=$_GET[cat]{$smarty_url_string}",'list');
	$r2 = mysql_query("SELECT FOUND_ROWS() as total;");
	$f2 = mysql_fetch_assoc($r2);
  //include "sublist_promotion.php" ;
    $list=getMeListFromRecords($r_list,0,$all_child_categories);
    SmartyPaginate::setTotal($f2['total'],'list');
	SmartyPaginate::assign($tpl,'paginate_list','list');
}else{

//***********************************************
// Process Main Index
//***********************************************

	//***********************************************
	// Title Tag
	//***********************************************
	$title_tag = $language->desc('site_text',$lang_set,'main_title');
	$_GET['cat'] = 0;
	$mod_title = str_replace(' ','_',$title_tag);
	$mod_title = str_replace('/','-',$mod_title);

	//***********************************************
	// Breadcrumb Link
	//***********************************************

	//***********************************************
	// Language Select List
	//***********************************************
	$tpl-> assign('lang_select_box', $language->select('code_lang', $lang_set, array('value'=>$lang_set,'options' => 'onchange="submit()"')));

	//***********************************************
	// Template Select List
	//***********************************************
	$tpl-> assign('template_select_box', $language->select('template', $lang_set, array('value'=>$config['deftpl'],'options' => 'onchange="submit()"')));

	$tpl-> assign('disp_page', 'main_index');

	$tpl-> assign('show_page','index_subs');
}

//***********************************************
// Assign local variables to template
//***********************************************

$tpl-> assign('title_tag',$title_tag);
$tpl-> assign('bread_crumb',$bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('main_title',$language->desc('site_text',$lang_set,'main_title'));
$tpl-> assign('list',$list);
$tpl-> assign('cat_id',$_GET['cat']);
$tpl-> assign('mod_title',$mod_title);
$tpl-> assign('ispromotion',$ispromotion);
// Show Template
$tpl-> display("$config[deftpl]/index.tpl");

?>