<?php
//include_once(dirname(dirname(__FILE__)).'/init.php');
/*//..Pie chart logic 
$report_title="Promotions Claimed";
$data = array(20,27,45,75,90);
$legends=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct");
print_pie_chart($data,$report_title,$legends);*/
 
include_once(dirname(dirname(__FILE__)).'/init.php');
 
$rpt_lbl = "Report";

$start_point = get_input('start_point',0);
$end_point = get_input('end_point',12);
 
$offset = get_input('offset',4); 
$rpt_to_show = get_input('rpt_to_show','billwise');

$datax = array(); $datay= array();

$start_date = get_input('start_date',date(DATE_FORMAT,strtotime("-1 month")));  
$end_date = get_input('end_date',date(DATE_FORMAT,strtotime("now"))); 
$cond = " WHERE DATE(pds_redim_cupons.redimed_date) <= DATE('".$end_date."')";

if(is_not_empty($start_date)){
	$cond .= " AND DATE(pds_redim_cupons.redimed_date) >=  DATE('".$start_date."')";
}

if($rpt_to_show == 'billwise'){
	$rpt_title ="Amount";
	$amt_range = '(
 SELECT 
 	IFNULL(
	(  SUM( od.`ord_dtl_quantity` * od.`ord_dtl_price`) 	
 	  + SUM( op.`ord_det_opt_qty` * op.`ord_det_opt_price` )
	),0) AS total
 FROM '.TBL_ORDER_DETAILS.' od
  LEFT OUTER JOIN '.TBL_ORDER_DETAILS_OPTIONS.' op ON od.`ord_dtl_id` =  op.`ord_det_opt_order_detail` 
 WHERE od.`ord_dtl_order_id` = pds_redim_cupons.order_id) ';  
}elseif($rpt_to_show=='partysizewise'){
	$rpt_title ="Party Size";
	 $amt_range = '( 
SELECT  tbl_sts_lnk_party_size  FROM `tbl_table_status_link` where tbl_sts_lnk_status_id=1 AND tbl_sts_lnk_session_id = pds_redim_cupons.cust_sess_id) '; 
	
} 
 
  $qry_prm = array();
  $lowerlimit = $start_point;
  while($lowerlimit<$end_point){
  	$index = $lowerlimit; 
	$lowerlimit=$lowerlimit+$offset;
	
	//.. the '_num' suffix variables  are float number used for the bill wise report not for the other. 

  if($rpt_to_show == 'billwise'){
	$lowerlimit_num = number_format(floatval($lowerlimit),2,'.','');
	$index_num = number_format(floatval($index),2,'.','');
	$upperlimit_num = 0.01; 
		if($offset > 1){    
			$upperlimit_num = $index_num + 1.01; 
		} elseif($offset == 1){   
			$upperlimit_num = $index_num + 0.01; 
		}
	$qry_prm[] = " SUM(if({$amt_range} BETWEEN ".$upperlimit_num." AND {$lowerlimit_num} , 1, 0)) '{$index}-{$lowerlimit}'";
		$datax[] = "{$index}-{$lowerlimit}";	
	}else{
		if($offset > 1){    
			$qry_prm[] = " SUM(if({$amt_range} BETWEEN ".($index + 1)." AND {$lowerlimit} , 1, 0)) '{$index}-{$lowerlimit}'";
			$datax[] = "{$index}-{$lowerlimit}";
		} elseif($offset == 1){   
			$qry_prm[] = " SUM(if({$amt_range} = {$index} , 1, 0)) '{$index}'";
			$datax[] = "{$index}";
			//.. Add the end point when limit is over  
			if($lowerlimit == $end_point){
			$qry_prm[] = " SUM(if({$amt_range} = {$lowerlimit} , 1, 0)) '{$lowerlimit}'";
			$datax[] = "{$lowerlimit}";	
			} 
		}  
	} 
  }//..end of while
 	$qry_prm[] = " SUM(if({$amt_range} > {$end_point} , 1, 0)) '>{$end_point}'";
	$datax[] = ">{$end_point}";
  
 $qry = "SELECT `pds_list_promotions`.`title`,  `pds_redim_cupons`.`promotion_id`, ".implode(",",$qry_prm)." FROM pds_redim_cupons inner join pds_list_promotions on pds_list_promotions.id= pds_redim_cupons.promotion_id ".$cond." GROUP BY `pds_redim_cupons`.`promotion_id`"; 
  /*echo $qry;exit; */ 
 $res = mysql_query($qry); 
 $cnt=0;
 if(($res) && (mysql_num_rows($res)>0)){
 	
 	while($row = mysql_fetch_assoc($res)){
		$nm = 'index'.$row['promotion_id'].'_'.$row['title'] ;    
		foreach($datax as $val){
			$datay[$nm][]=$row[$val];
		}  
	}
 	 //print_r(array($datax,$datay));exit; 
 	 print_on_graph($datax,$datay,$rpt_title,"Number of Claim",$rpt_lbl);
 }else{
 $file = $CONFIG->path.'/images/_graphics/no_record.png';
$type = 'image/jpeg';
header('Content-Type:'.$type);
header('Content-Length: ' . filesize($file));
readfile($file);
 	 /*print_on_graph(array(),array(),$rpt_title,"Number of Claim",$rpt_lbl);*/
 }    
?>