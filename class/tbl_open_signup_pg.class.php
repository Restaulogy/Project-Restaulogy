<?php/**********************************************************************tbl_open_signup_pg.class.phpGenerated by STRUCTY 2014.07.31 11:15:57.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define("TBL_OPEN_SIGNUP_PG", "tbl_open_signup_pg"); define('SIGN_ID', 'sign_id'); define('SIGN_TABLE_ID', 'sign_table_id'); define('SIGN_SESS_ID', 'sign_sess_id'); define('SIGN_START_DATE', 'sign_start_date'); define('SIGN_END_DATE', 'sign_end_date'); define("TBL_OPEN_SIGNUP_PG_ACTIVE_DATE",  SIGN_START_DATE);define("TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE",  SIGN_END_DATE);$tbl_open_signup_pg_active_condition= " (".TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE." is NULL OR ".TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE." = 0 OR ".TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE." > CURDATE( )) ";class tbl_open_signup_pg {	private $sign_id;	private $sign_table_id;	private $sign_sess_id;	private $sign_start_date;	private $sign_end_date;	private $tbl_open_signup_pg_active_date;	private $tbl_open_signup_pg_deactive_date;	public function setsign_id($pArg="0") {$this->sign_id=$pArg;}	public function setsign_table_id($pArg="0") {$this->sign_table_id=$pArg;}	public function setsign_sess_id($pArg="0") {$this->sign_sess_id=$pArg;}	public function setsign_start_date($pArg="0") {$this->sign_start_date=$pArg;}	public function setsign_end_date($pArg="0") {$this->sign_end_date=$pArg;}	public function settbl_open_signup_pg_active_date($pArg="0") {$this->tbl_open_signup_pg_active_date=$pArg;}	public function settbl_open_signup_pg_deactive_date($pArg="0") {$this->tbl_open_signup_pg_deactive_date=$pArg;}	public function getsign_id() {return $this->sign_id;}	public function getsign_table_id() {return $this->sign_table_id;}	public function getsign_sess_id() {return $this->sign_sess_id;}	public function getsign_start_date() {return $this->sign_start_date;}	public function getsign_end_date() {return $this->sign_end_date;}	public function gettbl_open_signup_pg_active_date($pArg="0") {return $this->tbl_open_signup_pg_active_date;}	public function gettbl_open_signup_pg_deactive_date($pArg="0") {return $this->tbl_open_signup_pg_deactive_date;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".TBL_OPEN_SIGNUP_PG.RET;		$and = "WHERE".RET;		if($array[SIGN_ID] != "") {			$qry .= $and.SIGN_ID." = '".$array[SIGN_ID]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_TABLE_ID] != "") {			$qry .= $and.SIGN_TABLE_ID." = '".$array[SIGN_TABLE_ID]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_SESS_ID] != "") {			$qry .= $and.SIGN_SESS_ID." = '".$array[SIGN_SESS_ID]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_START_DATE] != "") {			$qry .= $and.SIGN_START_DATE." = '".$array[SIGN_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_END_DATE] != "") {			$qry .= $and.SIGN_END_DATE." = '".$array[SIGN_END_DATE]."'".RET;			$and = "AND".RET;		}	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->setsign_id($record[SIGN_ID]);				$this->setsign_table_id($record[SIGN_TABLE_ID]);				$this->setsign_sess_id($record[SIGN_SESS_ID]);				$this->setsign_start_date($record[SIGN_START_DATE]);				$this->setsign_end_date($record[SIGN_END_DATE]);				$this->settbl_open_signup_pg_active_date($record[TBL_OPEN_SIGNUP_PG_ACTIVE_DATE]);				$this->settbl_open_signup_pg_deactive_date($record[TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE]);				return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1) {		global $tbl_open_signup_pg_active_condition;		$qry = "SELECT *".RET."FROM ".TBL_OPEN_SIGNUP_PG.RET;		$and = "WHERE".RET;		if($array[SIGN_ID] != "") {			$qry .= $and.SIGN_ID." = '".$array[SIGN_ID]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_TABLE_ID] != "") {			$qry .= $and.SIGN_TABLE_ID." = '".$array[SIGN_TABLE_ID]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_SESS_ID] != "") {			$qry .= $and.SIGN_SESS_ID." = '".$array[SIGN_SESS_ID]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_START_DATE] != "") {			$qry .= $and.SIGN_START_DATE." = '".$array[SIGN_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_END_DATE] != "") {			$qry .= $and.SIGN_END_DATE." = '".$array[SIGN_END_DATE]."'".RET;			$and = "AND".RET;		}		if(is_gt_zero_num($array["isActive"])) {			$qry .= $and.$tbl_open_signup_pg_active_condition;;			$and = "AND".RET;		}		if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {		$qry .=" ORDER BY ".$array[SORT_ON]." ".$array[SORT_BY];		}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry." LIMIT ".$array[OFFSET_TITLE].",".$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		}		$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		if($r1){			$result_found = mysql_num_rows($r1);		}		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE]))== false)){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}				if($isArray){					$class_object = array();					$class_object["sign_id"]=$record[SIGN_ID];					$class_object["sign_table_id"]=$record[SIGN_TABLE_ID];					$class_object["sign_sess_id"]=$record[SIGN_SESS_ID];					$class_object["sign_start_date"]=$record[SIGN_START_DATE];					$class_object["sign_end_date"]=$record[SIGN_END_DATE];					$class_object["isActive"]=$isActive;				}else{					$class_object = new tbl_open_signup_pg();					$class_object->setsign_id($record[SIGN_ID]);					$class_object->setsign_table_id($record[SIGN_TABLE_ID]);					$class_object->setsign_sess_id($record[SIGN_SESS_ID]);					$class_object->setsign_start_date($record[SIGN_START_DATE]);					$class_object->setsign_end_date($record[SIGN_END_DATE]);				}				$class_objects[$record[SIGN_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->getsign_id() != '') {			$qry  = "UPDATE ".TBL_OPEN_SIGNUP_PG.RET."SET".RET."			".SIGN_ID." = '".$this->getsign_id()."',".RET."			".SIGN_TABLE_ID." = '".$this->getsign_table_id()."',".RET."			".SIGN_SESS_ID." = '".$this->getsign_sess_id()."',".RET."			".SIGN_START_DATE." = '".$this->getsign_start_date()."',".RET."			".SIGN_END_DATE." = '".$this->getsign_end_date()."'".RET.			"WHERE ".SIGN_ID." = ".$this->getsign_id().RET;			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_OPEN_SIGNUP_PG." (".RET.			"".SIGN_TABLE_ID.", ".SIGN_SESS_ID.", ".SIGN_START_DATE.", ".SIGN_END_DATE.RET.				") VALUES (".RET.			"'".$this->getsign_table_id()."',".RET.			"'".$this->getsign_sess_id()."',".RET.			"'".$this->getsign_start_date()."',".RET.			"'".$this->getsign_end_date()."'".RET.			")".RET;			$res = mysql_query($qry);			$this->setsign_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_OPEN_SIGNUP_PG.RET;		$and = "WHERE".RET;		if($array[SIGN_ID] != "") {			$qry .= $and.SIGN_ID." = '".$array[SIGN_ID]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_TABLE_ID] != "") {			$qry .= $and.SIGN_TABLE_ID." = '".$array[SIGN_TABLE_ID]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_SESS_ID] != "") {			$qry .= $and.SIGN_SESS_ID." = '".$array[SIGN_SESS_ID]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_START_DATE] != "") {			$qry .= $and.SIGN_START_DATE." = '".$array[SIGN_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[SIGN_END_DATE] != "") {			$qry .= $and.SIGN_END_DATE." = '".$array[SIGN_END_DATE]."'".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($sign_table_id ,$sign_sess_id ,$sign_start_date ,$sign_end_date) {		$unique_arr = array();			//$unique_arr[SIGN_ID]=$sign_id;			$unique_arr[SIGN_TABLE_ID]=$sign_table_id;			$unique_arr[SIGN_SESS_ID]=$sign_sess_id;			//$unique_arr[SIGN_START_DATE]=$sign_start_date;			//$unique_arr[SIGN_END_DATE]=$sign_end_date;		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($sign_table_id ,$sign_sess_id ,$sign_start_date ,$sign_end_date) {		if(is_not_empty($sign_table_id)){			if($this->isAlreadyThere($sign_table_id ,$sign_sess_id ,$sign_start_date ,$sign_end_date)){				return OPERATION_DUPLICATE;			}else{				$this->setsign_id("");				$this->setsign_table_id($sign_table_id);				$this->setsign_sess_id($sign_sess_id);				$this->setsign_start_date(date(DATE_FORMAT));				$this->insert();				return $this->getsign_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($sign_id, $sign_table_id, $sign_sess_id, $sign_start_date, $sign_end_date) {		if(is_gt_zero_num($sign_id)){			if ($this->readObject(array(SIGN_ID=>$sign_id))){				$this->setsign_table_id($sign_table_id);				$this->setsign_sess_id($sign_sess_id);				$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update	public function activate($sign_id){		if(is_gt_zero_num($sign_id)){			if ($this->readObject(array(SIGN_ID=>$sign_id))){				$qry  = "UPDATE ".TBL_OPEN_SIGNUP_PG.RET."SET".RET."			".TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE." = '".date(EMPTY_DATE_FORMAT)."' WHERE ".SIGN_ID."={$sign_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end activate	public function deactivate($sign_id){		if(is_gt_zero_num($sign_id)){			if ($this->readObject(array(SIGN_ID=>$sign_id))){				$qry  = "UPDATE ".TBL_OPEN_SIGNUP_PG.RET."SET".RET."			".TBL_OPEN_SIGNUP_PG_DEACTIVE_DATE." = '".date(DATE_FORMAT)."' WHERE ".SIGN_ID."={$sign_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end deactivate	public static function GetInfo($sign_id) {		$info = array();		if($sign_id != ""){			$obj_tbl_open_signup_pg = new tbl_open_signup_pg();			if($obj_tbl_open_signup_pg->readObject(array("sign_id"=>$sign_id))){				$info["sign_id"]=$obj_tbl_open_signup_pg->getsign_id();				$info["sign_table_id"]=$obj_tbl_open_signup_pg->getsign_table_id();				$info["sign_sess_id"]=$obj_tbl_open_signup_pg->getsign_sess_id();				$info["sign_start_date"]=$obj_tbl_open_signup_pg->getsign_start_date();				$info["sign_end_date"]=$obj_tbl_open_signup_pg->getsign_end_date();				$info["isActive"] = 0;				//..check deactive date is not set or 0				if((is_not_empty($obj_tbl_open_signup_pg->gettbl_open_signup_pg_deactive_date())==false)  || (is_gt_zero_num(strtotime($obj_tbl_open_signup_pg->gettbl_open_signup_pg_deactive_date()))== false)){					$info["isActive"] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($obj_tbl_open_signup_pg->gettbl_open_signup_pg_deactive_date()) > strtotime(date(DATE_FORMAT))){						$info["isActive"] = 1;					}				}			}		unset($obj_tbl_open_signup_pg);		return $info;		}	}//..End GetInfo	public static function GetFields($data){		global $tbl_open_signup_pg_active_condition;		$arr = array();		if(is_not_empty($data)){			$qry ="SELECT ".$data['key_field'].",".$data['value_field']." FROM ".TBL_OPEN_SIGNUP_PG."";			if(is_gt_zero_num($data['isActive'])){				$qry .= " WHERE ".$tbl_open_signup_pg_active_condition;			}			$res = mysql_query($qry); 			if($res){				while($row=mysql_fetch_assoc($res)){					$arr[$row[$data['key_field']]] = $row[$data['value_field']];				}			}		}		return $arr;	}//.. End of GetFields}//..End tbl_open_signup_pg?>