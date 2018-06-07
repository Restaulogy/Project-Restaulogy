<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php";
global $CONFIG;
$curr_user = get_loggedin_userid();
/*********************************************************
*                 CHECKOUT FUNCTIONS 
*********************************************************/
function saveOrder($event_id, $is_pay_at_door = 0)
{	
    global $curr_user,$_POST;
    $orderId       = 0;
	$shippingCost  = 0;

   //...Changes made by sangram for guest user
   //...take first email and name only ..it should be mandatory
   if(!(isset($_SESSION["guid"]))) {
        //..check weather guest user in session details..if he is coming from
        if(isset($_SESSION['guest_usr_email'])){
            $log_usr_name=isset($_POST["rsvp_name1"]) ? $_POST["rsvp_name1"] : "" ;
            $log_usr_state=ucwords($_SESSION['guest_usr_state']) ;
            $log_usr_metro=ucwords($_SESSION['guest_usr_metro']);
            $log_usr_phone="";
            $log_usr_zip="";
            $curr_user=0;
        }
   }else{
        $user=get_entity($curr_user);
        $log_usr_name=ucwords($user->name);;
        $log_usr_state=ucwords($user->user_state);
        $log_usr_metro=ucwords($user->location);
        $log_usr_phone=ucwords($user->phone);
        $log_usr_zip=ucwords($user->zip);
   }
    //extract($_POST);

	// make sure the first character in the 
	// customer and city name are properly upper cased
	$hidPaymentFirstName  = $log_usr_name;
	$hidPaymentLastName   = "";
	$hidShippingCity      = $log_usr_metro;
	$hidPaymentCity       = $log_usr_metro;
	$hidPaymentAddress1   = $log_usr_state.",".$log_usr_metro;
			
    if($_POST['selitems']>0){

        $selitems=$_POST['selitems'];

        if($is_pay_at_door){
           $order_status = "Pay at Door";
        }else{
           $order_status = "New";
        }

        //save order & get order id
        /*
$sql = "INSERT INTO event_ticket_order(od_date, od_last_update, od_payment_first_name, od_payment_last_name, od_payment_address1, od_payment_address2,od_payment_phone, od_payment_state, od_payment_city, od_payment_postal_code,od_buyer_id) VALUES (NOW(), NOW(),'$hidPaymentFirstName', '', '$hidPaymentAddress1','', '".$log_usr_phone."', '".$log_usr_state."', '".$log_usr_metro."', '".$log_usr_zip."', $curr_user)";
*/
        $sql = "INSERT INTO event_ticket_order(od_date, od_last_update, od_payment_first_name, od_payment_last_name, od_payment_address1, od_payment_address2,od_payment_phone, od_payment_state, od_payment_city, od_payment_postal_code,od_buyer_id, od_status) VALUES (NOW(), NOW(),'$hidPaymentFirstName', '', '$hidPaymentAddress1','', '".$log_usr_phone."', '".$log_usr_state."', '".$log_usr_metro."', '".$log_usr_zip."', $curr_user, '".$order_status."' )";
        //echo $sql;
        $result = mysql_query($sql);
        $orderId = mysql_insert_id();

        if ($orderId) {
			// save order items
            for ($i = 0; $i < $selitems; $i++) {
			     //$sql = "INSERT INTO ticket_order_details(od_id, od_ticket_id, od_qty) VALUES ($orderId, ".$_POST["item_id_$i"].", ".$_POST["item_qty_$i"]." )";
			     $sql = "INSERT INTO ticket_order_details(od_id, od_ticket_id, od_qty) select $orderId as orderid , ticket_id , qty from order_stock where event_id = $event_id and user_id = $curr_user and ticket_id = ".$_POST["item_id_$i"];
                //  echo "$sql";
				 $result = mysql_query($sql);
        		/*
    				$sql1 = "Delete from order_stock where event_id = $event_id and user_id = $curr_user and ticket_id = ".$_POST["item_id_$i"];
                    //echo $sql1;
                     mysql_query ($sql1);
        		*/
			}

            if ((isset($is_pay_at_door)) && ($is_pay_at_door == 1)){
            // update product stock only for the
    			for ($i = 0; $i < $selitems; $i++) {
    				$sql = "UPDATE event_tickets
    				        SET quantity = quantity - ".$_POST["item_qty_$i"]."
    						WHERE  ticket_id  = ".$_POST["item_id_$i"];
    					 //	echo $sql ;                 ;
    				$result = mysql_query($sql);
    			}
            }


         }
    }

	return $orderId;
}
/*
get paypal id
*/
function get_my_paypal_id($event_id){
   $op=0;
   $sql="select merchant_id from weekSchedule where ID=$event_id";

   $result = mysql_query($sql);
   if ($result){
      $op= mysql_result($result,0);
   }
   return $op;
}
/*
	Get order total amount ( total purchase + shipping cost )
*/
function getprodname($orderId)
{
    /*
    $prodname = "";
	$sql = "SELECT Product
	        FROM tbl_order
			WHERE od_id = $orderId";
	$result = dbQuery($sql);
    $row = dbFetchRow($result);
    $prodname=$row[0];
	return $prodname;
	*/
}
function getquantity($orderId)
{
	$quantity = 0;
	$sql = "SELECT Qty
	        FROM ticket_order_details o inner join event_tickets t
	        on t.ticket_id=o.od_ticket_id
			WHERE od_id = $orderId";
    $result = @mysql_query($sql);
    if($result){
    		$row = mysql_fetch_row($result);
    		$quantity=$row[0];
    }

	return $quantity;
}

