<?php

function add_demo_usr_to_see($is_demo_usr){
	if(is_gt_zero_num($is_demo_usr)){
    	if($_SESSION[SES_RESTAURANT]==4){
			//..if fired up grill the demo
			$_SESSION['is_demo_usr']='6022379889';
		}elseif($_SESSION[SES_RESTAURANT]==1){
			//..if it is the restaurant
			$_SESSION['is_demo_usr']='6022222222';
		}elseif($_SESSION[SES_RESTAURANT]==10){
			//..if it is the restaurant
			$_SESSION['is_demo_usr']='6023333333';
		}else{
			if(is_not_empty($_SESSION['is_demo_usr'])){
				$_SESSION['is_demo_usr']=0;
				unset($_SESSION['is_demo_usr']);				
			}
		}
	}
}

function _chk_if_usr_witout_email($_email){
	$_ret_val=0;
	//echo "_email=$_email";
	
	if(is_not_empty($_email)){
		$_first_part=substr($_email, 0, 6);
		$_last_part=substr($_email,(strlen($_email)-8), 8);		
		//echo "<br>$_first_part,$_last_part";
		if(($_first_part=='exusr_') && ($_last_part=='@tst.com')){
				$_ret_val=1;
		}		
	}
	return $_ret_val;
}

//..get the last id
function _get_lst_member_id(){
	$_lst_id =DB::ExecScalarQry("SELECT MAX(`id`) FROM `members`",0);
	return ($_lst_id+1);
}

function _get_prom_specifics($prom_id){
	$_prom_det=array();
	if(is_gt_zero_num($prom_id)){
		$sql="SELECT `p`.*, 
		      CASE `p`.`end_date` < CURDATE()
              WHEN 1 THEN 1 ELSE 0 END
              as `isExpired`,
              `r`.`restaurent_img`		
			  FROM `pds_list_promotions` `p` 
			  INNER JOIN `tbl_restaurent` `r` 
			  ON `p`.`prm_restaurent`=`r`.`restaurent_id`
			  WHERE `p`.`id`=".$prom_id;		
		$_prom_det =DB::ExecQry($sql,1);	
	}
	return $_prom_det;	
}

//..get promotion using prom code
function _get_prom_using_code($prom_code){
	$_prom_det=array();
	if(is_not_empty($prom_code)){
		$sql="SELECT `p`.*, 
		      CASE `p`.`end_date` < CURDATE()
              WHEN 1 THEN 1 ELSE 0 END
              as `isExpired`,
              `r`.`restaurent_img`		
			  FROM `pds_list_promotions` `p` 
			  INNER JOIN `tbl_restaurent` `r` 
			  ON `p`.`prm_restaurent`=`r`.`restaurent_id`
			  WHERE `p`.`prom_code`='".$prom_code."' ORDER BY `p`.`id` DESC;";	
		$_prom_det =DB::ExecQry($sql,1);	
	}
	return $_prom_det;	
}

function _get_us_phone($raw_phone,$_ignoreplus1=0){
	if(is_not_empty($raw_phone)){
			$raw_phone= str_replace(array('+', '-'), '', filter_var($raw_phone, FILTER_SANITIZE_NUMBER_INT));
			$_ent_phone_len=strlen($raw_phone);
			if($_ent_phone_len==11){
				if($_ignoreplus1==0){
					$raw_phone=substr($raw_phone, 1);	
				}				
			}else{
				if($_ent_phone_len>1 && $_ignoreplus1==0){
					$raw_phone= '1'.$raw_phone;	
				}	
			}			
	}
	return $raw_phone;
}

function _get_us_phone_without1($raw_phone){
	if(is_not_empty($raw_phone)){
			$raw_phone= str_replace(array('+', '-'), '', filter_var($raw_phone, FILTER_SANITIZE_NUMBER_INT));
			$_ent_phone_len=strlen($raw_phone);
			if($_ent_phone_len==11){				
					$raw_phone=substr($raw_phone, 1);							
			}	
	}
	return $raw_phone;
}

/** 
 * method masks the username of an email address 
 * 
 * @param string $email the email address to mask 
 * @param string $mask_char the character to use to mask with 
 * @param int $percent the percent of the username to mask 
 */ 
function mask_email( $email, $mask_char, $percent=50 ) 
{ 
        list( $user, $domain ) = preg_split("/@/", $email ); 
        $len = strlen( $user ); 
        $mask_count = floor( $len * $percent /100 ); 
        $offset = floor( ( $len - $mask_count ) / 2 );
        $masked = substr( $user, 0, $offset ) 
                .str_repeat( $mask_char, $mask_count ) 
                .substr( $user, $mask_count+$offset ); 

        return( $masked.'@'.$domain ); 
} 

function capture_errors($error){
	if (!empty($error))
	{
			$i = 0;
			while ($i < count($error)){
				$showError.= '<div class="error">'.$error[$i].'</div>';
				$i ++;
			}
			return $showError;
	}// close if empty errors
} // close function

//..Check if table is in the shift assignment
function check_if_table_is_in_shift_assignmnt($pst_table_id){
	//..Chk for table availability  
	$avl_tables = tbl_emp_shift_assignment::getTablesForShiftDate(tbl_shift::getCurrentShift(),date(DAY_FORMAT));
	$avl_tables = biz_explode(',',$avl_tables);
	$avail_table = 0;
 
	if(in_array($pst_table_id,$avl_tables)){
		$avail_table = 1;
	}
	
	return $avail_table;
}

function genearte_auto_cde($length){
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }    
		return $key;
}

function validate_server_pin($server_pin){
		//$sql='SELECT `'.RWD_ID.'` FROM `'.BIZ_REWARDS.'` WHERE `'.RWD_CUP_ID.'` LIKE "'.trim($server_pin).'%" AND `'.RWD_BUSS_ID.'`= '.$_SESSION[SES_RESTAURANT].' AND ((CURDATE( ) >= `'.RWD_START_DT.'` ) AND ( CURDATE( ) <= `'.RWD_END_DT.'`));';
		//echo $sql;
		$sql='SELECT `'.SRV_PIN_ID.'` FROM `'.TBL_SERVER_PIN.'` WHERE `'.SRV_PIN_PASSWORD.'` LIKE "'.trim($server_pin).'" AND `'.SRV_PIN_RESTAURANT.'`= '.$_SESSION[SES_RESTAURANT].' AND ('.TBL_SERVER_PIN_DEACTIVE_DATE.' IS NULL OR '.TBL_SERVER_PIN_DEACTIVE_DATE.' = 0 OR '.TBL_SERVER_PIN_DEACTIVE_DATE.' > CURDATE( ))';
		$rslt_fnd=DB::ExecScalarQry($sql);
		return $rslt_fnd;
}

//..function for the grid sorting url
function modify_navigattion_url($url = FALSE){		
    // If $url wasn't passed in, use the current url
    if($url == FALSE){
        $scheme = $_SERVER['SERVER_PORT'] == 80 ? 'http' : 'https';
        $url = $scheme.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }
    // Parse the url into pieces
    $url_array = parse_url($url);
		$query_array = array();
		//print_r($query_array);
		//exit;		
    // The original URL had a query string, modify it.
    if(is_not_empty($url_array['query'])){
        parse_str($url_array['query'], $query_array);
				unset($query_array[SORT_ON]);
				unset($query_array[SORT_BY]);
        /*
				foreach ($mod as $key => $value) {
            if(is_not_empty($query_array[$key])){
                $query_array[$key] = $value;
            }
        }
				*/
    }
    // The original URL didn't have a query string, add it.
    /*else{
        $query_array = array();
    }*/
		if(is_not_empty($query_array)){
				return $url_array['scheme'].'://'.$url_array['host'].'/'.$url_array['path'].'?'.http_build_query($query_array);
		}else{
				return $url_array['scheme'].'://'.$url_array['host'].'/'.$url_array['path'].'?1=1';
		}
    
}

function biz_mult_arr_searchForId($array, $key, $value) {
   foreach ($array as $mainkey => $val) {
       if (isset($val[$key]) && $val[$key] == $value){ 
           return $mainkey;
       }
   }
   return "";
}

//..plot the pie chart
function print_pie_chart($data,$report_title,$legends){
	require_once(dirname(dirname(__FILE__)).'/modules/jpgraph/jpgraph.php');
	require_once(dirname(dirname(__FILE__)).'/modules/jpgraph/jpgraph_pie.php');
	require_once(dirname(dirname(__FILE__)).'/modules/jpgraph/jpgraph_pie3d.php');

	// Some data
	//$data = array(20,27,45,75,90);

	// Create the Pie Graph.
	$graph = new PieGraph(620,600);
	$graph->SetShadow();

	// Set A title for the plot
	$graph->title->Set($report_title);
	$graph->title->SetFont(FF_FONT2,FS_BOLD,12);
	$graph->title->SetColor("darkblue");
	$graph->legend->SetPos(0.0,0.07,'right','top'); 
	// Create pie plot
	$p1 = new PiePlot3d($data);
	$p1->SetTheme("sand");
	//$p1->SetCenter(0.35,0.45); 
	$p1->SetCenter(0.39,0.45); 
	$p1->SetAngle(80);
	//$p1->SetStartAngle(180);
	$p1->SetLabelMargin(0); 
	$p1->value->SetFont(FF_FONT2,FS_BOLD,10);
 
  //$p1->value->SetFormat("%d");
	
 	$p1->value->SetMargin(-6);  
	$p1->SetLegends($legends);
	$graph->legend->SetPos(0.5,0.97,'center','bottom');
	$graph->legend->SetColumns(1);
	//$p1->SetLegends(array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct"));
	 
	$graph->Add($p1);
	//$graph->Stroke();	
	
	$img = $graph->Stroke(_IMG_HANDLER); 
	ob_start();
	imagepng($img);
	$imageData = ob_get_contents();
	ob_end_clean(); 
	//$str_img="<img src=\"data:image/png;base64,".(base64_encode($imageData))."\" />";
	$str_img=base64_encode($imageData);
	return $str_img; 
}

