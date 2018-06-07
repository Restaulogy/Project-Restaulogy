<?php
error_reporting(1);
//	include('dbcon.php');
include ("modules/modules.php");

//***********************************************
// Include Variable Sets
//***********************************************
include ("configs/common_vs.php");

$isMobile =  true;

//echo $str_anchers;
//exit;
/*if ((isset($_SESSION['mobile'])) && ($_SESSION['mobile']==1)){
    $isMobile =  true;
}else{
    $isMobile = false;
}*/

$busIcnArr=array();

?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Show Maps</title>
        <style type="text/css">
            body { font: normal 10pt Helvetica, Arial; }
            #map { width: 100%; height: 100%; border: 0px; padding: 0px; }
        </style>
    <link href="<?php echo $website; ?>/modules/business_listing/vendors/jquery-ui-1.8.9.custom.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo $website; ?>/modules/business_listing/vendors/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $website; ?>/modules/business_listing/vendors/jquery-ui-1.7.2.custom.min.js"></script>
        <script src="http://maps.google.com/maps/api/js?v=3&sensor=<?php echo ($isMobile?'true':'false'); ?>" type="text/javascript"></script>

        <script type="text/javascript">
           // var directionDisplay;
           // var directionsService = new google.maps.DirectionsService();
            var service = new google.maps.DistanceMatrixService();

            var center = null;
            var map = null;
            var currentPopup;
            var bounds = new google.maps.LatLngBounds();

            var usr_lat=null;
            var usr_long=null;

            var gmarkers =[];
            var htmls = [];

			var current_marker_id = "";

            function calcRoute(lat1,lon1,lat2,lon2) {
                var start = new google.maps.LatLng(lat1,lon1);
                var end = new google.maps.LatLng(lat2,lon2);
                var request = {
                    origin:start,
                    destination:end,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                };
                directionsService.route(request, function(response,status){
                  if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                  }
                });
           }

	 function getMeDistance(lat1,lon1,lat2,lon2){
		var origin1 = new google.maps.LatLng(lat1,lon1);
  		var destinationA = new google.maps.LatLng(lat2,lon2);
          service.getDistanceMatrix(
          {
            origins: [origin1],
            destinations: [destinationA],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.IMPERIAL,
            avoidHighways: false,
            avoidTolls: false
          }, function (response, status) {

          if (status != google.maps.DistanceMatrixStatus.OK) {
              alert('Error was: ' + status);
          }else{
                var results = response.rows[0].elements;
                for (var j = 0; j < results.length; j++) {
    			  alert(results[j].distance.text);
    	   		  return results[j].distance.text;
             }
          }
      });
    }


            /*function getMeDistance(lat1,lon1,lat2,lon2){
                var R = 3963.19;//6371; // km
                var d = Math.acos(Math.sin(lat1)*Math.sin(lat2) + Math.cos(lat1)*Math.cos(lat2) * Math.cos(lon2-lon1)) * R;
                return d;
            }
            */
            function addMarker(lat, lng, info ,ic_type,id_part_lnk) {
                var pt = new google.maps.LatLng(lat, lng);
                //var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/"+ic_type+".png",new google.maps.Size(32, 32), new google.maps.Point(0, 0),new google.maps.Point(16, 32));

                var icon = new google.maps.MarkerImage("<?php echo $elgg_main_url; ?>images/_graphics/google_map_markers/"+ic_type,new google.maps.Size(32, 32), new google.maps.Point(0, 0),new google.maps.Point(16, 32));

                bounds.extend(pt);

                var marker = new google.maps.Marker({
                    position: pt,
                    icon: icon,
                    map: map,
                    draggable:false,
                    animation: google.maps.Animation.DROP
                });
                var popup = new google.maps.InfoWindow({
                    content:  info,
                    maxWidth: 580
                });

                google.maps.event.addListener(marker, "click", function() {


                    if (currentPopup != null) {
                        currentPopup.close();
                        if (marker.getAnimation() != null) {
                        	marker.setAnimation(null);
                    	}
                        /*$('.map_info').removeClass("map_info_hover");*/
                        currentPopup = null;
                    }
                    if(current_marker_id != ""){
                          if (gmarkers[current_marker_id].getAnimation() != null ) {
                        	  gmarkers[current_marker_id].setAnimation(null);
                		}
						$('#map_info_box_'+current_marker_id).removeClass("map_info_hover");
                        current_marker_id = "";
					}
     				current_marker_id = id_part_lnk;
                    popup.open(map, marker);
                    currentPopup = popup;

                    if (marker.getAnimation() == null) {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                      $('#map_info_box_'+id_part_lnk).addClass("map_info_hover");
                });
                google.maps.event.addListener(popup, "closeclick", function() {

                    //map.panTo(center);
                    if (marker.getAnimation() != null) {
                         marker.setAnimation(null);
                    }
                    currentPopup = null;
                      $('#map_info_box_'+id_part_lnk).removeClass("map_info_hover");
                });

                gmarkers[id_part_lnk] = marker;
                htmls[id_part_lnk] = info;
            }

			function marker_animation_stop(marker_id){
                 if (gmarkers[marker_id].getAnimation() != null) {
                        gmarkers[marker_id].setAnimation(null);
                  }
   			}

   			function marker_animation_start(marker_id){
                 if (gmarkers[marker_id].getAnimation() == null) {
                        gmarkers[marker_id].setAnimation(google.maps.Animation.BOUNCE);
                  }
   			}

   			function marker_popup_open(marker_id){
                 if (currentPopup != null) {
                    currentPopup.close();
                    currentPopup = null;
                 }
                popup.open(map, gmarkers[marker_id]);
                currentPopup = popup;
   			}

   			function marker_add_selected(marker_id){
            	$('#map_info_box_'+marker_id).addClass("map_info_hover");
	  		}

	  		function marker_remove_selected(marker_id){
            	$('#map_info_box_'+marker_id).removeClass("map_info_hover");
	  		}

            function myclick(i) {
                var popup = new google.maps.InfoWindow({
                    content: htmls[i],
                    maxWidth: 580
                });
                if (currentPopup != null) {
                    currentPopup.close();
                    currentPopup = null;
                }
                popup.open(map, gmarkers[i]);
                currentPopup = popup;
            }

        	function highlightMarker(marker_id){
                if (gmarkers[marker_id].getAnimation() != null ) {
                        gmarkers[marker_id].setAnimation(null);
                }else{
                        gmarkers[marker_id].setAnimation(google.maps.Animation.BOUNCE);
				}
			}

            function initMap() {
                //directionsDisplay = new google.maps.DirectionsRenderer();

                map = new google.maps.Map(document.getElementById("map"), {
                    center: new google.maps.LatLng(0, 0),
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                    },
                    navigationControl: true,
                    navigationControlOptions: {
                        style: google.maps.NavigationControlStyle.ZOOM_PAN
                    }
                });
                //add marker on given coordinates

                if(navigator.geolocation) {
                  navigator.geolocation.getCurrentPosition(function(position) {
                    usr_lat= position.coords.latitude;
                    usr_long=position.coords.longitude;
                    $url="<?php echo $elgg_main_url;?>ajax/get_map_geo_location.php";
                    //..Call ajax page to get the current location
                    $.get($url, {latitude: usr_lat, longitude:usr_long});
                    //alert('lt,long'+usr_lat+','+usr_long);
                    //..get current location
                    addMarker(usr_lat,usr_long,"Your current location on map.","paleblue_MarkerA.png",0);

                  }, function() {
                    //handleNoGeolocation(true);
                    <?php Biz_GetUsrLocation(); ?>
                  });
                } else {
                  // Browser doesn't support Geolocation
                  //handleNoGeolocation(false);
                  <?php Biz_GetUsrLocation(); ?>
                }

                <?php
$strBussList="";

function get_buss_perof_det_div($list,$iconimage,$isMobile){
  global $elgg_main_url;

  if($list){

    extract($list);

    $str_ph="";
    if ($phone!="")
          $str_ph .="{$phone} (h) |";
    if ($mobile!="")
          $str_ph .="{$mobile} (m) |";
    if ($fax !="")
          $str_ph .="{$fax} (f) |";

    if($isMobile){

      $str_div = "
	<table class=\"map_info\" onmouseover=\"highlightMarker({$id});\" onmouseout=\"highlightMarker({$id});\">
		<tr id=\"map_info_box_{$id}\">
			<td style=\"width:40px;vertical-align:top;\">
                <a href='#' onclick=\"myclick({$id});\" ><img  src=\"{$elgg_main_url}images/_graphics/google_map_markers/{$iconimage}\"> </a></b>
			</td>

            <td style=\"width:260px;vertical-align:top;\">
							<a href='#' style='font-size:11px;' onclick=\"myclick({$id});\" >{$firm}";
							if ($metro_area!="")
							    $str_div .=", $metro_area";
				$str_div .="</a>
							<ul style=\"padding: 0;margin: 0;list-style-type: none; width: 260px;\">";
							$li_style = "style ='display: inline-block !important;padding: 2;'";
							if ($address!="")
							    $str_div .="<li $li_style>".htmlspecialchars(str_replace("\r\n"," ",$address), ENT_QUOTES)."</li>";
							if ($add!="")
							    $str_div .="<li $li_style>".htmlspecialchars(str_replace("\r\n"," ",$add), ENT_QUOTES)."</li>";
                           /* if ($state!="")
							    $str_div .="<li $li_style>{$state}</li>";
						    if ($metro_area!="")
							    $str_div .="<li $li_style>{$metro_area}</li>";*/
							if ($website!=""){
                                 $str_div .="<li $li_style><a href=\"{$website}\" target=\"_blank\">{$website}</a></li>";
							}
                                if ($phone!="")
          							$str_div .="<li $li_style>{$phone}</li>";
    							/*if ($mobile!="")
							          $str_div .="<li $li_style>{$mobile}</li>";
							    if ($fax !="")
							          $str_ph .="<li $li_style>{$fax}</li>";*/
							 $str_div .="</ul>";
							 if(is_gt_zero_num($is_in_cupobiz)){
							 	$str_div .="<a target=\"_blank\" href=\"promotionslisting.php?show_type=PR&listing_type=bizness&biz_id={$id}&list_view=1\">View Promotions</a>";
							 }

	   $str_div .="</td>
       <td style=\"width:40px;\">{$logo}</td>
       </tr>
	</table>";
    }else{
       $str_div = "
	<table class=\"map_info\" onmouseover=\"highlightMarker({$id});\" onmouseout=\"highlightMarker({$id});\">
		<tr id=\"map_info_box_{$id}\">
			<td style=\"width:40px;vertical-align:top;\">
                <a href='#' onclick=\"myclick({$id});\" ><img src=\"{$elgg_main_url}images/_graphics/google_map_markers/{$iconimage}\"> </a></b>
			</td>

            <td style=\"width:260px;\">
				<table style=\"width:260px;font-size:11px;\">
				    <tr>
                        <td colspan='2'>
							<a href='#' style='font-size:14px;' onclick=\"myclick({$id});\" >{$firm}";
							if ($metro_area!="")
							    $str_div .=", $metro_area";
				$str_div .="</a>
						</td>
					</tr>
					<tr>
                        <td style=\"width:220px;vertical-align:top;\">
							<ul style=\"padding: 0;margin: 0;list-style-type: none; width: 200px;\">";
							$li_style = "style ='display: inline-block !important;padding: 2;'";
							if ($address!="")
							    $str_div .="<li $li_style>".htmlspecialchars(str_replace("\r\n"," ",$address), ENT_QUOTES)."</li>";
							if ($add!="")
							    $str_div .="<li $li_style>".htmlspecialchars(str_replace("\r\n"," ",$add), ENT_QUOTES)."</li>";
                            if ($state!="")
							    $str_div .="<li $li_style>{$state}</li>";
						    if ($metro_area!="")
							    $str_div .="<li $li_style>{$metro_area}</li>";
							if ($website!=""){
                                 $str_div .="<li $li_style><a href=\"{$website}\" target=\"_blank\">{$website}</a></li>";
							}
                                if ($phone!="")
          							$str_div .="<li $li_style>{$phone}</li>";
    						/*	if ($mobile!="")
							          $str_div .="<li $li_style>{$mobile}</li>";
							    if ($fax !="")
							          $str_ph .="<li $li_style>{$fax}</li>";*/
							 $str_div .="</ul>";
							 if(is_gt_zero_num($is_in_cupobiz)){
							 	$str_div .="<a target=\"_blank\" href=\"promotionslisting.php?show_type=PR&listing_type=bizness&biz_id={$id}&list_view=1\">View Promotions</a>";
							 }

	   				$str_div .="</td> 
                        <td style=\"width:40px;\">{$logo}</td>
					 </tr>
				</table>
			</td>
       </tr>
	</table>";
    }


  }
  return $str_div;
}

//..Store current location
$my_curr_lat=$_SESSION['client_lat'];
$my_curr_long=$_SESSION['client_long'];

$str_anchers="";
if((is_not_empty($_GET["map_ids"])) || (is_not_empty($_GET["other_map_ids"]))){
   $lstIDs= get_input("map_ids","");
   $OtherlstIDs=get_input("other_map_ids","");
   //echo "lstIDs=$lstIDs |";
   if(is_not_empty($lstIDs)){
   		$query1 = "SELECT id, firm,phone,zip,website,states_id,email,fax,mobile,metro_area,country,xtra_2,xtra_3,address1 as address,logo_ext, 1 as is_in_cupobiz FROM pds_list WHERE id IN ($lstIDs) order by id asc ";
   }else{
   		$query1 = ""; 
   }
   
    if(is_not_empty($OtherlstIDs)){
   		$query2 = "SELECT id, title as firm, ggl_biz_phone_number as phone, ggl_biz_postal_code as zip, ggl_biz_website as website, state as states_id,'' as email, city as metro_area, '' as fax,'' as mobile, 'US' as country,  lat as xtra_2, lng as xtra_3,  address, '' as  logo_ext, 0 as is_in_cupobiz FROM `biz_tmp_business` LEFT OUTER JOIN `biz_google_biz` ON id = ggl_biz_id WHERE id IN ($OtherlstIDs) order by id asc";
 	}else{
   	 $query2 = ""; 
    }
 
   if(is_not_empty($query1) || is_not_empty($query2)){ 
	 if(is_not_empty($query1) && is_not_empty($query2)){
	 	$query = "({$query1}) UNION ({$query2})"; 
	 }elseif((is_not_empty($query1)==false) && is_not_empty($query2)){
	 	$query = $query2; 
	 }elseif(is_not_empty($query1) && (is_not_empty($query2)==false)){
	 	$query = $query1; 
	 }  
   } 
   /*
 echo "query=$query |";exit; */
   $result = mysql_query($query);
   
   if ($result){
        $imgIcon=65;
        while ($row = mysql_fetch_assoc($result)) { 
            //..store data in variables for easy retrival of data
            //..based on the lat long calculate the distance
            $temp_arr = array();
            $temp_arr['id']=mysql_real_escape_string($row['id']);
			$temp_arr['firm']=string_replace($row['firm']);
			$temp_arr['add']=htmlspecialchars($temp_arr['add'], ENT_QUOTES);
			$temp_arr['address']=mysql_real_escape_string(htmlspecialchars($row['address'],ENT_QUOTES));
			$temp_arr['is_in_cupobiz']= mysql_real_escape_string($row['is_in_cupobiz']);
		    $temp_arr['email']=mysql_real_escape_string($row['email']);
		    $temp_arr['mobile']=mysql_real_escape_string($row['mobile']);
		    $temp_arr['phone']=mysql_real_escape_string($row['phone']);
		    $temp_arr['fax']=mysql_real_escape_string($row['fax']);
		    $temp_arr['zip']=mysql_real_escape_string($row['zip']);
		    $temp_arr['web']=mysql_real_escape_string($row['website']);
		    $temp_arr['state']=getState_name(mysql_real_escape_string($row['states_id']));
			if(is_numeric($row['metro_area'])){
				$temp_arr['metro_area']=getMetroArea_name(mysql_real_escape_string($row['metro_area']));
			}else{
				$temp_arr['metro_area']=mysql_real_escape_string($row['metro_area']); 
			}
		    
			  
		    $temp_arr['country']=getCountry_name(mysql_real_escape_string($row['country']));
	  if(is_gt_zero_num($row['is_in_cupobiz'])){
	  		 if($row['logo_ext'] != "" && file_exists($config['root']."logo/{$row['id']}.{$row['logo_ext']}")){
	
	    		$temp_arr['logo'] = "<img src='".$config['mainurl']."/logo/{$row['id']}.{$row['logo_ext']}' style='width:40px;height:40px;border:1px solid #CCC;'/>";

			}else{
            $temp_arr['logo'] = "<img src='".$config['mainurl']."/logo/nologo.jpg' style='width:40px;height:40px;border:1px solid #CCC;'/>";
 		}

	  }else{
	  	$temp_arr['logo']	= "<img src='{$elgg_main_url}images/_graphics/googlebiz.png' style='width:40px;height:40px;border:1px solid #CCC;'/>";
	  }
     
            $dist=0;
            if (isset($row['xtra_2']) && isset($row['xtra_3']) && ($row['xtra_2']!='') && ($row['xtra_3']!='')){
                $dist=con_lat_long_to_dist($row['xtra_2'],$row['xtra_3'],$my_curr_lat,$my_curr_long);
                //$dist=con_lat_long_to_dist($row['xtra_2'],$row['xtra_3'],$my_curr_lat,$my_curr_long);
            }
            extract($temp_arr);
            $map_link = "http://www.google.com/maps?q=".str_replace(" ","+",$address)."+$metro_area,+$state+$zip,+".str_replace(" ","+",$country);

			if((strlen(trim($row['xtra_2']))>0) && (strlen(trim($row['xtra_3']))>0)){
                $str_anchers .=" addMarker(".mysql_real_escape_string($row['xtra_2']).",".mysql_real_escape_string($row['xtra_3']).",\"<table style='font-size:10px;'><tr><td><b>{$firm}</b><br>&nbsp;&nbsp;&nbsp;<span id ='distance_store_".$row['id']."'>".($dist>0 ? "$dist miles away" : "")."</span>&nbsp;&nbsp;&nbsp;<a href='{$map_link}' target='_blank' >Directions</a></td><td>{$temp_arr['logo']}</td></tr></table>\",'red_Marker".chr($imgIcon).".png',{$row['id']}); \r\n";
			/*	$str_anchers .=" addMarker(".mysql_real_escape_string($row['xtra_2']).",".mysql_real_escape_string($row['xtra_3']).",\"<table style='font-size:10px;'><tr><td><b>{$firm}</b><br>&nbsp;&nbsp;&nbsp;<span id ='distance_store_".$row['id']."'>\" +  getMeDistance(33.44,-112.07,33.4483771,-112.0740373)  + \"</span>&nbsp;&nbsp;&nbsp;<a href='{$map_link}' target='_blank' >Directions</a></td><td>{$temp_arr['logo']}</td></tr></table>\",'red_Marker".chr($imgIcon).".png',{$row['id']}); \r\n"; */
                $strBussList .=get_buss_perof_det_div($temp_arr,'red_Marker'.chr($imgIcon).'.png',$isMobile);
                $imgIcon++;
   			}
        }
   }
   //...His current location
   //$str_anchers .=" addMarker($my_curr_lat,$my_curr_long,\"Your current location on map.\",\"red\"); \r\n";
   echo $str_anchers;

}else{
  echo "<b>Sorry no records found to show on map</b>";
}

?>
                center = bounds.getCenter();
                map.fitBounds(bounds);
                //... for now commented since taking time to load
                //map.setZoom(map.getZoom - 1);
                //directionsDisplay.setMap(map);
            }

            function setStartEnd(stVal,endVal){
                document.getElementById("start").value=stVal;
                document.getElementById("end").value=endVal;
                $('#divSelDir').dialog('open');
            }
            /*
function calcRoute() {
                var start = document.getElementById("start").value;
                var end = document.getElementById("end").value;
                var request = {
                    origin:start,
                    destination:end,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                };
                directionsService.route(request, function(response,status){
                  if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                  }
                });
           }
*/

		   function call_tag(){
		 	var spans = document.getElementsByTagName('span');
			alert(spans.length);
    		obj = {};

			for(var i = 0; i < spans.length; i++){
			    obj[spans[i].id] = spans[i].textContent || spans[i].innerText;
				alert(spans[i].innerHTML);
			}
		 }

          $(document).ready(function(){
                initMap();
				//setTimeout('call_tag()', 10000);
            	$('#divSelDir').dialog({ autoOpen: false,title: 'Directions',zIndex: 99999,width:200,modal:true,height:50,resizable:false});
            	$("#tabs").tabs();
            	//detectBrowser();
          });

         function detectBrowser() {
           var useragent = navigator.userAgent;
           var mapdiv = document.getElementById("map");
           if (useragent.indexOf('iPhone')!= -1 || useragent.indexOf('Android')!= -1 )
           {
                mapdiv.style.width = '100%';
                mapdiv.style.height = '100%';
           }else{
               mapdiv.style.width = '600px';
               mapdiv.style.height = '800px';
           }
         }



        </script>

