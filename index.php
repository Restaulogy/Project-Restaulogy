<?php 
 include("init.php");

 /*include("user/header.php"); */
 $title = $_lang['home'];/*
 include("user/index.php"); 
 include("user/footer.php");*/
 //if($Global_member['member_role_id']==1){
if(($sesslife==true) && (is_not_empty($_SESSION['curr_sess_p'])) && ($_SESSION['curr_sess_p']=='restaulogy')){
	echo "<script>window.location.href='{$website}/user/rest_dashboard.php'</script>";
}elseif(($sesslife==true) && (in_array($Global_member['member_role_id'], array(ROLE_WAITER)))){
	//.. array(ROLE_MANAGER,ROLE_WAITER)
 	//echo "<script>window.location.href='{$website}/user/pending_requests.php'</script>";
	echo "<script>window.location.href='{$website}/user/tbl_alerts.php'</script>";	
}else{
 	echo "<script>window.location.href='{$website}/user/index.php'</script>";
} 
?>