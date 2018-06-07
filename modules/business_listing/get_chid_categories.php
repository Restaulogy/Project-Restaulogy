<?php

//	include('dbcon.php');
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

if($_REQUEST)
{
	$id 	= $_REQUEST['parent_id'];
	$query = "select * from metro_area where metro_abv = (select abbrev from pds_states where id = $id) order by metro_name";

    $results = mysql_query($query);?>


	<?php
	while ($rows = mysql_fetch_assoc(@$results))
	{?>
		<option value="<?php echo $rows['metro_id'];?>"  ID="<?php echo $rows['metro_id'];?>"><?php echo $rows['metro_name'];?></option>
	<?php
	}?>

	
<?php	
}
?>
