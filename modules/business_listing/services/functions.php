<?php

function getPromotionListing($listing_type = "all", $show_type="PR" , $offset=0, $limit=2, $filter_id=0){
    $user =  get_user($_SESSION['guid']);
     $xlimit = $offset;
     $ylimit =  $limit;
     $show_filter = "";
    if ($show_type == 'PR'){
        $ispromotion= 1;
        $promtionsql = " AND pds_list_promotions.end_date>=CURDATE() AND cupon_type = 'none'";
        $title_tag = "All Promotions";
        $record_fetch_condition = " DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id";
}else{
    	$ispromotion= 0;
    	$title_tag = "All listing";
		$record_fetch_condition = " DISTINCT pds_list.* ";
}
    if ($listing_type == "bizness"){
       $biz_id = $filter_id;
       $sql = "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' and pds_list.id =$biz_id $promtionsql ORDER BY pds_list_promotions.id DESC, firm LIMIT $xlimit,$ylimit;";
       $title_tag =  "Latest Businesses";

    }elseif($listing_type == "random"){
          $sql = "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' $promtionsql ORDER BY pds_list_promotions.id DESC, firm LIMIT $xlimit,$ylimit;";
	         $title_tag =  "Latest Promotions";
    }elseif($listing_type == "all"){
        if ($ispromotion == 1){
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr'  $promtionsql ORDER BY pds_list_promotions.id DESC, firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " $promtionsql";
            $title_tag =  "All Promotions";
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' ORDER BY firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $title_tag =  "All Businesses";
  		}
    }elseif($listing_type == "popular"){
         if ($ispromotion == 1){
		    $on_join_string = " pds_list_promotions.id ";
                    $sql = "SELECT SQL_CALC_FOUND_ROWS Distinct {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE pds_list_promotions.views_count>0 AND state='apr' $promtionsql ORDER BY pds_list_promotions.views_count DESC, firm LIMIT $xlimit,$ylimit;";
		    $promotion_sql_filter=" $promtionsql and pds_list_promotions.views_count>0 ";
		    $title_tag =  "Popular Promotions";
		}else{
		    $on_join_string = " pds_list.id ";
              $sql = "SELECT SQL_CALC_FOUND_ROWS Distinct {$record_fetch_condition} FROM pds_list inner join pds_liststats on pds_list.id = pds_liststats.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE pds_liststats.page_views>0 AND state='apr' ORDER BY pds_liststats.page_views DESC, firm LIMIT $xlimit,$ylimit;";
		    $promotion_sql_filter = " ";
		    $title_tag =  "Popular Businesses";
		}
    }elseif($listing_type == "connection"){
        $fr_lst=GetMyConnectionList();

		    if (empty($fr_lst)){
		        $connectionsql = ' AND (1=2)';
		    }else{
		        $connectionsql = ' AND (userid IN ('.implode(",",$fr_lst).'))';
		    }

        if ($ispromotion == 1){
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE  state='apr'  $promtionsql  $connectionsql  ORDER BY pds_list_promotions.id DESC, firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " $promtionsql";
            $title_tag =  "Promotions By My Connections";
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE  state='apr' $connectionsql  ORDER BY  firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $title_tag =  "Businesses By My Connections";
  		}
    }elseif($listing_type == "group"){
        $fr_lst=GetMyGroupMemList($groupid);
	    if (empty($fr_lst)){
	        $groupmemsql = ' AND (1=2)';
	    }else{
	        $groupmemsql = ' AND (userid IN ('.implode(",",$fr_lst).'))';
	    }
		if ($ispromotion == 1){
            $promotion_sql_filter = " $promtionsql";
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE  state='apr'  $promtionsql  $groupmemsql ORDER BY pds_list_promotions.id DESC, firm LIMIT $xlimit,$ylimit;";
            $title_tag =  "Promotions By My Groups";
		}else{
            $promotion_sql_filter = " ";
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE  state='apr' $groupmemsql ORDER BY  firm LIMIT $xlimit,$ylimit;";
            $title_tag =  "Businesses By My Groups";
  		}
    }elseif($listing_type == "favorite"){
         if($ispromotion == 1){
                $sql =  "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list_promotions  left outer join pds_list  on pds_list_promotions.list_id = pds_list.id inner join pds_list_favorites  on pds_list_promotions.id = pds_list_favorites.list_id WHERE pds_list_favorites.ispromotion = 1 and pds_list_promotions.end_date>=CURDATE() and pds_list_favorites.user_id=".$_SESSION['guid']." ORDER BY firm LIMIT $xlimit,$ylimit;";
                $promotion_sql_filter = " and pds_list_favorites.user_id=".$_SESSION['guid'];
                $title_tag =  "My Saved Promotions";
			}else{
                $sql =  "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list inner join pds_list_favorites on pds_list.id = pds_list_favorites.list_id WHERE pds_list_favorites.ispromotion = 0 and pds_list_favorites.user_id=".$_SESSION['guid']." ORDER BY firm LIMIT $xlimit,$ylimit;";
                $promotion_sql_filter = "";
                $title_tag =  "My Favorite Businesses";
   			}
    }elseif($listing_type == "filter"){
         $title_tag =  "My Alerts";
         $sql_array = @get_intrested_in_sql_array($_SESSION['guid'],$xlimit,$ylimit,$ispromotion,$filter_id);

	       if (!empty($sql_array)){
	             $sql = $sql_array['sql'];
	             $promotion_sql_filter = $sql_array['promotion_sql'];
				 //print_r($sql_array['show_filter']);
	             $show_filter = $sql_array['show_filter'];
            }

    }elseif($listing_type == "post"){
        $sql_for_history = "SELECT SQL_CALC_FOUND_ROWS  DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id  FROM pds_list_promotions inner join pds_list   on pds_list_promotions.list_id = pds_list.id WHERE pds_list.userid='$_SESSION[guid]' ORDER BY pds_list_promotions.id desc  LIMIT $xlimit,$ylimit;";
            $sql = "SELECT SQL_CALC_FOUND_ROWS  DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id  FROM pds_list_promotions inner join pds_list   on pds_list_promotions.list_id = pds_list.id WHERE pds_list_promotions.end_date>=CURDATE() AND pds_list.userid='$_SESSION[guid]' ORDER BY pds_list_promotions.id desc LIMIT $xlimit,$ylimit;";

            $title_tag =  "My Promotions";
    }elseif($listing_type == "coupon"){
			$sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND pds_list_promotions.end_date>=CURDATE()  AND   cupon_type not in ('none','reward') ORDER BY pds_list_promotions.id DESC, firm LIMIT  $xlimit,$ylimit;";
			//$ispromotion = 2;
            $title_tag = "Coupons"; 
	 }elseif($listing_type == "reward"){	 
			$sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND pds_list_promotions.end_date>=CURDATE() AND  cupon_type = 'reward' and pds_list.id ={$biz_id} ORDER BY pds_list_promotions.id DESC, firm LIMIT  $xlimit,$ylimit;";
			 $title_tag = "Rewards"; 
	}elseif($listing_type == "quick_search"){
	 
    }
 //echo $sql."<hr>";
 $r_list = mysql_query ("$sql;") or die(mysql_error());

$r1 = mysql_query("SELECT FOUND_ROWS() as total;");
//echo mysql_num_rows($r_list);
$f1 = mysql_fetch_assoc($r1);
$result_found = $f1['total'];
//echo $result_found;exit;
$map_ids=array();
   $list = array();
     $list['title'] = $title_tag;
     $list['pagination'] = promotion_list_page_num_display($offset,$limit,$result_found,$listing_type,$show_type,$filter_id);
     $list['count'] = $result_found;
if(mysql_num_rows($r_list) > 0){
     $list['items'] =  getMeListFromRecords($r_list, 0, $promotion_sql_filter,$map_ids);
     $list['show_filter'] = $show_filter;
}

  return $list;

}