function print_line_graph($datax,$datay,$xlabel,$ylabel,$plottitle){
	//...Jpgrapgh control
  require_once (dirname(dirname(__FILE__))."/modules/jpgraph/jpgraph.php");
  require_once (dirname(dirname(__FILE__))."/modules/jpgraph/jpgraph_line.php");

// Create the graph. These two calls are always required 
		$graph = new Graph(650, 650);//,"auto");     
		$graph->SetScale("textlin"); 
		
		// Add the plot to the graph 
	// Setup margin and titles 
	$graph->img->SetMargin(40,20 ,20,40); 
	$graph->title->Set($plottitle); 
	$graph->xaxis->title->Set($xlabel); 
	$graph->yaxis->title->Set($ylabel ); 
	
	$theme_class=new UniversalTheme;
	$graph->SetTheme($theme_class);
	$graph->img->SetAntiAliasing(false);	
	$graph->SetBox(false);
	$graph->img->SetAntiAliasing();
	$graph->yaxis->HideZeroLabel();
	$graph->yaxis->HideLine(false);
	$graph->yaxis->HideTicks(false,false);	
	$graph->xgrid->Show();
	$graph->xgrid->SetColor('#E3E3E3');
	$graph->SetShadow();
	
		$datax[] = " "; 
    $graph->xaxis->SetTickLabels($datax);
	  $graph->xaxis->SetLabelAngle(45);
    $lineplot=array();
    $cntElmnt=0;  

	// Create the linear plot 
    foreach ($datay as $key => $value) {
			if(is_not_empty($value)){
			 if(is_array($value)){
			 	if(array_filter($value)) {
            $lineplot[$cntElmnt] = new LinePlot($value);
	          $lineplot[$cntElmnt]->SetColor(array('red','green','blue'));
						//$lineplot[$cntElmnt]->SetAlign('center');
            //...Remove indexes from the legend
            $key_pieces = explode("_", $key);
            unset($key_pieces[0]);							
            $ent_name = implode(" ", $key_pieces);		
						$lineplot[$cntElmnt]->SetLegend($ent_name);		
						 
						$cntElmnt=$cntElmnt+1;
        }
			 }else{
			 	//..
			 } 
			} 
    }  
	
	$graph->Add($lineplot);	
	$graph->legend->SetColumns(4);
  $graph->legend->SetFont(FF_FONT1,FS_NORMAL);
	$graph->legend->SetFrameWeight(1);
	// Display the graph 
	//$graph->Stroke();
	$img = $graph->Stroke(_IMG_HANDLER); 
	ob_start();
	imagepng($img);
	$imageData = ob_get_contents();
	ob_end_clean(); 
	//$str_img="<img src=\"data:image/png;base64,".(base64_encode($imageData))."\" />";
	$str_img=base64_encode($imageData);
	return $str_img;  
		
/*	
$datay1 = array(20,15,23,15);
$datay2 = array(12,9,42,8);
$datay3 = array(5,17,32,24);

// Setup the graph
$graph = new Graph(300,250);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Filled Y-grid');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Line 1');

// Create the second line
$p2 = new LinePlot($datay2);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('Line 2');

// Create the third line
$p3 = new LinePlot($datay3);
$graph->Add($p3);
$p3->SetColor("#FF1493");
$p3->SetLegend('Line 3');

$graph->legend->SetFrameWeight(1);*/	

}

//..Print using jpgraph
function print_on_graph($datax,$datay,$xlabel,$ylabel,$plottitle){
    global $CONFIG;
  
 	//...Jpgrapgh control
    require_once (dirname(dirname(__FILE__))."/modules/jpgraph/jpgraph.php");
    require_once (dirname(dirname(__FILE__))."/modules/jpgraph/jpgraph_bar.php");

    // Create the graph. These two calls are always required
    /*$graph = new Graph(650,450);*/
    $graph = new Graph(650,650);
    $graph->SetScale("textlin");
	//$graph->SetScale("int"); // X and Y axis
    $graph->SetShadow();

    //$graph->img->SetMargin(40,30,20,40);
		$graph->img->SetMargin(40,30,20,40);
    /*$graph->img->SetMargin(40,5,10,20);*/
    // Setup X-axis labels 
 	$datax[] = " "; 
    $graph->xaxis->SetTickLabels($datax);
	$graph->xaxis->SetLabelAngle(45);
	  /* */
    $bplot=array();
    $cntElmnt=0;  
		//print_r($datay);
    foreach ($datay as $key => $value) {
		if(is_not_empty($value)){
		 if(is_array($value)){
		 	if(array_filter($value)) {
	            $bplot[$cntElmnt] = new BarPlot($value);	 
	            $bplot[$cntElmnt]->SetFillColor(array('red','green','blue'));
				$bplot[$cntElmnt]->SetAlign('center');
	            //...Remove indexes from the legend
	            $key_pieces = explode("_", $key);
	            unset($key_pieces[0]);							
	            $ent_name = implode(" ",$key_pieces);		
				//echo "[$ent_name => ".$color_arr[$ent_name]."]";
		  		//$bplot[$cntElmnt]->SetFillColor($color_arr[$ent_name]);	
				$bplot[$cntElmnt]->SetLegend($ent_name);
				$cntElmnt=$cntElmnt+1;
    		}
		 }else{
		 	//..
		 } 
		} 
    }  
		//print_r($bplot);
    // Create the bar plots
    // Create the accumulated bar plots
	  $gbplot = new GroupBarPlot($bplot); 
	  //$gbplot = new AccBarPlot($bplot);

    //Create the grouped bar plot
    //$gbplot = new GroupBarPlot($bplot);
    $gbplot->SetValuePos('center');
    $gbplot->SetWidth(0.4);
		//$gbplot->value->HideZero();
    //$gbplot->SetAbsWidth(20); 
    //$gbplot->SetAbsWidth(30);

    //...And add it to the graPH
    //$graph->Add($gbplot);
    $graph->Add($gbplot);
    //$graph->legend->SetRangeWeights(array(2,6,10,14,18));
    //$graph->legend->SetPos(0.5,0.98,'center','bottom');
    //$graph->legend->SetColumns(1);
		$graph->legend->SetColumns(4);
    $graph->title->Set($plottitle);
    $graph->xaxis->title->Set($xlabel);
    $graph->yaxis->title->Set($ylabel); 
    $graph->legend->SetFont(FF_FONT1,FS_NORMAL);
    $graph->title->SetFont(FF_FONT1,FS_NORMAL);
    $graph->yaxis->title->SetFont(FF_FONT1,FS_NORMAL);
    $graph->xaxis->title->SetFont(FF_FONT1,FS_NORMAL);
		
		//..zoom code
		//$graph->subtitle->Set("(zoom=0.7)");
		//$graph->SetLabelVMarginFactor(1.0); // 1=default value
		// Set zoom factor
		//$graph->SetZoomFactor(0.7);

    // Display the graph
    //$graph->Stroke();
		$img = $graph->Stroke(_IMG_HANDLER); 
		ob_start();
		imagepng($img);
		$imageData = ob_get_contents();
		ob_end_clean(); 
		//$str_img="<img src=\"data:image/png;base64,".(base64_encode($imageData))."\" />";
		$str_img=base64_encode($imageData);
		return $str_img; 
}

/*//..Print using jpgraph
function print_on_graph($datax,$datay,$xlabel,$ylabel,$plottitle){
    global $CONFIG;
  
 	//...Jpgrapgh control
    require_once (dirname(dirname(__FILE__))."/modules/jpgraph/jpgraph.php");
    require_once (dirname(dirname(__FILE__))."/modules/jpgraph/jpgraph_bar.php");

    // Create the graph. These two calls are always required
    /*$graph = new Graph(650,450);
    $graph = new Graph(650,650);
    //$graph->SetScale("textlin");
	$graph->SetScale("int"); // X and Y axis
    $graph->SetShadow();

    /*$graph->img->SetMargin(40,30,20,40);
    $graph->img->SetMargin(40,5,10,20);
    // Setup X-axis labels 
 	  $datax[] = " "; 
    $graph->xaxis->SetTickLabels($datax);
	  /* $graph->xaxis->SetLabelAngle(45);
    $bplot=array();
    $cntElmnt=0;

    foreach ($datay as $key => $value) {
        if(array_filter($value)) {
            $bplot[$cntElmnt] = new BarPlot($value);			
            $bplot[$cntElmnt]->SetFillColor(array('red','green','blue'));
			
            //...remove indexes from the legend
            $key_pieces = explode("_", $key);
            unset($key_pieces[0]);
            $ent_name = implode(" ", $key_pieces);
            $bplot[$cntElmnt]->SetLegend($ent_name);
            $cntElmnt=$cntElmnt+1;
        }
    }

    // Create the bar plots
    // Create the accumulated bar plots
	//$gbplot = new GroupBarPlot($bplot);
    $gbplot = new AccBarPlot($bplot);

    // Create the grouped bar plot
    //$gbplot = new GroupBarPlot($bplot);
    $gbplot->SetValuePos('center');
    //$gbplot->SetWidth(0.4);
    //$gbplot->SetAbsWidth(20); 
    $gbplot->SetAbsWidth(30);

    // ...and add it to the graPH
    //$graph->Add($gbplot);
    $graph->Add($gbplot);
    //$graph->legend->SetRangeWeights(array(2,6,10,14,18));
    //$graph->legend->SetPos(0.5,0.98,'center','bottom');
    $graph->legend->SetColumns(1);
    $graph->title->Set($plottitle);
    $graph->xaxis->title->Set($xlabel);
    $graph->yaxis->title->Set($ylabel); 
    $graph->legend->SetFont(FF_FONT1,FS_NORMAL);
    $graph->title->SetFont(FF_FONT1,FS_NORMAL);
    $graph->yaxis->title->SetFont(FF_FONT1,FS_NORMAL);
    $graph->xaxis->title->SetFont(FF_FONT1,FS_NORMAL);

    // Display the graph
    $graph->Stroke();
}*/
 
