<?php

include_once(dirname(dirname(__FILE__))."/init.php");

$sel_latitude=get_input('latitude','');
$sel_longitude=get_input('longitude','');

if (($sel_latitude!='')&&($sel_longitude!='')) {
   $_SESSION['client_lat']= $sel_latitude;
   $_SESSION['client_long']= $sel_longitude;
}

?>