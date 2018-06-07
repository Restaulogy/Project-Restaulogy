<?php 
//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************

 
include ("classes/inputfilter.php");
$filter = new inputFilter($allow_tags,$allow_attr);
$_GET = $filter->process($_GET);
foreach($_GET as $key=>$value){
	if( !get_magic_quotes_gpc() ){
		$_GET[$key] = addslashes($value);
	}
}
//***********************************************
// Result set paging
//***********************************************
include ("classes/SmartyPaginate.class.php");

SmartyPaginate::connect();
if ($_GET['nl'] == ""){
	SmartyPaginate::reset();
}
SmartyPaginate::setUrlVar('nl');
SmartyPaginate::setLimit($config[search_page]);
SmartyPaginate::setPrevText($language->desc("site_text",$lang_set,'previous'));
SmartyPaginate::setNextText($language->desc("site_text",$lang_set,'next'));
SmartyPaginate::setFirstText($language->desc("site_text",$lang_set,'first'));
SmartyPaginate::setLastText($language->desc("site_text",$lang_set,'last'));
$xlimit = SmartyPaginate::getCurrentIndex();
$ylimit = SmartyPaginate::getLimit();

//***********************************************
// Button Press Logic
//***********************************************

//.. For facebook recomm App 
$fb_recomm_app = get_input("fb_recomm_app", 0);
$ps_restnt = get_input("ps_restnt", 0);

$_in_cur_time=date(DATE_FORMAT);
//..coding for restarnt selection
if(is_gt_zero_num($ps_restnt)){
	$_SESSION[SES_RESTAURANT]=$ps_restnt;	
}

/***************************************
Checking For Busines Listing & Search Promotions
******************/
 
if((isset($_REQUEST['show_type'])) && ($_REQUEST['show_type']=='PR')){
	$show_type = 'PR';
}else{
    $show_type = 'BL';
}
$biz_id = 0;
if((isset($_REQUEST['biz_id'])) && ($_REQUEST['biz_id']>'0')){
	$biz_id = $_REQUEST['biz_id'];
}else{
	if(isset($_SESSION['guid']))
		$biz_id = getListingIDByUser($_SESSION['guid']);		
}

$cust_sess_id = get_input('cust_sess_id',0); 

if(is_gt_zero_num($_REQUEST['list_view'])){
  $tpl-> assign('list_view', 1);
}

$sort_on = get_input(SORT_ON,'pds_list_promotions.id'); 
$sort_by=$new_sort='';
biz_set_sorting_var($sort_by,$new_sort);
$sort_by = get_input(SORT_BY,'DESC');

//..Get listing type.
if ((isset($_REQUEST['listing_type'])) && (strlen($_REQUEST['listing_type'])>0)){
    $listing_type	= $_REQUEST['listing_type'] ;
}else{
  	/*
		if((isset($Global_member['rl_fn_promotion_expired'])) && ($Global_member['rl_fn_promotion_expired'] == 1)){
			if($Global_member['member_role_id'] == ROLE_ADMIN){	
					$listing_type = 'expired';
			}else{
					$listing_type = 'all';
			}				
		}else{
				$listing_type = 'all';
		}		
		*/
		$listing_type = 'all';	
}

if ($show_type == 'PR'){
    $ispromotion= 1;
    //$promtionsql = " AND pds_list_promotions.end_date>=CURDATE() AND Find_in_set('".$vs_user_prof_loc['metroareaid']."', pds_list_promotions.metro_area) AND cupon_type LIKE 'none' ";
		/**
		*
		$promtionsql = " AND pds_list_promotions.end_date>=CURDATE() AND cupon_type LIKE 'none' ";*/
		$promtionsql = " AND pds_list_promotions.`prm_restaurent`=".$_SESSION[SES_RESTAURANT]." AND pds_list_promotions.end_date>='{$_in_cur_time}'";
    $title_tag = "Promotions";
		$bread_crumb[0] = "Promotions";
    $record_fetch_condition = " DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id";
}else{
    $ispromotion= 0;
    $promtionsql = " AND Find_in_set('".$vs_user_prof_loc['metroareaid']."', pds_list.metro_area)";
    $title_tag = "All listing";
		$bread_crumb[0] =  "All listing";
		$record_fetch_condition = " DISTINCT pds_list.* ";
}

$btn_link[0] = "disabled";
$sql_for_history = "";
 
$promotion_sql_filter = "";
$show_filter = "";
$filter_id = 0;
if(is_gt_zero_num($_REQUEST['filter_id'])){
	$filter_id = $_REQUEST['filter_id'];
}

