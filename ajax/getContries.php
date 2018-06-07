<?php

include_once dirname(dirname(__FILE__)). "/init.php"; 
 
$stmt = mysql_query("select country_iso,country_name from hm_country order by country_name;");

if($stmt){
    echo "<option value=\"0\">Select State</option>";
    while ($row = mysql_fetch_assoc($stmt)) {
       echo "<option value=\"".$row["name"]."\">".$row["name"]."</option>";
    }
    mysql_free_result($stmt);
}
?>