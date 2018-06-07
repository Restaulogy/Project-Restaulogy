<?php
   $r = mysql_query ("SELECT * FROM pds_country WHERE iso IN ('US','IN') ORDER BY printable_name;");
//for ($x=0;$x<mysql_num_rows($r);$x++){
$x = 0;
while ($f = mysql_fetch_array($r, MYSQL_BOTH)) {

   //$f = mysql_fetch_array($r);
   $vs_country[$x]['iso'] = $f['iso'];
   $vs_country[$x]['name']= $f['printable_name'];
   $x++;
}
    $tpl-> assign('vs_country',$vs_country);
    mysql_free_result($r);

    // for country
    
    $r2 = mysql_query ("SELECT * FROM pds_states ORDER BY name;");
	$x = 0;
while ($f2 = mysql_fetch_array($r2, MYSQL_BOTH)) {
   //$f = mysql_fetch_array($r);
   $vs_states[$x]['id'] = $f2['id'];
   $vs_states[$x]['name']= $f2['name'];
   $vs_states[$x]['abbrev']= $f2['abbrev'];
   $x++;
}
  
    $tpl-> assign('vs_states',$vs_states);
    mysql_free_result($r2);
	$vs_metro_area = array();
	$tpl-> assign('vs_metro_area',$vs_metro_area);
	$tpl-> assign('vs_cities',$vs_cities);
		
/*    
    $r3 = mysql_query ("SELECT * FROM metro_area ORDER BY metro_name;");
	$x = 0;
		
	while ($f3 = mysql_fetch_assoc($r3)) { 
	   $vs_metro_area[$x]['id'] = $f3['id'];
	   $vs_metro_area[$x]['metro_name']= $f3['metro_name'];
	   $vs_metro_area[$x]['metro_abv']= $f3['metro_abv'];
	   $x++;
	}
    $tpl-> assign('vs_metro_area',$vs_metro_area);
    mysql_free_result($r3);
*/	 
	
/*
    $r = mysql_query ("SELECT * FROM pds_us_cities where ORDER BY city_name Limit 0 to 30;");
for ($x=0;$x<mysql_num_rows($r);$x++){
   $f = mysql_fetch_array($r);
   $vs_cities[$x]['city_zip'] = $f['city_zip'];
   $vs_cities[$x]['city_name']= $f['city_name'];
   $vs_cities[$x]['city_state']= $f['city_state'];
}
    $tpl-> assign('vs_cities',$vs_cities);
    mysql_free_result($r);
*/
?>