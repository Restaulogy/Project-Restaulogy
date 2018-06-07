<?php

include_once dirname(dirname(__FILE__)). "/init.php";
   $x = 0; 
if(elgg_is_not_empty($_REQUEST['state']) || elgg_is_gt_zero_num($_REQUEST['metro'])) {
	$sql_condition = "";
	if(elgg_is_not_empty($_REQUEST['state'])){
		$sql_condition .=" AND hm_states.name ='".$_REQUEST['state']."'"; 
	}
	if(elgg_is_not_empty($_REQUEST['metro'])){
		$sql_condition .=" AND METRO_ID ='".$_REQUEST['metro']."'";
	}	
$stmt = "SELECT 
				hm_cities.ID, hm_cities.NAME 
         FROM 
		 		hm_cities  
		 INNER JOIN 
		 		 hm_states 
		 ON 
		 		hm_states.abbrev = hm_cities.ST 
         WHERE 1 {$sql_condition} 
			ORDER BY hm_cities.NAME ASC;";
$res = mysql_query($stmt);
   //echo $stmt;
if($res){ 
    while ($row = mysql_fetch_assoc($res)) {   
		 echo "<option value=\"{$row['NAME']}\">{$row['NAME']}</option>";
		 $x++;
    }
    mysql_free_result($res);
}
}

if($x == 0){
	echo "<option>Select City</option>";
}
 exit;
 ?>