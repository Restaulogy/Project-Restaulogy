<?php 
 //session_start();
 include_once(dirname(dirname(__FILE__))."/init.php");
 error_reporting(E_ALL);
 ini_set('display_errors',0);
 
 $res = 0; 
 $_action = get_input('action','');;
 $_phone = get_input('customer_phone','');
 $_restaurant = get_input('restaurant','');
 $_code = get_input('code','');
 $_timestamp = get_input('timestamp','');
 
 $cust_rest_pin = get_input('cust_rest_pin','');
 
 $result = '';
 switch(strtoupper($_action)){
 	 case 'SEND' : 
 	 			 if(is_not_empty($_phone) && is_not_empty($_restaurant)){
				 		$response = tbl_order_confirmation_codes::createConfirmationCode($_phone,$_restaurant); 
				 	 	$result =  array("timestamp"=>$response['timestamp']) ;				 	 	
				 	 	$_sms_msg_bdy = " OTP Code: ".$response['code'];
				 	 	tbl_order_confirmation_codes::sendSMS($_phone,$_sms_msg_bdy); 
				 	 	
				  }	 
 	 break;
 	 
 	 case 'ORD_VERIFY' :  	 			 
				 $result['msg']='';
				 $result['verified']=0;
				 $_is_valid= 1;
				 $res = 0;
				 if(is_not_empty($_phone) && is_not_empty($_restaurant) && is_not_empty($_code) && is_not_empty($_timestamp)){
				 	$res = tbl_order_confirmation_codes::verifyConfirmationCode($_phone,$_timestamp,$_code,$_restaurant); 				
			 		
				 }
				 if(is_gt_zero_num($res)){
 	 			  		$result['msg']='Phone Code verified successfully'; 
			 			$result['verified']=1;
			 			//..add it to OTP session
			 			$UsrReturned = _upsert_phone_to_rest($_phone,'sample','Guest','User',$_restaurant);
				 	 	$_SESSION[SES_OTP]=$UsrReturned;
				  }else{
				  	 	$result['msg']='Invalid mobile verification code';
						$result['verified']=0;
				  }	
 	 break;
 	 
 	 case 'VERIFY' :  	 			 
				 $result['msg']='';
				 $result['verified']=0;
				 $_is_valid= 1;
				 $res = 0;
				 //..validate mobile code
				 /*if(is_not_empty($_phone) && is_not_empty($_restaurant) && is_not_empty($_code) && is_not_empty($_timestamp)){
				 		//..Step-1) First check if the code is five digit
				 		if(strlen($_code)==5){
				 			//..Step-2) Check exceptional 5 digit code for verification	
				 			if($_restaurant==30){ //..Trippie hippie
								if($_code=='54312'){
									$_is_valid= 1;
								}
				 			}elseif($_restaurant==29){ //..Kolhapur katta
								if($_code=='98721'){
									$_is_valid= 1;
								}
				 			}elseif($_restaurant==28){ //..IcecreamO
								if($_code=='93521'){
									$_is_valid= 1;
								}
				 			}elseif($_restaurant==26 || $_restaurant==27){ //..Smoke on the Water
								if($_code=='52931'){
									$_is_valid= 1;
								}
				 			}elseif($_restaurant==24){ //..Abhiraj
								if($_code=='23481'){
									$_is_valid= 1;
								}
				 			}elseif($_restaurant==23){ //..chefs pan
								if($_code=='63943'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==22){ //..orchid
								if($_code=='49569'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==20 || $_restaurant==21){ //..Zaika Kharadi/chai pani
								if($_code=='31695'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==19){ //..zodiac
								if($_code=='70125'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==18){ //..Nostradamus Lounge & Bar
								if($_code=='83145'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==17){ //..Rajendra Pavbhaji & Juice Bar restaurant
								if($_code=='21484'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==16){ //..Rrestaulogy restaurant
								if($_code=='78468'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==15){ //..Kabab Hut restaurant
								if($_code=='58621'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==14){ //..Carrots N Celery restaurant
								if($_code=='58621'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==12){ //..Chinese room restaurant
								if($_code=='53712'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==11  || $_restaurant==25){ //..China grill restaurant
								if($_code=='42871'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==10){ //..Atlantis restaurant
								if($_code=='54682'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==9){ //..Zaika restaurant
								if($_code=='92753'){
									$_is_valid= 1;
								}
							}elseif($_restaurant==1){ //..Mainland china restaurant
								if($_code=='12345'){
									$_is_valid= 1;
								}
							}


							if($_is_valid==1){
								$result['msg']='Phone Code verified successfully';
								$res = 1;
							}else{
								$result['msg']='Invalid mobile verification code';
							}
							$result['verified']=$_is_valid;
						}else{
							$res = tbl_order_confirmation_codes::verifyConfirmationCode($_phone,$_timestamp,$_code,$_restaurant); 				
					 		$result['msg']='Phone Code verified successfully'; 
					 		$result['verified']=1;
						}  
				  } */	
				  //..phone verification is exempted.
				  $result['verified']=1;
				  $result['msg']='Phone Code verified successfully'; 
				  
 	 			  /*if(is_gt_zero_num($res)){*/
 	 			  		//..validaet Restaurant pin
 	 			  		if(is_not_empty($cust_rest_pin)){
 	 			  			$_serv_pin=validate_server_pin($cust_rest_pin);
					  	 	if(is_gt_zero_num($_serv_pin)) {
					  	 		$result['msg']='Successfully validated';
								$result['verified']=1;
							}else{
								$result['msg']='Invalid Restaurant PIN';
								$result['verified']=0;
							} 
 	 			  		} 	 	
				  /*}else{
				  	 	$result['msg']='Invalid mobile verification code';
						$result['verified']=0;
				  }	*/
 	 break;
 	 
 	 case 'ORDER' :
 			 $result =   tbl_orders::getOrderHTML(246);
 			 print_r($_SESSION);
 	 break; 
 } 
 
 
 	die(json_encode($result));
?>