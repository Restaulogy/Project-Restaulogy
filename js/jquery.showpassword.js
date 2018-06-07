
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

(function($){$.fn.extend({showPassword:function(f){return this.each(function(){var c=function(a){var a=$(a);var b=$("<input type='text' />");b.insertAfter(a).attr({'class':a.attr('class'),'style':a.attr('style')});return b};var d=function($this,$that){$that.val($this.val())};var e=function(){if($checkbox.is(':checked')){d($this,$clone);$clone.show();$this.hide()}else{d($clone,$this);$clone.hide();$this.show()}};var $clone=c(this),$this=$(this),$checkbox=$(f);$checkbox.click(function(){e()});$this.keyup(function(){d($this,$clone)});$clone.keyup(function(){d($clone,$this)});e()})}})})(jQuery);