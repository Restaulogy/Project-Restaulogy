<?php 

include_once(dirname(dirname(__FILE__)).'/init.php');
include_once('header.php');
include_once(dirname(dirname(__FILE__))."/modules/business_listing/classes/pds_list_promotions.class.php");
//..capture the posted fields
$tab_sel= get_input('tab_sel','restaurent');
$_REQUEST['tab_sel'] = $tab_sel;

$rpt_to_show			= get_input('rpt_to_show','bill_amnt'); 
$action 					= strtoupper(get_input(ACTION_TITLE,'SEARCH')); 
$search_table 		= get_input('search_table');
$search_server 		= get_input('search_server');
$search_customer 	= get_input('search_customer','All');
$report_type 			= get_input('report_type','');
$start_date 			= get_input('start_date');
$end_date 				= get_input('end_date');
//set default time frame

$time_period 			= get_input('time_period');
if(($tab_sel=='restaurent') && (is_not_empty($time_period)==FALSE)){
	$time_period='monthly';
}
$search_promotion = get_input('search_promotion');
//$dine_type			= get_input('dine_type', 'LUNCH');
$dine_type				= get_input('dine_type', array('LUNCH','DINNER'));
//$dine_type				= get_input('dine_type', array());
$amount_type			= get_input('amount_type', 'AVG');
//$third_dimension	= get_input('third_dimension', array('lunch_dine'));
$third_dimension	= get_input('third_dimension', array('month'));

$group_on=array();
//..For promotion tab the third dimension is always promotion 
//print_r($third_dimension);
 
if($tab_sel=='promotion'){
		if((is_not_empty($third_dimension[0])==false) || ($third_dimension[0]='lunch_dine')){
			$third_dimension	= array('promotion');
		}		
		if($report_type=='is_return_cust'){
			$third_dimension = array('customer_name');
		}
}

//..Selection of the third dimension is must
if(is_not_empty($third_dimension)){
 if(($tab_sel=='restaurent') || ($tab_sel=='promotion')){
		if($third_dimension[0]=='table'){
			$group_on[]='order_table_id';
			$search_customer='All';
			$dine_type='';
		}elseif($third_dimension[0]=='customer'){
			$group_on[]='order_customer_name';
			$search_table='';
			$dine_type='';
		}elseif($third_dimension[0]=='lunch_dine'){
			if(is_not_empty($dine_type)){
				foreach($dine_type as $_each_dine){
					$group_on[]=trim($_each_dine);
				}
			}
			$search_customer='';
			$search_table='';
		}elseif($third_dimension[0]=='promotion'){
			$group_on[]='id';
			$search_table='';
			$dine_type='';
		}elseif($third_dimension[0]=='month'){
			//$time_period ='annually';
			if($tab_sel=='promotion'){
				$group_on[]='DATE_FORMAT(`created_date`, \'%m\')';
			}else{
				$group_on[]='DATE_FORMAT(`order_created_on`, \'%m\')';
			}			
			$search_table='';
			$dine_type='';
		}elseif($third_dimension[0]=='customer_name'){
			//echo "i am in now";
			$rpt_to_show='is_return_cust';
			$report_type='is_return_cust';
			$group_on[]='customer_name';
		}			
 }elseif($tab_sel=='server'){
 	 if($third_dimension[0]=='serve_table'){
	 		if($report_type == 'delayed'){
				$group_on[]='srvc_reqst_table_id';
			}else{
				$group_on[]='tbl_cust_sess_table_id';
			}			
			$search_server='';
			$dine_type='';
		}elseif($third_dimension[0]=='serve_server'){
			if($report_type == 'delayed'){
				$group_on[]='srvc_reqst_emp_id';
			}else{
				$group_on[]='tbl_sts_lnk_emp_id';
			}		
			$search_table='';
			$dine_type='';
		}elseif($third_dimension[0]=='lunch_dine'){
			if(is_not_empty($dine_type)){
				foreach($dine_type as $_each_dine){
					$group_on[]=trim($_each_dine);
				}
			}
			$search_table='';
			$search_server='';
		}elseif($third_dimension[0]=='month'){
			$time_period ='annually';
			if($report_type == 'delayed'){
				$group_on[]='DATE_FORMAT(`srvc_reqst_created_on`, \'%m\')';
			}else{
				$group_on[]='DATE_FORMAT(`tbl_cust_sess_start_date`, \'%m\')';
			}				
			$search_table='';
			$dine_type='';
		}	
 }
}
//print_r($dine_type);
//print_r($group_on);
//echo "group_on=$group_on|amount_type=$amount_type";

if(is_not_empty($report_type)==false){
	if($tab_sel=='server'){
		$report_type='turn_over';
	}else{
		$report_type='bill_avg';		
	}
}
 
//echo "report_type=$report_type";
 
if(is_not_empty($action) && ($action == ACTION_SEARCH)){
 $stats = new statistics();
 if(is_not_empty($tab_sel)){
 	 switch($tab_sel){
	 		case 'restaurent':
					$report_img = $stats->rpt_restaurant($search_server,$time_period ,$report_type,$start_date,$end_date,$search_customer,$search_table,$dine_type,$group_on,$amount_type,$third_dimension[0]);	
				break;
			case 'server':
				$report_img = $stats->rpt_server($search_server,$time_period,$report_type,$start_date,$end_date,$search_customer,$search_table,$dine_type,$group_on,$amount_type,$third_dimension[0]);	
				break;
			case 'promotion':
				$report_img =	$stats->rpt_promotion($search_promotion,$time_period,$report_type,$start_date,$end_date,$search_customer,$search_table,$dine_type,$group_on,$amount_type,$third_dimension[0]);
				break; 
	 }
 } 
}



if($sesslife == true){
 	 $template = 'prom_stats.tpl';
}else{
 	//if($_SESSION['member_role_id']==ROLE_MANGAGER)
	$template = 'index.tpl';
}
	$smarty->assign('report_img',$report_img);
	
	$smarty->assign('start_date',$start_date);
	$smarty->assign('end_date',$end_date);
	
	$smarty->assign('time_period',$time_period);
	$smarty->assign('report_type',$report_type);
			
  	$lst_promotion = pds_list_promotions::GetPromotions();
	$smarty->assign('lst_promotion',$lst_promotion);
	$smarty->assign('time_periods', statistics::getTimePeriods()); 
	$smarty->assign('serverlist', tbl_staff::GetActiveEmployees());  
	$smarty->assign('tablelist', tbl_dining_table::GetFields(array('key_field'=>TABLE_ID,'value_field'=>TABLE_NUMBER)));  
	
	$smarty->assign('amount_type',$amount_type);
	$smarty->assign('third_dimension',$third_dimension[0]);

	$smarty->assign('last_month',date(DATE_FORMAT,strtotime('-1 month')));

	$breadcrumbs[] =  array('link'=>$website.'/user/pref_mng_cntrols.php',
						'title'=>$_lang['main']['pref_mng_cntrls']) ;
	$breadcrumbs[] =  array('link'=>$website.'/user/prom_stats.php',
						'title'=>$_lang['main']['pref_mng_cntrols']['stats']) ;
					 

include_once('footer.php');  
?>