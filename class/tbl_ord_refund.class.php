<?php/**********************************************************************tbl_ord_refund.class.phpGenerated by STRUCTY 2013.11.09 06:44:08.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define("TBL_ORD_REFUND", "tbl_ord_refund"); define('REFUND_ID', 'refund_id'); define('REFUND_PAYPAL_TXN_ID', 'refund_paypal_txn_id'); define('REFUND_NOTE', 'refund_note'); define('REFUND_AMNT', 'refund_amnt'); define('REFUND_START_DATE', 'refund_start_date'); define('REFUND_END_DATE', 'refund_end_date'); define("TBL_ORD_REFUND_ACTIVE_DATE",  REFUND_START_DATE);define("TBL_ORD_REFUND_DEACTIVE_DATE",  REFUND_END_DATE);$tbl_ord_refund_active_condition= " (".TBL_ORD_REFUND_DEACTIVE_DATE." is NULL OR ".TBL_ORD_REFUND_DEACTIVE_DATE." = 0 OR ".TBL_ORD_REFUND_DEACTIVE_DATE." > CURDATE( )) ";class tbl_ord_refund {	private $refund_id;	private $refund_paypal_txn_id;	private $refund_note;	private $refund_amnt;	private $refund_start_date;	private $refund_end_date;	private $tbl_ord_refund_active_date;	private $tbl_ord_refund_deactive_date;	public function setrefund_id($pArg="0") {$this->refund_id=$pArg;}	public function setrefund_paypal_txn_id($pArg="0") {$this->refund_paypal_txn_id=$pArg;}	public function setrefund_note($pArg="0") {$this->refund_note=$pArg;}	public function setrefund_amnt($pArg="0") {$this->refund_amnt=$pArg;}	public function setrefund_start_date($pArg="0") {$this->refund_start_date=$pArg;}	public function setrefund_end_date($pArg="0") {$this->refund_end_date=$pArg;}	public function settbl_ord_refund_active_date($pArg="0") {$this->tbl_ord_refund_active_date=$pArg;}	public function settbl_ord_refund_deactive_date($pArg="0") {$this->tbl_ord_refund_deactive_date=$pArg;}	public function getrefund_id() {return $this->refund_id;}	public function getrefund_paypal_txn_id() {return $this->refund_paypal_txn_id;}	public function getrefund_note() {return $this->refund_note;}	public function getrefund_amnt() {return $this->refund_amnt;}	public function getrefund_start_date() {return $this->refund_start_date;}	public function getrefund_end_date() {return $this->refund_end_date;}	public function gettbl_ord_refund_active_date($pArg="0") {return $this->tbl_ord_refund_active_date;}	public function gettbl_ord_refund_deactive_date($pArg="0") {return $this->tbl_ord_refund_deactive_date;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".TBL_ORD_REFUND.RET;		$and = "WHERE".RET;		if($array[REFUND_ID] != "") {			$qry .= $and.REFUND_ID." = '".$array[REFUND_ID]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_PAYPAL_TXN_ID] != "") {			$qry .= $and.REFUND_PAYPAL_TXN_ID." = '".$array[REFUND_PAYPAL_TXN_ID]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_NOTE] != "") {			$qry .= $and.REFUND_NOTE." = '".$array[REFUND_NOTE]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_AMNT] != "") {			$qry .= $and.REFUND_AMNT." = '".$array[REFUND_AMNT]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_START_DATE] != "") {			$qry .= $and.REFUND_START_DATE." = '".$array[REFUND_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_END_DATE] != "") {			$qry .= $and.REFUND_END_DATE." = '".$array[REFUND_END_DATE]."'".RET;			$and = "AND".RET;		}	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->setrefund_id($record[REFUND_ID]);				$this->setrefund_paypal_txn_id($record[REFUND_PAYPAL_TXN_ID]);				$this->setrefund_note($record[REFUND_NOTE]);				$this->setrefund_amnt($record[REFUND_AMNT]);				$this->setrefund_start_date($record[REFUND_START_DATE]);				$this->setrefund_end_date($record[REFUND_END_DATE]);				$this->settbl_ord_refund_active_date($record[TBL_ORD_REFUND_ACTIVE_DATE]);				$this->settbl_ord_refund_deactive_date($record[TBL_ORD_REFUND_DEACTIVE_DATE]);				return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1) {		global $tbl_ord_refund_active_condition;		$qry = "SELECT *".RET."FROM ".TBL_ORD_REFUND.RET;		$and = "WHERE".RET;		if($array[REFUND_ID] != "") {			$qry .= $and.REFUND_ID." = '".$array[REFUND_ID]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_PAYPAL_TXN_ID] != "") {			$qry .= $and.REFUND_PAYPAL_TXN_ID." = '".$array[REFUND_PAYPAL_TXN_ID]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_NOTE] != "") {			$qry .= $and.REFUND_NOTE." = '".$array[REFUND_NOTE]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_AMNT] != "") {			$qry .= $and.REFUND_AMNT." = '".$array[REFUND_AMNT]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_START_DATE] != "") {			$qry .= $and.REFUND_START_DATE." = '".$array[REFUND_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_END_DATE] != "") {			$qry .= $and.REFUND_END_DATE." = '".$array[REFUND_END_DATE]."'".RET;			$and = "AND".RET;		}		if(is_gt_zero_num($array["isActive"])) {			$qry .= $and.$tbl_ord_refund_active_condition;;			$and = "AND".RET;		}		if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {		$qry .=" ORDER BY ".$array[SORT_ON]." ".$array[SORT_BY];		}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry." LIMIT ".$array[OFFSET_TITLE].",".$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		}		$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		if($r1){			$result_found = mysql_num_rows($r1);		}		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_ORD_REFUND_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_ORD_REFUND_DEACTIVE_DATE]))== false)){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_ORD_REFUND_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}				if($isArray){					$class_object = array();					$class_object["refund_id"]=$record[REFUND_ID];					$class_object["refund_paypal_txn_id"]=$record[REFUND_PAYPAL_TXN_ID];					$class_object["refund_note"]=$record[REFUND_NOTE];					$class_object["refund_amnt"]=$record[REFUND_AMNT];					$class_object["refund_start_date"]=$record[REFUND_START_DATE];					$class_object["refund_end_date"]=$record[REFUND_END_DATE];					$class_object["isActive"]=$isActive;				}else{					$class_object = new tbl_ord_refund();					$class_object->setrefund_id($record[REFUND_ID]);					$class_object->setrefund_paypal_txn_id($record[REFUND_PAYPAL_TXN_ID]);					$class_object->setrefund_note($record[REFUND_NOTE]);					$class_object->setrefund_amnt($record[REFUND_AMNT]);					$class_object->setrefund_start_date($record[REFUND_START_DATE]);					$class_object->setrefund_end_date($record[REFUND_END_DATE]);				}				$class_objects[$record[REFUND_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->getrefund_id() != '') {			$qry  = "UPDATE ".TBL_ORD_REFUND.RET."SET".RET."			".REFUND_ID." = '".$this->getrefund_id()."',".RET."			".REFUND_PAYPAL_TXN_ID." = '".$this->getrefund_paypal_txn_id()."',".RET."			".REFUND_NOTE." = '".$this->getrefund_note()."',".RET."			".REFUND_AMNT." = '".$this->getrefund_amnt()."',".RET."			".REFUND_START_DATE." = '".$this->getrefund_start_date()."',".RET."			".REFUND_END_DATE." = '".$this->getrefund_end_date()."'".RET.			"WHERE ".REFUND_ID." = ".$this->getrefund_id().RET;			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_ORD_REFUND." (".RET.			"".REFUND_PAYPAL_TXN_ID.", ".REFUND_NOTE.", ".REFUND_AMNT.", ".REFUND_START_DATE.", ".REFUND_END_DATE.RET.				") VALUES (".RET.			"'".$this->getrefund_paypal_txn_id()."',".RET.			"'".$this->getrefund_note()."',".RET.			"'".$this->getrefund_amnt()."',".RET.			"'".$this->getrefund_start_date()."',".RET.			"'".$this->getrefund_end_date()."'".RET.			")".RET;			$res = mysql_query($qry);			$this->setrefund_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_ORD_REFUND.RET;		$and = "WHERE".RET;		if($array[REFUND_ID] != "") {			$qry .= $and.REFUND_ID." = '".$array[REFUND_ID]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_PAYPAL_TXN_ID] != "") {			$qry .= $and.REFUND_PAYPAL_TXN_ID." = '".$array[REFUND_PAYPAL_TXN_ID]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_NOTE] != "") {			$qry .= $and.REFUND_NOTE." = '".$array[REFUND_NOTE]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_AMNT] != "") {			$qry .= $and.REFUND_AMNT." = '".$array[REFUND_AMNT]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_START_DATE] != "") {			$qry .= $and.REFUND_START_DATE." = '".$array[REFUND_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[REFUND_END_DATE] != "") {			$qry .= $and.REFUND_END_DATE." = '".$array[REFUND_END_DATE]."'".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($refund_paypal_txn_id ,$refund_note ,$refund_amnt) {		$unique_arr = array();			//$unique_arr[REFUND_ID]=$refund_id;			//$unique_arr[REFUND_PAYPAL_TXN_ID]=$refund_paypal_txn_id;			//$unique_arr[REFUND_NOTE]=$refund_note;			//$unique_arr[REFUND_AMNT]=$refund_amnt;			//$unique_arr[REFUND_START_DATE]=$refund_start_date;			//$unique_arr[REFUND_END_DATE]=$refund_end_date;		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($refund_paypal_txn_id ,$refund_note ,$refund_amnt) {		if(is_not_empty($refund_paypal_txn_id)){			if($this->isAlreadyThere($refund_paypal_txn_id ,$refund_note ,$refund_amnt)){				return OPERATION_DUPLICATE;			}else{				$this->setrefund_id("");				$this->setrefund_paypal_txn_id($refund_paypal_txn_id);				$this->setrefund_note($refund_note);				$this->setrefund_amnt($refund_amnt);				$this->setrefund_start_date(date(DATE_FORMAT));				$this->insert();				$isPaid = 0;				self::getTotalRefundByTransId($refund_paypal_txn_id,$isPaid);				if(is_gt_zero_num($isPaid)){					 $objTran = new tbl_ord_paypal_trans();					 if($objTran->readObject(array(PAYPAL_ID=>$refund_paypal_txn_id))){					 	 $objTran->setpaypal_refund_complete(1);						 $objTran->insert();					 }					 unset($objTran);				}				return $this->getrefund_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($refund_id, $refund_paypal_txn_id, $refund_note, $refund_amnt) {		if(is_gt_zero_num($refund_id)){			if ($this->readObject(array(REFUND_ID=>$refund_id))){				$this->setrefund_paypal_txn_id($refund_paypal_txn_id);				$this->setrefund_note($refund_note);				$this->setrefund_amnt($refund_amnt);				$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update	public function activate($refund_id){		if(is_gt_zero_num($refund_id)){			if ($this->readObject(array(REFUND_ID=>$refund_id))){				$qry  = "UPDATE ".TBL_ORD_REFUND.RET."SET".RET."			".TBL_ORD_REFUND_DEACTIVE_DATE." = '".date(EMPTY_DATE_FORMAT)."' WHERE ".REFUND_ID."={$refund_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end activate	public function deactivate($refund_id){		if(is_gt_zero_num($refund_id)){			if ($this->readObject(array(REFUND_ID=>$refund_id))){				$qry  = "UPDATE ".TBL_ORD_REFUND.RET."SET".RET."			".TBL_ORD_REFUND_DEACTIVE_DATE." = '".date(DATE_FORMAT)."' WHERE ".REFUND_ID."={$refund_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end deactivate		public static function getTotalRefundByTransId($trans_id,&$isTotalPaid=0){		$sum_amt = 0;		if(is_gt_zero_num($trans_id)){			$res = mysql_query('SELECT SUM('.REFUND_AMNT.') `sum_amt`,'.PAYPAL_TXN_AMNT.' FROM '.TBL_ORD_REFUND.' INNER JOIN '.TBL_ORD_PAYPAL_TRANS.' ON '.REFUND_PAYPAL_TXN_ID.'='.PAYPAL_ID.' WHERE '.PAYPAL_ID.'='.$trans_id);			if($res && is_gt_zero_num(mysql_num_rows($res))){				 $sum_amt = mysql_result($res,0,'sum_amt');				 $total = mysql_result($res,0,PAYPAL_TXN_AMNT);				 if($sum_amt == $total){				 	$isTotalPaid = 1;				 }			}					}		 return $sum;	}		public static function GetInfo($refund_id) {		$info = array();		if($refund_id != ""){			$obj_tbl_ord_refund = new tbl_ord_refund();			if($obj_tbl_ord_refund->readObject(array("refund_id"=>$refund_id))){				$info["refund_id"]=$obj_tbl_ord_refund->getrefund_id();				$info["refund_paypal_txn_id"]=$obj_tbl_ord_refund->getrefund_paypal_txn_id();				$info["refund_note"]=$obj_tbl_ord_refund->getrefund_note();				$info["refund_amnt"]=$obj_tbl_ord_refund->getrefund_amnt();				$info["refund_start_date"]=$obj_tbl_ord_refund->getrefund_start_date();				$info["refund_end_date"]=$obj_tbl_ord_refund->getrefund_end_date();				$info["isActive"] = 0;				//..check deactive date is not set or 0				if((is_not_empty($obj_tbl_ord_refund->gettbl_ord_refund_deactive_date())==false)  || (is_gt_zero_num(strtotime($obj_tbl_ord_refund->gettbl_ord_refund_deactive_date()))== false)){					$info["isActive"] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($obj_tbl_ord_refund->gettbl_ord_refund_deactive_date()) > strtotime(date(DATE_FORMAT))){						$info["isActive"] = 1;					}				}			}		unset($obj_tbl_ord_refund);		return $info;		}	}//..End GetInfo	public static function GetFields($data){		global $tbl_ord_refund_active_condition;		$arr = array();		if(is_not_empty($data)){			$qry ="SELECT ".$data['key_field'].",".$data['value_field']." FROM ".TBL_ORD_REFUND."";			if(is_gt_zero_num($data['isActive'])){				$qry .= " WHERE ".$tbl_ord_refund_active_condition;			}			$res = mysql_query($qry); 			if($res){				while($row=mysql_fetch_assoc($res)){					$arr[$row[$data['key_field']]] = $row[$data['value_field']];				}			}		}		return $arr;	}//.. End of GetFields}//..End tbl_ord_refund?>