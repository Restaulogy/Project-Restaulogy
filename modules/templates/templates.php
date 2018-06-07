<?php
    include_once dirname(dirname(__FILE__)) . "/engine/start.php";
    global $CONFIG,$SESSION, $curr_user;

    $curr_user = $_SESSION["guid"];


    if(!file_exists("config.php")) {
    	die("[index.php] config.php not found, please rename config.default.php to config.php");
    }else{
        require_once "config.php";
	}

    $receiver_id = 0;
    $post_id = 0;
    $template_type = "";
    $post_title = "";
    $user_image_name = "";
    if (elgg_is_not_empty($_REQUEST["post_id"])){
		$post_id = $_REQUEST["post_id"];
    }
    if (elgg_is_not_empty($_REQUEST["post_title"])){
		$post_title = $_REQUEST["post_title"];
 	}
	if (elgg_is_not_empty($_REQUEST["template_type"])){
        $template_type = $_REQUEST["template_type"];
	}
	if (elgg_is_not_empty($_REQUEST["receiver_id"])){
        $receiver_id = $_REQUEST["receiver_id"];
	}
	if (elgg_is_not_empty($_REQUEST["template_id"])){
        $template_id = $_REQUEST["template_id"];
	}

	if  ($_FILES["template_image"]) {
        $user_image_name = template_upload_image($_FILES,"template_image");
    }



   $sender = get_user($curr_user);

   if($receiver_id > 0){
        $receiver = get_user($receiver_id);
        $receiver_mail = $receiver->email;
        $receiver_name = $receiver->name;
   }



if (elgg_is_not_empty($_POST['send'])){
    send_template($template_id, $post_id, $receiver_email, $sender_email);
}


if (elgg_is_not_empty($_POST['preview'])){
   echo get_template_preview($template_id, $post_id, $user_image_name);
}


if (elgg_is_not_empty($_POST['print'])){
   echo get_template_print($template_id, $post_id, $user_image_name);
}



   $templates_info = getMeAllTemplates($template_type);

 // Setup Smarty
	 //..INCLUDE
	    require_once dirname(dirname(__FILE__)) .'/smarty/libs/Smarty.class.php';
	 //..define variables
    	define('SMARTY_EXCEPTION_HANDLER',1);
	 //..Initialise
      	$smarty = new Smarty();
        $smarty->template_dir = APP_PATH . "templates/";
		$smarty->compile_dir = APP_PATH . "templates/_cache/";
	 	$smarty->assign ('translations', $translations);
        $smarty->assign("info",$info);
	 	$smarty->assign("html_title", "Select Templates");

        $elgg_main_url = $CONFIG->wwwroot;
        $elgg_site_name = $CONFIG->name;
			
        $elgg_site_mail = $CONFIG->siteemail;
        $elgg_site_logo = "{$elgg_main_url}mod/custom_white_theme/graphics/biz_logo.png";
        $smarty->assign ('elgg_main_url',$elgg_main_url);
        $smarty->assign ('elgg_site_name',$elgg_site_name);
        $smarty->assign ('elgg_site_mail',$elgg_site_mail);
        $smarty->assign ('elgg_site_logo',$elgg_site_logo);

        $smarty->assign ('templates_info', $templates_info);
        $smarty->assign ('template_id',$template_id);
        $smarty->assign ('receiver_mail', $receiver_mail);
        $smarty->assign ('receiver_name', $receiver_name);
        $smarty->assign ('template_type', $template_type);
        $smarty->assign ('post_title', $post_title);
        $smarty->assign ('post_id',$post_id);
        $smarty->assign ('receiver_id',$receiver_id);
        $smarty->assign ('sender_name', $sender->name);
        $smarty->assign ('sender_email', $sender->email);
        $smarty->assign ('templates_images', getAlldefaultImageslist());

    //.. asign despaly
		  $template = "template.tpl";
    if (isset($template) && $template != '')
    	$smarty->display($template);

?>


