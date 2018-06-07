<?php

include_once dirname(dirname(__FILE__)). "/init.php";

if(isset($_POST['state_code'])) {

$stmt = mysql_query("SELECT s.name, a.metro_id, a.metro_name
                        FROM hm_states s
                        INNER JOIN metro_area a ON 
						s.abbrev = a.metro_abv
                        WHERE s.name LIKE '".$_POST['state_code']."'"); 

if($stmt){
	
	echo "<option value=\"0\">Select Metro Area</option>";
    while ($row = mysql_fetch_assoc($stmt)) {
	   if((isset($_POST['metro_area'])) && ($_POST['metro_area'] == $row["metro_id"])) {
		  echo "<option value=\"".$row["metro_id"]."\" selected='selected'>".$row["metro_name"]."</option>";
	   }else{
	   	  echo "<option value=\"".$row["metro_id"]."\">".$row["metro_name"]."</option>";
	   }
       
    }
    mysql_free_result($stmt);
}
}
