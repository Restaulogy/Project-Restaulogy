<?php

function add_image_url($user_image_name = ""){
	if (is_not_empty($user_image_name)){
		return "&user_image_name=$user_image_name";
	}
 return "";
}
 

function fix_html_source($html_source){
    include_once (dirname(dirname(dirname(__FILE__)))."/htmlfixer/htmlfixer.class.php");
 	$htmlFixer = new HtmlFixer();

  return $htmlFixer->getFixedHtml($html_source);
}

function template_upload_image($vFile, $LOGO_NAME){

	global $CONFIG;
	$_FILES = $vFile;
	$error_types = array(
		1=>'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
		'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
		'The uploaded file was only partially uploaded.',
		'No file was uploaded.',
		6=>'Missing a temporary folder.',
		'Failed to write file to disk.',
		'A PHP extension stopped the file upload.'
		);
 $user_image_name = "";
 $notice = "";
		$filesize = $_FILES[$LOGO_NAME]["size"]/1024;
		if ($_FILES[$LOGO_NAME]["error"] > 0){
			   $notice = $error_types[$_FILES[$LOGO_NAME]['error']];
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
        		default:
        			$file_ext = "";
    		}
			$file_name = "img_".time().".".$file_ext;
			$image_file_path =  $CONFIG->path."/modules/templates/user_images/$file_name";
		  	if(move_uploaded_file($_FILES[$LOGO_NAME]['tmp_name'], $image_file_path)){
                $user_image_name = $file_name;
			}
		}
	return $user_image_name;
}


function writeToFile($File, $Data)
{

    $Handle = fopen($File, 'a');
    fwrite($Handle, $Data);
    fclose($Handle);
}

function extract_unit(&$string, $start, $end, $replace = 0)
{

	$pos = stripos($string, $start);

	$str = substr($string, $pos);

	$str_two = substr($str, strlen($start));

	$second_pos = stripos($str_two, $end);

	$str_three = substr($str_two, 0, $second_pos);

	$unit =  $str_three;
	if ($replace){
        /*$string = str_replace(substr(substr(substr($string, stripos($string, $start)), strlen($start)), 0, stripos(substr(substr($string, stripos($string, $start)), strlen($start)), $end)), "", $string);*/
       $string =   preg_replace("/$str_three/", '', $string, 1);
 	}
	

	return $unit;
}


function html_for_pdf_modifier($html_source){
	$html_source = str_replace("<html>","", $html_source);
	$html_source = str_replace("</html>","", $html_source);
	$html_source = str_replace("<head>","", $html_source);
	$html_source = str_replace("</head>","", $html_source);
    $title_tag = extract_unit($html_source, "<title>", "</title>", 1);
	//$html_soure = str_replace($title_tag, "" , $html_source);
 	$html_source = str_replace("<title>","", $html_source);

	$html_source = str_replace("</title>","", $html_source);
 	$html_source = str_replace("<body>","", $html_source);
	$html_source = str_replace("</body>","", $html_source);
	$html_source = str_replace("<br>","<br/>", $html_source);
	return $html_source;
}

function create_pdf(){
    ob_start(); // <--| This is very important to start output buffering and to catch out any possible notices
include(dirname(dirname(dirname(__FILE__))).'/MPDF53/mpdf.php');
$html = $this->render(TRUE);

$mpdf = new mPDF('utf-8','A4');

$mpdf->useOnlyCoreFonts = true;
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetAutoFont(0);



$mpdf->WriteHTML($html);

$pdf = $mpdf->Output('', 'S'); // <--| With the binary PDF data in $pdf we can do whatever we want - attach it to email, save to filesystem, push to browser's PDF plugin or offer it to user for download
$ob = ob_get_contents(); // <--| Here we catch out previous output from buffer (and can log it, email it, or throw it away as I do :-) )
ob_end_clean(); // <--| Finaly we clean output buffering and turn it off

// The next headers() section is copied out form mPDF Output() method that offers a PDF file to download
if (headers_sent())
    die('Some data has already been output to browser, can\'t send PDF file');
header('Content-Description: File Transfer');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Content-Type: application/force-download');
header('Content-Type: application/octet-stream', false);
header('Content-Type: application/download', false);
header('Content-Type: application/pdf', false);
if (!isset($_SERVER['HTTP_ACCEPT_ENCODING']) OR empty($_SERVER['HTTP_ACCEPT_ENCODING'])) {
    header('Content-Length: '.strlen($pdf));
}
header('Content-disposition: attachment; filename="invoice.pdf"');
echo $pdf; // <--| With the headers set PDF file is ready for download after we call echo
exit;
}