function is_buyer_is_already_have_event($event_id, $buyer){
   $query = "SELECT id FROM weekSchedule WHERE ID=$event_id AND (FIND_IN_SET('$buyer',linkedto) OR FIND_IN_SET('$buyer',organizer_group) OR FIND_IN_SET('$buyer',invited_group) OR user_id = $buyer);";
   $res = @mysql_query($query);
   if(mysql_num_rows($res)>0)
     return true;
   else
     return false;
/*
      $result = mysql_query("select userid, organizer_group, invited_group, linkedto from  weekSchedule where id = ".$event_id);
      $row = mysql_fetch_assoc($result);
      $a1 = array($row['userid']);

      $a2 = explode(",",$row['organizer_group']);
      $a3 = explode(",",$row['invited_group']);
      $a4 = explode(",",$row['linkedto']);

      if(in_array(implode(",", array_merge($a1,$a2,$a3,$a4), $buyer))){
	   	return true;
	  }
    return false;
*/
}

function add_buyer_as_subscriber($event_id, $buyer){
    $sql_qry = "update weekSchedule set linkedto= IF(linkedto IS NULL,".$buyer.",CONCAT(linkedto,',',".$buyer.")) where ID=".$event_id;
    //echo $sql_qry;
    @mysql_query($sql_qry);
}


function get_buyer($order_id){
	if($order_id>0){
		$res = @mysql_query("SELECT `od_buyer_id` FROM `event_ticket_order` where `od_id` = $order_id");
		$res_assoc = mysql_fetch_assoc($res);
		return $res_assoc['od_buyer_id'];
 	}
    return 0;
}

function get_event_id($order_id){
	if($order_id>0){
        $res = @mysql_query("SELECT DISTINCT `event_id`  from `event_tickets` where ticket_id in (SELECT `od_ticket_id` FROM `ticket_order_details` where `od_id` = $order_id)");
		$res_assoc = mysql_fetch_assoc($res);
		return $res_assoc['event_id'];
   }
   return 0;
}


function delete_temp_order_stock($order_id){
    $sql1 = "Delete from order_stock where user_id = (select od_buyer_id  from event_ticket_order where od_id = $order_id) and ticket_id in (select od_ticket_id  from ticket_order_details where od_id = $order_id) ";
    //echo $sql1;
    @mysql_query ($sql1);
}

function make_fair_RSVP($order_id){

    $sql_make_rsvp = "INSERT INTO `rsvp` (`schedule_id`,`createdby`,`addtomycalander`,`name`,`email`,`ticket_id`, `order_id`) Select `schedule_id`,`createdby`, 1 as `addtomycalander`, `name`, `email`,`ticket_id`, $order_id as `order_id` from `temp_rsvp` where `order_id` = $order_id";
    //echo $sql_make_rsvp;
     $res = @mysql_query ($sql_make_rsvp);
     if($res){
        $result = mysql_query("Select  Distinct CONCAT(\"'\",`email`,\"'\") as email from `temp_rsvp` where `order_id` = $order_id");
        if($result){
          $x = 0;
        while ($row = mysql_fetch_assoc($result)){
        	 $rsvp_person[$x] = $row["email"];
        	 $x++;
            }

            if($x>0){
                $event_id = 0;
				$event_id = get_event_id($order_id);
                @add_bulk_mail_to_new_rsvp($rsvp_person , $event_id);
            }
		}
 	}

    $sql_delete_temp_rsvp = "Delete From `temp_rsvp` where `order_id` = $order_id";
    @mysql_query ($sql_delete_temp_rsvp);
}

 function add_bulk_emails_to_subscribing($rsvp_person, $event_id){
    	if(is_array($rsvp_person)){
            $rsvp_person =  array_unique($rsvp_person);
  		}else{
		  	$rsvp_person[0] =  $rsvp_person;
		}
		$sel_user_id_array = array();
		foreach ($rsvp_person as $rsvp_mail){
			$sel_user =  get_user_by_email($rsvp_mail);
        	$sel_user_id  = 0;
    		$sel_user_id = $sel_user[0]['guid'];
    		if($sel_user_id > 0){
                array_push($sel_user_id_array, $sel_user_id);
			}
  		}
  		
  		if((!empty($sel_user_id_array)) && (is_array($sel_user_id_array))){
			$sql_qry = "select linkedto from weekSchedule where ID= $event_id";
			$res = mysql_query($sql_qry);
			$linkedto = array();
			if($res){
                    while ($row = mysql_fetch_assoc($res)) {
    					 	$res_assoc[]["linkedto"] = $row['linkedto'];
					}
					$res_assoc = $res_assoc[0];

					$res_assoc = mysql_fetch_assoc($res);
					$linkedto = explode(",", $res_assoc['linkedto']);
   			}
   			if((!empty($linkedto)) && (is_array($linkedto))){
                $linkedto = array_filter(array_unique(array_merge($sel_user_id_array, $linkedto)));
	  		}else{
                $linkedto = array_filter($sel_user_id_array);
   			}
			if((!empty($linkedto)) && (is_array($linkedto))){

				$sql_qry1 = "update weekSchedule set linkedto='".implode(",",$linkedto)."' where ID=".$event_id;
				$res1 = mysql_query($sql_qry1);
                if($res1){
					return true;
   				}
   			}
		}
  		
   return false;
}


