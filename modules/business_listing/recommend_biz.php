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

if(is_gt_zero_num($_REQUEST['biz_id'])){
	$ispromotion = 0;
	$biz_id = $_REQUEST['biz_id'];
	$post_id = $biz_id;
	if(is_gt_zero_num($_REQUEST['ispromotion'])){
        $ispromotion = $_REQUEST['ispromotion'];
        if(is_gt_zero_num($_REQUEST['promo_id'])){
            $promo_id = $_REQUEST['promo_id'];
            $post_id = $promo_id;
 		}
    }
	   if(is_gt_zero_num($_SESSION['guid'])){
				@addRecommendation($post_id,$_SESSION['guid'],1,$ispromotion);
   				$bus_user_id = getBizOwnerId($biz_id);
		  }
	 $gotMe=strpos($_SERVER['HTTP_REFERER'], "search");
     if ($gotMe=== false){
       if(isset($_SERVER['HTTP_REFERER'])){
            $trgtPgURL=$_SERVER['HTTP_REFERER'];
        }else{
            $trgtPgURL=$CONFIG->wwwroot."mod/business_listing/business_listing/promotionlisting.php?show_type=BL";
        }
     }else{
          $trgtPgURL=$_SESSION['SmartyPaginate']['default']['url'];
     }
     $lnk="{$CONFIG->wwwroot}pg/business_listing/main/show_business/{$biz_id}";
     if ((isset($_SESSION["fb_connected"])) && ($_SESSION["fb_connected"]==1)){
        biz_fb_send_message(get_entity($bus_user_id)->name,$lnk,1);
     }
     printf("<script>window.location.href='$trgtPgURL'</script>");
}
?>
