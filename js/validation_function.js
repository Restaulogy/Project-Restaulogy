/* Jquery Functions list for reuseing Functions
Created on Jan 13, 2010
Created By Shridhar
*/
/// Function For Taking Integer Values => $('').ForceIntegerOnly();
/// Function For Taking Numeric Values  => $('').ForceNumericOnly();
/// Function For Taking Alphabates Values => $('').ForceAlphabatesOnly();
/// Function For Taking AlphaNumeric Values  => $('').ForceAlphaNumericOnly();
/// Function For Inputing Maximum Length From User  => $('').maxLength([Lentgh]);


/// source Code : Function For Taking Integer Values //
	 jQuery.fn.ForceIntegerOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                        return (
                            key == 8 ||
                            key == 9 ||
							key == 46 ||
                            (key >= 33 && key <= 40) ||
                            (key >= 96 && key <= 105)
                            );
                    })
                })
            };

/// source Code : Function For Taking Numeric Values //
	 jQuery.fn.ForceNumericOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                        return (
                            key == 8 ||
                            key == 9 ||
                            key == 110 ||
                            key == 46 ||
                            (key >= 33 && key <= 40) ||
                            (key >= 96 && key <= 105)
                            );
                    })
                })
            };

/// source Code : Function For Taking AlphaNumeric Values //
        jQuery.fn.ForceAlphabatesOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                         return (
                            key == 8 ||
                            key == 9 ||
							key == 32 ||
						    key == 46 ||
                            (key >= 33 && key <= 40) ||
          					(key >= 65 && key <= 90)   );
                    })
                })
            };

/// source Code : Function For Taking Numeric Values //
            jQuery.fn.ForceAlphaNumericOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                         return (
                            key == 8 ||
                            key == 9 ||
                       		key == 32 ||
                            key == 46 ||
                            (key >= 33 && key <= 40) ||
                            (key >= 65 && key <= 90) ||
                            (key >= 96 && key <= 105));
                    })
                })
            };


/// source Code : Function For Taking Numeric Values //
            jQuery.fn.ForceAlphaspecialOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                         return (
                            key == 8 ||
                            key == 9 ||
                            key == 46 ||
							key == 32 ||
							key == 94 ||
                            key == 110 ||
                            (key >= 188 && key <= 190) ||
                            (key >= 33 && key <= 40) ||
                            (key >= 47 && key <= 57) ||
                            (key >= 65 && key <= 90) ||
                            (key >= 96 && key <= 105));
                    })
                })
            };


/// source Code : Function For Taking Numeric Values //
            jQuery.fn.ForceUrlOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                         return (
                            key == 8 ||
                            key == 9 ||
                            key == 187 ||
                            key == 186 ||
                            key == 191 ||
                            key == 190 ||
                            key == 189 ||
                            key == 46 ||
                            (key >= 33 && key <= 40) ||
                            (key >= 48 && key <= 57) ||
                            (key >= 65 && key <= 90) ||
                            (key >= 97 && key <= 122) ||
                            (key >= 96 && key <= 105));
                    })
                })
            };



/// source Code : Function For Inputing Maximum Length From User //

            jQuery.fn.maxLength =
			function(max)
				{
					this.each(function()
					{
						//Get the type of the matched element
						var type = this.tagName.toLowerCase();
						//If the type property exists, save it in lower case
						var inputType = this.type? this.type.toLowerCase() : null;
						//Check if is a input type=text OR type=password
						if(type == "input" && inputType == "text" || inputType == "password")
						{
							//Apply the standard maxLength
							this.maxLength = max;
						}
						//Check if the element is a textarea
						else if(type == "textarea")
						{
							//Add the key press event
							this.onkeypress = function(e)
							{
								//Get the event object (for IE)
								var ob = e || event;
								//Get the code of key pressed
								var keyCode = ob.keyCode;
								//Check if it has a selected text
								var hasSelection = document.selection? document.selection.createRange().text.length > 0 : this.selectionStart != this.selectionEnd;
								//return false if can't write more
								return !(this.value.length >= max && (keyCode > 50 || keyCode == 32 || keyCode == 0 || keyCode == 13) && !ob.ctrlKey && !ob.altKey && !hasSelection);

							};
							//Add the key up event
							this.onkeyup = function()
							{
								//If the keypress fail and allow write more text that required, this event will remove it
								if(this.value.length > max){
									this.value = this.value.substring(0,max);
								}
							};

						}
					});

				};
				
				
/// source Code : Method For Input ForcephoneOnly //
				
				  jQuery.fn.ForcephoneOnly =
            function()
            {
                return this.each(function()
                {
                    $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                        return (
                            key == 8   ||
                            key == 9   ||
                            key == 109 ||
                            (key >= 37 && key <= 40) ||
                            (key >= 96 && key <= 105)
                            );
                    })
                })
            };

				
