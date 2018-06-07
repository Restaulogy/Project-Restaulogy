<?php
include_once(dirname(dirname(__FILE__))."/init.php"); 

//..Capture the posted values
$order_emp_id        = 0;
$order_table_id      = get_input('order_table_id',0);
$order_type          = get_input('order_type',ORDER_TYPE_AT_LOCATION);//..change@7Aug2013#1
$tk_out_delivery     = get_input('tk_out_delivery',0);
$is_pay_now          = get_input('is_pay_now',0);
//$order_customer_id = get_input('order_customer_id');
$add_proms = get_input('add_proms',0);

$order_guest         = get_input('order_guest',1);

$order_chk_paid      = get_input('order_chk_paid',0);
$order_customer_name = get_sql_input('order_customer_name','');
$order_manager_note  = get_sql_input('order_manager_note');
$order_note          = get_sql_input('order_note','');
//$order_status_id = TBL_STATUS_ORDERED;
$order_status_id     = TBL_STATUS_ORDER_CONFIRM;
$order_created_on    = date(DATE_FORMAT);
$order_completed_on  = NULL;
//..change@3Aug2013#2-- Set Default Customer Type to login since manager can also place the order.
$order_customer_type = CUST_TYPE_LOGIN;

$_ord_totally_new    = 0;

//..loyalty variable check the
$reward_email        = get_input('reward_email','');
if(is_not_empty($reward_email)){
	//..fetch the user from the email
	$rewrad_user = get_user_by_email($reward_email);
	if(is_not_empty($rewrad_user)){
		$_SESSION[SES_REWARD] = $rewrad_user;
	}else{
		$_SESSION[SES_FLASH_MSG] = '<div class="error">This email is not registered with reward program.</div>';
	}
}

//..for manageing the session
if(is_not_empty($order_type)){
	$_SESSION[ORDER_TYPE] = $order_type;
}
if(is_not_empty($tk_out_delivery)){
	$_SESSION[ORDER_TAKEOUT_TIME] = $tk_out_delivery;
}

//..for order is placed from QR session
if(is_gt_zero_num($_SESSION[SES_TABLE])){
	$order_table_id = $_SESSION[SES_TABLE];
}
/*if(is_not_empty($order_customer_name)==false)
if(is_not_empty($_SESSION[SES_CUST_NM]))
$order_customer_name = $_SESSION[SES_CUST_NM]; */
//..Store the customer name for further processing

if(is_not_empty($order_customer_name) == false){
	$order_customer_name = "guest_user_".$order_table_id;
}
if(is_not_empty($order_customer_name))
	$_SESSION[SES_CUST_NM] = $order_customer_name;

//..if table id is present fetch the employee id
if(is_gt_zero_num($order_table_id)){
	$order_emp_id = GetDfltTblEmployee($order_table_id);
}

