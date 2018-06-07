<?php
$vs_all_cat=array();
$vs_cat=array();
$vs_sub_cat=array();
$tpl-> assign('vs_all_cat',$vs_all_cat);
$tpl-> assign('vs_cat',$vs_cat);
$tpl-> assign('vs_sub_cat',$vs_sub_cat);
/*
// Category Variable Set
$r = mysql_query ("SELECT * FROM $pds_category ORDER BY title;");
$cnt_cat=mysql_num_rows($r);
for ($x=0;$x<$cnt_cat;$x++){
   $f = mysql_fetch_array($r);
   $vs_all_cat[$x]['id'] = $f['id'];
   if  (is_null ( $f['p'] )){
       	$vs_all_cat[$x]['pid']= 0;
   }else{
        $vs_all_cat[$x]['pid']= $f['p'];
	}
  // $vs_all_cat[$x]['title'] = $language->desc('category',$lang_set,$f['id']);
    $vs_all_cat[$x]['title'] = $f['title'];
   if ($f[f_mt] != "" OR !$config['disable_empty_cat']){
      if($config['rewrite']){
         $mod_id = $vs_all_cat[$x]['id'];
         $mod_title = str_replace(' ','_',getCatPath($f['id']));
         $mod_title = str_replace('/','-',$mod_title);
         $vs_all_cat[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$vs_all_cat[$x]['title']."</a>";
      }else{
         $vs_all_cat[$x]['href'] = "<a href=\"index.php?cat=".$vs_all_cat[$x]['id']."\">".$vs_all_cat[$x]['title']."</a>";
        $vs_all_cat[$x]['start_date']=$f['start_date'];
        $vs_all_cat[$x]['end_date']=$f['end_date'];
        if((!(is_null($f['end_date'])))&& (strtotime($f["end_date"])<strtotime("now")))
        	$vs_all_cat[$x]['isdisable']= 1;
        else
            $vs_all_cat[$x]['isdisable']= 0;
         //$vs_cat[$x]['menu_href'] = "<span class=\"folder\" onclick=\"showlisting(".$vs_all_cat[$x]['id'].")\">".$vs_all_cat[$x]['title']."</span>";
      }
   }else{
      $vs_all_cat[$x]['href'] = $vs_all_cat[$x]['title'];
   }
}

$disable_root_catlist = array();
$tmpCnt = 0;
foreach($vs_all_cat as $tmpCat){
  if(($tmpCat['isdisable'] == 1) && ($tmpCat['pid'] == 0)){
      $disable_root_catlist[$tmpCnt] =   $tmpCat['id'] ;
      $tmpCnt++;
  }
}

foreach($disable_root_catlist as $tmpCat1){
  $tmp_dis_cat = explode(",",get_child_with_paraent($tmpCat1));
  for($tmp_cnt =0; $tmp_cnt<$x; $tmp_cnt++){
   if(in_array($vs_all_cat[$tmp_cnt]['id'],$tmp_dis_cat))
          $vs_all_cat[$tmp_cnt]['isdisable'] = 1;
    }
}
$tpl-> assign('vs_all_cat',$vs_all_cat);
mysql_free_result($r);


// Category Variable Set
$r = mysql_query ("SELECT * FROM $pds_category WHERE p IS NULL ORDER BY title;");
$cnt_cat=mysql_num_rows($r);
for ($x=0;$x<$cnt_cat;$x++){
   $f = mysql_fetch_array($r);
   $vs_cat[$x]['id'] = $f['id'];
   $vs_cat[$x]['title'] = $f['title']; //$language->desc('category',$lang_set,$f['id']);
   if ($f[f_mt] != "" OR !$config['disable_empty_cat']){
      if($config['rewrite']){
         $mod_id = $vs_cat[$x]['id'];
         $mod_title = str_replace(' ','_',getCatPath($f['id']));
         $mod_title = str_replace('/','-',$mod_title);
         $vs_cat[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$vs_cat[$x]['title']."</a>";
      }else{
         $vs_cat[$x]['href'] = "<a href=\"index.php?cat=".$vs_cat[$x]['id']."\">".$vs_cat[$x]['title']."</a>";
         $vs_cat[$x]['menu_href'] = "<span class=\"folder\" onclick=\"showlisting(".$vs_cat[$x]['id'].")\">".$vs_cat[$x]['title']."</span>";
      }
   }else{
      $vs_cat[$x]['href'] = $vs_cat[$x]['title'];
   }
}
$tpl-> assign('vs_cat',$vs_cat);
mysql_free_result($r);

// Category Variable Set
$r = mysql_query ("SELECT * FROM $pds_category WHERE p IS NOT NULL ORDER BY title;");
$cnt_cat=mysql_num_rows($r);

for ($x=0;$x<50;$x++){   
   //echo "THERE-01..SELECT * FROM $pds_category WHERE p IS NOT NULL ORDER BY title;";
   $f = mysql_fetch_array($r);
   $vs_sub_cat[$x]['id'] = $f['id'];
   $vs_sub_cat[$x]['pid']= $f['p'];
   $vs_sub_cat[$x]['title'] = $f['title']; //$language->desc('category',$lang_set,$f['id']);
   if ($f[f_mt] != "" OR !$config['disable_empty_cat']){
   	  //echo "fmt=".$f[f_mt]." -dis - ".$config['disable_empty_cat']."=rewrite".$config['rewrite'];
			
      if($config['rewrite']){
         $mod_id = $vs_sub_cat[$x]['id'];
         
         $mod_title = str_replace(' ','_',getCatPath($f['id']));
         $mod_title = str_replace('/','-',$mod_title);
         
         $vs_sub_cat[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$vs_sub_cat[$x]['title']."</a>";
      }else{
         $vs_sub_cat[$x]['href'] = "<a href=\"index.php?cat=".$vs_sub_cat[$x]['id']."\">".$vs_sub_cat[$x]['title']."</a>";
         	$vs_sub_cat[$x]['menu_href'] = "<a href=\"#\"  onclick=\"showlisting(".$vs_sub_cat[$x]['id'].")\">".$vs_sub_cat[$x]['title']."</a>";
      }
   }else{
      $vs_sub_cat[$x]['href'] = $vs_sub_cat[$x]['title'];
   }   
}
*/

//mysql_free_result($r);
?>