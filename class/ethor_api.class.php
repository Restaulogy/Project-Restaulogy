<?php

//..Ethor configuration paramters
//define('ETHOR_STORE', 'HI6PIDO5JS'); 
//define('ETHOR_STORE', 'I4EDIVAZW8'); 
define('ETHOR_API_KEY', 'wSgbv9PE8aJhDOI17vvTUX1NlAceUXG7');

class ethor_api {

//..Parse url get curl response in json format
public function _parse_url_get_response($url,$_use_filegetcont=0,$data=array()){
	//$url = 'https://ethor-test.apigee.net/v1/stores/HI6PIDO5JS/menu.json?apikey=wSgbv9PE8aJhDOI17vvTUX1NlAceUXG7&offset=0&limit=10';
	$json_data=array();

	if($_use_filegetcont==1){
		if(is_not_empty($data)){
			$url=$url.'&amp;'.urlencode(json_encode($data));
		}		
		//$url=$url.'&amp;'.urlencode(json_encode($data));
		//echo $url;
		$result =file_get_contents($url);
		/*$xml = simplexml_load_string($result);
		$result = json_encode($xml);*/
		/*$options = array(
		    'http' => array(
		        'method'  => 'POST',
		        'content' => json_encode($data),
		        'header'=>  "Content-Type: application/json\r\n" .
		                    "Accept: application/json\r\n"
		      )
		);		 
		$context     = stream_context_create($options);
		print_r($context);
		$result      = file_get_contents($url, false, $context);*/
	}else{
		/*$content = json_encode($data);
 
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER,
		        array("Content-type: application/json","Accept: application/json"));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
		//curl_setopt ($curl, CURLOPT_PORT , 8089); 
		//curl_setopt($curl, CURLOPT_SSLVERSION,3);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //curl error SSL certificate problem, verify that the CA cert is OK		 
		$result     = curl_exec($curl);		
		//$response   = json_decode($result);
		//var_dump($response);
		curl_close($curl);	*/	
		$result =biz_file_get_contents($url);
	}
	//print_r($result);
	
	if(is_not_empty($result)){
		$json_data = json_decode($result, true);
	}
	
	return $json_data;	
} 

//..fetch menu
public function _fetch_menu(){
	$_str='';
	//$_MENU_URL='https://ethor-test.apigee.net/v1/stores/'.ETHOR_STORE.'/menu.json?apikey='.ETHOR_API_KEY.'&offset=0&limit=100';
	$_MENU_URL='https://ethor-test.apigee.net/v1/stores/HI6PIDO5JS/menu.json?apikey=wSgbv9PE8aJhDOI17vvTUX1NlAceUXG7&offset=0&limit=100';
	//..fetch the menu
	$obj=$this->_parse_url_get_response($_MENU_URL,1);
	//..get the main categories
	$category_count=$obj['menu']['category_count'];	
	for ($i = 0; $i < $category_count; $i++) { 
			// Categories
      $item_count = $obj['menu']['categories'][$i]['item_count'];
      $_str .= '<br><h3>'.$obj['menu']['categories'][$i]['category_name'].'</h3><br>';

      for ($j = 0; $j < count($obj['menu']['categories'][$i]['menu_items']); $j++) {
			 // Items in each category
          if ($obj['menu']['categories'][$i]['menu_items'][$j]['out_of_stock'] == false){
						$_str .= $obj['menu']['categories'][$i]['menu_items'][$j]['menu_item_name'].'---- $'. $obj['menu']['categories'][$i]['menu_items'][$j]['from_price'].'<br>';
					}else{
						$_str .= $obj['menu']['categories'][$i]['menu_items'][$j]['menu_item_name'].'---- $'. $obj['menu']['categories'][$i]['menu_items'][$j]['from_price'].' (Out of Stock)<br>';
					}				
					
      }
  }
	return $_str;	
}

//..Import menu
public function _import_menu(){
	$_str='';
	$_MENU_URL='https://ethor-test.apigee.net/v1/stores/'.$_SESSION['curr_restant'][RESTAURENT_ETHOR_STORE].'/menu.json?apikey='.ETHOR_API_KEY.'&offset=0&limit=100';
	//..fetch the menu
	$obj=$this->_parse_url_get_response($_MENU_URL,1);
	
	if(is_not_empty($obj)){
			
	//..Get the main categories
	$category_count=$obj['menu']['category_count'];	
	for ($i = 0; $i < $category_count; $i++) { 
			// Categories
      $item_count = $obj['menu']['categories'][$i]['item_count'];
      $_str .= '<h1>'.$obj['menu']['categories'][$i]['category_name'].'</h1><br>';
			//..get the menu id and name
			$cat_id=$obj['menu']['categories'][$i]['category_id'];
			$menu_name=$obj['menu']['categories'][$i]['category_name'];
			
			if(is_not_empty($cat_id)){	
				//...Step-A] Add to menu
				$menu_category= 1;//..Breakfast Time
				$menu_display_order= 0;
				$menu_route= 5;//..kitchen
				$menu_desc=$menu_name;
				$menu_image='';
			  $menu_start_timing='00:01:00';
				$menu_end_timing='23:59:00';
				$menu_restaurent = $_SESSION[SES_RESTAURANT];
				$menu_ethor_cat_id=$cat_id;				
				$mnu_wkdy_sunday_start= '00:01:00';
				$mnu_wkdy_sunday_end= '23:59:00';
				$mnu_wkdy_monday_start= '00:01:00';
				$mnu_wkdy_monday_end= '23:59:00';
				$mnu_wkdy_tuesday_start= '00:01:00';
				$mnu_wkdy_tuesday_end= '23:59:00';;
				$mnu_wkdy_wednesday_start= '00:01:00';
				$mnu_wkdy_wednesday_end= '23:59:00';
				$mnu_wkdy_thursday_start= '00:01:00';
				$mnu_wkdy_thursday_end= '23:59:00';
				$mnu_wkdy_friday_start= '00:01:00';
				$mnu_wkdy_friday_end= '23:59:00';
				$mnu_wkdy_saturday_start= '00:01:00';
				$mnu_wkdy_saturday_end= '23:59:00';

				
				$mnu_wkdy_sunday=$mnu_wkdy_monday=$mnu_wkdy_tuesday=$mnu_wkdy_wednesday=$mnu_wkdy_thursday=$mnu_wkdy_friday=$mnu_wkdy_saturday='Y';		
				
				$objtbl_menu= new tbl_menu();
				$objtbl_mnu_weekdays= new tbl_mnu_weekdays();
				//...Check if menu is already present
				$_cur_mnu=$objtbl_menu->readObject(array(MENU_RESTAURENT=>$menu_restaurent,MENU_ETHOR_CAT_ID=>$menu_ethor_cat_id));
			
				if(is_not_empty($_cur_mnu)){
					//..menu already present update now
					$_mnu_insert_id=$objtbl_menu->getmenu_id();
					$_rstlt = $objtbl_menu->update($_mnu_insert_id,mysql_real_escape_string($menu_name), $menu_category, mysql_real_escape_string($menu_desc), $menu_image, $menu_start_timing, $menu_end_timing, $menu_restaurent,$menu_route,$menu_display_order,$menu_ethor_cat_id);
				}else{
					//..menu not found insert now
					$_mnu_insert_id = $objtbl_menu->create(mysql_real_escape_string($menu_name), $menu_category, mysql_real_escape_string($menu_desc), $menu_image, $menu_start_timing, $menu_end_timing, $menu_restaurent,$menu_route,$menu_display_order,$menu_ethor_cat_id);
										
				}	
				if($_mnu_insert_id>0){			
				
				$cor_weekDay_rec=$objtbl_mnu_weekdays->GetMenuInfo($_mnu_insert_id);
				if(is_not_empty($cor_weekDay_rec)){
						$isSuccess =$objtbl_mnu_weekdays->update($cor_weekDay_rec["mnu_wkdy_id"],$_mnu_insert_id ,$mnu_wkdy_sunday ,$mnu_wkdy_monday ,$mnu_wkdy_tuesday ,$mnu_wkdy_wednesday ,$mnu_wkdy_thursday ,$mnu_wkdy_friday ,$mnu_wkdy_saturday,$mnu_wkdy_sunday_start, $mnu_wkdy_sunday_end, $mnu_wkdy_monday_start, $mnu_wkdy_monday_end, $mnu_wkdy_tuesday_start, $mnu_wkdy_tuesday_end, $mnu_wkdy_wednesday_start, $mnu_wkdy_wednesday_end, $mnu_wkdy_thursday_start, $mnu_wkdy_thursday_end, $mnu_wkdy_friday_start, $mnu_wkdy_friday_end, $mnu_wkdy_saturday_start, $mnu_wkdy_saturday_end);
				}else{
						$isSuccess =$objtbl_mnu_weekdays->create($_mnu_insert_id ,$mnu_wkdy_sunday ,$mnu_wkdy_monday ,$mnu_wkdy_tuesday ,$mnu_wkdy_wednesday ,$mnu_wkdy_thursday ,$mnu_wkdy_friday ,$mnu_wkdy_saturday,$mnu_wkdy_sunday_start, $mnu_wkdy_sunday_end, $mnu_wkdy_monday_start, $mnu_wkdy_monday_end, $mnu_wkdy_tuesday_start, $mnu_wkdy_tuesday_end, $mnu_wkdy_wednesday_start, $mnu_wkdy_wednesday_end, $mnu_wkdy_thursday_start, $mnu_wkdy_thursday_end, $mnu_wkdy_friday_start, $mnu_wkdy_friday_end, $mnu_wkdy_saturday_start, $mnu_wkdy_saturday_end);
				}				
				unset($objtbl_menu);
				unset($tbl_mnu_weekdays);
				unset($cor_weekDay_rec);
				}
				//...Step-B] Add sub menu
				$submnu_name=$submnu_description=$menu_name;
				$submnu_menu=$_mnu_insert_id;
				$submnu_spl_note=$submnu_start_date=$submnu_end_date=$submnu_image='';
				//echo "submnu_menu=$submnu_menu <br>";
				$objtbl_sub_menu=new tbl_sub_menu();
				$_cur_sub_mnu=$objtbl_sub_menu->readObject(array(SUBMNU_MENU=>$submnu_menu));
				//print_r($objtbl_sub_menu);
				//echo "_cur_sub_mnu=$_cur_sub_mnu <br>";
				if(is_not_empty($_cur_sub_mnu)){
					//echo "in";
					$_submnu_insert_id=$objtbl_sub_menu->getsubmnu_id();
					$_rslt = $objtbl_sub_menu->update($_submnu_insert_id,$submnu_name, $submnu_menu, $submnu_display_order, $submnu_description, $submnu_spl_note, $submnu_start_date, $submnu_end_date,$submnu_image);
				}else{
					//echo "out";
					$_submnu_insert_id = $objtbl_sub_menu->create($submnu_name, $submnu_menu, $submnu_display_order, $submnu_description, $submnu_spl_note, $submnu_start_date, $submnu_end_date,$submnu_image);
				}
				unset($objtbl_sub_menu);
				//exit;
			}
      for ($j = 0; $j < count($obj['menu']['categories'][$i]['menu_items']); $j++) {
					//..get Item details
					$item_id=$obj['menu']['categories'][$i]['menu_items'][$j]['menu_item_id'];
					$item_name=$obj['menu']['categories'][$i]['menu_items'][$j]['menu_item_name'];
				 $item_desc=$obj['menu']['categories'][$i]['menu_items'][$j]['description_html'];
					$item_price=$obj['menu']['categories'][$i]['menu_items'][$j]['from_price'];
					$item_img=$obj['menu']['categories'][$i]['menu_items'][$j]['menu_item_image'];					
					//exit;
					//..Add plain dish
					$dish_is_nutrition_text=1;
					$dish_is_drink=0;
					$dish_food_wine_pair=array();
					$dish_name=$item_name;
					$dish_chef_notes=$item_desc;
					$dish_img=$item_img;	
					$dish_restaurent=$menu_restaurent;	
					$dish_ingrad_allergic_contents= $dish_nutri_cal_info= $dish_notes= $dish_winery= $dish_type_cat= $dish_alcohol_percent= $dish_vintage= $dish_varietal=$dish_region=$dish_country=$dish_bottle_price= $dish_glass_price=$dish_winemaking=$dish_maturity= $dish_allergy= $dish_food_wine_pair= $dish_attributes= $dish_pair_note= $dish_is_nutrition_text= $dish_food_notes='';
					
					$objtbl_dishes=new tbl_dishes();	
					$_cur_dish=$objtbl_dishes->readObject(array(DISH_ETHOR_MNU_ITM_ID=>$item_id,DISH_RESTAURENT=>$dish_restaurent));
					if(is_not_empty($_cur_dish)){
						//..Update Dish
						$_dish_insert_id=$objtbl_dishes->getdish_id();
						$_rslt = $objtbl_dishes->update($_dish_insert_id,$dish_name,$dish_chef_notes, $dish_ingrad_allergic_contents, $dish_nutri_cal_info, $dish_notes, $dish_img, $dish_winery, $dish_type_cat, $dish_alcohol_percent, $dish_vintage, $dish_varietal, $dish_region, $dish_country, $dish_bottle_price, $dish_glass_price, $dish_winemaking, $dish_maturity, $dish_is_drink, $dish_restaurent,$dish_allergy,$dish_food_wine_pair,$dish_attributes,$dish_pair_note,$dish_is_nutrition_text,$dish_food_notes,$item_id,$item_img);		
					}else{
						//..Insert new dish
						$_dish_insert_id = $objtbl_dishes->create($dish_name,$dish_chef_notes, $dish_ingrad_allergic_contents, $dish_nutri_cal_info, $dish_notes, $dish_img, $dish_winery, $dish_type_cat, $dish_alcohol_percent, $dish_vintage, $dish_varietal, $dish_region, $dish_country, $dish_bottle_price, $dish_glass_price, $dish_winemaking, $dish_maturity, $dish_is_drink, $dish_restaurent,$dish_allergy,$dish_food_wine_pair,$dish_attributes,$dish_pair_note,$dish_is_nutrition_text,$dish_food_notes,$item_id,$item_img);
					}
					
					/*echo "<br> item_id=$item_id|item_name=$item_name|item_desc=$item_desc|item_price=$item_price|item_img=$item_img |||_dish_insert_id=$_dish_insert_id| _submnu_insert_id=$_submnu_insert_id| <br>";	*/
				if(is_gt_zero_num($_dish_insert_id) && is_gt_zero_num($_submnu_insert_id)){
									
					//..SUB MENU DISH
					$sbmnu_dish_price=$item_price;
					$sbmnu_dish_display_order=0;
					$sbmnu_dish_desc=$item_desc;
					$sbmnu_dish_start_date=$sbmnu_dish_end_date='';
					$objtbl_submenu_dishes=new tbl_submenu_dishes();
					$_cur_submnu_dish=$objtbl_submenu_dishes->readObject(array(SBMNU_DISH_SUBMENU=>$_submnu_insert_id,SBMNU_DISH_DISH=>$_dish_insert_id));

					if(is_not_empty($_cur_submnu_dish)){
						//..update sub menu dish
						$_submnudish_insert_id=$objtbl_submenu_dishes->getsbmnu_dish_id();
						$isSuccess = $objtbl_submenu_dishes->update($_submnudish_insert_id,$_submnu_insert_id, $_dish_insert_id, $sbmnu_dish_price, $sbmnu_dish_display_order, mysql_real_escape_string($sbmnu_dish_desc), $sbmnu_dish_start_date, $sbmnu_dish_end_date);
					}else{
						//..Insert new submenu dish
						$_submnudish_insert_id = $objtbl_submenu_dishes->create($_submnu_insert_id, $_dish_insert_id, $sbmnu_dish_price, $sbmnu_dish_display_order, mysql_real_escape_string($sbmnu_dish_desc), $sbmnu_dish_start_date, $sbmnu_dish_end_date);	
					}
					
					// Items in each category
          if ($obj['menu']['categories'][$i]['menu_items'][$j]['out_of_stock'] == false){
						$_str .= '<br><b>'.$obj['menu']['categories'][$i]['menu_items'][$j]['menu_item_name'].'---- $'. $obj['menu']['categories'][$i]['menu_items'][$j]['from_price'].'</b><br>';
					}else{
						$_str .= '<br><b>'.$obj['menu']['categories'][$i]['menu_items'][$j]['menu_item_name'].'---- $'. $obj['menu']['categories'][$i]['menu_items'][$j]['from_price'].' (Out of Stock)</b><br>';
					}		
					
					//=======START MENU DISH OPTIONS===============
					//..Each Menu item options..i.e variants
					$_MENU_ITEM_URL='https://ethor-test.apigee.net/v1/stores/'.$_SESSION['curr_restant'][RESTAURENT_ETHOR_STORE].'/menu/items/'.$item_id.'.json?apikey='.ETHOR_API_KEY;		
					$objtbl_dish_options=new tbl_dish_options();
					$objtbl_dish_options_values=new tbl_dish_options_values();		
					$tbl_sbmnu_dish_opt_price=new tbl_sbmnu_dish_opt_price();			
					$_mnuitm_details=$this->_parse_url_get_response($_MENU_ITEM_URL,1);
					if(is_not_empty($_mnuitm_details)){							
							if(count($_mnuitm_details['menu_item']['variants'])>0){
									$_str .= '------------ Variants -----------<br>';
									//..Add/edit to dish options 
									$_cur_dsh_options=$objtbl_dish_options->readObject(array(DISH_OPT_DISH_ID=>$_dish_insert_id,DISH_OPT_NAME=>'Options'));		
									if(is_not_empty($_cur_dsh_options)){
										//..Dish Option already present update now
									 $_dsh_opt_insert_id=$objtbl_dish_options->getdish_opt_id();
									 $rslt_fn = $objtbl_dish_options->update($_dsh_opt_insert_id,$_dish_insert_id, 'Options', 'dropdown', 0,0);
									}else{
											//..Insert into dish options 
											$_dsh_opt_insert_id = $objtbl_dish_options->create($_dish_insert_id, 'Options', 'dropdown', 0,0);
									}		
									
									for($k = 0;$k<count($_mnuitm_details['menu_item']['variants']);$k++){
										//..Add/edit to dish option values
										$_cur_dsh_opt_val=$objtbl_dish_options_values->readObject(array(DISH_OPT_VAL_OPTION_ID=>$_dsh_opt_insert_id,DISH_OPT_VAL_ETHOR_VARIANT=>$_mnuitm_details['menu_item']['variants'][$k]['variant_id']));		
										if(is_not_empty($_cur_dsh_opt_val)){
											//..Opt value already present update now
											$_dsh_opt_val_insert_id=$objtbl_dish_options_values->getdish_opt_val_id();
											$_rslt_suc = $objtbl_dish_options_values->update($_dsh_opt_val_insert_id,$_dsh_opt_insert_id, $_mnuitm_details['menu_item']['variants'][$k]['variant_name'],$_mnuitm_details['menu_item']['variants'][$k]['variant_id']);
										}else{
											$_dsh_opt_val_insert_id = $objtbl_dish_options_values->create($_dsh_opt_insert_id, $_mnuitm_details['menu_item']['variants'][$k]['variant_name'],$_mnuitm_details['menu_item']['variants'][$k]['variant_id']);
										} 
										
										$_str .= '--'.$_mnuitm_details['menu_item']['variants'][$k]['variant_name'].'-'.$_mnuitm_details['menu_item']['variants'][$k]['total_price'].'<br>';
									
										//..Add/edit to tbl_sbmnu_dish_opt_price 									
										$_cur_sbmnu_dish_opt_price=$tbl_sbmnu_dish_opt_price->readObject(array(SBMDOPT_PR_SBMNU_DISH=>$_submnudish_insert_id,SBMDOPT_PR_OPTION_VALUE=>$_dsh_opt_val_insert_id));		
										if(is_not_empty($_cur_sbmnu_dish_opt_price)){
											//..Dish Option already present update now
										 $_sbmnu_dish_opt_price_insert_id=$tbl_sbmnu_dish_opt_price->getsbmdopt_pr_id();
										 $rslt_fn_s = $tbl_sbmnu_dish_opt_price->update($_sbmnu_dish_opt_price_insert_id, $_submnudish_insert_id, $_dsh_opt_val_insert_id, $_mnuitm_details['menu_item']['variants'][$k]['total_price']);
										}else{
												//..Insert into dish options 
												$_sbmnu_dish_opt_price_insert_id = $tbl_sbmnu_dish_opt_price->create($_submnudish_insert_id, $_dsh_opt_val_insert_id, $_mnuitm_details['menu_item']['variants'][$k]['total_price']);
										}	
																		
									}	 //..end..for loop through variants 	
							}	//..if(count($_mnuitm_details['menu_item']['variants']>0)){			
							
							
							//============ START MENU DISH MODIFIERS ===============
							if(count($_mnuitm_details['menu_item']['modifier_groups'])>0){
								$_str .= '------------ Modifiers -----------<br>';
								for($z = 0;$z<count($_mnuitm_details['menu_item']['modifier_groups']);$z++){
									//..Add/edit to dish options
									if($_mnuitm_details['menu_item']['modifier_groups'][$z]['max_modifier_selection']==1){
										$_op_ty='dropdown';
									}else{
										$_op_ty='checkbox';
									}
									$_cur_dsh_options=$objtbl_dish_options->readObject(array(DISH_OPT_DISH_ID=>$_dish_insert_id,DISH_OPT_NAME=>$_mnuitm_details['menu_item']['modifier_groups'][$z]['modifier_group_name'],DISH_OPT_TYPE=>$_op_ty));		
									if(is_not_empty($_cur_dsh_options)){
										//..Dish Option already present update now
									 $_dsh_opt_insert_id=$objtbl_dish_options->getdish_opt_id();
									 $rslt_fn = $objtbl_dish_options->update($_dsh_opt_insert_id,$_dish_insert_id, $_mnuitm_details['menu_item']['modifier_groups'][$z]['modifier_group_name'], $_op_ty, 0,0);
									}else{
											//..Insert into dish options 
											$_dsh_opt_insert_id = $objtbl_dish_options->create($_dish_insert_id, $_mnuitm_details['menu_item']['modifier_groups'][$z]['modifier_group_name'], $_op_ty, 0,0);
									}		
									
									for($k = 0;$k<count($_mnuitm_details['menu_item']['modifier_groups'][$z]['modifiers']);$k++){
										//..Add/edit to dish option values
										$_cur_dsh_opt_val=$objtbl_dish_options_values->readObject(array(DISH_OPT_VAL_OPTION_ID=>$_dsh_opt_insert_id,DISH_OPT_VAL_ETHOR_VARIANT=>$_mnuitm_details['menu_item']['modifier_groups'][$z]['modifiers'][$k]['modifier_id']));		
										if(is_not_empty($_cur_dsh_opt_val)){
											//..Opt value already present update now
											$_dsh_opt_val_insert_id=$objtbl_dish_options_values->getdish_opt_val_id();
											$_rslt_suc = $objtbl_dish_options_values->update($_dsh_opt_val_insert_id,$_dsh_opt_insert_id,$_mnuitm_details['menu_item']['modifier_groups'][$z]['modifiers'][$k]['modifier_name'],$_mnuitm_details['menu_item']['modifier_groups'][$z]['modifiers'][$k]['modifier_id']);
										}else{
											$_dsh_opt_val_insert_id = $objtbl_dish_options_values->create($_dsh_opt_insert_id, $_mnuitm_details['menu_item']['modifier_groups'][$z]['modifiers'][$k]['modifier_name'],$_mnuitm_details['menu_item']['modifier_groups'][$z]['modifiers'][$k]['modifier_id']);
										} 
										$_str .= '--'.$_mnuitm_details['menu_item']['modifier_groups'][$z]['modifiers'][$k]['modifier_name'].'- <br>';
										/*if(is_not_empty($_mnuitm_details['menu_item']['modifier_groups'][$z]['modifiers'][$k]['modifier_detail'])){
											for($m = 0;$m<count($_mnuitm_details['menu_item']['modifier_groups'][$z]['modifiers'][$k]['modifier_detail']);$m++){
												
											}
										}*/
										
										//..Add/edit to tbl_sbmnu_dish_opt_price 									
										$_cur_sbmnu_dish_opt_price=$tbl_sbmnu_dish_opt_price->readObject(array(SBMDOPT_PR_SBMNU_DISH=>$_submnudish_insert_id,SBMDOPT_PR_OPTION_VALUE=>$_dsh_opt_val_insert_id));		
										if(is_not_empty($_cur_sbmnu_dish_opt_price)){
											//..Dish Option already present update now
										 $_sbmnu_dish_opt_price_insert_id=$tbl_sbmnu_dish_opt_price->getsbmdopt_pr_id();
										 $rslt_fn_s = $tbl_sbmnu_dish_opt_price->update($_sbmnu_dish_opt_price_insert_id, $_submnudish_insert_id, $_dsh_opt_val_insert_id, 0);
										}else{
												//..Insert into dish options 
												$_sbmnu_dish_opt_price_insert_id = $tbl_sbmnu_dish_opt_price->create($_submnudish_insert_id, $_dsh_opt_val_insert_id, 0);
										}	
																												
									}	 //..end..for loop through modifiers 	
									
								}	//..end..for loop for the modifier groups
								
							}	//..if(count($_mnuitm_details['menu_item']['variants']>0)){
							//=======END MENU DISH MODIFIERS=================
							
										
					}	//..end if(is_not_empty($_mnuitm_details))
					unset($objtbl_dish_options);
					unset($objtbl_dish_options_values);
					unset($tbl_sbmnu_dish_opt_price);
					
					//=======END MENU DISH OPTIONS ================					
					
					}
			 					
     }
  }
	
	}
	return $_str;	
}

function addstuff($cat_id,$menu_name,$item_id,$item_name,$item_desc,$item_price,$item_img){
if(is_not_empty($cat_id)){	
	//...Step-A] Add to menu
	$menu_category= 1;//..Breakfast Time
	$menu_display_order= 0;
	$menu_route= 5;//..kitchen
	$menu_desc=$menu_name;
	$menu_image='';
  $menu_start_timing='00:01:00';
	$menu_end_timing='23:59:00';
	$menu_restaurent = $_SESSION[SES_RESTAURANT];
	$menu_ethor_cat_id=$_ethor_store_id;
	
	$mnu_wkdy_sunday=$mnu_wkdy_monday=$mnu_wkdy_tuesday=$mnu_wkdy_wednesday=$mnu_wkdy_thursday=$mnu_wkdy_friday=$mnu_wkdy_saturday='Y';		
	
	$objtbl_menu= new tbl_menu();
	//...Check if menu is already present
	$_cur_mnu=$objtbl_menu->readObject(array(MENU_RESTAURENT=>$menu_restaurent,MENU_ETHOR_CAT_ID=>$cat_id));

	if($_cur_mnu){
		//..menu already present update now
		$_mnu_insert_id=$_cur_mnu->getmenu_id();
		$_rstlt = $objtbl_menu->update($_mnu_insert_id,mysql_real_escape_string($menu_name), $menu_category, mysql_real_escape_string($menu_desc), $menu_image, $menu_start_timing, $menu_end_timing, $menu_restaurent,$menu_route,$menu_display_order);
	}else{
		//..menu not found insert now
		$_mnu_insert_id = $objtbl_menu->create(mysql_real_escape_string($menu_name), $menu_category, mysql_real_escape_string($menu_desc), $menu_image, $menu_start_timing, $menu_end_timing, $menu_restaurent,$menu_route,$menu_display_order);
		if($_mnu_insert_id>0)
			$isSuccess =$objtbl_mnu_weekdays->create($_mnu_insert_id ,$mnu_wkdy_sunday ,$mnu_wkdy_monday ,$mnu_wkdy_tuesday ,$mnu_wkdy_wednesday ,$mnu_wkdy_thursday ,$mnu_wkdy_friday ,$mnu_wkdy_saturday,$mnu_wkdy_sunday_start, $mnu_wkdy_sunday_end, $mnu_wkdy_monday_start, $mnu_wkdy_monday_end, $mnu_wkdy_tuesday_start, $mnu_wkdy_tuesday_end, $mnu_wkdy_wednesday_start, $mnu_wkdy_wednesday_end, $mnu_wkdy_thursday_start, $mnu_wkdy_thursday_end, $mnu_wkdy_friday_start, $mnu_wkdy_friday_end, $mnu_wkdy_saturday_start, $mnu_wkdy_saturday_end);
	}	
	
	//...Step-B] Add sub menu
	$submnu_name=$submnu_description=$menu_name;
	$submnu_menu=$_mnu_insert_id;
	$submnu_spl_note=$submnu_start_date=$submnu_end_date=$submnu_image='';
	$objtbl_sub_menu=new tbl_sub_menu();
	$_cur_sub_mnu=$objtbl_menu->readObject(array(SUBMNU_MENU=>$submnu_menu));
	if($_cur_sub_mnu){
		$_submnu_insert_id=$_cur_sub_mnu->getsubmnu_id();
		$_rslt = $objtbl_sub_menu->update($_submnu_insert_id,$submnu_name, $submnu_menu, $submnu_display_order, $submnu_description, $submnu_spl_note, $submnu_start_date, $submnu_end_date,$submnu_image);
	}else{
		$_submnu_insert_id = $objtbl_sub_menu->create($submnu_name, $submnu_menu, $submnu_display_order, $submnu_description, $submnu_spl_note, $submnu_start_date, $submnu_end_date,$submnu_image);
	}
	
	
	//..Add plain dish
	$dish_is_nutrition_text=1;
	$dish_is_drink=0;
	$dish_food_wine_pair=array();
	$dish_name=$item_name;
	$dish_chef_notes=$item_desc;
	$dish_img=$item_img;	
	$dish_restaurent=$menu_restaurent;	
	$dish_ingrad_allergic_contents= $dish_nutri_cal_info= $dish_notes= $dish_winery= $dish_type_cat= $dish_alcohol_percent= $dish_vintage= $dish_varietal=$dish_region=$dish_country=$dish_bottle_price= $dish_glass_price=$dish_winemaking=$dish_maturity= $dish_allergy= $dish_food_wine_pair= $dish_attributes= $dish_pair_note= $dish_is_nutrition_text= $dish_food_notes='';
	
	$objtbl_dishes=new tbl_dishes();	
	$_cur_dish=$objtbl_dishes->readObject(array(DISH_ETHOR_MNU_ITM_ID=>$item_id,DISH_RESTAURENT=>$dish_restaurent));
	if($_cur_dish){
		//..Update Dish
		$_dish_insert_id=$_cur_dish->getdish_id();
		$_rslt = $objtbl_dishes->update($_dish_insert_id,$dish_name,$dish_chef_notes, $dish_ingrad_allergic_contents, $dish_nutri_cal_info, $dish_notes, $dish_img, $dish_winery, $dish_type_cat, $dish_alcohol_percent, $dish_vintage, $dish_varietal, $dish_region, $dish_country, $dish_bottle_price, $dish_glass_price, $dish_winemaking, $dish_maturity, $dish_is_drink, $dish_restaurent,$dish_allergy,$dish_food_wine_pair,$dish_attributes,$dish_pair_note,$dish_is_nutrition_text,$dish_food_notes);		
	}else{
		//..Insert new dish
		$_dish_insert_id = $objtbl_dishes->create($dish_name,$dish_chef_notes, $dish_ingrad_allergic_contents, $dish_nutri_cal_info, $dish_notes, $dish_img, $dish_winery, $dish_type_cat, $dish_alcohol_percent, $dish_vintage, $dish_varietal, $dish_region, $dish_country, $dish_bottle_price, $dish_glass_price, $dish_winemaking, $dish_maturity, $dish_is_drink, $dish_restaurent,$dish_allergy,$dish_food_wine_pair,$dish_attributes,$dish_pair_note,$dish_is_nutrition_text,$dish_food_notes);
	}
		
	//..Add dish to sub menu
	$sbmnu_dish_price=$item_price;
	$sbmnu_dish_display_order=0;
	$sbmnu_dish_desc=$item_desc;
	$sbmnu_dish_start_date=$sbmnu_dish_end_date='';
	$objtbl_submenu_dishes=new tbl_submenu_dishes();
	$_cur_submnu_dish=$objtbl_dishes->readObject(array(SBMNU_DISH_SUBMENU=>$_submnu_insert_id,SBMNU_DISH_DISH=>$_dish_insert_id));
	if($_cur_submnu_dish){
		//..update sub menu dish
		$_submnudish_id=$_cur_submnu_dish->getsbmnu_dish_id();
		$isSuccess = $objtbl_submenu_dishes->update($_submnudish_id,$_submnu_insert_id, $_dish_insert_id, $sbmnu_dish_price, $sbmnu_dish_display_order, mysql_real_escape_string($sbmnu_dish_desc), $sbmnu_dish_start_date, $sbmnu_dish_end_date);
	}else{
		//..Insert new submenu dish
		$isSuccess = $objtbl_submenu_dishes->create($_submnu_insert_id, $_dish_insert_id, $sbmnu_dish_price, $sbmnu_dish_display_order, mysql_real_escape_string($sbmnu_dish_desc), $sbmnu_dish_start_date, $sbmnu_dish_end_date);	
	}	
	
}//..end if menu cat id is present 
				
}//..end import function
	
}//..End ethor_api

