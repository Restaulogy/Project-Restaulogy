<?php
include_once (dirname(dirname(__FILE__)))."/init.php"; 

$objtbl_dishes = new tbl_dishes();

$tbl_disheslist = $objtbl_dishes->readArray(array(OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on),$result_found,1);

	$allpageCount = 0;
	$currentPage = 0;
$pagination = biz_pagination(array("url"=>$navigationURL,LIMIT_TITLE=>$limit,OFFSET_TITLE=>$offset,"count"=>$result_found),$allpageCount,$currentPage));


 
?>
 