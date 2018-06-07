
	/*
	+--------------------------------------------------------------------------
	|   Auth Manager - Content Protection & User Management (Open Source)
	+--------------------------------------------------------------------------
	|   by ScriptsApart
	|   (c) 2011 ScriptsApart
	|   http://www.scriptsapart.com/
	+--------------------------------------------------------------------------
	|   Web: http://www.scriptsapart.com/
	|   Email: support@scriptsapart.com
	|	Facebook: http://www.facebook.com/pages/Scripts-Apart/149933518360387
	|	Twitter: http://www.twitter.com/scriptsapart
	|	Blackberry PIN: 20F03848
	|	Phone Support: +91 9871084893
	+--------------------------------------------------------------------------
	|   > Open Source(100%)
	|   > First Version: 13th September 2010
	|	> Version 2.0: 8th February 2011
	+--------------------------------------------------------------------------
	*/

$(document).ready(function(){

	$("ul.dropdown li").dropdown();

});

$.fn.dropdown = function() {

	$(this).hover(function(){
		$(this).addClass("hover");
		$('> .dir',this).addClass("open");
		$('ul:first',this).css('visibility', 'visible');
	},function(){
		$(this).removeClass("hover");
		$('.open',this).removeClass("open");
		$('ul:first',this).css('visibility', 'hidden');
	});

}