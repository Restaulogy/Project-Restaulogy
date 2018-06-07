<?php
 include_once(dirname(dirname(__FILE__)).'/init.php');	
 
  $count =   tbl_table_customer_session::isPendingCustomerForTables(); 
  echo json_encode($count);
?>