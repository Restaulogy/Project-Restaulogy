<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<?php
if(isset($_GET['zipcode']))   { $curzipcode  = utf8_encode($_GET['zipcode']); }
?>
 <head>
  <link rel="SHORTCUT ICON" href="/favicon.ico" type="image/x-icon" />
  <meta http-equiv="refresh" content="7200">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
  <meta name="description" content="The Most Accurate Free USA Zip Code Map Anywhere! Find USPS postal Zip codes by address or click on the map to display the zip code as a boundary map."/>
  <title>Free USPS Lookup and Boundary Map</title>
  <style type="text/css">
  .TEXT0
  {
   font-family: Verdana, Sans-Serif, monospace;
   font-size: .6em;
  }
  .TEXT1
  {
   font-family: Verdana, Sans-Serif, monospace;
   font-size: .8em;
  }
  .TEXT2
  {
   font-family: Verdana, Sans-Serif, monospace;
   font-size: 1em;
  }
  .HTEXT0
  {
   font-family: Verdana, Sans-Serif, monospace;
   font-size: .6em;
   color:red;
  }
  .HTEXT1
  {
   font-family: Verdana, Sans-Serif, monospace;
   font-size: .8em;
   color:red;
  }
  .HTEXT2
  {
   font-family: Verdana, Sans-Serif, monospace;
   font-size: 1em;
   color:red;
  }
  .HTEXT3
  {
   font-family: Verdana, Sans-Serif, monospace;
   font-size: 1.5em;
   color:red;
  }
  </style>
  <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAAxrrYw2bBTVKuHbGmrAdBuhQYi6jsp0XZH79MTRLGPRfzDN_W9hRfHVQa6Lch_wtkcQ8ol0vqhYmW9g" type="text/javascript"></script>
  <!-- my key is
  ABQIAAAAxrrYw2bBTVKuHbGmrAdBuhQYi6jsp0XZH79MTRLGPRfzDN_W9hRfHVQa6Lch_wtkcQ8ol0vqhYmW9g -->

  <script type="text/javascript">
  //<![CDATA[
   var tskey = "19a3632a6c" ;
   var chkar = [ ] ;					// Zips Found
   var zipar = [ ] ;					// Zips Found
   var marar = [ ] ;					// Marker Array
   var icons = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'] ;
   var lastclick = "" ;					// Last Clicked Point
   var geocoder ;
   var map ;
   var custommap ;
   var custommap2 ;
   var opts =
   {
    googleBarOptions :
    {
     style : 'new',
     adsOptions :
     {
      adsafe: 'high',
      client : 'partner-pub-8459461757728965',
      channel: '2447878151'
     }
    }
   }

   function LoadMap()
   {
    if (GBrowserIsCompatible()) 			// Do Map if Compatible Browser only
    {
     map = new GMap2(document.getElementById("map"), opts) ;
     map.setCenter(new GLatLng(35,-90) ,4);
     map.addControl(new GLargeMapControl());
     var scalePos = new GControlPosition(G_ANCHOR_TOP_LEFT, new GSize(75,10));
     map.addControl(new GScaleControl(), scalePos);

     map.enableGoogleBar();

     map.addMapType(G_PHYSICAL_MAP) ;

     CustomGetTileUrl=function(point,zoom)
     {
      var server = point.x % 3 ;
//      var server = 0 ;
      var url = "http://ts" + server + ".usnaviguide.com/tileserver.pl?X=" + point.x + "&Y=" + point.y + "&Z=" + zoom + "&T=" + tskey + "&S=Z1001" ;
      return url ;
     }

     var tilelayers = [new GTileLayer(new GCopyrightCollection("Zip Codes"),5,18)];
     tilelayers[0].getTileUrl = CustomGetTileUrl;
     tilelayers[0].isPng = function() {return true;}
     tilelayers[0].getCopyright = function(a,b)
     {
      return {prefix:"Zip Map: ", copyrightTexts:["USNaviguide.com"]};
     }

     var htilelayers = [new GTileLayer(new GCopyrightCollection("Zip Codes"),5,18)];
     htilelayers[0].getTileUrl = CustomGetTileUrl;
     htilelayers[0].getOpacity = function() {return .5;}
     htilelayers[0].getCopyright = function(a,b)
     {
      return {prefix:"Zip Map: ", copyrightTexts:["USNaviguide.com"]};
     }
     custommap = new GMapType(tilelayers, G_SATELLITE_MAP.getProjection(), "Zips",{maxResolution:18,minResolution:5,errorMessage:"No Data Available"});
     map.addMapType(custommap);

     var htilelayers =
     [
      G_NORMAL_MAP.getTileLayers()[0], // a reference to the upper tile layer fo the hybrid map
      htilelayers[0]                  // a reference to the tile layer from the first custom map
     ] ;

     custommap2 = new GMapType(htilelayers, G_SATELLITE_MAP.getProjection(), "ZIP Hybrid", {maxResolution:18,minResolution:5,errorMessage:"No Data Available"});

     map.addMapType(custommap2);

     map.addControl(new GMapTypeControl());

     var publisher_id = "pub-8459461757728965";

     adsManagerOptions = {
     maxAdsOnMap : 2,
     style: 'adunit',
     channel: '5409190961'
     };

     adsManager = new GAdsManager(map, publisher_id, adsManagerOptions);
     adsManager.enable();

     geocoder = new GClientGeocoder() ;

     GEvent.addListener(map, 'click', function(overlay, point)
     {
      if (overlay)
      {
      } else if (point)
      {
       checkclick( point ) ;
      }
     });
     if ( location.search.length > 1 )
     {
      zippoly( 0, location.search.substring(3,location.search.length) ) ;
     }
    } else
    {
     document.getElementById("map").innerHTML = "<h1>Browser not compatible with Google Maps. Sorry...</h1>" ;
    }
   }

