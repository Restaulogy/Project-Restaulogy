<?php

//***********************************************
// Include Modules
//***********************************************

$ispromotion = 0;

include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

//***********************************************
// Assign Local Variables
//***********************************************


if ((isset($_GET['show_type'])) && ($_GET['show_type']=='PR')){
	$ispromotion = 1;
}

if (isset($_GET["lid"])  && ($_GET["lid"]>0)){
	$lid = $_GET["lid"];
}else{
    $lid = 0;
}
	$promoid  = 0;
if($ispromotion == 1){
	if(is_gt_zero_num($_REQUEST['promoid'])){
		$promoid = $_REQUEST['promoid'];
		$_SESSION[SES_PROMOTION] = $_REQUEST['promoid'];
	}else{
		$promoid = getdefaultlatestActivePromotionId($lid);
	}
}
//..When customer click on the pomotion link from email/sms
//..first show promotion with "use this promotion" link
$prom_crm_id=get_input('prom_crm_id',0);
$use_this_prom=get_input('use_this_prom',0);
$reward_code=get_input('reward_code','');
$email_phone=get_input('email_phone',1);

if(is_gt_zero_num($use_this_prom) && is_not_empty($reward_code) && is_not_empty($email_phone) ){ 
	if(($Global_member['member_role_id'] == ROLE_WAITER || $Global_member['member_role_id'] == ROLE_MANAGER || $Global_member['member_role_id'] == ROLE_ADMIN)){
		$rslt_fnd=1;
	}else{
		$rslt_fnd=validate_server_pin($reward_code);
	}	
	if(is_not_empty($rslt_fnd)){		
		//..Mark as claimed 
		$obj_crm_prom_emails=new crm_prom_emails();				
		$isSuccess=$obj_crm_prom_emails->mark_read($use_this_prom,$email_phone,$promoid);
		unset($obj_crm_prom_emails);
		if($isSuccess==1){
				//..claim successful
				$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['biz_rewards']['info_msg']['claim_success_c'].'</div>';
				//..Unset the prm crm id
				$prom_crm_id=0;
				$use_this_prom=0;				
		}elseif($isSuccess==-1){
				$_SESSION[SES_FLASH_MSG]  = '<div class="success">You already Claimed it.</div>';
		}elseif($isSuccess==-2){
				$_SESSION[SES_FLASH_MSG]  = '<div class="success">Email/phone doesnot match.</div>';
		}else{
				$_SESSION[SES_FLASH_MSG] = '<div class="error">Problem during claiming.</div>';	
		}				
	}else{
		$_SESSION[SES_FLASH_MSG] = "<div class='error'>".$_lang['biz_checkins'][ACTION_CREATE]['CD_DOES_NOT_MATCH']."</div>";
	}	
}
//..Pass teh values to the template
$tpl-> assign('prom_crm_id', $prom_crm_id);
$tpl-> assign('use_this_prom', $use_this_prom);


//..Functionality for the promotion filter emails
$email_val=get_input('email_val','');
$prom_filt_rwd=get_input('prom_filt_rwd',0);
$prom_filt_usr=get_input('prom_filt_usr',0);
$_redeem=get_input('_redeem',0);
$reward_code_1=get_input('reward_code_1','');

if(is_gt_zero_num($prom_filt_rwd) && is_gt_zero_num($prom_filt_usr)){ 
	//..Get the info
	$crm_prom_emails_det=crm_prom_emails::GetInfo($prom_filt_usr);
	$time_since_email_sent=biz_getdaysdiff($crm_prom_emails_det['start_date'],date('Y-m-d'));
	if($time_since_email_sent>30){
			$tpl->assign('prom_filt_expired',1);
	}else{
			$tpl->assign('prom_filt_expired',0);
	}		
}

