<?php
include_once(dirname(dirname(__FILE__)).'/init.php');
$rpt_to_show = get_input('rpt_to_show','action');
$reporttype = get_input('reporttype','Jobs');
$gettop3 = get_input('gettop3',0);

$st_dt = get_input('st_dt','');
$end_dt = get_input('end_dt','');
if($st_dt!="" && $st_dt!=""){
      $dt_filter=" AND create_dt BETWEEN '".Date("Y-m-d",strtotime($st_dt))."' AND '".Date("Y-m-d",strtotime($end_dt))."'";
}
$rpt_lbl = "Report";
$datax = array(); $datay= array();
 if($rpt_to_show == 'billrange'){
 	
 }

 $amt_range = '( 
SELECT  tbl_sts_lnk_party_size  FROM `tbl_table_status_link` where tbl_sts_lnk_status_id=1 AND tbl_sts_lnk_session_id = pds_redim_cupons.cust_sess_id) ';  

 $qry = "SELECT `pds_redim_cupons`.`promotion_id`, `pds_list_promotions`.`title`,   
 		 		SUM(if({$amt_range} < 2 , 1, 0)) '0-2',
                SUM(if({$amt_range} BETWEEN 2 AND 4 , 1, 0)) '2-4',
                SUM(if({$amt_range} BETWEEN 5 AND 6 , 1, 0)) '4-6',
                SUM(if({$amt_range} BETWEEN 7 AND 8 , 1, 0)) '6-8',
                SUM(if({$amt_range} > 8 , 1, 0 )) '>8' FROM pds_redim_cupons inner join pds_list_promotions on pds_list_promotions.id= pds_redim_cupons.promotion_id GROUP BY `pds_redim_cupons`.`promotion_id`";
				/*echo $qry;exit;*/
 $datax[]='0-2';
 $datax[]='2-4';
 $datax[]='4-6';
 $datax[]='6-8';
 $datax[]='>8';   
 $res = mysql_query($qry); 
 $cnt=0;
 if($res){ 
 	while($row = mysql_fetch_assoc($res)){
		$nm = 'index_'.$row['title'] ;   
		$datay[$nm][]=$row['0-2'];
 		$datay[$nm][]=$row['2-4'];
 		$datay[$nm][]=$row['4-6'];
 		$datay[$nm][]=$row['6-8'];
 		$datay[$nm][]=$row['>8']; 
		++$cnt;
	}
 }  
 print_on_graph($datax,$datay,"Party Size","Number of Claim",$rpt_lbl);
?>