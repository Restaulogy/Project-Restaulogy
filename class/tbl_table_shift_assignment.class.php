<?php/**********************************************************************tbl_table_shift_assignment.class.phpGenerated by STRUCTY 2013.03.20 05:15:09.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define("TBL_TABLE_SHIFT_ASSIGNMENT", "tbl_table_shift_assignment"); define('TBL_SFT_ID', 'tbl_sft_id'); define('TBL_SFT_RESTAURANT_ID', 'tbl_sft_restaurant_id'); define('TBL_SFT_SHIFT_ID', 'tbl_sft_shift_id'); define('TBL_SFT_EMP_ID', 'tbl_sft_emp_id'); define('TBL_SFT_TABLE_ID', 'tbl_sft_table_id'); define('TBL_SFT_PERIOD_FROM', 'tbl_sft_period_from'); define('TBL_SFT_PERIOD_TO', 'tbl_sft_period_to'); define('TB_SFT_CREATED_ON', 'tb_sft_created_on'); define('TB_SFT_TERMINATED_ON', 'tb_sft_terminated_on'); 								define("TBL_TABLE_SHIFT_ASSIGNMENT_ACTIVE_DATE", "tb_sft_created_on");define("TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE", "tb_sft_terminated_on");$tbl_table_shift_assignment_active_condition= " (".TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE." is NULL OR ".TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE." = 0 OR ".TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE." > CURDATE( )) ";class tbl_table_shift_assignment {	private $tbl_sft_id;	private $tbl_sft_restaurant_id;	private $tbl_sft_shift_id;	private $tbl_sft_emp_id;	private $tbl_sft_table_id;	private $tbl_sft_period_from;	private $tbl_sft_period_to;	private $tb_sft_created_on;	private $tb_sft_terminated_on;	private $tbl_table_shift_assignment_active_date;	private $tbl_table_shift_assignment_deactive_date;	public function settbl_sft_id($pArg="0") {$this->tbl_sft_id=$pArg;}	public function settbl_sft_restaurant_id($pArg="0") {$this->tbl_sft_restaurant_id=$pArg;}	public function settbl_sft_shift_id($pArg="0") {$this->tbl_sft_shift_id=$pArg;}	public function settbl_sft_emp_id($pArg="0") {$this->tbl_sft_emp_id=$pArg;}	public function settbl_sft_table_id($pArg="0") {$this->tbl_sft_table_id=$pArg;}	public function settbl_sft_period_from($pArg="0") {$this->tbl_sft_period_from=$pArg;}	public function settbl_sft_period_to($pArg="0") {$this->tbl_sft_period_to=$pArg;}	public function settb_sft_created_on($pArg="0") {$this->tb_sft_created_on=$pArg;}	public function settb_sft_terminated_on($pArg="0") {$this->tb_sft_terminated_on=$pArg;}	public function settbl_table_shift_assignment_active_date($pArg="0") {$this->tbl_table_shift_assignment_active_date=$pArg;}	public function settbl_table_shift_assignment_deactive_date($pArg="0") {$this->tbl_table_shift_assignment_deactive_date=$pArg;}	public function gettbl_sft_id() {return $this->tbl_sft_id;}	public function gettbl_sft_restaurant_id() {return $this->tbl_sft_restaurant_id;}	public function gettbl_sft_shift_id() {return $this->tbl_sft_shift_id;}	public function gettbl_sft_emp_id() {return $this->tbl_sft_emp_id;}	public function gettbl_sft_table_id() {return $this->tbl_sft_table_id;}	public function gettbl_sft_period_from() {return $this->tbl_sft_period_from;}	public function gettbl_sft_period_to() {return $this->tbl_sft_period_to;}	public function gettb_sft_created_on() {return $this->tb_sft_created_on;}	public function gettb_sft_terminated_on() {return $this->tb_sft_terminated_on;}	public function gettbl_table_shift_assignment_active_date($pArg="0") {return $this->tbl_table_shift_assignment_active_date;}	public function gettbl_table_shift_assignment_deactive_date($pArg="0") {return $this->tbl_table_shift_assignment_deactive_date;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".TBL_TABLE_SHIFT_ASSIGNMENT.RET;		$and = "WHERE".RET;		if($array[TBL_SFT_ID] != "") {			$qry .= $and.TBL_SFT_ID." = '".$array[TBL_SFT_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_RESTAURANT_ID] != "") {			$qry .= $and.TBL_SFT_RESTAURANT_ID." = '".$array[TBL_SFT_RESTAURANT_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_SHIFT_ID] != "") {			$qry .= $and.TBL_SFT_SHIFT_ID." = '".$array[TBL_SFT_SHIFT_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_EMP_ID] != "") {			$qry .= $and.TBL_SFT_EMP_ID." = '".$array[TBL_SFT_EMP_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_TABLE_ID] != "") {			$qry .= $and.TBL_SFT_TABLE_ID." = '".$array[TBL_SFT_TABLE_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_PERIOD_FROM] != "") {			$qry .= $and.TBL_SFT_PERIOD_FROM." = '".$array[TBL_SFT_PERIOD_FROM]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_PERIOD_TO] != "") {			$qry .= $and.TBL_SFT_PERIOD_TO." = '".$array[TBL_SFT_PERIOD_TO]."'".RET;			$and = "AND".RET;		}		if($array[TB_SFT_CREATED_ON] != "") {			$qry .= $and.TB_SFT_CREATED_ON." = '".$array[TB_SFT_CREATED_ON]."'".RET;			$and = "AND".RET;		}		if($array[TB_SFT_TERMINATED_ON] != "") {			$qry .= $and.TB_SFT_TERMINATED_ON." = '".$array[TB_SFT_TERMINATED_ON]."'".RET;			$and = "AND".RET;		}	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->settbl_sft_id($record[TBL_SFT_ID]);				$this->settbl_sft_restaurant_id($record[TBL_SFT_RESTAURANT_ID]);				$this->settbl_sft_shift_id($record[TBL_SFT_SHIFT_ID]);				$this->settbl_sft_emp_id($record[TBL_SFT_EMP_ID]);				$this->settbl_sft_table_id($record[TBL_SFT_TABLE_ID]);				$this->settbl_sft_period_from($record[TBL_SFT_PERIOD_FROM]);				$this->settbl_sft_period_to($record[TBL_SFT_PERIOD_TO]);				$this->settb_sft_created_on($record[TB_SFT_CREATED_ON]);				$this->settb_sft_terminated_on($record[TB_SFT_TERMINATED_ON]);				$this->settbl_table_shift_assignment_active_date($record[TBL_TABLE_SHIFT_ASSIGNMENT_ACTIVE_DATE]);				$this->settbl_table_shift_assignment_deactive_date($record[TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE]);				return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1) {		global $tbl_table_shift_assignment_active_condition;		$qry = "SELECT `tbl_sft_id`, `tbl_sft_restaurant_id`, `tbl_sft_shift_id`, `tbl_sft_emp_id`, `tbl_sft_table_id`, `tbl_sft_period_from`, `tbl_sft_period_to`, `tb_sft_created_on`, `tb_sft_terminated_on`, `table_number`,`shift_name`, CONCAT(`staff_fname`,' ',`staff_lname`) AS `employee_name` ".RET."FROM ".TBL_TABLE_SHIFT_ASSIGNMENT." INNER JOIN  ".TBL_DINING_TABLE." ON `table_id`=`tbl_sft_table_id` INNER JOIN ".TBL_STAFF." ON `tbl_sft_emp_id` =`staff_member_id` INNER JOIN ".TBL_SHIFT." ON `tbl_sft_shift_id` = `shift_id` ".RET;		$and = "WHERE".RET;		if($array[TBL_SFT_ID] != "") {			$qry .= $and.TBL_SFT_ID." = '".$array[TBL_SFT_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_RESTAURANT_ID] != "") {			$qry .= $and.TBL_SFT_RESTAURANT_ID." = '".$array[TBL_SFT_RESTAURANT_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_SHIFT_ID] != "") {			$qry .= $and.TBL_SFT_SHIFT_ID." = '".$array[TBL_SFT_SHIFT_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_EMP_ID] != "") {			$qry .= $and.TBL_SFT_EMP_ID." = '".$array[TBL_SFT_EMP_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_TABLE_ID] != "") {			$qry .= $and.TBL_SFT_TABLE_ID." = '".$array[TBL_SFT_TABLE_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_PERIOD_FROM] != "") {			$qry .= $and.TBL_SFT_PERIOD_FROM." = '".$array[TBL_SFT_PERIOD_FROM]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_PERIOD_TO] != "") {			$qry .= $and.TBL_SFT_PERIOD_TO." = '".$array[TBL_SFT_PERIOD_TO]."'".RET;			$and = "AND".RET;		}		if($array[TB_SFT_CREATED_ON] != "") {			$qry .= $and.TB_SFT_CREATED_ON." = '".$array[TB_SFT_CREATED_ON]."'".RET;			$and = "AND".RET;		}		if($array[TB_SFT_TERMINATED_ON] != "") {			$qry .= $and.TB_SFT_TERMINATED_ON." = '".$array[TB_SFT_TERMINATED_ON]."'".RET;			$and = "AND".RET;		}		if(is_gt_zero_num($array["isActive"])) {			$qry .= $and.$tbl_table_shift_assignment_active_condition;;			$and = "AND".RET;		}				if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {					$qry .=" ORDER BY ".$array[SORT_ON]." ".$array[SORT_BY];		}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry." LIMIT ".$array[OFFSET_TITLE].",".$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		}		// echo $qry;		$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		$result_found = mysql_num_rows($r1);		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				/*$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE])== false))){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}*/			$isActive=chk_if_record_active($record[TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE]);							if($isArray){					$class_object = array();					$class_object["tbl_sft_id"]=$record[TBL_SFT_ID];					$class_object["tbl_sft_restaurant_id"]=$record[TBL_SFT_RESTAURANT_ID];					$class_object["tbl_sft_shift_id"]=$record[TBL_SFT_SHIFT_ID];					$class_object["tbl_sft_emp_id"]=$record[TBL_SFT_EMP_ID];					$class_object["tbl_sft_table_id"]=$record[TBL_SFT_TABLE_ID];					$class_object["tbl_sft_period_from"]=$record[TBL_SFT_PERIOD_FROM];					$class_object["tbl_sft_period_to"]=$record[TBL_SFT_PERIOD_TO];					$class_object["tb_sft_created_on"]=$record[TB_SFT_CREATED_ON];					$class_object["tb_sft_terminated_on"]=$record[TB_SFT_TERMINATED_ON];					$class_object["employee_name"] = $record["employee_name"];							$class_object["shift_name"] = $record["shift_name"];							$class_object["table_number"] = $record["table_number"];					$class_object["isActive"]=$isActive;				}else{					$class_object = new tbl_table_shift_assignment();					$class_object->settbl_sft_id($record[TBL_SFT_ID]);					$class_object->settbl_sft_restaurant_id($record[TBL_SFT_RESTAURANT_ID]);					$class_object->settbl_sft_shift_id($record[TBL_SFT_SHIFT_ID]);					$class_object->settbl_sft_emp_id($record[TBL_SFT_EMP_ID]);					$class_object->settbl_sft_table_id($record[TBL_SFT_TABLE_ID]);					$class_object->settbl_sft_period_from($record[TBL_SFT_PERIOD_FROM]);					$class_object->settbl_sft_period_to($record[TBL_SFT_PERIOD_TO]);					$class_object->settb_sft_created_on($record[TB_SFT_CREATED_ON]);					$class_object->settb_sft_terminated_on($record[TB_SFT_TERMINATED_ON]);				}				$class_objects[$record[TBL_SFT_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->gettbl_sft_id() != '') {			$qry  = "UPDATE ".TBL_TABLE_SHIFT_ASSIGNMENT.RET."SET".RET."			".TBL_SFT_ID." = '".$this->gettbl_sft_id()."',".RET."			".TBL_SFT_RESTAURANT_ID." = '".$this->gettbl_sft_restaurant_id()."',".RET."			".TBL_SFT_SHIFT_ID." = '".$this->gettbl_sft_shift_id()."',".RET."			".TBL_SFT_EMP_ID." = '".$this->gettbl_sft_emp_id()."',".RET."			".TBL_SFT_TABLE_ID." = '".$this->gettbl_sft_table_id()."',".RET."			".TBL_SFT_PERIOD_FROM." = '".$this->gettbl_sft_period_from()."',".RET."			".TBL_SFT_PERIOD_TO." = '".$this->gettbl_sft_period_to()."',".RET."			".TB_SFT_CREATED_ON." = '".$this->gettb_sft_created_on()."',".RET."			".TB_SFT_TERMINATED_ON." = '".$this->gettb_sft_terminated_on()."'".RET.			"WHERE ".TBL_SFT_ID." = ".$this->gettbl_sft_id().RET;			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_TABLE_SHIFT_ASSIGNMENT." (".RET.			"".TBL_SFT_RESTAURANT_ID.", ".TBL_SFT_SHIFT_ID.", ".TBL_SFT_EMP_ID.", ".TBL_SFT_TABLE_ID.", ".TBL_SFT_PERIOD_FROM.", ".TBL_SFT_PERIOD_TO.", ".TB_SFT_CREATED_ON.", ".TB_SFT_TERMINATED_ON.RET.				") VALUES (".RET.			"'".$this->gettbl_sft_restaurant_id()."',".RET.			"'".$this->gettbl_sft_shift_id()."',".RET.			"'".$this->gettbl_sft_emp_id()."',".RET.			"'".$this->gettbl_sft_table_id()."',".RET.			"'".$this->gettbl_sft_period_from()."',".RET.			"'".$this->gettbl_sft_period_to()."',".RET.			"'".$this->gettb_sft_created_on()."',".RET.			"'".$this->gettb_sft_terminated_on()."'".RET.			")".RET;			$res = mysql_query($qry);			$this->settbl_sft_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_TABLE_SHIFT_ASSIGNMENT.RET;		$and = "WHERE".RET;		if($array[TBL_SFT_ID] != "") {			$qry .= $and.TBL_SFT_ID." = '".$array[TBL_SFT_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_RESTAURANT_ID] != "") {			$qry .= $and.TBL_SFT_RESTAURANT_ID." = '".$array[TBL_SFT_RESTAURANT_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_SHIFT_ID] != "") {			$qry .= $and.TBL_SFT_SHIFT_ID." = '".$array[TBL_SFT_SHIFT_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_EMP_ID] != "") {			$qry .= $and.TBL_SFT_EMP_ID." = '".$array[TBL_SFT_EMP_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_TABLE_ID] != "") {			$qry .= $and.TBL_SFT_TABLE_ID." = '".$array[TBL_SFT_TABLE_ID]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_PERIOD_FROM] != "") {			$qry .= $and.TBL_SFT_PERIOD_FROM." = '".$array[TBL_SFT_PERIOD_FROM]."'".RET;			$and = "AND".RET;		}		if($array[TBL_SFT_PERIOD_TO] != "") {			$qry .= $and.TBL_SFT_PERIOD_TO." = '".$array[TBL_SFT_PERIOD_TO]."'".RET;			$and = "AND".RET;		}		if($array[TB_SFT_CREATED_ON] != "") {			$qry .= $and.TB_SFT_CREATED_ON." = '".$array[TB_SFT_CREATED_ON]."'".RET;			$and = "AND".RET;		}		if($array[TB_SFT_TERMINATED_ON] != "") {			$qry .= $and.TB_SFT_TERMINATED_ON." = '".$array[TB_SFT_TERMINATED_ON]."'".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($tbl_sft_restaurant_id ,$tbl_sft_shift_id ,$tbl_sft_emp_id ,$tbl_sft_table_id ,$tbl_sft_period_from ,$tbl_sft_period_to ,$tb_sft_created_on ,$tb_sft_terminated_on) {		$unique_arr = array();			//$unique_arr[TBL_SFT_ID]=$tbl_sft_id;			$unique_arr[TBL_SFT_RESTAURANT_ID]=$tbl_sft_restaurant_id;			$unique_arr[TBL_SFT_SHIFT_ID]=$tbl_sft_shift_id;			$unique_arr[TBL_SFT_EMP_ID]=$tbl_sft_emp_id;			$unique_arr[TBL_SFT_TABLE_ID]=$tbl_sft_table_id;			$unique_arr[TBL_SFT_PERIOD_FROM]=$tbl_sft_period_from;			//$unique_arr[TBL_SFT_PERIOD_TO]=$tbl_sft_period_to;			//$unique_arr[TB_SFT_CREATED_ON]=$tb_sft_created_on;			//$unique_arr[TB_SFT_TERMINATED_ON]=$tb_sft_terminated_on;		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($tbl_sft_restaurant_id ,$tbl_sft_shift_id ,$tbl_sft_emp_id ,$tbl_sft_table_id ,$tbl_sft_period_from ,$tbl_sft_period_to ,$tb_sft_created_on ,$tb_sft_terminated_on) {		if(is_not_empty($tbl_sft_restaurant_id)){			if($this->isAlreadyThere($tbl_sft_restaurant_id ,$tbl_sft_shift_id ,$tbl_sft_emp_id ,$tbl_sft_table_id ,$tbl_sft_period_from ,$tbl_sft_period_to ,$tb_sft_created_on ,$tb_sft_terminated_on)){				return OPERATION_DUPLICATE;			}else{								$this->settbl_sft_id("");				$this->settbl_sft_restaurant_id($tbl_sft_restaurant_id);				$this->settbl_sft_shift_id($tbl_sft_shift_id);				$this->settbl_sft_emp_id($tbl_sft_emp_id);				$this->settbl_sft_table_id($tbl_sft_table_id);								$this->settbl_sft_period_from($tbl_sft_period_from);				$this->settbl_sft_period_to($tbl_sft_period_to);				$this->settb_sft_created_on(date(DATE_FORMAT));								/*$this->settb_sft_created_on($tb_sft_created_on);				$this->settb_sft_terminated_on($tb_sft_terminated_on);*/							$this->insert();				return $this->gettbl_sft_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($tbl_sft_id, $tbl_sft_restaurant_id, $tbl_sft_shift_id, $tbl_sft_emp_id, $tbl_sft_table_id, $tbl_sft_period_from, $tbl_sft_period_to, $tb_sft_created_on, $tb_sft_terminated_on) {		if(is_gt_zero_num($tbl_sft_id)){			if ($this->readObject(array(TBL_SFT_ID=>$tbl_sft_id))){				$this->settbl_sft_restaurant_id($tbl_sft_restaurant_id);				$this->settbl_sft_shift_id($tbl_sft_shift_id);				$this->settbl_sft_emp_id($tbl_sft_emp_id);				$this->settbl_sft_table_id($tbl_sft_table_id);				$this->settbl_sft_period_from($tbl_sft_period_from);				$this->settbl_sft_period_to($tbl_sft_period_to);				//$this->settb_sft_created_on($tb_sft_created_on);				//$this->settb_sft_terminated_on($tb_sft_terminated_on);				$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update	public function activate($tbl_sft_id){		if(is_gt_zero_num($tbl_sft_id)){			if ($this->readObject(array(TBL_SFT_ID=>$tbl_sft_id))){				$qry  = "UPDATE ".TBL_TABLE_SHIFT_ASSIGNMENT.RET."SET".RET."			".TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE." = '".date(EMPTY_DATE_FORMAT)."' WHERE ".TBL_SFT_ID."={$tbl_sft_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end activate	public function deactivate($tbl_sft_id){		if(is_gt_zero_num($tbl_sft_id)){			if ($this->readObject(array(TBL_SFT_ID=>$tbl_sft_id))){				$qry  = "UPDATE ".TBL_TABLE_SHIFT_ASSIGNMENT.RET."SET".RET."			".TBL_TABLE_SHIFT_ASSIGNMENT_DEACTIVE_DATE." = '".date(DATE_FORMAT)."' WHERE ".TBL_SFT_ID."={$tbl_sft_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end deactivate	public function GetInfo($tbl_sft_id) {		$info = array();		if($tbl_sft_id != ""){			if($this->readObject(array("tbl_sft_id"=>$tbl_sft_id))){				$info["tbl_sft_id"]=$this->gettbl_sft_id();				$info["tbl_sft_restaurant_id"]=$this->gettbl_sft_restaurant_id();				$info["tbl_sft_shift_id"]=$this->gettbl_sft_shift_id();				$info["tbl_sft_emp_id"]=$this->gettbl_sft_emp_id();				$info["tbl_sft_table_id"]=$this->gettbl_sft_table_id();				$info["tbl_sft_period_from"]=$this->gettbl_sft_period_from();				$info["tbl_sft_period_to"]=$this->gettbl_sft_period_to();				$info["tb_sft_created_on"]=$this->gettb_sft_created_on();				$info["tb_sft_terminated_on"]=$this->gettb_sft_terminated_on();				$info["table_info"] = tbl_dining_table::GetInfo($info["tbl_sft_table_id"]);				$info["shift_info"] = tbl_shift::GetInfo($info["tbl_sft_shift_id"]);				$info["member_info"] = members::GetInfo($info["tbl_sft_emp_id"]);				$info["isActive"] = 0;				//..check deactive date is not set or 0				if((is_not_empty($this->gettbl_table_shift_assignment_deactive_date())==false)  || (is_gt_zero_num(strtotime($this->gettbl_table_shift_assignment_deactive_date()))== false)){					$info["isActive"] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($this->gettbl_table_shift_assignment_deactive_date()) >= strtotime(date(DATE_FORMAT))){						$info["isActive"] = 1;					}				}			}		return $info;		}	}//..End GetInfo}//..End tbl_table_shift_assignment?>