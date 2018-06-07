<?php
//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");
include ("configs/common_vs.php");
include ("classes/pds_redim_cupons.class.php");
global $CONFIG;
$cupons = new pds_redim_cupons();
$isMenulist 	= get_input('isMenulist',0);
$url = $config['mainurl']."/coupon_statistics.php?isMenulist={$isMenulist}";

//***********************************************
// Include Variable Sets
//***********************************************
//include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************

	$promotion_id   	= get_input('promotion_id','');
	$search         	= get_input('search','');
	$limit          	= get_input('limit',10);
	$offset         	= get_input('offset',0);
	$search_user    	= get_input('userid','');
	$search_customer	= get_input('search_customer','');
	$search_promotion	= get_input('search_promotion',''); 
	$isCust   				= get_input('isCust',0);
	$latestOnly   		= get_input('latestOnly','');
	$cust_sess_id  		= get_input('cust_sess_id',0);
	$pst_customer_type= get_input(SES_CUST_TYPE);
	$pst_table_id   	= get_input('table_id',0);
	$order_id   			= get_input('order_id',0);
	$table_number   	= get_input('table_number','Table');
	$isServicePage 		= get_input('isServicePage',0); 
	$sort_on 					= get_input(SORT_ON,'redimed_date');
	$pst_table_status = get_input('table_status',0); 
	$flt_cust 				= get_input(FILTER_BY_CUST,'');
	$islive						= get_input('islive',1);
	
	$search_table 		= get_input('search_table',0);
	$search_employee 	= get_input('search_employee',0);
	/*$start_date = get_input('start_date',date('m/d/Y',strtotime("-1 day")));
  $end_date = get_input('end_date',date('m/d/Y')); */
	
	//..Condition to show for only todays and yesterday bydefualt
 if($Global_member['member_role_id']==ROLE_ADMIN || $Global_member['member_role_id']==ROLE_OWNER){
 		if(is_gt_zero_num($_GET['promotion_id'])==FALSE){
			$start_date = get_input('start_date',date('m/d/Y',strtotime("-1 day")));
 			$end_date = get_input('end_date',date('m/d/Y'));	
		} 			
 }else{
 		$start_date = get_input('start_date','');
		$end_date = get_input('end_date','');
 }


if(($Global_member['rl_fn_promotion_live']==1) && ($Global_member['rl_fn_promotion_expired']==1)){
  //..Donot change the latestonly
}else{ 
  if($Global_member['rl_fn_promotion_live']==1){
		$islive = 1; 
  }elseif($Global_member['rl_fn_promotion_expired']==1){
		$islive = 0; 
  }else{  	
		if($sesslife==true){
	  		$_SESSION[SES_FLASH_MSG] = '<div class="error">'.$_lang['main']['not_allowed'].'</div>';
			biz_script_forward($website);
		}		
  } 
}
	 
