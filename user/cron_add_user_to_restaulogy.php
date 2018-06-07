<?php 
ini_set('max_execution_time', 0); 
//include_once(dirname(dirname(__FILE__)).'/init.php');
include("../service_init.php");
include_once('header.php');
//..Get input

//..required for upsert
$password = 'sample' ;

/*//..CODE TO ADD RESTAULOGY USER VIRTUAL RESTAURANT
//..first check which are the users for restaulogy
$sql=  'SELECT DISTINCT `staff_phone`,`staff_lname`, `staff_fname`, COUNT(`staff_phone`) as `cntInstRec` FROM `tbl_staff` GROUP BY `staff_phone` HAVING `cntInstRec`>6';
$new_usr=DB::ExecQry($sql);
//print_r($new_usr);
foreach($new_usr as $_ph){
	//..check if phone is valid	then only proceed
	if(is_not_empty($_ph[STAFF_PHONE]) && (isValidPhone($_ph[STAFF_PHONE]))){
		$email	= "exusr_"._get_lst_member_id()."@tst.com";
		$_reg_rs_2=serv_registerME($email,$password,0,$_ph[STAFF_FNAME],$_ph[STAFF_LNAME],$_ph[STAFF_PHONE],1,0,0,1,16,0,NULL,'','R');
	}
}
echo "Added successfully to restaulogy";
exit;*/


//...Get all virtual restaurant users add all users to all restaurant
$new_restaurant=36;
$lst_vir_rest_usr= tbl_staff::readArray(array(STAFF_RESTAURENT => 16));
echo "COUNT=".count($lst_vir_rest_usr);

foreach($lst_vir_rest_usr as $_ech_mbr){
	//..Add user to all restaurants 			
	$usrDetails=_sign_to_all_rest($_ech_mbr[STAFF_PHONE],$password,$_ech_mbr[STAFF_FNAME],$_ech_mbr[STAFF_LNAME],$new_restaurant);	
}	
echo "Completed successfully";	
exit;
			
?>