<?php

include_once dirname(dirname(__FILE__)). "/init.php";

if(isset($_POST['state_code'])) {

$stmt = mysql_query("SELECT hm_cities.ID, hm_cities.NAME 
                        FROM hm_cities inner join pds_states 
						ON pds_states.abbrev = hm_cities.ST
                        WHERE pds_states.name LIKE '".$_POST['state_code']."' ORDER BY hm_cities.NAME ASC;");

if($stmt){
	
	echo "<option value=\"0\">Select City</option>";
    while ($row = mysql_fetch_assoc($stmt)) {
	   if((isset($_POST['city'])) && ($_POST['city'] == $row["NAME"])) {
		  echo "<option value=\"".$row["NAME"]."\" selected='selected'>".$row["NAME"]."</option>";
	   }else{
	   	  echo "<option value=\"".$row["NAME"]."\">".$row["NAME"]."</option>";
	   }
       
    }
    mysql_free_result($stmt);
}
}
