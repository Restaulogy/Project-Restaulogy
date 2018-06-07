<?php

include_once(dirname(dirname(__FILE__))."/init.php");
include("header.php");

 if($sesslife == true){ 
	$template = "grid_control.tpl";
 }else{
 	$template = "index.tpl";
 }  
include("footer.php");
?>