gApp = new Array();

gApp.deviceready = false;
gApp.gcmregid = '';
gApp.device_uid = '';

var device = {};
device['uuid'] = '002';
device['event'] = 'registered';
device['regid'] = "002";
 

window.onbeforeunload  =  function(e) {
    if (gApp.gcmregid.length >0)
    {
      // The same routines are called for success/fail on the unregister. You can make them unique if you like
      window.GCM.unregister( GCM_Success, GCM_Fail );      // close the GCM
    }
};

/*
function GCM_Event(e){   
 
 
  $("#app-status-ul").append('<li>EVENT -> RECEIVED:' + e.event + '</li>'); 
  switch(e.event){
    case 'registered':

    // the definition of the e variable is json return defined in GCMReceiver.java
    // In my case on registered I have EVENT and REGID defined
	
    gApp.gcmregid = e.regid;
    if (gApp.gcmregid.length > 0){
		alert('REGISTERED -> REGID:' + e.regid);
      //$("#app-status-ul").append('<li>REGISTERED -> REGID:' + e.regid + "</li>"); 
      // This is where you would code to send the REGID to your server for this device 
	   window.localStorage['device_uid'] = gApp.device_uid;
	   window.localStorage['gcm_reg_id'] = gApp.gcmregid;
 	  
    }
    break;

  case 'message':
   //The definition of the e variable is json return defined in GCMIntentService.java
   //In my case on registered I have EVENT, MSG and MSGCNT defined
   //You will NOT receive any messages unless you build a HOST server application to send
    // Messages to you, This is just here to show you how it might work
	alert( 'MSG : ' + e.message + '\nMSGCNT :' +  e.msgcnt  );
    //$("#app-status-ul").append('<li>MESSAGE -> MSG: ' + e.message + '</li>');
    //$("#app-status-ul").append('<li>MESSAGE -> MSGCNT: ' + e.msgcnt + '</li>');
    break;

  case 'error':
  	 alert( 'error : ' + e.msg );
    //$("#app-status-ul").append('<li>ERROR -> MSG:' + e.msg + '</li>');
    break;

  default:
  	alert( 'EVENT -> Unknown, an event was received and we do not know what it is');
    //$("#app-status-ul").append('<li>EVENT -> Unknown, an event was received and we do not know what it is</li>');
    break;
  }
}*/

function GCM_Success(e){
	alert( 'GCM_Success -> We have successfully registered and called the GCM plugin, waiting for GCM_Event:registered -> REGID back from Google');
  //$("#app-status-ul").append('<li>GCM_Success -> We have successfully registered and called the GCM plugin, waiting for GCM_Event:registered -> REGID back from Google</li>');
}

function GCM_Fail(e){
	alert( 'GCM_Fail -> GCM plugin failed to register\nGCM_Fail -> ' + e.msg);
  /*$("#app-status-ul").append('<li>GCM_Fail -> GCM plugin failed to register</li>');
  $("#app-status-ul").append('<li>GCM_Fail -> ' + e.msg + '</li>');*/
}




function MydeviceReady(){ 
	 // This is the Cordova deviceready event. Once this is called Cordova is available to be used
  $("#app-status-ul").append('<li>deviceready event received device:'+device.uuid+'</li>');
  $("#app-status-ul").append('<li>calling GCMRegistrar.register, register our Sender ID with Google</li>');
  gApp.DeviceReady = true; 
  gApp.device_uid = device.uuid;

  // Some Unique stuff here,
  // The first Parm is your Google email address that you were authorized to use GCM with
  // the Event Processing rountine (2nd parm) we pass in the String name
  // not a pointer to the routine, under the covers a JavaScript call is made so the name is used
  // to generate the function name to call. I didn't know how to call a JavaScript routine from Java
  // The last two parms are used by Cordova, they are the callback routines if the call is successful or fails
  //
  // CHANGE: your_app_id
  // TO: what ever your GCM authorized senderId is
  //
 // window.plugins.GCM.register("686848382349","GCM_Event",GCM_Success,GCM_Fail); 
  
 GCMevent(device);
}

