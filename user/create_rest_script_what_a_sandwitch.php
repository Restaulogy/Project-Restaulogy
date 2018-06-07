<?php
include_once(dirname(dirname(__FILE__))."/init.php");

unset($_SESSION);

//..Input Required for the New restaurant
$restaurent_name= 'What a Sandwich';
$restaurent_address= 'Plot 16, SR 235, New Airport Road, Sanjay Park, Opposite Rohan Mithila,Viman Nagar, Pune';
$restaurent_country= 'IN';
$restaurent_state= 'MH';
$restaurent_city= 44660;//44416;- mumbai 44660 -pune
$restaurent_zip= '411014';
$restaurent_phone_1= '7276077969';
$restaurent_phone_2= '9823999922';
$restaurent_email= 'owner_whatsandwich@whatsandwich.com';
$restaurent_online_ord_start= '00:00:00';
$restaurent_online_ord_end= '23:00:00';

//..Staff
//..1) Manager user
$staff_lname_A			= 'admn';
$staff_fname_A			= 'whatsandwich';
$staff_role_A			= ROLE_ADMIN ;
$staff_email_A			= 'admn_whatsandwich@whatsandwich.com'; 
$staff_password_A		= 'admn_whatsandwich';
$staff_phone_A			= '9000000178';
$staff_desigation_A		= 'ADMIN';
//..2) Manager user
$staff_lname_M			= 'mngr';
$staff_fname_M			= 'whatsandwich';
$staff_role_M			= ROLE_MANAGER ;
$staff_email_M			= 'mngr_whatsandwich@whatsandwich.com'; 
$staff_password_M		= 'mngr_whatsandwich';
$staff_phone_M			= '9000000179';
$staff_desigation_M		= 'MANAGER';
//..3) STAFF user
$staff_lname_S			= 'srvr';
$staff_fname_S			= 'whatsandwich';
$staff_role_S			= ROLE_WAITER ;
$staff_email_S			= 'srvr_whatsandwich@whatsandwich.com'; 
$staff_password_S		= 'srvr_whatsandwich';
$staff_phone_S			= '9000000180';
$staff_desigation_S		= 'SERVER';
//.. Server pin
$srv_pin_password= '1937';

$restaurent_owner= 0;
$restaurent_group= 1;
$restaurent_website= '';
$restaurent_description= '';
$restaurent_ethor_store = '';
$restaurent_is_paypal= 0;
$restaurent_paypal_email= '';
$restaurent_img = '';
$restaurent_fdbk_award_pts= 0;
$restaurent_rwd_multiplier= 0;

//...STAFF DATA
$staff_zip				= $restaurent_zip;
$staff_device_id		= '';
$staff_gcm_reg_id		= '';
$staff_description		= '';
$staff_start_date		= '';
$staff_end_date			= '';
$staff_restaurent		= $_REST_ID;
$staff_city				= $restaurent_city; 
$staff_state			= $restaurent_state; 
$staff_metro			= 0; 
$staff_country			= $restaurent_country;
$staff_fax				= '';
$staff_website			= $restaurent_website;
$staff_birth_date		= '';
$staff_aniversary_dt 	= '';	
$staff_loyalty_level	= 0;

//..Common variables
$_REST_ID=0;  //..Restaurant id
$_MNGR_ID=0;  //..Manager id
$_ADMIN_ID=0; //..Admin id
$_SEVR_ID=0;  //..server ID
$_TBL_TYP_ID=0; //..Table type ID
$_TBL_ID=0;  //..Table ID
$_SHIFT_ID=0;//.. Shift ID  
$_OPLOG=array(); //..capture all log

//echo "hello";
//..START STEP-1) Create a new restaurant
$isSuccess = "";
try{
$objtbl_restaurent= new tbl_restaurent();
$isSuccess = $objtbl_restaurent->create($restaurent_owner, $restaurent_name, $restaurent_address, $restaurent_country, $restaurent_state, $restaurent_city, $restaurent_zip, $restaurent_phone_1, $restaurent_phone_2,$restaurent_email,$restaurent_website,$restaurent_description, $restaurent_is_paypal, $restaurent_paypal_email,  $restaurent_online_ord_start,$restaurent_online_ord_end,$restaurent_img,$restaurent_ethor_store,$restaurent_fdbk_award_pts,$restaurent_rwd_multiplier,$restaurent_group);
unset($objtbl_restaurent);	
}catch(exception $e) {
  echo $e->getMessage()."\n" ;}
  //exit;