//..check login condition
if($sesslife){
	
	if($Global_member['member_role_id'] == ROLE_CUSTOMER){
		$order_customer_id = $Global_member['member_id'];
		$order_status_id   = TBL_STATUS_ORDER_CONFIRM;
				
	}elseif(($Global_member['member_role_id'] == ROLE_WAITER) || ($Global_member['member_role_id'] == ROLE_MANAGER) || ($Global_member['member_role_id'] == ROLE_ADMIN) || ($Global_member['member_role_id'] == ROLE_EXPEDITOR)){
		$order_status_id   = TBL_STATUS_ORDER_CONFIRM;
		$order_customer_id = 0;
		//fetch customer based on the email provided
		if(is_not_empty($order_customer_name)){
			//..for checking the customer name inside cookie
			$ord_cust_chk_in_cookie = 0;

			//..check if manager provided an email
			if(isValidPhone($order_customer_name)){
				$UsrReturned       = _upsert_phone_to_rest($order_customer_name,'sample','Guest','User',$_SESSION[SES_RESTAURANT]);
				$order_customer_id = $UsrReturned['id'];				
				/*//..check if email exists in members
				//$UsrReturned = get_user_by_email($order_customer_name); get_user_by_phone_no
				$UsrReturned = get_user_by_phone_no($order_customer_name);
				if(is_not_empty($UsrReturned)){
					$order_customer_id = $UsrReturned['id'];
				}else{
					$new_use_email     = "exusr_"._get_lst_member_id()."@tst.com";
					$password          = 'sample';
					$fname             = 'guest';
					$lname             = 'user';
					$is_reward         = 1;
					$reward_bal_visits = $reward_bal_points = 0;
					$sms_subscribed    = 1;
					$op                = registerME($new_use_email,$password,$order_table_id,$fname,$lname,$order_customer_name,$is_reward,$reward_bal_visits,$reward_bal_points,$sms_subscribed);
					if($op == 1){
						$UsrReturned       = get_user_by_email($new_use_email);
						$order_customer_id = $UsrReturned['id'];
					}
					$ord_cust_chk_in_cookie = 1;
				}*/
			}else{
				//..ordre without phone
				$ord_cust_chk_in_cookie = 1;
				//..chk customer name inside cookie
				if(is_gt_zero_num($ord_cust_chk_in_cookie)){
					$order_customer_id = checkNcreateUserCookieId($order_customer_name,1);
					if(is_gt_zero_num($order_customer_id)){
						$order_customer_type = CUST_TYPE_COOKIE;
					}
				}
			}
		}else{
			//$_SESSION[SES_FLASH_MSG] = ' < div class = "error" > Customer phone is manadatory to post order.</div > ';
			//biz_script_forward($website.' / user / tbl_menu.php?is_preview = 1');
		}
	}	
}else{
	//...Exception for the online order
	if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE])){
		$order_table_id = 0;
	}
	$_SESSION[SES_CUST_NM] = $order_customer_name;
	if(isValidPhone($order_customer_name)){
		$UsrReturned       = _upsert_phone_to_rest($order_customer_name,'sample','Guest','User',$_SESSION[SES_RESTAURANT]);
		$order_customer_id = $UsrReturned['id'];
	}
	//..change@3Aug2013#2
	/*$order_customer_id = checkNcreateUserCookieId($order_customer_name);
	if(is_gt_zero_num($order_customer_id)){
		$order_customer_type = CUST_TYPE_COOKIE;
		$_SESSION[SES_COOKIE_UID] = $order_customer_id;
	}*/
}
//echo "order_customer_name = $order_customer_name | order_customer_id = $order_customer_id";
//exit;

if($order_type != ORDER_TYPE_AT_LOCATION){
	$order_status_id = TBL_STATUS_ORDER_CONFIRM;
}

