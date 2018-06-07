<?php  
  
  include_once(dirname(dirname(__FILE__))."/init.php");
  include("header.php");
  if($sesslife==true){
  $obj = new tbl_services_code();
  $url = $website."/user/service_codes.php";
  $offset = get_input("offset",0);
  $limit = get_input("limit",2);
  $isSuccess = get_input("isSuccess","");
  $action =  strtoupper(get_input("action",""));
  $info =  $obj->GetAll($url,$offset,$limit);
  unset($obj);
  $err=""; 
  If(is_not_empty($action) && is_not_empty($isSuccess)){
  	
     if(is_gt_zero_num($isSuccess)){
	 
	 	$err = "<div class='infobox'>".$_lang['services_code'][$action]["SUCCESS_MSG"]."</div>";
	 }else{
	 	$err = "<div class='errorbox'>".$_lang['services_code'][$action]["FAILURE_MSG"]."</div>";
	 }  
  }
   
  $smarty->assign('info',$info);
  $template= "service_codes.tpl";
  }else{
  	$template= "index.tpl"; 
  } 
  include("footer.php");  
?> 
