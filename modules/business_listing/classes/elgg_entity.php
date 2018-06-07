<?php
//...Functions to create elgg entity and add to river
//Add me to river
function addPromotionToRiver($biz_Promotion_by,$biz_Promotion_id,$biz_Promotion_title,$biz_Promotion_text,$biz_List_id){

    /*global $CONFIG,$db,$SESSION;
    // the events is by default, only viewed by registered users
    // ..commented since we want it now public
    //$access = get_user_acc_coll_multi_sel_name(array("Business Associates","Employee Of","Fan Of"));
    $access =2;

    $myObject = new ElggObject();
    $myObject->owner_guid = $biz_Promotion_by;
 	$myObject->title = string_replace_for_sql($biz_Promotion_title);
	$myObject->description = $biz_Promotion_text;
	$myObject->access_id = $access;
	$myObject->subtype = "Biz_Promotion";
	$myObject->biz_Promotion_id =$biz_Promotion_id;

	$myObject->biz_List_id =$biz_List_id;

    // attempting to save the object
	if (!$myObject->save()) {
		// if saving was at fault we redirect to an error page
        return false;
	} else {
		// add to river
        add_to_river('river/object/business_listing/create', 'create',$biz_Promotion_by, $myObject->guid);

		// Update the promotion record to add this elgg entity
        $sql = "UPDATE pds_list_promotions SET elgg_ent_ass=".$myObject->guid." WHERE id=$biz_Promotion_id;";
        $result = mysql_query($sql);

        if (!$result) {
           return false;
        }

		return true;
	}*/
	return true;
}

    //Add me to river
function addEditPromotionToRiver($biz_Promotion_elgg_ent_ass,$biz_Promotion_by,$biz_Promotion_id,$biz_Promotion_title,$biz_Promotion_text,$biz_List_id){

    /*global $CONFIG,$db,$SESSION;
    // the events is by default, only viewed by registered users
    //$owner = get_loggedin_userid();

    //..Update entity code
    // Make sure we actually have permission to edit
	$sel_event = get_entity($biz_Promotion_elgg_ent_ass);

    if ($sel_event->getSubtype() == "Biz_Promotion") {
        //..regular event update
        // Set its title and description appropriately
		$sel_event->title = string_replace_for_sql($biz_Promotion_title);
		$sel_event->description = $biz_Promotion_text;
        // Before we can set metadata, we need to save the blog post
		if (!$sel_event->save()) {
            return false;
		}
		//Save metadata
		//$sel_event->biz_List_id =$biz_List_id;

        //add to the river
    	add_to_river('river/object/business_listing/update','update',$biz_Promotion_by, $sel_event->guid);

        return true;
   }
*/
	return true;
}
?>