/*
//..Each Menu item options..
					$_MENU_ITEM_URL='https://ethor-test.apigee.net/v1/stores/'.ETHOR_STORE.'/menu/items/FCV59X28RY?apikey='.ETHOR_API_KEY;		
					$_submnu_dsh_price=array();
					$objtbl_dish_options=new tbl_dish_options();
					$objtbl_dish_options_values=new tbl_dish_options_values();		
					$tbl_sbmnu_dish_opt_price=new tbl_sbmnu_dish_opt_price();			
					$_mnuitm_details=$this->_parse_url_get_response($_MENU_ITEM_URL,1);
					if(is_not_empty($_mnuitm_details)){							
							if(count($_mnuitm_details['menu_item']['variants']>0)){
									//..Add/edit to dish options 
									$_cur_dsh_opt_id=$objtbl_dish_options->readObject(array(DISH_OPT_DISH_ID=>$_dish_insert_id));		
									if(is_not_empty($_cur_dsh_opt_id)){
										//..Dish Option already present update now
									 $_dsh_opt_insert_id=$objtbl_dish_options->getdish_opt_id();
									 $rslt_fn = $objtbl_dish_options->update($_dish_insert_id, 'Options', 'dropdown', 0,1);
									}else{
											//..Insert into dish options 
											$_dsh_opt_insert_id = $objtbl_dish_options->create($_dish_insert_id, 'Options', 'dropdown', 0,1);
									}		
									
									for ($k = 0; $k < count($_mnuitm_details['menu_item']['variants']); $k++){										
										//..Add/edit to dish option values
										$_cur_dsh_opt_val=$objtbl_dish_options_values->readObject(array(DISH_OPT_VAL_ETHOR_VARIANT=>$_mnuitm_details['menu_item']['variants'][$k]['variant_id']));		
										if(is_not_empty($_cur_dsh_opt_val)){
											//..Opt value already present update now
											$_dsh_opt_val_insert_id=$objtbl_dish_options_values->getdish_opt_val_id();
											$_rslt_suc = $objtbl_dish_options_values->update($_dsh_opt_val_insert_id,$_dsh_opt_insert_id, $_mnuitm_details['menu_item']['variants'][$k]['variant_name'],$_mnuitm_details['menu_item']['variants'][$k]['variant_id']);
										}else{
											$_dsh_opt_val_insert_id = $objtbl_dish_options_values->create($_dsh_opt_insert_id, $_mnuitm_details['menu_item']['variants'][$k]['variant_name'],$_mnuitm_details['menu_item']['variants'][$k]['variant_id']);
										} 
										
									//..Add/edit to tbl_sbmnu_dish_opt_price 									
									$_cur_sbmnu_dish_opt_price=$tbl_sbmnu_dish_opt_price->readObject(array(SBMDOPT_PR_SBMNU_DISH=>$_dish_insert_id,SBMDOPT_PR_OPTION_VALUE=>$_dsh_opt_val_insert_id));		
									if(is_not_empty($_cur_sbmnu_dish_opt_price)){
										//..Dish Option already present update now
									 $_sbmnu_dish_opt_price_insert_id=$tbl_sbmnu_dish_opt_price->getsbmdopt_pr_id();
									 $rslt_fn_s = $tbl_sbmnu_dish_opt_price->update($_sbmnu_dish_opt_price_insert_id, $_dish_insert_id, $_dsh_opt_val_insert_id, $_mnuitm_details['menu_item']['variants'][$k]['total_price']);
									}else{
											//..Insert into dish options 
											$_sbmnu_dish_opt_price_insert_id = $tbl_sbmnu_dish_opt_price->create($_dish_insert_id, $_dsh_opt_val_insert_id, $_mnuitm_details['menu_item']['variants'][$k]['total_price']);
									}	
																		
									}	 //..end..for loop through variants 	
							}	//..if(count($_mnuitm_details['menu_item']['variants']>0)){						
					}	//..end if(is_not_empty($_mnuitm_details))
					unset($objtbl_dish_options);
					unset($objtbl_dish_options_values);
					unset($tbl_sbmnu_dish_opt_price);
*/

?>