function storeTemplatetoFile($template_id, $post_id, $file_to_strore_pdf, $user_image_name = "" ){
    global $CONFIG;
    
    include_once ($CONFIG->path.'/modules/MPDF53/mpdf.php');
    
    include_once ($CONFIG->path."/modules/htmlfixer/htmlfixer.class.php");
 	$htmlFixer = new HtmlFixer();

  $page_source =  get_template_source($template_id, $post_id, $user_image_name);
  /*$page_source =$htmlFixer->getFixedHtml($page_source);

    @writeToFile("lib.txt","original===========\n\n" );
	@writeToFile("lib.txt", $page_source);
    @writeToFile("lib.txt", "Modified===========\n\n");
    $page_source = html_for_pdf_modifier($page_source);
    @writeToFile("lib.txt", $page_source);
    @writeToFile("lib.txt", "end===========\n\n");
*/
    $mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0);
    
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->WriteHTML($page_source);
    $mpdf->Output("$file_to_strore_pdf");
    return file_exists($file_to_strore_pdf);

}

function getTemplateDefaultImage($image_type="") {
	$result_path = "";
	if (is_not_empty($image_type)){
		$image_type = $image_type;
 	}else{
        $image_type = "default";
    }
 	$imgArray = getAlldefaultImageslist();
    $result_path = templ_search_mdim_array($imgArray, "id", $image_type, "path");
	return $result_path;
}

function getAlldefaultImageslist(){
	global $CONFIG;
    $DIR_PATH = dirname(dirname(__FILE__)).'/defaultImages/*.jpg';
	$img_files = glob($DIR_PATH);
	$image_info =array();
	$x = 0;
    foreach ($img_files  as $filename) {
        $file_base_name = str_replace(".jpg","",basename($filename, "*.jpg"));
        $image_info[$x]['id'] = $file_base_name;
        $image_info[$x]['title'] = ucwords(str_replace("_", " ", $file_base_name));
        $image_info[$x]['path'] = "{$CONFIG->wwwroot}templates/defaultImages/{$file_base_name}.jpg";
        $x++;
	}
	return $image_info;
}

function templ_search_mdim_array($array, $key, $value ,$key_val_to_return = "") {
	$return = array();
	foreach ($array as $k=>$subarray){
		if (isset($subarray[$key]) && $subarray[$key] == $value) {
			$return[$k] = $subarray;
			if (is_not_empty($key_val_to_return)){
                return $subarray[$key_val_to_return];
   			}else{
                return $subarray;
	  		}
		}
	}
}


function getMeAllTemplates($template_type=""){

    if (is_not_empty($template_type)){
       $tmp_conditions = "template_type =  '$template_type'";
    }else{
       $tmp_conditions = "1";
    }
    $sql = "SELECT * FROM `biz_templates` WHERE $tmp_conditions";
    $records = array();
    $x=0;
	$result = mysql_query($sql);
	if($result){
        while ($row = mysql_fetch_assoc($result)){
          $records[$x]['id'] = $row['template_id'];
          $records[$x]['title'] = $row['template_title'];
          $x++;
  		}
	}
	return $records;
}



function getTemplateInfo($post_id=0, $template_id = 0){
	$info = array();
	if($template_id >0){
		$template = get_template_variables($template_id);
	 	$info["template_file"] = $template["file"];
	 	$info["template_title"] = $template["title"];
	 	$info["template_type"] = $template["type"];

        $temp = get_all_content_variable($template["type"],$post_id);
        $info["template_content"] = $temp;

     }
	return $info;
}

 function get_template_variables($template_id = 0){
   	 $obj_biz_templates = new  biz_templates();
   	 $template_var = array();
   	 if($template_id >0){
        $obj_biz_templates->readObject(array("template_id"=>$template_id));
		$template_var["file"] =  $obj_biz_templates->gettemplate_file();
		$template_var["title"] =  $obj_biz_templates->gettemplate_title();
		$template_var["type"] =  $obj_biz_templates->gettemplate_type();
}
	return  $template_var;
}


