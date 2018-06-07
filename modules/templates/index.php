<?php
    include_once dirname(dirname(dirname(__FILE__))) . "/init.php";
    global $CONFIG,$SESSION, $curr_user;
    
    $curr_user = $_SESSION["guid"];


    if(!file_exists("config.php")) {
    	die("[index.php] config.php not found, please rename config.default.php to config.php");
    }else{
        require_once "config.php";
	}

	$template_id = 0;
	$post_id = 0;
	$user_msg = "";
	$template_img_src = "";

	if (is_not_empty($_REQUEST["template_id"])){
		$template_id = $_REQUEST["template_id"];
 	}
	if (is_not_empty($_REQUEST["post_id"])){
        $post_id = $_REQUEST["post_id"];
	}
	
	if (is_not_empty($_REQUEST["template_image_id"])){
        $template_image_id = $_REQUEST["template_image_id"];
        $template_img_src = getTemplateImage($template_image_id);
	}

	if (is_not_empty($_REQUEST["user_image_name"])){
        //$template_image = $_REQUEST["template_image"];
        $img_path = "{$CONFIG->path}templates/user_images/{$_REQUEST['user_image_name']}";
        $img_url = "{$CONFIG->wwwroot}templates/user_images/{$_REQUEST['user_image_name']}";
        if(file_exists ($img_path)){
             $template_img_src = $img_url;
 		}

	}
	

	if (is_not_empty($_REQUEST["user_msg"])){
        $user_msg = $_REQUEST["user_msg"];
	}

     $theme = "notheme";
     $html_title = "Page Not Found";
     $info = array();

    if($template_id > 0){

       $info = getTemplateInfo($post_id,$template_id);
	   
	      
	   
     if(!empty($info)){
			$theme_type = $info["template_type"];
			$theme = $info["template_file"];
            $html_title = $info["template_title"];
	   }
       
	}

   // Setup Smarty
	 //..INCLUDE 
		include_once(dirname(dirname(dirname(__FILE__)))."/".CLASS_DIRECTORY."/Smarty/libs/Smarty.class.php");

	 //..define variables
    	define('SMARTY_EXCEPTION_HANDLER',1);
	 //..Initialise
      	$smarty = new Smarty();
      	

 		$smarty->template_dir = APP_PATH . "_templates/{$theme}";
		$smarty->compile_dir = APP_PATH . "_templates/{$theme}/_cache/";
	//.. assign vars
		$smarty->assign ('translations', $translations);
		 
		$theme_lang =  $translations[strtolower($theme_type)];
		$smarty->assign ('theme_lang', $theme_lang);
        $smarty->assign("info",$info);
	 	$smarty->assign("html_title", $html_title);
	 	$smarty->assign("user_msg", $user_msg);
    //.. assign elgg site varialbe
        $elgg_main_url = $website;
        $elgg_site_name = $webtitle;
        $elgg_site_mail = $website;
        //$elgg_site_logo = "{$website}/images/logo.png";
				$elgg_site_logo = $website.'/images/restaurant.png';
		$elgg_theme_url = $website.'/modules/templates/_templates/'.$theme;
		 if(is_not_empty($restinfo)){
 			$elgg_site_name = $restinfo['restaurent_name'];  
 		 }
	
					//print_r($info);exit;
				 //echo $html_title;exit
				//$elgg_site_name = ''
				
        $smarty->assign ('elgg_main_url',$elgg_main_url);
        $smarty->assign ('elgg_site_name',$elgg_site_name);
        $smarty->assign ('elgg_site_mail',$elgg_site_mail);
        $smarty->assign ('elgg_site_logo',$elgg_site_logo);
        $smarty->assign ('elgg_theme_url',$elgg_theme_url);
        $smarty->assign ('ELGG_BLUE',CLR_BLUE);
        $smarty->assign ('ELGG_ORANGE',CLR_ORANGE);
        $smarty->assign ('ELGG_GREEN',CLR_GREEN);
        if (is_not_empty($template_img_src)){
        	$smarty->assign ('template_img_src', $template_img_src);
        }
    //.. asign despaly
		  $template = "index.tpl";
    if (isset($template) && $template != '')
    	$smarty->display($template);
?>