function GCMevent(e){   
 
  $("#app-status-ul").append('<li>EVENT -> RECEIVED:' + e.event + '</li>'); 
  switch(e.event){
    case 'registered':

    // the definition of the e variable is json return defined in GCMReceiver.java
    // In my case on registered I have EVENT and REGID defined
	
    gApp.gcmregid = e.regid;
    if (gApp.gcmregid.length > 0){ 
      //$("#app-status-ul").append('<li>REGISTERED -> REGID:' + e.regid + "</li>"); 
      // This is where you would code to send the REGID to your server for this device 
	   window.localStorage['device_uid'] = gApp.device_uid;
	   window.localStorage['gcm_reg_id'] = gApp.gcmregid;
 	  
    }
    break;

  case 'message':
   //The definition of the e variable is json return defined in GCMIntentService.java
   //In my case on registered I have EVENT, MSG and MSGCNT defined
   //You will NOT receive any messages unless you build a HOST server application to send
    // Messages to you, This is just here to show you how it might work
	alert( 'MSG : ' + e.message + '\nMSGCNT :' +  e.msgcnt  );
    //$("#app-status-ul").append('<li>MESSAGE -> MSG: ' + e.message + '</li>');
    //$("#app-status-ul").append('<li>MESSAGE -> MSGCNT: ' + e.msgcnt + '</li>');
    break;

  case 'error':
  	 alert( 'error : ' + e.msg );
    //$("#app-status-ul").append('<li>ERROR -> MSG:' + e.msg + '</li>');
    break;

  default:
  	alert( 'EVENT -> Unknown, an event was received and we do not know what it is');
    //$("#app-status-ul").append('<li>EVENT -> Unknown, an event was received and we do not know what it is</li>');
    break;
  }
}
 
/*
document.addEventListener('deviceready', function() {

  // This is the Cordova deviceready event. Once this is called Cordova is available to be used
  $("#app-status-ul").append('<li>deviceready event received device:'+device.uuid+'</li>');
  $("#app-status-ul").append('<li>calling GCMRegistrar.register, register our Sender ID with Google</li>');
  gApp.DeviceReady = true;
  gApp.device_uid = device.uuid;

  // Some Unique stuff here,
  // The first Parm is your Google email address that you were authorized to use GCM with
  // the Event Processing rountine (2nd parm) we pass in the String name
  // not a pointer to the routine, under the covers a JavaScript call is made so the name is used
  // to generate the function name to call. I didn't know how to call a JavaScript routine from Java
  // The last two parms are used by Cordova, they are the callback routines if the call is successful or fails
  //
  // CHANGE: your_app_id
  // TO: what ever your GCM authorized senderId is
  //
  window.plugins.GCM.register("686848382349","GCM_Event",GCM_Success,GCM_Fail);

},false);
*/


	var MyRes = "";
	var lang = {};
	var header_title = ""; 
	includeLanguages();
	 
	/*
    function init() {
    	document.addEventListener("deviceready", deviceReady, true);
    	delete init;
    }*/
	
	function slideMenuOpen(){ 
		  $(".popupPanel").css("height",window.screen.height);
		  $(".popupPanel").animate({"left": "0px"},"slow");
	}
	function slideMenuClose(){
		// $("#popupPanel").css("left",-200); 
		 $(".popupPanel").animate({"left": "-220px"},"slow");
		 //$("#popupPanel").animate({"left": "=-200px"}, "slow");
	}
	 
	
	function localstorage_clear(){ 
		for (i = 0; i < window.localStorage.length; i++) {
			key = window.localStorage.key(i);
			if(key != "device_uid" || key != "gcm_reg_id"){
				window.localStorage.removeItem(key);
			}
		 } 
	} 
		 
	$( ".popupPanel button" ).on( "click", function() {
		slideMenuClose();
	});

    $("div.messages").on("click", function(){
		$(".messages").stop();
		$('.messages').fadeOut('slow'); 
    }); 
    $("div.messages_error").on("click", function(){ 
		$(".messages_error").stop();
		$('.messages_error').fadeOut('slow'); 
    });
    
	
	function echo(val){
		if(val){
			 document.write(val);
		}else{
			document.write("");
		}
		
	}
	
	function updateLang(){
	 /*lngVals =	document.getElementsByClassName("lng_updt_val");
	 
	 for(var i=0;i< lngVals.length;i++){
	 	lngVals[i].value = get_lngVal(lngVals[i].value);
	 }*/
		 
	}
	
	/*function get_lngVal(val){
		var arr =  val.split(".");
		var obj = lang; 
		for(i in arr){
		  var obj = obj['"'+ arr[i].toString() +'"'];
		} 
		alert(obj);
		return obj; 
	}*/
	
	
	
    function handlelogout(){
      if(window.localStorage["guid"] > 0){
        $.ajax({
            type: "POST",
            url: CONFIG.serviceurl,
            data: {action:'logout'},
            dataType: "json",
            async: false,
            success: function(data) { 
              	//window.localStorage.clear(); 
                if(data == 1){ 
					alert(lang.messages.logout.success);
					localstorage_clear();
					window.location.href="login.html";
				}else{
					alert(lang.messages.logout.failure);
				}   
            }
        });
      }
    }

    function setHeaderFooter() { 
       getLoginStatus();
       setTimeout("add_header()",500);
       setTimeout("add_footer()",500);
       /*setTimeout("addPanal()",500);
	   setTimeout("updateLang()",1000);	*/
    }
	 
	
	function includeLanguages(){
		 
		$.ajax({
	        type: "POST",
	        async: false,
	        url: CONFIG.wwwroot + 'ajax/custom_functions.php',
	        data: {action:"getAllLang", var1:"isAjax"},
	        dataType: "json",
	        success: function(result) {  
	          	 if(result){
				  	  lang = result;  
				 }    
	          },
	        error: function(objRequest){  
	             alert("Error occured.");
	        }
		});
	}


