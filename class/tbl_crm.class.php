<?php/**********************************************************************tbl_crm.class.phpGenerated by STRUCTY 2013.11.29 06:04:26.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define('TBL_CRM', 'tbl_crm'); define('CRM_ID', 'crm_id'); define('CRM_CUST_ID', 'crm_cust_id'); define('CRM_CUST_EMAIL', 'crm_cust_email'); define('CRM_CUST_PHONE', 'crm_cust_phone');define('CRM_CUST_TYPE', 'crm_cust_type'); define('CRM_IS_SUBSRIBED', 'crm_is_subsribed'); define('CRM_RESTAURANT', 'crm_restaurant'); define('CRM_START_DATE', 'crm_start_date'); define('CRM_END_DATE', 'crm_end_date'); define('TBL_CRM_ACTIVE_DATE',  CRM_START_DATE);define('TBL_CRM_DEACTIVE_DATE',  CRM_END_DATE);$tbl_crm_active_condition= ' ('.TBL_CRM_DEACTIVE_DATE.' is NULL OR '.TBL_CRM_DEACTIVE_DATE.' = 0 OR '.TBL_CRM_DEACTIVE_DATE.' > CURDATE( )) ';class tbl_crm {	private $crm_id;	private $crm_cust_id;	private $crm_cust_email;		private $crm_cust_phone;		private $crm_cust_type;	private $crm_is_subsribed;	private $crm_restaurant;	private $crm_start_date;	private $crm_end_date;	private $tbl_crm_active_date;	private $tbl_crm_deactive_date;	public function setcrm_id($pArg='0') {$this->crm_id=$pArg;}	public function setcrm_cust_id($pArg='0') {$this->crm_cust_id=$pArg;}	public function setcrm_cust_email($pArg='0') {$this->crm_cust_email=$pArg;}		public function setcrm_cust_phone($pArg='0') {$this->crm_cust_phone=$pArg;}		public function setcrm_cust_type($pArg='0') {$this->crm_cust_type=$pArg;}	public function setcrm_is_subsribed($pArg='0') {$this->crm_is_subsribed=$pArg;}	public function setcrm_restaurant($pArg='0') {$this->crm_restaurant=$pArg;}	public function setcrm_start_date($pArg='0') {$this->crm_start_date=$pArg;}	public function setcrm_end_date($pArg='0') {$this->crm_end_date=$pArg;}	public function settbl_crm_active_date($pArg='0') {$this->tbl_crm_active_date=$pArg;}	public function settbl_crm_deactive_date($pArg='0') {$this->tbl_crm_deactive_date=$pArg;}	public function getcrm_id() {return $this->crm_id;}	public function getcrm_cust_id() {return $this->crm_cust_id;}	public function getcrm_cust_email() {return $this->crm_cust_email;}		public function getcrm_cust_phone() {return $this->crm_cust_phone;}		public function getcrm_cust_type() {return $this->crm_cust_type;}	public function getcrm_is_subsribed() {return $this->crm_is_subsribed;}	public function getcrm_restaurant() {return $this->crm_restaurant;}	public function getcrm_start_date() {return $this->crm_start_date;}	public function getcrm_end_date() {return $this->crm_end_date;}	public function gettbl_crm_active_date() {return $this->tbl_crm_active_date;}	public function gettbl_crm_deactive_date() {return $this->tbl_crm_deactive_date;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".TBL_CRM.RET;		$and = "WHERE".RET;		if($array[CRM_ID] != "") {			$qry .= $and.CRM_ID." = '".$array[CRM_ID]."'".RET;			$and = "AND".RET;		}		if($array[CRM_CUST_ID] != "") {			$qry .= $and.CRM_CUST_ID." = '".$array[CRM_CUST_ID]."'".RET;			$and = "AND".RET;		}		if($array[CRM_CUST_EMAIL] != "") {			$qry .= $and.CRM_CUST_EMAIL." = '".$array[CRM_CUST_EMAIL]."'".RET;			$and = "AND".RET;		}				if($array[CRM_CUST_PHONE] != "") {			$qry .= $and.CRM_CUST_PHONE." = '".$array[CRM_CUST_PHONE]."'".RET;			$and = "AND".RET;		}		if($array[CRM_CUST_TYPE] != "") {			$qry .= $and.CRM_CUST_TYPE." = '".$array[CRM_CUST_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[CRM_IS_SUBSRIBED] != "") {			$qry .= $and.CRM_IS_SUBSRIBED." = '".$array[CRM_IS_SUBSRIBED]."'".RET;			$and = "AND".RET;		}		if($array[CRM_START_DATE] != "") {			$qry .= $and.CRM_START_DATE." = '".$array[CRM_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[CRM_END_DATE] != "") {			$qry .= $and.CRM_END_DATE." = '".$array[CRM_END_DATE]."'".RET;			$and = "AND".RET;		}	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->setcrm_id($record[CRM_ID]);				$this->setcrm_cust_id($record[CRM_CUST_ID]);				$this->setcrm_cust_email($record[CRM_CUST_EMAIL]);								$this->setcrm_cust_phone($record[CRM_CUST_PHONE]);								$this->setcrm_cust_type($record[CRM_CUST_TYPE]);				$this->setcrm_is_subsribed($record[CRM_IS_SUBSRIBED]);				$this->setcrm_restaurant($record[CRM_RESTAURANT]);				$this->setcrm_start_date($record[CRM_START_DATE]);				$this->setcrm_end_date($record[CRM_END_DATE]);				$this->settbl_crm_active_date($record[TBL_CRM_ACTIVE_DATE]);				$this->settbl_crm_deactive_date($record[TBL_CRM_DEACTIVE_DATE]);				return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1) {		global $tbl_crm_active_condition;		$qry = "SELECT *, 						case ".CRM_CUST_TYPE." 						WHEN '".CUST_TYPE_LOGIN."' THEN  (SELECT CONCAT(`staff_fname`,' ',`staff_lname`) FROM ".TBL_STAFF." WHERE `staff_member_id` = ".CRM_CUST_ID." AND `staff_restaurent`=".$_SESSION[SES_RESTAURANT].") 						WHEN '".CUST_TYPE_COOKIE."' THEN (SELECT `devck_customer` FROM `tbl_device_cookies` WHERE `devck_id` = ".CRM_CUST_ID.") 						WHEN '".CUST_TYPE_SMS_REG."' THEN '--'						END `customer_name`													".RET."FROM ".TBL_CRM.RET;		$and = "WHERE".RET;				 		if($array['exclude_banned'] == 1) {			$qry .= $and." `crm_cust_id` NOT IN (SELECT `id` FROM `members` WHERE `banned`=1) ".RET;			$and = "AND".RET;		}		if($array[CRM_ID] != "") {			$qry .= $and.CRM_ID." = '".$array[CRM_ID]."'".RET;			$and = "AND".RET;		}		if($array[CRM_CUST_ID] != "") {			$qry .= $and.CRM_CUST_ID." = '".$array[CRM_CUST_ID]."'".RET;			$and = "AND".RET;		}		if($array[CRM_CUST_EMAIL] != "") {			$qry .= $and.CRM_CUST_EMAIL." = '".$array[CRM_CUST_EMAIL]."'".RET;			$and = "AND".RET;		}				if($array[CRM_CUST_PHONE] != "") {			$qry .= $and.CRM_CUST_PHONE." = '".$array[CRM_CUST_PHONE]."'".RET;			$and = "AND".RET;		}		if($array[CRM_CUST_TYPE] != "") {			$qry .= $and.CRM_CUST_TYPE." = '".$array[CRM_CUST_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[CRM_IS_SUBSRIBED] != "") {			$qry .= $and.CRM_IS_SUBSRIBED." = '".$array[CRM_IS_SUBSRIBED]."'".RET;			$and = "AND".RET;		}				if($array[CRM_RESTAURANT] != "") {			$qry .= $and.CRM_RESTAURANT." = ".$array[CRM_RESTAURANT]."".RET;			$and = "AND".RET;		}		if($array[CRM_START_DATE] != "") {			$qry .= $and.CRM_START_DATE." = '".$array[CRM_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[CRM_END_DATE] != "") {			$qry .= $and.CRM_END_DATE." = '".$array[CRM_END_DATE]."'".RET;			$and = "AND".RET;		}		if(is_gt_zero_num($array["isActive"])) {			$qry .= $and.$tbl_crm_active_condition;;			$and = "AND".RET;		}		if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {		$qry .=" ORDER BY ".$array[SORT_ON]." ".$array[SORT_BY];		}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry." LIMIT ".$array[OFFSET_TITLE].",".$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		}		//echo $qry_with_limit;				$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		if($r1){			$result_found = mysql_num_rows($r1);		}		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_CRM_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_CRM_DEACTIVE_DATE]))== false)){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_CRM_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}				if($isArray){					$class_object = array();					$class_object['crm_id']=$record[CRM_ID];					$class_object['crm_cust_id']=$record[CRM_CUST_ID];					$class_object['crm_cust_email']=$record[CRM_CUST_EMAIL];					$class_object['usr_without_email']=_chk_if_usr_witout_email($record[CRM_CUST_EMAIL]);										$class_object['crm_cust_phone']=$record[CRM_CUST_PHONE];										$class_object['crm_cust_type']=$record[CRM_CUST_TYPE];					$class_object['crm_is_subsribed']=$record[CRM_IS_SUBSRIBED];					$class_object['crm_start_date']=$record[CRM_START_DATE];					$class_object['crm_end_date']=$record[CRM_END_DATE];					$class_object['customer_name']= $record['customer_name'];					$class_object['isActive']=$isActive;				}else{					$class_object = new tbl_crm();					$class_object->setcrm_id($record[CRM_ID]);					$class_object->setcrm_cust_id($record[CRM_CUST_ID]);					$class_object->setcrm_cust_email($record[CRM_CUST_EMAIL]);										$class_object->setcrm_cust_phone($record[CRM_CUST_PHONE]);										$class_object->setcrm_cust_type($record[CRM_CUST_TYPE]);					$class_object->setcrm_is_subsribed($record[CRM_IS_SUBSRIBED]);					$class_object->setcrm_start_date($record[CRM_START_DATE]);					$class_object->setcrm_end_date($record[CRM_END_DATE]);				}				$class_objects[$record[CRM_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->getcrm_id() != '') {			$qry  = "UPDATE ".TBL_CRM.RET."SET".RET."			".CRM_ID." = '".$this->getcrm_id()."',".RET."			".CRM_CUST_ID." = '".$this->getcrm_cust_id()."',".RET."			".CRM_CUST_EMAIL." = '".$this->getcrm_cust_email()."',".RET."			".CRM_CUST_PHONE." = '".$this->getcrm_cust_phone()."',".RET."			".CRM_CUST_TYPE." = '".$this->getcrm_cust_type()."',".RET."			".CRM_IS_SUBSRIBED." = '".$this->getcrm_is_subsribed()."',".RET."			".CRM_START_DATE." = '".$this->getcrm_start_date()."',".RET."			".CRM_END_DATE." = '".$this->getcrm_end_date()."'".RET.			"WHERE ".CRM_ID." = ".$this->getcrm_id().RET;			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_CRM." (".RET.			"".CRM_CUST_ID.", ".CRM_CUST_EMAIL.", ".CRM_CUST_PHONE.", ".CRM_CUST_TYPE.", ".CRM_IS_SUBSRIBED.", ".CRM_RESTAURANT.", ".CRM_START_DATE.", ".CRM_END_DATE.RET.				") VALUES (".RET.			"'".$this->getcrm_cust_id()."',".RET.			"'".$this->getcrm_cust_email()."',".RET.			"'".$this->getcrm_cust_phone()."',".RET.			"'".$this->getcrm_cust_type()."',".RET.			"'".$this->getcrm_is_subsribed()."',".RET.			"'".$_SESSION[SES_RESTAURANT]."',".RET.			"'".$this->getcrm_start_date()."',".RET.			"'".$this->getcrm_end_date()."'".RET.						")".RET;			$res = mysql_query($qry);			$this->setcrm_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_CRM.RET;		$and = "WHERE".RET;		if($array[CRM_ID] != "") {			$qry .= $and.CRM_ID." = '".$array[CRM_ID]."'".RET;			$and = "AND".RET;		}		if($array[CRM_CUST_ID] != "") {			$qry .= $and.CRM_CUST_ID." = '".$array[CRM_CUST_ID]."'".RET;			$and = "AND".RET;		}		if($array[CRM_CUST_EMAIL] != "") {			$qry .= $and.CRM_CUST_EMAIL." = '".$array[CRM_CUST_EMAIL]."'".RET;			$and = "AND".RET;		}				if($array[CRM_CUST_PHONE] != "") {			$qry .= $and.CRM_CUST_PHONE." = '".$array[CRM_CUST_PHONE]."'".RET;			$and = "AND".RET;		}		if($array[CRM_CUST_TYPE] != "") {			$qry .= $and.CRM_CUST_TYPE." = '".$array[CRM_CUST_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[CRM_IS_SUBSRIBED] != "") {			$qry .= $and.CRM_IS_SUBSRIBED." = '".$array[CRM_IS_SUBSRIBED]."'".RET;			$and = "AND".RET;		}		if($array[CRM_START_DATE] != "") {			$qry .= $and.CRM_START_DATE." = '".$array[CRM_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[CRM_END_DATE] != "") {			$qry .= $and.CRM_END_DATE." = '".$array[CRM_END_DATE]."'".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($crm_cust_id ,$crm_cust_email,$crm_cust_phone,$crm_cust_type ,$crm_is_subsribed) {			$unique_arr = array();						if($crm_cust_type==CUST_TYPE_SMS_REG){				$unique_arr[CRM_CUST_PHONE]=$crm_cust_phone;			}else{				//$unique_arr[CRM_ID]=$crm_id;			   $unique_arr[CRM_CUST_EMAIL]=$crm_cust_email;				 //$unique_arr[CRM_CUST_PHONE]=$crm_cust_phone;				 //$unique_arr[CRM_CUST_ID]=$crm_cust_id;				 $unique_arr[CRM_CUST_TYPE]=$crm_cust_type;				 $unique_arr[CRM_RESTAURANT]=$_SESSION[SES_RESTAURANT];				 //$unique_arr[CRM_IS_SUBSRIBED]=$crm_is_subsribed;				 //$unique_arr[CRM_START_DATE]=$crm_start_date;				 //$unique_arr[CRM_END_DATE]=$crm_end_date;			}			 		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($crm_cust_id ,$crm_cust_email ,$crm_cust_type=CUST_TYPE_LOGIN ,$crm_is_subsribed=0,$crm_cust_phone=NULL) {		if(is_not_empty($crm_cust_id) && is_not_empty($crm_cust_email)){			if($this->isAlreadyThere($crm_cust_id,$crm_cust_email,$crm_cust_phone ,$crm_cust_type ,$crm_is_subsribed)){				$this->setcrm_is_subsribed($crm_is_subsribed);				$this->insert();				return OPERATION_DUPLICATE;			}else{				$this->setcrm_id("");				$this->setcrm_cust_id($crm_cust_id);				$this->setcrm_cust_email($crm_cust_email);								if(is_not_empty($crm_cust_phone)){					//$crm_cust_phone = str_replace(array('+','-'), '', filter_var($crm_cust_phone, FILTER_SANITIZE_NUMBER_INT));					$crm_cust_phone=_get_us_phone_without1($crm_cust_phone);				}				$this->setcrm_cust_phone($crm_cust_phone);								$this->setcrm_cust_type($crm_cust_type);				$this->setcrm_is_subsribed($crm_is_subsribed);				$this->setcrm_start_date(date(DATE_FORMAT));				$this->insert();				return $this->getcrm_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($crm_id, $crm_cust_id, $crm_cust_email, $crm_cust_type, $crm_is_subsribed,$crm_cust_phone=NULL) {		if(is_gt_zero_num($crm_id)){			if ($this->readObject(array(CRM_ID=>$crm_id))){				$this->setcrm_cust_id($crm_cust_id);				$this->setcrm_cust_email($crm_cust_email);								$this->setcrm_cust_phone($crm_cust_phone);								$this->setcrm_cust_type($crm_cust_type);				$this->setcrm_is_subsribed($crm_is_subsribed);				$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update		public function unsubscribe_from_crm($crm_id) {		if(is_gt_zero_num($crm_id)){			if ($this->readObject(array(CRM_ID=>$crm_id))){							$this->setcrm_is_subsribed(0);				$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update		public static function user_subanunsubscribe($member_id,$_new_val,$_rest_id) {		if(is_gt_zero_num($member_id)){			$qry  = 'UPDATE `'.TBL_CRM.'` SET `'.CRM_IS_SUBSRIBED.'`='.$_new_val.' WHERE `'.CRM_CUST_ID.'`='.$member_id.' AND `'.CRM_RESTAURANT.'`='.$_rest_id.';';										$_is_success= DB::ExecNonQry($qry);							$qry  = 'UPDATE `'.TBL_STAFF.'` SET `'.STAFF_IS_CRM_SUBSCRIBED.'`='.$_new_val.' WHERE `'.STAFF_MEMBER_ID.'`='.$member_id.' AND `'.STAFF_RESTAURENT.'`='.$_rest_id.' ;';										$_is_success= DB::ExecNonQry($qry);							return $_is_success;					}		return OPERATION_FAIL;	}//..update	public function activate($crm_id){		if(is_not_empty($crm_id)){			//if ($this->readObject(array(CRM_ID=>$crm_id))){ 				$qry  = 'UPDATE '.TBL_CRM.RET.'SET'.RET.' '.CRM_IS_SUBSRIBED.'=1, '.TBL_CRM_DEACTIVE_DATE.' = \''.date(EMPTY_DATE_FORMAT).'\' WHERE '.CRM_ID.' IN ('.$crm_id.')';				$res = mysql_query($qry);				if($res){					return 1;				}			//}		}		return 0;	}//..end activate	public function deactivate($crm_id){		if(is_not_empty($crm_id)){			//if ($this->readObject(array(CRM_ID=>$crm_id))){ 				$qry  = 'UPDATE '.TBL_CRM.RET.'SET'.RET.' '.CRM_IS_SUBSRIBED.'=0, '.TBL_CRM_DEACTIVE_DATE.' = \''.date(DATE_FORMAT).'\' WHERE '.CRM_ID.' IN ('.$crm_id.')';				$res = mysql_query($qry);				if($res){					return 1;				}			//}		}		return 0;	}//..end deactivate	public static function GetInfo($crm_id) {		$info = array();		if($crm_id != ''){			$obj_tbl_crm = new tbl_crm();			if($obj_tbl_crm->readObject(array('crm_id'=>$crm_id))){				$info[CRM_ID]=$obj_tbl_crm->getcrm_id();				$info[CRM_CUST_ID]=$obj_tbl_crm->getcrm_cust_id();				$info[CRM_CUST_EMAIL]=$obj_tbl_crm->getcrm_cust_email();								$info[CRM_CUST_PHONE]=$obj_tbl_crm->getcrm_cust_phone();								$info[CRM_CUST_TYPE]=$obj_tbl_crm->getcrm_cust_type();				$info[CRM_IS_SUBSRIBED]=$obj_tbl_crm->getcrm_is_subsribed();				$info[CRM_START_DATE]=$obj_tbl_crm->getcrm_start_date();				$info[CRM_END_DATE]=$obj_tbl_crm->getcrm_end_date();				$info[CRM_RESTAURANT]=$obj_tbl_crm->getcrm_restaurant();				$info['isActive'] = 0;				//..check deactive date is not set or 0				if((is_not_empty($obj_tbl_crm->gettbl_crm_deactive_date())==false)  || (is_gt_zero_num(strtotime($obj_tbl_crm->gettbl_crm_deactive_date()))== false)){					$info['isActive'] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($obj_tbl_crm->gettbl_crm_deactive_date()) > strtotime(date(DATE_FORMAT))){						$info['isActive'] = 1;					}				}			}		unset($obj_tbl_crm);		return $info;		}	}//..End GetInfo	public static function GetFields($data){		global $tbl_crm_active_condition;		$arr = array();		if(is_not_empty($data)){			$qry ="SELECT ".$data['key_field'].",".$data['value_field']." FROM ".TBL_CRM."";			if(is_gt_zero_num($data['isActive'])){				$qry .= " WHERE ".$tbl_crm_active_condition;						}			$res = mysql_query($qry); 			if($res){				while($row=mysql_fetch_assoc($res)){					$arr[$row[$data['key_field']]] = $row[$data['value_field']];				}			}		}		return $arr;	}//.. End of GetFields		public static function get_crm_id_from_email($email){		$sql=  'SELECT `'.CRM_ID.'` FROM `'.TBL_CRM.'`							  WHERE `'.CRM_CUST_EMAIL.'`="'.$email.'" AND `'.CRM_RESTAURANT.'`='.$_SESSION[SES_RESTAURANT];		//echo $sql;		$_crm_id= DB::ExecScalarQry($sql);		if(is_not_empty($_crm_id))			return $_crm_id;		else			return 0;		}		public static function get_crm_id_from_phone($phone){		$sql=  'SELECT `'.CRM_ID.'` FROM `'.TBL_CRM.'`						WHERE `'.CRM_CUST_PHONE.'`="'.$phone.'" AND `'.CRM_RESTAURANT.'`='.$_SESSION[SES_RESTAURANT];		//echo $sql;		$_crm_id= DB::ExecScalarQry($sql);		if(is_not_empty($_crm_id))			return $_crm_id;		else			return 0;		}		//..check if user is subscribed for the crm.	public static function is_subscribed_usr($_phone,$_rest,$_email=array()){		if(is_not_empty($_email)){			$sql=  'SELECT `'.CRM_ID.'` FROM `'.TBL_CRM.'`							WHERE `'.CRM_IS_SUBSRIBED.'`=1 AND `'.CRM_CUST_EMAIL.'`="'.$_email[0].'" AND `'.CRM_RESTAURANT.'`='.$_rest;		}else{			$sql=  'SELECT `'.CRM_ID.'` FROM `'.TBL_CRM.'`							WHERE `'.CRM_IS_SUBSRIBED.'`=1 AND `'.CRM_CUST_PHONE.'`="'.$_phone[0].'" AND `'.CRM_RESTAURANT.'`='.$_rest;		}			//echo $sql;						$_crm_id= DB::ExecScalarQry($sql);		if(is_not_empty($_crm_id))			return $_crm_id;		else			return 0;		}			public static function get_user_nm_from_crm($member_ids,$deflt_fld="email"){	$rtOp='';	if(is_not_empty($member_ids)){		$sql="SELECT *, 						case ".CRM_CUST_TYPE." 						WHEN '".CUST_TYPE_LOGIN."' THEN  (SELECT CONCAT(`staff_fname`,' ',`staff_lname`) FROM ".TBL_STAFF." WHERE `staff_member_id` = ".CRM_CUST_ID." AND `staff_restaurent`=".$_SESSION[SES_RESTAURANT].") 						WHEN '".CUST_TYPE_COOKIE."' THEN (SELECT `devck_customer` FROM `tbl_device_cookies` WHERE `devck_id` = ".CRM_CUST_ID.") 						WHEN '".CUST_TYPE_SMS_REG."' THEN '--'						END `customer_name`													FROM `".TBL_CRM."`						WHERE `".CRM_ID."` IN ({$member_ids})";  		//echo $sql;		$result = mysql_query($sql);		if($result){			while ($row = mysql_fetch_assoc($result)) {				 $rtOp = $row[$deflt_fld];		   			  			}		}	}	return $rtOp;	}}//..End tbl_crm?>