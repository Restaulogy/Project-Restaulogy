<?php
include_once dirname(dirname(__FILE__)). "/init.php"; 
/*

*/
//if($_REQUEST)
if(isset($_REQUEST['parent_id']))
{
	$id 	= $_REQUEST['parent_id'];
	$query = "select * from metro_area where metro_abv = (select abbrev from pds_states where id = $id) order by metro_name";

    $results = mysql_query($query);

    if($results){
         while ($row = mysql_fetch_assoc($results)) {
           echo "<option value=\"".$row["metro_id"]."\">".$row["metro_name"]."</option>";
        }
        mysql_free_result($results);
    }
}
