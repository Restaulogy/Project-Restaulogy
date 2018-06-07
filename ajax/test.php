<?php
 include_once (dirname(dirname(__FILE__)))."/init.php"; 
$result = $_REQUEST["tableList"];
/*foreach($result as $value) {
	echo "$value : ";
}*/  
$listingCounter = 1;

 

foreach ($result as $value) {
		if(is_gt_zero_num($value)){
		$query = "UPDATE  `tbl_submenu_dishes` SET sbmnu_dish_display_order = " . $listingCounter . " WHERE sbmnu_dish_id = " . $value;
		 //echo $query."<br>"; 
			mysql_query($query) or die('Error, insert query failed');
			$listingCounter = $listingCounter + 1;		
		} 
	}
?>
 