// Find a zip code and cause it to be drawn on the map...

   function findzip( zipcode )
   {
    if ( zipcode.address.value )
    {
     showAddress(zipcode.address.value) ;
    } else if ( CheckZip( zipcode.zip.value ) > -1 )
    {
     alert("Zip Code Keyed Has Already Been Selected.") ;
    } else
    {
     zippoly( 0, zipcode.zip.value ) ;
    }
   }

// Clear overlays, Div area and restore map...

   function clearmap( zipcode )
   {
    zipcode.zip.value = "" ;
    document.getElementById("message").innerHTML = "" ;
    map.clearOverlays() ;
    lastclick = "" ;
    zipar = [ ] ;
    chkar = [ ] ;
    marar = [ ] ;
   }

// Check for a double click...

   function checkclick ( point )
   {
    if ( lastclick != point )
    {
     lastclick = point ;
     zippoly( point, '' ) ;
    }
   }

// Open an Infowindow when the zip link is clicked in the message div...

   function zipLink(zip)
   {
    for (var i = 0; i < zipar.length; i++)
    {
     if ( zipar[i] == zip )
     {
      break ;
     }
    }
    GEvent.trigger(marar[i], "click");
    map.setMapType(custommap2) ;
   }

// Check to see if a Zip has already been selected...

   function CheckZip(zip)
   {
    for (var i = 0; i < chkar.length; i++)
    {
     if ( chkar[i] == zip )
     {
      return(i) ;
     }
    }
    return(-1) ;
   }