$sort_by=$new_sort='';
biz_set_sorting_var($sort_by,$new_sort);
$sort_by 		= get_input(SORT_BY,'DESC');  
$info = array();   
/*
if(is_gt_zero_num($promotion_id) || is_gt_zero_num($search_user)){*/ 
   $sorting_url = $config['mainurl']."/coupon_statistics.php?isMenulist={$isMenulist}&promotion_id={$promotion_id}&cust_sess_id={$cust_sess_id}&search={$search}&userid={$search_user}&offset={$offset}&latestOnly={$latestOnly}";
	 if(is_not_empty($flt_cust)){
	 	$sorting_url .= '&'.FILTER_BY_CUST.'='.$flt_cust; 
	 }
	 
	 if(is_not_empty($pst_customer_type)){
	 	$sorting_url .= '&'.SES_CUST_TYPE.'='.$pst_customer_type; 
	 }
	 
	 if(is_not_empty($islive)){
	 	$sorting_url .= '&islive='.$islive; 
	 }
	 
	 if(is_gt_zero_num($pst_table_id)){
	 	 $sorting_url .= '&table_id='.$pst_table_id; 
	 }
	 
	 if(is_gt_zero_num($pst_table_status)){
	 	 $sorting_url .= '&table_status='.$pst_table_status; 
	 }
	 
	 if(is_not_empty($search_customer)){
	 	 $sorting_url .= '&search_customer='.$search_customer; 
	 }
	 
	 if(is_gt_zero_num($search_promotion)){
	 	 $sorting_url .= '&search_promotion='.$search_promotion; 
	 }
	 
	 if(is_gt_zero_num($search_table)){
	 	 $sorting_url .= '&search_table='.$search_table; 
	 }
	 
	 if(is_gt_zero_num($search_employee)){
	 	 $sorting_url .= '&search_employee='.$search_employee; 
	 } 
	 
	 if(is_not_empty($start_date) && is_not_empty($end_date)){
	 	 $sorting_url .= '&start_date='.$start_date.'&end_date='.$end_date; 
	 }
	  
	 
   $search_code = "";
   if(is_not_empty($search)){
      $search_email= get_input("search_email","");
      $search_code = get_input("search_code","");
      $tmp_user = get_user_by_email($search_email);
      if($tmp_user){ 
         $search_user = $tmp_user['id'] ; 
      }
	  /*echo $search_user;exit;*/
   } 
	 
	 $info = array(); 
	 if(is_gt_zero_num($_SESSION['userid']) || is_not_empty($_SESSION[SES_CUST_NM])){
	 	if(is_gt_zero_num($_SESSION['userid'])){
			if($_SESSION['member_role_id']==ROLE_CUSTOMER){
				$info = $cupons->listOfCoupons($promotion_id,$search_customer,$search_promotion,$offset,$limit,$url,$sort_on,$sort_by,$cust_sess_id,$latestOnly,$order_id,"",$_SESSION['userid']); 
			}else{				
				//..@1Aug2013#1 for customer filter
		/*if(in_array($_SESSION['member_role_id'],array(ROLE_ADMIN,ROLE_MANAGER,ROLE_OWNER)) && is_not_empty($flt_cust)){*/
		if((chk_preferance_allwd()) && is_not_empty($flt_cust)){
		//if(($_SESSION['member_role_id']==ROLE_MANAGER) && is_not_empty($flt_cust)){
				//..This is for manager only 
				$info = $cupons->listOfCoupons($promotion_id,$search_customer,$search_promotion,$offset,$limit,$url,$sort_on,$sort_by,$cust_sess_id,$latestOnly,$order_id,'',$search_user,$flt_cust,'',0,0,$start_date,$end_date);
				$tpl-> assign('flt_cust_id',$search_user);
				if(is_not_empty($pst_customer_type)){
					$tpl-> assign('flt_cust_type',$pst_customer_type); 
				} 
				$tpl-> assign('flt_cust',$flt_cust);
			}else{
				//..This is for except manager only 
				$info = $cupons->listOfCoupons($promotion_id,$search_customer,$search_promotion,$offset,$limit,$sorting_url,$sort_on,$sort_by,$cust_sess_id,$latestOnly,$order_id,'','','','',$islive,$search_table,$search_employee,$start_date,$end_date);
				$flt_cust = "";
			}  
		  }
			
		}else{
			 
			if((is_not_empty($_SESSION[SES_CUST_NM]) && is_gt_zero_num($_SESSION[SES_TABLE]))){				 
			$cust_sess_id=tbl_table_customer_session::GetCurrentActiveCustSession($_SESSION[SES_TABLE]); 
				
			if(is_gt_zero_num($cust_sess_id)==false){
				$cust_sess_id = 0;
			}//...end if for table session check	
				//..change@3Aug2013#2 
				 
				if(is_gt_zero_num($_SESSION[SES_COOKIE_UID])){
					 
					$info = $cupons->listOfCoupons($promotion_id,$search_customer,$search_promotion,$offset,$limit,$url,$sort_on,$sort_by,$cust_sess_id,$latestOnly,$order_id,$_SESSION[SES_CUST_NM],$_SESSION[SES_COOKIE_UID],$_SESSION[SES_CUST_NM],CUST_TYPE_COOKIE);  
					//print_r($info);exit;
				}else{
					$info = $cupons->listOfCoupons($promotion_id,$search_customer,$search_promotion,$offset,$limit,$url,$sort_on,$sort_by,$cust_sess_id,$latestOnly,$order_id,$_SESSION[SES_CUST_NM]);
				}//...end if for SES_COOKIE_UID check				
			  
			}//...end if for  SES_CUST_NM andtable session check	
		}		
	 }
  
    
	 
  if(is_gt_zero_num($promotion_id)){
    $info['promotion']  = get_promotion_info($promotion_id);
    $biz_owner_id = getBizOwnerId ($info['promotion']['list_id']); 
    $biz_owner = get_user($biz_owner_id);
      if($biz_owner){
          $info['owner']['name'] =  $biz_owner["full_name"];
          $info['owner']['url'] =  "";
          $info['owner']['email'] = $biz_owner["email"]; 
          $info['owner']['img'] =  "";
      }
  }else{ 
  
  } /*
}*/
  
 /*  print_r($info['coupons']); */
