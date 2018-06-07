<?php 


/*
//.. convert lat long to distance by inforesha
function con_lat_long_to_dist($lat1,$long1,$lat2,$long2){
    //echo "con_lat_long_to_dist($lat1,$long1,$lat2,$long2)";
    $earthsradius = 3963.19;
	$pi = pi();
	$c = sin($lat1/(180/$pi)) * sin($lat2/(180/$pi)) +
		cos($lat1/(180/$pi)) * cos($lat2/(180/$pi)) *
		cos($long2/(180/$pi) - $long1/(180/$pi));
	$distance = $earthsradius * acos($c);
	$distance = round($distance,2);
	return $distance;
}
*/
 

function getCatPath ($catid){

	global $pds_category;
	global $language;
	global $lang_set;
	
	$r = mysql_query ("SELECT * FROM $pds_category WHERE id='$catid';");
	$f = mysql_fetch_assoc($r);
	$catid = $f[id];
	$parent = $f[p];
	/*$title[] = $language->desc("category", $lang_set, $catid);*/
	$title[] = $f[title];
	mysql_free_result($r);
	while ($parent == true){
		$r = mysql_query ("SELECT * FROM $pds_category WHERE id='$parent';");
		$f = mysql_fetch_assoc($r);
		$parent = $f[p];
		$catid = $f[id];
		/*$title[] = $language->desc("category", $lang_set, $catid);*/
		$title[] = $f[title];
		mysql_free_result($r);
	}
	//...following changes made to show only listed category
	//$title = array_reverse($title);
	$ret  =$title[0];
	//$ret = implode(" - ", $title);
	return ($ret);
}

function TurnCatOn($cat_id){

	global $pds_category;
	
	$r = mysql_query ("SELECT * FROM $pds_category WHERE id='$cat_id';");
	$f = mysql_fetch_assoc($r);
	if(!$f['f_mt']){
		mysql_query ("UPDATE $pds_category SET f_mt='1' WHERE id='$cat_id';");
		$parent = $f[p];
		mysql_free_result($r);
		while ($parent == true){
			$r = mysql_query ("SELECT * FROM $pds_category WHERE id='$parent';");
			$f = mysql_fetch_assoc($r);
			mysql_query ("UPDATE $pds_category SET f_mt='1' WHERE id='$parent';");
			$parent = $f[p];
			mysql_free_result($r);
		}
	}
}

function TurnCatOff($cat_id){

	global $pds_category;
	global $pds_listcat;
	global $pds_list;
	
	$list_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM $pds_listcat lc INNER JOIN $pds_list l ON lc.list_id=l.id WHERE lc.cat_id='$cat_id' AND l.state='apr';"));
	if(!$list_count[0]){
		$r = mysql_query ("SELECT * FROM $pds_category WHERE id='$cat_id';");
		$f = mysql_fetch_assoc($r);
		mysql_query ("UPDATE $pds_category SET f_mt=NULL WHERE id='$cat_id';");
		$parent = $f[p];
		mysql_free_result($r);
		while ($parent == true){
			$list_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM $pds_listcat lc INNER JOIN $pds_list l ON lc.list_id=l.id INNER JOIN $pds_category c ON lc.cat_id=c.id WHERE c.p='$parent' AND l.state='apr';"));
			if($list_count[0] == 0){
				$r = mysql_query ("SELECT * FROM $pds_category WHERE id='$parent';");
				$f = mysql_fetch_assoc($r);
				mysql_query ("UPDATE $pds_category SET f_mt=NULL WHERE id='$parent';");
				$parent = $f[p];
				mysql_free_result($r);
			}else{
				break;
			}
		}
	}
}

function getTopCat($cat_id){

	global $pds_category;

	$r_top = mysql_query("SELECT * FROM $pds_category WHERE id='$cat_id';");
	$f_top = mysql_fetch_assoc($r_top);
	$parent = $f_top[p];
	$top_cat[id] = $f_top[id];
	$top_cat['title'] = $f_top['title'];
	mysql_free_result($r_top);
	while($parent == true){
		$r_top = mysql_query ("SELECT * FROM $pds_category WHERE id='$parent';");
		$f_top = mysql_fetch_assoc($r_top);
		$parent = $f_top[p];
		$top_cat[id] = $f_top[id];
		$top_cat['title'] = $f_top['title'];
	}
	return($top_cat);
}

function checkEmail($email) 
{
   if(eregi("^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]", $email)) 
   {
      return FALSE;
   }

   list($username, $domain) = split("@",$email);

   if(getmxrr($domain, $mxHost)) 
   {
      return TRUE;
   }
   else 
   {
      if(@fsockopen($domain, 25, $errno, $errstr, 30)) 
      {
         return TRUE; 
      }
      else 
      {
         return FALSE; 
      }
   }
}

function logMod($title,$version,$added_by='System'){

	global $pds_mods;
	
	mysql_query("INSERT INTO $pds_mods (d_added, title, ver, added_by) VALUES (NOW(),'$title','$version','$added_by');");

}


function zipsInRange($zip, $range){

	global $pds_locrelate; 
	global $config; 
	
	$r = mysql_query("SELECT * FROM $pds_locrelate WHERE zip='$zip';") or die(mysql_error()); 
	if(mysql_num_rows($r) > 0){ 
		$f = mysql_fetch_assoc($r); 
		$starting_lon = $f[lon]; 
		$starting_lat = $f[lat]; 
		if ($config['convert_kilometer']){ 
			$rangeToDegrees = .00898; 
		}else{ 
			$rangeToDegrees = .01445; 
		} 
		$degrees = $range * $rangeToDegrees; 

		$maxCoords['max_lat'] = $starting_lat + $degrees; 
		$maxCoords['max_lon'] = $starting_lon + $degrees; 
		$maxCoords['min_lat'] = $starting_lat - $degrees; 
		$maxCoords['min_lon'] = $starting_lon - $degrees; 

		$sql = "SELECT * FROM $pds_locrelate WHERE (lat <= '$maxCoords[max_lat]' AND lat >= '$maxCoords[min_lat]') AND (lon <= '$maxCoords[max_lon]' AND lon >= '$maxCoords[min_lon]');";
        //echo "$sql";
		$ra = mysql_query($sql) or die(mysql_error()); 
		$ra_rows = mysql_num_rows($ra); 
		if($ra_rows){ 
			$i = 0; 
			for($x=0;$x<$ra_rows;$x++){ 
				$fa = mysql_fetch_assoc($ra); 
				$earthsradius = 3963.19; 
				$pi = pi(); 
				$c = sin($starting_lat/(180/$pi)) * sin($fa[lat]/(180/$pi)) + 
					cos($starting_lat/(180/$pi)) * cos($fa[lat]/(180/$pi)) * 
					cos($fa[lon]/(180/$pi) - $starting_lon/(180/$pi)); 

				$distance = $earthsradius * acos($c); 
				$distance = round($distance,2);
                //echo "$distance < $range |";
				if ((is_nan($distance)) || ($distance < $range)) {
					$zip_range[$i]['zip'] = $fa['zip']; 
					$zip_range[$i]['loc_prim'] = $fa['loc_prim']; 
					$zip_range[$i]['loc_sec'] = $fa['loc_sec']; 
					$zip_range[$i]['distance'] = $distance; 
					$i ++; 
				} 
			} 
		}else{ 
			$zip_range[0]['zip'] = $zip; 
			$zip_range[0]['distance'] = 0; 
		} 
	}else{ 
		$zip_range[0]['zip'] = $zip; 
		$zip_range[0]['distance'] = 0; 
	} 
	return($zip_range); 
}

//Added by inforeshaODC
/*
function snippet($text,$length=220,$tail="...") {
  $text = strip_tags(trim($text));
 
  $txtl = strlen($text);
  if($txtl > $length) {
    for($i=1;$text[$length-$i]!=" ";$i++) {
      if($i == $length) {
        return substr($text,0,$length) . $tail;
      }
    }
    $text = substr($text,0,$length-$i+1) . $tail;

  }
  return $text;
  }
 */
    //..Vote for Listing
	function voteForListing($l_list_id,$title,$question1,$question2,$question3,$question4,$question5,$question6,$question7,$comments)
    {
        // add Listing_votes table
		$sql = "INSERT INTO pds_votes (list_id,vote, user_id, created_on,title,question1,question2,question3,question4,question5,question6,question7,comments)
		       VALUES ($l_list_id ,0,".$_SESSION['userid'].", NOW(),'$title',$question1,$question2,$question3,$question4,$question5,$question6,$question7,'$comments' )";
		       //echo "sql=$sql  ";
		mysql_query($sql);
    }

    //..check if you have already voted
    function isAlreadyVoted($l_list_id)
	{
        if(!$l_list_id)
            return 0;
            
        $sql = 'SELECT vote_id
		               FROM pds_votes
                       WHERE list_id ='.$l_list_id .' AND user_id='.$_SESSION['guid'];
 	    $result = mysql_query($sql);
		if (!$result) {
           return 0;
        }

        $result = mysql_result($result, 0);

		return $result;
	}
	//..Get me the avg rating..
    function getAvgVote($l_list_user_id)
	{
	//	$sql = 'SELECT round((AVG(question1)+AVG(question2)+AVG(question3)+AVG(question4)+AVG(question5)+AVG(question6)+AVG(question7))/7) AS vote FROM pds_votes WHERE list_id = ' . $l_list_id;

	$sql = 'SELECT round((AVG(question1)+AVG(question2)+AVG(question3)+AVG(question4)+AVG(question5)+AVG(question6))/6) AS vote FROM pds_votes WHERE list_id = ' . $l_list_id;
        $result = mysql_query($sql);
		if (!$result) {
           return 0;
        }

        $result = mysql_result($result, 0);

		return (int)$result;

        /*$count_recm = recommendations_count($l_list_user_id);
    	$ratingData=recommendations_questions_rating($l_list_user_id);
    	$rate_image=0;
        if($count_recm)
        {
           //..If recommendations are added then only go further
           if(count($ratingData)>0)
            {
                  //..Calculate overall rating
                  $rate = array_sum($ratingData)/count($ratingData);
                  $rate_image = round($rate*2);
            }
       }*/
       
       return (int)$rate_image;
	}
	
	/// ... stripslashes from array
	// changed name at 11 feb 2011 by shridhar
    //original_name function stripslashes_deep($data)
	
	function new_stripslashes_deep($data)
	{
		if (is_string($data) && get_magic_quotes_gpc())
			return stripslashes($data);
		if (is_array($data) && get_magic_quotes_gpc())
				{
		    		foreach ($data as $i => $val)
						{
					    $data[$i] = stripslashes($val);
						}
				}
		return $data;
	}
	
    function getCountry_name ($isocode)
	{
        $name="";
        $r = mysql_query ("SELECT printable_name FROM pds_country WHERE iso='".$isocode."'");
	//	echo "SELECT printable_name FROM pds_country WHERE iso='".$isocode."'";
        if($r){
            $f = mysql_fetch_row($r);
		    $name = $f[0];
        }

		return $name;
	}
	
	function getStateIDFromName($state_nm)
	{
		$r = mysql_query ("SELECT id FROM pds_states WHERE name LIKE '%".$state_nm."%'");
		$id = 0;
		if($r){
            $f = mysql_fetch_row($r);
			$id = $f[0];
  		}
		
		return $id;
	}
	
	function getState_name($state_id)
	{
        $name ="";
        $r = mysql_query ("SELECT name FROM pds_states WHERE id=".$state_id);
		if($r){
            $f = mysql_fetch_row($r);
		    $name = $f[0];
        }
		return $name;
	}
	
	function getState_ABVR($state_id)
	{
        $name ="";
        $r = mysql_query ("SELECT abbrev FROM pds_states WHERE id=".$state_id);
		if($r){
            $f = mysql_fetch_row($r);
		    $name = $f[0];
        }
		return $name;
	}
	
	function getMetroArea_name($metro_area_id)
	{
        $name ="";
        $r = mysql_query ("SELECT  metro_name FROM metro_area WHERE metro_id=".$metro_area_id);
        if($r){
            $f = mysql_fetch_row($r);
		    $name = $f[0];
        }
		return $name;
	}
	
	function getUsrStatebyMetroAreaByName($metro_area_name='Phoenix'){
        $usr_prof=array();
        $sql="SELECT s.id,a.metro_id,s.country_id
                        FROM pds_states s
                        INNER JOIN metro_area a ON s.abbrev = a.metro_abv
                        WHERE a.metro_name ='$metro_area_name'";
                        //echo "sql=$sql | ";
        $r = mysql_query($sql);
        if($r){
            $f = mysql_fetch_row($r);
            if($f){
                $usr_prof=array('stateid'=>$f[0],'metroareaid'=>$f[1],'countryid'=>$f[2]);
            }
        }
		return $usr_prof;
 	}
	
	function getStatebyMetroArea($metro_area_id){
        $stateid=0;
        $r = mysql_query ("Select id From pds_states where abbrev = (SELECT  abbrev FROM metro_area WHERE metro_id=".$metro_area_id.")");
        if($r){
            $f = mysql_fetch_row($r);
		    $stateid = $f[0];
        }
		return $stateid;
 	}
	
	
	function get_categ_name_by_id($id)
		{
		    global $db;
		    $sql = 'SELECT title FROM  pds_category WHERE id = "' . $id . '"';
		    $r = mysql_query ($sql);
		    $f = mysql_fetch_row($r);
		    $name = $f[0];
		    return $name;
		}
	
	
	 function get_category_listing_values($list_array, $list_spr =":")
	{
	     $list_array = explode ($list_spr, $list_array);
	     $list_category = '';

	     foreach ($list_array as $value)
		 	 {

	            $list_category .= get_categ_name_by_id($value).$list_spr;
			 }
			   $list_category = substr_replace(trim($list_category),"",-1);
	  return $list_category;

	}
	
 function get_country_list_values($list_array, $list_spr =":")
	{
	     $list_array = explode ($list_spr, $list_array);
	     $list_country = '';

	     foreach ($list_array as $value)
		 	 {

	            $list_category .= getCountry_name($value)."".$list_spr;
			 }
			   $list_country = substr_replace(trim($list_country),"",-1);
	  return $list_country;

	}
	