function add_bulk_mail_to_new_rsvp($rsvp_person,$event_id = 0){

    global $CONFIG,$curr_user;
    if((!empty($rsvp_person)) && ($event_id > 0))
    {
		if(is_array($rsvp_person)){
            $rsvp_person =  array_unique($rsvp_person);
            $to =  implode(',',$rsvp_person) ;
  		}else{
		  	$to =  $rsvp_person;
		}
		@add_bulk_emails_to_subscribing($rsvp_person, $event_id);
		
        $event_title = "";
        $event_link_desc = "";
		if($event_id > 0){
			$sql = "Select Distinct title From weekSchedule where ID = $event_id";
			$res = mysql_query($sql);
			if($res){
				$row =	mysql_fetch_assoc($res);
				$event_title = "<b>".$row['title']."</b>";
				$event_link_desc = "<Br>Please click on the link below to view details of the event<Br> <a href=\"{$CONFIG->wwwroot}mod/UniversalCalendar/MockupPlanner/edit_event.php?id={$event_id}\" target=\"_blank\">$event_title</a><br><br>";
   			}
  		}

        $subject = "RSVP for Event ";
        $message = "
            <html>
            <head>
                <title>RSVP Notification</title>
            </head>
            <body>
            Hello <Br>
             You have successfully RSVPed to event $event_title.
             {$event_link_desc}
            Thanks,<Br>
            {$CONFIG->sitename} Team
            </body>
           </html>";

             $headers =  "From: ".$CONFIG->sitename."<".$CONFIG->siteemail."> \r\n".
                    "Reply-To: $from" . "\r\n" .
                    "X-Mailer: PHP/" . phpversion().
                    "MIME-Version: 1.0" . "\r\n".
                    "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	/*	echo "to= $to,\n\n subject =  $subject,\n\n message =   $message,\n\n  headers =   $headers";*/


        $add_prm = "-f{$CONFIG->siteemail}";
        if(@mail($to, $subject, $message, $headers, $add_prm)){
			//echo "yes";
        	return 1;
	   }
	   
    }
  return 0;
}

