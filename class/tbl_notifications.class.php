<?php/**********************************************************************tbl_notifications.class.phpGenerated by STRUCTY 2013.10.23 11:47:06.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define("TBL_NOTIFICATIONS", "tbl_notifications"); define('NOTIFY_ID', 'notify_id'); define('NOTIFY_NAME', 'notify_name'); define('NOTIFY_MESSAGE', 'notify_message'); define('NOTIFY_STATUS', 'notify_status'); define('NOTIFY_TO_ROLE', 'notify_to_role'); define('NOTIFY_IS_URGENT', 'notify_is_urgent'); define('NOTIFY_IS_DELAYED', 'notify_is_delayed'); define('NOTIFY_RESTAURENT', 'notify_restaurent');define('NOTIFY_GROUP', 'notify_group');  define('NOTIFY_TYPE', 'notify_type');  define('NOTIFY_START_DATE', 'notify_start_date'); define('NOTIFY_END_DATE', 'notify_end_date'); define("TBL_NOTIFICATIONS_ACTIVE_DATE",  NOTIFY_START_DATE);define("TBL_NOTIFICATIONS_DEACTIVE_DATE",  NOTIFY_END_DATE);$tbl_notifications_active_condition= " (".TBL_NOTIFICATIONS_DEACTIVE_DATE." is NULL OR ".TBL_NOTIFICATIONS_DEACTIVE_DATE." = 0 OR ".TBL_NOTIFICATIONS_DEACTIVE_DATE." > CURDATE( )) ";class tbl_notifications {	private $notify_id;	private $notify_name;	private $notify_message;	private $notify_status;	private $notify_to_role;	private $notify_is_urgent;	private $notify_is_delayed;	private $notify_type;	private $notify_group;	private $notify_restaurent;	private $notify_start_date;	private $notify_end_date;	private $tbl_notifications_active_date;	private $tbl_notifications_deactive_date;	public function setnotify_id($pArg="0") {$this->notify_id=$pArg;}	public function setnotify_name($pArg="0") {$this->notify_name=$pArg;}	public function setnotify_message($pArg="0") {$this->notify_message=$pArg;}	public function setnotify_status($pArg="0") {$this->notify_status=$pArg;}	public function setnotify_to_role($pArg="0") {$this->notify_to_role=$pArg;}	public function setnotify_is_urgent($pArg="0") {$this->notify_is_urgent=$pArg;}	public function setnotify_is_delayed($pArg="0") {$this->notify_is_delayed=$pArg;}	public function setnotify_type($pArg="0") {$this->notify_type=$pArg;}	public function setnotify_group($pArg="0") {$this->notify_group=$pArg;}	public function setnotify_restaurent($pArg="0") {$this->notify_restaurent=$pArg;}	public function setnotify_start_date($pArg="0") {$this->notify_start_date=$pArg;}	public function setnotify_end_date($pArg="0") {$this->notify_end_date=$pArg;}	public function settbl_notifications_active_date($pArg="0") {$this->tbl_notifications_active_date=$pArg;}	public function settbl_notifications_deactive_date($pArg="0") {$this->tbl_notifications_deactive_date=$pArg;}	public function getnotify_id() {return $this->notify_id;}	public function getnotify_name() {return $this->notify_name;}	public function getnotify_message() {return $this->notify_message;}	public function getnotify_status() {return $this->notify_status;}	public function getnotify_to_role() {return $this->notify_to_role;}	public function getnotify_is_urgent() {return $this->notify_is_urgent;}	public function getnotify_is_delayed() {return $this->notify_is_delayed;}	public function getnotify_type() {return $this->notify_type;}	public function getnotify_group() {return $this->notify_group;}	public function getnotify_restaurent() {return $this->notify_restaurent;}	public function getnotify_start_date() {return $this->notify_start_date;}	public function getnotify_end_date() {return $this->notify_end_date;}	public function gettbl_notifications_active_date($pArg="0") {return $this->tbl_notifications_active_date;}	public function gettbl_notifications_deactive_date($pArg="0") {return $this->tbl_notifications_deactive_date;}	public function readObject($array = array()) {		$qry = "SELECT ".TBL_NOTIFICATIONS.".*, `member_role_name` ".RET.					 "FROM ".TBL_NOTIFICATIONS." INNER JOIN `member_role` ON ".					 NOTIFY_TO_ROLE."=`member_role_id` INNER JOIN ".TBL_STATUSES." ON ".					 NOTIFY_STATUS."=".STATUS_ID."".RET;					 		$and = "WHERE".RET; 		if($array[NOTIFY_ID] != "") {			$qry .= $and.NOTIFY_ID." = '".$array[NOTIFY_ID]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_NAME] != "") {			$qry .= $and.NOTIFY_NAME." = '".$array[NOTIFY_NAME]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_MESSAGE] != "") {			$qry .= $and.NOTIFY_MESSAGE." = '".$array[NOTIFY_MESSAGE]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_STATUS] != "") {			$qry .= $and.NOTIFY_STATUS." = '".$array[NOTIFY_STATUS]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_TO_ROLE] != "") {			$qry .= $and.NOTIFY_TO_ROLE." = '".$array[NOTIFY_TO_ROLE]."'".RET;			$and = "AND".RET;		}				if(is_not_empty($array[STATUS_HIDDEN])) {			$qry .= $and.STATUS_HIDDEN." = '".$array[STATUS_HIDDEN]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_IS_URGENT] != "") {			$qry .= $and.NOTIFY_IS_URGENT." = '".$array[NOTIFY_IS_URGENT]."'".RET;			$and = "AND".RET;		}		if(is_not_empty($array[NOTIFY_IS_DELAYED])) {			$qry .= $and.NOTIFY_IS_DELAYED." = '".$array[NOTIFY_IS_DELAYED]."'".RET; 			$and = "AND".RET;		}				if($array[NOTIFY_TYPE] != "") {			$qry .= $and.NOTIFY_TYPE." = '".$array[NOTIFY_TYPE]."'".RET;			$and = "AND".RET;		}				if($array[NOTIFY_GROUP] != "") {			$qry .= $and.NOTIFY_GROUP." = '".$array[NOTIFY_GROUP]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_RESTAURENT] != "") {			$qry .= $and.NOTIFY_RESTAURENT." = '".$array[NOTIFY_RESTAURENT]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_START_DATE] != "") {			$qry .= $and.NOTIFY_START_DATE." = '".$array[NOTIFY_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_END_DATE] != "") {			$qry .= $and.NOTIFY_END_DATE." = '".$array[NOTIFY_END_DATE]."'".RET;			$and = "AND".RET;		}	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			 			if(count($record[0]) == 0) {				return array();			} else {				$this->setnotify_id($record[NOTIFY_ID]);				$this->setnotify_name($record[NOTIFY_NAME]);				$this->setnotify_message($record[NOTIFY_MESSAGE]);				$this->setnotify_status($record[NOTIFY_STATUS]);				$this->setnotify_to_role($record[NOTIFY_TO_ROLE]);				$this->setnotify_is_urgent($record[NOTIFY_IS_URGENT]);				$this->setnotify_is_delayed($record[NOTIFY_IS_DELAYED]);				$this->setnotify_type($record[NOTIFY_TYPE]);				$this->setnotify_group($record[NOTIFY_GROUP]);				$this->setnotify_restaurent($record[NOTIFY_RESTAURENT]);				$this->setnotify_start_date($record[NOTIFY_START_DATE]);				$this->setnotify_end_date($record[NOTIFY_END_DATE]);				$this->settbl_notifications_active_date($record[TBL_NOTIFICATIONS_ACTIVE_DATE]);				$this->settbl_notifications_deactive_date($record[TBL_NOTIFICATIONS_DEACTIVE_DATE]);				return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1) {		global $tbl_notifications_active_condition;		$qry = "SELECT ".TBL_NOTIFICATIONS.".*, `member_role_name`,`".STATUS_NAME."`, `".STATUS_EVENT."` ".RET."FROM ".TBL_NOTIFICATIONS." INNER JOIN `member_role` ON  ".NOTIFY_TO_ROLE."=`member_role_id` INNER JOIN ".TBL_STATUSES." ON  ".NOTIFY_STATUS."=".STATUS_ID."".RET;		 		$and = "WHERE".RET;		if($array[NOTIFY_ID] != "") {			$qry .= $and.NOTIFY_ID." = '".$array[NOTIFY_ID]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_NAME] != "") {			$qry .= $and.NOTIFY_NAME." = '".$array[NOTIFY_NAME]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_MESSAGE] != "") {			$qry .= $and.NOTIFY_MESSAGE." = '".$array[NOTIFY_MESSAGE]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_STATUS] != "") {			$qry .= $and.NOTIFY_STATUS." = '".$array[NOTIFY_STATUS]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_TO_ROLE] != "") {			$qry .= $and.NOTIFY_TO_ROLE." = '".$array[NOTIFY_TO_ROLE]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_IS_URGENT] != "") {			$qry .= $and.NOTIFY_IS_URGENT." = '".$array[NOTIFY_IS_URGENT]."'".RET;			$and = "AND".RET;		}		if(is_not_empty($array[NOTIFY_IS_DELAYED])) {			$qry .= $and.NOTIFY_IS_DELAYED." = '".$array[NOTIFY_IS_DELAYED]."'".RET; 			$and = "AND".RET;		}				if($array[NOTIFY_TYPE] != "") {			$qry .= $and.NOTIFY_TYPE." = '".$array[NOTIFY_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_RESTAURENT] != "") {			$qry .= $and.NOTIFY_RESTAURENT." = '".$array[NOTIFY_RESTAURENT]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_START_DATE] != "") {			$qry .= $and.NOTIFY_START_DATE." = '".$array[NOTIFY_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_END_DATE] != "") {			$qry .= $and.NOTIFY_END_DATE." = '".$array[NOTIFY_END_DATE]."'".RET;			$and = "AND".RET;		}		if(is_gt_zero_num($array["isActive"])) {			$qry .= $and.$tbl_notifications_active_condition;;			$and = "AND".RET;		}		if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {				$qry .=" ORDER BY ".$array[SORT_ON]." ".$array[SORT_BY];		}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry." LIMIT ".$array[OFFSET_TITLE].",".$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		}		//echo "$qry_with_limit";		//exit;		$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		if($r1){			$result_found = mysql_num_rows($r1);		}		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_NOTIFICATIONS_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_NOTIFICATIONS_DEACTIVE_DATE]))== false)){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_NOTIFICATIONS_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}				if($isArray){					$class_object = array();					$class_object["notify_id"]=$record[NOTIFY_ID];					$class_object["notify_name"]=$record[NOTIFY_NAME];					$class_object["notify_message"]=$record[NOTIFY_MESSAGE];					$class_object["notify_status"]=$record[NOTIFY_STATUS];					$class_object["notify_to_role"]=$record[NOTIFY_TO_ROLE];					$class_object["notify_is_urgent"]=$record[NOTIFY_IS_URGENT];					$class_object["notify_is_delayed"]=$record[NOTIFY_IS_DELAYED];					$class_object["notify_type"]=$record[NOTIFY_TYPE];					$class_object["notify_group"]=$record[NOTIFY_GROUP];					$class_object["notify_restaurent"]=$record[NOTIFY_RESTAURENT];					$class_object["notify_start_date"]=$record[NOTIFY_START_DATE];					$class_object["notify_end_date"]=$record[NOTIFY_END_DATE];					$class_object['member_role_name']= $record['member_role_name'];					$class_object[STATUS_EVENT] = $record[STATUS_EVENT];					$class_object[STATUS_NAME] = $record[STATUS_NAME];					$class_object["isActive"]=$isActive;				}else{					$class_object = new tbl_notifications();					$class_object->setnotify_id($record[NOTIFY_ID]);					$class_object->setnotify_name($record[NOTIFY_NAME]);					$class_object->setnotify_message($record[NOTIFY_MESSAGE]);					$class_object->setnotify_status($record[NOTIFY_STATUS]);					$class_object->setnotify_to_role($record[NOTIFY_TO_ROLE]);					$class_object->setnotify_is_urgent($record[NOTIFY_IS_URGENT]);					$class_object->setnotify_is_delayed($record[NOTIFY_IS_DELAYED]);					$class_object->setnotify_type($record[NOTIFY_TYPE]);					$class_object->setnotify_restaurent($record[NOTIFY_RESTAURENT]);					$class_object->setnotify_start_date($record[NOTIFY_START_DATE]);					$class_object->setnotify_end_date($record[NOTIFY_END_DATE]);				}				$class_objects[$record[NOTIFY_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->getnotify_id() != '') {			$qry  = "UPDATE ".TBL_NOTIFICATIONS.RET."SET".RET."			".NOTIFY_ID." = '".$this->getnotify_id()."',".RET."			".NOTIFY_NAME." = '".$this->getnotify_name()."',".RET."			".NOTIFY_MESSAGE." = '".$this->getnotify_message()."',".RET."			".NOTIFY_STATUS." = '".$this->getnotify_status()."',".RET."			".NOTIFY_TO_ROLE." = '".$this->getnotify_to_role()."',".RET."			".NOTIFY_TYPE." = '".$this->getnotify_type()."',".RET."			".NOTIFY_GROUP." = '".$this->getnotify_group()."',".RET."			".NOTIFY_IS_URGENT." = '".$this->getnotify_is_urgent()."',".RET."			".NOTIFY_IS_DELAYED." = '".$this->getnotify_is_delayed()."',".RET."						".NOTIFY_START_DATE." = '".$this->getnotify_start_date()."',".RET."			".NOTIFY_END_DATE." = '".$this->getnotify_end_date()."'".RET.			"WHERE ".NOTIFY_ID." = ".$this->getnotify_id().RET;						//".NOTIFY_RESTAURENT." = '".$this->getnotify_restaurent()."',".RET."			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_NOTIFICATIONS." (".RET.			"".NOTIFY_NAME.", ".NOTIFY_MESSAGE.", ".NOTIFY_STATUS.", ".NOTIFY_TO_ROLE.", ".NOTIFY_IS_URGENT.", ".NOTIFY_IS_DELAYED.",".NOTIFY_TYPE.", ".NOTIFY_GROUP.", ".NOTIFY_RESTAURENT.", ".NOTIFY_START_DATE.", ".NOTIFY_END_DATE.RET.				") VALUES (".RET.			"'".$this->getnotify_name()."',".RET.			"'".$this->getnotify_message()."',".RET.			"'".$this->getnotify_status()."',".RET.			"'".$this->getnotify_to_role()."',".RET.			"'".$this->getnotify_is_urgent()."',".RET.			"'".$this->getnotify_is_delayed()."',".RET.			"'".$this->getnotify_group()."',".RET.			"'".$this->getnotify_type()."',".RET.			"'".$_SESSION[SES_RESTAURANT]."',".RET.			"'".$this->getnotify_start_date()."',".RET.			"'".$this->getnotify_end_date()."'".RET.			")".RET;			$res = mysql_query($qry);			$this->setnotify_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_NOTIFICATIONS.RET;		$and = "WHERE".RET;		if($array[NOTIFY_ID] != "") {			//$qry .= $and.NOTIFY_ID." = '".$array[NOTIFY_ID]."'".RET;			$qry .= $and.NOTIFY_ID." IN (".$array[NOTIFY_ID].")".RET;			$and = "AND".RET;		}		if($array[NOTIFY_NAME] != "") {			$qry .= $and.NOTIFY_NAME." = '".$array[NOTIFY_NAME]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_MESSAGE] != "") {			$qry .= $and.NOTIFY_MESSAGE." = '".$array[NOTIFY_MESSAGE]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_STATUS] != "") {			$qry .= $and.NOTIFY_STATUS." = '".$array[NOTIFY_STATUS]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_TO_ROLE] != "") {			$qry .= $and.NOTIFY_TO_ROLE." = '".$array[NOTIFY_TO_ROLE]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_IS_URGENT] != "") {			$qry .= $and.NOTIFY_IS_URGENT." = '".$array[NOTIFY_IS_URGENT]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_IS_DELAYED] != "") {			$qry .= $and.NOTIFY_IS_DELAYED." = '".$array[NOTIFY_IS_DELAYED]."'".RET;			$and = "AND".RET;		}				if($array[NOTIFY_TYPE] != "") {			$qry .= $and.NOTIFY_TYPE." = '".$array[NOTIFY_TYPE]."'".RET;			$and = "AND".RET;		}				if($array[NOTIFY_GROUP] != "") {			$qry .= $and.NOTIFY_GROUP." = '".$array[NOTIFY_GROUP]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_RESTAURENT] != "") {			$qry .= $and.NOTIFY_RESTAURENT." = '".$array[NOTIFY_RESTAURENT]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_START_DATE] != "") {			$qry .= $and.NOTIFY_START_DATE." = '".$array[NOTIFY_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[NOTIFY_END_DATE] != "") {			$qry .= $and.NOTIFY_END_DATE." = '".$array[NOTIFY_END_DATE]."'".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($notify_name ,$notify_message ,$notify_status ,$notify_to_role ,$notify_is_urgent ,$notify_is_delayed ,$notify_type) {		$unique_arr = array();			//$unique_arr[NOTIFY_ID]=$notify_id;			//$unique_arr[NOTIFY_NAME]=$notify_name;			//$unique_arr[NOTIFY_MESSAGE]=$notify_message;			//$unique_arr[NOTIFY_STATUS]=$notify_status;			//$unique_arr[NOTIFY_TO_ROLE]=$notify_to_role;			//$unique_arr[NOTIFY_IS_URGENT]=$notify_is_urgent;			//$unique_arr[NOTIFY_IS_DELAYED]=$notify_is_delayed;			//$unique_arr[NOTIFY_RESTAURENT]=$_SESSION[SES_RESTAURANT];			//$unique_arr[NOTIFY_START_DATE]=$notify_start_date;			//$unique_arr[NOTIFY_END_DATE]=$notify_end_date;		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($notify_name ,$notify_message ,$notify_status ,$notify_to_role ,$notify_is_urgent ,$notify_is_delayed ,$notify_type='ALERT',$notify_group=0) {		if(is_not_empty($notify_name)){			if($this->isAlreadyThere($notify_name ,$notify_message ,$notify_status ,$notify_to_role ,$notify_is_urgent ,$notify_is_delayed ,$notify_type)){				return OPERATION_DUPLICATE;			}else{				$this->setnotify_id("");				$this->setnotify_name($notify_name);				$this->setnotify_message($notify_message);				$this->setnotify_status($notify_status);				$this->setnotify_to_role($notify_to_role);				$this->setnotify_is_urgent($notify_is_urgent);				$this->setnotify_is_delayed($notify_is_delayed);				$this->setnotify_type($notify_type);				$this->setnotify_group($notify_group);				//$this->setnotify_restaurent($notify_restaurent);				$this->setnotify_restaurent($_SESSION[SES_RESTAURANT]);								$this->setnotify_start_date(date(DATE_FORMAT));				$this->insert();				return $this->getnotify_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($notify_id,$notify_name ,$notify_message ,$notify_status ,$notify_to_role ,$notify_is_urgent ,$notify_is_delayed ,$notify_type) {		if(is_gt_zero_num($notify_id)){			if ($this->readObject(array(NOTIFY_ID=>$notify_id))){				$this->setnotify_name($notify_name);				$this->setnotify_message($notify_message);				$this->setnotify_status($notify_status);				$this->setnotify_to_role($notify_to_role);				$this->setnotify_is_urgent($notify_is_urgent);				$this->setnotify_is_delayed($notify_is_delayed); 				$this->setnotify_type($notify_type);				$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update	public function activate($notify_id){		if(is_not_empty($notify_id)){			//if ($this->readObject(array(NOTIFY_ID=>$notify_id))){				$qry  = "UPDATE ".TBL_NOTIFICATIONS.RET."SET".RET."			".TBL_NOTIFICATIONS_DEACTIVE_DATE." = '".date(EMPTY_DATE_FORMAT)."' WHERE ".NOTIFY_ID." IN ({$notify_id})";				$res = mysql_query($qry);				if($res){					return 1;				}			//}		}		return 0;	}//..end activate	public function deactivate($notify_id){		if(is_not_empty($notify_id)){			//if ($this->readObject(array(NOTIFY_ID=>$notify_id))){				$qry  = "UPDATE ".TBL_NOTIFICATIONS.RET."SET".RET."			".TBL_NOTIFICATIONS_DEACTIVE_DATE." = '".date(DATE_FORMAT)."' WHERE ".NOTIFY_ID." IN ({$notify_id})";				$res = mysql_query($qry);				if($res){					return 1;				}			//}		}		return 0;	}//..end deactivate	public static function GetInfo($notify_id) {		$info = array();		if($notify_id != ""){			$obj_tbl_notifications = new tbl_notifications();			if($obj_tbl_notifications->readObject(array("notify_id"=>$notify_id))){				$info["notify_id"]=$obj_tbl_notifications->getnotify_id();				$info["notify_name"]=$obj_tbl_notifications->getnotify_name();				$info["notify_message"]=$obj_tbl_notifications->getnotify_message();				$info["notify_status"]=$obj_tbl_notifications->getnotify_status();				$info["notify_to_role"]=$obj_tbl_notifications->getnotify_to_role();				$info["notify_is_urgent"]=$obj_tbl_notifications->getnotify_is_urgent();				$info["notify_is_delayed"]=$obj_tbl_notifications->getnotify_is_delayed();				$info["notify_type"]=$obj_tbl_notifications->getnotify_type();				$info["notify_restaurent"]=$obj_tbl_notifications->getnotify_restaurent();				$info["notify_start_date"]=$obj_tbl_notifications->getnotify_start_date();				$info["notify_end_date"]=$obj_tbl_notifications->getnotify_end_date();				$info["isActive"] = 0;				//..check deactive date is not set or 0				if((is_not_empty($obj_tbl_notifications->gettbl_notifications_deactive_date())==false)  || (is_gt_zero_num(strtotime($obj_tbl_notifications->gettbl_notifications_deactive_date()))== false)){					$info["isActive"] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($obj_tbl_notifications->gettbl_notifications_deactive_date()) > strtotime(date(DATE_FORMAT))){						$info["isActive"] = 1;					}				}			}		 		unset($obj_tbl_notifications);		return $info;		}	}//..End GetInfo  	public static function GetFields($data){		global $tbl_notifications_active_condition;		$arr = array();		if(is_not_empty($data)){			$qry ="SELECT ".$data['key_field'].",".$data['value_field']." FROM ".TBL_NOTIFICATIONS."";			if(is_gt_zero_num($data['isActive'])){				$qry .= " WHERE ".$tbl_notifications_active_condition;			}			$res = mysql_query($qry); 			if($res){				while($row=mysql_fetch_assoc($res)){					$arr[$row[$data['key_field']]] = $row[$data['value_field']];				}			}		}		return $arr;	}//.. End of GetFields		/**	* Transfer notification to source status to desired status	* @param integer $source_status	* @param integer $desired_status	* 	*/	public static function transferNotification($source_status,$desired_status){		if(is_gt_zero_num($source_status) && is_gt_zero_num($desired_status)){			return DB::ExecNonQry('UPDATE '.TBL_NOTIFICATIONS.' SET '.NOTIFY_STATUS.'='.$desired_status.' WHERE '.NOTIFY_STATUS.'='.$source_status);		}		return OPERATION_FAIL;	}		/*** Get Role that have the Status Notification * @param integer $status* @return string*/	public static function getNotifyingRole($status){		if(is_gt_zero_num($status)){			$sql='SELECT GROUP_CONCAT(DISTINCT '.NOTIFY_TO_ROLE.') FROM '.TBL_NOTIFICATIONS.' WHERE '.NOTIFY_STATUS.'='.$status.' AND '.NOTIFY_TYPE .'!=\'MESSAGE\' AND '.NOTIFY_TO_ROLE.' <> '.ROLE_CUSTOMER;			return DB::ExecScalarQry($sql);		}		return '0';	}}//..End tbl_notifications?>