function get_states_list_values($list_array, $list_spr =":")
	{
	     $list_array = explode ($list_spr, $list_array);
	     $list_states = '';

	     foreach ($list_array as $value)
		 	 {

	            $list_states .= getState_name($value)."".$list_spr;
			 }
			   $list_states = substr_replace(trim($list_states),"",-1);
	  return $list_states;

	}


	
	
	function send_mail($reciver_name,$reciver_mail,$subject,$message,$mailer,$attached_file="")
    {
		global $CONFIG,$Global_member;
        //$sender = get_user($mailer);
        $from =$Global_member["user"] ;//$sender->email;
		$to = $reciver_mail;
		$subject = $subject;
        $message = "Hello! ".$reciver_name."\n\r ".$message."\n\r Thanx,\r".$Global_member["staff_lname"].",".$Global_member["staff_fname"].".";
        $headers =  "From: '".$Global_member["staff_lname"].",".$Global_member["staff_fname"] ."'<".$from."> \r\n" .
                    "Reply-To: $from" . "\r\n" .
                    "X-Mailer: PHP/" . phpversion();
                    
        //..Changes for the attachment
        //read file and get the contenets in data
        if ($attached_file!="") {
            $fileatt_type = "application/octet-stream"; // File Type
            $fileatt_name = basename($attached_file);

            $file = fopen($attached_file,'rb');
            $data = fread($file,filesize($attached_file));
            fclose($file);
            //now add the headers and contents to it
            $semi_rand = md5(time());
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

            $headers .= "\nMIME-Version: 1.0\n" .
            "Content-Type: multipart/mixed;\n" .
            " boundary=\"{$mime_boundary}\"";

            $message .= "\n\n" .
            "--{$mime_boundary}\n" .
            "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
            $message . "\n\n";

            $data = chunk_split(base64_encode($data));

            $message .= "--{$mime_boundary}\n" .
            "Content-Type: {$fileatt_type};\n" .
            " name=\"{$fileatt_name}\"\n" .
            //"Content-Disposition: attachment;\n" .
            //" filename=\"{$fileatt_name}\"\n" .
            "Content-Transfer-Encoding: base64\n\n" .
            $data . "\n\n" .
            "--{$mime_boundary}--\n";
        }
        //$add_prm = "-f{$CONFIG->siteemail}";
        if(mail($to, $subject, $message, $headers, $add_prm))
            return 1 ;
        else
            return 0;

    }

function send_mail_to_people($people_array,$mailer,$subject,$message)
    {
        foreach ($people_array as $pupil)
    		{
    			if((strlen(trim($pupil)))!=0)
                {
                    //..sangram we need member object here
					//..needs to be changed
					$newObj = new members();
        			$obj_lst= $newObj->GetInfo(0,$_SESSION['user']);
					//$receiver=get_user($pupil);
    				//send_mail($receiver->name,$receiver->email,$subject,$message,$mailer);
    			}
       		}
    }


    
function chkIfUsrIsClubMember(){
//global $CONFIG;
    if(isset($_SESSION['guid'])){
		$tmpAct=getMeAcntType($_SESSION['guid']);
	    //$user=get_user($_SESSION['userid']);
	    //echo "user->isOrganization=$user->isOrganization";
	    if ($tmpAct=="business" || $tmpAct=="social/business organization
	" ){
	        return 1;
	    }else{
	        return 0;
	    }
	}
	return 0;
}

function getCurUsrMetroArea(){
	global $Global_member;
	$usr_prof="";
    if((isset($_SESSION['guid'])) && ($Global_member["staff_city"])){
		//$user=get_user($_SESSION['guid']);
	    $usr_prof=getUsrStatebyMetroAreaByName($Global_member["staff_city"]);    
	} 
	
	if(empty($usr_prof)){
        $usr_prof=getUsrStatebyMetroAreaByName("Phoenix");
    } 
    return $usr_prof;
}

function getMeMyProfileListing(){
	if(isset($_SESSION['guid'])){
	    $myAcntType=chkIfUsrIsBiz();
	    //$myAcntType=getMeAcntType($_SESSION['userid']);
	    if ($myAcntType=="business"){
	        $query = "SELECT id FROM pds_list WHERE userid=".$_SESSION['guid']." order by id asc limit 0,1";
	        $result = mysql_query($query);
	        if($result){
	            $my_lst_id=mysql_result($result, 0);
	            return $my_lst_id;
	        }
	      }
	}  
    return 0;
}

function chkIfUsrIsBiz(){
    global $CONFIG;
   // print_r("helow");
   if(isset($_SESSION['guid'])){
	    $tmpAct=getMeAcntType($_SESSION['guid']);
	    //echo getMeAcntType($_SESSION['userid']);
	    //$user=get_user($_SESSION['userid']);
	    //echo "user->isOrganization=$user->isOrganization";
	    if ($tmpAct=="business" || $tmpAct=="social/business organization" ){
	    	 	return "business";
		}else{
			 	return "regular";
	 	}
	}
	return "regular";	
}

function chkuserlimit($acct_type=""){
    global $db;
	if(isset($_SESSION['guid'])){
		$sql = 'SELECT count(distinct id) FROM pds_list WHERE userid ='.$_SESSION['guid'] ;
	    $r = mysql_query($sql);
	    if($r){
	        $f = mysql_fetch_row($r);
		    $biz_count = $f[0];
		 	if ($acct_type=="business" || $acct_type=="social/business organization")
			{
		        if ($biz_count<1)
					return 1;
		    }
		}	
	}    
	return 0;
}

/*
function chkuserlimit($acct_type=""){
    global $db;
    $sql = 'SELECT count(distinct id) FROM  pds_list WHERE userid ='.$_SESSION['userid'] ;
	    $r = mysql_query ($sql);
	    $f = mysql_fetch_row($r);
	    $biz_count = $f[0];
 	if ($acct_type=="business" || $acct_type=="social/business organization")
	 { if ($biz_count < 1)
				return 1;
     }else{
		if ($biz_count < 2)
				return 1;
  	}
return 0;
}
*/

function remove_splchar_from_string($string){
	$string = str_replace("'","",$string);
	$string = str_replace("&","",$string);
	$string = str_replace("!","",$string);
	$string = str_replace("@","",$string);
	$string = str_replace("#","",$string);
	$string = str_replace("$","",$string);
	$string = str_replace("~","",$string);
	$string = str_replace("`","",$string);
	$string = str_replace("^","",$string);
	$string = str_replace("*","",$string);
	$string = str_replace(":","",$string);
	$string = str_replace('"',"",$string);
	$string = str_replace(";","",$string);
	$string = str_replace(">","",$string);
	$string = str_replace("<","",$string);
	$string = str_replace("/","",$string);

	return $string;
}

function get_intrested_people_for_listing($list_id){
  $sql = " SELECT Distinct  i.userid 'intrested_id' FROM
            pds_listcat c inner join pds_list l on l.id = c.list_id cross
            join pds_intrested_in i where
            (   case ifnull(i.categories,'')
                when '' then c.cat_id  in(select c.id from pds_category c)
                else c.cat_id in (i.categories) end
            ) and
            ( case ifnull(i.countries,'')
              when '' then l.country  in (select c.iso from pds_country c)
              else l.country  in (i.countries) end
            )
            and
            (case ifnull(i.states,'')
                when '' then l.states_id in (select  s.id from pds_states s)
                else l.states_id  in (i.states) end  )
            and
			(
				(
					(
						length( trim( ifnull( i.categories, '' ) ) ) <>0
					)
				OR  (
						length( trim( ifnull( i.countries, '' ) ) ) <>0
					)
				OR  (
						length( trim( ifnull( i.states, '' ) ) ) <>0
					)
				)
			)
            and i.ispromotions = 0 and l.id =".$list_id;
            
       $Intrested_peoples = array();
       $result =  mysql_query($sql) or die(mysql_error());
        if ((mysql_num_rows($result)) == 0){
                return null;
        }else{
            for($y=0;$y<mysql_num_rows($result);$y++){
            $Intrested_peoples[$y]= mysql_fetch_assoc($result);
            }
          return $Intrested_peoples;
        }


}

function get_intrested_people_for_promotion($promo_id){


  $sql = "  SELECT Distinct i.userid 'intrested_id', i.title
            FROM
            pds_listcat c inner join pds_list l on l.id = c.list_id
            inner join pds_category pc on pc.id = c.cat_id
            inner join pds_list_promotions p on p.list_id = l.id
            cross join pds_intrested_in i
            WHERE
            (
                case (ifnull(i.keywords,0) || length(trim(i.keywords)))
                when '' then 'x'='x'
                else
                    case (ifnull(i.isPromotions,1))
                    when '0' then
                        (
                            l.firm LIKE CONCAT('%',i.`keywords`,'%') OR
                            l.description LIKE CONCAT('%',i.`keywords`,'%') OR
                            pc.title LIKE CONCAT('%',i.`keywords`,'%')
                        )
                    else
                        (
                            p.title LIKE CONCAT('%',i.`keywords`,'%') OR
                            p.comments LIKE CONCAT('%',i.`keywords`,'%') OR
                            pc.title LIKE CONCAT('%',i.`keywords`,'%')
                        )
                    end
                end
            )
            and
            (
               case (ifnull(i.business_title,0) || length(trim(i.business_title)))
                when '' then 'x'='x'
                else
                      l.firm LIKE CONCAT('%',i.`business_title`,'%')
                end
            )
            and
            (
            case (ifnull(i.categories,0) || length(trim(i.categories)))
                when '' then 'x'='x'
                else c.cat_id in (i.categories) end
            )
            and
            (
                  case (ifnull(i.countries,0) || length(trim(i.countries)))
                  when 0 then  'x'='x'
                  else l.country IN (i.countries) end
            )
            and
            (
                  case ifnull(i.states,0)
                  when 0 then 'x'='x'
                  else p.states=(i.states) end
            )
            and
            (
                  case ifnull(i.metro_area,0)
                  when 0 then 'x'='x'
                  else p.metro_area=(i.metro_area) end
            )
			and
			(
				(
					(
						length( trim( ifnull( i.categories, '' ) ) ) <>0
					)
				OR  (
						length( trim( ifnull( i.countries, '' ) ) ) <>0
					)
				OR  (
						length( trim( ifnull( i.states, '' ) ) ) <>0
					)
                OR  (
						length( trim( ifnull( i.metro_area, '' ) ) ) <>0
					)
				)
			)
			AND i.isPromotions = 1
            AND p.id =".$promo_id;  //and i.ispromotions = 1
     /*echo $sql;*/


        $Intrested_peoples = array();
        $result =  mysql_query($sql) or die(mysql_error());
        if ((mysql_num_rows($result)) == 0){
                return null;
        }else{
            for($y=0;$y<mysql_num_rows($result);$y++){
            $Intrested_peoples[$y]= mysql_fetch_assoc($result);
            }
          return $Intrested_peoples;
        }

}