function get_all_content_variable($type, $post_id=0){
	$content_vars = array();
	if (is_not_empty($type)){
        $type = strtoupper($type);
		switch($type){
			case "JOB" :
						/* function needs be added */
						break;
			case "PROJECT" :
						/* function needs be added */
						break;
			case "PROMOTION" :
                         $content_vars = get_promotion_templates_content_vars($post_id);
						break;
			case "EVENT" :
						$content_vars = get_event_templates_content_vars($post_id);
						break;
        	case "EVENT_INVITATION" : 
						$content_vars = get_event_invitaion_templates_content_vars($post_id);
						break;
  		}
 	}
 	
 	return $content_vars;

}

function get_event_templates_content_vars($event_id){
  global $CONFIG, $curr_user;

	$content = array();
	/**
    * Intialisation
    */
    $img = getTemplateDefaultImage();
            $content["title"] = "Your Title Goes Here";
            $content["image"] = $img;
            $content["start_date"] = date("Y-M-D");
            $content["end_date"] = date("Y-M-D");
            $content["strEventDate"] = date("Y-M-D");
            $content["startTime"] = date("Y-M-D");
            $content["endTime"] = date("Y-M-D");
            $strEventTime= "From - 10:30  To - 5:00 ";
			$content["strEventTime"] =  $strEventTime;
            
            $content["metro_area"] = "Metro Area";
            $content["state"] = "State ";
            $content["description"] = "Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.<Br/>";
            $content["promotion_link"] = $promotion_link;
			$content["firm"] = "Event Name";
			$content["firm_address"] = "Event Address";
			$content["firm_city"] = "Event City";
			$content["firm_metro_area"] = "Event Metro Area";
			$content["firm_state"] = "Event State";
			
			$content["firm_logo"]=   getIconUrl("");
			$content["firm_zip"] = "Event zip";
            //$content["firm_contact"] ="Event Contact ";
			$content["firm_phone"]=  "Event Phone";
            $content["firm_fax"]=   "Event fax";
            $content["firm_mobile"]=   "Event Mobile";
            $content["firm_website"]=   "event_website.com";
            //$content["firm_email"] =  "event@email.com";
            $content["firm_map_link"] =  "";
            $content["firm_link"] =  "";

	if ((is_not_empty($event_id)) && ($event_id>0)) {
    //..now get event details from db
 	  $query =  "select * from weekSchedule where ID = $event_id";
	  $result = mysql_query($query);
		 if($result){
	        $inf = mysql_fetch_array($result);
         	$content["title"] = $inf["title"] ;
         	$content["image"] = getImageUrl("");
         	$content["city"] =  $inf["city"];
         	$content["fee"] =  $inf["fee"];
         	$content["state"] =  $inf["state"];
         	$event_link = $CONFIG->wwwroot."mod/UniversalCalendar/MockupPlanner/edit_event.php?id=".$event_id;
         	
         	 $strDescription =trim(urldecode(strip_tags(mysql_real_escape_string($inf["description"]))));
            //$strDescription = (strlen($strDescription)>200) ? (substr($strDescription,0,200)."..") : $strDescription;

            $strDescription =  wordwrap($strDescription, 30, " ", true);
            $strDescription =  str_replace('\r\n', '<br/>', $strDescription);
            $strDescription =  str_replace('\"', '"', $strDescription);
            $strDescription =  str_replace("\'", "'", $strDescription);
            
            /*$content["description"] = strip_tags(fix_html_source($inf["description"]));*/
            $content["promotion_link"] = $event_link;
            //$content["description"] =  $strDescription." <a href='$event_link' target='_blank'>View More</a>";
            $content["description"] =  $strDescription;

            if($inf["is_registration_outside"] == 1){
                $strFee = "Pricing Detail";
            }else{
                 $strFee= (mysql_real_escape_string($inf["fee"])==0) ? "free" : "$". number_format(mysql_real_escape_string($inf["fee"]), 2, '.', '');
            }
             $content["fee"] = $strFee;

            //... For Date
             if(date('d',strtotime($inf["eventStartDate"]))!=date('d',strtotime($inf["eventEndDate"])))
                $strEventDate= date('n/j/Y',strtotime($inf["eventStartDate"]))." - ".date('n/j/Y',strtotime($inf["eventEndDate"]));
            else
                $strEventDate= date('n/j/y',strtotime($inf["eventStartDate"]));
            $startTime = date('H:i',strtotime($inf["eventStartDate"]));
            $endTime = date('H:i',strtotime($inf["eventEndDate"]));
            $content["strEventDate"] = $strEventDate;
            $content["eventStartDate"] =  $inf["eventStartDate"];
         	$content["eventEndDate"] =  $inf["eventEndDate"];
            $content["EventDate"] =  $strEventDate;
            $content["startTime"] =  $startTime;
            $content["endTime"] =  $endTime;
             if($startTime!= $endTime)
                $strEventTime= "$startTime - $endTime ";
			elseif(($startTime == "00:00") && ($endTime == "00:00"))
			    $strEventTime = "Not Specified";
			else
                $strEventTime= "$startTime";
			$content["strEventTime"] = $strEventTime;
            $content["strEventTime"] = $strEventTime;

            $owner = get_user($inf['userid']);

            if ($owner){
                $biz_img = getIconUrl($owner->getIcon('large'));
			}else{
                $biz_img = getIconUrl("");
   			}

			$content["firm"] = $owner->name;
			$content["firm_address"] = $inf["address"];
			$content["firm_city"] = $inf["city"];
			$content["firm_metro_area"] = $inf["location"];
			$content["firm_state"] = $inf["state"];
			$content["firm_logo"]=   $biz_img;
			$content["firm_zip"] = $inf["zip"];
            //$content["firm_contact"] ="";
			$content["firm_phone"]=  $owner->phone;
            $content["firm_fax"]=   $owner->phone;
            $content["firm_mobile"]=   $owner->mobile;
            $content["firm_website"]=   $owner->website;
            //$content["firm_email"] =  $owner->email;
            //$content["firm_map_link"] = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($content["firm_address"])."+".$content["firm_metro_area"])."+".$content["firm_zip"];
            $address_tmp=str_replace("\r\n"," ",$content["firm_address"]);
            $content["firm_map_link"] = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($address_tmp)."+".$content["firm_city"])."+".$content["firm_state"]."+".$content["firm_zip"];
            
            $content["firm_link"] = $owner->getUrl();
		}
}

	return $content;
}


