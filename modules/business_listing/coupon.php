<?php
//***********************************************
// Include Modules
//***********************************************
include ('modules/modules.php');
include ('classes/pds_redim_cupons.class.php');

global $CONFIG;
include ('configs/common_vs.php');

/*applyDiscountToOrder('sindbad',322,136);
exit;*/

$biz_msg = new biz_messages(1);
$cupons = new pds_redim_cupons();
$_SESSION['disp_msg'] = '';
//***********************************************
// Include Variable Sets
//***********************************************
//include ('configs/common_vs.php');

//***********************************************
// Assign Local Variables
//***********************************************

$save           	 = get_input('save',0);
$coupon_id      	 = get_input('redim_id',0);
$promotion_id   	 = get_input('promotion_id',0);
$user_id        	 = get_input('user_id',$curr_user);
$customer_name     = get_input('customer_name',$_SESSION[SES_CUST_NM]);
$biz_redimed    	 = get_input('biz_redimed',0);
$user_redimed   	 = get_input('user_redimed',0);
$order_id 			 		= get_input('order_id',0);
$cust_login_redirect = get_input('cust_login_redirect',0);

$prom_code      	 = get_input('prom_code',0);

$choose_order = 0;
$customer_type = CUST_TYPE_LOGIN;
$msg = "";
 
if (is_gt_zero_num($promotion_id) && (is_gt_zero_num($user_id)|| is_not_empty($customer_name)) && is_gt_zero_num($save)){
	 /*if(is_gt_zero_num($_SESSION[SES_CUSTOMER_SESSION])){
	 	$cust_sess_id=$_SESSION[SES_CUSTOMER_SESSION];
	 }else{
	 	$cust_sess_id=tbl_table_customer_session::GetCurrentActiveCustSession($_SESSION[SES_TABLE]);   
	 } */
	 
   //if(is_gt_zero_num($cust_sess_id)){
   if(is_gt_zero_num($_SESSION[SES_TABLE])){	 
	 /*if(is_gt_zero_num($order_id)==false){
	 	$all_orders = tbl_orders::getAllCustSessionOrders($cust_sess_id,1);
	 	$tpl->assign('all_orders',$all_orders); 
		$choose_order = 1;
	 }*/
	 
	 /*if(is_gt_zero_num($order_id) && ($choose_order == 0)){*/	 
	 /*if((is_gt_zero_num($user_id)==false) && (is_not_empty($customer_name))){
	 	$user_id = checkNcreateUserCookieId($customer_name);
		if(is_gt_zero_num($user_id)){
			$customer_type = CUST_TYPE_COOKIE;
			$_SESSION[SES_COOKIE_UID] = $user_id;
		} 		
   }*/	 
	 //..check for the return customer
	 //$return_cust=chk_if_is_return_cust($user_id,$customer_type,$promotion_id);
	 //$id= $cupons->create($user_id,$promotion_id,$cust_sess_id,$customer_name,$customer_type,$prom_code,'','',$return_cust);
	 $obj_crm_prom_emails=new crm_prom_emails();
	 $id=$obj_crm_prom_emails->direct_insert($user_id,$promotion_id,1,date(DATE_FORMAT),date(DATE_FORMAT));
	 
	  if(is_gt_zero_num($id)){
			
			/*$result = mysql_query("Select id from pds_list_favorites where list_id= $promotion_id and user_id =$user_id and ispromotion = 1");
	  	if($result){
		  		$count = mysql_num_rows($result);
	  	}
	  	if($count == 0){
  		    $sql = "insert into pds_list_favorites(list_id, user_id, created_date, ispromotion) values(".mysql_real_escape_string($promotion_id).",".mysql_real_escape_string($user_id).",Now(), 1)" ;
		    	mysql_query($sql);
	    }*/
			$_SESSION[SES_FLASH_MSG]  = '<div class="success">'.$_lang['claim_success'].'.</div>';
			//attachCouponsToOrder($cust_sess_id,$user_id,$customer_type,0,0,$id);
			
			//alertToManager($_SESSION[SES_TABLE],$_SESSION['user'],0,ALERT_CLAIMED_COUPON);
			 /*if(is_gt_zero_num($cust_sess_id)==FALSE){
			 		//.critical messge notify the manger
			 		biz_send_alert($_SESSION[SES_TABLE],$_SESSION[SES_CUST_NM],$id,$_lang['tbl_alerts']['manager'][ALERT_PNDG_CUPON],ALERT_FOR_MANGER,ALERT_PNDG_CUPON);
			 }*/
			 
			//..logic to apply the discount to the ORDER
			//applyDiscountToOrder($_SESSION[SES_CUST_NM],$promotion_id,$cust_sess_id,$id);			
		  /*biz_msg->success("Successfully save coupon.");*/
		}elseif($id == -1){
		 	$_SESSION['disp_msg']  = '<div class="error">You already claimed the '.$_lang['lbl_coupon'].'.</div>';
	        // $biz_msg->notice("You already saved the coupon.");
	     }elseif($id==0){
	     //$biz_msg->error("Problem is occured during saving coupon.");
		 //$_SESSION['disp_msg']  = "<div class='error'>Problem is occured during claiming coupon.</div>";
			 //$_SESSION['disp_msg']  ='<div class="success">Successfully claimed '.$_lang['lbl_coupon'].'.</div>';			 
	  }
	 /*}else{
	 	$biz_msg->error("Please Select Order.");
	 } */	
	}else{
		 $_SESSION['disp_msg']  = '<div class="error">'.$_lang[TBL_ALERTS]['customer'][ALERT_PNDG_CUPON].'</div>';		   
	}	  
}