function get_child_categories($cat_id)
{ $cates = "";
  $sql = " SELECT id FROM pds_category where p = '$cat_id'";
  
  $result= mysql_query($sql);
  while ($row = mysql_fetch_assoc($result))
  {
	  $cates .= $row['id'].",";
	  $cates .=get_child_categories($row['id']);

  }
  return $cates;
}



function get_child_with_paraent($cat_id){
	if($cat_id > 0)
	return get_child_categories($cat_id)."".$cat_id ;
	else
	return $cat_id;
}

//..use for sublisting
function getMeListFromRecords($r_list, $ishistory = 0,$promotion_filter_critera_sql="",&$map_ids=array()){
     global $curr_user,$tpl,$config;
		 
     $promotion_result_count = 0;
     //$listing_result_count = mysql_num_rows($r_list);
	 $curr_user_friend_list = array();//getFreindsRecommendationForBusiness($curr_user);
	 //print_r($_SESSION );
	 if(is_gt_zero_num($_SESSION[SES_RESTAURANT])){
	 	$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
	 }
	 
  for ($x=0;$x<mysql_num_rows($r_list);$x++){
			$list[$x] = mysql_fetch_assoc($r_list);

            $map_ids[]=$list[$x]['id'];

            $check_file = "sublist".$list[$x][level].".tpl";
   /*
if (is_readable("templates/$config[deftpl]/sublist/$check_file")){
				$list[$x][subfile] = $check_file;
			}else{
				$list[$x][subfile] = "sublist0.tpl";
			}
*/
      $list[$x][subfile] = "sublist0.tpl";
			if($x%2){
				$list[$x][bgcolor] = $config['bg_dark'];
			}else{
				$list[$x][bgcolor] = $config['bg_light'];
			}
			
			
			if(is_not_empty($rest_info['restaurent_img_url'])){
				$list[$x]['restaurant_logo'] = $rest_info['restaurent_img_url'];
			} 
				$check_file = $list[$x]['id'].".".$list[$x]['logo_ext'];
			
				if ($list[$x]['logo_ext'] != "" AND is_readable("logo/$check_file")){
					$list[$x]['logo'] = $check_file; //"$config[mainurl]/logo/$check_file?".rand();
			  }
			 
			 
			 

		  $list[$x]['mod_firm'] = str_replace(" ","_",$list[$x]['firm']);
		  $list[$x]['mod_firm'] = str_replace("/","-",$list[$x]['mod_firm']);

      $list[$x]['tip_firm'] = addslashes(htmlentities($list[$x]['firm']));
      $list[$x]['tip_phone'] = addslashes(htmlentities($list[$x]['phone']));
      $list[$x]['tip_address'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list[$x]['address1'])));
      $list[$x]['strip_address'] = strip_tags($list[$x]['address1']);
      
      //..Sangram changed this for the web service jsonencode not working
      $list[$x]['description']= utf8_encode($list[$x]['description']);
      
      $list[$x]['tip_description'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list[$x]['description'])));
      $list[$x]['desc_elipsis'] = get_elipsis($list[$x]['description'],220,"...");
      $list[$x]['country'] = getCountry_name($list[$x]['country']);
		  $list[$x]['states'] = getState_name($list[$x]['states_id']);
		  $list[$x]['metro_area_name'] = getMetroArea_name($list[$x]['metro_area']);
		  //$list[$x]['avg_rating'] = (int) getAvgVote($list[$x]['id'])*2;
		  $list[$x]['avg_rating'] = (int) getAvgVote($list[$x]['userid']);

		  //..For access fields levels. show
		   $list[$x]['show_field_on_form']['fld_phone']=get_access_fld_allowed_bl($list[$x]['id'],"fld_phone");
      	   $list[$x]['show_field_on_form']['fld_fax']=get_access_fld_allowed_bl($list[$x]['id'],"fld_fax");
           $list[$x]['show_field_on_form']['fld_mobile']=get_access_fld_allowed_bl($list[$x]['id'],"fld_mobile"); 
		  /*$list[$x]['show_field_on_form']['fld_phone']=2;
          $list[$x]['show_field_on_form']['fld_fax']=2;
          $list[$x]['show_field_on_form']['fld_mobile']=2;*/
          $my_curr_lat=$_SESSION['client_lat'];
          $my_curr_long=$_SESSION['client_long'];
          $dist =0;

          if (isset($list[$x]['xtra_2']) && isset($list[$x]['xtra_3']) && ($list[$x]['xtra_2']!='') && ($list[$x]['xtra_3']!='')){
                //$dist=con_lat_long_to_dist($list[$x]['xtra_2'],$list[$x]['xtra_3'],$my_curr_lat,$my_curr_long);
          }
          //echo "<br>{$list[$x]['firm']}-{$list[$x]['xtra_2']},{$list[$x]['xtra_3']},$my_curr_lat,$my_curr_long- {$dist}";
          $list[$x]['dist'] = $dist;
          $list[$x]['map_link'] = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($list[$x]['address1'])."+".$list[$x]['loc1'])."+".$list[$x]['zip'];
          //..this field added for showing the business profile
          $list[$x]['buss_prof_link'] = "";
          if(is_gt_zero_num($list[$x]['userid'])){
              //$entity_user = get_entity($list[$x]['userid']);
              if($entity_user){
                  //$list[$x]['buss_prof_link']=  $entity_user->getURL();
              }
          }

          //..get busines working hours
          //$obj_conf_bus_hrs=new bus_working_hrs();
          //$list[$x]['biz_wrk_hrs']=$obj_conf_bus_hrs->getclsMebizHrs(array('bus_id'=> $list[$x][id]),$list[$x]['address1'],$list[$x]['metro_area'],$list[$x]['zip']);
          //$list['biz_wrk_hrs']=$obj_conf_bus_hrs->getclsMebizHrs(array('bus_id'=> $list[id]),$list['address1'],$list['loc1'],$list['xtra_4_name'],$list['zip']);
          //echo $list[$x]['biz_wrk_hrs'];
		  $list['biz_wrk_hrs']=array();

          switch($config['map_site']){
        	case 'google':
        		//$map_link = "http://www.google.com/maps?q=".str_replace(" ","+",$vs_current_listing['loc1'])."+".$vs_current_listing['zip'];
        		$list[$x]['map_link'] = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($list[$x]['address1'])."+".$list[$x]['loc1'])."+".$list[$x]['zip'];
        		break;
        	case 'mapquest':
        		$list[$x]['map_link'] = "http://www.mapquest.com/maps/map.adp?address=".str_replace(" ","+",$list[$x]['loc1'])."&zipcode=".$list[$x]['zip'];
        		break;
        	}
          //}
         $list[$x]['is_recommended'] = 0;
         $list[$x]['is_surveyed'] = 0;
        //echo "<br> ".$list[$x]['id'].", list=".listOf_Biz_survey_by_user($_SESSION['guid']);
                    
        //if(in_array($list[$x]['id'], explode(",",listOf_Biz_rcmd_by_user($_SESSION['guid']))))
         //   $list[$x]['is_recommended'] = 1;
            
        //if(in_array($list[$x]['id'], explode(",",listOf_Biz_survey_by_user($_SESSION['guid']))))
         //  $list[$x]['is_surveyed'] = 1;

    //** for Promotion start **//
	 //echo "XX=".$promotion_filter_critera_sql.'<br>'; 
	 
   if ($ishistory == -1){
   		$tmp_promo_id  = 0;
          if(is_gt_zero_num($list[$x]['tmp_promo_id'])){
              $tmp_promo_id = $list[$x]['tmp_promo_id'];
          }
 		 $promotion_history_condition = " AND pds_list_promotions.id ={$tmp_promo_id}  $promotion_filter_critera_sql"; 
   }elseif ($ishistory == 1){
   		$promotion_history_condition = " AND pds_list_promotions.end_date < CURDATE()  $promotion_filter_critera_sql";
   }else {
	 
  		 $tmp_promo_id  = 0;
          if(is_gt_zero_num($list[$x]['tmp_promo_id'])){
              $tmp_promo_id = $list[$x]['tmp_promo_id'];
          }
          $promotion_history_condition = " AND pds_list_promotions.id ={$tmp_promo_id} AND pds_list_promotions.end_date >= CURDATE()";
    }
	// echo "i am in now - {$ishistory}";
	$promo_qry = "SELECT count(id) FROM pds_list_promotions WHERE list_id =".$list[$x]['id']. " $promotion_history_condition";
	// echo $promo_qry;exit;

  $sql =  mysql_fetch_row(mysql_query($promo_qry));
	$promotion_count = $sql[0];
	$list[$x]['promotion_count'] = $promotion_count;
	if ($promotion_count > 0)
	    {
            $list[$x]['promotion'] = 1 ;
            //$sql_qry = "SELECT * FROM pds_list_promotions WHERE list_id=".$list[$x]['id'];
            //..changes made by sangram for guest user
            if ((is_gt_zero_num($curr_user))|| is_not_empty($_SESSION[SES_CUST_NM])){
							$fav_cond="CASE ispromotion
												WHEN 1 then
													(	SELECT
															count(id)
														FROM
															`pds_list_favorites` f2
														WHERE
															(f2.user_id = ".$curr_user." or f2.customer_name = '".$_SESSION[SES_CUST_NM]."')
							       						AND
															f2.list_id = pds_list_promotions.id
													)
												else 0
											END as is_promo_fav";
						}else{
							$fav_cond="0 as is_promo_fav";
						}
                

            $sql_qry = "
			SELECT DISTINCT
				pds_list_promotions.id, pds_list_promotions.list_id,pds_list_promotions.title,
                pdf,comments,pds_list_promotions.end_date,
                pds_list_promotions.start_date,
				pds_list_promotions.metro_area,
                pds_list_promotions.states, pds_list_promotions.img_ext,
                pds_list_promotions.cupon_type,
				pds_list_promotions.views_count,pds_list_promotions.allowed_cupons,
				pds_list_promotions.redimed_cupons,pds_list_promotions.is_event,
				pds_list_promotions.prm_allow_multi_redeem,
                CASE pds_list_promotions.end_date < CURDATE()
                WHEN 1 THEN 1 ELSE 0 END
                as isExpired,$fav_cond
			FROM
				`pds_list_promotions`
			LEFT OUTER JOIN
				`pds_list_favorites`
			ON
				pds_list_promotions.id = pds_list_favorites.list_id
   			INNER join pds_listcat ON pds_listcat.list_id = pds_list_promotions.list_id
            INNER join pds_category ON pds_category.id = pds_listcat.cat_id
			WHERE (
				pds_list_promotions.list_id=".$list[$x]['id'] ."".$promotion_history_condition.")  order by pds_list_promotions.id desc;";
               // echo $sql_qry."<br>";
              //exit;
			$result =  mysql_query($sql_qry) or die(mysql_error());
			if ($result){
                for($y=0;$y<mysql_num_rows($result);$y++){
    	             $list[$x]['user_promotion'][$y]=mysql_fetch_assoc($result);
    	             $list[$x]['user_promotion'][$y]['simple_title'] = string_replace_for_sql($list[$x]['user_promotion'][$y]['title']);
                    $list[$x]['user_promotion'][$y]['states_name'] = getState_name($list[$x]['user_promotion'][$y]['states']);
                    $list[$x]['user_promotion'][$y]['metro_area_name'] = getMetroArea_name($list[$x]['user_promotion'][$y]['metro_area']);
                    $list[$x]['user_promotion'][$y]['stripped_comments'] = strip_tags($list[$x]['user_promotion'][$y]['comments']);
					//.. Recommendation Part
                    /*
					$list[$x]['user_promotion'][$y]['recommendation'] = getAllRecommendationForBusiness($list[$x]['user_promotion'][$y]['id'],$curr_user, $curr_user_friend_list, 1);*/
                   	$prom_recommendation = array();
					//$biz_rec = new biz_recommendation();
    				//$prom_recommendation=$biz_rec->GetAllRecmdForPost($curr_user,$list[$x]['user_promotion'][$y]['id'],"PROMOTIONS");
    				$prom_recommendation=array();
    				$list[$x]['user_promotion'][$y]['recommendation'] = $prom_recommendation;
                    $list[$x]['user_promotion'][$y]['is_recommended'] = 0;
                    $list[$x]['user_promotion'][$y]['is_surveyed'] = 0;
                    /*if(in_array($list[$x]['id'], explode(",",listOf_Biz_rcmd_by_user($_SESSION['guid'])))){
                       $list[$x]['user_promotion'][$y]['is_recommended'] = 1;
                    }
                    if(in_array($list[$x]['id'], explode(",",listOf_Biz_survey_by_user($_SESSION['guid'])))){
                      $list[$x]['user_promotion'][$y]['is_surveyed'] = 1;
                     }*/

    				//$list[$x]['user_promotion'][$y]['recommendation_display'] = $biz_rec->display($curr_user,$list[$x]['user_promotion'][$y]['id'],"PROMOTIONS",$list[$x]['user_promotion'][$y]['title'],$list[$x]['id'],1);
					$list[$x]['user_promotion'][$y]['recommendation_display'] ="";
					/*print_r($list[$x]['user_promotion'][$y]['recommendation'] );*/
                    if($list[$x]['user_promotion'][$y]['cupon_type'] != "none"){
                      include_once("pds_redim_cupons.class.php");
                      $cupon = new pds_redim_cupons();
                      $list[$x]['user_promotion'][$y]['coupon'] = $cupon->GetInfoByuser_promotion($_SESSION['guid'],$list[$x]['user_promotion'][$y]['id']);
                    }		
					//...code to add the avgs for the stats..
					$list[$x]['user_promotion'][$y]['avgs'] = getStatsAvgs($list[$x]['user_promotion'][$y]['id']);
					//echo "prom_id=]".$list[$x]['user_promotion'][$y]['id'];
                    $promotion_result_count++;
                    unset($biz_rec);
    	        }

                $row = mysql_fetch_assoc($result);
                $pdf_name  = $row['title'];
                $pdf_size = round((filesize($config[root]."pdf/".$row['pdf'])/1024),2);
                $list[$x]['promotion_title'] =$row['title'];
    		    $list[$x]['promotion_pdf'] =$row['pdf'];
                $list[$x]['promotion_pdf_name'] = $pdf_name;
                $list[$x]['promotion_pdf_size'] = $pdf_size;
            }
		}
	else
	    {
            $list[$x]['promotion'] = 0 ;
		}
    //** for Promotion End **//
    //*** For Favorite Listing start **//
    $strsql="SELECT count( id ) FROM pds_list_favorites WHERE list_id =".$list[$x]['id']." and user_id=".$_SESSION['userid'] ." and ispromotion = 0";
    $rslt = mysql_query($strsql);
    if($rslt){
        $sql = mysql_fetch_row($rslt);
	    $favorites_count = $sql[0];
    }else{
        $favorites_count = 0;
    }

    $list[$x]['favorites'] = $favorites_count ;
    $list[$x]['promotion_count'] = $promotion_count;
    
	/**For Recommendation
		//called getAllRecommendationForBusiness() from engine/lib/pds_list_recommendation
		$list[$x]['recommendation'] = getAllRecommendationForBusiness($list[$x]['id'],$curr_user, $curr_user_friend_list);
		
	*/
	
		$list_recommendation = array();
		//$biz_rec = new biz_recommendation();
    	//$list_recommendation=$biz_rec->GetAllRecmdForPost($curr_user,$list[$x]['id'],"BUSINESS");
		$list_recommendation=array();
    	$list[$x]['recommendation'] = $list_recommendation;
    	$list[$x]['recommendation_display'] ="";
    	//$list[$x]['recommendation_display'] = $biz_rec->display($curr_user,$list[$x]['id'],"BUSINESS",$list[$x]['firm'],$list[$x]['id'],1);	
} 
if($tpl)
	$tpl-> assign('promotion_result_count',$promotion_result_count);


