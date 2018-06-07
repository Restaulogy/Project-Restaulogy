<?PHP
$r = mysql_query("SELECT * FROM $pds_list WHERE state='apr' ORDER BY d_submit DESC LIMIT 0,3;");
for($x=0;$x<mysql_num_rows($r);$x++){
   $vs_recent[$x]=mysql_fetch_assoc($r);
   $x_id = $vs_recent[$x][id];
   $r_catlist = mysql_query("SELECT c.* FROM $pds_listcat lc INNER JOIN $pds_category c ON lc.cat_id=c.id WHERE lc.list_id='$x_id';");
   for($y=0;$y<mysql_num_rows($r_catlist);$y++){
    $f_catlist = mysql_fetch_assoc($r_catlist);
    $vs_rcatpath[$x][$y]['path'] = getCatPath($f_catlist['id']);
    $vs_rcatpath[$x][$y]['id'] = $f_catlist['id'];
    $vs_rcatpath[$x][$y]['mod_title'] = str_replace(' ','_',$vs_rcatpath[$x][$y]['path']);
    $vs_rcatpath[$x][$y]['mod_title'] = str_replace('/','-',$vs_rcatpath[$x][$y]['mod_title']);
   }
}
$tpl-> assign('vs_rcatpath',$vs_rcatpath);
$tpl-> assign('vs_recent',$vs_recent);
mysql_free_result($r);
?>
