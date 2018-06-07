<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php";
if (isloggedin()){
    $curr_user = get_user(get_loggedin_userid());
    $curUsrProfLoc=$curr_user->user_zip;
}

//Get curent user profile location
//$metadata=get_metadata_byname($curr_user, "location");
//$curUsrProfLoc=$metadata->value;
//$curUsrProfLoc="7221 S 41st Drive,Phoenix, AZ";

//if(isset($_GET['formname']))  { $formname = $_GET['formname']; }
if(isset($_GET['address']))   { $address  = utf8_encode($_GET['address']); }
else { $address=$curUsrProfLoc;}

//if(isset($_POST['formname'])) { $formname = $_POST['formname']; }
//if(isset($_POST['address']))  { $address  = utf8_encode($_POST['address']); }
//else { $address=$curUsrProfLoc;}
?>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>NetDirect GeoCoder 2</title>
<link rel="stylesheet" type="text/css" href="formate.css">
<script src="http://maps.google.com/maps?hl=en&file=api&v=2.x&key=ABQIAAAAxrrYw2bBTVKuHbGmrAdBuhQYi6jsp0XZH79MTRLGPRfzDN_W9hRfHVQa6Lch_wtkcQ8ol0vqhYmW9g" type="text/javascript"></script>
<script type="text/javascript" src="https://www.google.com/jsapi?key=ABQIAAAAxrrYw2bBTVKuHbGmrAdBuhQYi6jsp0XZH79MTRLGPRfzDN_W9hRfHVQa6Lch_wtkcQ8ol0vqhYmW9g"></script>
<script type="text/javascript">
var coord1 = "";
var coord2 = "";

var map = null;
var geocoder = null;

function load() {
      <?php
        //if(isset($_GET['address']) && ($_GET['address']!="")){
          if(isset($address) && ($address!="")){
      ?>
       if (GBrowserIsCompatible()) {
       map = new GMap2(document.getElementById("map"));
       map.addControl(new GLargeMapControl());
       map.addControl(new GMapTypeControl());
       var center = new GLatLng(0, 0);
       map.setCenter(center, 1);
       geocoder = new GClientGeocoder();
      }
      if (geocoder) {
        geocoder.getLatLng(
          '<?php echo $address; ?>',
          function(point) {
            if (!point) {
              alert("<?php echo $address; ?>" + " could not be processed. Please zoom and pick manually...");
              var fcenter = new GLatLng(0,0);
              map.setCenter(fcenter, 1);
              var marker = new GMarker(fcenter, {draggable: true});
              map.addOverlay(marker);
              GEvent.addListener(marker, "dragend", function() {
		var point =marker.getPoint();
		map.panTo(point);
		//document.getElementById("lat").innerHTML = point.lat().toFixed(5);
		//document.getElementById("lng").innerHTML = point.lng().toFixed(5);
	       coord1 = point.lat().toFixed(5);
	       coord2 = point.lng().toFixed(5);
              });
            } else {
              map.setCenter(point, 15);
              var marker = new GMarker(point, {draggable: true});
              map.addOverlay(marker);
              GEvent.addListener(marker, "dragend", function() {
		var point =marker.getPoint();
		map.panTo(point);
		//document.getElementById("lat").innerHTML = point.lat().toFixed(5);
		//document.getElementById("lng").innerHTML = point.lng().toFixed(5);
	       coord1 = point.lat().toFixed(5);
	       coord2 = point.lng().toFixed(5);
              });
              GEvent.addListener(marker, "click", function() {
		var point =marker.getPoint();
		map.panTo(point);
		//document.getElementById("lat").innerHTML = point.lat().toFixed(5);
		//document.getElementById("lng").innerHTML = point.lng().toFixed(5);
	       coord1 = point.lat().toFixed(5);
	       coord2 = point.lng().toFixed(5);
              });
	      GEvent.trigger(marker, "click");
            }
          }
        );
      }

      <?php
        }else {
      ?>
            google.load("maps", "2", {callback: initialize});
      <?php
        }
      ?>
    }
    
//..Following functions for auto detect users position
function initialize() {
    // Initialize default values
    var zoom = 3;
    var latlng = new google.maps.LatLng(37.4419, -100.1419);
    var location = "Showing default location for map.";

    // If ClientLocation was filled in by the loader, use that info instead
    if (google.loader.ClientLocation) {
      zoom = 63;
      latlng = new google.maps.LatLng(google.loader.ClientLocation.latitude, google.loader.ClientLocation.longitude);
      location = "Showing IP-based location: <b>" + getFormattedLocation() + "</b>";
    }

    //document.getElementById("location").innerHTML = location;
    var map = new google.maps.Map2(document.getElementById('map'));
    map.setCenter(latlng, zoom);
    map.addControl(new GLargeMapControl());
    map.addControl(new GMapTypeControl());
  }

  function getFormattedLocation() {
    if (google.loader.ClientLocation.address.country_code == "US" &&
      google.loader.ClientLocation.address.region) {
      return google.loader.ClientLocation.address.city + ", "
          + google.loader.ClientLocation.address.region.toUpperCase();
    } else {
      return  google.loader.ClientLocation.address.city + ", "
          + google.loader.ClientLocation.address.country_code;
    }
  }

/*
function transfer()
{
 opener.document.<?php echo $formname; ?>.coord1.value = coord1;
 opener.document.<?php echo $formname; ?>.coord2.value = coord2;
 self.close();
}
*/
</script>
</head>

<body onload="load()" onunload="GUnload()" >

<div align="center" id="map" style="width:670px;height:300px;border:1px solid #C0C0C0;"><br/></div>

<BR><BR><BR>
</body>
</html>
