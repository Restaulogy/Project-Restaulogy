<?php
//***********************************************
// Include Modules
//***********************************************
include ("modules/modules.php");
include ("classes/inputfilter.php");
$filter = new inputFilter($allow_tags,$allow_attr);
include_once ("classes/email_message.php");
$mail = new email_message_class;
$html_mail = new Smarty;
include_once (dirname(dirname(__FILE__))."/templates/lib/function.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");
//***********************************************
// Assign Local Variables
//***********************************************
$biz_msg = new biz_messages();

$obj_pds_list_promotions = new pds_list_promotions();

$curr_user = $_SESSION['guid'];
$title_tag = "Business Listing Promotions";
$bread_crumb[0] = "Business Listing Promotions";
$btn_link[0] = "disabled";
$is_save = 0;
$is_preview = 0;
$list_id = 0;
$promotion_id = 0;
$is_save_success = 0;

if ((isset($_GET['id'])) && (($_GET['id'])>0)){
    $list_id =  getListIdByPromotion($_GET['id']);
    $vs_user_profile_list_id =  $list_id;

    $tpl-> assign('vs_user_profile_list_id',$vs_user_profile_list_id);
}else{
    if((isset($vs_user_profile_list_id)) && ($vs_user_profile_list_id>0)){
        $list_id = $vs_user_profile_list_id;
        $tpl-> assign('vs_user_profile_list_id',$vs_user_profile_list_id);
    }else{
      if ((isset($_GET['list_id'])) && (($_GET['list_id'])>0)){
        $list_id =  $_GET['list_id'];
        $vs_user_profile_list_id =  $_GET['list_id'];
        $tpl-> assign('vs_user_profile_list_id',$vs_user_profile_list_id);
      }
    }
}

$active_promo_count = $obj_pds_list_promotions->getActivePromotionsCount($list_id);


if((isset($_GET['view_promotion_id'])) && (($_GET['view_promotion_id'])>0)){
    $view_promotion_id = $_GET['view_promotion_id'];
    $is_view_promotion = 1;
}else{
    $view_promotion_id = 0;
    $is_view_promotion  = 0;
}

