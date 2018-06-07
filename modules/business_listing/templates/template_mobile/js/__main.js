    var MyRes = "";
	var lang = {};
	var header_title = ""; 
	includeLanguages();
	 
	
    function init() {
    	document.addEventListener("deviceready", deviceReady, true);
    	delete init;
    }
	
	function slideMenuOpen(){ 
		  $(".popupPanel").css("height",window.screen.height);
		  $(".popupPanel").animate({"left": "0px"},"slow");
	}
	function slideMenuClose(){
		// $("#popupPanel").css("left",-200); 
		 $(".popupPanel").animate({"left": "-220px"},"slow");
		 //$("#popupPanel").animate({"left": "=-200px"}, "slow");
	}
	
	function storageClearItem(val){
	 if(val){
	 	if(window.localStorage.getItem(val)){
			window.localStorage.removeItem(val);
		}
	 } 
	}
	
	function session_clear(){ 
		for (i = 0; i < window.localStorage.length; i++) {
			key = window.localStorage.key(i);
			if(key != "device_uid" || key != "gcm_reg_id"){
				window.localStorage.removeItem(key);
			}
		} 
		  
		 
		 
		/*storageClearItem("username");  
	    storageClearItem("password");  
	    storageClearItem("display_name");  
	    storageClearItem("email");  
	    storageClearItem("guid");  
	    storageClearItem("url");  
	    storageClearItem("icon"); 
	    storageClearItem("state");  
	    storageClearItem("metro_area");  
		storageClearItem("isBusiness");  
		storageClearItem("actype");  
		storageClearItem("listingId");  
		storageClearItem("fb_first_time"); */
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
				session_clear()
                if(data)
                    window.location.href="login.html";
            }
        });
      }
    }

    function setHeaderFooter() { 
       getLoginStatus();
       setTimeout("add_header()",500);
       setTimeout("add_footer()",500);
       /*setTimeout("addPanal()",500);*/
	   /*setTimeout("updateLang()",1000);	*/
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
        logo_link = '<div style=\'margin:3px;\'><img id=\'btnslide\' onclick="slideMenuOpen();" src="images/smico.png" style="border:1px solid #456F9A;padding:3px;height:25px;cursor:pointer;display:inline !important;"/><img style="height:25px;cursor:pointer;display:inline !important;margin-left:70px;" src="graphics/biz_logo.png" onclick="window.location.href=\'index.html\';"/></div>';
      }else{
        logo_link =  '<center><a href="#" onclick="window.location.href=\'login.html\';"><img src="graphics/biz_logo.png" style="height:25px;"/></a></center>';
      }
       
      if(window.localStorage['guid']>0){
        
		user_str = '<span title="'+ window.localStorage["display_name"] +'" style="font-family:Arial;font-size:11px;">'+ window.localStorage["display_name"] +'</span><span title="'+ window.localStorage["state"] +'" style="font-family:Arial Narrow;font-weight:normal;font-size:10px;">('+ window.localStorage["state"] +'</span>-<span title="'+ window.localStorage["metro_area"] +'" style="font-family:Arial Narrow;font-weight:normal;font-size:10px;">'+ window.localStorage["metro_area"] +')</span>';
		
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
	  str = str + "<div style=\"verical-align:top;width:99%;height:60px;\">"+logo_link+ "<center>" + str_head + "</center></div>";
      
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
    //disable the button so we can't resubmit while we wait
    $("#submitButton",form).attr("disabled","disabled");
    var user = jQuery.trim($("#useremail", form).val());
    var pwd = jQuery.trim($("#password", form).val());
    var remember_me =  jQuery.trim($("#autologin", form).val());
    var g = 0;
    var error = ""; 
    if(!(isEmail(user))){
       error = error + "Please Enter Proper Email";
    }
    if(!(IsNonEmpty(pwd))){
       error = error + "Please Enter Password";
    }
    error = jQuery.trim(error);
    if(IsNonEmpty(error)){
       alert(error);
    }else{ 
      $.ajax({
                type: "POST",
                url: CONFIG.serviceurl,
                data: {useremail:user,password:pwd, persistent:remember_me, action:'login'},
                dataType: "json",
                async: false,
                success: function(data) { 
                    if(data.items =="") {
                        window.localStorage.clear();
                        alert("Login Failed.");
                    }else{
                        window.localStorage["username"] = data.items.username;
                        window.localStorage["password"] = data.items.password;
                        window.localStorage["display_name"] = data.items.display_name;
                        window.localStorage["email"] = data.items.email;
                        window.localStorage["guid"] = data.items.guid;
                        window.localStorage["url"] = data.items.url;
                        window.localStorage["icon"] = data.items.icon;
                        window.localStorage["state"] = data.items.state;
                        window.localStorage["metro_area"] = data.items.metro_area;
						window.localStorage["isBusiness"] = data.items.isBusiness;
						window.localStorage["actype"] = data.items.actype;
						window.localStorage["listingId"] = data.items.listingId;
						window.localStorage['fb_first_time'] = 1;
                        //setHeaderFooter("index.html");
                        window.location.href="index.html";
                    }
                },
				error: function( objRequest ){
                     alert("Error occured");
            	}
				
            });
    }
    return false;
}