/*function friendly_time($time,$isDate = 0) {
	global $_lang;
		    //echo strtotime(now());
			if($isDate){
				$time = strtotime($time);
			}
		    
			$diff = time() - ((int) $time);
			if ($diff < 60) {
				return  $_lang['friendlytime:justnow'];
			} else if ($diff < 3600) {
				$diff = round($diff / 60);
				if ($diff == 0) $diff = 1;
				if ($diff > 1)
					return sprintf($_lang['friendlytime:minutes'],$diff);
				return sprintf($_lang['friendlytime:minutes:singular'],$diff);
			} else if ($diff < 86400) {
				$diff = round($diff / 3600);
				if ($diff == 0) $diff = 1;
				if ($diff > 1)
					return sprintf($_lang['friendlytime:hours'],$diff);
				return sprintf($_lang['friendlytime:hours:singular'],$diff);
			} else {
				$diff = round($diff / 86400);
				if ($diff == 0) $diff = 1;
				if ($diff > 1){
				  if($diff > 500){
				  	return sprintf($_lang['friendlytime:longdays']);
				  }elseif(($diff > 366) && ($diff < 500)){
				  	return sprintf($_lang['friendlytime:year']);
				  }else{
				  	return sprintf($_lang['friendlytime:days'],$diff);
				  }
					
				}else{
					return sprintf($_lang['friendlytime:days:singular'],$diff);
				}					
			}			
		}*/
		
		/*
 * Takes a unix timestamp and returns a relative time string such as "3 minutes ago",
 *   "2 months from now", "1 year ago", etc
 * The detailLevel parameter indicates the amount of detail. The examples above are
 * with detail level 1. With detail level 2, the output might be like "3 minutes 20
 *   seconds ago", "2 years 1 month from now", etc.
 * With detail level 3, the output might be like "5 hours 3 minutes 20 seconds ago",
 *   "2 years 1 month 2 weeks from now", etc.
 */
function friendly_time($timestamp, $detailLevel = 1) {
	$timestamp=strtotime($timestamp);
	$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

	$now = time();

	// check validity of date
	if(empty($timestamp)) {
		return "Unknown time";
	}

	// is it future date or past date
	if($now > $timestamp) {
		$difference = $now - $timestamp;
		$tense = "ago";

	} else {
		$difference = $timestamp - $now;
		$tense = "from now";
	}

	if ($difference == 0) {
		return "1 second ago";
	}

	$remainders = array();

	for($j = 0; $j < count($lengths); $j++) {
		$remainders[$j] = floor(fmod($difference, $lengths[$j]));
		$difference = floor($difference / $lengths[$j]);
	}

	$difference = round($difference);

	$remainders[] = $difference;

	$string = "";

	for ($i = count($remainders) - 1; $i >= 0; $i--) {
		if ($remainders[$i]) {
			$string .= $remainders[$i] . " " . $periods[$i];

			if($remainders[$i] != 1) {
				$string .= "s";
			}

			$string .= " ";

			$detailLevel--;

			if ($detailLevel <= 0) {
				break;
			}
		}
	}

	return $string . $tense;

}

 
function get_input($var,$default=''){
	if(is_not_empty($_REQUEST[$var])){
		if(is_array($_REQUEST[$var]))
			return $_REQUEST[$var];
		else
			return trim($_REQUEST[$var]);		
	}
	return $default;
}

function get_file_input(){
	return false;
}

function get_sql_input($var,$default=''){
	return mysql_real_escape_string(get_input($var,$default));
}

function set_value($val,$default=''){
	if(is_not_empty($val)){
		return $val;
	} 
	return $default;
}
 
/**
* return the default value if the value is null or not set or empty
* @param string $val
* @param string $default
* 
*/ 

function if_null($val,$default=''){
	return (is_not_empty($val)?$val:$default);
}
 
 
	
function get_sitename() { 
    return 'Restaurants';
}

function string_replace($string_to_replace){
   $str_rpl = $string_to_replace;
    $str_rpl = str_replace ("'","", $str_rpl);
    $str_rpl = str_replace ('`','', $str_rpl);
    $str_rpl = str_replace ('"','', $str_rpl);
  return $str_rpl;
}


/*Check Greter than Zero Number */
function is_gt_zero_num($val){
    if ((is_not_empty($val)) && (is_numeric($val)) && ($val>0)){
		return true;
	}
	return false;
}

function is_not_empty($fld){
	if(is_array($fld)){
		if ((!empty($fld))&&(count($fld)>0)){
			return true;
  		}
 	}else{
 		if (isset($fld)){
			$trimmed_fld = trim($fld);
			if((strlen($trimmed_fld))>0){
				return true;
 			}
 		}
  } 
	return false;
} 
function get_elipsis($text,$length=220,$tail='...') {
  $text = strip_tags(trim($text));
  $txtl = strlen($text);
  if($txtl > $length) {
    for($i=1;$text[$length-$i]!=' ';$i++) {
      if($i == $length) {
        return substr($text,0,$length) . $tail;
      }
    }
    $text = substr($text,0,$length-$i+1) . $tail;
  }
  return $text;
}

function getCountries(){
	$arr = array();
	$res = mysql_query('select `country_iso`,`country_name` from `hm_country` order by `country_name`;');
	if($res){ 
		while ($row = mysql_fetch_assoc($res)) {
			$arr[$row['country_iso']] = $row['country_name'];
		}
	} 
	return $arr;
}



function getMetroNameById($id){
	if(is_gt_zero_num($id)){ 
	$res = mysql_query('SELECT metro_name FROM metro_area WHERE metro_id='.$id);	
	 
	if($res){
		return mysql_result($res,0);
	}
  }
	return "";
}

function getStateNameById($id){
  if(is_gt_zero_num($id)){ 
	$res = mysql_query('SELECT states_name FROM hm_states WHERE states_id='.$id);	
	 
	if($res){
		return mysql_result($res,0);
	}
  }
	return '';
}

function getStateName($abv){
  if(is_not_empty($abv)){ 
	$res = mysql_query('SELECT states_name FROM hm_states WHERE states_abbrev='.$abv);	
	 
	if($res){
		return mysql_result($res,0);
	}
  }
	return '';
}

function getStateIdByAbv($abv){
  if(is_not_empty($abv)){  
		return DB::ExecScalarQry('SELECT states_id FROM hm_states WHERE states_abbrev=\''.$abv.'\'');	 
	} 
	return '';
}

function getCityName($id){
  if(is_gt_zero_num($id)){ 
	$res = mysql_query("SELECT cities_name FROM hm_cities WHERE cities_id='{$id}';");	
	if($res){
		return mysql_result($res,0);
	}
  }
	return '';
} 

 

function getStates($country = 'US',$byAbrev = 0){
	$arr = array(); 
	
	$res = mysql_query('SELECT states_id,states_abbrev,states_name FROM hm_states WHERE states_country_id=\''.$country.'\';');
	if($res){ 
		while ($row = mysql_fetch_assoc($res)) {
		  if(is_gt_zero_num($byAbrev)){
		  	$arr[$row['states_abbrev']] = $row['states_name'];
		  }else{
		  	$arr[$row['states_id']] = $row['states_name'];
		  } 
		}
	}
	return $arr;
}

function getCities($cities_abbrv="AZ",$cities_metro='US'){ 
	$arr = array();
	$sql_condition = '';
	if(is_not_empty($cities_abbrv)){
		$sql_condition = 'WHERE `cities_abbrv`="'.$cities_abbrv.'" AND `cities_metro`="'.$cities_metro.'"';
	}
		$res = mysql_query('SELECT `cities_id`,`cities_name` FROM `hm_cities` '.$sql_condition.';');
		if($res){ 
			while ($row = mysql_fetch_assoc($res)) {
				$arr[$row['cities_id']] = $row['cities_name'];
			}
		}	
	return $arr;
}

function getRestaurants(){
	$arr = array(); 
		$res = mysql_query('SELECT restaurent_id,restaurent_name FROM tbl_restaurent;');
		if($res){ 
			while ($row = mysql_fetch_assoc($res)) {
				$arr[$row['restaurent_id']] = $row['restaurent_name'];
			}
		} 
	return $arr;
}
 

