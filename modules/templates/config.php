 <?php
  header('Content-Type: text/html; charset=UTF-8');
	ini_set('display_errors', 'On');
	error_reporting(E_ALL^E_NOTICE);
	define('APP_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
  // Function and classes includes
	require_once 'lib/function.php';

  //..Setup Language
    $translations = array();
    $LANG_DIRECTRORY = APP_PATH.'language/en/';
  //....get all files with a .ini extension.
    $ini_FILES = glob($LANG_DIRECTRORY . "*.ini");
	 
	
  //....print each file name
  foreach($ini_FILES as $ini_FILE){
    $file_name = $ini_FILE;
    $file_name = str_replace( $LANG_DIRECTRORY, "" , $ini_FILE);
  	$file_name = str_replace( ".ini" , "", $file_name);
   	$translations[$file_name] = parse_ini_file($ini_FILE , true);
  }
		
	$restinfo = tbl_restaurent::GetInfo($_SESSION[SES_RESTAURANT]);
	$translations['copyright'] = $restinfo['restaurent_name'].' &copy; All rights reserved.' ;
?>