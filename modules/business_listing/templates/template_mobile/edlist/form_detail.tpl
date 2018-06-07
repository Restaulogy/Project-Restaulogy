<div data-role="page" id="detail">
    {include file="$deftpl/edlist/header.tpl"}
    <div data-role="content">
        {include file="$deftpl/form_detail.tpl"}
    {literal}

    <script type="text/javascript" language="javascript">



        $('#country').change(function(){

          var zip =  $("#detail #zip_extra_info");
          var phone =  $("#contact #phone_extra_info");
          var fax =  $("#contact #fax_extra_info");
          var mobile =  $("#contact #mobile_extra_info");

             zip.html("");
             phone.html("");
             fax.html("");
             mobile.html("");

        if ($('#detail #country').val() == 'IN'){
            zip.html("{/literal}{$translations.edit_listing.zip.extra_info.in_format}{literal}");
            phone.html("{/literal}{$translations.edit_listing.phone.extra_info.in_format}{literal}");
            fax.html("{/literal}{$translations.edit_listing.fax.extra_info.in_format}{literal}");
            mobile.html("{/literal}{$translations.edit_listing.mobile.extra_info.in_format}{literal}");
        }else{
            zip.html("{/literal}{$translations.edit_listing.zip.extra_info.us_format}{literal}");
            phone.html("{/literal}{$translations.edit_listing.phone.extra_info.us_format}{literal}");
            fax.html("{/literal}{$translations.edit_listing.fax.extra_info.us_format}{literal}");
            mobile.html("{/literal}{$translations.edit_listing.mobile.extra_info.us_format}{literal}");
        }


        change_states_by_country('country','states', 'metro_area');
		});

        $('#states').change(function(){
            change_metro_area_by_state('states', 'metro_area');
		});

	 function validate_form_detail(){
        	validform = true;
        chk_India_validation = false;
        if ($('#country').val() == 'IN'){
           chk_India_validation = true;
        }
//..For firm
 	 var var_firm  = 	document.forms.register_edit_form2.firm.value;
     $("#firm_error").html('');
	 if (!IsNonEmpty(var_firm)){
            $("#firm_error").html('Please Enter Firm Name');
            validform = false;
	 }else{
		if(!IsAllowspecial(var_firm)){
            $("#firm_error").html('Please Enter Proper Firm Name');
            validform = false;
  		}
  	 }
//.. for   category_listing
    var var_category_listing  = document.forms.register_edit_form2.category_listing.value;
     $("#category_listing_error").html('');
	 if (!IsNonEmpty(var_category_listing)){
            $("#category_listing_error").html('Please Select The Category.');
            validform = false;
	 }
   //.. for   description
    var var_description  = 	document.forms.register_edit_form2.description.value;
     $("#description_error").html('');
	 if (!IsNonEmpty(var_description)){
            $("#description_error").html('Please Enter Description.');
            validform = false;
	 }

//.. for   website
 var var_website  = document.forms.register_edit_form2.website.value;
     $("#website_error").html('');

  if (IsNonEmpty(var_website)){
   	if(!isUrl(var_website)){
             $("#website_error").html("Please Enter Proper URL.");
                validform = false;
  	   }
 }

 //.. for   zip
 var var_zip  = 	document.forms.register_edit_form2.zip.value;
     $("#zip_error").html('');
     if (IsNonEmpty(var_zip)){
       if(chk_India_validation){
            if(isIndianZip(var_zip) == false){
                 $("#zip_error").html("Please Enter Indian Zip.");
                    validform = false;
      	   }
       }else{
           if(isUSZip(var_zip) == false){
                 $("#zip_error").html("Please Enter US Zip.");
                    validform = false;
      	   }
  	   }
     }
//.. for   country
 var var_country  = 	document.forms.register_edit_form2.country.value;
     $("#country_error").html('');
	 if (!IsNonEmpty(var_country)){
            $("#country_error").html('Please Enter Country.');
            validform = false;
	 }

//.. for   states
 var var_states  = 	document.forms.register_edit_form2.states.value;
     $("#states_error").html('');
   	if ((!IsNonEmpty(var_states)) && ((var_states > 0)==false)){
        $("#states_error").html('Please Enter State.');
        validform = false;
        
 	}

//.. for   metro_area
 var var_metro_area  = 	document.forms.register_edit_form2.metro_area.value;
     $("#metro_area_error").html('');
	 if (!IsNonEmpty(var_metro_area)){
        $("#metro_area_error").html('Please Enter Metro Area.');
        validform = false;
	 }

//.. for   listmail
 var var_listmail  = 	document.forms.register_edit_form2.listmail.value;
     $("#listmail_error").html('');
	 if (!IsNonEmpty(var_listmail)){
            $("#listmail_error").html('Please Enter E-mail.');
            validform = false;
	 }else{
       if(isEmail(var_listmail) == false){
             $("#listmail_error").html("Please Enter Proper E-mail.");
                validform = false;
  	   }
     }
       /*
         if(validform==false){
                	alert('Please Revise The Form');
        		}
        */
     
        return validform;
     
  	 }
    </script>
    {/literal}

	</div><!-- content -->
    {include file="$deftpl/edlist/footer.tpl"}
</div><!-- page -->