return $list;
}

//...function to get the average stats
function getStatsAvgs($prom_id){
	$out_put=array();
	if(is_gt_zero_num($prom_id)){
		/*$strsql="
		SELECT 
		 	AVG(tbl_table_customer_session.tbl_cust_sess_party_size) as party_size,	
			(	
				AVG(
				IFNULL(
					 od.`ord_dtl_quantity` * IF(od.`ord_dtl_discount` > 0, (od.`ord_dtl_price`-(od.`ord_dtl_price` * (od.`ord_dtl_discount`/100))),od.`ord_dtl_price`)
				,0) 
				+ 
				IFNULL(
				op.`ord_det_opt_qty` * IF(op.`ord_det_opt_discount` > 0, (op.`ord_det_opt_price`-(op.`ord_det_opt_price` * (op.`ord_det_opt_discount`/100))),op.`ord_det_opt_price`)
				,0)
				)			
			) `bill_amount`,
			(SUM(`order_discount_amt`)+SUM(`ordprom_discount_amt`)
			) `total_discount`
		FROM 
			`pds_redim_cupons`
		INNER JOIN  
			`tbl_table_customer_session` 
		ON 
			`tbl_table_customer_session`.`tbl_cust_sess_id` = `pds_redim_cupons`.`cust_sess_id`	
		LEFT OUTER JOIN  
			`pds_list_promotions` 
		ON 
			`pds_list_promotions`.`id` = `pds_redim_cupons`.`promotion_id`
		LEFT OUTER JOIN  
			`tbl_orders`  
		ON 	
		 	`pds_redim_cupons`.order_id = `tbl_orders`.`order_id` 
		LEFT OUTER JOIN 
			`tbl_order_details` od
		ON 
			`tbl_orders`.`order_id` = od.`ord_dtl_order_id`		
		LEFT OUTER JOIN 
			`tbl_order_details_options` op 
		ON 
			od.`ord_dtl_id` =  op.`ord_det_opt_order_detail`
		WHERE `pds_redim_cupons`.`promotion_id`=$prom_id AND `tbl_orders`.`order_restaurant`=".$_SESSION[SES_RESTAURANT]."
		GROUP BY `pds_redim_cupons`.`promotion_id` 
		".RET;*/
		
		$strsql="
		SELECT 
		 	AVG(tbl_table_customer_session.tbl_cust_sess_party_size) as party_size,	 
			(	
				AVG(
				IFNULL(
					 od.`ord_dtl_quantity` * IF(od.`ord_dtl_discount` > 0, (od.`ord_dtl_price`- od.`ord_dtl_discount`),od.`ord_dtl_price`)
				,0) 
				+ 
				IFNULL(
				op.`ord_det_opt_qty` * IF(op.`ord_det_opt_discount` > 0, (op.`ord_det_opt_price`- op.`ord_det_opt_discount`),op.`ord_det_opt_price`)
				,0)
				)			
			) `bill_amount`,
			 SUM(`order_prom_discnt`) `total_discount`			 
		FROM 
			`pds_redim_cupons`
		INNER JOIN  
			`tbl_table_customer_session` 
		ON 
			`tbl_table_customer_session`.`tbl_cust_sess_id`=`pds_redim_cupons`.`cust_sess_id`	
		LEFT OUTER JOIN  
			`pds_list_promotions` 
		ON 
			`pds_list_promotions`.`id` = `pds_redim_cupons`.`promotion_id`
		LEFT OUTER JOIN  
			`tbl_orders`  
		ON 	
		 	`pds_redim_cupons`.order_id = `tbl_orders`.`order_id` 
		LEFT OUTER JOIN 
			`tbl_order_details` od
		ON 
			`tbl_orders`.`order_id` = od.`ord_dtl_order_id`		
		LEFT OUTER JOIN 
			`tbl_order_details_options` op 
		ON 
			od.`ord_dtl_id` = op.`ord_det_opt_order_detail`
		WHERE `pds_redim_cupons`.`promotion_id`=$prom_id AND `tbl_orders`.`order_restaurant`=".$_SESSION[SES_RESTAURANT]."
		GROUP BY `pds_redim_cupons`.`promotion_id` 
		".RET;		
		
		//echo "$strsql";
		
		$rslt = mysql_query($strsql);
	    if($rslt){
		    $out_put = mysql_fetch_assoc($rslt);		
				 /*
				 if(is_gt_zero_num($out_put['order_id'])){
					$info = tbl_orders::getOrdGrAmtBySession(0,$out_put['order_id'],$_SESSION[SES_RESTAURANT]);
						if(is_not_empty($info)){
						 	$info['total'] = $total;
							$info['tax_amt'] = $tax_amt; 
							$info['tip_amt'] = $tip_amt;
							$info['misc_charge'] = $misc_charge;
							$info['prom_discnt_amt'] = $prom_discnt_amt;		
							//$info['gr_amt'] = $total + $tax_amt + $tip_amt-$prom_discnt_amt;	
							$info['gr_amt'] = $gr_total;
							$out_put[''] = '';
						}
					} 
				*/
	    }
	}	
	//print_r($out_put);
	//exit;
	return $out_put;		
}


 /*
 //..this is previous logic
            $friends = get_user_friends($_SESSION['guid'], null, 1000, 0);
    	    foreach($friends as $friend)
         	{
                $fr_lst[]=$friend->guid;
        	}
 	      */
 function GetMyConnectionList(){
        global $CONFIG;
        //..Get friends list first
		$fr_lst=array();
		if (is_not_empty($_SESSION['guid'])){
			if ($collections = get_user_access_collections($_SESSION['guid'])) {
				foreach($collections as $key => $collection) {
                   $tmp=get_members_of_access_collection($collection->id, true,true);
                   if (!empty($tmp))
     				  $fr_lst=array_merge($fr_lst,$tmp);
				}
			}
			if (!(empty($fr_lst))){
                $fr_lst=array_unique($fr_lst);
            }
       }
    	return $fr_lst;
 }
 
 function GetMyGroupMemList($groupid){
        //..Get groups he is memebr of
		$fr_lst=array();
		if($groupid>0){
            $each_gr_lst=get_group_members($groupid, 9999, 0);
                if(!(empty($each_gr_lst))){
                   foreach($each_gr_lst as $each_gr_item){
                      $fr_lst[]=$each_gr_item->guid;
                   }
                }
        }else{
            $each_gr_lst=array();
    		$groups = get_entities_from_relationship('member',$_SESSION['guid'],false,'group','',0, "", 9999, 0, false);

    	    foreach($groups as $group){
                //..get memebrs of that group
                $each_gr_lst=get_group_members($group->guid, 9999, 0);
                if(!(empty($each_gr_lst))){
                   foreach($each_gr_lst as $each_gr_item){
                       // if($_SESSION['guid']!=$each_gr_item->guid)
                            $fr_lst[]=$each_gr_item->guid;
                   }
                }
        	}
        }
    	//..take only unique items
    	if(!(empty($each_gr_lst))){
            $fr_lst=array_unique($fr_lst);
        }
    	return $fr_lst;
 }

 function GetMetroAreaByState($state_id){
	$query = "select * from metro_area where metro_abv = (select abbrev from pds_states where id = $state_id)";

    $metro_area = array();
    $results = mysql_query($query);
    if($results){
        for ($x=0;$x<mysql_num_rows($results);$x++){
			$metro_area[$x] = mysql_fetch_assoc($results);
		}
	}
    
 return $metro_area;
}

function GetStatesByCountry($country_id){
	$query = "select id,name from pds_states WHERE country_id ='$country_id' order by name;";
    $results = mysql_query($query);
    $states = array();
    if($results){
        for ($x=0;$x<mysql_num_rows($results);$x++){
			$states[$x] = mysql_fetch_assoc($results);
		}
	}
    return $states;
}

function strip_bad_tags($html)
{
   $s = preg_replace ("@</?[^>]*>*@", "", $html);
   return $s;
}


function validate_category_listing($category_listing){

     $sql ="SELECT SUM(CASE p WHEN 0 THEN 1 ELSE 0 END ) As count FROM `pds_category` WHERE id IN ($category_listing)";

     $result = mysql_query($sql);
     if($result){
        $row = mysql_fetch_assoc($result);
			if($row['count']==0){
				$message = "Please Select At least One Main Category.";
			}elseif ($row['count']==1){
		        $sql ="SELECT count(id) as subcount FROM `pds_category` WHERE id IN ($category_listing) AND parent>0 And id <> (SELECT Id FROM `pds_category` WHERE id IN ($category_listing) And p = 0)";
		        $result1 =  mysql_query($sql);
				$row1 = mysql_fetch_assoc($result1);

		        $sql ="SELECT count(id) as subcount FROM `pds_category` WHERE id IN ($category_listing) And p = (SELECT Id FROM `pds_category` WHERE id IN ($category_listing) And p = 0)";

		        $result2 = mysql_query($sql);
				if($result2){
                    $row2 = mysql_fetch_assoc($result2);
					if ($row2['subcount']==0){
			            $message = "Please Select At least One sub-category.";
			  		}
				}
			}else{
		        $message = "You can select Only One Main Category.";
			}
	}else{
        $message = "Problem During Fetching Records.";
  	}
	
	return $message;
}

