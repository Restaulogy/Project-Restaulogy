<?php

define('ACCESS_DEFAULT',2);
define('POPUP_WINDOW','popup_window');
define('IS_AJAX','isAjax');
//... 
define('SES_RESTNT_NM', 'restaurent_name');
define('SES_RESTAURANT', 'restaurant_id');
define('SES_TABLE', 'table_id'); 
define('SES_TABLE_TYPE', 'table_type_id'); 
/*define('SES_MENU', 'menu_id');*/
define('SES_MENU', 'pst_menu_id');
define('SES_SUB_MENU', 'submenu_id'); 
define('SES_DISH', 'dish_id'); 
define('SES_DISH_OPTION', 'dish_option_id'); 
define('SES_DISH_OPTION_VALUE', 'dish_option_value_id');
			 
define('SES_SUB_MENU_DISH', 'sub_menu_dish_id'); 
define('SES_CART', 'cart'); 

define('SES_TEMP_CART', 'temp_cart');   
define('SES_TEMP_ORDER_SEQUENCE', 'temp_sequence_num');
define('SES_TEMP_OTP', 'temp_OTP'); 
define('SES_OTP', 'OTP'); 

define('SES_ORDER_SEQUENCE', 'sequence_num');
define('SES_PROMOTION', 'promotion_id');
define('SES_PROM_COND', 'prom_condition_id');
define('SES_CUSTOMER_SESSION','tbl_cust_sess_id') ; 
define('SES_ORDER_UDP', 'order_update');
define('SES_ORDER','order_id');
define('SES_PAYPAL_EMAIL','paypal_email');
define('SES_CUST_NM','cust_nm');
define('SES_ONLINE_STORE','online_store') ; 
define('SES_CONDITIONS','prom_cond_detail');
define('SES_STATUS','status_id');

define('SES_CUST_PHN','cust_phone');


// constant for customer filter
define('FILTER_BY_CUST','cust_filter');

//..for wait queue
define('SES_EST_TIME_GR', 'estimation_time_group_id');  
define('SES_EST_TIME','estimation_time'); 
define('SES_CUST_PHONE','customer_phone_number'); 
define('SES_QUEUE','customer_que_id'); 
define('SES_QR','');


//..constants for the device cookie change@3Aug2013#2
define('SES_DEVICE_COOKIE','device_cookie') ;  
define('SES_COOKIE_UID','cookie_user_id') ;
define('SES_CUST_TYPE','customer_type') ;
define('CUST_TYPE_LOGIN','LOGIN') ; 
define('CUST_TYPE_COOKIE','COOKIE') ; 
define('CUST_TYPE_SMS_REG','SMS_REG') ; 

//..constant for the reward session user
define('SES_REWARD','reward');
define('SES_REWARD_TBL_SESSION','reward_tbl_sess');

//..constant for display popup message 
define('SES_FLASH_MSG','disp_msg');  

/**** Miscellaneous Constants****/
define('TAB', chr(9)) ;
define('RET', ' '.chr(10).chr(13)) ;
define('NL', chr(10)) ;
define('FILTER_SEP','|'.chr(10).chr(13)) ; 

define('DATE_FORMAT','Y-m-d H:i:s'); 
define('DAY_FORMAT','Y-m-d');
define('TIME_FORMAT','H:i:s');
define('EMPTY_DATE_FORMAT','0000-00-00 00:00:00');
define('EMPTY_TIME_FORMAT','00:00:00');

define('CLR_GREEN','#00b201');
define('CLR_BLUE','#000184');
define('CLR_RED','#ff5151');
define('CLR_ORANGE','#fc6300');
define('CLR_YELLOW','#feff7b');
define('CLR_WHITE','#fff');
define('CLR_BLACK','#000');
define('CLR_GRAY','#aaa');
  
define('ICN_INITIATE', $website.'/images/_graphics/status/blue.png');  
define('ICN_IN_PROCESS',$website.'/images/_graphics/status/yellow.png'); 
define('ICN_NOT_IN_TIME',$website.'/images/_graphics/status/red.png'); 
define('ICN_COMPLETE', $website.'/images/_graphics/status/green.png'); 
define('ICN_CANCELLED', $website.'/images/_graphics/status/cancel.png'); 

define('LBL_INITIATE', 'Initiate');  
define('LBL_IN_PROCESS','In Process');  
define('LBL_NOT_IN_TIME','Not In Time');  
define('LBL_COMPLETE', 'Complete');  
define('LBL_CANCELLED','Cancelled');
define('LBL_DELAYED','Delayed');   

define('OFFSET_TITLE','offset');
define('OFFSET_VALUE',0);
define('LIMIT_TITLE','limit'); 
define('LIMIT_VALUE',15); 