// Find a zip code and return the coordinates along with other information...

   function zippoly( point, zip )
   {
    var request = GXmlHttp.create();
    var parms = "POINT=" + point ;
    if ( zip )
    {
     parms = "ZIP=" + zip ;
    }
    request.open("POST", "zip.php", true);
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;	// Thanks to Darkstar 3D!
    request.onreadystatechange = function()
    {
     document.getElementById("loading").innerHTML = "Loading, please wait..." ;

     if (request.readyState == 4)
     {
      var xmlDoc = request.responseXML ;
      try
      {
       var info = xmlDoc.documentElement.getElementsByTagName("info") ;
       var zipcode = info[0].getAttribute("zipcode") ;
       var hitrem = parseInt(info[0].getAttribute("hitrem")) ;
       if ( hitrem <= 1 )
       {
        alert("You have exausted your requests for this time period. Please come back in 2 hours. If this is not enough for your purposes, please use the contact form, or see the sales information page for details on increasing your access.") ;
       } else if ( zipcode == "" )
       {
        alert("Area clicked not defined by a zip code") ;
       } else
       {
        var zipindex = CheckZip( zipcode ) ;
        if ( zipindex > -1 )
        {
         GEvent.trigger(marar[zipindex], "click")
        } else
        {
         var lastpoint	= map.getCenter() ;
         var point	= lastpoint ;
         var zipname	= info[0].getAttribute("zipname") ;
         var uspsst	= info[0].getAttribute("uspsst") ;
         var stname	= info[0].getAttribute("stname") ;
         var ctyname	= info[0].getAttribute("ctyname") ;
         var county	= info[0].getAttribute("county") ;
         var complex	= info[0].getAttribute("complex") ;
         var pointzip	= info[0].getAttribute("pointzip") ;

         chkar.push(zipcode) ;
         var points = [] ;
         var markers = xmlDoc.documentElement.getElementsByTagName("marker1");
         for (var i = 0; i < markers.length; i++)
         {
          point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),parseFloat(markers[i].getAttribute("lng"))) ;
          html	= "<div style='width:200px; text-align:left;'><b>Zip Code:</b> " + zipcode +
                  "<br>" + zipname +
                  "<br>" + uspsst + " - " + stname +
                  "<br>County:" + county + " - " + ctyname +
                  "<br>Area Code(s):" + complex ;
          if ( pointzip == 1 )
          {
           html += "<br>Point Zip - Not Mapped" ;
          }

          html	+= "</div>" ;
          var number = marar.length ;
          if ( number > icons.length )
          {
           number = icons.length ;
          }
          marar.push( createMarker( point, html, number ) ) ;
          map.addOverlay(marar[marar.length-1]);
          zipar.push(zipcode + "A") ;
          var html	= icons[number] + " <a href=\"javascript:zipLink('" + zipcode + "A" + "')\">" + zipcode ;
          html += "</a><br>&nbsp;" + zipname + ", " + uspsst + "<br>&nbsp;Area Code: " + complex + "<br>" ;
          document.getElementById("message").innerHTML =  html + document.getElementById("message").innerHTML ;
         }
         if ( point != lastpoint )
         {
          if( chkar.length > 1 )
          {
           map.setCenter( point, map.getZoom() ) ;
          } else
          {
           map.setCenter( point, 13 ) ;
          }
          map.setMapType(custommap2) ;
         }
        }
       }
      } catch(e)
      {
       alert("Some error occured during program processing:" + e) ;
      }
      document.getElementById("loading").innerHTML = "" ;
     }
    }
    request.send(parms);
   }

// Create a marker at a point with an infowindow...

   function createMarker(point, html, number)
   {
    var marker = new GMarker(point, new GIcon( G_DEFAULT_ICON, 'http://www.google.com/intl/en_us/mapfiles/marker' + icons[number] + '.png' )) ;
    GEvent.addListener(marker, "click", function()
    {
     marker.openInfoWindowHtml(html);
    });
    return marker;
   }

   // Find the address using the geocoder...

   function showAddress(address)
   {
    geocoder.getLatLng( address, function(point)
    {
     if (!point)
     {
      alert(address + " not found")
     } else
     {
      zippoly('(' + point.toUrlValue() + ')') ;
     }
    }) ;
   }
  //]]>
  </script>

 </head>
 <body bgcolor="#D1D0CD" text="black" link="#444444" alink="gray" vlink="#111111" onload="LoadMap();findzip(<?php echo $curzipcode; ?>)" onunload="GUnload()">

  <img src="http://www.google.com/mapfiles/marker.png" style="display:none" />
  <img src="http://www.google.com/mapfiles/shadow50.png" style="display:none" />
  <img src="http://www.google.com/mapfiles/markerTransparent.png" style="display:none" />
  <img src="http://www.google.com/mapfiles/markerie.gif" style="display:none" />
  <img src="http://www.google.com/mapfiles/dithshadow.gif" style="display:none" />

  <div id="main" title="" style="border: 4px outset #99B3CC; background-color:#FFFA73; text-align:left; padding:4px;">
   <div id="form" title="zip code search form" class="TEXT2" style="height:25px">
    <form name=zipcode onsubmit="javascript:return false;">
     Key Zip <input type=text name=zip>
     or Address <input type=text size=20 name=address>
     <input type=BUTTON value="Find Zipcode" onclick="findzip(zipcode)" name="BUTTON">
     or click on the map.
    <input type=BUTTON value="Clear" onclick="clearmap(zipcode)" name="CLEARBUTTON">

    </form>
   </div>
   <table width="100%" height="100%" border=0 cellPadding=2 cellSpacing=2>
    <tr>
     <td>
      <script language="javascript">
      <!--
      if( window.innerHeight )
      {
       var width = window.innerWidth - 294 ;
       var height = window.innerHeight - 140 ;
      } else
      {
       var width = document.documentElement.offsetWidth - 334 ;
       var height = document.documentElement.offsetHeight - 180 ;
      }
      document.write('<div id="map" style="width: ' + width  + 'px; height:' + height + 'px; border: thin solid black;">') ;
      // -->
      </script>
      </div>
     </td>
    </tr>
   </table>

  </div>

 </body>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
_uacct = "UA-813480-2";
urchinTracker();
</script>
</html>