function get_promotion_info($promotion_id){
	global $curr_user;
		//..get restaurant info

   $user_promotions = array();

   //..changes made by sangram for guest user
    if ((isset($curr_user)) && ($curr_user>0))
        $fav_cond="CASE ispromotion
			WHEN 1 then
				(	SELECT
						count(id)
					FROM
						`pds_list_favorites` f2
					WHERE
						f2.user_id = ".$curr_user."
					AND
						f2.list_id = p.id
				)
			else 0
		END as is_promo_fav";
    else
        $fav_cond="0 as is_promo_fav";


   $sql ="SELECT DISTINCT
            p.id, p.list_id, p.title, p.pdf, p.comments,p.terms_desc,p.states,p.prm_restaurent,
			p.metro_area,p.start_date, p.end_date,p.img_ext,
            p.promotion_id,p.is_pdf_uploaded,p.cupon_type,
            p.allowed_cupons,p.redimed_cupons,p.prom_code,p.is_exclusive,p.priority,p.disc_aply_type,p.disc_amt_type,p.disc_amt,prom_template_id,p.prm_restaurent,p.is_event,
						p.prm_allow_multi_redeem,p.prm_refer_frd_points,
            CASE p.end_date < CURDATE()
            WHEN 1 THEN 1 ELSE 0 END
            as isExpired,$fav_cond
			FROM
				`pds_list_promotions` p
			LEFT OUTER JOIN
				`pds_list_favorites` f
			ON
				p.id = f.list_id
			WHERE
				p.id = $promotion_id";
  //echo $sql."<br/>";
  //exit;
         $result = mysql_query($sql);
   		if($result){
            while($row = mysql_fetch_assoc($result)){
                $user_promotions = $row;
						  $rest_info = tbl_restaurent::GetInfo($row['prm_restaurent']);
					if(is_not_empty($rest_info['restaurent_img_url'])){
						$user_promotions['restaurant_logo'] = $rest_info['restaurent_img_url'];
					} 		
           //$user_promotions=mysql_fetch_assoc($result);
            $this_pdf = $user_promotions['pdf'];
            $pdf_tmp_name = explode('_',  $this_pdf, -1);
            $pdf_name ="";
              foreach($pdf_tmp_name as $value){
            	$pdf_name .= $value."_";
              }

            $user_promotions['pdf_name'] = substr_replace($pdf_name,"",-1);
            $pdf_full_path = dirname(dirname(__FILE__))."/pdf/".$user_promotions['pdf'];
          	$tmp_fl_size=@filesize($pdf_full_path);		
			if(is_gt_zero_num($tmp_fl_size))
				$user_promotions['pdf_size']= round((filesize($pdf_full_path)/1024),2);
			$user_promotions['title'] = string_replace_for_sql($user_promotions['title']);
			$user_promotions['area_list']= GetMetroAreaByState($user_promotions['states']);
			$user_promotions['states_name'] = getState_name($user_promotions['states']);
			$user_promotions['metro_area_name'] = getMetroArea_name($user_promotions['metro_area']);
			$user_promotions['stripped_comments'] = strip_tags($user_promotions['comments']);
			
			if(date('Y-m-d',strtotime($user_promotions['start_date']))> date('Y-m-d')){
					$user_promotions['_prom_type'] = 'forthcoming';
			}else{
					$user_promotions['_prom_type'] = 'current';
			}
			//..Capture google link
			if(is_not_empty($_SESSION['curr_restant'])){
					$user_promotions['google_cal'] = "https://www.google.com/calendar/render?action=TEMPLATE&trp=true&dates=".date('Ymd\THis\Z', strtotime($user_promotions['start_date']))."/".date('Ymd\THis\Z', strtotime($user_promotions['end_date']))."&location=".urlencode($_SESSION['curr_restant']['restaurent_address'])."&text=".urlencode($user_promotions['title'])."&details=".urlencode($user_promotions['comments'])."&sprop=website:".urlencode(WWWROOT."modules/business_listing/show.php?show_type=PR&lid=".$user_promotions['list_id']."&promoid=".$user_promotions['id']);
					$user_promotions['yahoo_cal'] = "http://calendar.yahoo.com/?v=60&VIEW=d&ST=".date('Ymd\THis\Z', strtotime($user_promotions['start_date']))."&DUR=&in_loc=".urlencode($_SESSION['curr_restant']['restaurent_address'])."&TITLE=".urlencode($user_promotions['title'])."&DESC=".urlencode($user_promotions['comments'])."&URL=".urlencode(WWWROOT."modules/business_listing/show.php?show_type=PR&lid=".$user_promotions['list_id']."&promoid=".$user_promotions['id']);
					$user_promotions['window_live_cal'] = "http://calendar.live.com/calendar/calendar.aspx?rru=addevent&dtstart=".date('Ymd\THis\Z', strtotime($user_promotions['start_date']))."&dtend=".date('Ymd\THis\Z', strtotime($user_promotions['end_date']))."&location=".urlencode($_SESSION['curr_restant']['restaurent_address'])."&summary=".urlencode($user_promotions['title']." \r\n ".$user_promotions['comments']);
						
			}		
			
			
             	
          }
	 	}

   	return $user_promotions;
}


function get_listing_info($listing_id){
    global $tpl,$config;
	$list = array();
    $sql ="SELECT * FROM pds_list where id = $listing_id";
    $result = mysql_query($sql);
	if($result){
        $list = mysql_fetch_assoc($result);
			$check_file = "sublist".$list[level].".tpl";
			if (is_readable("templates/$config[deftpl]/sublist/$check_file")){
				$list[subfile] = $check_file;
			}else{
				$list[subfile] = "sublist0.tpl";
			}
			if($x%2){
				$list[bgcolor] = $config['bg_dark'];
			}else{
				$list[bgcolor] = $config['bg_light'];
			}

			$check_file = $list['id'].".".$list['logo_ext'];
			if ($list['logo_ext'] != "" AND is_readable("logo/$check_file")){
				$list['logo'] = $check_file; //"$config[mainurl]/logo/$check_file?".rand();
		  }

		  $list['mod_firm'] = str_replace(" ","_",$list['firm']);
		  $list['mod_firm'] = str_replace("/","-",$list['mod_firm']);

          $list['tip_firm'] = addslashes(htmlentities($list['firm']));
          $list['tip_phone'] = addslashes(htmlentities($list['phone']));
          $list['tip_address'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list['address1'])));
          $list['strip_address'] = strip_tags($list['address1']);
          $list['tip_description'] = addslashes(htmlentities(str_replace("\r\n","<br>",$list['description'])));
          $list['desc_elipsis'] = snippet($list['description']);
          $list['country'] = getCountry_name($list['country']);
		  $list['states'] = getState_name($list['states_id']);
		  $list['xtra_4_name'] = getState_ABVR($list['xtra_4']);
		  $list['metro_area_name'] = getMetroArea_name($list['metro_area']);
		  $list['avg_rating'] = (int) getAvgVote($list['id'])*2;
          //..get busines working hours
          $obj_conf_bus_hrs=new bus_working_hrs();
          $list['biz_wrk_hrs']=$obj_conf_bus_hrs->getclsMebizHrs(array('bus_id'=> $list[id]),$list['address1'],$list['loc1'],$list['xtra_4_name'],$list['zip']);
          //if($list['loc1'] != "" AND $vs_level[$list['level']]['loc1']){
        	switch($config['map_site']){
        	case 'google':
        		//$map_link = "http://www.google.com/maps?q=".str_replace(" ","+",$vs_current_listing['loc1'])."+".$vs_current_listing['zip'];
        		$list['map_link'] = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($list['address1'])."+".$list['loc1'])."+".$list['zip'];
        		break;
        	case 'mapquest':
        		$list['map_link'] = "http://www.mapquest.com/maps/map.adp?address=".str_replace(" ","+",$list['loc1'])."&zipcode=".$list['zip'];
        		break;
        	}
          //}
		  /*$list[$x]['show_field_on_form']['fld_phone']=2;
          $list[$x]['show_field_on_form']['fld_fax']=2;
          $list[$x]['show_field_on_form']['fld_mobile']=2;*/
		  
		  //..For access fields levels. show
		   $list['show_field_on_form']['fld_phone']=get_access_fld_allowed_bl($list['id'],"fld_phone");
          $list['show_field_on_form']['fld_fax']=get_access_fld_allowed_bl($list['id'],"fld_fax");
          $list['show_field_on_form']['fld_mobile']=get_access_fld_allowed_bl($list['id'],"fld_mobile"); 
 	}
	return $list;
}

function string_replace_for_sql($string_to_replace){
    $str_rpl = $string_to_replace;
    $str_rpl = str_replace ("'","", $str_rpl);
    $str_rpl = str_replace ("`","", $str_rpl);
    $str_rpl = str_replace ('"','', $str_rpl);
  return $str_rpl;
}


function check_list_have_category($list_id){
  $strsql=" SELECT
  				case count(list_id) when 0 then 0 else 1 end as check_category
  		    FROM
			 	pds_listcat
	 		WHERE
			 	 list_id =".$list_id;
			 	 //echo " strsql=$strsql";

    $sql =  mysql_fetch_row(mysql_query($strsql));
	return $sql[0];
}


function chage_pdf_file($promotion_id, $promotion_pdf_path, $pdf) {
    $strsql=" SELECT pdf FROM `pds_list_promotions` WHERE id=$promotion_id";
    $sql =  mysql_fetch_row(mysql_query($strsql));
	$pdf_file = $sql[0];
	$filename = "$promotion_pdf_path/pdf/$pdf_file";

	
 	if((strlen(trim($pdf_file)))!=0)
	{$filename = "$promotion_pdf_path/pdf/$pdf_file";
        if (file_exists($filename)) {
			@unlink($filename);
		}
	}
	
	@update_promotion_by_field($promotion_id, "pdf",$pdf, 1);
}

function update_promotion_by_field($id, $field_name, $field_value, $field_is_string = 0 ){

	if($field_is_string == 1){
        $field_value = "'".mysql_real_escape_string ($field_value)."'";
    }else{
        $field_value = "".mysql_real_escape_string ($field_value)."";
	}
	


	$strsql = "UPDATE pds_list_promotions
			   SET $field_name = $field_value
			   WHERE id = $id";

	@mysql_query($strsql);

}


