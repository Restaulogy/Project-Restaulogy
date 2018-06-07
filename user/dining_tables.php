<?php  
  
  include_once(dirname(dirname(__FILE__))."/init.php");
  include("header.php");
  if($sesslife==true){
  $obj = new tbl_dining_table();
  $url = $website."/user/dining_tables.php";
  $offset = get_input("offset",0);
  $limit = get_input("limit",2);
  $isSuccess = get_input("isSuccess","");
  $action =  strtoupper(get_input("action",""));
  $info =  $obj->GetAll($url,$offset,$limit);
  unset($obj);
  
  $err=""; 
  If(is_not_empty($action) && is_not_empty($isSuccess)){
  	
     if(is_gt_zero_num($isSuccess)){
	 
	 	$err = "<div class='infobox'>".$_lang['dining_table'][$action]["SUCCESS_MSG"]."</div>";
	 }else{
	 	$err = "<div class='errorbox'>".$_lang['dining_table'][$action]["FAILURE_MSG"]."</div>";
	 }  
  }
   
   
   
  $smarty->assign('info',$info);
  $template= "dining_table.tpl";
  }else{
  	$template= "index.tpl"; 
  } 
  include("footer.php");  
?> 