function modify_url($mod, $url = FALSE){
    // If $url wasn't passed in, use the current url
    if($url == FALSE){
        $scheme = $_SERVER['SERVER_PORT'] == 80 ? 'http' : 'https';
        $url = $scheme.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }
    // Parse the url into pieces
    $url_array = parse_url($url);
    // The original URL had a query string, modify it.
    if(!empty($url_array['query'])){
        parse_str($url_array['query'], $query_array);
        foreach ($mod as $key => $value) {
            if(!empty($query_array[$key])){
                $query_array[$key] = $value;
            }
        }
    }
    // The original URL didn't have a query string, add it.
    else{
        $query_array = $mod;
    }
	
	$url_array['path'] = implode('/', array_filter(explode('/',$url_array['path'])));
	  
    return $url_array['scheme'].'://'.$url_array['host'].'/'.$url_array['path'].'?'.http_build_query($query_array);
}

function record_pt_allergy_visit($field_value){
	global $Global_member;
	global $_GET;  
	$acc_log = new hm_access_log(); 
	$acc_log->create($Global_member['id'],$field_value,'allergy',$_GET['f_mode']); 
	unset($acc_log); 
	return $field_value;
}

function record_pt_drug_visit($field_value){
	global $Global_member;
	global $_GET;  
	$acc_log = new hm_access_log(); 
	$acc_log->create($Global_member['id'],$field_value,'drug',$_GET['f_mode']); 
	unset($acc_log); 
	return $field_value;
}

function biz_pagination($array,&$allpages=0,&$currentpage=0) {
    $limit = $array['limit'];
    $offset = $array['offset'];
    $count = $array['count'];
    $fields = $array['fields'];
    
    if(!is_not_empty($array['offset_word'])){
      $array['offset_word'] = 'offset';
    }
    $outPut='';
	if (!is_gt_zero_num($limit)){
        $limit = 10;
 	}
	    $totalpages = ceil($count / $limit);
		$currentpage = ceil($offset / $limit) + 1;
	$baseurl =$array['url']; preg_replace('/[\&\?]'.$word.'\=[0-9]*/','',$array['url']);

     $field_cntr = 0;
     if(is_not_empty($fields)){
        foreach ($fields as $field_name=>$field_value){
          if($field_cntr == 0){
            $baseurl .= '?'.$field_name.'='.$field_value;
          }else{
            $baseurl .= '&'.$field_name.'='.$field_value;
          }
          $field_cntr++;
        }
     }

	//only display if there is content to paginate through or if we already have an offset
	if ($count > $limit || $offset > 0) {


$outPut .='<div class="pagination">';

	if ($offset > 0) {

		$prevoffset = $offset - $limit;
		if ($prevoffset < 0) $prevoffset = 0; 
		$prevurl = $baseurl;
		if (substr_count($baseurl,'?')) {
			$prevurl .= '&'.$array['offset_word'].'=' . $prevoffset;
		} else {
			$prevurl .= '?'.$array['offset_word'].'=' . $prevoffset;
		} 
		$outPut .= ' <a href="'.$prevurl.'" class="pagination_previous">&laquo; previous</a> ';

	}

	if ($offset > 0 || $offset < ($count - $limit)) {

		$currentpage = round($offset / $limit) + 1;
		$allpages = ceil($count / $limit);

		$i = 1;
		$pagesarray = array();
		while ($i <= $allpages && $i <= 4) {
			$pagesarray[] = $i;
			$i++;
		}
		$i = $currentpage - 2;
		while ($i <= $allpages && $i <= ($currentpage + 2)) {
			if ($i > 0 && !in_array($i,$pagesarray))
				$pagesarray[] = $i;
			$i++;
		}
		$i = $allpages - 3;
		while ($i <= $allpages) {
			if ($i > 0 && !in_array($i,$pagesarray))
				$pagesarray[] = $i;
			$i++;
		}

		sort($pagesarray);

		$prev = 0;
		foreach($pagesarray as $i) {
			if (($i - $prev) > 1) {
				$outPut .= ' <span class="pagination_more">...</span>';
			}

			$counturl = $baseurl;
			$curoffset = (($i - 1) * $limit);
			if (substr_count($baseurl,'?')) {
				$counturl .=  '&'.$array['offset_word'].'=' . $curoffset;
			} else {
				$counturl .=  '?'.$array['offset_word'].'=' . $curoffset;
			}

			if ($curoffset != $offset) {
				$outPut .= ' <a href="'.$counturl.'" class="pagination_number">'.$i.'</a> ';
			} else {
				$outPut .= ' <span class="pagination_currentpage">'.$i.'</span> ';
			}
			$prev = $i;

		}

	}

	if ($offset < ($count - $limit)) {

		$nextoffset = $offset + $limit;
		if ($nextoffset >= $count) $nextoffset--;

		$nexturl = $baseurl;
		if (substr_count($baseurl,'?')) {
			$nexturl .=  '&'.$array['offset_word'].'=' . $nextoffset;
		} else {
			$nexturl .=  '?'.$array['offset_word'].'=' . $nextoffset;
		}

		$outPut .= ' <a href="'.$nexturl.'" class="pagination_next">next &raquo;</a> ';

	}
$outPut .='<div class="clearfloat"></div>';
$outPut .='</div>';

    } // end of pagination check if statement
    return $outPut;
 }


//..function to genarate the qrcode image based on the any link
function generate_qr_code($content,$size= '150x150',$correction='L',$encoding='UTF-8'){
/*  The sample values for each parameter is as follows.
http://www.onextrapixel.com/2011/10/12/build-your-own-qr-code-generator-with-google-chart-api/
    <fieldset>
        <legend>Size:</legend>
        <input type="radio" name="size" value="150x150" checked>150x150<br>
        <input type="radio" name="size" value="200x200">200x200<br>
        <input type="radio" name="size" value="250x250">250x250<br>
        <input type="radio" name="size" value="300x300">300x300<br>
    </fieldset>
    <fieldset>
        <legend>Encoding:</legend>
        <input type="radio" name="encoding" value="UTF-8" checked>UTF-8<br>
        <input type="radio" name="encoding" value="Shift_JIS">Shift_JIS<br>
        <input type="radio" name="encoding" value="ISO-8859-1">ISO-8859-1<br>
    </fieldset>
    <fieldset>
        <legend>Content:</legend>
        <textarea name="content"></textarea>
    </fieldset>
    <fieldset>
        <legend>Error correction:</legend>
            <select name="correction">
                <option value="L" selected>L</option>
                <option value="M">M</option>
                <option value="Q">Q</option>
                <option value="H">H</option>
            </select>
     </fieldset>

    $size          = '150x150';//$_REQUEST['size'];
    $content       = 'http://google.co.in';//$_REQUEST['content'];
    $correction    = strtoupper('L');
    $encoding      = 'UTF-8';//$_REQUEST['encoding'];
*/
    $correction    = strtoupper($correction);
      
    $rootUrl = 'https://chart.googleapis.com/chart?cht=qr&chs='.$size.'&chl='.$content.'&choe='.$encoding.'&chld='.$correction;

    return '<img src="'.$rootUrl.'" />';
}

function biz_arr_search($array, $key, $value){
	$results = array();

    if (is_array($array)){
        if (isset($array[$key]) && $array[$key] == $value)
            $results[] = $array;

        foreach ($array as $subarray)
            $results = array_merge($results, biz_arr_search($subarray, $key, $value));
    } 
	return $results;
}

function curPageURL() {
	 $pageURL = 'http';
	 $new_query_string = '';// http_build_query($_GET);
	 if ($_SERVER['HTTPS'] == 'on') {$pageURL .= 's';}
	 $pageURL .= '://';
	 if ($_SERVER['SERVER_PORT'] != '80') {
	  $pageURL .= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'].$new_query_string;
	 } else {
	  $pageURL .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].$new_query_string;
	 }
	 
	 return $pageURL;
}

function getmetroByState($states_id=0){
	$arr = array();
	if(is_gt_zero_num($states_id)){
		 $query = 'select * from metro_area where metro_abv  = (select states_abbrev from hm_states where states_id = '.$states_id.')'; 
	}else{
		
		$query = 'select * from metro_area';
	}
	
	$results = mysql_query($query);

    if($results){ 
         while ($row = mysql_fetch_assoc($results)) {
          $arr[$row['metro_id']] = $row['metro_name'];
        }
        mysql_free_result($results);
    }
  return $arr;
	
}

function biz_zerofill($num,$zerofill) {
    while (strlen($num)<$zerofill) {
        $num = '0'.$num;
    }
    return $num;
}

function getBizOwnerId($biz_id){
	if(is_gt_zero_num($biz_id)){
        $res = mysql_query('SELECT userid FROM pds_list where id= '.$biz_id);
		if($res  && is_gt_zero_num(mysql_num_rows($res))){
			$result = mysql_result($res, 0);
			if(is_gt_zero_num($result)){
				return $result;
			} 
 		}
 	}
 	return 0;
}

function getMeBusinessIdByPromotion($promotion_id){
    $sql_qry = ' SELECT `list_id` FROM  `pds_list_promotions` WHERE `id`='.$promotion_id;
    $res = mysql_query($sql_qry);
	if ($res){
        return mysql_result($res, 0);
 	}
    return 0;
}

function biz_file_get_contents($vURL){
	global $webtitle;
	$curl_handle=curl_init();
	curl_setopt($curl_handle, CURLOPT_URL,$vURL);
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_USERAGENT, $webtitle);
	$str = curl_exec($curl_handle);
	curl_close($curl_handle);
	return $str;
}

