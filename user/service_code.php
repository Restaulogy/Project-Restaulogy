<?php

  include_once(dirname(dirname(__FILE__))."/init.php");
  include("header.php");
  $bycust = get_input("bycust", 0);  
  if($sesslife==true || $bycust == 1){
  	
  
  	$mode = get_input("mode"); 
  	$action = strtoupper(get_input("action"));
	$success = strtoupper(get_input("success"));
  	$srvc_id = get_input("srvc_id",0);
  	$srvc_name =get_sql_input("srvc_name");
	$srvc_description =get_sql_input("srvc_description");

	$table_id = get_input("table_id", 0);
	$created_by = get_input("created_by", "");
	$srvc_by_restrnt_or_cust =get_sql_input("srvc_by_restrnt_or_cust");
	$srvc_start_date =get_sql_input("srvc_start_date");
	$srvc_end_date =get_sql_input("srvc_end_date");
   $obj = new tbl_services_code();
  if(is_not_empty($action)){
   
    $validForm = true;
	$err = "";
	if(is_not_empty($srvc_name)){
		$err .= "<p class='error'>Please, Enter Name</p>";
	}
	if(is_not_empty($srvc_description)){
		$err .= "<p class='error'>Please, Enter Description</p>";
	}
	
	if($action == "DELETE" || $action == "UPDATE"){
		if(is_gt_zero_num($srvc_id)){
			$err .= "<p class='error'>Please, Select Service</p>";
		}	
	}
	$isSuccess = 0;
	if($action == "UPDATE"){
		$isSuccess = $obj->update($srvc_id,$srvc_name,$srvc_description,$srvc_start_date,$srvc_end_date,$srvc_by_restrnt_or_cust); 
		if($isSuccess){ 
			echo "<script>window.location.href='{$website}/user/service_code.php?srvc_id=$srvc_id&mode=view&success=update'</script>";
		}else{ 
			$err .= "<div class='errorbox'>".$_lang['services_code']["UPDATE"]["FAILURE_MSG"]."</div>";
		}
	}elseif($action == "CREATE"){ 
	    
		
		
		$srvc_id = $obj->create($srvc_name,$srvc_description,$srvc_by_restrnt_or_cust);
		
		if($srvc_id){
		   if($bycust){
				echo "<script>window.location.href='{$website}/user/services_request.php?table_id={$table_id}&service_id={$srvc_id}&created_by={$created_by}'</script>";
			}else{
				echo "<script>window.location.href='{$website}/user/service_code.php?srvc_id=$srvc_id&mode=view&success=create'</script>";
			}
			
		}else{
			$err .= "<div class='errorbox'>".$_lang['services_code'][$action]["FAILURE_MSG"]."</div>";
		}
			
	}elseif($action == "DELETE"){
		$isSuccess = $obj->delete(array("srvc_id"=>$srvc_id)); 
		echo "<script>window.location.href='{$website}/user/service_codes.php?action=delete&isSuccess={$isSuccess}'</script>"; 
		exit;
	} 
	 
	 
  
  } 
 
   if($mode=="new"){
  	 $template= "service_code_new.tpl"; 
  }else{
  	 $info = array();
	 
     if(is_gt_zero_num($srvc_id)){ 
		$info = $obj->GetInfo($srvc_id);		
	 }
 	 
	 if($success){
			$err .= "<div class='infobox'>".$_lang['services_code']["{$success}"]["SUCCESS_MSG"]."</div>";
	 } 
	 
	 
	 $smarty->assign("serviceinfo",$info);
  	 $template= "service_code_update.tpl"; 
  } 
  
  }else{
  	$template= "index.tpl"; 
  }
  
   	$smarty->assign("bycust", $bycust);
	$smarty->assign("qr_code", $bycust);
    $smarty->assign("table_id", $table_id);
	$smarty->assign("created_by", $created_by);  
   
   $smarty->assign("mode",$mode);
  include("footer.php");  

?>