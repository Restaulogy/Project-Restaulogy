<?php
/*
IMP INFORMATION

here
    $translations['dimention_1']['dimention_2']['dimention_3']['dimention_4'] = <VALUE>;
     $translations : actucal array
     dimention_1 : WHICH FORM / ini File Name  -- here you can add default value as 'common'
     dimention_2 : WHICH SPECIFIC ELEMNT YOU ARE GIVING VALUE
     dimention_3 : WHAT KIND OF INFORMATION like lable, error, element
     dimention_4 : extra information about value
This arrays value you can access at smarty like
   {$translations.dimention_1.dimention_2.dimention_3}

eg
 ##### php
    $translations['edit_listing']['zip']['extra_info']['us_format'] = "In US Format eg.'XXXXX' Or 'XXXXX-XXXX'";
    
 #### smarty
        {$translations.edit_listing.zip.extra_info.us_format}

*/

//INITIALISATION
$translations = array();
$LANG_DIRECTRORY = dirname(__FILE__).DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR.'en'.DIRECTORY_SEPARATOR; 

//get all files with a .ini extension.
$ini_FILES = glob($LANG_DIRECTRORY . "*.ini");

//print each file name
 foreach($ini_FILES as $ini_FILE){
    $file_name = $ini_FILE;
    $file_name = str_replace( $LANG_DIRECTRORY, "" , $ini_FILE);
	$file_name = str_replace( ".ini" , "", $file_name); 
 	$translations["{$file_name}"] = parse_ini_file($ini_FILE , true); 
} 
$tpl->assign ('translations', $translations);
?>