<?php


 if ($isMobile){?>


     <style type='text/css'>
       .map_info {
            width:300px;font-size:10px;font-family:Arial;
            border:1px solid #FFF;
            border-bottom:1px solid #CCC;
            border-collapse: collapse;
            background:#ECECEC;
	   }
	   .map_info  a{
			text-decoration:none;
			font-weight:bold;
			color: black; /*<?php echo ELGG_ORANGE; ?>;*/
	   }
	   .map_info  a:hover, .map_info:hover  a , .map_info_hover a{
			color: white;
	   }

	    .map_info:hover , .map_info_hover{
			background :  #1B1B1B;
			border:1px solid #777;
			color: white;
		}

	</style>


    </head>

    <body style="margin:0px; border:0px; padding:0px;background:#ECECEC;">


	<div   style="float:left;height:190px;overflow-y:scroll;margin-bottom:10px;">
	<?php echo $strBussList; ?>
	</div>

    <div id="map" style="float:left;">
	</div>
    </body>
<?php }else{ ?>

     <style type='text/css'>
       .map_info {
            width:300px;font-size:10px;
            border:1px solid #FFF;
            border-bottom:1px solid <?php echo ELGG_GREEN; ?>;
            border-collapse: collapse;
	   }
	   .map_info  a{
			text-decoration:none;
			font-weight:bold;
			color: <?php echo ELGG_ORANGE; ?>;
	   }
	   .map_info  a:hover, .map_info:hover  a , .map_info_hover a{
			color: <?php echo ELGG_BLUE; ?>;
	   }

	    .map_info:hover , .map_info_hover{
			background : <?php echo ELGG_GREEN; ?>;/*#EFEFEF;*/
			border:1px solid #CCC;
		}

	</style> 
    </head> 
    <body style="margin:0px; border:0px; padding:0px;">
     <table style="height:98%;">
		<tr>
			<td  style="width:32%;vertical-align:top;overflow-x:hidden;overflow-y:scroll !important;height:98%;">
            <?php echo $strBussList; ?>
			</td>
            <td style="width:68%;" id="map">
    		</td>
		</tr>
	</table>
    </body>
<?php } ?>

</html>