function get_intrested_in_sql_array($user_id,$xlimit,$ylimit,$ispromotion=1,$filter_id=0){

	if (is_gt_zero_num($filter_id)){
        $sql ="select * from pds_intrested_in where id={$filter_id}";
	}else{
        $sql ="select * from pds_intrested_in where userid={$user_id} AND isPromotions={$ispromotion}";
 	}
	
    $rslt=mysql_query($sql);
    if($rslt){ 
       while($row = mysql_fetch_assoc($rslt)){
	   if($row){
            $prev_country = explode(",",$row['countries']);
            $prev_categories =  $row['categories'];
            $prev_states =  $row['states'];
            $prev_metro_area = $row['metro_area'];
            $prev_keywords = $row['keywords'];
            $prev_business_title = $row['business_title'];
            $prev_title = $row['title'];
            $prev_created_date = $row['created_date'];
			$filter_id = $row['id'];
        }
		break;
	   } 
    }

	//$ispromotion = 1;
    //print_r($row); 

$show_filter = '';
$country = '';
$states = '';
$categories = '';
$metro_area = '';

//print_r($_REQUEST);
$smarty_url_string="";

if (isset($prev_country)){
    if(is_array($prev_country)){
        $country = implode(',', $prev_country);
    }else{
        $country = $prev_country;
    }
    $smarty_url_string .= "&country=$country";
}

if ((isset($prev_states))&&($prev_states>0)){
   $states = $prev_states;
   $smarty_url_string .= "&states=$states";
}

if ((isset($prev_metro_area))&&($prev_metro_area>0)){
    $metro_area = $prev_metro_area;
    $smarty_url_string .= "&metro_area=$metro_area";
}

//..InforeshaODC change for the connection promotions
$currPromSql="";
if($ispromotion == 1)
    $currPromSql=" AND pds_list_promotions.end_date>=CURDATE()";

$contrysql = "";
$statesql = "";
$categorysql = "";
$metro_areasql = "";


 if(is_not_empty($prev_title)){
        $show_filter .=" <b><span title='Filter Title'>$prev_title</span></b> ";
       /*$show_filter .=" <b><span title='Filter Title'>$prev_title</span> <i title='Filter Created Date'>($prev_created_date)</i> </b> ";*/
    }

if ($country)
{
    $show_country = "";
    $country = explode(",", $country);
    $country_condition = '';
	foreach ($country as $country_item)
	{
	    $country_condition .= " Find_in_set('$country_item', pds_list.country) OR" ;
	    $show_country  =  getCountry_name($country_item).",";
	}

	if (strlen(trim($country_condition)) != 0)
	{
        $country_condition = substr( $country_condition,0,-2);
	    $contrysql =  " And ($country_condition ) ";
	}

	 if(biz_elgg_is_non_empty($show_country)){
       $show_filter .="| Country like ".substr( $show_country,0,-1);
    }
     //$conditions .= $search_condition. " Find_in_set('$categories', a.category_listing)" ;
}
if ($states)
{
    $show_state = "";
    $states = explode(",", $states);
    $states_condition = '';
	foreach ($states as $states_item)
	{
		if($ispromotion == 1){
            $states_condition .=   " Find_in_set('$states_item', pds_list_promotions.states) OR" ;
		}else{
        $states_condition .=   " Find_in_set('$states_item', pds_list.states_id) OR" ;
  		}
  		$show_state .= getState_name($states_item)." ,";
	}

    if(biz_elgg_is_non_empty($show_state)){
       $show_filter .="| States like ".substr( $show_state,0,-1);
    }

	if (strlen(trim($states_condition)) != 0)
	{
        $states_condition = substr( $states_condition,0,-2);
	    $statesql  =  " And ($states_condition ) ";
	}
}

if ($metro_area)
{
    $show_metroarea = "";
    $metro_area = explode(",", $metro_area);
    $metro_area_condition = '';
	foreach ($metro_area as $metro_area_item)
	{
		if($ispromotion == 1){
		  $metro_area_condition .=   " Find_in_set('$metro_area_item', pds_list_promotions.metro_area) OR" ;
  		}else{
		  $metro_area_condition .=   " Find_in_set('$metro_area_item', pds_list.metro_area) OR" ;
		}
     $show_metroarea .= getMetroArea_name($metro_area_item)." ,";
	}

    if(biz_elgg_is_non_empty($show_metroarea)){
       $show_filter .="| Metro Area like ".substr( $show_metroarea,0,-1);
    }

	if (strlen(trim($metro_area_condition)) != 0)
	{
        $metro_area_condition = substr( $metro_area_condition,0,-2);
	    $metro_areasql  =  " And ($metro_area_condition ) ";
	}
}


if ((isset($prev_categories)) && (strlen($prev_categories)>0))
{
     $show_category = "";
    
	if(is_array($prev_categories)){
        $smarty_url_string .= "&categories=".implode(',',$prev_categories);
 	}else{
        $smarty_url_string .= "&categories=$categories";
        
        if (strpos($prev_categories, ",")){
           $categories = explode(",", $prev_categories);
        }else{
          $categories = explode(":", $prev_categories);
        }
        

  	}
	
    $category_condition = '';
	foreach ($categories as $catgory_item)
	{
	     $category_condition .=   " Find_in_set('$catgory_item', pds_category.id) OR Find_in_set('$catgory_item', pds_category.p) OR" ;
        $show_category .= get_categ_name_by_id($catgory_item).", ";
	}
//	echo " show_category = $show_category";

	 if(biz_elgg_is_non_empty($show_category)){
       $show_filter .="| Category like ".substr($show_category,0,-2);
    }

	if (strlen(trim($category_condition)) != 0)
	{
        $category_condition = substr( $category_condition,0,-2);
	    $categorysql .=  " And ($category_condition ) ";
	}
}

if ((isset($prev_keywords)) && (strlen($prev_keywords)>0))
{
      $keywords= $prev_keywords ;
      if($ispromotion == 1){
            $keywords_sql .= "AND (pds_list_promotions.title LIKE '%".$keywords."%' OR pds_list_promotions.comments LIKE '%".$keywords."%') ";
            $promotion_keywords_sql = "AND (pds_list_promotions.title LIKE '%".$keywords."%' OR pds_list_promotions.comments LIKE '%".$keywords."%')";

      }else{
            $keywords_sql .= "AND (firm LIKE '%$keywords%' OR pds_list.description LIKE '%".$keywords."%' OR pds_category.title like '%".$keywords."%') ";
      }
      $smarty_url_string .="&keywords=$keywords";
      
     if(biz_elgg_is_non_empty($keywords)){
        $show_filter .="| keywords like $keywords";
    }
}

if ((isset($prev_business_title)) && (strlen($prev_business_title)>0))
{
      $business_title=  $prev_business_title ;
      $business_title_sql .= "AND firm LIKE '%".$business_title."%' ";
      $smarty_url_string .="&business_title=$business_title";

      if(biz_elgg_is_non_empty($business_title)){
        $show_filter .="| Business Title like $business_title";
    }
}




   if($ispromotion == 1){
       $record_fetch_condition = "Distinct pds_list.*, pds_list_promotions.id as tmp_promo_id";
       if ($filter_id){
          $sql = "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' $search_sql $zip_limit $contrysql $statesql $categorysql $location_sql $connectionsql $groupmemsql $metro_areasql $keywords_sql $business_title_sql $currPromSql ORDER BY pds_list_promotions.id DESC, firm LIMIT $xlimit,$ylimit;";

        $promotion_filter_critera_sql = "$statesql $metro_areasql $promotion_keywords_sql ";
       }else{
           $list_rcmd = (is_not_empty(listOf_Biz_rcmd_by_user($_SESSION['guid']))?listOf_Biz_rcmd_by_user($_SESSION['guid']):"0");
           $list_survey = (is_not_empty(listOf_Biz_survey_by_user($_SESSION['guid']))?listOf_Biz_survey_by_user($_SESSION['guid']):"0");

           //..fetch the Recommendation & survyed coupons
             $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND pds_list_promotions.end_date>=CURDATE() AND (cupon_type LIKE 'recommendation' AND pds_list_promotions.list_id in ({$list_rcmd})) OR  (cupon_type LIKE 'survey'  AND pds_list_promotions.list_id in ({$list_survey}))";
           $promotion_filter_critera_sql = " AND pds_list_promotions.end_date>=CURDATE() AND (cupon_type LIKE 'recommendation' AND pds_list_promotions.list_id in ({$list_rcmd})) OR  (cupon_type LIKE 'survey'  AND pds_list_promotions.list_id in ({$list_survey}))";
       }

   }else{
       $record_fetch_condition =  "Distinct pds_list.*";
       $sql = "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' $search_sql $zip_limit $contrysql $statesql $categorysql $location_sql $connectionsql $groupmemsql $metro_areasql $keywords_sql $business_title_sql ORDER BY  firm LIMIT $xlimit,$ylimit;";
   }
    //echo $sql;
	 //exit;

    
    $qry_array = array();
    $qry_array['sql'] = $sql;
    $qry_array['promotion_sql'] = $promotion_filter_critera_sql;
	//echo $show_filter;exit;
      if (is_not_empty($show_filter)){
        $show_filter = substr($show_filter, 1);
      }
	  /*echo "$filter_id : $show_filter"; */
    if(!is_gt_zero_num($filter_id)){
       //$show_filter = "<b>Recomendation & Survey Coupons</b>";
       $show_filter = "";
    }
	/*echo $show_filter;exit;*/
    $qry_array['show_filter'] = $show_filter;
    return $qry_array;
}

//..check how many times a promotion was viewed
function IncreaseViewCount($pr_id=0,$buss_id=0)
{
        $guestid=0;
        $user_id=0;
        
        if($_SESSION['userid'])
            $user_id=$_SESSION['userid'];
        else{
            //this is guest user..so check insession
            if(isset($_SESSION['snVisitedAllListing'])){
                 $get_ip_id = explode(",",$_SESSION['snVisitedAllListing']);
                 $guestid= $get_ip_id[1];
             }
        }

        $MAX_VISITS_PER_HOUR=1;
        // check if user has hit this page in the past hour
		$ip = $_SERVER['REMOTE_ADDR'];
        //extract number of hits on last hour
        $sql = 'SELECT count(*) AS hits_last_hour '.
           'FROM pds_promotion_hits WHERE promotion_id = ' . $pr_id . ' AND ip = "' . $ip . '" AND '.
           'created_on >= DATE_ADD(NOW(),INTERVAL -1 HOUR)';
        $result =mysql_query($sql);
        if($result){
            $output =  mysql_result($result, 0) ;
        }else{
            $output =0;
        }
		// ok to increase view count
		// as per new requirement we want to increase the view count each time viewed
		
		//if ($output < $MAX_VISITS_PER_HOUR)
		//{
			// update hits table
			$sql = 'INSERT INTO pds_promotion_hits (promotion_id,business_id, created_on, ip , user_id, guestid) VALUES (' . $pr_id . ',' . $buss_id . ', NOW(), "' . $ip . '",'.$user_id.','.$guestid.')';
			mysql_query($sql);

            // update promotion table if this is promotion
            if($pr_id>0){
                $sql = 'UPDATE pds_list_promotions SET views_count = views_count + 1 									 WHERE id = ' . $pr_id;
			    mysql_query($sql);
            }
		//}
}

function get_current_promotions($list_id){
  $promotions = array();
  if(is_gt_zero_num($list_id)){
    $sql = "SELECT  id  FROM pds_list_promotions WHERE list_id = $list_id AND end_date >= CURDATE() ";
   //echo $sql;
	$result= mysql_query($sql);

	if($result){
        $x = 0;
		  while ($row = mysql_fetch_assoc($result)){
	        $promotions[$x] = get_promotion_info($row[id]);
	        $x++;
		  }
 	}
  }
   /*
$sql = "SELECT  id  FROM pds_list_promotions WHERE list_id = $list_id AND end_date >= CURDATE() LIMIT 0,2;";
*/
	return $promotions;
}

function get_active_promotions_count($list_id){
    $sql = "SELECT  count(id)  FROM pds_list_promotions WHERE list_id = $list_id AND end_date >= CURDATE()";
    $result= mysql_query($sql);
	$count = 0;
	if($result){
        $row = mysql_fetch_row($result);
		$count = $row[0];
	}
	return 0;
}

function biz_elgg_is_non_empty ($str){
  if ((isset($str))&&((strlen(trim($str)))!=0)){
        return true;
  }
  return false;
}

function chk_allow_for_free_post($post_date){
    $ALLOW_FOR_FREE_POST = 1;
    $setting_interval_in_month = get_plugin_setting('free_promotion_post_interval','business_listing');
    if((is_not_empty($setting_interval_in_month))&&($setting_interval_in_month > 0)){
          $next_post_date = date( "Y-m-d", strtotime("+$setting_interval_in_month month", strtotime($post_date)));
          //echo "post_date=$post_date/next_post_date=".$next_post_date."/strtotime('now')=".strtotime('now')."/strtotime(next_post_date)=".strtotime($next_post_date);
          //...if todays date is greater than the next-post-date then allow him to post other wise not
          if(strtotime("now") > strtotime($next_post_date))
                $ALLOW_FOR_FREE_POST = 1;
  		  else
                $ALLOW_FOR_FREE_POST = 0;
    }
	return $ALLOW_FOR_FREE_POST;
}


function get_last_post_date_not_within_subscribed_period($subscribed_period){

    if(isset($_SESSION['guid'])&&($_SESSION['guid']>0)){
	    $sql_condition = "1";
		if(!empty($subscribed_period)){
            $sql_condition  = "";
		     foreach ($subscribed_period as $dt){
		        $sql_condition .= "  Not(`start_date` <= '{$dt['usub_created_dt']}' AND  `end_date` >= '{$dt['usub_exp_dt']}') OR";

		     }
	       if((strlen((trim($sql_condition)))) > 0){
	           $sql_condition = "(".substr($sql_condition,0,strlen($sql_condition)-2).")";
	       }
		}

			$sql = "SELECT `start_date` FROM `pds_list_promotions` WHERE pds_list_promotions.list_id = (SELECT id FROM pds_list WHERE userid=".$_SESSION['guid']." order by id asc LIMIT 0,1) AND $sql_condition order by pds_list_promotions.id desc LIMIT 0,1 ";

         //echo "sql=$sql";

    	$result = mysql_query($sql);
		if($result){
            while ($row = mysql_fetch_assoc($result)){
       		return $row['start_date'];
	  		}
  		}
	}

	return '';
}