/// source Code : Method For Input US Currency Values //
            jQuery.validator.addMethod("money", function(value, element) {
                 return this.optional(element) || /^(\d{1,12})(\.\d{2})$/.test(value);
             }, "Must be in US currency format 0.99");
             jQuery.validator.classRuleSettings.money = {money: true};

/// source Code : Method For Decimal Values //
             jQuery.validator.addMethod("float", function(value, element) {         return this.optional(element) || /^(\d{1,2})(\.\d{2})$/.test(value);     }, "Must be in the form of 1.04 years ie 1 year 4 months");

    	jQuery.validator.addMethod("notEqual", function(value, element, param) {   return this.optional(element) || value != param.val(); }, "Please specify a different (non-default) value");

 jQuery.validator.addMethod("phoneUS", function(phone_number, element) {

    phone_number = phone_number.replace(/\s+/g, "");
   	return this.optional(element) || phone_number.length > 9 &&
    phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);

}, "Please specify a valid phone number");


    jQuery.validator.addMethod("alphaNumeric", function (value, element) {         return this.optional(element) || /^[0-9a-zA-Z\ ]+$/.test(value);     }, "This Field must contain only letters, numbers.");
    
    jQuery.validator.addMethod("alphabates", function (value, element) {         return this.optional(element) || /^[a-zA-Z\ ]+$/.test(value);     }, "This Field must contain only letters.");
    
    jQuery.validator.addMethod("alphaspecial", function(value, element) {         return this.optional(element) || /^[ \A-Za-z0-9\-\.\,\#\@\!\*\&\(\_\)\$]+$/i.test(value);     }, "This Field must contain only letters, numbers or <br> following  set of characters(_-.,#@!*&()$).");
    
   jQuery.validator.addMethod("allowspecial", function(value, element) {         return this.optional(element) || /^[ \A-Za-z0-9\!\@\#\$\%\&\.\*\(\)\_\-\:\?\[\]\,]+$/i.test(value);     }, "This Field must contain only letters, numbers, commas, dots or <br> following  set of characters(!@#$%&*()_-:?[]).");
   
   jQuery.validator.addMethod("allowcomma", function(value, element) {         return this.optional(element) || /^[ \A-Za-z0-9\-\,]+$/i.test(value);     }, "This Field must contain only letters, numbers ,commas & dash");
   
   
    jQuery.validator.addMethod("USzip", function(value, element) {

     return this.optional(element) ||/^\d{5}(-\d{4})?$/.test(value);

		          }, "Please Enter Only Valid US Zip Code");
   
   $.validator.addMethod("birthdate", function(value, element) {
       var todayvalue = new Date();
       if(value != ""){
   	    return (Date.parse(value) < Date.parse(format_Date(todayvalue)));}
       else{return true;}
     }, "<br>Birth Date should be less than todays date.");

   $.validator.addMethod("startdate_min", function(value, element) {
       var todayvalue = new Date();
       if(value != ""){
	   return (Date.parse(value) >= Date.parse(format_Date(todayvalue)));
       }else{return true;}
     }, "Start Date should be greater or todays date.");

       
	$.validator.addMethod("expiry_date", function(value, element) {
       var todayvalue = new Date();
       if(value != ""){
         return (Date.parse(value) >= Date.parse(format_Date(todayvalue)));
       }else{return true;}
      }, "End Date should be greater or todays date.");


	// for business rule
	$.validator.addMethod("startdate_max", function(value, element) {
	    var nextmontvalue = new Date();
		nextmontvalue.setDate(nextmontvalue.getDate() + 30);
		return Date.parse(value)  < Date.parse(format_Date(nextmontvalue));
		}, "start date should be within 30 days from today");
 	// for business rule
 	$.validator.addMethod("enddate_max", function(value, element){
	     var startdatevalue = $('.startdate').val();
		  var nextmontvalue = new Date(startdatevalue);
		  nextmontvalue.setDate(nextmontvalue.getDate()+ 30);
		  return Date.parse(value)  < Date.parse(format_Date(nextmontvalue));
		  }, "end date should be within 30 days from Today's date.");
	function format_Date(value)
            {
               return value.getMonth()+1 + "/" + value.getDate() + "/" + value.getFullYear();
            }
    
$.validator.addMethod("roles", function(value, elem, param) { 
    var count = 0;
  for (i=0; i<elem.options.length; i++) {
    if (elem.options[i].selected) { 
      count++;
    }
  }  
	 if (param){
	 	if(count <= 0){
			return false;
		}
	 }
	 return true;
	  
},"You must select at least one!");        