/*
function setHeaderFooter(pgToShow) {
       if(!pgToShow)
            pgToShow="index.html";

        $.mobile.changePage(pgToShow);
       //window.location.href=pgToShow;
       getLoginStatus();
       setTimeout("add_header()",500);
       setTimeout("add_footer()",500);
    }
*/
    
    function add_footer(){
    $('[data-role=footer]').html("");
      var str = "";
	  var login_str = "";
	   if(window.localStorage['guid']>0){
       login_str = "<a style=\"font-size:10px;text-align:center;color:#FFF;text-decoration:none;\" href='#' onclick='handlelogout();' ><img style=\"height:32px;widht:32px;\" src=\"graphics/PNG/green/shut-down.png\"/><br>Log Out</a>\n";
     }else{
      login_str = "<a style=\"font-size:10px;text-align:center;color:#FFF;text-decoration:none;\" onclick=\"window.location.href='login.html';\"><img style=\"height:32px;widht:32px;\" src=\"graphics/PNG/green/shut-down.png\"/><br>Log In</a>\n";
     } 
	  str = str + '<table style="width:100%;">';
  str = str + '<tr>';
  str = str + '<td style="float:left"><a style="font-size:10px;text-align:center;color:#FFF;text-decoration:none;"  href="'+CONFIG.wwwroot+'"><img style="height:32px;widht:32px;" src="graphics/PNG/green/computer.png"/><br>Full Site</a></td>';
  str = str + '<td><center style="font-size:11px;">	CupOBiz &copy; 2010-2013 </center> </td>';
  str = str + '<td style="float:right">';
  str = str + login_str;
  str = str + '</td>';
  str = str + '</tr>';
  str = str + '</table>';
	  /*
      str = str + "<center>\n"; 
      str = str + "<a href=\"#\" onclick=\"window.location.href='"+CONFIG.wwwroot+"';\"   data-role=\"button\" data-icon=\"screen\" data-iconpos=\"notext\" data-inline=\"true\" style=\"float:left;margin:5px 0px;\"> Full Site</a>\n";
     
      str = str + "<small style=\"font-size:11px;line-height:35px;\">	CupOBiz &copy; 2010-2013 </small>\n"; 
     if(window.localStorage['guid']>0){
       str = str + "<a data-role=\"button\"  href=\"#\" onclick=\"handlelogout();\"  data-icon=\"shut-down\" data-inline=\"true\" data-iconpos=\"notext\"  style=\"float:right;margin:5px 0px;\">Log Out</a>\n";
     }else{
      str = str + "<a data-role=\"button\"  href=\"#\" onclick=\"window.location.href='login.html';\" data-icon=\"shut-down\" data-inline=\"true\" data-iconpos=\"notext\"  style=\"float:right;margin:5px 0px;\">Log In</a>\n";
     } 
      
     str = str + "</center>\n"; 
	 */
     $('[data-role=footer]').not(".custom_footer").html(str);
     $('[data-role=footer]').not(".custom_footer").trigger('create');
    }
    
	
	
    function add_header(vtitle){
      var str = "";
	  var user_str = "";
	  var logo_link = "";
	  if(window.localStorage['guid']>0){
	   /*
	    logo_link = '<div style=\'margin:3px;\'><img id=\'btnslide\' onclick="slideMenuOpen();" src="images/smico.png" style="border:1px solid #456F9A;padding:3px;height:25px;cursor:pointer;display:inline !important;"/><img style="height:25px;cursor:pointer;display:inline !important;margin-left:70px;" src="graphics/biz_logo.png" onclick="window.location.href=\'index.html\';"/></div>';
	   */
        logo_link = '<img style="height:25px;cursor:pointer;display:inline !important;" src="graphics/biz_logo.png" onclick="window.location.href=\'index.html\';"/>';
      }else{
        logo_link =  '<a href="#" onclick="window.location.href=\'login.html\';"><img src="graphics/biz_logo.png" style="height:25px;"/></a>';
      }
       
      if(window.localStorage['guid']>0){
        
		user_str = '<span title="'+ window.localStorage.member["full_name"] +'" style="font-family:Arial;font-size:11px;">'+ window.localStorage.member["full_name"] +'</span><span title="'+ window.localStorage.member["state"] +'" style="font-family:Arial Narrow;font-weight:normal;font-size:10px;">('+ window.localStorage.member["state"] +'</span>-<span title="'+ window.localStorage.member["metro_area"] +'" style="font-family:Arial Narrow;font-weight:normal;font-size:10px;">'+ window.localStorage.member["metro_area"] +')</span>';
		
      } 
	  //str = str + '<center>';
	  str_head = "";
	  if(header_title){
	  	str_head = header_title ; 
	  }else if(vtitle){ 
	  	str_head = vtitle; 
	  }else{
	  	str_head = 'Home'; 
	  } 
	  str = str + "<div style=\"verical-align:top;width:99%;height:60px;\"><center>"+logo_link+ "<br/>" + str_head + "</center></div>";
      
      //str = str + '</center>'; 
	  /*
      str = str + '<table style="color:#FFF;width:100%;font-size:11px;">';
      str = str + '<tr>';
      str = str + '<td>';
      if(window.localStorage['guid']>0){
        str = str + '<a href="#" onclick="window.location.href=\'index.html\';"><img src="graphics/biz_logo.png" /></a>';
      }else{
        str = str + '<a href="#" onclick="window.location.href=\'login.html\';"><img src="graphics/biz_logo.png" /></a>';
      }
      str = str + '</td>';  
      str = str + '<td colspan="2" style="width:70%;vertical-align:top;">';  
      if(window.localStorage['guid']>0){
        str = str + "<table style='float:right;font-size:11px;color:white;vertical-align:top;'><tr><td style='height:14px;'><img src='" + window.localStorage["icon"] +"' style='height:12px;'/> "+ window.localStorage["display_name"] +"</td></tr><tr><td> "+ window.localStorage["state"] +"-"+ window.localStorage["metro_area"] +"</td></tr></table>";
      }  
      str = str + "</td>\n";
      str = str + "</tr>\n";
      str = str + "</table>\n";
	  */ 
      $('[data-role=header]').not(".custom_header").html(str);
      $('[data-role=header]').not(".custom_header").trigger('create');
    }
    
	function addPanal(){
		str = "";
		str = str +"<div>";
		str = str + "<table style='font-size:12px;color:white;vertical-align:top;'><tr><td style='width:32px;'><img src='" + window.localStorage["icon"] +"' style='width:32px;' /></td><td VALIGN='TOP'><b>"+ window.localStorage["display_name"] +"</b><br><small>"+ window.localStorage["state"] +"-"+ window.localStorage["metro_area"] +"</small></td></tr></table>"; 
		  str = str + '<ul data-role="listview">';
		  str = str + '<li><a rel="external" data-theme="b" data-mini="true" style="font-size:11px !important;" href="index.html">' + lang['dashboard']['heading']['dashboard'] + '</a></li>';
		  str = str + '<li><a rel="external" data-theme="b" data-mini="true" style="font-size:11px !important;" href="ask_recommendation.html">' + lang['dashboard']['heading']['ask_rcmd'] + '</a></li>';
		  str = str + '<li><a rel="external" data-theme="b" data-mini="true" style="font-size:11px !important;" href="friend_ask_rcmd_list.html">' + lang['dashboard']['heading']['friend_request'] + '</a></li>';
		   str = str + '<li><a rel="external" data-theme="b" data-mini="true" style="font-size:11px !important;" href="recommendation.html">' + lang['dashboard']['heading']['rcmd'] + '</a></li>';
		   str = str + '<li><a rel="external" data-theme="b" data-mini="true" style="font-size:11px !important;" href="buss_listing.html">' + lang['dashboard']['heading']['rcmd_biz'] + '</a></li>';
		  str = str + '<li><a rel="external" data-theme="b" data-mini="true" style="font-size:11px !important;" href="myactivities.html">' + lang['dashboard']['heading']['myactivities'] + '</a></li>';
		  /* str = str + '<li><a rel="external" data-theme="b" data-mini="true" style="font-size:11px !important;" href="#" onclick="addToPage(); return false;">' + lang['dashboard']['heading']['add_to_fan'] + '</a></li>';*/
	/*	 
	 str = str + "<div id='fb-root'></div>";
    str = str + "<script src='http://connect.facebook.net/en_US/all.js'></script>";
    str = str + "<span id='msg'></span>";
    str = str + "<script>";
    str = str + "FB.init({appId: '250205068440378', status: true, cookie: true});";
    str = str + "function addToPage() { "; 
    str = str + "var obj = {";
    str = str + "method: 'pagetab'";
    str = str + "}; ";
    str = str + " FB.ui(obj);";
    str = str + "} ";
    str = str + "</script> ";*/
    str = str + " </ul>";
	 str = str + "<center><input data-mini='true' type='button' onclick='slideMenuClose();' value='Back' data-theme='b'/></center>";
    str = str + "</div>";  
      
		 $('.popupPanel').html(str);
		 $('.popupPanel').trigger('create');
	}
	
    function getById(vId){
       return document.getElementById(vId);
    }
                                                
    function getByName(vName){
       return document.getElementsByName(vName)[0];
    }

    function getLoginStatus(){
         $.ajax({
                type: "POST",
                async: false,
                url: CONFIG.serviceurl,
                data: {action:"getLoginStatus"},
                dataType: "json",
                success: function(result) {
                    if(result) {
                        if ((result > 0) && (window.localStorage["guid"]>0) && (window.localStorage["guid"]==result)){
                              //dont do anything
                              //
                              return true;
                        }
                    }
                            //alert('Device Name: '+ device.name + '<br />' +                             'Device PhoneGap: ' + device.phonegap + '<br />' +'Device Platform: ' + device.platform + '<br />' +'Device UUID: ' + device.uuid  + '<br />' +'Device Version: '  + device.version  + '<br />');
                    
                    //..check if the current page login page
                    if (!(window.location.href.indexOf("login.html") >= 0))
                        window.location.href="login.html";
                        
                    return false;
                },
                error: function( objRequest ){
                      return false;
                }
        });
        return false;
    }