define('SORT_ON','sort_on');
define('SORT_BY','sort_by');
define('SORT_BY_ASC','ASC');
define('SORT_BY_DESC','DESC');
define('REPORT','report'); 

define('ORDER_INITIATED', 1 );
define('ORDER_PICKED', 2 );

define('MODE_TITLE','mode');
define('MODE_VIEW','VIEW');
define('MODE_UPDATE','UPDATE');
define('MODE_CREATE','NEW'); 
define('MODE_REPORT','REPORT'); 

define('ACTION_TITLE','action');
define('ACTION_SAVE','SAVE');
define('ACTION_CREATE','CREATE');
define('ACTION_UPDATE','UPDATE');
define('ACTION_DELETE','DELETE');
define('ACTION_RESET','RESET');
define('ACTION_ACTIVATE','ACTIVATE');
define('ACTION_DEACTIVATE','DEACTIVATE');  
define('ACTION_SEARCH','SEARCH'); 
 
define('OPERATION_FAIL',0);
define('OPERATION_DUPLICATE',-1);
define('OPERATION_SUCCESS',1);

define('ROLE_WAITER',1);
define('ROLE_MANAGER',2);
define('ROLE_ADMIN',3);
define('ROLE_CUSTOMER',4);
define('ROLE_KITCHEN',5);
define('ROLE_OWNER',6);
define('ROLE_DEV',7);
define('ROLE_BAR',8);
define('ROLE_EXPEDITOR',9);
 
define('INPUT_CHECKBOX' , 'checkbox');
define('INPUT_DROPDOWN' , 'radio');
define('INPUT_TEXT' , 'label');
 
//..constants for smarty
define('PH_DATE_FORMAT','m/d/Y'); 
define('PH_TIME_FORMAT','H:m'); 
define('HTML5_DATE_FORMAT','%D'); 
define('HTML5_DAY_FORMAT','%m/%d/%Y'); 
define('HTML5_TIME_FORMAT','%H:%M'); 
define('HTML5_TIME_AMPMFORMAT','%l:%M %p');
define('HTML5_DATETIME_FORMAT','%m/%d/%Y %H:%M'); 

define('MOBISCROL_FORMAT','mm/dd/yy, DD'); 

/******* Constants For Color *******/
define('ELGG_BLUE','#28166F');
define('ELGG_ORANGE','#FC6300');
define('ELGG_GREEN','#7EC01E');
/*********************************/
	
/******* Constants For Mobile Heght Width *******/
define('ELGG_MOBILE_HEIGHT', '480');
define('ELGG_MOBILE_WIDTH','320');
define('ELGG_DESKTOP_HEIGHT','600');
define('ELGG_DESKTOP_WIDTH','985');
/*********************************/

//..Menu/dish/services image upload path
define('LAND_PG_UPLOAD_PATH', '/uploads/landing_pg/');
define('DISH_ATTRIB_IMG_UPLOAD_PATH', '/uploads/dish_attrib/');
define('MNU_IMG_UPLOAD_PATH', '/uploads/menu/');
define('SUB_MNU_IMG_UPLOAD_PATH', '/uploads/submenu/');

define('DISH_IMG_UPLOAD_PATH', '/uploads/dish/');
define('SRVC_IMG_UPLOAD_PATH', '/uploads/services/');
/*********************************/
 
define('SES_EXP_TIME_SEC' , 7200); 
define('PG_ORD_REFRESH',60000);
define('CUST_LAST_ORDER','CustSessionLastOrder');

//..Flag to add the order manger note/customer name link
//..facility
define('IS_SERV_ALWD_NOTE',1);

//..for default status_restaurant in tbl_statuses
define('STS_DFLT_RESTAURANT',-999);

//..Service id for the pay by cash request 
define('SERVICE_PAY_BY_CASH',8);

//..the menu drink id used for the drink
define('WINE_MENU_ID',7);

//..for reward authentication
define('IS_RWD_AUTH','IS_RWD_AUTHENTICATED');

//..default multiplier
define('_DEFT_MULTIPLIER',0.01);

//..Twilio constants
//..Local wrong code
/*
define('TWILIO_ACCOUNTSID','QSAC0703d8383f6f5ecf6bcbcccedd8112b4');
define('TWILIO_AUTHTOKEN','sdaasda91d2e4d3929218e40d6e5eef9a0f561');
define('TWILIO_PHONE','+19853557190');
*/
//..Actual prod valid twilio code
define('TWILIO_ACCOUNTSID','AC0703d8383f6f5ecf6bcbcccedd8112b4');
define('TWILIO_AUTHTOKEN','a91d2e4d3929218e40d6e5eef9a0f561');
define('TWILIO_PHONE','+13853557110');

define('IS_JSONP',0);
?>