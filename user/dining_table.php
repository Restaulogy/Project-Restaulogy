<?php

  include_once(dirname(dirname(__FILE__))."/init.php");
  include("header.php");
   
  if($sesslife==true){ 
  	$mode = get_input("mode"); 
  	$action = strtoupper(get_input("action"));
	$success = strtoupper(get_input("success"));
  	$table_id = get_input("table_id",0);
  	$table_number =get_sql_input("table_number");
	$table_description =get_sql_input("table_description");
	$table_restaurant =get_sql_input("table_restaurant",$Global_member['restaurant']);
	$table_start_date =get_sql_input("table_start_date");
	$table_end_date =get_sql_input("table_end_date");
   	$obj = new tbl_dining_table(); 
	
  if(is_not_empty($action)){
   
    $validForm = true;
	$err = "";
	if(is_not_empty($table_number)==false){
		$err .= "<p class='error'>Please, Enter Number.</p>";
	
	}
	if(is_not_empty($table_description)==false){
		$err .= "<p class='error'>Please, Enter Description.</p>";
	}
	if(is_not_empty($table_restaurant)==false){
		$err .= "<p class='error'>Please, Select Restaurant.</p>";
	}
	
	if($action == "DELETE" || $action == "UPDATE"){
		if(is_gt_zero_num($table_id)){
			$err .= "<p class='error'>Please, Select Service</p>";
		}	
	}
	$isSuccess = 0;
	if($action == "UPDATE"){
		$isSuccess = $obj->update($table_id,$table_number,$table_description,$table_start_date,$table_end_date); 
		if($isSuccess){ 
			echo "<script>window.location.href='{$website}/user/dining_table.php?table_id=$table_id&mode=view&success=update'</script>";
		}else{ 
			$err .= "<div class='errorbox'>".$_lang['dining_table']["UPDATE"]["FAILURE_MSG"]."</div>";
		}
	}elseif($action == "CREATE"){ 
	    
		$table_id = $obj->create($table_number,$table_description,$table_restaurant);
		 
		if($table_id){
			echo "<script>window.location.href='{$website}/user/dining_table.php?table_id=$table_id&mode=view&success=create'</script>";
			exit;
		}else{
			$err .= "<div class='errorbox'>".$_lang['dining_table'][$action]["FAILURE_MSG"]."</div>";
		}
			
	}elseif($action == "DELETE"){
		$isSuccess = $obj->delete(array("table_id"=>$table_id)); 
		echo "<script>window.location.href='{$website}/user/dining_tables.php?action=delete&isSuccess={$isSuccess}'</script>"; 
		exit;
	} 
	 
	 
  
  } 
 
   if($mode=="new"){
  	 $template= "dining_table_new.tpl"; 
  }else{
  	 $info = array();
	 
     if(is_gt_zero_num($table_id)){ 
		$info = $obj->GetInfo($table_id);		
	 }
 	 
	 if($success){
			$err .= "<div class='infobox'>".$_lang['dining_table']["{$success}"]["SUCCESS_MSG"]."</div>";
	 } 
	  
	 $smarty->assign("dininginfo",$info);
  	 $template= "dining_table_update.tpl"; 
  } 
  
  }else{
  	$template= "index.tpl"; 
  }
   $smarty->assign("mode",$mode);
  include("footer.php");  

?>