function system_messages($message = "", $register = "messages", $count = false) {
			
	if (!isset($_SESSION['msg'])) {
		$_SESSION['msg'] = array();
	}
	if (!isset($_SESSION['msg'][$register]) && !empty($register)) {
		$_SESSION['msg'][$register] = array();
	}
	if (!$count) {
		if (!empty($message) && is_array($message)) {
			$_SESSION['msg'][$register] = array_merge($_SESSION['msg'][$register], $message);
			var_export($_SESSION['msg']); exit;
			return true;
		} else if (!empty($message) && is_string($message)) {
			$_SESSION['msg'][$register][] = $message;
			return true;
		} else if (is_null($message)) {
			if ($register != "") {
				$returnarray = $_SESSION['msg'][$register];
				$_SESSION['msg'][$register] = array();
			} else {
				$returnarray = $_SESSION['msg'];
				$_SESSION['msg'] = array();
			}
			return $returnarray;
		}
	} else {
		if (!empty($register)) {
			return sizeof($_SESSION['msg'][$register]);
		} else {
			$count = 0;
			foreach($_SESSION['msg'] as $register => $submessages) {
				$count += sizeof($submessages);
			}
			return $count;
		}
	}
	return false;
			
}

function system_message($message) {
			return system_messages($message, "messages");
}


function biz_ajax_pagination($array) {
    $limit = $array['limit'];
    $offset = $array['offset'];
    $count = $array['count'];
    $fields = $array['fields'];
    
    if(!is_not_empty($array['function_name'])){
      $array['function_name'] = "pagination";
    }
    $outPut="";
	if (!is_gt_zero_num($limit)){
        $limit = 10;
 	}
	    $totalpages = ceil($count / $limit);
		$currentpage = ceil($offset / $limit) + 1;
	 
	$baseurl = "";
     $field_cntr = 0;
     if(is_not_empty($fields)){
        foreach ($fields as $field_name=>$field_value){ 
            $baseurl .= "'{$field_value}',"; 
          $field_cntr++;
        }
     }

	//only display if there is content to paginate through or if we already have an offset
	if ($count > $limit || $offset > 0) {


$outPut .="<div class=\"pagination\">";

	if ($offset > 0) {

		$prevoffset = $offset - $limit;
		if ($prevoffset < 0) $prevoffset = 0; 
		  
		$prevurl = "{$array['function_name']}(" .$baseurl."".$prevoffset.");"; 
		$outPut .= " <a href=\"#\" onclick=\"{$prevurl}\" class=\"pagination_previous\">&laquo; previous</a> "; 
	}

	if ($offset > 0 || $offset < ($count - $limit)) {

		$currentpage = round($offset / $limit) + 1;
		$allpages = ceil($count / $limit);

		$i = 1;
		$pagesarray = array();
		while ($i <= $allpages && $i <= 4) {
			$pagesarray[] = $i;
			$i++;
		}
		$i = $currentpage - 2;
		while ($i <= $allpages && $i <= ($currentpage + 2)) {
			if ($i > 0 && !in_array($i,$pagesarray))
				$pagesarray[] = $i;
			$i++;
		}
		$i = $allpages - 3;
		while ($i <= $allpages) {
			if ($i > 0 && !in_array($i,$pagesarray))
				$pagesarray[] = $i;
			$i++;
		}

		sort($pagesarray);

		$prev = 0;
		foreach($pagesarray as $i) {
			if (($i - $prev) > 1) {
				$outPut .= " <span class=\"pagination_more\">...</span> ";
			}

			 
			$curoffset = (($i - 1) * $limit);
			$counturl = "{$array['function_name']}(".$baseurl."".$curoffset.");";
			 
			if ($curoffset != $offset) {
				$outPut .= " <a href=\"#\" onclick='{$counturl}' class=\"pagination_number\">{$i}</a> ";
			} else {
				$outPut .= " <span class=\"pagination_currentpage\"> {$i} </span> ";
			}
			$prev = $i;

		}

	}

	if ($offset < ($count - $limit)) {

		$nextoffset = $offset + $limit;
		if ($nextoffset >= $count) $nextoffset--; 
		$nexturl = "{$array['function_name']}(" . $baseurl."".$nextoffset.");";
		 

		$outPut .= " <a href=\"#\" onclick=\"{$nexturl}\" class=\"pagination_next\">next &raquo;</a> ";

	}
$outPut .="<div class=\"clearfloat\"></div>";
$outPut .="</div>";

    } // end of pagination check if statement
    return $outPut;
 }
 
 function biz_set_sorting_var(&$sort_by,&$new_sort,$dflt_sort="ASC"){
 	 if(isset($_REQUEST[SORT_BY])){ 
		 $sort_by = get_input(SORT_BY,$dflt_sort);
		 if(strcasecmp($sort_by, 'desc')==0){
			$new_sort = 'ASC';
		}else{
			$new_sort = 'DESC';
		}
	}else{
		$sort_by = $dflt_sort;
		if(strtoupper($sort_by)=='ASC'){
			 $new_sort = 'DESC';
		}else{
			 $new_sort = 'ASC';
		}
		
	}
	return true;
 }
 
 function compress_image($source_url, $destination_url, $quality) { 
 		$info = getimagesize($source_url); 
		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source_url); 
		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source_url); 
		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source_url); 
		
		imagejpeg($image, $destination_url, $quality); 
		return $destination_url; 
}
 
function SaveFile(&$vFile,$fld_name,$save_path='',$file_save_nm=''){
	if(is_not_empty($save_path)==false)
	$save_path=PATHROOT.MNU_IMG_UPLOAD_PATH;
	$_FILES = $vFile;			
	$allowedExts = array('gif', 'jpeg', 'jpg', 'png');
	$extension = strtolower(end(explode('.', $_FILES[$fld_name]['name'])));
	
	$max_file_size = 1024*200; // 200kb
	
	//&& ($_FILES[$fld_name]['size'] < 20000)
	if ((($_FILES[$fld_name]['type'] == 'image/gif')
	|| ($_FILES[$fld_name]['type'] == 'image/jpeg')
	|| ($_FILES[$fld_name]['type'] == 'image/jpg')
	|| ($_FILES[$fld_name]['type'] == 'image/png'))	
	&& in_array($extension, $allowedExts)){
	  if ($_FILES[$fld_name]['error'] > 0){
	    	return 'Error: ' . $_FILES[$fld_name]['error'] . '<br>';
	  }else{
	    /*
		echo 'Upload: ' . $_FILES[$fld_name]['name'] . '<br>';
	    echo 'Type: ' . $_FILES[$fld_name]['type'] . '<br>';
	    echo 'Size: ' . ($_FILES[$fld_name]['size'] / 1024) . ' kB<br>';
	    echo 'Temp file: ' . $_FILES[$fld_name]['tmp_name'] . '<br>';
		*/
	    if (file_exists($save_path . $file_save_nm)){
	      	//echo $_FILES[$fld_name]['name'] . ' already exists. ';
					//return 'Error: file already exists';
					unlink($save_path.$file_save_nm);
	    }
					
	    if(move_uploaded_file($_FILES[$fld_name]['tmp_name'],$save_path . $file_save_nm)){
				
				if($_FILES[$fld_name]['size'] > $max_file_size){
						$_sfile = compress_image($save_path . $file_save_nm, $save_path . $file_save_nm, 50);			
				}		
				
			}
	    //echo 'Stored in: ' . 'upload/' . $_FILES[$fld_name]['name'];
		return 1;		    
	  }
   }else{
	  return 'Error: Invalid file :allowed types :gif,jpeg,jpg,png';
   }		
} //..how to use the function 

function chk_if_active($strDt){
	$is_active=0;
	//echo "$strDt - \n";
	if((is_not_empty($strDt)==false)|| ($strDt==EMPTY_DATE_FORMAT)|| ($strDt==0) || (is_gt_zero_num(strtotime($strDt)== false))){
		$is_active=1;		
	}else{					
		//..check the deactive date is greater than todays date
		if(strtotime($strDt) > strtotime(date(DATE_FORMAT))){
			$is_active = 1;
		}
	}		
	return $is_active;	
}

/**
* It will check whether the record is active or not from the end date of record  
* @param date $endDate -- end date of the record
* @return Integer_boolean 
*/ 
function chk_if_record_active($endDate){
	$is_active=0;
	//echo "$strDt - \n";
	if((is_not_empty($endDate)==false)|| ($endDate==EMPTY_DATE_FORMAT)|| ($endDate==0) || (is_gt_zero_num(strtotime($endDate)== false))){
		$is_active=1;		
	}else{					
		//..check the deactive date is greater than todays date
		if(strtotime($endDate) > strtotime(date(DATE_FORMAT))){
			$is_active = 1;
		}
	}		
	return $is_active;	
}

/**
* 
* @param string $delimiter default(',')
* @param string $string		 -- string for exploding
* @return array();
*/

function biz_explode($delimiter, $str){
	$arr = array();
	if(is_not_empty($delimiter)==false) $delimiter = ','; 
	if(is_not_empty($str)){
		$tmp = explode($delimiter,$str); 
		if(is_array($tmp)) 	$arr 		= $tmp;
		else 								$arr[0] = $tmp; 
	}   
	return $arr;
}

function biz_implode($delimiter, $arr){
	$str = '';
	if(is_not_empty($delimiter)==false) $delimiter = ',';
	if(is_not_empty($arr)){
		if(is_array($arr)){
			$str = implode($delimiter,$arr);
		} 
	} 
	return $str;
}

