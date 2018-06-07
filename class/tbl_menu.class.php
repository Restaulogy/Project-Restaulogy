<?php/**********************************************************************tbl_menu.class.phpGenerated by STRUCTY 2013.04.11 10:41:38.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define('TBL_MENU', 'tbl_menu'); define('MENU_ID', 'menu_id'); define('MENU_NAME', 'menu_name'); define('MENU_CATEGORY', 'menu_category'); define('MENU_DESC', 'menu_desc'); define('MENU_IMAGE', 'menu_image'); define('MENU_START_TIMING', 'menu_start_timing'); define('MENU_END_TIMING', 'menu_end_timing'); define('MENU_START_DATE', 'menu_start_date'); define('MENU_END_DATE', 'menu_end_date'); define('MENU_RESTAURENT', 'menu_restaurent'); define('MENU_DISPLAY_ORDER','menu_display_order'); define('MENU_ROUTE','menu_route'); define('MENU_ETHOR_CAT_ID','menu_ethor_cat_id'); define('TBL_MENU_ACTIVE_DATE',  MENU_START_DATE);define('TBL_MENU_DEACTIVE_DATE',  MENU_END_DATE);$tbl_menu_active_condition= ' ('.TBL_MENU_DEACTIVE_DATE.' is NULL OR '.TBL_MENU_DEACTIVE_DATE.' = 0 OR '.TBL_MENU_DEACTIVE_DATE.' > NOW( )) ';class tbl_menu {	private $menu_id;	private $menu_name;	private $menu_category;	private $menu_desc;	private $menu_image;	private $menu_start_timing;	private $menu_end_timing;	private $menu_start_date;	private $menu_end_date;	private $menu_restaurent;		private $menu_display_order;	private $menu_route;		private $menu_ethor_cat_id;		private $tbl_menu_active_date;	private $tbl_menu_deactive_date;		public function setmenu_id($pArg='0') {$this->menu_id=$pArg;}	public function setmenu_name($pArg='0') {$this->menu_name=$pArg;}	public function setmenu_category($pArg='0') {$this->menu_category=$pArg;}	public function setmenu_desc($pArg='0') {$this->menu_desc=$pArg;}	public function setmenu_image($pArg='0') {$this->menu_image=$pArg;}	public function setmenu_start_timing($pArg='0') {$this->menu_start_timing=$pArg;}	public function setmenu_end_timing($pArg='0') {$this->menu_end_timing=$pArg;}	public function setmenu_start_date($pArg='0') {$this->menu_start_date=$pArg;}	public function setmenu_end_date($pArg='0') {$this->menu_end_date=$pArg;}	public function setmenu_restaurent($pArg='0') {$this->menu_restaurent=$pArg;}		public function setmenu_display_order($pArg='0') {$this->menu_display_order=$pArg;}	public function setmenu_route($pArg='0') {$this->menu_route=$pArg;}		public function setmenu_ethor_cat_id($pArg='0') {$this->menu_ethor_cat_id=$pArg;}		public function settbl_menu_active_date($pArg='0') {$this->tbl_menu_active_date=$pArg;}	public function settbl_menu_deactive_date($pArg='0') {$this->tbl_menu_deactive_date=$pArg;}	public function getmenu_id() {return $this->menu_id;}	public function getmenu_name() {return $this->menu_name;}	public function getmenu_category() {return $this->menu_category;}	public function getmenu_desc() {return $this->menu_desc;}	public function getmenu_image() {return $this->menu_image;}	public function getmenu_start_timing() {return $this->menu_start_timing;}	public function getmenu_end_timing() {return $this->menu_end_timing;}	public function getmenu_start_date() {return $this->menu_start_date;}	public function getmenu_end_date() {return $this->menu_end_date;}	public function getmenu_restaurent() {return $this->menu_restaurent;}		public function getmenu_display_order() {return $this->menu_display_order;}	public function getmenu_route() {return $this->menu_route;}		public function getmenu_ethor_cat_id() {return $this->menu_ethor_cat_id;}		public function gettbl_menu_active_date() {return $this->tbl_menu_active_date;}	public function gettbl_menu_deactive_date() {return $this->tbl_menu_deactive_date;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".TBL_MENU.RET;		$and = "WHERE".RET;				if($array[MENU_ETHOR_CAT_ID] != "") {			$qry .= $and.MENU_ETHOR_CAT_ID." = '".$array[MENU_ETHOR_CAT_ID]."'".RET;			$and = "AND".RET;		}		if($array[MENU_ID] != "") {			$qry .= $and.MENU_ID." = '".$array[MENU_ID]."'".RET;			$and = "AND".RET;		}		if($array[MENU_NAME] != "") {			$qry .= $and.MENU_NAME." = '".$array[MENU_NAME]."'".RET;			$and = "AND".RET;		}		if($array[MENU_CATEGORY] != "") {			$qry .= $and.MENU_CATEGORY." = '".$array[MENU_CATEGORY]."'".RET;			$and = "AND".RET;		}		if($array[MENU_DESC] != "") {			$qry .= $and.MENU_DESC." = '".$array[MENU_DESC]."'".RET;			$and = "AND".RET;		}		if($array[MENU_IMAGE] != "") {			$qry .= $and.MENU_IMAGE." = '".$array[MENU_IMAGE]."'".RET;			$and = "AND".RET;		}		if($array[MENU_START_TIMING] != "") {			$qry .= $and.MENU_START_TIMING." = '".$array[MENU_START_TIMING]."'".RET;			$and = "AND".RET;		}		if($array[MENU_END_TIMING] != "") {			$qry .= $and.MENU_END_TIMING." = '".$array[MENU_END_TIMING]."'".RET;			$and = "AND".RET;		}				if($array[MENU_RESTAURENT] != "") {			$qry .= $and.MENU_RESTAURENT." = '".$array[MENU_RESTAURENT]."'".RET;			$and = "AND".RET;		}				if($array[MENU_ROUTE] != "") {			$qry .= $and.MENU_ROUTE." = '".$array[MENU_ROUTE]."'".RET;			$and = "AND".RET;		}					if($array[MENU_DISPLAY_ORDER] != "") {			$qry .= $and.MENU_DISPLAY_ORDER." = '".$array[MENU_DISPLAY_ORDER]."'".RET;			$and = "AND".RET;		}			if($array[MENU_START_DATE] != "") {			$qry .= $and.MENU_START_DATE." = '".$array[MENU_START_DATE]."'".RET;			$and = "AND".RET;		}		if($array[MENU_END_DATE] != "") {			$qry .= $and.MENU_END_DATE." = '".$array[MENU_END_DATE]."'".RET;			$and = "AND".RET;		}//echo "$qry <br>";	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->setmenu_id($record[MENU_ID]);				$this->setmenu_name($record[MENU_NAME]);				$this->setmenu_category($record[MENU_CATEGORY]);				$this->setmenu_desc($record[MENU_DESC]);				$this->setmenu_image($record[MENU_IMAGE]);				$this->setmenu_start_timing($record[MENU_START_TIMING]);				$this->setmenu_end_timing($record[MENU_END_TIMING]);				$this->setmenu_restaurent($record[MENU_RESTAURENT]);								$this->setmenu_display_order($record[MENU_DISPLAY_ORDER]);				$this->setmenu_route($record[MENU_ROUTE]);								$this->setmenu_ethor_cat_id($record[MENU_ETHOR_CAT_ID]);								$this->setmenu_start_date($record[MENU_START_DATE]);				$this->setmenu_end_date($record[MENU_END_DATE]);				$this->settbl_menu_active_date($record[TBL_MENU_ACTIVE_DATE]);				$this->settbl_menu_deactive_date($record[TBL_MENU_DEACTIVE_DATE]);				return true;			}		}	}	public static function readArray($array = array(),&$result_found=0,$isArray=1,$ck_timings=0,$ck_weekdys_avail=0) {		global $tbl_menu_active_condition;		$qry = "SELECT *".RET."FROM ".TBL_MENU.RET;		$and = "WHERE".RET;		if($array[MENU_ETHOR_CAT_ID] != "") {			$qry .= $and.MENU_ETHOR_CAT_ID." IN (".$array[MENU_ETHOR_CAT_ID].")".RET;			$and = "AND".RET;		}				if($array[MENU_ID] != "") {			$qry .= $and.MENU_ID." IN (".$array[MENU_ID].")".RET;			$and = "AND".RET;		}		if($array[MENU_NAME] != "") {			$qry .= $and.MENU_NAME." = '".$array[MENU_NAME]."'".RET;			$and = "AND".RET;		}		if($array[MENU_CATEGORY] != "") {			$qry .= $and.MENU_CATEGORY." = '".$array[MENU_CATEGORY]."'".RET;			$and = "AND".RET;		}		if($array[MENU_DESC] != "") {			$qry .= $and.MENU_DESC." = '".$array[MENU_DESC]."'".RET;			$and = "AND".RET;		}		if($array[MENU_IMAGE] != "") {			$qry .= $and.MENU_IMAGE." = '".$array[MENU_IMAGE]."'".RET;			$and = "AND".RET;		}		if($array[MENU_START_TIMING] != "") {			$qry .= $and.MENU_START_TIMING." = '".$array[MENU_START_TIMING]."'".RET;			$and = "AND".RET;		}		if($array[MENU_END_TIMING] != "") {			$qry .= $and.MENU_END_TIMING." = '".$array[MENU_END_TIMING]."'".RET;			$and = "AND".RET;		}				if($array[MENU_RESTAURENT] != "") {			$qry .= $and.MENU_RESTAURENT." = '".$array[MENU_RESTAURENT]."'".RET;			$and = "AND".RET;		}				if($array[MENU_START_DATE] != "") {			$qry .= $and.MENU_START_DATE." = '".$array[MENU_START_DATE]."'".RET;			$and = "AND".RET;		}				if($array[MENU_ROUTE] != "") {			$qry .= $and.MENU_ROUTE." = '".$array[MENU_ROUTE]."'".RET;			$and = "AND".RET;		}				if($array[MENU_DISPLAY_ORDER] != "") {			$qry .= $and.MENU_DISPLAY_ORDER." = '".$array[MENU_DISPLAY_ORDER]."'".RET;			$and = "AND".RET;		}		if($array[MENU_END_DATE] != "") {			$qry .= $and.MENU_END_DATE." = '".$array[MENU_END_DATE]."'".RET;			$and = "AND".RET;		}					if(is_gt_zero_num($array["isActive"])) {			$qry .= $and.$tbl_menu_active_condition;;			$and = "AND".RET;		}		if(is_not_empty($array[SORT_ON]) && is_not_empty($array[SORT_BY])) {					$qry .=" ORDER BY ".$array[SORT_ON]." ".$array[SORT_BY];				}				if(is_not_empty($array['show_only'])) {					$qry .=" LIMIT ".$array['show_only'];				}		if(is_not_empty($array[OFFSET_TITLE]) && is_not_empty($array[LIMIT_TITLE])) {			$qry_with_limit  = $qry." LIMIT ".$array[OFFSET_TITLE].",".$array[LIMIT_TITLE];		}else{			$qry_with_limit  = $qry;		}		$result = mysql_query ($qry_with_limit);		$r1 = mysql_query($qry);		if($r1){			$result_found = mysql_num_rows($r1);		}		//echo $qry_with_limit;						$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				//..Logic to fetch only weekdays availability menus				if($ck_weekdys_avail==1){					$objtbl_mnu_weekdays=new tbl_mnu_weekdays();					$cor_weekDay_rec=$objtbl_mnu_weekdays->GetMenuInfo($record[MENU_ID]);										if(is_not_empty($cor_weekDay_rec)){						$todays_day=strtolower(date("l"));						if(strtoupper($cor_weekDay_rec["mnu_wkdy_{$todays_day}"])=="N"){							continue;						}else{							//..Check if the weekdays menu availability timining is in 							//	echo $cor_weekDay_rec["mnu_wkdy_{$todays_day}_start"] .'='.$cor_weekDay_rec["mnu_wkdy_{$todays_day}_end"].'='.date("H:i:s").'<br>';							if($ck_timings==1){								if(($cor_weekDay_rec["mnu_wkdy_{$todays_day}_start"] >= $cor_weekDay_rec["mnu_wkdy_{$todays_day}_end"])){									if(($cor_weekDay_rec["mnu_wkdy_{$todays_day}_start"] <=date("H:i:s")) && ($cor_weekDay_rec["mnu_wkdy_{$todays_day}_end"] >= date("H:i:s"))){										//..do nothing									}else{										continue;									}																	}elseif(($cor_weekDay_rec["mnu_wkdy_{$todays_day}_start"] <=date("H:i:s")) && ($cor_weekDay_rec["mnu_wkdy_{$todays_day}_end"] >= date("H:i:s"))){									//..do nothing								}else{									continue;								}							}													}					}					unset($objtbl_mnu_weekdays);				}				$isActive= 0;				//..check deactive date is not set or 0				if((is_not_empty($record[TBL_MENU_DEACTIVE_DATE])==false) || (is_gt_zero_num(strtotime($record[TBL_MENU_DEACTIVE_DATE]))== false)){					$isActive = 1; 				}else{					//..check the deactive date is greater than todays date					if(strtotime($record[TBL_MENU_DEACTIVE_DATE]) > strtotime(date(DATE_FORMAT))){						$isActive = 1;					}				}				if($isArray){					$class_object = array();					$class_object[MENU_ID]=$record[MENU_ID];					$class_object[MENU_NAME]=$record[MENU_NAME];					$class_object[MENU_CATEGORY]=$record[MENU_CATEGORY];					$class_object[MENU_DESC]=$record[MENU_DESC];					$class_object[MENU_IMAGE]=$record[MENU_IMAGE];					$class_object[MENU_START_TIMING]=$record[MENU_START_TIMING];					$class_object[MENU_END_TIMING]=$record[MENU_END_TIMING];					$class_object[MENU_START_DATE]=$record[MENU_START_DATE];					$class_object[MENU_END_DATE]=$record[MENU_END_DATE];					$class_object[MENU_RESTAURENT] = $record[MENU_RESTAURENT];										$class_object[MENU_ETHOR_CAT_ID]=$record[MENU_ETHOR_CAT_ID];										$class_object[MENU_DISPLAY_ORDER] = $record[MENU_DISPLAY_ORDER];					$class_object[MENU_ROUTE] = $record[MENU_ROUTE];										$class_object['isActive']=$isActive;				}else{					$class_object = new tbl_menu();					$class_object->setmenu_id($record[MENU_ID]);					$class_object->setmenu_name($record[MENU_NAME]);					$class_object->setmenu_category($record[MENU_CATEGORY]);					$class_object->setmenu_desc($record[MENU_DESC]);					$class_object->setmenu_image($record[MENU_IMAGE]);					$class_object->setmenu_start_timing($record[MENU_START_TIMING]);					$class_object->setmenu_end_timing($record[MENU_END_TIMING]);					$class_object->setmenu_restaurent($record[MENU_RESTAURENT]);										$class_object->setmenu_display_order($record[MENU_DISPLAY_ORDER]);					$class_object->setmenu_route($record[MENU_ROUTE]);										$class_object->setmenu_ethor_cat_id($record[MENU_ETHOR_CAT_ID]);										$class_object->setmenu_start_date($record[MENU_START_DATE]);					$class_object->setmenu_end_date($record[MENU_END_DATE]);				}				$class_objects[$record[MENU_ID]] = $class_object;			}		}		return $class_objects;	}//..End readArray	public function insert() {		if($this->getmenu_id() != '') {			$qry  = 'UPDATE '.TBL_MENU.RET.'SET'.RET.'			'.MENU_ID.' = \''.$this->getmenu_id().'\','.RET.'			'.MENU_NAME.' = \''.$this->getmenu_name().'\','.RET.'			'.MENU_CATEGORY.' = \''.$this->getmenu_category().'\','.RET.'			'.MENU_DESC.' = \''.$this->getmenu_desc().'\','.RET.'			'.MENU_IMAGE.' = \''.$this->getmenu_image().'\','.RET.'			'.MENU_START_TIMING.' = \''.$this->getmenu_start_timing().'\','.RET.'			'.MENU_END_TIMING.' = \''.$this->getmenu_end_timing().'\','.RET.'			'.MENU_RESTAURENT.' = \''.$this->getmenu_restaurent().'\','.RET.'						'.MENU_DISPLAY_ORDER.' = \''.$this->getmenu_display_order().'\','.RET.'						'.MENU_ROUTE.' = \''.$this->getmenu_route().'\','.RET.'						'.MENU_ETHOR_CAT_ID.' = \''.$this->getmenu_ethor_cat_id().'\','.RET.'						'.MENU_START_DATE.' = \''.$this->getmenu_start_date().'\','.RET.'			'.MENU_END_DATE.' = \''.$this->getmenu_end_date().'\''.RET.			'WHERE '.MENU_ID.' = '.$this->getmenu_id().RET; 			mysql_query($qry);		} else {			$qry  = 'INSERT INTO '.TBL_MENU.' ('.RET.			''.MENU_NAME.', '.MENU_CATEGORY.', '.MENU_DESC.', '.MENU_IMAGE.', '.MENU_START_TIMING.', '.MENU_END_TIMING.','.MENU_RESTAURENT.','.MENU_ROUTE.','.MENU_ETHOR_CAT_ID.','.MENU_DISPLAY_ORDER.', '.MENU_START_DATE.', '.MENU_END_DATE.RET.				') VALUES ('.RET.			'\''.$this->getmenu_name().'\','.RET.			'\''.$this->getmenu_category().'\','.RET.			'\''.$this->getmenu_desc().'\','.RET.			'\''.$this->getmenu_image().'\','.RET.			'\''.$this->getmenu_start_timing().'\','.RET.			'\''.$this->getmenu_end_timing().'\','.RET.			'\''.$this->getmenu_restaurent().'\','.RET.			'\''.$this->getmenu_route().'\','.RET.						'\''.$this->getmenu_ethor_cat_id().'\','.RET.						'\''.$this->getmenu_display_order().'\','.RET.			'\''.$this->getmenu_start_date().'\','.RET.			'\''.$this->getmenu_end_date().'\''.RET.			')'.RET;			$res = mysql_query($qry);			$this->setmenu_id(mysql_insert_id());		}	}//..End Insert	public static function delete($array = array()) {		$qry = 'DELETE'.RET.'FROM '.TBL_MENU.RET;		$and = 'WHERE'.RET;		if($array[MENU_ID] != '') {			$qry .= $and.MENU_ID.' IN ('.$array[MENU_ID].')'.RET;			$and = 'AND'.RET;		}		if($array[MENU_NAME] != '') {			$qry .= $and.MENU_NAME.' = \''.$array[MENU_NAME].'\''.RET;			$and = 'AND'.RET;		}		if($array[MENU_CATEGORY] != '') {			$qry .= $and.MENU_CATEGORY.' = \''.$array[MENU_CATEGORY].'\''.RET;			$and = 'AND'.RET;		}		if($array[MENU_DESC] != '') {			$qry .= $and.MENU_DESC.' = \''.$array[MENU_DESC].'\''.RET;			$and = 'AND'.RET;		}		if($array[MENU_IMAGE] != '') {			$qry .= $and.MENU_IMAGE.' = \''.$array[MENU_IMAGE].'\''.RET;			$and = 'AND'.RET;		}		if($array[MENU_START_TIMING] != '') {			$qry .= $and.MENU_START_TIMING.' = \''.$array[MENU_START_TIMING].'\''.RET;			$and = 'AND'.RET;		}		if($array[MENU_END_TIMING] != '') {			$qry .= $and.MENU_END_TIMING.' = \''.$array[MENU_END_TIMING].'\''.RET;			$and = 'AND'.RET;		}				if($array[MENU_RESTAURENT] != "") {			$qry .= $and.MENU_RESTAURENT." = '".$array[MENU_RESTAURENT]."'".RET;			$and = "AND".RET;		}		if($array[MENU_START_DATE] != '') {			$qry .= $and.MENU_START_DATE.' = \''.$array[MENU_START_DATE].'\''.RET;			$and = 'AND'.RET;		}				if($array[MENU_ROUTE] != "") {			$qry .= $and.MENU_ROUTE." = '".$array[MENU_ROUTE]."'".RET;			$and = "AND".RET;		}				if($array[MENU_DISPLAY_ORDER] != "") {			$qry .= $and.MENU_DISPLAY_ORDER." = '".$array[MENU_DISPLAY_ORDER]."'".RET;			$and = "AND".RET;		}		if($array[MENU_END_DATE] != '') {			$qry .= $and.MENU_END_DATE.' = \''.$array[MENU_END_DATE].'\''.RET;			$and = 'AND'.RET;		} 		$res = mysql_query($qry);		if($res){			return OPERATION_SUCCESS;		};		return OPERATION_FAIL;	}//..End Delete	public function isAlreadyThere($menu_name ,$menu_category ,$menu_desc ,$menu_image ,$menu_start_timing ,$menu_end_timing ) {		$unique_arr = array();			//$unique_arr[MENU_ID]=$menu_id;			//$unique_arr[MENU_NAME]=$menu_name;			//$unique_arr[MENU_CATEGORY]=$menu_category;			//$unique_arr[MENU_DESC]=$menu_desc;			//$unique_arr[MENU_IMAGE]=$menu_image;			//$unique_arr[MENU_START_TIMING]=$menu_start_timing;			//$unique_arr[MENU_END_TIMING]=$menu_end_timing;			//$unique_arr[MENU_START_DATE]=$menu_start_date;			//$unique_arr[MENU_END_DATE]=$menu_end_date;		if(is_not_empty($unique_arr)){			return $this->readObject($unique_arr);		}		return false;	}//..isAlreadyThere	public function create($menu_name ,$menu_category ,$menu_desc ,$menu_image ,$menu_start_timing ,$menu_end_timing,$menu_restaurent=0,$menu_route=5,$menu_display_order=0,$menu_ethor_cat_id='') {		if(is_not_empty($menu_name)){			if($this->isAlreadyThere($menu_name ,$menu_category ,$menu_desc ,$menu_image ,$menu_start_timing ,$menu_end_timing )){				return OPERATION_DUPLICATE;			}else{				$this->setmenu_id('');				$this->setmenu_name($menu_name);				$this->setmenu_category($menu_category);				$this->setmenu_desc($menu_desc);				$this->setmenu_image($menu_image);				$this->setmenu_start_timing($menu_start_timing);				$this->setmenu_end_timing($menu_end_timing);				$this->setmenu_restaurent($menu_restaurent);				$this->setmenu_route($menu_route);								$this->setmenu_ethor_cat_id($menu_ethor_cat_id);								$this->setmenu_display_order($menu_display_order);				$this->setmenu_start_date(date(DATE_FORMAT));				$this->insert();				return $this->getmenu_id();			}		}		return OPERATION_FAIL;	}//..create	public function update($menu_id,$menu_name ,$menu_category ,$menu_desc ,$menu_image ,$menu_start_timing ,$menu_end_timing,$menu_restaurent=0,$menu_route=5,$menu_display_order=0,$menu_ethor_cat_id='') { 		if(is_gt_zero_num($menu_id)){			if ($this->readObject(array(MENU_ID=>$menu_id))){				$this->setmenu_name($menu_name);				$this->setmenu_category($menu_category);				$this->setmenu_desc($menu_desc);				if($menu_image!='')					$this->setmenu_image($menu_image);				$this->setmenu_start_timing($menu_start_timing);				$this->setmenu_end_timing($menu_end_timing);				$this->setmenu_route($menu_route);								if(is_not_empty($menu_ethor_cat_id))					$this->setmenu_ethor_cat_id($menu_ethor_cat_id);								$this->setmenu_display_order($menu_display_order);				$this->setmenu_restaurent($menu_restaurent);				$this->insert();				return OPERATION_SUCCESS;			}		}		return OPERATION_FAIL;	}//..update	public function activate($menu_id){		if(is_not_empty($menu_id)){			/*if ($this->readObject(array(MENU_ID=>$menu_id))){*/				$qry  = 'UPDATE '.TBL_MENU.RET.'SET'.RET.''.TBL_MENU_DEACTIVE_DATE.' = \''.date(EMPTY_DATE_FORMAT).'\' WHERE '.MENU_ID.' IN ('.$menu_id.')';				$res = mysql_query($qry);				if($res){					return 1;				}			/*}*/		}		return 0;	}//..end activate	public function deactivate($menu_id){		if(is_not_empty($menu_id) ){			/*if ($this->readObject(array(MENU_ID=>$menu_id))){*/				$qry  = 'UPDATE '.TBL_MENU.RET.'SET'.RET.''.TBL_MENU_DEACTIVE_DATE.' = \''.date(DATE_FORMAT).'\' WHERE '.MENU_ID.' IN ('.$menu_id.')';				$res = mysql_query($qry);				if($res){					return 1;				}			/*}*/		}		return 0;	}//..end deactivate	public static function GetInfo($menu_id) {		$info = array();		if($menu_id != ''){			$obj_tbl_menu = new tbl_menu();			if($obj_tbl_menu->readObject(array('menu_id'=>$menu_id))){				$info['menu_id']=$obj_tbl_menu->getmenu_id();				$info['menu_name']=$obj_tbl_menu->getmenu_name();				$info['menu_category']=$obj_tbl_menu->getmenu_category();								//..Get category details				$tbl_menu_cat_deatil= new tbl_menu_category();				$tbl_menu_cat_deatil= $tbl_menu_cat_deatil->GetInfo($info['menu_category']);				if(is_not_empty($tbl_menu_cat_deatil)){					$info['cat_detail']=$tbl_menu_cat_deatil;				}								//..Get Weekday details				$mnu_weekdays_deatil= new tbl_mnu_weekdays();				$mnu_weekdays_deatil= $mnu_weekdays_deatil->GetMenuInfo($info['menu_id']);				if(is_not_empty($mnu_weekdays_deatil)){					$info['weekdays_avail']=$mnu_weekdays_deatil;				}						   								$info['menu_desc']=$obj_tbl_menu->getmenu_desc();				$info['menu_image']=$obj_tbl_menu->getmenu_image();				$info['menu_start_timing']=$obj_tbl_menu->getmenu_start_timing();				$info['menu_end_timing']=$obj_tbl_menu->getmenu_end_timing();				$info['menu_start_date']=$obj_tbl_menu->getmenu_start_date();				$info['menu_restaurent'] = $obj_tbl_menu->getmenu_restaurent();								$info['menu_route'] = $obj_tbl_menu->getmenu_route();								$info['menu_ethor_cat_id'] = $obj_tbl_menu->getmenu_ethor_cat_id();								$info['menu_display_order'] = $obj_tbl_menu->getmenu_display_order();								$info['menu_end_date']=$obj_tbl_menu->getmenu_end_date();				$info['isActive'] = 0;				//..check deactive date is not set or 0				if((is_not_empty($obj_tbl_menu->gettbl_menu_deactive_date())==false)  || (is_gt_zero_num(strtotime($obj_tbl_menu->gettbl_menu_deactive_date()))== false)){					$info['isActive'] = 1;				}else{					//..check the deactive date is greater than todays date					if(strtotime($obj_tbl_menu->gettbl_menu_deactive_date()) > strtotime(date(DATE_FORMAT))){						$info['isActive'] = 1;					}				}			}		unset($obj_tbl_menu);		return $info;		}	}//..End GetInfo	public static function GetFields($data){		global $tbl_menu_active_condition;		$arr = array();		if(is_not_empty($data)){			$qry ='SELECT '.$data['key_field'].','.$data['value_field'].' FROM '.TBL_MENU.' WHERE '.MENU_RESTAURENT.'='.$_SESSION[SES_RESTAURANT];			if(is_gt_zero_num($data['isActive'])){				$qry .= ' AND '.$tbl_menu_active_condition;			}			$res = mysql_query($qry); 			if($res){				while($row=mysql_fetch_assoc($res)){					$arr[$row[$data['key_field']]] = $row[$data['value_field']];				}			}		}		return $arr;	}//.. End of GetFields		public static function deletePrevMnuImg($menu_id,$save_path="") {		if(is_gt_zero_num($menu_id)){			$obj_tbl_menu = new tbl_menu();			if ($obj_tbl_menu->readObject(array(MENU_ID=>$menu_id))){								$menu_image=$obj_tbl_menu->getmenu_image();				if(is_not_empty($menu_image))					unlink($save_path.$menu_image);			}		}			}//..update }//..End tbl_menu?>