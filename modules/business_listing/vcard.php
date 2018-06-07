<?PHP
// Generates a downloadable vcard
// For use with phpDirectorySource ver 1.1
// freeware, released to the public domain

// Configuration Settings
include ("configs/config.php");

// Database Connection Module
include ("modules/connect.php");

$r = mysql_query("SELECT * FROM $pds_list WHERE id='$_GET[id]';");
$r_rows = mysql_num_rows($r);

if(!$r_rows){
   //Lisitng not found
   header("Location: index.php");
}

$f = mysql_fetch_assoc($r);

// Starting card info
$vcard_info = "BEGIN:VCARD\r\n";
$vcard_info .= "VERSION:2.1\r\n";

// Name
// assumes first last -or- first middle last in contact field
if($f['contact'] != ""){
   $contact = explode(" ",$f['contact']);
   switch ( count($contact) ){
   case 2:
      $vcard_info .= 'N;ENCODING=QUOTED-PRINTABLE:'.quotedPrintableEncode($contact[1]).';'.quotedPrintableEncode($contact[0])."\r\n";
      break;
   case 3:
      $vcard_info .= 'N;ENCODING=QUOTED-PRINTABLE:'.quotedPrintableEncode($contact[2]).';'.quotedPrintableEncode($contact[0]).';'.quotedPrintableEncode($contact[1])."\r\n";
      break;
   default:
   }
   $vcard_info .= 'FN;ENCODING=QUOTED-PRINTABLE:'.quotedPrintableEncode($f['contact'])."\r\n";
}

// Nickname
// No standard field, to implement replace field with the table field being used
if($f['field'] && $f['field'] != ""){
   $vcard_info .= 'NICKNAME;ENCODING=QUOTED-PRINTABLE:'.quotedPrintableEncode($f['field'])."\r\n";
}

// Organization
// assumes firm name is organization
$vcard_info .= 'ORG;ENCODING=QUOTED-PRINTABLE:'.quotedPrintableEncode($f['firm'])."\r\n";

// Job Title
// No standard field, to implement replace field with the table field being used
if($f['field'] &&  $f['field'] != ""){
   $vcard_info .= 'TITLE;ENCODING=QUOTED-PRINTABLE:'.quotedPrintableEncode($f['field'])."\r\n";
}

// Notes
// assumes first 150 characters of the description
if($f['description'] != ""){
   $short_desc = stripslashes(substr($f['description'],0,150));
   $vcard_info .= 'NOTE;ENCODING=QUOTED-PRINTABLE:'.quotedPrintableEncode($short_desc)."\r\n";
}

// Telephone
// assumes work numbers provided
if($f['phone']){
   $vcard_info .= 'TEL;WORK;VOICE:'.$f['phone']."\r\n";
}
if($f['fax']){
   $vcard_info .= 'TEL;WORK;FAX:'.$f['fax']."\r\n";
}
if($f['mobile']){
   $vcard_info .= 'TEL;CELL;VOICE:'.$f['mobile']."\r\n";
}

// Address
// priority given to loc1 and zip fields
// assumes 1st line is street address, 2nd line is city, st zipcode, 3rd line is country
if ($f['address1'] != ""){
   $address = explode("<br />",nl2br($f['address1']));
   $line2 = explode(" ",$address[1]);
}
if($f['loc1'] != ""){
   $street = $f['loc1'];
}else{
   $street = $address[0];
}
if($f['zip'] != ""){
   $zip = $f['zip'];
}else{
   $zip = $line2[2];
}
$city = ltrim( rtrim($line2[0],","),"\n\r" );
$state = $line2[1];
$country = $address[2];

// office field not standard, to activate replace it with table field used for office
$vcard_info .= 'ADR;WORK:'.$f['firm'].';'.$f['office'].';'.$street.';'.$city.';'.$state.';'.$zip.';'.$country."\r\n";

// Website
if($f['website'] != ""){
   $vcard_info .= 'URL;WORK:http://'.$f['website']."\r\n";
}

// E-mail
// gives preference to listings e-mail
if($f['email'] != ""){
   $email = $f['email'];
}else{
   $ra = mysql_query("SELECT usermail FROM $pds_user WHERE id='$f[userid]';");
   $fa = mysql_fetch_assoc($ra);
   $email = $fa['usermail'];
}
$vcard_info .= 'EMAIL;PREF;INTERNET:'.$email."\r\n";

// Ending card info
$vcard_info .= "END:VCARD\r\n";

$filename = str_replace(" ","_",$f['firm']);

header('Content-Type: text/x-vcard');
header('Content-Disposition: attachment; filename=vCard_' . $filename . '.vcf');

echo $vcard_info;

function quotedPrintableEncode($text){
    return preg_replace("~([\x01-\x1F\x3D\x7F-\xFF])~e", "sprintf('=%02X', ord('\\1'))", $text);
}

?>