if ($curr_user>0)
{

    if($view_promotion_id>0){
        $view_promotion = get_promotion_info($view_promotion_id);
        $tpl-> assign('show_info', 1);
        $tpl->assign('view_promotion',$view_promotion);

    }else{

    if ($list_id>0)
	{
    if(chkUserIsOwner($list_id)){
	if(check_list_have_category($list_id) == 1){
		$sql1=' SELECT
	            firm , address1 , loc1 , states_id , country , zip, logo_ext
	            FROM pds_list where  id='.$list_id;

		 $business_title = mysql_query($sql1);
	     $chk=  mysql_fetch_assoc($business_title);

		 $biztitle= $chk['firm'];
         if((!(is_null($chk['logo_ext'])))&&((strlen(trim($chk['logo_ext'])))!=0)){
            $bizlogo_path = "{$config['mainurl']}/logo/$list_id.".$chk['logo_ext'];
		    $bizlogo= "<img src='$bizlogo_path' width='150' height='150'/>";
         }

		 if ((strlen(trim($chk['address1']))) != 0)
	          $bizaddress = '';
	     else
	          $bizaddress =   $chk['address1'];
	          
	     if ((strlen(trim($chk['loc1']))) != 0)
	          $bizcity = '';
	     else
	          $bizcity =   $chk['address1'];

		 $bizstate= empty($chk['states_id'])?'Arizona': getState_name($chk['states_id']);
		 $bizcountry= empty($chk['country'])?'US':$chk['country'];
	     $bizzip= empty($chk['zip'])?85003:$chk['zip'];

	 	$tpl->assign('listid',$list_id);
		$tpl->assign('biztitle',$biztitle);
		$tpl->assign('operation', '');
		$tpl->assign('op_error', '');

		if (isset($_REQUEST['id'])){
			$id = $_REQUEST['id'];
		}else{
	    	$id = 0;
		}

	if (is_gt_zero_num($_REQUEST['promotion_id'])) {
 		$promotion_id = $_REQUEST['promotion_id'];
	}

	
/// For Deleting Promotion Start ==================================================
 if (( isset($_REQUEST['delete'])) && ($id != 0)) {
	$obj_pds_list_promotions->readObject(array("id"=>$id));
	$elgg_ent_ass = $obj_pds_list_promotions->getelgg_ent_ass();
    if (is_gt_zero_num($elgg_ent_ass)){
  	    add_to_river('river/object/business_listing/delete', 'delete',$curr_user,$elgg_ent_ass);
	}
	$is_deleted = $obj_pds_list_promotions->delete(array("id"=>$id));
	if($is_deleted == 0){
        $tpl->assign('op_error', 'Problem During Deleting Promotion.');
 	}elseif($is_deleted == 1){
        $tpl->assign('operation', 'Promotion Deleted Succesfully.');
        $is_save_success= 1;
  	}
}

/// For Deleting Promotion End ==================================================

/// For Saving Promotion Start ==================================================
if(isset($_POST['preview'])){
	$is_save = 1;
	$is_preview=1;
}
 if ( isset($_POST['save']) ){
 	$is_save = 1;
 }

//-- Start Save Fucntioality
if ($is_save) {
	$PDF_IMG_LOGO = "";
  
    if ($id == 0 || is_gt_zero_num($_REQUEST['is_renew_promotion'])){
        $start_date = $_POST['start_date'];
	    $end_date =  $_POST['end_date'] ;
    }else{
      	$tmp_sql	= 'SELECT * FROM pds_list_promotions where id='.$id;
	 	$tmp_res 	= mysql_query($tmp_sql);
     	$tmp_info 	= mysql_fetch_assoc($tmp_res);
      	$start_date = $tmp_info['start_date'];
      	$end_date 	= $tmp_info['end_date'] ;
      	$pdf 		= $tmp_info['pdf'] ;

		if($tmp_info['img_ext'] <> '0'){
              $PDF_IMG_LOGO = "{$config['mainurl']}/promotion_images/{$id}.{$tmp_info['img_ext']}";
		}
    }
       
    $list_id = $_POST['listid'];
	$title   = string_replace_for_sql($_POST['title']);
	
	//.. For stripping bad tags from the comment
	include_once (dirname(dirname(__FILE__))."/htmlfixer/htmlfixer.class.php");

	$a = new HtmlFixer();
	
	$PDF_comments = $_POST['comments'];
	$comments = $_POST['comments'];
   
    if((isset($_POST['states']))&&((strlen(trim($_POST['states'])))!=0)){
        $states =  $_POST['states'] ;
    }else{
        $states = 0;
    }

	if((isset($_POST['metro_area']))&&((strlen(trim($_POST['metro_area'])))!=0)){
        $metro_area =  $_POST['metro_area'] ;
    }else{
        $metro_area = 0;
    }
        $template_id = 0;
    if(is_not_empty($_POST['template_id'])){
		$template_id = $_POST['template_id'];
	}
	
	
    $cupon_type = "none";
    if(is_not_empty($_POST['cupon_type'])){
		$cupon_type = $_POST['cupon_type'];
	}
	$allowed_cupons = 0;
    if(is_not_empty($_POST['allowed_cupons'])){
		$allowed_cupons = $_POST['allowed_cupons'];
	}
	

    // SQL QUERY OPERATION
	if ($id == 0 || is_gt_zero_num($_REQUEST['is_renew_promotion'])){
 	// FOr Insertion
		if(($active_promo_count < 2)|| ($elgg_chk_gold_user)){

			$insert_id=	$obj_pds_list_promotions->create($list_id,$title,$comments,date("Y-m-d H:i:s",strtotime($start_date)), date("Y-m-d H:i:s",strtotime($end_date)), $states, $metro_area, 0, $cupon_type,$allowed_cupons);
            $PDF_IMG_LOGO = $obj_pds_list_promotions->renewImageFile($id, $insert_id);
    		if($insert_id>0) {
            //...stuff for decreasing subscribe post for subscribe member
                if ($elgg_user_subscription_id && $elgg_remaining_itm_to_post){
                    //..if he has subscription and items remaing then only decrease
                    biz_fn_decrease_item_from_user_subscription('Promotions',$elgg_user_subscription_id);
                }
            }
        $IMAGE_ID = $insert_id;
        $sel_user = get_user($_SESSION['guid']);
       	$listing_link = $CONFIG->wwwroot."pg/business_listing/main/show_promotion/$list_id/".$_SESSION['guid'];
       	$promotion_link = $CONFIG->wwwroot."pg/business_listing/main/show_promotion/$list_id/$IMAGE_ID/".$_SESSION['guid'];
        $new_pdf = 1;

		include "promotion_mail.php";
		$tpl->assign('operation', 'Promotion Created Succesfully');

		if (is_plugin_enabled('CRM')){
				if($isMobile){
                /* $tpl->assign('notice',$biz_msg->notice("<a rel=\"external\" target=\"_blank\" href=\"{$CONFIG->wwwroot}pg/crm/lead/?tbclick=1&type=3\">{$translations['promotion']['publish']['sharewithcrm']}</a>"));*/
	   			}else{
	                $tpl->assign('notice',$biz_msg->notice("<a target=\"_blank\" href=\"{$CONFIG->wwwroot}pg/crm/lead/?tbclick=1&type=3\">{$translations['promotion']['publish']['sharewithcrm']}</a>"));
		  		}
		}
		//..share with facebook link
		$obj_pds_list_promotions->readObject(array("id"=>$insert_id));
    	$elgg_ent_ass = $obj_pds_list_promotions->getelgg_ent_ass();
        if (is_gt_zero_num($elgg_ent_ass)){
            $fb_msg=urlencode("{$biztitle} {$translations['promotion']['publish']['postnewfb']}");
            
            $tpl->assign('fbsharemsg',$biz_msg->notice("<a href=\"{$CONFIG->wwwroot}fb_indx_pg.php?pg_to_show=postfbmsg&post_message={$fb_msg}&post_type=promotion&post_id={$elgg_ent_ass}\" target=\"_blank\">{$translations['promotion']['publish']['sharewithfb']}</a>"));
    	}

        $tpl->assign('is_new_insert', 1);
        $is_save_success = 1;
    }else{
        $tpl->assign('op_error', 'Not Allowed To Create More Than Two Promotions.');
	}
	}else{



	// for updation

        if($obj_pds_list_promotions->readObject(array("id"=>$id))){
            $obj_pds_list_promotions->setid($id);
            $obj_pds_list_promotions->settitle($title);
            $obj_pds_list_promotions->setcomments($comments);
            $obj_pds_list_promotions->setstates($states);
            $obj_pds_list_promotions->setstart_date($obj_pds_list_promotions->getstart_date());
            $obj_pds_list_promotions->setend_date($obj_pds_list_promotions->getend_date());
            $obj_pds_list_promotions->setmetro_area($metro_area);
            $obj_pds_list_promotions->setcupon_type($cupon_type);
            $obj_pds_list_promotions->setallowed_cupons($allowed_cupons);
            $obj_pds_list_promotions->insert();
            $IMAGE_ID = $id;

            if (is_gt_zero_num($obj_pds_list_promotions->getelgg_ent_ass())){
                //..Then update entity and then river
                 try {
               addEditPromotionToRiver($obj_pds_list_promotions->getelgg_ent_ass(),get_loggedin_userid(),$id,$title,$comments,$list_id);
               } catch (Exception $e) {
                   echo 'Caught exception: ',  $e->getMessage(), "\n";
               }
            }else{
                //add elgg entity and then river
                try {
                   $op=addPromotionToRiver(get_loggedin_userid(),$id,$title,$comments,$list_id);
                } catch (Exception $e) {
                   echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            }

            $tpl-> assign('operation', 'Promotion Updated Succesfully');
            $tpl-> assign('is_new_insert', 0);
            $is_save_success = 1;
        }

	}
	//--- SQL QUERY OPERTION COMPLETE

	//--- LOGO UPLOAD
	$error_types = array(
		1=>'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
		'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
		'The uploaded file was only partially uploaded.',
		'No file was uploaded.',
		6=>'Missing a temporary folder.',
		'Failed to write file to disk.',
		'A PHP extension stopped the file upload.'
		);
        $LOGO_NAME = "promo_img";
        $IMAGE_SAVE_SUCCESS = 0;

	  if($_FILES[$LOGO_NAME]) {
		$filesize = $_FILES[$LOGO_NAME]["size"]/1024;
		if ($_FILES[$LOGO_NAME]["error"] > 0){
			   $notice = $error_types[$_FILES['logo']['error']];
	    }elseif( $filesize > 1500){
	             $notice = "<BR>Please, Upload Image File Less Than 1.5 MB<BR>";
		}else{
	        $file_info = getimagesize($_FILES[$LOGO_NAME]['tmp_name']);

    	    switch ($file_info[2]){
        		case 1:
        			$file_ext = "gif";
        			break;
        		case 2:
        			$file_ext = "jpg";
        			break;
        		case 3:
        			$file_ext = "png";
        			break;
        		case 4:
        			$file_ext = "swf";
        			break;
        		default:
        			$file_ext = "";
    		}

			$image_file =  "promotion_images/$IMAGE_ID.$file_ext";
		 	$image_file_path = $config[root]."".$image_file;
		  	if(move_uploaded_file($_FILES[$LOGO_NAME]['tmp_name'], $image_file_path)){
			 	  $IMAGE_SAVE_SUCCESS = 1;
			}else{
		        $IMAGE_SAVE_SUCCESS = 0;
			}
		}
	}
   
 	if ($IMAGE_SAVE_SUCCESS==1){
        $PDF_IMG_LOGO = "{$config['mainurl']}/$image_file";
         @update_promotion_by_field($IMAGE_ID, "img_ext",$file_ext, 1);
 	}elseif(((isset($_POST["use_list_img"])) && ($_POST["use_list_img"]==1)) || ((strlen(trim($PDF_IMG_LOGO)))==0)){
        $PDF_IMG_LOGO = $bizlogo_path;
        @update_promotion_by_field($IMAGE_ID, "img_ext","0", 1);
    }

    if ($IMAGE_SAVE_SUCCESS==1){

    }
  //--- LOGO UPLOAD END

  ///---- Pdf section ///
  $is_pdf_uploaded = 0;
	if(is_gt_zero_num($_REQUEST['is_pdf_uploaded'])){
    }else{
        $pdf = "Promotion_".time().".pdf";
	    $PDF_NAME = "pdf";
        $is_user_pdf = (!empty($_FILES[$PDF_NAME]))? 1 : 0;

      	//-- Upload File
      	 if($is_user_pdf){
            if ($_FILES[$PDF_NAME]["error"] > 0){
             $is_user_pdf = 0;
       	 	}else{
    			$pathinfo = pathinfo($_FILES[$PDF_NAME]["name"]);

    		    if ($pathinfo['extension'] !='pdf') {
    		       $tpl-> assign('op_error', 'Please Upload Only PDF File');
    		   	}else{
    	          	$file_parts = explode(".pdf", $_FILES[$PDF_NAME]["name"]);
    	            if(file_exists($_FILES[$PDF_NAME]["tmp_name"])){
    	                move_uploaded_file($_FILES[$PDF_NAME]["tmp_name"],$config[root]."pdf/" .$pdf);
    	                unlink($_FILES[$PDF_NAME]["tmp_name"]);
    	                $is_user_pdf = 1;
    	            }else{
    	                $tpl-> assign('op_error', 'Please Upload Only PDF File');
    	            }
    		    }
    		}
       	 }
        //$tpl-> assign('op_error', 'Please Upload Only PDF File');
 	    //--promotion pdf
        if($is_user_pdf == 1){
           //.. Upload the pdf
              @update_promotion_by_field($IMAGE_ID, "pdf",$pdf, 1);
              @update_promotion_by_field($IMAGE_ID, "is_pdf_uploaded",1);
         }else{
            //.. Create the pdf
            if (storeTemplatetoFile($template_id, $IMAGE_ID, $config[root]."pdf/$pdf")){
                 @update_promotion_by_field($IMAGE_ID, "pdf",$pdf, 1);
                 @update_promotion_by_field($IMAGE_ID, "is_pdf_uploaded",0);
     		  }
        }
   }



    /*if((strlen(trim($pdf)))!=0){
        @chage_pdf_file($IMAGE_ID, $config[root], $pdf);
  	}*/
}
//--- End Save

	   $check_new = mysql_query('SELECT count(id) FROM pds_list_promotions where list_id='.$list_id);
	   $listcount = mysql_fetch_array($check_new);
		$count = $listcount[0];
		if( $count > 0)
		    {
	          $sql ="SELECT id, DATEDIFF(end_date, NOW()) as DATEDIFF FROM pds_list_promotions where list_id = $list_id " ;

	         $user_promotions = array();
	         $history_promotions = array();
	         
 			$result = mysql_query($sql);
        		for($x=0;$x<mysql_num_rows($result);$x++){
					$row = mysql_fetch_assoc($result);
					if($row['DATEDIFF'] < 0){
                        $history_promotions[$x]= get_promotion_info($row['id']);
						$history_cnt = $history_cnt +1;
					}else{
                        $user_promotions[$user_cnt]= get_promotion_info($row['id']);
						$user_cnt = $user_cnt +1;
					}
		        }
		        $tpl->assign('user_promotions',$user_promotions);
		        $tpl->assign('history_promotions',$history_promotions);
	 		}
        $tpl-> assign('is_incomplete_list', 0);
   	}else{
        $tpl-> assign('is_incomplete_list', 1);
    	$tpl-> assign('title_tag', 'Promotions For '.$biztitle);
	}
       $tpl-> assign('show_info', 1);
       $tpl-> assign('title_tag', 'Promotions For '.$biztitle);
       $tpl-> assign('isowner', $curr_user);
    }else{
        $tpl-> assign('isowner', 0);

    }
	}else{
		$sql = "select Distinct id, firm from pds_list where userid=$curr_user";
		//echo $sql;
		$result = mysql_query($sql);
		   for($x=0;$x<mysql_num_rows($result);$x++){
	           $owner_listing[$x]=mysql_fetch_assoc($result);
	        }
	        $tpl->assign('owner_listing',$owner_listing);
	     	$tpl-> assign('show_info', 0);
	        $tpl-> assign('title_tag', $title_tag);
	}
	
}

}
else
{
     $tpl-> assign('isowner', 0);
     $tpl-> assign('title_tag', $title_tag);
}

if((is_not_empty($_REQUEST['edit']))&& (is_gt_zero_num($id))){

    $tpl-> assign('is_edit_promotion',1);

    $tpl-> assign('promotion',get_promotion_info($id));

}


if((is_not_empty($_REQUEST['renew']))&& (is_gt_zero_num($id))){
    $tpl-> assign('is_renew_promotion',1);
    $tpl-> assign('promotion',get_promotion_info($id));
}

if(is_not_empty($_REQUEST['new'])){
    $tpl-> assign('is_new_promotion',1);
    $tpl-> assign('promotion',array());
    if(is_not_empty($_REQUEST['coupon_type'])){
       $tpl-> assign('coupon_type', $_REQUEST['coupon_type']);
    }else{
       $tpl-> assign('coupon_type', 'none');
    }
}


	//***********************************************
	// Display Template
	//***********************************************
	//...get allowed to post or not
    //...sangram..
	
    @getMeUsrCurrStatus($elgg_user_acct_type,$elgg_user_allow_to_post,$elgg_user_subscription_id,$elgg_remaining_itm_to_post,$tpl);
   
	$tpl-> assign('bread_crumb', $bread_crumb);
	$tpl-> assign('btn_link',$btn_link);
	$tpl-> assign('is_view_promotion',$is_view_promotion);
	$tpl-> assign('is_preview',$is_preview);
	$tpl-> assign('current_preview_id', $IMAGE_ID);
	$tpl-> assign('active_promo_count',$active_promo_count);
	$tpl-> assign('preview_script', get_template_preview_script($template_id,$IMAGE_ID));	
	$tpl-> assign('current_promotion_id',  $promotion_id);
	$tpl-> assign('templates_info', getMeAllTemplates("Promotion"));
	$tpl-> assign('bizlogo_path', $bizlogo_path);
	$tpl-> assign('current_states_list',GetStatesByCountry($bizcountry));
	$tpl->assign('is_save_success', $is_save_success);
	
    if($isMobile){
	   $tpl-> display("$config[deftpl]/promotion.tpl");
    }else{
        $tpl-> display("$config[deftpl]/promotion.tpl");
    }
	
?>