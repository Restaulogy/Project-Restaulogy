<div data-role="page" id="contact">
    {include file="$deftpl/edlist/header.tpl"}
    <div data-role="content">
        {include file="$deftpl/form_detail_contact_info.tpl"}
    {literal}
    <script type="text/javascript" language="javascript">
	 function validate_form_detail_contact_info(){
        validform = true;
        chk_India_validation = false;
        if ($('#detail #country').val() == 'IN'){
           chk_India_validation = true;
        }
         
       var var_mobile  = 	document.forms.register_edit_form2.mobile.value;
       $("#mobile_error").html('');
  	   if(IsNonEmpty(var_mobile)){
         if(chk_India_validation){
            if(isIndianMobileNumber(var_mobile) == false){
             $("#mobile_error").html("Please Enter Valid Indian Mobile");
                validform = false;
  	   		}
         }else{
            if(isPhoneNumber(var_mobile) == false){
             $("#mobile_error").html("Please Enter Valid US Mobile");
                validform = false;
  	   		}
         }
	   }


//.. for   fax
 var var_fax  = document.forms.register_edit_form2.fax.value;
     $("#fax_error").html('');
  	   if(IsNonEmpty(var_fax)){
         if(chk_India_validation){
            if(isIndianPhoneNumber(var_fax) == false){
             $("#fax_error").html("Please Enter Valid Indian Fax");
                validform = false;
  	   		}
         }else{
            if(isPhoneNumber(var_fax) == false){
             $("#fax_error").html("Please Enter Valid US Fax");
                validform = false;
  	   		}
         }
	   }

//.. for   phone
 var var_phone  = 	document.forms.register_edit_form2.phone.value;
     $("#phone_error").html('');
	   if(IsNonEmpty(var_phone)){
         if(chk_India_validation){
            if(isIndianPhoneNumber(var_phone) == false){
             $("#phone_error").html("Please Enter Valid Indian Phone");
                validform = false;
  	   		}
         }else{
            if(isPhoneNumber(var_phone) == false){
             $("#phone_error").html("Please Enter Valid US Phone");
                validform = false;
  	   		}
         }
	   }
	 
//.. for contact
     var var_contact  = document.forms.register_edit_form2.contact.value;
     $("#contact_error").html('');
	 if (!IsNonEmpty(var_contact)){
            //$("#contact_error").html('This Field should not be empty.');
            alert('You have not provided Contact Name and Phone. We only share this with other business members of CupOBiz, not the individual users. Providing this information will help other businesses contact you directly. Please consider providing this information.');
            //validform = false;
	 }

//.. for contact
     var var_loc1  = 	document.forms.register_edit_form2.loc1.value;
     $("#loc1_error").html('');
	 if (!IsNonEmpty(var_loc1)){
            $("#loc1_error").html('This Field should not be empty.');
            validform = false;
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
