<?php
 include("../service_init.php");
		
 $tag= get_input("tag",'');
 
if(is_not_empty($tag)){   

    // Response Array
    $_response = array("tag" => $tag, "success" => 0, "message" => '');
	$restaurant_id = get_input("restaurant_id",1); 
	$_SESSION[SES_RESTAURANT]=$restaurant_id;
	
	$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
	$limit 	=  get_input(LIMIT_TITLE,LIMIT_VALUE);
	$sort_on = get_input(SORT_ON,'menu_id');
	$sort_by = get_input(SORT_BY,'ASC');
	
    // Check for tag type
   if($tag=='rate_dish'){
   	
   		$user_type =CUST_TYPE_LOGIN;
   		$post_id = get_input('post_id');
   		$user_id = get_input('user_id',0);
   		
   		$post_type = 'SubMenuDish';
		$post_title= get_sql_input('post_title');

		$recomm_title= '--';
		$recomm_desc = '--';
		$recomm_rating= get_input('recomm_rating');
		$recomm_QOS_rating= 0;
		$recomm_QOF_rating= 0;
		$recomm_ambience_rating= 0;

		$recomm_email= get_sql_input('recomm_email');
		$recomm_phone= get_sql_input('recomm_phone');
		$recomm_table= get_input('recomm_table');
		
		$objtbl_feedback= new tbl_feedback();
   		$isSuccess = $objtbl_feedback->create($post_id, $post_title, $post_type, $user_id, $recomm_title, $recomm_desc, $recomm_rating, $recomm_QOS_rating, $recomm_QOF_rating, $recomm_ambience_rating,$user_type,$recomm_email,$recomm_phone,$recomm_table);
   		
   		if(is_gt_zero_num($isSuccess)){
   			$_response['success']=1;
			$_response['message']= $_lang['tbl_feedback']['RATE']['SUCCESS_MSG'];
		}elseif($isSuccess == OPERATION_FAIL){
			$_response['success']= 0;
			$_response['message']= $_lang['tbl_feedback']['RATE']['FAILURE_MSG'];
		}elseif($isSuccess == OPERATION_DUPLICATE){
			$_response['success']= -1;
			$_response['message']= $_lang['tbl_feedback']['RATE']['DUPLICATE_MSG'];
		}
   		
   }elseif ($tag == 'get_submnu_dish_det') {
   	
   		$sbmnu_dish_id= get_input('sbmnu_dish_id',0);	
   		$_response['dish_details'] =array();
   		if(is_gt_zero_num($sbmnu_dish_id)){
   			$only_matched=1;
			$objtbl_submenu_dishes= new tbl_submenu_dishes();
	   		$tbl_submenu_dishesinfo= $objtbl_submenu_dishes->GetInfo($sbmnu_dish_id);
				
			$dish_option_prices =   tbl_sbmnu_dish_opt_price::getAllOptionValuePricesForDish($sbmnu_dish_id,$tbl_submenu_dishesinfo[SBMNU_DISH_DISH],$only_matched);		
			$submenu_option_prices =   tbl_sbmnu_dish_opt_price::getAllOptionValuePricesForSubmenu($sbmnu_dish_id,$tbl_submenu_dishesinfo[SBMNU_DISH_SUBMENU],$only_matched);
	  
			$tbl_submenu_dishesinfo['optionsPrice'] = array_merge($dish_option_prices,$submenu_option_prices); 
			
			unset($dish_option_prices);	
			unset($submenu_option_prices);
			$_response['dish_details']=$tbl_submenu_dishesinfo;
			$_response['success']=1;
			$_response['message']='Dish details fetched successfully';
			//print_r($tbl_submenu_dishesinfo);
			//exit;
		}else{
			$_response['success']=0;
			$_response['message']='Please select the sub menu dish item to view the details';
		}  
		 		
    }elseif ($tag == 'filter_menu') {		

		$search_attrib= get_input('search_attrib',array());
		$search_keyword= get_input('search_keyword','');
		$search_price= get_input('search_price',0);		
		$search_submenu= get_input('search_submenu',0);
		$search_allergy= get_input('search_allergy',array());
		//$restaurant_id = get_input("restaurant_id",1); 
		
		$menu_filt= tbl_submenu_dishes::_customer_filter_menu($search_attrib,$search_keyword,$search_price,$search_submenu,$search_allergy,$search_menu,$restaurant_id);	
		$_response['success']=1;
		$_response['menu_list'] = serv_get_full_menu($menu_id,$restaurant_id,$menu_filt);  
        
    }elseif ($tag == 'get_fullmenu') {		

		$phone = get_input("email",'');	
		$menu_id = get_input("menu_id",0);
		//$restaurant_id = get_input("restaurant_id",1);        
        if(is_gt_zero_num($menu_id)){
			$_response['success']	= 1;
        	$_response['menu_list'] = serv_get_full_menu($menu_id,$restaurant_id);
		}else{
			$_response['success']	= 0;
			$_response['message']	= 'Please provide menu id to fetch full menu.';
		}				
		
        /*$filt_mnu=
  '{
    "tag": "get_fullmenu",
    "success": 1,
    "message": "",
    "menu_list": {
        "menu_id": "5",
        "menu_name": "Appetizers",
        "menu_category": "1",
        "menu_desc": "All Appetizers are served in table size suitable for 4 guests.",
        "menu_image": "1402383643_1381206910_appetizer.jpg",
        "menu_restaurent": "1",
        "isActive": 1,
        "submenu": [
            {
                "submnu_id": "2",
                "submnu_image": "",
                "submnu_name": "Soup Bowl",
                "submnu_menu": "5",
                "submnu_display_order": "0",
                "submnu_description": "Soups in a variety of meat and pasta convenience food dishes, such as casseroles",
                "submnu_spl_note": "",
                "submnu_start_date": "2013-04-13 03:25:59",
                "submnu_end_date": "0000-00-00 00:00:00",
                "menu_name": "Appetizers",
                "isActive": 1,
                "dishes_count": 2,
                "dishes": {
                    "7": {
                        "sbmnu_dish_id": "7",
                        "sbmnu_dish_submenu": "2",
                        "submnu_name": "Soup Bowl",
                        "menu_name": "Appetizers",
                        "menu_id": "5",
                        "sbmnu_dish_dish": "8",
                        "sbmnu_dish_dish_details": {
                            "dish_id": "8",
                            "dish_name": "Tomino cheese with grilled vegetables",
                            "dish_chef_notes": "Range Dressing -Thousand Island-Cesar\'s Dressing-Truffle Dressing-Lemon Herbs Olive Oil Toasted Croutons-Bacon-Parmesan Shaved",
                            "dish_ingrad_allergic_contents": "-grilled zucchini\r\n-grilled aubergine\r\n-grilled chicory\r\n-grilled tomatoes\r\n-unseasoned\r\n-toasted bread"
                        }
                       },
                      "8": {
                        "sbmnu_dish_id": "8",
                        "sbmnu_dish_submenu": "2",
                        "submnu_name": "Soup Bowl",
                        "menu_name": "Appetizers",
                        "menu_id": "5",
                        "sbmnu_dish_dish": "8",
                        "sbmnu_dish_dish_details": {
                            "dish_id": "9",
                            "dish_name": "SECOND DISSSSSSSSHHHH",
                            "dish_chef_notes": "Range Dressing -Thousand Island-Cesar\'s Dressing-Truffle Dressing-Lemon Herbs Olive Oil Toasted Croutons-Bacon-Parmesan Shaved",
                            "dish_ingrad_allergic_contents": "-grilled zucchini\r\n-grilled aubergine\r\n-grilled chicory\r\n-grilled tomatoes\r\n-unseasoned\r\n-toasted bread"
                        }
                       }
                  }    
              }
            ]
        }                   
     }';
        $_response['menu_list'] = $filt_mnu;*/
        //var_dump($_response);
        //exit;      
        
    }elseif($tag == 'get_menu_list') {    			
		/*
		$offset = get_input(OFFSET_TITLE,OFFSET_VALUE);
		$limit =  get_input(LIMIT_TITLE,LIMIT_VALUE);
		$sort_on = get_input(SORT_ON,'menu_display_order');
		*/
		//$restaurant_id = get_input("restaurant_id",1);
		if(is_gt_zero_num($restaurant_id)){
			$objtbl_menu	= new tbl_menu();
			$mnu_filt_con=array('isActive'=>1,OFFSET_TITLE=>$offset,LIMIT_TITLE=>$limit,SORT_BY=>$sort_by,SORT_ON=>$sort_on,MENU_RESTAURENT=>$restaurant_id);		
			$tbl_menulist = $objtbl_menu->readArray($mnu_filt_con,$result_found,1,1,1);
			$_response['menu_list']	= $tbl_menulist;
			$_response['success']	= 1;
			$_response['message']	= 'Menu fetch successfull';
		}else{
			$_response['success']	= 0;
			$_response['message']	= 'Please provide the restaurant to fetch menu.';
		}				
    }elseif($tag == 'get_attrib_list') {
		//$restaurant_id = get_input("restaurant_id",1);		
		if(is_gt_zero_num($restaurant_id)){
			$lst_dish_attribs=tbl_dish_attrib::GetFields(array('key_field'=>DISH_ATTRIB_ID,'value_field'=>DISH_ATTRIB_NAME,'isActive'=>1));
			$_response['attrib_list']	= $lst_dish_attribs;
			$_response['success']		= 1;
			$_response['message']		= 'Attributes list fetch successful';
		}else{
			$_response['success']		= 0;
			$_response['message']		= 'Please provide the restaurant before proceed.';
		}				
				
    }elseif($tag == 'get_allergy_list') {
		if(is_gt_zero_num($restaurant_id)){
			//$restaurant_id = get_input("restaurant_id",1);
			$lst_allergies=tbl_allergy_list::GetFields(array('key_field'=>ALERGY_ID,'value_field'=>ALERGY_NAME,'isActive'=>1));
			$_response['allergy_list']	= $lst_allergies;
			$_response['success']		= 1;
			$_response['message']		= 'Allergies list fetch successful';
		}else{
			$_response['success']		= 0;
			$_response['message']		= 'Please provide the restaurant before proceed.';
		}
				
   }elseif($tag == 'get_submnu_list') {
		//$restaurant_id = get_input("restaurant_id",1);
		if(is_gt_zero_num($restaurant_id)){
			//$restaurant_id = get_input("restaurant_id",1);
			$lst_sub_menu=tbl_sub_menu::GetFields(array('key_field'=>SUBMNU_ID,'value_field'=>SUBMNU_NAME,'isActive'=>1));	
			$_response['submnu_list']	= $lst_sub_menu;
			$_response['success']		= 1;
			$_response['message']		= 'Sub menu list fetch successful';
		}else{
			$_response['success']	= 0;
			$_response['message']	= 'Please provide the restaurant before proceed.';
		}				
  }else{
    	
		$_response["error"] 	= 1;
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