function promotion_list_page_num_display($offset,$limit,$count,$listing_type,$show_type,$filter_id=0) {

    $outPut="";

	if (!is_gt_zero_num($limit)){
        $limit = 10;
 	}
	    $totalpages = ceil($count / $limit);
		$currentpage = ceil($offset / $limit) + 1;

	//only display if there is content to paginate through or if we already have an offset
	if ($count > $limit || $offset > 0) {


$outPut .="<div class=\"pagination\">";

	if ($offset > 0) {

		$prevoffset = $offset - $limit;
		if ($prevoffset < 0) $prevoffset = 0;

		$prevurl = "getPromotionListing('{$listing_type}','{$show_type}',$prevoffset,$limit,$filter_id);";

        $outPut .= "<a href=\"#\" onclick=\"{$prevurl}\" class=\"pagination_previous\">&laquo; ". elgg_echo("previous") ."</a> ";

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
				$outPut .= "<span class=\"pagination_more\">...</span>";
			}

			 $curoffset = (($i - 1) * $limit);
		     $counturl = "getPromotionListing('{$listing_type}','{$show_type}',$curoffset,$limit,$filter_id);" ;
			if ($curoffset != $offset) {
				$outPut .= " <a href=\"#\" onclick=\"{$counturl}\" class=\"pagination_number\">{$i}</a> ";
			} else {
				$outPut .= "<span class=\"pagination_currentpage\"> {$i} </span>";
			}
			$prev = $i;

		}

	}

	if ($offset < ($count - $limit)) {

		$nextoffset = $offset + $limit;
		if ($nextoffset >= $count) $nextoffset--;

         $nexturl = "getPromotionListing('{$listing_type}','{$show_type}',$nextoffset,$limit,$filter_id);";
        //$nexturl = "alert($listing_type+'\n'+$show_type+'\n'+$nextoffset+'\n'+$limit);";


		$outPut .= " <a href=\"#\" onclick=\"{$nexturl}\">" . elgg_echo("next") . " &raquo;</a>";

	}