function get_event_invitaion_templates_content_vars($event_id){
  global $CONFIG, $curr_user;

	$content = array();
	/**
    * Intialisation
    */
    $img = getTemplateDefaultImage();
            $content["title"] = "Your Title Goes Here";
            $content["image"] = $img;
            $content["start_date"] = date("Y-M-D");
            $content["end_date"] = date("Y-M-D");
            $content["strEventDate"] = date("Y-M-D");
            $content["startTime"] = date("Y-M-D");
            $content["endTime"] = date("Y-M-D");
            $strEventTime= "From - 10:30 To - 5:00 ";
			$content["strEventTime"] =  $strEventTime;
            $content["metro_area"] = "Metro Area";
            $content["state"] = "State ";
            $content["description"] = "Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.<Br/>";
            $content["promotion_link"] = $promotion_link;
            
            
            
   $content["firm"] = "Organizer Name";
			$content["firm_address"] = "Organizer Address";
			$content["firm_city"] = "Organizer City";
			$content["firm_metro_area"] = "Organizer Metro Area";
			$content["firm_state"] = "Organizer State";
			$content["firm_logo"]=    getIconUrl("");;
			$content["firm_zip"] = "Organizer zip";
            //$content["firm_contact"] ="Organizer Contact ";
			$content["firm_phone"]=  "Organizer Phone";
            $content["firm_fax"]=   "Organizer fax";
            $content["firm_mobile"]=   "Organizer Mobile";
            $content["firm_website"]=   "organizer_website.com";
            //$content["firm_email"] =  "organizer@email.com";
	        $content["firm_map_link"] = "";
	        $content["firm_link"] = "";
	        
	if ((is_not_empty($event_id)) && ($event_id>0)) {
    //..now get event details from db
 	  $query =  "select * from weekSchedule where ID = $event_id";
	  $result = mysql_query($query);
		 if($result){
	        $inf = mysql_fetch_array($result);
         	$content["title"] = $inf["title"] ;
         	$content["image"] = getImageUrl("");
         	$content["city"] =  $inf["city"];

         	$content["fee"] =  $inf["fee"];
         	$content["state"] =  $inf["state"];
         	$event_link = $CONFIG->wwwroot."mod/UniversalCalendar/MockupPlanner/edit_event.php?id=".$event_id;

            $strDescription =trim(urldecode(strip_tags(mysql_real_escape_string($inf["description"]))));
            //$strDescription = (strlen($strDescription)>200) ? (substr($strDescription,0,200)."..") : $strDescription;
            $strDescription =  wordwrap($strDescription, 30, " ", true);
            $strDescription =  str_replace('\r\n', '<br/>', $strDescription);
             $strDescription =  str_replace('\"', '"', $strDescription);
            $strDescription =  str_replace("\'", "'", $strDescription);
            /*$content["description"] = strip_tags(fix_html_source($inf["description"]));*/
            $content["promotion_link"] = $event_link;

            //$content["description"] =  $strDescription." <a href='$event_link' target='_blank'>View More</a>";
            $content["description"] =  $strDescription;
            
            if($inf["is_registration_outside"] == 1){
                $strFee = "Pricing Detail";
            }else{
                 $strFee= (mysql_real_escape_string($inf["fee"])==0) ? "free" : "$". number_format(mysql_real_escape_string($inf["fee"]), 2, '.', '');
            }
             $content["fee"] = $strFee;

            //... For Date
             if(date('d',strtotime($inf["eventStartDate"]))!=date('d',strtotime($inf["eventEndDate"])))
                $strEventDate= date('n/j/Y',strtotime($inf["eventStartDate"]))." - ".date('n/j/Y',strtotime($inf["eventEndDate"]));
            else
                $strEventDate= date('n/j/y',strtotime($inf["eventStartDate"]));
            $startTime = date('H:i',strtotime($inf["eventStartDate"]));
            $endTime = date('H:i',strtotime($inf["eventEndDate"]));
            $content["strEventDate"] = $strEventDate;
            $content["eventStartDate"] =  $inf["eventStartDate"];
         	$content["eventEndDate"] =  $inf["eventEndDate"];
            $content["EventDate"] =  $strEventDate;
            $content["startTime"] =  $startTime;
            $content["endTime"] =  $endTime;

            if($startTime!= $endTime)
                $strEventTime= "$startTime - $endTime ";
			elseif(($startTime == "00:00") && ($endTime == "00:00"))
			    $strEventTime = "Not Specified";
			else
                $strEventTime= "$startTime";
			$content["strEventTime"] = $strEventTime;

            $owner = get_user($inf['userid']);
            if ($owner){
                $biz_img = getIconUrl($owner->getIcon('large'));
			}else{
                $biz_img = getIconUrl("");
   			}

			$content["firm"] = $owner->name;
			$content["firm_address"] = "";
			$content["firm_city"] = "";
			$content["firm_metro_area"] = $owner->location;
			$content["firm_state"] = $owner->user_state;
			$content["firm_logo"]=  $biz_img  ;
			$content["firm_zip"] = $owner->user_zip;
            //$content["firm_contact"] ="";
			$content["firm_phone"]=  $owner->phone;
            $content["firm_fax"]=   $owner->phone;
            $content["firm_mobile"]=   $owner->mobile;
            $content["firm_website"]=   $owner->website;
            //$content["firm_email"] =  $owner->email;
            //$content["firm_map_link"] = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($content["firm_address"])."+".$content["firm_metro_area"])."+".$content["firm_zip"];
            $address_tmp=str_replace("\r\n"," ",$content["firm_address"]);
            $content["firm_map_link"] = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($address_tmp)."+".$content["firm_city"])."+".$content["firm_state"]."+".$content["firm_zip"];
            
            $content["firm_link"] = $owner->getUrl();

		}
}

	return $content;
}