function getListIdByPromotion($promotion_id){
	if($promotion_id){
        $sql = "SELECT `list_id` FROM `pds_list_promotions` WHERE pds_list_promotions.id =   $promotion_id";

         //echo "sql=$sql";

    	$result = mysql_query($sql);
		if($result){
            while ($row = mysql_fetch_assoc($result)){
       		return $row['list_id'];
	  		}
  		}
 	}
    return 0;
}


function getMeUsrCurrStatus(&$elgg_user_acct_type,&$elgg_user_allow_to_post,&$elgg_user_subscription_id,&$elgg_remaining_itm_to_post,&$tpl){
    /*
	//.. For Free POST
    if ($elgg_user_acct_type=="business" || $elgg_user_acct_type=="social/business organization"){
        $elgg_user_allow_to_post =   biz_fn_chk_user_allow_to_post(ELGG_PRODUCT_PROMOTIONS,$_SESSION['guid'], $elgg_remaining_itm_to_post,$elgg_user_subscription_id);
       // echo "elgg_user_allow_to_post =$elgg_user_allow_to_post <br>elgg_remaining_itm_to_post=$elgg_remaining_itm_to_post <br>elgg_user_subscription_id=$elgg_user_subscription_id <br> ";

        //Here check if it is ""free post"" or ""subscription post""
        if ($elgg_user_allow_to_post){
            if ($elgg_user_subscription_id && $elgg_remaining_itm_to_post){
                //..he is allowed to post since he has subscription and items remaing
            }else{
                //..Free post logic..not subscribed so get list of subscriptions
                $elgg_user_subscribed_period = array();
                $elgg_user_subscribed_period = biz_fn_get_all_the_user_subscription_past_year_period($_SESSION['guid']);
                $last_post_date = get_last_post_date_not_within_subscribed_period($elgg_user_subscribed_period);
                $elgg_user_allow_to_free_post = chk_allow_for_free_post($last_post_date);
            }
        }
    }    
    $tpl->assign('elgg_remaining_itm_to_post',$elgg_remaining_itm_to_post);
    $tpl->assign('elgg_user_subscription_id',$elgg_user_subscription_id);
    $tpl->assign('elgg_user_allow_to_post',$elgg_user_allow_to_post);
    $tpl->assign('elgg_user_allow_to_free_post',$elgg_user_allow_to_free_post);
*/
	
	$tpl->assign('elgg_remaining_itm_to_post',99999);
    $tpl->assign('elgg_user_subscription_id',1);
    $tpl->assign('elgg_user_allow_to_post',1);
    $tpl->assign('elgg_user_allow_to_free_post',1);
}

function getMeBusHours($selHour=""){
    $out="";
    /*
if ("Closed"==$selHour) $out.="<option value=\"Closed\" selected=\"selected\">Closed</option>\n";
    else
*/
    $out.="<option value=\"Closed\">Closed</option>\n";

	for ($x=0;$x<=23;$x++){
      if($x<10)
    	{
            $x="0$x";
        }
      for ($y=0;$y<=55;$y=$y+15){

        if($y<10)
    	{
            $y="0$y";
        }

		if ("$x:$y"==$selHour) $out.="<option value=\"$x:$y\" selected=\"selected\">$x:$y</option>\n";
		else $out.="<option value=\"$x:$y\">$x:$y</option>\n";
      }
	}
return $out;
}

function setProfileSettings($vs_current_listing_id,$fld_mail_add,$fld_contact,$fld_phone,$fld_fax,$fld_mobile,$fld_email){
        $r_access = mysql_query("SELECT fld_mail_add,fld_contact,fld_phone,fld_fax,fld_mobile,fld_email FROM pds_list_access_level WHERE list_id=".$vs_current_listing_id) or die( mysql_error());
        if (mysql_num_rows($r_access) > 0){
            //If record found then update the record
            $rslt= mysql_query("UPDATE pds_list_access_level SET fld_mail_add=$fld_mail_add,fld_contact=$fld_contact,fld_phone=$fld_phone,fld_fax=$fld_fax,fld_mobile=$fld_mobile,fld_email=$fld_email WHERE list_id=".$vs_current_listing_id);
     	}else{
            //else insert into db new record
            $rslt= mysql_query("INSERT INTO pds_list_access_level (list_id,fld_mail_add,fld_contact,fld_phone,fld_fax,fld_mobile,fld_email) VALUES (".$vs_current_listing_id.",$fld_mail_add,$fld_contact,$fld_phone,$fld_fax,$fld_mobile,$fld_email)") ;
        }
        mysql_free_result($r_access);
}

function chkUserIsOwner($list_id){
    $retVal = false;
    if (is_gt_zero_num($list_id)){
       $res =  mysql_query("SELECT  `userid` FROM  `pds_list` WHERE  `id` ={$list_id}");
       if($res){
           $owner_id = mysql_result($res, 0);
           if((is_gt_zero_num($owner_id)) && (is_gt_zero_num($_SESSION['guid']))  && ($owner_id == $_SESSION['guid'])){
              $retVal = true;
           }
       }
       if($retVal == false){
           if(isadminloggedin()){
             $retVal = true;
           }
       }
    }
    return $retVal;
}

function getOwner($list_id){
    $retVal = 0;
    if (is_gt_zero_num($list_id)){
       $res =  mysql_query("SELECT  `userid` FROM  `pds_list` WHERE  `id` ={$list_id}");
       if($res){
           $retVal = mysql_result($res, 0);
       }
    }
    return $retVal;
}

function getCouponType($id){
    $retVal = "";
    if (is_gt_zero_num($id)){
       $res =  mysql_query("SELECT `cupon_type` FROM `pds_list_promotions` WHERE  `id` ={$id}");
       if($res){
           $retVal = mysql_result($res, 0);
       }
    }
    return $retVal;
}

//..function to check if teh customer it returned customer
function chk_if_is_return_cust($user_id,$customer_type,$promotion_id){
		$rec_fnd=0;
		$outPut=0;
		if(is_gt_zero_num($user_id) && is_gt_zero_num($promotion_id)){
			$objpds_redim_cupons=new pds_redim_cupons();
		  $lst_recs=$objpds_redim_cupons::readArray(array('user_id'=>$user_id,'promotion_id'=>$promotion_id,'customer_type'=>$customer_type),$rec_fnd,0);
			if(($lst_recs) && (is_gt_zero_num($rec_fnd))){
				$outPut=1;
			}
		}	
		return $outPut;	
}


//...function to apply discount to order
function applyDiscountToOrder($cust_nm,$promotion_id,$cust_sess_id,$coupon_id){
 //echo "applyDiscountToOrder($cust_nm,$promotion_id,$cust_sess_id) <br>";
 $strOpMsg='';
 if((is_gt_zero_num($cust_sess_id)) && (is_not_empty($cust_nm))){
 	//..first get the customers order for that session
 	$search_array=array();
	$search_array['isActive']=1;
 	$search_array[ORDER_CUSTOMER_NAME] = $cust_nm;
	$search_array[ORDER_SESSION_ID]= $cust_sess_id;	
	if(is_gt_zero_num($_SESSION[SES_COOKIE_UID])){
		$search_array[ORDER_CUSTOMER_ID] = $_SESSION[SES_COOKIE_UID];
		$search_array[ORDER_CUSTOMER_TYPE] = CUST_TYPE_COOKIE;
	}
	$search_array[LIMIT_TITLE]= 1;
	$all_cust_orders = tbl_orders::readArray($search_array);	
	
if((is_not_empty($all_cust_orders))&&(count($all_cust_orders)>0)){
	//..Get the prmotion details
	$prom_detail=get_promotion_info($promotion_id);
	//..create the coupon object for confirmation purpose only	
	$cupons = new pds_redim_cupons();	
	//..If order there check if any discount is already applied for that
	foreach ($all_cust_orders as $cust_ord) {
		$order_id=$cust_ord['order_id'];
		//..Get the order details along with sub items				   
	  $order_detail= tbl_orders::GetInfo($order_id);
		$tb_sess_ords=tbl_orders::getOrdGrAmtBySession($cust_sess_id);
		$order_bill_amount=$tb_sess_ords['orders'][$order_id];
		$order_items=$order_detail['order_details'];		
		//..First check if the discount is previously applied	
		//$prev_applied=tbl_order_promotions::chkIfPromAlreadyApplied($order_id,$promotion_id);
		$prev_applied= tbl_order_applied_proms::chkIfDiscountAlreadyApplied($order_id,$promotion_id);
		//  tbl_order_details::chkIfDiscountAlreadyApplied($order_id,$promotion_id);		
		//..if discount is not applied previously proceed
		if(!$prev_applied)
		{
			//..check if the disocunt type = complete order 
			if($prom_detail['disc_aply_type']=='ORDER'){		
				//..get discount amount			
				$discount_amount=tbl_order_applied_proms::getDiscountAmnt($prom_detail['disc_amt_type'],$prom_detail['disc_amt'],$order_bill_amount);			
				//..Update the order when the promtion is applied
			  $objtbl_orders=new tbl_orders();
				if($objtbl_orders->readObject(array(ORDER_ID=>$order_id))){
					$objtbl_orders->setorder_promotion($prom_detail['id']);
					$objtbl_orders->setorder_discount_id(0);
					$objtbl_orders->setorder_discount_amt($discount_amount);
				}
		 		unset($objtbl_orders);
				//..Confirm the copuon							
				$cupons->redimCupon($coupon_id,1,1,$order_id);					
			}else{
				//..if disocunt type=ITEM 
				//..fetch all records from discount table with that promotion
				$disc_filter=array();	
				//..IF exclusive then apply to only one item 
				if($prom_detail['is_exclusive']==1){
					$disc_filter[LIMIT_TITLE ]=1;	
				}
				$disc_filter[PRMDISC_PROMOTION]=$promotion_id;				
				$prom_discountslist = tbl_prom_discounts::readArray($disc_filter);
				//..If discounts records are there ..loop through each discount
				if((is_not_empty($prom_discountslist))&&(count($prom_discountslist)>0) && (is_not_empty($order_items))){					
					foreach($prom_discountslist as $discount_rec){						
						//..Check if the condition is present
						if(is_gt_zero_num($discount_rec['prmdisc_condition'])){
							//..if there are any items present in order without disc
							$tmp_fnd=0;
							$ord_det_items=array();
							//$ord_det_items=tbl_order_details::readArray(array(ORD_DTL_ORDER_ID=>$order_id,ORDPROM_DISCOUNT_AMT=>0),$tmp_fnd,1,0);					
							$ord_det_items=tbl_order_applied_proms::readArray(array(ORD_DTL_ORDER_ID=>$order_id,ORDPROM_DISCOUNT_AMT=>0),$tmp_fnd,1,0);							
							if($tmp_fnd>0){
								//..fetch the conditions for that discount	
								$tmp_fnd=0;							
								$lst_disc_conds=tbl_prom_cond_details::readArray(array(PRCNDTL_CONDITION=>$discount_rec['prmdisc_condition'],'isActive'=>1,SORT_BY=>'DESC',SORT_ON=>PRCNDTL_COND_TYPE),$tmp_fnd,1,0);
								if($tmp_fnd>0){
									$filt_cond="";//Clear the filter
									$bogo_filt_cond=array();
									foreach($lst_disc_conds as $_cond){
										 //..Based on the condition type	
										 if($_cond[PRCNDTL_COND_TYPE]=='WKDAY'){
										 		$todays_day=strtolower(date("l"));
												if($_cond["prcndtl_wkdy_{$todays_day}"]=='N'){
													continue;	
												}
										 }elseif($_cond[PRCNDTL_COND_TYPE]=='DAYTIME'){
										 		$cur_time=date("H:i:s");
										 	  if(!(($_cond["prcndtl_daytime_from"]<=$cur_time)&&($_cond["prcndtl_daytime_to"]>=$cur_time))){
														continue;
												}										 	 
										 }elseif($_cond[PRCNDTL_COND_TYPE]=='BOGO' || $_cond[PRCNDTL_COND_TYPE]=='BOGO_ITEM'){										 			
													//..Check if discount is with sub menu item is selected
													$part_sub_itm="`ord_dtl_quantity`>= ".$_cond["prcndtl_bogo_qty"];
													if(is_gt_zero_num($_cond["prcndtl_bogo_sbmnu_dish"])){
														$bogo_filt_cond[]= " (`ord_dtl_sbmenu_dish_id`=".$_cond["prcndtl_bogo_sbmnu_dish"]." AND $part_sub_itm) ";
													}else{
													  //..Get all submenu dish ids from submenu..
														$rs_apl_disc_items= tbl_submenu_dishes::getSubMenuItems($_cond["prmdisc_bogo_sbmnu"]);
														if(is_not_empty($rs_apl_disc_items)){
															$bogo_filt_cond[] = " (`ord_dtl_sbmenu_dish_id` IN (".$_cond["prcndtl_bogo_sbmnu_dish"].") AND {$part_sub_itm})";
														}
												 }
										 }
									}
									//..Grab all conditions
									if(is_not_empty($bogo_filt_cond)){
											$bogo_filt_qry=implode(" AND ",$bogo_filt_cond);
											$bogo_filt_qry="`ord_dtl_order_id`={$order_id} AND `ordprom_promotion`={$promotion_id} AND {$bogo_filt_qry}";
											//..fetch the items
											$ord_avail_itms=tbl_order_applied_proms::getOrderItems($bogo_filt_qry);
											if(is_not_empty($ord_avail_itms)){
											//..item presents in order detail wihtout disocunt
											//..loop through the all the order items records
												foreach($ord_avail_itms as $order_itm){
			  									//..Right item to apply discount						
													$discount_amount=tbl_order_applied_proms::getDiscountAmnt($discount_rec['disc_amt_type'],$discount_rec['disc_amt'],$order_itm[ORD_DTL_PRICE]);
												//..Update order-detail with discount,promotion
													$success=tbl_order_applied_proms::update_item_with_discount($order_itm[ORD_APP_PROM],$promotion_id,$discount_rec['prmdisc_id'],$discount_amount);					
													//..Confirm the copuon							
													$cupons->redimCupon($coupon_id,1,1,$order_id);												}
											}
									}
								}else{
									$strOpMsg= "No conditions found to apply discount" ;
								}	
							}else{
								$strOpMsg= "All items are discounted" ;
								return 0;
							}
						}else{
							//..Apply discount for applicable items only						
							//tbl_order_details::bogo_apply_disc($order_id,$promotion_id,$discount_rec['prmdisc_id'],$discount_rec['prmdisc_bogo_sbmnu'],$discount_rec['prmdisc_bogo_sbmnu_dish'],$discount_rec['prmdisc_bogo_qty'],$discount_rec['prmdisc_disc_amt_type'],$discount_rec['prmdisc_disc_amt']);
						 tbl_order_applied_proms::bogo_apply_disc($order_id,$promotion_id,$discount_rec['prmdisc_id'],$discount_rec['prmdisc_bogo_sbmnu'],$discount_rec['prmdisc_bogo_sbmnu_dish'],$discount_rec['prmdisc_bogo_qty'],$discount_rec['prmdisc_disc_amt_type'],$discount_rec['prmdisc_disc_amt']);
							//..Confirm the copuon							
							$cupons->redimCupon($coupon_id,1,1,$order_id);
						}
					}						
				}else{
					$strOpMsg= "No discount found" ;	
				}
			}					
		}
	}	 
 }else{
	$strOpMsg= "There are no orders to apply promotion" ;
 }
		
 }else{
	$strOpMsg= "You are not in table session ";
 }	
 return $strOpMsg;
}


