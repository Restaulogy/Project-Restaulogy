<?php
class table_layout{ 
	
	private static function chkPersonSeated(&$person){
		 $strop = (is_gt_zero_num($person)?' active':'');
		 $person--;
		 return $strop;
	}   
																												
	public static function display($seating_capacity,$person=0,$txt_table="&nbsp;",$block_id="biz_dining_layout"){
		$strOp = NL;
	  $i= 0; 
		$row_cnt = ceil(($seating_capacity + 2) / 2);
		$tbl_span = $row_cnt - 2; 
			if(is_gt_zero_num($row_cnt)){ 
				$strOp .= '<table id="'.$block_id.'" class="biz_dining_layout" >'.NL;  
				for($i=1;$i<=$row_cnt;$i++){
				  if($i==1){
						$strOp .= '<tr><td></td><td class="lay_chair_top'.(self::chkPersonSeated($person)).'">&nbsp;<td><td></td></tr>'.NL; 
						if($i==1 && $row_cnt == 2) $strOp .= '<tr><td>&nbsp;</td><td class="lay_table">'.$txt_table.'<td><td>&nbsp;</td></tr>'.NL;  
					}elseif($i==$row_cnt){
						$strOp .= '<tr><td></td><td class="lay_chair_bottom'.(self::chkPersonSeated($person)).'">&nbsp;<td><td></td></tr>'.NL;  
					}elseif($i==2 && is_gt_zero_num($tbl_span)){ 
						$strOp .= '<tr><td class="lay_chair_left'.(self::chkPersonSeated($person)).'">&nbsp;</td><td class="lay_table" rowspan="'.$tbl_span.'">'.$txt_table.'</td><td class="lay_chair_right'.(self::chkPersonSeated($person)).'">&nbsp;</td></tr>'.NL; 
					}else{
						$strOp .= '<tr><td class="lay_chair_left'.(self::chkPersonSeated($person)).'">&nbsp;</td><td class="lay_chair_right'.(self::chkPersonSeated($person)).'">&nbsp;</td></tr>'.NL;  
					}	   
				} 
				$strOp .= '</table>'.NL;  
		 	}
		return $strOp;
	} 
}
?>