if($elgg_user_acct_type == "business"){ 
	$tpl-> assign("biz_access", 1);
}else{
 	 
	$tpl-> assign("biz_access", 0);
}    
   
  if(is_gt_zero_num($cust_sess_id) && is_gt_zero_num($pst_table_id)){
		
		$table_info = tbl_dining_table::GetInfo($pst_table_id);
		$table_number = $table_info['table_number'];
		
	 	$all_orders = tbl_orders::getAllCustSessionOrders($cust_sess_id,0);
 	 	$tpl->assign('all_orders',$all_orders); 
 	/*donothing*/
	$breadcrumbs[] = array(
			 	'link'=>$elgg_main_url.'user/tbl_table_status_link.php?latestOnly=1',
				'title'=>$_lang['tbl_table_status_link']['listing_title']); 
	 
	 $breadcrumbs[] = array(
					 	'link'=>$elgg_main_url.'user/tbl_table_status_link.php?customer_session_id='.		 $cust_sess_id.'&pst_table_id='.$pst_table_id,
						'title'=>$table_number); 
		 
	
	//$breadcrumbs[] = array('link'=>"{$url}&isMenulist={$isMenulist}&cust_sess_id={$cust_sess_id}&table_id={$pst_table_id}&table_name={$table_number}","title"=>"Promotion Claimed"); 
	$breadcrumbs[] = array('link'=>$sorting_url,'title'=>'Promotion Claimed'); 
 }elseif(is_gt_zero_num($promotion_id)){
   /*print_r($info['promotion']);*/
 	$breadcrumbs[] = array('link'=> $config['mainurl']."/promotionslisting.php?show_type=PR","title"=>"Promotions");
	if(is_not_empty($info['promotion'])){
		$breadcrumbs[] = array('link'=> $config['mainurl']."/show.php?show_type=PR&promoid={$promotion_id}&lid={$info['promotion']['list_id']}","title"=>$info['promotion']['title']); 
	}
 	$breadcrumbs[] = array('link'=>"{$url}&isMenulist={$isMenulist}&promotion_id={$promotion_id}","title"=>"Promotion Claimed"); 
	
 }elseif(is_not_empty($flt_cust)){
 	$breadcrumbs[] = array('link'=>$sorting_url,'title'=>'"'.strtoupper($flt_cust).'" - Promotion Claimed');  
 }else{
 	$breadcrumbs[] = array('link'=> $config['mainurl']."/promotionslisting.php?show_type=PR","title"=>"Promotions");
	//$breadcrumbs[] = array('link'=>$url."&isMenulist={$isMenulist}","title"=>"Promotion Claimed");
	$breadcrumbs[] = array('link'=>$sorting_url,'title'=>'Promotion Claimed'); 
 } 
  
 
 if(is_gt_zero_num($isMenulist)){
	 	$ispromotion = 1;
	 	include "menu_list.php"; 
 }
 
  if(is_gt_zero_num($isServicePage)){
 	echo json_encode($info);exit;
  }else{
  //print_r($info);
	
	$lst_tables = tbl_dining_table::GetFields(array('key_field' => 'table_id','value_field' => 'table_number','isActive'=>1)); 	
  $lst_servers = tbl_staff::GetActiveEmployees();
	$lst_promotions = pds_list_promotions::GetPromotions(); 	 
	
	//..Grid click link
	$gr_clk_navigationURL=modify_navigattion_url($sorting_url);	
	$tpl->assign('gr_clk_navigationURL',$gr_clk_navigationURL);
	
	$tpl-> assign('lst_promotions',$lst_promotions); 
	$tpl-> assign('lst_servers',$lst_servers);
	$tpl-> assign('lst_tables',$lst_tables);
  $tpl-> assign('islive',$islive);
  $tpl-> assign('info', $info);
	$tpl-> assign('show_type','PR');
	$tpl-> assign('breadcrumbs', $breadcrumbs);
	$tpl-> assign('new_sort',$new_sort);
	$tpl-> assign('page_url',$url);
	$tpl-> assign('sorting_url',$sorting_url); 
  $tpl-> assign('promotion_id', $promotion_id);
 	$tpl-> assign('table_status',$pst_table_status);
	$tpl-> assign('table_id',$pst_table_id);
	$tpl-> assign('tmp_sess_id',$cust_sess_id);
	$tpl-> assign('tb_sts_lnk_tab','promotion');
	$tpl-> assign('table_number',$table_number);
	$tpl-> assign('active_page','coupon_statistics');		
	
	$tpl->assign('start_date',$start_date);
	$tpl->assign('end_date',$end_date);
		
 	$tpl-> display($config[deftpl].'/coupon_statistics.tpl');
  }  
  include("footer.php"); 
?>