/*
function get_event_templates_content_vars($event_id){
	$content = array();
	if ((is_not_empty($event_id)) && ($event_id>0)) {
 	  $query =  "Select * from weekSchedule where id = $event_id";
	  $result = mysql_query($query);
		 if($result){
	        $record = mysql_fetch_array($result);
	        $content["header_text"] = "";
	        $content["footer_text"] = "";
	        $content["content_text"] = "";
		}
 	}

	return $content;
}
*/

function getTemplateState_name($state_id){
    $name ="";
    $r = mysql_query ("SELECT  name FROM pds_states WHERE id=".$state_id);
	if($r){
        $f = mysql_fetch_row($r);
	    $name = $f[0];
    }
	return $name;
}

function getTemplateState_name_by_abr($state_abr){
    $name ="";
    $r = mysql_query ("SELECT  name FROM pds_states WHERE abbrev='".$state_abr."'");
	if($r){
        $f = mysql_fetch_row($r);
	    $name = $f[0];
    }
	return $name;
}

function getTemplateMetroArea_name_by_abr($metro_area_abr){
        $name ="";
        $r = mysql_query ("SELECT  metro_name FROM metro_area WHERE metro_abv='".$metro_area_abr."'");
        if($r){
            $f = mysql_fetch_row($r);
		    $name = $f[0];
        }
		return $name;
}

