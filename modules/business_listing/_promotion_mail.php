<?php
        $bizname = $sel_user->name;
        $html_mail-> assign("bizname", $bizname);
		$html_mail-> assign("firm", $biztitle);
		$html_mail-> assign("promo_title", $title);
		$html_mail-> assign("promo_end_date", $end_date);
		$html_mail-> assign("listing_link", $listing_link);
		$html_mail-> assign("promotion_link", $promotion_link);
		$html_mail-> assign("BIZNETWORKING_SITE_NAME", $BIZNETWORKING_SITE_NAME);


        if($insert_id > 0){
           //.. InforeshaODC TM 03-02-2011
           //.. Create Elgg Entity and then Add it to activity river
           //..Now add this to river..
    		addPromotionToRiver(get_loggedin_userid(),$insert_id,$title,$comments,$list_id);

			//Send Notification Message
			$mail-> ResetMessage();
			unset($alternative_parts);
			$subject = "Promotion Submitted";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("To",$vs_current_user['usermail'],$vs_current_user['usermail']);
			$mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;


			if( $html_mail-> template_exists($template="mail/promotion_approved_html.tpl") ){
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/promotion_approved_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();

    // send mail
        $acct_type = getMeAcntType($_SESSION['user']->guid) ;
        //... If this is business user then send notification to
        //... to all the fans
         if($acct_type == "business" || $acct_type="social/business organization" ){
          $get_user_list = getMeMyFanOfList($_SESSION['user']->guid);
          if (is_null($get_user_list)) {
              //
          }else{
            $mail-> ResetMessage();
			unset($alternative_parts);
			$subject = "Addition of New Promotion";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			//$mail-> SetEncodedEmailHeader("To",$vs_current_user['usermail'],$vs_current_user['usermail']);
            // $mail-> SetEncodedEmailHeader("To","shridharpatil47@yahoo.in","shridharpatil47@yahoo.in");
            $indexarray = 0;
            $fan_of_listing_string = "";
            foreach ($get_user_list as $value){
                $sel_user = get_user($value['guid']);
                $fan_of_listing_string .= $value['guid'].",";
                if ($indexarray == 0){
                    $mail-> SetEncodedEmailHeader("To",$sel_user->email,$sel_user->email);
                }else{
                    $mail-> SetEncodedEmailHeader("Bcc",$sel_user->email,$sel_user->email);
                }
                $indexarray++;
            }
            $mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;


			if( $html_mail-> template_exists($template="mail/toFan_Promotion_added_html.tpl") ){
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/toFan_Promotion_added_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();
         }
        }

          $get_intr_ppl = get_intrested_people_for_promotion($insert_id);

          if (is_not_empty($get_intr_ppl)) {
            $mail-> ResetMessage();
			unset($alternative_parts);
			$subject = "New Promotion Matching Your Criteria";

			$mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			$mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
			//$mail-> SetEncodedEmailHeader("To",$vs_current_user['usermail'],$vs_current_user['usermail']);
            // $mail-> SetEncodedEmailHeader("To","shridharpatil47@yahoo.in","shridharpatil47@yahoo.in");
             $indexarray = 0;
             $intrested_in_people_string = "";
            foreach ( $get_intr_ppl as  $value){
             $intrested_in_people_string .= $value['guid'].",";

                    $sel_user = get_user($value['guid']);

                if ($indexarray == 0){
                    $mail-> SetEncodedEmailHeader("To",$sel_user->email,$sel_user->email);
                }else{
                    $mail-> SetEncodedEmailHeader("Bcc",$sel_user->email,$sel_user->email);
                 }
                $indexarray++;
                }
            $mail-> SetEncodedHeader("Subject",$subject);
			$mail-> cache_body = false;


			if( $html_mail-> template_exists($template="mail/toIntrested_promotion_adding_html.tpl") ){
				//Set up HTML Message to notify admin of new listing
				$html_message=$html_mail-> fetch("mail/toIntrested_promotion_adding_html.tpl");
				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
				$count_parts = count($alternative_parts);
				$alternative_parts[$count_parts] = $html_part;
			}

			$mail-> AddAlternativeMultipart($alternative_parts);
			$mail-> Send();

            if (is_not_empty($bizname)){
                $frm_biz = " from <b>$bizname</b>";
            }else{
                $frm_biz = "";
            }

			//Notify Send Popup notification
			$intrested_in_people_string = substr($intrested_in_people_string,0,-1);
			if((strlen(trim($intrested_in_people_string)))!=0){
                biz_send_popup_notification("business_listing", "new_promotion_posted", $_SESSION['guid'],$intrested_in_people_string , $listing_link, "You have received a new promotion <a href='$listing_link' >$title</a> $frm_biz");
   			}

   			$fan_of_listing_string = substr($fan_of_listing_string,0,-1);
   			if((strlen(trim($fan_of_listing_string)))!=0){
                biz_send_popup_notification("business_listing", "new_promotion_posted", $_SESSION['guid'],$fan_of_listing_string , $listing_link, "You have received a new promotion <a href='$listing_link' >$title</a> $frm_biz");

   			}
         }
         

         if($cupon_type == "recommendation"){
             $tmp_array = array();
             $list_of_rcmd_people = list_user_survey_biz(getBizOwnerId($list_id));
             $tmp_array = array_diff(explode(",",$get_intr_ppl),explode(",",$list_of_rcmd_people));
             $list_of_rcmd_people  = implode(",",$tmp_array);
             unset($tmp_array);
             
            if (is_not_empty($list_of_rcmd_people)) {
                 $mail-> ResetMessage();
			     unset($alternative_parts);
			     $subject = "New recommendation coupon created";
			     $mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			     $mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
                $indexarray = 0;
                $intrested_in_people_string = "";
                foreach ( $list_of_rcmd_people as  $value){
                    $intrested_in_people_string .= $value['guid'].",";
                    $sel_user = get_user($value['guid']);
                    if ($indexarray == 0){
                        $mail-> SetEncodedEmailHeader("To",$sel_user->email,$sel_user->email);
                    }else{
                        $mail-> SetEncodedEmailHeader("Bcc",$sel_user->email,$sel_user->email);
                    }
                    $indexarray++;
                }
                $mail-> SetEncodedHeader("Subject",$subject);
                $mail-> cache_body = false;
			     if( $html_mail-> template_exists($template="mail/rcmd_promotion_adding_html.tpl") ){
    				$html_message=$html_mail-> fetch("mail/rcmd_promotion_adding_html.tpl");
    				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
    				$count_parts = count($alternative_parts);
    				$alternative_parts[$count_parts] = $html_part;
			     }

			     $mail-> AddAlternativeMultipart($alternative_parts);
			     $mail-> Send();

                if (is_not_empty($bizname)){
                    $frm_biz = " from <b>$bizname</b>";
                }else{
                    $frm_biz = "";
                }

			//Notify Send Popup notification
    			$intrested_in_people_string = substr($intrested_in_people_string,0,-1);
    			if((strlen(trim($intrested_in_people_string)))!=0){
                    biz_send_popup_notification("business_listing", "new_rcmd_coupon_posted", $_SESSION['guid'],$intrested_in_people_string , $listing_link, "You have received a new recommendation coupon <a href='$listing_link' >$title</a> $frm_biz");
       			}
         }
             
             
         }elseif($cupon_type == "survey"){
             $tmp_array = array();
             $list_of_survey_people = list_user_survey_biz(getBizOwnerId($list_id));
             $tmp_array = array_diff(explode(",",$get_intr_ppl),explode(",",$list_of_survey_people));
             $list_of_survey_people  = implode(",",$tmp_array);
             unset($tmp_array);
             
             if (is_not_empty($list_of_survey_people)) {
                 $mail-> ResetMessage();
			     unset($alternative_parts);
			     $subject = "New survey coupon created";
			     $mail-> SetEncodedEmailHeader("From",$config['admin_email'],$config['admin_name']);
			     $mail-> SetEncodedEmailHeader("Reply-To",$config['admin_email'],$config['admin_name']);
                $indexarray = 0;
                $intrested_in_people_string = "";
                foreach ( $list_of_survey_people as  $value){
                    $intrested_in_people_string .= $value['guid'].",";
                    $sel_user = get_user($value['guid']);
                    if ($indexarray == 0){
                        $mail-> SetEncodedEmailHeader("To",$sel_user->email,$sel_user->email);
                    }else{
                        $mail-> SetEncodedEmailHeader("Bcc",$sel_user->email,$sel_user->email);
                    }
                    $indexarray++;
                }
                $mail-> SetEncodedHeader("Subject",$subject);
                $mail-> cache_body = false;
			     if( $html_mail-> template_exists($template="mail/survey_promotion_adding_html.tpl") ){
    				$html_message=$html_mail-> fetch("mail/survey_promotion_adding_html.tpl");
    				$mail-> CreateQuotedPrintableHTMLPart($html_message,"",$html_part);
    				$count_parts = count($alternative_parts);
    				$alternative_parts[$count_parts] = $html_part;
			     }

			     $mail-> AddAlternativeMultipart($alternative_parts);
			     $mail-> Send();

                if (is_not_empty($bizname)){
                    $frm_biz = " from <b>$bizname</b>";
                }else{
                    $frm_biz = "";
                }

			//Notify Send Popup notification
    			$intrested_in_people_string = substr($intrested_in_people_string,0,-1);
    			if((strlen(trim($intrested_in_people_string)))!=0){
                    biz_send_popup_notification("business_listing", "new_rcmd_coupon_posted", $_SESSION['guid'],$intrested_in_people_string , $listing_link, "You have received a new recommendation coupon <a href='$listing_link' >$title</a> $frm_biz");
       			}
            }
         }



         
         

	}

?>
