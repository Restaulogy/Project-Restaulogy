<?php
 include("..\init.php");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $website.'/ajax/getImageSrc.php?var1='.$table['table_seating_capacity'].'&var2=2&var3=dddd');
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$a = curl_exec($ch);
if(strpos('base64', $a)){
	$l = $a;
	
}
 
 echo $l;
?>