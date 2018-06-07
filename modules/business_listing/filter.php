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
include_once (dirname(dirname(dirname(dirname(__FILE__))))."/templates/lib/function.php");
//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");
if(is_gt_zero_num($_REQUEST['isServicePage'])){

}else{
   $biz_msg = new biz_messages();
}


//***********************************************
// Assign Local Variables
//***********************************************
$last_pg = $_SERVER['HTTP_REFERER'];
if(is_gt_zero_num($_SESSION['guid'])){


if((isset($_REQUEST['show_type'])) && ($_REQUEST['show_type']=='PR')){
	$show_type = 'PR';
    $isPromotions = 1;
}else{
    $show_type = 'BL';
    $isPromotions = 0;
}

   $msgs = "";

if(is_gt_zero_num($_REQUEST['isServicePage'])){
    $service_msg = "";                                                 
}else{
    if(isset($_REQUEST['isNew'])){
       echo "<script>window.opener.location.reload();</script>";
           $msgs .= $biz_msg->success("Filter Added Successfully.");
    }elseif(isset($_REQUEST['isUpdate'])){
       echo "<script>window.opener.location.reload();</script>";
       $msgs .= $biz_msg->success("Filter Updated Successfully.");
    }
}
$promotion_sql_filter = "";
$show_filter = "";
$filter_id = 0;
$interested_id = 0;
  if(is_gt_zero_num($_REQUEST['filter_id'])){
        $filter_id = $_REQUEST['filter_id'];
  }

  $interested = new InterestedIn($ispromotion, $filter_id );
  
  
  if($_REQUEST['delete'] && is_gt_zero_num($filter_id)){
        if(is_gt_zero_num($_REQUEST['isServicePage'])){
            if($interested->delete($filter_id)){ 
                $service_msg .="<div class='approved'>Filter Deleted Susscefully.</div>"; 
      		}else{
                $service_msg .="<div class='fail'>Problem During deleting Filter</div>";    
    		} 
   		   
            echo json_encode(array("service_msg"=>$service_msg, "id"=>"$filter_id"));
            exit;                                              
        }else{
    		if($interested->delete($filter_id)){ 
                $msgs .=$biz_msg->success("Filter Deleted Susscefully.");
    			/*system_message("Filter Deleted Susscefully.");*/
      		}else{
                $msgs .=$biz_msg->error("Problem During deleting Filter");
                /*register_error("Problem During deleting Filter");*/
    		}

    		echo "<script>window.location.href=\"promotionslisting.php?show_type={$show_type}&listing_type=filter\";</script>";
       }
  }

  if(is_gt_zero_num($interested->getID())){
            $interested_id = $interested->getID();
  			$interested_ppl = $interested->GetInfo();
  			$tpl->assign('interested_ppl',$interested_ppl);
  }


  //.. get All filters list
  $filters = $interested->getAllFilters($isPromotions);
  if(is_gt_zero_num($interested_ppl['isPromotions'])){
    $show_type="PR";
  }

  if($_REQUEST['is_view']){
    	$is_view = $_REQUEST['is_view'];
  }

if (!empty($_POST)){

    if (isset($_POST['filter_save'])){
		$errors = array();
		$data = array();
		if (isset($_POST['country'])) 	{
		  if(is_array($_POST['country'])){
		        $data['country'] = implode(',', $_POST['country']);
		  }else{
		        $data['country'] = $_POST['country'];
		  }
		}else{
		    $data['country'] = '';
		}

		if( (isset($_POST['states'])) && ((strlen(trim($_POST['states'])))!=0)) {
		   $data['states'] = $_POST['states'];
		}else{
		  $data['states'] = 0;
		}

		if( (isset($_POST['metro_area'])) && ((strlen(trim($_POST['metro_area'])))!=0)){
		   $data['metro_area'] = $_POST['metro_area'];
		}else{
		   $data['metro_area'] = 0;
		}
		if( (isset($_POST['categories'])) && ((strlen(trim($_POST['categories'])))!=0)){
		     $data['categories'] = $_POST['categories'];
		}else{
		     $data['categories'] = '';
		}

		if( (isset($_POST['keywords'])) && ((strlen(trim($_POST['keywords'])))!=0)){
		     $data['keywords'] = $_POST['keywords'];
		}else{
		    $data['keywords'] = '';
		}
		if((isset($_POST['business_title'])) && ((strlen(trim($_POST['business_title'])))!=0)){
		    $data['business_title'] = $_POST['business_title'];
		}else{
		    $data['business_title'] = "";
		}

		if( (isset($_POST['title'])) && ((strlen(trim($_POST['title'])))!=0)){
		    $data['title'] = $_POST['title'];

		}else{
		    $data['title'] = "";
		    $errors['title'] = "Please Enter Title";
		}
		
		$data['userid'] = $_SESSION['guid'];

		if(isset($_POST['id'])){
		    $interested_id = $_POST['id'];
		}

	$listing_type = 'filter';
	$is_view = 0;

	$data['isPromotions'] =$isPromotions;
	$chk =$interested->isTitleExist($data['title'], $_SESSION['guid'], $isPromotions,$interested_id);

	switch($chk){
		case 1 : $errors['title'] = "This title is already there.Please, Change the title.";
				 break;
		case 0 : 	if ($interested_id>0){
		              $interested->Edit($data,$interested_id);
		             if(is_gt_zero_num($_REQUEST['isServicePage'])){
		                $service_msg .= "<div class='approved'>Filter Updated Successfully.</div>"; 
		                echo json_encode(array("service_msg"=>$service_msg, "id"=>"$interested_id"));
                             exit; 
                     }else{
                        header("Location: {$CONFIG->wwwroot}mod/business_listing/business_listing/filter.php?filter_id=$interested_id&isUpdate");
                     }
	          			
	          			
				    }else{
                          
				         $new_filter_id = $interested->Create($data);
                      if(is_gt_zero_num($new_filter_id)){
                        if(is_gt_zero_num($_REQUEST['isServicePage'])){
		                $service_msg .= "<div class='approved'>Filter Added Successfully.</div>";      
		                echo json_encode(array("service_msg"=>$service_msg, "id"=>"$new_filter_id"));
                             exit;
                        }else{ 
				            echo "<script type='text/javascript'>window.document.location.href='{$CONFIG->wwwroot}mod/business_listing/business_listing/filter.php?filter_id=$new_filter_id&isNew';</script>"; 
						}
                      }
					}
					break;
		case -1 : $errors['title'] = "Please Enter Title";
				  break;

 	}
  }
}

   if(isset($_REQUEST['isView'])){
		$tpl_file = "filter_view.tpl";
   }else{
        $tpl_file = "filter_form.tpl";
   }
 
	if((is_not_empty($errors))&&(is_array($errors))){
       foreach($errors as $error){
	     if(is_gt_zero_num($_REQUEST['isServicePage'])){
	       $service_msg .=  "<div class='fail'>$error</div>";
	     }else{ 
           $msgs .=  $biz_msg->error($error);
	     }
	  }
 	} 
}else{
  if(is_gt_zero_num($_REQUEST['isServicePage'])){
      $service_msg .= "<div class='fail'>Please login to access this page.</div>"; 
  }else{
   $msgs .= $biz_msg->error("Please login to access this page.");
  }
}

   if(is_gt_zero_num($_REQUEST['isServicePage'])){
    //***********************************************
	// Display Ajax Pages
	//***********************************************
	//...go to ajax services
     //...shridhar
     $info = array();
     if(is_not_empty($filters))
        $info['filters'] = $filters;
     else
        $info['filters'] =NULL;
     $info['filter_id'] = $filter_id;
     $info['current_filter'] = $interested_ppl;
     $info['isView'] = $_REQUEST['isView'];
     $info['show_type'] = $show_type;
     $info['service_msg'] = $service_msg;
      echo json_encode($info);
   }else{
    //***********************************************
	// Display Template
	//***********************************************
	//...get allowed to post or not
    //...sangram..
    $tpl-> assign('msgs',$msgs);
    $tpl-> assign('current_states_list',GetStatesByCountry("US"));
    $tpl-> assign('filters', $filters);
    $tpl-> assign('filter_id',$filter_id);
    $tpl-> assign('show_type',$show_type);
	/*$tpl-> display("$config[deftpl]/mypromotion.tpl");*/
    $tpl-> display("{$config[deftpl]}/{$tpl_file}");
   }


?>
