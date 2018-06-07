<?php
//***********************************************
// Include Modules
//***********************************************


include ("modules/modules.php");
$useraction = get_input('action');
//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");
include ("services/functions.php");

if($useraction == "view_promotion"){
    $promo_id = get_input('promo_id');
    echo json_encode(view_promotion($promo_id));
    
}elseif($useraction == "favorite_promotion"){
  $post_id = get_input('post_id');
  $user_id = get_input('user_id',0);
  $show_type = get_input('show_type','PR');
  $new = get_input('new',0);
  $biz_id   = get_input('biz_id',0);
  echo json_encode(favorite_promotion($post_id,$new,$user_id,$show_type,$biz_id));
  
}elseif($useraction == "view_listing"){
  $list_id = get_input('list_id');
  echo json_encode(view_listing($list_id));
}elseif($useraction == "getPromotionListing"){
    $listing_type = get_input('listing_type', 'all');
    $show_type = get_input('show_type' , 'PR');
    $offset = get_input('offset', 0);
    $limit = get_input('limit' , 2);
    $filter_id = get_input('filter_id' , 0); 
    $list = getPromotionListing($listing_type, $show_type,$offset,$limit,$filter_id) ;
    if(!empty($list)){
        echo json_encode($list);
    }else{
        echo json_encode('');
    }
}




?>