if(is_gt_zero_num($prom_filt_rwd) && is_gt_zero_num($prom_filt_usr)&& is_not_empty($reward_code_1) && is_not_empty($email_val)){ 
	$rslt_fnd=validate_server_pin($reward_code_1);
	if(is_not_empty($rslt_fnd)){		
		//..Mark as claimed 
		$obj_crm_prom_emails=new crm_prom_emails();				
		$isSuccess=$obj_crm_prom_emails->filt_mark_read($prom_filt_usr,$email_val,$promoid);
		unset($obj_crm_prom_emails);
		if($isSuccess==1){
				//..claim successful
				$_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['biz_rewards']['info_msg']['claim_success_c'].'</div>';
				//..Unset the prm crm id
				$prom_filt_rwd=0;
				$prom_filt_usr=0;				
		}elseif($isSuccess==-1){
				$_SESSION[SES_FLASH_MSG]  = '<div class="success">You already claimed it.</div>';
		}elseif($isSuccess==-2){
				$_SESSION[SES_FLASH_MSG]  = '<div class="success">Email/phone doesnot match.</div>';
		}else{
				$_SESSION[SES_FLASH_MSG] = '<div class="error">Problem during claim promotion.</div>';	
		}				
	}else{
		$_SESSION[SES_FLASH_MSG] = "<div class='error'>".$_lang['biz_checkins'][ACTION_CREATE]['CD_DOES_NOT_MATCH']."</div>";
	}	
 
	/*$_usr_det=get_user($prom_filt_usr);
	if(is_gt_zero_num($_redeem) && is_not_empty($reward_code_1) && is_not_empty($email_val)){
			$rslt_fnd=validate_server_pin($reward_code_1);
			//..Next check weather email or phone matches
			if(
			($_usr_det['email']==$email_val) || 
			 ((is_not_empty($_usr_det['staff_phone'])) && (str_replace(array('+', '-'), '', filter_var($_usr_det['staff_phone'], FILTER_SANITIZE_NUMBER_INT))==str_replace(array('+', '-'), '', filter_var($email_val, FILTER_SANITIZE_NUMBER_INT))))
			){
					if(is_not_empty($rslt_fnd)){	
					//..check if the promotion is already claimed
					$sql='SELECT COUNT(`id`) FROM `pds_redim_cupons` WHERE `user_id`='.$prom_filt_usr.'  AND `promotion_id`='.$promoid;
					$isAlreadythere=DB::ExecScalarQry($sql);
					if(is_gt_zero_num($isAlreadythere)){
							 $_SESSION[SES_FLASH_MSG]  = '<div class="success">You already redeemed it.</div>';	
					}else{
							 //..Actual Redeem process
							$claim_result=customer_claim_promotion($promoid,$prom_filt_usr,$_usr_det['email'],$prom_filt_rwd,$prom_filt_usr,0,0);
							//..success/failure messages
							if($claim_result>0){					 
									 $_SESSION[SES_FLASH_MSG] = '<div class="success">'.$_lang['biz_rewards']['info_msg']['claim_success'].'</div>';
									 $prom_filt_rwd=0;
									 $prom_filt_usr=0;
							}elseif($claim_result==-1){
									 $_SESSION[SES_FLASH_MSG]  = '<div class="success">You already redeemed it.</div>';
							}else{
									 $_SESSION[SES_FLASH_MSG] = '<div class="error">Problem during redeem promotion.</div>';	
							}					
					}	
				}else{
					$_SESSION[SES_FLASH_MSG] = "<div class='error'>".$_lang['biz_checkins'][ACTION_CREATE]['CD_DOES_NOT_MATCH']."</div>";
				}	
					
			}else{
					$_SESSION[SES_FLASH_MSG]  = '<div class="success">Email/phone doesnot match.</div>';
			}
							 
	}*/
	
	//$tpl->assign('prom_filt_email',$_usr_det['email']);
	//$tpl->assign('prom_filt_phone',$_usr_det['staff_phone']);
}
//..Fetch users email			
	$tpl->assign('prom_filt_rwd',$prom_filt_rwd); 
	$tpl->assign('prom_filt_usr',$prom_filt_usr);
