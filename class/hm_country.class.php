<?php/**********************************************************************hm_country.class.phpGenerated by STRUCTY 2012.12.12 12:12:17.Copyright 2011 Structy, Fr�d�ric Aebi. All rights reserved.**********************************************************************/define("HM_COUNTRY", "hm_country"); class hm_country {	private $country_iso;	private $country_name;	private $country_printable_name;	private $country_iso3;	private $country_numcode;	public function setcountry_iso($pArg="0") {$this->country_iso=$pArg;}	public function setcountry_name($pArg="0") {$this->country_name=$pArg;}	public function setcountry_printable_name($pArg="0") {$this->country_printable_name=$pArg;}	public function setcountry_iso3($pArg="0") {$this->country_iso3=$pArg;}	public function setcountry_numcode($pArg="0") {$this->country_numcode=$pArg;}	public function getcountry_iso() {return $this->country_iso;}	public function getcountry_name() {return $this->country_name;}	public function getcountry_printable_name() {return $this->country_printable_name;}	public function getcountry_iso3() {return $this->country_iso3;}	public function getcountry_numcode() {return $this->country_numcode;}	public function readObject($array = array()) {		$qry = "SELECT *".RET."FROM ".HM_COUNTRY.RET;		$and = "WHERE".RET;		if($array['country_iso'] != "") {			$qry .= $and."country_iso = '".$array['country_iso']."'".RET;			$and = "AND".RET;		}		if($array['country_name'] != "") {			$qry .= $and."country_name = '".$array['country_name']."'".RET;			$and = "AND".RET;		}		if($array['country_printable_name'] != "") {			$qry .= $and."country_printable_name = '".$array['country_printable_name']."'".RET;			$and = "AND".RET;		}		if($array['country_iso3'] != "") {			$qry .= $and."country_iso3 = '".$array['country_iso3']."'".RET;			$and = "AND".RET;		}		if($array['country_numcode'] != "") {			$qry .= $and."country_numcode = '".$array['country_numcode']."'".RET;			$and = "AND".RET;		}	$result = mysql_query($qry);		if($result) {			while ($row = mysql_fetch_array($result)) {				$record = $row;				break;//end after first record			}			if(count($record[0]) == 0) {				return array();			} else {				$this->setcountry_iso($record['country_iso']);				$this->setcountry_name($record['country_name']);				$this->setcountry_printable_name($record['country_printable_name']);				$this->setcountry_iso3($record['country_iso3']);				$this->setcountry_numcode($record['country_numcode']);				return true;			}		}	}	public static function readArray($array = array()) {		$qry = "SELECT *".RET."FROM ".HM_COUNTRY.RET;		$and = "WHERE".RET;		if($array['country_iso'] != "") {			$qry .= $and."country_iso = '".$array['country_iso']."'".RET;			$and = "AND".RET;		}		if($array['country_name'] != "") {			$qry .= $and."country_name = '".$array['country_name']."'".RET;			$and = "AND".RET;		}		if($array['country_printable_name'] != "") {			$qry .= $and."country_printable_name = '".$array['country_printable_name']."'".RET;			$and = "AND".RET;		}		if($array['country_iso3'] != "") {			$qry .= $and."country_iso3 = '".$array['country_iso3']."'".RET;			$and = "AND".RET;		}		if($array['country_numcode'] != "") {			$qry .= $and."country_numcode = '".$array['country_numcode']."'".RET;			$and = "AND".RET;		}		$result = mysql_query($qry);		$class_objects = array();		if($result) {			while ($record = mysql_fetch_assoc($result)) {				$class_object = new hm_country();				$class_object->setcountry_iso($record['country_iso']);				$class_object->setcountry_name($record['country_name']);				$class_object->setcountry_printable_name($record['country_printable_name']);				$class_object->setcountry_iso3($record['country_iso3']);				$class_object->setcountry_numcode($record['country_numcode']);				$class_objects[$class_object->getcountry_iso()] = $class_object;			}		}		return $class_objects;	}	public function insert() {		if($this->getcountry_iso() != '') {			$qry  = "UPDATE ".HM_COUNTRY.RET."SET".RET.			"country_iso = '".$this->getcountry_iso()."',".RET.			"country_name = '".$this->getcountry_name()."',".RET.			"country_printable_name = '".$this->getcountry_printable_name()."',".RET.			"country_iso3 = '".$this->getcountry_iso3()."',".RET.			"country_numcode = '".$this->getcountry_numcode()."'".RET.			"WHERE country_iso = ".$this->getcountry_iso().RET;			mysql_query($qry);		} else {			$qry  = "INSERT INTO ".HM_COUNTRY." (".RET.			"country_name, country_printable_name, country_iso3, country_numcode".RET.				") VALUES (".RET.			"'".$this->getcountry_name()."',".RET.			"'".$this->getcountry_printable_name()."',".RET.			"'".$this->getcountry_iso3()."',".RET.			"'".$this->getcountry_numcode()."'".RET.			")".RET;			$res = mysql_query($qry);			$this->setcountry_iso(mysql_insert_id($res));		}	}	public static function delete($array = array()) {		$qry = "DELETE".RET."FROM ".HM_COUNTRY.RET;		$and = "WHERE".RET;		if($array['country_iso'] != "") {			$qry .= $and."country_iso = '".$array['country_iso']."'".RET;			$and = "AND".RET;		}		if($array['country_name'] != "") {			$qry .= $and."country_name = '".$array['country_name']."'".RET;			$and = "AND".RET;		}		if($array['country_printable_name'] != "") {			$qry .= $and."country_printable_name = '".$array['country_printable_name']."'".RET;			$and = "AND".RET;		}		if($array['country_iso3'] != "") {			$qry .= $and."country_iso3 = '".$array['country_iso3']."'".RET;			$and = "AND".RET;		}		if($array['country_numcode'] != "") {			$qry .= $and."country_numcode = '".$array['country_numcode']."'".RET;			$and = "AND".RET;		}		mysql_query($qry);	}}?>