<?php

 echo json_encode("x2");
 include ("modules/modules.php");
include ("classes/inputfilter.php");
$filter = new inputFilter($allow_tags,$allow_attr);
include_once ("classes/email_message.php");
$mail = new email_message_class;
$html_mail = new Smarty;
include_once (dirname(dirname(dirname(dirname(__FILE__))))."/templates/lib/function.php");
//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

?>

