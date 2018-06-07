$(function(){
	$("#main-menu ul").hide();
	$("#menuPick").click(function(){
		$("#main-menu ul").slideToggle();
	});
	
	$("a.back-top").click(function(){
		if($.browser.safari) {
			return true;
			}
		else {
			$("html, body").animate({scrollTop:0}, 'slow');
			return false;
			}
	});
});