<?php

  include_once(dirname(dirname(__FILE__))."/init.php");
  include("header.php");
   
if($sesslife==true && is_gt_zero_num($_SESSION[SES_RESTAURANT])){ 
 
  	$mode = get_input("mode"); 
  	$action = strtoupper(get_input("action"));
	$success = strtoupper(get_input("success")); 
	$restaurent_id = get_sql_input("restaurant_id",$Global_member['restaurent']);
	$restaurent_owner = get_sql_input("restaurent_owner");
	$restaurent_name = get_sql_input("restaurent_name");
	$restaurent_address = get_sql_input("restaurent_address");
	$restaurent_country = get_sql_input("restaurent_country", "US");
	$restaurent_state = get_sql_input("restaurent_state");
	$restaurent_city = get_sql_input("restaurent_city");
	$restaurent_zip = get_sql_input("restaurent_zip");
	$restaurent_phone_1 = get_sql_input("restaurent_phone_1");
	$restaurent_phone_2 = get_sql_input("restaurent_phone_2");
	$restaurent_start_date = get_sql_input("restaurent_end_date");
	$restaurent_end_date = get_sql_input("restaurent_end_date");
	
   
   	$obj = new tbl_restaurent(); 
	
  if(is_not_empty($action)){
   
    $validForm = true;
	$err = "";
	if(is_not_empty($restaurent_owner)){
		$err .= "<p class='error'>{$_lang['restaurant']['non_empty_msg']['owner']}</p>";
	}
	if(is_not_empty($restaurent_name)){
		$err .= "<p class='error'>{$_lang['restaurant']['non_empty_msg']['name']}</p>";
	}
	if(is_not_empty($restaurent_address)){
		$err .= "<p class='error'>{$_lang['restaurant']['non_empty_msg']['address']}</p>";
	}
	if(is_not_empty($restaurent_country)){
		$err .= "<p class='error'>{$_lang['restaurant']['non_empty_msg']['country']}</p>";
	}
	if(is_not_empty($restaurent_state)){
		$err .= "<p class='error'>{$_lang['restaurant']['non_empty_msg']['state']}</p>";
	}
	
	if(is_not_empty($restaurent_zip)){
		$err .= "<p class='error'>{$_lang['restaurant']['non_empty_msg']['zip']}</p>";
	}
	
	if(is_not_empty($restaurent_phone_1)){
		$err .= "<p class='error'>{$_lang['restaurant']['non_empty_msg']['phone_1']}</p>";
	}
	if(is_not_empty($restaurent_phone_2)){
		$err .= "<p class='error'>{$_lang['restaurant']['non_empty_msg']['phone_2']}</p>";
	} 
	if(is_gt_zero_num($restaurent_id)){
		$err .= "<p class='error'>{$_lang['restaurant']['non_empty_msg']['id']}</p>";
	}	
	 
	$isSuccess = 0;
	if($action == "UPDATE"){
		$isSuccess = $obj->update($restaurent_id,$restaurent_owner,$restaurent_name,$restaurent_address,$restaurent_country,$restaurent_state,$restaurent_city,$restaurent_zip,$restaurent_phone_1,$restaurent_phone_2,$restaurent_start_date,$restaurent_end_date); 
		if($isSuccess){ 
			echo "<script>window.location.href='{$website}/user/restaurant.php?restaurant_id=$table_id&mode=view&success=update'</script>";
		}else{ 
			$err .= "<div class='errorbox'>".$_lang['restaurant']["UPDATE"]["FAILURE_MSG"]."</div>";
		}
	 } 
  }  
  	 $info = array();
	 
     if(is_gt_zero_num($restaurent_id)){ 
		$info = $obj->GetInfo($restaurent_id);		
	 }
 	 
	 if($success){
			$err .= "<div class='infobox'>".$_lang['restaurant']["{$success}"]["SUCCESS_MSG"]."</div>";
	 } 
	  
	 $smarty->assign("restaurantinfo",$info);
  	 $template= "restaurant.tpl"; 
     
}else{
  	$template= "index.tpl"; 
} 
$smarty->assign("mode",$mode);
include("footer.php");  


	 

?>