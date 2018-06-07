var flashMessage = function (msg){
 
 
var htype = $(msg).attr("class");
 
if(htype){ msg = $(msg).removeClass(htype).trigger('create').html();type = htype;}else {type = 'info';}
 

switch (type){
	case 'info':  tmp = 'ui-btn-down-e'; break;
	case 'success':  tmp = 'ui-bar-g'; break;
	case 'error':  tmp = 'ui-btn-down-f'; break; 
} 
$("<div class='ui-overlay-shadow "+ tmp + " ui-corner-all'><b style=\"font-size:14px;font-weight:bold;\">"+msg+"</b></div>")
	.css({ 	display: "block",
				opacity: 0.95,
				position: "fixed",
				 padding: "7px",
				"text-align": "center",
				"z-index" : "15000",
				width: "270px",
				left: ($(window).width() - 284)/2,
				top: "100px"// $(window).height()/3 
		})
	.appendTo( $.mobile.pageContainer ).delay( 1500 )
	.fadeOut( 7000, function(){
		$(this).remove();
	});
}