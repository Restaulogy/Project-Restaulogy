<?php 
include_once(dirname(dirname(__FILE__)).'/init.php');
//include_once('header.php');

		$caller_id= get_input('From','');
		
		//..add to the phone to db
		if(is_not_empty($caller_id)){
			/*$caller_id = str_replace(array('+','-'), '', filter_var($caller_id, FILTER_SANITIZE_NUMBER_INT));
			$objtbl_crm= new tbl_crm(); 
			$isSuccess = $objtbl_crm->create(NULL, NULL, CUST_TYPE_SMS_REG, 1, $caller_id);	
			unset($objtbl_crm);*/
		}				

		// make an associative array of senders we know, indexed by phone number
   /* $people = array(
        "+14158675309"=>"Curious George",
        "+14158675310"=>"Boots",
        "+14158675311"=>"Virgil",
    ); */
    // if the sender is known, then greet them by name
    // otherwise, consider them just another monkey
    /*if(!$name = $people[$_REQUEST['From']]) {
        $name = "Monkey";
    }*/ 
    // now greet the sender
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
?>
<Response>
    <Message>Thanks <?php echo $caller_id;?> for the message! we will reach you as soon as possible.</Message>
</Response>