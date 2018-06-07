<?php

include_once dirname(dirname(__FILE__)). "/init.php"; 

if ((isset($_REQUEST['country_code'])) && ($_REQUEST['country_code']!="")) {
    //..based on the text get the code
    $country_code=$_REQUEST['country_code'];

    $stmt = mysql_query("select id,name from pds_states WHERE country_id ='$country_code' order by name;");

    if($stmt){
        while ($row = mysql_fetch_assoc($stmt)) {
           echo "<option value=\"".$row["id"]."\">".$row["name"]."</option>";
        }
        mysql_free_result($stmt);
    }
}