function elipsis(str, len, replacer){
 if(len){
   len = len;
 }else{
   len = 30;
 }

 if(replacer){
   replacer = replacer;
 }else{
   replacer = "...";
 }
   str = trim(str);
   return str = str.length > len ? str.substring(0,len) + replacer: str;

   //return  str.substring(0, len).split(" ").slice(0, -1).join(" ") + replacer;
 return "";

}

function real_escape(field){
     field = field.replace("\r\n","<br>");
     field = field.replace("\'","'");
     field = field.replace('\"','"');
   return field;
}

function checkFileisExist(vfile){
 var isExist = false;
 if(IsNonEmpty(vfile)){
 	$.ajax({
        type: "POST",
        url: CONFIG.serviceurl,
        data: {file:vfile,action:'is_file_exist'},
        dataType: "json",
        async: false,
        success: function(data) {  
			if(data == 1){  
				isExist = true; 
			}
		},
		error: function( objRequest ){
             alert("Error occured");
    	}
	});
 } 
	return isExist;
}

function json_decode (str_json) {
  // http://kevin.vanzonneveld.net
  // +      original by: Public Domain (http://www.json.org/json2.js)
  // + reimplemented by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      improved by: T.J. Leahy
  // +      improved by: Michael White
  // *        example 1: json_decode('[\n    "e",\n    {\n    "pluribus": "unum"\n}\n]');
  // *        returns 1: ['e', {pluribus: 'unum'}]
/*
    http://www.JSON.org/json2.js
    2008-11-19
    Public Domain.
    NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.
    See http://www.JSON.org/js.html
  */

  var json = this.window.JSON;
  if (typeof json === 'object' && typeof json.parse === 'function') {
    try {
      return json.parse(str_json);
    } catch (err) {
      if (!(err instanceof SyntaxError)) {
        throw new Error('Unexpected error type in json_decode()');
      }
      this.php_js = this.php_js || {};
      this.php_js.last_error_json = 4; // usable by json_last_error()
      return null;
    }
  }

  var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
  var j;
  var text = str_json;

  // Parsing happens in four stages. In the first stage, we replace certain
  // Unicode characters with escape sequences. JavaScript handles many characters
  // incorrectly, either silently deleting them, or treating them as line endings.
  cx.lastIndex = 0;
  if (cx.test(text)) {
    text = text.replace(cx, function (a) {
      return '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
    });
  }

  // In the second stage, we run the text against regular expressions that look
  // for non-JSON patterns. We are especially concerned with '()' and 'new'
  // because they can cause invocation, and '=' because it can cause mutation.
  // But just to be safe, we want to reject all unexpected forms.
  // We split the second stage into 4 regexp operations in order to work around
  // crippling inefficiencies in IE's and Safari's regexp engines. First we
  // replace the JSON backslash pairs with '@' (a non-JSON character). Second, we
  // replace all simple value tokens with ']' characters. Third, we delete all
  // open brackets that follow a colon or comma or that begin the text. Finally,
  // we look to see that the remaining characters are only whitespace or ']' or
  // ',' or ':' or '{' or '}'. If that is so, then the text is safe for eval.
  if ((/^[\],:{}\s]*$/).
  test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@').
  replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
  replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

    // In the third stage we use the eval function to compile the text into a
    // JavaScript structure. The '{' operator is subject to a syntactic ambiguity
    // in JavaScript: it can begin a block or an object literal. We wrap the text
    // in parens to eliminate the ambiguity.
    j = eval('(' + text + ')');

    return j;
  }

  this.php_js = this.php_js || {};
  this.php_js.last_error_json = 4; // usable by json_last_error()
  return null;
}

 

 
   
