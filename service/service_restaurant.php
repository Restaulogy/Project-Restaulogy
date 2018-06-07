<?php
 //header("Access-Control-Allow-Origin: *"); 

 include("../service_init.php");
 //include_once(dirname(dirname(__FILE__)).'/modules/business_listing/classes/pds_list_promotions.class.php');
/*
//..http base authentication
if (!isset($_SERVER['PHP_AUTH_USER']) && !isset($_SERVER['PHP_AUTH_PW'])) {	
	header("WWW-Authenticate: Basic realm=\"Please enter your username and password to proceed further\"");
	header("HTTP/1.0 401 Unauthorized");	
	print "Oops! It require login to proceed further. Please enter your login detail\n";
	exit;
}else{
	if ($_SERVER['PHP_AUTH_USER'] == RAPI_ID && $_SERVER['PHP_AUTH_PW'] == RAPI_KEY) {
		//echo 'User validated';
		//exit;
	}else{		
		header("WWW-Authenticate: Basic realm=\"Please enter your username and password to proceed further\"");
		header("HTTP/1.0 401 Unauthorized");
		print "Oops! It require login to proceed further. Please enter your login detail\n";
		exit;
	}
}
*/		
 $tag= get_input("tag",'');  

if(is_not_empty($tag)){   

    // response Array
    $_response = array("tag" => $tag, "success" => 0, "message" => '');
    $restaurant_id = get_input("restaurant_id",1); 
	$_SESSION[SES_RESTAURANT]=$restaurant_id;
    $objtbl_rest_menu_opt = new tbl_rest_menu_opt();	
	$rest_menu_opt_det=$objtbl_rest_menu_opt->GetInfo(0,$_SESSION[SES_RESTAURANT]);
	$_SESSION['rest_menu_opt_det']=$rest_menu_opt_det;
	unset($objtbl_rest_menu_opt);
	$_RWD_CONFIG_TYPE=$_SESSION['rest_menu_opt_det'][RST_MNU_REWARD_CONF];
	//$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
	
    // check for tag type
    if ($tag == 'restaurant_profile'){	
    	if(is_gt_zero_num($restaurant_id)){
			$rest_info = tbl_restaurent::GetInfoNew($_SESSION[SES_RESTAURANT]);
			$_response["error"] = 0;
			$_response["success"] = 1;
			$_response["rest_profile"] = $rest_info;
	        $_response["message"] = "Restaurant profile fetched successfully.";
		}else{
			$_response["error"] = 1;
			$_response["success"] = 0;
	        $_response["message"] = "Please provide restaurant id to proceed.";			
		}	
	}elseif ($tag == 'restaurant_listing'){
		$result_found=0; //isActiveIncRestlgy
		$_usr_lat = get_input("user_lat");
		$_usr_long = get_input("user_long");
		$_filt_location = get_input("filt_location",'');
		//echo '(ddd)'.$_usr_lat. '-'. $_usr_long;
		
		$restaurant_list =  tbl_restaurent::readArray(array('_without_ids'=>1,RESTAURENT_FAX => $_filt_location,'isActive'=>1,'_get_me_offer'=>'y','usr_lat'=>$_usr_lat,'usr_long'=>$_usr_long,OFFSET_TITLE=>0,LIMIT_TITLE => 50,SORT_ON=> 'distance',SORT_BY=>'ASC'),$result_found); 
		/*
		if(is_not_empty($restaurant_list)){
			shuffle($restaurant_list);
		}*/
		
		//array_shift($restaurant_list);
		//print_r($restaurant_list);
		
		$_response["success"] = 1;
		$_response["rest_list"] = $restaurant_list;
        $_response["message"] = "Restaurant listing fetched successfully.";		
    
    }elseif ($tag == 'restaurant_search'){
		$result_found=0;
		$keyword=get_input('keyword',1);
		if(is_not_empty($keyword)){
			$restaurant_list =  tbl_restaurent::readArray(array('isActive'=>1,'keyword'=>$keyword),$result_found);
			$_response["success"] = 1;
			$_response["rest_list"] = $restaurant_list;
	        $_response["message"] = "Restaurant listing fetched successfully.";
		}else{
			$_response["success"] = 0;
	        $_response["message"] = "Please provide keyword to search Restaurant.";
		}
   
	}elseif ($tag == 'restaurant_locations'){
		$result_found=0;
		$restaurant_loc_list =  tbl_restaurent::GetLocations(array('isActive'=>1,'key_field' => RESTAURENT_FAX),$result_found);
		$_response["success"] = 1;
		$_response["rest_loc_list"] = $restaurant_loc_list;
        $_response["message"] = "Restaurant Locations fetched successfully.";
        
		/*$keyword=get_input('keyword','');
		if(is_not_empty($keyword)){
			$restaurant_loc_list =  tbl_restaurent::GetLocations(array('isActive'=>1,'key_field' => RESTAURENT_FAX,'filt_field' => RESTAURENT_FAX,'keyword'=>$keyword),$result_found);
			$_strOp= '<ul id="country-list">';		
			foreach($restaurant_loc_list as $loc){			
				$_strOp .= '<li class="search-box-field" srch_loc_id="'.$loc[RESTAURENT_FAX].'">'.$loc[RESTAURENT_FAX].'</li>';
			} 
			$_strOp .= '</ul>';			
			$_response["success"] = 1;
			$_response["filt_lst"] = $_strOp;
			
			//$_response["success"] = 1;
			//$_response["rest_list"] = $restaurant_loc_list;
	        //$_response["message"] = "Restaurant Locations fetched successfully.";
		}else{
			$_response["success"] = '';
	        $_response["message"] = "Please provide keyword to search location Restaurant.";
		}*/
   
	}elseif($tag == 'add_to_favorite_rest'){	   
    	$user_id=get_input('user_id',0);
    	$rest_id=get_input('rest_id',0);
    	$objtbl_rest_favorite= new tbl_rest_favorite();
    	if(is_gt_zero_num($user_id)){			
			if(is_gt_zero_num($rest_id)){
				$result_found=0;
				$_fav_rec=$objtbl_rest_favorite->readArray(array(REST_FAV_USER_ID=>$user_id,REST_FAV_RESTAURANT_ID=>$rest_id),$result_found);
				if(is_not_empty($_fav_rec) && is_gt_zero_num($result_found)){
					$_response['success']	= 0;
					$_response['message']	= 'Restaurant is already favorite Restaurant.';
				}else{
					$isSuccess = $objtbl_rest_favorite->create($user_id, $rest_id, '', '');
					$_response['success']	= 1;
					$_response['message']	= 'Restaurant added to favorite successfully.';
				}				
			}else{
				$_response['success']	= 0;
				$_response['message']	= 'Please provide the restaurant before proceed.';
			}			
		}else{
			$_response['success'] 	  = 0;
			$_response['message'] ='Please provide user id before proceed.';
		} 
		
    }elseif($tag == 'remove_from_favorite_rest'){
    		   
    	$user_id=get_input('user_id',0);
    	$rest_id=get_input('rest_id',0);
    	$objtbl_rest_favorite= new tbl_rest_favorite();
    	if(is_gt_zero_num($user_id)){			
			if(is_gt_zero_num($rest_id)){
				$result_found=0;
				$_fav_rec=$objtbl_rest_favorite->readArray(array(REST_FAV_USER_ID=>$user_id,REST_FAV_RESTAURANT_ID=>$rest_id),$result_found);
				if(is_not_empty($_fav_rec) && is_gt_zero_num($result_found)){
					$isSuccess = $objtbl_rest_favorite->delete(array(REST_FAV_USER_ID=>$user_id,REST_FAV_RESTAURANT_ID=>$rest_id));
					$_response['success']	= 1;
					$_response['message']	= 'Restaurant is successfully removed from favorite Restaurant.';
				}else{					
					$_response['success']	= 0;
					$_response['message']	= 'Restaurant not in favorite.';
				}				
			}else{
				$_response['success']	= 0;
				$_response['message']	= 'Please provide the restaurant before proceed.';
			}			
		}else{
			$_response['success'] 	  = 0;
			$_response['message'] ='Please provide user id before proceed.';
		} 
	}else{
		$_response["error"] = 1;
        $_response["error_msg"] = "Invalid Request";
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