<?php
//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");
include ("classes/inputfilter.php");
global $CONFIG; 
$filter = new inputFilter($allow_tags,$allow_attr);

//***********************************************
// Include Variable Sets
//***********************************************
//include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************
$tpl-> assign('fav_operation', '');
$cust_login_redirect = get_input('cust_login_redirect',0);

if ( (isset($_GET['show_type'])) && ($_GET['show_type'] == 'PR') ){
	$ispromotion = 1;
}else{
    $ispromotion = 0;
}

// IMP Note : Here list_id is common for
if ( isset($_GET['new']) )
{
	$new = $_GET['new'];
}
else
{
	$new = 0;
}

if ( is_gt_zero_num($_GET['lid']) )
{
    $list_id =$_GET['lid'];
}
else
{
    $list_id =0;
}

if ( is_gt_zero_num($_GET['uid']))
{
    $userid =$_GET['uid'];
}
else
{
    $userid = $curr_user;
}
$count = 0;
 
$customer_name = get_input('customer_name',$_SESSION[SES_CUST_NM]);

if (($list_id != 0) && (is_gt_zero_num($userid) || is_not_empty($customer_name) ))
{
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
    $sql = 'SELECT userid
            FROM  pds_user  u
            INNER JOIN pds_list l ON u.id = l.userid
            where l.id ='.$biz_id;
    $result = mysql_query($sql);
    $vs_my_list = mysql_fetch_assoc($result);
    mysql_free_result($result);
    /*$bus_user_id=$vs_my_list["userid"];*/

    $sel_fr_cat= 'Fan Of';
    $type_of_rel= 'friendrequest_FN';
    $type_of_rel_auto_aprv= 'FanOf';
    $msg_sel_fr_cat= 'Fans';

    global $CONFIG;
    
    if ($new == 1)
	{
  	    $result = mysql_query('Select id from pds_list_favorites where list_id='.$list_id.' and (user_id ='.$userid.' OR customer_name=\''.$customer_name.'\') and ispromotion = '.$ispromotion.'');
  		if ($result)
  		{
	  		$count = mysql_num_rows($result);
  		}

  		if ($count == 0)
  		{
  		    $sql = 'insert into pds_list_favorites
			  		(list_id, user_id,customer_name, created_date, ispromotion)
					   values
					   ('.mysql_real_escape_string($list_id).','.
					     mysql_real_escape_string($userid).',\''.
					     mysql_real_escape_string($customer_name).'\',
						 Now(), '.
						 mysql_real_escape_string($ispromotion).
			 			')' ;
					 
		    mysql_query($sql);
				$_SESSION['disp_msg'] = '<div class="success">Promotion saved Successfully.</div>';
			/*$tpl-> assign('fav_operation', "Your Favorites Added Successfully.");*/
          //redirect_to($_SERVER['HTTP_REFERER'] );
          //$tpl-> assign(fav_comment, "Favorite is Added");
          //$elgg_user_acct_type = getMeAcntType($_SESSION['guid']);
         // if (($elgg_user_acct_type=="business") || ($elgg_user_acct_type=="social/business organization")){
          if($ispromotion==1){
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
                    //system_message(sprintf("You and %s are now connected as $msg_sel_fr_cat", $friend->name));
                  	// add to river
                	//add_to_river('river/object/friendrequest/'.$type_of_rel_auto_aprv,$type_of_rel_auto_aprv,$_SESSION['user']->guid,$bus_user_id);
              }else{
                //..If relationship is alreday there then check if it in coll.
                @add_freind_to_cat($_SESSION['guid'],$bus_user_id,$sel_fr_cat);
              }
          }
		}else{
				$_SESSION['disp_msg'] = '<div class="error">Promotion already saved.</div>';
		}
	} elseif ($new == -1) {
        $sql = 'DELETE FROM pds_list_favorites WHERE list_id='.$list_id.' and (user_id ='.$userid.' OR customer_name=\''.$customer_name.'\') and ispromotion = '.$ispromotion;
        mysql_query($sql);

        //..now remove as fan of as well but check only condition that the post should not be promotion
        //.. For Promotion do not remove from Fan connections.
        if(!$ispromotion){
            if (check_entity_relationship($bus_user_id, 'FanOf', $_SESSION['guid']))      {
	            @remove_entity_relationship($bus_user_id, 'FanOf', $_SESSION['guid']);
	            //..Remove_user_from_access_collection
	            $FN_Col=get_user_access_collections_with_name($_SESSION['guid'],"Fan Of");
	            if ($FN_Col)
	                @remove_user_from_access_collection($bus_user_id, $FN_Col);
	        }
  		}
		$_SESSION['disp_msg'] = '<div class="success">Promotion removed from save.</div>';	
		//$tpl-> assign('fav_operation', "Your Favorites Removed Successfully.");
	}

     $gotMe=strpos($_SERVER['HTTP_REFERER'], "search");
     if(is_gt_zero_num($cust_login_redirect)){
	 	 $trgtPgURL=WWWROOT.'modules/business_listing/promotionslisting.php?show_type=PR&listing_type=all';
	 }else{
	 	 if ($gotMe=== false){
	       if(isset($_SERVER['HTTP_REFERER'])){
	            $trgtPgURL=$_SERVER['HTTP_REFERER'];
	        }else{
	            $trgtPgURL=$CONFIG->wwwroot.'modules/business_listing/promotionslisting.php?show_type='.(((isset($ispromotion))&&($ispromotion==1)) ? 'PR': 'BL');
	        }
	     }else{
	          $trgtPgURL=$_SESSION['SmartyPaginate']['default']['url'];
	     }
	 }
	
     /*$lnk="{$CONFIG->wwwroot}pg/business_listing/main/show_business/{$list_id}";*/
     $lnk = "";
	/***
	* CODE SKIPPED BY INFORESHA.SHRIDHAR@3APR2013
	 if(is_gt_zero_num($bus_user_id)){
	 	 $lnk=get_entity($bus_user_id)->getUrl();
	 } 
     if ((isset($_SESSION["fb_connected"])) && ($_SESSION["fb_connected"]==1)){
		$lnk= getMeFBURL("?redirecturl=$lnk");
		@biz_fb_send_message(get_entity($bus_user_id)->name,$lnk);
     }*/
     biz_script_forward($trgtPgURL);
     //printf("<script>window.location.href='".$_SERVER['HTTP_REFERER']."'</script>");
}
//echo $_SERVER['PHP_SELF'];

//***********************************************
// Edit Promotions
//***********************************************

//***********************************************
// Display Template
//***********************************************

?>
