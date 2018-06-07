<?php 
define('TIME_PERIOD', 'time_period'); 
 
class statistics{
	
public function rpt_restaurant($customer,$time_period,$report_type='bill_avg',$start_date='',$end_date='',$customer='',$table='',$lunch_dinner='LUNCH',$group_on=array('lunch_dine'),$amount_type='AVG',$third_dimension='lunch_dine'){

		if($customer=='All'){
			$customer='';
		}
		
		//..get groupon condition
		if(is_not_empty($group_on)){
			$sql_group_cond=implode(",", $group_on);
		}
		//$group_on='order_customer_name';
		//echo "group_on=$group_on|| sql_group_cond=$sql_group_cond";
		$rpt_lbl_cond='';
		//$time_period = 'date_range';
		//$start_date ='2013-12-01';
		//$end_date ='2013-12-06';
		//$_SESSION[SES_RESTAURANT]=1;
			
		if($time_period == 'date_range'){
			if((is_not_empty($start_date)) && (is_not_empty($end_date))){
			 $cond .= ' AND (`order_created_on` >=  \''.$start_date.'\' AND `order_created_on` <= \''.$end_date.'\')';
			}			
			$date_cond = '%Y%m%d';
			$x_axis = 'day';
			$x_axis_title = 'Date';
			$rpt_lbl_cond .='Datewise ['.date('m/d/y',strtotime($start_date)).' -'.date('m/d/y',strtotime($end_date)).'] ';
		}elseif($time_period == 'monthly'){
			if((is_not_empty($start_date)==false) && (is_not_empty($end_date)==false)){
			 $start_date=date(DATE_FORMAT,strtotime('-1 month'));
			 $end_date=date(DATE_FORMAT);
			}
			if((is_not_empty($start_date)) && (is_not_empty($end_date))){
			 $cond .= ' AND (`order_created_on` >=  \''.$start_date.'\' AND `order_created_on` <= \''.$end_date.'\')';
			}
			$date_cond = '%m';
			$x_axis = 'mon';
			$x_axis_title = 'Month';
			$rpt_lbl_cond .='monthly ';
		}elseif($time_period == 'annually'){
			$date_cond = '%Y';
			$x_axis = 'yr';
			$x_axis_title = 'Year';
			$rpt_lbl_cond .='annually ';
		} 
		
		//..Set amount type...
		if($report_type == 'bill_avg'){
			$amount_type='AVG';
		}elseif($report_type == 'bill_total'){
			$amount_type='SUM';
		}		
		
	  if(($report_type == 'bill_avg') || ($report_type == 'bill_total') || ($report_type == 'avg_bill_per_cust')){	
	  	
		  $rpt_lbl = 'Bill wise Report ';		
		  if(is_not_empty($customer)){
				$cond .= ' AND `order_customer_name`  LIKE  \'%'.$customer.'%\' ';
				$usr_detail=get_user($customer);
				$rpt_lbl_cond .=' by '.$customer;
			} 
			if(is_not_empty($table)){
				$cond .= ' AND `order_table_id` = '.$table.' ';
				$table_info=tbl_dining_table::GetInfo($table);
				$rpt_lbl_cond .=' from '.$table_info["table_number"];
			}	
			if($report_type == 'avg_bill_per_cust'){
				$rpt_lbl = 'Avg. Bill Amount/Guest ';
				$y_axis = 'bill_amount_per_guest';	
				$y_axis_title = 'Avg. Bill Amount/Guest';
			}else{
				$y_axis = 'bill_amount';	
				$y_axis_title = $amount_type.' Bill Amount';
			}			
				
	 		$qry = 'SELECT 
		  SQL_NO_CACHE YEAR(`order_created_on`) as `yr`, MONTHNAME(`order_created_on`) as `mon`,DAYOFMONTH(`order_created_on`) as `day`,
			`order_customer_name`,`order_id`,`order_table_id`,`table_number`,`order_created_on`,
			(DATE_FORMAT(`order_created_on`,"%H:%i") >=  \'07:00\' AND DATE_FORMAT(`order_created_on`,"%H:%i") <= \'11:00\') as `BREAKFAST`,
			(DATE_FORMAT(`order_created_on`,"%H:%i") >=  \'11:01\' AND DATE_FORMAT(`order_created_on`,"%H:%i") <= \'16:00\') as `LUNCH`,
			(DATE_FORMAT(`order_created_on`,"%H:%i") >=  \'16:01\' AND DATE_FORMAT(`order_created_on`,"%H:%i") <= \'22:00\') as `DINNER`,
			(	
				'.$amount_type.'(
				IFNULL(
					 od.`ord_dtl_quantity` * IF(od.`ord_dtl_discount` > 0, (od.`ord_dtl_price`-(od.`ord_dtl_price` * (od.`ord_dtl_discount`/100))),od.`ord_dtl_price`)
				,0) 
				+ 
				IFNULL(
				op.`ord_det_opt_qty` * IF(op.`ord_det_opt_discount` > 0, (op.`ord_det_opt_price`-(op.`ord_det_opt_price` * (op.`ord_det_opt_discount`/100))),op.`ord_det_opt_price`)
				,0)
				-
				IF(`tbl_orders`.`order_prom_discnt`,`tbl_orders`.`order_prom_discnt`,`oapr`.`ordprom_discount_amt`)
				
				)			
			) `bill_amount`,
			(	
				AVG(
				IFNULL(
					 od.`ord_dtl_quantity` * IF(od.`ord_dtl_discount` > 0, (od.`ord_dtl_price`-(od.`ord_dtl_price` * (od.`ord_dtl_discount`/100))),od.`ord_dtl_price`)
				,0) 
				+ 
				IFNULL(
				op.`ord_det_opt_qty` * IF(op.`ord_det_opt_discount` > 0, (op.`ord_det_opt_price`-(op.`ord_det_opt_price` * (op.`ord_det_opt_discount`/100))),op.`ord_det_opt_price`)
				,0)
				-
				IF(`tbl_orders`.`order_prom_discnt`,`tbl_orders`.`order_prom_discnt`,`oapr`.`ordprom_discount_amt`) 
				
				)/SUM(`order_guest`)			
			) `bill_amount_per_guest`
		FROM			 
			`tbl_orders`			
		LEFT OUTER JOIN 
			`tbl_order_details` od
		ON 
			`tbl_orders`.`order_id` = od.`ord_dtl_order_id`	
		LEFT OUTER JOIN 
			`tbl_dining_table` tb
		ON 
			`tbl_orders`.`order_table_id` = tb.`table_id`		
		LEFT OUTER JOIN 
			`tbl_order_details_options` op 
		ON 
			od.`ord_dtl_id` =  op.`ord_det_opt_order_detail`
		LEFT OUTER JOIN 
			`tbl_order_applied_proms` oapr
		ON 
			`tbl_orders`.`order_id`=oapr.`ord_dtl_order_id`
		WHERE
			`tbl_orders`.`order_restaurant` = '.$_SESSION[SES_RESTAURANT].' '.$cond.$cond_din_lunch.'
		GROUP BY			 
		'.$sql_group_cond;
			//DATE_FORMAT(`order_created_on`, \''.$date_cond.'\')'; 
		/*if(is_not_empty($group_on)){
			$qry .= ",{$sql_group_cond}";
		}	*/
			
	 }elseif($report_type == 'guest_count'){		
	 
	 $y_axis = 'guest';	
	 $y_axis_title = 'Guest Count';
	 $rpt_lbl = 'Guest Count Report';	
	 $qry = 'SELECT  SQL_NO_CACHE YEAR(  `order_created_on` ) AS  `yr` , MONTHNAME(  `order_created_on` ) AS `mon`, DAYOFMONTH(  `order_created_on` ) as `day`, SUM(`order_guest`) AS `guest`,
			`order_customer_name`,`order_id`,`order_table_id`,`table_number`,`order_created_on`,			
			(DATE_FORMAT(`order_created_on`,"%H:%i") >=  \'07:00\' AND DATE_FORMAT(`order_created_on`,"%H:%i") <= \'11:00\') as `BREAKFAST`,
			(DATE_FORMAT(`order_created_on`,"%H:%i") >=  \'11:01\' AND DATE_FORMAT(`order_created_on`,"%H:%i") <= \'16:00\') as `LUNCH`,
			(DATE_FORMAT(`order_created_on`,"%H:%i") >=  \'16:01\' AND DATE_FORMAT(`order_created_on`,"%H:%i") <= \'22:00\') as `DINNER`
		FROM `tbl_orders` 
		LEFT OUTER JOIN 
			`tbl_dining_table` tb
		ON 
			`tbl_orders`.`order_table_id` = tb.`table_id`	
		WHERE 1 '.$cond.$cond_din_lunch.'
		GROUP BY 
			DATE_FORMAT(`order_created_on`, \''.$date_cond.'\')';
		//DATE_FORMAT(`order_created_on`, \''.$date_cond.'\'),'.$sql_group_cond;	
		if(is_not_empty($group_on)){
			$qry .= ",{$sql_group_cond}";
		}	
		//echo "qry=$qry";		
	 }elseif($report_type == 'revenue'){
	 	$rpt_lbl = 'Revenue Report';	
		$y_axis_title = 'Amount';
	 	$y_axis = 'bill_amount';	
	 	$qry = 'SELECT 
		  SQL_NO_CACHE YEAR(`order_created_on`) as `yr`, MONTHNAME(`order_created_on`) as `mon`,DAYOFMONTH(`order_created_on`) as `day`,
			`order_customer_name`,`order_id`,`order_table_id`,`order_created_on`,
			(DATE_FORMAT(`order_created_on`,"%H:%i") >=  \'07:00\' AND DATE_FORMAT(`order_created_on`,"%H:%i") <= \'11:00\') as `BREAKFAST`,
			(DATE_FORMAT(`order_created_on`,"%H:%i") >=  \'11:01\' AND DATE_FORMAT(`order_created_on`,"%H:%i") <= \'16:00\') as `LUNCH`,
			(DATE_FORMAT(`order_created_on`,"%H:%i") >=  \'16:01\' AND DATE_FORMAT(`order_created_on`,"%H:%i") <= \'22:00\') as `DINNER`,
			(	
				'.$amount_type.'(
				IFNULL(
					 od.`ord_dtl_quantity` * IF(od.`ord_dtl_discount` > 0, (od.`ord_dtl_price`-(od.`ord_dtl_price` * (od.`ord_dtl_discount`/100))),od.`ord_dtl_price`)
				,0) 
				+ 
				IFNULL(
				op.`ord_det_opt_qty` * IF(op.`ord_det_opt_discount` > 0, (op.`ord_det_opt_price`-(op.`ord_det_opt_price` * (op.`ord_det_opt_discount`/100))),op.`ord_det_opt_price`)
				,0)
				)			
			) `bill_amount`
		FROM			 
			`tbl_orders`			
		LEFT OUTER JOIN 
			`tbl_order_details` od
		ON 
			`tbl_orders`.`order_id` = od.`ord_dtl_order_id`		
		LEFT OUTER JOIN 
			`tbl_order_details_options` op 
		ON 
			od.`ord_dtl_id` =  op.`ord_det_opt_order_detail`
		WHERE
			`order_restaurant` = '.$_SESSION[SES_RESTAURANT].' AND `order_status_id` IN ('.TBL_STATUS_CHECK.','.TBL_STATUS_DELIVERED.')  AND `order_completed_on`>0 '.$cond.$cond_din_lunch.'
		GROUP BY 
			DATE_FORMAT(`order_created_on`, \''.$date_cond.'\'),'.$sql_group_cond; 
	 }
	 
	 unset($res);	
	 //echo "$qry";
	 //echo "3rd dimen=".$third_dimension;exit;
	 $res = mysql_query($qry);
	  $report_op=self::getGrpahImage($res,$group_on,$third_dimension,$x_axis_title,$y_axis_title,$rpt_lbl,$rpt_lbl_cond,$x_axis,$y_axis,$report_type);
	 return $report_op; 
	 /*
	 $cnt=0;
	 if(($res) && (mysql_num_rows($res)>0)){	
	
		$tmparr=array();
		$_datay=array();		
		while($row = mysql_fetch_assoc($res)){
				$tmparr[$row[$x_axis]]=$row[$x_axis];
				//..Get group on field
				if(is_not_empty($group_on)){
					foreach($group_on as $_each_group){
							if($third_dimension=='lunch_dine'){
								if($row["$_each_group"]==1){
									$_datay["$_each_group"][$row[$x_axis]]=$row[$y_axis];
								}								
							}else{
								if(is_gt_zero_num($row["$_each_group"])){
									$_datay[$row["$_each_group"]][$row[$x_axis]]=$row[$y_axis];
									if($_each_group=='order_table_id'){
											$grfld_arr[$row["$_each_group"]]=$row['table_number'];
									}else{
										$grfld_arr[$row["$_each_group"]]=$row["$_each_group"];
									}	
								}							
							}
					}
				}
		}
		if($third_dimension=='lunch_dine'){
			$grfld_arr=$group_on;
		}
		if(is_not_empty($grfld_arr)){
			//$grfld_arr=array_filter($grfld_arr);			
		}		
		if(is_not_empty($tmparr)) {
				$datax=array_keys($tmparr);
		}
		unset($row);
		
		//..final logic to fetch based on the data based on the 3rd dimension 
		$datay=array();
		if(is_not_empty($_datay)){
			foreach($_datay as $_third_dim => $row ){
					foreach($datax as $key =>$value){
						if($third_dimension=='lunch_dine'){
							$legend=$grfld_arr[$_third_dim].'_'.$_third_dim;
						}else{
							$legend=$_third_dim.'_'.$grfld_arr[$_third_dim];
						}
						
						if(is_not_empty($row[$value])){
							$datay[$legend][$key]=$row[$value];						
						}else{
							$datay[$legend][$key]=0;	 
						}					
					}
			}
		}
		
	 //print_r(array($datax,$datay));exit;	
	 $img_src = print_on_graph($datax,$datay,$x_axis_title,$y_axis_title,"{$rpt_lbl} {$rpt_lbl_cond}");	
	 		
	 }else{
	 	$img_src = "";
	 }
	 $report_op=array('img_src'=>$img_src,'title'=>"{$rpt_lbl} {$rpt_lbl_cond}");
	 return $report_op;
	 */		
}
	//..Second report
	public function rpt_server($server,$time_period,$report_type='turn_over',$start_date='',$end_date='',$customer='',$table='',$lunch_dinner='LUNCH',$group_on=array('lunch_dine'),$amount_type='AVG',$third_dimension='lunch_dine'){
		$rpt_lbl_cond='';
		if($server=='All'){
			$server='';
		}
		//..get groupon condition
		if(is_not_empty($group_on)){
			$sql_group_cond=implode(",", $group_on);
		}		
		
		if($time_period == 'date_range'){
			if((is_not_empty($start_date)) && (is_not_empty($end_date))){
				if($report_type == 'turn_over'){
					$cond .= ' AND (`tbl_cust_sess_start_date` >=\''.$start_date.'\' AND `tbl_cust_sess_start_date` <= \''.$end_date.'\')';					
				}elseif($report_type == 'delayed'){
					$cond .= ' AND (`srvc_reqst_created_on`  >=\''.$start_date.'\' AND `srvc_reqst_created_on`  <= \''.$end_date.'\')';				
				}				
				$x_axis='day';
				$x_axis_title = 'Date';
				//$rpt_lbl_cond .='Datewise ';
				$rpt_lbl_cond .='Datewise ['.date('m/d/y',strtotime($start_date)).' -'.date('m/d/y',strtotime($end_date)).']';
			}			
			$date_cond = '%Y%m%d';
		}elseif($time_period == 'monthly'){
			$date_cond = '%m';
			$x_axis='mon';
			$x_axis_title = 'month';
			$rpt_lbl_cond .='monthly ';
		}elseif($time_period == 'annually'){
			$date_cond = '%Y';
			$x_axis='yr';
			$x_axis_title = 'Year';
			$rpt_lbl_cond .='annually ';
		} 
		
	  if($report_type == 'turn_over'){		  
			if(is_not_empty($server)){ 
				$cond .= ' AND `tbl_sts_lnk_emp_id` = '.$server.''; 
				$usr_detail=get_user($server);
				$rpt_lbl_cond .=' by server '.$usr_detail["full_name"];
			}	
			if(is_not_empty($table)){
				$cond .= ' AND `tbl_cust_sess_table_id` = '.$table.'';
				$table_info=tbl_dining_table::GetInfo($table);
				$rpt_lbl_cond .=' from '.$table_info["table_number"];
			}	
			$y_axis ='avgTime';	
			$y_axis_title = 'Average'; 
			$rpt_lbl = 'Average Turn-Over Time Report';
	 		$qry = 'SELECT 
SQL_NO_CACHE YEAR(`tbl_cust_sess_start_date`) AS `yr`, MONTHNAME(`tbl_cust_sess_start_date`) AS `mon`,DAYOFMONTH( `tbl_cust_sess_start_date`)  as `day`,IFNULL(AVG(TIMESTAMPDIFF(MINUTE,`tbl_cust_sess_start_date`,`tbl_cust_sess_end_date`)),0) as `avgTime`,
						 `tbl_cust_sess_table_id`,`table_number`,`tbl_sts_lnk_emp_id`,CONCAT(staff_fname,\' \', staff_lname) `server_name`,
			(DATE_FORMAT(`tbl_cust_sess_start_date`,"%H:%i") >=  \'07:00\' AND DATE_FORMAT(`tbl_cust_sess_start_date`,"%H:%i") <= \'11:00\') as `BREAKFAST`,
			(DATE_FORMAT(`tbl_cust_sess_start_date`,"%H:%i") >=  \'11:01\' AND DATE_FORMAT(`tbl_cust_sess_start_date`,"%H:%i") <= \'16:00\') as `LUNCH`,
			(DATE_FORMAT(`tbl_cust_sess_start_date`,"%H:%i") >=  \'16:01\' AND DATE_FORMAT(`tbl_cust_sess_start_date`,"%H:%i") <= \'22:00\') as `DINNER`
FROM 
`tbl_table_customer_session` ts
LEFT OUTER JOIN 
			`tbl_dining_table` tb
		ON 
			`ts`.`tbl_cust_sess_table_id` = tb.`table_id`
LEFT OUTER JOIN
	     `tbl_table_status_link`	tsl
		ON 	 
		   `ts`.`tbl_cust_sess_id` = `tsl`.`tbl_sts_lnk_session_id`
LEFT OUTER JOIN 
		`'.TBL_STAFF.'` 
		ON `tbl_sts_lnk_emp_id`=`'.STAFF_MEMBER_ID.'`			 
  WHERE '.chkTableInRestaurant('`tbl_sts_lnk_table_id`').' '.$cond.$cond_din_lunch.'  
GROUP BY DATE_FORMAT(`tbl_cust_sess_start_date` ,\''.$date_cond.'\'),'.$sql_group_cond; 		
	 }elseif($report_type == 'delayed'){	
	 	  if(is_not_empty($server)){
				$cond .= ' AND `srvc_reqst_emp_id` = '.$server.'';
				$usr_detail=get_user($server);
				$rpt_lbl_cond .=' by server '.$usr_detail["full_name"];					
			}	
			if(is_not_empty($table)){
				$cond .= ' AND `srvc_reqst_table_id` = '.$table.'';
				$table_info=tbl_dining_table::GetInfo($table);
				$rpt_lbl_cond .=' from '.$table_info["table_number"];
			}			
			$y_axis='delayed';
			$y_axis_title = 'Delayed Count';
			$rpt_lbl = 'Request Delayed Report';
	 	  $qry = 'SELECT  SQL_NO_CACHE YEAR(`srvc_reqst_created_on` ) AS `yr`,MONTHNAME(`srvc_reqst_created_on`) AS  `mon` , DAYOFMONTH(`srvc_reqst_created_on`) as `day`,`srvc_reqst_id` , 
SUM(IF(
IFNULL(`srvc_reqst_completed_at`,0)<>0,
IF(
(
IFNULL(TIMESTAMPDIFF( 
MINUTE ,`srvc_reqst_created_on`,`srvc_reqst_completed_at`),0)
-
IFNULL((SELECT MAX(`status_exp_time`) FROM `tbl_statuses` WHERE `status_event`= \'REQUEST\' AND `status_hidden` = 0),0)
)>0,0,1)
,1)) as `delayed`,
			`srvc_reqst_table_id`,`table_number`,`srvc_reqst_emp_id`,CONCAT(staff_fname,\' \', staff_lname) `server_name`,
			(DATE_FORMAT(`srvc_reqst_created_on`,"%H:%i") >=  \'07:00\' AND DATE_FORMAT(`srvc_reqst_created_on`,"%H:%i") <= \'11:00\') as `BREAKFAST`,
			(DATE_FORMAT(`srvc_reqst_created_on`,"%H:%i") >=  \'11:01\' AND DATE_FORMAT(`srvc_reqst_created_on`,"%H:%i") <= \'16:00\') as `LUNCH`,
			(DATE_FORMAT(`srvc_reqst_created_on`,"%H:%i") >=  \'16:01\' AND DATE_FORMAT(`srvc_reqst_created_on`,"%H:%i") <= \'22:00\') as `DINNER`
FROM  `tbl_services_requests` 
LEFT OUTER JOIN 
			`tbl_dining_table` tb
		ON 
			`tbl_services_requests`.`srvc_reqst_table_id` = tb.`table_id`	
LEFT OUTER JOIN 
		`'.TBL_STAFF.'` 
		ON `srvc_reqst_emp_id`=`'.STAFF_MEMBER_ID.'`		
WHERE '.chkTableInRestaurant('`srvc_reqst_table_id`').' AND `srvc_reqst_status`<>4 '.$cond.$cond_din_lunch.'
GROUP BY 
	DATE_FORMAT(`srvc_reqst_created_on`,\''.$date_cond.'\'),'.$sql_group_cond; 
	 }
	 //echo "$qry";
	 $res = mysql_query($qry); 
	 $report_op=self::getGrpahImage($res,$group_on,$third_dimension,$x_axis_title,$y_axis_title,$rpt_lbl,$rpt_lbl_cond,$x_axis,$y_axis,$report_type);
	 return $report_op;	
	 /*$cnt=0;
	 if(($res) && (mysql_num_rows($res)>0)){		 	
		$tmparr=array();
		$_datay=array();
		while($row = mysql_fetch_assoc($res)){
				$tmparr[$row[$x_axis]]=$row[$x_axis];
				//..Get group on field
				if(is_not_empty($group_on)){
					foreach($group_on as $_each_group){
							if($third_dimension=='lunch_dine'){	
								if($row["$_each_group"]==1){
									$_datay["$_each_group"][$row[$x_axis]]=$row[$y_axis];
								}								
							}else{
								if(is_gt_zero_num($row["$_each_group"])){
									$_datay[$row["$_each_group"]][$row[$x_axis]]=$row[$y_axis];
									if($_each_group=='srvc_reqst_table_id'){
											$grfld_arr[$row["$_each_group"]]=$row['table_number'];
									}elseif($_each_group=='srvc_reqst_emp_id' || $_each_group=='tbl_sts_lnk_emp_id'){
											$grfld_arr[$row["$_each_group"]]=$row['server_name'];
									}else{
										$grfld_arr[$row["$_each_group"]]=$row["$_each_group"];
									}	
								}							
							}
					}
				}			
		}
		if($third_dimension=='lunch_dine'){
			$grfld_arr=$group_on;
		}
		if(is_not_empty($grfld_arr)){
			//$grfld_arr=array_filter($grfld_arr);			
		}		
		if(is_not_empty($tmparr)) {
				$datax=array_keys($tmparr);
		}
		unset($row);
		
		//..final logic to fetch based on the data based on the 3rd dimension 
		$datay=array();
		if(is_not_empty($_datay)){
			foreach($_datay as $_third_dim => $row ){
					foreach($datax as $key =>$value){
						if($third_dimension=='lunch_dine'){
							$legend=$grfld_arr[$_third_dim].'_'.$_third_dim;
						}else{
							$legend=$_third_dim.'_'.$grfld_arr[$_third_dim];
						}
						
						if(is_not_empty($row[$value])){
							$datay[$legend][$key]=$row[$value];						
						}else{
							$datay[$legend][$key]=0;	 
						}					
					}
			}
		}
	   //print_r(array($datax,$datay));exit; 
	 	$img_src = print_on_graph($datax,$datay,$x_axis_title,$y_axis_title,"$rpt_lbl $rpt_lbl_cond");
	 }else{
	 	$img_src = "";
	 }		
	 //return $img_src;
	 $report_op=array('img_src'=>$img_src,'title'=>"{$rpt_lbl} {$rpt_lbl_cond}");
	 return $report_op;	*/		
	}
	
	//..third report
	public function rpt_promotion($promotion,$time_period,$report_type='bill',$start_date='',$end_date='',$customer='',$table='',$lunch_dinner='LUNCH',$group_on=array('lunch_dine'),$amount_type='AVG',$third_dimension='lunch_dine'){
		$x_axis='';
		$y_axis='';
		$img_src = '';
		$rpt_lbl_cond='';
		
		if($customer=='All'){
			$customer='';
		}
		//..get groupon condition
		if(is_not_empty($group_on)){
			$sql_group_cond=implode(",", $group_on);
		}
		
		if($time_period == 'date_range'){
			if($report_type == 'claimed'){
				$_dt_fld_name='redimed_date';
			}else{
				$_dt_fld_name='created_date';
			}
			if((is_not_empty($start_date)) && (is_not_empty($end_date))){
				$cond .= ' AND (`'.$_dt_fld_name.'` >=\''.$start_date.'\' AND `'.$_dt_fld_name.'` <= \''.$end_date.'\')';
				 //$rpt_lbl_cond .='Datewise ';
				 $rpt_lbl_cond .='Datewise ['.date('m/d/y',strtotime($start_date)).' -'.date('m/d/y',strtotime($end_date)).'] ';
			}		
			$x_axis='day';
			$x_axis_title = 'Date';	
			$date_cond = '%Y%m%d';
		}elseif($time_period == 'monthly'){
			if($report_type == 'claimed'){
				$_dt_fld_name='redimed_date';
			}else{
				$_dt_fld_name='created_date';
			}
			if((is_not_empty($start_date)) && (is_not_empty($end_date))){
				$cond .= ' AND (`'.$_dt_fld_name.'` >=\''.$start_date.'\' AND `'.$_dt_fld_name.'` <= \''.$end_date.'\')';
			}
			$date_cond = '%m';
			$x_axis='mon';
			$x_axis_title = 'month';
			$rpt_lbl_cond .='monthly ';
		}elseif($time_period == 'annually'){
			$date_cond = '%Y';
			$x_axis='yr';
			$x_axis_title = 'year';
			$rpt_lbl_cond .='annually ';
		} 
		//..Set amount type...
		if($report_type == 'bill_avg'){
			$amount_type='AVG';
		}elseif($report_type == 'bill_total'){
			$amount_type='SUM';
		}elseif($report_type == 'bill_avg_cust'){
			$amount_type='AVG';
		}		

		if(is_gt_zero_num($promotion)){
			$cond .= ' AND `pds_redim_cupons`.`promotion_id`='.$promotion.'';			
			$prom_det=GetPromotionTitle($promotion);
			if(is_not_empty($prom_det))
				$rpt_lbl_cond .=' for \''.$prom_det['title'].'\'';
		}
	    if(($report_type == 'bill_avg') || ($report_type == 'bill_total')){
			$join_cond = '';	
			$new_field='';	 
			$rpt_lbl 			= 'Promotion wise Report';			
			
			//$new_field='AVG(IF(`tbl_orders`.`order_prom_discnt`,`tbl_orders`.`order_prom_discnt`,SUM(`oapr`.`ordprom_discount_amt`))) as `order_prom_discnt`,';
			//$new_field='SUM(`oapr`.`ordprom_discount_amt`) as `app_prom`,`tbl_orders`.`order_prom_discnt` as `order_prom_discnt`,';
			$new_field='('.$amount_type.'(`oapr`.`ordprom_discount_amt`)+(`tbl_orders`.`order_prom_discnt`)) as `saving`,';
				
			if($report_type == 'order_prom_discnt'){
				$y_axis				='order_prom_discnt';
				$y_axis_title ='Saved Amount';	
				$cond .= ' AND (`tbl_orders`.`order_prom_discnt` >0 OR `oapr`.`ordprom_discount_amt`>0)';
				$join_cond = ' LEFT OUTER JOIN 
			`tbl_order_applied_proms` oapr
		ON 
			`tbl_orders`.`order_id`=oapr.`ord_dtl_order_id` ';
				$new_field='IF(`oapr`.`ordprom_discount_amt`>0 ,`oapr`.`ordprom_discount_amt`,`tbl_orders`.`order_prom_discnt`) as `order_prom_discnt`,';
			}elseif($report_type == 'bill_avg_cust'){
				$y_axis				='bill_amount_per_guest';
				$y_axis_title 		='Avg. Bill Amount/Customer';	
			}elseif($report_type == 'is_return_cust'){
				$y_axis				='is_return_cust';
				$y_axis_title 		='Returning Customer';	
				$cond .= ' AND `pds_redim_cupons`.`is_return_cust` >0 ';
			}else{
				$x_axis = 'id';
				$y_axis				= 'bill_amount';
				$y_axis_title 		= $amount_type.' Bill Amount';	
			}
			
			/*
			(	 SELECT 
			IF(`tbl_orders`.`order_prom_discnt`,`tbl_orders`.`order_prom_discnt`,SUM(`oapr`.`ordprom_discount_amt`)) 
			FROM 
			`tbl_order_applied_proms` oapr
			WHERE
			oapr.`ord_dtl_order_id`=`tbl_orders`.`order_id`
			) as `saved`,
			*/
						
	 		$qry = 'SELECT 	 	
			 SQL_NO_CACHE YEAR(`created_date`) as `yr`, MONTHNAME(`created_date`) as `mon`,DAYOFMONTH(`created_date`) as `day`,'.$new_field.'
			 `tbl_orders`.`order_customer_name`,`tbl_orders`.`order_id`,
			 `tbl_orders`.`order_table_id`,`table_number`,`order_created_on`,
			 `pds_list_promotions`.`id`,`pds_list_promotions`.`title`,`pds_redim_cupons`.`is_return_cust`,
			 `pds_redim_cupons`.`customer_name`,
			 (
				'.$amount_type.'(
				IFNULL(
					 od.`ord_dtl_quantity` * IF(od.`ord_dtl_discount` > 0, (od.`ord_dtl_price`-(od.`ord_dtl_price` * (od.`ord_dtl_discount`/100))),od.`ord_dtl_price`)
				,0) 
				+ 
				IFNULL(
				op.`ord_det_opt_qty` * IF(op.`ord_det_opt_discount` > 0, (op.`ord_det_opt_price`-(op.`ord_det_opt_price` * (op.`ord_det_opt_discount`/100))),op.`ord_det_opt_price`)
				,0)
				-
				IF(`tbl_orders`.`order_prom_discnt`,`tbl_orders`.`order_prom_discnt`,`oapr`.`ordprom_discount_amt`) 
				)			
			) `bill_amount`
		FROM 
			`pds_redim_cupons`		
		INNER JOIN  
			`pds_list_promotions` 
		ON 
			`pds_list_promotions`.`id` = `pds_redim_cupons`.`promotion_id`
		INNER JOIN  
			`tbl_orders`  
		ON 	
		 	`pds_redim_cupons`.`order_id`=`tbl_orders`.`order_id`
		LEFT OUTER JOIN 
			`tbl_dining_table` tb
		ON 
			`tbl_orders`.`order_table_id` = tb.`table_id`	
		
		LEFT OUTER JOIN 
			`tbl_order_applied_proms` oapr
		ON 
			`tbl_orders`.`order_id`=oapr.`ord_dtl_order_id`			 
		
		LEFT OUTER JOIN 
			`tbl_order_details` od
		ON 
			`tbl_orders`.`order_id`=od.`ord_dtl_order_id`		
		LEFT OUTER JOIN 
			`tbl_order_details_options` op 
		ON 
			od.`ord_dtl_id`=op.`ord_det_opt_order_detail`
		WHERE `pds_list_promotions`.`prm_restaurent` = '.$_SESSION[SES_RESTAURANT].' '.$cond.$cond_din_lunch.'
		GROUP BY 
		'.$sql_group_cond; 	
        //DATE_FORMAT(`created_date`, \''.$date_cond.'\'),'.$sql_group_cond; 	
        
       // echo "qry=$qry";
        $report_type='prom_bill_only';
        
	 }elseif($report_type == 'bill_avg_cust'){
	 	
	 	$y_axis				='bill_amount_per_guest';
		$y_axis_title 		='Avg. Bill Amount/Customer';
		$qry = 'SELECT 	 	
			 SQL_NO_CACHE YEAR(`created_date`) as `yr`, MONTHNAME(`created_date`) as `mon`,DAYOFMONTH(`created_date`) as `day`,'.$new_field.'
			 `tbl_orders`.`order_customer_name`,`tbl_orders`.`order_id`,
			 `tbl_orders`.`order_table_id`,`table_number`,`order_created_on`,
			 `pds_list_promotions`.`id`,`pds_list_promotions`.`title`,`pds_redim_cupons`.`is_return_cust`,
			 `pds_redim_cupons`.`customer_name`,			
			(	
				AVG(
				IFNULL(
					 od.`ord_dtl_quantity` * IF(od.`ord_dtl_discount` > 0, (od.`ord_dtl_price`-(od.`ord_dtl_price` * (od.`ord_dtl_discount`/100))),od.`ord_dtl_price`)
				,0) 
				+ 
				IFNULL(
				op.`ord_det_opt_qty` * IF(op.`ord_det_opt_discount` > 0, (op.`ord_det_opt_price`-(op.`ord_det_opt_price` * (op.`ord_det_opt_discount`/100))),op.`ord_det_opt_price`)
				,0)
				-
				IF(`tbl_orders`.`order_prom_discnt`,`tbl_orders`.`order_prom_discnt`,`oapr`.`ordprom_discount_amt`)
				
				)/SUM(`order_guest`)			
			) `bill_amount_per_guest`
		FROM 
			`pds_redim_cupons`		
		INNER JOIN  
			`pds_list_promotions` 
		ON 
			`pds_list_promotions`.`id` = `pds_redim_cupons`.`promotion_id`
		INNER JOIN  
			`tbl_orders`  
		ON 	
		 	`pds_redim_cupons`.`order_id`=`tbl_orders`.`order_id`
		LEFT OUTER JOIN 
			`tbl_dining_table` tb
		ON 
			`tbl_orders`.`order_table_id` = tb.`table_id`	
		
		LEFT OUTER JOIN 
			`tbl_order_applied_proms` oapr
		ON 
			`tbl_orders`.`order_id`=oapr.`ord_dtl_order_id`			 
		
		LEFT OUTER JOIN 
			`tbl_order_details` od
		ON 
			`tbl_orders`.`order_id`=od.`ord_dtl_order_id`		
		LEFT OUTER JOIN 
			`tbl_order_details_options` op 
		ON 
			od.`ord_dtl_id`=op.`ord_det_opt_order_detail`
		WHERE `pds_list_promotions`.`prm_restaurent` = '.$_SESSION[SES_RESTAURANT].' '.$cond.$cond_din_lunch.'
		GROUP BY ';
		//..if time frame provided then only show 
		if(is_not_empty($time_period)) {
			$qry .= ' DATE_FORMAT(`created_date`, \''.$date_cond.'\'),';
		}
		$qry .= $sql_group_cond; 	
					
	 }elseif($report_type == 'claimed'){	 	
	 	  	
			if(is_not_empty($table)){
				$cond .= ' AND `srvc_reqst_table_id` = '.$table.'';
				$table_info=tbl_dining_table::GetInfo($table);
				$rpt_lbl_cond .=' from '.$table_info["table_number"];
			}
			$rpt_lbl = 'Promotion Redeemed Report';		
			$y_axis='Redeemed';	
			$y_axis_title ='Redeemed';
			
	 	    $qry = 'SELECT 	 	
			 SQL_NO_CACHE YEAR(`redimed_date`) as `yr`, MONTHNAME(`redimed_date`) as `mon`,
			 DAYOFMONTH(`redimed_date`) as `day`,`pds_redim_cupons`.`order_id`,
			 `pds_list_promotions`.`id`,`pds_list_promotions`.`title`,
			 COUNT(`pds_redim_cupons`.`id`) as `Redeemed`			 
		FROM 
			`pds_redim_cupons`		
		INNER JOIN  
			`pds_list_promotions` 
		ON 
			`pds_list_promotions`.`id` = `pds_redim_cupons`.`promotion_id`		
		WHERE 
			`pds_redim_cupons`.`order_id`>0 AND `pds_redim_cupons`.`biz_redimed`=1
			 AND `pds_list_promotions`.`prm_restaurent` = '.$_SESSION[SES_RESTAURANT].'  '.$cond.$cond_din_lunch.'	
		GROUP BY '; 
    		//DATE_FORMAT(`redimed_date`, \''.$date_cond.'\'),`pds_redim_cupons`.`promotion_id`';//.$sql_group_cond;
    	if(is_not_empty($time_period)) {
			$qry .= ' DATE_FORMAT(`redimed_date`, \''.$date_cond.'\'),';
		}else{
			$x_axis_title="promotion";
		}	
    	$qry .= ' `pds_list_promotions`.`id`';
    	//echo "qry=$qry";    	 
    
	 }elseif($report_type == 'emailed'){	 	 
		 $rpt_lbl = 'Total no. of promotion texts/emails sent';		
		 $y_axis='prom_sent';	
		 $y_axis_title ='Promotion Email/Text Sent';
		 if(is_not_empty($time_period)) {
			$date_cond = '`p`.`prm_restaurent` = '.$_SESSION[SES_RESTAURANT].' 
					 AND (`pe`.`start_date` >= "'.date('Y-m-d 00:00:00',strtotime($start_date)).'" AND `pe`.`start_date` <= "'.date('Y-m-d 23:59:59',strtotime($end_date)).'")';
			$dtgroup_cond = ' DATE_FORMAT(`pe`.`start_date`, \''.$date_cond.'\'),';			
		}else{
			$date_cond='1';
			$dtgroup_cond = '';
			$x_axis_title="promotion";
		}	
		if(is_gt_zero_num($promotion)){
			$date_cond .= ' AND `pe`.`crm_pr_ml_promotion`='.$promotion.'';
		}
	  	$qry = 'SELECT 
	  				 SQL_NO_CACHE YEAR(`pe`.`start_date`) as `yr`, MONTHNAME(`pe`.`start_date`) as `mon`,
			 		 DAYOFMONTH(`pe`.`start_date`) as `day`,
	 				 `pe`.`crm_pr_ml_promotion` as `id`,`p`.`title`,
	 				 COUNT(`pe`.`crm_pr_ml_id`) as `prom_sent`,
					 SUM(case when `pe`.`flg_send` = 1 then 1 else 0 end) as `claimed`
					 FROM `crm_prom_emails` as `pe` 
					 INNER JOIN `pds_list_promotions` `p`	ON `p`.`id`=`pe`.`crm_pr_ml_promotion`
					 WHERE '.$date_cond.'
					 GROUP BY '.$dtgroup_cond.' `pe`.`crm_pr_ml_promotion`;
					 '; 
	 }
	 $res = mysql_query($qry); 	
	 //echo "qry=$qry ";	 	
	 $cnt=0;
	 
	 $report_op=self::getGrpahImage($res,$group_on,$third_dimension,$x_axis_title,$y_axis_title,$rpt_lbl,$rpt_lbl_cond,$x_axis,$y_axis,$report_type);
	 return $report_op;
	 
	 /*if(($res) && (mysql_num_rows($res)>0)){		 	
		$tmparr=array();
		$_datay=array();
		while($row = mysql_fetch_assoc($res)){
				$tmparr[$row[$x_axis]]=$row[$x_axis];
				//..Get group on field
				if(is_not_empty($group_on)){
					foreach($group_on as $_each_group){
							if($third_dimension=='lunch_dine'){
								if($row["$_each_group"]==1){
									$_datay["$_each_group"][$row[$x_axis]]=$row[$y_axis];
								}								
							}else{
								if(is_gt_zero_num($row["$_each_group"])){
									$_datay[$row["$_each_group"]][$row[$x_axis]]=$row[$y_axis];
									if($_each_group=='order_table_id'){
											$grfld_arr[$row["$_each_group"]]=$row['table_number'];
									}elseif($_each_group=='id'){
											$grfld_arr[$row["$_each_group"]]=$row['title'];
									}else{
											$grfld_arr[$row["$_each_group"]]=$row["$_each_group"];
									}	
								}							
						 }
					}
				}
		}
		if($third_dimension=='lunch_dine'){
			$grfld_arr=$group_on;
		}
		if(is_not_empty($grfld_arr)){
			//$grfld_arr=array_filter($grfld_arr);			
		}		
		if(is_not_empty($tmparr)) {
				$datax=array_keys($tmparr);
		}
		unset($row);
		//print_r($_datay);
		//print_r($grfld_arr);
		//exit;	
		
		//..final logic to fetch based on the data based on the 3rd dimension 
		$datay=array();
		if(is_not_empty($_datay)){
			foreach($_datay as $_third_dim => $row ){
					foreach($datax as $key =>$value){
						if($third_dimension=='lunch_dine'){
							$legend=$grfld_arr[$_third_dim].'_'.$_third_dim;
						}else{
							$legend=$_third_dim.'_'.get_elipsis($grfld_arr[$_third_dim],20);
						}
						
						if(is_not_empty($row[$value])){
							$datay[$legend][$key]=$row[$value];						
						}else{
							$datay[$legend][$key]=0;	 
						}					
					}
			}
		}
		
	 //print_r(array($datax,$datay));exit;	
	 $img_src = print_on_graph($datax,$datay,$x_axis_title,$y_axis_title,"{$rpt_lbl} {$rpt_lbl_cond}");	

	 }else{
	 	$img_src = "";
	 }		*/
	 //return $img_src;
	 
	 //$report_op=array('img_src'=>$img_src,'title'=>"{$rpt_lbl} {$rpt_lbl_cond}");
	 //return $report_op;			
	}
	
	public static function getTimePeriods(){
		return array('monthly'=>'Monthly','annually'=>'Annually','date_range'=>'Date Range');
	}
	
	public static function getTimeFeedbackPeriods(){
		return array('monthly'=>'Monthly','annually'=>'Annually','daily'=>'Daily');
	}		
	
	public static function showGraph($rpt_show){
			$qry="";
		 /*if($rpt_show=='restaurent'){
		 	  $qry=rpt_promotion($promotion,$time_period,$report_type='promotionwise',$start_date='',$end_date='',$customer='',$table='',$lunch_dinner='LUNCH');
		 }elseif($rpt_show=='restaurent'){
		 	  $qry=rpt_promotion($promotion,$time_period,$report_type='promotionwise',$start_date='',$end_date='',$customer='',$table='',$lunch_dinner='LUNCH'); 
		 }elseif($rpt_show=='restaurent'){
		 	  $qry=rpt_promotion($promotion,$time_period,$report_type='promotionwise',$start_date='',$end_date='',$customer='',$table='',$lunch_dinner='LUNCH');
		 }*/		 
	}
	
	public static function getGrpahImage($res,$group_on,$third_dimension,$x_axis_title,$y_axis_title,$rpt_lbl,$rpt_lbl_cond,$x_axis,$y_axis,$report_type){
		 
	 $report_op='';
	 $cnt=0;
	 if(($res) && (mysql_num_rows($res)>0)){
		$tmparr=array();
		$_datay=array();
		$grfld_arr=array(); 
		/*if($third_dimension=='month'){
			$group_on[0] = 'mon';
		}*/
		//print_r($group_on);
		$_is_it_promotion=0;
		//echo "<br>3rd=".$third_dimension;
		while($row = mysql_fetch_assoc($res)){
				$tmparr[$row[$x_axis]]=$row[$x_axis];				 
				//..Get group on field
				if(is_not_empty($group_on)){
					foreach($group_on as $_each_group){
							if($third_dimension=='lunch_dine'){
								if($row["$_each_group"]==1){
									$_datay["$_each_group"][$row[$x_axis]]=$row[$y_axis];
								}								
							}elseif($third_dimension=='month'){ 
									$_datay[$row['mon']][$row[$x_axis]]=$row[$y_axis]; 
									//echo $row["$_each_group"].'<br/>';
							}else{
								if(is_not_empty($row["$_each_group"])){
										//echo "_each_group=$_each_group";	
										if($report_type=='prom_bill_only'){
											$_is_it_promotion=1;
											$_datay['Bill'][$row["$_each_group"]]=$row[$y_axis];
											$_datay['Disc'][$row["$_each_group"]]=$row['saving'];
										}else{
											$_datay[$row["$_each_group"]][$row[$x_axis]]=$row[$y_axis];
										}								
										
										//$_datay[$row["$_each_group"]][$row[$x_axis]]=$row[$y_axis];
										if($_each_group=='order_table_id'){
												$grfld_arr[$row["$_each_group"]]=$row['table_number'];
										}elseif($_each_group=='srvc_reqst_table_id' || $_each_group=='tbl_cust_sess_table_id'){
												$grfld_arr[$row["$_each_group"]]=$row['table_number'];
										}elseif($_each_group=='srvc_reqst_emp_id' || $_each_group=='tbl_sts_lnk_emp_id'){
												$grfld_arr[$row["$_each_group"]]=$row['server_name'];
										}elseif($_each_group=='id'){
												$grfld_arr[$row["$_each_group"]]=$row['title'];
										}else{
												$grfld_arr[$row["$_each_group"]]=$row["$_each_group"];
										}	
								}							
						 }
					}
				} 
		}
		
		
		if($third_dimension=='lunch_dine' || $third_dimension=='month'){
			$grfld_arr=$group_on;
		}
		 
		if(is_not_empty($grfld_arr)){
			//$grfld_arr=array_filter($grfld_arr);			
		}		
		if(is_not_empty($tmparr)) {
			$datax=array_keys($tmparr);
			/*if(is_gt_zero_num($_is_it_promotion)){
				$datax=array('bill','discnt');
			}else{
				$datax=array_keys($tmparr);	
			}*/			
		}
		//print_r($grfld_arr);
		//print_r($datax);
		//print_r($_datay);

		//echo "<br>third_dimension=$third_dimension<br>";
		unset($row);
		
		//..final logic to fetch based on the data based on the 3rd dimension 
		$datay=array();
		if(is_not_empty($_datay)){			 
			foreach($_datay as $_third_dim => $row ){
					foreach($datax as $key =>$value){
						if($third_dimension=='lunch_dine'){
							$legend=$grfld_arr[$_third_dim].'_'.$_third_dim; 
						}elseif($third_dimension=='month'){
							$legend=$grfld_arr[$_third_dim].'_'.$_third_dim;
						}else{
							$legend=$_third_dim.'_'.get_elipsis($grfld_arr[$_third_dim],20);
						}	
						if($report_type=='prom_bill_only'){
							$legend=$grfld_arr[$_third_dim].'_'.$_third_dim;
						}					
						if(is_not_empty($row[$value])){
							$datay[$legend][$key]=$row[$value];						
						}else{
							$datay[$legend][$key]=0;	 
						}		
					}
			}
		}	
		
	  if($report_type=='prom_bill_only'){
	  	unset($tmparr);
	  	unset($datax);
	 	$tmparr=(array_values($grfld_arr));//$grfld_arr;
	 	foreach($tmparr as $val){
			$datax[]= get_elipsis($val,15);			
		}
		$x_axis_title="promotion";
	  }	
	/* 
	 print_r($datax); 
	 print_r($datay);
	 */		
	 //print_r(array($datax,$datay));exit;	
	 
	/*
	$datax= array ( 
	"0" => 'PROM1', 
	"1" => 'PROM2' 
	) ;
	$datay= array ( 
	'Bill' => array ( 6.3999999046, 4.6791666448 ),
	'Discount' => Array ( 2.150000, 1.952778 )
	);
	*/
 
	 $img_src = print_on_graph($datax,$datay,$x_axis_title,$y_axis_title,"{$rpt_lbl} {$rpt_lbl_cond}");	

	 }else{
	 	$img_src = "";
	 }		
	 //return $img_src;
	 $report_op=array('img_src'=>$img_src,'title'=>"{$rpt_lbl} {$rpt_lbl_cond}");
	 return $report_op;	
	}	
}
?>