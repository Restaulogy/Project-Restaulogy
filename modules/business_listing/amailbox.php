<?PHP
/*
Online mail module for
phpDirectorySource ver 1.1
*/

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
$title_tag = $language->desc('site_text',$lang_set,'main_title')." | ".$language->desc('mailbox',$lang_set,'title_tag');
$bread_crumb[0] = $language->desc('mailbox',$lang_set,'breadcrumb');
$btn_link[0] = "disabled";

//Verifying admin logged in
if ( $_SESSION['admin_login'] ){
	$uid = $_SESSION['userid'];
}else{
	header("location:admin.php");
	exit;
}

//Verifying data
$mid = $_GET[mid];
if( isset($_GET[mid]) AND !is_numeric($mid) ){
	die('There was a problem processing this request (message id not numeric)');
}
//***********************************************
// Result set paging
//***********************************************

//***********************************************
// Button Press Logic
//***********************************************
if ($_GET['req'] == 'del'){
	//Removing message
	mysql_query("DELETE FROM $pds_amailbox WHERE id='$mid';");
}

//***********************************************
// Mailbox code
//***********************************************
	switch ($_GET['o']){
	case 1:
		$order = 1;
		$sql_order = 'surfer_from';
		$sort_from = '<b>'.$language->desc('mailbox',$lang_set,'from').'</b>&nbsp;<a href="amailbox.php?req=browse&amp;o=2"><img src="templates/'.$config['deftpl'].'/images/az.png" alt="'.$language->desc('mailbox',$lang_set,'name_asc').'" border="0"></a>';
		$sort_subj = '<b><a href="amailbox.php?req=browse&amp;o=3">'.$language->desc('mailbox',$lang_set,'subject').'</a></b>';
		$sort_date = '<b><a href="amailbox.php?req=browse&amp;o=6">'.$language->desc('mailbox',$lang_set,'date').'</a></b>';
		break;
	case 2:
		$order = 2;
		$sql_order = 'surfer_from DESC';
		$sort_from = '<b>'.$language->desc('mailbox',$lang_set,'from').'</b>&nbsp;<a href="amailbox.php?req=browse&amp;o=1"><img src="templates/'.$config['deftpl'].'/images/za.png" alt="'.$language->desc('mailbox',$lang_set,'name_desc').'" border="0"></a>';
		$sort_subj = '<b><a href="amailbox.php?req=browse&amp;o=3">'.$language->desc('mailbox',$lang_set,'subject').'</a></b>';
		$sort_date = '<b><a href="amailbox.php?req=browse&amp;o=6">'.$language->desc('mailbox',$lang_set,'date').'</a></b>';
		break;
	case 3:
		$order = 3;
		$sql_order = 'subject';
		$sort_from = '<b><a href="amailbox.php?req=browse&amp;o=1">'.$language->desc('mailbox',$lang_set,'from').'</a></b>';
		$sort_subj = '<b>'.$language->desc('mailbox',$lang_set,'subject').'</b>&nbsp;<a href="amailbox.php?req=browse&amp;o=4"><img src="templates/'.$config['deftpl'].'/images/az.png" alt="'.$language->desc('mailbox',$lang_set,'subject_asc').'" border="0"></a>';
		$sort_date = '<b><a href="amailbox.php?req=browse&amp;o=6">'.$language->desc('mailbox',$lang_set,'date').'</a></b>';
		break;
	case 4:
		$order = 4;
		$sql_order = 'subject DESC';
		$sort_from = '<b><a href="amailbox.php?req=browse&amp;o=1">'.$language->desc('mailbox',$lang_set,'from').'</a></b>';
		$sort_subj = '<b>'.$language->desc('mailbox',$lang_set,'subject').'</b>&nbsp;<a href="amailbox.php?req=browse&amp;o=3"><img src="templates/'.$config['deftpl'].'/images/za.png" alt="'.$language->desc('mailbox',$lang_set,'subject_desc').'" border="0"></a>';
		$sort_date = '<b><a href="amailbox.php?req=browse&amp;o=6">'.$language->desc('mailbox',$lang_set,'date').'</a></b>';
		break;
	case 5:
		$order = 5;
		$sql_order = 'date_sent DESC';
		$sort_from = '<b><a href="amailbox.php?req=browse&amp;o=1">'.$language->desc('mailbox',$lang_set,'from').'</a></b>';
		$sort_subj = '<b><a href="amailbox.php?req=browse&amp;o=3">'.$language->desc('mailbox',$lang_set,'subject').'</a></b>';
		$sort_date = '<b>'.$language->desc('mailbox',$lang_set,'date').'</b>&nbsp;<a href="amailbox.php?req=browse&amp;o=6"><img src="templates/'.$config['deftpl'].'/images/az.png" alt="'.$language->desc('mailbox',$lang_set,'date_desc').'" border="0"></a>';
		break;
	default:
		$order = 6;
		$sql_order = 'date_sent';
		$sort_from = '<b><a href="amailbox.php?req=browse&amp;o=1">'.$language->desc('mailbox',$lang_set,'from').'</a></b>';
		$sort_subj = '<b><a href="amailbox.php?req=browse&amp;o=3">'.$language->desc('mailbox',$lang_set,'subject').'</a></b>';
		$sort_date = '<b>'.$language->desc('mailbox',$lang_set,'date').'</b>&nbsp;<a href="amailbox.php?req=browse&amp;o=5"><img src="templates/'.$config['deftpl'].'/images/za.png" alt="'.$language->desc('mailbox',$lang_set,'date_asc').'" border="0"></a>';
	}

	if ($_GET['req'] == 'view'){
		//Viewing full message
		$page = 'view';
		$rf = mysql_query ("SELECT * FROM $pds_amailbox WHERE id='$mid';");
		$count_rf = mysql_num_rows($rf);
		if ($count_rf > 0){
			$message = mysql_fetch_assoc($rf);
			$lid = $message[listing_id];
			$id = $message[id];
			$memberid = $message[member_id];
			$rm = mysql_query("SELECT * FROM $pds_user WHERE id='$memberid'");
			$fm = mysql_fetch_assoc($rm);
			$message['member_login'] = $fm['login'];
			$message['member_email'] = $fm['usermail'];
			mysql_free_result($rm);
			$rm = mysql_query("SELECT firm FROM $pds_list WHERE id='$lid';");
			$fm = mysql_fetch_assoc($rm);
			$message['firmname'] = $fm['firm'];
			mysql_query("UPDATE $pds_amailbox SET msg_read='1' WHERE id='$mid';");
			$message['body'] = stripslashes(nl2br($message['body']));
			$message['subject'] = stripslashes($message['subject']);
		}
	}else{
		$rf = mysql_query ("SELECT *, TO_DAYS(date_sent) AS expire, TO_DAYS(NOW()) AS now FROM $pds_amailbox ORDER BY $sql_order");
		$count_rf = mysql_num_rows($rf);
		if ($count_rf > 0){
			for ($x=0;$x<$count_rf;$x++){
				$list[$x] = mysql_fetch_assoc($rf);
				$id = $list[$x][id];
				$memberid = $list[$x][member_id];
				$rm = mysql_query("SELECT * FROM $pds_user WHERE id='$memberid'");
				$fm = mysql_fetch_assoc($rm);
				$list[$x]['member_login'] = $fm['login'];
				$list[$x]['member_email'] = $fm['usermail'];
				if($_GET['req'] == ''){
					if($list[$x]['remove']){
						mysql_query("DELETE FROM $pds_amailbox WHERE id='$id';");
						$rem_flag = true;
					}else{
						$rem_flag = false;
					}
					if($list[$x][now] - $list[$x][expire] > 30){
						mysql_query("UPDATE $pds_amailbox SET remove='1' WHERE id='$id';");
						$ff['remove'] = 1;
					}
				}
				
				if(!$rem_flag){
					$list[$x]['subject'] = stripslashes($list[$x]['subject']);
					if($list[$x]['spam']){
							$list[$x][mail_type] = '<img src="templates/'.$config['deftpl'].'/images/email_error.png" alt="'.$language->desc('mailbox',$lang_set,'reported').'" border="0">';
					}else{
						if($list[$x]['msg_read']){
							$list[$x][mail_type] = '<img src="templates/'.$config['deftpl'].'/images/email_open.png" alt="'.$language->desc('mailbox',$lang_set,'read').'" border="0">';
						}else{
							$list[$x][mail_type] = '<img src="templates/'.$config['deftpl'].'/images/email.png" alt="'.$language->desc('mailbox',$lang_set,'unread').'" border="0">';
						}
					}
				}
			}
		}
	}

//***********************************************
// Assign local variables to template
//***********************************************
$tpl-> assign('title_tag', $title_tag);
$tpl-> assign('bread_crumb', $bread_crumb);
$tpl-> assign('btn_link',$btn_link);
$tpl-> assign('message',$message);
$tpl-> assign('sort_date',$sort_date);
$tpl-> assign('sort_subj',$sort_subj);
$tpl-> assign('sort_from',$sort_from);
$tpl-> assign('list',$list);
$tpl-> assign('page',$page);
$tpl-> assign('order',$order);
$tpl-> assign('show_page','mailbox');

//***********************************************
// Display Template
//***********************************************
$tpl-> display("$config[deftpl]/amailbox.tpl");

?>