<?php
	include_once dirname(dirname(__FILE__)) . "/engine/start.php";
    global $CONFIG,$SESSION, $curr_user;

    $curr_user = $_SESSION["guid"];



    if(!file_exists("config.php")) {
    	die("[index.php] config.php not found, please rename config.default.php to config.php");
    }else{
        require_once "config.php";
	}

	 $template_id = 0;
	 $post_id = 0;
	if (elgg_is_not_empty($_REQUEST["template_id"])){
		$template_id = $_REQUEST["template_id"];
 	}
	if (elgg_is_not_empty($_REQUEST["post_id"])){
        $post_id = $_REQUEST["post_id"];
	}
	
	if (elgg_is_not_empty($_REQUEST["file_to_strore_pdf"])){
        $file_to_strore_pdf = $_REQUEST["file_to_strore_pdf"];
	}else{
		$file_name = "template_".time();
		$file_to_strore_pdf = dirname(__FILE__)."/pdf/{$file_name}.pdf";
 	}

	/*$page_source = get_template_source($template_id, $post_id);
    include_once("../MPDF53/mpdf.php");
    $mpdf=new mPDF();
    $mpdf->WriteHTML($page_source);
    $file_name = "template_".time();
    $mpdf->Output("$file_to_strore_pdf","F");*/
    
    
    $val = storeTemplatetoFile($template_id, $post_id,$file_to_strore_pdf);
     if ($val){
       echo "<script type=\"text/javascript\"> window.location.href=\"{$CONFIG->wwwroot}templates/pdf/{$file_name}.pdf\"; </script>";
    }else{
      echo "<script>alert(\"Sorry! No pdf Created.\");</script>";
    }

?>
