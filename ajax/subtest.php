<?php
 include_once (dirname(dirname(__FILE__)))."/init.php"; 
$result = $_REQUEST["submenuList"];
/*foreach($result as $value) {
	echo "$value : ";
}*/  
$listingCounter = 1;

 

foreach ($result as $value) {
		if(is_gt_zero_num($value)){
		$query = "UPDATE  `tbl_sub_menu` SET submnu_display_order = " . $listingCounter . " WHERE submnu_id = " . $value;
		 //echo $query."<br>"; 
			mysql_query($query) or die('Error, insert query failed');
			$listingCounter = $listingCounter + 1;		
		} 
	}
?>
 