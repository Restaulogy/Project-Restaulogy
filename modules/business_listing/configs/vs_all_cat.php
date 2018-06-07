<?php
// Category Variable Set
$r = mysql_query ("SELECT * FROM $pds_category WHERE p IS Not NULL ORDER BY title;");
for ($x=0;$x<mysql_num_rows($r);$x++){
   $f = mysql_fetch_array($r);
   $vs_sub_cat[$x]['id'] = $f['id'];
   $vs_sub_cat[$x]['title'] = $language->desc('category',$lang_set,$f['id']);
   if ($f[f_mt] != "" OR !$config['disable_empty_cat']){
      if($config['rewrite']){
         $mod_id = $vs_sub_cat[$x]['id'];
         $mod_title = str_replace(' ','_',getCatPath($f['id']));
         $mod_title = str_replace('/','-',$mod_title);
         $vs_sub_cat[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$vs_sub_cat[$x]['title']."</a>";
      }else{
         $vs_sub_cat[$x]['href'] = "<a href=\"index.php?cat=".$vs_sub_cat[$x]['id']."\">".$vs_sub_cat[$x]['title']."</a>";
      }
   }else{
      $vs_sub_cat[$x]['href'] = $vs_sub_cat[$x]['title'];
   }
}
$tpl-> assign('vs_sub_cat',$vs_sub_cat);
mysql_free_result($r);
?>
