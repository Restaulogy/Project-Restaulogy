<?php 
class DB{  
	/**
	* Execute the Dababase Scalar query 
	* @param string $qry 
	* @param string $default 
	* @return string
	*/
	public static function ExecScalarQry($qry,$default=''){
		$strop = $default;
		if(is_not_empty($qry)){
			$res = mysql_query($qry);
			if($res && is_gt_zero_num(mysql_num_rows($res))){
				 $strop = mysql_result($res,0);
			}
		} 
		return $strop;
	}
	 
	/**
	*  Execute the Dababase Non Query used for update, delete 
	* @param string $qry 
	* @return boolean
	*/
 	public static function ExecNonQry($qry,$ret_lst_insert=false){ 
		if(is_not_empty($qry)){
			$res = mysql_query($qry); 
			if($res){
				if($ret_lst_insert==true)
					return mysql_insert_id();
				else
					return OPERATION_SUCCESS;				
			}  
				
		} 
		return OPERATION_FAIL;
	}
	
	 
	/**
	* Execute the Dababase Select Query 
	* @param string $qry
	* @param integer $onlyFirstRecord 
	* @return array
	*/
	public static function ExecQry($qry,$onlyFirstRecord=0){
		$array= array();
		if(is_not_empty($qry)){
			$res = mysql_query($qry); 
			if($res && is_gt_zero_num(mysql_num_rows($res))){
				 while($row=mysql_fetch_assoc($res)){
				 	 $array[] = $row;
					 if(is_gt_zero_num($onlyFirstRecord)) break;
				 }
				 if(is_gt_zero_num($onlyFirstRecord)) $array = array_shift($array);
			}
		}  
		return $array;
	} 
} 
?>