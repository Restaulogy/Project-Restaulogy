<?php/**********************************************************************tbl_services_details.class.phpGenerated by STRUCTY 2013.03.14 07:51:46.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define("TBL_SERVICES_DETAILS", "tbl_services_details"); define('SRVC_DTL_ID', 'srvc_dtl_id');  define('SRVC_DTL_SERVICE_CODE', 'srvc_dtl_service_code');  define('SRVC_DTL_NAME', 'srvc_dtl_name');  define('SRVC_DTL_DESC', 'srvc_dtl_desc');  define('SRVC_DTL_TYPE', 'srvc_dtl_type');  define('SRVC_DTL_START_DATE', 'srvc_dtl_start_date');  define('SRVC_DTL_END_DATE', 'srvc_dtl_end_date'); define('CHECKBOX_SERVICE_TYPE','CHECKBOX');define('TEXTBOX_SERVICE_TYPE','TEXTBOX');class tbl_services_details {	private $srvc_dtl_id;	private $srvc_dtl_service_code;	private $srvc_dtl_name;	private $srvc_dtl_desc;	private $srvc_dtl_type;	private $srvc_dtl_start_date;	private $srvc_dtl_end_date;	public function setsrvc_dtl_id($pArg="0") {$this->srvc_dtl_id=$pArg;}	public function setsrvc_dtl_service_code($pArg="0") {$this->srvc_dtl_service_code=$pArg;}	public function setsrvc_dtl_name($pArg="0") {$this->srvc_dtl_name=$pArg;}	public function setsrvc_dtl_desc($pArg="0") {$this->srvc_dtl_desc=$pArg;}	public function setsrvc_dtl_type($pArg="0") {$this->srvc_dtl_type=$pArg;}	public function setsrvc_dtl_start_date($pArg="0") {$this->srvc_dtl_start_date=$pArg;}	public function setsrvc_dtl_end_date($pArg="0") {$this->srvc_dtl_end_date=$pArg;}	public function getsrvc_dtl_id() {return $this->srvc_dtl_id;}	public function getsrvc_dtl_service_code() {return $this->srvc_dtl_service_code;}	public function getsrvc_dtl_name() {return $this->srvc_dtl_name;}	public function getsrvc_dtl_desc() {return $this->srvc_dtl_desc;}	public function getsrvc_dtl_type() {return $this->srvc_dtl_type;}	public function getsrvc_dtl_start_date() {return $this->srvc_dtl_start_date;}	public function getsrvc_dtl_end_date() {return $this->srvc_dtl_end_date;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".TBL_SERVICES_DETAILS.RET;		$and = "WHERE".RET;		if($array[SRVC_DTL_ID] != "") {			$qry .= $and.SRVC_DTL_ID." = '".$array[SRVC_DTL_ID]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_SERVICE_CODE] != "") {			$qry .= $and.SRVC_DTL_SERVICE_CODE." = '".$array[SRVC_DTL_SERVICE_CODE]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_NAME] != "") {			$qry .= $and.SRVC_DTL_NAME." = '".$array[SRVC_DTL_NAME]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_DESC] != "") {			$qry .= $and.SRVC_DTL_DESC." = '".$array[SRVC_DTL_DESC]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_TYPE] != "") {			$qry .= $and.SRVC_DTL_TYPE." = '".$array[SRVC_DTL_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_START_DATE] != "") {			$qry .= $and.SRVC_DTL_START_DATE." = '".$array[SRVC_DTL_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_END_DATE] != "") {			$qry .= $and.SRVC_DTL_END_DATE." = '".$array[SRVC_DTL_END_DATE]."'".RET;			$and = "AND".RET;		} 		$result = mysql_query($qry);		//echo "qry=$qry";				if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->setsrvc_dtl_id($record[SRVC_DTL_ID]);				$this->setsrvc_dtl_service_code($record[SRVC_DTL_SERVICE_CODE]);				$this->setsrvc_dtl_name($record[SRVC_DTL_NAME]);				$this->setsrvc_dtl_desc($record[SRVC_DTL_DESC]);				$this->setsrvc_dtl_type($record[SRVC_DTL_TYPE]);				$this->setsrvc_dtl_start_date($record[SRVC_DTL_START_DATE]);				$this->setsrvc_dtl_end_date($record[SRVC_DTL_END_DATE]);				return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1) {	 		$qry = "SELECT *".RET."FROM ".TBL_SERVICES_DETAILS.RET;		$and = "WHERE".RET;		if($array[SRVC_DTL_ID] != "") {			$qry .= $and.SRVC_DTL_ID." = '".$array[SRVC_DTL_ID]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_SERVICE_CODE] != "") {			$qry .= $and.SRVC_DTL_SERVICE_CODE." = '".$array[SRVC_DTL_SERVICE_CODE]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_NAME] != "") {			$qry .= $and.SRVC_DTL_NAME." = '".$array[SRVC_DTL_NAME]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_DESC] != "") {			$qry .= $and.SRVC_DTL_DESC." = '".$array[SRVC_DTL_DESC]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_TYPE] != "") {			$qry .= $and.SRVC_DTL_TYPE." = '".$array[SRVC_DTL_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_START_DATE] != "") {			$qry .= $and.SRVC_DTL_START_DATE." = '".$array[SRVC_DTL_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_END_DATE] != "") {			$qry .= $and.SRVC_DTL_END_DATE." = '".$array[SRVC_DTL_END_DATE]."'".RET;			$and = "AND".RET;		} 				if($array["orderbystr"] != ""){			$qry = $qry." ORDER BY ".$array["orderbystr"];		}else{			$qry = $qry." ORDER BY ".SRVC_DTL_ID." desc";		}						if(is_not_empty($array["offset"]) && is_not_empty($array["limit"])) { 			$qry_with_limit  = $qry." LIMIT ".$array["offset"].",".$array["limit"];		}else{			$qry_with_limit  = $qry;		}				$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		$result_found = mysql_num_rows($r1);		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				if($isArray){					$class_object = array();					$class_object["id"]=$record[SRVC_DTL_ID];					$class_object["service_code"]=$record[SRVC_DTL_SERVICE_CODE];					$class_object["name"]=$record[SRVC_DTL_NAME];					$class_object["desc"]=$record[SRVC_DTL_DESC];					$class_object["type"]=$record[SRVC_DTL_TYPE];					$class_object["typeId"]=tbl_services_details::getServiceTypeID($record[SRVC_DTL_TYPE]);					$class_object["start_date"]=$record[SRVC_DTL_START_DATE];					$class_object["end_date"]=$record[SRVC_DTL_END_DATE];					$class_object["friendly_start_date"] = friendly_time($record[SRVC_DTL_START_DATE],1);				$class_object["friendly_end_date"] = friendly_time($record[SRVC_DTL_END_DATE],1);	 				}else{					$class_object = new tbl_services_details();					$class_object->setsrvc_dtl_id($record[SRVC_DTL_ID]);					$class_object->setsrvc_dtl_service_code($record[SRVC_DTL_SERVICE_CODE]);					$class_object->setsrvc_dtl_name($record[SRVC_DTL_NAME]);					$class_object->setsrvc_dtl_desc($record[SRVC_DTL_DESC]);					$class_object->setsrvc_dtl_type($record[SRVC_DTL_TYPE]);					$class_object->setsrvc_dtl_start_date($record[SRVC_DTL_START_DATE]);					$class_object->setsrvc_dtl_end_date($record[SRVC_DTL_END_DATE]);																			}				$class_objects[$record[SRVC_DTL_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->getsrvc_dtl_id() != '') {			$qry  = "UPDATE ".TBL_SERVICES_DETAILS.RET."SET".RET."			".SRVC_DTL_ID." = '".$this->getsrvc_dtl_id()."',".RET."			".SRVC_DTL_SERVICE_CODE." = '".$this->getsrvc_dtl_service_code()."',".RET."			".SRVC_DTL_NAME." = '".$this->getsrvc_dtl_name()."',".RET."			".SRVC_DTL_DESC." = '".$this->getsrvc_dtl_desc()."',".RET."			".SRVC_DTL_TYPE." = '".$this->getsrvc_dtl_type()."',".RET."			".SRVC_DTL_START_DATE." = '".$this->getsrvc_dtl_start_date()."',".RET."			".SRVC_DTL_END_DATE." = '".$this->getsrvc_dtl_end_date()."'".RET.			"WHERE ".SRVC_DTL_ID." = ".$this->getsrvc_dtl_id().RET;			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_SERVICES_DETAILS." (".RET.			"".SRVC_DTL_SERVICE_CODE.", ".SRVC_DTL_NAME.", ".SRVC_DTL_DESC.", ".SRVC_DTL_TYPE.", ".SRVC_DTL_START_DATE.", ".SRVC_DTL_END_DATE.RET.				") VALUES (".RET.			"'".$this->getsrvc_dtl_service_code()."',".RET.			"'".$this->getsrvc_dtl_name()."',".RET.			"'".$this->getsrvc_dtl_desc()."',".RET.			"'".$this->getsrvc_dtl_type()."',".RET.			"'".$this->getsrvc_dtl_start_date()."',".RET.			"'".$this->getsrvc_dtl_end_date()."'".RET.			")".RET;			$res = mysql_query($qry);			$this->setsrvc_dtl_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_SERVICES_DETAILS.RET;		$and = "WHERE".RET;		if($array[SRVC_DTL_ID] != "") {			$qry .= $and.SRVC_DTL_ID." IN (".$array[SRVC_DTL_ID].")".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_SERVICE_CODE] != "") {			$qry .= $and.SRVC_DTL_SERVICE_CODE." IN (".$array[SRVC_DTL_SERVICE_CODE].") ".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_NAME] != "") {			$qry .= $and.SRVC_DTL_NAME." = '".$array[SRVC_DTL_NAME]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_DESC] != "") {			$qry .= $and.SRVC_DTL_DESC." = '".$array[SRVC_DTL_DESC]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_TYPE] != "") {			$qry .= $and.SRVC_DTL_TYPE." = '".$array[SRVC_DTL_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_START_DATE] != "") {			$qry .= $and.SRVC_DTL_START_DATE." = '".$array[SRVC_DTL_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[SRVC_DTL_END_DATE] != "") {			$qry .= $and.SRVC_DTL_END_DATE." = '".$array[SRVC_DTL_END_DATE]."'".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){ 			return 1;			 		}		return 0;	}//..End Delete		public static function getServiceType($isCheck){		if($isCheck){			return CHECKBOX_SERVICE_TYPE;		}else{			return TEXTBOX_SERVICE_TYPE;		} 	}		public static function getServiceTypeID($type){		 IF($type == CHECKBOX_SERVICE_TYPE){		 	return 1;		 }		 return 0;	}		public function create($service_code,$name,$desc,$isCheck=1){	  if(is_gt_zero_num($service_code) && is_not_empty($name)){				$this->setsrvc_dtl_id("");				$this->setsrvc_dtl_service_code($service_code);				$this->setsrvc_dtl_name($name);				$this->setsrvc_dtl_desc($desc);				$this->setsrvc_dtl_start_date(date("Y-m-d h:i:s"));				$this->setsrvc_dtl_type($this->getServiceType($isCheck));				$this->insert(); 				return OPERATION_SUCCESS;	  }		return OPERATION_FAIL;	}//.. end of create		public function update($service_id,$name,$desc,$isCheck=1){	  if(is_gt_zero_num($service_id)){	  				if($this->readObject(array("srvc_dtl_id"=>$service_id))){				$this->setsrvc_dtl_name($name);				$this->setsrvc_dtl_desc($desc);				$this->setsrvc_dtl_type($this->getServiceType($isCheck));				$this->insert();				return OPERATION_SUCCESS;			}	  		  } 			return OPERATION_FAIL;  	}//.. end of update		public function GetInfo($srvc_dtl_id) {		$info = array();		if($srvc_dtl_id != ""){			if($this->readObject(array("srvc_dtl_id"=>$srvc_dtl_id))){				$info["id"]=$this->getsrvc_dtl_id();				$info["service_code"]=$this->getsrvc_dtl_service_code();				$info["name"]=$this->getsrvc_dtl_name();				$info["desc"]=$this->getsrvc_dtl_desc();				$info["type"]=$this->getsrvc_dtl_type();				$info["typeId"]=$this->getServiceTypeID($this->getsrvc_dtl_type());				$info["start_date"]=$this->getsrvc_dtl_start_date();				$info["end_date"]=$this->getsrvc_dtl_end_date();				$info["friendly_start_date"] = friendly_time($this->getsrvc_dtl_start_date(),1);				$info["friendly_end_date"] = friendly_time($this->getsrvc_dtl_end_date(),1);	 			}		return $info;		}	}//..End GetInfo}//..End tbl_services_details?>