$action= ACTION_CREATE;
if(is_not_empty($isSuccess)){
	if(is_gt_zero_num($isSuccess)){		
		$_REST_ID=$isSuccess;
		$_SESSION[SES_RESTAURANT]=$_REST_ID;
	 	$_OPLOG[] = 'Restaurant Created Successfully.';
	}else{
		$_OPLOG[] = ' Problem in restaurant creation.';
	}
}
//..END STEP-1) Create a new restaurant

//..START  STEP-2) Add staff such as admin,manager and server
//..if restaurant is successfully created 
$isSuccess = "";
if(is_gt_zero_num($_REST_ID)){
//..STEP-2) 
	$obj_members = new members();	
	$staff_key  =   getGuid();
	$staff_join = date("d M Y");
	$staff_varified = 1;
		
	//... STEP-2 A] CREATE ADMIN 
	$staff_password_A = generate_encrypted_password($staff_password_A);	
	$isSuccess = $obj_members->create($staff_email_A,$staff_password_A,$staff_lname_A, $staff_fname_A,$staff_key, $staff_varified,$staff_join,$staff_role_A,$staff_zip,$staff_phone_A,$staff_address,$staff_desigation_A,$staff_device_id, $staff_gcm_reg_id, $staff_description,$staff_city,$staff_metro,$staff_state,$staff_country,$staff_fax, $staff_website,$_REST_ID,0,0,0,0,NULL,NULL,NULL,NULL);
	if(is_gt_zero_num($isSuccess)){
		$_ADMIN_ID=$isSuccess;
	 	$_OPLOG[] = 'Admin created successfully';
	}else{
		$_OPLOG[] = 'Error in creating Admin.';
	}
	//... STEP-2 B] CREATE MNANAGER 
	$staff_password_M = generate_encrypted_password($staff_password_M);		
	$isSuccess = $obj_members->create($staff_email_M,$staff_password_M,$staff_lname_M, $staff_fname_M,$staff_key, $staff_varified,$staff_join,$staff_role_M,$staff_zip,$staff_phone_M,$staff_address,$staff_desigation_A,$staff_device_id, $staff_gcm_reg_id, $staff_description,$staff_city,$staff_metro,$staff_state,$staff_country,$staff_fax, $staff_website,$_REST_ID,0,0,0,0,NULL,NULL,NULL,NULL);
	if(is_gt_zero_num($isSuccess)){
		$_MNGR_ID=$isSuccess;
	 	$_OPLOG[] = 'Manager created successfully';
	}else{
		$_OPLOG[] = 'Error in creating Manager.';
	}
	//... STEP-2 C] CREATE SERVER 
	$staff_password_S = generate_encrypted_password($staff_password_S);	
	$isSuccess = $obj_members->create($staff_email_S,$staff_password_S,$staff_lname_S, $staff_fname_S,$staff_key, $staff_varified,$staff_join,$staff_role_S,$staff_zip,$staff_phone_S,$staff_address,$staff_desigation_A,$staff_device_id, $staff_gcm_reg_id, $staff_description,$staff_city,$staff_metro,$staff_state,$staff_country,$staff_fax, $staff_website,$_REST_ID,0,0,0,0,NULL,NULL,NULL,NULL);
	if(is_gt_zero_num($isSuccess)){
		$_SEVR_ID =$isSuccess;
	 	$_OPLOG[] = 'Server created successfully';
	}else{
		$_OPLOG[] = 'Error in creating Server.';
	}
	
	unset($obj_members);	
//..END  STEP-2) Add staff such as admin,manager and server

//..START STEP-3) Create table type
	$isSuccess = '';
	$objtbl_table_type= new tbl_table_type();
	$isSuccess = $objtbl_table_type->create('Indoor tables', 'Indoor tables for dining', '', '');
	unset($objtbl_table_type);
	if(is_gt_zero_num($isSuccess)){
		$_TBL_TYP_ID=$isSuccess;
	 	$_OPLOG[] = 'Table type created successfully';
	}else{
		$_OPLOG[] = 'Error in creating Table type.';
	}
//..END STEP-3) Create table type

//..START STEP-4) Create table using table type
	if(is_gt_zero_num($_TBL_TYP_ID)){
		$isSuccess = '';
		$table_number= 'TB-1';
		$table_seating_capacity= 10;
		$table_type= $_TBL_TYP_ID;
		$table_desciption=  'Indoor tables for dining';
		$table_restaurant= $_REST_ID;
		$table_qr_code_link= '';
		$table_start_date= '';
		$table_end_date= '';
		//..for layout
		$table_pos_x= -1;
		$table_pos_y= -1;
		$table_dwg_width= 0;
		$table_dwg_height= 0;

		$objtbl_dining_table= new tbl_dining_table();
		$isSuccess = $objtbl_dining_table->create($table_number, $table_seating_capacity, $table_type, $table_desciption, $table_restaurant, $table_qr_code_link, $table_start_date, $table_end_date,$table_pos_x,$table_pos_y,$table_dwg_width,$table_dwg_height);
		unset($objtbl_dining_table);
		if(is_gt_zero_num($isSuccess)){
			$_TBL_ID=$isSuccess;
		 	$_OPLOG[] = 'Table created successfully';
		 	$_OPLOG[] = WWWROOT.'user/dashboard.php?table_id='.$_TBL_ID.'&frm_qrcd=1';
		 	
		}else{
			$_OPLOG[] = 'Error in creating Table.';
		}
	}	
//..END STEP-4) Create table using table type

//..END STEP-5) Create shift
	if(is_gt_zero_num($_TBL_TYP_ID)){
		$isSuccess = "";
		$shift_name= 'Regular';
		$shift_restaurent = $_REST_ID;
		$shift_start_time= '00:00:00';
		$shift_end_time= '23:59:00';
		$shift_created_on= date(DATE_FORMAT,strtotime("-1 day"));
		$shift_terminated_on=date(DATE_FORMAT ,strtotime("+10 year"));
		$sft_wkdy_sunday=$sft_wkdy_monday=$sft_wkdy_tuesday=$sft_wkdy_wednesday=$sft_wkdy_thursday=$sft_wkdy_friday=$sft_wkdy_saturday='Y';

		$objtbl_shift= new tbl_shift();
		$objtbl_shift_weekdays= new tbl_shift_weekdays();
		$isSuccess = $objtbl_shift->create($shift_name, $shift_start_time, $shift_end_time,$shift_restaurent,$shift_created_on,$shift_terminated_on);
		if(is_gt_zero_num($isSuccess)){
			$_SHIFT_ID=$isSuccess;
			$isSuccess =$objtbl_shift_weekdays->create($isSuccess ,$sft_wkdy_sunday ,$sft_wkdy_monday ,$sft_wkdy_tuesday ,$sft_wkdy_wednesday ,$sft_wkdy_thursday ,$sft_wkdy_friday ,$sft_wkdy_saturday);
		 	$_OPLOG[] = 'Shift created successfully';
		}else{
			$_OPLOG[] = 'Error in creating Shift.';
		}		
		unset($objtbl_shift);	
		unset($objtbl_shift_weekdays);	
	}
//..END STEP-5) Create table using table type

//..START STEP-6) Create Schedule
	if(is_gt_zero_num($_SHIFT_ID)){		
		$objtbl_emp_shift_assignment= new tbl_emp_shift_assignment();
		$emp_sft_employee		= $_SEVR_ID;
		$emp_sft_shift			= $_SHIFT_ID;
		$emp_sft_date			= date('Y-m-d');
		$emp_sft_tables			= $_TBL_ID;
		$emp_sft_start_date		= '';
		$emp_sft_end_date		= ''; 
		//..add emp shift for todays
		$isSuccess = $objtbl_emp_shift_assignment->create($emp_sft_employee, $emp_sft_shift, $emp_sft_date, $emp_sft_tables, $emp_sft_start_date, $emp_sft_end_date);
		if(is_gt_zero_num($isSuccess)){
			//..Now carry out the bulk copy schedule
			$single_date=$emp_sft_date;
			$dsr_from 	= date('Y-m-d',strtotime("+1 day")); 
			$dsr_to 	= date('Y-m-d',strtotime("+31 day"));			
			$dsr_dtfrom = strtotime($dsr_from); 
		 	$dsr_dtto 	= strtotime($dsr_to);
			$i 			= $dsr_dtfrom;
			$cnt 		= 0; 
			while($i<=$dsr_dtto) {
				 $dsr_dt[$cnt] 	= date('Y-m-d', $i);
				 $new_src[$cnt]	= $single_date;
				 $i 			= strtotime('+1 day',$i); 
				 $cnt++;
		 	}
			$isSuccess = $objtbl_emp_shift_assignment->copy_emp_shft_byDay($new_src,$dsr_dt,1,$emp_sft_employee,$emp_sft_shift);
			if(is_gt_zero_num($isSuccess)){				
			 	$_OPLOG[] = 'Schedule created successfully';
			}else{
				$_OPLOG[] = 'Error in creating Schedule.';
			}		
		}else{
			$_OPLOG[] = 'Error in creating shift assignment.';
		}			
		unset($objtbl_emp_shift_assignment);
	}			
//..END STEP-6) Create Schedule	

//..START STEP-7) Add rest menu options
	if(is_gt_zero_num($_REST_ID)){	
		$isSuccess = "";

		$rst_mnu_restaurant= $_REST_ID;
		$rst_mnu_add_order= 1;
		$rst_mnu_add_prom= 1;
		$rst_mnu_serv_req= 1;
		$rst_mnu_orders= 0;
		$rst_mnu_tbl_statuses= 0;
		$rst_mnu_prom_claimed= 1;
		$rst_mnu_complaints= 1;
		$rst_mnu_transfer_tbl= 0;
		$rst_mnu_online_users= 0;
		$rst_mnu_loyalty_rewards= 1;
		$rst_mnu_configuration= 0;
		$rst_mnu_allergy= 1;
		$rst_mnu_reward_conf= 'CUSTOMER';
		$rst_mnu_start_date= '';
		$rst_mnu_end_date= '';

		$objtbl_rest_menu_opt= new tbl_rest_menu_opt();
		$isSuccess = $objtbl_rest_menu_opt->create($rst_mnu_restaurant, $rst_mnu_add_order, $rst_mnu_add_prom, $rst_mnu_serv_req, $rst_mnu_orders, $rst_mnu_tbl_statuses, $rst_mnu_prom_claimed, $rst_mnu_complaints, $rst_mnu_transfer_tbl, $rst_mnu_online_users, $rst_mnu_loyalty_rewards, $rst_mnu_configuration,$rst_mnu_reward_conf, $rst_mnu_start_date, $rst_mnu_end_date,$rst_mnu_allergy);
		if(is_gt_zero_num($isSuccess)){				
		 	$_OPLOG[] = 'Restaurant menu options created successfully';
		}else{
			$_OPLOG[] = 'Error in creating Restaurant menu options.';
		}	
		unset($objtbl_rest_menu_opt);
	}
//..START STEP-7) Add rest menu options

//..START STEP-8) Add server pin
	if(is_gt_zero_num($_REST_ID)){	
		$isSuccess = "";
		$srv_pin_restaurant= $_REST_ID;
		//$srv_pin_password= '';
		$srv_pin_server= $_SEVR_ID;
		$srv_pin_start_date= '';
		$srv_pin_end_date= '';

		$objtbl_server_pin= new tbl_server_pin();
		$isSuccess = $objtbl_server_pin->create($srv_pin_restaurant, $srv_pin_password, $srv_pin_start_date,$srv_pin_end_date,$srv_pin_server);
		if(is_gt_zero_num($isSuccess)){				
		 	$_OPLOG[] = 'Server pin created successfully';
		}else{
			$_OPLOG[] = 'Error in creating Server pin.';
		}	
		unset($objtbl_server_pin);
	}
//..START STEP-8) Add server pin
}

//echo "(_REST_ID|_MNGR_ID|_ADMIN_ID|_SEVR_ID|_TBL_TYP_ID|_TBL_ID)=($_REST_ID|$_MNGR_ID|$_ADMIN_ID|$_SEVR_ID|$_TBL_TYP_ID|$_TBL_ID)";

//var_dump($_OPLOG);
echo '<pre>'; print_r($_OPLOG); echo '</pre>';
?>