function getTemplateMetroArea_name($metro_area_id){
        $name ="";
        $r = mysql_query ("SELECT  metro_name FROM metro_area WHERE metro_id=".$metro_area_id);
        if($r){
            $f = mysql_fetch_row($r);
		    $name = $f[0];
        }
		return $name;
}

function get_promotion_templates_content_vars($promotion_id){
  global $CONFIG, $curr_user;
  	$content = array();
 	if ((is_not_empty($promotion_id)) && ($promotion_id>0)) {
    //..now get event details from db
    $sql = "SELECT p.*,l.firm,l.website, l.logo_ext,l.metro_area as firm_metro_area  , l.address1, l.loc1, l.states_id, l.contact, l.zip, l.country, l.fax, l.mobile, l.email, l.website, p.prm_restaurent
            FROM pds_list_promotions p
            INNER JOIN pds_list l ON p.list_id=l.id

            WHERE p.id =$promotion_id";

    $result = @mysql_query($sql);
    if ($result){
        while ($inf = mysql_fetch_assoc($result)) {
		 
			 if(date('d',strtotime($inf["start_date"]))!=date('d',strtotime($inf["end_date"])))
                $strEventDate= "From : ".date('n/j/y',strtotime($inf["start_date"]))." To :".date('n/j/y',strtotime($inf["end_date"]));
            else
                $strEventDate= date('n/j/y',strtotime($inf["start_date"]));
            $startTime = date('H:i',strtotime($inf["start_date"]));
            $endTime = date('H:i',strtotime($inf["end_date"]));

            $strLocation = mysql_real_escape_string($inf["metro_area_name"])."-".mysql_real_escape_string($inf["state"]);

            $strDescription =trim(urldecode(strip_tags(mysql_real_escape_string($inf["comments"]))));
            //$strDescription = (strlen($strDescription)>200) ? (substr($strDescription,0,200)."..") : $strDescription;
            $strDescription =  wordwrap($strDescription, 30, " ", true);
            $strDescription =  str_replace('\r\n', '<br/>', $strDescription);
             $strDescription =  str_replace('\"', '"', $strDescription);
            $strDescription =  str_replace("\'", "'", $strDescription);

            $lst_id=$inf["list_id"];
            $promotion_link ="{$CONFIG->wwwroot}modules/business_listing/show.php?show_type=PR&lid={$lst_id}&promoid={$promotion_id}";

            $content["title"] = $inf["title"];
						
						$rest_info = tbl_restaurent::GetInfo($inf['prm_restaurent']);
						
						if(is_not_empty($rest_info['resturent_img_url'])){
							$biz_logo = $rest_info['resturent_img_url'];
						} else{
							if ((is_not_empty($inf["logo_ext"])) && ($inf["logo_ext"] != "0")){
              $biz_logo = $CONFIG->wwwroot."modules/business_listing/logo/{$lst_id}.{$inf['logo_ext']}";
            }
						}
            
            
						
					
            
            $tmp_img = "";
            if ((is_not_empty($inf["img_ext"])) && ($inf["img_ext"] != "0")){
				 $tmp_img =  $CONFIG->wwwroot."modules/business_listing/promotion_images/{$inf['id']}.{$inf['img_ext']}";
			}
            // else
//                 $tmp_img = $biz_logo;

   			/*print_r($inf);*/
   		    $content["image"] = getImageUrl($tmp_img);

            $content["image_box"] = '<img src="'.$content["image"].'" alt="'.$content["title"].'}" style="border: solid 1px #FFF;max-height:250px;max-width:450px;display:block;" />';
            $content["start_date"] = $inf["start_date"];
            $content["end_date"] = $inf["end_date"];
            $content["strEventDate"] = $strEventDate;
            $content["startTime"] = $startTime;
            $content["endTime"] = $endTime;
            $content["metro_area"] = getTemplateMetroArea_name($inf["metro_area"]);
            $content["state"] = getTemplateState_name($inf["states"]);
            /*$content["description"] = strip_tags(fix_html_source($inf["comments"]));*/
            $content["promotion_link"] = $promotion_link;
            
            //$content["description"] =  $strDescription." <a href='{$promotion_link}' target='_blank'>View More</a>";
            $content["description"] =  $strDescription;
			$content["firm"] = $inf["firm"];
			$content["firm_address"] = $inf["address1"];
			$content["firm_city"] = $inf["loc1"];
			$content["firm_metro_area"] = getTemplateMetroArea_name($inf["firm_metro_area"]);
			$content["firm_state"] = getTemplateState_name($inf["states_id"]);
			$content["contact_state"] = getTemplateState_name($inf["xtra_4"]);
			$content["firm_logo"]=   getIconUrl($biz_logo);
			$content["firm_zip"] = $inf["zip"];
            //$content["firm_contact"] =$inf["contact"];
			$content["firm_phone"]=   $inf["phone"];
            $content["firm_fax"]=   $inf["fax"];
            $content["firm_mobile"]=   $inf["mobile"];
            $content["firm_website"]=   $inf["website"];
            //$content["firm_email"] =  $inf["email"];
            $address_tmp=str_replace("\r\n"," ",$content["firm_address"]);
            $content["firm_map_link"] = "http://www.google.com/maps?q=".str_replace(" ","+",strip_tags($address_tmp)."+".$content["firm_city"])."+".$content["contact_state"]."+".$content["firm_zip"];
            if ($inf["userid"]){
                $content["firm_link"] = get_entity($inf["userid"])->getUrl();
   			}
            if($curr_user > 0){
                $content["user_info"] = get_current_user_info($curr_user);
            }else{
                $content["user_info"] = get_current_user_info($inf["userid"]);
            }//.. if curr user
        }//..while
      }//.. if result
 	}else{
			$img = getImageUrl("");
            $content["title"] = "Your Title Goes Here";
            $content["image"] = $img;
            $content["start_date"] = date("Y-M-D");
            $content["end_date"] = date("Y-M-D");
            $content["strEventDate"] = date("Y-M-D");
            $content["startTime"] = date("Y-M-D");
            $content["endTime"] = date("Y-M-D");
            $content["metro_area"] = "Metro Area";
            $content["state"] = "State ";
            $content["description"] = "Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.Your description goes here.<Br/>";
            $content["promotion_link"] = $promotion_link;
			$content["firm"] = "Business Name";
			$content["firm_address"] = "Business Address";
			$content["firm_city"] = "Business City";
			$content["firm_metro_area"] = "Business Metro Area";
			$content["firm_state"] = "Business State";
			$biz_img = "";   
			if(is_gt_zero_num($_SESSION[SES_RESTAURANT])){
				$rest_info = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]); 
				if(is_not_empty($rest_info['restaurent_img_url'])){
					$biz_img  = $rest_info['restaurent_img_url'];
				} 
			}
			$content["firm_logo"]=    getIconUrl($biz_img);
			$content["firm_zip"] = "Business zip";
            //$content["firm_contact"] ="Business Contact ";
			$content["firm_phone"]=  "Business Phone";
            $content["firm_fax"]=   "Business fax";
            $content["firm_mobile"]=   "Business Mobile";
            $content["firm_website"]=   "buesiness_website.com";
            //$content["firm_email"] =  "business@email.com";
            $content["firm_map_link"] = "";
            $content["firm_link"] = "";
            
  	}//..if
	return $content;
}

