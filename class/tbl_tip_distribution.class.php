<?php/**********************************************************************tbl_tip_distribution.class.phpGenerated by STRUCTY 2013.08.31 09:54:37.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define("TBL_TIP_DISTRIBUTION", "tbl_tip_distribution"); define('TIP_DIS_ID', 'tip_dis_id'); define('TIP_DIS_NAME', 'tip_dis_name'); define('TIP_DIS_TOTAL_AMNT', 'tip_dis_total_amnt'); define('TIP_DIS_TYPE', 'tip_dis_type'); define('TIP_DIS_SHARED_AMONG', 'tip_dis_shared_among'); define('TIP_DIS_PERIOD_FROM', 'tip_dis_period_from'); define('TIP_DIS_PERIOD_TO', 'tip_dis_period_to'); define('TIP_DIS_START_DATE', 'tip_dis_start_date'); define('TIP_DIS_END_DATE', 'tip_dis_end_date'); define('TIP_DIS_IS_PAID', 'tip_dis_is_paid'); define('TIP_DIS_RESTAURENT', 'tip_dis_restaurent'); define("TBL_TIP_DISTRIBUTION_ACTIVE_DATE",  TIP_DIS_START_DATE);define("TBL_TIP_DISTRIBUTION_DEACTIVE_DATE",  TIP_DIS_END_DATE);$tbl_tip_distribution_active_condition= " (".TBL_TIP_DISTRIBUTION_DEACTIVE_DATE." is NULL OR ".TBL_TIP_DISTRIBUTION_DEACTIVE_DATE." = 0 OR ".TBL_TIP_DISTRIBUTION_DEACTIVE_DATE." > CURDATE( )) ";class tbl_tip_distribution { 	private $tip_dis_id;	private $tip_dis_name;	private $tip_dis_total_amnt;	private $tip_dis_type;	private $tip_dis_shared_among;	private $tip_dis_period_from;	private $tip_dis_period_to;	private $tip_dis_start_date;	private $tip_dis_end_date;		private $is_paid;	private $tip_dis_restaurent;		private $tbl_tip_distribution_active_date;	private $tbl_tip_distribution_deactive_date;	public function settip_dis_id($pArg="0") {$this->tip_dis_id=$pArg;}	public function settip_dis_name($pArg="0") {$this->tip_dis_name=$pArg;}	public function settip_dis_total_amnt($pArg="0") {$this->tip_dis_total_amnt=$pArg;}	public function settip_dis_type($pArg="0") {$this->tip_dis_type=$pArg;}	public function settip_dis_shared_among($pArg="0") {$this->tip_dis_shared_among=$pArg;}	public function settip_dis_period_from($pArg="0") {$this->tip_dis_period_from=$pArg;}	public function settip_dis_period_to($pArg="0") {$this->tip_dis_period_to=$pArg;}	public function settip_dis_start_date($pArg="0") {$this->tip_dis_start_date=$pArg;}	public function settip_dis_end_date($pArg="0") {$this->tip_dis_end_date=$pArg;}	public function settbl_tip_distribution_active_date($pArg="0") {$this->tbl_tip_distribution_active_date=$pArg;}	public function settbl_tip_distribution_deactive_date($pArg="0") {$this->tbl_tip_distribution_deactive_date=$pArg;}	public function settip_dis_restaurent($pArg="0") {$this->tip_dis_restaurent=$pArg;}		public function settip_dis_is_paid($pArg="0") {$this->tip_dis_is_paid=$pArg;}		public function gettip_dis_id() {return $this->tip_dis_id;}	public function gettip_dis_name() {return $this->tip_dis_name;}	public function gettip_dis_total_amnt() {return $this->tip_dis_total_amnt;}	public function gettip_dis_type() {return $this->tip_dis_type;}	public function gettip_dis_shared_among() {return $this->tip_dis_shared_among;}	public function gettip_dis_period_from() {return $this->tip_dis_period_from;}	public function gettip_dis_period_to() {return $this->tip_dis_period_to;}	public function gettip_dis_start_date() {return $this->tip_dis_start_date;}	public function gettip_dis_end_date() {return $this->tip_dis_end_date;}	public function gettbl_tip_distribution_active_date($pArg="0") {return $this->tbl_tip_distribution_active_date;}	public function gettbl_tip_distribution_deactive_date($pArg="0") {return $this->tbl_tip_distribution_deactive_date;}		public function gettip_dis_restaurent() {return $this->tip_dis_restaurent;}		public function gettip_dis_is_paid() {return $this->tip_dis_is_paid;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".TBL_TIP_DISTRIBUTION.RET;		$and = "WHERE".RET;		if($array[TIP_DIS_ID] != "") {			$qry .= $and.TIP_DIS_ID." = '".$array[TIP_DIS_ID]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_NAME] != "") {			$qry .= $and.TIP_DIS_NAME." = '".$array[TIP_DIS_NAME]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_TOTAL_AMNT] != "") {			$qry .= $and.TIP_DIS_TOTAL_AMNT." = '".$array[TIP_DIS_TOTAL_AMNT]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_TYPE] != "") {			$qry .= $and.TIP_DIS_TYPE." = '".$array[TIP_DIS_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_SHARED_AMONG] != "") {			$qry .= $and.TIP_DIS_SHARED_AMONG." = '".$array[TIP_DIS_SHARED_AMONG]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_PERIOD_FROM] != "") {			$qry .= $and.TIP_DIS_PERIOD_FROM." = '".$array[TIP_DIS_PERIOD_FROM]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_PERIOD_TO] != "") {			$qry .= $and.TIP_DIS_PERIOD_TO." = '".$array[TIP_DIS_PERIOD_TO]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_START_DATE] != "") {			$qry .= $and.TIP_DIS_START_DATE." = '".$array[TIP_DIS_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_END_DATE] != "") {			$qry .= $and.TIP_DIS_END_DATE." = '".$array[TIP_DIS_END_DATE]."'".RET;			$and = "AND".RET;		}				if($array[TIP_DIS_RESTAURENT] != "") {			$qry .= $and.TIP_DIS_RESTAURENT." = '".$array[TIP_DIS_RESTAURENT]."'".RET;			$and = "AND".RET;		}				if($array[TIP_DIS_IS_PAID] != "") {			$qry .= $and.TIP_DIS_IS_PAID." = ".$array[TIP_DIS_IS_PAID]."".RET;			$and = "AND".RET;		}	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->settip_dis_id($record[TIP_DIS_ID]);				$this->settip_dis_name($record[TIP_DIS_NAME]);				$this->settip_dis_total_amnt($record[TIP_DIS_TOTAL_AMNT]);				$this->settip_dis_type($record[TIP_DIS_TYPE]);				$this->settip_dis_shared_among($record[TIP_DIS_SHARED_AMONG]);				$this->settip_dis_period_from($record[TIP_DIS_PERIOD_FROM]);				$this->settip_dis_period_to($record[TIP_DIS_PERIOD_TO]);				$this->settip_dis_start_date($record[TIP_DIS_START_DATE]);				$this->settip_dis_end_date($record[TIP_DIS_END_DATE]);				$this->settbl_tip_distribution_active_date($record[TBL_TIP_DISTRIBUTION_ACTIVE_DATE]);				$this->settbl_tip_distribution_deactive_date($record[TBL_TIP_DISTRIBUTION_DEACTIVE_DATE]);								$this->settip_dis_restaurent($record[TIP_DIS_RESTAURENT]);				$this->settip_dis_is_paid($record[TIP_DIS_IS_PAID]);								return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1,$is_info = 0) {		global $tbl_tip_distribution_active_condition;		$qry = 'SELECT *'.RET.'FROM '.TBL_TIP_DISTRIBUTION.RET;		$and = 'WHERE'.RET;		if($array[TIP_DIS_ID] != "") {			$qry .= $and.TIP_DIS_ID." = '".$array[TIP_DIS_ID]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_NAME] != "") {			$qry .= $and.TIP_DIS_NAME." = '".$array[TIP_DIS_NAME]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_TOTAL_AMNT] != "") {			$qry .= $and.TIP_DIS_TOTAL_AMNT." = '".$array[TIP_DIS_TOTAL_AMNT]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_TYPE] != "") {			$qry .= $and.TIP_DIS_TYPE." = '".$array[TIP_DIS_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_SHARED_AMONG] != "") {			$qry .= $and.'FIND_IN_SET('.$array[TIP_DIS_SHARED_AMONG].','.TIP_DIS_SHARED_AMONG.')'.RET;			$and = "AND".RET;		} 		if($array[TIP_DIS_PERIOD_FROM] != "") {			$qry .= $and.TIP_DIS_PERIOD_FROM." = '".$array[TIP_DIS_PERIOD_FROM]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_PERIOD_TO] != "") {			$qry .= $and.TIP_DIS_PERIOD_TO." = '".$array[TIP_DIS_PERIOD_TO]."'".RET;			$and = "AND".RET;		} 		if($array[TIP_DIS_START_DATE] != "") {			$qry .= $and.TIP_DIS_START_DATE." = '".$array[TIP_DIS_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_END_DATE] != "") {			$qry .= $and.TIP_DIS_END_DATE." = '".$array[TIP_DIS_END_DATE]."'".RET;			$and = "AND".RET;		}				if($array[TIP_DIS_RESTAURENT] != "") {			$qry .= $and.TIP_DIS_RESTAURENT." = '".$array[TIP_DIS_RESTAURENT]."'".RET;			$and = "AND".RET;		}				if($array[TIP_DIS_IS_PAID] != "") {			$qry .= $and.TIP_DIS_IS_PAID." = ".$array[TIP_DIS_IS_PAID]."".RET;			$and = "AND".RET;		}		if(is_not_empty($array['from_date']) && is_not_empty($array['to_date'])){			$qry .= $and.' (('.TIP_DIS_PERIOD_FROM.'  BETWEEN DATE(\''.$array['from_date'].'\') AND DATE(\''.$array['to_date'].'\')) OR ('.TIP_DIS_PERIOD_TO.' BETWEEN DATE(\''.$array['from_date'].'\') AND DATE(\''.$array['to_date'].'\'))) ';			$and = 'AND'.RET;		}		if(is_gt_zero_num($array['isActive'])) {			$qry .= $and.$tbl_tip_distribution_active_condition;;			$and = 'AND'.RET;		}		if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {		$qry .=' ORDER BY '.$array[SORT_ON].' '.$array[SORT_BY];		}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry.' LIMIT '.$array[OFFSET_TITLE].','.$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		} 			  //echo $qry_with_limit;		$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		if($r1){			$result_found = mysql_num_rows($r1);		}		$class_objects = array();		$info = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_TIP_DISTRIBUTION_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_TIP_DISTRIBUTION_DEACTIVE_DATE]))== false)){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_TIP_DISTRIBUTION_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}								if($isArray){					$class_object = array();					$class_object['tip_dis_id']=$record[TIP_DIS_ID];					$class_object['tip_dis_name']=$record[TIP_DIS_NAME];					$class_object['tip_dis_total_amnt']=$record[TIP_DIS_TOTAL_AMNT];					$class_object['tip_dis_type']=$record[TIP_DIS_TYPE];					$class_object['tip_dis_shared_among']=$record[TIP_DIS_SHARED_AMONG];					$class_object['tip_dis_period_from']=$record[TIP_DIS_PERIOD_FROM];					$class_object['tip_dis_period_to']=$record[TIP_DIS_PERIOD_TO];					$class_object['tip_dis_start_date']=$record[TIP_DIS_START_DATE];					$class_object['tip_dis_end_date']=$record[TIP_DIS_END_DATE];										$class_object['tip_dis_is_paid']=$record[TIP_DIS_IS_PAID];										$class_object['shared_list']  = biz_explode(',',$record[TIP_DIS_SHARED_AMONG]); 					$class_object['shared_person'] = biz_explode(',',GetMembersFromIDs($record[TIP_DIS_SHARED_AMONG]));				 					if($record[TIP_DIS_TYPE] == 'SHARED'){						$class_object['shared_amt'] = ($record[TIP_DIS_TOTAL_AMNT] / count($class_object['shared_list']) * 1.00);						foreach($class_object['shared_list'] as $key=>$person){ 						if(is_gt_zero_num($array[TIP_DIS_SHARED_AMONG])){ 							if($array[TIP_DIS_SHARED_AMONG] != $person) 								continue 1;  							}						$info[$person]['title'] = $class_object['shared_person'][$key];						$ist = date(PH_DATE_FORMAT ,strtotime($record[TIP_DIS_PERIOD_FROM])) .' - ' .  date( PH_DATE_FORMAT ,strtotime($record[TIP_DIS_PERIOD_TO])); 						$info[$person]['period'][$ist] = $class_object['shared_amt'];	  					} 					}else{						$class_object['shared_amt'] = 0.00; 				  	$emplist = tbl_orders::getOrderTipDistribution($record[TIP_DIS_ID], $array[TIP_DIS_SHARED_AMONG]);						 					$class_object["shared_list"]= array_keys($emplist);					$personlist = array(); 					foreach($emplist as $person=>$person_info){ 						/*if(is_gt_zero_num($array[TIP_DIS_SHARED_AMONG])){ 							if($array[TIP_DIS_SHARED_AMONG] != $person) 								continue 1;  							}*/							$info[$person]['title'] = $person_info['server'];							$ist = date(PH_DATE_FORMAT ,strtotime($record[TIP_DIS_PERIOD_FROM])) .' - ' .  date( PH_DATE_FORMAT ,strtotime($record[TIP_DIS_PERIOD_TO])); 							$info[$person]['period'][$ist] = $person_info['shared_amt']; 							$personlist[] = $person_info['server']; 					} 										$class_object['shared_person']  = biz_implode(',',$personlist);			 				   					} 					$class_object['settip_dis_restaurent']=$record[TIP_DIS_RESTAURENT];										//print_r($class_object);					$class_object['isActive']=$isActive;				}else{					$class_object = new tbl_tip_distribution();					$class_object->settip_dis_id($record[TIP_DIS_ID]);					$class_object->settip_dis_name($record[TIP_DIS_NAME]);					$class_object->settip_dis_total_amnt($record[TIP_DIS_TOTAL_AMNT]);					$class_object->settip_dis_type($record[TIP_DIS_TYPE]);					$class_object->settip_dis_shared_among($record[TIP_DIS_SHARED_AMONG]);					$class_object->settip_dis_period_from($record[TIP_DIS_PERIOD_FROM]);					$class_object->settip_dis_period_to($record[TIP_DIS_PERIOD_TO]);					$class_object->settip_dis_start_date($record[TIP_DIS_START_DATE]);					$class_object->settip_dis_end_date($record[TIP_DIS_END_DATE]);					$class_object->settip_dis_restaurent($record[TIP_DIS_RESTAURENT]);										$class_object->settip_dis_is_paid($record[TIP_DIS_IS_PAID]);				}				$class_objects[$record[TIP_DIS_ID]] = $class_object;			}		}	  //print_r($info);		if(is_gt_zero_num($is_info)){			return $info;		}else{			return $class_objects;		}					}//..End readArray	public function insert() {		if($this->gettip_dis_id() != '') {			$qry  = "UPDATE ".TBL_TIP_DISTRIBUTION.RET."SET".RET."			".TIP_DIS_ID." = '".$this->gettip_dis_id()."',".RET."			".TIP_DIS_NAME." = '".$this->gettip_dis_name()."',".RET."			".TIP_DIS_TOTAL_AMNT." = '".$this->gettip_dis_total_amnt()."',".RET."			".TIP_DIS_TYPE." = '".$this->gettip_dis_type()."',".RET."			".TIP_DIS_SHARED_AMONG." = '".$this->gettip_dis_shared_among()."',".RET."			".TIP_DIS_PERIOD_FROM." = '".$this->gettip_dis_period_from()."',".RET."			".TIP_DIS_PERIOD_TO." = '".$this->gettip_dis_period_to()."',".RET."			".TIP_DIS_IS_PAID." = '".$this->gettip_dis_is_paid()."',".RET."			".TIP_DIS_RESTAURENT." = '".$_SESSION[SES_RESTAURANT]."',".RET."			".TIP_DIS_START_DATE." = '".$this->gettip_dis_start_date()."',".RET."			".TIP_DIS_END_DATE." = '".$this->gettip_dis_end_date()."'".RET.			"WHERE ".TIP_DIS_ID." = ".$this->gettip_dis_id().RET;			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_TIP_DISTRIBUTION." (".RET.			"".TIP_DIS_NAME.", ".TIP_DIS_TOTAL_AMNT.", ".TIP_DIS_TYPE.", ".TIP_DIS_SHARED_AMONG.", ".TIP_DIS_PERIOD_FROM.", ".TIP_DIS_PERIOD_TO.", ".TIP_DIS_IS_PAID.", ".TIP_DIS_START_DATE.", ".TIP_DIS_END_DATE.", ".TIP_DIS_RESTAURENT.RET.				") VALUES (".RET.			"'".$this->gettip_dis_name()."',".RET.			"'".$this->gettip_dis_total_amnt()."',".RET.			"'".$this->gettip_dis_type()."',".RET.			"'".$this->gettip_dis_shared_among()."',".RET.			"'".$this->gettip_dis_period_from()."',".RET.			"'".$this->gettip_dis_period_to()."',".RET.			"'".$this->gettip_dis_is_paid()."',".RET.			"'".$this->gettip_dis_start_date()."',".RET.			"'".$this->gettip_dis_end_date()."',".RET.			"'".$_SESSION[SES_RESTAURANT]."'".RET.			")".RET;			$res = mysql_query($qry);			$this->settip_dis_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_TIP_DISTRIBUTION.RET;		$and = "WHERE".RET;		if($array[TIP_DIS_ID] != "") {			$qry .= $and.TIP_DIS_ID." IN (".$array[TIP_DIS_ID].")".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_NAME] != "") {			$qry .= $and.TIP_DIS_NAME." = '".$array[TIP_DIS_NAME]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_TOTAL_AMNT] != "") {			$qry .= $and.TIP_DIS_TOTAL_AMNT." = '".$array[TIP_DIS_TOTAL_AMNT]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_TYPE] != "") {			$qry .= $and.TIP_DIS_TYPE." = '".$array[TIP_DIS_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_SHARED_AMONG] != "") {			$qry .= $and.TIP_DIS_SHARED_AMONG." = '".$array[TIP_DIS_SHARED_AMONG]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_PERIOD_FROM] != "") {			$qry .= $and.TIP_DIS_PERIOD_FROM." = '".$array[TIP_DIS_PERIOD_FROM]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_PERIOD_TO] != "") {			$qry .= $and.TIP_DIS_PERIOD_TO." = '".$array[TIP_DIS_PERIOD_TO]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_START_DATE] != "") {			$qry .= $and.TIP_DIS_START_DATE." = '".$array[TIP_DIS_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[TIP_DIS_END_DATE] != "") {			$qry .= $and.TIP_DIS_END_DATE." = '".$array[TIP_DIS_END_DATE]."'".RET;			$and = "AND".RET;		}				if($array[TIP_DIS_RESTAURENT] != "") {			$qry .= $and.TIP_DIS_RESTAURENT." = '".$array[TIP_DIS_RESTAURENT]."'".RET;			$and = "AND".RET;		}				if($array[TIP_DIS_IS_PAID] != "") {			$qry .= $and.TIP_DIS_IS_PAID." = ".$array[TIP_DIS_IS_PAID]."".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($tip_dis_name ,$tip_dis_total_amnt ,$tip_dis_type ,$tip_dis_shared_among ,$tip_dis_period_from ,$tip_dis_period_to ,$tip_dis_start_date ,$tip_dis_end_date) {		$unique_arr = array();			//$unique_arr[TIP_DIS_ID]=$tip_dis_id;			  $unique_arr[TIP_DIS_NAME]=$tip_dis_name;				$unique_arr[TIP_DIS_RESTAURENT]=$_SESSION[SES_RESTAURANT];			//$unique_arr[TIP_DIS_TOTAL_AMNT]=$tip_dis_total_amnt;			//$unique_arr[TIP_DIS_TYPE]=$tip_dis_type;			//$unique_arr[TIP_DIS_SHARED_AMONG]=$tip_dis_shared_among;			//$unique_arr[TIP_DIS_PERIOD_FROM]=$tip_dis_period_from;			//$unique_arr[TIP_DIS_PERIOD_TO]=$tip_dis_period_to;			//$unique_arr[TIP_DIS_START_DATE]=$tip_dis_start_date;			//$unique_arr[TIP_DIS_END_DATE]=$tip_dis_end_date;		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($tip_dis_name ,$tip_dis_total_amnt ,$tip_dis_type ,$tip_dis_shared_among ,$tip_dis_period_from ,$tip_dis_period_to ,$tip_dis_start_date ,$tip_dis_end_date) {		if(is_not_empty($tip_dis_name)){			if($this->isAlreadyThere($tip_dis_name ,$tip_dis_total_amnt ,$tip_dis_type ,$tip_dis_shared_among ,$tip_dis_period_from ,$tip_dis_period_to ,$tip_dis_start_date ,$tip_dis_end_date)){				return OPERATION_DUPLICATE;			}else{				$this->settip_dis_id("");				$this->settip_dis_name($tip_dis_name);				$this->settip_dis_total_amnt($tip_dis_total_amnt);				$this->settip_dis_type($tip_dis_type);				$this->settip_dis_shared_among($tip_dis_shared_among);				$this->settip_dis_period_from($tip_dis_period_from);				$this->settip_dis_period_to($tip_dis_period_to);				$this->settip_dis_is_paid(0);				$this->settip_dis_start_date(date(DATE_FORMAT));				$this->insert();				self::updateOrderTipDistribution($this->gettip_dis_id());				return $this->gettip_dis_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($tip_dis_id, $tip_dis_name, $tip_dis_total_amnt, $tip_dis_type, $tip_dis_shared_among, $tip_dis_period_from, $tip_dis_period_to, $tip_dis_start_date, $tip_dis_end_date,$tip_dis_is_paid=0) {		if(is_gt_zero_num($tip_dis_id)){			if ($this->readObject(array(TIP_DIS_ID=>$tip_dis_id))){				$this->settip_dis_name($tip_dis_name);				$this->settip_dis_total_amnt($tip_dis_total_amnt);				$this->settip_dis_type($tip_dis_type);				$this->settip_dis_shared_among($tip_dis_shared_among);				$this->settip_dis_period_from($tip_dis_period_from);				$this->settip_dis_period_to($tip_dis_period_to); 				$this->settip_dis_is_paid($tip_dis_is_paid);				$this->insert();				self::updateOrderTipDistribution($tip_dis_id);				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update	public function activate($tip_dis_id){		if(is_not_empty($tip_dis_id)){			//if ($this->readObject(array(TIP_DIS_ID=>$tip_dis_id))){				$qry  = "UPDATE ".TBL_TIP_DISTRIBUTION.RET."SET".RET."			".TBL_TIP_DISTRIBUTION_DEACTIVE_DATE." = '".date(EMPTY_DATE_FORMAT)."' WHERE ".TIP_DIS_ID." IN ($tip_dis_id)";				$res = mysql_query($qry);				if($res){					return 1;				}			//}		}		return 0;	}//..end activate		public function mkpaid($tip_dis_id){		if(is_not_empty($tip_dis_id)){			//if ($this->readObject(array(TIP_DIS_ID=>$tip_dis_id))){				$qry  = "UPDATE ".TBL_TIP_DISTRIBUTION.RET."SET".RET."			".TIP_DIS_IS_PAID." = 1 WHERE ".TIP_DIS_ID." IN ($tip_dis_id)";				//echo "qry=$qry";				$res = mysql_query($qry);				if($res){					return 1;				}			//}		}		return 0;	}//..end paid		public function mkunpaid($tip_dis_id){		if(is_not_empty($tip_dis_id)){			//if ($this->readObject(array(TIP_DIS_ID=>$tip_dis_id))){				$qry  = "UPDATE ".TBL_TIP_DISTRIBUTION.RET."SET".RET."			".TIP_DIS_IS_PAID." = 0 WHERE ".TIP_DIS_ID." IN ($tip_dis_id)";				$res = mysql_query($qry);				if($res){					return 1;				}			//}		}		return 0;	}//..end unpaid	public function deactivate($tip_dis_id){		if(is_not_empty($tip_dis_id)){			//if ($this->readObject(array(TIP_DIS_ID=>$tip_dis_id))){				$qry  = "UPDATE ".TBL_TIP_DISTRIBUTION.RET."SET".RET."".TBL_TIP_DISTRIBUTION_DEACTIVE_DATE." = '".date(DATE_FORMAT)."' WHERE ".TIP_DIS_ID." IN ($tip_dis_id)";				$res = mysql_query($qry);				if($res){					return 1;				}			//}		}		return 0;	}//..end deactivate	public static function GetInfo($tip_dis_id) {		$info = array();		if($tip_dis_id != ""){			$obj_tbl_tip_distribution = new tbl_tip_distribution();			if($obj_tbl_tip_distribution->readObject(array("tip_dis_id"=>$tip_dis_id))){				$info["tip_dis_id"]=$obj_tbl_tip_distribution->gettip_dis_id();				$info["tip_dis_name"]=$obj_tbl_tip_distribution->gettip_dis_name();				$info["tip_dis_total_amnt"]=$obj_tbl_tip_distribution->gettip_dis_total_amnt();				$info["tip_dis_type"]=$obj_tbl_tip_distribution->gettip_dis_type();												$info["tip_dis_period_from"]=$obj_tbl_tip_distribution->gettip_dis_period_from();				$info["tip_dis_period_to"]=$obj_tbl_tip_distribution->gettip_dis_period_to();				$info["tip_dis_start_date"]=$obj_tbl_tip_distribution->gettip_dis_start_date();				$info["tip_dis_end_date"]=$obj_tbl_tip_distribution->gettip_dis_end_date();				$info["tip_dis_restaurent"]=$obj_tbl_tip_distribution->gettip_dis_restaurent();								$info["tip_dis_is_paid"]=$obj_tbl_tip_distribution->gettip_dis_is_paid();								if($info["tip_dis_type"] == "SHARED"){					 $info[TIP_DIS_SHARED_AMONG]=$obj_tbl_tip_distribution->gettip_dis_shared_among();									$info["shared_list"]= biz_explode(',',$info[TIP_DIS_SHARED_AMONG]);					$info['shared_person'] = biz_explode(',',GetMembersFromIDs($info[TIP_DIS_SHARED_AMONG]));					foreach($info['shared_list'] as $key=>$person){ 						if(is_gt_zero_num($array[TIP_DIS_SHARED_AMONG])){ 							if($array[TIP_DIS_SHARED_AMONG] != $person) 								continue 1;  							}							$info[$person]['title'] = $info['shared_person'][$key];							$ist = date(PH_DATE_FORMAT ,strtotime($info[TIP_DIS_PERIOD_FROM])) .' - ' .  date( PH_DATE_FORMAT ,strtotime($info[TIP_DIS_PERIOD_TO])); 							$info[$person]['period'][$ist] = $class_object['shared_amt'];					  							  					} 				}else{  				  $emplist = tbl_orders::getOrderTipDistribution($info[TIP_DIS_ID]);					$info["shared_list"]= array_keys($emplist);					$personlist = array(); 					foreach($emplist as $person=>$person_info){ 						/*if(is_gt_zero_num($array[TIP_DIS_SHARED_AMONG])){ 							if($array[TIP_DIS_SHARED_AMONG] != $person) 								continue 1;  							}*/							$info[$person]['title'] = $person_info['server'];							$ist = date(PH_DATE_FORMAT ,strtotime($info[TIP_DIS_PERIOD_FROM])) .' - ' .  date( PH_DATE_FORMAT ,strtotime($info[TIP_DIS_PERIOD_TO])); 							$info[$person]['period'][$ist] = $person_info['shared_amt']; 							$personlist[] = $person_info['server']; 					} 										$info['shared_person']  = biz_implode(',',$personlist);				}								 								$info["isActive"] = 0;				//..check deactive date is not set or 0				if((is_not_empty($obj_tbl_tip_distribution->gettbl_tip_distribution_deactive_date())==false)  || (is_gt_zero_num(strtotime($obj_tbl_tip_distribution->gettbl_tip_distribution_deactive_date()))== false)){					$info["isActive"] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($obj_tbl_tip_distribution->gettbl_tip_distribution_deactive_date()) > strtotime(date(DATE_FORMAT))){						$info["isActive"] = 1;					}				}			} 		unset($obj_tbl_tip_distribution);		return $info;		}	}//..End GetInfo	public static function GetFields($data){		global $tbl_tip_distribution_active_condition;		$arr = array();		if(is_not_empty($data)){			$qry ="SELECT ".$data['key_field'].",".$data['value_field']." FROM ".TBL_TIP_DISTRIBUTION."";			if(is_gt_zero_num($data['isActive'])){				$qry .= " WHERE ".$tbl_tip_distribution_active_condition;			}			$res = mysql_query($qry); 			if($res){				while($row=mysql_fetch_assoc($res)){					$arr[$row[$data['key_field']]] = $row[$data['value_field']];				}			}		}		return $arr;	}//.. End of GetFields		 /**	 * Get Total Tip amount for the particular pariod	 * @param date $period_from	 * @param date $period_to	 * @param string $employees 	 * @return number	 */	public static function cal_tip_amt($period_from,$period_to,&$employees=""){		$tip_amt = 0;	 if(is_not_empty($period_from) && is_not_empty($period_to)){  	 // echo 'SELECT COUNT('.TIP_DIS_ID.') FROM '.TBL_TIP_DISTRIBUTION.' WHERE (('.TIP_DIS_PERIOD_FROM.'  BETWEEN DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\')) OR ('.TIP_DIS_PERIOD_TO.' BETWEEN DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\'))) ';	  $count = DB::ExecScalarQry('SELECT COUNT('.TIP_DIS_ID.') FROM '.TBL_TIP_DISTRIBUTION.' WHERE `tip_dis_restaurent`='.$_SESSION[SES_RESTAURANT].' AND (('.TIP_DIS_PERIOD_FROM.'  BETWEEN DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\')) OR ('.TIP_DIS_PERIOD_TO.' BETWEEN DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\')))'); 		 if(is_gt_zero_num($count)){		 		$tip_amt = -1;		 }else{		 		$arr =  DB::ExecQry('SELECT IFNULL(GROUP_CONCAT( DISTINCT  `order_emp_id` ),\'0\') `employees` , IFNULL( SUM(  `order_tip` ) , 0 ) `tip_amt` FROM '.TBL_ORDERS.' WHERE `order_restaurant`='.$_SESSION[SES_RESTAURANT].' AND DATE('.ORDER_CREATED_ON.') BETWEEN  DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\')',1); 				 				 $tip_amt = $arr['tip_amt']; 				 $employees = biz_explode(',',$arr['employees']);  		 }  		}		return $tip_amt; 	}	/**	* Function to get the tip employeewise	* return output html as well	*/	public static function cal_empwise_tip_amt($period_from,$period_to,$dis_type,$dis_emps,$chk_duplicate=1,&$employees="",&$output=""){		$output=array();		$tip_amt = 0;		$employees=array();	 if(is_not_empty($period_from) && is_not_empty($period_to)){  	  $count = DB::ExecScalarQry('SELECT COUNT('.TIP_DIS_ID.') FROM '.TBL_TIP_DISTRIBUTION.' WHERE `tip_dis_restaurent`='.$_SESSION[SES_RESTAURANT].' AND (('.TIP_DIS_PERIOD_FROM.'  BETWEEN DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\')) OR ('.TIP_DIS_PERIOD_TO.' BETWEEN DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\')))'); 		 if(is_gt_zero_num($count) && ($chk_duplicate==1)){		 		$tip_amt = -1;		 }else{			if(strtoupper($dis_type)=='INDIVIDUAL'){				$sql='SELECT `order_emp_id`,IF(`order_emp_id` =0,  \'-\', (			SELECT  CONCAT(`staff_fname`,\' \',`staff_lname`) AS `server` 			FROM  `tbl_staff` 			WHERE  `staff_member_id` =  `order_emp_id`		)) AS server , IFNULL( SUM(  `order_tip` ) , 0 ) `tip_amt` FROM '.TBL_ORDERS.'  WHERE `order_emp_id` !=0 AND `order_restaurant`='.$_SESSION[SES_RESTAURANT].' AND DATE('.ORDER_CREATED_ON.') BETWEEN  DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\') GROUP BY `order_emp_id`';			}else{								if(is_not_empty($dis_emps)){					$empfilter=implode(',', $dis_emps);					$empfilter=" AND `order_emp_id` IN ('{$empfilter}')";					$dis_between=count($dis_emps);				}else{					$empfilter=" AND `order_emp_id` IN ('')";					$dis_between=1;				}				//..total tip amount				$arr =  DB::ExecQry('SELECT IFNULL(GROUP_CONCAT( DISTINCT  `order_emp_id` ),\'0\') `employees` , IFNULL( SUM(  `order_tip` ) , 0 ) `tip_amt` FROM '.TBL_ORDERS.' WHERE `order_restaurant`='.$_SESSION[SES_RESTAURANT].' AND DATE('.ORDER_CREATED_ON.') BETWEEN  DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\')',1); 				$empfilter = ''; 				$total_tip_amt = $arr['tip_amt'];				 				$sql='SELECT `order_emp_id`,IF(`order_emp_id` =0,  \'-\', (			SELECT  CONCAT(`staff_fname`,\' \',`staff_lname`) AS `server` 			FROM  `tbl_staff` 			WHERE  `staff_member_id` =  `order_emp_id`		)) AS server , IFNULL( SUM(  `order_tip` ) , 0 ) `tip_amt` FROM '.TBL_ORDERS.'  WHERE `order_emp_id` !=0 '.$empfilter.' AND `order_restaurant`='.$_SESSION[SES_RESTAURANT].' AND DATE('.ORDER_CREATED_ON.') BETWEEN  DATE(\''.$period_from.'\') AND DATE(\''.$period_to.'\') GROUP BY `order_emp_id`';							}		 	 /*echo $sql;*/				$result = mysql_query($sql); 				if($result){					/*$output .= '<table>											 <tr>												<th>														Employee												</th>												<th>														Tip Collected												</th>											 </tr>													';*/					while ($row = mysql_fetch_assoc($result)) {					   /*$output .= '											 <tr>												<th>														'.$row['server'].'												</th>												<th>														'.$row['tip_amt'].'												</th>											 </tr>													';*/						//echo $dis_between,'####';						/*if(strtoupper($dis_type)=='SHARED'){							$row['shared_tip_amt'] = ($row['tip_amt']/$dis_between);						}*/										$output[]=$row;						$tip_amt =$tip_amt+$row['tip_amt'];						$employees[]=$row['order_emp_id'];											}					//$output .= '</table>';					$output=$output;				}				 				//$tip_amt = $arr['tip_amt']; 				//$employees = biz_explode(',',$arr['employees']);  		 }  		}				if(strtoupper($dis_type) == 'SHARED'){			$shared_amt =  ($tip_amt/$dis_between * 1.00);			$tmp = array();			foreach($output as $val){				  $val['tip_amt'] = $shared_amt;				  $tmp[] = $val;			}			$output = $tmp;		}		 		return $tip_amt; 	}		public static function enumDistributionType(){		return array('INDIVIDUAL'=>'Individual','SHARED'=>'Shared');	}			public static function report(){		//$qry = 'SELECT  `tip_dis_id`, `tip_dis_name`, `tip_dis_total_amnt`, `tip_dis_type`, `tip_dis_shared_among`, `tip_dis_period_from`, `tip_dis_period_to`, `tip_dis_start_date`, `tip_dis_end_date`  FROM `tbl_tip_distribution`';		$info = array();		$res = mysql_query('SELECT  `tip_dis_id`, `tip_dis_name`, `tip_dis_total_amnt`, `tip_dis_type`, `tip_dis_shared_among`, `tip_dis_period_from`, `tip_dis_period_to`, `tip_dis_start_date`, `tip_dis_end_date` FROM `tbl_tip_distribution` WHERE `tip_dis_restaurent`='.$_SESSION[SES_RESTAURANT]);		$arr = array();		if($res){				while($row=mysql_fetch_assoc($res)){				  $row['shared_list']  = biz_explode(',',$row[TIP_DIS_SHARED_AMONG]); 					$row['shared_person'] = biz_explode(',',GetMembersFromIDs($row[TIP_DIS_SHARED_AMONG]));					$row['shared_amt']	 = ($row[TIP_DIS_TOTAL_AMNT] / count($row['shared_list']) * 1.00);   										foreach($row['shared_list'] as $key=>$person){						$info[$person]['title'] = $row['shared_person'][$key];						$ist = date( PH_DATE_FORMAT ,strtotime($row[TIP_DIS_PERIOD_FROM])) .' - ' .  date( PH_DATE_FORMAT ,strtotime($row[TIP_DIS_PERIOD_TO])); 						$info[$person]['period'][$ist] = $row['shared_amt'];					  					}										//$arr[$row[TIP_DIS_ID]] = $row;				}			}		//print_r($info);		return $info;	}			/**	* Set/Unset the Tip Distribution id from the orders records	* @param string $tip_dis_id	* @param integer $isDelete	* @return boolean	*/	public static function updateOrderTipDistribution($tip_dis_id, $isDelete=0){		if(is_not_empty($tip_dis_id)){ 	  	DB::ExecNonQry('UPDATE '.TBL_ORDERS.' SET '.ORDER_TIP_DISTRIBUTION.'= 0 WHERE '.ORDER_TIP_DISTRIBUTION.' IN ('.$tip_dis_id.')');			if (is_gt_zero_num($isDelete)){				 //..no action required  				 return true;			}else{ 			  if (is_gt_zero_num($tip_dis_id)){ 					$info = self::GetInfo($tip_dis_id); 					DB::ExecNonQry('UPDATE '.TBL_ORDERS.' SET '.ORDER_TIP_DISTRIBUTION.'='.$tip_dis_id.' WHERE `order_restaurant`='.$_SESSION[SES_RESTAURANT].' AND DATE('.ORDER_CREATED_ON.') BETWEEN  DATE(\''.$info[TIP_DIS_PERIOD_FROM].'\') AND DATE(\''.$info[TIP_DIS_PERIOD_TO].'\') AND '.ORDER_EMP_ID.' <> 0 ');   					 DB::ExecNonQry('UPDATE '.TBL_TIP_DISTRIBUTION.' SET '.TIP_DIS_SHARED_AMONG.'= (SELECT GROUP_CONCAT(DISTINCT `'.ORDER_EMP_ID.'`) FROM '.TBL_ORDERS.' WHERE '.ORDER_TIP_DISTRIBUTION.'='.$tip_dis_id.')  WHERE '.TIP_DIS_ID.' =  '.$tip_dis_id);  									} 			} 		}		return false;	}	 }//..End tbl_tip_distribution?>