//..param to show prcode
$show_pr_code=get_input('show_pr_code',0);

/*if(is_gt_zero_num($_SESSION['userid']) || is_gt_zero_num($_SESSION[SES_TABLE])){*/
if (is_gt_zero_num($promoid)){ 
   //.. for reward section
   /*if(is_gt_zero_num($_REQUEST['rwd'])){
        $rwd = $_REQUEST['rwd'];
        $reward = array();
        //include ($CONFIG->path."rewards/classes/biz_rewards.class.php");
        $obj_reward = new biz_rewards();
        $reward = $obj_reward->GetInfo($rwd); 
        $tpl-> assign('rwd',$rwd);
        $tpl-> assign('reward',$reward);        
  } */

	 //...I think this is the best place to add views count
	 IncreaseViewCount($promoid);

   if(is_gt_zero_num($_REQUEST['isServicePage'])){
        $promotionInfo = get_promotion_info($promoid);		 
   }else{
        $tpl-> assign('promoid',$promoid);
       //.. next will get the passed the info about the promotion
        $showing_promotion = get_promotion_info($promoid);		
			  
		 	  include_once("classes/pds_redim_cupons.class.php");
        $cupon = new pds_redim_cupons();
        $showing_promotion['coupon'] = $cupon->GetInfoByuser_promotion($_SESSION['guid'],$showing_promotion['id']);
				
				$tpl-> assign('showing_promotion', $showing_promotion);
				
		    if ($lid == 0){
		        $lid = getListIdByPromotion($promoid);
		        if(is_gt_zero_num($lid)){
		            $_GET['lid']= $lid;
		            $new_url = str_replace($CONFIG->path, $CONFIG->wwwroot, $_SERVER['SCRIPT_FILENAME'])."?".http_build_query($_GET);
								echo "<script type='text/javascript'>window.location.href = '{$new_url}';</script>"; 
		            //header("Location: {$new_url}");
		        }
		    }
   }
}else{
    //this is regular business deatil view call
    IncreaseViewCount(0,$lid);
}
//..REMIND ME
//if($sesslife){
  $save_remind = get_input("save_remind",0);
	$chk_remind = get_input("chk_remind",'');
	$prem_id = get_input("prem_id");
	$prem_user= get_input("prem_user");
	
	$prem_promotion= $promoid;//get_input("prem_promotion");
	//..for email
	if(is_not_empty($prem_user)){		
		$_SESSION[SES_CUST_NM]=$prem_user;
	}else{
		if(is_not_empty($_SESSION['user'])){
			$prem_user=$_SESSION['user'];
		}elseif(is_not_empty($_SESSION[SES_CUST_NM]) && (isValidEmail($_SESSION[SES_CUST_NM]))){
			$prem_user= $_SESSION[SES_CUST_NM];
		}
	}	
	//..for phone number
	if(is_not_empty($prem_phone)){		
		$_SESSION[SES_CUST_PHN]=$prem_phone;
	}else{
		if(is_not_empty($_SESSION['user'])){
		//$prem_phone= filter_var($Global_member['staff_phone'], FILTER_SANITIZE_NUMBER_INT);
			$prem_phone= str_replace(array('+', '-'), '', filter_var($Global_member['staff_phone'], FILTER_SANITIZE_NUMBER_INT));
		}elseif(is_not_empty($_SESSION[SES_CUST_PHN]) && (is_numeric($_SESSION[SES_CUST_PHN]))){
			$prem_phone= $_SESSION[SES_CUST_PHN];
		}
	}	
	
	//$prem_user= get_input("prem_user");//$_SESSION['guid'];
	$prem_before= get_input("prem_before",0);
	$prem_after= get_input("prem_after",0);
	$prem_spc_date= get_input("prem_spc_date",NULL);
	$prem_act_send_dt= get_input("prem_act_send_dt",NULL);
	$prem_is_send= get_input("prem_is_send",0);
	$prem_start_date= get_input("prem_start_date",NULL);
	$prem_end_date= get_input("prem_end_date",NULL);	
	$prem_phone= get_input("prem_phone",'');