function ajaxpost(vdata){
    MyRes= "";
    var retval = "";
    if(vdata){ 
         $.ajax({
                type: "POST",
                async: false,
                url: CONFIG.serviceurl,
                data: vdata,
                dataType: "json",
                success: function(result) { 
                    if(result) {
                        //alert(result); 
                        if(vdata.content){
                            document.getElementById(vdata.content).innerHTML= result;
                        }
                        MyRes =  result;
                    }
                },
                error: function( objRequest ){
                      document.getElementById(vdata.content).innerHTML= "error";
                }
        });
    } 
}

 
 
    function clear_top_StMetro(cmbState_id,cmbMetroArea_id){
        if(cmbState_id.length > 0){
          $("#"+cmbState_id).html("<option value='0'>Select State</option>");
          $('#'+cmbState_id).selectmenu('refresh', true);
        } 
        if(cmbMetroArea_id.length > 0){
            $("#"+cmbMetroArea_id).html('<select name="metro_area" id="metro_area" ><option value="">Select Metro Area</option></select>');
            $('#'+cmbMetroArea_id).selectmenu('refresh', true);
        }  
    }
	function change_states_by_country(cmbcountry_id,cmbstate_id,cmbMetroArea_id){
	
        $('#'+cmbstate_id).empty();
        $("#"+cmbstate_id).html("<option value='0'>Select State</option>");
        //$('#'+cmbstate_id).selectmenu('refresh', true);
        if (document.getElementById(cmbcountry_id).value != ""){
       		//$('#'+cmbstate_id).attr("disabled", true);

            $.post(CONFIG.wwwroot +'getJPContries.php',
            {
			    country_code: document.getElementById(cmbcountry_id).value},

                function(response){
                  if(response){
                     $('#'+cmbstate_id).empty();
                 	 //$('#'+cmbstate_id).attr("disabled", false);
                 	 $('<option value="0">Select State</option>').appendTo($('#'+cmbstate_id));
                 	 $(response).appendTo($('#'+cmbstate_id));
            	 	 $('#'+cmbstate_id).selectmenu('refresh', true);
                     change_metro_area_by_state(cmbstate_id,cmbMetroArea_id);
                   } 
                }
            );
            return false;
        }else{
            alert ("Please Select Country");
            clear_top_StMetro(cmbstate_id,cmbMetroArea_id);
        } 
	}

    function change_metro_area_by_state(cmbState_id,cmbMetroArea_id,prm){
    
        if (document.getElementById(cmbState_id).value > 0){
       		$('#'+cmbMetroArea_id).empty();
        	$('#'+cmbMetroArea_id).attr("disabled", true);
            $.post( CONFIG.wwwroot + "get_chid_categories.php",
            {
			    parent_id: document.getElementById(cmbState_id).value},

                function(response){
                  if(response){
                 	$('#'+cmbMetroArea_id).empty(); 
                 	$('#'+cmbMetroArea_id).attr("disabled", false);
                 	$('<option value="0">Select Metro Area</option>').appendTo($('#'+cmbMetroArea_id));
                 	$(response).appendTo($('#'+cmbMetroArea_id));
                 	if(IsNonEmpty(prm)){
                      $('#'+cmbMetroArea_id).val(prm);
                      $('#'+cmbState_id).selectmenu('refresh', true); 
                    }
            	 	$('#'+cmbMetroArea_id).selectmenu('refresh', true);
                  }
                }
            );
            return false;
        }else{
            //alert ("Please Select State");
            clear_top_StMetro('',cmbMetroArea_id);
        }
	}
	
