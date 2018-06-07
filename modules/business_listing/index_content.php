<?php

include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");
SmartyPaginate::connect('cat');
SmartyPaginate::connect('list');
if (!$_GET['nc']){
	SmartyPaginate::reset('cat');
}
if (!$_GET['nl']){
	SmartyPaginate::reset('list');
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
	$r = mysql_query ("SELECT SQL_CALC_FOUND_ROWS * FROM $pds_category WHERE p IS NULL ORDER BY title LIMIT $xlimit,$ylimit;") or die("Error getting main categories: ".mysql_error());
	$main_cat=1;
}
$r1 = mysql_query("SELECT FOUND_ROWS() as total;");
$f1 = mysql_fetch_assoc($r1);
$r_rows = mysql_num_rows($r);
for ($x=0;$x<$r_rows;$x++){
	$f = mysql_fetch_array($r);
	$categories[$x]['id'] = $f['id'];
	$categories[$x]['title'] = $language->desc('category',$lang_set,$f['id']);
	//$listcount = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM $pds_listcat WHERE cat_id='$f[id]'"));
	$listcount = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM $pds_listcat lc INNER JOIN $pds_list l ON lc.list_id = l.id WHERE lc.cat_id='$f[id]' AND l.state='apr'"));
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
      $r_sub = mysql_query("SELECT * FROM $pds_category WHERE p='$f[id]' ORDER BY title LIMIT 0,5;");
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
         $categories[$x]['href'] = "<a href=\"index.php?cat=".$categories[$x]['id']."\">".$categories[$x]['title']."</a>";
         if ($rs_rows){
            for ($y=0;$y<$rs_rows;$y++){
               $f_sub = mysql_fetch_assoc($r_sub);
               /*if ($y != 0 or $y != $rs_rows-1){
                  $categories[$x]['sub'] .= " | ";
               }
               */
               $categories[$x]['sub'] .= "<a href=\"index.php?cat=".$f_sub['id']."\">".$f_sub['title']."</a>&nbsp;|";
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
	$title[] =$f_cat[title];
	$cid[] = $f_cat[id];
	$parent = $f_cat[p];
	while ($parent == true){
		$rbc = mysql_query ("SELECT * FROM $pds_category WHERE id='$parent';");
		$fbc = mysql_fetch_assoc($rbc);
		/*$title[] = $language->desc("category",$lang_set,$fbc[id]);*/
		$title[] =$fbc[title];
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
				$btn_link[$x] = "onClick=\"document.location.href='./index.php?cat=".$cid[$x]."'\"";
			}
		}
	}
	$tpl-> assign('show_page','index_sub');

	//***********************************************
	// Listings
	//***********************************************



	$r_list = mysql_query ("SELECT SQL_CALC_FOUND_ROWS * FROM $pds_listcat lc INNER JOIN $pds_list l ON lc.list_id=l.id WHERE cat_id='$_GET[cat]' AND state='apr' ORDER BY l.premium DESC, l.firm LIMIT $xalimit,$yalimit;");
	SmartyPaginate::setURL("index.php?cat=$_GET[cat]",'list');
	$r2 = mysql_query("SELECT FOUND_ROWS() as total;");
	$f2 = mysql_fetch_assoc($r2);
	for ($x=0;$x<mysql_num_rows($r_list);$x++){
		$list[$x] = mysql_fetch_assoc($r_list);
		$list_upd = $list[$x][id];
		mysql_query("UPDATE $pds_liststats SET sub_views=sub_views+1 WHERE list_id='$list_upd';");

		$check_file = "sublist".$list[$x][level].".tpl";
		if (is_readable("templates/$config[deftpl]/sublist/$check_file")){
			$list[$x][subfile] = $check_file;
		}else{
			$list[$x][subfile] = "sublist0.tpl";
		}
		if($x%2){
			$list[$x][bgcolor] = $config['bg_dark'];
		}else{
			$list[$x][bgcolor] = $config['bg_light'];
		}
		$check_file = $list[$x]['id'].".".$list[$x]['logo_ext'];
		if ($list[$x]['logo_ext'] != "" AND is_readable("logo/$check_file")){
			$list[$x]['logo'] = "$config[mainurl]/logo/$check_file?".rand();
		}
		$list[$x]['mod_firm'] = str_replace(" ","_",$list[$x]['firm']);
		$list[$x]['mod_firm'] = str_replace("/","-",$list[$x]['mod_firm']);

	  $list[$x]['tip_firm'] = addslashes(htmlentities($list[$x]['firm']));
      $list[$x]['tip_phone'] = addslashes(htmlentities($list[$x]['phone']));
      $list[$x]['tip_address'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list[$x]['address1'])));
      $list[$x]['tip_description'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list[$x]['description'])));
      $list[$x]['desc_elipsis'] = snippet($list[$x]['description']);
	$sql =  mysql_fetch_row(mysql_query("SELECT count( id ) FROM pds_list_promotions WHERE list_id =".$list[$x]['id']));
	$promotion_count = $sql[0];

	if ($promotion_count > 0)
	    {
             $list[$x]['promotion'] = 1 ;
             $result =  mysql_query("SELECT * FROM pds_list_promotions WHERE list_id=".$list[$x]['id']) or die(mysql_error());

 $row = mysql_fetch_array($result);

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

  		$list[$x]['promotion_title'] =string_replace_for_sql($row['title']);
		$list[$x]['promotion_pdf_1'] =$row['pdf_1'];
        $list[$x]['promotion_pdf_1_name'] = $pdf_name1;
	 	$list[$x]['promotion_pdf_2'] =$row['pdf_2'];
	 	$list[$x]['promotion_pdf_2_name'] = $pdf_name2 ;

		}
	else
	    {
            $list[$x]['promotion'] = 0 ;
		}
	}
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

?>
