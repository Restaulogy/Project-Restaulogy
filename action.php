<?php
include("init.php");
$prev_page = $_SERVER['HTTP_REFERER'];
 
switch($_REQUEST['action']){
	case "approve_admin": $obj = new hm_md_admins();
						  $obj->Approve_MD_ADMIN($_REQUEST['id'], 0);
						  break;
	case "deny_admin": 	 $obj = new hm_md_admins();
						 $obj->Approve_MD_ADMIN($_REQUEST['id'], 1);
						  break;
						  
	//..  facility control approve_staff
    case "approve_staff": $obj = new hm_tbl_staff();
						  $obj->updateStatus($_REQUEST['id'], 0);
						  break;
	case "deny_staff": 	 $obj = new hm_tbl_staff();
						 $obj->updateStatus($_REQUEST['id'], 1);
						  break;
						  
	case "activate_allergy":   
						 $obj = new hm_allergy();
						 $obj->updateStatus($_REQUEST['id'], 0);
						  break;
	case "deactivate_allergy": 	 $obj = new hm_allergy();
						 $obj->updateStatus($_REQUEST['id'], 1);
						  break;
	case "activate_md":  $obj = new hm_patient_md();
						 $obj->updateStatus($_REQUEST['id'], 0);
						  break;
	case "deactivate_md":$obj = new hm_patient_md();
						 $obj->updateStatus($_REQUEST['id'], 1);
						  break;

    //..patient approve dey the facility
    case "approve_facility":  $obj = new hm_patient_facility();
						 $obj->updateStatus($_REQUEST['id'], 0);
						 break;
	case "deny_facility": $obj = new hm_patient_facility();
						 $obj->updateStatus($_REQUEST['id'], 1);
						  break;
						  
	//..patient activate deactivate the facility
    case "activate_facility":  $obj = new hm_facility();
						 $obj->updateStatus($_REQUEST['id'], 0);
						 break;
	case "deactivate_facility": $obj = new hm_facility();
						 $obj->updateStatus($_REQUEST['id'], 1);
						  break;
	
	case "activate_drug":$obj = new hm_drug_codes();
                         $obj->updateStatus($_REQUEST['id'], 0);
						 break;
	case "deactivate_drug": 
	 					 $obj = new hm_drug_codes();
						 $obj->updateStatus($_REQUEST['id'], 1);
						  break;
	case "activate_pt_drug": 	
						 $obj = new hm_patient_drugs(); 
						 $obj->updateStatus($_REQUEST['id'], 0);
						  break;
	case "deactivate_pt_drug": 
	 					 $obj = new hm_patient_drugs();
						 $obj->updateStatus($_REQUEST['id'], 1);
						  break;
	case "activate_pt_allergy": 	
						 $obj = new hm_patient_allergy(); 
						 $obj->updateStatus($_REQUEST['id'], 0);
						  break;
	case "deactivate_pt_allergy": 
	 					 $obj = new hm_patient_allergy();
						 $obj->updateStatus($_REQUEST['id'], 1);
						  break;
											
						  
	 
} 
  if($_SERVER['HTTP_REFERER'] != $_SERVER['PHP_SELF']) 
  	echo "<script>window.location.href=\"".modify_url(array("f_mode"=>"view"),$_SERVER['HTTP_REFERER'])."\"</script>";
  exit;
?>
