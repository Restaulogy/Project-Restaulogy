<?PHP
/*
dlogo.php
Display Logo for phpDirectorySource Ver 1.x
Logo resize on the fly
*/

// Settings
$width = 120;
$height = 120;

// Configuration Settings
require_once ("configs/config.php");

// Database Connection Module
require_once ("modules/connect.php");

// Resize image class
include_once("classes/resizeimage.inc.php");

// Setting up variables
$id = $_GET['id'];
$width = ($_GET['w']) ? $_GET['w'] : $width;
$height = ($_GET['h']) ? $_GET['h'] : $height;

if( !is_numeric($id) ){
   die();
}

$r = mysql_query("SELECT logo_ext FROM $pds_list WHERE id='$id';");
$f = mysql_fetch_assoc($r);
$file_ext = $f['logo_ext'];

$image_file = "$config[root]/logo/$id.$file_ext";

if( is_readable($image_file) ){
   $rimg=new RESIZEIMAGE($image_file);
   $rimg->resize_limitwh($width,$height);
   $rimg->close();
}

?>
