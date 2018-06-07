<?php 
$menu_list = array();
//print_r($Global_member);
//print_r($_SESSION);

if ($isMobile == 1){
 //echo "isMobile <hr>";
 if($ispromotion == 1){
 //.. All
 if(($_SESSION['guid']==false)||($Global_member['rl_fn_promotion_live'] == 1)){
 	array_push($menu_list,
					array(
                        'display'=>'Now Available',
                        'link'=>'all',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>$translations['promotion']['listing_title'],
                        'icon'=>'grid',
                        'visible'=>1
					));	
					
	 array_push($menu_list,
					array(
                        'display'=>'Forthcoming',
                        'link'=>'forthcoming',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>$translations['promotion']['listing_title'],
                        'icon'=>'heart',
                        'visible'=>1
					));
					
		array_push($menu_list,
					array(
                        'display'=>'Event',
                        'link'=>'is_event',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>$translations['promotion']['listing_title'],
                        'icon'=>'group',
                        'visible'=>1
					));			
					
										
 }		
 //.. Popular
		array_push($menu_list,
					array(
                        'display'=>'Popular',
                        'link'=>'popular',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>$translations['promotion']['menu']['popular'],
                        'icon'=>'star',
                        'visible'=>0
					));
if(is_gt_zero_num($_SESSION['userid']) || is_not_empty($_SESSION[SES_CUST_NM])){

if($elgg_user_acct_type == "business"){
 //if((is_gt_zero_num($_SESSION['member_role_id']))&& ($_SESSION['member_role_id'] == ROLE_ADMIN)){
//if(in_array($Global_member['member_role_id'],array(ROLE_ADMIN,ROLE_OWNER,ROLE_MANAGER,ROLE_SERVER))){
 	//.. Do Nothing
	  array_push($menu_list,
					array( 
                        'display'=>'Claimed',
                        'link'=>'claimed',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>"Claimed Promotions",
                        'icon'=>'badge',
                        'visible'=>0
					));
		
	
 }else{
 
//.. My Favorite
//	if($Global_member['member_role_id'] == ROLE_CUSTOMER){
	array_push($menu_list,
					array( 
                        'display'=>'Saved',
                        'link'=>'favorite',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>$translations['promotion']['menu']['reg_saved'],
                        'icon'=>'save',
                        'visible'=>0
					));
	 
	  
	 array_push($menu_list,
					array( 
                        'display'=>'Claimed',
                        'link'=>'claimed',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>"Claimed Promotions",
                        'icon'=>'badge',
                        'visible'=>0
					));
	 
   } 
 //}
 
//.. Exprired Promotions
if((isset($Global_member['rl_fn_promotion_expired'])) && ($Global_member['rl_fn_promotion_expired'] == 1)){
		array_push($menu_list,
					array( 
                        'display'=>'Exp',
                        'link'=>'expired',
                        'isbusiness'=>1,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'Expired Promotions',
                        'icon'=>'star',
                        'visible'=>1
					));
}
//.. Coupon statistics
		/*array_push($menu_list,
					array( 
                        'display'=>'Stats',
                        'link'=>'coupon_statistics',
                        'isbusiness'=>1,
                        'tpl_file'=>'post-loops_stats.tpl',
                        'heading'=>'Promotions claimed',
                        'icon'=>'bar-chart',
                        'visible'=>1
					));*/
		/*array_push($menu_list,
					array( 
                        'display'=>'Stats',
                        'link'=>'coupon_statistics',
                        'isbusiness'=>1,
                        'tpl_file'=>'coupon_statistics.tpl',
                        'heading'=>'Promotions claimed',
                        'icon'=>'bar-chart',
                        'visible'=>1
					));*/
 
/*
//.. My Filter
		array_push($menu_list,
					array(
                        'display'=>'Alerts',
                        'link'=>'filter',
                        'isbusiness'=>0,
                        'tpl_file'=>'filter.tpl',
                        'heading'=>'My Alerts',
                        'icon'=>'search',
                        'visible'=>1
					));
*/					
  if($isFBConnected==0){
        //.. My Posts
		array_push($menu_list,
					array(
                        'display'=>'Posts',
                        'link'=>'post',
                        'isbusiness'=>1,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'Posted By Me',
                        'icon'=>'user',
                        'visible'=>0
					));
//.. By Connections
		array_push($menu_list,
					array(
                        'display'=>'Network',
                        'link'=>'connection',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'Posted By Connections',
                        'icon'=>'connected',
                        'visible'=>0
					));

//.. By Groups
		array_push($menu_list,
					array(
                        'display'=>'Group',
                        'link'=>'group',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'Posted By Groups',
                        'icon'=>'group',
                        'visible'=>0
					));
    //.. Coupons
		array_push($menu_list,
					array(
                        'display'=>'One time deal',
                        'link'=>'coupon',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>$_lang['lbl_coupons'],
                        'icon'=>'tag',
                        'visible'=>0
					));
		if($Global_member['member_role_id'] == ROLE_MANAGER || $Global_member['member_role_id']==ROLE_EXPEDITOR || $Global_member['member_role_id'] == ROLE_ADMIN || $Global_member['member_role_id'] == ROLE_OWNER || $Global_member['member_role_id'] == ROLE_DEV ){			
	//.. rewards
		array_push($menu_list,
					array(
                        'display'=>'Rewards',
                        'link'=>'reward',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'Rewards',
                        'icon'=>'tag',
                        'visible'=>1
					));
			}		
  } 
}

    }else{


//.. All
		array_push($menu_list,
					array(
                        'display'=>'All',
                        'link'=>'all',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'All Listings',
                        'icon'=>'grid',
                        'visible'=>1
					));
 //.. Popular
  array_push($menu_list,
					array(
                        'display'=>'Popular',
                        'link'=>'popular',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'Popular Listings',
                        'icon'=>'star',
                        'visible'=>0
					));
					
		//.. rewards
		/*	array_push($menu_list,
					array(
                        'display'=>'Rewards',
                        'link'=>'reward_mgmt',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'Rewards',
                        'icon'=>'tag',
                        'visible'=>1
					));	*/					
					
if(is_gt_zero_num($_SESSION['userid']) || is_not_empty($_SESSION[SES_CUST_NM])){
    //.. My Favorite
		array_push($menu_list,
					array(
                        'display'=>'Fav',
                        'link'=>'favorite',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'My Favorite Businesses',
                        'icon'=>'heart',
                        'visible'=>1
					));
    //.. My Filter
		array_push($menu_list,
					array(
                        'display'=>'Alerts',
                        'link'=>'filter',
                        'isbusiness'=>0,
                        'tpl_file'=>'filter.tpl',
                        'heading'=>'My Alerts',
                        'icon'=>'search',
                        'visible'=>1
					));

    //.. By Connections
		array_push($menu_list,
					array(
                        'display'=>'Conn.',
                        'link'=>'connection',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'Listing Posted By Connections',
                        'icon'=>'connected',
                        'visible'=>0
					));

	  //.. By Groups
		array_push($menu_list,
					array(
                        'display'=>'Group',
                        'link'=>'group',
                        'isbusiness'=>0,
                        'tpl_file'=>'post-loops.tpl',
                        'heading'=>'Listing Posted By Groups',
                        'icon'=>'group',
                        'visible'=>0
					));
}
    }
}else{
    if($ispromotion ==2){
        $menu_list[0]['display'] = "All";
        $menu_list[0]['link'] = "all";
        $menu_list[0]['isbusiness'] = 0;

        $menu_list[1]['display'] = "My Saved";
        $menu_list[1]['link'] = "favorite";
        $menu_list[1]['isbusiness'] = 0;
        
        $menu_list[2]['display'] = "Redeem";
        $menu_list[2]['link'] = "redeem";
        $menu_list[2]['isbusiness'] = 0;
        
        $menu_list[3]['display'] = 'My '.$_lang['lbl_coupon'];
        $menu_list[3]['link'] = "post";
        $menu_list[3]['isbusiness'] = 1;

    }elseif($ispromotion ==1 ){

        $menu_list[0]['display'] = "All";
        $menu_list[0]['link'] = "all";
        $menu_list[0]['isbusiness'] = 0;

        $menu_list[1]['display'] = "Popular";
        $menu_list[1]['link'] = "popular";
        $menu_list[1]['isbusiness'] = 0;

        //...changes made by sangram for guest user
        if(is_gt_zero_num($_SESSION['userid']) || is_not_empty($_SESSION[SES_CUST_NM])){
            $menu_list[2]['display'] = "My Saved";
            $menu_list[2]['link'] = "favorite";
            $menu_list[2]['isbusiness'] = 0;

            $menu_list[3]['display'] = "My Alerts";
            $menu_list[3]['link'] = "filter";
            $menu_list[3]['isbusiness'] = 0;

            if($isFBConnected==0){

                $menu_list[4]['display'] = "My Posts";
                $menu_list[4]['link'] = "post";
                $menu_list[4]['isbusiness'] = 1;

                $menu_list[5]['display'] = "By Network";
                $menu_list[5]['link'] = "connection";
                $menu_list[5]['isbusiness'] = 0;

                /*
$menu_list[6]['display'] = "By Groups";
                $menu_list[6]['link'] = "group";
                $menu_list[6]['isbusiness'] = 0;
*/
            $menu_list[6]['display']    = "One time ".$_lang['lbl_coupons'];
            $menu_list[6]['link']       = "coupon";
            $menu_list[6]['isbusiness'] = 0;
            }else{
               $menu_list[4]['display']    = "One time ".$_lang['lbl_coupons'];
                $menu_list[4]['link']       = "coupon";
                $menu_list[4]['isbusiness'] = 0;
            }
            

			/*
			$menu_list[8]['display'] = "Rewards";
        	$menu_list[8]['link'] = "reward_mgmt";
        	$menu_list[8]['isbusiness'] = 1;
			*/
        }
    }else{

        $menu_list[0]['display'] = "All";
        $menu_list[0]['link'] = "all";
        $menu_list[0]['isbusiness'] = 0;

        $menu_list[1]['display'] = "Popular";
        $menu_list[1]['link'] = "popular";
        $menu_list[1]['isbusiness'] = 0;

        if((isset($_SESSION['userid'])) && ($_SESSION['userid']>0)){
            $menu_list[2]['display'] = "My Saved";
            $menu_list[2]['link'] = "favorite";
            $menu_list[2]['isbusiness'] = 0;
            
            $menu_list[3]['display'] = "My Alerts";
            $menu_list[3]['link'] = "filter";
            $menu_list[3]['isbusiness'] = 0;

            $menu_list[4]['display'] = "By Network";
            $menu_list[4]['link'] = "connection";
            $menu_list[4]['isbusiness'] = 0;

/*
 			$menu_list[5]['display'] = "By Groups";
            $menu_list[5]['link'] = "group";
            $menu_list[5]['isbusiness'] = 0;
*/
        }
    }
}

 //print_r($menu_list);
 $totalmenu_visible = 0;
 foreach($menu_list as $key=>$val){
 	$totalmenu_visible = $totalmenu_visible + (($val['visible'] == 1)?1:0);
 }

$tpl-> assign('menu_list',$menu_list);
$tpl-> assign('totalmenu_visible',$totalmenu_visible);
?>