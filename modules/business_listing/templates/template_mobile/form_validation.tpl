    {literal}

        <script type="text/javascript">

		 function set_address(){
    		//str_add = jQuery.trim($('#addr1').val());
			//if (str_add.length == 0){
            /*
var strAddress = "";
            var str_country = jQuery.trim($('#country option:selected').text());
            var str_metroarea = jQuery.trim($('#metro_area option:selected').text());
            var str_states = jQuery.trim($('#states option:selected').text());
            if (str_states.length == 0){
                str_states = '';
   			}else if(str_metroarea.length == 0){
                str_states = str_states;
	  		}else{
                //str_states = ', ' + str_states;
                str_states = str_states;
	  		}
	  		var str_zip = jQuery.trim($('#zip').val());
	  	 	if (str_zip.length == 0){
                str_zip = '';
   			}else if(str_country.length==0){
                str_zip = str_zip;
	  		}else{
                str_zip = '-' + str_zip;
	  		}
			strAddress =  str_states + ' ' + str_zip + '.' ;
*/
            //$('#addr1').val(strAddress);
            //$('#show_sel_location').html(strAddress);
            //alert(strAddress);
   			//}
   		}

			$(document).ready(function()
			{
               $("#tabs").tabs('select', {/literal}{$seltab}{literal});

               $( "#dialog_form" ).dialog({
                    title: "Choose Category",
        			autoOpen: false ,
                    width: 620,
                    modal:true ,
                    zIndex: 11000
                    });

               function populate_cntry() {
                   fetch_cntry.doPost('getContries.php');
               }

               $("#country").change(populate_cntry);

               var fetch_cntry = function() {
                   var contries = $("#states");
                   return {
                    	doPost: function(src) {
                    		if (src) $.post(src, { country_code: $("#country").val() }, this.getContries);
                    		else throw new Error('No SRC was passed to getContries!');
                    	},

                    	getContries: function(results) {
                    		if (!results) return;
                    		contries.html(results);
                            //$("#states").val('<?php echo $country_val; ?>');
                            populate();
                    	}
                    }
                }();

                //..Auto fill
            function populate() {
                fetch.doPost('{/literal}{$website}{literal}/ajax/get_chid_categories.php');
            }

            $("#states").change(populate);

            var fetch = function() {

            var counties = $("#metro_area_box");
            return {
            	doPost: function(src) {
            		if (src) $.post(src, { parent_id: $("#states").val() }, this.getCounties);
            		else throw new Error('No SRC was passed to getCounties!');
            	},

            	getCounties: function(results) {
            		if (!results) return;
            		counties.html('<select Disabled><option>Select Metro Area</option></select>');
            		setTimeout("finishAjax('"+escape(results)+"', 'metro_area_box', 'metro_area','metro_area')", 200);
            	}
            }
            }();

              document.getElementById('states').disabled = false;
              document.getElementById('metro_area').disabled = false;
               /*
               $('#states').change(function(){

                	if (document.getElementById('states').value > 0){

            		document.getElementById('metro_area_box').innerHTML= '<select Disabled><option>Select Metro Area</option></select>';
            		$.post("get_chid_categories.php",
                        {parent_id: document.getElementById('states').value
                        },
                          function(response){

                            setTimeout("finishAjax('"+escape(response)+"', 'metro_area_box', 'metro_area','metro_area')", 200);

                        }
                    );
            		return false;
                    }else{
                      alert ("Please Select State");
                    }
        	   });

               */
                $('#firm').focus();
			 	$('#fax').maxLength(15);
                $("#phone").maxLength(15);
                $("#mobile").maxLength(15);
                $("#zip").maxLength(10);
                $("#firm").maxLength(100);
                $('#website').maxLength(100);
                $('#listmail').maxLength(100);
                $('#my_paypal_id').maxLength(100);
                $("#description").maxLength(500);
                $("#addr1").maxLength(100);
                $("#loc1").maxLength(100);
                $("#contact").maxLength(60);
               /* $("#phone").numeric({allow:"-,(,), "});

                $("#mobile").numeric({allow:"-,+,(,), "});
                $('#fax').numeric({allow:"-,(,), "});
                $("#zip").numeric({allow:"-"});*/
                $("#firm").ForceAlphaspecialOnly();
                //$("#description").ForceAlphaNumericOnly();
                //$("#addr1").ForceAlphaNumericOnly();
                //$("#loc1").ForceAlphaNumericOnly();
                $('#loc1').ForceAlphabatesOnly();
                $("#website").ForceUrlOnly();
                $("#listmail").ForceUrlOnly();


    $("#form_detail").validate({
					rules: {
                        country : { required: true },
                        //loc1 : {required:true, alphabates:true },
                        loc1 : {required:true},
                        description : {required:true},
						firm: 	{ required: true, alphaspecial:true},
						phone:	{ phoneUS:  $('#country').val() } ,
						mobile:	{ mobileUS:  $('#country').val() },
						fax:	{ phoneUS:  $('#country').val() },
						website : 	{ url: true },
						states : { min: 1 },
						metro_area : { min: 1 },
						xtra_4 : { min: 1 },
						listmail: {email:true},
						//my_paypal_id: {required:false,email:true},
                        zip: {USzip: $('#country').val()},
						logo: { accept: "png|gif|jpg" }
					},
                   messages: {
                      loc1 : "Please Enter City",
                      metro_area :"Please Select Metro Area",
                      country : "Please Select Country",
                      category_listing : "Select At least one category",
                      xtra_4 : "Please Select the State",
                      states : "Please Select the State",
 	                  firm: "Please enter a Business Name" ,
 	                  description: "Please enter a Description",
					  phone: "Please enter proper phone no" ,
					  mobile: "Please enter proper Mobile no",
					  fax: "Please enter proper fax no",
					  logo :  "Please upload image file (Format like png, gif or jpg)"
					  /*
					  my_paypal_id:{
                            required: "Please enter Paypal ID",
                            email: "Please enter a proper Paypal ID"
		  				},
                        zip : "Please enter a proper Zip Code",
 	                 listmail: "Please enter a proper Email"*/
 	               }
				});

			 });
		</script>
		{/literal}
