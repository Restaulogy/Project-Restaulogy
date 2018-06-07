<?php/**********************************************************************tbl_prom_discounts.class.phpGenerated by STRUCTY 2013.08.10 08:58:24.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define('TBL_PROM_DISCOUNTS', 'tbl_prom_discounts'); define('PRMDISC_ID', 'prmdisc_id'); define('PRMDISC_PROMOTION', 'prmdisc_promotion'); define('PRMDISC_CONDITION', 'prmdisc_condition'); define('PRMDISC_BOGO_QTY', 'prmdisc_bogo_qty'); define('PRMDISC_BOGO_SBMNU', 'prmdisc_bogo_sbmnu'); define('PRMDISC_BOGO_SBMNU_DISH', 'prmdisc_bogo_sbmnu_dish'); define('PRMDISC_DISC_AMT_TYPE', 'prmdisc_disc_amt_type'); define('PRMDISC_DISC_AMT', 'prmdisc_disc_amt'); define('PRMDISC_START_DATE', 'prmdisc_start_date'); define('PRMDISC_END_DATE', 'prmdisc_end_date'); define('TBL_PROM_DISCOUNTS_ACTIVE_DATE',  PRMDISC_START_DATE);define('TBL_PROM_DISCOUNTS_DEACTIVE_DATE',  PRMDISC_END_DATE);$tbl_prom_discounts_active_condition= ' ('.TBL_PROM_DISCOUNTS_DEACTIVE_DATE.' is NULL OR '.TBL_PROM_DISCOUNTS_DEACTIVE_DATE.' = 0 OR '.TBL_PROM_DISCOUNTS_DEACTIVE_DATE.' > CURDATE( )) ';class tbl_prom_discounts {	private $prmdisc_id;	private $prmdisc_promotion;	private $prmdisc_condition;		private $prmdisc_condition_title;	private $prmdisc_submnu_name;	private $prmdisc_dish_name;		private $prmdisc_bogo_qty;	private $prmdisc_bogo_sbmnu;	private $prmdisc_bogo_sbmnu_dish;	private $prmdisc_disc_amt_type;	private $prmdisc_disc_amt;	private $prmdisc_start_date;	private $prmdisc_end_date;	private $tbl_prom_discounts_active_date;	private $tbl_prom_discounts_deactive_date;	public function setprmdisc_id($pArg='0') {$this->prmdisc_id=$pArg;}	public function setprmdisc_promotion($pArg='0') {$this->prmdisc_promotion=$pArg;}	public function setprmdisc_condition($pArg='0') {$this->prmdisc_condition=$pArg;}		public function setprmdisc_condition_title($pArg='0') {$this->prmdisc_condition_title=$pArg;}		public function setprmdisc_bogo_qty($pArg='0') {$this->prmdisc_bogo_qty=$pArg;}	public function setprmdisc_bogo_sbmnu($pArg='0') {$this->prmdisc_bogo_sbmnu=$pArg;}	public function setprmdisc_bogo_sbmnu_dish($pArg='0') {$this->prmdisc_bogo_sbmnu_dish=$pArg;}		public function setprmdisc_submnu_name($pArg='0') {$this->prmdisc_submnu_name=$pArg;}	public function setprmdisc_dish_name($pArg='0') {$this->prmdisc_dish_name=$pArg;}			public function setprmdisc_disc_amt_type($pArg='0') {$this->prmdisc_disc_amt_type=$pArg;}	public function setprmdisc_disc_amt($pArg='0') {$this->prmdisc_disc_amt=$pArg;}	public function setprmdisc_start_date($pArg='0') {$this->prmdisc_start_date=$pArg;}	public function setprmdisc_end_date($pArg='0') {$this->prmdisc_end_date=$pArg;}	public function settbl_prom_discounts_active_date($pArg='0') {$this->tbl_prom_discounts_active_date=$pArg;}	public function settbl_prom_discounts_deactive_date($pArg='0') {$this->tbl_prom_discounts_deactive_date=$pArg;}	public function getprmdisc_id() {return $this->prmdisc_id;}	public function getprmdisc_promotion() {return $this->prmdisc_promotion;}	public function getprmdisc_condition() {return $this->prmdisc_condition;}		public function getprmdisc_condition_title() { return $this->prmdisc_condition_title;}		public function getprmdisc_bogo_qty() {return $this->prmdisc_bogo_qty;}	public function getprmdisc_bogo_sbmnu() {return $this->prmdisc_bogo_sbmnu;}	public function getprmdisc_bogo_sbmnu_dish() {return $this->prmdisc_bogo_sbmnu_dish;}		public function getprmdisc_submnu_name() {return $this->prmdisc_submnu_name;}	public function getprmdisc_dish_name() {return $this->prmdisc_dish_name;}		public function getprmdisc_disc_amt_type() {return $this->prmdisc_disc_amt_type;}	public function getprmdisc_disc_amt() {return $this->prmdisc_disc_amt;}	public function getprmdisc_start_date() {return $this->prmdisc_start_date;}	public function getprmdisc_end_date() {return $this->prmdisc_end_date;}	public function gettbl_prom_discounts_active_date() {return $this->tbl_prom_discounts_active_date;}	public function gettbl_prom_discounts_deactive_date() {return $this->tbl_prom_discounts_deactive_date;}	public function readObject($array = array()) {		//$qry = "SELECT *".RET."FROM ".TBL_PROM_DISCOUNTS.RET;		$qry = "SELECT dis.*,cn.prmcon_title,s.submnu_name,d.dish_name ".RET.				" FROM ".TBL_PROM_DISCOUNTS." dis ".RET.				" LEFT OUTER JOIN ".TBL_PROM_CONDITIONS." cn ON ".RET.					" cn.`".PRMCON_PROMOTION."`=dis.`".PRMDISC_PROMOTION."` ".RET.				" LEFT OUTER JOIN `tbl_sub_menu` s ON ".RET.					" s.`submnu_id`=dis.`".PRMDISC_BOGO_SBMNU."`".RET.					" LEFT OUTER JOIN `tbl_submenu_dishes` smd ON ".RET.				" smd.`sbmnu_dish_id`=dis.`".PRMDISC_BOGO_SBMNU_DISH."`".RET.					" LEFT OUTER JOIN `tbl_dishes` d ON ".RET.					" d.`dish_id`=smd.`sbmnu_dish_dish`".RET;						$and = "WHERE".RET;				if($array[PRMDISC_ID] != "") {			$qry .= $and.PRMDISC_ID." = '".$array[PRMDISC_ID]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_PROMOTION] != "") {			$qry .= $and.PRMDISC_PROMOTION." = '".$array[PRMDISC_PROMOTION]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_CONDITION] != "") {			$qry .= $and.PRMDISC_CONDITION." = '".$array[PRMDISC_CONDITION]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_BOGO_QTY] != "") {			$qry .= $and.PRMDISC_BOGO_QTY." = '".$array[PRMDISC_BOGO_QTY]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_BOGO_SBMNU] != "") {			$qry .= $and.PRMDISC_BOGO_SBMNU." = '".$array[PRMDISC_BOGO_SBMNU]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_BOGO_SBMNU_DISH] != "") {			$qry .= $and.PRMDISC_BOGO_SBMNU_DISH." = '".$array[PRMDISC_BOGO_SBMNU_DISH]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_DISC_AMT_TYPE] != "") {			$qry .= $and.PRMDISC_DISC_AMT_TYPE." = '".$array[PRMDISC_DISC_AMT_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_DISC_AMT] != "") {			$qry .= $and.PRMDISC_DISC_AMT." = '".$array[PRMDISC_DISC_AMT]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_START_DATE] != "") {			$qry .= $and.PRMDISC_START_DATE." = '".$array[PRMDISC_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_END_DATE] != "") {			$qry .= $and.PRMDISC_END_DATE." = '".$array[PRMDISC_END_DATE]."'".RET;			$and = "AND".RET;		}		$result = mysql_query($qry);			if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}								if(count($record[0]) == 0) {				return array();			} else {								$this->setprmdisc_id($record[PRMDISC_ID]);				$this->setprmdisc_promotion($record[PRMDISC_PROMOTION]);				$this->setprmdisc_condition($record[PRMDISC_CONDITION]);								$this->setprmdisc_condition_title($record['prmcon_title']);											$this->setprmdisc_bogo_qty($record[PRMDISC_BOGO_QTY]);				$this->setprmdisc_bogo_sbmnu($record[PRMDISC_BOGO_SBMNU]);				$this->setprmdisc_bogo_sbmnu_dish($record[PRMDISC_BOGO_SBMNU_DISH]);								$this->setprmdisc_submnu_name($record['submnu_name']);				$this->setprmdisc_dish_name($record['dish_name']);								$this->setprmdisc_disc_amt_type($record[PRMDISC_DISC_AMT_TYPE]);				$this->setprmdisc_disc_amt($record[PRMDISC_DISC_AMT]);				$this->setprmdisc_start_date($record[PRMDISC_START_DATE]);				$this->setprmdisc_end_date($record[PRMDISC_END_DATE]);				$this->settbl_prom_discounts_active_date($record[TBL_PROM_DISCOUNTS_ACTIVE_DATE]);				$this->settbl_prom_discounts_deactive_date($record[TBL_PROM_DISCOUNTS_DEACTIVE_DATE]);												return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1) {		global $tbl_prom_discounts_active_condition;		//$qry = "SELECT *".RET."FROM ".TBL_PROM_DISCOUNTS.RET;				$qry = "SELECT dis.*,cn.prmcon_title,s.submnu_name,d.dish_name ".RET.				" FROM ".TBL_PROM_DISCOUNTS." dis ".RET.				" LEFT OUTER JOIN ".TBL_PROM_CONDITIONS." cn ON ".RET.					" cn.`".PRMCON_PROMOTION."`=dis.`".PRMDISC_PROMOTION."` ".RET.				" LEFT OUTER JOIN `tbl_sub_menu` s ON ".RET.					" s.`submnu_id`=dis.`".PRMDISC_BOGO_SBMNU."`".RET.					" LEFT OUTER JOIN `tbl_submenu_dishes` smd ON ".RET.				" smd.`sbmnu_dish_id`=dis.`".PRMDISC_BOGO_SBMNU_DISH."`".RET.					" LEFT OUTER JOIN `tbl_dishes` d ON ".RET.					" d.`dish_id`=smd.`sbmnu_dish_dish`".RET;						$and = "WHERE".RET;					if($array[PRMDISC_ID] != "") {			$qry .= $and.PRMDISC_ID." = '".$array[PRMDISC_ID]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_PROMOTION] != "") {		  //echo 'in now..';			$qry .= $and.PRMDISC_PROMOTION." = '".$array[PRMDISC_PROMOTION]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_CONDITION] != "") {			$qry .= $and.PRMDISC_CONDITION." = '".$array[PRMDISC_CONDITION]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_BOGO_QTY] != "") {			$qry .= $and.PRMDISC_BOGO_QTY." = '".$array[PRMDISC_BOGO_QTY]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_BOGO_SBMNU] != "") {			$qry .= $and.PRMDISC_BOGO_SBMNU." = '".$array[PRMDISC_BOGO_SBMNU]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_BOGO_SBMNU_DISH] != "") {			$qry .= $and.PRMDISC_BOGO_SBMNU_DISH." = '".$array[PRMDISC_BOGO_SBMNU_DISH]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_DISC_AMT_TYPE] != "") {			$qry .= $and.PRMDISC_DISC_AMT_TYPE." = '".$array[PRMDISC_DISC_AMT_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_DISC_AMT] != "") {			$qry .= $and.PRMDISC_DISC_AMT." = '".$array[PRMDISC_DISC_AMT]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_START_DATE] != "") {			$qry .= $and.PRMDISC_START_DATE." = '".$array[PRMDISC_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_END_DATE] != "") {			$qry .= $and.PRMDISC_END_DATE." = '".$array[PRMDISC_END_DATE]."'".RET;			$and = "AND".RET;		}		if(is_gt_zero_num($array["isActive"])) {			$qry .= $and.$tbl_prom_discounts_active_condition;;			$and = "AND".RET;		}		if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {		$qry .=" ORDER BY ".$array[SORT_ON]." ".$array[SORT_BY];		}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry." LIMIT ".$array[OFFSET_TITLE].",".$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		}		//echo $qry_with_limit;		$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		if($r1){			$result_found = mysql_num_rows($r1);		}		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_PROM_DISCOUNTS_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_PROM_DISCOUNTS_DEACTIVE_DATE]))== false)){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_PROM_DISCOUNTS_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}				if($isArray){					$class_object = array();					$class_object["prmdisc_id"]=$record[PRMDISC_ID];					$class_object["prmdisc_promotion"]=$record[PRMDISC_PROMOTION];					$class_object["prmdisc_condition"]=$record[PRMDISC_CONDITION];					$class_object["prmdisc_condition_title"]=$record['prmcon_title'];										$class_object["prmdisc_bogo_qty"]=$record[PRMDISC_BOGO_QTY];					$class_object["prmdisc_bogo_sbmnu"]=$record[PRMDISC_BOGO_SBMNU];					$class_object["prmdisc_bogo_sbmnu_dish"]=$record[PRMDISC_BOGO_SBMNU_DISH];										$class_object["prmdisc_submnu_name"]=$record['submnu_name'];					$class_object["prmdisc_dish_name"]=$record['dish_name'];										$class_object["prmdisc_disc_amt_type"]=$record[PRMDISC_DISC_AMT_TYPE];					$class_object["prmdisc_disc_amt"]=$record[PRMDISC_DISC_AMT];					$class_object["prmdisc_start_date"]=$record[PRMDISC_START_DATE];					$class_object["prmdisc_end_date"]=$record[PRMDISC_END_DATE];					$class_object["isActive"]=$isActive;				}else{					$class_object = new tbl_prom_discounts();					$class_object->setprmdisc_id($record[PRMDISC_ID]);					$class_object->setprmdisc_promotion($record[PRMDISC_PROMOTION]);					$class_object->setprmdisc_condition($record[PRMDISC_CONDITION]);					$class_object->setprmdisc_condition_title($record['prmcon_title']);										$class_object->setprmdisc_bogo_qty($record[PRMDISC_BOGO_QTY]);					$class_object->setprmdisc_bogo_sbmnu($record[PRMDISC_BOGO_SBMNU]);					$class_object->setprmdisc_bogo_sbmnu_dish($record[PRMDISC_BOGO_SBMNU_DISH]);										$class_object->setprmdisc_submnu_name($record['submnu_name']);					$class_object->setprmdisc_dish_name($record['dish_name']);									$class_object->setprmdisc_disc_amt_type($record[PRMDISC_DISC_AMT_TYPE]);					$class_object->setprmdisc_disc_amt($record[PRMDISC_DISC_AMT]);					$class_object->setprmdisc_start_date($record[PRMDISC_START_DATE]);					$class_object->setprmdisc_end_date($record[PRMDISC_END_DATE]);				}				$class_objects[$record[PRMDISC_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->getprmdisc_id() != '') {			$qry  = "UPDATE ".TBL_PROM_DISCOUNTS.RET."SET".RET."			".PRMDISC_ID." = '".$this->getprmdisc_id()."',".RET."			".PRMDISC_PROMOTION." = '".$this->getprmdisc_promotion()."',".RET."			".PRMDISC_CONDITION." = '".$this->getprmdisc_condition()."',".RET."			".PRMDISC_BOGO_QTY." = '".$this->getprmdisc_bogo_qty()."',".RET."			".PRMDISC_BOGO_SBMNU." = '".$this->getprmdisc_bogo_sbmnu()."',".RET."			".PRMDISC_BOGO_SBMNU_DISH." = '".$this->getprmdisc_bogo_sbmnu_dish()."',".RET."			".PRMDISC_DISC_AMT_TYPE." = '".$this->getprmdisc_disc_amt_type()."',".RET."			".PRMDISC_DISC_AMT." = '".$this->getprmdisc_disc_amt()."',".RET."			".PRMDISC_START_DATE." = '".$this->getprmdisc_start_date()."',".RET."			".PRMDISC_END_DATE." = '".$this->getprmdisc_end_date()."'".RET.			"WHERE ".PRMDISC_ID." = ".$this->getprmdisc_id().RET;			     //echo $qry;exit;			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_PROM_DISCOUNTS." (".RET.			"".PRMDISC_PROMOTION.", ".PRMDISC_CONDITION.", ".PRMDISC_BOGO_QTY.", ".PRMDISC_BOGO_SBMNU.", ".PRMDISC_BOGO_SBMNU_DISH.", ".PRMDISC_DISC_AMT_TYPE.", ".PRMDISC_DISC_AMT.", ".PRMDISC_START_DATE.", ".PRMDISC_END_DATE.RET.				") VALUES (".RET.			"'".$this->getprmdisc_promotion()."',".RET.			"'".$this->getprmdisc_condition()."',".RET.			"'".$this->getprmdisc_bogo_qty()."',".RET.			"'".$this->getprmdisc_bogo_sbmnu()."',".RET.			"'".$this->getprmdisc_bogo_sbmnu_dish()."',".RET.			"'".$this->getprmdisc_disc_amt_type()."',".RET.			"'".$this->getprmdisc_disc_amt()."',".RET.			"'".$this->getprmdisc_start_date()."',".RET.			"'".$this->getprmdisc_end_date()."'".RET.			")".RET;     //echo $qry;exit;			$res = mysql_query($qry);			$this->setprmdisc_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_PROM_DISCOUNTS.RET;		$and = "WHERE".RET;		if($array[PRMDISC_ID] != "") {			$qry .= $and.PRMDISC_ID." IN (".$array[PRMDISC_ID].")".RET;			$and = "AND".RET;		}		if($array[PRMDISC_PROMOTION] != "") {			$qry .= $and.PRMDISC_PROMOTION." = '".$array[PRMDISC_PROMOTION]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_CONDITION] != "") {			$qry .= $and.PRMDISC_CONDITION." = '".$array[PRMDISC_CONDITION]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_BOGO_QTY] != "") {			$qry .= $and.PRMDISC_BOGO_QTY." = '".$array[PRMDISC_BOGO_QTY]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_BOGO_SBMNU] != "") {			$qry .= $and.PRMDISC_BOGO_SBMNU." = '".$array[PRMDISC_BOGO_SBMNU]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_BOGO_SBMNU_DISH] != "") {			$qry .= $and.PRMDISC_BOGO_SBMNU_DISH." = '".$array[PRMDISC_BOGO_SBMNU_DISH]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_DISC_AMT_TYPE] != "") {			$qry .= $and.PRMDISC_DISC_AMT_TYPE." = '".$array[PRMDISC_DISC_AMT_TYPE]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_DISC_AMT] != "") {			$qry .= $and.PRMDISC_DISC_AMT." = '".$array[PRMDISC_DISC_AMT]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_START_DATE] != "") {			$qry .= $and.PRMDISC_START_DATE." = '".$array[PRMDISC_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[PRMDISC_END_DATE] != "") {			$qry .= $and.PRMDISC_END_DATE." = '".$array[PRMDISC_END_DATE]."'".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($prmdisc_promotion ,$prmdisc_condition ,$prmdisc_bogo_qty ,$prmdisc_bogo_sbmnu ,$prmdisc_bogo_sbmnu_dish ,$prmdisc_disc_amt_type ,$prmdisc_disc_amt  ) {		$unique_arr = array();			//$unique_arr[PRMDISC_ID]=$prmdisc_id;			$unique_arr[PRMDISC_PROMOTION]=$prmdisc_promotion;			$unique_arr[PRMDISC_CONDITION]=$prmdisc_condition;			//$unique_arr[PRMDISC_BOGO_QTY]=$prmdisc_bogo_qty;			//$unique_arr[PRMDISC_BOGO_SBMNU]=$prmdisc_bogo_sbmnu;			//$unique_arr[PRMDISC_BOGO_SBMNU_DISH]=$prmdisc_bogo_sbmnu_dish;			//$unique_arr[PRMDISC_DISC_AMT_TYPE]=$prmdisc_disc_amt_type;			//$unique_arr[PRMDISC_DISC_AMT]=$prmdisc_disc_amt;			//$unique_arr[PRMDISC_START_DATE]=$prmdisc_start_date;			//$unique_arr[PRMDISC_END_DATE]=$prmdisc_end_date;		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($prmdisc_promotion ,$prmdisc_condition ,$prmdisc_bogo_qty ,$prmdisc_bogo_sbmnu ,$prmdisc_bogo_sbmnu_dish ,$prmdisc_disc_amt_type ,$prmdisc_disc_amt) {		if(is_not_empty($prmdisc_promotion)){			if($this->isAlreadyThere($prmdisc_promotion ,$prmdisc_condition ,$prmdisc_bogo_qty ,$prmdisc_bogo_sbmnu ,$prmdisc_bogo_sbmnu_dish ,$prmdisc_disc_amt_type ,$prmdisc_disc_amt )){				return OPERATION_DUPLICATE;			}else{				$this->setprmdisc_id("");				$this->setprmdisc_promotion($prmdisc_promotion);				$this->setprmdisc_condition($prmdisc_condition);				$this->setprmdisc_bogo_qty($prmdisc_bogo_qty);				$this->setprmdisc_bogo_sbmnu($prmdisc_bogo_sbmnu);				$this->setprmdisc_bogo_sbmnu_dish($prmdisc_bogo_sbmnu_dish);				$this->setprmdisc_disc_amt_type($prmdisc_disc_amt_type);				$this->setprmdisc_disc_amt($prmdisc_disc_amt);				$this->setprmdisc_start_date(date(DATE_FORMAT));				$this->insert();				return $this->getprmdisc_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($prmdisc_id, $prmdisc_promotion, $prmdisc_condition, $prmdisc_bogo_qty, $prmdisc_bogo_sbmnu, $prmdisc_bogo_sbmnu_dish, $prmdisc_disc_amt_type, $prmdisc_disc_amt, $prmdisc_start_date, $prmdisc_end_date) {		if(is_gt_zero_num($prmdisc_id)){			if ($this->readObject(array(PRMDISC_ID=>$prmdisc_id))){				$this->setprmdisc_promotion($prmdisc_promotion);				$this->setprmdisc_condition($prmdisc_condition);				$this->setprmdisc_bogo_qty($prmdisc_bogo_qty);				$this->setprmdisc_bogo_sbmnu($prmdisc_bogo_sbmnu);				$this->setprmdisc_bogo_sbmnu_dish($prmdisc_bogo_sbmnu_dish);				$this->setprmdisc_disc_amt_type($prmdisc_disc_amt_type);				$this->setprmdisc_disc_amt($prmdisc_disc_amt);				$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update	public function activate($prmdisc_id){		if(is_gt_zero_num($prmdisc_id)){			if ($this->readObject(array(PRMDISC_ID=>$prmdisc_id))){				$qry  = "UPDATE ".TBL_PROM_DISCOUNTS.RET."SET".RET."			".TBL_PROM_DISCOUNTS_DEACTIVE_DATE." = '".date(EMPTY_DATE_FORMAT)."' WHERE ".PRMDISC_ID."={$prmdisc_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end activate	public function deactivate($prmdisc_id){		if(is_gt_zero_num($prmdisc_id)){			if ($this->readObject(array(PRMDISC_ID=>$prmdisc_id))){				$qry  = "UPDATE ".TBL_PROM_DISCOUNTS.RET."SET".RET."			".TBL_PROM_DISCOUNTS_DEACTIVE_DATE." = '".date(DATE_FORMAT)."' WHERE ".PRMDISC_ID."={$prmdisc_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end deactivate	public static function GetInfo($prmdisc_id) {		$info = array();		if($prmdisc_id != ""){			$obj_tbl_prom_discounts = new tbl_prom_discounts();			if($obj_tbl_prom_discounts->readObject(array("prmdisc_id"=>$prmdisc_id))){				$info["prmdisc_id"]=$obj_tbl_prom_discounts->getprmdisc_id();				$info["prmdisc_promotion"]=$obj_tbl_prom_discounts->getprmdisc_promotion();				$info["prmdisc_condition"]=$obj_tbl_prom_discounts->getprmdisc_condition();				$info["prmdisc_condition_title"]=$obj_tbl_prom_discounts->getprmdisc_condition_title();												$info["prmdisc_bogo_qty"]=$obj_tbl_prom_discounts->getprmdisc_bogo_qty();								$info["prmdisc_bogo_sbmnu"]=$obj_tbl_prom_discounts->getprmdisc_bogo_sbmnu();				$info["prmdisc_bogo_sbmnu_dish"]=$obj_tbl_prom_discounts->getprmdisc_bogo_sbmnu_dish();								$info['prmdisc_submnu_name']=$obj_tbl_prom_discounts->getprmdisc_submnu_name();				$info['prmdisc_dish_name']=$obj_tbl_prom_discounts->getprmdisc_dish_name();								$info["prmdisc_disc_amt_type"]=$obj_tbl_prom_discounts->getprmdisc_disc_amt_type();				$info["prmdisc_disc_amt"]=$obj_tbl_prom_discounts->getprmdisc_disc_amt();				$info["prmdisc_start_date"]=$obj_tbl_prom_discounts->getprmdisc_start_date();				$info["prmdisc_end_date"]=$obj_tbl_prom_discounts->getprmdisc_end_date();				$info["isActive"] = 0;								//..check deactive date is not set or 0				if((is_not_empty($obj_tbl_prom_discounts->gettbl_prom_discounts_deactive_date())==false)  || (is_gt_zero_num(strtotime($obj_tbl_prom_discounts->gettbl_prom_discounts_deactive_date()))== false)){					$info["isActive"] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($obj_tbl_prom_discounts->gettbl_prom_discounts_deactive_date()) > strtotime(date(DATE_FORMAT))){						$info["isActive"] = 1;					}				}			}		unset($obj_tbl_prom_discounts);		return $info;		}	}//..End GetInfo		public static function getPromDiscountByPromotion($promotion){	  return DB::ExecScalarQry('SELECT IFNULL('.PRMDISC_ID.',0) FROM '.TBL_PROM_DISCOUNTS.' WHERE '.PRMDISC_PROMOTION.'='.$promotion);	 	}	public static function GetFields($data){		global $tbl_prom_discounts_active_condition;		$arr = array();		if(is_not_empty($data)){			$qry ="SELECT ".$data['key_field'].",".$data['value_field']." FROM ".TBL_PROM_DISCOUNTS."";			if(is_gt_zero_num($data['isActive'])){				$qry .= " WHERE ".$tbl_prom_discounts_active_condition;			}			$res = mysql_query($qry); 			if($res){				while($row=mysql_fetch_assoc($res)){					$arr[$row[$data['key_field']]] = $row[$data['value_field']];				}			}		}		return $arr;	}//.. End of GetFields}//..End tbl_prom_discounts?>