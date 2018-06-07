<?php

 include("../service_init.php");
		
 $tag= get_input("tag",'');  

if(is_not_empty($tag)){   

    // response Array
    $_response = array("tag" => $tag, "success" => 0, "message" => '');
    $restaurant_id = get_input("restaurant_id",1); 
	$_SESSION[SES_RESTAURANT]=$restaurant_id;
	if(is_gt_zero_num($restaurant_id)){
		$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
		//unset($rest_info);
	}
    // check for tag type
    if($tag=='add_complaint'){
    	
    	$auth_id=get_input('auth_id',0); 
		$table_id=get_input('table_id',1);
		
    	$complnt_id= get_input("complnt_id");
		$complnt_title= get_sql_input("complnt_title",'');
		$complnt_description= get_sql_input("complnt_description");
		$complnt_email= get_sql_input("complnt_email");
		$complnt_phone= get_sql_input("complnt_phone");
		$complnt_restaurant= get_input("complnt_restaurant",$_SESSION[SES_RESTAURANT]);
		$complnt_user_id= get_input("complnt_user_id",$_SESSION['guid']);
		$complnt_user_type= get_input("complnt_user_type",CUST_TYPE_LOGIN);
		//$complnt_table= get_input("complnt_table",$_SESSION[SES_TABLE]);
		$complnt_start_date= get_input("complnt_start_date");
		$complnt_end_date= get_input("complnt_end_date",NULL);    
			
    	if(is_gt_zero_num($auth_id)){
    		$restaurant_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
			//..upsert user using phone number
			if(is_not_empty($complnt_phone)){
				$user_details=upsert_usr_by_phone($complnt_phone);
				$complnt_user_id=$user_details['id'];
				$complnt_user_type= CUST_TYPE_LOGIN;				
				//..Check for the last psoted complaint by that user_error
				$sql=  'SELECT DATEDIFF(NOW(),MAX(`complnt_start_date`)) as `last_rec` FROM `tbl_complaints` WHERE `complnt_user_id`='.$user_details['id'];
				$last_post=DB::ExecQry($sql,1);	
			}
			$objtbl_complaints= new tbl_complaints();
			$isSuccess = $objtbl_complaints->create('--', $complnt_description, $complnt_email, $complnt_phone, $restaurant_id, $complnt_user_id, $complnt_user_type, $table_id, $complnt_start_date, $complnt_end_date);
			unset($objtbl_complaints);
			//..Send email
			if(is_not_empty($complnt_email)){
				//..Finally send the email with the above content					
				$subject = "Complaint/suggestion from {$complnt_email} on ".$restaurant_info[RESTAURENT_NAME];
				$email_body=sprintf($_lang['tbl_complaints']['info_msg']['complnt_email_msg'],$complnt_description,'',$complnt_email,$complnt_phone);					
				try {
					@send_mail_using_php($subject,$complnt_email,$restaurant_info[RESTAURENT_EMAIL],$email_body,$restaurant_info[RESTAURENT_NAME]);
				}catch(Exception $e) {
				  // echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			}
			if(is_not_empty($isSuccess)){
				if(is_gt_zero_num($isSuccess)){
					$_response['message']= $_lang['tbl_complaints'][ACTION_CREATE]['SUCCESS_MSG'];
				}elseif($isSuccess == OPERATION_FAIL){
					$_response['message']= $_lang['tbl_complaints'][ACTION_CREATE]['FAILURE_MSG'];
				}elseif($isSuccess == OPERATION_DUPLICATE){
					$_response['message']=$_lang['tbl_complaints'][ACTION_CREATE]['DUPLICATE_MSG'];
				}
			}//..if  	
 			$_response['success']=1;
			//}
		}else{
			$_response['message']='Please provide user id before proceed.';
		}		
	
	}elseif($tag == 'get_write_review') {		
    	if(is_not_empty($rest_info['rest_review_systems'])){
			$_response['success'] 	  	= 1;
	    	$_response['write_reviews'] = $rest_info['rest_review_systems'];
			$_response['message'] 	    = 'Write social reviews link fetched successfully';
		}else{
	    	$_response['write_reviews'] = '';
			$_response['message'] 	    = 'Write social reviews links not provided.';
		}	
	}else{
		$_response["error"] = 1;
        $_response["error_msg"] = "Invalid Request";
        //echo "Invalid Request";
    }
		
}else{
	$_response["error"] = 1;
    $_response["error_msg"] = "Access Denied";
    //echo "Access Denied";
}
if(IS_JSONP==1)				
	echo $_GET['callback'] . '(' . json_encode($_response). ')';
else
	echo json_encode($_response, JSON_PRETTY_PRINT);

?>