function getAvailPromForOrder($order_id){
	$rows = array();
	if(is_gt_zero_num($order_id)){
		$res = mysql_query('SELECT  pds_list_promotions.id , pds_list_promotions.list_id , pds_list_promotions.title, pds_list_promotions.end_date FROM pds_list_promotions WHERE  pds_list_promotions.`prm_restaurent`='.$_SESSION[SES_RESTAURANT].' AND pds_list_promotions.id NOT IN  (SELECT promotion_id FROM `pds_redim_cupons` WHERE order_id = '.$order_id.')  AND pds_list_promotions.start_date <= CURDATE() AND pds_list_promotions.end_date >= CURDATE() ORDER BY  pds_list_promotions.id DESC'); 
		if($res){
			while($row = mysql_fetch_assoc($res)){
				$rows[]  = $row;
			}
		}
	}
	return $rows;
}

//...from order payment
//...function to apply discount to order
//..CURRENTLY USED FUNCTION
function applyPromotionToOrder($order_id){
 $ret_success=0;
 $strOpMsg='';
 $prom_count=0;
 if(is_gt_zero_num($order_id)){	
	//..Get the prmotion details
	$prom_detail=get_promotion_info($promotion_id);
	//..create the coupon object for confirmation purpose only
	$cupons = new pds_redim_cupons();	
	//..First check if for that order any discount is already applied for that
	//..Get the order details along with sub items	   
  $order_detail= tbl_orders::GetInfo($order_id);	
	$cust_sess_id=$order_detail['order_session_id'];
	$cust_nm=$order_detail['order_customer_name'];	
	//..Get order amount using the table session
	$tb_sess_ords=tbl_orders::getOrdGrAmtBySession($cust_sess_id);
	$order_bill_amount=$tb_sess_ords['orders'][$order_id];
	$order_items=$order_detail['order_details'];
	//..fetch all claimed promotion for that order	
	$allcopons = $cupons->readArray(array('cust_sess_id'=>$cust_sess_id,'biz_not_redimed'=>1),$prom_count);
	//print_r($allcopons);
	//echo "<br>prom_count=$prom_count<br>";
	//print_r($tb_sess_ords);
	//exit;
	
	if(is_gt_zero_num($prom_count)){ 
	//..loop through each promotion claimed
	foreach ($allcopons as $cupobj){	
	//..fecth promotion id based on the coupon
	$promotion_id = $cupobj->getpromotion_id();
	$coupon_id= $cupobj->getid();
	$prom_detail=get_promotion_info($promotion_id);
	//print_r($prom_detail);
	//..First check if the discount is previously applied	
	$prev_applied= tbl_order_applied_proms::chkIfDiscountAlreadyApplied($order_id,$promotion_id);
	//..Check if promotion is allowed based on weekday's availability and day time range then only allow that
	$_is_allowed_based_on_day_time= tbl_order_applied_proms::_is_prom_day_time_allowed($promotion_id);
	
	//echo "prev_applied=$prev_applied || _is_allowed_based_on_day_time=$_is_allowed_based_on_day_time";
	//echo $prom_detail['disc_aply_type'];
	
	//exit;		
	//..if discount is not applied previously proceed
	if(!$prev_applied && $_is_allowed_based_on_day_time)
	{
		//..check if the disocunt type = complete order 
		if($prom_detail['disc_aply_type']=='ORDER'){		
			//..Get discount amount			
			//$discount_amount= tbl_order_applied_proms::getDiscountAmnt($prom_detail['disc_amt_type'],$prom_detail['disc_amt'],$order_bill_amount);	
			$discount_amount= tbl_order_details::getDiscountAmnt($prom_detail['disc_amt_type'],$prom_detail['disc_amt'],$order_bill_amount);			
			//echo "order_bill_amount=$order_bill_amount | discount_amount=$discount_amount";				//exit;
			//..Update the order when the promtion is applied
		    $objtbl_orders=new tbl_orders();
			if($objtbl_orders->readObject(array(ORDER_ID=>$order_id))){
				$objtbl_orders->setorder_promotion($promotion_id);
				$objtbl_orders->setorder_discount_id(0);
				$objtbl_orders->setorder_discount_amt($discount_amount);
				$objtbl_orders->insert();
			}
	 		unset($objtbl_orders);
			$ret_success=1;			
		}elseif($prom_detail['disc_aply_type']=='FIXED'){
			//..Here no discount id just apply promoiton
			//..disocunt amount and conditions 
			$arr_search=array('prmcon_promotion'=>$promotion_id);
			
			$_sel_items_lst=tbl_order_applied_proms::bogo_get_conditions($order_id,$arr_search);						 
			$ret_success=tbl_order_applied_proms::_apply_disc_selected_lst($_sel_items_lst,$promotion_id,0,'VALUE',$prom_detail['disc_amt'],1);	
							
		}elseif($prom_detail['disc_aply_type']=='COND_DISC'){
			//..Here no discount id just apply promoiton
			//..discount amount discount and conditions
			//..Get discount amount			
			$arr_search=array('prmcon_promotion'=>$promotion_id);
			$_sel_items_lst=tbl_order_applied_proms::bogo_get_conditions($order_id,$arr_search);
			//print_r($_sel_items_lst);	
			//exit;		
			$ret_success=tbl_order_applied_proms::_apply_disc_selected_lst($_sel_items_lst,$promotion_id,0,$prom_detail['disc_amt_type'],$prom_detail['disc_amt']);					
		}else{
			//..If discount type=ITEM 
			//..fetch all records from discount table with that promotion
			$disc_filter=array();	
			//..If exclusive then apply to only one item 
			if($prom_detail['is_exclusive']==1){
				$disc_filter[LIMIT_TITLE]=1;	
			}
			$disc_filter[PRMDISC_PROMOTION]=$promotion_id;	
			$prom_discountslist = tbl_prom_discounts::readArray($disc_filter);
			//print_r($prom_discountslist);
			//exit;
			
			//..If discounts records are there..loop through each discount
			if((is_not_empty($prom_discountslist))&&(count($prom_discountslist)>0) && (is_not_empty($order_items))){
				$_sel_discnt_lst_itms=array();
				$_sel_discnt_lst_itms=array();
				$_sel_items_lst=array();
				foreach($prom_discountslist as $discount_rec){													//echo "discount_rec['prmdisc_condition']=".$discount_rec['prmdisc_condition'];
					//..Check if the condition is present
					if(is_gt_zero_num($discount_rec['prmdisc_condition'])){			
						$arr_search=array(PRCNDTL_CONDITION=>$discount_rec['prmdisc_condition'],'isActive'=>1,SORT_BY=>'DESC',SORT_ON=>PRCNDTL_COND_TYPE);
						//echo "discount_rec['prmdisc_condition']=".$discount_rec['prmdisc_condition'];	
						//$_sel_cond_lst_itms=tbl_order_applied_proms::bogo_get_conditions($order_id,$arr_search);
						//print_r($_sel_cond_lst_itms);
					  //echo "=============================";
					  //exit;
						//..merge found list to the selected item list				
						if(is_not_empty($_sel_cond_lst_itms)){
							$_sel_items_lst=array_unique(array_merge($_sel_items_lst,$_sel_cond_lst_itms));
						}	
						//echo "<hr>";
						//print_r($_sel_items_lst);
						//exit;
					}	
					//exit;											
					//..get items for Apply discount for applicable items only
					$_sel_discnt_lst_itms=tbl_order_applied_proms::_get_slectd_item_from_bogo($order_id,$discount_rec['prmdisc_bogo_sbmnu'],$discount_rec['prmdisc_bogo_sbmnu_dish'],$discount_rec['prmdisc_bogo_qty'],$_sel_items_lst);
					//echo "<br> i am here";
					//print_r($_sel_cond_lst_itms);
					//print_r($_sel_discnt_lst_itms);				
					//..merge found list to the selected item list				
					if(is_not_empty($_sel_discnt_lst_itms)){
						$_sel_items_lst=array_unique(array_merge($_sel_items_lst,$_sel_discnt_lst_itms));
					}					
				}
				//print_r($_sel_items_lst);
				//exit;
				$ret_success=tbl_order_applied_proms::_apply_disc_selected_lst($_sel_items_lst,$promotion_id,$discount_rec['prmdisc_id'],$discount_rec['prmdisc_disc_amt_type'],$discount_rec['prmdisc_disc_amt']);
										
			}else{
				$strOpMsg= '<div class="info">No discount found</div>' ;	
			}
		}
		if(is_gt_zero_num($ret_success)){
			//..Confirm the copuon							
			$cupons->redimCupon($coupon_id,1,1,$order_id);
			//..IF is_exclusive then break
			if($prom_detail['is_exclusive']==1){
				break;
			}
		}					
	} 
 }//..foreach for all customer ssesion promotions 
 }//..End if  			
 }else{
	$strOpMsg= '<div class="info">Please provide order to apply discount</div>';
 }	
 return $ret_success;
}
?>