$outPut .="<div class=\"clearfloat\"></div>";
$outPut .="</div>";

    } // end of pagination check if statement
    return $outPut;
 }



 function view_promotion($promo_id){
     if(is_not_empty($promo_id)){
       $result = mysql_query ("SELECT DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND  pds_list_promotions.id ={$promo_id} LIMIT 0,1");
       if($result){
           IncreaseViewCount($promo_id);
           print_r(getMeListFromRecords($result, 0, " AND pds_list_promotions.end_date>=CURDATE()"));
           return getMeListFromRecords($result);
       }
     }
    return "";
 }

 function view_listing($list_id){
     if(is_not_empty($list_id)){
       $result = mysql_query ("SELECT DISTINCT pds_list.* FROM pds_list WHERE state='apr' AND  pds_list.id ={$list_id} LIMIT 0,1");
       if($result){
           return getMeListFromRecords($result);
       }
     }
    return "";
 }


function favorite_promotion($post_id, $new=0,$user_id=0,$show_type='PR',$biz_id=0){
    $msg = ""; //returning message

    if ( (isset($show_type)) && ($show_type == 'PR') ){
    	$ispromotion = 1;
    }else{
        $ispromotion = 0;
    }

    // IMP Note : Here list_id is common for
    if (is_gt_zero_num($post_id)){
        $list_id =$post_id;
    }else{
        $list_id =0;
    }

    if ( isset($user_id) ){
        $user_id =$user_id;
    }else{
        $user_id = $_SESSION['guid'];
    }
    $count = 0;
    if (is_gt_zero_num($list_id) && is_gt_zero_num($user_id)){
    	if($ispromotion){
    		//..here $list_id is promotion id not the business id so get the biz id
    		    if(is_gt_zero_num($_REQUEST['biz_id'])){
    				$biz_id = $_REQUEST['biz_id'];
    			}else{
                    $biz_id = getListIdByPromotion($list_id);
    		 	}
            $bus_user_id= getBizOwnerId($biz_id);
     	}else{
            $biz_id = $list_id;
    		$bus_user_id= getBizOwnerId($list_id);
      	}

    //..first get the business user id first..
        $sql = "SELECT userid
                FROM  pds_user  u
                INNER JOIN pds_list l ON u.id = l.userid
                where l.id =$biz_id";
        $result = mysql_query($sql);
        $vs_my_list = mysql_fetch_assoc($result);
        mysql_free_result($result);
    /*$bus_user_id=$vs_my_list["userid"];*/

        $sel_fr_cat= "Fan Of";
        $type_of_rel= "friendrequest_FN";
        $type_of_rel_auto_aprv= "FanOf";
        $msg_sel_fr_cat= "Fans";

    global $CONFIG;

        if ($new == 1){
  	    $result = mysql_query("Select id from pds_list_favorites where list_id= $list_id and user_id =$user_id and ispromotion = $ispromotion");
  		if ($result){
	  		$count = mysql_num_rows($result);
  		}
  		if ($count == 0){
  		    $sql = "insert into pds_list_favorites
			  		(list_id, user_id, created_date, ispromotion)
					   values
					   (".mysql_real_escape_string($list_id).",".
					     mysql_real_escape_string($user_id).",
						 Now(), ".
						 mysql_real_escape_string($ispromotion).
			 			")" ;
		    mysql_query($sql);
		    if($ispromotion == 1){
                 $msg = "<div class='messages'>Promotion added to saved.</div>";
            }else{
                 $msg = "<div class='messages'>Lising added as favorite.</div>";
            }


          if (($elgg_user_acct_type=="business") || ($elgg_user_acct_type=="social/business organization")){
          }else{
          if (!check_entity_relationship($bus_user_id, 'FanOf', $_SESSION['guid'])){
                   $friend=get_user($bus_user_id);
                   $log_usr=get_user($_SESSION['guid']);
                   if(isset($CONFIG->events['create']['friend'])) {
                		$oldEventHander = $CONFIG->events['create']['friend'];
                		$CONFIG->events['create']['friend'] = array();//Removes any event handlers
                   }
                   @add_entity_relationship($bus_user_id, "FanOf", $_SESSION['guid']);
                  if (!check_entity_relationship($bus_user_id, 'friend', $_SESSION['guid'])){
                        @$log_usr->addFriend($bus_user_id);
                	    @$friend->addFriend($_SESSION['guid']);//Friends mean reciprical...
                    }
                	add_freind_to_cat($_SESSION['guid'],$bus_user_id,$sel_fr_cat);

                	if(isset($CONFIG->events['create']['friend'])) {
                		$CONFIG->events['create']['friend'] = $oldEventHander;
                	}

              }else{
                //..If relationship is alreday there then check if it in coll.
                @add_freind_to_cat($_SESSION['guid'],$bus_user_id,$sel_fr_cat);
              }
          }
		}
	   }elseif ($new == -1) {
        $sql = "delete from pds_list_favorites where list_id =$list_id and user_id=$user_id and ispromotion = $ispromotion";
        mysql_query($sql);
        //..now remove as fan of as well but check only condition that the post should not be promotion
        //.. For Promotion do not remove from Fan connections.
        if(!$ispromotion){
           if (check_entity_relationship($bus_user_id, 'FanOf', $_SESSION['guid'])){
	            @remove_entity_relationship($bus_user_id, 'FanOf', $_SESSION['guid']);
	            //..Remove_user_from_access_collection
	            $FN_Col=get_user_access_collections_with_name($_SESSION['guid'],"Fan Of");
	            if ($FN_Col)
	                @remove_user_from_access_collection($bus_user_id, $FN_Col);
	        }
  		}
	    if($ispromotion == 1){
             $msg = "<div class='messages'>Promotion removed from saved.</div>";
        }else{
             $msg=  "<div class='messages'>Favorites Removed Successfully.</div>";
        }
	}

    }
    return  $msg;
 }

?>