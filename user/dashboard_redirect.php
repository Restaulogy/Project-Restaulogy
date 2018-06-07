<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');

$frm_qrcd = get_input('frm_qrcd',0);
//..check if table_id is in the query string take that 
$pst_table_id = get_input('table_id',0);

$redirect_to='http://restaulogy.com/test_restaurent_manager';

biz_script_forward($redirect_to.'/user/dashboard.php?table_id='.$frm_qrcd.'&frm_qrcd='.$pst_table_id);

?>