/**
* check whether the date is proper
* @param date $date
* @return boolean
*/

function isValidDate($date){ 
	 if(is_not_empty($date)){  
	 	$str_date = strtotime($date); 
		if(is_gt_zero_num($str_date)){ 
			if (checkdate(date('m',$str_date),date('d',$str_date),date('y',$str_date))){
			return true;
			}
		} 
	 } 
		return false;
}
 
/**
* Return till last Week's start and end date range from day
* @param date $date
* @return array
*/ 
function biz_week_range($date = 'now') {
    $ts = strtotime($date);
	$week =  date('W', $ts);
	$lst = array();
	while($week <= 52){
		$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
		$lst[$week]['start'] = date('d M', $start);
		$lst[$week]['end'] = date('d M', strtotime('next saturday', $start));
		$ts = strtotime("+1 week", $ts);  
		$week++;
	}
    return $lst;
}

/**
* Return all 7 days array according to week and year
* @param integer $week
* @param string $year
* @return array
*/
function biz_getWeekdays($week= NULL,$year=NULL){
	$weekdays = array(); 
	$week = (is_not_empty($week)?$week:date('W')); 
  	$year = (is_not_empty($year)?$year:date('Y')); 
	for($day=1; $day<=7; $day++){
	   $weekdays[]= date(DAY_FORMAT, strtotime($year."W".$week.$day))."\n";
	}
	return $weekdays;
}

/**
* Return all 7 days array according to week and year
* @param integer $week
* @param string $year
* @return array
*/
function biz_getMonthdays($month= NULL,$year=NULL){
	$monthdays = array(); 
	 
	$month = (is_not_empty($month)?$month:date('m')); 
  $year = (is_not_empty($year)?$year:date('Y')); 
	$cntmonthday = cal_days_in_month(CAL_GREGORIAN,$month,$year);
	for($day=1; $day<=$cntmonthday; $day++){
	   $monthdays[$day]= $year.'-'.$month.'-'.$day;
	} 
	return $monthdays;
}
 

/**
* Convert the secondst to minute
* @param integer $seconds
* @param string $suffix 
* @return string
*/
function biz_convSecToMin($seconds,$suffix='min'){
	 $strOp = '';
	 if(is_not_empty($seconds)){
	 	$is_negative = 0;
		if(is_gt_zero_num($seconds)==false && ($seconds != 0)){
				$seconds = abs($seconds);
				$is_negative = 1; 
		 }
	 	
	 	 $min =  $seconds / 60;
		 $rem =  $seconds % 60;
		 if($rem!=0){
		 	/*if($rem >= 30){
		 		$strOp = 'more than ';
				$min = ceil($min);
			 }else{
			 	$strOp = 'less than ';
				$min = ceil($min);
			 }*/
			  
			 $min = floor($min).':'.biz_zerofill(abs($rem),2);
		 }else{
		 		$min = floor($min);
		 } 
		 
		 if($is_negative){
		 	 $min = '-'.$min;
		 }
		 
		 //.. add min to string 		
		 $strOp .= $min;
		 
		 if(is_not_empty($suffix)){
		 		$strOp .= ' '.$suffix;
		 }
	 }
	return $strOp;
}

/**
* Return the client IP Address
* @return string
*/
function biz_getIPAddress(){
	$ip = '';
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip; 
}

 function GetPromotionTitle($prom_id){
	 	  $arr = array(); 
	 	  if($res = mysql_query('SELECT id,title FROM `pds_list_promotions` WHERE id='.$prom_id)){
				$x = 0;
				while($row = mysql_fetch_assoc($res)){
					$arr=$row; 
					$x++;
				}
		  }
		 return $arr;	
	}
	
 /**
 * Return different values array from two array
 * @param array $array1
 * @param array $array2
 * @return array
 */	 
 function biz_array_diff($array1,$array2){
 	 return array_merge(array_diff($array1, $array2), array_diff($array1, $array2));  
 }
 
 
 /**
 * Return the customer claimed promotion for the current table session Or Assign the Order Passed to them if forced_orders have the order id. 
 * @param int $cust_sess_id
 * @param int $forced_order
 * @return string
 */ 
function getPromsClaimedForCust($cust_sess_id,$forced_order=0){ 	 $claimed_coupons = ''; 	
	 $cust_id = 0;
	 $cust_type = CUST_TYPE_LOGIN; 
	 if(isCustomer()){
	 	 $cust_id = getCustomerId($cust_type); 
		 $claimed_coupons  = DB::ExecScalarQry ('SELECT GROUP_CONCAT(id) FROM `pds_redim_cupons` WHERE `customer_type` = \''.$cust_type.'\' AND `user_id` = '.$cust_id.' AND `order_id` = 0  AND `cust_sess_id`='.$cust_sess_id); 
	 if(is_not_empty($claimed_coupons)){ 
			if(is_gt_zero_num($forced_order)){
				 return	DB::ExecNonQry('UPDATE `pds_redim_cupons` SET `order_id`='.$forced_order.' WHERE id in ('.$claimed_coupons.') AND `order_id`=0');
			}else{
				return $claimed_coupons;
			}
	   }
	 } 
	return OPERATION_FAIL; 
}

//..function to claim the promotion also check if already exits
 
function customer_claim_promotion($promotion_id,$user_id,$customer_name,$rwd_deals_sel='',$rwd_usr_id=0,$cust_sess_id=0,$cup_serv_pin=0,$rwd_points=0,$rwd_invoice=''){

	 $customer_type = CUST_TYPE_LOGIN;
	
	 /*
	 if(is_gt_zero_num($_SESSION[SES_CUSTOMER_SESSION])){
	 	$cust_sess_id=$_SESSION[SES_CUSTOMER_SESSION];
	 }else{
	 	$cust_sess_id=tbl_table_customer_session::GetCurrentActiveCustSession($_SESSION[SES_TABLE]);   
	 }	
	 */
		 
 // if(is_gt_zero_num($cust_sess_id)){
		/*//..check if the promotion is already claimed
		$sql='SELECT COUNT(`id`) FROM pds_redim_cupons WHERE `user_id`='.$user_id.' AND `cust_sess_id`='.$cust_sess_id.' AND `promotion_id`='.$promotion_id.' AND `customer_name`=\''.$customer_name.'\' AND `customer_type`=\''.$customer_type.'\'';
		$isAlreadythere=DB::ExecScalarQry($sql);
		if(is_gt_zero_num($isAlreadythere)){			
			return -1;
		}else{
			$sql_prm = '('.$user_id.', '.$cust_sess_id.',\''.$rwd_deals_sel.'\', '.$promotion_id.', \''.date(DATE_FORMAT).'\', 1, \''.$customer_name.'\', \''.$customer_type.'\')'; 
			$sql='INSERT INTO pds_redim_cupons (`user_id`, `cust_sess_id`,`rwd_deals_sel`,`promotion_id`,`created_date`,`user_redimed`,`customer_name`,`customer_type`) VALUES '.$sql_prm.';';
			$id=DB::ExecNonQry($sql,1);			
			if(is_gt_zero_num($id)){
				$_SESSION[SES_FLASH_MSG]  = '<div class="success">'.$_lang['claim_success'].'.</div>';
				attachCouponsToOrder($cust_sess_id,$user_id,$customer_type,0,0,$id);
				return 1;
			}		
		}	*/	
		//..first fetch the reward details
		$obj_biz_rewards=new biz_rewards();
		$rwd_details=biz_rewards::GetInfo($rwd_deals_sel);
		//$rwd_points=0;
		if(is_gt_zero_num($cust_sess_id)==FALSE)
		 		$cust_sess_id=0;
				
		if($_SESSION['rest_menu_opt_det'][RST_MNU_REWARD_CONF]=='RESTAURANT' && $Global_member['member_role_id'] != ROLE_SERVER){
				$cup_serv_pin=0;
		}		
					
		//..if reward type is basic then only add points to redeem		
		if($rwd_details[RWD_LR_TYPE]=='b'){
			$rwd_points=$rwd_details[RWD_POINT_LIMIT];
		}
		$sql_prm = '('.$user_id.', '.$cust_sess_id.',\''.$rwd_deals_sel.'\', '.$rwd_usr_id.', '.$rwd_points.', '.$promotion_id.', \''.date(DATE_FORMAT).'\', 1, \''.$customer_name.'\', \''.$customer_type.'\','.$cup_serv_pin.', NOW(),\''.$rwd_invoice.'\')'; 
			$sql='INSERT INTO pds_redim_cupons (`user_id`, `cust_sess_id`,`rwd_deals_sel`,`rwd_usr_id`,`rwd_points`,`promotion_id`,`created_date`,`user_redimed`,`customer_name`,`customer_type`,`cup_serv_pin`,`redimed_date`,`rwd_invoice`) VALUES '.$sql_prm.';';
			//echo $sql;
			$id=DB::ExecNonQry($sql,1);			
			if(is_gt_zero_num($id)){
				$_SESSION[SES_FLASH_MSG]  = '<div class="success">'.$_lang['claim_success'].'.</div>';
				//..attachCouponsToOrder($cust_sess_id,$user_id,$customer_type,0,0,$id);
				return 1;
			}		
  //}
	return 0;
	
}