//Add me to river
function addMeToRiver($uni_cal_event_by,$uni_cal_event_id,$uni_cal_event_title,$uni_cal_event_text, $uni_cal_event_action ="update" ,$uni_cal_member=''){
       //, $uni_cal_adminaction="added"


    global $CONFIG;
    //..First check if the elgg entity is there in Db
    $resultall = mysql_query("SELECT * FROM weekSchedule WHERE ID=$uni_cal_event_id") or die('Query failed: ' . mysql_error());
    $row1 = mysql_fetch_assoc($resultall);
    mysql_free_result($resultall);
    if ($row1["elgg_ent_ass"]){
        //..Found so edit the entity
        //..Update entity code
        // Make sure we actually have permission to edit
    	$sel_event = get_entity($row1["elgg_ent_ass"]);

        if ($sel_event->getSubtype() == "UniversalCalendarEvents") {
            //..Exception for the "Add me to calendar" having linkedto
            if ($row1["linkedto"]){
                //..If he is not the Organizer of the event
                if ($sel_event->owner_guid != $uni_cal_event_by){
                  //..add subscriber the relation
                  @addEntyRelation($sel_event->guid,$uni_cal_event_by);
                  //..add event Organizer the same relation
                  @addEntyRelation($sel_event->guid,$sel_event->owner_guid);
                }

                //..Update to objects table
	            $isOk=update_data("UPDATE {$CONFIG->dbprefix}objects_entity SET title='".(($uni_cal_event_title==null) ? mysql_real_escape_string($row1["title"]) : mysql_real_escape_string($uni_cal_event_title))."', description='".(($uni_cal_event_text==null) ? mysql_real_escape_string($row1["description"]) : mysql_real_escape_string($uni_cal_event_text))."' WHERE guid=".$sel_event->guid);
	            if (!($isOk)) return false;

            } else {

                //..regular event u[pdate]
                // Set its title and description appropriately
        		$sel_event->title = (($uni_cal_event_title==null) ? $row1["title"] : $uni_cal_event_title);
        		$sel_event->description = (($uni_cal_event_text==null) ? $row1["description"] : $uni_cal_event_text);
                // Before we can set metadata, we need to save the entity

                //..Update to objects table
	            $isOk=update_data("UPDATE {$CONFIG->dbprefix}objects_entity SET title='".(($uni_cal_event_title==null) ? mysql_real_escape_string($row1["title"]) : mysql_real_escape_string($uni_cal_event_title))."', description='".(($uni_cal_event_text==null) ? mysql_real_escape_string($row1["description"]) : mysql_real_escape_string($uni_cal_event_text))."' WHERE guid=".$sel_event->guid);
	            if (!($isOk))
				{
				    return false;
				}
				 else{
                    $sel_event = get_entity($sel_event->guid);
				}

/* changed on 1 feb 2011 by shridhar
        		 if (!$sel_event->save()) {

                        return false;

        		}
*/
        		//Save metadata
        		$sel_event->uc_event_type =$row1["type"];
        	    $sel_event->uc_event_groupid =$row1["groupid"];
        	    $sel_event->uc_event_addedby = $row1["addedby"];
				$sel_event->uc_event_admin_list = $row1["organizer_group"];
				$sel_event->uc_event_member = $uni_cal_member;
             //   $sel_event->uc_event_admin_act = $uni_cal_adminaction;


            }


            add_to_river("river/object/UniversalCalendar/$uni_cal_event_action", "$uni_cal_event_action",$uni_cal_event_by, $sel_event->guid);

            //add to the river
           /* if ($uni_cal_event_invited)
            add_to_river('river/object/UniversalCalendar/invited','invited',$uni_cal_event_by, $sel_event->guid);
            else
        	add_to_river('river/object/UniversalCalendar/update','update',$uni_cal_event_by, $sel_event->guid);
        */
            return true;
       }
    }else{
       //..Not found so create the entity
       // the events is by default, only viewed by registered users
        //$access = get_input('access', ACCESS_LOGGED_IN);
        $access = 1;

        $myObject = new ElggObject();
     	$myObject->title = (($uni_cal_event_title==null) ? $row1["title"] : $uni_cal_event_title);
    	$myObject->description = (($uni_cal_event_text==null) ? $row1["description"] : $uni_cal_event_text);
    	$myObject->access_id = 1;
    	$myObject->subtype = "UniversalCalendarEvents";
    	$myObject->uc_event_id =$uni_cal_event_id;

    	$myObject->uc_event_type =$row1["type"];
    	$myObject->uc_event_groupid =$row1["groupid"];
    	$myObject->owner_guid = $uni_cal_event_by;
    	$myObject->uc_event_addedby = $row1["addedby"];

    	// attempting to save the object
    	if (!$myObject->save()) {
    		// if saving was at fault we redirect to an error page
            return false;
    	} else {
    		// add to river
    		add_to_river('river/object/UniversalCalendar/create', 'create',$uni_cal_event_by, $myObject->guid);
    		// Update the event record to add this elgg entity
            $sql = "UPDATE weekSchedule SET elgg_ent_ass=".$myObject->guid." WHERE ID=$uni_cal_event_id;";
            $result = mysql_query($sql);
            if (!$result) {
               return false;
            }

    		return true;
    	}
    }
}


function create_csv_file_for_event_ticket($file,$data)
{
	// the return value
	$success = false;

	//check for array
	if (is_array($data)) {
		$post_values = array_values($data);

		//build csv data
		foreach ($post_values as $i) {
			$csv.="\"$i\",";
		}

		//remove the last comma from string
		$csv = substr($csv,0,-1);

		//check for existence of file
		if(file_exists($file) && is_writeable($file)) {
			$mode="a";
		} else {
			$mode="w";
		}

		//create file pointer
		$fp=@fopen($file,$mode);

		//write to file
		fwrite($fp,$csv . "\n");

		//close file pointer
		fclose($fp);

		$success = true;
	}

	return $success;
}
?>