/*if ((is_gt_zero_num($user_redimed) || is_gt_zero_num($biz_redimed)) && is_gt_zero_num($coupon_id)){
     $id= $cupons->redimCupon($coupon_id,$user_redimed,$biz_redimed,$order_id);		
		  
     if(is_gt_zero_num($id)){
        //$_SESSION['disp_msg'] = "<div class='success'>Successfully redeemed coupon.</div>";
				 $_SESSION['disp_msg']  ='<div class="success">Successfully redeemed '.$_lang['lbl_coupon'].'.</div>';
         //$biz_msg->success("Successfully redeemed coupon.");
		
         if($user_redimed){
            echo "<script>window.open(\"".WWWROOT."modules/business_listing/user_coupon_code.php?coupon_id={$coupon_id}\",\"\",\"width=100%;height=90px;\");</script>";
        }
     }elseif($id == -1){
	 	  //$_SESSION['disp_msg']  = "<div class='error'>You already redeemed the coupon.</div>";
			 $_SESSION['disp_msg']  ='<div class="error">You already redeemed the '.$_lang['lbl_coupon'].'.</div>';
         //$biz_msg->notice("You already redeemed the coupon.");
     }elseif($id == -2){
         //$_SESSION['disp_msg']  = "<div class='error'>Sorry! All coupons are already redeemed.</div>";
				 $_SESSION['disp_msg']  ='<div class="error">Sorry! All '.$_lang['lbl_coupons'].' are already redeemed</div>';
         //$biz_msg->notice("Sorry! All coupons are already redeemed.");
     }elseif($id==0){
	 //$_SESSION['disp_msg']  = "<div class='error'>Problem is occured during redimed coupon.</div>";
	 $_SESSION['disp_msg']  ='<div class="error">Problem is occured during redeeming '.$_lang['lbl_coupon'].'.</div>';
         //$biz_msg->error("Problem is occured during redimed coupon.");
     }
	 
}*/
     $gotMe=strpos($_SERVER['HTTP_REFERER'], "search");
    if(is_gt_zero_num($cust_login_redirect)){
	 	  $trgtPgURL=WWWROOT."modules/business_listing/promotionslisting.php?show_type=PR&listing_type=all"; 
	 }else{ 
	 	if ($gotMe=== false){
	        if(isset($_SERVER['HTTP_REFERER'])){
	            $trgtPgURL=$_SERVER['HTTP_REFERER'];
	        }else{
	            $trgtPgURL=WWWROOT."modules/business_listing/promotionslisting.php?show_type=PR&listing_type=coupon";
	        }
	     }else{
	          $trgtPgURL=$_SESSION['SmartyPaginate']['default']['url'];
	     }
	 
	 
	 } 
 
	$breadcrumbs[] = array('link'=> $config['mainurl']."/promotionslisting.php?show_type=PR","title"=>"Promotions");
	 $tpl-> assign("breadcrumbs",$breadcrumbs); 
	 $tpl-> assign('msg',$msg);
/*if(is_gt_zero_num($choose_order)){ 
	 $tpl-> assign('choose_order',1); 
	 $tpl-> display("$config[deftpl]/coupon.tpl"); 
}elseif($cust_login_redirect){
	  $tpl-> assign('cust_login_redirect',1); 	
	 $tpl-> display("$config[deftpl]/coupon.tpl"); 
}else{*/
	if(is_not_empty($trgtPgURL)){
		echo '<script>window.location.href="'.$trgtPgURL.'";</script>';
	}else{
		echo '<script type="text/javascript"> window.location.href="'.$elgg_site_url.'coupon_statistics.php?isMenulist=1";</script>';
	} 
  	exit;
/*}
 include('footer.php');     
  */
?>