$interested = new InterestedIn($ispromotion, $filter_id );


$interested_id = $interested->getID();
//.. get All filters list
$filters = $interested->getAllFilters($ispromotion);



if (!empty($_POST)){
    if (isset($_POST['filter_save']))
	{
		$data = array();
		if (isset($_POST['country'])) 	{
		  if(is_array($_POST['country'])){
		        $data['country'] = implode(',', $_POST['country']);
		  }else{
		        $data['country'] = $_POST['country'];
		  }
		}else{
		    $data['country'] = '';
		}

		if( (isset($_POST['states'])) && ((strlen(trim($_POST['states'])))!=0)) {
		   $data['states'] = $_POST['states'];
		}else{
		  $data['states'] = 0;
		}

		if( (isset($_POST['metro_area'])) && ((strlen(trim($_POST['metro_area'])))!=0)){
		   $data['metro_area'] = $_POST['metro_area'];
		}else{
		   $data['metro_area'] = 0;
		}
		if( (isset($_POST['categories'])) && ((strlen(trim($_POST['categories'])))!=0)){
		     $data['categories'] = $_POST['categories'];
		}else{
		     $data['categories'] = '';
		}

		if( (isset($_POST['keywords'])) && ((strlen(trim($_POST['keywords'])))!=0)){
		     $data['keywords'] = $_POST['keywords'];
		}else{
		    $data['keywords'] = '';
		}
		if((isset($_POST['business_title'])) && ((strlen(trim($_POST['business_title'])))!=0)){
		    $data['business_title'] = $_POST['business_title'];
		}else{
		    $data['business_title'] = "";
		}
			
		if( (isset($_POST['title'])) && ((strlen(trim($_POST['title'])))!=0)){
		    $data['title'] = $_POST['title'];
		}else{
		    $data['title'] = "";
		}
			
		if( (isset($_POST['id'])) && ($_POST['id']==0)){
		    $interested_id = $_POST['id'];
		}else{
		    $interested_id =  $interested->getID();
		}

	$listing_type = 'filter';
	$is_view = 0;
	$data['isPromotions'] =$ispromotion;
    if ($interested_id>0){
          $interested->Edit($data);
    }else{
         $new_filter_id = $interested->Create($data);
         if(is_gt_zero_num($new_filter_id)){
            header("Location: {$CONFIG->wwwroot}modules/business_listing/promotionslisting.php?listing_type=all&show_type=PR&listing_type=filter&filter_id=$new_filter_id");
		}
	}
  }
}
  $interested_ppl = $interested->GetInfo();
  $tpl->assign('interested_ppl',$interested_ppl);
  if($_REQUEST['is_view']){
    	$is_view = $_REQUEST['is_view'];
  }

//echo "$listing_type=$listing_type";