/**
* Attach Claimed Coupons To Order
* @param integer $table_id
* @param ingeter $cust_id
* @param string $cust_type
* @param ingeter $by_order
* @param ingeter $order_id
* @param ingeter $coupon_id
* 
*/
function attachCouponsToOrder($cust_sess_id,$cust_id,$cust_type=CUST_TYPE_COOKIE,$by_order=0,$order_id=0,$coupon_id=0){
	/*
	if(is_gt_zero_num($table_id)){
		//.. get customer table session
		$cust_sess_id =  checkNcreateSession($table_id);	*/
	 if(is_gt_zero_num($cust_sess_id)){
	 			if(is_gt_zero_num($order_id)==false){ 
					$order_id = tbl_orders::getCustSessionLastOrder($cust_sess_id,'',$cust_id,$cust_type);
	  		} 
					//..if by order table it is coming
					if(is_gt_zero_num($by_order)){ 
							if(is_gt_zero_num($order_id)){
								return	getPromsClaimedForCust($cust_sess_id,$order_id); 
							}  
				 }else{
				 	//..otherwise by coupon id attached order
						 if(is_gt_zero_num($coupon_id) && is_gt_zero_num($order_id)){
						 	return	DB::ExecNonQry('UPDATE `pds_redim_cupons` SET `order_id`='.$order_id.' WHERE id = '.$coupon_id.' AND `order_id`=0');
						 }
				 }
	 	}	  
/*	} */
	return OPERATION_FAIL;
}   

/**
* Return days difference.
* @param date $date1
* @param date $date2
* 
*/ 
function biz_getdaysdiff($date1,$date2){
	$numberDays = 0;
	if(isValidDate($date1) && isValidDate($date2)){
		
		$date1 	= strtotime(date('Y-m-d',strtotime($date1))); 
	 	$date2  = strtotime(date('Y-m-d',strtotime($date2)));
		$timeDiff = abs($date1 - $date2); 
		$numberDays = $timeDiff/86400;  // 86400 seconds in one day 
		// and you might want to convert to integer
		$numberDays = intval($numberDays); 
	}
	return $numberDays;	
}

/**
* unset the variable
* @param variable $var byReference
* @return void
*/
function biz_unset(&$var){
	 if(isset($var)){ 
	 	unset($var);
	 }
} 

/**
* gets the data from a URL
* @param undefined $url 
* @return
*/
function json_get_data($url){
    $ch = curl_init();
    $timeout = 5;
		try{
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		} catch (Exception $e) {
            var_dump($e->getMessage());
  	} 
    curl_close($ch);
    return $data;
}

function jsonobject2Array($d) {
	if (is_object($d)) {
		$d = get_object_vars($d);
	}
	if (is_array($d)) {
		return array_map(__FUNCTION__, $d);
	} else {
		return $d;
	}
}

/**
* convert latitude longitude to distance
* @param double $lat1
* @param double $long1
* @param double $lat2
* @param double $long2
* @return double
*/
function con_lat_long_to_dist($lat1,$long1,$lat2,$long2,$inMeter=0){
  // return '';
  $url='http://maps.googleapis.com/maps/api/distancematrix/json?origins='. $lat1 .','.$long1 .'&destinations='.$lat2 .','.$long2 .'&mode=driving&units=imperial&language=en&sensor=false';
	 //echo "url=".$url."<";
  $json_output =  json_decode(json_get_data($url, TRUE));
	//print_r($json_output);exit;
  $road = jsonobject2Array($json_output) ;
	$str = '';
	if(is_gt_zero_num($inMeter)){
		$str = 9999999; // ..if zero result is comming then it has the very huge distance
	}
	
   if(is_not_empty($road['rows'][0]['elements'][0]['distance']['text'])){
	 	if(is_gt_zero_num($inMeter)){
			$str = $road['rows'][0]['elements'][0]['distance']['value'];
		}else{
			$str = $road['rows'][0]['elements'][0]['distance']['text'];
		} 
 }
  return $str;
  /*
foreach ( $json_output->trends as $trend )
{
    echo "{$trend->name}\n";
}
    echo "<hr>";
  //echo $url;
  $json = file_get_contents($url);
  echo $json;

   $meta_tags = json_decode($json, TRUE);
  var_dump(json_decode($json, TRUE));
  echo "<hr>";
*/
  //$meta_tags = get_meta_tags("http://maps.googleapis.com/maps/api/distancematrix/json?origins={$lat1},{$long1}&destinations={$lat2},{$long2}&mode=driving&units=imperial&language=en&sensor=false");
  /*
$meta_tags = get_meta_tags("http://maps.googleapis.com/maps/api/distancematrix/json?origins={$lat1},{$long1}&destinations={$lat2},{$long2}&mode=driving&units=imperial&language=en&sensor=false");
  var_dump($meta_tags);
  exit;
  if (!empty($meta_tags) && is_array($meta_tags)) {
       if($meta_tags['rows']['element']['distance']['text']){
         return $meta_tags['rows']['element']['distance']['text'];
       }
  }
*/
}

