<?php
//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");
include ("configs/common_vs.php");
include ("classes/pds_redim_cupons.class.php");
global $CONFIG;
$coupon = new pds_redim_cupons();

$biz_msg = new biz_messages(1);
$coupon = new pds_redim_cupons();
$coupon_id = get_input("coupon_id",0);

$info['coupon'] = $coupon->GetInfo($coupon_id);
if(is_not_empty($info['coupon'])){
   $info['promotion']= $info['coupon']['promotion_id'];
}
  $tpl-> assign("info", $info);
  $tpl-> display("$config[deftpl]/user_coupon_code.tpl");

?>


