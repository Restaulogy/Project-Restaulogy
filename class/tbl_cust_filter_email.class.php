<?php/**********************************************************************tbl_cust_filter_email.class.phpGenerated by STRUCTY 2014.08.21 12:22:09.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define("TBL_CUST_FILTER_EMAIL", "tbl_cust_filter_email"); define('CFE_ID', 'cfe_id'); define('CFE_FILTER', 'cfe_filter'); define('CFE_VALUE', 'cfe_value'); define('CFE_PROMOTION', 'cfe_promotion'); define('CFE_REWARD', 'cfe_reward');define('CFE_MESASGE', 'cfe_mesasge'); define('CFE_EMAIL_OR_SMS', 'cfe_email_or_sms'); define('CFE_PERIOD_START', 'cfe_period_start'); define('CFE_PERIOD_END', 'cfe_period_end'); define('CFE_RESTAURANT', 'cfe_restaurant'); define('CFE_START_DATE', 'cfe_start_date'); define('CFE_END_DATE', 'cfe_end_date'); define("TBL_CUST_FILTER_EMAIL_ACTIVE_DATE",  CFE_START_DATE);define("TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE",  CFE_END_DATE);$tbl_cust_filter_email_active_condition= " (".TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE." is NULL OR ".TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE." = 0 OR ".TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE." > CURDATE( )) ";class tbl_cust_filter_email {	private $cfe_id;	private $cfe_filter;	private $cfe_value;	private $cfe_promotion;		private $cfe_reward;		private $cfe_mesasge;	private $cfe_email_or_sms;	private $cfe_period_start;	private $cfe_period_end;	private $cfe_restaurant;	private $cfe_start_date;	private $cfe_end_date;	private $tbl_cust_filter_email_active_date;	private $tbl_cust_filter_email_deactive_date;	public function setcfe_id($pArg="0") {$this->cfe_id=$pArg;}	public function setcfe_filter($pArg="0") {$this->cfe_filter=$pArg;}	public function setcfe_value($pArg="0") {$this->cfe_value=$pArg;}	public function setcfe_promotion($pArg="0") {$this->cfe_promotion=$pArg;}		public function setcfe_reward($pArg="0") {$this->cfe_reward=$pArg;}			public function setcfe_mesasge($pArg="0") {$this->cfe_mesasge=$pArg;}	public function setcfe_email_or_sms($pArg="0") {$this->cfe_email_or_sms=$pArg;}	public function setcfe_period_start($pArg="0") {$this->cfe_period_start=$pArg;}	public function setcfe_period_end($pArg="0") {$this->cfe_period_end=$pArg;}	public function setcfe_restaurant($pArg="0") {$this->cfe_restaurant=$pArg;}	public function setcfe_start_date($pArg="0") {$this->cfe_start_date=$pArg;}	public function setcfe_end_date($pArg="0") {$this->cfe_end_date=$pArg;}	public function settbl_cust_filter_email_active_date($pArg="0") {$this->tbl_cust_filter_email_active_date=$pArg;}	public function settbl_cust_filter_email_deactive_date($pArg="0") {$this->tbl_cust_filter_email_deactive_date=$pArg;}	public function getcfe_id() {return $this->cfe_id;}	public function getcfe_filter() {return $this->cfe_filter;}	public function getcfe_value() {return $this->cfe_value;}	public function getcfe_promotion() {return $this->cfe_promotion;}		public function getcfe_reward() {return $this->cfe_reward;}		public function getcfe_mesasge() {return $this->cfe_mesasge;}	public function getcfe_email_or_sms() {return $this->cfe_email_or_sms;}	public function getcfe_period_start() {return $this->cfe_period_start;}	public function getcfe_period_end() {return $this->cfe_period_end;}	public function getcfe_restaurant() {return $this->cfe_restaurant;}	public function getcfe_start_date() {return $this->cfe_start_date;}	public function getcfe_end_date() {return $this->cfe_end_date;}	public function gettbl_cust_filter_email_active_date($pArg="0") {return $this->tbl_cust_filter_email_active_date;}	public function gettbl_cust_filter_email_deactive_date($pArg="0") {return $this->tbl_cust_filter_email_deactive_date;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".TBL_CUST_FILTER_EMAIL.RET;		$and = "WHERE".RET;		if($array[CFE_ID] != "") {			$qry .= $and.CFE_ID." = '".$array[CFE_ID]."'".RET;			$and = "AND".RET;		}		if($array[CFE_FILTER] != "") {			$qry .= $and.CFE_FILTER." = '".$array[CFE_FILTER]."'".RET;			$and = "AND".RET;		}		if($array[CFE_VALUE] != "") {			$qry .= $and.CFE_VALUE." = '".$array[CFE_VALUE]."'".RET;			$and = "AND".RET;		}		if($array[CFE_PROMOTION] != "") {			$qry .= $and.CFE_PROMOTION." = '".$array[CFE_PROMOTION]."'".RET;			$and = "AND".RET;		}				if($array[CFE_REWARD] != "") {			$qry .= $and.CFE_REWARD." = '".$array[CFE_REWARD]."'".RET;			$and = "AND".RET;		}		if($array[CFE_MESASGE] != "") {			$qry .= $and.CFE_MESASGE." = '".$array[CFE_MESASGE]."'".RET;			$and = "AND".RET;		}		if($array[CFE_EMAIL_OR_SMS] != "") {			$qry .= $and.CFE_EMAIL_OR_SMS." = '".$array[CFE_EMAIL_OR_SMS]."'".RET;			$and = "AND".RET;		}		if($array[CFE_PERIOD_START] != "") {			$qry .= $and.CFE_PERIOD_START." = '".$array[CFE_PERIOD_START]."'".RET;			$and = "AND".RET;		}		if($array[CFE_PERIOD_END] != "") {			$qry .= $and.CFE_PERIOD_END." = '".$array[CFE_PERIOD_END]."'".RET;			$and = "AND".RET;		}		if($array[CFE_RESTAURANT] != "") {			$qry .= $and.CFE_RESTAURANT." = '".$array[CFE_RESTAURANT]."'".RET;			$and = "AND".RET;		}		if($array[CFE_START_DATE] != "") {			$qry .= $and.CFE_START_DATE." = '".$array[CFE_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[CFE_END_DATE] != "") {			$qry .= $and.CFE_END_DATE." = '".$array[CFE_END_DATE]."'".RET;			$and = "AND".RET;		}	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->setcfe_id($record[CFE_ID]);				$this->setcfe_filter($record[CFE_FILTER]);				$this->setcfe_value($record[CFE_VALUE]);				$this->setcfe_promotion($record[CFE_PROMOTION]);								$this->setcfe_reward($record[CFE_REWARD]);								$this->setcfe_mesasge($record[CFE_MESASGE]);				$this->setcfe_email_or_sms($record[CFE_EMAIL_OR_SMS]);				$this->setcfe_period_start($record[CFE_PERIOD_START]);				$this->setcfe_period_end($record[CFE_PERIOD_END]);				$this->setcfe_restaurant($record[CFE_RESTAURANT]);				$this->setcfe_start_date($record[CFE_START_DATE]);				$this->setcfe_end_date($record[CFE_END_DATE]);				$this->settbl_cust_filter_email_active_date($record[TBL_CUST_FILTER_EMAIL_ACTIVE_DATE]);				$this->settbl_cust_filter_email_deactive_date($record[TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE]);				return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1) {		global $tbl_cust_filter_email_active_condition;		$qry = "SELECT *, (SELECT `title` FROM `pds_list_promotions` WHERE `id`=`CFE_PROMOTION`) as `prom_title` ".RET."FROM ".TBL_CUST_FILTER_EMAIL.RET;		$and = "WHERE".RET;		if($array[CFE_ID] != "") {			$qry .= $and.CFE_ID." = '".$array[CFE_ID]."'".RET;			$and = "AND".RET;		}		if($array[CFE_FILTER] != "") {			$qry .= $and.CFE_FILTER." = '".$array[CFE_FILTER]."'".RET;			$and = "AND".RET;		}		if($array[CFE_VALUE] != "") {			$qry .= $and.CFE_VALUE." = '".$array[CFE_VALUE]."'".RET;			$and = "AND".RET;		}		if($array[CFE_PROMOTION] != "") {			$qry .= $and.CFE_PROMOTION." = '".$array[CFE_PROMOTION]."'".RET;			$and = "AND".RET;		}				if($array[CFE_REWARD] != "") {			$qry .= $and.CFE_REWARD." = '".$array[CFE_REWARD]."'".RET;			$and = "AND".RET;		}		if($array[CFE_MESASGE] != "") {			$qry .= $and.CFE_MESASGE." = '".$array[CFE_MESASGE]."'".RET;			$and = "AND".RET;		}		if($array[CFE_EMAIL_OR_SMS] != "") {			$qry .= $and.CFE_EMAIL_OR_SMS." = '".$array[CFE_EMAIL_OR_SMS]."'".RET;			$and = "AND".RET;		}		if($array[CFE_PERIOD_START] != "") {			$qry .= $and.CFE_PERIOD_START." = '".$array[CFE_PERIOD_START]."'".RET;			$and = "AND".RET;		}		if($array[CFE_PERIOD_END] != "") {			$qry .= $and.CFE_PERIOD_END." = '".$array[CFE_PERIOD_END]."'".RET;			$and = "AND".RET;		}		if($array[CFE_RESTAURANT] != "") {			$qry .= $and.CFE_RESTAURANT." = '".$array[CFE_RESTAURANT]."'".RET;			$and = "AND".RET;		}		if($array[CFE_START_DATE] != "") {			$qry .= $and.CFE_START_DATE." = '".$array[CFE_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[CFE_END_DATE] != "") {			$qry .= $and.CFE_END_DATE." = '".$array[CFE_END_DATE]."'".RET;			$and = "AND".RET;		}				if(is_gt_zero_num($array["isInExpiryRange"])) {			$qry .= $and." DATE(`".CFE_PERIOD_START."`) <=CURDATE() AND DATE(`".CFE_PERIOD_END."`) >=CURDATE()".RET;			//$qry .= $and." DATE(`".CFE_PERIOD_START."`) >='".$array['search_from_dt']."' AND DATE(`".CFE_PERIOD_END."`) <='".$array['search_to_dt']."'".RET;			//$qry .= $and." DATE(`".CFE_PERIOD_START."`) >='".$array['search_from_dt']."' AND DATE(`".CFE_PERIOD_START."`) <='".$array['search_to_dt']."' AND DATE(`".CFE_PERIOD_END."`) >='".$array['search_from_dt']."' AND DATE(`".CFE_PERIOD_END."`) <='".$array['search_to_dt']."' ".RET;			$and = "AND".RET;					}		if(is_gt_zero_num($array["isActive"])) {			$qry .= $and.$tbl_cust_filter_email_active_condition;			$and = "AND".RET;		}		if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {		$qry .=" ORDER BY ".$array[SORT_ON]." ".$array[SORT_BY];		}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry." LIMIT ".$array[OFFSET_TITLE].",".$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		}		//echo "qry_with_limit=$qry_with_limit";				$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		if($r1){			$result_found = mysql_num_rows($r1);		}		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE]))== false)){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}				//..get the filter corresponding text values				//$_filt_text_forms =tbl_cust_filter_email::getCustFilters();				if($isArray){					$class_object = array();					$class_object["cfe_id"]=$record[CFE_ID];					$class_object["cfe_filter"]=$record[CFE_FILTER];					$class_object["cfe_filter_textual"]=tbl_cust_filter_email::getCustFiltersTextual($record[CFE_FILTER],$record[CFE_VALUE]);										$class_object["cfe_value"]=$record[CFE_VALUE];					$class_object["cfe_promotion"]=$record[CFE_PROMOTION];										$class_object["prom_title"]=$record['prom_title'];															$class_object["cfe_reward"]=$record[CFE_REWARD];										$class_object["cfe_mesasge"]=$record[CFE_MESASGE];					$class_object["cfe_email_or_sms"]=$record[CFE_EMAIL_OR_SMS];					$class_object["cfe_period_start"]=$record[CFE_PERIOD_START];					$class_object["cfe_period_end"]=$record[CFE_PERIOD_END];					$class_object["cfe_restaurant"]=$record[CFE_RESTAURANT];					$class_object["cfe_start_date"]=$record[CFE_START_DATE];					$class_object["cfe_end_date"]=$record[CFE_END_DATE];					$class_object["isActive"]=$isActive;				}else{					$class_object = new tbl_cust_filter_email();					$class_object->setcfe_id($record[CFE_ID]);					$class_object->setcfe_filter($record[CFE_FILTER]);					$class_object->setcfe_value($record[CFE_VALUE]);					$class_object->setcfe_promotion($record[CFE_PROMOTION]);										$class_object->setcfe_reward($record[CFE_REWARD]);										$class_object->setcfe_mesasge($record[CFE_MESASGE]);					$class_object->setcfe_email_or_sms($record[CFE_EMAIL_OR_SMS]);					$class_object->setcfe_period_start($record[CFE_PERIOD_START]);					$class_object->setcfe_period_end($record[CFE_PERIOD_END]);					$class_object->setcfe_restaurant($record[CFE_RESTAURANT]);					$class_object->setcfe_start_date($record[CFE_START_DATE]);					$class_object->setcfe_end_date($record[CFE_END_DATE]);				}				$class_objects[$record[CFE_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->getcfe_id() != '') {			$qry  = "UPDATE ".TBL_CUST_FILTER_EMAIL.RET."SET".RET."			".CFE_ID." = '".$this->getcfe_id()."',".RET."			".CFE_FILTER." = '".$this->getcfe_filter()."',".RET."			".CFE_VALUE." = '".$this->getcfe_value()."',".RET."			".CFE_PROMOTION." = '".$this->getcfe_promotion()."',".RET."			".CFE_MESASGE." = '".$this->getcfe_mesasge()."',".RET."			".CFE_EMAIL_OR_SMS." = '".$this->getcfe_email_or_sms()."',".RET."			".CFE_PERIOD_START." = '".$this->getcfe_period_start()."',".RET."			".CFE_PERIOD_END." = '".$this->getcfe_period_end()."',".RET."			".CFE_RESTAURANT." = '".$this->getcfe_restaurant()."',".RET."			".CFE_START_DATE." = '".$this->getcfe_start_date()."',".RET."			".CFE_END_DATE." = '".$this->getcfe_end_date()."'".RET.			"WHERE ".CFE_ID." = ".$this->getcfe_id().RET;//echo "$qry";			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_CUST_FILTER_EMAIL." (".RET.			"".CFE_FILTER.", ".CFE_VALUE.", ".CFE_PROMOTION.", ".CFE_REWARD.", ".CFE_MESASGE.", ".CFE_EMAIL_OR_SMS.", ".CFE_PERIOD_START.", ".CFE_PERIOD_END.", ".CFE_RESTAURANT.", ".CFE_START_DATE.", ".CFE_END_DATE.RET.				") VALUES (".RET.			"'".$this->getcfe_filter()."',".RET.			"'".$this->getcfe_value()."',".RET.						"'".$this->getcfe_promotion()."',".RET.			"'".$this->getcfe_reward()."',".RET.			"'".$this->getcfe_mesasge()."',".RET.			"'".$this->getcfe_email_or_sms()."',".RET.			"'".$this->getcfe_period_start()."',".RET.			"'".$this->getcfe_period_end()."',".RET.			"'".$this->getcfe_restaurant()."',".RET.			"'".$this->getcfe_start_date()."',".RET.			"'".$this->getcfe_end_date()."'".RET.			")".RET;			//echo "qry=$qry";			$res = mysql_query($qry);			$this->setcfe_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_CUST_FILTER_EMAIL.RET;		$and = "WHERE".RET;		if($array[CFE_ID] != "") {			$qry .= $and.CFE_ID." IN (".$array[CFE_ID].")".RET;			$and = "AND".RET;		}		if($array[CFE_FILTER] != "") {			$qry .= $and.CFE_FILTER." = '".$array[CFE_FILTER]."'".RET;			$and = "AND".RET;		}		if($array[CFE_VALUE] != "") {			$qry .= $and.CFE_VALUE." = '".$array[CFE_VALUE]."'".RET;			$and = "AND".RET;		}		if($array[CFE_PROMOTION] != "") {			$qry .= $and.CFE_PROMOTION." = '".$array[CFE_PROMOTION]."'".RET;			$and = "AND".RET;		}				if($array[CFE_REWARD] != "") {			$qry .= $and.CFE_REWARD." = '".$array[CFE_REWARD]."'".RET;			$and = "AND".RET;		}		if($array[CFE_MESASGE] != "") {			$qry .= $and.CFE_MESASGE." = '".$array[CFE_MESASGE]."'".RET;			$and = "AND".RET;		}		if($array[CFE_EMAIL_OR_SMS] != "") {			$qry .= $and.CFE_EMAIL_OR_SMS." = '".$array[CFE_EMAIL_OR_SMS]."'".RET;			$and = "AND".RET;		}		if($array[CFE_PERIOD_START] != "") {			$qry .= $and.CFE_PERIOD_START." = '".$array[CFE_PERIOD_START]."'".RET;			$and = "AND".RET;		}		if($array[CFE_PERIOD_END] != "") {			$qry .= $and.CFE_PERIOD_END." = '".$array[CFE_PERIOD_END]."'".RET;			$and = "AND".RET;		}		if($array[CFE_RESTAURANT] != "") {			$qry .= $and.CFE_RESTAURANT." = '".$array[CFE_RESTAURANT]."'".RET;			$and = "AND".RET;		}		if($array[CFE_START_DATE] != "") {			$qry .= $and.CFE_START_DATE." = '".$array[CFE_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[CFE_END_DATE] != "") {			$qry .= $and.CFE_END_DATE." = '".$array[CFE_END_DATE]."'".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($cfe_filter ,$cfe_value ,$cfe_promotion ,$cfe_mesasge ,$cfe_email_or_sms ,$cfe_period_start ,$cfe_period_end ,$cfe_restaurant ,$cfe_start_date ,$cfe_end_date) {		$unique_arr = array();			//$unique_arr[CFE_ID]=$cfe_id;			$unique_arr[CFE_FILTER]=$cfe_filter;			//$unique_arr[CFE_VALUE]=$cfe_value;			//$unique_arr[CFE_PROMOTION]=$cfe_promotion;			//$unique_arr[CFE_MESASGE]=$cfe_mesasge;			//$unique_arr[CFE_EMAIL_OR_SMS]=$cfe_email_or_sms;			//$unique_arr[CFE_PERIOD_START]=$cfe_period_start;			//$unique_arr[CFE_PERIOD_END]=$cfe_period_end;			$unique_arr[CFE_RESTAURANT]=$cfe_restaurant;			//$unique_arr[CFE_START_DATE]=$cfe_start_date;			//$unique_arr[CFE_END_DATE]=$cfe_end_date;		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($cfe_filter ,$cfe_value ,$cfe_promotion ,$cfe_mesasge ,$cfe_email_or_sms ,$cfe_period_start ,$cfe_period_end ,$cfe_restaurant ,$cfe_start_date ,$cfe_end_date,$cfe_reward) {		if(is_not_empty($cfe_filter)){			if($this->isAlreadyThere($cfe_filter ,$cfe_value ,$cfe_promotion ,$cfe_mesasge ,$cfe_email_or_sms ,$cfe_period_start ,$cfe_period_end ,$cfe_restaurant ,$cfe_start_date ,$cfe_end_date)){				return OPERATION_DUPLICATE;			}else{				$this->setcfe_id("");				$this->setcfe_filter($cfe_filter);				$this->setcfe_value($cfe_value);				$this->setcfe_promotion($cfe_promotion);								$this->setcfe_reward($cfe_reward);								$this->setcfe_mesasge($cfe_mesasge);				$this->setcfe_email_or_sms($cfe_email_or_sms);				//$this->setcfe_period_start(date(DATE_FORMAT,strtotime($cfe_period_start)));				//$this->setcfe_period_end(date(DATE_FORMAT,strtotime($cfe_period_end)));				$this->setcfe_period_start(date(DATE_FORMAT));				$this->setcfe_period_end(date(DATE_FORMAT));				$this->setcfe_restaurant($cfe_restaurant);				$this->setcfe_start_date(date(DATE_FORMAT));				$this->insert();				return $this->getcfe_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($cfe_id, $cfe_filter, $cfe_value, $cfe_promotion, $cfe_mesasge, $cfe_email_or_sms, $cfe_period_start, $cfe_period_end, $cfe_restaurant, $cfe_start_date, $cfe_end_date) {		if(is_gt_zero_num($cfe_id)){			if ($this->readObject(array(CFE_ID=>$cfe_id))){				$this->setcfe_filter($cfe_filter);				$this->setcfe_value($cfe_value);				$this->setcfe_promotion($cfe_promotion);				$this->setcfe_mesasge($cfe_mesasge);				$this->setcfe_email_or_sms($cfe_email_or_sms);				//$this->setcfe_period_start(date(DATE_FORMAT,strtotime($cfe_period_start)));				//$this->setcfe_period_end(date(DATE_FORMAT,strtotime($cfe_period_end)));				$this->setcfe_restaurant($cfe_restaurant);				$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update	public function activate($cfe_id){		if(is_gt_zero_num($cfe_id)){			if ($this->readObject(array(CFE_ID=>$cfe_id))){				$qry  = "UPDATE ".TBL_CUST_FILTER_EMAIL.RET."SET".RET."			".TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE." = '".date(EMPTY_DATE_FORMAT)."' WHERE ".CFE_ID."={$cfe_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end activate	public function deactivate($cfe_id){		if(is_gt_zero_num($cfe_id)){			if ($this->readObject(array(CFE_ID=>$cfe_id))){				$qry  = "UPDATE ".TBL_CUST_FILTER_EMAIL.RET."SET".RET."			".TBL_CUST_FILTER_EMAIL_DEACTIVE_DATE." = '".date(DATE_FORMAT)."' WHERE ".CFE_ID."={$cfe_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end deactivate	public static function GetInfo($cfe_id) {		$info = array();		if($cfe_id != ""){			$obj_tbl_cust_filter_email = new tbl_cust_filter_email();			if($obj_tbl_cust_filter_email->readObject(array("cfe_id"=>$cfe_id))){				$info["cfe_id"]=$obj_tbl_cust_filter_email->getcfe_id();				$info["cfe_filter"]=$obj_tbl_cust_filter_email->getcfe_filter();				$info["cfe_value"]=$obj_tbl_cust_filter_email->getcfe_value();				$info["cfe_promotion"]=$obj_tbl_cust_filter_email->getcfe_promotion();								$info["cfe_reward"]=$obj_tbl_cust_filter_email->getcfe_reward();								$info["cfe_mesasge"]=$obj_tbl_cust_filter_email->getcfe_mesasge();				$info["cfe_email_or_sms"]=$obj_tbl_cust_filter_email->getcfe_email_or_sms();				$info["cfe_period_start"]=$obj_tbl_cust_filter_email->getcfe_period_start();				$info["cfe_period_end"]=$obj_tbl_cust_filter_email->getcfe_period_end();				$info["cfe_restaurant"]=$obj_tbl_cust_filter_email->getcfe_restaurant();				$info["cfe_start_date"]=$obj_tbl_cust_filter_email->getcfe_start_date();				$info["cfe_end_date"]=$obj_tbl_cust_filter_email->getcfe_end_date();				$info["isActive"] = 0;				//..check deactive date is not set or 0				if((is_not_empty($obj_tbl_cust_filter_email->gettbl_cust_filter_email_deactive_date())==false)  || (is_gt_zero_num(strtotime($obj_tbl_cust_filter_email->gettbl_cust_filter_email_deactive_date()))== false)){					$info["isActive"] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($obj_tbl_cust_filter_email->gettbl_cust_filter_email_deactive_date()) > strtotime(date(DATE_FORMAT))){						$info["isActive"] = 1;					}				}			}		unset($obj_tbl_cust_filter_email);		return $info;		}	}//..End GetInfo	public static function GetFields($data){		global $tbl_cust_filter_email_active_condition;		$arr = array();		if(is_not_empty($data)){			$qry ="SELECT ".$data['key_field'].",".$data['value_field']." FROM ".TBL_CUST_FILTER_EMAIL."";			if(is_gt_zero_num($data['isActive'])){				$qry .= " WHERE ".$tbl_cust_filter_email_active_condition;			}			$res = mysql_query($qry); 			if($res){				while($row=mysql_fetch_assoc($res)){					$arr[$row[$data['key_field']]] = $row[$data['value_field']];				}			}		}		return $arr;	}//.. End of GetFields		public static function getCustFilters(){		return array('not_visited'=>'Not visited in last X no. of days','total_point'=>'Has more than X no. of total points','visited'=>'Has visited more than X no. of times','birthday'=>'Birthday'); //,'anniversary'=>'Anniversary',Has visited more than X no. of times in the last month	}		public static function getCustFiltersTextual($cfe_filter,$cfe_value){		$ret_val='';		if($cfe_filter=='not_visited'){			$ret_val='Not visited in last '.$cfe_value.' days';		}elseif($cfe_filter=='total_point'){			$ret_val='Has more than '.$cfe_value.' total points';		}elseif($cfe_filter=='visited'){			$ret_val='Has visited more than '.$cfe_value.' times';		}elseif($cfe_filter=='birthday'){			$ret_val='Birthday';		}		return $ret_val;	}		public static function getEmailSms(){		return array('email'=>'Email','sms'=>'Sms');	}}//..End tbl_cust_filter_email?>