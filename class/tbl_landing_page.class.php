<?php/**********************************************************************tbl_landing_page.class.phpGenerated by STRUCTY 2014.12.08 09:08:49.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define("TBL_LANDING_PAGE", "tbl_landing_page"); define('LND_PG_ID', 'lnd_pg_id'); define('LND_PG_RESTAURANT', 'lnd_pg_restaurant'); define('LND_PG_BACKGROUND', 'lnd_pg_background'); define('LND_PG_BACKGROUND_COLOR', 'lnd_pg_background_color');define('LND_PG_MENU', 'lnd_pg_menu'); define('LND_PG_PROMOTION', 'lnd_pg_promotion'); define('LND_PG_LOYALTY', 'lnd_pg_loyalty'); define('LND_PG_CONNECT', 'lnd_pg_connect'); define('LND_PG_REVIEWS', 'lnd_pg_reviews'); define('LND_PG_SERVICE_REQ', 'lnd_pg_service_req'); define('LND_PG_LBL_MENU', 'lnd_pg_lbl_menu'); define('LND_PG_LBL_PROMOTION', 'lnd_pg_lbl_promotion'); define('LND_PG_LBL_LOYALTY', 'lnd_pg_lbl_loyalty'); define('LND_PG_LBL_CONNECT', 'lnd_pg_lbl_connect'); define('LND_PG_LBL_REVIEWS', 'lnd_pg_lbl_reviews'); define('LND_PG_LBL_SERVICE_REQ', 'lnd_pg_lbl_service_req'); define('LND_PG_LBL_FONT_COLOR', 'lnd_pg_lbl_font_color'); define('LND_PG_START_DATE', 'lnd_pg_start_date'); define('LND_PG_END_DATE', 'lnd_pg_end_date'); define("TBL_LANDING_PAGE_ACTIVE_DATE",  LND_PG_START_DATE);define("TBL_LANDING_PAGE_DEACTIVE_DATE",  LND_PG_END_DATE);$tbl_landing_page_active_condition= " (".TBL_LANDING_PAGE_DEACTIVE_DATE." is NULL OR ".TBL_LANDING_PAGE_DEACTIVE_DATE." = 0 OR ".TBL_LANDING_PAGE_DEACTIVE_DATE." > CURDATE( )) ";class tbl_landing_page {	private $lnd_pg_id;	private $lnd_pg_restaurant;	private $lnd_pg_background;		private $lnd_pg_background_color;		private $lnd_pg_menu;	private $lnd_pg_promotion;	private $lnd_pg_loyalty;	private $lnd_pg_connect;	private $lnd_pg_reviews;	private $lnd_pg_service_req;		private $lnd_pg_lbl_menu;	private $lnd_pg_lbl_promotion;	private $lnd_pg_lbl_loyalty;	private $lnd_pg_lbl_connect;	private $lnd_pg_lbl_reviews;	private $lnd_pg_lbl_service_req;	private $lnd_pg_lbl_font_color;		private $lnd_pg_start_date;	private $lnd_pg_end_date;	private $tbl_landing_page_active_date;	private $tbl_landing_page_deactive_date;	public function setlnd_pg_id($pArg="0") {$this->lnd_pg_id=$pArg;}	public function setlnd_pg_restaurant($pArg="0") {$this->lnd_pg_restaurant=$pArg;}	public function setlnd_pg_background($pArg="0") {$this->lnd_pg_background=$pArg;}		public function setlnd_pg_background_color($pArg="0") {$this->lnd_pg_background_color=$pArg;}			public function setlnd_pg_menu($pArg="0") {$this->lnd_pg_menu=$pArg;}	public function setlnd_pg_promotion($pArg="0") {$this->lnd_pg_promotion=$pArg;}	public function setlnd_pg_loyalty($pArg="0") {$this->lnd_pg_loyalty=$pArg;}	public function setlnd_pg_connect($pArg="0") {$this->lnd_pg_connect=$pArg;}	public function setlnd_pg_reviews($pArg="0") {$this->lnd_pg_reviews=$pArg;}	public function setlnd_pg_service_req($pArg="0") {$this->lnd_pg_service_req=$pArg;}		public function setlnd_pg_lbl_menu($pArg="0") {$this->lnd_pg_lbl_menu=$pArg;}	public function setlnd_pg_lbl_promotion($pArg="0") {$this->lnd_pg_lbl_promotion=$pArg;}	public function setlnd_pg_lbl_loyalty($pArg="0") {$this->lnd_pg_lbl_loyalty=$pArg;}	public function setlnd_pg_lbl_connect($pArg="0") {$this->lnd_pg_lbl_connect=$pArg;}	public function setlnd_pg_lbl_reviews($pArg="0") {$this->lnd_pg_lbl_reviews=$pArg;}	public function setlnd_pg_lbl_service_req($pArg="0") {$this->lnd_pg_lbl_service_req=$pArg;}	public function setlnd_pg_lbl_font_color($pArg="0") {$this->lnd_pg_lbl_font_color=$pArg;}		public function setlnd_pg_start_date($pArg="0") {$this->lnd_pg_start_date=$pArg;}	public function setlnd_pg_end_date($pArg="0") {$this->lnd_pg_end_date=$pArg;}	public function settbl_landing_page_active_date($pArg="0") {$this->tbl_landing_page_active_date=$pArg;}	public function settbl_landing_page_deactive_date($pArg="0") {$this->tbl_landing_page_deactive_date=$pArg;}	public function getlnd_pg_id() {return $this->lnd_pg_id;}	public function getlnd_pg_restaurant() {return $this->lnd_pg_restaurant;}	public function getlnd_pg_background() {return $this->lnd_pg_background;}		public function getlnd_pg_background_color() {return $this->lnd_pg_background_color;}		public function getlnd_pg_menu() {return $this->lnd_pg_menu;}	public function getlnd_pg_promotion() {return $this->lnd_pg_promotion;}	public function getlnd_pg_loyalty() {return $this->lnd_pg_loyalty;}	public function getlnd_pg_connect() {return $this->lnd_pg_connect;}	public function getlnd_pg_reviews() {return $this->lnd_pg_reviews;}	public function getlnd_pg_service_req() {return $this->lnd_pg_service_req;}		public function getlnd_pg_lbl_menu() {return $this->lnd_pg_lbl_menu;}	public function getlnd_pg_lbl_promotion() {return $this->lnd_pg_lbl_promotion;}	public function getlnd_pg_lbl_loyalty() {return $this->lnd_pg_lbl_loyalty;}	public function getlnd_pg_lbl_connect() {return $this->lnd_pg_lbl_connect;}	public function getlnd_pg_lbl_reviews() {return $this->lnd_pg_lbl_reviews;}	public function getlnd_pg_lbl_service_req() {return $this->lnd_pg_lbl_service_req;}	public function getlnd_pg_lbl_font_color() {return $this->lnd_pg_lbl_font_color;}		public function getlnd_pg_start_date() {return $this->lnd_pg_start_date;}	public function getlnd_pg_end_date() {return $this->lnd_pg_end_date;}	public function gettbl_landing_page_active_date($pArg="0") {return $this->tbl_landing_page_active_date;}	public function gettbl_landing_page_deactive_date($pArg="0") {return $this->tbl_landing_page_deactive_date;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".TBL_LANDING_PAGE.RET;		$and = "WHERE".RET;		if($array[LND_PG_ID] != "") {			$qry .= $and.LND_PG_ID." = '".$array[LND_PG_ID]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_RESTAURANT] != "") {			$qry .= $and.LND_PG_RESTAURANT." = '".$array[LND_PG_RESTAURANT]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_BACKGROUND] != "") {			$qry .= $and.LND_PG_BACKGROUND." = '".$array[LND_PG_BACKGROUND]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_MENU] != "") {			$qry .= $and.LND_PG_MENU." = '".$array[LND_PG_MENU]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_PROMOTION] != "") {			$qry .= $and.LND_PG_PROMOTION." = '".$array[LND_PG_PROMOTION]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LOYALTY] != "") {			$qry .= $and.LND_PG_LOYALTY." = '".$array[LND_PG_LOYALTY]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_CONNECT] != "") {			$qry .= $and.LND_PG_CONNECT." = '".$array[LND_PG_CONNECT]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_REVIEWS] != "") {			$qry .= $and.LND_PG_REVIEWS." = '".$array[LND_PG_REVIEWS]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_SERVICE_REQ] != "") {			$qry .= $and.LND_PG_SERVICE_REQ." = '".$array[LND_PG_SERVICE_REQ]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_MENU] != "") {			$qry .= $and.LND_PG_LBL_MENU." = '".$array[LND_PG_LBL_MENU]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_PROMOTION] != "") {			$qry .= $and.LND_PG_LBL_PROMOTION." = '".$array[LND_PG_LBL_PROMOTION]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_LOYALTY] != "") {			$qry .= $and.LND_PG_LBL_LOYALTY." = '".$array[LND_PG_LBL_LOYALTY]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_CONNECT] != "") {			$qry .= $and.LND_PG_LBL_CONNECT." = '".$array[LND_PG_LBL_CONNECT]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_REVIEWS] != "") {			$qry .= $and.LND_PG_LBL_REVIEWS." = '".$array[LND_PG_LBL_REVIEWS]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_SERVICE_REQ] != "") {			$qry .= $and.LND_PG_LBL_SERVICE_REQ." = '".$array[LND_PG_LBL_SERVICE_REQ]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_FONT_COLOR] != "") {			$qry .= $and.LND_PG_LBL_FONT_COLOR." = '".$array[LND_PG_LBL_FONT_COLOR]."'".RET;			$and = "AND".RET;		}				if($array[LND_PG_START_DATE] != "") {			$qry .= $and.LND_PG_START_DATE." = '".$array[LND_PG_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_END_DATE] != "") {			$qry .= $and.LND_PG_END_DATE." = '".$array[LND_PG_END_DATE]."'".RET;			$and = "AND".RET;		}	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->setlnd_pg_id($record[LND_PG_ID]);				$this->setlnd_pg_restaurant($record[LND_PG_RESTAURANT]);				$this->setlnd_pg_background($record[LND_PG_BACKGROUND]);				$this->setlnd_pg_background_color($record[LND_PG_BACKGROUND_COLOR]);								$this->setlnd_pg_menu($record[LND_PG_MENU]);				$this->setlnd_pg_promotion($record[LND_PG_PROMOTION]);				$this->setlnd_pg_loyalty($record[LND_PG_LOYALTY]);				$this->setlnd_pg_connect($record[LND_PG_CONNECT]);				$this->setlnd_pg_reviews($record[LND_PG_REVIEWS]);				$this->setlnd_pg_service_req($record[LND_PG_SERVICE_REQ]);								$this->setlnd_pg_lbl_menu($record[LND_PG_LBL_MENU]);				$this->setlnd_pg_lbl_promotion($record[LND_PG_LBL_PROMOTION]);				$this->setlnd_pg_lbl_loyalty($record[LND_PG_LBL_LOYALTY]);				$this->setlnd_pg_lbl_connect($record[LND_PG_LBL_CONNECT]);				$this->setlnd_pg_lbl_reviews($record[LND_PG_LBL_REVIEWS]);				$this->setlnd_pg_lbl_service_req($record[LND_PG_LBL_SERVICE_REQ]);				$this->setlnd_pg_lbl_font_color($record[LND_PG_LBL_FONT_COLOR]);								$this->setlnd_pg_start_date($record[LND_PG_START_DATE]);				$this->setlnd_pg_end_date($record[LND_PG_END_DATE]);				$this->settbl_landing_page_active_date($record[TBL_LANDING_PAGE_ACTIVE_DATE]);				$this->settbl_landing_page_deactive_date($record[TBL_LANDING_PAGE_DEACTIVE_DATE]);				return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1) {		global $tbl_landing_page_active_condition;		$qry = "SELECT *".RET."FROM ".TBL_LANDING_PAGE.RET;		$and = "WHERE".RET;		if($array[LND_PG_ID] != "") {			$qry .= $and.LND_PG_ID." = '".$array[LND_PG_ID]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_RESTAURANT] != "") {			$qry .= $and.LND_PG_RESTAURANT." = '".$array[LND_PG_RESTAURANT]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_BACKGROUND] != "") {			$qry .= $and.LND_PG_BACKGROUND." = '".$array[LND_PG_BACKGROUND]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_MENU] != "") {			$qry .= $and.LND_PG_MENU." = '".$array[LND_PG_MENU]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_PROMOTION] != "") {			$qry .= $and.LND_PG_PROMOTION." = '".$array[LND_PG_PROMOTION]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LOYALTY] != "") {			$qry .= $and.LND_PG_LOYALTY." = '".$array[LND_PG_LOYALTY]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_CONNECT] != "") {			$qry .= $and.LND_PG_CONNECT." = '".$array[LND_PG_CONNECT]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_REVIEWS] != "") {			$qry .= $and.LND_PG_REVIEWS." = '".$array[LND_PG_REVIEWS]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_SERVICE_REQ] != "") {			$qry .= $and.LND_PG_SERVICE_REQ." = '".$array[LND_PG_SERVICE_REQ]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_MENU] != "") {			$qry .= $and.LND_PG_LBL_MENU." = '".$array[LND_PG_LBL_MENU]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_PROMOTION] != "") {			$qry .= $and.LND_PG_LBL_PROMOTION." = '".$array[LND_PG_LBL_PROMOTION]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_LOYALTY] != "") {			$qry .= $and.LND_PG_LBL_LOYALTY." = '".$array[LND_PG_LBL_LOYALTY]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_CONNECT] != "") {			$qry .= $and.LND_PG_LBL_CONNECT." = '".$array[LND_PG_LBL_CONNECT]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_REVIEWS] != "") {			$qry .= $and.LND_PG_LBL_REVIEWS." = '".$array[LND_PG_LBL_REVIEWS]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_SERVICE_REQ] != "") {			$qry .= $and.LND_PG_LBL_SERVICE_REQ." = '".$array[LND_PG_LBL_SERVICE_REQ]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LBL_FONT_COLOR] != "") {			$qry .= $and.LND_PG_LBL_FONT_COLOR." = '".$array[LND_PG_LBL_FONT_COLOR]."'".RET;			$and = "AND".RET;		}				if($array[LND_PG_START_DATE] != "") {			$qry .= $and.LND_PG_START_DATE." = '".$array[LND_PG_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_END_DATE] != "") {			$qry .= $and.LND_PG_END_DATE." = '".$array[LND_PG_END_DATE]."'".RET;			$and = "AND".RET;		}		if(is_gt_zero_num($array["isActive"])) {			$qry .= $and.$tbl_landing_page_active_condition;;			$and = "AND".RET;		}		if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {		$qry .=" ORDER BY ".$array[SORT_ON]." ".$array[SORT_BY];		}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry." LIMIT ".$array[OFFSET_TITLE].",".$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		}		$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		if($r1){			$result_found = mysql_num_rows($r1);		}		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_LANDING_PAGE_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_LANDING_PAGE_DEACTIVE_DATE]))== false)){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_LANDING_PAGE_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}				if($isArray){					$class_object = array();					$class_object["lnd_pg_id"]=$record[LND_PG_ID];					$class_object["lnd_pg_restaurant"]=$record[LND_PG_RESTAURANT];					$class_object["lnd_pg_background"]=$record[LND_PG_BACKGROUND];										$class_object["lnd_pg_background_color"]=$record[LND_PG_BACKGROUND_COLOR];										$class_object["lnd_pg_menu"]=$record[LND_PG_MENU];					$class_object["lnd_pg_promotion"]=$record[LND_PG_PROMOTION];					$class_object["lnd_pg_loyalty"]=$record[LND_PG_LOYALTY];					$class_object["lnd_pg_connect"]=$record[LND_PG_CONNECT];					$class_object["lnd_pg_reviews"]=$record[LND_PG_REVIEWS];					$class_object["lnd_pg_service_req"]=$record[LND_PG_SERVICE_REQ];										$class_object["lnd_pg_lbl_menu"]=$record[LND_PG_LBL_MENU];					$class_object["lnd_pg_lbl_promotion"]=$record[LND_PG_LBL_PROMOTION];					$class_object["lnd_pg_lbl_loyalty"]=$record[LND_PG_LBL_LOYALTY];					$class_object["lnd_pg_lbl_connect"]=$record[LND_PG_LBL_CONNECT];					$class_object["lnd_pg_lbl_reviews"]=$record[LND_PG_LBL_REVIEWS];					$class_object["lnd_pg_lbl_service_req"]=$record[LND_PG_LBL_SERVICE_REQ];					$class_object["lnd_pg_lbl_font_color"]=$record[LND_PG_LBL_FONT_COLOR];										$class_object["lnd_pg_start_date"]=$record[LND_PG_START_DATE];					$class_object["lnd_pg_end_date"]=$record[LND_PG_END_DATE];					$class_object["isActive"]=$isActive;				}else{					$class_object = new tbl_landing_page();					$class_object->setlnd_pg_id($record[LND_PG_ID]);					$class_object->setlnd_pg_restaurant($record[LND_PG_RESTAURANT]);					$class_object->setlnd_pg_background($record[LND_PG_BACKGROUND]);										$class_object->setlnd_pg_background_color($record[LND_PG_BACKGROUND_COLOR]);										$class_object->setlnd_pg_menu($record[LND_PG_MENU]);					$class_object->setlnd_pg_promotion($record[LND_PG_PROMOTION]);					$class_object->setlnd_pg_loyalty($record[LND_PG_LOYALTY]);					$class_object->setlnd_pg_connect($record[LND_PG_CONNECT]);					$class_object->setlnd_pg_reviews($record[LND_PG_REVIEWS]);					$class_object->setlnd_pg_service_req($record[LND_PG_SERVICE_REQ]);										$class_object->setlnd_pg_lbl_menu($record[LND_PG_LBL_MENU]);					$class_object->setlnd_pg_lbl_promotion($record[LND_PG_LBL_PROMOTION]);					$class_object->setlnd_pg_lbl_loyalty($record[LND_PG_LBL_LOYALTY]);					$class_object->setlnd_pg_lbl_connect($record[LND_PG_LBL_CONNECT]);					$class_object->setlnd_pg_lbl_reviews($record[LND_PG_LBL_REVIEWS]);					$class_object->setlnd_pg_lbl_service_req($record[LND_PG_LBL_SERVICE_REQ]);					$class_object->setlnd_pg_lbl_font_color($record[LND_PG_LBL_FONT_COLOR]);										$class_object->setlnd_pg_start_date($record[LND_PG_START_DATE]);					$class_object->setlnd_pg_end_date($record[LND_PG_END_DATE]);				}				$class_objects[$record[LND_PG_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->getlnd_pg_id() != '') {			$qry  = "UPDATE ".TBL_LANDING_PAGE.RET."SET".RET."			".LND_PG_ID." = '".$this->getlnd_pg_id()."',".RET."			".LND_PG_RESTAURANT." = '".$this->getlnd_pg_restaurant()."',".RET."			".LND_PG_BACKGROUND." = '".$this->getlnd_pg_background()."',".RET."						".LND_PG_BACKGROUND_COLOR." = '".$this->getlnd_pg_background_color()."',".RET."						".LND_PG_MENU." = '".$this->getlnd_pg_menu()."',".RET."			".LND_PG_PROMOTION." = '".$this->getlnd_pg_promotion()."',".RET."			".LND_PG_LOYALTY." = '".$this->getlnd_pg_loyalty()."',".RET."			".LND_PG_CONNECT." = '".$this->getlnd_pg_connect()."',".RET."			".LND_PG_REVIEWS." = '".$this->getlnd_pg_reviews()."',".RET."			".LND_PG_SERVICE_REQ." = '".$this->getlnd_pg_service_req()."',".RET."						".LND_PG_LBL_MENU." = '".$this->getlnd_pg_lbl_menu()."',".RET."			".LND_PG_LBL_PROMOTION." = '".$this->getlnd_pg_lbl_promotion()."',".RET."			".LND_PG_LBL_LOYALTY." = '".$this->getlnd_pg_lbl_loyalty()."',".RET."			".LND_PG_LBL_CONNECT." = '".$this->getlnd_pg_lbl_connect()."',".RET."			".LND_PG_LBL_REVIEWS." = '".$this->getlnd_pg_lbl_reviews()."',".RET."			".LND_PG_LBL_SERVICE_REQ." = '".$this->getlnd_pg_lbl_service_req()."',".RET."			".LND_PG_LBL_FONT_COLOR." = '".$this->getlnd_pg_lbl_font_color()."',".RET."						".LND_PG_START_DATE." = '".$this->getlnd_pg_start_date()."',".RET."			".LND_PG_END_DATE." = '".$this->getlnd_pg_end_date()."'".RET.			"WHERE ".LND_PG_ID." = ".$this->getlnd_pg_id().RET;			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".TBL_LANDING_PAGE." (".RET.			"".LND_PG_RESTAURANT.", ".LND_PG_BACKGROUND.", ".LND_PG_BACKGROUND_COLOR.", ".LND_PG_MENU.", ".LND_PG_PROMOTION.", ".LND_PG_LOYALTY.", ".LND_PG_CONNECT.", ".LND_PG_REVIEWS.", ".LND_PG_SERVICE_REQ.", ".LND_PG_LBL_MENU.", ".LND_PG_LBL_PROMOTION.", ".LND_PG_LBL_LOYALTY.", ".LND_PG_LBL_CONNECT.", ".LND_PG_LBL_REVIEWS.", ".LND_PG_LBL_SERVICE_REQ.", ".LND_PG_LBL_FONT_COLOR.", ".LND_PG_START_DATE.", ".LND_PG_END_DATE.RET.				") VALUES (".RET.			"'".$this->getlnd_pg_restaurant()."',".RET.			"'".$this->getlnd_pg_background()."',".RET.						"'".$this->getlnd_pg_background_color()."',".RET.						"'".$this->getlnd_pg_menu()."',".RET.			"'".$this->getlnd_pg_promotion()."',".RET.			"'".$this->getlnd_pg_loyalty()."',".RET.			"'".$this->getlnd_pg_connect()."',".RET.			"'".$this->getlnd_pg_reviews()."',".RET.			"'".$this->getlnd_pg_service_req()."',".RET.						"'".$this->getlnd_pg_lbl_menu()."',".RET.			"'".$this->getlnd_pg_lbl_promotion()."',".RET.			"'".$this->getlnd_pg_lbl_loyalty()."',".RET.			"'".$this->getlnd_pg_lbl_connect()."',".RET.			"'".$this->getlnd_pg_lbl_reviews()."',".RET.			"'".$this->getlnd_pg_lbl_service_req()."',".RET.			"'".$this->getlnd_pg_lbl_font_color()."',".RET.						"'".$this->getlnd_pg_start_date()."',".RET.			"'".$this->getlnd_pg_end_date()."'".RET.			")".RET;			$res = mysql_query($qry);			$this->setlnd_pg_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".TBL_LANDING_PAGE.RET;		$and = "WHERE".RET;		if($array[LND_PG_ID] != "") {			$qry .= $and.LND_PG_ID." = '".$array[LND_PG_ID]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_RESTAURANT] != "") {			$qry .= $and.LND_PG_RESTAURANT." = '".$array[LND_PG_RESTAURANT]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_BACKGROUND] != "") {			$qry .= $and.LND_PG_BACKGROUND." = '".$array[LND_PG_BACKGROUND]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_MENU] != "") {			$qry .= $and.LND_PG_MENU." = '".$array[LND_PG_MENU]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_PROMOTION] != "") {			$qry .= $and.LND_PG_PROMOTION." = '".$array[LND_PG_PROMOTION]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_LOYALTY] != "") {			$qry .= $and.LND_PG_LOYALTY." = '".$array[LND_PG_LOYALTY]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_CONNECT] != "") {			$qry .= $and.LND_PG_CONNECT." = '".$array[LND_PG_CONNECT]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_REVIEWS] != "") {			$qry .= $and.LND_PG_REVIEWS." = '".$array[LND_PG_REVIEWS]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_SERVICE_REQ] != "") {			$qry .= $and.LND_PG_SERVICE_REQ." = '".$array[LND_PG_SERVICE_REQ]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_START_DATE] != "") {			$qry .= $and.LND_PG_START_DATE." = '".$array[LND_PG_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[LND_PG_END_DATE] != "") {			$qry .= $and.LND_PG_END_DATE." = '".$array[LND_PG_END_DATE]."'".RET;			$and = "AND".RET;		}		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($lnd_pg_restaurant ,$lnd_pg_background ,$lnd_pg_menu ,$lnd_pg_promotion ,$lnd_pg_loyalty ,$lnd_pg_connect ,$lnd_pg_reviews ,$lnd_pg_service_req ,$lnd_pg_lbl_menu ,$lnd_pg_lbl_promotion ,$lnd_pg_lbl_loyalty ,$lnd_pg_lbl_connect ,$lnd_pg_lbl_reviews ,$lnd_pg_lbl_service_req ,$lnd_pg_lbl_font_color ,$lnd_pg_start_date ,$lnd_pg_end_date) {		$unique_arr = array();			//$unique_arr[LND_PG_ID]=$lnd_pg_id;			$unique_arr[LND_PG_RESTAURANT]=$lnd_pg_restaurant;			//$unique_arr[LND_PG_BACKGROUND]=$lnd_pg_background;			//$unique_arr[LND_PG_MENU]=$lnd_pg_menu;			//$unique_arr[LND_PG_PROMOTION]=$lnd_pg_promotion;			//$unique_arr[LND_PG_LOYALTY]=$lnd_pg_loyalty;			//$unique_arr[LND_PG_CONNECT]=$lnd_pg_connect;			//$unique_arr[LND_PG_REVIEWS]=$lnd_pg_reviews;			//$unique_arr[LND_PG_SERVICE_REQ]=$lnd_pg_service_req;			//$unique_arr[LND_PG_START_DATE]=$lnd_pg_start_date;			//$unique_arr[LND_PG_END_DATE]=$lnd_pg_end_date;		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($lnd_pg_restaurant ,$lnd_pg_background ,$lnd_pg_menu ,$lnd_pg_promotion ,$lnd_pg_loyalty ,$lnd_pg_connect ,$lnd_pg_reviews ,$lnd_pg_service_req ,$lnd_pg_lbl_menu ,$lnd_pg_lbl_promotion ,$lnd_pg_lbl_loyalty ,$lnd_pg_lbl_connect ,$lnd_pg_lbl_reviews ,$lnd_pg_lbl_service_req ,$lnd_pg_lbl_font_color ,$lnd_pg_start_date ,$lnd_pg_end_date,$lnd_pg_background_color) {		if(is_not_empty($lnd_pg_restaurant)){			if($this->isAlreadyThere($lnd_pg_restaurant ,$lnd_pg_background ,$lnd_pg_menu ,$lnd_pg_promotion ,$lnd_pg_loyalty ,$lnd_pg_connect ,$lnd_pg_reviews ,$lnd_pg_service_req ,$lnd_pg_lbl_menu ,$lnd_pg_lbl_promotion ,$lnd_pg_lbl_loyalty ,$lnd_pg_lbl_connect ,$lnd_pg_lbl_reviews ,$lnd_pg_lbl_service_req ,$lnd_pg_lbl_font_color ,$lnd_pg_start_date ,$lnd_pg_end_date)){				return OPERATION_DUPLICATE;			}else{				$this->setlnd_pg_id("");				$this->setlnd_pg_restaurant($lnd_pg_restaurant);				$this->setlnd_pg_background($lnd_pg_background);								$this->setlnd_pg_background_color($lnd_pg_background_color);								$this->setlnd_pg_menu($lnd_pg_menu);				$this->setlnd_pg_promotion($lnd_pg_promotion);				$this->setlnd_pg_loyalty($lnd_pg_loyalty);				$this->setlnd_pg_connect($lnd_pg_connect);				$this->setlnd_pg_reviews($lnd_pg_reviews);				$this->setlnd_pg_service_req($lnd_pg_service_req);				$this->setlnd_pg_start_date(date(DATE_FORMAT));								$this->setlnd_pg_lbl_menu($lnd_pg_lbl_menu);				$this->setlnd_pg_lbl_promotion($lnd_pg_lbl_promotion);				$this->setlnd_pg_lbl_loyalty($lnd_pg_lbl_loyalty);				$this->setlnd_pg_lbl_connect($lnd_pg_lbl_connect);				$this->setlnd_pg_lbl_reviews($lnd_pg_lbl_reviews);				$this->setlnd_pg_lbl_service_req($lnd_pg_lbl_service_req);				$this->setlnd_pg_lbl_font_color($lnd_pg_lbl_font_color);								$this->insert();				return $this->getlnd_pg_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($lnd_pg_id, $lnd_pg_restaurant, $lnd_pg_background, $lnd_pg_menu, $lnd_pg_promotion, $lnd_pg_loyalty, $lnd_pg_connect, $lnd_pg_reviews, $lnd_pg_service_req,$lnd_pg_lbl_menu ,$lnd_pg_lbl_promotion ,$lnd_pg_lbl_loyalty ,$lnd_pg_lbl_connect ,$lnd_pg_lbl_reviews ,$lnd_pg_lbl_service_req ,$lnd_pg_lbl_font_color , $lnd_pg_start_date, $lnd_pg_end_date,$lnd_pg_background_color) {		if(is_gt_zero_num($lnd_pg_id)){			if ($this->readObject(array(LND_PG_ID=>$lnd_pg_id))){				$this->setlnd_pg_restaurant($lnd_pg_restaurant);				if($lnd_pg_background!='')					$this->setlnd_pg_background($lnd_pg_background);				if($lnd_pg_menu!='')					$this->setlnd_pg_menu($lnd_pg_menu);				if($lnd_pg_promotion!='')					$this->setlnd_pg_promotion($lnd_pg_promotion);				if($lnd_pg_loyalty!='')						$this->setlnd_pg_loyalty($lnd_pg_loyalty);				if($lnd_pg_connect!='')					$this->setlnd_pg_connect($lnd_pg_connect);				if($lnd_pg_reviews!='')					$this->setlnd_pg_reviews($lnd_pg_reviews);				if($lnd_pg_service_req!='')					$this->setlnd_pg_service_req($lnd_pg_service_req);									$this->setlnd_pg_lbl_menu($lnd_pg_lbl_menu);				$this->setlnd_pg_lbl_promotion($lnd_pg_lbl_promotion);				$this->setlnd_pg_lbl_loyalty($lnd_pg_lbl_loyalty);				$this->setlnd_pg_lbl_connect($lnd_pg_lbl_connect);				$this->setlnd_pg_lbl_reviews($lnd_pg_lbl_reviews);				$this->setlnd_pg_lbl_service_req($lnd_pg_lbl_service_req);				$this->setlnd_pg_lbl_font_color($lnd_pg_lbl_font_color);								$this->setlnd_pg_background_color($lnd_pg_background_color);									$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update	public function activate($lnd_pg_id){		if(is_gt_zero_num($lnd_pg_id)){			if ($this->readObject(array(LND_PG_ID=>$lnd_pg_id))){				$qry  = "UPDATE ".TBL_LANDING_PAGE.RET."SET".RET."			".TBL_LANDING_PAGE_DEACTIVE_DATE." = '".date(EMPTY_DATE_FORMAT)."' WHERE ".LND_PG_ID."={$lnd_pg_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end activate	public function deactivate($lnd_pg_id){		if(is_gt_zero_num($lnd_pg_id)){			if ($this->readObject(array(LND_PG_ID=>$lnd_pg_id))){				$qry  = "UPDATE ".TBL_LANDING_PAGE.RET."SET".RET."			".TBL_LANDING_PAGE_DEACTIVE_DATE." = '".date(DATE_FORMAT)."' WHERE ".LND_PG_ID."={$lnd_pg_id}";				$res = mysql_query($qry);				if($res){					return 1;				}			}		}		return 0;	}//..end deactivate	public static function GetInfo($lnd_pg_id=0,$lnd_pg_restaurant=0) {			$arr = array(); 		$info = array();		if(is_gt_zero_num($lnd_pg_restaurant)){			 $arr['lnd_pg_restaurant'] = $lnd_pg_restaurant;		}		if(is_gt_zero_num($lnd_pg_id)){			 $arr['lnd_pg_id'] = $lnd_pg_id;		}					 				//$info = array();		//if($lnd_pg_id != ""){		if(is_not_empty($arr)){ 			$obj_tbl_landing_page = new tbl_landing_page();			//if($obj_tbl_landing_page->readObject(array("lnd_pg_id"=>$lnd_pg_id))){			if($obj_tbl_landing_page->readObject($arr)){				$info["lnd_pg_id"]=$obj_tbl_landing_page->getlnd_pg_id();				$info["lnd_pg_restaurant"]=$obj_tbl_landing_page->getlnd_pg_restaurant();				$info["lnd_pg_background"]=$obj_tbl_landing_page->getlnd_pg_background();								$info["lnd_pg_background_color"]=$obj_tbl_landing_page->getlnd_pg_background_color();								$info["lnd_pg_menu"]=$obj_tbl_landing_page->getlnd_pg_menu();				$info["lnd_pg_promotion"]=$obj_tbl_landing_page->getlnd_pg_promotion();				$info["lnd_pg_loyalty"]=$obj_tbl_landing_page->getlnd_pg_loyalty();				$info["lnd_pg_connect"]=$obj_tbl_landing_page->getlnd_pg_connect();				$info["lnd_pg_reviews"]=$obj_tbl_landing_page->getlnd_pg_reviews();				$info["lnd_pg_service_req"]=$obj_tbl_landing_page->getlnd_pg_service_req();								$info["lnd_pg_lbl_menu"]=$obj_tbl_landing_page->getlnd_pg_lbl_menu();				$info["lnd_pg_lbl_promotion"]=$obj_tbl_landing_page->getlnd_pg_lbl_promotion();				$info["lnd_pg_lbl_loyalty"]=$obj_tbl_landing_page->getlnd_pg_lbl_loyalty();				$info["lnd_pg_lbl_connect"]=$obj_tbl_landing_page->getlnd_pg_lbl_connect();				$info["lnd_pg_lbl_reviews"]=$obj_tbl_landing_page->getlnd_pg_lbl_reviews();				$info["lnd_pg_lbl_service_req"]=$obj_tbl_landing_page->getlnd_pg_lbl_service_req();				$info["lnd_pg_lbl_font_color"]=$obj_tbl_landing_page->getlnd_pg_lbl_font_color();								$info["lnd_pg_start_date"]=$obj_tbl_landing_page->getlnd_pg_start_date();				$info["lnd_pg_end_date"]=$obj_tbl_landing_page->getlnd_pg_end_date();				$info["isActive"] = 0;				//..check deactive date is not set or 0				if((is_not_empty($obj_tbl_landing_page->gettbl_landing_page_deactive_date())==false)  || (is_gt_zero_num(strtotime($obj_tbl_landing_page->gettbl_landing_page_deactive_date()))== false)){					$info["isActive"] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($obj_tbl_landing_page->gettbl_landing_page_deactive_date()) > strtotime(date(DATE_FORMAT))){						$info["isActive"] = 1;					}				}			}		unset($obj_tbl_landing_page);		return $info;		}	}//..End GetInfo	public static function GetFields($data){		global $tbl_landing_page_active_condition;		$arr = array();		if(is_not_empty($data)){			$qry ="SELECT ".$data['key_field'].",".$data['value_field']." FROM ".TBL_LANDING_PAGE."";			if(is_gt_zero_num($data['isActive'])){				$qry .= " WHERE ".$tbl_landing_page_active_condition;			}			$res = mysql_query($qry); 			if($res){				while($row=mysql_fetch_assoc($res)){					$arr[$row[$data['key_field']]] = $row[$data['value_field']];				}			}		}		return $arr;	}//.. End of GetFields		public static function save_land_pg_images($tmpFILES,$_fld_name,$lnd_pg_id,$action){		$err='';		$_fl_under_consider='';		if((isset($tmpFILES["{$_fld_name}"])) && (is_not_empty($tmpFILES["{$_fld_name}"]['name']))){			$save_path=PATHROOT.LAND_PG_UPLOAD_PATH;			$file_save_nm=time().'_'.$tmpFILES["{$_fld_name}"]['name'];				//now save the new file			$sv_fl_rslt=SaveFile($tmpFILES,$_fld_name,$save_path,$file_save_nm);			if($sv_fl_rslt==1){				$_fl_under_consider=$file_save_nm;						if($action==ACTION_UPDATE){					//..Delete previous file					tbl_landing_page::delete_if_prev_image($lnd_pg_id,$_fld_name,$save_path);				}				//..Everything OK database insert/update will ok from here			}else{						$_SESSION[SES_FLASH_MSG] .= '<div class="info">'.$sv_fl_rslt.'</div>';			}			}		return $_fl_under_consider;}			public static function delete_if_prev_image($lnd_pg_id,$field,$save_path="") {		if(is_gt_zero_num(lnd_pg_id) && is_not_empty($field)){			$obj_tbl_landing_page = new tbl_landing_page();			$_rec_ar=$obj_tbl_landing_page->readArray(array(LND_PG_ID=>$lnd_pg_id));						if(is_not_empty($_rec_ar)){				$_rec_ar=array_shift($_rec_ar);								$rec_img=$_rec_ar["{$field}"];				if(is_not_empty($rec_img))					unlink($save_path.$rec_img);			}		}			}//..deletePrevlnd_pg_background 		public static function delete_image_associated($lnd_pg_id,$field) {			$qry  = "UPDATE ".TBL_LANDING_PAGE.RET."SET".RET."			`{$field}`='' WHERE `".LND_PG_ID."`={$lnd_pg_id}";				$res = mysql_query($qry);	}//..			}//..End tbl_landing_page?>