function get_job_templates_content_vars($job_id){
	$content = array();
/*	if ((is_not_empty($event_id)) && ($event_id>0)) {
 	  $query =  "Select * from weekSchedule where id = $event_id";
	  $result = mysql_query($query);
		 if($result){
	        $record = mysql_fetch_array($result);
	        $content["header_text"] = "";
	        $content["footer_text"] = "";
	        $content["content_text"] = "";
		}
 	}*/

	return $content;
}

function get_project_templates_content_vars($project_id){
	$content = array();
/*	if ((is_not_empty($event_id)) && ($event_id>0)) {
 	  $query =  "Select * from weekSchedule where id = $event_id";
	  $result = mysql_query($query);
		 if($result){
	        $record = mysql_fetch_array($result);
	        $content["header_text"] = "";
	        $content["footer_text"] = "";
	        $content["content_text"] = "";
		}
 	}*/

	return $content;
}



function get_current_user_info($user_id){
  global $CONFIG;
  $user_info = array();
  if((is_not_empty($user_id)) && ($user_id>0)){
    $sel_user = get_user($user_id);
   /**
    * Code Updated By Inforesha.Shridhar@31032013
    $user_info["large_icon"] = $sel_user->getIcon('large');
    $user_info["small_icon"] = $sel_user->getIcon('small');
    $user_info["name"] = $sel_user->name;
    $user_info["metro_area"] = $sel_user->location;
    $user_info["state"] = $sel_user->user_state;
    $user_info["email"] = $sel_user->email;*/
    $user_info["large_icon"] =  "";
    $user_info["small_icon"] =  "";
    $user_info["name"] = $sel_user["full_name"];
    $user_info["metro_area"] = $sel_user["staff_city"];
    $user_info["state"] = $sel_user["staff_state"];
    $user_info["email"] = $sel_user["email"];
  }

  return $user_info;
}