function getParameterByName(name,search_url){
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regexS = "[\\?&]" + name + "=([^&#]*)";
        var regex = new RegExp(regexS);
        if(IsNonEmpty(search_url)){
            var results = regex.exec(search_url);
        }else{
            var results = regex.exec(window.location.search);
        }

        if(results == null)
            return "";
        else
            return decodeURIComponent(results[1].replace(/\+/g, " "));
}
    
function handleLogin() {
    var form = $("#loginForm");
	if(window.localStorage['guid'] > 0){
		alert(lang.already_on); 
		 window.location.href="index.html"; 
	}else{
		
    //disable the button so we can't resubmit while we wait
    $("#submitButton",form).attr("disabled","disabled");
    var user = jQuery.trim($("#useremail", form).val());
    var pwd = jQuery.trim($("#password", form).val());
    var remember_me =  jQuery.trim($("#persitent", form).val());
    var g = 0;
    var error = ""; 
	var tmp_mob_dev_id = window.localStorage['device_uid']; 
	var tmp_gcm_reg_id = window.localStorage['gcm_reg_id'];
	alert(tmp_mob_dev_id + '\n' + tmp_gcm_reg_id);
	
    if(!(isEmail(user))){
       error = error + "Please Enter Proper Email.\n";
    }
    if(!(IsNonEmpty(pwd))){
       error = error + "Please Enter Password.\n";
    } 
	if(!(IsNonEmpty(tmp_mob_dev_id))){
       error = error + "Mobile device id is not found.\n";
    }
	if(!(IsNonEmpty(tmp_gcm_reg_id))){
       error = error + "Device is not registered to GCM.\n";
    }
	   
    error = jQuery.trim(error);
    if(IsNonEmpty(error)){
       alert(error);
    }else{ 
      $.ajax({
                type: "POST",
                url: CONFIG.serviceurl,
                data: {useremail:user,password:pwd, persistent:remember_me, action:'login', mob_device_id:tmp_mob_dev_id,gcm_reg_id:tmp_gcm_reg_id },
                dataType: "json",
                async: false,
                success: function(data) { 
                    if(data.items.error || data.items ==""){
                        localstorage_clear();
						//window.localStorage.clear();
						if(data.items.error){
							alert(data.items.error);
						}else{
							alert("Login Failed.");
						}
                        
                    }else{
						 
                        window.localStorage['guid'] = data.items.member.member_id; 
                        window.localStorage['member'] = data.items.member;
                        //setHeaderFooter("index.html");
						alert(lang.welcome);
                        window.location.href="index.html"; 
                    } 
                },
				error: function( objRequest ){
                     alert("Error occured");
            	}
				
            });
    }
   
	}
    return false;
}


 

 
   
