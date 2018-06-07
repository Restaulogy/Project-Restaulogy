<?php 
 include_once(dirname(dirname(__FILE__)).'/init.php');
 //..Pie chart logic 
$report_title="Promotions Claimed";
/*$data = array(20,27,45,75,90);
$legends=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct");*/

$start_date = get_input('start_date',date(DATE_FORMAT,strtotime("-1 month"))); 
$end_date = get_input('end_date',date(DATE_FORMAT,strtotime("now"))); 
$diff = get_input('offset',20); 
$diff_by = get_input('date_type','day'); 
 
$amt_range = "";
$i = $start_date;
if(strtotime($end_date) > strtotime($i)){

	while(strtotime($end_date) > strtotime($i)){
  	 $index = $i; 
	 $i = date(DATE_FORMAT,strtotime("+{$diff} {$diff_by}",strtotime($i)));
  	 $qry_prm[] = " SUM(if(`pds_redim_cupons`.redimed_date > '".str_replace('00:00:00','23:59:59',$index)."'  AND `pds_redim_cupons`.redimed_date  <=  '".str_replace('00:00:00','23:59:59',$i)."' ,1,0))  '".date('d M',strtotime($index))."-".date('d M',strtotime($i))."'";
	 $legends[] = date('d M',strtotime($index))."-".date('d M',strtotime($i)); 
  } 
} 

/*
	$qry_prm[] = " SUM(if({$amt_range} > {$limit} , 1, 0)) '>{$limit}'";
	$datax[] = ">{$limit}";
*/
//$qry = "SELECT `pds_list_promotions`.`title`,  `pds_redim_cupons`.redimed_date, `pds_redim_cupons`.`promotion_id`, ".implode(",",$qry_prm)." FROM pds_redim_cupons inner join pds_list_promotions on pds_list_promotions.id= pds_redi 
*/
$qry = "SELECT `pds_list_promotions`.`title`,  `pds_redim_cupons`.redimed_date, `pds_redim_cupons`.`promotion_id`, ".implode(",",$qry_prm)." FROM pds_redim_cupons inner join pds_list_promotions on pds_list_promotions.id= pds_redim_cupons.promotion_id "; 
$res = mysql_query($qry);

 //echo $qry;exit;
$newLegends = array();
if($res && (mysql_num_rows($res)>0)){
	while($row=mysql_fetch_assoc($res)){ 
	   foreach($legends as $key=>$val){
	   	$data[]= $row[$val]; 
		$legends[$key] =  $val.' '.(is_gt_zero_num($row[$val])?'('.$row[$val].')':'');
	   } 
	}
}
if(array_sum($data) > 0){
 	print_pie_chart($data,$report_title,$legends);	
}else{
	$file = $CONFIG->path.'/images/_graphics/no_record.png';
	$type = 'image/jpeg';
	header('Content-Type:'.$type);
	header('Content-Length: ' . filesize($file));
	readfile($file);	 
}

?>