function get_template_source($template_id, $post_id, $user_image_name = "",$isEmail=0){
  global $CONFIG;
  
  $opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

$context = stream_context_create($opts);
$extra_url = add_image_url($user_image_name);
// Open the file using the HTTP headers set above
	
	$str = biz_file_get_contents( "{$CONFIG->wwwroot}modules/templates/index.php?template_id={$template_id}&post_id={$post_id}{$extra_url}");
	if($isEmail==1){
		//$str = str_replace("{$CONFIG->wwwroot}", "{$CONFIG->path}/", $str);
	}else{
		$str = str_replace("{$CONFIG->wwwroot}", "{$CONFIG->path}/", $str);
	}
	//$str = str_replace("{$CONFIG->wwwroot}", "{$CONFIG->path}/", $str);
	 
    //$str = file_get_contents("{$CONFIG->wwwroot}modules/templates/index.php?template_id={$template_id}&post_id={$post_id}{$extra_url}", false, $context);
    //$str = str_replace("{$CONFIG->wwwroot}", "{$CONFIG->path}", $str);
  /* $str = file_get_contents("{$CONFIG->wwwroot}templates/index.php?template_id=$template_id&post_id=$post_id");*/
  
   //$str = file_get_contents("{$CONFIG->wwwroot}templates/_templates/helvetica/full_width.html");
  return $str;
}

function send_template($template_id, $post_id, $receiver_email, $sender_email,$sender_name="",$subject=""){
	$message = get_template_source($template_id, $post_id,'',1);
	$to =  $receiver_email;
	//$subject = 'Website Change Reqest';
	$headers 	= "From:$sender_name <$sender_email>"."\r\n";
	$headers .= "Reply-To: <".$sender_email. ">"."\r\n";
	$headers .= "MIME-Version: 1.0"."\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion(); 
	//echo $to, $subject, $message, $headers,'-f'.$sender_email;exit;
	return mail($to, $subject, $message, $headers,'-f'.$sender_email);
}

function get_template_preview_script($template_id, $post_id, $user_image_name =""){
    global $CONFIG;
    $script_to_run = "";
	$extra_url = add_image_url($user_image_name);
    if(is_not_empty($template_id) && ($template_id > 0)){
             $script_to_run = "window.open('{$CONFIG->wwwroot}templates/index.php?template_id=$template_id&post_id={$post_id}{$extra_url}','', 'width=800,height=400,scrollbars=yes');";

    }else{
      $script_to_run = "alert('Please, Select The Template');";
    }
  return $script_to_run;
}

function get_template_preview($template_id, $post_id, $user_image_name = ""){
    return "<script type='text/javascript'>".get_template_preview_script($template_id, $post_id, $user_image_name)."</script>";
}


function get_template_print($template_id, $post_id){
    global $CONFIG;
    $script_to_run = "";

    if(is_not_empty($template_id) && ($template_id > 0)){
        if(is_not_empty($post_id) && ($post_id > 0)){
          $script_to_run = "window.open('{$CONFIG->wwwroot}templates/print.php?template_id=$template_id&post_id=$post_id','', 'width=800,height=400,scrollbars=yes');";

        }else{
            $script_to_run = "alert('Please, Select The Post');";
        }
    }else{
       $script_to_run = "alert('Please, Select The Template');";
    }

    if (is_not_empty($template_id, $post_id)){

    }
    return "<script type='text/javascript'>$script_to_run</script>";
}

function getIconUrl($curr_icon_url){
 	global $CONFIG;
 	$curr_icon_path = str_replace($CONFIG->wwwroot, $CONFIG->path."/", $curr_icon_url); 
  if (file_exists($curr_icon_path)){
       return $curr_icon_url;
  }else{
       return $CONFIG->wwwroot.'images/restaurant.png';
  }
}

function getImageUrl($curr_img_url=""){
    global $CONFIG;
    if(is_not_empty($curr_img_url)){
        $curr_img_path = str_replace($CONFIG->wwwroot, $CONFIG->path."/", $curr_img_url);
		 
        if (file_exists($curr_img_path)){
             return $curr_img_url;
        }/*else{
             return getTemplateDefaultImage();
        }*/ 
    }
    return '';
}
?> 