//}

if(is_gt_zero_num($save_remind) && is_not_empty($chk_remind) && (is_not_empty($prem_user) || is_not_empty(prem_phone))){	
	//echo "chk_remind=$chk_remind";
	//print_r($chk_remind);	
	$objtbl_prom_reminder=new tbl_prom_reminder();
	//..calculate the 'prem_act_send_dt'
	if((in_array('BEFORE',$chk_remind)) && (is_gt_zero_num($prem_before))){
		$prem_act_send_dt=date(DATE_FORMAT,strtotime("-{$prem_before} day",strtotime($showing_promotion['end_date'])));
		$prem_spc_date=NULL;
		//echo "chk_remind=$chk_remind| prem_act_send_dt=$prem_act_send_dt |";
	}
	if((in_array('AFTER',$chk_remind))  && (is_gt_zero_num($prem_after))){
		//$prem_act_send_dt=date(DATE_FORMAT,strtotime("+{$prem_after} day",strtotime($showing_promotion['start_date'])));
		$prem_act_send_dt=date(DATE_FORMAT,strtotime("+{$prem_after} day"));
		$prem_spc_date=NULL;
	}	
	if((in_array('ON_DATE',$chk_remind))  && (is_not_empty($prem_spc_date))){
		$prem_act_send_dt=date(DATE_FORMAT,strtotime($prem_spc_date));
	}
	//..Check weather it is insert or edit
	$_ass_remind=array();
	//..BASED ON EMAIL
	if(is_not_empty($prem_user)){
			$_ass_remind= tbl_prom_reminder::readArray(array(PREM_PROMOTION=>$promoid,PREM_USER=>$prem_user));
			if(is_not_empty($_ass_remind)){
				$_ass_remind=array_shift($_ass_remind);
			}
	}elseif(is_not_empty($prem_phone)){
	//..BASED ON PHONE
			//$prem_phone = str_replace(['+', '-'], '', filter_var($prem_phone, FILTER_SANITIZE_NUMBER_INT));
			$prem_phone= str_replace(array('+', '-'), '', filter_var($prem_phone, FILTER_SANITIZE_NUMBER_INT));
			//$prem_phone = filter_var($prem_phone, FILTER_SANITIZE_NUMBER_INT);
			$_ass_remind= tbl_prom_reminder::readArray(array(PREM_PROMOTION=>$promoid,PREM_PHONE=>$prem_phone));
			if(is_not_empty($_ass_remind)){
				$_ass_remind=array_shift($_ass_remind);
			}
	}
	
	//echo "prem_spc_date=$prem_spc_date";
	//exit;
	if(is_not_empty($_ass_remind)){
		//..Update
		$isSuccess = $objtbl_prom_reminder->update($_ass_remind[PREM_ID], $promoid, $prem_user, $prem_before, $prem_after, $prem_spc_date, $prem_act_send_dt, $prem_is_send, $prem_start_date, $prem_end_date,$prem_phone);
		$action='UPDATE';
	}else{
		//..Insert
		//echo "<br>$promoid, $prem_user, $prem_before, $prem_after, $prem_spc_date, $prem_act_send_dt, $prem_is_send, $prem_start_date, $prem_end_date";
		$isSuccess = $objtbl_prom_reminder->create($promoid, $prem_user, $prem_before, $prem_after, $prem_spc_date, $prem_act_send_dt, $prem_is_send, $prem_start_date, $prem_end_date,$prem_phone);		
		$action='CREATE';
	}

	if(is_not_empty($isSuccess)){
		if(is_gt_zero_num($isSuccess)){
			/*//...right place to add it to crm database..
			$objtbl_crm=new tbl_crm();
			$isSuccess =$objtbl_crm->create($crm_cust_id ,$prem_user ,CUST_TYPE_LOGIN ,1);
			unset($objtbl_crm);*/			
			$_SESSION[SES_FLASH_MSG] = "<div class='info'>".$_lang['tbl_prom_reminder'][$action]['SUCCESS_MSG']."</div>";
		}elseif($isSuccess == OPERATION_FAIL){
			$_SESSION[SES_FLASH_MSG] = "<div class='error'>".$_lang['tbl_prom_reminder'][$action]['FAILURE_MSG']."</div>";
		}elseif($isSuccess == OPERATION_DUPLICATE){
			$_SESSION[SES_FLASH_MSG] = "<div class='error'>".$_lang['tbl_prom_reminder'][$action]['DUPLICATE_MSG']."</div>";
		}
	}//..if		
	
	unset($objtbl_prom_reminder);	
}
if(is_not_empty($prem_user)){
	$tbl_prom_reminderinfo= tbl_prom_reminder::readArray(array(PREM_PROMOTION=>$promoid,PREM_USER=>$prem_user));	
}elseif(is_not_empty($prem_phone)){
	$tbl_prom_reminderinfo= tbl_prom_reminder::readArray(array(PREM_PROMOTION=>$promoid,PREM_PHONE=>$prem_phone));
}

