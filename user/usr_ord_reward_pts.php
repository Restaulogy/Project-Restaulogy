<?php
 
  include_once(dirname(dirname(__FILE__)).'/init.php');
  include_once('header.php');
	
  $active_page = "usr_ord_reward_pts";	
	
  $act_to_do=get_input('act_to_do','');
  $reward_cd=get_input('reward_cd','');
  $phone=get_input('phone','');
  $err="";
  
  //$_SESSION[SES_RESTAURANT]=1;
  if(is_not_empty($reward_cd)){
  	//..get order id from the reward_cd
  	$order_id=base64_decode($reward_cd);
  	$objtbl_orders= new tbl_orders();
	$tbl_ordersinfo= $objtbl_orders->GetInfo($order_id);
	$_SESSION[SES_RESTAURANT]=$tbl_ordersinfo[ORDER_RESTAURANT];
	//print_r($tbl_ordersinfo);
	
	unset($objtbl_orders);	
	/*if($tbl_ordersinfo['order_rewardpts_added']==1){
		$err = "<div class='error'>Points are already added for this order.</div>";
	}*/
  }
  //echo "$act_to_do|$phone";
  //exit;
  if($act_to_do=="ADD_POINTS"){
	if(is_not_empty($phone) && is_not_empty($tbl_ordersinfo)){
		if($tbl_ordersinfo['order_rewardpts_added']==0){
			$user_details=upsert_usr_by_phone($phone);
	
			//...Add reward points for that order 
			$objbiz_checkins=new biz_checkins(); 	
			$isSuccess = $objbiz_checkins->create($tbl_ordersinfo[ORDER_RESTAURANT], 0, $user_details['id'],$tbl_ordersinfo[ORDER_TABLE_ID], $tbl_ordersinfo['gr_amt'], date(DATE_FORMAT),0,$tbl_ordersinfo['gr_amt'],"");
			
			//..Update order with the user and the 
			$res = mysql_query('UPDATE `'.TBL_ORDERS.'` 
								SET `order_customer_type`="LOGIN",
								`order_customer_id`="'.$user_details['id'].'",
								`order_rewardpts_added`=1
								 WHERE `'.ORDER_ID.'` = '.$order_id); 
			if($res){
				$_SESSION[SES_FLASH_MSG] = "<div class='info'>Reward Points Added Successfully.</div>";
			}
		}else{
			$_SESSION[SES_FLASH_MSG] = "<div class='error'>Points are already added for this order.</div>";
		}			
	}else{
		$_SESSION[SES_FLASH_MSG] = "<div class='error'>Reward link is not proper</div>";
	}
  }
      
 $smarty->assign('active_page',$active_page);
 $smarty->assign('phone',$phone);
 $smarty->assign('tbl_ordersinfo',$tbl_ordersinfo); 
 $smarty->assign('reward_cd',$reward_cd);
 
 
 $template = 'usr_ord_reward_pts.tpl';
  
 include('footer.php');  
?>