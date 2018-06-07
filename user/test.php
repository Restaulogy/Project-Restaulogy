<?php

include_once(dirname(dirname(__FILE__))."/init.php");
/*include_once("header.php");*/

$my_prom_link_new_st= biz_get_tiny_url($website ."/user/short_cd_signup.php?rst=28&srt_cd_ph=7588266377");
$my_prom_link_new_st= biz_get_tiny_url($website ."/user/short_cd_signup.php?rst=28");
echo $my_prom_link_new_st;

exit;

$phone_nos=array('56161');

$msg='REST KARG';

$rest=send_sms_using_twilio($phone_nos,$msg);

if($rest){
 	 echo "send successfull";
}else{
 	 echo "send unsuccesful";
}

exit;

/*
$phone = '7588266377';
$msg = "Congrats, you are member of 'Carrots N Celery'.Free signup offer http://tinyurl.com/y75l9l7y. Check promotion http://tinyurl.com/y7hzzmot.";
/*$chk_slack_url=DB::ExecScalarQry('SELECT `'.SLKUSR_WEBHOOK.'` FROM `'.TBL_SLACK_USERS.'` WHERE `'.SLKUSR_PHONE.'`="'.$phone.'"');*/
//echo send_slack_msg($phone,$msg);

//echo $chk_slack_url;
exit;



$_serv_pth= ALL_REST_APP_PATH;
//echo $_serv_pth .'index.html#MyPromotionPage';
/*echo file_get_contents('http://tinyurl.com/api-create.php?url='.'ALL_REST_APP_PATH .'index.html#MyPromotionPage');*/
echo biz_get_tiny_url(urlencode(ALL_REST_APP_PATH .'index.html#MyPromotionPage'));
//echo "{$_serv_pth}index.html#promotionDetails?restaurent_id=1&promotion_id=166";
//echo biz_get_tiny_url("{$_serv_pth}index.html#promotionDetails?restaurent_id=1&promotion_id=166");



$objbiz_checkins= new biz_checkins();
$cust_id=4973;
for ($i = 1; $i <= 65; $i++) {	
	$isSuccess = $objbiz_checkins->create(23, 0, $cust_id,113, 50, date(DATE_FORMAT),1,500,'','');
	$cust_id=$cust_id+1;
}
unset($objbiz_checkins);
 
echo "succecssfull import of {$i} rec - cust -{$cust_id}";

//$isSuccess = $objbiz_checkins->create($_SESSION[SES_RESTAURANT], 0, $cust_id,$_tbl_id, $chkin_points, date(DATE_FORMAT),$server_validated,$chkin_amount,$chkin_edit_commnt,$chkin_invoice);

//send_sms_using_twilio(array('7588266377'),'JUST FOOD EXPRESS Loyalty code: 12344');
/*send_sms_for_india(array('7588266377'),'Redeem your FREE MOCKTAIL/COCKTAIL/DESSERT here http://tinyurl.com/kghbv9n. As a member you will receive promotions from Atlantis. Unsubscribe:http://tinyurl.com/lkr4vrt');
echo 'sent';*/
exit;

/*
$_new_user_id=get_user(4881);
_short_cd_sign_up('7588266377',$_new_user_id);
exit;

$transport = array(1=>'foot', 2=>'bike', 3=>'car', 4=>'plane');
asort($transport);
print_r($transport);

$mode = current($transport);
echo $mode;
echo '--'.key($transport);

exit;

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
echo getRealIpAddr();
print_r($_SERVER);
*/
//include_once(dirname(dirname(__FILE__)).'/init.php');
//echo base64_encode('restaurant_in_serv');
exit;

/*echo sprintf('%02d', 10);
echo '2016-'.12.'-'.4;
exit;*/

/*$fruits = array(40=>"lemon", 20=>"orange", 50=>"banana", 90=>"apple");
sort($fruits);
print_r($fruits);

exit;



send_sms_using_twilio(array('7588266377'),'JUST FOOD EXPREE Loyalty code: dfrtrt');*/

/*foreach( array( 30, 50, 80 ) as $percent ) { 
        print "Masked Email ($percent%): " 
                .mask_email( 'bobbyjones@gmail.com', '.', $percent )."\n"; 
} */

 
 
 //$phone_nos=array('+917588266377');
/* $phone_nos=array('+16027305620');//.(623) 252-4956 //6024514834
 $msg='Sample twilio api test message..from restaurant app..THIRD TEST!!!';
 $rest=send_sms_using_twilio($phone_nos,$msg);
 if($rest){
 	 echo "send successfull";
 }else{
 		echo "send unsuccesful";
 }*/


/* 
 include("init.php");
 $html_code = '<html><body>';
 $html_code .=  '<link href="'.$website.'/css/biz_data_grid.css" rel="stylesheet"/>';
 $html_code .= table_layout::display(8,5); 
 
 $html_code .="<script type=\"text/javascript\" src=\"{$CONFIG->wwwroot}js/html2canvas.min.js\"></script> <script type=\"text/javascript\">html2canvas([document.getElementByClassName(\"biz_dining_layout\")], {onrendered: function(canvas) {document.body.innerHTML = '<img src=\"'+ canvas.toDataURL(\"image/png\")+ '\"/>' ;}});</script></body></html>"; 
 
 echo $html_code;
 */
 //$size = getimagesize("http://192.168.100.2/restaurent_manager/test/Chicken_65-CONFIRMED.jpg");
 //$futureDate=date('Y-m-d H:i:s', strtotime("+20 year"));
 //$futureDate=date('Y-m-d H:i:s', "1403064837");
 //1403063319, 1403061877,1403062910
 //print_r($futureDate);
 
//date_default_timezone_set('America/Phoenix');
//echo date("Y-m-d H:i:s");
 //echo date('Y-m-d',strtotime("+1 day",strtotime("2014-07-02 00:00:00")));

/*$date1=date_create("2013-03-15 11:03:00");
$date2=date_create("2013-03-18 05:03:00");
$diff=date_diff($date1,$date2);
echo $diff->format("%R%a days");*/

?>