if(is_not_empty($tbl_prom_reminderinfo)){
	$tbl_prom_reminderinfo=array_shift($tbl_prom_reminderinfo);
}else{
	$tbl_prom_reminderinfo=array();
}
$tpl->assign('tbl_prom_reminderinfo',$tbl_prom_reminderinfo);

/*}else{
	 $_SESSION[SES_FLASH_MSG] = '<div class="error">Please, First scan the QR code.</div>';
	 biz_script_forward($website.'/user/dashboard.php');
}*/
//..If the it is comming from the voting..
//..changes made by inforeshaODC TM for voting
$msgs = "";

if ((empty($msgs)) && isset($_GET["submit"]) && ($_GET["submit"]=="Submit") && isset($lid) && ($lid>0))
{
    //...Get all values from the posted form
    $title= ((isset($_GET["title"])) && (!empty($_GET["title"]))) ? mysql_real_escape_string($_GET["title"])  : "";
    $question1= ((isset($_GET["question1"])) && (!empty($_GET["question1"])) && ($_GET["question1"]>0)) ? mysql_real_escape_string($_GET["question1"])  : 0;
    $question2= ((isset($_GET["question2"])) && (!empty($_GET["question2"])) && ($_GET["question2"]>0)) ? mysql_real_escape_string($_GET["question2"])  : 0;
    $question3= ((isset($_GET["question3"])) && (!empty($_GET["question3"])) && ($_GET["question3"]>0)) ? mysql_real_escape_string($_GET["question3"])  : 0;
    $question4= ((isset($_GET["question4"])) && (!empty($_GET["question4"])) && ($_GET["question4"]>0)) ? mysql_real_escape_string($_GET["question4"])  : 0;
    $question5= ((isset($_GET["question5"])) && (!empty($_GET["question5"])) && ($_GET["question5"]>0)) ? mysql_real_escape_string($_GET["question5"])  : 0;
    $question6= ((isset($_GET["question6"])) && (!empty($_GET["question6"])) && ($_GET["question6"]>0)) ? mysql_real_escape_string($_GET["question6"])  : 0;
    $question7= ((isset($_GET["question7"])) && (!empty($_GET["question7"])) && ($_GET["question7"]>0)) ? mysql_real_escape_string($_GET["question7"])  : 0;
    

    $comments= ((isset($_GET["comments"])) && (!empty($_GET["comments"]))) ? mysql_real_escape_string($_GET["comments"])  : "";
    if (isAlreadyVoted($lid)) {
       $msgs= "duplicate";
    }
    else{
       //echo "voteForListing(".$lid.",$title,$question1,$question2,$question3,$comments)";
       //exit;
        voteForListing($lid,$title,$question1,$question2,$question3,$question4,$question5,$question6,$question7,$comments);
        $msgs= "sucessfull";
    }
}