switch ($listing_type){

    case "bizness": $sql = "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' and pds_list.id =$biz_id and pds_list_promotions.end_date>='{$_in_cur_time}' ORDER BY {$sort_on} {$sort_by}, firm LIMIT $xlimit,$ylimit;";
             		$bread_crumb[0] =  "Latest Businesses";
	 				break;
			
    case "random": $sql = "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' $promtionsql ORDER BY pds_list_promotions.id DESC, firm LIMIT $xlimit,$ylimit;";
	         $bread_crumb[0] =  "Latest Promotions";
			 break;
		
	case "all": 
	    if ($ispromotion == 1){
			
			  if(isCustomer()){	
					 $survey_cond=" AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";
			  }else{
					 $survey_cond="";
				}	
				//$survey_cond="";	  
			  $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND `is_event`=0 AND cupon_type<>'reward' AND pds_list_promotions.start_date<='{$_in_cur_time}' {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;"; 
			 		/*AND   pds_list_promotions.list_id = {$biz_id}*/
        $promotion_sql_filter = " $promtionsql";
        $bread_crumb[0] =  "Promotions";
		   
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list  inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' ORDER BY firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $bread_crumb[0] =  "All Businesses";
  		}
		break;	
		
		
	case "forthcoming": 
	    if ($ispromotion == 1){			
			  if(isCustomer()){	
			  	 $survey_cond=" AND cupon_type<>'survey' AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";
			  }else{
					 $survey_cond="";
				}		  
			  $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND `is_event`=0 AND cupon_type<>'reward' AND pds_list_promotions.start_date>'{$_in_cur_time}' {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;"; 
			 		/*AND   pds_list_promotions.list_id = {$biz_id}*/
        $promotion_sql_filter = " $promtionsql";
        $bread_crumb[0] =  "Promotions";
		   
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list  inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' ORDER BY firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $bread_crumb[0] =  "All Businesses";
  		}
		break;
		
	case "is_event": 
	    if ($ispromotion == 1){
			
			  if(isCustomer()){	
			  	 $survey_cond=" AND cupon_type<>'survey' AND cupon_type<>'invitation' AND cupon_type<>'exclusive'";
			  }else{
					 $survey_cond="";
				}		  
			  $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND `is_event`=1 AND cupon_type<>'reward' AND pds_list_promotions.start_date<='{$_in_cur_time}' {$survey_cond} {$promtionsql} ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;"; 
			 		/*AND   pds_list_promotions.list_id = {$biz_id}*/
        $promotion_sql_filter = " $promtionsql";
        $bread_crumb[0] =  "Promotions";
		   
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list  inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' ORDER BY firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $bread_crumb[0] =  "All Businesses";
  		}
		break;			

    
	case "popular":
		if ($ispromotion == 1){
                $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE pds_list_promotions.views_count>0 AND state='apr' $promtionsql ORDER BY pds_list_promotions.views_count DESC, firm LIMIT $xlimit,$ylimit;";
           $on_join_string = " pds_list_promotions.id ";
           $promotion_sql_filter=" $promtionsql and pds_list_promotions.views_count>0 ";
           $bread_crumb[0] =  "Popular Promotions";
       }else{
                $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_liststats on pds_list.id = pds_liststats.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE pds_liststats.page_views>0 AND state='apr' ORDER BY pds_liststats.page_views DESC, firm LIMIT $xlimit,$ylimit;";
                $on_join_string = " pds_list.id";
                $promotion_sql_filter = " ";
                $bread_crumb[0] =  "Popular Businesses";
       }
          
		  break;
		  
	case "connection":
	      $fr_lst=GetMyConnectionList();

		    if (empty($fr_lst)){
		        $connectionsql = ' AND (1=2)';
		    }else{
		        $connectionsql = ' AND (userid IN ('.implode(",",$fr_lst).'))';
		    }

        if ($ispromotion == 1){
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE  state='apr'  $promtionsql  $connectionsql  ORDER BY pds_list_promotions.id DESC, firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " $promtionsql";
            $bread_crumb[0] =  "Promotions By My Connections";
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE  state='apr'  $connectionsql  ORDER BY  firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $bread_crumb[0] =  "Businesses By My Connections";
  		}

		 	break;
	case "group":
        // echo "groupid=$groupid |";
	    $fr_lst=GetMyGroupMemList($groupid);
	    if (empty($fr_lst)){
	        $groupmemsql = ' AND (1=2)';

	    }else{
	        $groupmemsql = ' AND (userid IN ('.implode(",",$fr_lst).'))';

	    }
		 //echo "sql=$sql |$promtionsql | $groupmemsql";
		if ($ispromotion == 1){
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE  state='apr'  $promtionsql  $groupmemsql ORDER BY pds_list_promotions.id DESC, firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " $promtionsql";
            $bread_crumb[0] =  "Promotions By My Groups";
		}else{
            $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE  state='apr' $groupmemsql ORDER BY firm LIMIT $xlimit,$ylimit;";
            $promotion_sql_filter = " ";
            $bread_crumb[0] =  "Businesses By My Groups";
  		}
			break;
			
	case "favorite":
		    if($ispromotion == 1){
                $sql =  "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list_promotions  left outer join pds_list  on pds_list_promotions.list_id = pds_list.id inner join pds_list_favorites  on pds_list_promotions.id = pds_list_favorites.list_id WHERE pds_list_favorites.ispromotion = 1 and pds_list_promotions.end_date>='{$_in_cur_time}') and pds_list_favorites.user_id=".(is_gt_zero_num($_SESSION['guid'])?$_SESSION['guid']:0)." ORDER BY {$sort_on} {$sort_by} LIMIT $xlimit,$ylimit;";
                $promotion_sql_filter = " and pds_list_favorites.user_id=".(is_gt_zero_num($_SESSION['guid'])?$_SESSION['guid']:0);
                $bread_crumb[0] =  "My Saved Promotions";
			}else{
                $sql =  "SELECT SQL_CALC_FOUND_ROWS {$record_fetch_condition} FROM pds_list inner join pds_list_favorites on pds_list.id = pds_list_favorites.list_id WHERE pds_list_favorites.ispromotion = 0 and pds_list_favorites.user_id=".(is_gt_zero_num($_SESSION['guid'])?$_SESSION['guid']:0)." ORDER BY firm LIMIT $xlimit,$ylimit;";
                $promotion_sql_filter = "";
                $bread_crumb[0] =  "My Favorite Businesses";
   			}
         	break;
    
	/*case 'claimed':     
                $sql =  'SELECT SQL_CALC_FOUND_ROWS '.$record_fetch_condition.' FROM pds_list_promotions  left outer join pds_list  on pds_list_promotions.list_id = pds_list.id inner join pds_redim_cupons on pds_list_promotions.id = pds_redim_cupons.promotion_id WHERE pds_list_promotions.end_date>=CURDATE() '.(is_gt_zero_num($cust_sess_id)?' AND cust_sess_id = '.$cust_sess_id.' ':'AND pds_redim_cupons.user_id='.$_SESSION['guid'].' ').' ORDER BY '.$sort_on.' '.$sort_by.' LIMIT '.$xlimit.','.$ylimit.';';
               // and pds_redim_cupons.tabl_id=".$_SESSION['guid']." 
				$promotion_sql_filter = "";
				$bread_crumb[0] =  "Claimed Promotions";
         	break;
         	     	*/
	case "filter":
            $sql_array = @get_intrested_in_sql_array($_SESSION['userid'],$xlimit,$ylimit,$ispromotion,$filter_id);
 		  $bread_crumb[0] =  "My Alerts";

	       if (!empty($sql_array)){
	             $sql = $sql_array['sql'];
	             $promotion_sql_filter = $sql_array['promotion_sql'];
				 //print_r($sql_array['show_filter']);
	             $show_filter = $sql_array['show_filter'];
            }
            
			break;

   case "post":
			$sql_for_history = "SELECT SQL_CALC_FOUND_ROWS  DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id  FROM pds_list_promotions inner join pds_list on pds_list_promotions.list_id = pds_list.id WHERE pds_list.userid='".(is_gt_zero_num($_SESSION['guid'])?$_SESSION['guid']:0)."' ORDER BY pds_list_promotions.id desc  LIMIT $xlimit,$ylimit;";
            $sql = "SELECT SQL_CALC_FOUND_ROWS  DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id  FROM pds_list_promotions inner join pds_list   on pds_list_promotions.list_id = pds_list.id WHERE pds_list_promotions.end_date>='{$_in_cur_time}' AND pds_list.userid='".(is_gt_zero_num($_SESSION['guid'])?$_SESSION['guid']:0)."' ORDER BY pds_list_promotions.id desc LIMIT $xlimit,$ylimit;";

            $bread_crumb[0] =  "My Promotions";
			break;
	case "expired":
		//$sql = "SELECT SQL_CALC_FOUND_ROWS  DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id  FROM pds_list_promotions inner join pds_list   on pds_list_promotions.list_id = pds_list.id WHERE pds_list.userid='".(is_gt_zero_num($_SESSION['guid'])?$_SESSION['guid']:0)."' AND pds_list_promotions.end_date < CURDATE()  ORDER BY {$sort_on} {$sort_by} LIMIT $xlimit,$ylimit;";
		$sql = "SELECT SQL_CALC_FOUND_ROWS  DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id  FROM pds_list_promotions inner join pds_list   on pds_list_promotions.list_id = pds_list.id WHERE pds_list_promotions.prm_restaurent='".(is_gt_zero_num($_SESSION[SES_RESTAURANT])?$_SESSION[SES_RESTAURANT]:0)."' AND pds_list_promotions.end_date < '{$_in_cur_time}'  ORDER BY {$sort_on} {$sort_by} LIMIT $xlimit,$ylimit;";
		$promotion_sql_filter = " AND pds_list_promotions.end_date < '{$_in_cur_time}' ";
			$bread_crumb[0] =  "Expired Promotions";
			break;	
	 case "coupon":
			$sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND pds_list_promotions.end_date>='{$_in_cur_time}' AND pds_list.metro_area =".$vs_user_prof_loc['metroareaid']." AND  cupon_type not in ('none','reward') ORDER BY pds_list_promotions.id DESC, firm LIMIT  $xlimit,$ylimit;";
			//$ispromotion = 2;
            $bread_crumb[0] =  "Coupons";
			break;
			 
   case "reward":
			//$sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT pds_list.* , pds_list_promotions.id as tmp_promo_id FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND pds_list_promotions.end_date>=CURDATE() AND  cupon_type = 'reward' and pds_list.id ={$biz_id} ORDER BY pds_list_promotions.id DESC, firm LIMIT  $xlimit,$ylimit;";
			$sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND cupon_type='reward' $promtionsql ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;"; 
			//$ispromotion = 2;
				  $promotion_sql_filter = " $promtionsql";
          $bread_crumb[0] =  "Promotions";
            //$bread_crumb[0] =  "Coupons";
			break;
    case "quick_search":
            break;
	case "reward_mgmt" :
    	biz_script_forward($CONFIG->wwwroot.'rewards/admin_index.php');
				exit;
			break;
	case "coupon_statistics" : 
		// $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' AND pds_list_promotions.list_id = {$biz_id} $promtionsql ORDER BY $sort_on $sort_by, firm LIMIT $xlimit,$ylimit;"; 
		 
		 $sql = "SELECT SQL_CALC_FOUND_ROWS  {$record_fetch_condition} FROM pds_list inner join pds_list_promotions on pds_list.id = pds_list_promotions.list_id inner join pds_listcat on pds_listcat.list_id = pds_list.id inner join pds_category on pds_category.id = pds_listcat.cat_id WHERE state='apr' $promtionsql ORDER BY $sort_on $sort_by LIMIT $xlimit,$ylimit;"; 
			 
          $promotion_sql_filter = " $promtionsql";
          $bread_crumb[0] =  "Promotions";
		 //biz_script_forward($elgg_site_url.'coupon_statistics.php?isMenulist=1');  
		 //echo "sql=$sql";
		 //exit;
		 
			break;
	case "claimed" :
		 biz_script_forward($elgg_site_url.'coupon_statistics.php?isMenulist=1&isCust=1&userid='.(is_gt_zero_num($_SESSION['guid'])?$_SESSION['guid']:0)); 
		 break;		 
} 
 //echo $sql;
 //exit;
 // die ("Test: ".$sql);
if (is_not_empty($sql)){

$r_list = mysql_query ($sql) or die(mysql_error());
$r1 = mysql_query('SELECT FOUND_ROWS() as total;');

$f1 = mysql_fetch_assoc($r1);
$result_found = $f1['total'];
$map_ids=array();

$ishistory = 0;
if($listing_type == 'expired'){
	$ishistory = -1;	
} 
 
 
if(mysql_num_rows($r_list) > 0){
	//Search Results Found
    //include "sublist_promotion.php";

    $list=getMeListFromRecords($r_list, $ishistory, $promotion_sql_filter,$map_ids); 
 	 
    //...added for showing result on the map
    if(!empty($map_ids)){
       $map_ids=array_unique($map_ids);
       $tpl-> assign('map_ids',implode(",",$map_ids));
    }
    
    if(is_gt_zero_num($_REQUEST['biz_id'])){
       $page_url =   $config['mainurl']."/promotionslisting.php?show_type=$show_type&listing_type=$listing_type&biz_id={$_REQUEST['biz_id']}&fb_recomm_app={$fb_recomm_app}";
    }else{
       $page_url = $config['mainurl']."/promotionslisting.php?show_type=$show_type&listing_type=$listing_type&fb_recomm_app={$fb_recomm_app}";
    }
    
	SmartyPaginate::setURL($page_url);

	SmartyPaginate::setTotal($f1['total']);
	SmartyPaginate::assign($tpl);
    if( !empty($csearch_sql)){
        $rc = mysql_query("SELECT * FROM $pds_category WHERE f_mt = '1' $csearch_sql ORDER BY title;");
      for($x=0;$x<mysql_num_rows($rc);$x++){
         $clist[$x] = mysql_fetch_assoc($rc);
         $clist[$x]['title'] = $language->desc('category',$lang_set,$clist[$x]['id']);
         if($config['rewrite']){
            $mod_id = $clist[$x]['id'];
            $mod_title = str_replace(' ','_',getCatPath($clist[$x]['id']));
            $mod_title = str_replace('/','-',$mod_title);
            $clist[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$clist[$x]['title']."</a>";
         }else{
            $clist[$x]['href'] = "<a href=\"index.php?cat=".$clist[$x]['id']."\">".$clist[$x]['title']."</a>";
         }
      }
    }
}else{
	//No Results Found
          if( !empty($csearch_sql) ){
          $rc = mysql_query("SELECT * FROM $pds_category WHERE f_mt = '1' $csearch_sql ORDER BY title;");
          for($x=0;$x<mysql_num_rows($rc);$x++){
             $clist[$x] = mysql_fetch_assoc($rc);
             $clist[$x]['title'] = $language->desc('category',$lang_set,$clist[$x]['id']);
             if($config['rewrite']){
                $mod_id = $clist[$x]['id'];
                $mod_title = str_replace(' ','_',getCatPath($clist[$x]['id']));
                $mod_title = str_replace('/','-',$mod_title);
                $clist[$x]['href'] = "<a href=\"./$mod_title-$mod_id-0.html\">".$clist[$x]['title']."</a>";
             }else{
                $clist[$x]['href'] = "<a href=\"index.php?cat=".$clist[$x]['id']."\">".$clist[$x]['title']."</a>";
             }
          }
       }
    }
}

 

if (is_not_empty($sql_for_history)){

	$r_list_history = mysql_query ("$sql_for_history;") or die(mysql_error());

    if(mysql_num_rows($r_list_history) > 0){
    	$ishistory = 1;
        $list_history = getMeListFromRecords($r_list_history, $ishistory);
        $list_history = array_unique($list_history);

        $tpl-> assign('list_history_count', count($list_history));
    	$tpl-> assign('list_history', $list_history);
    	$tpl-> assign('ishistory', $ishistory);
    }
}
//***********************************************
// Assign local variables to template
//***********************************************

	include "menu_list.php"; 

	
//$menu_list= array ("All","Recent", "Popular","Connection","Group");
//$menu_list= array ("All", "Popular","Connection","Group");

    /*$tpl-> assign('title_tag', $title_tag);*/
	//print_r($list);
	
    $tpl-> assign('title_tag', $bread_crumb[0]);
    $tpl-> assign('bread_crumb', $bread_crumb);
    $tpl-> assign('btn_link',$btn_link);
    $tpl-> assign('list_count', count($list));
    $tpl-> assign('list',$list);
    $tpl-> assign('listing_type', $listing_type);
    $tpl-> assign('current_states_list',GetStatesByCountry($country));
    $tpl-> assign('show_page','promotionslisting');
    $tpl-> assign('ispromotion',$ispromotion);
    $tpl-> assign('show_type',$show_type);
    $tpl-> assign('is_view',$is_view);
    $tpl-> assign('filters', $filters);
    $tpl-> assign('filter_id',$filter_id);
	$tpl-> assign('new_sort',$new_sort);
	$tpl-> assign('fb_recomm_app', $fb_recomm_app);
	$tpl-> assign('result_found',$result_found);
	$tpl-> assign('page_url',$page_url);
	

    if (is_not_empty($show_filter)){
        $tpl-> assign('show_filter', $show_filter);
    }
    //..added by sangram for country search
    $src_country = (isset($_POST['country'])&&($_POST['country']!="")) ? $_POST['country'] : $vs_user_prof_loc['countryid'];
    $tpl-> assign('current_states_list',GetStatesByCountry($src_country));

	 
//***********************************************
// Display Template
//***********************************************
 if($bread_crumb[0] ==  "Promotions"){
 	/*donothing*/
 }else{
 	$breadcrumbs[] = array('link'=> $config['mainurl']."/promotionslisting.php?show_type=PR","title"=>"Promotions");
 } 
 
 $breadcrumbs[] = array('link'=>$config['mainurl']."/promotionslisting.php?show_type=$show_type&listing_type=$listing_type","title"=>$bread_crumb[0]);
 
 $tpl->assign('breadcrumbs',$breadcrumbs);
 $tpl->assign('active_page','prom_listing');	
 $tpl->assign('is_email_friend',1);
/* 
 if(is_gt_zero_num($ps_restnt)) { 	
 	IncreaseViewCount(0,$ps_restnt);
 }
 */
$is_alert = get_input("is_alert", "0");

if(is_gt_zero_num($is_alert)){

		$activity = get_input("activity", "0");
        if(is_gt_zero_num($activity)){
             $tpl-> display("$config[deftpl]/activity_filter.tpl");
        }else{
             $tpl-> display("$config[deftpl]/alert_filter.tpl");
        }
}else{
    if($fb_recomm_app == 1){
		 $tpl-> display("$config[deftpl]/facebook_promotionlisting.tpl");
	//}elseif($listing_type == 'bizness' || $listing_type == 'reward'){
	}elseif($listing_type == 'bizness'){
    	$tpl-> display("$config[deftpl]/business_promotions.tpl"); 
	}else{
	    $tpl-> display("$config[deftpl]/newpromotionlisting.tpl");
	} 
}  
include('footer.php');
?>