$tbl_sts_lnk_session_id = 0;
//..First check if cart exists
if(is_not_empty($_SESSION[SES_CART])){
	//..Get the current tabel status
	$currTblSts = tbl_table_status_link::GetLastTableStatus($order_table_id);
	//...Changes for auto checking the table status
	if(($currTblSts == TBL_STATUS_CHECK) || ($currTblSts == TBL_STATUS_CLEANING) || ($currTblSts == TBL_STATUS_AVAILABLE))
	{
		//echo "i am in";
		//..create new table session
		$tbl_sts_lnk_session_id = checkNcreateSession($order_table_id, $order_customer_name);
		if(is_gt_zero_num($tbl_sts_lnk_session_id))
		tbl_table_status_link::get_me_ready_for_new_sess($order_table_id,$tbl_sts_lnk_session_id);
		//$objtbl_table_status_link = new tbl_table_status_link();
		/*//..get current session

		//..Set the table status to status vailable
		$objtbl_table_status_link->create($order_table_id, $order_customer_name, TBL_STATUS_AVAILABLE, $Global_member['member_id'],$tbl_sts_lnk_session_id,6);
		//echo "|| {tbl_sts_lnk_session_id}=$tbl_sts_lnk_session_id <br>";
		//..set teh table status to occupied.*/
		$tbl_sts_lnk_session_id = checkNcreateSession($order_table_id, $order_customer_name,0,1,6);
		/*$objtbl_table_status_link->create($order_table_id, $order_customer_name, TBL_STATUS_OCCUPIED,$Global_member['member_id'],$tbl_sts_lnk_session_id,6);*/
		//echo " || {tbl_sts_lnk_session_id} = $tbl_sts_lnk_session_id < br > ";
		//unset($objtbl_table_status_link);
		$currTblSts             = TBL_STATUS_OCCUPIED;
		//$cust_sess_id = $tbl_sts_lnk_session_id;
		$_ord_totally_new       = 1;
	}
	//exit;

	/*if($sesslife){*/
	if(is_gt_zero_num($tbl_sts_lnk_session_id)){
		$cust_sess_id = $tbl_sts_lnk_session_id;
	}else{
		$cust_sess_id = checkNcreateSession($order_table_id,$order_customer_name);
	}
	// " || {cust_sess_id} = $cust_sess_id < br > ";
	//..don't know why we are using this following so commented
	//$tablestatusinfo = tbl_table_status_link::GetInfo(0,$cust_sess_id);
	$can_place_order = 1;
	//echo "BEFORE {$order_table_id},{$order_customer_name} CUST_SESS_ID = ".$cust_sess_id." < br > ";
	if($_SESSION['member_role_id'] == ROLE_WAITER || $_SESSION['member_role_id'] == ROLE_MANAGER || ($Global_member['member_role_id'] == ROLE_ADMIN) || $_SESSION['member_role_id'] == ROLE_EXPEDITOR){
		//..do nothing
		/*if(($currTblSts == TBL_STATUS_AVAILABLE)){
		$_SESSION[SES_FLASH_MSG]= '<div class="error">Please set the table session to occupied before placing order.</div>';
		biz_script_forward($website.'/user/tbl_table_status_link.php?latestOnly=1');
		}*/
	}else{
		//..Exception for the online orders ..
		if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE])){
			$_SESSION[SES_CUSTOMER_SESSION] = 0;
		}else{
			//..chk Table status is check paid or cleaning then dont allow to place the order.notify manager.
			if(($currTblSts == TBL_STATUS_CHECK) || ($currTblSts == TBL_STATUS_CLEANING)){
				//if($currTblSts == TBL_STATUS_CLEANING){
				$can_place_order = 0;
				//..Changes made for status notifications 25 Oct 2013
				biz_send_status_notifications($order_table_id,$order_customer_name,0,STS_ORDER_EXCEED,$order_emp_id,$order_customer_id,$order_customer_type);
				/*//..notification to admin
				biz_send_alert($order_table_id,$order_customer_name,0,sprintf($_lang[TBL_ALERTS]['customer'][ALERT_EXD_ORDER],$order_table_id),ALERT_FOR_MANGER,ALERT_ORDER);
				//..notification to server
				biz_send_alert($order_table_id,$order_customer_name,0,sprintf($_lang[TBL_ALERTS]['customer'][ALERT_EXD_ORDER],$order_table_id),$order_emp_id,ALERT_ORDER);*/
				//$_SESSION[SES_FLASH_MSG] = $_lang[TBL_ALERTS]['customer'][ALERT_EXD_ORDER];
			}else{
				$_SESSION[SES_CUSTOMER_SESSION] = $cust_sess_id;
			}
		}
	}
	/*echo $currTblSts."=".$can_place_order;exit;*/
	if(is_gt_zero_num($can_place_order)){
		####################################################################
		//..Get The Order ID
		//echo "AFTER CUST_SESS_ID = ".$cust_sess_id." < br > ";
		//..Following exception is added for teh online orders from same device or any device it should be considered as new order and not same append order concept
		$order_id = 0;
		//if(!is_gt_zero_num($_SESSION[SES_ONLINE_STORE])){
		if($order_type == ORDER_TYPE_AT_LOCATION && $_ord_totally_new == 0){
			$order_id = tbl_orders::getCustSessionLastOrder($cust_sess_id,$order_customer_name,$order_customer_id,$order_customer_type);
		}

		$_SESSION[CUST_LAST_ORDER] = $order_id;

		if(isset($objtbl_orders)){
			unset($objtbl_orders);
		}
		$objtbl_orders = new tbl_orders();
		$new_create    = 0;
		if(is_gt_zero_num($order_id)){
			//$sts_id = tbl_table_status_link::GetLastTableStatus($_SESSION[SES_TABLE]);
			if($currTblSts == TBL_STATUS_CHECK){
				//$new_create = 1;
				$new_create = 0;
			}else{
				//..update the order
				if($objtbl_orders->readObject(array(ORDER_ID =>$order_id))){
					//..Store the customer session if needed
					//$objtbl_orders->setorder_customer_id($order_customer_id);
					//$objtbl_orders->setorder_customer_name($order_customer_name);
					$objtbl_orders->setorder_note($order_note);
					$objtbl_orders->insert();
				}
				unset($objtbl_orders);
				$new_create = 0;
			}
		}else{
			$new_create = 1;
		}
		//echo " || {prev_order_id} = $order_id < br > ";
		//exit;

		if($new_create == 1){
			
			$isOnlineOrder = 0;
			if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE]) && $isAllowOnlineOrder) {
				 $isOnlineOrder = 1;
				 $order_status_id = STS_ONLINE_ORDER_PLACED;
			}
			$order_id      = $objtbl_orders->create($order_table_id,$order_emp_id,$cust_sess_id, $order_customer_id, $order_customer_name, "{$order_note}", $order_created_on, $order_completed_on, $order_status_id,$order_manager_note,$order_customer_type,$order_type,0,0,0,0,$tk_out_delivery,0,"",$order_guest,$isOnlineOrder,$add_proms);

			
			//..$order_id
			if(is_gt_zero_num($order_id))
			{	
			
				$_SESSION[SES_CART]['order_info'][ORDER_ID] = $order_id;
				$_SESSION[SES_CART]['order_info'][ORDER_TABLE_ID] = $order_table_id;
				$_SESSION[SES_CART]['order_info'][ORDER_NOTE] = $order_note;
				if(($order_emp_id == 0) && ($order_type == ORDER_TYPE_AT_LOCATION))
				{
					//@alertToManager($order_table_id,$order_customer_name,$isSuccess,sprintf(ORDER_TBL_WITHOUT_SERVER, $order_table_id));
					//..Changes made for status notifications 25 Oct 2013
					biz_send_status_notifications($order_table_id,$order_customer_name,$order_id,STS_ORDER_PLACED_WO_SERVER,$order_emp_id,$order_customer_id,$order_customer_type);
					
				}
			}
			unset($objtbl_orders);
			$_SESSION[CUST_LAST_ORDER] = $order_id;
			//..Please Update Table Status
			/*
			//..Add record to table to table status link table with "ordered" status
			$objtbl_table_status_link=new tbl_table_status_link();
			$isSuccess = $objtbl_table_status_link->create($order_table_id, $order_customer_name, $order_status_id, $order_emp_id,$cust_sess_id, date(DATE_FORMAT), NULL);
			//..Update end time of the table status => Occupied's status
			$objtbl_table_status_link->update_table_status(0,$cust_sess_id,TBL_STATUS_OCCUPIED);
			*/
		}
		########################################################################


		if(is_gt_zero_num($order_id))
		{
 
			$order_info = tbl_orders::GetInfo($order_id);

			if(is_gt_zero_num($order_info[ORDER_ISCLAIMED_PROMOTIONS]))
			{
				$_SESSION[SES_FLASH_MSG] = '<div class="error">Promotions are applied for the order. So you cannot update the order.</div>';			unset($_SESSION[SES_CART]);
				unset($_SESSION[SES_ORDER_SEQUENCE]);
				biz_script_forward($website.'/user/tbl_menu.php?is_preview=1');
			}

			//..Logic to add record into the suborder table
			/*$objtbl_sub_orders= new tbl_sub_orders();
			$sub_order_id = $objtbl_sub_orders->create($order_id, TBL_STATUS_ORDERED,'','');
			unset($objtbl_sub_orders);*/
 
			//..Delete previou order details if any
			//..@tbl_order_details::delete_ord_detls($order_id);
			$kichen_sub_order_id = $bar_sub_order_id    = 0;

			foreach($_SESSION[SES_CART] as $key=>$ord_seq_num)
			{
				if(($key == 0) || ($key != 'order_info'))
				{
					if(is_not_empty($ord_seq_num[SES_SUB_MENU_DISH]))
					{
						foreach($ord_seq_num[SES_SUB_MENU_DISH] as $key_sbmndsh=>$val_sbmndsh)
						{
							$sub_order_id     = 0;
							$submnu_dish_info = tbl_submenu_dishes::readArray(array(SBMNU_DISH_ID=>$key_sbmndsh));
							$submnu_dish_info = array_shift($submnu_dish_info);
							$route_id         = $submnu_dish_info[MENU_ROUTE];
							unset($submnu_dish_info);
							if($route_id == ROLE_KITCHEN)
							{
								if(is_gt_zero_num($kichen_sub_order_id))
								{
									$sub_order_id = $kichen_sub_order_id;
								}
								else
								{
									$objtbl_sub_orders   = new tbl_sub_orders();
									$kichen_sub_order_id = $objtbl_sub_orders->create($order_id, $order_status_id,ROLE_KITCHEN);
									unset($objtbl_sub_orders);
									$sub_order_id = $kichen_sub_order_id;
								}
							}
							if($route_id == ROLE_BAR)
							{
								if(is_gt_zero_num($bar_sub_order_id))
								{
									$sub_order_id = $bar_sub_order_id;
								}
								else
								{
									$objtbl_sub_orders = new tbl_sub_orders();
									$bar_sub_order_id  = $objtbl_sub_orders->create($order_id, $order_status_id,ROLE_BAR);
									unset($objtbl_sub_orders);
									$sub_order_id = $bar_sub_order_id;
								}
							}


							//..Insert into order details
							$objtbl_order_details = new tbl_order_details();
							//..Logic to add record into the suborder table
							$order_detail_id      = $objtbl_order_details->create($order_id, $key_sbmndsh, $val_sbmndsh['qty'], $val_sbmndsh['price'],0,0,0,$sub_order_id);
							//$order_detail_id = $objtbl_order_details->create($order_id, $key_sbmndsh, $val_sbmndsh['qty'], $val_sbmndsh['price']);
							if(is_gt_zero_num($order_detail_id) && is_not_empty($val_sbmndsh['dish_option_value_id']))
							{
								foreach($val_sbmndsh['dish_option_value_id'] as $key_optval=>$val_optval)
								{
									//..Insert into order details options if any
									$objtbl_order_details_options = new tbl_order_details_options();
									$order_dtl_option_id          = $objtbl_order_details_options->create($order_detail_id, $key_optval, $val_optval['qty'], $val_optval['price']);
								}
							}

						}//..foreach option
					}
				}
			}//..foreach cart

			if(in_array($_SESSION['member_role_id'], array(ROLE_WAITER,ROLE_MANAGER,ROLE_EXPEDITOR,ROLE_ADMIN,ROLE_OWNER)))
			{
				//..do nothing
				$_SESSION[SES_FLASH_MSG] = '<div class="success">Order successfully posted.</div>';
				uset_nor_session();
			}
			else
			{
				//.. if customer
				if(($currTblSts == TBL_STATUS_AVAILABLE) || ($currTblSts == 0))
				{
					if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE]))
					{
						//..change@17Aug2013#1 <---
						//..for manager
						//biz_send_alert($order_table_id,$order_customer_name,$order_id,$_lang[TBL_ALERTS]['manager']['new_online_order'],ALERT_FOR_MANAGER,ALERT_ORDER);
						//..change@17Aug2013#1 --->
						//..for kitchen
						//biz_send_alert($order_table_id,$order_customer_name,$order_id,$_lang[TBL_ALERTS]['misc']['order_added'],ALERT_FOR_KITCHEN,ALERT_ORDER);
						#..Changes made for status notifications 25 Oct 2013
						//biz_send_status_notifications($order_table_id,$order_customer_name,$order_id,STS_ONLINE_ORDER_PLACED,$order_emp_id,$order_customer_id,$order_customer_type,1);
						if($add_proms==0){
							if(is_gt_zero_num($bar_sub_order_id)){
								biz_send_status_notifications($order_table_id,$order_customer_name,$bar_sub_order_id,STS_ONLINE_ORDER_PLACED,$order_emp_id,$order_customer_id,$order_customer_type,1);
							}
							if(is_gt_zero_num($kichen_sub_order_id))
							{
								biz_send_status_notifications($order_table_id,$order_customer_name,$kichen_sub_order_id,STS_ONLINE_ORDER_PLACED,$order_emp_id,$order_customer_id,$order_customer_type,1);
							}
							$_SESSION[SES_FLASH_MSG] = '<div class="info">'.$_lang[TBL_ALERTS]['customer'][ALERT_TMP_ORDER].'</div>';
						}
					}
					else
					{
						//..change@17Aug2013#1 <---
						//..this is critical message so required for manger as well
						//@alertToManager($order_table_id,$order_customer_name,$order_id,(sprintf(ALERT_TMP_ORDER, $order_table_id)));
						#..Changes made for status notifications 25 Oct 2013
						biz_send_status_notifications($order_table_id,$order_customer_name,$order_id,STS_ORDER_PLACED_WO_SESSION,$order_emp_id,$order_customer_id,$order_customer_type);
						//..Notify manager
						//biz_send_alert($order_table_id,$order_customer_name,$order_id, sprintf($_lang[TBL_ALERTS]['manager'][ALERT_TMP_ORDER], $order_table_id),ALERT_FOR_MANGER,ALERT_ORDER);
						//..Notify server
						//biz_send_alert($order_table_id,$order_customer_name,$order_id, sprintf($_lang[TBL_ALERTS]['manager'][ALERT_TMP_ORDER], $order_table_id),$order_emp_id,ALERT_ORDER);
						//..change@17Aug2013#1 --->
					}

					//$_SESSION[SES_FLASH_MSG] = ' < div class = "info" > '.$_lang[TBL_ALERTS]['customer'][ALERT_TMP_ORDER].'</div > ';
				}
				else
				{
					if($new_create == 1)
					{
						//..change@17Aug2013#1 <---
						//@alertToManager($order_table_id,$order_customer_name,$order_id,ALERT_PNDG_ORDER);
						if($add_proms==0){
						#..Changes made for status notifications 25 Oct 2013
						biz_send_status_notifications($order_table_id,$order_customer_name,$order_id,STS_ORDER_PLACED,$order_emp_id,$order_customer_id,$order_customer_type,1);
						}

						//..notify server
						//biz_send_alert($order_table_id,$order_customer_name,$order_id,$_lang[TBL_ALERTS]['manager'][ALERT_PNDG_ORDER],$order_emp_id,ALERT_ORDER);
						//..change@17Aug2013#1 --->
						//$_SESSION[SES_FLASH_MSG] = ' < div class = "info" > '.$_lang[TBL_ALERTS]['customer'][ALERT_PNDG_ORDER].'</div > ';
					}
					else
					{
						//..Updated message for
						//..change@17Aug2013#1 <---
						//1 manager
						//biz_send_alert($order_table_id,$order_customer_name,$order_id,$_lang[TBL_ALERTS]['misc']['order_update'],ALERT_FOR_MANGER,ALERT_ORDER);
						//..change@17Aug2013#1 --->
						//1 kitchen
						//biz_send_alert($order_table_id,$order_customer_name,$order_id,$_lang[TBL_ALERTS]['misc']['order_update'],ALERT_FOR_KITCHEN,ALERT_ORDER);
						//1 server
						//biz_send_alert($order_table_id,$order_customer_name,$order_id,$_lang[TBL_ALERTS]['misc']['order_update'],$order_emp_id,ALERT_ORDER);
						#..Changes made for status notifications 25 Oct 2013
						biz_send_status_notifications($order_table_id,$order_customer_name,$order_id,STS_ORDER_UPDATE,$order_emp_id,$order_customer_id,$order_customer_type,1);
						//$_SESSION[SES_FLASH_MSG] = ' < div class = "success" > Order Successfully posted.</div > ';
					}
				}
			}
			//..Do not delete the sess_cart
			if(in_array($_SESSION['member_role_id'], array(ROLE_WAITER,ROLE_MANAGER,ROLE_EXPEDITOR,ROLE_ADMIN,ROLE_OWNER)))
			{				
			}else{		
			}	
			//..if adding of promotions
			if($add_proms==1){
				$_SESSION[SES_TEMP_CART]=$_SESSION[SES_CART];	
				$_SESSION[SES_TEMP_ORDER_SEQUENCE] = $_SESSION[SES_ORDER_SEQUENCE];
			}else{
				$_SESSION[SES_TEMP_CART] = array();
				$_SESSION[SES_TEMP_ORDER_SEQUENCE] = NULL;
			}
			//..clear cart		
			$_SESSION[SES_CART] = array();
			$_SESSION[SES_ORDER_SEQUENCE] = NULL;
				
			//unset($_SESSION[SES_CART]);
			//unset($_SESSION[SES_ORDER_SEQUENCE]);

			//..for updating the order manager note
			//step 1: check $order_manager_note is not empty and the order is not new
			if((is_not_empty($order_manager_note)) && (is_gt_zero_num($new_create) == false))
			{
				//step 2: update order with manager note
				//.if order object is exists unset it
				if(isset($objtbl_orders)) unset($objtbl_orders);
				//..create order object
				$objtbl_orders = new tbl_orders();
				//..check for the particular order
				if($objtbl_orders->readObject(array(ORDER_ID=>$order_id)))
				{
					//..update manager note
					$objtbl_orders->setorder_manager_note($order_manager_note);
					$objtbl_orders->insert();
				}
				//..unset the order object
				unset($objtbl_orders);
			}
			
			if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE]) == FALSE){
				if(isCustomer()){
					//attachCouponsToOrder($cust_sess_id,$order_customer_id,$order_customer_type,1,$order_id);
				}
			}elseif(is_gt_zero_num($_SESSION[SES_ONLINE_STORE]) && $isAllowOnlineOrder){
				if(isCustomer()){
					$restInfo = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
					//die(var_dump($restInfo)); 
					$orderUrl = $website.'/user/tbl_orders.php?order_id='.$order_id.'&is_online_order=1';
					$orderHTML= tbl_orders::getOrderHTML($order_id);
					//tbl_order_confirmation_codes::setOrder($order_id); 
					 //tbl_order_confirmation_codes::sendSMS($restInfo['restaurent_phone_1'],'New order is placed. '.$orderUrl);
					 //tbl_order_confirmation_codes::sendFAX('Restaurant',$restInfo['restaurent_fax'],$orderHTML);
					biz_script_forward($website.'/user/tbl_orders.php?order_id='.$order_id.'&add_proms='.$add_proms.'&'.MODE_TITLE.'='.MODE_VIEW);
				}
			}

			//..logic for popup pay now section
			if($is_pay_now)
			{
				biz_script_forward($website.'/user/tbl_orders.php?order_id='.$order_id.'&add_proms='.$add_proms.'&'.MODE_TITLE.'='.MODE_VIEW.'&is_pay_now='.$is_pay_now);
			}
			else
			{
				$_SESSION[SES_CART] = array();
				$_SESSION[SES_ORDER_SEQUENCE] = NULL;
				uset_nor_session();
				//biz_script_forward($website.' / user / tbl_menu.php?is_preview = 1');
				biz_script_forward($website.'/user/tbl_orders.php?order_id='.$order_id.'&add_proms='.$add_proms.'&'.MODE_TITLE.'='.MODE_VIEW);

			}
			//biz_script_forward($website.' / user / dashboard.php');
		}


	}
	else
	{
		//@alertToManager($order_table_id,$order_customer_name,$order_id,sprintf(ALERT_EXD_ORDER, $order_table_id) );
		#..Changes made for status notifications 25 Oct 2013
		biz_send_status_notifications($order_table_id,$order_customer_name,0,STS_ORDER_EXCEED,$order_emp_id,$order_customer_id,$order_customer_type);

		/*biz_send_alert($order_table_id,$order_customer_name,$order_id,sprintf(ALERT_EXD_ORDER, $order_table_id),$order_emp_id,ALERT_ORDER);
		$_SESSION[SES_FLASH_MSG]='<div class="info">'.$_lang['tbl_alerts']['customer'][ALERT_EXD_ORDER].'</div>';*/
		//echo " < script > window.location.href = '{$website} /  / tbl_menu.php?is_preview = 1';</script > ";user

		biz_script_forward($website.'/user/tbl_menu.php?is_preview=1');
		//biz_script_forward($website.' / user / dashboard.php');
	} 
	if(is_gt_zero_num($_SESSION[SES_ONLINE_STORE]) && $isAllowOnlineOrder) {
		if(isCustomer()){
			 $_SESSION[SES_CART] = array();
				$_SESSION[SES_ORDER_SEQUENCE] = NULL;
			 biz_script_forward($website.'/user/tbl_menu.php?is_preview=1');
			
		}
	}
	
	
	 
	/*	}else{
	$_SESSION['prev_order']['order_table_id']= $order_table_id;
	$_SESSION['prev_order']['order_emp_id']= $order_emp_id;
	$_SESSION['prev_order']['order_customer_id']= $order_customer_id;
	$_SESSION['prev_order']['order_customer_name']= $order_customer_name;
	$_SESSION['prev_order']['order_note']= $order_note;
	$_SESSION['prev_order']['order_manager_note']= $order_manager_note;
	$_SESSION['prev_order']['order_created_on']= date(DATE_FORMAT);
	$_SESSION['prev_order']['order_completed_on']= $order_completed_on;
	$_SESSION['prev_order']['order_status_id']= $order_status_id;
	echo "<script>location.href='{$website}/user/cust_login.php?prev_page=ORDER';</script>";
	}*/
}
else
{
	$_SESSION[SES_FLASH_MSG] = '<div class="error">Cart is empty</div>';
	biz_script_forward($website.'/user/tbl_menu.php?is_preview=1');
}
?>