$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('show',$lang_set,'title_tag')." | ".$vs_current_listing['firm'];
$bread_crumb[0] = $vs_current_listing['firm'];
$btn_link[0] = "disabled";

$listing_level = $vs_current_listing['level'];

if($vs_current_listing['email']){
	//Listing has an email addy
	$mail_to = $vs_current_listing['email'];
}elseif($vs_current_listing['usermail'] != ""){
	//User has an email addy
	$mail_to = $vs_current_listing['usermail'];
}
//if($vs_current_listing['loc1'] != "" AND $vs_level[$vs_current_listing['level']]['loc1']){
	switch($config['map_site']){
	case 'google':
		//$map_link = "http://www.google.com/maps?q=".str_replace(" ","+",$vs_current_listing['loc1'])."+".$vs_current_listing['zip'];
		$map_link = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($vs_current_listing['address1'])."+".$vs_current_listing['loc1'])."+".$vs_current_listing['zip'];
		break;
	case 'mapquest':
		$map_link = "http://www.mapquest.com/maps/map.adp?address=".str_replace(" ","+",$vs_current_listing['loc1'])."&zipcode=".$vs_current_listing['zip'];
		break;
	}
//}

//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************

//***********************************************
// Code
//***********************************************

mysql_query("UPDATE $pds_liststats SET page_views=page_views+1 WHERE list_id='".$lid."';");

$rating_listid = $lid;
include "rating_part.php";

if(is_gt_zero_num($_REQUEST['isServicePage'])){
    $info = array();
    $info['listing']    = $vs_current_listing;
    $info['promotion']  = $promotionInfo;
    $info['promoid']    = $promoid;
    $info['map_link']   = $map_link;
    //print_r($info);
   echo json_encode($info);
}else{

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('list_logo',$list_logo);
$tpl-> assign('mail_to',$mail_to);
$tpl-> assign('map_link',$map_link);
$tpl-> assign('listing_level',$listing_level);
$tpl-> assign('show_page','show');
//..added by inforeshODC TM for voting
$tpl-> assign('show_msgs',$msgs);
//..Get me the avg rating..
//$tpl-> assign('vote_count',getAvgVote($lid));
$tpl-> assign('vote_count',getAvgVote($vs_current_listing['userid']));

$tpl-> assign('mybackbutton',$_SERVER['HTTP_REFERER']);
$tpl-> assign('stats',$stats);
$tpl-> assign('ispromotion',$ispromotion);



$tpl-> assign('show_pr_code', $show_pr_code);

$tpl-> assign('prem_user', $prem_user);
$tpl-> assign('prem_phone', $prem_phone);

$tpl->assign('is_email_friend',1);

/*$tpl-> assign('promotion_id', $promoid);
$tpl-> assign('prom_list_id', $lid);*/


$breadcrumbs[] = array('link'=> $config['mainurl']."/promotionslisting.php?show_type=PR","title"=>"Promotions");
if(is_not_empty($showing_promotion)){ 
	$breadcrumbs[] = array('link'=> $config['mainurl']."/show.php?show_type=PR&lid={$lid}&promoid={$promoid}","title"=>$showing_promotion["title"]);
} 

$tpl-> assign('breadcrumbs',$breadcrumbs);

if ($_SERVER['HTTP_REFERER'] != $_SERVER['PHP_SELF']){
$tpl-> assign('back_url',$_SERVER['HTTP_REFERER']);
}

if(is_gt_zero_num($_SESSION[SES_RESTAURANT])==FALSE){
	$_SESSION[SES_RESTAURANT]=$showing_promotion["prm_restaurent"];
}
//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/show.tpl");
}
include('footer.php');
?>