<?php
include_once dirname(dirname(__FILE__)). "/init.php"; 
$arr = array();
$id = (is_not_empty($_REQUEST["id"])?$_REQUEST["id"]:"");
$selected = (is_not_empty($_REQUEST["selected"])?$_REQUEST["selected"]:"");

if(is_not_empty($_REQUEST["search"])){ 
  switch ($_REQUEST["search"]){ 
	case "country" 	: 	$arr = getCountries(); 
					 	break;
 	case "states" 	: 	$arr = getStates($id); 
					 	break;
	case "city" 	: 	$arr = getCities($id); 
					 	break;
  }	   	
}
 
 if(is_not_empty($arr)){
  
 	echo TAB."<option>Select</option>".NL;
    foreach($arr as $key=>$val) {
	    if(is_not_empty($selected) && $selected==$key){
			echo TAB."<option value=\"{$key}\" selected=\"selected\">{$val}</option>".NL;
		}else{
			echo TAB."<option value=\"{$key}\">{$val}</option>".NL;
		} 
    }
 } 
?>