function getTableLayoutSrc($table_id,$table_number,$table_seats,$table_party_size=0){
/*	global $CONFIG;
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $CONFIG->wwwroot.'ajax/getImageSrc.php?var1='.$table_seats.'&var2='.$table_party_size.'&var3='.urlencode($table_number).'&var4='.$table_id);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$a = curl_exec($ch);
if(preg_match('#Location: (.*)#', $a, $r))
 	$l = trim($r[1]);  
	echo $a;*/
	/*$img =  $CONFIG->wwwroot.'images/tables/'.$table_id.'.png' ;
	if(file_exists($CONFIG->path.'/images/tables/occupied/'.$table_id.'.png')){
		$img=  $CONFIG->wwwroot.'images/tables/occupied/'.$table_id.'.png';
	}
return $img; */
}


 $file_error_types = array(
		1=>'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
		2=>'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
		3=>'The uploaded file was only partially uploaded.',
		4=>'No file was uploaded.',
		6=>'Missing a temporary folder.',
		5=>'Failed to write file to disk.',
		6=>'A PHP extension stopped the file upload.'
 );
 
 //..function to email the promotion
	function email_menu_item($menu_id,$template_id,$subscriber_emails,$crm_id=0,$refer_by='',$msg_body='',$_filt_prom=array()){
	 	global $sending_email,$website;	 	
		$eml_cntnts="";
		
		if(is_not_empty($subscriber_emails)){			
			if(is_not_empty($menu_id)){
				if((count($menu_id)==1)){
					$dish_det=tbl_submenu_dishes::GetInfo(reset($menu_id));
					$eml_cntnts=nl2br($dish_det["sbmnu_dish_dish_details"][DISH_NOTES]);
					$strOp = '<h1 align="center">'.$dish_det["sbmnu_dish_dish_details"][DISH_NAME].'</h1>'.RET;				
					$_rest_under_consider=$dish_det["sbmnu_dish_dish_details"][DISH_RESTAURENT];
					$prom_link=biz_get_tiny_url($website."/user/tbl_submenu_dishes.php?sbmnu_dish_id=".$dish_det["sbmnu_dish_dish_details"][DISH_ID]."&is_preview=1");
					$subject = $dish_det["sbmnu_dish_dish_details"][DISH_NAME];
				}else{
					/*foreach($menu_id as $_each_mnu){
						$dish_det=tbl_submenu_dishes::GetInfo($_each_mnu);
						$prom_link = biz_get_tiny_url($website."/user/tbl_submenu_dishes.php?sbmnu_dish_id=".$_each_mnu."&is_preview=1");
						$eml_cntnts .= "<a href='{$prom_link}'>".$dish_det["sbmnu_dish_dish_details"][DISH_NAME]."</a><br/>" ; 
					}*/
					$_lst_mnu=implode(',',$menu_id);
					$prom_link =$website.'/user/tbl_menu_items_for_email_prom.php?sbmnu_dish_id='.$_lst_mnu; 
					$prom_link = biz_get_tiny_url($prom_link);
					$eml_cntnts .= "<a href='{$prom_link}'> Menu Items</a><br/>" ; 
					$sms_cnts=$eml_cntnts;
					
					$strOp = '<h1 align="center">New Menu Items</h1>'.RET;
					$_rest_under_consider=$_SESSION[SES_RESTAURANT];
					$subject = "New Menu Items";
				}
			}
			
			
			//if(is_not_empty($dish_det)){
				$restaurant_info = tbl_restaurent::GetInfo($_rest_under_consider);		
				
				//..the content can be based on the menu text or user provided text
				//$eml_cntnts=nl2br($dish_det["sbmnu_dish_dish_details"][DISH_NOTES]);
				if(is_not_empty($msg_body)){
					$eml_cntnts=$msg_body;
				}
				
				$strOp .= '<p style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$eml_cntnts.'</p>';  
				
				$customer_email = biz_implode(',',$subscriber_emails); 
				//$subject =  $dish_det[DISH_NAME].' From '.$restaurant_info[RESTAURENT_NAME];
				$subject .= " from ".$restaurant_info[RESTAURENT_NAME];
					
				// Always set content-type when sending HTML email
				$headers  = "MIME-Version: 1.0 "."\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1 "."\r\n";
				
				$headers .= "From: ".$restaurant_info[RESTAURENT_NAME]."<".$restaurant_info[RESTAURENT_EMAIL]. ">\r\n";
				$headers .= "Reply-To: ".$restaurant_info[RESTAURENT_NAME]." <".$restaurant_info[RESTAURENT_EMAIL]. ">\r\n";
				$headers .= "Return-Path: ".$restaurant_info[RESTAURENT_NAME]." <".$restaurant_info[RESTAURENT_EMAIL]. ">\r\n";
				
				$headers .= "Organization: ".$restaurant_info[RESTAURENT_NAME]."\r\n";

				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
				
				$content = "<html><body style=\"font-family: Arial !important;font-size:12px;\">";
				if(count($subscriber_emails)==1)
			 		$content .= "Hello {$customer_email}, <br/>";
				else
					$content .= "Hello , <br/>";
						
				$content .= "{$strOp} <br/>" ;
				
				if(is_not_empty($menu_id) && (count($menu_id)==1)){
					$content .= "Follow this <a href='{$prom_link}'>link </a><br/>" ; 
				}
				if(is_not_empty($refer_by)){
					$content .= "<br>This menu is recommended to you by your friend {$refer_by}. <br/>" ; 
				}
				$content .= "<br/>Thanks,<br/>";
				//$content .= "<a href='{$website}'>".$restaurant_info[RESTAURENT_NAME]."</a>";
				$content .= $restaurant_info[RESTAURENT_NAME];
				
				$content .= "<br/><br/>";
				
				//$content .= "To unsubscribe from menu subscription <a href='{$website}/user/tbl_crm_unsubscribe.php?crm_id={$crm_id}' target='_blank'>click here</a>";
				
				//..Finally send the email with the above content
				try {
					//echo "{$subject}<hr>{$customer_email}<hr>{$content}<hr>{$prom_link}-<br><br>";
					$_is_sub=tbl_crm::is_subscribed_usr('',$restaurant_info[RESTAURENT_ID],$customer_email);					
					$isSuccess=0;
					if(is_gt_zero_num($_is_sub)){
						$content .= "To unsubscribe from promotion subscription <a href='{$website}/user/tbl_crm_unsubscribe.php?crm_id={$_is_sub}' target='_blank'>click here</a>";
						$isSuccess=mail($customer_email, $subject, $content, $headers,'-f'.$restaurant_info[RESTAURENT_EMAIL]);
					}	
				
					//exit;						
				}catch(Exception $e){
				  // echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
				return $isSuccess;
				
		}
		return FALSE;
	}
	
	//..function to email the promotion
	function email_preview_menu($menu_id,$msg_body='',$_ret_me_arr=0){
	 		global $sending_email,$website;
			$refer_by='';
			//$restaurant_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
			$eml_cntnts="";
			$sms_cnts="";
			if(is_not_empty($menu_id)){
				if((count($menu_id)==1)){
					$dish_det=tbl_submenu_dishes::GetInfo(reset($menu_id));
					$eml_cntnts=nl2br($dish_det["sbmnu_dish_dish_details"][DISH_NOTES]);
					$strOp = '<h1 align="center">'.$dish_det["sbmnu_dish_dish_details"][DISH_NAME].'</h1>'.RET;				
					$_rest_under_consider=$dish_det["sbmnu_dish_dish_details"][DISH_RESTAURENT];
					$prom_link=biz_get_tiny_url($website."/user/tbl_submenu_dishes.php?sbmnu_dish_id=".$dish_det["sbmnu_dish_dish_details"][DISH_ID]."&is_preview=1");
					$sms_cnts .= "<a href='{$prom_link}'>".$dish_det["sbmnu_dish_dish_details"][DISH_NAME]."</a><br/>" ;
				}else{
					/*foreach($menu_id as $_each_mnu){
						$dish_det=tbl_submenu_dishes::GetInfo($_each_mnu);
						$prom_link = biz_get_tiny_url($website."/user/tbl_submenu_dishes.php?sbmnu_dish_id=".$_each_mnu."&is_preview=1");
						$eml_cntnts .= "<a href='{$prom_link}'>".$dish_det["sbmnu_dish_dish_details"][DISH_NAME]."</a><br/>" ; 
					}*/
					$_lst_mnu=implode(',',$menu_id);
					$prom_link =$website.'/user/tbl_menu_items_for_email_prom.php?sbmnu_dish_id='.$_lst_mnu; 
					$prom_link = biz_get_tiny_url($prom_link);
					$eml_cntnts .= "<a href='{$prom_link}'> Menu Items</a><br/>" ; 
					$sms_cnts=$eml_cntnts;
					
					$strOp = '<h1 align="center">New Menu Items</h1>'.RET;
					$_rest_under_consider=$_SESSION[SES_RESTAURANT];
					//$sms_cnts .= "<a href='{$prom_link}'>".$dish_det["sbmnu_dish_dish_details"][DISH_NAME]."</a><br/>" ;
				}
			}			
			
			//if(is_not_empty($dish_det)){
				$restaurant_info = tbl_restaurent::GetInfo($_rest_under_consider);		
				
				//..the content can be based on the menu text or user provided text
				//$eml_cntnts=nl2br($dish_det[DISH_NOTES]);
				if(is_not_empty($msg_body)){
					$eml_cntnts=$msg_body;
				}
				
				$strOp .= '<p style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$eml_cntnts.'</p>';  
				
				$customer_email = biz_implode(',',$subscriber_emails); 
				//$subject =  $dish_det[DISH_NAME].' From '.$restaurant_info[RESTAURENT_NAME];
				$subject =  'New Menu Item From '.$restaurant_info[RESTAURENT_NAME];					
								
				$content = "<html><body style=\"font-family: Arial !important;font-size:12px;\">";
				if(count($subscriber_emails)==1)
			 		$content .= "Hello {$customer_email}, <br/>";
				else
					$content .= "Hello , <br/>";
						
				$content .= "{$strOp} <br/>" ;
				
				if(is_not_empty($menu_id) && (count($menu_id)==1)){
					$content .= "Follow this <a href='{$prom_link}'>link </a><br/>" ; 
				}
				if(is_not_empty($refer_by)){
					$content .= "<br>This menu is recommended to you by your friend {$refer_by}. <br/>" ; 
				}
				$content .= "<br/>Thanks,<br/>";
				//$content .= "<a href='{$website}'>".$restaurant_info[RESTAURENT_NAME]."</a>";
				$content .= $restaurant_info[RESTAURENT_NAME];
				
				$content .= "<br/><br/>";
				
				if($_ret_me_arr==1){
					return array('msg'=>$eml_cntnts,'preview'=>$content,'sms_txt'=>($restaurant_info[RESTAURENT_NAME].'-'.$sms_cnts));					 
				}else{
					return $content;
				}
	}
	
	//..function to sms the promotion
	function sms_menu_item($menu_id,$subscriber_phones,$crm_id=0,$sms_msg='',$_filt_prom=array()){
	 	global $sending_email,$website,$config;
		
		if(is_not_empty($subscriber_phones)){
			$eml_cntnts="";
			if(is_not_empty($menu_id)){
				if((count($menu_id)==1)){
					$dish_det=tbl_submenu_dishes::GetInfo($menu_id[0]);	
					$_rest_under_consider=$dish_det["sbmnu_dish_dish_details"][DISH_RESTAURENT];
					$prom_link=biz_get_tiny_url($website."/user/tbl_submenu_dishes.php?sbmnu_dish_id=".$dish_det["sbmnu_dish_dish_details"][DISH_ID]."&is_preview=1");
					$eml_cntnts .= "<a href='{$prom_link}'>".$dish_det["sbmnu_dish_dish_details"][DISH_NAME]."</a><br/>" ; 
				}else{
					/*foreach($menu_id as $_each_mnu){
						$dish_det=tbl_submenu_dishes::GetInfo($_each_mnu);
						$prom_link = biz_get_tiny_url($website."/user/tbl_submenu_dishes.php?sbmnu_dish_id=".$_each_mnu."&is_preview=1");
						$eml_cntnts .= "<a href='{$prom_link}'>".$dish_det["sbmnu_dish_dish_details"][DISH_NAME]."</a><br/>" ; 
					}	*/	
					$_lst_mnu=implode(',',$menu_id);
					$prom_link =$website.'/user/tbl_menu_items_for_email_prom.php?sbmnu_dish_id='.$_lst_mnu; 
					$prom_link = biz_get_tiny_url($prom_link);
					$eml_cntnts .= "<a href='{$prom_link}'> Menu Items</a><br/>" ; 
	
					$_rest_under_consider=$_SESSION[SES_RESTAURANT];
				}
			}	
			$restaurant_info = tbl_restaurent::GetInfo($_rest_under_consider);
				$_unsub_lnk='';
			
				if(is_not_empty($sms_msg)){
					$strOp = "{$sms_msg} - {$prom_link}";
				}else{
					$strOp = " Use link {$prom_link}, From ".$restaurant_info[RESTAURENT_NAME];
				}
				
				//..Send SMS promotion			 				
				try {
					//echo $strOp. "{$subscriber_phones}- {$prom_link} -<hr>";
					//$isSuccess=send_sms_using_twilio($subscriber_phones,$strOp);
					//..if user is subscribed then only send sms to user 
					$_is_sub=tbl_crm::is_subscribed_usr($subscriber_phones,$restaurant_info[RESTAURENT_ID]);
					$isSuccess=0;
					if(is_gt_zero_num($_is_sub)){
						$_unsub_lnk = ' Unsubscribe:'.biz_get_tiny_url("{$website}/user/tbl_crm_unsubscribe.php?crm_id={$_is_sub}");
						$isSuccess=@send_sms_using_twilio($subscriber_phones,"{$strOp} {$_unsub_lnk}");
					}
					
					//exit;
				}catch(Exception $e) {
				  // echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
				
				return $isSuccess; 	
			
		}
		return FALSE;
	}
?>