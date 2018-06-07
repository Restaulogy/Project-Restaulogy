//...On loading of the landing page
function Bodyload(){
 if(window.localStorage['guid']){
   window.location.href='index.html';
 }else{
   MydeviceReady(); 
   setHeaderFooter();
 }
   
	 
}
// Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '250205068440378', // App ID
      channelUrl : '//www.cupobiz.com/testserver/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    }); 
    // Additional init code here

  };

  // Load the SDK Asynchronously

   // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));


   function toArray(_Object){
       var _Array = new Array();
       for(var name in _Object){
               _Array[name] = _Object[name];
       }
       return _Array;
	} 

   function fb_login(){
	   FB.login(function(response) {
	   		 /*for (x in response.authResponse){
			 	 alert(x + "=>" + response.authResponse[x]);
			 }*/
	        if (response.authResponse) {
	            // connected
				var uid = response.authResponse.userID;
				var accessToken = response.authResponse.accessToken;
				FB.api('/me', function(fb_response) {
					getFBCupobizLogin(uid,accessToken, fb_response);
    			});

	        } else {
	            // cancelled

				alert('Not Connected');
	        }
	    });
	}

 	 /*FB.getLoginStatus(function(response) {
	    if (response.status === 'connected') {
	        // connected
	    } else if (response.status === 'not_authorized') {
	        // not_authorized
	        fb_login();
	    } else {
	        // not_logged_in
	        fb_login();
	    }
	});  */

function getFBCupobizLogin(fb_user,fb_access_token,fb_user_profile){
	  var info = {};
	 	  	info['fb_user_profile'] =  JSON.stringify(fb_user_profile);
		info['fb_user'] = fb_user;
		info['fb_access_token'] = fb_access_token;
		/*alert("INFO=>" + info['fb_user_profile']); */
		$.ajax({
            type: "POST", 
            url: CONFIG.wwwroot + "services/fb_recomm_indx_pg.php",
            data: info,
            dataType: "json",
            success: function(data) {   
			     
     			if(data.success){  
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
				}   
            }, 
			error: function( objRequest ){ 
    			alert("Error occured on login." + objRequest.responseText);
            }
        });
} 
